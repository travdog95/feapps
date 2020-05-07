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
$GPMs_delete = new GPMs_delete();

// Run the page
$GPMs_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GPMs_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fGPMsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fGPMsdelete = currentForm = new ew.Form("fGPMsdelete", "delete");
	loadjs.done("fGPMsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $GPMs_delete->showPageHeader(); ?>
<?php
$GPMs_delete->showMessage();
?>
<form name="fGPMsdelete" id="fGPMsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GPMs">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($GPMs_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($GPMs_delete->GPM_Idn->Visible) { // GPM_Idn ?>
		<th class="<?php echo $GPMs_delete->GPM_Idn->headerCellClass() ?>"><span id="elh_GPMs_GPM_Idn" class="GPMs_GPM_Idn"><?php echo $GPMs_delete->GPM_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($GPMs_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $GPMs_delete->Name->headerCellClass() ?>"><span id="elh_GPMs_Name" class="GPMs_Name"><?php echo $GPMs_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($GPMs_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $GPMs_delete->Rank->headerCellClass() ?>"><span id="elh_GPMs_Rank" class="GPMs_Rank"><?php echo $GPMs_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($GPMs_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $GPMs_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_GPMs_ActiveFlag" class="GPMs_ActiveFlag"><?php echo $GPMs_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$GPMs_delete->RecordCount = 0;
$i = 0;
while (!$GPMs_delete->Recordset->EOF) {
	$GPMs_delete->RecordCount++;
	$GPMs_delete->RowCount++;

	// Set row properties
	$GPMs->resetAttributes();
	$GPMs->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$GPMs_delete->loadRowValues($GPMs_delete->Recordset);

	// Render row
	$GPMs_delete->renderRow();
?>
	<tr <?php echo $GPMs->rowAttributes() ?>>
<?php if ($GPMs_delete->GPM_Idn->Visible) { // GPM_Idn ?>
		<td <?php echo $GPMs_delete->GPM_Idn->cellAttributes() ?>>
<span id="el<?php echo $GPMs_delete->RowCount ?>_GPMs_GPM_Idn" class="GPMs_GPM_Idn">
<span<?php echo $GPMs_delete->GPM_Idn->viewAttributes() ?>><?php echo $GPMs_delete->GPM_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($GPMs_delete->Name->Visible) { // Name ?>
		<td <?php echo $GPMs_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $GPMs_delete->RowCount ?>_GPMs_Name" class="GPMs_Name">
<span<?php echo $GPMs_delete->Name->viewAttributes() ?>><?php echo $GPMs_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($GPMs_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $GPMs_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $GPMs_delete->RowCount ?>_GPMs_Rank" class="GPMs_Rank">
<span<?php echo $GPMs_delete->Rank->viewAttributes() ?>><?php echo $GPMs_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($GPMs_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $GPMs_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $GPMs_delete->RowCount ?>_GPMs_ActiveFlag" class="GPMs_ActiveFlag">
<span<?php echo $GPMs_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $GPMs_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($GPMs_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$GPMs_delete->Recordset->moveNext();
}
$GPMs_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $GPMs_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$GPMs_delete->showPageFooter();
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
$GPMs_delete->terminate();
?>