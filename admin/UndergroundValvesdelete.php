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
$UndergroundValves_delete = new UndergroundValves_delete();

// Run the page
$UndergroundValves_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$UndergroundValves_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fUndergroundValvesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fUndergroundValvesdelete = currentForm = new ew.Form("fUndergroundValvesdelete", "delete");
	loadjs.done("fUndergroundValvesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $UndergroundValves_delete->showPageHeader(); ?>
<?php
$UndergroundValves_delete->showMessage();
?>
<form name="fUndergroundValvesdelete" id="fUndergroundValvesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="UndergroundValves">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($UndergroundValves_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($UndergroundValves_delete->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
		<th class="<?php echo $UndergroundValves_delete->UndergroundValve_Idn->headerCellClass() ?>"><span id="elh_UndergroundValves_UndergroundValve_Idn" class="UndergroundValves_UndergroundValve_Idn"><?php echo $UndergroundValves_delete->UndergroundValve_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($UndergroundValves_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $UndergroundValves_delete->Name->headerCellClass() ?>"><span id="elh_UndergroundValves_Name" class="UndergroundValves_Name"><?php echo $UndergroundValves_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($UndergroundValves_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $UndergroundValves_delete->Rank->headerCellClass() ?>"><span id="elh_UndergroundValves_Rank" class="UndergroundValves_Rank"><?php echo $UndergroundValves_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($UndergroundValves_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $UndergroundValves_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_UndergroundValves_ActiveFlag" class="UndergroundValves_ActiveFlag"><?php echo $UndergroundValves_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$UndergroundValves_delete->RecordCount = 0;
$i = 0;
while (!$UndergroundValves_delete->Recordset->EOF) {
	$UndergroundValves_delete->RecordCount++;
	$UndergroundValves_delete->RowCount++;

	// Set row properties
	$UndergroundValves->resetAttributes();
	$UndergroundValves->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$UndergroundValves_delete->loadRowValues($UndergroundValves_delete->Recordset);

	// Render row
	$UndergroundValves_delete->renderRow();
?>
	<tr <?php echo $UndergroundValves->rowAttributes() ?>>
<?php if ($UndergroundValves_delete->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
		<td <?php echo $UndergroundValves_delete->UndergroundValve_Idn->cellAttributes() ?>>
<span id="el<?php echo $UndergroundValves_delete->RowCount ?>_UndergroundValves_UndergroundValve_Idn" class="UndergroundValves_UndergroundValve_Idn">
<span<?php echo $UndergroundValves_delete->UndergroundValve_Idn->viewAttributes() ?>><?php echo $UndergroundValves_delete->UndergroundValve_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($UndergroundValves_delete->Name->Visible) { // Name ?>
		<td <?php echo $UndergroundValves_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $UndergroundValves_delete->RowCount ?>_UndergroundValves_Name" class="UndergroundValves_Name">
<span<?php echo $UndergroundValves_delete->Name->viewAttributes() ?>><?php echo $UndergroundValves_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($UndergroundValves_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $UndergroundValves_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $UndergroundValves_delete->RowCount ?>_UndergroundValves_Rank" class="UndergroundValves_Rank">
<span<?php echo $UndergroundValves_delete->Rank->viewAttributes() ?>><?php echo $UndergroundValves_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($UndergroundValves_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $UndergroundValves_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $UndergroundValves_delete->RowCount ?>_UndergroundValves_ActiveFlag" class="UndergroundValves_ActiveFlag">
<span<?php echo $UndergroundValves_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $UndergroundValves_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($UndergroundValves_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$UndergroundValves_delete->Recordset->moveNext();
}
$UndergroundValves_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $UndergroundValves_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$UndergroundValves_delete->showPageFooter();
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
$UndergroundValves_delete->terminate();
?>