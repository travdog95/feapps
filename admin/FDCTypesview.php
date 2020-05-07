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
$FDCTypes_view = new FDCTypes_view();

// Run the page
$FDCTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FDCTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$FDCTypes_view->isExport()) { ?>
<script>
var fFDCTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fFDCTypesview = currentForm = new ew.Form("fFDCTypesview", "view");
	loadjs.done("fFDCTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$FDCTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $FDCTypes_view->ExportOptions->render("body") ?>
<?php $FDCTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $FDCTypes_view->showPageHeader(); ?>
<?php
$FDCTypes_view->showMessage();
?>
<?php if (!$FDCTypes_view->IsModal) { ?>
<?php if (!$FDCTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FDCTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fFDCTypesview" id="fFDCTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FDCTypes">
<input type="hidden" name="modal" value="<?php echo (int)$FDCTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($FDCTypes_view->FdcType_Idn->Visible) { // FdcType_Idn ?>
	<tr id="r_FdcType_Idn">
		<td class="<?php echo $FDCTypes_view->TableLeftColumnClass ?>"><span id="elh_FDCTypes_FdcType_Idn"><?php echo $FDCTypes_view->FdcType_Idn->caption() ?></span></td>
		<td data-name="FdcType_Idn" <?php echo $FDCTypes_view->FdcType_Idn->cellAttributes() ?>>
<span id="el_FDCTypes_FdcType_Idn">
<span<?php echo $FDCTypes_view->FdcType_Idn->viewAttributes() ?>><?php echo $FDCTypes_view->FdcType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FDCTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $FDCTypes_view->TableLeftColumnClass ?>"><span id="elh_FDCTypes_Name"><?php echo $FDCTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $FDCTypes_view->Name->cellAttributes() ?>>
<span id="el_FDCTypes_Name">
<span<?php echo $FDCTypes_view->Name->viewAttributes() ?>><?php echo $FDCTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FDCTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $FDCTypes_view->TableLeftColumnClass ?>"><span id="elh_FDCTypes_Rank"><?php echo $FDCTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $FDCTypes_view->Rank->cellAttributes() ?>>
<span id="el_FDCTypes_Rank">
<span<?php echo $FDCTypes_view->Rank->viewAttributes() ?>><?php echo $FDCTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FDCTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $FDCTypes_view->TableLeftColumnClass ?>"><span id="elh_FDCTypes_ActiveFlag"><?php echo $FDCTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $FDCTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_FDCTypes_ActiveFlag">
<span<?php echo $FDCTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FDCTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FDCTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$FDCTypes_view->IsModal) { ?>
<?php if (!$FDCTypes_view->isExport()) { ?>
<?php echo $FDCTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$FDCTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$FDCTypes_view->isExport()) { ?>
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
$FDCTypes_view->terminate();
?>