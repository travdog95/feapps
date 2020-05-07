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
$Menus_delete = new Menus_delete();

// Run the page
$Menus_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Menus_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fMenusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fMenusdelete = currentForm = new ew.Form("fMenusdelete", "delete");
	loadjs.done("fMenusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Menus_delete->showPageHeader(); ?>
<?php
$Menus_delete->showMessage();
?>
<form name="fMenusdelete" id="fMenusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Menus">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Menus_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Menus_delete->Menu_Idn->Visible) { // Menu_Idn ?>
		<th class="<?php echo $Menus_delete->Menu_Idn->headerCellClass() ?>"><span id="elh_Menus_Menu_Idn" class="Menus_Menu_Idn"><?php echo $Menus_delete->Menu_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Menus_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $Menus_delete->Name->headerCellClass() ?>"><span id="elh_Menus_Name" class="Menus_Name"><?php echo $Menus_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($Menus_delete->ShortName->Visible) { // ShortName ?>
		<th class="<?php echo $Menus_delete->ShortName->headerCellClass() ?>"><span id="elh_Menus_ShortName" class="Menus_ShortName"><?php echo $Menus_delete->ShortName->caption() ?></span></th>
<?php } ?>
<?php if ($Menus_delete->Link->Visible) { // Link ?>
		<th class="<?php echo $Menus_delete->Link->headerCellClass() ?>"><span id="elh_Menus_Link" class="Menus_Link"><?php echo $Menus_delete->Link->caption() ?></span></th>
<?php } ?>
<?php if ($Menus_delete->Icon->Visible) { // Icon ?>
		<th class="<?php echo $Menus_delete->Icon->headerCellClass() ?>"><span id="elh_Menus_Icon" class="Menus_Icon"><?php echo $Menus_delete->Icon->caption() ?></span></th>
<?php } ?>
<?php if ($Menus_delete->MenuType_Idn->Visible) { // MenuType_Idn ?>
		<th class="<?php echo $Menus_delete->MenuType_Idn->headerCellClass() ?>"><span id="elh_Menus_MenuType_Idn" class="Menus_MenuType_Idn"><?php echo $Menus_delete->MenuType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Menus_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $Menus_delete->Rank->headerCellClass() ?>"><span id="elh_Menus_Rank" class="Menus_Rank"><?php echo $Menus_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($Menus_delete->ChildMenuType_Idn->Visible) { // ChildMenuType_Idn ?>
		<th class="<?php echo $Menus_delete->ChildMenuType_Idn->headerCellClass() ?>"><span id="elh_Menus_ChildMenuType_Idn" class="Menus_ChildMenuType_Idn"><?php echo $Menus_delete->ChildMenuType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Menus_delete->IsParent->Visible) { // IsParent ?>
		<th class="<?php echo $Menus_delete->IsParent->headerCellClass() ?>"><span id="elh_Menus_IsParent" class="Menus_IsParent"><?php echo $Menus_delete->IsParent->caption() ?></span></th>
<?php } ?>
<?php if ($Menus_delete->AdminOnly->Visible) { // AdminOnly ?>
		<th class="<?php echo $Menus_delete->AdminOnly->headerCellClass() ?>"><span id="elh_Menus_AdminOnly" class="Menus_AdminOnly"><?php echo $Menus_delete->AdminOnly->caption() ?></span></th>
<?php } ?>
<?php if ($Menus_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $Menus_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_Menus_ActiveFlag" class="Menus_ActiveFlag"><?php echo $Menus_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Menus_delete->RecordCount = 0;
$i = 0;
while (!$Menus_delete->Recordset->EOF) {
	$Menus_delete->RecordCount++;
	$Menus_delete->RowCount++;

	// Set row properties
	$Menus->resetAttributes();
	$Menus->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Menus_delete->loadRowValues($Menus_delete->Recordset);

	// Render row
	$Menus_delete->renderRow();
?>
	<tr <?php echo $Menus->rowAttributes() ?>>
<?php if ($Menus_delete->Menu_Idn->Visible) { // Menu_Idn ?>
		<td <?php echo $Menus_delete->Menu_Idn->cellAttributes() ?>>
<span id="el<?php echo $Menus_delete->RowCount ?>_Menus_Menu_Idn" class="Menus_Menu_Idn">
<span<?php echo $Menus_delete->Menu_Idn->viewAttributes() ?>><?php echo $Menus_delete->Menu_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Menus_delete->Name->Visible) { // Name ?>
		<td <?php echo $Menus_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $Menus_delete->RowCount ?>_Menus_Name" class="Menus_Name">
<span<?php echo $Menus_delete->Name->viewAttributes() ?>><?php echo $Menus_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Menus_delete->ShortName->Visible) { // ShortName ?>
		<td <?php echo $Menus_delete->ShortName->cellAttributes() ?>>
<span id="el<?php echo $Menus_delete->RowCount ?>_Menus_ShortName" class="Menus_ShortName">
<span<?php echo $Menus_delete->ShortName->viewAttributes() ?>><?php echo $Menus_delete->ShortName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Menus_delete->Link->Visible) { // Link ?>
		<td <?php echo $Menus_delete->Link->cellAttributes() ?>>
<span id="el<?php echo $Menus_delete->RowCount ?>_Menus_Link" class="Menus_Link">
<span<?php echo $Menus_delete->Link->viewAttributes() ?>><?php echo $Menus_delete->Link->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Menus_delete->Icon->Visible) { // Icon ?>
		<td <?php echo $Menus_delete->Icon->cellAttributes() ?>>
<span id="el<?php echo $Menus_delete->RowCount ?>_Menus_Icon" class="Menus_Icon">
<span<?php echo $Menus_delete->Icon->viewAttributes() ?>><?php echo $Menus_delete->Icon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Menus_delete->MenuType_Idn->Visible) { // MenuType_Idn ?>
		<td <?php echo $Menus_delete->MenuType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Menus_delete->RowCount ?>_Menus_MenuType_Idn" class="Menus_MenuType_Idn">
<span<?php echo $Menus_delete->MenuType_Idn->viewAttributes() ?>><?php echo $Menus_delete->MenuType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Menus_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $Menus_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $Menus_delete->RowCount ?>_Menus_Rank" class="Menus_Rank">
<span<?php echo $Menus_delete->Rank->viewAttributes() ?>><?php echo $Menus_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Menus_delete->ChildMenuType_Idn->Visible) { // ChildMenuType_Idn ?>
		<td <?php echo $Menus_delete->ChildMenuType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Menus_delete->RowCount ?>_Menus_ChildMenuType_Idn" class="Menus_ChildMenuType_Idn">
<span<?php echo $Menus_delete->ChildMenuType_Idn->viewAttributes() ?>><?php echo $Menus_delete->ChildMenuType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Menus_delete->IsParent->Visible) { // IsParent ?>
		<td <?php echo $Menus_delete->IsParent->cellAttributes() ?>>
<span id="el<?php echo $Menus_delete->RowCount ?>_Menus_IsParent" class="Menus_IsParent">
<span<?php echo $Menus_delete->IsParent->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsParent" class="custom-control-input" value="<?php echo $Menus_delete->IsParent->getViewValue() ?>" disabled<?php if (ConvertToBool($Menus_delete->IsParent->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsParent"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Menus_delete->AdminOnly->Visible) { // AdminOnly ?>
		<td <?php echo $Menus_delete->AdminOnly->cellAttributes() ?>>
<span id="el<?php echo $Menus_delete->RowCount ?>_Menus_AdminOnly" class="Menus_AdminOnly">
<span<?php echo $Menus_delete->AdminOnly->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AdminOnly" class="custom-control-input" value="<?php echo $Menus_delete->AdminOnly->getViewValue() ?>" disabled<?php if (ConvertToBool($Menus_delete->AdminOnly->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AdminOnly"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Menus_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $Menus_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $Menus_delete->RowCount ?>_Menus_ActiveFlag" class="Menus_ActiveFlag">
<span<?php echo $Menus_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Menus_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Menus_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Menus_delete->Recordset->moveNext();
}
$Menus_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Menus_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Menus_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$Menus_delete->terminate();
?>