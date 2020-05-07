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
$BellTypes_delete = new BellTypes_delete();

// Run the page
$BellTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$BellTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fBellTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fBellTypesdelete = currentForm = new ew.Form("fBellTypesdelete", "delete");
	loadjs.done("fBellTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $BellTypes_delete->showPageHeader(); ?>
<?php
$BellTypes_delete->showMessage();
?>
<form name="fBellTypesdelete" id="fBellTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="BellTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($BellTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($BellTypes_delete->BellType_Idn->Visible) { // BellType_Idn ?>
		<th class="<?php echo $BellTypes_delete->BellType_Idn->headerCellClass() ?>"><span id="elh_BellTypes_BellType_Idn" class="BellTypes_BellType_Idn"><?php echo $BellTypes_delete->BellType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($BellTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $BellTypes_delete->Name->headerCellClass() ?>"><span id="elh_BellTypes_Name" class="BellTypes_Name"><?php echo $BellTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($BellTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $BellTypes_delete->Rank->headerCellClass() ?>"><span id="elh_BellTypes_Rank" class="BellTypes_Rank"><?php echo $BellTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($BellTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $BellTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_BellTypes_ActiveFlag" class="BellTypes_ActiveFlag"><?php echo $BellTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$BellTypes_delete->RecordCount = 0;
$i = 0;
while (!$BellTypes_delete->Recordset->EOF) {
	$BellTypes_delete->RecordCount++;
	$BellTypes_delete->RowCount++;

	// Set row properties
	$BellTypes->resetAttributes();
	$BellTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$BellTypes_delete->loadRowValues($BellTypes_delete->Recordset);

	// Render row
	$BellTypes_delete->renderRow();
?>
	<tr <?php echo $BellTypes->rowAttributes() ?>>
<?php if ($BellTypes_delete->BellType_Idn->Visible) { // BellType_Idn ?>
		<td <?php echo $BellTypes_delete->BellType_Idn->cellAttributes() ?>>
<span id="el<?php echo $BellTypes_delete->RowCount ?>_BellTypes_BellType_Idn" class="BellTypes_BellType_Idn">
<span<?php echo $BellTypes_delete->BellType_Idn->viewAttributes() ?>><?php echo $BellTypes_delete->BellType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BellTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $BellTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $BellTypes_delete->RowCount ?>_BellTypes_Name" class="BellTypes_Name">
<span<?php echo $BellTypes_delete->Name->viewAttributes() ?>><?php echo $BellTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BellTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $BellTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $BellTypes_delete->RowCount ?>_BellTypes_Rank" class="BellTypes_Rank">
<span<?php echo $BellTypes_delete->Rank->viewAttributes() ?>><?php echo $BellTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BellTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $BellTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $BellTypes_delete->RowCount ?>_BellTypes_ActiveFlag" class="BellTypes_ActiveFlag">
<span<?php echo $BellTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $BellTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($BellTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$BellTypes_delete->Recordset->moveNext();
}
$BellTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $BellTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$BellTypes_delete->showPageFooter();
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
$BellTypes_delete->terminate();
?>