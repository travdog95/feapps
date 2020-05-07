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
$EstimateTypes_delete = new EstimateTypes_delete();

// Run the page
$EstimateTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$EstimateTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fEstimateTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fEstimateTypesdelete = currentForm = new ew.Form("fEstimateTypesdelete", "delete");
	loadjs.done("fEstimateTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $EstimateTypes_delete->showPageHeader(); ?>
<?php
$EstimateTypes_delete->showMessage();
?>
<form name="fEstimateTypesdelete" id="fEstimateTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="EstimateTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($EstimateTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($EstimateTypes_delete->EstimateType_Idn->Visible) { // EstimateType_Idn ?>
		<th class="<?php echo $EstimateTypes_delete->EstimateType_Idn->headerCellClass() ?>"><span id="elh_EstimateTypes_EstimateType_Idn" class="EstimateTypes_EstimateType_Idn"><?php echo $EstimateTypes_delete->EstimateType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($EstimateTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $EstimateTypes_delete->Name->headerCellClass() ?>"><span id="elh_EstimateTypes_Name" class="EstimateTypes_Name"><?php echo $EstimateTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($EstimateTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $EstimateTypes_delete->Rank->headerCellClass() ?>"><span id="elh_EstimateTypes_Rank" class="EstimateTypes_Rank"><?php echo $EstimateTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($EstimateTypes_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $EstimateTypes_delete->Department_Idn->headerCellClass() ?>"><span id="elh_EstimateTypes_Department_Idn" class="EstimateTypes_Department_Idn"><?php echo $EstimateTypes_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($EstimateTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $EstimateTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_EstimateTypes_ActiveFlag" class="EstimateTypes_ActiveFlag"><?php echo $EstimateTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$EstimateTypes_delete->RecordCount = 0;
$i = 0;
while (!$EstimateTypes_delete->Recordset->EOF) {
	$EstimateTypes_delete->RecordCount++;
	$EstimateTypes_delete->RowCount++;

	// Set row properties
	$EstimateTypes->resetAttributes();
	$EstimateTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$EstimateTypes_delete->loadRowValues($EstimateTypes_delete->Recordset);

	// Render row
	$EstimateTypes_delete->renderRow();
?>
	<tr <?php echo $EstimateTypes->rowAttributes() ?>>
<?php if ($EstimateTypes_delete->EstimateType_Idn->Visible) { // EstimateType_Idn ?>
		<td <?php echo $EstimateTypes_delete->EstimateType_Idn->cellAttributes() ?>>
<span id="el<?php echo $EstimateTypes_delete->RowCount ?>_EstimateTypes_EstimateType_Idn" class="EstimateTypes_EstimateType_Idn">
<span<?php echo $EstimateTypes_delete->EstimateType_Idn->viewAttributes() ?>><?php echo $EstimateTypes_delete->EstimateType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($EstimateTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $EstimateTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $EstimateTypes_delete->RowCount ?>_EstimateTypes_Name" class="EstimateTypes_Name">
<span<?php echo $EstimateTypes_delete->Name->viewAttributes() ?>><?php echo $EstimateTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($EstimateTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $EstimateTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $EstimateTypes_delete->RowCount ?>_EstimateTypes_Rank" class="EstimateTypes_Rank">
<span<?php echo $EstimateTypes_delete->Rank->viewAttributes() ?>><?php echo $EstimateTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($EstimateTypes_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $EstimateTypes_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $EstimateTypes_delete->RowCount ?>_EstimateTypes_Department_Idn" class="EstimateTypes_Department_Idn">
<span<?php echo $EstimateTypes_delete->Department_Idn->viewAttributes() ?>><?php echo $EstimateTypes_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($EstimateTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $EstimateTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $EstimateTypes_delete->RowCount ?>_EstimateTypes_ActiveFlag" class="EstimateTypes_ActiveFlag">
<span<?php echo $EstimateTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $EstimateTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($EstimateTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$EstimateTypes_delete->Recordset->moveNext();
}
$EstimateTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $EstimateTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$EstimateTypes_delete->showPageFooter();
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
$EstimateTypes_delete->terminate();
?>