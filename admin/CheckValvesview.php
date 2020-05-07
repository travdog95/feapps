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
$CheckValves_view = new CheckValves_view();

// Run the page
$CheckValves_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CheckValves_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$CheckValves_view->isExport()) { ?>
<script>
var fCheckValvesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fCheckValvesview = currentForm = new ew.Form("fCheckValvesview", "view");
	loadjs.done("fCheckValvesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$CheckValves_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $CheckValves_view->ExportOptions->render("body") ?>
<?php $CheckValves_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $CheckValves_view->showPageHeader(); ?>
<?php
$CheckValves_view->showMessage();
?>
<?php if (!$CheckValves_view->IsModal) { ?>
<?php if (!$CheckValves_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $CheckValves_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fCheckValvesview" id="fCheckValvesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CheckValves">
<input type="hidden" name="modal" value="<?php echo (int)$CheckValves_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($CheckValves_view->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
	<tr id="r_CheckValve_Idn">
		<td class="<?php echo $CheckValves_view->TableLeftColumnClass ?>"><span id="elh_CheckValves_CheckValve_Idn"><?php echo $CheckValves_view->CheckValve_Idn->caption() ?></span></td>
		<td data-name="CheckValve_Idn" <?php echo $CheckValves_view->CheckValve_Idn->cellAttributes() ?>>
<span id="el_CheckValves_CheckValve_Idn">
<span<?php echo $CheckValves_view->CheckValve_Idn->viewAttributes() ?>><?php echo $CheckValves_view->CheckValve_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CheckValves_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $CheckValves_view->TableLeftColumnClass ?>"><span id="elh_CheckValves_Name"><?php echo $CheckValves_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $CheckValves_view->Name->cellAttributes() ?>>
<span id="el_CheckValves_Name">
<span<?php echo $CheckValves_view->Name->viewAttributes() ?>><?php echo $CheckValves_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CheckValves_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $CheckValves_view->TableLeftColumnClass ?>"><span id="elh_CheckValves_Rank"><?php echo $CheckValves_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $CheckValves_view->Rank->cellAttributes() ?>>
<span id="el_CheckValves_Rank">
<span<?php echo $CheckValves_view->Rank->viewAttributes() ?>><?php echo $CheckValves_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CheckValves_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $CheckValves_view->TableLeftColumnClass ?>"><span id="elh_CheckValves_ActiveFlag"><?php echo $CheckValves_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $CheckValves_view->ActiveFlag->cellAttributes() ?>>
<span id="el_CheckValves_ActiveFlag">
<span<?php echo $CheckValves_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $CheckValves_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($CheckValves_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$CheckValves_view->IsModal) { ?>
<?php if (!$CheckValves_view->isExport()) { ?>
<?php echo $CheckValves_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$CheckValves_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$CheckValves_view->isExport()) { ?>
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
$CheckValves_view->terminate();
?>