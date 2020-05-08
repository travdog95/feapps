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
$CartParms_edit = new CartParms_edit();

// Run the page
$CartParms_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CartParms_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCartParmsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fCartParmsedit = currentForm = new ew.Form("fCartParmsedit", "edit");

	// Validate form
	fCartParmsedit.validate = function() {
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
			<?php if ($CartParms_edit->CartParm_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_CartParm_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_edit->CartParm_Idn->caption(), $CartParms_edit->CartParm_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CartParms_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_edit->Name->caption(), $CartParms_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CartParms_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_edit->Department_Idn->caption(), $CartParms_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CartParms_edit->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_edit->WorksheetMaster_Idn->caption(), $CartParms_edit->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CartParms_edit->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_edit->WorksheetCategory_Idn->caption(), $CartParms_edit->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CartParms_edit->GroupValue->Required) { ?>
				elm = this.getElements("x" + infix + "_GroupValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_edit->GroupValue->caption(), $CartParms_edit->GroupValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_GroupValue");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($CartParms_edit->GroupValue->errorMessage()) ?>");
			<?php if ($CartParms_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_edit->Rank->caption(), $CartParms_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($CartParms_edit->Rank->errorMessage()) ?>");
			<?php if ($CartParms_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_edit->ActiveFlag->caption(), $CartParms_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fCartParmsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCartParmsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fCartParmsedit.lists["x_Department_Idn"] = <?php echo $CartParms_edit->Department_Idn->Lookup->toClientList($CartParms_edit) ?>;
	fCartParmsedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($CartParms_edit->Department_Idn->lookupOptions()) ?>;
	fCartParmsedit.lists["x_WorksheetMaster_Idn"] = <?php echo $CartParms_edit->WorksheetMaster_Idn->Lookup->toClientList($CartParms_edit) ?>;
	fCartParmsedit.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($CartParms_edit->WorksheetMaster_Idn->lookupOptions()) ?>;
	fCartParmsedit.lists["x_WorksheetCategory_Idn"] = <?php echo $CartParms_edit->WorksheetCategory_Idn->Lookup->toClientList($CartParms_edit) ?>;
	fCartParmsedit.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($CartParms_edit->WorksheetCategory_Idn->lookupOptions()) ?>;
	fCartParmsedit.lists["x_ActiveFlag[]"] = <?php echo $CartParms_edit->ActiveFlag->Lookup->toClientList($CartParms_edit) ?>;
	fCartParmsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($CartParms_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fCartParmsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $CartParms_edit->showPageHeader(); ?>
<?php
$CartParms_edit->showMessage();
?>
<?php if (!$CartParms_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $CartParms_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fCartParmsedit" id="fCartParmsedit" class="<?php echo $CartParms_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CartParms">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$CartParms_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($CartParms_edit->CartParm_Idn->Visible) { // CartParm_Idn ?>
	<div id="r_CartParm_Idn" class="form-group row">
		<label id="elh_CartParms_CartParm_Idn" class="<?php echo $CartParms_edit->LeftColumnClass ?>"><?php echo $CartParms_edit->CartParm_Idn->caption() ?><?php echo $CartParms_edit->CartParm_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CartParms_edit->RightColumnClass ?>"><div <?php echo $CartParms_edit->CartParm_Idn->cellAttributes() ?>>
<span id="el_CartParms_CartParm_Idn">
<span<?php echo $CartParms_edit->CartParm_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($CartParms_edit->CartParm_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="CartParms" data-field="x_CartParm_Idn" name="x_CartParm_Idn" id="x_CartParm_Idn" value="<?php echo HtmlEncode($CartParms_edit->CartParm_Idn->CurrentValue) ?>">
<?php echo $CartParms_edit->CartParm_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CartParms_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_CartParms_Name" for="x_Name" class="<?php echo $CartParms_edit->LeftColumnClass ?>"><?php echo $CartParms_edit->Name->caption() ?><?php echo $CartParms_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CartParms_edit->RightColumnClass ?>"><div <?php echo $CartParms_edit->Name->cellAttributes() ?>>
<span id="el_CartParms_Name">
<input type="text" data-table="CartParms" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CartParms_edit->Name->getPlaceHolder()) ?>" value="<?php echo $CartParms_edit->Name->EditValue ?>"<?php echo $CartParms_edit->Name->editAttributes() ?>>
</span>
<?php echo $CartParms_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CartParms_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_CartParms_Department_Idn" for="x_Department_Idn" class="<?php echo $CartParms_edit->LeftColumnClass ?>"><?php echo $CartParms_edit->Department_Idn->caption() ?><?php echo $CartParms_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CartParms_edit->RightColumnClass ?>"><div <?php echo $CartParms_edit->Department_Idn->cellAttributes() ?>>
<span id="el_CartParms_Department_Idn">
<?php $CartParms_edit->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_Department_Idn" data-value-separator="<?php echo $CartParms_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $CartParms_edit->Department_Idn->editAttributes() ?>>
			<?php echo $CartParms_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $CartParms_edit->Department_Idn->Lookup->getParamTag($CartParms_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $CartParms_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CartParms_edit->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_CartParms_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $CartParms_edit->LeftColumnClass ?>"><?php echo $CartParms_edit->WorksheetMaster_Idn->caption() ?><?php echo $CartParms_edit->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CartParms_edit->RightColumnClass ?>"><div <?php echo $CartParms_edit->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_CartParms_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $CartParms_edit->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $CartParms_edit->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $CartParms_edit->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $CartParms_edit->WorksheetMaster_Idn->Lookup->getParamTag($CartParms_edit, "p_x_WorksheetMaster_Idn") ?>
</span>
<?php echo $CartParms_edit->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CartParms_edit->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<div id="r_WorksheetCategory_Idn" class="form-group row">
		<label id="elh_CartParms_WorksheetCategory_Idn" for="x_WorksheetCategory_Idn" class="<?php echo $CartParms_edit->LeftColumnClass ?>"><?php echo $CartParms_edit->WorksheetCategory_Idn->caption() ?><?php echo $CartParms_edit->WorksheetCategory_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CartParms_edit->RightColumnClass ?>"><div <?php echo $CartParms_edit->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el_CartParms_WorksheetCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $CartParms_edit->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetCategory_Idn" name="x_WorksheetCategory_Idn"<?php echo $CartParms_edit->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $CartParms_edit->WorksheetCategory_Idn->selectOptionListHtml("x_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $CartParms_edit->WorksheetCategory_Idn->Lookup->getParamTag($CartParms_edit, "p_x_WorksheetCategory_Idn") ?>
</span>
<?php echo $CartParms_edit->WorksheetCategory_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CartParms_edit->GroupValue->Visible) { // GroupValue ?>
	<div id="r_GroupValue" class="form-group row">
		<label id="elh_CartParms_GroupValue" for="x_GroupValue" class="<?php echo $CartParms_edit->LeftColumnClass ?>"><?php echo $CartParms_edit->GroupValue->caption() ?><?php echo $CartParms_edit->GroupValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CartParms_edit->RightColumnClass ?>"><div <?php echo $CartParms_edit->GroupValue->cellAttributes() ?>>
<span id="el_CartParms_GroupValue">
<input type="text" data-table="CartParms" data-field="x_GroupValue" name="x_GroupValue" id="x_GroupValue" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CartParms_edit->GroupValue->getPlaceHolder()) ?>" value="<?php echo $CartParms_edit->GroupValue->EditValue ?>"<?php echo $CartParms_edit->GroupValue->editAttributes() ?>>
</span>
<?php echo $CartParms_edit->GroupValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CartParms_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_CartParms_Rank" for="x_Rank" class="<?php echo $CartParms_edit->LeftColumnClass ?>"><?php echo $CartParms_edit->Rank->caption() ?><?php echo $CartParms_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CartParms_edit->RightColumnClass ?>"><div <?php echo $CartParms_edit->Rank->cellAttributes() ?>>
<span id="el_CartParms_Rank">
<input type="text" data-table="CartParms" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CartParms_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $CartParms_edit->Rank->EditValue ?>"<?php echo $CartParms_edit->Rank->editAttributes() ?>>
</span>
<?php echo $CartParms_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CartParms_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_CartParms_ActiveFlag" class="<?php echo $CartParms_edit->LeftColumnClass ?>"><?php echo $CartParms_edit->ActiveFlag->caption() ?><?php echo $CartParms_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CartParms_edit->RightColumnClass ?>"><div <?php echo $CartParms_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_CartParms_ActiveFlag">
<?php
$selwrk = ConvertToBool($CartParms_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CartParms" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_535692" value="1"<?php echo $selwrk ?><?php echo $CartParms_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_535692"></label>
</div>
</span>
<?php echo $CartParms_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$CartParms_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $CartParms_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $CartParms_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$CartParms_edit->IsModal) { ?>
<?php echo $CartParms_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$CartParms_edit->showPageFooter();
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
$CartParms_edit->terminate();
?>