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
$GradeTypes_delete = new GradeTypes_delete();

// Run the page
$GradeTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GradeTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fGradeTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fGradeTypesdelete = currentForm = new ew.Form("fGradeTypesdelete", "delete");
	loadjs.done("fGradeTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $GradeTypes_delete->showPageHeader(); ?>
<?php
$GradeTypes_delete->showMessage();
?>
<form name="fGradeTypesdelete" id="fGradeTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GradeTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($GradeTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($GradeTypes_delete->GradeType_Idn->Visible) { // GradeType_Idn ?>
		<th class="<?php echo $GradeTypes_delete->GradeType_Idn->headerCellClass() ?>"><span id="elh_GradeTypes_GradeType_Idn" class="GradeTypes_GradeType_Idn"><?php echo $GradeTypes_delete->GradeType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($GradeTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $GradeTypes_delete->Name->headerCellClass() ?>"><span id="elh_GradeTypes_Name" class="GradeTypes_Name"><?php echo $GradeTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($GradeTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $GradeTypes_delete->Rank->headerCellClass() ?>"><span id="elh_GradeTypes_Rank" class="GradeTypes_Rank"><?php echo $GradeTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($GradeTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $GradeTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_GradeTypes_ActiveFlag" class="GradeTypes_ActiveFlag"><?php echo $GradeTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$GradeTypes_delete->RecordCount = 0;
$i = 0;
while (!$GradeTypes_delete->Recordset->EOF) {
	$GradeTypes_delete->RecordCount++;
	$GradeTypes_delete->RowCount++;

	// Set row properties
	$GradeTypes->resetAttributes();
	$GradeTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$GradeTypes_delete->loadRowValues($GradeTypes_delete->Recordset);

	// Render row
	$GradeTypes_delete->renderRow();
?>
	<tr <?php echo $GradeTypes->rowAttributes() ?>>
<?php if ($GradeTypes_delete->GradeType_Idn->Visible) { // GradeType_Idn ?>
		<td <?php echo $GradeTypes_delete->GradeType_Idn->cellAttributes() ?>>
<span id="el<?php echo $GradeTypes_delete->RowCount ?>_GradeTypes_GradeType_Idn" class="GradeTypes_GradeType_Idn">
<span<?php echo $GradeTypes_delete->GradeType_Idn->viewAttributes() ?>><?php echo $GradeTypes_delete->GradeType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($GradeTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $GradeTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $GradeTypes_delete->RowCount ?>_GradeTypes_Name" class="GradeTypes_Name">
<span<?php echo $GradeTypes_delete->Name->viewAttributes() ?>><?php echo $GradeTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($GradeTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $GradeTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $GradeTypes_delete->RowCount ?>_GradeTypes_Rank" class="GradeTypes_Rank">
<span<?php echo $GradeTypes_delete->Rank->viewAttributes() ?>><?php echo $GradeTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($GradeTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $GradeTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $GradeTypes_delete->RowCount ?>_GradeTypes_ActiveFlag" class="GradeTypes_ActiveFlag">
<span<?php echo $GradeTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $GradeTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($GradeTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$GradeTypes_delete->Recordset->moveNext();
}
$GradeTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $GradeTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$GradeTypes_delete->showPageFooter();
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
$GradeTypes_delete->terminate();
?>