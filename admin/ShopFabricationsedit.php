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
$ShopFabrications_edit = new ShopFabrications_edit();

// Run the page
$ShopFabrications_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ShopFabrications_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fShopFabricationsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fShopFabricationsedit = currentForm = new ew.Form("fShopFabricationsedit", "edit");

	// Validate form
	fShopFabricationsedit.validate = function() {
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
			<?php if ($ShopFabrications_edit->ShopFabrication_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ShopFabrication_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabrications_edit->ShopFabrication_Idn->caption(), $ShopFabrications_edit->ShopFabrication_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ShopFabrications_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabrications_edit->Name->caption(), $ShopFabrications_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ShopFabrications_edit->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabrications_edit->Value->caption(), $ShopFabrications_edit->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ShopFabrications_edit->Value->errorMessage()) ?>");
			<?php if ($ShopFabrications_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabrications_edit->Rank->caption(), $ShopFabrications_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ShopFabrications_edit->Rank->errorMessage()) ?>");
			<?php if ($ShopFabrications_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabrications_edit->ActiveFlag->caption(), $ShopFabrications_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fShopFabricationsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fShopFabricationsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fShopFabricationsedit.lists["x_ActiveFlag[]"] = <?php echo $ShopFabrications_edit->ActiveFlag->Lookup->toClientList($ShopFabrications_edit) ?>;
	fShopFabricationsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ShopFabrications_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fShopFabricationsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ShopFabrications_edit->showPageHeader(); ?>
<?php
$ShopFabrications_edit->showMessage();
?>
<?php if (!$ShopFabrications_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ShopFabrications_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fShopFabricationsedit" id="fShopFabricationsedit" class="<?php echo $ShopFabrications_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ShopFabrications">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ShopFabrications_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ShopFabrications_edit->ShopFabrication_Idn->Visible) { // ShopFabrication_Idn ?>
	<div id="r_ShopFabrication_Idn" class="form-group row">
		<label id="elh_ShopFabrications_ShopFabrication_Idn" class="<?php echo $ShopFabrications_edit->LeftColumnClass ?>"><?php echo $ShopFabrications_edit->ShopFabrication_Idn->caption() ?><?php echo $ShopFabrications_edit->ShopFabrication_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ShopFabrications_edit->RightColumnClass ?>"><div <?php echo $ShopFabrications_edit->ShopFabrication_Idn->cellAttributes() ?>>
<span id="el_ShopFabrications_ShopFabrication_Idn">
<span<?php echo $ShopFabrications_edit->ShopFabrication_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ShopFabrications_edit->ShopFabrication_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_ShopFabrication_Idn" name="x_ShopFabrication_Idn" id="x_ShopFabrication_Idn" value="<?php echo HtmlEncode($ShopFabrications_edit->ShopFabrication_Idn->CurrentValue) ?>">
<?php echo $ShopFabrications_edit->ShopFabrication_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ShopFabrications_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_ShopFabrications_Name" for="x_Name" class="<?php echo $ShopFabrications_edit->LeftColumnClass ?>"><?php echo $ShopFabrications_edit->Name->caption() ?><?php echo $ShopFabrications_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ShopFabrications_edit->RightColumnClass ?>"><div <?php echo $ShopFabrications_edit->Name->cellAttributes() ?>>
<span id="el_ShopFabrications_Name">
<input type="text" data-table="ShopFabrications" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ShopFabrications_edit->Name->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_edit->Name->EditValue ?>"<?php echo $ShopFabrications_edit->Name->editAttributes() ?>>
</span>
<?php echo $ShopFabrications_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ShopFabrications_edit->Value->Visible) { // Value ?>
	<div id="r_Value" class="form-group row">
		<label id="elh_ShopFabrications_Value" for="x_Value" class="<?php echo $ShopFabrications_edit->LeftColumnClass ?>"><?php echo $ShopFabrications_edit->Value->caption() ?><?php echo $ShopFabrications_edit->Value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ShopFabrications_edit->RightColumnClass ?>"><div <?php echo $ShopFabrications_edit->Value->cellAttributes() ?>>
<span id="el_ShopFabrications_Value">
<input type="text" data-table="ShopFabrications" data-field="x_Value" name="x_Value" id="x_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ShopFabrications_edit->Value->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_edit->Value->EditValue ?>"<?php echo $ShopFabrications_edit->Value->editAttributes() ?>>
</span>
<?php echo $ShopFabrications_edit->Value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ShopFabrications_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_ShopFabrications_Rank" for="x_Rank" class="<?php echo $ShopFabrications_edit->LeftColumnClass ?>"><?php echo $ShopFabrications_edit->Rank->caption() ?><?php echo $ShopFabrications_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ShopFabrications_edit->RightColumnClass ?>"><div <?php echo $ShopFabrications_edit->Rank->cellAttributes() ?>>
<span id="el_ShopFabrications_Rank">
<input type="text" data-table="ShopFabrications" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ShopFabrications_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_edit->Rank->EditValue ?>"<?php echo $ShopFabrications_edit->Rank->editAttributes() ?>>
</span>
<?php echo $ShopFabrications_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ShopFabrications_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_ShopFabrications_ActiveFlag" class="<?php echo $ShopFabrications_edit->LeftColumnClass ?>"><?php echo $ShopFabrications_edit->ActiveFlag->caption() ?><?php echo $ShopFabrications_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ShopFabrications_edit->RightColumnClass ?>"><div <?php echo $ShopFabrications_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_ShopFabrications_ActiveFlag">
<?php
$selwrk = ConvertToBool($ShopFabrications_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ShopFabrications" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_747079" value="1"<?php echo $selwrk ?><?php echo $ShopFabrications_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_747079"></label>
</div>
</span>
<?php echo $ShopFabrications_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ShopFabrications_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ShopFabrications_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ShopFabrications_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ShopFabrications_edit->IsModal) { ?>
<?php echo $ShopFabrications_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ShopFabrications_edit->showPageFooter();
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
$ShopFabrications_edit->terminate();
?>