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
$Users_add = new Users_add();

// Run the page
$Users_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Users_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fUsersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fUsersadd = currentForm = new ew.Form("fUsersadd", "add");

	// Validate form
	fUsersadd.validate = function() {
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
			<?php if ($Users_add->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_add->FirstName->caption(), $Users_add->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_add->LastName->Required) { ?>
				elm = this.getElements("x" + infix + "_LastName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_add->LastName->caption(), $Users_add->LastName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_add->UserName->Required) { ?>
				elm = this.getElements("x" + infix + "_UserName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_add->UserName->caption(), $Users_add->UserName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_add->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_add->Department_Idn->caption(), $Users_add->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_add->_Email->caption(), $Users_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_add->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_add->Password->caption(), $Users_add->Password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_add->IsContractor->Required) { ?>
				elm = this.getElements("x" + infix + "_IsContractor[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_add->IsContractor->caption(), $Users_add->IsContractor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_add->IsAdmin->Required) { ?>
				elm = this.getElements("x" + infix + "_IsAdmin[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_add->IsAdmin->caption(), $Users_add->IsAdmin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_add->ReadOnly->Required) { ?>
				elm = this.getElements("x" + infix + "_ReadOnly[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_add->ReadOnly->caption(), $Users_add->ReadOnly->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_add->ActiveFlag->caption(), $Users_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fUsersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fUsersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fUsersadd.lists["x_Department_Idn"] = <?php echo $Users_add->Department_Idn->Lookup->toClientList($Users_add) ?>;
	fUsersadd.lists["x_Department_Idn"].options = <?php echo JsonEncode($Users_add->Department_Idn->lookupOptions()) ?>;
	fUsersadd.lists["x_IsContractor[]"] = <?php echo $Users_add->IsContractor->Lookup->toClientList($Users_add) ?>;
	fUsersadd.lists["x_IsContractor[]"].options = <?php echo JsonEncode($Users_add->IsContractor->options(FALSE, TRUE)) ?>;
	fUsersadd.lists["x_IsAdmin[]"] = <?php echo $Users_add->IsAdmin->Lookup->toClientList($Users_add) ?>;
	fUsersadd.lists["x_IsAdmin[]"].options = <?php echo JsonEncode($Users_add->IsAdmin->options(FALSE, TRUE)) ?>;
	fUsersadd.lists["x_ReadOnly[]"] = <?php echo $Users_add->ReadOnly->Lookup->toClientList($Users_add) ?>;
	fUsersadd.lists["x_ReadOnly[]"].options = <?php echo JsonEncode($Users_add->ReadOnly->options(FALSE, TRUE)) ?>;
	fUsersadd.lists["x_ActiveFlag[]"] = <?php echo $Users_add->ActiveFlag->Lookup->toClientList($Users_add) ?>;
	fUsersadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Users_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fUsersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Users_add->showPageHeader(); ?>
<?php
$Users_add->showMessage();
?>
<form name="fUsersadd" id="fUsersadd" class="<?php echo $Users_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$Users_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Users_add->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_Users_FirstName" for="x_FirstName" class="<?php echo $Users_add->LeftColumnClass ?>"><?php echo $Users_add->FirstName->caption() ?><?php echo $Users_add->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_add->RightColumnClass ?>"><div <?php echo $Users_add->FirstName->cellAttributes() ?>>
<span id="el_Users_FirstName">
<input type="text" data-table="Users" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($Users_add->FirstName->getPlaceHolder()) ?>" value="<?php echo $Users_add->FirstName->EditValue ?>"<?php echo $Users_add->FirstName->editAttributes() ?>>
</span>
<?php echo $Users_add->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_add->LastName->Visible) { // LastName ?>
	<div id="r_LastName" class="form-group row">
		<label id="elh_Users_LastName" for="x_LastName" class="<?php echo $Users_add->LeftColumnClass ?>"><?php echo $Users_add->LastName->caption() ?><?php echo $Users_add->LastName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_add->RightColumnClass ?>"><div <?php echo $Users_add->LastName->cellAttributes() ?>>
<span id="el_Users_LastName">
<input type="text" data-table="Users" data-field="x_LastName" name="x_LastName" id="x_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Users_add->LastName->getPlaceHolder()) ?>" value="<?php echo $Users_add->LastName->EditValue ?>"<?php echo $Users_add->LastName->editAttributes() ?>>
</span>
<?php echo $Users_add->LastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_add->UserName->Visible) { // UserName ?>
	<div id="r_UserName" class="form-group row">
		<label id="elh_Users_UserName" for="x_UserName" class="<?php echo $Users_add->LeftColumnClass ?>"><?php echo $Users_add->UserName->caption() ?><?php echo $Users_add->UserName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_add->RightColumnClass ?>"><div <?php echo $Users_add->UserName->cellAttributes() ?>>
<span id="el_Users_UserName">
<input type="text" data-table="Users" data-field="x_UserName" name="x_UserName" id="x_UserName" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($Users_add->UserName->getPlaceHolder()) ?>" value="<?php echo $Users_add->UserName->EditValue ?>"<?php echo $Users_add->UserName->editAttributes() ?>>
</span>
<?php echo $Users_add->UserName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_add->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_Users_Department_Idn" for="x_Department_Idn" class="<?php echo $Users_add->LeftColumnClass ?>"><?php echo $Users_add->Department_Idn->caption() ?><?php echo $Users_add->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_add->RightColumnClass ?>"><div <?php echo $Users_add->Department_Idn->cellAttributes() ?>>
<span id="el_Users_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Users" data-field="x_Department_Idn" data-value-separator="<?php echo $Users_add->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $Users_add->Department_Idn->editAttributes() ?>>
			<?php echo $Users_add->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $Users_add->Department_Idn->Lookup->getParamTag($Users_add, "p_x_Department_Idn") ?>
</span>
<?php echo $Users_add->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_Users__Email" for="x__Email" class="<?php echo $Users_add->LeftColumnClass ?>"><?php echo $Users_add->_Email->caption() ?><?php echo $Users_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_add->RightColumnClass ?>"><div <?php echo $Users_add->_Email->cellAttributes() ?>>
<span id="el_Users__Email">
<input type="text" data-table="Users" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Users_add->_Email->getPlaceHolder()) ?>" value="<?php echo $Users_add->_Email->EditValue ?>"<?php echo $Users_add->_Email->editAttributes() ?>>
</span>
<?php echo $Users_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_add->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_Users_Password" for="x_Password" class="<?php echo $Users_add->LeftColumnClass ?>"><?php echo $Users_add->Password->caption() ?><?php echo $Users_add->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_add->RightColumnClass ?>"><div <?php echo $Users_add->Password->cellAttributes() ?>>
<span id="el_Users_Password">
<input type="text" data-table="Users" data-field="x_Password" name="x_Password" id="x_Password" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($Users_add->Password->getPlaceHolder()) ?>" value="<?php echo $Users_add->Password->EditValue ?>"<?php echo $Users_add->Password->editAttributes() ?>>
</span>
<?php echo $Users_add->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_add->IsContractor->Visible) { // IsContractor ?>
	<div id="r_IsContractor" class="form-group row">
		<label id="elh_Users_IsContractor" class="<?php echo $Users_add->LeftColumnClass ?>"><?php echo $Users_add->IsContractor->caption() ?><?php echo $Users_add->IsContractor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_add->RightColumnClass ?>"><div <?php echo $Users_add->IsContractor->cellAttributes() ?>>
<span id="el_Users_IsContractor">
<?php
$selwrk = ConvertToBool($Users_add->IsContractor->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsContractor" name="x_IsContractor[]" id="x_IsContractor[]_886077" value="1"<?php echo $selwrk ?><?php echo $Users_add->IsContractor->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsContractor[]_886077"></label>
</div>
</span>
<?php echo $Users_add->IsContractor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_add->IsAdmin->Visible) { // IsAdmin ?>
	<div id="r_IsAdmin" class="form-group row">
		<label id="elh_Users_IsAdmin" class="<?php echo $Users_add->LeftColumnClass ?>"><?php echo $Users_add->IsAdmin->caption() ?><?php echo $Users_add->IsAdmin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_add->RightColumnClass ?>"><div <?php echo $Users_add->IsAdmin->cellAttributes() ?>>
<span id="el_Users_IsAdmin">
<?php
$selwrk = ConvertToBool($Users_add->IsAdmin->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsAdmin" name="x_IsAdmin[]" id="x_IsAdmin[]_658905" value="1"<?php echo $selwrk ?><?php echo $Users_add->IsAdmin->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsAdmin[]_658905"></label>
</div>
</span>
<?php echo $Users_add->IsAdmin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_add->ReadOnly->Visible) { // ReadOnly ?>
	<div id="r_ReadOnly" class="form-group row">
		<label id="elh_Users_ReadOnly" class="<?php echo $Users_add->LeftColumnClass ?>"><?php echo $Users_add->ReadOnly->caption() ?><?php echo $Users_add->ReadOnly->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_add->RightColumnClass ?>"><div <?php echo $Users_add->ReadOnly->cellAttributes() ?>>
<span id="el_Users_ReadOnly">
<?php
$selwrk = ConvertToBool($Users_add->ReadOnly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_ReadOnly" name="x_ReadOnly[]" id="x_ReadOnly[]_965707" value="1"<?php echo $selwrk ?><?php echo $Users_add->ReadOnly->editAttributes() ?>>
	<label class="custom-control-label" for="x_ReadOnly[]_965707"></label>
</div>
</span>
<?php echo $Users_add->ReadOnly->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Users_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_Users_ActiveFlag" class="<?php echo $Users_add->LeftColumnClass ?>"><?php echo $Users_add->ActiveFlag->caption() ?><?php echo $Users_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Users_add->RightColumnClass ?>"><div <?php echo $Users_add->ActiveFlag->cellAttributes() ?>>
<span id="el_Users_ActiveFlag">
<?php
$selwrk = ConvertToBool($Users_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_544100" value="1"<?php echo $selwrk ?><?php echo $Users_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_544100"></label>
</div>
</span>
<?php echo $Users_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Users_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Users_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Users_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Users_add->showPageFooter();
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
$Users_add->terminate();
?>