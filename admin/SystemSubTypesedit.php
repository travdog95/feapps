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
$SystemSubTypes_edit = new SystemSubTypes_edit();

// Run the page
$SystemSubTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SystemSubTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fSystemSubTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fSystemSubTypesedit = currentForm = new ew.Form("fSystemSubTypesedit", "edit");

	// Validate form
	fSystemSubTypesedit.validate = function() {
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
			<?php if ($SystemSubTypes_edit->SystemSubType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SystemSubType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_edit->SystemSubType_Idn->caption(), $SystemSubTypes_edit->SystemSubType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemSubTypes_edit->SystemType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SystemType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_edit->SystemType_Idn->caption(), $SystemSubTypes_edit->SystemType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemSubTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_edit->Name->caption(), $SystemSubTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemSubTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_edit->Rank->caption(), $SystemSubTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($SystemSubTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($SystemSubTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_edit->ActiveFlag->caption(), $SystemSubTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fSystemSubTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fSystemSubTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fSystemSubTypesedit.lists["x_SystemType_Idn"] = <?php echo $SystemSubTypes_edit->SystemType_Idn->Lookup->toClientList($SystemSubTypes_edit) ?>;
	fSystemSubTypesedit.lists["x_SystemType_Idn"].options = <?php echo JsonEncode($SystemSubTypes_edit->SystemType_Idn->lookupOptions()) ?>;
	fSystemSubTypesedit.lists["x_ActiveFlag[]"] = <?php echo $SystemSubTypes_edit->ActiveFlag->Lookup->toClientList($SystemSubTypes_edit) ?>;
	fSystemSubTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($SystemSubTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fSystemSubTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $SystemSubTypes_edit->showPageHeader(); ?>
<?php
$SystemSubTypes_edit->showMessage();
?>
<?php if (!$SystemSubTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $SystemSubTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fSystemSubTypesedit" id="fSystemSubTypesedit" class="<?php echo $SystemSubTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SystemSubTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$SystemSubTypes_edit->IsModal ?>">
<?php if ($SystemSubTypes->getCurrentMasterTable() == "SystemTypes") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="SystemTypes">
<input type="hidden" name="fk_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_edit->SystemSubType_Idn->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($SystemSubTypes_edit->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
	<div id="r_SystemSubType_Idn" class="form-group row">
		<label id="elh_SystemSubTypes_SystemSubType_Idn" class="<?php echo $SystemSubTypes_edit->LeftColumnClass ?>"><?php echo $SystemSubTypes_edit->SystemSubType_Idn->caption() ?><?php echo $SystemSubTypes_edit->SystemSubType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemSubTypes_edit->RightColumnClass ?>"><div <?php echo $SystemSubTypes_edit->SystemSubType_Idn->cellAttributes() ?>>
<span id="el_SystemSubTypes_SystemSubType_Idn">
<span<?php echo $SystemSubTypes_edit->SystemSubType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($SystemSubTypes_edit->SystemSubType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="x_SystemSubType_Idn" id="x_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_edit->SystemSubType_Idn->CurrentValue) ?>">
<?php echo $SystemSubTypes_edit->SystemSubType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SystemSubTypes_edit->SystemType_Idn->Visible) { // SystemType_Idn ?>
	<div id="r_SystemType_Idn" class="form-group row">
		<label id="elh_SystemSubTypes_SystemType_Idn" for="x_SystemType_Idn" class="<?php echo $SystemSubTypes_edit->LeftColumnClass ?>"><?php echo $SystemSubTypes_edit->SystemType_Idn->caption() ?><?php echo $SystemSubTypes_edit->SystemType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemSubTypes_edit->RightColumnClass ?>"><div <?php echo $SystemSubTypes_edit->SystemType_Idn->cellAttributes() ?>>
<span id="el_SystemSubTypes_SystemType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemSubTypes" data-field="x_SystemType_Idn" data-value-separator="<?php echo $SystemSubTypes_edit->SystemType_Idn->displayValueSeparatorAttribute() ?>" id="x_SystemType_Idn" name="x_SystemType_Idn"<?php echo $SystemSubTypes_edit->SystemType_Idn->editAttributes() ?>>
			<?php echo $SystemSubTypes_edit->SystemType_Idn->selectOptionListHtml("x_SystemType_Idn") ?>
		</select>
</div>
<?php echo $SystemSubTypes_edit->SystemType_Idn->Lookup->getParamTag($SystemSubTypes_edit, "p_x_SystemType_Idn") ?>
</span>
<?php echo $SystemSubTypes_edit->SystemType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SystemSubTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_SystemSubTypes_Name" for="x_Name" class="<?php echo $SystemSubTypes_edit->LeftColumnClass ?>"><?php echo $SystemSubTypes_edit->Name->caption() ?><?php echo $SystemSubTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemSubTypes_edit->RightColumnClass ?>"><div <?php echo $SystemSubTypes_edit->Name->cellAttributes() ?>>
<span id="el_SystemSubTypes_Name">
<input type="text" data-table="SystemSubTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemSubTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_edit->Name->EditValue ?>"<?php echo $SystemSubTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $SystemSubTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SystemSubTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_SystemSubTypes_Rank" for="x_Rank" class="<?php echo $SystemSubTypes_edit->LeftColumnClass ?>"><?php echo $SystemSubTypes_edit->Rank->caption() ?><?php echo $SystemSubTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemSubTypes_edit->RightColumnClass ?>"><div <?php echo $SystemSubTypes_edit->Rank->cellAttributes() ?>>
<span id="el_SystemSubTypes_Rank">
<input type="text" data-table="SystemSubTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemSubTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_edit->Rank->EditValue ?>"<?php echo $SystemSubTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $SystemSubTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SystemSubTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_SystemSubTypes_ActiveFlag" class="<?php echo $SystemSubTypes_edit->LeftColumnClass ?>"><?php echo $SystemSubTypes_edit->ActiveFlag->caption() ?><?php echo $SystemSubTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemSubTypes_edit->RightColumnClass ?>"><div <?php echo $SystemSubTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_SystemSubTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($SystemSubTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_311420" value="1"<?php echo $selwrk ?><?php echo $SystemSubTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_311420"></label>
</div>
</span>
<?php echo $SystemSubTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$SystemSubTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $SystemSubTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $SystemSubTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$SystemSubTypes_edit->IsModal) { ?>
<?php echo $SystemSubTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$SystemSubTypes_edit->showPageFooter();
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
$SystemSubTypes_edit->terminate();
?>