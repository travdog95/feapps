<?php
$id = $Row['RowType']."_".$Row['Rank'];
?>
<tr id="<?php echo $Row['RowType']."Row_".$Row['Rank']; ?>">
    <td>
        <?php if ($Row['Rank'] <> 1 && $Row['Rank'] <> 500 && $Row['Rank'] <> 501): ?>
            <input id="Delete<?php echo $id; ?>" name="Delete[]" type="checkbox" class="delete" value="<?php echo $Row['RowType']."Row_".$Row['Rank']; ?>" />
        <?php else: ?>
            &nbsp;
        <?php endif; ?>
        <input type="hidden" id="AdjustmentFactorRank<?php echo $Row['Rank']; ?>" name="AdjustmentFactorRank[]" value="<?php echo $Row['Rank']; ?>" />
    </td>
    <td colspan="<?php echo $worksheet_master['NumberOfColumns'] - 6; ?>">
        <select id="AdjustmentFactor_<?php echo $Row['Rank']; ?>" name="AdjustmentFactor[]" class="adjustment-factor form-control input-xs print-my-value pull-right" style="width:40%" data-rank="<?php echo $Row['Rank']; ?>">
            <?php foreach($Row['AdjustmentFactors'] as $AF): ?>
                <option value="<?php echo $AF['AdjustmentFactor_Idn']; ?>"<?php if ($AF['AdjustmentFactor_Idn'] == $Row['AdjustmentFactor_Idn']) echo ' selected="selected"'; ?>><?php echo quotes_to_entities($AF['Name']); ?></option>
            <?php endforeach; ?>
        </select>
        <?php if ($Row['Rank'] == 1): ?>
            <span class="pull-right">Height:&nbsp;</span>
        <?php endif; ?>
    </td>
    <td colspan="2" class="whitebgfill">
        <select id="AdjustmentSubFactor_<?php echo $Row['Rank']; ?>" name="AdjustmentSubFactor[]" class="adjustment-sub-factor form-control input-xs print-my-value" data-rank="<?php echo $Row['Rank']; ?>">
        <option value="0" selected="selected"></option>
        </select>
    </td>
    <td class="whitebgfill thick-border-right">
        <?php if ($Row['Rank'] == 500 || $Row['Rank'] == 501): ?>
			<?php 
			$user_value = $worksheet['WorksheetFactorDetails'][$Row['Rank']]['UserValue'];
			$default_value = $worksheet['WorksheetFactorDetails'][$Row['Rank']]['Value'];
			$class = (number_format($user_value, 2) == number_format($default_value, 2)) ? "" : "original-value-change";
			?>
            <input type="text" id="AdjustmentFactorValue_<?php echo $Row['Rank']; ?>" name="AdjustmentFactorValue[]" value="" class="check_num2 monitor-change monitor-original adjustment-factor-value calc-worksheet input-xs width-90 print-my-value text-center <?php echo $class; ?>" title="Adjustment Factor Value" data-recent-value="<?php echo number_format($user_value, 2); ?>" data-original-value="<?php echo number_format($default_value, 2); ?>" />
        <?php else: ?>
            <span id="AdjustmentFactorValue_<?php echo $Row['Rank']; ?>" class="adjustment-factor-value"></span>
			<input type="hidden" name="AdjustmentFactorValue[]" value="x" />
        <?php endif; ?>
    </td>
    <td colspan="2">&nbsp;</td>
</tr>