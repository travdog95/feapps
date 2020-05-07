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
$BellTypes_view = new BellTypes_view();

// Run the page
$BellTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$BellTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$BellTypes_view->isExport()) { ?>
<script>
var fBellTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fBellTypesview = currentForm = new ew.Form("fBellTypesview", "view");
	loadjs.done("fBellTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$BellTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $BellTypes_view->ExportOptions->render("body") ?>
<?php $BellTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $BellTypes_view->showPageHeader(); ?>
<?php
$BellTypes_view->showMessage();
?>
<?php if (!$BellTypes_view->IsModal) { ?>
<?php if (!$BellTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $BellTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fBellTypesview" id="fBellTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="BellTypes">
<input type="hidden" name="modal" value="<?php echo (int)$BellTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($BellTypes_view->BellType_Idn->Visible) { // BellType_Idn ?>
	<tr id="r_BellType_Idn">
		<td class="<?php echo $BellTypes_view->TableLeftColumnClass ?>"><span id="elh_BellTypes_BellType_Idn"><?php echo $BellTypes_view->BellType_Idn->caption() ?></span></td>
		<td data-name="BellType_Idn" <?php echo $BellTypes_view->BellType_Idn->cellAttributes() ?>>
<span id="el_BellTypes_BellType_Idn">
<span<?php echo $BellTypes_view->BellType_Idn->viewAttributes() ?>><?php echo $BellTypes_view->BellType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BellTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $BellTypes_view->TableLeftColumnClass ?>"><span id="elh_BellTypes_Name"><?php echo $BellTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $BellTypes_view->Name->cellAttributes() ?>>
<span id="el_BellTypes_Name">
<span<?php echo $BellTypes_view->Name->viewAttributes() ?>><?php echo $BellTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BellTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $BellTypes_view->TableLeftColumnClass ?>"><span id="elh_BellTypes_Rank"><?php echo $BellTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $BellTypes_view->Rank->cellAttributes() ?>>
<span id="el_BellTypes_Rank">
<span<?php echo $BellTypes_view->Rank->viewAttributes() ?>><?php echo $BellTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BellTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $BellTypes_view->TableLeftColumnClass ?>"><span id="elh_BellTypes_ActiveFlag"><?php echo $BellTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $BellTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_BellTypes_ActiveFlag">
<span<?php echo $BellTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $BellTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($BellTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$BellTypes_view->IsModal) { ?>
<?php if (!$BellTypes_view->isExport()) { ?>
<?php echo $BellTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$BellTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$BellTypes_view->isExport()) { ?>
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
$BellTypes_view->terminate();
?>