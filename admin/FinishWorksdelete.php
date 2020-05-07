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
$FinishWorks_delete = new FinishWorks_delete();

// Run the page
$FinishWorks_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FinishWorks_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fFinishWorksdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fFinishWorksdelete = currentForm = new ew.Form("fFinishWorksdelete", "delete");
	loadjs.done("fFinishWorksdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $FinishWorks_delete->showPageHeader(); ?>
<?php
$FinishWorks_delete->showMessage();
?>
<form name="fFinishWorksdelete" id="fFinishWorksdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FinishWorks">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($FinishWorks_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($FinishWorks_delete->FinishWork_Idn->Visible) { // FinishWork_Idn ?>
		<th class="<?php echo $FinishWorks_delete->FinishWork_Idn->headerCellClass() ?>"><span id="elh_FinishWorks_FinishWork_Idn" class="FinishWorks_FinishWork_Idn"><?php echo $FinishWorks_delete->FinishWork_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($FinishWorks_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $FinishWorks_delete->Name->headerCellClass() ?>"><span id="elh_FinishWorks_Name" class="FinishWorks_Name"><?php echo $FinishWorks_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($FinishWorks_delete->Value->Visible) { // Value ?>
		<th class="<?php echo $FinishWorks_delete->Value->headerCellClass() ?>"><span id="elh_FinishWorks_Value" class="FinishWorks_Value"><?php echo $FinishWorks_delete->Value->caption() ?></span></th>
<?php } ?>
<?php if ($FinishWorks_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $FinishWorks_delete->Rank->headerCellClass() ?>"><span id="elh_FinishWorks_Rank" class="FinishWorks_Rank"><?php echo $FinishWorks_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($FinishWorks_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $FinishWorks_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_FinishWorks_ActiveFlag" class="FinishWorks_ActiveFlag"><?php echo $FinishWorks_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$FinishWorks_delete->RecordCount = 0;
$i = 0;
while (!$FinishWorks_delete->Recordset->EOF) {
	$FinishWorks_delete->RecordCount++;
	$FinishWorks_delete->RowCount++;

	// Set row properties
	$FinishWorks->resetAttributes();
	$FinishWorks->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$FinishWorks_delete->loadRowValues($FinishWorks_delete->Recordset);

	// Render row
	$FinishWorks_delete->renderRow();
?>
	<tr <?php echo $FinishWorks->rowAttributes() ?>>
<?php if ($FinishWorks_delete->FinishWork_Idn->Visible) { // FinishWork_Idn ?>
		<td <?php echo $FinishWorks_delete->FinishWork_Idn->cellAttributes() ?>>
<span id="el<?php echo $FinishWorks_delete->RowCount ?>_FinishWorks_FinishWork_Idn" class="FinishWorks_FinishWork_Idn">
<span<?php echo $FinishWorks_delete->FinishWork_Idn->viewAttributes() ?>><?php echo $FinishWorks_delete->FinishWork_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FinishWorks_delete->Name->Visible) { // Name ?>
		<td <?php echo $FinishWorks_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $FinishWorks_delete->RowCount ?>_FinishWorks_Name" class="FinishWorks_Name">
<span<?php echo $FinishWorks_delete->Name->viewAttributes() ?>><?php echo $FinishWorks_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FinishWorks_delete->Value->Visible) { // Value ?>
		<td <?php echo $FinishWorks_delete->Value->cellAttributes() ?>>
<span id="el<?php echo $FinishWorks_delete->RowCount ?>_FinishWorks_Value" class="FinishWorks_Value">
<span<?php echo $FinishWorks_delete->Value->viewAttributes() ?>><?php echo $FinishWorks_delete->Value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FinishWorks_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $FinishWorks_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $FinishWorks_delete->RowCount ?>_FinishWorks_Rank" class="FinishWorks_Rank">
<span<?php echo $FinishWorks_delete->Rank->viewAttributes() ?>><?php echo $FinishWorks_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FinishWorks_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $FinishWorks_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $FinishWorks_delete->RowCount ?>_FinishWorks_ActiveFlag" class="FinishWorks_ActiveFlag">
<span<?php echo $FinishWorks_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FinishWorks_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FinishWorks_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$FinishWorks_delete->Recordset->moveNext();
}
$FinishWorks_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $FinishWorks_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$FinishWorks_delete->showPageFooter();
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
$FinishWorks_delete->terminate();
?>