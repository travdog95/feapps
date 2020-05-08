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
$AdjustmentSubFactors_edit = new AdjustmentSubFactors_edit();

// Run the page
$AdjustmentSubFactors_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AdjustmentSubFactors_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fAdjustmentSubFactorsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fAdjustmentSubFactorsedit = currentForm = new ew.Form("fAdjustmentSubFactorsedit", "edit");

	// Validate form
	fAdjustmentSubFactorsedit.validate = function() {
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
			<?php if ($AdjustmentSubFactors_edit->AdjustmentSubFactor_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_AdjustmentSubFactor_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_edit->AdjustmentSubFactor_Idn->caption(), $AdjustmentSubFactors_edit->AdjustmentSubFactor_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_edit->AdjustmentFactor_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_AdjustmentFactor_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->caption(), $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_edit->Name->caption(), $AdjustmentSubFactors_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_edit->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_edit->Value->caption(), $AdjustmentSubFactors_edit->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($AdjustmentSubFactors_edit->Value->errorMessage()) ?>");
			<?php if ($AdjustmentSubFactors_edit->LaborClass_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LaborClass_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_edit->LaborClass_Idn->caption(), $AdjustmentSubFactors_edit->LaborClass_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_edit->Rank->caption(), $AdjustmentSubFactors_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($AdjustmentSubFactors_edit->Rank->errorMessage()) ?>");
			<?php if ($AdjustmentSubFactors_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_edit->ActiveFlag->caption(), $AdjustmentSubFactors_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fAdjustmentSubFactorsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fAdjustmentSubFactorsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fAdjustmentSubFactorsedit.lists["x_AdjustmentFactor_Idn"] = <?php echo $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->Lookup->toClientList($AdjustmentSubFactors_edit) ?>;
	fAdjustmentSubFactorsedit.lists["x_AdjustmentFactor_Idn"].options = <?php echo JsonEncode($AdjustmentSubFactors_edit->AdjustmentFactor_Idn->lookupOptions()) ?>;
	fAdjustmentSubFactorsedit.lists["x_LaborClass_Idn"] = <?php echo $AdjustmentSubFactors_edit->LaborClass_Idn->Lookup->toClientList($AdjustmentSubFactors_edit) ?>;
	fAdjustmentSubFactorsedit.lists["x_LaborClass_Idn"].options = <?php echo JsonEncode($AdjustmentSubFactors_edit->LaborClass_Idn->lookupOptions()) ?>;
	fAdjustmentSubFactorsedit.lists["x_ActiveFlag[]"] = <?php echo $AdjustmentSubFactors_edit->ActiveFlag->Lookup->toClientList($AdjustmentSubFactors_edit) ?>;
	fAdjustmentSubFactorsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($AdjustmentSubFactors_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fAdjustmentSubFactorsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $AdjustmentSubFactors_edit->showPageHeader(); ?>
<?php
$AdjustmentSubFactors_edit->showMessage();
?>
<?php if (!$AdjustmentSubFactors_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $AdjustmentSubFactors_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fAdjustmentSubFactorsedit" id="fAdjustmentSubFactorsedit" class="<?php echo $AdjustmentSubFactors_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AdjustmentSubFactors">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$AdjustmentSubFactors_edit->IsModal ?>">
<?php if ($AdjustmentSubFactors->getCurrentMasterTable() == "AdjustmentFactors") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="AdjustmentFactors">
<input type="hidden" name="fk_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_edit->AdjustmentFactor_Idn->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($AdjustmentSubFactors_edit->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
	<div id="r_AdjustmentSubFactor_Idn" class="form-group row">
		<label id="elh_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="<?php echo $AdjustmentSubFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_edit->AdjustmentSubFactor_Idn->caption() ?><?php echo $AdjustmentSubFactors_edit->AdjustmentSubFactor_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_edit->AdjustmentSubFactor_Idn->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_AdjustmentSubFactor_Idn">
<span<?php echo $AdjustmentSubFactors_edit->AdjustmentSubFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_edit->AdjustmentSubFactor_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="x_AdjustmentSubFactor_Idn" id="x_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_edit->AdjustmentSubFactor_Idn->CurrentValue) ?>">
<?php echo $AdjustmentSubFactors_edit->AdjustmentSubFactor_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentSubFactors_edit->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
	<div id="r_AdjustmentFactor_Idn" class="form-group row">
		<label id="elh_AdjustmentSubFactors_AdjustmentFactor_Idn" for="x_AdjustmentFactor_Idn" class="<?php echo $AdjustmentSubFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->caption() ?><?php echo $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors_edit->AdjustmentFactor_Idn->getSessionValue() != "") { ?>
<span id="el_AdjustmentSubFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_edit->AdjustmentFactor_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_AdjustmentFactor_Idn" name="x_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_edit->AdjustmentFactor_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el_AdjustmentSubFactors_AdjustmentFactor_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x_AdjustmentFactor_Idn" name="x_AdjustmentFactor_Idn"<?php echo $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->selectOptionListHtml("x_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->Lookup->getParamTag($AdjustmentSubFactors_edit, "p_x_AdjustmentFactor_Idn") ?>
</span>
<?php } ?>
<?php echo $AdjustmentSubFactors_edit->AdjustmentFactor_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentSubFactors_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_AdjustmentSubFactors_Name" for="x_Name" class="<?php echo $AdjustmentSubFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_edit->Name->caption() ?><?php echo $AdjustmentSubFactors_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_edit->Name->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_Name">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_edit->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_edit->Name->EditValue ?>"<?php echo $AdjustmentSubFactors_edit->Name->editAttributes() ?>>
</span>
<?php echo $AdjustmentSubFactors_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentSubFactors_edit->Value->Visible) { // Value ?>
	<div id="r_Value" class="form-group row">
		<label id="elh_AdjustmentSubFactors_Value" for="x_Value" class="<?php echo $AdjustmentSubFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_edit->Value->caption() ?><?php echo $AdjustmentSubFactors_edit->Value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_edit->Value->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_Value">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Value" name="x_Value" id="x_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_edit->Value->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_edit->Value->EditValue ?>"<?php echo $AdjustmentSubFactors_edit->Value->editAttributes() ?>>
</span>
<?php echo $AdjustmentSubFactors_edit->Value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentSubFactors_edit->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
	<div id="r_LaborClass_Idn" class="form-group row">
		<label id="elh_AdjustmentSubFactors_LaborClass_Idn" for="x_LaborClass_Idn" class="<?php echo $AdjustmentSubFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_edit->LaborClass_Idn->caption() ?><?php echo $AdjustmentSubFactors_edit->LaborClass_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_edit->LaborClass_Idn->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_LaborClass_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_edit->LaborClass_Idn->displayValueSeparatorAttribute() ?>" id="x_LaborClass_Idn" name="x_LaborClass_Idn"<?php echo $AdjustmentSubFactors_edit->LaborClass_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_edit->LaborClass_Idn->selectOptionListHtml("x_LaborClass_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_edit->LaborClass_Idn->Lookup->getParamTag($AdjustmentSubFactors_edit, "p_x_LaborClass_Idn") ?>
</span>
<?php echo $AdjustmentSubFactors_edit->LaborClass_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentSubFactors_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_AdjustmentSubFactors_Rank" for="x_Rank" class="<?php echo $AdjustmentSubFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_edit->Rank->caption() ?><?php echo $AdjustmentSubFactors_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_edit->Rank->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_Rank">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_edit->Rank->EditValue ?>"<?php echo $AdjustmentSubFactors_edit->Rank->editAttributes() ?>>
</span>
<?php echo $AdjustmentSubFactors_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentSubFactors_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_AdjustmentSubFactors_ActiveFlag" class="<?php echo $AdjustmentSubFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_edit->ActiveFlag->caption() ?><?php echo $AdjustmentSubFactors_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_ActiveFlag">
<?php
$selwrk = ConvertToBool($AdjustmentSubFactors_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_298844" value="1"<?php echo $selwrk ?><?php echo $AdjustmentSubFactors_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_298844"></label>
</div>
</span>
<?php echo $AdjustmentSubFactors_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$AdjustmentSubFactors_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $AdjustmentSubFactors_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $AdjustmentSubFactors_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$AdjustmentSubFactors_edit->IsModal) { ?>
<?php echo $AdjustmentSubFactors_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$AdjustmentSubFactors_edit->showPageFooter();
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
$AdjustmentSubFactors_edit->terminate();
?>