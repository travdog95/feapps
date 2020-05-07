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
$WorksheetCategories_delete = new WorksheetCategories_delete();

// Run the page
$WorksheetCategories_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetCategories_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetCategoriesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fWorksheetCategoriesdelete = currentForm = new ew.Form("fWorksheetCategoriesdelete", "delete");
	loadjs.done("fWorksheetCategoriesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetCategories_delete->showPageHeader(); ?>
<?php
$WorksheetCategories_delete->showMessage();
?>
<form name="fWorksheetCategoriesdelete" id="fWorksheetCategoriesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetCategories">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($WorksheetCategories_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($WorksheetCategories_delete->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<th class="<?php echo $WorksheetCategories_delete->WorksheetCategory_Idn->headerCellClass() ?>"><span id="elh_WorksheetCategories_WorksheetCategory_Idn" class="WorksheetCategories_WorksheetCategory_Idn"><?php echo $WorksheetCategories_delete->WorksheetCategory_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetCategories_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $WorksheetCategories_delete->Name->headerCellClass() ?>"><span id="elh_WorksheetCategories_Name" class="WorksheetCategories_Name"><?php echo $WorksheetCategories_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetCategories_delete->ShortName->Visible) { // ShortName ?>
		<th class="<?php echo $WorksheetCategories_delete->ShortName->headerCellClass() ?>"><span id="elh_WorksheetCategories_ShortName" class="WorksheetCategories_ShortName"><?php echo $WorksheetCategories_delete->ShortName->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetCategories_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $WorksheetCategories_delete->Department_Idn->headerCellClass() ?>"><span id="elh_WorksheetCategories_Department_Idn" class="WorksheetCategories_Department_Idn"><?php echo $WorksheetCategories_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetCategories_delete->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<th class="<?php echo $WorksheetCategories_delete->FieldUnitPrice->headerCellClass() ?>"><span id="elh_WorksheetCategories_FieldUnitPrice" class="WorksheetCategories_FieldUnitPrice"><?php echo $WorksheetCategories_delete->FieldUnitPrice->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetCategories_delete->IsFitting->Visible) { // IsFitting ?>
		<th class="<?php echo $WorksheetCategories_delete->IsFitting->headerCellClass() ?>"><span id="elh_WorksheetCategories_IsFitting" class="WorksheetCategories_IsFitting"><?php echo $WorksheetCategories_delete->IsFitting->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetCategories_delete->CartFlag->Visible) { // CartFlag ?>
		<th class="<?php echo $WorksheetCategories_delete->CartFlag->headerCellClass() ?>"><span id="elh_WorksheetCategories_CartFlag" class="WorksheetCategories_CartFlag"><?php echo $WorksheetCategories_delete->CartFlag->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetCategories_delete->IsShared->Visible) { // IsShared ?>
		<th class="<?php echo $WorksheetCategories_delete->IsShared->headerCellClass() ?>"><span id="elh_WorksheetCategories_IsShared" class="WorksheetCategories_IsShared"><?php echo $WorksheetCategories_delete->IsShared->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetCategories_delete->IsAssembly->Visible) { // IsAssembly ?>
		<th class="<?php echo $WorksheetCategories_delete->IsAssembly->headerCellClass() ?>"><span id="elh_WorksheetCategories_IsAssembly" class="WorksheetCategories_IsAssembly"><?php echo $WorksheetCategories_delete->IsAssembly->caption() ?></span></th>
<?php } ?>
<?php if ($WorksheetCategories_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $WorksheetCategories_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_WorksheetCategories_ActiveFlag" class="WorksheetCategories_ActiveFlag"><?php echo $WorksheetCategories_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$WorksheetCategories_delete->RecordCount = 0;
$i = 0;
while (!$WorksheetCategories_delete->Recordset->EOF) {
	$WorksheetCategories_delete->RecordCount++;
	$WorksheetCategories_delete->RowCount++;

	// Set row properties
	$WorksheetCategories->resetAttributes();
	$WorksheetCategories->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$WorksheetCategories_delete->loadRowValues($WorksheetCategories_delete->Recordset);

	// Render row
	$WorksheetCategories_delete->renderRow();
?>
	<tr <?php echo $WorksheetCategories->rowAttributes() ?>>
<?php if ($WorksheetCategories_delete->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td <?php echo $WorksheetCategories_delete->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetCategories_delete->RowCount ?>_WorksheetCategories_WorksheetCategory_Idn" class="WorksheetCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetCategories_delete->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $WorksheetCategories_delete->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetCategories_delete->Name->Visible) { // Name ?>
		<td <?php echo $WorksheetCategories_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $WorksheetCategories_delete->RowCount ?>_WorksheetCategories_Name" class="WorksheetCategories_Name">
<span<?php echo $WorksheetCategories_delete->Name->viewAttributes() ?>><?php echo $WorksheetCategories_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetCategories_delete->ShortName->Visible) { // ShortName ?>
		<td <?php echo $WorksheetCategories_delete->ShortName->cellAttributes() ?>>
<span id="el<?php echo $WorksheetCategories_delete->RowCount ?>_WorksheetCategories_ShortName" class="WorksheetCategories_ShortName">
<span<?php echo $WorksheetCategories_delete->ShortName->viewAttributes() ?>><?php echo $WorksheetCategories_delete->ShortName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetCategories_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $WorksheetCategories_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $WorksheetCategories_delete->RowCount ?>_WorksheetCategories_Department_Idn" class="WorksheetCategories_Department_Idn">
<span<?php echo $WorksheetCategories_delete->Department_Idn->viewAttributes() ?>><?php echo $WorksheetCategories_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetCategories_delete->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<td <?php echo $WorksheetCategories_delete->FieldUnitPrice->cellAttributes() ?>>
<span id="el<?php echo $WorksheetCategories_delete->RowCount ?>_WorksheetCategories_FieldUnitPrice" class="WorksheetCategories_FieldUnitPrice">
<span<?php echo $WorksheetCategories_delete->FieldUnitPrice->viewAttributes() ?>><?php echo $WorksheetCategories_delete->FieldUnitPrice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetCategories_delete->IsFitting->Visible) { // IsFitting ?>
		<td <?php echo $WorksheetCategories_delete->IsFitting->cellAttributes() ?>>
<span id="el<?php echo $WorksheetCategories_delete->RowCount ?>_WorksheetCategories_IsFitting" class="WorksheetCategories_IsFitting">
<span<?php echo $WorksheetCategories_delete->IsFitting->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsFitting" class="custom-control-input" value="<?php echo $WorksheetCategories_delete->IsFitting->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories_delete->IsFitting->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsFitting"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetCategories_delete->CartFlag->Visible) { // CartFlag ?>
		<td <?php echo $WorksheetCategories_delete->CartFlag->cellAttributes() ?>>
<span id="el<?php echo $WorksheetCategories_delete->RowCount ?>_WorksheetCategories_CartFlag" class="WorksheetCategories_CartFlag">
<span<?php echo $WorksheetCategories_delete->CartFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CartFlag" class="custom-control-input" value="<?php echo $WorksheetCategories_delete->CartFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories_delete->CartFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CartFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetCategories_delete->IsShared->Visible) { // IsShared ?>
		<td <?php echo $WorksheetCategories_delete->IsShared->cellAttributes() ?>>
<span id="el<?php echo $WorksheetCategories_delete->RowCount ?>_WorksheetCategories_IsShared" class="WorksheetCategories_IsShared">
<span<?php echo $WorksheetCategories_delete->IsShared->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsShared" class="custom-control-input" value="<?php echo $WorksheetCategories_delete->IsShared->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories_delete->IsShared->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsShared"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetCategories_delete->IsAssembly->Visible) { // IsAssembly ?>
		<td <?php echo $WorksheetCategories_delete->IsAssembly->cellAttributes() ?>>
<span id="el<?php echo $WorksheetCategories_delete->RowCount ?>_WorksheetCategories_IsAssembly" class="WorksheetCategories_IsAssembly">
<span<?php echo $WorksheetCategories_delete->IsAssembly->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsAssembly" class="custom-control-input" value="<?php echo $WorksheetCategories_delete->IsAssembly->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories_delete->IsAssembly->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsAssembly"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($WorksheetCategories_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $WorksheetCategories_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $WorksheetCategories_delete->RowCount ?>_WorksheetCategories_ActiveFlag" class="WorksheetCategories_ActiveFlag">
<span<?php echo $WorksheetCategories_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $WorksheetCategories_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$WorksheetCategories_delete->Recordset->moveNext();
}
$WorksheetCategories_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetCategories_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$WorksheetCategories_delete->showPageFooter();
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
$WorksheetCategories_delete->terminate();
?>