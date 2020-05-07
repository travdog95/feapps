<?php 
$row_type = $Row['RowType'];
$id = ($row_type == "Worksheet") ? $Row['BranchLineWorksheet_Idn'] : $Row['MiscellaneousDetail_Idn'];
$row_id = $row_type."_".$id;
$pipe_exposure_icon = substr($Row['PipeExposure'], 0, 1);
?>
<tr id="BasicAppropriation<?php echo $row_id; ?>" class="basic-appropriation">
    <td colspan="2">
        <span class="pull-left">
            <?php echo quotes_to_entities($Row['Name']); ?></span>
        </span>
    </td>
    <td>
        <span id="NumberOfHeads<?php echo $row_id; ?>" class="head"><?php echo number_format($Row['Quantity'], 0); ?></span>
    </td>
    <?php if ($row_type == "Miscellaneous"): ?>
        <td colspan="2">&nbsp;</td>
    <?php else: ?>
        <td>
            <select id="LaborClass<?php echo $row_id; ?>" name="LaborClass[<?php echo $row_id; ?>]" class="input-xs labor-class calc-engineering-worksheet print-my-value" title="<?php echo $Row['PipeExposure']; ?>">
                <?php foreach($LaborClasses as $lc): ?>
                    <?php $selected = ($lc['AdjustmentSubFactor_Idn'] == $Row['LaborClass_Idn']) ? ' selected="selected"' : ''; ?>
                    <option value="<?php echo $lc['AdjustmentSubFactor_Idn']; ?>" data-factor="<?php echo $lc['Value']; ?>"<?php echo $selected; ?>>
                        <?php echo quotes_to_entities($lc['Name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php echo "&nbsp;".$pipe_exposure_icon; ?>
        </td>
        <td>
            <span class="pull-right">
            <select id="IndividualAdjustmentFactor<?php echo $row_id; ?>" name="IndividualAdjustmentFactor[<?php echo $row_id; ?>]" class="input-xs individual-adjustment-factor calc-engineering-worksheet print-my-value">
                <?php foreach($IndividualAdjustmentFactors as $af): ?>
                    <?php $selected = ($af['AdjustmentSubFactor_Idn'] == $Row['AdjustmentFactor_Idn']) ? ' selected="selected"' : ''; ?>
                    <option value="<?php echo $af['AdjustmentSubFactor_Idn']; ?>" data-factor="<?php echo $af['Value']; ?>"<?php echo $selected; ?>>
                        <?php echo quotes_to_entities($af['Name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <span id="OriginialSystemWrapper<?php echo $row_id; ?>" class="hide">
                <label for="OriginalSystemQuantity<?php echo $row_id; ?>">Original System Qty:</label>
                <input type="text" id="OriginalSystemQuantity<?php echo $row_id; ?>" name="OriginalSystemQuantity[<?php echo $row_id; ?>]" class="input-xs width-35 original-system-quantity calc-engineering-worksheet monitor-change print-my-value" value="<?php echo number_format($Row['OriginalSystemQuantity'], 0); ?>" data-recent-value="<?php echo $Row['OriginalSystemQuantity']; ?>" />
            </span>
            </span>
        </td>
    <?php endif; ?>
    <td>
        <?php if ($row_type == "Worksheet"): ?>
            &lt;<span id="EngineeringUnitPrice<?php echo $row_id; ?>" class="engineering-unit-price"></span>&gt;
        <?php else: ?>
			<div class="input-group">
				<span class="input-group-addon input-xs">&lt;</span>
                <input type="text" id="EngineeringUnitPrice<?php echo $row_id; ?>" name="EngineeringUnitPrice[<?php echo $row_id; ?>]" class="input-xs engineering-unit-price calc-engineering-worksheet form-control monitor-change print-my-value" data-recent-value="<?php echo $Row['EngineerUnitPrice'];?>" value="<?php echo number_format($Row['EngineerUnitPrice'], 2); ?>" />
				<span class="input-group-addon input-xs">&gt;</span>
			</div>

        <?php endif; ?>
    </td>
    <td>
        &lt;<span id="EngineeringUnitPriceExtended<?php echo $row_id; ?>" class="engineering-unit-price-extended"></span>&gt;
    </td>
</tr>

<?php if ($row_type == "Worksheet"): ?>
    <tr id="IdenticalSystem<?php echo $row_id; ?>" class="hide">
        <td colspan="5">
            <span class="pull-right">
                Identical Qty: <span id="IdenticalSystemQuantity<?php echo $row_id; ?>" class="indentical-system-quantity width-35" style="display:inline-block;"></span>
            </span>
        </td>
        <td>
            &lt;<span id="IdenticalSystemPrice<?php echo $row_id; ?>" class="identical-system-price"></span>&gt;
        </td>
        <td>
            &lt;<span id="IdenticalSystemPriceExtended<?php echo $row_id; ?>" class="engineering-unit-price-extended identical-system-price-extended"></span>&gt;
        </td>
    </tr>
<?php endif; ?>