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
$MenuTypes_delete = new MenuTypes_delete();

// Run the page
$MenuTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$MenuTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fMenuTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fMenuTypesdelete = currentForm = new ew.Form("fMenuTypesdelete", "delete");
	loadjs.done("fMenuTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $MenuTypes_delete->showPageHeader(); ?>
<?php
$MenuTypes_delete->showMessage();
?>
<form name="fMenuTypesdelete" id="fMenuTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="MenuTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($MenuTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($MenuTypes_delete->MenuType_Idn->Visible) { // MenuType_Idn ?>
		<th class="<?php echo $MenuTypes_delete->MenuType_Idn->headerCellClass() ?>"><span id="elh_MenuTypes_MenuType_Idn" class="MenuTypes_MenuType_Idn"><?php echo $MenuTypes_delete->MenuType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($MenuTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $MenuTypes_delete->Name->headerCellClass() ?>"><span id="elh_MenuTypes_Name" class="MenuTypes_Name"><?php echo $MenuTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($MenuTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $MenuTypes_delete->Rank->headerCellClass() ?>"><span id="elh_MenuTypes_Rank" class="MenuTypes_Rank"><?php echo $MenuTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($MenuTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $MenuTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_MenuTypes_ActiveFlag" class="MenuTypes_ActiveFlag"><?php echo $MenuTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$MenuTypes_delete->RecordCount = 0;
$i = 0;
while (!$MenuTypes_delete->Recordset->EOF) {
	$MenuTypes_delete->RecordCount++;
	$MenuTypes_delete->RowCount++;

	// Set row properties
	$MenuTypes->resetAttributes();
	$MenuTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$MenuTypes_delete->loadRowValues($MenuTypes_delete->Recordset);

	// Render row
	$MenuTypes_delete->renderRow();
?>
	<tr <?php echo $MenuTypes->rowAttributes() ?>>
<?php if ($MenuTypes_delete->MenuType_Idn->Visible) { // MenuType_Idn ?>
		<td <?php echo $MenuTypes_delete->MenuType_Idn->cellAttributes() ?>>
<span id="el<?php echo $MenuTypes_delete->RowCount ?>_MenuTypes_MenuType_Idn" class="MenuTypes_MenuType_Idn">
<span<?php echo $MenuTypes_delete->MenuType_Idn->viewAttributes() ?>><?php echo $MenuTypes_delete->MenuType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($MenuTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $MenuTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $MenuTypes_delete->RowCount ?>_MenuTypes_Name" class="MenuTypes_Name">
<span<?php echo $MenuTypes_delete->Name->viewAttributes() ?>><?php echo $MenuTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($MenuTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $MenuTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $MenuTypes_delete->RowCount ?>_MenuTypes_Rank" class="MenuTypes_Rank">
<span<?php echo $MenuTypes_delete->Rank->viewAttributes() ?>><?php echo $MenuTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($MenuTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $MenuTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $MenuTypes_delete->RowCount ?>_MenuTypes_ActiveFlag" class="MenuTypes_ActiveFlag">
<span<?php echo $MenuTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $MenuTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($MenuTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$MenuTypes_delete->Recordset->moveNext();
}
$MenuTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $MenuTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$MenuTypes_delete->showPageFooter();
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
$MenuTypes_delete->terminate();
?>