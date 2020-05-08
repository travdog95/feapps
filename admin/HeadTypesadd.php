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
$HeadTypes_add = new HeadTypes_add();

// Run the page
$HeadTypes_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HeadTypes_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fHeadTypesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fHeadTypesadd = currentForm = new ew.Form("fHeadTypesadd", "add");

	// Validate form
	fHeadTypesadd.validate = function() {
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
			<?php if ($HeadTypes_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HeadTypes_add->Name->caption(), $HeadTypes_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HeadTypes_add->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HeadTypes_add->ShortName->caption(), $HeadTypes_add->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HeadTypes_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HeadTypes_add->Rank->caption(), $HeadTypes_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($HeadTypes_add->Rank->errorMessage()) ?>");
			<?php if ($HeadTypes_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HeadTypes_add->ActiveFlag->caption(), $HeadTypes_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fHeadTypesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fHeadTypesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fHeadTypesadd.lists["x_ActiveFlag[]"] = <?php echo $HeadTypes_add->ActiveFlag->Lookup->toClientList($HeadTypes_add) ?>;
	fHeadTypesadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($HeadTypes_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fHeadTypesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $HeadTypes_add->showPageHeader(); ?>
<?php
$HeadTypes_add->showMessage();
?>
<form name="fHeadTypesadd" id="fHeadTypesadd" class="<?php echo $HeadTypes_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="HeadTypes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$HeadTypes_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($HeadTypes_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_HeadTypes_Name" for="x_Name" class="<?php echo $HeadTypes_add->LeftColumnClass ?>"><?php echo $HeadTypes_add->Name->caption() ?><?php echo $HeadTypes_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $HeadTypes_add->RightColumnClass ?>"><div <?php echo $HeadTypes_add->Name->cellAttributes() ?>>
<span id="el_HeadTypes_Name">
<input type="text" data-table="HeadTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HeadTypes_add->Name->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_add->Name->EditValue ?>"<?php echo $HeadTypes_add->Name->editAttributes() ?>>
</span>
<?php echo $HeadTypes_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($HeadTypes_add->ShortName->Visible) { // ShortName ?>
	<div id="r_ShortName" class="form-group row">
		<label id="elh_HeadTypes_ShortName" for="x_ShortName" class="<?php echo $HeadTypes_add->LeftColumnClass ?>"><?php echo $HeadTypes_add->ShortName->caption() ?><?php echo $HeadTypes_add->ShortName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $HeadTypes_add->RightColumnClass ?>"><div <?php echo $HeadTypes_add->ShortName->cellAttributes() ?>>
<span id="el_HeadTypes_ShortName">
<input type="text" data-table="HeadTypes" data-field="x_ShortName" name="x_ShortName" id="x_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($HeadTypes_add->ShortName->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_add->ShortName->EditValue ?>"<?php echo $HeadTypes_add->ShortName->editAttributes() ?>>
</span>
<?php echo $HeadTypes_add->ShortName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($HeadTypes_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_HeadTypes_Rank" for="x_Rank" class="<?php echo $HeadTypes_add->LeftColumnClass ?>"><?php echo $HeadTypes_add->Rank->caption() ?><?php echo $HeadTypes_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $HeadTypes_add->RightColumnClass ?>"><div <?php echo $HeadTypes_add->Rank->cellAttributes() ?>>
<span id="el_HeadTypes_Rank">
<input type="text" data-table="HeadTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HeadTypes_add->Rank->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_add->Rank->EditValue ?>"<?php echo $HeadTypes_add->Rank->editAttributes() ?>>
</span>
<?php echo $HeadTypes_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($HeadTypes_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_HeadTypes_ActiveFlag" class="<?php echo $HeadTypes_add->LeftColumnClass ?>"><?php echo $HeadTypes_add->ActiveFlag->caption() ?><?php echo $HeadTypes_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $HeadTypes_add->RightColumnClass ?>"><div <?php echo $HeadTypes_add->ActiveFlag->cellAttributes() ?>>
<span id="el_HeadTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($HeadTypes_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HeadTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_583653" value="1"<?php echo $selwrk ?><?php echo $HeadTypes_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_583653"></label>
</div>
</span>
<?php echo $HeadTypes_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$HeadTypes_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $HeadTypes_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $HeadTypes_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$HeadTypes_add->showPageFooter();
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
$HeadTypes_add->terminate();
?>