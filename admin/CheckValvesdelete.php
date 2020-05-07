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
$CheckValves_delete = new CheckValves_delete();

// Run the page
$CheckValves_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CheckValves_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCheckValvesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fCheckValvesdelete = currentForm = new ew.Form("fCheckValvesdelete", "delete");
	loadjs.done("fCheckValvesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $CheckValves_delete->showPageHeader(); ?>
<?php
$CheckValves_delete->showMessage();
?>
<form name="fCheckValvesdelete" id="fCheckValvesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CheckValves">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($CheckValves_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($CheckValves_delete->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
		<th class="<?php echo $CheckValves_delete->CheckValve_Idn->headerCellClass() ?>"><span id="elh_CheckValves_CheckValve_Idn" class="CheckValves_CheckValve_Idn"><?php echo $CheckValves_delete->CheckValve_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($CheckValves_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $CheckValves_delete->Name->headerCellClass() ?>"><span id="elh_CheckValves_Name" class="CheckValves_Name"><?php echo $CheckValves_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($CheckValves_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $CheckValves_delete->Rank->headerCellClass() ?>"><span id="elh_CheckValves_Rank" class="CheckValves_Rank"><?php echo $CheckValves_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($CheckValves_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $CheckValves_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_CheckValves_ActiveFlag" class="CheckValves_ActiveFlag"><?php echo $CheckValves_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$CheckValves_delete->RecordCount = 0;
$i = 0;
while (!$CheckValves_delete->Recordset->EOF) {
	$CheckValves_delete->RecordCount++;
	$CheckValves_delete->RowCount++;

	// Set row properties
	$CheckValves->resetAttributes();
	$CheckValves->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$CheckValves_delete->loadRowValues($CheckValves_delete->Recordset);

	// Render row
	$CheckValves_delete->renderRow();
?>
	<tr <?php echo $CheckValves->rowAttributes() ?>>
<?php if ($CheckValves_delete->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
		<td <?php echo $CheckValves_delete->CheckValve_Idn->cellAttributes() ?>>
<span id="el<?php echo $CheckValves_delete->RowCount ?>_CheckValves_CheckValve_Idn" class="CheckValves_CheckValve_Idn">
<span<?php echo $CheckValves_delete->CheckValve_Idn->viewAttributes() ?>><?php echo $CheckValves_delete->CheckValve_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CheckValves_delete->Name->Visible) { // Name ?>
		<td <?php echo $CheckValves_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $CheckValves_delete->RowCount ?>_CheckValves_Name" class="CheckValves_Name">
<span<?php echo $CheckValves_delete->Name->viewAttributes() ?>><?php echo $CheckValves_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CheckValves_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $CheckValves_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $CheckValves_delete->RowCount ?>_CheckValves_Rank" class="CheckValves_Rank">
<span<?php echo $CheckValves_delete->Rank->viewAttributes() ?>><?php echo $CheckValves_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CheckValves_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $CheckValves_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $CheckValves_delete->RowCount ?>_CheckValves_ActiveFlag" class="CheckValves_ActiveFlag">
<span<?php echo $CheckValves_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $CheckValves_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($CheckValves_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$CheckValves_delete->Recordset->moveNext();
}
$CheckValves_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $CheckValves_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$CheckValves_delete->showPageFooter();
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
$CheckValves_delete->terminate();
?>