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
$TappingTees_view = new TappingTees_view();

// Run the page
$TappingTees_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TappingTees_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$TappingTees_view->isExport()) { ?>
<script>
var fTappingTeesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fTappingTeesview = currentForm = new ew.Form("fTappingTeesview", "view");
	loadjs.done("fTappingTeesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$TappingTees_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $TappingTees_view->ExportOptions->render("body") ?>
<?php $TappingTees_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $TappingTees_view->showPageHeader(); ?>
<?php
$TappingTees_view->showMessage();
?>
<?php if (!$TappingTees_view->IsModal) { ?>
<?php if (!$TappingTees_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $TappingTees_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fTappingTeesview" id="fTappingTeesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TappingTees">
<input type="hidden" name="modal" value="<?php echo (int)$TappingTees_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($TappingTees_view->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
	<tr id="r_TappingTee_Idn">
		<td class="<?php echo $TappingTees_view->TableLeftColumnClass ?>"><span id="elh_TappingTees_TappingTee_Idn"><?php echo $TappingTees_view->TappingTee_Idn->caption() ?></span></td>
		<td data-name="TappingTee_Idn" <?php echo $TappingTees_view->TappingTee_Idn->cellAttributes() ?>>
<span id="el_TappingTees_TappingTee_Idn">
<span<?php echo $TappingTees_view->TappingTee_Idn->viewAttributes() ?>><?php echo $TappingTees_view->TappingTee_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($TappingTees_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $TappingTees_view->TableLeftColumnClass ?>"><span id="elh_TappingTees_Name"><?php echo $TappingTees_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $TappingTees_view->Name->cellAttributes() ?>>
<span id="el_TappingTees_Name">
<span<?php echo $TappingTees_view->Name->viewAttributes() ?>><?php echo $TappingTees_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($TappingTees_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $TappingTees_view->TableLeftColumnClass ?>"><span id="elh_TappingTees_Rank"><?php echo $TappingTees_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $TappingTees_view->Rank->cellAttributes() ?>>
<span id="el_TappingTees_Rank">
<span<?php echo $TappingTees_view->Rank->viewAttributes() ?>><?php echo $TappingTees_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($TappingTees_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $TappingTees_view->TableLeftColumnClass ?>"><span id="elh_TappingTees_ActiveFlag"><?php echo $TappingTees_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $TappingTees_view->ActiveFlag->cellAttributes() ?>>
<span id="el_TappingTees_ActiveFlag">
<span<?php echo $TappingTees_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $TappingTees_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($TappingTees_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$TappingTees_view->IsModal) { ?>
<?php if (!$TappingTees_view->isExport()) { ?>
<?php echo $TappingTees_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$TappingTees_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$TappingTees_view->isExport()) { ?>
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
$TappingTees_view->terminate();
?>