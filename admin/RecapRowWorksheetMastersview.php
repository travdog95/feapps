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
$RecapRowWorksheetMasters_view = new RecapRowWorksheetMasters_view();

// Run the page
$RecapRowWorksheetMasters_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapRowWorksheetMasters_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$RecapRowWorksheetMasters_view->isExport()) { ?>
<script>
var fRecapRowWorksheetMastersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fRecapRowWorksheetMastersview = currentForm = new ew.Form("fRecapRowWorksheetMastersview", "view");
	loadjs.done("fRecapRowWorksheetMastersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$RecapRowWorksheetMasters_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $RecapRowWorksheetMasters_view->ExportOptions->render("body") ?>
<?php $RecapRowWorksheetMasters_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $RecapRowWorksheetMasters_view->showPageHeader(); ?>
<?php
$RecapRowWorksheetMasters_view->showMessage();
?>
<?php if (!$RecapRowWorksheetMasters_view->IsModal) { ?>
<?php if (!$RecapRowWorksheetMasters_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapRowWorksheetMasters_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fRecapRowWorksheetMastersview" id="fRecapRowWorksheetMastersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapRowWorksheetMasters">
<input type="hidden" name="modal" value="<?php echo (int)$RecapRowWorksheetMasters_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($RecapRowWorksheetMasters_view->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
	<tr id="r_RecapRow_Idn">
		<td class="<?php echo $RecapRowWorksheetMasters_view->TableLeftColumnClass ?>"><span id="elh_RecapRowWorksheetMasters_RecapRow_Idn"><?php echo $RecapRowWorksheetMasters_view->RecapRow_Idn->caption() ?></span></td>
		<td data-name="RecapRow_Idn" <?php echo $RecapRowWorksheetMasters_view->RecapRow_Idn->cellAttributes() ?>>
<span id="el_RecapRowWorksheetMasters_RecapRow_Idn">
<span<?php echo $RecapRowWorksheetMasters_view->RecapRow_Idn->viewAttributes() ?>><?php echo $RecapRowWorksheetMasters_view->RecapRow_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($RecapRowWorksheetMasters_view->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<tr id="r_WorksheetMaster_Idn">
		<td class="<?php echo $RecapRowWorksheetMasters_view->TableLeftColumnClass ?>"><span id="elh_RecapRowWorksheetMasters_WorksheetMaster_Idn"><?php echo $RecapRowWorksheetMasters_view->WorksheetMaster_Idn->caption() ?></span></td>
		<td data-name="WorksheetMaster_Idn" <?php echo $RecapRowWorksheetMasters_view->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_RecapRowWorksheetMasters_WorksheetMaster_Idn">
<span<?php echo $RecapRowWorksheetMasters_view->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $RecapRowWorksheetMasters_view->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$RecapRowWorksheetMasters_view->IsModal) { ?>
<?php if (!$RecapRowWorksheetMasters_view->isExport()) { ?>
<?php echo $RecapRowWorksheetMasters_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$RecapRowWorksheetMasters_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$RecapRowWorksheetMasters_view->isExport()) { ?>
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
$RecapRowWorksheetMasters_view->terminate();
?>