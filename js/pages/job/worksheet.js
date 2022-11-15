// JavaScript Document
$(function() {
  //Set Global properties
  FECI.source_page = "worksheet";
  FECI.source_modal = "";

  worksheet_init();
  worksheet_handlers();

  //If worksheet has adjustment factors, need to wait until load_adjustment_sub_factors_select_elements calls calc_worksheet
  if (FECI.worksheet_master.DisplayAdjustmentFactors == 0) {
    //Calculate worksheet
    calc_worksheet();
  }
});

function worksheet_init() {
  if (FECI.worksheet_master.DisplayAdjustmentFactors == 1) {
    //Load Adjustment Sub Factors into global variable
    get_adjustment_sub_factors();
  }
}

function worksheet_handlers() {
  //Cache DOM
  var $submit_buttons = $("#worksheet").find("input[type=submit]");
  FECI.submit_button = null;

  worksheet_row_handlers();

  //Save Worksheet
  $(".save-button").click(function(e) {
    e.preventDefault();

    if (validate_worksheet()) {
      $("#worksheet").submit();
    } else {
      displayMessageBox("Validation errors on worksheet", "info");
    }
  });

  //Worksheet form submit handler
  $("#worksheet").submit(function(e) {
    e.preventDefault();

    save_worksheet(this);
  });

  worksheet_parms_handlers();

  cart.shopping_cart_handlers();

  override_hours_handlers();

  footer_handlers();

  assembly_handlers();

  eq_braces_handler();

  product_assembly_handlers();

  //Event handler for delete button on copy job modal dialog
  $("#DeleteProductsConfirmation").click(function() {
    const products_checked = $(".delete:checked").length;

    if (products_checked > 0) {
      //Load dialog body
      $("#delete_products_modal .modal-body p").html("Delete selected items?");

      //Show modal dialog
      $("#delete_products_modal").modal("show");
    } else {
      alert("No items selected!");
    }
  });

  $("#DeleteZeroQuantityItemsConfirmation").click(function() {
    select_zero_quantity_items();

    const items_checked = $(".delete:checked").length;

    if (items_checked > 0) {
      //Load dialog body
      $("#delete_products_modal .modal-body p").html("Delete selected items?");

      //Show modal dialog
      $("#delete_products_modal").modal("show");
    } else {
      alert("No zero quantity items!");
    }
  });

  //Add Worksheet modal open handler
  //$("#AddWorksheetModal").on("shown.bs.modal", function (e) {
  //});

  $(".openAddWorksheetModal").on("click", function(e) {
    e.preventDefault();
    const copy_flag = (parseInt($(this).data("worksheet_master_idn")) === 10 || parseInt($(this).data("worksheet_master_idn")) === 9) ? 0 : 1;
    const data = {
      worksheet_master_idn: $(this).data("worksheet_master_idn"),
      worksheet_idn: FECI.worksheet.Worksheet_Idn,
      worksheet_area_idn: "",
      worksheet_category_idn: $(this).data("worksheet_category_idn"),
      copy_flag: copy_flag
    };

    //Always copy for Electronics Division
    // if (parseInt(FECI.job.department_idn) === 1) {
    //   data.copy_flag = 1;
    //   data.worksheet_idn = FECI.worksheet.Worksheet_Idn;
    // }

    show_add_worksheet_modal(data);
  });

  $("#AddWorksheetForm").on("submit", function(e) {
    e.preventDefault();

    if (validate_create_worksheet()) {
      if ($("#AddWorksheet").html() == "Copy") {
      //if ($("#CopyWorksheetCheckbox").is(":checked")) {
        copy_worksheet($(this));
      } else {
        add_worksheet($(this));
      }
    }
  });

  $("#DeleteProducts").click(function() {
    delete_products();
  });

  //Delete Worksheet
  $("#DeleteWorksheetConfirmation").click(function() {
    open_delete_worksheet_modal();
  });

  $("#DeleteWorksheet").click(function() {
    delete_worksheet(FECI.worksheet.Worksheet_Idn);

    //Close modal dialog
    $("#delete_worksheet_modal").modal("hide");
  });

  $submit_buttons.on("click", function(e) {
    FECI.submit_button = this;
  });

  //CROSSMAINS AND LINES RECAP
  if (FECI.worksheet_master["WorksheetMaster_Idn"] == 32) {
    crossmains_lines_handlers();
  }
}

function worksheet_row_handlers() {
  arrow_navigation_controller();

  //Calculate worksheet
  $(".calc-worksheet").change(function(e) {
    calc_worksheet();
  });

  ////Copy worksheet
  //$(".copy-worksheet").on("click", function (e) {
  //    e.preventDefault();

  //    var worksheet_name = (typeof $(this).siblings("a.worksheet") === "undefined") ? "" : $(this).siblings("a.worksheet").text();

  //    var data = {
  //        worksheet_master_idn: $(this).data("worksheet_master_idn"),
  //        worksheet_idn: $(this).data("worksheet_idn"),
  //        worksheet_area_idn: $(this).data("worksheet_area_idn"),
  //        worksheet_category_idn: $(this).data("worksheet_category_idn"),
  //        copy_flag: 1,
  //        worksheet_name: worksheet_name,
  //        job_number: FECI.job.job_number
  //    };

  //    show_add_worksheet_modal(data);

  //});
}

function crossmains_lines_handlers() {
  $(".add-miscellaneous").on("click", function(e) {
    e.preventDefault();

    add_miscellaneous_item(this);
  });

  $("#OpenAddAreaModal").on("click", function(e) {
    e.preventDefault();

    $("#AddAreaModal").modal("show");
  });

  //Add Area modal open handler
  $("#AddAreaModal").on("shown.bs.modal", function(e) {
    //Clear message
    $(".modal-message").html("");

    //Clear WorksheetName
    $("#AddAreaModal NewAreaName").val("");

    //Set values
    $("#AddAreaModal #NewAreaJobNumber").val(FECI.job.job_number);
    $("#NewAreaWorksheetMaster_Idn").val("9");

    //Load Areas
    load_areas(true);
  });

  //inline edit for Area name
  $(".area-name-inline").editable({
    type: "text",
    mode: "inline",
    url: FECI.base_url + "worksheet_controller/save_area_name",
    title: "Update Area Name"
  });

  //Crossmain
  $("#AddWorksheetArea").on("change", function(e) {
    //Declare and initialize variables
    var worksheet_area_idn = $(this).val();
    var $row = $(".branchline" + worksheet_area_idn + " td a.worksheet");

    //Load Worksheet Position select element
    load_worksheet_position($row);
  });

  $("#AddAreaForm").on("submit", function(e) {
    e.preventDefault();

    if ($("#NewAreaName").val() === "") {
      $(".modal-message").html("Area Name required");
    } else {
      add_area($(this));
    }
  });

  //Branchline Area
  $(".add-worksheet-to-area").on("click", function(e) {
    e.preventDefault();

    var data = {
      worksheet_master_idn: $(this).data("worksheet_master_idn"),
      worksheet_area_idn: $(this).val()
    };

    show_add_worksheet_modal(data);
  });

  $("#HeadType, #CoverageType").on("change", function(e) {
    update_branch_line_worksheet_name();
  });
}

function override_hours_handlers() {
  $("#OverrideFieldHours").click(function() {
    if ($(this).is(":checked")) {
      //Display User hours
      $("#UserFieldHoursWrapper").show();

      //Hide totaled hours
      $("#FieldHoursTotalWrapper").hide();
    } else {
      //Hide User hours
      $("#UserFieldHoursWrapper").hide();

      //show totaled hours
      $("#FieldHoursTotalWrapper").show();
    }

    calc_worksheet();
  });

  $("#OverrideShopHours").click(function() {
    if ($(this).is(":checked")) {
      //Display User hours
      $("#UserShopHoursWrapper").show();

      //Hide totaled hours
      $("#ShopHoursTotalWrapper").hide();
    } else {
      //Hide User hours
      $("#UserShopHoursWrapper").hide();

      //show totaled hours
      $("#ShopHoursTotalWrapper").show();
    }

    calc_worksheet();
  });

  $("#OverrideEngineerHours").click(function() {
    if ($(this).is(":checked")) {
      //Display User hours
      $("#UserEngineerHoursWrapper").removeClass("hide");

      //Hide totaled hours
      $("#EngineerHoursTotalWrapper").addClass("hide");
    } else {
      //Hide User hours
      $("#UserEngineerHoursWrapper").addClass("hide");

      //show totaled hours
      $("#EngineerHoursTotalWrapper").removeClass("hide");
    }

    engineering.calc_engineering_worksheet();
  });
}
adjustment_factor_handlers;
function worksheet_parms_handlers() {
  //Load Parms
  $("#load_worksheet_parameters").click(function(e) {
    e.preventDefault();

    if (validate_worksheet_parms()) {
      //$("#worksheet_parameters").submit();
      load_worksheet_parms();
    }
  });
}

function footer_handlers() {
  //determine_volume_adjustment();
  toggle_volume_adjustment();
  
  //Manhour Adjustment Handlers
  $("#VolumeAdjustment").on("change", function(e) {
    load_manhour_adjustment_factor();
  });

  $("#OverrideDefaultManhourAdjustment").on("change", function(e) {
    //determine_volume_adjustment();
    toggle_volume_adjustment();
  });

  //Adjustment factors handlers
  if (FECI.worksheet_master.DisplayAdjustmentFactors == 1) {
    adjustment_factor_handlers();
  }

  if (FECI.worksheet_master.WorksheetMaster_Idn == 9) {
    shop_fab_handlers();
    $("#ShopFabrication, #ShopFabricationMultiplier").on("change", function(e) {
      calc_shop_per_head();
    });
  }

  //Add Adjustment Factor Link Handler
  $("#AddAdjustmentFactor").on("click", function(e) {
    e.preventDefault();

    var worksheet_idn = $(this).data("worksheet_idn");

    add_adjustment_factor(
      worksheet_idn,
      FECI.worksheet_master["NumberOfColumns"]
    );
  });
}

function load_manhour_adjustment_factor() {
  if ($("#OverrideDefaultManhourAdjustment").is(":checked")) {
    const $select = $("#VolumeAdjustment");
    const factor = parseFloat($select.find(":selected").data("value"));

    $("#ManhourAdjustmentFactor").text(factor.toFixed(2));
  }

}

function adjustment_factor_handlers() {
  calc_shop_per_head();

  //Adjustment Factor change handler
  $(".adjustment-factor").on("change", function() {
    var rank = $(this).data("rank");
    var adjustment_factor_idn = $(this).val();

    load_adjustment_sub_factors_select_element(adjustment_factor_idn, rank);

    $("#AdjustmentSubFactor_" + rank).trigger("change");

    calc_worksheet();
  });

  //Adjustment Sub Factor change handler
  $(".adjustment-sub-factor").on("change", function() {
    var rank = $(this).data("rank");

    set_adjustment_value(rank, "change");

    update_labor_class_subfactors(this, rank);

    calc_worksheet();
  });
}

function update_labor_class_subfactors(Asf, rank) {
  var labor_class_text = "";

  //If labor class adjustment is changed, see if Dry System exists and set labor class to be the same
  if (rank == 500) {
    labor_class_text = $("#AdjustmentSubFactor_500")
      .find(":selected")
      .text();

    $(".adjustment-factor").each(function(i, af) {
      if ($(af).val() == 13) {
        var dry_system_rank = $(af).data("rank");

        $("#AdjustmentSubFactor_" + dry_system_rank + " option").each(function(
          j,
          asf
        ) {
          if (labor_class_text === $(asf).text()) {
            $("#AdjustmentSubFactor_" + dry_system_rank).val($(asf).val());
          }
        });

        set_adjustment_value(dry_system_rank, "change");
      }
    });
  } else {
    //If Dry System(adjustment factor) Labor Class(adjustment subfactor) is changed, update Labor Class Adjustment Labor Class
    if ($("#AdjustmentFactor_" + rank).val() == 13) {
      labor_class_text = $(Asf)
        .find(":selected")
        .text();

      $("#AdjustmentSubFactor_500 option").each(function(k, asf) {
        if (labor_class_text === $(asf).text()) {
          $("#AdjustmentSubFactor_500").val($(asf).val());
        }
      });

      //$("#AdjustmentSubFactor_500").trigger("change");
      set_adjustment_value("500", "change");
    }
  }
}

function assembly_handlers() {
  //Assembly name click to show assembly details
  $(".assembly").click(function() {
    let a = $(this);
    let assembly_idn = a.closest("tr").data("productassembly_idn");
    $.get(
      FECI.base_url +
        "worksheet_controller/get_assembly_details/" +
        assembly_idn,
      function(content) {
        a.popover({
          html: true,
          content: content,
          trigger: "manual",
          container: "#WorksheetTable",
          title: function() {
            // console.log($(this).data("title"));
            return (
              $(this).data("title") +
              '<span class="close a-close">&times;</span>'
            );
          }
        }).popover("toggle");
      }
    );
  });

  $(".assembly").on("shown.bs.popover", function(e) {
    let a = $(this);

    $(".a-close").on("click", function(e) {
      a.popover("toggle");
    });
  });
}

function product_assembly_handlers() {
  //Assembly name click to show assembly details
  $(".product-assembly").click(function() {
    const a = $(this);
    const product_assembly_idn = a.closest("tr").data("product_idn");
    $.get(
      FECI.base_url +
        "worksheet_controller/get_product_assembly_children_html/" +
        product_assembly_idn,
      function(content) {
        a.popover({
          html: true,
          content: content,
          trigger: "manual",
          container: "#WorksheetTable",
          title: function() {
            return (
              'Details<span class="close a-close">&times;</span>'
            );
          }
        }).popover("toggle");
      }
    );
  });

  $(".product-assembly").on("shown.bs.popover", function(e) {
    let a = $(this);

    $(".a-close").on("click", function(e) {
      a.popover("toggle");
    });
  });
}


function eq_braces_handler() {
  //Show EQ Brace calculation details
  $("#EQPopover").click(function(e) {
    var a = $(this);
    $.get(
      FECI.base_url +
        "worksheet_controller/get_eq_braces/" +
        FECI.job.job_number,
      function(content) {
        a.popover({
          html: true,
          content: content,
          container: "#WorksheetTable",
          trigger: "manual",
          title: function() {
            return (
              $(this).data("title") +
              '<span class="close eq-close">&times;</span>'
            );
          }
        }).popover("toggle");
      }
    );
  });

  $("#EQPopover").on("shown.bs.popover", function(e) {
    let eqPopover = $(this);

    $(".eq-close").on("click", function(e) {
      eqPopover.popover("toggle");
    });

    //Bind events to elements on EQ Popover
    monitor_change_handler("MainPipeDenominator");
    select_event_handler();

    $("#MainPipeDenominator").blur(function(e) {
      check_num0(this, "highlight");
    });

    $("#MainPipeDenominator").on("change", function(e) {
      //calculate Eq Brace quantity
      let pipe = 0;
      let pipe_denominator = 0;
      let fittings = 0;
      let eq_qty = 0;

      pipe = parseInt(strip_comma($("#MainPipe").text()));
      pipe_denominator = parseInt(strip_comma($("#MainPipeDenominator").val()));
      fittings = parseInt(strip_comma($("#MainFittings").text()));

      //Make sure values are numbers
      if (
        isNaN(pipe) === false &&
        isNaN(pipe_denominator) === false &&
        isNaN(fittings) === false
      ) {
        eq_qty = Math.round(pipe / pipe_denominator) + fittings;

        $("#EQBraceQty").text(number_format(eq_qty, 0, ","));
      }
    });

    $("#CopyEQBraceQty").on("click", function(e) {
      let eq_qty = 0;

      eq_qty = parseInt(strip_comma($("#EQBraceQty").text()));

      $("#QtyProduct_2489")
        .val(eq_qty)
        .trigger("change");
    });
  });
}

function open_delete_worksheet_modal() {
  //Load dialog body
  $("#delete_worksheet_modal .modal-body p").html(
    "Are you sure you want to delete this worksheet?"
  );

  //Show modal dialog
  $("#delete_worksheet_modal").modal("show");
}

function delete_worksheet(worksheet_idn) {
  //Get token for post submission
  //var feapps_token = $("input[name=" + FECI.token + "]").val();

  //abort any pending request
  if (FECI.request) {
    FECI.request.abort();
  }

  FECI.request = $.ajax({
    url:
      FECI.base_url +
      "worksheet_controller/delete_worksheet_ajax/" +
      worksheet_idn,
    type: "POST",
    dataType: "json",
    data: ""
  });

  // callback handler that will be called on success
  FECI.request.done(function(response) {
    if (response.return_code == 1) {
      //Redirect to parent worksheet
      if (FECI.worksheet.ParentWorksheet_Idn > 0) {
        //Go to parent worksheet
        window.location.href =
          FECI.base_url +
          "job/worksheet/" +
          FECI.worksheet.ParentWorksheet_Idn +
          "?message=" +
          response.message +
          "&message_type=" +
          response.return_code;
      } else {
        //Go to main recap page
        window.location.href =
          FECI.base_url +
          "job/recap/" +
          FECI.job.job_number +
          "?message=" +
          response.message +
          "&message_type=" +
          response.return_code;
      }
    } else {
      //Display message
      displayMessageBox(response.message, "info");
    }
  });

  // callback handler that will be called on failure
  FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
    // log the error to the console
    console.error("The following error occured: " + textStatus, errorThrown);
  });
}

function validate_worksheet() {
  //Declare and initialize variables
  var wls = $(".worksheet_line");
  var id = 0;
  var is_valid = true;

  //Check Finish Work on Cross Mains and Lines recap
  if (FECI.worksheet_master.WorksheetMaster_Idn == 32) {
    if ($("#NoFinishWork").prop("checked") === false) {
      let sumQty = 0;
      //Sum Finish work quantities
      $(".finish-work .quantity").each(function () {
        sumQty += parseFloat(strip_comma($(this).val()));
      });

      if (sumQty === 0) {
        alert("Please add 'Finish Work' or check 'No Finish Work'!");
        is_valid = false;
      }
    }
  }

  //Subcontract worksheets
  if (FECI.worksheet_master.IsSubcontractWorksheet == 1) {
    //Make sure radio button is selected for subcontract worksheets
    $.each(wls, function(index, wl) {
      id = wl.id;
      if ($("input[name=Sub" + id + "]").is(":checked") == false) {
        alert("Please select Sub.");
        is_valid = false;
      }
    });
  }

  return is_valid;
}

function calc_worksheet() {
  const wls = $(".worksheet_line");
  let qty = 0;
  let mat = 0,
    mat_ext = 0,
    mat_total = 0;
  let field = 0,
    field_ext = 0,
    field_hours_total = 0,
    field_total = 0;
  let shop = 0,
    shop_ext = 0,
    shop_hours_total = 0,
    shop_total = 0;
  let engineer = 0,
    engineer_ext = 0,
    engineer_hours_total = 0,
    engineer_total = 0;
  let low_sub_total = 0,
    high_sub_total = 0,
    bonded_total = 0;
  let low_sub_ext = 0,
    high_sub_ext = 0,
    bonded_ext = 0;
  let w_col = 0;
  let is_misc = 0,
    is_child_worksheet = 0;
  let bonded_markup = 0;
  let id = "",
    row_id = "",
    row_type = "";
  let $Qty,
    $MaterialUnitPrice,
    $FieldUnitPrice,
    $ShopUnitPrice,
    $EngineerUnitPrice;
  let total_heads = 0,
    is_head = 0;
  let apply_adjustment_factors_total = 0,
    do_not_apply_adjustment_factors = 0;
  let num_decimals = 0;

  $.each(wls, function(index, wl) {
    //Set values
    id = wl.id;
    row_type = id.substring(0, id.indexOf("_"));
    row_id = id.substring(id.indexOf("_") + 1);
    is_misc = row_type === "Miscellaneous" ? 1 : 0;
    is_child_worksheet = row_type === "Worksheet" ? 1 : 0;
    is_head = $(wl).hasClass("head") ? 1 : 0;

    //Cache DOM
    $Qty = $("#Qty" + id);
    $MaterialUnitPrice = $("#MaterialUnitPrice" + id);
    $FieldUnitPrice = $("#FieldUnitPrice" + id);
    $ShopUnitPrice = $("#ShopUnitPrice" + id);
    $EngineerUnitPrice = $("#EngineerUnitPrice" + id);

    //Set more values
    qty = $Qty.is("input") ? $Qty.val() : $Qty.html();
    qty = parseFloat(strip_comma(qty));

    //Total heads on worksheet
    if (is_head === 1) {
      total_heads += qty;
    }

    mat = 0;
    mat_ext = 0;
    if ($MaterialUnitPrice.length > 0) {
      mat = $MaterialUnitPrice.is("input")
        ? $MaterialUnitPrice.val()
        : $MaterialUnitPrice.html();
      mat = parseFloat(strip_comma(mat));
      mat_ext = parseFloat(precise_round(qty * mat, 2));
    }

    engineer = 0;
    engineer_ext = 0;
    if ($EngineerUnitPrice.length > 0) {
      engineer = $EngineerUnitPrice.is("input")
        ? $EngineerUnitPrice.val()
        : $EngineerUnitPrice.html();
      engineer = parseFloat(strip_comma(engineer));
      engineer_ext = parseFloat(precise_round(qty * engineer, 2));
    }

    //Subcontract
    if (FECI.worksheet_master.IsSubcontractWorksheet == 1) {
      (low_sub_ext = 0), (high_sub_ext = 0), (bonded_ext = 0);

      //is_misc = ($(wl).data("IsMiscellaneousDetail") === "1") ? 1 : 0;

      if (is_misc == 1) {
        //Enable Bonded elements
        $("#Bonded" + id).prop("disabled", false);
        $("#BondedMarkup" + id).prop("disabled", false);
      } else {
        //Disable Bonded elements
        $("#Bonded" + id).prop("disabled", true);
        $("#BondedMarkup" + id).prop("disabled", true);
      }

      if (!isNaN(qty) && !isNaN(mat)) {
        //Determine Worksheet Column
        w_col = $("input:radio[name='Sub" + id + "']:checked").val();

        //Totals based on worksheet column
        switch (w_col) {
          case "2": //Low Sub
            low_sub_total += mat_ext;
            low_sub_ext = mat_ext;
            break;
          case "3": //High Sub
            high_sub_total += mat_ext;
            high_sub_ext = mat_ext;
            break;
          case "1": //Bonded
            bonded_total += mat_ext;
            bonded_ext = mat_ext;
            break;
        }

        //Format and set values
        $("#LowSubExtended" + id).html(number_format(low_sub_ext, 2, ","));
        $("#HighSubExtended" + id).html(number_format(high_sub_ext, 2, ","));
        $("#BondedExtended" + id).html(number_format(bonded_ext, 2, ","));

        //Bonded Markup is enabled, then format
        if ($("#BondedMarkup" + id).is(":disabled") === false) {
          bonded_markup = parseFloat(
            strip_comma($("#BondedMarkup" + id).val())
          );
          $("#BondedMarkup" + id).val(number_format(bonded_markup, 1, ","));
        }
      } else {
        return false;
      }
    } else {
      ///////////// NORMAL WORKSHEETS /////////////////////
      if ($MaterialUnitPrice.length > 0) {
        //Set Material Unit Price
        mat_total += mat_ext;
        $("#MaterialUnitPriceExtended" + id).html(
          number_format(mat_ext, 2, ",")
        );
      }

      //If field amounts exist on worksheet
      if ($FieldUnitPrice.length > 0) {
        field = $FieldUnitPrice.is("input")
          ? $FieldUnitPrice.val()
          : $FieldUnitPrice.html();
        num_decimals = (parseInt(FECI.worksheet.WorksheetMaster_Idn) === 2) ? 3 : 2;
        field = parseFloat(strip_comma(field));
        field_ext = parseFloat(precise_round(qty * field, num_decimals));
        field_hours_total += field_ext;

        //Determine if field labor total should be applied to adjustment factors
        if ($(wl).data("applytoadjustmentfactorsflag") == "1") {
          apply_adjustment_factors_total += field_ext;
        } else {
          do_not_apply_adjustment_factors += field_ext;
        }

        //Format and set field unit price fields
        if ($FieldUnitPrice.is("input")) {
          $FieldUnitPrice.val(number_format(field, num_decimals, ","));
        } else {
          $FieldUnitPrice.html(number_format(field, num_decimals, ","));
        }
        $("#FieldUnitPriceExtended" + id).html(
          number_format(field_ext, num_decimals, ",")
        );
      }

      //If shop amounts exist on worksheet
      if ($ShopUnitPrice.length > 0) {
        shop =
          is_child_worksheet == 0
            ? parseFloat(strip_comma($ShopUnitPrice.val()))
            : parseFloat(strip_comma($ShopUnitPrice.html()));
        shop_ext = parseFloat(precise_round(qty * shop, 2));
        shop_hours_total += shop_ext;

        //Format and set shop unit price
        if (is_child_worksheet == 0) {
          $ShopUnitPrice.val(number_format(shop, 2, ","));
        } else {
          $ShopUnitPrice.html(number_format(shop, 2, ","));
        }
        $("#ShopUnitPriceExtended" + id).html(number_format(shop_ext, 2, ","));
      }

      if ($EngineerUnitPrice.length > 0) {
        engineer = $EngineerUnitPrice.is("input")
          ? $EngineerUnitPrice.val()
          : $EngineerUnitPrice.html();
        engineer = parseFloat(strip_comma(engineer));
        engineer_ext = parseFloat(precise_round(qty * engineer, 2));
        engineer_hours_total += engineer_ext;

        //Format and set engineer unit price
        $EngineerUnitPrice.val(number_format(engineer, 2, ","));
        $("#EngineerUnitPriceExtended" + id).html(
          number_format(engineer_ext, 2, ",")
        );
      }
    }

    //Format fields
    $Qty.val(number_format(qty, 1, ","));

    if ($MaterialUnitPrice.length > 0) {
      if (is_child_worksheet == 0) {
        $MaterialUnitPrice.val(number_format(mat, 2, ","));
      } else {
        $MaterialUnitPrice.html(number_format(mat, 2, ","));
      }
    }
  });

  //Display totals
  if (FECI.worksheet_master.IsSubcontractWorksheet == 1) {
    $("#LowSubTotal").html(number_format(Math.ceil(low_sub_total), 0, ","));
    $("#HighSubTotal").html(number_format(Math.ceil(high_sub_total), 0, ","));
    $("#BondedTotal").html(number_format(Math.ceil(bonded_total), 0, ","));
  } else {
    //Non subcontract worksheets
    $("#MaterialTotal").html(number_format(Math.ceil(mat_total), 0, ","));

    //Calculate Adjustment factors
    if (FECI.worksheet_master.DisplayAdjustmentFactors == 1) {
      //Set Subtotal
      $("#FieldHoursSubtotal").html(number_format(field_hours_total, 2, ","));

      //Apply adjustment factors on worksheet
      //field_hours_total = apply_adjustment_factors(field_hours_total, $(".adjustment-factor-value"));
      field_hours_total =
        apply_adjustment_factors(
          apply_adjustment_factors_total,
          $(".adjustment-factor-value")
        ) + do_not_apply_adjustment_factors;

      //console.log(apply_adjustment_factors_total + " " + do_not_apply_adjustment_factors);
    }

    //DisplayManhourAdjustment
    if (FECI.worksheet_master.DisplayManhourAdjustment == 1) {
      //Set Subtotal
      $("#FieldHoursSubtotal").html(number_format(field_hours_total, 2, ","));

      determine_volume_adjustment();

      //Get manhour Adjustment Factor
      var manhour_adjustment_factor = parseFloat(
        $("#VolumeAdjustment option:selected").data("value")
      );
      //Calculate Manhour adjustment
      field_hours_total = field_hours_total * manhour_adjustment_factor;
    }

    //Check for user field hours
    if (
      $("#UserFieldHours").length > 0 &&
      $("#UserFieldHours").is(":hidden") == false
    ) {
      //Get user field hours and round up to nearest dollar
      field_hours_total = Math.ceil(
        parseFloat(strip_comma($("#UserFieldHours").val()))
      );
      //Format User Field Hours
      $("#UserFieldHours").val(number_format(field_hours_total, 0, ","));
    }

    //Total field amount($)
    if (FECI.worksheet_master.WorksheetMaster_Idn == 9) {
      //Display field hours total only for Branch line worksheets
      $("#FieldHoursTotal").html(number_format(field_hours_total, 2, ","));
    } else if (parseInt(FECI.worksheet_master.WorksheetMaster_Idn) === 7) {
      //SH Engineer
      $("#FieldHoursTotal").html(number_format(engineer_hours_total, 2, ","));
      engineer_total = Math.ceil(
        Math.ceil(engineer_hours_total) * FECI.job.design_labor_rate
      );
      $("#EngineerTotal").html(number_format(engineer_total, 0, ","));
    } else {
      field_total = Math.ceil(
        Math.ceil(field_hours_total) * FECI.job.field_labor_rate
      );

      $("#FieldHoursTotal").html(
        number_format(Math.ceil(field_hours_total), 0, ",")
      );
      $("#FieldTotal").html(number_format(field_total, 0, ","));
    }

    if (
      FECI.worksheet_master.DisplayShopHours == 1 ||
      FECI.worksheet_master.DisplayUserShopHoursOnly == 1
    ) {
      //Check for user shop hours
      if (
        $("#UserShopHours").length > 0 &&
        $("#UserShopHours").is(":hidden") == false
      ) {
        //Get user shop hours and round up to nearest dollar
        shop_hours_total = Math.ceil(
          parseFloat(strip_comma($("#UserShopHours").val()))
        );
        //Format User Shop Hours
        $("#UserShopHours").val(number_format(shop_hours_total, 0, ","));
      }

      shop_total = Math.ceil(
        Math.ceil(shop_hours_total) * FECI.job.shop_labor_rate
      );

      $("#ShopHoursTotal").html(
        number_format(Math.ceil(shop_hours_total), 0, ",")
      );
      $("#ShopTotal").html(number_format(shop_total, 0, ","));
    }

    if (FECI.worksheet_master.WorksheetMaster_Idn == 32) {
      $("#TotalHeads").html(number_format(total_heads, 1, ","));
    }
  }

  //Display total heads, if it exists on worksheet
  if ($("#NumHeads").length) {
    calc_heads(total_heads, mat_total, field_hours_total);
  }
}

function save_worksheet(form) {
  //Delcare and initialize variables
  //var form = this;
  var serialized_data = $(form).serialize();
  var inputs = $(form).find("input, select, button");
  var messageType = "";

  //Add worksheet name to serialized data, if it's on worksheet
  //if ($("#WorksheetName").length > 0) {
  //    serialized_data += "&WorksheetName=" + $("#WorksheetName").val();
  //}

  //Abort any pending Ajax Requests
  if (FECI.request) {
    FECI.request.abort();
  }

  //Disable form elements
  inputs.prop("disabled", true);

  //AJAX request
  FECI.request = $.ajax({
    url: FECI.base_url + "job/save_worksheet/",
    type: "POST",
    dataType: "json",
    data: serialized_data
  });

  //Success callback handler
  FECI.request.done(function(response, textStatus, jqXHR) {
    //Determine which page to navigate to
    if (response.return_code == 1) {
      refresh_saved_elements();

      if (FECI.submit_button.id == "save_goto_recap") {
        //save and go to recap button clicked
        if (FECI.worksheet.ParentWorksheet_Idn > 0) {
          //go to parent worksheet
          window.location.href =
            FECI.base_url +
            "job/worksheet/" +
            FECI.worksheet.ParentWorksheet_Idn +
            "?message=" +
            response.message +
            "&message_type=" +
            response.return_code;
        } else {
          //go to main recap page
          window.location.href =
            FECI.base_url +
            "job/recap/" +
            FECI.job.job_number +
            "?message=" +
            response.message +
            "&message_type=" +
            response.return_code;
        }
      } else {
        //save button clicked
        messageType = getMessageType(response.return_code);

        displayMessageBox(response.message, messageType);
      }
    }
  });

  //Failure callback handler
  FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
    displayMessageBox("Fatal error saving worksheet: " + errorThrown, "danger");
  });

  //Always callback handler
  FECI.request.always(function() {
    //Enable inputs
    inputs.prop("disabled", false);
  });
}

function delete_products() {
  //Declare and initialize variables
  var feapps_token = $("input[name=" + FECI.token + "]").val();
  var deletes = "";
  var messageType = "";

  //Get checked product_idns
  deletes = $(".delete:checked").serialize();

  //abort any pending request
  if (FECI.request) {
    FECI.request.abort();
  }

  //Ajax call to delete rows
  FECI.request = $.ajax({
    url:
      FECI.base_url +
      "worksheet_controller/delete_products/" +
      FECI.worksheet.Worksheet_Idn +
      "/" +
      FECI.job.job_number +
      "/" +
      FECI.worksheet.WorksheetMaster_Idn,
    type: "POST",
    dataType: "json",
    data: deletes
  });

  // callback handler that will be called on success
  FECI.request.done(function(response) {
    messageType = getMessageType(response.return_code);

    //Display message
    displayMessageBox(response.message, messageType);

    //Hide modal dialog
    $("#delete_products_modal").modal("hide");

    //Remove products from worksheet page
    $.each(response.deleted, function(index, row_id) {
      $("#" + row_id).remove();
    });

    register_feci_handlers();
    arrow_navigation_controller();

    //Recalculate worksheet
    calc_worksheet();
  });

  // callback handler that will be called on failure
  FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
    //Fatal error
    displayMessageBox(
      "Fatal error deleting products: " + textStatus + " " + errorThrown,
      "danger"
    );
    //console.error("The following error occured: " + textStatus, errorThrown);
  });
}

function validate_worksheet_parms() {
  if ($(".sizes:checked").length == 0) {
    displayMessageBox("Please select a Pipe Size.", "warning");
    return false;
  }

  return true;
}

function load_worksheet_parms() {
  //Delcare and initialize variables
  var worksheet_master = {
    wm: FECI.worksheet_master
  };
  var job_parms = {
    jp: FECI.job.job_parms
  };

  var serialized_sizes = $(".worksheet-parm-size").serialize();
  var serialized_parms = $(".worksheet_parms").serialize();
  var serialized_qtys = $("#worksheet input.quantity").serialize();
  var serialized_products = $("#worksheet input.product_id").serialize();
  var serialized_worksheet_master = $.param(worksheet_master);
  var serialized_job_parms = $.param(job_parms);
  var inputs = $("input[type=submit], input[type=button], button");
  var messageType = "";

  //Abort any pending Ajax Requests
  if (FECI.request) {
    FECI.request.abort();
  }

  //Disable form elements
  inputs.prop("disabled", true);

  //AJAX request
  FECI.request = $.ajax({
    url:
      FECI.base_url +
      "worksheet_controller/load_worksheet_parms/" +
      FECI.worksheet.Worksheet_Idn,
    type: "POST",
    dataType: "json",
    data:
      serialized_sizes +
      "&" +
      serialized_parms +
      "&" +
      serialized_qtys +
      "&" +
      serialized_products +
      "&" +
      serialized_worksheet_master +
      "&" +
      serialized_job_parms
  });

  //Success callback handler
  FECI.request.done(function(response, textStatus, jqXHR) {
    var message_text = "";

    if (response.inserts.length > 0) {
      //Construct message
      var is = response.inserts.length == 1 ? "" : "s";
      message_text =
        " " + response.inserts.length + " product" + is + " added.";

      //Insert new items into DOM
      insert_lines_into_worksheet_dom(response.inserts, 0);
    }

    if (response.deletes.length > 0) {
      //remove from worksheet
      var ds = response.deletes.length == 1 ? "" : "s";
      message_text +=
        " " + response.deletes.length + " product" + ds + " deleted.";

      $.each(response.deletes, function(index, product_idn) {
        //Remove product from worksheet
        $("#Product_" + product_idn).remove();
      });
    }

    if (response.inserts.length > 0 || response.deletes.length > 0) {
      //Bind handlers for new DOM
      register_feci_handlers();
      worksheet_row_handlers();

      calc_worksheet();
    }
    messageType = getMessageType(response.return_code);

    displayMessageBox(
      "Worksheet Parameters saved." + message_text,
      messageType
    );
  });

  //Failure callback handler
  FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
    displayMessageBox("Error loading Worksheet Parameters.", "danger");

    //Log the error message
    console.error("The following error occured: " + textStatus, errorThrown);
    //Fatal error
    displayMessageBox(
      "Fatal error loading worksheet parameters: " +
        textStatus +
        " " +
        errorThrown,
      "danger"
    );
  });

  //Always callback handler
  FECI.request.always(function() {
    //Enable inputs
    inputs.prop("disabled", false);
  });
}

function get_selected_worksheet_size_idns() {
  //Declare and initialize variables
  size_idns = [];

  //If there are sizes on worksheet, save them to selected_size_ids array
  if ($(".sizes") !== undefined && $(".sizes").length > 0) {
    $(".sizes").each(function(index) {
      if ($(this).prop("checked") === true) {
        //FECI.selected_worksheet_sizes[i] = $j(this).data("size_value");
        size_idns.push($(this).val());
      }
    });
  }

  return size_idns;
}

function load_adjustment_sub_factors_select_elements() {
  $(".adjustment-sub-factor").each(function() {
    //Declare and Initialize variables
    var rank = $(this).data("rank");
    var selected_value =
      FECI.worksheet.WorksheetFactorDetails[rank]["AdjustmentSubFactor_Idn"];
    var adjustment_factor_idn = $("#AdjustmentFactor_" + rank).val();

    //Cache DOM
    var $adjustment_sub_factor = $("#AdjustmentSubFactor_" + rank);

    load_adjustment_sub_factors_select_element(adjustment_factor_idn, rank);

    //select option
    $adjustment_sub_factor.val(selected_value);

    set_adjustment_value(rank, "load");
  });

  calc_worksheet();
}

function load_adjustment_sub_factors_select_element(
  adjustment_factor_idn,
  rank
) {
  //Cache DOM
  var $adjustment_sub_factor = $("#AdjustmentSubFactor_" + rank);
  var $adjustment_factor = $("#AdjustmentFactor_" + rank);
  var $adjustment_labor_class =
    //Empty select element
    $adjustment_sub_factor.empty();

  //Add empty option to select element
  //$adjustment_sub_factor.append($("<option></option>").val("0").html("").attr("data-value", "0"));

  //Populate select element
  if (
    FECI.adjustment_sub_factors[adjustment_factor_idn] !== undefined &&
    parseInt(rank) > 0 &&
    parseInt(adjustment_factor_idn) > 0
  ) {
    $.each(FECI.adjustment_sub_factors[adjustment_factor_idn], function(
      index,
      sub_factor
    ) {
      $adjustment_sub_factor.append(
        $("<option></option>")
          .val(sub_factor["AdjustmentSubFactor_Idn"])
          .html(sub_factor["Name"])
          .attr("data-value", sub_factor["Value"])
      );
    });
  } else {
    $adjustment_sub_factor.append(
      $("<option></option>")
        .val(0)
        .html("")
        .attr("data-value", 0)
    );

  }

  //If Dry Systems is selected, set Labor Class to the same Labor class as Labor Class Adjustment
  if ($adjustment_factor.find(":selected").val() == 13) {
    //Find selected Labor Class text for Labor Class Adjustments
    var labor_class_text = $("#AdjustmentSubFactor_500")
      .find(":selected")
      .text();

    //Match text with current sub factor
    $("#AdjustmentSubFactor_" + rank + " option").each(function(i, asf) {
      if (labor_class_text === $(asf).text()) {
        $("#AdjustmentSubFactor_" + rank).val($(asf).val());
      }
    });

    set_adjustment_value(rank, "change");
  }
  //trigger change event
  //$adjustment_sub_factor.trigger('change');
}

function set_adjustment_value(rank, event) {
  let intRank = parseInt(rank);

  if (intRank > 0) {
    //Cache DOM
    var $adjustment_value = $("#AdjustmentFactorValue_" + rank);
    var $adjustment_sub_factor = $("#AdjustmentSubFactor_" + rank);

    //Declare Variables
    var adjustment_value = 0;

    //adjustment_value = (adjustment_value === undefined) ? "" : number_format(adjustment_value, 2, ",");

    if (event === "load") {
      if (FECI.worksheet.WorksheetFactorDetails[rank]["UserValueFlag"] == 1) {
        adjustment_value =
          FECI.worksheet.WorksheetFactorDetails[rank]["UserValue"];
      } else {
        adjustment_value = $adjustment_sub_factor
          .find(":selected")
          .data("value");
      }
    } else {
      adjustment_value = $adjustment_sub_factor.find(":selected").data("value");
    }
    adjustment_value = number_format(adjustment_value, 2, "");

    //Set adjustment value
    if ($adjustment_value.is("input")) {
      $adjustment_value.val(adjustment_value);
      if (event === "change") {
        $adjustment_value.data("recent-value", adjustment_value);
        $adjustment_value.data("original-value", adjustment_value);
        $adjustment_value.trigger("change");
      }
    } else {
      $adjustment_value.html(adjustment_value);
    }
  }
}

function get_adjustment_sub_factors() {
  //abort any pending request
  //if (FECI.request) {
  //    FECI.request.abort();
  //}

  FECI.request = $.ajax({
    url: FECI.base_url + "worksheet_controller/get_adjustment_sub_factors",
    type: "POST",
    dataType: "json"
  });

  // callback handler that will be called on success
  FECI.request.done(function(response) {
    FECI.adjustment_sub_factors = response;
    load_adjustment_sub_factors_select_elements();
  });

  // callback handler that will be called on failure
  FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
    // log the error to the console
    console.error("The following error occured: " + textStatus, errorThrown);
  });
}

function determine_volume_adjustment() {
  if ($("#OverrideDefaultManhourAdjustment").is(":checked") === false) {
    var subtotal = parseFloat(strip_comma($("#FieldHoursSubtotal").html()));
    var factor = 0,
      new_factor = 0;
    var hours = 0,
      default_hours = 0;
    var id = 0,
      new_id = 0;
    var $option;

    //Determine default level
    if (subtotal < 200) {
      default_hours = 100;
    } else if (subtotal >= 200 && subtotal < 300) {
      default_hours = 200;
    } else if (subtotal >= 300 && subtotal < 600) {
      default_hours = 300;
    } else if (subtotal >= 600 && subtotal < 1000) {
      default_hours = 600;
    } else if (subtotal >= 1000 && subtotal < 2000) {
      default_hours = 1000;
    } else if (subtotal >= 2000) {
      default_hours = 2000;
    }

    $("#VolumeAdjustment option").each(function() {
      $option = $(this);
      id = $option.val();
      factor = parseFloat($option.data("value"));
      hours = parseInt($option.data("hours"));

      if (hours === default_hours) {
        new_id = id;
        new_factor = factor;
      }
    });

    //Set fields
    $("#VolumeAdjustment").val(new_id);
    $("#ManhourAdjustmentFactor").text(new_factor.toFixed(2));
  } else {
    load_manhour_adjustment_factor();
  }
}

function toggle_volume_adjustment() {
  if ($("#OverrideDefaultManhourAdjustment").is(":checked")) {
    $("#VolumeAdjustment").attr("readonly", false);
  } else {
    $("#VolumeAdjustment").attr("readonly", true);
  }
}

function add_adjustment_factor(worksheet_idn, num_cols) {
  //abort any pending request
  //if (FECI.request) {
  //    FECI.request.abort();
  //}

  FECI.request = $.ajax({
    url:
      FECI.base_url +
      "worksheet_controller/add_adjustment_factor/" +
      worksheet_idn +
      "/" +
      num_cols +
      "/" +
      FECI.worksheet_master.WorksheetMaster_Idn,
    type: "POST",
    dataType: "json"
  });

  // callback handler that will be called on success
  FECI.request.done(function(response) {
    if (response.html != "") {
      //Add HTML above Labor Class Adjustments
      $("#AdjustmentFactorRow_500").before(response.html);

      displayMessageBox("Adjustment Factor added.", "success");

      //Bind event handlers
      adjustment_factor_handlers();
    } else {
      displayMessageBox("Error adding Adjustment Factor!", "danger");
    }
  });

  // callback handler that will be called on failure
  FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
    // log the error to the console
    //Fatal error
    displayMessageBox(
      "Fatal error adding adjustment factor: " + textStatus + " " + errorThrown,
      "danger"
    );
  });
}

function show_add_worksheet_modal(data) {
  //Clear message
  $(".modal-message").html("");

  //Clear WorksheetName
  $("#AddWorksheetName").val("");

  //Set input values
  const copy_flag = typeof data.copy_flag === "undefined" ? 0 : data.copy_flag;
  const action = copy_flag == 0 ? "Add" : "Copy";
  const worksheet_idn = copy_flag == 1 ? data.worksheet_idn : FECI.worksheet.Worksheet_Idn;
  let $row = "";

  $("#AddWorksheetModal #AddWorksheetModal_WorksheetMaster_Idn").val(FECI.worksheet_master.WorksheetMaster_Idn);
  $("#AddWorksheetModal #AddWorksheetModal_ChildWorksheetMaster_Idn").val(data.worksheet_master_idn);
  $("#AddWorksheetModal #AddWorksheetModal_WorksheetArea_Idn").val(data.worksheet_area_idn);
  $("#AddWorksheetModal_Worksheet_Idn").val(worksheet_idn);
  $("#AddWorksheetModal_WorksheetCategory_Idn").val(data.worksheet_category_idn);
  $("#AddWorksheetModal_FieldLaborRate").val(FECI.job.field_labor_rate);

  //Set action text
  $(".AddWorksheetModal_Action").html(action);

  //Only copy for Electronics Division
  //if (parseInt(FECI.job.department_idn) === 1) {
  if (copy_flag === 1) {
    $(".copy-worksheet-checkbox").hide();
    $(".copy-from-job").show();
    $("#CopyFromJob").val(FECI.job.job_number);
    $("#CopyFromJob").trigger("change");
  } else {
    //reset model
    $("#CopyWorksheetCheckbox").prop("checked", false);
    $(".copy-from-job").hide();
    $(".AddWorksheetModal_Action").text("Add");
    if (data.worksheet_master_idn == 9) {
      $(".copy-from-job-branch-line").show();
    }
  }

  //Toggle form groups
  if (data.worksheet_master_idn == 9 && copy_flag == 0) {
    $("#AddWorksheetModal .modal-body .branch-line").removeClass("hide");
  } else {
    $("#AddWorksheetModal .modal-body .branch-line").addClass("hide");
  }

  //Show area dropdown when copying Branchline worksheet
  if (data.worksheet_master_idn == 9 && copy_flag == 1) {
    $("#AddWorksheetArea").parent().removeClass("hide");
  }

  //Empty dynamic select elements
  $("#AddWorksheetPosition").empty();
  $("#AddWorksheetArea").empty();

  //Load Position select element

  //Crossmain
  if (data.worksheet_master_idn == 10) {
    $row = $(".crossmain td a.worksheet");

    //Branch Line
  } else if (data.worksheet_master_idn == 9) {
    $row = $(".branchline" + data.worksheet_area_idn + " td a.worksheet");

    load_areas(false);

    //Set Worksheet Name
    if ($("#AddWorksheet").html() == "Add") {
      update_branch_line_worksheet_name();
    }

    //Set Area
    $("#AddWorksheetArea").val(data.worksheet_area_idn);
  } else {
    $row = $(".WorksheetCategory" + data.worksheet_category_idn + " td a.worksheet");
  }

  load_worksheet_position($row);

  //Show modal
  $("#AddWorksheetModal").modal("show");
}

function apply_adjustment_factors(field_hours, factor_values) {
  if (field_hours !== undefined && factor_values !== undefined) {
    var value = 0;
    $.each(factor_values, function(index, factor_value) {
      value = $(factor_value).is("input")
        ? $(factor_value).val()
        : $(factor_value).text();
      if (value !== "" && parseFloat(value) > 0) {
        field_hours = precise_round(field_hours * parseFloat(value), 2);
      }
    });

    return field_hours;
  }
}

function add_worksheet($form) {
  if (typeof $form === "object") {
    //Display message
    $(".modal-message").html("Adding worksheet...");

    var form_data = $form.serialize();
    var child_worksheet_master_idn = $(
      "#AddWorksheetModal_ChildWorksheetMaster_Idn"
    ).val();
    var worksheet_area_idn = $("#AddWorksheetModal_WorksheetArea_Idn").val();
    var $row = "";

    //abort any pending request
    if (FECI.request) {
      FECI.request.abort();
    }

    FECI.request = $.ajax({
      url: FECI.base_url + "worksheet_controller/add_worksheet",
      type: "POST",
      data: form_data,
      dataType: "json"
    });

    // callback handler that will be called on success
    FECI.request.done(function(response) {
      var html = response.html;

      if (response.after == "top") {
        //Crossmain
        if (child_worksheet_master_idn == "10") {
          $("#CrossmainBody").prepend(html);
        } else {
          //Branchline
          $("#WorksheetArea_" + worksheet_area_idn).after(html);
        }
      } else if (response.after == "bottom") {
        //Crossmain
        if (child_worksheet_master_idn == "10") {
          if ($("#CrossmainBody .crossmain-misc").length == 0) {
            $("#CrossmainBody").append(html);
          } else {
            $(
              "#" + $("#CrossmainBody .crossmain-misc:first").attr("id")
            ).before(html);
          }
        } else {
          //Branch line
          if ($(".branchline" + worksheet_area_idn).length > 0) {
            $(
              "#" + $(".branchline" + worksheet_area_idn + ":last").attr("id")
            ).after(html);
          } else {
            $("#WorksheetArea_" + worksheet_area_idn).after(html);
          }
        }
      } else {
        //After another worksheet
        $("#Worksheet_" + response.after).after(html);
      }

      //Get section of rows to build position drop down
      if (child_worksheet_master_idn == 10) {
        $row = $(".crossmain td a.worksheet");
      } else if (child_worksheet_master_idn == 9) {
        //Branch Line

        $row = $(".branchline" + worksheet_area_idn + " td a.worksheet");
      }

      load_worksheet_position($row);
      worksheet_row_handlers();
      calc_worksheet();

      $(".modal-message").html("Worksheet added.");
    });

    // callback handler that will be called on failure
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      $(".modal-message").html("Error adding worksheet.");
      // log the error to the console
      console.error(
        "The following error occured with add_worksheet: " + textStatus,
        errorThrown
      );
    });
  }
}

function add_area($form) {
  if (typeof $form === "object") {
    //Display message
    $(".modal-message").html("Adding area...");

    var form_data = $form.serialize();
    var $row = "";

    //abort any pending request
    if (FECI.request) {
      FECI.request.abort();
    }

    FECI.request = $.ajax({
      url: FECI.base_url + "worksheet_controller/add_area",
      type: "POST",
      data: form_data,
      dataType: "json"
    });

    // callback handler that will be called on success
    FECI.request.done(function(response) {
      var html = response.html;

      if (response.after == "top") {
        $("#BranchlineBody").prepend(html);
      } else if (response.after == "bottom") {
        $("#BranchlineBody").append(html);
      } else {
        //After area
        if ($(".branchline" + response.after).length > 0) {
          $("#" + $(".branchline" + response.after + ":last").attr("id")).after(
            html
          );
        } else {
          $("#WorksheetArea_" + response.after).after(html);
        }
      }

      load_areas(true);
      worksheet_row_handlers();
      crossmains_lines_handlers();

      $(".modal-message").html("Area added.");
    });

    // callback handler that will be called on failure
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      $(".modal-message").html("Error adding area.");
      // log the error to the console
      console.error(
        "The following error occured with add_area: " + textStatus,
        errorThrown
      );
    });
  }
}

function copy_worksheet($form) {
  if (typeof $form === "object") {
    //Display message
    $(".modal-message").html("Copying worksheet...");

    var form_data = $form.serialize();
    var child_worksheet_master_idn = $("#AddWorksheetModal_ChildWorksheetMaster_Idn").val();
    //var worksheet_area_idn = $("#AddWorksheetModal_WorksheetArea_Idn").val();
    var worksheet_area_idn = $("#AddWorksheetArea").val();
    var worksheet_category_idn = $("#AddWorksheetModal_WorksheetCategory_Idn").val();
    var $row = "";

    //abort any pending request
    if (FECI.request) {
      FECI.request.abort();
    }

    FECI.request = $.ajax({
      url: FECI.base_url + "worksheet_controller/copy_worksheet",
      type: "POST",
      data: form_data,
      dataType: "json"
    });

    // callback handler that will be called on success
    FECI.request.done(function(response) {
      var html = response.html;

      if (response.after == "top") {
        //Crossmain
        if (child_worksheet_master_idn == "10") {
          $("#CrossmainBody").prepend(html);
        } else if (child_worksheet_master_idn == "9") {
          //Branchline
          $("#WorksheetArea_" + worksheet_area_idn).after(html);
        } else {
          $("#Category" + worksheet_category_idn).after(html);
        }
      } else if (response.after == "bottom") {
        //Crossmain
        if (child_worksheet_master_idn == "10") {
          if ($("#CrossmainBody .crossmain-misc").length == 0) {
            $("#CrossmainBody").append(html);
          } else {
            $(
              "#" + $("#CrossmainBody .crossmain-misc:first").attr("id")
            ).before(html);
          }
        } else if (child_worksheet_master_idn == "9") {
          //Branch line
          if ($(".branchline" + worksheet_area_idn).length > 0) {
            $(
              "#" + $(".branchline" + worksheet_area_idn + ":last").attr("id")
            ).after(html);
          } else {
            $("#WorksheetArea_" + worksheet_area_idn).after(html);
          }
        } else {
          const last = $("#" + $(".WorksheetCategory" + worksheet_category_idn + ":last").attr("id"));

          if (last.length === 0) {
            const categoryRow = $(`#Category${worksheet_category_idn}`);
            categoryRow.after(html);
          } else {
            last.after(html);
          }
         
        }
      } else {
        //After another worksheet
        $(`#Worksheet_${response.after}`).after(html);
      }

      //Get section of rows to build position drop down
      if (child_worksheet_master_idn == 10) {
        $row = $(".crossmain td a.worksheet");
      } else if (child_worksheet_master_idn == 9) {
        //Branch Line

        $row = $(".branchline" + worksheet_area_idn + " td a.worksheet");
      } else {
        $row = $(
          ".WorksheetCategory" + worksheet_category_idn + " td a.worksheet"
        );
      }

      load_worksheet_position($row);
      worksheet_row_handlers();
      calc_worksheet();

      $(".modal-message").html("Worksheet copied.");
    });

    // callback handler that will be called on failure
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      $(".modal-message").html("Error copying worksheet.");
      // log the error to the console
      console.error(
        "The following error occured with copy_worksheet: " + textStatus,
        errorThrown
      );
    });
  }
}

function load_worksheet_position($row) {
  //Declare and initialize variables
  var worksheet_name = "";
  var worksheet_idn = "";

  //Cache DOM
  var $add_worksheet_position = $("#AddWorksheetPosition");

  //Empty Position select element
  $add_worksheet_position.empty();

  //Add "At the Bottom" option
  $add_worksheet_position.append(
    $("<option></option>")
      .val("bottom")
      .html("At the Bottom")
  );

  //Add 'Top' option
  $add_worksheet_position.append(
    $("<option></option>")
      .val("top")
      .html("At the Top")
  );

  //Add option for each crossmain worksheet
  $row.each(function() {
    worksheet_name = $(this).text();
    worksheet_idn = $(this).data("worksheet_idn");

    //Add to Position select element
    $add_worksheet_position.append(
      $("<option></option>")
        .val(worksheet_idn)
        .html("After " + worksheet_name)
    );
  });
}

function load_areas(is_position) {
  //Declare and initialize variables
  var area_name = "";
  var area_idn = "";
  var $worksheet_area = is_position
    ? $("#NewAreaPosition")
    : $("#AddWorksheetArea");

  //Empty element
  $worksheet_area.empty();

  //Add "At the Top" and "At the Bottom"
  if (is_position) {
    $worksheet_area.append(
      $("<option></option>")
        .val("bottom")
        .html("At the Bottom")
    );
    $worksheet_area.append(
      $("<option></option>")
        .val("top")
        .html("At the Top")
    );
  }

  //populate Area select element
  $("tr.worksheet-area .area-name").each(function() {
    area_name = is_position ? "After " + $(this).text() : $(this).text();
    area_idn = $(this).data("worksheet_area_idn");

    //Add to Position select element
    $worksheet_area.append(
      $("<option></option>")
        .val(area_idn)
        .html(area_name)
    );
  });
}

function add_miscellaneous_item(el) {
  var source = parseInt($(el).data("source"));
  var worksheet_area_idn = source == 138 ? $(el).val() : 0;
  var finish_work = [];

  //Load finish work idns into an array
  $.each($(".finish-work"), function(index, row) {
    finish_work.push($(row).data("finish_work_idn"));
  });

  //Load data for AJAX call
  var misc_data = {
    WorksheetCategory_Idn: source,
    Value: $(el).val(),
    Worksheet_Idn: FECI.worksheet.Worksheet_Idn,
    WorksheetArea_Idn: worksheet_area_idn,
    FinishWork: finish_work
  };

  //abort any pending request
  if (FECI.request) {
    FECI.request.abort();
  }

  FECI.request = $.ajax({
    url: FECI.base_url + "worksheet_controller/add_miscellaneous_handler",
    type: "POST",
    data: misc_data,
    dataType: "json"
  });

  // callback handler that will be called on success
  FECI.request.done(function(response) {
    var html = response.html;

    switch (source) {
      case "139": //Crossmain
      case 139:
        $("#CrossmainBody").append(html);
        break;
      case "138": //Branchline Area
      case 138:
        if ($(".branchline-misc" + worksheet_area_idn).length > 0) {
          $(
            "#" +
              $(".branchline-misc" + worksheet_area_idn + ":last").attr("id")
          ).after(html);
        } else if ($(".branchline" + worksheet_area_idn).length > 0) {
          $(
            "#" + $(".branchline" + worksheet_area_idn + ":last").attr("id")
          ).after(html);
        } else {
          $("#WorksheetArea_" + worksheet_area_idn).after(html);
        }
        break;
      case "108":
      case 108:
        $("#Miscellaneous").append(html);
        break;
      case "140":
      case 140:
        $.each(html, function(index, h) {
          $("#FinishWork").append(h);
        });
        break;
    }

    calc_worksheet();
    worksheet_row_handlers();

    displayMessageBox("Miscellaneous item added.", "success");
  });

  // callback handler that will be called on failure
  FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
    $(".modal-message").html("Error adding area.");
    // log the error to the console
    //console.error("The following error occured with add_miscellaneous: " + textStatus, errorThrown);
  });
}

function select_zero_quantity_items() {
  //Declare and initialize variables
  var select_zero_checked = true;
  var qty_is_zero = false;
  var product_idn = 0;

  //Check or uncheck all .select_zero_quantities checkboxes
  $(".select_zero_quantities").prop("checked", select_zero_checked);

  //Iterate selectable products
  $.each($(".delete"), function(index, delete_checkbox) {
    //Get product_idn
    product_idn = $(this).val();

    //Check to see if quantity is zero
    qty_is_zero = $("#Qty" + product_idn).val() == 0 ? true : false;

    //Check product if quantity is zero and select_zero_quantities is also checked, if not uncheck
    if (select_zero_checked) {
      $(this).prop("checked", qty_is_zero);
    } else {
      $(this).prop("checked", false);
    }
  });
}

function update_branch_line_worksheet_name() {
  var head_type = $("#HeadType option:selected").text();
  var coverage_type = $("#CoverageType option:selected").text();
  $("#AddWorksheetName").val(head_type + " - " + coverage_type);
}

function calc_heads(total_heads, mat_total, field_hours_total) {
  var material_per_head = 0;
  var field_per_head = 0;

  //Total Heads
  $("#NumHeads").html(number_format(total_heads, 1, ","));

  total_heads = parseFloat(precise_round(total_heads, 1));

  //Material per head
  material_per_head = total_heads == 0 ? 0 : parseFloat(Math.ceil(mat_total)) / total_heads;
  $("#MaterialPerHead").html(number_format(precise_round(material_per_head, 2), 2, ","));

  //Field per head
  field_per_head = (total_heads == 0) ? 0 : parseFloat(precise_round(field_hours_total, 2)) / total_heads;
  $("#FieldHoursPerHead").html(number_format(precise_round(field_per_head, 2), 2, ","));
}

function calc_shop_per_head() {
  let factor = 0;
  let multiplier = 0;
  let shop_per_head = 0;

  factor = parseFloat(
    $("#ShopFabrication")
      .find(":selected")
      .data("factor")
  );
  multiplier = parseFloat(
    $("#ShopFabricationMultiplier")
      .find(":selected")
      .data("multiplier")
  );
  shop_per_head = precise_round(factor * multiplier, 2);

  //if user selects CVPC, default ShopFabricationMultiplier to blank
  if ($("#ShopFabrication").val() == 5) {
    $("#ShopFabricationMultiplier").val("0");
  } else {
    $("#ShopFabricationMultiplier").val("1");
  }

  shop_fab_handlers();

  $("#ShopHoursPerHead").html(number_format(shop_per_head, 2, ","));
}

function insert_lines_into_worksheet_dom(inserts, worksheet_category_idn) {
  var insert_rank = 0,
    current_rank = 0,
    next_rank = 0;
  var last_row_id = "",
    $next_row = "";
  var $existing_rows = [];

  $.each(inserts, function(index, insert) {
    //Determine worksheet category, if 0 or empty
    if (
      typeof insert.WorksheetCategory_Idn != "undefined" &&
      (worksheet_category_idn == 0 ||
        worksheet_category_idn == "" ||
        worksheet_category_idn != insert.WorksheetCategory_Idn)
    ) {
      worksheet_category_idn = insert.WorksheetCategory_Idn;
    }

    //Determine id of last row of category section
    last_row_id = $(".WorksheetCategory" + worksheet_category_idn)
      .last()
      .attr("id");

    if (last_row_id === undefined) {
      $("#Category" + worksheet_category_idn).after(insert.Html);
    } else {
      /////////////////////////////
      //Find insertion spot
      /////////////////////////////
      //new inserted record rank
      insert_rank = parseFloat(insert.CategoryProductRank);

      //iterate over existing rows in category
      $existing_rows = $(".WorksheetCategory" + worksheet_category_idn);
      $.each($existing_rows, function(i, row) {
        current_rank = parseFloat($(row).data("categoryproductrank"));
        $next_row = $($existing_rows[i + 1]);
        next_rank = parseFloat($next_row.data("categoryproductrank"));

        //For first row only
        if (
          i === 0 &&
          (insert_rank < current_rank || //if insert rank is less than current rank
          $(row).data("ismiscellaneousdetail") == 1 || //If current row is misc
          $(row).data("ischildworksheet") == 1 || //If current row is child worksheet
            $(row).data("productassembly_idn") != 0) //if current row is assembly
        ) {
          //Insert new row into DOM BEFORE current row
          $("#" + row.id).before(insert.Html);

          //break out of each statement
          return false;
        }

        if (
          $next_row.data("ismiscellaneousdetail") == 1 || //If next row is miscellaneous
          $next_row.data("ischildworksheet") == 1 || //If next row is child worksheet
          $next_row.data("productassembly_idn") != 0 || //if next row is assembly
          i + 1 == $existing_rows.length || //if this is the last row in category
          (insert_rank >= current_rank && insert_rank < next_rank) //If insert rank is equal to or greater than current rank and less than next rank
        ) {
          //Insert new row into DOM AFTER current row
          $("#" + row.id).after(insert.Html);

          //break out of each statement
          return false;
        }
      });
    }
  });
}

function validate_create_worksheet() {
  //Job number is required
  if (
    $("#CopyFromJob").length > 0 &&
    $("#CopyFromJob").is(":visible") &&
    $("#CopyFromJob").val() == ""
  ) {
    $(".modal-message").html("Please enter a valid Job Number!");
    return false;
  }

  //Worksheet name is required
  if ($("#AddWorksheetName").val() === "") {
    $(".modal-message").html("Worksheet Name required");
    return false;
  }

  return true;
}

function shop_fab_handlers() {
  if ($("#ShopFabrication").val() == 5) {
    $("#ShopFabricationMultiplier").prop("disabled", true);
  } else {
    $("#ShopFabricationMultiplier").prop("disabled", false);
  }
}
