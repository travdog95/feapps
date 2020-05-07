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
$WorksheetColumns_delete = new WorksheetColumns_delete();

// Run the page
$WorksheetColumns_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetColumns_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetColumnsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fWorksheetColumnsdelete = currentForm = new ew.Form("fWorksheetColumnsdelete", "delete");
	loadjs.done("fWorksheetColumnsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetColumns_delete->showPageHeader(); ?>
<?php
$WorksheetColumns_delete->showMessage();
?>
<form name="fWorksheetColumnsdelete" id="fWorksheetColumnsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetColumns">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($WorksheetColumns_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($WorksheetColumns_delete->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<th class="<?php echo $WorksheetColumns_delete->WorksheetColumn_Idn->headerCellClass() ?>"><span id="elh_WorksheetColumns_WorksheetColumn_Idn" class="WorksheetColumns_WorksheetColumn_Idn"><?php echo $WorksheetColumns_delete->WorksheetColumn_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetColumns_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $WorksheetColumns_delete->Name->headerCellClass() ?>"><span id="elh_WorksheetColumns_Name" class="WorksheetColumns_Name"><?php echo $WorksheetColumns_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetColumns_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $WorksheetColumns_delete->Rank->headerCellClass() ?>"><span id="elh_WorksheetColumns_Rank" class="WorksheetColumns_Rank"><?php echo $WorksheetColumns_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetColumns_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $WorksheetColumns_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_WorksheetColumns_ActiveFlag" class="WorksheetColumns_ActiveFlag"><?php echo $WorksheetColumns_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$WorksheetColumns_delete->RecordCount = 0;
$i = 0;
while (!$WorksheetColumns_delete->Recordset->EOF) {
	$WorksheetColumns_delete->RecordCount++;
	$WorksheetColumns_delete->RowCount++;

	// Set row properties
	$WorksheetColumns->resetAttributes();
	$WorksheetColumns->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$WorksheetColumns_delete->loadRowValues($WorksheetColumns_delete->Recordset);

	// Render row
	$WorksheetColumns_delete->renderRow();
?>
	<tr <?php echo $WorksheetColumns->rowAttributes() ?>>
<?php if ($WorksheetColumns_delete->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td <?php echo $WorksheetColumns_delete->WorksheetColumn_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetColumns_delete->RowCount ?>_WorksheetColumns_WorksheetColumn_Idn" class="WorksheetColumns_WorksheetColumn_Idn">
<span<?php echo $WorksheetColumns_delete->WorksheetColumn_Idn->viewAttributes() ?>><?php echo $WorksheetColumns_delete->WorksheetColumn_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetColumns_delete->Name->Visible) { // Name ?>
		<td <?php echo $WorksheetColumns_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $WorksheetColumns_delete->RowCount ?>_WorksheetColumns_Name" class="WorksheetColumns_Name">
<span<?php echo $WorksheetColumns_delete->Name->viewAttributes() ?>><?php echo $WorksheetColumns_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetColumns_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $WorksheetColumns_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $WorksheetColumns_delete->RowCount ?>_WorksheetColumns_Rank" class="WorksheetColumns_Rank">
<span<?php echo $WorksheetColumns_delete->Rank->viewAttributes() ?>><?php echo $WorksheetColumns_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetColumns_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $WorksheetColumns_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $WorksheetColumns_delete->RowCount ?>_WorksheetColumns_ActiveFlag" class="WorksheetColumns_ActiveFlag">
<span<?php echo $WorksheetColumns_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $WorksheetColumns_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetColumns_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$WorksheetColumns_delete->Recordset->moveNext();
}
$WorksheetColumns_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetColumns_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$WorksheetColumns_delete->showPageFooter();
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
$WorksheetColumns_delete->terminate();
?>