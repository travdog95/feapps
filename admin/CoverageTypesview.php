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
$CoverageTypes_view = new CoverageTypes_view();

// Run the page
$CoverageTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CoverageTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$CoverageTypes_view->isExport()) { ?>
<script>
var fCoverageTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fCoverageTypesview = currentForm = new ew.Form("fCoverageTypesview", "view");
	loadjs.done("fCoverageTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$CoverageTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $CoverageTypes_view->ExportOptions->render("body") ?>
<?php $CoverageTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $CoverageTypes_view->showPageHeader(); ?>
<?php
$CoverageTypes_view->showMessage();
?>
<?php if (!$CoverageTypes_view->IsModal) { ?>
<?php if (!$CoverageTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $CoverageTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fCoverageTypesview" id="fCoverageTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CoverageTypes">
<input type="hidden" name="modal" value="<?php echo (int)$CoverageTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($CoverageTypes_view->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
	<tr id="r_CoverageType_Idn">
		<td class="<?php echo $CoverageTypes_view->TableLeftColumnClass ?>"><span id="elh_CoverageTypes_CoverageType_Idn"><?php echo $CoverageTypes_view->CoverageType_Idn->caption() ?></span></td>
		<td data-name="CoverageType_Idn" <?php echo $CoverageTypes_view->CoverageType_Idn->cellAttributes() ?>>
<span id="el_CoverageTypes_CoverageType_Idn">
<span<?php echo $CoverageTypes_view->CoverageType_Idn->viewAttributes() ?>><?php echo $CoverageTypes_view->CoverageType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CoverageTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $CoverageTypes_view->TableLeftColumnClass ?>"><span id="elh_CoverageTypes_Name"><?php echo $CoverageTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $CoverageTypes_view->Name->cellAttributes() ?>>
<span id="el_CoverageTypes_Name">
<span<?php echo $CoverageTypes_view->Name->viewAttributes() ?>><?php echo $CoverageTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CoverageTypes_view->ShortName->Visible) { // ShortName ?>
	<tr id="r_ShortName">
		<td class="<?php echo $CoverageTypes_view->TableLeftColumnClass ?>"><span id="elh_CoverageTypes_ShortName"><?php echo $CoverageTypes_view->ShortName->caption() ?></span></td>
		<td data-name="ShortName" <?php echo $CoverageTypes_view->ShortName->cellAttributes() ?>>
<span id="el_CoverageTypes_ShortName">
<span<?php echo $CoverageTypes_view->ShortName->viewAttributes() ?>><?php echo $CoverageTypes_view->ShortName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CoverageTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $CoverageTypes_view->TableLeftColumnClass ?>"><span id="elh_CoverageTypes_Rank"><?php echo $CoverageTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $CoverageTypes_view->Rank->cellAttributes() ?>>
<span id="el_CoverageTypes_Rank">
<span<?php echo $CoverageTypes_view->Rank->viewAttributes() ?>><?php echo $CoverageTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CoverageTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $CoverageTypes_view->TableLeftColumnClass ?>"><span id="elh_CoverageTypes_ActiveFlag"><?php echo $CoverageTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $CoverageTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_CoverageTypes_ActiveFlag">
<span<?php echo $CoverageTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $CoverageTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($CoverageTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$CoverageTypes_view->IsModal) { ?>
<?php if (!$CoverageTypes_view->isExport()) { ?>
<?php echo $CoverageTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$CoverageTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$CoverageTypes_view->isExport()) { ?>
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
$CoverageTypes_view->terminate();
?>