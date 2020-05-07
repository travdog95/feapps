<?php namespace PHPMaker2020\feapps51; ?>
<?php

/**
 * Table class for Menus
 */
class Menus extends DbTable
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
	public $Menu_Idn;
	public $Name;
	public $ShortName;
	public $Link;
	public $Icon;
	public $MenuType_Idn;
	public $Rank;
	public $ChildMenuType_Idn;
	public $IsParent;
	public $AdminOnly;
	public $ActiveFlag;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Menus';
		$this->TableName = 'Menus';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[Menus]";
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

		// Menu_Idn
		$this->Menu_Idn = new DbField('Menus', 'Menus', 'x_Menu_Idn', 'Menu_Idn', '[Menu_Idn]', 'CAST([Menu_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[Menu_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->Menu_Idn->IsAutoIncrement = TRUE; // Autoincrement field
		$this->Menu_Idn->IsPrimaryKey = TRUE; // Primary key field
		$this->Menu_Idn->Nullable = FALSE; // NOT NULL field
		$this->Menu_Idn->Sortable = TRUE; // Allow sort
		$this->Menu_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Menu_Idn'] = &$this->Menu_Idn;

		// Name
		$this->Name = new DbField('Menus', 'Menus', 'x_Name', 'Name', '[Name]', '[Name]', 200, 50, -1, FALSE, '[Name]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Name->Sortable = TRUE; // Allow sort
		$this->fields['Name'] = &$this->Name;

		// ShortName
		$this->ShortName = new DbField('Menus', 'Menus', 'x_ShortName', 'ShortName', '[ShortName]', '[ShortName]', 200, 20, -1, FALSE, '[ShortName]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ShortName->Sortable = TRUE; // Allow sort
		$this->fields['ShortName'] = &$this->ShortName;

		// Link
		$this->Link = new DbField('Menus', 'Menus', 'x_Link', 'Link', '[Link]', '[Link]', 200, 255, -1, FALSE, '[Link]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Link->Sortable = TRUE; // Allow sort
		$this->fields['Link'] = &$this->Link;

		// Icon
		$this->Icon = new DbField('Menus', 'Menus', 'x_Icon', 'Icon', '[Icon]', '[Icon]', 200, 50, -1, FALSE, '[Icon]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Icon->Sortable = TRUE; // Allow sort
		$this->fields['Icon'] = &$this->Icon;

		// MenuType_Idn
		$this->MenuType_Idn = new DbField('Menus', 'Menus', 'x_MenuType_Idn', 'MenuType_Idn', '[MenuType_Idn]', 'CAST([MenuType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[MenuType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->MenuType_Idn->Required = TRUE; // Required field
		$this->MenuType_Idn->Sortable = TRUE; // Allow sort
		$this->MenuType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->MenuType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->MenuType_Idn->Lookup = new Lookup('MenuType_Idn', 'MenuTypes', FALSE, 'MenuType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Rank] ASC', '');
		$this->MenuType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MenuType_Idn'] = &$this->MenuType_Idn;

		// Rank
		$this->Rank = new DbField('Menus', 'Menus', 'x_Rank', 'Rank', '[Rank]', 'CAST([Rank] AS NVARCHAR)', 3, 4, -1, FALSE, '[Rank]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Rank->Sortable = TRUE; // Allow sort
		$this->Rank->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Rank'] = &$this->Rank;

		// ChildMenuType_Idn
		$this->ChildMenuType_Idn = new DbField('Menus', 'Menus', 'x_ChildMenuType_Idn', 'ChildMenuType_Idn', '[ChildMenuType_Idn]', 'CAST([ChildMenuType_Idn] AS NVARCHAR)', 3, 4, -1, FALSE, '[ChildMenuType_Idn]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ChildMenuType_Idn->Sortable = TRUE; // Allow sort
		$this->ChildMenuType_Idn->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ChildMenuType_Idn->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ChildMenuType_Idn->Lookup = new Lookup('ChildMenuType_Idn', 'MenuTypes', FALSE, 'MenuType_Idn', ["Name","","",""], [], [], [], [], [], [], '[Rank] ASC', '');
		$this->ChildMenuType_Idn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChildMenuType_Idn'] = &$this->ChildMenuType_Idn;

		// IsParent
		$this->IsParent = new DbField('Menus', 'Menus', 'x_IsParent', 'IsParent', '[IsParent]', '[IsParent]', 11, 2, -1, FALSE, '[IsParent]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->IsParent->Sortable = TRUE; // Allow sort
		$this->IsParent->DataType = DATATYPE_BOOLEAN;
		$this->IsParent->Lookup = new Lookup('IsParent', 'Menus', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->IsParent->OptionCount = 2;
		$this->fields['IsParent'] = &$this->IsParent;

		// AdminOnly
		$this->AdminOnly = new DbField('Menus', 'Menus', 'x_AdminOnly', 'AdminOnly', '[AdminOnly]', '[AdminOnly]', 11, 2, -1, FALSE, '[AdminOnly]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->AdminOnly->Sortable = TRUE; // Allow sort
		$this->AdminOnly->DataType = DATATYPE_BOOLEAN;
		$this->AdminOnly->Lookup = new Lookup('AdminOnly', 'Menus', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->AdminOnly->OptionCount = 2;
		$this->fields['AdminOnly'] = &$this->AdminOnly;

		// ActiveFlag
		$this->ActiveFlag = new DbField('Menus', 'Menus', 'x_ActiveFlag', 'ActiveFlag', '[ActiveFlag]', '[ActiveFlag]', 11, 2, -1, FALSE, '[ActiveFlag]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->ActiveFlag->Sortable = TRUE; // Allow sort
		$this->ActiveFlag->DataType = DATATYPE_BOOLEAN;
		$this->ActiveFlag->Lookup = new Lookup('ActiveFlag', 'Menus', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[Menus]";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "[MenuType_Idn] ASC,[Rank] ASC";
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
			$this->Menu_Idn->setDbValue($conn->insert_ID());
			$rs['Menu_Idn'] = $this->Menu_Idn->DbValue;
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
			if (array_key_exists('Menu_Idn', $rs))
				AddFilter($where, QuotedName('Menu_Idn', $this->Dbid) . '=' . QuotedValue($rs['Menu_Idn'], $this->Menu_Idn->DataType, $this->Dbid));
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
		$this->Menu_Idn->DbValue = $row['Menu_Idn'];
		$this->Name->DbValue = $row['Name'];
		$this->ShortName->DbValue = $row['ShortName'];
		$this->Link->DbValue = $row['Link'];
		$this->Icon->DbValue = $row['Icon'];
		$this->MenuType_Idn->DbValue = $row['MenuType_Idn'];
		$this->Rank->DbValue = $row['Rank'];
		$this->ChildMenuType_Idn->DbValue = $row['ChildMenuType_Idn'];
		$this->IsParent->DbValue = (ConvertToBool($row['IsParent']) ? "1" : "0");
		$this->AdminOnly->DbValue = (ConvertToBool($row['AdminOnly']) ? "1" : "0");
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
		return "[Menu_Idn] = @Menu_Idn@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('Menu_Idn', $row) ? $row['Menu_Idn'] : NULL;
		else
			$val = $this->Menu_Idn->OldValue !== NULL ? $this->Menu_Idn->OldValue : $this->Menu_Idn->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@Menu_Idn@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "Menuslist.php";
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
		if ($pageName == "Menusview.php")
			return $Language->phrase("View");
		elseif ($pageName == "Menusedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "Menusadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "Menuslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("Menusview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Menusview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "Menusadd.php?" . $this->getUrlParm($parm);
		else
			$url = "Menusadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("Menusedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("Menusadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("Menusdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "Menu_Idn:" . JsonEncode($this->Menu_Idn->CurrentValue, "number");
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
		if ($this->Menu_Idn->CurrentValue != NULL) {
			$url .= "Menu_Idn=" . urlencode($this->Menu_Idn->CurrentValue);
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
			if (Param("Menu_Idn") !== NULL)
				$arKeys[] = Param("Menu_Idn");
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
				$this->Menu_Idn->CurrentValue = $key;
			else
				$this->Menu_Idn->OldValue = $key;
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
		$this->Menu_Idn->setDbValue($rs->fields('Menu_Idn'));
		$this->Name->setDbValue($rs->fields('Name'));
		$this->ShortName->setDbValue($rs->fields('ShortName'));
		$this->Link->setDbValue($rs->fields('Link'));
		$this->Icon->setDbValue($rs->fields('Icon'));
		$this->MenuType_Idn->setDbValue($rs->fields('MenuType_Idn'));
		$this->Rank->setDbValue($rs->fields('Rank'));
		$this->ChildMenuType_Idn->setDbValue($rs->fields('ChildMenuType_Idn'));
		$this->IsParent->setDbValue(ConvertToBool($rs->fields('IsParent')) ? "1" : "0");
		$this->AdminOnly->setDbValue(ConvertToBool($rs->fields('AdminOnly')) ? "1" : "0");
		$this->ActiveFlag->setDbValue(ConvertToBool($rs->fields('ActiveFlag')) ? "1" : "0");
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// Menu_Idn
		// Name
		// ShortName
		// Link
		// Icon
		// MenuType_Idn
		// Rank
		// ChildMenuType_Idn
		// IsParent
		// AdminOnly
		// ActiveFlag
		// Menu_Idn

		$this->Menu_Idn->ViewValue = $this->Menu_Idn->CurrentValue;
		$this->Menu_Idn->ViewCustomAttributes = "";

		// Name
		$this->Name->ViewValue = $this->Name->CurrentValue;
		$this->Name->ViewCustomAttributes = "";

		// ShortName
		$this->ShortName->ViewValue = $this->ShortName->CurrentValue;
		$this->ShortName->ViewCustomAttributes = "";

		// Link
		$this->Link->ViewValue = $this->Link->CurrentValue;
		$this->Link->ViewCustomAttributes = "";

		// Icon
		$this->Icon->ViewValue = $this->Icon->CurrentValue;
		$this->Icon->ViewCustomAttributes = "";

		// MenuType_Idn
		$curVal = strval($this->MenuType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->MenuType_Idn->ViewValue = $this->MenuType_Idn->lookupCacheOption($curVal);
			if ($this->MenuType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[MenuType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->MenuType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->MenuType_Idn->ViewValue = $this->MenuType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->MenuType_Idn->ViewValue = $this->MenuType_Idn->CurrentValue;
				}
			}
		} else {
			$this->MenuType_Idn->ViewValue = NULL;
		}
		$this->MenuType_Idn->ViewCustomAttributes = "";

		// Rank
		$this->Rank->ViewValue = $this->Rank->CurrentValue;
		$this->Rank->ViewValue = FormatNumber($this->Rank->ViewValue, 0, -2, -2, -2);
		$this->Rank->ViewCustomAttributes = "";

		// ChildMenuType_Idn
		$curVal = strval($this->ChildMenuType_Idn->CurrentValue);
		if ($curVal != "") {
			$this->ChildMenuType_Idn->ViewValue = $this->ChildMenuType_Idn->lookupCacheOption($curVal);
			if ($this->ChildMenuType_Idn->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[MenuType_Idn]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ChildMenuType_Idn->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ChildMenuType_Idn->ViewValue = $this->ChildMenuType_Idn->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ChildMenuType_Idn->ViewValue = $this->ChildMenuType_Idn->CurrentValue;
				}
			}
		} else {
			$this->ChildMenuType_Idn->ViewValue = NULL;
		}
		$this->ChildMenuType_Idn->ViewCustomAttributes = "";

		// IsParent
		if (ConvertToBool($this->IsParent->CurrentValue)) {
			$this->IsParent->ViewValue = $this->IsParent->tagCaption(1) != "" ? $this->IsParent->tagCaption(1) : "Yes";
		} else {
			$this->IsParent->ViewValue = $this->IsParent->tagCaption(2) != "" ? $this->IsParent->tagCaption(2) : "No";
		}
		$this->IsParent->ViewCustomAttributes = "";

		// AdminOnly
		if (ConvertToBool($this->AdminOnly->CurrentValue)) {
			$this->AdminOnly->ViewValue = $this->AdminOnly->tagCaption(1) != "" ? $this->AdminOnly->tagCaption(1) : "Yes";
		} else {
			$this->AdminOnly->ViewValue = $this->AdminOnly->tagCaption(2) != "" ? $this->AdminOnly->tagCaption(2) : "No";
		}
		$this->AdminOnly->ViewCustomAttributes = "";

		// ActiveFlag
		if (ConvertToBool($this->ActiveFlag->CurrentValue)) {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(1) != "" ? $this->ActiveFlag->tagCaption(1) : "Yes";
		} else {
			$this->ActiveFlag->ViewValue = $this->ActiveFlag->tagCaption(2) != "" ? $this->ActiveFlag->tagCaption(2) : "No";
		}
		$this->ActiveFlag->ViewCustomAttributes = "";

		// Menu_Idn
		$this->Menu_Idn->LinkCustomAttributes = "";
		$this->Menu_Idn->HrefValue = "";
		$this->Menu_Idn->TooltipValue = "";

		// Name
		$this->Name->LinkCustomAttributes = "";
		$this->Name->HrefValue = "";
		$this->Name->TooltipValue = "";

		// ShortName
		$this->ShortName->LinkCustomAttributes = "";
		$this->ShortName->HrefValue = "";
		$this->ShortName->TooltipValue = "";

		// Link
		$this->Link->LinkCustomAttributes = "";
		$this->Link->HrefValue = "";
		$this->Link->TooltipValue = "";

		// Icon
		$this->Icon->LinkCustomAttributes = "";
		$this->Icon->HrefValue = "";
		$this->Icon->TooltipValue = "";

		// MenuType_Idn
		$this->MenuType_Idn->LinkCustomAttributes = "";
		$this->MenuType_Idn->HrefValue = "";
		$this->MenuType_Idn->TooltipValue = "";

		// Rank
		$this->Rank->LinkCustomAttributes = "";
		$this->Rank->HrefValue = "";
		$this->Rank->TooltipValue = "";

		// ChildMenuType_Idn
		$this->ChildMenuType_Idn->LinkCustomAttributes = "";
		$this->ChildMenuType_Idn->HrefValue = "";
		$this->ChildMenuType_Idn->TooltipValue = "";

		// IsParent
		$this->IsParent->LinkCustomAttributes = "";
		$this->IsParent->HrefValue = "";
		$this->IsParent->TooltipValue = "";

		// AdminOnly
		$this->AdminOnly->LinkCustomAttributes = "";
		$this->AdminOnly->HrefValue = "";
		$this->AdminOnly->TooltipValue = "";

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

		// Menu_Idn
		$this->Menu_Idn->EditAttrs["class"] = "form-control";
		$this->Menu_Idn->EditCustomAttributes = "";
		$this->Menu_Idn->EditValue = $this->Menu_Idn->CurrentValue;
		$this->Menu_Idn->ViewCustomAttributes = "";

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

		// Link
		$this->Link->EditAttrs["class"] = "form-control";
		$this->Link->EditCustomAttributes = "";
		if (!$this->Link->Raw)
			$this->Link->CurrentValue = HtmlDecode($this->Link->CurrentValue);
		$this->Link->EditValue = $this->Link->CurrentValue;
		$this->Link->PlaceHolder = RemoveHtml($this->Link->caption());

		// Icon
		$this->Icon->EditAttrs["class"] = "form-control";
		$this->Icon->EditCustomAttributes = "";
		if (!$this->Icon->Raw)
			$this->Icon->CurrentValue = HtmlDecode($this->Icon->CurrentValue);
		$this->Icon->EditValue = $this->Icon->CurrentValue;
		$this->Icon->PlaceHolder = RemoveHtml($this->Icon->caption());

		// MenuType_Idn
		$this->MenuType_Idn->EditAttrs["class"] = "form-control";
		$this->MenuType_Idn->EditCustomAttributes = "";

		// Rank
		$this->Rank->EditAttrs["class"] = "form-control";
		$this->Rank->EditCustomAttributes = "";
		$this->Rank->EditValue = $this->Rank->CurrentValue;
		$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

		// ChildMenuType_Idn
		$this->ChildMenuType_Idn->EditAttrs["class"] = "form-control";
		$this->ChildMenuType_Idn->EditCustomAttributes = "";

		// IsParent
		$this->IsParent->EditCustomAttributes = "";
		$this->IsParent->EditValue = $this->IsParent->options(FALSE);

		// AdminOnly
		$this->AdminOnly->EditCustomAttributes = "";
		$this->AdminOnly->EditValue = $this->AdminOnly->options(FALSE);

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
					$doc->exportCaption($this->Menu_Idn);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->ShortName);
					$doc->exportCaption($this->Link);
					$doc->exportCaption($this->Icon);
					$doc->exportCaption($this->MenuType_Idn);
					$doc->exportCaption($this->Rank);
					$doc->exportCaption($this->ChildMenuType_Idn);
					$doc->exportCaption($this->IsParent);
					$doc->exportCaption($this->AdminOnly);
					$doc->exportCaption($this->ActiveFlag);
				} else {
					$doc->exportCaption($this->Menu_Idn);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->ShortName);
					$doc->exportCaption($this->Link);
					$doc->exportCaption($this->Icon);
					$doc->exportCaption($this->MenuType_Idn);
					$doc->exportCaption($this->Rank);
					$doc->exportCaption($this->ChildMenuType_Idn);
					$doc->exportCaption($this->IsParent);
					$doc->exportCaption($this->AdminOnly);
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
						$doc->exportField($this->Menu_Idn);
						$doc->exportField($this->Name);
						$doc->exportField($this->ShortName);
						$doc->exportField($this->Link);
						$doc->exportField($this->Icon);
						$doc->exportField($this->MenuType_Idn);
						$doc->exportField($this->Rank);
						$doc->exportField($this->ChildMenuType_Idn);
						$doc->exportField($this->IsParent);
						$doc->exportField($this->AdminOnly);
						$doc->exportField($this->ActiveFlag);
					} else {
						$doc->exportField($this->Menu_Idn);
						$doc->exportField($this->Name);
						$doc->exportField($this->ShortName);
						$doc->exportField($this->Link);
						$doc->exportField($this->Icon);
						$doc->exportField($this->MenuType_Idn);
						$doc->exportField($this->Rank);
						$doc->exportField($this->ChildMenuType_Idn);
						$doc->exportField($this->IsParent);
						$doc->exportField($this->AdminOnly);
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