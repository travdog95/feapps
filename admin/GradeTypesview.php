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
$GradeTypes_view = new GradeTypes_view();

// Run the page
$GradeTypes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GradeTypes_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$GradeTypes_view->isExport()) { ?>
<script>
var fGradeTypesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fGradeTypesview = currentForm = new ew.Form("fGradeTypesview", "view");
	loadjs.done("fGradeTypesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$GradeTypes_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $GradeTypes_view->ExportOptions->render("body") ?>
<?php $GradeTypes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $GradeTypes_view->showPageHeader(); ?>
<?php
$GradeTypes_view->showMessage();
?>
<?php if (!$GradeTypes_view->IsModal) { ?>
<?php if (!$GradeTypes_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GradeTypes_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fGradeTypesview" id="fGradeTypesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GradeTypes">
<input type="hidden" name="modal" value="<?php echo (int)$GradeTypes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($GradeTypes_view->GradeType_Idn->Visible) { // GradeType_Idn ?>
	<tr id="r_GradeType_Idn">
		<td class="<?php echo $GradeTypes_view->TableLeftColumnClass ?>"><span id="elh_GradeTypes_GradeType_Idn"><?php echo $GradeTypes_view->GradeType_Idn->caption() ?></span></td>
		<td data-name="GradeType_Idn" <?php echo $GradeTypes_view->GradeType_Idn->cellAttributes() ?>>
<span id="el_GradeTypes_GradeType_Idn">
<span<?php echo $GradeTypes_view->GradeType_Idn->viewAttributes() ?>><?php echo $GradeTypes_view->GradeType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($GradeTypes_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $GradeTypes_view->TableLeftColumnClass ?>"><span id="elh_GradeTypes_Name"><?php echo $GradeTypes_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $GradeTypes_view->Name->cellAttributes() ?>>
<span id="el_GradeTypes_Name">
<span<?php echo $GradeTypes_view->Name->viewAttributes() ?>><?php echo $GradeTypes_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($GradeTypes_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $GradeTypes_view->TableLeftColumnClass ?>"><span id="elh_GradeTypes_Rank"><?php echo $GradeTypes_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $GradeTypes_view->Rank->cellAttributes() ?>>
<span id="el_GradeTypes_Rank">
<span<?php echo $GradeTypes_view->Rank->viewAttributes() ?>><?php echo $GradeTypes_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($GradeTypes_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $GradeTypes_view->TableLeftColumnClass ?>"><span id="elh_GradeTypes_ActiveFlag"><?php echo $GradeTypes_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $GradeTypes_view->ActiveFlag->cellAttributes() ?>>
<span id="el_GradeTypes_ActiveFlag">
<span<?php echo $GradeTypes_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $GradeTypes_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($GradeTypes_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$GradeTypes_view->IsModal) { ?>
<?php if (!$GradeTypes_view->isExport()) { ?>
<?php echo $GradeTypes_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$GradeTypes_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$GradeTypes_view->isExport()) { ?>
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
$GradeTypes_view->terminate();
?>