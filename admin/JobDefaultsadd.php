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
$JobDefaults_add = new JobDefaults_add();

// Run the page
$JobDefaults_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobDefaults_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fJobDefaultsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fJobDefaultsadd = currentForm = new ew.Form("fJobDefaultsadd", "add");

	// Validate form
	fJobDefaultsadd.validate = function() {
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
			<?php if ($JobDefaults_add->JobDefaultType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_JobDefaultType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_add->JobDefaultType_Idn->caption(), $JobDefaults_add->JobDefaultType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_add->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_add->Department_Idn->caption(), $JobDefaults_add->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_add->ParentJobDefault_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ParentJobDefault_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_add->ParentJobDefault_Idn->caption(), $JobDefaults_add->ParentJobDefault_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ParentJobDefault_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobDefaults_add->ParentJobDefault_Idn->errorMessage()) ?>");
			<?php if ($JobDefaults_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_add->Name->caption(), $JobDefaults_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_add->NumericValue->Required) { ?>
				elm = this.getElements("x" + infix + "_NumericValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_add->NumericValue->caption(), $JobDefaults_add->NumericValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumericValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobDefaults_add->NumericValue->errorMessage()) ?>");
			<?php if ($JobDefaults_add->AlphaValue->Required) { ?>
				elm = this.getElements("x" + infix + "_AlphaValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_add->AlphaValue->caption(), $JobDefaults_add->AlphaValue->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_add->LoadFromJobDefault_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LoadFromJobDefault_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_add->LoadFromJobDefault_Idn->caption(), $JobDefaults_add->LoadFromJobDefault_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_add->Rank->caption(), $JobDefaults_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobDefaults_add->Rank->errorMessage()) ?>");
			<?php if ($JobDefaults_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_add->ActiveFlag->caption(), $JobDefaults_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fJobDefaultsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fJobDefaultsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fJobDefaultsadd.lists["x_JobDefaultType_Idn"] = <?php echo $JobDefaults_add->JobDefaultType_Idn->Lookup->toClientList($JobDefaults_add) ?>;
	fJobDefaultsadd.lists["x_JobDefaultType_Idn"].options = <?php echo JsonEncode($JobDefaults_add->JobDefaultType_Idn->lookupOptions()) ?>;
	fJobDefaultsadd.lists["x_Department_Idn"] = <?php echo $JobDefaults_add->Department_Idn->Lookup->toClientList($JobDefaults_add) ?>;
	fJobDefaultsadd.lists["x_Department_Idn"].options = <?php echo JsonEncode($JobDefaults_add->Department_Idn->lookupOptions()) ?>;
	fJobDefaultsadd.lists["x_LoadFromJobDefault_Idn"] = <?php echo $JobDefaults_add->LoadFromJobDefault_Idn->Lookup->toClientList($JobDefaults_add) ?>;
	fJobDefaultsadd.lists["x_LoadFromJobDefault_Idn"].options = <?php echo JsonEncode($JobDefaults_add->LoadFromJobDefault_Idn->lookupOptions()) ?>;
	fJobDefaultsadd.lists["x_ActiveFlag[]"] = <?php echo $JobDefaults_add->ActiveFlag->Lookup->toClientList($JobDefaults_add) ?>;
	fJobDefaultsadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($JobDefaults_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fJobDefaultsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $JobDefaults_add->showPageHeader(); ?>
<?php
$JobDefaults_add->showMessage();
?>
<form name="fJobDefaultsadd" id="fJobDefaultsadd" class="<?php echo $JobDefaults_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobDefaults">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$JobDefaults_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($JobDefaults_add->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
	<div id="r_JobDefaultType_Idn" class="form-group row">
		<label id="elh_JobDefaults_JobDefaultType_Idn" for="x_JobDefaultType_Idn" class="<?php echo $JobDefaults_add->LeftColumnClass ?>"><?php echo $JobDefaults_add->JobDefaultType_Idn->caption() ?><?php echo $JobDefaults_add->JobDefaultType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_add->RightColumnClass ?>"><div <?php echo $JobDefaults_add->JobDefaultType_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_JobDefaultType_Idn">
<?php $JobDefaults_add->JobDefaultType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_JobDefaultType_Idn" data-value-separator="<?php echo $JobDefaults_add->JobDefaultType_Idn->displayValueSeparatorAttribute() ?>" id="x_JobDefaultType_Idn" name="x_JobDefaultType_Idn"<?php echo $JobDefaults_add->JobDefaultType_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_add->JobDefaultType_Idn->selectOptionListHtml("x_JobDefaultType_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_add->JobDefaultType_Idn->Lookup->getParamTag($JobDefaults_add, "p_x_JobDefaultType_Idn") ?>
</span>
<?php echo $JobDefaults_add->JobDefaultType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_add->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_JobDefaults_Department_Idn" for="x_Department_Idn" class="<?php echo $JobDefaults_add->LeftColumnClass ?>"><?php echo $JobDefaults_add->Department_Idn->caption() ?><?php echo $JobDefaults_add->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_add->RightColumnClass ?>"><div <?php echo $JobDefaults_add->Department_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_Department_Idn" data-value-separator="<?php echo $JobDefaults_add->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $JobDefaults_add->Department_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_add->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_add->Department_Idn->Lookup->getParamTag($JobDefaults_add, "p_x_Department_Idn") ?>
</span>
<?php echo $JobDefaults_add->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_add->ParentJobDefault_Idn->Visible) { // ParentJobDefault_Idn ?>
	<div id="r_ParentJobDefault_Idn" class="form-group row">
		<label id="elh_JobDefaults_ParentJobDefault_Idn" for="x_ParentJobDefault_Idn" class="<?php echo $JobDefaults_add->LeftColumnClass ?>"><?php echo $JobDefaults_add->ParentJobDefault_Idn->caption() ?><?php echo $JobDefaults_add->ParentJobDefault_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_add->RightColumnClass ?>"><div <?php echo $JobDefaults_add->ParentJobDefault_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_ParentJobDefault_Idn">
<input type="text" data-table="JobDefaults" data-field="x_ParentJobDefault_Idn" name="x_ParentJobDefault_Idn" id="x_ParentJobDefault_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_add->ParentJobDefault_Idn->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_add->ParentJobDefault_Idn->EditValue ?>"<?php echo $JobDefaults_add->ParentJobDefault_Idn->editAttributes() ?>>
</span>
<?php echo $JobDefaults_add->ParentJobDefault_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_JobDefaults_Name" for="x_Name" class="<?php echo $JobDefaults_add->LeftColumnClass ?>"><?php echo $JobDefaults_add->Name->caption() ?><?php echo $JobDefaults_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_add->RightColumnClass ?>"><div <?php echo $JobDefaults_add->Name->cellAttributes() ?>>
<span id="el_JobDefaults_Name">
<input type="text" data-table="JobDefaults" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobDefaults_add->Name->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_add->Name->EditValue ?>"<?php echo $JobDefaults_add->Name->editAttributes() ?>>
</span>
<?php echo $JobDefaults_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_add->NumericValue->Visible) { // NumericValue ?>
	<div id="r_NumericValue" class="form-group row">
		<label id="elh_JobDefaults_NumericValue" for="x_NumericValue" class="<?php echo $JobDefaults_add->LeftColumnClass ?>"><?php echo $JobDefaults_add->NumericValue->caption() ?><?php echo $JobDefaults_add->NumericValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_add->RightColumnClass ?>"><div <?php echo $JobDefaults_add->NumericValue->cellAttributes() ?>>
<span id="el_JobDefaults_NumericValue">
<input type="text" data-table="JobDefaults" data-field="x_NumericValue" name="x_NumericValue" id="x_NumericValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($JobDefaults_add->NumericValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_add->NumericValue->EditValue ?>"<?php echo $JobDefaults_add->NumericValue->editAttributes() ?>>
</span>
<?php echo $JobDefaults_add->NumericValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_add->AlphaValue->Visible) { // AlphaValue ?>
	<div id="r_AlphaValue" class="form-group row">
		<label id="elh_JobDefaults_AlphaValue" for="x_AlphaValue" class="<?php echo $JobDefaults_add->LeftColumnClass ?>"><?php echo $JobDefaults_add->AlphaValue->caption() ?><?php echo $JobDefaults_add->AlphaValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_add->RightColumnClass ?>"><div <?php echo $JobDefaults_add->AlphaValue->cellAttributes() ?>>
<span id="el_JobDefaults_AlphaValue">
<input type="text" data-table="JobDefaults" data-field="x_AlphaValue" name="x_AlphaValue" id="x_AlphaValue" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($JobDefaults_add->AlphaValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_add->AlphaValue->EditValue ?>"<?php echo $JobDefaults_add->AlphaValue->editAttributes() ?>>
</span>
<?php echo $JobDefaults_add->AlphaValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_add->LoadFromJobDefault_Idn->Visible) { // LoadFromJobDefault_Idn ?>
	<div id="r_LoadFromJobDefault_Idn" class="form-group row">
		<label id="elh_JobDefaults_LoadFromJobDefault_Idn" for="x_LoadFromJobDefault_Idn" class="<?php echo $JobDefaults_add->LeftColumnClass ?>"><?php echo $JobDefaults_add->LoadFromJobDefault_Idn->caption() ?><?php echo $JobDefaults_add->LoadFromJobDefault_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_add->RightColumnClass ?>"><div <?php echo $JobDefaults_add->LoadFromJobDefault_Idn->cellAttributes() ?>>
<span id="el_JobDefaults_LoadFromJobDefault_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_LoadFromJobDefault_Idn" data-value-separator="<?php echo $JobDefaults_add->LoadFromJobDefault_Idn->displayValueSeparatorAttribute() ?>" id="x_LoadFromJobDefault_Idn" name="x_LoadFromJobDefault_Idn"<?php echo $JobDefaults_add->LoadFromJobDefault_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_add->LoadFromJobDefault_Idn->selectOptionListHtml("x_LoadFromJobDefault_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_add->LoadFromJobDefault_Idn->Lookup->getParamTag($JobDefaults_add, "p_x_LoadFromJobDefault_Idn") ?>
</span>
<?php echo $JobDefaults_add->LoadFromJobDefault_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_JobDefaults_Rank" for="x_Rank" class="<?php echo $JobDefaults_add->LeftColumnClass ?>"><?php echo $JobDefaults_add->Rank->caption() ?><?php echo $JobDefaults_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_add->RightColumnClass ?>"><div <?php echo $JobDefaults_add->Rank->cellAttributes() ?>>
<span id="el_JobDefaults_Rank">
<input type="text" data-table="JobDefaults" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_add->Rank->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_add->Rank->EditValue ?>"<?php echo $JobDefaults_add->Rank->editAttributes() ?>>
</span>
<?php echo $JobDefaults_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaults_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_JobDefaults_ActiveFlag" class="<?php echo $JobDefaults_add->LeftColumnClass ?>"><?php echo $JobDefaults_add->ActiveFlag->caption() ?><?php echo $JobDefaults_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaults_add->RightColumnClass ?>"><div <?php echo $JobDefaults_add->ActiveFlag->cellAttributes() ?>>
<span id="el_JobDefaults_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobDefaults_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobDefaults" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_564122" value="1"<?php echo $selwrk ?><?php echo $JobDefaults_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_564122"></label>
</div>
</span>
<?php echo $JobDefaults_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$JobDefaults_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $JobDefaults_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobDefaults_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$JobDefaults_add->showPageFooter();
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
$JobDefaults_add->terminate();
?>