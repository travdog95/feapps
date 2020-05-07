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
$ShopFabrications_view = new ShopFabrications_view();

// Run the page
$ShopFabrications_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ShopFabrications_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ShopFabrications_view->isExport()) { ?>
<script>
var fShopFabricationsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fShopFabricationsview = currentForm = new ew.Form("fShopFabricationsview", "view");
	loadjs.done("fShopFabricationsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ShopFabrications_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ShopFabrications_view->ExportOptions->render("body") ?>
<?php $ShopFabrications_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ShopFabrications_view->showPageHeader(); ?>
<?php
$ShopFabrications_view->showMessage();
?>
<?php if (!$ShopFabrications_view->IsModal) { ?>
<?php if (!$ShopFabrications_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ShopFabrications_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fShopFabricationsview" id="fShopFabricationsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ShopFabrications">
<input type="hidden" name="modal" value="<?php echo (int)$ShopFabrications_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ShopFabrications_view->ShopFabrication_Idn->Visible) { // ShopFabrication_Idn ?>
	<tr id="r_ShopFabrication_Idn">
		<td class="<?php echo $ShopFabrications_view->TableLeftColumnClass ?>"><span id="elh_ShopFabrications_ShopFabrication_Idn"><?php echo $ShopFabrications_view->ShopFabrication_Idn->caption() ?></span></td>
		<td data-name="ShopFabrication_Idn" <?php echo $ShopFabrications_view->ShopFabrication_Idn->cellAttributes() ?>>
<span id="el_ShopFabrications_ShopFabrication_Idn">
<span<?php echo $ShopFabrications_view->ShopFabrication_Idn->viewAttributes() ?>><?php echo $ShopFabrications_view->ShopFabrication_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ShopFabrications_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $ShopFabrications_view->TableLeftColumnClass ?>"><span id="elh_ShopFabrications_Name"><?php echo $ShopFabrications_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $ShopFabrications_view->Name->cellAttributes() ?>>
<span id="el_ShopFabrications_Name">
<span<?php echo $ShopFabrications_view->Name->viewAttributes() ?>><?php echo $ShopFabrications_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ShopFabrications_view->Value->Visible) { // Value ?>
	<tr id="r_Value">
		<td class="<?php echo $ShopFabrications_view->TableLeftColumnClass ?>"><span id="elh_ShopFabrications_Value"><?php echo $ShopFabrications_view->Value->caption() ?></span></td>
		<td data-name="Value" <?php echo $ShopFabrications_view->Value->cellAttributes() ?>>
<span id="el_ShopFabrications_Value">
<span<?php echo $ShopFabrications_view->Value->viewAttributes() ?>><?php echo $ShopFabrications_view->Value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ShopFabrications_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $ShopFabrications_view->TableLeftColumnClass ?>"><span id="elh_ShopFabrications_Rank"><?php echo $ShopFabrications_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $ShopFabrications_view->Rank->cellAttributes() ?>>
<span id="el_ShopFabrications_Rank">
<span<?php echo $ShopFabrications_view->Rank->viewAttributes() ?>><?php echo $ShopFabrications_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ShopFabrications_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $ShopFabrications_view->TableLeftColumnClass ?>"><span id="elh_ShopFabrications_ActiveFlag"><?php echo $ShopFabrications_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $ShopFabrications_view->ActiveFlag->cellAttributes() ?>>
<span id="el_ShopFabrications_ActiveFlag">
<span<?php echo $ShopFabrications_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ShopFabrications_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ShopFabrications_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ShopFabrications_view->IsModal) { ?>
<?php if (!$ShopFabrications_view->isExport()) { ?>
<?php echo $ShopFabrications_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ShopFabrications_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ShopFabrications_view->isExport()) { ?>
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
$ShopFabrications_view->terminate();
?>