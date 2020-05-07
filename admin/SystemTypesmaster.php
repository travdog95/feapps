<?php
namespace PHPMaker2020\feapps51;
?>
<?php if ($SystemTypes->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_SystemTypesmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($SystemTypes->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<tr id="r_SystemType_Idn">
			<td class="<?php echo $SystemTypes->TableLeftColumnClass ?>"><?php echo $SystemTypes->SystemType_Idn->caption() ?></td>
			<td <?php echo $SystemTypes->SystemType_Idn->cellAttributes() ?>>
<span id="el_SystemTypes_SystemType_Idn">
<span<?php echo $SystemTypes->SystemType_Idn->viewAttributes() ?>><?php echo $SystemTypes->SystemType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($SystemTypes->Name->Visible) { // Name ?>
		<tr id="r_Name">
			<td class="<?php echo $SystemTypes->TableLeftColumnClass ?>"><?php echo $SystemTypes->Name->caption() ?></td>
			<td <?php echo $SystemTypes->Name->cellAttributes() ?>>
<span id="el_SystemTypes_Name">
<span<?php echo $SystemTypes->Name->viewAttributes() ?>><?php echo $SystemTypes->Name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($SystemTypes->Rank->Visible) { // Rank ?>
		<tr id="r_Rank">
			<td class="<?php echo $SystemTypes->TableLeftColumnClass ?>"><?php echo $SystemTypes->Rank->caption() ?></td>
			<td <?php echo $SystemTypes->Rank->cellAttributes() ?>>
<span id="el_SystemTypes_Rank">
<span<?php echo $SystemTypes->Rank->viewAttributes() ?>><?php echo $SystemTypes->Rank->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($SystemTypes->Department_Idn->Visible) { // Department_Idn ?>
		<tr id="r_Department_Idn">
			<td class="<?php echo $SystemTypes->TableLeftColumnClass ?>"><?php echo $SystemTypes->Department_Idn->caption() ?></td>
			<td <?php echo $SystemTypes->Department_Idn->cellAttributes() ?>>
<span id="el_SystemTypes_Department_Idn">
<span<?php echo $SystemTypes->Department_Idn->viewAttributes() ?>><?php echo $SystemTypes->Department_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($SystemTypes->ActiveFlag->Visible) { // ActiveFlag ?>
		<tr id="r_ActiveFlag">
			<td class="<?php echo $SystemTypes->TableLeftColumnClass ?>"><?php echo $SystemTypes->ActiveFlag->caption() ?></td>
			<td <?php echo $SystemTypes->ActiveFlag->cellAttributes() ?>>
<span id="el_SystemTypes_ActiveFlag">
<span<?php echo $SystemTypes->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $SystemTypes->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($SystemTypes->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>