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
$JobStatuses_delete = new JobStatuses_delete();

// Run the page
$JobStatuses_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobStatuses_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fJobStatusesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fJobStatusesdelete = currentForm = new ew.Form("fJobStatusesdelete", "delete");
	loadjs.done("fJobStatusesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $JobStatuses_delete->showPageHeader(); ?>
<?php
$JobStatuses_delete->showMessage();
?>
<form name="fJobStatusesdelete" id="fJobStatusesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobStatuses">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($JobStatuses_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($JobStatuses_delete->JobStatus_Idn->Visible) { // JobStatus_Idn ?>
		<th class="<?php echo $JobStatuses_delete->JobStatus_Idn->headerCellClass() ?>"><span id="elh_JobStatuses_JobStatus_Idn" class="JobStatuses_JobStatus_Idn"><?php echo $JobStatuses_delete->JobStatus_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($JobStatuses_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $JobStatuses_delete->Name->headerCellClass() ?>"><span id="elh_JobStatuses_Name" class="JobStatuses_Name"><?php echo $JobStatuses_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($JobStatuses_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $JobStatuses_delete->Rank->headerCellClass() ?>"><span id="elh_JobStatuses_Rank" class="JobStatuses_Rank"><?php echo $JobStatuses_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($JobStatuses_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $JobStatuses_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_JobStatuses_ActiveFlag" class="JobStatuses_ActiveFlag"><?php echo $JobStatuses_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$JobStatuses_delete->RecordCount = 0;
$i = 0;
while (!$JobStatuses_delete->Recordset->EOF) {
	$JobStatuses_delete->RecordCount++;
	$JobStatuses_delete->RowCount++;

	// Set row properties
	$JobStatuses->resetAttributes();
	$JobStatuses->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$JobStatuses_delete->loadRowValues($JobStatuses_delete->Recordset);

	// Render row
	$JobStatuses_delete->renderRow();
?>
	<tr <?php echo $JobStatuses->rowAttributes() ?>>
<?php if ($JobStatuses_delete->JobStatus_Idn->Visible) { // JobStatus_Idn ?>
		<td <?php echo $JobStatuses_delete->JobStatus_Idn->cellAttributes() ?>>
<span id="el<?php echo $JobStatuses_delete->RowCount ?>_JobStatuses_JobStatus_Idn" class="JobStatuses_JobStatus_Idn">
<span<?php echo $JobStatuses_delete->JobStatus_Idn->viewAttributes() ?>><?php echo $JobStatuses_delete->JobStatus_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobStatuses_delete->Name->Visible) { // Name ?>
		<td <?php echo $JobStatuses_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $JobStatuses_delete->RowCount ?>_JobStatuses_Name" class="JobStatuses_Name">
<span<?php echo $JobStatuses_delete->Name->viewAttributes() ?>><?php echo $JobStatuses_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobStatuses_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $JobStatuses_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $JobStatuses_delete->RowCount ?>_JobStatuses_Rank" class="JobStatuses_Rank">
<span<?php echo $JobStatuses_delete->Rank->viewAttributes() ?>><?php echo $JobStatuses_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobStatuses_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $JobStatuses_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $JobStatuses_delete->RowCount ?>_JobStatuses_ActiveFlag" class="JobStatuses_ActiveFlag">
<span<?php echo $JobStatuses_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobStatuses_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobStatuses_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$JobStatuses_delete->Recordset->moveNext();
}
$JobStatuses_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobStatuses_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$JobStatuses_delete->showPageFooter();
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
$JobStatuses_delete->terminate();
?>