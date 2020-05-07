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
$LiftDurations_delete = new LiftDurations_delete();

// Run the page
$LiftDurations_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LiftDurations_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fLiftDurationsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fLiftDurationsdelete = currentForm = new ew.Form("fLiftDurationsdelete", "delete");
	loadjs.done("fLiftDurationsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $LiftDurations_delete->showPageHeader(); ?>
<?php
$LiftDurations_delete->showMessage();
?>
<form name="fLiftDurationsdelete" id="fLiftDurationsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LiftDurations">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($LiftDurations_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($LiftDurations_delete->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
		<th class="<?php echo $LiftDurations_delete->LiftDuration_Idn->headerCellClass() ?>"><span id="elh_LiftDurations_LiftDuration_Idn" class="LiftDurations_LiftDuration_Idn"><?php echo $LiftDurations_delete->LiftDuration_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($LiftDurations_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $LiftDurations_delete->Name->headerCellClass() ?>"><span id="elh_LiftDurations_Name" class="LiftDurations_Name"><?php echo $LiftDurations_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($LiftDurations_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $LiftDurations_delete->Rank->headerCellClass() ?>"><span id="elh_LiftDurations_Rank" class="LiftDurations_Rank"><?php echo $LiftDurations_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($LiftDurations_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $LiftDurations_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_LiftDurations_ActiveFlag" class="LiftDurations_ActiveFlag"><?php echo $LiftDurations_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$LiftDurations_delete->RecordCount = 0;
$i = 0;
while (!$LiftDurations_delete->Recordset->EOF) {
	$LiftDurations_delete->RecordCount++;
	$LiftDurations_delete->RowCount++;

	// Set row properties
	$LiftDurations->resetAttributes();
	$LiftDurations->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$LiftDurations_delete->loadRowValues($LiftDurations_delete->Recordset);

	// Render row
	$LiftDurations_delete->renderRow();
?>
	<tr <?php echo $LiftDurations->rowAttributes() ?>>
<?php if ($LiftDurations_delete->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
		<td <?php echo $LiftDurations_delete->LiftDuration_Idn->cellAttributes() ?>>
<span id="el<?php echo $LiftDurations_delete->RowCount ?>_LiftDurations_LiftDuration_Idn" class="LiftDurations_LiftDuration_Idn">
<span<?php echo $LiftDurations_delete->LiftDuration_Idn->viewAttributes() ?>><?php echo $LiftDurations_delete->LiftDuration_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LiftDurations_delete->Name->Visible) { // Name ?>
		<td <?php echo $LiftDurations_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $LiftDurations_delete->RowCount ?>_LiftDurations_Name" class="LiftDurations_Name">
<span<?php echo $LiftDurations_delete->Name->viewAttributes() ?>><?php echo $LiftDurations_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LiftDurations_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $LiftDurations_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $LiftDurations_delete->RowCount ?>_LiftDurations_Rank" class="LiftDurations_Rank">
<span<?php echo $LiftDurations_delete->Rank->viewAttributes() ?>><?php echo $LiftDurations_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LiftDurations_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $LiftDurations_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $LiftDurations_delete->RowCount ?>_LiftDurations_ActiveFlag" class="LiftDurations_ActiveFlag">
<span<?php echo $LiftDurations_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $LiftDurations_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($LiftDurations_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$LiftDurations_delete->Recordset->moveNext();
}
$LiftDurations_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $LiftDurations_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$LiftDurations_delete->showPageFooter();
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
$LiftDurations_delete->terminate();
?>