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
$PipeTypes_delete = new PipeTypes_delete();

// Run the page
$PipeTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPipeTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fPipeTypesdelete = currentForm = new ew.Form("fPipeTypesdelete", "delete");
	loadjs.done("fPipeTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $PipeTypes_delete->showPageHeader(); ?>
<?php
$PipeTypes_delete->showMessage();
?>
<form name="fPipeTypesdelete" id="fPipeTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($PipeTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($PipeTypes_delete->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<th class="<?php echo $PipeTypes_delete->PipeType_Idn->headerCellClass() ?>"><span id="elh_PipeTypes_PipeType_Idn" class="PipeTypes_PipeType_Idn"><?php echo $PipeTypes_delete->PipeType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($PipeTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $PipeTypes_delete->Name->headerCellClass() ?>"><span id="elh_PipeTypes_Name" class="PipeTypes_Name"><?php echo $PipeTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($PipeTypes_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $PipeTypes_delete->Department_Idn->headerCellClass() ?>"><span id="elh_PipeTypes_Department_Idn" class="PipeTypes_Department_Idn"><?php echo $PipeTypes_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($PipeTypes_delete->IsUnderground->Visible) { // IsUnderground ?>
		<th class="<?php echo $PipeTypes_delete->IsUnderground->headerCellClass() ?>"><span id="elh_PipeTypes_IsUnderground" class="PipeTypes_IsUnderground"><?php echo $PipeTypes_delete->IsUnderground->caption() ?></span></th>
<?php } ?>
<?php if ($PipeTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $PipeTypes_delete->Rank->headerCellClass() ?>"><span id="elh_PipeTypes_Rank" class="PipeTypes_Rank"><?php echo $PipeTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($PipeTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $PipeTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_PipeTypes_ActiveFlag" class="PipeTypes_ActiveFlag"><?php echo $PipeTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$PipeTypes_delete->RecordCount = 0;
$i = 0;
while (!$PipeTypes_delete->Recordset->EOF) {
	$PipeTypes_delete->RecordCount++;
	$PipeTypes_delete->RowCount++;

	// Set row properties
	$PipeTypes->resetAttributes();
	$PipeTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$PipeTypes_delete->loadRowValues($PipeTypes_delete->Recordset);

	// Render row
	$PipeTypes_delete->renderRow();
?>
	<tr <?php echo $PipeTypes->rowAttributes() ?>>
<?php if ($PipeTypes_delete->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td <?php echo $PipeTypes_delete->PipeType_Idn->cellAttributes() ?>>
<span id="el<?php echo $PipeTypes_delete->RowCount ?>_PipeTypes_PipeType_Idn" class="PipeTypes_PipeType_Idn">
<span<?php echo $PipeTypes_delete->PipeType_Idn->viewAttributes() ?>><?php echo $PipeTypes_delete->PipeType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $PipeTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $PipeTypes_delete->RowCount ?>_PipeTypes_Name" class="PipeTypes_Name">
<span<?php echo $PipeTypes_delete->Name->viewAttributes() ?>><?php echo $PipeTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeTypes_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $PipeTypes_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $PipeTypes_delete->RowCount ?>_PipeTypes_Department_Idn" class="PipeTypes_Department_Idn">
<span<?php echo $PipeTypes_delete->Department_Idn->viewAttributes() ?>><?php echo $PipeTypes_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeTypes_delete->IsUnderground->Visible) { // IsUnderground ?>
		<td <?php echo $PipeTypes_delete->IsUnderground->cellAttributes() ?>>
<span id="el<?php echo $PipeTypes_delete->RowCount ?>_PipeTypes_IsUnderground" class="PipeTypes_IsUnderground">
<span<?php echo $PipeTypes_delete->IsUnderground->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsUnderground" class="custom-control-input" value="<?php echo $PipeTypes_delete->IsUnderground->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeTypes_delete->IsUnderground->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsUnderground"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($PipeTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $PipeTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $PipeTypes_delete->RowCount ?>_PipeTypes_Rank" class="PipeTypes_Rank">
<span<?php echo $PipeTypes_delete->Rank->viewAttributes() ?>><?php echo $PipeTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $PipeTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $PipeTypes_delete->RowCount ?>_PipeTypes_ActiveFlag" class="PipeTypes_ActiveFlag">
<span<?php echo $PipeTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PipeTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$PipeTypes_delete->Recordset->moveNext();
}
$PipeTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $PipeTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$PipeTypes_delete->showPageFooter();
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
$PipeTypes_delete->terminate();
?>