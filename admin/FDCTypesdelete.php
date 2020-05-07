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
$FDCTypes_delete = new FDCTypes_delete();

// Run the page
$FDCTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FDCTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fFDCTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fFDCTypesdelete = currentForm = new ew.Form("fFDCTypesdelete", "delete");
	loadjs.done("fFDCTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $FDCTypes_delete->showPageHeader(); ?>
<?php
$FDCTypes_delete->showMessage();
?>
<form name="fFDCTypesdelete" id="fFDCTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FDCTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($FDCTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($FDCTypes_delete->FdcType_Idn->Visible) { // FdcType_Idn ?>
		<th class="<?php echo $FDCTypes_delete->FdcType_Idn->headerCellClass() ?>"><span id="elh_FDCTypes_FdcType_Idn" class="FDCTypes_FdcType_Idn"><?php echo $FDCTypes_delete->FdcType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($FDCTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $FDCTypes_delete->Name->headerCellClass() ?>"><span id="elh_FDCTypes_Name" class="FDCTypes_Name"><?php echo $FDCTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($FDCTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $FDCTypes_delete->Rank->headerCellClass() ?>"><span id="elh_FDCTypes_Rank" class="FDCTypes_Rank"><?php echo $FDCTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($FDCTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $FDCTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_FDCTypes_ActiveFlag" class="FDCTypes_ActiveFlag"><?php echo $FDCTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$FDCTypes_delete->RecordCount = 0;
$i = 0;
while (!$FDCTypes_delete->Recordset->EOF) {
	$FDCTypes_delete->RecordCount++;
	$FDCTypes_delete->RowCount++;

	// Set row properties
	$FDCTypes->resetAttributes();
	$FDCTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$FDCTypes_delete->loadRowValues($FDCTypes_delete->Recordset);

	// Render row
	$FDCTypes_delete->renderRow();
?>
	<tr <?php echo $FDCTypes->rowAttributes() ?>>
<?php if ($FDCTypes_delete->FdcType_Idn->Visible) { // FdcType_Idn ?>
		<td <?php echo $FDCTypes_delete->FdcType_Idn->cellAttributes() ?>>
<span id="el<?php echo $FDCTypes_delete->RowCount ?>_FDCTypes_FdcType_Idn" class="FDCTypes_FdcType_Idn">
<span<?php echo $FDCTypes_delete->FdcType_Idn->viewAttributes() ?>><?php echo $FDCTypes_delete->FdcType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FDCTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $FDCTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $FDCTypes_delete->RowCount ?>_FDCTypes_Name" class="FDCTypes_Name">
<span<?php echo $FDCTypes_delete->Name->viewAttributes() ?>><?php echo $FDCTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FDCTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $FDCTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $FDCTypes_delete->RowCount ?>_FDCTypes_Rank" class="FDCTypes_Rank">
<span<?php echo $FDCTypes_delete->Rank->viewAttributes() ?>><?php echo $FDCTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FDCTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $FDCTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $FDCTypes_delete->RowCount ?>_FDCTypes_ActiveFlag" class="FDCTypes_ActiveFlag">
<span<?php echo $FDCTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FDCTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FDCTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$FDCTypes_delete->Recordset->moveNext();
}
$FDCTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $FDCTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$FDCTypes_delete->showPageFooter();
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
$FDCTypes_delete->terminate();
?>