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
$TappingTees_edit = new TappingTees_edit();

// Run the page
$TappingTees_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TappingTees_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fTappingTeesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fTappingTeesedit = currentForm = new ew.Form("fTappingTeesedit", "edit");

	// Validate form
	fTappingTeesedit.validate = function() {
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
			<?php if ($TappingTees_edit->TappingTee_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_TappingTee_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TappingTees_edit->TappingTee_Idn->caption(), $TappingTees_edit->TappingTee_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TappingTee_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($TappingTees_edit->TappingTee_Idn->errorMessage()) ?>");
			<?php if ($TappingTees_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TappingTees_edit->Name->caption(), $TappingTees_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($TappingTees_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TappingTees_edit->Rank->caption(), $TappingTees_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($TappingTees_edit->Rank->errorMessage()) ?>");
			<?php if ($TappingTees_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TappingTees_edit->ActiveFlag->caption(), $TappingTees_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fTappingTeesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fTappingTeesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fTappingTeesedit.lists["x_ActiveFlag[]"] = <?php echo $TappingTees_edit->ActiveFlag->Lookup->toClientList($TappingTees_edit) ?>;
	fTappingTeesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($TappingTees_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fTappingTeesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $TappingTees_edit->showPageHeader(); ?>
<?php
$TappingTees_edit->showMessage();
?>
<?php if (!$TappingTees_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $TappingTees_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fTappingTeesedit" id="fTappingTeesedit" class="<?php echo $TappingTees_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TappingTees">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$TappingTees_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($TappingTees_edit->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
	<div id="r_TappingTee_Idn" class="form-group row">
		<label id="elh_TappingTees_TappingTee_Idn" for="x_TappingTee_Idn" class="<?php echo $TappingTees_edit->LeftColumnClass ?>"><?php echo $TappingTees_edit->TappingTee_Idn->caption() ?><?php echo $TappingTees_edit->TappingTee_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $TappingTees_edit->RightColumnClass ?>"><div <?php echo $TappingTees_edit->TappingTee_Idn->cellAttributes() ?>>
<input type="text" data-table="TappingTees" data-field="x_TappingTee_Idn" name="x_TappingTee_Idn" id="x_TappingTee_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TappingTees_edit->TappingTee_Idn->getPlaceHolder()) ?>" value="<?php echo $TappingTees_edit->TappingTee_Idn->EditValue ?>"<?php echo $TappingTees_edit->TappingTee_Idn->editAttributes() ?>>
<input type="hidden" data-table="TappingTees" data-field="x_TappingTee_Idn" name="o_TappingTee_Idn" id="o_TappingTee_Idn" value="<?php echo HtmlEncode($TappingTees_edit->TappingTee_Idn->OldValue != null ? $TappingTees_edit->TappingTee_Idn->OldValue : $TappingTees_edit->TappingTee_Idn->CurrentValue) ?>">
<?php echo $TappingTees_edit->TappingTee_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($TappingTees_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_TappingTees_Name" for="x_Name" class="<?php echo $TappingTees_edit->LeftColumnClass ?>"><?php echo $TappingTees_edit->Name->caption() ?><?php echo $TappingTees_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $TappingTees_edit->RightColumnClass ?>"><div <?php echo $TappingTees_edit->Name->cellAttributes() ?>>
<span id="el_TappingTees_Name">
<input type="text" data-table="TappingTees" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TappingTees_edit->Name->getPlaceHolder()) ?>" value="<?php echo $TappingTees_edit->Name->EditValue ?>"<?php echo $TappingTees_edit->Name->editAttributes() ?>>
</span>
<?php echo $TappingTees_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($TappingTees_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_TappingTees_Rank" for="x_Rank" class="<?php echo $TappingTees_edit->LeftColumnClass ?>"><?php echo $TappingTees_edit->Rank->caption() ?><?php echo $TappingTees_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $TappingTees_edit->RightColumnClass ?>"><div <?php echo $TappingTees_edit->Rank->cellAttributes() ?>>
<span id="el_TappingTees_Rank">
<input type="text" data-table="TappingTees" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TappingTees_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $TappingTees_edit->Rank->EditValue ?>"<?php echo $TappingTees_edit->Rank->editAttributes() ?>>
</span>
<?php echo $TappingTees_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($TappingTees_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_TappingTees_ActiveFlag" class="<?php echo $TappingTees_edit->LeftColumnClass ?>"><?php echo $TappingTees_edit->ActiveFlag->caption() ?><?php echo $TappingTees_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $TappingTees_edit->RightColumnClass ?>"><div <?php echo $TappingTees_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_TappingTees_ActiveFlag">
<?php
$selwrk = ConvertToBool($TappingTees_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="TappingTees" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_828342" value="1"<?php echo $selwrk ?><?php echo $TappingTees_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_828342"></label>
</div>
</span>
<?php echo $TappingTees_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$TappingTees_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $TappingTees_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $TappingTees_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$TappingTees_edit->IsModal) { ?>
<?php echo $TappingTees_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$TappingTees_edit->showPageFooter();
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
$TappingTees_edit->terminate();
?>