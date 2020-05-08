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
$Fittings_add = new Fittings_add();

// Run the page
$Fittings_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Fittings_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fFittingsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fFittingsadd = currentForm = new ew.Form("fFittingsadd", "add");

	// Validate form
	fFittingsadd.validate = function() {
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
			<?php if ($Fittings_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_add->Name->caption(), $Fittings_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_add->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_add->Department_Idn->caption(), $Fittings_add->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_add->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_add->WorksheetMaster_Idn->caption(), $Fittings_add->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_add->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_add->WorksheetCategory_Idn->caption(), $Fittings_add->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_add->PartOfSetFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_PartOfSetFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_add->PartOfSetFlag->caption(), $Fittings_add->PartOfSetFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_add->Rank->caption(), $Fittings_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Fittings_add->Rank->errorMessage()) ?>");
			<?php if ($Fittings_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_add->ActiveFlag->caption(), $Fittings_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fFittingsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fFittingsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fFittingsadd.lists["x_Department_Idn"] = <?php echo $Fittings_add->Department_Idn->Lookup->toClientList($Fittings_add) ?>;
	fFittingsadd.lists["x_Department_Idn"].options = <?php echo JsonEncode($Fittings_add->Department_Idn->lookupOptions()) ?>;
	fFittingsadd.lists["x_WorksheetMaster_Idn"] = <?php echo $Fittings_add->WorksheetMaster_Idn->Lookup->toClientList($Fittings_add) ?>;
	fFittingsadd.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($Fittings_add->WorksheetMaster_Idn->lookupOptions()) ?>;
	fFittingsadd.lists["x_WorksheetCategory_Idn"] = <?php echo $Fittings_add->WorksheetCategory_Idn->Lookup->toClientList($Fittings_add) ?>;
	fFittingsadd.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($Fittings_add->WorksheetCategory_Idn->lookupOptions()) ?>;
	fFittingsadd.lists["x_PartOfSetFlag[]"] = <?php echo $Fittings_add->PartOfSetFlag->Lookup->toClientList($Fittings_add) ?>;
	fFittingsadd.lists["x_PartOfSetFlag[]"].options = <?php echo JsonEncode($Fittings_add->PartOfSetFlag->options(FALSE, TRUE)) ?>;
	fFittingsadd.lists["x_ActiveFlag[]"] = <?php echo $Fittings_add->ActiveFlag->Lookup->toClientList($Fittings_add) ?>;
	fFittingsadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Fittings_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fFittingsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Fittings_add->showPageHeader(); ?>
<?php
$Fittings_add->showMessage();
?>
<form name="fFittingsadd" id="fFittingsadd" class="<?php echo $Fittings_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Fittings">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$Fittings_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Fittings_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_Fittings_Name" for="x_Name" class="<?php echo $Fittings_add->LeftColumnClass ?>"><?php echo $Fittings_add->Name->caption() ?><?php echo $Fittings_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_add->RightColumnClass ?>"><div <?php echo $Fittings_add->Name->cellAttributes() ?>>
<span id="el_Fittings_Name">
<input type="text" data-table="Fittings" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Fittings_add->Name->getPlaceHolder()) ?>" value="<?php echo $Fittings_add->Name->EditValue ?>"<?php echo $Fittings_add->Name->editAttributes() ?>>
</span>
<?php echo $Fittings_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_add->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_Fittings_Department_Idn" for="x_Department_Idn" class="<?php echo $Fittings_add->LeftColumnClass ?>"><?php echo $Fittings_add->Department_Idn->caption() ?><?php echo $Fittings_add->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_add->RightColumnClass ?>"><div <?php echo $Fittings_add->Department_Idn->cellAttributes() ?>>
<span id="el_Fittings_Department_Idn">
<?php $Fittings_add->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_Department_Idn" data-value-separator="<?php echo $Fittings_add->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $Fittings_add->Department_Idn->editAttributes() ?>>
			<?php echo $Fittings_add->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $Fittings_add->Department_Idn->Lookup->getParamTag($Fittings_add, "p_x_Department_Idn") ?>
</span>
<?php echo $Fittings_add->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_add->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_Fittings_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $Fittings_add->LeftColumnClass ?>"><?php echo $Fittings_add->WorksheetMaster_Idn->caption() ?><?php echo $Fittings_add->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_add->RightColumnClass ?>"><div <?php echo $Fittings_add->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_Fittings_WorksheetMaster_Idn">
<?php $Fittings_add->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $Fittings_add->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $Fittings_add->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Fittings_add->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Fittings_add->WorksheetMaster_Idn->Lookup->getParamTag($Fittings_add, "p_x_WorksheetMaster_Idn") ?>
</span>
<?php echo $Fittings_add->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_add->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<div id="r_WorksheetCategory_Idn" class="form-group row">
		<label id="elh_Fittings_WorksheetCategory_Idn" for="x_WorksheetCategory_Idn" class="<?php echo $Fittings_add->LeftColumnClass ?>"><?php echo $Fittings_add->WorksheetCategory_Idn->caption() ?><?php echo $Fittings_add->WorksheetCategory_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_add->RightColumnClass ?>"><div <?php echo $Fittings_add->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el_Fittings_WorksheetCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $Fittings_add->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetCategory_Idn" name="x_WorksheetCategory_Idn"<?php echo $Fittings_add->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Fittings_add->WorksheetCategory_Idn->selectOptionListHtml("x_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Fittings_add->WorksheetCategory_Idn->Lookup->getParamTag($Fittings_add, "p_x_WorksheetCategory_Idn") ?>
</span>
<?php echo $Fittings_add->WorksheetCategory_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_add->PartOfSetFlag->Visible) { // PartOfSetFlag ?>
	<div id="r_PartOfSetFlag" class="form-group row">
		<label id="elh_Fittings_PartOfSetFlag" class="<?php echo $Fittings_add->LeftColumnClass ?>"><?php echo $Fittings_add->PartOfSetFlag->caption() ?><?php echo $Fittings_add->PartOfSetFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_add->RightColumnClass ?>"><div <?php echo $Fittings_add->PartOfSetFlag->cellAttributes() ?>>
<span id="el_Fittings_PartOfSetFlag">
<?php
$selwrk = ConvertToBool($Fittings_add->PartOfSetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_PartOfSetFlag" name="x_PartOfSetFlag[]" id="x_PartOfSetFlag[]_955948" value="1"<?php echo $selwrk ?><?php echo $Fittings_add->PartOfSetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_PartOfSetFlag[]_955948"></label>
</div>
</span>
<?php echo $Fittings_add->PartOfSetFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_Fittings_Rank" for="x_Rank" class="<?php echo $Fittings_add->LeftColumnClass ?>"><?php echo $Fittings_add->Rank->caption() ?><?php echo $Fittings_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_add->RightColumnClass ?>"><div <?php echo $Fittings_add->Rank->cellAttributes() ?>>
<span id="el_Fittings_Rank">
<input type="text" data-table="Fittings" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Fittings_add->Rank->getPlaceHolder()) ?>" value="<?php echo $Fittings_add->Rank->EditValue ?>"<?php echo $Fittings_add->Rank->editAttributes() ?>>
</span>
<?php echo $Fittings_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Fittings_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_Fittings_ActiveFlag" class="<?php echo $Fittings_add->LeftColumnClass ?>"><?php echo $Fittings_add->ActiveFlag->caption() ?><?php echo $Fittings_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Fittings_add->RightColumnClass ?>"><div <?php echo $Fittings_add->ActiveFlag->cellAttributes() ?>>
<span id="el_Fittings_ActiveFlag">
<?php
$selwrk = ConvertToBool($Fittings_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_938770" value="1"<?php echo $selwrk ?><?php echo $Fittings_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_938770"></label>
</div>
</span>
<?php echo $Fittings_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Fittings_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Fittings_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Fittings_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Fittings_add->showPageFooter();
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
$Fittings_add->terminate();
?>