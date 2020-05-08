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
$LiftDurations_edit = new LiftDurations_edit();

// Run the page
$LiftDurations_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LiftDurations_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fLiftDurationsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fLiftDurationsedit = currentForm = new ew.Form("fLiftDurationsedit", "edit");

	// Validate form
	fLiftDurationsedit.validate = function() {
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
			<?php if ($LiftDurations_edit->LiftDuration_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LiftDuration_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LiftDurations_edit->LiftDuration_Idn->caption(), $LiftDurations_edit->LiftDuration_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($LiftDurations_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LiftDurations_edit->Name->caption(), $LiftDurations_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($LiftDurations_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LiftDurations_edit->Rank->caption(), $LiftDurations_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($LiftDurations_edit->Rank->errorMessage()) ?>");
			<?php if ($LiftDurations_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LiftDurations_edit->ActiveFlag->caption(), $LiftDurations_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fLiftDurationsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fLiftDurationsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fLiftDurationsedit.lists["x_ActiveFlag[]"] = <?php echo $LiftDurations_edit->ActiveFlag->Lookup->toClientList($LiftDurations_edit) ?>;
	fLiftDurationsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($LiftDurations_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fLiftDurationsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $LiftDurations_edit->showPageHeader(); ?>
<?php
$LiftDurations_edit->showMessage();
?>
<?php if (!$LiftDurations_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $LiftDurations_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fLiftDurationsedit" id="fLiftDurationsedit" class="<?php echo $LiftDurations_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LiftDurations">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$LiftDurations_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($LiftDurations_edit->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
	<div id="r_LiftDuration_Idn" class="form-group row">
		<label id="elh_LiftDurations_LiftDuration_Idn" class="<?php echo $LiftDurations_edit->LeftColumnClass ?>"><?php echo $LiftDurations_edit->LiftDuration_Idn->caption() ?><?php echo $LiftDurations_edit->LiftDuration_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LiftDurations_edit->RightColumnClass ?>"><div <?php echo $LiftDurations_edit->LiftDuration_Idn->cellAttributes() ?>>
<span id="el_LiftDurations_LiftDuration_Idn">
<span<?php echo $LiftDurations_edit->LiftDuration_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($LiftDurations_edit->LiftDuration_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="LiftDurations" data-field="x_LiftDuration_Idn" name="x_LiftDuration_Idn" id="x_LiftDuration_Idn" value="<?php echo HtmlEncode($LiftDurations_edit->LiftDuration_Idn->CurrentValue) ?>">
<?php echo $LiftDurations_edit->LiftDuration_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LiftDurations_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_LiftDurations_Name" for="x_Name" class="<?php echo $LiftDurations_edit->LeftColumnClass ?>"><?php echo $LiftDurations_edit->Name->caption() ?><?php echo $LiftDurations_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LiftDurations_edit->RightColumnClass ?>"><div <?php echo $LiftDurations_edit->Name->cellAttributes() ?>>
<span id="el_LiftDurations_Name">
<input type="text" data-table="LiftDurations" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($LiftDurations_edit->Name->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_edit->Name->EditValue ?>"<?php echo $LiftDurations_edit->Name->editAttributes() ?>>
</span>
<?php echo $LiftDurations_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LiftDurations_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_LiftDurations_Rank" for="x_Rank" class="<?php echo $LiftDurations_edit->LeftColumnClass ?>"><?php echo $LiftDurations_edit->Rank->caption() ?><?php echo $LiftDurations_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LiftDurations_edit->RightColumnClass ?>"><div <?php echo $LiftDurations_edit->Rank->cellAttributes() ?>>
<span id="el_LiftDurations_Rank">
<input type="text" data-table="LiftDurations" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($LiftDurations_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_edit->Rank->EditValue ?>"<?php echo $LiftDurations_edit->Rank->editAttributes() ?>>
</span>
<?php echo $LiftDurations_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LiftDurations_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_LiftDurations_ActiveFlag" class="<?php echo $LiftDurations_edit->LeftColumnClass ?>"><?php echo $LiftDurations_edit->ActiveFlag->caption() ?><?php echo $LiftDurations_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LiftDurations_edit->RightColumnClass ?>"><div <?php echo $LiftDurations_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_LiftDurations_ActiveFlag">
<?php
$selwrk = ConvertToBool($LiftDurations_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="LiftDurations" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_727505" value="1"<?php echo $selwrk ?><?php echo $LiftDurations_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_727505"></label>
</div>
</span>
<?php echo $LiftDurations_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$LiftDurations_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $LiftDurations_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $LiftDurations_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$LiftDurations_edit->IsModal) { ?>
<?php echo $LiftDurations_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$LiftDurations_edit->showPageFooter();
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
$LiftDurations_edit->terminate();
?>