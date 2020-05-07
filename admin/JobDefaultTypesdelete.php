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
$JobDefaultTypes_delete = new JobDefaultTypes_delete();

// Run the page
$JobDefaultTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobDefaultTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fJobDefaultTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fJobDefaultTypesdelete = currentForm = new ew.Form("fJobDefaultTypesdelete", "delete");
	loadjs.done("fJobDefaultTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $JobDefaultTypes_delete->showPageHeader(); ?>
<?php
$JobDefaultTypes_delete->showMessage();
?>
<form name="fJobDefaultTypesdelete" id="fJobDefaultTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobDefaultTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($JobDefaultTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($JobDefaultTypes_delete->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
		<th class="<?php echo $JobDefaultTypes_delete->JobDefaultType_Idn->headerCellClass() ?>"><span id="elh_JobDefaultTypes_JobDefaultType_Idn" class="JobDefaultTypes_JobDefaultType_Idn"><?php echo $JobDefaultTypes_delete->JobDefaultType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaultTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $JobDefaultTypes_delete->Name->headerCellClass() ?>"><span id="elh_JobDefaultTypes_Name" class="JobDefaultTypes_Name"><?php echo $JobDefaultTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaultTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $JobDefaultTypes_delete->Rank->headerCellClass() ?>"><span id="elh_JobDefaultTypes_Rank" class="JobDefaultTypes_Rank"><?php echo $JobDefaultTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaultTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $JobDefaultTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_JobDefaultTypes_ActiveFlag" class="JobDefaultTypes_ActiveFlag"><?php echo $JobDefaultTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$JobDefaultTypes_delete->RecordCount = 0;
$i = 0;
while (!$JobDefaultTypes_delete->Recordset->EOF) {
	$JobDefaultTypes_delete->RecordCount++;
	$JobDefaultTypes_delete->RowCount++;

	// Set row properties
	$JobDefaultTypes->resetAttributes();
	$JobDefaultTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$JobDefaultTypes_delete->loadRowValues($JobDefaultTypes_delete->Recordset);

	// Render row
	$JobDefaultTypes_delete->renderRow();
?>
	<tr <?php echo $JobDefaultTypes->rowAttributes() ?>>
<?php if ($JobDefaultTypes_delete->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
		<td <?php echo $JobDefaultTypes_delete->JobDefaultType_Idn->cellAttributes() ?>>
<span id="el<?php echo $JobDefaultTypes_delete->RowCount ?>_JobDefaultTypes_JobDefaultType_Idn" class="JobDefaultTypes_JobDefaultType_Idn">
<span<?php echo $JobDefaultTypes_delete->JobDefaultType_Idn->viewAttributes() ?>><?php echo $JobDefaultTypes_delete->JobDefaultType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaultTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $JobDefaultTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $JobDefaultTypes_delete->RowCount ?>_JobDefaultTypes_Name" class="JobDefaultTypes_Name">
<span<?php echo $JobDefaultTypes_delete->Name->viewAttributes() ?>><?php echo $JobDefaultTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaultTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $JobDefaultTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $JobDefaultTypes_delete->RowCount ?>_JobDefaultTypes_Rank" class="JobDefaultTypes_Rank">
<span<?php echo $JobDefaultTypes_delete->Rank->viewAttributes() ?>><?php echo $JobDefaultTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaultTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $JobDefaultTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $JobDefaultTypes_delete->RowCount ?>_JobDefaultTypes_ActiveFlag" class="JobDefaultTypes_ActiveFlag">
<span<?php echo $JobDefaultTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobDefaultTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobDefaultTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$JobDefaultTypes_delete->Recordset->moveNext();
}
$JobDefaultTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobDefaultTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$JobDefaultTypes_delete->showPageFooter();
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
$JobDefaultTypes_delete->terminate();
?>