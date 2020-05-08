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
$WorksheetCategories_edit = new WorksheetCategories_edit();

// Run the page
$WorksheetCategories_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetCategories_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetCategoriesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fWorksheetCategoriesedit = currentForm = new ew.Form("fWorksheetCategoriesedit", "edit");

	// Validate form
	fWorksheetCategoriesedit.validate = function() {
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
			<?php if ($WorksheetCategories_edit->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_edit->WorksheetCategory_Idn->caption(), $WorksheetCategories_edit->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_edit->Name->caption(), $WorksheetCategories_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_edit->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_edit->ShortName->caption(), $WorksheetCategories_edit->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_edit->Department_Idn->caption(), $WorksheetCategories_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_edit->FieldUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_edit->FieldUnitPrice->caption(), $WorksheetCategories_edit->FieldUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetCategories_edit->FieldUnitPrice->errorMessage()) ?>");
			<?php if ($WorksheetCategories_edit->IsFitting->Required) { ?>
				elm = this.getElements("x" + infix + "_IsFitting[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_edit->IsFitting->caption(), $WorksheetCategories_edit->IsFitting->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_edit->CartFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_CartFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_edit->CartFlag->caption(), $WorksheetCategories_edit->CartFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_edit->IsShared->Required) { ?>
				elm = this.getElements("x" + infix + "_IsShared[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_edit->IsShared->caption(), $WorksheetCategories_edit->IsShared->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_edit->IsAssembly->Required) { ?>
				elm = this.getElements("x" + infix + "_IsAssembly[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_edit->IsAssembly->caption(), $WorksheetCategories_edit->IsAssembly->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_edit->ActiveFlag->caption(), $WorksheetCategories_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fWorksheetCategoriesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetCategoriesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetCategoriesedit.lists["x_Department_Idn"] = <?php echo $WorksheetCategories_edit->Department_Idn->Lookup->toClientList($WorksheetCategories_edit) ?>;
	fWorksheetCategoriesedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($WorksheetCategories_edit->Department_Idn->lookupOptions()) ?>;
	fWorksheetCategoriesedit.lists["x_IsFitting[]"] = <?php echo $WorksheetCategories_edit->IsFitting->Lookup->toClientList($WorksheetCategories_edit) ?>;
	fWorksheetCategoriesedit.lists["x_IsFitting[]"].options = <?php echo JsonEncode($WorksheetCategories_edit->IsFitting->options(FALSE, TRUE)) ?>;
	fWorksheetCategoriesedit.lists["x_CartFlag[]"] = <?php echo $WorksheetCategories_edit->CartFlag->Lookup->toClientList($WorksheetCategories_edit) ?>;
	fWorksheetCategoriesedit.lists["x_CartFlag[]"].options = <?php echo JsonEncode($WorksheetCategories_edit->CartFlag->options(FALSE, TRUE)) ?>;
	fWorksheetCategoriesedit.lists["x_IsShared[]"] = <?php echo $WorksheetCategories_edit->IsShared->Lookup->toClientList($WorksheetCategories_edit) ?>;
	fWorksheetCategoriesedit.lists["x_IsShared[]"].options = <?php echo JsonEncode($WorksheetCategories_edit->IsShared->options(FALSE, TRUE)) ?>;
	fWorksheetCategoriesedit.lists["x_IsAssembly[]"] = <?php echo $WorksheetCategories_edit->IsAssembly->Lookup->toClientList($WorksheetCategories_edit) ?>;
	fWorksheetCategoriesedit.lists["x_IsAssembly[]"].options = <?php echo JsonEncode($WorksheetCategories_edit->IsAssembly->options(FALSE, TRUE)) ?>;
	fWorksheetCategoriesedit.lists["x_ActiveFlag[]"] = <?php echo $WorksheetCategories_edit->ActiveFlag->Lookup->toClientList($WorksheetCategories_edit) ?>;
	fWorksheetCategoriesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($WorksheetCategories_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fWorksheetCategoriesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetCategories_edit->showPageHeader(); ?>
<?php
$WorksheetCategories_edit->showMessage();
?>
<?php if (!$WorksheetCategories_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetCategories_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fWorksheetCategoriesedit" id="fWorksheetCategoriesedit" class="<?php echo $WorksheetCategories_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetCategories">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$WorksheetCategories_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($WorksheetCategories_edit->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<div id="r_WorksheetCategory_Idn" class="form-group row">
		<label id="elh_WorksheetCategories_WorksheetCategory_Idn" class="<?php echo $WorksheetCategories_edit->LeftColumnClass ?>"><?php echo $WorksheetCategories_edit->WorksheetCategory_Idn->caption() ?><?php echo $WorksheetCategories_edit->WorksheetCategory_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_edit->RightColumnClass ?>"><div <?php echo $WorksheetCategories_edit->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el_WorksheetCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetCategories_edit->WorksheetCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetCategories_edit->WorksheetCategory_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_WorksheetCategory_Idn" name="x_WorksheetCategory_Idn" id="x_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetCategories_edit->WorksheetCategory_Idn->CurrentValue) ?>">
<?php echo $WorksheetCategories_edit->WorksheetCategory_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_WorksheetCategories_Name" for="x_Name" class="<?php echo $WorksheetCategories_edit->LeftColumnClass ?>"><?php echo $WorksheetCategories_edit->Name->caption() ?><?php echo $WorksheetCategories_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_edit->RightColumnClass ?>"><div <?php echo $WorksheetCategories_edit->Name->cellAttributes() ?>>
<span id="el_WorksheetCategories_Name">
<input type="text" data-table="WorksheetCategories" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetCategories_edit->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_edit->Name->EditValue ?>"<?php echo $WorksheetCategories_edit->Name->editAttributes() ?>>
</span>
<?php echo $WorksheetCategories_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_edit->ShortName->Visible) { // ShortName ?>
	<div id="r_ShortName" class="form-group row">
		<label id="elh_WorksheetCategories_ShortName" for="x_ShortName" class="<?php echo $WorksheetCategories_edit->LeftColumnClass ?>"><?php echo $WorksheetCategories_edit->ShortName->caption() ?><?php echo $WorksheetCategories_edit->ShortName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_edit->RightColumnClass ?>"><div <?php echo $WorksheetCategories_edit->ShortName->cellAttributes() ?>>
<span id="el_WorksheetCategories_ShortName">
<input type="text" data-table="WorksheetCategories" data-field="x_ShortName" name="x_ShortName" id="x_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($WorksheetCategories_edit->ShortName->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_edit->ShortName->EditValue ?>"<?php echo $WorksheetCategories_edit->ShortName->editAttributes() ?>>
</span>
<?php echo $WorksheetCategories_edit->ShortName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_WorksheetCategories_Department_Idn" for="x_Department_Idn" class="<?php echo $WorksheetCategories_edit->LeftColumnClass ?>"><?php echo $WorksheetCategories_edit->Department_Idn->caption() ?><?php echo $WorksheetCategories_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_edit->RightColumnClass ?>"><div <?php echo $WorksheetCategories_edit->Department_Idn->cellAttributes() ?>>
<span id="el_WorksheetCategories_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetCategories" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetCategories_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $WorksheetCategories_edit->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetCategories_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetCategories_edit->Department_Idn->Lookup->getParamTag($WorksheetCategories_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $WorksheetCategories_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_edit->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
	<div id="r_FieldUnitPrice" class="form-group row">
		<label id="elh_WorksheetCategories_FieldUnitPrice" for="x_FieldUnitPrice" class="<?php echo $WorksheetCategories_edit->LeftColumnClass ?>"><?php echo $WorksheetCategories_edit->FieldUnitPrice->caption() ?><?php echo $WorksheetCategories_edit->FieldUnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_edit->RightColumnClass ?>"><div <?php echo $WorksheetCategories_edit->FieldUnitPrice->cellAttributes() ?>>
<span id="el_WorksheetCategories_FieldUnitPrice">
<input type="text" data-table="WorksheetCategories" data-field="x_FieldUnitPrice" name="x_FieldUnitPrice" id="x_FieldUnitPrice" size="10" maxlength="8" placeholder="<?php echo HtmlEncode($WorksheetCategories_edit->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_edit->FieldUnitPrice->EditValue ?>"<?php echo $WorksheetCategories_edit->FieldUnitPrice->editAttributes() ?>>
</span>
<?php echo $WorksheetCategories_edit->FieldUnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_edit->IsFitting->Visible) { // IsFitting ?>
	<div id="r_IsFitting" class="form-group row">
		<label id="elh_WorksheetCategories_IsFitting" class="<?php echo $WorksheetCategories_edit->LeftColumnClass ?>"><?php echo $WorksheetCategories_edit->IsFitting->caption() ?><?php echo $WorksheetCategories_edit->IsFitting->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_edit->RightColumnClass ?>"><div <?php echo $WorksheetCategories_edit->IsFitting->cellAttributes() ?>>
<span id="el_WorksheetCategories_IsFitting">
<?php
$selwrk = ConvertToBool($WorksheetCategories_edit->IsFitting->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsFitting" name="x_IsFitting[]" id="x_IsFitting[]_226423" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_edit->IsFitting->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsFitting[]_226423"></label>
</div>
</span>
<?php echo $WorksheetCategories_edit->IsFitting->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_edit->CartFlag->Visible) { // CartFlag ?>
	<div id="r_CartFlag" class="form-group row">
		<label id="elh_WorksheetCategories_CartFlag" class="<?php echo $WorksheetCategories_edit->LeftColumnClass ?>"><?php echo $WorksheetCategories_edit->CartFlag->caption() ?><?php echo $WorksheetCategories_edit->CartFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_edit->RightColumnClass ?>"><div <?php echo $WorksheetCategories_edit->CartFlag->cellAttributes() ?>>
<span id="el_WorksheetCategories_CartFlag">
<?php
$selwrk = ConvertToBool($WorksheetCategories_edit->CartFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_CartFlag" name="x_CartFlag[]" id="x_CartFlag[]_231224" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_edit->CartFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_CartFlag[]_231224"></label>
</div>
</span>
<?php echo $WorksheetCategories_edit->CartFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_edit->IsShared->Visible) { // IsShared ?>
	<div id="r_IsShared" class="form-group row">
		<label id="elh_WorksheetCategories_IsShared" class="<?php echo $WorksheetCategories_edit->LeftColumnClass ?>"><?php echo $WorksheetCategories_edit->IsShared->caption() ?><?php echo $WorksheetCategories_edit->IsShared->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_edit->RightColumnClass ?>"><div <?php echo $WorksheetCategories_edit->IsShared->cellAttributes() ?>>
<span id="el_WorksheetCategories_IsShared">
<?php
$selwrk = ConvertToBool($WorksheetCategories_edit->IsShared->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsShared" name="x_IsShared[]" id="x_IsShared[]_629830" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_edit->IsShared->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsShared[]_629830"></label>
</div>
</span>
<?php echo $WorksheetCategories_edit->IsShared->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_edit->IsAssembly->Visible) { // IsAssembly ?>
	<div id="r_IsAssembly" class="form-group row">
		<label id="elh_WorksheetCategories_IsAssembly" class="<?php echo $WorksheetCategories_edit->LeftColumnClass ?>"><?php echo $WorksheetCategories_edit->IsAssembly->caption() ?><?php echo $WorksheetCategories_edit->IsAssembly->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_edit->RightColumnClass ?>"><div <?php echo $WorksheetCategories_edit->IsAssembly->cellAttributes() ?>>
<span id="el_WorksheetCategories_IsAssembly">
<?php
$selwrk = ConvertToBool($WorksheetCategories_edit->IsAssembly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsAssembly" name="x_IsAssembly[]" id="x_IsAssembly[]_542782" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_edit->IsAssembly->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsAssembly[]_542782"></label>
</div>
</span>
<?php echo $WorksheetCategories_edit->IsAssembly->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_WorksheetCategories_ActiveFlag" class="<?php echo $WorksheetCategories_edit->LeftColumnClass ?>"><?php echo $WorksheetCategories_edit->ActiveFlag->caption() ?><?php echo $WorksheetCategories_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_edit->RightColumnClass ?>"><div <?php echo $WorksheetCategories_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_WorksheetCategories_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetCategories_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_698214" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_698214"></label>
</div>
</span>
<?php echo $WorksheetCategories_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("WorksheetMasterCategories", explode(",", $WorksheetCategories->getCurrentDetailTable())) && $WorksheetMasterCategories->DetailEdit) {
?>
<?php if ($WorksheetCategories->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("WorksheetMasterCategories", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "WorksheetMasterCategoriesgrid.php" ?>
<?php } ?>
<?php if (!$WorksheetCategories_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $WorksheetCategories_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetCategories_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$WorksheetCategories_edit->IsModal) { ?>
<?php echo $WorksheetCategories_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$WorksheetCategories_edit->showPageFooter();
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
$WorksheetCategories_edit->terminate();
?>