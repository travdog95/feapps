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
$TappingTees_delete = new TappingTees_delete();

// Run the page
$TappingTees_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TappingTees_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fTappingTeesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fTappingTeesdelete = currentForm = new ew.Form("fTappingTeesdelete", "delete");
	loadjs.done("fTappingTeesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $TappingTees_delete->showPageHeader(); ?>
<?php
$TappingTees_delete->showMessage();
?>
<form name="fTappingTeesdelete" id="fTappingTeesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TappingTees">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($TappingTees_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($TappingTees_delete->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
		<th class="<?php echo $TappingTees_delete->TappingTee_Idn->headerCellClass() ?>"><span id="elh_TappingTees_TappingTee_Idn" class="TappingTees_TappingTee_Idn"><?php echo $TappingTees_delete->TappingTee_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($TappingTees_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $TappingTees_delete->Name->headerCellClass() ?>"><span id="elh_TappingTees_Name" class="TappingTees_Name"><?php echo $TappingTees_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($TappingTees_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $TappingTees_delete->Rank->headerCellClass() ?>"><span id="elh_TappingTees_Rank" class="TappingTees_Rank"><?php echo $TappingTees_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($TappingTees_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $TappingTees_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_TappingTees_ActiveFlag" class="TappingTees_ActiveFlag"><?php echo $TappingTees_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$TappingTees_delete->RecordCount = 0;
$i = 0;
while (!$TappingTees_delete->Recordset->EOF) {
	$TappingTees_delete->RecordCount++;
	$TappingTees_delete->RowCount++;

	// Set row properties
	$TappingTees->resetAttributes();
	$TappingTees->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$TappingTees_delete->loadRowValues($TappingTees_delete->Recordset);

	// Render row
	$TappingTees_delete->renderRow();
?>
	<tr <?php echo $TappingTees->rowAttributes() ?>>
<?php if ($TappingTees_delete->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
		<td <?php echo $TappingTees_delete->TappingTee_Idn->cellAttributes() ?>>
<span id="el<?php echo $TappingTees_delete->RowCount ?>_TappingTees_TappingTee_Idn" class="TappingTees_TappingTee_Idn">
<span<?php echo $TappingTees_delete->TappingTee_Idn->viewAttributes() ?>><?php echo $TappingTees_delete->TappingTee_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($TappingTees_delete->Name->Visible) { // Name ?>
		<td <?php echo $TappingTees_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $TappingTees_delete->RowCount ?>_TappingTees_Name" class="TappingTees_Name">
<span<?php echo $TappingTees_delete->Name->viewAttributes() ?>><?php echo $TappingTees_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($TappingTees_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $TappingTees_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $TappingTees_delete->RowCount ?>_TappingTees_Rank" class="TappingTees_Rank">
<span<?php echo $TappingTees_delete->Rank->viewAttributes() ?>><?php echo $TappingTees_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($TappingTees_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $TappingTees_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $TappingTees_delete->RowCount ?>_TappingTees_ActiveFlag" class="TappingTees_ActiveFlag">
<span<?php echo $TappingTees_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $TappingTees_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($TappingTees_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$TappingTees_delete->Recordset->moveNext();
}
$TappingTees_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $TappingTees_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$TappingTees_delete->showPageFooter();
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
$TappingTees_delete->terminate();
?>