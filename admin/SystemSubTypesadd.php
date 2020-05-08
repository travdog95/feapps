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
$SystemSubTypes_add = new SystemSubTypes_add();

// Run the page
$SystemSubTypes_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SystemSubTypes_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fSystemSubTypesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fSystemSubTypesadd = currentForm = new ew.Form("fSystemSubTypesadd", "add");

	// Validate form
	fSystemSubTypesadd.validate = function() {
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
			<?php if ($SystemSubTypes_add->SystemType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SystemType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_add->SystemType_Idn->caption(), $SystemSubTypes_add->SystemType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemSubTypes_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_add->Name->caption(), $SystemSubTypes_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemSubTypes_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_add->Rank->caption(), $SystemSubTypes_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($SystemSubTypes_add->Rank->errorMessage()) ?>");
			<?php if ($SystemSubTypes_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_add->ActiveFlag->caption(), $SystemSubTypes_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fSystemSubTypesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fSystemSubTypesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fSystemSubTypesadd.lists["x_SystemType_Idn"] = <?php echo $SystemSubTypes_add->SystemType_Idn->Lookup->toClientList($SystemSubTypes_add) ?>;
	fSystemSubTypesadd.lists["x_SystemType_Idn"].options = <?php echo JsonEncode($SystemSubTypes_add->SystemType_Idn->lookupOptions()) ?>;
	fSystemSubTypesadd.lists["x_ActiveFlag[]"] = <?php echo $SystemSubTypes_add->ActiveFlag->Lookup->toClientList($SystemSubTypes_add) ?>;
	fSystemSubTypesadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($SystemSubTypes_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fSystemSubTypesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $SystemSubTypes_add->showPageHeader(); ?>
<?php
$SystemSubTypes_add->showMessage();
?>
<form name="fSystemSubTypesadd" id="fSystemSubTypesadd" class="<?php echo $SystemSubTypes_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SystemSubTypes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$SystemSubTypes_add->IsModal ?>">
<?php if ($SystemSubTypes->getCurrentMasterTable() == "SystemTypes") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="SystemTypes">
<input type="hidden" name="fk_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_add->SystemSubType_Idn->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($SystemSubTypes_add->SystemType_Idn->Visible) { // SystemType_Idn ?>
	<div id="r_SystemType_Idn" class="form-group row">
		<label id="elh_SystemSubTypes_SystemType_Idn" for="x_SystemType_Idn" class="<?php echo $SystemSubTypes_add->LeftColumnClass ?>"><?php echo $SystemSubTypes_add->SystemType_Idn->caption() ?><?php echo $SystemSubTypes_add->SystemType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemSubTypes_add->RightColumnClass ?>"><div <?php echo $SystemSubTypes_add->SystemType_Idn->cellAttributes() ?>>
<span id="el_SystemSubTypes_SystemType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemSubTypes" data-field="x_SystemType_Idn" data-value-separator="<?php echo $SystemSubTypes_add->SystemType_Idn->displayValueSeparatorAttribute() ?>" id="x_SystemType_Idn" name="x_SystemType_Idn"<?php echo $SystemSubTypes_add->SystemType_Idn->editAttributes() ?>>
			<?php echo $SystemSubTypes_add->SystemType_Idn->selectOptionListHtml("x_SystemType_Idn") ?>
		</select>
</div>
<?php echo $SystemSubTypes_add->SystemType_Idn->Lookup->getParamTag($SystemSubTypes_add, "p_x_SystemType_Idn") ?>
</span>
<?php echo $SystemSubTypes_add->SystemType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SystemSubTypes_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_SystemSubTypes_Name" for="x_Name" class="<?php echo $SystemSubTypes_add->LeftColumnClass ?>"><?php echo $SystemSubTypes_add->Name->caption() ?><?php echo $SystemSubTypes_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemSubTypes_add->RightColumnClass ?>"><div <?php echo $SystemSubTypes_add->Name->cellAttributes() ?>>
<span id="el_SystemSubTypes_Name">
<input type="text" data-table="SystemSubTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemSubTypes_add->Name->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_add->Name->EditValue ?>"<?php echo $SystemSubTypes_add->Name->editAttributes() ?>>
</span>
<?php echo $SystemSubTypes_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SystemSubTypes_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_SystemSubTypes_Rank" for="x_Rank" class="<?php echo $SystemSubTypes_add->LeftColumnClass ?>"><?php echo $SystemSubTypes_add->Rank->caption() ?><?php echo $SystemSubTypes_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemSubTypes_add->RightColumnClass ?>"><div <?php echo $SystemSubTypes_add->Rank->cellAttributes() ?>>
<span id="el_SystemSubTypes_Rank">
<input type="text" data-table="SystemSubTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemSubTypes_add->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_add->Rank->EditValue ?>"<?php echo $SystemSubTypes_add->Rank->editAttributes() ?>>
</span>
<?php echo $SystemSubTypes_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SystemSubTypes_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_SystemSubTypes_ActiveFlag" class="<?php echo $SystemSubTypes_add->LeftColumnClass ?>"><?php echo $SystemSubTypes_add->ActiveFlag->caption() ?><?php echo $SystemSubTypes_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemSubTypes_add->RightColumnClass ?>"><div <?php echo $SystemSubTypes_add->ActiveFlag->cellAttributes() ?>>
<span id="el_SystemSubTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($SystemSubTypes_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_326340" value="1"<?php echo $selwrk ?><?php echo $SystemSubTypes_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_326340"></label>
</div>
</span>
<?php echo $SystemSubTypes_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($SystemSubTypes_add->SystemSubType_Idn->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_SystemSubType_Idn" id="x_SystemSubType_Idn" value="<?php echo HtmlEncode(strval($SystemSubTypes_add->SystemSubType_Idn->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$SystemSubTypes_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $SystemSubTypes_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $SystemSubTypes_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$SystemSubTypes_add->showPageFooter();
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
$SystemSubTypes_add->terminate();
?>