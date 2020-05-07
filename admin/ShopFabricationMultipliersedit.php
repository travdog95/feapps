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
$ShopFabricationMultipliers_edit = new ShopFabricationMultipliers_edit();

// Run the page
$ShopFabricationMultipliers_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ShopFabricationMultipliers_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fShopFabricationMultipliersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fShopFabricationMultipliersedit = currentForm = new ew.Form("fShopFabricationMultipliersedit", "edit");

	// Validate form
	fShopFabricationMultipliersedit.validate = function() {
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
			<?php if ($ShopFabricationMultipliers_edit->ShopFabricationMultiplier_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ShopFabricationMultiplier_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabricationMultipliers_edit->ShopFabricationMultiplier_Idn->caption(), $ShopFabricationMultipliers_edit->ShopFabricationMultiplier_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ShopFabricationMultipliers_edit->PipeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PipeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabricationMultipliers_edit->PipeType_Idn->caption(), $ShopFabricationMultipliers_edit->PipeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ShopFabricationMultipliers_edit->Multiplier->Required) { ?>
				elm = this.getElements("x" + infix + "_Multiplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabricationMultipliers_edit->Multiplier->caption(), $ShopFabricationMultipliers_edit->Multiplier->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Multiplier");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ShopFabricationMultipliers_edit->Multiplier->errorMessage()) ?>");
			<?php if ($ShopFabricationMultipliers_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabricationMultipliers_edit->ActiveFlag->caption(), $ShopFabricationMultipliers_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fShopFabricationMultipliersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fShopFabricationMultipliersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fShopFabricationMultipliersedit.lists["x_PipeType_Idn"] = <?php echo $ShopFabricationMultipliers_edit->PipeType_Idn->Lookup->toClientList($ShopFabricationMultipliers_edit) ?>;
	fShopFabricationMultipliersedit.lists["x_PipeType_Idn"].options = <?php echo JsonEncode($ShopFabricationMultipliers_edit->PipeType_Idn->lookupOptions()) ?>;
	fShopFabricationMultipliersedit.lists["x_ActiveFlag[]"] = <?php echo $ShopFabricationMultipliers_edit->ActiveFlag->Lookup->toClientList($ShopFabricationMultipliers_edit) ?>;
	fShopFabricationMultipliersedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ShopFabricationMultipliers_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fShopFabricationMultipliersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ShopFabricationMultipliers_edit->showPageHeader(); ?>
<?php
$ShopFabricationMultipliers_edit->showMessage();
?>
<?php if (!$ShopFabricationMultipliers_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ShopFabricationMultipliers_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fShopFabricationMultipliersedit" id="fShopFabricationMultipliersedit" class="<?php echo $ShopFabricationMultipliers_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ShopFabricationMultipliers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ShopFabricationMultipliers_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ShopFabricationMultipliers_edit->ShopFabricationMultiplier_Idn->Visible) { // ShopFabricationMultiplier_Idn ?>
	<div id="r_ShopFabricationMultiplier_Idn" class="form-group row">
		<label id="elh_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn" class="<?php echo $ShopFabricationMultipliers_edit->LeftColumnClass ?>"><?php echo $ShopFabricationMultipliers_edit->ShopFabricationMultiplier_Idn->caption() ?><?php echo $ShopFabricationMultipliers_edit->ShopFabricationMultiplier_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ShopFabricationMultipliers_edit->RightColumnClass ?>"><div <?php echo $ShopFabricationMultipliers_edit->ShopFabricationMultiplier_Idn->cellAttributes() ?>>
<span id="el_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn">
<span<?php echo $ShopFabricationMultipliers_edit->ShopFabricationMultiplier_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ShopFabricationMultipliers_edit->ShopFabricationMultiplier_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_ShopFabricationMultiplier_Idn" name="x_ShopFabricationMultiplier_Idn" id="x_ShopFabricationMultiplier_Idn" value="<?php echo HtmlEncode($ShopFabricationMultipliers_edit->ShopFabricationMultiplier_Idn->CurrentValue) ?>">
<?php echo $ShopFabricationMultipliers_edit->ShopFabricationMultiplier_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ShopFabricationMultipliers_edit->PipeType_Idn->Visible) { // PipeType_Idn ?>
	<div id="r_PipeType_Idn" class="form-group row">
		<label id="elh_ShopFabricationMultipliers_PipeType_Idn" for="x_PipeType_Idn" class="<?php echo $ShopFabricationMultipliers_edit->LeftColumnClass ?>"><?php echo $ShopFabricationMultipliers_edit->PipeType_Idn->caption() ?><?php echo $ShopFabricationMultipliers_edit->PipeType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ShopFabricationMultipliers_edit->RightColumnClass ?>"><div <?php echo $ShopFabricationMultipliers_edit->PipeType_Idn->cellAttributes() ?>>
<span id="el_ShopFabricationMultipliers_PipeType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ShopFabricationMultipliers" data-field="x_PipeType_Idn" data-value-separator="<?php echo $ShopFabricationMultipliers_edit->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x_PipeType_Idn" name="x_PipeType_Idn"<?php echo $ShopFabricationMultipliers_edit->PipeType_Idn->editAttributes() ?>>
			<?php echo $ShopFabricationMultipliers_edit->PipeType_Idn->selectOptionListHtml("x_PipeType_Idn") ?>
		</select>
</div>
<?php echo $ShopFabricationMultipliers_edit->PipeType_Idn->Lookup->getParamTag($ShopFabricationMultipliers_edit, "p_x_PipeType_Idn") ?>
</span>
<?php echo $ShopFabricationMultipliers_edit->PipeType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ShopFabricationMultipliers_edit->Multiplier->Visible) { // Multiplier ?>
	<div id="r_Multiplier" class="form-group row">
		<label id="elh_ShopFabricationMultipliers_Multiplier" for="x_Multiplier" class="<?php echo $ShopFabricationMultipliers_edit->LeftColumnClass ?>"><?php echo $ShopFabricationMultipliers_edit->Multiplier->caption() ?><?php echo $ShopFabricationMultipliers_edit->Multiplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ShopFabricationMultipliers_edit->RightColumnClass ?>"><div <?php echo $ShopFabricationMultipliers_edit->Multiplier->cellAttributes() ?>>
<span id="el_ShopFabricationMultipliers_Multiplier">
<input type="text" data-table="ShopFabricationMultipliers" data-field="x_Multiplier" name="x_Multiplier" id="x_Multiplier" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ShopFabricationMultipliers_edit->Multiplier->getPlaceHolder()) ?>" value="<?php echo $ShopFabricationMultipliers_edit->Multiplier->EditValue ?>"<?php echo $ShopFabricationMultipliers_edit->Multiplier->editAttributes() ?>>
</span>
<?php echo $ShopFabricationMultipliers_edit->Multiplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ShopFabricationMultipliers_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_ShopFabricationMultipliers_ActiveFlag" class="<?php echo $ShopFabricationMultipliers_edit->LeftColumnClass ?>"><?php echo $ShopFabricationMultipliers_edit->ActiveFlag->caption() ?><?php echo $ShopFabricationMultipliers_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ShopFabricationMultipliers_edit->RightColumnClass ?>"><div <?php echo $ShopFabricationMultipliers_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_ShopFabricationMultipliers_ActiveFlag">
<?php
$selwrk = ConvertToBool($ShopFabricationMultipliers_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ShopFabricationMultipliers" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_470625" value="1"<?php echo $selwrk ?><?php echo $ShopFabricationMultipliers_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_470625"></label>
</div>
</span>
<?php echo $ShopFabricationMultipliers_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ShopFabricationMultipliers_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ShopFabricationMultipliers_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ShopFabricationMultipliers_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ShopFabricationMultipliers_edit->IsModal) { ?>
<?php echo $ShopFabricationMultipliers_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ShopFabricationMultipliers_edit->showPageFooter();
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
$ShopFabricationMultipliers_edit->terminate();
?>