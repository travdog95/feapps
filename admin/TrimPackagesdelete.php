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
$TrimPackages_delete = new TrimPackages_delete();

// Run the page
$TrimPackages_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TrimPackages_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fTrimPackagesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fTrimPackagesdelete = currentForm = new ew.Form("fTrimPackagesdelete", "delete");
	loadjs.done("fTrimPackagesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $TrimPackages_delete->showPageHeader(); ?>
<?php
$TrimPackages_delete->showMessage();
?>
<form name="fTrimPackagesdelete" id="fTrimPackagesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TrimPackages">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($TrimPackages_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($TrimPackages_delete->TrimPackage_Idn->Visible) { // TrimPackage_Idn ?>
		<th class="<?php echo $TrimPackages_delete->TrimPackage_Idn->headerCellClass() ?>"><span id="elh_TrimPackages_TrimPackage_Idn" class="TrimPackages_TrimPackage_Idn"><?php echo $TrimPackages_delete->TrimPackage_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($TrimPackages_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $TrimPackages_delete->Name->headerCellClass() ?>"><span id="elh_TrimPackages_Name" class="TrimPackages_Name"><?php echo $TrimPackages_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($TrimPackages_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $TrimPackages_delete->Rank->headerCellClass() ?>"><span id="elh_TrimPackages_Rank" class="TrimPackages_Rank"><?php echo $TrimPackages_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($TrimPackages_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $TrimPackages_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_TrimPackages_ActiveFlag" class="TrimPackages_ActiveFlag"><?php echo $TrimPackages_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$TrimPackages_delete->RecordCount = 0;
$i = 0;
while (!$TrimPackages_delete->Recordset->EOF) {
	$TrimPackages_delete->RecordCount++;
	$TrimPackages_delete->RowCount++;

	// Set row properties
	$TrimPackages->resetAttributes();
	$TrimPackages->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$TrimPackages_delete->loadRowValues($TrimPackages_delete->Recordset);

	// Render row
	$TrimPackages_delete->renderRow();
?>
	<tr <?php echo $TrimPackages->rowAttributes() ?>>
<?php if ($TrimPackages_delete->TrimPackage_Idn->Visible) { // TrimPackage_Idn ?>
		<td <?php echo $TrimPackages_delete->TrimPackage_Idn->cellAttributes() ?>>
<span id="el<?php echo $TrimPackages_delete->RowCount ?>_TrimPackages_TrimPackage_Idn" class="TrimPackages_TrimPackage_Idn">
<span<?php echo $TrimPackages_delete->TrimPackage_Idn->viewAttributes() ?>><?php echo $TrimPackages_delete->TrimPackage_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($TrimPackages_delete->Name->Visible) { // Name ?>
		<td <?php echo $TrimPackages_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $TrimPackages_delete->RowCount ?>_TrimPackages_Name" class="TrimPackages_Name">
<span<?php echo $TrimPackages_delete->Name->viewAttributes() ?>><?php echo $TrimPackages_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($TrimPackages_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $TrimPackages_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $TrimPackages_delete->RowCount ?>_TrimPackages_Rank" class="TrimPackages_Rank">
<span<?php echo $TrimPackages_delete->Rank->viewAttributes() ?>><?php echo $TrimPackages_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($TrimPackages_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $TrimPackages_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $TrimPackages_delete->RowCount ?>_TrimPackages_ActiveFlag" class="TrimPackages_ActiveFlag">
<span<?php echo $TrimPackages_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $TrimPackages_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($TrimPackages_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$TrimPackages_delete->Recordset->moveNext();
}
$TrimPackages_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $TrimPackages_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$TrimPackages_delete->showPageFooter();
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
$TrimPackages_delete->terminate();
?>