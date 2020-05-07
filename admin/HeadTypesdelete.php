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
$HeadTypes_delete = new HeadTypes_delete();

// Run the page
$HeadTypes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HeadTypes_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fHeadTypesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fHeadTypesdelete = currentForm = new ew.Form("fHeadTypesdelete", "delete");
	loadjs.done("fHeadTypesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $HeadTypes_delete->showPageHeader(); ?>
<?php
$HeadTypes_delete->showMessage();
?>
<form name="fHeadTypesdelete" id="fHeadTypesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="HeadTypes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($HeadTypes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($HeadTypes_delete->HeadType_Idn->Visible) { // HeadType_Idn ?>
		<th class="<?php echo $HeadTypes_delete->HeadType_Idn->headerCellClass() ?>"><span id="elh_HeadTypes_HeadType_Idn" class="HeadTypes_HeadType_Idn"><?php echo $HeadTypes_delete->HeadType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($HeadTypes_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $HeadTypes_delete->Name->headerCellClass() ?>"><span id="elh_HeadTypes_Name" class="HeadTypes_Name"><?php echo $HeadTypes_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($HeadTypes_delete->ShortName->Visible) { // ShortName ?>
		<th class="<?php echo $HeadTypes_delete->ShortName->headerCellClass() ?>"><span id="elh_HeadTypes_ShortName" class="HeadTypes_ShortName"><?php echo $HeadTypes_delete->ShortName->caption() ?></span></th>
<?php } ?>
<?php if ($HeadTypes_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $HeadTypes_delete->Rank->headerCellClass() ?>"><span id="elh_HeadTypes_Rank" class="HeadTypes_Rank"><?php echo $HeadTypes_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($HeadTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $HeadTypes_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_HeadTypes_ActiveFlag" class="HeadTypes_ActiveFlag"><?php echo $HeadTypes_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$HeadTypes_delete->RecordCount = 0;
$i = 0;
while (!$HeadTypes_delete->Recordset->EOF) {
	$HeadTypes_delete->RecordCount++;
	$HeadTypes_delete->RowCount++;

	// Set row properties
	$HeadTypes->resetAttributes();
	$HeadTypes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$HeadTypes_delete->loadRowValues($HeadTypes_delete->Recordset);

	// Render row
	$HeadTypes_delete->renderRow();
?>
	<tr <?php echo $HeadTypes->rowAttributes() ?>>
<?php if ($HeadTypes_delete->HeadType_Idn->Visible) { // HeadType_Idn ?>
		<td <?php echo $HeadTypes_delete->HeadType_Idn->cellAttributes() ?>>
<span id="el<?php echo $HeadTypes_delete->RowCount ?>_HeadTypes_HeadType_Idn" class="HeadTypes_HeadType_Idn">
<span<?php echo $HeadTypes_delete->HeadType_Idn->viewAttributes() ?>><?php echo $HeadTypes_delete->HeadType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($HeadTypes_delete->Name->Visible) { // Name ?>
		<td <?php echo $HeadTypes_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $HeadTypes_delete->RowCount ?>_HeadTypes_Name" class="HeadTypes_Name">
<span<?php echo $HeadTypes_delete->Name->viewAttributes() ?>><?php echo $HeadTypes_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($HeadTypes_delete->ShortName->Visible) { // ShortName ?>
		<td <?php echo $HeadTypes_delete->ShortName->cellAttributes() ?>>
<span id="el<?php echo $HeadTypes_delete->RowCount ?>_HeadTypes_ShortName" class="HeadTypes_ShortName">
<span<?php echo $HeadTypes_delete->ShortName->viewAttributes() ?>><?php echo $HeadTypes_delete->ShortName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($HeadTypes_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $HeadTypes_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $HeadTypes_delete->RowCount ?>_HeadTypes_Rank" class="HeadTypes_Rank">
<span<?php echo $HeadTypes_delete->Rank->viewAttributes() ?>><?php echo $HeadTypes_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($HeadTypes_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $HeadTypes_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $HeadTypes_delete->RowCount ?>_HeadTypes_ActiveFlag" class="HeadTypes_ActiveFlag">
<span<?php echo $HeadTypes_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HeadTypes_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HeadTypes_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$HeadTypes_delete->Recordset->moveNext();
}
$HeadTypes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $HeadTypes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$HeadTypes_delete->showPageFooter();
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
$HeadTypes_delete->terminate();
?>