<?php
namespace PHPMaker2020\feapps51;
?>
<?php if ($HangerTypes->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_HangerTypesmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($HangerTypes->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<tr id="r_HangerType_Idn">
			<td class="<?php echo $HangerTypes->TableLeftColumnClass ?>"><?php echo $HangerTypes->HangerType_Idn->caption() ?></td>
			<td <?php echo $HangerTypes->HangerType_Idn->cellAttributes() ?>>
<span id="el_HangerTypes_HangerType_Idn">
<span<?php echo $HangerTypes->HangerType_Idn->viewAttributes() ?>><?php echo $HangerTypes->HangerType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($HangerTypes->Name->Visible) { // Name ?>
		<tr id="r_Name">
			<td class="<?php echo $HangerTypes->TableLeftColumnClass ?>"><?php echo $HangerTypes->Name->caption() ?></td>
			<td <?php echo $HangerTypes->Name->cellAttributes() ?>>
<span id="el_HangerTypes_Name">
<span<?php echo $HangerTypes->Name->viewAttributes() ?>><?php echo $HangerTypes->Name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($HangerTypes->Rank->Visible) { // Rank ?>
		<tr id="r_Rank">
			<td class="<?php echo $HangerTypes->TableLeftColumnClass ?>"><?php echo $HangerTypes->Rank->caption() ?></td>
			<td <?php echo $HangerTypes->Rank->cellAttributes() ?>>
<span id="el_HangerTypes_Rank">
<span<?php echo $HangerTypes->Rank->viewAttributes() ?>><?php echo $HangerTypes->Rank->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($HangerTypes->ActiveFlag->Visible) { // ActiveFlag ?>
		<tr id="r_ActiveFlag">
			<td class="<?php echo $HangerTypes->TableLeftColumnClass ?>"><?php echo $HangerTypes->ActiveFlag->caption() ?></td>
			<td <?php echo $HangerTypes->ActiveFlag->cellAttributes() ?>>
<span id="el_HangerTypes_ActiveFlag">
<span<?php echo $HangerTypes->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HangerTypes->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HangerTypes->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>