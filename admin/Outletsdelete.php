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
$Outlets_delete = new Outlets_delete();

// Run the page
$Outlets_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Outlets_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fOutletsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fOutletsdelete = currentForm = new ew.Form("fOutletsdelete", "delete");
	loadjs.done("fOutletsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Outlets_delete->showPageHeader(); ?>
<?php
$Outlets_delete->showMessage();
?>
<form name="fOutletsdelete" id="fOutletsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Outlets">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Outlets_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Outlets_delete->Outlet_Idn->Visible) { // Outlet_Idn ?>
		<th class="<?php echo $Outlets_delete->Outlet_Idn->headerCellClass() ?>"><span id="elh_Outlets_Outlet_Idn" class="Outlets_Outlet_Idn"><?php echo $Outlets_delete->Outlet_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Outlets_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $Outlets_delete->Name->headerCellClass() ?>"><span id="elh_Outlets_Name" class="Outlets_Name"><?php echo $Outlets_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($Outlets_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $Outlets_delete->Rank->headerCellClass() ?>"><span id="elh_Outlets_Rank" class="Outlets_Rank"><?php echo $Outlets_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($Outlets_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $Outlets_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_Outlets_ActiveFlag" class="Outlets_ActiveFlag"><?php echo $Outlets_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Outlets_delete->RecordCount = 0;
$i = 0;
while (!$Outlets_delete->Recordset->EOF) {
	$Outlets_delete->RecordCount++;
	$Outlets_delete->RowCount++;

	// Set row properties
	$Outlets->resetAttributes();
	$Outlets->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Outlets_delete->loadRowValues($Outlets_delete->Recordset);

	// Render row
	$Outlets_delete->renderRow();
?>
	<tr <?php echo $Outlets->rowAttributes() ?>>
<?php if ($Outlets_delete->Outlet_Idn->Visible) { // Outlet_Idn ?>
		<td <?php echo $Outlets_delete->Outlet_Idn->cellAttributes() ?>>
<span id="el<?php echo $Outlets_delete->RowCount ?>_Outlets_Outlet_Idn" class="Outlets_Outlet_Idn">
<span<?php echo $Outlets_delete->Outlet_Idn->viewAttributes() ?>><?php echo $Outlets_delete->Outlet_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Outlets_delete->Name->Visible) { // Name ?>
		<td <?php echo $Outlets_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $Outlets_delete->RowCount ?>_Outlets_Name" class="Outlets_Name">
<span<?php echo $Outlets_delete->Name->viewAttributes() ?>><?php echo $Outlets_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Outlets_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $Outlets_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $Outlets_delete->RowCount ?>_Outlets_Rank" class="Outlets_Rank">
<span<?php echo $Outlets_delete->Rank->viewAttributes() ?>><?php echo $Outlets_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Outlets_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $Outlets_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $Outlets_delete->RowCount ?>_Outlets_ActiveFlag" class="Outlets_ActiveFlag">
<span<?php echo $Outlets_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Outlets_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Outlets_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Outlets_delete->Recordset->moveNext();
}
$Outlets_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Outlets_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Outlets_delete->showPageFooter();
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
$Outlets_delete->terminate();
?>