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
$GroovedFittingTypes_view = new GroovedFittingTypes_view();

// Run the page
$GroovedFittingTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GroovedFittingTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$GroovedFittingTypes_view->isExport()) { ?>
<script>
var fGroovedFittingTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fGroovedFittingTypesview = currentForm = new ew.Form("fGroovedFittingTypesview", "view");
	loadjs.done("fGroovedFittingTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$GroovedFittingTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $GroovedFittingTypes_view->ExportOptions->render("body") ?>
<?php $GroovedFittingTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $GroovedFittingTypes_view->showPageHeader(); ?>
<?php
$GroovedFittingTypes_view->showMessage();
?>
<?php if (!$GroovedFittingTypes_view->IsModal) { ?>
<?php if (!$GroovedFittingTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GroovedFittingTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fGroovedFittingTypesview" id="fGroovedFittingTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GroovedFittingTypes">
<input type="hidden" name="modal" value="<?php echo (int)$GroovedFittingTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($GroovedFittingTypes_view->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
	<tr id="r_GroovedFittingType_Idn">
		<td class="<?php echo $GroovedFittingTypes_view->TableLeftColumnClass ?>"><span id="elh_GroovedFittingTypes_GroovedFittingType_Idn"><?php echo $GroovedFittingTypes_view->GroovedFittingType_Idn->caption() ?></span></td>
		<td data-name="GroovedFittingType_Idn" <?php echo $GroovedFittingTypes_view->GroovedFittingType_Idn->cellAttributes() ?>>
<span id="el_GroovedFittingTypes_GroovedFittingType_Idn">
<span<?php echo $GroovedFittingTypes_view->GroovedFittingType_Idn->viewAttributes() ?>><?php echo $GroovedFittingTypes_view->GroovedFittingType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($GroovedFittingTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $GroovedFittingTypes_view->TableLeftColumnClass ?>"><span id="elh_GroovedFittingTypes_Name"><?php echo $GroovedFittingTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $GroovedFittingTypes_view->Name->cellAttributes() ?>>
<span id="el_GroovedFittingTypes_Name">
<span<?php echo $GroovedFittingTypes_view->Name->viewAttributes() ?>><?php echo $GroovedFittingTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($GroovedFittingTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $GroovedFittingTypes_view->TableLeftColumnClass ?>"><span id="elh_GroovedFittingTypes_Rank"><?php echo $GroovedFittingTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $GroovedFittingTypes_view->Rank->cellAttributes() ?>>
<span id="el_GroovedFittingTypes_Rank">
<span<?php echo $GroovedFittingTypes_view->Rank->viewAttributes() ?>><?php echo $GroovedFittingTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($GroovedFittingTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $GroovedFittingTypes_view->TableLeftColumnClass ?>"><span id="elh_GroovedFittingTypes_ActiveFlag"><?php echo $GroovedFittingTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $GroovedFittingTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_GroovedFittingTypes_ActiveFlag">
<span<?php echo $GroovedFittingTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $GroovedFittingTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($GroovedFittingTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$GroovedFittingTypes_view->IsModal) { ?>
<?php if (!$GroovedFittingTypes_view->isExport()) { ?>
<?php echo $GroovedFittingTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$GroovedFittingTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$GroovedFittingTypes_view->isExport()) { ?>
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
$GroovedFittingTypes_view->terminate();
?>