var cart = (function() {
  var debug = false;
  var self = this;
  self.category_data = {};

  //Cache DOM
  var $cartModal = $("#cart_modal");

  //Initialize
  cart_init();

  function cart_init() {
    //Shopping cart modal dialog options
    $cartModal.modal({
      show: false,
      backdrop: "static",
      keyboard: false
    });

    //cart results table options
    $(".cart-results-table").DataTable({
      scrollY: "325px",
      scrollCollapse: true,
      paging: false,
      searching: false,
      ordering: false,
      info: false,
      autoWidth: true
    });

    //Fire pumps
    $("#FirePumpsTableModal").modal({
      show: false,
      backdrop: "static",
      keyboard: false
    });
  }

  function shopping_cart_handlers() {
    //Event handler for opening shopping cart
    $(".open-shopping-cart").click(function() {
      if (debug) console.log(".open-shopping-cart");

      var worksheet_category_idn = $(this).data("worksheetcategory_idn");

      //Set active tab
      $('#cart_tabs a[href="#tab' + worksheet_category_idn + '"]').tab("show");

      //Show modal dialog
      $cartModal.modal("toggle", worksheet_category_idn);

      //Toggle group display
      $(".toggle-cart-subgroup").each(function() {
        toggle_cart_subgroup(this, worksheet_category_idn);
      });

      //Clear message
      $(".shopping-cart-message").html("");
    });

    //Riser Type Handlers for shopping cart parms
    $(".riser-type").on("change", function() {
      var worksheet_category_idn = $("#cart_tabs li.active a").data(
        "worksheetcategoryidn"
      );

      riser_usability(worksheet_category_idn);
    });

    //Fitting Type on Riser Nipples
    $("#FittingType96").on("change", function() {
      var worksheet_category_idn = this.id.substring(11);
      var fitting_type = $(this).val();

      get_riser_fittings(worksheet_category_idn, fitting_type);
    });

    //Filter results
    $(".filter-results").on("change", function() {
      var worksheet_category_idn = $("#cart_tabs li.active a").data(
        "worksheetcategoryidn"
      );
      if (debug) console.log("filter-results on change");

      cart_filter(worksheet_category_idn);
    });

    //Shopping cart modal open handler
    $cartModal.on("shown.bs.modal", function(e) {
      var worksheet_category_idn = e.relatedTarget;

      if (debug) console.log("cart_modal shown");

      setup_cart(worksheet_category_idn);
    });

    //Tab click handler
    $('a[data-toggle="tab"]').on("click", function(e) {
      var worksheet_category_idn = $(this).data("worksheetcategoryidn");

      set_cart_defaults(worksheet_category_idn);

      //Do not filter Products tab
      if (parseInt(worksheet_category_idn) !== 141) {
        cart_filter(worksheet_category_idn);
      }

      //Clear message
      $(".shopping-cart-message").html("");
    });

    //Bind change event to elements with toggle-subgroup class to toggle_subgroup function to show or hide sub group element
    $(".toggle-cart-subgroup").on("change", function() {
      var worksheet_category_idn = $("#cart_tabs li.active a").data(
        "worksheetcategoryidn"
      );

      toggle_cart_subgroup(this, worksheet_category_idn);
    });

    $("#InsertProducts").click(function() {
      //Get worksheet_category_idn
      var worksheet_category_idn = $("div.tab-pane.active")
        .attr("id")
        .substr(3);
      var validated = true;

      if (worksheet_category_idn === "114") {
        if (
          $("#DieselFuel114").is(":visible") &&
          $("#DieselFuel114").val() == ""
        ) {
          validated = false;

          $(".shopping-cart-message").html("Please enter 'Diesel Fuel Cost'");
          $("#DieselFuel114").focus();
        }
      }

      //Save shopping cart products
      if (validated) save_cart_products(worksheet_category_idn);
    });

    $("#SearchProductsButton").on("click", function(e) {
      e.preventDefault();

      var worksheet_category_idn = $(this).data("worksheetcategoryidn");

      cart_filter(worksheet_category_idn);
    });

    $(".select-set").on("click", function() {
      var worksheet_category_idn = this.id.substring(9);

      get_fitting_set(worksheet_category_idn);
    });

    //Event handler for opening shopping cart
    $("#ShowFirePumpsTable").click(function() {
      //Show modal dialog
      $("#FirePumpsTableModal").modal("show");
    });
  }

  function register_cart_results_handlers(worksheet_category_idn) {
    select_event_handler();
    original_value_handler();

    //On click for product results table
    $("tr.cart-results-row td").click(function() {
      //Get product id from tr element
      var product_idn = $(this)
        .closest("tr")
        .data("product_idn");
      var is_assembly = $("#IsAssembly" + worksheet_category_idn).val();

      //If clicked td does not contain visible input elements, then toggle checkbox
      if ($(this).find("input").length == 0) {
        var $checkbox = $(
          "#Product" + worksheet_category_idn + "-" + product_idn
        );
        $checkbox.prop("checked", !$checkbox.prop("checked"));
      }

      if (is_assembly == "1") {
        build_assembly(worksheet_category_idn);
      }
    });

    //On change event for quantity input elements
    $("input.results-qty, input.results-assembly-qty").change(function() {
      var is_assembly = $("#IsAssembly" + worksheet_category_idn).val();

      if (check_num1(this, "highlight")) {
        var qty = parseFloat(strip_comma($(this).val()));
        var product_idn = $(this)
          .closest("tr")
          .data("product_idn");
        var $checkbox = $(
          "#Product" + worksheet_category_idn + "-" + product_idn
        );

        //If Quantity is greater than zero, checkbox is checked, if zero uncheck
        if (qty > 0) {
          $checkbox.prop("checked", true);
        } else {
          $checkbox.prop("checked", false);
        }

        //Format quantity
        $(this).val(number_format(qty, 1, ","));
      }

      if (is_assembly == "1") {
        //if (worksheet_category_idn == 96 || worksheet_category_idn == 114) {
        build_assembly(worksheet_category_idn);
      }
    });

    //Build assembly when checkbox is checked or unchecked
    $("input[type='checkbox'] .results-product").change(function() {
      var is_assembly = $("#IsAssembly" + worksheet_category_idn).val();

      if (is_assembly == 1) {
        build_assembly(worksheet_category_idn);
      }
    });

    //Toggle view of Diesel fuel field
    $("input[type=radio][name=FirePumpType114]").on("change", function(e) {
      if ($(this).val() === "2") {
        $("#DieselFuelContainer114").show();
      } else {
        $("#DieselFuelContainer114").hide();
      }
    });

    cart_arrow_navigation_handler(worksheet_category_idn);
  }

  function cart_filter(worksheet_category_idn) {
    const $table_body = $("#cart_table" + worksheet_category_idn + " tbody");

    //Display message while loading data
    $table_body.html(
      '<tr><td><i class="fa fa-circle-o-notch fa-spin"></i> Loading...</td><tr>'
    );

    //var feapps_token = $("input[name=" + FECI.token + "]").val();
    var cart_parms = $("#cart_parms_form" + worksheet_category_idn).serialize();
    var worksheet_parms = $.param(FECI.worksheet);
    var query_string = cart_parms + "&" + worksheet_parms;

    FECI.request = $.ajax({
      url:
        FECI.base_url + "cart_controller/filter_cart/" + worksheet_category_idn,
      type: "POST",
      dataType: "json",
      data: query_string
    });

    // callback handler that will be called on success
    FECI.request.done(function(response) {
      //Load table body with results
      $table_body.html(response.body);

      //Display message
      $("#cart_num_results" + worksheet_category_idn).text(response.message);

      //Adjust DataTable columns
      $("#cart_table" + worksheet_category_idn)
        .DataTable()
        .columns.adjust();

      //Build assembly
      if ($("#IsAssembly" + worksheet_category_idn).val() == "1") {
        build_assembly(worksheet_category_idn);
      }

      //Reinitialize handlers
      register_cart_results_handlers(worksheet_category_idn);
    });

    // callback handler that will be called on failure
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      // log the error to the console
      console.error("The following error occured: " + textStatus, errorThrown);
    });
  }

  function save_cart_products(worksheet_category_idn) {
    //Initiallize and declare variables

    //var feapps_token = $("input[name=" + FECI.token + "]").val();

    //Serialize Data to build query string
    var cart_parms = $("#cart_parms_form" + worksheet_category_idn).serialize();
    var cart_results = $(
      "#cart_results_form" + worksheet_category_idn
    ).serialize();
    var worksheet_parms = $.param(FECI.worksheet);
    //Build Query String
    var query_string =
      cart_parms +
      "&" +
      cart_results +
      "&" +
      worksheet_parms +
      "&IsSubcontractWorksheet=" +
      FECI.worksheet_master.IsSubcontractWorksheet +
      "&DisplayShopHours=" +
      FECI.worksheet_master.DisplayShopHours +
      "&CategoryName=" +
      $("li.active a[role='tab']")
        .html()
        .trim();

    //Message
    $(".shopping-cart-message").html("Saving...");

    //abort any pending request
    if (FECI.request) {
      FECI.request.abort();
    }

    FECI.request = $.ajax({
      url:
        FECI.base_url +
        "cart_controller/save_cart_products/" +
        worksheet_category_idn,
      type: "POST",
      dataType: "json",
      data: query_string
    });

    // callback handler that will be called on success
    FECI.request.done(function(response) {
      //Clear message
      $(".shopping-cart-message").html("");

      //If no changes were made, display "No changes" message
      if (
        response.inserts.length == 0 &&
        response.updates.length == 0 &&
        response.deletes.length == 0 &&
        response.errors.length == 0 &&
        response.misc.Html == ""
      ) {
        $(".shopping-cart-message").html("No changes.");
      }

      //Inserts
      if (response.inserts.length > 0) {
        is = response.inserts.length == 1 ? "" : "s";
        $(".shopping-cart-message").html(
          response.inserts.length + " product" + is + " added."
        );

        insert_lines_into_worksheet_dom(
          response.inserts,
          worksheet_category_idn
        );
      }

      //Updates
      if (response.updates.length > 0) {
        us = response.updates.length == 1 ? "" : "s";
        $(".shopping-cart-message").append(
          " " + response.updates.length + " product" + us + " updated."
        );

        //Update quantity on worksheet
        $.each(response.updates, function(index, row) {
          $("#Qty" + row.RowType + "_" + row.Product_Idn).val(row.Quantity);

          //Trigger change event
          $("#Qty" + row.RowType + "_" + row.Product_Idn).trigger("change");
        });
      }

      //Deletes
      if (response.deletes.length > 0) {
        ds = response.deletes.length == 1 ? "" : "s";
        $(".shopping-cart-message").append(
          " " + response.deletes.length + " product" + ds + " deleted."
        );

        $.each(response.deletes, function(index, product_idn) {
          //Remove product from worksheet
          $("#Product_" + product_idn).remove();
        });
      }

      //Miscellaneous
      if (response.misc.Html != "") {
        //Insert misc product
        //$("#Product" + worksheet_category_idn + "-" + response.misc.after).after(response.misc.html);
        //$("#Category" + worksheet_category_idn).after(response.misc.Html);

        //Determine id of last row of category section
        last_row_id = $(".WorksheetCategory" + worksheet_category_idn)
          .last()
          .attr("id");

        if (last_row_id === undefined) {
          $("#Category" + worksheet_category_idn).after(response.misc.Html);
        } else {
          $("#" + last_row_id).after(response.misc.Html);
        }

        //Display message
        $(".shopping-cart-message").append(response.message);

        //Clear misc field
        $("#cartMiscellaneousProduct" + worksheet_category_idn).val("");

        if (response.misc.IsAssembly == 1) {
          assembly_handlers();
        } else {
          $("#CartMiscellaneousProduct" + worksheet_category_idn).val("");
        }
      }

      if (response.errors.length > 0) {
        var es = response.errors.length == 1 ? "" : "s";
        $(".shopping-cart-message").append(
          " " + response.errors.length + ds + "."
        );
      }

      if (
        response.misc.Html != "" ||
        response.deletes.length > 0 ||
        response.updates.length > 0 ||
        response.inserts.length > 0
      ) {
        register_feci_handlers();
        arrow_navigation_controller();

        $("input").change(function(e) {
          calc_worksheet();
        });
        calc_worksheet();
      }
    });

    // callback handler that will be called on failure
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      // log the error to the console
      console.error("The following error occured: " + textStatus, errorThrown);
    });
  }

  function toggle_cart_subgroup(parent_element, worksheet_category_idn) {
    var parent_name = $(parent_element).attr("name");
    var position = parent_name.lastIndexOf("Flag");
    var selected_value = $(
      "input[name=" + parent_name + "]:checked",
      "#cart_parms_form" + worksheet_category_idn
    ).val();

    //only toggle display if "Flag" is found in the name of the parent element
    if (position > 0) {
      //Build id of element to toggle display
      var group_id =
        "Group" + parent_name.substring(0, position) + worksheet_category_idn;

      if (selected_value == "Y" || selected_value == "1") {
        //Display group element
        $("#" + group_id).show();
      }

      if (selected_value == "N" || selected_value == "0") {
        //Hide group element
        $("#" + group_id).hide();
      }
    }
  }

  function build_assembly(worksheet_category_idn) {
    build_assembly_name(worksheet_category_idn);

    build_assembly_price(worksheet_category_idn);
  }

  function build_assembly_name(worksheet_category_idn) {
    var assembly_name = "";
    var size = "";
    var riser_type = "";
    var outlet = "";
    var fitting = "";

    switch (worksheet_category_idn) {
      case 114: //Fire Pumps
        var pump_type = $.trim(
          $(
            "input[name=FirePumpType" + worksheet_category_idn + "]:checked",
            "#cart_parms_form" + worksheet_category_idn
          )
            .parent("label")
            .text()
        );

        assembly_name = pump_type + " Fire Pump Assembly";
        break;
      case 96: //Riser Nipples
        size = $("#Size" + worksheet_category_idn + " option:selected").text();
        outlet = $(
          "#Outlet" + worksheet_category_idn + " option:selected"
        ).text();
        fitting = $(
          "#Fitting" + worksheet_category_idn + " option:selected"
        ).text();

        //Default assembly description
        assembly_name = size + '" ' + outlet;

        if (parseInt($("#Fitting" + worksheet_category_idn).val()) !== 0) {
          assembly_name += "/" + fitting;
        }
        break;
      case 106: //Riser
        //Get text to build assembly name
        size = $(
          "#RiserSize" + worksheet_category_idn + " option:selected"
        ).text();
        riser_type = $.trim(
          $(
            "input[name=RiserType" + worksheet_category_idn + "]:checked",
            "#cart_parms_form" + worksheet_category_idn
          )
            .parent("label")
            .text()
        );

        assembly_name = size + " " + riser_type;
        break;
      case 109: //Riser Manifold
        size = $(
          "#RiserSize" + worksheet_category_idn + " option:selected"
        ).text();

        assembly_name = size + " Manifold";
      default:
        break;
    }

    $("#cart_results_footer" + worksheet_category_idn + " .assembly-name").html(
      assembly_name
    );
    $("#AssemblyName" + worksheet_category_idn).val(assembly_name);
  }

  function build_assembly_price(worksheet_category_idn) {
    var assembly_price = 0;
    var assembly_field = 0;
    var selected_products = $(".results-product:checked");

    switch (worksheet_category_idn) {
      case 106: //Riser
      case 109: //Riser Manifold
      case 96: //Riser Nipples
      case 114: //Fire pump
        var product_idn = 0;
        var qty = 0;
        var price = 0;
        var field = 0;

        //Iterate over selected products
        $(".results-product:checked").each(function(index) {
          //Get product_idn
          product_idn = $(this).val();
          //Get material and field prices
          if (
            $(
              "#Quantity" + worksheet_category_idn + "-" + product_idn
            ).val() === undefined
          ) {
            qty = 1;
          } else {
            qty = parseFloat(
              strip_comma(
                $(
                  "#Quantity" + worksheet_category_idn + "-" + product_idn
                ).val()
              )
            );
          }
          price = parseFloat(
            strip_comma(
              $(
                "#MaterialUnitPrice" +
                  worksheet_category_idn +
                  "-" +
                  product_idn
              ).html()
            )
          );
          field = parseFloat(
            strip_comma(
              $(
                "#FieldUnitPrice" + worksheet_category_idn + "-" + product_idn
              ).html()
            )
          );

          //Add to totals
          assembly_price += qty * price;
          assembly_field += qty * field;
        });
        break;
      default:
        break;
    }

    //Load prices
    $(
      "#cart_results_footer" + worksheet_category_idn + " .assembly-price"
    ).html("$" + number_format(assembly_price, 2, ","));
    $("#AssemblyPrice" + worksheet_category_idn).val(assembly_price);
    $("#AssemblyFieldHours" + worksheet_category_idn).val(assembly_field);
  }

  function set_cart_defaults(worksheet_category_idn) {
    //Check tab_viewed_flag
    if ($("#tab_viewed_flag" + worksheet_category_idn).val() === "0") {
      //Reset form
      $("#cart_parms_form" + worksheet_category_idn)[0].reset();

      //Set tab_viewed_flag to 1
      $("#tab_viewed_flag" + worksheet_category_idn).val("1");

      default_selected_sizes(worksheet_category_idn);

      //Default Pipe Type to Worksheet Parms pipe type, if it exists in shopping cart
      if (
        $("#PipeType" + worksheet_category_idn) !== undefined &&
        $("#pipe_type_id") !== undefined
      ) {
        $("#PipeType" + worksheet_category_idn).val($("#pipe_type_id").val());
      }

      //Default Schedule Type to Worksheet Parms Schedule Type, if it exists in shopping cart
      if (
        $("#ScheduleType" + worksheet_category_idn) !== undefined &&
        $("#schedule_type_id") !== undefined
      ) {
        $("#ScheduleType" + worksheet_category_idn).val(
          $("#schedule_type_id").val()
        );
      }

      //Default Grooved Fitting
      //if ($("#GroovedFittingType" + worksheet_category_idn) !== undefined) {
      //    $("#GroovedFittingType" + worksheet_category_idn).val(parseInt(FECI.job.job_parms["78"]["NumericValue"]));
      //}

      //Default Domestic
      if (
        $(
          "input[type=radio][name=Domestic" + worksheet_category_idn + "]",
          "#cart_parms_form" + worksheet_category_idn
        ).length
      ) {
        var domestic_value = 2;

        //Get Domestic required from job parameters
        if (
          worksheet_category_idn == 90 ||
          worksheet_category_idn == 97 ||
          worksheet_category_idn == 99
        ) {
          //Both Domestic Flag and Pipe options must be "Y" for Domestic Yes on cart to be set to "Yes"
          domestic_value =
            FECI.job.job_parms["28"]["AlphaValue"] === "Y" &&
            FECI.job.job_parms["42"]["AlphaValue"] === "Y"
              ? 1
              : 2;
        } else {
          domestic_value =
            FECI.job.job_parms["28"]["AlphaValue"] === "Y" ? 1 : 2;
        }

        //Set default for Domestic radio group
        $(
          "input[name=Domestic" +
            worksheet_category_idn +
            "][value=" +
            domestic_value +
            "]"
        ).prop("checked", true);
      }

      //Default Threaded Fitting Type to Worksheet Fitting Material, if it exists in shopping cart
      if (
        $("#ThreadedFittingType" + worksheet_category_idn) !== undefined &&
        $("#fitting_material_id") !== undefined
      ) {
        $("#ThreadedFittingType" + worksheet_category_idn).val(
          $("#fitting_material_id").val()
        );
      }

      //Default Manufacturer
      if (
        $("#Manufacturer" + worksheet_category_idn) !== undefined &&
        $("#Manufacturer") !== undefined
      ) {
        $("#Manufacturer" + worksheet_category_idn).val(
          $("#Manufacturer").val()
        );
      }

      switch (worksheet_category_idn) {
        case 91: //Hangers
          hanger_usability(worksheet_category_idn);
          break;
        //    case 92: //Heads
        //        $('cart_coverage_type').value = 1; //Standard Coverage Sprinklers
        //        break;
        case 96: //Riser Nipples
          //(jp_alphas[28] == 'Y') ? $j(form_selector + ' #cart_origin_yes').prop('checked', true) : $j(form_selector + ' #cart_origin_both').prop('checked', true);
          //filter_fitting_type($F('cart_outlet'));
          get_riser_fittings(
            worksheet_category_idn,
            $("#FittingType" + worksheet_category_idn).val()
          );
          break;
        //    case 106: //Riser worksheet
        //        riser_usability($RF('cart_form' + sub_cat_id, 'cart_riser'));
        //        break;
        //    case 109: //Manifold on Riser Manifold worksheet
        //        break;
        //    case 118: //Valves
        //        (jp_alphas[28] == 'Y') ? $j(form_selector + ' #cart_origin_yes').prop('checked', true) : $j(form_selector + ' #cart_origin_both').prop('checked', true);
        //        break;
      }

    }

    if (parseInt(FECI.worksheet.WorksheetMaster_Idn) === 2) {
      $("#TotalPanelsFactor" + worksheet_category_idn).on("change", function(e) {
        calc_recommended_panels(worksheet_category_idn);
      });

      $("#TotalDevicesFactor" + worksheet_category_idn).on("change", function(e) {
        calc_recommended_devices(worksheet_category_idn);
      });
  
      calc_recommended_devices(worksheet_category_idn);
      calc_recommended_panels(worksheet_category_idn);
    }

  }

  function default_selected_sizes(worksheet_category_idn) {
    var start_value = 0;
    var end_value = 0;
    var worksheet_value = 0;
    var size_checkbox = "";
    var worksheet_size_idns = get_selected_worksheet_size_idns();

    if (worksheet_size_idns !== undefined && worksheet_size_idns.length > 0) {
      if (worksheet_category_idn == 91) {
        //Hangers
        $(".cart-size" + worksheet_category_idn).each(function(i) {
          start_value = parseFloat($(this).data("start_value"));
          end_value = parseFloat($(this).data("end_value"));
          size_checkbox = $(this);

          //Default to unchecked
          $(this).prop("checked", false);

          //Iterate through selected worksheet sizes to find matches
          $.each(worksheet_size_idns, function(index, size_idn) {
            worksheet_value = parseFloat(
              $("#size_id" + size_idn).data("size_value")
            );
            if (
              worksheet_value >= start_value &&
              worksheet_value <= end_value
            ) {
              size_checkbox.prop("checked", true);
            }
          });
        });
      } else {
        $(".cart-size" + worksheet_category_idn).each(function(i) {
          if ($.inArray($(this).val(), worksheet_size_idns) > -1) {
            $(this).prop("checked", true);
          } else {
            $(this).prop("checked", false);
          }
        });
      }
    }
    return true;
  }

  function get_fitting_set(worksheet_category_idn) {
    var cart_parms = $("#cart_parms_form" + worksheet_category_idn).serialize();

    //Message
    $(".shopping-cart-message").html("Selecting fittings set...");

    //abort any pending request
    if (FECI.request) {
      FECI.request.abort();
    }

    FECI.request = $.ajax({
      url:
        FECI.base_url +
        "cart_controller/get_fittings_set/" +
        worksheet_category_idn,
      type: "POST",
      dataType: "json",
      data: cart_parms
    });

    // callback handler that will be called on success
    FECI.request.done(function(response) {
      //Clear message
      $(".shopping-cart-message").html("");

      select_fitting_set(worksheet_category_idn, response);

      cart_filter(worksheet_category_idn);
    });

    // callback handler that will be called on failure
    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      // log the error to the console
      console.error(
        "The following error occured on worksheet_controller/select_fittings_set: " +
          textStatus,
        errorThrown
      );
    });
  }

  function select_fitting_set(worksheet_category_idn, fitting_idns) {
    $(".cart-fitting" + worksheet_category_idn).each(function() {
      if ($.inArray(parseInt($(this).val()), fitting_idns) > -1) {
        $(this).prop("checked", true);
      } else {
        $(this).prop("checked", false);
      }
    });
  }

  function hanger_usability(worksheet_category_idn) {
    if ($("#HangerType" + worksheet_category_idn).val() == 4) {
      //Rod hanger
      $("#AdditionalRodSizes" + worksheet_category_idn).show();
    } else {
      $("#AdditionalRodSizes" + worksheet_category_idn).hide();
    }
  }

  function get_riser_fittings(worksheet_category_idn, fitting_type) {
    //Riser Nipples
    if (worksheet_category_idn == 96) {
      var promise = $.ajax({
        url:
          FECI.base_url + "cart_controller/get_riser_fittings/" + fitting_type,
        dataType: "json"
      });

      var success = function(response) {
        load_riser_fittings(worksheet_category_idn, response);
      };

      var error = function(request, status, error) {
        //message("Error loading fittings.", 3);
        displayMessageBox("Error loading fittings.", "danger");
      };

      //Promise
      promise.then(success, error);
    }
  }

  function load_riser_fittings(worksheet_category_idn, fittings) {
    var fitting_type_idn = $("#FittingType" + worksheet_category_idn).val();

    if (fitting_type_idn !== "0" && fitting_type_idn !== undefined) {
      //Remove all options for select element
      $("#Fitting" + worksheet_category_idn).empty();

      //Add 'None' option
      $("#Fitting" + worksheet_category_idn).append(
        $("<option>")
          .text("None")
          .attr("value", "0")
      );

      $.each(fittings, function() {
        $("#Fitting" + worksheet_category_idn).append(
          $("<option>")
            .text(this.name)
            .attr("value", this.value)
        );
      });
    }

    //Trigger Change event on select element
    $("#Fitting" + worksheet_category_idn).trigger("change");
  }

  function setup_cart(worksheet_category_idn) {
    //set_defaults
    set_cart_defaults(worksheet_category_idn);

    //Don't filter Products tab or Riser Nipples tab
    if (
      parseInt(worksheet_category_idn) !== 141 &&
      parseInt(worksheet_category_idn) !== 96
    ) {
      cart_filter(worksheet_category_idn);
    }
  }

  function get_category_sorting_data() {
    FECI.request = $.ajax({
      url: FECI.base_url + "cart_controller/get_category_sorting_data",
      type: "POST",
      dataType: "json"
    });

    // callback handler that will be called on success
    FECI.request.done(function(response) {
      self.category_data = response;
    });

    FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
      // log the error to the console
      console.error("The following error occured: " + textStatus, errorThrown);
    });
  }

  function riser_usability(worksheet_category_idn) {
    var riser_type_id = $(
      "input[name=RiserType" + worksheet_category_idn + "]:checked"
    ).val();

    if (riser_type_id == 1) {
      //Double check riser
      //Set Backflow to yes
      $('input[name="BackflowFlag' + worksheet_category_idn + '"][value="Y"]')
        .prop("checked", true)
        .trigger("change");
      //Set Control valve to no
      $(
        'input[name="ControlValveFlag' +
          worksheet_category_idn +
          '"][value="N"]'
      )
        .prop("checked", true)
        .trigger("change");
    } else {
      //Set backflow to no
      $('input[name="BackflowFlag' + worksheet_category_idn + '"][value="N"]')
        .prop("checked", true)
        .trigger("change");
      //Set Control valve to yes
      $(
        'input[name="ControlValveFlag' +
          worksheet_category_idn +
          '"][value="Y"]'
      )
        .prop("checked", true)
        .trigger("change");
    }
  }

  function calc_recommended_panels(worksheet_category_idn) {
    const total_panels = parseInt(strip_comma($("#TotalPanels" + worksheet_category_idn).text()));
    const panels_factor = parseInt(strip_comma($("#TotalPanelsFactor" + worksheet_category_idn).val()));
    const recommended_panels = total_panels * panels_factor;

    $("#RecommendedPanels" + worksheet_category_idn).text(number_format(recommended_panels, 0, ","));
  }

  function calc_recommended_devices(worksheet_category_idn) {
    const total_devices = parseInt(strip_comma($("#TotalDevices" + worksheet_category_idn).text()));
    const devices_factor = parseInt(strip_comma($("#TotalDevicesFactor" + worksheet_category_idn).val()));
    const recommended_devices = total_devices * devices_factor;

    $("#RecommendedDevices" + worksheet_category_idn).text(number_format(recommended_devices, 0, ","));
  }

  function cart_arrow_navigation_handler(worksheet_category_idn) {
      //Activate up/down arrows on fields with class name
      TKO_arrow_navigation($("input.arrow-qty-" + worksheet_category_idn));
  }

  return {
    shopping_cart_handlers: shopping_cart_handlers,
    cart_filter: cart_filter,
    hanger_usability: hanger_usability
  };
})();
