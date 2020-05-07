<?php
$miles_to_job = $job['job_parms'][31]['NumericValue'];
$motel_daily_rate = $job['job_parms'][32]['NumericValue'];
$jm = $worksheet['JobMob'];
?>
<tbody id="Header">
    <tr>
    <td colspan="6">
        <label class="strong" for="Miles">Miles to Job: </label>
        <input type="text" name="Miles" id="Miles" value="<?php echo $miles_to_job; ?>" title="Miles to Job" class="input-sm calc-jobmob-worksheet monitor-change check_num0 width-90 print-my-value" data-recent-value="<?php echo $miles_to_job; ?>" /> 
        <label for="MotelDailyRate">Motel Daily Rate: $</label>
        <input type="text" name="MotelDailyRate" id="MotelDailyRate" value="<?php echo number_format($motel_daily_rate, 2); ?>" class="input-sm calc-jobmob-worksheet monitor-change check_num2 width-90 print-my-value" title="Motel Daily Rate" data-recent-value="<?php echo $motel_daily_rate; ?>" />
        <label for="AirFare">Airfare: $</label>
        <input type="text" name="AirFare" id="AirFare" value="<?php echo number_format($jm['des_exp_air_rate'], 2); ?>" title="Airfare" class="input-sm calc-jobmob-worksheet monitor-change check_num2 width-90 print-my-value" data-recent-value="<?php echo $jm['des_exp_air_rate']; ?>" />
    </td>
    </tr>
</tbody>