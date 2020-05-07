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
$JobTypes_delete = new JobTypes_delete();

// Run the page
$JobTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fJobTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fJobTypesdelete = currentForm = new ew.Form("fJobTypesdelete", "delete");
	loadjs.done("fJobTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $JobTypes_delete->showPageHeader(); ?>
<?php
$JobTypes_delete->showMessage();
?>
<form name="fJobTypesdelete" id="fJobTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($JobTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($JobTypes_delete->JobType_Idn->Visible) { // JobType_Idn ?>
		<th class="<?php echo $JobTypes_delete->JobType_Idn->headerCellClass() ?>"><span id="elh_JobTypes_JobType_Idn" class="JobTypes_JobType_Idn"><?php echo $JobTypes_delete->JobType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($JobTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $JobTypes_delete->Name->headerCellClass() ?>"><span id="elh_JobTypes_Name" class="JobTypes_Name"><?php echo $JobTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($JobTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $JobTypes_delete->Rank->headerCellClass() ?>"><span id="elh_JobTypes_Rank" class="JobTypes_Rank"><?php echo $JobTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($JobTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $JobTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_JobTypes_ActiveFlag" class="JobTypes_ActiveFlag"><?php echo $JobTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$JobTypes_delete->RecordCount = 0;
$i = 0;
while (!$JobTypes_delete->Recordset->EOF) {
	$JobTypes_delete->RecordCount++;
	$JobTypes_delete->RowCount++;

	// Set row properties
	$JobTypes->resetAttributes();
	$JobTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$JobTypes_delete->loadRowValues($JobTypes_delete->Recordset);

	// Render row
	$JobTypes_delete->renderRow();
?>
	<tr <?php echo $JobTypes->rowAttributes() ?>>
<?php if ($JobTypes_delete->JobType_Idn->Visible) { // JobType_Idn ?>
		<td <?php echo $JobTypes_delete->JobType_Idn->cellAttributes() ?>>
<span id="el<?php echo $JobTypes_delete->RowCount ?>_JobTypes_JobType_Idn" class="JobTypes_JobType_Idn">
<span<?php echo $JobTypes_delete->JobType_Idn->viewAttributes() ?>><?php echo $JobTypes_delete->JobType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $JobTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $JobTypes_delete->RowCount ?>_JobTypes_Name" class="JobTypes_Name">
<span<?php echo $JobTypes_delete->Name->viewAttributes() ?>><?php echo $JobTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $JobTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $JobTypes_delete->RowCount ?>_JobTypes_Rank" class="JobTypes_Rank">
<span<?php echo $JobTypes_delete->Rank->viewAttributes() ?>><?php echo $JobTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $JobTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $JobTypes_delete->RowCount ?>_JobTypes_ActiveFlag" class="JobTypes_ActiveFlag">
<span<?php echo $JobTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$JobTypes_delete->Recordset->moveNext();
}
$JobTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$JobTypes_delete->showPageFooter();
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
$JobTypes_delete->terminate();
?>