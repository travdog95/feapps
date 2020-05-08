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
$HangerSubTypes_add = new HangerSubTypes_add();

// Run the page
$HangerSubTypes_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HangerSubTypes_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fHangerSubTypesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fHangerSubTypesadd = currentForm = new ew.Form("fHangerSubTypesadd", "add");

	// Validate form
	fHangerSubTypesadd.validate = function() {
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
			<?php if ($HangerSubTypes_add->HangerType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_add->HangerType_Idn->caption(), $HangerSubTypes_add->HangerType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HangerSubTypes_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_add->Name->caption(), $HangerSubTypes_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HangerSubTypes_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_add->Rank->caption(), $HangerSubTypes_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($HangerSubTypes_add->Rank->errorMessage()) ?>");
			<?php if ($HangerSubTypes_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_add->ActiveFlag->caption(), $HangerSubTypes_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fHangerSubTypesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fHangerSubTypesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fHangerSubTypesadd.lists["x_HangerType_Idn"] = <?php echo $HangerSubTypes_add->HangerType_Idn->Lookup->toClientList($HangerSubTypes_add) ?>;
	fHangerSubTypesadd.lists["x_HangerType_Idn"].options = <?php echo JsonEncode($HangerSubTypes_add->HangerType_Idn->lookupOptions()) ?>;
	fHangerSubTypesadd.lists["x_ActiveFlag[]"] = <?php echo $HangerSubTypes_add->ActiveFlag->Lookup->toClientList($HangerSubTypes_add) ?>;
	fHangerSubTypesadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($HangerSubTypes_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fHangerSubTypesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $HangerSubTypes_add->showPageHeader(); ?>
<?php
$HangerSubTypes_add->showMessage();
?>
<form name="fHangerSubTypesadd" id="fHangerSubTypesadd" class="<?php echo $HangerSubTypes_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="HangerSubTypes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$HangerSubTypes_add->IsModal ?>">
<?php if ($HangerSubTypes->getCurrentMasterTable() == "HangerTypes") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="HangerTypes">
<input type="hidden" name="fk_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_add->HangerType_Idn->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($HangerSubTypes_add->HangerType_Idn->Visible) { // HangerType_Idn ?>
	<div id="r_HangerType_Idn" class="form-group row">
		<label id="elh_HangerSubTypes_HangerType_Idn" for="x_HangerType_Idn" class="<?php echo $HangerSubTypes_add->LeftColumnClass ?>"><?php echo $HangerSubTypes_add->HangerType_Idn->caption() ?><?php echo $HangerSubTypes_add->HangerType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $HangerSubTypes_add->RightColumnClass ?>"><div <?php echo $HangerSubTypes_add->HangerType_Idn->cellAttributes() ?>>
<?php if ($HangerSubTypes_add->HangerType_Idn->getSessionValue() != "") { ?>
<span id="el_HangerSubTypes_HangerType_Idn">
<span<?php echo $HangerSubTypes_add->HangerType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_add->HangerType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_HangerType_Idn" name="x_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_add->HangerType_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el_HangerSubTypes_HangerType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="HangerSubTypes" data-field="x_HangerType_Idn" data-value-separator="<?php echo $HangerSubTypes_add->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x_HangerType_Idn" name="x_HangerType_Idn"<?php echo $HangerSubTypes_add->HangerType_Idn->editAttributes() ?>>
			<?php echo $HangerSubTypes_add->HangerType_Idn->selectOptionListHtml("x_HangerType_Idn") ?>
		</select>
</div>
<?php echo $HangerSubTypes_add->HangerType_Idn->Lookup->getParamTag($HangerSubTypes_add, "p_x_HangerType_Idn") ?>
</span>
<?php } ?>
<?php echo $HangerSubTypes_add->HangerType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($HangerSubTypes_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_HangerSubTypes_Name" for="x_Name" class="<?php echo $HangerSubTypes_add->LeftColumnClass ?>"><?php echo $HangerSubTypes_add->Name->caption() ?><?php echo $HangerSubTypes_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $HangerSubTypes_add->RightColumnClass ?>"><div <?php echo $HangerSubTypes_add->Name->cellAttributes() ?>>
<span id="el_HangerSubTypes_Name">
<input type="text" data-table="HangerSubTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerSubTypes_add->Name->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_add->Name->EditValue ?>"<?php echo $HangerSubTypes_add->Name->editAttributes() ?>>
</span>
<?php echo $HangerSubTypes_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($HangerSubTypes_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_HangerSubTypes_Rank" for="x_Rank" class="<?php echo $HangerSubTypes_add->LeftColumnClass ?>"><?php echo $HangerSubTypes_add->Rank->caption() ?><?php echo $HangerSubTypes_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $HangerSubTypes_add->RightColumnClass ?>"><div <?php echo $HangerSubTypes_add->Rank->cellAttributes() ?>>
<span id="el_HangerSubTypes_Rank">
<input type="text" data-table="HangerSubTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerSubTypes_add->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_add->Rank->EditValue ?>"<?php echo $HangerSubTypes_add->Rank->editAttributes() ?>>
</span>
<?php echo $HangerSubTypes_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($HangerSubTypes_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_HangerSubTypes_ActiveFlag" class="<?php echo $HangerSubTypes_add->LeftColumnClass ?>"><?php echo $HangerSubTypes_add->ActiveFlag->caption() ?><?php echo $HangerSubTypes_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $HangerSubTypes_add->RightColumnClass ?>"><div <?php echo $HangerSubTypes_add->ActiveFlag->cellAttributes() ?>>
<span id="el_HangerSubTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($HangerSubTypes_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_332140" value="1"<?php echo $selwrk ?><?php echo $HangerSubTypes_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_332140"></label>
</div>
</span>
<?php echo $HangerSubTypes_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$HangerSubTypes_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $HangerSubTypes_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $HangerSubTypes_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$HangerSubTypes_add->showPageFooter();
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
$HangerSubTypes_add->terminate();
?>