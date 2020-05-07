<?php
$id = $Row['RowType']."_".$Row['MiscellaneousDetail_Idn'];
$row_class = (isset($Row['WorksheetArea_Idn']) && $Row['WorksheetArea_Idn'] > 0) ? "branchline-misc".$Row['WorksheetArea_Idn'] : "crossmain-misc";
?>
<tr id="<?php echo $id; ?>" class="<?php echo $row_class; ?> worksheet_line">
    <td>
        <input id="Delete<?php echo $id; ?>" name="Delete[]" type="checkbox" class="delete" value="<?php echo $id; ?>" />
        <input type="hidden" name="Id[]" class="" value="<?php echo $Row['MiscellaneousDetail_Idn']; ?>" />
        <input type="hidden" name="RowType[]" value="<?php echo $Row['RowType']; ?>" />
    </td>
    <td class="left-aligned">
        <input type="text" id="Name<?php echo $id; ?>" name="Name[<?php echo $id; ?>]" value="<?php echo quotes_to_entities($Row['Name']); ?>" class="name monitor-change input-xs form-control text-left print-my-value" data-recent-value="<?php echo quotes_to_entities($Row['Name']); ?>" />
    </td>
    <td>
        <input type="text" id="Qty<?php echo $id; ?>" name="Qty[<?php echo $id; ?>]" value="<?php echo $Row['Quantity']; ?>" class="quantity check_num1 monitor-change calc-worksheet input-xs form-control print-my-value text-center" title="Quantity" data-recent-value="<?php echo $Row['Quantity']; ?>" />
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
		<div class="input-group">
			<span class="input-group-addon input-xs">$</span>
			<input type="text" id="MaterialUnitPrice<?php echo $id; ?>" name="MaterialUnitPrice[<?php echo $id; ?>]" value="<?php echo $Row['MaterialUnitPrice']; ?>" class="material_unit_price check_num2 monitor-change calc-worksheet input-xs form-control print-my-value" data-recent-value="<?php echo $Row['MaterialUnitPrice']; ?>" />
		</div>
	</td>
    <td>
		$<span id="MaterialUnitPriceExtended<?php echo $id; ?>" class="important-value"></span>
	</td>
    <td>
        <div class="input-group">
            <span class="input-group-addon input-xs">&lt;</span>
			<input type="text" id="FieldUnitPrice<?php echo $id; ?>" name="FieldUnitPrice[<?php echo $id; ?>]" value="<?php echo $Row['FieldUnitPrice']; ?>" class="field_unit_price check_num2 monitor-change calc-worksheet input-xs form-control print-my-value" data-recent-value="<?php echo $Row['FieldUnitPrice']; ?>" />
			<span class="input-group-addon input-xs">&gt;</span>
        </div>
	</td>
    <td>
		&lt;<span id="FieldUnitPriceExtended<?php echo $id; ?>" class="important-value"></span>&gt;
	</td>
    <td>
		<div class="input-group">
			<span class="input-group-addon input-xs">&lt;</span>
			<input type="text" id="ShopUnitPrice<?php echo $id; ?>" name="ShopUnitPrice[<?php echo $id; ?>]" value="<?php echo $Row['ShopUnitPrice']; ?>" class="shop_unit_price check_num2 monitor-change calc-worksheet input-xs form-control print-my-value" data-recent-value="<?php echo $Row['ShopUnitPrice']; ?>" />
			<span class="input-group-addon input-xs">&gt;</span>
		</div>
	</td>
    <td>&lt;<span id="ShopUnitPriceExtended<?php echo $id; ?>" class="important-value"></span>&gt;</td>
</tr>