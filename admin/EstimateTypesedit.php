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
$EstimateTypes_edit = new EstimateTypes_edit();

// Run the page
$EstimateTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$EstimateTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fEstimateTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fEstimateTypesedit = currentForm = new ew.Form("fEstimateTypesedit", "edit");

	// Validate form
	fEstimateTypesedit.validate = function() {
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
			<?php if ($EstimateTypes_edit->EstimateType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_EstimateType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EstimateTypes_edit->EstimateType_Idn->caption(), $EstimateTypes_edit->EstimateType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EstimateTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EstimateTypes_edit->Name->caption(), $EstimateTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EstimateTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EstimateTypes_edit->Rank->caption(), $EstimateTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EstimateTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($EstimateTypes_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EstimateTypes_edit->Department_Idn->caption(), $EstimateTypes_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EstimateTypes_edit->Department_Idn->errorMessage()) ?>");
			<?php if ($EstimateTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EstimateTypes_edit->ActiveFlag->caption(), $EstimateTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fEstimateTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fEstimateTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fEstimateTypesedit.lists["x_ActiveFlag[]"] = <?php echo $EstimateTypes_edit->ActiveFlag->Lookup->toClientList($EstimateTypes_edit) ?>;
	fEstimateTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($EstimateTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fEstimateTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $EstimateTypes_edit->showPageHeader(); ?>
<?php
$EstimateTypes_edit->showMessage();
?>
<?php if (!$EstimateTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $EstimateTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fEstimateTypesedit" id="fEstimateTypesedit" class="<?php echo $EstimateTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="EstimateTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$EstimateTypes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($EstimateTypes_edit->EstimateType_Idn->Visible) { // EstimateType_Idn ?>
	<div id="r_EstimateType_Idn" class="form-group row">
		<label id="elh_EstimateTypes_EstimateType_Idn" class="<?php echo $EstimateTypes_edit->LeftColumnClass ?>"><?php echo $EstimateTypes_edit->EstimateType_Idn->caption() ?><?php echo $EstimateTypes_edit->EstimateType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EstimateTypes_edit->RightColumnClass ?>"><div <?php echo $EstimateTypes_edit->EstimateType_Idn->cellAttributes() ?>>
<span id="el_EstimateTypes_EstimateType_Idn">
<span<?php echo $EstimateTypes_edit->EstimateType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($EstimateTypes_edit->EstimateType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_EstimateType_Idn" name="x_EstimateType_Idn" id="x_EstimateType_Idn" value="<?php echo HtmlEncode($EstimateTypes_edit->EstimateType_Idn->CurrentValue) ?>">
<?php echo $EstimateTypes_edit->EstimateType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EstimateTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_EstimateTypes_Name" for="x_Name" class="<?php echo $EstimateTypes_edit->LeftColumnClass ?>"><?php echo $EstimateTypes_edit->Name->caption() ?><?php echo $EstimateTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EstimateTypes_edit->RightColumnClass ?>"><div <?php echo $EstimateTypes_edit->Name->cellAttributes() ?>>
<span id="el_EstimateTypes_Name">
<input type="text" data-table="EstimateTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($EstimateTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_edit->Name->EditValue ?>"<?php echo $EstimateTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $EstimateTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EstimateTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_EstimateTypes_Rank" for="x_Rank" class="<?php echo $EstimateTypes_edit->LeftColumnClass ?>"><?php echo $EstimateTypes_edit->Rank->caption() ?><?php echo $EstimateTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EstimateTypes_edit->RightColumnClass ?>"><div <?php echo $EstimateTypes_edit->Rank->cellAttributes() ?>>
<span id="el_EstimateTypes_Rank">
<input type="text" data-table="EstimateTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EstimateTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_edit->Rank->EditValue ?>"<?php echo $EstimateTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $EstimateTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EstimateTypes_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_EstimateTypes_Department_Idn" for="x_Department_Idn" class="<?php echo $EstimateTypes_edit->LeftColumnClass ?>"><?php echo $EstimateTypes_edit->Department_Idn->caption() ?><?php echo $EstimateTypes_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EstimateTypes_edit->RightColumnClass ?>"><div <?php echo $EstimateTypes_edit->Department_Idn->cellAttributes() ?>>
<span id="el_EstimateTypes_Department_Idn">
<input type="text" data-table="EstimateTypes" data-field="x_Department_Idn" name="x_Department_Idn" id="x_Department_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EstimateTypes_edit->Department_Idn->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_edit->Department_Idn->EditValue ?>"<?php echo $EstimateTypes_edit->Department_Idn->editAttributes() ?>>
</span>
<?php echo $EstimateTypes_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EstimateTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_EstimateTypes_ActiveFlag" class="<?php echo $EstimateTypes_edit->LeftColumnClass ?>"><?php echo $EstimateTypes_edit->ActiveFlag->caption() ?><?php echo $EstimateTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EstimateTypes_edit->RightColumnClass ?>"><div <?php echo $EstimateTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_EstimateTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($EstimateTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="EstimateTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_324964" value="1"<?php echo $selwrk ?><?php echo $EstimateTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_324964"></label>
</div>
</span>
<?php echo $EstimateTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$EstimateTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $EstimateTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $EstimateTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$EstimateTypes_edit->IsModal) { ?>
<?php echo $EstimateTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$EstimateTypes_edit->showPageFooter();
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
$EstimateTypes_edit->terminate();
?>