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
$HangerSubTypes_delete = new HangerSubTypes_delete();

// Run the page
$HangerSubTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HangerSubTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fHangerSubTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fHangerSubTypesdelete = currentForm = new ew.Form("fHangerSubTypesdelete", "delete");
	loadjs.done("fHangerSubTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $HangerSubTypes_delete->showPageHeader(); ?>
<?php
$HangerSubTypes_delete->showMessage();
?>
<form name="fHangerSubTypesdelete" id="fHangerSubTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="HangerSubTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($HangerSubTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($HangerSubTypes_delete->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<th class="<?php echo $HangerSubTypes_delete->HangerSubType_Idn->headerCellClass() ?>"><span id="elh_HangerSubTypes_HangerSubType_Idn" class="HangerSubTypes_HangerSubType_Idn"><?php echo $HangerSubTypes_delete->HangerSubType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($HangerSubTypes_delete->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<th class="<?php echo $HangerSubTypes_delete->HangerType_Idn->headerCellClass() ?>"><span id="elh_HangerSubTypes_HangerType_Idn" class="HangerSubTypes_HangerType_Idn"><?php echo $HangerSubTypes_delete->HangerType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($HangerSubTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $HangerSubTypes_delete->Name->headerCellClass() ?>"><span id="elh_HangerSubTypes_Name" class="HangerSubTypes_Name"><?php echo $HangerSubTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($HangerSubTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $HangerSubTypes_delete->Rank->headerCellClass() ?>"><span id="elh_HangerSubTypes_Rank" class="HangerSubTypes_Rank"><?php echo $HangerSubTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($HangerSubTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $HangerSubTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_HangerSubTypes_ActiveFlag" class="HangerSubTypes_ActiveFlag"><?php echo $HangerSubTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$HangerSubTypes_delete->RecordCount = 0;
$i = 0;
while (!$HangerSubTypes_delete->Recordset->EOF) {
	$HangerSubTypes_delete->RecordCount++;
	$HangerSubTypes_delete->RowCount++;

	// Set row properties
	$HangerSubTypes->resetAttributes();
	$HangerSubTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$HangerSubTypes_delete->loadRowValues($HangerSubTypes_delete->Recordset);

	// Render row
	$HangerSubTypes_delete->renderRow();
?>
	<tr <?php echo $HangerSubTypes->rowAttributes() ?>>
<?php if ($HangerSubTypes_delete->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<td <?php echo $HangerSubTypes_delete->HangerSubType_Idn->cellAttributes() ?>>
<span id="el<?php echo $HangerSubTypes_delete->RowCount ?>_HangerSubTypes_HangerSubType_Idn" class="HangerSubTypes_HangerSubType_Idn">
<span<?php echo $HangerSubTypes_delete->HangerSubType_Idn->viewAttributes() ?>><?php echo $HangerSubTypes_delete->HangerSubType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($HangerSubTypes_delete->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td <?php echo $HangerSubTypes_delete->HangerType_Idn->cellAttributes() ?>>
<span id="el<?php echo $HangerSubTypes_delete->RowCount ?>_HangerSubTypes_HangerType_Idn" class="HangerSubTypes_HangerType_Idn">
<span<?php echo $HangerSubTypes_delete->HangerType_Idn->viewAttributes() ?>><?php echo $HangerSubTypes_delete->HangerType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($HangerSubTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $HangerSubTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $HangerSubTypes_delete->RowCount ?>_HangerSubTypes_Name" class="HangerSubTypes_Name">
<span<?php echo $HangerSubTypes_delete->Name->viewAttributes() ?>><?php echo $HangerSubTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($HangerSubTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $HangerSubTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $HangerSubTypes_delete->RowCount ?>_HangerSubTypes_Rank" class="HangerSubTypes_Rank">
<span<?php echo $HangerSubTypes_delete->Rank->viewAttributes() ?>><?php echo $HangerSubTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($HangerSubTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $HangerSubTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $HangerSubTypes_delete->RowCount ?>_HangerSubTypes_ActiveFlag" class="HangerSubTypes_ActiveFlag">
<span<?php echo $HangerSubTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HangerSubTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HangerSubTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$HangerSubTypes_delete->Recordset->moveNext();
}
$HangerSubTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $HangerSubTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$HangerSubTypes_delete->showPageFooter();
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
$HangerSubTypes_delete->terminate();
?>