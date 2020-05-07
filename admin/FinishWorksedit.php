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
$FinishWorks_edit = new FinishWorks_edit();

// Run the page
$FinishWorks_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FinishWorks_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fFinishWorksedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fFinishWorksedit = currentForm = new ew.Form("fFinishWorksedit", "edit");

	// Validate form
	fFinishWorksedit.validate = function() {
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
			<?php if ($FinishWorks_edit->FinishWork_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FinishWork_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishWorks_edit->FinishWork_Idn->caption(), $FinishWorks_edit->FinishWork_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FinishWorks_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishWorks_edit->Name->caption(), $FinishWorks_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FinishWorks_edit->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishWorks_edit->Value->caption(), $FinishWorks_edit->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($FinishWorks_edit->Value->errorMessage()) ?>");
			<?php if ($FinishWorks_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishWorks_edit->Rank->caption(), $FinishWorks_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($FinishWorks_edit->Rank->errorMessage()) ?>");
			<?php if ($FinishWorks_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishWorks_edit->ActiveFlag->caption(), $FinishWorks_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fFinishWorksedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fFinishWorksedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fFinishWorksedit.lists["x_ActiveFlag[]"] = <?php echo $FinishWorks_edit->ActiveFlag->Lookup->toClientList($FinishWorks_edit) ?>;
	fFinishWorksedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($FinishWorks_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fFinishWorksedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $FinishWorks_edit->showPageHeader(); ?>
<?php
$FinishWorks_edit->showMessage();
?>
<?php if (!$FinishWorks_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FinishWorks_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fFinishWorksedit" id="fFinishWorksedit" class="<?php echo $FinishWorks_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FinishWorks">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$FinishWorks_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($FinishWorks_edit->FinishWork_Idn->Visible) { // FinishWork_Idn ?>
	<div id="r_FinishWork_Idn" class="form-group row">
		<label id="elh_FinishWorks_FinishWork_Idn" class="<?php echo $FinishWorks_edit->LeftColumnClass ?>"><?php echo $FinishWorks_edit->FinishWork_Idn->caption() ?><?php echo $FinishWorks_edit->FinishWork_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FinishWorks_edit->RightColumnClass ?>"><div <?php echo $FinishWorks_edit->FinishWork_Idn->cellAttributes() ?>>
<span id="el_FinishWorks_FinishWork_Idn">
<span<?php echo $FinishWorks_edit->FinishWork_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($FinishWorks_edit->FinishWork_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_FinishWork_Idn" name="x_FinishWork_Idn" id="x_FinishWork_Idn" value="<?php echo HtmlEncode($FinishWorks_edit->FinishWork_Idn->CurrentValue) ?>">
<?php echo $FinishWorks_edit->FinishWork_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FinishWorks_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_FinishWorks_Name" for="x_Name" class="<?php echo $FinishWorks_edit->LeftColumnClass ?>"><?php echo $FinishWorks_edit->Name->caption() ?><?php echo $FinishWorks_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FinishWorks_edit->RightColumnClass ?>"><div <?php echo $FinishWorks_edit->Name->cellAttributes() ?>>
<span id="el_FinishWorks_Name">
<input type="text" data-table="FinishWorks" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FinishWorks_edit->Name->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_edit->Name->EditValue ?>"<?php echo $FinishWorks_edit->Name->editAttributes() ?>>
</span>
<?php echo $FinishWorks_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FinishWorks_edit->Value->Visible) { // Value ?>
	<div id="r_Value" class="form-group row">
		<label id="elh_FinishWorks_Value" for="x_Value" class="<?php echo $FinishWorks_edit->LeftColumnClass ?>"><?php echo $FinishWorks_edit->Value->caption() ?><?php echo $FinishWorks_edit->Value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FinishWorks_edit->RightColumnClass ?>"><div <?php echo $FinishWorks_edit->Value->cellAttributes() ?>>
<span id="el_FinishWorks_Value">
<input type="text" data-table="FinishWorks" data-field="x_Value" name="x_Value" id="x_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($FinishWorks_edit->Value->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_edit->Value->EditValue ?>"<?php echo $FinishWorks_edit->Value->editAttributes() ?>>
</span>
<?php echo $FinishWorks_edit->Value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FinishWorks_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_FinishWorks_Rank" for="x_Rank" class="<?php echo $FinishWorks_edit->LeftColumnClass ?>"><?php echo $FinishWorks_edit->Rank->caption() ?><?php echo $FinishWorks_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FinishWorks_edit->RightColumnClass ?>"><div <?php echo $FinishWorks_edit->Rank->cellAttributes() ?>>
<span id="el_FinishWorks_Rank">
<input type="text" data-table="FinishWorks" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FinishWorks_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_edit->Rank->EditValue ?>"<?php echo $FinishWorks_edit->Rank->editAttributes() ?>>
</span>
<?php echo $FinishWorks_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FinishWorks_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_FinishWorks_ActiveFlag" class="<?php echo $FinishWorks_edit->LeftColumnClass ?>"><?php echo $FinishWorks_edit->ActiveFlag->caption() ?><?php echo $FinishWorks_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FinishWorks_edit->RightColumnClass ?>"><div <?php echo $FinishWorks_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_FinishWorks_ActiveFlag">
<?php
$selwrk = ConvertToBool($FinishWorks_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FinishWorks" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_154054" value="1"<?php echo $selwrk ?><?php echo $FinishWorks_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_154054"></label>
</div>
</span>
<?php echo $FinishWorks_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$FinishWorks_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $FinishWorks_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $FinishWorks_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$FinishWorks_edit->IsModal) { ?>
<?php echo $FinishWorks_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$FinishWorks_edit->showPageFooter();
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
$FinishWorks_edit->terminate();
?>