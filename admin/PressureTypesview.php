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
$PressureTypes_view = new PressureTypes_view();

// Run the page
$PressureTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PressureTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$PressureTypes_view->isExport()) { ?>
<script>
var fPressureTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fPressureTypesview = currentForm = new ew.Form("fPressureTypesview", "view");
	loadjs.done("fPressureTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$PressureTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $PressureTypes_view->ExportOptions->render("body") ?>
<?php $PressureTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $PressureTypes_view->showPageHeader(); ?>
<?php
$PressureTypes_view->showMessage();
?>
<?php if (!$PressureTypes_view->IsModal) { ?>
<?php if (!$PressureTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PressureTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fPressureTypesview" id="fPressureTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PressureTypes">
<input type="hidden" name="modal" value="<?php echo (int)$PressureTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($PressureTypes_view->PressureType_Idn->Visible) { // PressureType_Idn ?>
	<tr id="r_PressureType_Idn">
		<td class="<?php echo $PressureTypes_view->TableLeftColumnClass ?>"><span id="elh_PressureTypes_PressureType_Idn"><?php echo $PressureTypes_view->PressureType_Idn->caption() ?></span></td>
		<td data-name="PressureType_Idn" <?php echo $PressureTypes_view->PressureType_Idn->cellAttributes() ?>>
<span id="el_PressureTypes_PressureType_Idn">
<span<?php echo $PressureTypes_view->PressureType_Idn->viewAttributes() ?>><?php echo $PressureTypes_view->PressureType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PressureTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $PressureTypes_view->TableLeftColumnClass ?>"><span id="elh_PressureTypes_Name"><?php echo $PressureTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $PressureTypes_view->Name->cellAttributes() ?>>
<span id="el_PressureTypes_Name">
<span<?php echo $PressureTypes_view->Name->viewAttributes() ?>><?php echo $PressureTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PressureTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $PressureTypes_view->TableLeftColumnClass ?>"><span id="elh_PressureTypes_Rank"><?php echo $PressureTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $PressureTypes_view->Rank->cellAttributes() ?>>
<span id="el_PressureTypes_Rank">
<span<?php echo $PressureTypes_view->Rank->viewAttributes() ?>><?php echo $PressureTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PressureTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $PressureTypes_view->TableLeftColumnClass ?>"><span id="elh_PressureTypes_ActiveFlag"><?php echo $PressureTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $PressureTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_PressureTypes_ActiveFlag">
<span<?php echo $PressureTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PressureTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PressureTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$PressureTypes_view->IsModal) { ?>
<?php if (!$PressureTypes_view->isExport()) { ?>
<?php echo $PressureTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$PressureTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$PressureTypes_view->isExport()) { ?>
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
$PressureTypes_view->terminate();
?>