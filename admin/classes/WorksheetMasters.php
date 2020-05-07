<?php namespace PHPMaker2020\feapps51; ?>
<?php

/**
 * Table class for WorksheetMasters
 */
class WorksheetMasters extends DbTable
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
	public $WorksheetMaster_Idn;
	public $Name;
	public $Department_Idn;
	public $Rank;
	public $NumberOfColumns;
	public $AllowMultiple;
	public $DisplayAdjustmentFactors;
	public $DisplayWorksheetDetails;
	public $DisplayShopFabrication;
	public $DisplayWorksheetName;
	public $DisplayWorksheetHeader;
	public $UseRadioButtonsForSizes;
	public $DisplayFieldHoursOverride;
	public $DisplayShopHours;
	public $DisplayShopHoursOverride;
	public $DisplayUserShopHoursOnly;
	public $DisplayPipeExposure;
	public $DisplayVolumeCorrection;
	public $DisplayManhourAdjustment;
	public $IsSubcontractWorksheet;
	public $DisplayDeleteItemsButtons;
	public $ActiveFlag;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'WorksheetMasters';
		$this->TableName = 'WorksheetMasters';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[WorksheetMasters]";
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

		// WorksheetMaster_Idn
		$this->WorksheetMaster_Idn = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_WorksheetMaster_Idn', 'WorksheetMaster_Idn', '[WorksheetMaster_Idn]', 'CAST([WorksheetMaster_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[WorksheetMaster_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->WorksheetMaster_Idn->IsAutoIncrement = TRUE; // Autoincrement field
		$this->WorksheetMaster_Idn->IsPrimaryKey = TRUE; // Primary key field
		$this->WorksheetMaster_Idn->IsForeignKey = TRUE; // Foreign key field
		$this->WorksheetMaster_Idn->Nullable = FALSE; // NOT NULL field
		$this->WorksheetMaster_Idn->Sortable = TRUE; // Allow sort
		$this->WorksheetMaster_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['WorksheetMaster_Idn'] = &$this->WorksheetMaster_Idn;

		// Name
		$this->Name = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_Name', 'Name', '[Name]', '[Name]', 200, 100, -1, FALSE, '[Name]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Name->Sortable = TRUE; // Allow sort
		$this->fields['Name'] = &$this->Name;

		// Department_Idn
		$this->Department_Idn = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_Department_Idn', 'Department_Idn', '[Department_Idn]', 'CAST([Department_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[Department_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Department_Idn->Required = TRUE; // Required field
		$this->Department_Idn->Sortable = TRUE; // Allow sort
		$this->Department_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Department_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Department_Idn->Lookup = new Lookup('Department_Idn', 'jpr_Department', FALSE, 'DepartmentId', ["Description","","",""], [], [], [], [], [], [], '[Description] ASC', '');
		$this->Department_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Department_Idn'] = &$this->Department_Idn;

		// Rank
		$this->Rank = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_Rank', 'Rank', '[Rank]', 'CAST([Rank] AS NVARCHAR)', 3, 4, -1, FALSE, '[Rank]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Rank->Sortable = TRUE; // Allow sort
		$this->Rank->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Rank'] = &$this->Rank;

		// NumberOfColumns
		$this->NumberOfColumns = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_NumberOfColumns', 'NumberOfColumns', '[NumberOfColumns]', 'CAST([NumberOfColumns] AS NVARCHAR)', 3, 4, -1, FALSE, '[NumberOfColumns]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NumberOfColumns->Sortable = TRUE; // Allow sort
		$this->NumberOfColumns->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['NumberOfColumns'] = &$this->NumberOfColumns;

		// AllowMultiple
		$this->AllowMultiple = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_AllowMultiple', 'AllowMultiple', '[AllowMultiple]', '[AllowMultiple]', 11, 2, -1, FALSE, '[AllowMultiple]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->AllowMultiple->Sortable = TRUE; // Allow sort
		$this->AllowMultiple->DataType = DATATYPE_BOOLEAN;
		$this->AllowMultiple->Lookup = new Lookup('AllowMultiple', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->AllowMultiple->OptionCount = 2;
		$this->fields['AllowMultiple'] = &$this->AllowMultiple;

		// DisplayAdjustmentFactors
		$this->DisplayAdjustmentFactors = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayAdjustmentFactors', 'DisplayAdjustmentFactors', '[DisplayAdjustmentFactors]', '[DisplayAdjustmentFactors]', 11, 2, -1, FALSE, '[DisplayAdjustmentFactors]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayAdjustmentFactors->Sortable = TRUE; // Allow sort
		$this->DisplayAdjustmentFactors->DataType = DATATYPE_BOOLEAN;
		$this->DisplayAdjustmentFactors->Lookup = new Lookup('DisplayAdjustmentFactors', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayAdjustmentFactors->OptionCount = 2;
		$this->fields['DisplayAdjustmentFactors'] = &$this->DisplayAdjustmentFactors;

		// DisplayWorksheetDetails
		$this->DisplayWorksheetDetails = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayWorksheetDetails', 'DisplayWorksheetDetails', '[DisplayWorksheetDetails]', '[DisplayWorksheetDetails]', 11, 2, -1, FALSE, '[DisplayWorksheetDetails]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayWorksheetDetails->Sortable = TRUE; // Allow sort
		$this->DisplayWorksheetDetails->DataType = DATATYPE_BOOLEAN;
		$this->DisplayWorksheetDetails->Lookup = new Lookup('DisplayWorksheetDetails', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayWorksheetDetails->OptionCount = 2;
		$this->fields['DisplayWorksheetDetails'] = &$this->DisplayWorksheetDetails;

		// DisplayShopFabrication
		$this->DisplayShopFabrication = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayShopFabrication', 'DisplayShopFabrication', '[DisplayShopFabrication]', '[DisplayShopFabrication]', 11, 2, -1, FALSE, '[DisplayShopFabrication]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayShopFabrication->Sortable = TRUE; // Allow sort
		$this->DisplayShopFabrication->DataType = DATATYPE_BOOLEAN;
		$this->DisplayShopFabrication->Lookup = new Lookup('DisplayShopFabrication', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayShopFabrication->OptionCount = 2;
		$this->fields['DisplayShopFabrication'] = &$this->DisplayShopFabrication;

		// DisplayWorksheetName
		$this->DisplayWorksheetName = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayWorksheetName', 'DisplayWorksheetName', '[DisplayWorksheetName]', '[DisplayWorksheetName]', 11, 2, -1, FALSE, '[DisplayWorksheetName]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayWorksheetName->Sortable = TRUE; // Allow sort
		$this->DisplayWorksheetName->DataType = DATATYPE_BOOLEAN;
		$this->DisplayWorksheetName->Lookup = new Lookup('DisplayWorksheetName', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayWorksheetName->OptionCount = 2;
		$this->fields['DisplayWorksheetName'] = &$this->DisplayWorksheetName;

		// DisplayWorksheetHeader
		$this->DisplayWorksheetHeader = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayWorksheetHeader', 'DisplayWorksheetHeader', '[DisplayWorksheetHeader]', '[DisplayWorksheetHeader]', 11, 2, -1, FALSE, '[DisplayWorksheetHeader]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayWorksheetHeader->Sortable = TRUE; // Allow sort
		$this->DisplayWorksheetHeader->DataType = DATATYPE_BOOLEAN;
		$this->DisplayWorksheetHeader->Lookup = new Lookup('DisplayWorksheetHeader', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayWorksheetHeader->OptionCount = 2;
		$this->fields['DisplayWorksheetHeader'] = &$this->DisplayWorksheetHeader;

		// UseRadioButtonsForSizes
		$this->UseRadioButtonsForSizes = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_UseRadioButtonsForSizes', 'UseRadioButtonsForSizes', '[UseRadioButtonsForSizes]', '[UseRadioButtonsForSizes]', 11, 2, -1, FALSE, '[UseRadioButtonsForSizes]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->UseRadioButtonsForSizes->Sortable = TRUE; // Allow sort
		$this->UseRadioButtonsForSizes->DataType = DATATYPE_BOOLEAN;
		$this->UseRadioButtonsForSizes->Lookup = new Lookup('UseRadioButtonsForSizes', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->UseRadioButtonsForSizes->OptionCount = 2;
		$this->fields['UseRadioButtonsForSizes'] = &$this->UseRadioButtonsForSizes;

		// DisplayFieldHoursOverride
		$this->DisplayFieldHoursOverride = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayFieldHoursOverride', 'DisplayFieldHoursOverride', '[DisplayFieldHoursOverride]', '[DisplayFieldHoursOverride]', 11, 2, -1, FALSE, '[DisplayFieldHoursOverride]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayFieldHoursOverride->Sortable = TRUE; // Allow sort
		$this->DisplayFieldHoursOverride->DataType = DATATYPE_BOOLEAN;
		$this->DisplayFieldHoursOverride->Lookup = new Lookup('DisplayFieldHoursOverride', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayFieldHoursOverride->OptionCount = 2;
		$this->fields['DisplayFieldHoursOverride'] = &$this->DisplayFieldHoursOverride;

		// DisplayShopHours
		$this->DisplayShopHours = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayShopHours', 'DisplayShopHours', '[DisplayShopHours]', '[DisplayShopHours]', 11, 2, -1, FALSE, '[DisplayShopHours]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayShopHours->Sortable = TRUE; // Allow sort
		$this->DisplayShopHours->DataType = DATATYPE_BOOLEAN;
		$this->DisplayShopHours->Lookup = new Lookup('DisplayShopHours', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayShopHours->OptionCount = 2;
		$this->fields['DisplayShopHours'] = &$this->DisplayShopHours;

		// DisplayShopHoursOverride
		$this->DisplayShopHoursOverride = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayShopHoursOverride', 'DisplayShopHoursOverride', '[DisplayShopHoursOverride]', '[DisplayShopHoursOverride]', 11, 2, -1, FALSE, '[DisplayShopHoursOverride]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayShopHoursOverride->Sortable = TRUE; // Allow sort
		$this->DisplayShopHoursOverride->DataType = DATATYPE_BOOLEAN;
		$this->DisplayShopHoursOverride->Lookup = new Lookup('DisplayShopHoursOverride', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayShopHoursOverride->OptionCount = 2;
		$this->fields['DisplayShopHoursOverride'] = &$this->DisplayShopHoursOverride;

		// DisplayUserShopHoursOnly
		$this->DisplayUserShopHoursOnly = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayUserShopHoursOnly', 'DisplayUserShopHoursOnly', '[DisplayUserShopHoursOnly]', '[DisplayUserShopHoursOnly]', 11, 2, -1, FALSE, '[DisplayUserShopHoursOnly]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayUserShopHoursOnly->Sortable = TRUE; // Allow sort
		$this->DisplayUserShopHoursOnly->DataType = DATATYPE_BOOLEAN;
		$this->DisplayUserShopHoursOnly->Lookup = new Lookup('DisplayUserShopHoursOnly', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayUserShopHoursOnly->OptionCount = 2;
		$this->fields['DisplayUserShopHoursOnly'] = &$this->DisplayUserShopHoursOnly;

		// DisplayPipeExposure
		$this->DisplayPipeExposure = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayPipeExposure', 'DisplayPipeExposure', '[DisplayPipeExposure]', '[DisplayPipeExposure]', 11, 2, -1, FALSE, '[DisplayPipeExposure]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayPipeExposure->Sortable = TRUE; // Allow sort
		$this->DisplayPipeExposure->DataType = DATATYPE_BOOLEAN;
		$this->DisplayPipeExposure->Lookup = new Lookup('DisplayPipeExposure', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayPipeExposure->OptionCount = 2;
		$this->fields['DisplayPipeExposure'] = &$this->DisplayPipeExposure;

		// DisplayVolumeCorrection
		$this->DisplayVolumeCorrection = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayVolumeCorrection', 'DisplayVolumeCorrection', '[DisplayVolumeCorrection]', '[DisplayVolumeCorrection]', 11, 2, -1, FALSE, '[DisplayVolumeCorrection]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayVolumeCorrection->Sortable = TRUE; // Allow sort
		$this->DisplayVolumeCorrection->DataType = DATATYPE_BOOLEAN;
		$this->DisplayVolumeCorrection->Lookup = new Lookup('DisplayVolumeCorrection', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayVolumeCorrection->OptionCount = 2;
		$this->fields['DisplayVolumeCorrection'] = &$this->DisplayVolumeCorrection;

		// DisplayManhourAdjustment
		$this->DisplayManhourAdjustment = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayManhourAdjustment', 'DisplayManhourAdjustment', '[DisplayManhourAdjustment]', '[DisplayManhourAdjustment]', 11, 2, -1, FALSE, '[DisplayManhourAdjustment]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayManhourAdjustment->Sortable = TRUE; // Allow sort
		$this->DisplayManhourAdjustment->DataType = DATATYPE_BOOLEAN;
		$this->DisplayManhourAdjustment->Lookup = new Lookup('DisplayManhourAdjustment', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayManhourAdjustment->OptionCount = 2;
		$this->fields['DisplayManhourAdjustment'] = &$this->DisplayManhourAdjustment;

		// IsSubcontractWorksheet
		$this->IsSubcontractWorksheet = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_IsSubcontractWorksheet', 'IsSubcontractWorksheet', '[IsSubcontractWorksheet]', '[IsSubcontractWorksheet]', 11, 2, -1, FALSE, '[IsSubcontractWorksheet]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->IsSubcontractWorksheet->Sortable = TRUE; // Allow sort
		$this->IsSubcontractWorksheet->DataType = DATATYPE_BOOLEAN;
		$this->IsSubcontractWorksheet->Lookup = new Lookup('IsSubcontractWorksheet', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->IsSubcontractWorksheet->OptionCount = 2;
		$this->fields['IsSubcontractWorksheet'] = &$this->IsSubcontractWorksheet;

		// DisplayDeleteItemsButtons
		$this->DisplayDeleteItemsButtons = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_DisplayDeleteItemsButtons', 'DisplayDeleteItemsButtons', '[DisplayDeleteItemsButtons]', '[DisplayDeleteItemsButtons]', 11, 2, -1, FALSE, '[DisplayDeleteItemsButtons]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->DisplayDeleteItemsButtons->Sortable = TRUE; // Allow sort
		$this->DisplayDeleteItemsButtons->DataType = DATATYPE_BOOLEAN;
		$this->DisplayDeleteItemsButtons->Lookup = new Lookup('DisplayDeleteItemsButtons', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->DisplayDeleteItemsButtons->OptionCount = 2;
		$this->fields['DisplayDeleteItemsButtons'] = &$this->DisplayDeleteItemsButtons;

		// ActiveFlag
		$this->ActiveFlag = new DbField('WorksheetMasters', 'WorksheetMasters', 'x_ActiveFlag', 'ActiveFlag', '[ActiveFlag]', '[ActiveFlag]', 11, 2, -1, FALSE, '[ActiveFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ActiveFlag->Sortable = TRUE; // Allow sort
		$this->ActiveFlag->DataType = DATATYPE_BOOLEAN;
		$this->ActiveFlag->Lookup = new Lookup('ActiveFlag', 'WorksheetMasters', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ActiveFlag->OptionCount = 2;
		$this->fields['ActiveFlag'] = &$this->ActiveFlag;
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

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "WorksheetMasterCategories") {
			$detailUrl = $GLOBALS["WorksheetMasterCategories"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_WorksheetMaster_Idn=" . urlencode($this->WorksheetMaster_Idn->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "WorksheetMasterSizes") {
			$detailUrl = $GLOBALS["WorksheetMasterSizes"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_WorksheetMaster_Idn=" . urlencode($this->WorksheetMaster_Idn->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "WorksheetMasterslist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[WorksheetMasters]";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "[Department_Idn] ASC,[Rank] ASC";
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
			$this->WorksheetMaster_Idn->setDbValue($conn->insert_ID());
			$rs['WorksheetMaster_Idn'] = $this->WorksheetMaster_Idn->DbValue;
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

		// Cascade Update detail table 'WorksheetMasterCategories'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['WorksheetMaster_Idn']) && $rsold['WorksheetMaster_Idn'] != $rs['WorksheetMaster_Idn'])) { // Update detail field 'WorksheetMaster_Idn'
			$cascadeUpdate = TRUE;
			$rscascade['WorksheetMaster_Idn'] = $rs['WorksheetMaster_Idn'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["WorksheetMasterCategories"]))
				$GLOBALS["WorksheetMasterCategories"] = new WorksheetMasterCategories();
			$rswrk = $GLOBALS["WorksheetMasterCategories"]->loadRs("[WorksheetMaster_Idn] = " . QuotedValue($rsold['WorksheetMaster_Idn'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'WorksheetMaster_Idn';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$fldname = 'WorksheetCategory_Idn';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["WorksheetMasterCategories"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["WorksheetMasterCategories"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["WorksheetMasterCategories"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
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
			if (array_key_exists('WorksheetMaster_Idn', $rs))
				AddFilter($where, QuotedName('WorksheetMaster_Idn', $this->Dbid) . '=' . QuotedValue($rs['WorksheetMaster_Idn'], $this->WorksheetMaster_Idn->DataType, $this->Dbid));
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

		// Cascade delete detail table 'WorksheetMasterCategories'
		if (!isset($GLOBALS["WorksheetMasterCategories"]))
			$GLOBALS["WorksheetMasterCategories"] = new WorksheetMasterCategories();
		$rscascade = $GLOBALS["WorksheetMasterCategories"]->loadRs("[WorksheetMaster_Idn] = " . QuotedValue($rs['WorksheetMaster_Idn'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["WorksheetMasterCategories"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["WorksheetMasterCategories"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["WorksheetMasterCategories"]->Row_Deleted($dtlrow);
		}
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
		$this->WorksheetMaster_Idn->DbValue = $row['WorksheetMaster_Idn'];
		$this->Name->DbValue = $row['Name'];
		$this->Department_Idn->DbValue = $row['Department_Idn'];
		$this->Rank->DbValue = $row['Rank'];
		$this->NumberOfColumns->DbValue = $row['NumberOfColumns'];
		$this->AllowMultiple->DbValue = (ConvertToBool($row['AllowMultiple']) ? "1" : "0");
		$this->DisplayAdjustmentFactors->DbValue = (ConvertToBool($row['DisplayAdjustmentFactors']) ? "1" : "0");
		$this->DisplayWorksheetDetails->DbValue = (ConvertToBool($row['DisplayWorksheetDetails']) ? "1" : "0");
		$this->DisplayShopFabrication->DbValue = (ConvertToBool($row['DisplayShopFabrication']) ? "1" : "0");
		$this->DisplayWorksheetName->DbValue = (ConvertToBool($row['DisplayWorksheetName']) ? "1" : "0");
		$this->DisplayWorksheetHeader->DbValue = (ConvertToBool($row['DisplayWorksheetHeader']) ? "1" : "0");
		$this->UseRadioButtonsForSizes->DbValue = (ConvertToBool($row['UseRadioButtonsForSizes']) ? "1" : "0");
		$this->DisplayFieldHoursOverride->DbValue = (ConvertToBool($row['DisplayFieldHoursOverride']) ? "1" : "0");
		$this->DisplayShopHours->DbValue = (ConvertToBool($row['DisplayShopHours']) ? "1" : "0");
		$this->DisplayShopHoursOverride->DbValue = (ConvertToBool($row['DisplayShopHoursOverride']) ? "1" : "0");
		$this->DisplayUserShopHoursOnly->DbValue = (ConvertToBool($row['DisplayUserShopHoursOnly']) ? "1" : "0");
		$this->DisplayPipeExposure->DbValue = (ConvertToBool($row['DisplayPipeExposure']) ? "1" : "0");
		$this->DisplayVolumeCorrection->DbValue = (ConvertToBool($row['DisplayVolumeCorrection']) ? "1" : "0");
		$this->DisplayManhourAdjustment->DbValue = (ConvertToBool($row['DisplayManhourAdjustment']) ? "1" : "0");
		$this->IsSubcontractWorksheet->DbValue = (ConvertToBool($row['IsSubcontractWorksheet']) ? "1" : "0");
		$this->DisplayDeleteItemsButtons->DbValue = (ConvertToBool($row['DisplayDeleteItemsButtons']) ? "1" : "0");
		$this->ActiveFlag->DbValue = (ConvertToBool($row['ActiveFlag']) ? "1" : "0");
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "[WorksheetMaster_Idn] = @WorksheetMaster_Idn@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('WorksheetMaster_Idn', $row) ? $row['WorksheetMaster_Idn'] : NULL;
		else
			$val = $this->WorksheetMaster_Idn->OldValue !== NULL ? $this->WorksheetMaster_Idn->OldValue : $this->WorksheetMaster_Idn->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@WorksheetMaster_Idn@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "WorksheetMasterslist.php";
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
		if ($pageName == "WorksheetMastersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "WorksheetMastersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "WorksheetMastersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "WorksheetMasterslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("WorksheetMastersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("WorksheetMastersview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "WorksheetMastersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "WorksheetMastersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("WorksheetMastersedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("WorksheetMastersedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		if ($parm != "")
			$url = $this->keyUrl("WorksheetMastersadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("WorksheetMastersadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("WorksheetMastersdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "WorksheetMaster_Idn:" . JsonEncode($this->WorksheetMaster_Idn->CurrentValue, "number");
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
		if ($this->WorksheetMaster_Idn->CurrentValue != NULL) {
			$url .= "WorksheetMaster_Idn=" . urlencode($this->WorksheetMaster_Idn->CurrentValue);
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
			if (Param("WorksheetMaster_Idn") !== NULL)
				$arKeys[] = Param("WorksheetMaster_Idn");
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
				$this->WorksheetMaster_Idn->CurrentValue = $key;
			else
				$this->WorksheetMaster_Idn->OldValue = $key;
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
		$this->WorksheetMaster_Idn->setDbValue($rs->fields('WorksheetMaster_Idn'));
		$this->Name->setDbValue($rs->fields('Name'));
		$this->Department_Idn->setDbValue($rs->fields('Department_Idn'));
		$this->Rank->setDbValue($rs->fields('Rank'));
		$this->NumberOfColumns->setDbValue($rs->fields('NumberOfColumns'));
		$this->AllowMultiple->setDbValue(ConvertToBool($rs->fields('AllowMultiple')) ? "1" : "0");
		$this->DisplayAdjustmentFactors->setDbValue(ConvertToBool($rs->fields('DisplayAdjustmentFactors')) ? "1" : "0");
		$this->DisplayWorksheetDetails->setDbValue(ConvertToBool($rs->fields('DisplayWorksheetDetails')) ? "1" : "0");
		$this->DisplayShopFabrication->setDbValue(ConvertToBool($rs->fields('DisplayShopFabrication')) ? "1" : "0");
		$this->DisplayWorksheetName->setDbValue(ConvertToBool($rs->fields('DisplayWorksheetName')) ? "1" : "0");
		$this->DisplayWorksheetHeader->setDbValue(ConvertToBool($rs->fields('DisplayWorksheetHeader')) ? "1" : "0");
		$this->UseRadioButtonsForSizes->setDbValue(ConvertToBool($rs->fields('UseRadioButtonsForSizes')) ? "1" : "0");
		$this->DisplayFieldHoursOverride->setDbValue(ConvertToBool($rs->fields('DisplayFieldHoursOverride')) ? "1" : "0");
		$this->DisplayShopHours->setDbValue(ConvertToBool($rs->fields('DisplayShopHours')) ? "1" : "0");
		$this->DisplayShopHoursOverride->setDbValue(ConvertToBool($rs->fields('DisplayShopHoursOverride')) ? "1" : "0");
		$this->DisplayUserShopHoursOnly->setDbValue(ConvertToBool($rs->fields('DisplayUserShopHoursOnly')) ? "1" : "0");
		$this->DisplayPipeExposure->setDbValue(ConvertToBool($rs->fields('DisplayPipeExposure')) ? "1" : "0");
		$this->DisplayVolumeCorrection->setDbValue(ConvertToBool($rs->fields('DisplayVolumeCorrection')) ? "1" : "0");
		$this->DisplayManhourAdjustment->setDbValue(ConvertToBool($rs->fields('DisplayManhourAdjustment')) ? "1" : "0");
		$this->IsSubcontractWorksheet->setDbValue(ConvertToBool($rs->fields('IsSubcontractWorksheet')) ? "1" : "0");
		$this->DisplayDeleteItemsButtons->setDbValue(ConvertToBool($rs->fields('DisplayDeleteItemsButtons')) ? "1" : "0");
		$this->ActiveFlag->setDbValue(ConvertToBool($rs->fields('ActiveFlag')) ? "1" : "0");
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// WorksheetMaster_Idn
		// Name
		// Department_Idn
		// Rank
		// NumberOfColumns
		// AllowMultiple
		// DisplayAdjustmentFactors
		// DisplayWorksheetDetails
		// DisplayShopFabrication
		// DisplayWorksheetName
		// DisplayWorksheetHeader
		// UseRadioButtonsForSizes
		// DisplayFieldHoursOverride
		// DisplayShopHours
		// DisplayShopHoursOverride
		// DisplayUserShopHoursOnly
		// DisplayPipeExposure
		// DisplayVolumeCorrection
		// DisplayManhourAdjustment
		// IsSubcontractWorksheet
		// DisplayDeleteItemsButtons
		// ActiveFlag
		// WorksheetMaster_Idn

		$this->WorksheetMaster_Idn->ViewValue = $this->WorksheetMaster_Idn->CurrentValue;
		$this->WorksheetMaster_Idn->ViewCustomAttributes = "";

		// Name
		$this->Name->ViewValue = $this->Name->CurrentValue;
		$this->Name->ViewCustomAttributes = "";

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

		// Rank
		$this->Rank->ViewValue = $this->Rank->CurrentValue;
		$this->Rank->ViewValue = FormatNumber($this->Rank->ViewValue, 0, -2, -2, -2);
		$this->Rank->ViewCustomAttributes = "";

		// NumberOfColumns
		$this->NumberOfColumns->ViewValue = $this->NumberOfColumns->CurrentValue;
		$this->NumberOfColumns->ViewValue = FormatNumber($this->NumberOfColumns->ViewValue, 0, -2, -2, -2);
		$this->NumberOfColumns->ViewCustomAttributes = "";

		// AllowMultiple
		if (ConvertToBool($this->AllowMultiple->CurrentValue)) {
			$this->AllowMultiple->ViewValue = $this->AllowMultiple->tagCaption(1) != "" ? $this->AllowMultiple->tagCaption(1) : "Yes";
		} else {
			$this->AllowMultiple->ViewValue = $this->AllowMultiple->tagCaption(2) != "" ? $this->AllowMultiple->tagCaption(2) : "No";
		}
		$this->AllowMultiple->ViewCustomAttributes = "";

		// DisplayAdjustmentFactors
		if (ConvertToBool($this->DisplayAdjustmentFactors->CurrentValue)) {
			$this->DisplayAdjustmentFactors->ViewValue = $this->DisplayAdjustmentFactors->tagCaption(1) != "" ? $this->DisplayAdjustmentFactors->tagCaption(1) : "Yes";
		} else {
			$this->DisplayAdjustmentFactors->ViewValue = $this->DisplayAdjustmentFactors->tagCaption(2) != "" ? $this->DisplayAdjustmentFactors->tagCaption(2) : "No";
		}
		$this->DisplayAdjustmentFactors->ViewCustomAttributes = "";

		// DisplayWorksheetDetails
		if (ConvertToBool($this->DisplayWorksheetDetails->CurrentValue)) {
			$this->DisplayWorksheetDetails->ViewValue = $this->DisplayWorksheetDetails->tagCaption(1) != "" ? $this->DisplayWorksheetDetails->tagCaption(1) : "Yes";
		} else {
			$this->DisplayWorksheetDetails->ViewValue = $this->DisplayWorksheetDetails->tagCaption(2) != "" ? $this->DisplayWorksheetDetails->tagCaption(2) : "No";
		}
		$this->DisplayWorksheetDetails->ViewCustomAttributes = "";

		// DisplayShopFabrication
		if (ConvertToBool($this->DisplayShopFabrication->CurrentValue)) {
			$this->DisplayShopFabrication->ViewValue = $this->DisplayShopFabrication->tagCaption(1) != "" ? $this->DisplayShopFabrication->tagCaption(1) : "Yes";
		} else {
			$this->DisplayShopFabrication->ViewValue = $this->DisplayShopFabrication->tagCaption(2) != "" ? $this->DisplayShopFabrication->tagCaption(2) : "No";
		}
		$this->DisplayShopFabrication->ViewCustomAttributes = "";

		// DisplayWorksheetName
		if (ConvertToBool($this->DisplayWorksheetName->CurrentValue)) {
			$this->DisplayWorksheetName->ViewValue = $this->DisplayWorksheetName->tagCaption(1) != "" ? $this->DisplayWorksheetName->tagCaption(1) : "Yes";
		} else {
			$this->DisplayWorksheetName->ViewValue = $this->DisplayWorksheetName->tagCaption(2) != "" ? $this->DisplayWorksheetName->tagCaption(2) : "No";
		}
		$this->DisplayWorksheetName->ViewCustomAttributes = "";

		// DisplayWorksheetHeader
		if (ConvertToBool($this->DisplayWorksheetHeader->CurrentValue)) {
			$this->DisplayWorksheetHeader->ViewValue = $this->DisplayWorksheetHeader->tagCaption(1) != "" ? $this->DisplayWorksheetHeader->tagCaption(1) : "Yes";
		} else {
			$this->DisplayWorksheetHeader->ViewValue = $this->DisplayWorksheetHeader->tagCaption(2) != "" ? $this->DisplayWorksheetHeader->tagCaption(2) : "No";
		}
		$this->DisplayWorksheetHeader->ViewCustomAttributes = "";

		// UseRadioButtonsForSizes
		if (ConvertToBool($this->UseRadioButtonsForSizes->CurrentValue)) {
			$this->UseRadioButtonsForSizes->ViewValue = $this->UseRadioButtonsForSizes->tagCaption(1) != "" ? $this->UseRadioButtonsForSizes->tagCaption(1) : "Yes";
		} else {
			$this->UseRadioButtonsForSizes->ViewValue = $this->UseRadioButtonsForSizes->tagCaption(2) != "" ? $this->UseRadioButtonsForSizes->tagCaption(2) : "No";
		}
		$this->UseRadioButtonsForSizes->ViewCustomAttributes = "";

		// DisplayFieldHoursOverride
		if (ConvertToBool($this->DisplayFieldHoursOverride->CurrentValue)) {
			$this->DisplayFieldHoursOverride->ViewValue = $this->DisplayFieldHoursOverride->tagCaption(1) != "" ? $this->DisplayFieldHoursOverride->tagCaption(1) : "Yes";
		} else {
			$this->DisplayFieldHoursOverride->ViewValue = $this->DisplayFieldHoursOverride->tagCaption(2) != "" ? $this->DisplayFieldHoursOverride->tagCaption(2) : "No";
		}
		$this->DisplayFieldHoursOverride->ViewCustomAttributes = "";

		// DisplayShopHours
		if (ConvertToBool($this->DisplayShopHours->CurrentValue)) {
			$this->DisplayShopHours->ViewValue = $this->DisplayShopHours->tagCaption(1) != "" ? $this->DisplayShopHours->tagCaption(1) : "Yes";
		} else {
			$this->DisplayShopHours->ViewValue = $this->DisplayShopHours->tagCaption(2) != "" ? $this->DisplayShopHours->tagCaption(2) : "No";
		}
		$this->DisplayShopHours->ViewCustomAttributes = "";

		// DisplayShopHoursOverride
		if (ConvertToBool($this->DisplayShopHoursOverride->CurrentValue)) {
			$this->DisplayShopHoursOverride->ViewValue = $this->DisplayShopHoursOverride->tagCaption(1) != "" ? $this->DisplayShopHoursOverride->tagCaption(1) : "Yes";
		} else {
			$this->DisplayShopHoursOverride->ViewValue = $this->DisplayShopHoursOverride->tagCaption(2) != "" ? $this->DisplayShopHoursOverride->tagCaption(2) : "No";
		}
		$this->DisplayShopHoursOverride->ViewCustomAttributes = "";

		// DisplayUserShopHoursOnly
		if (ConvertToBool($this->DisplayUserShopHoursOnly->CurrentValue)) {
			$this->DisplayUserShopHoursOnly->ViewValue = $this->DisplayUserShopHoursOnly->tagCaption(1) != "" ? $this->DisplayUserShopHoursOnly->tagCaption(1) : "Yes";
		} else {
			$this->DisplayUserShopHoursOnly->ViewValue = $this->DisplayUserShopHoursOnly->tagCaption(2) != "" ? $this->DisplayUserShopHoursOnly->tagCaption(2) : "No";
		}
		$this->DisplayUserShopHoursOnly->ViewCustomAttributes = "";

		// DisplayPipeExposure
		if (ConvertToBool($this->DisplayPipeExposure->CurrentValue)) {
			$this->DisplayPipeExposure->ViewValue = $this->DisplayPipeExposure->tagCaption(1) != "" ? $this->DisplayPipeExposure->tagCaption(1) : "Yes";
		} else {
			$this->DisplayPipeExposure->ViewValue = $this->DisplayPipeExposure->tagCaption(2) != "" ? $this->DisplayPipeExposure->tagCaption(2) : "No";
		}
		$this->DisplayPipeExposure->ViewCustomAttributes = "";

		// DisplayVolumeCorrection
		if (ConvertToBool($this->DisplayVolumeCorrection->CurrentValue)) {
			$this->DisplayVolumeCorrection->ViewValue = $this->DisplayVolumeCorrection->tagCaption(1) != "" ? $this->DisplayVolumeCorrection->tagCaption(1) : "Yes";
		} else {
			$this->DisplayVolumeCorrection->ViewValue = $this->DisplayVolumeCorrection->tagCaption(2) != "" ? $this->DisplayVolumeCorrection->tagCaption(2) : "No";
		}
		$this->DisplayVolumeCorrection->ViewCustomAttributes = "";

		// DisplayManhourAdjustment
		if (ConvertToBool($this->DisplayManhourAdjustment->CurrentValue)) {
			$this->DisplayManhourAdjustment->ViewValue = $this->DisplayManhourAdjustment->tagCaption(1) != "" ? $this->DisplayManhourAdjustment->tagCaption(1) : "Yes";
		} else {
			$this->DisplayManhourAdjustment->ViewValue = $this->DisplayManhourAdjustment->tagCaption(2) != "" ? $this->DisplayManhourAdjustment->tagCaption(2) : "No";
		}
		$this->DisplayManhourAdjustment->ViewCustomAttributes = "";

		// IsSubcontractWorksheet
		if (ConvertToBool($this->IsSubcontractWorksheet->CurrentValue)) {
			$this->IsSubcontractWorksheet->ViewValue = $this->IsSubcontractWorksheet->tagCaption(1) != "" ? $this->IsSubcontractWorksheet->tagCaption(1) : "Yes";
		} else {
			$this->IsSubcontractWorksheet->ViewValue = $this->IsSubcontractWorksheet->tagCaption(2) != "" ? $this->IsSubcontractWorksheet->tagCaption(2) : "No";
		}
		$this->IsSubcontractWorksheet->ViewCustomAttributes = "";

		// DisplayDeleteItemsButtons
		if (ConvertToBool($this->DisplayDeleteItemsButtons->CurrentValue)) {
			$this->DisplayDeleteItemsButtons->ViewValue = $this->DisplayDeleteItemsButtons->tagCaption(1) != "" ? $this->DisplayDeleteItemsButtons->tagCaption(1) : "Yes";
		} else {
			$this->DisplayDeleteItemsButtons->ViewValue = $this->DisplayDeleteItemsButtons->tagCaption(2) != "" ? $this->DisplayDeleteItemsButtons->tagCaption(2) : "No";
		}
		$this->DisplayDeleteItemsButtons->ViewCustomAttributes = "";

		// ActiveFlag
		if (ConvertToBool($this->ActiveFlag->CurrentValue)) {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(1) != "" ? $this->ActiveFlag->tagCaption(1) : "Yes";
		} else {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(2) != "" ? $this->ActiveFlag->tagCaption(2) : "No";
		}
		$this->ActiveFlag->ViewCustomAttributes = "";

		// WorksheetMaster_Idn
		$this->WorksheetMaster_Idn->LinkCustomAttributes = "";
		$this->WorksheetMaster_Idn->HrefValue = "";
		$this->WorksheetMaster_Idn->TooltipValue = "";

		// Name
		$this->Name->LinkCustomAttributes = "";
		$this->Name->HrefValue = "";
		$this->Name->TooltipValue = "";

		// Department_Idn
		$this->Department_Idn->LinkCustomAttributes = "";
		$this->Department_Idn->HrefValue = "";
		$this->Department_Idn->TooltipValue = "";

		// Rank
		$this->Rank->LinkCustomAttributes = "";
		$this->Rank->HrefValue = "";
		$this->Rank->TooltipValue = "";

		// NumberOfColumns
		$this->NumberOfColumns->LinkCustomAttributes = "";
		$this->NumberOfColumns->HrefValue = "";
		$this->NumberOfColumns->TooltipValue = "";

		// AllowMultiple
		$this->AllowMultiple->LinkCustomAttributes = "";
		$this->AllowMultiple->HrefValue = "";
		$this->AllowMultiple->TooltipValue = "";

		// DisplayAdjustmentFactors
		$this->DisplayAdjustmentFactors->LinkCustomAttributes = "";
		$this->DisplayAdjustmentFactors->HrefValue = "";
		$this->DisplayAdjustmentFactors->TooltipValue = "";

		// DisplayWorksheetDetails
		$this->DisplayWorksheetDetails->LinkCustomAttributes = "";
		$this->DisplayWorksheetDetails->HrefValue = "";
		$this->DisplayWorksheetDetails->TooltipValue = "";

		// DisplayShopFabrication
		$this->DisplayShopFabrication->LinkCustomAttributes = "";
		$this->DisplayShopFabrication->HrefValue = "";
		$this->DisplayShopFabrication->TooltipValue = "";

		// DisplayWorksheetName
		$this->DisplayWorksheetName->LinkCustomAttributes = "";
		$this->DisplayWorksheetName->HrefValue = "";
		$this->DisplayWorksheetName->TooltipValue = "";

		// DisplayWorksheetHeader
		$this->DisplayWorksheetHeader->LinkCustomAttributes = "";
		$this->DisplayWorksheetHeader->HrefValue = "";
		$this->DisplayWorksheetHeader->TooltipValue = "";

		// UseRadioButtonsForSizes
		$this->UseRadioButtonsForSizes->LinkCustomAttributes = "";
		$this->UseRadioButtonsForSizes->HrefValue = "";
		$this->UseRadioButtonsForSizes->TooltipValue = "";

		// DisplayFieldHoursOverride
		$this->DisplayFieldHoursOverride->LinkCustomAttributes = "";
		$this->DisplayFieldHoursOverride->HrefValue = "";
		$this->DisplayFieldHoursOverride->TooltipValue = "";

		// DisplayShopHours
		$this->DisplayShopHours->LinkCustomAttributes = "";
		$this->DisplayShopHours->HrefValue = "";
		$this->DisplayShopHours->TooltipValue = "";

		// DisplayShopHoursOverride
		$this->DisplayShopHoursOverride->LinkCustomAttributes = "";
		$this->DisplayShopHoursOverride->HrefValue = "";
		$this->DisplayShopHoursOverride->TooltipValue = "";

		// DisplayUserShopHoursOnly
		$this->DisplayUserShopHoursOnly->LinkCustomAttributes = "";
		$this->DisplayUserShopHoursOnly->HrefValue = "";
		$this->DisplayUserShopHoursOnly->TooltipValue = "";

		// DisplayPipeExposure
		$this->DisplayPipeExposure->LinkCustomAttributes = "";
		$this->DisplayPipeExposure->HrefValue = "";
		$this->DisplayPipeExposure->TooltipValue = "";

		// DisplayVolumeCorrection
		$this->DisplayVolumeCorrection->LinkCustomAttributes = "";
		$this->DisplayVolumeCorrection->HrefValue = "";
		$this->DisplayVolumeCorrection->TooltipValue = "";

		// DisplayManhourAdjustment
		$this->DisplayManhourAdjustment->LinkCustomAttributes = "";
		$this->DisplayManhourAdjustment->HrefValue = "";
		$this->DisplayManhourAdjustment->TooltipValue = "";

		// IsSubcontractWorksheet
		$this->IsSubcontractWorksheet->LinkCustomAttributes = "";
		$this->IsSubcontractWorksheet->HrefValue = "";
		$this->IsSubcontractWorksheet->TooltipValue = "";

		// DisplayDeleteItemsButtons
		$this->DisplayDeleteItemsButtons->LinkCustomAttributes = "";
		$this->DisplayDeleteItemsButtons->HrefValue = "";
		$this->DisplayDeleteItemsButtons->TooltipValue = "";

		// ActiveFlag
		$this->ActiveFlag->LinkCustomAttributes = "";
		$this->ActiveFlag->HrefValue = "";
		$this->ActiveFlag->TooltipValue = "";

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

		// WorksheetMaster_Idn
		$this->WorksheetMaster_Idn->EditAttrs["class"] = "form-control";
		$this->WorksheetMaster_Idn->EditCustomAttributes = "";
		$this->WorksheetMaster_Idn->EditValue = $this->WorksheetMaster_Idn->CurrentValue;
		$this->WorksheetMaster_Idn->ViewCustomAttributes = "";

		// Name
		$this->Name->EditAttrs["class"] = "form-control";
		$this->Name->EditCustomAttributes = "";
		if (!$this->Name->Raw)
			$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
		$this->Name->EditValue = $this->Name->CurrentValue;
		$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

		// Department_Idn
		$this->Department_Idn->EditAttrs["class"] = "form-control";
		$this->Department_Idn->EditCustomAttributes = "";

		// Rank
		$this->Rank->EditAttrs["class"] = "form-control";
		$this->Rank->EditCustomAttributes = "";
		$this->Rank->EditValue = $this->Rank->CurrentValue;
		$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

		// NumberOfColumns
		$this->NumberOfColumns->EditAttrs["class"] = "form-control";
		$this->NumberOfColumns->EditCustomAttributes = "";
		$this->NumberOfColumns->EditValue = $this->NumberOfColumns->CurrentValue;
		$this->NumberOfColumns->PlaceHolder = RemoveHtml($this->NumberOfColumns->caption());

		// AllowMultiple
		$this->AllowMultiple->EditCustomAttributes = "";
		$this->AllowMultiple->EditValue = $this->AllowMultiple->options(FALSE);

		// DisplayAdjustmentFactors
		$this->DisplayAdjustmentFactors->EditCustomAttributes = "";
		$this->DisplayAdjustmentFactors->EditValue = $this->DisplayAdjustmentFactors->options(FALSE);

		// DisplayWorksheetDetails
		$this->DisplayWorksheetDetails->EditCustomAttributes = "";
		$this->DisplayWorksheetDetails->EditValue = $this->DisplayWorksheetDetails->options(FALSE);

		// DisplayShopFabrication
		$this->DisplayShopFabrication->EditCustomAttributes = "";
		$this->DisplayShopFabrication->EditValue = $this->DisplayShopFabrication->options(FALSE);

		// DisplayWorksheetName
		$this->DisplayWorksheetName->EditCustomAttributes = "";
		$this->DisplayWorksheetName->EditValue = $this->DisplayWorksheetName->options(FALSE);

		// DisplayWorksheetHeader
		$this->DisplayWorksheetHeader->EditCustomAttributes = "";
		$this->DisplayWorksheetHeader->EditValue = $this->DisplayWorksheetHeader->options(FALSE);

		// UseRadioButtonsForSizes
		$this->UseRadioButtonsForSizes->EditCustomAttributes = "";
		$this->UseRadioButtonsForSizes->EditValue = $this->UseRadioButtonsForSizes->options(FALSE);

		// DisplayFieldHoursOverride
		$this->DisplayFieldHoursOverride->EditCustomAttributes = "";
		$this->DisplayFieldHoursOverride->EditValue = $this->DisplayFieldHoursOverride->options(FALSE);

		// DisplayShopHours
		$this->DisplayShopHours->EditCustomAttributes = "";
		$this->DisplayShopHours->EditValue = $this->DisplayShopHours->options(FALSE);

		// DisplayShopHoursOverride
		$this->DisplayShopHoursOverride->EditCustomAttributes = "";
		$this->DisplayShopHoursOverride->EditValue = $this->DisplayShopHoursOverride->options(FALSE);

		// DisplayUserShopHoursOnly
		$this->DisplayUserShopHoursOnly->EditCustomAttributes = "";
		$this->DisplayUserShopHoursOnly->EditValue = $this->DisplayUserShopHoursOnly->options(FALSE);

		// DisplayPipeExposure
		$this->DisplayPipeExposure->EditCustomAttributes = "";
		$this->DisplayPipeExposure->EditValue = $this->DisplayPipeExposure->options(FALSE);

		// DisplayVolumeCorrection
		$this->DisplayVolumeCorrection->EditCustomAttributes = "";
		$this->DisplayVolumeCorrection->EditValue = $this->DisplayVolumeCorrection->options(FALSE);

		// DisplayManhourAdjustment
		$this->DisplayManhourAdjustment->EditCustomAttributes = "";
		$this->DisplayManhourAdjustment->EditValue = $this->DisplayManhourAdjustment->options(FALSE);

		// IsSubcontractWorksheet
		$this->IsSubcontractWorksheet->EditCustomAttributes = "";
		$this->IsSubcontractWorksheet->EditValue = $this->IsSubcontractWorksheet->options(FALSE);

		// DisplayDeleteItemsButtons
		$this->DisplayDeleteItemsButtons->EditCustomAttributes = "";
		$this->DisplayDeleteItemsButtons->EditValue = $this->DisplayDeleteItemsButtons->options(FALSE);

		// ActiveFlag
		$this->ActiveFlag->EditCustomAttributes = "";
		$this->ActiveFlag->EditValue = $this->ActiveFlag->options(FALSE);

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
					$doc->exportCaption($this->WorksheetMaster_Idn);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->Department_Idn);
					$doc->exportCaption($this->Rank);
					$doc->exportCaption($this->DisplayShopFabrication);
					$doc->exportCaption($this->DisplayWorksheetName);
					$doc->exportCaption($this->DisplayWorksheetHeader);
					$doc->exportCaption($this->UseRadioButtonsForSizes);
					$doc->exportCaption($this->DisplayFieldHoursOverride);
					$doc->exportCaption($this->DisplayShopHours);
					$doc->exportCaption($this->DisplayShopHoursOverride);
					$doc->exportCaption($this->DisplayUserShopHoursOnly);
					$doc->exportCaption($this->DisplayPipeExposure);
					$doc->exportCaption($this->DisplayVolumeCorrection);
					$doc->exportCaption($this->DisplayManhourAdjustment);
					$doc->exportCaption($this->IsSubcontractWorksheet);
					$doc->exportCaption($this->DisplayDeleteItemsButtons);
					$doc->exportCaption($this->ActiveFlag);
				} else {
					$doc->exportCaption($this->WorksheetMaster_Idn);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->Department_Idn);
					$doc->exportCaption($this->Rank);
					$doc->exportCaption($this->NumberOfColumns);
					$doc->exportCaption($this->AllowMultiple);
					$doc->exportCaption($this->DisplayAdjustmentFactors);
					$doc->exportCaption($this->DisplayWorksheetDetails);
					$doc->exportCaption($this->DisplayShopFabrication);
					$doc->exportCaption($this->DisplayWorksheetName);
					$doc->exportCaption($this->DisplayWorksheetHeader);
					$doc->exportCaption($this->UseRadioButtonsForSizes);
					$doc->exportCaption($this->DisplayFieldHoursOverride);
					$doc->exportCaption($this->DisplayShopHours);
					$doc->exportCaption($this->DisplayShopHoursOverride);
					$doc->exportCaption($this->DisplayUserShopHoursOnly);
					$doc->exportCaption($this->DisplayPipeExposure);
					$doc->exportCaption($this->DisplayVolumeCorrection);
					$doc->exportCaption($this->DisplayManhourAdjustment);
					$doc->exportCaption($this->IsSubcontractWorksheet);
					$doc->exportCaption($this->DisplayDeleteItemsButtons);
					$doc->exportCaption($this->ActiveFlag);
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
						$doc->exportField($this->WorksheetMaster_Idn);
						$doc->exportField($this->Name);
						$doc->exportField($this->Department_Idn);
						$doc->exportField($this->Rank);
						$doc->exportField($this->DisplayShopFabrication);
						$doc->exportField($this->DisplayWorksheetName);
						$doc->exportField($this->DisplayWorksheetHeader);
						$doc->exportField($this->UseRadioButtonsForSizes);
						$doc->exportField($this->DisplayFieldHoursOverride);
						$doc->exportField($this->DisplayShopHours);
						$doc->exportField($this->DisplayShopHoursOverride);
						$doc->exportField($this->DisplayUserShopHoursOnly);
						$doc->exportField($this->DisplayPipeExposure);
						$doc->exportField($this->DisplayVolumeCorrection);
						$doc->exportField($this->DisplayManhourAdjustment);
						$doc->exportField($this->IsSubcontractWorksheet);
						$doc->exportField($this->DisplayDeleteItemsButtons);
						$doc->exportField($this->ActiveFlag);
					} else {
						$doc->exportField($this->WorksheetMaster_Idn);
						$doc->exportField($this->Name);
						$doc->exportField($this->Department_Idn);
						$doc->exportField($this->Rank);
						$doc->exportField($this->NumberOfColumns);
						$doc->exportField($this->AllowMultiple);
						$doc->exportField($this->DisplayAdjustmentFactors);
						$doc->exportField($this->DisplayWorksheetDetails);
						$doc->exportField($this->DisplayShopFabrication);
						$doc->exportField($this->DisplayWorksheetName);
						$doc->exportField($this->DisplayWorksheetHeader);
						$doc->exportField($this->UseRadioButtonsForSizes);
						$doc->exportField($this->DisplayFieldHoursOverride);
						$doc->exportField($this->DisplayShopHours);
						$doc->exportField($this->DisplayShopHoursOverride);
						$doc->exportField($this->DisplayUserShopHoursOnly);
						$doc->exportField($this->DisplayPipeExposure);
						$doc->exportField($this->DisplayVolumeCorrection);
						$doc->exportField($this->DisplayManhourAdjustment);
						$doc->exportField($this->IsSubcontractWorksheet);
						$doc->exportField($this->DisplayDeleteItemsButtons);
						$doc->exportField($this->ActiveFlag);
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