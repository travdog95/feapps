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
$Users_delete = new Users_delete();

// Run the page
$Users_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Users_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fUsersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fUsersdelete = currentForm = new ew.Form("fUsersdelete", "delete");
	loadjs.done("fUsersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Users_delete->showPageHeader(); ?>
<?php
$Users_delete->showMessage();
?>
<form name="fUsersdelete" id="fUsersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Users">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Users_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Users_delete->User_Idn->Visible) { // User_Idn ?>
		<th class="<?php echo $Users_delete->User_Idn->headerCellClass() ?>"><span id="elh_Users_User_Idn" class="Users_User_Idn"><?php echo $Users_delete->User_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Users_delete->FirstName->Visible) { // FirstName ?>
		<th class="<?php echo $Users_delete->FirstName->headerCellClass() ?>"><span id="elh_Users_FirstName" class="Users_FirstName"><?php echo $Users_delete->FirstName->caption() ?></span></th>
<?php } ?>
<?php if ($Users_delete->LastName->Visible) { // LastName ?>
		<th class="<?php echo $Users_delete->LastName->headerCellClass() ?>"><span id="elh_Users_LastName" class="Users_LastName"><?php echo $Users_delete->LastName->caption() ?></span></th>
<?php } ?>
<?php if ($Users_delete->UserName->Visible) { // UserName ?>
		<th class="<?php echo $Users_delete->UserName->headerCellClass() ?>"><span id="elh_Users_UserName" class="Users_UserName"><?php echo $Users_delete->UserName->caption() ?></span></th>
<?php } ?>
<?php if ($Users_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $Users_delete->Department_Idn->headerCellClass() ?>"><span id="elh_Users_Department_Idn" class="Users_Department_Idn"><?php echo $Users_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Users_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $Users_delete->_Email->headerCellClass() ?>"><span id="elh_Users__Email" class="Users__Email"><?php echo $Users_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($Users_delete->IsContractor->Visible) { // IsContractor ?>
		<th class="<?php echo $Users_delete->IsContractor->headerCellClass() ?>"><span id="elh_Users_IsContractor" class="Users_IsContractor"><?php echo $Users_delete->IsContractor->caption() ?></span></th>
<?php } ?>
<?php if ($Users_delete->IsAdmin->Visible) { // IsAdmin ?>
		<th class="<?php echo $Users_delete->IsAdmin->headerCellClass() ?>"><span id="elh_Users_IsAdmin" class="Users_IsAdmin"><?php echo $Users_delete->IsAdmin->caption() ?></span></th>
<?php } ?>
<?php if ($Users_delete->ReadOnly->Visible) { // ReadOnly ?>
		<th class="<?php echo $Users_delete->ReadOnly->headerCellClass() ?>"><span id="elh_Users_ReadOnly" class="Users_ReadOnly"><?php echo $Users_delete->ReadOnly->caption() ?></span></th>
<?php } ?>
<?php if ($Users_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $Users_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_Users_ActiveFlag" class="Users_ActiveFlag"><?php echo $Users_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Users_delete->RecordCount = 0;
$i = 0;
while (!$Users_delete->Recordset->EOF) {
	$Users_delete->RecordCount++;
	$Users_delete->RowCount++;

	// Set row properties
	$Users->resetAttributes();
	$Users->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Users_delete->loadRowValues($Users_delete->Recordset);

	// Render row
	$Users_delete->renderRow();
?>
	<tr <?php echo $Users->rowAttributes() ?>>
<?php if ($Users_delete->User_Idn->Visible) { // User_Idn ?>
		<td <?php echo $Users_delete->User_Idn->cellAttributes() ?>>
<span id="el<?php echo $Users_delete->RowCount ?>_Users_User_Idn" class="Users_User_Idn">
<span<?php echo $Users_delete->User_Idn->viewAttributes() ?>><?php echo $Users_delete->User_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Users_delete->FirstName->Visible) { // FirstName ?>
		<td <?php echo $Users_delete->FirstName->cellAttributes() ?>>
<span id="el<?php echo $Users_delete->RowCount ?>_Users_FirstName" class="Users_FirstName">
<span<?php echo $Users_delete->FirstName->viewAttributes() ?>><?php echo $Users_delete->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Users_delete->LastName->Visible) { // LastName ?>
		<td <?php echo $Users_delete->LastName->cellAttributes() ?>>
<span id="el<?php echo $Users_delete->RowCount ?>_Users_LastName" class="Users_LastName">
<span<?php echo $Users_delete->LastName->viewAttributes() ?>><?php echo $Users_delete->LastName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Users_delete->UserName->Visible) { // UserName ?>
		<td <?php echo $Users_delete->UserName->cellAttributes() ?>>
<span id="el<?php echo $Users_delete->RowCount ?>_Users_UserName" class="Users_UserName">
<span<?php echo $Users_delete->UserName->viewAttributes() ?>><?php echo $Users_delete->UserName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Users_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $Users_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $Users_delete->RowCount ?>_Users_Department_Idn" class="Users_Department_Idn">
<span<?php echo $Users_delete->Department_Idn->viewAttributes() ?>><?php echo $Users_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Users_delete->_Email->Visible) { // Email ?>
		<td <?php echo $Users_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $Users_delete->RowCount ?>_Users__Email" class="Users__Email">
<span<?php echo $Users_delete->_Email->viewAttributes() ?>><?php echo $Users_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Users_delete->IsContractor->Visible) { // IsContractor ?>
		<td <?php echo $Users_delete->IsContractor->cellAttributes() ?>>
<span id="el<?php echo $Users_delete->RowCount ?>_Users_IsContractor" class="Users_IsContractor">
<span<?php echo $Users_delete->IsContractor->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsContractor" class="custom-control-input" value="<?php echo $Users_delete->IsContractor->getViewValue() ?>" disabled<?php if (ConvertToBool($Users_delete->IsContractor->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsContractor"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Users_delete->IsAdmin->Visible) { // IsAdmin ?>
		<td <?php echo $Users_delete->IsAdmin->cellAttributes() ?>>
<span id="el<?php echo $Users_delete->RowCount ?>_Users_IsAdmin" class="Users_IsAdmin">
<span<?php echo $Users_delete->IsAdmin->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsAdmin" class="custom-control-input" value="<?php echo $Users_delete->IsAdmin->getViewValue() ?>" disabled<?php if (ConvertToBool($Users_delete->IsAdmin->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsAdmin"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Users_delete->ReadOnly->Visible) { // ReadOnly ?>
		<td <?php echo $Users_delete->ReadOnly->cellAttributes() ?>>
<span id="el<?php echo $Users_delete->RowCount ?>_Users_ReadOnly" class="Users_ReadOnly">
<span<?php echo $Users_delete->ReadOnly->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ReadOnly" class="custom-control-input" value="<?php echo $Users_delete->ReadOnly->getViewValue() ?>" disabled<?php if (ConvertToBool($Users_delete->ReadOnly->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ReadOnly"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Users_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $Users_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $Users_delete->RowCount ?>_Users_ActiveFlag" class="Users_ActiveFlag">
<span<?php echo $Users_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Users_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Users_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Users_delete->Recordset->moveNext();
}
$Users_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Users_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Users_delete->showPageFooter();
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
$Users_delete->terminate();
?>