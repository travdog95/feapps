<?php
$jm = $worksheet['JobMob'];
$mileage_rate = $job['job_parms'][16]['NumericValue'];

?>
<tr>
	<th colspan="3"><span class="section_title">Freight Costs</span></th>
	<th>Trips</th>
	<th>Subcontract</th>
	<th>Labor</th>
</tr>
<tr>
	<td colspan="2" class="left-aligned">
        Delivery Truck Expense
	</td>
	<td class="left-aligned">
        <input type="text" name="DEL_EXP_STK_MIL" id="DEL_EXP_STK_MIL" value="<?php echo $jm['del_exp_stk_mil']; ?>" title="Delivery Truck Round Trip" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['del_exp_stk_mil']; ?>" /> 
        Miles round-trip @ <?php echo "$".number_format($job['job_parms'][81]['NumericValue'],2); ?> = 
        $<span id="DEL_EXP_STK_TOT"></span> 
	</td>
	<td>
        <input type="text" name="DEL_EXP_STK_TRIPS" id="DEL_EXP_STK_TRIPS" value="<?php echo $jm['del_exp_stk_trips']; ?>" title="Delivery Truck Trips" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['del_exp_stk_trips']; ?>" />
	</td>
	<td>
        $<span id="DEL_EXP_SUB_TOT"></span>
	</td>
	<td class="rowdisabled">&nbsp;</td>
</tr>
<tr>
	<td colspan="2" rowspan="2" class="left-aligned">
        Delivery Driver's Travel Wage
	</td>
	<td colspan="2" class="left-aligned">
        <input type="text" name="DEL_WAG_MILES" id="DEL_WAG_MILES" value="<?php echo $jm['del_wag_miles']; ?>" title="Miles Round Trip" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['del_wag_miles']; ?>" /> 
        Miles round-trip / 60 = <span class="DEL_WAG_HRS"></span> (Travel Hours per Trip)
	</td>
	<td rowspan="2" class="rowdisabled">&nbsp;</td>
	<td rowspan="2">
        $<span id="DEL_WAG_LAB_TOT"></span>
	</td>
</tr>
<tr>
	<td class="left-aligned">
        <span id="DEL_WAG_HRS" class="DEL_WAG_HRS"></span>
        Travel Hours per Trip @ 
        $<input type="text" name="DEL_WAG_RATE" id="DEL_WAG_RATE" value="<?php echo $jm['del_wag_rate']; ?>" title="Delivery Driver Wage" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['del_wag_rate']; ?>" />
	</td>
	<td>
        <input type="text" name="DEL_WAG_TRIPS" id="DEL_WAG_TRIPS" value="<?php echo $jm['del_wag_trips']; ?>" title="Delivery Driver Trips" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['del_wag_trips']; ?>" />
	</td>
</tr>
		
<tr>
	<td colspan="2" class="left-aligned">
        Delivery Driver's Subsistence
	</td>
	<td class="left-aligned">
        <span id="DEL_SUB_DAYS"></span> 
        Days Subsistence @ 
        $<input type="text" name="DEL_SUB_RATE" id="DEL_SUB_RATE" value="<?php echo $jm['del_sub_rate']; ?>" title="Delivery Driver Rate" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['del_sub_rate']; ?>" />
	</td>
	<td>
        <input type="text" name="DEL_SUB_TRIPS" id="DEL_SUB_TRIPS" value="<?php echo $jm['del_sub_trips']; ?>" title="Delivery Driver Subsistence Trips" class="input-xs calc-jobmob-worksheet monitor-change check_num0 width-75 print-my-value" data-recent-value="<?php echo $jm['del_sub_trips']; ?>" />
	</td>
	<td>
        $<span id="DEL_SUB_SUB_TOT"></span>
	</td>
	<td class="rowdisabled">&nbsp;</td>
</tr>
<tr>
	<td colspan="2" class="left-aligned">
        Freight / Common Carrier
    </td>
	<td class="left-aligned">
        <input type="text" name="FRT_LOADS" id="FRT_LOADS" value="<?php echo $jm['frt_loads']; ?>" title="Freight Loads" class="input-xs calc-jobmob-worksheet monitor-change check_num1 width-75 print-my-value" data-recent-value="<?php echo $jm['frt_loads']; ?>" /> 
        No. Loads @ 
        $<input type="text" name="FRT_RATE" id="FRT_RATE" value="<?php echo $jm['frt_rate']; ?>" title="Freight Rate" class="input-xs calc-jobmob-worksheet monitor-change check_num2 width-75 print-my-value" data-recent-value="<?php echo $jm['del_wag_miles']; ?>" /> =
	</td>
	<td>
        <label for="frt_quoted">Quoted</label> 
        <input type="checkbox" name="frt_quoted" id="frt_quoted" value="1" class="calc-jobmob-worksheet" <?php if ($jm['frt_quoted'] == 1) echo 'checked="checked"'; ?> />
	</td>
	<td class="rowdisabled">&nbsp;</td>
	<td class="rowdisabled">&nbsp;</td>
</tr>