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
$RecapRowWorksheetMasters_delete = new RecapRowWorksheetMasters_delete();

// Run the page
$RecapRowWorksheetMasters_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapRowWorksheetMasters_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapRowWorksheetMastersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fRecapRowWorksheetMastersdelete = currentForm = new ew.Form("fRecapRowWorksheetMastersdelete", "delete");
	loadjs.done("fRecapRowWorksheetMastersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapRowWorksheetMasters_delete->showPageHeader(); ?>
<?php
$RecapRowWorksheetMasters_delete->showMessage();
?>
<form name="fRecapRowWorksheetMastersdelete" id="fRecapRowWorksheetMastersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapRowWorksheetMasters">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($RecapRowWorksheetMasters_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($RecapRowWorksheetMasters_delete->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<th class="<?php echo $RecapRowWorksheetMasters_delete->RecapRow_Idn->headerCellClass() ?>"><span id="elh_RecapRowWorksheetMasters_RecapRow_Idn" class="RecapRowWorksheetMasters_RecapRow_Idn"><?php echo $RecapRowWorksheetMasters_delete->RecapRow_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($RecapRowWorksheetMasters_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<th class="<?php echo $RecapRowWorksheetMasters_delete->WorksheetMaster_Idn->headerCellClass() ?>"><span id="elh_RecapRowWorksheetMasters_WorksheetMaster_Idn" class="RecapRowWorksheetMasters_WorksheetMaster_Idn"><?php echo $RecapRowWorksheetMasters_delete->WorksheetMaster_Idn->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$RecapRowWorksheetMasters_delete->RecordCount = 0;
$i = 0;
while (!$RecapRowWorksheetMasters_delete->Recordset->EOF) {
	$RecapRowWorksheetMasters_delete->RecordCount++;
	$RecapRowWorksheetMasters_delete->RowCount++;

	// Set row properties
	$RecapRowWorksheetMasters->resetAttributes();
	$RecapRowWorksheetMasters->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$RecapRowWorksheetMasters_delete->loadRowValues($RecapRowWorksheetMasters_delete->Recordset);

	// Render row
	$RecapRowWorksheetMasters_delete->renderRow();
?>
	<tr <?php echo $RecapRowWorksheetMasters->rowAttributes() ?>>
<?php if ($RecapRowWorksheetMasters_delete->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td <?php echo $RecapRowWorksheetMasters_delete->RecapRow_Idn->cellAttributes() ?>>
<span id="el<?php echo $RecapRowWorksheetMasters_delete->RowCount ?>_RecapRowWorksheetMasters_RecapRow_Idn" class="RecapRowWorksheetMasters_RecapRow_Idn">
<span<?php echo $RecapRowWorksheetMasters_delete->RecapRow_Idn->viewAttributes() ?>><?php echo $RecapRowWorksheetMasters_delete->RecapRow_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapRowWorksheetMasters_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td <?php echo $RecapRowWorksheetMasters_delete->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $RecapRowWorksheetMasters_delete->RowCount ?>_RecapRowWorksheetMasters_WorksheetMaster_Idn" class="RecapRowWorksheetMasters_WorksheetMaster_Idn">
<span<?php echo $RecapRowWorksheetMasters_delete->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $RecapRowWorksheetMasters_delete->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$RecapRowWorksheetMasters_delete->Recordset->moveNext();
}
$RecapRowWorksheetMasters_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapRowWorksheetMasters_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$RecapRowWorksheetMasters_delete->showPageFooter();
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
$RecapRowWorksheetMasters_delete->terminate();
?>