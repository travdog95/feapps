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
$PipeExposures_delete = new PipeExposures_delete();

// Run the page
$PipeExposures_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeExposures_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPipeExposuresdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fPipeExposuresdelete = currentForm = new ew.Form("fPipeExposuresdelete", "delete");
	loadjs.done("fPipeExposuresdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $PipeExposures_delete->showPageHeader(); ?>
<?php
$PipeExposures_delete->showMessage();
?>
<form name="fPipeExposuresdelete" id="fPipeExposuresdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeExposures">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($PipeExposures_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($PipeExposures_delete->PipeExposure_Idn->Visible) { // PipeExposure_Idn ?>
		<th class="<?php echo $PipeExposures_delete->PipeExposure_Idn->headerCellClass() ?>"><span id="elh_PipeExposures_PipeExposure_Idn" class="PipeExposures_PipeExposure_Idn"><?php echo $PipeExposures_delete->PipeExposure_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($PipeExposures_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $PipeExposures_delete->Name->headerCellClass() ?>"><span id="elh_PipeExposures_Name" class="PipeExposures_Name"><?php echo $PipeExposures_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($PipeExposures_delete->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<th class="<?php echo $PipeExposures_delete->AdjustmentFactor_Idn->headerCellClass() ?>"><span id="elh_PipeExposures_AdjustmentFactor_Idn" class="PipeExposures_AdjustmentFactor_Idn"><?php echo $PipeExposures_delete->AdjustmentFactor_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($PipeExposures_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $PipeExposures_delete->Rank->headerCellClass() ?>"><span id="elh_PipeExposures_Rank" class="PipeExposures_Rank"><?php echo $PipeExposures_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($PipeExposures_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $PipeExposures_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_PipeExposures_ActiveFlag" class="PipeExposures_ActiveFlag"><?php echo $PipeExposures_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$PipeExposures_delete->RecordCount = 0;
$i = 0;
while (!$PipeExposures_delete->Recordset->EOF) {
	$PipeExposures_delete->RecordCount++;
	$PipeExposures_delete->RowCount++;

	// Set row properties
	$PipeExposures->resetAttributes();
	$PipeExposures->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$PipeExposures_delete->loadRowValues($PipeExposures_delete->Recordset);

	// Render row
	$PipeExposures_delete->renderRow();
?>
	<tr <?php echo $PipeExposures->rowAttributes() ?>>
<?php if ($PipeExposures_delete->PipeExposure_Idn->Visible) { // PipeExposure_Idn ?>
		<td <?php echo $PipeExposures_delete->PipeExposure_Idn->cellAttributes() ?>>
<span id="el<?php echo $PipeExposures_delete->RowCount ?>_PipeExposures_PipeExposure_Idn" class="PipeExposures_PipeExposure_Idn">
<span<?php echo $PipeExposures_delete->PipeExposure_Idn->viewAttributes() ?>><?php echo $PipeExposures_delete->PipeExposure_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeExposures_delete->Name->Visible) { // Name ?>
		<td <?php echo $PipeExposures_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $PipeExposures_delete->RowCount ?>_PipeExposures_Name" class="PipeExposures_Name">
<span<?php echo $PipeExposures_delete->Name->viewAttributes() ?>><?php echo $PipeExposures_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeExposures_delete->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td <?php echo $PipeExposures_delete->AdjustmentFactor_Idn->cellAttributes() ?>>
<span id="el<?php echo $PipeExposures_delete->RowCount ?>_PipeExposures_AdjustmentFactor_Idn" class="PipeExposures_AdjustmentFactor_Idn">
<span<?php echo $PipeExposures_delete->AdjustmentFactor_Idn->viewAttributes() ?>><?php echo $PipeExposures_delete->AdjustmentFactor_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeExposures_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $PipeExposures_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $PipeExposures_delete->RowCount ?>_PipeExposures_Rank" class="PipeExposures_Rank">
<span<?php echo $PipeExposures_delete->Rank->viewAttributes() ?>><?php echo $PipeExposures_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeExposures_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $PipeExposures_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $PipeExposures_delete->RowCount ?>_PipeExposures_ActiveFlag" class="PipeExposures_ActiveFlag">
<span<?php echo $PipeExposures_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PipeExposures_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeExposures_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$PipeExposures_delete->Recordset->moveNext();
}
$PipeExposures_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $PipeExposures_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$PipeExposures_delete->showPageFooter();
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
$PipeExposures_delete->terminate();
?>