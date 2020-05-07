let jobmob = (function() {
  let self = this;

  self.mileage_rate = FECI.job["job_parms"][16]["NumericValue"];
  self.delivery_truck_mileage_rate = FECI.job["job_parms"][81]["NumericValue"];

  init();

  function init() {
    handlers();
    calc_jobmob_worksheet();
    format_numbers();
    format_fts_sections();
    set_field_subsistence_label();
  }

  function handlers() {
    $("#Miles").on("change", function(e) {
      set_miles();
      set_field_sub_pay();
      //calc_motel_rate();
      display_fts();
    });

    $("#MotelDailyRate").on("change", function(e) {
      //calc_motel_rate();
    });

    $("#AirFare").on("change", function(e) {
      set_airfare();
    });

    $(".fts_section").on("change", function(e) {
      format_fts_section(this);
    });

    $("#OVERRIDE_TOTAL_FIELD_HOURS").on("change", function(e) {
      if ($(this).is(":checked")) {
        $("#UserFieldHoursWrapper").show();
        $("#FieldHoursTotalWrapper").hide();
      } else {
        $("#UserFieldHoursWrapper").hide();
        $("#FieldHoursTotalWrapper").show();
      }
    });

    $(".calc-jobmob-worksheet").on("change", function(e) {
      calc_jobmob_worksheet();
    });

    //Link trips
    $("#DEL_EXP_STK_TRIPS").on("change", function(e) {
      $("#DEL_WAG_TRIPS").val($(this).val());
      $("#DEL_WAG_TRIPS").addClass("unsaved-change");
      calc_jobmob_worksheet();
    });

    $("#DEL_WAG_TRIPS").on("change", function(e) {
      $("#DEL_EXP_STK_TRIPS").val($(this).val());
      $("#DEL_EXP_STK_TRIPS").addClass("unsaved-change");
      calc_jobmob_worksheet();
    });
  }

  function calc_jobmob_worksheet() {
    self.totals = {
      sub: 0,
      sub18: 0,
      labor: 0
    };

    calc_design_travel();

    calc_subsistence();

    calc_freight();

    $("#LowSub").text(number_format(self.totals.sub18, 2, ","));
    $("#HighSub").text(number_format(self.totals.sub, 2, ","));
    $("#Field").text(number_format(self.totals.labor, 2, ","));
  }

  function calc_design_travel() {
    let sub = 0;
    let labor = 0;

    //Designer Vehicle / Airfare Expenses
    sub = precise_round(
      parseFloat(strip_comma($("#DES_EXP_VEH_MILES").val())) *
        self.mileage_rate *
        parseInt(strip_comma($("#DES_EXP_VEH_TRIPS").val())),
      2
    );
    sub += precise_round(
      parseFloat(strip_comma($("#DES_EXP_AIR_RATE").text())) *
        parseInt(strip_comma($("#DES_EXP_AIR_TRIPS").val())),
      2
    );
    sub += precise_round(
      parseInt(strip_comma($("#DES_EXP_CAR_DAYS").val())) *
        parseFloat(strip_comma($("#DES_EXP_CAR_RATE").val())) *
        parseInt(strip_comma($("#DES_EXP_CAR_TRIPS").val())),
      2
    );
    $("#DES_EXP_SUB_TOT").text(number_format(sub, 2, ","));

    self.totals.sub += sub;

    //Designer Travel Wages
    let travel_hours_per_trip = precise_round(
      parseFloat(strip_comma($("#DES_WAG_MILES").val())) / 60,
      2
    );
    $("#DES_WAG_HRS").text(number_format(travel_hours_per_trip, 2, ","));

    labor += precise_round(
      travel_hours_per_trip *
        parseFloat(strip_comma($("#DES_WAG_RATE").text())) *
        parseInt(strip_comma($("#DES_WAG_TRIPS").val())),
      2
    );
    labor += precise_round(
      parseFloat(strip_comma($("#DES_WAG_AIR_HRS").val())) *
        parseFloat(strip_comma($("#DES_WAG_AIR_RATE").text())) *
        parseInt(strip_comma($("#DES_WAG_AIR_TRIPS").val())),
      2
    );
    $("#DES_WAG_LAB_TOT").text(number_format(labor, 2, ","));

    self.totals.labor += labor;

    //Designer Subsistence
    sub = precise_round(
      parseInt(strip_comma($("#DES_SUB_LOD_DAYS").val())) *
        parseFloat(strip_comma($("#DES_SUB_LOD_RATE").val())),
      2
    );
    sub += precise_round(
      parseInt(strip_comma($("#DES_SUB_MEA_DAYS").val())) *
        parseFloat(strip_comma($("#DES_SUB_MEA_RATE").val())),
      2
    );
    $("#DES_SUB_SUB_TOT").text(number_format(sub, 2, ","));

    self.totals.sub += sub;
  }

  function calc_subsistence() {
    let sub = 0;
    let labor = 0;
    let travel_hours = 0;
    let office_trip_subtotal = 0;
    let hotel_trip_subtotal = 0;

    if ($("#fts_section1").prop("checked")) {
      //Office
      office_trip_subtotal = precise_round(parseFloat(strip_comma($("#F_TRK_EXP_OFF_MIL").val())) * self.mileage_rate, 2);
      $("#F_TRK_EXP_OFF_TOT").text(number_format(office_trip_subtotal, 2, ","));
      
      sub = precise_round(office_trip_subtotal * parseInt(strip_comma($("#F_TRK_EXP_OFF_TRIPS").val())), 2);

      //Hotel
      hotel_trip_subtotal = precise_round(parseFloat(strip_comma($("#F_TRK_EXP_HOT_MIL").val())) * self.mileage_rate, 2);
      $("#F_TRK_EXP_HOT_TOT").text(number_format(office_trip_subtotal, 2, ","));

      sub += precise_round(hotel_trip_subtotal * parseInt(strip_comma($("#F_TRK_EXP_HOT_TRIPS").val())), 2);
      $("#F_TRK_EXP_SUB_TOT").text(number_format(sub, 2, ","));

      self.totals.sub += sub;
    }

    if ($("#fts_section2").prop("checked")) {
      sub = precise_round(
        parseFloat(strip_comma($("#F_VEH_EXP_AIR_RATE").val())) *
          parseInt(strip_comma($("#F_VEH_EXP_AIR_TRIPS").val())),
        2
      );
      sub += precise_round(
        parseInt(strip_comma($("#F_VEH_EXP_CAR_DAYS").val())) *
          parseFloat(strip_comma($("#F_VEH_EXP_CAR_RATE").val())) *
          parseInt(strip_comma($("#F_VEH_EXP_CAR_TRIPS").val())),
        2
      );
      $("#F_VEH_EXP_SUB_TOT").text(number_format(sub, 2, ","));

      self.totals.sub += sub;
    }

    if ($("#fts_section3").prop("checked")) {
      let travel_hours_per_trip = precise_round(
        (parseFloat(strip_comma($("#F_WAG_MILES").val())) / 60) *
          parseInt(strip_comma($("#F_WAG_WORKERS").val())),
        2
      );
      let travel_trips = parseInt(strip_comma($("#F_WAG_TRIPS").val()));
      let travel_air_trips = parseInt(strip_comma($("#F_WAG_AIR_TRIPS").val()));
      let travel_air_hours = parseFloat(strip_comma($("#F_WAG_AIR_HRS").val()));

      $("#F_WAG_HRS").text(number_format(travel_hours_per_trip, 2, ","));

      labor = precise_round(
        travel_hours_per_trip *
          parseFloat(strip_comma($("#F_WAG_RATE").val())) *
          travel_trips,
        2
      );
      labor += precise_round(
        travel_air_hours *
          parseFloat(strip_comma($("#F_WAG_AIR_RATE").val())) *
          travel_air_trips,
        2
      );
      $("#F_WAG_LAB_TOT").text(number_format(labor, 2, ","));

      //Calculate total travel hours
      travel_hours =
        precise_round(travel_hours_per_trip * travel_trips, 2) +
        precise_round(travel_air_trips * travel_air_hours, 2);
      $("#F_SUB_TVL_HRS").text(number_format(travel_hours, 2, ","));

      self.totals.labor += labor;
    }

    if ($("#fts_section4").prop("checked")) {
      calc_sub_motel_meals();
      let total_field_hours =
        parseFloat(strip_comma($("#TotalFieldManHours").text())) + travel_hours;
      $("#F_SUB_TOT_HRS").text(number_format(total_field_hours, 2, ","));
      $("#FieldHoursTotal").text(number_format(total_field_hours, 2, ","));

      //Determine field hours based on override
      total_field_hours = $("#OVERRIDE_TOTAL_FIELD_HOURS").is(":checked")
        ? parseFloat(strip_comma($("#USER_TOTAL_FIELD_HOURS").val()))
        : total_field_hours;

      let work_weeks = precise_round(total_field_hours / 40, 2);
      $(".F_SUB_WRK_WEEK").text(number_format(work_weeks, 2, ","));

      let sub_week =
        parseFloat(strip_comma($("#F_SUB_MOTEL").text())) +
        parseFloat(strip_comma($("#F_SUB_MEALS").text())) +
        parseFloat(strip_comma($("#F_SUB_PAY").val()));
      $("#F_SUB_WEEK").text(number_format(sub_week, 2, ","));

      let week_total = precise_round(sub_week * work_weeks, 2);
      $("#F_SUB_SUB_TOT").text(number_format(week_total, 2, ","));

      sub = week_total;

      self.totals.sub += sub;
    }

    if ($("#fts_section5").prop("checked")) {
      sub =
        precise_round(
          parseFloat(strip_comma($("#F_SUN_WRK_WEEKS").val())) *
            parseFloat(strip_comma($("#F_SUN_MOTEL").text())),
          2
        ) + parseFloat(strip_comma($("#F_SUN_MEAL").val()));

      $("#F_SUN_SUB_TOT").text(number_format(sub, 2, ","));

      self.totals.sub += sub;
    }

    if ($("#fts_section6").prop("checked")) {
      labor = precise_round(
        parseFloat(strip_comma($("#INTERIM_HOURS").val())) *
          parseFloat(strip_comma($("#INTERIM_RATE").val())) *
          parseFloat(strip_comma($("#INTERIM_TRIPS").val())),
        2
      );

      $("#INTERIM_TOTAL").text(number_format(labor, 2, ","));

      self.totals.labor += labor;
    }
  }

  function calc_freight() {
    let sub = 0;
    let labor = 0;
    let truck_expense = 0;
    let travel_hours = 0;
    let subsistence_days = 0;
    let carrier_total = 0;

    //Delivery Truck Expense
    truck_expense = precise_round(
      parseFloat(strip_comma($("#DEL_EXP_STK_MIL").val())) *
        self.delivery_truck_mileage_rate,
      2
    );
    $("#DEL_EXP_STK_TOT").text(number_format(truck_expense, 2, ","));

    sub = precise_round(
      truck_expense * parseFloat(strip_comma($("#DEL_EXP_STK_TRIPS").val())),
      2
    );
    $("#DEL_EXP_SUB_TOT").text(number_format(sub, 2, ","));

    self.totals.sub += sub;

    //Delivery Driver's Travel Wage
    travel_hours = precise_round(
      parseFloat(strip_comma($("#DEL_WAG_MILES").val())) / 60,
      2
    );
    $(".DEL_WAG_HRS").text(number_format(travel_hours, 2, ","));

    labor = precise_round(
      travel_hours *
        parseFloat(strip_comma($("#DEL_WAG_RATE").val())) *
        parseFloat(strip_comma($("#DEL_WAG_TRIPS").val())),
      2
    );
    $("#DEL_WAG_LAB_TOT").text(number_format(labor, 2, ","));

    self.totals.labor += labor;

    //Delivery Driver's Subsistence
    subsistence_days = precise_round(travel_hours / 8, 1);
    $("#DEL_SUB_DAYS").text(number_format(subsistence_days, 1, ","));

    sub = precise_round(
      subsistence_days *
        parseFloat(strip_comma($("#DEL_SUB_RATE").val())) *
        parseInt(strip_comma($("#DEL_SUB_TRIPS").val())),
      2
    );
    $("#DEL_SUB_SUB_TOT").text(number_format(sub, 2, ","));

    self.totals.sub += sub;

    //Freight / Common Carrier
    carrier_total = precise_round(
      parseFloat(strip_comma($("#FRT_LOADS").val())) *
        parseFloat(strip_comma($("#FRT_RATE").val())),
      2
    );

    if ($("#frt_quoted").is("input:checked")) {
      self.totals.sub18 = carrier_total;
    } else {
      self.totals.sub += carrier_total;
    }
  }

  function set_miles() {
    let miles_fields = [
      "DES_EXP_VEH_MILES",
      "DES_WAG_MILES",
      "F_TRK_EXP_OFF_MIL",
      "F_WAG_MILES",
      "DEL_EXP_STK_MIL",
      "DEL_WAG_MILES"
    ];
    let miles = parseFloat(strip_comma($("#Miles").val()));

    $.each(miles_fields, function(index, field_name) {
      $("#" + field_name).val(number_format(miles * 2, 0, ","));
      $("#" + field_name).trigger("change");
    });
  }

  function set_airfare() {
    let airfare_fields = ["DES_EXP_AIR_RATE", "F_VEH_EXP_AIR_RATE"];
    let airfare = parseFloat(strip_comma($("#AirFare").val()));

    $.each(airfare_fields, function(index, field_name) {
      let $field = $("#" + field_name);

      if ($field.is("input")) {
        $field.val(number_format(airfare, 2, ","));
        $field.trigger("change");
      } else {
        $field.text(number_format(airfare, 2, ","));
      }
    });
  }

  function format_fts_sections() {
    $.each($(".fts_section"), function(i, checkbox) {
      format_fts_section(checkbox);
    });
  }

  function format_fts_section(checkbox) {
    let section = $(checkbox).val();
    let $rows = $("tr.fts" + section);

    if ($(checkbox).is(":checked")) {
      $rows.removeClass("fts-inactive");
      $rows.find("input:not(.fts_section)").attr("disabled", false);
    } else {
      $rows.find("input:not(.fts_section)").attr("disabled", true);
      $rows.addClass("fts-inactive");
    }
  }

  function display_fts() {
    let miles = parseFloat(strip_comma($("#Miles").val()));
    let active_sections = [];

    if (miles < 60) {
      active_sections = [1];
    } else if (miles >= 60 && miles < 100) {
      active_sections = [1, 3, 4];
    } else if (miles >= 100 && miles < 450) {
      active_sections = [1, 3, 4, 5, 6];
    } else {
      active_sections = [1, 2, 3, 4, 6];
    }

    //Checkboxes
    $(".fts_section").each(function(index) {
      if ($.inArray(parseInt($(this).val()), active_sections) !== -1) {
        $(this)
          .prop("checked", true)
          .trigger("change");
      } else {
        $(this)
          .prop("checked", false)
          .trigger("change");
      }
    });

    set_field_subsistence_label();
  }

  function set_field_subsistence_label() {
    let fsm_name = "";
    let miles = parseFloat(strip_comma($("#Miles").val()));

    if (miles >= 60 && miles < 100) {
      fsm_name = "60-100 Miles (Evanston, Logan, Tremonton, Nephi)";
    } else if (miles >= 100 && miles < 450) {
      fsm_name = "100-450 Miles";
    } else if (miles >= 450) {
      fsm_name = "Over 450 Miles";
    }

    //Set Field subsistence label
    $("#field_subsistence_miles").html(fsm_name);
  }

  function set_field_sub_pay() {
    let miles = parseFloat(strip_comma($("#Miles").val()));
    let sd_field_labor_rate =
      FECI.job.department_idn == 1
        ? FECI.job.job_defaults[1]["NumericValue"]
        : FECI.job.job_defaults[65]["NumericValue"];
    let labor_difference =
      FECI.job.job_parms[19]["NumericValue"] - sd_field_labor_rate;
    let f_sub_pay = 0;
    let current_f_sub_pay = 0;

    //Davis Bacon Job logic
    if (
      FECI.job.job_parms[30]["AlphaValue"] == "Y" &&
      ((miles >= 100 && miles < 450 && labor_difference >= 1) ||
        (miles >= 450 && labor_difference >= 2))
    ) {
      f_sub_pay = 0;
    } else {
      if (miles < 60) {
        f_sub_pay = 0;
      } else if (miles >= 60 && miles < 100) {
        f_sub_pay = FECI.job.job_parms[4]["NumericValue"];
      } else if (miles >= 100 && miles < 450) {
        f_sub_pay = FECI.job.job_parms[5]["NumericValue"];
      } else if (miles >= 450) {
        f_sub_pay = FECI.job.job_parms[6]["NumericValue"];
      }
    }

    current_f_sub_pay = parseFloat(strip_comma($("#F_SUB_PAY").val()));

    if (current_f_sub_pay !== parseFloat(f_sub_pay)) {
      $("#F_SUB_PAY")
        .val(number_format(f_sub_pay, 2, ","))
        .trigger("change");
    }
  }

  function calc_sub_motel_meals() {
    //First determine motel and meal days
    let motel_days = 0;
    let meal_days = 0;
    const miles = parseFloat(strip_comma($("#Miles").val()));

    if (miles < 100) {
      motel_days = 3;
      meal_days = 4;
    } else if (miles >= 100 && miles < 450) {
      motel_days = 4;
      meal_days = 5;
    } else {
      motel_days = 7;
      meal_days = 7;
    }

    $("#FieldMealDays").text(number_format(meal_days, 0, ","));
    $("#FieldMotelDays").text(number_format(motel_days, 0, ","));

    //Then calculate motel and meal costs
    const motel_daily_rate = parseFloat(
      strip_comma($("#MotelDailyRate").val())
    );
    let half_motel_cost = 0;
    const food_allowance = FECI.job.job_parms[3]["NumericValue"];

    half_motel_cost = parseFloat(number_format(motel_daily_rate / 2, 2, ""));

    //Set Sunday Travel Subsistence motel rate
    $("#F_SUN_MOTEL").text(number_format(half_motel_cost, 2, ","));

    //Set Field Subsistence motel field
    $("#F_SUB_MOTEL").text(number_format(half_motel_cost * motel_days, 2, ","));
    $("#F_SUB_MEALS").text(number_format(food_allowance * meal_days, 2, ","));
  }

  return {
    calc_jobmob_worksheet: calc_jobmob_worksheet
  };
})();
