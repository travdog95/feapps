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
$RecapSubtotalCategories_view = new RecapSubtotalCategories_view();

// Run the page
$RecapSubtotalCategories_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapSubtotalCategories_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$RecapSubtotalCategories_view->isExport()) { ?>
<script>
var fRecapSubtotalCategoriesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fRecapSubtotalCategoriesview = currentForm = new ew.Form("fRecapSubtotalCategoriesview", "view");
	loadjs.done("fRecapSubtotalCategoriesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$RecapSubtotalCategories_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $RecapSubtotalCategories_view->ExportOptions->render("body") ?>
<?php $RecapSubtotalCategories_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $RecapSubtotalCategories_view->showPageHeader(); ?>
<?php
$RecapSubtotalCategories_view->showMessage();
?>
<?php if (!$RecapSubtotalCategories_view->IsModal) { ?>
<?php if (!$RecapSubtotalCategories_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapSubtotalCategories_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fRecapSubtotalCategoriesview" id="fRecapSubtotalCategoriesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapSubtotalCategories">
<input type="hidden" name="modal" value="<?php echo (int)$RecapSubtotalCategories_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($RecapSubtotalCategories_view->RecapSubtotalCategory_Idn->Visible) { // RecapSubtotalCategory_Idn ?>
	<tr id="r_RecapSubtotalCategory_Idn">
		<td class="<?php echo $RecapSubtotalCategories_view->TableLeftColumnClass ?>"><span id="elh_RecapSubtotalCategories_RecapSubtotalCategory_Idn"><?php echo $RecapSubtotalCategories_view->RecapSubtotalCategory_Idn->caption() ?></span></td>
		<td data-name="RecapSubtotalCategory_Idn" <?php echo $RecapSubtotalCategories_view->RecapSubtotalCategory_Idn->cellAttributes() ?>>
<span id="el_RecapSubtotalCategories_RecapSubtotalCategory_Idn">
<span<?php echo $RecapSubtotalCategories_view->RecapSubtotalCategory_Idn->viewAttributes() ?>><?php echo $RecapSubtotalCategories_view->RecapSubtotalCategory_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RecapSubtotalCategories_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $RecapSubtotalCategories_view->TableLeftColumnClass ?>"><span id="elh_RecapSubtotalCategories_Name"><?php echo $RecapSubtotalCategories_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $RecapSubtotalCategories_view->Name->cellAttributes() ?>>
<span id="el_RecapSubtotalCategories_Name">
<span<?php echo $RecapSubtotalCategories_view->Name->viewAttributes() ?>><?php echo $RecapSubtotalCategories_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RecapSubtotalCategories_view->Percentage->Visible) { // Percentage ?>
	<tr id="r_Percentage">
		<td class="<?php echo $RecapSubtotalCategories_view->TableLeftColumnClass ?>"><span id="elh_RecapSubtotalCategories_Percentage"><?php echo $RecapSubtotalCategories_view->Percentage->caption() ?></span></td>
		<td data-name="Percentage" <?php echo $RecapSubtotalCategories_view->Percentage->cellAttributes() ?>>
<span id="el_RecapSubtotalCategories_Percentage">
<span<?php echo $RecapSubtotalCategories_view->Percentage->viewAttributes() ?>><?php echo $RecapSubtotalCategories_view->Percentage->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RecapSubtotalCategories_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $RecapSubtotalCategories_view->TableLeftColumnClass ?>"><span id="elh_RecapSubtotalCategories_Rank"><?php echo $RecapSubtotalCategories_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $RecapSubtotalCategories_view->Rank->cellAttributes() ?>>
<span id="el_RecapSubtotalCategories_Rank">
<span<?php echo $RecapSubtotalCategories_view->Rank->viewAttributes() ?>><?php echo $RecapSubtotalCategories_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$RecapSubtotalCategories_view->IsModal) { ?>
<?php if (!$RecapSubtotalCategories_view->isExport()) { ?>
<?php echo $RecapSubtotalCategories_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$RecapSubtotalCategories_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$RecapSubtotalCategories_view->isExport()) { ?>
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
$RecapSubtotalCategories_view->terminate();
?>