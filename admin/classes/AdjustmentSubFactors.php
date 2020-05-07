<?php namespace PHPMaker2020\feapps51; ?>
<?php

/**
 * Table class for AdjustmentSubFactors
 */
class AdjustmentSubFactors extends DbTable
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
	public $AdjustmentSubFactor_Idn;
	public $AdjustmentFactor_Idn;
	public $Name;
	public $Value;
	public $LaborClass_Idn;
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
		$this->TableVar = 'AdjustmentSubFactors';
		$this->TableName = 'AdjustmentSubFactors';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[AdjustmentSubFactors]";
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

		// AdjustmentSubFactor_Idn
		$this->AdjustmentSubFactor_Idn = new DbField('AdjustmentSubFactors', 'AdjustmentSubFactors', 'x_AdjustmentSubFactor_Idn', 'AdjustmentSubFactor_Idn', '[AdjustmentSubFactor_Idn]', 'CAST([AdjustmentSubFactor_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[AdjustmentSubFactor_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->AdjustmentSubFactor_Idn->IsAutoIncrement = TRUE; // Autoincrement field
		$this->AdjustmentSubFactor_Idn->IsPrimaryKey = TRUE; // Primary key field
		$this->AdjustmentSubFactor_Idn->Nullable = FALSE; // NOT NULL field
		$this->AdjustmentSubFactor_Idn->Sortable = TRUE; // Allow sort
		$this->AdjustmentSubFactor_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AdjustmentSubFactor_Idn'] = &$this->AdjustmentSubFactor_Idn;

		// AdjustmentFactor_Idn
		$this->AdjustmentFactor_Idn = new DbField('AdjustmentSubFactors', 'AdjustmentSubFactors', 'x_AdjustmentFactor_Idn', 'AdjustmentFactor_Idn', '[AdjustmentFactor_Idn]', 'CAST([AdjustmentFactor_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[AdjustmentFactor_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->AdjustmentFactor_Idn->IsForeignKey = TRUE; // Foreign key field
		$this->AdjustmentFactor_Idn->Required = TRUE; // Required field
		$this->AdjustmentFactor_Idn->Sortable = TRUE; // Allow sort
		$this->AdjustmentFactor_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->AdjustmentFactor_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->AdjustmentFactor_Idn->Lookup = new Lookup('AdjustmentFactor_Idn', 'AdjustmentFactors', FALSE, 'AdjustmentFactor_Idn', ["Name","","",""], [], [], [], [], [], [], '[Rank] ASC', '');
		$this->AdjustmentFactor_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AdjustmentFactor_Idn'] = &$this->AdjustmentFactor_Idn;

		// Name
		$this->Name = new DbField('AdjustmentSubFactors', 'AdjustmentSubFactors', 'x_Name', 'Name', '[Name]', '[Name]', 200, 100, -1, FALSE, '[Name]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Name->Sortable = TRUE; // Allow sort
		$this->fields['Name'] = &$this->Name;

		// Value
		$this->Value = new DbField('AdjustmentSubFactors', 'AdjustmentSubFactors', 'x_Value', 'Value', '[Value]', 'CAST([Value] AS NVARCHAR)', 131, 8, -1, FALSE, '[Value]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Value->Sortable = TRUE; // Allow sort
		$this->Value->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Value'] = &$this->Value;

		// LaborClass_Idn
		$this->LaborClass_Idn = new DbField('AdjustmentSubFactors', 'AdjustmentSubFactors', 'x_LaborClass_Idn', 'LaborClass_Idn', '[LaborClass_Idn]', 'CAST([LaborClass_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[LaborClass_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->LaborClass_Idn->Sortable = TRUE; // Allow sort
		$this->LaborClass_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->LaborClass_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->LaborClass_Idn->Lookup = new Lookup('LaborClass_Idn', 'AdjustmentSubFactors', FALSE, 'AdjustmentSubFactor_Idn', ["Name","","",""], [], [], [], [], [], [], '[Name] ASC', '');
		$this->LaborClass_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['LaborClass_Idn'] = &$this->LaborClass_Idn;

		// Rank
		$this->Rank = new DbField('AdjustmentSubFactors', 'AdjustmentSubFactors', 'x_Rank', 'Rank', '[Rank]', 'CAST([Rank] AS NVARCHAR)', 3, 4, -1, FALSE, '[Rank]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Rank->Sortable = TRUE; // Allow sort
		$this->Rank->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Rank'] = &$this->Rank;

		// ActiveFlag
		$this->ActiveFlag = new DbField('AdjustmentSubFactors', 'AdjustmentSubFactors', 'x_ActiveFlag', 'ActiveFlag', '[ActiveFlag]', '[ActiveFlag]', 11, 2, -1, FALSE, '[ActiveFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ActiveFlag->Sortable = TRUE; // Allow sort
		$this->ActiveFlag->DataType = DATATYPE_BOOLEAN;
		$this->ActiveFlag->Lookup = new Lookup('ActiveFlag', 'AdjustmentSubFactors', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
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
		if ($this->getCurrentMasterTable() == "AdjustmentFactors") {
			if ($this->AdjustmentFactor_Idn->getSessionValue() != "")
				$masterFilter .= "[AdjustmentFactor_Idn]=" . QuotedValue($this->AdjustmentFactor_Idn->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "AdjustmentFactors") {
			if ($this->AdjustmentFactor_Idn->getSessionValue() != "")
				$detailFilter .= "[AdjustmentFactor_Idn]=" . QuotedValue($this->AdjustmentFactor_Idn->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_AdjustmentFactors()
	{
		return "[AdjustmentFactor_Idn]=@AdjustmentFactor_Idn@";
	}

	// Detail filter
	public function sqlDetailFilter_AdjustmentFactors()
	{
		return "[AdjustmentFactor_Idn]=@AdjustmentFactor_Idn@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[AdjustmentSubFactors]";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "[AdjustmentFactor_Idn] ASC,[Rank] ASC";
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
			$this->AdjustmentSubFactor_Idn->setDbValue($conn->insert_ID());
			$rs['AdjustmentSubFactor_Idn'] = $this->AdjustmentSubFactor_Idn->DbValue;
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
			if (array_key_exists('AdjustmentSubFactor_Idn', $rs))
				AddFilter($where, QuotedName('AdjustmentSubFactor_Idn', $this->Dbid) . '=' . QuotedValue($rs['AdjustmentSubFactor_Idn'], $this->AdjustmentSubFactor_Idn->DataType, $this->Dbid));
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
		$this->AdjustmentSubFactor_Idn->DbValue = $row['AdjustmentSubFactor_Idn'];
		$this->AdjustmentFactor_Idn->DbValue = $row['AdjustmentFactor_Idn'];
		$this->Name->DbValue = $row['Name'];
		$this->Value->DbValue = $row['Value'];
		$this->LaborClass_Idn->DbValue = $row['LaborClass_Idn'];
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
		return "[AdjustmentSubFactor_Idn] = @AdjustmentSubFactor_Idn@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('AdjustmentSubFactor_Idn', $row) ? $row['AdjustmentSubFactor_Idn'] : NULL;
		else
			$val = $this->AdjustmentSubFactor_Idn->OldValue !== NULL ? $this->AdjustmentSubFactor_Idn->OldValue : $this->AdjustmentSubFactor_Idn->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@AdjustmentSubFactor_Idn@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "AdjustmentSubFactorslist.php";
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
		if ($pageName == "AdjustmentSubFactorsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "AdjustmentSubFactorsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "AdjustmentSubFactorsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "AdjustmentSubFactorslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("AdjustmentSubFactorsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("AdjustmentSubFactorsview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "AdjustmentSubFactorsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "AdjustmentSubFactorsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("AdjustmentSubFactorsedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("AdjustmentSubFactorsadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("AdjustmentSubFactorsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "AdjustmentFactors" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_AdjustmentFactor_Idn=" . urlencode($this->AdjustmentFactor_Idn->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "AdjustmentSubFactor_Idn:" . JsonEncode($this->AdjustmentSubFactor_Idn->CurrentValue, "number");
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
		if ($this->AdjustmentSubFactor_Idn->CurrentValue != NULL) {
			$url .= "AdjustmentSubFactor_Idn=" . urlencode($this->AdjustmentSubFactor_Idn->CurrentValue);
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
			if (Param("AdjustmentSubFactor_Idn") !== NULL)
				$arKeys[] = Param("AdjustmentSubFactor_Idn");
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
				$this->AdjustmentSubFactor_Idn->CurrentValue = $key;
			else
				$this->AdjustmentSubFactor_Idn->OldValue = $key;
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
		$this->AdjustmentSubFactor_Idn->setDbValue($rs->fields('AdjustmentSubFactor_Idn'));
		$this->AdjustmentFactor_Idn->setDbValue($rs->fields('AdjustmentFactor_Idn'));
		$this->Name->setDbValue($rs->fields('Name'));
		$this->Value->setDbValue($rs->fields('Value'));
		$this->LaborClass_Idn->setDbValue($rs->fields('LaborClass_Idn'));
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
		// AdjustmentSubFactor_Idn
		// AdjustmentFactor_Idn
		// Name
		// Value
		// LaborClass_Idn
		// Rank
		// ActiveFlag
		// AdjustmentSubFactor_Idn

		$this->AdjustmentSubFactor_Idn->ViewValue = $this->AdjustmentSubFactor_Idn->CurrentValue;
		$this->AdjustmentSubFactor_Idn->ViewCustomAttributes = "";

		// AdjustmentFactor_Idn
		$curVal = strval($this->AdjustmentFactor_Idn->CurrentValue);
		if ($curVal != "") {
			$this->AdjustmentFactor_Idn->ViewValue = $this->AdjustmentFactor_Idn->lookupCacheOption($curVal);
			if ($this->AdjustmentFactor_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[AdjustmentFactor_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->AdjustmentFactor_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->AdjustmentFactor_Idn->ViewValue = $this->AdjustmentFactor_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->AdjustmentFactor_Idn->ViewValue = $this->AdjustmentFactor_Idn->CurrentValue;
				}
			}
		} else {
			$this->AdjustmentFactor_Idn->ViewValue = NULL;
		}
		$this->AdjustmentFactor_Idn->ViewCustomAttributes = "";

		// Name
		$this->Name->ViewValue = $this->Name->CurrentValue;
		$this->Name->ViewCustomAttributes = "";

		// Value
		$this->Value->ViewValue = $this->Value->CurrentValue;
		$this->Value->ViewValue = FormatNumber($this->Value->ViewValue, 2, -2, -2, -2);
		$this->Value->ViewCustomAttributes = "";

		// LaborClass_Idn
		$curVal = strval($this->LaborClass_Idn->CurrentValue);
		if ($curVal != "") {
			$this->LaborClass_Idn->ViewValue = $this->LaborClass_Idn->lookupCacheOption($curVal);
			if ($this->LaborClass_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[AdjustmentSubFactor_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[AdjustmentFactor_Idn] = 21";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->LaborClass_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->LaborClass_Idn->ViewValue = $this->LaborClass_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->LaborClass_Idn->ViewValue = $this->LaborClass_Idn->CurrentValue;
				}
			}
		} else {
			$this->LaborClass_Idn->ViewValue = NULL;
		}
		$this->LaborClass_Idn->ViewCustomAttributes = "";

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

		// AdjustmentSubFactor_Idn
		$this->AdjustmentSubFactor_Idn->LinkCustomAttributes = "";
		$this->AdjustmentSubFactor_Idn->HrefValue = "";
		$this->AdjustmentSubFactor_Idn->TooltipValue = "";

		// AdjustmentFactor_Idn
		$this->AdjustmentFactor_Idn->LinkCustomAttributes = "";
		$this->AdjustmentFactor_Idn->HrefValue = "";
		$this->AdjustmentFactor_Idn->TooltipValue = "";

		// Name
		$this->Name->LinkCustomAttributes = "";
		$this->Name->HrefValue = "";
		$this->Name->TooltipValue = "";

		// Value
		$this->Value->LinkCustomAttributes = "";
		$this->Value->HrefValue = "";
		$this->Value->TooltipValue = "";

		// LaborClass_Idn
		$this->LaborClass_Idn->LinkCustomAttributes = "";
		$this->LaborClass_Idn->HrefValue = "";
		$this->LaborClass_Idn->TooltipValue = "";

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

		// AdjustmentSubFactor_Idn
		$this->AdjustmentSubFactor_Idn->EditAttrs["class"] = "form-control";
		$this->AdjustmentSubFactor_Idn->EditCustomAttributes = "";
		$this->AdjustmentSubFactor_Idn->EditValue = $this->AdjustmentSubFactor_Idn->CurrentValue;
		$this->AdjustmentSubFactor_Idn->ViewCustomAttributes = "";

		// AdjustmentFactor_Idn
		$this->AdjustmentFactor_Idn->EditAttrs["class"] = "form-control";
		$this->AdjustmentFactor_Idn->EditCustomAttributes = "";
		if ($this->AdjustmentFactor_Idn->getSessionValue() != "") {
			$this->AdjustmentFactor_Idn->CurrentValue = $this->AdjustmentFactor_Idn->getSessionValue();
			$curVal = strval($this->AdjustmentFactor_Idn->CurrentValue);
			if ($curVal != "") {
				$this->AdjustmentFactor_Idn->ViewValue = $this->AdjustmentFactor_Idn->lookupCacheOption($curVal);
				if ($this->AdjustmentFactor_Idn->ViewValue === NULL) { // Lookup from database
					$filterWrk = "[AdjustmentFactor_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->AdjustmentFactor_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AdjustmentFactor_Idn->ViewValue = $this->AdjustmentFactor_Idn->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AdjustmentFactor_Idn->ViewValue = $this->AdjustmentFactor_Idn->CurrentValue;
					}
				}
			} else {
				$this->AdjustmentFactor_Idn->ViewValue = NULL;
			}
			$this->AdjustmentFactor_Idn->ViewCustomAttributes = "";
		} else {
		}

		// Name
		$this->Name->EditAttrs["class"] = "form-control";
		$this->Name->EditCustomAttributes = "";
		if (!$this->Name->Raw)
			$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
		$this->Name->EditValue = $this->Name->CurrentValue;
		$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

		// Value
		$this->Value->EditAttrs["class"] = "form-control";
		$this->Value->EditCustomAttributes = "";
		$this->Value->EditValue = $this->Value->CurrentValue;
		$this->Value->PlaceHolder = RemoveHtml($this->Value->caption());
		if (strval($this->Value->EditValue) != "" && is_numeric($this->Value->EditValue))
			$this->Value->EditValue = FormatNumber($this->Value->EditValue, -2, -2, -2, -2);
		

		// LaborClass_Idn
		$this->LaborClass_Idn->EditAttrs["class"] = "form-control";
		$this->LaborClass_Idn->EditCustomAttributes = "";

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
					$doc->exportCaption($this->AdjustmentSubFactor_Idn);
					$doc->exportCaption($this->AdjustmentFactor_Idn);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->Value);
					$doc->exportCaption($this->LaborClass_Idn);
					$doc->exportCaption($this->Rank);
					$doc->exportCaption($this->ActiveFlag);
				} else {
					$doc->exportCaption($this->AdjustmentSubFactor_Idn);
					$doc->exportCaption($this->AdjustmentFactor_Idn);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->Value);
					$doc->exportCaption($this->LaborClass_Idn);
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
						$doc->exportField($this->AdjustmentSubFactor_Idn);
						$doc->exportField($this->AdjustmentFactor_Idn);
						$doc->exportField($this->Name);
						$doc->exportField($this->Value);
						$doc->exportField($this->LaborClass_Idn);
						$doc->exportField($this->Rank);
						$doc->exportField($this->ActiveFlag);
					} else {
						$doc->exportField($this->AdjustmentSubFactor_Idn);
						$doc->exportField($this->AdjustmentFactor_Idn);
						$doc->exportField($this->Name);
						$doc->exportField($this->Value);
						$doc->exportField($this->LaborClass_Idn);
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