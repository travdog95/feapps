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
$FinishTypes_view = new FinishTypes_view();

// Run the page
$FinishTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FinishTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$FinishTypes_view->isExport()) { ?>
<script>
var fFinishTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fFinishTypesview = currentForm = new ew.Form("fFinishTypesview", "view");
	loadjs.done("fFinishTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$FinishTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $FinishTypes_view->ExportOptions->render("body") ?>
<?php $FinishTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $FinishTypes_view->showPageHeader(); ?>
<?php
$FinishTypes_view->showMessage();
?>
<?php if (!$FinishTypes_view->IsModal) { ?>
<?php if (!$FinishTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FinishTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fFinishTypesview" id="fFinishTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FinishTypes">
<input type="hidden" name="modal" value="<?php echo (int)$FinishTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($FinishTypes_view->FinishType_Idn->Visible) { // FinishType_Idn ?>
	<tr id="r_FinishType_Idn">
		<td class="<?php echo $FinishTypes_view->TableLeftColumnClass ?>"><span id="elh_FinishTypes_FinishType_Idn"><?php echo $FinishTypes_view->FinishType_Idn->caption() ?></span></td>
		<td data-name="FinishType_Idn" <?php echo $FinishTypes_view->FinishType_Idn->cellAttributes() ?>>
<span id="el_FinishTypes_FinishType_Idn">
<span<?php echo $FinishTypes_view->FinishType_Idn->viewAttributes() ?>><?php echo $FinishTypes_view->FinishType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FinishTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $FinishTypes_view->TableLeftColumnClass ?>"><span id="elh_FinishTypes_Name"><?php echo $FinishTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $FinishTypes_view->Name->cellAttributes() ?>>
<span id="el_FinishTypes_Name">
<span<?php echo $FinishTypes_view->Name->viewAttributes() ?>><?php echo $FinishTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FinishTypes_view->ShortName->Visible) { // ShortName ?>
	<tr id="r_ShortName">
		<td class="<?php echo $FinishTypes_view->TableLeftColumnClass ?>"><span id="elh_FinishTypes_ShortName"><?php echo $FinishTypes_view->ShortName->caption() ?></span></td>
		<td data-name="ShortName" <?php echo $FinishTypes_view->ShortName->cellAttributes() ?>>
<span id="el_FinishTypes_ShortName">
<span<?php echo $FinishTypes_view->ShortName->viewAttributes() ?>><?php echo $FinishTypes_view->ShortName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FinishTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $FinishTypes_view->TableLeftColumnClass ?>"><span id="elh_FinishTypes_Rank"><?php echo $FinishTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $FinishTypes_view->Rank->cellAttributes() ?>>
<span id="el_FinishTypes_Rank">
<span<?php echo $FinishTypes_view->Rank->viewAttributes() ?>><?php echo $FinishTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FinishTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $FinishTypes_view->TableLeftColumnClass ?>"><span id="elh_FinishTypes_ActiveFlag"><?php echo $FinishTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $FinishTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_FinishTypes_ActiveFlag">
<span<?php echo $FinishTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FinishTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FinishTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$FinishTypes_view->IsModal) { ?>
<?php if (!$FinishTypes_view->isExport()) { ?>
<?php echo $FinishTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$FinishTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$FinishTypes_view->isExport()) { ?>
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
$FinishTypes_view->terminate();
?>