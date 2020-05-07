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
$PipeTypes_edit = new PipeTypes_edit();

// Run the page
$PipeTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPipeTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fPipeTypesedit = currentForm = new ew.Form("fPipeTypesedit", "edit");

	// Validate form
	fPipeTypesedit.validate = function() {
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
			<?php if ($PipeTypes_edit->PipeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PipeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_edit->PipeType_Idn->caption(), $PipeTypes_edit->PipeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_edit->Name->caption(), $PipeTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeTypes_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_edit->Department_Idn->caption(), $PipeTypes_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeTypes_edit->IsUnderground->Required) { ?>
				elm = this.getElements("x" + infix + "_IsUnderground[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_edit->IsUnderground->caption(), $PipeTypes_edit->IsUnderground->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_edit->Rank->caption(), $PipeTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PipeTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($PipeTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_edit->ActiveFlag->caption(), $PipeTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fPipeTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPipeTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fPipeTypesedit.lists["x_Department_Idn"] = <?php echo $PipeTypes_edit->Department_Idn->Lookup->toClientList($PipeTypes_edit) ?>;
	fPipeTypesedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($PipeTypes_edit->Department_Idn->lookupOptions()) ?>;
	fPipeTypesedit.lists["x_IsUnderground[]"] = <?php echo $PipeTypes_edit->IsUnderground->Lookup->toClientList($PipeTypes_edit) ?>;
	fPipeTypesedit.lists["x_IsUnderground[]"].options = <?php echo JsonEncode($PipeTypes_edit->IsUnderground->options(FALSE, TRUE)) ?>;
	fPipeTypesedit.lists["x_ActiveFlag[]"] = <?php echo $PipeTypes_edit->ActiveFlag->Lookup->toClientList($PipeTypes_edit) ?>;
	fPipeTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($PipeTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fPipeTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $PipeTypes_edit->showPageHeader(); ?>
<?php
$PipeTypes_edit->showMessage();
?>
<?php if (!$PipeTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PipeTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fPipeTypesedit" id="fPipeTypesedit" class="<?php echo $PipeTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$PipeTypes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($PipeTypes_edit->PipeType_Idn->Visible) { // PipeType_Idn ?>
	<div id="r_PipeType_Idn" class="form-group row">
		<label id="elh_PipeTypes_PipeType_Idn" class="<?php echo $PipeTypes_edit->LeftColumnClass ?>"><?php echo $PipeTypes_edit->PipeType_Idn->caption() ?><?php echo $PipeTypes_edit->PipeType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeTypes_edit->RightColumnClass ?>"><div <?php echo $PipeTypes_edit->PipeType_Idn->cellAttributes() ?>>
<span id="el_PipeTypes_PipeType_Idn">
<span<?php echo $PipeTypes_edit->PipeType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($PipeTypes_edit->PipeType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_PipeType_Idn" name="x_PipeType_Idn" id="x_PipeType_Idn" value="<?php echo HtmlEncode($PipeTypes_edit->PipeType_Idn->CurrentValue) ?>">
<?php echo $PipeTypes_edit->PipeType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_PipeTypes_Name" for="x_Name" class="<?php echo $PipeTypes_edit->LeftColumnClass ?>"><?php echo $PipeTypes_edit->Name->caption() ?><?php echo $PipeTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeTypes_edit->RightColumnClass ?>"><div <?php echo $PipeTypes_edit->Name->cellAttributes() ?>>
<span id="el_PipeTypes_Name">
<input type="text" data-table="PipeTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_edit->Name->EditValue ?>"<?php echo $PipeTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $PipeTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeTypes_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_PipeTypes_Department_Idn" for="x_Department_Idn" class="<?php echo $PipeTypes_edit->LeftColumnClass ?>"><?php echo $PipeTypes_edit->Department_Idn->caption() ?><?php echo $PipeTypes_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeTypes_edit->RightColumnClass ?>"><div <?php echo $PipeTypes_edit->Department_Idn->cellAttributes() ?>>
<span id="el_PipeTypes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="PipeTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $PipeTypes_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $PipeTypes_edit->Department_Idn->editAttributes() ?>>
			<?php echo $PipeTypes_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $PipeTypes_edit->Department_Idn->Lookup->getParamTag($PipeTypes_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $PipeTypes_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeTypes_edit->IsUnderground->Visible) { // IsUnderground ?>
	<div id="r_IsUnderground" class="form-group row">
		<label id="elh_PipeTypes_IsUnderground" class="<?php echo $PipeTypes_edit->LeftColumnClass ?>"><?php echo $PipeTypes_edit->IsUnderground->caption() ?><?php echo $PipeTypes_edit->IsUnderground->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeTypes_edit->RightColumnClass ?>"><div <?php echo $PipeTypes_edit->IsUnderground->cellAttributes() ?>>
<span id="el_PipeTypes_IsUnderground">
<?php
$selwrk = ConvertToBool($PipeTypes_edit->IsUnderground->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_IsUnderground" name="x_IsUnderground[]" id="x_IsUnderground[]_773464" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_edit->IsUnderground->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsUnderground[]_773464"></label>
</div>
</span>
<?php echo $PipeTypes_edit->IsUnderground->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_PipeTypes_Rank" for="x_Rank" class="<?php echo $PipeTypes_edit->LeftColumnClass ?>"><?php echo $PipeTypes_edit->Rank->caption() ?><?php echo $PipeTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeTypes_edit->RightColumnClass ?>"><div <?php echo $PipeTypes_edit->Rank->cellAttributes() ?>>
<span id="el_PipeTypes_Rank">
<input type="text" data-table="PipeTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_edit->Rank->EditValue ?>"<?php echo $PipeTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $PipeTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_PipeTypes_ActiveFlag" class="<?php echo $PipeTypes_edit->LeftColumnClass ?>"><?php echo $PipeTypes_edit->ActiveFlag->caption() ?><?php echo $PipeTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeTypes_edit->RightColumnClass ?>"><div <?php echo $PipeTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_PipeTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($PipeTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_200560" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_200560"></label>
</div>
</span>
<?php echo $PipeTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$PipeTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $PipeTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $PipeTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$PipeTypes_edit->IsModal) { ?>
<?php echo $PipeTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$PipeTypes_edit->showPageFooter();
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
$PipeTypes_edit->terminate();
?>