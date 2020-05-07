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
$ControlValves_add = new ControlValves_add();

// Run the page
$ControlValves_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ControlValves_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fControlValvesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fControlValvesadd = currentForm = new ew.Form("fControlValvesadd", "add");

	// Validate form
	fControlValvesadd.validate = function() {
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
			<?php if ($ControlValves_add->ControlValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ControlValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ControlValves_add->ControlValve_Idn->caption(), $ControlValves_add->ControlValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ControlValve_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ControlValves_add->ControlValve_Idn->errorMessage()) ?>");
			<?php if ($ControlValves_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ControlValves_add->Name->caption(), $ControlValves_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ControlValves_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ControlValves_add->Rank->caption(), $ControlValves_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ControlValves_add->Rank->errorMessage()) ?>");
			<?php if ($ControlValves_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ControlValves_add->ActiveFlag->caption(), $ControlValves_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fControlValvesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fControlValvesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fControlValvesadd.lists["x_ActiveFlag[]"] = <?php echo $ControlValves_add->ActiveFlag->Lookup->toClientList($ControlValves_add) ?>;
	fControlValvesadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ControlValves_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fControlValvesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ControlValves_add->showPageHeader(); ?>
<?php
$ControlValves_add->showMessage();
?>
<form name="fControlValvesadd" id="fControlValvesadd" class="<?php echo $ControlValves_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ControlValves">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ControlValves_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($ControlValves_add->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
	<div id="r_ControlValve_Idn" class="form-group row">
		<label id="elh_ControlValves_ControlValve_Idn" for="x_ControlValve_Idn" class="<?php echo $ControlValves_add->LeftColumnClass ?>"><?php echo $ControlValves_add->ControlValve_Idn->caption() ?><?php echo $ControlValves_add->ControlValve_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ControlValves_add->RightColumnClass ?>"><div <?php echo $ControlValves_add->ControlValve_Idn->cellAttributes() ?>>
<span id="el_ControlValves_ControlValve_Idn">
<input type="text" data-table="ControlValves" data-field="x_ControlValve_Idn" name="x_ControlValve_Idn" id="x_ControlValve_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ControlValves_add->ControlValve_Idn->getPlaceHolder()) ?>" value="<?php echo $ControlValves_add->ControlValve_Idn->EditValue ?>"<?php echo $ControlValves_add->ControlValve_Idn->editAttributes() ?>>
</span>
<?php echo $ControlValves_add->ControlValve_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ControlValves_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_ControlValves_Name" for="x_Name" class="<?php echo $ControlValves_add->LeftColumnClass ?>"><?php echo $ControlValves_add->Name->caption() ?><?php echo $ControlValves_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ControlValves_add->RightColumnClass ?>"><div <?php echo $ControlValves_add->Name->cellAttributes() ?>>
<span id="el_ControlValves_Name">
<input type="text" data-table="ControlValves" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ControlValves_add->Name->getPlaceHolder()) ?>" value="<?php echo $ControlValves_add->Name->EditValue ?>"<?php echo $ControlValves_add->Name->editAttributes() ?>>
</span>
<?php echo $ControlValves_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ControlValves_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_ControlValves_Rank" for="x_Rank" class="<?php echo $ControlValves_add->LeftColumnClass ?>"><?php echo $ControlValves_add->Rank->caption() ?><?php echo $ControlValves_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ControlValves_add->RightColumnClass ?>"><div <?php echo $ControlValves_add->Rank->cellAttributes() ?>>
<span id="el_ControlValves_Rank">
<input type="text" data-table="ControlValves" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ControlValves_add->Rank->getPlaceHolder()) ?>" value="<?php echo $ControlValves_add->Rank->EditValue ?>"<?php echo $ControlValves_add->Rank->editAttributes() ?>>
</span>
<?php echo $ControlValves_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ControlValves_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_ControlValves_ActiveFlag" class="<?php echo $ControlValves_add->LeftColumnClass ?>"><?php echo $ControlValves_add->ActiveFlag->caption() ?><?php echo $ControlValves_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ControlValves_add->RightColumnClass ?>"><div <?php echo $ControlValves_add->ActiveFlag->cellAttributes() ?>>
<span id="el_ControlValves_ActiveFlag">
<?php
$selwrk = ConvertToBool($ControlValves_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ControlValves" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_768915" value="1"<?php echo $selwrk ?><?php echo $ControlValves_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_768915"></label>
</div>
</span>
<?php echo $ControlValves_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ControlValves_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ControlValves_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ControlValves_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ControlValves_add->showPageFooter();
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
$ControlValves_add->terminate();
?>