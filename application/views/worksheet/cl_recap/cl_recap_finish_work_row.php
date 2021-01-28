<?php
$id = $Row['RowType']."_".$Row['MiscellaneousDetail_Idn'];
?>
<tr id="<?php echo $id; ?>" class="finish-work worksheet_line" data-finish_work_idn="<?php echo $Row['FinishWork_Idn']; ?>">
    <td>
        <!--<input id="Delete<?php echo $id; ?>" name="Delete[]" type="checkbox" class="delete" value="<?php echo $id; ?>" />-->
        <input type="hidden" name="Id[]" class="" value="<?php echo $Row['MiscellaneousDetail_Idn']; ?>" />
        <input type="hidden" name="RowType[]" value="<?php echo $Row['RowType']; ?>" />
    </td>
    <td class="left-aligned">
        <?php echo quotes_to_entities($Row['Name']); ?>
    </td>
    <td>
        <input type="text" id="Qty<?php echo $id; ?>" name="Qty[<?php echo $id; ?>]" value="<?php echo $Row['Quantity']; ?>" class="quantity check_num1 monitor-change calc-worksheet input-xs form-control print-my-value text-center" data-recent-value="<?php echo $Row['Quantity']; ?>" />
    </td>
    <td colspan="4">&nbsp;</td>
    <td>&lt;<span id="FieldUnitPrice<?php echo $id; ?>"><?php echo $Row['FieldUnitPrice']; ?></span>&gt;</td>
    <td>&lt;<span id="FieldUnitPriceExtended<?php echo $id; ?>" class="important-value"></span>&gt;</td>
    <td colspan="2">&nbsp;</td>
</tr>