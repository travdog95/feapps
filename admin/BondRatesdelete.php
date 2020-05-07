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
$BondRates_delete = new BondRates_delete();

// Run the page
$BondRates_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$BondRates_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fBondRatesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fBondRatesdelete = currentForm = new ew.Form("fBondRatesdelete", "delete");
	loadjs.done("fBondRatesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $BondRates_delete->showPageHeader(); ?>
<?php
$BondRates_delete->showMessage();
?>
<form name="fBondRatesdelete" id="fBondRatesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="BondRates">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($BondRates_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($BondRates_delete->BondRate_Idn->Visible) { // BondRate_Idn ?>
		<th class="<?php echo $BondRates_delete->BondRate_Idn->headerCellClass() ?>"><span id="elh_BondRates_BondRate_Idn" class="BondRates_BondRate_Idn"><?php echo $BondRates_delete->BondRate_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($BondRates_delete->StartValue->Visible) { // StartValue ?>
		<th class="<?php echo $BondRates_delete->StartValue->headerCellClass() ?>"><span id="elh_BondRates_StartValue" class="BondRates_StartValue"><?php echo $BondRates_delete->StartValue->caption() ?></span></th>
<?php } ?>
<?php if ($BondRates_delete->EndValue->Visible) { // EndValue ?>
		<th class="<?php echo $BondRates_delete->EndValue->headerCellClass() ?>"><span id="elh_BondRates_EndValue" class="BondRates_EndValue"><?php echo $BondRates_delete->EndValue->caption() ?></span></th>
<?php } ?>
<?php if ($BondRates_delete->Minimum->Visible) { // Minimum ?>
		<th class="<?php echo $BondRates_delete->Minimum->headerCellClass() ?>"><span id="elh_BondRates_Minimum" class="BondRates_Minimum"><?php echo $BondRates_delete->Minimum->caption() ?></span></th>
<?php } ?>
<?php if ($BondRates_delete->Rate->Visible) { // Rate ?>
		<th class="<?php echo $BondRates_delete->Rate->headerCellClass() ?>"><span id="elh_BondRates_Rate" class="BondRates_Rate"><?php echo $BondRates_delete->Rate->caption() ?></span></th>
<?php } ?>
<?php if ($BondRates_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $BondRates_delete->Rank->headerCellClass() ?>"><span id="elh_BondRates_Rank" class="BondRates_Rank"><?php echo $BondRates_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($BondRates_delete->IsSubcontract->Visible) { // IsSubcontract ?>
		<th class="<?php echo $BondRates_delete->IsSubcontract->headerCellClass() ?>"><span id="elh_BondRates_IsSubcontract" class="BondRates_IsSubcontract"><?php echo $BondRates_delete->IsSubcontract->caption() ?></span></th>
<?php } ?>
<?php if ($BondRates_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $BondRates_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_BondRates_ActiveFlag" class="BondRates_ActiveFlag"><?php echo $BondRates_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$BondRates_delete->RecordCount = 0;
$i = 0;
while (!$BondRates_delete->Recordset->EOF) {
	$BondRates_delete->RecordCount++;
	$BondRates_delete->RowCount++;

	// Set row properties
	$BondRates->resetAttributes();
	$BondRates->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$BondRates_delete->loadRowValues($BondRates_delete->Recordset);

	// Render row
	$BondRates_delete->renderRow();
?>
	<tr <?php echo $BondRates->rowAttributes() ?>>
<?php if ($BondRates_delete->BondRate_Idn->Visible) { // BondRate_Idn ?>
		<td <?php echo $BondRates_delete->BondRate_Idn->cellAttributes() ?>>
<span id="el<?php echo $BondRates_delete->RowCount ?>_BondRates_BondRate_Idn" class="BondRates_BondRate_Idn">
<span<?php echo $BondRates_delete->BondRate_Idn->viewAttributes() ?>><?php echo $BondRates_delete->BondRate_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BondRates_delete->StartValue->Visible) { // StartValue ?>
		<td <?php echo $BondRates_delete->StartValue->cellAttributes() ?>>
<span id="el<?php echo $BondRates_delete->RowCount ?>_BondRates_StartValue" class="BondRates_StartValue">
<span<?php echo $BondRates_delete->StartValue->viewAttributes() ?>><?php echo $BondRates_delete->StartValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BondRates_delete->EndValue->Visible) { // EndValue ?>
		<td <?php echo $BondRates_delete->EndValue->cellAttributes() ?>>
<span id="el<?php echo $BondRates_delete->RowCount ?>_BondRates_EndValue" class="BondRates_EndValue">
<span<?php echo $BondRates_delete->EndValue->viewAttributes() ?>><?php echo $BondRates_delete->EndValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BondRates_delete->Minimum->Visible) { // Minimum ?>
		<td <?php echo $BondRates_delete->Minimum->cellAttributes() ?>>
<span id="el<?php echo $BondRates_delete->RowCount ?>_BondRates_Minimum" class="BondRates_Minimum">
<span<?php echo $BondRates_delete->Minimum->viewAttributes() ?>><?php echo $BondRates_delete->Minimum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BondRates_delete->Rate->Visible) { // Rate ?>
		<td <?php echo $BondRates_delete->Rate->cellAttributes() ?>>
<span id="el<?php echo $BondRates_delete->RowCount ?>_BondRates_Rate" class="BondRates_Rate">
<span<?php echo $BondRates_delete->Rate->viewAttributes() ?>><?php echo $BondRates_delete->Rate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BondRates_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $BondRates_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $BondRates_delete->RowCount ?>_BondRates_Rank" class="BondRates_Rank">
<span<?php echo $BondRates_delete->Rank->viewAttributes() ?>><?php echo $BondRates_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BondRates_delete->IsSubcontract->Visible) { // IsSubcontract ?>
		<td <?php echo $BondRates_delete->IsSubcontract->cellAttributes() ?>>
<span id="el<?php echo $BondRates_delete->RowCount ?>_BondRates_IsSubcontract" class="BondRates_IsSubcontract">
<span<?php echo $BondRates_delete->IsSubcontract->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsSubcontract" class="custom-control-input" value="<?php echo $BondRates_delete->IsSubcontract->getViewValue() ?>" disabled<?php if (ConvertToBool($BondRates_delete->IsSubcontract->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsSubcontract"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($BondRates_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $BondRates_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $BondRates_delete->RowCount ?>_BondRates_ActiveFlag" class="BondRates_ActiveFlag">
<span<?php echo $BondRates_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $BondRates_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($BondRates_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$BondRates_delete->Recordset->moveNext();
}
$BondRates_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $BondRates_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$BondRates_delete->showPageFooter();
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
$BondRates_delete->terminate();
?>