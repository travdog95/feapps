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
$RecapRows_add = new RecapRows_add();

// Run the page
$RecapRows_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapRows_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapRowsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fRecapRowsadd = currentForm = new ew.Form("fRecapRowsadd", "add");

	// Validate form
	fRecapRowsadd.validate = function() {
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
			<?php if ($RecapRows_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_add->Name->caption(), $RecapRows_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_add->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_add->Department_Idn->caption(), $RecapRows_add->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_add->CalcShopFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_CalcShopFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_add->CalcShopFlag->caption(), $RecapRows_add->CalcShopFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_add->IsWorksheetFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_IsWorksheetFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_add->IsWorksheetFlag->caption(), $RecapRows_add->IsWorksheetFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_add->DisplayFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_add->DisplayFlag->caption(), $RecapRows_add->DisplayFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_add->Rank->caption(), $RecapRows_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapRows_add->Rank->errorMessage()) ?>");
			<?php if ($RecapRows_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_add->ActiveFlag->caption(), $RecapRows_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fRecapRowsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapRowsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRecapRowsadd.lists["x_Department_Idn"] = <?php echo $RecapRows_add->Department_Idn->Lookup->toClientList($RecapRows_add) ?>;
	fRecapRowsadd.lists["x_Department_Idn"].options = <?php echo JsonEncode($RecapRows_add->Department_Idn->lookupOptions()) ?>;
	fRecapRowsadd.lists["x_CalcShopFlag[]"] = <?php echo $RecapRows_add->CalcShopFlag->Lookup->toClientList($RecapRows_add) ?>;
	fRecapRowsadd.lists["x_CalcShopFlag[]"].options = <?php echo JsonEncode($RecapRows_add->CalcShopFlag->options(FALSE, TRUE)) ?>;
	fRecapRowsadd.lists["x_IsWorksheetFlag[]"] = <?php echo $RecapRows_add->IsWorksheetFlag->Lookup->toClientList($RecapRows_add) ?>;
	fRecapRowsadd.lists["x_IsWorksheetFlag[]"].options = <?php echo JsonEncode($RecapRows_add->IsWorksheetFlag->options(FALSE, TRUE)) ?>;
	fRecapRowsadd.lists["x_DisplayFlag[]"] = <?php echo $RecapRows_add->DisplayFlag->Lookup->toClientList($RecapRows_add) ?>;
	fRecapRowsadd.lists["x_DisplayFlag[]"].options = <?php echo JsonEncode($RecapRows_add->DisplayFlag->options(FALSE, TRUE)) ?>;
	fRecapRowsadd.lists["x_ActiveFlag[]"] = <?php echo $RecapRows_add->ActiveFlag->Lookup->toClientList($RecapRows_add) ?>;
	fRecapRowsadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($RecapRows_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fRecapRowsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapRows_add->showPageHeader(); ?>
<?php
$RecapRows_add->showMessage();
?>
<form name="fRecapRowsadd" id="fRecapRowsadd" class="<?php echo $RecapRows_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapRows">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$RecapRows_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($RecapRows_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_RecapRows_Name" for="x_Name" class="<?php echo $RecapRows_add->LeftColumnClass ?>"><?php echo $RecapRows_add->Name->caption() ?><?php echo $RecapRows_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_add->RightColumnClass ?>"><div <?php echo $RecapRows_add->Name->cellAttributes() ?>>
<span id="el_RecapRows_Name">
<input type="text" data-table="RecapRows" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapRows_add->Name->getPlaceHolder()) ?>" value="<?php echo $RecapRows_add->Name->EditValue ?>"<?php echo $RecapRows_add->Name->editAttributes() ?>>
</span>
<?php echo $RecapRows_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_add->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_RecapRows_Department_Idn" for="x_Department_Idn" class="<?php echo $RecapRows_add->LeftColumnClass ?>"><?php echo $RecapRows_add->Department_Idn->caption() ?><?php echo $RecapRows_add->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_add->RightColumnClass ?>"><div <?php echo $RecapRows_add->Department_Idn->cellAttributes() ?>>
<span id="el_RecapRows_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRows" data-field="x_Department_Idn" data-value-separator="<?php echo $RecapRows_add->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $RecapRows_add->Department_Idn->editAttributes() ?>>
			<?php echo $RecapRows_add->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $RecapRows_add->Department_Idn->Lookup->getParamTag($RecapRows_add, "p_x_Department_Idn") ?>
</span>
<?php echo $RecapRows_add->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_add->CalcShopFlag->Visible) { // CalcShopFlag ?>
	<div id="r_CalcShopFlag" class="form-group row">
		<label id="elh_RecapRows_CalcShopFlag" class="<?php echo $RecapRows_add->LeftColumnClass ?>"><?php echo $RecapRows_add->CalcShopFlag->caption() ?><?php echo $RecapRows_add->CalcShopFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_add->RightColumnClass ?>"><div <?php echo $RecapRows_add->CalcShopFlag->cellAttributes() ?>>
<span id="el_RecapRows_CalcShopFlag">
<?php
$selwrk = ConvertToBool($RecapRows_add->CalcShopFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_CalcShopFlag" name="x_CalcShopFlag[]" id="x_CalcShopFlag[]_340581" value="1"<?php echo $selwrk ?><?php echo $RecapRows_add->CalcShopFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_CalcShopFlag[]_340581"></label>
</div>
</span>
<?php echo $RecapRows_add->CalcShopFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_add->IsWorksheetFlag->Visible) { // IsWorksheetFlag ?>
	<div id="r_IsWorksheetFlag" class="form-group row">
		<label id="elh_RecapRows_IsWorksheetFlag" class="<?php echo $RecapRows_add->LeftColumnClass ?>"><?php echo $RecapRows_add->IsWorksheetFlag->caption() ?><?php echo $RecapRows_add->IsWorksheetFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_add->RightColumnClass ?>"><div <?php echo $RecapRows_add->IsWorksheetFlag->cellAttributes() ?>>
<span id="el_RecapRows_IsWorksheetFlag">
<?php
$selwrk = ConvertToBool($RecapRows_add->IsWorksheetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_IsWorksheetFlag" name="x_IsWorksheetFlag[]" id="x_IsWorksheetFlag[]_468287" value="1"<?php echo $selwrk ?><?php echo $RecapRows_add->IsWorksheetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsWorksheetFlag[]_468287"></label>
</div>
</span>
<?php echo $RecapRows_add->IsWorksheetFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_add->DisplayFlag->Visible) { // DisplayFlag ?>
	<div id="r_DisplayFlag" class="form-group row">
		<label id="elh_RecapRows_DisplayFlag" class="<?php echo $RecapRows_add->LeftColumnClass ?>"><?php echo $RecapRows_add->DisplayFlag->caption() ?><?php echo $RecapRows_add->DisplayFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_add->RightColumnClass ?>"><div <?php echo $RecapRows_add->DisplayFlag->cellAttributes() ?>>
<span id="el_RecapRows_DisplayFlag">
<?php
$selwrk = ConvertToBool($RecapRows_add->DisplayFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_DisplayFlag" name="x_DisplayFlag[]" id="x_DisplayFlag[]_554507" value="1"<?php echo $selwrk ?><?php echo $RecapRows_add->DisplayFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayFlag[]_554507"></label>
</div>
</span>
<?php echo $RecapRows_add->DisplayFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_RecapRows_Rank" for="x_Rank" class="<?php echo $RecapRows_add->LeftColumnClass ?>"><?php echo $RecapRows_add->Rank->caption() ?><?php echo $RecapRows_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_add->RightColumnClass ?>"><div <?php echo $RecapRows_add->Rank->cellAttributes() ?>>
<span id="el_RecapRows_Rank">
<input type="text" data-table="RecapRows" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapRows_add->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapRows_add->Rank->EditValue ?>"<?php echo $RecapRows_add->Rank->editAttributes() ?>>
</span>
<?php echo $RecapRows_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRows_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_RecapRows_ActiveFlag" class="<?php echo $RecapRows_add->LeftColumnClass ?>"><?php echo $RecapRows_add->ActiveFlag->caption() ?><?php echo $RecapRows_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRows_add->RightColumnClass ?>"><div <?php echo $RecapRows_add->ActiveFlag->cellAttributes() ?>>
<span id="el_RecapRows_ActiveFlag">
<?php
$selwrk = ConvertToBool($RecapRows_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_478366" value="1"<?php echo $selwrk ?><?php echo $RecapRows_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_478366"></label>
</div>
</span>
<?php echo $RecapRows_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$RecapRows_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $RecapRows_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapRows_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$RecapRows_add->showPageFooter();
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
$RecapRows_add->terminate();
?>