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
$MenuTypes_view = new MenuTypes_view();

// Run the page
$MenuTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$MenuTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$MenuTypes_view->isExport()) { ?>
<script>
var fMenuTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fMenuTypesview = currentForm = new ew.Form("fMenuTypesview", "view");
	loadjs.done("fMenuTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$MenuTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $MenuTypes_view->ExportOptions->render("body") ?>
<?php $MenuTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $MenuTypes_view->showPageHeader(); ?>
<?php
$MenuTypes_view->showMessage();
?>
<?php if (!$MenuTypes_view->IsModal) { ?>
<?php if (!$MenuTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $MenuTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fMenuTypesview" id="fMenuTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="MenuTypes">
<input type="hidden" name="modal" value="<?php echo (int)$MenuTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($MenuTypes_view->MenuType_Idn->Visible) { // MenuType_Idn ?>
	<tr id="r_MenuType_Idn">
		<td class="<?php echo $MenuTypes_view->TableLeftColumnClass ?>"><span id="elh_MenuTypes_MenuType_Idn"><?php echo $MenuTypes_view->MenuType_Idn->caption() ?></span></td>
		<td data-name="MenuType_Idn" <?php echo $MenuTypes_view->MenuType_Idn->cellAttributes() ?>>
<span id="el_MenuTypes_MenuType_Idn">
<span<?php echo $MenuTypes_view->MenuType_Idn->viewAttributes() ?>><?php echo $MenuTypes_view->MenuType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($MenuTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $MenuTypes_view->TableLeftColumnClass ?>"><span id="elh_MenuTypes_Name"><?php echo $MenuTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $MenuTypes_view->Name->cellAttributes() ?>>
<span id="el_MenuTypes_Name">
<span<?php echo $MenuTypes_view->Name->viewAttributes() ?>><?php echo $MenuTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($MenuTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $MenuTypes_view->TableLeftColumnClass ?>"><span id="elh_MenuTypes_Rank"><?php echo $MenuTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $MenuTypes_view->Rank->cellAttributes() ?>>
<span id="el_MenuTypes_Rank">
<span<?php echo $MenuTypes_view->Rank->viewAttributes() ?>><?php echo $MenuTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($MenuTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $MenuTypes_view->TableLeftColumnClass ?>"><span id="elh_MenuTypes_ActiveFlag"><?php echo $MenuTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $MenuTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_MenuTypes_ActiveFlag">
<span<?php echo $MenuTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $MenuTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($MenuTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$MenuTypes_view->IsModal) { ?>
<?php if (!$MenuTypes_view->isExport()) { ?>
<?php echo $MenuTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$MenuTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$MenuTypes_view->isExport()) { ?>
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
$MenuTypes_view->terminate();
?>