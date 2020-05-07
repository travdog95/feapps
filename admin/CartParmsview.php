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
$CartParms_view = new CartParms_view();

// Run the page
$CartParms_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CartParms_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$CartParms_view->isExport()) { ?>
<script>
var fCartParmsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fCartParmsview = currentForm = new ew.Form("fCartParmsview", "view");
	loadjs.done("fCartParmsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$CartParms_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $CartParms_view->ExportOptions->render("body") ?>
<?php $CartParms_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $CartParms_view->showPageHeader(); ?>
<?php
$CartParms_view->showMessage();
?>
<?php if (!$CartParms_view->IsModal) { ?>
<?php if (!$CartParms_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $CartParms_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fCartParmsview" id="fCartParmsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CartParms">
<input type="hidden" name="modal" value="<?php echo (int)$CartParms_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($CartParms_view->CartParm_Idn->Visible) { // CartParm_Idn ?>
	<tr id="r_CartParm_Idn">
		<td class="<?php echo $CartParms_view->TableLeftColumnClass ?>"><span id="elh_CartParms_CartParm_Idn"><?php echo $CartParms_view->CartParm_Idn->caption() ?></span></td>
		<td data-name="CartParm_Idn" <?php echo $CartParms_view->CartParm_Idn->cellAttributes() ?>>
<span id="el_CartParms_CartParm_Idn">
<span<?php echo $CartParms_view->CartParm_Idn->viewAttributes() ?>><?php echo $CartParms_view->CartParm_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CartParms_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $CartParms_view->TableLeftColumnClass ?>"><span id="elh_CartParms_Name"><?php echo $CartParms_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $CartParms_view->Name->cellAttributes() ?>>
<span id="el_CartParms_Name">
<span<?php echo $CartParms_view->Name->viewAttributes() ?>><?php echo $CartParms_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CartParms_view->Department_Idn->Visible) { // Department_Idn ?>
	<tr id="r_Department_Idn">
		<td class="<?php echo $CartParms_view->TableLeftColumnClass ?>"><span id="elh_CartParms_Department_Idn"><?php echo $CartParms_view->Department_Idn->caption() ?></span></td>
		<td data-name="Department_Idn" <?php echo $CartParms_view->Department_Idn->cellAttributes() ?>>
<span id="el_CartParms_Department_Idn">
<span<?php echo $CartParms_view->Department_Idn->viewAttributes() ?>><?php echo $CartParms_view->Department_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CartParms_view->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<tr id="r_WorksheetMaster_Idn">
		<td class="<?php echo $CartParms_view->TableLeftColumnClass ?>"><span id="elh_CartParms_WorksheetMaster_Idn"><?php echo $CartParms_view->WorksheetMaster_Idn->caption() ?></span></td>
		<td data-name="WorksheetMaster_Idn" <?php echo $CartParms_view->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_CartParms_WorksheetMaster_Idn">
<span<?php echo $CartParms_view->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $CartParms_view->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CartParms_view->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<tr id="r_WorksheetCategory_Idn">
		<td class="<?php echo $CartParms_view->TableLeftColumnClass ?>"><span id="elh_CartParms_WorksheetCategory_Idn"><?php echo $CartParms_view->WorksheetCategory_Idn->caption() ?></span></td>
		<td data-name="WorksheetCategory_Idn" <?php echo $CartParms_view->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el_CartParms_WorksheetCategory_Idn">
<span<?php echo $CartParms_view->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $CartParms_view->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CartParms_view->GroupValue->Visible) { // GroupValue ?>
	<tr id="r_GroupValue">
		<td class="<?php echo $CartParms_view->TableLeftColumnClass ?>"><span id="elh_CartParms_GroupValue"><?php echo $CartParms_view->GroupValue->caption() ?></span></td>
		<td data-name="GroupValue" <?php echo $CartParms_view->GroupValue->cellAttributes() ?>>
<span id="el_CartParms_GroupValue">
<span<?php echo $CartParms_view->GroupValue->viewAttributes() ?>><?php echo $CartParms_view->GroupValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CartParms_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $CartParms_view->TableLeftColumnClass ?>"><span id="elh_CartParms_Rank"><?php echo $CartParms_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $CartParms_view->Rank->cellAttributes() ?>>
<span id="el_CartParms_Rank">
<span<?php echo $CartParms_view->Rank->viewAttributes() ?>><?php echo $CartParms_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CartParms_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $CartParms_view->TableLeftColumnClass ?>"><span id="elh_CartParms_ActiveFlag"><?php echo $CartParms_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $CartParms_view->ActiveFlag->cellAttributes() ?>>
<span id="el_CartParms_ActiveFlag">
<span<?php echo $CartParms_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $CartParms_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($CartParms_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$CartParms_view->IsModal) { ?>
<?php if (!$CartParms_view->isExport()) { ?>
<?php echo $CartParms_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$CartParms_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$CartParms_view->isExport()) { ?>
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
$CartParms_view->terminate();
?>