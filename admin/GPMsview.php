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
$GPMs_view = new GPMs_view();

// Run the page
$GPMs_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GPMs_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$GPMs_view->isExport()) { ?>
<script>
var fGPMsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fGPMsview = currentForm = new ew.Form("fGPMsview", "view");
	loadjs.done("fGPMsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$GPMs_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $GPMs_view->ExportOptions->render("body") ?>
<?php $GPMs_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $GPMs_view->showPageHeader(); ?>
<?php
$GPMs_view->showMessage();
?>
<?php if (!$GPMs_view->IsModal) { ?>
<?php if (!$GPMs_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GPMs_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fGPMsview" id="fGPMsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GPMs">
<input type="hidden" name="modal" value="<?php echo (int)$GPMs_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($GPMs_view->GPM_Idn->Visible) { // GPM_Idn ?>
	<tr id="r_GPM_Idn">
		<td class="<?php echo $GPMs_view->TableLeftColumnClass ?>"><span id="elh_GPMs_GPM_Idn"><?php echo $GPMs_view->GPM_Idn->caption() ?></span></td>
		<td data-name="GPM_Idn" <?php echo $GPMs_view->GPM_Idn->cellAttributes() ?>>
<span id="el_GPMs_GPM_Idn">
<span<?php echo $GPMs_view->GPM_Idn->viewAttributes() ?>><?php echo $GPMs_view->GPM_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($GPMs_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $GPMs_view->TableLeftColumnClass ?>"><span id="elh_GPMs_Name"><?php echo $GPMs_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $GPMs_view->Name->cellAttributes() ?>>
<span id="el_GPMs_Name">
<span<?php echo $GPMs_view->Name->viewAttributes() ?>><?php echo $GPMs_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($GPMs_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $GPMs_view->TableLeftColumnClass ?>"><span id="elh_GPMs_Rank"><?php echo $GPMs_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $GPMs_view->Rank->cellAttributes() ?>>
<span id="el_GPMs_Rank">
<span<?php echo $GPMs_view->Rank->viewAttributes() ?>><?php echo $GPMs_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($GPMs_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $GPMs_view->TableLeftColumnClass ?>"><span id="elh_GPMs_ActiveFlag"><?php echo $GPMs_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $GPMs_view->ActiveFlag->cellAttributes() ?>>
<span id="el_GPMs_ActiveFlag">
<span<?php echo $GPMs_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $GPMs_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($GPMs_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$GPMs_view->IsModal) { ?>
<?php if (!$GPMs_view->isExport()) { ?>
<?php echo $GPMs_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$GPMs_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$GPMs_view->isExport()) { ?>
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
$GPMs_view->terminate();
?>