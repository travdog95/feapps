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
$LiftDurations_view = new LiftDurations_view();

// Run the page
$LiftDurations_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LiftDurations_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$LiftDurations_view->isExport()) { ?>
<script>
var fLiftDurationsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fLiftDurationsview = currentForm = new ew.Form("fLiftDurationsview", "view");
	loadjs.done("fLiftDurationsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$LiftDurations_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $LiftDurations_view->ExportOptions->render("body") ?>
<?php $LiftDurations_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $LiftDurations_view->showPageHeader(); ?>
<?php
$LiftDurations_view->showMessage();
?>
<?php if (!$LiftDurations_view->IsModal) { ?>
<?php if (!$LiftDurations_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $LiftDurations_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fLiftDurationsview" id="fLiftDurationsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LiftDurations">
<input type="hidden" name="modal" value="<?php echo (int)$LiftDurations_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($LiftDurations_view->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
	<tr id="r_LiftDuration_Idn">
		<td class="<?php echo $LiftDurations_view->TableLeftColumnClass ?>"><span id="elh_LiftDurations_LiftDuration_Idn"><?php echo $LiftDurations_view->LiftDuration_Idn->caption() ?></span></td>
		<td data-name="LiftDuration_Idn" <?php echo $LiftDurations_view->LiftDuration_Idn->cellAttributes() ?>>
<span id="el_LiftDurations_LiftDuration_Idn">
<span<?php echo $LiftDurations_view->LiftDuration_Idn->viewAttributes() ?>><?php echo $LiftDurations_view->LiftDuration_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LiftDurations_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $LiftDurations_view->TableLeftColumnClass ?>"><span id="elh_LiftDurations_Name"><?php echo $LiftDurations_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $LiftDurations_view->Name->cellAttributes() ?>>
<span id="el_LiftDurations_Name">
<span<?php echo $LiftDurations_view->Name->viewAttributes() ?>><?php echo $LiftDurations_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LiftDurations_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $LiftDurations_view->TableLeftColumnClass ?>"><span id="elh_LiftDurations_Rank"><?php echo $LiftDurations_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $LiftDurations_view->Rank->cellAttributes() ?>>
<span id="el_LiftDurations_Rank">
<span<?php echo $LiftDurations_view->Rank->viewAttributes() ?>><?php echo $LiftDurations_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LiftDurations_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $LiftDurations_view->TableLeftColumnClass ?>"><span id="elh_LiftDurations_ActiveFlag"><?php echo $LiftDurations_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $LiftDurations_view->ActiveFlag->cellAttributes() ?>>
<span id="el_LiftDurations_ActiveFlag">
<span<?php echo $LiftDurations_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $LiftDurations_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($LiftDurations_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$LiftDurations_view->IsModal) { ?>
<?php if (!$LiftDurations_view->isExport()) { ?>
<?php echo $LiftDurations_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$LiftDurations_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$LiftDurations_view->isExport()) { ?>
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
$LiftDurations_view->terminate();
?>