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
$ShopFabricationMultipliers_view = new ShopFabricationMultipliers_view();

// Run the page
$ShopFabricationMultipliers_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ShopFabricationMultipliers_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ShopFabricationMultipliers_view->isExport()) { ?>
<script>
var fShopFabricationMultipliersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fShopFabricationMultipliersview = currentForm = new ew.Form("fShopFabricationMultipliersview", "view");
	loadjs.done("fShopFabricationMultipliersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ShopFabricationMultipliers_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ShopFabricationMultipliers_view->ExportOptions->render("body") ?>
<?php $ShopFabricationMultipliers_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ShopFabricationMultipliers_view->showPageHeader(); ?>
<?php
$ShopFabricationMultipliers_view->showMessage();
?>
<?php if (!$ShopFabricationMultipliers_view->IsModal) { ?>
<?php if (!$ShopFabricationMultipliers_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ShopFabricationMultipliers_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fShopFabricationMultipliersview" id="fShopFabricationMultipliersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ShopFabricationMultipliers">
<input type="hidden" name="modal" value="<?php echo (int)$ShopFabricationMultipliers_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ShopFabricationMultipliers_view->ShopFabricationMultiplier_Idn->Visible) { // ShopFabricationMultiplier_Idn ?>
	<tr id="r_ShopFabricationMultiplier_Idn">
		<td class="<?php echo $ShopFabricationMultipliers_view->TableLeftColumnClass ?>"><span id="elh_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn"><?php echo $ShopFabricationMultipliers_view->ShopFabricationMultiplier_Idn->caption() ?></span></td>
		<td data-name="ShopFabricationMultiplier_Idn" <?php echo $ShopFabricationMultipliers_view->ShopFabricationMultiplier_Idn->cellAttributes() ?>>
<span id="el_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn">
<span<?php echo $ShopFabricationMultipliers_view->ShopFabricationMultiplier_Idn->viewAttributes() ?>><?php echo $ShopFabricationMultipliers_view->ShopFabricationMultiplier_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ShopFabricationMultipliers_view->PipeType_Idn->Visible) { // PipeType_Idn ?>
	<tr id="r_PipeType_Idn">
		<td class="<?php echo $ShopFabricationMultipliers_view->TableLeftColumnClass ?>"><span id="elh_ShopFabricationMultipliers_PipeType_Idn"><?php echo $ShopFabricationMultipliers_view->PipeType_Idn->caption() ?></span></td>
		<td data-name="PipeType_Idn" <?php echo $ShopFabricationMultipliers_view->PipeType_Idn->cellAttributes() ?>>
<span id="el_ShopFabricationMultipliers_PipeType_Idn">
<span<?php echo $ShopFabricationMultipliers_view->PipeType_Idn->viewAttributes() ?>><?php echo $ShopFabricationMultipliers_view->PipeType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ShopFabricationMultipliers_view->Multiplier->Visible) { // Multiplier ?>
	<tr id="r_Multiplier">
		<td class="<?php echo $ShopFabricationMultipliers_view->TableLeftColumnClass ?>"><span id="elh_ShopFabricationMultipliers_Multiplier"><?php echo $ShopFabricationMultipliers_view->Multiplier->caption() ?></span></td>
		<td data-name="Multiplier" <?php echo $ShopFabricationMultipliers_view->Multiplier->cellAttributes() ?>>
<span id="el_ShopFabricationMultipliers_Multiplier">
<span<?php echo $ShopFabricationMultipliers_view->Multiplier->viewAttributes() ?>><?php echo $ShopFabricationMultipliers_view->Multiplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ShopFabricationMultipliers_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $ShopFabricationMultipliers_view->TableLeftColumnClass ?>"><span id="elh_ShopFabricationMultipliers_ActiveFlag"><?php echo $ShopFabricationMultipliers_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $ShopFabricationMultipliers_view->ActiveFlag->cellAttributes() ?>>
<span id="el_ShopFabricationMultipliers_ActiveFlag">
<span<?php echo $ShopFabricationMultipliers_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ShopFabricationMultipliers_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ShopFabricationMultipliers_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ShopFabricationMultipliers_view->IsModal) { ?>
<?php if (!$ShopFabricationMultipliers_view->isExport()) { ?>
<?php echo $ShopFabricationMultipliers_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ShopFabricationMultipliers_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ShopFabricationMultipliers_view->isExport()) { ?>
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
$ShopFabricationMultipliers_view->terminate();
?>