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
$HangerTypes_delete = new HangerTypes_delete();

// Run the page
$HangerTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HangerTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fHangerTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fHangerTypesdelete = currentForm = new ew.Form("fHangerTypesdelete", "delete");
	loadjs.done("fHangerTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $HangerTypes_delete->showPageHeader(); ?>
<?php
$HangerTypes_delete->showMessage();
?>
<form name="fHangerTypesdelete" id="fHangerTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="HangerTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($HangerTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($HangerTypes_delete->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<th class="<?php echo $HangerTypes_delete->HangerType_Idn->headerCellClass() ?>"><span id="elh_HangerTypes_HangerType_Idn" class="HangerTypes_HangerType_Idn"><?php echo $HangerTypes_delete->HangerType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($HangerTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $HangerTypes_delete->Name->headerCellClass() ?>"><span id="elh_HangerTypes_Name" class="HangerTypes_Name"><?php echo $HangerTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($HangerTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $HangerTypes_delete->Rank->headerCellClass() ?>"><span id="elh_HangerTypes_Rank" class="HangerTypes_Rank"><?php echo $HangerTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($HangerTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $HangerTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_HangerTypes_ActiveFlag" class="HangerTypes_ActiveFlag"><?php echo $HangerTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$HangerTypes_delete->RecordCount = 0;
$i = 0;
while (!$HangerTypes_delete->Recordset->EOF) {
	$HangerTypes_delete->RecordCount++;
	$HangerTypes_delete->RowCount++;

	// Set row properties
	$HangerTypes->resetAttributes();
	$HangerTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$HangerTypes_delete->loadRowValues($HangerTypes_delete->Recordset);

	// Render row
	$HangerTypes_delete->renderRow();
?>
	<tr <?php echo $HangerTypes->rowAttributes() ?>>
<?php if ($HangerTypes_delete->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td <?php echo $HangerTypes_delete->HangerType_Idn->cellAttributes() ?>>
<span id="el<?php echo $HangerTypes_delete->RowCount ?>_HangerTypes_HangerType_Idn" class="HangerTypes_HangerType_Idn">
<span<?php echo $HangerTypes_delete->HangerType_Idn->viewAttributes() ?>><?php echo $HangerTypes_delete->HangerType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($HangerTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $HangerTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $HangerTypes_delete->RowCount ?>_HangerTypes_Name" class="HangerTypes_Name">
<span<?php echo $HangerTypes_delete->Name->viewAttributes() ?>><?php echo $HangerTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($HangerTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $HangerTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $HangerTypes_delete->RowCount ?>_HangerTypes_Rank" class="HangerTypes_Rank">
<span<?php echo $HangerTypes_delete->Rank->viewAttributes() ?>><?php echo $HangerTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($HangerTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $HangerTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $HangerTypes_delete->RowCount ?>_HangerTypes_ActiveFlag" class="HangerTypes_ActiveFlag">
<span<?php echo $HangerTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HangerTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HangerTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$HangerTypes_delete->Recordset->moveNext();
}
$HangerTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $HangerTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$HangerTypes_delete->showPageFooter();
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
$HangerTypes_delete->terminate();
?>