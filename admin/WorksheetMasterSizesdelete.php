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
$WorksheetMasterSizes_delete = new WorksheetMasterSizes_delete();

// Run the page
$WorksheetMasterSizes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasterSizes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetMasterSizesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fWorksheetMasterSizesdelete = currentForm = new ew.Form("fWorksheetMasterSizesdelete", "delete");
	loadjs.done("fWorksheetMasterSizesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetMasterSizes_delete->showPageHeader(); ?>
<?php
$WorksheetMasterSizes_delete->showMessage();
?>
<form name="fWorksheetMasterSizesdelete" id="fWorksheetMasterSizesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetMasterSizes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($WorksheetMasterSizes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($WorksheetMasterSizes_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<th class="<?php echo $WorksheetMasterSizes_delete->WorksheetMaster_Idn->headerCellClass() ?>"><span id="elh_WorksheetMasterSizes_WorksheetMaster_Idn" class="WorksheetMasterSizes_WorksheetMaster_Idn"><?php echo $WorksheetMasterSizes_delete->WorksheetMaster_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetMasterSizes_delete->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<th class="<?php echo $WorksheetMasterSizes_delete->ProductSize_Idn->headerCellClass() ?>"><span id="elh_WorksheetMasterSizes_ProductSize_Idn" class="WorksheetMasterSizes_ProductSize_Idn"><?php echo $WorksheetMasterSizes_delete->ProductSize_Idn->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$WorksheetMasterSizes_delete->RecordCount = 0;
$i = 0;
while (!$WorksheetMasterSizes_delete->Recordset->EOF) {
	$WorksheetMasterSizes_delete->RecordCount++;
	$WorksheetMasterSizes_delete->RowCount++;

	// Set row properties
	$WorksheetMasterSizes->resetAttributes();
	$WorksheetMasterSizes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$WorksheetMasterSizes_delete->loadRowValues($WorksheetMasterSizes_delete->Recordset);

	// Render row
	$WorksheetMasterSizes_delete->renderRow();
?>
	<tr <?php echo $WorksheetMasterSizes->rowAttributes() ?>>
<?php if ($WorksheetMasterSizes_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td <?php echo $WorksheetMasterSizes_delete->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasterSizes_delete->RowCount ?>_WorksheetMasterSizes_WorksheetMaster_Idn" class="WorksheetMasterSizes_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterSizes_delete->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterSizes_delete->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetMasterSizes_delete->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td <?php echo $WorksheetMasterSizes_delete->ProductSize_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetMasterSizes_delete->RowCount ?>_WorksheetMasterSizes_ProductSize_Idn" class="WorksheetMasterSizes_ProductSize_Idn">
<span<?php echo $WorksheetMasterSizes_delete->ProductSize_Idn->viewAttributes() ?>><?php echo $WorksheetMasterSizes_delete->ProductSize_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$WorksheetMasterSizes_delete->Recordset->moveNext();
}
$WorksheetMasterSizes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetMasterSizes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$WorksheetMasterSizes_delete->showPageFooter();
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
$WorksheetMasterSizes_delete->terminate();
?>