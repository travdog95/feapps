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
$ProductSizes_delete = new ProductSizes_delete();

// Run the page
$ProductSizes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ProductSizes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fProductSizesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fProductSizesdelete = currentForm = new ew.Form("fProductSizesdelete", "delete");
	loadjs.done("fProductSizesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ProductSizes_delete->showPageHeader(); ?>
<?php
$ProductSizes_delete->showMessage();
?>
<form name="fProductSizesdelete" id="fProductSizesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ProductSizes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ProductSizes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ProductSizes_delete->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<th class="<?php echo $ProductSizes_delete->ProductSize_Idn->headerCellClass() ?>"><span id="elh_ProductSizes_ProductSize_Idn" class="ProductSizes_ProductSize_Idn"><?php echo $ProductSizes_delete->ProductSize_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($ProductSizes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $ProductSizes_delete->Name->headerCellClass() ?>"><span id="elh_ProductSizes_Name" class="ProductSizes_Name"><?php echo $ProductSizes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($ProductSizes_delete->Value->Visible) { // Value ?>
		<th class="<?php echo $ProductSizes_delete->Value->headerCellClass() ?>"><span id="elh_ProductSizes_Value" class="ProductSizes_Value"><?php echo $ProductSizes_delete->Value->caption() ?></span></th>
<?php } ?>
<?php if ($ProductSizes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $ProductSizes_delete->Rank->headerCellClass() ?>"><span id="elh_ProductSizes_Rank" class="ProductSizes_Rank"><?php echo $ProductSizes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($ProductSizes_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $ProductSizes_delete->Department_Idn->headerCellClass() ?>"><span id="elh_ProductSizes_Department_Idn" class="ProductSizes_Department_Idn"><?php echo $ProductSizes_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($ProductSizes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $ProductSizes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_ProductSizes_ActiveFlag" class="ProductSizes_ActiveFlag"><?php echo $ProductSizes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ProductSizes_delete->RecordCount = 0;
$i = 0;
while (!$ProductSizes_delete->Recordset->EOF) {
	$ProductSizes_delete->RecordCount++;
	$ProductSizes_delete->RowCount++;

	// Set row properties
	$ProductSizes->resetAttributes();
	$ProductSizes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ProductSizes_delete->loadRowValues($ProductSizes_delete->Recordset);

	// Render row
	$ProductSizes_delete->renderRow();
?>
	<tr <?php echo $ProductSizes->rowAttributes() ?>>
<?php if ($ProductSizes_delete->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td <?php echo $ProductSizes_delete->ProductSize_Idn->cellAttributes() ?>>
<span id="el<?php echo $ProductSizes_delete->RowCount ?>_ProductSizes_ProductSize_Idn" class="ProductSizes_ProductSize_Idn">
<span<?php echo $ProductSizes_delete->ProductSize_Idn->viewAttributes() ?>><?php echo $ProductSizes_delete->ProductSize_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ProductSizes_delete->Name->Visible) { // Name ?>
		<td <?php echo $ProductSizes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $ProductSizes_delete->RowCount ?>_ProductSizes_Name" class="ProductSizes_Name">
<span<?php echo $ProductSizes_delete->Name->viewAttributes() ?>><?php echo $ProductSizes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ProductSizes_delete->Value->Visible) { // Value ?>
		<td <?php echo $ProductSizes_delete->Value->cellAttributes() ?>>
<span id="el<?php echo $ProductSizes_delete->RowCount ?>_ProductSizes_Value" class="ProductSizes_Value">
<span<?php echo $ProductSizes_delete->Value->viewAttributes() ?>><?php echo $ProductSizes_delete->Value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ProductSizes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $ProductSizes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $ProductSizes_delete->RowCount ?>_ProductSizes_Rank" class="ProductSizes_Rank">
<span<?php echo $ProductSizes_delete->Rank->viewAttributes() ?>><?php echo $ProductSizes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ProductSizes_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $ProductSizes_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $ProductSizes_delete->RowCount ?>_ProductSizes_Department_Idn" class="ProductSizes_Department_Idn">
<span<?php echo $ProductSizes_delete->Department_Idn->viewAttributes() ?>><?php echo $ProductSizes_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ProductSizes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $ProductSizes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $ProductSizes_delete->RowCount ?>_ProductSizes_ActiveFlag" class="ProductSizes_ActiveFlag">
<span<?php echo $ProductSizes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ProductSizes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ProductSizes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ProductSizes_delete->Recordset->moveNext();
}
$ProductSizes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ProductSizes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ProductSizes_delete->showPageFooter();
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
$ProductSizes_delete->terminate();
?>