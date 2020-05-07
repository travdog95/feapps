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
$ControlValves_view = new ControlValves_view();

// Run the page
$ControlValves_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ControlValves_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ControlValves_view->isExport()) { ?>
<script>
var fControlValvesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fControlValvesview = currentForm = new ew.Form("fControlValvesview", "view");
	loadjs.done("fControlValvesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ControlValves_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ControlValves_view->ExportOptions->render("body") ?>
<?php $ControlValves_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ControlValves_view->showPageHeader(); ?>
<?php
$ControlValves_view->showMessage();
?>
<?php if (!$ControlValves_view->IsModal) { ?>
<?php if (!$ControlValves_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ControlValves_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fControlValvesview" id="fControlValvesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ControlValves">
<input type="hidden" name="modal" value="<?php echo (int)$ControlValves_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ControlValves_view->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
	<tr id="r_ControlValve_Idn">
		<td class="<?php echo $ControlValves_view->TableLeftColumnClass ?>"><span id="elh_ControlValves_ControlValve_Idn"><?php echo $ControlValves_view->ControlValve_Idn->caption() ?></span></td>
		<td data-name="ControlValve_Idn" <?php echo $ControlValves_view->ControlValve_Idn->cellAttributes() ?>>
<span id="el_ControlValves_ControlValve_Idn">
<span<?php echo $ControlValves_view->ControlValve_Idn->viewAttributes() ?>><?php echo $ControlValves_view->ControlValve_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ControlValves_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $ControlValves_view->TableLeftColumnClass ?>"><span id="elh_ControlValves_Name"><?php echo $ControlValves_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $ControlValves_view->Name->cellAttributes() ?>>
<span id="el_ControlValves_Name">
<span<?php echo $ControlValves_view->Name->viewAttributes() ?>><?php echo $ControlValves_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ControlValves_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $ControlValves_view->TableLeftColumnClass ?>"><span id="elh_ControlValves_Rank"><?php echo $ControlValves_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $ControlValves_view->Rank->cellAttributes() ?>>
<span id="el_ControlValves_Rank">
<span<?php echo $ControlValves_view->Rank->viewAttributes() ?>><?php echo $ControlValves_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ControlValves_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $ControlValves_view->TableLeftColumnClass ?>"><span id="elh_ControlValves_ActiveFlag"><?php echo $ControlValves_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $ControlValves_view->ActiveFlag->cellAttributes() ?>>
<span id="el_ControlValves_ActiveFlag">
<span<?php echo $ControlValves_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ControlValves_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ControlValves_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ControlValves_view->IsModal) { ?>
<?php if (!$ControlValves_view->isExport()) { ?>
<?php echo $ControlValves_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ControlValves_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ControlValves_view->isExport()) { ?>
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
$ControlValves_view->terminate();
?>