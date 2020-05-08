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
$FirePumpAttributes_edit = new FirePumpAttributes_edit();

// Run the page
$FirePumpAttributes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FirePumpAttributes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fFirePumpAttributesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fFirePumpAttributesedit = currentForm = new ew.Form("fFirePumpAttributesedit", "edit");

	// Validate form
	fFirePumpAttributesedit.validate = function() {
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
			<?php if ($FirePumpAttributes_edit->FirePumpAttribute_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FirePumpAttribute_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpAttributes_edit->FirePumpAttribute_Idn->caption(), $FirePumpAttributes_edit->FirePumpAttribute_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FirePumpAttributes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpAttributes_edit->Name->caption(), $FirePumpAttributes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FirePumpAttributes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpAttributes_edit->Rank->caption(), $FirePumpAttributes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($FirePumpAttributes_edit->Rank->errorMessage()) ?>");
			<?php if ($FirePumpAttributes_edit->DefaultFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_DefaultFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpAttributes_edit->DefaultFlag->caption(), $FirePumpAttributes_edit->DefaultFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FirePumpAttributes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpAttributes_edit->ActiveFlag->caption(), $FirePumpAttributes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fFirePumpAttributesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fFirePumpAttributesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fFirePumpAttributesedit.lists["x_DefaultFlag[]"] = <?php echo $FirePumpAttributes_edit->DefaultFlag->Lookup->toClientList($FirePumpAttributes_edit) ?>;
	fFirePumpAttributesedit.lists["x_DefaultFlag[]"].options = <?php echo JsonEncode($FirePumpAttributes_edit->DefaultFlag->options(FALSE, TRUE)) ?>;
	fFirePumpAttributesedit.lists["x_ActiveFlag[]"] = <?php echo $FirePumpAttributes_edit->ActiveFlag->Lookup->toClientList($FirePumpAttributes_edit) ?>;
	fFirePumpAttributesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($FirePumpAttributes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fFirePumpAttributesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $FirePumpAttributes_edit->showPageHeader(); ?>
<?php
$FirePumpAttributes_edit->showMessage();
?>
<?php if (!$FirePumpAttributes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FirePumpAttributes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fFirePumpAttributesedit" id="fFirePumpAttributesedit" class="<?php echo $FirePumpAttributes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FirePumpAttributes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$FirePumpAttributes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($FirePumpAttributes_edit->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
	<div id="r_FirePumpAttribute_Idn" class="form-group row">
		<label id="elh_FirePumpAttributes_FirePumpAttribute_Idn" class="<?php echo $FirePumpAttributes_edit->LeftColumnClass ?>"><?php echo $FirePumpAttributes_edit->FirePumpAttribute_Idn->caption() ?><?php echo $FirePumpAttributes_edit->FirePumpAttribute_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FirePumpAttributes_edit->RightColumnClass ?>"><div <?php echo $FirePumpAttributes_edit->FirePumpAttribute_Idn->cellAttributes() ?>>
<span id="el_FirePumpAttributes_FirePumpAttribute_Idn">
<span<?php echo $FirePumpAttributes_edit->FirePumpAttribute_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($FirePumpAttributes_edit->FirePumpAttribute_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_FirePumpAttribute_Idn" name="x_FirePumpAttribute_Idn" id="x_FirePumpAttribute_Idn" value="<?php echo HtmlEncode($FirePumpAttributes_edit->FirePumpAttribute_Idn->CurrentValue) ?>">
<?php echo $FirePumpAttributes_edit->FirePumpAttribute_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FirePumpAttributes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_FirePumpAttributes_Name" for="x_Name" class="<?php echo $FirePumpAttributes_edit->LeftColumnClass ?>"><?php echo $FirePumpAttributes_edit->Name->caption() ?><?php echo $FirePumpAttributes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FirePumpAttributes_edit->RightColumnClass ?>"><div <?php echo $FirePumpAttributes_edit->Name->cellAttributes() ?>>
<span id="el_FirePumpAttributes_Name">
<input type="text" data-table="FirePumpAttributes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FirePumpAttributes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $FirePumpAttributes_edit->Name->EditValue ?>"<?php echo $FirePumpAttributes_edit->Name->editAttributes() ?>>
</span>
<?php echo $FirePumpAttributes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FirePumpAttributes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_FirePumpAttributes_Rank" for="x_Rank" class="<?php echo $FirePumpAttributes_edit->LeftColumnClass ?>"><?php echo $FirePumpAttributes_edit->Rank->caption() ?><?php echo $FirePumpAttributes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FirePumpAttributes_edit->RightColumnClass ?>"><div <?php echo $FirePumpAttributes_edit->Rank->cellAttributes() ?>>
<span id="el_FirePumpAttributes_Rank">
<input type="text" data-table="FirePumpAttributes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FirePumpAttributes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $FirePumpAttributes_edit->Rank->EditValue ?>"<?php echo $FirePumpAttributes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $FirePumpAttributes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FirePumpAttributes_edit->DefaultFlag->Visible) { // DefaultFlag ?>
	<div id="r_DefaultFlag" class="form-group row">
		<label id="elh_FirePumpAttributes_DefaultFlag" class="<?php echo $FirePumpAttributes_edit->LeftColumnClass ?>"><?php echo $FirePumpAttributes_edit->DefaultFlag->caption() ?><?php echo $FirePumpAttributes_edit->DefaultFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FirePumpAttributes_edit->RightColumnClass ?>"><div <?php echo $FirePumpAttributes_edit->DefaultFlag->cellAttributes() ?>>
<span id="el_FirePumpAttributes_DefaultFlag">
<?php
$selwrk = ConvertToBool($FirePumpAttributes_edit->DefaultFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpAttributes" data-field="x_DefaultFlag" name="x_DefaultFlag[]" id="x_DefaultFlag[]_917699" value="1"<?php echo $selwrk ?><?php echo $FirePumpAttributes_edit->DefaultFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_DefaultFlag[]_917699"></label>
</div>
</span>
<?php echo $FirePumpAttributes_edit->DefaultFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FirePumpAttributes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_FirePumpAttributes_ActiveFlag" class="<?php echo $FirePumpAttributes_edit->LeftColumnClass ?>"><?php echo $FirePumpAttributes_edit->ActiveFlag->caption() ?><?php echo $FirePumpAttributes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FirePumpAttributes_edit->RightColumnClass ?>"><div <?php echo $FirePumpAttributes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_FirePumpAttributes_ActiveFlag">
<?php
$selwrk = ConvertToBool($FirePumpAttributes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpAttributes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_762745" value="1"<?php echo $selwrk ?><?php echo $FirePumpAttributes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_762745"></label>
</div>
</span>
<?php echo $FirePumpAttributes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$FirePumpAttributes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $FirePumpAttributes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $FirePumpAttributes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$FirePumpAttributes_edit->IsModal) { ?>
<?php echo $FirePumpAttributes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$FirePumpAttributes_edit->showPageFooter();
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
$FirePumpAttributes_edit->terminate();
?>