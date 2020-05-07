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
$ShopFabrications_delete = new ShopFabrications_delete();

// Run the page
$ShopFabrications_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ShopFabrications_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fShopFabricationsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fShopFabricationsdelete = currentForm = new ew.Form("fShopFabricationsdelete", "delete");
	loadjs.done("fShopFabricationsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ShopFabrications_delete->showPageHeader(); ?>
<?php
$ShopFabrications_delete->showMessage();
?>
<form name="fShopFabricationsdelete" id="fShopFabricationsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ShopFabrications">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ShopFabrications_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ShopFabrications_delete->ShopFabrication_Idn->Visible) { // ShopFabrication_Idn ?>
		<th class="<?php echo $ShopFabrications_delete->ShopFabrication_Idn->headerCellClass() ?>"><span id="elh_ShopFabrications_ShopFabrication_Idn" class="ShopFabrications_ShopFabrication_Idn"><?php echo $ShopFabrications_delete->ShopFabrication_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($ShopFabrications_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $ShopFabrications_delete->Name->headerCellClass() ?>"><span id="elh_ShopFabrications_Name" class="ShopFabrications_Name"><?php echo $ShopFabrications_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($ShopFabrications_delete->Value->Visible) { // Value ?>
		<th class="<?php echo $ShopFabrications_delete->Value->headerCellClass() ?>"><span id="elh_ShopFabrications_Value" class="ShopFabrications_Value"><?php echo $ShopFabrications_delete->Value->caption() ?></span></th>
<?php } ?>
<?php if ($ShopFabrications_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $ShopFabrications_delete->Rank->headerCellClass() ?>"><span id="elh_ShopFabrications_Rank" class="ShopFabrications_Rank"><?php echo $ShopFabrications_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($ShopFabrications_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $ShopFabrications_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_ShopFabrications_ActiveFlag" class="ShopFabrications_ActiveFlag"><?php echo $ShopFabrications_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ShopFabrications_delete->RecordCount = 0;
$i = 0;
while (!$ShopFabrications_delete->Recordset->EOF) {
	$ShopFabrications_delete->RecordCount++;
	$ShopFabrications_delete->RowCount++;

	// Set row properties
	$ShopFabrications->resetAttributes();
	$ShopFabrications->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ShopFabrications_delete->loadRowValues($ShopFabrications_delete->Recordset);

	// Render row
	$ShopFabrications_delete->renderRow();
?>
	<tr <?php echo $ShopFabrications->rowAttributes() ?>>
<?php if ($ShopFabrications_delete->ShopFabrication_Idn->Visible) { // ShopFabrication_Idn ?>
		<td <?php echo $ShopFabrications_delete->ShopFabrication_Idn->cellAttributes() ?>>
<span id="el<?php echo $ShopFabrications_delete->RowCount ?>_ShopFabrications_ShopFabrication_Idn" class="ShopFabrications_ShopFabrication_Idn">
<span<?php echo $ShopFabrications_delete->ShopFabrication_Idn->viewAttributes() ?>><?php echo $ShopFabrications_delete->ShopFabrication_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ShopFabrications_delete->Name->Visible) { // Name ?>
		<td <?php echo $ShopFabrications_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $ShopFabrications_delete->RowCount ?>_ShopFabrications_Name" class="ShopFabrications_Name">
<span<?php echo $ShopFabrications_delete->Name->viewAttributes() ?>><?php echo $ShopFabrications_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ShopFabrications_delete->Value->Visible) { // Value ?>
		<td <?php echo $ShopFabrications_delete->Value->cellAttributes() ?>>
<span id="el<?php echo $ShopFabrications_delete->RowCount ?>_ShopFabrications_Value" class="ShopFabrications_Value">
<span<?php echo $ShopFabrications_delete->Value->viewAttributes() ?>><?php echo $ShopFabrications_delete->Value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ShopFabrications_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $ShopFabrications_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $ShopFabrications_delete->RowCount ?>_ShopFabrications_Rank" class="ShopFabrications_Rank">
<span<?php echo $ShopFabrications_delete->Rank->viewAttributes() ?>><?php echo $ShopFabrications_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ShopFabrications_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $ShopFabrications_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $ShopFabrications_delete->RowCount ?>_ShopFabrications_ActiveFlag" class="ShopFabrications_ActiveFlag">
<span<?php echo $ShopFabrications_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ShopFabrications_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ShopFabrications_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ShopFabrications_delete->Recordset->moveNext();
}
$ShopFabrications_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ShopFabrications_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ShopFabrications_delete->showPageFooter();
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
$ShopFabrications_delete->terminate();
?>