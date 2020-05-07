<?php
namespace PHPMaker2020\feapps51;
?>
<?php if ($WorksheetCategories->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_WorksheetCategoriesmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($WorksheetCategories->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<tr id="r_WorksheetCategory_Idn">
			<td class="<?php echo $WorksheetCategories->TableLeftColumnClass ?>"><?php echo $WorksheetCategories->WorksheetCategory_Idn->caption() ?></td>
			<td <?php echo $WorksheetCategories->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el_WorksheetCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetCategories->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $WorksheetCategories->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetCategories->Name->Visible) { // Name ?>
		<tr id="r_Name">
			<td class="<?php echo $WorksheetCategories->TableLeftColumnClass ?>"><?php echo $WorksheetCategories->Name->caption() ?></td>
			<td <?php echo $WorksheetCategories->Name->cellAttributes() ?>>
<span id="el_WorksheetCategories_Name">
<span<?php echo $WorksheetCategories->Name->viewAttributes() ?>><?php echo $WorksheetCategories->Name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetCategories->ShortName->Visible) { // ShortName ?>
		<tr id="r_ShortName">
			<td class="<?php echo $WorksheetCategories->TableLeftColumnClass ?>"><?php echo $WorksheetCategories->ShortName->caption() ?></td>
			<td <?php echo $WorksheetCategories->ShortName->cellAttributes() ?>>
<span id="el_WorksheetCategories_ShortName">
<span<?php echo $WorksheetCategories->ShortName->viewAttributes() ?>><?php echo $WorksheetCategories->ShortName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetCategories->Department_Idn->Visible) { // Department_Idn ?>
		<tr id="r_Department_Idn">
			<td class="<?php echo $WorksheetCategories->TableLeftColumnClass ?>"><?php echo $WorksheetCategories->Department_Idn->caption() ?></td>
			<td <?php echo $WorksheetCategories->Department_Idn->cellAttributes() ?>>
<span id="el_WorksheetCategories_Department_Idn">
<span<?php echo $WorksheetCategories->Department_Idn->viewAttributes() ?>><?php echo $WorksheetCategories->Department_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetCategories->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<tr id="r_FieldUnitPrice">
			<td class="<?php echo $WorksheetCategories->TableLeftColumnClass ?>"><?php echo $WorksheetCategories->FieldUnitPrice->caption() ?></td>
			<td <?php echo $WorksheetCategories->FieldUnitPrice->cellAttributes() ?>>
<span id="el_WorksheetCategories_FieldUnitPrice">
<span<?php echo $WorksheetCategories->FieldUnitPrice->viewAttributes() ?>><?php echo $WorksheetCategories->FieldUnitPrice->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetCategories->IsFitting->Visible) { // IsFitting ?>
		<tr id="r_IsFitting">
			<td class="<?php echo $WorksheetCategories->TableLeftColumnClass ?>"><?php echo $WorksheetCategories->IsFitting->caption() ?></td>
			<td <?php echo $WorksheetCategories->IsFitting->cellAttributes() ?>>
<span id="el_WorksheetCategories_IsFitting">
<span<?php echo $WorksheetCategories->IsFitting->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsFitting" class="custom-control-input" value="<?php echo $WorksheetCategories->IsFitting->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories->IsFitting->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsFitting"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetCategories->CartFlag->Visible) { // CartFlag ?>
		<tr id="r_CartFlag">
			<td class="<?php echo $WorksheetCategories->TableLeftColumnClass ?>"><?php echo $WorksheetCategories->CartFlag->caption() ?></td>
			<td <?php echo $WorksheetCategories->CartFlag->cellAttributes() ?>>
<span id="el_WorksheetCategories_CartFlag">
<span<?php echo $WorksheetCategories->CartFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CartFlag" class="custom-control-input" value="<?php echo $WorksheetCategories->CartFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories->CartFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CartFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetCategories->IsShared->Visible) { // IsShared ?>
		<tr id="r_IsShared">
			<td class="<?php echo $WorksheetCategories->TableLeftColumnClass ?>"><?php echo $WorksheetCategories->IsShared->caption() ?></td>
			<td <?php echo $WorksheetCategories->IsShared->cellAttributes() ?>>
<span id="el_WorksheetCategories_IsShared">
<span<?php echo $WorksheetCategories->IsShared->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsShared" class="custom-control-input" value="<?php echo $WorksheetCategories->IsShared->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories->IsShared->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsShared"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetCategories->IsAssembly->Visible) { // IsAssembly ?>
		<tr id="r_IsAssembly">
			<td class="<?php echo $WorksheetCategories->TableLeftColumnClass ?>"><?php echo $WorksheetCategories->IsAssembly->caption() ?></td>
			<td <?php echo $WorksheetCategories->IsAssembly->cellAttributes() ?>>
<span id="el_WorksheetCategories_IsAssembly">
<span<?php echo $WorksheetCategories->IsAssembly->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsAssembly" class="custom-control-input" value="<?php echo $WorksheetCategories->IsAssembly->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories->IsAssembly->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsAssembly"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetCategories->ActiveFlag->Visible) { // ActiveFlag ?>
		<tr id="r_ActiveFlag">
			<td class="<?php echo $WorksheetCategories->TableLeftColumnClass ?>"><?php echo $WorksheetCategories->ActiveFlag->caption() ?></td>
			<td <?php echo $WorksheetCategories->ActiveFlag->cellAttributes() ?>>
<span id="el_WorksheetCategories_ActiveFlag">
<span<?php echo $WorksheetCategories->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $WorksheetCategories->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>