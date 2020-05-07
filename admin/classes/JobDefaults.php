<?php namespace PHPMaker2020\feapps51; ?>
<?php

/**
 * Table class for JobDefaults
 */
class JobDefaults extends DbTable
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
	public $JobDefault_Idn;
	public $JobDefaultType_Idn;
	public $Department_Idn;
	public $ParentJobDefault_Idn;
	public $Name;
	public $NumericValue;
	public $AlphaValue;
	public $LoadFromJobDefault_Idn;
	public $Rank;
	public $ActiveFlag;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'JobDefaults';
		$this->TableName = 'JobDefaults';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[JobDefaults]";
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

		// JobDefault_Idn
		$this->JobDefault_Idn = new DbField('JobDefaults', 'JobDefaults', 'x_JobDefault_Idn', 'JobDefault_Idn', '[JobDefault_Idn]', 'CAST([JobDefault_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[JobDefault_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->JobDefault_Idn->IsAutoIncrement = TRUE; // Autoincrement field
		$this->JobDefault_Idn->IsPrimaryKey = TRUE; // Primary key field
		$this->JobDefault_Idn->Nullable = FALSE; // NOT NULL field
		$this->JobDefault_Idn->Sortable = TRUE; // Allow sort
		$this->JobDefault_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['JobDefault_Idn'] = &$this->JobDefault_Idn;

		// JobDefaultType_Idn
		$this->JobDefaultType_Idn = new DbField('JobDefaults', 'JobDefaults', 'x_JobDefaultType_Idn', 'JobDefaultType_Idn', '[JobDefaultType_Idn]', 'CAST([JobDefaultType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[JobDefaultType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->JobDefaultType_Idn->Required = TRUE; // Required field
		$this->JobDefaultType_Idn->Sortable = TRUE; // Allow sort
		$this->JobDefaultType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->JobDefaultType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->JobDefaultType_Idn->Lookup = new Lookup('JobDefaultType_Idn', 'JobDefaultTypes', FALSE, 'JobDefaultType_Idn', ["Name","","",""], [], ["x_LoadFromJobDefault_Idn"], [], [], [], [], '[Rank] ASC', '');
		$this->JobDefaultType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['JobDefaultType_Idn'] = &$this->JobDefaultType_Idn;

		// Department_Idn
		$this->Department_Idn = new DbField('JobDefaults', 'JobDefaults', 'x_Department_Idn', 'Department_Idn', '[Department_Idn]', 'CAST([Department_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[Department_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Department_Idn->Required = TRUE; // Required field
		$this->Department_Idn->Sortable = TRUE; // Allow sort
		$this->Department_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Department_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Department_Idn->Lookup = new Lookup('Department_Idn', 'jpr_Department', FALSE, 'DepartmentId', ["Description","","",""], [], [], [], [], [], [], '[Description] ASC', '');
		$this->Department_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Department_Idn'] = &$this->Department_Idn;

		// ParentJobDefault_Idn
		$this->ParentJobDefault_Idn = new DbField('JobDefaults', 'JobDefaults', 'x_ParentJobDefault_Idn', 'ParentJobDefault_Idn', '[ParentJobDefault_Idn]', 'CAST([ParentJobDefault_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[ParentJobDefault_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ParentJobDefault_Idn->Sortable = TRUE; // Allow sort
		$this->ParentJobDefault_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ParentJobDefault_Idn'] = &$this->ParentJobDefault_Idn;

		// Name
		$this->Name = new DbField('JobDefaults', 'JobDefaults', 'x_Name', 'Name', '[Name]', '[Name]', 200, 100, -1, FALSE, '[Name]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Name->Sortable = TRUE; // Allow sort
		$this->fields['Name'] = &$this->Name;

		// NumericValue
		$this->NumericValue = new DbField('JobDefaults', 'JobDefaults', 'x_NumericValue', 'NumericValue', '[NumericValue]', 'CAST([NumericValue] AS NVARCHAR)', 131, 8, -1, FALSE, '[NumericValue]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NumericValue->Sortable = TRUE; // Allow sort
		$this->NumericValue->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['NumericValue'] = &$this->NumericValue;

		// AlphaValue
		$this->AlphaValue = new DbField('JobDefaults', 'JobDefaults', 'x_AlphaValue', 'AlphaValue', '[AlphaValue]', '[AlphaValue]', 200, 150, -1, FALSE, '[AlphaValue]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AlphaValue->Sortable = TRUE; // Allow sort
		$this->fields['AlphaValue'] = &$this->AlphaValue;

		// LoadFromJobDefault_Idn
		$this->LoadFromJobDefault_Idn = new DbField('JobDefaults', 'JobDefaults', 'x_LoadFromJobDefault_Idn', 'LoadFromJobDefault_Idn', '[LoadFromJobDefault_Idn]', 'CAST([LoadFromJobDefault_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[LoadFromJobDefault_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LoadFromJobDefault_Idn->Sortable = TRUE; // Allow sort
		$this->LoadFromJobDefault_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LoadFromJobDefault_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LoadFromJobDefault_Idn->Lookup = new Lookup('LoadFromJobDefault_Idn', 'JobDefaults', FALSE, 'JobDefault_Idn', ["Name","","",""], ["x_JobDefaultType_Idn"], [], ["JobDefaultType_Idn"], ["x_JobDefaultType_Idn"], [], [], '[Rank] ASC', '');
		$this->LoadFromJobDefault_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['LoadFromJobDefault_Idn'] = &$this->LoadFromJobDefault_Idn;

		// Rank
		$this->Rank = new DbField('JobDefaults', 'JobDefaults', 'x_Rank', 'Rank', '[Rank]', 'CAST([Rank] AS NVARCHAR)', 3, 4, -1, FALSE, '[Rank]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Rank->Sortable = TRUE; // Allow sort
		$this->Rank->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Rank'] = &$this->Rank;

		// ActiveFlag
		$this->ActiveFlag = new DbField('JobDefaults', 'JobDefaults', 'x_ActiveFlag', 'ActiveFlag', '[ActiveFlag]', '[ActiveFlag]', 11, 2, -1, FALSE, '[ActiveFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ActiveFlag->Sortable = TRUE; // Allow sort
		$this->ActiveFlag->DataType = DATATYPE_BOOLEAN;
		$this->ActiveFlag->Lookup = new Lookup('ActiveFlag', 'JobDefaults', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[JobDefaults]";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "[Department_Idn] ASC,[JobDefaultType_Idn] ASC,[Rank] ASC";
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
			$this->JobDefault_Idn->setDbValue($conn->insert_ID());
			$rs['JobDefault_Idn'] = $this->JobDefault_Idn->DbValue;
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
			if (array_key_exists('JobDefault_Idn', $rs))
				AddFilter($where, QuotedName('JobDefault_Idn', $this->Dbid) . '=' . QuotedValue($rs['JobDefault_Idn'], $this->JobDefault_Idn->DataType, $this->Dbid));
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
		$this->JobDefault_Idn->DbValue = $row['JobDefault_Idn'];
		$this->JobDefaultType_Idn->DbValue = $row['JobDefaultType_Idn'];
		$this->Department_Idn->DbValue = $row['Department_Idn'];
		$this->ParentJobDefault_Idn->DbValue = $row['ParentJobDefault_Idn'];
		$this->Name->DbValue = $row['Name'];
		$this->NumericValue->DbValue = $row['NumericValue'];
		$this->AlphaValue->DbValue = $row['AlphaValue'];
		$this->LoadFromJobDefault_Idn->DbValue = $row['LoadFromJobDefault_Idn'];
		$this->Rank->DbValue = $row['Rank'];
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
		return "[JobDefault_Idn] = @JobDefault_Idn@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('JobDefault_Idn', $row) ? $row['JobDefault_Idn'] : NULL;
		else
			$val = $this->JobDefault_Idn->OldValue !== NULL ? $this->JobDefault_Idn->OldValue : $this->JobDefault_Idn->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@JobDefault_Idn@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "JobDefaultslist.php";
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
		if ($pageName == "JobDefaultsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "JobDefaultsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "JobDefaultsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "JobDefaultslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("JobDefaultsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("JobDefaultsview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "JobDefaultsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "JobDefaultsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("JobDefaultsedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("JobDefaultsadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("JobDefaultsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "JobDefault_Idn:" . JsonEncode($this->JobDefault_Idn->CurrentValue, "number");
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
		if ($this->JobDefault_Idn->CurrentValue != NULL) {
			$url .= "JobDefault_Idn=" . urlencode($this->JobDefault_Idn->CurrentValue);
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
			if (Param("JobDefault_Idn") !== NULL)
				$arKeys[] = Param("JobDefault_Idn");
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
				$this->JobDefault_Idn->CurrentValue = $key;
			else
				$this->JobDefault_Idn->OldValue = $key;
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
		$this->JobDefault_Idn->setDbValue($rs->fields('JobDefault_Idn'));
		$this->JobDefaultType_Idn->setDbValue($rs->fields('JobDefaultType_Idn'));
		$this->Department_Idn->setDbValue($rs->fields('Department_Idn'));
		$this->ParentJobDefault_Idn->setDbValue($rs->fields('ParentJobDefault_Idn'));
		$this->Name->setDbValue($rs->fields('Name'));
		$this->NumericValue->setDbValue($rs->fields('NumericValue'));
		$this->AlphaValue->setDbValue($rs->fields('AlphaValue'));
		$this->LoadFromJobDefault_Idn->setDbValue($rs->fields('LoadFromJobDefault_Idn'));
		$this->Rank->setDbValue($rs->fields('Rank'));
		$this->ActiveFlag->setDbValue(ConvertToBool($rs->fields('ActiveFlag')) ? "1" : "0");
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// JobDefault_Idn
		// JobDefaultType_Idn
		// Department_Idn
		// ParentJobDefault_Idn
		// Name
		// NumericValue
		// AlphaValue
		// LoadFromJobDefault_Idn
		// Rank
		// ActiveFlag
		// JobDefault_Idn

		$this->JobDefault_Idn->ViewValue = $this->JobDefault_Idn->CurrentValue;
		$this->JobDefault_Idn->ViewCustomAttributes = "";

		// JobDefaultType_Idn
		$curVal = strval($this->JobDefaultType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->JobDefaultType_Idn->ViewValue = $this->JobDefaultType_Idn->lookupCacheOption($curVal);
			if ($this->JobDefaultType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[JobDefaultType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->JobDefaultType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->JobDefaultType_Idn->ViewValue = $this->JobDefaultType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->JobDefaultType_Idn->ViewValue = $this->JobDefaultType_Idn->CurrentValue;
				}
			}
		} else {
			$this->JobDefaultType_Idn->ViewValue = NULL;
		}
		$this->JobDefaultType_Idn->ViewCustomAttributes = "";

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

		// ParentJobDefault_Idn
		$this->ParentJobDefault_Idn->ViewValue = $this->ParentJobDefault_Idn->CurrentValue;
		$this->ParentJobDefault_Idn->ViewValue = FormatNumber($this->ParentJobDefault_Idn->ViewValue, 0, -2, -2, -2);
		$this->ParentJobDefault_Idn->ViewCustomAttributes = "";

		// Name
		$this->Name->ViewValue = $this->Name->CurrentValue;
		$this->Name->ViewCustomAttributes = "";

		// NumericValue
		$this->NumericValue->ViewValue = $this->NumericValue->CurrentValue;
		$this->NumericValue->ViewValue = FormatNumber($this->NumericValue->ViewValue, 2, -2, -2, -2);
		$this->NumericValue->ViewCustomAttributes = "";

		// AlphaValue
		$this->AlphaValue->ViewValue = $this->AlphaValue->CurrentValue;
		$this->AlphaValue->ViewCustomAttributes = "";

		// LoadFromJobDefault_Idn
		$curVal = strval($this->LoadFromJobDefault_Idn->CurrentValue);
		if ($curVal != "") {
			$this->LoadFromJobDefault_Idn->ViewValue = $this->LoadFromJobDefault_Idn->lookupCacheOption($curVal);
			if ($this->LoadFromJobDefault_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[JobDefault_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->LoadFromJobDefault_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->LoadFromJobDefault_Idn->ViewValue = $this->LoadFromJobDefault_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->LoadFromJobDefault_Idn->ViewValue = $this->LoadFromJobDefault_Idn->CurrentValue;
				}
			}
		} else {
			$this->LoadFromJobDefault_Idn->ViewValue = NULL;
		}
		$this->LoadFromJobDefault_Idn->ViewCustomAttributes = "";

		// Rank
		$this->Rank->ViewValue = $this->Rank->CurrentValue;
		$this->Rank->ViewValue = FormatNumber($this->Rank->ViewValue, 0, -2, -2, -2);
		$this->Rank->ViewCustomAttributes = "";

		// ActiveFlag
		if (ConvertToBool($this->ActiveFlag->CurrentValue)) {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(1) != "" ? $this->ActiveFlag->tagCaption(1) : "Yes";
		} else {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(2) != "" ? $this->ActiveFlag->tagCaption(2) : "No";
		}
		$this->ActiveFlag->ViewCustomAttributes = "";

		// JobDefault_Idn
		$this->JobDefault_Idn->LinkCustomAttributes = "";
		$this->JobDefault_Idn->HrefValue = "";
		$this->JobDefault_Idn->TooltipValue = "";

		// JobDefaultType_Idn
		$this->JobDefaultType_Idn->LinkCustomAttributes = "";
		$this->JobDefaultType_Idn->HrefValue = "";
		$this->JobDefaultType_Idn->TooltipValue = "";

		// Department_Idn
		$this->Department_Idn->LinkCustomAttributes = "";
		$this->Department_Idn->HrefValue = "";
		$this->Department_Idn->TooltipValue = "";

		// ParentJobDefault_Idn
		$this->ParentJobDefault_Idn->LinkCustomAttributes = "";
		$this->ParentJobDefault_Idn->HrefValue = "";
		$this->ParentJobDefault_Idn->TooltipValue = "";

		// Name
		$this->Name->LinkCustomAttributes = "";
		$this->Name->HrefValue = "";
		$this->Name->TooltipValue = "";

		// NumericValue
		$this->NumericValue->LinkCustomAttributes = "";
		$this->NumericValue->HrefValue = "";
		$this->NumericValue->TooltipValue = "";

		// AlphaValue
		$this->AlphaValue->LinkCustomAttributes = "";
		$this->AlphaValue->HrefValue = "";
		$this->AlphaValue->TooltipValue = "";

		// LoadFromJobDefault_Idn
		$this->LoadFromJobDefault_Idn->LinkCustomAttributes = "";
		$this->LoadFromJobDefault_Idn->HrefValue = "";
		$this->LoadFromJobDefault_Idn->TooltipValue = "";

		// Rank
		$this->Rank->LinkCustomAttributes = "";
		$this->Rank->HrefValue = "";
		$this->Rank->TooltipValue = "";

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

		// JobDefault_Idn
		$this->JobDefault_Idn->EditAttrs["class"] = "form-control";
		$this->JobDefault_Idn->EditCustomAttributes = "";
		$this->JobDefault_Idn->EditValue = $this->JobDefault_Idn->CurrentValue;
		$this->JobDefault_Idn->ViewCustomAttributes = "";

		// JobDefaultType_Idn
		$this->JobDefaultType_Idn->EditAttrs["class"] = "form-control";
		$this->JobDefaultType_Idn->EditCustomAttributes = "";

		// Department_Idn
		$this->Department_Idn->EditAttrs["class"] = "form-control";
		$this->Department_Idn->EditCustomAttributes = "";

		// ParentJobDefault_Idn
		$this->ParentJobDefault_Idn->EditAttrs["class"] = "form-control";
		$this->ParentJobDefault_Idn->EditCustomAttributes = "";
		$this->ParentJobDefault_Idn->EditValue = $this->ParentJobDefault_Idn->CurrentValue;
		$this->ParentJobDefault_Idn->PlaceHolder = RemoveHtml($this->ParentJobDefault_Idn->caption());

		// Name
		$this->Name->EditAttrs["class"] = "form-control";
		$this->Name->EditCustomAttributes = "";
		if (!$this->Name->Raw)
			$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
		$this->Name->EditValue = $this->Name->CurrentValue;
		$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

		// NumericValue
		$this->NumericValue->EditAttrs["class"] = "form-control";
		$this->NumericValue->EditCustomAttributes = "";
		$this->NumericValue->EditValue = $this->NumericValue->CurrentValue;
		$this->NumericValue->PlaceHolder = RemoveHtml($this->NumericValue->caption());
		if (strval($this->NumericValue->EditValue) != "" && is_numeric($this->NumericValue->EditValue))
			$this->NumericValue->EditValue = FormatNumber($this->NumericValue->EditValue, -2, -2, -2, -2);
		

		// AlphaValue
		$this->AlphaValue->EditAttrs["class"] = "form-control";
		$this->AlphaValue->EditCustomAttributes = "";
		if (!$this->AlphaValue->Raw)
			$this->AlphaValue->CurrentValue = HtmlDecode($this->AlphaValue->CurrentValue);
		$this->AlphaValue->EditValue = $this->AlphaValue->CurrentValue;
		$this->AlphaValue->PlaceHolder = RemoveHtml($this->AlphaValue->caption());

		// LoadFromJobDefault_Idn
		$this->LoadFromJobDefault_Idn->EditAttrs["class"] = "form-control";
		$this->LoadFromJobDefault_Idn->EditCustomAttributes = "";

		// Rank
		$this->Rank->EditAttrs["class"] = "form-control";
		$this->Rank->EditCustomAttributes = "";
		$this->Rank->EditValue = $this->Rank->CurrentValue;
		$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

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
					$doc->exportCaption($this->JobDefault_Idn);
					$doc->exportCaption($this->JobDefaultType_Idn);
					$doc->exportCaption($this->Department_Idn);
					$doc->exportCaption($this->ParentJobDefault_Idn);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->NumericValue);
					$doc->exportCaption($this->AlphaValue);
					$doc->exportCaption($this->LoadFromJobDefault_Idn);
					$doc->exportCaption($this->Rank);
					$doc->exportCaption($this->ActiveFlag);
				} else {
					$doc->exportCaption($this->JobDefault_Idn);
					$doc->exportCaption($this->JobDefaultType_Idn);
					$doc->exportCaption($this->Department_Idn);
					$doc->exportCaption($this->ParentJobDefault_Idn);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->NumericValue);
					$doc->exportCaption($this->AlphaValue);
					$doc->exportCaption($this->LoadFromJobDefault_Idn);
					$doc->exportCaption($this->Rank);
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
						$doc->exportField($this->JobDefault_Idn);
						$doc->exportField($this->JobDefaultType_Idn);
						$doc->exportField($this->Department_Idn);
						$doc->exportField($this->ParentJobDefault_Idn);
						$doc->exportField($this->Name);
						$doc->exportField($this->NumericValue);
						$doc->exportField($this->AlphaValue);
						$doc->exportField($this->LoadFromJobDefault_Idn);
						$doc->exportField($this->Rank);
						$doc->exportField($this->ActiveFlag);
					} else {
						$doc->exportField($this->JobDefault_Idn);
						$doc->exportField($this->JobDefaultType_Idn);
						$doc->exportField($this->Department_Idn);
						$doc->exportField($this->ParentJobDefault_Idn);
						$doc->exportField($this->Name);
						$doc->exportField($this->NumericValue);
						$doc->exportField($this->AlphaValue);
						$doc->exportField($this->LoadFromJobDefault_Idn);
						$doc->exportField($this->Rank);
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