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
$EngineeringAdditionalCosts_view = new EngineeringAdditionalCosts_view();

// Run the page
$EngineeringAdditionalCosts_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$EngineeringAdditionalCosts_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$EngineeringAdditionalCosts_view->isExport()) { ?>
<script>
var fEngineeringAdditionalCostsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fEngineeringAdditionalCostsview = currentForm = new ew.Form("fEngineeringAdditionalCostsview", "view");
	loadjs.done("fEngineeringAdditionalCostsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$EngineeringAdditionalCosts_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $EngineeringAdditionalCosts_view->ExportOptions->render("body") ?>
<?php $EngineeringAdditionalCosts_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $EngineeringAdditionalCosts_view->showPageHeader(); ?>
<?php
$EngineeringAdditionalCosts_view->showMessage();
?>
<?php if (!$EngineeringAdditionalCosts_view->IsModal) { ?>
<?php if (!$EngineeringAdditionalCosts_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $EngineeringAdditionalCosts_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fEngineeringAdditionalCostsview" id="fEngineeringAdditionalCostsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="EngineeringAdditionalCosts">
<input type="hidden" name="modal" value="<?php echo (int)$EngineeringAdditionalCosts_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($EngineeringAdditionalCosts_view->EngineeringAdditionalCost_Idn->Visible) { // EngineeringAdditionalCost_Idn ?>
	<tr id="r_EngineeringAdditionalCost_Idn">
		<td class="<?php echo $EngineeringAdditionalCosts_view->TableLeftColumnClass ?>"><span id="elh_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn"><?php echo $EngineeringAdditionalCosts_view->EngineeringAdditionalCost_Idn->caption() ?></span></td>
		<td data-name="EngineeringAdditionalCost_Idn" <?php echo $EngineeringAdditionalCosts_view->EngineeringAdditionalCost_Idn->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn">
<span<?php echo $EngineeringAdditionalCosts_view->EngineeringAdditionalCost_Idn->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_view->EngineeringAdditionalCost_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_view->LineNumber->Visible) { // LineNumber ?>
	<tr id="r_LineNumber">
		<td class="<?php echo $EngineeringAdditionalCosts_view->TableLeftColumnClass ?>"><span id="elh_EngineeringAdditionalCosts_LineNumber"><?php echo $EngineeringAdditionalCosts_view->LineNumber->caption() ?></span></td>
		<td data-name="LineNumber" <?php echo $EngineeringAdditionalCosts_view->LineNumber->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_LineNumber">
<span<?php echo $EngineeringAdditionalCosts_view->LineNumber->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_view->LineNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_view->Quantity->Visible) { // Quantity ?>
	<tr id="r_Quantity">
		<td class="<?php echo $EngineeringAdditionalCosts_view->TableLeftColumnClass ?>"><span id="elh_EngineeringAdditionalCosts_Quantity"><?php echo $EngineeringAdditionalCosts_view->Quantity->caption() ?></span></td>
		<td data-name="Quantity" <?php echo $EngineeringAdditionalCosts_view->Quantity->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Quantity">
<span<?php echo $EngineeringAdditionalCosts_view->Quantity->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_view->Quantity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $EngineeringAdditionalCosts_view->TableLeftColumnClass ?>"><span id="elh_EngineeringAdditionalCosts_Name"><?php echo $EngineeringAdditionalCosts_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $EngineeringAdditionalCosts_view->Name->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Name">
<span<?php echo $EngineeringAdditionalCosts_view->Name->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_view->ManHours->Visible) { // ManHours ?>
	<tr id="r_ManHours">
		<td class="<?php echo $EngineeringAdditionalCosts_view->TableLeftColumnClass ?>"><span id="elh_EngineeringAdditionalCosts_ManHours"><?php echo $EngineeringAdditionalCosts_view->ManHours->caption() ?></span></td>
		<td data-name="ManHours" <?php echo $EngineeringAdditionalCosts_view->ManHours->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_ManHours">
<span<?php echo $EngineeringAdditionalCosts_view->ManHours->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_view->ManHours->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $EngineeringAdditionalCosts_view->TableLeftColumnClass ?>"><span id="elh_EngineeringAdditionalCosts_Rank"><?php echo $EngineeringAdditionalCosts_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $EngineeringAdditionalCosts_view->Rank->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Rank">
<span<?php echo $EngineeringAdditionalCosts_view->Rank->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_view->Parent_Idn->Visible) { // Parent_Idn ?>
	<tr id="r_Parent_Idn">
		<td class="<?php echo $EngineeringAdditionalCosts_view->TableLeftColumnClass ?>"><span id="elh_EngineeringAdditionalCosts_Parent_Idn"><?php echo $EngineeringAdditionalCosts_view->Parent_Idn->caption() ?></span></td>
		<td data-name="Parent_Idn" <?php echo $EngineeringAdditionalCosts_view->Parent_Idn->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Parent_Idn">
<span<?php echo $EngineeringAdditionalCosts_view->Parent_Idn->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_view->Parent_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_view->DefaultFlag->Visible) { // DefaultFlag ?>
	<tr id="r_DefaultFlag">
		<td class="<?php echo $EngineeringAdditionalCosts_view->TableLeftColumnClass ?>"><span id="elh_EngineeringAdditionalCosts_DefaultFlag"><?php echo $EngineeringAdditionalCosts_view->DefaultFlag->caption() ?></span></td>
		<td data-name="DefaultFlag" <?php echo $EngineeringAdditionalCosts_view->DefaultFlag->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_DefaultFlag">
<span<?php echo $EngineeringAdditionalCosts_view->DefaultFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DefaultFlag" class="custom-control-input" value="<?php echo $EngineeringAdditionalCosts_view->DefaultFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($EngineeringAdditionalCosts_view->DefaultFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DefaultFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$EngineeringAdditionalCosts_view->IsModal) { ?>
<?php if (!$EngineeringAdditionalCosts_view->isExport()) { ?>
<?php echo $EngineeringAdditionalCosts_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$EngineeringAdditionalCosts_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$EngineeringAdditionalCosts_view->isExport()) { ?>
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
$EngineeringAdditionalCosts_view->terminate();
?>