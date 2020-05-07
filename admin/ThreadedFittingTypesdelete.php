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
$ThreadedFittingTypes_delete = new ThreadedFittingTypes_delete();

// Run the page
$ThreadedFittingTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ThreadedFittingTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fThreadedFittingTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fThreadedFittingTypesdelete = currentForm = new ew.Form("fThreadedFittingTypesdelete", "delete");
	loadjs.done("fThreadedFittingTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ThreadedFittingTypes_delete->showPageHeader(); ?>
<?php
$ThreadedFittingTypes_delete->showMessage();
?>
<form name="fThreadedFittingTypesdelete" id="fThreadedFittingTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ThreadedFittingTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ThreadedFittingTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ThreadedFittingTypes_delete->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
		<th class="<?php echo $ThreadedFittingTypes_delete->ThreadedFittingType_Idn->headerCellClass() ?>"><span id="elh_ThreadedFittingTypes_ThreadedFittingType_Idn" class="ThreadedFittingTypes_ThreadedFittingType_Idn"><?php echo $ThreadedFittingTypes_delete->ThreadedFittingType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($ThreadedFittingTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $ThreadedFittingTypes_delete->Name->headerCellClass() ?>"><span id="elh_ThreadedFittingTypes_Name" class="ThreadedFittingTypes_Name"><?php echo $ThreadedFittingTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($ThreadedFittingTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $ThreadedFittingTypes_delete->Rank->headerCellClass() ?>"><span id="elh_ThreadedFittingTypes_Rank" class="ThreadedFittingTypes_Rank"><?php echo $ThreadedFittingTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($ThreadedFittingTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $ThreadedFittingTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_ThreadedFittingTypes_ActiveFlag" class="ThreadedFittingTypes_ActiveFlag"><?php echo $ThreadedFittingTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ThreadedFittingTypes_delete->RecordCount = 0;
$i = 0;
while (!$ThreadedFittingTypes_delete->Recordset->EOF) {
	$ThreadedFittingTypes_delete->RecordCount++;
	$ThreadedFittingTypes_delete->RowCount++;

	// Set row properties
	$ThreadedFittingTypes->resetAttributes();
	$ThreadedFittingTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ThreadedFittingTypes_delete->loadRowValues($ThreadedFittingTypes_delete->Recordset);

	// Render row
	$ThreadedFittingTypes_delete->renderRow();
?>
	<tr <?php echo $ThreadedFittingTypes->rowAttributes() ?>>
<?php if ($ThreadedFittingTypes_delete->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
		<td <?php echo $ThreadedFittingTypes_delete->ThreadedFittingType_Idn->cellAttributes() ?>>
<span id="el<?php echo $ThreadedFittingTypes_delete->RowCount ?>_ThreadedFittingTypes_ThreadedFittingType_Idn" class="ThreadedFittingTypes_ThreadedFittingType_Idn">
<span<?php echo $ThreadedFittingTypes_delete->ThreadedFittingType_Idn->viewAttributes() ?>><?php echo $ThreadedFittingTypes_delete->ThreadedFittingType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ThreadedFittingTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $ThreadedFittingTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $ThreadedFittingTypes_delete->RowCount ?>_ThreadedFittingTypes_Name" class="ThreadedFittingTypes_Name">
<span<?php echo $ThreadedFittingTypes_delete->Name->viewAttributes() ?>><?php echo $ThreadedFittingTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ThreadedFittingTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $ThreadedFittingTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $ThreadedFittingTypes_delete->RowCount ?>_ThreadedFittingTypes_Rank" class="ThreadedFittingTypes_Rank">
<span<?php echo $ThreadedFittingTypes_delete->Rank->viewAttributes() ?>><?php echo $ThreadedFittingTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ThreadedFittingTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $ThreadedFittingTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $ThreadedFittingTypes_delete->RowCount ?>_ThreadedFittingTypes_ActiveFlag" class="ThreadedFittingTypes_ActiveFlag">
<span<?php echo $ThreadedFittingTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ThreadedFittingTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ThreadedFittingTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ThreadedFittingTypes_delete->Recordset->moveNext();
}
$ThreadedFittingTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ThreadedFittingTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ThreadedFittingTypes_delete->showPageFooter();
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
$ThreadedFittingTypes_delete->terminate();
?>