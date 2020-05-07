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
$AdjustmentSubFactors_view = new AdjustmentSubFactors_view();

// Run the page
$AdjustmentSubFactors_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AdjustmentSubFactors_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$AdjustmentSubFactors_view->isExport()) { ?>
<script>
var fAdjustmentSubFactorsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fAdjustmentSubFactorsview = currentForm = new ew.Form("fAdjustmentSubFactorsview", "view");
	loadjs.done("fAdjustmentSubFactorsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$AdjustmentSubFactors_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $AdjustmentSubFactors_view->ExportOptions->render("body") ?>
<?php $AdjustmentSubFactors_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $AdjustmentSubFactors_view->showPageHeader(); ?>
<?php
$AdjustmentSubFactors_view->showMessage();
?>
<?php if (!$AdjustmentSubFactors_view->IsModal) { ?>
<?php if (!$AdjustmentSubFactors_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $AdjustmentSubFactors_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fAdjustmentSubFactorsview" id="fAdjustmentSubFactorsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AdjustmentSubFactors">
<input type="hidden" name="modal" value="<?php echo (int)$AdjustmentSubFactors_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($AdjustmentSubFactors_view->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
	<tr id="r_AdjustmentSubFactor_Idn">
		<td class="<?php echo $AdjustmentSubFactors_view->TableLeftColumnClass ?>"><span id="elh_AdjustmentSubFactors_AdjustmentSubFactor_Idn"><?php echo $AdjustmentSubFactors_view->AdjustmentSubFactor_Idn->caption() ?></span></td>
		<td data-name="AdjustmentSubFactor_Idn" <?php echo $AdjustmentSubFactors_view->AdjustmentSubFactor_Idn->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_AdjustmentSubFactor_Idn">
<span<?php echo $AdjustmentSubFactors_view->AdjustmentSubFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_view->AdjustmentSubFactor_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($AdjustmentSubFactors_view->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
	<tr id="r_AdjustmentFactor_Idn">
		<td class="<?php echo $AdjustmentSubFactors_view->TableLeftColumnClass ?>"><span id="elh_AdjustmentSubFactors_AdjustmentFactor_Idn"><?php echo $AdjustmentSubFactors_view->AdjustmentFactor_Idn->caption() ?></span></td>
		<td data-name="AdjustmentFactor_Idn" <?php echo $AdjustmentSubFactors_view->AdjustmentFactor_Idn->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentSubFactors_view->AdjustmentFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_view->AdjustmentFactor_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($AdjustmentSubFactors_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $AdjustmentSubFactors_view->TableLeftColumnClass ?>"><span id="elh_AdjustmentSubFactors_Name"><?php echo $AdjustmentSubFactors_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $AdjustmentSubFactors_view->Name->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_Name">
<span<?php echo $AdjustmentSubFactors_view->Name->viewAttributes() ?>><?php echo $AdjustmentSubFactors_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($AdjustmentSubFactors_view->Value->Visible) { // Value ?>
	<tr id="r_Value">
		<td class="<?php echo $AdjustmentSubFactors_view->TableLeftColumnClass ?>"><span id="elh_AdjustmentSubFactors_Value"><?php echo $AdjustmentSubFactors_view->Value->caption() ?></span></td>
		<td data-name="Value" <?php echo $AdjustmentSubFactors_view->Value->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_Value">
<span<?php echo $AdjustmentSubFactors_view->Value->viewAttributes() ?>><?php echo $AdjustmentSubFactors_view->Value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($AdjustmentSubFactors_view->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
	<tr id="r_LaborClass_Idn">
		<td class="<?php echo $AdjustmentSubFactors_view->TableLeftColumnClass ?>"><span id="elh_AdjustmentSubFactors_LaborClass_Idn"><?php echo $AdjustmentSubFactors_view->LaborClass_Idn->caption() ?></span></td>
		<td data-name="LaborClass_Idn" <?php echo $AdjustmentSubFactors_view->LaborClass_Idn->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_LaborClass_Idn">
<span<?php echo $AdjustmentSubFactors_view->LaborClass_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_view->LaborClass_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($AdjustmentSubFactors_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $AdjustmentSubFactors_view->TableLeftColumnClass ?>"><span id="elh_AdjustmentSubFactors_Rank"><?php echo $AdjustmentSubFactors_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $AdjustmentSubFactors_view->Rank->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_Rank">
<span<?php echo $AdjustmentSubFactors_view->Rank->viewAttributes() ?>><?php echo $AdjustmentSubFactors_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($AdjustmentSubFactors_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $AdjustmentSubFactors_view->TableLeftColumnClass ?>"><span id="elh_AdjustmentSubFactors_ActiveFlag"><?php echo $AdjustmentSubFactors_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $AdjustmentSubFactors_view->ActiveFlag->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_ActiveFlag">
<span<?php echo $AdjustmentSubFactors_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $AdjustmentSubFactors_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($AdjustmentSubFactors_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$AdjustmentSubFactors_view->IsModal) { ?>
<?php if (!$AdjustmentSubFactors_view->isExport()) { ?>
<?php echo $AdjustmentSubFactors_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$AdjustmentSubFactors_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$AdjustmentSubFactors_view->isExport()) { ?>
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
$AdjustmentSubFactors_view->terminate();
?>