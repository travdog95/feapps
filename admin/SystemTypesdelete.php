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
$SystemTypes_delete = new SystemTypes_delete();

// Run the page
$SystemTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SystemTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fSystemTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fSystemTypesdelete = currentForm = new ew.Form("fSystemTypesdelete", "delete");
	loadjs.done("fSystemTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $SystemTypes_delete->showPageHeader(); ?>
<?php
$SystemTypes_delete->showMessage();
?>
<form name="fSystemTypesdelete" id="fSystemTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SystemTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($SystemTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($SystemTypes_delete->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<th class="<?php echo $SystemTypes_delete->SystemType_Idn->headerCellClass() ?>"><span id="elh_SystemTypes_SystemType_Idn" class="SystemTypes_SystemType_Idn"><?php echo $SystemTypes_delete->SystemType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($SystemTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $SystemTypes_delete->Name->headerCellClass() ?>"><span id="elh_SystemTypes_Name" class="SystemTypes_Name"><?php echo $SystemTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($SystemTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $SystemTypes_delete->Rank->headerCellClass() ?>"><span id="elh_SystemTypes_Rank" class="SystemTypes_Rank"><?php echo $SystemTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($SystemTypes_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $SystemTypes_delete->Department_Idn->headerCellClass() ?>"><span id="elh_SystemTypes_Department_Idn" class="SystemTypes_Department_Idn"><?php echo $SystemTypes_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($SystemTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $SystemTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_SystemTypes_ActiveFlag" class="SystemTypes_ActiveFlag"><?php echo $SystemTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$SystemTypes_delete->RecordCount = 0;
$i = 0;
while (!$SystemTypes_delete->Recordset->EOF) {
	$SystemTypes_delete->RecordCount++;
	$SystemTypes_delete->RowCount++;

	// Set row properties
	$SystemTypes->resetAttributes();
	$SystemTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$SystemTypes_delete->loadRowValues($SystemTypes_delete->Recordset);

	// Render row
	$SystemTypes_delete->renderRow();
?>
	<tr <?php echo $SystemTypes->rowAttributes() ?>>
<?php if ($SystemTypes_delete->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<td <?php echo $SystemTypes_delete->SystemType_Idn->cellAttributes() ?>>
<span id="el<?php echo $SystemTypes_delete->RowCount ?>_SystemTypes_SystemType_Idn" class="SystemTypes_SystemType_Idn">
<span<?php echo $SystemTypes_delete->SystemType_Idn->viewAttributes() ?>><?php echo $SystemTypes_delete->SystemType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SystemTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $SystemTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $SystemTypes_delete->RowCount ?>_SystemTypes_Name" class="SystemTypes_Name">
<span<?php echo $SystemTypes_delete->Name->viewAttributes() ?>><?php echo $SystemTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SystemTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $SystemTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $SystemTypes_delete->RowCount ?>_SystemTypes_Rank" class="SystemTypes_Rank">
<span<?php echo $SystemTypes_delete->Rank->viewAttributes() ?>><?php echo $SystemTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SystemTypes_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $SystemTypes_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $SystemTypes_delete->RowCount ?>_SystemTypes_Department_Idn" class="SystemTypes_Department_Idn">
<span<?php echo $SystemTypes_delete->Department_Idn->viewAttributes() ?>><?php echo $SystemTypes_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SystemTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $SystemTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $SystemTypes_delete->RowCount ?>_SystemTypes_ActiveFlag" class="SystemTypes_ActiveFlag">
<span<?php echo $SystemTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $SystemTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($SystemTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$SystemTypes_delete->Recordset->moveNext();
}
$SystemTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $SystemTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$SystemTypes_delete->showPageFooter();
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
$SystemTypes_delete->terminate();
?>