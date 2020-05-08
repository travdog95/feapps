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
$EngineeringAdditionalCosts_add = new EngineeringAdditionalCosts_add();

// Run the page
$EngineeringAdditionalCosts_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$EngineeringAdditionalCosts_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fEngineeringAdditionalCostsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fEngineeringAdditionalCostsadd = currentForm = new ew.Form("fEngineeringAdditionalCostsadd", "add");

	// Validate form
	fEngineeringAdditionalCostsadd.validate = function() {
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
			<?php if ($EngineeringAdditionalCosts_add->LineNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_LineNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_add->LineNumber->caption(), $EngineeringAdditionalCosts_add->LineNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LineNumber");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_add->LineNumber->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_add->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_add->Quantity->caption(), $EngineeringAdditionalCosts_add->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_add->Quantity->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_add->Name->caption(), $EngineeringAdditionalCosts_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EngineeringAdditionalCosts_add->ManHours->Required) { ?>
				elm = this.getElements("x" + infix + "_ManHours");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_add->ManHours->caption(), $EngineeringAdditionalCosts_add->ManHours->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ManHours");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_add->ManHours->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_add->Rank->caption(), $EngineeringAdditionalCosts_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_add->Rank->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_add->Parent_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Parent_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_add->Parent_Idn->caption(), $EngineeringAdditionalCosts_add->Parent_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EngineeringAdditionalCosts_add->DefaultFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_DefaultFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_add->DefaultFlag->caption(), $EngineeringAdditionalCosts_add->DefaultFlag->RequiredErrorMessage)) ?>");
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
	fEngineeringAdditionalCostsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fEngineeringAdditionalCostsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fEngineeringAdditionalCostsadd.lists["x_Parent_Idn"] = <?php echo $EngineeringAdditionalCosts_add->Parent_Idn->Lookup->toClientList($EngineeringAdditionalCosts_add) ?>;
	fEngineeringAdditionalCostsadd.lists["x_Parent_Idn"].options = <?php echo JsonEncode($EngineeringAdditionalCosts_add->Parent_Idn->lookupOptions()) ?>;
	fEngineeringAdditionalCostsadd.lists["x_DefaultFlag[]"] = <?php echo $EngineeringAdditionalCosts_add->DefaultFlag->Lookup->toClientList($EngineeringAdditionalCosts_add) ?>;
	fEngineeringAdditionalCostsadd.lists["x_DefaultFlag[]"].options = <?php echo JsonEncode($EngineeringAdditionalCosts_add->DefaultFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fEngineeringAdditionalCostsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $EngineeringAdditionalCosts_add->showPageHeader(); ?>
<?php
$EngineeringAdditionalCosts_add->showMessage();
?>
<form name="fEngineeringAdditionalCostsadd" id="fEngineeringAdditionalCostsadd" class="<?php echo $EngineeringAdditionalCosts_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="EngineeringAdditionalCosts">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$EngineeringAdditionalCosts_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($EngineeringAdditionalCosts_add->LineNumber->Visible) { // LineNumber ?>
	<div id="r_LineNumber" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_LineNumber" for="x_LineNumber" class="<?php echo $EngineeringAdditionalCosts_add->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_add->LineNumber->caption() ?><?php echo $EngineeringAdditionalCosts_add->LineNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_add->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_add->LineNumber->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_LineNumber">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_LineNumber" name="x_LineNumber" id="x_LineNumber" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_add->LineNumber->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_add->LineNumber->EditValue ?>"<?php echo $EngineeringAdditionalCosts_add->LineNumber->editAttributes() ?>>
</span>
<?php echo $EngineeringAdditionalCosts_add->LineNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_add->Quantity->Visible) { // Quantity ?>
	<div id="r_Quantity" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_Quantity" for="x_Quantity" class="<?php echo $EngineeringAdditionalCosts_add->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_add->Quantity->caption() ?><?php echo $EngineeringAdditionalCosts_add->Quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_add->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_add->Quantity->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Quantity">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_add->Quantity->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_add->Quantity->EditValue ?>"<?php echo $EngineeringAdditionalCosts_add->Quantity->editAttributes() ?>>
</span>
<?php echo $EngineeringAdditionalCosts_add->Quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_Name" for="x_Name" class="<?php echo $EngineeringAdditionalCosts_add->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_add->Name->caption() ?><?php echo $EngineeringAdditionalCosts_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_add->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_add->Name->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Name">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_add->Name->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_add->Name->EditValue ?>"<?php echo $EngineeringAdditionalCosts_add->Name->editAttributes() ?>>
</span>
<?php echo $EngineeringAdditionalCosts_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_add->ManHours->Visible) { // ManHours ?>
	<div id="r_ManHours" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_ManHours" for="x_ManHours" class="<?php echo $EngineeringAdditionalCosts_add->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_add->ManHours->caption() ?><?php echo $EngineeringAdditionalCosts_add->ManHours->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_add->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_add->ManHours->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_ManHours">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_ManHours" name="x_ManHours" id="x_ManHours" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_add->ManHours->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_add->ManHours->EditValue ?>"<?php echo $EngineeringAdditionalCosts_add->ManHours->editAttributes() ?>>
</span>
<?php echo $EngineeringAdditionalCosts_add->ManHours->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_Rank" for="x_Rank" class="<?php echo $EngineeringAdditionalCosts_add->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_add->Rank->caption() ?><?php echo $EngineeringAdditionalCosts_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_add->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_add->Rank->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Rank">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_add->Rank->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_add->Rank->EditValue ?>"<?php echo $EngineeringAdditionalCosts_add->Rank->editAttributes() ?>>
</span>
<?php echo $EngineeringAdditionalCosts_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_add->Parent_Idn->Visible) { // Parent_Idn ?>
	<div id="r_Parent_Idn" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_Parent_Idn" for="x_Parent_Idn" class="<?php echo $EngineeringAdditionalCosts_add->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_add->Parent_Idn->caption() ?><?php echo $EngineeringAdditionalCosts_add->Parent_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_add->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_add->Parent_Idn->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Parent_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="EngineeringAdditionalCosts" data-field="x_Parent_Idn" data-value-separator="<?php echo $EngineeringAdditionalCosts_add->Parent_Idn->displayValueSeparatorAttribute() ?>" id="x_Parent_Idn" name="x_Parent_Idn"<?php echo $EngineeringAdditionalCosts_add->Parent_Idn->editAttributes() ?>>
			<?php echo $EngineeringAdditionalCosts_add->Parent_Idn->selectOptionListHtml("x_Parent_Idn") ?>
		</select>
</div>
<?php echo $EngineeringAdditionalCosts_add->Parent_Idn->Lookup->getParamTag($EngineeringAdditionalCosts_add, "p_x_Parent_Idn") ?>
</span>
<?php echo $EngineeringAdditionalCosts_add->Parent_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_add->DefaultFlag->Visible) { // DefaultFlag ?>
	<div id="r_DefaultFlag" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_DefaultFlag" class="<?php echo $EngineeringAdditionalCosts_add->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_add->DefaultFlag->caption() ?><?php echo $EngineeringAdditionalCosts_add->DefaultFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_add->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_add->DefaultFlag->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_DefaultFlag">
<?php
$selwrk = ConvertToBool($EngineeringAdditionalCosts_add->DefaultFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="EngineeringAdditionalCosts" data-field="x_DefaultFlag" name="x_DefaultFlag[]" id="x_DefaultFlag[]_967815" value="1"<?php echo $selwrk ?><?php echo $EngineeringAdditionalCosts_add->DefaultFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_DefaultFlag[]_967815"></label>
</div>
</span>
<?php echo $EngineeringAdditionalCosts_add->DefaultFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$EngineeringAdditionalCosts_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $EngineeringAdditionalCosts_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $EngineeringAdditionalCosts_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$EngineeringAdditionalCosts_add->showPageFooter();
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
$EngineeringAdditionalCosts_add->terminate();
?>