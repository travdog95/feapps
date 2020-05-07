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
$ShopFabricationMultipliers_delete = new ShopFabricationMultipliers_delete();

// Run the page
$ShopFabricationMultipliers_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ShopFabricationMultipliers_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fShopFabricationMultipliersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fShopFabricationMultipliersdelete = currentForm = new ew.Form("fShopFabricationMultipliersdelete", "delete");
	loadjs.done("fShopFabricationMultipliersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ShopFabricationMultipliers_delete->showPageHeader(); ?>
<?php
$ShopFabricationMultipliers_delete->showMessage();
?>
<form name="fShopFabricationMultipliersdelete" id="fShopFabricationMultipliersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ShopFabricationMultipliers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ShopFabricationMultipliers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ShopFabricationMultipliers_delete->ShopFabricationMultiplier_Idn->Visible) { // ShopFabricationMultiplier_Idn ?>
		<th class="<?php echo $ShopFabricationMultipliers_delete->ShopFabricationMultiplier_Idn->headerCellClass() ?>"><span id="elh_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn" class="ShopFabricationMultipliers_ShopFabricationMultiplier_Idn"><?php echo $ShopFabricationMultipliers_delete->ShopFabricationMultiplier_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($ShopFabricationMultipliers_delete->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<th class="<?php echo $ShopFabricationMultipliers_delete->PipeType_Idn->headerCellClass() ?>"><span id="elh_ShopFabricationMultipliers_PipeType_Idn" class="ShopFabricationMultipliers_PipeType_Idn"><?php echo $ShopFabricationMultipliers_delete->PipeType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($ShopFabricationMultipliers_delete->Multiplier->Visible) { // Multiplier ?>
		<th class="<?php echo $ShopFabricationMultipliers_delete->Multiplier->headerCellClass() ?>"><span id="elh_ShopFabricationMultipliers_Multiplier" class="ShopFabricationMultipliers_Multiplier"><?php echo $ShopFabricationMultipliers_delete->Multiplier->caption() ?></span></th>
<?php } ?>
<?php if ($ShopFabricationMultipliers_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $ShopFabricationMultipliers_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_ShopFabricationMultipliers_ActiveFlag" class="ShopFabricationMultipliers_ActiveFlag"><?php echo $ShopFabricationMultipliers_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ShopFabricationMultipliers_delete->RecordCount = 0;
$i = 0;
while (!$ShopFabricationMultipliers_delete->Recordset->EOF) {
	$ShopFabricationMultipliers_delete->RecordCount++;
	$ShopFabricationMultipliers_delete->RowCount++;

	// Set row properties
	$ShopFabricationMultipliers->resetAttributes();
	$ShopFabricationMultipliers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ShopFabricationMultipliers_delete->loadRowValues($ShopFabricationMultipliers_delete->Recordset);

	// Render row
	$ShopFabricationMultipliers_delete->renderRow();
?>
	<tr <?php echo $ShopFabricationMultipliers->rowAttributes() ?>>
<?php if ($ShopFabricationMultipliers_delete->ShopFabricationMultiplier_Idn->Visible) { // ShopFabricationMultiplier_Idn ?>
		<td <?php echo $ShopFabricationMultipliers_delete->ShopFabricationMultiplier_Idn->cellAttributes() ?>>
<span id="el<?php echo $ShopFabricationMultipliers_delete->RowCount ?>_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn" class="ShopFabricationMultipliers_ShopFabricationMultiplier_Idn">
<span<?php echo $ShopFabricationMultipliers_delete->ShopFabricationMultiplier_Idn->viewAttributes() ?>><?php echo $ShopFabricationMultipliers_delete->ShopFabricationMultiplier_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ShopFabricationMultipliers_delete->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td <?php echo $ShopFabricationMultipliers_delete->PipeType_Idn->cellAttributes() ?>>
<span id="el<?php echo $ShopFabricationMultipliers_delete->RowCount ?>_ShopFabricationMultipliers_PipeType_Idn" class="ShopFabricationMultipliers_PipeType_Idn">
<span<?php echo $ShopFabricationMultipliers_delete->PipeType_Idn->viewAttributes() ?>><?php echo $ShopFabricationMultipliers_delete->PipeType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ShopFabricationMultipliers_delete->Multiplier->Visible) { // Multiplier ?>
		<td <?php echo $ShopFabricationMultipliers_delete->Multiplier->cellAttributes() ?>>
<span id="el<?php echo $ShopFabricationMultipliers_delete->RowCount ?>_ShopFabricationMultipliers_Multiplier" class="ShopFabricationMultipliers_Multiplier">
<span<?php echo $ShopFabricationMultipliers_delete->Multiplier->viewAttributes() ?>><?php echo $ShopFabricationMultipliers_delete->Multiplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ShopFabricationMultipliers_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $ShopFabricationMultipliers_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $ShopFabricationMultipliers_delete->RowCount ?>_ShopFabricationMultipliers_ActiveFlag" class="ShopFabricationMultipliers_ActiveFlag">
<span<?php echo $ShopFabricationMultipliers_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ShopFabricationMultipliers_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ShopFabricationMultipliers_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ShopFabricationMultipliers_delete->Recordset->moveNext();
}
$ShopFabricationMultipliers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ShopFabricationMultipliers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ShopFabricationMultipliers_delete->showPageFooter();
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
$ShopFabricationMultipliers_delete->terminate();
?>