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
$AdjustmentSubFactors_add = new AdjustmentSubFactors_add();

// Run the page
$AdjustmentSubFactors_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AdjustmentSubFactors_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fAdjustmentSubFactorsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fAdjustmentSubFactorsadd = currentForm = new ew.Form("fAdjustmentSubFactorsadd", "add");

	// Validate form
	fAdjustmentSubFactorsadd.validate = function() {
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
			<?php if ($AdjustmentSubFactors_add->AdjustmentFactor_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_AdjustmentFactor_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_add->AdjustmentFactor_Idn->caption(), $AdjustmentSubFactors_add->AdjustmentFactor_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_add->Name->caption(), $AdjustmentSubFactors_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_add->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_add->Value->caption(), $AdjustmentSubFactors_add->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($AdjustmentSubFactors_add->Value->errorMessage()) ?>");
			<?php if ($AdjustmentSubFactors_add->LaborClass_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LaborClass_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_add->LaborClass_Idn->caption(), $AdjustmentSubFactors_add->LaborClass_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_add->Rank->caption(), $AdjustmentSubFactors_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($AdjustmentSubFactors_add->Rank->errorMessage()) ?>");
			<?php if ($AdjustmentSubFactors_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_add->ActiveFlag->caption(), $AdjustmentSubFactors_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fAdjustmentSubFactorsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fAdjustmentSubFactorsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fAdjustmentSubFactorsadd.lists["x_AdjustmentFactor_Idn"] = <?php echo $AdjustmentSubFactors_add->AdjustmentFactor_Idn->Lookup->toClientList($AdjustmentSubFactors_add) ?>;
	fAdjustmentSubFactorsadd.lists["x_AdjustmentFactor_Idn"].options = <?php echo JsonEncode($AdjustmentSubFactors_add->AdjustmentFactor_Idn->lookupOptions()) ?>;
	fAdjustmentSubFactorsadd.lists["x_LaborClass_Idn"] = <?php echo $AdjustmentSubFactors_add->LaborClass_Idn->Lookup->toClientList($AdjustmentSubFactors_add) ?>;
	fAdjustmentSubFactorsadd.lists["x_LaborClass_Idn"].options = <?php echo JsonEncode($AdjustmentSubFactors_add->LaborClass_Idn->lookupOptions()) ?>;
	fAdjustmentSubFactorsadd.lists["x_ActiveFlag[]"] = <?php echo $AdjustmentSubFactors_add->ActiveFlag->Lookup->toClientList($AdjustmentSubFactors_add) ?>;
	fAdjustmentSubFactorsadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($AdjustmentSubFactors_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fAdjustmentSubFactorsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $AdjustmentSubFactors_add->showPageHeader(); ?>
<?php
$AdjustmentSubFactors_add->showMessage();
?>
<form name="fAdjustmentSubFactorsadd" id="fAdjustmentSubFactorsadd" class="<?php echo $AdjustmentSubFactors_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AdjustmentSubFactors">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$AdjustmentSubFactors_add->IsModal ?>">
<?php if ($AdjustmentSubFactors->getCurrentMasterTable() == "AdjustmentFactors") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="AdjustmentFactors">
<input type="hidden" name="fk_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_add->AdjustmentFactor_Idn->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($AdjustmentSubFactors_add->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
	<div id="r_AdjustmentFactor_Idn" class="form-group row">
		<label id="elh_AdjustmentSubFactors_AdjustmentFactor_Idn" for="x_AdjustmentFactor_Idn" class="<?php echo $AdjustmentSubFactors_add->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_add->AdjustmentFactor_Idn->caption() ?><?php echo $AdjustmentSubFactors_add->AdjustmentFactor_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_add->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_add->AdjustmentFactor_Idn->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors_add->AdjustmentFactor_Idn->getSessionValue() != "") { ?>
<span id="el_AdjustmentSubFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentSubFactors_add->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_add->AdjustmentFactor_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_AdjustmentFactor_Idn" name="x_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_add->AdjustmentFactor_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el_AdjustmentSubFactors_AdjustmentFactor_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_add->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x_AdjustmentFactor_Idn" name="x_AdjustmentFactor_Idn"<?php echo $AdjustmentSubFactors_add->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_add->AdjustmentFactor_Idn->selectOptionListHtml("x_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_add->AdjustmentFactor_Idn->Lookup->getParamTag($AdjustmentSubFactors_add, "p_x_AdjustmentFactor_Idn") ?>
</span>
<?php } ?>
<?php echo $AdjustmentSubFactors_add->AdjustmentFactor_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentSubFactors_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_AdjustmentSubFactors_Name" for="x_Name" class="<?php echo $AdjustmentSubFactors_add->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_add->Name->caption() ?><?php echo $AdjustmentSubFactors_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_add->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_add->Name->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_Name">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_add->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_add->Name->EditValue ?>"<?php echo $AdjustmentSubFactors_add->Name->editAttributes() ?>>
</span>
<?php echo $AdjustmentSubFactors_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentSubFactors_add->Value->Visible) { // Value ?>
	<div id="r_Value" class="form-group row">
		<label id="elh_AdjustmentSubFactors_Value" for="x_Value" class="<?php echo $AdjustmentSubFactors_add->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_add->Value->caption() ?><?php echo $AdjustmentSubFactors_add->Value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_add->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_add->Value->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_Value">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Value" name="x_Value" id="x_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_add->Value->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_add->Value->EditValue ?>"<?php echo $AdjustmentSubFactors_add->Value->editAttributes() ?>>
</span>
<?php echo $AdjustmentSubFactors_add->Value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentSubFactors_add->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
	<div id="r_LaborClass_Idn" class="form-group row">
		<label id="elh_AdjustmentSubFactors_LaborClass_Idn" for="x_LaborClass_Idn" class="<?php echo $AdjustmentSubFactors_add->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_add->LaborClass_Idn->caption() ?><?php echo $AdjustmentSubFactors_add->LaborClass_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_add->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_add->LaborClass_Idn->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_LaborClass_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_add->LaborClass_Idn->displayValueSeparatorAttribute() ?>" id="x_LaborClass_Idn" name="x_LaborClass_Idn"<?php echo $AdjustmentSubFactors_add->LaborClass_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_add->LaborClass_Idn->selectOptionListHtml("x_LaborClass_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_add->LaborClass_Idn->Lookup->getParamTag($AdjustmentSubFactors_add, "p_x_LaborClass_Idn") ?>
</span>
<?php echo $AdjustmentSubFactors_add->LaborClass_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentSubFactors_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_AdjustmentSubFactors_Rank" for="x_Rank" class="<?php echo $AdjustmentSubFactors_add->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_add->Rank->caption() ?><?php echo $AdjustmentSubFactors_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_add->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_add->Rank->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_Rank">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_add->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_add->Rank->EditValue ?>"<?php echo $AdjustmentSubFactors_add->Rank->editAttributes() ?>>
</span>
<?php echo $AdjustmentSubFactors_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentSubFactors_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_AdjustmentSubFactors_ActiveFlag" class="<?php echo $AdjustmentSubFactors_add->LeftColumnClass ?>"><?php echo $AdjustmentSubFactors_add->ActiveFlag->caption() ?><?php echo $AdjustmentSubFactors_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentSubFactors_add->RightColumnClass ?>"><div <?php echo $AdjustmentSubFactors_add->ActiveFlag->cellAttributes() ?>>
<span id="el_AdjustmentSubFactors_ActiveFlag">
<?php
$selwrk = ConvertToBool($AdjustmentSubFactors_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_524489" value="1"<?php echo $selwrk ?><?php echo $AdjustmentSubFactors_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_524489"></label>
</div>
</span>
<?php echo $AdjustmentSubFactors_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$AdjustmentSubFactors_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $AdjustmentSubFactors_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $AdjustmentSubFactors_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$AdjustmentSubFactors_add->showPageFooter();
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
$AdjustmentSubFactors_add->terminate();
?>