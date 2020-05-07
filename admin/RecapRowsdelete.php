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
$RecapRows_delete = new RecapRows_delete();

// Run the page
$RecapRows_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapRows_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapRowsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fRecapRowsdelete = currentForm = new ew.Form("fRecapRowsdelete", "delete");
	loadjs.done("fRecapRowsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapRows_delete->showPageHeader(); ?>
<?php
$RecapRows_delete->showMessage();
?>
<form name="fRecapRowsdelete" id="fRecapRowsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapRows">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($RecapRows_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($RecapRows_delete->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<th class="<?php echo $RecapRows_delete->RecapRow_Idn->headerCellClass() ?>"><span id="elh_RecapRows_RecapRow_Idn" class="RecapRows_RecapRow_Idn"><?php echo $RecapRows_delete->RecapRow_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($RecapRows_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $RecapRows_delete->Name->headerCellClass() ?>"><span id="elh_RecapRows_Name" class="RecapRows_Name"><?php echo $RecapRows_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($RecapRows_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $RecapRows_delete->Department_Idn->headerCellClass() ?>"><span id="elh_RecapRows_Department_Idn" class="RecapRows_Department_Idn"><?php echo $RecapRows_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($RecapRows_delete->CalcShopFlag->Visible) { // CalcShopFlag ?>
		<th class="<?php echo $RecapRows_delete->CalcShopFlag->headerCellClass() ?>"><span id="elh_RecapRows_CalcShopFlag" class="RecapRows_CalcShopFlag"><?php echo $RecapRows_delete->CalcShopFlag->caption() ?></span></th>
<?php } ?>
<?php if ($RecapRows_delete->IsWorksheetFlag->Visible) { // IsWorksheetFlag ?>
		<th class="<?php echo $RecapRows_delete->IsWorksheetFlag->headerCellClass() ?>"><span id="elh_RecapRows_IsWorksheetFlag" class="RecapRows_IsWorksheetFlag"><?php echo $RecapRows_delete->IsWorksheetFlag->caption() ?></span></th>
<?php } ?>
<?php if ($RecapRows_delete->DisplayFlag->Visible) { // DisplayFlag ?>
		<th class="<?php echo $RecapRows_delete->DisplayFlag->headerCellClass() ?>"><span id="elh_RecapRows_DisplayFlag" class="RecapRows_DisplayFlag"><?php echo $RecapRows_delete->DisplayFlag->caption() ?></span></th>
<?php } ?>
<?php if ($RecapRows_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $RecapRows_delete->Rank->headerCellClass() ?>"><span id="elh_RecapRows_Rank" class="RecapRows_Rank"><?php echo $RecapRows_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($RecapRows_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $RecapRows_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_RecapRows_ActiveFlag" class="RecapRows_ActiveFlag"><?php echo $RecapRows_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$RecapRows_delete->RecordCount = 0;
$i = 0;
while (!$RecapRows_delete->Recordset->EOF) {
	$RecapRows_delete->RecordCount++;
	$RecapRows_delete->RowCount++;

	// Set row properties
	$RecapRows->resetAttributes();
	$RecapRows->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$RecapRows_delete->loadRowValues($RecapRows_delete->Recordset);

	// Render row
	$RecapRows_delete->renderRow();
?>
	<tr <?php echo $RecapRows->rowAttributes() ?>>
<?php if ($RecapRows_delete->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td <?php echo $RecapRows_delete->RecapRow_Idn->cellAttributes() ?>>
<span id="el<?php echo $RecapRows_delete->RowCount ?>_RecapRows_RecapRow_Idn" class="RecapRows_RecapRow_Idn">
<span<?php echo $RecapRows_delete->RecapRow_Idn->viewAttributes() ?>><?php echo $RecapRows_delete->RecapRow_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapRows_delete->Name->Visible) { // Name ?>
		<td <?php echo $RecapRows_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $RecapRows_delete->RowCount ?>_RecapRows_Name" class="RecapRows_Name">
<span<?php echo $RecapRows_delete->Name->viewAttributes() ?>><?php echo $RecapRows_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapRows_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $RecapRows_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $RecapRows_delete->RowCount ?>_RecapRows_Department_Idn" class="RecapRows_Department_Idn">
<span<?php echo $RecapRows_delete->Department_Idn->viewAttributes() ?>><?php echo $RecapRows_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapRows_delete->CalcShopFlag->Visible) { // CalcShopFlag ?>
		<td <?php echo $RecapRows_delete->CalcShopFlag->cellAttributes() ?>>
<span id="el<?php echo $RecapRows_delete->RowCount ?>_RecapRows_CalcShopFlag" class="RecapRows_CalcShopFlag">
<span<?php echo $RecapRows_delete->CalcShopFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CalcShopFlag" class="custom-control-input" value="<?php echo $RecapRows_delete->CalcShopFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapRows_delete->CalcShopFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CalcShopFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($RecapRows_delete->IsWorksheetFlag->Visible) { // IsWorksheetFlag ?>
		<td <?php echo $RecapRows_delete->IsWorksheetFlag->cellAttributes() ?>>
<span id="el<?php echo $RecapRows_delete->RowCount ?>_RecapRows_IsWorksheetFlag" class="RecapRows_IsWorksheetFlag">
<span<?php echo $RecapRows_delete->IsWorksheetFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsWorksheetFlag" class="custom-control-input" value="<?php echo $RecapRows_delete->IsWorksheetFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapRows_delete->IsWorksheetFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsWorksheetFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($RecapRows_delete->DisplayFlag->Visible) { // DisplayFlag ?>
		<td <?php echo $RecapRows_delete->DisplayFlag->cellAttributes() ?>>
<span id="el<?php echo $RecapRows_delete->RowCount ?>_RecapRows_DisplayFlag" class="RecapRows_DisplayFlag">
<span<?php echo $RecapRows_delete->DisplayFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DisplayFlag" class="custom-control-input" value="<?php echo $RecapRows_delete->DisplayFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapRows_delete->DisplayFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DisplayFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($RecapRows_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $RecapRows_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $RecapRows_delete->RowCount ?>_RecapRows_Rank" class="RecapRows_Rank">
<span<?php echo $RecapRows_delete->Rank->viewAttributes() ?>><?php echo $RecapRows_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapRows_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $RecapRows_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $RecapRows_delete->RowCount ?>_RecapRows_ActiveFlag" class="RecapRows_ActiveFlag">
<span<?php echo $RecapRows_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $RecapRows_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapRows_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$RecapRows_delete->Recordset->moveNext();
}
$RecapRows_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapRows_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$RecapRows_delete->showPageFooter();
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
$RecapRows_delete->terminate();
?>