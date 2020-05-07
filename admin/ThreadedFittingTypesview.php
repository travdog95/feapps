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
$ThreadedFittingTypes_view = new ThreadedFittingTypes_view();

// Run the page
$ThreadedFittingTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ThreadedFittingTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ThreadedFittingTypes_view->isExport()) { ?>
<script>
var fThreadedFittingTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fThreadedFittingTypesview = currentForm = new ew.Form("fThreadedFittingTypesview", "view");
	loadjs.done("fThreadedFittingTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ThreadedFittingTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ThreadedFittingTypes_view->ExportOptions->render("body") ?>
<?php $ThreadedFittingTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ThreadedFittingTypes_view->showPageHeader(); ?>
<?php
$ThreadedFittingTypes_view->showMessage();
?>
<?php if (!$ThreadedFittingTypes_view->IsModal) { ?>
<?php if (!$ThreadedFittingTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ThreadedFittingTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fThreadedFittingTypesview" id="fThreadedFittingTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ThreadedFittingTypes">
<input type="hidden" name="modal" value="<?php echo (int)$ThreadedFittingTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ThreadedFittingTypes_view->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
	<tr id="r_ThreadedFittingType_Idn">
		<td class="<?php echo $ThreadedFittingTypes_view->TableLeftColumnClass ?>"><span id="elh_ThreadedFittingTypes_ThreadedFittingType_Idn"><?php echo $ThreadedFittingTypes_view->ThreadedFittingType_Idn->caption() ?></span></td>
		<td data-name="ThreadedFittingType_Idn" <?php echo $ThreadedFittingTypes_view->ThreadedFittingType_Idn->cellAttributes() ?>>
<span id="el_ThreadedFittingTypes_ThreadedFittingType_Idn">
<span<?php echo $ThreadedFittingTypes_view->ThreadedFittingType_Idn->viewAttributes() ?>><?php echo $ThreadedFittingTypes_view->ThreadedFittingType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ThreadedFittingTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $ThreadedFittingTypes_view->TableLeftColumnClass ?>"><span id="elh_ThreadedFittingTypes_Name"><?php echo $ThreadedFittingTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $ThreadedFittingTypes_view->Name->cellAttributes() ?>>
<span id="el_ThreadedFittingTypes_Name">
<span<?php echo $ThreadedFittingTypes_view->Name->viewAttributes() ?>><?php echo $ThreadedFittingTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ThreadedFittingTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $ThreadedFittingTypes_view->TableLeftColumnClass ?>"><span id="elh_ThreadedFittingTypes_Rank"><?php echo $ThreadedFittingTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $ThreadedFittingTypes_view->Rank->cellAttributes() ?>>
<span id="el_ThreadedFittingTypes_Rank">
<span<?php echo $ThreadedFittingTypes_view->Rank->viewAttributes() ?>><?php echo $ThreadedFittingTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ThreadedFittingTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $ThreadedFittingTypes_view->TableLeftColumnClass ?>"><span id="elh_ThreadedFittingTypes_ActiveFlag"><?php echo $ThreadedFittingTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $ThreadedFittingTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_ThreadedFittingTypes_ActiveFlag">
<span<?php echo $ThreadedFittingTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ThreadedFittingTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ThreadedFittingTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ThreadedFittingTypes_view->IsModal) { ?>
<?php if (!$ThreadedFittingTypes_view->isExport()) { ?>
<?php echo $ThreadedFittingTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ThreadedFittingTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ThreadedFittingTypes_view->isExport()) { ?>
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
$ThreadedFittingTypes_view->terminate();
?>