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
$FinishTypes_delete = new FinishTypes_delete();

// Run the page
$FinishTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FinishTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fFinishTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fFinishTypesdelete = currentForm = new ew.Form("fFinishTypesdelete", "delete");
	loadjs.done("fFinishTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $FinishTypes_delete->showPageHeader(); ?>
<?php
$FinishTypes_delete->showMessage();
?>
<form name="fFinishTypesdelete" id="fFinishTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FinishTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($FinishTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($FinishTypes_delete->FinishType_Idn->Visible) { // FinishType_Idn ?>
		<th class="<?php echo $FinishTypes_delete->FinishType_Idn->headerCellClass() ?>"><span id="elh_FinishTypes_FinishType_Idn" class="FinishTypes_FinishType_Idn"><?php echo $FinishTypes_delete->FinishType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($FinishTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $FinishTypes_delete->Name->headerCellClass() ?>"><span id="elh_FinishTypes_Name" class="FinishTypes_Name"><?php echo $FinishTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($FinishTypes_delete->ShortName->Visible) { // ShortName ?>
		<th class="<?php echo $FinishTypes_delete->ShortName->headerCellClass() ?>"><span id="elh_FinishTypes_ShortName" class="FinishTypes_ShortName"><?php echo $FinishTypes_delete->ShortName->caption() ?></span></th>
<?php } ?>
<?php if ($FinishTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $FinishTypes_delete->Rank->headerCellClass() ?>"><span id="elh_FinishTypes_Rank" class="FinishTypes_Rank"><?php echo $FinishTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($FinishTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $FinishTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_FinishTypes_ActiveFlag" class="FinishTypes_ActiveFlag"><?php echo $FinishTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$FinishTypes_delete->RecordCount = 0;
$i = 0;
while (!$FinishTypes_delete->Recordset->EOF) {
	$FinishTypes_delete->RecordCount++;
	$FinishTypes_delete->RowCount++;

	// Set row properties
	$FinishTypes->resetAttributes();
	$FinishTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$FinishTypes_delete->loadRowValues($FinishTypes_delete->Recordset);

	// Render row
	$FinishTypes_delete->renderRow();
?>
	<tr <?php echo $FinishTypes->rowAttributes() ?>>
<?php if ($FinishTypes_delete->FinishType_Idn->Visible) { // FinishType_Idn ?>
		<td <?php echo $FinishTypes_delete->FinishType_Idn->cellAttributes() ?>>
<span id="el<?php echo $FinishTypes_delete->RowCount ?>_FinishTypes_FinishType_Idn" class="FinishTypes_FinishType_Idn">
<span<?php echo $FinishTypes_delete->FinishType_Idn->viewAttributes() ?>><?php echo $FinishTypes_delete->FinishType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FinishTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $FinishTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $FinishTypes_delete->RowCount ?>_FinishTypes_Name" class="FinishTypes_Name">
<span<?php echo $FinishTypes_delete->Name->viewAttributes() ?>><?php echo $FinishTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FinishTypes_delete->ShortName->Visible) { // ShortName ?>
		<td <?php echo $FinishTypes_delete->ShortName->cellAttributes() ?>>
<span id="el<?php echo $FinishTypes_delete->RowCount ?>_FinishTypes_ShortName" class="FinishTypes_ShortName">
<span<?php echo $FinishTypes_delete->ShortName->viewAttributes() ?>><?php echo $FinishTypes_delete->ShortName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FinishTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $FinishTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $FinishTypes_delete->RowCount ?>_FinishTypes_Rank" class="FinishTypes_Rank">
<span<?php echo $FinishTypes_delete->Rank->viewAttributes() ?>><?php echo $FinishTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($FinishTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $FinishTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $FinishTypes_delete->RowCount ?>_FinishTypes_ActiveFlag" class="FinishTypes_ActiveFlag">
<span<?php echo $FinishTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FinishTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FinishTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$FinishTypes_delete->Recordset->moveNext();
}
$FinishTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $FinishTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$FinishTypes_delete->showPageFooter();
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
$FinishTypes_delete->terminate();
?>