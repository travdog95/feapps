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
$HangerSubTypes_view = new HangerSubTypes_view();

// Run the page
$HangerSubTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HangerSubTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$HangerSubTypes_view->isExport()) { ?>
<script>
var fHangerSubTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fHangerSubTypesview = currentForm = new ew.Form("fHangerSubTypesview", "view");
	loadjs.done("fHangerSubTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$HangerSubTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $HangerSubTypes_view->ExportOptions->render("body") ?>
<?php $HangerSubTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $HangerSubTypes_view->showPageHeader(); ?>
<?php
$HangerSubTypes_view->showMessage();
?>
<?php if (!$HangerSubTypes_view->IsModal) { ?>
<?php if (!$HangerSubTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $HangerSubTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fHangerSubTypesview" id="fHangerSubTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="HangerSubTypes">
<input type="hidden" name="modal" value="<?php echo (int)$HangerSubTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($HangerSubTypes_view->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
	<tr id="r_HangerSubType_Idn">
		<td class="<?php echo $HangerSubTypes_view->TableLeftColumnClass ?>"><span id="elh_HangerSubTypes_HangerSubType_Idn"><?php echo $HangerSubTypes_view->HangerSubType_Idn->caption() ?></span></td>
		<td data-name="HangerSubType_Idn" <?php echo $HangerSubTypes_view->HangerSubType_Idn->cellAttributes() ?>>
<span id="el_HangerSubTypes_HangerSubType_Idn">
<span<?php echo $HangerSubTypes_view->HangerSubType_Idn->viewAttributes() ?>><?php echo $HangerSubTypes_view->HangerSubType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($HangerSubTypes_view->HangerType_Idn->Visible) { // HangerType_Idn ?>
	<tr id="r_HangerType_Idn">
		<td class="<?php echo $HangerSubTypes_view->TableLeftColumnClass ?>"><span id="elh_HangerSubTypes_HangerType_Idn"><?php echo $HangerSubTypes_view->HangerType_Idn->caption() ?></span></td>
		<td data-name="HangerType_Idn" <?php echo $HangerSubTypes_view->HangerType_Idn->cellAttributes() ?>>
<span id="el_HangerSubTypes_HangerType_Idn">
<span<?php echo $HangerSubTypes_view->HangerType_Idn->viewAttributes() ?>><?php echo $HangerSubTypes_view->HangerType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($HangerSubTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $HangerSubTypes_view->TableLeftColumnClass ?>"><span id="elh_HangerSubTypes_Name"><?php echo $HangerSubTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $HangerSubTypes_view->Name->cellAttributes() ?>>
<span id="el_HangerSubTypes_Name">
<span<?php echo $HangerSubTypes_view->Name->viewAttributes() ?>><?php echo $HangerSubTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($HangerSubTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $HangerSubTypes_view->TableLeftColumnClass ?>"><span id="elh_HangerSubTypes_Rank"><?php echo $HangerSubTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $HangerSubTypes_view->Rank->cellAttributes() ?>>
<span id="el_HangerSubTypes_Rank">
<span<?php echo $HangerSubTypes_view->Rank->viewAttributes() ?>><?php echo $HangerSubTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($HangerSubTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $HangerSubTypes_view->TableLeftColumnClass ?>"><span id="elh_HangerSubTypes_ActiveFlag"><?php echo $HangerSubTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $HangerSubTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_HangerSubTypes_ActiveFlag">
<span<?php echo $HangerSubTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HangerSubTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HangerSubTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$HangerSubTypes_view->IsModal) { ?>
<?php if (!$HangerSubTypes_view->isExport()) { ?>
<?php echo $HangerSubTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$HangerSubTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$HangerSubTypes_view->isExport()) { ?>
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
$HangerSubTypes_view->terminate();
?>