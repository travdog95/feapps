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
$Manufacturers_view = new Manufacturers_view();

// Run the page
$Manufacturers_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Manufacturers_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Manufacturers_view->isExport()) { ?>
<script>
var fManufacturersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fManufacturersview = currentForm = new ew.Form("fManufacturersview", "view");
	loadjs.done("fManufacturersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Manufacturers_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Manufacturers_view->ExportOptions->render("body") ?>
<?php $Manufacturers_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Manufacturers_view->showPageHeader(); ?>
<?php
$Manufacturers_view->showMessage();
?>
<?php if (!$Manufacturers_view->IsModal) { ?>
<?php if (!$Manufacturers_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Manufacturers_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fManufacturersview" id="fManufacturersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Manufacturers">
<input type="hidden" name="modal" value="<?php echo (int)$Manufacturers_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Manufacturers_view->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
	<tr id="r_Manufacturer_Idn">
		<td class="<?php echo $Manufacturers_view->TableLeftColumnClass ?>"><span id="elh_Manufacturers_Manufacturer_Idn"><?php echo $Manufacturers_view->Manufacturer_Idn->caption() ?></span></td>
		<td data-name="Manufacturer_Idn" <?php echo $Manufacturers_view->Manufacturer_Idn->cellAttributes() ?>>
<span id="el_Manufacturers_Manufacturer_Idn">
<span<?php echo $Manufacturers_view->Manufacturer_Idn->viewAttributes() ?>><?php echo $Manufacturers_view->Manufacturer_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Manufacturers_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $Manufacturers_view->TableLeftColumnClass ?>"><span id="elh_Manufacturers_Name"><?php echo $Manufacturers_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $Manufacturers_view->Name->cellAttributes() ?>>
<span id="el_Manufacturers_Name">
<span<?php echo $Manufacturers_view->Name->viewAttributes() ?>><?php echo $Manufacturers_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Manufacturers_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $Manufacturers_view->TableLeftColumnClass ?>"><span id="elh_Manufacturers_ActiveFlag"><?php echo $Manufacturers_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $Manufacturers_view->ActiveFlag->cellAttributes() ?>>
<span id="el_Manufacturers_ActiveFlag">
<span<?php echo $Manufacturers_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Manufacturers_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Manufacturers_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$Manufacturers_view->IsModal) { ?>
<?php if (!$Manufacturers_view->isExport()) { ?>
<?php echo $Manufacturers_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$Manufacturers_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Manufacturers_view->isExport()) { ?>
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
$Manufacturers_view->terminate();
?>