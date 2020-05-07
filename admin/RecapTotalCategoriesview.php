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
$RecapTotalCategories_view = new RecapTotalCategories_view();

// Run the page
$RecapTotalCategories_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapTotalCategories_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$RecapTotalCategories_view->isExport()) { ?>
<script>
var fRecapTotalCategoriesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fRecapTotalCategoriesview = currentForm = new ew.Form("fRecapTotalCategoriesview", "view");
	loadjs.done("fRecapTotalCategoriesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$RecapTotalCategories_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $RecapTotalCategories_view->ExportOptions->render("body") ?>
<?php $RecapTotalCategories_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $RecapTotalCategories_view->showPageHeader(); ?>
<?php
$RecapTotalCategories_view->showMessage();
?>
<?php if (!$RecapTotalCategories_view->IsModal) { ?>
<?php if (!$RecapTotalCategories_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapTotalCategories_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fRecapTotalCategoriesview" id="fRecapTotalCategoriesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapTotalCategories">
<input type="hidden" name="modal" value="<?php echo (int)$RecapTotalCategories_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($RecapTotalCategories_view->RecapTotalCategory_Idn->Visible) { // RecapTotalCategory_Idn ?>
	<tr id="r_RecapTotalCategory_Idn">
		<td class="<?php echo $RecapTotalCategories_view->TableLeftColumnClass ?>"><span id="elh_RecapTotalCategories_RecapTotalCategory_Idn"><?php echo $RecapTotalCategories_view->RecapTotalCategory_Idn->caption() ?></span></td>
		<td data-name="RecapTotalCategory_Idn" <?php echo $RecapTotalCategories_view->RecapTotalCategory_Idn->cellAttributes() ?>>
<span id="el_RecapTotalCategories_RecapTotalCategory_Idn">
<span<?php echo $RecapTotalCategories_view->RecapTotalCategory_Idn->viewAttributes() ?>><?php echo $RecapTotalCategories_view->RecapTotalCategory_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RecapTotalCategories_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $RecapTotalCategories_view->TableLeftColumnClass ?>"><span id="elh_RecapTotalCategories_Name"><?php echo $RecapTotalCategories_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $RecapTotalCategories_view->Name->cellAttributes() ?>>
<span id="el_RecapTotalCategories_Name">
<span<?php echo $RecapTotalCategories_view->Name->viewAttributes() ?>><?php echo $RecapTotalCategories_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RecapTotalCategories_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $RecapTotalCategories_view->TableLeftColumnClass ?>"><span id="elh_RecapTotalCategories_Rank"><?php echo $RecapTotalCategories_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $RecapTotalCategories_view->Rank->cellAttributes() ?>>
<span id="el_RecapTotalCategories_Rank">
<span<?php echo $RecapTotalCategories_view->Rank->viewAttributes() ?>><?php echo $RecapTotalCategories_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RecapTotalCategories_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $RecapTotalCategories_view->TableLeftColumnClass ?>"><span id="elh_RecapTotalCategories_ActiveFlag"><?php echo $RecapTotalCategories_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $RecapTotalCategories_view->ActiveFlag->cellAttributes() ?>>
<span id="el_RecapTotalCategories_ActiveFlag">
<span<?php echo $RecapTotalCategories_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $RecapTotalCategories_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapTotalCategories_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$RecapTotalCategories_view->IsModal) { ?>
<?php if (!$RecapTotalCategories_view->isExport()) { ?>
<?php echo $RecapTotalCategories_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$RecapTotalCategories_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$RecapTotalCategories_view->isExport()) { ?>
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
$RecapTotalCategories_view->terminate();
?>