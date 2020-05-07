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
$RiserTypes_delete = new RiserTypes_delete();

// Run the page
$RiserTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RiserTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRiserTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fRiserTypesdelete = currentForm = new ew.Form("fRiserTypesdelete", "delete");
	loadjs.done("fRiserTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RiserTypes_delete->showPageHeader(); ?>
<?php
$RiserTypes_delete->showMessage();
?>
<form name="fRiserTypesdelete" id="fRiserTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RiserTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($RiserTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($RiserTypes_delete->RiserType_Idn->Visible) { // RiserType_Idn ?>
		<th class="<?php echo $RiserTypes_delete->RiserType_Idn->headerCellClass() ?>"><span id="elh_RiserTypes_RiserType_Idn" class="RiserTypes_RiserType_Idn"><?php echo $RiserTypes_delete->RiserType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($RiserTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $RiserTypes_delete->Name->headerCellClass() ?>"><span id="elh_RiserTypes_Name" class="RiserTypes_Name"><?php echo $RiserTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($RiserTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $RiserTypes_delete->Rank->headerCellClass() ?>"><span id="elh_RiserTypes_Rank" class="RiserTypes_Rank"><?php echo $RiserTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($RiserTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $RiserTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_RiserTypes_ActiveFlag" class="RiserTypes_ActiveFlag"><?php echo $RiserTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$RiserTypes_delete->RecordCount = 0;
$i = 0;
while (!$RiserTypes_delete->Recordset->EOF) {
	$RiserTypes_delete->RecordCount++;
	$RiserTypes_delete->RowCount++;

	// Set row properties
	$RiserTypes->resetAttributes();
	$RiserTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$RiserTypes_delete->loadRowValues($RiserTypes_delete->Recordset);

	// Render row
	$RiserTypes_delete->renderRow();
?>
	<tr <?php echo $RiserTypes->rowAttributes() ?>>
<?php if ($RiserTypes_delete->RiserType_Idn->Visible) { // RiserType_Idn ?>
		<td <?php echo $RiserTypes_delete->RiserType_Idn->cellAttributes() ?>>
<span id="el<?php echo $RiserTypes_delete->RowCount ?>_RiserTypes_RiserType_Idn" class="RiserTypes_RiserType_Idn">
<span<?php echo $RiserTypes_delete->RiserType_Idn->viewAttributes() ?>><?php echo $RiserTypes_delete->RiserType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RiserTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $RiserTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $RiserTypes_delete->RowCount ?>_RiserTypes_Name" class="RiserTypes_Name">
<span<?php echo $RiserTypes_delete->Name->viewAttributes() ?>><?php echo $RiserTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RiserTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $RiserTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $RiserTypes_delete->RowCount ?>_RiserTypes_Rank" class="RiserTypes_Rank">
<span<?php echo $RiserTypes_delete->Rank->viewAttributes() ?>><?php echo $RiserTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RiserTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $RiserTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $RiserTypes_delete->RowCount ?>_RiserTypes_ActiveFlag" class="RiserTypes_ActiveFlag">
<span<?php echo $RiserTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $RiserTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RiserTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$RiserTypes_delete->Recordset->moveNext();
}
$RiserTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RiserTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$RiserTypes_delete->showPageFooter();
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
$RiserTypes_delete->terminate();
?>