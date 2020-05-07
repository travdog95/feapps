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
$EngineeringAdditionalCosts_delete = new EngineeringAdditionalCosts_delete();

// Run the page
$EngineeringAdditionalCosts_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$EngineeringAdditionalCosts_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fEngineeringAdditionalCostsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fEngineeringAdditionalCostsdelete = currentForm = new ew.Form("fEngineeringAdditionalCostsdelete", "delete");
	loadjs.done("fEngineeringAdditionalCostsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $EngineeringAdditionalCosts_delete->showPageHeader(); ?>
<?php
$EngineeringAdditionalCosts_delete->showMessage();
?>
<form name="fEngineeringAdditionalCostsdelete" id="fEngineeringAdditionalCostsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="EngineeringAdditionalCosts">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($EngineeringAdditionalCosts_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($EngineeringAdditionalCosts_delete->EngineeringAdditionalCost_Idn->Visible) { // EngineeringAdditionalCost_Idn ?>
		<th class="<?php echo $EngineeringAdditionalCosts_delete->EngineeringAdditionalCost_Idn->headerCellClass() ?>"><span id="elh_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn" class="EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn"><?php echo $EngineeringAdditionalCosts_delete->EngineeringAdditionalCost_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->LineNumber->Visible) { // LineNumber ?>
		<th class="<?php echo $EngineeringAdditionalCosts_delete->LineNumber->headerCellClass() ?>"><span id="elh_EngineeringAdditionalCosts_LineNumber" class="EngineeringAdditionalCosts_LineNumber"><?php echo $EngineeringAdditionalCosts_delete->LineNumber->caption() ?></span></th>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->Quantity->Visible) { // Quantity ?>
		<th class="<?php echo $EngineeringAdditionalCosts_delete->Quantity->headerCellClass() ?>"><span id="elh_EngineeringAdditionalCosts_Quantity" class="EngineeringAdditionalCosts_Quantity"><?php echo $EngineeringAdditionalCosts_delete->Quantity->caption() ?></span></th>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $EngineeringAdditionalCosts_delete->Name->headerCellClass() ?>"><span id="elh_EngineeringAdditionalCosts_Name" class="EngineeringAdditionalCosts_Name"><?php echo $EngineeringAdditionalCosts_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->ManHours->Visible) { // ManHours ?>
		<th class="<?php echo $EngineeringAdditionalCosts_delete->ManHours->headerCellClass() ?>"><span id="elh_EngineeringAdditionalCosts_ManHours" class="EngineeringAdditionalCosts_ManHours"><?php echo $EngineeringAdditionalCosts_delete->ManHours->caption() ?></span></th>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $EngineeringAdditionalCosts_delete->Rank->headerCellClass() ?>"><span id="elh_EngineeringAdditionalCosts_Rank" class="EngineeringAdditionalCosts_Rank"><?php echo $EngineeringAdditionalCosts_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->Parent_Idn->Visible) { // Parent_Idn ?>
		<th class="<?php echo $EngineeringAdditionalCosts_delete->Parent_Idn->headerCellClass() ?>"><span id="elh_EngineeringAdditionalCosts_Parent_Idn" class="EngineeringAdditionalCosts_Parent_Idn"><?php echo $EngineeringAdditionalCosts_delete->Parent_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->DefaultFlag->Visible) { // DefaultFlag ?>
		<th class="<?php echo $EngineeringAdditionalCosts_delete->DefaultFlag->headerCellClass() ?>"><span id="elh_EngineeringAdditionalCosts_DefaultFlag" class="EngineeringAdditionalCosts_DefaultFlag"><?php echo $EngineeringAdditionalCosts_delete->DefaultFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$EngineeringAdditionalCosts_delete->RecordCount = 0;
$i = 0;
while (!$EngineeringAdditionalCosts_delete->Recordset->EOF) {
	$EngineeringAdditionalCosts_delete->RecordCount++;
	$EngineeringAdditionalCosts_delete->RowCount++;

	// Set row properties
	$EngineeringAdditionalCosts->resetAttributes();
	$EngineeringAdditionalCosts->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$EngineeringAdditionalCosts_delete->loadRowValues($EngineeringAdditionalCosts_delete->Recordset);

	// Render row
	$EngineeringAdditionalCosts_delete->renderRow();
?>
	<tr <?php echo $EngineeringAdditionalCosts->rowAttributes() ?>>
<?php if ($EngineeringAdditionalCosts_delete->EngineeringAdditionalCost_Idn->Visible) { // EngineeringAdditionalCost_Idn ?>
		<td <?php echo $EngineeringAdditionalCosts_delete->EngineeringAdditionalCost_Idn->cellAttributes() ?>>
<span id="el<?php echo $EngineeringAdditionalCosts_delete->RowCount ?>_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn" class="EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn">
<span<?php echo $EngineeringAdditionalCosts_delete->EngineeringAdditionalCost_Idn->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_delete->EngineeringAdditionalCost_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->LineNumber->Visible) { // LineNumber ?>
		<td <?php echo $EngineeringAdditionalCosts_delete->LineNumber->cellAttributes() ?>>
<span id="el<?php echo $EngineeringAdditionalCosts_delete->RowCount ?>_EngineeringAdditionalCosts_LineNumber" class="EngineeringAdditionalCosts_LineNumber">
<span<?php echo $EngineeringAdditionalCosts_delete->LineNumber->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_delete->LineNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->Quantity->Visible) { // Quantity ?>
		<td <?php echo $EngineeringAdditionalCosts_delete->Quantity->cellAttributes() ?>>
<span id="el<?php echo $EngineeringAdditionalCosts_delete->RowCount ?>_EngineeringAdditionalCosts_Quantity" class="EngineeringAdditionalCosts_Quantity">
<span<?php echo $EngineeringAdditionalCosts_delete->Quantity->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_delete->Quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->Name->Visible) { // Name ?>
		<td <?php echo $EngineeringAdditionalCosts_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $EngineeringAdditionalCosts_delete->RowCount ?>_EngineeringAdditionalCosts_Name" class="EngineeringAdditionalCosts_Name">
<span<?php echo $EngineeringAdditionalCosts_delete->Name->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->ManHours->Visible) { // ManHours ?>
		<td <?php echo $EngineeringAdditionalCosts_delete->ManHours->cellAttributes() ?>>
<span id="el<?php echo $EngineeringAdditionalCosts_delete->RowCount ?>_EngineeringAdditionalCosts_ManHours" class="EngineeringAdditionalCosts_ManHours">
<span<?php echo $EngineeringAdditionalCosts_delete->ManHours->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_delete->ManHours->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $EngineeringAdditionalCosts_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $EngineeringAdditionalCosts_delete->RowCount ?>_EngineeringAdditionalCosts_Rank" class="EngineeringAdditionalCosts_Rank">
<span<?php echo $EngineeringAdditionalCosts_delete->Rank->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->Parent_Idn->Visible) { // Parent_Idn ?>
		<td <?php echo $EngineeringAdditionalCosts_delete->Parent_Idn->cellAttributes() ?>>
<span id="el<?php echo $EngineeringAdditionalCosts_delete->RowCount ?>_EngineeringAdditionalCosts_Parent_Idn" class="EngineeringAdditionalCosts_Parent_Idn">
<span<?php echo $EngineeringAdditionalCosts_delete->Parent_Idn->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_delete->Parent_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_delete->DefaultFlag->Visible) { // DefaultFlag ?>
		<td <?php echo $EngineeringAdditionalCosts_delete->DefaultFlag->cellAttributes() ?>>
<span id="el<?php echo $EngineeringAdditionalCosts_delete->RowCount ?>_EngineeringAdditionalCosts_DefaultFlag" class="EngineeringAdditionalCosts_DefaultFlag">
<span<?php echo $EngineeringAdditionalCosts_delete->DefaultFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DefaultFlag" class="custom-control-input" value="<?php echo $EngineeringAdditionalCosts_delete->DefaultFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($EngineeringAdditionalCosts_delete->DefaultFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DefaultFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$EngineeringAdditionalCosts_delete->Recordset->moveNext();
}
$EngineeringAdditionalCosts_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $EngineeringAdditionalCosts_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$EngineeringAdditionalCosts_delete->showPageFooter();
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
$EngineeringAdditionalCosts_delete->terminate();
?>