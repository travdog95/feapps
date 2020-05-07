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
$SystemTypes_view = new SystemTypes_view();

// Run the page
$SystemTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SystemTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$SystemTypes_view->isExport()) { ?>
<script>
var fSystemTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fSystemTypesview = currentForm = new ew.Form("fSystemTypesview", "view");
	loadjs.done("fSystemTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$SystemTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $SystemTypes_view->ExportOptions->render("body") ?>
<?php $SystemTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $SystemTypes_view->showPageHeader(); ?>
<?php
$SystemTypes_view->showMessage();
?>
<?php if (!$SystemTypes_view->IsModal) { ?>
<?php if (!$SystemTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $SystemTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fSystemTypesview" id="fSystemTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SystemTypes">
<input type="hidden" name="modal" value="<?php echo (int)$SystemTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($SystemTypes_view->SystemType_Idn->Visible) { // SystemType_Idn ?>
	<tr id="r_SystemType_Idn">
		<td class="<?php echo $SystemTypes_view->TableLeftColumnClass ?>"><span id="elh_SystemTypes_SystemType_Idn"><?php echo $SystemTypes_view->SystemType_Idn->caption() ?></span></td>
		<td data-name="SystemType_Idn" <?php echo $SystemTypes_view->SystemType_Idn->cellAttributes() ?>>
<span id="el_SystemTypes_SystemType_Idn">
<span<?php echo $SystemTypes_view->SystemType_Idn->viewAttributes() ?>><?php echo $SystemTypes_view->SystemType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($SystemTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $SystemTypes_view->TableLeftColumnClass ?>"><span id="elh_SystemTypes_Name"><?php echo $SystemTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $SystemTypes_view->Name->cellAttributes() ?>>
<span id="el_SystemTypes_Name">
<span<?php echo $SystemTypes_view->Name->viewAttributes() ?>><?php echo $SystemTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($SystemTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $SystemTypes_view->TableLeftColumnClass ?>"><span id="elh_SystemTypes_Rank"><?php echo $SystemTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $SystemTypes_view->Rank->cellAttributes() ?>>
<span id="el_SystemTypes_Rank">
<span<?php echo $SystemTypes_view->Rank->viewAttributes() ?>><?php echo $SystemTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($SystemTypes_view->Department_Idn->Visible) { // Department_Idn ?>
	<tr id="r_Department_Idn">
		<td class="<?php echo $SystemTypes_view->TableLeftColumnClass ?>"><span id="elh_SystemTypes_Department_Idn"><?php echo $SystemTypes_view->Department_Idn->caption() ?></span></td>
		<td data-name="Department_Idn" <?php echo $SystemTypes_view->Department_Idn->cellAttributes() ?>>
<span id="el_SystemTypes_Department_Idn">
<span<?php echo $SystemTypes_view->Department_Idn->viewAttributes() ?>><?php echo $SystemTypes_view->Department_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($SystemTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $SystemTypes_view->TableLeftColumnClass ?>"><span id="elh_SystemTypes_ActiveFlag"><?php echo $SystemTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $SystemTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_SystemTypes_ActiveFlag">
<span<?php echo $SystemTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $SystemTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($SystemTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$SystemTypes_view->IsModal) { ?>
<?php if (!$SystemTypes_view->isExport()) { ?>
<?php echo $SystemTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("SystemSubTypes", explode(",", $SystemTypes->getCurrentDetailTable())) && $SystemSubTypes->DetailView) {
?>
<?php if ($SystemTypes->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("SystemSubTypes", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "SystemSubTypesgrid.php" ?>
<?php } ?>
</form>
<?php
$SystemTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$SystemTypes_view->isExport()) { ?>
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
$SystemTypes_view->terminate();
?>