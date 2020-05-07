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
$JobDefaultTypes_add = new JobDefaultTypes_add();

// Run the page
$JobDefaultTypes_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobDefaultTypes_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fJobDefaultTypesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fJobDefaultTypesadd = currentForm = new ew.Form("fJobDefaultTypesadd", "add");

	// Validate form
	fJobDefaultTypesadd.validate = function() {
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
			<?php if ($JobDefaultTypes_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaultTypes_add->Name->caption(), $JobDefaultTypes_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaultTypes_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaultTypes_add->Rank->caption(), $JobDefaultTypes_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobDefaultTypes_add->Rank->errorMessage()) ?>");
			<?php if ($JobDefaultTypes_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaultTypes_add->ActiveFlag->caption(), $JobDefaultTypes_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fJobDefaultTypesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fJobDefaultTypesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fJobDefaultTypesadd.lists["x_ActiveFlag[]"] = <?php echo $JobDefaultTypes_add->ActiveFlag->Lookup->toClientList($JobDefaultTypes_add) ?>;
	fJobDefaultTypesadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($JobDefaultTypes_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fJobDefaultTypesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $JobDefaultTypes_add->showPageHeader(); ?>
<?php
$JobDefaultTypes_add->showMessage();
?>
<form name="fJobDefaultTypesadd" id="fJobDefaultTypesadd" class="<?php echo $JobDefaultTypes_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobDefaultTypes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$JobDefaultTypes_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($JobDefaultTypes_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_JobDefaultTypes_Name" for="x_Name" class="<?php echo $JobDefaultTypes_add->LeftColumnClass ?>"><?php echo $JobDefaultTypes_add->Name->caption() ?><?php echo $JobDefaultTypes_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaultTypes_add->RightColumnClass ?>"><div <?php echo $JobDefaultTypes_add->Name->cellAttributes() ?>>
<span id="el_JobDefaultTypes_Name">
<input type="text" data-table="JobDefaultTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobDefaultTypes_add->Name->getPlaceHolder()) ?>" value="<?php echo $JobDefaultTypes_add->Name->EditValue ?>"<?php echo $JobDefaultTypes_add->Name->editAttributes() ?>>
</span>
<?php echo $JobDefaultTypes_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaultTypes_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_JobDefaultTypes_Rank" for="x_Rank" class="<?php echo $JobDefaultTypes_add->LeftColumnClass ?>"><?php echo $JobDefaultTypes_add->Rank->caption() ?><?php echo $JobDefaultTypes_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaultTypes_add->RightColumnClass ?>"><div <?php echo $JobDefaultTypes_add->Rank->cellAttributes() ?>>
<span id="el_JobDefaultTypes_Rank">
<input type="text" data-table="JobDefaultTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaultTypes_add->Rank->getPlaceHolder()) ?>" value="<?php echo $JobDefaultTypes_add->Rank->EditValue ?>"<?php echo $JobDefaultTypes_add->Rank->editAttributes() ?>>
</span>
<?php echo $JobDefaultTypes_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobDefaultTypes_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_JobDefaultTypes_ActiveFlag" class="<?php echo $JobDefaultTypes_add->LeftColumnClass ?>"><?php echo $JobDefaultTypes_add->ActiveFlag->caption() ?><?php echo $JobDefaultTypes_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobDefaultTypes_add->RightColumnClass ?>"><div <?php echo $JobDefaultTypes_add->ActiveFlag->cellAttributes() ?>>
<span id="el_JobDefaultTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobDefaultTypes_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobDefaultTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_372977" value="1"<?php echo $selwrk ?><?php echo $JobDefaultTypes_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_372977"></label>
</div>
</span>
<?php echo $JobDefaultTypes_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$JobDefaultTypes_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $JobDefaultTypes_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobDefaultTypes_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$JobDefaultTypes_add->showPageFooter();
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
$JobDefaultTypes_add->terminate();
?>