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
$RecapSubtotalCategories_add = new RecapSubtotalCategories_add();

// Run the page
$RecapSubtotalCategories_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapSubtotalCategories_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapSubtotalCategoriesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fRecapSubtotalCategoriesadd = currentForm = new ew.Form("fRecapSubtotalCategoriesadd", "add");

	// Validate form
	fRecapSubtotalCategoriesadd.validate = function() {
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
			<?php if ($RecapSubtotalCategories_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapSubtotalCategories_add->Name->caption(), $RecapSubtotalCategories_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapSubtotalCategories_add->Percentage->Required) { ?>
				elm = this.getElements("x" + infix + "_Percentage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapSubtotalCategories_add->Percentage->caption(), $RecapSubtotalCategories_add->Percentage->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Percentage");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapSubtotalCategories_add->Percentage->errorMessage()) ?>");
			<?php if ($RecapSubtotalCategories_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapSubtotalCategories_add->Rank->caption(), $RecapSubtotalCategories_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapSubtotalCategories_add->Rank->errorMessage()) ?>");

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
	fRecapSubtotalCategoriesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapSubtotalCategoriesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fRecapSubtotalCategoriesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapSubtotalCategories_add->showPageHeader(); ?>
<?php
$RecapSubtotalCategories_add->showMessage();
?>
<form name="fRecapSubtotalCategoriesadd" id="fRecapSubtotalCategoriesadd" class="<?php echo $RecapSubtotalCategories_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapSubtotalCategories">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$RecapSubtotalCategories_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($RecapSubtotalCategories_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_RecapSubtotalCategories_Name" for="x_Name" class="<?php echo $RecapSubtotalCategories_add->LeftColumnClass ?>"><?php echo $RecapSubtotalCategories_add->Name->caption() ?><?php echo $RecapSubtotalCategories_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapSubtotalCategories_add->RightColumnClass ?>"><div <?php echo $RecapSubtotalCategories_add->Name->cellAttributes() ?>>
<span id="el_RecapSubtotalCategories_Name">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_add->Name->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_add->Name->EditValue ?>"<?php echo $RecapSubtotalCategories_add->Name->editAttributes() ?>>
</span>
<?php echo $RecapSubtotalCategories_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapSubtotalCategories_add->Percentage->Visible) { // Percentage ?>
	<div id="r_Percentage" class="form-group row">
		<label id="elh_RecapSubtotalCategories_Percentage" for="x_Percentage" class="<?php echo $RecapSubtotalCategories_add->LeftColumnClass ?>"><?php echo $RecapSubtotalCategories_add->Percentage->caption() ?><?php echo $RecapSubtotalCategories_add->Percentage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapSubtotalCategories_add->RightColumnClass ?>"><div <?php echo $RecapSubtotalCategories_add->Percentage->cellAttributes() ?>>
<span id="el_RecapSubtotalCategories_Percentage">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Percentage" name="x_Percentage" id="x_Percentage" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_add->Percentage->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_add->Percentage->EditValue ?>"<?php echo $RecapSubtotalCategories_add->Percentage->editAttributes() ?>>
</span>
<?php echo $RecapSubtotalCategories_add->Percentage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapSubtotalCategories_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_RecapSubtotalCategories_Rank" for="x_Rank" class="<?php echo $RecapSubtotalCategories_add->LeftColumnClass ?>"><?php echo $RecapSubtotalCategories_add->Rank->caption() ?><?php echo $RecapSubtotalCategories_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapSubtotalCategories_add->RightColumnClass ?>"><div <?php echo $RecapSubtotalCategories_add->Rank->cellAttributes() ?>>
<span id="el_RecapSubtotalCategories_Rank">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_add->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_add->Rank->EditValue ?>"<?php echo $RecapSubtotalCategories_add->Rank->editAttributes() ?>>
</span>
<?php echo $RecapSubtotalCategories_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$RecapSubtotalCategories_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $RecapSubtotalCategories_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapSubtotalCategories_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$RecapSubtotalCategories_add->showPageFooter();
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
$RecapSubtotalCategories_add->terminate();
?>