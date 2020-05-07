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
$Products_list = new Products_list();

// Run the page
$Products_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Products_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Products_list->isExport()) { ?>
<script>
var fProductslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fProductslist = currentForm = new ew.Form("fProductslist", "list");
	fProductslist.formKeyCountName = '<?php echo $Products_list->FormKeyCountName ?>';

	// Validate form
	fProductslist.validate = function() {
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
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($Products_list->Product_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Product_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->Product_Idn->caption(), $Products_list->Product_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->Department_Idn->caption(), $Products_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->WorksheetMaster_Idn->caption(), $Products_list->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->WorksheetCategory_Idn->caption(), $Products_list->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->Manufacturer_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Manufacturer_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->Manufacturer_Idn->caption(), $Products_list->Manufacturer_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->Rank->caption(), $Products_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_list->Rank->errorMessage()) ?>");
			<?php if ($Products_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->Name->caption(), $Products_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->MaterialUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_MaterialUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->MaterialUnitPrice->caption(), $Products_list->MaterialUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MaterialUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_list->MaterialUnitPrice->errorMessage()) ?>");
			<?php if ($Products_list->FieldUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->FieldUnitPrice->caption(), $Products_list->FieldUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_list->FieldUnitPrice->errorMessage()) ?>");
			<?php if ($Products_list->ShopUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_ShopUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->ShopUnitPrice->caption(), $Products_list->ShopUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ShopUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_list->ShopUnitPrice->errorMessage()) ?>");
			<?php if ($Products_list->EngineerUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_EngineerUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->EngineerUnitPrice->caption(), $Products_list->EngineerUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EngineerUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_list->EngineerUnitPrice->errorMessage()) ?>");
			<?php if ($Products_list->DefaultQuantity->Required) { ?>
				elm = this.getElements("x" + infix + "_DefaultQuantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->DefaultQuantity->caption(), $Products_list->DefaultQuantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DefaultQuantity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_list->DefaultQuantity->errorMessage()) ?>");
			<?php if ($Products_list->ProductSize_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductSize_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->ProductSize_Idn->caption(), $Products_list->ProductSize_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->Description->caption(), $Products_list->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->PipeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PipeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->PipeType_Idn->caption(), $Products_list->PipeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->ScheduleType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ScheduleType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->ScheduleType_Idn->caption(), $Products_list->ScheduleType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->Fitting_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Fitting_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->Fitting_Idn->caption(), $Products_list->Fitting_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->GroovedFittingType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GroovedFittingType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->GroovedFittingType_Idn->caption(), $Products_list->GroovedFittingType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->ThreadedFittingType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ThreadedFittingType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->ThreadedFittingType_Idn->caption(), $Products_list->ThreadedFittingType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->HangerType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->HangerType_Idn->caption(), $Products_list->HangerType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->HangerSubType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerSubType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->HangerSubType_Idn->caption(), $Products_list->HangerSubType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->SubcontractCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SubcontractCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->SubcontractCategory_Idn->caption(), $Products_list->SubcontractCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->ApplyToAdjustmentFactorsFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ApplyToAdjustmentFactorsFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->ApplyToAdjustmentFactorsFlag->caption(), $Products_list->ApplyToAdjustmentFactorsFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->ApplyToContingencyFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ApplyToContingencyFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->ApplyToContingencyFlag->caption(), $Products_list->ApplyToContingencyFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->IsMainComponent->Required) { ?>
				elm = this.getElements("x" + infix + "_IsMainComponent[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->IsMainComponent->caption(), $Products_list->IsMainComponent->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->DomesticFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_DomesticFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->DomesticFlag->caption(), $Products_list->DomesticFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->LoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_LoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->LoadFlag->caption(), $Products_list->LoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->AutoLoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_AutoLoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->AutoLoadFlag->caption(), $Products_list->AutoLoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->ActiveFlag->caption(), $Products_list->ActiveFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->GradeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GradeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->GradeType_Idn->caption(), $Products_list->GradeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->PressureType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PressureType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->PressureType_Idn->caption(), $Products_list->PressureType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->SeamlessFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_SeamlessFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->SeamlessFlag->caption(), $Products_list->SeamlessFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->ResponseType->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponseType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->ResponseType->caption(), $Products_list->ResponseType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->FMJobFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_FMJobFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->FMJobFlag->caption(), $Products_list->FMJobFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->RecommendedBoxes->Required) { ?>
				elm = this.getElements("x" + infix + "_RecommendedBoxes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->RecommendedBoxes->caption(), $Products_list->RecommendedBoxes->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RecommendedBoxes");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_list->RecommendedBoxes->errorMessage()) ?>");
			<?php if ($Products_list->RecommendedWireFootage->Required) { ?>
				elm = this.getElements("x" + infix + "_RecommendedWireFootage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->RecommendedWireFootage->caption(), $Products_list->RecommendedWireFootage->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RecommendedWireFootage");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_list->RecommendedWireFootage->errorMessage()) ?>");
			<?php if ($Products_list->CoverageType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_CoverageType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->CoverageType_Idn->caption(), $Products_list->CoverageType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->HeadType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HeadType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->HeadType_Idn->caption(), $Products_list->HeadType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->FinishType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FinishType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->FinishType_Idn->caption(), $Products_list->FinishType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->Outlet_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Outlet_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->Outlet_Idn->caption(), $Products_list->Outlet_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->RiserType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RiserType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->RiserType_Idn->caption(), $Products_list->RiserType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->BackFlowType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_BackFlowType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->BackFlowType_Idn->caption(), $Products_list->BackFlowType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->ControlValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ControlValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->ControlValve_Idn->caption(), $Products_list->ControlValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->CheckValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_CheckValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->CheckValve_Idn->caption(), $Products_list->CheckValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->FDCType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FDCType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->FDCType_Idn->caption(), $Products_list->FDCType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->BellType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_BellType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->BellType_Idn->caption(), $Products_list->BellType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->TappingTee_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_TappingTee_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->TappingTee_Idn->caption(), $Products_list->TappingTee_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->UndergroundValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_UndergroundValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->UndergroundValve_Idn->caption(), $Products_list->UndergroundValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->LiftDuration_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LiftDuration_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->LiftDuration_Idn->caption(), $Products_list->LiftDuration_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->TrimPackageFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_TrimPackageFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->TrimPackageFlag->caption(), $Products_list->TrimPackageFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->ListedFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ListedFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->ListedFlag->caption(), $Products_list->ListedFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->BoxWireLength->Required) { ?>
				elm = this.getElements("x" + infix + "_BoxWireLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->BoxWireLength->caption(), $Products_list->BoxWireLength->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoxWireLength");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_list->BoxWireLength->errorMessage()) ?>");
			<?php if ($Products_list->IsFirePump->Required) { ?>
				elm = this.getElements("x" + infix + "_IsFirePump[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->IsFirePump->caption(), $Products_list->IsFirePump->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->FirePumpType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FirePumpType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->FirePumpType_Idn->caption(), $Products_list->FirePumpType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->FirePumpAttribute_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FirePumpAttribute_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->FirePumpAttribute_Idn->caption(), $Products_list->FirePumpAttribute_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FirePumpAttribute_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Products_list->FirePumpAttribute_Idn->errorMessage()) ?>");
			<?php if ($Products_list->IsDieselFuel->Required) { ?>
				elm = this.getElements("x" + infix + "_IsDieselFuel[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->IsDieselFuel->caption(), $Products_list->IsDieselFuel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->IsSolution->Required) { ?>
				elm = this.getElements("x" + infix + "_IsSolution[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->IsSolution->caption(), $Products_list->IsSolution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Products_list->Position_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Position_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Products_list->Position_Idn->caption(), $Products_list->Position_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	fProductslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "WorksheetMaster_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "WorksheetCategory_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Manufacturer_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "MaterialUnitPrice", false)) return false;
		if (ew.valueChanged(fobj, infix, "FieldUnitPrice", false)) return false;
		if (ew.valueChanged(fobj, infix, "ShopUnitPrice", false)) return false;
		if (ew.valueChanged(fobj, infix, "EngineerUnitPrice", false)) return false;
		if (ew.valueChanged(fobj, infix, "DefaultQuantity", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProductSize_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Description", false)) return false;
		if (ew.valueChanged(fobj, infix, "PipeType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ScheduleType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Fitting_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "GroovedFittingType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ThreadedFittingType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "HangerType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "HangerSubType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubcontractCategory_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ApplyToAdjustmentFactorsFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ApplyToContingencyFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "IsMainComponent[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "DomesticFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "LoadFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "AutoLoadFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "GradeType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "PressureType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "SeamlessFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ResponseType", false)) return false;
		if (ew.valueChanged(fobj, infix, "FMJobFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "RecommendedBoxes", false)) return false;
		if (ew.valueChanged(fobj, infix, "RecommendedWireFootage", false)) return false;
		if (ew.valueChanged(fobj, infix, "CoverageType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "HeadType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinishType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Outlet_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "RiserType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "BackFlowType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ControlValve_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "CheckValve_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "FDCType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "BellType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "TappingTee_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "UndergroundValve_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "LiftDuration_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "TrimPackageFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ListedFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "BoxWireLength", false)) return false;
		if (ew.valueChanged(fobj, infix, "IsFirePump[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "FirePumpType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "FirePumpAttribute_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "IsDieselFuel[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "IsSolution[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "Position_Idn", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fProductslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fProductslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fProductslist.lists["x_Department_Idn"] = <?php echo $Products_list->Department_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($Products_list->Department_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_WorksheetMaster_Idn"] = <?php echo $Products_list->WorksheetMaster_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($Products_list->WorksheetMaster_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_WorksheetCategory_Idn"] = <?php echo $Products_list->WorksheetCategory_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($Products_list->WorksheetCategory_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_Manufacturer_Idn"] = <?php echo $Products_list->Manufacturer_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_Manufacturer_Idn"].options = <?php echo JsonEncode($Products_list->Manufacturer_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_ProductSize_Idn"] = <?php echo $Products_list->ProductSize_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_ProductSize_Idn"].options = <?php echo JsonEncode($Products_list->ProductSize_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_PipeType_Idn"] = <?php echo $Products_list->PipeType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_PipeType_Idn"].options = <?php echo JsonEncode($Products_list->PipeType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_ScheduleType_Idn"] = <?php echo $Products_list->ScheduleType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_ScheduleType_Idn"].options = <?php echo JsonEncode($Products_list->ScheduleType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_Fitting_Idn"] = <?php echo $Products_list->Fitting_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_Fitting_Idn"].options = <?php echo JsonEncode($Products_list->Fitting_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_GroovedFittingType_Idn"] = <?php echo $Products_list->GroovedFittingType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_GroovedFittingType_Idn"].options = <?php echo JsonEncode($Products_list->GroovedFittingType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_ThreadedFittingType_Idn"] = <?php echo $Products_list->ThreadedFittingType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_ThreadedFittingType_Idn"].options = <?php echo JsonEncode($Products_list->ThreadedFittingType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_HangerType_Idn"] = <?php echo $Products_list->HangerType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_HangerType_Idn"].options = <?php echo JsonEncode($Products_list->HangerType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_HangerSubType_Idn"] = <?php echo $Products_list->HangerSubType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_HangerSubType_Idn"].options = <?php echo JsonEncode($Products_list->HangerSubType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_SubcontractCategory_Idn"] = <?php echo $Products_list->SubcontractCategory_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_SubcontractCategory_Idn"].options = <?php echo JsonEncode($Products_list->SubcontractCategory_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_ApplyToAdjustmentFactorsFlag[]"] = <?php echo $Products_list->ApplyToAdjustmentFactorsFlag->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_ApplyToAdjustmentFactorsFlag[]"].options = <?php echo JsonEncode($Products_list->ApplyToAdjustmentFactorsFlag->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_ApplyToContingencyFlag[]"] = <?php echo $Products_list->ApplyToContingencyFlag->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_ApplyToContingencyFlag[]"].options = <?php echo JsonEncode($Products_list->ApplyToContingencyFlag->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_IsMainComponent[]"] = <?php echo $Products_list->IsMainComponent->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_IsMainComponent[]"].options = <?php echo JsonEncode($Products_list->IsMainComponent->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_DomesticFlag[]"] = <?php echo $Products_list->DomesticFlag->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_DomesticFlag[]"].options = <?php echo JsonEncode($Products_list->DomesticFlag->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_LoadFlag[]"] = <?php echo $Products_list->LoadFlag->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_LoadFlag[]"].options = <?php echo JsonEncode($Products_list->LoadFlag->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_AutoLoadFlag[]"] = <?php echo $Products_list->AutoLoadFlag->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_AutoLoadFlag[]"].options = <?php echo JsonEncode($Products_list->AutoLoadFlag->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_ActiveFlag[]"] = <?php echo $Products_list->ActiveFlag->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Products_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_GradeType_Idn"] = <?php echo $Products_list->GradeType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_GradeType_Idn"].options = <?php echo JsonEncode($Products_list->GradeType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_PressureType_Idn"] = <?php echo $Products_list->PressureType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_PressureType_Idn"].options = <?php echo JsonEncode($Products_list->PressureType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_SeamlessFlag[]"] = <?php echo $Products_list->SeamlessFlag->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_SeamlessFlag[]"].options = <?php echo JsonEncode($Products_list->SeamlessFlag->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_ResponseType"] = <?php echo $Products_list->ResponseType->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_ResponseType"].options = <?php echo JsonEncode($Products_list->ResponseType->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_FMJobFlag[]"] = <?php echo $Products_list->FMJobFlag->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_FMJobFlag[]"].options = <?php echo JsonEncode($Products_list->FMJobFlag->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_CoverageType_Idn"] = <?php echo $Products_list->CoverageType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_CoverageType_Idn"].options = <?php echo JsonEncode($Products_list->CoverageType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_HeadType_Idn"] = <?php echo $Products_list->HeadType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_HeadType_Idn"].options = <?php echo JsonEncode($Products_list->HeadType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_FinishType_Idn"] = <?php echo $Products_list->FinishType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_FinishType_Idn"].options = <?php echo JsonEncode($Products_list->FinishType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_Outlet_Idn"] = <?php echo $Products_list->Outlet_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_Outlet_Idn"].options = <?php echo JsonEncode($Products_list->Outlet_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_RiserType_Idn"] = <?php echo $Products_list->RiserType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_RiserType_Idn"].options = <?php echo JsonEncode($Products_list->RiserType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_BackFlowType_Idn"] = <?php echo $Products_list->BackFlowType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_BackFlowType_Idn"].options = <?php echo JsonEncode($Products_list->BackFlowType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_ControlValve_Idn"] = <?php echo $Products_list->ControlValve_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_ControlValve_Idn"].options = <?php echo JsonEncode($Products_list->ControlValve_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_CheckValve_Idn"] = <?php echo $Products_list->CheckValve_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_CheckValve_Idn"].options = <?php echo JsonEncode($Products_list->CheckValve_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_FDCType_Idn"] = <?php echo $Products_list->FDCType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_FDCType_Idn"].options = <?php echo JsonEncode($Products_list->FDCType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_BellType_Idn"] = <?php echo $Products_list->BellType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_BellType_Idn"].options = <?php echo JsonEncode($Products_list->BellType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_TappingTee_Idn"] = <?php echo $Products_list->TappingTee_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_TappingTee_Idn"].options = <?php echo JsonEncode($Products_list->TappingTee_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_UndergroundValve_Idn"] = <?php echo $Products_list->UndergroundValve_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_UndergroundValve_Idn"].options = <?php echo JsonEncode($Products_list->UndergroundValve_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_LiftDuration_Idn"] = <?php echo $Products_list->LiftDuration_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_LiftDuration_Idn"].options = <?php echo JsonEncode($Products_list->LiftDuration_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_TrimPackageFlag[]"] = <?php echo $Products_list->TrimPackageFlag->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_TrimPackageFlag[]"].options = <?php echo JsonEncode($Products_list->TrimPackageFlag->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_ListedFlag[]"] = <?php echo $Products_list->ListedFlag->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_ListedFlag[]"].options = <?php echo JsonEncode($Products_list->ListedFlag->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_IsFirePump[]"] = <?php echo $Products_list->IsFirePump->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_IsFirePump[]"].options = <?php echo JsonEncode($Products_list->IsFirePump->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_FirePumpType_Idn"] = <?php echo $Products_list->FirePumpType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_FirePumpType_Idn"].options = <?php echo JsonEncode($Products_list->FirePumpType_Idn->lookupOptions()) ?>;
	fProductslist.lists["x_IsDieselFuel[]"] = <?php echo $Products_list->IsDieselFuel->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_IsDieselFuel[]"].options = <?php echo JsonEncode($Products_list->IsDieselFuel->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_IsSolution[]"] = <?php echo $Products_list->IsSolution->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_IsSolution[]"].options = <?php echo JsonEncode($Products_list->IsSolution->options(FALSE, TRUE)) ?>;
	fProductslist.lists["x_Position_Idn"] = <?php echo $Products_list->Position_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslist.lists["x_Position_Idn"].options = <?php echo JsonEncode($Products_list->Position_Idn->lookupOptions()) ?>;
	loadjs.done("fProductslist");
});
var fProductslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fProductslistsrch = currentSearchForm = new ew.Form("fProductslistsrch");

	// Validate function for search
	fProductslistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fProductslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fProductslistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fProductslistsrch.lists["x_Department_Idn"] = <?php echo $Products_list->Department_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslistsrch.lists["x_Department_Idn"].options = <?php echo JsonEncode($Products_list->Department_Idn->lookupOptions()) ?>;
	fProductslistsrch.lists["x_WorksheetMaster_Idn"] = <?php echo $Products_list->WorksheetMaster_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslistsrch.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($Products_list->WorksheetMaster_Idn->lookupOptions()) ?>;
	fProductslistsrch.lists["x_WorksheetCategory_Idn"] = <?php echo $Products_list->WorksheetCategory_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslistsrch.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($Products_list->WorksheetCategory_Idn->lookupOptions()) ?>;
	fProductslistsrch.lists["x_Manufacturer_Idn"] = <?php echo $Products_list->Manufacturer_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslistsrch.lists["x_Manufacturer_Idn"].options = <?php echo JsonEncode($Products_list->Manufacturer_Idn->lookupOptions()) ?>;
	fProductslistsrch.lists["x_ProductSize_Idn"] = <?php echo $Products_list->ProductSize_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslistsrch.lists["x_ProductSize_Idn"].options = <?php echo JsonEncode($Products_list->ProductSize_Idn->lookupOptions()) ?>;
	fProductslistsrch.lists["x_PipeType_Idn"] = <?php echo $Products_list->PipeType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslistsrch.lists["x_PipeType_Idn"].options = <?php echo JsonEncode($Products_list->PipeType_Idn->lookupOptions()) ?>;
	fProductslistsrch.lists["x_ScheduleType_Idn"] = <?php echo $Products_list->ScheduleType_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslistsrch.lists["x_ScheduleType_Idn"].options = <?php echo JsonEncode($Products_list->ScheduleType_Idn->lookupOptions()) ?>;
	fProductslistsrch.lists["x_Fitting_Idn"] = <?php echo $Products_list->Fitting_Idn->Lookup->toClientList($Products_list) ?>;
	fProductslistsrch.lists["x_Fitting_Idn"].options = <?php echo JsonEncode($Products_list->Fitting_Idn->lookupOptions()) ?>;
	fProductslistsrch.lists["x_DomesticFlag[]"] = <?php echo $Products_list->DomesticFlag->Lookup->toClientList($Products_list) ?>;
	fProductslistsrch.lists["x_DomesticFlag[]"].options = <?php echo JsonEncode($Products_list->DomesticFlag->options(FALSE, TRUE)) ?>;

	// Filters
	fProductslistsrch.filterList = <?php echo $Products_list->getFilterList() ?>;
	loadjs.done("fProductslistsrch");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Products_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Products_list->TotalRecords > 0 && $Products_list->ExportOptions->visible()) { ?>
<?php $Products_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Products_list->ImportOptions->visible()) { ?>
<?php $Products_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Products_list->SearchOptions->visible()) { ?>
<?php $Products_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Products_list->FilterOptions->visible()) { ?>
<?php $Products_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Products_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Products_list->isExport() && !$Products->CurrentAction) { ?>
<form name="fProductslistsrch" id="fProductslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fProductslistsrch-search-panel" class="<?php echo $Products_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Products">
	<div class="ew-extended-search">
<?php

// Render search row
$Products->RowType = ROWTYPE_SEARCH;
$Products->resetAttributes();
$Products_list->renderRow();
?>
<?php if ($Products_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php
		$Products_list->SearchColumnCount++;
		if (($Products_list->SearchColumnCount - 1) % $Products_list->SearchFieldsPerRow == 0) {
			$Products_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Products_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Department_Idn" class="ew-cell form-group">
		<label for="x_Department_Idn" class="ew-search-caption ew-label"><?php echo $Products_list->Department_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Department_Idn" id="z_Department_Idn" value="=">
</span>
		<span id="el_Products_Department_Idn" class="ew-search-field">
<?php $Products_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Department_Idn" data-value-separator="<?php echo $Products_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $Products_list->Department_Idn->editAttributes() ?>>
			<?php echo $Products_list->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Department_Idn->Lookup->getParamTag($Products_list, "p_x_Department_Idn") ?>
</span>
	</div>
	<?php if ($Products_list->SearchColumnCount % $Products_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php
		$Products_list->SearchColumnCount++;
		if (($Products_list->SearchColumnCount - 1) % $Products_list->SearchFieldsPerRow == 0) {
			$Products_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Products_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_WorksheetMaster_Idn" class="ew-cell form-group">
		<label for="x_WorksheetMaster_Idn" class="ew-search-caption ew-label"><?php echo $Products_list->WorksheetMaster_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_WorksheetMaster_Idn" id="z_WorksheetMaster_Idn" value="=">
</span>
		<span id="el_Products_WorksheetMaster_Idn" class="ew-search-field">
<?php $Products_list->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $Products_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $Products_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Products_list->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Products_list->WorksheetMaster_Idn->Lookup->getParamTag($Products_list, "p_x_WorksheetMaster_Idn") ?>
</span>
	</div>
	<?php if ($Products_list->SearchColumnCount % $Products_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<?php
		$Products_list->SearchColumnCount++;
		if (($Products_list->SearchColumnCount - 1) % $Products_list->SearchFieldsPerRow == 0) {
			$Products_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Products_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_WorksheetCategory_Idn" class="ew-cell form-group">
		<label for="x_WorksheetCategory_Idn" class="ew-search-caption ew-label"><?php echo $Products_list->WorksheetCategory_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_WorksheetCategory_Idn" id="z_WorksheetCategory_Idn" value="=">
</span>
		<span id="el_Products_WorksheetCategory_Idn" class="ew-search-field">
<?php $Products_list->WorksheetCategory_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $Products_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetCategory_Idn" name="x_WorksheetCategory_Idn"<?php echo $Products_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Products_list->WorksheetCategory_Idn->selectOptionListHtml("x_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_list->WorksheetCategory_Idn->Lookup->getParamTag($Products_list, "p_x_WorksheetCategory_Idn") ?>
</span>
	</div>
	<?php if ($Products_list->SearchColumnCount % $Products_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
	<?php
		$Products_list->SearchColumnCount++;
		if (($Products_list->SearchColumnCount - 1) % $Products_list->SearchFieldsPerRow == 0) {
			$Products_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Products_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Manufacturer_Idn" class="ew-cell form-group">
		<label for="x_Manufacturer_Idn" class="ew-search-caption ew-label"><?php echo $Products_list->Manufacturer_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Manufacturer_Idn" id="z_Manufacturer_Idn" value="=">
</span>
		<span id="el_Products_Manufacturer_Idn" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Manufacturer_Idn" data-value-separator="<?php echo $Products_list->Manufacturer_Idn->displayValueSeparatorAttribute() ?>" id="x_Manufacturer_Idn" name="x_Manufacturer_Idn"<?php echo $Products_list->Manufacturer_Idn->editAttributes() ?>>
			<?php echo $Products_list->Manufacturer_Idn->selectOptionListHtml("x_Manufacturer_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Manufacturer_Idn->Lookup->getParamTag($Products_list, "p_x_Manufacturer_Idn") ?>
</span>
	</div>
	<?php if ($Products_list->SearchColumnCount % $Products_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
	<?php
		$Products_list->SearchColumnCount++;
		if (($Products_list->SearchColumnCount - 1) % $Products_list->SearchFieldsPerRow == 0) {
			$Products_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Products_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ProductSize_Idn" class="ew-cell form-group">
		<label for="x_ProductSize_Idn" class="ew-search-caption ew-label"><?php echo $Products_list->ProductSize_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProductSize_Idn" id="z_ProductSize_Idn" value="=">
</span>
		<span id="el_Products_ProductSize_Idn" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $Products_list->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x_ProductSize_Idn" name="x_ProductSize_Idn"<?php echo $Products_list->ProductSize_Idn->editAttributes() ?>>
			<?php echo $Products_list->ProductSize_Idn->selectOptionListHtml("x_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ProductSize_Idn->Lookup->getParamTag($Products_list, "p_x_ProductSize_Idn") ?>
</span>
	</div>
	<?php if ($Products_list->SearchColumnCount % $Products_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
	<?php
		$Products_list->SearchColumnCount++;
		if (($Products_list->SearchColumnCount - 1) % $Products_list->SearchFieldsPerRow == 0) {
			$Products_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Products_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PipeType_Idn" class="ew-cell form-group">
		<label for="x_PipeType_Idn" class="ew-search-caption ew-label"><?php echo $Products_list->PipeType_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PipeType_Idn" id="z_PipeType_Idn" value="=">
</span>
		<span id="el_Products_PipeType_Idn" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PipeType_Idn" data-value-separator="<?php echo $Products_list->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x_PipeType_Idn" name="x_PipeType_Idn"<?php echo $Products_list->PipeType_Idn->editAttributes() ?>>
			<?php echo $Products_list->PipeType_Idn->selectOptionListHtml("x_PipeType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->PipeType_Idn->Lookup->getParamTag($Products_list, "p_x_PipeType_Idn") ?>
</span>
	</div>
	<?php if ($Products_list->SearchColumnCount % $Products_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
	<?php
		$Products_list->SearchColumnCount++;
		if (($Products_list->SearchColumnCount - 1) % $Products_list->SearchFieldsPerRow == 0) {
			$Products_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Products_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ScheduleType_Idn" class="ew-cell form-group">
		<label for="x_ScheduleType_Idn" class="ew-search-caption ew-label"><?php echo $Products_list->ScheduleType_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ScheduleType_Idn" id="z_ScheduleType_Idn" value="=">
</span>
		<span id="el_Products_ScheduleType_Idn" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ScheduleType_Idn" data-value-separator="<?php echo $Products_list->ScheduleType_Idn->displayValueSeparatorAttribute() ?>" id="x_ScheduleType_Idn" name="x_ScheduleType_Idn"<?php echo $Products_list->ScheduleType_Idn->editAttributes() ?>>
			<?php echo $Products_list->ScheduleType_Idn->selectOptionListHtml("x_ScheduleType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ScheduleType_Idn->Lookup->getParamTag($Products_list, "p_x_ScheduleType_Idn") ?>
</span>
	</div>
	<?php if ($Products_list->SearchColumnCount % $Products_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->Fitting_Idn->Visible) { // Fitting_Idn ?>
	<?php
		$Products_list->SearchColumnCount++;
		if (($Products_list->SearchColumnCount - 1) % $Products_list->SearchFieldsPerRow == 0) {
			$Products_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Products_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Fitting_Idn" class="ew-cell form-group">
		<label for="x_Fitting_Idn" class="ew-search-caption ew-label"><?php echo $Products_list->Fitting_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Fitting_Idn" id="z_Fitting_Idn" value="=">
</span>
		<span id="el_Products_Fitting_Idn" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Fitting_Idn" data-value-separator="<?php echo $Products_list->Fitting_Idn->displayValueSeparatorAttribute() ?>" id="x_Fitting_Idn" name="x_Fitting_Idn"<?php echo $Products_list->Fitting_Idn->editAttributes() ?>>
			<?php echo $Products_list->Fitting_Idn->selectOptionListHtml("x_Fitting_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Fitting_Idn->Lookup->getParamTag($Products_list, "p_x_Fitting_Idn") ?>
</span>
	</div>
	<?php if ($Products_list->SearchColumnCount % $Products_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->DomesticFlag->Visible) { // DomesticFlag ?>
	<?php
		$Products_list->SearchColumnCount++;
		if (($Products_list->SearchColumnCount - 1) % $Products_list->SearchFieldsPerRow == 0) {
			$Products_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Products_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_DomesticFlag" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $Products_list->DomesticFlag->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DomesticFlag" id="z_DomesticFlag" value="=">
</span>
		<span id="el_Products_DomesticFlag" class="ew-search-field">
<?php
$selwrk = ConvertToBool($Products_list->DomesticFlag->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_DomesticFlag" name="x_DomesticFlag[]" id="x_DomesticFlag[]_757672" value="1"<?php echo $selwrk ?><?php echo $Products_list->DomesticFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_DomesticFlag[]_757672"></label>
</div>
</span>
	</div>
	<?php if ($Products_list->SearchColumnCount % $Products_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Products_list->SearchColumnCount % $Products_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Products_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Products_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Products_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Products_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Products_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Products_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Products_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Products_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Products_list->showPageHeader(); ?>
<?php
$Products_list->showMessage();
?>
<?php if ($Products_list->TotalRecords > 0 || $Products->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Products_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Products">
<?php if (!$Products_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Products_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Products_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Products_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fProductslist" id="fProductslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Products">
<div id="gmp_Products" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Products_list->TotalRecords > 0 || $Products_list->isAdd() || $Products_list->isCopy() || $Products_list->isGridEdit()) { ?>
<table id="tbl_Productslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Products->RowType = ROWTYPE_HEADER;

// Render list options
$Products_list->renderListOptions();

// Render list options (header, left)
$Products_list->ListOptions->render("header", "left");
?>
<?php if ($Products_list->Product_Idn->Visible) { // Product_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->Product_Idn) == "") { ?>
		<th data-name="Product_Idn" class="<?php echo $Products_list->Product_Idn->headerCellClass() ?>"><div id="elh_Products_Product_Idn" class="Products_Product_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->Product_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Product_Idn" class="<?php echo $Products_list->Product_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->Product_Idn) ?>', 1);"><div id="elh_Products_Product_Idn" class="Products_Product_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->Product_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->Product_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->Product_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $Products_list->Department_Idn->headerCellClass() ?>"><div id="elh_Products_Department_Idn" class="Products_Department_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $Products_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->Department_Idn) ?>', 1);"><div id="elh_Products_Department_Idn" class="Products_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $Products_list->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_Products_WorksheetMaster_Idn" class="Products_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $Products_list->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->WorksheetMaster_Idn) ?>', 1);"><div id="elh_Products_WorksheetMaster_Idn" class="Products_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->WorksheetCategory_Idn) == "") { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $Products_list->WorksheetCategory_Idn->headerCellClass() ?>"><div id="elh_Products_WorksheetCategory_Idn" class="Products_WorksheetCategory_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->WorksheetCategory_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $Products_list->WorksheetCategory_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->WorksheetCategory_Idn) ?>', 1);"><div id="elh_Products_WorksheetCategory_Idn" class="Products_WorksheetCategory_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->WorksheetCategory_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->WorksheetCategory_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->WorksheetCategory_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->Manufacturer_Idn) == "") { ?>
		<th data-name="Manufacturer_Idn" class="<?php echo $Products_list->Manufacturer_Idn->headerCellClass() ?>"><div id="elh_Products_Manufacturer_Idn" class="Products_Manufacturer_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->Manufacturer_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Manufacturer_Idn" class="<?php echo $Products_list->Manufacturer_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->Manufacturer_Idn) ?>', 1);"><div id="elh_Products_Manufacturer_Idn" class="Products_Manufacturer_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->Manufacturer_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->Manufacturer_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->Manufacturer_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->Rank->Visible) { // Rank ?>
	<?php if ($Products_list->SortUrl($Products_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $Products_list->Rank->headerCellClass() ?>"><div id="elh_Products_Rank" class="Products_Rank"><div class="ew-table-header-caption"><?php echo $Products_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $Products_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->Rank) ?>', 1);"><div id="elh_Products_Rank" class="Products_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->Name->Visible) { // Name ?>
	<?php if ($Products_list->SortUrl($Products_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $Products_list->Name->headerCellClass() ?>"><div id="elh_Products_Name" class="Products_Name"><div class="ew-table-header-caption"><?php echo $Products_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $Products_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->Name) ?>', 1);"><div id="elh_Products_Name" class="Products_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Products_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->MaterialUnitPrice->Visible) { // MaterialUnitPrice ?>
	<?php if ($Products_list->SortUrl($Products_list->MaterialUnitPrice) == "") { ?>
		<th data-name="MaterialUnitPrice" class="<?php echo $Products_list->MaterialUnitPrice->headerCellClass() ?>"><div id="elh_Products_MaterialUnitPrice" class="Products_MaterialUnitPrice"><div class="ew-table-header-caption"><?php echo $Products_list->MaterialUnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaterialUnitPrice" class="<?php echo $Products_list->MaterialUnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->MaterialUnitPrice) ?>', 1);"><div id="elh_Products_MaterialUnitPrice" class="Products_MaterialUnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->MaterialUnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->MaterialUnitPrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->MaterialUnitPrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
	<?php if ($Products_list->SortUrl($Products_list->FieldUnitPrice) == "") { ?>
		<th data-name="FieldUnitPrice" class="<?php echo $Products_list->FieldUnitPrice->headerCellClass() ?>"><div id="elh_Products_FieldUnitPrice" class="Products_FieldUnitPrice"><div class="ew-table-header-caption"><?php echo $Products_list->FieldUnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FieldUnitPrice" class="<?php echo $Products_list->FieldUnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->FieldUnitPrice) ?>', 1);"><div id="elh_Products_FieldUnitPrice" class="Products_FieldUnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->FieldUnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->FieldUnitPrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->FieldUnitPrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ShopUnitPrice->Visible) { // ShopUnitPrice ?>
	<?php if ($Products_list->SortUrl($Products_list->ShopUnitPrice) == "") { ?>
		<th data-name="ShopUnitPrice" class="<?php echo $Products_list->ShopUnitPrice->headerCellClass() ?>"><div id="elh_Products_ShopUnitPrice" class="Products_ShopUnitPrice"><div class="ew-table-header-caption"><?php echo $Products_list->ShopUnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShopUnitPrice" class="<?php echo $Products_list->ShopUnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->ShopUnitPrice) ?>', 1);"><div id="elh_Products_ShopUnitPrice" class="Products_ShopUnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->ShopUnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->ShopUnitPrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->ShopUnitPrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->EngineerUnitPrice->Visible) { // EngineerUnitPrice ?>
	<?php if ($Products_list->SortUrl($Products_list->EngineerUnitPrice) == "") { ?>
		<th data-name="EngineerUnitPrice" class="<?php echo $Products_list->EngineerUnitPrice->headerCellClass() ?>"><div id="elh_Products_EngineerUnitPrice" class="Products_EngineerUnitPrice"><div class="ew-table-header-caption"><?php echo $Products_list->EngineerUnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EngineerUnitPrice" class="<?php echo $Products_list->EngineerUnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->EngineerUnitPrice) ?>', 1);"><div id="elh_Products_EngineerUnitPrice" class="Products_EngineerUnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->EngineerUnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->EngineerUnitPrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->EngineerUnitPrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->DefaultQuantity->Visible) { // DefaultQuantity ?>
	<?php if ($Products_list->SortUrl($Products_list->DefaultQuantity) == "") { ?>
		<th data-name="DefaultQuantity" class="<?php echo $Products_list->DefaultQuantity->headerCellClass() ?>"><div id="elh_Products_DefaultQuantity" class="Products_DefaultQuantity"><div class="ew-table-header-caption"><?php echo $Products_list->DefaultQuantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DefaultQuantity" class="<?php echo $Products_list->DefaultQuantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->DefaultQuantity) ?>', 1);"><div id="elh_Products_DefaultQuantity" class="Products_DefaultQuantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->DefaultQuantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->DefaultQuantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->DefaultQuantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->ProductSize_Idn) == "") { ?>
		<th data-name="ProductSize_Idn" class="<?php echo $Products_list->ProductSize_Idn->headerCellClass() ?>"><div id="elh_Products_ProductSize_Idn" class="Products_ProductSize_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->ProductSize_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductSize_Idn" class="<?php echo $Products_list->ProductSize_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->ProductSize_Idn) ?>', 1);"><div id="elh_Products_ProductSize_Idn" class="Products_ProductSize_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->ProductSize_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->ProductSize_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->ProductSize_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->Description->Visible) { // Description ?>
	<?php if ($Products_list->SortUrl($Products_list->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $Products_list->Description->headerCellClass() ?>"><div id="elh_Products_Description" class="Products_Description"><div class="ew-table-header-caption"><?php echo $Products_list->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $Products_list->Description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->Description) ?>', 1);"><div id="elh_Products_Description" class="Products_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->Description->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Products_list->Description->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->Description->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->PipeType_Idn) == "") { ?>
		<th data-name="PipeType_Idn" class="<?php echo $Products_list->PipeType_Idn->headerCellClass() ?>"><div id="elh_Products_PipeType_Idn" class="Products_PipeType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->PipeType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PipeType_Idn" class="<?php echo $Products_list->PipeType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->PipeType_Idn) ?>', 1);"><div id="elh_Products_PipeType_Idn" class="Products_PipeType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->PipeType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->PipeType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->PipeType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->ScheduleType_Idn) == "") { ?>
		<th data-name="ScheduleType_Idn" class="<?php echo $Products_list->ScheduleType_Idn->headerCellClass() ?>"><div id="elh_Products_ScheduleType_Idn" class="Products_ScheduleType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->ScheduleType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ScheduleType_Idn" class="<?php echo $Products_list->ScheduleType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->ScheduleType_Idn) ?>', 1);"><div id="elh_Products_ScheduleType_Idn" class="Products_ScheduleType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->ScheduleType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->ScheduleType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->ScheduleType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->Fitting_Idn->Visible) { // Fitting_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->Fitting_Idn) == "") { ?>
		<th data-name="Fitting_Idn" class="<?php echo $Products_list->Fitting_Idn->headerCellClass() ?>"><div id="elh_Products_Fitting_Idn" class="Products_Fitting_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->Fitting_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fitting_Idn" class="<?php echo $Products_list->Fitting_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->Fitting_Idn) ?>', 1);"><div id="elh_Products_Fitting_Idn" class="Products_Fitting_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->Fitting_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->Fitting_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->Fitting_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->GroovedFittingType_Idn) == "") { ?>
		<th data-name="GroovedFittingType_Idn" class="<?php echo $Products_list->GroovedFittingType_Idn->headerCellClass() ?>"><div id="elh_Products_GroovedFittingType_Idn" class="Products_GroovedFittingType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->GroovedFittingType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GroovedFittingType_Idn" class="<?php echo $Products_list->GroovedFittingType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->GroovedFittingType_Idn) ?>', 1);"><div id="elh_Products_GroovedFittingType_Idn" class="Products_GroovedFittingType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->GroovedFittingType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->GroovedFittingType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->GroovedFittingType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->ThreadedFittingType_Idn) == "") { ?>
		<th data-name="ThreadedFittingType_Idn" class="<?php echo $Products_list->ThreadedFittingType_Idn->headerCellClass() ?>"><div id="elh_Products_ThreadedFittingType_Idn" class="Products_ThreadedFittingType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->ThreadedFittingType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ThreadedFittingType_Idn" class="<?php echo $Products_list->ThreadedFittingType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->ThreadedFittingType_Idn) ?>', 1);"><div id="elh_Products_ThreadedFittingType_Idn" class="Products_ThreadedFittingType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->ThreadedFittingType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->ThreadedFittingType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->ThreadedFittingType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->HangerType_Idn) == "") { ?>
		<th data-name="HangerType_Idn" class="<?php echo $Products_list->HangerType_Idn->headerCellClass() ?>"><div id="elh_Products_HangerType_Idn" class="Products_HangerType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->HangerType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HangerType_Idn" class="<?php echo $Products_list->HangerType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->HangerType_Idn) ?>', 1);"><div id="elh_Products_HangerType_Idn" class="Products_HangerType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->HangerType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->HangerType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->HangerType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->HangerSubType_Idn) == "") { ?>
		<th data-name="HangerSubType_Idn" class="<?php echo $Products_list->HangerSubType_Idn->headerCellClass() ?>"><div id="elh_Products_HangerSubType_Idn" class="Products_HangerSubType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->HangerSubType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HangerSubType_Idn" class="<?php echo $Products_list->HangerSubType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->HangerSubType_Idn) ?>', 1);"><div id="elh_Products_HangerSubType_Idn" class="Products_HangerSubType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->HangerSubType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->HangerSubType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->HangerSubType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->SubcontractCategory_Idn->Visible) { // SubcontractCategory_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->SubcontractCategory_Idn) == "") { ?>
		<th data-name="SubcontractCategory_Idn" class="<?php echo $Products_list->SubcontractCategory_Idn->headerCellClass() ?>"><div id="elh_Products_SubcontractCategory_Idn" class="Products_SubcontractCategory_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->SubcontractCategory_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubcontractCategory_Idn" class="<?php echo $Products_list->SubcontractCategory_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->SubcontractCategory_Idn) ?>', 1);"><div id="elh_Products_SubcontractCategory_Idn" class="Products_SubcontractCategory_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->SubcontractCategory_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->SubcontractCategory_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->SubcontractCategory_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ApplyToAdjustmentFactorsFlag->Visible) { // ApplyToAdjustmentFactorsFlag ?>
	<?php if ($Products_list->SortUrl($Products_list->ApplyToAdjustmentFactorsFlag) == "") { ?>
		<th data-name="ApplyToAdjustmentFactorsFlag" class="<?php echo $Products_list->ApplyToAdjustmentFactorsFlag->headerCellClass() ?>"><div id="elh_Products_ApplyToAdjustmentFactorsFlag" class="Products_ApplyToAdjustmentFactorsFlag"><div class="ew-table-header-caption"><?php echo $Products_list->ApplyToAdjustmentFactorsFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ApplyToAdjustmentFactorsFlag" class="<?php echo $Products_list->ApplyToAdjustmentFactorsFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->ApplyToAdjustmentFactorsFlag) ?>', 1);"><div id="elh_Products_ApplyToAdjustmentFactorsFlag" class="Products_ApplyToAdjustmentFactorsFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->ApplyToAdjustmentFactorsFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->ApplyToAdjustmentFactorsFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->ApplyToAdjustmentFactorsFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ApplyToContingencyFlag->Visible) { // ApplyToContingencyFlag ?>
	<?php if ($Products_list->SortUrl($Products_list->ApplyToContingencyFlag) == "") { ?>
		<th data-name="ApplyToContingencyFlag" class="<?php echo $Products_list->ApplyToContingencyFlag->headerCellClass() ?>"><div id="elh_Products_ApplyToContingencyFlag" class="Products_ApplyToContingencyFlag"><div class="ew-table-header-caption"><?php echo $Products_list->ApplyToContingencyFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ApplyToContingencyFlag" class="<?php echo $Products_list->ApplyToContingencyFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->ApplyToContingencyFlag) ?>', 1);"><div id="elh_Products_ApplyToContingencyFlag" class="Products_ApplyToContingencyFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->ApplyToContingencyFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->ApplyToContingencyFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->ApplyToContingencyFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->IsMainComponent->Visible) { // IsMainComponent ?>
	<?php if ($Products_list->SortUrl($Products_list->IsMainComponent) == "") { ?>
		<th data-name="IsMainComponent" class="<?php echo $Products_list->IsMainComponent->headerCellClass() ?>"><div id="elh_Products_IsMainComponent" class="Products_IsMainComponent"><div class="ew-table-header-caption"><?php echo $Products_list->IsMainComponent->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsMainComponent" class="<?php echo $Products_list->IsMainComponent->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->IsMainComponent) ?>', 1);"><div id="elh_Products_IsMainComponent" class="Products_IsMainComponent">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->IsMainComponent->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->IsMainComponent->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->IsMainComponent->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->DomesticFlag->Visible) { // DomesticFlag ?>
	<?php if ($Products_list->SortUrl($Products_list->DomesticFlag) == "") { ?>
		<th data-name="DomesticFlag" class="<?php echo $Products_list->DomesticFlag->headerCellClass() ?>"><div id="elh_Products_DomesticFlag" class="Products_DomesticFlag"><div class="ew-table-header-caption"><?php echo $Products_list->DomesticFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DomesticFlag" class="<?php echo $Products_list->DomesticFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->DomesticFlag) ?>', 1);"><div id="elh_Products_DomesticFlag" class="Products_DomesticFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->DomesticFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->DomesticFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->DomesticFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->LoadFlag->Visible) { // LoadFlag ?>
	<?php if ($Products_list->SortUrl($Products_list->LoadFlag) == "") { ?>
		<th data-name="LoadFlag" class="<?php echo $Products_list->LoadFlag->headerCellClass() ?>"><div id="elh_Products_LoadFlag" class="Products_LoadFlag"><div class="ew-table-header-caption"><?php echo $Products_list->LoadFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LoadFlag" class="<?php echo $Products_list->LoadFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->LoadFlag) ?>', 1);"><div id="elh_Products_LoadFlag" class="Products_LoadFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->LoadFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->LoadFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->LoadFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
	<?php if ($Products_list->SortUrl($Products_list->AutoLoadFlag) == "") { ?>
		<th data-name="AutoLoadFlag" class="<?php echo $Products_list->AutoLoadFlag->headerCellClass() ?>"><div id="elh_Products_AutoLoadFlag" class="Products_AutoLoadFlag"><div class="ew-table-header-caption"><?php echo $Products_list->AutoLoadFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AutoLoadFlag" class="<?php echo $Products_list->AutoLoadFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->AutoLoadFlag) ?>', 1);"><div id="elh_Products_AutoLoadFlag" class="Products_AutoLoadFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->AutoLoadFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->AutoLoadFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->AutoLoadFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($Products_list->SortUrl($Products_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $Products_list->ActiveFlag->headerCellClass() ?>"><div id="elh_Products_ActiveFlag" class="Products_ActiveFlag"><div class="ew-table-header-caption"><?php echo $Products_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $Products_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->ActiveFlag) ?>', 1);"><div id="elh_Products_ActiveFlag" class="Products_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->GradeType_Idn->Visible) { // GradeType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->GradeType_Idn) == "") { ?>
		<th data-name="GradeType_Idn" class="<?php echo $Products_list->GradeType_Idn->headerCellClass() ?>"><div id="elh_Products_GradeType_Idn" class="Products_GradeType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->GradeType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GradeType_Idn" class="<?php echo $Products_list->GradeType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->GradeType_Idn) ?>', 1);"><div id="elh_Products_GradeType_Idn" class="Products_GradeType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->GradeType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->GradeType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->GradeType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->PressureType_Idn->Visible) { // PressureType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->PressureType_Idn) == "") { ?>
		<th data-name="PressureType_Idn" class="<?php echo $Products_list->PressureType_Idn->headerCellClass() ?>"><div id="elh_Products_PressureType_Idn" class="Products_PressureType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->PressureType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PressureType_Idn" class="<?php echo $Products_list->PressureType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->PressureType_Idn) ?>', 1);"><div id="elh_Products_PressureType_Idn" class="Products_PressureType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->PressureType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->PressureType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->PressureType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->SeamlessFlag->Visible) { // SeamlessFlag ?>
	<?php if ($Products_list->SortUrl($Products_list->SeamlessFlag) == "") { ?>
		<th data-name="SeamlessFlag" class="<?php echo $Products_list->SeamlessFlag->headerCellClass() ?>"><div id="elh_Products_SeamlessFlag" class="Products_SeamlessFlag"><div class="ew-table-header-caption"><?php echo $Products_list->SeamlessFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SeamlessFlag" class="<?php echo $Products_list->SeamlessFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->SeamlessFlag) ?>', 1);"><div id="elh_Products_SeamlessFlag" class="Products_SeamlessFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->SeamlessFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->SeamlessFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->SeamlessFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ResponseType->Visible) { // ResponseType ?>
	<?php if ($Products_list->SortUrl($Products_list->ResponseType) == "") { ?>
		<th data-name="ResponseType" class="<?php echo $Products_list->ResponseType->headerCellClass() ?>"><div id="elh_Products_ResponseType" class="Products_ResponseType"><div class="ew-table-header-caption"><?php echo $Products_list->ResponseType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResponseType" class="<?php echo $Products_list->ResponseType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->ResponseType) ?>', 1);"><div id="elh_Products_ResponseType" class="Products_ResponseType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->ResponseType->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->ResponseType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->ResponseType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->FMJobFlag->Visible) { // FMJobFlag ?>
	<?php if ($Products_list->SortUrl($Products_list->FMJobFlag) == "") { ?>
		<th data-name="FMJobFlag" class="<?php echo $Products_list->FMJobFlag->headerCellClass() ?>"><div id="elh_Products_FMJobFlag" class="Products_FMJobFlag"><div class="ew-table-header-caption"><?php echo $Products_list->FMJobFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FMJobFlag" class="<?php echo $Products_list->FMJobFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->FMJobFlag) ?>', 1);"><div id="elh_Products_FMJobFlag" class="Products_FMJobFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->FMJobFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->FMJobFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->FMJobFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->RecommendedBoxes->Visible) { // RecommendedBoxes ?>
	<?php if ($Products_list->SortUrl($Products_list->RecommendedBoxes) == "") { ?>
		<th data-name="RecommendedBoxes" class="<?php echo $Products_list->RecommendedBoxes->headerCellClass() ?>"><div id="elh_Products_RecommendedBoxes" class="Products_RecommendedBoxes"><div class="ew-table-header-caption"><?php echo $Products_list->RecommendedBoxes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RecommendedBoxes" class="<?php echo $Products_list->RecommendedBoxes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->RecommendedBoxes) ?>', 1);"><div id="elh_Products_RecommendedBoxes" class="Products_RecommendedBoxes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->RecommendedBoxes->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->RecommendedBoxes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->RecommendedBoxes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->RecommendedWireFootage->Visible) { // RecommendedWireFootage ?>
	<?php if ($Products_list->SortUrl($Products_list->RecommendedWireFootage) == "") { ?>
		<th data-name="RecommendedWireFootage" class="<?php echo $Products_list->RecommendedWireFootage->headerCellClass() ?>"><div id="elh_Products_RecommendedWireFootage" class="Products_RecommendedWireFootage"><div class="ew-table-header-caption"><?php echo $Products_list->RecommendedWireFootage->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RecommendedWireFootage" class="<?php echo $Products_list->RecommendedWireFootage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->RecommendedWireFootage) ?>', 1);"><div id="elh_Products_RecommendedWireFootage" class="Products_RecommendedWireFootage">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->RecommendedWireFootage->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->RecommendedWireFootage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->RecommendedWireFootage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->CoverageType_Idn) == "") { ?>
		<th data-name="CoverageType_Idn" class="<?php echo $Products_list->CoverageType_Idn->headerCellClass() ?>"><div id="elh_Products_CoverageType_Idn" class="Products_CoverageType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->CoverageType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CoverageType_Idn" class="<?php echo $Products_list->CoverageType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->CoverageType_Idn) ?>', 1);"><div id="elh_Products_CoverageType_Idn" class="Products_CoverageType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->CoverageType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->CoverageType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->CoverageType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->HeadType_Idn->Visible) { // HeadType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->HeadType_Idn) == "") { ?>
		<th data-name="HeadType_Idn" class="<?php echo $Products_list->HeadType_Idn->headerCellClass() ?>"><div id="elh_Products_HeadType_Idn" class="Products_HeadType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->HeadType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HeadType_Idn" class="<?php echo $Products_list->HeadType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->HeadType_Idn) ?>', 1);"><div id="elh_Products_HeadType_Idn" class="Products_HeadType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->HeadType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->HeadType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->HeadType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->FinishType_Idn->Visible) { // FinishType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->FinishType_Idn) == "") { ?>
		<th data-name="FinishType_Idn" class="<?php echo $Products_list->FinishType_Idn->headerCellClass() ?>"><div id="elh_Products_FinishType_Idn" class="Products_FinishType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->FinishType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinishType_Idn" class="<?php echo $Products_list->FinishType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->FinishType_Idn) ?>', 1);"><div id="elh_Products_FinishType_Idn" class="Products_FinishType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->FinishType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->FinishType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->FinishType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->Outlet_Idn->Visible) { // Outlet_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->Outlet_Idn) == "") { ?>
		<th data-name="Outlet_Idn" class="<?php echo $Products_list->Outlet_Idn->headerCellClass() ?>"><div id="elh_Products_Outlet_Idn" class="Products_Outlet_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->Outlet_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Outlet_Idn" class="<?php echo $Products_list->Outlet_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->Outlet_Idn) ?>', 1);"><div id="elh_Products_Outlet_Idn" class="Products_Outlet_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->Outlet_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->Outlet_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->Outlet_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->RiserType_Idn->Visible) { // RiserType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->RiserType_Idn) == "") { ?>
		<th data-name="RiserType_Idn" class="<?php echo $Products_list->RiserType_Idn->headerCellClass() ?>"><div id="elh_Products_RiserType_Idn" class="Products_RiserType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->RiserType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RiserType_Idn" class="<?php echo $Products_list->RiserType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->RiserType_Idn) ?>', 1);"><div id="elh_Products_RiserType_Idn" class="Products_RiserType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->RiserType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->RiserType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->RiserType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->BackFlowType_Idn->Visible) { // BackFlowType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->BackFlowType_Idn) == "") { ?>
		<th data-name="BackFlowType_Idn" class="<?php echo $Products_list->BackFlowType_Idn->headerCellClass() ?>"><div id="elh_Products_BackFlowType_Idn" class="Products_BackFlowType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->BackFlowType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BackFlowType_Idn" class="<?php echo $Products_list->BackFlowType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->BackFlowType_Idn) ?>', 1);"><div id="elh_Products_BackFlowType_Idn" class="Products_BackFlowType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->BackFlowType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->BackFlowType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->BackFlowType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->ControlValve_Idn) == "") { ?>
		<th data-name="ControlValve_Idn" class="<?php echo $Products_list->ControlValve_Idn->headerCellClass() ?>"><div id="elh_Products_ControlValve_Idn" class="Products_ControlValve_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->ControlValve_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ControlValve_Idn" class="<?php echo $Products_list->ControlValve_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->ControlValve_Idn) ?>', 1);"><div id="elh_Products_ControlValve_Idn" class="Products_ControlValve_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->ControlValve_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->ControlValve_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->ControlValve_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->CheckValve_Idn) == "") { ?>
		<th data-name="CheckValve_Idn" class="<?php echo $Products_list->CheckValve_Idn->headerCellClass() ?>"><div id="elh_Products_CheckValve_Idn" class="Products_CheckValve_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->CheckValve_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CheckValve_Idn" class="<?php echo $Products_list->CheckValve_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->CheckValve_Idn) ?>', 1);"><div id="elh_Products_CheckValve_Idn" class="Products_CheckValve_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->CheckValve_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->CheckValve_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->CheckValve_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->FDCType_Idn->Visible) { // FDCType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->FDCType_Idn) == "") { ?>
		<th data-name="FDCType_Idn" class="<?php echo $Products_list->FDCType_Idn->headerCellClass() ?>"><div id="elh_Products_FDCType_Idn" class="Products_FDCType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->FDCType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FDCType_Idn" class="<?php echo $Products_list->FDCType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->FDCType_Idn) ?>', 1);"><div id="elh_Products_FDCType_Idn" class="Products_FDCType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->FDCType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->FDCType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->FDCType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->BellType_Idn->Visible) { // BellType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->BellType_Idn) == "") { ?>
		<th data-name="BellType_Idn" class="<?php echo $Products_list->BellType_Idn->headerCellClass() ?>"><div id="elh_Products_BellType_Idn" class="Products_BellType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->BellType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BellType_Idn" class="<?php echo $Products_list->BellType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->BellType_Idn) ?>', 1);"><div id="elh_Products_BellType_Idn" class="Products_BellType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->BellType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->BellType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->BellType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->TappingTee_Idn) == "") { ?>
		<th data-name="TappingTee_Idn" class="<?php echo $Products_list->TappingTee_Idn->headerCellClass() ?>"><div id="elh_Products_TappingTee_Idn" class="Products_TappingTee_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->TappingTee_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TappingTee_Idn" class="<?php echo $Products_list->TappingTee_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->TappingTee_Idn) ?>', 1);"><div id="elh_Products_TappingTee_Idn" class="Products_TappingTee_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->TappingTee_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->TappingTee_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->TappingTee_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->UndergroundValve_Idn) == "") { ?>
		<th data-name="UndergroundValve_Idn" class="<?php echo $Products_list->UndergroundValve_Idn->headerCellClass() ?>"><div id="elh_Products_UndergroundValve_Idn" class="Products_UndergroundValve_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->UndergroundValve_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UndergroundValve_Idn" class="<?php echo $Products_list->UndergroundValve_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->UndergroundValve_Idn) ?>', 1);"><div id="elh_Products_UndergroundValve_Idn" class="Products_UndergroundValve_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->UndergroundValve_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->UndergroundValve_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->UndergroundValve_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->LiftDuration_Idn) == "") { ?>
		<th data-name="LiftDuration_Idn" class="<?php echo $Products_list->LiftDuration_Idn->headerCellClass() ?>"><div id="elh_Products_LiftDuration_Idn" class="Products_LiftDuration_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->LiftDuration_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LiftDuration_Idn" class="<?php echo $Products_list->LiftDuration_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->LiftDuration_Idn) ?>', 1);"><div id="elh_Products_LiftDuration_Idn" class="Products_LiftDuration_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->LiftDuration_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->LiftDuration_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->LiftDuration_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->TrimPackageFlag->Visible) { // TrimPackageFlag ?>
	<?php if ($Products_list->SortUrl($Products_list->TrimPackageFlag) == "") { ?>
		<th data-name="TrimPackageFlag" class="<?php echo $Products_list->TrimPackageFlag->headerCellClass() ?>"><div id="elh_Products_TrimPackageFlag" class="Products_TrimPackageFlag"><div class="ew-table-header-caption"><?php echo $Products_list->TrimPackageFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TrimPackageFlag" class="<?php echo $Products_list->TrimPackageFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->TrimPackageFlag) ?>', 1);"><div id="elh_Products_TrimPackageFlag" class="Products_TrimPackageFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->TrimPackageFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->TrimPackageFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->TrimPackageFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->ListedFlag->Visible) { // ListedFlag ?>
	<?php if ($Products_list->SortUrl($Products_list->ListedFlag) == "") { ?>
		<th data-name="ListedFlag" class="<?php echo $Products_list->ListedFlag->headerCellClass() ?>"><div id="elh_Products_ListedFlag" class="Products_ListedFlag"><div class="ew-table-header-caption"><?php echo $Products_list->ListedFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ListedFlag" class="<?php echo $Products_list->ListedFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->ListedFlag) ?>', 1);"><div id="elh_Products_ListedFlag" class="Products_ListedFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->ListedFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->ListedFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->ListedFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->BoxWireLength->Visible) { // BoxWireLength ?>
	<?php if ($Products_list->SortUrl($Products_list->BoxWireLength) == "") { ?>
		<th data-name="BoxWireLength" class="<?php echo $Products_list->BoxWireLength->headerCellClass() ?>"><div id="elh_Products_BoxWireLength" class="Products_BoxWireLength"><div class="ew-table-header-caption"><?php echo $Products_list->BoxWireLength->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoxWireLength" class="<?php echo $Products_list->BoxWireLength->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->BoxWireLength) ?>', 1);"><div id="elh_Products_BoxWireLength" class="Products_BoxWireLength">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->BoxWireLength->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->BoxWireLength->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->BoxWireLength->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->IsFirePump->Visible) { // IsFirePump ?>
	<?php if ($Products_list->SortUrl($Products_list->IsFirePump) == "") { ?>
		<th data-name="IsFirePump" class="<?php echo $Products_list->IsFirePump->headerCellClass() ?>"><div id="elh_Products_IsFirePump" class="Products_IsFirePump"><div class="ew-table-header-caption"><?php echo $Products_list->IsFirePump->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsFirePump" class="<?php echo $Products_list->IsFirePump->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->IsFirePump) ?>', 1);"><div id="elh_Products_IsFirePump" class="Products_IsFirePump">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->IsFirePump->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->IsFirePump->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->IsFirePump->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->FirePumpType_Idn) == "") { ?>
		<th data-name="FirePumpType_Idn" class="<?php echo $Products_list->FirePumpType_Idn->headerCellClass() ?>"><div id="elh_Products_FirePumpType_Idn" class="Products_FirePumpType_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->FirePumpType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirePumpType_Idn" class="<?php echo $Products_list->FirePumpType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->FirePumpType_Idn) ?>', 1);"><div id="elh_Products_FirePumpType_Idn" class="Products_FirePumpType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->FirePumpType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->FirePumpType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->FirePumpType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->FirePumpAttribute_Idn) == "") { ?>
		<th data-name="FirePumpAttribute_Idn" class="<?php echo $Products_list->FirePumpAttribute_Idn->headerCellClass() ?>"><div id="elh_Products_FirePumpAttribute_Idn" class="Products_FirePumpAttribute_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->FirePumpAttribute_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirePumpAttribute_Idn" class="<?php echo $Products_list->FirePumpAttribute_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->FirePumpAttribute_Idn) ?>', 1);"><div id="elh_Products_FirePumpAttribute_Idn" class="Products_FirePumpAttribute_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->FirePumpAttribute_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->FirePumpAttribute_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->FirePumpAttribute_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->IsDieselFuel->Visible) { // IsDieselFuel ?>
	<?php if ($Products_list->SortUrl($Products_list->IsDieselFuel) == "") { ?>
		<th data-name="IsDieselFuel" class="<?php echo $Products_list->IsDieselFuel->headerCellClass() ?>"><div id="elh_Products_IsDieselFuel" class="Products_IsDieselFuel"><div class="ew-table-header-caption"><?php echo $Products_list->IsDieselFuel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsDieselFuel" class="<?php echo $Products_list->IsDieselFuel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->IsDieselFuel) ?>', 1);"><div id="elh_Products_IsDieselFuel" class="Products_IsDieselFuel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->IsDieselFuel->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->IsDieselFuel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->IsDieselFuel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->IsSolution->Visible) { // IsSolution ?>
	<?php if ($Products_list->SortUrl($Products_list->IsSolution) == "") { ?>
		<th data-name="IsSolution" class="<?php echo $Products_list->IsSolution->headerCellClass() ?>"><div id="elh_Products_IsSolution" class="Products_IsSolution"><div class="ew-table-header-caption"><?php echo $Products_list->IsSolution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsSolution" class="<?php echo $Products_list->IsSolution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->IsSolution) ?>', 1);"><div id="elh_Products_IsSolution" class="Products_IsSolution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->IsSolution->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->IsSolution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->IsSolution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Products_list->Position_Idn->Visible) { // Position_Idn ?>
	<?php if ($Products_list->SortUrl($Products_list->Position_Idn) == "") { ?>
		<th data-name="Position_Idn" class="<?php echo $Products_list->Position_Idn->headerCellClass() ?>"><div id="elh_Products_Position_Idn" class="Products_Position_Idn"><div class="ew-table-header-caption"><?php echo $Products_list->Position_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Position_Idn" class="<?php echo $Products_list->Position_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Products_list->SortUrl($Products_list->Position_Idn) ?>', 1);"><div id="elh_Products_Position_Idn" class="Products_Position_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Products_list->Position_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Products_list->Position_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Products_list->Position_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Products_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($Products_list->isAdd() || $Products_list->isCopy()) {
		$Products_list->RowIndex = 0;
		$Products_list->KeyCount = $Products_list->RowIndex;
		if ($Products_list->isCopy() && !$Products_list->loadRow())
			$Products->CurrentAction = "add";
		if ($Products_list->isAdd())
			$Products_list->loadRowValues();
		if ($Products->EventCancelled) // Insert failed
			$Products_list->restoreFormValues(); // Restore form values

		// Set row properties
		$Products->resetAttributes();
		$Products->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_Products", "data-rowtype" => ROWTYPE_ADD]);
		$Products->RowType = ROWTYPE_ADD;

		// Render row
		$Products_list->renderRow();

		// Render list options
		$Products_list->renderListOptions();
		$Products_list->StartRowCount = 0;
?>
	<tr <?php echo $Products->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Products_list->ListOptions->render("body", "left", $Products_list->RowCount);
?>
	<?php if ($Products_list->Product_Idn->Visible) { // Product_Idn ?>
		<td data-name="Product_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_Product_Idn" class="form-group Products_Product_Idn"></span>
<input type="hidden" data-table="Products" data-field="x_Product_Idn" name="o<?php echo $Products_list->RowIndex ?>_Product_Idn" id="o<?php echo $Products_list->RowIndex ?>_Product_Idn" value="<?php echo HtmlEncode($Products_list->Product_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_Department_Idn" class="form-group Products_Department_Idn">
<?php $Products_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Department_Idn" data-value-separator="<?php echo $Products_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Department_Idn" name="x<?php echo $Products_list->RowIndex ?>_Department_Idn"<?php echo $Products_list->Department_Idn->editAttributes() ?>>
			<?php echo $Products_list->Department_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Department_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Department_Idn" name="o<?php echo $Products_list->RowIndex ?>_Department_Idn" id="o<?php echo $Products_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($Products_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_WorksheetMaster_Idn" class="form-group Products_WorksheetMaster_Idn">
<?php $Products_list->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $Products_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $Products_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Products_list->WorksheetMaster_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Products_list->WorksheetMaster_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_WorksheetMaster_Idn" name="o<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($Products_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_WorksheetCategory_Idn" class="form-group Products_WorksheetCategory_Idn">
<?php $Products_list->WorksheetCategory_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $Products_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $Products_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Products_list->WorksheetCategory_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_list->WorksheetCategory_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_WorksheetCategory_Idn" name="o<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($Products_list->WorksheetCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
		<td data-name="Manufacturer_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_Manufacturer_Idn" class="form-group Products_Manufacturer_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Manufacturer_Idn" data-value-separator="<?php echo $Products_list->Manufacturer_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn" name="x<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn"<?php echo $Products_list->Manufacturer_Idn->editAttributes() ?>>
			<?php echo $Products_list->Manufacturer_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Manufacturer_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Manufacturer_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Manufacturer_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Manufacturer_Idn" name="o<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn" id="o<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn" value="<?php echo HtmlEncode($Products_list->Manufacturer_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $Products_list->RowCount ?>_Products_Rank" class="form-group Products_Rank">
<input type="text" data-table="Products" data-field="x_Rank" name="x<?php echo $Products_list->RowIndex ?>_Rank" id="x<?php echo $Products_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Products_list->Rank->EditValue ?>"<?php echo $Products_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_Rank" name="o<?php echo $Products_list->RowIndex ?>_Rank" id="o<?php echo $Products_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Products_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $Products_list->RowCount ?>_Products_Name" class="form-group Products_Name">
<input type="text" data-table="Products" data-field="x_Name" name="x<?php echo $Products_list->RowIndex ?>_Name" id="x<?php echo $Products_list->RowIndex ?>_Name" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($Products_list->Name->getPlaceHolder()) ?>" value="<?php echo $Products_list->Name->EditValue ?>"<?php echo $Products_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_Name" name="o<?php echo $Products_list->RowIndex ?>_Name" id="o<?php echo $Products_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Products_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->MaterialUnitPrice->Visible) { // MaterialUnitPrice ?>
		<td data-name="MaterialUnitPrice">
<span id="el<?php echo $Products_list->RowCount ?>_Products_MaterialUnitPrice" class="form-group Products_MaterialUnitPrice">
<input type="text" data-table="Products" data-field="x_MaterialUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->MaterialUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->MaterialUnitPrice->EditValue ?>"<?php echo $Products_list->MaterialUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_MaterialUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" value="<?php echo HtmlEncode($Products_list->MaterialUnitPrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<td data-name="FieldUnitPrice">
<span id="el<?php echo $Products_list->RowCount ?>_Products_FieldUnitPrice" class="form-group Products_FieldUnitPrice">
<input type="text" data-table="Products" data-field="x_FieldUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->FieldUnitPrice->EditValue ?>"<?php echo $Products_list->FieldUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_FieldUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" value="<?php echo HtmlEncode($Products_list->FieldUnitPrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ShopUnitPrice->Visible) { // ShopUnitPrice ?>
		<td data-name="ShopUnitPrice">
<span id="el<?php echo $Products_list->RowCount ?>_Products_ShopUnitPrice" class="form-group Products_ShopUnitPrice">
<input type="text" data-table="Products" data-field="x_ShopUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->ShopUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->ShopUnitPrice->EditValue ?>"<?php echo $Products_list->ShopUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_ShopUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" value="<?php echo HtmlEncode($Products_list->ShopUnitPrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->EngineerUnitPrice->Visible) { // EngineerUnitPrice ?>
		<td data-name="EngineerUnitPrice">
<span id="el<?php echo $Products_list->RowCount ?>_Products_EngineerUnitPrice" class="form-group Products_EngineerUnitPrice">
<input type="text" data-table="Products" data-field="x_EngineerUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->EngineerUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->EngineerUnitPrice->EditValue ?>"<?php echo $Products_list->EngineerUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_EngineerUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" value="<?php echo HtmlEncode($Products_list->EngineerUnitPrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->DefaultQuantity->Visible) { // DefaultQuantity ?>
		<td data-name="DefaultQuantity">
<span id="el<?php echo $Products_list->RowCount ?>_Products_DefaultQuantity" class="form-group Products_DefaultQuantity">
<input type="text" data-table="Products" data-field="x_DefaultQuantity" name="x<?php echo $Products_list->RowIndex ?>_DefaultQuantity" id="x<?php echo $Products_list->RowIndex ?>_DefaultQuantity" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->DefaultQuantity->getPlaceHolder()) ?>" value="<?php echo $Products_list->DefaultQuantity->EditValue ?>"<?php echo $Products_list->DefaultQuantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_DefaultQuantity" name="o<?php echo $Products_list->RowIndex ?>_DefaultQuantity" id="o<?php echo $Products_list->RowIndex ?>_DefaultQuantity" value="<?php echo HtmlEncode($Products_list->DefaultQuantity->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td data-name="ProductSize_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_ProductSize_Idn" class="form-group Products_ProductSize_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $Products_list->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ProductSize_Idn" name="x<?php echo $Products_list->RowIndex ?>_ProductSize_Idn"<?php echo $Products_list->ProductSize_Idn->editAttributes() ?>>
			<?php echo $Products_list->ProductSize_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ProductSize_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ProductSize_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ProductSize_Idn" name="o<?php echo $Products_list->RowIndex ?>_ProductSize_Idn" id="o<?php echo $Products_list->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($Products_list->ProductSize_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Description->Visible) { // Description ?>
		<td data-name="Description">
<span id="el<?php echo $Products_list->RowCount ?>_Products_Description" class="form-group Products_Description">
<textarea data-table="Products" data-field="x_Description" name="x<?php echo $Products_list->RowIndex ?>_Description" id="x<?php echo $Products_list->RowIndex ?>_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($Products_list->Description->getPlaceHolder()) ?>"<?php echo $Products_list->Description->editAttributes() ?>><?php echo $Products_list->Description->EditValue ?></textarea>
</span>
<input type="hidden" data-table="Products" data-field="x_Description" name="o<?php echo $Products_list->RowIndex ?>_Description" id="o<?php echo $Products_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($Products_list->Description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td data-name="PipeType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_PipeType_Idn" class="form-group Products_PipeType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PipeType_Idn" data-value-separator="<?php echo $Products_list->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_PipeType_Idn" name="x<?php echo $Products_list->RowIndex ?>_PipeType_Idn"<?php echo $Products_list->PipeType_Idn->editAttributes() ?>>
			<?php echo $Products_list->PipeType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_PipeType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->PipeType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_PipeType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_PipeType_Idn" name="o<?php echo $Products_list->RowIndex ?>_PipeType_Idn" id="o<?php echo $Products_list->RowIndex ?>_PipeType_Idn" value="<?php echo HtmlEncode($Products_list->PipeType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
		<td data-name="ScheduleType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_ScheduleType_Idn" class="form-group Products_ScheduleType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ScheduleType_Idn" data-value-separator="<?php echo $Products_list->ScheduleType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn" name="x<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn"<?php echo $Products_list->ScheduleType_Idn->editAttributes() ?>>
			<?php echo $Products_list->ScheduleType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ScheduleType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ScheduleType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ScheduleType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ScheduleType_Idn" name="o<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn" id="o<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn" value="<?php echo HtmlEncode($Products_list->ScheduleType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Fitting_Idn->Visible) { // Fitting_Idn ?>
		<td data-name="Fitting_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_Fitting_Idn" class="form-group Products_Fitting_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Fitting_Idn" data-value-separator="<?php echo $Products_list->Fitting_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Fitting_Idn" name="x<?php echo $Products_list->RowIndex ?>_Fitting_Idn"<?php echo $Products_list->Fitting_Idn->editAttributes() ?>>
			<?php echo $Products_list->Fitting_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Fitting_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Fitting_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Fitting_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Fitting_Idn" name="o<?php echo $Products_list->RowIndex ?>_Fitting_Idn" id="o<?php echo $Products_list->RowIndex ?>_Fitting_Idn" value="<?php echo HtmlEncode($Products_list->Fitting_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
		<td data-name="GroovedFittingType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_GroovedFittingType_Idn" class="form-group Products_GroovedFittingType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GroovedFittingType_Idn" data-value-separator="<?php echo $Products_list->GroovedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn" name="x<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn"<?php echo $Products_list->GroovedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_list->GroovedFittingType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_GroovedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->GroovedFittingType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_GroovedFittingType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_GroovedFittingType_Idn" name="o<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn" id="o<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn" value="<?php echo HtmlEncode($Products_list->GroovedFittingType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
		<td data-name="ThreadedFittingType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_ThreadedFittingType_Idn" class="form-group Products_ThreadedFittingType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ThreadedFittingType_Idn" data-value-separator="<?php echo $Products_list->ThreadedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn" name="x<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn"<?php echo $Products_list->ThreadedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_list->ThreadedFittingType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ThreadedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ThreadedFittingType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ThreadedFittingType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ThreadedFittingType_Idn" name="o<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn" id="o<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn" value="<?php echo HtmlEncode($Products_list->ThreadedFittingType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td data-name="HangerType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_HangerType_Idn" class="form-group Products_HangerType_Idn">
<?php $Products_list->HangerType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerType_Idn" data-value-separator="<?php echo $Products_list->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HangerType_Idn"<?php echo $Products_list->HangerType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HangerType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HangerType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HangerType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HangerType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_HangerType_Idn" name="o<?php echo $Products_list->RowIndex ?>_HangerType_Idn" id="o<?php echo $Products_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($Products_list->HangerType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<td data-name="HangerSubType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_HangerSubType_Idn" class="form-group Products_HangerSubType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerSubType_Idn" data-value-separator="<?php echo $Products_list->HangerSubType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn"<?php echo $Products_list->HangerSubType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HangerSubType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HangerSubType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HangerSubType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HangerSubType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_HangerSubType_Idn" name="o<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn" id="o<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($Products_list->HangerSubType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->SubcontractCategory_Idn->Visible) { // SubcontractCategory_Idn ?>
		<td data-name="SubcontractCategory_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_SubcontractCategory_Idn" class="form-group Products_SubcontractCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_SubcontractCategory_Idn" data-value-separator="<?php echo $Products_list->SubcontractCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn" name="x<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn"<?php echo $Products_list->SubcontractCategory_Idn->editAttributes() ?>>
			<?php echo $Products_list->SubcontractCategory_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_SubcontractCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_list->SubcontractCategory_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_SubcontractCategory_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_SubcontractCategory_Idn" name="o<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn" id="o<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn" value="<?php echo HtmlEncode($Products_list->SubcontractCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ApplyToAdjustmentFactorsFlag->Visible) { // ApplyToAdjustmentFactorsFlag ?>
		<td data-name="ApplyToAdjustmentFactorsFlag">
<span id="el<?php echo $Products_list->RowCount ?>_Products_ApplyToAdjustmentFactorsFlag" class="form-group Products_ApplyToAdjustmentFactorsFlag">
<?php
$selwrk = ConvertToBool($Products_list->ApplyToAdjustmentFactorsFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToAdjustmentFactorsFlag" name="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]_269189" value="1"<?php echo $selwrk ?><?php echo $Products_list->ApplyToAdjustmentFactorsFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]_269189"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ApplyToAdjustmentFactorsFlag" name="o<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]" value="<?php echo HtmlEncode($Products_list->ApplyToAdjustmentFactorsFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ApplyToContingencyFlag->Visible) { // ApplyToContingencyFlag ?>
		<td data-name="ApplyToContingencyFlag">
<span id="el<?php echo $Products_list->RowCount ?>_Products_ApplyToContingencyFlag" class="form-group Products_ApplyToContingencyFlag">
<?php
$selwrk = ConvertToBool($Products_list->ApplyToContingencyFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToContingencyFlag" name="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]_836193" value="1"<?php echo $selwrk ?><?php echo $Products_list->ApplyToContingencyFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]_836193"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ApplyToContingencyFlag" name="o<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]" value="<?php echo HtmlEncode($Products_list->ApplyToContingencyFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->IsMainComponent->Visible) { // IsMainComponent ?>
		<td data-name="IsMainComponent">
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsMainComponent" class="form-group Products_IsMainComponent">
<?php
$selwrk = ConvertToBool($Products_list->IsMainComponent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsMainComponent" name="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]" id="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]_327716" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsMainComponent->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]_327716"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsMainComponent" name="o<?php echo $Products_list->RowIndex ?>_IsMainComponent[]" id="o<?php echo $Products_list->RowIndex ?>_IsMainComponent[]" value="<?php echo HtmlEncode($Products_list->IsMainComponent->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->DomesticFlag->Visible) { // DomesticFlag ?>
		<td data-name="DomesticFlag">
<span id="el<?php echo $Products_list->RowCount ?>_Products_DomesticFlag" class="form-group Products_DomesticFlag">
<?php
$selwrk = ConvertToBool($Products_list->DomesticFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_DomesticFlag" name="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]" id="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]_746068" value="1"<?php echo $selwrk ?><?php echo $Products_list->DomesticFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]_746068"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_DomesticFlag" name="o<?php echo $Products_list->RowIndex ?>_DomesticFlag[]" id="o<?php echo $Products_list->RowIndex ?>_DomesticFlag[]" value="<?php echo HtmlEncode($Products_list->DomesticFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->LoadFlag->Visible) { // LoadFlag ?>
		<td data-name="LoadFlag">
<span id="el<?php echo $Products_list->RowCount ?>_Products_LoadFlag" class="form-group Products_LoadFlag">
<?php
$selwrk = ConvertToBool($Products_list->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_LoadFlag" name="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]" id="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]_733859" value="1"<?php echo $selwrk ?><?php echo $Products_list->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]_733859"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_LoadFlag" name="o<?php echo $Products_list->RowIndex ?>_LoadFlag[]" id="o<?php echo $Products_list->RowIndex ?>_LoadFlag[]" value="<?php echo HtmlEncode($Products_list->LoadFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<td data-name="AutoLoadFlag">
<span id="el<?php echo $Products_list->RowCount ?>_Products_AutoLoadFlag" class="form-group Products_AutoLoadFlag">
<?php
$selwrk = ConvertToBool($Products_list->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_AutoLoadFlag" name="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]" id="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]_146303" value="1"<?php echo $selwrk ?><?php echo $Products_list->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]_146303"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_AutoLoadFlag" name="o<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]" id="o<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]" value="<?php echo HtmlEncode($Products_list->AutoLoadFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $Products_list->RowCount ?>_Products_ActiveFlag" class="form-group Products_ActiveFlag">
<?php
$selwrk = ConvertToBool($Products_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ActiveFlag" name="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]_806405" value="1"<?php echo $selwrk ?><?php echo $Products_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]_806405"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ActiveFlag" name="o<?php echo $Products_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Products_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->GradeType_Idn->Visible) { // GradeType_Idn ?>
		<td data-name="GradeType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_GradeType_Idn" class="form-group Products_GradeType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GradeType_Idn" data-value-separator="<?php echo $Products_list->GradeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_GradeType_Idn" name="x<?php echo $Products_list->RowIndex ?>_GradeType_Idn"<?php echo $Products_list->GradeType_Idn->editAttributes() ?>>
			<?php echo $Products_list->GradeType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_GradeType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->GradeType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_GradeType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_GradeType_Idn" name="o<?php echo $Products_list->RowIndex ?>_GradeType_Idn" id="o<?php echo $Products_list->RowIndex ?>_GradeType_Idn" value="<?php echo HtmlEncode($Products_list->GradeType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->PressureType_Idn->Visible) { // PressureType_Idn ?>
		<td data-name="PressureType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_PressureType_Idn" class="form-group Products_PressureType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PressureType_Idn" data-value-separator="<?php echo $Products_list->PressureType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_PressureType_Idn" name="x<?php echo $Products_list->RowIndex ?>_PressureType_Idn"<?php echo $Products_list->PressureType_Idn->editAttributes() ?>>
			<?php echo $Products_list->PressureType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_PressureType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->PressureType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_PressureType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_PressureType_Idn" name="o<?php echo $Products_list->RowIndex ?>_PressureType_Idn" id="o<?php echo $Products_list->RowIndex ?>_PressureType_Idn" value="<?php echo HtmlEncode($Products_list->PressureType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->SeamlessFlag->Visible) { // SeamlessFlag ?>
		<td data-name="SeamlessFlag">
<span id="el<?php echo $Products_list->RowCount ?>_Products_SeamlessFlag" class="form-group Products_SeamlessFlag">
<?php
$selwrk = ConvertToBool($Products_list->SeamlessFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_SeamlessFlag" name="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]" id="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]_529838" value="1"<?php echo $selwrk ?><?php echo $Products_list->SeamlessFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]_529838"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_SeamlessFlag" name="o<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]" id="o<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]" value="<?php echo HtmlEncode($Products_list->SeamlessFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ResponseType->Visible) { // ResponseType ?>
		<td data-name="ResponseType">
<span id="el<?php echo $Products_list->RowCount ?>_Products_ResponseType" class="form-group Products_ResponseType">
<div id="tp_x<?php echo $Products_list->RowIndex ?>_ResponseType" class="ew-template"><input type="radio" class="custom-control-input" data-table="Products" data-field="x_ResponseType" data-value-separator="<?php echo $Products_list->ResponseType->displayValueSeparatorAttribute() ?>" name="x<?php echo $Products_list->RowIndex ?>_ResponseType" id="x<?php echo $Products_list->RowIndex ?>_ResponseType" value="{value}"<?php echo $Products_list->ResponseType->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Products_list->RowIndex ?>_ResponseType" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Products_list->ResponseType->radioButtonListHtml(FALSE, "x{$Products_list->RowIndex}_ResponseType") ?>
</div></div>
</span>
<input type="hidden" data-table="Products" data-field="x_ResponseType" name="o<?php echo $Products_list->RowIndex ?>_ResponseType" id="o<?php echo $Products_list->RowIndex ?>_ResponseType" value="<?php echo HtmlEncode($Products_list->ResponseType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FMJobFlag->Visible) { // FMJobFlag ?>
		<td data-name="FMJobFlag">
<span id="el<?php echo $Products_list->RowCount ?>_Products_FMJobFlag" class="form-group Products_FMJobFlag">
<?php
$selwrk = ConvertToBool($Products_list->FMJobFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_FMJobFlag" name="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]" id="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]_351991" value="1"<?php echo $selwrk ?><?php echo $Products_list->FMJobFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]_351991"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_FMJobFlag" name="o<?php echo $Products_list->RowIndex ?>_FMJobFlag[]" id="o<?php echo $Products_list->RowIndex ?>_FMJobFlag[]" value="<?php echo HtmlEncode($Products_list->FMJobFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->RecommendedBoxes->Visible) { // RecommendedBoxes ?>
		<td data-name="RecommendedBoxes">
<span id="el<?php echo $Products_list->RowCount ?>_Products_RecommendedBoxes" class="form-group Products_RecommendedBoxes">
<input type="text" data-table="Products" data-field="x_RecommendedBoxes" name="x<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" id="x<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->RecommendedBoxes->getPlaceHolder()) ?>" value="<?php echo $Products_list->RecommendedBoxes->EditValue ?>"<?php echo $Products_list->RecommendedBoxes->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_RecommendedBoxes" name="o<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" id="o<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" value="<?php echo HtmlEncode($Products_list->RecommendedBoxes->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->RecommendedWireFootage->Visible) { // RecommendedWireFootage ?>
		<td data-name="RecommendedWireFootage">
<span id="el<?php echo $Products_list->RowCount ?>_Products_RecommendedWireFootage" class="form-group Products_RecommendedWireFootage">
<input type="text" data-table="Products" data-field="x_RecommendedWireFootage" name="x<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" id="x<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->RecommendedWireFootage->getPlaceHolder()) ?>" value="<?php echo $Products_list->RecommendedWireFootage->EditValue ?>"<?php echo $Products_list->RecommendedWireFootage->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_RecommendedWireFootage" name="o<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" id="o<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" value="<?php echo HtmlEncode($Products_list->RecommendedWireFootage->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
		<td data-name="CoverageType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_CoverageType_Idn" class="form-group Products_CoverageType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CoverageType_Idn" data-value-separator="<?php echo $Products_list->CoverageType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_CoverageType_Idn" name="x<?php echo $Products_list->RowIndex ?>_CoverageType_Idn"<?php echo $Products_list->CoverageType_Idn->editAttributes() ?>>
			<?php echo $Products_list->CoverageType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_CoverageType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->CoverageType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_CoverageType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_CoverageType_Idn" name="o<?php echo $Products_list->RowIndex ?>_CoverageType_Idn" id="o<?php echo $Products_list->RowIndex ?>_CoverageType_Idn" value="<?php echo HtmlEncode($Products_list->CoverageType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->HeadType_Idn->Visible) { // HeadType_Idn ?>
		<td data-name="HeadType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_HeadType_Idn" class="form-group Products_HeadType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HeadType_Idn" data-value-separator="<?php echo $Products_list->HeadType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HeadType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HeadType_Idn"<?php echo $Products_list->HeadType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HeadType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HeadType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HeadType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HeadType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_HeadType_Idn" name="o<?php echo $Products_list->RowIndex ?>_HeadType_Idn" id="o<?php echo $Products_list->RowIndex ?>_HeadType_Idn" value="<?php echo HtmlEncode($Products_list->HeadType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FinishType_Idn->Visible) { // FinishType_Idn ?>
		<td data-name="FinishType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_FinishType_Idn" class="form-group Products_FinishType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FinishType_Idn" data-value-separator="<?php echo $Products_list->FinishType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FinishType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FinishType_Idn"<?php echo $Products_list->FinishType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FinishType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FinishType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FinishType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FinishType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_FinishType_Idn" name="o<?php echo $Products_list->RowIndex ?>_FinishType_Idn" id="o<?php echo $Products_list->RowIndex ?>_FinishType_Idn" value="<?php echo HtmlEncode($Products_list->FinishType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Outlet_Idn->Visible) { // Outlet_Idn ?>
		<td data-name="Outlet_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_Outlet_Idn" class="form-group Products_Outlet_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Outlet_Idn" data-value-separator="<?php echo $Products_list->Outlet_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Outlet_Idn" name="x<?php echo $Products_list->RowIndex ?>_Outlet_Idn"<?php echo $Products_list->Outlet_Idn->editAttributes() ?>>
			<?php echo $Products_list->Outlet_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Outlet_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Outlet_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Outlet_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Outlet_Idn" name="o<?php echo $Products_list->RowIndex ?>_Outlet_Idn" id="o<?php echo $Products_list->RowIndex ?>_Outlet_Idn" value="<?php echo HtmlEncode($Products_list->Outlet_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->RiserType_Idn->Visible) { // RiserType_Idn ?>
		<td data-name="RiserType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_RiserType_Idn" class="form-group Products_RiserType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_RiserType_Idn" data-value-separator="<?php echo $Products_list->RiserType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_RiserType_Idn" name="x<?php echo $Products_list->RowIndex ?>_RiserType_Idn"<?php echo $Products_list->RiserType_Idn->editAttributes() ?>>
			<?php echo $Products_list->RiserType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_RiserType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->RiserType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_RiserType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_RiserType_Idn" name="o<?php echo $Products_list->RowIndex ?>_RiserType_Idn" id="o<?php echo $Products_list->RowIndex ?>_RiserType_Idn" value="<?php echo HtmlEncode($Products_list->RiserType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->BackFlowType_Idn->Visible) { // BackFlowType_Idn ?>
		<td data-name="BackFlowType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_BackFlowType_Idn" class="form-group Products_BackFlowType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BackFlowType_Idn" data-value-separator="<?php echo $Products_list->BackFlowType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn" name="x<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn"<?php echo $Products_list->BackFlowType_Idn->editAttributes() ?>>
			<?php echo $Products_list->BackFlowType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_BackFlowType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->BackFlowType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_BackFlowType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_BackFlowType_Idn" name="o<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn" id="o<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn" value="<?php echo HtmlEncode($Products_list->BackFlowType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
		<td data-name="ControlValve_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_ControlValve_Idn" class="form-group Products_ControlValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ControlValve_Idn" data-value-separator="<?php echo $Products_list->ControlValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ControlValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_ControlValve_Idn"<?php echo $Products_list->ControlValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->ControlValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ControlValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ControlValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ControlValve_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ControlValve_Idn" name="o<?php echo $Products_list->RowIndex ?>_ControlValve_Idn" id="o<?php echo $Products_list->RowIndex ?>_ControlValve_Idn" value="<?php echo HtmlEncode($Products_list->ControlValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
		<td data-name="CheckValve_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_CheckValve_Idn" class="form-group Products_CheckValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CheckValve_Idn" data-value-separator="<?php echo $Products_list->CheckValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_CheckValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_CheckValve_Idn"<?php echo $Products_list->CheckValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->CheckValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_CheckValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->CheckValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_CheckValve_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_CheckValve_Idn" name="o<?php echo $Products_list->RowIndex ?>_CheckValve_Idn" id="o<?php echo $Products_list->RowIndex ?>_CheckValve_Idn" value="<?php echo HtmlEncode($Products_list->CheckValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FDCType_Idn->Visible) { // FDCType_Idn ?>
		<td data-name="FDCType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_FDCType_Idn" class="form-group Products_FDCType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FDCType_Idn" data-value-separator="<?php echo $Products_list->FDCType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FDCType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FDCType_Idn"<?php echo $Products_list->FDCType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FDCType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FDCType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FDCType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FDCType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_FDCType_Idn" name="o<?php echo $Products_list->RowIndex ?>_FDCType_Idn" id="o<?php echo $Products_list->RowIndex ?>_FDCType_Idn" value="<?php echo HtmlEncode($Products_list->FDCType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->BellType_Idn->Visible) { // BellType_Idn ?>
		<td data-name="BellType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_BellType_Idn" class="form-group Products_BellType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BellType_Idn" data-value-separator="<?php echo $Products_list->BellType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_BellType_Idn" name="x<?php echo $Products_list->RowIndex ?>_BellType_Idn"<?php echo $Products_list->BellType_Idn->editAttributes() ?>>
			<?php echo $Products_list->BellType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_BellType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->BellType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_BellType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_BellType_Idn" name="o<?php echo $Products_list->RowIndex ?>_BellType_Idn" id="o<?php echo $Products_list->RowIndex ?>_BellType_Idn" value="<?php echo HtmlEncode($Products_list->BellType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
		<td data-name="TappingTee_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_TappingTee_Idn" class="form-group Products_TappingTee_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_TappingTee_Idn" data-value-separator="<?php echo $Products_list->TappingTee_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_TappingTee_Idn" name="x<?php echo $Products_list->RowIndex ?>_TappingTee_Idn"<?php echo $Products_list->TappingTee_Idn->editAttributes() ?>>
			<?php echo $Products_list->TappingTee_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_TappingTee_Idn") ?>
		</select>
</div>
<?php echo $Products_list->TappingTee_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_TappingTee_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_TappingTee_Idn" name="o<?php echo $Products_list->RowIndex ?>_TappingTee_Idn" id="o<?php echo $Products_list->RowIndex ?>_TappingTee_Idn" value="<?php echo HtmlEncode($Products_list->TappingTee_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
		<td data-name="UndergroundValve_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_UndergroundValve_Idn" class="form-group Products_UndergroundValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_UndergroundValve_Idn" data-value-separator="<?php echo $Products_list->UndergroundValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn"<?php echo $Products_list->UndergroundValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->UndergroundValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_UndergroundValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->UndergroundValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_UndergroundValve_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_UndergroundValve_Idn" name="o<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn" id="o<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn" value="<?php echo HtmlEncode($Products_list->UndergroundValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
		<td data-name="LiftDuration_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_LiftDuration_Idn" class="form-group Products_LiftDuration_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_LiftDuration_Idn" data-value-separator="<?php echo $Products_list->LiftDuration_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn" name="x<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn"<?php echo $Products_list->LiftDuration_Idn->editAttributes() ?>>
			<?php echo $Products_list->LiftDuration_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_LiftDuration_Idn") ?>
		</select>
</div>
<?php echo $Products_list->LiftDuration_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_LiftDuration_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_LiftDuration_Idn" name="o<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn" id="o<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn" value="<?php echo HtmlEncode($Products_list->LiftDuration_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->TrimPackageFlag->Visible) { // TrimPackageFlag ?>
		<td data-name="TrimPackageFlag">
<span id="el<?php echo $Products_list->RowCount ?>_Products_TrimPackageFlag" class="form-group Products_TrimPackageFlag">
<?php
$selwrk = ConvertToBool($Products_list->TrimPackageFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_TrimPackageFlag" name="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]" id="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]_194069" value="1"<?php echo $selwrk ?><?php echo $Products_list->TrimPackageFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]_194069"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_TrimPackageFlag" name="o<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]" id="o<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]" value="<?php echo HtmlEncode($Products_list->TrimPackageFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ListedFlag->Visible) { // ListedFlag ?>
		<td data-name="ListedFlag">
<span id="el<?php echo $Products_list->RowCount ?>_Products_ListedFlag" class="form-group Products_ListedFlag">
<?php
$selwrk = ConvertToBool($Products_list->ListedFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ListedFlag" name="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]_906626" value="1"<?php echo $selwrk ?><?php echo $Products_list->ListedFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]_906626"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ListedFlag" name="o<?php echo $Products_list->RowIndex ?>_ListedFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ListedFlag[]" value="<?php echo HtmlEncode($Products_list->ListedFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->BoxWireLength->Visible) { // BoxWireLength ?>
		<td data-name="BoxWireLength">
<span id="el<?php echo $Products_list->RowCount ?>_Products_BoxWireLength" class="form-group Products_BoxWireLength">
<input type="text" data-table="Products" data-field="x_BoxWireLength" name="x<?php echo $Products_list->RowIndex ?>_BoxWireLength" id="x<?php echo $Products_list->RowIndex ?>_BoxWireLength" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->BoxWireLength->getPlaceHolder()) ?>" value="<?php echo $Products_list->BoxWireLength->EditValue ?>"<?php echo $Products_list->BoxWireLength->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_BoxWireLength" name="o<?php echo $Products_list->RowIndex ?>_BoxWireLength" id="o<?php echo $Products_list->RowIndex ?>_BoxWireLength" value="<?php echo HtmlEncode($Products_list->BoxWireLength->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->IsFirePump->Visible) { // IsFirePump ?>
		<td data-name="IsFirePump">
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsFirePump" class="form-group Products_IsFirePump">
<?php
$selwrk = ConvertToBool($Products_list->IsFirePump->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsFirePump" name="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]" id="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]_773891" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsFirePump->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]_773891"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsFirePump" name="o<?php echo $Products_list->RowIndex ?>_IsFirePump[]" id="o<?php echo $Products_list->RowIndex ?>_IsFirePump[]" value="<?php echo HtmlEncode($Products_list->IsFirePump->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
		<td data-name="FirePumpType_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_FirePumpType_Idn" class="form-group Products_FirePumpType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FirePumpType_Idn" data-value-separator="<?php echo $Products_list->FirePumpType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn"<?php echo $Products_list->FirePumpType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FirePumpType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FirePumpType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FirePumpType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FirePumpType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_FirePumpType_Idn" name="o<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn" id="o<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn" value="<?php echo HtmlEncode($Products_list->FirePumpType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
		<td data-name="FirePumpAttribute_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_FirePumpAttribute_Idn" class="form-group Products_FirePumpAttribute_Idn">
<input type="text" data-table="Products" data-field="x_FirePumpAttribute_Idn" name="x<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" id="x<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->FirePumpAttribute_Idn->getPlaceHolder()) ?>" value="<?php echo $Products_list->FirePumpAttribute_Idn->EditValue ?>"<?php echo $Products_list->FirePumpAttribute_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_FirePumpAttribute_Idn" name="o<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" id="o<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" value="<?php echo HtmlEncode($Products_list->FirePumpAttribute_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->IsDieselFuel->Visible) { // IsDieselFuel ?>
		<td data-name="IsDieselFuel">
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsDieselFuel" class="form-group Products_IsDieselFuel">
<?php
$selwrk = ConvertToBool($Products_list->IsDieselFuel->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsDieselFuel" name="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]" id="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]_182970" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsDieselFuel->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]_182970"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsDieselFuel" name="o<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]" id="o<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]" value="<?php echo HtmlEncode($Products_list->IsDieselFuel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->IsSolution->Visible) { // IsSolution ?>
		<td data-name="IsSolution">
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsSolution" class="form-group Products_IsSolution">
<?php
$selwrk = ConvertToBool($Products_list->IsSolution->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsSolution" name="x<?php echo $Products_list->RowIndex ?>_IsSolution[]" id="x<?php echo $Products_list->RowIndex ?>_IsSolution[]_303017" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsSolution->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsSolution[]_303017"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsSolution" name="o<?php echo $Products_list->RowIndex ?>_IsSolution[]" id="o<?php echo $Products_list->RowIndex ?>_IsSolution[]" value="<?php echo HtmlEncode($Products_list->IsSolution->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Position_Idn->Visible) { // Position_Idn ?>
		<td data-name="Position_Idn">
<span id="el<?php echo $Products_list->RowCount ?>_Products_Position_Idn" class="form-group Products_Position_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Position_Idn" data-value-separator="<?php echo $Products_list->Position_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Position_Idn" name="x<?php echo $Products_list->RowIndex ?>_Position_Idn"<?php echo $Products_list->Position_Idn->editAttributes() ?>>
			<?php echo $Products_list->Position_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Position_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Position_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Position_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Position_Idn" name="o<?php echo $Products_list->RowIndex ?>_Position_Idn" id="o<?php echo $Products_list->RowIndex ?>_Position_Idn" value="<?php echo HtmlEncode($Products_list->Position_Idn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Products_list->ListOptions->render("body", "right", $Products_list->RowCount);
?>
<script>
loadjs.ready(["fProductslist", "load"], function() {
	fProductslist.updateLists(<?php echo $Products_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($Products_list->ExportAll && $Products_list->isExport()) {
	$Products_list->StopRecord = $Products_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Products_list->TotalRecords > $Products_list->StartRecord + $Products_list->DisplayRecords - 1)
		$Products_list->StopRecord = $Products_list->StartRecord + $Products_list->DisplayRecords - 1;
	else
		$Products_list->StopRecord = $Products_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($Products->isConfirm() || $Products_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Products_list->FormKeyCountName) && ($Products_list->isGridAdd() || $Products_list->isGridEdit() || $Products->isConfirm())) {
		$Products_list->KeyCount = $CurrentForm->getValue($Products_list->FormKeyCountName);
		$Products_list->StopRecord = $Products_list->StartRecord + $Products_list->KeyCount - 1;
	}
}
$Products_list->RecordCount = $Products_list->StartRecord - 1;
if ($Products_list->Recordset && !$Products_list->Recordset->EOF) {
	$Products_list->Recordset->moveFirst();
	$selectLimit = $Products_list->UseSelectLimit;
	if (!$selectLimit && $Products_list->StartRecord > 1)
		$Products_list->Recordset->move($Products_list->StartRecord - 1);
} elseif (!$Products->AllowAddDeleteRow && $Products_list->StopRecord == 0) {
	$Products_list->StopRecord = $Products->GridAddRowCount;
}

// Initialize aggregate
$Products->RowType = ROWTYPE_AGGREGATEINIT;
$Products->resetAttributes();
$Products_list->renderRow();
$Products_list->EditRowCount = 0;
if ($Products_list->isEdit())
	$Products_list->RowIndex = 1;
if ($Products_list->isGridAdd())
	$Products_list->RowIndex = 0;
if ($Products_list->isGridEdit())
	$Products_list->RowIndex = 0;
while ($Products_list->RecordCount < $Products_list->StopRecord) {
	$Products_list->RecordCount++;
	if ($Products_list->RecordCount >= $Products_list->StartRecord) {
		$Products_list->RowCount++;
		if ($Products_list->isGridAdd() || $Products_list->isGridEdit() || $Products->isConfirm()) {
			$Products_list->RowIndex++;
			$CurrentForm->Index = $Products_list->RowIndex;
			if ($CurrentForm->hasValue($Products_list->FormActionName) && ($Products->isConfirm() || $Products_list->EventCancelled))
				$Products_list->RowAction = strval($CurrentForm->getValue($Products_list->FormActionName));
			elseif ($Products_list->isGridAdd())
				$Products_list->RowAction = "insert";
			else
				$Products_list->RowAction = "";
		}

		// Set up key count
		$Products_list->KeyCount = $Products_list->RowIndex;

		// Init row class and style
		$Products->resetAttributes();
		$Products->CssClass = "";
		if ($Products_list->isGridAdd()) {
			$Products_list->loadRowValues(); // Load default values
		} else {
			$Products_list->loadRowValues($Products_list->Recordset); // Load row values
		}
		$Products->RowType = ROWTYPE_VIEW; // Render view
		if ($Products_list->isGridAdd()) // Grid add
			$Products->RowType = ROWTYPE_ADD; // Render add
		if ($Products_list->isGridAdd() && $Products->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Products_list->restoreCurrentRowFormValues($Products_list->RowIndex); // Restore form values
		if ($Products_list->isEdit()) {
			if ($Products_list->checkInlineEditKey() && $Products_list->EditRowCount == 0) { // Inline edit
				$Products->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($Products_list->isGridEdit()) { // Grid edit
			if ($Products->EventCancelled)
				$Products_list->restoreCurrentRowFormValues($Products_list->RowIndex); // Restore form values
			if ($Products_list->RowAction == "insert")
				$Products->RowType = ROWTYPE_ADD; // Render add
			else
				$Products->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Products_list->isEdit() && $Products->RowType == ROWTYPE_EDIT && $Products->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$Products_list->restoreFormValues(); // Restore form values
		}
		if ($Products_list->isGridEdit() && ($Products->RowType == ROWTYPE_EDIT || $Products->RowType == ROWTYPE_ADD) && $Products->EventCancelled) // Update failed
			$Products_list->restoreCurrentRowFormValues($Products_list->RowIndex); // Restore form values
		if ($Products->RowType == ROWTYPE_EDIT) // Edit row
			$Products_list->EditRowCount++;

		// Set up row id / data-rowindex
		$Products->RowAttrs->merge(["data-rowindex" => $Products_list->RowCount, "id" => "r" . $Products_list->RowCount . "_Products", "data-rowtype" => $Products->RowType]);

		// Render row
		$Products_list->renderRow();

		// Render list options
		$Products_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Products_list->RowAction != "delete" && $Products_list->RowAction != "insertdelete" && !($Products_list->RowAction == "insert" && $Products->isConfirm() && $Products_list->emptyRow())) {
?>
	<tr <?php echo $Products->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Products_list->ListOptions->render("body", "left", $Products_list->RowCount);
?>
	<?php if ($Products_list->Product_Idn->Visible) { // Product_Idn ?>
		<td data-name="Product_Idn" <?php echo $Products_list->Product_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Product_Idn" class="form-group"></span>
<input type="hidden" data-table="Products" data-field="x_Product_Idn" name="o<?php echo $Products_list->RowIndex ?>_Product_Idn" id="o<?php echo $Products_list->RowIndex ?>_Product_Idn" value="<?php echo HtmlEncode($Products_list->Product_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Product_Idn" class="form-group">
<span<?php echo $Products_list->Product_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Products_list->Product_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Products" data-field="x_Product_Idn" name="x<?php echo $Products_list->RowIndex ?>_Product_Idn" id="x<?php echo $Products_list->RowIndex ?>_Product_Idn" value="<?php echo HtmlEncode($Products_list->Product_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Product_Idn">
<span<?php echo $Products_list->Product_Idn->viewAttributes() ?>><?php echo $Products_list->Product_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $Products_list->Department_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Department_Idn" class="form-group">
<?php $Products_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Department_Idn" data-value-separator="<?php echo $Products_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Department_Idn" name="x<?php echo $Products_list->RowIndex ?>_Department_Idn"<?php echo $Products_list->Department_Idn->editAttributes() ?>>
			<?php echo $Products_list->Department_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Department_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Department_Idn" name="o<?php echo $Products_list->RowIndex ?>_Department_Idn" id="o<?php echo $Products_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($Products_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Department_Idn" class="form-group">
<?php $Products_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Department_Idn" data-value-separator="<?php echo $Products_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Department_Idn" name="x<?php echo $Products_list->RowIndex ?>_Department_Idn"<?php echo $Products_list->Department_Idn->editAttributes() ?>>
			<?php echo $Products_list->Department_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Department_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Department_Idn">
<span<?php echo $Products_list->Department_Idn->viewAttributes() ?>><?php echo $Products_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $Products_list->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_WorksheetMaster_Idn" class="form-group">
<?php $Products_list->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $Products_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $Products_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Products_list->WorksheetMaster_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Products_list->WorksheetMaster_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_WorksheetMaster_Idn" name="o<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($Products_list->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_WorksheetMaster_Idn" class="form-group">
<?php $Products_list->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $Products_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $Products_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Products_list->WorksheetMaster_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Products_list->WorksheetMaster_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_WorksheetMaster_Idn">
<span<?php echo $Products_list->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $Products_list->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn" <?php echo $Products_list->WorksheetCategory_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_WorksheetCategory_Idn" class="form-group">
<?php $Products_list->WorksheetCategory_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $Products_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $Products_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Products_list->WorksheetCategory_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_list->WorksheetCategory_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_WorksheetCategory_Idn" name="o<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($Products_list->WorksheetCategory_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_WorksheetCategory_Idn" class="form-group">
<?php $Products_list->WorksheetCategory_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $Products_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $Products_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Products_list->WorksheetCategory_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_list->WorksheetCategory_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_WorksheetCategory_Idn">
<span<?php echo $Products_list->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $Products_list->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
		<td data-name="Manufacturer_Idn" <?php echo $Products_list->Manufacturer_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Manufacturer_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Manufacturer_Idn" data-value-separator="<?php echo $Products_list->Manufacturer_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn" name="x<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn"<?php echo $Products_list->Manufacturer_Idn->editAttributes() ?>>
			<?php echo $Products_list->Manufacturer_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Manufacturer_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Manufacturer_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Manufacturer_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Manufacturer_Idn" name="o<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn" id="o<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn" value="<?php echo HtmlEncode($Products_list->Manufacturer_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Manufacturer_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Manufacturer_Idn" data-value-separator="<?php echo $Products_list->Manufacturer_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn" name="x<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn"<?php echo $Products_list->Manufacturer_Idn->editAttributes() ?>>
			<?php echo $Products_list->Manufacturer_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Manufacturer_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Manufacturer_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Manufacturer_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Manufacturer_Idn">
<span<?php echo $Products_list->Manufacturer_Idn->viewAttributes() ?>><?php echo $Products_list->Manufacturer_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $Products_list->Rank->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Rank" class="form-group">
<input type="text" data-table="Products" data-field="x_Rank" name="x<?php echo $Products_list->RowIndex ?>_Rank" id="x<?php echo $Products_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Products_list->Rank->EditValue ?>"<?php echo $Products_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_Rank" name="o<?php echo $Products_list->RowIndex ?>_Rank" id="o<?php echo $Products_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Products_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Rank" class="form-group">
<input type="text" data-table="Products" data-field="x_Rank" name="x<?php echo $Products_list->RowIndex ?>_Rank" id="x<?php echo $Products_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Products_list->Rank->EditValue ?>"<?php echo $Products_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Rank">
<span<?php echo $Products_list->Rank->viewAttributes() ?>><?php echo $Products_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $Products_list->Name->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Name" class="form-group">
<input type="text" data-table="Products" data-field="x_Name" name="x<?php echo $Products_list->RowIndex ?>_Name" id="x<?php echo $Products_list->RowIndex ?>_Name" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($Products_list->Name->getPlaceHolder()) ?>" value="<?php echo $Products_list->Name->EditValue ?>"<?php echo $Products_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_Name" name="o<?php echo $Products_list->RowIndex ?>_Name" id="o<?php echo $Products_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Products_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Name" class="form-group">
<input type="text" data-table="Products" data-field="x_Name" name="x<?php echo $Products_list->RowIndex ?>_Name" id="x<?php echo $Products_list->RowIndex ?>_Name" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($Products_list->Name->getPlaceHolder()) ?>" value="<?php echo $Products_list->Name->EditValue ?>"<?php echo $Products_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Name">
<span<?php echo $Products_list->Name->viewAttributes() ?>><?php echo $Products_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->MaterialUnitPrice->Visible) { // MaterialUnitPrice ?>
		<td data-name="MaterialUnitPrice" <?php echo $Products_list->MaterialUnitPrice->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_MaterialUnitPrice" class="form-group">
<input type="text" data-table="Products" data-field="x_MaterialUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->MaterialUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->MaterialUnitPrice->EditValue ?>"<?php echo $Products_list->MaterialUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_MaterialUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" value="<?php echo HtmlEncode($Products_list->MaterialUnitPrice->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_MaterialUnitPrice" class="form-group">
<input type="text" data-table="Products" data-field="x_MaterialUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->MaterialUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->MaterialUnitPrice->EditValue ?>"<?php echo $Products_list->MaterialUnitPrice->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_MaterialUnitPrice">
<span<?php echo $Products_list->MaterialUnitPrice->viewAttributes() ?>><?php echo $Products_list->MaterialUnitPrice->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<td data-name="FieldUnitPrice" <?php echo $Products_list->FieldUnitPrice->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FieldUnitPrice" class="form-group">
<input type="text" data-table="Products" data-field="x_FieldUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->FieldUnitPrice->EditValue ?>"<?php echo $Products_list->FieldUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_FieldUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" value="<?php echo HtmlEncode($Products_list->FieldUnitPrice->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FieldUnitPrice" class="form-group">
<input type="text" data-table="Products" data-field="x_FieldUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->FieldUnitPrice->EditValue ?>"<?php echo $Products_list->FieldUnitPrice->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FieldUnitPrice">
<span<?php echo $Products_list->FieldUnitPrice->viewAttributes() ?>><?php echo $Products_list->FieldUnitPrice->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->ShopUnitPrice->Visible) { // ShopUnitPrice ?>
		<td data-name="ShopUnitPrice" <?php echo $Products_list->ShopUnitPrice->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ShopUnitPrice" class="form-group">
<input type="text" data-table="Products" data-field="x_ShopUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->ShopUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->ShopUnitPrice->EditValue ?>"<?php echo $Products_list->ShopUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_ShopUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" value="<?php echo HtmlEncode($Products_list->ShopUnitPrice->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ShopUnitPrice" class="form-group">
<input type="text" data-table="Products" data-field="x_ShopUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->ShopUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->ShopUnitPrice->EditValue ?>"<?php echo $Products_list->ShopUnitPrice->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ShopUnitPrice">
<span<?php echo $Products_list->ShopUnitPrice->viewAttributes() ?>><?php echo $Products_list->ShopUnitPrice->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->EngineerUnitPrice->Visible) { // EngineerUnitPrice ?>
		<td data-name="EngineerUnitPrice" <?php echo $Products_list->EngineerUnitPrice->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_EngineerUnitPrice" class="form-group">
<input type="text" data-table="Products" data-field="x_EngineerUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->EngineerUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->EngineerUnitPrice->EditValue ?>"<?php echo $Products_list->EngineerUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_EngineerUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" value="<?php echo HtmlEncode($Products_list->EngineerUnitPrice->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_EngineerUnitPrice" class="form-group">
<input type="text" data-table="Products" data-field="x_EngineerUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->EngineerUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->EngineerUnitPrice->EditValue ?>"<?php echo $Products_list->EngineerUnitPrice->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_EngineerUnitPrice">
<span<?php echo $Products_list->EngineerUnitPrice->viewAttributes() ?>><?php echo $Products_list->EngineerUnitPrice->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->DefaultQuantity->Visible) { // DefaultQuantity ?>
		<td data-name="DefaultQuantity" <?php echo $Products_list->DefaultQuantity->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_DefaultQuantity" class="form-group">
<input type="text" data-table="Products" data-field="x_DefaultQuantity" name="x<?php echo $Products_list->RowIndex ?>_DefaultQuantity" id="x<?php echo $Products_list->RowIndex ?>_DefaultQuantity" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->DefaultQuantity->getPlaceHolder()) ?>" value="<?php echo $Products_list->DefaultQuantity->EditValue ?>"<?php echo $Products_list->DefaultQuantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_DefaultQuantity" name="o<?php echo $Products_list->RowIndex ?>_DefaultQuantity" id="o<?php echo $Products_list->RowIndex ?>_DefaultQuantity" value="<?php echo HtmlEncode($Products_list->DefaultQuantity->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_DefaultQuantity" class="form-group">
<input type="text" data-table="Products" data-field="x_DefaultQuantity" name="x<?php echo $Products_list->RowIndex ?>_DefaultQuantity" id="x<?php echo $Products_list->RowIndex ?>_DefaultQuantity" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->DefaultQuantity->getPlaceHolder()) ?>" value="<?php echo $Products_list->DefaultQuantity->EditValue ?>"<?php echo $Products_list->DefaultQuantity->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_DefaultQuantity">
<span<?php echo $Products_list->DefaultQuantity->viewAttributes() ?>><?php echo $Products_list->DefaultQuantity->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td data-name="ProductSize_Idn" <?php echo $Products_list->ProductSize_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ProductSize_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $Products_list->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ProductSize_Idn" name="x<?php echo $Products_list->RowIndex ?>_ProductSize_Idn"<?php echo $Products_list->ProductSize_Idn->editAttributes() ?>>
			<?php echo $Products_list->ProductSize_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ProductSize_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ProductSize_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ProductSize_Idn" name="o<?php echo $Products_list->RowIndex ?>_ProductSize_Idn" id="o<?php echo $Products_list->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($Products_list->ProductSize_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ProductSize_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $Products_list->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ProductSize_Idn" name="x<?php echo $Products_list->RowIndex ?>_ProductSize_Idn"<?php echo $Products_list->ProductSize_Idn->editAttributes() ?>>
			<?php echo $Products_list->ProductSize_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ProductSize_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ProductSize_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ProductSize_Idn">
<span<?php echo $Products_list->ProductSize_Idn->viewAttributes() ?>><?php echo $Products_list->ProductSize_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->Description->Visible) { // Description ?>
		<td data-name="Description" <?php echo $Products_list->Description->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Description" class="form-group">
<textarea data-table="Products" data-field="x_Description" name="x<?php echo $Products_list->RowIndex ?>_Description" id="x<?php echo $Products_list->RowIndex ?>_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($Products_list->Description->getPlaceHolder()) ?>"<?php echo $Products_list->Description->editAttributes() ?>><?php echo $Products_list->Description->EditValue ?></textarea>
</span>
<input type="hidden" data-table="Products" data-field="x_Description" name="o<?php echo $Products_list->RowIndex ?>_Description" id="o<?php echo $Products_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($Products_list->Description->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Description" class="form-group">
<textarea data-table="Products" data-field="x_Description" name="x<?php echo $Products_list->RowIndex ?>_Description" id="x<?php echo $Products_list->RowIndex ?>_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($Products_list->Description->getPlaceHolder()) ?>"<?php echo $Products_list->Description->editAttributes() ?>><?php echo $Products_list->Description->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Description">
<span<?php echo $Products_list->Description->viewAttributes() ?>><?php echo $Products_list->Description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td data-name="PipeType_Idn" <?php echo $Products_list->PipeType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_PipeType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PipeType_Idn" data-value-separator="<?php echo $Products_list->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_PipeType_Idn" name="x<?php echo $Products_list->RowIndex ?>_PipeType_Idn"<?php echo $Products_list->PipeType_Idn->editAttributes() ?>>
			<?php echo $Products_list->PipeType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_PipeType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->PipeType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_PipeType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_PipeType_Idn" name="o<?php echo $Products_list->RowIndex ?>_PipeType_Idn" id="o<?php echo $Products_list->RowIndex ?>_PipeType_Idn" value="<?php echo HtmlEncode($Products_list->PipeType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_PipeType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PipeType_Idn" data-value-separator="<?php echo $Products_list->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_PipeType_Idn" name="x<?php echo $Products_list->RowIndex ?>_PipeType_Idn"<?php echo $Products_list->PipeType_Idn->editAttributes() ?>>
			<?php echo $Products_list->PipeType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_PipeType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->PipeType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_PipeType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_PipeType_Idn">
<span<?php echo $Products_list->PipeType_Idn->viewAttributes() ?>><?php echo $Products_list->PipeType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
		<td data-name="ScheduleType_Idn" <?php echo $Products_list->ScheduleType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ScheduleType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ScheduleType_Idn" data-value-separator="<?php echo $Products_list->ScheduleType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn" name="x<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn"<?php echo $Products_list->ScheduleType_Idn->editAttributes() ?>>
			<?php echo $Products_list->ScheduleType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ScheduleType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ScheduleType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ScheduleType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ScheduleType_Idn" name="o<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn" id="o<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn" value="<?php echo HtmlEncode($Products_list->ScheduleType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ScheduleType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ScheduleType_Idn" data-value-separator="<?php echo $Products_list->ScheduleType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn" name="x<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn"<?php echo $Products_list->ScheduleType_Idn->editAttributes() ?>>
			<?php echo $Products_list->ScheduleType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ScheduleType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ScheduleType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ScheduleType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ScheduleType_Idn">
<span<?php echo $Products_list->ScheduleType_Idn->viewAttributes() ?>><?php echo $Products_list->ScheduleType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->Fitting_Idn->Visible) { // Fitting_Idn ?>
		<td data-name="Fitting_Idn" <?php echo $Products_list->Fitting_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Fitting_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Fitting_Idn" data-value-separator="<?php echo $Products_list->Fitting_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Fitting_Idn" name="x<?php echo $Products_list->RowIndex ?>_Fitting_Idn"<?php echo $Products_list->Fitting_Idn->editAttributes() ?>>
			<?php echo $Products_list->Fitting_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Fitting_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Fitting_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Fitting_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Fitting_Idn" name="o<?php echo $Products_list->RowIndex ?>_Fitting_Idn" id="o<?php echo $Products_list->RowIndex ?>_Fitting_Idn" value="<?php echo HtmlEncode($Products_list->Fitting_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Fitting_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Fitting_Idn" data-value-separator="<?php echo $Products_list->Fitting_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Fitting_Idn" name="x<?php echo $Products_list->RowIndex ?>_Fitting_Idn"<?php echo $Products_list->Fitting_Idn->editAttributes() ?>>
			<?php echo $Products_list->Fitting_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Fitting_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Fitting_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Fitting_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Fitting_Idn">
<span<?php echo $Products_list->Fitting_Idn->viewAttributes() ?>><?php echo $Products_list->Fitting_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
		<td data-name="GroovedFittingType_Idn" <?php echo $Products_list->GroovedFittingType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_GroovedFittingType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GroovedFittingType_Idn" data-value-separator="<?php echo $Products_list->GroovedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn" name="x<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn"<?php echo $Products_list->GroovedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_list->GroovedFittingType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_GroovedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->GroovedFittingType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_GroovedFittingType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_GroovedFittingType_Idn" name="o<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn" id="o<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn" value="<?php echo HtmlEncode($Products_list->GroovedFittingType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_GroovedFittingType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GroovedFittingType_Idn" data-value-separator="<?php echo $Products_list->GroovedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn" name="x<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn"<?php echo $Products_list->GroovedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_list->GroovedFittingType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_GroovedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->GroovedFittingType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_GroovedFittingType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_GroovedFittingType_Idn">
<span<?php echo $Products_list->GroovedFittingType_Idn->viewAttributes() ?>><?php echo $Products_list->GroovedFittingType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
		<td data-name="ThreadedFittingType_Idn" <?php echo $Products_list->ThreadedFittingType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ThreadedFittingType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ThreadedFittingType_Idn" data-value-separator="<?php echo $Products_list->ThreadedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn" name="x<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn"<?php echo $Products_list->ThreadedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_list->ThreadedFittingType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ThreadedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ThreadedFittingType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ThreadedFittingType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ThreadedFittingType_Idn" name="o<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn" id="o<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn" value="<?php echo HtmlEncode($Products_list->ThreadedFittingType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ThreadedFittingType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ThreadedFittingType_Idn" data-value-separator="<?php echo $Products_list->ThreadedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn" name="x<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn"<?php echo $Products_list->ThreadedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_list->ThreadedFittingType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ThreadedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ThreadedFittingType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ThreadedFittingType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ThreadedFittingType_Idn">
<span<?php echo $Products_list->ThreadedFittingType_Idn->viewAttributes() ?>><?php echo $Products_list->ThreadedFittingType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td data-name="HangerType_Idn" <?php echo $Products_list->HangerType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_HangerType_Idn" class="form-group">
<?php $Products_list->HangerType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerType_Idn" data-value-separator="<?php echo $Products_list->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HangerType_Idn"<?php echo $Products_list->HangerType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HangerType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HangerType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HangerType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HangerType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_HangerType_Idn" name="o<?php echo $Products_list->RowIndex ?>_HangerType_Idn" id="o<?php echo $Products_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($Products_list->HangerType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_HangerType_Idn" class="form-group">
<?php $Products_list->HangerType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerType_Idn" data-value-separator="<?php echo $Products_list->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HangerType_Idn"<?php echo $Products_list->HangerType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HangerType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HangerType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HangerType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HangerType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_HangerType_Idn">
<span<?php echo $Products_list->HangerType_Idn->viewAttributes() ?>><?php echo $Products_list->HangerType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<td data-name="HangerSubType_Idn" <?php echo $Products_list->HangerSubType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_HangerSubType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerSubType_Idn" data-value-separator="<?php echo $Products_list->HangerSubType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn"<?php echo $Products_list->HangerSubType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HangerSubType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HangerSubType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HangerSubType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HangerSubType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_HangerSubType_Idn" name="o<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn" id="o<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($Products_list->HangerSubType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_HangerSubType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerSubType_Idn" data-value-separator="<?php echo $Products_list->HangerSubType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn"<?php echo $Products_list->HangerSubType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HangerSubType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HangerSubType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HangerSubType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HangerSubType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_HangerSubType_Idn">
<span<?php echo $Products_list->HangerSubType_Idn->viewAttributes() ?>><?php echo $Products_list->HangerSubType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->SubcontractCategory_Idn->Visible) { // SubcontractCategory_Idn ?>
		<td data-name="SubcontractCategory_Idn" <?php echo $Products_list->SubcontractCategory_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_SubcontractCategory_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_SubcontractCategory_Idn" data-value-separator="<?php echo $Products_list->SubcontractCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn" name="x<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn"<?php echo $Products_list->SubcontractCategory_Idn->editAttributes() ?>>
			<?php echo $Products_list->SubcontractCategory_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_SubcontractCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_list->SubcontractCategory_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_SubcontractCategory_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_SubcontractCategory_Idn" name="o<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn" id="o<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn" value="<?php echo HtmlEncode($Products_list->SubcontractCategory_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_SubcontractCategory_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_SubcontractCategory_Idn" data-value-separator="<?php echo $Products_list->SubcontractCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn" name="x<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn"<?php echo $Products_list->SubcontractCategory_Idn->editAttributes() ?>>
			<?php echo $Products_list->SubcontractCategory_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_SubcontractCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_list->SubcontractCategory_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_SubcontractCategory_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_SubcontractCategory_Idn">
<span<?php echo $Products_list->SubcontractCategory_Idn->viewAttributes() ?>><?php echo $Products_list->SubcontractCategory_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->ApplyToAdjustmentFactorsFlag->Visible) { // ApplyToAdjustmentFactorsFlag ?>
		<td data-name="ApplyToAdjustmentFactorsFlag" <?php echo $Products_list->ApplyToAdjustmentFactorsFlag->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ApplyToAdjustmentFactorsFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->ApplyToAdjustmentFactorsFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToAdjustmentFactorsFlag" name="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]_412576" value="1"<?php echo $selwrk ?><?php echo $Products_list->ApplyToAdjustmentFactorsFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]_412576"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ApplyToAdjustmentFactorsFlag" name="o<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]" value="<?php echo HtmlEncode($Products_list->ApplyToAdjustmentFactorsFlag->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ApplyToAdjustmentFactorsFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->ApplyToAdjustmentFactorsFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToAdjustmentFactorsFlag" name="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]_277810" value="1"<?php echo $selwrk ?><?php echo $Products_list->ApplyToAdjustmentFactorsFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]_277810"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ApplyToAdjustmentFactorsFlag">
<span<?php echo $Products_list->ApplyToAdjustmentFactorsFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ApplyToAdjustmentFactorsFlag" class="custom-control-input" value="<?php echo $Products_list->ApplyToAdjustmentFactorsFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->ApplyToAdjustmentFactorsFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ApplyToAdjustmentFactorsFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->ApplyToContingencyFlag->Visible) { // ApplyToContingencyFlag ?>
		<td data-name="ApplyToContingencyFlag" <?php echo $Products_list->ApplyToContingencyFlag->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ApplyToContingencyFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->ApplyToContingencyFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToContingencyFlag" name="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]_917710" value="1"<?php echo $selwrk ?><?php echo $Products_list->ApplyToContingencyFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]_917710"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ApplyToContingencyFlag" name="o<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]" value="<?php echo HtmlEncode($Products_list->ApplyToContingencyFlag->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ApplyToContingencyFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->ApplyToContingencyFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToContingencyFlag" name="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]_412533" value="1"<?php echo $selwrk ?><?php echo $Products_list->ApplyToContingencyFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]_412533"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ApplyToContingencyFlag">
<span<?php echo $Products_list->ApplyToContingencyFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ApplyToContingencyFlag" class="custom-control-input" value="<?php echo $Products_list->ApplyToContingencyFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->ApplyToContingencyFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ApplyToContingencyFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->IsMainComponent->Visible) { // IsMainComponent ?>
		<td data-name="IsMainComponent" <?php echo $Products_list->IsMainComponent->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsMainComponent" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->IsMainComponent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsMainComponent" name="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]" id="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]_237709" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsMainComponent->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]_237709"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsMainComponent" name="o<?php echo $Products_list->RowIndex ?>_IsMainComponent[]" id="o<?php echo $Products_list->RowIndex ?>_IsMainComponent[]" value="<?php echo HtmlEncode($Products_list->IsMainComponent->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsMainComponent" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->IsMainComponent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsMainComponent" name="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]" id="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]_384387" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsMainComponent->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]_384387"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsMainComponent">
<span<?php echo $Products_list->IsMainComponent->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsMainComponent" class="custom-control-input" value="<?php echo $Products_list->IsMainComponent->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->IsMainComponent->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsMainComponent"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->DomesticFlag->Visible) { // DomesticFlag ?>
		<td data-name="DomesticFlag" <?php echo $Products_list->DomesticFlag->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_DomesticFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->DomesticFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_DomesticFlag" name="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]" id="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]_866820" value="1"<?php echo $selwrk ?><?php echo $Products_list->DomesticFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]_866820"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_DomesticFlag" name="o<?php echo $Products_list->RowIndex ?>_DomesticFlag[]" id="o<?php echo $Products_list->RowIndex ?>_DomesticFlag[]" value="<?php echo HtmlEncode($Products_list->DomesticFlag->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_DomesticFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->DomesticFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_DomesticFlag" name="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]" id="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]_177633" value="1"<?php echo $selwrk ?><?php echo $Products_list->DomesticFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]_177633"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_DomesticFlag">
<span<?php echo $Products_list->DomesticFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DomesticFlag" class="custom-control-input" value="<?php echo $Products_list->DomesticFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->DomesticFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DomesticFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->LoadFlag->Visible) { // LoadFlag ?>
		<td data-name="LoadFlag" <?php echo $Products_list->LoadFlag->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_LoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_LoadFlag" name="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]" id="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]_842517" value="1"<?php echo $selwrk ?><?php echo $Products_list->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]_842517"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_LoadFlag" name="o<?php echo $Products_list->RowIndex ?>_LoadFlag[]" id="o<?php echo $Products_list->RowIndex ?>_LoadFlag[]" value="<?php echo HtmlEncode($Products_list->LoadFlag->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_LoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_LoadFlag" name="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]" id="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]_771553" value="1"<?php echo $selwrk ?><?php echo $Products_list->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]_771553"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_LoadFlag">
<span<?php echo $Products_list->LoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LoadFlag" class="custom-control-input" value="<?php echo $Products_list->LoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->LoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LoadFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<td data-name="AutoLoadFlag" <?php echo $Products_list->AutoLoadFlag->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_AutoLoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_AutoLoadFlag" name="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]" id="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]_726958" value="1"<?php echo $selwrk ?><?php echo $Products_list->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]_726958"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_AutoLoadFlag" name="o<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]" id="o<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]" value="<?php echo HtmlEncode($Products_list->AutoLoadFlag->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_AutoLoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_AutoLoadFlag" name="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]" id="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]_725933" value="1"<?php echo $selwrk ?><?php echo $Products_list->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]_725933"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_AutoLoadFlag">
<span<?php echo $Products_list->AutoLoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AutoLoadFlag" class="custom-control-input" value="<?php echo $Products_list->AutoLoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->AutoLoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AutoLoadFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $Products_list->ActiveFlag->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ActiveFlag" name="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]_530020" value="1"<?php echo $selwrk ?><?php echo $Products_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]_530020"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ActiveFlag" name="o<?php echo $Products_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Products_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ActiveFlag" name="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]_984813" value="1"<?php echo $selwrk ?><?php echo $Products_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]_984813"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ActiveFlag">
<span<?php echo $Products_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Products_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->GradeType_Idn->Visible) { // GradeType_Idn ?>
		<td data-name="GradeType_Idn" <?php echo $Products_list->GradeType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_GradeType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GradeType_Idn" data-value-separator="<?php echo $Products_list->GradeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_GradeType_Idn" name="x<?php echo $Products_list->RowIndex ?>_GradeType_Idn"<?php echo $Products_list->GradeType_Idn->editAttributes() ?>>
			<?php echo $Products_list->GradeType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_GradeType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->GradeType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_GradeType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_GradeType_Idn" name="o<?php echo $Products_list->RowIndex ?>_GradeType_Idn" id="o<?php echo $Products_list->RowIndex ?>_GradeType_Idn" value="<?php echo HtmlEncode($Products_list->GradeType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_GradeType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GradeType_Idn" data-value-separator="<?php echo $Products_list->GradeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_GradeType_Idn" name="x<?php echo $Products_list->RowIndex ?>_GradeType_Idn"<?php echo $Products_list->GradeType_Idn->editAttributes() ?>>
			<?php echo $Products_list->GradeType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_GradeType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->GradeType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_GradeType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_GradeType_Idn">
<span<?php echo $Products_list->GradeType_Idn->viewAttributes() ?>><?php echo $Products_list->GradeType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->PressureType_Idn->Visible) { // PressureType_Idn ?>
		<td data-name="PressureType_Idn" <?php echo $Products_list->PressureType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_PressureType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PressureType_Idn" data-value-separator="<?php echo $Products_list->PressureType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_PressureType_Idn" name="x<?php echo $Products_list->RowIndex ?>_PressureType_Idn"<?php echo $Products_list->PressureType_Idn->editAttributes() ?>>
			<?php echo $Products_list->PressureType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_PressureType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->PressureType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_PressureType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_PressureType_Idn" name="o<?php echo $Products_list->RowIndex ?>_PressureType_Idn" id="o<?php echo $Products_list->RowIndex ?>_PressureType_Idn" value="<?php echo HtmlEncode($Products_list->PressureType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_PressureType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PressureType_Idn" data-value-separator="<?php echo $Products_list->PressureType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_PressureType_Idn" name="x<?php echo $Products_list->RowIndex ?>_PressureType_Idn"<?php echo $Products_list->PressureType_Idn->editAttributes() ?>>
			<?php echo $Products_list->PressureType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_PressureType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->PressureType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_PressureType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_PressureType_Idn">
<span<?php echo $Products_list->PressureType_Idn->viewAttributes() ?>><?php echo $Products_list->PressureType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->SeamlessFlag->Visible) { // SeamlessFlag ?>
		<td data-name="SeamlessFlag" <?php echo $Products_list->SeamlessFlag->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_SeamlessFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->SeamlessFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_SeamlessFlag" name="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]" id="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]_819609" value="1"<?php echo $selwrk ?><?php echo $Products_list->SeamlessFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]_819609"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_SeamlessFlag" name="o<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]" id="o<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]" value="<?php echo HtmlEncode($Products_list->SeamlessFlag->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_SeamlessFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->SeamlessFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_SeamlessFlag" name="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]" id="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]_308304" value="1"<?php echo $selwrk ?><?php echo $Products_list->SeamlessFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]_308304"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_SeamlessFlag">
<span<?php echo $Products_list->SeamlessFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_SeamlessFlag" class="custom-control-input" value="<?php echo $Products_list->SeamlessFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->SeamlessFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_SeamlessFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->ResponseType->Visible) { // ResponseType ?>
		<td data-name="ResponseType" <?php echo $Products_list->ResponseType->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ResponseType" class="form-group">
<div id="tp_x<?php echo $Products_list->RowIndex ?>_ResponseType" class="ew-template"><input type="radio" class="custom-control-input" data-table="Products" data-field="x_ResponseType" data-value-separator="<?php echo $Products_list->ResponseType->displayValueSeparatorAttribute() ?>" name="x<?php echo $Products_list->RowIndex ?>_ResponseType" id="x<?php echo $Products_list->RowIndex ?>_ResponseType" value="{value}"<?php echo $Products_list->ResponseType->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Products_list->RowIndex ?>_ResponseType" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Products_list->ResponseType->radioButtonListHtml(FALSE, "x{$Products_list->RowIndex}_ResponseType") ?>
</div></div>
</span>
<input type="hidden" data-table="Products" data-field="x_ResponseType" name="o<?php echo $Products_list->RowIndex ?>_ResponseType" id="o<?php echo $Products_list->RowIndex ?>_ResponseType" value="<?php echo HtmlEncode($Products_list->ResponseType->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ResponseType" class="form-group">
<div id="tp_x<?php echo $Products_list->RowIndex ?>_ResponseType" class="ew-template"><input type="radio" class="custom-control-input" data-table="Products" data-field="x_ResponseType" data-value-separator="<?php echo $Products_list->ResponseType->displayValueSeparatorAttribute() ?>" name="x<?php echo $Products_list->RowIndex ?>_ResponseType" id="x<?php echo $Products_list->RowIndex ?>_ResponseType" value="{value}"<?php echo $Products_list->ResponseType->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Products_list->RowIndex ?>_ResponseType" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Products_list->ResponseType->radioButtonListHtml(FALSE, "x{$Products_list->RowIndex}_ResponseType") ?>
</div></div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ResponseType">
<span<?php echo $Products_list->ResponseType->viewAttributes() ?>><?php echo $Products_list->ResponseType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->FMJobFlag->Visible) { // FMJobFlag ?>
		<td data-name="FMJobFlag" <?php echo $Products_list->FMJobFlag->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FMJobFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->FMJobFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_FMJobFlag" name="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]" id="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]_322301" value="1"<?php echo $selwrk ?><?php echo $Products_list->FMJobFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]_322301"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_FMJobFlag" name="o<?php echo $Products_list->RowIndex ?>_FMJobFlag[]" id="o<?php echo $Products_list->RowIndex ?>_FMJobFlag[]" value="<?php echo HtmlEncode($Products_list->FMJobFlag->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FMJobFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->FMJobFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_FMJobFlag" name="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]" id="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]_725143" value="1"<?php echo $selwrk ?><?php echo $Products_list->FMJobFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]_725143"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FMJobFlag">
<span<?php echo $Products_list->FMJobFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_FMJobFlag" class="custom-control-input" value="<?php echo $Products_list->FMJobFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->FMJobFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_FMJobFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->RecommendedBoxes->Visible) { // RecommendedBoxes ?>
		<td data-name="RecommendedBoxes" <?php echo $Products_list->RecommendedBoxes->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_RecommendedBoxes" class="form-group">
<input type="text" data-table="Products" data-field="x_RecommendedBoxes" name="x<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" id="x<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->RecommendedBoxes->getPlaceHolder()) ?>" value="<?php echo $Products_list->RecommendedBoxes->EditValue ?>"<?php echo $Products_list->RecommendedBoxes->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_RecommendedBoxes" name="o<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" id="o<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" value="<?php echo HtmlEncode($Products_list->RecommendedBoxes->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_RecommendedBoxes" class="form-group">
<input type="text" data-table="Products" data-field="x_RecommendedBoxes" name="x<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" id="x<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->RecommendedBoxes->getPlaceHolder()) ?>" value="<?php echo $Products_list->RecommendedBoxes->EditValue ?>"<?php echo $Products_list->RecommendedBoxes->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_RecommendedBoxes">
<span<?php echo $Products_list->RecommendedBoxes->viewAttributes() ?>><?php echo $Products_list->RecommendedBoxes->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->RecommendedWireFootage->Visible) { // RecommendedWireFootage ?>
		<td data-name="RecommendedWireFootage" <?php echo $Products_list->RecommendedWireFootage->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_RecommendedWireFootage" class="form-group">
<input type="text" data-table="Products" data-field="x_RecommendedWireFootage" name="x<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" id="x<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->RecommendedWireFootage->getPlaceHolder()) ?>" value="<?php echo $Products_list->RecommendedWireFootage->EditValue ?>"<?php echo $Products_list->RecommendedWireFootage->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_RecommendedWireFootage" name="o<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" id="o<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" value="<?php echo HtmlEncode($Products_list->RecommendedWireFootage->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_RecommendedWireFootage" class="form-group">
<input type="text" data-table="Products" data-field="x_RecommendedWireFootage" name="x<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" id="x<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->RecommendedWireFootage->getPlaceHolder()) ?>" value="<?php echo $Products_list->RecommendedWireFootage->EditValue ?>"<?php echo $Products_list->RecommendedWireFootage->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_RecommendedWireFootage">
<span<?php echo $Products_list->RecommendedWireFootage->viewAttributes() ?>><?php echo $Products_list->RecommendedWireFootage->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
		<td data-name="CoverageType_Idn" <?php echo $Products_list->CoverageType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_CoverageType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CoverageType_Idn" data-value-separator="<?php echo $Products_list->CoverageType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_CoverageType_Idn" name="x<?php echo $Products_list->RowIndex ?>_CoverageType_Idn"<?php echo $Products_list->CoverageType_Idn->editAttributes() ?>>
			<?php echo $Products_list->CoverageType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_CoverageType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->CoverageType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_CoverageType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_CoverageType_Idn" name="o<?php echo $Products_list->RowIndex ?>_CoverageType_Idn" id="o<?php echo $Products_list->RowIndex ?>_CoverageType_Idn" value="<?php echo HtmlEncode($Products_list->CoverageType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_CoverageType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CoverageType_Idn" data-value-separator="<?php echo $Products_list->CoverageType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_CoverageType_Idn" name="x<?php echo $Products_list->RowIndex ?>_CoverageType_Idn"<?php echo $Products_list->CoverageType_Idn->editAttributes() ?>>
			<?php echo $Products_list->CoverageType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_CoverageType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->CoverageType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_CoverageType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_CoverageType_Idn">
<span<?php echo $Products_list->CoverageType_Idn->viewAttributes() ?>><?php echo $Products_list->CoverageType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->HeadType_Idn->Visible) { // HeadType_Idn ?>
		<td data-name="HeadType_Idn" <?php echo $Products_list->HeadType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_HeadType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HeadType_Idn" data-value-separator="<?php echo $Products_list->HeadType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HeadType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HeadType_Idn"<?php echo $Products_list->HeadType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HeadType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HeadType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HeadType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HeadType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_HeadType_Idn" name="o<?php echo $Products_list->RowIndex ?>_HeadType_Idn" id="o<?php echo $Products_list->RowIndex ?>_HeadType_Idn" value="<?php echo HtmlEncode($Products_list->HeadType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_HeadType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HeadType_Idn" data-value-separator="<?php echo $Products_list->HeadType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HeadType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HeadType_Idn"<?php echo $Products_list->HeadType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HeadType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HeadType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HeadType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HeadType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_HeadType_Idn">
<span<?php echo $Products_list->HeadType_Idn->viewAttributes() ?>><?php echo $Products_list->HeadType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->FinishType_Idn->Visible) { // FinishType_Idn ?>
		<td data-name="FinishType_Idn" <?php echo $Products_list->FinishType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FinishType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FinishType_Idn" data-value-separator="<?php echo $Products_list->FinishType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FinishType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FinishType_Idn"<?php echo $Products_list->FinishType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FinishType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FinishType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FinishType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FinishType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_FinishType_Idn" name="o<?php echo $Products_list->RowIndex ?>_FinishType_Idn" id="o<?php echo $Products_list->RowIndex ?>_FinishType_Idn" value="<?php echo HtmlEncode($Products_list->FinishType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FinishType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FinishType_Idn" data-value-separator="<?php echo $Products_list->FinishType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FinishType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FinishType_Idn"<?php echo $Products_list->FinishType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FinishType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FinishType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FinishType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FinishType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FinishType_Idn">
<span<?php echo $Products_list->FinishType_Idn->viewAttributes() ?>><?php echo $Products_list->FinishType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->Outlet_Idn->Visible) { // Outlet_Idn ?>
		<td data-name="Outlet_Idn" <?php echo $Products_list->Outlet_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Outlet_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Outlet_Idn" data-value-separator="<?php echo $Products_list->Outlet_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Outlet_Idn" name="x<?php echo $Products_list->RowIndex ?>_Outlet_Idn"<?php echo $Products_list->Outlet_Idn->editAttributes() ?>>
			<?php echo $Products_list->Outlet_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Outlet_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Outlet_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Outlet_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Outlet_Idn" name="o<?php echo $Products_list->RowIndex ?>_Outlet_Idn" id="o<?php echo $Products_list->RowIndex ?>_Outlet_Idn" value="<?php echo HtmlEncode($Products_list->Outlet_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Outlet_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Outlet_Idn" data-value-separator="<?php echo $Products_list->Outlet_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Outlet_Idn" name="x<?php echo $Products_list->RowIndex ?>_Outlet_Idn"<?php echo $Products_list->Outlet_Idn->editAttributes() ?>>
			<?php echo $Products_list->Outlet_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Outlet_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Outlet_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Outlet_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Outlet_Idn">
<span<?php echo $Products_list->Outlet_Idn->viewAttributes() ?>><?php echo $Products_list->Outlet_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->RiserType_Idn->Visible) { // RiserType_Idn ?>
		<td data-name="RiserType_Idn" <?php echo $Products_list->RiserType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_RiserType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_RiserType_Idn" data-value-separator="<?php echo $Products_list->RiserType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_RiserType_Idn" name="x<?php echo $Products_list->RowIndex ?>_RiserType_Idn"<?php echo $Products_list->RiserType_Idn->editAttributes() ?>>
			<?php echo $Products_list->RiserType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_RiserType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->RiserType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_RiserType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_RiserType_Idn" name="o<?php echo $Products_list->RowIndex ?>_RiserType_Idn" id="o<?php echo $Products_list->RowIndex ?>_RiserType_Idn" value="<?php echo HtmlEncode($Products_list->RiserType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_RiserType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_RiserType_Idn" data-value-separator="<?php echo $Products_list->RiserType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_RiserType_Idn" name="x<?php echo $Products_list->RowIndex ?>_RiserType_Idn"<?php echo $Products_list->RiserType_Idn->editAttributes() ?>>
			<?php echo $Products_list->RiserType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_RiserType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->RiserType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_RiserType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_RiserType_Idn">
<span<?php echo $Products_list->RiserType_Idn->viewAttributes() ?>><?php echo $Products_list->RiserType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->BackFlowType_Idn->Visible) { // BackFlowType_Idn ?>
		<td data-name="BackFlowType_Idn" <?php echo $Products_list->BackFlowType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_BackFlowType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BackFlowType_Idn" data-value-separator="<?php echo $Products_list->BackFlowType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn" name="x<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn"<?php echo $Products_list->BackFlowType_Idn->editAttributes() ?>>
			<?php echo $Products_list->BackFlowType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_BackFlowType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->BackFlowType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_BackFlowType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_BackFlowType_Idn" name="o<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn" id="o<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn" value="<?php echo HtmlEncode($Products_list->BackFlowType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_BackFlowType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BackFlowType_Idn" data-value-separator="<?php echo $Products_list->BackFlowType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn" name="x<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn"<?php echo $Products_list->BackFlowType_Idn->editAttributes() ?>>
			<?php echo $Products_list->BackFlowType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_BackFlowType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->BackFlowType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_BackFlowType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_BackFlowType_Idn">
<span<?php echo $Products_list->BackFlowType_Idn->viewAttributes() ?>><?php echo $Products_list->BackFlowType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
		<td data-name="ControlValve_Idn" <?php echo $Products_list->ControlValve_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ControlValve_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ControlValve_Idn" data-value-separator="<?php echo $Products_list->ControlValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ControlValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_ControlValve_Idn"<?php echo $Products_list->ControlValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->ControlValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ControlValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ControlValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ControlValve_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ControlValve_Idn" name="o<?php echo $Products_list->RowIndex ?>_ControlValve_Idn" id="o<?php echo $Products_list->RowIndex ?>_ControlValve_Idn" value="<?php echo HtmlEncode($Products_list->ControlValve_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ControlValve_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ControlValve_Idn" data-value-separator="<?php echo $Products_list->ControlValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ControlValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_ControlValve_Idn"<?php echo $Products_list->ControlValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->ControlValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ControlValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ControlValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ControlValve_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ControlValve_Idn">
<span<?php echo $Products_list->ControlValve_Idn->viewAttributes() ?>><?php echo $Products_list->ControlValve_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
		<td data-name="CheckValve_Idn" <?php echo $Products_list->CheckValve_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_CheckValve_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CheckValve_Idn" data-value-separator="<?php echo $Products_list->CheckValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_CheckValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_CheckValve_Idn"<?php echo $Products_list->CheckValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->CheckValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_CheckValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->CheckValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_CheckValve_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_CheckValve_Idn" name="o<?php echo $Products_list->RowIndex ?>_CheckValve_Idn" id="o<?php echo $Products_list->RowIndex ?>_CheckValve_Idn" value="<?php echo HtmlEncode($Products_list->CheckValve_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_CheckValve_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CheckValve_Idn" data-value-separator="<?php echo $Products_list->CheckValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_CheckValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_CheckValve_Idn"<?php echo $Products_list->CheckValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->CheckValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_CheckValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->CheckValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_CheckValve_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_CheckValve_Idn">
<span<?php echo $Products_list->CheckValve_Idn->viewAttributes() ?>><?php echo $Products_list->CheckValve_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->FDCType_Idn->Visible) { // FDCType_Idn ?>
		<td data-name="FDCType_Idn" <?php echo $Products_list->FDCType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FDCType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FDCType_Idn" data-value-separator="<?php echo $Products_list->FDCType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FDCType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FDCType_Idn"<?php echo $Products_list->FDCType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FDCType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FDCType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FDCType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FDCType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_FDCType_Idn" name="o<?php echo $Products_list->RowIndex ?>_FDCType_Idn" id="o<?php echo $Products_list->RowIndex ?>_FDCType_Idn" value="<?php echo HtmlEncode($Products_list->FDCType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FDCType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FDCType_Idn" data-value-separator="<?php echo $Products_list->FDCType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FDCType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FDCType_Idn"<?php echo $Products_list->FDCType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FDCType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FDCType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FDCType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FDCType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FDCType_Idn">
<span<?php echo $Products_list->FDCType_Idn->viewAttributes() ?>><?php echo $Products_list->FDCType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->BellType_Idn->Visible) { // BellType_Idn ?>
		<td data-name="BellType_Idn" <?php echo $Products_list->BellType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_BellType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BellType_Idn" data-value-separator="<?php echo $Products_list->BellType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_BellType_Idn" name="x<?php echo $Products_list->RowIndex ?>_BellType_Idn"<?php echo $Products_list->BellType_Idn->editAttributes() ?>>
			<?php echo $Products_list->BellType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_BellType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->BellType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_BellType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_BellType_Idn" name="o<?php echo $Products_list->RowIndex ?>_BellType_Idn" id="o<?php echo $Products_list->RowIndex ?>_BellType_Idn" value="<?php echo HtmlEncode($Products_list->BellType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_BellType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BellType_Idn" data-value-separator="<?php echo $Products_list->BellType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_BellType_Idn" name="x<?php echo $Products_list->RowIndex ?>_BellType_Idn"<?php echo $Products_list->BellType_Idn->editAttributes() ?>>
			<?php echo $Products_list->BellType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_BellType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->BellType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_BellType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_BellType_Idn">
<span<?php echo $Products_list->BellType_Idn->viewAttributes() ?>><?php echo $Products_list->BellType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
		<td data-name="TappingTee_Idn" <?php echo $Products_list->TappingTee_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_TappingTee_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_TappingTee_Idn" data-value-separator="<?php echo $Products_list->TappingTee_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_TappingTee_Idn" name="x<?php echo $Products_list->RowIndex ?>_TappingTee_Idn"<?php echo $Products_list->TappingTee_Idn->editAttributes() ?>>
			<?php echo $Products_list->TappingTee_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_TappingTee_Idn") ?>
		</select>
</div>
<?php echo $Products_list->TappingTee_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_TappingTee_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_TappingTee_Idn" name="o<?php echo $Products_list->RowIndex ?>_TappingTee_Idn" id="o<?php echo $Products_list->RowIndex ?>_TappingTee_Idn" value="<?php echo HtmlEncode($Products_list->TappingTee_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_TappingTee_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_TappingTee_Idn" data-value-separator="<?php echo $Products_list->TappingTee_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_TappingTee_Idn" name="x<?php echo $Products_list->RowIndex ?>_TappingTee_Idn"<?php echo $Products_list->TappingTee_Idn->editAttributes() ?>>
			<?php echo $Products_list->TappingTee_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_TappingTee_Idn") ?>
		</select>
</div>
<?php echo $Products_list->TappingTee_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_TappingTee_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_TappingTee_Idn">
<span<?php echo $Products_list->TappingTee_Idn->viewAttributes() ?>><?php echo $Products_list->TappingTee_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
		<td data-name="UndergroundValve_Idn" <?php echo $Products_list->UndergroundValve_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_UndergroundValve_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_UndergroundValve_Idn" data-value-separator="<?php echo $Products_list->UndergroundValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn"<?php echo $Products_list->UndergroundValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->UndergroundValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_UndergroundValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->UndergroundValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_UndergroundValve_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_UndergroundValve_Idn" name="o<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn" id="o<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn" value="<?php echo HtmlEncode($Products_list->UndergroundValve_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_UndergroundValve_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_UndergroundValve_Idn" data-value-separator="<?php echo $Products_list->UndergroundValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn"<?php echo $Products_list->UndergroundValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->UndergroundValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_UndergroundValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->UndergroundValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_UndergroundValve_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_UndergroundValve_Idn">
<span<?php echo $Products_list->UndergroundValve_Idn->viewAttributes() ?>><?php echo $Products_list->UndergroundValve_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
		<td data-name="LiftDuration_Idn" <?php echo $Products_list->LiftDuration_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_LiftDuration_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_LiftDuration_Idn" data-value-separator="<?php echo $Products_list->LiftDuration_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn" name="x<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn"<?php echo $Products_list->LiftDuration_Idn->editAttributes() ?>>
			<?php echo $Products_list->LiftDuration_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_LiftDuration_Idn") ?>
		</select>
</div>
<?php echo $Products_list->LiftDuration_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_LiftDuration_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_LiftDuration_Idn" name="o<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn" id="o<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn" value="<?php echo HtmlEncode($Products_list->LiftDuration_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_LiftDuration_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_LiftDuration_Idn" data-value-separator="<?php echo $Products_list->LiftDuration_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn" name="x<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn"<?php echo $Products_list->LiftDuration_Idn->editAttributes() ?>>
			<?php echo $Products_list->LiftDuration_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_LiftDuration_Idn") ?>
		</select>
</div>
<?php echo $Products_list->LiftDuration_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_LiftDuration_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_LiftDuration_Idn">
<span<?php echo $Products_list->LiftDuration_Idn->viewAttributes() ?>><?php echo $Products_list->LiftDuration_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->TrimPackageFlag->Visible) { // TrimPackageFlag ?>
		<td data-name="TrimPackageFlag" <?php echo $Products_list->TrimPackageFlag->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_TrimPackageFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->TrimPackageFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_TrimPackageFlag" name="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]" id="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]_938603" value="1"<?php echo $selwrk ?><?php echo $Products_list->TrimPackageFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]_938603"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_TrimPackageFlag" name="o<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]" id="o<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]" value="<?php echo HtmlEncode($Products_list->TrimPackageFlag->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_TrimPackageFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->TrimPackageFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_TrimPackageFlag" name="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]" id="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]_758929" value="1"<?php echo $selwrk ?><?php echo $Products_list->TrimPackageFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]_758929"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_TrimPackageFlag">
<span<?php echo $Products_list->TrimPackageFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TrimPackageFlag" class="custom-control-input" value="<?php echo $Products_list->TrimPackageFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->TrimPackageFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TrimPackageFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->ListedFlag->Visible) { // ListedFlag ?>
		<td data-name="ListedFlag" <?php echo $Products_list->ListedFlag->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ListedFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->ListedFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ListedFlag" name="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]_704547" value="1"<?php echo $selwrk ?><?php echo $Products_list->ListedFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]_704547"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ListedFlag" name="o<?php echo $Products_list->RowIndex ?>_ListedFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ListedFlag[]" value="<?php echo HtmlEncode($Products_list->ListedFlag->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ListedFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->ListedFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ListedFlag" name="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]_206987" value="1"<?php echo $selwrk ?><?php echo $Products_list->ListedFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]_206987"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_ListedFlag">
<span<?php echo $Products_list->ListedFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ListedFlag" class="custom-control-input" value="<?php echo $Products_list->ListedFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->ListedFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ListedFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->BoxWireLength->Visible) { // BoxWireLength ?>
		<td data-name="BoxWireLength" <?php echo $Products_list->BoxWireLength->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_BoxWireLength" class="form-group">
<input type="text" data-table="Products" data-field="x_BoxWireLength" name="x<?php echo $Products_list->RowIndex ?>_BoxWireLength" id="x<?php echo $Products_list->RowIndex ?>_BoxWireLength" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->BoxWireLength->getPlaceHolder()) ?>" value="<?php echo $Products_list->BoxWireLength->EditValue ?>"<?php echo $Products_list->BoxWireLength->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_BoxWireLength" name="o<?php echo $Products_list->RowIndex ?>_BoxWireLength" id="o<?php echo $Products_list->RowIndex ?>_BoxWireLength" value="<?php echo HtmlEncode($Products_list->BoxWireLength->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_BoxWireLength" class="form-group">
<input type="text" data-table="Products" data-field="x_BoxWireLength" name="x<?php echo $Products_list->RowIndex ?>_BoxWireLength" id="x<?php echo $Products_list->RowIndex ?>_BoxWireLength" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->BoxWireLength->getPlaceHolder()) ?>" value="<?php echo $Products_list->BoxWireLength->EditValue ?>"<?php echo $Products_list->BoxWireLength->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_BoxWireLength">
<span<?php echo $Products_list->BoxWireLength->viewAttributes() ?>><?php echo $Products_list->BoxWireLength->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->IsFirePump->Visible) { // IsFirePump ?>
		<td data-name="IsFirePump" <?php echo $Products_list->IsFirePump->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsFirePump" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->IsFirePump->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsFirePump" name="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]" id="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]_478706" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsFirePump->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]_478706"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsFirePump" name="o<?php echo $Products_list->RowIndex ?>_IsFirePump[]" id="o<?php echo $Products_list->RowIndex ?>_IsFirePump[]" value="<?php echo HtmlEncode($Products_list->IsFirePump->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsFirePump" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->IsFirePump->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsFirePump" name="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]" id="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]_895118" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsFirePump->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]_895118"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsFirePump">
<span<?php echo $Products_list->IsFirePump->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsFirePump" class="custom-control-input" value="<?php echo $Products_list->IsFirePump->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->IsFirePump->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsFirePump"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
		<td data-name="FirePumpType_Idn" <?php echo $Products_list->FirePumpType_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FirePumpType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FirePumpType_Idn" data-value-separator="<?php echo $Products_list->FirePumpType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn"<?php echo $Products_list->FirePumpType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FirePumpType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FirePumpType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FirePumpType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FirePumpType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_FirePumpType_Idn" name="o<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn" id="o<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn" value="<?php echo HtmlEncode($Products_list->FirePumpType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FirePumpType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FirePumpType_Idn" data-value-separator="<?php echo $Products_list->FirePumpType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn"<?php echo $Products_list->FirePumpType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FirePumpType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FirePumpType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FirePumpType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FirePumpType_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FirePumpType_Idn">
<span<?php echo $Products_list->FirePumpType_Idn->viewAttributes() ?>><?php echo $Products_list->FirePumpType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
		<td data-name="FirePumpAttribute_Idn" <?php echo $Products_list->FirePumpAttribute_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FirePumpAttribute_Idn" class="form-group">
<input type="text" data-table="Products" data-field="x_FirePumpAttribute_Idn" name="x<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" id="x<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->FirePumpAttribute_Idn->getPlaceHolder()) ?>" value="<?php echo $Products_list->FirePumpAttribute_Idn->EditValue ?>"<?php echo $Products_list->FirePumpAttribute_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_FirePumpAttribute_Idn" name="o<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" id="o<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" value="<?php echo HtmlEncode($Products_list->FirePumpAttribute_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FirePumpAttribute_Idn" class="form-group">
<input type="text" data-table="Products" data-field="x_FirePumpAttribute_Idn" name="x<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" id="x<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->FirePumpAttribute_Idn->getPlaceHolder()) ?>" value="<?php echo $Products_list->FirePumpAttribute_Idn->EditValue ?>"<?php echo $Products_list->FirePumpAttribute_Idn->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_FirePumpAttribute_Idn">
<span<?php echo $Products_list->FirePumpAttribute_Idn->viewAttributes() ?>><?php echo $Products_list->FirePumpAttribute_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->IsDieselFuel->Visible) { // IsDieselFuel ?>
		<td data-name="IsDieselFuel" <?php echo $Products_list->IsDieselFuel->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsDieselFuel" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->IsDieselFuel->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsDieselFuel" name="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]" id="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]_753050" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsDieselFuel->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]_753050"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsDieselFuel" name="o<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]" id="o<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]" value="<?php echo HtmlEncode($Products_list->IsDieselFuel->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsDieselFuel" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->IsDieselFuel->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsDieselFuel" name="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]" id="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]_302352" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsDieselFuel->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]_302352"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsDieselFuel">
<span<?php echo $Products_list->IsDieselFuel->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsDieselFuel" class="custom-control-input" value="<?php echo $Products_list->IsDieselFuel->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->IsDieselFuel->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsDieselFuel"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->IsSolution->Visible) { // IsSolution ?>
		<td data-name="IsSolution" <?php echo $Products_list->IsSolution->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsSolution" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->IsSolution->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsSolution" name="x<?php echo $Products_list->RowIndex ?>_IsSolution[]" id="x<?php echo $Products_list->RowIndex ?>_IsSolution[]_507606" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsSolution->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsSolution[]_507606"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsSolution" name="o<?php echo $Products_list->RowIndex ?>_IsSolution[]" id="o<?php echo $Products_list->RowIndex ?>_IsSolution[]" value="<?php echo HtmlEncode($Products_list->IsSolution->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsSolution" class="form-group">
<?php
$selwrk = ConvertToBool($Products_list->IsSolution->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsSolution" name="x<?php echo $Products_list->RowIndex ?>_IsSolution[]" id="x<?php echo $Products_list->RowIndex ?>_IsSolution[]_450380" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsSolution->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsSolution[]_450380"></label>
</div>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_IsSolution">
<span<?php echo $Products_list->IsSolution->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsSolution" class="custom-control-input" value="<?php echo $Products_list->IsSolution->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_list->IsSolution->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsSolution"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Products_list->Position_Idn->Visible) { // Position_Idn ?>
		<td data-name="Position_Idn" <?php echo $Products_list->Position_Idn->cellAttributes() ?>>
<?php if ($Products->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Position_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Position_Idn" data-value-separator="<?php echo $Products_list->Position_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Position_Idn" name="x<?php echo $Products_list->RowIndex ?>_Position_Idn"<?php echo $Products_list->Position_Idn->editAttributes() ?>>
			<?php echo $Products_list->Position_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Position_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Position_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Position_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Position_Idn" name="o<?php echo $Products_list->RowIndex ?>_Position_Idn" id="o<?php echo $Products_list->RowIndex ?>_Position_Idn" value="<?php echo HtmlEncode($Products_list->Position_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Position_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Position_Idn" data-value-separator="<?php echo $Products_list->Position_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Position_Idn" name="x<?php echo $Products_list->RowIndex ?>_Position_Idn"<?php echo $Products_list->Position_Idn->editAttributes() ?>>
			<?php echo $Products_list->Position_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Position_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Position_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Position_Idn") ?>
</span>
<?php } ?>
<?php if ($Products->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Products_list->RowCount ?>_Products_Position_Idn">
<span<?php echo $Products_list->Position_Idn->viewAttributes() ?>><?php echo $Products_list->Position_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Products_list->ListOptions->render("body", "right", $Products_list->RowCount);
?>
	</tr>
<?php if ($Products->RowType == ROWTYPE_ADD || $Products->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fProductslist", "load"], function() {
	fProductslist.updateLists(<?php echo $Products_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Products_list->isGridAdd())
		if (!$Products_list->Recordset->EOF)
			$Products_list->Recordset->moveNext();
}
?>
<?php
	if ($Products_list->isGridAdd() || $Products_list->isGridEdit()) {
		$Products_list->RowIndex = '$rowindex$';
		$Products_list->loadRowValues();

		// Set row properties
		$Products->resetAttributes();
		$Products->RowAttrs->merge(["data-rowindex" => $Products_list->RowIndex, "id" => "r0_Products", "data-rowtype" => ROWTYPE_ADD]);
		$Products->RowAttrs->appendClass("ew-template");
		$Products->RowType = ROWTYPE_ADD;

		// Render row
		$Products_list->renderRow();

		// Render list options
		$Products_list->renderListOptions();
		$Products_list->StartRowCount = 0;
?>
	<tr <?php echo $Products->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Products_list->ListOptions->render("body", "left", $Products_list->RowIndex);
?>
	<?php if ($Products_list->Product_Idn->Visible) { // Product_Idn ?>
		<td data-name="Product_Idn">
<span id="el$rowindex$_Products_Product_Idn" class="form-group Products_Product_Idn"></span>
<input type="hidden" data-table="Products" data-field="x_Product_Idn" name="o<?php echo $Products_list->RowIndex ?>_Product_Idn" id="o<?php echo $Products_list->RowIndex ?>_Product_Idn" value="<?php echo HtmlEncode($Products_list->Product_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_Products_Department_Idn" class="form-group Products_Department_Idn">
<?php $Products_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Department_Idn" data-value-separator="<?php echo $Products_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Department_Idn" name="x<?php echo $Products_list->RowIndex ?>_Department_Idn"<?php echo $Products_list->Department_Idn->editAttributes() ?>>
			<?php echo $Products_list->Department_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Department_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Department_Idn" name="o<?php echo $Products_list->RowIndex ?>_Department_Idn" id="o<?php echo $Products_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($Products_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el$rowindex$_Products_WorksheetMaster_Idn" class="form-group Products_WorksheetMaster_Idn">
<?php $Products_list->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $Products_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $Products_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Products_list->WorksheetMaster_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Products_list->WorksheetMaster_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_WorksheetMaster_Idn" name="o<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $Products_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($Products_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn">
<span id="el$rowindex$_Products_WorksheetCategory_Idn" class="form-group Products_WorksheetCategory_Idn">
<?php $Products_list->WorksheetCategory_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $Products_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $Products_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Products_list->WorksheetCategory_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_list->WorksheetCategory_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_WorksheetCategory_Idn" name="o<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $Products_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($Products_list->WorksheetCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
		<td data-name="Manufacturer_Idn">
<span id="el$rowindex$_Products_Manufacturer_Idn" class="form-group Products_Manufacturer_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Manufacturer_Idn" data-value-separator="<?php echo $Products_list->Manufacturer_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn" name="x<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn"<?php echo $Products_list->Manufacturer_Idn->editAttributes() ?>>
			<?php echo $Products_list->Manufacturer_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Manufacturer_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Manufacturer_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Manufacturer_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Manufacturer_Idn" name="o<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn" id="o<?php echo $Products_list->RowIndex ?>_Manufacturer_Idn" value="<?php echo HtmlEncode($Products_list->Manufacturer_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_Products_Rank" class="form-group Products_Rank">
<input type="text" data-table="Products" data-field="x_Rank" name="x<?php echo $Products_list->RowIndex ?>_Rank" id="x<?php echo $Products_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Products_list->Rank->EditValue ?>"<?php echo $Products_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_Rank" name="o<?php echo $Products_list->RowIndex ?>_Rank" id="o<?php echo $Products_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Products_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_Products_Name" class="form-group Products_Name">
<input type="text" data-table="Products" data-field="x_Name" name="x<?php echo $Products_list->RowIndex ?>_Name" id="x<?php echo $Products_list->RowIndex ?>_Name" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($Products_list->Name->getPlaceHolder()) ?>" value="<?php echo $Products_list->Name->EditValue ?>"<?php echo $Products_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_Name" name="o<?php echo $Products_list->RowIndex ?>_Name" id="o<?php echo $Products_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Products_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->MaterialUnitPrice->Visible) { // MaterialUnitPrice ?>
		<td data-name="MaterialUnitPrice">
<span id="el$rowindex$_Products_MaterialUnitPrice" class="form-group Products_MaterialUnitPrice">
<input type="text" data-table="Products" data-field="x_MaterialUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->MaterialUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->MaterialUnitPrice->EditValue ?>"<?php echo $Products_list->MaterialUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_MaterialUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_MaterialUnitPrice" value="<?php echo HtmlEncode($Products_list->MaterialUnitPrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<td data-name="FieldUnitPrice">
<span id="el$rowindex$_Products_FieldUnitPrice" class="form-group Products_FieldUnitPrice">
<input type="text" data-table="Products" data-field="x_FieldUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->FieldUnitPrice->EditValue ?>"<?php echo $Products_list->FieldUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_FieldUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_FieldUnitPrice" value="<?php echo HtmlEncode($Products_list->FieldUnitPrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ShopUnitPrice->Visible) { // ShopUnitPrice ?>
		<td data-name="ShopUnitPrice">
<span id="el$rowindex$_Products_ShopUnitPrice" class="form-group Products_ShopUnitPrice">
<input type="text" data-table="Products" data-field="x_ShopUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->ShopUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->ShopUnitPrice->EditValue ?>"<?php echo $Products_list->ShopUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_ShopUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_ShopUnitPrice" value="<?php echo HtmlEncode($Products_list->ShopUnitPrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->EngineerUnitPrice->Visible) { // EngineerUnitPrice ?>
		<td data-name="EngineerUnitPrice">
<span id="el$rowindex$_Products_EngineerUnitPrice" class="form-group Products_EngineerUnitPrice">
<input type="text" data-table="Products" data-field="x_EngineerUnitPrice" name="x<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" id="x<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->EngineerUnitPrice->getPlaceHolder()) ?>" value="<?php echo $Products_list->EngineerUnitPrice->EditValue ?>"<?php echo $Products_list->EngineerUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_EngineerUnitPrice" name="o<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" id="o<?php echo $Products_list->RowIndex ?>_EngineerUnitPrice" value="<?php echo HtmlEncode($Products_list->EngineerUnitPrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->DefaultQuantity->Visible) { // DefaultQuantity ?>
		<td data-name="DefaultQuantity">
<span id="el$rowindex$_Products_DefaultQuantity" class="form-group Products_DefaultQuantity">
<input type="text" data-table="Products" data-field="x_DefaultQuantity" name="x<?php echo $Products_list->RowIndex ?>_DefaultQuantity" id="x<?php echo $Products_list->RowIndex ?>_DefaultQuantity" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Products_list->DefaultQuantity->getPlaceHolder()) ?>" value="<?php echo $Products_list->DefaultQuantity->EditValue ?>"<?php echo $Products_list->DefaultQuantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_DefaultQuantity" name="o<?php echo $Products_list->RowIndex ?>_DefaultQuantity" id="o<?php echo $Products_list->RowIndex ?>_DefaultQuantity" value="<?php echo HtmlEncode($Products_list->DefaultQuantity->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td data-name="ProductSize_Idn">
<span id="el$rowindex$_Products_ProductSize_Idn" class="form-group Products_ProductSize_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $Products_list->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ProductSize_Idn" name="x<?php echo $Products_list->RowIndex ?>_ProductSize_Idn"<?php echo $Products_list->ProductSize_Idn->editAttributes() ?>>
			<?php echo $Products_list->ProductSize_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ProductSize_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ProductSize_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ProductSize_Idn" name="o<?php echo $Products_list->RowIndex ?>_ProductSize_Idn" id="o<?php echo $Products_list->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($Products_list->ProductSize_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Description->Visible) { // Description ?>
		<td data-name="Description">
<span id="el$rowindex$_Products_Description" class="form-group Products_Description">
<textarea data-table="Products" data-field="x_Description" name="x<?php echo $Products_list->RowIndex ?>_Description" id="x<?php echo $Products_list->RowIndex ?>_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($Products_list->Description->getPlaceHolder()) ?>"<?php echo $Products_list->Description->editAttributes() ?>><?php echo $Products_list->Description->EditValue ?></textarea>
</span>
<input type="hidden" data-table="Products" data-field="x_Description" name="o<?php echo $Products_list->RowIndex ?>_Description" id="o<?php echo $Products_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($Products_list->Description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td data-name="PipeType_Idn">
<span id="el$rowindex$_Products_PipeType_Idn" class="form-group Products_PipeType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PipeType_Idn" data-value-separator="<?php echo $Products_list->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_PipeType_Idn" name="x<?php echo $Products_list->RowIndex ?>_PipeType_Idn"<?php echo $Products_list->PipeType_Idn->editAttributes() ?>>
			<?php echo $Products_list->PipeType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_PipeType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->PipeType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_PipeType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_PipeType_Idn" name="o<?php echo $Products_list->RowIndex ?>_PipeType_Idn" id="o<?php echo $Products_list->RowIndex ?>_PipeType_Idn" value="<?php echo HtmlEncode($Products_list->PipeType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
		<td data-name="ScheduleType_Idn">
<span id="el$rowindex$_Products_ScheduleType_Idn" class="form-group Products_ScheduleType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ScheduleType_Idn" data-value-separator="<?php echo $Products_list->ScheduleType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn" name="x<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn"<?php echo $Products_list->ScheduleType_Idn->editAttributes() ?>>
			<?php echo $Products_list->ScheduleType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ScheduleType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ScheduleType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ScheduleType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ScheduleType_Idn" name="o<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn" id="o<?php echo $Products_list->RowIndex ?>_ScheduleType_Idn" value="<?php echo HtmlEncode($Products_list->ScheduleType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Fitting_Idn->Visible) { // Fitting_Idn ?>
		<td data-name="Fitting_Idn">
<span id="el$rowindex$_Products_Fitting_Idn" class="form-group Products_Fitting_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Fitting_Idn" data-value-separator="<?php echo $Products_list->Fitting_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Fitting_Idn" name="x<?php echo $Products_list->RowIndex ?>_Fitting_Idn"<?php echo $Products_list->Fitting_Idn->editAttributes() ?>>
			<?php echo $Products_list->Fitting_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Fitting_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Fitting_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Fitting_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Fitting_Idn" name="o<?php echo $Products_list->RowIndex ?>_Fitting_Idn" id="o<?php echo $Products_list->RowIndex ?>_Fitting_Idn" value="<?php echo HtmlEncode($Products_list->Fitting_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
		<td data-name="GroovedFittingType_Idn">
<span id="el$rowindex$_Products_GroovedFittingType_Idn" class="form-group Products_GroovedFittingType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GroovedFittingType_Idn" data-value-separator="<?php echo $Products_list->GroovedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn" name="x<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn"<?php echo $Products_list->GroovedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_list->GroovedFittingType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_GroovedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->GroovedFittingType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_GroovedFittingType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_GroovedFittingType_Idn" name="o<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn" id="o<?php echo $Products_list->RowIndex ?>_GroovedFittingType_Idn" value="<?php echo HtmlEncode($Products_list->GroovedFittingType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
		<td data-name="ThreadedFittingType_Idn">
<span id="el$rowindex$_Products_ThreadedFittingType_Idn" class="form-group Products_ThreadedFittingType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ThreadedFittingType_Idn" data-value-separator="<?php echo $Products_list->ThreadedFittingType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn" name="x<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn"<?php echo $Products_list->ThreadedFittingType_Idn->editAttributes() ?>>
			<?php echo $Products_list->ThreadedFittingType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ThreadedFittingType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ThreadedFittingType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ThreadedFittingType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ThreadedFittingType_Idn" name="o<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn" id="o<?php echo $Products_list->RowIndex ?>_ThreadedFittingType_Idn" value="<?php echo HtmlEncode($Products_list->ThreadedFittingType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td data-name="HangerType_Idn">
<span id="el$rowindex$_Products_HangerType_Idn" class="form-group Products_HangerType_Idn">
<?php $Products_list->HangerType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerType_Idn" data-value-separator="<?php echo $Products_list->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HangerType_Idn"<?php echo $Products_list->HangerType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HangerType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HangerType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HangerType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HangerType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_HangerType_Idn" name="o<?php echo $Products_list->RowIndex ?>_HangerType_Idn" id="o<?php echo $Products_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($Products_list->HangerType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<td data-name="HangerSubType_Idn">
<span id="el$rowindex$_Products_HangerSubType_Idn" class="form-group Products_HangerSubType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HangerSubType_Idn" data-value-separator="<?php echo $Products_list->HangerSubType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn"<?php echo $Products_list->HangerSubType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HangerSubType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HangerSubType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HangerSubType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HangerSubType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_HangerSubType_Idn" name="o<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn" id="o<?php echo $Products_list->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($Products_list->HangerSubType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->SubcontractCategory_Idn->Visible) { // SubcontractCategory_Idn ?>
		<td data-name="SubcontractCategory_Idn">
<span id="el$rowindex$_Products_SubcontractCategory_Idn" class="form-group Products_SubcontractCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_SubcontractCategory_Idn" data-value-separator="<?php echo $Products_list->SubcontractCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn" name="x<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn"<?php echo $Products_list->SubcontractCategory_Idn->editAttributes() ?>>
			<?php echo $Products_list->SubcontractCategory_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_SubcontractCategory_Idn") ?>
		</select>
</div>
<?php echo $Products_list->SubcontractCategory_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_SubcontractCategory_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_SubcontractCategory_Idn" name="o<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn" id="o<?php echo $Products_list->RowIndex ?>_SubcontractCategory_Idn" value="<?php echo HtmlEncode($Products_list->SubcontractCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ApplyToAdjustmentFactorsFlag->Visible) { // ApplyToAdjustmentFactorsFlag ?>
		<td data-name="ApplyToAdjustmentFactorsFlag">
<span id="el$rowindex$_Products_ApplyToAdjustmentFactorsFlag" class="form-group Products_ApplyToAdjustmentFactorsFlag">
<?php
$selwrk = ConvertToBool($Products_list->ApplyToAdjustmentFactorsFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToAdjustmentFactorsFlag" name="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]_320178" value="1"<?php echo $selwrk ?><?php echo $Products_list->ApplyToAdjustmentFactorsFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]_320178"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ApplyToAdjustmentFactorsFlag" name="o<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ApplyToAdjustmentFactorsFlag[]" value="<?php echo HtmlEncode($Products_list->ApplyToAdjustmentFactorsFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ApplyToContingencyFlag->Visible) { // ApplyToContingencyFlag ?>
		<td data-name="ApplyToContingencyFlag">
<span id="el$rowindex$_Products_ApplyToContingencyFlag" class="form-group Products_ApplyToContingencyFlag">
<?php
$selwrk = ConvertToBool($Products_list->ApplyToContingencyFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ApplyToContingencyFlag" name="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]_498132" value="1"<?php echo $selwrk ?><?php echo $Products_list->ApplyToContingencyFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]_498132"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ApplyToContingencyFlag" name="o<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ApplyToContingencyFlag[]" value="<?php echo HtmlEncode($Products_list->ApplyToContingencyFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->IsMainComponent->Visible) { // IsMainComponent ?>
		<td data-name="IsMainComponent">
<span id="el$rowindex$_Products_IsMainComponent" class="form-group Products_IsMainComponent">
<?php
$selwrk = ConvertToBool($Products_list->IsMainComponent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsMainComponent" name="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]" id="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]_454475" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsMainComponent->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsMainComponent[]_454475"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsMainComponent" name="o<?php echo $Products_list->RowIndex ?>_IsMainComponent[]" id="o<?php echo $Products_list->RowIndex ?>_IsMainComponent[]" value="<?php echo HtmlEncode($Products_list->IsMainComponent->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->DomesticFlag->Visible) { // DomesticFlag ?>
		<td data-name="DomesticFlag">
<span id="el$rowindex$_Products_DomesticFlag" class="form-group Products_DomesticFlag">
<?php
$selwrk = ConvertToBool($Products_list->DomesticFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_DomesticFlag" name="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]" id="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]_230608" value="1"<?php echo $selwrk ?><?php echo $Products_list->DomesticFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_DomesticFlag[]_230608"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_DomesticFlag" name="o<?php echo $Products_list->RowIndex ?>_DomesticFlag[]" id="o<?php echo $Products_list->RowIndex ?>_DomesticFlag[]" value="<?php echo HtmlEncode($Products_list->DomesticFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->LoadFlag->Visible) { // LoadFlag ?>
		<td data-name="LoadFlag">
<span id="el$rowindex$_Products_LoadFlag" class="form-group Products_LoadFlag">
<?php
$selwrk = ConvertToBool($Products_list->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_LoadFlag" name="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]" id="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]_229003" value="1"<?php echo $selwrk ?><?php echo $Products_list->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_LoadFlag[]_229003"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_LoadFlag" name="o<?php echo $Products_list->RowIndex ?>_LoadFlag[]" id="o<?php echo $Products_list->RowIndex ?>_LoadFlag[]" value="<?php echo HtmlEncode($Products_list->LoadFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<td data-name="AutoLoadFlag">
<span id="el$rowindex$_Products_AutoLoadFlag" class="form-group Products_AutoLoadFlag">
<?php
$selwrk = ConvertToBool($Products_list->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_AutoLoadFlag" name="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]" id="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]_488974" value="1"<?php echo $selwrk ?><?php echo $Products_list->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]_488974"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_AutoLoadFlag" name="o<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]" id="o<?php echo $Products_list->RowIndex ?>_AutoLoadFlag[]" value="<?php echo HtmlEncode($Products_list->AutoLoadFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_Products_ActiveFlag" class="form-group Products_ActiveFlag">
<?php
$selwrk = ConvertToBool($Products_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ActiveFlag" name="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]_364194" value="1"<?php echo $selwrk ?><?php echo $Products_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ActiveFlag[]_364194"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ActiveFlag" name="o<?php echo $Products_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Products_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->GradeType_Idn->Visible) { // GradeType_Idn ?>
		<td data-name="GradeType_Idn">
<span id="el$rowindex$_Products_GradeType_Idn" class="form-group Products_GradeType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_GradeType_Idn" data-value-separator="<?php echo $Products_list->GradeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_GradeType_Idn" name="x<?php echo $Products_list->RowIndex ?>_GradeType_Idn"<?php echo $Products_list->GradeType_Idn->editAttributes() ?>>
			<?php echo $Products_list->GradeType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_GradeType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->GradeType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_GradeType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_GradeType_Idn" name="o<?php echo $Products_list->RowIndex ?>_GradeType_Idn" id="o<?php echo $Products_list->RowIndex ?>_GradeType_Idn" value="<?php echo HtmlEncode($Products_list->GradeType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->PressureType_Idn->Visible) { // PressureType_Idn ?>
		<td data-name="PressureType_Idn">
<span id="el$rowindex$_Products_PressureType_Idn" class="form-group Products_PressureType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_PressureType_Idn" data-value-separator="<?php echo $Products_list->PressureType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_PressureType_Idn" name="x<?php echo $Products_list->RowIndex ?>_PressureType_Idn"<?php echo $Products_list->PressureType_Idn->editAttributes() ?>>
			<?php echo $Products_list->PressureType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_PressureType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->PressureType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_PressureType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_PressureType_Idn" name="o<?php echo $Products_list->RowIndex ?>_PressureType_Idn" id="o<?php echo $Products_list->RowIndex ?>_PressureType_Idn" value="<?php echo HtmlEncode($Products_list->PressureType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->SeamlessFlag->Visible) { // SeamlessFlag ?>
		<td data-name="SeamlessFlag">
<span id="el$rowindex$_Products_SeamlessFlag" class="form-group Products_SeamlessFlag">
<?php
$selwrk = ConvertToBool($Products_list->SeamlessFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_SeamlessFlag" name="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]" id="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]_350599" value="1"<?php echo $selwrk ?><?php echo $Products_list->SeamlessFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]_350599"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_SeamlessFlag" name="o<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]" id="o<?php echo $Products_list->RowIndex ?>_SeamlessFlag[]" value="<?php echo HtmlEncode($Products_list->SeamlessFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ResponseType->Visible) { // ResponseType ?>
		<td data-name="ResponseType">
<span id="el$rowindex$_Products_ResponseType" class="form-group Products_ResponseType">
<div id="tp_x<?php echo $Products_list->RowIndex ?>_ResponseType" class="ew-template"><input type="radio" class="custom-control-input" data-table="Products" data-field="x_ResponseType" data-value-separator="<?php echo $Products_list->ResponseType->displayValueSeparatorAttribute() ?>" name="x<?php echo $Products_list->RowIndex ?>_ResponseType" id="x<?php echo $Products_list->RowIndex ?>_ResponseType" value="{value}"<?php echo $Products_list->ResponseType->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Products_list->RowIndex ?>_ResponseType" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Products_list->ResponseType->radioButtonListHtml(FALSE, "x{$Products_list->RowIndex}_ResponseType") ?>
</div></div>
</span>
<input type="hidden" data-table="Products" data-field="x_ResponseType" name="o<?php echo $Products_list->RowIndex ?>_ResponseType" id="o<?php echo $Products_list->RowIndex ?>_ResponseType" value="<?php echo HtmlEncode($Products_list->ResponseType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FMJobFlag->Visible) { // FMJobFlag ?>
		<td data-name="FMJobFlag">
<span id="el$rowindex$_Products_FMJobFlag" class="form-group Products_FMJobFlag">
<?php
$selwrk = ConvertToBool($Products_list->FMJobFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_FMJobFlag" name="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]" id="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]_838526" value="1"<?php echo $selwrk ?><?php echo $Products_list->FMJobFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_FMJobFlag[]_838526"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_FMJobFlag" name="o<?php echo $Products_list->RowIndex ?>_FMJobFlag[]" id="o<?php echo $Products_list->RowIndex ?>_FMJobFlag[]" value="<?php echo HtmlEncode($Products_list->FMJobFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->RecommendedBoxes->Visible) { // RecommendedBoxes ?>
		<td data-name="RecommendedBoxes">
<span id="el$rowindex$_Products_RecommendedBoxes" class="form-group Products_RecommendedBoxes">
<input type="text" data-table="Products" data-field="x_RecommendedBoxes" name="x<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" id="x<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->RecommendedBoxes->getPlaceHolder()) ?>" value="<?php echo $Products_list->RecommendedBoxes->EditValue ?>"<?php echo $Products_list->RecommendedBoxes->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_RecommendedBoxes" name="o<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" id="o<?php echo $Products_list->RowIndex ?>_RecommendedBoxes" value="<?php echo HtmlEncode($Products_list->RecommendedBoxes->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->RecommendedWireFootage->Visible) { // RecommendedWireFootage ?>
		<td data-name="RecommendedWireFootage">
<span id="el$rowindex$_Products_RecommendedWireFootage" class="form-group Products_RecommendedWireFootage">
<input type="text" data-table="Products" data-field="x_RecommendedWireFootage" name="x<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" id="x<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->RecommendedWireFootage->getPlaceHolder()) ?>" value="<?php echo $Products_list->RecommendedWireFootage->EditValue ?>"<?php echo $Products_list->RecommendedWireFootage->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_RecommendedWireFootage" name="o<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" id="o<?php echo $Products_list->RowIndex ?>_RecommendedWireFootage" value="<?php echo HtmlEncode($Products_list->RecommendedWireFootage->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
		<td data-name="CoverageType_Idn">
<span id="el$rowindex$_Products_CoverageType_Idn" class="form-group Products_CoverageType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CoverageType_Idn" data-value-separator="<?php echo $Products_list->CoverageType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_CoverageType_Idn" name="x<?php echo $Products_list->RowIndex ?>_CoverageType_Idn"<?php echo $Products_list->CoverageType_Idn->editAttributes() ?>>
			<?php echo $Products_list->CoverageType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_CoverageType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->CoverageType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_CoverageType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_CoverageType_Idn" name="o<?php echo $Products_list->RowIndex ?>_CoverageType_Idn" id="o<?php echo $Products_list->RowIndex ?>_CoverageType_Idn" value="<?php echo HtmlEncode($Products_list->CoverageType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->HeadType_Idn->Visible) { // HeadType_Idn ?>
		<td data-name="HeadType_Idn">
<span id="el$rowindex$_Products_HeadType_Idn" class="form-group Products_HeadType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_HeadType_Idn" data-value-separator="<?php echo $Products_list->HeadType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_HeadType_Idn" name="x<?php echo $Products_list->RowIndex ?>_HeadType_Idn"<?php echo $Products_list->HeadType_Idn->editAttributes() ?>>
			<?php echo $Products_list->HeadType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_HeadType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->HeadType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_HeadType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_HeadType_Idn" name="o<?php echo $Products_list->RowIndex ?>_HeadType_Idn" id="o<?php echo $Products_list->RowIndex ?>_HeadType_Idn" value="<?php echo HtmlEncode($Products_list->HeadType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FinishType_Idn->Visible) { // FinishType_Idn ?>
		<td data-name="FinishType_Idn">
<span id="el$rowindex$_Products_FinishType_Idn" class="form-group Products_FinishType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FinishType_Idn" data-value-separator="<?php echo $Products_list->FinishType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FinishType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FinishType_Idn"<?php echo $Products_list->FinishType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FinishType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FinishType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FinishType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FinishType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_FinishType_Idn" name="o<?php echo $Products_list->RowIndex ?>_FinishType_Idn" id="o<?php echo $Products_list->RowIndex ?>_FinishType_Idn" value="<?php echo HtmlEncode($Products_list->FinishType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Outlet_Idn->Visible) { // Outlet_Idn ?>
		<td data-name="Outlet_Idn">
<span id="el$rowindex$_Products_Outlet_Idn" class="form-group Products_Outlet_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Outlet_Idn" data-value-separator="<?php echo $Products_list->Outlet_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Outlet_Idn" name="x<?php echo $Products_list->RowIndex ?>_Outlet_Idn"<?php echo $Products_list->Outlet_Idn->editAttributes() ?>>
			<?php echo $Products_list->Outlet_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Outlet_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Outlet_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Outlet_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Outlet_Idn" name="o<?php echo $Products_list->RowIndex ?>_Outlet_Idn" id="o<?php echo $Products_list->RowIndex ?>_Outlet_Idn" value="<?php echo HtmlEncode($Products_list->Outlet_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->RiserType_Idn->Visible) { // RiserType_Idn ?>
		<td data-name="RiserType_Idn">
<span id="el$rowindex$_Products_RiserType_Idn" class="form-group Products_RiserType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_RiserType_Idn" data-value-separator="<?php echo $Products_list->RiserType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_RiserType_Idn" name="x<?php echo $Products_list->RowIndex ?>_RiserType_Idn"<?php echo $Products_list->RiserType_Idn->editAttributes() ?>>
			<?php echo $Products_list->RiserType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_RiserType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->RiserType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_RiserType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_RiserType_Idn" name="o<?php echo $Products_list->RowIndex ?>_RiserType_Idn" id="o<?php echo $Products_list->RowIndex ?>_RiserType_Idn" value="<?php echo HtmlEncode($Products_list->RiserType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->BackFlowType_Idn->Visible) { // BackFlowType_Idn ?>
		<td data-name="BackFlowType_Idn">
<span id="el$rowindex$_Products_BackFlowType_Idn" class="form-group Products_BackFlowType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BackFlowType_Idn" data-value-separator="<?php echo $Products_list->BackFlowType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn" name="x<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn"<?php echo $Products_list->BackFlowType_Idn->editAttributes() ?>>
			<?php echo $Products_list->BackFlowType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_BackFlowType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->BackFlowType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_BackFlowType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_BackFlowType_Idn" name="o<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn" id="o<?php echo $Products_list->RowIndex ?>_BackFlowType_Idn" value="<?php echo HtmlEncode($Products_list->BackFlowType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
		<td data-name="ControlValve_Idn">
<span id="el$rowindex$_Products_ControlValve_Idn" class="form-group Products_ControlValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_ControlValve_Idn" data-value-separator="<?php echo $Products_list->ControlValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_ControlValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_ControlValve_Idn"<?php echo $Products_list->ControlValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->ControlValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_ControlValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->ControlValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_ControlValve_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_ControlValve_Idn" name="o<?php echo $Products_list->RowIndex ?>_ControlValve_Idn" id="o<?php echo $Products_list->RowIndex ?>_ControlValve_Idn" value="<?php echo HtmlEncode($Products_list->ControlValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
		<td data-name="CheckValve_Idn">
<span id="el$rowindex$_Products_CheckValve_Idn" class="form-group Products_CheckValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_CheckValve_Idn" data-value-separator="<?php echo $Products_list->CheckValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_CheckValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_CheckValve_Idn"<?php echo $Products_list->CheckValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->CheckValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_CheckValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->CheckValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_CheckValve_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_CheckValve_Idn" name="o<?php echo $Products_list->RowIndex ?>_CheckValve_Idn" id="o<?php echo $Products_list->RowIndex ?>_CheckValve_Idn" value="<?php echo HtmlEncode($Products_list->CheckValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FDCType_Idn->Visible) { // FDCType_Idn ?>
		<td data-name="FDCType_Idn">
<span id="el$rowindex$_Products_FDCType_Idn" class="form-group Products_FDCType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FDCType_Idn" data-value-separator="<?php echo $Products_list->FDCType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FDCType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FDCType_Idn"<?php echo $Products_list->FDCType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FDCType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FDCType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FDCType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FDCType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_FDCType_Idn" name="o<?php echo $Products_list->RowIndex ?>_FDCType_Idn" id="o<?php echo $Products_list->RowIndex ?>_FDCType_Idn" value="<?php echo HtmlEncode($Products_list->FDCType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->BellType_Idn->Visible) { // BellType_Idn ?>
		<td data-name="BellType_Idn">
<span id="el$rowindex$_Products_BellType_Idn" class="form-group Products_BellType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_BellType_Idn" data-value-separator="<?php echo $Products_list->BellType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_BellType_Idn" name="x<?php echo $Products_list->RowIndex ?>_BellType_Idn"<?php echo $Products_list->BellType_Idn->editAttributes() ?>>
			<?php echo $Products_list->BellType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_BellType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->BellType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_BellType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_BellType_Idn" name="o<?php echo $Products_list->RowIndex ?>_BellType_Idn" id="o<?php echo $Products_list->RowIndex ?>_BellType_Idn" value="<?php echo HtmlEncode($Products_list->BellType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
		<td data-name="TappingTee_Idn">
<span id="el$rowindex$_Products_TappingTee_Idn" class="form-group Products_TappingTee_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_TappingTee_Idn" data-value-separator="<?php echo $Products_list->TappingTee_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_TappingTee_Idn" name="x<?php echo $Products_list->RowIndex ?>_TappingTee_Idn"<?php echo $Products_list->TappingTee_Idn->editAttributes() ?>>
			<?php echo $Products_list->TappingTee_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_TappingTee_Idn") ?>
		</select>
</div>
<?php echo $Products_list->TappingTee_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_TappingTee_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_TappingTee_Idn" name="o<?php echo $Products_list->RowIndex ?>_TappingTee_Idn" id="o<?php echo $Products_list->RowIndex ?>_TappingTee_Idn" value="<?php echo HtmlEncode($Products_list->TappingTee_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
		<td data-name="UndergroundValve_Idn">
<span id="el$rowindex$_Products_UndergroundValve_Idn" class="form-group Products_UndergroundValve_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_UndergroundValve_Idn" data-value-separator="<?php echo $Products_list->UndergroundValve_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn" name="x<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn"<?php echo $Products_list->UndergroundValve_Idn->editAttributes() ?>>
			<?php echo $Products_list->UndergroundValve_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_UndergroundValve_Idn") ?>
		</select>
</div>
<?php echo $Products_list->UndergroundValve_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_UndergroundValve_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_UndergroundValve_Idn" name="o<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn" id="o<?php echo $Products_list->RowIndex ?>_UndergroundValve_Idn" value="<?php echo HtmlEncode($Products_list->UndergroundValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
		<td data-name="LiftDuration_Idn">
<span id="el$rowindex$_Products_LiftDuration_Idn" class="form-group Products_LiftDuration_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_LiftDuration_Idn" data-value-separator="<?php echo $Products_list->LiftDuration_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn" name="x<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn"<?php echo $Products_list->LiftDuration_Idn->editAttributes() ?>>
			<?php echo $Products_list->LiftDuration_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_LiftDuration_Idn") ?>
		</select>
</div>
<?php echo $Products_list->LiftDuration_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_LiftDuration_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_LiftDuration_Idn" name="o<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn" id="o<?php echo $Products_list->RowIndex ?>_LiftDuration_Idn" value="<?php echo HtmlEncode($Products_list->LiftDuration_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->TrimPackageFlag->Visible) { // TrimPackageFlag ?>
		<td data-name="TrimPackageFlag">
<span id="el$rowindex$_Products_TrimPackageFlag" class="form-group Products_TrimPackageFlag">
<?php
$selwrk = ConvertToBool($Products_list->TrimPackageFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_TrimPackageFlag" name="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]" id="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]_381724" value="1"<?php echo $selwrk ?><?php echo $Products_list->TrimPackageFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]_381724"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_TrimPackageFlag" name="o<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]" id="o<?php echo $Products_list->RowIndex ?>_TrimPackageFlag[]" value="<?php echo HtmlEncode($Products_list->TrimPackageFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->ListedFlag->Visible) { // ListedFlag ?>
		<td data-name="ListedFlag">
<span id="el$rowindex$_Products_ListedFlag" class="form-group Products_ListedFlag">
<?php
$selwrk = ConvertToBool($Products_list->ListedFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_ListedFlag" name="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]" id="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]_259643" value="1"<?php echo $selwrk ?><?php echo $Products_list->ListedFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_ListedFlag[]_259643"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_ListedFlag" name="o<?php echo $Products_list->RowIndex ?>_ListedFlag[]" id="o<?php echo $Products_list->RowIndex ?>_ListedFlag[]" value="<?php echo HtmlEncode($Products_list->ListedFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->BoxWireLength->Visible) { // BoxWireLength ?>
		<td data-name="BoxWireLength">
<span id="el$rowindex$_Products_BoxWireLength" class="form-group Products_BoxWireLength">
<input type="text" data-table="Products" data-field="x_BoxWireLength" name="x<?php echo $Products_list->RowIndex ?>_BoxWireLength" id="x<?php echo $Products_list->RowIndex ?>_BoxWireLength" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->BoxWireLength->getPlaceHolder()) ?>" value="<?php echo $Products_list->BoxWireLength->EditValue ?>"<?php echo $Products_list->BoxWireLength->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_BoxWireLength" name="o<?php echo $Products_list->RowIndex ?>_BoxWireLength" id="o<?php echo $Products_list->RowIndex ?>_BoxWireLength" value="<?php echo HtmlEncode($Products_list->BoxWireLength->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->IsFirePump->Visible) { // IsFirePump ?>
		<td data-name="IsFirePump">
<span id="el$rowindex$_Products_IsFirePump" class="form-group Products_IsFirePump">
<?php
$selwrk = ConvertToBool($Products_list->IsFirePump->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsFirePump" name="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]" id="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]_744099" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsFirePump->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsFirePump[]_744099"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsFirePump" name="o<?php echo $Products_list->RowIndex ?>_IsFirePump[]" id="o<?php echo $Products_list->RowIndex ?>_IsFirePump[]" value="<?php echo HtmlEncode($Products_list->IsFirePump->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
		<td data-name="FirePumpType_Idn">
<span id="el$rowindex$_Products_FirePumpType_Idn" class="form-group Products_FirePumpType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_FirePumpType_Idn" data-value-separator="<?php echo $Products_list->FirePumpType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn" name="x<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn"<?php echo $Products_list->FirePumpType_Idn->editAttributes() ?>>
			<?php echo $Products_list->FirePumpType_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_FirePumpType_Idn") ?>
		</select>
</div>
<?php echo $Products_list->FirePumpType_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_FirePumpType_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_FirePumpType_Idn" name="o<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn" id="o<?php echo $Products_list->RowIndex ?>_FirePumpType_Idn" value="<?php echo HtmlEncode($Products_list->FirePumpType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
		<td data-name="FirePumpAttribute_Idn">
<span id="el$rowindex$_Products_FirePumpAttribute_Idn" class="form-group Products_FirePumpAttribute_Idn">
<input type="text" data-table="Products" data-field="x_FirePumpAttribute_Idn" name="x<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" id="x<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Products_list->FirePumpAttribute_Idn->getPlaceHolder()) ?>" value="<?php echo $Products_list->FirePumpAttribute_Idn->EditValue ?>"<?php echo $Products_list->FirePumpAttribute_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="Products" data-field="x_FirePumpAttribute_Idn" name="o<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" id="o<?php echo $Products_list->RowIndex ?>_FirePumpAttribute_Idn" value="<?php echo HtmlEncode($Products_list->FirePumpAttribute_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->IsDieselFuel->Visible) { // IsDieselFuel ?>
		<td data-name="IsDieselFuel">
<span id="el$rowindex$_Products_IsDieselFuel" class="form-group Products_IsDieselFuel">
<?php
$selwrk = ConvertToBool($Products_list->IsDieselFuel->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsDieselFuel" name="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]" id="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]_230434" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsDieselFuel->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]_230434"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsDieselFuel" name="o<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]" id="o<?php echo $Products_list->RowIndex ?>_IsDieselFuel[]" value="<?php echo HtmlEncode($Products_list->IsDieselFuel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->IsSolution->Visible) { // IsSolution ?>
		<td data-name="IsSolution">
<span id="el$rowindex$_Products_IsSolution" class="form-group Products_IsSolution">
<?php
$selwrk = ConvertToBool($Products_list->IsSolution->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Products" data-field="x_IsSolution" name="x<?php echo $Products_list->RowIndex ?>_IsSolution[]" id="x<?php echo $Products_list->RowIndex ?>_IsSolution[]_717922" value="1"<?php echo $selwrk ?><?php echo $Products_list->IsSolution->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Products_list->RowIndex ?>_IsSolution[]_717922"></label>
</div>
</span>
<input type="hidden" data-table="Products" data-field="x_IsSolution" name="o<?php echo $Products_list->RowIndex ?>_IsSolution[]" id="o<?php echo $Products_list->RowIndex ?>_IsSolution[]" value="<?php echo HtmlEncode($Products_list->IsSolution->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Products_list->Position_Idn->Visible) { // Position_Idn ?>
		<td data-name="Position_Idn">
<span id="el$rowindex$_Products_Position_Idn" class="form-group Products_Position_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Products" data-field="x_Position_Idn" data-value-separator="<?php echo $Products_list->Position_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Products_list->RowIndex ?>_Position_Idn" name="x<?php echo $Products_list->RowIndex ?>_Position_Idn"<?php echo $Products_list->Position_Idn->editAttributes() ?>>
			<?php echo $Products_list->Position_Idn->selectOptionListHtml("x{$Products_list->RowIndex}_Position_Idn") ?>
		</select>
</div>
<?php echo $Products_list->Position_Idn->Lookup->getParamTag($Products_list, "p_x" . $Products_list->RowIndex . "_Position_Idn") ?>
</span>
<input type="hidden" data-table="Products" data-field="x_Position_Idn" name="o<?php echo $Products_list->RowIndex ?>_Position_Idn" id="o<?php echo $Products_list->RowIndex ?>_Position_Idn" value="<?php echo HtmlEncode($Products_list->Position_Idn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Products_list->ListOptions->render("body", "right", $Products_list->RowIndex);
?>
<script>
loadjs.ready(["fProductslist", "load"], function() {
	fProductslist.updateLists(<?php echo $Products_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Products_list->isAdd() || $Products_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $Products_list->FormKeyCountName ?>" id="<?php echo $Products_list->FormKeyCountName ?>" value="<?php echo $Products_list->KeyCount ?>">
<?php } ?>
<?php if ($Products_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $Products_list->FormKeyCountName ?>" id="<?php echo $Products_list->FormKeyCountName ?>" value="<?php echo $Products_list->KeyCount ?>">
<?php echo $Products_list->MultiSelectKey ?>
<?php } ?>
<?php if ($Products_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $Products_list->FormKeyCountName ?>" id="<?php echo $Products_list->FormKeyCountName ?>" value="<?php echo $Products_list->KeyCount ?>">
<?php } ?>
<?php if ($Products_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $Products_list->FormKeyCountName ?>" id="<?php echo $Products_list->FormKeyCountName ?>" value="<?php echo $Products_list->KeyCount ?>">
<?php echo $Products_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$Products->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Products_list->Recordset)
	$Products_list->Recordset->Close();
?>
<?php if (!$Products_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Products_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Products_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Products_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Products_list->TotalRecords == 0 && !$Products->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Products_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Products_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Products_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$Products->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: true,
		container: "gmp_Products",
		width: "",
		height: ""
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$Products_list->terminate();
?>