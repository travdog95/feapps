<?php
namespace PHPMaker2020\feapps51;
?>
<?php if ($Products->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_Productsmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($Products->Product_Idn->Visible) { // Product_Idn ?>
		<tr id="r_Product_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->Product_Idn->caption() ?></td>
			<td <?php echo $Products->Product_Idn->cellAttributes() ?>>
<span id="el_Products_Product_Idn">
<span<?php echo $Products->Product_Idn->viewAttributes() ?>><?php echo $Products->Product_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->Department_Idn->Visible) { // Department_Idn ?>
		<tr id="r_Department_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->Department_Idn->caption() ?></td>
			<td <?php echo $Products->Department_Idn->cellAttributes() ?>>
<span id="el_Products_Department_Idn">
<span<?php echo $Products->Department_Idn->viewAttributes() ?>><?php echo $Products->Department_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<tr id="r_WorksheetMaster_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->WorksheetMaster_Idn->caption() ?></td>
			<td <?php echo $Products->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_Products_WorksheetMaster_Idn">
<span<?php echo $Products->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $Products->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<tr id="r_WorksheetCategory_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->WorksheetCategory_Idn->caption() ?></td>
			<td <?php echo $Products->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el_Products_WorksheetCategory_Idn">
<span<?php echo $Products->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $Products->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
		<tr id="r_Manufacturer_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->Manufacturer_Idn->caption() ?></td>
			<td <?php echo $Products->Manufacturer_Idn->cellAttributes() ?>>
<span id="el_Products_Manufacturer_Idn">
<span<?php echo $Products->Manufacturer_Idn->viewAttributes() ?>><?php echo $Products->Manufacturer_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->Rank->Visible) { // Rank ?>
		<tr id="r_Rank">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->Rank->caption() ?></td>
			<td <?php echo $Products->Rank->cellAttributes() ?>>
<span id="el_Products_Rank">
<span<?php echo $Products->Rank->viewAttributes() ?>><?php echo $Products->Rank->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->Name->Visible) { // Name ?>
		<tr id="r_Name">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->Name->caption() ?></td>
			<td <?php echo $Products->Name->cellAttributes() ?>>
<span id="el_Products_Name">
<span<?php echo $Products->Name->viewAttributes() ?>><?php echo $Products->Name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->MaterialUnitPrice->Visible) { // MaterialUnitPrice ?>
		<tr id="r_MaterialUnitPrice">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->MaterialUnitPrice->caption() ?></td>
			<td <?php echo $Products->MaterialUnitPrice->cellAttributes() ?>>
<span id="el_Products_MaterialUnitPrice">
<span<?php echo $Products->MaterialUnitPrice->viewAttributes() ?>><?php echo $Products->MaterialUnitPrice->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<tr id="r_FieldUnitPrice">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->FieldUnitPrice->caption() ?></td>
			<td <?php echo $Products->FieldUnitPrice->cellAttributes() ?>>
<span id="el_Products_FieldUnitPrice">
<span<?php echo $Products->FieldUnitPrice->viewAttributes() ?>><?php echo $Products->FieldUnitPrice->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->ShopUnitPrice->Visible) { // ShopUnitPrice ?>
		<tr id="r_ShopUnitPrice">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->ShopUnitPrice->caption() ?></td>
			<td <?php echo $Products->ShopUnitPrice->cellAttributes() ?>>
<span id="el_Products_ShopUnitPrice">
<span<?php echo $Products->ShopUnitPrice->viewAttributes() ?>><?php echo $Products->ShopUnitPrice->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->EngineerUnitPrice->Visible) { // EngineerUnitPrice ?>
		<tr id="r_EngineerUnitPrice">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->EngineerUnitPrice->caption() ?></td>
			<td <?php echo $Products->EngineerUnitPrice->cellAttributes() ?>>
<span id="el_Products_EngineerUnitPrice">
<span<?php echo $Products->EngineerUnitPrice->viewAttributes() ?>><?php echo $Products->EngineerUnitPrice->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->DefaultQuantity->Visible) { // DefaultQuantity ?>
		<tr id="r_DefaultQuantity">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->DefaultQuantity->caption() ?></td>
			<td <?php echo $Products->DefaultQuantity->cellAttributes() ?>>
<span id="el_Products_DefaultQuantity">
<span<?php echo $Products->DefaultQuantity->viewAttributes() ?>><?php echo $Products->DefaultQuantity->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<tr id="r_ProductSize_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->ProductSize_Idn->caption() ?></td>
			<td <?php echo $Products->ProductSize_Idn->cellAttributes() ?>>
<span id="el_Products_ProductSize_Idn">
<span<?php echo $Products->ProductSize_Idn->viewAttributes() ?>><?php echo $Products->ProductSize_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->Description->Visible) { // Description ?>
		<tr id="r_Description">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->Description->caption() ?></td>
			<td <?php echo $Products->Description->cellAttributes() ?>>
<span id="el_Products_Description">
<span<?php echo $Products->Description->viewAttributes() ?>><?php echo $Products->Description->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<tr id="r_PipeType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->PipeType_Idn->caption() ?></td>
			<td <?php echo $Products->PipeType_Idn->cellAttributes() ?>>
<span id="el_Products_PipeType_Idn">
<span<?php echo $Products->PipeType_Idn->viewAttributes() ?>><?php echo $Products->PipeType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
		<tr id="r_ScheduleType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->ScheduleType_Idn->caption() ?></td>
			<td <?php echo $Products->ScheduleType_Idn->cellAttributes() ?>>
<span id="el_Products_ScheduleType_Idn">
<span<?php echo $Products->ScheduleType_Idn->viewAttributes() ?>><?php echo $Products->ScheduleType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->Fitting_Idn->Visible) { // Fitting_Idn ?>
		<tr id="r_Fitting_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->Fitting_Idn->caption() ?></td>
			<td <?php echo $Products->Fitting_Idn->cellAttributes() ?>>
<span id="el_Products_Fitting_Idn">
<span<?php echo $Products->Fitting_Idn->viewAttributes() ?>><?php echo $Products->Fitting_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
		<tr id="r_GroovedFittingType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->GroovedFittingType_Idn->caption() ?></td>
			<td <?php echo $Products->GroovedFittingType_Idn->cellAttributes() ?>>
<span id="el_Products_GroovedFittingType_Idn">
<span<?php echo $Products->GroovedFittingType_Idn->viewAttributes() ?>><?php echo $Products->GroovedFittingType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
		<tr id="r_ThreadedFittingType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->ThreadedFittingType_Idn->caption() ?></td>
			<td <?php echo $Products->ThreadedFittingType_Idn->cellAttributes() ?>>
<span id="el_Products_ThreadedFittingType_Idn">
<span<?php echo $Products->ThreadedFittingType_Idn->viewAttributes() ?>><?php echo $Products->ThreadedFittingType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<tr id="r_HangerType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->HangerType_Idn->caption() ?></td>
			<td <?php echo $Products->HangerType_Idn->cellAttributes() ?>>
<span id="el_Products_HangerType_Idn">
<span<?php echo $Products->HangerType_Idn->viewAttributes() ?>><?php echo $Products->HangerType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<tr id="r_HangerSubType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->HangerSubType_Idn->caption() ?></td>
			<td <?php echo $Products->HangerSubType_Idn->cellAttributes() ?>>
<span id="el_Products_HangerSubType_Idn">
<span<?php echo $Products->HangerSubType_Idn->viewAttributes() ?>><?php echo $Products->HangerSubType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->SubcontractCategory_Idn->Visible) { // SubcontractCategory_Idn ?>
		<tr id="r_SubcontractCategory_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->SubcontractCategory_Idn->caption() ?></td>
			<td <?php echo $Products->SubcontractCategory_Idn->cellAttributes() ?>>
<span id="el_Products_SubcontractCategory_Idn">
<span<?php echo $Products->SubcontractCategory_Idn->viewAttributes() ?>><?php echo $Products->SubcontractCategory_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->ApplyToAdjustmentFactorsFlag->Visible) { // ApplyToAdjustmentFactorsFlag ?>
		<tr id="r_ApplyToAdjustmentFactorsFlag">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->ApplyToAdjustmentFactorsFlag->caption() ?></td>
			<td <?php echo $Products->ApplyToAdjustmentFactorsFlag->cellAttributes() ?>>
<span id="el_Products_ApplyToAdjustmentFactorsFlag">
<span<?php echo $Products->ApplyToAdjustmentFactorsFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ApplyToAdjustmentFactorsFlag" class="custom-control-input" value="<?php echo $Products->ApplyToAdjustmentFactorsFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->ApplyToAdjustmentFactorsFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ApplyToAdjustmentFactorsFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->ApplyToContingencyFlag->Visible) { // ApplyToContingencyFlag ?>
		<tr id="r_ApplyToContingencyFlag">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->ApplyToContingencyFlag->caption() ?></td>
			<td <?php echo $Products->ApplyToContingencyFlag->cellAttributes() ?>>
<span id="el_Products_ApplyToContingencyFlag">
<span<?php echo $Products->ApplyToContingencyFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ApplyToContingencyFlag" class="custom-control-input" value="<?php echo $Products->ApplyToContingencyFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->ApplyToContingencyFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ApplyToContingencyFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->IsMainComponent->Visible) { // IsMainComponent ?>
		<tr id="r_IsMainComponent">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->IsMainComponent->caption() ?></td>
			<td <?php echo $Products->IsMainComponent->cellAttributes() ?>>
<span id="el_Products_IsMainComponent">
<span<?php echo $Products->IsMainComponent->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsMainComponent" class="custom-control-input" value="<?php echo $Products->IsMainComponent->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->IsMainComponent->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsMainComponent"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->DomesticFlag->Visible) { // DomesticFlag ?>
		<tr id="r_DomesticFlag">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->DomesticFlag->caption() ?></td>
			<td <?php echo $Products->DomesticFlag->cellAttributes() ?>>
<span id="el_Products_DomesticFlag">
<span<?php echo $Products->DomesticFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DomesticFlag" class="custom-control-input" value="<?php echo $Products->DomesticFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->DomesticFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DomesticFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->LoadFlag->Visible) { // LoadFlag ?>
		<tr id="r_LoadFlag">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->LoadFlag->caption() ?></td>
			<td <?php echo $Products->LoadFlag->cellAttributes() ?>>
<span id="el_Products_LoadFlag">
<span<?php echo $Products->LoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LoadFlag" class="custom-control-input" value="<?php echo $Products->LoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->LoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LoadFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<tr id="r_AutoLoadFlag">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->AutoLoadFlag->caption() ?></td>
			<td <?php echo $Products->AutoLoadFlag->cellAttributes() ?>>
<span id="el_Products_AutoLoadFlag">
<span<?php echo $Products->AutoLoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AutoLoadFlag" class="custom-control-input" value="<?php echo $Products->AutoLoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->AutoLoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AutoLoadFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->ActiveFlag->Visible) { // ActiveFlag ?>
		<tr id="r_ActiveFlag">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->ActiveFlag->caption() ?></td>
			<td <?php echo $Products->ActiveFlag->cellAttributes() ?>>
<span id="el_Products_ActiveFlag">
<span<?php echo $Products->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Products->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->GradeType_Idn->Visible) { // GradeType_Idn ?>
		<tr id="r_GradeType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->GradeType_Idn->caption() ?></td>
			<td <?php echo $Products->GradeType_Idn->cellAttributes() ?>>
<span id="el_Products_GradeType_Idn">
<span<?php echo $Products->GradeType_Idn->viewAttributes() ?>><?php echo $Products->GradeType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->PressureType_Idn->Visible) { // PressureType_Idn ?>
		<tr id="r_PressureType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->PressureType_Idn->caption() ?></td>
			<td <?php echo $Products->PressureType_Idn->cellAttributes() ?>>
<span id="el_Products_PressureType_Idn">
<span<?php echo $Products->PressureType_Idn->viewAttributes() ?>><?php echo $Products->PressureType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->SeamlessFlag->Visible) { // SeamlessFlag ?>
		<tr id="r_SeamlessFlag">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->SeamlessFlag->caption() ?></td>
			<td <?php echo $Products->SeamlessFlag->cellAttributes() ?>>
<span id="el_Products_SeamlessFlag">
<span<?php echo $Products->SeamlessFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_SeamlessFlag" class="custom-control-input" value="<?php echo $Products->SeamlessFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->SeamlessFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_SeamlessFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->ResponseType->Visible) { // ResponseType ?>
		<tr id="r_ResponseType">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->ResponseType->caption() ?></td>
			<td <?php echo $Products->ResponseType->cellAttributes() ?>>
<span id="el_Products_ResponseType">
<span<?php echo $Products->ResponseType->viewAttributes() ?>><?php echo $Products->ResponseType->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->FMJobFlag->Visible) { // FMJobFlag ?>
		<tr id="r_FMJobFlag">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->FMJobFlag->caption() ?></td>
			<td <?php echo $Products->FMJobFlag->cellAttributes() ?>>
<span id="el_Products_FMJobFlag">
<span<?php echo $Products->FMJobFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_FMJobFlag" class="custom-control-input" value="<?php echo $Products->FMJobFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->FMJobFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_FMJobFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->RecommendedBoxes->Visible) { // RecommendedBoxes ?>
		<tr id="r_RecommendedBoxes">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->RecommendedBoxes->caption() ?></td>
			<td <?php echo $Products->RecommendedBoxes->cellAttributes() ?>>
<span id="el_Products_RecommendedBoxes">
<span<?php echo $Products->RecommendedBoxes->viewAttributes() ?>><?php echo $Products->RecommendedBoxes->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->RecommendedWireFootage->Visible) { // RecommendedWireFootage ?>
		<tr id="r_RecommendedWireFootage">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->RecommendedWireFootage->caption() ?></td>
			<td <?php echo $Products->RecommendedWireFootage->cellAttributes() ?>>
<span id="el_Products_RecommendedWireFootage">
<span<?php echo $Products->RecommendedWireFootage->viewAttributes() ?>><?php echo $Products->RecommendedWireFootage->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
		<tr id="r_CoverageType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->CoverageType_Idn->caption() ?></td>
			<td <?php echo $Products->CoverageType_Idn->cellAttributes() ?>>
<span id="el_Products_CoverageType_Idn">
<span<?php echo $Products->CoverageType_Idn->viewAttributes() ?>><?php echo $Products->CoverageType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->HeadType_Idn->Visible) { // HeadType_Idn ?>
		<tr id="r_HeadType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->HeadType_Idn->caption() ?></td>
			<td <?php echo $Products->HeadType_Idn->cellAttributes() ?>>
<span id="el_Products_HeadType_Idn">
<span<?php echo $Products->HeadType_Idn->viewAttributes() ?>><?php echo $Products->HeadType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->FinishType_Idn->Visible) { // FinishType_Idn ?>
		<tr id="r_FinishType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->FinishType_Idn->caption() ?></td>
			<td <?php echo $Products->FinishType_Idn->cellAttributes() ?>>
<span id="el_Products_FinishType_Idn">
<span<?php echo $Products->FinishType_Idn->viewAttributes() ?>><?php echo $Products->FinishType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->Outlet_Idn->Visible) { // Outlet_Idn ?>
		<tr id="r_Outlet_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->Outlet_Idn->caption() ?></td>
			<td <?php echo $Products->Outlet_Idn->cellAttributes() ?>>
<span id="el_Products_Outlet_Idn">
<span<?php echo $Products->Outlet_Idn->viewAttributes() ?>><?php echo $Products->Outlet_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->RiserType_Idn->Visible) { // RiserType_Idn ?>
		<tr id="r_RiserType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->RiserType_Idn->caption() ?></td>
			<td <?php echo $Products->RiserType_Idn->cellAttributes() ?>>
<span id="el_Products_RiserType_Idn">
<span<?php echo $Products->RiserType_Idn->viewAttributes() ?>><?php echo $Products->RiserType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->BackFlowType_Idn->Visible) { // BackFlowType_Idn ?>
		<tr id="r_BackFlowType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->BackFlowType_Idn->caption() ?></td>
			<td <?php echo $Products->BackFlowType_Idn->cellAttributes() ?>>
<span id="el_Products_BackFlowType_Idn">
<span<?php echo $Products->BackFlowType_Idn->viewAttributes() ?>><?php echo $Products->BackFlowType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
		<tr id="r_ControlValve_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->ControlValve_Idn->caption() ?></td>
			<td <?php echo $Products->ControlValve_Idn->cellAttributes() ?>>
<span id="el_Products_ControlValve_Idn">
<span<?php echo $Products->ControlValve_Idn->viewAttributes() ?>><?php echo $Products->ControlValve_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
		<tr id="r_CheckValve_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->CheckValve_Idn->caption() ?></td>
			<td <?php echo $Products->CheckValve_Idn->cellAttributes() ?>>
<span id="el_Products_CheckValve_Idn">
<span<?php echo $Products->CheckValve_Idn->viewAttributes() ?>><?php echo $Products->CheckValve_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->FDCType_Idn->Visible) { // FDCType_Idn ?>
		<tr id="r_FDCType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->FDCType_Idn->caption() ?></td>
			<td <?php echo $Products->FDCType_Idn->cellAttributes() ?>>
<span id="el_Products_FDCType_Idn">
<span<?php echo $Products->FDCType_Idn->viewAttributes() ?>><?php echo $Products->FDCType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->BellType_Idn->Visible) { // BellType_Idn ?>
		<tr id="r_BellType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->BellType_Idn->caption() ?></td>
			<td <?php echo $Products->BellType_Idn->cellAttributes() ?>>
<span id="el_Products_BellType_Idn">
<span<?php echo $Products->BellType_Idn->viewAttributes() ?>><?php echo $Products->BellType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
		<tr id="r_TappingTee_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->TappingTee_Idn->caption() ?></td>
			<td <?php echo $Products->TappingTee_Idn->cellAttributes() ?>>
<span id="el_Products_TappingTee_Idn">
<span<?php echo $Products->TappingTee_Idn->viewAttributes() ?>><?php echo $Products->TappingTee_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
		<tr id="r_UndergroundValve_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->UndergroundValve_Idn->caption() ?></td>
			<td <?php echo $Products->UndergroundValve_Idn->cellAttributes() ?>>
<span id="el_Products_UndergroundValve_Idn">
<span<?php echo $Products->UndergroundValve_Idn->viewAttributes() ?>><?php echo $Products->UndergroundValve_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
		<tr id="r_LiftDuration_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->LiftDuration_Idn->caption() ?></td>
			<td <?php echo $Products->LiftDuration_Idn->cellAttributes() ?>>
<span id="el_Products_LiftDuration_Idn">
<span<?php echo $Products->LiftDuration_Idn->viewAttributes() ?>><?php echo $Products->LiftDuration_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->TrimPackageFlag->Visible) { // TrimPackageFlag ?>
		<tr id="r_TrimPackageFlag">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->TrimPackageFlag->caption() ?></td>
			<td <?php echo $Products->TrimPackageFlag->cellAttributes() ?>>
<span id="el_Products_TrimPackageFlag">
<span<?php echo $Products->TrimPackageFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TrimPackageFlag" class="custom-control-input" value="<?php echo $Products->TrimPackageFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->TrimPackageFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TrimPackageFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->ListedFlag->Visible) { // ListedFlag ?>
		<tr id="r_ListedFlag">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->ListedFlag->caption() ?></td>
			<td <?php echo $Products->ListedFlag->cellAttributes() ?>>
<span id="el_Products_ListedFlag">
<span<?php echo $Products->ListedFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ListedFlag" class="custom-control-input" value="<?php echo $Products->ListedFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->ListedFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ListedFlag"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->BoxWireLength->Visible) { // BoxWireLength ?>
		<tr id="r_BoxWireLength">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->BoxWireLength->caption() ?></td>
			<td <?php echo $Products->BoxWireLength->cellAttributes() ?>>
<span id="el_Products_BoxWireLength">
<span<?php echo $Products->BoxWireLength->viewAttributes() ?>><?php echo $Products->BoxWireLength->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->IsFirePump->Visible) { // IsFirePump ?>
		<tr id="r_IsFirePump">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->IsFirePump->caption() ?></td>
			<td <?php echo $Products->IsFirePump->cellAttributes() ?>>
<span id="el_Products_IsFirePump">
<span<?php echo $Products->IsFirePump->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsFirePump" class="custom-control-input" value="<?php echo $Products->IsFirePump->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->IsFirePump->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsFirePump"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
		<tr id="r_FirePumpType_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->FirePumpType_Idn->caption() ?></td>
			<td <?php echo $Products->FirePumpType_Idn->cellAttributes() ?>>
<span id="el_Products_FirePumpType_Idn">
<span<?php echo $Products->FirePumpType_Idn->viewAttributes() ?>><?php echo $Products->FirePumpType_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
		<tr id="r_FirePumpAttribute_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->FirePumpAttribute_Idn->caption() ?></td>
			<td <?php echo $Products->FirePumpAttribute_Idn->cellAttributes() ?>>
<span id="el_Products_FirePumpAttribute_Idn">
<span<?php echo $Products->FirePumpAttribute_Idn->viewAttributes() ?>><?php echo $Products->FirePumpAttribute_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->IsDieselFuel->Visible) { // IsDieselFuel ?>
		<tr id="r_IsDieselFuel">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->IsDieselFuel->caption() ?></td>
			<td <?php echo $Products->IsDieselFuel->cellAttributes() ?>>
<span id="el_Products_IsDieselFuel">
<span<?php echo $Products->IsDieselFuel->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsDieselFuel" class="custom-control-input" value="<?php echo $Products->IsDieselFuel->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->IsDieselFuel->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsDieselFuel"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->IsSolution->Visible) { // IsSolution ?>
		<tr id="r_IsSolution">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->IsSolution->caption() ?></td>
			<td <?php echo $Products->IsSolution->cellAttributes() ?>>
<span id="el_Products_IsSolution">
<span<?php echo $Products->IsSolution->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsSolution" class="custom-control-input" value="<?php echo $Products->IsSolution->getViewValue() ?>" disabled<?php if (ConvertToBool($Products->IsSolution->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsSolution"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Products->Position_Idn->Visible) { // Position_Idn ?>
		<tr id="r_Position_Idn">
			<td class="<?php echo $Products->TableLeftColumnClass ?>"><?php echo $Products->Position_Idn->caption() ?></td>
			<td <?php echo $Products->Position_Idn->cellAttributes() ?>>
<span id="el_Products_Position_Idn">
<span<?php echo $Products->Position_Idn->viewAttributes() ?>><?php echo $Products->Position_Idn->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>