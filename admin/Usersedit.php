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
$Users_edit = new Users_edit();

// Run the page
$Users_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Users_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fUsersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fUsersedit = currentForm = new ew.Form("fUsersedit", "edit");

	// Validate form
	fUsersedit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($Users_edit->User_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_User_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_edit->User_Idn->caption(), $Users_edit->User_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_edit->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_edit->FirstName->caption(), $Users_edit->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_edit->LastName->Required) { ?>
				elm = this.getElements("x" + infix + "_LastName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_edit->LastName->caption(), $Users_edit->LastName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_edit->UserName->Required) { ?>
				elm = this.getElements("x" + infix + "_UserName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_edit->UserName->caption(), $Users_edit->UserName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_edit->Department_Idn->caption(), $Users_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_edit->_Email->caption(), $Users_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_edit->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_edit->Password->caption(), $Users_edit->Password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_edit->IsContractor->Required) { ?>
				elm = this.getElements("x" + infix + "_IsContractor[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_edit->IsContractor->caption(), $Users_edit->IsContractor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_edit->IsAdmin->Required) { ?>
				elm = this.getElements("x" + infix + "_IsAdmin[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_edit->IsAdmin->caption(), $Users_edit->IsAdmin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_edit->ReadOnly->Required) { ?>
				elm = this.getElements("x" + infix + "_ReadOnly[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_edit->ReadOnly->caption(), $Users_edit->ReadOnly->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_edit->ActiveFlag->caption(), $Users_edit->ActiveFlag->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fUsersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fUsersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fUsersedit.lists["x_Department_Idn"] = <?php echo $Users_edit->Department_Idn->Lookup->toClientList($Users_edit) ?>;
	fUsersedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($Users_edit->Department_Idn->lookupOptions()) ?>;
	fUsersedit.lists["x_IsContractor[]"] = <?php echo $Users_edit->IsContractor->Lookup->toClientList($Users_edit) ?>;
	fUsersedit.lists["x_IsContractor[]"].options = <?php echo JsonEncode($Users_edit->IsContractor->options(FALSE, TRUE)) ?>;
	fUsersedit.lists["x_IsAdmin[]"] = <?php echo $Users_edit->IsAdmin->Lookup->toClientList($Users_edit) ?>;
	fUsersedit.lists["x_IsAdmin[]"].options = <?php echo JsonEncode($Users_edit->IsAdmin->options(FALSE, TRUE)) ?>;
	fUsersedit.lists["x_ReadOnly[]"] = <?php echo $Users_edit->ReadOnly->Lookup->toClientList($Users_edit) ?>;
	fUsersedit.lists["x_ReadOnly[]"].options = <?php echo JsonEncode($Users_edit->ReadOnly->options(FALSE, TRUE)) ?>;
	fUsersedit.lists["x_ActiveFlag[]"] = <?php echo $Users_edit->ActiveFlag->Lookup->toClientList($Users_edit) ?>;
	fUsersedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Users_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fUsersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Users_edit->showPageHeader(); ?>
<?php
$Users_edit->showMessage();
?>
<?php if (!$Users_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Users_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fUsersedit" id="fUsersedit" class="<?php echo $Users_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Users">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Users_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Users_edit->User_Idn->Visible) { // User_Idn ?>
	<div id="r_User_Idn" class="form-group row">
		<label id="elh_Users_User_Idn" class="<?php echo $Users_edit->LeftColumnClass ?>"><?php echo $Users_edit->User_Idn->caption() ?><?php echo $Users_edit->User_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_edit->RightColumnClass ?>"><div <?php echo $Users_edit->User_Idn->cellAttributes() ?>>
<span id="el_Users_User_Idn">
<span<?php echo $Users_edit->User_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Users_edit->User_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Users" data-field="x_User_Idn" name="x_User_Idn" id="x_User_Idn" value="<?php echo HtmlEncode($Users_edit->User_Idn->CurrentValue) ?>">
<?php echo $Users_edit->User_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_edit->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_Users_FirstName" for="x_FirstName" class="<?php echo $Users_edit->LeftColumnClass ?>"><?php echo $Users_edit->FirstName->caption() ?><?php echo $Users_edit->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_edit->RightColumnClass ?>"><div <?php echo $Users_edit->FirstName->cellAttributes() ?>>
<span id="el_Users_FirstName">
<input type="text" data-table="Users" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($Users_edit->FirstName->getPlaceHolder()) ?>" value="<?php echo $Users_edit->FirstName->EditValue ?>"<?php echo $Users_edit->FirstName->editAttributes() ?>>
</span>
<?php echo $Users_edit->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_edit->LastName->Visible) { // LastName ?>
	<div id="r_LastName" class="form-group row">
		<label id="elh_Users_LastName" for="x_LastName" class="<?php echo $Users_edit->LeftColumnClass ?>"><?php echo $Users_edit->LastName->caption() ?><?php echo $Users_edit->LastName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_edit->RightColumnClass ?>"><div <?php echo $Users_edit->LastName->cellAttributes() ?>>
<span id="el_Users_LastName">
<input type="text" data-table="Users" data-field="x_LastName" name="x_LastName" id="x_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Users_edit->LastName->getPlaceHolder()) ?>" value="<?php echo $Users_edit->LastName->EditValue ?>"<?php echo $Users_edit->LastName->editAttributes() ?>>
</span>
<?php echo $Users_edit->LastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_edit->UserName->Visible) { // UserName ?>
	<div id="r_UserName" class="form-group row">
		<label id="elh_Users_UserName" for="x_UserName" class="<?php echo $Users_edit->LeftColumnClass ?>"><?php echo $Users_edit->UserName->caption() ?><?php echo $Users_edit->UserName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_edit->RightColumnClass ?>"><div <?php echo $Users_edit->UserName->cellAttributes() ?>>
<span id="el_Users_UserName">
<input type="text" data-table="Users" data-field="x_UserName" name="x_UserName" id="x_UserName" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($Users_edit->UserName->getPlaceHolder()) ?>" value="<?php echo $Users_edit->UserName->EditValue ?>"<?php echo $Users_edit->UserName->editAttributes() ?>>
</span>
<?php echo $Users_edit->UserName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_Users_Department_Idn" for="x_Department_Idn" class="<?php echo $Users_edit->LeftColumnClass ?>"><?php echo $Users_edit->Department_Idn->caption() ?><?php echo $Users_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_edit->RightColumnClass ?>"><div <?php echo $Users_edit->Department_Idn->cellAttributes() ?>>
<span id="el_Users_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Users" data-field="x_Department_Idn" data-value-separator="<?php echo $Users_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $Users_edit->Department_Idn->editAttributes() ?>>
			<?php echo $Users_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $Users_edit->Department_Idn->Lookup->getParamTag($Users_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $Users_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_Users__Email" for="x__Email" class="<?php echo $Users_edit->LeftColumnClass ?>"><?php echo $Users_edit->_Email->caption() ?><?php echo $Users_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_edit->RightColumnClass ?>"><div <?php echo $Users_edit->_Email->cellAttributes() ?>>
<span id="el_Users__Email">
<input type="text" data-table="Users" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Users_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $Users_edit->_Email->EditValue ?>"<?php echo $Users_edit->_Email->editAttributes() ?>>
</span>
<?php echo $Users_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_edit->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_Users_Password" for="x_Password" class="<?php echo $Users_edit->LeftColumnClass ?>"><?php echo $Users_edit->Password->caption() ?><?php echo $Users_edit->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_edit->RightColumnClass ?>"><div <?php echo $Users_edit->Password->cellAttributes() ?>>
<span id="el_Users_Password">
<input type="text" data-table="Users" data-field="x_Password" name="x_Password" id="x_Password" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($Users_edit->Password->getPlaceHolder()) ?>" value="<?php echo $Users_edit->Password->EditValue ?>"<?php echo $Users_edit->Password->editAttributes() ?>>
</span>
<?php echo $Users_edit->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_edit->IsContractor->Visible) { // IsContractor ?>
	<div id="r_IsContractor" class="form-group row">
		<label id="elh_Users_IsContractor" class="<?php echo $Users_edit->LeftColumnClass ?>"><?php echo $Users_edit->IsContractor->caption() ?><?php echo $Users_edit->IsContractor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_edit->RightColumnClass ?>"><div <?php echo $Users_edit->IsContractor->cellAttributes() ?>>
<span id="el_Users_IsContractor">
<?php
$selwrk = ConvertToBool($Users_edit->IsContractor->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsContractor" name="x_IsContractor[]" id="x_IsContractor[]_655479" value="1"<?php echo $selwrk ?><?php echo $Users_edit->IsContractor->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsContractor[]_655479"></label>
</div>
</span>
<?php echo $Users_edit->IsContractor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_edit->IsAdmin->Visible) { // IsAdmin ?>
	<div id="r_IsAdmin" class="form-group row">
		<label id="elh_Users_IsAdmin" class="<?php echo $Users_edit->LeftColumnClass ?>"><?php echo $Users_edit->IsAdmin->caption() ?><?php echo $Users_edit->IsAdmin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_edit->RightColumnClass ?>"><div <?php echo $Users_edit->IsAdmin->cellAttributes() ?>>
<span id="el_Users_IsAdmin">
<?php
$selwrk = ConvertToBool($Users_edit->IsAdmin->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsAdmin" name="x_IsAdmin[]" id="x_IsAdmin[]_219812" value="1"<?php echo $selwrk ?><?php echo $Users_edit->IsAdmin->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsAdmin[]_219812"></label>
</div>
</span>
<?php echo $Users_edit->IsAdmin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_edit->ReadOnly->Visible) { // ReadOnly ?>
	<div id="r_ReadOnly" class="form-group row">
		<label id="elh_Users_ReadOnly" class="<?php echo $Users_edit->LeftColumnClass ?>"><?php echo $Users_edit->ReadOnly->caption() ?><?php echo $Users_edit->ReadOnly->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_edit->RightColumnClass ?>"><div <?php echo $Users_edit->ReadOnly->cellAttributes() ?>>
<span id="el_Users_ReadOnly">
<?php
$selwrk = ConvertToBool($Users_edit->ReadOnly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_ReadOnly" name="x_ReadOnly[]" id="x_ReadOnly[]_787015" value="1"<?php echo $selwrk ?><?php echo $Users_edit->ReadOnly->editAttributes() ?>>
	<label class="custom-control-label" for="x_ReadOnly[]_787015"></label>
</div>
</span>
<?php echo $Users_edit->ReadOnly->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_Users_ActiveFlag" class="<?php echo $Users_edit->LeftColumnClass ?>"><?php echo $Users_edit->ActiveFlag->caption() ?><?php echo $Users_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_edit->RightColumnClass ?>"><div <?php echo $Users_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_Users_ActiveFlag">
<?php
$selwrk = ConvertToBool($Users_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_102563" value="1"<?php echo $selwrk ?><?php echo $Users_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_102563"></label>
</div>
</span>
<?php echo $Users_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Users_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Users_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Users_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$Users_edit->IsModal) { ?>
<?php echo $Users_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$Users_edit->showPageFooter();
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
$Users_edit->terminate();
?>