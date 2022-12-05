// JavaScript Document
$(function () {

    //Set Global properties
    FECI.source_page = "recap";
    FECI.source_modal = "";

    recap_handlers();

    //Calculate recap page
    calc_recap();
    check_case();

    //Modal settings
    $("#parent_modal").modal({
        show: false
    });

    const specialElementHandlers = {
        "#editor": function(element, renderer) {
            return true;
        }
    };

    $("#generatePDF").on("click", function(e) {
        e.preventDefault();
        let pdf = "";
        $("#generatePDF").hide();
        //$("#genmsg").show();
        html2canvas($("#pdfContent").get(0), { allowTaint: true }).then(function(canvas) {
    
            const imgData = canvas.toDataURL("image/png", 1.0);
            pdf = new jsPDF({
                //orientation: "landscape",
                unit: "in",
                format: [11, 8.5],
                //format: [8.5, 11] //landscape
            });
            //pdf.addImage(imgData, 'JPG', .25, .25, 10.5, 8); //landscape
            pdf.addImage(imgData, 'JPG', .25, .25, 8, 10.5);
            pdf.save(`recap-${FECI.job.job_number}.pdf`);

            $("#generatePDF").show();
        });
    });
});

function recap_handlers() {
    var i = 0;

    //Contingencies
    for (i = 2; i <= 5; i++) {
        //Profit Mark Up override percent
        $("#contingency_" + i).change(function (e) {
            //Get contingency column
            var c = $(this).data("c");

            //Enable override field and set to 1
            $("#override_contingency_" + c + "_percent").val("1");
        });

        //Profit Mark Up override percent
        $("#contingency_" + i + "_percent").change(function (e) {
            //Get contingency column
            var c = $(this).data("c");

            //Disable override field and set to 0
            $("#override_contingency_" + c + "_percent").val("0");
        });
    }

    //Profit Mark Up override percent
    $("#profit_mark_up").change(function (e) {
        //Disable override field and set to 0
        $("#override_profit_mark_up_percent").val("1");
    });

    $("#profit_mark_up_percent").change(function (e) {
        //Disable override field and set to 0
        $("#override_profit_mark_up_percent").val("0");
    });

    //Depository Fee override percent
    $("#depository_fee").change(function (e) {
        //Disable override field and set to 0
        $("#override_depository_fee_percent").val("1");
    });

    $("#depository_fee_percent").change(function (e) {
        //Disable override field and set to 0
        $("#override_depository_fee_percent").val("0");
    });

    //Cost of Bond override percent
    $("#cost_of_bond").change(function (e) {
        //Disable override field and set to 0
        $("#override_cost_of_bond_percent").val("1");
    });

    $("#cost_of_bond_percent").change(function (e) {
        //Disable override field and set to 0
        $("#override_cost_of_bond_percent").val("0");
    });

    //Gross Receipt override percent
    $("#gross_receipt").change(function (e) {
        //Disable override field and set to 0
        $("#override_gross_receipt_percent").val("1");
    });

    $("#gross_receipt_percent").change(function (e) {
        //Disable override field and set to 0
        $("#override_gross_receipt_percent").val("0");
    });

    $("input").change(function (e) {
        if (this.id === 'total') {
            user_changed_total();
        }
        else {
            calc_recap();
        }
    });

    build_parent_element();

    //Notes
    //$('textarea#notes').ckeditor();

    //Register on click handlers
    //View Child Jobs
    $("#view_child_jobs").click(function (e) {
        e.preventDefault();

        $("#parent_modal .modal-body").html("");
        $("#parent_modal .modal-body").addClass("loading");
        $("#parent_modal_label").html("Child Jobs");
        $("#parent_modal").modal('show');

        $.get(FECI.base_url + 'job/get_child_jobs/' + FECI.job.job_number, function (html) {
            $("#parent_modal .modal-body").removeClass("loading");
            $("#parent_modal .modal-body").html(html);
        });
    });

    //Add Parent Job
    $("#add_parent").click(function (e) {
        e.preventDefault();

        $("#parent_modal .modal-body").html("");
        $("#parent_modal .modal-body").addClass("loading");
        $("#parent_modal_label").html("Parent Jobs");
        $("#parent_modal").modal('show');

        $.get(FECI.base_url + 'job/get_parents/' + FECI.job.job_number + '/' + FECI.job.department_idn, function (html) {
            $("#parent_modal .modal-body").removeClass("loading");
            $("#parent_modal .modal-body").html(html);
        });
    });

    $("#accounting").on("click", function (e) {
        e.preventDefault();

        export_accounting_data();
    });

    //Save Recap
    $("#save_recap").click(function (e) {
        e.preventDefault();

        if (validate_recap()) {
            $("#job_recap").submit();
        }
    });

    $("#job_recap").submit(function (e) {
        e.preventDefault();

        //Delcare and initialize variables
        var form = this;
        var serialized_data = $(form).serialize();
        var inputs = $(form).find("input, select, button");

        //Abort any pending Ajax Requests
        if (FECI.request) {
            FECI.request.abort();
        }

        //Disable form elements
        inputs.prop("disabled", true);

        //AJAX request
        FECI.request = $.ajax({
            url: FECI.base_url + "job/save_recap/",
            type: "POST",
            dataType: "json",
            data: serialized_data
        });

        //Success callback handler
        FECI.request.done(function (response, textStatus, jqXHR) {
            if (response.return_code == 1) {
                //Send update message
                displayMessageBox("Job recap saved.", "success");
            }
            else {
                //Error	
                displayMessageBox(response.message, "danger");
            }
        });

        //Failure callback handler 
        FECI.request.fail(function (jqXHR, textStatus, errorThrown) {
            //Log the error message
            console.error(
                "The following error occured: " + textStatus, errorThrown
            );
        });

        //Always callback handler
        FECI.request.always(function () {
            //Enable inputs
            inputs.prop('disabled', false);
            check_case();
        });

    });

    $("#bs_total_sqft").on("change", function(e) {
        calc_budget_summary();
    });
}

function validate_recap() {
    return true;
}

function user_changed_total() {
    //Declare and initialize variables
    var previous_total = Math.ceil(FECI.job.totals.total);
    var user_total = parseInt(strip_comma($('#total').val()));
    var case1_total = Math.ceil(FECI.job.case1_totals.total);
    var case2_total = Math.ceil(FECI.job.case2_totals.total);

    if (user_total < case2_total) {
        //Case 1 Scenario
        if (user_total >= case1_total) {
            case1_scenario();

            /*********************************************************************************/
            // Calculate Case 1 values to add to High Sub and Labor Mark-Up and to commission
            /*********************************************************************************/
            //Difference between entered value and Case 1 total
            var case1_diff = 0;
            var case1_subtotal = Math.ceil(FECI.job.case1_totals.subtotal);
            var sold_subtotal = calc_sold_subtotal(user_total);

            //case1_diff = user_total - case1_total;
            case1_diff = sold_subtotal - case1_subtotal;

            /********************************/
            //Calc additional mark-up amounts
            /********************************/
            var capacity_cost_allocation = 0;
            var commission_allocation = 0;

            capacity_cost_allocation = case1_diff * parseFloat(FECI.job.job_parms[55]['NumericValue']);
            commission_allocation = case1_diff * parseFloat(FECI.job.job_parms[56]['NumericValue']);

            //Get totals from recap worksheet
            var high_sub_total_direct_cost = 0;
            var labor_total_direct_cost = 0;
            var case2_total_direct_cost = 0;

            high_sub_total_direct_cost = FECI.job.subtotals.total_direct_costs[3];
            labor_total_direct_cost = FECI.job.subtotals.total_direct_costs[5];

            case2_total_direct_cost = high_sub_total_direct_cost + labor_total_direct_cost;

            high_sub_percentage = (high_sub_total_direct_cost > 0) ? parseFloat(precise_round(high_sub_total_direct_cost / case2_total_direct_cost, 6)) : 0;
            labor_percentage = (case2_total_direct_cost > 0) ? parseFloat(precise_round(labor_total_direct_cost / case2_total_direct_cost, 6)) : 0;

            var high_sub_allocation = 0;
            var labor_allocation = 0;

            high_sub_allocation = capacity_cost_allocation * high_sub_percentage;
            labor_allocation = capacity_cost_allocation * labor_percentage;

            var high_sub_mark_up = 0;
            var high_sub_mark_up_subtotal = 0;
            var labor_mark_up = 0;
            var labor_mark_up_subtotal = 0;

            high_sub_subtotal_mark_up = high_sub_total_direct_cost * FECI.job.job_parms[52]['NumericValue'];
            labor_subtotal_mark_up = labor_total_direct_cost * FECI.job.job_parms[53]['NumericValue'];

            high_sub_mark_up = high_sub_subtotal_mark_up + high_sub_allocation;
            labor_mark_up = labor_subtotal_mark_up + labor_allocation;

            var high_sub_total_after_mark_up = 0;
            var labor_total_after_mark_up = 0;

            high_sub_total_after_mark_up = high_sub_mark_up + high_sub_total_direct_cost;
            labor_total_after_mark_up = labor_mark_up + labor_total_direct_cost;

            var high_sub_mark_up_percent = 0.00;
            var labor_mark_up_percent = 0.00;

            high_sub_mark_up_percent = (high_sub_total_direct_cost > 0) ? parseFloat(precise_round(high_sub_mark_up / high_sub_total_direct_cost, 6)) : 0;
            labor_mark_up_percent = (labor_total_direct_cost > 0) ? parseFloat(precise_round(labor_mark_up / labor_total_direct_cost, 6)) : 0;

            //Load new percentages into fields
            $('#mark_up_percent_3').val(parseFloat(precise_round(high_sub_mark_up_percent, 6) * 100));
            $('#mark_up_percent_5').val(parseFloat(precise_round(labor_mark_up_percent, 6) * 100));

            var total_static_after_capacity_costs = 0;
            var total_after_capacity_costs = 0;

            //Total columns 1,2 & 4 from recap sheet
            $(".total_capacity_cost").each(function (index) {
                if (index !== 2 && index !== 4) {
                    total_static_after_capacity_costs += parseInt(strip_comma($(this).html()));
                }
            });

            //Add calculated amounts for columns 3 & 5
            total_after_capacity_costs = total_static_after_capacity_costs + high_sub_total_after_mark_up + labor_total_after_mark_up;

            var total_after_mark_up = total_static_after_capacity_costs + high_sub_total_direct_cost + high_sub_subtotal_mark_up + labor_total_direct_cost + labor_subtotal_mark_up;
            var case1_commission = Math.round(total_after_mark_up * FECI.job.job_parms[54]['NumericValue']);

            var commission = case1_commission + commission_allocation;
            var commission_percent = precise_round(commission / total_after_capacity_costs, 6);

            $('#regular_commission_percent').val(precise_round(parseFloat(commission_percent) * 100, 4));

            calc_recap();
        }
        else {

            alert('Cannot go below Case 1 total!');
            $('#total').val(number_format(previous_total, 0, ','));
        }
    }
    else {
        normal_case_scenario();
        calc_recap();
        /***************************************************************/
        //Reverse engineer totals based on manual change of Recap Total
        /****************************************************************/
        var total_after_cost_of_bond = 0;
        var gross_receipt = 0;
        var total = 0;

        //Calculate Gross Receipts Tax, Etc & Total after Bond
        if (FECI.job.totals.gross_receipt_percent > 0) {
            total_after_cost_of_bond = Math.round(user_total / (1 + FECI.job.totals.gross_receipt_percent));
            gross_receipt = Math.round(total_after_cost_of_bond * FECI.job.totals.gross_receipt_percent);
            total = total_after_cost_of_bond + gross_receipt;
        }
        else {
            total_after_cost_of_bond = user_total - FECI.job.totals.gross_receipt;
        }

        var total_after_depository_fee = 0;
        var cost_of_bond = 0;

        //Calculate Cost of Bond and Total After Depository Fee
        if (FECI.job.totals.cost_of_bond_percent> 0) {
            //Calculate Total After Bond
            total_after_depository_fee = Math.round(total_after_cost_of_bond / (1 + FECI.job.totals.cost_of_bond_percent));
            cost_of_bond = Math.floor(total_after_depository_fee * FECI.job.totals.cost_of_bond_percent);
        }
        else {
            total_after_depository_fee = total_after_cost_of_bond - FECI.job.totals.cost_of_bond;
        }

        var total_after_sales_tax = 0;
        var depository_fee = 0;

        //Calculate Depository Fee and Total after Taxes
        if (FECI.job.totals.depository_fee_percent > 0) {
            //Calculate Total After Bond
            total_after_sales_tax = Math.round(total_after_depository_fee / (1 + FECI.job.totals.depository_fee_percent));
            depository_fee = Math.round(total_after_sales_tax * FECI.job.totals.depository_fee_percent);
        }
        else {
            total_after_sales_tax = total_after_depository_fee - FECI.job.totals.depository_fee;
        }

        //Calculate Total After Profit Mark-Up
        var total_after_profit_mark_up = total_after_sales_tax - FECI.job.totals.sales_tax;

        //Calculate Total Profit Mark-Up
        FECI.job.totals.profit_mark_up = total_after_profit_mark_up - Math.round(FECI.job.totals.subtotal);
        $("#profit_mark_up").val(number_format(FECI.job.totals.profit_mark_up, 0, ","));

        $('#override_profit_mark_up_percent').val('1')

        //Calculate Profit Mark-Up Percentage and Amount
        //var profit_mark_up_percent = number_format(((total_after_profit_mark_up / FECI.job.totals.subtotal) - 1) * 100, 2, '');
        //$('#profit_mark_up_percent').val(profit_mark_up_percent);
        //$('#override_profit_mark_up_percent').val('0');

        calc_recap();
    } //END: if (user_total < case2_total)
}

function calc_recap() {

    //*******************************
    //Calculate total of all items
    //*******************************

    //Initialize all Global totals and sub totals variables
    initialize_totals();

    calc_item_totals();

    calc_pac();

    calc_supervisory_fee();

    calc_contingencies();

    calc_total_direct_costs();

    calc_mark_up_costs();

    calc_total_capacity_costs();

    calc_commission();

    calc_profit_mark_up();

    calc_sales_tax();

    calc_depository_fee();

    calc_cost_of_bond();

    calc_gross_receipt();

    //Total
    FECI.job.totals.total = FECI.job.totals.gross_receipt + FECI.job.totals.total_after_cost_of_bond;
    $("#total").val(number_format(FECI.job.totals.total, 0, ','));

    //Case 1
    FECI.job.case1_totals.total = FECI.job.case1_totals.gross_receipt + FECI.job.case1_totals.total_after_cost_of_bond;
    $("#case1_total").text(number_format(FECI.job.case1_totals.total, 0, ','));

    //Case 2
    FECI.job.case2_totals.total = FECI.job.case2_totals.gross_receipt + FECI.job.case2_totals.total_after_cost_of_bond;
    $("#case2_total").text(number_format(FECI.job.case2_totals.total, 0, ','));

    if (parseInt(FECI.job.department_idn) === 2) {
        calc_budget_summary();
    }
}

function initialize_totals() {
    FECI.job.subtotals = {};
    FECI.job.totals = {};
    initialize_case_totals();
}

function initialize_case_totals() {
    FECI.job.case1_subtotals = {};
    FECI.job.case1_totals = {};
    FECI.job.case2_subtotals = {};
    FECI.job.case2_totals = {};
}

function calc_item_totals() {
    //Iterate through the first five columns
    var i = 0;
    var item_totals = [];
    for (i; i <= 5; i++) {
        //Strip comma and sum value
        var item_total = 0;
        $(".recap_cell_" + i).each(function () {
            item_total += parseInt(strip_comma($(this).text()));
        });

        //Load item totals array
        if (i > 0) {
            item_totals[i] = item_total;
        }

        //Load total and format
        $('#item_total_' + i).html(number_format(item_total, 0, ','));
    }

    FECI.job.subtotals.item_totals = item_totals;
}

function calc_pac() {
    //Calculate PAC
    FECI.job.subtotals.pac = Math.round(parseInt(strip_comma($("#item_total_5").text())) * FECI.job.payroll_added_costs);
    $("#pac_5").text(number_format(FECI.job.subtotals.pac, 0, ','));

    //Total after PAC
    FECI.job.subtotals.total_after_pac = FECI.job.subtotals.pac + FECI.job.subtotals.item_totals[5];
    $("#total_after_pac_5").text(number_format(FECI.job.subtotals.total_after_pac, 0, ','));
}

function calc_supervisory_fee() {
    //Supervisory fee
    FECI.job.subtotals.supervisory_fee_percent = ($("#supervisory_fee_percent").val() == "") ? 0 : parseFloat(number_format($("#supervisory_fee_percent").val(), 1, '')) / 100;
    FECI.job.subtotals.supervisory_fee = FECI.job.subtotals.supervisory_fee_percent * FECI.job.subtotals.total_after_pac;

    $("#supervisory_fee").text(number_format(FECI.job.subtotals.supervisory_fee, 0, ','));
    $("#supervisory_fee_percent").val(number_format(FECI.job.subtotals.supervisory_fee_percent * 100, 1, ','));
}

function calc_contingencies() {
    //Contingencies
    FECI.job.subtotals.contingencies = [];
    FECI.job.subtotals.contingency_percents = [];
    var amount = 0;

    //Iterate through columns 2 to 5(low sub, sub, material and labor)
    for (i = 2; i <= 5; i++) {

        //If user manually inputs Profit Mark Up dollar amount
        if ($("#override_contingency_" + i + "_percent").val() == 1) {
            FECI.job.subtotals.contingency_percents[i] = 0;
            FECI.job.subtotals.contingencies[i] = parseFloat(strip_comma($("#contingency_" + i).val()));

            //Apply inactive class to contingency
            $("#contingency_" + i + "_percent").addClass('inactive');
        }
        else {
            FECI.job.subtotals.contingency_percents[i] = parseFloat(number_format($("#contingency_" + i + "_percent").val(), 1, '')) / 100;
            //If labor, calculate from Total after PAC
            amount = (i == 5) ? FECI.job.subtotals.total_after_pac : FECI.job.subtotals.item_totals[i];

            FECI.job.subtotals.contingencies[i] = Math.round(FECI.job.subtotals.contingency_percents[i] * amount);

            //Remove inactive class to contingency
            $("#contingency_" + i + "_percent").removeClass('inactive');
        }

        $("#contingency_" + i).val(number_format(FECI.job.subtotals.contingencies[i], 0, ','));
        $("#contingency_" + i + "_percent").val(number_format(FECI.job.subtotals.contingency_percents[i] * 100, 1, ','));
    }
}

function calc_total_direct_costs() {
    //Total Direct Costs
    FECI.job.subtotals.total_direct_costs = [];
    let grandTotal = 0;

    //Iterate through first five columns
    for (i = 1; i <= 5; i++) {
        //Set to Item Total
        FECI.job.subtotals.total_direct_costs[i] = FECI.job.subtotals.item_totals[i];
        if (i > 1) {
            //If Low Sub, High Sub, Material or Labor add contingencies
            FECI.job.subtotals.total_direct_costs[i] += FECI.job.subtotals.contingencies[i];

            //If Labor, add PAC and Supervisory fee
            if (i === 5) {
                FECI.job.subtotals.total_direct_costs[i] += FECI.job.subtotals.pac + FECI.job.subtotals.supervisory_fee;
            }
        }

        grandTotal += parseInt(number_format(FECI.job.subtotals.total_direct_costs[i], 0,""));

        //Set field value
        $("#total_direct_cost_" + i).text(number_format(FECI.job.subtotals.total_direct_costs[i], 0, ','));
    }

    //Set total direct costs total field
    $("#total_direct_costs_total").text(number_format(grandTotal, 0, ','));
}

function calc_mark_up_costs() {
    //Mark-Up of Costs
    FECI.job.subtotals.mark_ups = [];
    FECI.job.subtotals.mark_up_percents = [];
    FECI.job.case1_subtotals.mark_ups = [];
    FECI.job.case2_subtotals.mark_ups = [];
    var mark_up_percent = 0;
    let = markUpCostsTotal = 0;

    for (i = 1; i <= 5; i++) {
        //Bonded
        if (i === 1) {
            FECI.job.subtotals.mark_ups[i] = parseFloat(FECI.job.bonded_mark_up);
            FECI.job.subtotals.mark_up_percents[i] = 0;

            //Case 1
            FECI.job.case1_subtotals.mark_ups[i] = FECI.job.subtotals.mark_ups[i];

            //Case 2
            FECI.job.case2_subtotals.mark_ups[i] = FECI.job.subtotals.mark_ups[i];
        }
        else {
            mark_up_percent = ($("#mark_up_percent_" + i).is("input")) ? $("#mark_up_percent_" + i).val() : $("#mark_up_percent_" + i).text();

            FECI.job.subtotals.mark_up_percents[i] = (mark_up_percent == "") ? 0 : parseFloat(number_format(mark_up_percent, 6, '')) / 100;

            FECI.job.subtotals.mark_ups[i] = Math.round(FECI.job.subtotals.mark_up_percents[i] * FECI.job.subtotals.total_direct_costs[i]);
        }

        $("#mark_up_" + i).text(number_format(FECI.job.subtotals.mark_ups[i], 0, ','));

        //Format percents for columns 3 (high sub) and 5 (labor)
        if (i == 3 || i == 5) {
            $("#mark_up_percent_" + i).val(number_format(FECI.job.subtotals.mark_up_percents[i] * 100, 4, ','));
        }

        markUpCostsTotal += parseInt(number_format(FECI.job.subtotals.mark_ups[i], 0, ''));
    }

    $("#mark_up_costs_total").text(number_format(markUpCostsTotal, 0, ","));

    //Case 1
    FECI.job.case1_subtotals.mark_ups[2] = Math.round(FECI.job.job_parms[38]['NumericValue'] * FECI.job.subtotals.total_direct_costs[2]);
    FECI.job.case1_subtotals.mark_ups[3] = Math.round(FECI.job.job_parms[52]['NumericValue'] * FECI.job.subtotals.total_direct_costs[3]);
    FECI.job.case1_subtotals.mark_ups[4] = Math.round(FECI.job.job_parms[40]['NumericValue'] * FECI.job.subtotals.total_direct_costs[4]);
    FECI.job.case1_subtotals.mark_ups[5] = Math.round(FECI.job.job_parms[53]['NumericValue'] * FECI.job.subtotals.total_direct_costs[5]);

    //Case 2
    FECI.job.case2_subtotals.mark_ups[2] = Math.round(FECI.job.job_parms[38]['NumericValue'] * FECI.job.subtotals.total_direct_costs[2]);
    FECI.job.case2_subtotals.mark_ups[3] = Math.round(FECI.job.job_parms[39]['NumericValue'] * FECI.job.subtotals.total_direct_costs[3]);
    FECI.job.case2_subtotals.mark_ups[4] = Math.round(FECI.job.job_parms[40]['NumericValue'] * FECI.job.subtotals.total_direct_costs[4]);
    FECI.job.case2_subtotals.mark_ups[5] = Math.round(FECI.job.job_parms[41]['NumericValue'] * FECI.job.subtotals.total_direct_costs[5]);
}

function calc_total_capacity_costs() {
    //Total after Capacity costs
    FECI.job.subtotals.total_capacity_costs = [];
    FECI.job.case1_subtotals.total_capacity_costs = [];
    FECI.job.case2_subtotals.total_capacity_costs = [];
    var total_capacity_cost = 0;
    var case1_total_capacity_cost = 0;
    var case2_total_capacity_cost = 0;

    for (i = 1; i <= 5; i++) {
        FECI.job.subtotals.total_capacity_costs[i] = FECI.job.subtotals.total_direct_costs[i] + FECI.job.subtotals.mark_ups[i];

        //Add to total of Capacity Costs
        total_capacity_cost += FECI.job.subtotals.total_capacity_costs[i];

        //Format and load into UI
        $("#total_capacity_cost_" + i).text(number_format(FECI.job.subtotals.total_capacity_costs[i], 0, ','));

        //Case 1
        FECI.job.case1_subtotals.total_capacity_costs[i] = FECI.job.subtotals.total_direct_costs[i] + FECI.job.case1_subtotals.mark_ups[i];
        case1_total_capacity_cost += FECI.job.case1_subtotals.total_capacity_costs[i];

        //Case 2
        FECI.job.case2_subtotals.total_capacity_costs[i] = FECI.job.subtotals.total_direct_costs[i] + FECI.job.case2_subtotals.mark_ups[i];
        case2_total_capacity_cost += FECI.job.case2_subtotals.total_capacity_costs[i];
    }

    FECI.job.totals.total_capacity_cost = total_capacity_cost;

    //Case 1
    FECI.job.case1_totals.total_capacity_cost = case1_total_capacity_cost;

    //Case 2
    FECI.job.case2_totals.total_capacity_cost = case2_total_capacity_cost;

    //Format and load Total Capacity Cost into UI
    $("#total_capacity_cost").text(number_format(FECI.job.totals.total_capacity_cost, 0, ','));
}

function calc_commission() {
    var case2_commission_percent = 0;

    //Regular Commission
    FECI.job.totals.regular_commission_percent = ($("#regular_commission_percent").val() == "") ? 0 : parseFloat(number_format($("#regular_commission_percent").val(),4,'')) / 100;
    $("#regular_commission_percent").val(number_format(FECI.job.totals.regular_commission_percent * 100, 4, ','));

    FECI.job.totals.regular_commission = Math.round(FECI.job.totals.total_capacity_cost * FECI.job.totals.regular_commission_percent);
    $("#regular_commission").text(number_format(FECI.job.totals.regular_commission, 0, ','));

    //Case 1
    FECI.job.case1_totals.regular_commission = Math.round(FECI.job.case1_totals.total_capacity_cost * parseFloat(FECI.job.job_parms[54]['NumericValue']));

    //Case 2
    case2_commission_percent = (FECI.job.department_idn == 1) ? FECI.job.job_parms[13]['NumericValue'] : FECI.job.job_parms[70]['NumericValue'];
    FECI.job.case2_totals.regular_commission = Math.round(FECI.job.case2_totals.total_capacity_cost * parseFloat(case2_commission_percent));

    //Subtotal
    FECI.job.totals.subtotal = FECI.job.totals.total_capacity_cost + FECI.job.totals.regular_commission;
    $("#subtotal").text(number_format(FECI.job.totals.subtotal, 0, ','));

    //Case 1
    FECI.job.case1_totals.subtotal = FECI.job.case1_totals.total_capacity_cost + FECI.job.case1_totals.regular_commission;

    //Case 2
    FECI.job.case2_totals.subtotal = FECI.job.case2_totals.total_capacity_cost + FECI.job.case2_totals.regular_commission;
}

function calc_profit_mark_up() {
    FECI.job.totals.profit_mark_up_percent = 0;
    FECI.job.totals.profit_mark_up = 0;
    FECI.job.totals.total_after_profit_mark_up = 0;
    var override_profit_mark_up_percent = $("#override_profit_mark_up_percent").val();

    //If user manually inputs Profit Mark Up dollar amount
    if (override_profit_mark_up_percent == 1) {
        FECI.job.totals.profit_mark_up_percent = 0;
        FECI.job.totals.profit_mark_up = parseFloat(strip_comma($("#profit_mark_up").val()));

        //calculate approximate percentage for display purposes only
        $(".approx-profit-mark-up-percent").removeClass("display_none");
        $("#ApproximateProfitMarkUpPercent").text(number_format(FECI.job.totals.profit_mark_up / FECI.job.totals.subtotal * 100, 2, ","));

        $("#profit_mark_up_percent").addClass('inactive');
    }
    else {
        FECI.job.totals.profit_mark_up_percent = ($("#profit_mark_up_percent").val() == "") ? 0 : parseFloat(number_format($("#profit_mark_up_percent").val(),2,'')) / 100;
        FECI.job.totals.profit_mark_up = Math.round(FECI.job.totals.profit_mark_up_percent * FECI.job.totals.subtotal);

        $(".approx-profit-mark-up-percent").addClass("display_none");

        $("#profit_mark_up_percent").removeClass('inactive');
    }

    $("#profit_mark_up_percent").val(number_format(FECI.job.totals.profit_mark_up_percent * 100, 2, ','));
    $("#profit_mark_up").val(number_format(FECI.job.totals.profit_mark_up, 0, ','));

    //Total After Profit Mark-Up
    FECI.job.totals.total_after_profit_mark_up = FECI.job.totals.subtotal + FECI.job.totals.profit_mark_up;
    $("#total_after_profit_mark_up").text(number_format(FECI.job.totals.total_after_profit_mark_up, 0, ','));

    //Case 1
    FECI.job.case1_totals.profit_mark_up = 0;
    FECI.job.case1_totals.total_after_profit_mark_up = FECI.job.case1_totals.subtotal;

    //Case 2
    FECI.job.case2_totals.profit_mark_up = 0;
    FECI.job.case2_totals.total_after_profit_mark_up = FECI.job.case2_totals.subtotal;
}

function calc_sales_tax() {
    //Sales Tax
    FECI.job.totals.sales_tax_percent = ($("#sales_tax_percent").val() == "") ? 0 : parseFloat(number_format($("#sales_tax_percent").val(), 2, '')) / 100;
    $("#sales_tax_percent").val(number_format(FECI.job.totals.sales_tax_percent * 100, 2, ','));

    //Sales tax is only a percentage of Total Material Direct Cost
    FECI.job.totals.sales_tax = Math.round(FECI.job.totals.sales_tax_percent * FECI.job.subtotals.total_direct_costs[4]);
    $("#sales_tax").text(number_format(FECI.job.totals.sales_tax, 0, ','));

    //Total after Sales Tax
    FECI.job.totals.total_after_sales_tax = FECI.job.totals.sales_tax + FECI.job.totals.total_after_profit_mark_up;
    $("#total_after_sales_tax").text(number_format(FECI.job.totals.total_after_sales_tax, 0, ','));

    //Case 1
    FECI.job.case1_totals.sales_tax = FECI.job.totals.sales_tax;
    FECI.job.case1_totals.total_after_sales_tax = FECI.job.case1_totals.total_after_profit_mark_up + FECI.job.totals.sales_tax;

    //Case 2
    FECI.job.case2_totals.sales_tax = FECI.job.totals.sales_tax;
    FECI.job.case2_totals.total_after_sales_tax = FECI.job.case2_totals.total_after_profit_mark_up + FECI.job.totals.sales_tax;
}

function calc_depository_fee() {
    FECI.job.totals.depository_fee_percent = ($("#depository_fee_percent").val() == "") ? 0 : parseFloat(number_format($("#depository_fee_percent").val(), 2, '')) / 100;
    FECI.job.totals.depository_fee = ($("#depository_fee").val() == "") ? 0 : parseInt(number_format(strip_comma($("#depository_fee").val()),0,''));
    FECI.job.totals.override_depository_fee_percent = $("#override_depository_fee_percent").val();

    if (FECI.job.totals.override_depository_fee_percent == 1) {
        FECI.job.totals.depository_fee_percent = 0;
        $("#depository_fee_percent").addClass("inactive");

        //Case 1 
        FECI.job.case1_totals.depository_fee = FECI.job.totals.depository_fee;

        //Case 2
        FECI.job.case2_totals.depository_fee = FECI.job.totals.depository_fee;
    }
    else {
        FECI.job.totals.depository_fee = Math.round(FECI.job.totals.total_after_sales_tax * FECI.job.totals.depository_fee_percent);
        $("#depository_fee_percent").removeClass('inactive');

        //Case 1
        FECI.job.case1_totals.depository_fee = Math.round(FECI.job.case1_totals.total_after_sales_tax * FECI.job.totals.depository_fee_percent);

        //Case 2
        FECI.job.case2_totals.depository_fee = Math.round(FECI.job.case2_totals.total_after_sales_tax * FECI.job.totals.depository_fee_percent);
    }

    $("#depository_fee").val(number_format(FECI.job.totals.depository_fee, 0, ','));
    $("#depository_fee_percent").val(number_format(FECI.job.totals.depository_fee_percent * 100, 2, ','));

    //Total after depository fee
    FECI.job.totals.total_after_depository_fee = FECI.job.totals.total_after_sales_tax + FECI.job.totals.depository_fee;
    $("#total_after_depository_fee").text(number_format(FECI.job.totals.total_after_depository_fee, 0, ','));

    //Case 1
    FECI.job.case1_totals.total_after_depository_fee = FECI.job.case1_totals.total_after_sales_tax + FECI.job.case1_totals.depository_fee;

    //Case 2
    FECI.job.case2_totals.total_after_depository_fee = FECI.job.case2_totals.total_after_sales_tax + FECI.job.case2_totals.depository_fee;

    return check_depository_fee_limit();
}

function check_depository_fee_limit() {
    var limit = 750;
    var depository_fee = parseInt(strip_comma($("#depository_fee").val()));

    if (depository_fee > limit && $("#override_depository_fee_limit").is(":checked") === false) {
        alert("'Depository Fee' is over the limit and will be changed to $" + limit + "!");
        $('#depository_fee').val(number_format(limit, 0, ','));

        //Set override dep fee percent flag to 1
        $("#override_depository_fee_percent").val("1");
        calc_depository_fee();
        $('#depository_fee').select();
        return false;
    }

    return true;
}

function calc_cost_of_bond() {
    FECI.job.totals.cost_of_bond = ($("#cost_of_bond").val() == "") ? 0 : parseFloat(strip_comma($("#cost_of_bond").val()));
    FECI.job.totals.cost_of_bond_percent = ($("#cost_of_bond_percent").val() == "") ? 0 : parseFloat(number_format($("#cost_of_bond_percent").val(),2,'')) / 100;
    FECI.job.totals.override_cost_of_bond_percent = $("#override_cost_of_bond_percent").val();

    //If user manually inputs Cost of Bond dollar amount
    if (FECI.job.totals.override_cost_of_bond_percent == 1) {
        FECI.job.totals.cost_of_bond_percent = 0;

        $("#cost_of_bond_percent").addClass('inactive');

        //Case 1 
        FECI.job.case1_totals.cost_of_bond = FECI.job.totals.cost_of_bond;

        //Case 2
        FECI.job.case2_totals.cost_of_bond = FECI.job.totals.cost_of_bond;
    }
    else {
        FECI.job.totals.cost_of_bond = Math.round(FECI.job.totals.cost_of_bond_percent * FECI.job.totals.total_after_depository_fee);

        $("#cost_of_bond_percent").removeClass('inactive');

        //Case 1
        FECI.job.case1_totals.cost_of_bond = Math.round(FECI.job.case1_totals.total_after_depository_fee * FECI.job.totals.cost_of_bond_percent);

        //Case 2
        FECI.job.case2_totals.cost_of_bond = Math.round(FECI.job.case2_totals.total_after_depository_fee * FECI.job.totals.cost_of_bond_percent);
    }

    $("#cost_of_bond_percent").val(number_format(FECI.job.totals.cost_of_bond_percent * 100, 2, ','));

    $("#cost_of_bond").val(number_format(FECI.job.totals.cost_of_bond, 0, ','));

    //Total after cost of bond
    FECI.job.totals.total_after_cost_of_bond = FECI.job.totals.cost_of_bond + FECI.job.totals.total_after_depository_fee;

    $("#total_after_cost_of_bond").html(number_format(FECI.job.totals.total_after_cost_of_bond, 0, ','));

    //Case 1
    FECI.job.case1_totals.total_after_cost_of_bond = FECI.job.case1_totals.total_after_depository_fee + FECI.job.case1_totals.cost_of_bond;

    //Case 2
    FECI.job.case2_totals.total_after_cost_of_bond = FECI.job.case2_totals.total_after_depository_fee + FECI.job.case2_totals.cost_of_bond;
}

function calc_gross_receipt() {
    FECI.job.totals.gross_receipt = ($("#gross_receipt").val() == "") ? 0 : parseFloat(strip_comma($("#gross_receipt").val()));
    FECI.job.totals.gross_receipt_percent = ($("#gross_receipt_percent").val() == "") ? 0 : parseFloat(number_format($("#gross_receipt_percent").val(),2,'')) / 100;
    FECI.job.totals.override_gross_receipt_percent = $("#override_gross_receipt_percent").val();

    //If user manually inputs Profit Mark Up dollar amount
    if (FECI.job.totals.override_gross_receipt_percent == 1) {
        FECI.job.totals.gross_receipt_percent = 0;

        $("#gross_receipt_percent").addClass('inactive');

        //Case 1 
        FECI.job.case1_totals.gross_receipt = FECI.job.totals.gross_receipt;

        //Case 2
        FECI.job.case2_totals.gross_receipt = FECI.job.totals.gross_receipt;
    }
    else {
        FECI.job.totals.gross_receipt = Math.round(FECI.job.totals.gross_receipt_percent * FECI.job.totals.total_after_cost_of_bond);

        $("#gross_receipt_percent").removeClass('inactive');

        //Case 1
        FECI.job.case1_totals.gross_receipt = Math.round(FECI.job.case1_totals.total_after_cost_of_bond * FECI.job.totals.gross_receipt_percent);

        //Case 2
        FECI.job.case2_totals.gross_receipt = Math.round(FECI.job.case2_totals.total_after_cost_of_bond * FECI.job.totals.gross_receipt_percent);
    }

    $("#gross_receipt_percent").val(number_format(FECI.job.totals.gross_receipt_percent * 100, 2, ','));

    $("#gross_receipt").val(number_format(FECI.job.totals.gross_receipt, 0, ','));
}

function check_case() {
    //Initialize and declare variables
    var total = parseInt(strip_comma($("#total").val()));
    var case1_total = parseInt(strip_comma($("#case1_total").text()));
    var case2_total = parseInt(strip_comma($("#case2_total").text()));

    if (total < case2_total && total >= case1_total) {
        //Case 1 Scenario
        case1_scenario();
    }

    if (total >= case2_total) {
        //Normal case
        normal_case_scenario();
    }
}

function case1_scenario() {
    $('#case_type').val('Y');

    //Set Profit Mark-Up fields to 0 and disable them
    $('#profit_mark_up_percent').val('0.00');
    $('#profit_mark_up_percent').prop("disabled", true);
    $('#profit_mark_up').val('0');
    $('#profit_mark_up').prop("disabled", true);
}

function normal_case_scenario() {
    //Set commission to job default based on department
    var commission = (FECI.job.department_idn === 1) ? FECI.job.job_parms[13]['NumericValue'] : FECI.job.job_parms[70]['NumericValue'];
    var mark_up_percent_3 = FECI.job.job_parms[39]['NumericValue'];
    var mark_up_percent_5 = FECI.job.job_parms[41]['NumericValue'];

    $('#case_type').val('N');
    $('#mark_up_percent_3').val(number_format(mark_up_percent_3 * 100, 4, ''));  //High Sub mark up
    $('#mark_up_percent_5').val(number_format(mark_up_percent_3 * 100, 4, '')); //Labor mark up
    $('#regular_commission_percent').val(number_format(commission * 100, 4, ''));
    $('#profit_mark_up_percent').prop('disabled', false); //Profit mark-up percent
    $('#profit_mark_up').prop('disabled', false); //Profit mark-up
}

function calc_sold_subtotal(total_amount) {

    var sold_subtotal = 0;

    //Variable input validation
    if (isNaN(total_amount) === false && total_amount > 0) {
        //Get values from recap
        //Gross Receipt
        var gross_receipt = FECI.job.totals.gross_receipt;
        var gross_receipt_percentage = FECI.job.totals.gross_receipt_percent;
        //Bond
        var bond = FECI.job.totals.cost_of_bond;
        var bond_percentage = FECI.job.totals.cost_of_bond_percent;
        //Depository fee
        var depository_fee = FECI.job.totals.depository_fee;
        var depository_fee_percentage = FECI.job.totals.depository_fee_percent;
        //Tax
        var tax = FECI.job.totals.sales_tax;

        //*******************************
        //Calculate subtotal amount
        //*******************************
        //Gross Receipt
        if (gross_receipt_percentage > 0) {
            sold_subtotal = Math.round(total_amount / (1 + gross_receipt_percentage));
        }
        else {
            sold_subtotal = total_amount - gross_receipt;
        }

        //Bond
        if (bond_percentage > 0) {
            sold_subtotal = Math.round(sold_subtotal / (1 + bond_percentage));
        }
        else {
            sold_subtotal = sold_subtotal - bond;
        }

        //Depository Fee
        if (depository_fee_percentage > 0) {
            sold_subtotal = Math.round(sold_subtotal / (1 + depository_fee_percentage));
        }
        else {
            sold_subtotal = sold_subtotal - depository_fee;
        }
        //Tax
        sold_subtotal = sold_subtotal - tax;
    }
    return sold_subtotal;
}

function build_parent_element() {

    var element_content = "";

    if (FECI.job.is_parent == 1)
    {
        element_content = '<a href="#" id="view_child_jobs" title="View Child Jobs">Child Jobs</a>';
    }
    else if (FECI.job.parent_idn > 0) {
        element_content = '<a href="/job/recap/' + FECI.job.parent_idn + '" title="View Parent Recap">View Parent Recap</a>';
    }
    else {
        element_content = '<a href="#" id="add_parent" title="Add Parent">Add Parent Job</a>';
    }

    $("#parent").html(element_content);
}

function recap_modal_handlers() {
    if ($._data($(".remove_child_jobs")[0], "events") == undefined) {
        //Event handler for delete button on copy job modal dialog
        $(".remove_child_jobs").click(function (e) {
            var jobs_checked = $(".remove_child_job:checked").length;

            if (jobs_checked > 0) {
                //Load dialog body
                $("#remove_child_jobs_modal .modal-body p").html("Remove selected jobs?");

                //Show modal dialog
                $('#remove_child_jobs_modal').modal('show');
            }
            else {
                alert("No child jobs are selected!");
            }
            e.preventDefault();
        });
    }

    if ($._data($("#remove_child_jobs")[0], "events") == undefined) {
        //Event handler for copy button on copy job modal dialog
        $("#remove_child_jobs").click(function () {
            //Get token for post submission
            //var feapps_token = $("input[name=" + FECI.token + "]").val();
            var job_numbers_serialized = "";

            //Get checked job numbers
            job_numbers_serialized = $(".remove_child_job:checked").serialize();

            //abort any pending request
            if (FECI.request) {
                FECI.request.abort();
            }

            FECI.request = $.ajax({
                url: FECI.base_url + "job/remove_parent/1",
                type: 'POST',
                dataType: "json",
                data: job_numbers_serialized
            });
            // callback handler that will be called on success
            FECI.request.done(function (response) {
                if (response !== null) {
                    if (response.return_code === 1) {
                        //Job(s) removed successfully
                        $("#remove_child_jobs_modal .modal-body p").html("Child Job(s) removed.");
                        $("#remove_child_jobs_modal").modal('hide');

                        var plural = (response.num_jobs_removed > 1) ? "s" : "";

                        //Remove tr element from Child Jobs modal
                        $.each(response.job_numbers_removed, function (i, job_number) {
                            $("#child" + job_number).remove();
                        });

                        $(".modal_message").text("Job" + plural + " removed.").addClass("bg-info").show();
                    }
                    else {
                        $("#remove_child_jobs_modal .modal-body p").html("Error removing job(s).");
                    }
                }
            });

            // callback handler that will be called on failure
            FECI.request.fail(function (jqXHR, textStatus, errorThrown) {
                // log the error to the console
                console.error("The following error occured: " + textStatus, errorThrown);
            });
        });
    }
}

function add_parent_modal_handlers() {
    //if ($._data($(".add_parent")[0], "events") == undefined) {
        //Event handler for copy button on copy job modal dialog
        $(".add_parent").click(function (e) {

            e.preventDefault();
            //Get token for post submission
            //var feapps_token = $("input[name=" + FECI.token + "]").val();
            var child_job_number = FECI.job.job_number;
            var parent_job_number = $(this).data('job_number');

            //abort any pending request
            if (FECI.request) {
                FECI.request.abort();
            }

            FECI.request = $.ajax({
                url: FECI.base_url + "job/add_parent/1/" + parent_job_number + '/' + child_job_number,
                type: 'POST',
                dataType: "json"
            });
            // callback handler that will be called on success
            FECI.request.done(function (response) {
                if (response !== null) {
                    if (response.return_code === 1) {
                        //Hide dialog
                        $("#parent_modal").modal("hide");
                        
                        //update parent link
                        FECI.job.parent_idn = parent_job_number;
                        build_parent_element();

                        //Set message
                        $(".message").text("Parent job added.").addClass("bg-info").show();
                    }
                    else {
                        //Set message
                        $(".message").text("Error adding parent job.").addClass("bg-info").show();
                    }
                }
            });

            // callback handler that will be called on failure
            FECI.request.fail(function (jqXHR, textStatus, errorThrown) {
                // log the error to the console
                console.error("The following error occured: " + textStatus, errorThrown);
            });
        });
    //}
}

function calc_budget_summary() {
    //Load amounts for calculations
    let total_sqft = ($("#bs_total_sqft").is("input")) ? $("#bs_total_sqft").val() : $("#bs_total_sqft").text();
    total_sqft = parseInt(strip_comma(total_sqft));
    let total_heads = parseFloat(strip_comma($("#bs_total_heads").text()));
    let material = parseFloat(strip_comma($("#total_direct_cost_4").text()));
    let field = Math.ceil(FECI.job.field_hours);
    let shop = Math.ceil(FECI.job.shop_hours);
    let eng = Math.ceil(FECI.job.engineer_hours);
    let cost = parseFloat(strip_comma($("#total_capacity_cost").text()));
    let price = parseFloat(strip_comma($("#total").val()));
    
    //Calculations
    let sqft_per_head = (total_heads > 0) ? total_sqft / total_heads : 0;
    let material_per_head = (total_heads > 0) ? material / total_heads: 0;
    let field_per_head = (total_heads > 0) ? field / total_heads : 0;
    let eng_per_head = (total_heads > 0) ? eng / total_heads : 0;
    let shop_per_head = (total_heads > 0) ? shop / total_heads : 0;
    let cost_per_sqft = (total_sqft > 0) ? cost / total_sqft : 0;
    let price_per_sqft = (total_sqft > 0) ? price / total_sqft : 0;

    //Display calculations
    $("#bs_sqft_per_head").text(number_format(sqft_per_head, 2, ","));
    $("#bs_material_per_head").text(number_format(material_per_head, 2, ","));
    $("#bs_field_per_head").text(number_format(field_per_head, 2, ","));
    $("#bs_eng_per_head").text(number_format(eng_per_head, 2, ","));
    $("#bs_shop_per_head").text(number_format(shop_per_head, 2, ","));
    $("#bs_cost_per_sqft").text(number_format(cost_per_sqft, 2, ","));
    $("#bs_price_per_sqft").text(number_format(price_per_sqft, 2, ","));
}