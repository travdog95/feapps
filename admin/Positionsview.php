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
$Positions_view = new Positions_view();

// Run the page
$Positions_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Positions_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Positions_view->isExport()) { ?>
<script>
var fPositionsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fPositionsview = currentForm = new ew.Form("fPositionsview", "view");
	loadjs.done("fPositionsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Positions_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Positions_view->ExportOptions->render("body") ?>
<?php $Positions_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Positions_view->showPageHeader(); ?>
<?php
$Positions_view->showMessage();
?>
<?php if (!$Positions_view->IsModal) { ?>
<?php if (!$Positions_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Positions_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fPositionsview" id="fPositionsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Positions">
<input type="hidden" name="modal" value="<?php echo (int)$Positions_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Positions_view->Position_Idn->Visible) { // Position_Idn ?>
	<tr id="r_Position_Idn">
		<td class="<?php echo $Positions_view->TableLeftColumnClass ?>"><span id="elh_Positions_Position_Idn"><?php echo $Positions_view->Position_Idn->caption() ?></span></td>
		<td data-name="Position_Idn" <?php echo $Positions_view->Position_Idn->cellAttributes() ?>>
<span id="el_Positions_Position_Idn">
<span<?php echo $Positions_view->Position_Idn->viewAttributes() ?>><?php echo $Positions_view->Position_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Positions_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $Positions_view->TableLeftColumnClass ?>"><span id="elh_Positions_Name"><?php echo $Positions_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $Positions_view->Name->cellAttributes() ?>>
<span id="el_Positions_Name">
<span<?php echo $Positions_view->Name->viewAttributes() ?>><?php echo $Positions_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Positions_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $Positions_view->TableLeftColumnClass ?>"><span id="elh_Positions_Rank"><?php echo $Positions_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $Positions_view->Rank->cellAttributes() ?>>
<span id="el_Positions_Rank">
<span<?php echo $Positions_view->Rank->viewAttributes() ?>><?php echo $Positions_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Positions_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $Positions_view->TableLeftColumnClass ?>"><span id="elh_Positions_ActiveFlag"><?php echo $Positions_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $Positions_view->ActiveFlag->cellAttributes() ?>>
<span id="el_Positions_ActiveFlag">
<span<?php echo $Positions_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Positions_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Positions_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$Positions_view->IsModal) { ?>
<?php if (!$Positions_view->isExport()) { ?>
<?php echo $Positions_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$Positions_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Positions_view->isExport()) { ?>
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
$Positions_view->terminate();
?>