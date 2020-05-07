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
$ProductSizes_edit = new ProductSizes_edit();

// Run the page
$ProductSizes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ProductSizes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fProductSizesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fProductSizesedit = currentForm = new ew.Form("fProductSizesedit", "edit");

	// Validate form
	fProductSizesedit.validate = function() {
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
			<?php if ($ProductSizes_edit->ProductSize_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductSize_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_edit->ProductSize_Idn->caption(), $ProductSizes_edit->ProductSize_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ProductSizes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_edit->Name->caption(), $ProductSizes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ProductSizes_edit->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_edit->Value->caption(), $ProductSizes_edit->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ProductSizes_edit->Value->errorMessage()) ?>");
			<?php if ($ProductSizes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_edit->Rank->caption(), $ProductSizes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ProductSizes_edit->Rank->errorMessage()) ?>");
			<?php if ($ProductSizes_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_edit->Department_Idn->caption(), $ProductSizes_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ProductSizes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_edit->ActiveFlag->caption(), $ProductSizes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fProductSizesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fProductSizesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fProductSizesedit.lists["x_Department_Idn"] = <?php echo $ProductSizes_edit->Department_Idn->Lookup->toClientList($ProductSizes_edit) ?>;
	fProductSizesedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($ProductSizes_edit->Department_Idn->lookupOptions()) ?>;
	fProductSizesedit.lists["x_ActiveFlag[]"] = <?php echo $ProductSizes_edit->ActiveFlag->Lookup->toClientList($ProductSizes_edit) ?>;
	fProductSizesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ProductSizes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fProductSizesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ProductSizes_edit->showPageHeader(); ?>
<?php
$ProductSizes_edit->showMessage();
?>
<?php if (!$ProductSizes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ProductSizes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fProductSizesedit" id="fProductSizesedit" class="<?php echo $ProductSizes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ProductSizes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ProductSizes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ProductSizes_edit->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
	<div id="r_ProductSize_Idn" class="form-group row">
		<label id="elh_ProductSizes_ProductSize_Idn" class="<?php echo $ProductSizes_edit->LeftColumnClass ?>"><?php echo $ProductSizes_edit->ProductSize_Idn->caption() ?><?php echo $ProductSizes_edit->ProductSize_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ProductSizes_edit->RightColumnClass ?>"><div <?php echo $ProductSizes_edit->ProductSize_Idn->cellAttributes() ?>>
<span id="el_ProductSizes_ProductSize_Idn">
<span<?php echo $ProductSizes_edit->ProductSize_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ProductSizes_edit->ProductSize_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_ProductSize_Idn" name="x_ProductSize_Idn" id="x_ProductSize_Idn" value="<?php echo HtmlEncode($ProductSizes_edit->ProductSize_Idn->CurrentValue) ?>">
<?php echo $ProductSizes_edit->ProductSize_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ProductSizes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_ProductSizes_Name" for="x_Name" class="<?php echo $ProductSizes_edit->LeftColumnClass ?>"><?php echo $ProductSizes_edit->Name->caption() ?><?php echo $ProductSizes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ProductSizes_edit->RightColumnClass ?>"><div <?php echo $ProductSizes_edit->Name->cellAttributes() ?>>
<span id="el_ProductSizes_Name">
<input type="text" data-table="ProductSizes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ProductSizes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_edit->Name->EditValue ?>"<?php echo $ProductSizes_edit->Name->editAttributes() ?>>
</span>
<?php echo $ProductSizes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ProductSizes_edit->Value->Visible) { // Value ?>
	<div id="r_Value" class="form-group row">
		<label id="elh_ProductSizes_Value" for="x_Value" class="<?php echo $ProductSizes_edit->LeftColumnClass ?>"><?php echo $ProductSizes_edit->Value->caption() ?><?php echo $ProductSizes_edit->Value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ProductSizes_edit->RightColumnClass ?>"><div <?php echo $ProductSizes_edit->Value->cellAttributes() ?>>
<span id="el_ProductSizes_Value">
<input type="text" data-table="ProductSizes" data-field="x_Value" name="x_Value" id="x_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ProductSizes_edit->Value->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_edit->Value->EditValue ?>"<?php echo $ProductSizes_edit->Value->editAttributes() ?>>
</span>
<?php echo $ProductSizes_edit->Value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ProductSizes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_ProductSizes_Rank" for="x_Rank" class="<?php echo $ProductSizes_edit->LeftColumnClass ?>"><?php echo $ProductSizes_edit->Rank->caption() ?><?php echo $ProductSizes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ProductSizes_edit->RightColumnClass ?>"><div <?php echo $ProductSizes_edit->Rank->cellAttributes() ?>>
<span id="el_ProductSizes_Rank">
<input type="text" data-table="ProductSizes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ProductSizes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_edit->Rank->EditValue ?>"<?php echo $ProductSizes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $ProductSizes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ProductSizes_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_ProductSizes_Department_Idn" for="x_Department_Idn" class="<?php echo $ProductSizes_edit->LeftColumnClass ?>"><?php echo $ProductSizes_edit->Department_Idn->caption() ?><?php echo $ProductSizes_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ProductSizes_edit->RightColumnClass ?>"><div <?php echo $ProductSizes_edit->Department_Idn->cellAttributes() ?>>
<span id="el_ProductSizes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ProductSizes" data-field="x_Department_Idn" data-value-separator="<?php echo $ProductSizes_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $ProductSizes_edit->Department_Idn->editAttributes() ?>>
			<?php echo $ProductSizes_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $ProductSizes_edit->Department_Idn->Lookup->getParamTag($ProductSizes_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $ProductSizes_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ProductSizes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_ProductSizes_ActiveFlag" class="<?php echo $ProductSizes_edit->LeftColumnClass ?>"><?php echo $ProductSizes_edit->ActiveFlag->caption() ?><?php echo $ProductSizes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ProductSizes_edit->RightColumnClass ?>"><div <?php echo $ProductSizes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_ProductSizes_ActiveFlag">
<?php
$selwrk = ConvertToBool($ProductSizes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ProductSizes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_164929" value="1"<?php echo $selwrk ?><?php echo $ProductSizes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_164929"></label>
</div>
</span>
<?php echo $ProductSizes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ProductSizes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ProductSizes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ProductSizes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ProductSizes_edit->IsModal) { ?>
<?php echo $ProductSizes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ProductSizes_edit->showPageFooter();
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
$ProductSizes_edit->terminate();
?>