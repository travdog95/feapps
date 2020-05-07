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
$ThreadedFittingTypes_edit = new ThreadedFittingTypes_edit();

// Run the page
$ThreadedFittingTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ThreadedFittingTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fThreadedFittingTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fThreadedFittingTypesedit = currentForm = new ew.Form("fThreadedFittingTypesedit", "edit");

	// Validate form
	fThreadedFittingTypesedit.validate = function() {
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
			<?php if ($ThreadedFittingTypes_edit->ThreadedFittingType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ThreadedFittingType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ThreadedFittingTypes_edit->ThreadedFittingType_Idn->caption(), $ThreadedFittingTypes_edit->ThreadedFittingType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ThreadedFittingTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ThreadedFittingTypes_edit->Name->caption(), $ThreadedFittingTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ThreadedFittingTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ThreadedFittingTypes_edit->Rank->caption(), $ThreadedFittingTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ThreadedFittingTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($ThreadedFittingTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ThreadedFittingTypes_edit->ActiveFlag->caption(), $ThreadedFittingTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fThreadedFittingTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fThreadedFittingTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fThreadedFittingTypesedit.lists["x_ActiveFlag[]"] = <?php echo $ThreadedFittingTypes_edit->ActiveFlag->Lookup->toClientList($ThreadedFittingTypes_edit) ?>;
	fThreadedFittingTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ThreadedFittingTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fThreadedFittingTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ThreadedFittingTypes_edit->showPageHeader(); ?>
<?php
$ThreadedFittingTypes_edit->showMessage();
?>
<?php if (!$ThreadedFittingTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ThreadedFittingTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fThreadedFittingTypesedit" id="fThreadedFittingTypesedit" class="<?php echo $ThreadedFittingTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ThreadedFittingTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ThreadedFittingTypes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ThreadedFittingTypes_edit->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
	<div id="r_ThreadedFittingType_Idn" class="form-group row">
		<label id="elh_ThreadedFittingTypes_ThreadedFittingType_Idn" class="<?php echo $ThreadedFittingTypes_edit->LeftColumnClass ?>"><?php echo $ThreadedFittingTypes_edit->ThreadedFittingType_Idn->caption() ?><?php echo $ThreadedFittingTypes_edit->ThreadedFittingType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ThreadedFittingTypes_edit->RightColumnClass ?>"><div <?php echo $ThreadedFittingTypes_edit->ThreadedFittingType_Idn->cellAttributes() ?>>
<span id="el_ThreadedFittingTypes_ThreadedFittingType_Idn">
<span<?php echo $ThreadedFittingTypes_edit->ThreadedFittingType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ThreadedFittingTypes_edit->ThreadedFittingType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_ThreadedFittingType_Idn" name="x_ThreadedFittingType_Idn" id="x_ThreadedFittingType_Idn" value="<?php echo HtmlEncode($ThreadedFittingTypes_edit->ThreadedFittingType_Idn->CurrentValue) ?>">
<?php echo $ThreadedFittingTypes_edit->ThreadedFittingType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ThreadedFittingTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_ThreadedFittingTypes_Name" for="x_Name" class="<?php echo $ThreadedFittingTypes_edit->LeftColumnClass ?>"><?php echo $ThreadedFittingTypes_edit->Name->caption() ?><?php echo $ThreadedFittingTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ThreadedFittingTypes_edit->RightColumnClass ?>"><div <?php echo $ThreadedFittingTypes_edit->Name->cellAttributes() ?>>
<span id="el_ThreadedFittingTypes_Name">
<input type="text" data-table="ThreadedFittingTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ThreadedFittingTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $ThreadedFittingTypes_edit->Name->EditValue ?>"<?php echo $ThreadedFittingTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $ThreadedFittingTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ThreadedFittingTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_ThreadedFittingTypes_Rank" for="x_Rank" class="<?php echo $ThreadedFittingTypes_edit->LeftColumnClass ?>"><?php echo $ThreadedFittingTypes_edit->Rank->caption() ?><?php echo $ThreadedFittingTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ThreadedFittingTypes_edit->RightColumnClass ?>"><div <?php echo $ThreadedFittingTypes_edit->Rank->cellAttributes() ?>>
<span id="el_ThreadedFittingTypes_Rank">
<input type="text" data-table="ThreadedFittingTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ThreadedFittingTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $ThreadedFittingTypes_edit->Rank->EditValue ?>"<?php echo $ThreadedFittingTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $ThreadedFittingTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ThreadedFittingTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_ThreadedFittingTypes_ActiveFlag" class="<?php echo $ThreadedFittingTypes_edit->LeftColumnClass ?>"><?php echo $ThreadedFittingTypes_edit->ActiveFlag->caption() ?><?php echo $ThreadedFittingTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ThreadedFittingTypes_edit->RightColumnClass ?>"><div <?php echo $ThreadedFittingTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_ThreadedFittingTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($ThreadedFittingTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ThreadedFittingTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_878039" value="1"<?php echo $selwrk ?><?php echo $ThreadedFittingTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_878039"></label>
</div>
</span>
<?php echo $ThreadedFittingTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ThreadedFittingTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ThreadedFittingTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ThreadedFittingTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ThreadedFittingTypes_edit->IsModal) { ?>
<?php echo $ThreadedFittingTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ThreadedFittingTypes_edit->showPageFooter();
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
$ThreadedFittingTypes_edit->terminate();
?>