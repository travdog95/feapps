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
$AdjustmentSubFactors_delete = new AdjustmentSubFactors_delete();

// Run the page
$AdjustmentSubFactors_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AdjustmentSubFactors_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fAdjustmentSubFactorsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fAdjustmentSubFactorsdelete = currentForm = new ew.Form("fAdjustmentSubFactorsdelete", "delete");
	loadjs.done("fAdjustmentSubFactorsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $AdjustmentSubFactors_delete->showPageHeader(); ?>
<?php
$AdjustmentSubFactors_delete->showMessage();
?>
<form name="fAdjustmentSubFactorsdelete" id="fAdjustmentSubFactorsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AdjustmentSubFactors">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($AdjustmentSubFactors_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($AdjustmentSubFactors_delete->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
		<th class="<?php echo $AdjustmentSubFactors_delete->AdjustmentSubFactor_Idn->headerCellClass() ?>"><span id="elh_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="AdjustmentSubFactors_AdjustmentSubFactor_Idn"><?php echo $AdjustmentSubFactors_delete->AdjustmentSubFactor_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<th class="<?php echo $AdjustmentSubFactors_delete->AdjustmentFactor_Idn->headerCellClass() ?>"><span id="elh_AdjustmentSubFactors_AdjustmentFactor_Idn" class="AdjustmentSubFactors_AdjustmentFactor_Idn"><?php echo $AdjustmentSubFactors_delete->AdjustmentFactor_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $AdjustmentSubFactors_delete->Name->headerCellClass() ?>"><span id="elh_AdjustmentSubFactors_Name" class="AdjustmentSubFactors_Name"><?php echo $AdjustmentSubFactors_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->Value->Visible) { // Value ?>
		<th class="<?php echo $AdjustmentSubFactors_delete->Value->headerCellClass() ?>"><span id="elh_AdjustmentSubFactors_Value" class="AdjustmentSubFactors_Value"><?php echo $AdjustmentSubFactors_delete->Value->caption() ?></span></th>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
		<th class="<?php echo $AdjustmentSubFactors_delete->LaborClass_Idn->headerCellClass() ?>"><span id="elh_AdjustmentSubFactors_LaborClass_Idn" class="AdjustmentSubFactors_LaborClass_Idn"><?php echo $AdjustmentSubFactors_delete->LaborClass_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $AdjustmentSubFactors_delete->Rank->headerCellClass() ?>"><span id="elh_AdjustmentSubFactors_Rank" class="AdjustmentSubFactors_Rank"><?php echo $AdjustmentSubFactors_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $AdjustmentSubFactors_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_AdjustmentSubFactors_ActiveFlag" class="AdjustmentSubFactors_ActiveFlag"><?php echo $AdjustmentSubFactors_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$AdjustmentSubFactors_delete->RecordCount = 0;
$i = 0;
while (!$AdjustmentSubFactors_delete->Recordset->EOF) {
	$AdjustmentSubFactors_delete->RecordCount++;
	$AdjustmentSubFactors_delete->RowCount++;

	// Set row properties
	$AdjustmentSubFactors->resetAttributes();
	$AdjustmentSubFactors->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$AdjustmentSubFactors_delete->loadRowValues($AdjustmentSubFactors_delete->Recordset);

	// Render row
	$AdjustmentSubFactors_delete->renderRow();
?>
	<tr <?php echo $AdjustmentSubFactors->rowAttributes() ?>>
<?php if ($AdjustmentSubFactors_delete->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
		<td <?php echo $AdjustmentSubFactors_delete->AdjustmentSubFactor_Idn->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentSubFactors_delete->RowCount ?>_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="AdjustmentSubFactors_AdjustmentSubFactor_Idn">
<span<?php echo $AdjustmentSubFactors_delete->AdjustmentSubFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_delete->AdjustmentSubFactor_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td <?php echo $AdjustmentSubFactors_delete->AdjustmentFactor_Idn->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentSubFactors_delete->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn" class="AdjustmentSubFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentSubFactors_delete->AdjustmentFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_delete->AdjustmentFactor_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->Name->Visible) { // Name ?>
		<td <?php echo $AdjustmentSubFactors_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentSubFactors_delete->RowCount ?>_AdjustmentSubFactors_Name" class="AdjustmentSubFactors_Name">
<span<?php echo $AdjustmentSubFactors_delete->Name->viewAttributes() ?>><?php echo $AdjustmentSubFactors_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->Value->Visible) { // Value ?>
		<td <?php echo $AdjustmentSubFactors_delete->Value->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentSubFactors_delete->RowCount ?>_AdjustmentSubFactors_Value" class="AdjustmentSubFactors_Value">
<span<?php echo $AdjustmentSubFactors_delete->Value->viewAttributes() ?>><?php echo $AdjustmentSubFactors_delete->Value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
		<td <?php echo $AdjustmentSubFactors_delete->LaborClass_Idn->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentSubFactors_delete->RowCount ?>_AdjustmentSubFactors_LaborClass_Idn" class="AdjustmentSubFactors_LaborClass_Idn">
<span<?php echo $AdjustmentSubFactors_delete->LaborClass_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_delete->LaborClass_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $AdjustmentSubFactors_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentSubFactors_delete->RowCount ?>_AdjustmentSubFactors_Rank" class="AdjustmentSubFactors_Rank">
<span<?php echo $AdjustmentSubFactors_delete->Rank->viewAttributes() ?>><?php echo $AdjustmentSubFactors_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $AdjustmentSubFactors_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentSubFactors_delete->RowCount ?>_AdjustmentSubFactors_ActiveFlag" class="AdjustmentSubFactors_ActiveFlag">
<span<?php echo $AdjustmentSubFactors_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $AdjustmentSubFactors_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($AdjustmentSubFactors_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$AdjustmentSubFactors_delete->Recordset->moveNext();
}
$AdjustmentSubFactors_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $AdjustmentSubFactors_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$AdjustmentSubFactors_delete->showPageFooter();
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
$AdjustmentSubFactors_delete->terminate();
?>