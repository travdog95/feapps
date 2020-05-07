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
$PipeTypes_view = new PipeTypes_view();

// Run the page
$PipeTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$PipeTypes_view->isExport()) { ?>
<script>
var fPipeTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fPipeTypesview = currentForm = new ew.Form("fPipeTypesview", "view");
	loadjs.done("fPipeTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$PipeTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $PipeTypes_view->ExportOptions->render("body") ?>
<?php $PipeTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $PipeTypes_view->showPageHeader(); ?>
<?php
$PipeTypes_view->showMessage();
?>
<?php if (!$PipeTypes_view->IsModal) { ?>
<?php if (!$PipeTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PipeTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fPipeTypesview" id="fPipeTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeTypes">
<input type="hidden" name="modal" value="<?php echo (int)$PipeTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($PipeTypes_view->PipeType_Idn->Visible) { // PipeType_Idn ?>
	<tr id="r_PipeType_Idn">
		<td class="<?php echo $PipeTypes_view->TableLeftColumnClass ?>"><span id="elh_PipeTypes_PipeType_Idn"><?php echo $PipeTypes_view->PipeType_Idn->caption() ?></span></td>
		<td data-name="PipeType_Idn" <?php echo $PipeTypes_view->PipeType_Idn->cellAttributes() ?>>
<span id="el_PipeTypes_PipeType_Idn">
<span<?php echo $PipeTypes_view->PipeType_Idn->viewAttributes() ?>><?php echo $PipeTypes_view->PipeType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $PipeTypes_view->TableLeftColumnClass ?>"><span id="elh_PipeTypes_Name"><?php echo $PipeTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $PipeTypes_view->Name->cellAttributes() ?>>
<span id="el_PipeTypes_Name">
<span<?php echo $PipeTypes_view->Name->viewAttributes() ?>><?php echo $PipeTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeTypes_view->Department_Idn->Visible) { // Department_Idn ?>
	<tr id="r_Department_Idn">
		<td class="<?php echo $PipeTypes_view->TableLeftColumnClass ?>"><span id="elh_PipeTypes_Department_Idn"><?php echo $PipeTypes_view->Department_Idn->caption() ?></span></td>
		<td data-name="Department_Idn" <?php echo $PipeTypes_view->Department_Idn->cellAttributes() ?>>
<span id="el_PipeTypes_Department_Idn">
<span<?php echo $PipeTypes_view->Department_Idn->viewAttributes() ?>><?php echo $PipeTypes_view->Department_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeTypes_view->IsUnderground->Visible) { // IsUnderground ?>
	<tr id="r_IsUnderground">
		<td class="<?php echo $PipeTypes_view->TableLeftColumnClass ?>"><span id="elh_PipeTypes_IsUnderground"><?php echo $PipeTypes_view->IsUnderground->caption() ?></span></td>
		<td data-name="IsUnderground" <?php echo $PipeTypes_view->IsUnderground->cellAttributes() ?>>
<span id="el_PipeTypes_IsUnderground">
<span<?php echo $PipeTypes_view->IsUnderground->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsUnderground" class="custom-control-input" value="<?php echo $PipeTypes_view->IsUnderground->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeTypes_view->IsUnderground->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsUnderground"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $PipeTypes_view->TableLeftColumnClass ?>"><span id="elh_PipeTypes_Rank"><?php echo $PipeTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $PipeTypes_view->Rank->cellAttributes() ?>>
<span id="el_PipeTypes_Rank">
<span<?php echo $PipeTypes_view->Rank->viewAttributes() ?>><?php echo $PipeTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $PipeTypes_view->TableLeftColumnClass ?>"><span id="elh_PipeTypes_ActiveFlag"><?php echo $PipeTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $PipeTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_PipeTypes_ActiveFlag">
<span<?php echo $PipeTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PipeTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$PipeTypes_view->IsModal) { ?>
<?php if (!$PipeTypes_view->isExport()) { ?>
<?php echo $PipeTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$PipeTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$PipeTypes_view->isExport()) { ?>
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
$PipeTypes_view->terminate();
?>