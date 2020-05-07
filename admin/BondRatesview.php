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
$BondRates_view = new BondRates_view();

// Run the page
$BondRates_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$BondRates_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$BondRates_view->isExport()) { ?>
<script>
var fBondRatesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fBondRatesview = currentForm = new ew.Form("fBondRatesview", "view");
	loadjs.done("fBondRatesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$BondRates_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $BondRates_view->ExportOptions->render("body") ?>
<?php $BondRates_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $BondRates_view->showPageHeader(); ?>
<?php
$BondRates_view->showMessage();
?>
<?php if (!$BondRates_view->IsModal) { ?>
<?php if (!$BondRates_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $BondRates_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fBondRatesview" id="fBondRatesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="BondRates">
<input type="hidden" name="modal" value="<?php echo (int)$BondRates_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($BondRates_view->BondRate_Idn->Visible) { // BondRate_Idn ?>
	<tr id="r_BondRate_Idn">
		<td class="<?php echo $BondRates_view->TableLeftColumnClass ?>"><span id="elh_BondRates_BondRate_Idn"><?php echo $BondRates_view->BondRate_Idn->caption() ?></span></td>
		<td data-name="BondRate_Idn" <?php echo $BondRates_view->BondRate_Idn->cellAttributes() ?>>
<span id="el_BondRates_BondRate_Idn">
<span<?php echo $BondRates_view->BondRate_Idn->viewAttributes() ?>><?php echo $BondRates_view->BondRate_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BondRates_view->StartValue->Visible) { // StartValue ?>
	<tr id="r_StartValue">
		<td class="<?php echo $BondRates_view->TableLeftColumnClass ?>"><span id="elh_BondRates_StartValue"><?php echo $BondRates_view->StartValue->caption() ?></span></td>
		<td data-name="StartValue" <?php echo $BondRates_view->StartValue->cellAttributes() ?>>
<span id="el_BondRates_StartValue">
<span<?php echo $BondRates_view->StartValue->viewAttributes() ?>><?php echo $BondRates_view->StartValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BondRates_view->EndValue->Visible) { // EndValue ?>
	<tr id="r_EndValue">
		<td class="<?php echo $BondRates_view->TableLeftColumnClass ?>"><span id="elh_BondRates_EndValue"><?php echo $BondRates_view->EndValue->caption() ?></span></td>
		<td data-name="EndValue" <?php echo $BondRates_view->EndValue->cellAttributes() ?>>
<span id="el_BondRates_EndValue">
<span<?php echo $BondRates_view->EndValue->viewAttributes() ?>><?php echo $BondRates_view->EndValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BondRates_view->Minimum->Visible) { // Minimum ?>
	<tr id="r_Minimum">
		<td class="<?php echo $BondRates_view->TableLeftColumnClass ?>"><span id="elh_BondRates_Minimum"><?php echo $BondRates_view->Minimum->caption() ?></span></td>
		<td data-name="Minimum" <?php echo $BondRates_view->Minimum->cellAttributes() ?>>
<span id="el_BondRates_Minimum">
<span<?php echo $BondRates_view->Minimum->viewAttributes() ?>><?php echo $BondRates_view->Minimum->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BondRates_view->Rate->Visible) { // Rate ?>
	<tr id="r_Rate">
		<td class="<?php echo $BondRates_view->TableLeftColumnClass ?>"><span id="elh_BondRates_Rate"><?php echo $BondRates_view->Rate->caption() ?></span></td>
		<td data-name="Rate" <?php echo $BondRates_view->Rate->cellAttributes() ?>>
<span id="el_BondRates_Rate">
<span<?php echo $BondRates_view->Rate->viewAttributes() ?>><?php echo $BondRates_view->Rate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BondRates_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $BondRates_view->TableLeftColumnClass ?>"><span id="elh_BondRates_Rank"><?php echo $BondRates_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $BondRates_view->Rank->cellAttributes() ?>>
<span id="el_BondRates_Rank">
<span<?php echo $BondRates_view->Rank->viewAttributes() ?>><?php echo $BondRates_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BondRates_view->IsSubcontract->Visible) { // IsSubcontract ?>
	<tr id="r_IsSubcontract">
		<td class="<?php echo $BondRates_view->TableLeftColumnClass ?>"><span id="elh_BondRates_IsSubcontract"><?php echo $BondRates_view->IsSubcontract->caption() ?></span></td>
		<td data-name="IsSubcontract" <?php echo $BondRates_view->IsSubcontract->cellAttributes() ?>>
<span id="el_BondRates_IsSubcontract">
<span<?php echo $BondRates_view->IsSubcontract->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsSubcontract" class="custom-control-input" value="<?php echo $BondRates_view->IsSubcontract->getViewValue() ?>" disabled<?php if (ConvertToBool($BondRates_view->IsSubcontract->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsSubcontract"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BondRates_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $BondRates_view->TableLeftColumnClass ?>"><span id="elh_BondRates_ActiveFlag"><?php echo $BondRates_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $BondRates_view->ActiveFlag->cellAttributes() ?>>
<span id="el_BondRates_ActiveFlag">
<span<?php echo $BondRates_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $BondRates_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($BondRates_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$BondRates_view->IsModal) { ?>
<?php if (!$BondRates_view->isExport()) { ?>
<?php echo $BondRates_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$BondRates_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$BondRates_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$BondRates_view->terminate();
?>