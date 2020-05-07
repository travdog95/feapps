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
$Fittings_edit = new Fittings_edit();

// Run the page
$Fittings_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Fittings_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fFittingsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fFittingsedit = currentForm = new ew.Form("fFittingsedit", "edit");

	// Validate form
	fFittingsedit.validate = function() {
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
			<?php if ($Fittings_edit->Fitting_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Fitting_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_edit->Fitting_Idn->caption(), $Fittings_edit->Fitting_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_edit->Name->caption(), $Fittings_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_edit->Department_Idn->caption(), $Fittings_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_edit->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_edit->WorksheetMaster_Idn->caption(), $Fittings_edit->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_edit->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_edit->WorksheetCategory_Idn->caption(), $Fittings_edit->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_edit->PartOfSetFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_PartOfSetFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_edit->PartOfSetFlag->caption(), $Fittings_edit->PartOfSetFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_edit->Rank->caption(), $Fittings_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Fittings_edit->Rank->errorMessage()) ?>");
			<?php if ($Fittings_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_edit->ActiveFlag->caption(), $Fittings_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fFittingsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fFittingsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fFittingsedit.lists["x_Department_Idn"] = <?php echo $Fittings_edit->Department_Idn->Lookup->toClientList($Fittings_edit) ?>;
	fFittingsedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($Fittings_edit->Department_Idn->lookupOptions()) ?>;
	fFittingsedit.lists["x_WorksheetMaster_Idn"] = <?php echo $Fittings_edit->WorksheetMaster_Idn->Lookup->toClientList($Fittings_edit) ?>;
	fFittingsedit.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($Fittings_edit->WorksheetMaster_Idn->lookupOptions()) ?>;
	fFittingsedit.lists["x_WorksheetCategory_Idn"] = <?php echo $Fittings_edit->WorksheetCategory_Idn->Lookup->toClientList($Fittings_edit) ?>;
	fFittingsedit.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($Fittings_edit->WorksheetCategory_Idn->lookupOptions()) ?>;
	fFittingsedit.lists["x_PartOfSetFlag[]"] = <?php echo $Fittings_edit->PartOfSetFlag->Lookup->toClientList($Fittings_edit) ?>;
	fFittingsedit.lists["x_PartOfSetFlag[]"].options = <?php echo JsonEncode($Fittings_edit->PartOfSetFlag->options(FALSE, TRUE)) ?>;
	fFittingsedit.lists["x_ActiveFlag[]"] = <?php echo $Fittings_edit->ActiveFlag->Lookup->toClientList($Fittings_edit) ?>;
	fFittingsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Fittings_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fFittingsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Fittings_edit->showPageHeader(); ?>
<?php
$Fittings_edit->showMessage();
?>
<?php if (!$Fittings_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Fittings_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fFittingsedit" id="fFittingsedit" class="<?php echo $Fittings_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Fittings">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Fittings_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Fittings_edit->Fitting_Idn->Visible) { // Fitting_Idn ?>
	<div id="r_Fitting_Idn" class="form-group row">
		<label id="elh_Fittings_Fitting_Idn" class="<?php echo $Fittings_edit->LeftColumnClass ?>"><?php echo $Fittings_edit->Fitting_Idn->caption() ?><?php echo $Fittings_edit->Fitting_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_edit->RightColumnClass ?>"><div <?php echo $Fittings_edit->Fitting_Idn->cellAttributes() ?>>
<span id="el_Fittings_Fitting_Idn">
<span<?php echo $Fittings_edit->Fitting_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Fittings_edit->Fitting_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Fittings" data-field="x_Fitting_Idn" name="x_Fitting_Idn" id="x_Fitting_Idn" value="<?php echo HtmlEncode($Fittings_edit->Fitting_Idn->CurrentValue) ?>">
<?php echo $Fittings_edit->Fitting_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_Fittings_Name" for="x_Name" class="<?php echo $Fittings_edit->LeftColumnClass ?>"><?php echo $Fittings_edit->Name->caption() ?><?php echo $Fittings_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_edit->RightColumnClass ?>"><div <?php echo $Fittings_edit->Name->cellAttributes() ?>>
<span id="el_Fittings_Name">
<input type="text" data-table="Fittings" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Fittings_edit->Name->getPlaceHolder()) ?>" value="<?php echo $Fittings_edit->Name->EditValue ?>"<?php echo $Fittings_edit->Name->editAttributes() ?>>
</span>
<?php echo $Fittings_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_Fittings_Department_Idn" for="x_Department_Idn" class="<?php echo $Fittings_edit->LeftColumnClass ?>"><?php echo $Fittings_edit->Department_Idn->caption() ?><?php echo $Fittings_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_edit->RightColumnClass ?>"><div <?php echo $Fittings_edit->Department_Idn->cellAttributes() ?>>
<span id="el_Fittings_Department_Idn">
<?php $Fittings_edit->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_Department_Idn" data-value-separator="<?php echo $Fittings_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $Fittings_edit->Department_Idn->editAttributes() ?>>
			<?php echo $Fittings_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $Fittings_edit->Department_Idn->Lookup->getParamTag($Fittings_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $Fittings_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_edit->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_Fittings_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $Fittings_edit->LeftColumnClass ?>"><?php echo $Fittings_edit->WorksheetMaster_Idn->caption() ?><?php echo $Fittings_edit->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_edit->RightColumnClass ?>"><div <?php echo $Fittings_edit->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_Fittings_WorksheetMaster_Idn">
<?php $Fittings_edit->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $Fittings_edit->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $Fittings_edit->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Fittings_edit->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Fittings_edit->WorksheetMaster_Idn->Lookup->getParamTag($Fittings_edit, "p_x_WorksheetMaster_Idn") ?>
</span>
<?php echo $Fittings_edit->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_edit->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<div id="r_WorksheetCategory_Idn" class="form-group row">
		<label id="elh_Fittings_WorksheetCategory_Idn" for="x_WorksheetCategory_Idn" class="<?php echo $Fittings_edit->LeftColumnClass ?>"><?php echo $Fittings_edit->WorksheetCategory_Idn->caption() ?><?php echo $Fittings_edit->WorksheetCategory_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_edit->RightColumnClass ?>"><div <?php echo $Fittings_edit->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el_Fittings_WorksheetCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $Fittings_edit->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetCategory_Idn" name="x_WorksheetCategory_Idn"<?php echo $Fittings_edit->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Fittings_edit->WorksheetCategory_Idn->selectOptionListHtml("x_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Fittings_edit->WorksheetCategory_Idn->Lookup->getParamTag($Fittings_edit, "p_x_WorksheetCategory_Idn") ?>
</span>
<?php echo $Fittings_edit->WorksheetCategory_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_edit->PartOfSetFlag->Visible) { // PartOfSetFlag ?>
	<div id="r_PartOfSetFlag" class="form-group row">
		<label id="elh_Fittings_PartOfSetFlag" class="<?php echo $Fittings_edit->LeftColumnClass ?>"><?php echo $Fittings_edit->PartOfSetFlag->caption() ?><?php echo $Fittings_edit->PartOfSetFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_edit->RightColumnClass ?>"><div <?php echo $Fittings_edit->PartOfSetFlag->cellAttributes() ?>>
<span id="el_Fittings_PartOfSetFlag">
<?php
$selwrk = ConvertToBool($Fittings_edit->PartOfSetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_PartOfSetFlag" name="x_PartOfSetFlag[]" id="x_PartOfSetFlag[]_806929" value="1"<?php echo $selwrk ?><?php echo $Fittings_edit->PartOfSetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_PartOfSetFlag[]_806929"></label>
</div>
</span>
<?php echo $Fittings_edit->PartOfSetFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_Fittings_Rank" for="x_Rank" class="<?php echo $Fittings_edit->LeftColumnClass ?>"><?php echo $Fittings_edit->Rank->caption() ?><?php echo $Fittings_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_edit->RightColumnClass ?>"><div <?php echo $Fittings_edit->Rank->cellAttributes() ?>>
<span id="el_Fittings_Rank">
<input type="text" data-table="Fittings" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Fittings_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $Fittings_edit->Rank->EditValue ?>"<?php echo $Fittings_edit->Rank->editAttributes() ?>>
</span>
<?php echo $Fittings_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_Fittings_ActiveFlag" class="<?php echo $Fittings_edit->LeftColumnClass ?>"><?php echo $Fittings_edit->ActiveFlag->caption() ?><?php echo $Fittings_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_edit->RightColumnClass ?>"><div <?php echo $Fittings_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_Fittings_ActiveFlag">
<?php
$selwrk = ConvertToBool($Fittings_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_628337" value="1"<?php echo $selwrk ?><?php echo $Fittings_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_628337"></label>
</div>
</span>
<?php echo $Fittings_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Fittings_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Fittings_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Fittings_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$Fittings_edit->IsModal) { ?>
<?php echo $Fittings_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$Fittings_edit->showPageFooter();
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
$Fittings_edit->terminate();
?>