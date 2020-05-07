<?php 
$row_type = "AdditionalCost";
$id = $Row['AdditionalCost_Idn'];
$row_id = $row_type."_".$id;
?>
<tr id="<?php echo $row_id; ?>" class="additional-cost" data-additionalcost_idn="<?php echo $Row['AdditionalCost_Idn']; ?>" data-parent_idn="<?php echo $Row['Parent_Idn']; ?>" data-rank="<?php echo $Row['Rank']; ?>">
    <td colspan="4">&nbsp;</td>
    <td class="text-left">
        <input type="text" id="Quantity<?php echo $row_id; ?>" name="Quantity[<?php echo $row_id; ?>]" value="<?php echo $Row['Quantity']; ?>" class="input-xs width-45 check_num0 change monitor-change calc-engineering-worksheet print-my-value" data-recent-value="<?php echo $Row['Quantity']; ?>" title="Quantity" />
        <?php echo quotes_to_entities($Row['Name']); ?>
    </td>
    <td>
		<?php if ($id == 1): ?>
            &lt;<span id="EngineeringUnitPriceSpan<?php echo $row_id; ?>" class=""></span>&gt;
            <input type="hidden" id="EngineeringUnitPrice<?php echo $row_id; ?>" name="EngineeringUnitPrice[<?php echo $row_id; ?>]" value="<?php echo $Row['FieldManHours']; ?>" />
		<?php else: ?>
			<div class="input-group">
				<span class="input-group-addon input-xs">&lt;</span>
				<input type="text" id="EngineeringUnitPrice<?php echo $row_id; ?>" name="EngineeringUnitPrice[<?php echo $row_id; ?>]" class="input-xs check_num2 monitor-change calc-engineering-worksheet form-control engineering-unit-price print-my-value" value="<?php echo number_format($Row['FieldManHours'], 2); ?>" data-recent-value="<?php echo $Row['FieldManHours']; ?>" title="Man Hours" />
                <span class="input-group-addon input-xs">&gt;</span>
			</div>
		<?php endif; ?>
    </td>
    <td>
        &lt;<span id="EngineeringUnitPriceExtended<?php echo $row_id; ?>" class="engineering-unit-price-extended"></span>&gt;
    </td>
</tr>