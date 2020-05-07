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
$JobTypes_view = new JobTypes_view();

// Run the page
$JobTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$JobTypes_view->isExport()) { ?>
<script>
var fJobTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fJobTypesview = currentForm = new ew.Form("fJobTypesview", "view");
	loadjs.done("fJobTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$JobTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $JobTypes_view->ExportOptions->render("body") ?>
<?php $JobTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $JobTypes_view->showPageHeader(); ?>
<?php
$JobTypes_view->showMessage();
?>
<?php if (!$JobTypes_view->IsModal) { ?>
<?php if (!$JobTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fJobTypesview" id="fJobTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobTypes">
<input type="hidden" name="modal" value="<?php echo (int)$JobTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($JobTypes_view->JobType_Idn->Visible) { // JobType_Idn ?>
	<tr id="r_JobType_Idn">
		<td class="<?php echo $JobTypes_view->TableLeftColumnClass ?>"><span id="elh_JobTypes_JobType_Idn"><?php echo $JobTypes_view->JobType_Idn->caption() ?></span></td>
		<td data-name="JobType_Idn" <?php echo $JobTypes_view->JobType_Idn->cellAttributes() ?>>
<span id="el_JobTypes_JobType_Idn">
<span<?php echo $JobTypes_view->JobType_Idn->viewAttributes() ?>><?php echo $JobTypes_view->JobType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $JobTypes_view->TableLeftColumnClass ?>"><span id="elh_JobTypes_Name"><?php echo $JobTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $JobTypes_view->Name->cellAttributes() ?>>
<span id="el_JobTypes_Name">
<span<?php echo $JobTypes_view->Name->viewAttributes() ?>><?php echo $JobTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $JobTypes_view->TableLeftColumnClass ?>"><span id="elh_JobTypes_Rank"><?php echo $JobTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $JobTypes_view->Rank->cellAttributes() ?>>
<span id="el_JobTypes_Rank">
<span<?php echo $JobTypes_view->Rank->viewAttributes() ?>><?php echo $JobTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $JobTypes_view->TableLeftColumnClass ?>"><span id="elh_JobTypes_ActiveFlag"><?php echo $JobTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $JobTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_JobTypes_ActiveFlag">
<span<?php echo $JobTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$JobTypes_view->IsModal) { ?>
<?php if (!$JobTypes_view->isExport()) { ?>
<?php echo $JobTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$JobTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$JobTypes_view->isExport()) { ?>
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
$JobTypes_view->terminate();
?>