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
$RecapRows_edit = new RecapRows_edit();

// Run the page
$RecapRows_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapRows_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapRowsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fRecapRowsedit = currentForm = new ew.Form("fRecapRowsedit", "edit");

	// Validate form
	fRecapRowsedit.validate = function() {
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
			<?php if ($RecapRows_edit->RecapRow_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RecapRow_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_edit->RecapRow_Idn->caption(), $RecapRows_edit->RecapRow_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_edit->Name->caption(), $RecapRows_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_edit->Department_Idn->caption(), $RecapRows_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_edit->CalcShopFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_CalcShopFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_edit->CalcShopFlag->caption(), $RecapRows_edit->CalcShopFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_edit->IsWorksheetFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_IsWorksheetFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_edit->IsWorksheetFlag->caption(), $RecapRows_edit->IsWorksheetFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_edit->DisplayFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_edit->DisplayFlag->caption(), $RecapRows_edit->DisplayFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_edit->Rank->caption(), $RecapRows_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapRows_edit->Rank->errorMessage()) ?>");
			<?php if ($RecapRows_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_edit->ActiveFlag->caption(), $RecapRows_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fRecapRowsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapRowsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRecapRowsedit.lists["x_Department_Idn"] = <?php echo $RecapRows_edit->Department_Idn->Lookup->toClientList($RecapRows_edit) ?>;
	fRecapRowsedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($RecapRows_edit->Department_Idn->lookupOptions()) ?>;
	fRecapRowsedit.lists["x_CalcShopFlag[]"] = <?php echo $RecapRows_edit->CalcShopFlag->Lookup->toClientList($RecapRows_edit) ?>;
	fRecapRowsedit.lists["x_CalcShopFlag[]"].options = <?php echo JsonEncode($RecapRows_edit->CalcShopFlag->options(FALSE, TRUE)) ?>;
	fRecapRowsedit.lists["x_IsWorksheetFlag[]"] = <?php echo $RecapRows_edit->IsWorksheetFlag->Lookup->toClientList($RecapRows_edit) ?>;
	fRecapRowsedit.lists["x_IsWorksheetFlag[]"].options = <?php echo JsonEncode($RecapRows_edit->IsWorksheetFlag->options(FALSE, TRUE)) ?>;
	fRecapRowsedit.lists["x_DisplayFlag[]"] = <?php echo $RecapRows_edit->DisplayFlag->Lookup->toClientList($RecapRows_edit) ?>;
	fRecapRowsedit.lists["x_DisplayFlag[]"].options = <?php echo JsonEncode($RecapRows_edit->DisplayFlag->options(FALSE, TRUE)) ?>;
	fRecapRowsedit.lists["x_ActiveFlag[]"] = <?php echo $RecapRows_edit->ActiveFlag->Lookup->toClientList($RecapRows_edit) ?>;
	fRecapRowsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($RecapRows_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fRecapRowsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapRows_edit->showPageHeader(); ?>
<?php
$RecapRows_edit->showMessage();
?>
<?php if (!$RecapRows_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapRows_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fRecapRowsedit" id="fRecapRowsedit" class="<?php echo $RecapRows_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapRows">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$RecapRows_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($RecapRows_edit->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
	<div id="r_RecapRow_Idn" class="form-group row">
		<label id="elh_RecapRows_RecapRow_Idn" class="<?php echo $RecapRows_edit->LeftColumnClass ?>"><?php echo $RecapRows_edit->RecapRow_Idn->caption() ?><?php echo $RecapRows_edit->RecapRow_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_edit->RightColumnClass ?>"><div <?php echo $RecapRows_edit->RecapRow_Idn->cellAttributes() ?>>
<span id="el_RecapRows_RecapRow_Idn">
<span<?php echo $RecapRows_edit->RecapRow_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($RecapRows_edit->RecapRow_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_RecapRow_Idn" name="x_RecapRow_Idn" id="x_RecapRow_Idn" value="<?php echo HtmlEncode($RecapRows_edit->RecapRow_Idn->CurrentValue) ?>">
<?php echo $RecapRows_edit->RecapRow_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_RecapRows_Name" for="x_Name" class="<?php echo $RecapRows_edit->LeftColumnClass ?>"><?php echo $RecapRows_edit->Name->caption() ?><?php echo $RecapRows_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_edit->RightColumnClass ?>"><div <?php echo $RecapRows_edit->Name->cellAttributes() ?>>
<span id="el_RecapRows_Name">
<input type="text" data-table="RecapRows" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapRows_edit->Name->getPlaceHolder()) ?>" value="<?php echo $RecapRows_edit->Name->EditValue ?>"<?php echo $RecapRows_edit->Name->editAttributes() ?>>
</span>
<?php echo $RecapRows_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_RecapRows_Department_Idn" for="x_Department_Idn" class="<?php echo $RecapRows_edit->LeftColumnClass ?>"><?php echo $RecapRows_edit->Department_Idn->caption() ?><?php echo $RecapRows_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_edit->RightColumnClass ?>"><div <?php echo $RecapRows_edit->Department_Idn->cellAttributes() ?>>
<span id="el_RecapRows_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRows" data-field="x_Department_Idn" data-value-separator="<?php echo $RecapRows_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $RecapRows_edit->Department_Idn->editAttributes() ?>>
			<?php echo $RecapRows_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $RecapRows_edit->Department_Idn->Lookup->getParamTag($RecapRows_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $RecapRows_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_edit->CalcShopFlag->Visible) { // CalcShopFlag ?>
	<div id="r_CalcShopFlag" class="form-group row">
		<label id="elh_RecapRows_CalcShopFlag" class="<?php echo $RecapRows_edit->LeftColumnClass ?>"><?php echo $RecapRows_edit->CalcShopFlag->caption() ?><?php echo $RecapRows_edit->CalcShopFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_edit->RightColumnClass ?>"><div <?php echo $RecapRows_edit->CalcShopFlag->cellAttributes() ?>>
<span id="el_RecapRows_CalcShopFlag">
<?php
$selwrk = ConvertToBool($RecapRows_edit->CalcShopFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_CalcShopFlag" name="x_CalcShopFlag[]" id="x_CalcShopFlag[]_820490" value="1"<?php echo $selwrk ?><?php echo $RecapRows_edit->CalcShopFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_CalcShopFlag[]_820490"></label>
</div>
</span>
<?php echo $RecapRows_edit->CalcShopFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_edit->IsWorksheetFlag->Visible) { // IsWorksheetFlag ?>
	<div id="r_IsWorksheetFlag" class="form-group row">
		<label id="elh_RecapRows_IsWorksheetFlag" class="<?php echo $RecapRows_edit->LeftColumnClass ?>"><?php echo $RecapRows_edit->IsWorksheetFlag->caption() ?><?php echo $RecapRows_edit->IsWorksheetFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_edit->RightColumnClass ?>"><div <?php echo $RecapRows_edit->IsWorksheetFlag->cellAttributes() ?>>
<span id="el_RecapRows_IsWorksheetFlag">
<?php
$selwrk = ConvertToBool($RecapRows_edit->IsWorksheetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_IsWorksheetFlag" name="x_IsWorksheetFlag[]" id="x_IsWorksheetFlag[]_851534" value="1"<?php echo $selwrk ?><?php echo $RecapRows_edit->IsWorksheetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsWorksheetFlag[]_851534"></label>
</div>
</span>
<?php echo $RecapRows_edit->IsWorksheetFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_edit->DisplayFlag->Visible) { // DisplayFlag ?>
	<div id="r_DisplayFlag" class="form-group row">
		<label id="elh_RecapRows_DisplayFlag" class="<?php echo $RecapRows_edit->LeftColumnClass ?>"><?php echo $RecapRows_edit->DisplayFlag->caption() ?><?php echo $RecapRows_edit->DisplayFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_edit->RightColumnClass ?>"><div <?php echo $RecapRows_edit->DisplayFlag->cellAttributes() ?>>
<span id="el_RecapRows_DisplayFlag">
<?php
$selwrk = ConvertToBool($RecapRows_edit->DisplayFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_DisplayFlag" name="x_DisplayFlag[]" id="x_DisplayFlag[]_701594" value="1"<?php echo $selwrk ?><?php echo $RecapRows_edit->DisplayFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayFlag[]_701594"></label>
</div>
</span>
<?php echo $RecapRows_edit->DisplayFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_RecapRows_Rank" for="x_Rank" class="<?php echo $RecapRows_edit->LeftColumnClass ?>"><?php echo $RecapRows_edit->Rank->caption() ?><?php echo $RecapRows_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_edit->RightColumnClass ?>"><div <?php echo $RecapRows_edit->Rank->cellAttributes() ?>>
<span id="el_RecapRows_Rank">
<input type="text" data-table="RecapRows" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapRows_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapRows_edit->Rank->EditValue ?>"<?php echo $RecapRows_edit->Rank->editAttributes() ?>>
</span>
<?php echo $RecapRows_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_RecapRows_ActiveFlag" class="<?php echo $RecapRows_edit->LeftColumnClass ?>"><?php echo $RecapRows_edit->ActiveFlag->caption() ?><?php echo $RecapRows_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_edit->RightColumnClass ?>"><div <?php echo $RecapRows_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_RecapRows_ActiveFlag">
<?php
$selwrk = ConvertToBool($RecapRows_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_347196" value="1"<?php echo $selwrk ?><?php echo $RecapRows_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_347196"></label>
</div>
</span>
<?php echo $RecapRows_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$RecapRows_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $RecapRows_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapRows_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$RecapRows_edit->IsModal) { ?>
<?php echo $RecapRows_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$RecapRows_edit->showPageFooter();
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
$RecapRows_edit->terminate();
?>