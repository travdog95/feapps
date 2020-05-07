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
$ControlValves_delete = new ControlValves_delete();

// Run the page
$ControlValves_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ControlValves_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fControlValvesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fControlValvesdelete = currentForm = new ew.Form("fControlValvesdelete", "delete");
	loadjs.done("fControlValvesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ControlValves_delete->showPageHeader(); ?>
<?php
$ControlValves_delete->showMessage();
?>
<form name="fControlValvesdelete" id="fControlValvesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ControlValves">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ControlValves_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ControlValves_delete->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
		<th class="<?php echo $ControlValves_delete->ControlValve_Idn->headerCellClass() ?>"><span id="elh_ControlValves_ControlValve_Idn" class="ControlValves_ControlValve_Idn"><?php echo $ControlValves_delete->ControlValve_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($ControlValves_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $ControlValves_delete->Name->headerCellClass() ?>"><span id="elh_ControlValves_Name" class="ControlValves_Name"><?php echo $ControlValves_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($ControlValves_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $ControlValves_delete->Rank->headerCellClass() ?>"><span id="elh_ControlValves_Rank" class="ControlValves_Rank"><?php echo $ControlValves_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($ControlValves_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $ControlValves_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_ControlValves_ActiveFlag" class="ControlValves_ActiveFlag"><?php echo $ControlValves_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ControlValves_delete->RecordCount = 0;
$i = 0;
while (!$ControlValves_delete->Recordset->EOF) {
	$ControlValves_delete->RecordCount++;
	$ControlValves_delete->RowCount++;

	// Set row properties
	$ControlValves->resetAttributes();
	$ControlValves->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ControlValves_delete->loadRowValues($ControlValves_delete->Recordset);

	// Render row
	$ControlValves_delete->renderRow();
?>
	<tr <?php echo $ControlValves->rowAttributes() ?>>
<?php if ($ControlValves_delete->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
		<td <?php echo $ControlValves_delete->ControlValve_Idn->cellAttributes() ?>>
<span id="el<?php echo $ControlValves_delete->RowCount ?>_ControlValves_ControlValve_Idn" class="ControlValves_ControlValve_Idn">
<span<?php echo $ControlValves_delete->ControlValve_Idn->viewAttributes() ?>><?php echo $ControlValves_delete->ControlValve_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ControlValves_delete->Name->Visible) { // Name ?>
		<td <?php echo $ControlValves_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $ControlValves_delete->RowCount ?>_ControlValves_Name" class="ControlValves_Name">
<span<?php echo $ControlValves_delete->Name->viewAttributes() ?>><?php echo $ControlValves_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ControlValves_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $ControlValves_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $ControlValves_delete->RowCount ?>_ControlValves_Rank" class="ControlValves_Rank">
<span<?php echo $ControlValves_delete->Rank->viewAttributes() ?>><?php echo $ControlValves_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ControlValves_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $ControlValves_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $ControlValves_delete->RowCount ?>_ControlValves_ActiveFlag" class="ControlValves_ActiveFlag">
<span<?php echo $ControlValves_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ControlValves_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ControlValves_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ControlValves_delete->Recordset->moveNext();
}
$ControlValves_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ControlValves_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ControlValves_delete->showPageFooter();
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
$ControlValves_delete->terminate();
?>