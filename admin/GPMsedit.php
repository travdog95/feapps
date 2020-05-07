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
$GPMs_edit = new GPMs_edit();

// Run the page
$GPMs_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GPMs_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fGPMsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fGPMsedit = currentForm = new ew.Form("fGPMsedit", "edit");

	// Validate form
	fGPMsedit.validate = function() {
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
			<?php if ($GPMs_edit->GPM_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GPM_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GPMs_edit->GPM_Idn->caption(), $GPMs_edit->GPM_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GPMs_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GPMs_edit->Name->caption(), $GPMs_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GPMs_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GPMs_edit->Rank->caption(), $GPMs_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($GPMs_edit->Rank->errorMessage()) ?>");
			<?php if ($GPMs_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GPMs_edit->ActiveFlag->caption(), $GPMs_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fGPMsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fGPMsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fGPMsedit.lists["x_ActiveFlag[]"] = <?php echo $GPMs_edit->ActiveFlag->Lookup->toClientList($GPMs_edit) ?>;
	fGPMsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($GPMs_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fGPMsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $GPMs_edit->showPageHeader(); ?>
<?php
$GPMs_edit->showMessage();
?>
<?php if (!$GPMs_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GPMs_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fGPMsedit" id="fGPMsedit" class="<?php echo $GPMs_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GPMs">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$GPMs_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($GPMs_edit->GPM_Idn->Visible) { // GPM_Idn ?>
	<div id="r_GPM_Idn" class="form-group row">
		<label id="elh_GPMs_GPM_Idn" class="<?php echo $GPMs_edit->LeftColumnClass ?>"><?php echo $GPMs_edit->GPM_Idn->caption() ?><?php echo $GPMs_edit->GPM_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GPMs_edit->RightColumnClass ?>"><div <?php echo $GPMs_edit->GPM_Idn->cellAttributes() ?>>
<span id="el_GPMs_GPM_Idn">
<span<?php echo $GPMs_edit->GPM_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($GPMs_edit->GPM_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="GPMs" data-field="x_GPM_Idn" name="x_GPM_Idn" id="x_GPM_Idn" value="<?php echo HtmlEncode($GPMs_edit->GPM_Idn->CurrentValue) ?>">
<?php echo $GPMs_edit->GPM_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($GPMs_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_GPMs_Name" for="x_Name" class="<?php echo $GPMs_edit->LeftColumnClass ?>"><?php echo $GPMs_edit->Name->caption() ?><?php echo $GPMs_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GPMs_edit->RightColumnClass ?>"><div <?php echo $GPMs_edit->Name->cellAttributes() ?>>
<span id="el_GPMs_Name">
<input type="text" data-table="GPMs" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GPMs_edit->Name->getPlaceHolder()) ?>" value="<?php echo $GPMs_edit->Name->EditValue ?>"<?php echo $GPMs_edit->Name->editAttributes() ?>>
</span>
<?php echo $GPMs_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($GPMs_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_GPMs_Rank" for="x_Rank" class="<?php echo $GPMs_edit->LeftColumnClass ?>"><?php echo $GPMs_edit->Rank->caption() ?><?php echo $GPMs_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GPMs_edit->RightColumnClass ?>"><div <?php echo $GPMs_edit->Rank->cellAttributes() ?>>
<span id="el_GPMs_Rank">
<input type="text" data-table="GPMs" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GPMs_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $GPMs_edit->Rank->EditValue ?>"<?php echo $GPMs_edit->Rank->editAttributes() ?>>
</span>
<?php echo $GPMs_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($GPMs_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_GPMs_ActiveFlag" class="<?php echo $GPMs_edit->LeftColumnClass ?>"><?php echo $GPMs_edit->ActiveFlag->caption() ?><?php echo $GPMs_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GPMs_edit->RightColumnClass ?>"><div <?php echo $GPMs_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_GPMs_ActiveFlag">
<?php
$selwrk = ConvertToBool($GPMs_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GPMs" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_655183" value="1"<?php echo $selwrk ?><?php echo $GPMs_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_655183"></label>
</div>
</span>
<?php echo $GPMs_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$GPMs_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $GPMs_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $GPMs_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$GPMs_edit->IsModal) { ?>
<?php echo $GPMs_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$GPMs_edit->showPageFooter();
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
$GPMs_edit->terminate();
?>