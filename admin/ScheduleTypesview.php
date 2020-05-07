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
$ScheduleTypes_view = new ScheduleTypes_view();

// Run the page
$ScheduleTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ScheduleTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ScheduleTypes_view->isExport()) { ?>
<script>
var fScheduleTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fScheduleTypesview = currentForm = new ew.Form("fScheduleTypesview", "view");
	loadjs.done("fScheduleTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ScheduleTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ScheduleTypes_view->ExportOptions->render("body") ?>
<?php $ScheduleTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ScheduleTypes_view->showPageHeader(); ?>
<?php
$ScheduleTypes_view->showMessage();
?>
<?php if (!$ScheduleTypes_view->IsModal) { ?>
<?php if (!$ScheduleTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ScheduleTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fScheduleTypesview" id="fScheduleTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ScheduleTypes">
<input type="hidden" name="modal" value="<?php echo (int)$ScheduleTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ScheduleTypes_view->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
	<tr id="r_ScheduleType_Idn">
		<td class="<?php echo $ScheduleTypes_view->TableLeftColumnClass ?>"><span id="elh_ScheduleTypes_ScheduleType_Idn"><?php echo $ScheduleTypes_view->ScheduleType_Idn->caption() ?></span></td>
		<td data-name="ScheduleType_Idn" <?php echo $ScheduleTypes_view->ScheduleType_Idn->cellAttributes() ?>>
<span id="el_ScheduleTypes_ScheduleType_Idn">
<span<?php echo $ScheduleTypes_view->ScheduleType_Idn->viewAttributes() ?>><?php echo $ScheduleTypes_view->ScheduleType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ScheduleTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $ScheduleTypes_view->TableLeftColumnClass ?>"><span id="elh_ScheduleTypes_Name"><?php echo $ScheduleTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $ScheduleTypes_view->Name->cellAttributes() ?>>
<span id="el_ScheduleTypes_Name">
<span<?php echo $ScheduleTypes_view->Name->viewAttributes() ?>><?php echo $ScheduleTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ScheduleTypes_view->ShortName->Visible) { // ShortName ?>
	<tr id="r_ShortName">
		<td class="<?php echo $ScheduleTypes_view->TableLeftColumnClass ?>"><span id="elh_ScheduleTypes_ShortName"><?php echo $ScheduleTypes_view->ShortName->caption() ?></span></td>
		<td data-name="ShortName" <?php echo $ScheduleTypes_view->ShortName->cellAttributes() ?>>
<span id="el_ScheduleTypes_ShortName">
<span<?php echo $ScheduleTypes_view->ShortName->viewAttributes() ?>><?php echo $ScheduleTypes_view->ShortName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ScheduleTypes_view->Department_Idn->Visible) { // Department_Idn ?>
	<tr id="r_Department_Idn">
		<td class="<?php echo $ScheduleTypes_view->TableLeftColumnClass ?>"><span id="elh_ScheduleTypes_Department_Idn"><?php echo $ScheduleTypes_view->Department_Idn->caption() ?></span></td>
		<td data-name="Department_Idn" <?php echo $ScheduleTypes_view->Department_Idn->cellAttributes() ?>>
<span id="el_ScheduleTypes_Department_Idn">
<span<?php echo $ScheduleTypes_view->Department_Idn->viewAttributes() ?>><?php echo $ScheduleTypes_view->Department_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ScheduleTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $ScheduleTypes_view->TableLeftColumnClass ?>"><span id="elh_ScheduleTypes_Rank"><?php echo $ScheduleTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $ScheduleTypes_view->Rank->cellAttributes() ?>>
<span id="el_ScheduleTypes_Rank">
<span<?php echo $ScheduleTypes_view->Rank->viewAttributes() ?>><?php echo $ScheduleTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ScheduleTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $ScheduleTypes_view->TableLeftColumnClass ?>"><span id="elh_ScheduleTypes_ActiveFlag"><?php echo $ScheduleTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $ScheduleTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_ScheduleTypes_ActiveFlag">
<span<?php echo $ScheduleTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ScheduleTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ScheduleTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ScheduleTypes_view->IsModal) { ?>
<?php if (!$ScheduleTypes_view->isExport()) { ?>
<?php echo $ScheduleTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ScheduleTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ScheduleTypes_view->isExport()) { ?>
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
$ScheduleTypes_view->terminate();
?>