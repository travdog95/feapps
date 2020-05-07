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
$PressureTypes_add = new PressureTypes_add();

// Run the page
$PressureTypes_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PressureTypes_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPressureTypesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fPressureTypesadd = currentForm = new ew.Form("fPressureTypesadd", "add");

	// Validate form
	fPressureTypesadd.validate = function() {
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
			<?php if ($PressureTypes_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PressureTypes_add->Name->caption(), $PressureTypes_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PressureTypes_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PressureTypes_add->Rank->caption(), $PressureTypes_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PressureTypes_add->Rank->errorMessage()) ?>");
			<?php if ($PressureTypes_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PressureTypes_add->ActiveFlag->caption(), $PressureTypes_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fPressureTypesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPressureTypesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fPressureTypesadd.lists["x_ActiveFlag[]"] = <?php echo $PressureTypes_add->ActiveFlag->Lookup->toClientList($PressureTypes_add) ?>;
	fPressureTypesadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($PressureTypes_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fPressureTypesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $PressureTypes_add->showPageHeader(); ?>
<?php
$PressureTypes_add->showMessage();
?>
<form name="fPressureTypesadd" id="fPressureTypesadd" class="<?php echo $PressureTypes_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PressureTypes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$PressureTypes_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($PressureTypes_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_PressureTypes_Name" for="x_Name" class="<?php echo $PressureTypes_add->LeftColumnClass ?>"><?php echo $PressureTypes_add->Name->caption() ?><?php echo $PressureTypes_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PressureTypes_add->RightColumnClass ?>"><div <?php echo $PressureTypes_add->Name->cellAttributes() ?>>
<span id="el_PressureTypes_Name">
<input type="text" data-table="PressureTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PressureTypes_add->Name->getPlaceHolder()) ?>" value="<?php echo $PressureTypes_add->Name->EditValue ?>"<?php echo $PressureTypes_add->Name->editAttributes() ?>>
</span>
<?php echo $PressureTypes_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PressureTypes_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_PressureTypes_Rank" for="x_Rank" class="<?php echo $PressureTypes_add->LeftColumnClass ?>"><?php echo $PressureTypes_add->Rank->caption() ?><?php echo $PressureTypes_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PressureTypes_add->RightColumnClass ?>"><div <?php echo $PressureTypes_add->Rank->cellAttributes() ?>>
<span id="el_PressureTypes_Rank">
<input type="text" data-table="PressureTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PressureTypes_add->Rank->getPlaceHolder()) ?>" value="<?php echo $PressureTypes_add->Rank->EditValue ?>"<?php echo $PressureTypes_add->Rank->editAttributes() ?>>
</span>
<?php echo $PressureTypes_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PressureTypes_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_PressureTypes_ActiveFlag" class="<?php echo $PressureTypes_add->LeftColumnClass ?>"><?php echo $PressureTypes_add->ActiveFlag->caption() ?><?php echo $PressureTypes_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PressureTypes_add->RightColumnClass ?>"><div <?php echo $PressureTypes_add->ActiveFlag->cellAttributes() ?>>
<span id="el_PressureTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($PressureTypes_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PressureTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_104424" value="1"<?php echo $selwrk ?><?php echo $PressureTypes_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_104424"></label>
</div>
</span>
<?php echo $PressureTypes_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$PressureTypes_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $PressureTypes_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $PressureTypes_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$PressureTypes_add->showPageFooter();
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
$PressureTypes_add->terminate();
?>