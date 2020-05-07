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
$WorksheetMasters_edit = new WorksheetMasters_edit();

// Run the page
$WorksheetMasters_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasters_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetMastersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fWorksheetMastersedit = currentForm = new ew.Form("fWorksheetMastersedit", "edit");

	// Validate form
	fWorksheetMastersedit.validate = function() {
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
			<?php if ($WorksheetMasters_edit->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_edit->WorksheetMaster_Idn->caption(), $WorksheetMasters_edit->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_edit->Name->caption(), $WorksheetMasters_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_edit->Department_Idn->caption(), $WorksheetMasters_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_edit->Rank->caption(), $WorksheetMasters_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasters_edit->Rank->errorMessage()) ?>");
			<?php if ($WorksheetMasters_edit->NumberOfColumns->Required) { ?>
				elm = this.getElements("x" + infix + "_NumberOfColumns");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_edit->NumberOfColumns->caption(), $WorksheetMasters_edit->NumberOfColumns->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumberOfColumns");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasters_edit->NumberOfColumns->errorMessage()) ?>");
			<?php if ($WorksheetMasters_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_edit->ActiveFlag->caption(), $WorksheetMasters_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fWorksheetMastersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetMastersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetMastersedit.lists["x_Department_Idn"] = <?php echo $WorksheetMasters_edit->Department_Idn->Lookup->toClientList($WorksheetMasters_edit) ?>;
	fWorksheetMastersedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($WorksheetMasters_edit->Department_Idn->lookupOptions()) ?>;
	fWorksheetMastersedit.lists["x_ActiveFlag[]"] = <?php echo $WorksheetMasters_edit->ActiveFlag->Lookup->toClientList($WorksheetMasters_edit) ?>;
	fWorksheetMastersedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($WorksheetMasters_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fWorksheetMastersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetMasters_edit->showPageHeader(); ?>
<?php
$WorksheetMasters_edit->showMessage();
?>
<?php if (!$WorksheetMasters_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetMasters_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fWorksheetMastersedit" id="fWorksheetMastersedit" class="<?php echo $WorksheetMasters_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetMasters">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$WorksheetMasters_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($WorksheetMasters_edit->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_WorksheetMasters_WorksheetMaster_Idn" class="<?php echo $WorksheetMasters_edit->LeftColumnClass ?>"><?php echo $WorksheetMasters_edit->WorksheetMaster_Idn->caption() ?><?php echo $WorksheetMasters_edit->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_edit->RightColumnClass ?>"><div <?php echo $WorksheetMasters_edit->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_WorksheetMasters_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasters_edit->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasters_edit->WorksheetMaster_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn" id="x_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasters_edit->WorksheetMaster_Idn->CurrentValue) ?>">
<?php echo $WorksheetMasters_edit->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_WorksheetMasters_Name" for="x_Name" class="<?php echo $WorksheetMasters_edit->LeftColumnClass ?>"><?php echo $WorksheetMasters_edit->Name->caption() ?><?php echo $WorksheetMasters_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_edit->RightColumnClass ?>"><div <?php echo $WorksheetMasters_edit->Name->cellAttributes() ?>>
<span id="el_WorksheetMasters_Name">
<input type="text" data-table="WorksheetMasters" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetMasters_edit->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_edit->Name->EditValue ?>"<?php echo $WorksheetMasters_edit->Name->editAttributes() ?>>
</span>
<?php echo $WorksheetMasters_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_WorksheetMasters_Department_Idn" for="x_Department_Idn" class="<?php echo $WorksheetMasters_edit->LeftColumnClass ?>"><?php echo $WorksheetMasters_edit->Department_Idn->caption() ?><?php echo $WorksheetMasters_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_edit->RightColumnClass ?>"><div <?php echo $WorksheetMasters_edit->Department_Idn->cellAttributes() ?>>
<span id="el_WorksheetMasters_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasters" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetMasters_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $WorksheetMasters_edit->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasters_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasters_edit->Department_Idn->Lookup->getParamTag($WorksheetMasters_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $WorksheetMasters_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_WorksheetMasters_Rank" for="x_Rank" class="<?php echo $WorksheetMasters_edit->LeftColumnClass ?>"><?php echo $WorksheetMasters_edit->Rank->caption() ?><?php echo $WorksheetMasters_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_edit->RightColumnClass ?>"><div <?php echo $WorksheetMasters_edit->Rank->cellAttributes() ?>>
<span id="el_WorksheetMasters_Rank">
<input type="text" data-table="WorksheetMasters" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_edit->Rank->EditValue ?>"<?php echo $WorksheetMasters_edit->Rank->editAttributes() ?>>
</span>
<?php echo $WorksheetMasters_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_edit->NumberOfColumns->Visible) { // NumberOfColumns ?>
	<div id="r_NumberOfColumns" class="form-group row">
		<label id="elh_WorksheetMasters_NumberOfColumns" for="x_NumberOfColumns" class="<?php echo $WorksheetMasters_edit->LeftColumnClass ?>"><?php echo $WorksheetMasters_edit->NumberOfColumns->caption() ?><?php echo $WorksheetMasters_edit->NumberOfColumns->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_edit->RightColumnClass ?>"><div <?php echo $WorksheetMasters_edit->NumberOfColumns->cellAttributes() ?>>
<span id="el_WorksheetMasters_NumberOfColumns">
<input type="text" data-table="WorksheetMasters" data-field="x_NumberOfColumns" name="x_NumberOfColumns" id="x_NumberOfColumns" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_edit->NumberOfColumns->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_edit->NumberOfColumns->EditValue ?>"<?php echo $WorksheetMasters_edit->NumberOfColumns->editAttributes() ?>>
</span>
<?php echo $WorksheetMasters_edit->NumberOfColumns->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_WorksheetMasters_ActiveFlag" class="<?php echo $WorksheetMasters_edit->LeftColumnClass ?>"><?php echo $WorksheetMasters_edit->ActiveFlag->caption() ?><?php echo $WorksheetMasters_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_edit->RightColumnClass ?>"><div <?php echo $WorksheetMasters_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_WorksheetMasters_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasters_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_611436" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_611436"></label>
</div>
</span>
<?php echo $WorksheetMasters_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("WorksheetMasterCategories", explode(",", $WorksheetMasters->getCurrentDetailTable())) && $WorksheetMasterCategories->DetailEdit) {
?>
<?php if ($WorksheetMasters->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("WorksheetMasterCategories", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "WorksheetMasterCategoriesgrid.php" ?>
<?php } ?>
<?php
	if (in_array("WorksheetMasterSizes", explode(",", $WorksheetMasters->getCurrentDetailTable())) && $WorksheetMasterSizes->DetailEdit) {
?>
<?php if ($WorksheetMasters->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("WorksheetMasterSizes", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "WorksheetMasterSizesgrid.php" ?>
<?php } ?>
<?php if (!$WorksheetMasters_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $WorksheetMasters_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetMasters_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$WorksheetMasters_edit->IsModal) { ?>
<?php echo $WorksheetMasters_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$WorksheetMasters_edit->showPageFooter();
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
$WorksheetMasters_edit->terminate();
?>