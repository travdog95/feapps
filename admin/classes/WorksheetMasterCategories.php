<?php namespace PHPMaker2020\feapps51; ?>
<?php

/**
 * Table class for WorksheetMasterCategories
 */
class WorksheetMasterCategories extends DbTable
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
	public $WorksheetCategory_Idn;
	public $Rank;
	public $AutoLoadFlag;
	public $LoadFlag;
	public $AddMiscFlag;
	public $ChildWorksheetMaster_Idn;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'WorksheetMasterCategories';
		$this->TableName = 'WorksheetMasterCategories';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[WorksheetMasterCategories]";
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
		$this->WorksheetMaster_Idn = new DbField('WorksheetMasterCategories', 'WorksheetMasterCategories', 'x_WorksheetMaster_Idn', 'WorksheetMaster_Idn', '[WorksheetMaster_Idn]', 'CAST([WorksheetMaster_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[WorksheetMaster_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->WorksheetMaster_Idn->IsPrimaryKey = TRUE; // Primary key field
		$this->WorksheetMaster_Idn->IsForeignKey = TRUE; // Foreign key field
		$this->WorksheetMaster_Idn->Nullable = FALSE; // NOT NULL field
		$this->WorksheetMaster_Idn->Required = TRUE; // Required field
		$this->WorksheetMaster_Idn->Sortable = TRUE; // Allow sort
		$this->WorksheetMaster_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['WorksheetMaster_Idn'] = &$this->WorksheetMaster_Idn;

		// WorksheetCategory_Idn
		$this->WorksheetCategory_Idn = new DbField('WorksheetMasterCategories', 'WorksheetMasterCategories', 'x_WorksheetCategory_Idn', 'WorksheetCategory_Idn', '[WorksheetCategory_Idn]', 'CAST([WorksheetCategory_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[WorksheetCategory_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->WorksheetCategory_Idn->IsPrimaryKey = TRUE; // Primary key field
		$this->WorksheetCategory_Idn->IsForeignKey = TRUE; // Foreign key field
		$this->WorksheetCategory_Idn->Nullable = FALSE; // NOT NULL field
		$this->WorksheetCategory_Idn->Required = TRUE; // Required field
		$this->WorksheetCategory_Idn->Sortable = TRUE; // Allow sort
		$this->WorksheetCategory_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->WorksheetCategory_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->WorksheetCategory_Idn->Lookup = new Lookup('WorksheetCategory_Idn', 'v_WorksheetCategories', FALSE, 'WorksheetCategory_Idn', ["Name","DepartmentName","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->WorksheetCategory_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['WorksheetCategory_Idn'] = &$this->WorksheetCategory_Idn;

		// Rank
		$this->Rank = new DbField('WorksheetMasterCategories', 'WorksheetMasterCategories', 'x_Rank', 'Rank', '[Rank]', 'CAST([Rank] AS NVARCHAR)', 3, 4, -1, FALSE, '[Rank]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Rank->Sortable = TRUE; // Allow sort
		$this->Rank->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Rank'] = &$this->Rank;

		// AutoLoadFlag
		$this->AutoLoadFlag = new DbField('WorksheetMasterCategories', 'WorksheetMasterCategories', 'x_AutoLoadFlag', 'AutoLoadFlag', '[AutoLoadFlag]', '[AutoLoadFlag]', 11, 2, -1, FALSE, '[AutoLoadFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->AutoLoadFlag->Sortable = TRUE; // Allow sort
		$this->AutoLoadFlag->DataType = DATATYPE_BOOLEAN;
		$this->AutoLoadFlag->Lookup = new Lookup('AutoLoadFlag', 'WorksheetMasterCategories', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->AutoLoadFlag->OptionCount = 2;
		$this->fields['AutoLoadFlag'] = &$this->AutoLoadFlag;

		// LoadFlag
		$this->LoadFlag = new DbField('WorksheetMasterCategories', 'WorksheetMasterCategories', 'x_LoadFlag', 'LoadFlag', '[LoadFlag]', '[LoadFlag]', 11, 2, -1, FALSE, '[LoadFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->LoadFlag->Sortable = TRUE; // Allow sort
		$this->LoadFlag->DataType = DATATYPE_BOOLEAN;
		$this->LoadFlag->Lookup = new Lookup('LoadFlag', 'WorksheetMasterCategories', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->LoadFlag->OptionCount = 2;
		$this->fields['LoadFlag'] = &$this->LoadFlag;

		// AddMiscFlag
		$this->AddMiscFlag = new DbField('WorksheetMasterCategories', 'WorksheetMasterCategories', 'x_AddMiscFlag', 'AddMiscFlag', '[AddMiscFlag]', '[AddMiscFlag]', 11, 2, -1, FALSE, '[AddMiscFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->AddMiscFlag->Sortable = TRUE; // Allow sort
		$this->AddMiscFlag->DataType = DATATYPE_BOOLEAN;
		$this->AddMiscFlag->Lookup = new Lookup('AddMiscFlag', 'WorksheetMasterCategories', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->AddMiscFlag->OptionCount = 2;
		$this->fields['AddMiscFlag'] = &$this->AddMiscFlag;

		// ChildWorksheetMaster_Idn
		$this->ChildWorksheetMaster_Idn = new DbField('WorksheetMasterCategories', 'WorksheetMasterCategories', 'x_ChildWorksheetMaster_Idn', 'ChildWorksheetMaster_Idn', '[ChildWorksheetMaster_Idn]', 'CAST([ChildWorksheetMaster_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[ChildWorksheetMaster_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ChildWorksheetMaster_Idn->Sortable = TRUE; // Allow sort
		$this->ChildWorksheetMaster_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ChildWorksheetMaster_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ChildWorksheetMaster_Idn->Lookup = new Lookup('ChildWorksheetMaster_Idn', 'WorksheetMasters', FALSE, 'WorksheetMaster_Idn', ["Name","Department_Idn","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->ChildWorksheetMaster_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChildWorksheetMaster_Idn'] = &$this->ChildWorksheetMaster_Idn;
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

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "WorksheetMasters") {
			if ($this->WorksheetMaster_Idn->getSessionValue() != "")
				$masterFilter .= "[WorksheetMaster_Idn]=" . QuotedValue($this->WorksheetMaster_Idn->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "WorksheetCategories") {
			if ($this->WorksheetCategory_Idn->getSessionValue() != "")
				$masterFilter .= "[WorksheetCategory_Idn]=" . QuotedValue($this->WorksheetCategory_Idn->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "WorksheetMasters") {
			if ($this->WorksheetMaster_Idn->getSessionValue() != "")
				$detailFilter .= "[WorksheetMaster_Idn]=" . QuotedValue($this->WorksheetMaster_Idn->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		if ($this->getCurrentMasterTable() == "WorksheetCategories") {
			if ($this->WorksheetCategory_Idn->getSessionValue() != "")
				$detailFilter .= "[WorksheetCategory_Idn]=" . QuotedValue($this->WorksheetCategory_Idn->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_WorksheetMasters()
	{
		return "[WorksheetMaster_Idn]=@WorksheetMaster_Idn@";
	}

	// Detail filter
	public function sqlDetailFilter_WorksheetMasters()
	{
		return "[WorksheetMaster_Idn]=@WorksheetMaster_Idn@";
	}

	// Master filter
	public function sqlMasterFilter_WorksheetCategories()
	{
		return "[WorksheetCategory_Idn]=@WorksheetCategory_Idn@";
	}

	// Detail filter
	public function sqlDetailFilter_WorksheetCategories()
	{
		return "[WorksheetCategory_Idn]=@WorksheetCategory_Idn@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[WorksheetMasterCategories]";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "[WorksheetMaster_Idn] ASC,[Rank] ASC";
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
			if (array_key_exists('WorksheetMaster_Idn', $rs))
				AddFilter($where, QuotedName('WorksheetMaster_Idn', $this->Dbid) . '=' . QuotedValue($rs['WorksheetMaster_Idn'], $this->WorksheetMaster_Idn->DataType, $this->Dbid));
			if (array_key_exists('WorksheetCategory_Idn', $rs))
				AddFilter($where, QuotedName('WorksheetCategory_Idn', $this->Dbid) . '=' . QuotedValue($rs['WorksheetCategory_Idn'], $this->WorksheetCategory_Idn->DataType, $this->Dbid));
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
		$this->WorksheetMaster_Idn->DbValue = $row['WorksheetMaster_Idn'];
		$this->WorksheetCategory_Idn->DbValue = $row['WorksheetCategory_Idn'];
		$this->Rank->DbValue = $row['Rank'];
		$this->AutoLoadFlag->DbValue = (ConvertToBool($row['AutoLoadFlag']) ? "1" : "0");
		$this->LoadFlag->DbValue = (ConvertToBool($row['LoadFlag']) ? "1" : "0");
		$this->AddMiscFlag->DbValue = (ConvertToBool($row['AddMiscFlag']) ? "1" : "0");
		$this->ChildWorksheetMaster_Idn->DbValue = $row['ChildWorksheetMaster_Idn'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "[WorksheetMaster_Idn] = @WorksheetMaster_Idn@ AND [WorksheetCategory_Idn] = @WorksheetCategory_Idn@";
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
		if (is_array($row))
			$val = array_key_exists('WorksheetCategory_Idn', $row) ? $row['WorksheetCategory_Idn'] : NULL;
		else
			$val = $this->WorksheetCategory_Idn->OldValue !== NULL ? $this->WorksheetCategory_Idn->OldValue : $this->WorksheetCategory_Idn->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@WorksheetCategory_Idn@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "WorksheetMasterCategorieslist.php";
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
		if ($pageName == "WorksheetMasterCategoriesview.php")
			return $Language->phrase("View");
		elseif ($pageName == "WorksheetMasterCategoriesedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "WorksheetMasterCategoriesadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "WorksheetMasterCategorieslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("WorksheetMasterCategoriesview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("WorksheetMasterCategoriesview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "WorksheetMasterCategoriesadd.php?" . $this->getUrlParm($parm);
		else
			$url = "WorksheetMasterCategoriesadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("WorksheetMasterCategoriesedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("WorksheetMasterCategoriesadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("WorksheetMasterCategoriesdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "WorksheetMasters" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_WorksheetMaster_Idn=" . urlencode($this->WorksheetMaster_Idn->CurrentValue);
		}
		if ($this->getCurrentMasterTable() == "WorksheetCategories" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_WorksheetCategory_Idn=" . urlencode($this->WorksheetCategory_Idn->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "WorksheetMaster_Idn:" . JsonEncode($this->WorksheetMaster_Idn->CurrentValue, "number");
		$json .= ",WorksheetCategory_Idn:" . JsonEncode($this->WorksheetCategory_Idn->CurrentValue, "number");
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
		if ($this->WorksheetCategory_Idn->CurrentValue != NULL) {
			$url .= "&WorksheetCategory_Idn=" . urlencode($this->WorksheetCategory_Idn->CurrentValue);
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
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
		} else {
			if (Param("WorksheetMaster_Idn") !== NULL)
				$arKey[] = Param("WorksheetMaster_Idn");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("WorksheetCategory_Idn") !== NULL)
				$arKey[] = Param("WorksheetCategory_Idn");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 2)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // WorksheetMaster_Idn
					continue;
				if (!is_numeric($key[1])) // WorksheetCategory_Idn
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
				$this->WorksheetMaster_Idn->CurrentValue = $key[0];
			else
				$this->WorksheetMaster_Idn->OldValue = $key[0];
			if ($setCurrent)
				$this->WorksheetCategory_Idn->CurrentValue = $key[1];
			else
				$this->WorksheetCategory_Idn->OldValue = $key[1];
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
		$this->WorksheetCategory_Idn->setDbValue($rs->fields('WorksheetCategory_Idn'));
		$this->Rank->setDbValue($rs->fields('Rank'));
		$this->AutoLoadFlag->setDbValue(ConvertToBool($rs->fields('AutoLoadFlag')) ? "1" : "0");
		$this->LoadFlag->setDbValue(ConvertToBool($rs->fields('LoadFlag')) ? "1" : "0");
		$this->AddMiscFlag->setDbValue(ConvertToBool($rs->fields('AddMiscFlag')) ? "1" : "0");
		$this->ChildWorksheetMaster_Idn->setDbValue($rs->fields('ChildWorksheetMaster_Idn'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// WorksheetMaster_Idn
		// WorksheetCategory_Idn
		// Rank
		// AutoLoadFlag
		// LoadFlag
		// AddMiscFlag
		// ChildWorksheetMaster_Idn
		// WorksheetMaster_Idn

		$this->WorksheetMaster_Idn->ViewValue = $this->WorksheetMaster_Idn->CurrentValue;
		$this->WorksheetMaster_Idn->ViewValue = FormatNumber($this->WorksheetMaster_Idn->ViewValue, 0, -2, -2, -2);
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
					$arwrk[2] = $rswrk->fields('df2');
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

		// Rank
		$this->Rank->ViewValue = $this->Rank->CurrentValue;
		$this->Rank->ViewValue = FormatNumber($this->Rank->ViewValue, 0, -2, -2, -2);
		$this->Rank->ViewCustomAttributes = "";

		// AutoLoadFlag
		if (ConvertToBool($this->AutoLoadFlag->CurrentValue)) {
			$this->AutoLoadFlag->ViewValue = $this->AutoLoadFlag->tagCaption(1) != "" ? $this->AutoLoadFlag->tagCaption(1) : "Yes";
		} else {
			$this->AutoLoadFlag->ViewValue = $this->AutoLoadFlag->tagCaption(2) != "" ? $this->AutoLoadFlag->tagCaption(2) : "No";
		}
		$this->AutoLoadFlag->ViewCustomAttributes = "";

		// LoadFlag
		if (ConvertToBool($this->LoadFlag->CurrentValue)) {
			$this->LoadFlag->ViewValue = $this->LoadFlag->tagCaption(1) != "" ? $this->LoadFlag->tagCaption(1) : "Yes";
		} else {
			$this->LoadFlag->ViewValue = $this->LoadFlag->tagCaption(2) != "" ? $this->LoadFlag->tagCaption(2) : "No";
		}
		$this->LoadFlag->ViewCustomAttributes = "";

		// AddMiscFlag
		if (ConvertToBool($this->AddMiscFlag->CurrentValue)) {
			$this->AddMiscFlag->ViewValue = $this->AddMiscFlag->tagCaption(1) != "" ? $this->AddMiscFlag->tagCaption(1) : "Yes";
		} else {
			$this->AddMiscFlag->ViewValue = $this->AddMiscFlag->tagCaption(2) != "" ? $this->AddMiscFlag->tagCaption(2) : "No";
		}
		$this->AddMiscFlag->ViewCustomAttributes = "";

		// ChildWorksheetMaster_Idn
		$curVal = strval($this->ChildWorksheetMaster_Idn->CurrentValue);
		if ($curVal != "") {
			$this->ChildWorksheetMaster_Idn->ViewValue = $this->ChildWorksheetMaster_Idn->lookupCacheOption($curVal);
			if ($this->ChildWorksheetMaster_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[WorksheetMaster_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ChildWorksheetMaster_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = FormatNumber($rswrk->fields('df2'), 0, -2, -2, -2);
					$this->ChildWorksheetMaster_Idn->ViewValue = $this->ChildWorksheetMaster_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ChildWorksheetMaster_Idn->ViewValue = $this->ChildWorksheetMaster_Idn->CurrentValue;
				}
			}
		} else {
			$this->ChildWorksheetMaster_Idn->ViewValue = NULL;
		}
		$this->ChildWorksheetMaster_Idn->ViewCustomAttributes = "";

		// WorksheetMaster_Idn
		$this->WorksheetMaster_Idn->LinkCustomAttributes = "";
		$this->WorksheetMaster_Idn->HrefValue = "";
		$this->WorksheetMaster_Idn->TooltipValue = "";

		// WorksheetCategory_Idn
		$this->WorksheetCategory_Idn->LinkCustomAttributes = "";
		$this->WorksheetCategory_Idn->HrefValue = "";
		$this->WorksheetCategory_Idn->TooltipValue = "";

		// Rank
		$this->Rank->LinkCustomAttributes = "";
		$this->Rank->HrefValue = "";
		$this->Rank->TooltipValue = "";

		// AutoLoadFlag
		$this->AutoLoadFlag->LinkCustomAttributes = "";
		$this->AutoLoadFlag->HrefValue = "";
		$this->AutoLoadFlag->TooltipValue = "";

		// LoadFlag
		$this->LoadFlag->LinkCustomAttributes = "";
		$this->LoadFlag->HrefValue = "";
		$this->LoadFlag->TooltipValue = "";

		// AddMiscFlag
		$this->AddMiscFlag->LinkCustomAttributes = "";
		$this->AddMiscFlag->HrefValue = "";
		$this->AddMiscFlag->TooltipValue = "";

		// ChildWorksheetMaster_Idn
		$this->ChildWorksheetMaster_Idn->LinkCustomAttributes = "";
		$this->ChildWorksheetMaster_Idn->HrefValue = "";
		$this->ChildWorksheetMaster_Idn->TooltipValue = "";

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
		$this->WorksheetMaster_Idn->PlaceHolder = RemoveHtml($this->WorksheetMaster_Idn->caption());

		// WorksheetCategory_Idn
		$this->WorksheetCategory_Idn->EditAttrs["class"] = "form-control";
		$this->WorksheetCategory_Idn->EditCustomAttributes = "";

		// Rank
		$this->Rank->EditAttrs["class"] = "form-control";
		$this->Rank->EditCustomAttributes = "";
		$this->Rank->EditValue = $this->Rank->CurrentValue;
		$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

		// AutoLoadFlag
		$this->AutoLoadFlag->EditCustomAttributes = "";
		$this->AutoLoadFlag->EditValue = $this->AutoLoadFlag->options(FALSE);

		// LoadFlag
		$this->LoadFlag->EditCustomAttributes = "";
		$this->LoadFlag->EditValue = $this->LoadFlag->options(FALSE);

		// AddMiscFlag
		$this->AddMiscFlag->EditCustomAttributes = "";
		$this->AddMiscFlag->EditValue = $this->AddMiscFlag->options(FALSE);

		// ChildWorksheetMaster_Idn
		$this->ChildWorksheetMaster_Idn->EditAttrs["class"] = "form-control";
		$this->ChildWorksheetMaster_Idn->EditCustomAttributes = "";

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
					$doc->exportCaption($this->WorksheetCategory_Idn);
					$doc->exportCaption($this->Rank);
					$doc->exportCaption($this->AutoLoadFlag);
					$doc->exportCaption($this->LoadFlag);
					$doc->exportCaption($this->AddMiscFlag);
					$doc->exportCaption($this->ChildWorksheetMaster_Idn);
				} else {
					$doc->exportCaption($this->WorksheetMaster_Idn);
					$doc->exportCaption($this->WorksheetCategory_Idn);
					$doc->exportCaption($this->Rank);
					$doc->exportCaption($this->AutoLoadFlag);
					$doc->exportCaption($this->LoadFlag);
					$doc->exportCaption($this->AddMiscFlag);
					$doc->exportCaption($this->ChildWorksheetMaster_Idn);
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
						$doc->exportField($this->WorksheetCategory_Idn);
						$doc->exportField($this->Rank);
						$doc->exportField($this->AutoLoadFlag);
						$doc->exportField($this->LoadFlag);
						$doc->exportField($this->AddMiscFlag);
						$doc->exportField($this->ChildWorksheetMaster_Idn);
					} else {
						$doc->exportField($this->WorksheetMaster_Idn);
						$doc->exportField($this->WorksheetCategory_Idn);
						$doc->exportField($this->Rank);
						$doc->exportField($this->AutoLoadFlag);
						$doc->exportField($this->LoadFlag);
						$doc->exportField($this->AddMiscFlag);
						$doc->exportField($this->ChildWorksheetMaster_Idn);
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