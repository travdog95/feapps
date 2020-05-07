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
$AdjustmentFactors_add = new AdjustmentFactors_add();

// Run the page
$AdjustmentFactors_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AdjustmentFactors_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fAdjustmentFactorsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fAdjustmentFactorsadd = currentForm = new ew.Form("fAdjustmentFactorsadd", "add");

	// Validate form
	fAdjustmentFactorsadd.validate = function() {
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
			<?php if ($AdjustmentFactors_add->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_add->WorksheetMaster_Idn->caption(), $AdjustmentFactors_add->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentFactors_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_add->Name->caption(), $AdjustmentFactors_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentFactors_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_add->Rank->caption(), $AdjustmentFactors_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($AdjustmentFactors_add->Rank->errorMessage()) ?>");
			<?php if ($AdjustmentFactors_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_add->ActiveFlag->caption(), $AdjustmentFactors_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fAdjustmentFactorsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fAdjustmentFactorsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fAdjustmentFactorsadd.lists["x_WorksheetMaster_Idn"] = <?php echo $AdjustmentFactors_add->WorksheetMaster_Idn->Lookup->toClientList($AdjustmentFactors_add) ?>;
	fAdjustmentFactorsadd.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($AdjustmentFactors_add->WorksheetMaster_Idn->lookupOptions()) ?>;
	fAdjustmentFactorsadd.lists["x_ActiveFlag[]"] = <?php echo $AdjustmentFactors_add->ActiveFlag->Lookup->toClientList($AdjustmentFactors_add) ?>;
	fAdjustmentFactorsadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($AdjustmentFactors_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fAdjustmentFactorsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $AdjustmentFactors_add->showPageHeader(); ?>
<?php
$AdjustmentFactors_add->showMessage();
?>
<form name="fAdjustmentFactorsadd" id="fAdjustmentFactorsadd" class="<?php echo $AdjustmentFactors_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AdjustmentFactors">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$AdjustmentFactors_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($AdjustmentFactors_add->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_AdjustmentFactors_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $AdjustmentFactors_add->LeftColumnClass ?>"><?php echo $AdjustmentFactors_add->WorksheetMaster_Idn->caption() ?><?php echo $AdjustmentFactors_add->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentFactors_add->RightColumnClass ?>"><div <?php echo $AdjustmentFactors_add->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_AdjustmentFactors_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentFactors" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $AdjustmentFactors_add->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $AdjustmentFactors_add->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $AdjustmentFactors_add->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentFactors_add->WorksheetMaster_Idn->Lookup->getParamTag($AdjustmentFactors_add, "p_x_WorksheetMaster_Idn") ?>
</span>
<?php echo $AdjustmentFactors_add->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentFactors_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_AdjustmentFactors_Name" for="x_Name" class="<?php echo $AdjustmentFactors_add->LeftColumnClass ?>"><?php echo $AdjustmentFactors_add->Name->caption() ?><?php echo $AdjustmentFactors_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentFactors_add->RightColumnClass ?>"><div <?php echo $AdjustmentFactors_add->Name->cellAttributes() ?>>
<span id="el_AdjustmentFactors_Name">
<input type="text" data-table="AdjustmentFactors" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentFactors_add->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_add->Name->EditValue ?>"<?php echo $AdjustmentFactors_add->Name->editAttributes() ?>>
</span>
<?php echo $AdjustmentFactors_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentFactors_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_AdjustmentFactors_Rank" for="x_Rank" class="<?php echo $AdjustmentFactors_add->LeftColumnClass ?>"><?php echo $AdjustmentFactors_add->Rank->caption() ?><?php echo $AdjustmentFactors_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentFactors_add->RightColumnClass ?>"><div <?php echo $AdjustmentFactors_add->Rank->cellAttributes() ?>>
<span id="el_AdjustmentFactors_Rank">
<input type="text" data-table="AdjustmentFactors" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentFactors_add->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_add->Rank->EditValue ?>"<?php echo $AdjustmentFactors_add->Rank->editAttributes() ?>>
</span>
<?php echo $AdjustmentFactors_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AdjustmentFactors_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_AdjustmentFactors_ActiveFlag" class="<?php echo $AdjustmentFactors_add->LeftColumnClass ?>"><?php echo $AdjustmentFactors_add->ActiveFlag->caption() ?><?php echo $AdjustmentFactors_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AdjustmentFactors_add->RightColumnClass ?>"><div <?php echo $AdjustmentFactors_add->ActiveFlag->cellAttributes() ?>>
<span id="el_AdjustmentFactors_ActiveFlag">
<?php
$selwrk = ConvertToBool($AdjustmentFactors_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentFactors" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_187646" value="1"<?php echo $selwrk ?><?php echo $AdjustmentFactors_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_187646"></label>
</div>
</span>
<?php echo $AdjustmentFactors_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("AdjustmentSubFactors", explode(",", $AdjustmentFactors->getCurrentDetailTable())) && $AdjustmentSubFactors->DetailAdd) {
?>
<?php if ($AdjustmentFactors->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("AdjustmentSubFactors", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "AdjustmentSubFactorsgrid.php" ?>
<?php } ?>
<?php if (!$AdjustmentFactors_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $AdjustmentFactors_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $AdjustmentFactors_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$AdjustmentFactors_add->showPageFooter();
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
$AdjustmentFactors_add->terminate();
?>