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
$PipeExposures_edit = new PipeExposures_edit();

// Run the page
$PipeExposures_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeExposures_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPipeExposuresedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fPipeExposuresedit = currentForm = new ew.Form("fPipeExposuresedit", "edit");

	// Validate form
	fPipeExposuresedit.validate = function() {
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
			<?php if ($PipeExposures_edit->PipeExposure_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PipeExposure_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeExposures_edit->PipeExposure_Idn->caption(), $PipeExposures_edit->PipeExposure_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeExposures_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeExposures_edit->Name->caption(), $PipeExposures_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeExposures_edit->AdjustmentFactor_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_AdjustmentFactor_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeExposures_edit->AdjustmentFactor_Idn->caption(), $PipeExposures_edit->AdjustmentFactor_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeExposures_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeExposures_edit->Rank->caption(), $PipeExposures_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PipeExposures_edit->Rank->errorMessage()) ?>");
			<?php if ($PipeExposures_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeExposures_edit->ActiveFlag->caption(), $PipeExposures_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fPipeExposuresedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPipeExposuresedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fPipeExposuresedit.lists["x_AdjustmentFactor_Idn"] = <?php echo $PipeExposures_edit->AdjustmentFactor_Idn->Lookup->toClientList($PipeExposures_edit) ?>;
	fPipeExposuresedit.lists["x_AdjustmentFactor_Idn"].options = <?php echo JsonEncode($PipeExposures_edit->AdjustmentFactor_Idn->lookupOptions()) ?>;
	fPipeExposuresedit.lists["x_ActiveFlag[]"] = <?php echo $PipeExposures_edit->ActiveFlag->Lookup->toClientList($PipeExposures_edit) ?>;
	fPipeExposuresedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($PipeExposures_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fPipeExposuresedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $PipeExposures_edit->showPageHeader(); ?>
<?php
$PipeExposures_edit->showMessage();
?>
<?php if (!$PipeExposures_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PipeExposures_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fPipeExposuresedit" id="fPipeExposuresedit" class="<?php echo $PipeExposures_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeExposures">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$PipeExposures_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($PipeExposures_edit->PipeExposure_Idn->Visible) { // PipeExposure_Idn ?>
	<div id="r_PipeExposure_Idn" class="form-group row">
		<label id="elh_PipeExposures_PipeExposure_Idn" class="<?php echo $PipeExposures_edit->LeftColumnClass ?>"><?php echo $PipeExposures_edit->PipeExposure_Idn->caption() ?><?php echo $PipeExposures_edit->PipeExposure_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeExposures_edit->RightColumnClass ?>"><div <?php echo $PipeExposures_edit->PipeExposure_Idn->cellAttributes() ?>>
<span id="el_PipeExposures_PipeExposure_Idn">
<span<?php echo $PipeExposures_edit->PipeExposure_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($PipeExposures_edit->PipeExposure_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_PipeExposure_Idn" name="x_PipeExposure_Idn" id="x_PipeExposure_Idn" value="<?php echo HtmlEncode($PipeExposures_edit->PipeExposure_Idn->CurrentValue) ?>">
<?php echo $PipeExposures_edit->PipeExposure_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeExposures_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_PipeExposures_Name" for="x_Name" class="<?php echo $PipeExposures_edit->LeftColumnClass ?>"><?php echo $PipeExposures_edit->Name->caption() ?><?php echo $PipeExposures_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeExposures_edit->RightColumnClass ?>"><div <?php echo $PipeExposures_edit->Name->cellAttributes() ?>>
<span id="el_PipeExposures_Name">
<input type="text" data-table="PipeExposures" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeExposures_edit->Name->getPlaceHolder()) ?>" value="<?php echo $PipeExposures_edit->Name->EditValue ?>"<?php echo $PipeExposures_edit->Name->editAttributes() ?>>
</span>
<?php echo $PipeExposures_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeExposures_edit->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
	<div id="r_AdjustmentFactor_Idn" class="form-group row">
		<label id="elh_PipeExposures_AdjustmentFactor_Idn" for="x_AdjustmentFactor_Idn" class="<?php echo $PipeExposures_edit->LeftColumnClass ?>"><?php echo $PipeExposures_edit->AdjustmentFactor_Idn->caption() ?><?php echo $PipeExposures_edit->AdjustmentFactor_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeExposures_edit->RightColumnClass ?>"><div <?php echo $PipeExposures_edit->AdjustmentFactor_Idn->cellAttributes() ?>>
<span id="el_PipeExposures_AdjustmentFactor_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="PipeExposures" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $PipeExposures_edit->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x_AdjustmentFactor_Idn" name="x_AdjustmentFactor_Idn"<?php echo $PipeExposures_edit->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $PipeExposures_edit->AdjustmentFactor_Idn->selectOptionListHtml("x_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $PipeExposures_edit->AdjustmentFactor_Idn->Lookup->getParamTag($PipeExposures_edit, "p_x_AdjustmentFactor_Idn") ?>
</span>
<?php echo $PipeExposures_edit->AdjustmentFactor_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeExposures_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_PipeExposures_Rank" for="x_Rank" class="<?php echo $PipeExposures_edit->LeftColumnClass ?>"><?php echo $PipeExposures_edit->Rank->caption() ?><?php echo $PipeExposures_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeExposures_edit->RightColumnClass ?>"><div <?php echo $PipeExposures_edit->Rank->cellAttributes() ?>>
<span id="el_PipeExposures_Rank">
<input type="text" data-table="PipeExposures" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeExposures_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeExposures_edit->Rank->EditValue ?>"<?php echo $PipeExposures_edit->Rank->editAttributes() ?>>
</span>
<?php echo $PipeExposures_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeExposures_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_PipeExposures_ActiveFlag" class="<?php echo $PipeExposures_edit->LeftColumnClass ?>"><?php echo $PipeExposures_edit->ActiveFlag->caption() ?><?php echo $PipeExposures_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeExposures_edit->RightColumnClass ?>"><div <?php echo $PipeExposures_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_PipeExposures_ActiveFlag">
<?php
$selwrk = ConvertToBool($PipeExposures_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeExposures" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_962568" value="1"<?php echo $selwrk ?><?php echo $PipeExposures_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_962568"></label>
</div>
</span>
<?php echo $PipeExposures_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$PipeExposures_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $PipeExposures_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $PipeExposures_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$PipeExposures_edit->IsModal) { ?>
<?php echo $PipeExposures_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$PipeExposures_edit->showPageFooter();
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
$PipeExposures_edit->terminate();
?>