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
$RecapCells_view = new RecapCells_view();

// Run the page
$RecapCells_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapCells_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$RecapCells_view->isExport()) { ?>
<script>
var fRecapCellsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fRecapCellsview = currentForm = new ew.Form("fRecapCellsview", "view");
	loadjs.done("fRecapCellsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$RecapCells_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $RecapCells_view->ExportOptions->render("body") ?>
<?php $RecapCells_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $RecapCells_view->showPageHeader(); ?>
<?php
$RecapCells_view->showMessage();
?>
<?php if (!$RecapCells_view->IsModal) { ?>
<?php if (!$RecapCells_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapCells_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fRecapCellsview" id="fRecapCellsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapCells">
<input type="hidden" name="modal" value="<?php echo (int)$RecapCells_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($RecapCells_view->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
	<tr id="r_WorksheetColumn_Idn">
		<td class="<?php echo $RecapCells_view->TableLeftColumnClass ?>"><span id="elh_RecapCells_WorksheetColumn_Idn"><?php echo $RecapCells_view->WorksheetColumn_Idn->caption() ?></span></td>
		<td data-name="WorksheetColumn_Idn" <?php echo $RecapCells_view->WorksheetColumn_Idn->cellAttributes() ?>>
<span id="el_RecapCells_WorksheetColumn_Idn">
<span<?php echo $RecapCells_view->WorksheetColumn_Idn->viewAttributes() ?>><?php echo $RecapCells_view->WorksheetColumn_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RecapCells_view->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
	<tr id="r_RecapRow_Idn">
		<td class="<?php echo $RecapCells_view->TableLeftColumnClass ?>"><span id="elh_RecapCells_RecapRow_Idn"><?php echo $RecapCells_view->RecapRow_Idn->caption() ?></span></td>
		<td data-name="RecapRow_Idn" <?php echo $RecapCells_view->RecapRow_Idn->cellAttributes() ?>>
<span id="el_RecapCells_RecapRow_Idn">
<span<?php echo $RecapCells_view->RecapRow_Idn->viewAttributes() ?>><?php echo $RecapCells_view->RecapRow_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RecapCells_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $RecapCells_view->TableLeftColumnClass ?>"><span id="elh_RecapCells_ActiveFlag"><?php echo $RecapCells_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $RecapCells_view->ActiveFlag->cellAttributes() ?>>
<span id="el_RecapCells_ActiveFlag">
<span<?php echo $RecapCells_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $RecapCells_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapCells_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$RecapCells_view->IsModal) { ?>
<?php if (!$RecapCells_view->isExport()) { ?>
<?php echo $RecapCells_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$RecapCells_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$RecapCells_view->isExport()) { ?>
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
$RecapCells_view->terminate();
?>