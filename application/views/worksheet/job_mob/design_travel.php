<?php
$jm = $worksheet['JobMob'];
$mileage_rate = $job['job_parms'][16]['NumericValue'];
?>
<tbody id="DesignTravel">
	<tr>
		<th colspan="3">Design Travel</th>
		<th>Trips</th>
		<th>Subcontract</th>
		<th>Labor</th>
	</tr>
	<tr>
		<td colspan="2" rowspan="3" class="left-aligned">Designer Vehicle / Airfare Expenses</td>
		<td class="left-aligned">
            <input type="text" name="DES_EXP_VEH_MILES" id="DES_EXP_VEH_MILES" value="<?php echo $jm['des_exp_veh_miles']; ?>" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['des_exp_veh_miles']; ?>"/> 
            Miles round-trip x $<?php echo number_format($mileage_rate,2); ?></td>
		<td>
            <input type="text" name="DES_EXP_VEH_TRIPS" id="DES_EXP_VEH_TRIPS" value="<?php echo $jm['des_exp_veh_trips']; ?>" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['des_exp_veh_trips']; ?>" />
		</td>
		<td rowspan="3">
            $<span id="DES_EXP_SUB_TOT" class="subcontract"></span>
		</td>
		<td rowspan="3" class="rowdisabled">&nbsp;</td>
	</tr>
	<tr>
		<td class="left-aligned">
            $<span id="DES_EXP_AIR_RATE" class="check_num2"><?php echo $jm['des_exp_air_rate']; ?></span> Airfare
		</td>
		<td>
		<input type="text" name="DES_EXP_AIR_TRIPS" id="DES_EXP_AIR_TRIPS" value="<?php echo $jm['des_exp_air_trips']; ?>" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['des_exp_veh_trips']; ?>"  />
		</td>
	</tr>
	<tr>
		<td class="left-aligned">
            <input type="text" name="DES_EXP_CAR_DAYS" id="DES_EXP_CAR_DAYS" value="<?php echo $jm['des_exp_car_days']; ?>" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['des_exp_car_days']; ?>"/> Days per trip car rental @ 
            $<input type="text" name="DES_EXP_CAR_RATE" id="DES_EXP_CAR_RATE" value="<?php echo $jm['des_exp_car_rate']; ?>" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['des_exp_car_rate']; ?>" />&nbsp;/&nbsp;Day
		</td>
		<td>
            <input type="text" name="DES_EXP_CAR_TRIPS" id="DES_EXP_CAR_TRIPS" value="<?php echo $jm['des_exp_car_trips']; ?>" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['des_exp_car_trips']; ?>" />
		</td>
	</tr>

	<tr>
		<td colspan="2" rowspan="3" class="left-aligned">Designer Travel Wages</td>
		<td colspan="2" class="left-aligned">
            <input type="text" name="DES_WAG_MILES" id="DES_WAG_MILES" value="<?php echo $jm['des_wag_miles']; ?>" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['des_wag_miles']; ?>" /> Miles round-trip / 60 = (Travel Hours per Trip)
		</td>
		<td rowspan="3" class="rowdisabled">&nbsp;</td>
		<td rowspan="3">
            $<span id="DES_WAG_LAB_TOT" class="labor"></span>
		</td>
	</tr>
	<tr>
		<td class="left-aligned">
            <span id="DES_WAG_HRS"></span> Travel Hours per Trip @ 
            $<span id="DES_WAG_RATE" class="check_num2"><?php echo $jm['des_wag_rate']; ?></span>
		</td>
		<td>
            <input type="text" name="DES_WAG_TRIPS" id="DES_WAG_TRIPS" value="<?php echo $jm['des_wag_trips']; ?>" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['des_wag_trips']; ?>" title="Designer Trips" />
		</td>
	</tr>
	<tr>
		<td class="left-aligned">
            <input type="text" name="DES_WAG_AIR_HRS" id="DES_WAG_AIR_HRS" value="<?php echo $jm['des_wag_air_hrs']; ?>" title="Air Travel Hours per Trip" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['des_wag_air_hrs']; ?>" /> 
            Air Travel Hours per Trip @ $<span id="DES_WAG_AIR_RATE" class="check_num2"><?php echo $jm['des_wag_air_rate']; ?></span> 
		</td>
		<td>
            <input type="text" name="DES_WAG_AIR_TRIPS" id="DES_WAG_AIR_TRIPS" value="<?php echo $jm['des_wag_air_trips']; ?>" title="Designer Air Trips" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['des_wag_air_trips']; ?>" />
		</td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2" class="left-aligned">
            Designer Subsistence
		</td>
		<td colspan="2" class="left-aligned">
            <input type="text" name="DES_SUB_LOD_DAYS" id="DES_SUB_LOD_DAYS" value="<?php echo $jm['des_sub_lod_days']; ?>" title="Lodging Days" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['des_sub_lod_days']; ?>" /> 
            Days lodging @ $<input type="text" name="DES_SUB_LOD_RATE" id="DES_SUB_LOD_RATE" value="<?php echo $jm['des_sub_lod_rate']; ?>" title="Lodging Rate" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['des_sub_lod_rate']; ?>" />
		</td>
		<td rowspan="2">
            $<span id="DES_SUB_SUB_TOT" class="subcontract"></span>
		</td>
		<td rowspan="2" class="rowdisabled">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="left-aligned">
            <input type="text" name="DES_SUB_MEA_DAYS" id="DES_SUB_MEA_DAYS" value="<?php echo $jm['des_sub_mea_days']; ?>" title="Meal Days" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['des_sub_mea_days']; ?>" /> 
            Days meals @ $<input type="text" name="DES_SUB_MEA_RATE" id="DES_SUB_MEA_RATE" value="<?php echo $jm['des_sub_mea_rate']; ?>" title="Daily Meal Rate" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['des_sub_mea_rate']; ?>" />
		</td>
	</tr>
</tbody>