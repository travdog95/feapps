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
$VolumeCorrections_view = new VolumeCorrections_view();

// Run the page
$VolumeCorrections_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$VolumeCorrections_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$VolumeCorrections_view->isExport()) { ?>
<script>
var fVolumeCorrectionsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fVolumeCorrectionsview = currentForm = new ew.Form("fVolumeCorrectionsview", "view");
	loadjs.done("fVolumeCorrectionsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$VolumeCorrections_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $VolumeCorrections_view->ExportOptions->render("body") ?>
<?php $VolumeCorrections_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $VolumeCorrections_view->showPageHeader(); ?>
<?php
$VolumeCorrections_view->showMessage();
?>
<?php if (!$VolumeCorrections_view->IsModal) { ?>
<?php if (!$VolumeCorrections_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $VolumeCorrections_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fVolumeCorrectionsview" id="fVolumeCorrectionsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="VolumeCorrections">
<input type="hidden" name="modal" value="<?php echo (int)$VolumeCorrections_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($VolumeCorrections_view->VolumeCorrection_Idn->Visible) { // VolumeCorrection_Idn ?>
	<tr id="r_VolumeCorrection_Idn">
		<td class="<?php echo $VolumeCorrections_view->TableLeftColumnClass ?>"><span id="elh_VolumeCorrections_VolumeCorrection_Idn"><?php echo $VolumeCorrections_view->VolumeCorrection_Idn->caption() ?></span></td>
		<td data-name="VolumeCorrection_Idn" <?php echo $VolumeCorrections_view->VolumeCorrection_Idn->cellAttributes() ?>>
<span id="el_VolumeCorrections_VolumeCorrection_Idn">
<span<?php echo $VolumeCorrections_view->VolumeCorrection_Idn->viewAttributes() ?>><?php echo $VolumeCorrections_view->VolumeCorrection_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($VolumeCorrections_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $VolumeCorrections_view->TableLeftColumnClass ?>"><span id="elh_VolumeCorrections_Name"><?php echo $VolumeCorrections_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $VolumeCorrections_view->Name->cellAttributes() ?>>
<span id="el_VolumeCorrections_Name">
<span<?php echo $VolumeCorrections_view->Name->viewAttributes() ?>><?php echo $VolumeCorrections_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($VolumeCorrections_view->Value->Visible) { // Value ?>
	<tr id="r_Value">
		<td class="<?php echo $VolumeCorrections_view->TableLeftColumnClass ?>"><span id="elh_VolumeCorrections_Value"><?php echo $VolumeCorrections_view->Value->caption() ?></span></td>
		<td data-name="Value" <?php echo $VolumeCorrections_view->Value->cellAttributes() ?>>
<span id="el_VolumeCorrections_Value">
<span<?php echo $VolumeCorrections_view->Value->viewAttributes() ?>><?php echo $VolumeCorrections_view->Value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($VolumeCorrections_view->Hours->Visible) { // Hours ?>
	<tr id="r_Hours">
		<td class="<?php echo $VolumeCorrections_view->TableLeftColumnClass ?>"><span id="elh_VolumeCorrections_Hours"><?php echo $VolumeCorrections_view->Hours->caption() ?></span></td>
		<td data-name="Hours" <?php echo $VolumeCorrections_view->Hours->cellAttributes() ?>>
<span id="el_VolumeCorrections_Hours">
<span<?php echo $VolumeCorrections_view->Hours->viewAttributes() ?>><?php echo $VolumeCorrections_view->Hours->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($VolumeCorrections_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $VolumeCorrections_view->TableLeftColumnClass ?>"><span id="elh_VolumeCorrections_Rank"><?php echo $VolumeCorrections_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $VolumeCorrections_view->Rank->cellAttributes() ?>>
<span id="el_VolumeCorrections_Rank">
<span<?php echo $VolumeCorrections_view->Rank->viewAttributes() ?>><?php echo $VolumeCorrections_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($VolumeCorrections_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $VolumeCorrections_view->TableLeftColumnClass ?>"><span id="elh_VolumeCorrections_ActiveFlag"><?php echo $VolumeCorrections_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $VolumeCorrections_view->ActiveFlag->cellAttributes() ?>>
<span id="el_VolumeCorrections_ActiveFlag">
<span<?php echo $VolumeCorrections_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $VolumeCorrections_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($VolumeCorrections_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$VolumeCorrections_view->IsModal) { ?>
<?php if (!$VolumeCorrections_view->isExport()) { ?>
<?php echo $VolumeCorrections_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$VolumeCorrections_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$VolumeCorrections_view->isExport()) { ?>
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
$VolumeCorrections_view->terminate();
?>