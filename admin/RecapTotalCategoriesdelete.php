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
$RecapTotalCategories_delete = new RecapTotalCategories_delete();

// Run the page
$RecapTotalCategories_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapTotalCategories_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapTotalCategoriesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fRecapTotalCategoriesdelete = currentForm = new ew.Form("fRecapTotalCategoriesdelete", "delete");
	loadjs.done("fRecapTotalCategoriesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapTotalCategories_delete->showPageHeader(); ?>
<?php
$RecapTotalCategories_delete->showMessage();
?>
<form name="fRecapTotalCategoriesdelete" id="fRecapTotalCategoriesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapTotalCategories">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($RecapTotalCategories_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($RecapTotalCategories_delete->RecapTotalCategory_Idn->Visible) { // RecapTotalCategory_Idn ?>
		<th class="<?php echo $RecapTotalCategories_delete->RecapTotalCategory_Idn->headerCellClass() ?>"><span id="elh_RecapTotalCategories_RecapTotalCategory_Idn" class="RecapTotalCategories_RecapTotalCategory_Idn"><?php echo $RecapTotalCategories_delete->RecapTotalCategory_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($RecapTotalCategories_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $RecapTotalCategories_delete->Name->headerCellClass() ?>"><span id="elh_RecapTotalCategories_Name" class="RecapTotalCategories_Name"><?php echo $RecapTotalCategories_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($RecapTotalCategories_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $RecapTotalCategories_delete->Rank->headerCellClass() ?>"><span id="elh_RecapTotalCategories_Rank" class="RecapTotalCategories_Rank"><?php echo $RecapTotalCategories_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($RecapTotalCategories_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $RecapTotalCategories_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_RecapTotalCategories_ActiveFlag" class="RecapTotalCategories_ActiveFlag"><?php echo $RecapTotalCategories_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$RecapTotalCategories_delete->RecordCount = 0;
$i = 0;
while (!$RecapTotalCategories_delete->Recordset->EOF) {
	$RecapTotalCategories_delete->RecordCount++;
	$RecapTotalCategories_delete->RowCount++;

	// Set row properties
	$RecapTotalCategories->resetAttributes();
	$RecapTotalCategories->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$RecapTotalCategories_delete->loadRowValues($RecapTotalCategories_delete->Recordset);

	// Render row
	$RecapTotalCategories_delete->renderRow();
?>
	<tr <?php echo $RecapTotalCategories->rowAttributes() ?>>
<?php if ($RecapTotalCategories_delete->RecapTotalCategory_Idn->Visible) { // RecapTotalCategory_Idn ?>
		<td <?php echo $RecapTotalCategories_delete->RecapTotalCategory_Idn->cellAttributes() ?>>
<span id="el<?php echo $RecapTotalCategories_delete->RowCount ?>_RecapTotalCategories_RecapTotalCategory_Idn" class="RecapTotalCategories_RecapTotalCategory_Idn">
<span<?php echo $RecapTotalCategories_delete->RecapTotalCategory_Idn->viewAttributes() ?>><?php echo $RecapTotalCategories_delete->RecapTotalCategory_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapTotalCategories_delete->Name->Visible) { // Name ?>
		<td <?php echo $RecapTotalCategories_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $RecapTotalCategories_delete->RowCount ?>_RecapTotalCategories_Name" class="RecapTotalCategories_Name">
<span<?php echo $RecapTotalCategories_delete->Name->viewAttributes() ?>><?php echo $RecapTotalCategories_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapTotalCategories_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $RecapTotalCategories_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $RecapTotalCategories_delete->RowCount ?>_RecapTotalCategories_Rank" class="RecapTotalCategories_Rank">
<span<?php echo $RecapTotalCategories_delete->Rank->viewAttributes() ?>><?php echo $RecapTotalCategories_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapTotalCategories_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $RecapTotalCategories_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $RecapTotalCategories_delete->RowCount ?>_RecapTotalCategories_ActiveFlag" class="RecapTotalCategories_ActiveFlag">
<span<?php echo $RecapTotalCategories_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $RecapTotalCategories_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapTotalCategories_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$RecapTotalCategories_delete->Recordset->moveNext();
}
$RecapTotalCategories_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapTotalCategories_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$RecapTotalCategories_delete->showPageFooter();
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
$RecapTotalCategories_delete->terminate();
?>