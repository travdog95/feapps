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
$RiserTypes_view = new RiserTypes_view();

// Run the page
$RiserTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RiserTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$RiserTypes_view->isExport()) { ?>
<script>
var fRiserTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fRiserTypesview = currentForm = new ew.Form("fRiserTypesview", "view");
	loadjs.done("fRiserTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$RiserTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $RiserTypes_view->ExportOptions->render("body") ?>
<?php $RiserTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $RiserTypes_view->showPageHeader(); ?>
<?php
$RiserTypes_view->showMessage();
?>
<?php if (!$RiserTypes_view->IsModal) { ?>
<?php if (!$RiserTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RiserTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fRiserTypesview" id="fRiserTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RiserTypes">
<input type="hidden" name="modal" value="<?php echo (int)$RiserTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($RiserTypes_view->RiserType_Idn->Visible) { // RiserType_Idn ?>
	<tr id="r_RiserType_Idn">
		<td class="<?php echo $RiserTypes_view->TableLeftColumnClass ?>"><span id="elh_RiserTypes_RiserType_Idn"><?php echo $RiserTypes_view->RiserType_Idn->caption() ?></span></td>
		<td data-name="RiserType_Idn" <?php echo $RiserTypes_view->RiserType_Idn->cellAttributes() ?>>
<span id="el_RiserTypes_RiserType_Idn">
<span<?php echo $RiserTypes_view->RiserType_Idn->viewAttributes() ?>><?php echo $RiserTypes_view->RiserType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RiserTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $RiserTypes_view->TableLeftColumnClass ?>"><span id="elh_RiserTypes_Name"><?php echo $RiserTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $RiserTypes_view->Name->cellAttributes() ?>>
<span id="el_RiserTypes_Name">
<span<?php echo $RiserTypes_view->Name->viewAttributes() ?>><?php echo $RiserTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RiserTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $RiserTypes_view->TableLeftColumnClass ?>"><span id="elh_RiserTypes_Rank"><?php echo $RiserTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $RiserTypes_view->Rank->cellAttributes() ?>>
<span id="el_RiserTypes_Rank">
<span<?php echo $RiserTypes_view->Rank->viewAttributes() ?>><?php echo $RiserTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RiserTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $RiserTypes_view->TableLeftColumnClass ?>"><span id="elh_RiserTypes_ActiveFlag"><?php echo $RiserTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $RiserTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_RiserTypes_ActiveFlag">
<span<?php echo $RiserTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $RiserTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RiserTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$RiserTypes_view->IsModal) { ?>
<?php if (!$RiserTypes_view->isExport()) { ?>
<?php echo $RiserTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$RiserTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$RiserTypes_view->isExport()) { ?>
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
$RiserTypes_view->terminate();
?>