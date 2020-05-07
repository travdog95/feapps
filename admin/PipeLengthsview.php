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
$PipeLengths_view = new PipeLengths_view();

// Run the page
$PipeLengths_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeLengths_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$PipeLengths_view->isExport()) { ?>
<script>
var fPipeLengthsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fPipeLengthsview = currentForm = new ew.Form("fPipeLengthsview", "view");
	loadjs.done("fPipeLengthsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$PipeLengths_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $PipeLengths_view->ExportOptions->render("body") ?>
<?php $PipeLengths_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $PipeLengths_view->showPageHeader(); ?>
<?php
$PipeLengths_view->showMessage();
?>
<?php if (!$PipeLengths_view->IsModal) { ?>
<?php if (!$PipeLengths_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PipeLengths_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fPipeLengthsview" id="fPipeLengthsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeLengths">
<input type="hidden" name="modal" value="<?php echo (int)$PipeLengths_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($PipeLengths_view->PipeLength_Idn->Visible) { // PipeLength_Idn ?>
	<tr id="r_PipeLength_Idn">
		<td class="<?php echo $PipeLengths_view->TableLeftColumnClass ?>"><span id="elh_PipeLengths_PipeLength_Idn"><?php echo $PipeLengths_view->PipeLength_Idn->caption() ?></span></td>
		<td data-name="PipeLength_Idn" <?php echo $PipeLengths_view->PipeLength_Idn->cellAttributes() ?>>
<span id="el_PipeLengths_PipeLength_Idn">
<span<?php echo $PipeLengths_view->PipeLength_Idn->viewAttributes() ?>><?php echo $PipeLengths_view->PipeLength_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeLengths_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $PipeLengths_view->TableLeftColumnClass ?>"><span id="elh_PipeLengths_Name"><?php echo $PipeLengths_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $PipeLengths_view->Name->cellAttributes() ?>>
<span id="el_PipeLengths_Name">
<span<?php echo $PipeLengths_view->Name->viewAttributes() ?>><?php echo $PipeLengths_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeLengths_view->Value->Visible) { // Value ?>
	<tr id="r_Value">
		<td class="<?php echo $PipeLengths_view->TableLeftColumnClass ?>"><span id="elh_PipeLengths_Value"><?php echo $PipeLengths_view->Value->caption() ?></span></td>
		<td data-name="Value" <?php echo $PipeLengths_view->Value->cellAttributes() ?>>
<span id="el_PipeLengths_Value">
<span<?php echo $PipeLengths_view->Value->viewAttributes() ?>><?php echo $PipeLengths_view->Value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeLengths_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $PipeLengths_view->TableLeftColumnClass ?>"><span id="elh_PipeLengths_Rank"><?php echo $PipeLengths_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $PipeLengths_view->Rank->cellAttributes() ?>>
<span id="el_PipeLengths_Rank">
<span<?php echo $PipeLengths_view->Rank->viewAttributes() ?>><?php echo $PipeLengths_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PipeLengths_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $PipeLengths_view->TableLeftColumnClass ?>"><span id="elh_PipeLengths_ActiveFlag"><?php echo $PipeLengths_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $PipeLengths_view->ActiveFlag->cellAttributes() ?>>
<span id="el_PipeLengths_ActiveFlag">
<span<?php echo $PipeLengths_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PipeLengths_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeLengths_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$PipeLengths_view->IsModal) { ?>
<?php if (!$PipeLengths_view->isExport()) { ?>
<?php echo $PipeLengths_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$PipeLengths_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$PipeLengths_view->isExport()) { ?>
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
$PipeLengths_view->terminate();
?>