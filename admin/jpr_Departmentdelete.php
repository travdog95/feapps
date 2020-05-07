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
$jpr_Department_delete = new jpr_Department_delete();

// Run the page
$jpr_Department_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jpr_Department_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjpr_Departmentdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fjpr_Departmentdelete = currentForm = new ew.Form("fjpr_Departmentdelete", "delete");
	loadjs.done("fjpr_Departmentdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jpr_Department_delete->showPageHeader(); ?>
<?php
$jpr_Department_delete->showMessage();
?>
<form name="fjpr_Departmentdelete" id="fjpr_Departmentdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jpr_Department">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($jpr_Department_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($jpr_Department_delete->DepartmentId->Visible) { // DepartmentId ?>
		<th class="<?php echo $jpr_Department_delete->DepartmentId->headerCellClass() ?>"><span id="elh_jpr_Department_DepartmentId" class="jpr_Department_DepartmentId"><?php echo $jpr_Department_delete->DepartmentId->caption() ?></span></th>
<?php } ?>
<?php if ($jpr_Department_delete->Description->Visible) { // Description ?>
		<th class="<?php echo $jpr_Department_delete->Description->headerCellClass() ?>"><span id="elh_jpr_Department_Description" class="jpr_Department_Description"><?php echo $jpr_Department_delete->Description->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$jpr_Department_delete->RecordCount = 0;
$i = 0;
while (!$jpr_Department_delete->Recordset->EOF) {
	$jpr_Department_delete->RecordCount++;
	$jpr_Department_delete->RowCount++;

	// Set row properties
	$jpr_Department->resetAttributes();
	$jpr_Department->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$jpr_Department_delete->loadRowValues($jpr_Department_delete->Recordset);

	// Render row
	$jpr_Department_delete->renderRow();
?>
	<tr <?php echo $jpr_Department->rowAttributes() ?>>
<?php if ($jpr_Department_delete->DepartmentId->Visible) { // DepartmentId ?>
		<td <?php echo $jpr_Department_delete->DepartmentId->cellAttributes() ?>>
<span id="el<?php echo $jpr_Department_delete->RowCount ?>_jpr_Department_DepartmentId" class="jpr_Department_DepartmentId">
<span<?php echo $jpr_Department_delete->DepartmentId->viewAttributes() ?>><?php echo $jpr_Department_delete->DepartmentId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jpr_Department_delete->Description->Visible) { // Description ?>
		<td <?php echo $jpr_Department_delete->Description->cellAttributes() ?>>
<span id="el<?php echo $jpr_Department_delete->RowCount ?>_jpr_Department_Description" class="jpr_Department_Description">
<span<?php echo $jpr_Department_delete->Description->viewAttributes() ?>><?php echo $jpr_Department_delete->Description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$jpr_Department_delete->Recordset->moveNext();
}
$jpr_Department_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jpr_Department_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$jpr_Department_delete->showPageFooter();
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
$jpr_Department_delete->terminate();
?>