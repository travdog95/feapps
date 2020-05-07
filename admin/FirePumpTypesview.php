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
$FirePumpTypes_view = new FirePumpTypes_view();

// Run the page
$FirePumpTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FirePumpTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$FirePumpTypes_view->isExport()) { ?>
<script>
var fFirePumpTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fFirePumpTypesview = currentForm = new ew.Form("fFirePumpTypesview", "view");
	loadjs.done("fFirePumpTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$FirePumpTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $FirePumpTypes_view->ExportOptions->render("body") ?>
<?php $FirePumpTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $FirePumpTypes_view->showPageHeader(); ?>
<?php
$FirePumpTypes_view->showMessage();
?>
<?php if (!$FirePumpTypes_view->IsModal) { ?>
<?php if (!$FirePumpTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FirePumpTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fFirePumpTypesview" id="fFirePumpTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FirePumpTypes">
<input type="hidden" name="modal" value="<?php echo (int)$FirePumpTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($FirePumpTypes_view->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
	<tr id="r_FirePumpType_Idn">
		<td class="<?php echo $FirePumpTypes_view->TableLeftColumnClass ?>"><span id="elh_FirePumpTypes_FirePumpType_Idn"><?php echo $FirePumpTypes_view->FirePumpType_Idn->caption() ?></span></td>
		<td data-name="FirePumpType_Idn" <?php echo $FirePumpTypes_view->FirePumpType_Idn->cellAttributes() ?>>
<span id="el_FirePumpTypes_FirePumpType_Idn">
<span<?php echo $FirePumpTypes_view->FirePumpType_Idn->viewAttributes() ?>><?php echo $FirePumpTypes_view->FirePumpType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FirePumpTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $FirePumpTypes_view->TableLeftColumnClass ?>"><span id="elh_FirePumpTypes_Name"><?php echo $FirePumpTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $FirePumpTypes_view->Name->cellAttributes() ?>>
<span id="el_FirePumpTypes_Name">
<span<?php echo $FirePumpTypes_view->Name->viewAttributes() ?>><?php echo $FirePumpTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FirePumpTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $FirePumpTypes_view->TableLeftColumnClass ?>"><span id="elh_FirePumpTypes_Rank"><?php echo $FirePumpTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $FirePumpTypes_view->Rank->cellAttributes() ?>>
<span id="el_FirePumpTypes_Rank">
<span<?php echo $FirePumpTypes_view->Rank->viewAttributes() ?>><?php echo $FirePumpTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FirePumpTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $FirePumpTypes_view->TableLeftColumnClass ?>"><span id="elh_FirePumpTypes_ActiveFlag"><?php echo $FirePumpTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $FirePumpTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_FirePumpTypes_ActiveFlag">
<span<?php echo $FirePumpTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FirePumpTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FirePumpTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$FirePumpTypes_view->IsModal) { ?>
<?php if (!$FirePumpTypes_view->isExport()) { ?>
<?php echo $FirePumpTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$FirePumpTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$FirePumpTypes_view->isExport()) { ?>
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
$FirePumpTypes_view->terminate();
?>