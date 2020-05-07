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
$SystemSubTypes_delete = new SystemSubTypes_delete();

// Run the page
$SystemSubTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SystemSubTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fSystemSubTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fSystemSubTypesdelete = currentForm = new ew.Form("fSystemSubTypesdelete", "delete");
	loadjs.done("fSystemSubTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $SystemSubTypes_delete->showPageHeader(); ?>
<?php
$SystemSubTypes_delete->showMessage();
?>
<form name="fSystemSubTypesdelete" id="fSystemSubTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SystemSubTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($SystemSubTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($SystemSubTypes_delete->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
		<th class="<?php echo $SystemSubTypes_delete->SystemSubType_Idn->headerCellClass() ?>"><span id="elh_SystemSubTypes_SystemSubType_Idn" class="SystemSubTypes_SystemSubType_Idn"><?php echo $SystemSubTypes_delete->SystemSubType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($SystemSubTypes_delete->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<th class="<?php echo $SystemSubTypes_delete->SystemType_Idn->headerCellClass() ?>"><span id="elh_SystemSubTypes_SystemType_Idn" class="SystemSubTypes_SystemType_Idn"><?php echo $SystemSubTypes_delete->SystemType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($SystemSubTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $SystemSubTypes_delete->Name->headerCellClass() ?>"><span id="elh_SystemSubTypes_Name" class="SystemSubTypes_Name"><?php echo $SystemSubTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($SystemSubTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $SystemSubTypes_delete->Rank->headerCellClass() ?>"><span id="elh_SystemSubTypes_Rank" class="SystemSubTypes_Rank"><?php echo $SystemSubTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($SystemSubTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $SystemSubTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_SystemSubTypes_ActiveFlag" class="SystemSubTypes_ActiveFlag"><?php echo $SystemSubTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$SystemSubTypes_delete->RecordCount = 0;
$i = 0;
while (!$SystemSubTypes_delete->Recordset->EOF) {
	$SystemSubTypes_delete->RecordCount++;
	$SystemSubTypes_delete->RowCount++;

	// Set row properties
	$SystemSubTypes->resetAttributes();
	$SystemSubTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$SystemSubTypes_delete->loadRowValues($SystemSubTypes_delete->Recordset);

	// Render row
	$SystemSubTypes_delete->renderRow();
?>
	<tr <?php echo $SystemSubTypes->rowAttributes() ?>>
<?php if ($SystemSubTypes_delete->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
		<td <?php echo $SystemSubTypes_delete->SystemSubType_Idn->cellAttributes() ?>>
<span id="el<?php echo $SystemSubTypes_delete->RowCount ?>_SystemSubTypes_SystemSubType_Idn" class="SystemSubTypes_SystemSubType_Idn">
<span<?php echo $SystemSubTypes_delete->SystemSubType_Idn->viewAttributes() ?>><?php echo $SystemSubTypes_delete->SystemSubType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SystemSubTypes_delete->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<td <?php echo $SystemSubTypes_delete->SystemType_Idn->cellAttributes() ?>>
<span id="el<?php echo $SystemSubTypes_delete->RowCount ?>_SystemSubTypes_SystemType_Idn" class="SystemSubTypes_SystemType_Idn">
<span<?php echo $SystemSubTypes_delete->SystemType_Idn->viewAttributes() ?>><?php echo $SystemSubTypes_delete->SystemType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SystemSubTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $SystemSubTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $SystemSubTypes_delete->RowCount ?>_SystemSubTypes_Name" class="SystemSubTypes_Name">
<span<?php echo $SystemSubTypes_delete->Name->viewAttributes() ?>><?php echo $SystemSubTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SystemSubTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $SystemSubTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $SystemSubTypes_delete->RowCount ?>_SystemSubTypes_Rank" class="SystemSubTypes_Rank">
<span<?php echo $SystemSubTypes_delete->Rank->viewAttributes() ?>><?php echo $SystemSubTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SystemSubTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $SystemSubTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $SystemSubTypes_delete->RowCount ?>_SystemSubTypes_ActiveFlag" class="SystemSubTypes_ActiveFlag">
<span<?php echo $SystemSubTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $SystemSubTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($SystemSubTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$SystemSubTypes_delete->Recordset->moveNext();
}
$SystemSubTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $SystemSubTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$SystemSubTypes_delete->showPageFooter();
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
$SystemSubTypes_delete->terminate();
?>