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
$PressureTypes_delete = new PressureTypes_delete();

// Run the page
$PressureTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PressureTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPressureTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fPressureTypesdelete = currentForm = new ew.Form("fPressureTypesdelete", "delete");
	loadjs.done("fPressureTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $PressureTypes_delete->showPageHeader(); ?>
<?php
$PressureTypes_delete->showMessage();
?>
<form name="fPressureTypesdelete" id="fPressureTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PressureTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($PressureTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($PressureTypes_delete->PressureType_Idn->Visible) { // PressureType_Idn ?>
		<th class="<?php echo $PressureTypes_delete->PressureType_Idn->headerCellClass() ?>"><span id="elh_PressureTypes_PressureType_Idn" class="PressureTypes_PressureType_Idn"><?php echo $PressureTypes_delete->PressureType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($PressureTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $PressureTypes_delete->Name->headerCellClass() ?>"><span id="elh_PressureTypes_Name" class="PressureTypes_Name"><?php echo $PressureTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($PressureTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $PressureTypes_delete->Rank->headerCellClass() ?>"><span id="elh_PressureTypes_Rank" class="PressureTypes_Rank"><?php echo $PressureTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($PressureTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $PressureTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_PressureTypes_ActiveFlag" class="PressureTypes_ActiveFlag"><?php echo $PressureTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$PressureTypes_delete->RecordCount = 0;
$i = 0;
while (!$PressureTypes_delete->Recordset->EOF) {
	$PressureTypes_delete->RecordCount++;
	$PressureTypes_delete->RowCount++;

	// Set row properties
	$PressureTypes->resetAttributes();
	$PressureTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$PressureTypes_delete->loadRowValues($PressureTypes_delete->Recordset);

	// Render row
	$PressureTypes_delete->renderRow();
?>
	<tr <?php echo $PressureTypes->rowAttributes() ?>>
<?php if ($PressureTypes_delete->PressureType_Idn->Visible) { // PressureType_Idn ?>
		<td <?php echo $PressureTypes_delete->PressureType_Idn->cellAttributes() ?>>
<span id="el<?php echo $PressureTypes_delete->RowCount ?>_PressureTypes_PressureType_Idn" class="PressureTypes_PressureType_Idn">
<span<?php echo $PressureTypes_delete->PressureType_Idn->viewAttributes() ?>><?php echo $PressureTypes_delete->PressureType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PressureTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $PressureTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $PressureTypes_delete->RowCount ?>_PressureTypes_Name" class="PressureTypes_Name">
<span<?php echo $PressureTypes_delete->Name->viewAttributes() ?>><?php echo $PressureTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PressureTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $PressureTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $PressureTypes_delete->RowCount ?>_PressureTypes_Rank" class="PressureTypes_Rank">
<span<?php echo $PressureTypes_delete->Rank->viewAttributes() ?>><?php echo $PressureTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PressureTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $PressureTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $PressureTypes_delete->RowCount ?>_PressureTypes_ActiveFlag" class="PressureTypes_ActiveFlag">
<span<?php echo $PressureTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PressureTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PressureTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$PressureTypes_delete->Recordset->moveNext();
}
$PressureTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $PressureTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$PressureTypes_delete->showPageFooter();
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
$PressureTypes_delete->terminate();
?>