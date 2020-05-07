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
$Positions_delete = new Positions_delete();

// Run the page
$Positions_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Positions_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPositionsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fPositionsdelete = currentForm = new ew.Form("fPositionsdelete", "delete");
	loadjs.done("fPositionsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Positions_delete->showPageHeader(); ?>
<?php
$Positions_delete->showMessage();
?>
<form name="fPositionsdelete" id="fPositionsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Positions">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Positions_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Positions_delete->Position_Idn->Visible) { // Position_Idn ?>
		<th class="<?php echo $Positions_delete->Position_Idn->headerCellClass() ?>"><span id="elh_Positions_Position_Idn" class="Positions_Position_Idn"><?php echo $Positions_delete->Position_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Positions_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $Positions_delete->Name->headerCellClass() ?>"><span id="elh_Positions_Name" class="Positions_Name"><?php echo $Positions_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($Positions_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $Positions_delete->Rank->headerCellClass() ?>"><span id="elh_Positions_Rank" class="Positions_Rank"><?php echo $Positions_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($Positions_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $Positions_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_Positions_ActiveFlag" class="Positions_ActiveFlag"><?php echo $Positions_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Positions_delete->RecordCount = 0;
$i = 0;
while (!$Positions_delete->Recordset->EOF) {
	$Positions_delete->RecordCount++;
	$Positions_delete->RowCount++;

	// Set row properties
	$Positions->resetAttributes();
	$Positions->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Positions_delete->loadRowValues($Positions_delete->Recordset);

	// Render row
	$Positions_delete->renderRow();
?>
	<tr <?php echo $Positions->rowAttributes() ?>>
<?php if ($Positions_delete->Position_Idn->Visible) { // Position_Idn ?>
		<td <?php echo $Positions_delete->Position_Idn->cellAttributes() ?>>
<span id="el<?php echo $Positions_delete->RowCount ?>_Positions_Position_Idn" class="Positions_Position_Idn">
<span<?php echo $Positions_delete->Position_Idn->viewAttributes() ?>><?php echo $Positions_delete->Position_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Positions_delete->Name->Visible) { // Name ?>
		<td <?php echo $Positions_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $Positions_delete->RowCount ?>_Positions_Name" class="Positions_Name">
<span<?php echo $Positions_delete->Name->viewAttributes() ?>><?php echo $Positions_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Positions_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $Positions_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $Positions_delete->RowCount ?>_Positions_Rank" class="Positions_Rank">
<span<?php echo $Positions_delete->Rank->viewAttributes() ?>><?php echo $Positions_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Positions_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $Positions_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $Positions_delete->RowCount ?>_Positions_ActiveFlag" class="Positions_ActiveFlag">
<span<?php echo $Positions_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Positions_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Positions_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Positions_delete->Recordset->moveNext();
}
$Positions_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Positions_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Positions_delete->showPageFooter();
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
$Positions_delete->terminate();
?>