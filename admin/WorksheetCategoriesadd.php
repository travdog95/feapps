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
$WorksheetCategories_add = new WorksheetCategories_add();

// Run the page
$WorksheetCategories_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetCategories_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetCategoriesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fWorksheetCategoriesadd = currentForm = new ew.Form("fWorksheetCategoriesadd", "add");

	// Validate form
	fWorksheetCategoriesadd.validate = function() {
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
			<?php if ($WorksheetCategories_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_add->Name->caption(), $WorksheetCategories_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_add->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_add->ShortName->caption(), $WorksheetCategories_add->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_add->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_add->Department_Idn->caption(), $WorksheetCategories_add->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_add->FieldUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_add->FieldUnitPrice->caption(), $WorksheetCategories_add->FieldUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetCategories_add->FieldUnitPrice->errorMessage()) ?>");
			<?php if ($WorksheetCategories_add->IsFitting->Required) { ?>
				elm = this.getElements("x" + infix + "_IsFitting[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_add->IsFitting->caption(), $WorksheetCategories_add->IsFitting->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_add->CartFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_CartFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_add->CartFlag->caption(), $WorksheetCategories_add->CartFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_add->IsShared->Required) { ?>
				elm = this.getElements("x" + infix + "_IsShared[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_add->IsShared->caption(), $WorksheetCategories_add->IsShared->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_add->IsAssembly->Required) { ?>
				elm = this.getElements("x" + infix + "_IsAssembly[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_add->IsAssembly->caption(), $WorksheetCategories_add->IsAssembly->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_add->ActiveFlag->caption(), $WorksheetCategories_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fWorksheetCategoriesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetCategoriesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetCategoriesadd.lists["x_Department_Idn"] = <?php echo $WorksheetCategories_add->Department_Idn->Lookup->toClientList($WorksheetCategories_add) ?>;
	fWorksheetCategoriesadd.lists["x_Department_Idn"].options = <?php echo JsonEncode($WorksheetCategories_add->Department_Idn->lookupOptions()) ?>;
	fWorksheetCategoriesadd.lists["x_IsFitting[]"] = <?php echo $WorksheetCategories_add->IsFitting->Lookup->toClientList($WorksheetCategories_add) ?>;
	fWorksheetCategoriesadd.lists["x_IsFitting[]"].options = <?php echo JsonEncode($WorksheetCategories_add->IsFitting->options(FALSE, TRUE)) ?>;
	fWorksheetCategoriesadd.lists["x_CartFlag[]"] = <?php echo $WorksheetCategories_add->CartFlag->Lookup->toClientList($WorksheetCategories_add) ?>;
	fWorksheetCategoriesadd.lists["x_CartFlag[]"].options = <?php echo JsonEncode($WorksheetCategories_add->CartFlag->options(FALSE, TRUE)) ?>;
	fWorksheetCategoriesadd.lists["x_IsShared[]"] = <?php echo $WorksheetCategories_add->IsShared->Lookup->toClientList($WorksheetCategories_add) ?>;
	fWorksheetCategoriesadd.lists["x_IsShared[]"].options = <?php echo JsonEncode($WorksheetCategories_add->IsShared->options(FALSE, TRUE)) ?>;
	fWorksheetCategoriesadd.lists["x_IsAssembly[]"] = <?php echo $WorksheetCategories_add->IsAssembly->Lookup->toClientList($WorksheetCategories_add) ?>;
	fWorksheetCategoriesadd.lists["x_IsAssembly[]"].options = <?php echo JsonEncode($WorksheetCategories_add->IsAssembly->options(FALSE, TRUE)) ?>;
	fWorksheetCategoriesadd.lists["x_ActiveFlag[]"] = <?php echo $WorksheetCategories_add->ActiveFlag->Lookup->toClientList($WorksheetCategories_add) ?>;
	fWorksheetCategoriesadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($WorksheetCategories_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fWorksheetCategoriesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetCategories_add->showPageHeader(); ?>
<?php
$WorksheetCategories_add->showMessage();
?>
<form name="fWorksheetCategoriesadd" id="fWorksheetCategoriesadd" class="<?php echo $WorksheetCategories_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetCategories">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$WorksheetCategories_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($WorksheetCategories_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_WorksheetCategories_Name" for="x_Name" class="<?php echo $WorksheetCategories_add->LeftColumnClass ?>"><?php echo $WorksheetCategories_add->Name->caption() ?><?php echo $WorksheetCategories_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetCategories_add->Name->cellAttributes() ?>>
<span id="el_WorksheetCategories_Name">
<input type="text" data-table="WorksheetCategories" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetCategories_add->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_add->Name->EditValue ?>"<?php echo $WorksheetCategories_add->Name->editAttributes() ?>>
</span>
<?php echo $WorksheetCategories_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_add->ShortName->Visible) { // ShortName ?>
	<div id="r_ShortName" class="form-group row">
		<label id="elh_WorksheetCategories_ShortName" for="x_ShortName" class="<?php echo $WorksheetCategories_add->LeftColumnClass ?>"><?php echo $WorksheetCategories_add->ShortName->caption() ?><?php echo $WorksheetCategories_add->ShortName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetCategories_add->ShortName->cellAttributes() ?>>
<span id="el_WorksheetCategories_ShortName">
<input type="text" data-table="WorksheetCategories" data-field="x_ShortName" name="x_ShortName" id="x_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($WorksheetCategories_add->ShortName->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_add->ShortName->EditValue ?>"<?php echo $WorksheetCategories_add->ShortName->editAttributes() ?>>
</span>
<?php echo $WorksheetCategories_add->ShortName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_add->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_WorksheetCategories_Department_Idn" for="x_Department_Idn" class="<?php echo $WorksheetCategories_add->LeftColumnClass ?>"><?php echo $WorksheetCategories_add->Department_Idn->caption() ?><?php echo $WorksheetCategories_add->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetCategories_add->Department_Idn->cellAttributes() ?>>
<span id="el_WorksheetCategories_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetCategories" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetCategories_add->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $WorksheetCategories_add->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetCategories_add->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetCategories_add->Department_Idn->Lookup->getParamTag($WorksheetCategories_add, "p_x_Department_Idn") ?>
</span>
<?php echo $WorksheetCategories_add->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_add->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
	<div id="r_FieldUnitPrice" class="form-group row">
		<label id="elh_WorksheetCategories_FieldUnitPrice" for="x_FieldUnitPrice" class="<?php echo $WorksheetCategories_add->LeftColumnClass ?>"><?php echo $WorksheetCategories_add->FieldUnitPrice->caption() ?><?php echo $WorksheetCategories_add->FieldUnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetCategories_add->FieldUnitPrice->cellAttributes() ?>>
<span id="el_WorksheetCategories_FieldUnitPrice">
<input type="text" data-table="WorksheetCategories" data-field="x_FieldUnitPrice" name="x_FieldUnitPrice" id="x_FieldUnitPrice" size="10" maxlength="8" placeholder="<?php echo HtmlEncode($WorksheetCategories_add->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_add->FieldUnitPrice->EditValue ?>"<?php echo $WorksheetCategories_add->FieldUnitPrice->editAttributes() ?>>
</span>
<?php echo $WorksheetCategories_add->FieldUnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_add->IsFitting->Visible) { // IsFitting ?>
	<div id="r_IsFitting" class="form-group row">
		<label id="elh_WorksheetCategories_IsFitting" class="<?php echo $WorksheetCategories_add->LeftColumnClass ?>"><?php echo $WorksheetCategories_add->IsFitting->caption() ?><?php echo $WorksheetCategories_add->IsFitting->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetCategories_add->IsFitting->cellAttributes() ?>>
<span id="el_WorksheetCategories_IsFitting">
<?php
$selwrk = ConvertToBool($WorksheetCategories_add->IsFitting->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsFitting" name="x_IsFitting[]" id="x_IsFitting[]_483121" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_add->IsFitting->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsFitting[]_483121"></label>
</div>
</span>
<?php echo $WorksheetCategories_add->IsFitting->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_add->CartFlag->Visible) { // CartFlag ?>
	<div id="r_CartFlag" class="form-group row">
		<label id="elh_WorksheetCategories_CartFlag" class="<?php echo $WorksheetCategories_add->LeftColumnClass ?>"><?php echo $WorksheetCategories_add->CartFlag->caption() ?><?php echo $WorksheetCategories_add->CartFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetCategories_add->CartFlag->cellAttributes() ?>>
<span id="el_WorksheetCategories_CartFlag">
<?php
$selwrk = ConvertToBool($WorksheetCategories_add->CartFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_CartFlag" name="x_CartFlag[]" id="x_CartFlag[]_757967" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_add->CartFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_CartFlag[]_757967"></label>
</div>
</span>
<?php echo $WorksheetCategories_add->CartFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_add->IsShared->Visible) { // IsShared ?>
	<div id="r_IsShared" class="form-group row">
		<label id="elh_WorksheetCategories_IsShared" class="<?php echo $WorksheetCategories_add->LeftColumnClass ?>"><?php echo $WorksheetCategories_add->IsShared->caption() ?><?php echo $WorksheetCategories_add->IsShared->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetCategories_add->IsShared->cellAttributes() ?>>
<span id="el_WorksheetCategories_IsShared">
<?php
$selwrk = ConvertToBool($WorksheetCategories_add->IsShared->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsShared" name="x_IsShared[]" id="x_IsShared[]_194036" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_add->IsShared->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsShared[]_194036"></label>
</div>
</span>
<?php echo $WorksheetCategories_add->IsShared->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_add->IsAssembly->Visible) { // IsAssembly ?>
	<div id="r_IsAssembly" class="form-group row">
		<label id="elh_WorksheetCategories_IsAssembly" class="<?php echo $WorksheetCategories_add->LeftColumnClass ?>"><?php echo $WorksheetCategories_add->IsAssembly->caption() ?><?php echo $WorksheetCategories_add->IsAssembly->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetCategories_add->IsAssembly->cellAttributes() ?>>
<span id="el_WorksheetCategories_IsAssembly">
<?php
$selwrk = ConvertToBool($WorksheetCategories_add->IsAssembly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsAssembly" name="x_IsAssembly[]" id="x_IsAssembly[]_925645" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_add->IsAssembly->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsAssembly[]_925645"></label>
</div>
</span>
<?php echo $WorksheetCategories_add->IsAssembly->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetCategories_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_WorksheetCategories_ActiveFlag" class="<?php echo $WorksheetCategories_add->LeftColumnClass ?>"><?php echo $WorksheetCategories_add->ActiveFlag->caption() ?><?php echo $WorksheetCategories_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetCategories_add->ActiveFlag->cellAttributes() ?>>
<span id="el_WorksheetCategories_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetCategories_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_706375" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_706375"></label>
</div>
</span>
<?php echo $WorksheetCategories_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("WorksheetMasterCategories", explode(",", $WorksheetCategories->getCurrentDetailTable())) && $WorksheetMasterCategories->DetailAdd) {
?>
<?php if ($WorksheetCategories->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("WorksheetMasterCategories", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "WorksheetMasterCategoriesgrid.php" ?>
<?php } ?>
<?php if (!$WorksheetCategories_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $WorksheetCategories_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetCategories_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$WorksheetCategories_add->showPageFooter();
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
$WorksheetCategories_add->terminate();
?>