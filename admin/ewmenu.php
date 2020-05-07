<?php
namespace PHPMaker2020\feapps51;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(4, "mi_AdjustmentFactors", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "AdjustmentFactorslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}AdjustmentFactors'), FALSE, FALSE, "fa-adjust", "", FALSE);
$sideMenu->addMenuItem(17, "mi_BondRates", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "BondRateslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}BondRates'), FALSE, FALSE, "fa-dollar-sign", "", FALSE);
$sideMenu->addMenuItem(18, "mi_CartParms", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "CartParmslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}CartParms'), FALSE, FALSE, "fa-shopping-cart", "", FALSE);
$sideMenu->addMenuItem(1, "mi_jpr_Department", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "jpr_Departmentlist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}jpr_Department'), FALSE, FALSE, "fa-building", "", FALSE);
$sideMenu->addMenuItem(23, "mi_EngineeringAdditionalCosts", $MenuLanguage->MenuPhrase("23", "MenuText"), $MenuRelativePath . "EngineeringAdditionalCostslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}EngineeringAdditionalCosts'), FALSE, FALSE, "fa-bacon", "", FALSE);
$sideMenu->addMenuItem(24, "mi_EstimateTypes", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "EstimateTypeslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}EstimateTypes'), FALSE, FALSE, "fa-sign", "", FALSE);
$sideMenu->addMenuItem(27, "mi_FinishWorks", $MenuLanguage->MenuPhrase("27", "MenuText"), $MenuRelativePath . "FinishWorkslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}FinishWorks'), FALSE, FALSE, "fa-clipboard-list", "", FALSE);
$sideMenu->addMenuItem(79, "mci_Fire_Pumps", $MenuLanguage->MenuPhrase("79", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa-fire", "", FALSE);
$sideMenu->addMenuItem(29, "mi_FirePumpTypes", $MenuLanguage->MenuPhrase("29", "MenuText"), $MenuRelativePath . "FirePumpTypeslist.php", 79, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}FirePumpTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(28, "mi_FirePumpAttributes", $MenuLanguage->MenuPhrase("28", "MenuText"), $MenuRelativePath . "FirePumpAttributeslist.php", 79, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}FirePumpAttributes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(31, "mi_GPMs", $MenuLanguage->MenuPhrase("31", "MenuText"), $MenuRelativePath . "GPMslist.php", 79, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}GPMs'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(80, "mci_Fittings", $MenuLanguage->MenuPhrase("80", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa-wrench", "", FALSE);
$sideMenu->addMenuItem(30, "mi_Fittings", $MenuLanguage->MenuPhrase("30", "MenuText"), $MenuRelativePath . "Fittingslist.php", 80, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}Fittings'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(33, "mi_GroovedFittingTypes", $MenuLanguage->MenuPhrase("33", "MenuText"), $MenuRelativePath . "GroovedFittingTypeslist.php", 80, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}GroovedFittingTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(53, "mi_ThreadedFittingTypes", $MenuLanguage->MenuPhrase("53", "MenuText"), $MenuRelativePath . "ThreadedFittingTypeslist.php", 80, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}ThreadedFittingTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(32, "mi_GradeTypes", $MenuLanguage->MenuPhrase("32", "MenuText"), $MenuRelativePath . "GradeTypeslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}GradeTypes'), FALSE, FALSE, "fa-tools", "", FALSE);
$sideMenu->addMenuItem(35, "mi_HangerTypes", $MenuLanguage->MenuPhrase("35", "MenuText"), $MenuRelativePath . "HangerTypeslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}HangerTypes'), FALSE, FALSE, "fa-exchange-alt", "", FALSE);
$sideMenu->addMenuItem(81, "mci_Heads", $MenuLanguage->MenuPhrase("81", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa-horse-head", "", FALSE);
$sideMenu->addMenuItem(22, "mi_CoverageTypes", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "CoverageTypeslist.php", 81, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}CoverageTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(26, "mi_FinishTypes", $MenuLanguage->MenuPhrase("26", "MenuText"), $MenuRelativePath . "FinishTypeslist.php", 81, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}FinishTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(36, "mi_HeadTypes", $MenuLanguage->MenuPhrase("36", "MenuText"), $MenuRelativePath . "HeadTypeslist.php", 81, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}HeadTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(82, "mci_Job_Maintenance", $MenuLanguage->MenuPhrase("82", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa-cog", "", FALSE);
$sideMenu->addMenuItem(37, "mi_JobDefaults", $MenuLanguage->MenuPhrase("37", "MenuText"), $MenuRelativePath . "JobDefaultslist.php", 82, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}JobDefaults'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(38, "mi_JobDefaultTypes", $MenuLanguage->MenuPhrase("38", "MenuText"), $MenuRelativePath . "JobDefaultTypeslist.php", 82, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}JobDefaultTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(39, "mi_JobStatuses", $MenuLanguage->MenuPhrase("39", "MenuText"), $MenuRelativePath . "JobStatuseslist.php", 82, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}JobStatuses'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(41, "mi_JobTypes", $MenuLanguage->MenuPhrase("41", "MenuText"), $MenuRelativePath . "JobTypeslist.php", 82, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}JobTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(83, "mci_Job_Recap", $MenuLanguage->MenuPhrase("83", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa-chart-pie", "", FALSE);
$sideMenu->addMenuItem(12, "mi_WorksheetColumns", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "WorksheetColumnslist.php", 83, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}WorksheetColumns'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(58, "mi_RecapCells", $MenuLanguage->MenuPhrase("58", "MenuText"), $MenuRelativePath . "RecapCellslist.php", 83, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}RecapCells'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(59, "mi_RecapRows", $MenuLanguage->MenuPhrase("59", "MenuText"), $MenuRelativePath . "RecapRowslist.php", 83, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}RecapRows'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(60, "mi_RecapRowWorksheetMasters", $MenuLanguage->MenuPhrase("60", "MenuText"), $MenuRelativePath . "RecapRowWorksheetMasterslist.php", 83, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}RecapRowWorksheetMasters'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(61, "mi_RecapSubtotalCategories", $MenuLanguage->MenuPhrase("61", "MenuText"), $MenuRelativePath . "RecapSubtotalCategorieslist.php", 83, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}RecapSubtotalCategories'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(62, "mi_RecapTotalCategories", $MenuLanguage->MenuPhrase("62", "MenuText"), $MenuRelativePath . "RecapTotalCategorieslist.php", 83, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}RecapTotalCategories'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(42, "mi_LiftDurations", $MenuLanguage->MenuPhrase("42", "MenuText"), $MenuRelativePath . "LiftDurationslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}LiftDurations'), FALSE, FALSE, "fa-lightbulb", "", FALSE);
$sideMenu->addMenuItem(43, "mi_Manufacturers", $MenuLanguage->MenuPhrase("43", "MenuText"), $MenuRelativePath . "Manufacturerslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}Manufacturers'), FALSE, FALSE, "fa-industry", "", FALSE);
$sideMenu->addMenuItem(84, "mci_Menus", $MenuLanguage->MenuPhrase("84", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa-bars", "", FALSE);
$sideMenu->addMenuItem(44, "mi_Menus", $MenuLanguage->MenuPhrase("44", "MenuText"), $MenuRelativePath . "Menuslist.php", 84, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}Menus'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(45, "mi_MenuTypes", $MenuLanguage->MenuPhrase("45", "MenuText"), $MenuRelativePath . "MenuTypeslist.php", 84, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}MenuTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(46, "mi_Outlets", $MenuLanguage->MenuPhrase("46", "MenuText"), $MenuRelativePath . "Outletslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}Outlets'), FALSE, FALSE, "fa-eye-dropper", "", FALSE);
$sideMenu->addMenuItem(85, "mci_Pipe_Maintenance", $MenuLanguage->MenuPhrase("85", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa-toilet", "", FALSE);
$sideMenu->addMenuItem(47, "mi_PipeExposures", $MenuLanguage->MenuPhrase("47", "MenuText"), $MenuRelativePath . "PipeExposureslist.php", 85, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}PipeExposures'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(48, "mi_PipeLengths", $MenuLanguage->MenuPhrase("48", "MenuText"), $MenuRelativePath . "PipeLengthslist.php", 85, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}PipeLengths'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(49, "mi_PipeTypes", $MenuLanguage->MenuPhrase("49", "MenuText"), $MenuRelativePath . "PipeTypeslist.php", 85, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}PipeTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(50, "mi_PressureTypes", $MenuLanguage->MenuPhrase("50", "MenuText"), $MenuRelativePath . "PressureTypeslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}PressureTypes'), FALSE, FALSE, "fa-coffee", "", FALSE);
$sideMenu->addMenuItem(51, "mi_Products", $MenuLanguage->MenuPhrase("51", "MenuText"), $MenuRelativePath . "Productslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}Products'), FALSE, FALSE, "fa-store-alt", "", FALSE);
$sideMenu->addMenuItem(10, "mi_ProductSizes", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "ProductSizeslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}ProductSizes'), FALSE, FALSE, "fa-cash-register", "", FALSE);
$sideMenu->addMenuItem(86, "mci_Risers", $MenuLanguage->MenuPhrase("86", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa-screwdriver", "", FALSE);
$sideMenu->addMenuItem(15, "mi_BackflowTypes", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "BackflowTypeslist.php", 86, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}BackflowTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(16, "mi_BellTypes", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "BellTypeslist.php", 86, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}BellTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(20, "mi_CheckValves", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "CheckValveslist.php", 86, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}CheckValves'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(21, "mi_ControlValves", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "ControlValveslist.php", 86, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}ControlValves'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(25, "mi_FDCTypes", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "FDCTypeslist.php", 86, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}FDCTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(54, "mi_RiserTypes", $MenuLanguage->MenuPhrase("54", "MenuText"), $MenuRelativePath . "RiserTypeslist.php", 86, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}RiserTypes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(67, "mi_TrimPackages", $MenuLanguage->MenuPhrase("67", "MenuText"), $MenuRelativePath . "TrimPackageslist.php", 86, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}TrimPackages'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(52, "mi_ScheduleTypes", $MenuLanguage->MenuPhrase("52", "MenuText"), $MenuRelativePath . "ScheduleTypeslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}ScheduleTypes'), FALSE, FALSE, "fa-calendar", "", FALSE);
$sideMenu->addMenuItem(78, "mci_Shop_Fabrications", $MenuLanguage->MenuPhrase("78", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa-warehouse", "", FALSE);
$sideMenu->addMenuItem(64, "mi_ShopFabrications", $MenuLanguage->MenuPhrase("64", "MenuText"), $MenuRelativePath . "ShopFabricationslist.php", 78, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}ShopFabrications'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(63, "mi_ShopFabricationMultipliers", $MenuLanguage->MenuPhrase("63", "MenuText"), $MenuRelativePath . "ShopFabricationMultiplierslist.php", 78, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}ShopFabricationMultipliers'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(65, "mi_SystemTypes", $MenuLanguage->MenuPhrase("65", "MenuText"), $MenuRelativePath . "SystemTypeslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}SystemTypes'), FALSE, FALSE, "fa-atlas", "", FALSE);
$sideMenu->addMenuItem(87, "mci_Underground", $MenuLanguage->MenuPhrase("87", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa-circle-notch", "", FALSE);
$sideMenu->addMenuItem(55, "mi_TappingTees", $MenuLanguage->MenuPhrase("55", "MenuText"), $MenuRelativePath . "TappingTeeslist.php", 87, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}TappingTees'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(56, "mi_UndergroundValves", $MenuLanguage->MenuPhrase("56", "MenuText"), $MenuRelativePath . "UndergroundValveslist.php", 87, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}UndergroundValves'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(68, "mi_VolumeCorrections", $MenuLanguage->MenuPhrase("68", "MenuText"), $MenuRelativePath . "VolumeCorrectionslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}VolumeCorrections'), FALSE, FALSE, "fa-cookie", "", FALSE);
$sideMenu->addMenuItem(2, "mi_Users", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "Userslist.php", -1, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}Users'), FALSE, FALSE, "fa-users", "", FALSE);
$sideMenu->addMenuItem(13, "mci_Worksheets", $MenuLanguage->MenuPhrase("13", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa-cogs", "", FALSE);
$sideMenu->addMenuItem(8, "mi_WorksheetCategories", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "WorksheetCategorieslist.php", 13, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}WorksheetCategories'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_WorksheetMasters", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "WorksheetMasterslist.php", 13, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}WorksheetMasters'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_WorksheetTemplates", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "WorksheetTemplateslist.php", 13, "", IsLoggedIn() || AllowListMenu('{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}WorksheetTemplates'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>