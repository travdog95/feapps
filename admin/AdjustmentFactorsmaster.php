<?php
namespace PHPMaker2020\feapps51;
?>
<?php if ($AdjustmentFactors->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_AdjustmentFactorsmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($AdjustmentFactors->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<tr id="r_AdjustmentFactor_Idn">
			<td class="<?php echo $AdjustmentFactors->TableLeftColumnClass ?>"><?php echo $AdjustmentFactors->AdjustmentFactor_Idn->caption() ?></td>
			<td <?php echo $AdjustmentFactors->AdjustmentFactor_Idn->cellAttributes() ?>>
<span id="el_AdjustmentFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentFactors->AdjustmentFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentFactors->AdjustmentFactor_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($AdjustmentFactors->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<tr id="r_WorksheetMaster_Idn">
			<td class="<?php echo $AdjustmentFactors->TableLeftColumnClass ?>"><?php echo $AdjustmentFactors->WorksheetMaster_Idn->caption() ?></td>
			<td <?php echo $AdjustmentFactors->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_AdjustmentFactors_WorksheetMaster_Idn">
<span<?php echo $AdjustmentFactors->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $AdjustmentFactors->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($AdjustmentFactors->Name->Visible) { // Name ?>
		<tr id="r_Name">
			<td class="<?php echo $AdjustmentFactors->TableLeftColumnClass ?>"><?php echo $AdjustmentFactors->Name->caption() ?></td>
			<td <?php echo $AdjustmentFactors->Name->cellAttributes() ?>>
<span id="el_AdjustmentFactors_Name">
<span<?php echo $AdjustmentFactors->Name->viewAttributes() ?>><?php echo $AdjustmentFactors->Name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($AdjustmentFactors->Rank->Visible) { // Rank ?>
		<tr id="r_Rank">
			<td class="<?php echo $AdjustmentFactors->TableLeftColumnClass ?>"><?php echo $AdjustmentFactors->Rank->caption() ?></td>
			<td <?php echo $AdjustmentFactors->Rank->cellAttributes() ?>>
<span id="el_AdjustmentFactors_Rank">
<span<?php echo $AdjustmentFactors->Rank->viewAttributes() ?>><?php echo $AdjustmentFactors->Rank->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($AdjustmentFactors->ActiveFlag->Visible) { // ActiveFlag ?>
		<tr id="r_ActiveFlag">
			<td class="<?php echo $AdjustmentFactors->TableLeftColumnClass ?>"><?php echo $AdjustmentFactors->ActiveFlag->caption() ?></td>
			<td <?php echo $AdjustmentFactors->ActiveFlag->cellAttributes() ?>>
<span id="el_AdjustmentFactors_ActiveFlag">
<span<?php echo $AdjustmentFactors->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $AdjustmentFactors->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($AdjustmentFactors->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>