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
$BackflowTypes_delete = new BackflowTypes_delete();

// Run the page
$BackflowTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$BackflowTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fBackflowTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fBackflowTypesdelete = currentForm = new ew.Form("fBackflowTypesdelete", "delete");
	loadjs.done("fBackflowTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $BackflowTypes_delete->showPageHeader(); ?>
<?php
$BackflowTypes_delete->showMessage();
?>
<form name="fBackflowTypesdelete" id="fBackflowTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="BackflowTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($BackflowTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($BackflowTypes_delete->BackflowType_Idn->Visible) { // BackflowType_Idn ?>
		<th class="<?php echo $BackflowTypes_delete->BackflowType_Idn->headerCellClass() ?>"><span id="elh_BackflowTypes_BackflowType_Idn" class="BackflowTypes_BackflowType_Idn"><?php echo $BackflowTypes_delete->BackflowType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($BackflowTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $BackflowTypes_delete->Name->headerCellClass() ?>"><span id="elh_BackflowTypes_Name" class="BackflowTypes_Name"><?php echo $BackflowTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($BackflowTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $BackflowTypes_delete->Rank->headerCellClass() ?>"><span id="elh_BackflowTypes_Rank" class="BackflowTypes_Rank"><?php echo $BackflowTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($BackflowTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $BackflowTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_BackflowTypes_ActiveFlag" class="BackflowTypes_ActiveFlag"><?php echo $BackflowTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$BackflowTypes_delete->RecordCount = 0;
$i = 0;
while (!$BackflowTypes_delete->Recordset->EOF) {
	$BackflowTypes_delete->RecordCount++;
	$BackflowTypes_delete->RowCount++;

	// Set row properties
	$BackflowTypes->resetAttributes();
	$BackflowTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$BackflowTypes_delete->loadRowValues($BackflowTypes_delete->Recordset);

	// Render row
	$BackflowTypes_delete->renderRow();
?>
	<tr <?php echo $BackflowTypes->rowAttributes() ?>>
<?php if ($BackflowTypes_delete->BackflowType_Idn->Visible) { // BackflowType_Idn ?>
		<td <?php echo $BackflowTypes_delete->BackflowType_Idn->cellAttributes() ?>>
<span id="el<?php echo $BackflowTypes_delete->RowCount ?>_BackflowTypes_BackflowType_Idn" class="BackflowTypes_BackflowType_Idn">
<span<?php echo $BackflowTypes_delete->BackflowType_Idn->viewAttributes() ?>><?php echo $BackflowTypes_delete->BackflowType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BackflowTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $BackflowTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $BackflowTypes_delete->RowCount ?>_BackflowTypes_Name" class="BackflowTypes_Name">
<span<?php echo $BackflowTypes_delete->Name->viewAttributes() ?>><?php echo $BackflowTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BackflowTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $BackflowTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $BackflowTypes_delete->RowCount ?>_BackflowTypes_Rank" class="BackflowTypes_Rank">
<span<?php echo $BackflowTypes_delete->Rank->viewAttributes() ?>><?php echo $BackflowTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($BackflowTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $BackflowTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $BackflowTypes_delete->RowCount ?>_BackflowTypes_ActiveFlag" class="BackflowTypes_ActiveFlag">
<span<?php echo $BackflowTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $BackflowTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($BackflowTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$BackflowTypes_delete->Recordset->moveNext();
}
$BackflowTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $BackflowTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$BackflowTypes_delete->showPageFooter();
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
$BackflowTypes_delete->terminate();
?>