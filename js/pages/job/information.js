// JavaScript Document
$(function() {
  //Set global variables
  FECI.source_page = "info";
  FECI.source_modal = "";

  ui_handlers();

  //Toggle Underground options
  $("input[name='is_underground']").click(function(e) {
    display_underground();
  });

  //Click event for Domestic Required radio buttons
  $("input[name='is_domestic_required']").click(function(e) {
    display_domestic_required();
  });

  //Click event for Davis Bacon Job radio buttons
  $("input[name='is_davis_bacon_job']").click(function(e) {
    display_davis_bacon();
  });

  //Click event for System types
  $("input.system_type").click(function(e) {
    display_subs();
  });

  //Click event for System types
  $("input[name='has_overtime']").click(function(e) {
    display_overtime();
  });

  $("input[name='is_parts_smarts']").click(function(e) {
    parts_and_smarts();
  });

  $(".required").blur(function(e) {
    //I can't get the focus to stay on the field!
    check_job_info();
  });

  const config = {
    ".chosen-select": {},
    ".chosen-select-deselect": { allow_single_deselect: true },
    ".chosen-select-no-single": { disable_search_threshold: 10 },
    ".chosen-select-no-results": { no_results_text: "Oops, nothing found!" },
    ".chosen-select-width": { width: "95%" }
  };

  for (var selector in config) {
    $(selector).chosen(config[selector]);
  }

  $("#prepared_bys")
    .chosen()
    .change();

  //$(".check_num2").blur(function (e) {
  //    $(this).val(number_format(strip_comma($(this).val()), 2, ','));
  //});

  //Check to see if job is readonly
  if (FECI.job.read_only === 0) {
    //Save button event handler
    $(".save-button").click(function(e) {
      e.preventDefault();
      //Set value of hidden element 'button_clicked' to id of button
      $("#button_clicked").val(this.id);

      if (check_job_info()) {
        //Submit form
        //$("#job_information").submit();
        save_job_info();
      }
    });

    //Form submit event handler
    // $("#job_information").submit(function(e) {
    //   e.preventDefault();
    //   save_job_info(this);
    // });
  } else {
    //Job is read only, disable form elements
    $("input, select, textarea, button").attr("disabled", "disabled");
  }
});

function ui_handlers() {
  //Hide or display elements
  display_underground();
  display_davis_bacon();
  display_domestic_required();
  display_subs();
  display_parent();
  display_overtime();
  format_numbers();
  //parts_and_smarts();
}

function display_underground() {
  if ($("input[name='is_underground']:checked").val() == "Y") {
    $(".underground_options").show();
  } else {
    $(".underground_options").hide();
  }
}

function display_davis_bacon() {
  if ($("input[name='is_davis_bacon_job']:checked").val() == "Y") {
    $(".davis_bacon_pac").show();
  } else {
    $(".davis_bacon_pac").hide();
  }
}

function display_domestic_required() {
  if ($("input[name='is_domestic_required']:checked").val() == "Y") {
    $(".domestic_options").show();
  } else {
    $(".domestic_options").hide();
  }
}

function display_subs() {
  var system_types = $("input.system_type");
  i = 0;
  for (i; i < system_types.length; i++) {
    var id = $(system_types[i]).val();
    var system_subs = $("input.system_sub_type" + id);
    var j = 0;
    for (j; j < system_subs.length; j++) {
      if (system_types[i].checked == true) {
        system_subs[j].disabled = false;
      } else {
        system_subs[j].disabled = true;
      }
    }
  }
}

function display_parent() {
  if ($("#job_number").val() == 0) {
    $("#is_parent_container").show();
  } else {
    $("#is_parent_container").hide();
  }
}

function display_overtime() {
  if ($("input[name='has_overtime']:checked").val() == "Y") {
    $(".overtime_message").show();
  } else {
    $(".overtime_message").hide();
  }
}

function parts_and_smarts() {
  if ($("input[name='is_parts_smarts']").length > 0) {
    const field_labor_rate = (($("input[name='is_parts_smarts']:checked").val() === 'Y')) ? FECI.job.job_defaults[80]['NumericValue'] : FECI.job.job_defaults[1]['NumericValue'];
    $("#field_labor_rate").val(number_format(field_labor_rate, 2, ","));
  }
}
/*
 * format_numbers
 */
function format_numbers() {
  $(".check_num").each(function(index) {
    $(this).val(number_format(strip_comma($(this).val()), 0, ","));
  });

  $(".check_num1").each(function(index) {
    $(this).val(number_format(strip_comma($(this).val()), 1, ","));
  });

  $(".check_num2").each(function(index) {
    $(this).val(number_format(strip_comma($(this).val()), 2, ","));
  });
}

/*
 * check_job_info
 *
 * Validate contents of save_information form
 *
 * @return	bool
 */
function check_job_info() {
  //Delcare and initialize variables

  //Clear the background colors of the all fields in form
  $("input, select, textarea").removeClass("error");

  //Check name
  if ($("#name").val() == "") {
    $("#name")
      .addClass("error")
      .focus();
    alert("'Name' is required.");
    return false;
  }

  //Check system types check boxes
  if ($(".system_type").length > 0 && $(".system_type:checked").length === 0) {
    $(".system_type").addClass("error");
    alert("You must select at least one 'System Type'!");
    return false;
  }

  //check davis bacon fields
  //var bacon_radio = get_radio_value(form.bacon);
  if ($("input[name=is_davis_bacon_job]:checked").val() == "Y") {
    if (
      $("#davis_bacon_pac").val() <= 0 ||
      $("davis_bacon_pac").value >= 100 ||
      $("davis_bacon_pac").value == ""
    ) {
      $("#davis_bacon_pac")
        .addClass("error")
        .focus();
      alert("'Davis Bacon PAC' must be between 0 and 100.");
      return false;
    }
  }

  if ($("input[name=has_overtime]").length === 1) {
    if ($("input[name=has_overtime]:checked").length === 0) {
      alert("Please select answer for 'Does this project have OT...'");
      return false;
    }
  }

  /*
  var job_defaults = FECI.job.job_defaults;

	//Don't allow user to input values less than system defaults
	var flr = (parseInt(FECI.job.department_idn) === 1) ? job_defaults[1]['NumericValue'] : job_defaults[65]['NumericValue'];
	var slr = (parseInt(FECI.job.department_idn) === 1) ? job_defaults[2]['NumericValue'] : job_defaults[64]['NumericValue'];
	var dlr = (parseInt(FECI.job.department_idn) === 1) ? job_defaults[21]['NumericValue'] : job_defaults[66]['NumericValue'];
	
	if (isNaN($('#field_labor_rate').val()) == false && ($('#field_labor_rate').val() == "" || parseFloat($('#field_labor_rate').val()) < parseFloat(flr)))
	{
		flr = number_format(flr, 2, ',');
		$('#field_labor_rate')
			.addClass('error')
			.focus();
		alert ("'Field Labor Rate' cannot be less than the system default ($" + flr +")!");
		return false;
	}
	
	if (parseFloat($('#design_labor_rate').val()) < parseFloat(dlr))
	{
		dlr = number_format(dlr, 2, ',');
		$('#design_labor_rate')
			.addClass('error')
			.focus();
		alert ("'Design Labor Rate' cannot be less than the system default ($" + dlr +")!");
		return false;
	}
		
	if (parseFloat($('#shop_labor_rate').val()) < parseFloat(slr))
	{
		slr = number_format(slr, 2, ',');
		$('#shop_labor_rate')
			.addClass('error')
			.focus();
		alert ("'Shop Labor Rate' cannot be less than the system default ($" + slr +")!");
		return false;
	}

    */

  //Check Job Mobilization miles
  if ($("#miles_to_job").val() <= 0 || $("#miles_to_job").val() == "") {
    $("#miles_to_job")
      .addClass("error")
      .focus();
    alert("'Miles to Job' must be greater than 0.");
    return false;
  }

  return true;
}

/*
 * save_job_info
 *
 * Save Job Information from job_information form
 *
 * @param	form(object)
 * @return	boolean
 */
function save_job_info() {
  const $form = $("#job_information");
  //Delcare and initialize variables
  var serialized_data = $form.serialize();
  var inputs = $form.find("input, select, button");

  //Abort any pending Ajax Requests
  if (FECI.request) {
    FECI.request.abort();
  }

  //Disable form elements
  inputs.prop("disabled", true);

  //AJAX request
  FECI.request = $.ajax({
    url: FECI.base_url + "job/save_information",
    type: "POST",
    dataType: "json",
    data: serialized_data
  });

  //Success callback handler
  FECI.request.done(function(response, textStatus, jqXHR) {
    if (response.return_code == 1) {
      refresh_saved_elements();
      if (response.button_clicked == "save_goto_recap") {
        window.location.href = FECI.base_url + "job/recap/" + response.job_number + "?message=Job Information saved!&message_type=" + response.return_code;
      } else {
        if (response.save_type === "I") {
          //If job was just created, go to job/information page
          window.location.href = FECI.base_url + "job/information/" + response.job_number + "?message=Job created!&message_type=" + response.return_code;
        } else {
          //Send update message
          displayMessageBox("Job Information saved!", "success");
        }
      }
    } else {
      //Error
      displayMessageBox("Error saving job information.", "danger");
    }
  });

  //Failure callback handler
  FECI.request.fail(function(jqXHR, textStatus, errorThrown) {
    //Log the error message
    displayMessageBox("Error saving job information.", "danger");
  });

  //Always callback handler
  FECI.request.always(function() {
    //Enable inputs
    inputs.prop("disabled", false);

    ui_handlers();
  });
}
