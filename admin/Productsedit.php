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
$Products_edit = new Products_edit();

// Run the page
$Products_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Products_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fProductsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fProductsedit = currentForm = new ew.Form("fProductsedit", "edit");

	// Validate form
	fProductsedit.validate = function() {
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
			<?php if ($Products_edit->Product_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Product_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->Product_Idn->caption(), $Products_edit->Product_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->Department_Idn->caption(), $Products_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->WorksheetMaster_Idn->caption(), $Products_edit->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->WorksheetCategory_Idn->caption(), $Products_edit->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->Manufacturer_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Manufacturer_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->Manufacturer_Idn->caption(), $Products_edit->Manufacturer_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->Rank->caption(), $Products_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_edit->Rank->errorMessage()) ?>");
			<?php if ($Products_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->Name->caption(), $Products_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->MaterialUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_MaterialUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->MaterialUnitPrice->caption(), $Products_edit->MaterialUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MaterialUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_edit->MaterialUnitPrice->errorMessage()) ?>");
			<?php if ($Products_edit->FieldUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->FieldUnitPrice->caption(), $Products_edit->FieldUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_edit->FieldUnitPrice->errorMessage()) ?>");
			<?php if ($Products_edit->ShopUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_ShopUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->ShopUnitPrice->caption(), $Products_edit->ShopUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ShopUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_edit->ShopUnitPrice->errorMessage()) ?>");
			<?php if ($Products_edit->EngineerUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_EngineerUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->EngineerUnitPrice->caption(), $Products_edit->EngineerUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EngineerUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_edit->EngineerUnitPrice->errorMessage()) ?>");
			<?php if ($Products_edit->DefaultQuantity->Required) { ?>
				elm = this.getElements("x" + infix + "_DefaultQuantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->DefaultQuantity->caption(), $Products_edit->DefaultQuantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DefaultQuantity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_edit->DefaultQuantity->errorMessage()) ?>");
			<?php if ($Products_edit->ProductSize_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductSize_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->ProductSize_Idn->caption(), $Products_edit->ProductSize_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->Description->caption(), $Products_edit->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->PipeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PipeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->PipeType_Idn->caption(), $Products_edit->PipeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->ScheduleType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ScheduleType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->ScheduleType_Idn->caption(), $Products_edit->ScheduleType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->Fitting_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Fitting_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->Fitting_Idn->caption(), $Products_edit->Fitting_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->GroovedFittingType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GroovedFittingType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->GroovedFittingType_Idn->caption(), $Products_edit->GroovedFittingType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->ThreadedFittingType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ThreadedFittingType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->ThreadedFittingType_Idn->caption(), $Products_edit->ThreadedFittingType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->HangerType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->HangerType_Idn->caption(), $Products_edit->HangerType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->HangerSubType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerSubType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->HangerSubType_Idn->caption(), $Products_edit->HangerSubType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->SubcontractCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SubcontractCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->SubcontractCategory_Idn->caption(), $Products_edit->SubcontractCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->ApplyToAdjustmentFactorsFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ApplyToAdjustmentFactorsFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->ApplyToAdjustmentFactorsFlag->caption(), $Products_edit->ApplyToAdjustmentFactorsFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->ApplyToContingencyFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ApplyToContingencyFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->ApplyToContingencyFlag->caption(), $Products_edit->ApplyToContingencyFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->IsMainComponent->Required) { ?>
				elm = this.getElements("x" + infix + "_IsMainComponent[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->IsMainComponent->caption(), $Products_edit->IsMainComponent->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->DomesticFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_DomesticFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->DomesticFlag->caption(), $Products_edit->DomesticFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->LoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_LoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->LoadFlag->caption(), $Products_edit->LoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->AutoLoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_AutoLoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->AutoLoadFlag->caption(), $Products_edit->AutoLoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->ActiveFlag->caption(), $Products_edit->ActiveFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->GradeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GradeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->GradeType_Idn->caption(), $Products_edit->GradeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->PressureType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PressureType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->PressureType_Idn->caption(), $Products_edit->PressureType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->SeamlessFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_SeamlessFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->SeamlessFlag->caption(), $Products_edit->SeamlessFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->ResponseType->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponseType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->ResponseType->caption(), $Products_edit->ResponseType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->FMJobFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_FMJobFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->FMJobFlag->caption(), $Products_edit->FMJobFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->RecommendedBoxes->Required) { ?>
				elm = this.getElements("x" + infix + "_RecommendedBoxes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->RecommendedBoxes->caption(), $Products_edit->RecommendedBoxes->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RecommendedBoxes");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_edit->RecommendedBoxes->errorMessage()) ?>");
			<?php if ($Products_edit->RecommendedWireFootage->Required) { ?>
				elm = this.getElements("x" + infix + "_RecommendedWireFootage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->RecommendedWireFootage->caption(), $Products_edit->RecommendedWireFootage->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RecommendedWireFootage");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_edit->RecommendedWireFootage->errorMessage()) ?>");
			<?php if ($Products_edit->CoverageType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_CoverageType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->CoverageType_Idn->caption(), $Products_edit->CoverageType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->HeadType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HeadType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->HeadType_Idn->caption(), $Products_edit->HeadType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->FinishType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FinishType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->FinishType_Idn->caption(), $Products_edit->FinishType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->Outlet_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Outlet_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->Outlet_Idn->caption(), $Products_edit->Outlet_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->RiserType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RiserType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->RiserType_Idn->caption(), $Products_edit->RiserType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->BackFlowType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_BackFlowType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->BackFlowType_Idn->caption(), $Products_edit->BackFlowType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->ControlValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ControlValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->ControlValve_Idn->caption(), $Products_edit->ControlValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->CheckValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_CheckValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->CheckValve_Idn->caption(), $Products_edit->CheckValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->FDCType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FDCType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->FDCType_Idn->caption(), $Products_edit->FDCType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->BellType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_BellType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->BellType_Idn->caption(), $Products_edit->BellType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->TappingTee_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_TappingTee_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->TappingTee_Idn->caption(), $Products_edit->TappingTee_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->UndergroundValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_UndergroundValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->UndergroundValve_Idn->caption(), $Products_edit->UndergroundValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->LiftDuration_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LiftDuration_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->LiftDuration_Idn->caption(), $Products_edit->LiftDuration_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->TrimPackageFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_TrimPackageFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->TrimPackageFlag->caption(), $Products_edit->TrimPackageFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->ListedFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ListedFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->ListedFlag->caption(), $Products_edit->ListedFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->BoxWireLength->Required) { ?>
				elm = this.getElements("x" + infix + "_BoxWireLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->BoxWireLength->caption(), $Products_edit->BoxWireLength->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoxWireLength");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_edit->BoxWireLength->errorMessage()) ?>");
			<?php if ($Products_edit->IsFirePump->Required) { ?>
				elm = this.getElements("x" + infix + "_IsFirePump[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->IsFirePump->caption(), $Products_edit->IsFirePump->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->FirePumpType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FirePumpType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->FirePumpType_Idn->caption(), $Products_edit->FirePumpType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->FirePumpAttribute_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FirePumpAttribute_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->FirePumpAttribute_Idn->caption(), $Products_edit->FirePumpAttribute_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FirePumpAttribute_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_edit->FirePumpAttribute_Idn->errorMessage()) ?>");
			<?php if ($Products_edit->IsDieselFuel->Required) { ?>
				elm = this.getElements("x" + infix + "_IsDieselFuel[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->IsDieselFuel->caption(), $Products_edit->IsDieselFuel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->IsSolution->Required) { ?>
				elm = this.getElements("x" + infix + "_IsSolution[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->IsSolution->caption(), $Products_edit->IsSolution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_edit->Position_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Position_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_edit->Position_Idn->caption(), $Products_edit->Position_Idn->RequiredErrorMessage)) ?>");
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
	fProductsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fProductsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Multi-Page
	fProductsedit.multiPage = new ew.MultiPage("fProductsedit");

	// Dynamic selection lists
	fProductsedit.lists["x_Department_Idn"] = <?php echo $Products_edit->Department_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($Products_edit->Department_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_WorksheetMaster_Idn"] = <?php echo $Products_edit->WorksheetMaster_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($Products_edit->WorksheetMaster_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_WorksheetCategory_Idn"] = <?php echo $Products_edit->WorksheetCategory_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($Products_edit->WorksheetCategory_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_Manufacturer_Idn"] = <?php echo $Products_edit->Manufacturer_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_Manufacturer_Idn"].options = <?php echo JsonEncode($Products_edit->Manufacturer_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_ProductSize_Idn"] = <?php echo $Products_edit->ProductSize_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_ProductSize_Idn"].options = <?php echo JsonEncode($Products_edit->ProductSize_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_PipeType_Idn"] = <?php echo $Products_edit->PipeType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_PipeType_Idn"].options = <?php echo JsonEncode($Products_edit->PipeType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_ScheduleType_Idn"] = <?php echo $Products_edit->ScheduleType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_ScheduleType_Idn"].options = <?php echo JsonEncode($Products_edit->ScheduleType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_Fitting_Idn"] = <?php echo $Products_edit->Fitting_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_Fitting_Idn"].options = <?php echo JsonEncode($Products_edit->Fitting_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_GroovedFittingType_Idn"] = <?php echo $Products_edit->GroovedFittingType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_GroovedFittingType_Idn"].options = <?php echo JsonEncode($Products_edit->GroovedFittingType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_ThreadedFittingType_Idn"] = <?php echo $Products_edit->ThreadedFittingType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_ThreadedFittingType_Idn"].options = <?php echo JsonEncode($Products_edit->ThreadedFittingType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_HangerType_Idn"] = <?php echo $Products_edit->HangerType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_HangerType_Idn"].options = <?php echo JsonEncode($Products_edit->HangerType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_HangerSubType_Idn"] = <?php echo $Products_edit->HangerSubType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_HangerSubType_Idn"].options = <?php echo JsonEncode($Products_edit->HangerSubType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_SubcontractCategory_Idn"] = <?php echo $Products_edit->SubcontractCategory_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_SubcontractCategory_Idn"].options = <?php echo JsonEncode($Products_edit->SubcontractCategory_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_ApplyToAdjustmentFactorsFlag[]"] = <?php echo $Products_edit->ApplyToAdjustmentFactorsFlag->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_ApplyToAdjustmentFactorsFlag[]"].options = <?php echo JsonEncode($Products_edit->ApplyToAdjustmentFactorsFlag->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_ApplyToContingencyFlag[]"] = <?php echo $Products_edit->ApplyToContingencyFlag->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_ApplyToContingencyFlag[]"].options = <?php echo JsonEncode($Products_edit->ApplyToContingencyFlag->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_IsMainComponent[]"] = <?php echo $Products_edit->IsMainComponent->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_IsMainComponent[]"].options = <?php echo JsonEncode($Products_edit->IsMainComponent->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_DomesticFlag[]"] = <?php echo $Products_edit->DomesticFlag->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_DomesticFlag[]"].options = <?php echo JsonEncode($Products_edit->DomesticFlag->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_LoadFlag[]"] = <?php echo $Products_edit->LoadFlag->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_LoadFlag[]"].options = <?php echo JsonEncode($Products_edit->LoadFlag->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_AutoLoadFlag[]"] = <?php echo $Products_edit->AutoLoadFlag->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_AutoLoadFlag[]"].options = <?php echo JsonEncode($Products_edit->AutoLoadFlag->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_ActiveFlag[]"] = <?php echo $Products_edit->ActiveFlag->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Products_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_GradeType_Idn"] = <?php echo $Products_edit->GradeType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_GradeType_Idn"].options = <?php echo JsonEncode($Products_edit->GradeType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_PressureType_Idn"] = <?php echo $Products_edit->PressureType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_PressureType_Idn"].options = <?php echo JsonEncode($Products_edit->PressureType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_SeamlessFlag[]"] = <?php echo $Products_edit->SeamlessFlag->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_SeamlessFlag[]"].options = <?php echo JsonEncode($Products_edit->SeamlessFlag->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_ResponseType"] = <?php echo $Products_edit->ResponseType->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_ResponseType"].options = <?php echo JsonEncode($Products_edit->ResponseType->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_FMJobFlag[]"] = <?php echo $Products_edit->FMJobFlag->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_FMJobFlag[]"].options = <?php echo JsonEncode($Products_edit->FMJobFlag->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_CoverageType_Idn"] = <?php echo $Products_edit->CoverageType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_CoverageType_Idn"].options = <?php echo JsonEncode($Products_edit->CoverageType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_HeadType_Idn"] = <?php echo $Products_edit->HeadType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_HeadType_Idn"].options = <?php echo JsonEncode($Products_edit->HeadType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_FinishType_Idn"] = <?php echo $Products_edit->FinishType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_FinishType_Idn"].options = <?php echo JsonEncode($Products_edit->FinishType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_Outlet_Idn"] = <?php echo $Products_edit->Outlet_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_Outlet_Idn"].options = <?php echo JsonEncode($Products_edit->Outlet_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_RiserType_Idn"] = <?php echo $Products_edit->RiserType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_RiserType_Idn"].options = <?php echo JsonEncode($Products_edit->RiserType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_BackFlowType_Idn"] = <?php echo $Products_edit->BackFlowType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_BackFlowType_Idn"].options = <?php echo JsonEncode($Products_edit->BackFlowType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_ControlValve_Idn"] = <?php echo $Products_edit->ControlValve_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_ControlValve_Idn"].options = <?php echo JsonEncode($Products_edit->ControlValve_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_CheckValve_Idn"] = <?php echo $Products_edit->CheckValve_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_CheckValve_Idn"].options = <?php echo JsonEncode($Products_edit->CheckValve_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_FDCType_Idn"] = <?php echo $Products_edit->FDCType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_FDCType_Idn"].options = <?php echo JsonEncode($Products_edit->FDCType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_BellType_Idn"] = <?php echo $Products_edit->BellType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_BellType_Idn"].options = <?php echo JsonEncode($Products_edit->BellType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_TappingTee_Idn"] = <?php echo $Products_edit->TappingTee_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_TappingTee_Idn"].options = <?php echo JsonEncode($Products_edit->TappingTee_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_UndergroundValve_Idn"] = <?php echo $Products_edit->UndergroundValve_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_UndergroundValve_Idn"].options = <?php echo JsonEncode($Products_edit->UndergroundValve_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_LiftDuration_Idn"] = <?php echo $Products_edit->LiftDuration_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_LiftDuration_Idn"].options = <?php echo JsonEncode($Products_edit->LiftDuration_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_TrimPackageFlag[]"] = <?php echo $Products_edit->TrimPackageFlag->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_TrimPackageFlag[]"].options = <?php echo JsonEncode($Products_edit->TrimPackageFlag->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_ListedFlag[]"] = <?php echo $Products_edit->ListedFlag->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_ListedFlag[]"].options = <?php echo JsonEncode($Products_edit->ListedFlag->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_IsFirePump[]"] = <?php echo $Products_edit->IsFirePump->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_IsFirePump[]"].options = <?php echo JsonEncode($Products_edit->IsFirePump->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_FirePumpType_Idn"] = <?php echo $Products_edit->FirePumpType_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_FirePumpType_Idn"].options = <?php echo JsonEncode($Products_edit->FirePumpType_Idn->lookupOptions()) ?>;
	fProductsedit.lists["x_IsDieselFuel[]"] = <?php echo $Products_edit->IsDieselFuel->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_IsDieselFuel[]"].options = <?php echo JsonEncode($Products_edit->IsDieselFuel->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_IsSolution[]"] = <?php echo $Products_edit->IsSolution->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_IsSolution[]"].options = <?php echo JsonEncode($Products_edit->IsSolution->options(FALSE, TRUE)) ?>;
	fProductsedit.lists["x_Position_Idn"] = <?php echo $Products_edit->Position_Idn->Lookup->toClientList($Products_edit) ?>;
	fProductsedit.lists["x_Position_Idn"].options = <?php echo JsonEncode($Products_edit->Position_Idn->lookupOptions()) ?>;
	loadjs.done("fProductsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Products_edit->showPageHeader(); ?>
<?php
$Products_edit->showMessage();
?>
<?php if (!$Products_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Products_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fProductsedit" id="fProductsedit" class="<?php echo $Products_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Products">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Products_edit->IsModal ?>">
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="Products_edit"><!-- multi-page tabs -->
	<ul class="<?php echo $Products_edit->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $Products_edit->MultiPages->pageStyle(1) ?>" href="#tab_Products1" data-toggle="tab"><?php echo $Products->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $Products_edit->MultiPages->pageStyle(2) ?>" href="#tab_Products2" data-toggle="tab"><?php echo $Products->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $Products_edit->MultiPages->pageStyle(3) ?>" href="#tab_Products3" data-toggle="tab"><?php echo $Products->pageCaption(3) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $Products_edit->MultiPages->pageStyle(4) ?>" href="#tab_Products4" data-toggle="tab"><?php echo $Products->pageCaption(4) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $Products_edit->MultiPages->pageStyle(1) ?>" id="tab_Products1"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($Products_edit->Product_Idn->Visible) { // Product_Idn ?>
	<div id="r_Product_Idn" class="form-group row">
		<label id="elh_Products_Product_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->Product_Idn->caption() ?><?php echo $Products_edit->Product_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->Product_Idn->cellAttributes() ?>>
<span id="el_Products_Product_Idn">
<span<?php echo $Products_edit->Product_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Products_edit->Product_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Products" data-field="x_Product_Idn" data-page="1" name="x_Product_Idn" id="x_Product_Idn" value="<?php echo HtmlEncode($Products_edit->Product_Idn->CurrentValue) ?>">
<?php echo $Products_edit->Product_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_Products_Department_Idn" for="x_Department_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->Department_Idn->caption() ?><?php echo $Products_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->Department_Idn->cellAttributes() ?>>
<span id="el_Products_Department_Idn">
<?php $Products_edit->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Department_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $Products_edit->Department_Idn->editAttributes() ?>>
			<?php echo $Products_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->Department_Idn->Lookup->getParamTag($Products_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $Products_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_Products_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->WorksheetMaster_Idn->caption() ?><?php echo $Products_edit->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_Products_WorksheetMaster_Idn">
<?php $Products_edit->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetMaster_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $Products_edit->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Products_edit->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->WorksheetMaster_Idn->Lookup->getParamTag($Products_edit, "p_x_WorksheetMaster_Idn") ?>
</span>
<?php echo $Products_edit->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<div id="r_WorksheetCategory_Idn" class="form-group row">
		<label id="elh_Products_WorksheetCategory_Idn" for="x_WorksheetCategory_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->WorksheetCategory_Idn->caption() ?><?php echo $Products_edit->WorksheetCategory_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el_Products_WorksheetCategory_Idn">
<?php $Products_edit->WorksheetCategory_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetCategory_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetCategory_Idn" name="x_WorksheetCategory_Idn"<?php echo $Products_edit->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Products_edit->WorksheetCategory_Idn->selectOptionListHtml("x_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->WorksheetCategory_Idn->Lookup->getParamTag($Products_edit, "p_x_WorksheetCategory_Idn") ?>
</span>
<?php echo $Products_edit->WorksheetCategory_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
	<div id="r_Manufacturer_Idn" class="form-group row">
		<label id="elh_Products_Manufacturer_Idn" for="x_Manufacturer_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->Manufacturer_Idn->caption() ?><?php echo $Products_edit->Manufacturer_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->Manufacturer_Idn->cellAttributes() ?>>
<span id="el_Products_Manufacturer_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Manufacturer_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->Manufacturer_Idn->displayValueSeparatorAttribute() ?>" id="x_Manufacturer_Idn" name="x_Manufacturer_Idn"<?php echo $Products_edit->Manufacturer_Idn->editAttributes() ?>>
			<?php echo $Products_edit->Manufacturer_Idn->selectOptionListHtml("x_Manufacturer_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->Manufacturer_Idn->Lookup->getParamTag($Products_edit, "p_x_Manufacturer_Idn") ?>
</span>
<?php echo $Products_edit->Manufacturer_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_Products_Rank" for="x_Rank" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->Rank->caption() ?><?php echo $Products_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->Rank->cellAttributes() ?>>
<span id="el_Products_Rank">
<input type="text" data-table="Products" data-field="x_Rank" data-page="1" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $Products_edit->Rank->EditValue ?>"<?php echo $Products_edit->Rank->editAttributes() ?>>
</span>
<?php echo $Products_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_Products_Name" for="x_Name" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->Name->caption() ?><?php echo $Products_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->Name->cellAttributes() ?>>
<span id="el_Products_Name">
<input type="text" data-table="Products" data-field="x_Name" data-page="1" name="x_Name" id="x_Name" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($Products_edit->Name->getPlaceHolder()) ?>" value="<?php echo $Products_edit->Name->EditValue ?>"<?php echo $Products_edit->Name->editAttributes() ?>>
</span>
<?php echo $Products_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->MaterialUnitPrice->Visible) { // MaterialUnitPrice ?>
	<div id="r_MaterialUnitPrice" class="form-group row">
		<label id="elh_Products_MaterialUnitPrice" for="x_MaterialUnitPrice" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->MaterialUnitPrice->caption() ?><?php echo $Products_edit->MaterialUnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->MaterialUnitPrice->cellAttributes() ?>>
<span id="el_Products_MaterialUnitPrice">
<input type="text" data-table="Products" data-field="x_MaterialUnitPrice" data-page="1" name="x_MaterialUnitPrice" id="x_MaterialUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_edit->MaterialUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_edit->MaterialUnitPrice->EditValue ?>"<?php echo $Products_edit->MaterialUnitPrice->editAttributes() ?>>
</span>
<?php echo $Products_edit->MaterialUnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
	<div id="r_FieldUnitPrice" class="form-group row">
		<label id="elh_Products_FieldUnitPrice" for="x_FieldUnitPrice" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->FieldUnitPrice->caption() ?><?php echo $Products_edit->FieldUnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->FieldUnitPrice->cellAttributes() ?>>
<span id="el_Products_FieldUnitPrice">
<input type="text" data-table="Products" data-field="x_FieldUnitPrice" data-page="1" name="x_FieldUnitPrice" id="x_FieldUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_edit->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_edit->FieldUnitPrice->EditValue ?>"<?php echo $Products_edit->FieldUnitPrice->editAttributes() ?>>
</span>
<?php echo $Products_edit->FieldUnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->ShopUnitPrice->Visible) { // ShopUnitPrice ?>
	<div id="r_ShopUnitPrice" class="form-group row">
		<label id="elh_Products_ShopUnitPrice" for="x_ShopUnitPrice" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->ShopUnitPrice->caption() ?><?php echo $Products_edit->ShopUnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->ShopUnitPrice->cellAttributes() ?>>
<span id="el_Products_ShopUnitPrice">
<input type="text" data-table="Products" data-field="x_ShopUnitPrice" data-page="1" name="x_ShopUnitPrice" id="x_ShopUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_edit->ShopUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_edit->ShopUnitPrice->EditValue ?>"<?php echo $Products_edit->ShopUnitPrice->editAttributes() ?>>
</span>
<?php echo $Products_edit->ShopUnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->EngineerUnitPrice->Visible) { // EngineerUnitPrice ?>
	<div id="r_EngineerUnitPrice" class="form-group row">
		<label id="elh_Products_EngineerUnitPrice" for="x_EngineerUnitPrice" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->EngineerUnitPrice->caption() ?><?php echo $Products_edit->EngineerUnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->EngineerUnitPrice->cellAttributes() ?>>
<span id="el_Products_EngineerUnitPrice">
<input type="text" data-table="Products" data-field="x_EngineerUnitPrice" data-page="1" name="x_EngineerUnitPrice" id="x_EngineerUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_edit->EngineerUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_edit->EngineerUnitPrice->EditValue ?>"<?php echo $Products_edit->EngineerUnitPrice->editAttributes() ?>>
</span>
<?php echo $Products_edit->EngineerUnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->DefaultQuantity->Visible) { // DefaultQuantity ?>
	<div id="r_DefaultQuantity" class="form-group row">
		<label id="elh_Products_DefaultQuantity" for="x_DefaultQuantity" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->DefaultQuantity->caption() ?><?php echo $Products_edit->DefaultQuantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->DefaultQuantity->cellAttributes() ?>>
<span id="el_Products_DefaultQuantity">
<input type="text" data-table="Products" data-field="x_DefaultQuantity" data-page="1" name="x_DefaultQuantity" id="x_DefaultQuantity" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_edit->DefaultQuantity->getPlaceHolder()) ?>" value="<?php echo $Products_edit->DefaultQuantity->EditValue ?>"<?php echo $Products_edit->DefaultQuantity->editAttributes() ?>>
</span>
<?php echo $Products_edit->DefaultQuantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
	<div id="r_ProductSize_Idn" class="form-group row">
		<label id="elh_Products_ProductSize_Idn" for="x_ProductSize_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->ProductSize_Idn->caption() ?><?php echo $Products_edit->ProductSize_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->ProductSize_Idn->cellAttributes() ?>>
<span id="el_Products_ProductSize_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ProductSize_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x_ProductSize_Idn" name="x_ProductSize_Idn"<?php echo $Products_edit->ProductSize_Idn->editAttributes() ?>>
			<?php echo $Products_edit->ProductSize_Idn->selectOptionListHtml("x_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->ProductSize_Idn->Lookup->getParamTag($Products_edit, "p_x_ProductSize_Idn") ?>
</span>
<?php echo $Products_edit->ProductSize_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_Products_Description" for="x_Description" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->Description->caption() ?><?php echo $Products_edit->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->Description->cellAttributes() ?>>
<span id="el_Products_Description">
<textarea data-table="Products" data-field="x_Description" data-page="1" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($Products_edit->Description->getPlaceHolder()) ?>"<?php echo $Products_edit->Description->editAttributes() ?>><?php echo $Products_edit->Description->EditValue ?></textarea>
</span>
<?php echo $Products_edit->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->PipeType_Idn->Visible) { // PipeType_Idn ?>
	<div id="r_PipeType_Idn" class="form-group row">
		<label id="elh_Products_PipeType_Idn" for="x_PipeType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->PipeType_Idn->caption() ?><?php echo $Products_edit->PipeType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->PipeType_Idn->cellAttributes() ?>>
<span id="el_Products_PipeType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PipeType_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x_PipeType_Idn" name="x_PipeType_Idn"<?php echo $Products_edit->PipeType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->PipeType_Idn->selectOptionListHtml("x_PipeType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->PipeType_Idn->Lookup->getParamTag($Products_edit, "p_x_PipeType_Idn") ?>
</span>
<?php echo $Products_edit->PipeType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
	<div id="r_ScheduleType_Idn" class="form-group row">
		<label id="elh_Products_ScheduleType_Idn" for="x_ScheduleType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->ScheduleType_Idn->caption() ?><?php echo $Products_edit->ScheduleType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->ScheduleType_Idn->cellAttributes() ?>>
<span id="el_Products_ScheduleType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ScheduleType_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->ScheduleType_Idn->displayValueSeparatorAttribute() ?>" id="x_ScheduleType_Idn" name="x_ScheduleType_Idn"<?php echo $Products_edit->ScheduleType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->ScheduleType_Idn->selectOptionListHtml("x_ScheduleType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->ScheduleType_Idn->Lookup->getParamTag($Products_edit, "p_x_ScheduleType_Idn") ?>
</span>
<?php echo $Products_edit->ScheduleType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->Fitting_Idn->Visible) { // Fitting_Idn ?>
	<div id="r_Fitting_Idn" class="form-group row">
		<label id="elh_Products_Fitting_Idn" for="x_Fitting_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->Fitting_Idn->caption() ?><?php echo $Products_edit->Fitting_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->Fitting_Idn->cellAttributes() ?>>
<span id="el_Products_Fitting_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Fitting_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->Fitting_Idn->displayValueSeparatorAttribute() ?>" id="x_Fitting_Idn" name="x_Fitting_Idn"<?php echo $Products_edit->Fitting_Idn->editAttributes() ?>>
			<?php echo $Products_edit->Fitting_Idn->selectOptionListHtml("x_Fitting_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->Fitting_Idn->Lookup->getParamTag($Products_edit, "p_x_Fitting_Idn") ?>
</span>
<?php echo $Products_edit->Fitting_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
	<div id="r_GroovedFittingType_Idn" class="form-group row">
		<label id="elh_Products_GroovedFittingType_Idn" for="x_GroovedFittingType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->GroovedFittingType_Idn->caption() ?><?php echo $Products_edit->GroovedFittingType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->GroovedFittingType_Idn->cellAttributes() ?>>
<span id="el_Products_GroovedFittingType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GroovedFittingType_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->GroovedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x_GroovedFittingType_Idn" name="x_GroovedFittingType_Idn"<?php echo $Products_edit->GroovedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->GroovedFittingType_Idn->selectOptionListHtml("x_GroovedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->GroovedFittingType_Idn->Lookup->getParamTag($Products_edit, "p_x_GroovedFittingType_Idn") ?>
</span>
<?php echo $Products_edit->GroovedFittingType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
	<div id="r_ThreadedFittingType_Idn" class="form-group row">
		<label id="elh_Products_ThreadedFittingType_Idn" for="x_ThreadedFittingType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->ThreadedFittingType_Idn->caption() ?><?php echo $Products_edit->ThreadedFittingType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->ThreadedFittingType_Idn->cellAttributes() ?>>
<span id="el_Products_ThreadedFittingType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ThreadedFittingType_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->ThreadedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x_ThreadedFittingType_Idn" name="x_ThreadedFittingType_Idn"<?php echo $Products_edit->ThreadedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->ThreadedFittingType_Idn->selectOptionListHtml("x_ThreadedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->ThreadedFittingType_Idn->Lookup->getParamTag($Products_edit, "p_x_ThreadedFittingType_Idn") ?>
</span>
<?php echo $Products_edit->ThreadedFittingType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->HangerType_Idn->Visible) { // HangerType_Idn ?>
	<div id="r_HangerType_Idn" class="form-group row">
		<label id="elh_Products_HangerType_Idn" for="x_HangerType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->HangerType_Idn->caption() ?><?php echo $Products_edit->HangerType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->HangerType_Idn->cellAttributes() ?>>
<span id="el_Products_HangerType_Idn">
<?php $Products_edit->HangerType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerType_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x_HangerType_Idn" name="x_HangerType_Idn"<?php echo $Products_edit->HangerType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->HangerType_Idn->selectOptionListHtml("x_HangerType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->HangerType_Idn->Lookup->getParamTag($Products_edit, "p_x_HangerType_Idn") ?>
</span>
<?php echo $Products_edit->HangerType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
	<div id="r_HangerSubType_Idn" class="form-group row">
		<label id="elh_Products_HangerSubType_Idn" for="x_HangerSubType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->HangerSubType_Idn->caption() ?><?php echo $Products_edit->HangerSubType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->HangerSubType_Idn->cellAttributes() ?>>
<span id="el_Products_HangerSubType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerSubType_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->HangerSubType_Idn->displayValueSeparatorAttribute() ?>" id="x_HangerSubType_Idn" name="x_HangerSubType_Idn"<?php echo $Products_edit->HangerSubType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->HangerSubType_Idn->selectOptionListHtml("x_HangerSubType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->HangerSubType_Idn->Lookup->getParamTag($Products_edit, "p_x_HangerSubType_Idn") ?>
</span>
<?php echo $Products_edit->HangerSubType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->SubcontractCategory_Idn->Visible) { // SubcontractCategory_Idn ?>
	<div id="r_SubcontractCategory_Idn" class="form-group row">
		<label id="elh_Products_SubcontractCategory_Idn" for="x_SubcontractCategory_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->SubcontractCategory_Idn->caption() ?><?php echo $Products_edit->SubcontractCategory_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->SubcontractCategory_Idn->cellAttributes() ?>>
<span id="el_Products_SubcontractCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_SubcontractCategory_Idn" data-page="1" data-value-separator="<?php echo $Products_edit->SubcontractCategory_Idn->displayValueSeparatorAttribute() ?>" id="x_SubcontractCategory_Idn" name="x_SubcontractCategory_Idn"<?php echo $Products_edit->SubcontractCategory_Idn->editAttributes() ?>>
			<?php echo $Products_edit->SubcontractCategory_Idn->selectOptionListHtml("x_SubcontractCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->SubcontractCategory_Idn->Lookup->getParamTag($Products_edit, "p_x_SubcontractCategory_Idn") ?>
</span>
<?php echo $Products_edit->SubcontractCategory_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->ApplyToAdjustmentFactorsFlag->Visible) { // ApplyToAdjustmentFactorsFlag ?>
	<div id="r_ApplyToAdjustmentFactorsFlag" class="form-group row">
		<label id="elh_Products_ApplyToAdjustmentFactorsFlag" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->ApplyToAdjustmentFactorsFlag->caption() ?><?php echo $Products_edit->ApplyToAdjustmentFactorsFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->ApplyToAdjustmentFactorsFlag->cellAttributes() ?>>
<span id="el_Products_ApplyToAdjustmentFactorsFlag">
<?php
$selwrk = ConvertToBool($Products_edit->ApplyToAdjustmentFactorsFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToAdjustmentFactorsFlag" data-page="1" name="x_ApplyToAdjustmentFactorsFlag[]" id="x_ApplyToAdjustmentFactorsFlag[]_792695" value="1"<?php echo $selwrk ?><?php echo $Products_edit->ApplyToAdjustmentFactorsFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ApplyToAdjustmentFactorsFlag[]_792695"></label>
</div>
</span>
<?php echo $Products_edit->ApplyToAdjustmentFactorsFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->ApplyToContingencyFlag->Visible) { // ApplyToContingencyFlag ?>
	<div id="r_ApplyToContingencyFlag" class="form-group row">
		<label id="elh_Products_ApplyToContingencyFlag" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->ApplyToContingencyFlag->caption() ?><?php echo $Products_edit->ApplyToContingencyFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->ApplyToContingencyFlag->cellAttributes() ?>>
<span id="el_Products_ApplyToContingencyFlag">
<?php
$selwrk = ConvertToBool($Products_edit->ApplyToContingencyFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToContingencyFlag" data-page="1" name="x_ApplyToContingencyFlag[]" id="x_ApplyToContingencyFlag[]_217809" value="1"<?php echo $selwrk ?><?php echo $Products_edit->ApplyToContingencyFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ApplyToContingencyFlag[]_217809"></label>
</div>
</span>
<?php echo $Products_edit->ApplyToContingencyFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->IsMainComponent->Visible) { // IsMainComponent ?>
	<div id="r_IsMainComponent" class="form-group row">
		<label id="elh_Products_IsMainComponent" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->IsMainComponent->caption() ?><?php echo $Products_edit->IsMainComponent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->IsMainComponent->cellAttributes() ?>>
<span id="el_Products_IsMainComponent">
<?php
$selwrk = ConvertToBool($Products_edit->IsMainComponent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsMainComponent" data-page="1" name="x_IsMainComponent[]" id="x_IsMainComponent[]_394845" value="1"<?php echo $selwrk ?><?php echo $Products_edit->IsMainComponent->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsMainComponent[]_394845"></label>
</div>
</span>
<?php echo $Products_edit->IsMainComponent->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->DomesticFlag->Visible) { // DomesticFlag ?>
	<div id="r_DomesticFlag" class="form-group row">
		<label id="elh_Products_DomesticFlag" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->DomesticFlag->caption() ?><?php echo $Products_edit->DomesticFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->DomesticFlag->cellAttributes() ?>>
<span id="el_Products_DomesticFlag">
<?php
$selwrk = ConvertToBool($Products_edit->DomesticFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_DomesticFlag" data-page="1" name="x_DomesticFlag[]" id="x_DomesticFlag[]_663478" value="1"<?php echo $selwrk ?><?php echo $Products_edit->DomesticFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_DomesticFlag[]_663478"></label>
</div>
</span>
<?php echo $Products_edit->DomesticFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->LoadFlag->Visible) { // LoadFlag ?>
	<div id="r_LoadFlag" class="form-group row">
		<label id="elh_Products_LoadFlag" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->LoadFlag->caption() ?><?php echo $Products_edit->LoadFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->LoadFlag->cellAttributes() ?>>
<span id="el_Products_LoadFlag">
<?php
$selwrk = ConvertToBool($Products_edit->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_LoadFlag" data-page="1" name="x_LoadFlag[]" id="x_LoadFlag[]_741060" value="1"<?php echo $selwrk ?><?php echo $Products_edit->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_LoadFlag[]_741060"></label>
</div>
</span>
<?php echo $Products_edit->LoadFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
	<div id="r_AutoLoadFlag" class="form-group row">
		<label id="elh_Products_AutoLoadFlag" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->AutoLoadFlag->caption() ?><?php echo $Products_edit->AutoLoadFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->AutoLoadFlag->cellAttributes() ?>>
<span id="el_Products_AutoLoadFlag">
<?php
$selwrk = ConvertToBool($Products_edit->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_AutoLoadFlag" data-page="1" name="x_AutoLoadFlag[]" id="x_AutoLoadFlag[]_557384" value="1"<?php echo $selwrk ?><?php echo $Products_edit->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_AutoLoadFlag[]_557384"></label>
</div>
</span>
<?php echo $Products_edit->AutoLoadFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_Products_ActiveFlag" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->ActiveFlag->caption() ?><?php echo $Products_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_Products_ActiveFlag">
<?php
$selwrk = ConvertToBool($Products_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ActiveFlag" data-page="1" name="x_ActiveFlag[]" id="x_ActiveFlag[]_780797" value="1"<?php echo $selwrk ?><?php echo $Products_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_780797"></label>
</div>
</span>
<?php echo $Products_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->ResponseType->Visible) { // ResponseType ?>
	<div id="r_ResponseType" class="form-group row">
		<label id="elh_Products_ResponseType" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->ResponseType->caption() ?><?php echo $Products_edit->ResponseType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->ResponseType->cellAttributes() ?>>
<span id="el_Products_ResponseType">
<div id="tp_x_ResponseType" class="ew-template"><input type="radio" class="custom-control-input" data-table="Products" data-field="x_ResponseType" data-page="1" data-value-separator="<?php echo $Products_edit->ResponseType->displayValueSeparatorAttribute() ?>" name="x_ResponseType" id="x_ResponseType" value="{value}"<?php echo $Products_edit->ResponseType->editAttributes() ?>></div>
<div id="dsl_x_ResponseType" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Products_edit->ResponseType->radioButtonListHtml(FALSE, "x_ResponseType", 1) ?>
</div></div>
</span>
<?php echo $Products_edit->ResponseType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $Products_edit->MultiPages->pageStyle(2) ?>" id="tab_Products2"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($Products_edit->GradeType_Idn->Visible) { // GradeType_Idn ?>
	<div id="r_GradeType_Idn" class="form-group row">
		<label id="elh_Products_GradeType_Idn" for="x_GradeType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->GradeType_Idn->caption() ?><?php echo $Products_edit->GradeType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->GradeType_Idn->cellAttributes() ?>>
<span id="el_Products_GradeType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GradeType_Idn" data-page="2" data-value-separator="<?php echo $Products_edit->GradeType_Idn->displayValueSeparatorAttribute() ?>" id="x_GradeType_Idn" name="x_GradeType_Idn"<?php echo $Products_edit->GradeType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->GradeType_Idn->selectOptionListHtml("x_GradeType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->GradeType_Idn->Lookup->getParamTag($Products_edit, "p_x_GradeType_Idn") ?>
</span>
<?php echo $Products_edit->GradeType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->PressureType_Idn->Visible) { // PressureType_Idn ?>
	<div id="r_PressureType_Idn" class="form-group row">
		<label id="elh_Products_PressureType_Idn" for="x_PressureType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->PressureType_Idn->caption() ?><?php echo $Products_edit->PressureType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->PressureType_Idn->cellAttributes() ?>>
<span id="el_Products_PressureType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PressureType_Idn" data-page="2" data-value-separator="<?php echo $Products_edit->PressureType_Idn->displayValueSeparatorAttribute() ?>" id="x_PressureType_Idn" name="x_PressureType_Idn"<?php echo $Products_edit->PressureType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->PressureType_Idn->selectOptionListHtml("x_PressureType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->PressureType_Idn->Lookup->getParamTag($Products_edit, "p_x_PressureType_Idn") ?>
</span>
<?php echo $Products_edit->PressureType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->SeamlessFlag->Visible) { // SeamlessFlag ?>
	<div id="r_SeamlessFlag" class="form-group row">
		<label id="elh_Products_SeamlessFlag" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->SeamlessFlag->caption() ?><?php echo $Products_edit->SeamlessFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->SeamlessFlag->cellAttributes() ?>>
<span id="el_Products_SeamlessFlag">
<?php
$selwrk = ConvertToBool($Products_edit->SeamlessFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_SeamlessFlag" data-page="2" name="x_SeamlessFlag[]" id="x_SeamlessFlag[]_283831" value="1"<?php echo $selwrk ?><?php echo $Products_edit->SeamlessFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_SeamlessFlag[]_283831"></label>
</div>
</span>
<?php echo $Products_edit->SeamlessFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->FMJobFlag->Visible) { // FMJobFlag ?>
	<div id="r_FMJobFlag" class="form-group row">
		<label id="elh_Products_FMJobFlag" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->FMJobFlag->caption() ?><?php echo $Products_edit->FMJobFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->FMJobFlag->cellAttributes() ?>>
<span id="el_Products_FMJobFlag">
<?php
$selwrk = ConvertToBool($Products_edit->FMJobFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_FMJobFlag" data-page="2" name="x_FMJobFlag[]" id="x_FMJobFlag[]_554750" value="1"<?php echo $selwrk ?><?php echo $Products_edit->FMJobFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_FMJobFlag[]_554750"></label>
</div>
</span>
<?php echo $Products_edit->FMJobFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->RecommendedBoxes->Visible) { // RecommendedBoxes ?>
	<div id="r_RecommendedBoxes" class="form-group row">
		<label id="elh_Products_RecommendedBoxes" for="x_RecommendedBoxes" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->RecommendedBoxes->caption() ?><?php echo $Products_edit->RecommendedBoxes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->RecommendedBoxes->cellAttributes() ?>>
<span id="el_Products_RecommendedBoxes">
<input type="text" data-table="Products" data-field="x_RecommendedBoxes" data-page="2" name="x_RecommendedBoxes" id="x_RecommendedBoxes" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_edit->RecommendedBoxes->getPlaceHolder()) ?>" value="<?php echo $Products_edit->RecommendedBoxes->EditValue ?>"<?php echo $Products_edit->RecommendedBoxes->editAttributes() ?>>
</span>
<?php echo $Products_edit->RecommendedBoxes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->RecommendedWireFootage->Visible) { // RecommendedWireFootage ?>
	<div id="r_RecommendedWireFootage" class="form-group row">
		<label id="elh_Products_RecommendedWireFootage" for="x_RecommendedWireFootage" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->RecommendedWireFootage->caption() ?><?php echo $Products_edit->RecommendedWireFootage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->RecommendedWireFootage->cellAttributes() ?>>
<span id="el_Products_RecommendedWireFootage">
<input type="text" data-table="Products" data-field="x_RecommendedWireFootage" data-page="2" name="x_RecommendedWireFootage" id="x_RecommendedWireFootage" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_edit->RecommendedWireFootage->getPlaceHolder()) ?>" value="<?php echo $Products_edit->RecommendedWireFootage->EditValue ?>"<?php echo $Products_edit->RecommendedWireFootage->editAttributes() ?>>
</span>
<?php echo $Products_edit->RecommendedWireFootage->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $Products_edit->MultiPages->pageStyle(3) ?>" id="tab_Products3"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($Products_edit->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
	<div id="r_CoverageType_Idn" class="form-group row">
		<label id="elh_Products_CoverageType_Idn" for="x_CoverageType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->CoverageType_Idn->caption() ?><?php echo $Products_edit->CoverageType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->CoverageType_Idn->cellAttributes() ?>>
<span id="el_Products_CoverageType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CoverageType_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->CoverageType_Idn->displayValueSeparatorAttribute() ?>" id="x_CoverageType_Idn" name="x_CoverageType_Idn"<?php echo $Products_edit->CoverageType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->CoverageType_Idn->selectOptionListHtml("x_CoverageType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->CoverageType_Idn->Lookup->getParamTag($Products_edit, "p_x_CoverageType_Idn") ?>
</span>
<?php echo $Products_edit->CoverageType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->HeadType_Idn->Visible) { // HeadType_Idn ?>
	<div id="r_HeadType_Idn" class="form-group row">
		<label id="elh_Products_HeadType_Idn" for="x_HeadType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->HeadType_Idn->caption() ?><?php echo $Products_edit->HeadType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->HeadType_Idn->cellAttributes() ?>>
<span id="el_Products_HeadType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HeadType_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->HeadType_Idn->displayValueSeparatorAttribute() ?>" id="x_HeadType_Idn" name="x_HeadType_Idn"<?php echo $Products_edit->HeadType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->HeadType_Idn->selectOptionListHtml("x_HeadType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->HeadType_Idn->Lookup->getParamTag($Products_edit, "p_x_HeadType_Idn") ?>
</span>
<?php echo $Products_edit->HeadType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->FinishType_Idn->Visible) { // FinishType_Idn ?>
	<div id="r_FinishType_Idn" class="form-group row">
		<label id="elh_Products_FinishType_Idn" for="x_FinishType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->FinishType_Idn->caption() ?><?php echo $Products_edit->FinishType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->FinishType_Idn->cellAttributes() ?>>
<span id="el_Products_FinishType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FinishType_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->FinishType_Idn->displayValueSeparatorAttribute() ?>" id="x_FinishType_Idn" name="x_FinishType_Idn"<?php echo $Products_edit->FinishType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->FinishType_Idn->selectOptionListHtml("x_FinishType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->FinishType_Idn->Lookup->getParamTag($Products_edit, "p_x_FinishType_Idn") ?>
</span>
<?php echo $Products_edit->FinishType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->Outlet_Idn->Visible) { // Outlet_Idn ?>
	<div id="r_Outlet_Idn" class="form-group row">
		<label id="elh_Products_Outlet_Idn" for="x_Outlet_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->Outlet_Idn->caption() ?><?php echo $Products_edit->Outlet_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->Outlet_Idn->cellAttributes() ?>>
<span id="el_Products_Outlet_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Outlet_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->Outlet_Idn->displayValueSeparatorAttribute() ?>" id="x_Outlet_Idn" name="x_Outlet_Idn"<?php echo $Products_edit->Outlet_Idn->editAttributes() ?>>
			<?php echo $Products_edit->Outlet_Idn->selectOptionListHtml("x_Outlet_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->Outlet_Idn->Lookup->getParamTag($Products_edit, "p_x_Outlet_Idn") ?>
</span>
<?php echo $Products_edit->Outlet_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->RiserType_Idn->Visible) { // RiserType_Idn ?>
	<div id="r_RiserType_Idn" class="form-group row">
		<label id="elh_Products_RiserType_Idn" for="x_RiserType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->RiserType_Idn->caption() ?><?php echo $Products_edit->RiserType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->RiserType_Idn->cellAttributes() ?>>
<span id="el_Products_RiserType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_RiserType_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->RiserType_Idn->displayValueSeparatorAttribute() ?>" id="x_RiserType_Idn" name="x_RiserType_Idn"<?php echo $Products_edit->RiserType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->RiserType_Idn->selectOptionListHtml("x_RiserType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->RiserType_Idn->Lookup->getParamTag($Products_edit, "p_x_RiserType_Idn") ?>
</span>
<?php echo $Products_edit->RiserType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->BackFlowType_Idn->Visible) { // BackFlowType_Idn ?>
	<div id="r_BackFlowType_Idn" class="form-group row">
		<label id="elh_Products_BackFlowType_Idn" for="x_BackFlowType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->BackFlowType_Idn->caption() ?><?php echo $Products_edit->BackFlowType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->BackFlowType_Idn->cellAttributes() ?>>
<span id="el_Products_BackFlowType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BackFlowType_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->BackFlowType_Idn->displayValueSeparatorAttribute() ?>" id="x_BackFlowType_Idn" name="x_BackFlowType_Idn"<?php echo $Products_edit->BackFlowType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->BackFlowType_Idn->selectOptionListHtml("x_BackFlowType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->BackFlowType_Idn->Lookup->getParamTag($Products_edit, "p_x_BackFlowType_Idn") ?>
</span>
<?php echo $Products_edit->BackFlowType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
	<div id="r_ControlValve_Idn" class="form-group row">
		<label id="elh_Products_ControlValve_Idn" for="x_ControlValve_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->ControlValve_Idn->caption() ?><?php echo $Products_edit->ControlValve_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->ControlValve_Idn->cellAttributes() ?>>
<span id="el_Products_ControlValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ControlValve_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->ControlValve_Idn->displayValueSeparatorAttribute() ?>" id="x_ControlValve_Idn" name="x_ControlValve_Idn"<?php echo $Products_edit->ControlValve_Idn->editAttributes() ?>>
			<?php echo $Products_edit->ControlValve_Idn->selectOptionListHtml("x_ControlValve_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->ControlValve_Idn->Lookup->getParamTag($Products_edit, "p_x_ControlValve_Idn") ?>
</span>
<?php echo $Products_edit->ControlValve_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
	<div id="r_CheckValve_Idn" class="form-group row">
		<label id="elh_Products_CheckValve_Idn" for="x_CheckValve_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->CheckValve_Idn->caption() ?><?php echo $Products_edit->CheckValve_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->CheckValve_Idn->cellAttributes() ?>>
<span id="el_Products_CheckValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CheckValve_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->CheckValve_Idn->displayValueSeparatorAttribute() ?>" id="x_CheckValve_Idn" name="x_CheckValve_Idn"<?php echo $Products_edit->CheckValve_Idn->editAttributes() ?>>
			<?php echo $Products_edit->CheckValve_Idn->selectOptionListHtml("x_CheckValve_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->CheckValve_Idn->Lookup->getParamTag($Products_edit, "p_x_CheckValve_Idn") ?>
</span>
<?php echo $Products_edit->CheckValve_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->FDCType_Idn->Visible) { // FDCType_Idn ?>
	<div id="r_FDCType_Idn" class="form-group row">
		<label id="elh_Products_FDCType_Idn" for="x_FDCType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->FDCType_Idn->caption() ?><?php echo $Products_edit->FDCType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->FDCType_Idn->cellAttributes() ?>>
<span id="el_Products_FDCType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FDCType_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->FDCType_Idn->displayValueSeparatorAttribute() ?>" id="x_FDCType_Idn" name="x_FDCType_Idn"<?php echo $Products_edit->FDCType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->FDCType_Idn->selectOptionListHtml("x_FDCType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->FDCType_Idn->Lookup->getParamTag($Products_edit, "p_x_FDCType_Idn") ?>
</span>
<?php echo $Products_edit->FDCType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->BellType_Idn->Visible) { // BellType_Idn ?>
	<div id="r_BellType_Idn" class="form-group row">
		<label id="elh_Products_BellType_Idn" for="x_BellType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->BellType_Idn->caption() ?><?php echo $Products_edit->BellType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->BellType_Idn->cellAttributes() ?>>
<span id="el_Products_BellType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BellType_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->BellType_Idn->displayValueSeparatorAttribute() ?>" id="x_BellType_Idn" name="x_BellType_Idn"<?php echo $Products_edit->BellType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->BellType_Idn->selectOptionListHtml("x_BellType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->BellType_Idn->Lookup->getParamTag($Products_edit, "p_x_BellType_Idn") ?>
</span>
<?php echo $Products_edit->BellType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
	<div id="r_TappingTee_Idn" class="form-group row">
		<label id="elh_Products_TappingTee_Idn" for="x_TappingTee_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->TappingTee_Idn->caption() ?><?php echo $Products_edit->TappingTee_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->TappingTee_Idn->cellAttributes() ?>>
<span id="el_Products_TappingTee_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_TappingTee_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->TappingTee_Idn->displayValueSeparatorAttribute() ?>" id="x_TappingTee_Idn" name="x_TappingTee_Idn"<?php echo $Products_edit->TappingTee_Idn->editAttributes() ?>>
			<?php echo $Products_edit->TappingTee_Idn->selectOptionListHtml("x_TappingTee_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->TappingTee_Idn->Lookup->getParamTag($Products_edit, "p_x_TappingTee_Idn") ?>
</span>
<?php echo $Products_edit->TappingTee_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
	<div id="r_UndergroundValve_Idn" class="form-group row">
		<label id="elh_Products_UndergroundValve_Idn" for="x_UndergroundValve_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->UndergroundValve_Idn->caption() ?><?php echo $Products_edit->UndergroundValve_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->UndergroundValve_Idn->cellAttributes() ?>>
<span id="el_Products_UndergroundValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_UndergroundValve_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->UndergroundValve_Idn->displayValueSeparatorAttribute() ?>" id="x_UndergroundValve_Idn" name="x_UndergroundValve_Idn"<?php echo $Products_edit->UndergroundValve_Idn->editAttributes() ?>>
			<?php echo $Products_edit->UndergroundValve_Idn->selectOptionListHtml("x_UndergroundValve_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->UndergroundValve_Idn->Lookup->getParamTag($Products_edit, "p_x_UndergroundValve_Idn") ?>
</span>
<?php echo $Products_edit->UndergroundValve_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
	<div id="r_LiftDuration_Idn" class="form-group row">
		<label id="elh_Products_LiftDuration_Idn" for="x_LiftDuration_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->LiftDuration_Idn->caption() ?><?php echo $Products_edit->LiftDuration_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->LiftDuration_Idn->cellAttributes() ?>>
<span id="el_Products_LiftDuration_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_LiftDuration_Idn" data-page="3" data-value-separator="<?php echo $Products_edit->LiftDuration_Idn->displayValueSeparatorAttribute() ?>" id="x_LiftDuration_Idn" name="x_LiftDuration_Idn"<?php echo $Products_edit->LiftDuration_Idn->editAttributes() ?>>
			<?php echo $Products_edit->LiftDuration_Idn->selectOptionListHtml("x_LiftDuration_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->LiftDuration_Idn->Lookup->getParamTag($Products_edit, "p_x_LiftDuration_Idn") ?>
</span>
<?php echo $Products_edit->LiftDuration_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->TrimPackageFlag->Visible) { // TrimPackageFlag ?>
	<div id="r_TrimPackageFlag" class="form-group row">
		<label id="elh_Products_TrimPackageFlag" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->TrimPackageFlag->caption() ?><?php echo $Products_edit->TrimPackageFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->TrimPackageFlag->cellAttributes() ?>>
<span id="el_Products_TrimPackageFlag">
<?php
$selwrk = ConvertToBool($Products_edit->TrimPackageFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_TrimPackageFlag" data-page="3" name="x_TrimPackageFlag[]" id="x_TrimPackageFlag[]_231666" value="1"<?php echo $selwrk ?><?php echo $Products_edit->TrimPackageFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_TrimPackageFlag[]_231666"></label>
</div>
</span>
<?php echo $Products_edit->TrimPackageFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->ListedFlag->Visible) { // ListedFlag ?>
	<div id="r_ListedFlag" class="form-group row">
		<label id="elh_Products_ListedFlag" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->ListedFlag->caption() ?><?php echo $Products_edit->ListedFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->ListedFlag->cellAttributes() ?>>
<span id="el_Products_ListedFlag">
<?php
$selwrk = ConvertToBool($Products_edit->ListedFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ListedFlag" data-page="3" name="x_ListedFlag[]" id="x_ListedFlag[]_375707" value="1"<?php echo $selwrk ?><?php echo $Products_edit->ListedFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ListedFlag[]_375707"></label>
</div>
</span>
<?php echo $Products_edit->ListedFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->BoxWireLength->Visible) { // BoxWireLength ?>
	<div id="r_BoxWireLength" class="form-group row">
		<label id="elh_Products_BoxWireLength" for="x_BoxWireLength" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->BoxWireLength->caption() ?><?php echo $Products_edit->BoxWireLength->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->BoxWireLength->cellAttributes() ?>>
<span id="el_Products_BoxWireLength">
<input type="text" data-table="Products" data-field="x_BoxWireLength" data-page="3" name="x_BoxWireLength" id="x_BoxWireLength" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_edit->BoxWireLength->getPlaceHolder()) ?>" value="<?php echo $Products_edit->BoxWireLength->EditValue ?>"<?php echo $Products_edit->BoxWireLength->editAttributes() ?>>
</span>
<?php echo $Products_edit->BoxWireLength->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $Products_edit->MultiPages->pageStyle(4) ?>" id="tab_Products4"><!-- multi-page .tab-pane -->
<div class="ew-edit-div"><!-- page* -->
<?php if ($Products_edit->IsFirePump->Visible) { // IsFirePump ?>
	<div id="r_IsFirePump" class="form-group row">
		<label id="elh_Products_IsFirePump" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->IsFirePump->caption() ?><?php echo $Products_edit->IsFirePump->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->IsFirePump->cellAttributes() ?>>
<span id="el_Products_IsFirePump">
<?php
$selwrk = ConvertToBool($Products_edit->IsFirePump->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsFirePump" data-page="4" name="x_IsFirePump[]" id="x_IsFirePump[]_665833" value="1"<?php echo $selwrk ?><?php echo $Products_edit->IsFirePump->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsFirePump[]_665833"></label>
</div>
</span>
<?php echo $Products_edit->IsFirePump->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
	<div id="r_FirePumpType_Idn" class="form-group row">
		<label id="elh_Products_FirePumpType_Idn" for="x_FirePumpType_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->FirePumpType_Idn->caption() ?><?php echo $Products_edit->FirePumpType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->FirePumpType_Idn->cellAttributes() ?>>
<span id="el_Products_FirePumpType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FirePumpType_Idn" data-page="4" data-value-separator="<?php echo $Products_edit->FirePumpType_Idn->displayValueSeparatorAttribute() ?>" id="x_FirePumpType_Idn" name="x_FirePumpType_Idn"<?php echo $Products_edit->FirePumpType_Idn->editAttributes() ?>>
			<?php echo $Products_edit->FirePumpType_Idn->selectOptionListHtml("x_FirePumpType_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->FirePumpType_Idn->Lookup->getParamTag($Products_edit, "p_x_FirePumpType_Idn") ?>
</span>
<?php echo $Products_edit->FirePumpType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
	<div id="r_FirePumpAttribute_Idn" class="form-group row">
		<label id="elh_Products_FirePumpAttribute_Idn" for="x_FirePumpAttribute_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->FirePumpAttribute_Idn->caption() ?><?php echo $Products_edit->FirePumpAttribute_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->FirePumpAttribute_Idn->cellAttributes() ?>>
<span id="el_Products_FirePumpAttribute_Idn">
<input type="text" data-table="Products" data-field="x_FirePumpAttribute_Idn" data-page="4" name="x_FirePumpAttribute_Idn" id="x_FirePumpAttribute_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_edit->FirePumpAttribute_Idn->getPlaceHolder()) ?>" value="<?php echo $Products_edit->FirePumpAttribute_Idn->EditValue ?>"<?php echo $Products_edit->FirePumpAttribute_Idn->editAttributes() ?>>
</span>
<?php echo $Products_edit->FirePumpAttribute_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->IsDieselFuel->Visible) { // IsDieselFuel ?>
	<div id="r_IsDieselFuel" class="form-group row">
		<label id="elh_Products_IsDieselFuel" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->IsDieselFuel->caption() ?><?php echo $Products_edit->IsDieselFuel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->IsDieselFuel->cellAttributes() ?>>
<span id="el_Products_IsDieselFuel">
<?php
$selwrk = ConvertToBool($Products_edit->IsDieselFuel->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsDieselFuel" data-page="4" name="x_IsDieselFuel[]" id="x_IsDieselFuel[]_542406" value="1"<?php echo $selwrk ?><?php echo $Products_edit->IsDieselFuel->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsDieselFuel[]_542406"></label>
</div>
</span>
<?php echo $Products_edit->IsDieselFuel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->IsSolution->Visible) { // IsSolution ?>
	<div id="r_IsSolution" class="form-group row">
		<label id="elh_Products_IsSolution" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->IsSolution->caption() ?><?php echo $Products_edit->IsSolution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->IsSolution->cellAttributes() ?>>
<span id="el_Products_IsSolution">
<?php
$selwrk = ConvertToBool($Products_edit->IsSolution->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsSolution" data-page="4" name="x_IsSolution[]" id="x_IsSolution[]_282926" value="1"<?php echo $selwrk ?><?php echo $Products_edit->IsSolution->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsSolution[]_282926"></label>
</div>
</span>
<?php echo $Products_edit->IsSolution->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_edit->Position_Idn->Visible) { // Position_Idn ?>
	<div id="r_Position_Idn" class="form-group row">
		<label id="elh_Products_Position_Idn" for="x_Position_Idn" class="<?php echo $Products_edit->LeftColumnClass ?>"><?php echo $Products_edit->Position_Idn->caption() ?><?php echo $Products_edit->Position_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_edit->RightColumnClass ?>"><div <?php echo $Products_edit->Position_Idn->cellAttributes() ?>>
<span id="el_Products_Position_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Position_Idn" data-page="4" data-value-separator="<?php echo $Products_edit->Position_Idn->displayValueSeparatorAttribute() ?>" id="x_Position_Idn" name="x_Position_Idn"<?php echo $Products_edit->Position_Idn->editAttributes() ?>>
			<?php echo $Products_edit->Position_Idn->selectOptionListHtml("x_Position_Idn") ?>
		</select>
</div>
<?php echo $Products_edit->Position_Idn->Lookup->getParamTag($Products_edit, "p_x_Position_Idn") ?>
</span>
<?php echo $Products_edit->Position_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<?php if (!$Products_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Products_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Products_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$Products_edit->IsModal) { ?>
<?php echo $Products_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$Products_edit->showPageFooter();
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
$Products_edit->terminate();
?>