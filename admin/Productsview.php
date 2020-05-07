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
$Products_view = new Products_view();

// Run the page
$Products_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Products_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Products_view->isExport()) { ?>
<script>
var fProductsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fProductsview = currentForm = new ew.Form("fProductsview", "view");
	loadjs.done("fProductsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Products_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Products_view->ExportOptions->render("body") ?>
<?php $Products_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Products_view->showPageHeader(); ?>
<?php
$Products_view->showMessage();
?>
<?php if (!$Products_view->IsModal) { ?>
<?php if (!$Products_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Products_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fProductsview" id="fProductsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Products">
<input type="hidden" name="modal" value="<?php echo (int)$Products_view->IsModal ?>">
<?php if (!$Products_view->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="Products_view"><!-- multi-page tabs -->
	<ul class="<?php echo $Products_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $Products_view->MultiPages->pageStyle(1) ?>" href="#tab_Products1" data-toggle="tab"><?php echo $Products->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $Products_view->MultiPages->pageStyle(2) ?>" href="#tab_Products2" data-toggle="tab"><?php echo $Products->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $Products_view->MultiPages->pageStyle(3) ?>" href="#tab_Products3" data-toggle="tab"><?php echo $Products->pageCaption(3) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $Products_view->MultiPages->pageStyle(4) ?>" href="#tab_Products4" data-toggle="tab"><?php echo $Products->pageCaption(4) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$Products_view->isExport()) { ?>
		<div class="tab-pane<?php echo $Products_view->MultiPages->pageStyle(1) ?>" id="tab_Products1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($Products_view->Product_Idn->Visible) { // Product_Idn ?>
	<tr id="r_Product_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_Product_Idn"><?php echo $Products_view->Product_Idn->caption() ?></span></td>
		<td data-name="Product_Idn" <?php echo $Products_view->Product_Idn->cellAttributes() ?>>
<span id="el_Products_Product_Idn" data-page="1">
<span<?php echo $Products_view->Product_Idn->viewAttributes() ?>><?php echo $Products_view->Product_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->Department_Idn->Visible) { // Department_Idn ?>
	<tr id="r_Department_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_Department_Idn"><?php echo $Products_view->Department_Idn->caption() ?></span></td>
		<td data-name="Department_Idn" <?php echo $Products_view->Department_Idn->cellAttributes() ?>>
<span id="el_Products_Department_Idn" data-page="1">
<span<?php echo $Products_view->Department_Idn->viewAttributes() ?>><?php echo $Products_view->Department_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<tr id="r_WorksheetMaster_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_WorksheetMaster_Idn"><?php echo $Products_view->WorksheetMaster_Idn->caption() ?></span></td>
		<td data-name="WorksheetMaster_Idn" <?php echo $Products_view->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_Products_WorksheetMaster_Idn" data-page="1">
<span<?php echo $Products_view->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $Products_view->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<tr id="r_WorksheetCategory_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_WorksheetCategory_Idn"><?php echo $Products_view->WorksheetCategory_Idn->caption() ?></span></td>
		<td data-name="WorksheetCategory_Idn" <?php echo $Products_view->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el_Products_WorksheetCategory_Idn" data-page="1">
<span<?php echo $Products_view->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $Products_view->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
	<tr id="r_Manufacturer_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_Manufacturer_Idn"><?php echo $Products_view->Manufacturer_Idn->caption() ?></span></td>
		<td data-name="Manufacturer_Idn" <?php echo $Products_view->Manufacturer_Idn->cellAttributes() ?>>
<span id="el_Products_Manufacturer_Idn" data-page="1">
<span<?php echo $Products_view->Manufacturer_Idn->viewAttributes() ?>><?php echo $Products_view->Manufacturer_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->Rank->Visible) { // Rank ?>
	<tr id="r_Rank">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_Rank"><?php echo $Products_view->Rank->caption() ?></span></td>
		<td data-name="Rank" <?php echo $Products_view->Rank->cellAttributes() ?>>
<span id="el_Products_Rank" data-page="1">
<span<?php echo $Products_view->Rank->viewAttributes() ?>><?php echo $Products_view->Rank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_Name"><?php echo $Products_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $Products_view->Name->cellAttributes() ?>>
<span id="el_Products_Name" data-page="1">
<span<?php echo $Products_view->Name->viewAttributes() ?>><?php echo $Products_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->MaterialUnitPrice->Visible) { // MaterialUnitPrice ?>
	<tr id="r_MaterialUnitPrice">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_MaterialUnitPrice"><?php echo $Products_view->MaterialUnitPrice->caption() ?></span></td>
		<td data-name="MaterialUnitPrice" <?php echo $Products_view->MaterialUnitPrice->cellAttributes() ?>>
<span id="el_Products_MaterialUnitPrice" data-page="1">
<span<?php echo $Products_view->MaterialUnitPrice->viewAttributes() ?>><?php echo $Products_view->MaterialUnitPrice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
	<tr id="r_FieldUnitPrice">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_FieldUnitPrice"><?php echo $Products_view->FieldUnitPrice->caption() ?></span></td>
		<td data-name="FieldUnitPrice" <?php echo $Products_view->FieldUnitPrice->cellAttributes() ?>>
<span id="el_Products_FieldUnitPrice" data-page="1">
<span<?php echo $Products_view->FieldUnitPrice->viewAttributes() ?>><?php echo $Products_view->FieldUnitPrice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->ShopUnitPrice->Visible) { // ShopUnitPrice ?>
	<tr id="r_ShopUnitPrice">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_ShopUnitPrice"><?php echo $Products_view->ShopUnitPrice->caption() ?></span></td>
		<td data-name="ShopUnitPrice" <?php echo $Products_view->ShopUnitPrice->cellAttributes() ?>>
<span id="el_Products_ShopUnitPrice" data-page="1">
<span<?php echo $Products_view->ShopUnitPrice->viewAttributes() ?>><?php echo $Products_view->ShopUnitPrice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->EngineerUnitPrice->Visible) { // EngineerUnitPrice ?>
	<tr id="r_EngineerUnitPrice">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_EngineerUnitPrice"><?php echo $Products_view->EngineerUnitPrice->caption() ?></span></td>
		<td data-name="EngineerUnitPrice" <?php echo $Products_view->EngineerUnitPrice->cellAttributes() ?>>
<span id="el_Products_EngineerUnitPrice" data-page="1">
<span<?php echo $Products_view->EngineerUnitPrice->viewAttributes() ?>><?php echo $Products_view->EngineerUnitPrice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->DefaultQuantity->Visible) { // DefaultQuantity ?>
	<tr id="r_DefaultQuantity">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_DefaultQuantity"><?php echo $Products_view->DefaultQuantity->caption() ?></span></td>
		<td data-name="DefaultQuantity" <?php echo $Products_view->DefaultQuantity->cellAttributes() ?>>
<span id="el_Products_DefaultQuantity" data-page="1">
<span<?php echo $Products_view->DefaultQuantity->viewAttributes() ?>><?php echo $Products_view->DefaultQuantity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
	<tr id="r_ProductSize_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_ProductSize_Idn"><?php echo $Products_view->ProductSize_Idn->caption() ?></span></td>
		<td data-name="ProductSize_Idn" <?php echo $Products_view->ProductSize_Idn->cellAttributes() ?>>
<span id="el_Products_ProductSize_Idn" data-page="1">
<span<?php echo $Products_view->ProductSize_Idn->viewAttributes() ?>><?php echo $Products_view->ProductSize_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_Description"><?php echo $Products_view->Description->caption() ?></span></td>
		<td data-name="Description" <?php echo $Products_view->Description->cellAttributes() ?>>
<span id="el_Products_Description" data-page="1">
<span<?php echo $Products_view->Description->viewAttributes() ?>><?php echo $Products_view->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->PipeType_Idn->Visible) { // PipeType_Idn ?>
	<tr id="r_PipeType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_PipeType_Idn"><?php echo $Products_view->PipeType_Idn->caption() ?></span></td>
		<td data-name="PipeType_Idn" <?php echo $Products_view->PipeType_Idn->cellAttributes() ?>>
<span id="el_Products_PipeType_Idn" data-page="1">
<span<?php echo $Products_view->PipeType_Idn->viewAttributes() ?>><?php echo $Products_view->PipeType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
	<tr id="r_ScheduleType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_ScheduleType_Idn"><?php echo $Products_view->ScheduleType_Idn->caption() ?></span></td>
		<td data-name="ScheduleType_Idn" <?php echo $Products_view->ScheduleType_Idn->cellAttributes() ?>>
<span id="el_Products_ScheduleType_Idn" data-page="1">
<span<?php echo $Products_view->ScheduleType_Idn->viewAttributes() ?>><?php echo $Products_view->ScheduleType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->Fitting_Idn->Visible) { // Fitting_Idn ?>
	<tr id="r_Fitting_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_Fitting_Idn"><?php echo $Products_view->Fitting_Idn->caption() ?></span></td>
		<td data-name="Fitting_Idn" <?php echo $Products_view->Fitting_Idn->cellAttributes() ?>>
<span id="el_Products_Fitting_Idn" data-page="1">
<span<?php echo $Products_view->Fitting_Idn->viewAttributes() ?>><?php echo $Products_view->Fitting_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
	<tr id="r_GroovedFittingType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_GroovedFittingType_Idn"><?php echo $Products_view->GroovedFittingType_Idn->caption() ?></span></td>
		<td data-name="GroovedFittingType_Idn" <?php echo $Products_view->GroovedFittingType_Idn->cellAttributes() ?>>
<span id="el_Products_GroovedFittingType_Idn" data-page="1">
<span<?php echo $Products_view->GroovedFittingType_Idn->viewAttributes() ?>><?php echo $Products_view->GroovedFittingType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
	<tr id="r_ThreadedFittingType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_ThreadedFittingType_Idn"><?php echo $Products_view->ThreadedFittingType_Idn->caption() ?></span></td>
		<td data-name="ThreadedFittingType_Idn" <?php echo $Products_view->ThreadedFittingType_Idn->cellAttributes() ?>>
<span id="el_Products_ThreadedFittingType_Idn" data-page="1">
<span<?php echo $Products_view->ThreadedFittingType_Idn->viewAttributes() ?>><?php echo $Products_view->ThreadedFittingType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->HangerType_Idn->Visible) { // HangerType_Idn ?>
	<tr id="r_HangerType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_HangerType_Idn"><?php echo $Products_view->HangerType_Idn->caption() ?></span></td>
		<td data-name="HangerType_Idn" <?php echo $Products_view->HangerType_Idn->cellAttributes() ?>>
<span id="el_Products_HangerType_Idn" data-page="1">
<span<?php echo $Products_view->HangerType_Idn->viewAttributes() ?>><?php echo $Products_view->HangerType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
	<tr id="r_HangerSubType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_HangerSubType_Idn"><?php echo $Products_view->HangerSubType_Idn->caption() ?></span></td>
		<td data-name="HangerSubType_Idn" <?php echo $Products_view->HangerSubType_Idn->cellAttributes() ?>>
<span id="el_Products_HangerSubType_Idn" data-page="1">
<span<?php echo $Products_view->HangerSubType_Idn->viewAttributes() ?>><?php echo $Products_view->HangerSubType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->SubcontractCategory_Idn->Visible) { // SubcontractCategory_Idn ?>
	<tr id="r_SubcontractCategory_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_SubcontractCategory_Idn"><?php echo $Products_view->SubcontractCategory_Idn->caption() ?></span></td>
		<td data-name="SubcontractCategory_Idn" <?php echo $Products_view->SubcontractCategory_Idn->cellAttributes() ?>>
<span id="el_Products_SubcontractCategory_Idn" data-page="1">
<span<?php echo $Products_view->SubcontractCategory_Idn->viewAttributes() ?>><?php echo $Products_view->SubcontractCategory_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->ApplyToAdjustmentFactorsFlag->Visible) { // ApplyToAdjustmentFactorsFlag ?>
	<tr id="r_ApplyToAdjustmentFactorsFlag">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_ApplyToAdjustmentFactorsFlag"><?php echo $Products_view->ApplyToAdjustmentFactorsFlag->caption() ?></span></td>
		<td data-name="ApplyToAdjustmentFactorsFlag" <?php echo $Products_view->ApplyToAdjustmentFactorsFlag->cellAttributes() ?>>
<span id="el_Products_ApplyToAdjustmentFactorsFlag" data-page="1">
<span<?php echo $Products_view->ApplyToAdjustmentFactorsFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ApplyToAdjustmentFactorsFlag" class="custom-control-input" value="<?php echo $Products_view->ApplyToAdjustmentFactorsFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->ApplyToAdjustmentFactorsFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ApplyToAdjustmentFactorsFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->ApplyToContingencyFlag->Visible) { // ApplyToContingencyFlag ?>
	<tr id="r_ApplyToContingencyFlag">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_ApplyToContingencyFlag"><?php echo $Products_view->ApplyToContingencyFlag->caption() ?></span></td>
		<td data-name="ApplyToContingencyFlag" <?php echo $Products_view->ApplyToContingencyFlag->cellAttributes() ?>>
<span id="el_Products_ApplyToContingencyFlag" data-page="1">
<span<?php echo $Products_view->ApplyToContingencyFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ApplyToContingencyFlag" class="custom-control-input" value="<?php echo $Products_view->ApplyToContingencyFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->ApplyToContingencyFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ApplyToContingencyFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->IsMainComponent->Visible) { // IsMainComponent ?>
	<tr id="r_IsMainComponent">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_IsMainComponent"><?php echo $Products_view->IsMainComponent->caption() ?></span></td>
		<td data-name="IsMainComponent" <?php echo $Products_view->IsMainComponent->cellAttributes() ?>>
<span id="el_Products_IsMainComponent" data-page="1">
<span<?php echo $Products_view->IsMainComponent->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsMainComponent" class="custom-control-input" value="<?php echo $Products_view->IsMainComponent->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->IsMainComponent->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsMainComponent"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->DomesticFlag->Visible) { // DomesticFlag ?>
	<tr id="r_DomesticFlag">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_DomesticFlag"><?php echo $Products_view->DomesticFlag->caption() ?></span></td>
		<td data-name="DomesticFlag" <?php echo $Products_view->DomesticFlag->cellAttributes() ?>>
<span id="el_Products_DomesticFlag" data-page="1">
<span<?php echo $Products_view->DomesticFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DomesticFlag" class="custom-control-input" value="<?php echo $Products_view->DomesticFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->DomesticFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DomesticFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->LoadFlag->Visible) { // LoadFlag ?>
	<tr id="r_LoadFlag">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_LoadFlag"><?php echo $Products_view->LoadFlag->caption() ?></span></td>
		<td data-name="LoadFlag" <?php echo $Products_view->LoadFlag->cellAttributes() ?>>
<span id="el_Products_LoadFlag" data-page="1">
<span<?php echo $Products_view->LoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LoadFlag" class="custom-control-input" value="<?php echo $Products_view->LoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->LoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LoadFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
	<tr id="r_AutoLoadFlag">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_AutoLoadFlag"><?php echo $Products_view->AutoLoadFlag->caption() ?></span></td>
		<td data-name="AutoLoadFlag" <?php echo $Products_view->AutoLoadFlag->cellAttributes() ?>>
<span id="el_Products_AutoLoadFlag" data-page="1">
<span<?php echo $Products_view->AutoLoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AutoLoadFlag" class="custom-control-input" value="<?php echo $Products_view->AutoLoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->AutoLoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AutoLoadFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->ActiveFlag->Visible) { // ActiveFlag ?>
	<tr id="r_ActiveFlag">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_ActiveFlag"><?php echo $Products_view->ActiveFlag->caption() ?></span></td>
		<td data-name="ActiveFlag" <?php echo $Products_view->ActiveFlag->cellAttributes() ?>>
<span id="el_Products_ActiveFlag" data-page="1">
<span<?php echo $Products_view->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Products_view->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->ResponseType->Visible) { // ResponseType ?>
	<tr id="r_ResponseType">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_ResponseType"><?php echo $Products_view->ResponseType->caption() ?></span></td>
		<td data-name="ResponseType" <?php echo $Products_view->ResponseType->cellAttributes() ?>>
<span id="el_Products_ResponseType" data-page="1">
<span<?php echo $Products_view->ResponseType->viewAttributes() ?>><?php echo $Products_view->ResponseType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$Products_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$Products_view->isExport()) { ?>
		<div class="tab-pane<?php echo $Products_view->MultiPages->pageStyle(2) ?>" id="tab_Products2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($Products_view->GradeType_Idn->Visible) { // GradeType_Idn ?>
	<tr id="r_GradeType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_GradeType_Idn"><?php echo $Products_view->GradeType_Idn->caption() ?></span></td>
		<td data-name="GradeType_Idn" <?php echo $Products_view->GradeType_Idn->cellAttributes() ?>>
<span id="el_Products_GradeType_Idn" data-page="2">
<span<?php echo $Products_view->GradeType_Idn->viewAttributes() ?>><?php echo $Products_view->GradeType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->PressureType_Idn->Visible) { // PressureType_Idn ?>
	<tr id="r_PressureType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_PressureType_Idn"><?php echo $Products_view->PressureType_Idn->caption() ?></span></td>
		<td data-name="PressureType_Idn" <?php echo $Products_view->PressureType_Idn->cellAttributes() ?>>
<span id="el_Products_PressureType_Idn" data-page="2">
<span<?php echo $Products_view->PressureType_Idn->viewAttributes() ?>><?php echo $Products_view->PressureType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->SeamlessFlag->Visible) { // SeamlessFlag ?>
	<tr id="r_SeamlessFlag">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_SeamlessFlag"><?php echo $Products_view->SeamlessFlag->caption() ?></span></td>
		<td data-name="SeamlessFlag" <?php echo $Products_view->SeamlessFlag->cellAttributes() ?>>
<span id="el_Products_SeamlessFlag" data-page="2">
<span<?php echo $Products_view->SeamlessFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_SeamlessFlag" class="custom-control-input" value="<?php echo $Products_view->SeamlessFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->SeamlessFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_SeamlessFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->FMJobFlag->Visible) { // FMJobFlag ?>
	<tr id="r_FMJobFlag">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_FMJobFlag"><?php echo $Products_view->FMJobFlag->caption() ?></span></td>
		<td data-name="FMJobFlag" <?php echo $Products_view->FMJobFlag->cellAttributes() ?>>
<span id="el_Products_FMJobFlag" data-page="2">
<span<?php echo $Products_view->FMJobFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_FMJobFlag" class="custom-control-input" value="<?php echo $Products_view->FMJobFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->FMJobFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_FMJobFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->RecommendedBoxes->Visible) { // RecommendedBoxes ?>
	<tr id="r_RecommendedBoxes">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_RecommendedBoxes"><?php echo $Products_view->RecommendedBoxes->caption() ?></span></td>
		<td data-name="RecommendedBoxes" <?php echo $Products_view->RecommendedBoxes->cellAttributes() ?>>
<span id="el_Products_RecommendedBoxes" data-page="2">
<span<?php echo $Products_view->RecommendedBoxes->viewAttributes() ?>><?php echo $Products_view->RecommendedBoxes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->RecommendedWireFootage->Visible) { // RecommendedWireFootage ?>
	<tr id="r_RecommendedWireFootage">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_RecommendedWireFootage"><?php echo $Products_view->RecommendedWireFootage->caption() ?></span></td>
		<td data-name="RecommendedWireFootage" <?php echo $Products_view->RecommendedWireFootage->cellAttributes() ?>>
<span id="el_Products_RecommendedWireFootage" data-page="2">
<span<?php echo $Products_view->RecommendedWireFootage->viewAttributes() ?>><?php echo $Products_view->RecommendedWireFootage->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$Products_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$Products_view->isExport()) { ?>
		<div class="tab-pane<?php echo $Products_view->MultiPages->pageStyle(3) ?>" id="tab_Products3"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($Products_view->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
	<tr id="r_CoverageType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_CoverageType_Idn"><?php echo $Products_view->CoverageType_Idn->caption() ?></span></td>
		<td data-name="CoverageType_Idn" <?php echo $Products_view->CoverageType_Idn->cellAttributes() ?>>
<span id="el_Products_CoverageType_Idn" data-page="3">
<span<?php echo $Products_view->CoverageType_Idn->viewAttributes() ?>><?php echo $Products_view->CoverageType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->HeadType_Idn->Visible) { // HeadType_Idn ?>
	<tr id="r_HeadType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_HeadType_Idn"><?php echo $Products_view->HeadType_Idn->caption() ?></span></td>
		<td data-name="HeadType_Idn" <?php echo $Products_view->HeadType_Idn->cellAttributes() ?>>
<span id="el_Products_HeadType_Idn" data-page="3">
<span<?php echo $Products_view->HeadType_Idn->viewAttributes() ?>><?php echo $Products_view->HeadType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->FinishType_Idn->Visible) { // FinishType_Idn ?>
	<tr id="r_FinishType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_FinishType_Idn"><?php echo $Products_view->FinishType_Idn->caption() ?></span></td>
		<td data-name="FinishType_Idn" <?php echo $Products_view->FinishType_Idn->cellAttributes() ?>>
<span id="el_Products_FinishType_Idn" data-page="3">
<span<?php echo $Products_view->FinishType_Idn->viewAttributes() ?>><?php echo $Products_view->FinishType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->Outlet_Idn->Visible) { // Outlet_Idn ?>
	<tr id="r_Outlet_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_Outlet_Idn"><?php echo $Products_view->Outlet_Idn->caption() ?></span></td>
		<td data-name="Outlet_Idn" <?php echo $Products_view->Outlet_Idn->cellAttributes() ?>>
<span id="el_Products_Outlet_Idn" data-page="3">
<span<?php echo $Products_view->Outlet_Idn->viewAttributes() ?>><?php echo $Products_view->Outlet_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->RiserType_Idn->Visible) { // RiserType_Idn ?>
	<tr id="r_RiserType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_RiserType_Idn"><?php echo $Products_view->RiserType_Idn->caption() ?></span></td>
		<td data-name="RiserType_Idn" <?php echo $Products_view->RiserType_Idn->cellAttributes() ?>>
<span id="el_Products_RiserType_Idn" data-page="3">
<span<?php echo $Products_view->RiserType_Idn->viewAttributes() ?>><?php echo $Products_view->RiserType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->BackFlowType_Idn->Visible) { // BackFlowType_Idn ?>
	<tr id="r_BackFlowType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_BackFlowType_Idn"><?php echo $Products_view->BackFlowType_Idn->caption() ?></span></td>
		<td data-name="BackFlowType_Idn" <?php echo $Products_view->BackFlowType_Idn->cellAttributes() ?>>
<span id="el_Products_BackFlowType_Idn" data-page="3">
<span<?php echo $Products_view->BackFlowType_Idn->viewAttributes() ?>><?php echo $Products_view->BackFlowType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
	<tr id="r_ControlValve_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_ControlValve_Idn"><?php echo $Products_view->ControlValve_Idn->caption() ?></span></td>
		<td data-name="ControlValve_Idn" <?php echo $Products_view->ControlValve_Idn->cellAttributes() ?>>
<span id="el_Products_ControlValve_Idn" data-page="3">
<span<?php echo $Products_view->ControlValve_Idn->viewAttributes() ?>><?php echo $Products_view->ControlValve_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
	<tr id="r_CheckValve_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_CheckValve_Idn"><?php echo $Products_view->CheckValve_Idn->caption() ?></span></td>
		<td data-name="CheckValve_Idn" <?php echo $Products_view->CheckValve_Idn->cellAttributes() ?>>
<span id="el_Products_CheckValve_Idn" data-page="3">
<span<?php echo $Products_view->CheckValve_Idn->viewAttributes() ?>><?php echo $Products_view->CheckValve_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->FDCType_Idn->Visible) { // FDCType_Idn ?>
	<tr id="r_FDCType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_FDCType_Idn"><?php echo $Products_view->FDCType_Idn->caption() ?></span></td>
		<td data-name="FDCType_Idn" <?php echo $Products_view->FDCType_Idn->cellAttributes() ?>>
<span id="el_Products_FDCType_Idn" data-page="3">
<span<?php echo $Products_view->FDCType_Idn->viewAttributes() ?>><?php echo $Products_view->FDCType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->BellType_Idn->Visible) { // BellType_Idn ?>
	<tr id="r_BellType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_BellType_Idn"><?php echo $Products_view->BellType_Idn->caption() ?></span></td>
		<td data-name="BellType_Idn" <?php echo $Products_view->BellType_Idn->cellAttributes() ?>>
<span id="el_Products_BellType_Idn" data-page="3">
<span<?php echo $Products_view->BellType_Idn->viewAttributes() ?>><?php echo $Products_view->BellType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
	<tr id="r_TappingTee_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_TappingTee_Idn"><?php echo $Products_view->TappingTee_Idn->caption() ?></span></td>
		<td data-name="TappingTee_Idn" <?php echo $Products_view->TappingTee_Idn->cellAttributes() ?>>
<span id="el_Products_TappingTee_Idn" data-page="3">
<span<?php echo $Products_view->TappingTee_Idn->viewAttributes() ?>><?php echo $Products_view->TappingTee_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
	<tr id="r_UndergroundValve_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_UndergroundValve_Idn"><?php echo $Products_view->UndergroundValve_Idn->caption() ?></span></td>
		<td data-name="UndergroundValve_Idn" <?php echo $Products_view->UndergroundValve_Idn->cellAttributes() ?>>
<span id="el_Products_UndergroundValve_Idn" data-page="3">
<span<?php echo $Products_view->UndergroundValve_Idn->viewAttributes() ?>><?php echo $Products_view->UndergroundValve_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
	<tr id="r_LiftDuration_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_LiftDuration_Idn"><?php echo $Products_view->LiftDuration_Idn->caption() ?></span></td>
		<td data-name="LiftDuration_Idn" <?php echo $Products_view->LiftDuration_Idn->cellAttributes() ?>>
<span id="el_Products_LiftDuration_Idn" data-page="3">
<span<?php echo $Products_view->LiftDuration_Idn->viewAttributes() ?>><?php echo $Products_view->LiftDuration_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->TrimPackageFlag->Visible) { // TrimPackageFlag ?>
	<tr id="r_TrimPackageFlag">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_TrimPackageFlag"><?php echo $Products_view->TrimPackageFlag->caption() ?></span></td>
		<td data-name="TrimPackageFlag" <?php echo $Products_view->TrimPackageFlag->cellAttributes() ?>>
<span id="el_Products_TrimPackageFlag" data-page="3">
<span<?php echo $Products_view->TrimPackageFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TrimPackageFlag" class="custom-control-input" value="<?php echo $Products_view->TrimPackageFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->TrimPackageFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TrimPackageFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->ListedFlag->Visible) { // ListedFlag ?>
	<tr id="r_ListedFlag">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_ListedFlag"><?php echo $Products_view->ListedFlag->caption() ?></span></td>
		<td data-name="ListedFlag" <?php echo $Products_view->ListedFlag->cellAttributes() ?>>
<span id="el_Products_ListedFlag" data-page="3">
<span<?php echo $Products_view->ListedFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ListedFlag" class="custom-control-input" value="<?php echo $Products_view->ListedFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->ListedFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ListedFlag"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->BoxWireLength->Visible) { // BoxWireLength ?>
	<tr id="r_BoxWireLength">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_BoxWireLength"><?php echo $Products_view->BoxWireLength->caption() ?></span></td>
		<td data-name="BoxWireLength" <?php echo $Products_view->BoxWireLength->cellAttributes() ?>>
<span id="el_Products_BoxWireLength" data-page="3">
<span<?php echo $Products_view->BoxWireLength->viewAttributes() ?>><?php echo $Products_view->BoxWireLength->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$Products_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$Products_view->isExport()) { ?>
		<div class="tab-pane<?php echo $Products_view->MultiPages->pageStyle(4) ?>" id="tab_Products4"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($Products_view->IsFirePump->Visible) { // IsFirePump ?>
	<tr id="r_IsFirePump">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_IsFirePump"><?php echo $Products_view->IsFirePump->caption() ?></span></td>
		<td data-name="IsFirePump" <?php echo $Products_view->IsFirePump->cellAttributes() ?>>
<span id="el_Products_IsFirePump" data-page="4">
<span<?php echo $Products_view->IsFirePump->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsFirePump" class="custom-control-input" value="<?php echo $Products_view->IsFirePump->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->IsFirePump->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsFirePump"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
	<tr id="r_FirePumpType_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_FirePumpType_Idn"><?php echo $Products_view->FirePumpType_Idn->caption() ?></span></td>
		<td data-name="FirePumpType_Idn" <?php echo $Products_view->FirePumpType_Idn->cellAttributes() ?>>
<span id="el_Products_FirePumpType_Idn" data-page="4">
<span<?php echo $Products_view->FirePumpType_Idn->viewAttributes() ?>><?php echo $Products_view->FirePumpType_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
	<tr id="r_FirePumpAttribute_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_FirePumpAttribute_Idn"><?php echo $Products_view->FirePumpAttribute_Idn->caption() ?></span></td>
		<td data-name="FirePumpAttribute_Idn" <?php echo $Products_view->FirePumpAttribute_Idn->cellAttributes() ?>>
<span id="el_Products_FirePumpAttribute_Idn" data-page="4">
<span<?php echo $Products_view->FirePumpAttribute_Idn->viewAttributes() ?>><?php echo $Products_view->FirePumpAttribute_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->IsDieselFuel->Visible) { // IsDieselFuel ?>
	<tr id="r_IsDieselFuel">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_IsDieselFuel"><?php echo $Products_view->IsDieselFuel->caption() ?></span></td>
		<td data-name="IsDieselFuel" <?php echo $Products_view->IsDieselFuel->cellAttributes() ?>>
<span id="el_Products_IsDieselFuel" data-page="4">
<span<?php echo $Products_view->IsDieselFuel->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsDieselFuel" class="custom-control-input" value="<?php echo $Products_view->IsDieselFuel->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->IsDieselFuel->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsDieselFuel"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->IsSolution->Visible) { // IsSolution ?>
	<tr id="r_IsSolution">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_IsSolution"><?php echo $Products_view->IsSolution->caption() ?></span></td>
		<td data-name="IsSolution" <?php echo $Products_view->IsSolution->cellAttributes() ?>>
<span id="el_Products_IsSolution" data-page="4">
<span<?php echo $Products_view->IsSolution->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsSolution" class="custom-control-input" value="<?php echo $Products_view->IsSolution->getViewValue() ?>" disabled<?php if (ConvertToBool($Products_view->IsSolution->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsSolution"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Products_view->Position_Idn->Visible) { // Position_Idn ?>
	<tr id="r_Position_Idn">
		<td class="<?php echo $Products_view->TableLeftColumnClass ?>"><span id="elh_Products_Position_Idn"><?php echo $Products_view->Position_Idn->caption() ?></span></td>
		<td data-name="Position_Idn" <?php echo $Products_view->Position_Idn->cellAttributes() ?>>
<span id="el_Products_Position_Idn" data-page="4">
<span<?php echo $Products_view->Position_Idn->viewAttributes() ?>><?php echo $Products_view->Position_Idn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$Products_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$Products_view->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$Products_view->IsModal) { ?>
<?php if (!$Products_view->isExport()) { ?>
<?php echo $Products_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$Products_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Products_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$Products_view->terminate();
?>