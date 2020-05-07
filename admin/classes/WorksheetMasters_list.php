<?php
namespace PHPMaker2020\feapps51;

/**
 * Page class
 */
class WorksheetMasters_list extends WorksheetMasters
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}";

	// Table name
	public $TableName = 'WorksheetMasters';

	// Page object name
	public $PageObjName = "WorksheetMasters_list";

	// Grid form hidden field names
	public $FormName = "fWorksheetMasterslist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (WorksheetMasters)
		if (!isset($GLOBALS["WorksheetMasters"]) || get_class($GLOBALS["WorksheetMasters"]) == PROJECT_NAMESPACE . "WorksheetMasters") {
			$GLOBALS["WorksheetMasters"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["WorksheetMasters"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "WorksheetMastersadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "WorksheetMastersdelete.php";
		$this->MultiUpdateUrl = "WorksheetMastersupdate.php";

		// Table object (v_Administrators)
		if (!isset($GLOBALS['v_Administrators']))
			$GLOBALS['v_Administrators'] = new v_Administrators();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'WorksheetMasters');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (v_Administrators)
		$UserTable = $UserTable ?: new v_Administrators();

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions("div");
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fWorksheetMasterslistsrch";

		// List actions
		$this->ListActions = new ListActions();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $WorksheetMasters;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($WorksheetMasters);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['WorksheetMaster_Idn'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->WorksheetMaster_Idn->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!$this->setupApiRequest())
			return FALSE;

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API request
	public function setupApiRequest()
	{
		global $Security;

		// Check security for API request
		If (ValidApiRequest()) {
			if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
			if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
			return TRUE;
		}
		return FALSE;
	}

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (!$this->setupApiRequest()) {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (Config("USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (Config("USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup export options
		$this->setupExportOptions();
		$this->WorksheetMaster_Idn->setVisibility();
		$this->Name->setVisibility();
		$this->Department_Idn->setVisibility();
		$this->Rank->setVisibility();
		$this->NumberOfColumns->setVisibility();
		$this->AllowMultiple->setVisibility();
		$this->DisplayAdjustmentFactors->Visible = FALSE;
		$this->DisplayWorksheetDetails->Visible = FALSE;
		$this->DisplayShopFabrication->Visible = FALSE;
		$this->DisplayWorksheetName->Visible = FALSE;
		$this->DisplayWorksheetHeader->Visible = FALSE;
		$this->UseRadioButtonsForSizes->Visible = FALSE;
		$this->DisplayFieldHoursOverride->Visible = FALSE;
		$this->DisplayShopHours->Visible = FALSE;
		$this->DisplayShopHoursOverride->Visible = FALSE;
		$this->DisplayUserShopHoursOnly->Visible = FALSE;
		$this->DisplayPipeExposure->Visible = FALSE;
		$this->DisplayVolumeCorrection->Visible = FALSE;
		$this->DisplayManhourAdjustment->Visible = FALSE;
		$this->IsSubcontractWorksheet->Visible = FALSE;
		$this->DisplayDeleteItemsButtons->Visible = FALSE;
		$this->ActiveFlag->setVisibility();
		$this->hideFieldsForAddEdit();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		$this->setupLookupOptions($this->Department_Idn);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Check QueryString parameters
			if (Get("action") !== NULL) {
				$this->CurrentAction = Get("action");

				// Clear inline mode
				if ($this->isCancel())
					$this->clearInlineMode();

				// Switch to grid edit mode
				if ($this->isGridEdit())
					$this->gridEditMode();

				// Switch to inline edit mode
				if ($this->isEdit())
					$this->inlineEditMode();

				// Switch to inline add mode
				if ($this->isAdd() || $this->isCopy())
					$this->inlineAddMode();

				// Switch to grid add mode
				if ($this->isGridAdd())
					$this->gridAddMode();
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

					// Grid Update
					if (($this->isGridUpdate() || $this->isGridOverwrite()) && @$_SESSION[SESSION_INLINE_MODE] == "gridedit") {
						if ($this->validateGridForm()) {
							$gridUpdate = $this->gridUpdate();
						} else {
							$gridUpdate = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridUpdate) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridEditMode(); // Stay in Grid edit mode
						}
					}

					// Inline Update
					if (($this->isUpdate() || $this->isOverwrite()) && @$_SESSION[SESSION_INLINE_MODE] == "edit")
						$this->inlineUpdate();

					// Insert Inline
					if ($this->isInsert() && @$_SESSION[SESSION_INLINE_MODE] == "add")
						$this->inlineInsert();

					// Grid Insert
					if ($this->isGridInsert() && @$_SESSION[SESSION_INLINE_MODE] == "gridadd") {
						if ($this->validateGridForm()) {
							$gridInsert = $this->gridInsert();
						} else {
							$gridInsert = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridInsert) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridAddMode(); // Stay in Grid add mode
						}
					}
				} elseif (@$_SESSION[SESSION_INLINE_MODE] == "gridedit") { // Previously in grid edit mode
					if (Get(Config("TABLE_START_REC")) !== NULL || Get(Config("TABLE_PAGE_NO")) !== NULL) // Stay in grid edit mode if paging
						$this->gridEditMode();
					else // Reset grid edit
						$this->clearInlineMode();
				}
			}

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->Command != "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
			$this->exportData();
			$this->terminate();
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->GridAddRowCount;
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecords = $this->TotalRecords;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRecord();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecords == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->setKey("WorksheetMaster_Idn", ""); // Clear inline edit key
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Inline Edit mode
	protected function inlineEditMode()
	{
		global $Security, $Language;
		if (!$Security->canEdit())
			return FALSE; // Edit not allowed
		$inlineEdit = TRUE;
		if (Get("WorksheetMaster_Idn") !== NULL) {
			$this->WorksheetMaster_Idn->setQueryStringValue(Get("WorksheetMaster_Idn"));
		} else {
			$inlineEdit = FALSE;
		}
		if ($inlineEdit) {
			if ($this->loadRow()) {
				$this->setKey("WorksheetMaster_Idn", $this->WorksheetMaster_Idn->CurrentValue); // Set up inline edit key
				$_SESSION[SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
		return TRUE;
	}

	// Perform update to Inline Edit record
	protected function inlineUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$CurrentForm->Index = 1;
		$this->loadFormValues(); // Get form values

		// Validate form
		$inlineUpdate = TRUE;
		if (!$this->validateForm()) {
			$inlineUpdate = FALSE; // Form error, reset action
			$this->setFailureMessage($FormError);
		} else {
			$inlineUpdate = FALSE;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			if ($this->setupKeyValues($rowkey)) { // Set up key values
				if ($this->checkInlineEditKey()) { // Check key
					$this->SendEmail = TRUE; // Send email on update success
					$inlineUpdate = $this->editRow(); // Update record
				} else {
					$inlineUpdate = FALSE;
				}
			}
		}
		if ($inlineUpdate) { // Update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up success message
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
			$this->EventCancelled = TRUE; // Cancel event
			$this->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	public function checkInlineEditKey()
	{
		if ($this->EventCancelled)
			$this->WorksheetMaster_Idn->OldValue = $this->WorksheetMaster_Idn->DbValue;
		$val = $this->WorksheetMaster_Idn->OldValue !== NULL ? $this->WorksheetMaster_Idn->OldValue : $this->WorksheetMaster_Idn->CurrentValue;
		if (strval($this->getKey("WorksheetMaster_Idn")) != strval($val))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	protected function inlineAddMode()
	{
		global $Security, $Language;
		if (!$Security->canAdd())
			return FALSE; // Add not allowed
		if ($this->isCopy()) {
			if (Get("WorksheetMaster_Idn") !== NULL) {
				$this->WorksheetMaster_Idn->setQueryStringValue(Get("WorksheetMaster_Idn"));
				$this->setKey("WorksheetMaster_Idn", $this->WorksheetMaster_Idn->CurrentValue); // Set up key
			} else {
				$this->setKey("WorksheetMaster_Idn", ""); // Clear key
				$this->CurrentAction = "add";
			}
		}
		$_SESSION[SESSION_INLINE_MODE] = "add"; // Enable inline add
		return TRUE;
	}

	// Perform update to Inline Add/Copy record
	protected function inlineInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$this->loadOldRecord(); // Load old record
		$CurrentForm->Index = 0;
		$this->loadFormValues(); // Get form values

		// Validate form
		if (!$this->validateForm()) {
			$this->setFailureMessage($FormError); // Set validation error message
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$this->SendEmail = TRUE; // Send email on add success
		if ($this->addRow($this->OldRecordset)) { // Add record
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up add success message
			$this->clearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->beginTrans();
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction != "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey != "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key != "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up update success message
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->WorksheetMaster_Idn->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->WorksheetMaster_Idn->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = $this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->beginTrans();

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "" && $rowaction != "insert")
				continue; // Skip
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->WorksheetMaster_Idn->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter != "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->phrase("NoAddRecord"));
			$gridInsert = FALSE;
		}
		if ($gridInsert) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("InsertSuccess")); // Set up insert success message
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_Name") && $CurrentForm->hasValue("o_Name") && $this->Name->CurrentValue != $this->Name->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Department_Idn") && $CurrentForm->hasValue("o_Department_Idn") && $this->Department_Idn->CurrentValue != $this->Department_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Rank") && $CurrentForm->hasValue("o_Rank") && $this->Rank->CurrentValue != $this->Rank->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_NumberOfColumns") && $CurrentForm->hasValue("o_NumberOfColumns") && $this->NumberOfColumns->CurrentValue != $this->NumberOfColumns->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AllowMultiple") && $CurrentForm->hasValue("o_AllowMultiple") && ConvertToBool($this->AllowMultiple->CurrentValue) != ConvertToBool($this->AllowMultiple->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_ActiveFlag") && $CurrentForm->hasValue("o_ActiveFlag") && ConvertToBool($this->ActiveFlag->CurrentValue) != ConvertToBool($this->ActiveFlag->OldValue))
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = [];

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->WorksheetMaster_Idn->AdvancedSearch->toJson(), ","); // Field WorksheetMaster_Idn
		$filterList = Concat($filterList, $this->Name->AdvancedSearch->toJson(), ","); // Field Name
		$filterList = Concat($filterList, $this->Department_Idn->AdvancedSearch->toJson(), ","); // Field Department_Idn
		$filterList = Concat($filterList, $this->Rank->AdvancedSearch->toJson(), ","); // Field Rank
		$filterList = Concat($filterList, $this->NumberOfColumns->AdvancedSearch->toJson(), ","); // Field NumberOfColumns
		$filterList = Concat($filterList, $this->AllowMultiple->AdvancedSearch->toJson(), ","); // Field AllowMultiple
		$filterList = Concat($filterList, $this->DisplayAdjustmentFactors->AdvancedSearch->toJson(), ","); // Field DisplayAdjustmentFactors
		$filterList = Concat($filterList, $this->DisplayWorksheetDetails->AdvancedSearch->toJson(), ","); // Field DisplayWorksheetDetails
		$filterList = Concat($filterList, $this->DisplayShopFabrication->AdvancedSearch->toJson(), ","); // Field DisplayShopFabrication
		$filterList = Concat($filterList, $this->DisplayWorksheetName->AdvancedSearch->toJson(), ","); // Field DisplayWorksheetName
		$filterList = Concat($filterList, $this->DisplayWorksheetHeader->AdvancedSearch->toJson(), ","); // Field DisplayWorksheetHeader
		$filterList = Concat($filterList, $this->UseRadioButtonsForSizes->AdvancedSearch->toJson(), ","); // Field UseRadioButtonsForSizes
		$filterList = Concat($filterList, $this->DisplayFieldHoursOverride->AdvancedSearch->toJson(), ","); // Field DisplayFieldHoursOverride
		$filterList = Concat($filterList, $this->DisplayShopHours->AdvancedSearch->toJson(), ","); // Field DisplayShopHours
		$filterList = Concat($filterList, $this->DisplayShopHoursOverride->AdvancedSearch->toJson(), ","); // Field DisplayShopHoursOverride
		$filterList = Concat($filterList, $this->DisplayUserShopHoursOnly->AdvancedSearch->toJson(), ","); // Field DisplayUserShopHoursOnly
		$filterList = Concat($filterList, $this->DisplayPipeExposure->AdvancedSearch->toJson(), ","); // Field DisplayPipeExposure
		$filterList = Concat($filterList, $this->DisplayVolumeCorrection->AdvancedSearch->toJson(), ","); // Field DisplayVolumeCorrection
		$filterList = Concat($filterList, $this->DisplayManhourAdjustment->AdvancedSearch->toJson(), ","); // Field DisplayManhourAdjustment
		$filterList = Concat($filterList, $this->IsSubcontractWorksheet->AdvancedSearch->toJson(), ","); // Field IsSubcontractWorksheet
		$filterList = Concat($filterList, $this->DisplayDeleteItemsButtons->AdvancedSearch->toJson(), ","); // Field DisplayDeleteItemsButtons
		$filterList = Concat($filterList, $this->ActiveFlag->AdvancedSearch->toJson(), ","); // Field ActiveFlag
		if ($this->BasicSearch->Keyword != "") {
			$wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fWorksheetMasterslistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field WorksheetMaster_Idn
		$this->WorksheetMaster_Idn->AdvancedSearch->SearchValue = @$filter["x_WorksheetMaster_Idn"];
		$this->WorksheetMaster_Idn->AdvancedSearch->SearchOperator = @$filter["z_WorksheetMaster_Idn"];
		$this->WorksheetMaster_Idn->AdvancedSearch->SearchCondition = @$filter["v_WorksheetMaster_Idn"];
		$this->WorksheetMaster_Idn->AdvancedSearch->SearchValue2 = @$filter["y_WorksheetMaster_Idn"];
		$this->WorksheetMaster_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_WorksheetMaster_Idn"];
		$this->WorksheetMaster_Idn->AdvancedSearch->save();

		// Field Name
		$this->Name->AdvancedSearch->SearchValue = @$filter["x_Name"];
		$this->Name->AdvancedSearch->SearchOperator = @$filter["z_Name"];
		$this->Name->AdvancedSearch->SearchCondition = @$filter["v_Name"];
		$this->Name->AdvancedSearch->SearchValue2 = @$filter["y_Name"];
		$this->Name->AdvancedSearch->SearchOperator2 = @$filter["w_Name"];
		$this->Name->AdvancedSearch->save();

		// Field Department_Idn
		$this->Department_Idn->AdvancedSearch->SearchValue = @$filter["x_Department_Idn"];
		$this->Department_Idn->AdvancedSearch->SearchOperator = @$filter["z_Department_Idn"];
		$this->Department_Idn->AdvancedSearch->SearchCondition = @$filter["v_Department_Idn"];
		$this->Department_Idn->AdvancedSearch->SearchValue2 = @$filter["y_Department_Idn"];
		$this->Department_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_Department_Idn"];
		$this->Department_Idn->AdvancedSearch->save();

		// Field Rank
		$this->Rank->AdvancedSearch->SearchValue = @$filter["x_Rank"];
		$this->Rank->AdvancedSearch->SearchOperator = @$filter["z_Rank"];
		$this->Rank->AdvancedSearch->SearchCondition = @$filter["v_Rank"];
		$this->Rank->AdvancedSearch->SearchValue2 = @$filter["y_Rank"];
		$this->Rank->AdvancedSearch->SearchOperator2 = @$filter["w_Rank"];
		$this->Rank->AdvancedSearch->save();

		// Field NumberOfColumns
		$this->NumberOfColumns->AdvancedSearch->SearchValue = @$filter["x_NumberOfColumns"];
		$this->NumberOfColumns->AdvancedSearch->SearchOperator = @$filter["z_NumberOfColumns"];
		$this->NumberOfColumns->AdvancedSearch->SearchCondition = @$filter["v_NumberOfColumns"];
		$this->NumberOfColumns->AdvancedSearch->SearchValue2 = @$filter["y_NumberOfColumns"];
		$this->NumberOfColumns->AdvancedSearch->SearchOperator2 = @$filter["w_NumberOfColumns"];
		$this->NumberOfColumns->AdvancedSearch->save();

		// Field AllowMultiple
		$this->AllowMultiple->AdvancedSearch->SearchValue = @$filter["x_AllowMultiple"];
		$this->AllowMultiple->AdvancedSearch->SearchOperator = @$filter["z_AllowMultiple"];
		$this->AllowMultiple->AdvancedSearch->SearchCondition = @$filter["v_AllowMultiple"];
		$this->AllowMultiple->AdvancedSearch->SearchValue2 = @$filter["y_AllowMultiple"];
		$this->AllowMultiple->AdvancedSearch->SearchOperator2 = @$filter["w_AllowMultiple"];
		$this->AllowMultiple->AdvancedSearch->save();

		// Field DisplayAdjustmentFactors
		$this->DisplayAdjustmentFactors->AdvancedSearch->SearchValue = @$filter["x_DisplayAdjustmentFactors"];
		$this->DisplayAdjustmentFactors->AdvancedSearch->SearchOperator = @$filter["z_DisplayAdjustmentFactors"];
		$this->DisplayAdjustmentFactors->AdvancedSearch->SearchCondition = @$filter["v_DisplayAdjustmentFactors"];
		$this->DisplayAdjustmentFactors->AdvancedSearch->SearchValue2 = @$filter["y_DisplayAdjustmentFactors"];
		$this->DisplayAdjustmentFactors->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayAdjustmentFactors"];
		$this->DisplayAdjustmentFactors->AdvancedSearch->save();

		// Field DisplayWorksheetDetails
		$this->DisplayWorksheetDetails->AdvancedSearch->SearchValue = @$filter["x_DisplayWorksheetDetails"];
		$this->DisplayWorksheetDetails->AdvancedSearch->SearchOperator = @$filter["z_DisplayWorksheetDetails"];
		$this->DisplayWorksheetDetails->AdvancedSearch->SearchCondition = @$filter["v_DisplayWorksheetDetails"];
		$this->DisplayWorksheetDetails->AdvancedSearch->SearchValue2 = @$filter["y_DisplayWorksheetDetails"];
		$this->DisplayWorksheetDetails->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayWorksheetDetails"];
		$this->DisplayWorksheetDetails->AdvancedSearch->save();

		// Field DisplayShopFabrication
		$this->DisplayShopFabrication->AdvancedSearch->SearchValue = @$filter["x_DisplayShopFabrication"];
		$this->DisplayShopFabrication->AdvancedSearch->SearchOperator = @$filter["z_DisplayShopFabrication"];
		$this->DisplayShopFabrication->AdvancedSearch->SearchCondition = @$filter["v_DisplayShopFabrication"];
		$this->DisplayShopFabrication->AdvancedSearch->SearchValue2 = @$filter["y_DisplayShopFabrication"];
		$this->DisplayShopFabrication->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayShopFabrication"];
		$this->DisplayShopFabrication->AdvancedSearch->save();

		// Field DisplayWorksheetName
		$this->DisplayWorksheetName->AdvancedSearch->SearchValue = @$filter["x_DisplayWorksheetName"];
		$this->DisplayWorksheetName->AdvancedSearch->SearchOperator = @$filter["z_DisplayWorksheetName"];
		$this->DisplayWorksheetName->AdvancedSearch->SearchCondition = @$filter["v_DisplayWorksheetName"];
		$this->DisplayWorksheetName->AdvancedSearch->SearchValue2 = @$filter["y_DisplayWorksheetName"];
		$this->DisplayWorksheetName->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayWorksheetName"];
		$this->DisplayWorksheetName->AdvancedSearch->save();

		// Field DisplayWorksheetHeader
		$this->DisplayWorksheetHeader->AdvancedSearch->SearchValue = @$filter["x_DisplayWorksheetHeader"];
		$this->DisplayWorksheetHeader->AdvancedSearch->SearchOperator = @$filter["z_DisplayWorksheetHeader"];
		$this->DisplayWorksheetHeader->AdvancedSearch->SearchCondition = @$filter["v_DisplayWorksheetHeader"];
		$this->DisplayWorksheetHeader->AdvancedSearch->SearchValue2 = @$filter["y_DisplayWorksheetHeader"];
		$this->DisplayWorksheetHeader->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayWorksheetHeader"];
		$this->DisplayWorksheetHeader->AdvancedSearch->save();

		// Field UseRadioButtonsForSizes
		$this->UseRadioButtonsForSizes->AdvancedSearch->SearchValue = @$filter["x_UseRadioButtonsForSizes"];
		$this->UseRadioButtonsForSizes->AdvancedSearch->SearchOperator = @$filter["z_UseRadioButtonsForSizes"];
		$this->UseRadioButtonsForSizes->AdvancedSearch->SearchCondition = @$filter["v_UseRadioButtonsForSizes"];
		$this->UseRadioButtonsForSizes->AdvancedSearch->SearchValue2 = @$filter["y_UseRadioButtonsForSizes"];
		$this->UseRadioButtonsForSizes->AdvancedSearch->SearchOperator2 = @$filter["w_UseRadioButtonsForSizes"];
		$this->UseRadioButtonsForSizes->AdvancedSearch->save();

		// Field DisplayFieldHoursOverride
		$this->DisplayFieldHoursOverride->AdvancedSearch->SearchValue = @$filter["x_DisplayFieldHoursOverride"];
		$this->DisplayFieldHoursOverride->AdvancedSearch->SearchOperator = @$filter["z_DisplayFieldHoursOverride"];
		$this->DisplayFieldHoursOverride->AdvancedSearch->SearchCondition = @$filter["v_DisplayFieldHoursOverride"];
		$this->DisplayFieldHoursOverride->AdvancedSearch->SearchValue2 = @$filter["y_DisplayFieldHoursOverride"];
		$this->DisplayFieldHoursOverride->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayFieldHoursOverride"];
		$this->DisplayFieldHoursOverride->AdvancedSearch->save();

		// Field DisplayShopHours
		$this->DisplayShopHours->AdvancedSearch->SearchValue = @$filter["x_DisplayShopHours"];
		$this->DisplayShopHours->AdvancedSearch->SearchOperator = @$filter["z_DisplayShopHours"];
		$this->DisplayShopHours->AdvancedSearch->SearchCondition = @$filter["v_DisplayShopHours"];
		$this->DisplayShopHours->AdvancedSearch->SearchValue2 = @$filter["y_DisplayShopHours"];
		$this->DisplayShopHours->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayShopHours"];
		$this->DisplayShopHours->AdvancedSearch->save();

		// Field DisplayShopHoursOverride
		$this->DisplayShopHoursOverride->AdvancedSearch->SearchValue = @$filter["x_DisplayShopHoursOverride"];
		$this->DisplayShopHoursOverride->AdvancedSearch->SearchOperator = @$filter["z_DisplayShopHoursOverride"];
		$this->DisplayShopHoursOverride->AdvancedSearch->SearchCondition = @$filter["v_DisplayShopHoursOverride"];
		$this->DisplayShopHoursOverride->AdvancedSearch->SearchValue2 = @$filter["y_DisplayShopHoursOverride"];
		$this->DisplayShopHoursOverride->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayShopHoursOverride"];
		$this->DisplayShopHoursOverride->AdvancedSearch->save();

		// Field DisplayUserShopHoursOnly
		$this->DisplayUserShopHoursOnly->AdvancedSearch->SearchValue = @$filter["x_DisplayUserShopHoursOnly"];
		$this->DisplayUserShopHoursOnly->AdvancedSearch->SearchOperator = @$filter["z_DisplayUserShopHoursOnly"];
		$this->DisplayUserShopHoursOnly->AdvancedSearch->SearchCondition = @$filter["v_DisplayUserShopHoursOnly"];
		$this->DisplayUserShopHoursOnly->AdvancedSearch->SearchValue2 = @$filter["y_DisplayUserShopHoursOnly"];
		$this->DisplayUserShopHoursOnly->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayUserShopHoursOnly"];
		$this->DisplayUserShopHoursOnly->AdvancedSearch->save();

		// Field DisplayPipeExposure
		$this->DisplayPipeExposure->AdvancedSearch->SearchValue = @$filter["x_DisplayPipeExposure"];
		$this->DisplayPipeExposure->AdvancedSearch->SearchOperator = @$filter["z_DisplayPipeExposure"];
		$this->DisplayPipeExposure->AdvancedSearch->SearchCondition = @$filter["v_DisplayPipeExposure"];
		$this->DisplayPipeExposure->AdvancedSearch->SearchValue2 = @$filter["y_DisplayPipeExposure"];
		$this->DisplayPipeExposure->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayPipeExposure"];
		$this->DisplayPipeExposure->AdvancedSearch->save();

		// Field DisplayVolumeCorrection
		$this->DisplayVolumeCorrection->AdvancedSearch->SearchValue = @$filter["x_DisplayVolumeCorrection"];
		$this->DisplayVolumeCorrection->AdvancedSearch->SearchOperator = @$filter["z_DisplayVolumeCorrection"];
		$this->DisplayVolumeCorrection->AdvancedSearch->SearchCondition = @$filter["v_DisplayVolumeCorrection"];
		$this->DisplayVolumeCorrection->AdvancedSearch->SearchValue2 = @$filter["y_DisplayVolumeCorrection"];
		$this->DisplayVolumeCorrection->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayVolumeCorrection"];
		$this->DisplayVolumeCorrection->AdvancedSearch->save();

		// Field DisplayManhourAdjustment
		$this->DisplayManhourAdjustment->AdvancedSearch->SearchValue = @$filter["x_DisplayManhourAdjustment"];
		$this->DisplayManhourAdjustment->AdvancedSearch->SearchOperator = @$filter["z_DisplayManhourAdjustment"];
		$this->DisplayManhourAdjustment->AdvancedSearch->SearchCondition = @$filter["v_DisplayManhourAdjustment"];
		$this->DisplayManhourAdjustment->AdvancedSearch->SearchValue2 = @$filter["y_DisplayManhourAdjustment"];
		$this->DisplayManhourAdjustment->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayManhourAdjustment"];
		$this->DisplayManhourAdjustment->AdvancedSearch->save();

		// Field IsSubcontractWorksheet
		$this->IsSubcontractWorksheet->AdvancedSearch->SearchValue = @$filter["x_IsSubcontractWorksheet"];
		$this->IsSubcontractWorksheet->AdvancedSearch->SearchOperator = @$filter["z_IsSubcontractWorksheet"];
		$this->IsSubcontractWorksheet->AdvancedSearch->SearchCondition = @$filter["v_IsSubcontractWorksheet"];
		$this->IsSubcontractWorksheet->AdvancedSearch->SearchValue2 = @$filter["y_IsSubcontractWorksheet"];
		$this->IsSubcontractWorksheet->AdvancedSearch->SearchOperator2 = @$filter["w_IsSubcontractWorksheet"];
		$this->IsSubcontractWorksheet->AdvancedSearch->save();

		// Field DisplayDeleteItemsButtons
		$this->DisplayDeleteItemsButtons->AdvancedSearch->SearchValue = @$filter["x_DisplayDeleteItemsButtons"];
		$this->DisplayDeleteItemsButtons->AdvancedSearch->SearchOperator = @$filter["z_DisplayDeleteItemsButtons"];
		$this->DisplayDeleteItemsButtons->AdvancedSearch->SearchCondition = @$filter["v_DisplayDeleteItemsButtons"];
		$this->DisplayDeleteItemsButtons->AdvancedSearch->SearchValue2 = @$filter["y_DisplayDeleteItemsButtons"];
		$this->DisplayDeleteItemsButtons->AdvancedSearch->SearchOperator2 = @$filter["w_DisplayDeleteItemsButtons"];
		$this->DisplayDeleteItemsButtons->AdvancedSearch->save();

		// Field ActiveFlag
		$this->ActiveFlag->AdvancedSearch->SearchValue = @$filter["x_ActiveFlag"];
		$this->ActiveFlag->AdvancedSearch->SearchOperator = @$filter["z_ActiveFlag"];
		$this->ActiveFlag->AdvancedSearch->SearchCondition = @$filter["v_ActiveFlag"];
		$this->ActiveFlag->AdvancedSearch->SearchValue2 = @$filter["y_ActiveFlag"];
		$this->ActiveFlag->AdvancedSearch->SearchOperator2 = @$filter["w_ActiveFlag"];
		$this->ActiveFlag->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->WorksheetMaster_Idn, $default, FALSE); // WorksheetMaster_Idn
		$this->buildSearchSql($where, $this->Name, $default, FALSE); // Name
		$this->buildSearchSql($where, $this->Department_Idn, $default, FALSE); // Department_Idn
		$this->buildSearchSql($where, $this->Rank, $default, FALSE); // Rank
		$this->buildSearchSql($where, $this->NumberOfColumns, $default, FALSE); // NumberOfColumns
		$this->buildSearchSql($where, $this->AllowMultiple, $default, FALSE); // AllowMultiple
		$this->buildSearchSql($where, $this->DisplayAdjustmentFactors, $default, FALSE); // DisplayAdjustmentFactors
		$this->buildSearchSql($where, $this->DisplayWorksheetDetails, $default, FALSE); // DisplayWorksheetDetails
		$this->buildSearchSql($where, $this->DisplayShopFabrication, $default, FALSE); // DisplayShopFabrication
		$this->buildSearchSql($where, $this->DisplayWorksheetName, $default, FALSE); // DisplayWorksheetName
		$this->buildSearchSql($where, $this->DisplayWorksheetHeader, $default, FALSE); // DisplayWorksheetHeader
		$this->buildSearchSql($where, $this->UseRadioButtonsForSizes, $default, FALSE); // UseRadioButtonsForSizes
		$this->buildSearchSql($where, $this->DisplayFieldHoursOverride, $default, FALSE); // DisplayFieldHoursOverride
		$this->buildSearchSql($where, $this->DisplayShopHours, $default, FALSE); // DisplayShopHours
		$this->buildSearchSql($where, $this->DisplayShopHoursOverride, $default, FALSE); // DisplayShopHoursOverride
		$this->buildSearchSql($where, $this->DisplayUserShopHoursOnly, $default, FALSE); // DisplayUserShopHoursOnly
		$this->buildSearchSql($where, $this->DisplayPipeExposure, $default, FALSE); // DisplayPipeExposure
		$this->buildSearchSql($where, $this->DisplayVolumeCorrection, $default, FALSE); // DisplayVolumeCorrection
		$this->buildSearchSql($where, $this->DisplayManhourAdjustment, $default, FALSE); // DisplayManhourAdjustment
		$this->buildSearchSql($where, $this->IsSubcontractWorksheet, $default, FALSE); // IsSubcontractWorksheet
		$this->buildSearchSql($where, $this->DisplayDeleteItemsButtons, $default, FALSE); // DisplayDeleteItemsButtons
		$this->buildSearchSql($where, $this->ActiveFlag, $default, FALSE); // ActiveFlag

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->WorksheetMaster_Idn->AdvancedSearch->save(); // WorksheetMaster_Idn
			$this->Name->AdvancedSearch->save(); // Name
			$this->Department_Idn->AdvancedSearch->save(); // Department_Idn
			$this->Rank->AdvancedSearch->save(); // Rank
			$this->NumberOfColumns->AdvancedSearch->save(); // NumberOfColumns
			$this->AllowMultiple->AdvancedSearch->save(); // AllowMultiple
			$this->DisplayAdjustmentFactors->AdvancedSearch->save(); // DisplayAdjustmentFactors
			$this->DisplayWorksheetDetails->AdvancedSearch->save(); // DisplayWorksheetDetails
			$this->DisplayShopFabrication->AdvancedSearch->save(); // DisplayShopFabrication
			$this->DisplayWorksheetName->AdvancedSearch->save(); // DisplayWorksheetName
			$this->DisplayWorksheetHeader->AdvancedSearch->save(); // DisplayWorksheetHeader
			$this->UseRadioButtonsForSizes->AdvancedSearch->save(); // UseRadioButtonsForSizes
			$this->DisplayFieldHoursOverride->AdvancedSearch->save(); // DisplayFieldHoursOverride
			$this->DisplayShopHours->AdvancedSearch->save(); // DisplayShopHours
			$this->DisplayShopHoursOverride->AdvancedSearch->save(); // DisplayShopHoursOverride
			$this->DisplayUserShopHoursOnly->AdvancedSearch->save(); // DisplayUserShopHoursOnly
			$this->DisplayPipeExposure->AdvancedSearch->save(); // DisplayPipeExposure
			$this->DisplayVolumeCorrection->AdvancedSearch->save(); // DisplayVolumeCorrection
			$this->DisplayManhourAdjustment->AdvancedSearch->save(); // DisplayManhourAdjustment
			$this->IsSubcontractWorksheet->AdvancedSearch->save(); // IsSubcontractWorksheet
			$this->DisplayDeleteItemsButtons->AdvancedSearch->save(); // DisplayDeleteItemsButtons
			$this->ActiveFlag->AdvancedSearch->save(); // ActiveFlag
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 || !IsMultiSearchOperator($fldOpr))
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal != "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 != "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 != "")
				$wrk = ($wrk != "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == Config("NULL_VALUE") || $fldVal == Config("NOT_NULL_VALUE"))
			return $fldVal;
		$value = $fldVal;
		if ($fld->isBoolean()) {
			if ($fldVal != "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal != "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->Name, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = []; // Array for SQL parts
		$arCond = []; // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
				$keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = [$keyword];
			}
			foreach ($ar as $keyword) {
				if ($keyword != "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == Config("NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == Config("NOT_NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk != "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] != "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql != "") {
			if ($where != "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword != "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword != "") {
						if ($searchStr != "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, ["", "reset", "resetall"]))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->WorksheetMaster_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Name->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Department_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Rank->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->NumberOfColumns->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AllowMultiple->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayAdjustmentFactors->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayWorksheetDetails->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayShopFabrication->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayWorksheetName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayWorksheetHeader->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->UseRadioButtonsForSizes->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayFieldHoursOverride->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayShopHours->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayShopHoursOverride->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayUserShopHoursOnly->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayPipeExposure->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayVolumeCorrection->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayManhourAdjustment->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IsSubcontractWorksheet->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DisplayDeleteItemsButtons->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ActiveFlag->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->WorksheetMaster_Idn->AdvancedSearch->unsetSession();
		$this->Name->AdvancedSearch->unsetSession();
		$this->Department_Idn->AdvancedSearch->unsetSession();
		$this->Rank->AdvancedSearch->unsetSession();
		$this->NumberOfColumns->AdvancedSearch->unsetSession();
		$this->AllowMultiple->AdvancedSearch->unsetSession();
		$this->DisplayAdjustmentFactors->AdvancedSearch->unsetSession();
		$this->DisplayWorksheetDetails->AdvancedSearch->unsetSession();
		$this->DisplayShopFabrication->AdvancedSearch->unsetSession();
		$this->DisplayWorksheetName->AdvancedSearch->unsetSession();
		$this->DisplayWorksheetHeader->AdvancedSearch->unsetSession();
		$this->UseRadioButtonsForSizes->AdvancedSearch->unsetSession();
		$this->DisplayFieldHoursOverride->AdvancedSearch->unsetSession();
		$this->DisplayShopHours->AdvancedSearch->unsetSession();
		$this->DisplayShopHoursOverride->AdvancedSearch->unsetSession();
		$this->DisplayUserShopHoursOnly->AdvancedSearch->unsetSession();
		$this->DisplayPipeExposure->AdvancedSearch->unsetSession();
		$this->DisplayVolumeCorrection->AdvancedSearch->unsetSession();
		$this->DisplayManhourAdjustment->AdvancedSearch->unsetSession();
		$this->IsSubcontractWorksheet->AdvancedSearch->unsetSession();
		$this->DisplayDeleteItemsButtons->AdvancedSearch->unsetSession();
		$this->ActiveFlag->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->WorksheetMaster_Idn->AdvancedSearch->load();
		$this->Name->AdvancedSearch->load();
		$this->Department_Idn->AdvancedSearch->load();
		$this->Rank->AdvancedSearch->load();
		$this->NumberOfColumns->AdvancedSearch->load();
		$this->AllowMultiple->AdvancedSearch->load();
		$this->DisplayAdjustmentFactors->AdvancedSearch->load();
		$this->DisplayWorksheetDetails->AdvancedSearch->load();
		$this->DisplayShopFabrication->AdvancedSearch->load();
		$this->DisplayWorksheetName->AdvancedSearch->load();
		$this->DisplayWorksheetHeader->AdvancedSearch->load();
		$this->UseRadioButtonsForSizes->AdvancedSearch->load();
		$this->DisplayFieldHoursOverride->AdvancedSearch->load();
		$this->DisplayShopHours->AdvancedSearch->load();
		$this->DisplayShopHoursOverride->AdvancedSearch->load();
		$this->DisplayUserShopHoursOnly->AdvancedSearch->load();
		$this->DisplayPipeExposure->AdvancedSearch->load();
		$this->DisplayVolumeCorrection->AdvancedSearch->load();
		$this->DisplayManhourAdjustment->AdvancedSearch->load();
		$this->IsSubcontractWorksheet->AdvancedSearch->load();
		$this->DisplayDeleteItemsButtons->AdvancedSearch->load();
		$this->ActiveFlag->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->WorksheetMaster_Idn); // WorksheetMaster_Idn
			$this->updateSort($this->Name); // Name
			$this->updateSort($this->Department_Idn); // Department_Idn
			$this->updateSort($this->Rank); // Rank
			$this->updateSort($this->NumberOfColumns); // NumberOfColumns
			$this->updateSort($this->AllowMultiple); // AllowMultiple
			$this->updateSort($this->ActiveFlag); // ActiveFlag
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
				$this->Department_Idn->setSort("ASC");
				$this->Rank->setSort("ASC");
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->WorksheetMaster_Idn->setSort("");
				$this->Name->setSort("");
				$this->Department_Idn->setSort("");
				$this->Rank->setSort("");
				$this->NumberOfColumns->setSort("");
				$this->AllowMultiple->setSort("");
				$this->ActiveFlag->setSort("");
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
		$item->OnLeft = TRUE;

		// "detail_WorksheetMasterCategories"
		$item = &$this->ListOptions->add("detail_WorksheetMasterCategories");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'WorksheetMasterCategories') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["WorksheetMasterCategories_grid"]))
			$GLOBALS["WorksheetMasterCategories_grid"] = new WorksheetMasterCategories_grid();

		// "detail_WorksheetMasterSizes"
		$item = &$this->ListOptions->add("detail_WorksheetMasterSizes");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'WorksheetMasterSizes') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["WorksheetMasterSizes_grid"]))
			$GLOBALS["WorksheetMasterSizes_grid"] = new WorksheetMasterSizes_grid();

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = TRUE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new SubPages();
		$pages->add("WorksheetMasterCategories");
		$pages->add("WorksheetMasterSizes");
		$this->DetailPages = $pages;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = $Security->canDelete();
		$item->OnLeft = TRUE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->moveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode != "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);

				// Reload hidden key for delete
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . HtmlEncode($rowkey) . "\">";
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->isGridAdd() || $this->isGridEdit()) {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = $options["griddelete"];
				if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "copy"
		$opt = $this->ListOptions["copy"];
		if ($this->isInlineAddRow() || $this->isInlineCopyRow()) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
			$opt->Body = "<div" . (($opt->OnLeft) ? " class=\"text-right\"" : "") . ">" .
				"<a class=\"ew-grid-link ew-inline-insert\" title=\"" . HtmlTitle($Language->phrase("InsertLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("InsertLink")) . "\" href=\"#\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("InsertLink") . "</a>&nbsp;" .
				"<a class=\"ew-grid-link ew-inline-cancel\" title=\"" . HtmlTitle($Language->phrase("CancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"action\" id=\"action\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		if ($this->isInlineEditRow()) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
			$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
				$opt->Body = "<div" . (($opt->OnLeft) ? " class=\"text-right\"" : "") . ">" .
					"<a class=\"ew-grid-link ew-inline-update\" title=\"" . HtmlTitle($Language->phrase("UpdateLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("UpdateLink")) . "\" href=\"#\" onclick=\"return ew.forms(this).submit('" . UrlAddHash($this->pageName(), "r" . $this->RowCount . "_" . $this->TableVar) . "');\">" . $Language->phrase("UpdateLink") . "</a>&nbsp;" .
					"<a class=\"ew-grid-link ew-inline-cancel\" title=\"" . HtmlTitle($Language->phrase("CancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"action\" id=\"action\" value=\"update\"></div>";
			$opt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . HtmlEncode($this->WorksheetMaster_Idn->CurrentValue) . "\">";
			return;
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
			$opt->Body .= "<a class=\"ew-row-link ew-inline-edit\" title=\"" . HtmlTitle($Language->phrase("InlineEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("InlineEditLink")) . "\" href=\"" . HtmlEncode(UrlAddHash($this->InlineEditUrl, "r" . $this->RowCount . "_" . $this->TableVar)) . "\">" . $Language->phrase("InlineEditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = $this->ListOptions["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd()) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
			$opt->Body .= "<a class=\"ew-row-link ew-inline-copy\" title=\"" . HtmlTitle($Language->phrase("InlineCopyLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("InlineCopyLink")) . "\" href=\"" . HtmlEncode($this->InlineCopyUrl) . "\">" . $Language->phrase("InlineCopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// Set up list action buttons
		$opt = $this->ListOptions["listactions"];
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = [];
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_WorksheetMasterCategories"
		$opt = $this->ListOptions["detail_WorksheetMasterCategories"];
		if ($Security->allowList(CurrentProjectID() . 'WorksheetMasterCategories')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("WorksheetMasterCategories", "TblCaption");
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("WorksheetMasterCategorieslist.php?" . Config("TABLE_SHOW_MASTER") . "=WorksheetMasters&fk_WorksheetMaster_Idn=" . urlencode(strval($this->WorksheetMaster_Idn->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["WorksheetMasterCategories_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'WorksheetMasters')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterCategories");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "WorksheetMasterCategories";
			}
			if ($GLOBALS["WorksheetMasterCategories_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'WorksheetMasters')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterCategories");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "WorksheetMasterCategories";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}

		// "detail_WorksheetMasterSizes"
		$opt = $this->ListOptions["detail_WorksheetMasterSizes"];
		if ($Security->allowList(CurrentProjectID() . 'WorksheetMasterSizes')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("WorksheetMasterSizes", "TblCaption");
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("WorksheetMasterSizeslist.php?" . Config("TABLE_SHOW_MASTER") . "=WorksheetMasters&fk_WorksheetMaster_Idn=" . urlencode(strval($this->WorksheetMaster_Idn->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["WorksheetMasterSizes_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'WorksheetMasters')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterSizes");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "WorksheetMasterSizes";
			}
			if ($GLOBALS["WorksheetMasterSizes_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'WorksheetMasters')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterSizes");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "WorksheetMasterSizes";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->GetCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$opt = $this->ListOptions["details"];
			$opt->Body = $body;
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->WorksheetMaster_Idn->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->WorksheetMaster_Idn->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = $this->AddUrl != "" && $Security->canAdd();

		// Inline Add
		$item = &$option->add("inlineadd");
		$item->Body = "<a class=\"ew-add-edit ew-inline-add\" title=\"" . HtmlTitle($Language->phrase("InlineAddLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("InlineAddLink")) . "\" href=\"" . HtmlEncode($this->InlineAddUrl) . "\">" .$Language->phrase("InlineAddLink") . "</a>";
		$item->Visible = $this->InlineAddUrl != "" && $Security->canAdd();
		$item = &$option->add("gridadd");
		$item->Body = "<a class=\"ew-add-edit ew-grid-add\" title=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" href=\"" . HtmlEncode($this->GridAddUrl) . "\">" . $Language->phrase("GridAddLink") . "</a>";
		$item->Visible = $this->GridAddUrl != "" && $Security->canAdd();
		$option = $options["detail"];
		$detailTableLink = "";
		$item = &$option->add("detailadd_WorksheetMasterCategories");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterCategories");
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["WorksheetMasterCategories"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["WorksheetMasterCategories"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'WorksheetMasters') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "WorksheetMasterCategories";
		}
		$item = &$option->add("detailadd_WorksheetMasterSizes");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterSizes");
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["WorksheetMasterSizes"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["WorksheetMasterSizes"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'WorksheetMasters') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "WorksheetMasterSizes";
		}

		// Add multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$option->add("detailsadd");
			$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailTableLink);
			$caption = $Language->phrase("AddMasterDetailLink");
			$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
			$item->Visible = $detailTableLink != "" && $Security->canAdd();

			// Hide single master/detail items
			$ar = explode(",", $detailTableLink);
			$cnt = count($ar);
			for ($i = 0; $i < $cnt; $i++) {
				if ($item = $option["detailadd_" . $ar[$i]])
					$item->Visible = FALSE;
			}
		}

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->add("gridedit");
		$item->Body = "<a class=\"ew-add-edit ew-grid-edit\" title=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" href=\"" . HtmlEncode($this->GridEditUrl) . "\">" . $Language->phrase("GridEditLink") . "</a>";
		$item->Visible = $this->GridEditUrl != "" && $Security->canEdit();
		$option = $options["action"];

		// Add multi delete
		$item = &$option->add("multidelete");
		$item->Body = "<a class=\"ew-action ew-multi-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" href=\"#\" onclick=\"return ew.submitAction(event, {f:document.fWorksheetMasterslist, url:'" . $this->MultiDeleteUrl . "', data:{action:'show'}});return false;\">" . $Language->phrase("DeleteSelectedLink") . "</a>";
		$item->Visible = $Security->canDelete();

		// Set up options default
		foreach ($options as $option) {
			$option->UseDropDownButton = TRUE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fWorksheetMasterslistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fWorksheetMasterslistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (!$this->isGridAdd() && !$this->isGridEdit()) { // Not grid add/edit mode
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fWorksheetMasterslist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecords <= 0) {
				$option = $options["addedit"];
				$item = $option["gridedit"];
				if ($item)
					$item->Visible = FALSE;
				$option = $options["action"];
				$option->hideAllOptions();
			}
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as $option)
				$option->hideAllOptions();

			// Grid-Add
			if ($this->isGridAdd()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = $options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = $options["action"];
				$option->UseDropDownButton = FALSE;

				// Add grid insert
				$item = &$option->add("gridinsert");
				$item->Body = "<a class=\"ew-action ew-grid-insert\" title=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" href=\"#\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->add("gridcancel");
				$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
				$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->phrase("GridCancelLink") . "</a>";
			}

			// Grid-Edit
			if ($this->isGridEdit()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = $options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = $options["action"];
				$option->UseDropDownButton = FALSE;
					$item = &$option->add("gridsave");
					$item->Body = "<a class=\"ew-action ew-grid-save\" title=\"" . HtmlTitle($Language->phrase("GridSaveLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridSaveLink")) . "\" href=\"#\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("GridSaveLink") . "</a>";
					$item = &$option->add("gridcancel");
					$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
					$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->phrase("GridCancelLink") . "</a>";
			}
		}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter != "" && $userAction != "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions[$userAction]->Caption;
				if (!$this->ListActions[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = "";
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage != "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() != "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() != "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{

		// Hide detail items for dropdown if necessary
		$this->ListOptions->hideDetailItemsForDropDown();
	}

// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
		$links = "";
		$btngrps = "";
		$sqlwrk = "[WorksheetMaster_Idn]=" . AdjustSql($this->WorksheetMaster_Idn->CurrentValue, $this->Dbid) . "";

		// Column "detail_WorksheetMasterCategories"
		if ($this->DetailPages && $this->DetailPages["WorksheetMasterCategories"] && $this->DetailPages["WorksheetMasterCategories"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_WorksheetMasterCategories"];
			$url = "WorksheetMasterCategoriespreview.php?t=WorksheetMasters&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"WorksheetMasterCategories\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'WorksheetMasters')) {
				$label = $Language->TablePhrase("WorksheetMasterCategories", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"WorksheetMasterCategories\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("WorksheetMasterCategorieslist.php?" . Config("TABLE_SHOW_MASTER") . "=WorksheetMasters&fk_WorksheetMaster_Idn=" . urlencode(strval($this->WorksheetMaster_Idn->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("WorksheetMasterCategories", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["WorksheetMasterCategories_grid"]))
				$GLOBALS["WorksheetMasterCategories_grid"] = new WorksheetMasterCategories_grid();
			if ($GLOBALS["WorksheetMasterCategories_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'WorksheetMasters')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterCategories");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["WorksheetMasterCategories_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'WorksheetMasters')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterCategories");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["WorksheetMasterCategories_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'WorksheetMasters')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterCategories");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "[WorksheetMaster_Idn]=" . AdjustSql($this->WorksheetMaster_Idn->CurrentValue, $this->Dbid) . "";

		// Column "detail_WorksheetMasterSizes"
		if ($this->DetailPages && $this->DetailPages["WorksheetMasterSizes"] && $this->DetailPages["WorksheetMasterSizes"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_WorksheetMasterSizes"];
			$url = "WorksheetMasterSizespreview.php?t=WorksheetMasters&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"WorksheetMasterSizes\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'WorksheetMasters')) {
				$label = $Language->TablePhrase("WorksheetMasterSizes", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"WorksheetMasterSizes\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("WorksheetMasterSizeslist.php?" . Config("TABLE_SHOW_MASTER") . "=WorksheetMasters&fk_WorksheetMaster_Idn=" . urlencode(strval($this->WorksheetMaster_Idn->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("WorksheetMasterSizes", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["WorksheetMasterSizes_grid"]))
				$GLOBALS["WorksheetMasterSizes_grid"] = new WorksheetMasterSizes_grid();
			if ($GLOBALS["WorksheetMasterSizes_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'WorksheetMasters')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterSizes");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["WorksheetMasterSizes_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'WorksheetMasters')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterSizes");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["WorksheetMasterSizes_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'WorksheetMasters')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=WorksheetMasterSizes");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}

		// Hide detail items if necessary
		$this->ListOptions->hideDetailItemsForDropDown();

		// Column "preview"
		$option = $this->ListOptions["preview"];
		if (!$option) { // Add preview column
			$option = &$this->ListOptions->add("preview");
			$option->OnLeft = TRUE;
			if ($option->OnLeft) {
				$option->moveTo($this->ListOptions->itemPos("checkbox") + 1);
			} else {
				$option->moveTo($this->ListOptions->itemPos("checkbox"));
			}
			$option->Visible = !($this->isExport() || $this->isGridAdd() || $this->isGridEdit());
			$option->ShowInDropDown = FALSE;
			$option->ShowInButtonGroup = FALSE;
		}
		if ($option) {
			$option->Body = "<i class=\"ew-preview-row-btn ew-icon icon-expand\"></i>";
			$option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
			if ($option->Visible)
				$option->Visible = $links != "";
		}

		// Column "details" (Multiple details)
		$option = $this->ListOptions["details"];
		if ($option) {
			$option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
			if ($option->Visible)
				$option->Visible = $links != "";
		}
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->WorksheetMaster_Idn->CurrentValue = NULL;
		$this->WorksheetMaster_Idn->OldValue = $this->WorksheetMaster_Idn->CurrentValue;
		$this->Name->CurrentValue = "NULL";
		$this->Name->OldValue = $this->Name->CurrentValue;
		$this->Department_Idn->CurrentValue = 0;
		$this->Department_Idn->OldValue = $this->Department_Idn->CurrentValue;
		$this->Rank->CurrentValue = 0;
		$this->Rank->OldValue = $this->Rank->CurrentValue;
		$this->NumberOfColumns->CurrentValue = 0;
		$this->NumberOfColumns->OldValue = $this->NumberOfColumns->CurrentValue;
		$this->AllowMultiple->CurrentValue = 0;
		$this->AllowMultiple->OldValue = $this->AllowMultiple->CurrentValue;
		$this->DisplayAdjustmentFactors->CurrentValue = 0;
		$this->DisplayAdjustmentFactors->OldValue = $this->DisplayAdjustmentFactors->CurrentValue;
		$this->DisplayWorksheetDetails->CurrentValue = 0;
		$this->DisplayWorksheetDetails->OldValue = $this->DisplayWorksheetDetails->CurrentValue;
		$this->DisplayShopFabrication->CurrentValue = 0;
		$this->DisplayShopFabrication->OldValue = $this->DisplayShopFabrication->CurrentValue;
		$this->DisplayWorksheetName->CurrentValue = 1;
		$this->DisplayWorksheetName->OldValue = $this->DisplayWorksheetName->CurrentValue;
		$this->DisplayWorksheetHeader->CurrentValue = 1;
		$this->DisplayWorksheetHeader->OldValue = $this->DisplayWorksheetHeader->CurrentValue;
		$this->UseRadioButtonsForSizes->CurrentValue = 0;
		$this->UseRadioButtonsForSizes->OldValue = $this->UseRadioButtonsForSizes->CurrentValue;
		$this->DisplayFieldHoursOverride->CurrentValue = 0;
		$this->DisplayFieldHoursOverride->OldValue = $this->DisplayFieldHoursOverride->CurrentValue;
		$this->DisplayShopHours->CurrentValue = 0;
		$this->DisplayShopHours->OldValue = $this->DisplayShopHours->CurrentValue;
		$this->DisplayShopHoursOverride->CurrentValue = 0;
		$this->DisplayShopHoursOverride->OldValue = $this->DisplayShopHoursOverride->CurrentValue;
		$this->DisplayUserShopHoursOnly->CurrentValue = 0;
		$this->DisplayUserShopHoursOnly->OldValue = $this->DisplayUserShopHoursOnly->CurrentValue;
		$this->DisplayPipeExposure->CurrentValue = 0;
		$this->DisplayPipeExposure->OldValue = $this->DisplayPipeExposure->CurrentValue;
		$this->DisplayVolumeCorrection->CurrentValue = 0;
		$this->DisplayVolumeCorrection->OldValue = $this->DisplayVolumeCorrection->CurrentValue;
		$this->DisplayManhourAdjustment->CurrentValue = 0;
		$this->DisplayManhourAdjustment->OldValue = $this->DisplayManhourAdjustment->CurrentValue;
		$this->IsSubcontractWorksheet->CurrentValue = 0;
		$this->IsSubcontractWorksheet->OldValue = $this->IsSubcontractWorksheet->CurrentValue;
		$this->DisplayDeleteItemsButtons->CurrentValue = 1;
		$this->DisplayDeleteItemsButtons->OldValue = $this->DisplayDeleteItemsButtons->CurrentValue;
		$this->ActiveFlag->CurrentValue = 1;
		$this->ActiveFlag->OldValue = $this->ActiveFlag->CurrentValue;
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;

		// WorksheetMaster_Idn
		if (!$this->isAddOrEdit() && $this->WorksheetMaster_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->WorksheetMaster_Idn->AdvancedSearch->SearchValue != "" || $this->WorksheetMaster_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Name
		if (!$this->isAddOrEdit() && $this->Name->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Name->AdvancedSearch->SearchValue != "" || $this->Name->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Department_Idn
		if (!$this->isAddOrEdit() && $this->Department_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Department_Idn->AdvancedSearch->SearchValue != "" || $this->Department_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Rank
		if (!$this->isAddOrEdit() && $this->Rank->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Rank->AdvancedSearch->SearchValue != "" || $this->Rank->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// NumberOfColumns
		if (!$this->isAddOrEdit() && $this->NumberOfColumns->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->NumberOfColumns->AdvancedSearch->SearchValue != "" || $this->NumberOfColumns->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AllowMultiple
		if (!$this->isAddOrEdit() && $this->AllowMultiple->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AllowMultiple->AdvancedSearch->SearchValue != "" || $this->AllowMultiple->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->AllowMultiple->AdvancedSearch->SearchValue))
			$this->AllowMultiple->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->AllowMultiple->AdvancedSearch->SearchValue);
		if (is_array($this->AllowMultiple->AdvancedSearch->SearchValue2))
			$this->AllowMultiple->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->AllowMultiple->AdvancedSearch->SearchValue2);

		// DisplayAdjustmentFactors
		if (!$this->isAddOrEdit() && $this->DisplayAdjustmentFactors->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayAdjustmentFactors->AdvancedSearch->SearchValue != "" || $this->DisplayAdjustmentFactors->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayAdjustmentFactors->AdvancedSearch->SearchValue))
			$this->DisplayAdjustmentFactors->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayAdjustmentFactors->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayAdjustmentFactors->AdvancedSearch->SearchValue2))
			$this->DisplayAdjustmentFactors->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayAdjustmentFactors->AdvancedSearch->SearchValue2);

		// DisplayWorksheetDetails
		if (!$this->isAddOrEdit() && $this->DisplayWorksheetDetails->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayWorksheetDetails->AdvancedSearch->SearchValue != "" || $this->DisplayWorksheetDetails->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayWorksheetDetails->AdvancedSearch->SearchValue))
			$this->DisplayWorksheetDetails->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayWorksheetDetails->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayWorksheetDetails->AdvancedSearch->SearchValue2))
			$this->DisplayWorksheetDetails->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayWorksheetDetails->AdvancedSearch->SearchValue2);

		// DisplayShopFabrication
		if (!$this->isAddOrEdit() && $this->DisplayShopFabrication->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayShopFabrication->AdvancedSearch->SearchValue != "" || $this->DisplayShopFabrication->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayShopFabrication->AdvancedSearch->SearchValue))
			$this->DisplayShopFabrication->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayShopFabrication->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayShopFabrication->AdvancedSearch->SearchValue2))
			$this->DisplayShopFabrication->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayShopFabrication->AdvancedSearch->SearchValue2);

		// DisplayWorksheetName
		if (!$this->isAddOrEdit() && $this->DisplayWorksheetName->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayWorksheetName->AdvancedSearch->SearchValue != "" || $this->DisplayWorksheetName->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayWorksheetName->AdvancedSearch->SearchValue))
			$this->DisplayWorksheetName->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayWorksheetName->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayWorksheetName->AdvancedSearch->SearchValue2))
			$this->DisplayWorksheetName->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayWorksheetName->AdvancedSearch->SearchValue2);

		// DisplayWorksheetHeader
		if (!$this->isAddOrEdit() && $this->DisplayWorksheetHeader->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayWorksheetHeader->AdvancedSearch->SearchValue != "" || $this->DisplayWorksheetHeader->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayWorksheetHeader->AdvancedSearch->SearchValue))
			$this->DisplayWorksheetHeader->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayWorksheetHeader->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayWorksheetHeader->AdvancedSearch->SearchValue2))
			$this->DisplayWorksheetHeader->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayWorksheetHeader->AdvancedSearch->SearchValue2);

		// UseRadioButtonsForSizes
		if (!$this->isAddOrEdit() && $this->UseRadioButtonsForSizes->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->UseRadioButtonsForSizes->AdvancedSearch->SearchValue != "" || $this->UseRadioButtonsForSizes->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->UseRadioButtonsForSizes->AdvancedSearch->SearchValue))
			$this->UseRadioButtonsForSizes->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->UseRadioButtonsForSizes->AdvancedSearch->SearchValue);
		if (is_array($this->UseRadioButtonsForSizes->AdvancedSearch->SearchValue2))
			$this->UseRadioButtonsForSizes->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->UseRadioButtonsForSizes->AdvancedSearch->SearchValue2);

		// DisplayFieldHoursOverride
		if (!$this->isAddOrEdit() && $this->DisplayFieldHoursOverride->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayFieldHoursOverride->AdvancedSearch->SearchValue != "" || $this->DisplayFieldHoursOverride->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayFieldHoursOverride->AdvancedSearch->SearchValue))
			$this->DisplayFieldHoursOverride->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayFieldHoursOverride->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayFieldHoursOverride->AdvancedSearch->SearchValue2))
			$this->DisplayFieldHoursOverride->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayFieldHoursOverride->AdvancedSearch->SearchValue2);

		// DisplayShopHours
		if (!$this->isAddOrEdit() && $this->DisplayShopHours->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayShopHours->AdvancedSearch->SearchValue != "" || $this->DisplayShopHours->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayShopHours->AdvancedSearch->SearchValue))
			$this->DisplayShopHours->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayShopHours->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayShopHours->AdvancedSearch->SearchValue2))
			$this->DisplayShopHours->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayShopHours->AdvancedSearch->SearchValue2);

		// DisplayShopHoursOverride
		if (!$this->isAddOrEdit() && $this->DisplayShopHoursOverride->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayShopHoursOverride->AdvancedSearch->SearchValue != "" || $this->DisplayShopHoursOverride->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayShopHoursOverride->AdvancedSearch->SearchValue))
			$this->DisplayShopHoursOverride->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayShopHoursOverride->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayShopHoursOverride->AdvancedSearch->SearchValue2))
			$this->DisplayShopHoursOverride->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayShopHoursOverride->AdvancedSearch->SearchValue2);

		// DisplayUserShopHoursOnly
		if (!$this->isAddOrEdit() && $this->DisplayUserShopHoursOnly->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayUserShopHoursOnly->AdvancedSearch->SearchValue != "" || $this->DisplayUserShopHoursOnly->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayUserShopHoursOnly->AdvancedSearch->SearchValue))
			$this->DisplayUserShopHoursOnly->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayUserShopHoursOnly->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayUserShopHoursOnly->AdvancedSearch->SearchValue2))
			$this->DisplayUserShopHoursOnly->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayUserShopHoursOnly->AdvancedSearch->SearchValue2);

		// DisplayPipeExposure
		if (!$this->isAddOrEdit() && $this->DisplayPipeExposure->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayPipeExposure->AdvancedSearch->SearchValue != "" || $this->DisplayPipeExposure->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayPipeExposure->AdvancedSearch->SearchValue))
			$this->DisplayPipeExposure->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayPipeExposure->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayPipeExposure->AdvancedSearch->SearchValue2))
			$this->DisplayPipeExposure->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayPipeExposure->AdvancedSearch->SearchValue2);

		// DisplayVolumeCorrection
		if (!$this->isAddOrEdit() && $this->DisplayVolumeCorrection->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayVolumeCorrection->AdvancedSearch->SearchValue != "" || $this->DisplayVolumeCorrection->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayVolumeCorrection->AdvancedSearch->SearchValue))
			$this->DisplayVolumeCorrection->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayVolumeCorrection->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayVolumeCorrection->AdvancedSearch->SearchValue2))
			$this->DisplayVolumeCorrection->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayVolumeCorrection->AdvancedSearch->SearchValue2);

		// DisplayManhourAdjustment
		if (!$this->isAddOrEdit() && $this->DisplayManhourAdjustment->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayManhourAdjustment->AdvancedSearch->SearchValue != "" || $this->DisplayManhourAdjustment->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayManhourAdjustment->AdvancedSearch->SearchValue))
			$this->DisplayManhourAdjustment->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayManhourAdjustment->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayManhourAdjustment->AdvancedSearch->SearchValue2))
			$this->DisplayManhourAdjustment->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayManhourAdjustment->AdvancedSearch->SearchValue2);

		// IsSubcontractWorksheet
		if (!$this->isAddOrEdit() && $this->IsSubcontractWorksheet->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IsSubcontractWorksheet->AdvancedSearch->SearchValue != "" || $this->IsSubcontractWorksheet->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->IsSubcontractWorksheet->AdvancedSearch->SearchValue))
			$this->IsSubcontractWorksheet->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->IsSubcontractWorksheet->AdvancedSearch->SearchValue);
		if (is_array($this->IsSubcontractWorksheet->AdvancedSearch->SearchValue2))
			$this->IsSubcontractWorksheet->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->IsSubcontractWorksheet->AdvancedSearch->SearchValue2);

		// DisplayDeleteItemsButtons
		if (!$this->isAddOrEdit() && $this->DisplayDeleteItemsButtons->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DisplayDeleteItemsButtons->AdvancedSearch->SearchValue != "" || $this->DisplayDeleteItemsButtons->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DisplayDeleteItemsButtons->AdvancedSearch->SearchValue))
			$this->DisplayDeleteItemsButtons->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayDeleteItemsButtons->AdvancedSearch->SearchValue);
		if (is_array($this->DisplayDeleteItemsButtons->AdvancedSearch->SearchValue2))
			$this->DisplayDeleteItemsButtons->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DisplayDeleteItemsButtons->AdvancedSearch->SearchValue2);

		// ActiveFlag
		if (!$this->isAddOrEdit() && $this->ActiveFlag->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ActiveFlag->AdvancedSearch->SearchValue != "" || $this->ActiveFlag->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->ActiveFlag->AdvancedSearch->SearchValue))
			$this->ActiveFlag->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ActiveFlag->AdvancedSearch->SearchValue);
		if (is_array($this->ActiveFlag->AdvancedSearch->SearchValue2))
			$this->ActiveFlag->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ActiveFlag->AdvancedSearch->SearchValue2);
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'WorksheetMaster_Idn' first before field var 'x_WorksheetMaster_Idn'
		$val = $CurrentForm->hasValue("WorksheetMaster_Idn") ? $CurrentForm->getValue("WorksheetMaster_Idn") : $CurrentForm->getValue("x_WorksheetMaster_Idn");
		if (!$this->WorksheetMaster_Idn->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->WorksheetMaster_Idn->setFormValue($val);

		// Check field name 'Name' first before field var 'x_Name'
		$val = $CurrentForm->hasValue("Name") ? $CurrentForm->getValue("Name") : $CurrentForm->getValue("x_Name");
		if (!$this->Name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Name->Visible = FALSE; // Disable update for API request
			else
				$this->Name->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Name"))
			$this->Name->setOldValue($CurrentForm->getValue("o_Name"));

		// Check field name 'Department_Idn' first before field var 'x_Department_Idn'
		$val = $CurrentForm->hasValue("Department_Idn") ? $CurrentForm->getValue("Department_Idn") : $CurrentForm->getValue("x_Department_Idn");
		if (!$this->Department_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Department_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Department_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Department_Idn"))
			$this->Department_Idn->setOldValue($CurrentForm->getValue("o_Department_Idn"));

		// Check field name 'Rank' first before field var 'x_Rank'
		$val = $CurrentForm->hasValue("Rank") ? $CurrentForm->getValue("Rank") : $CurrentForm->getValue("x_Rank");
		if (!$this->Rank->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Rank->Visible = FALSE; // Disable update for API request
			else
				$this->Rank->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Rank"))
			$this->Rank->setOldValue($CurrentForm->getValue("o_Rank"));

		// Check field name 'NumberOfColumns' first before field var 'x_NumberOfColumns'
		$val = $CurrentForm->hasValue("NumberOfColumns") ? $CurrentForm->getValue("NumberOfColumns") : $CurrentForm->getValue("x_NumberOfColumns");
		if (!$this->NumberOfColumns->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->NumberOfColumns->Visible = FALSE; // Disable update for API request
			else
				$this->NumberOfColumns->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_NumberOfColumns"))
			$this->NumberOfColumns->setOldValue($CurrentForm->getValue("o_NumberOfColumns"));

		// Check field name 'AllowMultiple' first before field var 'x_AllowMultiple'
		$val = $CurrentForm->hasValue("AllowMultiple") ? $CurrentForm->getValue("AllowMultiple") : $CurrentForm->getValue("x_AllowMultiple");
		if (!$this->AllowMultiple->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->AllowMultiple->Visible = FALSE; // Disable update for API request
			else
				$this->AllowMultiple->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AllowMultiple"))
			$this->AllowMultiple->setOldValue($CurrentForm->getValue("o_AllowMultiple"));

		// Check field name 'ActiveFlag' first before field var 'x_ActiveFlag'
		$val = $CurrentForm->hasValue("ActiveFlag") ? $CurrentForm->getValue("ActiveFlag") : $CurrentForm->getValue("x_ActiveFlag");
		if (!$this->ActiveFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ActiveFlag->Visible = FALSE; // Disable update for API request
			else
				$this->ActiveFlag->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ActiveFlag"))
			$this->ActiveFlag->setOldValue($CurrentForm->getValue("o_ActiveFlag"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->WorksheetMaster_Idn->CurrentValue = $this->WorksheetMaster_Idn->FormValue;
		$this->Name->CurrentValue = $this->Name->FormValue;
		$this->Department_Idn->CurrentValue = $this->Department_Idn->FormValue;
		$this->Rank->CurrentValue = $this->Rank->FormValue;
		$this->NumberOfColumns->CurrentValue = $this->NumberOfColumns->FormValue;
		$this->AllowMultiple->CurrentValue = $this->AllowMultiple->FormValue;
		$this->ActiveFlag->CurrentValue = $this->ActiveFlag->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			if (!$this->EventCancelled)
				$this->HashValue = $this->getRowHash($rs); // Get hash value for record
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->WorksheetMaster_Idn->setDbValue($row['WorksheetMaster_Idn']);
		$this->Name->setDbValue($row['Name']);
		$this->Department_Idn->setDbValue($row['Department_Idn']);
		$this->Rank->setDbValue($row['Rank']);
		$this->NumberOfColumns->setDbValue($row['NumberOfColumns']);
		$this->AllowMultiple->setDbValue((ConvertToBool($row['AllowMultiple']) ? "1" : "0"));
		$this->DisplayAdjustmentFactors->setDbValue((ConvertToBool($row['DisplayAdjustmentFactors']) ? "1" : "0"));
		$this->DisplayWorksheetDetails->setDbValue((ConvertToBool($row['DisplayWorksheetDetails']) ? "1" : "0"));
		$this->DisplayShopFabrication->setDbValue((ConvertToBool($row['DisplayShopFabrication']) ? "1" : "0"));
		$this->DisplayWorksheetName->setDbValue((ConvertToBool($row['DisplayWorksheetName']) ? "1" : "0"));
		$this->DisplayWorksheetHeader->setDbValue((ConvertToBool($row['DisplayWorksheetHeader']) ? "1" : "0"));
		$this->UseRadioButtonsForSizes->setDbValue((ConvertToBool($row['UseRadioButtonsForSizes']) ? "1" : "0"));
		$this->DisplayFieldHoursOverride->setDbValue((ConvertToBool($row['DisplayFieldHoursOverride']) ? "1" : "0"));
		$this->DisplayShopHours->setDbValue((ConvertToBool($row['DisplayShopHours']) ? "1" : "0"));
		$this->DisplayShopHoursOverride->setDbValue((ConvertToBool($row['DisplayShopHoursOverride']) ? "1" : "0"));
		$this->DisplayUserShopHoursOnly->setDbValue((ConvertToBool($row['DisplayUserShopHoursOnly']) ? "1" : "0"));
		$this->DisplayPipeExposure->setDbValue((ConvertToBool($row['DisplayPipeExposure']) ? "1" : "0"));
		$this->DisplayVolumeCorrection->setDbValue((ConvertToBool($row['DisplayVolumeCorrection']) ? "1" : "0"));
		$this->DisplayManhourAdjustment->setDbValue((ConvertToBool($row['DisplayManhourAdjustment']) ? "1" : "0"));
		$this->IsSubcontractWorksheet->setDbValue((ConvertToBool($row['IsSubcontractWorksheet']) ? "1" : "0"));
		$this->DisplayDeleteItemsButtons->setDbValue((ConvertToBool($row['DisplayDeleteItemsButtons']) ? "1" : "0"));
		$this->ActiveFlag->setDbValue((ConvertToBool($row['ActiveFlag']) ? "1" : "0"));
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['WorksheetMaster_Idn'] = $this->WorksheetMaster_Idn->CurrentValue;
		$row['Name'] = $this->Name->CurrentValue;
		$row['Department_Idn'] = $this->Department_Idn->CurrentValue;
		$row['Rank'] = $this->Rank->CurrentValue;
		$row['NumberOfColumns'] = $this->NumberOfColumns->CurrentValue;
		$row['AllowMultiple'] = $this->AllowMultiple->CurrentValue;
		$row['DisplayAdjustmentFactors'] = $this->DisplayAdjustmentFactors->CurrentValue;
		$row['DisplayWorksheetDetails'] = $this->DisplayWorksheetDetails->CurrentValue;
		$row['DisplayShopFabrication'] = $this->DisplayShopFabrication->CurrentValue;
		$row['DisplayWorksheetName'] = $this->DisplayWorksheetName->CurrentValue;
		$row['DisplayWorksheetHeader'] = $this->DisplayWorksheetHeader->CurrentValue;
		$row['UseRadioButtonsForSizes'] = $this->UseRadioButtonsForSizes->CurrentValue;
		$row['DisplayFieldHoursOverride'] = $this->DisplayFieldHoursOverride->CurrentValue;
		$row['DisplayShopHours'] = $this->DisplayShopHours->CurrentValue;
		$row['DisplayShopHoursOverride'] = $this->DisplayShopHoursOverride->CurrentValue;
		$row['DisplayUserShopHoursOnly'] = $this->DisplayUserShopHoursOnly->CurrentValue;
		$row['DisplayPipeExposure'] = $this->DisplayPipeExposure->CurrentValue;
		$row['DisplayVolumeCorrection'] = $this->DisplayVolumeCorrection->CurrentValue;
		$row['DisplayManhourAdjustment'] = $this->DisplayManhourAdjustment->CurrentValue;
		$row['IsSubcontractWorksheet'] = $this->IsSubcontractWorksheet->CurrentValue;
		$row['DisplayDeleteItemsButtons'] = $this->DisplayDeleteItemsButtons->CurrentValue;
		$row['ActiveFlag'] = $this->ActiveFlag->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("WorksheetMaster_Idn")) != "")
			$this->WorksheetMaster_Idn->OldValue = $this->getKey("WorksheetMaster_Idn"); // WorksheetMaster_Idn
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// ActiveFlag
			$this->ActiveFlag->LinkCustomAttributes = "";
			$this->ActiveFlag->HrefValue = "";
			$this->ActiveFlag->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// WorksheetMaster_Idn
			// Name

			$this->Name->EditAttrs["class"] = "form-control";
			$this->Name->EditCustomAttributes = "";
			if (!$this->Name->Raw)
				$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
			$this->Name->EditValue = HtmlEncode($this->Name->CurrentValue);
			$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

			// Department_Idn
			$this->Department_Idn->EditAttrs["class"] = "form-control";
			$this->Department_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->Department_Idn->CurrentValue));
			if ($curVal != "")
				$this->Department_Idn->ViewValue = $this->Department_Idn->lookupCacheOption($curVal);
			else
				$this->Department_Idn->ViewValue = $this->Department_Idn->Lookup !== NULL && is_array($this->Department_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Department_Idn->ViewValue !== NULL) { // Load from cache
				$this->Department_Idn->EditValue = array_values($this->Department_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[DepartmentId]" . SearchString("=", $this->Department_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Department_Idn->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Department_Idn->EditValue = $arwrk;
			}

			// Rank
			$this->Rank->EditAttrs["class"] = "form-control";
			$this->Rank->EditCustomAttributes = "";
			$this->Rank->EditValue = HtmlEncode($this->Rank->CurrentValue);
			$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

			// NumberOfColumns
			$this->NumberOfColumns->EditAttrs["class"] = "form-control";
			$this->NumberOfColumns->EditCustomAttributes = "";
			$this->NumberOfColumns->EditValue = HtmlEncode($this->NumberOfColumns->CurrentValue);
			$this->NumberOfColumns->PlaceHolder = RemoveHtml($this->NumberOfColumns->caption());

			// AllowMultiple
			$this->AllowMultiple->EditCustomAttributes = "";
			$this->AllowMultiple->EditValue = $this->AllowMultiple->options(FALSE);

			// ActiveFlag
			$this->ActiveFlag->EditCustomAttributes = "";
			$this->ActiveFlag->EditValue = $this->ActiveFlag->options(FALSE);

			// Add refer script
			// WorksheetMaster_Idn

			$this->WorksheetMaster_Idn->LinkCustomAttributes = "";
			$this->WorksheetMaster_Idn->HrefValue = "";

			// Name
			$this->Name->LinkCustomAttributes = "";
			$this->Name->HrefValue = "";

			// Department_Idn
			$this->Department_Idn->LinkCustomAttributes = "";
			$this->Department_Idn->HrefValue = "";

			// Rank
			$this->Rank->LinkCustomAttributes = "";
			$this->Rank->HrefValue = "";

			// NumberOfColumns
			$this->NumberOfColumns->LinkCustomAttributes = "";
			$this->NumberOfColumns->HrefValue = "";

			// AllowMultiple
			$this->AllowMultiple->LinkCustomAttributes = "";
			$this->AllowMultiple->HrefValue = "";

			// ActiveFlag
			$this->ActiveFlag->LinkCustomAttributes = "";
			$this->ActiveFlag->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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
			$this->Name->EditValue = HtmlEncode($this->Name->CurrentValue);
			$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

			// Department_Idn
			$this->Department_Idn->EditAttrs["class"] = "form-control";
			$this->Department_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->Department_Idn->CurrentValue));
			if ($curVal != "")
				$this->Department_Idn->ViewValue = $this->Department_Idn->lookupCacheOption($curVal);
			else
				$this->Department_Idn->ViewValue = $this->Department_Idn->Lookup !== NULL && is_array($this->Department_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Department_Idn->ViewValue !== NULL) { // Load from cache
				$this->Department_Idn->EditValue = array_values($this->Department_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[DepartmentId]" . SearchString("=", $this->Department_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Department_Idn->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Department_Idn->EditValue = $arwrk;
			}

			// Rank
			$this->Rank->EditAttrs["class"] = "form-control";
			$this->Rank->EditCustomAttributes = "";
			$this->Rank->EditValue = HtmlEncode($this->Rank->CurrentValue);
			$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

			// NumberOfColumns
			$this->NumberOfColumns->EditAttrs["class"] = "form-control";
			$this->NumberOfColumns->EditCustomAttributes = "";
			$this->NumberOfColumns->EditValue = HtmlEncode($this->NumberOfColumns->CurrentValue);
			$this->NumberOfColumns->PlaceHolder = RemoveHtml($this->NumberOfColumns->caption());

			// AllowMultiple
			$this->AllowMultiple->EditCustomAttributes = "";
			$this->AllowMultiple->EditValue = $this->AllowMultiple->options(FALSE);

			// ActiveFlag
			$this->ActiveFlag->EditCustomAttributes = "";
			$this->ActiveFlag->EditValue = $this->ActiveFlag->options(FALSE);

			// Edit refer script
			// WorksheetMaster_Idn

			$this->WorksheetMaster_Idn->LinkCustomAttributes = "";
			$this->WorksheetMaster_Idn->HrefValue = "";

			// Name
			$this->Name->LinkCustomAttributes = "";
			$this->Name->HrefValue = "";

			// Department_Idn
			$this->Department_Idn->LinkCustomAttributes = "";
			$this->Department_Idn->HrefValue = "";

			// Rank
			$this->Rank->LinkCustomAttributes = "";
			$this->Rank->HrefValue = "";

			// NumberOfColumns
			$this->NumberOfColumns->LinkCustomAttributes = "";
			$this->NumberOfColumns->HrefValue = "";

			// AllowMultiple
			$this->AllowMultiple->LinkCustomAttributes = "";
			$this->AllowMultiple->HrefValue = "";

			// ActiveFlag
			$this->ActiveFlag->LinkCustomAttributes = "";
			$this->ActiveFlag->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// WorksheetMaster_Idn
			$this->WorksheetMaster_Idn->EditAttrs["class"] = "form-control";
			$this->WorksheetMaster_Idn->EditCustomAttributes = "";
			$this->WorksheetMaster_Idn->EditValue = HtmlEncode($this->WorksheetMaster_Idn->AdvancedSearch->SearchValue);
			$this->WorksheetMaster_Idn->PlaceHolder = RemoveHtml($this->WorksheetMaster_Idn->caption());

			// Name
			$this->Name->EditAttrs["class"] = "form-control";
			$this->Name->EditCustomAttributes = "";
			if (!$this->Name->Raw)
				$this->Name->AdvancedSearch->SearchValue = HtmlDecode($this->Name->AdvancedSearch->SearchValue);
			$this->Name->EditValue = HtmlEncode($this->Name->AdvancedSearch->SearchValue);
			$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

			// Department_Idn
			$this->Department_Idn->EditAttrs["class"] = "form-control";
			$this->Department_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->Department_Idn->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Department_Idn->AdvancedSearch->ViewValue = $this->Department_Idn->lookupCacheOption($curVal);
			else
				$this->Department_Idn->AdvancedSearch->ViewValue = $this->Department_Idn->Lookup !== NULL && is_array($this->Department_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Department_Idn->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Department_Idn->EditValue = array_values($this->Department_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[DepartmentId]" . SearchString("=", $this->Department_Idn->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Department_Idn->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Department_Idn->EditValue = $arwrk;
			}

			// Rank
			$this->Rank->EditAttrs["class"] = "form-control";
			$this->Rank->EditCustomAttributes = "";
			$this->Rank->EditValue = HtmlEncode($this->Rank->AdvancedSearch->SearchValue);
			$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

			// NumberOfColumns
			$this->NumberOfColumns->EditAttrs["class"] = "form-control";
			$this->NumberOfColumns->EditCustomAttributes = "";
			$this->NumberOfColumns->EditValue = HtmlEncode($this->NumberOfColumns->AdvancedSearch->SearchValue);
			$this->NumberOfColumns->PlaceHolder = RemoveHtml($this->NumberOfColumns->caption());

			// AllowMultiple
			$this->AllowMultiple->EditCustomAttributes = "";
			$this->AllowMultiple->EditValue = $this->AllowMultiple->options(FALSE);

			// ActiveFlag
			$this->ActiveFlag->EditCustomAttributes = "";
			$this->ActiveFlag->EditValue = $this->ActiveFlag->options(FALSE);
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return TRUE;

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->WorksheetMaster_Idn->Required) {
			if (!$this->WorksheetMaster_Idn->IsDetailKey && $this->WorksheetMaster_Idn->FormValue != NULL && $this->WorksheetMaster_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->WorksheetMaster_Idn->caption(), $this->WorksheetMaster_Idn->RequiredErrorMessage));
			}
		}
		if ($this->Name->Required) {
			if (!$this->Name->IsDetailKey && $this->Name->FormValue != NULL && $this->Name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Name->caption(), $this->Name->RequiredErrorMessage));
			}
		}
		if ($this->Department_Idn->Required) {
			if (!$this->Department_Idn->IsDetailKey && $this->Department_Idn->FormValue != NULL && $this->Department_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Department_Idn->caption(), $this->Department_Idn->RequiredErrorMessage));
			}
		}
		if ($this->Rank->Required) {
			if (!$this->Rank->IsDetailKey && $this->Rank->FormValue != NULL && $this->Rank->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Rank->caption(), $this->Rank->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Rank->FormValue)) {
			AddMessage($FormError, $this->Rank->errorMessage());
		}
		if ($this->NumberOfColumns->Required) {
			if (!$this->NumberOfColumns->IsDetailKey && $this->NumberOfColumns->FormValue != NULL && $this->NumberOfColumns->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NumberOfColumns->caption(), $this->NumberOfColumns->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->NumberOfColumns->FormValue)) {
			AddMessage($FormError, $this->NumberOfColumns->errorMessage());
		}
		if ($this->AllowMultiple->Required) {
			if ($this->AllowMultiple->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AllowMultiple->caption(), $this->AllowMultiple->RequiredErrorMessage));
			}
		}
		if ($this->ActiveFlag->Required) {
			if ($this->ActiveFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActiveFlag->caption(), $this->ActiveFlag->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['WorksheetMaster_Idn'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// Name
			$this->Name->setDbValueDef($rsnew, $this->Name->CurrentValue, NULL, $this->Name->ReadOnly);

			// Department_Idn
			$this->Department_Idn->setDbValueDef($rsnew, $this->Department_Idn->CurrentValue, NULL, $this->Department_Idn->ReadOnly);

			// Rank
			$this->Rank->setDbValueDef($rsnew, $this->Rank->CurrentValue, NULL, $this->Rank->ReadOnly);

			// NumberOfColumns
			$this->NumberOfColumns->setDbValueDef($rsnew, $this->NumberOfColumns->CurrentValue, NULL, $this->NumberOfColumns->ReadOnly);

			// AllowMultiple
			$tmpBool = $this->AllowMultiple->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->AllowMultiple->setDbValueDef($rsnew, $tmpBool, NULL, $this->AllowMultiple->ReadOnly);

			// ActiveFlag
			$tmpBool = $this->ActiveFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->ActiveFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->ActiveFlag->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Load row hash
	protected function loadRowHash()
	{
		$filter = $this->getRecordFilter();

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$rsRow = $conn->Execute($sql);
		$this->HashValue = ($rsRow && !$rsRow->EOF) ? $this->getRowHash($rsRow) : ""; // Get hash value for record
		$rsRow->close();
	}

	// Get Row Hash
	public function getRowHash(&$rs)
	{
		if (!$rs)
			return "";
		$hash = "";
		$hash .= GetFieldHash($rs->fields('Name')); // Name
		$hash .= GetFieldHash($rs->fields('Department_Idn')); // Department_Idn
		$hash .= GetFieldHash($rs->fields('Rank')); // Rank
		$hash .= GetFieldHash($rs->fields('NumberOfColumns')); // NumberOfColumns
		$hash .= GetFieldHash($rs->fields('AllowMultiple')); // AllowMultiple
		$hash .= GetFieldHash($rs->fields('ActiveFlag')); // ActiveFlag
		return md5($hash);
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// Name
		$this->Name->setDbValueDef($rsnew, $this->Name->CurrentValue, NULL, strval($this->Name->CurrentValue) == "");

		// Department_Idn
		$this->Department_Idn->setDbValueDef($rsnew, $this->Department_Idn->CurrentValue, NULL, strval($this->Department_Idn->CurrentValue) == "");

		// Rank
		$this->Rank->setDbValueDef($rsnew, $this->Rank->CurrentValue, NULL, strval($this->Rank->CurrentValue) == "");

		// NumberOfColumns
		$this->NumberOfColumns->setDbValueDef($rsnew, $this->NumberOfColumns->CurrentValue, NULL, strval($this->NumberOfColumns->CurrentValue) == "");

		// AllowMultiple
		$tmpBool = $this->AllowMultiple->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->AllowMultiple->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->AllowMultiple->CurrentValue) == "");

		// ActiveFlag
		$tmpBool = $this->ActiveFlag->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->ActiveFlag->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->ActiveFlag->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->WorksheetMaster_Idn->AdvancedSearch->load();
		$this->Name->AdvancedSearch->load();
		$this->Department_Idn->AdvancedSearch->load();
		$this->Rank->AdvancedSearch->load();
		$this->NumberOfColumns->AdvancedSearch->load();
		$this->AllowMultiple->AdvancedSearch->load();
		$this->DisplayAdjustmentFactors->AdvancedSearch->load();
		$this->DisplayWorksheetDetails->AdvancedSearch->load();
		$this->DisplayShopFabrication->AdvancedSearch->load();
		$this->DisplayWorksheetName->AdvancedSearch->load();
		$this->DisplayWorksheetHeader->AdvancedSearch->load();
		$this->UseRadioButtonsForSizes->AdvancedSearch->load();
		$this->DisplayFieldHoursOverride->AdvancedSearch->load();
		$this->DisplayShopHours->AdvancedSearch->load();
		$this->DisplayShopHoursOverride->AdvancedSearch->load();
		$this->DisplayUserShopHoursOnly->AdvancedSearch->load();
		$this->DisplayPipeExposure->AdvancedSearch->load();
		$this->DisplayVolumeCorrection->AdvancedSearch->load();
		$this->DisplayManhourAdjustment->AdvancedSearch->load();
		$this->IsSubcontractWorksheet->AdvancedSearch->load();
		$this->DisplayDeleteItemsButtons->AdvancedSearch->load();
		$this->ActiveFlag->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fWorksheetMasterslist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fWorksheetMasterslist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fWorksheetMasterslist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "email")) {
			$url = $custom ? ",url:'" . $this->pageUrl() . "export=email&amp;custom=1'" : "";
			return '<button id="emf_WorksheetMasters" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_WorksheetMasters\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fWorksheetMasterslist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = FALSE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fWorksheetMasterslistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");
		$selectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecords = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecords = $rs->RecordCount();
		}
		$this->StartRecord = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
			$this->DisplayRecords = $this->TotalRecords;
			$this->StopRecord = $this->TotalRecords;
		} else { // Export one page only
			$this->setupStartRecord(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecords <= 0) {
				$this->StopRecord = $this->TotalRecords;
			} else {
				$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
			}
		}
		if ($selectLimit)
			$rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
		$this->ExportDoc = GetExportDocument($this, "h");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRecord = 1;
			$this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!Config("DEBUG") && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (Config("DEBUG") && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_Department_Idn":
					break;
				case "x_AllowMultiple":
					break;
				case "x_DisplayAdjustmentFactors":
					break;
				case "x_DisplayWorksheetDetails":
					break;
				case "x_DisplayShopFabrication":
					break;
				case "x_DisplayWorksheetName":
					break;
				case "x_DisplayWorksheetHeader":
					break;
				case "x_UseRadioButtonsForSizes":
					break;
				case "x_DisplayFieldHoursOverride":
					break;
				case "x_DisplayShopHours":
					break;
				case "x_DisplayShopHoursOverride":
					break;
				case "x_DisplayUserShopHoursOnly":
					break;
				case "x_DisplayPipeExposure":
					break;
				case "x_DisplayVolumeCorrection":
					break;
				case "x_DisplayManhourAdjustment":
					break;
				case "x_IsSubcontractWorksheet":
					break;
				case "x_DisplayDeleteItemsButtons":
					break;
				case "x_ActiveFlag":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_Department_Idn":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
} // End class
?>