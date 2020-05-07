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
$WorksheetMasterCategories_delete = new WorksheetMasterCategories_delete();

// Run the page
$WorksheetMasterCategories_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasterCategories_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetMasterCategoriesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fWorksheetMasterCategoriesdelete = currentForm = new ew.Form("fWorksheetMasterCategoriesdelete", "delete");
	loadjs.done("fWorksheetMasterCategoriesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetMasterCategories_delete->showPageHeader(); ?>
<?php
$WorksheetMasterCategories_delete->showMessage();
?>
<form name="fWorksheetMasterCategoriesdelete" id="fWorksheetMasterCategoriesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetMasterCategories">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($WorksheetMasterCategories_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($WorksheetMasterCategories_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<th class="<?php echo $WorksheetMasterCategories_delete->WorksheetMaster_Idn->headerCellClass() ?>"><span id="elh_WorksheetMasterCategories_WorksheetMaster_Idn" class="WorksheetMasterCategories_WorksheetMaster_Idn"><?php echo $WorksheetMasterCategories_delete->WorksheetMaster_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<th class="<?php echo $WorksheetMasterCategories_delete->WorksheetCategory_Idn->headerCellClass() ?>"><span id="elh_WorksheetMasterCategories_WorksheetCategory_Idn" class="WorksheetMasterCategories_WorksheetCategory_Idn"><?php echo $WorksheetMasterCategories_delete->WorksheetCategory_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $WorksheetMasterCategories_delete->Rank->headerCellClass() ?>"><span id="elh_WorksheetMasterCategories_Rank" class="WorksheetMasterCategories_Rank"><?php echo $WorksheetMasterCategories_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<th class="<?php echo $WorksheetMasterCategories_delete->AutoLoadFlag->headerCellClass() ?>"><span id="elh_WorksheetMasterCategories_AutoLoadFlag" class="WorksheetMasterCategories_AutoLoadFlag"><?php echo $WorksheetMasterCategories_delete->AutoLoadFlag->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->LoadFlag->Visible) { // LoadFlag ?>
		<th class="<?php echo $WorksheetMasterCategories_delete->LoadFlag->headerCellClass() ?>"><span id="elh_WorksheetMasterCategories_LoadFlag" class="WorksheetMasterCategories_LoadFlag"><?php echo $WorksheetMasterCategories_delete->LoadFlag->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->AddMiscFlag->Visible) { // AddMiscFlag ?>
		<th class="<?php echo $WorksheetMasterCategories_delete->AddMiscFlag->headerCellClass() ?>"><span id="elh_WorksheetMasterCategories_AddMiscFlag" class="WorksheetMasterCategories_AddMiscFlag"><?php echo $WorksheetMasterCategories_delete->AddMiscFlag->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
		<th class="<?php echo $WorksheetMasterCategories_delete->ChildWorksheetMaster_Idn->headerCellClass() ?>"><span id="elh_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="WorksheetMasterCategories_ChildWorksheetMaster_Idn"><?php echo $WorksheetMasterCategories_delete->ChildWorksheetMaster_Idn->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$WorksheetMasterCategories_delete->RecordCount = 0;
$i = 0;
while (!$WorksheetMasterCategories_delete->Recordset->EOF) {
	$WorksheetMasterCategories_delete->RecordCount++;
	$WorksheetMasterCategories_delete->RowCount++;

	// Set row properties
	$WorksheetMasterCategories->resetAttributes();
	$WorksheetMasterCategories->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$WorksheetMasterCategories_delete->loadRowValues($WorksheetMasterCategories_delete->Recordset);

	// Render row
	$WorksheetMasterCategories_delete->renderRow();
?>
	<tr <?php echo $WorksheetMasterCategories->rowAttributes() ?>>
<?php if ($WorksheetMasterCategories_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td <?php echo $WorksheetMasterCategories_delete->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasterCategories_delete->RowCount ?>_WorksheetMasterCategories_WorksheetMaster_Idn" class="WorksheetMasterCategories_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_delete->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_delete->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td <?php echo $WorksheetMasterCategories_delete->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasterCategories_delete->RowCount ?>_WorksheetMasterCategories_WorksheetCategory_Idn" class="WorksheetMasterCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetMasterCategories_delete->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_delete->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $WorksheetMasterCategories_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasterCategories_delete->RowCount ?>_WorksheetMasterCategories_Rank" class="WorksheetMasterCategories_Rank">
<span<?php echo $WorksheetMasterCategories_delete->Rank->viewAttributes() ?>><?php echo $WorksheetMasterCategories_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<td <?php echo $WorksheetMasterCategories_delete->AutoLoadFlag->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasterCategories_delete->RowCount ?>_WorksheetMasterCategories_AutoLoadFlag" class="WorksheetMasterCategories_AutoLoadFlag">
<span<?php echo $WorksheetMasterCategories_delete->AutoLoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AutoLoadFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_delete->AutoLoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_delete->AutoLoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AutoLoadFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->LoadFlag->Visible) { // LoadFlag ?>
		<td <?php echo $WorksheetMasterCategories_delete->LoadFlag->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasterCategories_delete->RowCount ?>_WorksheetMasterCategories_LoadFlag" class="WorksheetMasterCategories_LoadFlag">
<span<?php echo $WorksheetMasterCategories_delete->LoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LoadFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_delete->LoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_delete->LoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LoadFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->AddMiscFlag->Visible) { // AddMiscFlag ?>
		<td <?php echo $WorksheetMasterCategories_delete->AddMiscFlag->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasterCategories_delete->RowCount ?>_WorksheetMasterCategories_AddMiscFlag" class="WorksheetMasterCategories_AddMiscFlag">
<span<?php echo $WorksheetMasterCategories_delete->AddMiscFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AddMiscFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_delete->AddMiscFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_delete->AddMiscFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AddMiscFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_delete->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
		<td <?php echo $WorksheetMasterCategories_delete->ChildWorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasterCategories_delete->RowCount ?>_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="WorksheetMasterCategories_ChildWorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_delete->ChildWorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_delete->ChildWorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$WorksheetMasterCategories_delete->Recordset->moveNext();
}
$WorksheetMasterCategories_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetMasterCategories_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$WorksheetMasterCategories_delete->showPageFooter();
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
$WorksheetMasterCategories_delete->terminate();
?>