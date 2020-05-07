<?php
namespace PHPMaker2020\feapps51;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$WorksheetMasters_delete = new WorksheetMasters_delete();

// Run the page
$WorksheetMasters_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasters_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetMastersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fWorksheetMastersdelete = currentForm = new ew.Form("fWorksheetMastersdelete", "delete");
	loadjs.done("fWorksheetMastersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetMasters_delete->showPageHeader(); ?>
<?php
$WorksheetMasters_delete->showMessage();
?>
<form name="fWorksheetMastersdelete" id="fWorksheetMastersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetMasters">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($WorksheetMasters_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($WorksheetMasters_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<th class="<?php echo $WorksheetMasters_delete->WorksheetMaster_Idn->headerCellClass() ?>"><span id="elh_WorksheetMasters_WorksheetMaster_Idn" class="WorksheetMasters_WorksheetMaster_Idn"><?php echo $WorksheetMasters_delete->WorksheetMaster_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasters_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $WorksheetMasters_delete->Name->headerCellClass() ?>"><span id="elh_WorksheetMasters_Name" class="WorksheetMasters_Name"><?php echo $WorksheetMasters_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasters_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $WorksheetMasters_delete->Department_Idn->headerCellClass() ?>"><span id="elh_WorksheetMasters_Department_Idn" class="WorksheetMasters_Department_Idn"><?php echo $WorksheetMasters_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasters_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $WorksheetMasters_delete->Rank->headerCellClass() ?>"><span id="elh_WorksheetMasters_Rank" class="WorksheetMasters_Rank"><?php echo $WorksheetMasters_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasters_delete->NumberOfColumns->Visible) { // NumberOfColumns ?>
		<th class="<?php echo $WorksheetMasters_delete->NumberOfColumns->headerCellClass() ?>"><span id="elh_WorksheetMasters_NumberOfColumns" class="WorksheetMasters_NumberOfColumns"><?php echo $WorksheetMasters_delete->NumberOfColumns->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasters_delete->AllowMultiple->Visible) { // AllowMultiple ?>
		<th class="<?php echo $WorksheetMasters_delete->AllowMultiple->headerCellClass() ?>"><span id="elh_WorksheetMasters_AllowMultiple" class="WorksheetMasters_AllowMultiple"><?php echo $WorksheetMasters_delete->AllowMultiple->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasters_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $WorksheetMasters_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_WorksheetMasters_ActiveFlag" class="WorksheetMasters_ActiveFlag"><?php echo $WorksheetMasters_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$WorksheetMasters_delete->RecordCount = 0;
$i = 0;
while (!$WorksheetMasters_delete->Recordset->EOF) {
	$WorksheetMasters_delete->RecordCount++;
	$WorksheetMasters_delete->RowCount++;

	// Set row properties
	$WorksheetMasters->resetAttributes();
	$WorksheetMasters->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$WorksheetMasters_delete->loadRowValues($WorksheetMasters_delete->Recordset);

	// Render row
	$WorksheetMasters_delete->renderRow();
?>
	<tr <?php echo $WorksheetMasters->rowAttributes() ?>>
<?php if ($WorksheetMasters_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td <?php echo $WorksheetMasters_delete->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasters_delete->RowCount ?>_WorksheetMasters_WorksheetMaster_Idn" class="WorksheetMasters_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasters_delete->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasters_delete->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasters_delete->Name->Visible) { // Name ?>
		<td <?php echo $WorksheetMasters_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasters_delete->RowCount ?>_WorksheetMasters_Name" class="WorksheetMasters_Name">
<span<?php echo $WorksheetMasters_delete->Name->viewAttributes() ?>><?php echo $WorksheetMasters_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasters_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $WorksheetMasters_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasters_delete->RowCount ?>_WorksheetMasters_Department_Idn" class="WorksheetMasters_Department_Idn">
<span<?php echo $WorksheetMasters_delete->Department_Idn->viewAttributes() ?>><?php echo $WorksheetMasters_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasters_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $WorksheetMasters_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasters_delete->RowCount ?>_WorksheetMasters_Rank" class="WorksheetMasters_Rank">
<span<?php echo $WorksheetMasters_delete->Rank->viewAttributes() ?>><?php echo $WorksheetMasters_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasters_delete->NumberOfColumns->Visible) { // NumberOfColumns ?>
		<td <?php echo $WorksheetMasters_delete->NumberOfColumns->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasters_delete->RowCount ?>_WorksheetMasters_NumberOfColumns" class="WorksheetMasters_NumberOfColumns">
<span<?php echo $WorksheetMasters_delete->NumberOfColumns->viewAttributes() ?>><?php echo $WorksheetMasters_delete->NumberOfColumns->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasters_delete->AllowMultiple->Visible) { // AllowMultiple ?>
		<td <?php echo $WorksheetMasters_delete->AllowMultiple->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasters_delete->RowCount ?>_WorksheetMasters_AllowMultiple" class="WorksheetMasters_AllowMultiple">
<span<?php echo $WorksheetMasters_delete->AllowMultiple->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AllowMultiple" class="custom-control-input" value="<?php echo $WorksheetMasters_delete->AllowMultiple->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasters_delete->AllowMultiple->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AllowMultiple"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasters_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $WorksheetMasters_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasters_delete->RowCount ?>_WorksheetMasters_ActiveFlag" class="WorksheetMasters_ActiveFlag">
<span<?php echo $WorksheetMasters_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $WorksheetMasters_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasters_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$WorksheetMasters_delete->Recordset->moveNext();
}
$WorksheetMasters_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetMasters_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$WorksheetMasters_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$WorksheetMasters_delete->terminate();
?>