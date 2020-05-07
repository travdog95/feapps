<tfoot>
    <tr class="worksheet-total">
        <td colspan="6">
            <span class="pull-left">Total Man Hours</span>
            <span class="pull-right">            
                <input type="checkbox" name="OverrideEngineerHours" id="OverrideEngineerHours" value="1" <?php if ($worksheet['OverrideEngineerHours'] == 1) echo "checked"; ?> />
                <label for="OverrideEngineerHours">Override Hours</label>
            </span>
        </td>
        <td class="whitebgfill">
            <div id="EngineerHoursTotalWrapper" <?php if ($worksheet['OverrideEngineerHours'] == 1) echo 'class="hide"'; ?>>
                &lt;<span id="EngineerHoursTotal"></span>&gt;
            </div>
            <div id="UserEngineerHoursWrapper" <?php if ($worksheet['OverrideEngineerHours'] == 0) echo 'class="hide"'; ?>>
				<div class="input-group">
					<span class="input-group-addon input-xs">&lt;</span>
					<input type="text" name="UserEngineerHours" id="UserEngineerHours" class="input-xs check_num2 monitor-change form-control calc-engineering-worksheet" value="<?php echo number_format($worksheet['UserEngineerHours'], 0); ?>" data-recent-value="<?php echo $worksheet['UserEngineerHours']; ?>" />
					<span class="input-group-addon input-xs">&gt;</span>
				</div>
            </div>
        </td>
    </tr>
    <tr class="worksheet-total">
        <td colspan="6" class="left-aligned">Hourly Rate</td>
        <td class="whitebgfill">$<span id="EngineerLaborRate"><?php echo number_format($job['design_labor_rate'], 2); ?></span></td>
    </tr>
    <tr class="worksheet-total">
        <td colspan="6" class="left-aligned">TOTALS</td>
        <td class="whitebgfill">$<span id="EngineerTotal"></span></td>
    </tr>

</tfoot>