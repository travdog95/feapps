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
$BackflowTypes_view = new BackflowTypes_view();

// Run the page
$BackflowTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$BackflowTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$BackflowTypes_view->isExport()) { ?>
<script>
var fBackflowTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fBackflowTypesview = currentForm = new ew.Form("fBackflowTypesview", "view");
	loadjs.done("fBackflowTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$BackflowTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $BackflowTypes_view->ExportOptions->render("body") ?>
<?php $BackflowTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $BackflowTypes_view->showPageHeader(); ?>
<?php
$BackflowTypes_view->showMessage();
?>
<?php if (!$BackflowTypes_view->IsModal) { ?>
<?php if (!$BackflowTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $BackflowTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fBackflowTypesview" id="fBackflowTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="BackflowTypes">
<input type="hidden" name="modal" value="<?php echo (int)$BackflowTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($BackflowTypes_view->BackflowType_Idn->Visible) { // BackflowType_Idn ?>
	<tr id="r_BackflowType_Idn">
		<td class="<?php echo $BackflowTypes_view->TableLeftColumnClass ?>"><span id="elh_BackflowTypes_BackflowType_Idn"><?php echo $BackflowTypes_view->BackflowType_Idn->caption() ?></span></td>
		<td data-name="BackflowType_Idn" <?php echo $BackflowTypes_view->BackflowType_Idn->cellAttributes() ?>>
<span id="el_BackflowTypes_BackflowType_Idn">
<span<?php echo $BackflowTypes_view->BackflowType_Idn->viewAttributes() ?>><?php echo $BackflowTypes_view->BackflowType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BackflowTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $BackflowTypes_view->TableLeftColumnClass ?>"><span id="elh_BackflowTypes_Name"><?php echo $BackflowTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $BackflowTypes_view->Name->cellAttributes() ?>>
<span id="el_BackflowTypes_Name">
<span<?php echo $BackflowTypes_view->Name->viewAttributes() ?>><?php echo $BackflowTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BackflowTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $BackflowTypes_view->TableLeftColumnClass ?>"><span id="elh_BackflowTypes_Rank"><?php echo $BackflowTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $BackflowTypes_view->Rank->cellAttributes() ?>>
<span id="el_BackflowTypes_Rank">
<span<?php echo $BackflowTypes_view->Rank->viewAttributes() ?>><?php echo $BackflowTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($BackflowTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $BackflowTypes_view->TableLeftColumnClass ?>"><span id="elh_BackflowTypes_ActiveFlag"><?php echo $BackflowTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $BackflowTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_BackflowTypes_ActiveFlag">
<span<?php echo $BackflowTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $BackflowTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($BackflowTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$BackflowTypes_view->IsModal) { ?>
<?php if (!$BackflowTypes_view->isExport()) { ?>
<?php echo $BackflowTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$BackflowTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$BackflowTypes_view->isExport()) { ?>
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
$BackflowTypes_view->terminate();
?>