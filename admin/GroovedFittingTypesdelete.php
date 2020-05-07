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
$GroovedFittingTypes_delete = new GroovedFittingTypes_delete();

// Run the page
$GroovedFittingTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GroovedFittingTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fGroovedFittingTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fGroovedFittingTypesdelete = currentForm = new ew.Form("fGroovedFittingTypesdelete", "delete");
	loadjs.done("fGroovedFittingTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $GroovedFittingTypes_delete->showPageHeader(); ?>
<?php
$GroovedFittingTypes_delete->showMessage();
?>
<form name="fGroovedFittingTypesdelete" id="fGroovedFittingTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GroovedFittingTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($GroovedFittingTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($GroovedFittingTypes_delete->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
		<th class="<?php echo $GroovedFittingTypes_delete->GroovedFittingType_Idn->headerCellClass() ?>"><span id="elh_GroovedFittingTypes_GroovedFittingType_Idn" class="GroovedFittingTypes_GroovedFittingType_Idn"><?php echo $GroovedFittingTypes_delete->GroovedFittingType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($GroovedFittingTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $GroovedFittingTypes_delete->Name->headerCellClass() ?>"><span id="elh_GroovedFittingTypes_Name" class="GroovedFittingTypes_Name"><?php echo $GroovedFittingTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($GroovedFittingTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $GroovedFittingTypes_delete->Rank->headerCellClass() ?>"><span id="elh_GroovedFittingTypes_Rank" class="GroovedFittingTypes_Rank"><?php echo $GroovedFittingTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($GroovedFittingTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $GroovedFittingTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_GroovedFittingTypes_ActiveFlag" class="GroovedFittingTypes_ActiveFlag"><?php echo $GroovedFittingTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$GroovedFittingTypes_delete->RecordCount = 0;
$i = 0;
while (!$GroovedFittingTypes_delete->Recordset->EOF) {
	$GroovedFittingTypes_delete->RecordCount++;
	$GroovedFittingTypes_delete->RowCount++;

	// Set row properties
	$GroovedFittingTypes->resetAttributes();
	$GroovedFittingTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$GroovedFittingTypes_delete->loadRowValues($GroovedFittingTypes_delete->Recordset);

	// Render row
	$GroovedFittingTypes_delete->renderRow();
?>
	<tr <?php echo $GroovedFittingTypes->rowAttributes() ?>>
<?php if ($GroovedFittingTypes_delete->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
		<td <?php echo $GroovedFittingTypes_delete->GroovedFittingType_Idn->cellAttributes() ?>>
<span id="el<?php echo $GroovedFittingTypes_delete->RowCount ?>_GroovedFittingTypes_GroovedFittingType_Idn" class="GroovedFittingTypes_GroovedFittingType_Idn">
<span<?php echo $GroovedFittingTypes_delete->GroovedFittingType_Idn->viewAttributes() ?>><?php echo $GroovedFittingTypes_delete->GroovedFittingType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($GroovedFittingTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $GroovedFittingTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $GroovedFittingTypes_delete->RowCount ?>_GroovedFittingTypes_Name" class="GroovedFittingTypes_Name">
<span<?php echo $GroovedFittingTypes_delete->Name->viewAttributes() ?>><?php echo $GroovedFittingTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($GroovedFittingTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $GroovedFittingTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $GroovedFittingTypes_delete->RowCount ?>_GroovedFittingTypes_Rank" class="GroovedFittingTypes_Rank">
<span<?php echo $GroovedFittingTypes_delete->Rank->viewAttributes() ?>><?php echo $GroovedFittingTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($GroovedFittingTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $GroovedFittingTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $GroovedFittingTypes_delete->RowCount ?>_GroovedFittingTypes_ActiveFlag" class="GroovedFittingTypes_ActiveFlag">
<span<?php echo $GroovedFittingTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $GroovedFittingTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($GroovedFittingTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$GroovedFittingTypes_delete->Recordset->moveNext();
}
$GroovedFittingTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $GroovedFittingTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$GroovedFittingTypes_delete->showPageFooter();
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
$GroovedFittingTypes_delete->terminate();
?>