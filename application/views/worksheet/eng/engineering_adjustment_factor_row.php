<?php 
$row_type = "AdjustmentFactor";
$id = $Row['AdjustmentSubFactor_Idn'];
$row_id = $row_type."_".$id;
?>
<tr id="<?php echo $row_id; ?>" class="adjustment-factor" data-adjustmentsubfactor_idn="<?php echo $Row['AdjustmentSubFactor_Idn']; ?>" data-rank="<?php echo $Row['Rank']; ?>">
    <td colspan="4">
        <!--<input id="Delete<?php echo $row_id; ?>" class="delete" type="checkbox" title="Delete Item" value="<?php echo $row_id; ?>" name="Delete[]">-->
    </td>
    <td class="text-left">
        <?php echo quotes_to_entities($Row['Name']); ?>
    </td>
    <td>
        &lt;<span id="Value<?php echo $row_id; ?>" class="adjustment-factor-value"><?php echo number_format($Row['Value'], 2); ?></span>&gt;
    </td>
    <td>
        &lt;<span id="Total<?php echo $row_id; ?>" class="adjustment-factor-total engineering-unit-price-extended"></span>&gt;
    </td>
</tr>