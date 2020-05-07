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
$UndergroundValves_view = new UndergroundValves_view();

// Run the page
$UndergroundValves_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$UndergroundValves_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$UndergroundValves_view->isExport()) { ?>
<script>
var fUndergroundValvesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fUndergroundValvesview = currentForm = new ew.Form("fUndergroundValvesview", "view");
	loadjs.done("fUndergroundValvesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$UndergroundValves_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $UndergroundValves_view->ExportOptions->render("body") ?>
<?php $UndergroundValves_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $UndergroundValves_view->showPageHeader(); ?>
<?php
$UndergroundValves_view->showMessage();
?>
<?php if (!$UndergroundValves_view->IsModal) { ?>
<?php if (!$UndergroundValves_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $UndergroundValves_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fUndergroundValvesview" id="fUndergroundValvesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="UndergroundValves">
<input type="hidden" name="modal" value="<?php echo (int)$UndergroundValves_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($UndergroundValves_view->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
	<tr id="r_UndergroundValve_Idn">
		<td class="<?php echo $UndergroundValves_view->TableLeftColumnClass ?>"><span id="elh_UndergroundValves_UndergroundValve_Idn"><?php echo $UndergroundValves_view->UndergroundValve_Idn->caption() ?></span></td>
		<td data-name="UndergroundValve_Idn" <?php echo $UndergroundValves_view->UndergroundValve_Idn->cellAttributes() ?>>
<span id="el_UndergroundValves_UndergroundValve_Idn">
<span<?php echo $UndergroundValves_view->UndergroundValve_Idn->viewAttributes() ?>><?php echo $UndergroundValves_view->UndergroundValve_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($UndergroundValves_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $UndergroundValves_view->TableLeftColumnClass ?>"><span id="elh_UndergroundValves_Name"><?php echo $UndergroundValves_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $UndergroundValves_view->Name->cellAttributes() ?>>
<span id="el_UndergroundValves_Name">
<span<?php echo $UndergroundValves_view->Name->viewAttributes() ?>><?php echo $UndergroundValves_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($UndergroundValves_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $UndergroundValves_view->TableLeftColumnClass ?>"><span id="elh_UndergroundValves_Rank"><?php echo $UndergroundValves_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $UndergroundValves_view->Rank->cellAttributes() ?>>
<span id="el_UndergroundValves_Rank">
<span<?php echo $UndergroundValves_view->Rank->viewAttributes() ?>><?php echo $UndergroundValves_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($UndergroundValves_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $UndergroundValves_view->TableLeftColumnClass ?>"><span id="elh_UndergroundValves_ActiveFlag"><?php echo $UndergroundValves_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $UndergroundValves_view->ActiveFlag->cellAttributes() ?>>
<span id="el_UndergroundValves_ActiveFlag">
<span<?php echo $UndergroundValves_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $UndergroundValves_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($UndergroundValves_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$UndergroundValves_view->IsModal) { ?>
<?php if (!$UndergroundValves_view->isExport()) { ?>
<?php echo $UndergroundValves_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$UndergroundValves_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$UndergroundValves_view->isExport()) { ?>
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
$UndergroundValves_view->terminate();
?>