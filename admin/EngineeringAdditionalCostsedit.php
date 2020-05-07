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
$EngineeringAdditionalCosts_edit = new EngineeringAdditionalCosts_edit();

// Run the page
$EngineeringAdditionalCosts_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$EngineeringAdditionalCosts_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fEngineeringAdditionalCostsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fEngineeringAdditionalCostsedit = currentForm = new ew.Form("fEngineeringAdditionalCostsedit", "edit");

	// Validate form
	fEngineeringAdditionalCostsedit.validate = function() {
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
			<?php if ($EngineeringAdditionalCosts_edit->EngineeringAdditionalCost_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_EngineeringAdditionalCost_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_edit->EngineeringAdditionalCost_Idn->caption(), $EngineeringAdditionalCosts_edit->EngineeringAdditionalCost_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EngineeringAdditionalCosts_edit->LineNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_LineNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_edit->LineNumber->caption(), $EngineeringAdditionalCosts_edit->LineNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LineNumber");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_edit->LineNumber->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_edit->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_edit->Quantity->caption(), $EngineeringAdditionalCosts_edit->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_edit->Quantity->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_edit->Name->caption(), $EngineeringAdditionalCosts_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EngineeringAdditionalCosts_edit->ManHours->Required) { ?>
				elm = this.getElements("x" + infix + "_ManHours");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_edit->ManHours->caption(), $EngineeringAdditionalCosts_edit->ManHours->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ManHours");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_edit->ManHours->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_edit->Rank->caption(), $EngineeringAdditionalCosts_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_edit->Rank->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_edit->Parent_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Parent_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_edit->Parent_Idn->caption(), $EngineeringAdditionalCosts_edit->Parent_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EngineeringAdditionalCosts_edit->DefaultFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_DefaultFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_edit->DefaultFlag->caption(), $EngineeringAdditionalCosts_edit->DefaultFlag->RequiredErrorMessage)) ?>");
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
	fEngineeringAdditionalCostsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fEngineeringAdditionalCostsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fEngineeringAdditionalCostsedit.lists["x_Parent_Idn"] = <?php echo $EngineeringAdditionalCosts_edit->Parent_Idn->Lookup->toClientList($EngineeringAdditionalCosts_edit) ?>;
	fEngineeringAdditionalCostsedit.lists["x_Parent_Idn"].options = <?php echo JsonEncode($EngineeringAdditionalCosts_edit->Parent_Idn->lookupOptions()) ?>;
	fEngineeringAdditionalCostsedit.lists["x_DefaultFlag[]"] = <?php echo $EngineeringAdditionalCosts_edit->DefaultFlag->Lookup->toClientList($EngineeringAdditionalCosts_edit) ?>;
	fEngineeringAdditionalCostsedit.lists["x_DefaultFlag[]"].options = <?php echo JsonEncode($EngineeringAdditionalCosts_edit->DefaultFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fEngineeringAdditionalCostsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $EngineeringAdditionalCosts_edit->showPageHeader(); ?>
<?php
$EngineeringAdditionalCosts_edit->showMessage();
?>
<?php if (!$EngineeringAdditionalCosts_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $EngineeringAdditionalCosts_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fEngineeringAdditionalCostsedit" id="fEngineeringAdditionalCostsedit" class="<?php echo $EngineeringAdditionalCosts_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="EngineeringAdditionalCosts">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$EngineeringAdditionalCosts_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($EngineeringAdditionalCosts_edit->EngineeringAdditionalCost_Idn->Visible) { // EngineeringAdditionalCost_Idn ?>
	<div id="r_EngineeringAdditionalCost_Idn" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn" class="<?php echo $EngineeringAdditionalCosts_edit->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_edit->EngineeringAdditionalCost_Idn->caption() ?><?php echo $EngineeringAdditionalCosts_edit->EngineeringAdditionalCost_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_edit->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_edit->EngineeringAdditionalCost_Idn->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn">
<span<?php echo $EngineeringAdditionalCosts_edit->EngineeringAdditionalCost_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($EngineeringAdditionalCosts_edit->EngineeringAdditionalCost_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_EngineeringAdditionalCost_Idn" name="x_EngineeringAdditionalCost_Idn" id="x_EngineeringAdditionalCost_Idn" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_edit->EngineeringAdditionalCost_Idn->CurrentValue) ?>">
<?php echo $EngineeringAdditionalCosts_edit->EngineeringAdditionalCost_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_edit->LineNumber->Visible) { // LineNumber ?>
	<div id="r_LineNumber" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_LineNumber" for="x_LineNumber" class="<?php echo $EngineeringAdditionalCosts_edit->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_edit->LineNumber->caption() ?><?php echo $EngineeringAdditionalCosts_edit->LineNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_edit->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_edit->LineNumber->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_LineNumber">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_LineNumber" name="x_LineNumber" id="x_LineNumber" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_edit->LineNumber->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_edit->LineNumber->EditValue ?>"<?php echo $EngineeringAdditionalCosts_edit->LineNumber->editAttributes() ?>>
</span>
<?php echo $EngineeringAdditionalCosts_edit->LineNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_edit->Quantity->Visible) { // Quantity ?>
	<div id="r_Quantity" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_Quantity" for="x_Quantity" class="<?php echo $EngineeringAdditionalCosts_edit->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_edit->Quantity->caption() ?><?php echo $EngineeringAdditionalCosts_edit->Quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_edit->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_edit->Quantity->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Quantity">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Quantity" name="x_Quantity" id="x_Quantity" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_edit->Quantity->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_edit->Quantity->EditValue ?>"<?php echo $EngineeringAdditionalCosts_edit->Quantity->editAttributes() ?>>
</span>
<?php echo $EngineeringAdditionalCosts_edit->Quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_Name" for="x_Name" class="<?php echo $EngineeringAdditionalCosts_edit->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_edit->Name->caption() ?><?php echo $EngineeringAdditionalCosts_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_edit->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_edit->Name->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Name">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_edit->Name->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_edit->Name->EditValue ?>"<?php echo $EngineeringAdditionalCosts_edit->Name->editAttributes() ?>>
</span>
<?php echo $EngineeringAdditionalCosts_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_edit->ManHours->Visible) { // ManHours ?>
	<div id="r_ManHours" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_ManHours" for="x_ManHours" class="<?php echo $EngineeringAdditionalCosts_edit->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_edit->ManHours->caption() ?><?php echo $EngineeringAdditionalCosts_edit->ManHours->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_edit->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_edit->ManHours->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_ManHours">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_ManHours" name="x_ManHours" id="x_ManHours" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_edit->ManHours->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_edit->ManHours->EditValue ?>"<?php echo $EngineeringAdditionalCosts_edit->ManHours->editAttributes() ?>>
</span>
<?php echo $EngineeringAdditionalCosts_edit->ManHours->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_Rank" for="x_Rank" class="<?php echo $EngineeringAdditionalCosts_edit->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_edit->Rank->caption() ?><?php echo $EngineeringAdditionalCosts_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_edit->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_edit->Rank->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Rank">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_edit->Rank->EditValue ?>"<?php echo $EngineeringAdditionalCosts_edit->Rank->editAttributes() ?>>
</span>
<?php echo $EngineeringAdditionalCosts_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_edit->Parent_Idn->Visible) { // Parent_Idn ?>
	<div id="r_Parent_Idn" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_Parent_Idn" for="x_Parent_Idn" class="<?php echo $EngineeringAdditionalCosts_edit->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_edit->Parent_Idn->caption() ?><?php echo $EngineeringAdditionalCosts_edit->Parent_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_edit->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_edit->Parent_Idn->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_Parent_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="EngineeringAdditionalCosts" data-field="x_Parent_Idn" data-value-separator="<?php echo $EngineeringAdditionalCosts_edit->Parent_Idn->displayValueSeparatorAttribute() ?>" id="x_Parent_Idn" name="x_Parent_Idn"<?php echo $EngineeringAdditionalCosts_edit->Parent_Idn->editAttributes() ?>>
			<?php echo $EngineeringAdditionalCosts_edit->Parent_Idn->selectOptionListHtml("x_Parent_Idn") ?>
		</select>
</div>
<?php echo $EngineeringAdditionalCosts_edit->Parent_Idn->Lookup->getParamTag($EngineeringAdditionalCosts_edit, "p_x_Parent_Idn") ?>
</span>
<?php echo $EngineeringAdditionalCosts_edit->Parent_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_edit->DefaultFlag->Visible) { // DefaultFlag ?>
	<div id="r_DefaultFlag" class="form-group row">
		<label id="elh_EngineeringAdditionalCosts_DefaultFlag" class="<?php echo $EngineeringAdditionalCosts_edit->LeftColumnClass ?>"><?php echo $EngineeringAdditionalCosts_edit->DefaultFlag->caption() ?><?php echo $EngineeringAdditionalCosts_edit->DefaultFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $EngineeringAdditionalCosts_edit->RightColumnClass ?>"><div <?php echo $EngineeringAdditionalCosts_edit->DefaultFlag->cellAttributes() ?>>
<span id="el_EngineeringAdditionalCosts_DefaultFlag">
<?php
$selwrk = ConvertToBool($EngineeringAdditionalCosts_edit->DefaultFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="EngineeringAdditionalCosts" data-field="x_DefaultFlag" name="x_DefaultFlag[]" id="x_DefaultFlag[]_898346" value="1"<?php echo $selwrk ?><?php echo $EngineeringAdditionalCosts_edit->DefaultFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_DefaultFlag[]_898346"></label>
</div>
</span>
<?php echo $EngineeringAdditionalCosts_edit->DefaultFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$EngineeringAdditionalCosts_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $EngineeringAdditionalCosts_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $EngineeringAdditionalCosts_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$EngineeringAdditionalCosts_edit->IsModal) { ?>
<?php echo $EngineeringAdditionalCosts_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$EngineeringAdditionalCosts_edit->showPageFooter();
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
$EngineeringAdditionalCosts_edit->terminate();
?>