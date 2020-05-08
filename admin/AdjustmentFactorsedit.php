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
$AdjustmentFactors_edit = new AdjustmentFactors_edit();

// Run the page
$AdjustmentFactors_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AdjustmentFactors_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fAdjustmentFactorsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fAdjustmentFactorsedit = currentForm = new ew.Form("fAdjustmentFactorsedit", "edit");

	// Validate form
	fAdjustmentFactorsedit.validate = function() {
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
			<?php if ($AdjustmentFactors_edit->AdjustmentFactor_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_AdjustmentFactor_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_edit->AdjustmentFactor_Idn->caption(), $AdjustmentFactors_edit->AdjustmentFactor_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentFactors_edit->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_edit->WorksheetMaster_Idn->caption(), $AdjustmentFactors_edit->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentFactors_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_edit->Name->caption(), $AdjustmentFactors_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentFactors_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_edit->Rank->caption(), $AdjustmentFactors_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($AdjustmentFactors_edit->Rank->errorMessage()) ?>");
			<?php if ($AdjustmentFactors_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_edit->ActiveFlag->caption(), $AdjustmentFactors_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fAdjustmentFactorsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fAdjustmentFactorsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fAdjustmentFactorsedit.lists["x_WorksheetMaster_Idn"] = <?php echo $AdjustmentFactors_edit->WorksheetMaster_Idn->Lookup->toClientList($AdjustmentFactors_edit) ?>;
	fAdjustmentFactorsedit.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($AdjustmentFactors_edit->WorksheetMaster_Idn->lookupOptions()) ?>;
	fAdjustmentFactorsedit.lists["x_ActiveFlag[]"] = <?php echo $AdjustmentFactors_edit->ActiveFlag->Lookup->toClientList($AdjustmentFactors_edit) ?>;
	fAdjustmentFactorsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($AdjustmentFactors_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fAdjustmentFactorsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $AdjustmentFactors_edit->showPageHeader(); ?>
<?php
$AdjustmentFactors_edit->showMessage();
?>
<?php if (!$AdjustmentFactors_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $AdjustmentFactors_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fAdjustmentFactorsedit" id="fAdjustmentFactorsedit" class="<?php echo $AdjustmentFactors_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AdjustmentFactors">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$AdjustmentFactors_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($AdjustmentFactors_edit->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
	<div id="r_AdjustmentFactor_Idn" class="form-group row">
		<label id="elh_AdjustmentFactors_AdjustmentFactor_Idn" class="<?php echo $AdjustmentFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentFactors_edit->AdjustmentFactor_Idn->caption() ?><?php echo $AdjustmentFactors_edit->AdjustmentFactor_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentFactors_edit->AdjustmentFactor_Idn->cellAttributes() ?>>
<span id="el_AdjustmentFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentFactors_edit->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentFactors_edit->AdjustmentFactor_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_AdjustmentFactor_Idn" name="x_AdjustmentFactor_Idn" id="x_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentFactors_edit->AdjustmentFactor_Idn->CurrentValue) ?>">
<?php echo $AdjustmentFactors_edit->AdjustmentFactor_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentFactors_edit->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_AdjustmentFactors_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $AdjustmentFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentFactors_edit->WorksheetMaster_Idn->caption() ?><?php echo $AdjustmentFactors_edit->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentFactors_edit->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_AdjustmentFactors_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentFactors" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $AdjustmentFactors_edit->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $AdjustmentFactors_edit->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $AdjustmentFactors_edit->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentFactors_edit->WorksheetMaster_Idn->Lookup->getParamTag($AdjustmentFactors_edit, "p_x_WorksheetMaster_Idn") ?>
</span>
<?php echo $AdjustmentFactors_edit->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentFactors_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_AdjustmentFactors_Name" for="x_Name" class="<?php echo $AdjustmentFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentFactors_edit->Name->caption() ?><?php echo $AdjustmentFactors_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentFactors_edit->Name->cellAttributes() ?>>
<span id="el_AdjustmentFactors_Name">
<input type="text" data-table="AdjustmentFactors" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentFactors_edit->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_edit->Name->EditValue ?>"<?php echo $AdjustmentFactors_edit->Name->editAttributes() ?>>
</span>
<?php echo $AdjustmentFactors_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentFactors_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_AdjustmentFactors_Rank" for="x_Rank" class="<?php echo $AdjustmentFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentFactors_edit->Rank->caption() ?><?php echo $AdjustmentFactors_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentFactors_edit->Rank->cellAttributes() ?>>
<span id="el_AdjustmentFactors_Rank">
<input type="text" data-table="AdjustmentFactors" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentFactors_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_edit->Rank->EditValue ?>"<?php echo $AdjustmentFactors_edit->Rank->editAttributes() ?>>
</span>
<?php echo $AdjustmentFactors_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentFactors_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_AdjustmentFactors_ActiveFlag" class="<?php echo $AdjustmentFactors_edit->LeftColumnClass ?>"><?php echo $AdjustmentFactors_edit->ActiveFlag->caption() ?><?php echo $AdjustmentFactors_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentFactors_edit->RightColumnClass ?>"><div <?php echo $AdjustmentFactors_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_AdjustmentFactors_ActiveFlag">
<?php
$selwrk = ConvertToBool($AdjustmentFactors_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentFactors" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_121264" value="1"<?php echo $selwrk ?><?php echo $AdjustmentFactors_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_121264"></label>
</div>
</span>
<?php echo $AdjustmentFactors_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("AdjustmentSubFactors", explode(",", $AdjustmentFactors->getCurrentDetailTable())) && $AdjustmentSubFactors->DetailEdit) {
?>
<?php if ($AdjustmentFactors->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("AdjustmentSubFactors", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "AdjustmentSubFactorsgrid.php" ?>
<?php } ?>
<?php if (!$AdjustmentFactors_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $AdjustmentFactors_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $AdjustmentFactors_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$AdjustmentFactors_edit->IsModal) { ?>
<?php echo $AdjustmentFactors_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$AdjustmentFactors_edit->showPageFooter();
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
$AdjustmentFactors_edit->terminate();
?>