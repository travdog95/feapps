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
$Products_add = new Products_add();

// Run the page
$Products_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Products_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fProductsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fProductsadd = currentForm = new ew.Form("fProductsadd", "add");

	// Validate form
	fProductsadd.validate = function() {
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
			<?php if ($Products_add->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->Department_Idn->caption(), $Products_add->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->WorksheetMaster_Idn->caption(), $Products_add->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->WorksheetCategory_Idn->caption(), $Products_add->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->Manufacturer_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Manufacturer_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->Manufacturer_Idn->caption(), $Products_add->Manufacturer_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->Rank->caption(), $Products_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_add->Rank->errorMessage()) ?>");
			<?php if ($Products_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->Name->caption(), $Products_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->MaterialUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_MaterialUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->MaterialUnitPrice->caption(), $Products_add->MaterialUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MaterialUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_add->MaterialUnitPrice->errorMessage()) ?>");
			<?php if ($Products_add->FieldUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->FieldUnitPrice->caption(), $Products_add->FieldUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_add->FieldUnitPrice->errorMessage()) ?>");
			<?php if ($Products_add->ShopUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_ShopUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->ShopUnitPrice->caption(), $Products_add->ShopUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ShopUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_add->ShopUnitPrice->errorMessage()) ?>");
			<?php if ($Products_add->EngineerUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_EngineerUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->EngineerUnitPrice->caption(), $Products_add->EngineerUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EngineerUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_add->EngineerUnitPrice->errorMessage()) ?>");
			<?php if ($Products_add->DefaultQuantity->Required) { ?>
				elm = this.getElements("x" + infix + "_DefaultQuantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->DefaultQuantity->caption(), $Products_add->DefaultQuantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DefaultQuantity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_add->DefaultQuantity->errorMessage()) ?>");
			<?php if ($Products_add->ProductSize_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductSize_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->ProductSize_Idn->caption(), $Products_add->ProductSize_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->Description->caption(), $Products_add->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->PipeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PipeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->PipeType_Idn->caption(), $Products_add->PipeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->ScheduleType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ScheduleType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->ScheduleType_Idn->caption(), $Products_add->ScheduleType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->Fitting_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Fitting_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->Fitting_Idn->caption(), $Products_add->Fitting_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->GroovedFittingType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GroovedFittingType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->GroovedFittingType_Idn->caption(), $Products_add->GroovedFittingType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->ThreadedFittingType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ThreadedFittingType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->ThreadedFittingType_Idn->caption(), $Products_add->ThreadedFittingType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->HangerType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->HangerType_Idn->caption(), $Products_add->HangerType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->HangerSubType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerSubType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->HangerSubType_Idn->caption(), $Products_add->HangerSubType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->SubcontractCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SubcontractCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->SubcontractCategory_Idn->caption(), $Products_add->SubcontractCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->ApplyToAdjustmentFactorsFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ApplyToAdjustmentFactorsFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->ApplyToAdjustmentFactorsFlag->caption(), $Products_add->ApplyToAdjustmentFactorsFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->ApplyToContingencyFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ApplyToContingencyFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->ApplyToContingencyFlag->caption(), $Products_add->ApplyToContingencyFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->IsMainComponent->Required) { ?>
				elm = this.getElements("x" + infix + "_IsMainComponent[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->IsMainComponent->caption(), $Products_add->IsMainComponent->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->DomesticFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_DomesticFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->DomesticFlag->caption(), $Products_add->DomesticFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->LoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_LoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->LoadFlag->caption(), $Products_add->LoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->AutoLoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_AutoLoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->AutoLoadFlag->caption(), $Products_add->AutoLoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->ActiveFlag->caption(), $Products_add->ActiveFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->GradeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GradeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->GradeType_Idn->caption(), $Products_add->GradeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->PressureType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PressureType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->PressureType_Idn->caption(), $Products_add->PressureType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->SeamlessFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_SeamlessFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->SeamlessFlag->caption(), $Products_add->SeamlessFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->ResponseType->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponseType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->ResponseType->caption(), $Products_add->ResponseType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->FMJobFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_FMJobFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->FMJobFlag->caption(), $Products_add->FMJobFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->RecommendedBoxes->Required) { ?>
				elm = this.getElements("x" + infix + "_RecommendedBoxes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->RecommendedBoxes->caption(), $Products_add->RecommendedBoxes->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RecommendedBoxes");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_add->RecommendedBoxes->errorMessage()) ?>");
			<?php if ($Products_add->RecommendedWireFootage->Required) { ?>
				elm = this.getElements("x" + infix + "_RecommendedWireFootage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->RecommendedWireFootage->caption(), $Products_add->RecommendedWireFootage->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RecommendedWireFootage");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_add->RecommendedWireFootage->errorMessage()) ?>");
			<?php if ($Products_add->CoverageType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_CoverageType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->CoverageType_Idn->caption(), $Products_add->CoverageType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->HeadType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HeadType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->HeadType_Idn->caption(), $Products_add->HeadType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->FinishType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FinishType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->FinishType_Idn->caption(), $Products_add->FinishType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->Outlet_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Outlet_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->Outlet_Idn->caption(), $Products_add->Outlet_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->RiserType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RiserType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->RiserType_Idn->caption(), $Products_add->RiserType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->BackFlowType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_BackFlowType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->BackFlowType_Idn->caption(), $Products_add->BackFlowType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->ControlValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ControlValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->ControlValve_Idn->caption(), $Products_add->ControlValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->CheckValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_CheckValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->CheckValve_Idn->caption(), $Products_add->CheckValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->FDCType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FDCType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->FDCType_Idn->caption(), $Products_add->FDCType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->BellType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_BellType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->BellType_Idn->caption(), $Products_add->BellType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->TappingTee_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_TappingTee_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->TappingTee_Idn->caption(), $Products_add->TappingTee_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->UndergroundValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_UndergroundValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->UndergroundValve_Idn->caption(), $Products_add->UndergroundValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->LiftDuration_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LiftDuration_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->LiftDuration_Idn->caption(), $Products_add->LiftDuration_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->TrimPackageFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_TrimPackageFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->TrimPackageFlag->caption(), $Products_add->TrimPackageFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->ListedFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ListedFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->ListedFlag->caption(), $Products_add->ListedFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->BoxWireLength->Required) { ?>
				elm = this.getElements("x" + infix + "_BoxWireLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->BoxWireLength->caption(), $Products_add->BoxWireLength->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoxWireLength");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_add->BoxWireLength->errorMessage()) ?>");
			<?php if ($Products_add->IsFirePump->Required) { ?>
				elm = this.getElements("x" + infix + "_IsFirePump[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->IsFirePump->caption(), $Products_add->IsFirePump->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->FirePumpType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FirePumpType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->FirePumpType_Idn->caption(), $Products_add->FirePumpType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->FirePumpAttribute_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FirePumpAttribute_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->FirePumpAttribute_Idn->caption(), $Products_add->FirePumpAttribute_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FirePumpAttribute_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_add->FirePumpAttribute_Idn->errorMessage()) ?>");
			<?php if ($Products_add->IsDieselFuel->Required) { ?>
				elm = this.getElements("x" + infix + "_IsDieselFuel[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->IsDieselFuel->caption(), $Products_add->IsDieselFuel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->IsSolution->Required) { ?>
				elm = this.getElements("x" + infix + "_IsSolution[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->IsSolution->caption(), $Products_add->IsSolution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_add->Position_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Position_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_add->Position_Idn->caption(), $Products_add->Position_Idn->RequiredErrorMessage)) ?>");
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
	fProductsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fProductsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Multi-Page
	fProductsadd.multiPage = new ew.MultiPage("fProductsadd");

	// Dynamic selection lists
	fProductsadd.lists["x_Department_Idn"] = <?php echo $Products_add->Department_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_Department_Idn"].options = <?php echo JsonEncode($Products_add->Department_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_WorksheetMaster_Idn"] = <?php echo $Products_add->WorksheetMaster_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($Products_add->WorksheetMaster_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_WorksheetCategory_Idn"] = <?php echo $Products_add->WorksheetCategory_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($Products_add->WorksheetCategory_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_Manufacturer_Idn"] = <?php echo $Products_add->Manufacturer_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_Manufacturer_Idn"].options = <?php echo JsonEncode($Products_add->Manufacturer_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_ProductSize_Idn"] = <?php echo $Products_add->ProductSize_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_ProductSize_Idn"].options = <?php echo JsonEncode($Products_add->ProductSize_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_PipeType_Idn"] = <?php echo $Products_add->PipeType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_PipeType_Idn"].options = <?php echo JsonEncode($Products_add->PipeType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_ScheduleType_Idn"] = <?php echo $Products_add->ScheduleType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_ScheduleType_Idn"].options = <?php echo JsonEncode($Products_add->ScheduleType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_Fitting_Idn"] = <?php echo $Products_add->Fitting_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_Fitting_Idn"].options = <?php echo JsonEncode($Products_add->Fitting_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_GroovedFittingType_Idn"] = <?php echo $Products_add->GroovedFittingType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_GroovedFittingType_Idn"].options = <?php echo JsonEncode($Products_add->GroovedFittingType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_ThreadedFittingType_Idn"] = <?php echo $Products_add->ThreadedFittingType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_ThreadedFittingType_Idn"].options = <?php echo JsonEncode($Products_add->ThreadedFittingType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_HangerType_Idn"] = <?php echo $Products_add->HangerType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_HangerType_Idn"].options = <?php echo JsonEncode($Products_add->HangerType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_HangerSubType_Idn"] = <?php echo $Products_add->HangerSubType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_HangerSubType_Idn"].options = <?php echo JsonEncode($Products_add->HangerSubType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_SubcontractCategory_Idn"] = <?php echo $Products_add->SubcontractCategory_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_SubcontractCategory_Idn"].options = <?php echo JsonEncode($Products_add->SubcontractCategory_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_ApplyToAdjustmentFactorsFlag[]"] = <?php echo $Products_add->ApplyToAdjustmentFactorsFlag->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_ApplyToAdjustmentFactorsFlag[]"].options = <?php echo JsonEncode($Products_add->ApplyToAdjustmentFactorsFlag->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_ApplyToContingencyFlag[]"] = <?php echo $Products_add->ApplyToContingencyFlag->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_ApplyToContingencyFlag[]"].options = <?php echo JsonEncode($Products_add->ApplyToContingencyFlag->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_IsMainComponent[]"] = <?php echo $Products_add->IsMainComponent->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_IsMainComponent[]"].options = <?php echo JsonEncode($Products_add->IsMainComponent->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_DomesticFlag[]"] = <?php echo $Products_add->DomesticFlag->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_DomesticFlag[]"].options = <?php echo JsonEncode($Products_add->DomesticFlag->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_LoadFlag[]"] = <?php echo $Products_add->LoadFlag->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_LoadFlag[]"].options = <?php echo JsonEncode($Products_add->LoadFlag->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_AutoLoadFlag[]"] = <?php echo $Products_add->AutoLoadFlag->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_AutoLoadFlag[]"].options = <?php echo JsonEncode($Products_add->AutoLoadFlag->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_ActiveFlag[]"] = <?php echo $Products_add->ActiveFlag->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Products_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_GradeType_Idn"] = <?php echo $Products_add->GradeType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_GradeType_Idn"].options = <?php echo JsonEncode($Products_add->GradeType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_PressureType_Idn"] = <?php echo $Products_add->PressureType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_PressureType_Idn"].options = <?php echo JsonEncode($Products_add->PressureType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_SeamlessFlag[]"] = <?php echo $Products_add->SeamlessFlag->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_SeamlessFlag[]"].options = <?php echo JsonEncode($Products_add->SeamlessFlag->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_ResponseType"] = <?php echo $Products_add->ResponseType->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_ResponseType"].options = <?php echo JsonEncode($Products_add->ResponseType->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_FMJobFlag[]"] = <?php echo $Products_add->FMJobFlag->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_FMJobFlag[]"].options = <?php echo JsonEncode($Products_add->FMJobFlag->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_CoverageType_Idn"] = <?php echo $Products_add->CoverageType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_CoverageType_Idn"].options = <?php echo JsonEncode($Products_add->CoverageType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_HeadType_Idn"] = <?php echo $Products_add->HeadType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_HeadType_Idn"].options = <?php echo JsonEncode($Products_add->HeadType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_FinishType_Idn"] = <?php echo $Products_add->FinishType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_FinishType_Idn"].options = <?php echo JsonEncode($Products_add->FinishType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_Outlet_Idn"] = <?php echo $Products_add->Outlet_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_Outlet_Idn"].options = <?php echo JsonEncode($Products_add->Outlet_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_RiserType_Idn"] = <?php echo $Products_add->RiserType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_RiserType_Idn"].options = <?php echo JsonEncode($Products_add->RiserType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_BackFlowType_Idn"] = <?php echo $Products_add->BackFlowType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_BackFlowType_Idn"].options = <?php echo JsonEncode($Products_add->BackFlowType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_ControlValve_Idn"] = <?php echo $Products_add->ControlValve_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_ControlValve_Idn"].options = <?php echo JsonEncode($Products_add->ControlValve_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_CheckValve_Idn"] = <?php echo $Products_add->CheckValve_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_CheckValve_Idn"].options = <?php echo JsonEncode($Products_add->CheckValve_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_FDCType_Idn"] = <?php echo $Products_add->FDCType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_FDCType_Idn"].options = <?php echo JsonEncode($Products_add->FDCType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_BellType_Idn"] = <?php echo $Products_add->BellType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_BellType_Idn"].options = <?php echo JsonEncode($Products_add->BellType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_TappingTee_Idn"] = <?php echo $Products_add->TappingTee_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_TappingTee_Idn"].options = <?php echo JsonEncode($Products_add->TappingTee_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_UndergroundValve_Idn"] = <?php echo $Products_add->UndergroundValve_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_UndergroundValve_Idn"].options = <?php echo JsonEncode($Products_add->UndergroundValve_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_LiftDuration_Idn"] = <?php echo $Products_add->LiftDuration_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_LiftDuration_Idn"].options = <?php echo JsonEncode($Products_add->LiftDuration_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_TrimPackageFlag[]"] = <?php echo $Products_add->TrimPackageFlag->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_TrimPackageFlag[]"].options = <?php echo JsonEncode($Products_add->TrimPackageFlag->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_ListedFlag[]"] = <?php echo $Products_add->ListedFlag->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_ListedFlag[]"].options = <?php echo JsonEncode($Products_add->ListedFlag->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_IsFirePump[]"] = <?php echo $Products_add->IsFirePump->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_IsFirePump[]"].options = <?php echo JsonEncode($Products_add->IsFirePump->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_FirePumpType_Idn"] = <?php echo $Products_add->FirePumpType_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_FirePumpType_Idn"].options = <?php echo JsonEncode($Products_add->FirePumpType_Idn->lookupOptions()) ?>;
	fProductsadd.lists["x_IsDieselFuel[]"] = <?php echo $Products_add->IsDieselFuel->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_IsDieselFuel[]"].options = <?php echo JsonEncode($Products_add->IsDieselFuel->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_IsSolution[]"] = <?php echo $Products_add->IsSolution->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_IsSolution[]"].options = <?php echo JsonEncode($Products_add->IsSolution->options(FALSE, TRUE)) ?>;
	fProductsadd.lists["x_Position_Idn"] = <?php echo $Products_add->Position_Idn->Lookup->toClientList($Products_add) ?>;
	fProductsadd.lists["x_Position_Idn"].options = <?php echo JsonEncode($Products_add->Position_Idn->lookupOptions()) ?>;
	loadjs.done("fProductsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Products_add->showPageHeader(); ?>
<?php
$Products_add->showMessage();
?>
<form name="fProductsadd" id="fProductsadd" class="<?php echo $Products_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Products">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$Products_add->IsModal ?>">
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="Products_add"><!-- multi-page tabs -->
	<ul class="<?php echo $Products_add->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $Products_add->MultiPages->pageStyle(1) ?>" href="#tab_Products1" data-toggle="tab"><?php echo $Products->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $Products_add->MultiPages->pageStyle(2) ?>" href="#tab_Products2" data-toggle="tab"><?php echo $Products->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $Products_add->MultiPages->pageStyle(3) ?>" href="#tab_Products3" data-toggle="tab"><?php echo $Products->pageCaption(3) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $Products_add->MultiPages->pageStyle(4) ?>" href="#tab_Products4" data-toggle="tab"><?php echo $Products->pageCaption(4) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $Products_add->MultiPages->pageStyle(1) ?>" id="tab_Products1"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($Products_add->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_Products_Department_Idn" for="x_Department_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->Department_Idn->caption() ?><?php echo $Products_add->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->Department_Idn->cellAttributes() ?>>
<span id="el_Products_Department_Idn">
<?php $Products_add->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Department_Idn" data-page="1" data-value-separator="<?php echo $Products_add->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $Products_add->Department_Idn->editAttributes() ?>>
			<?php echo $Products_add->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $Products_add->Department_Idn->Lookup->getParamTag($Products_add, "p_x_Department_Idn") ?>
</span>
<?php echo $Products_add->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_Products_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->WorksheetMaster_Idn->caption() ?><?php echo $Products_add->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_Products_WorksheetMaster_Idn">
<?php $Products_add->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetMaster_Idn" data-page="1" data-value-separator="<?php echo $Products_add->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $Products_add->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Products_add->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Products_add->WorksheetMaster_Idn->Lookup->getParamTag($Products_add, "p_x_WorksheetMaster_Idn") ?>
</span>
<?php echo $Products_add->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<div id="r_WorksheetCategory_Idn" class="form-group row">
		<label id="elh_Products_WorksheetCategory_Idn" for="x_WorksheetCategory_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->WorksheetCategory_Idn->caption() ?><?php echo $Products_add->WorksheetCategory_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el_Products_WorksheetCategory_Idn">
<?php $Products_add->WorksheetCategory_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetCategory_Idn" data-page="1" data-value-separator="<?php echo $Products_add->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetCategory_Idn" name="x_WorksheetCategory_Idn"<?php echo $Products_add->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Products_add->WorksheetCategory_Idn->selectOptionListHtml("x_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_add->WorksheetCategory_Idn->Lookup->getParamTag($Products_add, "p_x_WorksheetCategory_Idn") ?>
</span>
<?php echo $Products_add->WorksheetCategory_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
	<div id="r_Manufacturer_Idn" class="form-group row">
		<label id="elh_Products_Manufacturer_Idn" for="x_Manufacturer_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->Manufacturer_Idn->caption() ?><?php echo $Products_add->Manufacturer_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->Manufacturer_Idn->cellAttributes() ?>>
<span id="el_Products_Manufacturer_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Manufacturer_Idn" data-page="1" data-value-separator="<?php echo $Products_add->Manufacturer_Idn->displayValueSeparatorAttribute() ?>" id="x_Manufacturer_Idn" name="x_Manufacturer_Idn"<?php echo $Products_add->Manufacturer_Idn->editAttributes() ?>>
			<?php echo $Products_add->Manufacturer_Idn->selectOptionListHtml("x_Manufacturer_Idn") ?>
		</select>
</div>
<?php echo $Products_add->Manufacturer_Idn->Lookup->getParamTag($Products_add, "p_x_Manufacturer_Idn") ?>
</span>
<?php echo $Products_add->Manufacturer_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_Products_Rank" for="x_Rank" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->Rank->caption() ?><?php echo $Products_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->Rank->cellAttributes() ?>>
<span id="el_Products_Rank">
<input type="text" data-table="Products" data-field="x_Rank" data-page="1" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_add->Rank->getPlaceHolder()) ?>" value="<?php echo $Products_add->Rank->EditValue ?>"<?php echo $Products_add->Rank->editAttributes() ?>>
</span>
<?php echo $Products_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_Products_Name" for="x_Name" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->Name->caption() ?><?php echo $Products_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->Name->cellAttributes() ?>>
<span id="el_Products_Name">
<input type="text" data-table="Products" data-field="x_Name" data-page="1" name="x_Name" id="x_Name" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($Products_add->Name->getPlaceHolder()) ?>" value="<?php echo $Products_add->Name->EditValue ?>"<?php echo $Products_add->Name->editAttributes() ?>>
</span>
<?php echo $Products_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->MaterialUnitPrice->Visible) { // MaterialUnitPrice ?>
	<div id="r_MaterialUnitPrice" class="form-group row">
		<label id="elh_Products_MaterialUnitPrice" for="x_MaterialUnitPrice" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->MaterialUnitPrice->caption() ?><?php echo $Products_add->MaterialUnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->MaterialUnitPrice->cellAttributes() ?>>
<span id="el_Products_MaterialUnitPrice">
<input type="text" data-table="Products" data-field="x_MaterialUnitPrice" data-page="1" name="x_MaterialUnitPrice" id="x_MaterialUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_add->MaterialUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_add->MaterialUnitPrice->EditValue ?>"<?php echo $Products_add->MaterialUnitPrice->editAttributes() ?>>
</span>
<?php echo $Products_add->MaterialUnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
	<div id="r_FieldUnitPrice" class="form-group row">
		<label id="elh_Products_FieldUnitPrice" for="x_FieldUnitPrice" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->FieldUnitPrice->caption() ?><?php echo $Products_add->FieldUnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->FieldUnitPrice->cellAttributes() ?>>
<span id="el_Products_FieldUnitPrice">
<input type="text" data-table="Products" data-field="x_FieldUnitPrice" data-page="1" name="x_FieldUnitPrice" id="x_FieldUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_add->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_add->FieldUnitPrice->EditValue ?>"<?php echo $Products_add->FieldUnitPrice->editAttributes() ?>>
</span>
<?php echo $Products_add->FieldUnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->ShopUnitPrice->Visible) { // ShopUnitPrice ?>
	<div id="r_ShopUnitPrice" class="form-group row">
		<label id="elh_Products_ShopUnitPrice" for="x_ShopUnitPrice" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->ShopUnitPrice->caption() ?><?php echo $Products_add->ShopUnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->ShopUnitPrice->cellAttributes() ?>>
<span id="el_Products_ShopUnitPrice">
<input type="text" data-table="Products" data-field="x_ShopUnitPrice" data-page="1" name="x_ShopUnitPrice" id="x_ShopUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_add->ShopUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_add->ShopUnitPrice->EditValue ?>"<?php echo $Products_add->ShopUnitPrice->editAttributes() ?>>
</span>
<?php echo $Products_add->ShopUnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->EngineerUnitPrice->Visible) { // EngineerUnitPrice ?>
	<div id="r_EngineerUnitPrice" class="form-group row">
		<label id="elh_Products_EngineerUnitPrice" for="x_EngineerUnitPrice" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->EngineerUnitPrice->caption() ?><?php echo $Products_add->EngineerUnitPrice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->EngineerUnitPrice->cellAttributes() ?>>
<span id="el_Products_EngineerUnitPrice">
<input type="text" data-table="Products" data-field="x_EngineerUnitPrice" data-page="1" name="x_EngineerUnitPrice" id="x_EngineerUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_add->EngineerUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_add->EngineerUnitPrice->EditValue ?>"<?php echo $Products_add->EngineerUnitPrice->editAttributes() ?>>
</span>
<?php echo $Products_add->EngineerUnitPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->DefaultQuantity->Visible) { // DefaultQuantity ?>
	<div id="r_DefaultQuantity" class="form-group row">
		<label id="elh_Products_DefaultQuantity" for="x_DefaultQuantity" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->DefaultQuantity->caption() ?><?php echo $Products_add->DefaultQuantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->DefaultQuantity->cellAttributes() ?>>
<span id="el_Products_DefaultQuantity">
<input type="text" data-table="Products" data-field="x_DefaultQuantity" data-page="1" name="x_DefaultQuantity" id="x_DefaultQuantity" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_add->DefaultQuantity->getPlaceHolder()) ?>" value="<?php echo $Products_add->DefaultQuantity->EditValue ?>"<?php echo $Products_add->DefaultQuantity->editAttributes() ?>>
</span>
<?php echo $Products_add->DefaultQuantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
	<div id="r_ProductSize_Idn" class="form-group row">
		<label id="elh_Products_ProductSize_Idn" for="x_ProductSize_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->ProductSize_Idn->caption() ?><?php echo $Products_add->ProductSize_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->ProductSize_Idn->cellAttributes() ?>>
<span id="el_Products_ProductSize_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ProductSize_Idn" data-page="1" data-value-separator="<?php echo $Products_add->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x_ProductSize_Idn" name="x_ProductSize_Idn"<?php echo $Products_add->ProductSize_Idn->editAttributes() ?>>
			<?php echo $Products_add->ProductSize_Idn->selectOptionListHtml("x_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $Products_add->ProductSize_Idn->Lookup->getParamTag($Products_add, "p_x_ProductSize_Idn") ?>
</span>
<?php echo $Products_add->ProductSize_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_Products_Description" for="x_Description" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->Description->caption() ?><?php echo $Products_add->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->Description->cellAttributes() ?>>
<span id="el_Products_Description">
<textarea data-table="Products" data-field="x_Description" data-page="1" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($Products_add->Description->getPlaceHolder()) ?>"<?php echo $Products_add->Description->editAttributes() ?>><?php echo $Products_add->Description->EditValue ?></textarea>
</span>
<?php echo $Products_add->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->PipeType_Idn->Visible) { // PipeType_Idn ?>
	<div id="r_PipeType_Idn" class="form-group row">
		<label id="elh_Products_PipeType_Idn" for="x_PipeType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->PipeType_Idn->caption() ?><?php echo $Products_add->PipeType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->PipeType_Idn->cellAttributes() ?>>
<span id="el_Products_PipeType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PipeType_Idn" data-page="1" data-value-separator="<?php echo $Products_add->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x_PipeType_Idn" name="x_PipeType_Idn"<?php echo $Products_add->PipeType_Idn->editAttributes() ?>>
			<?php echo $Products_add->PipeType_Idn->selectOptionListHtml("x_PipeType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->PipeType_Idn->Lookup->getParamTag($Products_add, "p_x_PipeType_Idn") ?>
</span>
<?php echo $Products_add->PipeType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
	<div id="r_ScheduleType_Idn" class="form-group row">
		<label id="elh_Products_ScheduleType_Idn" for="x_ScheduleType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->ScheduleType_Idn->caption() ?><?php echo $Products_add->ScheduleType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->ScheduleType_Idn->cellAttributes() ?>>
<span id="el_Products_ScheduleType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ScheduleType_Idn" data-page="1" data-value-separator="<?php echo $Products_add->ScheduleType_Idn->displayValueSeparatorAttribute() ?>" id="x_ScheduleType_Idn" name="x_ScheduleType_Idn"<?php echo $Products_add->ScheduleType_Idn->editAttributes() ?>>
			<?php echo $Products_add->ScheduleType_Idn->selectOptionListHtml("x_ScheduleType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->ScheduleType_Idn->Lookup->getParamTag($Products_add, "p_x_ScheduleType_Idn") ?>
</span>
<?php echo $Products_add->ScheduleType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->Fitting_Idn->Visible) { // Fitting_Idn ?>
	<div id="r_Fitting_Idn" class="form-group row">
		<label id="elh_Products_Fitting_Idn" for="x_Fitting_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->Fitting_Idn->caption() ?><?php echo $Products_add->Fitting_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->Fitting_Idn->cellAttributes() ?>>
<span id="el_Products_Fitting_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Fitting_Idn" data-page="1" data-value-separator="<?php echo $Products_add->Fitting_Idn->displayValueSeparatorAttribute() ?>" id="x_Fitting_Idn" name="x_Fitting_Idn"<?php echo $Products_add->Fitting_Idn->editAttributes() ?>>
			<?php echo $Products_add->Fitting_Idn->selectOptionListHtml("x_Fitting_Idn") ?>
		</select>
</div>
<?php echo $Products_add->Fitting_Idn->Lookup->getParamTag($Products_add, "p_x_Fitting_Idn") ?>
</span>
<?php echo $Products_add->Fitting_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
	<div id="r_GroovedFittingType_Idn" class="form-group row">
		<label id="elh_Products_GroovedFittingType_Idn" for="x_GroovedFittingType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->GroovedFittingType_Idn->caption() ?><?php echo $Products_add->GroovedFittingType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->GroovedFittingType_Idn->cellAttributes() ?>>
<span id="el_Products_GroovedFittingType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GroovedFittingType_Idn" data-page="1" data-value-separator="<?php echo $Products_add->GroovedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x_GroovedFittingType_Idn" name="x_GroovedFittingType_Idn"<?php echo $Products_add->GroovedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_add->GroovedFittingType_Idn->selectOptionListHtml("x_GroovedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->GroovedFittingType_Idn->Lookup->getParamTag($Products_add, "p_x_GroovedFittingType_Idn") ?>
</span>
<?php echo $Products_add->GroovedFittingType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
	<div id="r_ThreadedFittingType_Idn" class="form-group row">
		<label id="elh_Products_ThreadedFittingType_Idn" for="x_ThreadedFittingType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->ThreadedFittingType_Idn->caption() ?><?php echo $Products_add->ThreadedFittingType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->ThreadedFittingType_Idn->cellAttributes() ?>>
<span id="el_Products_ThreadedFittingType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ThreadedFittingType_Idn" data-page="1" data-value-separator="<?php echo $Products_add->ThreadedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x_ThreadedFittingType_Idn" name="x_ThreadedFittingType_Idn"<?php echo $Products_add->ThreadedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_add->ThreadedFittingType_Idn->selectOptionListHtml("x_ThreadedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->ThreadedFittingType_Idn->Lookup->getParamTag($Products_add, "p_x_ThreadedFittingType_Idn") ?>
</span>
<?php echo $Products_add->ThreadedFittingType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->HangerType_Idn->Visible) { // HangerType_Idn ?>
	<div id="r_HangerType_Idn" class="form-group row">
		<label id="elh_Products_HangerType_Idn" for="x_HangerType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->HangerType_Idn->caption() ?><?php echo $Products_add->HangerType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->HangerType_Idn->cellAttributes() ?>>
<span id="el_Products_HangerType_Idn">
<?php $Products_add->HangerType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerType_Idn" data-page="1" data-value-separator="<?php echo $Products_add->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x_HangerType_Idn" name="x_HangerType_Idn"<?php echo $Products_add->HangerType_Idn->editAttributes() ?>>
			<?php echo $Products_add->HangerType_Idn->selectOptionListHtml("x_HangerType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->HangerType_Idn->Lookup->getParamTag($Products_add, "p_x_HangerType_Idn") ?>
</span>
<?php echo $Products_add->HangerType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
	<div id="r_HangerSubType_Idn" class="form-group row">
		<label id="elh_Products_HangerSubType_Idn" for="x_HangerSubType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->HangerSubType_Idn->caption() ?><?php echo $Products_add->HangerSubType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->HangerSubType_Idn->cellAttributes() ?>>
<span id="el_Products_HangerSubType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerSubType_Idn" data-page="1" data-value-separator="<?php echo $Products_add->HangerSubType_Idn->displayValueSeparatorAttribute() ?>" id="x_HangerSubType_Idn" name="x_HangerSubType_Idn"<?php echo $Products_add->HangerSubType_Idn->editAttributes() ?>>
			<?php echo $Products_add->HangerSubType_Idn->selectOptionListHtml("x_HangerSubType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->HangerSubType_Idn->Lookup->getParamTag($Products_add, "p_x_HangerSubType_Idn") ?>
</span>
<?php echo $Products_add->HangerSubType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->SubcontractCategory_Idn->Visible) { // SubcontractCategory_Idn ?>
	<div id="r_SubcontractCategory_Idn" class="form-group row">
		<label id="elh_Products_SubcontractCategory_Idn" for="x_SubcontractCategory_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->SubcontractCategory_Idn->caption() ?><?php echo $Products_add->SubcontractCategory_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->SubcontractCategory_Idn->cellAttributes() ?>>
<span id="el_Products_SubcontractCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_SubcontractCategory_Idn" data-page="1" data-value-separator="<?php echo $Products_add->SubcontractCategory_Idn->displayValueSeparatorAttribute() ?>" id="x_SubcontractCategory_Idn" name="x_SubcontractCategory_Idn"<?php echo $Products_add->SubcontractCategory_Idn->editAttributes() ?>>
			<?php echo $Products_add->SubcontractCategory_Idn->selectOptionListHtml("x_SubcontractCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_add->SubcontractCategory_Idn->Lookup->getParamTag($Products_add, "p_x_SubcontractCategory_Idn") ?>
</span>
<?php echo $Products_add->SubcontractCategory_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->ApplyToAdjustmentFactorsFlag->Visible) { // ApplyToAdjustmentFactorsFlag ?>
	<div id="r_ApplyToAdjustmentFactorsFlag" class="form-group row">
		<label id="elh_Products_ApplyToAdjustmentFactorsFlag" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->ApplyToAdjustmentFactorsFlag->caption() ?><?php echo $Products_add->ApplyToAdjustmentFactorsFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->ApplyToAdjustmentFactorsFlag->cellAttributes() ?>>
<span id="el_Products_ApplyToAdjustmentFactorsFlag">
<?php
$selwrk = ConvertToBool($Products_add->ApplyToAdjustmentFactorsFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToAdjustmentFactorsFlag" data-page="1" name="x_ApplyToAdjustmentFactorsFlag[]" id="x_ApplyToAdjustmentFactorsFlag[]_570475" value="1"<?php echo $selwrk ?><?php echo $Products_add->ApplyToAdjustmentFactorsFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ApplyToAdjustmentFactorsFlag[]_570475"></label>
</div>
</span>
<?php echo $Products_add->ApplyToAdjustmentFactorsFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->ApplyToContingencyFlag->Visible) { // ApplyToContingencyFlag ?>
	<div id="r_ApplyToContingencyFlag" class="form-group row">
		<label id="elh_Products_ApplyToContingencyFlag" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->ApplyToContingencyFlag->caption() ?><?php echo $Products_add->ApplyToContingencyFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->ApplyToContingencyFlag->cellAttributes() ?>>
<span id="el_Products_ApplyToContingencyFlag">
<?php
$selwrk = ConvertToBool($Products_add->ApplyToContingencyFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToContingencyFlag" data-page="1" name="x_ApplyToContingencyFlag[]" id="x_ApplyToContingencyFlag[]_759161" value="1"<?php echo $selwrk ?><?php echo $Products_add->ApplyToContingencyFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ApplyToContingencyFlag[]_759161"></label>
</div>
</span>
<?php echo $Products_add->ApplyToContingencyFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->IsMainComponent->Visible) { // IsMainComponent ?>
	<div id="r_IsMainComponent" class="form-group row">
		<label id="elh_Products_IsMainComponent" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->IsMainComponent->caption() ?><?php echo $Products_add->IsMainComponent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->IsMainComponent->cellAttributes() ?>>
<span id="el_Products_IsMainComponent">
<?php
$selwrk = ConvertToBool($Products_add->IsMainComponent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsMainComponent" data-page="1" name="x_IsMainComponent[]" id="x_IsMainComponent[]_766755" value="1"<?php echo $selwrk ?><?php echo $Products_add->IsMainComponent->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsMainComponent[]_766755"></label>
</div>
</span>
<?php echo $Products_add->IsMainComponent->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->DomesticFlag->Visible) { // DomesticFlag ?>
	<div id="r_DomesticFlag" class="form-group row">
		<label id="elh_Products_DomesticFlag" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->DomesticFlag->caption() ?><?php echo $Products_add->DomesticFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->DomesticFlag->cellAttributes() ?>>
<span id="el_Products_DomesticFlag">
<?php
$selwrk = ConvertToBool($Products_add->DomesticFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_DomesticFlag" data-page="1" name="x_DomesticFlag[]" id="x_DomesticFlag[]_909589" value="1"<?php echo $selwrk ?><?php echo $Products_add->DomesticFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_DomesticFlag[]_909589"></label>
</div>
</span>
<?php echo $Products_add->DomesticFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->LoadFlag->Visible) { // LoadFlag ?>
	<div id="r_LoadFlag" class="form-group row">
		<label id="elh_Products_LoadFlag" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->LoadFlag->caption() ?><?php echo $Products_add->LoadFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->LoadFlag->cellAttributes() ?>>
<span id="el_Products_LoadFlag">
<?php
$selwrk = ConvertToBool($Products_add->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_LoadFlag" data-page="1" name="x_LoadFlag[]" id="x_LoadFlag[]_774566" value="1"<?php echo $selwrk ?><?php echo $Products_add->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_LoadFlag[]_774566"></label>
</div>
</span>
<?php echo $Products_add->LoadFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
	<div id="r_AutoLoadFlag" class="form-group row">
		<label id="elh_Products_AutoLoadFlag" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->AutoLoadFlag->caption() ?><?php echo $Products_add->AutoLoadFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->AutoLoadFlag->cellAttributes() ?>>
<span id="el_Products_AutoLoadFlag">
<?php
$selwrk = ConvertToBool($Products_add->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_AutoLoadFlag" data-page="1" name="x_AutoLoadFlag[]" id="x_AutoLoadFlag[]_479704" value="1"<?php echo $selwrk ?><?php echo $Products_add->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_AutoLoadFlag[]_479704"></label>
</div>
</span>
<?php echo $Products_add->AutoLoadFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_Products_ActiveFlag" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->ActiveFlag->caption() ?><?php echo $Products_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->ActiveFlag->cellAttributes() ?>>
<span id="el_Products_ActiveFlag">
<?php
$selwrk = ConvertToBool($Products_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ActiveFlag" data-page="1" name="x_ActiveFlag[]" id="x_ActiveFlag[]_126179" value="1"<?php echo $selwrk ?><?php echo $Products_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_126179"></label>
</div>
</span>
<?php echo $Products_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->ResponseType->Visible) { // ResponseType ?>
	<div id="r_ResponseType" class="form-group row">
		<label id="elh_Products_ResponseType" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->ResponseType->caption() ?><?php echo $Products_add->ResponseType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->ResponseType->cellAttributes() ?>>
<span id="el_Products_ResponseType">
<div id="tp_x_ResponseType" class="ew-template"><input type="radio" class="custom-control-input" data-table="Products" data-field="x_ResponseType" data-page="1" data-value-separator="<?php echo $Products_add->ResponseType->displayValueSeparatorAttribute() ?>" name="x_ResponseType" id="x_ResponseType" value="{value}"<?php echo $Products_add->ResponseType->editAttributes() ?>></div>
<div id="dsl_x_ResponseType" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Products_add->ResponseType->radioButtonListHtml(FALSE, "x_ResponseType", 1) ?>
</div></div>
</span>
<?php echo $Products_add->ResponseType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $Products_add->MultiPages->pageStyle(2) ?>" id="tab_Products2"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($Products_add->GradeType_Idn->Visible) { // GradeType_Idn ?>
	<div id="r_GradeType_Idn" class="form-group row">
		<label id="elh_Products_GradeType_Idn" for="x_GradeType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->GradeType_Idn->caption() ?><?php echo $Products_add->GradeType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->GradeType_Idn->cellAttributes() ?>>
<span id="el_Products_GradeType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GradeType_Idn" data-page="2" data-value-separator="<?php echo $Products_add->GradeType_Idn->displayValueSeparatorAttribute() ?>" id="x_GradeType_Idn" name="x_GradeType_Idn"<?php echo $Products_add->GradeType_Idn->editAttributes() ?>>
			<?php echo $Products_add->GradeType_Idn->selectOptionListHtml("x_GradeType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->GradeType_Idn->Lookup->getParamTag($Products_add, "p_x_GradeType_Idn") ?>
</span>
<?php echo $Products_add->GradeType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->PressureType_Idn->Visible) { // PressureType_Idn ?>
	<div id="r_PressureType_Idn" class="form-group row">
		<label id="elh_Products_PressureType_Idn" for="x_PressureType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->PressureType_Idn->caption() ?><?php echo $Products_add->PressureType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->PressureType_Idn->cellAttributes() ?>>
<span id="el_Products_PressureType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PressureType_Idn" data-page="2" data-value-separator="<?php echo $Products_add->PressureType_Idn->displayValueSeparatorAttribute() ?>" id="x_PressureType_Idn" name="x_PressureType_Idn"<?php echo $Products_add->PressureType_Idn->editAttributes() ?>>
			<?php echo $Products_add->PressureType_Idn->selectOptionListHtml("x_PressureType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->PressureType_Idn->Lookup->getParamTag($Products_add, "p_x_PressureType_Idn") ?>
</span>
<?php echo $Products_add->PressureType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->SeamlessFlag->Visible) { // SeamlessFlag ?>
	<div id="r_SeamlessFlag" class="form-group row">
		<label id="elh_Products_SeamlessFlag" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->SeamlessFlag->caption() ?><?php echo $Products_add->SeamlessFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->SeamlessFlag->cellAttributes() ?>>
<span id="el_Products_SeamlessFlag">
<?php
$selwrk = ConvertToBool($Products_add->SeamlessFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_SeamlessFlag" data-page="2" name="x_SeamlessFlag[]" id="x_SeamlessFlag[]_159588" value="1"<?php echo $selwrk ?><?php echo $Products_add->SeamlessFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_SeamlessFlag[]_159588"></label>
</div>
</span>
<?php echo $Products_add->SeamlessFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->FMJobFlag->Visible) { // FMJobFlag ?>
	<div id="r_FMJobFlag" class="form-group row">
		<label id="elh_Products_FMJobFlag" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->FMJobFlag->caption() ?><?php echo $Products_add->FMJobFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->FMJobFlag->cellAttributes() ?>>
<span id="el_Products_FMJobFlag">
<?php
$selwrk = ConvertToBool($Products_add->FMJobFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_FMJobFlag" data-page="2" name="x_FMJobFlag[]" id="x_FMJobFlag[]_633274" value="1"<?php echo $selwrk ?><?php echo $Products_add->FMJobFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_FMJobFlag[]_633274"></label>
</div>
</span>
<?php echo $Products_add->FMJobFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->RecommendedBoxes->Visible) { // RecommendedBoxes ?>
	<div id="r_RecommendedBoxes" class="form-group row">
		<label id="elh_Products_RecommendedBoxes" for="x_RecommendedBoxes" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->RecommendedBoxes->caption() ?><?php echo $Products_add->RecommendedBoxes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->RecommendedBoxes->cellAttributes() ?>>
<span id="el_Products_RecommendedBoxes">
<input type="text" data-table="Products" data-field="x_RecommendedBoxes" data-page="2" name="x_RecommendedBoxes" id="x_RecommendedBoxes" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_add->RecommendedBoxes->getPlaceHolder()) ?>" value="<?php echo $Products_add->RecommendedBoxes->EditValue ?>"<?php echo $Products_add->RecommendedBoxes->editAttributes() ?>>
</span>
<?php echo $Products_add->RecommendedBoxes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->RecommendedWireFootage->Visible) { // RecommendedWireFootage ?>
	<div id="r_RecommendedWireFootage" class="form-group row">
		<label id="elh_Products_RecommendedWireFootage" for="x_RecommendedWireFootage" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->RecommendedWireFootage->caption() ?><?php echo $Products_add->RecommendedWireFootage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->RecommendedWireFootage->cellAttributes() ?>>
<span id="el_Products_RecommendedWireFootage">
<input type="text" data-table="Products" data-field="x_RecommendedWireFootage" data-page="2" name="x_RecommendedWireFootage" id="x_RecommendedWireFootage" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_add->RecommendedWireFootage->getPlaceHolder()) ?>" value="<?php echo $Products_add->RecommendedWireFootage->EditValue ?>"<?php echo $Products_add->RecommendedWireFootage->editAttributes() ?>>
</span>
<?php echo $Products_add->RecommendedWireFootage->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $Products_add->MultiPages->pageStyle(3) ?>" id="tab_Products3"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($Products_add->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
	<div id="r_CoverageType_Idn" class="form-group row">
		<label id="elh_Products_CoverageType_Idn" for="x_CoverageType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->CoverageType_Idn->caption() ?><?php echo $Products_add->CoverageType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->CoverageType_Idn->cellAttributes() ?>>
<span id="el_Products_CoverageType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CoverageType_Idn" data-page="3" data-value-separator="<?php echo $Products_add->CoverageType_Idn->displayValueSeparatorAttribute() ?>" id="x_CoverageType_Idn" name="x_CoverageType_Idn"<?php echo $Products_add->CoverageType_Idn->editAttributes() ?>>
			<?php echo $Products_add->CoverageType_Idn->selectOptionListHtml("x_CoverageType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->CoverageType_Idn->Lookup->getParamTag($Products_add, "p_x_CoverageType_Idn") ?>
</span>
<?php echo $Products_add->CoverageType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->HeadType_Idn->Visible) { // HeadType_Idn ?>
	<div id="r_HeadType_Idn" class="form-group row">
		<label id="elh_Products_HeadType_Idn" for="x_HeadType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->HeadType_Idn->caption() ?><?php echo $Products_add->HeadType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->HeadType_Idn->cellAttributes() ?>>
<span id="el_Products_HeadType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HeadType_Idn" data-page="3" data-value-separator="<?php echo $Products_add->HeadType_Idn->displayValueSeparatorAttribute() ?>" id="x_HeadType_Idn" name="x_HeadType_Idn"<?php echo $Products_add->HeadType_Idn->editAttributes() ?>>
			<?php echo $Products_add->HeadType_Idn->selectOptionListHtml("x_HeadType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->HeadType_Idn->Lookup->getParamTag($Products_add, "p_x_HeadType_Idn") ?>
</span>
<?php echo $Products_add->HeadType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->FinishType_Idn->Visible) { // FinishType_Idn ?>
	<div id="r_FinishType_Idn" class="form-group row">
		<label id="elh_Products_FinishType_Idn" for="x_FinishType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->FinishType_Idn->caption() ?><?php echo $Products_add->FinishType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->FinishType_Idn->cellAttributes() ?>>
<span id="el_Products_FinishType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FinishType_Idn" data-page="3" data-value-separator="<?php echo $Products_add->FinishType_Idn->displayValueSeparatorAttribute() ?>" id="x_FinishType_Idn" name="x_FinishType_Idn"<?php echo $Products_add->FinishType_Idn->editAttributes() ?>>
			<?php echo $Products_add->FinishType_Idn->selectOptionListHtml("x_FinishType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->FinishType_Idn->Lookup->getParamTag($Products_add, "p_x_FinishType_Idn") ?>
</span>
<?php echo $Products_add->FinishType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->Outlet_Idn->Visible) { // Outlet_Idn ?>
	<div id="r_Outlet_Idn" class="form-group row">
		<label id="elh_Products_Outlet_Idn" for="x_Outlet_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->Outlet_Idn->caption() ?><?php echo $Products_add->Outlet_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->Outlet_Idn->cellAttributes() ?>>
<span id="el_Products_Outlet_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Outlet_Idn" data-page="3" data-value-separator="<?php echo $Products_add->Outlet_Idn->displayValueSeparatorAttribute() ?>" id="x_Outlet_Idn" name="x_Outlet_Idn"<?php echo $Products_add->Outlet_Idn->editAttributes() ?>>
			<?php echo $Products_add->Outlet_Idn->selectOptionListHtml("x_Outlet_Idn") ?>
		</select>
</div>
<?php echo $Products_add->Outlet_Idn->Lookup->getParamTag($Products_add, "p_x_Outlet_Idn") ?>
</span>
<?php echo $Products_add->Outlet_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->RiserType_Idn->Visible) { // RiserType_Idn ?>
	<div id="r_RiserType_Idn" class="form-group row">
		<label id="elh_Products_RiserType_Idn" for="x_RiserType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->RiserType_Idn->caption() ?><?php echo $Products_add->RiserType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->RiserType_Idn->cellAttributes() ?>>
<span id="el_Products_RiserType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_RiserType_Idn" data-page="3" data-value-separator="<?php echo $Products_add->RiserType_Idn->displayValueSeparatorAttribute() ?>" id="x_RiserType_Idn" name="x_RiserType_Idn"<?php echo $Products_add->RiserType_Idn->editAttributes() ?>>
			<?php echo $Products_add->RiserType_Idn->selectOptionListHtml("x_RiserType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->RiserType_Idn->Lookup->getParamTag($Products_add, "p_x_RiserType_Idn") ?>
</span>
<?php echo $Products_add->RiserType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->BackFlowType_Idn->Visible) { // BackFlowType_Idn ?>
	<div id="r_BackFlowType_Idn" class="form-group row">
		<label id="elh_Products_BackFlowType_Idn" for="x_BackFlowType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->BackFlowType_Idn->caption() ?><?php echo $Products_add->BackFlowType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->BackFlowType_Idn->cellAttributes() ?>>
<span id="el_Products_BackFlowType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BackFlowType_Idn" data-page="3" data-value-separator="<?php echo $Products_add->BackFlowType_Idn->displayValueSeparatorAttribute() ?>" id="x_BackFlowType_Idn" name="x_BackFlowType_Idn"<?php echo $Products_add->BackFlowType_Idn->editAttributes() ?>>
			<?php echo $Products_add->BackFlowType_Idn->selectOptionListHtml("x_BackFlowType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->BackFlowType_Idn->Lookup->getParamTag($Products_add, "p_x_BackFlowType_Idn") ?>
</span>
<?php echo $Products_add->BackFlowType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
	<div id="r_ControlValve_Idn" class="form-group row">
		<label id="elh_Products_ControlValve_Idn" for="x_ControlValve_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->ControlValve_Idn->caption() ?><?php echo $Products_add->ControlValve_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->ControlValve_Idn->cellAttributes() ?>>
<span id="el_Products_ControlValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ControlValve_Idn" data-page="3" data-value-separator="<?php echo $Products_add->ControlValve_Idn->displayValueSeparatorAttribute() ?>" id="x_ControlValve_Idn" name="x_ControlValve_Idn"<?php echo $Products_add->ControlValve_Idn->editAttributes() ?>>
			<?php echo $Products_add->ControlValve_Idn->selectOptionListHtml("x_ControlValve_Idn") ?>
		</select>
</div>
<?php echo $Products_add->ControlValve_Idn->Lookup->getParamTag($Products_add, "p_x_ControlValve_Idn") ?>
</span>
<?php echo $Products_add->ControlValve_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
	<div id="r_CheckValve_Idn" class="form-group row">
		<label id="elh_Products_CheckValve_Idn" for="x_CheckValve_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->CheckValve_Idn->caption() ?><?php echo $Products_add->CheckValve_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->CheckValve_Idn->cellAttributes() ?>>
<span id="el_Products_CheckValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CheckValve_Idn" data-page="3" data-value-separator="<?php echo $Products_add->CheckValve_Idn->displayValueSeparatorAttribute() ?>" id="x_CheckValve_Idn" name="x_CheckValve_Idn"<?php echo $Products_add->CheckValve_Idn->editAttributes() ?>>
			<?php echo $Products_add->CheckValve_Idn->selectOptionListHtml("x_CheckValve_Idn") ?>
		</select>
</div>
<?php echo $Products_add->CheckValve_Idn->Lookup->getParamTag($Products_add, "p_x_CheckValve_Idn") ?>
</span>
<?php echo $Products_add->CheckValve_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->FDCType_Idn->Visible) { // FDCType_Idn ?>
	<div id="r_FDCType_Idn" class="form-group row">
		<label id="elh_Products_FDCType_Idn" for="x_FDCType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->FDCType_Idn->caption() ?><?php echo $Products_add->FDCType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->FDCType_Idn->cellAttributes() ?>>
<span id="el_Products_FDCType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FDCType_Idn" data-page="3" data-value-separator="<?php echo $Products_add->FDCType_Idn->displayValueSeparatorAttribute() ?>" id="x_FDCType_Idn" name="x_FDCType_Idn"<?php echo $Products_add->FDCType_Idn->editAttributes() ?>>
			<?php echo $Products_add->FDCType_Idn->selectOptionListHtml("x_FDCType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->FDCType_Idn->Lookup->getParamTag($Products_add, "p_x_FDCType_Idn") ?>
</span>
<?php echo $Products_add->FDCType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->BellType_Idn->Visible) { // BellType_Idn ?>
	<div id="r_BellType_Idn" class="form-group row">
		<label id="elh_Products_BellType_Idn" for="x_BellType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->BellType_Idn->caption() ?><?php echo $Products_add->BellType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->BellType_Idn->cellAttributes() ?>>
<span id="el_Products_BellType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BellType_Idn" data-page="3" data-value-separator="<?php echo $Products_add->BellType_Idn->displayValueSeparatorAttribute() ?>" id="x_BellType_Idn" name="x_BellType_Idn"<?php echo $Products_add->BellType_Idn->editAttributes() ?>>
			<?php echo $Products_add->BellType_Idn->selectOptionListHtml("x_BellType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->BellType_Idn->Lookup->getParamTag($Products_add, "p_x_BellType_Idn") ?>
</span>
<?php echo $Products_add->BellType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
	<div id="r_TappingTee_Idn" class="form-group row">
		<label id="elh_Products_TappingTee_Idn" for="x_TappingTee_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->TappingTee_Idn->caption() ?><?php echo $Products_add->TappingTee_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->TappingTee_Idn->cellAttributes() ?>>
<span id="el_Products_TappingTee_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_TappingTee_Idn" data-page="3" data-value-separator="<?php echo $Products_add->TappingTee_Idn->displayValueSeparatorAttribute() ?>" id="x_TappingTee_Idn" name="x_TappingTee_Idn"<?php echo $Products_add->TappingTee_Idn->editAttributes() ?>>
			<?php echo $Products_add->TappingTee_Idn->selectOptionListHtml("x_TappingTee_Idn") ?>
		</select>
</div>
<?php echo $Products_add->TappingTee_Idn->Lookup->getParamTag($Products_add, "p_x_TappingTee_Idn") ?>
</span>
<?php echo $Products_add->TappingTee_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
	<div id="r_UndergroundValve_Idn" class="form-group row">
		<label id="elh_Products_UndergroundValve_Idn" for="x_UndergroundValve_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->UndergroundValve_Idn->caption() ?><?php echo $Products_add->UndergroundValve_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->UndergroundValve_Idn->cellAttributes() ?>>
<span id="el_Products_UndergroundValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_UndergroundValve_Idn" data-page="3" data-value-separator="<?php echo $Products_add->UndergroundValve_Idn->displayValueSeparatorAttribute() ?>" id="x_UndergroundValve_Idn" name="x_UndergroundValve_Idn"<?php echo $Products_add->UndergroundValve_Idn->editAttributes() ?>>
			<?php echo $Products_add->UndergroundValve_Idn->selectOptionListHtml("x_UndergroundValve_Idn") ?>
		</select>
</div>
<?php echo $Products_add->UndergroundValve_Idn->Lookup->getParamTag($Products_add, "p_x_UndergroundValve_Idn") ?>
</span>
<?php echo $Products_add->UndergroundValve_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
	<div id="r_LiftDuration_Idn" class="form-group row">
		<label id="elh_Products_LiftDuration_Idn" for="x_LiftDuration_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->LiftDuration_Idn->caption() ?><?php echo $Products_add->LiftDuration_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->LiftDuration_Idn->cellAttributes() ?>>
<span id="el_Products_LiftDuration_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_LiftDuration_Idn" data-page="3" data-value-separator="<?php echo $Products_add->LiftDuration_Idn->displayValueSeparatorAttribute() ?>" id="x_LiftDuration_Idn" name="x_LiftDuration_Idn"<?php echo $Products_add->LiftDuration_Idn->editAttributes() ?>>
			<?php echo $Products_add->LiftDuration_Idn->selectOptionListHtml("x_LiftDuration_Idn") ?>
		</select>
</div>
<?php echo $Products_add->LiftDuration_Idn->Lookup->getParamTag($Products_add, "p_x_LiftDuration_Idn") ?>
</span>
<?php echo $Products_add->LiftDuration_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->TrimPackageFlag->Visible) { // TrimPackageFlag ?>
	<div id="r_TrimPackageFlag" class="form-group row">
		<label id="elh_Products_TrimPackageFlag" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->TrimPackageFlag->caption() ?><?php echo $Products_add->TrimPackageFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->TrimPackageFlag->cellAttributes() ?>>
<span id="el_Products_TrimPackageFlag">
<?php
$selwrk = ConvertToBool($Products_add->TrimPackageFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_TrimPackageFlag" data-page="3" name="x_TrimPackageFlag[]" id="x_TrimPackageFlag[]_649285" value="1"<?php echo $selwrk ?><?php echo $Products_add->TrimPackageFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_TrimPackageFlag[]_649285"></label>
</div>
</span>
<?php echo $Products_add->TrimPackageFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->ListedFlag->Visible) { // ListedFlag ?>
	<div id="r_ListedFlag" class="form-group row">
		<label id="elh_Products_ListedFlag" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->ListedFlag->caption() ?><?php echo $Products_add->ListedFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->ListedFlag->cellAttributes() ?>>
<span id="el_Products_ListedFlag">
<?php
$selwrk = ConvertToBool($Products_add->ListedFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ListedFlag" data-page="3" name="x_ListedFlag[]" id="x_ListedFlag[]_650816" value="1"<?php echo $selwrk ?><?php echo $Products_add->ListedFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ListedFlag[]_650816"></label>
</div>
</span>
<?php echo $Products_add->ListedFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->BoxWireLength->Visible) { // BoxWireLength ?>
	<div id="r_BoxWireLength" class="form-group row">
		<label id="elh_Products_BoxWireLength" for="x_BoxWireLength" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->BoxWireLength->caption() ?><?php echo $Products_add->BoxWireLength->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->BoxWireLength->cellAttributes() ?>>
<span id="el_Products_BoxWireLength">
<input type="text" data-table="Products" data-field="x_BoxWireLength" data-page="3" name="x_BoxWireLength" id="x_BoxWireLength" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_add->BoxWireLength->getPlaceHolder()) ?>" value="<?php echo $Products_add->BoxWireLength->EditValue ?>"<?php echo $Products_add->BoxWireLength->editAttributes() ?>>
</span>
<?php echo $Products_add->BoxWireLength->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $Products_add->MultiPages->pageStyle(4) ?>" id="tab_Products4"><!-- multi-page .tab-pane -->
<div class="ew-add-div"><!-- page* -->
<?php if ($Products_add->IsFirePump->Visible) { // IsFirePump ?>
	<div id="r_IsFirePump" class="form-group row">
		<label id="elh_Products_IsFirePump" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->IsFirePump->caption() ?><?php echo $Products_add->IsFirePump->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->IsFirePump->cellAttributes() ?>>
<span id="el_Products_IsFirePump">
<?php
$selwrk = ConvertToBool($Products_add->IsFirePump->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsFirePump" data-page="4" name="x_IsFirePump[]" id="x_IsFirePump[]_250064" value="1"<?php echo $selwrk ?><?php echo $Products_add->IsFirePump->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsFirePump[]_250064"></label>
</div>
</span>
<?php echo $Products_add->IsFirePump->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
	<div id="r_FirePumpType_Idn" class="form-group row">
		<label id="elh_Products_FirePumpType_Idn" for="x_FirePumpType_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->FirePumpType_Idn->caption() ?><?php echo $Products_add->FirePumpType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->FirePumpType_Idn->cellAttributes() ?>>
<span id="el_Products_FirePumpType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FirePumpType_Idn" data-page="4" data-value-separator="<?php echo $Products_add->FirePumpType_Idn->displayValueSeparatorAttribute() ?>" id="x_FirePumpType_Idn" name="x_FirePumpType_Idn"<?php echo $Products_add->FirePumpType_Idn->editAttributes() ?>>
			<?php echo $Products_add->FirePumpType_Idn->selectOptionListHtml("x_FirePumpType_Idn") ?>
		</select>
</div>
<?php echo $Products_add->FirePumpType_Idn->Lookup->getParamTag($Products_add, "p_x_FirePumpType_Idn") ?>
</span>
<?php echo $Products_add->FirePumpType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
	<div id="r_FirePumpAttribute_Idn" class="form-group row">
		<label id="elh_Products_FirePumpAttribute_Idn" for="x_FirePumpAttribute_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->FirePumpAttribute_Idn->caption() ?><?php echo $Products_add->FirePumpAttribute_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->FirePumpAttribute_Idn->cellAttributes() ?>>
<span id="el_Products_FirePumpAttribute_Idn">
<input type="text" data-table="Products" data-field="x_FirePumpAttribute_Idn" data-page="4" name="x_FirePumpAttribute_Idn" id="x_FirePumpAttribute_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_add->FirePumpAttribute_Idn->getPlaceHolder()) ?>" value="<?php echo $Products_add->FirePumpAttribute_Idn->EditValue ?>"<?php echo $Products_add->FirePumpAttribute_Idn->editAttributes() ?>>
</span>
<?php echo $Products_add->FirePumpAttribute_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->IsDieselFuel->Visible) { // IsDieselFuel ?>
	<div id="r_IsDieselFuel" class="form-group row">
		<label id="elh_Products_IsDieselFuel" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->IsDieselFuel->caption() ?><?php echo $Products_add->IsDieselFuel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->IsDieselFuel->cellAttributes() ?>>
<span id="el_Products_IsDieselFuel">
<?php
$selwrk = ConvertToBool($Products_add->IsDieselFuel->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsDieselFuel" data-page="4" name="x_IsDieselFuel[]" id="x_IsDieselFuel[]_295456" value="1"<?php echo $selwrk ?><?php echo $Products_add->IsDieselFuel->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsDieselFuel[]_295456"></label>
</div>
</span>
<?php echo $Products_add->IsDieselFuel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->IsSolution->Visible) { // IsSolution ?>
	<div id="r_IsSolution" class="form-group row">
		<label id="elh_Products_IsSolution" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->IsSolution->caption() ?><?php echo $Products_add->IsSolution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->IsSolution->cellAttributes() ?>>
<span id="el_Products_IsSolution">
<?php
$selwrk = ConvertToBool($Products_add->IsSolution->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsSolution" data-page="4" name="x_IsSolution[]" id="x_IsSolution[]_939179" value="1"<?php echo $selwrk ?><?php echo $Products_add->IsSolution->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsSolution[]_939179"></label>
</div>
</span>
<?php echo $Products_add->IsSolution->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Products_add->Position_Idn->Visible) { // Position_Idn ?>
	<div id="r_Position_Idn" class="form-group row">
		<label id="elh_Products_Position_Idn" for="x_Position_Idn" class="<?php echo $Products_add->LeftColumnClass ?>"><?php echo $Products_add->Position_Idn->caption() ?><?php echo $Products_add->Position_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Products_add->RightColumnClass ?>"><div <?php echo $Products_add->Position_Idn->cellAttributes() ?>>
<span id="el_Products_Position_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Position_Idn" data-page="4" data-value-separator="<?php echo $Products_add->Position_Idn->displayValueSeparatorAttribute() ?>" id="x_Position_Idn" name="x_Position_Idn"<?php echo $Products_add->Position_Idn->editAttributes() ?>>
			<?php echo $Products_add->Position_Idn->selectOptionListHtml("x_Position_Idn") ?>
		</select>
</div>
<?php echo $Products_add->Position_Idn->Lookup->getParamTag($Products_add, "p_x_Position_Idn") ?>
</span>
<?php echo $Products_add->Position_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<?php if (!$Products_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Products_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Products_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Products_add->showPageFooter();
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
$Products_add->terminate();
?>