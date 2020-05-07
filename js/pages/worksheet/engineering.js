var engineering = (function () {

    var adjustment_factor_idns = [];
    var additional_cost_idns = [];

    //Multiselect plugin
    $("#AdjustmentFactorsSelect").multiselect({
        buttonText: function (options, select) {
            return "Adjustment Factors";
        },
        onChange: adjustment_factors_select_handler,
        onDropdownHidden: function (event) {
        }
    });

    $("#AdditionalCostsSelect").multiselect({
        buttonText: function (options, select) {
            return "Coordination, Processing and Additional Costs";
        },
        onChange: additional_costs_select_handler
    });

    init();

    function init() {
        get_adjustment_factor_idns();
        select_adjustment_factors();
        get_additional_cost_idns();
        select_additional_costs();
        handlers();
        calc_engineering_worksheet();
    }

    function handlers() {
        $(".calc-engineering-worksheet").on("change", function (e) {
            calc_engineering_worksheet();
        });
    }

    function calc_engineering_worksheet() {
        var worksheet_total_hours = 0;
        var worksheet_total = 0;

        //Basic Appropriations
        var basic_appropriations_subtotal_hours = calc_basic_appropriations();

        //Adjustment Factors
        var adjustment_factors_total = calc_adjustment_factors(basic_appropriations_subtotal_hours);

        //Additional Costs
        var additional_costs_total = calc_additional_costs();

        //Calculate total engineering hours and total engineer cost
        if ($("#OverrideEngineerHours").is(":checked")) {
            worksheet_total_hours = precise_round(parseFloat(strip_comma($("#UserEngineerHours").val())), 2);
        } else {
            worksheet_total_hours = Math.ceil(additional_costs_total + adjustment_factors_total);
        }
        worksheet_total = Math.ceil(worksheet_total_hours * parseFloat(FECI.job.design_labor_rate));

        //Load total hours and total amount
        $("#EngineerHoursTotal").html(number_format(worksheet_total_hours, 0, ","));
        $("#EngineerTotal").html(number_format(worksheet_total, 0, ","));
    }

    function calc_basic_appropriations() {
        var row_id = "", element_id = "";
        var eng_hours = 0;
        var row_total_hours = 0;
        var num_heads = 0, total_heads = 0;
        var labor_class_factor = 0;
        var individual_adjustment_factor = 0;
        var original_system_quantity = 0;
        var identical_quantity = 0, identical_system_price = 0, identical_system_price_extended = 0;
        var basic_appropriations_subtotal_hours = 0;
        var man_hours_per_item = 0

        //Basic Appropriations
        $(".basic-appropriation").each(function () {
            element_id = $(this).attr("id");
            row_id = element_id.substring("BasicAppropriation".length);
            num_heads = parseFloat(strip_comma($("#NumberOfHeads" + row_id).html()));
            total_heads += num_heads;

            if ($("#LaborClass" + row_id).length > 0) {
                //Get factors
                labor_class_factor = parseFloat($("#LaborClass" + row_id).find(":selected").data("factor"));
                individual_adjustment_factor = parseFloat($("#IndividualAdjustmentFactor" + row_id).find(":selected").data("factor"));

                //Field totals
                //eng_hours = labor_class_factor;
                man_hours_per_item = precise_round(labor_class_factor * individual_adjustment_factor, 2);
                //row_total_hours = precise_round(eng_hours * individual_adjustment_factor, 2);

                //Identical System
                if ($("#IndividualAdjustmentFactor" + row_id).val() == 148) {
                    //Display Identical system row and original system quantity
                    $("#IdenticalSystem" + row_id).removeClass("hide");
                    $("#OriginialSystemWrapper" + row_id).removeClass("hide");

                    //Calculate values
                    original_system_quantity = Math.round(parseFloat(strip_comma($("#OriginalSystemQuantity" + row_id).val())));
                    //Value entered cannot be greater than number of heads
                    if (original_system_quantity > num_heads) {
                        original_system_quantity = num_heads;
                    }

                    row_total_hours = precise_round(man_hours_per_item * original_system_quantity, 2);

                    //Calculate identical system row
                    identical_quantity = num_heads - original_system_quantity;
                    identical_system_price = precise_round(labor_class_factor * parseFloat(FECI.job.job_parms['75']['NumericValue']), 2);
                    identical_system_price_extended = precise_round(identical_quantity * identical_system_price, 2);

                    //Basic Appropriations subtotal
                    basic_appropriations_subtotal_hours += identical_system_price_extended;

                    //Load fields
                    $("#IdenticalSystemQuantity" + row_id).html(number_format(identical_quantity, 0, ","));
                    $("#IdenticalSystemPrice" + row_id).html(number_format(identical_system_price, 2, ","));
                    $("#IdenticalSystemPriceExtended" + row_id).html(number_format(identical_system_price_extended, 2, ","));
                    $("#OriginalSystemQuantity" + row_id).val(number_format(original_system_quantity, 0, ","));
                } else {
                    //Hide row and Original quantity
                    $("#IdenticalSystem" + row_id).addClass("hide");
                    $("#OriginialSystemWrapper" + row_id).addClass("hide");

                    row_total_hours = precise_round(man_hours_per_item * num_heads, 2);
                }
                $("#EngineeringUnitPrice" + row_id).html(number_format(man_hours_per_item, 2, ","));
            } else {
                man_hours_per_item = precise_round(parseFloat(strip_comma($("#EngineeringUnitPrice" + row_id).val())), 2);
                row_total_hours = precise_round(num_heads * man_hours_per_item, 2);

                $("#EngineeringUnitPrice" + row_id).val(number_format(man_hours_per_item, 2, ","));
            }

            //Worksheet total hours
            basic_appropriations_subtotal_hours += row_total_hours;

            //Load line elements
            $("#EngineeringUnitPriceExtended" + row_id).html(number_format(row_total_hours, 2, ","));
        });

        //Load total Heads and Total Hours
        $("#BasicAppropriationsTotalHeads").html(number_format(total_heads, 0, ","));
        $("#BasicAppropriationsEngineeringHoursSubTotal").html(number_format(basic_appropriations_subtotal_hours, 2, ","));

        return basic_appropriations_subtotal_hours;
    }

    function calc_adjustment_factors(basic_appropriations_subtotal_hours) {
        var row_id = "";
        var adjustment_factor = {
            total: basic_appropriations_subtotal_hours,
            factor: 0, 
            row_total: 0
        };

        $(".adjustment-factor").each(function () {
            row_id = $(this).attr("id");

            adjustment_factor.factor = parseFloat($("#Value" + row_id).html());
            adjustment_factor.row_total = precise_round(basic_appropriations_subtotal_hours * adjustment_factor.factor, 2);
            adjustment_factor.total += adjustment_factor.row_total;

            //Load row fields
            $("#Total" + row_id).html(number_format(adjustment_factor.row_total, 2, ","));
        });

        $("#BasicAppropriationsEngineeringHoursTotal").html(number_format(adjustment_factor.total, 2, ","));

        return adjustment_factor.total;
    }

    function calc_additional_costs() {
        let row_id = "";
        let additional_cost = {
            quantity: 0,
            unit_price: 0,
            unit_price_extended: 0,
            total: 0
        };

        //$("#EngineeringUnitPriceSpanAdditionalCost_1").html("5.00");
        //$("#EngineeringUnitPriceAdditionalCost_1").val("5.00");
        calc_min_design_processing_costs();

        $(".additional-cost").each(function () {
            row_id = $(this).attr("id");
            //Get values and calculate totals
            additional_cost.quantity = parseFloat(strip_comma($("#Quantity" + row_id).val()));
            additional_cost.unit_price = ($(this).data("additionalcost_idn") == 1) ? $("#EngineeringUnitPriceSpan" + row_id).html() : $("#EngineeringUnitPrice" + row_id).val()
            additional_cost.unit_price = parseFloat(strip_comma(additional_cost.unit_price));
            additional_cost.unit_price_extended = precise_round(additional_cost.quantity * additional_cost.unit_price, 2);
            additional_cost.total += additional_cost.unit_price_extended;

            //Load fields
            $("#Quantity" + row_id).val(number_format(additional_cost.quantity, 0, ","));
            $("#EngineeringUnitPrice" + row_id).val(number_format(additional_cost.unit_price, 2, ","));
            $("#EngineeringUnitPriceExtended" + row_id).html(number_format(additional_cost.unit_price_extended, 2, ","));
        });

        return additional_cost.total;
    }

    function adjustment_factors_select_handler(option, checked) {
        //Get all checked options
        var $selected_adjustment_factors = $("#AdjustmentFactorsSelect option:selected");
        var $adjustment_factors = $("#AdjustmentFactorsSelect option");
        var afs = [], selected_afs = [];
        var i = 0;
        var $af = "";

        $.each($selected_adjustment_factors, function (index, af) {
            selected_afs[i++] = $(af).val();
        });

        i = 0;
        $.each($adjustment_factors, function (index, af) {
            $af = $(af);
            afs.push({
                "AdjustmentSubFactor_Idn": $af.val(),
                "Name": $af.text(),
                "Value": $af.data("value")
            });
        });

        //Update Worksheet adjustments
        save_adjustment_factors(selected_afs, afs);
    }

    function save_adjustment_factors(selected_afs, afs) {

        //Abort any pending Ajax Requests
        if (FECI.request) {
            FECI.request.abort();
        }

        //AJAX request
        FECI.request = $.ajax({
            url: FECI.base_url + "worksheet_controller/save_engineering_adjustment_factors/" + FECI.worksheet.Worksheet_Idn,
            type: "POST",
            dataType: "json",
            data: { 
                "SelectedAdjustmentFactors": selected_afs, 
                "AdjustmentFactors": afs, 
                "Ajax": true}
        });

        //Success callback handler
        FECI.request.done(function (response, textStatus, jqXHR) {
            //console.log(response);
            //Determine which page to navigate to
            if (response.errors == 0) {
                //Update UI
                update_adjustment_factors_ui(response);

            } else {
                displayMessageBox("Error saving adjustment factors", "danger");
            }
        });

        //Failure callback handler 
        FECI.request.fail(function (jqXHR, textStatus, errorThrown) {
            displayMessageBox("Fatal error saving adjustment factors:" + textStatus + " " + errorThrown, "danger");
        });
    }

    function update_adjustment_factors_ui(response) {
        //Cache DOM
        var $adjustment_factors = $(".adjustment-factor");
        var row_rank = 0;

        $.each(response.deletes, function (index, d) {
            $("#AdjustmentFactor_" + d).remove();
        });

        $.each(response.inserts, function (index, i) {
            //Insert into DOM
            if (i.Rank == 1 || $adjustment_factors.length == 0) {
                $("#AdjustmentFactors tr:first").after(i.Html);
            } else {
                $.each($adjustment_factors, function (index, row) {
                    row_rank = parseInt($(row).data("rank"));
                    if (row_rank + 1 == i.Rank) {
                        $(row).after(i.Html);
                    }
                });
            }
        });

        //Craft and display message
        var s = "";
        if (response.deletes.length > 0) {
            s = (response.deletes.length == 1) ? "" : "s";
            message_text = response.deletes.length + " adjustment factor" + s + " deleted.";
        } else if (response.inserts.length > 0) {
            s = (response.inserts.length == 1) ? "" : "s";
            message_text = response.inserts.length + " adjustment factor" + s + " saved.";
        } else {
            message_text = "Nothing was saved.";
        }
        displayMessageBox(message_text, "success");

        calc_engineering_worksheet();
    }

    function get_adjustment_factor_idns() {
        $.each($(".adjustment-factor"), function (index, af) {
            adjustment_factor_idns.push($(af).data("adjustmentsubfactor_idn"));
        });
    }

    function select_adjustment_factors() {
        $("#AdjustmentFactorsSelect").multiselect("select",adjustment_factor_idns);
    }

    function additional_costs_select_handler(option, checked) {
        //Get all checked options
        var $selected_additional_costs = $("#AdditionalCostsSelect option:selected");
        var $additional_costs = $("#AdditionalCostsSelect option");
        var acs = [], selected_acs = [];
        var i = 0;
        var $ac = "";

        $.each($selected_additional_costs, function (index, row) {
            selected_acs[i++] = $(row).val();
        });

        i = 0;
        $.each($additional_costs, function (index, row) {
            $ac = $(row);
            acs.push({
                "AdditionalCost_Idn": $ac.val(),
                "Name": $ac.text(),
                "ManHours": $ac.data("manhours"),
                "Quantity": $ac.data("quantity"),
                "DefaultFlag": $ac.data("defaultflag"),
                "Rank" : $ac.data("rank")
            });
        });

        //Update Worksheet adjustments
        save_additional_costs(selected_acs, acs);
    }

    function save_additional_costs(selected_acs, acs) {
        //Abort any pending Ajax Requests
        if (FECI.request) {
            FECI.request.abort();
        }

        //AJAX request
        FECI.request = $.ajax({
            url: FECI.base_url + "worksheet_controller/save_engineering_additional_costs/" + FECI.worksheet.Worksheet_Idn,
            type: "POST",
            dataType: "json",
            data: {
                "SelectedAdditionalCosts": selected_acs,
                "AdditionalCosts": acs,
                "Ajax": true
            }
        });

        //Success callback handler
        FECI.request.done(function (response, textStatus, jqXHR) {
            //console.log(response);
            if (response.errors == 0) {
                //Update UI
                update_additional_costs_ui(response);
            } else {
                displayMessageBox("Error saving adjustment factors", "danger");
            }
        });

        //Failure callback handler 
        FECI.request.fail(function (jqXHR, textStatus, errorThrown) {
            displayMessageBox("Fatal error saving adjustment factors: " + textStatus + " " + errorThrown, "danger");
        });
    }

    function update_additional_costs_ui(response) {
        //Declare variables
        var row_rank = 0;
        var message_text = "";
        var s = "";

        $.each(response.deletes, function (index, d) {
            $("#AdditionalCost_" + d).remove();
        });

        $.each(response.inserts, function (index, i) {
            //Insert into DOM
            if (i.Rank == 1 || $(".additional-cost").length == 0) {
                $("#AdditionalCosts tr:first").after(i.Html);
            } else {
                $.each($(".additional-cost"), function (index, row) {
                    row_rank = parseInt($(row).data("rank"));
                    next_row_rank = $(row).next().data("rank");
                    if (typeof next_row_rank === "undefined" || (i.Rank > row_rank && i.Rank < next_row_rank)) {
                        $(row).after(i.Html);
                        return false;
                    }
                });

                if (response.inserts.length > 1) {
                    $("#AdditionalCost_" + i.Rank).after(response.inserts[index + 1].Html);
                    return false;
                }
            }
        });

        //Craft and display message
        if (response.deletes.length > 0) {
            s = (response.deletes.length == 1) ? "" : "s";
            message_text = response.deletes.length + " additional cost" + s + " deleted.";
        } else if (response.inserts.length > 0) {
            s = (response.inserts.length == 1) ? "" : "s";
            message_text = response.inserts.length + " additional cost" + s + " saved.";
        } else {
            message_text = "Nothing was saved.";
        }
        displayMessageBox(message_text, "success");

        calc_engineering_worksheet();
    }

    function get_additional_cost_idns() {
        $.each($(".additional-cost"), function (index, af) {
            additional_cost_idns.push($(af).data("additionalcost_idn"));
        });
    }

    function select_additional_costs() {
        $("#AdditionalCostsSelect").multiselect("select", additional_cost_idns);
    }

    function calc_min_design_processing_costs() {
        var total_heads = 0;
        var man_hours = 0;

        total_heads = parseFloat(strip_comma($('#BasicAppropriationsTotalHeads').html()));

        if (total_heads < 100) {
            man_hours = 4;
        }
        else if (total_heads >= 100 && total_heads < 500) {
            man_hours = 8;
        }
        else if (total_heads >= 500 && total_heads < 1000) {
            man_hours = 16;
        }
        else if (total_heads >= 1000) {
            man_hours = 24;
        }

        $("#EngineeringUnitPriceSpanAdditionalCost_1").html(number_format(man_hours, 2, ","));
        //$("#EngineeringUnitPriceAdditionalCost_1").val(man_hours);
        console.log(man_hours);
        if (man_hours != parseInt($("#EngineeringUnitPriceAdditionalCost_1").val())) {
            displayMessageBox('Man hours for "Minimum Design Processing Costs" have changed. Please save worksheet so changes are reflected on Job Recap', "danger");
        }
    }

    return {
        calc_engineering_worksheet: calc_engineering_worksheet
    };

})();