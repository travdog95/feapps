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
$JobDefaults_view = new JobDefaults_view();

// Run the page
$JobDefaults_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobDefaults_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$JobDefaults_view->isExport()) { ?>
<script>
var fJobDefaultsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fJobDefaultsview = currentForm = new ew.Form("fJobDefaultsview", "view");
	loadjs.done("fJobDefaultsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$JobDefaults_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $JobDefaults_view->ExportOptions->render("body") ?>
<?php $JobDefaults_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $JobDefaults_view->showPageHeader(); ?>
<?php
$JobDefaults_view->showMessage();
?>
<?php if (!$JobDefaults_view->IsModal) { ?>
<?php if (!$JobDefaults_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobDefaults_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fJobDefaultsview" id="fJobDefaultsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobDefaults">
<input type="hidden" name="modal" value="<?php echo (int)$JobDefaults_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($JobDefaults_view->JobDefault_Idn->Visible) { // JobDefault_Idn ?>
	<tr id="r_JobDefault_Idn">
		<td class="<?php echo $JobDefaults_view->TableLeftColumnClass ?>"><span id="elh_JobDefaults_JobDefault_Idn"><?php echo $JobDefaults_view->JobDefault_Idn->caption() ?></span></td>
		<td data-name="JobDefault_Idn" <?php echo $JobDefaults_view->JobDefault_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_JobDefault_Idn">
<span<?php echo $JobDefaults_view->JobDefault_Idn->viewAttributes() ?>><?php echo $JobDefaults_view->JobDefault_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaults_view->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
	<tr id="r_JobDefaultType_Idn">
		<td class="<?php echo $JobDefaults_view->TableLeftColumnClass ?>"><span id="elh_JobDefaults_JobDefaultType_Idn"><?php echo $JobDefaults_view->JobDefaultType_Idn->caption() ?></span></td>
		<td data-name="JobDefaultType_Idn" <?php echo $JobDefaults_view->JobDefaultType_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_JobDefaultType_Idn">
<span<?php echo $JobDefaults_view->JobDefaultType_Idn->viewAttributes() ?>><?php echo $JobDefaults_view->JobDefaultType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaults_view->Department_Idn->Visible) { // Department_Idn ?>
	<tr id="r_Department_Idn">
		<td class="<?php echo $JobDefaults_view->TableLeftColumnClass ?>"><span id="elh_JobDefaults_Department_Idn"><?php echo $JobDefaults_view->Department_Idn->caption() ?></span></td>
		<td data-name="Department_Idn" <?php echo $JobDefaults_view->Department_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_Department_Idn">
<span<?php echo $JobDefaults_view->Department_Idn->viewAttributes() ?>><?php echo $JobDefaults_view->Department_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaults_view->ParentJobDefault_Idn->Visible) { // ParentJobDefault_Idn ?>
	<tr id="r_ParentJobDefault_Idn">
		<td class="<?php echo $JobDefaults_view->TableLeftColumnClass ?>"><span id="elh_JobDefaults_ParentJobDefault_Idn"><?php echo $JobDefaults_view->ParentJobDefault_Idn->caption() ?></span></td>
		<td data-name="ParentJobDefault_Idn" <?php echo $JobDefaults_view->ParentJobDefault_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_ParentJobDefault_Idn">
<span<?php echo $JobDefaults_view->ParentJobDefault_Idn->viewAttributes() ?>><?php echo $JobDefaults_view->ParentJobDefault_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaults_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $JobDefaults_view->TableLeftColumnClass ?>"><span id="elh_JobDefaults_Name"><?php echo $JobDefaults_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $JobDefaults_view->Name->cellAttributes() ?>>
<span id="el_JobDefaults_Name">
<span<?php echo $JobDefaults_view->Name->viewAttributes() ?>><?php echo $JobDefaults_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaults_view->NumericValue->Visible) { // NumericValue ?>
	<tr id="r_NumericValue">
		<td class="<?php echo $JobDefaults_view->TableLeftColumnClass ?>"><span id="elh_JobDefaults_NumericValue"><?php echo $JobDefaults_view->NumericValue->caption() ?></span></td>
		<td data-name="NumericValue" <?php echo $JobDefaults_view->NumericValue->cellAttributes() ?>>
<span id="el_JobDefaults_NumericValue">
<span<?php echo $JobDefaults_view->NumericValue->viewAttributes() ?>><?php echo $JobDefaults_view->NumericValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaults_view->AlphaValue->Visible) { // AlphaValue ?>
	<tr id="r_AlphaValue">
		<td class="<?php echo $JobDefaults_view->TableLeftColumnClass ?>"><span id="elh_JobDefaults_AlphaValue"><?php echo $JobDefaults_view->AlphaValue->caption() ?></span></td>
		<td data-name="AlphaValue" <?php echo $JobDefaults_view->AlphaValue->cellAttributes() ?>>
<span id="el_JobDefaults_AlphaValue">
<span<?php echo $JobDefaults_view->AlphaValue->viewAttributes() ?>><?php echo $JobDefaults_view->AlphaValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaults_view->LoadFromJobDefault_Idn->Visible) { // LoadFromJobDefault_Idn ?>
	<tr id="r_LoadFromJobDefault_Idn">
		<td class="<?php echo $JobDefaults_view->TableLeftColumnClass ?>"><span id="elh_JobDefaults_LoadFromJobDefault_Idn"><?php echo $JobDefaults_view->LoadFromJobDefault_Idn->caption() ?></span></td>
		<td data-name="LoadFromJobDefault_Idn" <?php echo $JobDefaults_view->LoadFromJobDefault_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_LoadFromJobDefault_Idn">
<span<?php echo $JobDefaults_view->LoadFromJobDefault_Idn->viewAttributes() ?>><?php echo $JobDefaults_view->LoadFromJobDefault_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaults_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $JobDefaults_view->TableLeftColumnClass ?>"><span id="elh_JobDefaults_Rank"><?php echo $JobDefaults_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $JobDefaults_view->Rank->cellAttributes() ?>>
<span id="el_JobDefaults_Rank">
<span<?php echo $JobDefaults_view->Rank->viewAttributes() ?>><?php echo $JobDefaults_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaults_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $JobDefaults_view->TableLeftColumnClass ?>"><span id="elh_JobDefaults_ActiveFlag"><?php echo $JobDefaults_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $JobDefaults_view->ActiveFlag->cellAttributes() ?>>
<span id="el_JobDefaults_ActiveFlag">
<span<?php echo $JobDefaults_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobDefaults_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobDefaults_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$JobDefaults_view->IsModal) { ?>
<?php if (!$JobDefaults_view->isExport()) { ?>
<?php echo $JobDefaults_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$JobDefaults_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$JobDefaults_view->isExport()) { ?>
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
$JobDefaults_view->terminate();
?>