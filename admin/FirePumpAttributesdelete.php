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
$FirePumpAttributes_delete = new FirePumpAttributes_delete();

// Run the page
$FirePumpAttributes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FirePumpAttributes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fFirePumpAttributesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fFirePumpAttributesdelete = currentForm = new ew.Form("fFirePumpAttributesdelete", "delete");
	loadjs.done("fFirePumpAttributesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $FirePumpAttributes_delete->showPageHeader(); ?>
<?php
$FirePumpAttributes_delete->showMessage();
?>
<form name="fFirePumpAttributesdelete" id="fFirePumpAttributesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FirePumpAttributes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($FirePumpAttributes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($FirePumpAttributes_delete->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
		<th class="<?php echo $FirePumpAttributes_delete->FirePumpAttribute_Idn->headerCellClass() ?>"><span id="elh_FirePumpAttributes_FirePumpAttribute_Idn" class="FirePumpAttributes_FirePumpAttribute_Idn"><?php echo $FirePumpAttributes_delete->FirePumpAttribute_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($FirePumpAttributes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $FirePumpAttributes_delete->Name->headerCellClass() ?>"><span id="elh_FirePumpAttributes_Name" class="FirePumpAttributes_Name"><?php echo $FirePumpAttributes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($FirePumpAttributes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $FirePumpAttributes_delete->Rank->headerCellClass() ?>"><span id="elh_FirePumpAttributes_Rank" class="FirePumpAttributes_Rank"><?php echo $FirePumpAttributes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($FirePumpAttributes_delete->DefaultFlag->Visible) { // DefaultFlag ?>
		<th class="<?php echo $FirePumpAttributes_delete->DefaultFlag->headerCellClass() ?>"><span id="elh_FirePumpAttributes_DefaultFlag" class="FirePumpAttributes_DefaultFlag"><?php echo $FirePumpAttributes_delete->DefaultFlag->caption() ?></span></th>
<?php } ?>
<?php if ($FirePumpAttributes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $FirePumpAttributes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_FirePumpAttributes_ActiveFlag" class="FirePumpAttributes_ActiveFlag"><?php echo $FirePumpAttributes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$FirePumpAttributes_delete->RecordCount = 0;
$i = 0;
while (!$FirePumpAttributes_delete->Recordset->EOF) {
	$FirePumpAttributes_delete->RecordCount++;
	$FirePumpAttributes_delete->RowCount++;

	// Set row properties
	$FirePumpAttributes->resetAttributes();
	$FirePumpAttributes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$FirePumpAttributes_delete->loadRowValues($FirePumpAttributes_delete->Recordset);

	// Render row
	$FirePumpAttributes_delete->renderRow();
?>
	<tr <?php echo $FirePumpAttributes->rowAttributes() ?>>
<?php if ($FirePumpAttributes_delete->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
		<td <?php echo $FirePumpAttributes_delete->FirePumpAttribute_Idn->cellAttributes() ?>>
<span id="el<?php echo $FirePumpAttributes_delete->RowCount ?>_FirePumpAttributes_FirePumpAttribute_Idn" class="FirePumpAttributes_FirePumpAttribute_Idn">
<span<?php echo $FirePumpAttributes_delete->FirePumpAttribute_Idn->viewAttributes() ?>><?php echo $FirePumpAttributes_delete->FirePumpAttribute_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FirePumpAttributes_delete->Name->Visible) { // Name ?>
		<td <?php echo $FirePumpAttributes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $FirePumpAttributes_delete->RowCount ?>_FirePumpAttributes_Name" class="FirePumpAttributes_Name">
<span<?php echo $FirePumpAttributes_delete->Name->viewAttributes() ?>><?php echo $FirePumpAttributes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FirePumpAttributes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $FirePumpAttributes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $FirePumpAttributes_delete->RowCount ?>_FirePumpAttributes_Rank" class="FirePumpAttributes_Rank">
<span<?php echo $FirePumpAttributes_delete->Rank->viewAttributes() ?>><?php echo $FirePumpAttributes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FirePumpAttributes_delete->DefaultFlag->Visible) { // DefaultFlag ?>
		<td <?php echo $FirePumpAttributes_delete->DefaultFlag->cellAttributes() ?>>
<span id="el<?php echo $FirePumpAttributes_delete->RowCount ?>_FirePumpAttributes_DefaultFlag" class="FirePumpAttributes_DefaultFlag">
<span<?php echo $FirePumpAttributes_delete->DefaultFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DefaultFlag" class="custom-control-input" value="<?php echo $FirePumpAttributes_delete->DefaultFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FirePumpAttributes_delete->DefaultFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DefaultFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($FirePumpAttributes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $FirePumpAttributes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $FirePumpAttributes_delete->RowCount ?>_FirePumpAttributes_ActiveFlag" class="FirePumpAttributes_ActiveFlag">
<span<?php echo $FirePumpAttributes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FirePumpAttributes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FirePumpAttributes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$FirePumpAttributes_delete->Recordset->moveNext();
}
$FirePumpAttributes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $FirePumpAttributes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$FirePumpAttributes_delete->showPageFooter();
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
$FirePumpAttributes_delete->terminate();
?>