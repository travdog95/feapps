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
$BondRates_add = new BondRates_add();

// Run the page
$BondRates_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$BondRates_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fBondRatesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fBondRatesadd = currentForm = new ew.Form("fBondRatesadd", "add");

	// Validate form
	fBondRatesadd.validate = function() {
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
			<?php if ($BondRates_add->StartValue->Required) { ?>
				elm = this.getElements("x" + infix + "_StartValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_add->StartValue->caption(), $BondRates_add->StartValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_add->StartValue->errorMessage()) ?>");
			<?php if ($BondRates_add->EndValue->Required) { ?>
				elm = this.getElements("x" + infix + "_EndValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_add->EndValue->caption(), $BondRates_add->EndValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_add->EndValue->errorMessage()) ?>");
			<?php if ($BondRates_add->Minimum->Required) { ?>
				elm = this.getElements("x" + infix + "_Minimum");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_add->Minimum->caption(), $BondRates_add->Minimum->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Minimum");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_add->Minimum->errorMessage()) ?>");
			<?php if ($BondRates_add->Rate->Required) { ?>
				elm = this.getElements("x" + infix + "_Rate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_add->Rate->caption(), $BondRates_add->Rate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_add->Rate->errorMessage()) ?>");
			<?php if ($BondRates_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_add->Rank->caption(), $BondRates_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_add->Rank->errorMessage()) ?>");
			<?php if ($BondRates_add->IsSubcontract->Required) { ?>
				elm = this.getElements("x" + infix + "_IsSubcontract[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_add->IsSubcontract->caption(), $BondRates_add->IsSubcontract->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($BondRates_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_add->ActiveFlag->caption(), $BondRates_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fBondRatesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fBondRatesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fBondRatesadd.lists["x_IsSubcontract[]"] = <?php echo $BondRates_add->IsSubcontract->Lookup->toClientList($BondRates_add) ?>;
	fBondRatesadd.lists["x_IsSubcontract[]"].options = <?php echo JsonEncode($BondRates_add->IsSubcontract->options(FALSE, TRUE)) ?>;
	fBondRatesadd.lists["x_ActiveFlag[]"] = <?php echo $BondRates_add->ActiveFlag->Lookup->toClientList($BondRates_add) ?>;
	fBondRatesadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($BondRates_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fBondRatesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $BondRates_add->showPageHeader(); ?>
<?php
$BondRates_add->showMessage();
?>
<form name="fBondRatesadd" id="fBondRatesadd" class="<?php echo $BondRates_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="BondRates">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$BondRates_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($BondRates_add->StartValue->Visible) { // StartValue ?>
	<div id="r_StartValue" class="form-group row">
		<label id="elh_BondRates_StartValue" for="x_StartValue" class="<?php echo $BondRates_add->LeftColumnClass ?>"><?php echo $BondRates_add->StartValue->caption() ?><?php echo $BondRates_add->StartValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_add->RightColumnClass ?>"><div <?php echo $BondRates_add->StartValue->cellAttributes() ?>>
<span id="el_BondRates_StartValue">
<input type="text" data-table="BondRates" data-field="x_StartValue" name="x_StartValue" id="x_StartValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_add->StartValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_add->StartValue->EditValue ?>"<?php echo $BondRates_add->StartValue->editAttributes() ?>>
</span>
<?php echo $BondRates_add->StartValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_add->EndValue->Visible) { // EndValue ?>
	<div id="r_EndValue" class="form-group row">
		<label id="elh_BondRates_EndValue" for="x_EndValue" class="<?php echo $BondRates_add->LeftColumnClass ?>"><?php echo $BondRates_add->EndValue->caption() ?><?php echo $BondRates_add->EndValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_add->RightColumnClass ?>"><div <?php echo $BondRates_add->EndValue->cellAttributes() ?>>
<span id="el_BondRates_EndValue">
<input type="text" data-table="BondRates" data-field="x_EndValue" name="x_EndValue" id="x_EndValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_add->EndValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_add->EndValue->EditValue ?>"<?php echo $BondRates_add->EndValue->editAttributes() ?>>
</span>
<?php echo $BondRates_add->EndValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_add->Minimum->Visible) { // Minimum ?>
	<div id="r_Minimum" class="form-group row">
		<label id="elh_BondRates_Minimum" for="x_Minimum" class="<?php echo $BondRates_add->LeftColumnClass ?>"><?php echo $BondRates_add->Minimum->caption() ?><?php echo $BondRates_add->Minimum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_add->RightColumnClass ?>"><div <?php echo $BondRates_add->Minimum->cellAttributes() ?>>
<span id="el_BondRates_Minimum">
<input type="text" data-table="BondRates" data-field="x_Minimum" name="x_Minimum" id="x_Minimum" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_add->Minimum->getPlaceHolder()) ?>" value="<?php echo $BondRates_add->Minimum->EditValue ?>"<?php echo $BondRates_add->Minimum->editAttributes() ?>>
</span>
<?php echo $BondRates_add->Minimum->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_add->Rate->Visible) { // Rate ?>
	<div id="r_Rate" class="form-group row">
		<label id="elh_BondRates_Rate" for="x_Rate" class="<?php echo $BondRates_add->LeftColumnClass ?>"><?php echo $BondRates_add->Rate->caption() ?><?php echo $BondRates_add->Rate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_add->RightColumnClass ?>"><div <?php echo $BondRates_add->Rate->cellAttributes() ?>>
<span id="el_BondRates_Rate">
<input type="text" data-table="BondRates" data-field="x_Rate" name="x_Rate" id="x_Rate" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_add->Rate->getPlaceHolder()) ?>" value="<?php echo $BondRates_add->Rate->EditValue ?>"<?php echo $BondRates_add->Rate->editAttributes() ?>>
</span>
<?php echo $BondRates_add->Rate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_BondRates_Rank" for="x_Rank" class="<?php echo $BondRates_add->LeftColumnClass ?>"><?php echo $BondRates_add->Rank->caption() ?><?php echo $BondRates_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_add->RightColumnClass ?>"><div <?php echo $BondRates_add->Rank->cellAttributes() ?>>
<span id="el_BondRates_Rank">
<input type="text" data-table="BondRates" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BondRates_add->Rank->getPlaceHolder()) ?>" value="<?php echo $BondRates_add->Rank->EditValue ?>"<?php echo $BondRates_add->Rank->editAttributes() ?>>
</span>
<?php echo $BondRates_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_add->IsSubcontract->Visible) { // IsSubcontract ?>
	<div id="r_IsSubcontract" class="form-group row">
		<label id="elh_BondRates_IsSubcontract" class="<?php echo $BondRates_add->LeftColumnClass ?>"><?php echo $BondRates_add->IsSubcontract->caption() ?><?php echo $BondRates_add->IsSubcontract->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_add->RightColumnClass ?>"><div <?php echo $BondRates_add->IsSubcontract->cellAttributes() ?>>
<span id="el_BondRates_IsSubcontract">
<?php
$selwrk = ConvertToBool($BondRates_add->IsSubcontract->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_IsSubcontract" name="x_IsSubcontract[]" id="x_IsSubcontract[]_276473" value="1"<?php echo $selwrk ?><?php echo $BondRates_add->IsSubcontract->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsSubcontract[]_276473"></label>
</div>
</span>
<?php echo $BondRates_add->IsSubcontract->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_BondRates_ActiveFlag" class="<?php echo $BondRates_add->LeftColumnClass ?>"><?php echo $BondRates_add->ActiveFlag->caption() ?><?php echo $BondRates_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_add->RightColumnClass ?>"><div <?php echo $BondRates_add->ActiveFlag->cellAttributes() ?>>
<span id="el_BondRates_ActiveFlag">
<?php
$selwrk = ConvertToBool($BondRates_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_160869" value="1"<?php echo $selwrk ?><?php echo $BondRates_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_160869"></label>
</div>
</span>
<?php echo $BondRates_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$BondRates_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $BondRates_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $BondRates_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$BondRates_add->showPageFooter();
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
$BondRates_add->terminate();
?>