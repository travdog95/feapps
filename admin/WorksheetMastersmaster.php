<?php
namespace PHPMaker2020\feapps51;
?>
<?php if ($WorksheetMasters->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_WorksheetMastersmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($WorksheetMasters->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<tr id="r_WorksheetMaster_Idn">
			<td class="<?php echo $WorksheetMasters->TableLeftColumnClass ?>"><?php echo $WorksheetMasters->WorksheetMaster_Idn->caption() ?></td>
			<td <?php echo $WorksheetMasters->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_WorksheetMasters_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasters->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasters->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetMasters->Name->Visible) { // Name ?>
		<tr id="r_Name">
			<td class="<?php echo $WorksheetMasters->TableLeftColumnClass ?>"><?php echo $WorksheetMasters->Name->caption() ?></td>
			<td <?php echo $WorksheetMasters->Name->cellAttributes() ?>>
<span id="el_WorksheetMasters_Name">
<span<?php echo $WorksheetMasters->Name->viewAttributes() ?>><?php echo $WorksheetMasters->Name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetMasters->Department_Idn->Visible) { // Department_Idn ?>
		<tr id="r_Department_Idn">
			<td class="<?php echo $WorksheetMasters->TableLeftColumnClass ?>"><?php echo $WorksheetMasters->Department_Idn->caption() ?></td>
			<td <?php echo $WorksheetMasters->Department_Idn->cellAttributes() ?>>
<span id="el_WorksheetMasters_Department_Idn">
<span<?php echo $WorksheetMasters->Department_Idn->viewAttributes() ?>><?php echo $WorksheetMasters->Department_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetMasters->Rank->Visible) { // Rank ?>
		<tr id="r_Rank">
			<td class="<?php echo $WorksheetMasters->TableLeftColumnClass ?>"><?php echo $WorksheetMasters->Rank->caption() ?></td>
			<td <?php echo $WorksheetMasters->Rank->cellAttributes() ?>>
<span id="el_WorksheetMasters_Rank">
<span<?php echo $WorksheetMasters->Rank->viewAttributes() ?>><?php echo $WorksheetMasters->Rank->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetMasters->NumberOfColumns->Visible) { // NumberOfColumns ?>
		<tr id="r_NumberOfColumns">
			<td class="<?php echo $WorksheetMasters->TableLeftColumnClass ?>"><?php echo $WorksheetMasters->NumberOfColumns->caption() ?></td>
			<td <?php echo $WorksheetMasters->NumberOfColumns->cellAttributes() ?>>
<span id="el_WorksheetMasters_NumberOfColumns">
<span<?php echo $WorksheetMasters->NumberOfColumns->viewAttributes() ?>><?php echo $WorksheetMasters->NumberOfColumns->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetMasters->AllowMultiple->Visible) { // AllowMultiple ?>
		<tr id="r_AllowMultiple">
			<td class="<?php echo $WorksheetMasters->TableLeftColumnClass ?>"><?php echo $WorksheetMasters->AllowMultiple->caption() ?></td>
			<td <?php echo $WorksheetMasters->AllowMultiple->cellAttributes() ?>>
<span id="el_WorksheetMasters_AllowMultiple">
<span<?php echo $WorksheetMasters->AllowMultiple->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AllowMultiple" class="custom-control-input" value="<?php echo $WorksheetMasters->AllowMultiple->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasters->AllowMultiple->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AllowMultiple"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($WorksheetMasters->ActiveFlag->Visible) { // ActiveFlag ?>
		<tr id="r_ActiveFlag">
			<td class="<?php echo $WorksheetMasters->TableLeftColumnClass ?>"><?php echo $WorksheetMasters->ActiveFlag->caption() ?></td>
			<td <?php echo $WorksheetMasters->ActiveFlag->cellAttributes() ?>>
<span id="el_WorksheetMasters_ActiveFlag">
<span<?php echo $WorksheetMasters->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $WorksheetMasters->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasters->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>