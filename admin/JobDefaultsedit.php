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
$JobDefaults_edit = new JobDefaults_edit();

// Run the page
$JobDefaults_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobDefaults_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fJobDefaultsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fJobDefaultsedit = currentForm = new ew.Form("fJobDefaultsedit", "edit");

	// Validate form
	fJobDefaultsedit.validate = function() {
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
			<?php if ($JobDefaults_edit->JobDefault_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_JobDefault_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_edit->JobDefault_Idn->caption(), $JobDefaults_edit->JobDefault_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_edit->JobDefaultType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_JobDefaultType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_edit->JobDefaultType_Idn->caption(), $JobDefaults_edit->JobDefaultType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_edit->Department_Idn->caption(), $JobDefaults_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_edit->ParentJobDefault_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ParentJobDefault_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_edit->ParentJobDefault_Idn->caption(), $JobDefaults_edit->ParentJobDefault_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ParentJobDefault_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobDefaults_edit->ParentJobDefault_Idn->errorMessage()) ?>");
			<?php if ($JobDefaults_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_edit->Name->caption(), $JobDefaults_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_edit->NumericValue->Required) { ?>
				elm = this.getElements("x" + infix + "_NumericValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_edit->NumericValue->caption(), $JobDefaults_edit->NumericValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumericValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobDefaults_edit->NumericValue->errorMessage()) ?>");
			<?php if ($JobDefaults_edit->AlphaValue->Required) { ?>
				elm = this.getElements("x" + infix + "_AlphaValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_edit->AlphaValue->caption(), $JobDefaults_edit->AlphaValue->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_edit->LoadFromJobDefault_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LoadFromJobDefault_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_edit->LoadFromJobDefault_Idn->caption(), $JobDefaults_edit->LoadFromJobDefault_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_edit->Rank->caption(), $JobDefaults_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobDefaults_edit->Rank->errorMessage()) ?>");
			<?php if ($JobDefaults_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_edit->ActiveFlag->caption(), $JobDefaults_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fJobDefaultsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fJobDefaultsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fJobDefaultsedit.lists["x_JobDefaultType_Idn"] = <?php echo $JobDefaults_edit->JobDefaultType_Idn->Lookup->toClientList($JobDefaults_edit) ?>;
	fJobDefaultsedit.lists["x_JobDefaultType_Idn"].options = <?php echo JsonEncode($JobDefaults_edit->JobDefaultType_Idn->lookupOptions()) ?>;
	fJobDefaultsedit.lists["x_Department_Idn"] = <?php echo $JobDefaults_edit->Department_Idn->Lookup->toClientList($JobDefaults_edit) ?>;
	fJobDefaultsedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($JobDefaults_edit->Department_Idn->lookupOptions()) ?>;
	fJobDefaultsedit.lists["x_LoadFromJobDefault_Idn"] = <?php echo $JobDefaults_edit->LoadFromJobDefault_Idn->Lookup->toClientList($JobDefaults_edit) ?>;
	fJobDefaultsedit.lists["x_LoadFromJobDefault_Idn"].options = <?php echo JsonEncode($JobDefaults_edit->LoadFromJobDefault_Idn->lookupOptions()) ?>;
	fJobDefaultsedit.lists["x_ActiveFlag[]"] = <?php echo $JobDefaults_edit->ActiveFlag->Lookup->toClientList($JobDefaults_edit) ?>;
	fJobDefaultsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($JobDefaults_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fJobDefaultsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $JobDefaults_edit->showPageHeader(); ?>
<?php
$JobDefaults_edit->showMessage();
?>
<?php if (!$JobDefaults_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobDefaults_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fJobDefaultsedit" id="fJobDefaultsedit" class="<?php echo $JobDefaults_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobDefaults">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$JobDefaults_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($JobDefaults_edit->JobDefault_Idn->Visible) { // JobDefault_Idn ?>
	<div id="r_JobDefault_Idn" class="form-group row">
		<label id="elh_JobDefaults_JobDefault_Idn" class="<?php echo $JobDefaults_edit->LeftColumnClass ?>"><?php echo $JobDefaults_edit->JobDefault_Idn->caption() ?><?php echo $JobDefaults_edit->JobDefault_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_edit->RightColumnClass ?>"><div <?php echo $JobDefaults_edit->JobDefault_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_JobDefault_Idn">
<span<?php echo $JobDefaults_edit->JobDefault_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($JobDefaults_edit->JobDefault_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_JobDefault_Idn" name="x_JobDefault_Idn" id="x_JobDefault_Idn" value="<?php echo HtmlEncode($JobDefaults_edit->JobDefault_Idn->CurrentValue) ?>">
<?php echo $JobDefaults_edit->JobDefault_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_edit->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
	<div id="r_JobDefaultType_Idn" class="form-group row">
		<label id="elh_JobDefaults_JobDefaultType_Idn" for="x_JobDefaultType_Idn" class="<?php echo $JobDefaults_edit->LeftColumnClass ?>"><?php echo $JobDefaults_edit->JobDefaultType_Idn->caption() ?><?php echo $JobDefaults_edit->JobDefaultType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_edit->RightColumnClass ?>"><div <?php echo $JobDefaults_edit->JobDefaultType_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_JobDefaultType_Idn">
<?php $JobDefaults_edit->JobDefaultType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_JobDefaultType_Idn" data-value-separator="<?php echo $JobDefaults_edit->JobDefaultType_Idn->displayValueSeparatorAttribute() ?>" id="x_JobDefaultType_Idn" name="x_JobDefaultType_Idn"<?php echo $JobDefaults_edit->JobDefaultType_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_edit->JobDefaultType_Idn->selectOptionListHtml("x_JobDefaultType_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_edit->JobDefaultType_Idn->Lookup->getParamTag($JobDefaults_edit, "p_x_JobDefaultType_Idn") ?>
</span>
<?php echo $JobDefaults_edit->JobDefaultType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_JobDefaults_Department_Idn" for="x_Department_Idn" class="<?php echo $JobDefaults_edit->LeftColumnClass ?>"><?php echo $JobDefaults_edit->Department_Idn->caption() ?><?php echo $JobDefaults_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_edit->RightColumnClass ?>"><div <?php echo $JobDefaults_edit->Department_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_Department_Idn" data-value-separator="<?php echo $JobDefaults_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $JobDefaults_edit->Department_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_edit->Department_Idn->Lookup->getParamTag($JobDefaults_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $JobDefaults_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_edit->ParentJobDefault_Idn->Visible) { // ParentJobDefault_Idn ?>
	<div id="r_ParentJobDefault_Idn" class="form-group row">
		<label id="elh_JobDefaults_ParentJobDefault_Idn" for="x_ParentJobDefault_Idn" class="<?php echo $JobDefaults_edit->LeftColumnClass ?>"><?php echo $JobDefaults_edit->ParentJobDefault_Idn->caption() ?><?php echo $JobDefaults_edit->ParentJobDefault_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_edit->RightColumnClass ?>"><div <?php echo $JobDefaults_edit->ParentJobDefault_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_ParentJobDefault_Idn">
<input type="text" data-table="JobDefaults" data-field="x_ParentJobDefault_Idn" name="x_ParentJobDefault_Idn" id="x_ParentJobDefault_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_edit->ParentJobDefault_Idn->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_edit->ParentJobDefault_Idn->EditValue ?>"<?php echo $JobDefaults_edit->ParentJobDefault_Idn->editAttributes() ?>>
</span>
<?php echo $JobDefaults_edit->ParentJobDefault_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_JobDefaults_Name" for="x_Name" class="<?php echo $JobDefaults_edit->LeftColumnClass ?>"><?php echo $JobDefaults_edit->Name->caption() ?><?php echo $JobDefaults_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_edit->RightColumnClass ?>"><div <?php echo $JobDefaults_edit->Name->cellAttributes() ?>>
<span id="el_JobDefaults_Name">
<input type="text" data-table="JobDefaults" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobDefaults_edit->Name->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_edit->Name->EditValue ?>"<?php echo $JobDefaults_edit->Name->editAttributes() ?>>
</span>
<?php echo $JobDefaults_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_edit->NumericValue->Visible) { // NumericValue ?>
	<div id="r_NumericValue" class="form-group row">
		<label id="elh_JobDefaults_NumericValue" for="x_NumericValue" class="<?php echo $JobDefaults_edit->LeftColumnClass ?>"><?php echo $JobDefaults_edit->NumericValue->caption() ?><?php echo $JobDefaults_edit->NumericValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_edit->RightColumnClass ?>"><div <?php echo $JobDefaults_edit->NumericValue->cellAttributes() ?>>
<span id="el_JobDefaults_NumericValue">
<input type="text" data-table="JobDefaults" data-field="x_NumericValue" name="x_NumericValue" id="x_NumericValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($JobDefaults_edit->NumericValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_edit->NumericValue->EditValue ?>"<?php echo $JobDefaults_edit->NumericValue->editAttributes() ?>>
</span>
<?php echo $JobDefaults_edit->NumericValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_edit->AlphaValue->Visible) { // AlphaValue ?>
	<div id="r_AlphaValue" class="form-group row">
		<label id="elh_JobDefaults_AlphaValue" for="x_AlphaValue" class="<?php echo $JobDefaults_edit->LeftColumnClass ?>"><?php echo $JobDefaults_edit->AlphaValue->caption() ?><?php echo $JobDefaults_edit->AlphaValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_edit->RightColumnClass ?>"><div <?php echo $JobDefaults_edit->AlphaValue->cellAttributes() ?>>
<span id="el_JobDefaults_AlphaValue">
<input type="text" data-table="JobDefaults" data-field="x_AlphaValue" name="x_AlphaValue" id="x_AlphaValue" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($JobDefaults_edit->AlphaValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_edit->AlphaValue->EditValue ?>"<?php echo $JobDefaults_edit->AlphaValue->editAttributes() ?>>
</span>
<?php echo $JobDefaults_edit->AlphaValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_edit->LoadFromJobDefault_Idn->Visible) { // LoadFromJobDefault_Idn ?>
	<div id="r_LoadFromJobDefault_Idn" class="form-group row">
		<label id="elh_JobDefaults_LoadFromJobDefault_Idn" for="x_LoadFromJobDefault_Idn" class="<?php echo $JobDefaults_edit->LeftColumnClass ?>"><?php echo $JobDefaults_edit->LoadFromJobDefault_Idn->caption() ?><?php echo $JobDefaults_edit->LoadFromJobDefault_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_edit->RightColumnClass ?>"><div <?php echo $JobDefaults_edit->LoadFromJobDefault_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_LoadFromJobDefault_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_LoadFromJobDefault_Idn" data-value-separator="<?php echo $JobDefaults_edit->LoadFromJobDefault_Idn->displayValueSeparatorAttribute() ?>" id="x_LoadFromJobDefault_Idn" name="x_LoadFromJobDefault_Idn"<?php echo $JobDefaults_edit->LoadFromJobDefault_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_edit->LoadFromJobDefault_Idn->selectOptionListHtml("x_LoadFromJobDefault_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_edit->LoadFromJobDefault_Idn->Lookup->getParamTag($JobDefaults_edit, "p_x_LoadFromJobDefault_Idn") ?>
</span>
<?php echo $JobDefaults_edit->LoadFromJobDefault_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_JobDefaults_Rank" for="x_Rank" class="<?php echo $JobDefaults_edit->LeftColumnClass ?>"><?php echo $JobDefaults_edit->Rank->caption() ?><?php echo $JobDefaults_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_edit->RightColumnClass ?>"><div <?php echo $JobDefaults_edit->Rank->cellAttributes() ?>>
<span id="el_JobDefaults_Rank">
<input type="text" data-table="JobDefaults" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_edit->Rank->EditValue ?>"<?php echo $JobDefaults_edit->Rank->editAttributes() ?>>
</span>
<?php echo $JobDefaults_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_JobDefaults_ActiveFlag" class="<?php echo $JobDefaults_edit->LeftColumnClass ?>"><?php echo $JobDefaults_edit->ActiveFlag->caption() ?><?php echo $JobDefaults_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_edit->RightColumnClass ?>"><div <?php echo $JobDefaults_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_JobDefaults_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobDefaults_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobDefaults" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_265091" value="1"<?php echo $selwrk ?><?php echo $JobDefaults_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_265091"></label>
</div>
</span>
<?php echo $JobDefaults_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$JobDefaults_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $JobDefaults_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobDefaults_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$JobDefaults_edit->IsModal) { ?>
<?php echo $JobDefaults_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$JobDefaults_edit->showPageFooter();
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
$JobDefaults_edit->terminate();
?>