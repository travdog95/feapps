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
$JobDefaults_delete = new JobDefaults_delete();

// Run the page
$JobDefaults_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobDefaults_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fJobDefaultsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fJobDefaultsdelete = currentForm = new ew.Form("fJobDefaultsdelete", "delete");
	loadjs.done("fJobDefaultsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $JobDefaults_delete->showPageHeader(); ?>
<?php
$JobDefaults_delete->showMessage();
?>
<form name="fJobDefaultsdelete" id="fJobDefaultsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobDefaults">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($JobDefaults_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($JobDefaults_delete->JobDefault_Idn->Visible) { // JobDefault_Idn ?>
		<th class="<?php echo $JobDefaults_delete->JobDefault_Idn->headerCellClass() ?>"><span id="elh_JobDefaults_JobDefault_Idn" class="JobDefaults_JobDefault_Idn"><?php echo $JobDefaults_delete->JobDefault_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaults_delete->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
		<th class="<?php echo $JobDefaults_delete->JobDefaultType_Idn->headerCellClass() ?>"><span id="elh_JobDefaults_JobDefaultType_Idn" class="JobDefaults_JobDefaultType_Idn"><?php echo $JobDefaults_delete->JobDefaultType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaults_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $JobDefaults_delete->Department_Idn->headerCellClass() ?>"><span id="elh_JobDefaults_Department_Idn" class="JobDefaults_Department_Idn"><?php echo $JobDefaults_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaults_delete->ParentJobDefault_Idn->Visible) { // ParentJobDefault_Idn ?>
		<th class="<?php echo $JobDefaults_delete->ParentJobDefault_Idn->headerCellClass() ?>"><span id="elh_JobDefaults_ParentJobDefault_Idn" class="JobDefaults_ParentJobDefault_Idn"><?php echo $JobDefaults_delete->ParentJobDefault_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaults_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $JobDefaults_delete->Name->headerCellClass() ?>"><span id="elh_JobDefaults_Name" class="JobDefaults_Name"><?php echo $JobDefaults_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaults_delete->NumericValue->Visible) { // NumericValue ?>
		<th class="<?php echo $JobDefaults_delete->NumericValue->headerCellClass() ?>"><span id="elh_JobDefaults_NumericValue" class="JobDefaults_NumericValue"><?php echo $JobDefaults_delete->NumericValue->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaults_delete->AlphaValue->Visible) { // AlphaValue ?>
		<th class="<?php echo $JobDefaults_delete->AlphaValue->headerCellClass() ?>"><span id="elh_JobDefaults_AlphaValue" class="JobDefaults_AlphaValue"><?php echo $JobDefaults_delete->AlphaValue->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaults_delete->LoadFromJobDefault_Idn->Visible) { // LoadFromJobDefault_Idn ?>
		<th class="<?php echo $JobDefaults_delete->LoadFromJobDefault_Idn->headerCellClass() ?>"><span id="elh_JobDefaults_LoadFromJobDefault_Idn" class="JobDefaults_LoadFromJobDefault_Idn"><?php echo $JobDefaults_delete->LoadFromJobDefault_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaults_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $JobDefaults_delete->Rank->headerCellClass() ?>"><span id="elh_JobDefaults_Rank" class="JobDefaults_Rank"><?php echo $JobDefaults_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($JobDefaults_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $JobDefaults_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_JobDefaults_ActiveFlag" class="JobDefaults_ActiveFlag"><?php echo $JobDefaults_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$JobDefaults_delete->RecordCount = 0;
$i = 0;
while (!$JobDefaults_delete->Recordset->EOF) {
	$JobDefaults_delete->RecordCount++;
	$JobDefaults_delete->RowCount++;

	// Set row properties
	$JobDefaults->resetAttributes();
	$JobDefaults->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$JobDefaults_delete->loadRowValues($JobDefaults_delete->Recordset);

	// Render row
	$JobDefaults_delete->renderRow();
?>
	<tr <?php echo $JobDefaults->rowAttributes() ?>>
<?php if ($JobDefaults_delete->JobDefault_Idn->Visible) { // JobDefault_Idn ?>
		<td <?php echo $JobDefaults_delete->JobDefault_Idn->cellAttributes() ?>>
<span id="el<?php echo $JobDefaults_delete->RowCount ?>_JobDefaults_JobDefault_Idn" class="JobDefaults_JobDefault_Idn">
<span<?php echo $JobDefaults_delete->JobDefault_Idn->viewAttributes() ?>><?php echo $JobDefaults_delete->JobDefault_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaults_delete->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
		<td <?php echo $JobDefaults_delete->JobDefaultType_Idn->cellAttributes() ?>>
<span id="el<?php echo $JobDefaults_delete->RowCount ?>_JobDefaults_JobDefaultType_Idn" class="JobDefaults_JobDefaultType_Idn">
<span<?php echo $JobDefaults_delete->JobDefaultType_Idn->viewAttributes() ?>><?php echo $JobDefaults_delete->JobDefaultType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaults_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $JobDefaults_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $JobDefaults_delete->RowCount ?>_JobDefaults_Department_Idn" class="JobDefaults_Department_Idn">
<span<?php echo $JobDefaults_delete->Department_Idn->viewAttributes() ?>><?php echo $JobDefaults_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaults_delete->ParentJobDefault_Idn->Visible) { // ParentJobDefault_Idn ?>
		<td <?php echo $JobDefaults_delete->ParentJobDefault_Idn->cellAttributes() ?>>
<span id="el<?php echo $JobDefaults_delete->RowCount ?>_JobDefaults_ParentJobDefault_Idn" class="JobDefaults_ParentJobDefault_Idn">
<span<?php echo $JobDefaults_delete->ParentJobDefault_Idn->viewAttributes() ?>><?php echo $JobDefaults_delete->ParentJobDefault_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaults_delete->Name->Visible) { // Name ?>
		<td <?php echo $JobDefaults_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $JobDefaults_delete->RowCount ?>_JobDefaults_Name" class="JobDefaults_Name">
<span<?php echo $JobDefaults_delete->Name->viewAttributes() ?>><?php echo $JobDefaults_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaults_delete->NumericValue->Visible) { // NumericValue ?>
		<td <?php echo $JobDefaults_delete->NumericValue->cellAttributes() ?>>
<span id="el<?php echo $JobDefaults_delete->RowCount ?>_JobDefaults_NumericValue" class="JobDefaults_NumericValue">
<span<?php echo $JobDefaults_delete->NumericValue->viewAttributes() ?>><?php echo $JobDefaults_delete->NumericValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaults_delete->AlphaValue->Visible) { // AlphaValue ?>
		<td <?php echo $JobDefaults_delete->AlphaValue->cellAttributes() ?>>
<span id="el<?php echo $JobDefaults_delete->RowCount ?>_JobDefaults_AlphaValue" class="JobDefaults_AlphaValue">
<span<?php echo $JobDefaults_delete->AlphaValue->viewAttributes() ?>><?php echo $JobDefaults_delete->AlphaValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaults_delete->LoadFromJobDefault_Idn->Visible) { // LoadFromJobDefault_Idn ?>
		<td <?php echo $JobDefaults_delete->LoadFromJobDefault_Idn->cellAttributes() ?>>
<span id="el<?php echo $JobDefaults_delete->RowCount ?>_JobDefaults_LoadFromJobDefault_Idn" class="JobDefaults_LoadFromJobDefault_Idn">
<span<?php echo $JobDefaults_delete->LoadFromJobDefault_Idn->viewAttributes() ?>><?php echo $JobDefaults_delete->LoadFromJobDefault_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaults_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $JobDefaults_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $JobDefaults_delete->RowCount ?>_JobDefaults_Rank" class="JobDefaults_Rank">
<span<?php echo $JobDefaults_delete->Rank->viewAttributes() ?>><?php echo $JobDefaults_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobDefaults_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $JobDefaults_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $JobDefaults_delete->RowCount ?>_JobDefaults_ActiveFlag" class="JobDefaults_ActiveFlag">
<span<?php echo $JobDefaults_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobDefaults_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobDefaults_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$JobDefaults_delete->Recordset->moveNext();
}
$JobDefaults_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobDefaults_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$JobDefaults_delete->showPageFooter();
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
$JobDefaults_delete->terminate();
?>