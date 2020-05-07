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
$GroovedFittingTypes_edit = new GroovedFittingTypes_edit();

// Run the page
$GroovedFittingTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GroovedFittingTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fGroovedFittingTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fGroovedFittingTypesedit = currentForm = new ew.Form("fGroovedFittingTypesedit", "edit");

	// Validate form
	fGroovedFittingTypesedit.validate = function() {
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
			<?php if ($GroovedFittingTypes_edit->GroovedFittingType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GroovedFittingType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GroovedFittingTypes_edit->GroovedFittingType_Idn->caption(), $GroovedFittingTypes_edit->GroovedFittingType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GroovedFittingTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GroovedFittingTypes_edit->Name->caption(), $GroovedFittingTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GroovedFittingTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GroovedFittingTypes_edit->Rank->caption(), $GroovedFittingTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($GroovedFittingTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($GroovedFittingTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GroovedFittingTypes_edit->ActiveFlag->caption(), $GroovedFittingTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fGroovedFittingTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fGroovedFittingTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fGroovedFittingTypesedit.lists["x_ActiveFlag[]"] = <?php echo $GroovedFittingTypes_edit->ActiveFlag->Lookup->toClientList($GroovedFittingTypes_edit) ?>;
	fGroovedFittingTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($GroovedFittingTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fGroovedFittingTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $GroovedFittingTypes_edit->showPageHeader(); ?>
<?php
$GroovedFittingTypes_edit->showMessage();
?>
<?php if (!$GroovedFittingTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GroovedFittingTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fGroovedFittingTypesedit" id="fGroovedFittingTypesedit" class="<?php echo $GroovedFittingTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GroovedFittingTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$GroovedFittingTypes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($GroovedFittingTypes_edit->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
	<div id="r_GroovedFittingType_Idn" class="form-group row">
		<label id="elh_GroovedFittingTypes_GroovedFittingType_Idn" class="<?php echo $GroovedFittingTypes_edit->LeftColumnClass ?>"><?php echo $GroovedFittingTypes_edit->GroovedFittingType_Idn->caption() ?><?php echo $GroovedFittingTypes_edit->GroovedFittingType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GroovedFittingTypes_edit->RightColumnClass ?>"><div <?php echo $GroovedFittingTypes_edit->GroovedFittingType_Idn->cellAttributes() ?>>
<span id="el_GroovedFittingTypes_GroovedFittingType_Idn">
<span<?php echo $GroovedFittingTypes_edit->GroovedFittingType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($GroovedFittingTypes_edit->GroovedFittingType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_GroovedFittingType_Idn" name="x_GroovedFittingType_Idn" id="x_GroovedFittingType_Idn" value="<?php echo HtmlEncode($GroovedFittingTypes_edit->GroovedFittingType_Idn->CurrentValue) ?>">
<?php echo $GroovedFittingTypes_edit->GroovedFittingType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($GroovedFittingTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_GroovedFittingTypes_Name" for="x_Name" class="<?php echo $GroovedFittingTypes_edit->LeftColumnClass ?>"><?php echo $GroovedFittingTypes_edit->Name->caption() ?><?php echo $GroovedFittingTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GroovedFittingTypes_edit->RightColumnClass ?>"><div <?php echo $GroovedFittingTypes_edit->Name->cellAttributes() ?>>
<span id="el_GroovedFittingTypes_Name">
<input type="text" data-table="GroovedFittingTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GroovedFittingTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $GroovedFittingTypes_edit->Name->EditValue ?>"<?php echo $GroovedFittingTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $GroovedFittingTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($GroovedFittingTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_GroovedFittingTypes_Rank" for="x_Rank" class="<?php echo $GroovedFittingTypes_edit->LeftColumnClass ?>"><?php echo $GroovedFittingTypes_edit->Rank->caption() ?><?php echo $GroovedFittingTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GroovedFittingTypes_edit->RightColumnClass ?>"><div <?php echo $GroovedFittingTypes_edit->Rank->cellAttributes() ?>>
<span id="el_GroovedFittingTypes_Rank">
<input type="text" data-table="GroovedFittingTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GroovedFittingTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $GroovedFittingTypes_edit->Rank->EditValue ?>"<?php echo $GroovedFittingTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $GroovedFittingTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($GroovedFittingTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_GroovedFittingTypes_ActiveFlag" class="<?php echo $GroovedFittingTypes_edit->LeftColumnClass ?>"><?php echo $GroovedFittingTypes_edit->ActiveFlag->caption() ?><?php echo $GroovedFittingTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GroovedFittingTypes_edit->RightColumnClass ?>"><div <?php echo $GroovedFittingTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_GroovedFittingTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($GroovedFittingTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GroovedFittingTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_647813" value="1"<?php echo $selwrk ?><?php echo $GroovedFittingTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_647813"></label>
</div>
</span>
<?php echo $GroovedFittingTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$GroovedFittingTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $GroovedFittingTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $GroovedFittingTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$GroovedFittingTypes_edit->IsModal) { ?>
<?php echo $GroovedFittingTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$GroovedFittingTypes_edit->showPageFooter();
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
$GroovedFittingTypes_edit->terminate();
?>