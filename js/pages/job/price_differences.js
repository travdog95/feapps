// JavaScript Document
$(function () {
    //Set global variables
    FECI.source_page = "price_diff";
    FECI.source_modal = "";

    ui_handlers();
		
	//Check to see if job is readonly	
    if (FECI.job.read_only == 0) {
		
		//Form submit event handler
        $("#UpdatePrices").on("click", function (e) {
			e.preventDefault();
			
			//Set confirmation modal values
			$("#ConfirmationModal .modal-title").html("Update Prices");
			$("#ConfirmationModal .modal-body p").html("Are you sure you want to update prices?");

            //Show modal dialog
			$("#ConfirmationModal").modal("show");
		});

		$("#Confirmed").on("click", function (e) {
			$("#JobPriceDifferences").submit();
		});

		//Form submit event handler
		$("#JobPriceDifferences").submit(function (e) {
			e.preventDefault();
			update_prices(this);
		});
	}
	else {
		//Job is read only, disable form elements
		$("input, select, textarea, button").attr('disabled','disabled');
	}
});

function ui_handlers() {
    //Hide or display elements
    if ($(".price-difference").length == 0) {
        $("#UpdatePrices").attr("disabled", true);
    } else {
        $("#UpdatePrices").attr("disabled", false);
    }
}

/*
 * update_prices
  *
 * @param	form(object)
 * @return	boolean
 */
function update_prices(form)
{
	//Delcare and initialize variables
	var inputs = $(form).find("input, select, button");
	var ajax_data = {
		"job_number": FECI.job.job_number,
		"price_differences": []
	};
	var p = {};

	//Abort any pending Ajax Requests
	if (FECI.request) {
		FECI.request.abort();
	}
	
	//Disable form elements
	inputs.prop("disabled", true);
	
	//Serialize data for update_prices ajax call
	$(".price-difference").each(function() {
		p = {
			Product_Idn: $(this).data("product_idn"),
			Worksheet_Idn: $(this).data("worksheet_idn"),
			MaterialUnitPrice: strip_comma($(this).find(".new-material-price").html().trim()),
			FieldUnitPrice: strip_comma($(this).find(".new-field-price").html().trim()),
			ShopUnitPrice: strip_comma($(this).find(".new-shop-price").html().trim()),
			EngineeringUnitPrice: strip_comma($(this).find(".new-eng-price").html().trim()),
            ProductAssembly_Idn: $(this).data("assembly_idn"),
            MiscellaneousDetail_Idn: $(this).data("miscellaneousdetail_idn")
		};

        ajax_data.price_differences.push(p);
	});

	//AJAX request
	FECI.request = $.ajax({
		url: FECI.base_url + "job/update_prices",
		type: "POST",
		dataType: "json",
        data: ajax_data
	});
	
	//Success callback handler
    FECI.request.done(function (response, textStatus, jqXHR) {
        $("#ConfirmationModal").modal("hide");
		if (response.return_code == 1)
        {
            //Success
            displayMessageBox("Job prices updates!", "success");

            //remove price difference and worksheet rows
            $("tr.price-difference").remove();
            $("tr.worksheet").remove();
		}
		else
		{
			//Error	
            displayMessageBox("Error updating prices.", "danger");
		}
	});
	
	//Failure callback handler 
	FECI.request.fail(function (jqXHR, textStatus, errorThrown){
		//Log the error message
        //Error	
        dispalyMessageBox("Fatal error updating prices.", "danger");
	});
	
	//Always callback handler
	FECI.request.always(function (){
		//Enable inputs
	    inputs.prop('disabled', false);

		ui_handlers();
	});
}