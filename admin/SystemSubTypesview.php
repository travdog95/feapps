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
$SystemSubTypes_view = new SystemSubTypes_view();

// Run the page
$SystemSubTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SystemSubTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$SystemSubTypes_view->isExport()) { ?>
<script>
var fSystemSubTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fSystemSubTypesview = currentForm = new ew.Form("fSystemSubTypesview", "view");
	loadjs.done("fSystemSubTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$SystemSubTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $SystemSubTypes_view->ExportOptions->render("body") ?>
<?php $SystemSubTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $SystemSubTypes_view->showPageHeader(); ?>
<?php
$SystemSubTypes_view->showMessage();
?>
<?php if (!$SystemSubTypes_view->IsModal) { ?>
<?php if (!$SystemSubTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $SystemSubTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fSystemSubTypesview" id="fSystemSubTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SystemSubTypes">
<input type="hidden" name="modal" value="<?php echo (int)$SystemSubTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($SystemSubTypes_view->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
	<tr id="r_SystemSubType_Idn">
		<td class="<?php echo $SystemSubTypes_view->TableLeftColumnClass ?>"><span id="elh_SystemSubTypes_SystemSubType_Idn"><?php echo $SystemSubTypes_view->SystemSubType_Idn->caption() ?></span></td>
		<td data-name="SystemSubType_Idn" <?php echo $SystemSubTypes_view->SystemSubType_Idn->cellAttributes() ?>>
<span id="el_SystemSubTypes_SystemSubType_Idn">
<span<?php echo $SystemSubTypes_view->SystemSubType_Idn->viewAttributes() ?>><?php echo $SystemSubTypes_view->SystemSubType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($SystemSubTypes_view->SystemType_Idn->Visible) { // SystemType_Idn ?>
	<tr id="r_SystemType_Idn">
		<td class="<?php echo $SystemSubTypes_view->TableLeftColumnClass ?>"><span id="elh_SystemSubTypes_SystemType_Idn"><?php echo $SystemSubTypes_view->SystemType_Idn->caption() ?></span></td>
		<td data-name="SystemType_Idn" <?php echo $SystemSubTypes_view->SystemType_Idn->cellAttributes() ?>>
<span id="el_SystemSubTypes_SystemType_Idn">
<span<?php echo $SystemSubTypes_view->SystemType_Idn->viewAttributes() ?>><?php echo $SystemSubTypes_view->SystemType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($SystemSubTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $SystemSubTypes_view->TableLeftColumnClass ?>"><span id="elh_SystemSubTypes_Name"><?php echo $SystemSubTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $SystemSubTypes_view->Name->cellAttributes() ?>>
<span id="el_SystemSubTypes_Name">
<span<?php echo $SystemSubTypes_view->Name->viewAttributes() ?>><?php echo $SystemSubTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($SystemSubTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $SystemSubTypes_view->TableLeftColumnClass ?>"><span id="elh_SystemSubTypes_Rank"><?php echo $SystemSubTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $SystemSubTypes_view->Rank->cellAttributes() ?>>
<span id="el_SystemSubTypes_Rank">
<span<?php echo $SystemSubTypes_view->Rank->viewAttributes() ?>><?php echo $SystemSubTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($SystemSubTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $SystemSubTypes_view->TableLeftColumnClass ?>"><span id="elh_SystemSubTypes_ActiveFlag"><?php echo $SystemSubTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $SystemSubTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_SystemSubTypes_ActiveFlag">
<span<?php echo $SystemSubTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $SystemSubTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($SystemSubTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$SystemSubTypes_view->IsModal) { ?>
<?php if (!$SystemSubTypes_view->isExport()) { ?>
<?php echo $SystemSubTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$SystemSubTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$SystemSubTypes_view->isExport()) { ?>
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
$SystemSubTypes_view->terminate();
?>