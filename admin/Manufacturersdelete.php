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
$Manufacturers_delete = new Manufacturers_delete();

// Run the page
$Manufacturers_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Manufacturers_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fManufacturersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fManufacturersdelete = currentForm = new ew.Form("fManufacturersdelete", "delete");
	loadjs.done("fManufacturersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Manufacturers_delete->showPageHeader(); ?>
<?php
$Manufacturers_delete->showMessage();
?>
<form name="fManufacturersdelete" id="fManufacturersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Manufacturers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Manufacturers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Manufacturers_delete->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
		<th class="<?php echo $Manufacturers_delete->Manufacturer_Idn->headerCellClass() ?>"><span id="elh_Manufacturers_Manufacturer_Idn" class="Manufacturers_Manufacturer_Idn"><?php echo $Manufacturers_delete->Manufacturer_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Manufacturers_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $Manufacturers_delete->Name->headerCellClass() ?>"><span id="elh_Manufacturers_Name" class="Manufacturers_Name"><?php echo $Manufacturers_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($Manufacturers_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $Manufacturers_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_Manufacturers_ActiveFlag" class="Manufacturers_ActiveFlag"><?php echo $Manufacturers_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Manufacturers_delete->RecordCount = 0;
$i = 0;
while (!$Manufacturers_delete->Recordset->EOF) {
	$Manufacturers_delete->RecordCount++;
	$Manufacturers_delete->RowCount++;

	// Set row properties
	$Manufacturers->resetAttributes();
	$Manufacturers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Manufacturers_delete->loadRowValues($Manufacturers_delete->Recordset);

	// Render row
	$Manufacturers_delete->renderRow();
?>
	<tr <?php echo $Manufacturers->rowAttributes() ?>>
<?php if ($Manufacturers_delete->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
		<td <?php echo $Manufacturers_delete->Manufacturer_Idn->cellAttributes() ?>>
<span id="el<?php echo $Manufacturers_delete->RowCount ?>_Manufacturers_Manufacturer_Idn" class="Manufacturers_Manufacturer_Idn">
<span<?php echo $Manufacturers_delete->Manufacturer_Idn->viewAttributes() ?>><?php echo $Manufacturers_delete->Manufacturer_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Manufacturers_delete->Name->Visible) { // Name ?>
		<td <?php echo $Manufacturers_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $Manufacturers_delete->RowCount ?>_Manufacturers_Name" class="Manufacturers_Name">
<span<?php echo $Manufacturers_delete->Name->viewAttributes() ?>><?php echo $Manufacturers_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Manufacturers_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $Manufacturers_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $Manufacturers_delete->RowCount ?>_Manufacturers_ActiveFlag" class="Manufacturers_ActiveFlag">
<span<?php echo $Manufacturers_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Manufacturers_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Manufacturers_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Manufacturers_delete->Recordset->moveNext();
}
$Manufacturers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Manufacturers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Manufacturers_delete->showPageFooter();
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
$Manufacturers_delete->terminate();
?>