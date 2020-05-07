<?php 
$id = $Row['RowType']."_".$Row['Worksheet_Idn'];
?>
<tr id="<?php echo $id; ?>" class="crossmain worksheet_line">
    <td>
        <input id="Delete<?php echo $id; ?>" name="Delete[]" type="checkbox" class="delete" value="<?php echo $id; ?>" />
        <input type="hidden" name="Id[]" class="" value="<?php echo $Row['Worksheet_Idn']; ?>" />
        <input type="hidden" name="RowType[]" value="<?php echo $Row['RowType']; ?>" />
    </td>
    <td>
        <span class="pull-left">
            <!--<button id="CopyWorksheet<?php echo $Row['Worksheet_Idn']; ?>" class="btn btn-default btn-xs copy-worksheet" data-worksheet_name="" data-worksheet_idn="<?php echo $Row['Worksheet_Idn']; ?>" data-worksheet_master_idn="<?php echo $Row['WorksheetMaster_Idn']; ?>" data-worksheet_area_idn="0" title="Copy Worksheet" type="button">
                <span class="glyphicon glyphicon-copy glyphicon-xs" aria-hidden="true"></span>
            </button>-->
            <a href="<?php echo base_url()."job/worksheet/".$Row['Worksheet_Idn']; ?>" class="worksheet" data-worksheet_idn="<?php echo $Row['Worksheet_Idn']; ?>"><?php echo quotes_to_entities($Row['Name']); ?></a>
        </span>
    </td>
    <td>
        <input type="text" id="Qty<?php echo $id; ?>" name="Qty[<?php echo $id; ?>]" value="<?php echo $Row['Quantity']; ?>" class="check_num1 quantity monitor-change calc-worksheet input-xs form-control print-my-value text-center" title="Quantity" data-recent-value="<?php echo $Row['Quantity']; ?>" />
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>$<span id="MaterialUnitPrice<?php echo $id; ?>"><?php echo $Row['MaterialUnitPrice']; ?></span></td>
    <td>$<span id="MaterialUnitPriceExtended<?php echo $id; ?>" class="important-value"></span></td>
    <td>&lt;<span id="FieldUnitPrice<?php echo $id; ?>"><?php echo $Row['FieldUnitPrice']; ?></span>&gt;</td>
    <td>&lt;<span id="FieldUnitPriceExtended<?php echo $id; ?>" class="important-value"></span>&gt;</td>
    <td>&lt;<span id="ShopUnitPrice<?php echo $id; ?>"><?php echo $Row['ShopUnitPrice']; ?></span>&gt;</td>
    <td>&lt;<span id="ShopUnitPriceExtended<?php echo $id; ?>" class="important-value"></span>&gt;</td>
</tr>