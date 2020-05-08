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
$GradeTypes_edit = new GradeTypes_edit();

// Run the page
$GradeTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GradeTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fGradeTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fGradeTypesedit = currentForm = new ew.Form("fGradeTypesedit", "edit");

	// Validate form
	fGradeTypesedit.validate = function() {
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
			<?php if ($GradeTypes_edit->GradeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GradeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GradeTypes_edit->GradeType_Idn->caption(), $GradeTypes_edit->GradeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GradeTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GradeTypes_edit->Name->caption(), $GradeTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GradeTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GradeTypes_edit->Rank->caption(), $GradeTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($GradeTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($GradeTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GradeTypes_edit->ActiveFlag->caption(), $GradeTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fGradeTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fGradeTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fGradeTypesedit.lists["x_ActiveFlag[]"] = <?php echo $GradeTypes_edit->ActiveFlag->Lookup->toClientList($GradeTypes_edit) ?>;
	fGradeTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($GradeTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fGradeTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $GradeTypes_edit->showPageHeader(); ?>
<?php
$GradeTypes_edit->showMessage();
?>
<?php if (!$GradeTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GradeTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fGradeTypesedit" id="fGradeTypesedit" class="<?php echo $GradeTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GradeTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$GradeTypes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($GradeTypes_edit->GradeType_Idn->Visible) { // GradeType_Idn ?>
	<div id="r_GradeType_Idn" class="form-group row">
		<label id="elh_GradeTypes_GradeType_Idn" class="<?php echo $GradeTypes_edit->LeftColumnClass ?>"><?php echo $GradeTypes_edit->GradeType_Idn->caption() ?><?php echo $GradeTypes_edit->GradeType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GradeTypes_edit->RightColumnClass ?>"><div <?php echo $GradeTypes_edit->GradeType_Idn->cellAttributes() ?>>
<span id="el_GradeTypes_GradeType_Idn">
<span<?php echo $GradeTypes_edit->GradeType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($GradeTypes_edit->GradeType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="GradeTypes" data-field="x_GradeType_Idn" name="x_GradeType_Idn" id="x_GradeType_Idn" value="<?php echo HtmlEncode($GradeTypes_edit->GradeType_Idn->CurrentValue) ?>">
<?php echo $GradeTypes_edit->GradeType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($GradeTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_GradeTypes_Name" for="x_Name" class="<?php echo $GradeTypes_edit->LeftColumnClass ?>"><?php echo $GradeTypes_edit->Name->caption() ?><?php echo $GradeTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GradeTypes_edit->RightColumnClass ?>"><div <?php echo $GradeTypes_edit->Name->cellAttributes() ?>>
<span id="el_GradeTypes_Name">
<input type="text" data-table="GradeTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GradeTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $GradeTypes_edit->Name->EditValue ?>"<?php echo $GradeTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $GradeTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($GradeTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_GradeTypes_Rank" for="x_Rank" class="<?php echo $GradeTypes_edit->LeftColumnClass ?>"><?php echo $GradeTypes_edit->Rank->caption() ?><?php echo $GradeTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GradeTypes_edit->RightColumnClass ?>"><div <?php echo $GradeTypes_edit->Rank->cellAttributes() ?>>
<span id="el_GradeTypes_Rank">
<input type="text" data-table="GradeTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GradeTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $GradeTypes_edit->Rank->EditValue ?>"<?php echo $GradeTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $GradeTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($GradeTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_GradeTypes_ActiveFlag" class="<?php echo $GradeTypes_edit->LeftColumnClass ?>"><?php echo $GradeTypes_edit->ActiveFlag->caption() ?><?php echo $GradeTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $GradeTypes_edit->RightColumnClass ?>"><div <?php echo $GradeTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_GradeTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($GradeTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GradeTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_983710" value="1"<?php echo $selwrk ?><?php echo $GradeTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_983710"></label>
</div>
</span>
<?php echo $GradeTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$GradeTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $GradeTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $GradeTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$GradeTypes_edit->IsModal) { ?>
<?php echo $GradeTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$GradeTypes_edit->showPageFooter();
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
$GradeTypes_edit->terminate();
?>