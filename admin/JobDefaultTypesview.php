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
$JobDefaultTypes_view = new JobDefaultTypes_view();

// Run the page
$JobDefaultTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobDefaultTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$JobDefaultTypes_view->isExport()) { ?>
<script>
var fJobDefaultTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fJobDefaultTypesview = currentForm = new ew.Form("fJobDefaultTypesview", "view");
	loadjs.done("fJobDefaultTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$JobDefaultTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $JobDefaultTypes_view->ExportOptions->render("body") ?>
<?php $JobDefaultTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $JobDefaultTypes_view->showPageHeader(); ?>
<?php
$JobDefaultTypes_view->showMessage();
?>
<?php if (!$JobDefaultTypes_view->IsModal) { ?>
<?php if (!$JobDefaultTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobDefaultTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fJobDefaultTypesview" id="fJobDefaultTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobDefaultTypes">
<input type="hidden" name="modal" value="<?php echo (int)$JobDefaultTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($JobDefaultTypes_view->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
	<tr id="r_JobDefaultType_Idn">
		<td class="<?php echo $JobDefaultTypes_view->TableLeftColumnClass ?>"><span id="elh_JobDefaultTypes_JobDefaultType_Idn"><?php echo $JobDefaultTypes_view->JobDefaultType_Idn->caption() ?></span></td>
		<td data-name="JobDefaultType_Idn" <?php echo $JobDefaultTypes_view->JobDefaultType_Idn->cellAttributes() ?>>
<span id="el_JobDefaultTypes_JobDefaultType_Idn">
<span<?php echo $JobDefaultTypes_view->JobDefaultType_Idn->viewAttributes() ?>><?php echo $JobDefaultTypes_view->JobDefaultType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaultTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $JobDefaultTypes_view->TableLeftColumnClass ?>"><span id="elh_JobDefaultTypes_Name"><?php echo $JobDefaultTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $JobDefaultTypes_view->Name->cellAttributes() ?>>
<span id="el_JobDefaultTypes_Name">
<span<?php echo $JobDefaultTypes_view->Name->viewAttributes() ?>><?php echo $JobDefaultTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaultTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $JobDefaultTypes_view->TableLeftColumnClass ?>"><span id="elh_JobDefaultTypes_Rank"><?php echo $JobDefaultTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $JobDefaultTypes_view->Rank->cellAttributes() ?>>
<span id="el_JobDefaultTypes_Rank">
<span<?php echo $JobDefaultTypes_view->Rank->viewAttributes() ?>><?php echo $JobDefaultTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobDefaultTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $JobDefaultTypes_view->TableLeftColumnClass ?>"><span id="elh_JobDefaultTypes_ActiveFlag"><?php echo $JobDefaultTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $JobDefaultTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_JobDefaultTypes_ActiveFlag">
<span<?php echo $JobDefaultTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobDefaultTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobDefaultTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$JobDefaultTypes_view->IsModal) { ?>
<?php if (!$JobDefaultTypes_view->isExport()) { ?>
<?php echo $JobDefaultTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$JobDefaultTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$JobDefaultTypes_view->isExport()) { ?>
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
$JobDefaultTypes_view->terminate();
?>