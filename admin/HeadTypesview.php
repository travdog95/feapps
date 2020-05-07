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
$HeadTypes_view = new HeadTypes_view();

// Run the page
$HeadTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HeadTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$HeadTypes_view->isExport()) { ?>
<script>
var fHeadTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fHeadTypesview = currentForm = new ew.Form("fHeadTypesview", "view");
	loadjs.done("fHeadTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$HeadTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $HeadTypes_view->ExportOptions->render("body") ?>
<?php $HeadTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $HeadTypes_view->showPageHeader(); ?>
<?php
$HeadTypes_view->showMessage();
?>
<?php if (!$HeadTypes_view->IsModal) { ?>
<?php if (!$HeadTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $HeadTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fHeadTypesview" id="fHeadTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="HeadTypes">
<input type="hidden" name="modal" value="<?php echo (int)$HeadTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($HeadTypes_view->HeadType_Idn->Visible) { // HeadType_Idn ?>
	<tr id="r_HeadType_Idn">
		<td class="<?php echo $HeadTypes_view->TableLeftColumnClass ?>"><span id="elh_HeadTypes_HeadType_Idn"><?php echo $HeadTypes_view->HeadType_Idn->caption() ?></span></td>
		<td data-name="HeadType_Idn" <?php echo $HeadTypes_view->HeadType_Idn->cellAttributes() ?>>
<span id="el_HeadTypes_HeadType_Idn">
<span<?php echo $HeadTypes_view->HeadType_Idn->viewAttributes() ?>><?php echo $HeadTypes_view->HeadType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($HeadTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $HeadTypes_view->TableLeftColumnClass ?>"><span id="elh_HeadTypes_Name"><?php echo $HeadTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $HeadTypes_view->Name->cellAttributes() ?>>
<span id="el_HeadTypes_Name">
<span<?php echo $HeadTypes_view->Name->viewAttributes() ?>><?php echo $HeadTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($HeadTypes_view->ShortName->Visible) { // ShortName ?>
	<tr id="r_ShortName">
		<td class="<?php echo $HeadTypes_view->TableLeftColumnClass ?>"><span id="elh_HeadTypes_ShortName"><?php echo $HeadTypes_view->ShortName->caption() ?></span></td>
		<td data-name="ShortName" <?php echo $HeadTypes_view->ShortName->cellAttributes() ?>>
<span id="el_HeadTypes_ShortName">
<span<?php echo $HeadTypes_view->ShortName->viewAttributes() ?>><?php echo $HeadTypes_view->ShortName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($HeadTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $HeadTypes_view->TableLeftColumnClass ?>"><span id="elh_HeadTypes_Rank"><?php echo $HeadTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $HeadTypes_view->Rank->cellAttributes() ?>>
<span id="el_HeadTypes_Rank">
<span<?php echo $HeadTypes_view->Rank->viewAttributes() ?>><?php echo $HeadTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($HeadTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $HeadTypes_view->TableLeftColumnClass ?>"><span id="elh_HeadTypes_ActiveFlag"><?php echo $HeadTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $HeadTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_HeadTypes_ActiveFlag">
<span<?php echo $HeadTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HeadTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HeadTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$HeadTypes_view->IsModal) { ?>
<?php if (!$HeadTypes_view->isExport()) { ?>
<?php echo $HeadTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$HeadTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$HeadTypes_view->isExport()) { ?>
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
$HeadTypes_view->terminate();
?>