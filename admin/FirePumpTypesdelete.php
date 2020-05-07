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
$FirePumpTypes_delete = new FirePumpTypes_delete();

// Run the page
$FirePumpTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FirePumpTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fFirePumpTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fFirePumpTypesdelete = currentForm = new ew.Form("fFirePumpTypesdelete", "delete");
	loadjs.done("fFirePumpTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $FirePumpTypes_delete->showPageHeader(); ?>
<?php
$FirePumpTypes_delete->showMessage();
?>
<form name="fFirePumpTypesdelete" id="fFirePumpTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FirePumpTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($FirePumpTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($FirePumpTypes_delete->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
		<th class="<?php echo $FirePumpTypes_delete->FirePumpType_Idn->headerCellClass() ?>"><span id="elh_FirePumpTypes_FirePumpType_Idn" class="FirePumpTypes_FirePumpType_Idn"><?php echo $FirePumpTypes_delete->FirePumpType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($FirePumpTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $FirePumpTypes_delete->Name->headerCellClass() ?>"><span id="elh_FirePumpTypes_Name" class="FirePumpTypes_Name"><?php echo $FirePumpTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($FirePumpTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $FirePumpTypes_delete->Rank->headerCellClass() ?>"><span id="elh_FirePumpTypes_Rank" class="FirePumpTypes_Rank"><?php echo $FirePumpTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($FirePumpTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $FirePumpTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_FirePumpTypes_ActiveFlag" class="FirePumpTypes_ActiveFlag"><?php echo $FirePumpTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$FirePumpTypes_delete->RecordCount = 0;
$i = 0;
while (!$FirePumpTypes_delete->Recordset->EOF) {
	$FirePumpTypes_delete->RecordCount++;
	$FirePumpTypes_delete->RowCount++;

	// Set row properties
	$FirePumpTypes->resetAttributes();
	$FirePumpTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$FirePumpTypes_delete->loadRowValues($FirePumpTypes_delete->Recordset);

	// Render row
	$FirePumpTypes_delete->renderRow();
?>
	<tr <?php echo $FirePumpTypes->rowAttributes() ?>>
<?php if ($FirePumpTypes_delete->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
		<td <?php echo $FirePumpTypes_delete->FirePumpType_Idn->cellAttributes() ?>>
<span id="el<?php echo $FirePumpTypes_delete->RowCount ?>_FirePumpTypes_FirePumpType_Idn" class="FirePumpTypes_FirePumpType_Idn">
<span<?php echo $FirePumpTypes_delete->FirePumpType_Idn->viewAttributes() ?>><?php echo $FirePumpTypes_delete->FirePumpType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FirePumpTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $FirePumpTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $FirePumpTypes_delete->RowCount ?>_FirePumpTypes_Name" class="FirePumpTypes_Name">
<span<?php echo $FirePumpTypes_delete->Name->viewAttributes() ?>><?php echo $FirePumpTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FirePumpTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $FirePumpTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $FirePumpTypes_delete->RowCount ?>_FirePumpTypes_Rank" class="FirePumpTypes_Rank">
<span<?php echo $FirePumpTypes_delete->Rank->viewAttributes() ?>><?php echo $FirePumpTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FirePumpTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $FirePumpTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $FirePumpTypes_delete->RowCount ?>_FirePumpTypes_ActiveFlag" class="FirePumpTypes_ActiveFlag">
<span<?php echo $FirePumpTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FirePumpTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FirePumpTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$FirePumpTypes_delete->Recordset->moveNext();
}
$FirePumpTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $FirePumpTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$FirePumpTypes_delete->showPageFooter();
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
$FirePumpTypes_delete->terminate();
?>