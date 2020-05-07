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
$VolumeCorrections_add = new VolumeCorrections_add();

// Run the page
$VolumeCorrections_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$VolumeCorrections_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fVolumeCorrectionsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fVolumeCorrectionsadd = currentForm = new ew.Form("fVolumeCorrectionsadd", "add");

	// Validate form
	fVolumeCorrectionsadd.validate = function() {
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
			<?php if ($VolumeCorrections_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_add->Name->caption(), $VolumeCorrections_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($VolumeCorrections_add->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_add->Value->caption(), $VolumeCorrections_add->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($VolumeCorrections_add->Value->errorMessage()) ?>");
			<?php if ($VolumeCorrections_add->Hours->Required) { ?>
				elm = this.getElements("x" + infix + "_Hours");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_add->Hours->caption(), $VolumeCorrections_add->Hours->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Hours");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($VolumeCorrections_add->Hours->errorMessage()) ?>");
			<?php if ($VolumeCorrections_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_add->Rank->caption(), $VolumeCorrections_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($VolumeCorrections_add->Rank->errorMessage()) ?>");
			<?php if ($VolumeCorrections_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_add->ActiveFlag->caption(), $VolumeCorrections_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fVolumeCorrectionsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fVolumeCorrectionsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fVolumeCorrectionsadd.lists["x_ActiveFlag[]"] = <?php echo $VolumeCorrections_add->ActiveFlag->Lookup->toClientList($VolumeCorrections_add) ?>;
	fVolumeCorrectionsadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($VolumeCorrections_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fVolumeCorrectionsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $VolumeCorrections_add->showPageHeader(); ?>
<?php
$VolumeCorrections_add->showMessage();
?>
<form name="fVolumeCorrectionsadd" id="fVolumeCorrectionsadd" class="<?php echo $VolumeCorrections_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="VolumeCorrections">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$VolumeCorrections_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($VolumeCorrections_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_VolumeCorrections_Name" for="x_Name" class="<?php echo $VolumeCorrections_add->LeftColumnClass ?>"><?php echo $VolumeCorrections_add->Name->caption() ?><?php echo $VolumeCorrections_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $VolumeCorrections_add->RightColumnClass ?>"><div <?php echo $VolumeCorrections_add->Name->cellAttributes() ?>>
<span id="el_VolumeCorrections_Name">
<input type="text" data-table="VolumeCorrections" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($VolumeCorrections_add->Name->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_add->Name->EditValue ?>"<?php echo $VolumeCorrections_add->Name->editAttributes() ?>>
</span>
<?php echo $VolumeCorrections_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($VolumeCorrections_add->Value->Visible) { // Value ?>
	<div id="r_Value" class="form-group row">
		<label id="elh_VolumeCorrections_Value" for="x_Value" class="<?php echo $VolumeCorrections_add->LeftColumnClass ?>"><?php echo $VolumeCorrections_add->Value->caption() ?><?php echo $VolumeCorrections_add->Value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $VolumeCorrections_add->RightColumnClass ?>"><div <?php echo $VolumeCorrections_add->Value->cellAttributes() ?>>
<span id="el_VolumeCorrections_Value">
<input type="text" data-table="VolumeCorrections" data-field="x_Value" name="x_Value" id="x_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($VolumeCorrections_add->Value->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_add->Value->EditValue ?>"<?php echo $VolumeCorrections_add->Value->editAttributes() ?>>
</span>
<?php echo $VolumeCorrections_add->Value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($VolumeCorrections_add->Hours->Visible) { // Hours ?>
	<div id="r_Hours" class="form-group row">
		<label id="elh_VolumeCorrections_Hours" for="x_Hours" class="<?php echo $VolumeCorrections_add->LeftColumnClass ?>"><?php echo $VolumeCorrections_add->Hours->caption() ?><?php echo $VolumeCorrections_add->Hours->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $VolumeCorrections_add->RightColumnClass ?>"><div <?php echo $VolumeCorrections_add->Hours->cellAttributes() ?>>
<span id="el_VolumeCorrections_Hours">
<input type="text" data-table="VolumeCorrections" data-field="x_Hours" name="x_Hours" id="x_Hours" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_add->Hours->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_add->Hours->EditValue ?>"<?php echo $VolumeCorrections_add->Hours->editAttributes() ?>>
</span>
<?php echo $VolumeCorrections_add->Hours->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($VolumeCorrections_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_VolumeCorrections_Rank" for="x_Rank" class="<?php echo $VolumeCorrections_add->LeftColumnClass ?>"><?php echo $VolumeCorrections_add->Rank->caption() ?><?php echo $VolumeCorrections_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $VolumeCorrections_add->RightColumnClass ?>"><div <?php echo $VolumeCorrections_add->Rank->cellAttributes() ?>>
<span id="el_VolumeCorrections_Rank">
<input type="text" data-table="VolumeCorrections" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_add->Rank->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_add->Rank->EditValue ?>"<?php echo $VolumeCorrections_add->Rank->editAttributes() ?>>
</span>
<?php echo $VolumeCorrections_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($VolumeCorrections_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_VolumeCorrections_ActiveFlag" class="<?php echo $VolumeCorrections_add->LeftColumnClass ?>"><?php echo $VolumeCorrections_add->ActiveFlag->caption() ?><?php echo $VolumeCorrections_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $VolumeCorrections_add->RightColumnClass ?>"><div <?php echo $VolumeCorrections_add->ActiveFlag->cellAttributes() ?>>
<span id="el_VolumeCorrections_ActiveFlag">
<?php
$selwrk = ConvertToBool($VolumeCorrections_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="VolumeCorrections" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_226705" value="1"<?php echo $selwrk ?><?php echo $VolumeCorrections_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_226705"></label>
</div>
</span>
<?php echo $VolumeCorrections_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$VolumeCorrections_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $VolumeCorrections_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $VolumeCorrections_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$VolumeCorrections_add->showPageFooter();
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
$VolumeCorrections_add->terminate();
?>