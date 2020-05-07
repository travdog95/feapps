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
$Products_delete = new Products_delete();

// Run the page
$Products_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Products_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fProductsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fProductsdelete = currentForm = new ew.Form("fProductsdelete", "delete");
	loadjs.done("fProductsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Products_delete->showPageHeader(); ?>
<?php
$Products_delete->showMessage();
?>
<form name="fProductsdelete" id="fProductsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Products">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Products_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Products_delete->Product_Idn->Visible) { // Product_Idn ?>
		<th class="<?php echo $Products_delete->Product_Idn->headerCellClass() ?>"><span id="elh_Products_Product_Idn" class="Products_Product_Idn"><?php echo $Products_delete->Product_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->Department_Idn->Visible) { // Department_Idn ?>
		<th class="<?php echo $Products_delete->Department_Idn->headerCellClass() ?>"><span id="elh_Products_Department_Idn" class="Products_Department_Idn"><?php echo $Products_delete->Department_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<th class="<?php echo $Products_delete->WorksheetMaster_Idn->headerCellClass() ?>"><span id="elh_Products_WorksheetMaster_Idn" class="Products_WorksheetMaster_Idn"><?php echo $Products_delete->WorksheetMaster_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<th class="<?php echo $Products_delete->WorksheetCategory_Idn->headerCellClass() ?>"><span id="elh_Products_WorksheetCategory_Idn" class="Products_WorksheetCategory_Idn"><?php echo $Products_delete->WorksheetCategory_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
		<th class="<?php echo $Products_delete->Manufacturer_Idn->headerCellClass() ?>"><span id="elh_Products_Manufacturer_Idn" class="Products_Manufacturer_Idn"><?php echo $Products_delete->Manufacturer_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->Rank->Visible) { // Rank ?>
		<th class="<?php echo $Products_delete->Rank->headerCellClass() ?>"><span id="elh_Products_Rank" class="Products_Rank"><?php echo $Products_delete->Rank->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $Products_delete->Name->headerCellClass() ?>"><span id="elh_Products_Name" class="Products_Name"><?php echo $Products_delete->Name->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->MaterialUnitPrice->Visible) { // MaterialUnitPrice ?>
		<th class="<?php echo $Products_delete->MaterialUnitPrice->headerCellClass() ?>"><span id="elh_Products_MaterialUnitPrice" class="Products_MaterialUnitPrice"><?php echo $Products_delete->MaterialUnitPrice->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<th class="<?php echo $Products_delete->FieldUnitPrice->headerCellClass() ?>"><span id="elh_Products_FieldUnitPrice" class="Products_FieldUnitPrice"><?php echo $Products_delete->FieldUnitPrice->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->ShopUnitPrice->Visible) { // ShopUnitPrice ?>
		<th class="<?php echo $Products_delete->ShopUnitPrice->headerCellClass() ?>"><span id="elh_Products_ShopUnitPrice" class="Products_ShopUnitPrice"><?php echo $Products_delete->ShopUnitPrice->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->EngineerUnitPrice->Visible) { // EngineerUnitPrice ?>
		<th class="<?php echo $Products_delete->EngineerUnitPrice->headerCellClass() ?>"><span id="elh_Products_EngineerUnitPrice" class="Products_EngineerUnitPrice"><?php echo $Products_delete->EngineerUnitPrice->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->DefaultQuantity->Visible) { // DefaultQuantity ?>
		<th class="<?php echo $Products_delete->DefaultQuantity->headerCellClass() ?>"><span id="elh_Products_DefaultQuantity" class="Products_DefaultQuantity"><?php echo $Products_delete->DefaultQuantity->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<th class="<?php echo $Products_delete->ProductSize_Idn->headerCellClass() ?>"><span id="elh_Products_ProductSize_Idn" class="Products_ProductSize_Idn"><?php echo $Products_delete->ProductSize_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->Description->Visible) { // Description ?>
		<th class="<?php echo $Products_delete->Description->headerCellClass() ?>"><span id="elh_Products_Description" class="Products_Description"><?php echo $Products_delete->Description->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<th class="<?php echo $Products_delete->PipeType_Idn->headerCellClass() ?>"><span id="elh_Products_PipeType_Idn" class="Products_PipeType_Idn"><?php echo $Products_delete->PipeType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
		<th class="<?php echo $Products_delete->ScheduleType_Idn->headerCellClass() ?>"><span id="elh_Products_ScheduleType_Idn" class="Products_ScheduleType_Idn"><?php echo $Products_delete->ScheduleType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->Fitting_Idn->Visible) { // Fitting_Idn ?>
		<th class="<?php echo $Products_delete->Fitting_Idn->headerCellClass() ?>"><span id="elh_Products_Fitting_Idn" class="Products_Fitting_Idn"><?php echo $Products_delete->Fitting_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
		<th class="<?php echo $Products_delete->GroovedFittingType_Idn->headerCellClass() ?>"><span id="elh_Products_GroovedFittingType_Idn" class="Products_GroovedFittingType_Idn"><?php echo $Products_delete->GroovedFittingType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
		<th class="<?php echo $Products_delete->ThreadedFittingType_Idn->headerCellClass() ?>"><span id="elh_Products_ThreadedFittingType_Idn" class="Products_ThreadedFittingType_Idn"><?php echo $Products_delete->ThreadedFittingType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<th class="<?php echo $Products_delete->HangerType_Idn->headerCellClass() ?>"><span id="elh_Products_HangerType_Idn" class="Products_HangerType_Idn"><?php echo $Products_delete->HangerType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<th class="<?php echo $Products_delete->HangerSubType_Idn->headerCellClass() ?>"><span id="elh_Products_HangerSubType_Idn" class="Products_HangerSubType_Idn"><?php echo $Products_delete->HangerSubType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->SubcontractCategory_Idn->Visible) { // SubcontractCategory_Idn ?>
		<th class="<?php echo $Products_delete->SubcontractCategory_Idn->headerCellClass() ?>"><span id="elh_Products_SubcontractCategory_Idn" class="Products_SubcontractCategory_Idn"><?php echo $Products_delete->SubcontractCategory_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->ApplyToAdjustmentFactorsFlag->Visible) { // ApplyToAdjustmentFactorsFlag ?>
		<th class="<?php echo $Products_delete->ApplyToAdjustmentFactorsFlag->headerCellClass() ?>"><span id="elh_Products_ApplyToAdjustmentFactorsFlag" class="Products_ApplyToAdjustmentFactorsFlag"><?php echo $Products_delete->ApplyToAdjustmentFactorsFlag->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->ApplyToContingencyFlag->Visible) { // ApplyToContingencyFlag ?>
		<th class="<?php echo $Products_delete->ApplyToContingencyFlag->headerCellClass() ?>"><span id="elh_Products_ApplyToContingencyFlag" class="Products_ApplyToContingencyFlag"><?php echo $Products_delete->ApplyToContingencyFlag->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->IsMainComponent->Visible) { // IsMainComponent ?>
		<th class="<?php echo $Products_delete->IsMainComponent->headerCellClass() ?>"><span id="elh_Products_IsMainComponent" class="Products_IsMainComponent"><?php echo $Products_delete->IsMainComponent->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->DomesticFlag->Visible) { // DomesticFlag ?>
		<th class="<?php echo $Products_delete->DomesticFlag->headerCellClass() ?>"><span id="elh_Products_DomesticFlag" class="Products_DomesticFlag"><?php echo $Products_delete->DomesticFlag->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->LoadFlag->Visible) { // LoadFlag ?>
		<th class="<?php echo $Products_delete->LoadFlag->headerCellClass() ?>"><span id="elh_Products_LoadFlag" class="Products_LoadFlag"><?php echo $Products_delete->LoadFlag->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<th class="<?php echo $Products_delete->AutoLoadFlag->headerCellClass() ?>"><span id="elh_Products_AutoLoadFlag" class="Products_AutoLoadFlag"><?php echo $Products_delete->AutoLoadFlag->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<th class="<?php echo $Products_delete->ActiveFlag->headerCellClass() ?>"><span id="elh_Products_ActiveFlag" class="Products_ActiveFlag"><?php echo $Products_delete->ActiveFlag->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->GradeType_Idn->Visible) { // GradeType_Idn ?>
		<th class="<?php echo $Products_delete->GradeType_Idn->headerCellClass() ?>"><span id="elh_Products_GradeType_Idn" class="Products_GradeType_Idn"><?php echo $Products_delete->GradeType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->PressureType_Idn->Visible) { // PressureType_Idn ?>
		<th class="<?php echo $Products_delete->PressureType_Idn->headerCellClass() ?>"><span id="elh_Products_PressureType_Idn" class="Products_PressureType_Idn"><?php echo $Products_delete->PressureType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->SeamlessFlag->Visible) { // SeamlessFlag ?>
		<th class="<?php echo $Products_delete->SeamlessFlag->headerCellClass() ?>"><span id="elh_Products_SeamlessFlag" class="Products_SeamlessFlag"><?php echo $Products_delete->SeamlessFlag->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->ResponseType->Visible) { // ResponseType ?>
		<th class="<?php echo $Products_delete->ResponseType->headerCellClass() ?>"><span id="elh_Products_ResponseType" class="Products_ResponseType"><?php echo $Products_delete->ResponseType->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->FMJobFlag->Visible) { // FMJobFlag ?>
		<th class="<?php echo $Products_delete->FMJobFlag->headerCellClass() ?>"><span id="elh_Products_FMJobFlag" class="Products_FMJobFlag"><?php echo $Products_delete->FMJobFlag->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->RecommendedBoxes->Visible) { // RecommendedBoxes ?>
		<th class="<?php echo $Products_delete->RecommendedBoxes->headerCellClass() ?>"><span id="elh_Products_RecommendedBoxes" class="Products_RecommendedBoxes"><?php echo $Products_delete->RecommendedBoxes->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->RecommendedWireFootage->Visible) { // RecommendedWireFootage ?>
		<th class="<?php echo $Products_delete->RecommendedWireFootage->headerCellClass() ?>"><span id="elh_Products_RecommendedWireFootage" class="Products_RecommendedWireFootage"><?php echo $Products_delete->RecommendedWireFootage->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
		<th class="<?php echo $Products_delete->CoverageType_Idn->headerCellClass() ?>"><span id="elh_Products_CoverageType_Idn" class="Products_CoverageType_Idn"><?php echo $Products_delete->CoverageType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->HeadType_Idn->Visible) { // HeadType_Idn ?>
		<th class="<?php echo $Products_delete->HeadType_Idn->headerCellClass() ?>"><span id="elh_Products_HeadType_Idn" class="Products_HeadType_Idn"><?php echo $Products_delete->HeadType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->FinishType_Idn->Visible) { // FinishType_Idn ?>
		<th class="<?php echo $Products_delete->FinishType_Idn->headerCellClass() ?>"><span id="elh_Products_FinishType_Idn" class="Products_FinishType_Idn"><?php echo $Products_delete->FinishType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->Outlet_Idn->Visible) { // Outlet_Idn ?>
		<th class="<?php echo $Products_delete->Outlet_Idn->headerCellClass() ?>"><span id="elh_Products_Outlet_Idn" class="Products_Outlet_Idn"><?php echo $Products_delete->Outlet_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->RiserType_Idn->Visible) { // RiserType_Idn ?>
		<th class="<?php echo $Products_delete->RiserType_Idn->headerCellClass() ?>"><span id="elh_Products_RiserType_Idn" class="Products_RiserType_Idn"><?php echo $Products_delete->RiserType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->BackFlowType_Idn->Visible) { // BackFlowType_Idn ?>
		<th class="<?php echo $Products_delete->BackFlowType_Idn->headerCellClass() ?>"><span id="elh_Products_BackFlowType_Idn" class="Products_BackFlowType_Idn"><?php echo $Products_delete->BackFlowType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
		<th class="<?php echo $Products_delete->ControlValve_Idn->headerCellClass() ?>"><span id="elh_Products_ControlValve_Idn" class="Products_ControlValve_Idn"><?php echo $Products_delete->ControlValve_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
		<th class="<?php echo $Products_delete->CheckValve_Idn->headerCellClass() ?>"><span id="elh_Products_CheckValve_Idn" class="Products_CheckValve_Idn"><?php echo $Products_delete->CheckValve_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->FDCType_Idn->Visible) { // FDCType_Idn ?>
		<th class="<?php echo $Products_delete->FDCType_Idn->headerCellClass() ?>"><span id="elh_Products_FDCType_Idn" class="Products_FDCType_Idn"><?php echo $Products_delete->FDCType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->BellType_Idn->Visible) { // BellType_Idn ?>
		<th class="<?php echo $Products_delete->BellType_Idn->headerCellClass() ?>"><span id="elh_Products_BellType_Idn" class="Products_BellType_Idn"><?php echo $Products_delete->BellType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
		<th class="<?php echo $Products_delete->TappingTee_Idn->headerCellClass() ?>"><span id="elh_Products_TappingTee_Idn" class="Products_TappingTee_Idn"><?php echo $Products_delete->TappingTee_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
		<th class="<?php echo $Products_delete->UndergroundValve_Idn->headerCellClass() ?>"><span id="elh_Products_UndergroundValve_Idn" class="Products_UndergroundValve_Idn"><?php echo $Products_delete->UndergroundValve_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
		<th class="<?php echo $Products_delete->LiftDuration_Idn->headerCellClass() ?>"><span id="elh_Products_LiftDuration_Idn" class="Products_LiftDuration_Idn"><?php echo $Products_delete->LiftDuration_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->TrimPackageFlag->Visible) { // TrimPackageFlag ?>
		<th class="<?php echo $Products_delete->TrimPackageFlag->headerCellClass() ?>"><span id="elh_Products_TrimPackageFlag" class="Products_TrimPackageFlag"><?php echo $Products_delete->TrimPackageFlag->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->ListedFlag->Visible) { // ListedFlag ?>
		<th class="<?php echo $Products_delete->ListedFlag->headerCellClass() ?>"><span id="elh_Products_ListedFlag" class="Products_ListedFlag"><?php echo $Products_delete->ListedFlag->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->BoxWireLength->Visible) { // BoxWireLength ?>
		<th class="<?php echo $Products_delete->BoxWireLength->headerCellClass() ?>"><span id="elh_Products_BoxWireLength" class="Products_BoxWireLength"><?php echo $Products_delete->BoxWireLength->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->IsFirePump->Visible) { // IsFirePump ?>
		<th class="<?php echo $Products_delete->IsFirePump->headerCellClass() ?>"><span id="elh_Products_IsFirePump" class="Products_IsFirePump"><?php echo $Products_delete->IsFirePump->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
		<th class="<?php echo $Products_delete->FirePumpType_Idn->headerCellClass() ?>"><span id="elh_Products_FirePumpType_Idn" class="Products_FirePumpType_Idn"><?php echo $Products_delete->FirePumpType_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
		<th class="<?php echo $Products_delete->FirePumpAttribute_Idn->headerCellClass() ?>"><span id="elh_Products_FirePumpAttribute_Idn" class="Products_FirePumpAttribute_Idn"><?php echo $Products_delete->FirePumpAttribute_Idn->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->IsDieselFuel->Visible) { // IsDieselFuel ?>
		<th class="<?php echo $Products_delete->IsDieselFuel->headerCellClass() ?>"><span id="elh_Products_IsDieselFuel" class="Products_IsDieselFuel"><?php echo $Products_delete->IsDieselFuel->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->IsSolution->Visible) { // IsSolution ?>
		<th class="<?php echo $Products_delete->IsSolution->headerCellClass() ?>"><span id="elh_Products_IsSolution" class="Products_IsSolution"><?php echo $Products_delete->IsSolution->caption() ?></span></th>
<?php } ?>
<?php if ($Products_delete->Position_Idn->Visible) { // Position_Idn ?>
		<th class="<?php echo $Products_delete->Position_Idn->headerCellClass() ?>"><span id="elh_Products_Position_Idn" class="Products_Position_Idn"><?php echo $Products_delete->Position_Idn->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Products_delete->RecordCount = 0;
$i = 0;
while (!$Products_delete->Recordset->EOF) {
	$Products_delete->RecordCount++;
	$Products_delete->RowCount++;

	// Set row properties
	$Products->resetAttributes();
	$Products->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Products_delete->loadRowValues($Products_delete->Recordset);

	// Render row
	$Products_delete->renderRow();
?>
	<tr <?php echo $Products->rowAttributes() ?>>
<?php if ($Products_delete->Product_Idn->Visible) { // Product_Idn ?>
		<td <?php echo $Products_delete->Product_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_Product_Idn" class="Products_Product_Idn">
<span<?php echo $Products_delete->Product_Idn->viewAttributes() ?>><?php echo $Products_delete->Product_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->Department_Idn->Visible) { // Department_Idn ?>
		<td <?php echo $Products_delete->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_Department_Idn" class="Products_Department_Idn">
<span<?php echo $Products_delete->Department_Idn->viewAttributes() ?>><?php echo $Products_delete->Department_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td <?php echo $Products_delete->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_WorksheetMaster_Idn" class="Products_WorksheetMaster_Idn">
<span<?php echo $Products_delete->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $Products_delete->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td <?php echo $Products_delete->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_WorksheetCategory_Idn" class="Products_WorksheetCategory_Idn">
<span<?php echo $Products_delete->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $Products_delete->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
		<td <?php echo $Products_delete->Manufacturer_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_Manufacturer_Idn" class="Products_Manufacturer_Idn">
<span<?php echo $Products_delete->Manufacturer_Idn->viewAttributes() ?>><?php echo $Products_delete->Manufacturer_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->Rank->Visible) { // Rank ?>
		<td <?php echo $Products_delete->Rank->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_Rank" class="Products_Rank">
<span<?php echo $Products_delete->Rank->viewAttributes() ?>><?php echo $Products_delete->Rank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->Name->Visible) { // Name ?>
		<td <?php echo $Products_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_Name" class="Products_Name">
<span<?php echo $Products_delete->Name->viewAttributes() ?>><?php echo $Products_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->MaterialUnitPrice->Visible) { // MaterialUnitPrice ?>
		<td <?php echo $Products_delete->MaterialUnitPrice->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_MaterialUnitPrice" class="Products_MaterialUnitPrice">
<span<?php echo $Products_delete->MaterialUnitPrice->viewAttributes() ?>><?php echo $Products_delete->MaterialUnitPrice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<td <?php echo $Products_delete->FieldUnitPrice->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_FieldUnitPrice" class="Products_FieldUnitPrice">
<span<?php echo $Products_delete->FieldUnitPrice->viewAttributes() ?>><?php echo $Products_delete->FieldUnitPrice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->ShopUnitPrice->Visible) { // ShopUnitPrice ?>
		<td <?php echo $Products_delete->ShopUnitPrice->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_ShopUnitPrice" class="Products_ShopUnitPrice">
<span<?php echo $Products_delete->ShopUnitPrice->viewAttributes() ?>><?php echo $Products_delete->ShopUnitPrice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->EngineerUnitPrice->Visible) { // EngineerUnitPrice ?>
		<td <?php echo $Products_delete->EngineerUnitPrice->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_EngineerUnitPrice" class="Products_EngineerUnitPrice">
<span<?php echo $Products_delete->EngineerUnitPrice->viewAttributes() ?>><?php echo $Products_delete->EngineerUnitPrice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->DefaultQuantity->Visible) { // DefaultQuantity ?>
		<td <?php echo $Products_delete->DefaultQuantity->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_DefaultQuantity" class="Products_DefaultQuantity">
<span<?php echo $Products_delete->DefaultQuantity->viewAttributes() ?>><?php echo $Products_delete->DefaultQuantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td <?php echo $Products_delete->ProductSize_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_ProductSize_Idn" class="Products_ProductSize_Idn">
<span<?php echo $Products_delete->ProductSize_Idn->viewAttributes() ?>><?php echo $Products_delete->ProductSize_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->Description->Visible) { // Description ?>
		<td <?php echo $Products_delete->Description->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_Description" class="Products_Description">
<span<?php echo $Products_delete->Description->viewAttributes() ?>><?php echo $Products_delete->Description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td <?php echo $Products_delete->PipeType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_PipeType_Idn" class="Products_PipeType_Idn">
<span<?php echo $Products_delete->PipeType_Idn->viewAttributes() ?>><?php echo $Products_delete->PipeType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
		<td <?php echo $Products_delete->ScheduleType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_ScheduleType_Idn" class="Products_ScheduleType_Idn">
<span<?php echo $Products_delete->ScheduleType_Idn->viewAttributes() ?>><?php echo $Products_delete->ScheduleType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->Fitting_Idn->Visible) { // Fitting_Idn ?>
		<td <?php echo $Products_delete->Fitting_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_Fitting_Idn" class="Products_Fitting_Idn">
<span<?php echo $Products_delete->Fitting_Idn->viewAttributes() ?>><?php echo $Products_delete->Fitting_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
		<td <?php echo $Products_delete->GroovedFittingType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_GroovedFittingType_Idn" class="Products_GroovedFittingType_Idn">
<span<?php echo $Products_delete->GroovedFittingType_Idn->viewAttributes() ?>><?php echo $Products_delete->GroovedFittingType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
		<td <?php echo $Products_delete->ThreadedFittingType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_ThreadedFittingType_Idn" class="Products_ThreadedFittingType_Idn">
<span<?php echo $Products_delete->ThreadedFittingType_Idn->viewAttributes() ?>><?php echo $Products_delete->ThreadedFittingType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td <?php echo $Products_delete->HangerType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_HangerType_Idn" class="Products_HangerType_Idn">
<span<?php echo $Products_delete->HangerType_Idn->viewAttributes() ?>><?php echo $Products_delete->HangerType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<td <?php echo $Products_delete->HangerSubType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_HangerSubType_Idn" class="Products_HangerSubType_Idn">
<span<?php echo $Products_delete->HangerSubType_Idn->viewAttributes() ?>><?php echo $Products_delete->HangerSubType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->SubcontractCategory_Idn->Visible) { // SubcontractCategory_Idn ?>
		<td <?php echo $Products_delete->SubcontractCategory_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_SubcontractCategory_Idn" class="Products_SubcontractCategory_Idn">
<span<?php echo $Products_delete->SubcontractCategory_Idn->viewAttributes() ?>><?php echo $Products_delete->SubcontractCategory_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->ApplyToAdjustmentFactorsFlag->Visible) { // ApplyToAdjustmentFactorsFlag ?>
		<td <?php echo $Products_delete->ApplyToAdjustmentFactorsFlag->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_ApplyToAdjustmentFactorsFlag" class="Products_ApplyToAdjustmentFactorsFlag">
<span<?php echo $Products_delete->ApplyToAdjustmentFactorsFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ApplyToAdjustmentFactorsFlag" class="custom-control-input" value="<?php echo $Products_delete->ApplyToAdjustmentFactorsFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->ApplyToAdjustmentFactorsFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ApplyToAdjustmentFactorsFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->ApplyToContingencyFlag->Visible) { // ApplyToContingencyFlag ?>
		<td <?php echo $Products_delete->ApplyToContingencyFlag->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_ApplyToContingencyFlag" class="Products_ApplyToContingencyFlag">
<span<?php echo $Products_delete->ApplyToContingencyFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ApplyToContingencyFlag" class="custom-control-input" value="<?php echo $Products_delete->ApplyToContingencyFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->ApplyToContingencyFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ApplyToContingencyFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->IsMainComponent->Visible) { // IsMainComponent ?>
		<td <?php echo $Products_delete->IsMainComponent->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_IsMainComponent" class="Products_IsMainComponent">
<span<?php echo $Products_delete->IsMainComponent->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsMainComponent" class="custom-control-input" value="<?php echo $Products_delete->IsMainComponent->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->IsMainComponent->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsMainComponent"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->DomesticFlag->Visible) { // DomesticFlag ?>
		<td <?php echo $Products_delete->DomesticFlag->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_DomesticFlag" class="Products_DomesticFlag">
<span<?php echo $Products_delete->DomesticFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DomesticFlag" class="custom-control-input" value="<?php echo $Products_delete->DomesticFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->DomesticFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DomesticFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->LoadFlag->Visible) { // LoadFlag ?>
		<td <?php echo $Products_delete->LoadFlag->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_LoadFlag" class="Products_LoadFlag">
<span<?php echo $Products_delete->LoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LoadFlag" class="custom-control-input" value="<?php echo $Products_delete->LoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->LoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LoadFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<td <?php echo $Products_delete->AutoLoadFlag->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_AutoLoadFlag" class="Products_AutoLoadFlag">
<span<?php echo $Products_delete->AutoLoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AutoLoadFlag" class="custom-control-input" value="<?php echo $Products_delete->AutoLoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->AutoLoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AutoLoadFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->ActiveFlag->Visible) { // ActiveFlag ?>
		<td <?php echo $Products_delete->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_ActiveFlag" class="Products_ActiveFlag">
<span<?php echo $Products_delete->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Products_delete->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->GradeType_Idn->Visible) { // GradeType_Idn ?>
		<td <?php echo $Products_delete->GradeType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_GradeType_Idn" class="Products_GradeType_Idn">
<span<?php echo $Products_delete->GradeType_Idn->viewAttributes() ?>><?php echo $Products_delete->GradeType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->PressureType_Idn->Visible) { // PressureType_Idn ?>
		<td <?php echo $Products_delete->PressureType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_PressureType_Idn" class="Products_PressureType_Idn">
<span<?php echo $Products_delete->PressureType_Idn->viewAttributes() ?>><?php echo $Products_delete->PressureType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->SeamlessFlag->Visible) { // SeamlessFlag ?>
		<td <?php echo $Products_delete->SeamlessFlag->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_SeamlessFlag" class="Products_SeamlessFlag">
<span<?php echo $Products_delete->SeamlessFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_SeamlessFlag" class="custom-control-input" value="<?php echo $Products_delete->SeamlessFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->SeamlessFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_SeamlessFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->ResponseType->Visible) { // ResponseType ?>
		<td <?php echo $Products_delete->ResponseType->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_ResponseType" class="Products_ResponseType">
<span<?php echo $Products_delete->ResponseType->viewAttributes() ?>><?php echo $Products_delete->ResponseType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->FMJobFlag->Visible) { // FMJobFlag ?>
		<td <?php echo $Products_delete->FMJobFlag->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_FMJobFlag" class="Products_FMJobFlag">
<span<?php echo $Products_delete->FMJobFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_FMJobFlag" class="custom-control-input" value="<?php echo $Products_delete->FMJobFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->FMJobFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_FMJobFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->RecommendedBoxes->Visible) { // RecommendedBoxes ?>
		<td <?php echo $Products_delete->RecommendedBoxes->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_RecommendedBoxes" class="Products_RecommendedBoxes">
<span<?php echo $Products_delete->RecommendedBoxes->viewAttributes() ?>><?php echo $Products_delete->RecommendedBoxes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->RecommendedWireFootage->Visible) { // RecommendedWireFootage ?>
		<td <?php echo $Products_delete->RecommendedWireFootage->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_RecommendedWireFootage" class="Products_RecommendedWireFootage">
<span<?php echo $Products_delete->RecommendedWireFootage->viewAttributes() ?>><?php echo $Products_delete->RecommendedWireFootage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
		<td <?php echo $Products_delete->CoverageType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_CoverageType_Idn" class="Products_CoverageType_Idn">
<span<?php echo $Products_delete->CoverageType_Idn->viewAttributes() ?>><?php echo $Products_delete->CoverageType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->HeadType_Idn->Visible) { // HeadType_Idn ?>
		<td <?php echo $Products_delete->HeadType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_HeadType_Idn" class="Products_HeadType_Idn">
<span<?php echo $Products_delete->HeadType_Idn->viewAttributes() ?>><?php echo $Products_delete->HeadType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->FinishType_Idn->Visible) { // FinishType_Idn ?>
		<td <?php echo $Products_delete->FinishType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_FinishType_Idn" class="Products_FinishType_Idn">
<span<?php echo $Products_delete->FinishType_Idn->viewAttributes() ?>><?php echo $Products_delete->FinishType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->Outlet_Idn->Visible) { // Outlet_Idn ?>
		<td <?php echo $Products_delete->Outlet_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_Outlet_Idn" class="Products_Outlet_Idn">
<span<?php echo $Products_delete->Outlet_Idn->viewAttributes() ?>><?php echo $Products_delete->Outlet_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->RiserType_Idn->Visible) { // RiserType_Idn ?>
		<td <?php echo $Products_delete->RiserType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_RiserType_Idn" class="Products_RiserType_Idn">
<span<?php echo $Products_delete->RiserType_Idn->viewAttributes() ?>><?php echo $Products_delete->RiserType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->BackFlowType_Idn->Visible) { // BackFlowType_Idn ?>
		<td <?php echo $Products_delete->BackFlowType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_BackFlowType_Idn" class="Products_BackFlowType_Idn">
<span<?php echo $Products_delete->BackFlowType_Idn->viewAttributes() ?>><?php echo $Products_delete->BackFlowType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
		<td <?php echo $Products_delete->ControlValve_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_ControlValve_Idn" class="Products_ControlValve_Idn">
<span<?php echo $Products_delete->ControlValve_Idn->viewAttributes() ?>><?php echo $Products_delete->ControlValve_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
		<td <?php echo $Products_delete->CheckValve_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_CheckValve_Idn" class="Products_CheckValve_Idn">
<span<?php echo $Products_delete->CheckValve_Idn->viewAttributes() ?>><?php echo $Products_delete->CheckValve_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->FDCType_Idn->Visible) { // FDCType_Idn ?>
		<td <?php echo $Products_delete->FDCType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_FDCType_Idn" class="Products_FDCType_Idn">
<span<?php echo $Products_delete->FDCType_Idn->viewAttributes() ?>><?php echo $Products_delete->FDCType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->BellType_Idn->Visible) { // BellType_Idn ?>
		<td <?php echo $Products_delete->BellType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_BellType_Idn" class="Products_BellType_Idn">
<span<?php echo $Products_delete->BellType_Idn->viewAttributes() ?>><?php echo $Products_delete->BellType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
		<td <?php echo $Products_delete->TappingTee_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_TappingTee_Idn" class="Products_TappingTee_Idn">
<span<?php echo $Products_delete->TappingTee_Idn->viewAttributes() ?>><?php echo $Products_delete->TappingTee_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
		<td <?php echo $Products_delete->UndergroundValve_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_UndergroundValve_Idn" class="Products_UndergroundValve_Idn">
<span<?php echo $Products_delete->UndergroundValve_Idn->viewAttributes() ?>><?php echo $Products_delete->UndergroundValve_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
		<td <?php echo $Products_delete->LiftDuration_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_LiftDuration_Idn" class="Products_LiftDuration_Idn">
<span<?php echo $Products_delete->LiftDuration_Idn->viewAttributes() ?>><?php echo $Products_delete->LiftDuration_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->TrimPackageFlag->Visible) { // TrimPackageFlag ?>
		<td <?php echo $Products_delete->TrimPackageFlag->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_TrimPackageFlag" class="Products_TrimPackageFlag">
<span<?php echo $Products_delete->TrimPackageFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TrimPackageFlag" class="custom-control-input" value="<?php echo $Products_delete->TrimPackageFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->TrimPackageFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TrimPackageFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->ListedFlag->Visible) { // ListedFlag ?>
		<td <?php echo $Products_delete->ListedFlag->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_ListedFlag" class="Products_ListedFlag">
<span<?php echo $Products_delete->ListedFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ListedFlag" class="custom-control-input" value="<?php echo $Products_delete->ListedFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->ListedFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ListedFlag"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->BoxWireLength->Visible) { // BoxWireLength ?>
		<td <?php echo $Products_delete->BoxWireLength->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_BoxWireLength" class="Products_BoxWireLength">
<span<?php echo $Products_delete->BoxWireLength->viewAttributes() ?>><?php echo $Products_delete->BoxWireLength->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->IsFirePump->Visible) { // IsFirePump ?>
		<td <?php echo $Products_delete->IsFirePump->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_IsFirePump" class="Products_IsFirePump">
<span<?php echo $Products_delete->IsFirePump->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsFirePump" class="custom-control-input" value="<?php echo $Products_delete->IsFirePump->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->IsFirePump->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsFirePump"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
		<td <?php echo $Products_delete->FirePumpType_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_FirePumpType_Idn" class="Products_FirePumpType_Idn">
<span<?php echo $Products_delete->FirePumpType_Idn->viewAttributes() ?>><?php echo $Products_delete->FirePumpType_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
		<td <?php echo $Products_delete->FirePumpAttribute_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_FirePumpAttribute_Idn" class="Products_FirePumpAttribute_Idn">
<span<?php echo $Products_delete->FirePumpAttribute_Idn->viewAttributes() ?>><?php echo $Products_delete->FirePumpAttribute_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->IsDieselFuel->Visible) { // IsDieselFuel ?>
		<td <?php echo $Products_delete->IsDieselFuel->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_IsDieselFuel" class="Products_IsDieselFuel">
<span<?php echo $Products_delete->IsDieselFuel->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsDieselFuel" class="custom-control-input" value="<?php echo $Products_delete->IsDieselFuel->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->IsDieselFuel->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsDieselFuel"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->IsSolution->Visible) { // IsSolution ?>
		<td <?php echo $Products_delete->IsSolution->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_IsSolution" class="Products_IsSolution">
<span<?php echo $Products_delete->IsSolution->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsSolution" class="custom-control-input" value="<?php echo $Products_delete->IsSolution->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_delete->IsSolution->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsSolution"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($Products_delete->Position_Idn->Visible) { // Position_Idn ?>
		<td <?php echo $Products_delete->Position_Idn->cellAttributes() ?>>
<span id="el<?php echo $Products_delete->RowCount ?>_Products_Position_Idn" class="Products_Position_Idn">
<span<?php echo $Products_delete->Position_Idn->viewAttributes() ?>><?php echo $Products_delete->Position_Idn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Products_delete->Recordset->moveNext();
}
$Products_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Products_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Products_delete->showPageFooter();
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
$Products_delete->terminate();
?>