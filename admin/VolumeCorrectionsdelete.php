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
$VolumeCorrections_delete = new VolumeCorrections_delete();

// Run the page
$VolumeCorrections_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$VolumeCorrections_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fVolumeCorrectionsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fVolumeCorrectionsdelete = currentForm = new ew.Form("fVolumeCorrectionsdelete", "delete");
	loadjs.done("fVolumeCorrectionsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $VolumeCorrections_delete->showPageHeader(); ?>
<?php
$VolumeCorrections_delete->showMessage();
?>
<form name="fVolumeCorrectionsdelete" id="fVolumeCorrectionsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="VolumeCorrections">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($VolumeCorrections_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($VolumeCorrections_delete->VolumeCorrection_Idn->Visible) { // VolumeCorrection_Idn ?>
		<th class="<?php echo $VolumeCorrections_delete->VolumeCorrection_Idn->headerCellClass() ?>"><span id="elh_VolumeCorrections_VolumeCorrection_Idn" class="VolumeCorrections_VolumeCorrection_Idn"><?php echo $VolumeCorrections_delete->VolumeCorrection_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($VolumeCorrections_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $VolumeCorrections_delete->Name->headerCellClass() ?>"><span id="elh_VolumeCorrections_Name" class="VolumeCorrections_Name"><?php echo $VolumeCorrections_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($VolumeCorrections_delete->Value->Visible) { // Value ?>
		<th class="<?php echo $VolumeCorrections_delete->Value->headerCellClass() ?>"><span id="elh_VolumeCorrections_Value" class="VolumeCorrections_Value"><?php echo $VolumeCorrections_delete->Value->caption() ?></span></th>
<?php } ?>
<?php if ($VolumeCorrections_delete->Hours->Visible) { // Hours ?>
		<th class="<?php echo $VolumeCorrections_delete->Hours->headerCellClass() ?>"><span id="elh_VolumeCorrections_Hours" class="VolumeCorrections_Hours"><?php echo $VolumeCorrections_delete->Hours->caption() ?></span></th>
<?php } ?>
<?php if ($VolumeCorrections_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $VolumeCorrections_delete->Rank->headerCellClass() ?>"><span id="elh_VolumeCorrections_Rank" class="VolumeCorrections_Rank"><?php echo $VolumeCorrections_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($VolumeCorrections_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $VolumeCorrections_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_VolumeCorrections_ActiveFlag" class="VolumeCorrections_ActiveFlag"><?php echo $VolumeCorrections_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$VolumeCorrections_delete->RecordCount = 0;
$i = 0;
while (!$VolumeCorrections_delete->Recordset->EOF) {
	$VolumeCorrections_delete->RecordCount++;
	$VolumeCorrections_delete->RowCount++;

	// Set row properties
	$VolumeCorrections->resetAttributes();
	$VolumeCorrections->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$VolumeCorrections_delete->loadRowValues($VolumeCorrections_delete->Recordset);

	// Render row
	$VolumeCorrections_delete->renderRow();
?>
	<tr <?php echo $VolumeCorrections->rowAttributes() ?>>
<?php if ($VolumeCorrections_delete->VolumeCorrection_Idn->Visible) { // VolumeCorrection_Idn ?>
		<td <?php echo $VolumeCorrections_delete->VolumeCorrection_Idn->cellAttributes() ?>>
<span id="el<?php echo $VolumeCorrections_delete->RowCount ?>_VolumeCorrections_VolumeCorrection_Idn" class="VolumeCorrections_VolumeCorrection_Idn">
<span<?php echo $VolumeCorrections_delete->VolumeCorrection_Idn->viewAttributes() ?>><?php echo $VolumeCorrections_delete->VolumeCorrection_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($VolumeCorrections_delete->Name->Visible) { // Name ?>
		<td <?php echo $VolumeCorrections_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $VolumeCorrections_delete->RowCount ?>_VolumeCorrections_Name" class="VolumeCorrections_Name">
<span<?php echo $VolumeCorrections_delete->Name->viewAttributes() ?>><?php echo $VolumeCorrections_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($VolumeCorrections_delete->Value->Visible) { // Value ?>
		<td <?php echo $VolumeCorrections_delete->Value->cellAttributes() ?>>
<span id="el<?php echo $VolumeCorrections_delete->RowCount ?>_VolumeCorrections_Value" class="VolumeCorrections_Value">
<span<?php echo $VolumeCorrections_delete->Value->viewAttributes() ?>><?php echo $VolumeCorrections_delete->Value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($VolumeCorrections_delete->Hours->Visible) { // Hours ?>
		<td <?php echo $VolumeCorrections_delete->Hours->cellAttributes() ?>>
<span id="el<?php echo $VolumeCorrections_delete->RowCount ?>_VolumeCorrections_Hours" class="VolumeCorrections_Hours">
<span<?php echo $VolumeCorrections_delete->Hours->viewAttributes() ?>><?php echo $VolumeCorrections_delete->Hours->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($VolumeCorrections_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $VolumeCorrections_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $VolumeCorrections_delete->RowCount ?>_VolumeCorrections_Rank" class="VolumeCorrections_Rank">
<span<?php echo $VolumeCorrections_delete->Rank->viewAttributes() ?>><?php echo $VolumeCorrections_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($VolumeCorrections_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $VolumeCorrections_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $VolumeCorrections_delete->RowCount ?>_VolumeCorrections_ActiveFlag" class="VolumeCorrections_ActiveFlag">
<span<?php echo $VolumeCorrections_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $VolumeCorrections_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($VolumeCorrections_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$VolumeCorrections_delete->Recordset->moveNext();
}
$VolumeCorrections_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $VolumeCorrections_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$VolumeCorrections_delete->showPageFooter();
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
$VolumeCorrections_delete->terminate();
?>