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
$FinishTypes_edit = new FinishTypes_edit();

// Run the page
$FinishTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FinishTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fFinishTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fFinishTypesedit = currentForm = new ew.Form("fFinishTypesedit", "edit");

	// Validate form
	fFinishTypesedit.validate = function() {
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
			<?php if ($FinishTypes_edit->FinishType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FinishType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishTypes_edit->FinishType_Idn->caption(), $FinishTypes_edit->FinishType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FinishTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishTypes_edit->Name->caption(), $FinishTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FinishTypes_edit->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishTypes_edit->ShortName->caption(), $FinishTypes_edit->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FinishTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishTypes_edit->Rank->caption(), $FinishTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($FinishTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($FinishTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishTypes_edit->ActiveFlag->caption(), $FinishTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fFinishTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fFinishTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fFinishTypesedit.lists["x_ActiveFlag[]"] = <?php echo $FinishTypes_edit->ActiveFlag->Lookup->toClientList($FinishTypes_edit) ?>;
	fFinishTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($FinishTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fFinishTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $FinishTypes_edit->showPageHeader(); ?>
<?php
$FinishTypes_edit->showMessage();
?>
<?php if (!$FinishTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FinishTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fFinishTypesedit" id="fFinishTypesedit" class="<?php echo $FinishTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FinishTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$FinishTypes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($FinishTypes_edit->FinishType_Idn->Visible) { // FinishType_Idn ?>
	<div id="r_FinishType_Idn" class="form-group row">
		<label id="elh_FinishTypes_FinishType_Idn" class="<?php echo $FinishTypes_edit->LeftColumnClass ?>"><?php echo $FinishTypes_edit->FinishType_Idn->caption() ?><?php echo $FinishTypes_edit->FinishType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FinishTypes_edit->RightColumnClass ?>"><div <?php echo $FinishTypes_edit->FinishType_Idn->cellAttributes() ?>>
<span id="el_FinishTypes_FinishType_Idn">
<span<?php echo $FinishTypes_edit->FinishType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($FinishTypes_edit->FinishType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_FinishType_Idn" name="x_FinishType_Idn" id="x_FinishType_Idn" value="<?php echo HtmlEncode($FinishTypes_edit->FinishType_Idn->CurrentValue) ?>">
<?php echo $FinishTypes_edit->FinishType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FinishTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_FinishTypes_Name" for="x_Name" class="<?php echo $FinishTypes_edit->LeftColumnClass ?>"><?php echo $FinishTypes_edit->Name->caption() ?><?php echo $FinishTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FinishTypes_edit->RightColumnClass ?>"><div <?php echo $FinishTypes_edit->Name->cellAttributes() ?>>
<span id="el_FinishTypes_Name">
<input type="text" data-table="FinishTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FinishTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_edit->Name->EditValue ?>"<?php echo $FinishTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $FinishTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FinishTypes_edit->ShortName->Visible) { // ShortName ?>
	<div id="r_ShortName" class="form-group row">
		<label id="elh_FinishTypes_ShortName" for="x_ShortName" class="<?php echo $FinishTypes_edit->LeftColumnClass ?>"><?php echo $FinishTypes_edit->ShortName->caption() ?><?php echo $FinishTypes_edit->ShortName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FinishTypes_edit->RightColumnClass ?>"><div <?php echo $FinishTypes_edit->ShortName->cellAttributes() ?>>
<span id="el_FinishTypes_ShortName">
<input type="text" data-table="FinishTypes" data-field="x_ShortName" name="x_ShortName" id="x_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($FinishTypes_edit->ShortName->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_edit->ShortName->EditValue ?>"<?php echo $FinishTypes_edit->ShortName->editAttributes() ?>>
</span>
<?php echo $FinishTypes_edit->ShortName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FinishTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_FinishTypes_Rank" for="x_Rank" class="<?php echo $FinishTypes_edit->LeftColumnClass ?>"><?php echo $FinishTypes_edit->Rank->caption() ?><?php echo $FinishTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FinishTypes_edit->RightColumnClass ?>"><div <?php echo $FinishTypes_edit->Rank->cellAttributes() ?>>
<span id="el_FinishTypes_Rank">
<input type="text" data-table="FinishTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FinishTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_edit->Rank->EditValue ?>"<?php echo $FinishTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $FinishTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($FinishTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_FinishTypes_ActiveFlag" class="<?php echo $FinishTypes_edit->LeftColumnClass ?>"><?php echo $FinishTypes_edit->ActiveFlag->caption() ?><?php echo $FinishTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $FinishTypes_edit->RightColumnClass ?>"><div <?php echo $FinishTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_FinishTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($FinishTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FinishTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_968906" value="1"<?php echo $selwrk ?><?php echo $FinishTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_968906"></label>
</div>
</span>
<?php echo $FinishTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$FinishTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $FinishTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $FinishTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$FinishTypes_edit->IsModal) { ?>
<?php echo $FinishTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$FinishTypes_edit->showPageFooter();
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
$FinishTypes_edit->terminate();
?>