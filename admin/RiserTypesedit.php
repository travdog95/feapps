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
$RiserTypes_edit = new RiserTypes_edit();

// Run the page
$RiserTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RiserTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRiserTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fRiserTypesedit = currentForm = new ew.Form("fRiserTypesedit", "edit");

	// Validate form
	fRiserTypesedit.validate = function() {
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
			<?php if ($RiserTypes_edit->RiserType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RiserType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RiserTypes_edit->RiserType_Idn->caption(), $RiserTypes_edit->RiserType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RiserTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RiserTypes_edit->Name->caption(), $RiserTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RiserTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RiserTypes_edit->Rank->caption(), $RiserTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RiserTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($RiserTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RiserTypes_edit->ActiveFlag->caption(), $RiserTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fRiserTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRiserTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRiserTypesedit.lists["x_ActiveFlag[]"] = <?php echo $RiserTypes_edit->ActiveFlag->Lookup->toClientList($RiserTypes_edit) ?>;
	fRiserTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($RiserTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fRiserTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RiserTypes_edit->showPageHeader(); ?>
<?php
$RiserTypes_edit->showMessage();
?>
<?php if (!$RiserTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RiserTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fRiserTypesedit" id="fRiserTypesedit" class="<?php echo $RiserTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RiserTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$RiserTypes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($RiserTypes_edit->RiserType_Idn->Visible) { // RiserType_Idn ?>
	<div id="r_RiserType_Idn" class="form-group row">
		<label id="elh_RiserTypes_RiserType_Idn" class="<?php echo $RiserTypes_edit->LeftColumnClass ?>"><?php echo $RiserTypes_edit->RiserType_Idn->caption() ?><?php echo $RiserTypes_edit->RiserType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RiserTypes_edit->RightColumnClass ?>"><div <?php echo $RiserTypes_edit->RiserType_Idn->cellAttributes() ?>>
<span id="el_RiserTypes_RiserType_Idn">
<span<?php echo $RiserTypes_edit->RiserType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($RiserTypes_edit->RiserType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="RiserTypes" data-field="x_RiserType_Idn" name="x_RiserType_Idn" id="x_RiserType_Idn" value="<?php echo HtmlEncode($RiserTypes_edit->RiserType_Idn->CurrentValue) ?>">
<?php echo $RiserTypes_edit->RiserType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RiserTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_RiserTypes_Name" for="x_Name" class="<?php echo $RiserTypes_edit->LeftColumnClass ?>"><?php echo $RiserTypes_edit->Name->caption() ?><?php echo $RiserTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RiserTypes_edit->RightColumnClass ?>"><div <?php echo $RiserTypes_edit->Name->cellAttributes() ?>>
<span id="el_RiserTypes_Name">
<input type="text" data-table="RiserTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RiserTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $RiserTypes_edit->Name->EditValue ?>"<?php echo $RiserTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $RiserTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RiserTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_RiserTypes_Rank" for="x_Rank" class="<?php echo $RiserTypes_edit->LeftColumnClass ?>"><?php echo $RiserTypes_edit->Rank->caption() ?><?php echo $RiserTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RiserTypes_edit->RightColumnClass ?>"><div <?php echo $RiserTypes_edit->Rank->cellAttributes() ?>>
<span id="el_RiserTypes_Rank">
<input type="text" data-table="RiserTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RiserTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $RiserTypes_edit->Rank->EditValue ?>"<?php echo $RiserTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $RiserTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RiserTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_RiserTypes_ActiveFlag" class="<?php echo $RiserTypes_edit->LeftColumnClass ?>"><?php echo $RiserTypes_edit->ActiveFlag->caption() ?><?php echo $RiserTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RiserTypes_edit->RightColumnClass ?>"><div <?php echo $RiserTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_RiserTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($RiserTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RiserTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_371258" value="1"<?php echo $selwrk ?><?php echo $RiserTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_371258"></label>
</div>
</span>
<?php echo $RiserTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$RiserTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $RiserTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RiserTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$RiserTypes_edit->IsModal) { ?>
<?php echo $RiserTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$RiserTypes_edit->showPageFooter();
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
$RiserTypes_edit->terminate();
?>