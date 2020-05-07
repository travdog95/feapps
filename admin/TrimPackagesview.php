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
$TrimPackages_view = new TrimPackages_view();

// Run the page
$TrimPackages_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TrimPackages_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$TrimPackages_view->isExport()) { ?>
<script>
var fTrimPackagesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fTrimPackagesview = currentForm = new ew.Form("fTrimPackagesview", "view");
	loadjs.done("fTrimPackagesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$TrimPackages_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $TrimPackages_view->ExportOptions->render("body") ?>
<?php $TrimPackages_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $TrimPackages_view->showPageHeader(); ?>
<?php
$TrimPackages_view->showMessage();
?>
<?php if (!$TrimPackages_view->IsModal) { ?>
<?php if (!$TrimPackages_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $TrimPackages_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fTrimPackagesview" id="fTrimPackagesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TrimPackages">
<input type="hidden" name="modal" value="<?php echo (int)$TrimPackages_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($TrimPackages_view->TrimPackage_Idn->Visible) { // TrimPackage_Idn ?>
	<tr id="r_TrimPackage_Idn">
		<td class="<?php echo $TrimPackages_view->TableLeftColumnClass ?>"><span id="elh_TrimPackages_TrimPackage_Idn"><?php echo $TrimPackages_view->TrimPackage_Idn->caption() ?></span></td>
		<td data-name="TrimPackage_Idn" <?php echo $TrimPackages_view->TrimPackage_Idn->cellAttributes() ?>>
<span id="el_TrimPackages_TrimPackage_Idn">
<span<?php echo $TrimPackages_view->TrimPackage_Idn->viewAttributes() ?>><?php echo $TrimPackages_view->TrimPackage_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($TrimPackages_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $TrimPackages_view->TableLeftColumnClass ?>"><span id="elh_TrimPackages_Name"><?php echo $TrimPackages_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $TrimPackages_view->Name->cellAttributes() ?>>
<span id="el_TrimPackages_Name">
<span<?php echo $TrimPackages_view->Name->viewAttributes() ?>><?php echo $TrimPackages_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($TrimPackages_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $TrimPackages_view->TableLeftColumnClass ?>"><span id="elh_TrimPackages_Rank"><?php echo $TrimPackages_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $TrimPackages_view->Rank->cellAttributes() ?>>
<span id="el_TrimPackages_Rank">
<span<?php echo $TrimPackages_view->Rank->viewAttributes() ?>><?php echo $TrimPackages_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($TrimPackages_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $TrimPackages_view->TableLeftColumnClass ?>"><span id="elh_TrimPackages_ActiveFlag"><?php echo $TrimPackages_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $TrimPackages_view->ActiveFlag->cellAttributes() ?>>
<span id="el_TrimPackages_ActiveFlag">
<span<?php echo $TrimPackages_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $TrimPackages_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($TrimPackages_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$TrimPackages_view->IsModal) { ?>
<?php if (!$TrimPackages_view->isExport()) { ?>
<?php echo $TrimPackages_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$TrimPackages_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$TrimPackages_view->isExport()) { ?>
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
$TrimPackages_view->terminate();
?>