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
$LiftDurations_add = new LiftDurations_add();

// Run the page
$LiftDurations_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LiftDurations_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fLiftDurationsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fLiftDurationsadd = currentForm = new ew.Form("fLiftDurationsadd", "add");

	// Validate form
	fLiftDurationsadd.validate = function() {
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
			<?php if ($LiftDurations_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LiftDurations_add->Name->caption(), $LiftDurations_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($LiftDurations_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LiftDurations_add->Rank->caption(), $LiftDurations_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($LiftDurations_add->Rank->errorMessage()) ?>");
			<?php if ($LiftDurations_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LiftDurations_add->ActiveFlag->caption(), $LiftDurations_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fLiftDurationsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fLiftDurationsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fLiftDurationsadd.lists["x_ActiveFlag[]"] = <?php echo $LiftDurations_add->ActiveFlag->Lookup->toClientList($LiftDurations_add) ?>;
	fLiftDurationsadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($LiftDurations_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fLiftDurationsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $LiftDurations_add->showPageHeader(); ?>
<?php
$LiftDurations_add->showMessage();
?>
<form name="fLiftDurationsadd" id="fLiftDurationsadd" class="<?php echo $LiftDurations_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LiftDurations">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$LiftDurations_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($LiftDurations_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_LiftDurations_Name" for="x_Name" class="<?php echo $LiftDurations_add->LeftColumnClass ?>"><?php echo $LiftDurations_add->Name->caption() ?><?php echo $LiftDurations_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LiftDurations_add->RightColumnClass ?>"><div <?php echo $LiftDurations_add->Name->cellAttributes() ?>>
<span id="el_LiftDurations_Name">
<input type="text" data-table="LiftDurations" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($LiftDurations_add->Name->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_add->Name->EditValue ?>"<?php echo $LiftDurations_add->Name->editAttributes() ?>>
</span>
<?php echo $LiftDurations_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LiftDurations_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_LiftDurations_Rank" for="x_Rank" class="<?php echo $LiftDurations_add->LeftColumnClass ?>"><?php echo $LiftDurations_add->Rank->caption() ?><?php echo $LiftDurations_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LiftDurations_add->RightColumnClass ?>"><div <?php echo $LiftDurations_add->Rank->cellAttributes() ?>>
<span id="el_LiftDurations_Rank">
<input type="text" data-table="LiftDurations" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($LiftDurations_add->Rank->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_add->Rank->EditValue ?>"<?php echo $LiftDurations_add->Rank->editAttributes() ?>>
</span>
<?php echo $LiftDurations_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LiftDurations_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_LiftDurations_ActiveFlag" class="<?php echo $LiftDurations_add->LeftColumnClass ?>"><?php echo $LiftDurations_add->ActiveFlag->caption() ?><?php echo $LiftDurations_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LiftDurations_add->RightColumnClass ?>"><div <?php echo $LiftDurations_add->ActiveFlag->cellAttributes() ?>>
<span id="el_LiftDurations_ActiveFlag">
<?php
$selwrk = ConvertToBool($LiftDurations_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="LiftDurations" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_720572" value="1"<?php echo $selwrk ?><?php echo $LiftDurations_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_720572"></label>
</div>
</span>
<?php echo $LiftDurations_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$LiftDurations_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $LiftDurations_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $LiftDurations_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$LiftDurations_add->showPageFooter();
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
$LiftDurations_add->terminate();
?>