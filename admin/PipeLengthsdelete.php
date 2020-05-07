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
$PipeLengths_delete = new PipeLengths_delete();

// Run the page
$PipeLengths_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeLengths_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPipeLengthsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fPipeLengthsdelete = currentForm = new ew.Form("fPipeLengthsdelete", "delete");
	loadjs.done("fPipeLengthsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $PipeLengths_delete->showPageHeader(); ?>
<?php
$PipeLengths_delete->showMessage();
?>
<form name="fPipeLengthsdelete" id="fPipeLengthsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeLengths">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($PipeLengths_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($PipeLengths_delete->PipeLength_Idn->Visible) { // PipeLength_Idn ?>
		<th class="<?php echo $PipeLengths_delete->PipeLength_Idn->headerCellClass() ?>"><span id="elh_PipeLengths_PipeLength_Idn" class="PipeLengths_PipeLength_Idn"><?php echo $PipeLengths_delete->PipeLength_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($PipeLengths_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $PipeLengths_delete->Name->headerCellClass() ?>"><span id="elh_PipeLengths_Name" class="PipeLengths_Name"><?php echo $PipeLengths_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($PipeLengths_delete->Value->Visible) { // Value ?>
		<th class="<?php echo $PipeLengths_delete->Value->headerCellClass() ?>"><span id="elh_PipeLengths_Value" class="PipeLengths_Value"><?php echo $PipeLengths_delete->Value->caption() ?></span></th>
<?php } ?>
<?php if ($PipeLengths_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $PipeLengths_delete->Rank->headerCellClass() ?>"><span id="elh_PipeLengths_Rank" class="PipeLengths_Rank"><?php echo $PipeLengths_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($PipeLengths_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $PipeLengths_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_PipeLengths_ActiveFlag" class="PipeLengths_ActiveFlag"><?php echo $PipeLengths_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$PipeLengths_delete->RecordCount = 0;
$i = 0;
while (!$PipeLengths_delete->Recordset->EOF) {
	$PipeLengths_delete->RecordCount++;
	$PipeLengths_delete->RowCount++;

	// Set row properties
	$PipeLengths->resetAttributes();
	$PipeLengths->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$PipeLengths_delete->loadRowValues($PipeLengths_delete->Recordset);

	// Render row
	$PipeLengths_delete->renderRow();
?>
	<tr <?php echo $PipeLengths->rowAttributes() ?>>
<?php if ($PipeLengths_delete->PipeLength_Idn->Visible) { // PipeLength_Idn ?>
		<td <?php echo $PipeLengths_delete->PipeLength_Idn->cellAttributes() ?>>
<span id="el<?php echo $PipeLengths_delete->RowCount ?>_PipeLengths_PipeLength_Idn" class="PipeLengths_PipeLength_Idn">
<span<?php echo $PipeLengths_delete->PipeLength_Idn->viewAttributes() ?>><?php echo $PipeLengths_delete->PipeLength_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeLengths_delete->Name->Visible) { // Name ?>
		<td <?php echo $PipeLengths_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $PipeLengths_delete->RowCount ?>_PipeLengths_Name" class="PipeLengths_Name">
<span<?php echo $PipeLengths_delete->Name->viewAttributes() ?>><?php echo $PipeLengths_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeLengths_delete->Value->Visible) { // Value ?>
		<td <?php echo $PipeLengths_delete->Value->cellAttributes() ?>>
<span id="el<?php echo $PipeLengths_delete->RowCount ?>_PipeLengths_Value" class="PipeLengths_Value">
<span<?php echo $PipeLengths_delete->Value->viewAttributes() ?>><?php echo $PipeLengths_delete->Value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeLengths_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $PipeLengths_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $PipeLengths_delete->RowCount ?>_PipeLengths_Rank" class="PipeLengths_Rank">
<span<?php echo $PipeLengths_delete->Rank->viewAttributes() ?>><?php echo $PipeLengths_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PipeLengths_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $PipeLengths_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $PipeLengths_delete->RowCount ?>_PipeLengths_ActiveFlag" class="PipeLengths_ActiveFlag">
<span<?php echo $PipeLengths_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PipeLengths_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeLengths_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$PipeLengths_delete->Recordset->moveNext();
}
$PipeLengths_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $PipeLengths_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$PipeLengths_delete->showPageFooter();
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
$PipeLengths_delete->terminate();
?>