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
$WorksheetMasters_add = new WorksheetMasters_add();

// Run the page
$WorksheetMasters_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasters_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetMastersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fWorksheetMastersadd = currentForm = new ew.Form("fWorksheetMastersadd", "add");

	// Validate form
	fWorksheetMastersadd.validate = function() {
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
			<?php if ($WorksheetMasters_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->Name->caption(), $WorksheetMasters_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->Department_Idn->caption(), $WorksheetMasters_add->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->Rank->caption(), $WorksheetMasters_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasters_add->Rank->errorMessage()) ?>");
			<?php if ($WorksheetMasters_add->NumberOfColumns->Required) { ?>
				elm = this.getElements("x" + infix + "_NumberOfColumns");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->NumberOfColumns->caption(), $WorksheetMasters_add->NumberOfColumns->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumberOfColumns");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasters_add->NumberOfColumns->errorMessage()) ?>");
			<?php if ($WorksheetMasters_add->AllowMultiple->Required) { ?>
				elm = this.getElements("x" + infix + "_AllowMultiple[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->AllowMultiple->caption(), $WorksheetMasters_add->AllowMultiple->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayAdjustmentFactors->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayAdjustmentFactors[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayAdjustmentFactors->caption(), $WorksheetMasters_add->DisplayAdjustmentFactors->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayWorksheetDetails->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayWorksheetDetails[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayWorksheetDetails->caption(), $WorksheetMasters_add->DisplayWorksheetDetails->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayShopFabrication->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayShopFabrication[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayShopFabrication->caption(), $WorksheetMasters_add->DisplayShopFabrication->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayWorksheetName->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayWorksheetName[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayWorksheetName->caption(), $WorksheetMasters_add->DisplayWorksheetName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayWorksheetHeader->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayWorksheetHeader[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayWorksheetHeader->caption(), $WorksheetMasters_add->DisplayWorksheetHeader->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->UseRadioButtonsForSizes->Required) { ?>
				elm = this.getElements("x" + infix + "_UseRadioButtonsForSizes[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->UseRadioButtonsForSizes->caption(), $WorksheetMasters_add->UseRadioButtonsForSizes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayFieldHoursOverride->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayFieldHoursOverride[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayFieldHoursOverride->caption(), $WorksheetMasters_add->DisplayFieldHoursOverride->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayShopHours->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayShopHours[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayShopHours->caption(), $WorksheetMasters_add->DisplayShopHours->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayShopHoursOverride->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayShopHoursOverride[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayShopHoursOverride->caption(), $WorksheetMasters_add->DisplayShopHoursOverride->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayUserShopHoursOnly->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayUserShopHoursOnly[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayUserShopHoursOnly->caption(), $WorksheetMasters_add->DisplayUserShopHoursOnly->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayPipeExposure->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayPipeExposure[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayPipeExposure->caption(), $WorksheetMasters_add->DisplayPipeExposure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayVolumeCorrection->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayVolumeCorrection[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayVolumeCorrection->caption(), $WorksheetMasters_add->DisplayVolumeCorrection->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayManhourAdjustment->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayManhourAdjustment[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayManhourAdjustment->caption(), $WorksheetMasters_add->DisplayManhourAdjustment->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->IsSubcontractWorksheet->Required) { ?>
				elm = this.getElements("x" + infix + "_IsSubcontractWorksheet[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->IsSubcontractWorksheet->caption(), $WorksheetMasters_add->IsSubcontractWorksheet->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->DisplayDeleteItemsButtons->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayDeleteItemsButtons[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->DisplayDeleteItemsButtons->caption(), $WorksheetMasters_add->DisplayDeleteItemsButtons->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_add->ActiveFlag->caption(), $WorksheetMasters_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fWorksheetMastersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetMastersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetMastersadd.lists["x_Department_Idn"] = <?php echo $WorksheetMasters_add->Department_Idn->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_Department_Idn"].options = <?php echo JsonEncode($WorksheetMasters_add->Department_Idn->lookupOptions()) ?>;
	fWorksheetMastersadd.lists["x_AllowMultiple[]"] = <?php echo $WorksheetMasters_add->AllowMultiple->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_AllowMultiple[]"].options = <?php echo JsonEncode($WorksheetMasters_add->AllowMultiple->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayAdjustmentFactors[]"] = <?php echo $WorksheetMasters_add->DisplayAdjustmentFactors->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayAdjustmentFactors[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayAdjustmentFactors->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayWorksheetDetails[]"] = <?php echo $WorksheetMasters_add->DisplayWorksheetDetails->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayWorksheetDetails[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayWorksheetDetails->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayShopFabrication[]"] = <?php echo $WorksheetMasters_add->DisplayShopFabrication->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayShopFabrication[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayShopFabrication->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayWorksheetName[]"] = <?php echo $WorksheetMasters_add->DisplayWorksheetName->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayWorksheetName[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayWorksheetName->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayWorksheetHeader[]"] = <?php echo $WorksheetMasters_add->DisplayWorksheetHeader->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayWorksheetHeader[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayWorksheetHeader->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_UseRadioButtonsForSizes[]"] = <?php echo $WorksheetMasters_add->UseRadioButtonsForSizes->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_UseRadioButtonsForSizes[]"].options = <?php echo JsonEncode($WorksheetMasters_add->UseRadioButtonsForSizes->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayFieldHoursOverride[]"] = <?php echo $WorksheetMasters_add->DisplayFieldHoursOverride->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayFieldHoursOverride[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayFieldHoursOverride->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayShopHours[]"] = <?php echo $WorksheetMasters_add->DisplayShopHours->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayShopHours[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayShopHours->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayShopHoursOverride[]"] = <?php echo $WorksheetMasters_add->DisplayShopHoursOverride->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayShopHoursOverride[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayShopHoursOverride->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayUserShopHoursOnly[]"] = <?php echo $WorksheetMasters_add->DisplayUserShopHoursOnly->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayUserShopHoursOnly[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayUserShopHoursOnly->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayPipeExposure[]"] = <?php echo $WorksheetMasters_add->DisplayPipeExposure->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayPipeExposure[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayPipeExposure->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayVolumeCorrection[]"] = <?php echo $WorksheetMasters_add->DisplayVolumeCorrection->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayVolumeCorrection[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayVolumeCorrection->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayManhourAdjustment[]"] = <?php echo $WorksheetMasters_add->DisplayManhourAdjustment->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayManhourAdjustment[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayManhourAdjustment->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_IsSubcontractWorksheet[]"] = <?php echo $WorksheetMasters_add->IsSubcontractWorksheet->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_IsSubcontractWorksheet[]"].options = <?php echo JsonEncode($WorksheetMasters_add->IsSubcontractWorksheet->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_DisplayDeleteItemsButtons[]"] = <?php echo $WorksheetMasters_add->DisplayDeleteItemsButtons->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_DisplayDeleteItemsButtons[]"].options = <?php echo JsonEncode($WorksheetMasters_add->DisplayDeleteItemsButtons->options(FALSE, TRUE)) ?>;
	fWorksheetMastersadd.lists["x_ActiveFlag[]"] = <?php echo $WorksheetMasters_add->ActiveFlag->Lookup->toClientList($WorksheetMasters_add) ?>;
	fWorksheetMastersadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($WorksheetMasters_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fWorksheetMastersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetMasters_add->showPageHeader(); ?>
<?php
$WorksheetMasters_add->showMessage();
?>
<form name="fWorksheetMastersadd" id="fWorksheetMastersadd" class="<?php echo $WorksheetMasters_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetMasters">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$WorksheetMasters_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($WorksheetMasters_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_WorksheetMasters_Name" for="x_Name" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->Name->caption() ?><?php echo $WorksheetMasters_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->Name->cellAttributes() ?>>
<span id="el_WorksheetMasters_Name">
<input type="text" data-table="WorksheetMasters" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetMasters_add->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_add->Name->EditValue ?>"<?php echo $WorksheetMasters_add->Name->editAttributes() ?>>
</span>
<?php echo $WorksheetMasters_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_WorksheetMasters_Department_Idn" for="x_Department_Idn" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->Department_Idn->caption() ?><?php echo $WorksheetMasters_add->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->Department_Idn->cellAttributes() ?>>
<span id="el_WorksheetMasters_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasters" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetMasters_add->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $WorksheetMasters_add->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasters_add->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasters_add->Department_Idn->Lookup->getParamTag($WorksheetMasters_add, "p_x_Department_Idn") ?>
</span>
<?php echo $WorksheetMasters_add->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_WorksheetMasters_Rank" for="x_Rank" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->Rank->caption() ?><?php echo $WorksheetMasters_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->Rank->cellAttributes() ?>>
<span id="el_WorksheetMasters_Rank">
<input type="text" data-table="WorksheetMasters" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_add->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_add->Rank->EditValue ?>"<?php echo $WorksheetMasters_add->Rank->editAttributes() ?>>
</span>
<?php echo $WorksheetMasters_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->NumberOfColumns->Visible) { // NumberOfColumns ?>
	<div id="r_NumberOfColumns" class="form-group row">
		<label id="elh_WorksheetMasters_NumberOfColumns" for="x_NumberOfColumns" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->NumberOfColumns->caption() ?><?php echo $WorksheetMasters_add->NumberOfColumns->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->NumberOfColumns->cellAttributes() ?>>
<span id="el_WorksheetMasters_NumberOfColumns">
<input type="text" data-table="WorksheetMasters" data-field="x_NumberOfColumns" name="x_NumberOfColumns" id="x_NumberOfColumns" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_add->NumberOfColumns->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_add->NumberOfColumns->EditValue ?>"<?php echo $WorksheetMasters_add->NumberOfColumns->editAttributes() ?>>
</span>
<?php echo $WorksheetMasters_add->NumberOfColumns->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->AllowMultiple->Visible) { // AllowMultiple ?>
	<div id="r_AllowMultiple" class="form-group row">
		<label id="elh_WorksheetMasters_AllowMultiple" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->AllowMultiple->caption() ?><?php echo $WorksheetMasters_add->AllowMultiple->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->AllowMultiple->cellAttributes() ?>>
<span id="el_WorksheetMasters_AllowMultiple">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->AllowMultiple->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_AllowMultiple" name="x_AllowMultiple[]" id="x_AllowMultiple[]_667663" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->AllowMultiple->editAttributes() ?>>
	<label class="custom-control-label" for="x_AllowMultiple[]_667663"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->AllowMultiple->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayAdjustmentFactors->Visible) { // DisplayAdjustmentFactors ?>
	<div id="r_DisplayAdjustmentFactors" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayAdjustmentFactors" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayAdjustmentFactors->caption() ?><?php echo $WorksheetMasters_add->DisplayAdjustmentFactors->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayAdjustmentFactors->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayAdjustmentFactors">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayAdjustmentFactors->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayAdjustmentFactors" name="x_DisplayAdjustmentFactors[]" id="x_DisplayAdjustmentFactors[]_476364" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayAdjustmentFactors->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayAdjustmentFactors[]_476364"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayAdjustmentFactors->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayWorksheetDetails->Visible) { // DisplayWorksheetDetails ?>
	<div id="r_DisplayWorksheetDetails" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayWorksheetDetails" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayWorksheetDetails->caption() ?><?php echo $WorksheetMasters_add->DisplayWorksheetDetails->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayWorksheetDetails->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayWorksheetDetails">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayWorksheetDetails->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayWorksheetDetails" name="x_DisplayWorksheetDetails[]" id="x_DisplayWorksheetDetails[]_775347" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayWorksheetDetails->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayWorksheetDetails[]_775347"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayWorksheetDetails->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayShopFabrication->Visible) { // DisplayShopFabrication ?>
	<div id="r_DisplayShopFabrication" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayShopFabrication" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayShopFabrication->caption() ?><?php echo $WorksheetMasters_add->DisplayShopFabrication->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayShopFabrication->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayShopFabrication">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayShopFabrication->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayShopFabrication" name="x_DisplayShopFabrication[]" id="x_DisplayShopFabrication[]_761401" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayShopFabrication->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayShopFabrication[]_761401"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayShopFabrication->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayWorksheetName->Visible) { // DisplayWorksheetName ?>
	<div id="r_DisplayWorksheetName" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayWorksheetName" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayWorksheetName->caption() ?><?php echo $WorksheetMasters_add->DisplayWorksheetName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayWorksheetName->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayWorksheetName">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayWorksheetName->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayWorksheetName" name="x_DisplayWorksheetName[]" id="x_DisplayWorksheetName[]_624154" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayWorksheetName->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayWorksheetName[]_624154"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayWorksheetName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayWorksheetHeader->Visible) { // DisplayWorksheetHeader ?>
	<div id="r_DisplayWorksheetHeader" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayWorksheetHeader" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayWorksheetHeader->caption() ?><?php echo $WorksheetMasters_add->DisplayWorksheetHeader->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayWorksheetHeader->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayWorksheetHeader">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayWorksheetHeader->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayWorksheetHeader" name="x_DisplayWorksheetHeader[]" id="x_DisplayWorksheetHeader[]_646533" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayWorksheetHeader->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayWorksheetHeader[]_646533"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayWorksheetHeader->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->UseRadioButtonsForSizes->Visible) { // UseRadioButtonsForSizes ?>
	<div id="r_UseRadioButtonsForSizes" class="form-group row">
		<label id="elh_WorksheetMasters_UseRadioButtonsForSizes" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->UseRadioButtonsForSizes->caption() ?><?php echo $WorksheetMasters_add->UseRadioButtonsForSizes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->UseRadioButtonsForSizes->cellAttributes() ?>>
<span id="el_WorksheetMasters_UseRadioButtonsForSizes">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->UseRadioButtonsForSizes->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_UseRadioButtonsForSizes" name="x_UseRadioButtonsForSizes[]" id="x_UseRadioButtonsForSizes[]_884810" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->UseRadioButtonsForSizes->editAttributes() ?>>
	<label class="custom-control-label" for="x_UseRadioButtonsForSizes[]_884810"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->UseRadioButtonsForSizes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayFieldHoursOverride->Visible) { // DisplayFieldHoursOverride ?>
	<div id="r_DisplayFieldHoursOverride" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayFieldHoursOverride" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayFieldHoursOverride->caption() ?><?php echo $WorksheetMasters_add->DisplayFieldHoursOverride->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayFieldHoursOverride->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayFieldHoursOverride">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayFieldHoursOverride->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayFieldHoursOverride" name="x_DisplayFieldHoursOverride[]" id="x_DisplayFieldHoursOverride[]_822351" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayFieldHoursOverride->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayFieldHoursOverride[]_822351"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayFieldHoursOverride->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayShopHours->Visible) { // DisplayShopHours ?>
	<div id="r_DisplayShopHours" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayShopHours" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayShopHours->caption() ?><?php echo $WorksheetMasters_add->DisplayShopHours->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayShopHours->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayShopHours">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayShopHours->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayShopHours" name="x_DisplayShopHours[]" id="x_DisplayShopHours[]_107651" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayShopHours->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayShopHours[]_107651"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayShopHours->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayShopHoursOverride->Visible) { // DisplayShopHoursOverride ?>
	<div id="r_DisplayShopHoursOverride" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayShopHoursOverride" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayShopHoursOverride->caption() ?><?php echo $WorksheetMasters_add->DisplayShopHoursOverride->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayShopHoursOverride->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayShopHoursOverride">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayShopHoursOverride->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayShopHoursOverride" name="x_DisplayShopHoursOverride[]" id="x_DisplayShopHoursOverride[]_606662" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayShopHoursOverride->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayShopHoursOverride[]_606662"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayShopHoursOverride->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayUserShopHoursOnly->Visible) { // DisplayUserShopHoursOnly ?>
	<div id="r_DisplayUserShopHoursOnly" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayUserShopHoursOnly" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayUserShopHoursOnly->caption() ?><?php echo $WorksheetMasters_add->DisplayUserShopHoursOnly->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayUserShopHoursOnly->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayUserShopHoursOnly">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayUserShopHoursOnly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayUserShopHoursOnly" name="x_DisplayUserShopHoursOnly[]" id="x_DisplayUserShopHoursOnly[]_794288" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayUserShopHoursOnly->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayUserShopHoursOnly[]_794288"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayUserShopHoursOnly->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayPipeExposure->Visible) { // DisplayPipeExposure ?>
	<div id="r_DisplayPipeExposure" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayPipeExposure" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayPipeExposure->caption() ?><?php echo $WorksheetMasters_add->DisplayPipeExposure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayPipeExposure->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayPipeExposure">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayPipeExposure->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayPipeExposure" name="x_DisplayPipeExposure[]" id="x_DisplayPipeExposure[]_110538" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayPipeExposure->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayPipeExposure[]_110538"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayPipeExposure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayVolumeCorrection->Visible) { // DisplayVolumeCorrection ?>
	<div id="r_DisplayVolumeCorrection" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayVolumeCorrection" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayVolumeCorrection->caption() ?><?php echo $WorksheetMasters_add->DisplayVolumeCorrection->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayVolumeCorrection->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayVolumeCorrection">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayVolumeCorrection->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayVolumeCorrection" name="x_DisplayVolumeCorrection[]" id="x_DisplayVolumeCorrection[]_605737" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayVolumeCorrection->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayVolumeCorrection[]_605737"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayVolumeCorrection->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayManhourAdjustment->Visible) { // DisplayManhourAdjustment ?>
	<div id="r_DisplayManhourAdjustment" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayManhourAdjustment" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayManhourAdjustment->caption() ?><?php echo $WorksheetMasters_add->DisplayManhourAdjustment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayManhourAdjustment->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayManhourAdjustment">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayManhourAdjustment->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayManhourAdjustment" name="x_DisplayManhourAdjustment[]" id="x_DisplayManhourAdjustment[]_782468" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayManhourAdjustment->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayManhourAdjustment[]_782468"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayManhourAdjustment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->IsSubcontractWorksheet->Visible) { // IsSubcontractWorksheet ?>
	<div id="r_IsSubcontractWorksheet" class="form-group row">
		<label id="elh_WorksheetMasters_IsSubcontractWorksheet" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->IsSubcontractWorksheet->caption() ?><?php echo $WorksheetMasters_add->IsSubcontractWorksheet->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->IsSubcontractWorksheet->cellAttributes() ?>>
<span id="el_WorksheetMasters_IsSubcontractWorksheet">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->IsSubcontractWorksheet->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_IsSubcontractWorksheet" name="x_IsSubcontractWorksheet[]" id="x_IsSubcontractWorksheet[]_741727" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->IsSubcontractWorksheet->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsSubcontractWorksheet[]_741727"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->IsSubcontractWorksheet->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->DisplayDeleteItemsButtons->Visible) { // DisplayDeleteItemsButtons ?>
	<div id="r_DisplayDeleteItemsButtons" class="form-group row">
		<label id="elh_WorksheetMasters_DisplayDeleteItemsButtons" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->DisplayDeleteItemsButtons->caption() ?><?php echo $WorksheetMasters_add->DisplayDeleteItemsButtons->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->DisplayDeleteItemsButtons->cellAttributes() ?>>
<span id="el_WorksheetMasters_DisplayDeleteItemsButtons">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->DisplayDeleteItemsButtons->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_DisplayDeleteItemsButtons" name="x_DisplayDeleteItemsButtons[]" id="x_DisplayDeleteItemsButtons[]_737736" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->DisplayDeleteItemsButtons->editAttributes() ?>>
	<label class="custom-control-label" for="x_DisplayDeleteItemsButtons[]_737736"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->DisplayDeleteItemsButtons->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasters_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_WorksheetMasters_ActiveFlag" class="<?php echo $WorksheetMasters_add->LeftColumnClass ?>"><?php echo $WorksheetMasters_add->ActiveFlag->caption() ?><?php echo $WorksheetMasters_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasters_add->RightColumnClass ?>"><div <?php echo $WorksheetMasters_add->ActiveFlag->cellAttributes() ?>>
<span id="el_WorksheetMasters_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasters_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_552477" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_552477"></label>
</div>
</span>
<?php echo $WorksheetMasters_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("WorksheetMasterCategories", explode(",", $WorksheetMasters->getCurrentDetailTable())) && $WorksheetMasterCategories->DetailAdd) {
?>
<?php if ($WorksheetMasters->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("WorksheetMasterCategories", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "WorksheetMasterCategoriesgrid.php" ?>
<?php } ?>
<?php
	if (in_array("WorksheetMasterSizes", explode(",", $WorksheetMasters->getCurrentDetailTable())) && $WorksheetMasterSizes->DetailAdd) {
?>
<?php if ($WorksheetMasters->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("WorksheetMasterSizes", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "WorksheetMasterSizesgrid.php" ?>
<?php } ?>
<?php if (!$WorksheetMasters_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $WorksheetMasters_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetMasters_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$WorksheetMasters_add->showPageFooter();
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
$WorksheetMasters_add->terminate();
?>