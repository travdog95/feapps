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
$RecapSubtotalCategories_delete = new RecapSubtotalCategories_delete();

// Run the page
$RecapSubtotalCategories_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapSubtotalCategories_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapSubtotalCategoriesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fRecapSubtotalCategoriesdelete = currentForm = new ew.Form("fRecapSubtotalCategoriesdelete", "delete");
	loadjs.done("fRecapSubtotalCategoriesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapSubtotalCategories_delete->showPageHeader(); ?>
<?php
$RecapSubtotalCategories_delete->showMessage();
?>
<form name="fRecapSubtotalCategoriesdelete" id="fRecapSubtotalCategoriesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapSubtotalCategories">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($RecapSubtotalCategories_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($RecapSubtotalCategories_delete->RecapSubtotalCategory_Idn->Visible) { // RecapSubtotalCategory_Idn ?>
		<th class="<?php echo $RecapSubtotalCategories_delete->RecapSubtotalCategory_Idn->headerCellClass() ?>"><span id="elh_RecapSubtotalCategories_RecapSubtotalCategory_Idn" class="RecapSubtotalCategories_RecapSubtotalCategory_Idn"><?php echo $RecapSubtotalCategories_delete->RecapSubtotalCategory_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($RecapSubtotalCategories_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $RecapSubtotalCategories_delete->Name->headerCellClass() ?>"><span id="elh_RecapSubtotalCategories_Name" class="RecapSubtotalCategories_Name"><?php echo $RecapSubtotalCategories_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($RecapSubtotalCategories_delete->Percentage->Visible) { // Percentage ?>
		<th class="<?php echo $RecapSubtotalCategories_delete->Percentage->headerCellClass() ?>"><span id="elh_RecapSubtotalCategories_Percentage" class="RecapSubtotalCategories_Percentage"><?php echo $RecapSubtotalCategories_delete->Percentage->caption() ?></span></th>
<?php } ?>
<?php if ($RecapSubtotalCategories_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $RecapSubtotalCategories_delete->Rank->headerCellClass() ?>"><span id="elh_RecapSubtotalCategories_Rank" class="RecapSubtotalCategories_Rank"><?php echo $RecapSubtotalCategories_delete->Rank->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$RecapSubtotalCategories_delete->RecordCount = 0;
$i = 0;
while (!$RecapSubtotalCategories_delete->Recordset->EOF) {
	$RecapSubtotalCategories_delete->RecordCount++;
	$RecapSubtotalCategories_delete->RowCount++;

	// Set row properties
	$RecapSubtotalCategories->resetAttributes();
	$RecapSubtotalCategories->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$RecapSubtotalCategories_delete->loadRowValues($RecapSubtotalCategories_delete->Recordset);

	// Render row
	$RecapSubtotalCategories_delete->renderRow();
?>
	<tr <?php echo $RecapSubtotalCategories->rowAttributes() ?>>
<?php if ($RecapSubtotalCategories_delete->RecapSubtotalCategory_Idn->Visible) { // RecapSubtotalCategory_Idn ?>
		<td <?php echo $RecapSubtotalCategories_delete->RecapSubtotalCategory_Idn->cellAttributes() ?>>
<span id="el<?php echo $RecapSubtotalCategories_delete->RowCount ?>_RecapSubtotalCategories_RecapSubtotalCategory_Idn" class="RecapSubtotalCategories_RecapSubtotalCategory_Idn">
<span<?php echo $RecapSubtotalCategories_delete->RecapSubtotalCategory_Idn->viewAttributes() ?>><?php echo $RecapSubtotalCategories_delete->RecapSubtotalCategory_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapSubtotalCategories_delete->Name->Visible) { // Name ?>
		<td <?php echo $RecapSubtotalCategories_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $RecapSubtotalCategories_delete->RowCount ?>_RecapSubtotalCategories_Name" class="RecapSubtotalCategories_Name">
<span<?php echo $RecapSubtotalCategories_delete->Name->viewAttributes() ?>><?php echo $RecapSubtotalCategories_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapSubtotalCategories_delete->Percentage->Visible) { // Percentage ?>
		<td <?php echo $RecapSubtotalCategories_delete->Percentage->cellAttributes() ?>>
<span id="el<?php echo $RecapSubtotalCategories_delete->RowCount ?>_RecapSubtotalCategories_Percentage" class="RecapSubtotalCategories_Percentage">
<span<?php echo $RecapSubtotalCategories_delete->Percentage->viewAttributes() ?>><?php echo $RecapSubtotalCategories_delete->Percentage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($RecapSubtotalCategories_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $RecapSubtotalCategories_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $RecapSubtotalCategories_delete->RowCount ?>_RecapSubtotalCategories_Rank" class="RecapSubtotalCategories_Rank">
<span<?php echo $RecapSubtotalCategories_delete->Rank->viewAttributes() ?>><?php echo $RecapSubtotalCategories_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$RecapSubtotalCategories_delete->Recordset->moveNext();
}
$RecapSubtotalCategories_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapSubtotalCategories_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$RecapSubtotalCategories_delete->showPageFooter();
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
$RecapSubtotalCategories_delete->terminate();
?>