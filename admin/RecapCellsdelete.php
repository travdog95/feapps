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
$RecapCells_delete = new RecapCells_delete();

// Run the page
$RecapCells_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapCells_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapCellsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fRecapCellsdelete = currentForm = new ew.Form("fRecapCellsdelete", "delete");
	loadjs.done("fRecapCellsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapCells_delete->showPageHeader(); ?>
<?php
$RecapCells_delete->showMessage();
?>
<form name="fRecapCellsdelete" id="fRecapCellsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapCells">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($RecapCells_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($RecapCells_delete->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<th class="<?php echo $RecapCells_delete->WorksheetColumn_Idn->headerCellClass() ?>"><span id="elh_RecapCells_WorksheetColumn_Idn" class="RecapCells_WorksheetColumn_Idn"><?php echo $RecapCells_delete->WorksheetColumn_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($RecapCells_delete->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<th class="<?php echo $RecapCells_delete->RecapRow_Idn->headerCellClass() ?>"><span id="elh_RecapCells_RecapRow_Idn" class="RecapCells_RecapRow_Idn"><?php echo $RecapCells_delete->RecapRow_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($RecapCells_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $RecapCells_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_RecapCells_ActiveFlag" class="RecapCells_ActiveFlag"><?php echo $RecapCells_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$RecapCells_delete->RecordCount = 0;
$i = 0;
while (!$RecapCells_delete->Recordset->EOF) {
	$RecapCells_delete->RecordCount++;
	$RecapCells_delete->RowCount++;

	// Set row properties
	$RecapCells->resetAttributes();
	$RecapCells->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$RecapCells_delete->loadRowValues($RecapCells_delete->Recordset);

	// Render row
	$RecapCells_delete->renderRow();
?>
	<tr <?php echo $RecapCells->rowAttributes() ?>>
<?php if ($RecapCells_delete->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td <?php echo $RecapCells_delete->WorksheetColumn_Idn->cellAttributes() ?>>
<span id="el<?php echo $RecapCells_delete->RowCount ?>_RecapCells_WorksheetColumn_Idn" class="RecapCells_WorksheetColumn_Idn">
<span<?php echo $RecapCells_delete->WorksheetColumn_Idn->viewAttributes() ?>><?php echo $RecapCells_delete->WorksheetColumn_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapCells_delete->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td <?php echo $RecapCells_delete->RecapRow_Idn->cellAttributes() ?>>
<span id="el<?php echo $RecapCells_delete->RowCount ?>_RecapCells_RecapRow_Idn" class="RecapCells_RecapRow_Idn">
<span<?php echo $RecapCells_delete->RecapRow_Idn->viewAttributes() ?>><?php echo $RecapCells_delete->RecapRow_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapCells_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $RecapCells_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $RecapCells_delete->RowCount ?>_RecapCells_ActiveFlag" class="RecapCells_ActiveFlag">
<span<?php echo $RecapCells_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $RecapCells_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapCells_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$RecapCells_delete->Recordset->moveNext();
}
$RecapCells_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapCells_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$RecapCells_delete->showPageFooter();
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
$RecapCells_delete->terminate();
?>