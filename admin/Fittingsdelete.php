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
$Fittings_delete = new Fittings_delete();

// Run the page
$Fittings_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Fittings_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fFittingsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fFittingsdelete = currentForm = new ew.Form("fFittingsdelete", "delete");
	loadjs.done("fFittingsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Fittings_delete->showPageHeader(); ?>
<?php
$Fittings_delete->showMessage();
?>
<form name="fFittingsdelete" id="fFittingsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Fittings">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Fittings_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Fittings_delete->Fitting_Idn->Visible) { // Fitting_Idn ?>
		<th class="<?php echo $Fittings_delete->Fitting_Idn->headerCellClass() ?>"><span id="elh_Fittings_Fitting_Idn" class="Fittings_Fitting_Idn"><?php echo $Fittings_delete->Fitting_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Fittings_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $Fittings_delete->Name->headerCellClass() ?>"><span id="elh_Fittings_Name" class="Fittings_Name"><?php echo $Fittings_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($Fittings_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $Fittings_delete->Department_Idn->headerCellClass() ?>"><span id="elh_Fittings_Department_Idn" class="Fittings_Department_Idn"><?php echo $Fittings_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Fittings_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<th class="<?php echo $Fittings_delete->WorksheetMaster_Idn->headerCellClass() ?>"><span id="elh_Fittings_WorksheetMaster_Idn" class="Fittings_WorksheetMaster_Idn"><?php echo $Fittings_delete->WorksheetMaster_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Fittings_delete->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<th class="<?php echo $Fittings_delete->WorksheetCategory_Idn->headerCellClass() ?>"><span id="elh_Fittings_WorksheetCategory_Idn" class="Fittings_WorksheetCategory_Idn"><?php echo $Fittings_delete->WorksheetCategory_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Fittings_delete->PartOfSetFlag->Visible) { // PartOfSetFlag ?>
		<th class="<?php echo $Fittings_delete->PartOfSetFlag->headerCellClass() ?>"><span id="elh_Fittings_PartOfSetFlag" class="Fittings_PartOfSetFlag"><?php echo $Fittings_delete->PartOfSetFlag->caption() ?></span></th>
<?php } ?>
<?php if ($Fittings_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $Fittings_delete->Rank->headerCellClass() ?>"><span id="elh_Fittings_Rank" class="Fittings_Rank"><?php echo $Fittings_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($Fittings_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $Fittings_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_Fittings_ActiveFlag" class="Fittings_ActiveFlag"><?php echo $Fittings_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Fittings_delete->RecordCount = 0;
$i = 0;
while (!$Fittings_delete->Recordset->EOF) {
	$Fittings_delete->RecordCount++;
	$Fittings_delete->RowCount++;

	// Set row properties
	$Fittings->resetAttributes();
	$Fittings->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Fittings_delete->loadRowValues($Fittings_delete->Recordset);

	// Render row
	$Fittings_delete->renderRow();
?>
	<tr <?php echo $Fittings->rowAttributes() ?>>
<?php if ($Fittings_delete->Fitting_Idn->Visible) { // Fitting_Idn ?>
		<td <?php echo $Fittings_delete->Fitting_Idn->cellAttributes() ?>>
<span id="el<?php echo $Fittings_delete->RowCount ?>_Fittings_Fitting_Idn" class="Fittings_Fitting_Idn">
<span<?php echo $Fittings_delete->Fitting_Idn->viewAttributes() ?>><?php echo $Fittings_delete->Fitting_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Fittings_delete->Name->Visible) { // Name ?>
		<td <?php echo $Fittings_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $Fittings_delete->RowCount ?>_Fittings_Name" class="Fittings_Name">
<span<?php echo $Fittings_delete->Name->viewAttributes() ?>><?php echo $Fittings_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Fittings_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $Fittings_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $Fittings_delete->RowCount ?>_Fittings_Department_Idn" class="Fittings_Department_Idn">
<span<?php echo $Fittings_delete->Department_Idn->viewAttributes() ?>><?php echo $Fittings_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Fittings_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td <?php echo $Fittings_delete->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $Fittings_delete->RowCount ?>_Fittings_WorksheetMaster_Idn" class="Fittings_WorksheetMaster_Idn">
<span<?php echo $Fittings_delete->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $Fittings_delete->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Fittings_delete->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td <?php echo $Fittings_delete->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el<?php echo $Fittings_delete->RowCount ?>_Fittings_WorksheetCategory_Idn" class="Fittings_WorksheetCategory_Idn">
<span<?php echo $Fittings_delete->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $Fittings_delete->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Fittings_delete->PartOfSetFlag->Visible) { // PartOfSetFlag ?>
		<td <?php echo $Fittings_delete->PartOfSetFlag->cellAttributes() ?>>
<span id="el<?php echo $Fittings_delete->RowCount ?>_Fittings_PartOfSetFlag" class="Fittings_PartOfSetFlag">
<span<?php echo $Fittings_delete->PartOfSetFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_PartOfSetFlag" class="custom-control-input" value="<?php echo $Fittings_delete->PartOfSetFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Fittings_delete->PartOfSetFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_PartOfSetFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Fittings_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $Fittings_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $Fittings_delete->RowCount ?>_Fittings_Rank" class="Fittings_Rank">
<span<?php echo $Fittings_delete->Rank->viewAttributes() ?>><?php echo $Fittings_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Fittings_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $Fittings_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $Fittings_delete->RowCount ?>_Fittings_ActiveFlag" class="Fittings_ActiveFlag">
<span<?php echo $Fittings_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Fittings_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Fittings_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Fittings_delete->Recordset->moveNext();
}
$Fittings_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Fittings_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Fittings_delete->showPageFooter();
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
$Fittings_delete->terminate();
?>