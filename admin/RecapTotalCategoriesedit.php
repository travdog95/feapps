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
$RecapTotalCategories_edit = new RecapTotalCategories_edit();

// Run the page
$RecapTotalCategories_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapTotalCategories_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapTotalCategoriesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fRecapTotalCategoriesedit = currentForm = new ew.Form("fRecapTotalCategoriesedit", "edit");

	// Validate form
	fRecapTotalCategoriesedit.validate = function() {
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
			<?php if ($RecapTotalCategories_edit->RecapTotalCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RecapTotalCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapTotalCategories_edit->RecapTotalCategory_Idn->caption(), $RecapTotalCategories_edit->RecapTotalCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapTotalCategories_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapTotalCategories_edit->Name->caption(), $RecapTotalCategories_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapTotalCategories_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapTotalCategories_edit->Rank->caption(), $RecapTotalCategories_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapTotalCategories_edit->Rank->errorMessage()) ?>");
			<?php if ($RecapTotalCategories_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapTotalCategories_edit->ActiveFlag->caption(), $RecapTotalCategories_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fRecapTotalCategoriesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapTotalCategoriesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRecapTotalCategoriesedit.lists["x_ActiveFlag[]"] = <?php echo $RecapTotalCategories_edit->ActiveFlag->Lookup->toClientList($RecapTotalCategories_edit) ?>;
	fRecapTotalCategoriesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($RecapTotalCategories_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fRecapTotalCategoriesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapTotalCategories_edit->showPageHeader(); ?>
<?php
$RecapTotalCategories_edit->showMessage();
?>
<?php if (!$RecapTotalCategories_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapTotalCategories_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fRecapTotalCategoriesedit" id="fRecapTotalCategoriesedit" class="<?php echo $RecapTotalCategories_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapTotalCategories">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$RecapTotalCategories_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($RecapTotalCategories_edit->RecapTotalCategory_Idn->Visible) { // RecapTotalCategory_Idn ?>
	<div id="r_RecapTotalCategory_Idn" class="form-group row">
		<label id="elh_RecapTotalCategories_RecapTotalCategory_Idn" class="<?php echo $RecapTotalCategories_edit->LeftColumnClass ?>"><?php echo $RecapTotalCategories_edit->RecapTotalCategory_Idn->caption() ?><?php echo $RecapTotalCategories_edit->RecapTotalCategory_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapTotalCategories_edit->RightColumnClass ?>"><div <?php echo $RecapTotalCategories_edit->RecapTotalCategory_Idn->cellAttributes() ?>>
<span id="el_RecapTotalCategories_RecapTotalCategory_Idn">
<span<?php echo $RecapTotalCategories_edit->RecapTotalCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($RecapTotalCategories_edit->RecapTotalCategory_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_RecapTotalCategory_Idn" name="x_RecapTotalCategory_Idn" id="x_RecapTotalCategory_Idn" value="<?php echo HtmlEncode($RecapTotalCategories_edit->RecapTotalCategory_Idn->CurrentValue) ?>">
<?php echo $RecapTotalCategories_edit->RecapTotalCategory_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapTotalCategories_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_RecapTotalCategories_Name" for="x_Name" class="<?php echo $RecapTotalCategories_edit->LeftColumnClass ?>"><?php echo $RecapTotalCategories_edit->Name->caption() ?><?php echo $RecapTotalCategories_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapTotalCategories_edit->RightColumnClass ?>"><div <?php echo $RecapTotalCategories_edit->Name->cellAttributes() ?>>
<span id="el_RecapTotalCategories_Name">
<input type="text" data-table="RecapTotalCategories" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapTotalCategories_edit->Name->getPlaceHolder()) ?>" value="<?php echo $RecapTotalCategories_edit->Name->EditValue ?>"<?php echo $RecapTotalCategories_edit->Name->editAttributes() ?>>
</span>
<?php echo $RecapTotalCategories_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapTotalCategories_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_RecapTotalCategories_Rank" for="x_Rank" class="<?php echo $RecapTotalCategories_edit->LeftColumnClass ?>"><?php echo $RecapTotalCategories_edit->Rank->caption() ?><?php echo $RecapTotalCategories_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapTotalCategories_edit->RightColumnClass ?>"><div <?php echo $RecapTotalCategories_edit->Rank->cellAttributes() ?>>
<span id="el_RecapTotalCategories_Rank">
<input type="text" data-table="RecapTotalCategories" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapTotalCategories_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapTotalCategories_edit->Rank->EditValue ?>"<?php echo $RecapTotalCategories_edit->Rank->editAttributes() ?>>
</span>
<?php echo $RecapTotalCategories_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapTotalCategories_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_RecapTotalCategories_ActiveFlag" class="<?php echo $RecapTotalCategories_edit->LeftColumnClass ?>"><?php echo $RecapTotalCategories_edit->ActiveFlag->caption() ?><?php echo $RecapTotalCategories_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapTotalCategories_edit->RightColumnClass ?>"><div <?php echo $RecapTotalCategories_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_RecapTotalCategories_ActiveFlag">
<?php
$selwrk = ConvertToBool($RecapTotalCategories_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapTotalCategories" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_771777" value="1"<?php echo $selwrk ?><?php echo $RecapTotalCategories_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_771777"></label>
</div>
</span>
<?php echo $RecapTotalCategories_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$RecapTotalCategories_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $RecapTotalCategories_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapTotalCategories_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$RecapTotalCategories_edit->IsModal) { ?>
<?php echo $RecapTotalCategories_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$RecapTotalCategories_edit->showPageFooter();
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
$RecapTotalCategories_edit->terminate();
?>