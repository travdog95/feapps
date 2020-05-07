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
$ScheduleTypes_delete = new ScheduleTypes_delete();

// Run the page
$ScheduleTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ScheduleTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fScheduleTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fScheduleTypesdelete = currentForm = new ew.Form("fScheduleTypesdelete", "delete");
	loadjs.done("fScheduleTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ScheduleTypes_delete->showPageHeader(); ?>
<?php
$ScheduleTypes_delete->showMessage();
?>
<form name="fScheduleTypesdelete" id="fScheduleTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ScheduleTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ScheduleTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ScheduleTypes_delete->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
		<th class="<?php echo $ScheduleTypes_delete->ScheduleType_Idn->headerCellClass() ?>"><span id="elh_ScheduleTypes_ScheduleType_Idn" class="ScheduleTypes_ScheduleType_Idn"><?php echo $ScheduleTypes_delete->ScheduleType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($ScheduleTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $ScheduleTypes_delete->Name->headerCellClass() ?>"><span id="elh_ScheduleTypes_Name" class="ScheduleTypes_Name"><?php echo $ScheduleTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($ScheduleTypes_delete->ShortName->Visible) { // ShortName ?>
		<th class="<?php echo $ScheduleTypes_delete->ShortName->headerCellClass() ?>"><span id="elh_ScheduleTypes_ShortName" class="ScheduleTypes_ShortName"><?php echo $ScheduleTypes_delete->ShortName->caption() ?></span></th>
<?php } ?>
<?php if ($ScheduleTypes_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $ScheduleTypes_delete->Department_Idn->headerCellClass() ?>"><span id="elh_ScheduleTypes_Department_Idn" class="ScheduleTypes_Department_Idn"><?php echo $ScheduleTypes_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($ScheduleTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $ScheduleTypes_delete->Rank->headerCellClass() ?>"><span id="elh_ScheduleTypes_Rank" class="ScheduleTypes_Rank"><?php echo $ScheduleTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($ScheduleTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $ScheduleTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_ScheduleTypes_ActiveFlag" class="ScheduleTypes_ActiveFlag"><?php echo $ScheduleTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ScheduleTypes_delete->RecordCount = 0;
$i = 0;
while (!$ScheduleTypes_delete->Recordset->EOF) {
	$ScheduleTypes_delete->RecordCount++;
	$ScheduleTypes_delete->RowCount++;

	// Set row properties
	$ScheduleTypes->resetAttributes();
	$ScheduleTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ScheduleTypes_delete->loadRowValues($ScheduleTypes_delete->Recordset);

	// Render row
	$ScheduleTypes_delete->renderRow();
?>
	<tr <?php echo $ScheduleTypes->rowAttributes() ?>>
<?php if ($ScheduleTypes_delete->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
		<td <?php echo $ScheduleTypes_delete->ScheduleType_Idn->cellAttributes() ?>>
<span id="el<?php echo $ScheduleTypes_delete->RowCount ?>_ScheduleTypes_ScheduleType_Idn" class="ScheduleTypes_ScheduleType_Idn">
<span<?php echo $ScheduleTypes_delete->ScheduleType_Idn->viewAttributes() ?>><?php echo $ScheduleTypes_delete->ScheduleType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ScheduleTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $ScheduleTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $ScheduleTypes_delete->RowCount ?>_ScheduleTypes_Name" class="ScheduleTypes_Name">
<span<?php echo $ScheduleTypes_delete->Name->viewAttributes() ?>><?php echo $ScheduleTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ScheduleTypes_delete->ShortName->Visible) { // ShortName ?>
		<td <?php echo $ScheduleTypes_delete->ShortName->cellAttributes() ?>>
<span id="el<?php echo $ScheduleTypes_delete->RowCount ?>_ScheduleTypes_ShortName" class="ScheduleTypes_ShortName">
<span<?php echo $ScheduleTypes_delete->ShortName->viewAttributes() ?>><?php echo $ScheduleTypes_delete->ShortName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ScheduleTypes_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $ScheduleTypes_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $ScheduleTypes_delete->RowCount ?>_ScheduleTypes_Department_Idn" class="ScheduleTypes_Department_Idn">
<span<?php echo $ScheduleTypes_delete->Department_Idn->viewAttributes() ?>><?php echo $ScheduleTypes_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ScheduleTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $ScheduleTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $ScheduleTypes_delete->RowCount ?>_ScheduleTypes_Rank" class="ScheduleTypes_Rank">
<span<?php echo $ScheduleTypes_delete->Rank->viewAttributes() ?>><?php echo $ScheduleTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ScheduleTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $ScheduleTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $ScheduleTypes_delete->RowCount ?>_ScheduleTypes_ActiveFlag" class="ScheduleTypes_ActiveFlag">
<span<?php echo $ScheduleTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ScheduleTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ScheduleTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ScheduleTypes_delete->Recordset->moveNext();
}
$ScheduleTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ScheduleTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ScheduleTypes_delete->showPageFooter();
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
$ScheduleTypes_delete->terminate();
?>