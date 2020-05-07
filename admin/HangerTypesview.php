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
$HangerTypes_view = new HangerTypes_view();

// Run the page
$HangerTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HangerTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$HangerTypes_view->isExport()) { ?>
<script>
var fHangerTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fHangerTypesview = currentForm = new ew.Form("fHangerTypesview", "view");
	loadjs.done("fHangerTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$HangerTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $HangerTypes_view->ExportOptions->render("body") ?>
<?php $HangerTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $HangerTypes_view->showPageHeader(); ?>
<?php
$HangerTypes_view->showMessage();
?>
<?php if (!$HangerTypes_view->IsModal) { ?>
<?php if (!$HangerTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $HangerTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fHangerTypesview" id="fHangerTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="HangerTypes">
<input type="hidden" name="modal" value="<?php echo (int)$HangerTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($HangerTypes_view->HangerType_Idn->Visible) { // HangerType_Idn ?>
	<tr id="r_HangerType_Idn">
		<td class="<?php echo $HangerTypes_view->TableLeftColumnClass ?>"><span id="elh_HangerTypes_HangerType_Idn"><?php echo $HangerTypes_view->HangerType_Idn->caption() ?></span></td>
		<td data-name="HangerType_Idn" <?php echo $HangerTypes_view->HangerType_Idn->cellAttributes() ?>>
<span id="el_HangerTypes_HangerType_Idn">
<span<?php echo $HangerTypes_view->HangerType_Idn->viewAttributes() ?>><?php echo $HangerTypes_view->HangerType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($HangerTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $HangerTypes_view->TableLeftColumnClass ?>"><span id="elh_HangerTypes_Name"><?php echo $HangerTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $HangerTypes_view->Name->cellAttributes() ?>>
<span id="el_HangerTypes_Name">
<span<?php echo $HangerTypes_view->Name->viewAttributes() ?>><?php echo $HangerTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($HangerTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $HangerTypes_view->TableLeftColumnClass ?>"><span id="elh_HangerTypes_Rank"><?php echo $HangerTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $HangerTypes_view->Rank->cellAttributes() ?>>
<span id="el_HangerTypes_Rank">
<span<?php echo $HangerTypes_view->Rank->viewAttributes() ?>><?php echo $HangerTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($HangerTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $HangerTypes_view->TableLeftColumnClass ?>"><span id="elh_HangerTypes_ActiveFlag"><?php echo $HangerTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $HangerTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_HangerTypes_ActiveFlag">
<span<?php echo $HangerTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HangerTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HangerTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$HangerTypes_view->IsModal) { ?>
<?php if (!$HangerTypes_view->isExport()) { ?>
<?php echo $HangerTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("HangerSubTypes", explode(",", $HangerTypes->getCurrentDetailTable())) && $HangerSubTypes->DetailView) {
?>
<?php if ($HangerTypes->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("HangerSubTypes", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "HangerSubTypesgrid.php" ?>
<?php } ?>
</form>
<?php
$HangerTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$HangerTypes_view->isExport()) { ?>
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
$HangerTypes_view->terminate();
?>