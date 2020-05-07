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
$FinishWorks_view = new FinishWorks_view();

// Run the page
$FinishWorks_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FinishWorks_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$FinishWorks_view->isExport()) { ?>
<script>
var fFinishWorksview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fFinishWorksview = currentForm = new ew.Form("fFinishWorksview", "view");
	loadjs.done("fFinishWorksview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$FinishWorks_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $FinishWorks_view->ExportOptions->render("body") ?>
<?php $FinishWorks_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $FinishWorks_view->showPageHeader(); ?>
<?php
$FinishWorks_view->showMessage();
?>
<?php if (!$FinishWorks_view->IsModal) { ?>
<?php if (!$FinishWorks_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FinishWorks_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fFinishWorksview" id="fFinishWorksview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FinishWorks">
<input type="hidden" name="modal" value="<?php echo (int)$FinishWorks_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($FinishWorks_view->FinishWork_Idn->Visible) { // FinishWork_Idn ?>
	<tr id="r_FinishWork_Idn">
		<td class="<?php echo $FinishWorks_view->TableLeftColumnClass ?>"><span id="elh_FinishWorks_FinishWork_Idn"><?php echo $FinishWorks_view->FinishWork_Idn->caption() ?></span></td>
		<td data-name="FinishWork_Idn" <?php echo $FinishWorks_view->FinishWork_Idn->cellAttributes() ?>>
<span id="el_FinishWorks_FinishWork_Idn">
<span<?php echo $FinishWorks_view->FinishWork_Idn->viewAttributes() ?>><?php echo $FinishWorks_view->FinishWork_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FinishWorks_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $FinishWorks_view->TableLeftColumnClass ?>"><span id="elh_FinishWorks_Name"><?php echo $FinishWorks_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $FinishWorks_view->Name->cellAttributes() ?>>
<span id="el_FinishWorks_Name">
<span<?php echo $FinishWorks_view->Name->viewAttributes() ?>><?php echo $FinishWorks_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FinishWorks_view->Value->Visible) { // Value ?>
	<tr id="r_Value">
		<td class="<?php echo $FinishWorks_view->TableLeftColumnClass ?>"><span id="elh_FinishWorks_Value"><?php echo $FinishWorks_view->Value->caption() ?></span></td>
		<td data-name="Value" <?php echo $FinishWorks_view->Value->cellAttributes() ?>>
<span id="el_FinishWorks_Value">
<span<?php echo $FinishWorks_view->Value->viewAttributes() ?>><?php echo $FinishWorks_view->Value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FinishWorks_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $FinishWorks_view->TableLeftColumnClass ?>"><span id="elh_FinishWorks_Rank"><?php echo $FinishWorks_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $FinishWorks_view->Rank->cellAttributes() ?>>
<span id="el_FinishWorks_Rank">
<span<?php echo $FinishWorks_view->Rank->viewAttributes() ?>><?php echo $FinishWorks_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($FinishWorks_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $FinishWorks_view->TableLeftColumnClass ?>"><span id="elh_FinishWorks_ActiveFlag"><?php echo $FinishWorks_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $FinishWorks_view->ActiveFlag->cellAttributes() ?>>
<span id="el_FinishWorks_ActiveFlag">
<span<?php echo $FinishWorks_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FinishWorks_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FinishWorks_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$FinishWorks_view->IsModal) { ?>
<?php if (!$FinishWorks_view->isExport()) { ?>
<?php echo $FinishWorks_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$FinishWorks_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$FinishWorks_view->isExport()) { ?>
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
$FinishWorks_view->terminate();
?>