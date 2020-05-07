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
$VolumeCorrections_edit = new VolumeCorrections_edit();

// Run the page
$VolumeCorrections_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$VolumeCorrections_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fVolumeCorrectionsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fVolumeCorrectionsedit = currentForm = new ew.Form("fVolumeCorrectionsedit", "edit");

	// Validate form
	fVolumeCorrectionsedit.validate = function() {
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
			<?php if ($VolumeCorrections_edit->VolumeCorrection_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_VolumeCorrection_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_edit->VolumeCorrection_Idn->caption(), $VolumeCorrections_edit->VolumeCorrection_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($VolumeCorrections_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_edit->Name->caption(), $VolumeCorrections_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($VolumeCorrections_edit->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_edit->Value->caption(), $VolumeCorrections_edit->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($VolumeCorrections_edit->Value->errorMessage()) ?>");
			<?php if ($VolumeCorrections_edit->Hours->Required) { ?>
				elm = this.getElements("x" + infix + "_Hours");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_edit->Hours->caption(), $VolumeCorrections_edit->Hours->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Hours");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($VolumeCorrections_edit->Hours->errorMessage()) ?>");
			<?php if ($VolumeCorrections_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_edit->Rank->caption(), $VolumeCorrections_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($VolumeCorrections_edit->Rank->errorMessage()) ?>");
			<?php if ($VolumeCorrections_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_edit->ActiveFlag->caption(), $VolumeCorrections_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fVolumeCorrectionsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fVolumeCorrectionsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fVolumeCorrectionsedit.lists["x_ActiveFlag[]"] = <?php echo $VolumeCorrections_edit->ActiveFlag->Lookup->toClientList($VolumeCorrections_edit) ?>;
	fVolumeCorrectionsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($VolumeCorrections_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fVolumeCorrectionsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $VolumeCorrections_edit->showPageHeader(); ?>
<?php
$VolumeCorrections_edit->showMessage();
?>
<?php if (!$VolumeCorrections_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $VolumeCorrections_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fVolumeCorrectionsedit" id="fVolumeCorrectionsedit" class="<?php echo $VolumeCorrections_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="VolumeCorrections">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$VolumeCorrections_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($VolumeCorrections_edit->VolumeCorrection_Idn->Visible) { // VolumeCorrection_Idn ?>
	<div id="r_VolumeCorrection_Idn" class="form-group row">
		<label id="elh_VolumeCorrections_VolumeCorrection_Idn" class="<?php echo $VolumeCorrections_edit->LeftColumnClass ?>"><?php echo $VolumeCorrections_edit->VolumeCorrection_Idn->caption() ?><?php echo $VolumeCorrections_edit->VolumeCorrection_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $VolumeCorrections_edit->RightColumnClass ?>"><div <?php echo $VolumeCorrections_edit->VolumeCorrection_Idn->cellAttributes() ?>>
<span id="el_VolumeCorrections_VolumeCorrection_Idn">
<span<?php echo $VolumeCorrections_edit->VolumeCorrection_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($VolumeCorrections_edit->VolumeCorrection_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_VolumeCorrection_Idn" name="x_VolumeCorrection_Idn" id="x_VolumeCorrection_Idn" value="<?php echo HtmlEncode($VolumeCorrections_edit->VolumeCorrection_Idn->CurrentValue) ?>">
<?php echo $VolumeCorrections_edit->VolumeCorrection_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($VolumeCorrections_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_VolumeCorrections_Name" for="x_Name" class="<?php echo $VolumeCorrections_edit->LeftColumnClass ?>"><?php echo $VolumeCorrections_edit->Name->caption() ?><?php echo $VolumeCorrections_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $VolumeCorrections_edit->RightColumnClass ?>"><div <?php echo $VolumeCorrections_edit->Name->cellAttributes() ?>>
<span id="el_VolumeCorrections_Name">
<input type="text" data-table="VolumeCorrections" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($VolumeCorrections_edit->Name->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_edit->Name->EditValue ?>"<?php echo $VolumeCorrections_edit->Name->editAttributes() ?>>
</span>
<?php echo $VolumeCorrections_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($VolumeCorrections_edit->Value->Visible) { // Value ?>
	<div id="r_Value" class="form-group row">
		<label id="elh_VolumeCorrections_Value" for="x_Value" class="<?php echo $VolumeCorrections_edit->LeftColumnClass ?>"><?php echo $VolumeCorrections_edit->Value->caption() ?><?php echo $VolumeCorrections_edit->Value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $VolumeCorrections_edit->RightColumnClass ?>"><div <?php echo $VolumeCorrections_edit->Value->cellAttributes() ?>>
<span id="el_VolumeCorrections_Value">
<input type="text" data-table="VolumeCorrections" data-field="x_Value" name="x_Value" id="x_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($VolumeCorrections_edit->Value->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_edit->Value->EditValue ?>"<?php echo $VolumeCorrections_edit->Value->editAttributes() ?>>
</span>
<?php echo $VolumeCorrections_edit->Value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($VolumeCorrections_edit->Hours->Visible) { // Hours ?>
	<div id="r_Hours" class="form-group row">
		<label id="elh_VolumeCorrections_Hours" for="x_Hours" class="<?php echo $VolumeCorrections_edit->LeftColumnClass ?>"><?php echo $VolumeCorrections_edit->Hours->caption() ?><?php echo $VolumeCorrections_edit->Hours->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $VolumeCorrections_edit->RightColumnClass ?>"><div <?php echo $VolumeCorrections_edit->Hours->cellAttributes() ?>>
<span id="el_VolumeCorrections_Hours">
<input type="text" data-table="VolumeCorrections" data-field="x_Hours" name="x_Hours" id="x_Hours" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_edit->Hours->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_edit->Hours->EditValue ?>"<?php echo $VolumeCorrections_edit->Hours->editAttributes() ?>>
</span>
<?php echo $VolumeCorrections_edit->Hours->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($VolumeCorrections_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_VolumeCorrections_Rank" for="x_Rank" class="<?php echo $VolumeCorrections_edit->LeftColumnClass ?>"><?php echo $VolumeCorrections_edit->Rank->caption() ?><?php echo $VolumeCorrections_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $VolumeCorrections_edit->RightColumnClass ?>"><div <?php echo $VolumeCorrections_edit->Rank->cellAttributes() ?>>
<span id="el_VolumeCorrections_Rank">
<input type="text" data-table="VolumeCorrections" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_edit->Rank->EditValue ?>"<?php echo $VolumeCorrections_edit->Rank->editAttributes() ?>>
</span>
<?php echo $VolumeCorrections_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($VolumeCorrections_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_VolumeCorrections_ActiveFlag" class="<?php echo $VolumeCorrections_edit->LeftColumnClass ?>"><?php echo $VolumeCorrections_edit->ActiveFlag->caption() ?><?php echo $VolumeCorrections_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $VolumeCorrections_edit->RightColumnClass ?>"><div <?php echo $VolumeCorrections_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_VolumeCorrections_ActiveFlag">
<?php
$selwrk = ConvertToBool($VolumeCorrections_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="VolumeCorrections" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_960076" value="1"<?php echo $selwrk ?><?php echo $VolumeCorrections_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_960076"></label>
</div>
</span>
<?php echo $VolumeCorrections_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$VolumeCorrections_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $VolumeCorrections_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $VolumeCorrections_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$VolumeCorrections_edit->IsModal) { ?>
<?php echo $VolumeCorrections_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$VolumeCorrections_edit->showPageFooter();
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
$VolumeCorrections_edit->terminate();
?>