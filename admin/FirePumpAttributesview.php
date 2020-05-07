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
$FirePumpAttributes_view = new FirePumpAttributes_view();

// Run the page
$FirePumpAttributes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FirePumpAttributes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$FirePumpAttributes_view->isExport()) { ?>
<script>
var fFirePumpAttributesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fFirePumpAttributesview = currentForm = new ew.Form("fFirePumpAttributesview", "view");
	loadjs.done("fFirePumpAttributesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$FirePumpAttributes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $FirePumpAttributes_view->ExportOptions->render("body") ?>
<?php $FirePumpAttributes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $FirePumpAttributes_view->showPageHeader(); ?>
<?php
$FirePumpAttributes_view->showMessage();
?>
<?php if (!$FirePumpAttributes_view->IsModal) { ?>
<?php if (!$FirePumpAttributes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FirePumpAttributes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fFirePumpAttributesview" id="fFirePumpAttributesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FirePumpAttributes">
<input type="hidden" name="modal" value="<?php echo (int)$FirePumpAttributes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($FirePumpAttributes_view->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
	<tr id="r_FirePumpAttribute_Idn">
		<td class="<?php echo $FirePumpAttributes_view->TableLeftColumnClass ?>"><span id="elh_FirePumpAttributes_FirePumpAttribute_Idn"><?php echo $FirePumpAttributes_view->FirePumpAttribute_Idn->caption() ?></span></td>
		<td data-name="FirePumpAttribute_Idn" <?php echo $FirePumpAttributes_view->FirePumpAttribute_Idn->cellAttributes() ?>>
<span id="el_FirePumpAttributes_FirePumpAttribute_Idn">
<span<?php echo $FirePumpAttributes_view->FirePumpAttribute_Idn->viewAttributes() ?>><?php echo $FirePumpAttributes_view->FirePumpAttribute_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FirePumpAttributes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $FirePumpAttributes_view->TableLeftColumnClass ?>"><span id="elh_FirePumpAttributes_Name"><?php echo $FirePumpAttributes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $FirePumpAttributes_view->Name->cellAttributes() ?>>
<span id="el_FirePumpAttributes_Name">
<span<?php echo $FirePumpAttributes_view->Name->viewAttributes() ?>><?php echo $FirePumpAttributes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FirePumpAttributes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $FirePumpAttributes_view->TableLeftColumnClass ?>"><span id="elh_FirePumpAttributes_Rank"><?php echo $FirePumpAttributes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $FirePumpAttributes_view->Rank->cellAttributes() ?>>
<span id="el_FirePumpAttributes_Rank">
<span<?php echo $FirePumpAttributes_view->Rank->viewAttributes() ?>><?php echo $FirePumpAttributes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FirePumpAttributes_view->DefaultFlag->Visible) { // DefaultFlag ?>
	<tr id="r_DefaultFlag">
		<td class="<?php echo $FirePumpAttributes_view->TableLeftColumnClass ?>"><span id="elh_FirePumpAttributes_DefaultFlag"><?php echo $FirePumpAttributes_view->DefaultFlag->caption() ?></span></td>
		<td data-name="DefaultFlag" <?php echo $FirePumpAttributes_view->DefaultFlag->cellAttributes() ?>>
<span id="el_FirePumpAttributes_DefaultFlag">
<span<?php echo $FirePumpAttributes_view->DefaultFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DefaultFlag" class="custom-control-input" value="<?php echo $FirePumpAttributes_view->DefaultFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FirePumpAttributes_view->DefaultFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DefaultFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FirePumpAttributes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $FirePumpAttributes_view->TableLeftColumnClass ?>"><span id="elh_FirePumpAttributes_ActiveFlag"><?php echo $FirePumpAttributes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $FirePumpAttributes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_FirePumpAttributes_ActiveFlag">
<span<?php echo $FirePumpAttributes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FirePumpAttributes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FirePumpAttributes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$FirePumpAttributes_view->IsModal) { ?>
<?php if (!$FirePumpAttributes_view->isExport()) { ?>
<?php echo $FirePumpAttributes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$FirePumpAttributes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$FirePumpAttributes_view->isExport()) { ?>
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
$FirePumpAttributes_view->terminate();
?>