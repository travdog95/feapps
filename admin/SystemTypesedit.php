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
$SystemTypes_edit = new SystemTypes_edit();

// Run the page
$SystemTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SystemTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fSystemTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fSystemTypesedit = currentForm = new ew.Form("fSystemTypesedit", "edit");

	// Validate form
	fSystemTypesedit.validate = function() {
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
			<?php if ($SystemTypes_edit->SystemType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SystemType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemTypes_edit->SystemType_Idn->caption(), $SystemTypes_edit->SystemType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemTypes_edit->Name->caption(), $SystemTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemTypes_edit->Rank->caption(), $SystemTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($SystemTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($SystemTypes_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemTypes_edit->Department_Idn->caption(), $SystemTypes_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemTypes_edit->ActiveFlag->caption(), $SystemTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fSystemTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fSystemTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fSystemTypesedit.lists["x_Department_Idn"] = <?php echo $SystemTypes_edit->Department_Idn->Lookup->toClientList($SystemTypes_edit) ?>;
	fSystemTypesedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($SystemTypes_edit->Department_Idn->lookupOptions()) ?>;
	fSystemTypesedit.lists["x_ActiveFlag[]"] = <?php echo $SystemTypes_edit->ActiveFlag->Lookup->toClientList($SystemTypes_edit) ?>;
	fSystemTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($SystemTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fSystemTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $SystemTypes_edit->showPageHeader(); ?>
<?php
$SystemTypes_edit->showMessage();
?>
<?php if (!$SystemTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $SystemTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fSystemTypesedit" id="fSystemTypesedit" class="<?php echo $SystemTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SystemTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$SystemTypes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($SystemTypes_edit->SystemType_Idn->Visible) { // SystemType_Idn ?>
	<div id="r_SystemType_Idn" class="form-group row">
		<label id="elh_SystemTypes_SystemType_Idn" class="<?php echo $SystemTypes_edit->LeftColumnClass ?>"><?php echo $SystemTypes_edit->SystemType_Idn->caption() ?><?php echo $SystemTypes_edit->SystemType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemTypes_edit->RightColumnClass ?>"><div <?php echo $SystemTypes_edit->SystemType_Idn->cellAttributes() ?>>
<span id="el_SystemTypes_SystemType_Idn">
<span<?php echo $SystemTypes_edit->SystemType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($SystemTypes_edit->SystemType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_SystemType_Idn" name="x_SystemType_Idn" id="x_SystemType_Idn" value="<?php echo HtmlEncode($SystemTypes_edit->SystemType_Idn->CurrentValue) ?>">
<?php echo $SystemTypes_edit->SystemType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SystemTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_SystemTypes_Name" for="x_Name" class="<?php echo $SystemTypes_edit->LeftColumnClass ?>"><?php echo $SystemTypes_edit->Name->caption() ?><?php echo $SystemTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemTypes_edit->RightColumnClass ?>"><div <?php echo $SystemTypes_edit->Name->cellAttributes() ?>>
<span id="el_SystemTypes_Name">
<input type="text" data-table="SystemTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $SystemTypes_edit->Name->EditValue ?>"<?php echo $SystemTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $SystemTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SystemTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_SystemTypes_Rank" for="x_Rank" class="<?php echo $SystemTypes_edit->LeftColumnClass ?>"><?php echo $SystemTypes_edit->Rank->caption() ?><?php echo $SystemTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemTypes_edit->RightColumnClass ?>"><div <?php echo $SystemTypes_edit->Rank->cellAttributes() ?>>
<span id="el_SystemTypes_Rank">
<input type="text" data-table="SystemTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemTypes_edit->Rank->EditValue ?>"<?php echo $SystemTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $SystemTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SystemTypes_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_SystemTypes_Department_Idn" for="x_Department_Idn" class="<?php echo $SystemTypes_edit->LeftColumnClass ?>"><?php echo $SystemTypes_edit->Department_Idn->caption() ?><?php echo $SystemTypes_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemTypes_edit->RightColumnClass ?>"><div <?php echo $SystemTypes_edit->Department_Idn->cellAttributes() ?>>
<span id="el_SystemTypes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $SystemTypes_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $SystemTypes_edit->Department_Idn->editAttributes() ?>>
			<?php echo $SystemTypes_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $SystemTypes_edit->Department_Idn->Lookup->getParamTag($SystemTypes_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $SystemTypes_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SystemTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_SystemTypes_ActiveFlag" class="<?php echo $SystemTypes_edit->LeftColumnClass ?>"><?php echo $SystemTypes_edit->ActiveFlag->caption() ?><?php echo $SystemTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $SystemTypes_edit->RightColumnClass ?>"><div <?php echo $SystemTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_SystemTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($SystemTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_926765" value="1"<?php echo $selwrk ?><?php echo $SystemTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_926765"></label>
</div>
</span>
<?php echo $SystemTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("SystemSubTypes", explode(",", $SystemTypes->getCurrentDetailTable())) && $SystemSubTypes->DetailEdit) {
?>
<?php if ($SystemTypes->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("SystemSubTypes", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "SystemSubTypesgrid.php" ?>
<?php } ?>
<?php if (!$SystemTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $SystemTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $SystemTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$SystemTypes_edit->IsModal) { ?>
<?php echo $SystemTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$SystemTypes_edit->showPageFooter();
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
$SystemTypes_edit->terminate();
?>