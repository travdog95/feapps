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
$BondRates_edit = new BondRates_edit();

// Run the page
$BondRates_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$BondRates_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fBondRatesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fBondRatesedit = currentForm = new ew.Form("fBondRatesedit", "edit");

	// Validate form
	fBondRatesedit.validate = function() {
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
			<?php if ($BondRates_edit->BondRate_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_BondRate_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_edit->BondRate_Idn->caption(), $BondRates_edit->BondRate_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($BondRates_edit->StartValue->Required) { ?>
				elm = this.getElements("x" + infix + "_StartValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_edit->StartValue->caption(), $BondRates_edit->StartValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_edit->StartValue->errorMessage()) ?>");
			<?php if ($BondRates_edit->EndValue->Required) { ?>
				elm = this.getElements("x" + infix + "_EndValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_edit->EndValue->caption(), $BondRates_edit->EndValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_edit->EndValue->errorMessage()) ?>");
			<?php if ($BondRates_edit->Minimum->Required) { ?>
				elm = this.getElements("x" + infix + "_Minimum");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_edit->Minimum->caption(), $BondRates_edit->Minimum->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Minimum");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_edit->Minimum->errorMessage()) ?>");
			<?php if ($BondRates_edit->Rate->Required) { ?>
				elm = this.getElements("x" + infix + "_Rate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_edit->Rate->caption(), $BondRates_edit->Rate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_edit->Rate->errorMessage()) ?>");
			<?php if ($BondRates_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_edit->Rank->caption(), $BondRates_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_edit->Rank->errorMessage()) ?>");
			<?php if ($BondRates_edit->IsSubcontract->Required) { ?>
				elm = this.getElements("x" + infix + "_IsSubcontract[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_edit->IsSubcontract->caption(), $BondRates_edit->IsSubcontract->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($BondRates_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_edit->ActiveFlag->caption(), $BondRates_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fBondRatesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fBondRatesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fBondRatesedit.lists["x_IsSubcontract[]"] = <?php echo $BondRates_edit->IsSubcontract->Lookup->toClientList($BondRates_edit) ?>;
	fBondRatesedit.lists["x_IsSubcontract[]"].options = <?php echo JsonEncode($BondRates_edit->IsSubcontract->options(FALSE, TRUE)) ?>;
	fBondRatesedit.lists["x_ActiveFlag[]"] = <?php echo $BondRates_edit->ActiveFlag->Lookup->toClientList($BondRates_edit) ?>;
	fBondRatesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($BondRates_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fBondRatesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $BondRates_edit->showPageHeader(); ?>
<?php
$BondRates_edit->showMessage();
?>
<?php if (!$BondRates_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $BondRates_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fBondRatesedit" id="fBondRatesedit" class="<?php echo $BondRates_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="BondRates">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$BondRates_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($BondRates_edit->BondRate_Idn->Visible) { // BondRate_Idn ?>
	<div id="r_BondRate_Idn" class="form-group row">
		<label id="elh_BondRates_BondRate_Idn" class="<?php echo $BondRates_edit->LeftColumnClass ?>"><?php echo $BondRates_edit->BondRate_Idn->caption() ?><?php echo $BondRates_edit->BondRate_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_edit->RightColumnClass ?>"><div <?php echo $BondRates_edit->BondRate_Idn->cellAttributes() ?>>
<span id="el_BondRates_BondRate_Idn">
<span<?php echo $BondRates_edit->BondRate_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($BondRates_edit->BondRate_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="BondRates" data-field="x_BondRate_Idn" name="x_BondRate_Idn" id="x_BondRate_Idn" value="<?php echo HtmlEncode($BondRates_edit->BondRate_Idn->CurrentValue) ?>">
<?php echo $BondRates_edit->BondRate_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_edit->StartValue->Visible) { // StartValue ?>
	<div id="r_StartValue" class="form-group row">
		<label id="elh_BondRates_StartValue" for="x_StartValue" class="<?php echo $BondRates_edit->LeftColumnClass ?>"><?php echo $BondRates_edit->StartValue->caption() ?><?php echo $BondRates_edit->StartValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_edit->RightColumnClass ?>"><div <?php echo $BondRates_edit->StartValue->cellAttributes() ?>>
<span id="el_BondRates_StartValue">
<input type="text" data-table="BondRates" data-field="x_StartValue" name="x_StartValue" id="x_StartValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_edit->StartValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_edit->StartValue->EditValue ?>"<?php echo $BondRates_edit->StartValue->editAttributes() ?>>
</span>
<?php echo $BondRates_edit->StartValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_edit->EndValue->Visible) { // EndValue ?>
	<div id="r_EndValue" class="form-group row">
		<label id="elh_BondRates_EndValue" for="x_EndValue" class="<?php echo $BondRates_edit->LeftColumnClass ?>"><?php echo $BondRates_edit->EndValue->caption() ?><?php echo $BondRates_edit->EndValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_edit->RightColumnClass ?>"><div <?php echo $BondRates_edit->EndValue->cellAttributes() ?>>
<span id="el_BondRates_EndValue">
<input type="text" data-table="BondRates" data-field="x_EndValue" name="x_EndValue" id="x_EndValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_edit->EndValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_edit->EndValue->EditValue ?>"<?php echo $BondRates_edit->EndValue->editAttributes() ?>>
</span>
<?php echo $BondRates_edit->EndValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_edit->Minimum->Visible) { // Minimum ?>
	<div id="r_Minimum" class="form-group row">
		<label id="elh_BondRates_Minimum" for="x_Minimum" class="<?php echo $BondRates_edit->LeftColumnClass ?>"><?php echo $BondRates_edit->Minimum->caption() ?><?php echo $BondRates_edit->Minimum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_edit->RightColumnClass ?>"><div <?php echo $BondRates_edit->Minimum->cellAttributes() ?>>
<span id="el_BondRates_Minimum">
<input type="text" data-table="BondRates" data-field="x_Minimum" name="x_Minimum" id="x_Minimum" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_edit->Minimum->getPlaceHolder()) ?>" value="<?php echo $BondRates_edit->Minimum->EditValue ?>"<?php echo $BondRates_edit->Minimum->editAttributes() ?>>
</span>
<?php echo $BondRates_edit->Minimum->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_edit->Rate->Visible) { // Rate ?>
	<div id="r_Rate" class="form-group row">
		<label id="elh_BondRates_Rate" for="x_Rate" class="<?php echo $BondRates_edit->LeftColumnClass ?>"><?php echo $BondRates_edit->Rate->caption() ?><?php echo $BondRates_edit->Rate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_edit->RightColumnClass ?>"><div <?php echo $BondRates_edit->Rate->cellAttributes() ?>>
<span id="el_BondRates_Rate">
<input type="text" data-table="BondRates" data-field="x_Rate" name="x_Rate" id="x_Rate" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_edit->Rate->getPlaceHolder()) ?>" value="<?php echo $BondRates_edit->Rate->EditValue ?>"<?php echo $BondRates_edit->Rate->editAttributes() ?>>
</span>
<?php echo $BondRates_edit->Rate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_BondRates_Rank" for="x_Rank" class="<?php echo $BondRates_edit->LeftColumnClass ?>"><?php echo $BondRates_edit->Rank->caption() ?><?php echo $BondRates_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_edit->RightColumnClass ?>"><div <?php echo $BondRates_edit->Rank->cellAttributes() ?>>
<span id="el_BondRates_Rank">
<input type="text" data-table="BondRates" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BondRates_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $BondRates_edit->Rank->EditValue ?>"<?php echo $BondRates_edit->Rank->editAttributes() ?>>
</span>
<?php echo $BondRates_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_edit->IsSubcontract->Visible) { // IsSubcontract ?>
	<div id="r_IsSubcontract" class="form-group row">
		<label id="elh_BondRates_IsSubcontract" class="<?php echo $BondRates_edit->LeftColumnClass ?>"><?php echo $BondRates_edit->IsSubcontract->caption() ?><?php echo $BondRates_edit->IsSubcontract->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_edit->RightColumnClass ?>"><div <?php echo $BondRates_edit->IsSubcontract->cellAttributes() ?>>
<span id="el_BondRates_IsSubcontract">
<?php
$selwrk = ConvertToBool($BondRates_edit->IsSubcontract->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_IsSubcontract" name="x_IsSubcontract[]" id="x_IsSubcontract[]_796610" value="1"<?php echo $selwrk ?><?php echo $BondRates_edit->IsSubcontract->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsSubcontract[]_796610"></label>
</div>
</span>
<?php echo $BondRates_edit->IsSubcontract->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($BondRates_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_BondRates_ActiveFlag" class="<?php echo $BondRates_edit->LeftColumnClass ?>"><?php echo $BondRates_edit->ActiveFlag->caption() ?><?php echo $BondRates_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $BondRates_edit->RightColumnClass ?>"><div <?php echo $BondRates_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_BondRates_ActiveFlag">
<?php
$selwrk = ConvertToBool($BondRates_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_944576" value="1"<?php echo $selwrk ?><?php echo $BondRates_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_944576"></label>
</div>
</span>
<?php echo $BondRates_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$BondRates_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $BondRates_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $BondRates_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$BondRates_edit->IsModal) { ?>
<?php echo $BondRates_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$BondRates_edit->showPageFooter();
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
$BondRates_edit->terminate();
?>