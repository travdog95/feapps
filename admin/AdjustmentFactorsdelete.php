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
$AdjustmentFactors_delete = new AdjustmentFactors_delete();

// Run the page
$AdjustmentFactors_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AdjustmentFactors_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fAdjustmentFactorsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fAdjustmentFactorsdelete = currentForm = new ew.Form("fAdjustmentFactorsdelete", "delete");
	loadjs.done("fAdjustmentFactorsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $AdjustmentFactors_delete->showPageHeader(); ?>
<?php
$AdjustmentFactors_delete->showMessage();
?>
<form name="fAdjustmentFactorsdelete" id="fAdjustmentFactorsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AdjustmentFactors">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($AdjustmentFactors_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($AdjustmentFactors_delete->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<th class="<?php echo $AdjustmentFactors_delete->AdjustmentFactor_Idn->headerCellClass() ?>"><span id="elh_AdjustmentFactors_AdjustmentFactor_Idn" class="AdjustmentFactors_AdjustmentFactor_Idn"><?php echo $AdjustmentFactors_delete->AdjustmentFactor_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($AdjustmentFactors_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<th class="<?php echo $AdjustmentFactors_delete->WorksheetMaster_Idn->headerCellClass() ?>"><span id="elh_AdjustmentFactors_WorksheetMaster_Idn" class="AdjustmentFactors_WorksheetMaster_Idn"><?php echo $AdjustmentFactors_delete->WorksheetMaster_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($AdjustmentFactors_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $AdjustmentFactors_delete->Name->headerCellClass() ?>"><span id="elh_AdjustmentFactors_Name" class="AdjustmentFactors_Name"><?php echo $AdjustmentFactors_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($AdjustmentFactors_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $AdjustmentFactors_delete->Rank->headerCellClass() ?>"><span id="elh_AdjustmentFactors_Rank" class="AdjustmentFactors_Rank"><?php echo $AdjustmentFactors_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($AdjustmentFactors_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $AdjustmentFactors_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_AdjustmentFactors_ActiveFlag" class="AdjustmentFactors_ActiveFlag"><?php echo $AdjustmentFactors_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$AdjustmentFactors_delete->RecordCount = 0;
$i = 0;
while (!$AdjustmentFactors_delete->Recordset->EOF) {
	$AdjustmentFactors_delete->RecordCount++;
	$AdjustmentFactors_delete->RowCount++;

	// Set row properties
	$AdjustmentFactors->resetAttributes();
	$AdjustmentFactors->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$AdjustmentFactors_delete->loadRowValues($AdjustmentFactors_delete->Recordset);

	// Render row
	$AdjustmentFactors_delete->renderRow();
?>
	<tr <?php echo $AdjustmentFactors->rowAttributes() ?>>
<?php if ($AdjustmentFactors_delete->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td <?php echo $AdjustmentFactors_delete->AdjustmentFactor_Idn->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentFactors_delete->RowCount ?>_AdjustmentFactors_AdjustmentFactor_Idn" class="AdjustmentFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentFactors_delete->AdjustmentFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentFactors_delete->AdjustmentFactor_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AdjustmentFactors_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td <?php echo $AdjustmentFactors_delete->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentFactors_delete->RowCount ?>_AdjustmentFactors_WorksheetMaster_Idn" class="AdjustmentFactors_WorksheetMaster_Idn">
<span<?php echo $AdjustmentFactors_delete->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $AdjustmentFactors_delete->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AdjustmentFactors_delete->Name->Visible) { // Name ?>
		<td <?php echo $AdjustmentFactors_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentFactors_delete->RowCount ?>_AdjustmentFactors_Name" class="AdjustmentFactors_Name">
<span<?php echo $AdjustmentFactors_delete->Name->viewAttributes() ?>><?php echo $AdjustmentFactors_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AdjustmentFactors_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $AdjustmentFactors_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentFactors_delete->RowCount ?>_AdjustmentFactors_Rank" class="AdjustmentFactors_Rank">
<span<?php echo $AdjustmentFactors_delete->Rank->viewAttributes() ?>><?php echo $AdjustmentFactors_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AdjustmentFactors_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $AdjustmentFactors_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $AdjustmentFactors_delete->RowCount ?>_AdjustmentFactors_ActiveFlag" class="AdjustmentFactors_ActiveFlag">
<span<?php echo $AdjustmentFactors_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $AdjustmentFactors_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($AdjustmentFactors_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$AdjustmentFactors_delete->Recordset->moveNext();
}
$AdjustmentFactors_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $AdjustmentFactors_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$AdjustmentFactors_delete->showPageFooter();
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
$AdjustmentFactors_delete->terminate();
?>