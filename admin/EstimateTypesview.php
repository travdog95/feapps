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
$EstimateTypes_view = new EstimateTypes_view();

// Run the page
$EstimateTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$EstimateTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$EstimateTypes_view->isExport()) { ?>
<script>
var fEstimateTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fEstimateTypesview = currentForm = new ew.Form("fEstimateTypesview", "view");
	loadjs.done("fEstimateTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$EstimateTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $EstimateTypes_view->ExportOptions->render("body") ?>
<?php $EstimateTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $EstimateTypes_view->showPageHeader(); ?>
<?php
$EstimateTypes_view->showMessage();
?>
<?php if (!$EstimateTypes_view->IsModal) { ?>
<?php if (!$EstimateTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $EstimateTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fEstimateTypesview" id="fEstimateTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="EstimateTypes">
<input type="hidden" name="modal" value="<?php echo (int)$EstimateTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($EstimateTypes_view->EstimateType_Idn->Visible) { // EstimateType_Idn ?>
	<tr id="r_EstimateType_Idn">
		<td class="<?php echo $EstimateTypes_view->TableLeftColumnClass ?>"><span id="elh_EstimateTypes_EstimateType_Idn"><?php echo $EstimateTypes_view->EstimateType_Idn->caption() ?></span></td>
		<td data-name="EstimateType_Idn" <?php echo $EstimateTypes_view->EstimateType_Idn->cellAttributes() ?>>
<span id="el_EstimateTypes_EstimateType_Idn">
<span<?php echo $EstimateTypes_view->EstimateType_Idn->viewAttributes() ?>><?php echo $EstimateTypes_view->EstimateType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($EstimateTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $EstimateTypes_view->TableLeftColumnClass ?>"><span id="elh_EstimateTypes_Name"><?php echo $EstimateTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $EstimateTypes_view->Name->cellAttributes() ?>>
<span id="el_EstimateTypes_Name">
<span<?php echo $EstimateTypes_view->Name->viewAttributes() ?>><?php echo $EstimateTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($EstimateTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $EstimateTypes_view->TableLeftColumnClass ?>"><span id="elh_EstimateTypes_Rank"><?php echo $EstimateTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $EstimateTypes_view->Rank->cellAttributes() ?>>
<span id="el_EstimateTypes_Rank">
<span<?php echo $EstimateTypes_view->Rank->viewAttributes() ?>><?php echo $EstimateTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($EstimateTypes_view->Department_Idn->Visible) { // Department_Idn ?>
	<tr id="r_Department_Idn">
		<td class="<?php echo $EstimateTypes_view->TableLeftColumnClass ?>"><span id="elh_EstimateTypes_Department_Idn"><?php echo $EstimateTypes_view->Department_Idn->caption() ?></span></td>
		<td data-name="Department_Idn" <?php echo $EstimateTypes_view->Department_Idn->cellAttributes() ?>>
<span id="el_EstimateTypes_Department_Idn">
<span<?php echo $EstimateTypes_view->Department_Idn->viewAttributes() ?>><?php echo $EstimateTypes_view->Department_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($EstimateTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $EstimateTypes_view->TableLeftColumnClass ?>"><span id="elh_EstimateTypes_ActiveFlag"><?php echo $EstimateTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $EstimateTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_EstimateTypes_ActiveFlag">
<span<?php echo $EstimateTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $EstimateTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($EstimateTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$EstimateTypes_view->IsModal) { ?>
<?php if (!$EstimateTypes_view->isExport()) { ?>
<?php echo $EstimateTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$EstimateTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$EstimateTypes_view->isExport()) { ?>
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
$EstimateTypes_view->terminate();
?>