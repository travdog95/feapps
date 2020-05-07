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
$CartParms_delete = new CartParms_delete();

// Run the page
$CartParms_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CartParms_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCartParmsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fCartParmsdelete = currentForm = new ew.Form("fCartParmsdelete", "delete");
	loadjs.done("fCartParmsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $CartParms_delete->showPageHeader(); ?>
<?php
$CartParms_delete->showMessage();
?>
<form name="fCartParmsdelete" id="fCartParmsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CartParms">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($CartParms_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($CartParms_delete->CartParm_Idn->Visible) { // CartParm_Idn ?>
		<th class="<?php echo $CartParms_delete->CartParm_Idn->headerCellClass() ?>"><span id="elh_CartParms_CartParm_Idn" class="CartParms_CartParm_Idn"><?php echo $CartParms_delete->CartParm_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($CartParms_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $CartParms_delete->Name->headerCellClass() ?>"><span id="elh_CartParms_Name" class="CartParms_Name"><?php echo $CartParms_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($CartParms_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $CartParms_delete->Department_Idn->headerCellClass() ?>"><span id="elh_CartParms_Department_Idn" class="CartParms_Department_Idn"><?php echo $CartParms_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($CartParms_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<th class="<?php echo $CartParms_delete->WorksheetMaster_Idn->headerCellClass() ?>"><span id="elh_CartParms_WorksheetMaster_Idn" class="CartParms_WorksheetMaster_Idn"><?php echo $CartParms_delete->WorksheetMaster_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($CartParms_delete->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<th class="<?php echo $CartParms_delete->WorksheetCategory_Idn->headerCellClass() ?>"><span id="elh_CartParms_WorksheetCategory_Idn" class="CartParms_WorksheetCategory_Idn"><?php echo $CartParms_delete->WorksheetCategory_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($CartParms_delete->GroupValue->Visible) { // GroupValue ?>
		<th class="<?php echo $CartParms_delete->GroupValue->headerCellClass() ?>"><span id="elh_CartParms_GroupValue" class="CartParms_GroupValue"><?php echo $CartParms_delete->GroupValue->caption() ?></span></th>
<?php } ?>
<?php if ($CartParms_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $CartParms_delete->Rank->headerCellClass() ?>"><span id="elh_CartParms_Rank" class="CartParms_Rank"><?php echo $CartParms_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($CartParms_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $CartParms_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_CartParms_ActiveFlag" class="CartParms_ActiveFlag"><?php echo $CartParms_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$CartParms_delete->RecordCount = 0;
$i = 0;
while (!$CartParms_delete->Recordset->EOF) {
	$CartParms_delete->RecordCount++;
	$CartParms_delete->RowCount++;

	// Set row properties
	$CartParms->resetAttributes();
	$CartParms->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$CartParms_delete->loadRowValues($CartParms_delete->Recordset);

	// Render row
	$CartParms_delete->renderRow();
?>
	<tr <?php echo $CartParms->rowAttributes() ?>>
<?php if ($CartParms_delete->CartParm_Idn->Visible) { // CartParm_Idn ?>
		<td <?php echo $CartParms_delete->CartParm_Idn->cellAttributes() ?>>
<span id="el<?php echo $CartParms_delete->RowCount ?>_CartParms_CartParm_Idn" class="CartParms_CartParm_Idn">
<span<?php echo $CartParms_delete->CartParm_Idn->viewAttributes() ?>><?php echo $CartParms_delete->CartParm_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CartParms_delete->Name->Visible) { // Name ?>
		<td <?php echo $CartParms_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $CartParms_delete->RowCount ?>_CartParms_Name" class="CartParms_Name">
<span<?php echo $CartParms_delete->Name->viewAttributes() ?>><?php echo $CartParms_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CartParms_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $CartParms_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $CartParms_delete->RowCount ?>_CartParms_Department_Idn" class="CartParms_Department_Idn">
<span<?php echo $CartParms_delete->Department_Idn->viewAttributes() ?>><?php echo $CartParms_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CartParms_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td <?php echo $CartParms_delete->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $CartParms_delete->RowCount ?>_CartParms_WorksheetMaster_Idn" class="CartParms_WorksheetMaster_Idn">
<span<?php echo $CartParms_delete->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $CartParms_delete->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CartParms_delete->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td <?php echo $CartParms_delete->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el<?php echo $CartParms_delete->RowCount ?>_CartParms_WorksheetCategory_Idn" class="CartParms_WorksheetCategory_Idn">
<span<?php echo $CartParms_delete->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $CartParms_delete->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CartParms_delete->GroupValue->Visible) { // GroupValue ?>
		<td <?php echo $CartParms_delete->GroupValue->cellAttributes() ?>>
<span id="el<?php echo $CartParms_delete->RowCount ?>_CartParms_GroupValue" class="CartParms_GroupValue">
<span<?php echo $CartParms_delete->GroupValue->viewAttributes() ?>><?php echo $CartParms_delete->GroupValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CartParms_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $CartParms_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $CartParms_delete->RowCount ?>_CartParms_Rank" class="CartParms_Rank">
<span<?php echo $CartParms_delete->Rank->viewAttributes() ?>><?php echo $CartParms_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CartParms_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $CartParms_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $CartParms_delete->RowCount ?>_CartParms_ActiveFlag" class="CartParms_ActiveFlag">
<span<?php echo $CartParms_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $CartParms_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($CartParms_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$CartParms_delete->Recordset->moveNext();
}
$CartParms_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $CartParms_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$CartParms_delete->showPageFooter();
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
$CartParms_delete->terminate();
?>