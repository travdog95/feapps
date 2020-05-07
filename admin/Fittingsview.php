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
$Fittings_view = new Fittings_view();

// Run the page
$Fittings_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Fittings_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Fittings_view->isExport()) { ?>
<script>
var fFittingsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fFittingsview = currentForm = new ew.Form("fFittingsview", "view");
	loadjs.done("fFittingsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Fittings_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Fittings_view->ExportOptions->render("body") ?>
<?php $Fittings_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Fittings_view->showPageHeader(); ?>
<?php
$Fittings_view->showMessage();
?>
<?php if (!$Fittings_view->IsModal) { ?>
<?php if (!$Fittings_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Fittings_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fFittingsview" id="fFittingsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Fittings">
<input type="hidden" name="modal" value="<?php echo (int)$Fittings_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Fittings_view->Fitting_Idn->Visible) { // Fitting_Idn ?>
	<tr id="r_Fitting_Idn">
		<td class="<?php echo $Fittings_view->TableLeftColumnClass ?>"><span id="elh_Fittings_Fitting_Idn"><?php echo $Fittings_view->Fitting_Idn->caption() ?></span></td>
		<td data-name="Fitting_Idn" <?php echo $Fittings_view->Fitting_Idn->cellAttributes() ?>>
<span id="el_Fittings_Fitting_Idn">
<span<?php echo $Fittings_view->Fitting_Idn->viewAttributes() ?>><?php echo $Fittings_view->Fitting_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Fittings_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $Fittings_view->TableLeftColumnClass ?>"><span id="elh_Fittings_Name"><?php echo $Fittings_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $Fittings_view->Name->cellAttributes() ?>>
<span id="el_Fittings_Name">
<span<?php echo $Fittings_view->Name->viewAttributes() ?>><?php echo $Fittings_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Fittings_view->Department_Idn->Visible) { // Department_Idn ?>
	<tr id="r_Department_Idn">
		<td class="<?php echo $Fittings_view->TableLeftColumnClass ?>"><span id="elh_Fittings_Department_Idn"><?php echo $Fittings_view->Department_Idn->caption() ?></span></td>
		<td data-name="Department_Idn" <?php echo $Fittings_view->Department_Idn->cellAttributes() ?>>
<span id="el_Fittings_Department_Idn">
<span<?php echo $Fittings_view->Department_Idn->viewAttributes() ?>><?php echo $Fittings_view->Department_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Fittings_view->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<tr id="r_WorksheetMaster_Idn">
		<td class="<?php echo $Fittings_view->TableLeftColumnClass ?>"><span id="elh_Fittings_WorksheetMaster_Idn"><?php echo $Fittings_view->WorksheetMaster_Idn->caption() ?></span></td>
		<td data-name="WorksheetMaster_Idn" <?php echo $Fittings_view->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_Fittings_WorksheetMaster_Idn">
<span<?php echo $Fittings_view->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $Fittings_view->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Fittings_view->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<tr id="r_WorksheetCategory_Idn">
		<td class="<?php echo $Fittings_view->TableLeftColumnClass ?>"><span id="elh_Fittings_WorksheetCategory_Idn"><?php echo $Fittings_view->WorksheetCategory_Idn->caption() ?></span></td>
		<td data-name="WorksheetCategory_Idn" <?php echo $Fittings_view->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el_Fittings_WorksheetCategory_Idn">
<span<?php echo $Fittings_view->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $Fittings_view->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Fittings_view->PartOfSetFlag->Visible) { // PartOfSetFlag ?>
	<tr id="r_PartOfSetFlag">
		<td class="<?php echo $Fittings_view->TableLeftColumnClass ?>"><span id="elh_Fittings_PartOfSetFlag"><?php echo $Fittings_view->PartOfSetFlag->caption() ?></span></td>
		<td data-name="PartOfSetFlag" <?php echo $Fittings_view->PartOfSetFlag->cellAttributes() ?>>
<span id="el_Fittings_PartOfSetFlag">
<span<?php echo $Fittings_view->PartOfSetFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_PartOfSetFlag" class="custom-control-input" value="<?php echo $Fittings_view->PartOfSetFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Fittings_view->PartOfSetFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_PartOfSetFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Fittings_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $Fittings_view->TableLeftColumnClass ?>"><span id="elh_Fittings_Rank"><?php echo $Fittings_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $Fittings_view->Rank->cellAttributes() ?>>
<span id="el_Fittings_Rank">
<span<?php echo $Fittings_view->Rank->viewAttributes() ?>><?php echo $Fittings_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Fittings_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $Fittings_view->TableLeftColumnClass ?>"><span id="elh_Fittings_ActiveFlag"><?php echo $Fittings_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $Fittings_view->ActiveFlag->cellAttributes() ?>>
<span id="el_Fittings_ActiveFlag">
<span<?php echo $Fittings_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Fittings_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Fittings_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$Fittings_view->IsModal) { ?>
<?php if (!$Fittings_view->isExport()) { ?>
<?php echo $Fittings_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$Fittings_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Fittings_view->isExport()) { ?>
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
$Fittings_view->terminate();
?>