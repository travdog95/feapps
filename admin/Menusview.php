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
$Menus_view = new Menus_view();

// Run the page
$Menus_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Menus_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Menus_view->isExport()) { ?>
<script>
var fMenusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fMenusview = currentForm = new ew.Form("fMenusview", "view");
	loadjs.done("fMenusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Menus_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Menus_view->ExportOptions->render("body") ?>
<?php $Menus_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Menus_view->showPageHeader(); ?>
<?php
$Menus_view->showMessage();
?>
<?php if (!$Menus_view->IsModal) { ?>
<?php if (!$Menus_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Menus_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fMenusview" id="fMenusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Menus">
<input type="hidden" name="modal" value="<?php echo (int)$Menus_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Menus_view->Menu_Idn->Visible) { // Menu_Idn ?>
	<tr id="r_Menu_Idn">
		<td class="<?php echo $Menus_view->TableLeftColumnClass ?>"><span id="elh_Menus_Menu_Idn"><?php echo $Menus_view->Menu_Idn->caption() ?></span></td>
		<td data-name="Menu_Idn" <?php echo $Menus_view->Menu_Idn->cellAttributes() ?>>
<span id="el_Menus_Menu_Idn">
<span<?php echo $Menus_view->Menu_Idn->viewAttributes() ?>><?php echo $Menus_view->Menu_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Menus_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $Menus_view->TableLeftColumnClass ?>"><span id="elh_Menus_Name"><?php echo $Menus_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $Menus_view->Name->cellAttributes() ?>>
<span id="el_Menus_Name">
<span<?php echo $Menus_view->Name->viewAttributes() ?>><?php echo $Menus_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Menus_view->ShortName->Visible) { // ShortName ?>
	<tr id="r_ShortName">
		<td class="<?php echo $Menus_view->TableLeftColumnClass ?>"><span id="elh_Menus_ShortName"><?php echo $Menus_view->ShortName->caption() ?></span></td>
		<td data-name="ShortName" <?php echo $Menus_view->ShortName->cellAttributes() ?>>
<span id="el_Menus_ShortName">
<span<?php echo $Menus_view->ShortName->viewAttributes() ?>><?php echo $Menus_view->ShortName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Menus_view->Link->Visible) { // Link ?>
	<tr id="r_Link">
		<td class="<?php echo $Menus_view->TableLeftColumnClass ?>"><span id="elh_Menus_Link"><?php echo $Menus_view->Link->caption() ?></span></td>
		<td data-name="Link" <?php echo $Menus_view->Link->cellAttributes() ?>>
<span id="el_Menus_Link">
<span<?php echo $Menus_view->Link->viewAttributes() ?>><?php echo $Menus_view->Link->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Menus_view->Icon->Visible) { // Icon ?>
	<tr id="r_Icon">
		<td class="<?php echo $Menus_view->TableLeftColumnClass ?>"><span id="elh_Menus_Icon"><?php echo $Menus_view->Icon->caption() ?></span></td>
		<td data-name="Icon" <?php echo $Menus_view->Icon->cellAttributes() ?>>
<span id="el_Menus_Icon">
<span<?php echo $Menus_view->Icon->viewAttributes() ?>><?php echo $Menus_view->Icon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Menus_view->MenuType_Idn->Visible) { // MenuType_Idn ?>
	<tr id="r_MenuType_Idn">
		<td class="<?php echo $Menus_view->TableLeftColumnClass ?>"><span id="elh_Menus_MenuType_Idn"><?php echo $Menus_view->MenuType_Idn->caption() ?></span></td>
		<td data-name="MenuType_Idn" <?php echo $Menus_view->MenuType_Idn->cellAttributes() ?>>
<span id="el_Menus_MenuType_Idn">
<span<?php echo $Menus_view->MenuType_Idn->viewAttributes() ?>><?php echo $Menus_view->MenuType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Menus_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $Menus_view->TableLeftColumnClass ?>"><span id="elh_Menus_Rank"><?php echo $Menus_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $Menus_view->Rank->cellAttributes() ?>>
<span id="el_Menus_Rank">
<span<?php echo $Menus_view->Rank->viewAttributes() ?>><?php echo $Menus_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Menus_view->ChildMenuType_Idn->Visible) { // ChildMenuType_Idn ?>
	<tr id="r_ChildMenuType_Idn">
		<td class="<?php echo $Menus_view->TableLeftColumnClass ?>"><span id="elh_Menus_ChildMenuType_Idn"><?php echo $Menus_view->ChildMenuType_Idn->caption() ?></span></td>
		<td data-name="ChildMenuType_Idn" <?php echo $Menus_view->ChildMenuType_Idn->cellAttributes() ?>>
<span id="el_Menus_ChildMenuType_Idn">
<span<?php echo $Menus_view->ChildMenuType_Idn->viewAttributes() ?>><?php echo $Menus_view->ChildMenuType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Menus_view->IsParent->Visible) { // IsParent ?>
	<tr id="r_IsParent">
		<td class="<?php echo $Menus_view->TableLeftColumnClass ?>"><span id="elh_Menus_IsParent"><?php echo $Menus_view->IsParent->caption() ?></span></td>
		<td data-name="IsParent" <?php echo $Menus_view->IsParent->cellAttributes() ?>>
<span id="el_Menus_IsParent">
<span<?php echo $Menus_view->IsParent->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsParent" class="custom-control-input" value="<?php echo $Menus_view->IsParent->getViewValue() ?>" disabled<?php if (ConvertToBool($Menus_view->IsParent->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsParent"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Menus_view->AdminOnly->Visible) { // AdminOnly ?>
	<tr id="r_AdminOnly">
		<td class="<?php echo $Menus_view->TableLeftColumnClass ?>"><span id="elh_Menus_AdminOnly"><?php echo $Menus_view->AdminOnly->caption() ?></span></td>
		<td data-name="AdminOnly" <?php echo $Menus_view->AdminOnly->cellAttributes() ?>>
<span id="el_Menus_AdminOnly">
<span<?php echo $Menus_view->AdminOnly->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AdminOnly" class="custom-control-input" value="<?php echo $Menus_view->AdminOnly->getViewValue() ?>" disabled<?php if (ConvertToBool($Menus_view->AdminOnly->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AdminOnly"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Menus_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $Menus_view->TableLeftColumnClass ?>"><span id="elh_Menus_ActiveFlag"><?php echo $Menus_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $Menus_view->ActiveFlag->cellAttributes() ?>>
<span id="el_Menus_ActiveFlag">
<span<?php echo $Menus_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Menus_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Menus_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$Menus_view->IsModal) { ?>
<?php if (!$Menus_view->isExport()) { ?>
<?php echo $Menus_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$Menus_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Menus_view->isExport()) { ?>
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
$Menus_view->terminate();
?>