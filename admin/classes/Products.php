<?php namespace PHPMaker2020\feapps51; ?>
<?php

/**
 * Table class for Products
 */
class Products extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $Product_Idn;
	public $Department_Idn;
	public $WorksheetMaster_Idn;
	public $WorksheetCategory_Idn;
	public $Manufacturer_Idn;
	public $Rank;
	public $Name;
	public $MaterialUnitPrice;
	public $FieldUnitPrice;
	public $ShopUnitPrice;
	public $EngineerUnitPrice;
	public $DefaultQuantity;
	public $ProductSize_Idn;
	public $Description;
	public $PipeType_Idn;
	public $ScheduleType_Idn;
	public $Fitting_Idn;
	public $GroovedFittingType_Idn;
	public $ThreadedFittingType_Idn;
	public $HangerType_Idn;
	public $HangerSubType_Idn;
	public $SubcontractCategory_Idn;
	public $ApplyToAdjustmentFactorsFlag;
	public $ApplyToContingencyFlag;
	public $IsMainComponent;
	public $DomesticFlag;
	public $LoadFlag;
	public $AutoLoadFlag;
	public $ActiveFlag;
	public $GradeType_Idn;
	public $PressureType_Idn;
	public $SeamlessFlag;
	public $ResponseType;
	public $FMJobFlag;
	public $RecommendedBoxes;
	public $RecommendedWireFootage;
	public $CoverageType_Idn;
	public $HeadType_Idn;
	public $FinishType_Idn;
	public $Outlet_Idn;
	public $RiserType_Idn;
	public $BackFlowType_Idn;
	public $ControlValve_Idn;
	public $CheckValve_Idn;
	public $FDCType_Idn;
	public $BellType_Idn;
	public $TappingTee_Idn;
	public $UndergroundValve_Idn;
	public $LiftDuration_Idn;
	public $TrimPackageFlag;
	public $ListedFlag;
	public $BoxWireLength;
	public $IsFirePump;
	public $FirePumpType_Idn;
	public $FirePumpAttribute_Idn;
	public $IsDieselFuel;
	public $IsSolution;
	public $Position_Idn;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Products';
		$this->TableName = 'Products';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[Products]";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 10;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// Product_Idn
		$this->Product_Idn = new DbField('Products', 'Products', 'x_Product_Idn', 'Product_Idn', '[Product_Idn]', 'CAST([Product_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[Product_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->Product_Idn->IsAutoIncrement = TRUE; // Autoincrement field
		$this->Product_Idn->IsPrimaryKey = TRUE; // Primary key field
		$this->Product_Idn->IsForeignKey = TRUE; // Foreign key field
		$this->Product_Idn->Nullable = FALSE; // NOT NULL field
		$this->Product_Idn->Sortable = TRUE; // Allow sort
		$this->Product_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Product_Idn'] = &$this->Product_Idn;

		// Department_Idn
		$this->Department_Idn = new DbField('Products', 'Products', 'x_Department_Idn', 'Department_Idn', '[Department_Idn]', 'CAST([Department_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[Department_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Department_Idn->Required = TRUE; // Required field
		$this->Department_Idn->Sortable = TRUE; // Allow sort
		$this->Department_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Department_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Department_Idn->Lookup = new Lookup('Department_Idn', 'jpr_Department', FALSE, 'DepartmentId', ["Description","","",""], [], ["x_WorksheetMaster_Idn"], [], [], [], [], '[Description] ASC', '');
		$this->Department_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Department_Idn'] = &$this->Department_Idn;

		// WorksheetMaster_Idn
		$this->WorksheetMaster_Idn = new DbField('Products', 'Products', 'x_WorksheetMaster_Idn', 'WorksheetMaster_Idn', '[WorksheetMaster_Idn]', 'CAST([WorksheetMaster_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[WorksheetMaster_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->WorksheetMaster_Idn->Required = TRUE; // Required field
		$this->WorksheetMaster_Idn->Sortable = TRUE; // Allow sort
		$this->WorksheetMaster_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->WorksheetMaster_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->WorksheetMaster_Idn->Lookup = new Lookup('WorksheetMaster_Idn', 'WorksheetMasters', FALSE, 'WorksheetMaster_Idn', ["Name","","",""], ["x_Department_Idn"], ["x_WorksheetCategory_Idn"], ["Department_Idn"], ["x_Department_Idn"], [], [], '[Name] ASC', '');
		$this->WorksheetMaster_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['WorksheetMaster_Idn'] = &$this->WorksheetMaster_Idn;

		// WorksheetCategory_Idn
		$this->WorksheetCategory_Idn = new DbField('Products', 'Products', 'x_WorksheetCategory_Idn', 'WorksheetCategory_Idn', '[WorksheetCategory_Idn]', 'CAST([WorksheetCategory_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[WorksheetCategory_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->WorksheetCategory_Idn->Required = TRUE; // Required field
		$this->WorksheetCategory_Idn->Sortable = TRUE; // Allow sort
		$this->WorksheetCategory_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->WorksheetCategory_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->WorksheetCategory_Idn->Lookup = new Lookup('WorksheetCategory_Idn', 'v_WorksheetMasterCategories', TRUE, 'WorksheetCategory_Idn', ["Name","","",""], ["x_WorksheetMaster_Idn"], ["x_Fitting_Idn"], ["WorksheetMaster_Idn"], ["x_WorksheetMaster_Idn"], [], [], '[Name] ASC', '');
		$this->WorksheetCategory_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['WorksheetCategory_Idn'] = &$this->WorksheetCategory_Idn;

		// Manufacturer_Idn
		$this->Manufacturer_Idn = new DbField('Products', 'Products', 'x_Manufacturer_Idn', 'Manufacturer_Idn', '[Manufacturer_Idn]', 'CAST([Manufacturer_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[Manufacturer_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Manufacturer_Idn->Sortable = TRUE; // Allow sort
		$this->Manufacturer_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Manufacturer_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Manufacturer_Idn->Lookup = new Lookup('Manufacturer_Idn', 'Manufacturers', FALSE, 'Manufacturer_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->Manufacturer_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Manufacturer_Idn'] = &$this->Manufacturer_Idn;

		// Rank
		$this->Rank = new DbField('Products', 'Products', 'x_Rank', 'Rank', '[Rank]', 'CAST([Rank] AS NVARCHAR)', 3, 4, -1, FALSE, '[Rank]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Rank->Sortable = TRUE; // Allow sort
		$this->Rank->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Rank'] = &$this->Rank;

		// Name
		$this->Name = new DbField('Products', 'Products', 'x_Name', 'Name', '[Name]', '[Name]', 200, 150, -1, FALSE, '[Name]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Name->Sortable = TRUE; // Allow sort
		$this->fields['Name'] = &$this->Name;

		// MaterialUnitPrice
		$this->MaterialUnitPrice = new DbField('Products', 'Products', 'x_MaterialUnitPrice', 'MaterialUnitPrice', '[MaterialUnitPrice]', 'CAST([MaterialUnitPrice] AS NVARCHAR)', 131, 8, -1, FALSE, '[MaterialUnitPrice]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MaterialUnitPrice->Sortable = TRUE; // Allow sort
		$this->MaterialUnitPrice->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['MaterialUnitPrice'] = &$this->MaterialUnitPrice;

		// FieldUnitPrice
		$this->FieldUnitPrice = new DbField('Products', 'Products', 'x_FieldUnitPrice', 'FieldUnitPrice', '[FieldUnitPrice]', 'CAST([FieldUnitPrice] AS NVARCHAR)', 131, 8, -1, FALSE, '[FieldUnitPrice]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FieldUnitPrice->Sortable = TRUE; // Allow sort
		$this->FieldUnitPrice->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['FieldUnitPrice'] = &$this->FieldUnitPrice;

		// ShopUnitPrice
		$this->ShopUnitPrice = new DbField('Products', 'Products', 'x_ShopUnitPrice', 'ShopUnitPrice', '[ShopUnitPrice]', 'CAST([ShopUnitPrice] AS NVARCHAR)', 131, 8, -1, FALSE, '[ShopUnitPrice]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ShopUnitPrice->Sortable = TRUE; // Allow sort
		$this->ShopUnitPrice->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ShopUnitPrice'] = &$this->ShopUnitPrice;

		// EngineerUnitPrice
		$this->EngineerUnitPrice = new DbField('Products', 'Products', 'x_EngineerUnitPrice', 'EngineerUnitPrice', '[EngineerUnitPrice]', 'CAST([EngineerUnitPrice] AS NVARCHAR)', 131, 8, -1, FALSE, '[EngineerUnitPrice]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EngineerUnitPrice->Sortable = TRUE; // Allow sort
		$this->EngineerUnitPrice->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['EngineerUnitPrice'] = &$this->EngineerUnitPrice;

		// DefaultQuantity
		$this->DefaultQuantity = new DbField('Products', 'Products', 'x_DefaultQuantity', 'DefaultQuantity', '[DefaultQuantity]', 'CAST([DefaultQuantity] AS NVARCHAR)', 131, 8, -1, FALSE, '[DefaultQuantity]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DefaultQuantity->Sortable = TRUE; // Allow sort
		$this->DefaultQuantity->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['DefaultQuantity'] = &$this->DefaultQuantity;

		// ProductSize_Idn
		$this->ProductSize_Idn = new DbField('Products', 'Products', 'x_ProductSize_Idn', 'ProductSize_Idn', '[ProductSize_Idn]', 'CAST([ProductSize_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[ProductSize_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ProductSize_Idn->Sortable = TRUE; // Allow sort
		$this->ProductSize_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ProductSize_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ProductSize_Idn->Lookup = new Lookup('ProductSize_Idn', 'ProductSizes', FALSE, 'ProductSize_Idn', ["Name","","",""], [], [], [], [], [], [], '[Value] ASC', '');
		$this->ProductSize_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ProductSize_Idn'] = &$this->ProductSize_Idn;

		// Description
		$this->Description = new DbField('Products', 'Products', 'x_Description', 'Description', '[Description]', '[Description]', 201, 0, -1, FALSE, '[Description]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Description->Sortable = TRUE; // Allow sort
		$this->fields['Description'] = &$this->Description;

		// PipeType_Idn
		$this->PipeType_Idn = new DbField('Products', 'Products', 'x_PipeType_Idn', 'PipeType_Idn', '[PipeType_Idn]', 'CAST([PipeType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[PipeType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PipeType_Idn->Sortable = TRUE; // Allow sort
		$this->PipeType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PipeType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PipeType_Idn->Lookup = new Lookup('PipeType_Idn', 'PipeTypes', FALSE, 'PipeType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->PipeType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PipeType_Idn'] = &$this->PipeType_Idn;

		// ScheduleType_Idn
		$this->ScheduleType_Idn = new DbField('Products', 'Products', 'x_ScheduleType_Idn', 'ScheduleType_Idn', '[ScheduleType_Idn]', 'CAST([ScheduleType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[ScheduleType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ScheduleType_Idn->Sortable = TRUE; // Allow sort
		$this->ScheduleType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ScheduleType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ScheduleType_Idn->Lookup = new Lookup('ScheduleType_Idn', 'ScheduleTypes', FALSE, 'ScheduleType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->ScheduleType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ScheduleType_Idn'] = &$this->ScheduleType_Idn;

		// Fitting_Idn
		$this->Fitting_Idn = new DbField('Products', 'Products', 'x_Fitting_Idn', 'Fitting_Idn', '[Fitting_Idn]', 'CAST([Fitting_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[Fitting_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Fitting_Idn->Sortable = TRUE; // Allow sort
		$this->Fitting_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Fitting_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Fitting_Idn->Lookup = new Lookup('Fitting_Idn', 'Fittings', FALSE, 'Fitting_Idn', ["Name","","",""], ["x_WorksheetCategory_Idn"], [], ["WorksheetCategory_Idn"], ["x_WorksheetCategory_Idn"], [], [], '[Name] ASC', '');
		$this->Fitting_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Fitting_Idn'] = &$this->Fitting_Idn;

		// GroovedFittingType_Idn
		$this->GroovedFittingType_Idn = new DbField('Products', 'Products', 'x_GroovedFittingType_Idn', 'GroovedFittingType_Idn', '[GroovedFittingType_Idn]', 'CAST([GroovedFittingType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[GroovedFittingType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->GroovedFittingType_Idn->Sortable = TRUE; // Allow sort
		$this->GroovedFittingType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->GroovedFittingType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->GroovedFittingType_Idn->Lookup = new Lookup('GroovedFittingType_Idn', 'GroovedFittingTypes', FALSE, 'GroovedFittingType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->GroovedFittingType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['GroovedFittingType_Idn'] = &$this->GroovedFittingType_Idn;

		// ThreadedFittingType_Idn
		$this->ThreadedFittingType_Idn = new DbField('Products', 'Products', 'x_ThreadedFittingType_Idn', 'ThreadedFittingType_Idn', '[ThreadedFittingType_Idn]', 'CAST([ThreadedFittingType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[ThreadedFittingType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ThreadedFittingType_Idn->Sortable = TRUE; // Allow sort
		$this->ThreadedFittingType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ThreadedFittingType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ThreadedFittingType_Idn->Lookup = new Lookup('ThreadedFittingType_Idn', 'ThreadedFittingTypes', FALSE, 'ThreadedFittingType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->ThreadedFittingType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ThreadedFittingType_Idn'] = &$this->ThreadedFittingType_Idn;

		// HangerType_Idn
		$this->HangerType_Idn = new DbField('Products', 'Products', 'x_HangerType_Idn', 'HangerType_Idn', '[HangerType_Idn]', 'CAST([HangerType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[HangerType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->HangerType_Idn->Sortable = TRUE; // Allow sort
		$this->HangerType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->HangerType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->HangerType_Idn->Lookup = new Lookup('HangerType_Idn', 'HangerTypes', FALSE, 'HangerType_Idn', ["Name","","",""], [], ["x_HangerSubType_Idn"], [], [], [], [], '[Name] ASC', '');
		$this->HangerType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['HangerType_Idn'] = &$this->HangerType_Idn;

		// HangerSubType_Idn
		$this->HangerSubType_Idn = new DbField('Products', 'Products', 'x_HangerSubType_Idn', 'HangerSubType_Idn', '[HangerSubType_Idn]', 'CAST([HangerSubType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[HangerSubType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->HangerSubType_Idn->Sortable = TRUE; // Allow sort
		$this->HangerSubType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->HangerSubType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->HangerSubType_Idn->Lookup = new Lookup('HangerSubType_Idn', 'HangerSubTypes', FALSE, 'HangerSubType_Idn', ["Name","","",""], ["x_HangerType_Idn"], [], ["HangerType_Idn"], ["x_HangerType_Idn"], [], [], '[Name] ASC', '');
		$this->HangerSubType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['HangerSubType_Idn'] = &$this->HangerSubType_Idn;

		// SubcontractCategory_Idn
		$this->SubcontractCategory_Idn = new DbField('Products', 'Products', 'x_SubcontractCategory_Idn', 'SubcontractCategory_Idn', '[SubcontractCategory_Idn]', 'CAST([SubcontractCategory_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[SubcontractCategory_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->SubcontractCategory_Idn->Sortable = TRUE; // Allow sort
		$this->SubcontractCategory_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->SubcontractCategory_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->SubcontractCategory_Idn->Lookup = new Lookup('SubcontractCategory_Idn', 'WorksheetColumns', FALSE, 'WorksheetColumn_Idn', ["Name","","",""], [], [], [], [], [], [], '[Rank] ASC', '');
		$this->SubcontractCategory_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SubcontractCategory_Idn'] = &$this->SubcontractCategory_Idn;

		// ApplyToAdjustmentFactorsFlag
		$this->ApplyToAdjustmentFactorsFlag = new DbField('Products', 'Products', 'x_ApplyToAdjustmentFactorsFlag', 'ApplyToAdjustmentFactorsFlag', '[ApplyToAdjustmentFactorsFlag]', '[ApplyToAdjustmentFactorsFlag]', 11, 2, -1, FALSE, '[ApplyToAdjustmentFactorsFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ApplyToAdjustmentFactorsFlag->Sortable = TRUE; // Allow sort
		$this->ApplyToAdjustmentFactorsFlag->DataType = DATATYPE_BOOLEAN;
		$this->ApplyToAdjustmentFactorsFlag->Lookup = new Lookup('ApplyToAdjustmentFactorsFlag', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ApplyToAdjustmentFactorsFlag->OptionCount = 2;
		$this->fields['ApplyToAdjustmentFactorsFlag'] = &$this->ApplyToAdjustmentFactorsFlag;

		// ApplyToContingencyFlag
		$this->ApplyToContingencyFlag = new DbField('Products', 'Products', 'x_ApplyToContingencyFlag', 'ApplyToContingencyFlag', '[ApplyToContingencyFlag]', '[ApplyToContingencyFlag]', 11, 2, -1, FALSE, '[ApplyToContingencyFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ApplyToContingencyFlag->Sortable = TRUE; // Allow sort
		$this->ApplyToContingencyFlag->DataType = DATATYPE_BOOLEAN;
		$this->ApplyToContingencyFlag->Lookup = new Lookup('ApplyToContingencyFlag', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ApplyToContingencyFlag->OptionCount = 2;
		$this->fields['ApplyToContingencyFlag'] = &$this->ApplyToContingencyFlag;

		// IsMainComponent
		$this->IsMainComponent = new DbField('Products', 'Products', 'x_IsMainComponent', 'IsMainComponent', '[IsMainComponent]', '[IsMainComponent]', 11, 2, -1, FALSE, '[IsMainComponent]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->IsMainComponent->Sortable = TRUE; // Allow sort
		$this->IsMainComponent->DataType = DATATYPE_BOOLEAN;
		$this->IsMainComponent->Lookup = new Lookup('IsMainComponent', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->IsMainComponent->OptionCount = 2;
		$this->fields['IsMainComponent'] = &$this->IsMainComponent;

		// DomesticFlag
		$this->DomesticFlag = new DbField('Products', 'Products', 'x_DomesticFlag', 'DomesticFlag', '[DomesticFlag]', '[DomesticFlag]', 11, 2, -1, FALSE, '[DomesticFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DomesticFlag->Sortable = TRUE; // Allow sort
		$this->DomesticFlag->DataType = DATATYPE_BOOLEAN;
		$this->DomesticFlag->Lookup = new Lookup('DomesticFlag', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DomesticFlag->OptionCount = 2;
		$this->fields['DomesticFlag'] = &$this->DomesticFlag;

		// LoadFlag
		$this->LoadFlag = new DbField('Products', 'Products', 'x_LoadFlag', 'LoadFlag', '[LoadFlag]', '[LoadFlag]', 11, 2, -1, FALSE, '[LoadFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->LoadFlag->Sortable = TRUE; // Allow sort
		$this->LoadFlag->DataType = DATATYPE_BOOLEAN;
		$this->LoadFlag->Lookup = new Lookup('LoadFlag', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->LoadFlag->OptionCount = 2;
		$this->fields['LoadFlag'] = &$this->LoadFlag;

		// AutoLoadFlag
		$this->AutoLoadFlag = new DbField('Products', 'Products', 'x_AutoLoadFlag', 'AutoLoadFlag', '[AutoLoadFlag]', '[AutoLoadFlag]', 11, 2, -1, FALSE, '[AutoLoadFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->AutoLoadFlag->Sortable = TRUE; // Allow sort
		$this->AutoLoadFlag->DataType = DATATYPE_BOOLEAN;
		$this->AutoLoadFlag->Lookup = new Lookup('AutoLoadFlag', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->AutoLoadFlag->OptionCount = 2;
		$this->fields['AutoLoadFlag'] = &$this->AutoLoadFlag;

		// ActiveFlag
		$this->ActiveFlag = new DbField('Products', 'Products', 'x_ActiveFlag', 'ActiveFlag', '[ActiveFlag]', '[ActiveFlag]', 11, 2, -1, FALSE, '[ActiveFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ActiveFlag->Sortable = TRUE; // Allow sort
		$this->ActiveFlag->DataType = DATATYPE_BOOLEAN;
		$this->ActiveFlag->Lookup = new Lookup('ActiveFlag', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ActiveFlag->OptionCount = 2;
		$this->fields['ActiveFlag'] = &$this->ActiveFlag;

		// GradeType_Idn
		$this->GradeType_Idn = new DbField('Products', 'Products', 'x_GradeType_Idn', 'GradeType_Idn', '[GradeType_Idn]', 'CAST([GradeType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[GradeType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->GradeType_Idn->Sortable = TRUE; // Allow sort
		$this->GradeType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->GradeType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->GradeType_Idn->Lookup = new Lookup('GradeType_Idn', 'GradeTypes', FALSE, 'GradeType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->GradeType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['GradeType_Idn'] = &$this->GradeType_Idn;

		// PressureType_Idn
		$this->PressureType_Idn = new DbField('Products', 'Products', 'x_PressureType_Idn', 'PressureType_Idn', '[PressureType_Idn]', 'CAST([PressureType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[PressureType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PressureType_Idn->Sortable = TRUE; // Allow sort
		$this->PressureType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PressureType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PressureType_Idn->Lookup = new Lookup('PressureType_Idn', 'PressureTypes', FALSE, 'PressureType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->PressureType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PressureType_Idn'] = &$this->PressureType_Idn;

		// SeamlessFlag
		$this->SeamlessFlag = new DbField('Products', 'Products', 'x_SeamlessFlag', 'SeamlessFlag', '[SeamlessFlag]', '[SeamlessFlag]', 11, 2, -1, FALSE, '[SeamlessFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->SeamlessFlag->Sortable = TRUE; // Allow sort
		$this->SeamlessFlag->DataType = DATATYPE_BOOLEAN;
		$this->SeamlessFlag->Lookup = new Lookup('SeamlessFlag', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->SeamlessFlag->OptionCount = 2;
		$this->fields['SeamlessFlag'] = &$this->SeamlessFlag;

		// ResponseType
		$this->ResponseType = new DbField('Products', 'Products', 'x_ResponseType', 'ResponseType', '[ResponseType]', '[ResponseType]', 200, 1, -1, FALSE, '[ResponseType]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->ResponseType->Sortable = TRUE; // Allow sort
		$this->ResponseType->Lookup = new Lookup('ResponseType', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ResponseType->OptionCount = 2;
		$this->fields['ResponseType'] = &$this->ResponseType;

		// FMJobFlag
		$this->FMJobFlag = new DbField('Products', 'Products', 'x_FMJobFlag', 'FMJobFlag', '[FMJobFlag]', '[FMJobFlag]', 11, 2, -1, FALSE, '[FMJobFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->FMJobFlag->Sortable = TRUE; // Allow sort
		$this->FMJobFlag->DataType = DATATYPE_BOOLEAN;
		$this->FMJobFlag->Lookup = new Lookup('FMJobFlag', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->FMJobFlag->OptionCount = 2;
		$this->fields['FMJobFlag'] = &$this->FMJobFlag;

		// RecommendedBoxes
		$this->RecommendedBoxes = new DbField('Products', 'Products', 'x_RecommendedBoxes', 'RecommendedBoxes', '[RecommendedBoxes]', 'CAST([RecommendedBoxes] AS NVARCHAR)', 3, 4, -1, FALSE, '[RecommendedBoxes]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RecommendedBoxes->Sortable = TRUE; // Allow sort
		$this->RecommendedBoxes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['RecommendedBoxes'] = &$this->RecommendedBoxes;

		// RecommendedWireFootage
		$this->RecommendedWireFootage = new DbField('Products', 'Products', 'x_RecommendedWireFootage', 'RecommendedWireFootage', '[RecommendedWireFootage]', 'CAST([RecommendedWireFootage] AS NVARCHAR)', 3, 4, -1, FALSE, '[RecommendedWireFootage]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RecommendedWireFootage->Sortable = TRUE; // Allow sort
		$this->RecommendedWireFootage->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['RecommendedWireFootage'] = &$this->RecommendedWireFootage;

		// CoverageType_Idn
		$this->CoverageType_Idn = new DbField('Products', 'Products', 'x_CoverageType_Idn', 'CoverageType_Idn', '[CoverageType_Idn]', 'CAST([CoverageType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[CoverageType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CoverageType_Idn->Sortable = TRUE; // Allow sort
		$this->CoverageType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CoverageType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->CoverageType_Idn->Lookup = new Lookup('CoverageType_Idn', 'CoverageTypes', FALSE, 'CoverageType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->CoverageType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CoverageType_Idn'] = &$this->CoverageType_Idn;

		// HeadType_Idn
		$this->HeadType_Idn = new DbField('Products', 'Products', 'x_HeadType_Idn', 'HeadType_Idn', '[HeadType_Idn]', 'CAST([HeadType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[HeadType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->HeadType_Idn->Sortable = TRUE; // Allow sort
		$this->HeadType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->HeadType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->HeadType_Idn->Lookup = new Lookup('HeadType_Idn', 'HeadTypes', FALSE, 'HeadType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->HeadType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['HeadType_Idn'] = &$this->HeadType_Idn;

		// FinishType_Idn
		$this->FinishType_Idn = new DbField('Products', 'Products', 'x_FinishType_Idn', 'FinishType_Idn', '[FinishType_Idn]', 'CAST([FinishType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[FinishType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->FinishType_Idn->Sortable = TRUE; // Allow sort
		$this->FinishType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->FinishType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->FinishType_Idn->Lookup = new Lookup('FinishType_Idn', 'FinishTypes', FALSE, 'FinishType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->FinishType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FinishType_Idn'] = &$this->FinishType_Idn;

		// Outlet_Idn
		$this->Outlet_Idn = new DbField('Products', 'Products', 'x_Outlet_Idn', 'Outlet_Idn', '[Outlet_Idn]', 'CAST([Outlet_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[Outlet_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Outlet_Idn->Sortable = TRUE; // Allow sort
		$this->Outlet_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Outlet_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Outlet_Idn->Lookup = new Lookup('Outlet_Idn', 'Outlets', FALSE, 'Outlet_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->Outlet_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Outlet_Idn'] = &$this->Outlet_Idn;

		// RiserType_Idn
		$this->RiserType_Idn = new DbField('Products', 'Products', 'x_RiserType_Idn', 'RiserType_Idn', '[RiserType_Idn]', 'CAST([RiserType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[RiserType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->RiserType_Idn->Sortable = TRUE; // Allow sort
		$this->RiserType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->RiserType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->RiserType_Idn->Lookup = new Lookup('RiserType_Idn', 'RiserTypes', FALSE, 'RiserType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->RiserType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['RiserType_Idn'] = &$this->RiserType_Idn;

		// BackFlowType_Idn
		$this->BackFlowType_Idn = new DbField('Products', 'Products', 'x_BackFlowType_Idn', 'BackFlowType_Idn', '[BackFlowType_Idn]', 'CAST([BackFlowType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[BackFlowType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->BackFlowType_Idn->Sortable = TRUE; // Allow sort
		$this->BackFlowType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->BackFlowType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->BackFlowType_Idn->Lookup = new Lookup('BackFlowType_Idn', 'BackflowTypes', FALSE, 'BackflowType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->BackFlowType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BackFlowType_Idn'] = &$this->BackFlowType_Idn;

		// ControlValve_Idn
		$this->ControlValve_Idn = new DbField('Products', 'Products', 'x_ControlValve_Idn', 'ControlValve_Idn', '[ControlValve_Idn]', 'CAST([ControlValve_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[ControlValve_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ControlValve_Idn->Sortable = TRUE; // Allow sort
		$this->ControlValve_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ControlValve_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ControlValve_Idn->Lookup = new Lookup('ControlValve_Idn', 'ControlValves', FALSE, 'ControlValve_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->ControlValve_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ControlValve_Idn'] = &$this->ControlValve_Idn;

		// CheckValve_Idn
		$this->CheckValve_Idn = new DbField('Products', 'Products', 'x_CheckValve_Idn', 'CheckValve_Idn', '[CheckValve_Idn]', 'CAST([CheckValve_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[CheckValve_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CheckValve_Idn->Sortable = TRUE; // Allow sort
		$this->CheckValve_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CheckValve_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->CheckValve_Idn->Lookup = new Lookup('CheckValve_Idn', 'CheckValves', FALSE, 'CheckValve_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->CheckValve_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CheckValve_Idn'] = &$this->CheckValve_Idn;

		// FDCType_Idn
		$this->FDCType_Idn = new DbField('Products', 'Products', 'x_FDCType_Idn', 'FDCType_Idn', '[FDCType_Idn]', 'CAST([FDCType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[FDCType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->FDCType_Idn->Sortable = TRUE; // Allow sort
		$this->FDCType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->FDCType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->FDCType_Idn->Lookup = new Lookup('FDCType_Idn', 'FDCTypes', FALSE, 'FdcType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->FDCType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FDCType_Idn'] = &$this->FDCType_Idn;

		// BellType_Idn
		$this->BellType_Idn = new DbField('Products', 'Products', 'x_BellType_Idn', 'BellType_Idn', '[BellType_Idn]', 'CAST([BellType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[BellType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->BellType_Idn->Sortable = TRUE; // Allow sort
		$this->BellType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->BellType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->BellType_Idn->Lookup = new Lookup('BellType_Idn', 'BellTypes', FALSE, 'BellType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->BellType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BellType_Idn'] = &$this->BellType_Idn;

		// TappingTee_Idn
		$this->TappingTee_Idn = new DbField('Products', 'Products', 'x_TappingTee_Idn', 'TappingTee_Idn', '[TappingTee_Idn]', 'CAST([TappingTee_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[TappingTee_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->TappingTee_Idn->Sortable = TRUE; // Allow sort
		$this->TappingTee_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->TappingTee_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->TappingTee_Idn->Lookup = new Lookup('TappingTee_Idn', 'TappingTees', FALSE, 'TappingTee_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->TappingTee_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TappingTee_Idn'] = &$this->TappingTee_Idn;

		// UndergroundValve_Idn
		$this->UndergroundValve_Idn = new DbField('Products', 'Products', 'x_UndergroundValve_Idn', 'UndergroundValve_Idn', '[UndergroundValve_Idn]', 'CAST([UndergroundValve_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[UndergroundValve_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->UndergroundValve_Idn->Sortable = TRUE; // Allow sort
		$this->UndergroundValve_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->UndergroundValve_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->UndergroundValve_Idn->Lookup = new Lookup('UndergroundValve_Idn', 'UndergroundValves', FALSE, 'UndergroundValve_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->UndergroundValve_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['UndergroundValve_Idn'] = &$this->UndergroundValve_Idn;

		// LiftDuration_Idn
		$this->LiftDuration_Idn = new DbField('Products', 'Products', 'x_LiftDuration_Idn', 'LiftDuration_Idn', '[LiftDuration_Idn]', 'CAST([LiftDuration_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[LiftDuration_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LiftDuration_Idn->Sortable = TRUE; // Allow sort
		$this->LiftDuration_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LiftDuration_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LiftDuration_Idn->Lookup = new Lookup('LiftDuration_Idn', 'LiftDurations', FALSE, 'LiftDuration_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->LiftDuration_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['LiftDuration_Idn'] = &$this->LiftDuration_Idn;

		// TrimPackageFlag
		$this->TrimPackageFlag = new DbField('Products', 'Products', 'x_TrimPackageFlag', 'TrimPackageFlag', '[TrimPackageFlag]', '[TrimPackageFlag]', 11, 2, -1, FALSE, '[TrimPackageFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->TrimPackageFlag->Sortable = TRUE; // Allow sort
		$this->TrimPackageFlag->DataType = DATATYPE_BOOLEAN;
		$this->TrimPackageFlag->Lookup = new Lookup('TrimPackageFlag', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->TrimPackageFlag->OptionCount = 2;
		$this->fields['TrimPackageFlag'] = &$this->TrimPackageFlag;

		// ListedFlag
		$this->ListedFlag = new DbField('Products', 'Products', 'x_ListedFlag', 'ListedFlag', '[ListedFlag]', '[ListedFlag]', 11, 2, -1, FALSE, '[ListedFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ListedFlag->Sortable = TRUE; // Allow sort
		$this->ListedFlag->DataType = DATATYPE_BOOLEAN;
		$this->ListedFlag->Lookup = new Lookup('ListedFlag', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ListedFlag->OptionCount = 2;
		$this->fields['ListedFlag'] = &$this->ListedFlag;

		// BoxWireLength
		$this->BoxWireLength = new DbField('Products', 'Products', 'x_BoxWireLength', 'BoxWireLength', '[BoxWireLength]', 'CAST([BoxWireLength] AS NVARCHAR)', 3, 4, -1, FALSE, '[BoxWireLength]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BoxWireLength->Sortable = TRUE; // Allow sort
		$this->BoxWireLength->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['BoxWireLength'] = &$this->BoxWireLength;

		// IsFirePump
		$this->IsFirePump = new DbField('Products', 'Products', 'x_IsFirePump', 'IsFirePump', '[IsFirePump]', '[IsFirePump]', 11, 2, -1, FALSE, '[IsFirePump]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->IsFirePump->Sortable = TRUE; // Allow sort
		$this->IsFirePump->DataType = DATATYPE_BOOLEAN;
		$this->IsFirePump->Lookup = new Lookup('IsFirePump', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->IsFirePump->OptionCount = 2;
		$this->fields['IsFirePump'] = &$this->IsFirePump;

		// FirePumpType_Idn
		$this->FirePumpType_Idn = new DbField('Products', 'Products', 'x_FirePumpType_Idn', 'FirePumpType_Idn', '[FirePumpType_Idn]', 'CAST([FirePumpType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[FirePumpType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->FirePumpType_Idn->Sortable = TRUE; // Allow sort
		$this->FirePumpType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->FirePumpType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->FirePumpType_Idn->Lookup = new Lookup('FirePumpType_Idn', 'FirePumpAttributes', FALSE, 'FirePumpAttribute_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->FirePumpType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FirePumpType_Idn'] = &$this->FirePumpType_Idn;

		// FirePumpAttribute_Idn
		$this->FirePumpAttribute_Idn = new DbField('Products', 'Products', 'x_FirePumpAttribute_Idn', 'FirePumpAttribute_Idn', '[FirePumpAttribute_Idn]', 'CAST([FirePumpAttribute_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[FirePumpAttribute_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirePumpAttribute_Idn->Sortable = TRUE; // Allow sort
		$this->FirePumpAttribute_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['FirePumpAttribute_Idn'] = &$this->FirePumpAttribute_Idn;

		// IsDieselFuel
		$this->IsDieselFuel = new DbField('Products', 'Products', 'x_IsDieselFuel', 'IsDieselFuel', '[IsDieselFuel]', '[IsDieselFuel]', 11, 2, -1, FALSE, '[IsDieselFuel]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->IsDieselFuel->Sortable = TRUE; // Allow sort
		$this->IsDieselFuel->DataType = DATATYPE_BOOLEAN;
		$this->IsDieselFuel->Lookup = new Lookup('IsDieselFuel', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->IsDieselFuel->OptionCount = 2;
		$this->fields['IsDieselFuel'] = &$this->IsDieselFuel;

		// IsSolution
		$this->IsSolution = new DbField('Products', 'Products', 'x_IsSolution', 'IsSolution', '[IsSolution]', '[IsSolution]', 11, 2, -1, FALSE, '[IsSolution]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->IsSolution->Sortable = TRUE; // Allow sort
		$this->IsSolution->DataType = DATATYPE_BOOLEAN;
		$this->IsSolution->Lookup = new Lookup('IsSolution', 'Products', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->IsSolution->OptionCount = 2;
		$this->fields['IsSolution'] = &$this->IsSolution;

		// Position_Idn
		$this->Position_Idn = new DbField('Products', 'Products', 'x_Position_Idn', 'Position_Idn', '[Position_Idn]', 'CAST([Position_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[Position_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Position_Idn->Sortable = TRUE; // Allow sort
		$this->Position_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Position_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Position_Idn->Lookup = new Lookup('Position_Idn', 'Positions', FALSE, 'Position_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->Position_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Position_Idn'] = &$this->Position_Idn;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[Products]";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "[Department_Idn] ASC,[WorksheetMaster_Idn] ASC,[WorksheetCategory_Idn] ASC,[ProductSize_Idn] ASC,[Rank] ASC";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = Config("USER_ID_ALLOW");
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->Product_Idn->setDbValue($conn->insert_ID());
			$rs['Product_Idn'] = $this->Product_Idn->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('Product_Idn', $rs))
				AddFilter($where, QuotedName('Product_Idn', $this->Dbid) . '=' . QuotedValue($rs['Product_Idn'], $this->Product_Idn->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->Product_Idn->DbValue = $row['Product_Idn'];
		$this->Department_Idn->DbValue = $row['Department_Idn'];
		$this->WorksheetMaster_Idn->DbValue = $row['WorksheetMaster_Idn'];
		$this->WorksheetCategory_Idn->DbValue = $row['WorksheetCategory_Idn'];
		$this->Manufacturer_Idn->DbValue = $row['Manufacturer_Idn'];
		$this->Rank->DbValue = $row['Rank'];
		$this->Name->DbValue = $row['Name'];
		$this->MaterialUnitPrice->DbValue = $row['MaterialUnitPrice'];
		$this->FieldUnitPrice->DbValue = $row['FieldUnitPrice'];
		$this->ShopUnitPrice->DbValue = $row['ShopUnitPrice'];
		$this->EngineerUnitPrice->DbValue = $row['EngineerUnitPrice'];
		$this->DefaultQuantity->DbValue = $row['DefaultQuantity'];
		$this->ProductSize_Idn->DbValue = $row['ProductSize_Idn'];
		$this->Description->DbValue = $row['Description'];
		$this->PipeType_Idn->DbValue = $row['PipeType_Idn'];
		$this->ScheduleType_Idn->DbValue = $row['ScheduleType_Idn'];
		$this->Fitting_Idn->DbValue = $row['Fitting_Idn'];
		$this->GroovedFittingType_Idn->DbValue = $row['GroovedFittingType_Idn'];
		$this->ThreadedFittingType_Idn->DbValue = $row['ThreadedFittingType_Idn'];
		$this->HangerType_Idn->DbValue = $row['HangerType_Idn'];
		$this->HangerSubType_Idn->DbValue = $row['HangerSubType_Idn'];
		$this->SubcontractCategory_Idn->DbValue = $row['SubcontractCategory_Idn'];
		$this->ApplyToAdjustmentFactorsFlag->DbValue = (ConvertToBool($row['ApplyToAdjustmentFactorsFlag']) ? "1" : "0");
		$this->ApplyToContingencyFlag->DbValue = (ConvertToBool($row['ApplyToContingencyFlag']) ? "1" : "0");
		$this->IsMainComponent->DbValue = (ConvertToBool($row['IsMainComponent']) ? "1" : "0");
		$this->DomesticFlag->DbValue = (ConvertToBool($row['DomesticFlag']) ? "1" : "0");
		$this->LoadFlag->DbValue = (ConvertToBool($row['LoadFlag']) ? "1" : "0");
		$this->AutoLoadFlag->DbValue = (ConvertToBool($row['AutoLoadFlag']) ? "1" : "0");
		$this->ActiveFlag->DbValue = (ConvertToBool($row['ActiveFlag']) ? "1" : "0");
		$this->GradeType_Idn->DbValue = $row['GradeType_Idn'];
		$this->PressureType_Idn->DbValue = $row['PressureType_Idn'];
		$this->SeamlessFlag->DbValue = (ConvertToBool($row['SeamlessFlag']) ? "1" : "0");
		$this->ResponseType->DbValue = $row['ResponseType'];
		$this->FMJobFlag->DbValue = (ConvertToBool($row['FMJobFlag']) ? "1" : "0");
		$this->RecommendedBoxes->DbValue = $row['RecommendedBoxes'];
		$this->RecommendedWireFootage->DbValue = $row['RecommendedWireFootage'];
		$this->CoverageType_Idn->DbValue = $row['CoverageType_Idn'];
		$this->HeadType_Idn->DbValue = $row['HeadType_Idn'];
		$this->FinishType_Idn->DbValue = $row['FinishType_Idn'];
		$this->Outlet_Idn->DbValue = $row['Outlet_Idn'];
		$this->RiserType_Idn->DbValue = $row['RiserType_Idn'];
		$this->BackFlowType_Idn->DbValue = $row['BackFlowType_Idn'];
		$this->ControlValve_Idn->DbValue = $row['ControlValve_Idn'];
		$this->CheckValve_Idn->DbValue = $row['CheckValve_Idn'];
		$this->FDCType_Idn->DbValue = $row['FDCType_Idn'];
		$this->BellType_Idn->DbValue = $row['BellType_Idn'];
		$this->TappingTee_Idn->DbValue = $row['TappingTee_Idn'];
		$this->UndergroundValve_Idn->DbValue = $row['UndergroundValve_Idn'];
		$this->LiftDuration_Idn->DbValue = $row['LiftDuration_Idn'];
		$this->TrimPackageFlag->DbValue = (ConvertToBool($row['TrimPackageFlag']) ? "1" : "0");
		$this->ListedFlag->DbValue = (ConvertToBool($row['ListedFlag']) ? "1" : "0");
		$this->BoxWireLength->DbValue = $row['BoxWireLength'];
		$this->IsFirePump->DbValue = (ConvertToBool($row['IsFirePump']) ? "1" : "0");
		$this->FirePumpType_Idn->DbValue = $row['FirePumpType_Idn'];
		$this->FirePumpAttribute_Idn->DbValue = $row['FirePumpAttribute_Idn'];
		$this->IsDieselFuel->DbValue = (ConvertToBool($row['IsDieselFuel']) ? "1" : "0");
		$this->IsSolution->DbValue = (ConvertToBool($row['IsSolution']) ? "1" : "0");
		$this->Position_Idn->DbValue = $row['Position_Idn'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "[Product_Idn] = @Product_Idn@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('Product_Idn', $row) ? $row['Product_Idn'] : NULL;
		else
			$val = $this->Product_Idn->OldValue !== NULL ? $this->Product_Idn->OldValue : $this->Product_Idn->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@Product_Idn@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "Productslist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "Productsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "Productsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "Productsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "Productslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("Productsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Productsview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "Productsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "Productsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("Productsedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("Productsadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("Productsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "Product_Idn:" . JsonEncode($this->Product_Idn->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->Product_Idn->CurrentValue != NULL) {
			$url .= "Product_Idn=" . urlencode($this->Product_Idn->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [141, 201, 203, 128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("Product_Idn") !== NULL)
				$arKeys[] = Param("Product_Idn");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->Product_Idn->CurrentValue = $key;
			else
				$this->Product_Idn->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->Product_Idn->setDbValue($rs->fields('Product_Idn'));
		$this->Department_Idn->setDbValue($rs->fields('Department_Idn'));
		$this->WorksheetMaster_Idn->setDbValue($rs->fields('WorksheetMaster_Idn'));
		$this->WorksheetCategory_Idn->setDbValue($rs->fields('WorksheetCategory_Idn'));
		$this->Manufacturer_Idn->setDbValue($rs->fields('Manufacturer_Idn'));
		$this->Rank->setDbValue($rs->fields('Rank'));
		$this->Name->setDbValue($rs->fields('Name'));
		$this->MaterialUnitPrice->setDbValue($rs->fields('MaterialUnitPrice'));
		$this->FieldUnitPrice->setDbValue($rs->fields('FieldUnitPrice'));
		$this->ShopUnitPrice->setDbValue($rs->fields('ShopUnitPrice'));
		$this->EngineerUnitPrice->setDbValue($rs->fields('EngineerUnitPrice'));
		$this->DefaultQuantity->setDbValue($rs->fields('DefaultQuantity'));
		$this->ProductSize_Idn->setDbValue($rs->fields('ProductSize_Idn'));
		$this->Description->setDbValue($rs->fields('Description'));
		$this->PipeType_Idn->setDbValue($rs->fields('PipeType_Idn'));
		$this->ScheduleType_Idn->setDbValue($rs->fields('ScheduleType_Idn'));
		$this->Fitting_Idn->setDbValue($rs->fields('Fitting_Idn'));
		$this->GroovedFittingType_Idn->setDbValue($rs->fields('GroovedFittingType_Idn'));
		$this->ThreadedFittingType_Idn->setDbValue($rs->fields('ThreadedFittingType_Idn'));
		$this->HangerType_Idn->setDbValue($rs->fields('HangerType_Idn'));
		$this->HangerSubType_Idn->setDbValue($rs->fields('HangerSubType_Idn'));
		$this->SubcontractCategory_Idn->setDbValue($rs->fields('SubcontractCategory_Idn'));
		$this->ApplyToAdjustmentFactorsFlag->setDbValue(ConvertToBool($rs->fields('ApplyToAdjustmentFactorsFlag')) ? "1" : "0");
		$this->ApplyToContingencyFlag->setDbValue(ConvertToBool($rs->fields('ApplyToContingencyFlag')) ? "1" : "0");
		$this->IsMainComponent->setDbValue(ConvertToBool($rs->fields('IsMainComponent')) ? "1" : "0");
		$this->DomesticFlag->setDbValue(ConvertToBool($rs->fields('DomesticFlag')) ? "1" : "0");
		$this->LoadFlag->setDbValue(ConvertToBool($rs->fields('LoadFlag')) ? "1" : "0");
		$this->AutoLoadFlag->setDbValue(ConvertToBool($rs->fields('AutoLoadFlag')) ? "1" : "0");
		$this->ActiveFlag->setDbValue(ConvertToBool($rs->fields('ActiveFlag')) ? "1" : "0");
		$this->GradeType_Idn->setDbValue($rs->fields('GradeType_Idn'));
		$this->PressureType_Idn->setDbValue($rs->fields('PressureType_Idn'));
		$this->SeamlessFlag->setDbValue(ConvertToBool($rs->fields('SeamlessFlag')) ? "1" : "0");
		$this->ResponseType->setDbValue($rs->fields('ResponseType'));
		$this->FMJobFlag->setDbValue(ConvertToBool($rs->fields('FMJobFlag')) ? "1" : "0");
		$this->RecommendedBoxes->setDbValue($rs->fields('RecommendedBoxes'));
		$this->RecommendedWireFootage->setDbValue($rs->fields('RecommendedWireFootage'));
		$this->CoverageType_Idn->setDbValue($rs->fields('CoverageType_Idn'));
		$this->HeadType_Idn->setDbValue($rs->fields('HeadType_Idn'));
		$this->FinishType_Idn->setDbValue($rs->fields('FinishType_Idn'));
		$this->Outlet_Idn->setDbValue($rs->fields('Outlet_Idn'));
		$this->RiserType_Idn->setDbValue($rs->fields('RiserType_Idn'));
		$this->BackFlowType_Idn->setDbValue($rs->fields('BackFlowType_Idn'));
		$this->ControlValve_Idn->setDbValue($rs->fields('ControlValve_Idn'));
		$this->CheckValve_Idn->setDbValue($rs->fields('CheckValve_Idn'));
		$this->FDCType_Idn->setDbValue($rs->fields('FDCType_Idn'));
		$this->BellType_Idn->setDbValue($rs->fields('BellType_Idn'));
		$this->TappingTee_Idn->setDbValue($rs->fields('TappingTee_Idn'));
		$this->UndergroundValve_Idn->setDbValue($rs->fields('UndergroundValve_Idn'));
		$this->LiftDuration_Idn->setDbValue($rs->fields('LiftDuration_Idn'));
		$this->TrimPackageFlag->setDbValue(ConvertToBool($rs->fields('TrimPackageFlag')) ? "1" : "0");
		$this->ListedFlag->setDbValue(ConvertToBool($rs->fields('ListedFlag')) ? "1" : "0");
		$this->BoxWireLength->setDbValue($rs->fields('BoxWireLength'));
		$this->IsFirePump->setDbValue(ConvertToBool($rs->fields('IsFirePump')) ? "1" : "0");
		$this->FirePumpType_Idn->setDbValue($rs->fields('FirePumpType_Idn'));
		$this->FirePumpAttribute_Idn->setDbValue($rs->fields('FirePumpAttribute_Idn'));
		$this->IsDieselFuel->setDbValue(ConvertToBool($rs->fields('IsDieselFuel')) ? "1" : "0");
		$this->IsSolution->setDbValue(ConvertToBool($rs->fields('IsSolution')) ? "1" : "0");
		$this->Position_Idn->setDbValue($rs->fields('Position_Idn'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// Product_Idn
		// Department_Idn
		// WorksheetMaster_Idn
		// WorksheetCategory_Idn
		// Manufacturer_Idn
		// Rank
		// Name
		// MaterialUnitPrice
		// FieldUnitPrice
		// ShopUnitPrice
		// EngineerUnitPrice
		// DefaultQuantity
		// ProductSize_Idn
		// Description
		// PipeType_Idn
		// ScheduleType_Idn
		// Fitting_Idn
		// GroovedFittingType_Idn
		// ThreadedFittingType_Idn
		// HangerType_Idn
		// HangerSubType_Idn
		// SubcontractCategory_Idn
		// ApplyToAdjustmentFactorsFlag
		// ApplyToContingencyFlag
		// IsMainComponent
		// DomesticFlag
		// LoadFlag
		// AutoLoadFlag
		// ActiveFlag
		// GradeType_Idn
		// PressureType_Idn
		// SeamlessFlag
		// ResponseType
		// FMJobFlag
		// RecommendedBoxes
		// RecommendedWireFootage
		// CoverageType_Idn
		// HeadType_Idn
		// FinishType_Idn
		// Outlet_Idn
		// RiserType_Idn
		// BackFlowType_Idn
		// ControlValve_Idn
		// CheckValve_Idn
		// FDCType_Idn
		// BellType_Idn
		// TappingTee_Idn
		// UndergroundValve_Idn
		// LiftDuration_Idn
		// TrimPackageFlag
		// ListedFlag
		// BoxWireLength
		// IsFirePump
		// FirePumpType_Idn
		// FirePumpAttribute_Idn
		// IsDieselFuel
		// IsSolution
		// Position_Idn
		// Product_Idn

		$this->Product_Idn->ViewValue = $this->Product_Idn->CurrentValue;
		$this->Product_Idn->ViewCustomAttributes = "";

		// Department_Idn
		$curVal = strval($this->Department_Idn->CurrentValue);
		if ($curVal != "") {
			$this->Department_Idn->ViewValue = $this->Department_Idn->lookupCacheOption($curVal);
			if ($this->Department_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[DepartmentId]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->Department_Idn->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Department_Idn->ViewValue = $this->Department_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Department_Idn->ViewValue = $this->Department_Idn->CurrentValue;
				}
			}
		} else {
			$this->Department_Idn->ViewValue = NULL;
		}
		$this->Department_Idn->ViewCustomAttributes = "";

		// WorksheetMaster_Idn
		$curVal = strval($this->WorksheetMaster_Idn->CurrentValue);
		if ($curVal != "") {
			$this->WorksheetMaster_Idn->ViewValue = $this->WorksheetMaster_Idn->lookupCacheOption($curVal);
			if ($this->WorksheetMaster_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[WorksheetMaster_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->WorksheetMaster_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->WorksheetMaster_Idn->ViewValue = $this->WorksheetMaster_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->WorksheetMaster_Idn->ViewValue = $this->WorksheetMaster_Idn->CurrentValue;
				}
			}
		} else {
			$this->WorksheetMaster_Idn->ViewValue = NULL;
		}
		$this->WorksheetMaster_Idn->ViewCustomAttributes = "";

		// WorksheetCategory_Idn
		$curVal = strval($this->WorksheetCategory_Idn->CurrentValue);
		if ($curVal != "") {
			$this->WorksheetCategory_Idn->ViewValue = $this->WorksheetCategory_Idn->lookupCacheOption($curVal);
			if ($this->WorksheetCategory_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[WorksheetCategory_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->WorksheetCategory_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->WorksheetCategory_Idn->ViewValue = $this->WorksheetCategory_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->WorksheetCategory_Idn->ViewValue = $this->WorksheetCategory_Idn->CurrentValue;
				}
			}
		} else {
			$this->WorksheetCategory_Idn->ViewValue = NULL;
		}
		$this->WorksheetCategory_Idn->ViewCustomAttributes = "";

		// Manufacturer_Idn
		$curVal = strval($this->Manufacturer_Idn->CurrentValue);
		if ($curVal != "") {
			$this->Manufacturer_Idn->ViewValue = $this->Manufacturer_Idn->lookupCacheOption($curVal);
			if ($this->Manufacturer_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[Manufacturer_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Manufacturer_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Manufacturer_Idn->ViewValue = $this->Manufacturer_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Manufacturer_Idn->ViewValue = $this->Manufacturer_Idn->CurrentValue;
				}
			}
		} else {
			$this->Manufacturer_Idn->ViewValue = NULL;
		}
		$this->Manufacturer_Idn->ViewCustomAttributes = "";

		// Rank
		$this->Rank->ViewValue = $this->Rank->CurrentValue;
		$this->Rank->ViewValue = FormatNumber($this->Rank->ViewValue, 0, -2, -2, -2);
		$this->Rank->ViewCustomAttributes = "";

		// Name
		$this->Name->ViewValue = $this->Name->CurrentValue;
		$this->Name->ViewCustomAttributes = "";

		// MaterialUnitPrice
		$this->MaterialUnitPrice->ViewValue = $this->MaterialUnitPrice->CurrentValue;
		$this->MaterialUnitPrice->ViewValue = FormatNumber($this->MaterialUnitPrice->ViewValue, 2, -2, -2, -2);
		$this->MaterialUnitPrice->ViewCustomAttributes = "";

		// FieldUnitPrice
		$this->FieldUnitPrice->ViewValue = $this->FieldUnitPrice->CurrentValue;
		$this->FieldUnitPrice->ViewValue = FormatNumber($this->FieldUnitPrice->ViewValue, 2, -2, -2, -2);
		$this->FieldUnitPrice->ViewCustomAttributes = "";

		// ShopUnitPrice
		$this->ShopUnitPrice->ViewValue = $this->ShopUnitPrice->CurrentValue;
		$this->ShopUnitPrice->ViewValue = FormatNumber($this->ShopUnitPrice->ViewValue, 2, -2, -2, -2);
		$this->ShopUnitPrice->ViewCustomAttributes = "";

		// EngineerUnitPrice
		$this->EngineerUnitPrice->ViewValue = $this->EngineerUnitPrice->CurrentValue;
		$this->EngineerUnitPrice->ViewValue = FormatNumber($this->EngineerUnitPrice->ViewValue, 2, -2, -2, -2);
		$this->EngineerUnitPrice->ViewCustomAttributes = "";

		// DefaultQuantity
		$this->DefaultQuantity->ViewValue = $this->DefaultQuantity->CurrentValue;
		$this->DefaultQuantity->ViewValue = FormatNumber($this->DefaultQuantity->ViewValue, 2, -2, -2, -2);
		$this->DefaultQuantity->ViewCustomAttributes = "";

		// ProductSize_Idn
		$curVal = strval($this->ProductSize_Idn->CurrentValue);
		if ($curVal != "") {
			$this->ProductSize_Idn->ViewValue = $this->ProductSize_Idn->lookupCacheOption($curVal);
			if ($this->ProductSize_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[ProductSize_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ProductSize_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ProductSize_Idn->ViewValue = $this->ProductSize_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ProductSize_Idn->ViewValue = $this->ProductSize_Idn->CurrentValue;
				}
			}
		} else {
			$this->ProductSize_Idn->ViewValue = NULL;
		}
		$this->ProductSize_Idn->ViewCustomAttributes = "";

		// Description
		$this->Description->ViewValue = $this->Description->CurrentValue;
		$this->Description->ViewCustomAttributes = "";

		// PipeType_Idn
		$curVal = strval($this->PipeType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->PipeType_Idn->ViewValue = $this->PipeType_Idn->lookupCacheOption($curVal);
			if ($this->PipeType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[PipeType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->PipeType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->PipeType_Idn->ViewValue = $this->PipeType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PipeType_Idn->ViewValue = $this->PipeType_Idn->CurrentValue;
				}
			}
		} else {
			$this->PipeType_Idn->ViewValue = NULL;
		}
		$this->PipeType_Idn->ViewCustomAttributes = "";

		// ScheduleType_Idn
		$curVal = strval($this->ScheduleType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->ScheduleType_Idn->ViewValue = $this->ScheduleType_Idn->lookupCacheOption($curVal);
			if ($this->ScheduleType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[ScheduleType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ScheduleType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ScheduleType_Idn->ViewValue = $this->ScheduleType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ScheduleType_Idn->ViewValue = $this->ScheduleType_Idn->CurrentValue;
				}
			}
		} else {
			$this->ScheduleType_Idn->ViewValue = NULL;
		}
		$this->ScheduleType_Idn->ViewCustomAttributes = "";

		// Fitting_Idn
		$curVal = strval($this->Fitting_Idn->CurrentValue);
		if ($curVal != "") {
			$this->Fitting_Idn->ViewValue = $this->Fitting_Idn->lookupCacheOption($curVal);
			if ($this->Fitting_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[Fitting_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Fitting_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Fitting_Idn->ViewValue = $this->Fitting_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Fitting_Idn->ViewValue = $this->Fitting_Idn->CurrentValue;
				}
			}
		} else {
			$this->Fitting_Idn->ViewValue = NULL;
		}
		$this->Fitting_Idn->ViewCustomAttributes = "";

		// GroovedFittingType_Idn
		$curVal = strval($this->GroovedFittingType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->GroovedFittingType_Idn->ViewValue = $this->GroovedFittingType_Idn->lookupCacheOption($curVal);
			if ($this->GroovedFittingType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[GroovedFittingType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->GroovedFittingType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->GroovedFittingType_Idn->ViewValue = $this->GroovedFittingType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->GroovedFittingType_Idn->ViewValue = $this->GroovedFittingType_Idn->CurrentValue;
				}
			}
		} else {
			$this->GroovedFittingType_Idn->ViewValue = NULL;
		}
		$this->GroovedFittingType_Idn->ViewCustomAttributes = "";

		// ThreadedFittingType_Idn
		$curVal = strval($this->ThreadedFittingType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->ThreadedFittingType_Idn->ViewValue = $this->ThreadedFittingType_Idn->lookupCacheOption($curVal);
			if ($this->ThreadedFittingType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[ThreadedFittingType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ThreadedFittingType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ThreadedFittingType_Idn->ViewValue = $this->ThreadedFittingType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ThreadedFittingType_Idn->ViewValue = $this->ThreadedFittingType_Idn->CurrentValue;
				}
			}
		} else {
			$this->ThreadedFittingType_Idn->ViewValue = NULL;
		}
		$this->ThreadedFittingType_Idn->ViewCustomAttributes = "";

		// HangerType_Idn
		$curVal = strval($this->HangerType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->HangerType_Idn->ViewValue = $this->HangerType_Idn->lookupCacheOption($curVal);
			if ($this->HangerType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[HangerType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->HangerType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->HangerType_Idn->ViewValue = $this->HangerType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->HangerType_Idn->ViewValue = $this->HangerType_Idn->CurrentValue;
				}
			}
		} else {
			$this->HangerType_Idn->ViewValue = NULL;
		}
		$this->HangerType_Idn->ViewCustomAttributes = "";

		// HangerSubType_Idn
		$curVal = strval($this->HangerSubType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->HangerSubType_Idn->ViewValue = $this->HangerSubType_Idn->lookupCacheOption($curVal);
			if ($this->HangerSubType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[HangerSubType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->HangerSubType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->HangerSubType_Idn->ViewValue = $this->HangerSubType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->HangerSubType_Idn->ViewValue = $this->HangerSubType_Idn->CurrentValue;
				}
			}
		} else {
			$this->HangerSubType_Idn->ViewValue = NULL;
		}
		$this->HangerSubType_Idn->ViewCustomAttributes = "";

		// SubcontractCategory_Idn
		$curVal = strval($this->SubcontractCategory_Idn->CurrentValue);
		if ($curVal != "") {
			$this->SubcontractCategory_Idn->ViewValue = $this->SubcontractCategory_Idn->lookupCacheOption($curVal);
			if ($this->SubcontractCategory_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[WorksheetColumn_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->SubcontractCategory_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->SubcontractCategory_Idn->ViewValue = $this->SubcontractCategory_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SubcontractCategory_Idn->ViewValue = $this->SubcontractCategory_Idn->CurrentValue;
				}
			}
		} else {
			$this->SubcontractCategory_Idn->ViewValue = NULL;
		}
		$this->SubcontractCategory_Idn->ViewCustomAttributes = "";

		// ApplyToAdjustmentFactorsFlag
		if (ConvertToBool($this->ApplyToAdjustmentFactorsFlag->CurrentValue)) {
			$this->ApplyToAdjustmentFactorsFlag->ViewValue = $this->ApplyToAdjustmentFactorsFlag->tagCaption(1) != "" ? $this->ApplyToAdjustmentFactorsFlag->tagCaption(1) : "Yes";
		} else {
			$this->ApplyToAdjustmentFactorsFlag->ViewValue = $this->ApplyToAdjustmentFactorsFlag->tagCaption(2) != "" ? $this->ApplyToAdjustmentFactorsFlag->tagCaption(2) : "No";
		}
		$this->ApplyToAdjustmentFactorsFlag->ViewCustomAttributes = "";

		// ApplyToContingencyFlag
		if (ConvertToBool($this->ApplyToContingencyFlag->CurrentValue)) {
			$this->ApplyToContingencyFlag->ViewValue = $this->ApplyToContingencyFlag->tagCaption(1) != "" ? $this->ApplyToContingencyFlag->tagCaption(1) : "Yes";
		} else {
			$this->ApplyToContingencyFlag->ViewValue = $this->ApplyToContingencyFlag->tagCaption(2) != "" ? $this->ApplyToContingencyFlag->tagCaption(2) : "No";
		}
		$this->ApplyToContingencyFlag->ViewCustomAttributes = "";

		// IsMainComponent
		if (ConvertToBool($this->IsMainComponent->CurrentValue)) {
			$this->IsMainComponent->ViewValue = $this->IsMainComponent->tagCaption(1) != "" ? $this->IsMainComponent->tagCaption(1) : "Yes";
		} else {
			$this->IsMainComponent->ViewValue = $this->IsMainComponent->tagCaption(2) != "" ? $this->IsMainComponent->tagCaption(2) : "No";
		}
		$this->IsMainComponent->ViewCustomAttributes = "";

		// DomesticFlag
		if (ConvertToBool($this->DomesticFlag->CurrentValue)) {
			$this->DomesticFlag->ViewValue = $this->DomesticFlag->tagCaption(1) != "" ? $this->DomesticFlag->tagCaption(1) : "Yes";
		} else {
			$this->DomesticFlag->ViewValue = $this->DomesticFlag->tagCaption(2) != "" ? $this->DomesticFlag->tagCaption(2) : "No";
		}
		$this->DomesticFlag->ViewCustomAttributes = "";

		// LoadFlag
		if (ConvertToBool($this->LoadFlag->CurrentValue)) {
			$this->LoadFlag->ViewValue = $this->LoadFlag->tagCaption(1) != "" ? $this->LoadFlag->tagCaption(1) : "Yes";
		} else {
			$this->LoadFlag->ViewValue = $this->LoadFlag->tagCaption(2) != "" ? $this->LoadFlag->tagCaption(2) : "No";
		}
		$this->LoadFlag->ViewCustomAttributes = "";

		// AutoLoadFlag
		if (ConvertToBool($this->AutoLoadFlag->CurrentValue)) {
			$this->AutoLoadFlag->ViewValue = $this->AutoLoadFlag->tagCaption(1) != "" ? $this->AutoLoadFlag->tagCaption(1) : "Yes";
		} else {
			$this->AutoLoadFlag->ViewValue = $this->AutoLoadFlag->tagCaption(2) != "" ? $this->AutoLoadFlag->tagCaption(2) : "No";
		}
		$this->AutoLoadFlag->ViewCustomAttributes = "";

		// ActiveFlag
		if (ConvertToBool($this->ActiveFlag->CurrentValue)) {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(1) != "" ? $this->ActiveFlag->tagCaption(1) : "Yes";
		} else {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(2) != "" ? $this->ActiveFlag->tagCaption(2) : "No";
		}
		$this->ActiveFlag->ViewCustomAttributes = "";

		// GradeType_Idn
		$curVal = strval($this->GradeType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->GradeType_Idn->ViewValue = $this->GradeType_Idn->lookupCacheOption($curVal);
			if ($this->GradeType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[GradeType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->GradeType_Idn->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->GradeType_Idn->ViewValue = $this->GradeType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->GradeType_Idn->ViewValue = $this->GradeType_Idn->CurrentValue;
				}
			}
		} else {
			$this->GradeType_Idn->ViewValue = NULL;
		}
		$this->GradeType_Idn->ViewCustomAttributes = "";

		// PressureType_Idn
		$curVal = strval($this->PressureType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->PressureType_Idn->ViewValue = $this->PressureType_Idn->lookupCacheOption($curVal);
			if ($this->PressureType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[PressureType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->PressureType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->PressureType_Idn->ViewValue = $this->PressureType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->PressureType_Idn->ViewValue = $this->PressureType_Idn->CurrentValue;
				}
			}
		} else {
			$this->PressureType_Idn->ViewValue = NULL;
		}
		$this->PressureType_Idn->ViewCustomAttributes = "";

		// SeamlessFlag
		if (ConvertToBool($this->SeamlessFlag->CurrentValue)) {
			$this->SeamlessFlag->ViewValue = $this->SeamlessFlag->tagCaption(1) != "" ? $this->SeamlessFlag->tagCaption(1) : "Yes";
		} else {
			$this->SeamlessFlag->ViewValue = $this->SeamlessFlag->tagCaption(2) != "" ? $this->SeamlessFlag->tagCaption(2) : "No";
		}
		$this->SeamlessFlag->ViewCustomAttributes = "";

		// ResponseType
		if (strval($this->ResponseType->CurrentValue) != "") {
			$this->ResponseType->ViewValue = $this->ResponseType->optionCaption($this->ResponseType->CurrentValue);
		} else {
			$this->ResponseType->ViewValue = NULL;
		}
		$this->ResponseType->ViewCustomAttributes = "";

		// FMJobFlag
		if (ConvertToBool($this->FMJobFlag->CurrentValue)) {
			$this->FMJobFlag->ViewValue = $this->FMJobFlag->tagCaption(1) != "" ? $this->FMJobFlag->tagCaption(1) : "Yes";
		} else {
			$this->FMJobFlag->ViewValue = $this->FMJobFlag->tagCaption(2) != "" ? $this->FMJobFlag->tagCaption(2) : "No";
		}
		$this->FMJobFlag->ViewCustomAttributes = "";

		// RecommendedBoxes
		$this->RecommendedBoxes->ViewValue = $this->RecommendedBoxes->CurrentValue;
		$this->RecommendedBoxes->ViewValue = FormatNumber($this->RecommendedBoxes->ViewValue, 0, -2, -2, -2);
		$this->RecommendedBoxes->ViewCustomAttributes = "";

		// RecommendedWireFootage
		$this->RecommendedWireFootage->ViewValue = $this->RecommendedWireFootage->CurrentValue;
		$this->RecommendedWireFootage->ViewValue = FormatNumber($this->RecommendedWireFootage->ViewValue, 0, -2, -2, -2);
		$this->RecommendedWireFootage->ViewCustomAttributes = "";

		// CoverageType_Idn
		$curVal = strval($this->CoverageType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->CoverageType_Idn->ViewValue = $this->CoverageType_Idn->lookupCacheOption($curVal);
			if ($this->CoverageType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[CoverageType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->CoverageType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->CoverageType_Idn->ViewValue = $this->CoverageType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CoverageType_Idn->ViewValue = $this->CoverageType_Idn->CurrentValue;
				}
			}
		} else {
			$this->CoverageType_Idn->ViewValue = NULL;
		}
		$this->CoverageType_Idn->ViewCustomAttributes = "";

		// HeadType_Idn
		$curVal = strval($this->HeadType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->HeadType_Idn->ViewValue = $this->HeadType_Idn->lookupCacheOption($curVal);
			if ($this->HeadType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[HeadType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->HeadType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->HeadType_Idn->ViewValue = $this->HeadType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->HeadType_Idn->ViewValue = $this->HeadType_Idn->CurrentValue;
				}
			}
		} else {
			$this->HeadType_Idn->ViewValue = NULL;
		}
		$this->HeadType_Idn->ViewCustomAttributes = "";

		// FinishType_Idn
		$curVal = strval($this->FinishType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->FinishType_Idn->ViewValue = $this->FinishType_Idn->lookupCacheOption($curVal);
			if ($this->FinishType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[FinishType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->FinishType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->FinishType_Idn->ViewValue = $this->FinishType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->FinishType_Idn->ViewValue = $this->FinishType_Idn->CurrentValue;
				}
			}
		} else {
			$this->FinishType_Idn->ViewValue = NULL;
		}
		$this->FinishType_Idn->ViewCustomAttributes = "";

		// Outlet_Idn
		$curVal = strval($this->Outlet_Idn->CurrentValue);
		if ($curVal != "") {
			$this->Outlet_Idn->ViewValue = $this->Outlet_Idn->lookupCacheOption($curVal);
			if ($this->Outlet_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[Outlet_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Outlet_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Outlet_Idn->ViewValue = $this->Outlet_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Outlet_Idn->ViewValue = $this->Outlet_Idn->CurrentValue;
				}
			}
		} else {
			$this->Outlet_Idn->ViewValue = NULL;
		}
		$this->Outlet_Idn->ViewCustomAttributes = "";

		// RiserType_Idn
		$curVal = strval($this->RiserType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->RiserType_Idn->ViewValue = $this->RiserType_Idn->lookupCacheOption($curVal);
			if ($this->RiserType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[RiserType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->RiserType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->RiserType_Idn->ViewValue = $this->RiserType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->RiserType_Idn->ViewValue = $this->RiserType_Idn->CurrentValue;
				}
			}
		} else {
			$this->RiserType_Idn->ViewValue = NULL;
		}
		$this->RiserType_Idn->ViewCustomAttributes = "";

		// BackFlowType_Idn
		$curVal = strval($this->BackFlowType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->BackFlowType_Idn->ViewValue = $this->BackFlowType_Idn->lookupCacheOption($curVal);
			if ($this->BackFlowType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[BackflowType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->BackFlowType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->BackFlowType_Idn->ViewValue = $this->BackFlowType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BackFlowType_Idn->ViewValue = $this->BackFlowType_Idn->CurrentValue;
				}
			}
		} else {
			$this->BackFlowType_Idn->ViewValue = NULL;
		}
		$this->BackFlowType_Idn->ViewCustomAttributes = "";

		// ControlValve_Idn
		$curVal = strval($this->ControlValve_Idn->CurrentValue);
		if ($curVal != "") {
			$this->ControlValve_Idn->ViewValue = $this->ControlValve_Idn->lookupCacheOption($curVal);
			if ($this->ControlValve_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[ControlValve_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ControlValve_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ControlValve_Idn->ViewValue = $this->ControlValve_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ControlValve_Idn->ViewValue = $this->ControlValve_Idn->CurrentValue;
				}
			}
		} else {
			$this->ControlValve_Idn->ViewValue = NULL;
		}
		$this->ControlValve_Idn->ViewCustomAttributes = "";

		// CheckValve_Idn
		$curVal = strval($this->CheckValve_Idn->CurrentValue);
		if ($curVal != "") {
			$this->CheckValve_Idn->ViewValue = $this->CheckValve_Idn->lookupCacheOption($curVal);
			if ($this->CheckValve_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[CheckValve_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->CheckValve_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->CheckValve_Idn->ViewValue = $this->CheckValve_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->CheckValve_Idn->ViewValue = $this->CheckValve_Idn->CurrentValue;
				}
			}
		} else {
			$this->CheckValve_Idn->ViewValue = NULL;
		}
		$this->CheckValve_Idn->ViewCustomAttributes = "";

		// FDCType_Idn
		$curVal = strval($this->FDCType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->FDCType_Idn->ViewValue = $this->FDCType_Idn->lookupCacheOption($curVal);
			if ($this->FDCType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[FdcType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->FDCType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->FDCType_Idn->ViewValue = $this->FDCType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->FDCType_Idn->ViewValue = $this->FDCType_Idn->CurrentValue;
				}
			}
		} else {
			$this->FDCType_Idn->ViewValue = NULL;
		}
		$this->FDCType_Idn->ViewCustomAttributes = "";

		// BellType_Idn
		$curVal = strval($this->BellType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->BellType_Idn->ViewValue = $this->BellType_Idn->lookupCacheOption($curVal);
			if ($this->BellType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[BellType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->BellType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->BellType_Idn->ViewValue = $this->BellType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BellType_Idn->ViewValue = $this->BellType_Idn->CurrentValue;
				}
			}
		} else {
			$this->BellType_Idn->ViewValue = NULL;
		}
		$this->BellType_Idn->ViewCustomAttributes = "";

		// TappingTee_Idn
		$curVal = strval($this->TappingTee_Idn->CurrentValue);
		if ($curVal != "") {
			$this->TappingTee_Idn->ViewValue = $this->TappingTee_Idn->lookupCacheOption($curVal);
			if ($this->TappingTee_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[TappingTee_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->TappingTee_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->TappingTee_Idn->ViewValue = $this->TappingTee_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->TappingTee_Idn->ViewValue = $this->TappingTee_Idn->CurrentValue;
				}
			}
		} else {
			$this->TappingTee_Idn->ViewValue = NULL;
		}
		$this->TappingTee_Idn->ViewCustomAttributes = "";

		// UndergroundValve_Idn
		$curVal = strval($this->UndergroundValve_Idn->CurrentValue);
		if ($curVal != "") {
			$this->UndergroundValve_Idn->ViewValue = $this->UndergroundValve_Idn->lookupCacheOption($curVal);
			if ($this->UndergroundValve_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[UndergroundValve_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->UndergroundValve_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->UndergroundValve_Idn->ViewValue = $this->UndergroundValve_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->UndergroundValve_Idn->ViewValue = $this->UndergroundValve_Idn->CurrentValue;
				}
			}
		} else {
			$this->UndergroundValve_Idn->ViewValue = NULL;
		}
		$this->UndergroundValve_Idn->ViewCustomAttributes = "";

		// LiftDuration_Idn
		$curVal = strval($this->LiftDuration_Idn->CurrentValue);
		if ($curVal != "") {
			$this->LiftDuration_Idn->ViewValue = $this->LiftDuration_Idn->lookupCacheOption($curVal);
			if ($this->LiftDuration_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[LiftDuration_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->LiftDuration_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->LiftDuration_Idn->ViewValue = $this->LiftDuration_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->LiftDuration_Idn->ViewValue = $this->LiftDuration_Idn->CurrentValue;
				}
			}
		} else {
			$this->LiftDuration_Idn->ViewValue = NULL;
		}
		$this->LiftDuration_Idn->ViewCustomAttributes = "";

		// TrimPackageFlag
		if (ConvertToBool($this->TrimPackageFlag->CurrentValue)) {
			$this->TrimPackageFlag->ViewValue = $this->TrimPackageFlag->tagCaption(1) != "" ? $this->TrimPackageFlag->tagCaption(1) : "Yes";
		} else {
			$this->TrimPackageFlag->ViewValue = $this->TrimPackageFlag->tagCaption(2) != "" ? $this->TrimPackageFlag->tagCaption(2) : "No";
		}
		$this->TrimPackageFlag->ViewCustomAttributes = "";

		// ListedFlag
		if (ConvertToBool($this->ListedFlag->CurrentValue)) {
			$this->ListedFlag->ViewValue = $this->ListedFlag->tagCaption(1) != "" ? $this->ListedFlag->tagCaption(1) : "Yes";
		} else {
			$this->ListedFlag->ViewValue = $this->ListedFlag->tagCaption(2) != "" ? $this->ListedFlag->tagCaption(2) : "No";
		}
		$this->ListedFlag->ViewCustomAttributes = "";

		// BoxWireLength
		$this->BoxWireLength->ViewValue = $this->BoxWireLength->CurrentValue;
		$this->BoxWireLength->ViewValue = FormatNumber($this->BoxWireLength->ViewValue, 0, -2, -2, -2);
		$this->BoxWireLength->ViewCustomAttributes = "";

		// IsFirePump
		if (ConvertToBool($this->IsFirePump->CurrentValue)) {
			$this->IsFirePump->ViewValue = $this->IsFirePump->tagCaption(1) != "" ? $this->IsFirePump->tagCaption(1) : "Yes";
		} else {
			$this->IsFirePump->ViewValue = $this->IsFirePump->tagCaption(2) != "" ? $this->IsFirePump->tagCaption(2) : "No";
		}
		$this->IsFirePump->ViewCustomAttributes = "";

		// FirePumpType_Idn
		$curVal = strval($this->FirePumpType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->FirePumpType_Idn->ViewValue = $this->FirePumpType_Idn->lookupCacheOption($curVal);
			if ($this->FirePumpType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[FirePumpAttribute_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->FirePumpType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->FirePumpType_Idn->ViewValue = $this->FirePumpType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->FirePumpType_Idn->ViewValue = $this->FirePumpType_Idn->CurrentValue;
				}
			}
		} else {
			$this->FirePumpType_Idn->ViewValue = NULL;
		}
		$this->FirePumpType_Idn->ViewCustomAttributes = "";

		// FirePumpAttribute_Idn
		$this->FirePumpAttribute_Idn->ViewValue = $this->FirePumpAttribute_Idn->CurrentValue;
		$this->FirePumpAttribute_Idn->ViewValue = FormatNumber($this->FirePumpAttribute_Idn->ViewValue, 0, -2, -2, -2);
		$this->FirePumpAttribute_Idn->ViewCustomAttributes = "";

		// IsDieselFuel
		if (ConvertToBool($this->IsDieselFuel->CurrentValue)) {
			$this->IsDieselFuel->ViewValue = $this->IsDieselFuel->tagCaption(1) != "" ? $this->IsDieselFuel->tagCaption(1) : "Yes";
		} else {
			$this->IsDieselFuel->ViewValue = $this->IsDieselFuel->tagCaption(2) != "" ? $this->IsDieselFuel->tagCaption(2) : "No";
		}
		$this->IsDieselFuel->ViewCustomAttributes = "";

		// IsSolution
		if (ConvertToBool($this->IsSolution->CurrentValue)) {
			$this->IsSolution->ViewValue = $this->IsSolution->tagCaption(1) != "" ? $this->IsSolution->tagCaption(1) : "Yes";
		} else {
			$this->IsSolution->ViewValue = $this->IsSolution->tagCaption(2) != "" ? $this->IsSolution->tagCaption(2) : "No";
		}
		$this->IsSolution->ViewCustomAttributes = "";

		// Position_Idn
		$curVal = strval($this->Position_Idn->CurrentValue);
		if ($curVal != "") {
			$this->Position_Idn->ViewValue = $this->Position_Idn->lookupCacheOption($curVal);
			if ($this->Position_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[Position_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Position_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->Position_Idn->ViewValue = $this->Position_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Position_Idn->ViewValue = $this->Position_Idn->CurrentValue;
				}
			}
		} else {
			$this->Position_Idn->ViewValue = NULL;
		}
		$this->Position_Idn->ViewCustomAttributes = "";

		// Product_Idn
		$this->Product_Idn->LinkCustomAttributes = "";
		$this->Product_Idn->HrefValue = "";
		$this->Product_Idn->TooltipValue = "";

		// Department_Idn
		$this->Department_Idn->LinkCustomAttributes = "";
		$this->Department_Idn->HrefValue = "";
		$this->Department_Idn->TooltipValue = "";

		// WorksheetMaster_Idn
		$this->WorksheetMaster_Idn->LinkCustomAttributes = "";
		$this->WorksheetMaster_Idn->HrefValue = "";
		$this->WorksheetMaster_Idn->TooltipValue = "";

		// WorksheetCategory_Idn
		$this->WorksheetCategory_Idn->LinkCustomAttributes = "";
		$this->WorksheetCategory_Idn->HrefValue = "";
		$this->WorksheetCategory_Idn->TooltipValue = "";

		// Manufacturer_Idn
		$this->Manufacturer_Idn->LinkCustomAttributes = "";
		$this->Manufacturer_Idn->HrefValue = "";
		$this->Manufacturer_Idn->TooltipValue = "";

		// Rank
		$this->Rank->LinkCustomAttributes = "";
		$this->Rank->HrefValue = "";
		$this->Rank->TooltipValue = "";

		// Name
		$this->Name->LinkCustomAttributes = "";
		$this->Name->HrefValue = "";
		$this->Name->TooltipValue = "";

		// MaterialUnitPrice
		$this->MaterialUnitPrice->LinkCustomAttributes = "";
		$this->MaterialUnitPrice->HrefValue = "";
		$this->MaterialUnitPrice->TooltipValue = "";

		// FieldUnitPrice
		$this->FieldUnitPrice->LinkCustomAttributes = "";
		$this->FieldUnitPrice->HrefValue = "";
		$this->FieldUnitPrice->TooltipValue = "";

		// ShopUnitPrice
		$this->ShopUnitPrice->LinkCustomAttributes = "";
		$this->ShopUnitPrice->HrefValue = "";
		$this->ShopUnitPrice->TooltipValue = "";

		// EngineerUnitPrice
		$this->EngineerUnitPrice->LinkCustomAttributes = "";
		$this->EngineerUnitPrice->HrefValue = "";
		$this->EngineerUnitPrice->TooltipValue = "";

		// DefaultQuantity
		$this->DefaultQuantity->LinkCustomAttributes = "";
		$this->DefaultQuantity->HrefValue = "";
		$this->DefaultQuantity->TooltipValue = "";

		// ProductSize_Idn
		$this->ProductSize_Idn->LinkCustomAttributes = "";
		$this->ProductSize_Idn->HrefValue = "";
		$this->ProductSize_Idn->TooltipValue = "";

		// Description
		$this->Description->LinkCustomAttributes = "";
		$this->Description->HrefValue = "";
		$this->Description->TooltipValue = "";

		// PipeType_Idn
		$this->PipeType_Idn->LinkCustomAttributes = "";
		$this->PipeType_Idn->HrefValue = "";
		$this->PipeType_Idn->TooltipValue = "";

		// ScheduleType_Idn
		$this->ScheduleType_Idn->LinkCustomAttributes = "";
		$this->ScheduleType_Idn->HrefValue = "";
		$this->ScheduleType_Idn->TooltipValue = "";

		// Fitting_Idn
		$this->Fitting_Idn->LinkCustomAttributes = "";
		$this->Fitting_Idn->HrefValue = "";
		$this->Fitting_Idn->TooltipValue = "";

		// GroovedFittingType_Idn
		$this->GroovedFittingType_Idn->LinkCustomAttributes = "";
		$this->GroovedFittingType_Idn->HrefValue = "";
		$this->GroovedFittingType_Idn->TooltipValue = "";

		// ThreadedFittingType_Idn
		$this->ThreadedFittingType_Idn->LinkCustomAttributes = "";
		$this->ThreadedFittingType_Idn->HrefValue = "";
		$this->ThreadedFittingType_Idn->TooltipValue = "";

		// HangerType_Idn
		$this->HangerType_Idn->LinkCustomAttributes = "";
		$this->HangerType_Idn->HrefValue = "";
		$this->HangerType_Idn->TooltipValue = "";

		// HangerSubType_Idn
		$this->HangerSubType_Idn->LinkCustomAttributes = "";
		$this->HangerSubType_Idn->HrefValue = "";
		$this->HangerSubType_Idn->TooltipValue = "";

		// SubcontractCategory_Idn
		$this->SubcontractCategory_Idn->LinkCustomAttributes = "";
		$this->SubcontractCategory_Idn->HrefValue = "";
		$this->SubcontractCategory_Idn->TooltipValue = "";

		// ApplyToAdjustmentFactorsFlag
		$this->ApplyToAdjustmentFactorsFlag->LinkCustomAttributes = "";
		$this->ApplyToAdjustmentFactorsFlag->HrefValue = "";
		$this->ApplyToAdjustmentFactorsFlag->TooltipValue = "";

		// ApplyToContingencyFlag
		$this->ApplyToContingencyFlag->LinkCustomAttributes = "";
		$this->ApplyToContingencyFlag->HrefValue = "";
		$this->ApplyToContingencyFlag->TooltipValue = "";

		// IsMainComponent
		$this->IsMainComponent->LinkCustomAttributes = "";
		$this->IsMainComponent->HrefValue = "";
		$this->IsMainComponent->TooltipValue = "";

		// DomesticFlag
		$this->DomesticFlag->LinkCustomAttributes = "";
		$this->DomesticFlag->HrefValue = "";
		$this->DomesticFlag->TooltipValue = "";

		// LoadFlag
		$this->LoadFlag->LinkCustomAttributes = "";
		$this->LoadFlag->HrefValue = "";
		$this->LoadFlag->TooltipValue = "";

		// AutoLoadFlag
		$this->AutoLoadFlag->LinkCustomAttributes = "";
		$this->AutoLoadFlag->HrefValue = "";
		$this->AutoLoadFlag->TooltipValue = "";

		// ActiveFlag
		$this->ActiveFlag->LinkCustomAttributes = "";
		$this->ActiveFlag->HrefValue = "";
		$this->ActiveFlag->TooltipValue = "";

		// GradeType_Idn
		$this->GradeType_Idn->LinkCustomAttributes = "";
		$this->GradeType_Idn->HrefValue = "";
		$this->GradeType_Idn->TooltipValue = "";

		// PressureType_Idn
		$this->PressureType_Idn->LinkCustomAttributes = "";
		$this->PressureType_Idn->HrefValue = "";
		$this->PressureType_Idn->TooltipValue = "";

		// SeamlessFlag
		$this->SeamlessFlag->LinkCustomAttributes = "";
		$this->SeamlessFlag->HrefValue = "";
		$this->SeamlessFlag->TooltipValue = "";

		// ResponseType
		$this->ResponseType->LinkCustomAttributes = "";
		$this->ResponseType->HrefValue = "";
		$this->ResponseType->TooltipValue = "";

		// FMJobFlag
		$this->FMJobFlag->LinkCustomAttributes = "";
		$this->FMJobFlag->HrefValue = "";
		$this->FMJobFlag->TooltipValue = "";

		// RecommendedBoxes
		$this->RecommendedBoxes->LinkCustomAttributes = "";
		$this->RecommendedBoxes->HrefValue = "";
		$this->RecommendedBoxes->TooltipValue = "";

		// RecommendedWireFootage
		$this->RecommendedWireFootage->LinkCustomAttributes = "";
		$this->RecommendedWireFootage->HrefValue = "";
		$this->RecommendedWireFootage->TooltipValue = "";

		// CoverageType_Idn
		$this->CoverageType_Idn->LinkCustomAttributes = "";
		$this->CoverageType_Idn->HrefValue = "";
		$this->CoverageType_Idn->TooltipValue = "";

		// HeadType_Idn
		$this->HeadType_Idn->LinkCustomAttributes = "";
		$this->HeadType_Idn->HrefValue = "";
		$this->HeadType_Idn->TooltipValue = "";

		// FinishType_Idn
		$this->FinishType_Idn->LinkCustomAttributes = "";
		$this->FinishType_Idn->HrefValue = "";
		$this->FinishType_Idn->TooltipValue = "";

		// Outlet_Idn
		$this->Outlet_Idn->LinkCustomAttributes = "";
		$this->Outlet_Idn->HrefValue = "";
		$this->Outlet_Idn->TooltipValue = "";

		// RiserType_Idn
		$this->RiserType_Idn->LinkCustomAttributes = "";
		$this->RiserType_Idn->HrefValue = "";
		$this->RiserType_Idn->TooltipValue = "";

		// BackFlowType_Idn
		$this->BackFlowType_Idn->LinkCustomAttributes = "";
		$this->BackFlowType_Idn->HrefValue = "";
		$this->BackFlowType_Idn->TooltipValue = "";

		// ControlValve_Idn
		$this->ControlValve_Idn->LinkCustomAttributes = "";
		$this->ControlValve_Idn->HrefValue = "";
		$this->ControlValve_Idn->TooltipValue = "";

		// CheckValve_Idn
		$this->CheckValve_Idn->LinkCustomAttributes = "";
		$this->CheckValve_Idn->HrefValue = "";
		$this->CheckValve_Idn->TooltipValue = "";

		// FDCType_Idn
		$this->FDCType_Idn->LinkCustomAttributes = "";
		$this->FDCType_Idn->HrefValue = "";
		$this->FDCType_Idn->TooltipValue = "";

		// BellType_Idn
		$this->BellType_Idn->LinkCustomAttributes = "";
		$this->BellType_Idn->HrefValue = "";
		$this->BellType_Idn->TooltipValue = "";

		// TappingTee_Idn
		$this->TappingTee_Idn->LinkCustomAttributes = "";
		$this->TappingTee_Idn->HrefValue = "";
		$this->TappingTee_Idn->TooltipValue = "";

		// UndergroundValve_Idn
		$this->UndergroundValve_Idn->LinkCustomAttributes = "";
		$this->UndergroundValve_Idn->HrefValue = "";
		$this->UndergroundValve_Idn->TooltipValue = "";

		// LiftDuration_Idn
		$this->LiftDuration_Idn->LinkCustomAttributes = "";
		$this->LiftDuration_Idn->HrefValue = "";
		$this->LiftDuration_Idn->TooltipValue = "";

		// TrimPackageFlag
		$this->TrimPackageFlag->LinkCustomAttributes = "";
		$this->TrimPackageFlag->HrefValue = "";
		$this->TrimPackageFlag->TooltipValue = "";

		// ListedFlag
		$this->ListedFlag->LinkCustomAttributes = "";
		$this->ListedFlag->HrefValue = "";
		$this->ListedFlag->TooltipValue = "";

		// BoxWireLength
		$this->BoxWireLength->LinkCustomAttributes = "";
		$this->BoxWireLength->HrefValue = "";
		$this->BoxWireLength->TooltipValue = "";

		// IsFirePump
		$this->IsFirePump->LinkCustomAttributes = "";
		$this->IsFirePump->HrefValue = "";
		$this->IsFirePump->TooltipValue = "";

		// FirePumpType_Idn
		$this->FirePumpType_Idn->LinkCustomAttributes = "";
		$this->FirePumpType_Idn->HrefValue = "";
		$this->FirePumpType_Idn->TooltipValue = "";

		// FirePumpAttribute_Idn
		$this->FirePumpAttribute_Idn->LinkCustomAttributes = "";
		$this->FirePumpAttribute_Idn->HrefValue = "";
		$this->FirePumpAttribute_Idn->TooltipValue = "";

		// IsDieselFuel
		$this->IsDieselFuel->LinkCustomAttributes = "";
		$this->IsDieselFuel->HrefValue = "";
		$this->IsDieselFuel->TooltipValue = "";

		// IsSolution
		$this->IsSolution->LinkCustomAttributes = "";
		$this->IsSolution->HrefValue = "";
		$this->IsSolution->TooltipValue = "";

		// Position_Idn
		$this->Position_Idn->LinkCustomAttributes = "";
		$this->Position_Idn->HrefValue = "";
		$this->Position_Idn->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Product_Idn
		$this->Product_Idn->EditAttrs["class"] = "form-control";
		$this->Product_Idn->EditCustomAttributes = "";
		$this->Product_Idn->EditValue = $this->Product_Idn->CurrentValue;
		$this->Product_Idn->ViewCustomAttributes = "";

		// Department_Idn
		$this->Department_Idn->EditAttrs["class"] = "form-control";
		$this->Department_Idn->EditCustomAttributes = "";

		// WorksheetMaster_Idn
		$this->WorksheetMaster_Idn->EditAttrs["class"] = "form-control";
		$this->WorksheetMaster_Idn->EditCustomAttributes = "";

		// WorksheetCategory_Idn
		$this->WorksheetCategory_Idn->EditAttrs["class"] = "form-control";
		$this->WorksheetCategory_Idn->EditCustomAttributes = "";

		// Manufacturer_Idn
		$this->Manufacturer_Idn->EditAttrs["class"] = "form-control";
		$this->Manufacturer_Idn->EditCustomAttributes = "";

		// Rank
		$this->Rank->EditAttrs["class"] = "form-control";
		$this->Rank->EditCustomAttributes = "";
		$this->Rank->EditValue = $this->Rank->CurrentValue;
		$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

		// Name
		$this->Name->EditAttrs["class"] = "form-control";
		$this->Name->EditCustomAttributes = "";
		if (!$this->Name->Raw)
			$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
		$this->Name->EditValue = $this->Name->CurrentValue;
		$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

		// MaterialUnitPrice
		$this->MaterialUnitPrice->EditAttrs["class"] = "form-control";
		$this->MaterialUnitPrice->EditCustomAttributes = "";
		$this->MaterialUnitPrice->EditValue = $this->MaterialUnitPrice->CurrentValue;
		$this->MaterialUnitPrice->PlaceHolder = RemoveHtml($this->MaterialUnitPrice->caption());
		if (strval($this->MaterialUnitPrice->EditValue) != "" && is_numeric($this->MaterialUnitPrice->EditValue))
			$this->MaterialUnitPrice->EditValue = FormatNumber($this->MaterialUnitPrice->EditValue, -2, -2, -2, -2);
		

		// FieldUnitPrice
		$this->FieldUnitPrice->EditAttrs["class"] = "form-control";
		$this->FieldUnitPrice->EditCustomAttributes = "";
		$this->FieldUnitPrice->EditValue = $this->FieldUnitPrice->CurrentValue;
		$this->FieldUnitPrice->PlaceHolder = RemoveHtml($this->FieldUnitPrice->caption());
		if (strval($this->FieldUnitPrice->EditValue) != "" && is_numeric($this->FieldUnitPrice->EditValue))
			$this->FieldUnitPrice->EditValue = FormatNumber($this->FieldUnitPrice->EditValue, -2, -2, -2, -2);
		

		// ShopUnitPrice
		$this->ShopUnitPrice->EditAttrs["class"] = "form-control";
		$this->ShopUnitPrice->EditCustomAttributes = "";
		$this->ShopUnitPrice->EditValue = $this->ShopUnitPrice->CurrentValue;
		$this->ShopUnitPrice->PlaceHolder = RemoveHtml($this->ShopUnitPrice->caption());
		if (strval($this->ShopUnitPrice->EditValue) != "" && is_numeric($this->ShopUnitPrice->EditValue))
			$this->ShopUnitPrice->EditValue = FormatNumber($this->ShopUnitPrice->EditValue, -2, -2, -2, -2);
		

		// EngineerUnitPrice
		$this->EngineerUnitPrice->EditAttrs["class"] = "form-control";
		$this->EngineerUnitPrice->EditCustomAttributes = "";
		$this->EngineerUnitPrice->EditValue = $this->EngineerUnitPrice->CurrentValue;
		$this->EngineerUnitPrice->PlaceHolder = RemoveHtml($this->EngineerUnitPrice->caption());
		if (strval($this->EngineerUnitPrice->EditValue) != "" && is_numeric($this->EngineerUnitPrice->EditValue))
			$this->EngineerUnitPrice->EditValue = FormatNumber($this->EngineerUnitPrice->EditValue, -2, -2, -2, -2);
		

		// DefaultQuantity
		$this->DefaultQuantity->EditAttrs["class"] = "form-control";
		$this->DefaultQuantity->EditCustomAttributes = "";
		$this->DefaultQuantity->EditValue = $this->DefaultQuantity->CurrentValue;
		$this->DefaultQuantity->PlaceHolder = RemoveHtml($this->DefaultQuantity->caption());
		if (strval($this->DefaultQuantity->EditValue) != "" && is_numeric($this->DefaultQuantity->EditValue))
			$this->DefaultQuantity->EditValue = FormatNumber($this->DefaultQuantity->EditValue, -2, -2, -2, -2);
		

		// ProductSize_Idn
		$this->ProductSize_Idn->EditAttrs["class"] = "form-control";
		$this->ProductSize_Idn->EditCustomAttributes = "";

		// Description
		$this->Description->EditAttrs["class"] = "form-control";
		$this->Description->EditCustomAttributes = "";
		$this->Description->EditValue = $this->Description->CurrentValue;
		$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

		// PipeType_Idn
		$this->PipeType_Idn->EditAttrs["class"] = "form-control";
		$this->PipeType_Idn->EditCustomAttributes = "";

		// ScheduleType_Idn
		$this->ScheduleType_Idn->EditAttrs["class"] = "form-control";
		$this->ScheduleType_Idn->EditCustomAttributes = "";

		// Fitting_Idn
		$this->Fitting_Idn->EditAttrs["class"] = "form-control";
		$this->Fitting_Idn->EditCustomAttributes = "";

		// GroovedFittingType_Idn
		$this->GroovedFittingType_Idn->EditAttrs["class"] = "form-control";
		$this->GroovedFittingType_Idn->EditCustomAttributes = "";

		// ThreadedFittingType_Idn
		$this->ThreadedFittingType_Idn->EditAttrs["class"] = "form-control";
		$this->ThreadedFittingType_Idn->EditCustomAttributes = "";

		// HangerType_Idn
		$this->HangerType_Idn->EditAttrs["class"] = "form-control";
		$this->HangerType_Idn->EditCustomAttributes = "";

		// HangerSubType_Idn
		$this->HangerSubType_Idn->EditAttrs["class"] = "form-control";
		$this->HangerSubType_Idn->EditCustomAttributes = "";

		// SubcontractCategory_Idn
		$this->SubcontractCategory_Idn->EditAttrs["class"] = "form-control";
		$this->SubcontractCategory_Idn->EditCustomAttributes = "";

		// ApplyToAdjustmentFactorsFlag
		$this->ApplyToAdjustmentFactorsFlag->EditCustomAttributes = "";
		$this->ApplyToAdjustmentFactorsFlag->EditValue = $this->ApplyToAdjustmentFactorsFlag->options(FALSE);

		// ApplyToContingencyFlag
		$this->ApplyToContingencyFlag->EditCustomAttributes = "";
		$this->ApplyToContingencyFlag->EditValue = $this->ApplyToContingencyFlag->options(FALSE);

		// IsMainComponent
		$this->IsMainComponent->EditCustomAttributes = "";
		$this->IsMainComponent->EditValue = $this->IsMainComponent->options(FALSE);

		// DomesticFlag
		$this->DomesticFlag->EditCustomAttributes = "";
		$this->DomesticFlag->EditValue = $this->DomesticFlag->options(FALSE);

		// LoadFlag
		$this->LoadFlag->EditCustomAttributes = "";
		$this->LoadFlag->EditValue = $this->LoadFlag->options(FALSE);

		// AutoLoadFlag
		$this->AutoLoadFlag->EditCustomAttributes = "";
		$this->AutoLoadFlag->EditValue = $this->AutoLoadFlag->options(FALSE);

		// ActiveFlag
		$this->ActiveFlag->EditCustomAttributes = "";
		$this->ActiveFlag->EditValue = $this->ActiveFlag->options(FALSE);

		// GradeType_Idn
		$this->GradeType_Idn->EditAttrs["class"] = "form-control";
		$this->GradeType_Idn->EditCustomAttributes = "";

		// PressureType_Idn
		$this->PressureType_Idn->EditAttrs["class"] = "form-control";
		$this->PressureType_Idn->EditCustomAttributes = "";

		// SeamlessFlag
		$this->SeamlessFlag->EditCustomAttributes = "";
		$this->SeamlessFlag->EditValue = $this->SeamlessFlag->options(FALSE);

		// ResponseType
		$this->ResponseType->EditCustomAttributes = "";
		$this->ResponseType->EditValue = $this->ResponseType->options(FALSE);

		// FMJobFlag
		$this->FMJobFlag->EditCustomAttributes = "";
		$this->FMJobFlag->EditValue = $this->FMJobFlag->options(FALSE);

		// RecommendedBoxes
		$this->RecommendedBoxes->EditAttrs["class"] = "form-control";
		$this->RecommendedBoxes->EditCustomAttributes = "";
		$this->RecommendedBoxes->EditValue = $this->RecommendedBoxes->CurrentValue;
		$this->RecommendedBoxes->PlaceHolder = RemoveHtml($this->RecommendedBoxes->caption());

		// RecommendedWireFootage
		$this->RecommendedWireFootage->EditAttrs["class"] = "form-control";
		$this->RecommendedWireFootage->EditCustomAttributes = "";
		$this->RecommendedWireFootage->EditValue = $this->RecommendedWireFootage->CurrentValue;
		$this->RecommendedWireFootage->PlaceHolder = RemoveHtml($this->RecommendedWireFootage->caption());

		// CoverageType_Idn
		$this->CoverageType_Idn->EditAttrs["class"] = "form-control";
		$this->CoverageType_Idn->EditCustomAttributes = "";

		// HeadType_Idn
		$this->HeadType_Idn->EditAttrs["class"] = "form-control";
		$this->HeadType_Idn->EditCustomAttributes = "";

		// FinishType_Idn
		$this->FinishType_Idn->EditAttrs["class"] = "form-control";
		$this->FinishType_Idn->EditCustomAttributes = "";

		// Outlet_Idn
		$this->Outlet_Idn->EditAttrs["class"] = "form-control";
		$this->Outlet_Idn->EditCustomAttributes = "";

		// RiserType_Idn
		$this->RiserType_Idn->EditAttrs["class"] = "form-control";
		$this->RiserType_Idn->EditCustomAttributes = "";

		// BackFlowType_Idn
		$this->BackFlowType_Idn->EditAttrs["class"] = "form-control";
		$this->BackFlowType_Idn->EditCustomAttributes = "";

		// ControlValve_Idn
		$this->ControlValve_Idn->EditAttrs["class"] = "form-control";
		$this->ControlValve_Idn->EditCustomAttributes = "";

		// CheckValve_Idn
		$this->CheckValve_Idn->EditAttrs["class"] = "form-control";
		$this->CheckValve_Idn->EditCustomAttributes = "";

		// FDCType_Idn
		$this->FDCType_Idn->EditAttrs["class"] = "form-control";
		$this->FDCType_Idn->EditCustomAttributes = "";

		// BellType_Idn
		$this->BellType_Idn->EditAttrs["class"] = "form-control";
		$this->BellType_Idn->EditCustomAttributes = "";

		// TappingTee_Idn
		$this->TappingTee_Idn->EditAttrs["class"] = "form-control";
		$this->TappingTee_Idn->EditCustomAttributes = "";

		// UndergroundValve_Idn
		$this->UndergroundValve_Idn->EditAttrs["class"] = "form-control";
		$this->UndergroundValve_Idn->EditCustomAttributes = "";

		// LiftDuration_Idn
		$this->LiftDuration_Idn->EditAttrs["class"] = "form-control";
		$this->LiftDuration_Idn->EditCustomAttributes = "";

		// TrimPackageFlag
		$this->TrimPackageFlag->EditCustomAttributes = "";
		$this->TrimPackageFlag->EditValue = $this->TrimPackageFlag->options(FALSE);

		// ListedFlag
		$this->ListedFlag->EditCustomAttributes = "";
		$this->ListedFlag->EditValue = $this->ListedFlag->options(FALSE);

		// BoxWireLength
		$this->BoxWireLength->EditAttrs["class"] = "form-control";
		$this->BoxWireLength->EditCustomAttributes = "";
		$this->BoxWireLength->EditValue = $this->BoxWireLength->CurrentValue;
		$this->BoxWireLength->PlaceHolder = RemoveHtml($this->BoxWireLength->caption());

		// IsFirePump
		$this->IsFirePump->EditCustomAttributes = "";
		$this->IsFirePump->EditValue = $this->IsFirePump->options(FALSE);

		// FirePumpType_Idn
		$this->FirePumpType_Idn->EditAttrs["class"] = "form-control";
		$this->FirePumpType_Idn->EditCustomAttributes = "";

		// FirePumpAttribute_Idn
		$this->FirePumpAttribute_Idn->EditAttrs["class"] = "form-control";
		$this->FirePumpAttribute_Idn->EditCustomAttributes = "";
		$this->FirePumpAttribute_Idn->EditValue = $this->FirePumpAttribute_Idn->CurrentValue;
		$this->FirePumpAttribute_Idn->PlaceHolder = RemoveHtml($this->FirePumpAttribute_Idn->caption());

		// IsDieselFuel
		$this->IsDieselFuel->EditCustomAttributes = "";
		$this->IsDieselFuel->EditValue = $this->IsDieselFuel->options(FALSE);

		// IsSolution
		$this->IsSolution->EditCustomAttributes = "";
		$this->IsSolution->EditValue = $this->IsSolution->options(FALSE);

		// Position_Idn
		$this->Position_Idn->EditAttrs["class"] = "form-control";
		$this->Position_Idn->EditCustomAttributes = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->Product_Idn);
					$doc->exportCaption($this->Department_Idn);
					$doc->exportCaption($this->WorksheetMaster_Idn);
					$doc->exportCaption($this->WorksheetCategory_Idn);
					$doc->exportCaption($this->Manufacturer_Idn);
					$doc->exportCaption($this->Rank);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->MaterialUnitPrice);
					$doc->exportCaption($this->FieldUnitPrice);
					$doc->exportCaption($this->ShopUnitPrice);
					$doc->exportCaption($this->EngineerUnitPrice);
					$doc->exportCaption($this->DefaultQuantity);
					$doc->exportCaption($this->ProductSize_Idn);
					$doc->exportCaption($this->Description);
					$doc->exportCaption($this->PipeType_Idn);
					$doc->exportCaption($this->ScheduleType_Idn);
					$doc->exportCaption($this->Fitting_Idn);
					$doc->exportCaption($this->GroovedFittingType_Idn);
					$doc->exportCaption($this->ThreadedFittingType_Idn);
					$doc->exportCaption($this->HangerType_Idn);
					$doc->exportCaption($this->HangerSubType_Idn);
					$doc->exportCaption($this->SubcontractCategory_Idn);
					$doc->exportCaption($this->ApplyToAdjustmentFactorsFlag);
					$doc->exportCaption($this->ApplyToContingencyFlag);
					$doc->exportCaption($this->IsMainComponent);
					$doc->exportCaption($this->DomesticFlag);
					$doc->exportCaption($this->LoadFlag);
					$doc->exportCaption($this->AutoLoadFlag);
					$doc->exportCaption($this->ActiveFlag);
					$doc->exportCaption($this->GradeType_Idn);
					$doc->exportCaption($this->PressureType_Idn);
					$doc->exportCaption($this->SeamlessFlag);
					$doc->exportCaption($this->ResponseType);
					$doc->exportCaption($this->FMJobFlag);
					$doc->exportCaption($this->RecommendedBoxes);
					$doc->exportCaption($this->RecommendedWireFootage);
					$doc->exportCaption($this->CoverageType_Idn);
					$doc->exportCaption($this->HeadType_Idn);
					$doc->exportCaption($this->FinishType_Idn);
					$doc->exportCaption($this->Outlet_Idn);
					$doc->exportCaption($this->RiserType_Idn);
					$doc->exportCaption($this->BackFlowType_Idn);
					$doc->exportCaption($this->ControlValve_Idn);
					$doc->exportCaption($this->CheckValve_Idn);
					$doc->exportCaption($this->FDCType_Idn);
					$doc->exportCaption($this->BellType_Idn);
					$doc->exportCaption($this->TappingTee_Idn);
					$doc->exportCaption($this->UndergroundValve_Idn);
					$doc->exportCaption($this->LiftDuration_Idn);
					$doc->exportCaption($this->TrimPackageFlag);
					$doc->exportCaption($this->ListedFlag);
					$doc->exportCaption($this->BoxWireLength);
					$doc->exportCaption($this->IsFirePump);
					$doc->exportCaption($this->FirePumpType_Idn);
					$doc->exportCaption($this->FirePumpAttribute_Idn);
					$doc->exportCaption($this->IsDieselFuel);
					$doc->exportCaption($this->IsSolution);
					$doc->exportCaption($this->Position_Idn);
				} else {
					$doc->exportCaption($this->Product_Idn);
					$doc->exportCaption($this->Department_Idn);
					$doc->exportCaption($this->WorksheetMaster_Idn);
					$doc->exportCaption($this->WorksheetCategory_Idn);
					$doc->exportCaption($this->Manufacturer_Idn);
					$doc->exportCaption($this->Rank);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->MaterialUnitPrice);
					$doc->exportCaption($this->FieldUnitPrice);
					$doc->exportCaption($this->ShopUnitPrice);
					$doc->exportCaption($this->EngineerUnitPrice);
					$doc->exportCaption($this->DefaultQuantity);
					$doc->exportCaption($this->ProductSize_Idn);
					$doc->exportCaption($this->PipeType_Idn);
					$doc->exportCaption($this->ScheduleType_Idn);
					$doc->exportCaption($this->Fitting_Idn);
					$doc->exportCaption($this->GroovedFittingType_Idn);
					$doc->exportCaption($this->ThreadedFittingType_Idn);
					$doc->exportCaption($this->HangerType_Idn);
					$doc->exportCaption($this->HangerSubType_Idn);
					$doc->exportCaption($this->SubcontractCategory_Idn);
					$doc->exportCaption($this->ApplyToAdjustmentFactorsFlag);
					$doc->exportCaption($this->ApplyToContingencyFlag);
					$doc->exportCaption($this->IsMainComponent);
					$doc->exportCaption($this->DomesticFlag);
					$doc->exportCaption($this->LoadFlag);
					$doc->exportCaption($this->AutoLoadFlag);
					$doc->exportCaption($this->ActiveFlag);
					$doc->exportCaption($this->GradeType_Idn);
					$doc->exportCaption($this->PressureType_Idn);
					$doc->exportCaption($this->SeamlessFlag);
					$doc->exportCaption($this->ResponseType);
					$doc->exportCaption($this->FMJobFlag);
					$doc->exportCaption($this->RecommendedBoxes);
					$doc->exportCaption($this->RecommendedWireFootage);
					$doc->exportCaption($this->CoverageType_Idn);
					$doc->exportCaption($this->HeadType_Idn);
					$doc->exportCaption($this->FinishType_Idn);
					$doc->exportCaption($this->Outlet_Idn);
					$doc->exportCaption($this->RiserType_Idn);
					$doc->exportCaption($this->BackFlowType_Idn);
					$doc->exportCaption($this->ControlValve_Idn);
					$doc->exportCaption($this->CheckValve_Idn);
					$doc->exportCaption($this->FDCType_Idn);
					$doc->exportCaption($this->BellType_Idn);
					$doc->exportCaption($this->TappingTee_Idn);
					$doc->exportCaption($this->UndergroundValve_Idn);
					$doc->exportCaption($this->LiftDuration_Idn);
					$doc->exportCaption($this->TrimPackageFlag);
					$doc->exportCaption($this->ListedFlag);
					$doc->exportCaption($this->BoxWireLength);
					$doc->exportCaption($this->IsFirePump);
					$doc->exportCaption($this->FirePumpType_Idn);
					$doc->exportCaption($this->FirePumpAttribute_Idn);
					$doc->exportCaption($this->IsDieselFuel);
					$doc->exportCaption($this->IsSolution);
					$doc->exportCaption($this->Position_Idn);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->Product_Idn);
						$doc->exportField($this->Department_Idn);
						$doc->exportField($this->WorksheetMaster_Idn);
						$doc->exportField($this->WorksheetCategory_Idn);
						$doc->exportField($this->Manufacturer_Idn);
						$doc->exportField($this->Rank);
						$doc->exportField($this->Name);
						$doc->exportField($this->MaterialUnitPrice);
						$doc->exportField($this->FieldUnitPrice);
						$doc->exportField($this->ShopUnitPrice);
						$doc->exportField($this->EngineerUnitPrice);
						$doc->exportField($this->DefaultQuantity);
						$doc->exportField($this->ProductSize_Idn);
						$doc->exportField($this->Description);
						$doc->exportField($this->PipeType_Idn);
						$doc->exportField($this->ScheduleType_Idn);
						$doc->exportField($this->Fitting_Idn);
						$doc->exportField($this->GroovedFittingType_Idn);
						$doc->exportField($this->ThreadedFittingType_Idn);
						$doc->exportField($this->HangerType_Idn);
						$doc->exportField($this->HangerSubType_Idn);
						$doc->exportField($this->SubcontractCategory_Idn);
						$doc->exportField($this->ApplyToAdjustmentFactorsFlag);
						$doc->exportField($this->ApplyToContingencyFlag);
						$doc->exportField($this->IsMainComponent);
						$doc->exportField($this->DomesticFlag);
						$doc->exportField($this->LoadFlag);
						$doc->exportField($this->AutoLoadFlag);
						$doc->exportField($this->ActiveFlag);
						$doc->exportField($this->GradeType_Idn);
						$doc->exportField($this->PressureType_Idn);
						$doc->exportField($this->SeamlessFlag);
						$doc->exportField($this->ResponseType);
						$doc->exportField($this->FMJobFlag);
						$doc->exportField($this->RecommendedBoxes);
						$doc->exportField($this->RecommendedWireFootage);
						$doc->exportField($this->CoverageType_Idn);
						$doc->exportField($this->HeadType_Idn);
						$doc->exportField($this->FinishType_Idn);
						$doc->exportField($this->Outlet_Idn);
						$doc->exportField($this->RiserType_Idn);
						$doc->exportField($this->BackFlowType_Idn);
						$doc->exportField($this->ControlValve_Idn);
						$doc->exportField($this->CheckValve_Idn);
						$doc->exportField($this->FDCType_Idn);
						$doc->exportField($this->BellType_Idn);
						$doc->exportField($this->TappingTee_Idn);
						$doc->exportField($this->UndergroundValve_Idn);
						$doc->exportField($this->LiftDuration_Idn);
						$doc->exportField($this->TrimPackageFlag);
						$doc->exportField($this->ListedFlag);
						$doc->exportField($this->BoxWireLength);
						$doc->exportField($this->IsFirePump);
						$doc->exportField($this->FirePumpType_Idn);
						$doc->exportField($this->FirePumpAttribute_Idn);
						$doc->exportField($this->IsDieselFuel);
						$doc->exportField($this->IsSolution);
						$doc->exportField($this->Position_Idn);
					} else {
						$doc->exportField($this->Product_Idn);
						$doc->exportField($this->Department_Idn);
						$doc->exportField($this->WorksheetMaster_Idn);
						$doc->exportField($this->WorksheetCategory_Idn);
						$doc->exportField($this->Manufacturer_Idn);
						$doc->exportField($this->Rank);
						$doc->exportField($this->Name);
						$doc->exportField($this->MaterialUnitPrice);
						$doc->exportField($this->FieldUnitPrice);
						$doc->exportField($this->ShopUnitPrice);
						$doc->exportField($this->EngineerUnitPrice);
						$doc->exportField($this->DefaultQuantity);
						$doc->exportField($this->ProductSize_Idn);
						$doc->exportField($this->PipeType_Idn);
						$doc->exportField($this->ScheduleType_Idn);
						$doc->exportField($this->Fitting_Idn);
						$doc->exportField($this->GroovedFittingType_Idn);
						$doc->exportField($this->ThreadedFittingType_Idn);
						$doc->exportField($this->HangerType_Idn);
						$doc->exportField($this->HangerSubType_Idn);
						$doc->exportField($this->SubcontractCategory_Idn);
						$doc->exportField($this->ApplyToAdjustmentFactorsFlag);
						$doc->exportField($this->ApplyToContingencyFlag);
						$doc->exportField($this->IsMainComponent);
						$doc->exportField($this->DomesticFlag);
						$doc->exportField($this->LoadFlag);
						$doc->exportField($this->AutoLoadFlag);
						$doc->exportField($this->ActiveFlag);
						$doc->exportField($this->GradeType_Idn);
						$doc->exportField($this->PressureType_Idn);
						$doc->exportField($this->SeamlessFlag);
						$doc->exportField($this->ResponseType);
						$doc->exportField($this->FMJobFlag);
						$doc->exportField($this->RecommendedBoxes);
						$doc->exportField($this->RecommendedWireFootage);
						$doc->exportField($this->CoverageType_Idn);
						$doc->exportField($this->HeadType_Idn);
						$doc->exportField($this->FinishType_Idn);
						$doc->exportField($this->Outlet_Idn);
						$doc->exportField($this->RiserType_Idn);
						$doc->exportField($this->BackFlowType_Idn);
						$doc->exportField($this->ControlValve_Idn);
						$doc->exportField($this->CheckValve_Idn);
						$doc->exportField($this->FDCType_Idn);
						$doc->exportField($this->BellType_Idn);
						$doc->exportField($this->TappingTee_Idn);
						$doc->exportField($this->UndergroundValve_Idn);
						$doc->exportField($this->LiftDuration_Idn);
						$doc->exportField($this->TrimPackageFlag);
						$doc->exportField($this->ListedFlag);
						$doc->exportField($this->BoxWireLength);
						$doc->exportField($this->IsFirePump);
						$doc->exportField($this->FirePumpType_Idn);
						$doc->exportField($this->FirePumpAttribute_Idn);
						$doc->exportField($this->IsDieselFuel);
						$doc->exportField($this->IsSolution);
						$doc->exportField($this->Position_Idn);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>