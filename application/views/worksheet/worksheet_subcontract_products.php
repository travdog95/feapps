<?php
$row_type = ($IsMiscellaneousDetail == 1) ? "Miscellaneous" : "Product";
$id = $row_type."_".$Product_Idn;

if (!isset($row_class_array))
{
    $row_class_array = array();
}
?>

<tr id="<?php echo $id; ?>" class="worksheet_line <?php echo implode(" ", $row_class_array); ?> WorksheetCategory<?php echo $WorksheetCategory_Idn; ?>" data-Product_Idn="<?php echo $Product_Idn; ?>" data-IsMiscellaneousDetail="<?php echo $IsMiscellaneousDetail; ?>" data-ProductSize_Idn="<?php echo $ProductSize_Idn; ?>" data-ApplyToAdjustmentFactorsFlag="<?php echo $ApplyToAdjustmentFactorsFlag; ?>" data-IsHead="<?php echo $IsHead; ?>" data-IsChildWorksheet="0">
	<td>
		<input type="checkbox" name="Delete[]" id="Delete<?php echo $id; ?>" class="delete" value="<?php echo $id; ?>" title="Delete Item" />
	</td>
	<td>
        <input type="hidden" name="Id[]" class="product_id" value="<?php echo $Product_Idn; ?>" />
        <input type="hidden" name="RowType[]" value="<?php echo $row_type; ?>" />
		<input type="text" name="Qty[<?php echo $id; ?>]" id="Qty<?php echo $id; ?>" class="check_num1 quantity monitor-change calc-worksheet input-xs form-control print-my-value text-center" value="<?php echo number_format($Quantity,1); ?>" data-recent-value="<?php echo $Quantity; ?>" title="Quantity" />
	</td>
	<td class="uc left-aligned">
        <!-- <input type="text" name="Name[<?php echo $id; ?>]" id="Name<?php echo $id; ?>" class="name" value="<?php echo $Name; ?>" title="Name" /> -->

        <?php if (empty($Description)): 
            $name_title = "Name";
        else:
            //Strip out tabs, line and carriage returns
		    $name_title = str_replace(array("\n", "\t", "\r"), ' ', $Description);
        endif; ?>

        <span id="Name<?php echo $id; ?>" class="name" title="<?php echo $name_title; ?>"><?php echo $Name; ?></span>
	</td>
	<td>
        <?php if ($IsMiscellaneousDetail == 1): ?>
            &nbsp;
        <?php else: ?>
            <span id="DomesticFlag<?php echo $id; ?>" class="domestic_flag"><?php echo ($DomesticFlag == 1) ? "D" : "F"; ?></span>
        <?php endif; ?>
	</td>
	<td>
		<div class="input-group">
			<span class="input-group-addon input-xs">$</span>
			<input type="text" name="MaterialUnitPrice[<?php echo $id; ?>]" id="MaterialUnitPrice<?php echo $id; ?>" class="material_unit_price monitor-change check_num2 calc-worksheet input-xs form-control print-my-value" value="<?php echo number_format($MaterialUnitPrice,2); ?>" data-recent-value="<?php echo $MaterialUnitPrice; ?>" />		
		</div>
	</td>
	<td class="left-aligned">
		<!-- RADIO BUTTON -->
		<label for="LowSub<?php echo $id; ?>">
			<input type="radio" name="Sub<?php echo $id; ?>" id="LowSub<?php echo $id; ?>" class="calc-worksheet" value="2" <?php if ($WorksheetColumn_Idn == "2") echo 'checked="checked"'; ?> />
			S18
		</label>
			<!-- /END RADIO BUTTON -->
			<span class="fr">
			$<span class="low_sub_extended important-value" id="LowSubExtended<?php echo $id; ?>">0</span>
			</span>
	</td>
	<td class="left-aligned">
		<!-- RADIO BUTTON -->
		<label for="HighSub<?php echo $id; ?>">
			<input type="radio" name="Sub<?php echo $id; ?>" id="HighSub<?php echo $id; ?>" class="calc-worksheet" value="3" <?php if ($WorksheetColumn_Idn == "3") echo 'checked="checked"'; ?> />
			S37
		</label>
		<!-- /END RADIO BUTTON -->
		<span class="fr">
		$<span class="high_sub_extended important-value" id="HighSubExtended<?php echo $id; ?>">0</span>
		</span>
	</td>
	<td class="left-aligned">
		<!-- RADIO BUTTON -->
		<div class="form-inline">
			<div class="form-group">
				<div class="radio">
					<label for="Bonded<?php echo $id; ?>">
						<input type="radio" name="Sub<?php echo $id; ?>" id="Bonded<?php echo $id; ?>" class="calc-worksheet" value="1" <?php if ($WorksheetColumn_Idn == "1") echo 'checked="checked"'; ?> />
						BND
					</label>
				</div>
			</div>
			<!-- /END RADIO BUTTON -->
			<div class="form-group">
				<div class="input-group">
					<input type="text" name="BondedMarkup<?php echo $id; ?>" id="BondedMarkup<?php echo $id; ?>" class="tiny bonded_mark_up monitor-change check_num1 calc-worksheet input-xs width-60 form-control print-my-value" value="<?php echo number_format($MaterialMarkUp * 100,1);?>" data-recent-value="<?php echo number_format($MaterialMarkUp * 100,1);?>" />
					<span class="input-group-addon input-xs">%</span>
				</div>
			</div>
			<span class="fr">
				$<span class="bonded_extended important-value" id="BondedExtended<?php echo $id; ?>">0</span>
			</span>
		</div>
</td>
</tr>
