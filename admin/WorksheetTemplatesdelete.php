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
$WorksheetTemplates_delete = new WorksheetTemplates_delete();

// Run the page
$WorksheetTemplates_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetTemplates_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetTemplatesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fWorksheetTemplatesdelete = currentForm = new ew.Form("fWorksheetTemplatesdelete", "delete");
	loadjs.done("fWorksheetTemplatesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetTemplates_delete->showPageHeader(); ?>
<?php
$WorksheetTemplates_delete->showMessage();
?>
<form name="fWorksheetTemplatesdelete" id="fWorksheetTemplatesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetTemplates">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($WorksheetTemplates_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($WorksheetTemplates_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<th class="<?php echo $WorksheetTemplates_delete->WorksheetMaster_Idn->headerCellClass() ?>"><span id="elh_WorksheetTemplates_WorksheetMaster_Idn" class="WorksheetTemplates_WorksheetMaster_Idn"><?php echo $WorksheetTemplates_delete->WorksheetMaster_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetTemplates_delete->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<th class="<?php echo $WorksheetTemplates_delete->WorksheetColumn_Idn->headerCellClass() ?>"><span id="elh_WorksheetTemplates_WorksheetColumn_Idn" class="WorksheetTemplates_WorksheetColumn_Idn"><?php echo $WorksheetTemplates_delete->WorksheetColumn_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetTemplates_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $WorksheetTemplates_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_WorksheetTemplates_ActiveFlag" class="WorksheetTemplates_ActiveFlag"><?php echo $WorksheetTemplates_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$WorksheetTemplates_delete->RecordCount = 0;
$i = 0;
while (!$WorksheetTemplates_delete->Recordset->EOF) {
	$WorksheetTemplates_delete->RecordCount++;
	$WorksheetTemplates_delete->RowCount++;

	// Set row properties
	$WorksheetTemplates->resetAttributes();
	$WorksheetTemplates->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$WorksheetTemplates_delete->loadRowValues($WorksheetTemplates_delete->Recordset);

	// Render row
	$WorksheetTemplates_delete->renderRow();
?>
	<tr <?php echo $WorksheetTemplates->rowAttributes() ?>>
<?php if ($WorksheetTemplates_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td <?php echo $WorksheetTemplates_delete->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetTemplates_delete->RowCount ?>_WorksheetTemplates_WorksheetMaster_Idn" class="WorksheetTemplates_WorksheetMaster_Idn">
<span<?php echo $WorksheetTemplates_delete->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetTemplates_delete->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetTemplates_delete->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td <?php echo $WorksheetTemplates_delete->WorksheetColumn_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetTemplates_delete->RowCount ?>_WorksheetTemplates_WorksheetColumn_Idn" class="WorksheetTemplates_WorksheetColumn_Idn">
<span<?php echo $WorksheetTemplates_delete->WorksheetColumn_Idn->viewAttributes() ?>><?php echo $WorksheetTemplates_delete->WorksheetColumn_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetTemplates_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $WorksheetTemplates_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $WorksheetTemplates_delete->RowCount ?>_WorksheetTemplates_ActiveFlag" class="WorksheetTemplates_ActiveFlag">
<span<?php echo $WorksheetTemplates_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $WorksheetTemplates_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetTemplates_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$WorksheetTemplates_delete->Recordset->moveNext();
}
$WorksheetTemplates_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetTemplates_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$WorksheetTemplates_delete->showPageFooter();
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
$WorksheetTemplates_delete->terminate();
?>