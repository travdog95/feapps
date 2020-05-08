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
$WorksheetMasterCategories_add = new WorksheetMasterCategories_add();

// Run the page
$WorksheetMasterCategories_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasterCategories_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetMasterCategoriesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fWorksheetMasterCategoriesadd = currentForm = new ew.Form("fWorksheetMasterCategoriesadd", "add");

	// Validate form
	fWorksheetMasterCategoriesadd.validate = function() {
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
			<?php if ($WorksheetMasterCategories_add->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_add->WorksheetMaster_Idn->caption(), $WorksheetMasterCategories_add->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasterCategories_add->WorksheetMaster_Idn->errorMessage()) ?>");
			<?php if ($WorksheetMasterCategories_add->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_add->WorksheetCategory_Idn->caption(), $WorksheetMasterCategories_add->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_add->Rank->caption(), $WorksheetMasterCategories_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasterCategories_add->Rank->errorMessage()) ?>");
			<?php if ($WorksheetMasterCategories_add->AutoLoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_AutoLoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_add->AutoLoadFlag->caption(), $WorksheetMasterCategories_add->AutoLoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_add->LoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_LoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_add->LoadFlag->caption(), $WorksheetMasterCategories_add->LoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_add->AddMiscFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_AddMiscFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_add->AddMiscFlag->caption(), $WorksheetMasterCategories_add->AddMiscFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ChildWorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->caption(), $WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->RequiredErrorMessage)) ?>");
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
	fWorksheetMasterCategoriesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetMasterCategoriesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetMasterCategoriesadd.lists["x_WorksheetCategory_Idn"] = <?php echo $WorksheetMasterCategories_add->WorksheetCategory_Idn->Lookup->toClientList($WorksheetMasterCategories_add) ?>;
	fWorksheetMasterCategoriesadd.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($WorksheetMasterCategories_add->WorksheetCategory_Idn->lookupOptions()) ?>;
	fWorksheetMasterCategoriesadd.lists["x_AutoLoadFlag[]"] = <?php echo $WorksheetMasterCategories_add->AutoLoadFlag->Lookup->toClientList($WorksheetMasterCategories_add) ?>;
	fWorksheetMasterCategoriesadd.lists["x_AutoLoadFlag[]"].options = <?php echo JsonEncode($WorksheetMasterCategories_add->AutoLoadFlag->options(FALSE, TRUE)) ?>;
	fWorksheetMasterCategoriesadd.lists["x_LoadFlag[]"] = <?php echo $WorksheetMasterCategories_add->LoadFlag->Lookup->toClientList($WorksheetMasterCategories_add) ?>;
	fWorksheetMasterCategoriesadd.lists["x_LoadFlag[]"].options = <?php echo JsonEncode($WorksheetMasterCategories_add->LoadFlag->options(FALSE, TRUE)) ?>;
	fWorksheetMasterCategoriesadd.lists["x_AddMiscFlag[]"] = <?php echo $WorksheetMasterCategories_add->AddMiscFlag->Lookup->toClientList($WorksheetMasterCategories_add) ?>;
	fWorksheetMasterCategoriesadd.lists["x_AddMiscFlag[]"].options = <?php echo JsonEncode($WorksheetMasterCategories_add->AddMiscFlag->options(FALSE, TRUE)) ?>;
	fWorksheetMasterCategoriesadd.lists["x_ChildWorksheetMaster_Idn"] = <?php echo $WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->Lookup->toClientList($WorksheetMasterCategories_add) ?>;
	fWorksheetMasterCategoriesadd.lists["x_ChildWorksheetMaster_Idn"].options = <?php echo JsonEncode($WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->lookupOptions()) ?>;
	loadjs.done("fWorksheetMasterCategoriesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetMasterCategories_add->showPageHeader(); ?>
<?php
$WorksheetMasterCategories_add->showMessage();
?>
<form name="fWorksheetMasterCategoriesadd" id="fWorksheetMasterCategoriesadd" class="<?php echo $WorksheetMasterCategories_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetMasterCategories">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$WorksheetMasterCategories_add->IsModal ?>">
<?php if ($WorksheetMasterCategories->getCurrentMasterTable() == "WorksheetMasters") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="WorksheetMasters">
<input type="hidden" name="fk_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_add->WorksheetMaster_Idn->getSessionValue()) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->getCurrentMasterTable() == "WorksheetCategories") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="WorksheetCategories">
<input type="hidden" name="fk_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_add->WorksheetCategory_Idn->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($WorksheetMasterCategories_add->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_WorksheetMasterCategories_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $WorksheetMasterCategories_add->LeftColumnClass ?>"><?php echo $WorksheetMasterCategories_add->WorksheetMaster_Idn->caption() ?><?php echo $WorksheetMasterCategories_add->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasterCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetMasterCategories_add->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories_add->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el_WorksheetMasterCategories_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_add->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_add->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_add->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el_WorksheetMasterCategories_WorksheetMaster_Idn">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn" id="x_WorksheetMaster_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_add->WorksheetMaster_Idn->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_add->WorksheetMaster_Idn->EditValue ?>"<?php echo $WorksheetMasterCategories_add->WorksheetMaster_Idn->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $WorksheetMasterCategories_add->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasterCategories_add->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<div id="r_WorksheetCategory_Idn" class="form-group row">
		<label id="elh_WorksheetMasterCategories_WorksheetCategory_Idn" for="x_WorksheetCategory_Idn" class="<?php echo $WorksheetMasterCategories_add->LeftColumnClass ?>"><?php echo $WorksheetMasterCategories_add->WorksheetCategory_Idn->caption() ?><?php echo $WorksheetMasterCategories_add->WorksheetCategory_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasterCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetMasterCategories_add->WorksheetCategory_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories_add->WorksheetCategory_Idn->getSessionValue() != "") { ?>
<span id="el_WorksheetMasterCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetMasterCategories_add->WorksheetCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_add->WorksheetCategory_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_WorksheetCategory_Idn" name="x_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_add->WorksheetCategory_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el_WorksheetMasterCategories_WorksheetCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_add->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetCategory_Idn" name="x_WorksheetCategory_Idn"<?php echo $WorksheetMasterCategories_add->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_add->WorksheetCategory_Idn->selectOptionListHtml("x_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_add->WorksheetCategory_Idn->Lookup->getParamTag($WorksheetMasterCategories_add, "p_x_WorksheetCategory_Idn") ?>
</span>
<?php } ?>
<?php echo $WorksheetMasterCategories_add->WorksheetCategory_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasterCategories_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_WorksheetMasterCategories_Rank" for="x_Rank" class="<?php echo $WorksheetMasterCategories_add->LeftColumnClass ?>"><?php echo $WorksheetMasterCategories_add->Rank->caption() ?><?php echo $WorksheetMasterCategories_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasterCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetMasterCategories_add->Rank->cellAttributes() ?>>
<span id="el_WorksheetMasterCategories_Rank">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_add->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_add->Rank->EditValue ?>"<?php echo $WorksheetMasterCategories_add->Rank->editAttributes() ?>>
</span>
<?php echo $WorksheetMasterCategories_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasterCategories_add->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
	<div id="r_AutoLoadFlag" class="form-group row">
		<label id="elh_WorksheetMasterCategories_AutoLoadFlag" class="<?php echo $WorksheetMasterCategories_add->LeftColumnClass ?>"><?php echo $WorksheetMasterCategories_add->AutoLoadFlag->caption() ?><?php echo $WorksheetMasterCategories_add->AutoLoadFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasterCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetMasterCategories_add->AutoLoadFlag->cellAttributes() ?>>
<span id="el_WorksheetMasterCategories_AutoLoadFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_add->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="x_AutoLoadFlag[]" id="x_AutoLoadFlag[]_497734" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_add->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_AutoLoadFlag[]_497734"></label>
</div>
</span>
<?php echo $WorksheetMasterCategories_add->AutoLoadFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasterCategories_add->LoadFlag->Visible) { // LoadFlag ?>
	<div id="r_LoadFlag" class="form-group row">
		<label id="elh_WorksheetMasterCategories_LoadFlag" class="<?php echo $WorksheetMasterCategories_add->LeftColumnClass ?>"><?php echo $WorksheetMasterCategories_add->LoadFlag->caption() ?><?php echo $WorksheetMasterCategories_add->LoadFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasterCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetMasterCategories_add->LoadFlag->cellAttributes() ?>>
<span id="el_WorksheetMasterCategories_LoadFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_add->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="x_LoadFlag[]" id="x_LoadFlag[]_838842" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_add->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_LoadFlag[]_838842"></label>
</div>
</span>
<?php echo $WorksheetMasterCategories_add->LoadFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasterCategories_add->AddMiscFlag->Visible) { // AddMiscFlag ?>
	<div id="r_AddMiscFlag" class="form-group row">
		<label id="elh_WorksheetMasterCategories_AddMiscFlag" class="<?php echo $WorksheetMasterCategories_add->LeftColumnClass ?>"><?php echo $WorksheetMasterCategories_add->AddMiscFlag->caption() ?><?php echo $WorksheetMasterCategories_add->AddMiscFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasterCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetMasterCategories_add->AddMiscFlag->cellAttributes() ?>>
<span id="el_WorksheetMasterCategories_AddMiscFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_add->AddMiscFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="x_AddMiscFlag[]" id="x_AddMiscFlag[]_517987" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_add->AddMiscFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_AddMiscFlag[]_517987"></label>
</div>
</span>
<?php echo $WorksheetMasterCategories_add->AddMiscFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
	<div id="r_ChildWorksheetMaster_Idn" class="form-group row">
		<label id="elh_WorksheetMasterCategories_ChildWorksheetMaster_Idn" for="x_ChildWorksheetMaster_Idn" class="<?php echo $WorksheetMasterCategories_add->LeftColumnClass ?>"><?php echo $WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->caption() ?><?php echo $WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasterCategories_add->RightColumnClass ?>"><div <?php echo $WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_WorksheetMasterCategories_ChildWorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_ChildWorksheetMaster_Idn" name="x_ChildWorksheetMaster_Idn"<?php echo $WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->selectOptionListHtml("x_ChildWorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterCategories_add, "p_x_ChildWorksheetMaster_Idn") ?>
</span>
<?php echo $WorksheetMasterCategories_add->ChildWorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$WorksheetMasterCategories_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $WorksheetMasterCategories_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetMasterCategories_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$WorksheetMasterCategories_add->showPageFooter();
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
$WorksheetMasterCategories_add->terminate();
?>