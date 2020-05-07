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
$JobStatuses_view = new JobStatuses_view();

// Run the page
$JobStatuses_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobStatuses_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$JobStatuses_view->isExport()) { ?>
<script>
var fJobStatusesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fJobStatusesview = currentForm = new ew.Form("fJobStatusesview", "view");
	loadjs.done("fJobStatusesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$JobStatuses_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $JobStatuses_view->ExportOptions->render("body") ?>
<?php $JobStatuses_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $JobStatuses_view->showPageHeader(); ?>
<?php
$JobStatuses_view->showMessage();
?>
<?php if (!$JobStatuses_view->IsModal) { ?>
<?php if (!$JobStatuses_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobStatuses_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fJobStatusesview" id="fJobStatusesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobStatuses">
<input type="hidden" name="modal" value="<?php echo (int)$JobStatuses_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($JobStatuses_view->JobStatus_Idn->Visible) { // JobStatus_Idn ?>
	<tr id="r_JobStatus_Idn">
		<td class="<?php echo $JobStatuses_view->TableLeftColumnClass ?>"><span id="elh_JobStatuses_JobStatus_Idn"><?php echo $JobStatuses_view->JobStatus_Idn->caption() ?></span></td>
		<td data-name="JobStatus_Idn" <?php echo $JobStatuses_view->JobStatus_Idn->cellAttributes() ?>>
<span id="el_JobStatuses_JobStatus_Idn">
<span<?php echo $JobStatuses_view->JobStatus_Idn->viewAttributes() ?>><?php echo $JobStatuses_view->JobStatus_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobStatuses_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $JobStatuses_view->TableLeftColumnClass ?>"><span id="elh_JobStatuses_Name"><?php echo $JobStatuses_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $JobStatuses_view->Name->cellAttributes() ?>>
<span id="el_JobStatuses_Name">
<span<?php echo $JobStatuses_view->Name->viewAttributes() ?>><?php echo $JobStatuses_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobStatuses_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $JobStatuses_view->TableLeftColumnClass ?>"><span id="elh_JobStatuses_Rank"><?php echo $JobStatuses_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $JobStatuses_view->Rank->cellAttributes() ?>>
<span id="el_JobStatuses_Rank">
<span<?php echo $JobStatuses_view->Rank->viewAttributes() ?>><?php echo $JobStatuses_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobStatuses_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $JobStatuses_view->TableLeftColumnClass ?>"><span id="elh_JobStatuses_ActiveFlag"><?php echo $JobStatuses_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $JobStatuses_view->ActiveFlag->cellAttributes() ?>>
<span id="el_JobStatuses_ActiveFlag">
<span<?php echo $JobStatuses_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobStatuses_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobStatuses_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$JobStatuses_view->IsModal) { ?>
<?php if (!$JobStatuses_view->isExport()) { ?>
<?php echo $JobStatuses_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$JobStatuses_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$JobStatuses_view->isExport()) { ?>
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
$JobStatuses_view->terminate();
?>