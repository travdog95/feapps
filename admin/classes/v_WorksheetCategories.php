<?php namespace PHPMaker2020\feapps51; ?>
<?php

/**
 * Table class for v_WorksheetCategories
 */
class v_WorksheetCategories extends DbTable
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
	public $DepartmentName;
	public $WorksheetCategory_Idn;
	public $Name;
	public $ShortName;
	public $FieldUnitPrice;
	public $IsFitting;
	public $CartFlag;
	public $IsShared;
	public $IsAssembly;
	public $ActiveFlag;
	public $Department_Idn;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'v_WorksheetCategories';
		$this->TableName = 'v_WorksheetCategories';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "[dbo].[v_WorksheetCategories]";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 10;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// DepartmentName
		$this->DepartmentName = new DbField('v_WorksheetCategories', 'v_WorksheetCategories', 'x_DepartmentName', 'DepartmentName', '[DepartmentName]', '[DepartmentName]', 202, 50, -1, FALSE, '[DepartmentName]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DepartmentName->Sortable = TRUE; // Allow sort
		$this->fields['DepartmentName'] = &$this->DepartmentName;

		// WorksheetCategory_Idn
		$this->WorksheetCategory_Idn = new DbField('v_WorksheetCategories', 'v_WorksheetCategories', 'x_WorksheetCategory_Idn', 'WorksheetCategory_Idn', '[WorksheetCategory_Idn]', 'CAST([WorksheetCategory_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[WorksheetCategory_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->WorksheetCategory_Idn->IsPrimaryKey = TRUE; // Primary key field
		$this->WorksheetCategory_Idn->Nullable = FALSE; // NOT NULL field
		$this->WorksheetCategory_Idn->Required = TRUE; // Required field
		$this->WorksheetCategory_Idn->Sortable = TRUE; // Allow sort
		$this->WorksheetCategory_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['WorksheetCategory_Idn'] = &$this->WorksheetCategory_Idn;

		// Name
		$this->Name = new DbField('v_WorksheetCategories', 'v_WorksheetCategories', 'x_Name', 'Name', '[Name]', '[Name]', 200, 100, -1, FALSE, '[Name]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Name->Sortable = TRUE; // Allow sort
		$this->fields['Name'] = &$this->Name;

		// ShortName
		$this->ShortName = new DbField('v_WorksheetCategories', 'v_WorksheetCategories', 'x_ShortName', 'ShortName', '[ShortName]', '[ShortName]', 200, 30, -1, FALSE, '[ShortName]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ShortName->Sortable = TRUE; // Allow sort
		$this->fields['ShortName'] = &$this->ShortName;

		// FieldUnitPrice
		$this->FieldUnitPrice = new DbField('v_WorksheetCategories', 'v_WorksheetCategories', 'x_FieldUnitPrice', 'FieldUnitPrice', '[FieldUnitPrice]', 'CAST([FieldUnitPrice] AS NVARCHAR)', 131, 8, -1, FALSE, '[FieldUnitPrice]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FieldUnitPrice->Sortable = TRUE; // Allow sort
		$this->FieldUnitPrice->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['FieldUnitPrice'] = &$this->FieldUnitPrice;

		// IsFitting
		$this->IsFitting = new DbField('v_WorksheetCategories', 'v_WorksheetCategories', 'x_IsFitting', 'IsFitting', '[IsFitting]', '[IsFitting]', 11, 2, -1, FALSE, '[IsFitting]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->IsFitting->Sortable = TRUE; // Allow sort
		$this->IsFitting->DataType = DATATYPE_BOOLEAN;
		$this->IsFitting->Lookup = new Lookup('IsFitting', 'v_WorksheetCategories', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->IsFitting->OptionCount = 2;
		$this->fields['IsFitting'] = &$this->IsFitting;

		// CartFlag
		$this->CartFlag = new DbField('v_WorksheetCategories', 'v_WorksheetCategories', 'x_CartFlag', 'CartFlag', '[CartFlag]', '[CartFlag]', 11, 2, -1, FALSE, '[CartFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->CartFlag->Sortable = TRUE; // Allow sort
		$this->CartFlag->DataType = DATATYPE_BOOLEAN;
		$this->CartFlag->Lookup = new Lookup('CartFlag', 'v_WorksheetCategories', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->CartFlag->OptionCount = 2;
		$this->fields['CartFlag'] = &$this->CartFlag;

		// IsShared
		$this->IsShared = new DbField('v_WorksheetCategories', 'v_WorksheetCategories', 'x_IsShared', 'IsShared', '[IsShared]', '[IsShared]', 11, 2, -1, FALSE, '[IsShared]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->IsShared->Sortable = TRUE; // Allow sort
		$this->IsShared->DataType = DATATYPE_BOOLEAN;
		$this->IsShared->Lookup = new Lookup('IsShared', 'v_WorksheetCategories', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->IsShared->OptionCount = 2;
		$this->fields['IsShared'] = &$this->IsShared;

		// IsAssembly
		$this->IsAssembly = new DbField('v_WorksheetCategories', 'v_WorksheetCategories', 'x_IsAssembly', 'IsAssembly', '[IsAssembly]', '[IsAssembly]', 11, 2, -1, FALSE, '[IsAssembly]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->IsAssembly->Sortable = TRUE; // Allow sort
		$this->IsAssembly->DataType = DATATYPE_BOOLEAN;
		$this->IsAssembly->Lookup = new Lookup('IsAssembly', 'v_WorksheetCategories', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->IsAssembly->OptionCount = 2;
		$this->fields['IsAssembly'] = &$this->IsAssembly;

		// ActiveFlag
		$this->ActiveFlag = new DbField('v_WorksheetCategories', 'v_WorksheetCategories', 'x_ActiveFlag', 'ActiveFlag', '[ActiveFlag]', '[ActiveFlag]', 11, 2, -1, FALSE, '[ActiveFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ActiveFlag->Sortable = TRUE; // Allow sort
		$this->ActiveFlag->DataType = DATATYPE_BOOLEAN;
		$this->ActiveFlag->Lookup = new Lookup('ActiveFlag', 'v_WorksheetCategories', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ActiveFlag->OptionCount = 2;
		$this->fields['ActiveFlag'] = &$this->ActiveFlag;

		// Department_Idn
		$this->Department_Idn = new DbField('v_WorksheetCategories', 'v_WorksheetCategories', 'x_Department_Idn', 'Department_Idn', '[Department_Idn]', 'CAST([Department_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[Department_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Department_Idn->Sortable = TRUE; // Allow sort
		$this->Department_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Department_Idn'] = &$this->Department_Idn;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[v_WorksheetCategories]";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
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
		$this->DepartmentName->DbValue = $row['DepartmentName'];
		$this->WorksheetCategory_Idn->DbValue = $row['WorksheetCategory_Idn'];
		$this->Name->DbValue = $row['Name'];
		$this->ShortName->DbValue = $row['ShortName'];
		$this->FieldUnitPrice->DbValue = $row['FieldUnitPrice'];
		$this->IsFitting->DbValue = (ConvertToBool($row['IsFitting']) ? "1" : "0");
		$this->CartFlag->DbValue = (ConvertToBool($row['CartFlag']) ? "1" : "0");
		$this->IsShared->DbValue = (ConvertToBool($row['IsShared']) ? "1" : "0");
		$this->IsAssembly->DbValue = (ConvertToBool($row['IsAssembly']) ? "1" : "0");
		$this->ActiveFlag->DbValue = (ConvertToBool($row['ActiveFlag']) ? "1" : "0");
		$this->Department_Idn->DbValue = $row['Department_Idn'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "[WorksheetCategory_Idn] = @WorksheetCategory_Idn@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			return "v_WorksheetCategorieslist.php";
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
		if ($pageName == "v_WorksheetCategoriesview.php")
			return $Language->phrase("View");
		elseif ($pageName == "v_WorksheetCategoriesedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "v_WorksheetCategoriesadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "v_WorksheetCategorieslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("v_WorksheetCategoriesview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("v_WorksheetCategoriesview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "v_WorksheetCategoriesadd.php?" . $this->getUrlParm($parm);
		else
			$url = "v_WorksheetCategoriesadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("v_WorksheetCategoriesedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("v_WorksheetCategoriesadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("v_WorksheetCategoriesdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "WorksheetCategory_Idn:" . JsonEncode($this->WorksheetCategory_Idn->CurrentValue, "number");
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
		if ($this->WorksheetCategory_Idn->CurrentValue != NULL) {
			$url .= "WorksheetCategory_Idn=" . urlencode($this->WorksheetCategory_Idn->CurrentValue);
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
			if (Param("WorksheetCategory_Idn") !== NULL)
				$arKeys[] = Param("WorksheetCategory_Idn");
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
				$this->WorksheetCategory_Idn->CurrentValue = $key;
			else
				$this->WorksheetCategory_Idn->OldValue = $key;
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
		$this->DepartmentName->setDbValue($rs->fields('DepartmentName'));
		$this->WorksheetCategory_Idn->setDbValue($rs->fields('WorksheetCategory_Idn'));
		$this->Name->setDbValue($rs->fields('Name'));
		$this->ShortName->setDbValue($rs->fields('ShortName'));
		$this->FieldUnitPrice->setDbValue($rs->fields('FieldUnitPrice'));
		$this->IsFitting->setDbValue(ConvertToBool($rs->fields('IsFitting')) ? "1" : "0");
		$this->CartFlag->setDbValue(ConvertToBool($rs->fields('CartFlag')) ? "1" : "0");
		$this->IsShared->setDbValue(ConvertToBool($rs->fields('IsShared')) ? "1" : "0");
		$this->IsAssembly->setDbValue(ConvertToBool($rs->fields('IsAssembly')) ? "1" : "0");
		$this->ActiveFlag->setDbValue(ConvertToBool($rs->fields('ActiveFlag')) ? "1" : "0");
		$this->Department_Idn->setDbValue($rs->fields('Department_Idn'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// DepartmentName
		// WorksheetCategory_Idn
		// Name
		// ShortName
		// FieldUnitPrice
		// IsFitting
		// CartFlag
		// IsShared
		// IsAssembly
		// ActiveFlag
		// Department_Idn
		// DepartmentName

		$this->DepartmentName->ViewValue = $this->DepartmentName->CurrentValue;
		$this->DepartmentName->ViewCustomAttributes = "";

		// WorksheetCategory_Idn
		$this->WorksheetCategory_Idn->ViewValue = $this->WorksheetCategory_Idn->CurrentValue;
		$this->WorksheetCategory_Idn->ViewValue = FormatNumber($this->WorksheetCategory_Idn->ViewValue, 0, -2, -2, -2);
		$this->WorksheetCategory_Idn->ViewCustomAttributes = "";

		// Name
		$this->Name->ViewValue = $this->Name->CurrentValue;
		$this->Name->ViewCustomAttributes = "";

		// ShortName
		$this->ShortName->ViewValue = $this->ShortName->CurrentValue;
		$this->ShortName->ViewCustomAttributes = "";

		// FieldUnitPrice
		$this->FieldUnitPrice->ViewValue = $this->FieldUnitPrice->CurrentValue;
		$this->FieldUnitPrice->ViewValue = FormatNumber($this->FieldUnitPrice->ViewValue, 2, -2, -2, -2);
		$this->FieldUnitPrice->ViewCustomAttributes = "";

		// IsFitting
		if (ConvertToBool($this->IsFitting->CurrentValue)) {
			$this->IsFitting->ViewValue = $this->IsFitting->tagCaption(1) != "" ? $this->IsFitting->tagCaption(1) : "Yes";
		} else {
			$this->IsFitting->ViewValue = $this->IsFitting->tagCaption(2) != "" ? $this->IsFitting->tagCaption(2) : "No";
		}
		$this->IsFitting->ViewCustomAttributes = "";

		// CartFlag
		if (ConvertToBool($this->CartFlag->CurrentValue)) {
			$this->CartFlag->ViewValue = $this->CartFlag->tagCaption(1) != "" ? $this->CartFlag->tagCaption(1) : "Yes";
		} else {
			$this->CartFlag->ViewValue = $this->CartFlag->tagCaption(2) != "" ? $this->CartFlag->tagCaption(2) : "No";
		}
		$this->CartFlag->ViewCustomAttributes = "";

		// IsShared
		if (ConvertToBool($this->IsShared->CurrentValue)) {
			$this->IsShared->ViewValue = $this->IsShared->tagCaption(1) != "" ? $this->IsShared->tagCaption(1) : "Yes";
		} else {
			$this->IsShared->ViewValue = $this->IsShared->tagCaption(2) != "" ? $this->IsShared->tagCaption(2) : "No";
		}
		$this->IsShared->ViewCustomAttributes = "";

		// IsAssembly
		if (ConvertToBool($this->IsAssembly->CurrentValue)) {
			$this->IsAssembly->ViewValue = $this->IsAssembly->tagCaption(1) != "" ? $this->IsAssembly->tagCaption(1) : "Yes";
		} else {
			$this->IsAssembly->ViewValue = $this->IsAssembly->tagCaption(2) != "" ? $this->IsAssembly->tagCaption(2) : "No";
		}
		$this->IsAssembly->ViewCustomAttributes = "";

		// ActiveFlag
		if (ConvertToBool($this->ActiveFlag->CurrentValue)) {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(1) != "" ? $this->ActiveFlag->tagCaption(1) : "Yes";
		} else {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(2) != "" ? $this->ActiveFlag->tagCaption(2) : "No";
		}
		$this->ActiveFlag->ViewCustomAttributes = "";

		// Department_Idn
		$this->Department_Idn->ViewValue = $this->Department_Idn->CurrentValue;
		$this->Department_Idn->ViewValue = FormatNumber($this->Department_Idn->ViewValue, 0, -2, -2, -2);
		$this->Department_Idn->ViewCustomAttributes = "";

		// DepartmentName
		$this->DepartmentName->LinkCustomAttributes = "";
		$this->DepartmentName->HrefValue = "";
		$this->DepartmentName->TooltipValue = "";

		// WorksheetCategory_Idn
		$this->WorksheetCategory_Idn->LinkCustomAttributes = "";
		$this->WorksheetCategory_Idn->HrefValue = "";
		$this->WorksheetCategory_Idn->TooltipValue = "";

		// Name
		$this->Name->LinkCustomAttributes = "";
		$this->Name->HrefValue = "";
		$this->Name->TooltipValue = "";

		// ShortName
		$this->ShortName->LinkCustomAttributes = "";
		$this->ShortName->HrefValue = "";
		$this->ShortName->TooltipValue = "";

		// FieldUnitPrice
		$this->FieldUnitPrice->LinkCustomAttributes = "";
		$this->FieldUnitPrice->HrefValue = "";
		$this->FieldUnitPrice->TooltipValue = "";

		// IsFitting
		$this->IsFitting->LinkCustomAttributes = "";
		$this->IsFitting->HrefValue = "";
		$this->IsFitting->TooltipValue = "";

		// CartFlag
		$this->CartFlag->LinkCustomAttributes = "";
		$this->CartFlag->HrefValue = "";
		$this->CartFlag->TooltipValue = "";

		// IsShared
		$this->IsShared->LinkCustomAttributes = "";
		$this->IsShared->HrefValue = "";
		$this->IsShared->TooltipValue = "";

		// IsAssembly
		$this->IsAssembly->LinkCustomAttributes = "";
		$this->IsAssembly->HrefValue = "";
		$this->IsAssembly->TooltipValue = "";

		// ActiveFlag
		$this->ActiveFlag->LinkCustomAttributes = "";
		$this->ActiveFlag->HrefValue = "";
		$this->ActiveFlag->TooltipValue = "";

		// Department_Idn
		$this->Department_Idn->LinkCustomAttributes = "";
		$this->Department_Idn->HrefValue = "";
		$this->Department_Idn->TooltipValue = "";

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

		// DepartmentName
		$this->DepartmentName->EditAttrs["class"] = "form-control";
		$this->DepartmentName->EditCustomAttributes = "";
		if (!$this->DepartmentName->Raw)
			$this->DepartmentName->CurrentValue = HtmlDecode($this->DepartmentName->CurrentValue);
		$this->DepartmentName->EditValue = $this->DepartmentName->CurrentValue;
		$this->DepartmentName->PlaceHolder = RemoveHtml($this->DepartmentName->caption());

		// WorksheetCategory_Idn
		$this->WorksheetCategory_Idn->EditAttrs["class"] = "form-control";
		$this->WorksheetCategory_Idn->EditCustomAttributes = "";
		$this->WorksheetCategory_Idn->EditValue = $this->WorksheetCategory_Idn->CurrentValue;
		$this->WorksheetCategory_Idn->PlaceHolder = RemoveHtml($this->WorksheetCategory_Idn->caption());

		// Name
		$this->Name->EditAttrs["class"] = "form-control";
		$this->Name->EditCustomAttributes = "";
		if (!$this->Name->Raw)
			$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
		$this->Name->EditValue = $this->Name->CurrentValue;
		$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

		// ShortName
		$this->ShortName->EditAttrs["class"] = "form-control";
		$this->ShortName->EditCustomAttributes = "";
		if (!$this->ShortName->Raw)
			$this->ShortName->CurrentValue = HtmlDecode($this->ShortName->CurrentValue);
		$this->ShortName->EditValue = $this->ShortName->CurrentValue;
		$this->ShortName->PlaceHolder = RemoveHtml($this->ShortName->caption());

		// FieldUnitPrice
		$this->FieldUnitPrice->EditAttrs["class"] = "form-control";
		$this->FieldUnitPrice->EditCustomAttributes = "";
		$this->FieldUnitPrice->EditValue = $this->FieldUnitPrice->CurrentValue;
		$this->FieldUnitPrice->PlaceHolder = RemoveHtml($this->FieldUnitPrice->caption());
		if (strval($this->FieldUnitPrice->EditValue) != "" && is_numeric($this->FieldUnitPrice->EditValue))
			$this->FieldUnitPrice->EditValue = FormatNumber($this->FieldUnitPrice->EditValue, -2, -2, -2, -2);
		

		// IsFitting
		$this->IsFitting->EditCustomAttributes = "";
		$this->IsFitting->EditValue = $this->IsFitting->options(FALSE);

		// CartFlag
		$this->CartFlag->EditCustomAttributes = "";
		$this->CartFlag->EditValue = $this->CartFlag->options(FALSE);

		// IsShared
		$this->IsShared->EditCustomAttributes = "";
		$this->IsShared->EditValue = $this->IsShared->options(FALSE);

		// IsAssembly
		$this->IsAssembly->EditCustomAttributes = "";
		$this->IsAssembly->EditValue = $this->IsAssembly->options(FALSE);

		// ActiveFlag
		$this->ActiveFlag->EditCustomAttributes = "";
		$this->ActiveFlag->EditValue = $this->ActiveFlag->options(FALSE);

		// Department_Idn
		$this->Department_Idn->EditAttrs["class"] = "form-control";
		$this->Department_Idn->EditCustomAttributes = "";
		$this->Department_Idn->EditValue = $this->Department_Idn->CurrentValue;
		$this->Department_Idn->PlaceHolder = RemoveHtml($this->Department_Idn->caption());

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
					$doc->exportCaption($this->DepartmentName);
					$doc->exportCaption($this->WorksheetCategory_Idn);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->ShortName);
					$doc->exportCaption($this->FieldUnitPrice);
					$doc->exportCaption($this->IsFitting);
					$doc->exportCaption($this->CartFlag);
					$doc->exportCaption($this->IsShared);
					$doc->exportCaption($this->IsAssembly);
					$doc->exportCaption($this->ActiveFlag);
					$doc->exportCaption($this->Department_Idn);
				} else {
					$doc->exportCaption($this->DepartmentName);
					$doc->exportCaption($this->WorksheetCategory_Idn);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->ShortName);
					$doc->exportCaption($this->FieldUnitPrice);
					$doc->exportCaption($this->IsFitting);
					$doc->exportCaption($this->CartFlag);
					$doc->exportCaption($this->IsShared);
					$doc->exportCaption($this->IsAssembly);
					$doc->exportCaption($this->ActiveFlag);
					$doc->exportCaption($this->Department_Idn);
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
						$doc->exportField($this->DepartmentName);
						$doc->exportField($this->WorksheetCategory_Idn);
						$doc->exportField($this->Name);
						$doc->exportField($this->ShortName);
						$doc->exportField($this->FieldUnitPrice);
						$doc->exportField($this->IsFitting);
						$doc->exportField($this->CartFlag);
						$doc->exportField($this->IsShared);
						$doc->exportField($this->IsAssembly);
						$doc->exportField($this->ActiveFlag);
						$doc->exportField($this->Department_Idn);
					} else {
						$doc->exportField($this->DepartmentName);
						$doc->exportField($this->WorksheetCategory_Idn);
						$doc->exportField($this->Name);
						$doc->exportField($this->ShortName);
						$doc->exportField($this->FieldUnitPrice);
						$doc->exportField($this->IsFitting);
						$doc->exportField($this->CartFlag);
						$doc->exportField($this->IsShared);
						$doc->exportField($this->IsAssembly);
						$doc->exportField($this->ActiveFlag);
						$doc->exportField($this->Department_Idn);
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