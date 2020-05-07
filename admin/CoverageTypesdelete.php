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
$CoverageTypes_delete = new CoverageTypes_delete();

// Run the page
$CoverageTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CoverageTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCoverageTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fCoverageTypesdelete = currentForm = new ew.Form("fCoverageTypesdelete", "delete");
	loadjs.done("fCoverageTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $CoverageTypes_delete->showPageHeader(); ?>
<?php
$CoverageTypes_delete->showMessage();
?>
<form name="fCoverageTypesdelete" id="fCoverageTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CoverageTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($CoverageTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($CoverageTypes_delete->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
		<th class="<?php echo $CoverageTypes_delete->CoverageType_Idn->headerCellClass() ?>"><span id="elh_CoverageTypes_CoverageType_Idn" class="CoverageTypes_CoverageType_Idn"><?php echo $CoverageTypes_delete->CoverageType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($CoverageTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $CoverageTypes_delete->Name->headerCellClass() ?>"><span id="elh_CoverageTypes_Name" class="CoverageTypes_Name"><?php echo $CoverageTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($CoverageTypes_delete->ShortName->Visible) { // ShortName ?>
		<th class="<?php echo $CoverageTypes_delete->ShortName->headerCellClass() ?>"><span id="elh_CoverageTypes_ShortName" class="CoverageTypes_ShortName"><?php echo $CoverageTypes_delete->ShortName->caption() ?></span></th>
<?php } ?>
<?php if ($CoverageTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $CoverageTypes_delete->Rank->headerCellClass() ?>"><span id="elh_CoverageTypes_Rank" class="CoverageTypes_Rank"><?php echo $CoverageTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($CoverageTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $CoverageTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_CoverageTypes_ActiveFlag" class="CoverageTypes_ActiveFlag"><?php echo $CoverageTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$CoverageTypes_delete->RecordCount = 0;
$i = 0;
while (!$CoverageTypes_delete->Recordset->EOF) {
	$CoverageTypes_delete->RecordCount++;
	$CoverageTypes_delete->RowCount++;

	// Set row properties
	$CoverageTypes->resetAttributes();
	$CoverageTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$CoverageTypes_delete->loadRowValues($CoverageTypes_delete->Recordset);

	// Render row
	$CoverageTypes_delete->renderRow();
?>
	<tr <?php echo $CoverageTypes->rowAttributes() ?>>
<?php if ($CoverageTypes_delete->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
		<td <?php echo $CoverageTypes_delete->CoverageType_Idn->cellAttributes() ?>>
<span id="el<?php echo $CoverageTypes_delete->RowCount ?>_CoverageTypes_CoverageType_Idn" class="CoverageTypes_CoverageType_Idn">
<span<?php echo $CoverageTypes_delete->CoverageType_Idn->viewAttributes() ?>><?php echo $CoverageTypes_delete->CoverageType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CoverageTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $CoverageTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $CoverageTypes_delete->RowCount ?>_CoverageTypes_Name" class="CoverageTypes_Name">
<span<?php echo $CoverageTypes_delete->Name->viewAttributes() ?>><?php echo $CoverageTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CoverageTypes_delete->ShortName->Visible) { // ShortName ?>
		<td <?php echo $CoverageTypes_delete->ShortName->cellAttributes() ?>>
<span id="el<?php echo $CoverageTypes_delete->RowCount ?>_CoverageTypes_ShortName" class="CoverageTypes_ShortName">
<span<?php echo $CoverageTypes_delete->ShortName->viewAttributes() ?>><?php echo $CoverageTypes_delete->ShortName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CoverageTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $CoverageTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $CoverageTypes_delete->RowCount ?>_CoverageTypes_Rank" class="CoverageTypes_Rank">
<span<?php echo $CoverageTypes_delete->Rank->viewAttributes() ?>><?php echo $CoverageTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CoverageTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $CoverageTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $CoverageTypes_delete->RowCount ?>_CoverageTypes_ActiveFlag" class="CoverageTypes_ActiveFlag">
<span<?php echo $CoverageTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $CoverageTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($CoverageTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$CoverageTypes_delete->Recordset->moveNext();
}
$CoverageTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $CoverageTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$CoverageTypes_delete->showPageFooter();
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
$CoverageTypes_delete->terminate();
?>