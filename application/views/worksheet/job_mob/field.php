<?php
$jm = $worksheet['JobMob'];
$mileage_rate = $job['job_parms'][16]['NumericValue'];
$motel_daily_rate = $job['job_parms'][32]['NumericValue'];
$food_allowance = $job['job_parms'][3]['NumericValue'];
$fts_sections = (isset($worksheet['WorksheetParms']['ParmValues']['FTSSections'][0])) ? explode(",", $worksheet['WorksheetParms']['ParmValues']['FTSSections'][0]) : array();
?>
<tbody id="FieldTravelSubsistence">
<tr>
	<th colspan="3">
	<span class="pull-left">Total Field Man Hours: &lt;<span id="TotalFieldManHours"><?php echo number_format($job['field_hours'],1); ?></span>&gt;</></span>
	<span class="section_title">Field and Travel Subsistence</span>			   
	</th>
	<th>Trips</th>
	<th>Subcontract</th>
	<th>Labor</th>
</tr>
		
<tr class="fts1">
	<td rowspan="2">
        <input type="checkbox" id="fts_section1" name="fts_section[]" class="fts_section calc-jobmob-worksheet" value="1" <?php if (in_array("1",$fts_sections)) echo 'checked="checked"'; ?> />
        <label for="fts_section1">1</label>
	</td>
	<td rowspan="2" class="left-aligned">
        Field Truck Expense
	</td>
	<td class="left-aligned">
        <input type="text" name="F_TRK_EXP_OFF_MIL" id="F_TRK_EXP_OFF_MIL" value="<?php echo $jm['f_trk_exp_off_mil']; ?>" title="Miles Round Trip (Office)" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['f_trk_exp_off_mil']; ?>" /> 
        Miles round-trip (Office) @ <?php echo "$".number_format($mileage_rate,2); ?> = 
        $<span id="F_TRK_EXP_OFF_TOT"></span>
	</td>
	<td>
        <input type="text" name="F_TRK_EXP_OFF_TRIPS" id="F_TRK_EXP_OFF_TRIPS" value="<?php echo $jm['f_trk_exp_off_trips']; ?>" title="Office Trips" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value trip" data-recent-value="<?php echo $jm['f_trk_exp_off_trips']; ?>" />
	</td>
	<td rowspan="2">
        $<span id="F_TRK_EXP_SUB_TOT" class="fts_total"></span>
	</td>
	<td rowspan="2" class="rowdisabled">&nbsp;</td>
</tr>
<tr class="fts1">
	<td class="left-aligned">
        <input type="text" name="F_TRK_EXP_HOT_MIL" id="F_TRK_EXP_HOT_MIL" value="<?php echo $jm['f_trk_exp_hot_mil']; ?>" title="Miles Round Trip (Hotel)" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['f_trk_exp_hot_mil']; ?>" /> 
        Miles round-trip (Hotel) @ <?php echo "$".number_format($mileage_rate,2); ?> = 
        $<span id="F_TRK_EXP_HOT_TOT"></span>
	</td>
	<td>
        <input type="text" name="F_TRK_EXP_HOT_TRIPS" id="F_TRK_EXP_HOT_TRIPS" value="<?php echo $jm['f_trk_exp_hot_trips']; ?>" title="Hotel Trips" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value trip" data-recent-value="<?php echo $jm['f_trk_exp_hot_trips']; ?>" />
	</td>
</tr>
<tr class="fts2">
	<td rowspan="2">
        <input type="checkbox" id="fts_section2" name="fts_section[]" class="fts_section calc-jobmob-worksheet" value="2" <?php if (in_array("2",$fts_sections)) echo 'checked="checked"'; ?> />
        <label for="fts_section2">2</label>
	</td>
	<td rowspan="2" class="left-aligned">
        Field Airfare / Vehicle Expense
    </td>
	<td class="left-aligned">
	    $<input type="text" name="F_VEH_EXP_AIR_RATE" id="F_VEH_EXP_AIR_RATE" value="<?php echo $jm['f_veh_exp_air_rate']; ?>" title="Field Airfare" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['f_veh_exp_air_rate']; ?>" /> Airfare
	</td>
	<td>
	    <input type="text" name="F_VEH_EXP_AIR_TRIPS" id="F_VEH_EXP_AIR_TRIPS" value="<?php echo $jm['f_veh_exp_air_trips']; ?>" title="Field Air Trips" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value trip" data-recent-value="<?php echo $jm['f_veh_exp_air_trips']; ?>" />
	</td>
	<td rowspan="2">
        $<span id="F_VEH_EXP_SUB_TOT" class="fts_total"></span>
	</td>
	<td class="rowdisabled" rowspan="2">&nbsp;</td>
</tr>
<tr class="fts2">
	<td class="left-aligned">
	    <input type="text" name="F_VEH_EXP_CAR_DAYS" id="F_VEH_EXP_CAR_DAYS" value="<?php echo $jm['f_veh_exp_car_days']; ?>" title="Trip Days" class="input-xs calc-jobmob-worksheet monitor-change check_num1 width-75 print-my-value" data-recent-value="<?php echo $jm['f_veh_exp_car_days']; ?>" /> 
        Days per trip car rental @ 
        $<input type="text" name="F_VEH_EXP_CAR_RATE" id="F_VEH_EXP_CAR_RATE" value="<?php echo $jm['f_veh_exp_car_rate']; ?>" title="Field Daily Rate" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['f_veh_exp_car_rate']; ?>" />
        &nbsp;/&nbsp;Day
	</td>
	<td>
        <input type="text" name="F_VEH_EXP_CAR_TRIPS" id="F_VEH_EXP_CAR_TRIPS" value="<?php echo $jm['f_veh_exp_car_trips']; ?>" title="Field Car Trips" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value trip" data-recent-value="<?php echo $jm['f_veh_exp_car_trips']; ?>" />
	</td>
</tr>

<tr class="fts3">
	<td rowspan="3">
        <input type="checkbox" id="fts_section3" name="fts_section[]" class="fts_section calc-jobmob-worksheet" value="3" <?php if (in_array("3",$fts_sections)) echo 'checked="checked"'; ?> />
        <label for="fts_section3">3</label>
	</td>
	<td rowspan="3" class="left-aligned">
        Field Travel Wages
	</td>
	<td colspan="2" class="left-aligned">
        <input type="text" name="F_WAG_MILES" id="F_WAG_MILES" value="<?php echo $jm['f_wag_miles']; ?>" title="Miles round-trip" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['f_wag_miles']; ?>" /> 
        Miles round-trip / 60 X 
        <input type="text" name="F_WAG_WORKERS" id="F_WAG_WORKERS" value="<?php echo $jm['f_wag_workers']; ?>" title="Men on Trip" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['f_wag_workers']; ?>" />
        (Men) = (Travel Hours per Trip)
	</td>
	<td rowspan="3" class="rowdisabled">&nbsp;</td>
	<td rowspan="3">
        $<span id="F_WAG_LAB_TOT" class="fts_total"></span>
	</td>
</tr>
<tr class="fts3">
	<td class="left-aligned">
        <span id="F_WAG_HRS"></span> 
        Travel Hours per Trip @ 
        $<input type="text" name="F_WAG_RATE" id="F_WAG_RATE" value="<?php echo $jm['f_wag_rate']; ?>" title="Field Travel Wage Rate" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['f_wag_rate']; ?>" />
	</td>
	<td>
        <input type="text" name="F_WAG_TRIPS" id="F_WAG_TRIPS" value="<?php echo $jm['f_wag_trips']; ?>" title="Field Travel Trips" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value trip" data-recent-value="<?php echo $jm['f_wag_trips']; ?>" />
	</td>
</tr>
<tr class="fts3">
	<td class="left-aligned">
        <input type="text" name="F_WAG_AIR_HRS" id="F_WAG_AIR_HRS" value="<?php echo $jm['f_wag_air_hrs']; ?>" title="Air Travel Hours per Trip" class="input-xs calc-jobmob-worksheet monitor-change check_num1 width-75 print-my-value" data-recent-value="<?php echo $jm['f_wag_air_hrs']; ?>" /> 
        Air Travel Hours per Trip @ 
        $<input type="text" name="F_WAG_AIR_RATE"  id="F_WAG_AIR_RATE" value="<?php echo $jm['f_wag_air_rate']; ?>" title="Air Rate" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['f_wag_air_rate']; ?>" />
	</td>
	<td>
        <input type="text" name="F_WAG_AIR_TRIPS" id="F_WAG_AIR_TRIPS" value="<?php echo $jm['f_wag_air_trips']; ?>" title="Air Trips" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value trip" data-recent-value="<?php echo $jm['f_wag_air_trips']; ?>" />
	</td>
</tr>

<tr class="fts4">
	<td>
        <input type="checkbox" id="fts_section4" name="fts_section[]" value="4" class="fts_section calc-jobmob-worksheet" <?php if (in_array("4",$fts_sections)) echo 'checked="checked"'; ?> />
        <label for="fts_section4">4</label>
	</td>
	<td class="left-aligned">
        Field Subsistence <span id="field_subsistence_miles"></span><br />
        <strong><span id="F_SUB_WRK_HRS"><?php echo number_format($job['field_hours'],1); ?></span></strong> (Work Hrs)
        <strong>+</strong>
        <strong><span id="F_SUB_TVL_HRS"><?php echo number_format($jm['f_sub_tvl_hrs'],1); ?></span></strong> (Travel Hrs)
        = <strong><span id="F_SUB_TOT_HRS"></span></strong> (Total Hrs)
	</td>
	<td colspan="2" class="left-aligned">
		<div>
			<label for="OVERRIDE_TOTAL_FIELD_HOURS">Override Total Hours</label>
			<input type="checkbox" name="OVERRIDE_TOTAL_FIELD_HOURS" id="OVERRIDE_TOTAL_FIELD_HOURS" value="1" class="calc-jobmob-worksheet" <?php if ($jm['override_total_field_hours'] == 1) echo 'checked="checked"'; ?> />
			<span id="FieldHoursTotalWrapper" <?php if ($jm['override_total_field_hours'] == 1) echo 'style="display: none;"'; ?>>
				<span id="FieldHoursTotal"></span>
			</span>
			<span id="UserFieldHoursWrapper" <?php if ($jm['override_total_field_hours'] == 0) echo 'style="display: none;"'; ?>>
				<input type="text" name="USER_TOTAL_FIELD_HOURS" id="USER_TOTAL_FIELD_HOURS" value="<?php echo number_format($jm['user_total_field_hours'],1); ?>" title="Total Field Hours" class="input-xs calc-jobmob-worksheet monitor-change check_num1 width-75 print-my-value" data-recent-value="<?php echo $jm['user_total_field_hours']; ?>" />
			</span>
			/ 40 = <span class="F_SUB_WRK_WEEK"></span> (Work Weeks)
		</div>
		<div class="row">
			<div class="col-md-5ths col-xs-6">
				$<strong><span id="F_SUB_MOTEL"><?php echo number_format(($motel_daily_rate / 2) * $jm['f_sub_motel_days'], 2); ?></span></strong> 
				<strong>+</strong>
			</div>
            <div class="col-md-5ths col-xs-6">
                $<strong><span id="F_SUB_MEALS"><?php echo number_format($food_allowance * $jm['f_sub_meals_days'],2); ?></span></strong>
                <strong>+</strong>
			</div>
            <div class="col-md-5ths col-xs-6">
                    $<input type="text" name="F_SUB_PAY" id="F_SUB_PAY" value="<?php echo $jm['f_sub_pay']; ?>" title="Field Subsistence Pay" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-60 print-my-value" data-recent-value="<?php echo $jm['f_sub_pay']; ?>" />
			</div>
            <div class="col-md-5ths col-xs-6">
                <strong>=</strong>
                $<strong><span id="F_SUB_WEEK"></span></strong>
                <strong>x</strong>
			</div>
            <div class="col-md-5ths col-xs-6">
                <strong><span class="F_SUB_WRK_WEEK"></span></strong>
			</div>
		</div>
		<div class="row">
            <div class="col-md-5ths col-xs-6">
                (1/2 Motel) <br />
				<span id="FieldMotelDays">0</span> Days
			</div>
            <div class="col-md-5ths col-xs-6">
                (Meals) <br />
                <span id="FieldMealDays">0</span> Days
			</div>
            <div class="col-md-5ths col-xs-6">
                (Pay) <br />
				<span id="fieldPay">40</span> Hrs
			</div>
            <div class="col-md-5ths col-xs-6">
                (Sub Week)
			</div>
            <div class="col-md-5ths col-xs-6">
                (Work Weeks)
            </div>
		</div>
	</td>
	<td>
        $<span id="F_SUB_SUB_TOT" class="fts_total"></span>
	</td>
	<td class="rowdisabled">&nbsp;</td>
</tr>
				
<tr class="fts5">
	<td>
        <input type="checkbox" id="fts_section5" name="fts_section[]" value="5" class="fts_section calc-jobmob-worksheet" <?php if (in_array("5",$fts_sections)) echo 'checked="checked"'; ?> />
        <label for="fts_section5">5</label>
	</td>
	<td class="left-aligned">
        Sunday Travel Subsistence
	</td>
	<td colspan="2" class="left-aligned sunday-travel-sub">
        <div class="row">
			<div class="col-md-2">
				<input type="text" name="F_SUN_WRK_WEEKS" id="F_SUN_WRK_WEEKS" value="<?php echo $jm['f_sun_wrk_weeks']; ?>" title="Sunday Work Weeks" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['f_sub_pay']; ?>" />
				<strong>&nbsp;x&nbsp;</strong>
			</div>
            <div class="col-md-2">
                $<strong><span id="F_SUN_MOTEL"><?php echo $jm['f_sun_motel']; ?></span></strong>

                <strong>&nbsp;+&nbsp;</strong>
			</div>
			<div class="col-md-2">
                $<input type="text" name="F_SUN_MEAL" id="F_SUN_MEAL" value="<?php echo $jm['f_sun_meal']; ?>" title="Sunday Meal" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['f_sun_meal']; ?>" />
			</div>
			<div class="col-md-6">
				&nbsp;
			</div>
        </div>
		<div class="row">
			<div class="col-md-2">
                (Work weeks)
			</div>
            <div class="col-md-2">
                (1/2 Motel) <br />
				1 Day
            </div>
			<div class="col-md-2">
                (Meal) <br />
				1 Day
			</div>
		</div>
	</td>
	<td>
        $<span id="F_SUN_SUB_TOT" class="fts_total"></span>
	</td>
	<td class="rowdisabled">&nbsp;</td>
</tr>

<tr class="fts6" id="InterimTripsRow">
	<td>
        <input type="checkbox" id="fts_section6" name="fts_section[]" class="fts_section calc-jobmob-worksheet" value="6" <?php if (in_array("6",$fts_sections)) echo 'checked="checked"'; ?> />
        <label for="fts_section6">6</label>
	</td>
	<td class="left-aligned">
        Interim Travel Time
	</td>
	<td class="left-aligned">
        <input type="text" name="INTERIM_HOURS" id="INTERIM_HOURS" value="<?php echo $jm['interim_hours']; ?>" title="Interim Travel Hours per Trip" class="input-xs calc-jobmob-worksheet monitor-change check_num1 width-75 print-my-value" data-recent-value="<?php echo $jm['interim_hours']; ?>" /> 
        Interim Travel Hours per Trip @ 
        $<input type="text" name="INTERIM_RATE"  id="INTERIM_RATE" value="<?php echo $jm['interim_rate']; ?>" title="Interim Rate" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['interim_rate']; ?>" />
	</td>
	<td>
        <input type="text" name="INTERIM_TRIPS" id="INTERIM_TRIPS" value="<?php echo $jm['interim_trips']; ?>" title="Interim Trips" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value trip" data-recent-value="<?php echo $jm['interim_trips']; ?>" />
	</td>
	<td class="rowdisabled">&nbsp;</td>
	<td>
        $<span id="INTERIM_TOTAL" class="fts_total"></span>
	</td>
</tr>
</tbody>