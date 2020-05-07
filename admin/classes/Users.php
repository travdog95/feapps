<?php namespace PHPMaker2020\feapps51; ?>
<?php

/**
 * Table class for Users
 */
class Users extends DbTable
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
	public $User_Idn;
	public $FirstName;
	public $LastName;
	public $UserName;
	public $Department_Idn;
	public $_Email;
	public $Password;
	public $IsContractor;
	public $IsAdmin;
	public $ActiveFlag;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Users';
		$this->TableName = 'Users';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[Users]";
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

		// User_Idn
		$this->User_Idn = new DbField('Users', 'Users', 'x_User_Idn', 'User_Idn', '[User_Idn]', 'CAST([User_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[User_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->User_Idn->IsAutoIncrement = TRUE; // Autoincrement field
		$this->User_Idn->IsPrimaryKey = TRUE; // Primary key field
		$this->User_Idn->Nullable = FALSE; // NOT NULL field
		$this->User_Idn->Sortable = TRUE; // Allow sort
		$this->User_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['User_Idn'] = &$this->User_Idn;

		// FirstName
		$this->FirstName = new DbField('Users', 'Users', 'x_FirstName', 'FirstName', '[FirstName]', '[FirstName]', 200, 30, -1, FALSE, '[FirstName]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FirstName->Sortable = TRUE; // Allow sort
		$this->fields['FirstName'] = &$this->FirstName;

		// LastName
		$this->LastName = new DbField('Users', 'Users', 'x_LastName', 'LastName', '[LastName]', '[LastName]', 200, 50, -1, FALSE, '[LastName]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastName->Sortable = TRUE; // Allow sort
		$this->fields['LastName'] = &$this->LastName;

		// UserName
		$this->UserName = new DbField('Users', 'Users', 'x_UserName', 'UserName', '[UserName]', '[UserName]', 200, 16, -1, FALSE, '[UserName]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UserName->Sortable = TRUE; // Allow sort
		$this->fields['UserName'] = &$this->UserName;

		// Department_Idn
		$this->Department_Idn = new DbField('Users', 'Users', 'x_Department_Idn', 'Department_Idn', '[Department_Idn]', 'CAST([Department_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[Department_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Department_Idn->Required = TRUE; // Required field
		$this->Department_Idn->Sortable = TRUE; // Allow sort
		$this->Department_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Department_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->Department_Idn->Lookup = new Lookup('Department_Idn', 'jpr_Department', FALSE, 'DepartmentId', ["Description","","",""], [], [], [], [], [], [], '[Description] ASC', '');
		$this->Department_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Department_Idn'] = &$this->Department_Idn;

		// Email
		$this->_Email = new DbField('Users', 'Users', 'x__Email', 'Email', '[Email]', '[Email]', 200, 100, -1, FALSE, '[Email]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_Email->Sortable = TRUE; // Allow sort
		$this->fields['Email'] = &$this->_Email;

		// Password
		$this->Password = new DbField('Users', 'Users', 'x_Password', 'Password', '[Password]', '[Password]', 200, 16, -1, FALSE, '[Password]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Password->Sortable = TRUE; // Allow sort
		$this->fields['Password'] = &$this->Password;

		// IsContractor
		$this->IsContractor = new DbField('Users', 'Users', 'x_IsContractor', 'IsContractor', '[IsContractor]', '[IsContractor]', 11, 2, -1, FALSE, '[IsContractor]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->IsContractor->Sortable = TRUE; // Allow sort
		$this->IsContractor->DataType = DATATYPE_BOOLEAN;
		$this->IsContractor->Lookup = new Lookup('IsContractor', 'Users', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->IsContractor->OptionCount = 2;
		$this->fields['IsContractor'] = &$this->IsContractor;

		// IsAdmin
		$this->IsAdmin = new DbField('Users', 'Users', 'x_IsAdmin', 'IsAdmin', '[IsAdmin]', '[IsAdmin]', 11, 2, -1, FALSE, '[IsAdmin]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->IsAdmin->Sortable = TRUE; // Allow sort
		$this->IsAdmin->DataType = DATATYPE_BOOLEAN;
		$this->IsAdmin->Lookup = new Lookup('IsAdmin', 'Users', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->IsAdmin->OptionCount = 2;
		$this->fields['IsAdmin'] = &$this->IsAdmin;

		// ActiveFlag
		$this->ActiveFlag = new DbField('Users', 'Users', 'x_ActiveFlag', 'ActiveFlag', '[ActiveFlag]', '[ActiveFlag]', 11, 2, -1, FALSE, '[ActiveFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ActiveFlag->Sortable = TRUE; // Allow sort
		$this->ActiveFlag->DataType = DATATYPE_BOOLEAN;
		$this->ActiveFlag->Lookup = new Lookup('ActiveFlag', 'Users', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[Users]";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "[LastName] ASC,[FirstName] ASC";
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
			$this->User_Idn->setDbValue($conn->insert_ID());
			$rs['User_Idn'] = $this->User_Idn->DbValue;
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
			if (array_key_exists('User_Idn', $rs))
				AddFilter($where, QuotedName('User_Idn', $this->Dbid) . '=' . QuotedValue($rs['User_Idn'], $this->User_Idn->DataType, $this->Dbid));
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
		$this->User_Idn->DbValue = $row['User_Idn'];
		$this->FirstName->DbValue = $row['FirstName'];
		$this->LastName->DbValue = $row['LastName'];
		$this->UserName->DbValue = $row['UserName'];
		$this->Department_Idn->DbValue = $row['Department_Idn'];
		$this->_Email->DbValue = $row['Email'];
		$this->Password->DbValue = $row['Password'];
		$this->IsContractor->DbValue = (ConvertToBool($row['IsContractor']) ? "1" : "0");
		$this->IsAdmin->DbValue = (ConvertToBool($row['IsAdmin']) ? "1" : "0");
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
		return "[User_Idn] = @User_Idn@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('User_Idn', $row) ? $row['User_Idn'] : NULL;
		else
			$val = $this->User_Idn->OldValue !== NULL ? $this->User_Idn->OldValue : $this->User_Idn->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@User_Idn@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "Userslist.php";
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
		if ($pageName == "Usersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "Usersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "Usersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "Userslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("Usersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Usersview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "Usersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "Usersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("Usersedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("Usersadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("Usersdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "User_Idn:" . JsonEncode($this->User_Idn->CurrentValue, "number");
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
		if ($this->User_Idn->CurrentValue != NULL) {
			$url .= "User_Idn=" . urlencode($this->User_Idn->CurrentValue);
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
			if (Param("User_Idn") !== NULL)
				$arKeys[] = Param("User_Idn");
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
				$this->User_Idn->CurrentValue = $key;
			else
				$this->User_Idn->OldValue = $key;
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
		$this->User_Idn->setDbValue($rs->fields('User_Idn'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->LastName->setDbValue($rs->fields('LastName'));
		$this->UserName->setDbValue($rs->fields('UserName'));
		$this->Department_Idn->setDbValue($rs->fields('Department_Idn'));
		$this->_Email->setDbValue($rs->fields('Email'));
		$this->Password->setDbValue($rs->fields('Password'));
		$this->IsContractor->setDbValue(ConvertToBool($rs->fields('IsContractor')) ? "1" : "0");
		$this->IsAdmin->setDbValue(ConvertToBool($rs->fields('IsAdmin')) ? "1" : "0");
		$this->ActiveFlag->setDbValue(ConvertToBool($rs->fields('ActiveFlag')) ? "1" : "0");
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// User_Idn
		// FirstName
		// LastName
		// UserName
		// Department_Idn
		// Email
		// Password
		// IsContractor
		// IsAdmin
		// ActiveFlag
		// User_Idn

		$this->User_Idn->ViewValue = $this->User_Idn->CurrentValue;
		$this->User_Idn->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
		$this->FirstName->ViewCustomAttributes = "";

		// LastName
		$this->LastName->ViewValue = $this->LastName->CurrentValue;
		$this->LastName->ViewCustomAttributes = "";

		// UserName
		$this->UserName->ViewValue = $this->UserName->CurrentValue;
		$this->UserName->ViewCustomAttributes = "";

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

		// Email
		$this->_Email->ViewValue = $this->_Email->CurrentValue;
		$this->_Email->ViewCustomAttributes = "";

		// Password
		$this->Password->ViewValue = $this->Password->CurrentValue;
		$this->Password->ViewCustomAttributes = "";

		// IsContractor
		if (ConvertToBool($this->IsContractor->CurrentValue)) {
			$this->IsContractor->ViewValue = $this->IsContractor->tagCaption(1) != "" ? $this->IsContractor->tagCaption(1) : "Yes";
		} else {
			$this->IsContractor->ViewValue = $this->IsContractor->tagCaption(2) != "" ? $this->IsContractor->tagCaption(2) : "No";
		}
		$this->IsContractor->ViewCustomAttributes = "";

		// IsAdmin
		if (ConvertToBool($this->IsAdmin->CurrentValue)) {
			$this->IsAdmin->ViewValue = $this->IsAdmin->tagCaption(1) != "" ? $this->IsAdmin->tagCaption(1) : "Yes";
		} else {
			$this->IsAdmin->ViewValue = $this->IsAdmin->tagCaption(2) != "" ? $this->IsAdmin->tagCaption(2) : "No";
		}
		$this->IsAdmin->ViewCustomAttributes = "";

		// ActiveFlag
		if (ConvertToBool($this->ActiveFlag->CurrentValue)) {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(1) != "" ? $this->ActiveFlag->tagCaption(1) : "Yes";
		} else {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(2) != "" ? $this->ActiveFlag->tagCaption(2) : "No";
		}
		$this->ActiveFlag->ViewCustomAttributes = "";

		// User_Idn
		$this->User_Idn->LinkCustomAttributes = "";
		$this->User_Idn->HrefValue = "";
		$this->User_Idn->TooltipValue = "";

		// FirstName
		$this->FirstName->LinkCustomAttributes = "";
		$this->FirstName->HrefValue = "";
		$this->FirstName->TooltipValue = "";

		// LastName
		$this->LastName->LinkCustomAttributes = "";
		$this->LastName->HrefValue = "";
		$this->LastName->TooltipValue = "";

		// UserName
		$this->UserName->LinkCustomAttributes = "";
		$this->UserName->HrefValue = "";
		$this->UserName->TooltipValue = "";

		// Department_Idn
		$this->Department_Idn->LinkCustomAttributes = "";
		$this->Department_Idn->HrefValue = "";
		$this->Department_Idn->TooltipValue = "";

		// Email
		$this->_Email->LinkCustomAttributes = "";
		$this->_Email->HrefValue = "";
		$this->_Email->TooltipValue = "";

		// Password
		$this->Password->LinkCustomAttributes = "";
		$this->Password->HrefValue = "";
		$this->Password->TooltipValue = "";

		// IsContractor
		$this->IsContractor->LinkCustomAttributes = "";
		$this->IsContractor->HrefValue = "";
		$this->IsContractor->TooltipValue = "";

		// IsAdmin
		$this->IsAdmin->LinkCustomAttributes = "";
		$this->IsAdmin->HrefValue = "";
		$this->IsAdmin->TooltipValue = "";

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

		// User_Idn
		$this->User_Idn->EditAttrs["class"] = "form-control";
		$this->User_Idn->EditCustomAttributes = "";
		$this->User_Idn->EditValue = $this->User_Idn->CurrentValue;
		$this->User_Idn->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->EditAttrs["class"] = "form-control";
		$this->FirstName->EditCustomAttributes = "";
		if (!$this->FirstName->Raw)
			$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
		$this->FirstName->EditValue = $this->FirstName->CurrentValue;
		$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

		// LastName
		$this->LastName->EditAttrs["class"] = "form-control";
		$this->LastName->EditCustomAttributes = "";
		if (!$this->LastName->Raw)
			$this->LastName->CurrentValue = HtmlDecode($this->LastName->CurrentValue);
		$this->LastName->EditValue = $this->LastName->CurrentValue;
		$this->LastName->PlaceHolder = RemoveHtml($this->LastName->caption());

		// UserName
		$this->UserName->EditAttrs["class"] = "form-control";
		$this->UserName->EditCustomAttributes = "";
		if (!$this->UserName->Raw)
			$this->UserName->CurrentValue = HtmlDecode($this->UserName->CurrentValue);
		$this->UserName->EditValue = $this->UserName->CurrentValue;
		$this->UserName->PlaceHolder = RemoveHtml($this->UserName->caption());

		// Department_Idn
		$this->Department_Idn->EditAttrs["class"] = "form-control";
		$this->Department_Idn->EditCustomAttributes = "";

		// Email
		$this->_Email->EditAttrs["class"] = "form-control";
		$this->_Email->EditCustomAttributes = "";
		if (!$this->_Email->Raw)
			$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
		$this->_Email->EditValue = $this->_Email->CurrentValue;
		$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

		// Password
		$this->Password->EditAttrs["class"] = "form-control";
		$this->Password->EditCustomAttributes = "";
		if (!$this->Password->Raw)
			$this->Password->CurrentValue = HtmlDecode($this->Password->CurrentValue);
		$this->Password->EditValue = $this->Password->CurrentValue;
		$this->Password->PlaceHolder = RemoveHtml($this->Password->caption());

		// IsContractor
		$this->IsContractor->EditCustomAttributes = "";
		$this->IsContractor->EditValue = $this->IsContractor->options(FALSE);

		// IsAdmin
		$this->IsAdmin->EditCustomAttributes = "";
		$this->IsAdmin->EditValue = $this->IsAdmin->options(FALSE);

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
					$doc->exportCaption($this->User_Idn);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->LastName);
					$doc->exportCaption($this->UserName);
					$doc->exportCaption($this->Department_Idn);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->IsContractor);
					$doc->exportCaption($this->IsAdmin);
					$doc->exportCaption($this->ActiveFlag);
				} else {
					$doc->exportCaption($this->User_Idn);
					$doc->exportCaption($this->FirstName);
					$doc->exportCaption($this->LastName);
					$doc->exportCaption($this->UserName);
					$doc->exportCaption($this->Department_Idn);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->Password);
					$doc->exportCaption($this->IsContractor);
					$doc->exportCaption($this->IsAdmin);
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
						$doc->exportField($this->User_Idn);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->LastName);
						$doc->exportField($this->UserName);
						$doc->exportField($this->Department_Idn);
						$doc->exportField($this->_Email);
						$doc->exportField($this->IsContractor);
						$doc->exportField($this->IsAdmin);
						$doc->exportField($this->ActiveFlag);
					} else {
						$doc->exportField($this->User_Idn);
						$doc->exportField($this->FirstName);
						$doc->exportField($this->LastName);
						$doc->exportField($this->UserName);
						$doc->exportField($this->Department_Idn);
						$doc->exportField($this->_Email);
						$doc->exportField($this->Password);
						$doc->exportField($this->IsContractor);
						$doc->exportField($this->IsAdmin);
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