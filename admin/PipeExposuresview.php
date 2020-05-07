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
$PipeExposures_view = new PipeExposures_view();

// Run the page
$PipeExposures_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeExposures_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$PipeExposures_view->isExport()) { ?>
<script>
var fPipeExposuresview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fPipeExposuresview = currentForm = new ew.Form("fPipeExposuresview", "view");
	loadjs.done("fPipeExposuresview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$PipeExposures_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $PipeExposures_view->ExportOptions->render("body") ?>
<?php $PipeExposures_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $PipeExposures_view->showPageHeader(); ?>
<?php
$PipeExposures_view->showMessage();
?>
<?php if (!$PipeExposures_view->IsModal) { ?>
<?php if (!$PipeExposures_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PipeExposures_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fPipeExposuresview" id="fPipeExposuresview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeExposures">
<input type="hidden" name="modal" value="<?php echo (int)$PipeExposures_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($PipeExposures_view->PipeExposure_Idn->Visible) { // PipeExposure_Idn ?>
	<tr id="r_PipeExposure_Idn">
		<td class="<?php echo $PipeExposures_view->TableLeftColumnClass ?>"><span id="elh_PipeExposures_PipeExposure_Idn"><?php echo $PipeExposures_view->PipeExposure_Idn->caption() ?></span></td>
		<td data-name="PipeExposure_Idn" <?php echo $PipeExposures_view->PipeExposure_Idn->cellAttributes() ?>>
<span id="el_PipeExposures_PipeExposure_Idn">
<span<?php echo $PipeExposures_view->PipeExposure_Idn->viewAttributes() ?>><?php echo $PipeExposures_view->PipeExposure_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeExposures_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $PipeExposures_view->TableLeftColumnClass ?>"><span id="elh_PipeExposures_Name"><?php echo $PipeExposures_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $PipeExposures_view->Name->cellAttributes() ?>>
<span id="el_PipeExposures_Name">
<span<?php echo $PipeExposures_view->Name->viewAttributes() ?>><?php echo $PipeExposures_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeExposures_view->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
	<tr id="r_AdjustmentFactor_Idn">
		<td class="<?php echo $PipeExposures_view->TableLeftColumnClass ?>"><span id="elh_PipeExposures_AdjustmentFactor_Idn"><?php echo $PipeExposures_view->AdjustmentFactor_Idn->caption() ?></span></td>
		<td data-name="AdjustmentFactor_Idn" <?php echo $PipeExposures_view->AdjustmentFactor_Idn->cellAttributes() ?>>
<span id="el_PipeExposures_AdjustmentFactor_Idn">
<span<?php echo $PipeExposures_view->AdjustmentFactor_Idn->viewAttributes() ?>><?php echo $PipeExposures_view->AdjustmentFactor_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeExposures_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $PipeExposures_view->TableLeftColumnClass ?>"><span id="elh_PipeExposures_Rank"><?php echo $PipeExposures_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $PipeExposures_view->Rank->cellAttributes() ?>>
<span id="el_PipeExposures_Rank">
<span<?php echo $PipeExposures_view->Rank->viewAttributes() ?>><?php echo $PipeExposures_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeExposures_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $PipeExposures_view->TableLeftColumnClass ?>"><span id="elh_PipeExposures_ActiveFlag"><?php echo $PipeExposures_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $PipeExposures_view->ActiveFlag->cellAttributes() ?>>
<span id="el_PipeExposures_ActiveFlag">
<span<?php echo $PipeExposures_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PipeExposures_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeExposures_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$PipeExposures_view->IsModal) { ?>
<?php if (!$PipeExposures_view->isExport()) { ?>
<?php echo $PipeExposures_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$PipeExposures_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$PipeExposures_view->isExport()) { ?>
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
$PipeExposures_view->terminate();
?>