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
$PipeTypes_add = new PipeTypes_add();

// Run the page
$PipeTypes_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeTypes_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPipeTypesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fPipeTypesadd = currentForm = new ew.Form("fPipeTypesadd", "add");

	// Validate form
	fPipeTypesadd.validate = function() {
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
			<?php if ($PipeTypes_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_add->Name->caption(), $PipeTypes_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeTypes_add->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_add->Department_Idn->caption(), $PipeTypes_add->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeTypes_add->IsUnderground->Required) { ?>
				elm = this.getElements("x" + infix + "_IsUnderground[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_add->IsUnderground->caption(), $PipeTypes_add->IsUnderground->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeTypes_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_add->Rank->caption(), $PipeTypes_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PipeTypes_add->Rank->errorMessage()) ?>");
			<?php if ($PipeTypes_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_add->ActiveFlag->caption(), $PipeTypes_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fPipeTypesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPipeTypesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fPipeTypesadd.lists["x_Department_Idn"] = <?php echo $PipeTypes_add->Department_Idn->Lookup->toClientList($PipeTypes_add) ?>;
	fPipeTypesadd.lists["x_Department_Idn"].options = <?php echo JsonEncode($PipeTypes_add->Department_Idn->lookupOptions()) ?>;
	fPipeTypesadd.lists["x_IsUnderground[]"] = <?php echo $PipeTypes_add->IsUnderground->Lookup->toClientList($PipeTypes_add) ?>;
	fPipeTypesadd.lists["x_IsUnderground[]"].options = <?php echo JsonEncode($PipeTypes_add->IsUnderground->options(FALSE, TRUE)) ?>;
	fPipeTypesadd.lists["x_ActiveFlag[]"] = <?php echo $PipeTypes_add->ActiveFlag->Lookup->toClientList($PipeTypes_add) ?>;
	fPipeTypesadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($PipeTypes_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fPipeTypesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $PipeTypes_add->showPageHeader(); ?>
<?php
$PipeTypes_add->showMessage();
?>
<form name="fPipeTypesadd" id="fPipeTypesadd" class="<?php echo $PipeTypes_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeTypes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$PipeTypes_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($PipeTypes_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_PipeTypes_Name" for="x_Name" class="<?php echo $PipeTypes_add->LeftColumnClass ?>"><?php echo $PipeTypes_add->Name->caption() ?><?php echo $PipeTypes_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeTypes_add->RightColumnClass ?>"><div <?php echo $PipeTypes_add->Name->cellAttributes() ?>>
<span id="el_PipeTypes_Name">
<input type="text" data-table="PipeTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeTypes_add->Name->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_add->Name->EditValue ?>"<?php echo $PipeTypes_add->Name->editAttributes() ?>>
</span>
<?php echo $PipeTypes_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeTypes_add->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_PipeTypes_Department_Idn" for="x_Department_Idn" class="<?php echo $PipeTypes_add->LeftColumnClass ?>"><?php echo $PipeTypes_add->Department_Idn->caption() ?><?php echo $PipeTypes_add->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeTypes_add->RightColumnClass ?>"><div <?php echo $PipeTypes_add->Department_Idn->cellAttributes() ?>>
<span id="el_PipeTypes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="PipeTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $PipeTypes_add->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $PipeTypes_add->Department_Idn->editAttributes() ?>>
			<?php echo $PipeTypes_add->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $PipeTypes_add->Department_Idn->Lookup->getParamTag($PipeTypes_add, "p_x_Department_Idn") ?>
</span>
<?php echo $PipeTypes_add->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeTypes_add->IsUnderground->Visible) { // IsUnderground ?>
	<div id="r_IsUnderground" class="form-group row">
		<label id="elh_PipeTypes_IsUnderground" class="<?php echo $PipeTypes_add->LeftColumnClass ?>"><?php echo $PipeTypes_add->IsUnderground->caption() ?><?php echo $PipeTypes_add->IsUnderground->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeTypes_add->RightColumnClass ?>"><div <?php echo $PipeTypes_add->IsUnderground->cellAttributes() ?>>
<span id="el_PipeTypes_IsUnderground">
<?php
$selwrk = ConvertToBool($PipeTypes_add->IsUnderground->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_IsUnderground" name="x_IsUnderground[]" id="x_IsUnderground[]_509747" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_add->IsUnderground->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsUnderground[]_509747"></label>
</div>
</span>
<?php echo $PipeTypes_add->IsUnderground->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeTypes_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_PipeTypes_Rank" for="x_Rank" class="<?php echo $PipeTypes_add->LeftColumnClass ?>"><?php echo $PipeTypes_add->Rank->caption() ?><?php echo $PipeTypes_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeTypes_add->RightColumnClass ?>"><div <?php echo $PipeTypes_add->Rank->cellAttributes() ?>>
<span id="el_PipeTypes_Rank">
<input type="text" data-table="PipeTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeTypes_add->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_add->Rank->EditValue ?>"<?php echo $PipeTypes_add->Rank->editAttributes() ?>>
</span>
<?php echo $PipeTypes_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PipeTypes_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_PipeTypes_ActiveFlag" class="<?php echo $PipeTypes_add->LeftColumnClass ?>"><?php echo $PipeTypes_add->ActiveFlag->caption() ?><?php echo $PipeTypes_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PipeTypes_add->RightColumnClass ?>"><div <?php echo $PipeTypes_add->ActiveFlag->cellAttributes() ?>>
<span id="el_PipeTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($PipeTypes_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_926571" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_926571"></label>
</div>
</span>
<?php echo $PipeTypes_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$PipeTypes_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $PipeTypes_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $PipeTypes_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$PipeTypes_add->showPageFooter();
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
$PipeTypes_add->terminate();
?>