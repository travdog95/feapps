<?php
namespace PHPMaker2020\feapps51;

/**
 * Page class
 */
class Products_list extends Products
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}";

	// Table name
	public $TableName = 'Products';

	// Page object name
	public $PageObjName = "Products_list";

	// Grid form hidden field names
	public $FormName = "fProductslist";
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

		// Table object (Products)
		if (!isset($GLOBALS["Products"]) || get_class($GLOBALS["Products"]) == PROJECT_NAMESPACE . "Products") {
			$GLOBALS["Products"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Products"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "Productsadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "Productsdelete.php";
		$this->MultiUpdateUrl = "Productsupdate.php";

		// Table object (v_Administrators)
		if (!isset($GLOBALS['v_Administrators']))
			$GLOBALS['v_Administrators'] = new v_Administrators();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Products');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fProductslistsrch";

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
		global $Products;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($Products);
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
			$key .= @$ar['Product_Idn'];
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
			$this->Product_Idn->Visible = FALSE;
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
		$this->Product_Idn->setVisibility();
		$this->Department_Idn->setVisibility();
		$this->WorksheetMaster_Idn->setVisibility();
		$this->WorksheetCategory_Idn->setVisibility();
		$this->Manufacturer_Idn->setVisibility();
		$this->Rank->setVisibility();
		$this->Name->setVisibility();
		$this->MaterialUnitPrice->setVisibility();
		$this->FieldUnitPrice->setVisibility();
		$this->ShopUnitPrice->setVisibility();
		$this->EngineerUnitPrice->setVisibility();
		$this->DefaultQuantity->setVisibility();
		$this->ProductSize_Idn->setVisibility();
		$this->Description->setVisibility();
		$this->PipeType_Idn->setVisibility();
		$this->ScheduleType_Idn->setVisibility();
		$this->Fitting_Idn->setVisibility();
		$this->GroovedFittingType_Idn->setVisibility();
		$this->ThreadedFittingType_Idn->setVisibility();
		$this->HangerType_Idn->setVisibility();
		$this->HangerSubType_Idn->setVisibility();
		$this->SubcontractCategory_Idn->setVisibility();
		$this->ApplyToAdjustmentFactorsFlag->setVisibility();
		$this->ApplyToContingencyFlag->setVisibility();
		$this->IsMainComponent->setVisibility();
		$this->DomesticFlag->setVisibility();
		$this->LoadFlag->setVisibility();
		$this->AutoLoadFlag->setVisibility();
		$this->ActiveFlag->setVisibility();
		$this->GradeType_Idn->setVisibility();
		$this->PressureType_Idn->setVisibility();
		$this->SeamlessFlag->setVisibility();
		$this->ResponseType->setVisibility();
		$this->FMJobFlag->setVisibility();
		$this->RecommendedBoxes->setVisibility();
		$this->RecommendedWireFootage->setVisibility();
		$this->CoverageType_Idn->setVisibility();
		$this->HeadType_Idn->setVisibility();
		$this->FinishType_Idn->setVisibility();
		$this->Outlet_Idn->setVisibility();
		$this->RiserType_Idn->setVisibility();
		$this->BackFlowType_Idn->setVisibility();
		$this->ControlValve_Idn->setVisibility();
		$this->CheckValve_Idn->setVisibility();
		$this->FDCType_Idn->setVisibility();
		$this->BellType_Idn->setVisibility();
		$this->TappingTee_Idn->setVisibility();
		$this->UndergroundValve_Idn->setVisibility();
		$this->LiftDuration_Idn->setVisibility();
		$this->TrimPackageFlag->setVisibility();
		$this->ListedFlag->setVisibility();
		$this->BoxWireLength->setVisibility();
		$this->IsFirePump->setVisibility();
		$this->FirePumpType_Idn->setVisibility();
		$this->FirePumpAttribute_Idn->setVisibility();
		$this->IsDieselFuel->setVisibility();
		$this->IsSolution->setVisibility();
		$this->Position_Idn->setVisibility();
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
		$this->setupLookupOptions($this->WorksheetMaster_Idn);
		$this->setupLookupOptions($this->WorksheetCategory_Idn);
		$this->setupLookupOptions($this->Manufacturer_Idn);
		$this->setupLookupOptions($this->ProductSize_Idn);
		$this->setupLookupOptions($this->PipeType_Idn);
		$this->setupLookupOptions($this->ScheduleType_Idn);
		$this->setupLookupOptions($this->Fitting_Idn);
		$this->setupLookupOptions($this->GroovedFittingType_Idn);
		$this->setupLookupOptions($this->ThreadedFittingType_Idn);
		$this->setupLookupOptions($this->HangerType_Idn);
		$this->setupLookupOptions($this->HangerSubType_Idn);
		$this->setupLookupOptions($this->SubcontractCategory_Idn);
		$this->setupLookupOptions($this->GradeType_Idn);
		$this->setupLookupOptions($this->PressureType_Idn);
		$this->setupLookupOptions($this->CoverageType_Idn);
		$this->setupLookupOptions($this->HeadType_Idn);
		$this->setupLookupOptions($this->FinishType_Idn);
		$this->setupLookupOptions($this->Outlet_Idn);
		$this->setupLookupOptions($this->RiserType_Idn);
		$this->setupLookupOptions($this->BackFlowType_Idn);
		$this->setupLookupOptions($this->ControlValve_Idn);
		$this->setupLookupOptions($this->CheckValve_Idn);
		$this->setupLookupOptions($this->FDCType_Idn);
		$this->setupLookupOptions($this->BellType_Idn);
		$this->setupLookupOptions($this->TappingTee_Idn);
		$this->setupLookupOptions($this->UndergroundValve_Idn);
		$this->setupLookupOptions($this->LiftDuration_Idn);
		$this->setupLookupOptions($this->FirePumpType_Idn);
		$this->setupLookupOptions($this->Position_Idn);

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
		$this->setKey("Product_Idn", ""); // Clear inline edit key
		$this->MaterialUnitPrice->FormValue = ""; // Clear form value
		$this->FieldUnitPrice->FormValue = ""; // Clear form value
		$this->ShopUnitPrice->FormValue = ""; // Clear form value
		$this->EngineerUnitPrice->FormValue = ""; // Clear form value
		$this->DefaultQuantity->FormValue = ""; // Clear form value
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
		if (Get("Product_Idn") !== NULL) {
			$this->Product_Idn->setQueryStringValue(Get("Product_Idn"));
		} else {
			$inlineEdit = FALSE;
		}
		if ($inlineEdit) {
			if ($this->loadRow()) {
				$this->setKey("Product_Idn", $this->Product_Idn->CurrentValue); // Set up inline edit key
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
			$this->Product_Idn->OldValue = $this->Product_Idn->DbValue;
		$val = $this->Product_Idn->OldValue !== NULL ? $this->Product_Idn->OldValue : $this->Product_Idn->CurrentValue;
		if (strval($this->getKey("Product_Idn")) != strval($val))
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
			if (Get("Product_Idn") !== NULL) {
				$this->Product_Idn->setQueryStringValue(Get("Product_Idn"));
				$this->setKey("Product_Idn", $this->Product_Idn->CurrentValue); // Set up key
			} else {
				$this->setKey("Product_Idn", ""); // Clear key
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
			$this->Product_Idn->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->Product_Idn->OldValue))
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
					$key .= $this->Product_Idn->CurrentValue;

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
		if ($CurrentForm->hasValue("x_Department_Idn") && $CurrentForm->hasValue("o_Department_Idn") && $this->Department_Idn->CurrentValue != $this->Department_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_WorksheetMaster_Idn") && $CurrentForm->hasValue("o_WorksheetMaster_Idn") && $this->WorksheetMaster_Idn->CurrentValue != $this->WorksheetMaster_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_WorksheetCategory_Idn") && $CurrentForm->hasValue("o_WorksheetCategory_Idn") && $this->WorksheetCategory_Idn->CurrentValue != $this->WorksheetCategory_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Manufacturer_Idn") && $CurrentForm->hasValue("o_Manufacturer_Idn") && $this->Manufacturer_Idn->CurrentValue != $this->Manufacturer_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Rank") && $CurrentForm->hasValue("o_Rank") && $this->Rank->CurrentValue != $this->Rank->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Name") && $CurrentForm->hasValue("o_Name") && $this->Name->CurrentValue != $this->Name->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_MaterialUnitPrice") && $CurrentForm->hasValue("o_MaterialUnitPrice") && $this->MaterialUnitPrice->CurrentValue != $this->MaterialUnitPrice->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_FieldUnitPrice") && $CurrentForm->hasValue("o_FieldUnitPrice") && $this->FieldUnitPrice->CurrentValue != $this->FieldUnitPrice->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ShopUnitPrice") && $CurrentForm->hasValue("o_ShopUnitPrice") && $this->ShopUnitPrice->CurrentValue != $this->ShopUnitPrice->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_EngineerUnitPrice") && $CurrentForm->hasValue("o_EngineerUnitPrice") && $this->EngineerUnitPrice->CurrentValue != $this->EngineerUnitPrice->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DefaultQuantity") && $CurrentForm->hasValue("o_DefaultQuantity") && $this->DefaultQuantity->CurrentValue != $this->DefaultQuantity->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProductSize_Idn") && $CurrentForm->hasValue("o_ProductSize_Idn") && $this->ProductSize_Idn->CurrentValue != $this->ProductSize_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Description") && $CurrentForm->hasValue("o_Description") && $this->Description->CurrentValue != $this->Description->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PipeType_Idn") && $CurrentForm->hasValue("o_PipeType_Idn") && $this->PipeType_Idn->CurrentValue != $this->PipeType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ScheduleType_Idn") && $CurrentForm->hasValue("o_ScheduleType_Idn") && $this->ScheduleType_Idn->CurrentValue != $this->ScheduleType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Fitting_Idn") && $CurrentForm->hasValue("o_Fitting_Idn") && $this->Fitting_Idn->CurrentValue != $this->Fitting_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_GroovedFittingType_Idn") && $CurrentForm->hasValue("o_GroovedFittingType_Idn") && $this->GroovedFittingType_Idn->CurrentValue != $this->GroovedFittingType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ThreadedFittingType_Idn") && $CurrentForm->hasValue("o_ThreadedFittingType_Idn") && $this->ThreadedFittingType_Idn->CurrentValue != $this->ThreadedFittingType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_HangerType_Idn") && $CurrentForm->hasValue("o_HangerType_Idn") && $this->HangerType_Idn->CurrentValue != $this->HangerType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_HangerSubType_Idn") && $CurrentForm->hasValue("o_HangerSubType_Idn") && $this->HangerSubType_Idn->CurrentValue != $this->HangerSubType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SubcontractCategory_Idn") && $CurrentForm->hasValue("o_SubcontractCategory_Idn") && $this->SubcontractCategory_Idn->CurrentValue != $this->SubcontractCategory_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ApplyToAdjustmentFactorsFlag") && $CurrentForm->hasValue("o_ApplyToAdjustmentFactorsFlag") && ConvertToBool($this->ApplyToAdjustmentFactorsFlag->CurrentValue) != ConvertToBool($this->ApplyToAdjustmentFactorsFlag->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_ApplyToContingencyFlag") && $CurrentForm->hasValue("o_ApplyToContingencyFlag") && ConvertToBool($this->ApplyToContingencyFlag->CurrentValue) != ConvertToBool($this->ApplyToContingencyFlag->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_IsMainComponent") && $CurrentForm->hasValue("o_IsMainComponent") && ConvertToBool($this->IsMainComponent->CurrentValue) != ConvertToBool($this->IsMainComponent->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_DomesticFlag") && $CurrentForm->hasValue("o_DomesticFlag") && ConvertToBool($this->DomesticFlag->CurrentValue) != ConvertToBool($this->DomesticFlag->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_LoadFlag") && $CurrentForm->hasValue("o_LoadFlag") && ConvertToBool($this->LoadFlag->CurrentValue) != ConvertToBool($this->LoadFlag->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_AutoLoadFlag") && $CurrentForm->hasValue("o_AutoLoadFlag") && ConvertToBool($this->AutoLoadFlag->CurrentValue) != ConvertToBool($this->AutoLoadFlag->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_ActiveFlag") && $CurrentForm->hasValue("o_ActiveFlag") && ConvertToBool($this->ActiveFlag->CurrentValue) != ConvertToBool($this->ActiveFlag->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_GradeType_Idn") && $CurrentForm->hasValue("o_GradeType_Idn") && $this->GradeType_Idn->CurrentValue != $this->GradeType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PressureType_Idn") && $CurrentForm->hasValue("o_PressureType_Idn") && $this->PressureType_Idn->CurrentValue != $this->PressureType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SeamlessFlag") && $CurrentForm->hasValue("o_SeamlessFlag") && ConvertToBool($this->SeamlessFlag->CurrentValue) != ConvertToBool($this->SeamlessFlag->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_ResponseType") && $CurrentForm->hasValue("o_ResponseType") && $this->ResponseType->CurrentValue != $this->ResponseType->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_FMJobFlag") && $CurrentForm->hasValue("o_FMJobFlag") && ConvertToBool($this->FMJobFlag->CurrentValue) != ConvertToBool($this->FMJobFlag->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_RecommendedBoxes") && $CurrentForm->hasValue("o_RecommendedBoxes") && $this->RecommendedBoxes->CurrentValue != $this->RecommendedBoxes->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_RecommendedWireFootage") && $CurrentForm->hasValue("o_RecommendedWireFootage") && $this->RecommendedWireFootage->CurrentValue != $this->RecommendedWireFootage->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CoverageType_Idn") && $CurrentForm->hasValue("o_CoverageType_Idn") && $this->CoverageType_Idn->CurrentValue != $this->CoverageType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_HeadType_Idn") && $CurrentForm->hasValue("o_HeadType_Idn") && $this->HeadType_Idn->CurrentValue != $this->HeadType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_FinishType_Idn") && $CurrentForm->hasValue("o_FinishType_Idn") && $this->FinishType_Idn->CurrentValue != $this->FinishType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Outlet_Idn") && $CurrentForm->hasValue("o_Outlet_Idn") && $this->Outlet_Idn->CurrentValue != $this->Outlet_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_RiserType_Idn") && $CurrentForm->hasValue("o_RiserType_Idn") && $this->RiserType_Idn->CurrentValue != $this->RiserType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BackFlowType_Idn") && $CurrentForm->hasValue("o_BackFlowType_Idn") && $this->BackFlowType_Idn->CurrentValue != $this->BackFlowType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ControlValve_Idn") && $CurrentForm->hasValue("o_ControlValve_Idn") && $this->ControlValve_Idn->CurrentValue != $this->ControlValve_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CheckValve_Idn") && $CurrentForm->hasValue("o_CheckValve_Idn") && $this->CheckValve_Idn->CurrentValue != $this->CheckValve_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_FDCType_Idn") && $CurrentForm->hasValue("o_FDCType_Idn") && $this->FDCType_Idn->CurrentValue != $this->FDCType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BellType_Idn") && $CurrentForm->hasValue("o_BellType_Idn") && $this->BellType_Idn->CurrentValue != $this->BellType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_TappingTee_Idn") && $CurrentForm->hasValue("o_TappingTee_Idn") && $this->TappingTee_Idn->CurrentValue != $this->TappingTee_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_UndergroundValve_Idn") && $CurrentForm->hasValue("o_UndergroundValve_Idn") && $this->UndergroundValve_Idn->CurrentValue != $this->UndergroundValve_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_LiftDuration_Idn") && $CurrentForm->hasValue("o_LiftDuration_Idn") && $this->LiftDuration_Idn->CurrentValue != $this->LiftDuration_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_TrimPackageFlag") && $CurrentForm->hasValue("o_TrimPackageFlag") && ConvertToBool($this->TrimPackageFlag->CurrentValue) != ConvertToBool($this->TrimPackageFlag->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_ListedFlag") && $CurrentForm->hasValue("o_ListedFlag") && ConvertToBool($this->ListedFlag->CurrentValue) != ConvertToBool($this->ListedFlag->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_BoxWireLength") && $CurrentForm->hasValue("o_BoxWireLength") && $this->BoxWireLength->CurrentValue != $this->BoxWireLength->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_IsFirePump") && $CurrentForm->hasValue("o_IsFirePump") && ConvertToBool($this->IsFirePump->CurrentValue) != ConvertToBool($this->IsFirePump->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_FirePumpType_Idn") && $CurrentForm->hasValue("o_FirePumpType_Idn") && $this->FirePumpType_Idn->CurrentValue != $this->FirePumpType_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_FirePumpAttribute_Idn") && $CurrentForm->hasValue("o_FirePumpAttribute_Idn") && $this->FirePumpAttribute_Idn->CurrentValue != $this->FirePumpAttribute_Idn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_IsDieselFuel") && $CurrentForm->hasValue("o_IsDieselFuel") && ConvertToBool($this->IsDieselFuel->CurrentValue) != ConvertToBool($this->IsDieselFuel->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_IsSolution") && $CurrentForm->hasValue("o_IsSolution") && ConvertToBool($this->IsSolution->CurrentValue) != ConvertToBool($this->IsSolution->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_Position_Idn") && $CurrentForm->hasValue("o_Position_Idn") && $this->Position_Idn->CurrentValue != $this->Position_Idn->OldValue)
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
		$filterList = Concat($filterList, $this->Product_Idn->AdvancedSearch->toJson(), ","); // Field Product_Idn
		$filterList = Concat($filterList, $this->Department_Idn->AdvancedSearch->toJson(), ","); // Field Department_Idn
		$filterList = Concat($filterList, $this->WorksheetMaster_Idn->AdvancedSearch->toJson(), ","); // Field WorksheetMaster_Idn
		$filterList = Concat($filterList, $this->WorksheetCategory_Idn->AdvancedSearch->toJson(), ","); // Field WorksheetCategory_Idn
		$filterList = Concat($filterList, $this->Manufacturer_Idn->AdvancedSearch->toJson(), ","); // Field Manufacturer_Idn
		$filterList = Concat($filterList, $this->Rank->AdvancedSearch->toJson(), ","); // Field Rank
		$filterList = Concat($filterList, $this->Name->AdvancedSearch->toJson(), ","); // Field Name
		$filterList = Concat($filterList, $this->MaterialUnitPrice->AdvancedSearch->toJson(), ","); // Field MaterialUnitPrice
		$filterList = Concat($filterList, $this->FieldUnitPrice->AdvancedSearch->toJson(), ","); // Field FieldUnitPrice
		$filterList = Concat($filterList, $this->ShopUnitPrice->AdvancedSearch->toJson(), ","); // Field ShopUnitPrice
		$filterList = Concat($filterList, $this->EngineerUnitPrice->AdvancedSearch->toJson(), ","); // Field EngineerUnitPrice
		$filterList = Concat($filterList, $this->DefaultQuantity->AdvancedSearch->toJson(), ","); // Field DefaultQuantity
		$filterList = Concat($filterList, $this->ProductSize_Idn->AdvancedSearch->toJson(), ","); // Field ProductSize_Idn
		$filterList = Concat($filterList, $this->Description->AdvancedSearch->toJson(), ","); // Field Description
		$filterList = Concat($filterList, $this->PipeType_Idn->AdvancedSearch->toJson(), ","); // Field PipeType_Idn
		$filterList = Concat($filterList, $this->ScheduleType_Idn->AdvancedSearch->toJson(), ","); // Field ScheduleType_Idn
		$filterList = Concat($filterList, $this->Fitting_Idn->AdvancedSearch->toJson(), ","); // Field Fitting_Idn
		$filterList = Concat($filterList, $this->GroovedFittingType_Idn->AdvancedSearch->toJson(), ","); // Field GroovedFittingType_Idn
		$filterList = Concat($filterList, $this->ThreadedFittingType_Idn->AdvancedSearch->toJson(), ","); // Field ThreadedFittingType_Idn
		$filterList = Concat($filterList, $this->HangerType_Idn->AdvancedSearch->toJson(), ","); // Field HangerType_Idn
		$filterList = Concat($filterList, $this->HangerSubType_Idn->AdvancedSearch->toJson(), ","); // Field HangerSubType_Idn
		$filterList = Concat($filterList, $this->SubcontractCategory_Idn->AdvancedSearch->toJson(), ","); // Field SubcontractCategory_Idn
		$filterList = Concat($filterList, $this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->toJson(), ","); // Field ApplyToAdjustmentFactorsFlag
		$filterList = Concat($filterList, $this->ApplyToContingencyFlag->AdvancedSearch->toJson(), ","); // Field ApplyToContingencyFlag
		$filterList = Concat($filterList, $this->IsMainComponent->AdvancedSearch->toJson(), ","); // Field IsMainComponent
		$filterList = Concat($filterList, $this->DomesticFlag->AdvancedSearch->toJson(), ","); // Field DomesticFlag
		$filterList = Concat($filterList, $this->LoadFlag->AdvancedSearch->toJson(), ","); // Field LoadFlag
		$filterList = Concat($filterList, $this->AutoLoadFlag->AdvancedSearch->toJson(), ","); // Field AutoLoadFlag
		$filterList = Concat($filterList, $this->ActiveFlag->AdvancedSearch->toJson(), ","); // Field ActiveFlag
		$filterList = Concat($filterList, $this->GradeType_Idn->AdvancedSearch->toJson(), ","); // Field GradeType_Idn
		$filterList = Concat($filterList, $this->PressureType_Idn->AdvancedSearch->toJson(), ","); // Field PressureType_Idn
		$filterList = Concat($filterList, $this->SeamlessFlag->AdvancedSearch->toJson(), ","); // Field SeamlessFlag
		$filterList = Concat($filterList, $this->ResponseType->AdvancedSearch->toJson(), ","); // Field ResponseType
		$filterList = Concat($filterList, $this->FMJobFlag->AdvancedSearch->toJson(), ","); // Field FMJobFlag
		$filterList = Concat($filterList, $this->RecommendedBoxes->AdvancedSearch->toJson(), ","); // Field RecommendedBoxes
		$filterList = Concat($filterList, $this->RecommendedWireFootage->AdvancedSearch->toJson(), ","); // Field RecommendedWireFootage
		$filterList = Concat($filterList, $this->CoverageType_Idn->AdvancedSearch->toJson(), ","); // Field CoverageType_Idn
		$filterList = Concat($filterList, $this->HeadType_Idn->AdvancedSearch->toJson(), ","); // Field HeadType_Idn
		$filterList = Concat($filterList, $this->FinishType_Idn->AdvancedSearch->toJson(), ","); // Field FinishType_Idn
		$filterList = Concat($filterList, $this->Outlet_Idn->AdvancedSearch->toJson(), ","); // Field Outlet_Idn
		$filterList = Concat($filterList, $this->RiserType_Idn->AdvancedSearch->toJson(), ","); // Field RiserType_Idn
		$filterList = Concat($filterList, $this->BackFlowType_Idn->AdvancedSearch->toJson(), ","); // Field BackFlowType_Idn
		$filterList = Concat($filterList, $this->ControlValve_Idn->AdvancedSearch->toJson(), ","); // Field ControlValve_Idn
		$filterList = Concat($filterList, $this->CheckValve_Idn->AdvancedSearch->toJson(), ","); // Field CheckValve_Idn
		$filterList = Concat($filterList, $this->FDCType_Idn->AdvancedSearch->toJson(), ","); // Field FDCType_Idn
		$filterList = Concat($filterList, $this->BellType_Idn->AdvancedSearch->toJson(), ","); // Field BellType_Idn
		$filterList = Concat($filterList, $this->TappingTee_Idn->AdvancedSearch->toJson(), ","); // Field TappingTee_Idn
		$filterList = Concat($filterList, $this->UndergroundValve_Idn->AdvancedSearch->toJson(), ","); // Field UndergroundValve_Idn
		$filterList = Concat($filterList, $this->LiftDuration_Idn->AdvancedSearch->toJson(), ","); // Field LiftDuration_Idn
		$filterList = Concat($filterList, $this->TrimPackageFlag->AdvancedSearch->toJson(), ","); // Field TrimPackageFlag
		$filterList = Concat($filterList, $this->ListedFlag->AdvancedSearch->toJson(), ","); // Field ListedFlag
		$filterList = Concat($filterList, $this->BoxWireLength->AdvancedSearch->toJson(), ","); // Field BoxWireLength
		$filterList = Concat($filterList, $this->IsFirePump->AdvancedSearch->toJson(), ","); // Field IsFirePump
		$filterList = Concat($filterList, $this->FirePumpType_Idn->AdvancedSearch->toJson(), ","); // Field FirePumpType_Idn
		$filterList = Concat($filterList, $this->FirePumpAttribute_Idn->AdvancedSearch->toJson(), ","); // Field FirePumpAttribute_Idn
		$filterList = Concat($filterList, $this->IsDieselFuel->AdvancedSearch->toJson(), ","); // Field IsDieselFuel
		$filterList = Concat($filterList, $this->IsSolution->AdvancedSearch->toJson(), ","); // Field IsSolution
		$filterList = Concat($filterList, $this->Position_Idn->AdvancedSearch->toJson(), ","); // Field Position_Idn
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fProductslistsrch", $filters);
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

		// Field Product_Idn
		$this->Product_Idn->AdvancedSearch->SearchValue = @$filter["x_Product_Idn"];
		$this->Product_Idn->AdvancedSearch->SearchOperator = @$filter["z_Product_Idn"];
		$this->Product_Idn->AdvancedSearch->SearchCondition = @$filter["v_Product_Idn"];
		$this->Product_Idn->AdvancedSearch->SearchValue2 = @$filter["y_Product_Idn"];
		$this->Product_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_Product_Idn"];
		$this->Product_Idn->AdvancedSearch->save();

		// Field Department_Idn
		$this->Department_Idn->AdvancedSearch->SearchValue = @$filter["x_Department_Idn"];
		$this->Department_Idn->AdvancedSearch->SearchOperator = @$filter["z_Department_Idn"];
		$this->Department_Idn->AdvancedSearch->SearchCondition = @$filter["v_Department_Idn"];
		$this->Department_Idn->AdvancedSearch->SearchValue2 = @$filter["y_Department_Idn"];
		$this->Department_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_Department_Idn"];
		$this->Department_Idn->AdvancedSearch->save();

		// Field WorksheetMaster_Idn
		$this->WorksheetMaster_Idn->AdvancedSearch->SearchValue = @$filter["x_WorksheetMaster_Idn"];
		$this->WorksheetMaster_Idn->AdvancedSearch->SearchOperator = @$filter["z_WorksheetMaster_Idn"];
		$this->WorksheetMaster_Idn->AdvancedSearch->SearchCondition = @$filter["v_WorksheetMaster_Idn"];
		$this->WorksheetMaster_Idn->AdvancedSearch->SearchValue2 = @$filter["y_WorksheetMaster_Idn"];
		$this->WorksheetMaster_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_WorksheetMaster_Idn"];
		$this->WorksheetMaster_Idn->AdvancedSearch->save();

		// Field WorksheetCategory_Idn
		$this->WorksheetCategory_Idn->AdvancedSearch->SearchValue = @$filter["x_WorksheetCategory_Idn"];
		$this->WorksheetCategory_Idn->AdvancedSearch->SearchOperator = @$filter["z_WorksheetCategory_Idn"];
		$this->WorksheetCategory_Idn->AdvancedSearch->SearchCondition = @$filter["v_WorksheetCategory_Idn"];
		$this->WorksheetCategory_Idn->AdvancedSearch->SearchValue2 = @$filter["y_WorksheetCategory_Idn"];
		$this->WorksheetCategory_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_WorksheetCategory_Idn"];
		$this->WorksheetCategory_Idn->AdvancedSearch->save();

		// Field Manufacturer_Idn
		$this->Manufacturer_Idn->AdvancedSearch->SearchValue = @$filter["x_Manufacturer_Idn"];
		$this->Manufacturer_Idn->AdvancedSearch->SearchOperator = @$filter["z_Manufacturer_Idn"];
		$this->Manufacturer_Idn->AdvancedSearch->SearchCondition = @$filter["v_Manufacturer_Idn"];
		$this->Manufacturer_Idn->AdvancedSearch->SearchValue2 = @$filter["y_Manufacturer_Idn"];
		$this->Manufacturer_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_Manufacturer_Idn"];
		$this->Manufacturer_Idn->AdvancedSearch->save();

		// Field Rank
		$this->Rank->AdvancedSearch->SearchValue = @$filter["x_Rank"];
		$this->Rank->AdvancedSearch->SearchOperator = @$filter["z_Rank"];
		$this->Rank->AdvancedSearch->SearchCondition = @$filter["v_Rank"];
		$this->Rank->AdvancedSearch->SearchValue2 = @$filter["y_Rank"];
		$this->Rank->AdvancedSearch->SearchOperator2 = @$filter["w_Rank"];
		$this->Rank->AdvancedSearch->save();

		// Field Name
		$this->Name->AdvancedSearch->SearchValue = @$filter["x_Name"];
		$this->Name->AdvancedSearch->SearchOperator = @$filter["z_Name"];
		$this->Name->AdvancedSearch->SearchCondition = @$filter["v_Name"];
		$this->Name->AdvancedSearch->SearchValue2 = @$filter["y_Name"];
		$this->Name->AdvancedSearch->SearchOperator2 = @$filter["w_Name"];
		$this->Name->AdvancedSearch->save();

		// Field MaterialUnitPrice
		$this->MaterialUnitPrice->AdvancedSearch->SearchValue = @$filter["x_MaterialUnitPrice"];
		$this->MaterialUnitPrice->AdvancedSearch->SearchOperator = @$filter["z_MaterialUnitPrice"];
		$this->MaterialUnitPrice->AdvancedSearch->SearchCondition = @$filter["v_MaterialUnitPrice"];
		$this->MaterialUnitPrice->AdvancedSearch->SearchValue2 = @$filter["y_MaterialUnitPrice"];
		$this->MaterialUnitPrice->AdvancedSearch->SearchOperator2 = @$filter["w_MaterialUnitPrice"];
		$this->MaterialUnitPrice->AdvancedSearch->save();

		// Field FieldUnitPrice
		$this->FieldUnitPrice->AdvancedSearch->SearchValue = @$filter["x_FieldUnitPrice"];
		$this->FieldUnitPrice->AdvancedSearch->SearchOperator = @$filter["z_FieldUnitPrice"];
		$this->FieldUnitPrice->AdvancedSearch->SearchCondition = @$filter["v_FieldUnitPrice"];
		$this->FieldUnitPrice->AdvancedSearch->SearchValue2 = @$filter["y_FieldUnitPrice"];
		$this->FieldUnitPrice->AdvancedSearch->SearchOperator2 = @$filter["w_FieldUnitPrice"];
		$this->FieldUnitPrice->AdvancedSearch->save();

		// Field ShopUnitPrice
		$this->ShopUnitPrice->AdvancedSearch->SearchValue = @$filter["x_ShopUnitPrice"];
		$this->ShopUnitPrice->AdvancedSearch->SearchOperator = @$filter["z_ShopUnitPrice"];
		$this->ShopUnitPrice->AdvancedSearch->SearchCondition = @$filter["v_ShopUnitPrice"];
		$this->ShopUnitPrice->AdvancedSearch->SearchValue2 = @$filter["y_ShopUnitPrice"];
		$this->ShopUnitPrice->AdvancedSearch->SearchOperator2 = @$filter["w_ShopUnitPrice"];
		$this->ShopUnitPrice->AdvancedSearch->save();

		// Field EngineerUnitPrice
		$this->EngineerUnitPrice->AdvancedSearch->SearchValue = @$filter["x_EngineerUnitPrice"];
		$this->EngineerUnitPrice->AdvancedSearch->SearchOperator = @$filter["z_EngineerUnitPrice"];
		$this->EngineerUnitPrice->AdvancedSearch->SearchCondition = @$filter["v_EngineerUnitPrice"];
		$this->EngineerUnitPrice->AdvancedSearch->SearchValue2 = @$filter["y_EngineerUnitPrice"];
		$this->EngineerUnitPrice->AdvancedSearch->SearchOperator2 = @$filter["w_EngineerUnitPrice"];
		$this->EngineerUnitPrice->AdvancedSearch->save();

		// Field DefaultQuantity
		$this->DefaultQuantity->AdvancedSearch->SearchValue = @$filter["x_DefaultQuantity"];
		$this->DefaultQuantity->AdvancedSearch->SearchOperator = @$filter["z_DefaultQuantity"];
		$this->DefaultQuantity->AdvancedSearch->SearchCondition = @$filter["v_DefaultQuantity"];
		$this->DefaultQuantity->AdvancedSearch->SearchValue2 = @$filter["y_DefaultQuantity"];
		$this->DefaultQuantity->AdvancedSearch->SearchOperator2 = @$filter["w_DefaultQuantity"];
		$this->DefaultQuantity->AdvancedSearch->save();

		// Field ProductSize_Idn
		$this->ProductSize_Idn->AdvancedSearch->SearchValue = @$filter["x_ProductSize_Idn"];
		$this->ProductSize_Idn->AdvancedSearch->SearchOperator = @$filter["z_ProductSize_Idn"];
		$this->ProductSize_Idn->AdvancedSearch->SearchCondition = @$filter["v_ProductSize_Idn"];
		$this->ProductSize_Idn->AdvancedSearch->SearchValue2 = @$filter["y_ProductSize_Idn"];
		$this->ProductSize_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_ProductSize_Idn"];
		$this->ProductSize_Idn->AdvancedSearch->save();

		// Field Description
		$this->Description->AdvancedSearch->SearchValue = @$filter["x_Description"];
		$this->Description->AdvancedSearch->SearchOperator = @$filter["z_Description"];
		$this->Description->AdvancedSearch->SearchCondition = @$filter["v_Description"];
		$this->Description->AdvancedSearch->SearchValue2 = @$filter["y_Description"];
		$this->Description->AdvancedSearch->SearchOperator2 = @$filter["w_Description"];
		$this->Description->AdvancedSearch->save();

		// Field PipeType_Idn
		$this->PipeType_Idn->AdvancedSearch->SearchValue = @$filter["x_PipeType_Idn"];
		$this->PipeType_Idn->AdvancedSearch->SearchOperator = @$filter["z_PipeType_Idn"];
		$this->PipeType_Idn->AdvancedSearch->SearchCondition = @$filter["v_PipeType_Idn"];
		$this->PipeType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_PipeType_Idn"];
		$this->PipeType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_PipeType_Idn"];
		$this->PipeType_Idn->AdvancedSearch->save();

		// Field ScheduleType_Idn
		$this->ScheduleType_Idn->AdvancedSearch->SearchValue = @$filter["x_ScheduleType_Idn"];
		$this->ScheduleType_Idn->AdvancedSearch->SearchOperator = @$filter["z_ScheduleType_Idn"];
		$this->ScheduleType_Idn->AdvancedSearch->SearchCondition = @$filter["v_ScheduleType_Idn"];
		$this->ScheduleType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_ScheduleType_Idn"];
		$this->ScheduleType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_ScheduleType_Idn"];
		$this->ScheduleType_Idn->AdvancedSearch->save();

		// Field Fitting_Idn
		$this->Fitting_Idn->AdvancedSearch->SearchValue = @$filter["x_Fitting_Idn"];
		$this->Fitting_Idn->AdvancedSearch->SearchOperator = @$filter["z_Fitting_Idn"];
		$this->Fitting_Idn->AdvancedSearch->SearchCondition = @$filter["v_Fitting_Idn"];
		$this->Fitting_Idn->AdvancedSearch->SearchValue2 = @$filter["y_Fitting_Idn"];
		$this->Fitting_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_Fitting_Idn"];
		$this->Fitting_Idn->AdvancedSearch->save();

		// Field GroovedFittingType_Idn
		$this->GroovedFittingType_Idn->AdvancedSearch->SearchValue = @$filter["x_GroovedFittingType_Idn"];
		$this->GroovedFittingType_Idn->AdvancedSearch->SearchOperator = @$filter["z_GroovedFittingType_Idn"];
		$this->GroovedFittingType_Idn->AdvancedSearch->SearchCondition = @$filter["v_GroovedFittingType_Idn"];
		$this->GroovedFittingType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_GroovedFittingType_Idn"];
		$this->GroovedFittingType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_GroovedFittingType_Idn"];
		$this->GroovedFittingType_Idn->AdvancedSearch->save();

		// Field ThreadedFittingType_Idn
		$this->ThreadedFittingType_Idn->AdvancedSearch->SearchValue = @$filter["x_ThreadedFittingType_Idn"];
		$this->ThreadedFittingType_Idn->AdvancedSearch->SearchOperator = @$filter["z_ThreadedFittingType_Idn"];
		$this->ThreadedFittingType_Idn->AdvancedSearch->SearchCondition = @$filter["v_ThreadedFittingType_Idn"];
		$this->ThreadedFittingType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_ThreadedFittingType_Idn"];
		$this->ThreadedFittingType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_ThreadedFittingType_Idn"];
		$this->ThreadedFittingType_Idn->AdvancedSearch->save();

		// Field HangerType_Idn
		$this->HangerType_Idn->AdvancedSearch->SearchValue = @$filter["x_HangerType_Idn"];
		$this->HangerType_Idn->AdvancedSearch->SearchOperator = @$filter["z_HangerType_Idn"];
		$this->HangerType_Idn->AdvancedSearch->SearchCondition = @$filter["v_HangerType_Idn"];
		$this->HangerType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_HangerType_Idn"];
		$this->HangerType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_HangerType_Idn"];
		$this->HangerType_Idn->AdvancedSearch->save();

		// Field HangerSubType_Idn
		$this->HangerSubType_Idn->AdvancedSearch->SearchValue = @$filter["x_HangerSubType_Idn"];
		$this->HangerSubType_Idn->AdvancedSearch->SearchOperator = @$filter["z_HangerSubType_Idn"];
		$this->HangerSubType_Idn->AdvancedSearch->SearchCondition = @$filter["v_HangerSubType_Idn"];
		$this->HangerSubType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_HangerSubType_Idn"];
		$this->HangerSubType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_HangerSubType_Idn"];
		$this->HangerSubType_Idn->AdvancedSearch->save();

		// Field SubcontractCategory_Idn
		$this->SubcontractCategory_Idn->AdvancedSearch->SearchValue = @$filter["x_SubcontractCategory_Idn"];
		$this->SubcontractCategory_Idn->AdvancedSearch->SearchOperator = @$filter["z_SubcontractCategory_Idn"];
		$this->SubcontractCategory_Idn->AdvancedSearch->SearchCondition = @$filter["v_SubcontractCategory_Idn"];
		$this->SubcontractCategory_Idn->AdvancedSearch->SearchValue2 = @$filter["y_SubcontractCategory_Idn"];
		$this->SubcontractCategory_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_SubcontractCategory_Idn"];
		$this->SubcontractCategory_Idn->AdvancedSearch->save();

		// Field ApplyToAdjustmentFactorsFlag
		$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchValue = @$filter["x_ApplyToAdjustmentFactorsFlag"];
		$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchOperator = @$filter["z_ApplyToAdjustmentFactorsFlag"];
		$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchCondition = @$filter["v_ApplyToAdjustmentFactorsFlag"];
		$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchValue2 = @$filter["y_ApplyToAdjustmentFactorsFlag"];
		$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchOperator2 = @$filter["w_ApplyToAdjustmentFactorsFlag"];
		$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->save();

		// Field ApplyToContingencyFlag
		$this->ApplyToContingencyFlag->AdvancedSearch->SearchValue = @$filter["x_ApplyToContingencyFlag"];
		$this->ApplyToContingencyFlag->AdvancedSearch->SearchOperator = @$filter["z_ApplyToContingencyFlag"];
		$this->ApplyToContingencyFlag->AdvancedSearch->SearchCondition = @$filter["v_ApplyToContingencyFlag"];
		$this->ApplyToContingencyFlag->AdvancedSearch->SearchValue2 = @$filter["y_ApplyToContingencyFlag"];
		$this->ApplyToContingencyFlag->AdvancedSearch->SearchOperator2 = @$filter["w_ApplyToContingencyFlag"];
		$this->ApplyToContingencyFlag->AdvancedSearch->save();

		// Field IsMainComponent
		$this->IsMainComponent->AdvancedSearch->SearchValue = @$filter["x_IsMainComponent"];
		$this->IsMainComponent->AdvancedSearch->SearchOperator = @$filter["z_IsMainComponent"];
		$this->IsMainComponent->AdvancedSearch->SearchCondition = @$filter["v_IsMainComponent"];
		$this->IsMainComponent->AdvancedSearch->SearchValue2 = @$filter["y_IsMainComponent"];
		$this->IsMainComponent->AdvancedSearch->SearchOperator2 = @$filter["w_IsMainComponent"];
		$this->IsMainComponent->AdvancedSearch->save();

		// Field DomesticFlag
		$this->DomesticFlag->AdvancedSearch->SearchValue = @$filter["x_DomesticFlag"];
		$this->DomesticFlag->AdvancedSearch->SearchOperator = @$filter["z_DomesticFlag"];
		$this->DomesticFlag->AdvancedSearch->SearchCondition = @$filter["v_DomesticFlag"];
		$this->DomesticFlag->AdvancedSearch->SearchValue2 = @$filter["y_DomesticFlag"];
		$this->DomesticFlag->AdvancedSearch->SearchOperator2 = @$filter["w_DomesticFlag"];
		$this->DomesticFlag->AdvancedSearch->save();

		// Field LoadFlag
		$this->LoadFlag->AdvancedSearch->SearchValue = @$filter["x_LoadFlag"];
		$this->LoadFlag->AdvancedSearch->SearchOperator = @$filter["z_LoadFlag"];
		$this->LoadFlag->AdvancedSearch->SearchCondition = @$filter["v_LoadFlag"];
		$this->LoadFlag->AdvancedSearch->SearchValue2 = @$filter["y_LoadFlag"];
		$this->LoadFlag->AdvancedSearch->SearchOperator2 = @$filter["w_LoadFlag"];
		$this->LoadFlag->AdvancedSearch->save();

		// Field AutoLoadFlag
		$this->AutoLoadFlag->AdvancedSearch->SearchValue = @$filter["x_AutoLoadFlag"];
		$this->AutoLoadFlag->AdvancedSearch->SearchOperator = @$filter["z_AutoLoadFlag"];
		$this->AutoLoadFlag->AdvancedSearch->SearchCondition = @$filter["v_AutoLoadFlag"];
		$this->AutoLoadFlag->AdvancedSearch->SearchValue2 = @$filter["y_AutoLoadFlag"];
		$this->AutoLoadFlag->AdvancedSearch->SearchOperator2 = @$filter["w_AutoLoadFlag"];
		$this->AutoLoadFlag->AdvancedSearch->save();

		// Field ActiveFlag
		$this->ActiveFlag->AdvancedSearch->SearchValue = @$filter["x_ActiveFlag"];
		$this->ActiveFlag->AdvancedSearch->SearchOperator = @$filter["z_ActiveFlag"];
		$this->ActiveFlag->AdvancedSearch->SearchCondition = @$filter["v_ActiveFlag"];
		$this->ActiveFlag->AdvancedSearch->SearchValue2 = @$filter["y_ActiveFlag"];
		$this->ActiveFlag->AdvancedSearch->SearchOperator2 = @$filter["w_ActiveFlag"];
		$this->ActiveFlag->AdvancedSearch->save();

		// Field GradeType_Idn
		$this->GradeType_Idn->AdvancedSearch->SearchValue = @$filter["x_GradeType_Idn"];
		$this->GradeType_Idn->AdvancedSearch->SearchOperator = @$filter["z_GradeType_Idn"];
		$this->GradeType_Idn->AdvancedSearch->SearchCondition = @$filter["v_GradeType_Idn"];
		$this->GradeType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_GradeType_Idn"];
		$this->GradeType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_GradeType_Idn"];
		$this->GradeType_Idn->AdvancedSearch->save();

		// Field PressureType_Idn
		$this->PressureType_Idn->AdvancedSearch->SearchValue = @$filter["x_PressureType_Idn"];
		$this->PressureType_Idn->AdvancedSearch->SearchOperator = @$filter["z_PressureType_Idn"];
		$this->PressureType_Idn->AdvancedSearch->SearchCondition = @$filter["v_PressureType_Idn"];
		$this->PressureType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_PressureType_Idn"];
		$this->PressureType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_PressureType_Idn"];
		$this->PressureType_Idn->AdvancedSearch->save();

		// Field SeamlessFlag
		$this->SeamlessFlag->AdvancedSearch->SearchValue = @$filter["x_SeamlessFlag"];
		$this->SeamlessFlag->AdvancedSearch->SearchOperator = @$filter["z_SeamlessFlag"];
		$this->SeamlessFlag->AdvancedSearch->SearchCondition = @$filter["v_SeamlessFlag"];
		$this->SeamlessFlag->AdvancedSearch->SearchValue2 = @$filter["y_SeamlessFlag"];
		$this->SeamlessFlag->AdvancedSearch->SearchOperator2 = @$filter["w_SeamlessFlag"];
		$this->SeamlessFlag->AdvancedSearch->save();

		// Field ResponseType
		$this->ResponseType->AdvancedSearch->SearchValue = @$filter["x_ResponseType"];
		$this->ResponseType->AdvancedSearch->SearchOperator = @$filter["z_ResponseType"];
		$this->ResponseType->AdvancedSearch->SearchCondition = @$filter["v_ResponseType"];
		$this->ResponseType->AdvancedSearch->SearchValue2 = @$filter["y_ResponseType"];
		$this->ResponseType->AdvancedSearch->SearchOperator2 = @$filter["w_ResponseType"];
		$this->ResponseType->AdvancedSearch->save();

		// Field FMJobFlag
		$this->FMJobFlag->AdvancedSearch->SearchValue = @$filter["x_FMJobFlag"];
		$this->FMJobFlag->AdvancedSearch->SearchOperator = @$filter["z_FMJobFlag"];
		$this->FMJobFlag->AdvancedSearch->SearchCondition = @$filter["v_FMJobFlag"];
		$this->FMJobFlag->AdvancedSearch->SearchValue2 = @$filter["y_FMJobFlag"];
		$this->FMJobFlag->AdvancedSearch->SearchOperator2 = @$filter["w_FMJobFlag"];
		$this->FMJobFlag->AdvancedSearch->save();

		// Field RecommendedBoxes
		$this->RecommendedBoxes->AdvancedSearch->SearchValue = @$filter["x_RecommendedBoxes"];
		$this->RecommendedBoxes->AdvancedSearch->SearchOperator = @$filter["z_RecommendedBoxes"];
		$this->RecommendedBoxes->AdvancedSearch->SearchCondition = @$filter["v_RecommendedBoxes"];
		$this->RecommendedBoxes->AdvancedSearch->SearchValue2 = @$filter["y_RecommendedBoxes"];
		$this->RecommendedBoxes->AdvancedSearch->SearchOperator2 = @$filter["w_RecommendedBoxes"];
		$this->RecommendedBoxes->AdvancedSearch->save();

		// Field RecommendedWireFootage
		$this->RecommendedWireFootage->AdvancedSearch->SearchValue = @$filter["x_RecommendedWireFootage"];
		$this->RecommendedWireFootage->AdvancedSearch->SearchOperator = @$filter["z_RecommendedWireFootage"];
		$this->RecommendedWireFootage->AdvancedSearch->SearchCondition = @$filter["v_RecommendedWireFootage"];
		$this->RecommendedWireFootage->AdvancedSearch->SearchValue2 = @$filter["y_RecommendedWireFootage"];
		$this->RecommendedWireFootage->AdvancedSearch->SearchOperator2 = @$filter["w_RecommendedWireFootage"];
		$this->RecommendedWireFootage->AdvancedSearch->save();

		// Field CoverageType_Idn
		$this->CoverageType_Idn->AdvancedSearch->SearchValue = @$filter["x_CoverageType_Idn"];
		$this->CoverageType_Idn->AdvancedSearch->SearchOperator = @$filter["z_CoverageType_Idn"];
		$this->CoverageType_Idn->AdvancedSearch->SearchCondition = @$filter["v_CoverageType_Idn"];
		$this->CoverageType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_CoverageType_Idn"];
		$this->CoverageType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_CoverageType_Idn"];
		$this->CoverageType_Idn->AdvancedSearch->save();

		// Field HeadType_Idn
		$this->HeadType_Idn->AdvancedSearch->SearchValue = @$filter["x_HeadType_Idn"];
		$this->HeadType_Idn->AdvancedSearch->SearchOperator = @$filter["z_HeadType_Idn"];
		$this->HeadType_Idn->AdvancedSearch->SearchCondition = @$filter["v_HeadType_Idn"];
		$this->HeadType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_HeadType_Idn"];
		$this->HeadType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_HeadType_Idn"];
		$this->HeadType_Idn->AdvancedSearch->save();

		// Field FinishType_Idn
		$this->FinishType_Idn->AdvancedSearch->SearchValue = @$filter["x_FinishType_Idn"];
		$this->FinishType_Idn->AdvancedSearch->SearchOperator = @$filter["z_FinishType_Idn"];
		$this->FinishType_Idn->AdvancedSearch->SearchCondition = @$filter["v_FinishType_Idn"];
		$this->FinishType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_FinishType_Idn"];
		$this->FinishType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_FinishType_Idn"];
		$this->FinishType_Idn->AdvancedSearch->save();

		// Field Outlet_Idn
		$this->Outlet_Idn->AdvancedSearch->SearchValue = @$filter["x_Outlet_Idn"];
		$this->Outlet_Idn->AdvancedSearch->SearchOperator = @$filter["z_Outlet_Idn"];
		$this->Outlet_Idn->AdvancedSearch->SearchCondition = @$filter["v_Outlet_Idn"];
		$this->Outlet_Idn->AdvancedSearch->SearchValue2 = @$filter["y_Outlet_Idn"];
		$this->Outlet_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_Outlet_Idn"];
		$this->Outlet_Idn->AdvancedSearch->save();

		// Field RiserType_Idn
		$this->RiserType_Idn->AdvancedSearch->SearchValue = @$filter["x_RiserType_Idn"];
		$this->RiserType_Idn->AdvancedSearch->SearchOperator = @$filter["z_RiserType_Idn"];
		$this->RiserType_Idn->AdvancedSearch->SearchCondition = @$filter["v_RiserType_Idn"];
		$this->RiserType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_RiserType_Idn"];
		$this->RiserType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_RiserType_Idn"];
		$this->RiserType_Idn->AdvancedSearch->save();

		// Field BackFlowType_Idn
		$this->BackFlowType_Idn->AdvancedSearch->SearchValue = @$filter["x_BackFlowType_Idn"];
		$this->BackFlowType_Idn->AdvancedSearch->SearchOperator = @$filter["z_BackFlowType_Idn"];
		$this->BackFlowType_Idn->AdvancedSearch->SearchCondition = @$filter["v_BackFlowType_Idn"];
		$this->BackFlowType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_BackFlowType_Idn"];
		$this->BackFlowType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_BackFlowType_Idn"];
		$this->BackFlowType_Idn->AdvancedSearch->save();

		// Field ControlValve_Idn
		$this->ControlValve_Idn->AdvancedSearch->SearchValue = @$filter["x_ControlValve_Idn"];
		$this->ControlValve_Idn->AdvancedSearch->SearchOperator = @$filter["z_ControlValve_Idn"];
		$this->ControlValve_Idn->AdvancedSearch->SearchCondition = @$filter["v_ControlValve_Idn"];
		$this->ControlValve_Idn->AdvancedSearch->SearchValue2 = @$filter["y_ControlValve_Idn"];
		$this->ControlValve_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_ControlValve_Idn"];
		$this->ControlValve_Idn->AdvancedSearch->save();

		// Field CheckValve_Idn
		$this->CheckValve_Idn->AdvancedSearch->SearchValue = @$filter["x_CheckValve_Idn"];
		$this->CheckValve_Idn->AdvancedSearch->SearchOperator = @$filter["z_CheckValve_Idn"];
		$this->CheckValve_Idn->AdvancedSearch->SearchCondition = @$filter["v_CheckValve_Idn"];
		$this->CheckValve_Idn->AdvancedSearch->SearchValue2 = @$filter["y_CheckValve_Idn"];
		$this->CheckValve_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_CheckValve_Idn"];
		$this->CheckValve_Idn->AdvancedSearch->save();

		// Field FDCType_Idn
		$this->FDCType_Idn->AdvancedSearch->SearchValue = @$filter["x_FDCType_Idn"];
		$this->FDCType_Idn->AdvancedSearch->SearchOperator = @$filter["z_FDCType_Idn"];
		$this->FDCType_Idn->AdvancedSearch->SearchCondition = @$filter["v_FDCType_Idn"];
		$this->FDCType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_FDCType_Idn"];
		$this->FDCType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_FDCType_Idn"];
		$this->FDCType_Idn->AdvancedSearch->save();

		// Field BellType_Idn
		$this->BellType_Idn->AdvancedSearch->SearchValue = @$filter["x_BellType_Idn"];
		$this->BellType_Idn->AdvancedSearch->SearchOperator = @$filter["z_BellType_Idn"];
		$this->BellType_Idn->AdvancedSearch->SearchCondition = @$filter["v_BellType_Idn"];
		$this->BellType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_BellType_Idn"];
		$this->BellType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_BellType_Idn"];
		$this->BellType_Idn->AdvancedSearch->save();

		// Field TappingTee_Idn
		$this->TappingTee_Idn->AdvancedSearch->SearchValue = @$filter["x_TappingTee_Idn"];
		$this->TappingTee_Idn->AdvancedSearch->SearchOperator = @$filter["z_TappingTee_Idn"];
		$this->TappingTee_Idn->AdvancedSearch->SearchCondition = @$filter["v_TappingTee_Idn"];
		$this->TappingTee_Idn->AdvancedSearch->SearchValue2 = @$filter["y_TappingTee_Idn"];
		$this->TappingTee_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_TappingTee_Idn"];
		$this->TappingTee_Idn->AdvancedSearch->save();

		// Field UndergroundValve_Idn
		$this->UndergroundValve_Idn->AdvancedSearch->SearchValue = @$filter["x_UndergroundValve_Idn"];
		$this->UndergroundValve_Idn->AdvancedSearch->SearchOperator = @$filter["z_UndergroundValve_Idn"];
		$this->UndergroundValve_Idn->AdvancedSearch->SearchCondition = @$filter["v_UndergroundValve_Idn"];
		$this->UndergroundValve_Idn->AdvancedSearch->SearchValue2 = @$filter["y_UndergroundValve_Idn"];
		$this->UndergroundValve_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_UndergroundValve_Idn"];
		$this->UndergroundValve_Idn->AdvancedSearch->save();

		// Field LiftDuration_Idn
		$this->LiftDuration_Idn->AdvancedSearch->SearchValue = @$filter["x_LiftDuration_Idn"];
		$this->LiftDuration_Idn->AdvancedSearch->SearchOperator = @$filter["z_LiftDuration_Idn"];
		$this->LiftDuration_Idn->AdvancedSearch->SearchCondition = @$filter["v_LiftDuration_Idn"];
		$this->LiftDuration_Idn->AdvancedSearch->SearchValue2 = @$filter["y_LiftDuration_Idn"];
		$this->LiftDuration_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_LiftDuration_Idn"];
		$this->LiftDuration_Idn->AdvancedSearch->save();

		// Field TrimPackageFlag
		$this->TrimPackageFlag->AdvancedSearch->SearchValue = @$filter["x_TrimPackageFlag"];
		$this->TrimPackageFlag->AdvancedSearch->SearchOperator = @$filter["z_TrimPackageFlag"];
		$this->TrimPackageFlag->AdvancedSearch->SearchCondition = @$filter["v_TrimPackageFlag"];
		$this->TrimPackageFlag->AdvancedSearch->SearchValue2 = @$filter["y_TrimPackageFlag"];
		$this->TrimPackageFlag->AdvancedSearch->SearchOperator2 = @$filter["w_TrimPackageFlag"];
		$this->TrimPackageFlag->AdvancedSearch->save();

		// Field ListedFlag
		$this->ListedFlag->AdvancedSearch->SearchValue = @$filter["x_ListedFlag"];
		$this->ListedFlag->AdvancedSearch->SearchOperator = @$filter["z_ListedFlag"];
		$this->ListedFlag->AdvancedSearch->SearchCondition = @$filter["v_ListedFlag"];
		$this->ListedFlag->AdvancedSearch->SearchValue2 = @$filter["y_ListedFlag"];
		$this->ListedFlag->AdvancedSearch->SearchOperator2 = @$filter["w_ListedFlag"];
		$this->ListedFlag->AdvancedSearch->save();

		// Field BoxWireLength
		$this->BoxWireLength->AdvancedSearch->SearchValue = @$filter["x_BoxWireLength"];
		$this->BoxWireLength->AdvancedSearch->SearchOperator = @$filter["z_BoxWireLength"];
		$this->BoxWireLength->AdvancedSearch->SearchCondition = @$filter["v_BoxWireLength"];
		$this->BoxWireLength->AdvancedSearch->SearchValue2 = @$filter["y_BoxWireLength"];
		$this->BoxWireLength->AdvancedSearch->SearchOperator2 = @$filter["w_BoxWireLength"];
		$this->BoxWireLength->AdvancedSearch->save();

		// Field IsFirePump
		$this->IsFirePump->AdvancedSearch->SearchValue = @$filter["x_IsFirePump"];
		$this->IsFirePump->AdvancedSearch->SearchOperator = @$filter["z_IsFirePump"];
		$this->IsFirePump->AdvancedSearch->SearchCondition = @$filter["v_IsFirePump"];
		$this->IsFirePump->AdvancedSearch->SearchValue2 = @$filter["y_IsFirePump"];
		$this->IsFirePump->AdvancedSearch->SearchOperator2 = @$filter["w_IsFirePump"];
		$this->IsFirePump->AdvancedSearch->save();

		// Field FirePumpType_Idn
		$this->FirePumpType_Idn->AdvancedSearch->SearchValue = @$filter["x_FirePumpType_Idn"];
		$this->FirePumpType_Idn->AdvancedSearch->SearchOperator = @$filter["z_FirePumpType_Idn"];
		$this->FirePumpType_Idn->AdvancedSearch->SearchCondition = @$filter["v_FirePumpType_Idn"];
		$this->FirePumpType_Idn->AdvancedSearch->SearchValue2 = @$filter["y_FirePumpType_Idn"];
		$this->FirePumpType_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_FirePumpType_Idn"];
		$this->FirePumpType_Idn->AdvancedSearch->save();

		// Field FirePumpAttribute_Idn
		$this->FirePumpAttribute_Idn->AdvancedSearch->SearchValue = @$filter["x_FirePumpAttribute_Idn"];
		$this->FirePumpAttribute_Idn->AdvancedSearch->SearchOperator = @$filter["z_FirePumpAttribute_Idn"];
		$this->FirePumpAttribute_Idn->AdvancedSearch->SearchCondition = @$filter["v_FirePumpAttribute_Idn"];
		$this->FirePumpAttribute_Idn->AdvancedSearch->SearchValue2 = @$filter["y_FirePumpAttribute_Idn"];
		$this->FirePumpAttribute_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_FirePumpAttribute_Idn"];
		$this->FirePumpAttribute_Idn->AdvancedSearch->save();

		// Field IsDieselFuel
		$this->IsDieselFuel->AdvancedSearch->SearchValue = @$filter["x_IsDieselFuel"];
		$this->IsDieselFuel->AdvancedSearch->SearchOperator = @$filter["z_IsDieselFuel"];
		$this->IsDieselFuel->AdvancedSearch->SearchCondition = @$filter["v_IsDieselFuel"];
		$this->IsDieselFuel->AdvancedSearch->SearchValue2 = @$filter["y_IsDieselFuel"];
		$this->IsDieselFuel->AdvancedSearch->SearchOperator2 = @$filter["w_IsDieselFuel"];
		$this->IsDieselFuel->AdvancedSearch->save();

		// Field IsSolution
		$this->IsSolution->AdvancedSearch->SearchValue = @$filter["x_IsSolution"];
		$this->IsSolution->AdvancedSearch->SearchOperator = @$filter["z_IsSolution"];
		$this->IsSolution->AdvancedSearch->SearchCondition = @$filter["v_IsSolution"];
		$this->IsSolution->AdvancedSearch->SearchValue2 = @$filter["y_IsSolution"];
		$this->IsSolution->AdvancedSearch->SearchOperator2 = @$filter["w_IsSolution"];
		$this->IsSolution->AdvancedSearch->save();

		// Field Position_Idn
		$this->Position_Idn->AdvancedSearch->SearchValue = @$filter["x_Position_Idn"];
		$this->Position_Idn->AdvancedSearch->SearchOperator = @$filter["z_Position_Idn"];
		$this->Position_Idn->AdvancedSearch->SearchCondition = @$filter["v_Position_Idn"];
		$this->Position_Idn->AdvancedSearch->SearchValue2 = @$filter["y_Position_Idn"];
		$this->Position_Idn->AdvancedSearch->SearchOperator2 = @$filter["w_Position_Idn"];
		$this->Position_Idn->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->Product_Idn, $default, FALSE); // Product_Idn
		$this->buildSearchSql($where, $this->Department_Idn, $default, FALSE); // Department_Idn
		$this->buildSearchSql($where, $this->WorksheetMaster_Idn, $default, FALSE); // WorksheetMaster_Idn
		$this->buildSearchSql($where, $this->WorksheetCategory_Idn, $default, FALSE); // WorksheetCategory_Idn
		$this->buildSearchSql($where, $this->Manufacturer_Idn, $default, FALSE); // Manufacturer_Idn
		$this->buildSearchSql($where, $this->Rank, $default, FALSE); // Rank
		$this->buildSearchSql($where, $this->Name, $default, FALSE); // Name
		$this->buildSearchSql($where, $this->MaterialUnitPrice, $default, FALSE); // MaterialUnitPrice
		$this->buildSearchSql($where, $this->FieldUnitPrice, $default, FALSE); // FieldUnitPrice
		$this->buildSearchSql($where, $this->ShopUnitPrice, $default, FALSE); // ShopUnitPrice
		$this->buildSearchSql($where, $this->EngineerUnitPrice, $default, FALSE); // EngineerUnitPrice
		$this->buildSearchSql($where, $this->DefaultQuantity, $default, FALSE); // DefaultQuantity
		$this->buildSearchSql($where, $this->ProductSize_Idn, $default, FALSE); // ProductSize_Idn
		$this->buildSearchSql($where, $this->Description, $default, FALSE); // Description
		$this->buildSearchSql($where, $this->PipeType_Idn, $default, FALSE); // PipeType_Idn
		$this->buildSearchSql($where, $this->ScheduleType_Idn, $default, FALSE); // ScheduleType_Idn
		$this->buildSearchSql($where, $this->Fitting_Idn, $default, FALSE); // Fitting_Idn
		$this->buildSearchSql($where, $this->GroovedFittingType_Idn, $default, FALSE); // GroovedFittingType_Idn
		$this->buildSearchSql($where, $this->ThreadedFittingType_Idn, $default, FALSE); // ThreadedFittingType_Idn
		$this->buildSearchSql($where, $this->HangerType_Idn, $default, FALSE); // HangerType_Idn
		$this->buildSearchSql($where, $this->HangerSubType_Idn, $default, FALSE); // HangerSubType_Idn
		$this->buildSearchSql($where, $this->SubcontractCategory_Idn, $default, FALSE); // SubcontractCategory_Idn
		$this->buildSearchSql($where, $this->ApplyToAdjustmentFactorsFlag, $default, FALSE); // ApplyToAdjustmentFactorsFlag
		$this->buildSearchSql($where, $this->ApplyToContingencyFlag, $default, FALSE); // ApplyToContingencyFlag
		$this->buildSearchSql($where, $this->IsMainComponent, $default, FALSE); // IsMainComponent
		$this->buildSearchSql($where, $this->DomesticFlag, $default, FALSE); // DomesticFlag
		$this->buildSearchSql($where, $this->LoadFlag, $default, FALSE); // LoadFlag
		$this->buildSearchSql($where, $this->AutoLoadFlag, $default, FALSE); // AutoLoadFlag
		$this->buildSearchSql($where, $this->ActiveFlag, $default, FALSE); // ActiveFlag
		$this->buildSearchSql($where, $this->GradeType_Idn, $default, FALSE); // GradeType_Idn
		$this->buildSearchSql($where, $this->PressureType_Idn, $default, FALSE); // PressureType_Idn
		$this->buildSearchSql($where, $this->SeamlessFlag, $default, FALSE); // SeamlessFlag
		$this->buildSearchSql($where, $this->ResponseType, $default, FALSE); // ResponseType
		$this->buildSearchSql($where, $this->FMJobFlag, $default, FALSE); // FMJobFlag
		$this->buildSearchSql($where, $this->RecommendedBoxes, $default, FALSE); // RecommendedBoxes
		$this->buildSearchSql($where, $this->RecommendedWireFootage, $default, FALSE); // RecommendedWireFootage
		$this->buildSearchSql($where, $this->CoverageType_Idn, $default, FALSE); // CoverageType_Idn
		$this->buildSearchSql($where, $this->HeadType_Idn, $default, FALSE); // HeadType_Idn
		$this->buildSearchSql($where, $this->FinishType_Idn, $default, FALSE); // FinishType_Idn
		$this->buildSearchSql($where, $this->Outlet_Idn, $default, FALSE); // Outlet_Idn
		$this->buildSearchSql($where, $this->RiserType_Idn, $default, FALSE); // RiserType_Idn
		$this->buildSearchSql($where, $this->BackFlowType_Idn, $default, FALSE); // BackFlowType_Idn
		$this->buildSearchSql($where, $this->ControlValve_Idn, $default, FALSE); // ControlValve_Idn
		$this->buildSearchSql($where, $this->CheckValve_Idn, $default, FALSE); // CheckValve_Idn
		$this->buildSearchSql($where, $this->FDCType_Idn, $default, FALSE); // FDCType_Idn
		$this->buildSearchSql($where, $this->BellType_Idn, $default, FALSE); // BellType_Idn
		$this->buildSearchSql($where, $this->TappingTee_Idn, $default, FALSE); // TappingTee_Idn
		$this->buildSearchSql($where, $this->UndergroundValve_Idn, $default, FALSE); // UndergroundValve_Idn
		$this->buildSearchSql($where, $this->LiftDuration_Idn, $default, FALSE); // LiftDuration_Idn
		$this->buildSearchSql($where, $this->TrimPackageFlag, $default, FALSE); // TrimPackageFlag
		$this->buildSearchSql($where, $this->ListedFlag, $default, FALSE); // ListedFlag
		$this->buildSearchSql($where, $this->BoxWireLength, $default, FALSE); // BoxWireLength
		$this->buildSearchSql($where, $this->IsFirePump, $default, FALSE); // IsFirePump
		$this->buildSearchSql($where, $this->FirePumpType_Idn, $default, FALSE); // FirePumpType_Idn
		$this->buildSearchSql($where, $this->FirePumpAttribute_Idn, $default, FALSE); // FirePumpAttribute_Idn
		$this->buildSearchSql($where, $this->IsDieselFuel, $default, FALSE); // IsDieselFuel
		$this->buildSearchSql($where, $this->IsSolution, $default, FALSE); // IsSolution
		$this->buildSearchSql($where, $this->Position_Idn, $default, FALSE); // Position_Idn

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->Product_Idn->AdvancedSearch->save(); // Product_Idn
			$this->Department_Idn->AdvancedSearch->save(); // Department_Idn
			$this->WorksheetMaster_Idn->AdvancedSearch->save(); // WorksheetMaster_Idn
			$this->WorksheetCategory_Idn->AdvancedSearch->save(); // WorksheetCategory_Idn
			$this->Manufacturer_Idn->AdvancedSearch->save(); // Manufacturer_Idn
			$this->Rank->AdvancedSearch->save(); // Rank
			$this->Name->AdvancedSearch->save(); // Name
			$this->MaterialUnitPrice->AdvancedSearch->save(); // MaterialUnitPrice
			$this->FieldUnitPrice->AdvancedSearch->save(); // FieldUnitPrice
			$this->ShopUnitPrice->AdvancedSearch->save(); // ShopUnitPrice
			$this->EngineerUnitPrice->AdvancedSearch->save(); // EngineerUnitPrice
			$this->DefaultQuantity->AdvancedSearch->save(); // DefaultQuantity
			$this->ProductSize_Idn->AdvancedSearch->save(); // ProductSize_Idn
			$this->Description->AdvancedSearch->save(); // Description
			$this->PipeType_Idn->AdvancedSearch->save(); // PipeType_Idn
			$this->ScheduleType_Idn->AdvancedSearch->save(); // ScheduleType_Idn
			$this->Fitting_Idn->AdvancedSearch->save(); // Fitting_Idn
			$this->GroovedFittingType_Idn->AdvancedSearch->save(); // GroovedFittingType_Idn
			$this->ThreadedFittingType_Idn->AdvancedSearch->save(); // ThreadedFittingType_Idn
			$this->HangerType_Idn->AdvancedSearch->save(); // HangerType_Idn
			$this->HangerSubType_Idn->AdvancedSearch->save(); // HangerSubType_Idn
			$this->SubcontractCategory_Idn->AdvancedSearch->save(); // SubcontractCategory_Idn
			$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->save(); // ApplyToAdjustmentFactorsFlag
			$this->ApplyToContingencyFlag->AdvancedSearch->save(); // ApplyToContingencyFlag
			$this->IsMainComponent->AdvancedSearch->save(); // IsMainComponent
			$this->DomesticFlag->AdvancedSearch->save(); // DomesticFlag
			$this->LoadFlag->AdvancedSearch->save(); // LoadFlag
			$this->AutoLoadFlag->AdvancedSearch->save(); // AutoLoadFlag
			$this->ActiveFlag->AdvancedSearch->save(); // ActiveFlag
			$this->GradeType_Idn->AdvancedSearch->save(); // GradeType_Idn
			$this->PressureType_Idn->AdvancedSearch->save(); // PressureType_Idn
			$this->SeamlessFlag->AdvancedSearch->save(); // SeamlessFlag
			$this->ResponseType->AdvancedSearch->save(); // ResponseType
			$this->FMJobFlag->AdvancedSearch->save(); // FMJobFlag
			$this->RecommendedBoxes->AdvancedSearch->save(); // RecommendedBoxes
			$this->RecommendedWireFootage->AdvancedSearch->save(); // RecommendedWireFootage
			$this->CoverageType_Idn->AdvancedSearch->save(); // CoverageType_Idn
			$this->HeadType_Idn->AdvancedSearch->save(); // HeadType_Idn
			$this->FinishType_Idn->AdvancedSearch->save(); // FinishType_Idn
			$this->Outlet_Idn->AdvancedSearch->save(); // Outlet_Idn
			$this->RiserType_Idn->AdvancedSearch->save(); // RiserType_Idn
			$this->BackFlowType_Idn->AdvancedSearch->save(); // BackFlowType_Idn
			$this->ControlValve_Idn->AdvancedSearch->save(); // ControlValve_Idn
			$this->CheckValve_Idn->AdvancedSearch->save(); // CheckValve_Idn
			$this->FDCType_Idn->AdvancedSearch->save(); // FDCType_Idn
			$this->BellType_Idn->AdvancedSearch->save(); // BellType_Idn
			$this->TappingTee_Idn->AdvancedSearch->save(); // TappingTee_Idn
			$this->UndergroundValve_Idn->AdvancedSearch->save(); // UndergroundValve_Idn
			$this->LiftDuration_Idn->AdvancedSearch->save(); // LiftDuration_Idn
			$this->TrimPackageFlag->AdvancedSearch->save(); // TrimPackageFlag
			$this->ListedFlag->AdvancedSearch->save(); // ListedFlag
			$this->BoxWireLength->AdvancedSearch->save(); // BoxWireLength
			$this->IsFirePump->AdvancedSearch->save(); // IsFirePump
			$this->FirePumpType_Idn->AdvancedSearch->save(); // FirePumpType_Idn
			$this->FirePumpAttribute_Idn->AdvancedSearch->save(); // FirePumpAttribute_Idn
			$this->IsDieselFuel->AdvancedSearch->save(); // IsDieselFuel
			$this->IsSolution->AdvancedSearch->save(); // IsSolution
			$this->Position_Idn->AdvancedSearch->save(); // Position_Idn
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
		$this->buildBasicSearchSql($where, $this->Description, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ResponseType, $arKeywords, $type);
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
		if ($this->Product_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Department_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->WorksheetMaster_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->WorksheetCategory_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Manufacturer_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Rank->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Name->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->MaterialUnitPrice->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->FieldUnitPrice->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ShopUnitPrice->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->EngineerUnitPrice->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DefaultQuantity->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ProductSize_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Description->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PipeType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ScheduleType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Fitting_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->GroovedFittingType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ThreadedFittingType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->HangerType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->HangerSubType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SubcontractCategory_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ApplyToContingencyFlag->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IsMainComponent->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DomesticFlag->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LoadFlag->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AutoLoadFlag->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ActiveFlag->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->GradeType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PressureType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SeamlessFlag->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ResponseType->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->FMJobFlag->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->RecommendedBoxes->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->RecommendedWireFootage->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CoverageType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->HeadType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->FinishType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Outlet_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->RiserType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BackFlowType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ControlValve_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CheckValve_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->FDCType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BellType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TappingTee_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->UndergroundValve_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LiftDuration_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TrimPackageFlag->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ListedFlag->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BoxWireLength->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IsFirePump->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->FirePumpType_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->FirePumpAttribute_Idn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IsDieselFuel->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IsSolution->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Position_Idn->AdvancedSearch->issetSession())
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
		$this->Product_Idn->AdvancedSearch->unsetSession();
		$this->Department_Idn->AdvancedSearch->unsetSession();
		$this->WorksheetMaster_Idn->AdvancedSearch->unsetSession();
		$this->WorksheetCategory_Idn->AdvancedSearch->unsetSession();
		$this->Manufacturer_Idn->AdvancedSearch->unsetSession();
		$this->Rank->AdvancedSearch->unsetSession();
		$this->Name->AdvancedSearch->unsetSession();
		$this->MaterialUnitPrice->AdvancedSearch->unsetSession();
		$this->FieldUnitPrice->AdvancedSearch->unsetSession();
		$this->ShopUnitPrice->AdvancedSearch->unsetSession();
		$this->EngineerUnitPrice->AdvancedSearch->unsetSession();
		$this->DefaultQuantity->AdvancedSearch->unsetSession();
		$this->ProductSize_Idn->AdvancedSearch->unsetSession();
		$this->Description->AdvancedSearch->unsetSession();
		$this->PipeType_Idn->AdvancedSearch->unsetSession();
		$this->ScheduleType_Idn->AdvancedSearch->unsetSession();
		$this->Fitting_Idn->AdvancedSearch->unsetSession();
		$this->GroovedFittingType_Idn->AdvancedSearch->unsetSession();
		$this->ThreadedFittingType_Idn->AdvancedSearch->unsetSession();
		$this->HangerType_Idn->AdvancedSearch->unsetSession();
		$this->HangerSubType_Idn->AdvancedSearch->unsetSession();
		$this->SubcontractCategory_Idn->AdvancedSearch->unsetSession();
		$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->unsetSession();
		$this->ApplyToContingencyFlag->AdvancedSearch->unsetSession();
		$this->IsMainComponent->AdvancedSearch->unsetSession();
		$this->DomesticFlag->AdvancedSearch->unsetSession();
		$this->LoadFlag->AdvancedSearch->unsetSession();
		$this->AutoLoadFlag->AdvancedSearch->unsetSession();
		$this->ActiveFlag->AdvancedSearch->unsetSession();
		$this->GradeType_Idn->AdvancedSearch->unsetSession();
		$this->PressureType_Idn->AdvancedSearch->unsetSession();
		$this->SeamlessFlag->AdvancedSearch->unsetSession();
		$this->ResponseType->AdvancedSearch->unsetSession();
		$this->FMJobFlag->AdvancedSearch->unsetSession();
		$this->RecommendedBoxes->AdvancedSearch->unsetSession();
		$this->RecommendedWireFootage->AdvancedSearch->unsetSession();
		$this->CoverageType_Idn->AdvancedSearch->unsetSession();
		$this->HeadType_Idn->AdvancedSearch->unsetSession();
		$this->FinishType_Idn->AdvancedSearch->unsetSession();
		$this->Outlet_Idn->AdvancedSearch->unsetSession();
		$this->RiserType_Idn->AdvancedSearch->unsetSession();
		$this->BackFlowType_Idn->AdvancedSearch->unsetSession();
		$this->ControlValve_Idn->AdvancedSearch->unsetSession();
		$this->CheckValve_Idn->AdvancedSearch->unsetSession();
		$this->FDCType_Idn->AdvancedSearch->unsetSession();
		$this->BellType_Idn->AdvancedSearch->unsetSession();
		$this->TappingTee_Idn->AdvancedSearch->unsetSession();
		$this->UndergroundValve_Idn->AdvancedSearch->unsetSession();
		$this->LiftDuration_Idn->AdvancedSearch->unsetSession();
		$this->TrimPackageFlag->AdvancedSearch->unsetSession();
		$this->ListedFlag->AdvancedSearch->unsetSession();
		$this->BoxWireLength->AdvancedSearch->unsetSession();
		$this->IsFirePump->AdvancedSearch->unsetSession();
		$this->FirePumpType_Idn->AdvancedSearch->unsetSession();
		$this->FirePumpAttribute_Idn->AdvancedSearch->unsetSession();
		$this->IsDieselFuel->AdvancedSearch->unsetSession();
		$this->IsSolution->AdvancedSearch->unsetSession();
		$this->Position_Idn->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->Product_Idn->AdvancedSearch->load();
		$this->Department_Idn->AdvancedSearch->load();
		$this->WorksheetMaster_Idn->AdvancedSearch->load();
		$this->WorksheetCategory_Idn->AdvancedSearch->load();
		$this->Manufacturer_Idn->AdvancedSearch->load();
		$this->Rank->AdvancedSearch->load();
		$this->Name->AdvancedSearch->load();
		$this->MaterialUnitPrice->AdvancedSearch->load();
		$this->FieldUnitPrice->AdvancedSearch->load();
		$this->ShopUnitPrice->AdvancedSearch->load();
		$this->EngineerUnitPrice->AdvancedSearch->load();
		$this->DefaultQuantity->AdvancedSearch->load();
		$this->ProductSize_Idn->AdvancedSearch->load();
		$this->Description->AdvancedSearch->load();
		$this->PipeType_Idn->AdvancedSearch->load();
		$this->ScheduleType_Idn->AdvancedSearch->load();
		$this->Fitting_Idn->AdvancedSearch->load();
		$this->GroovedFittingType_Idn->AdvancedSearch->load();
		$this->ThreadedFittingType_Idn->AdvancedSearch->load();
		$this->HangerType_Idn->AdvancedSearch->load();
		$this->HangerSubType_Idn->AdvancedSearch->load();
		$this->SubcontractCategory_Idn->AdvancedSearch->load();
		$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->load();
		$this->ApplyToContingencyFlag->AdvancedSearch->load();
		$this->IsMainComponent->AdvancedSearch->load();
		$this->DomesticFlag->AdvancedSearch->load();
		$this->LoadFlag->AdvancedSearch->load();
		$this->AutoLoadFlag->AdvancedSearch->load();
		$this->ActiveFlag->AdvancedSearch->load();
		$this->GradeType_Idn->AdvancedSearch->load();
		$this->PressureType_Idn->AdvancedSearch->load();
		$this->SeamlessFlag->AdvancedSearch->load();
		$this->ResponseType->AdvancedSearch->load();
		$this->FMJobFlag->AdvancedSearch->load();
		$this->RecommendedBoxes->AdvancedSearch->load();
		$this->RecommendedWireFootage->AdvancedSearch->load();
		$this->CoverageType_Idn->AdvancedSearch->load();
		$this->HeadType_Idn->AdvancedSearch->load();
		$this->FinishType_Idn->AdvancedSearch->load();
		$this->Outlet_Idn->AdvancedSearch->load();
		$this->RiserType_Idn->AdvancedSearch->load();
		$this->BackFlowType_Idn->AdvancedSearch->load();
		$this->ControlValve_Idn->AdvancedSearch->load();
		$this->CheckValve_Idn->AdvancedSearch->load();
		$this->FDCType_Idn->AdvancedSearch->load();
		$this->BellType_Idn->AdvancedSearch->load();
		$this->TappingTee_Idn->AdvancedSearch->load();
		$this->UndergroundValve_Idn->AdvancedSearch->load();
		$this->LiftDuration_Idn->AdvancedSearch->load();
		$this->TrimPackageFlag->AdvancedSearch->load();
		$this->ListedFlag->AdvancedSearch->load();
		$this->BoxWireLength->AdvancedSearch->load();
		$this->IsFirePump->AdvancedSearch->load();
		$this->FirePumpType_Idn->AdvancedSearch->load();
		$this->FirePumpAttribute_Idn->AdvancedSearch->load();
		$this->IsDieselFuel->AdvancedSearch->load();
		$this->IsSolution->AdvancedSearch->load();
		$this->Position_Idn->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->Product_Idn); // Product_Idn
			$this->updateSort($this->Department_Idn); // Department_Idn
			$this->updateSort($this->WorksheetMaster_Idn); // WorksheetMaster_Idn
			$this->updateSort($this->WorksheetCategory_Idn); // WorksheetCategory_Idn
			$this->updateSort($this->Manufacturer_Idn); // Manufacturer_Idn
			$this->updateSort($this->Rank); // Rank
			$this->updateSort($this->Name); // Name
			$this->updateSort($this->MaterialUnitPrice); // MaterialUnitPrice
			$this->updateSort($this->FieldUnitPrice); // FieldUnitPrice
			$this->updateSort($this->ShopUnitPrice); // ShopUnitPrice
			$this->updateSort($this->EngineerUnitPrice); // EngineerUnitPrice
			$this->updateSort($this->DefaultQuantity); // DefaultQuantity
			$this->updateSort($this->ProductSize_Idn); // ProductSize_Idn
			$this->updateSort($this->Description); // Description
			$this->updateSort($this->PipeType_Idn); // PipeType_Idn
			$this->updateSort($this->ScheduleType_Idn); // ScheduleType_Idn
			$this->updateSort($this->Fitting_Idn); // Fitting_Idn
			$this->updateSort($this->GroovedFittingType_Idn); // GroovedFittingType_Idn
			$this->updateSort($this->ThreadedFittingType_Idn); // ThreadedFittingType_Idn
			$this->updateSort($this->HangerType_Idn); // HangerType_Idn
			$this->updateSort($this->HangerSubType_Idn); // HangerSubType_Idn
			$this->updateSort($this->SubcontractCategory_Idn); // SubcontractCategory_Idn
			$this->updateSort($this->ApplyToAdjustmentFactorsFlag); // ApplyToAdjustmentFactorsFlag
			$this->updateSort($this->ApplyToContingencyFlag); // ApplyToContingencyFlag
			$this->updateSort($this->IsMainComponent); // IsMainComponent
			$this->updateSort($this->DomesticFlag); // DomesticFlag
			$this->updateSort($this->LoadFlag); // LoadFlag
			$this->updateSort($this->AutoLoadFlag); // AutoLoadFlag
			$this->updateSort($this->ActiveFlag); // ActiveFlag
			$this->updateSort($this->GradeType_Idn); // GradeType_Idn
			$this->updateSort($this->PressureType_Idn); // PressureType_Idn
			$this->updateSort($this->SeamlessFlag); // SeamlessFlag
			$this->updateSort($this->ResponseType); // ResponseType
			$this->updateSort($this->FMJobFlag); // FMJobFlag
			$this->updateSort($this->RecommendedBoxes); // RecommendedBoxes
			$this->updateSort($this->RecommendedWireFootage); // RecommendedWireFootage
			$this->updateSort($this->CoverageType_Idn); // CoverageType_Idn
			$this->updateSort($this->HeadType_Idn); // HeadType_Idn
			$this->updateSort($this->FinishType_Idn); // FinishType_Idn
			$this->updateSort($this->Outlet_Idn); // Outlet_Idn
			$this->updateSort($this->RiserType_Idn); // RiserType_Idn
			$this->updateSort($this->BackFlowType_Idn); // BackFlowType_Idn
			$this->updateSort($this->ControlValve_Idn); // ControlValve_Idn
			$this->updateSort($this->CheckValve_Idn); // CheckValve_Idn
			$this->updateSort($this->FDCType_Idn); // FDCType_Idn
			$this->updateSort($this->BellType_Idn); // BellType_Idn
			$this->updateSort($this->TappingTee_Idn); // TappingTee_Idn
			$this->updateSort($this->UndergroundValve_Idn); // UndergroundValve_Idn
			$this->updateSort($this->LiftDuration_Idn); // LiftDuration_Idn
			$this->updateSort($this->TrimPackageFlag); // TrimPackageFlag
			$this->updateSort($this->ListedFlag); // ListedFlag
			$this->updateSort($this->BoxWireLength); // BoxWireLength
			$this->updateSort($this->IsFirePump); // IsFirePump
			$this->updateSort($this->FirePumpType_Idn); // FirePumpType_Idn
			$this->updateSort($this->FirePumpAttribute_Idn); // FirePumpAttribute_Idn
			$this->updateSort($this->IsDieselFuel); // IsDieselFuel
			$this->updateSort($this->IsSolution); // IsSolution
			$this->updateSort($this->Position_Idn); // Position_Idn
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
				$this->WorksheetMaster_Idn->setSort("ASC");
				$this->WorksheetCategory_Idn->setSort("ASC");
				$this->ProductSize_Idn->setSort("ASC");
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
				$this->Product_Idn->setSort("");
				$this->Department_Idn->setSort("");
				$this->WorksheetMaster_Idn->setSort("");
				$this->WorksheetCategory_Idn->setSort("");
				$this->Manufacturer_Idn->setSort("");
				$this->Rank->setSort("");
				$this->Name->setSort("");
				$this->MaterialUnitPrice->setSort("");
				$this->FieldUnitPrice->setSort("");
				$this->ShopUnitPrice->setSort("");
				$this->EngineerUnitPrice->setSort("");
				$this->DefaultQuantity->setSort("");
				$this->ProductSize_Idn->setSort("");
				$this->Description->setSort("");
				$this->PipeType_Idn->setSort("");
				$this->ScheduleType_Idn->setSort("");
				$this->Fitting_Idn->setSort("");
				$this->GroovedFittingType_Idn->setSort("");
				$this->ThreadedFittingType_Idn->setSort("");
				$this->HangerType_Idn->setSort("");
				$this->HangerSubType_Idn->setSort("");
				$this->SubcontractCategory_Idn->setSort("");
				$this->ApplyToAdjustmentFactorsFlag->setSort("");
				$this->ApplyToContingencyFlag->setSort("");
				$this->IsMainComponent->setSort("");
				$this->DomesticFlag->setSort("");
				$this->LoadFlag->setSort("");
				$this->AutoLoadFlag->setSort("");
				$this->ActiveFlag->setSort("");
				$this->GradeType_Idn->setSort("");
				$this->PressureType_Idn->setSort("");
				$this->SeamlessFlag->setSort("");
				$this->ResponseType->setSort("");
				$this->FMJobFlag->setSort("");
				$this->RecommendedBoxes->setSort("");
				$this->RecommendedWireFootage->setSort("");
				$this->CoverageType_Idn->setSort("");
				$this->HeadType_Idn->setSort("");
				$this->FinishType_Idn->setSort("");
				$this->Outlet_Idn->setSort("");
				$this->RiserType_Idn->setSort("");
				$this->BackFlowType_Idn->setSort("");
				$this->ControlValve_Idn->setSort("");
				$this->CheckValve_Idn->setSort("");
				$this->FDCType_Idn->setSort("");
				$this->BellType_Idn->setSort("");
				$this->TappingTee_Idn->setSort("");
				$this->UndergroundValve_Idn->setSort("");
				$this->LiftDuration_Idn->setSort("");
				$this->TrimPackageFlag->setSort("");
				$this->ListedFlag->setSort("");
				$this->BoxWireLength->setSort("");
				$this->IsFirePump->setSort("");
				$this->FirePumpType_Idn->setSort("");
				$this->FirePumpAttribute_Idn->setSort("");
				$this->IsDieselFuel->setSort("");
				$this->IsSolution->setSort("");
				$this->Position_Idn->setSort("");
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

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

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
			$opt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . HtmlEncode($this->Product_Idn->CurrentValue) . "\">";
			return;
		}

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
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

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->Product_Idn->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->Product_Idn->CurrentValue . "\">";
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

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->add("gridedit");
		$item->Body = "<a class=\"ew-add-edit ew-grid-edit\" title=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" href=\"" . HtmlEncode($this->GridEditUrl) . "\">" . $Language->phrase("GridEditLink") . "</a>";
		$item->Visible = $this->GridEditUrl != "" && $Security->canEdit();
		$option = $options["action"];

		// Add multi delete
		$item = &$option->add("multidelete");
		$item->Body = "<a class=\"ew-action ew-multi-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" href=\"#\" onclick=\"return ew.submitAction(event, {f:document.fProductslist, url:'" . $this->MultiDeleteUrl . "', data:{action:'show'}});return false;\">" . $Language->phrase("DeleteSelectedLink") . "</a>";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fProductslistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fProductslistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fProductslist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->Product_Idn->CurrentValue = NULL;
		$this->Product_Idn->OldValue = $this->Product_Idn->CurrentValue;
		$this->Department_Idn->CurrentValue = 0;
		$this->Department_Idn->OldValue = $this->Department_Idn->CurrentValue;
		$this->WorksheetMaster_Idn->CurrentValue = 0;
		$this->WorksheetMaster_Idn->OldValue = $this->WorksheetMaster_Idn->CurrentValue;
		$this->WorksheetCategory_Idn->CurrentValue = 0;
		$this->WorksheetCategory_Idn->OldValue = $this->WorksheetCategory_Idn->CurrentValue;
		$this->Manufacturer_Idn->CurrentValue = 0;
		$this->Manufacturer_Idn->OldValue = $this->Manufacturer_Idn->CurrentValue;
		$this->Rank->CurrentValue = 0;
		$this->Rank->OldValue = $this->Rank->CurrentValue;
		$this->Name->CurrentValue = NULL;
		$this->Name->OldValue = $this->Name->CurrentValue;
		$this->MaterialUnitPrice->CurrentValue = 0;
		$this->MaterialUnitPrice->OldValue = $this->MaterialUnitPrice->CurrentValue;
		$this->FieldUnitPrice->CurrentValue = 0;
		$this->FieldUnitPrice->OldValue = $this->FieldUnitPrice->CurrentValue;
		$this->ShopUnitPrice->CurrentValue = 0;
		$this->ShopUnitPrice->OldValue = $this->ShopUnitPrice->CurrentValue;
		$this->EngineerUnitPrice->CurrentValue = 0;
		$this->EngineerUnitPrice->OldValue = $this->EngineerUnitPrice->CurrentValue;
		$this->DefaultQuantity->CurrentValue = NULL;
		$this->DefaultQuantity->OldValue = $this->DefaultQuantity->CurrentValue;
		$this->ProductSize_Idn->CurrentValue = 0;
		$this->ProductSize_Idn->OldValue = $this->ProductSize_Idn->CurrentValue;
		$this->Description->CurrentValue = "NULL";
		$this->Description->OldValue = $this->Description->CurrentValue;
		$this->PipeType_Idn->CurrentValue = 0;
		$this->PipeType_Idn->OldValue = $this->PipeType_Idn->CurrentValue;
		$this->ScheduleType_Idn->CurrentValue = 0;
		$this->ScheduleType_Idn->OldValue = $this->ScheduleType_Idn->CurrentValue;
		$this->Fitting_Idn->CurrentValue = 0;
		$this->Fitting_Idn->OldValue = $this->Fitting_Idn->CurrentValue;
		$this->GroovedFittingType_Idn->CurrentValue = 0;
		$this->GroovedFittingType_Idn->OldValue = $this->GroovedFittingType_Idn->CurrentValue;
		$this->ThreadedFittingType_Idn->CurrentValue = 0;
		$this->ThreadedFittingType_Idn->OldValue = $this->ThreadedFittingType_Idn->CurrentValue;
		$this->HangerType_Idn->CurrentValue = 0;
		$this->HangerType_Idn->OldValue = $this->HangerType_Idn->CurrentValue;
		$this->HangerSubType_Idn->CurrentValue = 0;
		$this->HangerSubType_Idn->OldValue = $this->HangerSubType_Idn->CurrentValue;
		$this->SubcontractCategory_Idn->CurrentValue = 0;
		$this->SubcontractCategory_Idn->OldValue = $this->SubcontractCategory_Idn->CurrentValue;
		$this->ApplyToAdjustmentFactorsFlag->CurrentValue = 1;
		$this->ApplyToAdjustmentFactorsFlag->OldValue = $this->ApplyToAdjustmentFactorsFlag->CurrentValue;
		$this->ApplyToContingencyFlag->CurrentValue = 1;
		$this->ApplyToContingencyFlag->OldValue = $this->ApplyToContingencyFlag->CurrentValue;
		$this->IsMainComponent->CurrentValue = 0;
		$this->IsMainComponent->OldValue = $this->IsMainComponent->CurrentValue;
		$this->DomesticFlag->CurrentValue = 1;
		$this->DomesticFlag->OldValue = $this->DomesticFlag->CurrentValue;
		$this->LoadFlag->CurrentValue = 1;
		$this->LoadFlag->OldValue = $this->LoadFlag->CurrentValue;
		$this->AutoLoadFlag->CurrentValue = 0;
		$this->AutoLoadFlag->OldValue = $this->AutoLoadFlag->CurrentValue;
		$this->ActiveFlag->CurrentValue = 1;
		$this->ActiveFlag->OldValue = $this->ActiveFlag->CurrentValue;
		$this->GradeType_Idn->CurrentValue = 0;
		$this->GradeType_Idn->OldValue = $this->GradeType_Idn->CurrentValue;
		$this->PressureType_Idn->CurrentValue = 0;
		$this->PressureType_Idn->OldValue = $this->PressureType_Idn->CurrentValue;
		$this->SeamlessFlag->CurrentValue = 0;
		$this->SeamlessFlag->OldValue = $this->SeamlessFlag->CurrentValue;
		$this->ResponseType->CurrentValue = "Q";
		$this->ResponseType->OldValue = $this->ResponseType->CurrentValue;
		$this->FMJobFlag->CurrentValue = 0;
		$this->FMJobFlag->OldValue = $this->FMJobFlag->CurrentValue;
		$this->RecommendedBoxes->CurrentValue = 0;
		$this->RecommendedBoxes->OldValue = $this->RecommendedBoxes->CurrentValue;
		$this->RecommendedWireFootage->CurrentValue = 0;
		$this->RecommendedWireFootage->OldValue = $this->RecommendedWireFootage->CurrentValue;
		$this->CoverageType_Idn->CurrentValue = 0;
		$this->CoverageType_Idn->OldValue = $this->CoverageType_Idn->CurrentValue;
		$this->HeadType_Idn->CurrentValue = 0;
		$this->HeadType_Idn->OldValue = $this->HeadType_Idn->CurrentValue;
		$this->FinishType_Idn->CurrentValue = 0;
		$this->FinishType_Idn->OldValue = $this->FinishType_Idn->CurrentValue;
		$this->Outlet_Idn->CurrentValue = 0;
		$this->Outlet_Idn->OldValue = $this->Outlet_Idn->CurrentValue;
		$this->RiserType_Idn->CurrentValue = 0;
		$this->RiserType_Idn->OldValue = $this->RiserType_Idn->CurrentValue;
		$this->BackFlowType_Idn->CurrentValue = 0;
		$this->BackFlowType_Idn->OldValue = $this->BackFlowType_Idn->CurrentValue;
		$this->ControlValve_Idn->CurrentValue = 0;
		$this->ControlValve_Idn->OldValue = $this->ControlValve_Idn->CurrentValue;
		$this->CheckValve_Idn->CurrentValue = 0;
		$this->CheckValve_Idn->OldValue = $this->CheckValve_Idn->CurrentValue;
		$this->FDCType_Idn->CurrentValue = 0;
		$this->FDCType_Idn->OldValue = $this->FDCType_Idn->CurrentValue;
		$this->BellType_Idn->CurrentValue = 0;
		$this->BellType_Idn->OldValue = $this->BellType_Idn->CurrentValue;
		$this->TappingTee_Idn->CurrentValue = 0;
		$this->TappingTee_Idn->OldValue = $this->TappingTee_Idn->CurrentValue;
		$this->UndergroundValve_Idn->CurrentValue = 0;
		$this->UndergroundValve_Idn->OldValue = $this->UndergroundValve_Idn->CurrentValue;
		$this->LiftDuration_Idn->CurrentValue = 0;
		$this->LiftDuration_Idn->OldValue = $this->LiftDuration_Idn->CurrentValue;
		$this->TrimPackageFlag->CurrentValue = 0;
		$this->TrimPackageFlag->OldValue = $this->TrimPackageFlag->CurrentValue;
		$this->ListedFlag->CurrentValue = 0;
		$this->ListedFlag->OldValue = $this->ListedFlag->CurrentValue;
		$this->BoxWireLength->CurrentValue = 0;
		$this->BoxWireLength->OldValue = $this->BoxWireLength->CurrentValue;
		$this->IsFirePump->CurrentValue = 0;
		$this->IsFirePump->OldValue = $this->IsFirePump->CurrentValue;
		$this->FirePumpType_Idn->CurrentValue = 0;
		$this->FirePumpType_Idn->OldValue = $this->FirePumpType_Idn->CurrentValue;
		$this->FirePumpAttribute_Idn->CurrentValue = 0;
		$this->FirePumpAttribute_Idn->OldValue = $this->FirePumpAttribute_Idn->CurrentValue;
		$this->IsDieselFuel->CurrentValue = 0;
		$this->IsDieselFuel->OldValue = $this->IsDieselFuel->CurrentValue;
		$this->IsSolution->CurrentValue = 0;
		$this->IsSolution->OldValue = $this->IsSolution->CurrentValue;
		$this->Position_Idn->CurrentValue = 0;
		$this->Position_Idn->OldValue = $this->Position_Idn->CurrentValue;
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

		// Product_Idn
		if (!$this->isAddOrEdit() && $this->Product_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Product_Idn->AdvancedSearch->SearchValue != "" || $this->Product_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Department_Idn
		if (!$this->isAddOrEdit() && $this->Department_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Department_Idn->AdvancedSearch->SearchValue != "" || $this->Department_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// WorksheetMaster_Idn
		if (!$this->isAddOrEdit() && $this->WorksheetMaster_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->WorksheetMaster_Idn->AdvancedSearch->SearchValue != "" || $this->WorksheetMaster_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// WorksheetCategory_Idn
		if (!$this->isAddOrEdit() && $this->WorksheetCategory_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->WorksheetCategory_Idn->AdvancedSearch->SearchValue != "" || $this->WorksheetCategory_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Manufacturer_Idn
		if (!$this->isAddOrEdit() && $this->Manufacturer_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Manufacturer_Idn->AdvancedSearch->SearchValue != "" || $this->Manufacturer_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Rank
		if (!$this->isAddOrEdit() && $this->Rank->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Rank->AdvancedSearch->SearchValue != "" || $this->Rank->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Name
		if (!$this->isAddOrEdit() && $this->Name->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Name->AdvancedSearch->SearchValue != "" || $this->Name->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// MaterialUnitPrice
		if (!$this->isAddOrEdit() && $this->MaterialUnitPrice->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->MaterialUnitPrice->AdvancedSearch->SearchValue != "" || $this->MaterialUnitPrice->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// FieldUnitPrice
		if (!$this->isAddOrEdit() && $this->FieldUnitPrice->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->FieldUnitPrice->AdvancedSearch->SearchValue != "" || $this->FieldUnitPrice->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ShopUnitPrice
		if (!$this->isAddOrEdit() && $this->ShopUnitPrice->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ShopUnitPrice->AdvancedSearch->SearchValue != "" || $this->ShopUnitPrice->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// EngineerUnitPrice
		if (!$this->isAddOrEdit() && $this->EngineerUnitPrice->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->EngineerUnitPrice->AdvancedSearch->SearchValue != "" || $this->EngineerUnitPrice->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DefaultQuantity
		if (!$this->isAddOrEdit() && $this->DefaultQuantity->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DefaultQuantity->AdvancedSearch->SearchValue != "" || $this->DefaultQuantity->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ProductSize_Idn
		if (!$this->isAddOrEdit() && $this->ProductSize_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ProductSize_Idn->AdvancedSearch->SearchValue != "" || $this->ProductSize_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Description
		if (!$this->isAddOrEdit() && $this->Description->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Description->AdvancedSearch->SearchValue != "" || $this->Description->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PipeType_Idn
		if (!$this->isAddOrEdit() && $this->PipeType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PipeType_Idn->AdvancedSearch->SearchValue != "" || $this->PipeType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ScheduleType_Idn
		if (!$this->isAddOrEdit() && $this->ScheduleType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ScheduleType_Idn->AdvancedSearch->SearchValue != "" || $this->ScheduleType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Fitting_Idn
		if (!$this->isAddOrEdit() && $this->Fitting_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Fitting_Idn->AdvancedSearch->SearchValue != "" || $this->Fitting_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// GroovedFittingType_Idn
		if (!$this->isAddOrEdit() && $this->GroovedFittingType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->GroovedFittingType_Idn->AdvancedSearch->SearchValue != "" || $this->GroovedFittingType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ThreadedFittingType_Idn
		if (!$this->isAddOrEdit() && $this->ThreadedFittingType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ThreadedFittingType_Idn->AdvancedSearch->SearchValue != "" || $this->ThreadedFittingType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// HangerType_Idn
		if (!$this->isAddOrEdit() && $this->HangerType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->HangerType_Idn->AdvancedSearch->SearchValue != "" || $this->HangerType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// HangerSubType_Idn
		if (!$this->isAddOrEdit() && $this->HangerSubType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->HangerSubType_Idn->AdvancedSearch->SearchValue != "" || $this->HangerSubType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SubcontractCategory_Idn
		if (!$this->isAddOrEdit() && $this->SubcontractCategory_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SubcontractCategory_Idn->AdvancedSearch->SearchValue != "" || $this->SubcontractCategory_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ApplyToAdjustmentFactorsFlag
		if (!$this->isAddOrEdit() && $this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchValue != "" || $this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchValue))
			$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchValue);
		if (is_array($this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchValue2))
			$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->SearchValue2);

		// ApplyToContingencyFlag
		if (!$this->isAddOrEdit() && $this->ApplyToContingencyFlag->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ApplyToContingencyFlag->AdvancedSearch->SearchValue != "" || $this->ApplyToContingencyFlag->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->ApplyToContingencyFlag->AdvancedSearch->SearchValue))
			$this->ApplyToContingencyFlag->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ApplyToContingencyFlag->AdvancedSearch->SearchValue);
		if (is_array($this->ApplyToContingencyFlag->AdvancedSearch->SearchValue2))
			$this->ApplyToContingencyFlag->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ApplyToContingencyFlag->AdvancedSearch->SearchValue2);

		// IsMainComponent
		if (!$this->isAddOrEdit() && $this->IsMainComponent->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IsMainComponent->AdvancedSearch->SearchValue != "" || $this->IsMainComponent->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->IsMainComponent->AdvancedSearch->SearchValue))
			$this->IsMainComponent->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->IsMainComponent->AdvancedSearch->SearchValue);
		if (is_array($this->IsMainComponent->AdvancedSearch->SearchValue2))
			$this->IsMainComponent->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->IsMainComponent->AdvancedSearch->SearchValue2);

		// DomesticFlag
		if (!$this->isAddOrEdit() && $this->DomesticFlag->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DomesticFlag->AdvancedSearch->SearchValue != "" || $this->DomesticFlag->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->DomesticFlag->AdvancedSearch->SearchValue))
			$this->DomesticFlag->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DomesticFlag->AdvancedSearch->SearchValue);
		if (is_array($this->DomesticFlag->AdvancedSearch->SearchValue2))
			$this->DomesticFlag->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->DomesticFlag->AdvancedSearch->SearchValue2);

		// LoadFlag
		if (!$this->isAddOrEdit() && $this->LoadFlag->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LoadFlag->AdvancedSearch->SearchValue != "" || $this->LoadFlag->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->LoadFlag->AdvancedSearch->SearchValue))
			$this->LoadFlag->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LoadFlag->AdvancedSearch->SearchValue);
		if (is_array($this->LoadFlag->AdvancedSearch->SearchValue2))
			$this->LoadFlag->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LoadFlag->AdvancedSearch->SearchValue2);

		// AutoLoadFlag
		if (!$this->isAddOrEdit() && $this->AutoLoadFlag->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AutoLoadFlag->AdvancedSearch->SearchValue != "" || $this->AutoLoadFlag->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->AutoLoadFlag->AdvancedSearch->SearchValue))
			$this->AutoLoadFlag->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->AutoLoadFlag->AdvancedSearch->SearchValue);
		if (is_array($this->AutoLoadFlag->AdvancedSearch->SearchValue2))
			$this->AutoLoadFlag->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->AutoLoadFlag->AdvancedSearch->SearchValue2);

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

		// GradeType_Idn
		if (!$this->isAddOrEdit() && $this->GradeType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->GradeType_Idn->AdvancedSearch->SearchValue != "" || $this->GradeType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PressureType_Idn
		if (!$this->isAddOrEdit() && $this->PressureType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PressureType_Idn->AdvancedSearch->SearchValue != "" || $this->PressureType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SeamlessFlag
		if (!$this->isAddOrEdit() && $this->SeamlessFlag->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SeamlessFlag->AdvancedSearch->SearchValue != "" || $this->SeamlessFlag->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->SeamlessFlag->AdvancedSearch->SearchValue))
			$this->SeamlessFlag->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->SeamlessFlag->AdvancedSearch->SearchValue);
		if (is_array($this->SeamlessFlag->AdvancedSearch->SearchValue2))
			$this->SeamlessFlag->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->SeamlessFlag->AdvancedSearch->SearchValue2);

		// ResponseType
		if (!$this->isAddOrEdit() && $this->ResponseType->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ResponseType->AdvancedSearch->SearchValue != "" || $this->ResponseType->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// FMJobFlag
		if (!$this->isAddOrEdit() && $this->FMJobFlag->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->FMJobFlag->AdvancedSearch->SearchValue != "" || $this->FMJobFlag->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->FMJobFlag->AdvancedSearch->SearchValue))
			$this->FMJobFlag->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->FMJobFlag->AdvancedSearch->SearchValue);
		if (is_array($this->FMJobFlag->AdvancedSearch->SearchValue2))
			$this->FMJobFlag->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->FMJobFlag->AdvancedSearch->SearchValue2);

		// RecommendedBoxes
		if (!$this->isAddOrEdit() && $this->RecommendedBoxes->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->RecommendedBoxes->AdvancedSearch->SearchValue != "" || $this->RecommendedBoxes->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// RecommendedWireFootage
		if (!$this->isAddOrEdit() && $this->RecommendedWireFootage->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->RecommendedWireFootage->AdvancedSearch->SearchValue != "" || $this->RecommendedWireFootage->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// CoverageType_Idn
		if (!$this->isAddOrEdit() && $this->CoverageType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->CoverageType_Idn->AdvancedSearch->SearchValue != "" || $this->CoverageType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// HeadType_Idn
		if (!$this->isAddOrEdit() && $this->HeadType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->HeadType_Idn->AdvancedSearch->SearchValue != "" || $this->HeadType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// FinishType_Idn
		if (!$this->isAddOrEdit() && $this->FinishType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->FinishType_Idn->AdvancedSearch->SearchValue != "" || $this->FinishType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Outlet_Idn
		if (!$this->isAddOrEdit() && $this->Outlet_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Outlet_Idn->AdvancedSearch->SearchValue != "" || $this->Outlet_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// RiserType_Idn
		if (!$this->isAddOrEdit() && $this->RiserType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->RiserType_Idn->AdvancedSearch->SearchValue != "" || $this->RiserType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BackFlowType_Idn
		if (!$this->isAddOrEdit() && $this->BackFlowType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BackFlowType_Idn->AdvancedSearch->SearchValue != "" || $this->BackFlowType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ControlValve_Idn
		if (!$this->isAddOrEdit() && $this->ControlValve_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ControlValve_Idn->AdvancedSearch->SearchValue != "" || $this->ControlValve_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// CheckValve_Idn
		if (!$this->isAddOrEdit() && $this->CheckValve_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->CheckValve_Idn->AdvancedSearch->SearchValue != "" || $this->CheckValve_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// FDCType_Idn
		if (!$this->isAddOrEdit() && $this->FDCType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->FDCType_Idn->AdvancedSearch->SearchValue != "" || $this->FDCType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BellType_Idn
		if (!$this->isAddOrEdit() && $this->BellType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BellType_Idn->AdvancedSearch->SearchValue != "" || $this->BellType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TappingTee_Idn
		if (!$this->isAddOrEdit() && $this->TappingTee_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TappingTee_Idn->AdvancedSearch->SearchValue != "" || $this->TappingTee_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// UndergroundValve_Idn
		if (!$this->isAddOrEdit() && $this->UndergroundValve_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->UndergroundValve_Idn->AdvancedSearch->SearchValue != "" || $this->UndergroundValve_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LiftDuration_Idn
		if (!$this->isAddOrEdit() && $this->LiftDuration_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LiftDuration_Idn->AdvancedSearch->SearchValue != "" || $this->LiftDuration_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TrimPackageFlag
		if (!$this->isAddOrEdit() && $this->TrimPackageFlag->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TrimPackageFlag->AdvancedSearch->SearchValue != "" || $this->TrimPackageFlag->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->TrimPackageFlag->AdvancedSearch->SearchValue))
			$this->TrimPackageFlag->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->TrimPackageFlag->AdvancedSearch->SearchValue);
		if (is_array($this->TrimPackageFlag->AdvancedSearch->SearchValue2))
			$this->TrimPackageFlag->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->TrimPackageFlag->AdvancedSearch->SearchValue2);

		// ListedFlag
		if (!$this->isAddOrEdit() && $this->ListedFlag->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ListedFlag->AdvancedSearch->SearchValue != "" || $this->ListedFlag->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->ListedFlag->AdvancedSearch->SearchValue))
			$this->ListedFlag->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ListedFlag->AdvancedSearch->SearchValue);
		if (is_array($this->ListedFlag->AdvancedSearch->SearchValue2))
			$this->ListedFlag->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ListedFlag->AdvancedSearch->SearchValue2);

		// BoxWireLength
		if (!$this->isAddOrEdit() && $this->BoxWireLength->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BoxWireLength->AdvancedSearch->SearchValue != "" || $this->BoxWireLength->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// IsFirePump
		if (!$this->isAddOrEdit() && $this->IsFirePump->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IsFirePump->AdvancedSearch->SearchValue != "" || $this->IsFirePump->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->IsFirePump->AdvancedSearch->SearchValue))
			$this->IsFirePump->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->IsFirePump->AdvancedSearch->SearchValue);
		if (is_array($this->IsFirePump->AdvancedSearch->SearchValue2))
			$this->IsFirePump->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->IsFirePump->AdvancedSearch->SearchValue2);

		// FirePumpType_Idn
		if (!$this->isAddOrEdit() && $this->FirePumpType_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->FirePumpType_Idn->AdvancedSearch->SearchValue != "" || $this->FirePumpType_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// FirePumpAttribute_Idn
		if (!$this->isAddOrEdit() && $this->FirePumpAttribute_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->FirePumpAttribute_Idn->AdvancedSearch->SearchValue != "" || $this->FirePumpAttribute_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// IsDieselFuel
		if (!$this->isAddOrEdit() && $this->IsDieselFuel->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IsDieselFuel->AdvancedSearch->SearchValue != "" || $this->IsDieselFuel->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->IsDieselFuel->AdvancedSearch->SearchValue))
			$this->IsDieselFuel->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->IsDieselFuel->AdvancedSearch->SearchValue);
		if (is_array($this->IsDieselFuel->AdvancedSearch->SearchValue2))
			$this->IsDieselFuel->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->IsDieselFuel->AdvancedSearch->SearchValue2);

		// IsSolution
		if (!$this->isAddOrEdit() && $this->IsSolution->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IsSolution->AdvancedSearch->SearchValue != "" || $this->IsSolution->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->IsSolution->AdvancedSearch->SearchValue))
			$this->IsSolution->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->IsSolution->AdvancedSearch->SearchValue);
		if (is_array($this->IsSolution->AdvancedSearch->SearchValue2))
			$this->IsSolution->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->IsSolution->AdvancedSearch->SearchValue2);

		// Position_Idn
		if (!$this->isAddOrEdit() && $this->Position_Idn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Position_Idn->AdvancedSearch->SearchValue != "" || $this->Position_Idn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'Product_Idn' first before field var 'x_Product_Idn'
		$val = $CurrentForm->hasValue("Product_Idn") ? $CurrentForm->getValue("Product_Idn") : $CurrentForm->getValue("x_Product_Idn");
		if (!$this->Product_Idn->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->Product_Idn->setFormValue($val);

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

		// Check field name 'WorksheetMaster_Idn' first before field var 'x_WorksheetMaster_Idn'
		$val = $CurrentForm->hasValue("WorksheetMaster_Idn") ? $CurrentForm->getValue("WorksheetMaster_Idn") : $CurrentForm->getValue("x_WorksheetMaster_Idn");
		if (!$this->WorksheetMaster_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->WorksheetMaster_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->WorksheetMaster_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_WorksheetMaster_Idn"))
			$this->WorksheetMaster_Idn->setOldValue($CurrentForm->getValue("o_WorksheetMaster_Idn"));

		// Check field name 'WorksheetCategory_Idn' first before field var 'x_WorksheetCategory_Idn'
		$val = $CurrentForm->hasValue("WorksheetCategory_Idn") ? $CurrentForm->getValue("WorksheetCategory_Idn") : $CurrentForm->getValue("x_WorksheetCategory_Idn");
		if (!$this->WorksheetCategory_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->WorksheetCategory_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->WorksheetCategory_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_WorksheetCategory_Idn"))
			$this->WorksheetCategory_Idn->setOldValue($CurrentForm->getValue("o_WorksheetCategory_Idn"));

		// Check field name 'Manufacturer_Idn' first before field var 'x_Manufacturer_Idn'
		$val = $CurrentForm->hasValue("Manufacturer_Idn") ? $CurrentForm->getValue("Manufacturer_Idn") : $CurrentForm->getValue("x_Manufacturer_Idn");
		if (!$this->Manufacturer_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Manufacturer_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Manufacturer_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Manufacturer_Idn"))
			$this->Manufacturer_Idn->setOldValue($CurrentForm->getValue("o_Manufacturer_Idn"));

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

		// Check field name 'MaterialUnitPrice' first before field var 'x_MaterialUnitPrice'
		$val = $CurrentForm->hasValue("MaterialUnitPrice") ? $CurrentForm->getValue("MaterialUnitPrice") : $CurrentForm->getValue("x_MaterialUnitPrice");
		if (!$this->MaterialUnitPrice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->MaterialUnitPrice->Visible = FALSE; // Disable update for API request
			else
				$this->MaterialUnitPrice->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_MaterialUnitPrice"))
			$this->MaterialUnitPrice->setOldValue($CurrentForm->getValue("o_MaterialUnitPrice"));

		// Check field name 'FieldUnitPrice' first before field var 'x_FieldUnitPrice'
		$val = $CurrentForm->hasValue("FieldUnitPrice") ? $CurrentForm->getValue("FieldUnitPrice") : $CurrentForm->getValue("x_FieldUnitPrice");
		if (!$this->FieldUnitPrice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FieldUnitPrice->Visible = FALSE; // Disable update for API request
			else
				$this->FieldUnitPrice->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_FieldUnitPrice"))
			$this->FieldUnitPrice->setOldValue($CurrentForm->getValue("o_FieldUnitPrice"));

		// Check field name 'ShopUnitPrice' first before field var 'x_ShopUnitPrice'
		$val = $CurrentForm->hasValue("ShopUnitPrice") ? $CurrentForm->getValue("ShopUnitPrice") : $CurrentForm->getValue("x_ShopUnitPrice");
		if (!$this->ShopUnitPrice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ShopUnitPrice->Visible = FALSE; // Disable update for API request
			else
				$this->ShopUnitPrice->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ShopUnitPrice"))
			$this->ShopUnitPrice->setOldValue($CurrentForm->getValue("o_ShopUnitPrice"));

		// Check field name 'EngineerUnitPrice' first before field var 'x_EngineerUnitPrice'
		$val = $CurrentForm->hasValue("EngineerUnitPrice") ? $CurrentForm->getValue("EngineerUnitPrice") : $CurrentForm->getValue("x_EngineerUnitPrice");
		if (!$this->EngineerUnitPrice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->EngineerUnitPrice->Visible = FALSE; // Disable update for API request
			else
				$this->EngineerUnitPrice->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_EngineerUnitPrice"))
			$this->EngineerUnitPrice->setOldValue($CurrentForm->getValue("o_EngineerUnitPrice"));

		// Check field name 'DefaultQuantity' first before field var 'x_DefaultQuantity'
		$val = $CurrentForm->hasValue("DefaultQuantity") ? $CurrentForm->getValue("DefaultQuantity") : $CurrentForm->getValue("x_DefaultQuantity");
		if (!$this->DefaultQuantity->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DefaultQuantity->Visible = FALSE; // Disable update for API request
			else
				$this->DefaultQuantity->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DefaultQuantity"))
			$this->DefaultQuantity->setOldValue($CurrentForm->getValue("o_DefaultQuantity"));

		// Check field name 'ProductSize_Idn' first before field var 'x_ProductSize_Idn'
		$val = $CurrentForm->hasValue("ProductSize_Idn") ? $CurrentForm->getValue("ProductSize_Idn") : $CurrentForm->getValue("x_ProductSize_Idn");
		if (!$this->ProductSize_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ProductSize_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->ProductSize_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ProductSize_Idn"))
			$this->ProductSize_Idn->setOldValue($CurrentForm->getValue("o_ProductSize_Idn"));

		// Check field name 'Description' first before field var 'x_Description'
		$val = $CurrentForm->hasValue("Description") ? $CurrentForm->getValue("Description") : $CurrentForm->getValue("x_Description");
		if (!$this->Description->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Description->Visible = FALSE; // Disable update for API request
			else
				$this->Description->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Description"))
			$this->Description->setOldValue($CurrentForm->getValue("o_Description"));

		// Check field name 'PipeType_Idn' first before field var 'x_PipeType_Idn'
		$val = $CurrentForm->hasValue("PipeType_Idn") ? $CurrentForm->getValue("PipeType_Idn") : $CurrentForm->getValue("x_PipeType_Idn");
		if (!$this->PipeType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PipeType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->PipeType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PipeType_Idn"))
			$this->PipeType_Idn->setOldValue($CurrentForm->getValue("o_PipeType_Idn"));

		// Check field name 'ScheduleType_Idn' first before field var 'x_ScheduleType_Idn'
		$val = $CurrentForm->hasValue("ScheduleType_Idn") ? $CurrentForm->getValue("ScheduleType_Idn") : $CurrentForm->getValue("x_ScheduleType_Idn");
		if (!$this->ScheduleType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ScheduleType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->ScheduleType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ScheduleType_Idn"))
			$this->ScheduleType_Idn->setOldValue($CurrentForm->getValue("o_ScheduleType_Idn"));

		// Check field name 'Fitting_Idn' first before field var 'x_Fitting_Idn'
		$val = $CurrentForm->hasValue("Fitting_Idn") ? $CurrentForm->getValue("Fitting_Idn") : $CurrentForm->getValue("x_Fitting_Idn");
		if (!$this->Fitting_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Fitting_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Fitting_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Fitting_Idn"))
			$this->Fitting_Idn->setOldValue($CurrentForm->getValue("o_Fitting_Idn"));

		// Check field name 'GroovedFittingType_Idn' first before field var 'x_GroovedFittingType_Idn'
		$val = $CurrentForm->hasValue("GroovedFittingType_Idn") ? $CurrentForm->getValue("GroovedFittingType_Idn") : $CurrentForm->getValue("x_GroovedFittingType_Idn");
		if (!$this->GroovedFittingType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->GroovedFittingType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->GroovedFittingType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_GroovedFittingType_Idn"))
			$this->GroovedFittingType_Idn->setOldValue($CurrentForm->getValue("o_GroovedFittingType_Idn"));

		// Check field name 'ThreadedFittingType_Idn' first before field var 'x_ThreadedFittingType_Idn'
		$val = $CurrentForm->hasValue("ThreadedFittingType_Idn") ? $CurrentForm->getValue("ThreadedFittingType_Idn") : $CurrentForm->getValue("x_ThreadedFittingType_Idn");
		if (!$this->ThreadedFittingType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ThreadedFittingType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->ThreadedFittingType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ThreadedFittingType_Idn"))
			$this->ThreadedFittingType_Idn->setOldValue($CurrentForm->getValue("o_ThreadedFittingType_Idn"));

		// Check field name 'HangerType_Idn' first before field var 'x_HangerType_Idn'
		$val = $CurrentForm->hasValue("HangerType_Idn") ? $CurrentForm->getValue("HangerType_Idn") : $CurrentForm->getValue("x_HangerType_Idn");
		if (!$this->HangerType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->HangerType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->HangerType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_HangerType_Idn"))
			$this->HangerType_Idn->setOldValue($CurrentForm->getValue("o_HangerType_Idn"));

		// Check field name 'HangerSubType_Idn' first before field var 'x_HangerSubType_Idn'
		$val = $CurrentForm->hasValue("HangerSubType_Idn") ? $CurrentForm->getValue("HangerSubType_Idn") : $CurrentForm->getValue("x_HangerSubType_Idn");
		if (!$this->HangerSubType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->HangerSubType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->HangerSubType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_HangerSubType_Idn"))
			$this->HangerSubType_Idn->setOldValue($CurrentForm->getValue("o_HangerSubType_Idn"));

		// Check field name 'SubcontractCategory_Idn' first before field var 'x_SubcontractCategory_Idn'
		$val = $CurrentForm->hasValue("SubcontractCategory_Idn") ? $CurrentForm->getValue("SubcontractCategory_Idn") : $CurrentForm->getValue("x_SubcontractCategory_Idn");
		if (!$this->SubcontractCategory_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->SubcontractCategory_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->SubcontractCategory_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SubcontractCategory_Idn"))
			$this->SubcontractCategory_Idn->setOldValue($CurrentForm->getValue("o_SubcontractCategory_Idn"));

		// Check field name 'ApplyToAdjustmentFactorsFlag' first before field var 'x_ApplyToAdjustmentFactorsFlag'
		$val = $CurrentForm->hasValue("ApplyToAdjustmentFactorsFlag") ? $CurrentForm->getValue("ApplyToAdjustmentFactorsFlag") : $CurrentForm->getValue("x_ApplyToAdjustmentFactorsFlag");
		if (!$this->ApplyToAdjustmentFactorsFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ApplyToAdjustmentFactorsFlag->Visible = FALSE; // Disable update for API request
			else
				$this->ApplyToAdjustmentFactorsFlag->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ApplyToAdjustmentFactorsFlag"))
			$this->ApplyToAdjustmentFactorsFlag->setOldValue($CurrentForm->getValue("o_ApplyToAdjustmentFactorsFlag"));

		// Check field name 'ApplyToContingencyFlag' first before field var 'x_ApplyToContingencyFlag'
		$val = $CurrentForm->hasValue("ApplyToContingencyFlag") ? $CurrentForm->getValue("ApplyToContingencyFlag") : $CurrentForm->getValue("x_ApplyToContingencyFlag");
		if (!$this->ApplyToContingencyFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ApplyToContingencyFlag->Visible = FALSE; // Disable update for API request
			else
				$this->ApplyToContingencyFlag->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ApplyToContingencyFlag"))
			$this->ApplyToContingencyFlag->setOldValue($CurrentForm->getValue("o_ApplyToContingencyFlag"));

		// Check field name 'IsMainComponent' first before field var 'x_IsMainComponent'
		$val = $CurrentForm->hasValue("IsMainComponent") ? $CurrentForm->getValue("IsMainComponent") : $CurrentForm->getValue("x_IsMainComponent");
		if (!$this->IsMainComponent->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsMainComponent->Visible = FALSE; // Disable update for API request
			else
				$this->IsMainComponent->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_IsMainComponent"))
			$this->IsMainComponent->setOldValue($CurrentForm->getValue("o_IsMainComponent"));

		// Check field name 'DomesticFlag' first before field var 'x_DomesticFlag'
		$val = $CurrentForm->hasValue("DomesticFlag") ? $CurrentForm->getValue("DomesticFlag") : $CurrentForm->getValue("x_DomesticFlag");
		if (!$this->DomesticFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DomesticFlag->Visible = FALSE; // Disable update for API request
			else
				$this->DomesticFlag->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DomesticFlag"))
			$this->DomesticFlag->setOldValue($CurrentForm->getValue("o_DomesticFlag"));

		// Check field name 'LoadFlag' first before field var 'x_LoadFlag'
		$val = $CurrentForm->hasValue("LoadFlag") ? $CurrentForm->getValue("LoadFlag") : $CurrentForm->getValue("x_LoadFlag");
		if (!$this->LoadFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LoadFlag->Visible = FALSE; // Disable update for API request
			else
				$this->LoadFlag->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_LoadFlag"))
			$this->LoadFlag->setOldValue($CurrentForm->getValue("o_LoadFlag"));

		// Check field name 'AutoLoadFlag' first before field var 'x_AutoLoadFlag'
		$val = $CurrentForm->hasValue("AutoLoadFlag") ? $CurrentForm->getValue("AutoLoadFlag") : $CurrentForm->getValue("x_AutoLoadFlag");
		if (!$this->AutoLoadFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->AutoLoadFlag->Visible = FALSE; // Disable update for API request
			else
				$this->AutoLoadFlag->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AutoLoadFlag"))
			$this->AutoLoadFlag->setOldValue($CurrentForm->getValue("o_AutoLoadFlag"));

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

		// Check field name 'GradeType_Idn' first before field var 'x_GradeType_Idn'
		$val = $CurrentForm->hasValue("GradeType_Idn") ? $CurrentForm->getValue("GradeType_Idn") : $CurrentForm->getValue("x_GradeType_Idn");
		if (!$this->GradeType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->GradeType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->GradeType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_GradeType_Idn"))
			$this->GradeType_Idn->setOldValue($CurrentForm->getValue("o_GradeType_Idn"));

		// Check field name 'PressureType_Idn' first before field var 'x_PressureType_Idn'
		$val = $CurrentForm->hasValue("PressureType_Idn") ? $CurrentForm->getValue("PressureType_Idn") : $CurrentForm->getValue("x_PressureType_Idn");
		if (!$this->PressureType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PressureType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->PressureType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PressureType_Idn"))
			$this->PressureType_Idn->setOldValue($CurrentForm->getValue("o_PressureType_Idn"));

		// Check field name 'SeamlessFlag' first before field var 'x_SeamlessFlag'
		$val = $CurrentForm->hasValue("SeamlessFlag") ? $CurrentForm->getValue("SeamlessFlag") : $CurrentForm->getValue("x_SeamlessFlag");
		if (!$this->SeamlessFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->SeamlessFlag->Visible = FALSE; // Disable update for API request
			else
				$this->SeamlessFlag->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SeamlessFlag"))
			$this->SeamlessFlag->setOldValue($CurrentForm->getValue("o_SeamlessFlag"));

		// Check field name 'ResponseType' first before field var 'x_ResponseType'
		$val = $CurrentForm->hasValue("ResponseType") ? $CurrentForm->getValue("ResponseType") : $CurrentForm->getValue("x_ResponseType");
		if (!$this->ResponseType->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ResponseType->Visible = FALSE; // Disable update for API request
			else
				$this->ResponseType->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ResponseType"))
			$this->ResponseType->setOldValue($CurrentForm->getValue("o_ResponseType"));

		// Check field name 'FMJobFlag' first before field var 'x_FMJobFlag'
		$val = $CurrentForm->hasValue("FMJobFlag") ? $CurrentForm->getValue("FMJobFlag") : $CurrentForm->getValue("x_FMJobFlag");
		if (!$this->FMJobFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FMJobFlag->Visible = FALSE; // Disable update for API request
			else
				$this->FMJobFlag->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_FMJobFlag"))
			$this->FMJobFlag->setOldValue($CurrentForm->getValue("o_FMJobFlag"));

		// Check field name 'RecommendedBoxes' first before field var 'x_RecommendedBoxes'
		$val = $CurrentForm->hasValue("RecommendedBoxes") ? $CurrentForm->getValue("RecommendedBoxes") : $CurrentForm->getValue("x_RecommendedBoxes");
		if (!$this->RecommendedBoxes->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RecommendedBoxes->Visible = FALSE; // Disable update for API request
			else
				$this->RecommendedBoxes->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_RecommendedBoxes"))
			$this->RecommendedBoxes->setOldValue($CurrentForm->getValue("o_RecommendedBoxes"));

		// Check field name 'RecommendedWireFootage' first before field var 'x_RecommendedWireFootage'
		$val = $CurrentForm->hasValue("RecommendedWireFootage") ? $CurrentForm->getValue("RecommendedWireFootage") : $CurrentForm->getValue("x_RecommendedWireFootage");
		if (!$this->RecommendedWireFootage->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RecommendedWireFootage->Visible = FALSE; // Disable update for API request
			else
				$this->RecommendedWireFootage->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_RecommendedWireFootage"))
			$this->RecommendedWireFootage->setOldValue($CurrentForm->getValue("o_RecommendedWireFootage"));

		// Check field name 'CoverageType_Idn' first before field var 'x_CoverageType_Idn'
		$val = $CurrentForm->hasValue("CoverageType_Idn") ? $CurrentForm->getValue("CoverageType_Idn") : $CurrentForm->getValue("x_CoverageType_Idn");
		if (!$this->CoverageType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CoverageType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->CoverageType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_CoverageType_Idn"))
			$this->CoverageType_Idn->setOldValue($CurrentForm->getValue("o_CoverageType_Idn"));

		// Check field name 'HeadType_Idn' first before field var 'x_HeadType_Idn'
		$val = $CurrentForm->hasValue("HeadType_Idn") ? $CurrentForm->getValue("HeadType_Idn") : $CurrentForm->getValue("x_HeadType_Idn");
		if (!$this->HeadType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->HeadType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->HeadType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_HeadType_Idn"))
			$this->HeadType_Idn->setOldValue($CurrentForm->getValue("o_HeadType_Idn"));

		// Check field name 'FinishType_Idn' first before field var 'x_FinishType_Idn'
		$val = $CurrentForm->hasValue("FinishType_Idn") ? $CurrentForm->getValue("FinishType_Idn") : $CurrentForm->getValue("x_FinishType_Idn");
		if (!$this->FinishType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FinishType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->FinishType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_FinishType_Idn"))
			$this->FinishType_Idn->setOldValue($CurrentForm->getValue("o_FinishType_Idn"));

		// Check field name 'Outlet_Idn' first before field var 'x_Outlet_Idn'
		$val = $CurrentForm->hasValue("Outlet_Idn") ? $CurrentForm->getValue("Outlet_Idn") : $CurrentForm->getValue("x_Outlet_Idn");
		if (!$this->Outlet_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Outlet_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Outlet_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Outlet_Idn"))
			$this->Outlet_Idn->setOldValue($CurrentForm->getValue("o_Outlet_Idn"));

		// Check field name 'RiserType_Idn' first before field var 'x_RiserType_Idn'
		$val = $CurrentForm->hasValue("RiserType_Idn") ? $CurrentForm->getValue("RiserType_Idn") : $CurrentForm->getValue("x_RiserType_Idn");
		if (!$this->RiserType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RiserType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->RiserType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_RiserType_Idn"))
			$this->RiserType_Idn->setOldValue($CurrentForm->getValue("o_RiserType_Idn"));

		// Check field name 'BackFlowType_Idn' first before field var 'x_BackFlowType_Idn'
		$val = $CurrentForm->hasValue("BackFlowType_Idn") ? $CurrentForm->getValue("BackFlowType_Idn") : $CurrentForm->getValue("x_BackFlowType_Idn");
		if (!$this->BackFlowType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->BackFlowType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->BackFlowType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BackFlowType_Idn"))
			$this->BackFlowType_Idn->setOldValue($CurrentForm->getValue("o_BackFlowType_Idn"));

		// Check field name 'ControlValve_Idn' first before field var 'x_ControlValve_Idn'
		$val = $CurrentForm->hasValue("ControlValve_Idn") ? $CurrentForm->getValue("ControlValve_Idn") : $CurrentForm->getValue("x_ControlValve_Idn");
		if (!$this->ControlValve_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ControlValve_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->ControlValve_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ControlValve_Idn"))
			$this->ControlValve_Idn->setOldValue($CurrentForm->getValue("o_ControlValve_Idn"));

		// Check field name 'CheckValve_Idn' first before field var 'x_CheckValve_Idn'
		$val = $CurrentForm->hasValue("CheckValve_Idn") ? $CurrentForm->getValue("CheckValve_Idn") : $CurrentForm->getValue("x_CheckValve_Idn");
		if (!$this->CheckValve_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CheckValve_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->CheckValve_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_CheckValve_Idn"))
			$this->CheckValve_Idn->setOldValue($CurrentForm->getValue("o_CheckValve_Idn"));

		// Check field name 'FDCType_Idn' first before field var 'x_FDCType_Idn'
		$val = $CurrentForm->hasValue("FDCType_Idn") ? $CurrentForm->getValue("FDCType_Idn") : $CurrentForm->getValue("x_FDCType_Idn");
		if (!$this->FDCType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FDCType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->FDCType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_FDCType_Idn"))
			$this->FDCType_Idn->setOldValue($CurrentForm->getValue("o_FDCType_Idn"));

		// Check field name 'BellType_Idn' first before field var 'x_BellType_Idn'
		$val = $CurrentForm->hasValue("BellType_Idn") ? $CurrentForm->getValue("BellType_Idn") : $CurrentForm->getValue("x_BellType_Idn");
		if (!$this->BellType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->BellType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->BellType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BellType_Idn"))
			$this->BellType_Idn->setOldValue($CurrentForm->getValue("o_BellType_Idn"));

		// Check field name 'TappingTee_Idn' first before field var 'x_TappingTee_Idn'
		$val = $CurrentForm->hasValue("TappingTee_Idn") ? $CurrentForm->getValue("TappingTee_Idn") : $CurrentForm->getValue("x_TappingTee_Idn");
		if (!$this->TappingTee_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->TappingTee_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->TappingTee_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_TappingTee_Idn"))
			$this->TappingTee_Idn->setOldValue($CurrentForm->getValue("o_TappingTee_Idn"));

		// Check field name 'UndergroundValve_Idn' first before field var 'x_UndergroundValve_Idn'
		$val = $CurrentForm->hasValue("UndergroundValve_Idn") ? $CurrentForm->getValue("UndergroundValve_Idn") : $CurrentForm->getValue("x_UndergroundValve_Idn");
		if (!$this->UndergroundValve_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->UndergroundValve_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->UndergroundValve_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_UndergroundValve_Idn"))
			$this->UndergroundValve_Idn->setOldValue($CurrentForm->getValue("o_UndergroundValve_Idn"));

		// Check field name 'LiftDuration_Idn' first before field var 'x_LiftDuration_Idn'
		$val = $CurrentForm->hasValue("LiftDuration_Idn") ? $CurrentForm->getValue("LiftDuration_Idn") : $CurrentForm->getValue("x_LiftDuration_Idn");
		if (!$this->LiftDuration_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LiftDuration_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->LiftDuration_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_LiftDuration_Idn"))
			$this->LiftDuration_Idn->setOldValue($CurrentForm->getValue("o_LiftDuration_Idn"));

		// Check field name 'TrimPackageFlag' first before field var 'x_TrimPackageFlag'
		$val = $CurrentForm->hasValue("TrimPackageFlag") ? $CurrentForm->getValue("TrimPackageFlag") : $CurrentForm->getValue("x_TrimPackageFlag");
		if (!$this->TrimPackageFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->TrimPackageFlag->Visible = FALSE; // Disable update for API request
			else
				$this->TrimPackageFlag->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_TrimPackageFlag"))
			$this->TrimPackageFlag->setOldValue($CurrentForm->getValue("o_TrimPackageFlag"));

		// Check field name 'ListedFlag' first before field var 'x_ListedFlag'
		$val = $CurrentForm->hasValue("ListedFlag") ? $CurrentForm->getValue("ListedFlag") : $CurrentForm->getValue("x_ListedFlag");
		if (!$this->ListedFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ListedFlag->Visible = FALSE; // Disable update for API request
			else
				$this->ListedFlag->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ListedFlag"))
			$this->ListedFlag->setOldValue($CurrentForm->getValue("o_ListedFlag"));

		// Check field name 'BoxWireLength' first before field var 'x_BoxWireLength'
		$val = $CurrentForm->hasValue("BoxWireLength") ? $CurrentForm->getValue("BoxWireLength") : $CurrentForm->getValue("x_BoxWireLength");
		if (!$this->BoxWireLength->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->BoxWireLength->Visible = FALSE; // Disable update for API request
			else
				$this->BoxWireLength->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BoxWireLength"))
			$this->BoxWireLength->setOldValue($CurrentForm->getValue("o_BoxWireLength"));

		// Check field name 'IsFirePump' first before field var 'x_IsFirePump'
		$val = $CurrentForm->hasValue("IsFirePump") ? $CurrentForm->getValue("IsFirePump") : $CurrentForm->getValue("x_IsFirePump");
		if (!$this->IsFirePump->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsFirePump->Visible = FALSE; // Disable update for API request
			else
				$this->IsFirePump->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_IsFirePump"))
			$this->IsFirePump->setOldValue($CurrentForm->getValue("o_IsFirePump"));

		// Check field name 'FirePumpType_Idn' first before field var 'x_FirePumpType_Idn'
		$val = $CurrentForm->hasValue("FirePumpType_Idn") ? $CurrentForm->getValue("FirePumpType_Idn") : $CurrentForm->getValue("x_FirePumpType_Idn");
		if (!$this->FirePumpType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FirePumpType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->FirePumpType_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_FirePumpType_Idn"))
			$this->FirePumpType_Idn->setOldValue($CurrentForm->getValue("o_FirePumpType_Idn"));

		// Check field name 'FirePumpAttribute_Idn' first before field var 'x_FirePumpAttribute_Idn'
		$val = $CurrentForm->hasValue("FirePumpAttribute_Idn") ? $CurrentForm->getValue("FirePumpAttribute_Idn") : $CurrentForm->getValue("x_FirePumpAttribute_Idn");
		if (!$this->FirePumpAttribute_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FirePumpAttribute_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->FirePumpAttribute_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_FirePumpAttribute_Idn"))
			$this->FirePumpAttribute_Idn->setOldValue($CurrentForm->getValue("o_FirePumpAttribute_Idn"));

		// Check field name 'IsDieselFuel' first before field var 'x_IsDieselFuel'
		$val = $CurrentForm->hasValue("IsDieselFuel") ? $CurrentForm->getValue("IsDieselFuel") : $CurrentForm->getValue("x_IsDieselFuel");
		if (!$this->IsDieselFuel->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsDieselFuel->Visible = FALSE; // Disable update for API request
			else
				$this->IsDieselFuel->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_IsDieselFuel"))
			$this->IsDieselFuel->setOldValue($CurrentForm->getValue("o_IsDieselFuel"));

		// Check field name 'IsSolution' first before field var 'x_IsSolution'
		$val = $CurrentForm->hasValue("IsSolution") ? $CurrentForm->getValue("IsSolution") : $CurrentForm->getValue("x_IsSolution");
		if (!$this->IsSolution->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsSolution->Visible = FALSE; // Disable update for API request
			else
				$this->IsSolution->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_IsSolution"))
			$this->IsSolution->setOldValue($CurrentForm->getValue("o_IsSolution"));

		// Check field name 'Position_Idn' first before field var 'x_Position_Idn'
		$val = $CurrentForm->hasValue("Position_Idn") ? $CurrentForm->getValue("Position_Idn") : $CurrentForm->getValue("x_Position_Idn");
		if (!$this->Position_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Position_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Position_Idn->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Position_Idn"))
			$this->Position_Idn->setOldValue($CurrentForm->getValue("o_Position_Idn"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->Product_Idn->CurrentValue = $this->Product_Idn->FormValue;
		$this->Department_Idn->CurrentValue = $this->Department_Idn->FormValue;
		$this->WorksheetMaster_Idn->CurrentValue = $this->WorksheetMaster_Idn->FormValue;
		$this->WorksheetCategory_Idn->CurrentValue = $this->WorksheetCategory_Idn->FormValue;
		$this->Manufacturer_Idn->CurrentValue = $this->Manufacturer_Idn->FormValue;
		$this->Rank->CurrentValue = $this->Rank->FormValue;
		$this->Name->CurrentValue = $this->Name->FormValue;
		$this->MaterialUnitPrice->CurrentValue = $this->MaterialUnitPrice->FormValue;
		$this->FieldUnitPrice->CurrentValue = $this->FieldUnitPrice->FormValue;
		$this->ShopUnitPrice->CurrentValue = $this->ShopUnitPrice->FormValue;
		$this->EngineerUnitPrice->CurrentValue = $this->EngineerUnitPrice->FormValue;
		$this->DefaultQuantity->CurrentValue = $this->DefaultQuantity->FormValue;
		$this->ProductSize_Idn->CurrentValue = $this->ProductSize_Idn->FormValue;
		$this->Description->CurrentValue = $this->Description->FormValue;
		$this->PipeType_Idn->CurrentValue = $this->PipeType_Idn->FormValue;
		$this->ScheduleType_Idn->CurrentValue = $this->ScheduleType_Idn->FormValue;
		$this->Fitting_Idn->CurrentValue = $this->Fitting_Idn->FormValue;
		$this->GroovedFittingType_Idn->CurrentValue = $this->GroovedFittingType_Idn->FormValue;
		$this->ThreadedFittingType_Idn->CurrentValue = $this->ThreadedFittingType_Idn->FormValue;
		$this->HangerType_Idn->CurrentValue = $this->HangerType_Idn->FormValue;
		$this->HangerSubType_Idn->CurrentValue = $this->HangerSubType_Idn->FormValue;
		$this->SubcontractCategory_Idn->CurrentValue = $this->SubcontractCategory_Idn->FormValue;
		$this->ApplyToAdjustmentFactorsFlag->CurrentValue = $this->ApplyToAdjustmentFactorsFlag->FormValue;
		$this->ApplyToContingencyFlag->CurrentValue = $this->ApplyToContingencyFlag->FormValue;
		$this->IsMainComponent->CurrentValue = $this->IsMainComponent->FormValue;
		$this->DomesticFlag->CurrentValue = $this->DomesticFlag->FormValue;
		$this->LoadFlag->CurrentValue = $this->LoadFlag->FormValue;
		$this->AutoLoadFlag->CurrentValue = $this->AutoLoadFlag->FormValue;
		$this->ActiveFlag->CurrentValue = $this->ActiveFlag->FormValue;
		$this->GradeType_Idn->CurrentValue = $this->GradeType_Idn->FormValue;
		$this->PressureType_Idn->CurrentValue = $this->PressureType_Idn->FormValue;
		$this->SeamlessFlag->CurrentValue = $this->SeamlessFlag->FormValue;
		$this->ResponseType->CurrentValue = $this->ResponseType->FormValue;
		$this->FMJobFlag->CurrentValue = $this->FMJobFlag->FormValue;
		$this->RecommendedBoxes->CurrentValue = $this->RecommendedBoxes->FormValue;
		$this->RecommendedWireFootage->CurrentValue = $this->RecommendedWireFootage->FormValue;
		$this->CoverageType_Idn->CurrentValue = $this->CoverageType_Idn->FormValue;
		$this->HeadType_Idn->CurrentValue = $this->HeadType_Idn->FormValue;
		$this->FinishType_Idn->CurrentValue = $this->FinishType_Idn->FormValue;
		$this->Outlet_Idn->CurrentValue = $this->Outlet_Idn->FormValue;
		$this->RiserType_Idn->CurrentValue = $this->RiserType_Idn->FormValue;
		$this->BackFlowType_Idn->CurrentValue = $this->BackFlowType_Idn->FormValue;
		$this->ControlValve_Idn->CurrentValue = $this->ControlValve_Idn->FormValue;
		$this->CheckValve_Idn->CurrentValue = $this->CheckValve_Idn->FormValue;
		$this->FDCType_Idn->CurrentValue = $this->FDCType_Idn->FormValue;
		$this->BellType_Idn->CurrentValue = $this->BellType_Idn->FormValue;
		$this->TappingTee_Idn->CurrentValue = $this->TappingTee_Idn->FormValue;
		$this->UndergroundValve_Idn->CurrentValue = $this->UndergroundValve_Idn->FormValue;
		$this->LiftDuration_Idn->CurrentValue = $this->LiftDuration_Idn->FormValue;
		$this->TrimPackageFlag->CurrentValue = $this->TrimPackageFlag->FormValue;
		$this->ListedFlag->CurrentValue = $this->ListedFlag->FormValue;
		$this->BoxWireLength->CurrentValue = $this->BoxWireLength->FormValue;
		$this->IsFirePump->CurrentValue = $this->IsFirePump->FormValue;
		$this->FirePumpType_Idn->CurrentValue = $this->FirePumpType_Idn->FormValue;
		$this->FirePumpAttribute_Idn->CurrentValue = $this->FirePumpAttribute_Idn->FormValue;
		$this->IsDieselFuel->CurrentValue = $this->IsDieselFuel->FormValue;
		$this->IsSolution->CurrentValue = $this->IsSolution->FormValue;
		$this->Position_Idn->CurrentValue = $this->Position_Idn->FormValue;
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
		$this->Product_Idn->setDbValue($row['Product_Idn']);
		$this->Department_Idn->setDbValue($row['Department_Idn']);
		$this->WorksheetMaster_Idn->setDbValue($row['WorksheetMaster_Idn']);
		$this->WorksheetCategory_Idn->setDbValue($row['WorksheetCategory_Idn']);
		$this->Manufacturer_Idn->setDbValue($row['Manufacturer_Idn']);
		$this->Rank->setDbValue($row['Rank']);
		$this->Name->setDbValue($row['Name']);
		$this->MaterialUnitPrice->setDbValue($row['MaterialUnitPrice']);
		$this->FieldUnitPrice->setDbValue($row['FieldUnitPrice']);
		$this->ShopUnitPrice->setDbValue($row['ShopUnitPrice']);
		$this->EngineerUnitPrice->setDbValue($row['EngineerUnitPrice']);
		$this->DefaultQuantity->setDbValue($row['DefaultQuantity']);
		$this->ProductSize_Idn->setDbValue($row['ProductSize_Idn']);
		$this->Description->setDbValue($row['Description']);
		$this->PipeType_Idn->setDbValue($row['PipeType_Idn']);
		$this->ScheduleType_Idn->setDbValue($row['ScheduleType_Idn']);
		$this->Fitting_Idn->setDbValue($row['Fitting_Idn']);
		$this->GroovedFittingType_Idn->setDbValue($row['GroovedFittingType_Idn']);
		$this->ThreadedFittingType_Idn->setDbValue($row['ThreadedFittingType_Idn']);
		$this->HangerType_Idn->setDbValue($row['HangerType_Idn']);
		$this->HangerSubType_Idn->setDbValue($row['HangerSubType_Idn']);
		$this->SubcontractCategory_Idn->setDbValue($row['SubcontractCategory_Idn']);
		$this->ApplyToAdjustmentFactorsFlag->setDbValue((ConvertToBool($row['ApplyToAdjustmentFactorsFlag']) ? "1" : "0"));
		$this->ApplyToContingencyFlag->setDbValue((ConvertToBool($row['ApplyToContingencyFlag']) ? "1" : "0"));
		$this->IsMainComponent->setDbValue((ConvertToBool($row['IsMainComponent']) ? "1" : "0"));
		$this->DomesticFlag->setDbValue((ConvertToBool($row['DomesticFlag']) ? "1" : "0"));
		$this->LoadFlag->setDbValue((ConvertToBool($row['LoadFlag']) ? "1" : "0"));
		$this->AutoLoadFlag->setDbValue((ConvertToBool($row['AutoLoadFlag']) ? "1" : "0"));
		$this->ActiveFlag->setDbValue((ConvertToBool($row['ActiveFlag']) ? "1" : "0"));
		$this->GradeType_Idn->setDbValue($row['GradeType_Idn']);
		$this->PressureType_Idn->setDbValue($row['PressureType_Idn']);
		$this->SeamlessFlag->setDbValue((ConvertToBool($row['SeamlessFlag']) ? "1" : "0"));
		$this->ResponseType->setDbValue($row['ResponseType']);
		$this->FMJobFlag->setDbValue((ConvertToBool($row['FMJobFlag']) ? "1" : "0"));
		$this->RecommendedBoxes->setDbValue($row['RecommendedBoxes']);
		$this->RecommendedWireFootage->setDbValue($row['RecommendedWireFootage']);
		$this->CoverageType_Idn->setDbValue($row['CoverageType_Idn']);
		$this->HeadType_Idn->setDbValue($row['HeadType_Idn']);
		$this->FinishType_Idn->setDbValue($row['FinishType_Idn']);
		$this->Outlet_Idn->setDbValue($row['Outlet_Idn']);
		$this->RiserType_Idn->setDbValue($row['RiserType_Idn']);
		$this->BackFlowType_Idn->setDbValue($row['BackFlowType_Idn']);
		$this->ControlValve_Idn->setDbValue($row['ControlValve_Idn']);
		$this->CheckValve_Idn->setDbValue($row['CheckValve_Idn']);
		$this->FDCType_Idn->setDbValue($row['FDCType_Idn']);
		$this->BellType_Idn->setDbValue($row['BellType_Idn']);
		$this->TappingTee_Idn->setDbValue($row['TappingTee_Idn']);
		$this->UndergroundValve_Idn->setDbValue($row['UndergroundValve_Idn']);
		$this->LiftDuration_Idn->setDbValue($row['LiftDuration_Idn']);
		$this->TrimPackageFlag->setDbValue((ConvertToBool($row['TrimPackageFlag']) ? "1" : "0"));
		$this->ListedFlag->setDbValue((ConvertToBool($row['ListedFlag']) ? "1" : "0"));
		$this->BoxWireLength->setDbValue($row['BoxWireLength']);
		$this->IsFirePump->setDbValue((ConvertToBool($row['IsFirePump']) ? "1" : "0"));
		$this->FirePumpType_Idn->setDbValue($row['FirePumpType_Idn']);
		$this->FirePumpAttribute_Idn->setDbValue($row['FirePumpAttribute_Idn']);
		$this->IsDieselFuel->setDbValue((ConvertToBool($row['IsDieselFuel']) ? "1" : "0"));
		$this->IsSolution->setDbValue((ConvertToBool($row['IsSolution']) ? "1" : "0"));
		$this->Position_Idn->setDbValue($row['Position_Idn']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['Product_Idn'] = $this->Product_Idn->CurrentValue;
		$row['Department_Idn'] = $this->Department_Idn->CurrentValue;
		$row['WorksheetMaster_Idn'] = $this->WorksheetMaster_Idn->CurrentValue;
		$row['WorksheetCategory_Idn'] = $this->WorksheetCategory_Idn->CurrentValue;
		$row['Manufacturer_Idn'] = $this->Manufacturer_Idn->CurrentValue;
		$row['Rank'] = $this->Rank->CurrentValue;
		$row['Name'] = $this->Name->CurrentValue;
		$row['MaterialUnitPrice'] = $this->MaterialUnitPrice->CurrentValue;
		$row['FieldUnitPrice'] = $this->FieldUnitPrice->CurrentValue;
		$row['ShopUnitPrice'] = $this->ShopUnitPrice->CurrentValue;
		$row['EngineerUnitPrice'] = $this->EngineerUnitPrice->CurrentValue;
		$row['DefaultQuantity'] = $this->DefaultQuantity->CurrentValue;
		$row['ProductSize_Idn'] = $this->ProductSize_Idn->CurrentValue;
		$row['Description'] = $this->Description->CurrentValue;
		$row['PipeType_Idn'] = $this->PipeType_Idn->CurrentValue;
		$row['ScheduleType_Idn'] = $this->ScheduleType_Idn->CurrentValue;
		$row['Fitting_Idn'] = $this->Fitting_Idn->CurrentValue;
		$row['GroovedFittingType_Idn'] = $this->GroovedFittingType_Idn->CurrentValue;
		$row['ThreadedFittingType_Idn'] = $this->ThreadedFittingType_Idn->CurrentValue;
		$row['HangerType_Idn'] = $this->HangerType_Idn->CurrentValue;
		$row['HangerSubType_Idn'] = $this->HangerSubType_Idn->CurrentValue;
		$row['SubcontractCategory_Idn'] = $this->SubcontractCategory_Idn->CurrentValue;
		$row['ApplyToAdjustmentFactorsFlag'] = $this->ApplyToAdjustmentFactorsFlag->CurrentValue;
		$row['ApplyToContingencyFlag'] = $this->ApplyToContingencyFlag->CurrentValue;
		$row['IsMainComponent'] = $this->IsMainComponent->CurrentValue;
		$row['DomesticFlag'] = $this->DomesticFlag->CurrentValue;
		$row['LoadFlag'] = $this->LoadFlag->CurrentValue;
		$row['AutoLoadFlag'] = $this->AutoLoadFlag->CurrentValue;
		$row['ActiveFlag'] = $this->ActiveFlag->CurrentValue;
		$row['GradeType_Idn'] = $this->GradeType_Idn->CurrentValue;
		$row['PressureType_Idn'] = $this->PressureType_Idn->CurrentValue;
		$row['SeamlessFlag'] = $this->SeamlessFlag->CurrentValue;
		$row['ResponseType'] = $this->ResponseType->CurrentValue;
		$row['FMJobFlag'] = $this->FMJobFlag->CurrentValue;
		$row['RecommendedBoxes'] = $this->RecommendedBoxes->CurrentValue;
		$row['RecommendedWireFootage'] = $this->RecommendedWireFootage->CurrentValue;
		$row['CoverageType_Idn'] = $this->CoverageType_Idn->CurrentValue;
		$row['HeadType_Idn'] = $this->HeadType_Idn->CurrentValue;
		$row['FinishType_Idn'] = $this->FinishType_Idn->CurrentValue;
		$row['Outlet_Idn'] = $this->Outlet_Idn->CurrentValue;
		$row['RiserType_Idn'] = $this->RiserType_Idn->CurrentValue;
		$row['BackFlowType_Idn'] = $this->BackFlowType_Idn->CurrentValue;
		$row['ControlValve_Idn'] = $this->ControlValve_Idn->CurrentValue;
		$row['CheckValve_Idn'] = $this->CheckValve_Idn->CurrentValue;
		$row['FDCType_Idn'] = $this->FDCType_Idn->CurrentValue;
		$row['BellType_Idn'] = $this->BellType_Idn->CurrentValue;
		$row['TappingTee_Idn'] = $this->TappingTee_Idn->CurrentValue;
		$row['UndergroundValve_Idn'] = $this->UndergroundValve_Idn->CurrentValue;
		$row['LiftDuration_Idn'] = $this->LiftDuration_Idn->CurrentValue;
		$row['TrimPackageFlag'] = $this->TrimPackageFlag->CurrentValue;
		$row['ListedFlag'] = $this->ListedFlag->CurrentValue;
		$row['BoxWireLength'] = $this->BoxWireLength->CurrentValue;
		$row['IsFirePump'] = $this->IsFirePump->CurrentValue;
		$row['FirePumpType_Idn'] = $this->FirePumpType_Idn->CurrentValue;
		$row['FirePumpAttribute_Idn'] = $this->FirePumpAttribute_Idn->CurrentValue;
		$row['IsDieselFuel'] = $this->IsDieselFuel->CurrentValue;
		$row['IsSolution'] = $this->IsSolution->CurrentValue;
		$row['Position_Idn'] = $this->Position_Idn->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("Product_Idn")) != "")
			$this->Product_Idn->OldValue = $this->getKey("Product_Idn"); // Product_Idn
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

		// Convert decimal values if posted back
		if ($this->MaterialUnitPrice->FormValue == $this->MaterialUnitPrice->CurrentValue && is_numeric(ConvertToFloatString($this->MaterialUnitPrice->CurrentValue)))
			$this->MaterialUnitPrice->CurrentValue = ConvertToFloatString($this->MaterialUnitPrice->CurrentValue);

		// Convert decimal values if posted back
		if ($this->FieldUnitPrice->FormValue == $this->FieldUnitPrice->CurrentValue && is_numeric(ConvertToFloatString($this->FieldUnitPrice->CurrentValue)))
			$this->FieldUnitPrice->CurrentValue = ConvertToFloatString($this->FieldUnitPrice->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ShopUnitPrice->FormValue == $this->ShopUnitPrice->CurrentValue && is_numeric(ConvertToFloatString($this->ShopUnitPrice->CurrentValue)))
			$this->ShopUnitPrice->CurrentValue = ConvertToFloatString($this->ShopUnitPrice->CurrentValue);

		// Convert decimal values if posted back
		if ($this->EngineerUnitPrice->FormValue == $this->EngineerUnitPrice->CurrentValue && is_numeric(ConvertToFloatString($this->EngineerUnitPrice->CurrentValue)))
			$this->EngineerUnitPrice->CurrentValue = ConvertToFloatString($this->EngineerUnitPrice->CurrentValue);

		// Convert decimal values if posted back
		if ($this->DefaultQuantity->FormValue == $this->DefaultQuantity->CurrentValue && is_numeric(ConvertToFloatString($this->DefaultQuantity->CurrentValue)))
			$this->DefaultQuantity->CurrentValue = ConvertToFloatString($this->DefaultQuantity->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Product_Idn
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

			// WorksheetMaster_Idn
			$this->WorksheetMaster_Idn->EditAttrs["class"] = "form-control";
			$this->WorksheetMaster_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->WorksheetMaster_Idn->CurrentValue));
			if ($curVal != "")
				$this->WorksheetMaster_Idn->ViewValue = $this->WorksheetMaster_Idn->lookupCacheOption($curVal);
			else
				$this->WorksheetMaster_Idn->ViewValue = $this->WorksheetMaster_Idn->Lookup !== NULL && is_array($this->WorksheetMaster_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->WorksheetMaster_Idn->ViewValue !== NULL) { // Load from cache
				$this->WorksheetMaster_Idn->EditValue = array_values($this->WorksheetMaster_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[WorksheetMaster_Idn]" . SearchString("=", $this->WorksheetMaster_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->WorksheetMaster_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->WorksheetMaster_Idn->EditValue = $arwrk;
			}

			// WorksheetCategory_Idn
			$this->WorksheetCategory_Idn->EditAttrs["class"] = "form-control";
			$this->WorksheetCategory_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->WorksheetCategory_Idn->CurrentValue));
			if ($curVal != "")
				$this->WorksheetCategory_Idn->ViewValue = $this->WorksheetCategory_Idn->lookupCacheOption($curVal);
			else
				$this->WorksheetCategory_Idn->ViewValue = $this->WorksheetCategory_Idn->Lookup !== NULL && is_array($this->WorksheetCategory_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->WorksheetCategory_Idn->ViewValue !== NULL) { // Load from cache
				$this->WorksheetCategory_Idn->EditValue = array_values($this->WorksheetCategory_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[WorksheetCategory_Idn]" . SearchString("=", $this->WorksheetCategory_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->WorksheetCategory_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->WorksheetCategory_Idn->EditValue = $arwrk;
			}

			// Manufacturer_Idn
			$this->Manufacturer_Idn->EditAttrs["class"] = "form-control";
			$this->Manufacturer_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->Manufacturer_Idn->CurrentValue));
			if ($curVal != "")
				$this->Manufacturer_Idn->ViewValue = $this->Manufacturer_Idn->lookupCacheOption($curVal);
			else
				$this->Manufacturer_Idn->ViewValue = $this->Manufacturer_Idn->Lookup !== NULL && is_array($this->Manufacturer_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Manufacturer_Idn->ViewValue !== NULL) { // Load from cache
				$this->Manufacturer_Idn->EditValue = array_values($this->Manufacturer_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[Manufacturer_Idn]" . SearchString("=", $this->Manufacturer_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Manufacturer_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Manufacturer_Idn->EditValue = $arwrk;
			}

			// Rank
			$this->Rank->EditAttrs["class"] = "form-control";
			$this->Rank->EditCustomAttributes = "";
			$this->Rank->EditValue = HtmlEncode($this->Rank->CurrentValue);
			$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

			// Name
			$this->Name->EditAttrs["class"] = "form-control";
			$this->Name->EditCustomAttributes = "";
			if (!$this->Name->Raw)
				$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
			$this->Name->EditValue = HtmlEncode($this->Name->CurrentValue);
			$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

			// MaterialUnitPrice
			$this->MaterialUnitPrice->EditAttrs["class"] = "form-control";
			$this->MaterialUnitPrice->EditCustomAttributes = "";
			$this->MaterialUnitPrice->EditValue = HtmlEncode($this->MaterialUnitPrice->CurrentValue);
			$this->MaterialUnitPrice->PlaceHolder = RemoveHtml($this->MaterialUnitPrice->caption());
			if (strval($this->MaterialUnitPrice->EditValue) != "" && is_numeric($this->MaterialUnitPrice->EditValue)) {
				$this->MaterialUnitPrice->EditValue = FormatNumber($this->MaterialUnitPrice->EditValue, -2, -2, -2, -2);
				$this->MaterialUnitPrice->OldValue = $this->MaterialUnitPrice->EditValue;
			}
			

			// FieldUnitPrice
			$this->FieldUnitPrice->EditAttrs["class"] = "form-control";
			$this->FieldUnitPrice->EditCustomAttributes = "";
			$this->FieldUnitPrice->EditValue = HtmlEncode($this->FieldUnitPrice->CurrentValue);
			$this->FieldUnitPrice->PlaceHolder = RemoveHtml($this->FieldUnitPrice->caption());
			if (strval($this->FieldUnitPrice->EditValue) != "" && is_numeric($this->FieldUnitPrice->EditValue)) {
				$this->FieldUnitPrice->EditValue = FormatNumber($this->FieldUnitPrice->EditValue, -2, -2, -2, -2);
				$this->FieldUnitPrice->OldValue = $this->FieldUnitPrice->EditValue;
			}
			

			// ShopUnitPrice
			$this->ShopUnitPrice->EditAttrs["class"] = "form-control";
			$this->ShopUnitPrice->EditCustomAttributes = "";
			$this->ShopUnitPrice->EditValue = HtmlEncode($this->ShopUnitPrice->CurrentValue);
			$this->ShopUnitPrice->PlaceHolder = RemoveHtml($this->ShopUnitPrice->caption());
			if (strval($this->ShopUnitPrice->EditValue) != "" && is_numeric($this->ShopUnitPrice->EditValue)) {
				$this->ShopUnitPrice->EditValue = FormatNumber($this->ShopUnitPrice->EditValue, -2, -2, -2, -2);
				$this->ShopUnitPrice->OldValue = $this->ShopUnitPrice->EditValue;
			}
			

			// EngineerUnitPrice
			$this->EngineerUnitPrice->EditAttrs["class"] = "form-control";
			$this->EngineerUnitPrice->EditCustomAttributes = "";
			$this->EngineerUnitPrice->EditValue = HtmlEncode($this->EngineerUnitPrice->CurrentValue);
			$this->EngineerUnitPrice->PlaceHolder = RemoveHtml($this->EngineerUnitPrice->caption());
			if (strval($this->EngineerUnitPrice->EditValue) != "" && is_numeric($this->EngineerUnitPrice->EditValue)) {
				$this->EngineerUnitPrice->EditValue = FormatNumber($this->EngineerUnitPrice->EditValue, -2, -2, -2, -2);
				$this->EngineerUnitPrice->OldValue = $this->EngineerUnitPrice->EditValue;
			}
			

			// DefaultQuantity
			$this->DefaultQuantity->EditAttrs["class"] = "form-control";
			$this->DefaultQuantity->EditCustomAttributes = "";
			$this->DefaultQuantity->EditValue = HtmlEncode($this->DefaultQuantity->CurrentValue);
			$this->DefaultQuantity->PlaceHolder = RemoveHtml($this->DefaultQuantity->caption());
			if (strval($this->DefaultQuantity->EditValue) != "" && is_numeric($this->DefaultQuantity->EditValue)) {
				$this->DefaultQuantity->EditValue = FormatNumber($this->DefaultQuantity->EditValue, -2, -2, -2, -2);
				$this->DefaultQuantity->OldValue = $this->DefaultQuantity->EditValue;
			}
			

			// ProductSize_Idn
			$this->ProductSize_Idn->EditAttrs["class"] = "form-control";
			$this->ProductSize_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProductSize_Idn->CurrentValue));
			if ($curVal != "")
				$this->ProductSize_Idn->ViewValue = $this->ProductSize_Idn->lookupCacheOption($curVal);
			else
				$this->ProductSize_Idn->ViewValue = $this->ProductSize_Idn->Lookup !== NULL && is_array($this->ProductSize_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->ProductSize_Idn->ViewValue !== NULL) { // Load from cache
				$this->ProductSize_Idn->EditValue = array_values($this->ProductSize_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[ProductSize_Idn]" . SearchString("=", $this->ProductSize_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ProductSize_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProductSize_Idn->EditValue = $arwrk;
			}

			// Description
			$this->Description->EditAttrs["class"] = "form-control";
			$this->Description->EditCustomAttributes = "";
			$this->Description->EditValue = HtmlEncode($this->Description->CurrentValue);
			$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

			// PipeType_Idn
			$this->PipeType_Idn->EditAttrs["class"] = "form-control";
			$this->PipeType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->PipeType_Idn->CurrentValue));
			if ($curVal != "")
				$this->PipeType_Idn->ViewValue = $this->PipeType_Idn->lookupCacheOption($curVal);
			else
				$this->PipeType_Idn->ViewValue = $this->PipeType_Idn->Lookup !== NULL && is_array($this->PipeType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->PipeType_Idn->ViewValue !== NULL) { // Load from cache
				$this->PipeType_Idn->EditValue = array_values($this->PipeType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[PipeType_Idn]" . SearchString("=", $this->PipeType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->PipeType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PipeType_Idn->EditValue = $arwrk;
			}

			// ScheduleType_Idn
			$this->ScheduleType_Idn->EditAttrs["class"] = "form-control";
			$this->ScheduleType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->ScheduleType_Idn->CurrentValue));
			if ($curVal != "")
				$this->ScheduleType_Idn->ViewValue = $this->ScheduleType_Idn->lookupCacheOption($curVal);
			else
				$this->ScheduleType_Idn->ViewValue = $this->ScheduleType_Idn->Lookup !== NULL && is_array($this->ScheduleType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->ScheduleType_Idn->ViewValue !== NULL) { // Load from cache
				$this->ScheduleType_Idn->EditValue = array_values($this->ScheduleType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[ScheduleType_Idn]" . SearchString("=", $this->ScheduleType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ScheduleType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ScheduleType_Idn->EditValue = $arwrk;
			}

			// Fitting_Idn
			$this->Fitting_Idn->EditAttrs["class"] = "form-control";
			$this->Fitting_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->Fitting_Idn->CurrentValue));
			if ($curVal != "")
				$this->Fitting_Idn->ViewValue = $this->Fitting_Idn->lookupCacheOption($curVal);
			else
				$this->Fitting_Idn->ViewValue = $this->Fitting_Idn->Lookup !== NULL && is_array($this->Fitting_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Fitting_Idn->ViewValue !== NULL) { // Load from cache
				$this->Fitting_Idn->EditValue = array_values($this->Fitting_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[Fitting_Idn]" . SearchString("=", $this->Fitting_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Fitting_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Fitting_Idn->EditValue = $arwrk;
			}

			// GroovedFittingType_Idn
			$this->GroovedFittingType_Idn->EditAttrs["class"] = "form-control";
			$this->GroovedFittingType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->GroovedFittingType_Idn->CurrentValue));
			if ($curVal != "")
				$this->GroovedFittingType_Idn->ViewValue = $this->GroovedFittingType_Idn->lookupCacheOption($curVal);
			else
				$this->GroovedFittingType_Idn->ViewValue = $this->GroovedFittingType_Idn->Lookup !== NULL && is_array($this->GroovedFittingType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->GroovedFittingType_Idn->ViewValue !== NULL) { // Load from cache
				$this->GroovedFittingType_Idn->EditValue = array_values($this->GroovedFittingType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[GroovedFittingType_Idn]" . SearchString("=", $this->GroovedFittingType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->GroovedFittingType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->GroovedFittingType_Idn->EditValue = $arwrk;
			}

			// ThreadedFittingType_Idn
			$this->ThreadedFittingType_Idn->EditAttrs["class"] = "form-control";
			$this->ThreadedFittingType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->ThreadedFittingType_Idn->CurrentValue));
			if ($curVal != "")
				$this->ThreadedFittingType_Idn->ViewValue = $this->ThreadedFittingType_Idn->lookupCacheOption($curVal);
			else
				$this->ThreadedFittingType_Idn->ViewValue = $this->ThreadedFittingType_Idn->Lookup !== NULL && is_array($this->ThreadedFittingType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->ThreadedFittingType_Idn->ViewValue !== NULL) { // Load from cache
				$this->ThreadedFittingType_Idn->EditValue = array_values($this->ThreadedFittingType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[ThreadedFittingType_Idn]" . SearchString("=", $this->ThreadedFittingType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ThreadedFittingType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ThreadedFittingType_Idn->EditValue = $arwrk;
			}

			// HangerType_Idn
			$this->HangerType_Idn->EditAttrs["class"] = "form-control";
			$this->HangerType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->HangerType_Idn->CurrentValue));
			if ($curVal != "")
				$this->HangerType_Idn->ViewValue = $this->HangerType_Idn->lookupCacheOption($curVal);
			else
				$this->HangerType_Idn->ViewValue = $this->HangerType_Idn->Lookup !== NULL && is_array($this->HangerType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->HangerType_Idn->ViewValue !== NULL) { // Load from cache
				$this->HangerType_Idn->EditValue = array_values($this->HangerType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[HangerType_Idn]" . SearchString("=", $this->HangerType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->HangerType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->HangerType_Idn->EditValue = $arwrk;
			}

			// HangerSubType_Idn
			$this->HangerSubType_Idn->EditAttrs["class"] = "form-control";
			$this->HangerSubType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->HangerSubType_Idn->CurrentValue));
			if ($curVal != "")
				$this->HangerSubType_Idn->ViewValue = $this->HangerSubType_Idn->lookupCacheOption($curVal);
			else
				$this->HangerSubType_Idn->ViewValue = $this->HangerSubType_Idn->Lookup !== NULL && is_array($this->HangerSubType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->HangerSubType_Idn->ViewValue !== NULL) { // Load from cache
				$this->HangerSubType_Idn->EditValue = array_values($this->HangerSubType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[HangerSubType_Idn]" . SearchString("=", $this->HangerSubType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->HangerSubType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->HangerSubType_Idn->EditValue = $arwrk;
			}

			// SubcontractCategory_Idn
			$this->SubcontractCategory_Idn->EditAttrs["class"] = "form-control";
			$this->SubcontractCategory_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->SubcontractCategory_Idn->CurrentValue));
			if ($curVal != "")
				$this->SubcontractCategory_Idn->ViewValue = $this->SubcontractCategory_Idn->lookupCacheOption($curVal);
			else
				$this->SubcontractCategory_Idn->ViewValue = $this->SubcontractCategory_Idn->Lookup !== NULL && is_array($this->SubcontractCategory_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->SubcontractCategory_Idn->ViewValue !== NULL) { // Load from cache
				$this->SubcontractCategory_Idn->EditValue = array_values($this->SubcontractCategory_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[WorksheetColumn_Idn]" . SearchString("=", $this->SubcontractCategory_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->SubcontractCategory_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SubcontractCategory_Idn->EditValue = $arwrk;
			}

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
			$curVal = trim(strval($this->GradeType_Idn->CurrentValue));
			if ($curVal != "")
				$this->GradeType_Idn->ViewValue = $this->GradeType_Idn->lookupCacheOption($curVal);
			else
				$this->GradeType_Idn->ViewValue = $this->GradeType_Idn->Lookup !== NULL && is_array($this->GradeType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->GradeType_Idn->ViewValue !== NULL) { // Load from cache
				$this->GradeType_Idn->EditValue = array_values($this->GradeType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[GradeType_Idn]" . SearchString("=", $this->GradeType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->GradeType_Idn->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->GradeType_Idn->EditValue = $arwrk;
			}

			// PressureType_Idn
			$this->PressureType_Idn->EditAttrs["class"] = "form-control";
			$this->PressureType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->PressureType_Idn->CurrentValue));
			if ($curVal != "")
				$this->PressureType_Idn->ViewValue = $this->PressureType_Idn->lookupCacheOption($curVal);
			else
				$this->PressureType_Idn->ViewValue = $this->PressureType_Idn->Lookup !== NULL && is_array($this->PressureType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->PressureType_Idn->ViewValue !== NULL) { // Load from cache
				$this->PressureType_Idn->EditValue = array_values($this->PressureType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[PressureType_Idn]" . SearchString("=", $this->PressureType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->PressureType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PressureType_Idn->EditValue = $arwrk;
			}

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
			$this->RecommendedBoxes->EditValue = HtmlEncode($this->RecommendedBoxes->CurrentValue);
			$this->RecommendedBoxes->PlaceHolder = RemoveHtml($this->RecommendedBoxes->caption());

			// RecommendedWireFootage
			$this->RecommendedWireFootage->EditAttrs["class"] = "form-control";
			$this->RecommendedWireFootage->EditCustomAttributes = "";
			$this->RecommendedWireFootage->EditValue = HtmlEncode($this->RecommendedWireFootage->CurrentValue);
			$this->RecommendedWireFootage->PlaceHolder = RemoveHtml($this->RecommendedWireFootage->caption());

			// CoverageType_Idn
			$this->CoverageType_Idn->EditAttrs["class"] = "form-control";
			$this->CoverageType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->CoverageType_Idn->CurrentValue));
			if ($curVal != "")
				$this->CoverageType_Idn->ViewValue = $this->CoverageType_Idn->lookupCacheOption($curVal);
			else
				$this->CoverageType_Idn->ViewValue = $this->CoverageType_Idn->Lookup !== NULL && is_array($this->CoverageType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->CoverageType_Idn->ViewValue !== NULL) { // Load from cache
				$this->CoverageType_Idn->EditValue = array_values($this->CoverageType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[CoverageType_Idn]" . SearchString("=", $this->CoverageType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->CoverageType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CoverageType_Idn->EditValue = $arwrk;
			}

			// HeadType_Idn
			$this->HeadType_Idn->EditAttrs["class"] = "form-control";
			$this->HeadType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->HeadType_Idn->CurrentValue));
			if ($curVal != "")
				$this->HeadType_Idn->ViewValue = $this->HeadType_Idn->lookupCacheOption($curVal);
			else
				$this->HeadType_Idn->ViewValue = $this->HeadType_Idn->Lookup !== NULL && is_array($this->HeadType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->HeadType_Idn->ViewValue !== NULL) { // Load from cache
				$this->HeadType_Idn->EditValue = array_values($this->HeadType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[HeadType_Idn]" . SearchString("=", $this->HeadType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->HeadType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->HeadType_Idn->EditValue = $arwrk;
			}

			// FinishType_Idn
			$this->FinishType_Idn->EditAttrs["class"] = "form-control";
			$this->FinishType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->FinishType_Idn->CurrentValue));
			if ($curVal != "")
				$this->FinishType_Idn->ViewValue = $this->FinishType_Idn->lookupCacheOption($curVal);
			else
				$this->FinishType_Idn->ViewValue = $this->FinishType_Idn->Lookup !== NULL && is_array($this->FinishType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->FinishType_Idn->ViewValue !== NULL) { // Load from cache
				$this->FinishType_Idn->EditValue = array_values($this->FinishType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[FinishType_Idn]" . SearchString("=", $this->FinishType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->FinishType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->FinishType_Idn->EditValue = $arwrk;
			}

			// Outlet_Idn
			$this->Outlet_Idn->EditAttrs["class"] = "form-control";
			$this->Outlet_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->Outlet_Idn->CurrentValue));
			if ($curVal != "")
				$this->Outlet_Idn->ViewValue = $this->Outlet_Idn->lookupCacheOption($curVal);
			else
				$this->Outlet_Idn->ViewValue = $this->Outlet_Idn->Lookup !== NULL && is_array($this->Outlet_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Outlet_Idn->ViewValue !== NULL) { // Load from cache
				$this->Outlet_Idn->EditValue = array_values($this->Outlet_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[Outlet_Idn]" . SearchString("=", $this->Outlet_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Outlet_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Outlet_Idn->EditValue = $arwrk;
			}

			// RiserType_Idn
			$this->RiserType_Idn->EditAttrs["class"] = "form-control";
			$this->RiserType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->RiserType_Idn->CurrentValue));
			if ($curVal != "")
				$this->RiserType_Idn->ViewValue = $this->RiserType_Idn->lookupCacheOption($curVal);
			else
				$this->RiserType_Idn->ViewValue = $this->RiserType_Idn->Lookup !== NULL && is_array($this->RiserType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->RiserType_Idn->ViewValue !== NULL) { // Load from cache
				$this->RiserType_Idn->EditValue = array_values($this->RiserType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[RiserType_Idn]" . SearchString("=", $this->RiserType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->RiserType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->RiserType_Idn->EditValue = $arwrk;
			}

			// BackFlowType_Idn
			$this->BackFlowType_Idn->EditAttrs["class"] = "form-control";
			$this->BackFlowType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->BackFlowType_Idn->CurrentValue));
			if ($curVal != "")
				$this->BackFlowType_Idn->ViewValue = $this->BackFlowType_Idn->lookupCacheOption($curVal);
			else
				$this->BackFlowType_Idn->ViewValue = $this->BackFlowType_Idn->Lookup !== NULL && is_array($this->BackFlowType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->BackFlowType_Idn->ViewValue !== NULL) { // Load from cache
				$this->BackFlowType_Idn->EditValue = array_values($this->BackFlowType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[BackflowType_Idn]" . SearchString("=", $this->BackFlowType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->BackFlowType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BackFlowType_Idn->EditValue = $arwrk;
			}

			// ControlValve_Idn
			$this->ControlValve_Idn->EditAttrs["class"] = "form-control";
			$this->ControlValve_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->ControlValve_Idn->CurrentValue));
			if ($curVal != "")
				$this->ControlValve_Idn->ViewValue = $this->ControlValve_Idn->lookupCacheOption($curVal);
			else
				$this->ControlValve_Idn->ViewValue = $this->ControlValve_Idn->Lookup !== NULL && is_array($this->ControlValve_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->ControlValve_Idn->ViewValue !== NULL) { // Load from cache
				$this->ControlValve_Idn->EditValue = array_values($this->ControlValve_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[ControlValve_Idn]" . SearchString("=", $this->ControlValve_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ControlValve_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ControlValve_Idn->EditValue = $arwrk;
			}

			// CheckValve_Idn
			$this->CheckValve_Idn->EditAttrs["class"] = "form-control";
			$this->CheckValve_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->CheckValve_Idn->CurrentValue));
			if ($curVal != "")
				$this->CheckValve_Idn->ViewValue = $this->CheckValve_Idn->lookupCacheOption($curVal);
			else
				$this->CheckValve_Idn->ViewValue = $this->CheckValve_Idn->Lookup !== NULL && is_array($this->CheckValve_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->CheckValve_Idn->ViewValue !== NULL) { // Load from cache
				$this->CheckValve_Idn->EditValue = array_values($this->CheckValve_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[CheckValve_Idn]" . SearchString("=", $this->CheckValve_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->CheckValve_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CheckValve_Idn->EditValue = $arwrk;
			}

			// FDCType_Idn
			$this->FDCType_Idn->EditAttrs["class"] = "form-control";
			$this->FDCType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->FDCType_Idn->CurrentValue));
			if ($curVal != "")
				$this->FDCType_Idn->ViewValue = $this->FDCType_Idn->lookupCacheOption($curVal);
			else
				$this->FDCType_Idn->ViewValue = $this->FDCType_Idn->Lookup !== NULL && is_array($this->FDCType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->FDCType_Idn->ViewValue !== NULL) { // Load from cache
				$this->FDCType_Idn->EditValue = array_values($this->FDCType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[FdcType_Idn]" . SearchString("=", $this->FDCType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->FDCType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->FDCType_Idn->EditValue = $arwrk;
			}

			// BellType_Idn
			$this->BellType_Idn->EditAttrs["class"] = "form-control";
			$this->BellType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->BellType_Idn->CurrentValue));
			if ($curVal != "")
				$this->BellType_Idn->ViewValue = $this->BellType_Idn->lookupCacheOption($curVal);
			else
				$this->BellType_Idn->ViewValue = $this->BellType_Idn->Lookup !== NULL && is_array($this->BellType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->BellType_Idn->ViewValue !== NULL) { // Load from cache
				$this->BellType_Idn->EditValue = array_values($this->BellType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[BellType_Idn]" . SearchString("=", $this->BellType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->BellType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BellType_Idn->EditValue = $arwrk;
			}

			// TappingTee_Idn
			$this->TappingTee_Idn->EditAttrs["class"] = "form-control";
			$this->TappingTee_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->TappingTee_Idn->CurrentValue));
			if ($curVal != "")
				$this->TappingTee_Idn->ViewValue = $this->TappingTee_Idn->lookupCacheOption($curVal);
			else
				$this->TappingTee_Idn->ViewValue = $this->TappingTee_Idn->Lookup !== NULL && is_array($this->TappingTee_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->TappingTee_Idn->ViewValue !== NULL) { // Load from cache
				$this->TappingTee_Idn->EditValue = array_values($this->TappingTee_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[TappingTee_Idn]" . SearchString("=", $this->TappingTee_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->TappingTee_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->TappingTee_Idn->EditValue = $arwrk;
			}

			// UndergroundValve_Idn
			$this->UndergroundValve_Idn->EditAttrs["class"] = "form-control";
			$this->UndergroundValve_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->UndergroundValve_Idn->CurrentValue));
			if ($curVal != "")
				$this->UndergroundValve_Idn->ViewValue = $this->UndergroundValve_Idn->lookupCacheOption($curVal);
			else
				$this->UndergroundValve_Idn->ViewValue = $this->UndergroundValve_Idn->Lookup !== NULL && is_array($this->UndergroundValve_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->UndergroundValve_Idn->ViewValue !== NULL) { // Load from cache
				$this->UndergroundValve_Idn->EditValue = array_values($this->UndergroundValve_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[UndergroundValve_Idn]" . SearchString("=", $this->UndergroundValve_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->UndergroundValve_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->UndergroundValve_Idn->EditValue = $arwrk;
			}

			// LiftDuration_Idn
			$this->LiftDuration_Idn->EditAttrs["class"] = "form-control";
			$this->LiftDuration_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->LiftDuration_Idn->CurrentValue));
			if ($curVal != "")
				$this->LiftDuration_Idn->ViewValue = $this->LiftDuration_Idn->lookupCacheOption($curVal);
			else
				$this->LiftDuration_Idn->ViewValue = $this->LiftDuration_Idn->Lookup !== NULL && is_array($this->LiftDuration_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->LiftDuration_Idn->ViewValue !== NULL) { // Load from cache
				$this->LiftDuration_Idn->EditValue = array_values($this->LiftDuration_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[LiftDuration_Idn]" . SearchString("=", $this->LiftDuration_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->LiftDuration_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LiftDuration_Idn->EditValue = $arwrk;
			}

			// TrimPackageFlag
			$this->TrimPackageFlag->EditCustomAttributes = "";
			$this->TrimPackageFlag->EditValue = $this->TrimPackageFlag->options(FALSE);

			// ListedFlag
			$this->ListedFlag->EditCustomAttributes = "";
			$this->ListedFlag->EditValue = $this->ListedFlag->options(FALSE);

			// BoxWireLength
			$this->BoxWireLength->EditAttrs["class"] = "form-control";
			$this->BoxWireLength->EditCustomAttributes = "";
			$this->BoxWireLength->EditValue = HtmlEncode($this->BoxWireLength->CurrentValue);
			$this->BoxWireLength->PlaceHolder = RemoveHtml($this->BoxWireLength->caption());

			// IsFirePump
			$this->IsFirePump->EditCustomAttributes = "";
			$this->IsFirePump->EditValue = $this->IsFirePump->options(FALSE);

			// FirePumpType_Idn
			$this->FirePumpType_Idn->EditAttrs["class"] = "form-control";
			$this->FirePumpType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->FirePumpType_Idn->CurrentValue));
			if ($curVal != "")
				$this->FirePumpType_Idn->ViewValue = $this->FirePumpType_Idn->lookupCacheOption($curVal);
			else
				$this->FirePumpType_Idn->ViewValue = $this->FirePumpType_Idn->Lookup !== NULL && is_array($this->FirePumpType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->FirePumpType_Idn->ViewValue !== NULL) { // Load from cache
				$this->FirePumpType_Idn->EditValue = array_values($this->FirePumpType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[FirePumpAttribute_Idn]" . SearchString("=", $this->FirePumpType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->FirePumpType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->FirePumpType_Idn->EditValue = $arwrk;
			}

			// FirePumpAttribute_Idn
			$this->FirePumpAttribute_Idn->EditAttrs["class"] = "form-control";
			$this->FirePumpAttribute_Idn->EditCustomAttributes = "";
			$this->FirePumpAttribute_Idn->EditValue = HtmlEncode($this->FirePumpAttribute_Idn->CurrentValue);
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
			$curVal = trim(strval($this->Position_Idn->CurrentValue));
			if ($curVal != "")
				$this->Position_Idn->ViewValue = $this->Position_Idn->lookupCacheOption($curVal);
			else
				$this->Position_Idn->ViewValue = $this->Position_Idn->Lookup !== NULL && is_array($this->Position_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Position_Idn->ViewValue !== NULL) { // Load from cache
				$this->Position_Idn->EditValue = array_values($this->Position_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[Position_Idn]" . SearchString("=", $this->Position_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Position_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Position_Idn->EditValue = $arwrk;
			}

			// Add refer script
			// Product_Idn

			$this->Product_Idn->LinkCustomAttributes = "";
			$this->Product_Idn->HrefValue = "";

			// Department_Idn
			$this->Department_Idn->LinkCustomAttributes = "";
			$this->Department_Idn->HrefValue = "";

			// WorksheetMaster_Idn
			$this->WorksheetMaster_Idn->LinkCustomAttributes = "";
			$this->WorksheetMaster_Idn->HrefValue = "";

			// WorksheetCategory_Idn
			$this->WorksheetCategory_Idn->LinkCustomAttributes = "";
			$this->WorksheetCategory_Idn->HrefValue = "";

			// Manufacturer_Idn
			$this->Manufacturer_Idn->LinkCustomAttributes = "";
			$this->Manufacturer_Idn->HrefValue = "";

			// Rank
			$this->Rank->LinkCustomAttributes = "";
			$this->Rank->HrefValue = "";

			// Name
			$this->Name->LinkCustomAttributes = "";
			$this->Name->HrefValue = "";

			// MaterialUnitPrice
			$this->MaterialUnitPrice->LinkCustomAttributes = "";
			$this->MaterialUnitPrice->HrefValue = "";

			// FieldUnitPrice
			$this->FieldUnitPrice->LinkCustomAttributes = "";
			$this->FieldUnitPrice->HrefValue = "";

			// ShopUnitPrice
			$this->ShopUnitPrice->LinkCustomAttributes = "";
			$this->ShopUnitPrice->HrefValue = "";

			// EngineerUnitPrice
			$this->EngineerUnitPrice->LinkCustomAttributes = "";
			$this->EngineerUnitPrice->HrefValue = "";

			// DefaultQuantity
			$this->DefaultQuantity->LinkCustomAttributes = "";
			$this->DefaultQuantity->HrefValue = "";

			// ProductSize_Idn
			$this->ProductSize_Idn->LinkCustomAttributes = "";
			$this->ProductSize_Idn->HrefValue = "";

			// Description
			$this->Description->LinkCustomAttributes = "";
			$this->Description->HrefValue = "";

			// PipeType_Idn
			$this->PipeType_Idn->LinkCustomAttributes = "";
			$this->PipeType_Idn->HrefValue = "";

			// ScheduleType_Idn
			$this->ScheduleType_Idn->LinkCustomAttributes = "";
			$this->ScheduleType_Idn->HrefValue = "";

			// Fitting_Idn
			$this->Fitting_Idn->LinkCustomAttributes = "";
			$this->Fitting_Idn->HrefValue = "";

			// GroovedFittingType_Idn
			$this->GroovedFittingType_Idn->LinkCustomAttributes = "";
			$this->GroovedFittingType_Idn->HrefValue = "";

			// ThreadedFittingType_Idn
			$this->ThreadedFittingType_Idn->LinkCustomAttributes = "";
			$this->ThreadedFittingType_Idn->HrefValue = "";

			// HangerType_Idn
			$this->HangerType_Idn->LinkCustomAttributes = "";
			$this->HangerType_Idn->HrefValue = "";

			// HangerSubType_Idn
			$this->HangerSubType_Idn->LinkCustomAttributes = "";
			$this->HangerSubType_Idn->HrefValue = "";

			// SubcontractCategory_Idn
			$this->SubcontractCategory_Idn->LinkCustomAttributes = "";
			$this->SubcontractCategory_Idn->HrefValue = "";

			// ApplyToAdjustmentFactorsFlag
			$this->ApplyToAdjustmentFactorsFlag->LinkCustomAttributes = "";
			$this->ApplyToAdjustmentFactorsFlag->HrefValue = "";

			// ApplyToContingencyFlag
			$this->ApplyToContingencyFlag->LinkCustomAttributes = "";
			$this->ApplyToContingencyFlag->HrefValue = "";

			// IsMainComponent
			$this->IsMainComponent->LinkCustomAttributes = "";
			$this->IsMainComponent->HrefValue = "";

			// DomesticFlag
			$this->DomesticFlag->LinkCustomAttributes = "";
			$this->DomesticFlag->HrefValue = "";

			// LoadFlag
			$this->LoadFlag->LinkCustomAttributes = "";
			$this->LoadFlag->HrefValue = "";

			// AutoLoadFlag
			$this->AutoLoadFlag->LinkCustomAttributes = "";
			$this->AutoLoadFlag->HrefValue = "";

			// ActiveFlag
			$this->ActiveFlag->LinkCustomAttributes = "";
			$this->ActiveFlag->HrefValue = "";

			// GradeType_Idn
			$this->GradeType_Idn->LinkCustomAttributes = "";
			$this->GradeType_Idn->HrefValue = "";

			// PressureType_Idn
			$this->PressureType_Idn->LinkCustomAttributes = "";
			$this->PressureType_Idn->HrefValue = "";

			// SeamlessFlag
			$this->SeamlessFlag->LinkCustomAttributes = "";
			$this->SeamlessFlag->HrefValue = "";

			// ResponseType
			$this->ResponseType->LinkCustomAttributes = "";
			$this->ResponseType->HrefValue = "";

			// FMJobFlag
			$this->FMJobFlag->LinkCustomAttributes = "";
			$this->FMJobFlag->HrefValue = "";

			// RecommendedBoxes
			$this->RecommendedBoxes->LinkCustomAttributes = "";
			$this->RecommendedBoxes->HrefValue = "";

			// RecommendedWireFootage
			$this->RecommendedWireFootage->LinkCustomAttributes = "";
			$this->RecommendedWireFootage->HrefValue = "";

			// CoverageType_Idn
			$this->CoverageType_Idn->LinkCustomAttributes = "";
			$this->CoverageType_Idn->HrefValue = "";

			// HeadType_Idn
			$this->HeadType_Idn->LinkCustomAttributes = "";
			$this->HeadType_Idn->HrefValue = "";

			// FinishType_Idn
			$this->FinishType_Idn->LinkCustomAttributes = "";
			$this->FinishType_Idn->HrefValue = "";

			// Outlet_Idn
			$this->Outlet_Idn->LinkCustomAttributes = "";
			$this->Outlet_Idn->HrefValue = "";

			// RiserType_Idn
			$this->RiserType_Idn->LinkCustomAttributes = "";
			$this->RiserType_Idn->HrefValue = "";

			// BackFlowType_Idn
			$this->BackFlowType_Idn->LinkCustomAttributes = "";
			$this->BackFlowType_Idn->HrefValue = "";

			// ControlValve_Idn
			$this->ControlValve_Idn->LinkCustomAttributes = "";
			$this->ControlValve_Idn->HrefValue = "";

			// CheckValve_Idn
			$this->CheckValve_Idn->LinkCustomAttributes = "";
			$this->CheckValve_Idn->HrefValue = "";

			// FDCType_Idn
			$this->FDCType_Idn->LinkCustomAttributes = "";
			$this->FDCType_Idn->HrefValue = "";

			// BellType_Idn
			$this->BellType_Idn->LinkCustomAttributes = "";
			$this->BellType_Idn->HrefValue = "";

			// TappingTee_Idn
			$this->TappingTee_Idn->LinkCustomAttributes = "";
			$this->TappingTee_Idn->HrefValue = "";

			// UndergroundValve_Idn
			$this->UndergroundValve_Idn->LinkCustomAttributes = "";
			$this->UndergroundValve_Idn->HrefValue = "";

			// LiftDuration_Idn
			$this->LiftDuration_Idn->LinkCustomAttributes = "";
			$this->LiftDuration_Idn->HrefValue = "";

			// TrimPackageFlag
			$this->TrimPackageFlag->LinkCustomAttributes = "";
			$this->TrimPackageFlag->HrefValue = "";

			// ListedFlag
			$this->ListedFlag->LinkCustomAttributes = "";
			$this->ListedFlag->HrefValue = "";

			// BoxWireLength
			$this->BoxWireLength->LinkCustomAttributes = "";
			$this->BoxWireLength->HrefValue = "";

			// IsFirePump
			$this->IsFirePump->LinkCustomAttributes = "";
			$this->IsFirePump->HrefValue = "";

			// FirePumpType_Idn
			$this->FirePumpType_Idn->LinkCustomAttributes = "";
			$this->FirePumpType_Idn->HrefValue = "";

			// FirePumpAttribute_Idn
			$this->FirePumpAttribute_Idn->LinkCustomAttributes = "";
			$this->FirePumpAttribute_Idn->HrefValue = "";

			// IsDieselFuel
			$this->IsDieselFuel->LinkCustomAttributes = "";
			$this->IsDieselFuel->HrefValue = "";

			// IsSolution
			$this->IsSolution->LinkCustomAttributes = "";
			$this->IsSolution->HrefValue = "";

			// Position_Idn
			$this->Position_Idn->LinkCustomAttributes = "";
			$this->Position_Idn->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// Product_Idn
			$this->Product_Idn->EditAttrs["class"] = "form-control";
			$this->Product_Idn->EditCustomAttributes = "";
			$this->Product_Idn->EditValue = $this->Product_Idn->CurrentValue;
			$this->Product_Idn->ViewCustomAttributes = "";

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

			// WorksheetMaster_Idn
			$this->WorksheetMaster_Idn->EditAttrs["class"] = "form-control";
			$this->WorksheetMaster_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->WorksheetMaster_Idn->CurrentValue));
			if ($curVal != "")
				$this->WorksheetMaster_Idn->ViewValue = $this->WorksheetMaster_Idn->lookupCacheOption($curVal);
			else
				$this->WorksheetMaster_Idn->ViewValue = $this->WorksheetMaster_Idn->Lookup !== NULL && is_array($this->WorksheetMaster_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->WorksheetMaster_Idn->ViewValue !== NULL) { // Load from cache
				$this->WorksheetMaster_Idn->EditValue = array_values($this->WorksheetMaster_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[WorksheetMaster_Idn]" . SearchString("=", $this->WorksheetMaster_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->WorksheetMaster_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->WorksheetMaster_Idn->EditValue = $arwrk;
			}

			// WorksheetCategory_Idn
			$this->WorksheetCategory_Idn->EditAttrs["class"] = "form-control";
			$this->WorksheetCategory_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->WorksheetCategory_Idn->CurrentValue));
			if ($curVal != "")
				$this->WorksheetCategory_Idn->ViewValue = $this->WorksheetCategory_Idn->lookupCacheOption($curVal);
			else
				$this->WorksheetCategory_Idn->ViewValue = $this->WorksheetCategory_Idn->Lookup !== NULL && is_array($this->WorksheetCategory_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->WorksheetCategory_Idn->ViewValue !== NULL) { // Load from cache
				$this->WorksheetCategory_Idn->EditValue = array_values($this->WorksheetCategory_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[WorksheetCategory_Idn]" . SearchString("=", $this->WorksheetCategory_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->WorksheetCategory_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->WorksheetCategory_Idn->EditValue = $arwrk;
			}

			// Manufacturer_Idn
			$this->Manufacturer_Idn->EditAttrs["class"] = "form-control";
			$this->Manufacturer_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->Manufacturer_Idn->CurrentValue));
			if ($curVal != "")
				$this->Manufacturer_Idn->ViewValue = $this->Manufacturer_Idn->lookupCacheOption($curVal);
			else
				$this->Manufacturer_Idn->ViewValue = $this->Manufacturer_Idn->Lookup !== NULL && is_array($this->Manufacturer_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Manufacturer_Idn->ViewValue !== NULL) { // Load from cache
				$this->Manufacturer_Idn->EditValue = array_values($this->Manufacturer_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[Manufacturer_Idn]" . SearchString("=", $this->Manufacturer_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Manufacturer_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Manufacturer_Idn->EditValue = $arwrk;
			}

			// Rank
			$this->Rank->EditAttrs["class"] = "form-control";
			$this->Rank->EditCustomAttributes = "";
			$this->Rank->EditValue = HtmlEncode($this->Rank->CurrentValue);
			$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

			// Name
			$this->Name->EditAttrs["class"] = "form-control";
			$this->Name->EditCustomAttributes = "";
			if (!$this->Name->Raw)
				$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
			$this->Name->EditValue = HtmlEncode($this->Name->CurrentValue);
			$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

			// MaterialUnitPrice
			$this->MaterialUnitPrice->EditAttrs["class"] = "form-control";
			$this->MaterialUnitPrice->EditCustomAttributes = "";
			$this->MaterialUnitPrice->EditValue = HtmlEncode($this->MaterialUnitPrice->CurrentValue);
			$this->MaterialUnitPrice->PlaceHolder = RemoveHtml($this->MaterialUnitPrice->caption());
			if (strval($this->MaterialUnitPrice->EditValue) != "" && is_numeric($this->MaterialUnitPrice->EditValue)) {
				$this->MaterialUnitPrice->EditValue = FormatNumber($this->MaterialUnitPrice->EditValue, -2, -2, -2, -2);
				$this->MaterialUnitPrice->OldValue = $this->MaterialUnitPrice->EditValue;
			}
			

			// FieldUnitPrice
			$this->FieldUnitPrice->EditAttrs["class"] = "form-control";
			$this->FieldUnitPrice->EditCustomAttributes = "";
			$this->FieldUnitPrice->EditValue = HtmlEncode($this->FieldUnitPrice->CurrentValue);
			$this->FieldUnitPrice->PlaceHolder = RemoveHtml($this->FieldUnitPrice->caption());
			if (strval($this->FieldUnitPrice->EditValue) != "" && is_numeric($this->FieldUnitPrice->EditValue)) {
				$this->FieldUnitPrice->EditValue = FormatNumber($this->FieldUnitPrice->EditValue, -2, -2, -2, -2);
				$this->FieldUnitPrice->OldValue = $this->FieldUnitPrice->EditValue;
			}
			

			// ShopUnitPrice
			$this->ShopUnitPrice->EditAttrs["class"] = "form-control";
			$this->ShopUnitPrice->EditCustomAttributes = "";
			$this->ShopUnitPrice->EditValue = HtmlEncode($this->ShopUnitPrice->CurrentValue);
			$this->ShopUnitPrice->PlaceHolder = RemoveHtml($this->ShopUnitPrice->caption());
			if (strval($this->ShopUnitPrice->EditValue) != "" && is_numeric($this->ShopUnitPrice->EditValue)) {
				$this->ShopUnitPrice->EditValue = FormatNumber($this->ShopUnitPrice->EditValue, -2, -2, -2, -2);
				$this->ShopUnitPrice->OldValue = $this->ShopUnitPrice->EditValue;
			}
			

			// EngineerUnitPrice
			$this->EngineerUnitPrice->EditAttrs["class"] = "form-control";
			$this->EngineerUnitPrice->EditCustomAttributes = "";
			$this->EngineerUnitPrice->EditValue = HtmlEncode($this->EngineerUnitPrice->CurrentValue);
			$this->EngineerUnitPrice->PlaceHolder = RemoveHtml($this->EngineerUnitPrice->caption());
			if (strval($this->EngineerUnitPrice->EditValue) != "" && is_numeric($this->EngineerUnitPrice->EditValue)) {
				$this->EngineerUnitPrice->EditValue = FormatNumber($this->EngineerUnitPrice->EditValue, -2, -2, -2, -2);
				$this->EngineerUnitPrice->OldValue = $this->EngineerUnitPrice->EditValue;
			}
			

			// DefaultQuantity
			$this->DefaultQuantity->EditAttrs["class"] = "form-control";
			$this->DefaultQuantity->EditCustomAttributes = "";
			$this->DefaultQuantity->EditValue = HtmlEncode($this->DefaultQuantity->CurrentValue);
			$this->DefaultQuantity->PlaceHolder = RemoveHtml($this->DefaultQuantity->caption());
			if (strval($this->DefaultQuantity->EditValue) != "" && is_numeric($this->DefaultQuantity->EditValue)) {
				$this->DefaultQuantity->EditValue = FormatNumber($this->DefaultQuantity->EditValue, -2, -2, -2, -2);
				$this->DefaultQuantity->OldValue = $this->DefaultQuantity->EditValue;
			}
			

			// ProductSize_Idn
			$this->ProductSize_Idn->EditAttrs["class"] = "form-control";
			$this->ProductSize_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProductSize_Idn->CurrentValue));
			if ($curVal != "")
				$this->ProductSize_Idn->ViewValue = $this->ProductSize_Idn->lookupCacheOption($curVal);
			else
				$this->ProductSize_Idn->ViewValue = $this->ProductSize_Idn->Lookup !== NULL && is_array($this->ProductSize_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->ProductSize_Idn->ViewValue !== NULL) { // Load from cache
				$this->ProductSize_Idn->EditValue = array_values($this->ProductSize_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[ProductSize_Idn]" . SearchString("=", $this->ProductSize_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ProductSize_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProductSize_Idn->EditValue = $arwrk;
			}

			// Description
			$this->Description->EditAttrs["class"] = "form-control";
			$this->Description->EditCustomAttributes = "";
			$this->Description->EditValue = HtmlEncode($this->Description->CurrentValue);
			$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

			// PipeType_Idn
			$this->PipeType_Idn->EditAttrs["class"] = "form-control";
			$this->PipeType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->PipeType_Idn->CurrentValue));
			if ($curVal != "")
				$this->PipeType_Idn->ViewValue = $this->PipeType_Idn->lookupCacheOption($curVal);
			else
				$this->PipeType_Idn->ViewValue = $this->PipeType_Idn->Lookup !== NULL && is_array($this->PipeType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->PipeType_Idn->ViewValue !== NULL) { // Load from cache
				$this->PipeType_Idn->EditValue = array_values($this->PipeType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[PipeType_Idn]" . SearchString("=", $this->PipeType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->PipeType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PipeType_Idn->EditValue = $arwrk;
			}

			// ScheduleType_Idn
			$this->ScheduleType_Idn->EditAttrs["class"] = "form-control";
			$this->ScheduleType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->ScheduleType_Idn->CurrentValue));
			if ($curVal != "")
				$this->ScheduleType_Idn->ViewValue = $this->ScheduleType_Idn->lookupCacheOption($curVal);
			else
				$this->ScheduleType_Idn->ViewValue = $this->ScheduleType_Idn->Lookup !== NULL && is_array($this->ScheduleType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->ScheduleType_Idn->ViewValue !== NULL) { // Load from cache
				$this->ScheduleType_Idn->EditValue = array_values($this->ScheduleType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[ScheduleType_Idn]" . SearchString("=", $this->ScheduleType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ScheduleType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ScheduleType_Idn->EditValue = $arwrk;
			}

			// Fitting_Idn
			$this->Fitting_Idn->EditAttrs["class"] = "form-control";
			$this->Fitting_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->Fitting_Idn->CurrentValue));
			if ($curVal != "")
				$this->Fitting_Idn->ViewValue = $this->Fitting_Idn->lookupCacheOption($curVal);
			else
				$this->Fitting_Idn->ViewValue = $this->Fitting_Idn->Lookup !== NULL && is_array($this->Fitting_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Fitting_Idn->ViewValue !== NULL) { // Load from cache
				$this->Fitting_Idn->EditValue = array_values($this->Fitting_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[Fitting_Idn]" . SearchString("=", $this->Fitting_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Fitting_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Fitting_Idn->EditValue = $arwrk;
			}

			// GroovedFittingType_Idn
			$this->GroovedFittingType_Idn->EditAttrs["class"] = "form-control";
			$this->GroovedFittingType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->GroovedFittingType_Idn->CurrentValue));
			if ($curVal != "")
				$this->GroovedFittingType_Idn->ViewValue = $this->GroovedFittingType_Idn->lookupCacheOption($curVal);
			else
				$this->GroovedFittingType_Idn->ViewValue = $this->GroovedFittingType_Idn->Lookup !== NULL && is_array($this->GroovedFittingType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->GroovedFittingType_Idn->ViewValue !== NULL) { // Load from cache
				$this->GroovedFittingType_Idn->EditValue = array_values($this->GroovedFittingType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[GroovedFittingType_Idn]" . SearchString("=", $this->GroovedFittingType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->GroovedFittingType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->GroovedFittingType_Idn->EditValue = $arwrk;
			}

			// ThreadedFittingType_Idn
			$this->ThreadedFittingType_Idn->EditAttrs["class"] = "form-control";
			$this->ThreadedFittingType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->ThreadedFittingType_Idn->CurrentValue));
			if ($curVal != "")
				$this->ThreadedFittingType_Idn->ViewValue = $this->ThreadedFittingType_Idn->lookupCacheOption($curVal);
			else
				$this->ThreadedFittingType_Idn->ViewValue = $this->ThreadedFittingType_Idn->Lookup !== NULL && is_array($this->ThreadedFittingType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->ThreadedFittingType_Idn->ViewValue !== NULL) { // Load from cache
				$this->ThreadedFittingType_Idn->EditValue = array_values($this->ThreadedFittingType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[ThreadedFittingType_Idn]" . SearchString("=", $this->ThreadedFittingType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ThreadedFittingType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ThreadedFittingType_Idn->EditValue = $arwrk;
			}

			// HangerType_Idn
			$this->HangerType_Idn->EditAttrs["class"] = "form-control";
			$this->HangerType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->HangerType_Idn->CurrentValue));
			if ($curVal != "")
				$this->HangerType_Idn->ViewValue = $this->HangerType_Idn->lookupCacheOption($curVal);
			else
				$this->HangerType_Idn->ViewValue = $this->HangerType_Idn->Lookup !== NULL && is_array($this->HangerType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->HangerType_Idn->ViewValue !== NULL) { // Load from cache
				$this->HangerType_Idn->EditValue = array_values($this->HangerType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[HangerType_Idn]" . SearchString("=", $this->HangerType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->HangerType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->HangerType_Idn->EditValue = $arwrk;
			}

			// HangerSubType_Idn
			$this->HangerSubType_Idn->EditAttrs["class"] = "form-control";
			$this->HangerSubType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->HangerSubType_Idn->CurrentValue));
			if ($curVal != "")
				$this->HangerSubType_Idn->ViewValue = $this->HangerSubType_Idn->lookupCacheOption($curVal);
			else
				$this->HangerSubType_Idn->ViewValue = $this->HangerSubType_Idn->Lookup !== NULL && is_array($this->HangerSubType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->HangerSubType_Idn->ViewValue !== NULL) { // Load from cache
				$this->HangerSubType_Idn->EditValue = array_values($this->HangerSubType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[HangerSubType_Idn]" . SearchString("=", $this->HangerSubType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->HangerSubType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->HangerSubType_Idn->EditValue = $arwrk;
			}

			// SubcontractCategory_Idn
			$this->SubcontractCategory_Idn->EditAttrs["class"] = "form-control";
			$this->SubcontractCategory_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->SubcontractCategory_Idn->CurrentValue));
			if ($curVal != "")
				$this->SubcontractCategory_Idn->ViewValue = $this->SubcontractCategory_Idn->lookupCacheOption($curVal);
			else
				$this->SubcontractCategory_Idn->ViewValue = $this->SubcontractCategory_Idn->Lookup !== NULL && is_array($this->SubcontractCategory_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->SubcontractCategory_Idn->ViewValue !== NULL) { // Load from cache
				$this->SubcontractCategory_Idn->EditValue = array_values($this->SubcontractCategory_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[WorksheetColumn_Idn]" . SearchString("=", $this->SubcontractCategory_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->SubcontractCategory_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SubcontractCategory_Idn->EditValue = $arwrk;
			}

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
			$curVal = trim(strval($this->GradeType_Idn->CurrentValue));
			if ($curVal != "")
				$this->GradeType_Idn->ViewValue = $this->GradeType_Idn->lookupCacheOption($curVal);
			else
				$this->GradeType_Idn->ViewValue = $this->GradeType_Idn->Lookup !== NULL && is_array($this->GradeType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->GradeType_Idn->ViewValue !== NULL) { // Load from cache
				$this->GradeType_Idn->EditValue = array_values($this->GradeType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[GradeType_Idn]" . SearchString("=", $this->GradeType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->GradeType_Idn->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->GradeType_Idn->EditValue = $arwrk;
			}

			// PressureType_Idn
			$this->PressureType_Idn->EditAttrs["class"] = "form-control";
			$this->PressureType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->PressureType_Idn->CurrentValue));
			if ($curVal != "")
				$this->PressureType_Idn->ViewValue = $this->PressureType_Idn->lookupCacheOption($curVal);
			else
				$this->PressureType_Idn->ViewValue = $this->PressureType_Idn->Lookup !== NULL && is_array($this->PressureType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->PressureType_Idn->ViewValue !== NULL) { // Load from cache
				$this->PressureType_Idn->EditValue = array_values($this->PressureType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[PressureType_Idn]" . SearchString("=", $this->PressureType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->PressureType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PressureType_Idn->EditValue = $arwrk;
			}

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
			$this->RecommendedBoxes->EditValue = HtmlEncode($this->RecommendedBoxes->CurrentValue);
			$this->RecommendedBoxes->PlaceHolder = RemoveHtml($this->RecommendedBoxes->caption());

			// RecommendedWireFootage
			$this->RecommendedWireFootage->EditAttrs["class"] = "form-control";
			$this->RecommendedWireFootage->EditCustomAttributes = "";
			$this->RecommendedWireFootage->EditValue = HtmlEncode($this->RecommendedWireFootage->CurrentValue);
			$this->RecommendedWireFootage->PlaceHolder = RemoveHtml($this->RecommendedWireFootage->caption());

			// CoverageType_Idn
			$this->CoverageType_Idn->EditAttrs["class"] = "form-control";
			$this->CoverageType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->CoverageType_Idn->CurrentValue));
			if ($curVal != "")
				$this->CoverageType_Idn->ViewValue = $this->CoverageType_Idn->lookupCacheOption($curVal);
			else
				$this->CoverageType_Idn->ViewValue = $this->CoverageType_Idn->Lookup !== NULL && is_array($this->CoverageType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->CoverageType_Idn->ViewValue !== NULL) { // Load from cache
				$this->CoverageType_Idn->EditValue = array_values($this->CoverageType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[CoverageType_Idn]" . SearchString("=", $this->CoverageType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->CoverageType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CoverageType_Idn->EditValue = $arwrk;
			}

			// HeadType_Idn
			$this->HeadType_Idn->EditAttrs["class"] = "form-control";
			$this->HeadType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->HeadType_Idn->CurrentValue));
			if ($curVal != "")
				$this->HeadType_Idn->ViewValue = $this->HeadType_Idn->lookupCacheOption($curVal);
			else
				$this->HeadType_Idn->ViewValue = $this->HeadType_Idn->Lookup !== NULL && is_array($this->HeadType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->HeadType_Idn->ViewValue !== NULL) { // Load from cache
				$this->HeadType_Idn->EditValue = array_values($this->HeadType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[HeadType_Idn]" . SearchString("=", $this->HeadType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->HeadType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->HeadType_Idn->EditValue = $arwrk;
			}

			// FinishType_Idn
			$this->FinishType_Idn->EditAttrs["class"] = "form-control";
			$this->FinishType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->FinishType_Idn->CurrentValue));
			if ($curVal != "")
				$this->FinishType_Idn->ViewValue = $this->FinishType_Idn->lookupCacheOption($curVal);
			else
				$this->FinishType_Idn->ViewValue = $this->FinishType_Idn->Lookup !== NULL && is_array($this->FinishType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->FinishType_Idn->ViewValue !== NULL) { // Load from cache
				$this->FinishType_Idn->EditValue = array_values($this->FinishType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[FinishType_Idn]" . SearchString("=", $this->FinishType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->FinishType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->FinishType_Idn->EditValue = $arwrk;
			}

			// Outlet_Idn
			$this->Outlet_Idn->EditAttrs["class"] = "form-control";
			$this->Outlet_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->Outlet_Idn->CurrentValue));
			if ($curVal != "")
				$this->Outlet_Idn->ViewValue = $this->Outlet_Idn->lookupCacheOption($curVal);
			else
				$this->Outlet_Idn->ViewValue = $this->Outlet_Idn->Lookup !== NULL && is_array($this->Outlet_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Outlet_Idn->ViewValue !== NULL) { // Load from cache
				$this->Outlet_Idn->EditValue = array_values($this->Outlet_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[Outlet_Idn]" . SearchString("=", $this->Outlet_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Outlet_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Outlet_Idn->EditValue = $arwrk;
			}

			// RiserType_Idn
			$this->RiserType_Idn->EditAttrs["class"] = "form-control";
			$this->RiserType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->RiserType_Idn->CurrentValue));
			if ($curVal != "")
				$this->RiserType_Idn->ViewValue = $this->RiserType_Idn->lookupCacheOption($curVal);
			else
				$this->RiserType_Idn->ViewValue = $this->RiserType_Idn->Lookup !== NULL && is_array($this->RiserType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->RiserType_Idn->ViewValue !== NULL) { // Load from cache
				$this->RiserType_Idn->EditValue = array_values($this->RiserType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[RiserType_Idn]" . SearchString("=", $this->RiserType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->RiserType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->RiserType_Idn->EditValue = $arwrk;
			}

			// BackFlowType_Idn
			$this->BackFlowType_Idn->EditAttrs["class"] = "form-control";
			$this->BackFlowType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->BackFlowType_Idn->CurrentValue));
			if ($curVal != "")
				$this->BackFlowType_Idn->ViewValue = $this->BackFlowType_Idn->lookupCacheOption($curVal);
			else
				$this->BackFlowType_Idn->ViewValue = $this->BackFlowType_Idn->Lookup !== NULL && is_array($this->BackFlowType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->BackFlowType_Idn->ViewValue !== NULL) { // Load from cache
				$this->BackFlowType_Idn->EditValue = array_values($this->BackFlowType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[BackflowType_Idn]" . SearchString("=", $this->BackFlowType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->BackFlowType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BackFlowType_Idn->EditValue = $arwrk;
			}

			// ControlValve_Idn
			$this->ControlValve_Idn->EditAttrs["class"] = "form-control";
			$this->ControlValve_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->ControlValve_Idn->CurrentValue));
			if ($curVal != "")
				$this->ControlValve_Idn->ViewValue = $this->ControlValve_Idn->lookupCacheOption($curVal);
			else
				$this->ControlValve_Idn->ViewValue = $this->ControlValve_Idn->Lookup !== NULL && is_array($this->ControlValve_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->ControlValve_Idn->ViewValue !== NULL) { // Load from cache
				$this->ControlValve_Idn->EditValue = array_values($this->ControlValve_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[ControlValve_Idn]" . SearchString("=", $this->ControlValve_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ControlValve_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ControlValve_Idn->EditValue = $arwrk;
			}

			// CheckValve_Idn
			$this->CheckValve_Idn->EditAttrs["class"] = "form-control";
			$this->CheckValve_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->CheckValve_Idn->CurrentValue));
			if ($curVal != "")
				$this->CheckValve_Idn->ViewValue = $this->CheckValve_Idn->lookupCacheOption($curVal);
			else
				$this->CheckValve_Idn->ViewValue = $this->CheckValve_Idn->Lookup !== NULL && is_array($this->CheckValve_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->CheckValve_Idn->ViewValue !== NULL) { // Load from cache
				$this->CheckValve_Idn->EditValue = array_values($this->CheckValve_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[CheckValve_Idn]" . SearchString("=", $this->CheckValve_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->CheckValve_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CheckValve_Idn->EditValue = $arwrk;
			}

			// FDCType_Idn
			$this->FDCType_Idn->EditAttrs["class"] = "form-control";
			$this->FDCType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->FDCType_Idn->CurrentValue));
			if ($curVal != "")
				$this->FDCType_Idn->ViewValue = $this->FDCType_Idn->lookupCacheOption($curVal);
			else
				$this->FDCType_Idn->ViewValue = $this->FDCType_Idn->Lookup !== NULL && is_array($this->FDCType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->FDCType_Idn->ViewValue !== NULL) { // Load from cache
				$this->FDCType_Idn->EditValue = array_values($this->FDCType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[FdcType_Idn]" . SearchString("=", $this->FDCType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->FDCType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->FDCType_Idn->EditValue = $arwrk;
			}

			// BellType_Idn
			$this->BellType_Idn->EditAttrs["class"] = "form-control";
			$this->BellType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->BellType_Idn->CurrentValue));
			if ($curVal != "")
				$this->BellType_Idn->ViewValue = $this->BellType_Idn->lookupCacheOption($curVal);
			else
				$this->BellType_Idn->ViewValue = $this->BellType_Idn->Lookup !== NULL && is_array($this->BellType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->BellType_Idn->ViewValue !== NULL) { // Load from cache
				$this->BellType_Idn->EditValue = array_values($this->BellType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[BellType_Idn]" . SearchString("=", $this->BellType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->BellType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BellType_Idn->EditValue = $arwrk;
			}

			// TappingTee_Idn
			$this->TappingTee_Idn->EditAttrs["class"] = "form-control";
			$this->TappingTee_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->TappingTee_Idn->CurrentValue));
			if ($curVal != "")
				$this->TappingTee_Idn->ViewValue = $this->TappingTee_Idn->lookupCacheOption($curVal);
			else
				$this->TappingTee_Idn->ViewValue = $this->TappingTee_Idn->Lookup !== NULL && is_array($this->TappingTee_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->TappingTee_Idn->ViewValue !== NULL) { // Load from cache
				$this->TappingTee_Idn->EditValue = array_values($this->TappingTee_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[TappingTee_Idn]" . SearchString("=", $this->TappingTee_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->TappingTee_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->TappingTee_Idn->EditValue = $arwrk;
			}

			// UndergroundValve_Idn
			$this->UndergroundValve_Idn->EditAttrs["class"] = "form-control";
			$this->UndergroundValve_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->UndergroundValve_Idn->CurrentValue));
			if ($curVal != "")
				$this->UndergroundValve_Idn->ViewValue = $this->UndergroundValve_Idn->lookupCacheOption($curVal);
			else
				$this->UndergroundValve_Idn->ViewValue = $this->UndergroundValve_Idn->Lookup !== NULL && is_array($this->UndergroundValve_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->UndergroundValve_Idn->ViewValue !== NULL) { // Load from cache
				$this->UndergroundValve_Idn->EditValue = array_values($this->UndergroundValve_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[UndergroundValve_Idn]" . SearchString("=", $this->UndergroundValve_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->UndergroundValve_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->UndergroundValve_Idn->EditValue = $arwrk;
			}

			// LiftDuration_Idn
			$this->LiftDuration_Idn->EditAttrs["class"] = "form-control";
			$this->LiftDuration_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->LiftDuration_Idn->CurrentValue));
			if ($curVal != "")
				$this->LiftDuration_Idn->ViewValue = $this->LiftDuration_Idn->lookupCacheOption($curVal);
			else
				$this->LiftDuration_Idn->ViewValue = $this->LiftDuration_Idn->Lookup !== NULL && is_array($this->LiftDuration_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->LiftDuration_Idn->ViewValue !== NULL) { // Load from cache
				$this->LiftDuration_Idn->EditValue = array_values($this->LiftDuration_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[LiftDuration_Idn]" . SearchString("=", $this->LiftDuration_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->LiftDuration_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LiftDuration_Idn->EditValue = $arwrk;
			}

			// TrimPackageFlag
			$this->TrimPackageFlag->EditCustomAttributes = "";
			$this->TrimPackageFlag->EditValue = $this->TrimPackageFlag->options(FALSE);

			// ListedFlag
			$this->ListedFlag->EditCustomAttributes = "";
			$this->ListedFlag->EditValue = $this->ListedFlag->options(FALSE);

			// BoxWireLength
			$this->BoxWireLength->EditAttrs["class"] = "form-control";
			$this->BoxWireLength->EditCustomAttributes = "";
			$this->BoxWireLength->EditValue = HtmlEncode($this->BoxWireLength->CurrentValue);
			$this->BoxWireLength->PlaceHolder = RemoveHtml($this->BoxWireLength->caption());

			// IsFirePump
			$this->IsFirePump->EditCustomAttributes = "";
			$this->IsFirePump->EditValue = $this->IsFirePump->options(FALSE);

			// FirePumpType_Idn
			$this->FirePumpType_Idn->EditAttrs["class"] = "form-control";
			$this->FirePumpType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->FirePumpType_Idn->CurrentValue));
			if ($curVal != "")
				$this->FirePumpType_Idn->ViewValue = $this->FirePumpType_Idn->lookupCacheOption($curVal);
			else
				$this->FirePumpType_Idn->ViewValue = $this->FirePumpType_Idn->Lookup !== NULL && is_array($this->FirePumpType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->FirePumpType_Idn->ViewValue !== NULL) { // Load from cache
				$this->FirePumpType_Idn->EditValue = array_values($this->FirePumpType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[FirePumpAttribute_Idn]" . SearchString("=", $this->FirePumpType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->FirePumpType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->FirePumpType_Idn->EditValue = $arwrk;
			}

			// FirePumpAttribute_Idn
			$this->FirePumpAttribute_Idn->EditAttrs["class"] = "form-control";
			$this->FirePumpAttribute_Idn->EditCustomAttributes = "";
			$this->FirePumpAttribute_Idn->EditValue = HtmlEncode($this->FirePumpAttribute_Idn->CurrentValue);
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
			$curVal = trim(strval($this->Position_Idn->CurrentValue));
			if ($curVal != "")
				$this->Position_Idn->ViewValue = $this->Position_Idn->lookupCacheOption($curVal);
			else
				$this->Position_Idn->ViewValue = $this->Position_Idn->Lookup !== NULL && is_array($this->Position_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Position_Idn->ViewValue !== NULL) { // Load from cache
				$this->Position_Idn->EditValue = array_values($this->Position_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[Position_Idn]" . SearchString("=", $this->Position_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Position_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Position_Idn->EditValue = $arwrk;
			}

			// Edit refer script
			// Product_Idn

			$this->Product_Idn->LinkCustomAttributes = "";
			$this->Product_Idn->HrefValue = "";

			// Department_Idn
			$this->Department_Idn->LinkCustomAttributes = "";
			$this->Department_Idn->HrefValue = "";

			// WorksheetMaster_Idn
			$this->WorksheetMaster_Idn->LinkCustomAttributes = "";
			$this->WorksheetMaster_Idn->HrefValue = "";

			// WorksheetCategory_Idn
			$this->WorksheetCategory_Idn->LinkCustomAttributes = "";
			$this->WorksheetCategory_Idn->HrefValue = "";

			// Manufacturer_Idn
			$this->Manufacturer_Idn->LinkCustomAttributes = "";
			$this->Manufacturer_Idn->HrefValue = "";

			// Rank
			$this->Rank->LinkCustomAttributes = "";
			$this->Rank->HrefValue = "";

			// Name
			$this->Name->LinkCustomAttributes = "";
			$this->Name->HrefValue = "";

			// MaterialUnitPrice
			$this->MaterialUnitPrice->LinkCustomAttributes = "";
			$this->MaterialUnitPrice->HrefValue = "";

			// FieldUnitPrice
			$this->FieldUnitPrice->LinkCustomAttributes = "";
			$this->FieldUnitPrice->HrefValue = "";

			// ShopUnitPrice
			$this->ShopUnitPrice->LinkCustomAttributes = "";
			$this->ShopUnitPrice->HrefValue = "";

			// EngineerUnitPrice
			$this->EngineerUnitPrice->LinkCustomAttributes = "";
			$this->EngineerUnitPrice->HrefValue = "";

			// DefaultQuantity
			$this->DefaultQuantity->LinkCustomAttributes = "";
			$this->DefaultQuantity->HrefValue = "";

			// ProductSize_Idn
			$this->ProductSize_Idn->LinkCustomAttributes = "";
			$this->ProductSize_Idn->HrefValue = "";

			// Description
			$this->Description->LinkCustomAttributes = "";
			$this->Description->HrefValue = "";

			// PipeType_Idn
			$this->PipeType_Idn->LinkCustomAttributes = "";
			$this->PipeType_Idn->HrefValue = "";

			// ScheduleType_Idn
			$this->ScheduleType_Idn->LinkCustomAttributes = "";
			$this->ScheduleType_Idn->HrefValue = "";

			// Fitting_Idn
			$this->Fitting_Idn->LinkCustomAttributes = "";
			$this->Fitting_Idn->HrefValue = "";

			// GroovedFittingType_Idn
			$this->GroovedFittingType_Idn->LinkCustomAttributes = "";
			$this->GroovedFittingType_Idn->HrefValue = "";

			// ThreadedFittingType_Idn
			$this->ThreadedFittingType_Idn->LinkCustomAttributes = "";
			$this->ThreadedFittingType_Idn->HrefValue = "";

			// HangerType_Idn
			$this->HangerType_Idn->LinkCustomAttributes = "";
			$this->HangerType_Idn->HrefValue = "";

			// HangerSubType_Idn
			$this->HangerSubType_Idn->LinkCustomAttributes = "";
			$this->HangerSubType_Idn->HrefValue = "";

			// SubcontractCategory_Idn
			$this->SubcontractCategory_Idn->LinkCustomAttributes = "";
			$this->SubcontractCategory_Idn->HrefValue = "";

			// ApplyToAdjustmentFactorsFlag
			$this->ApplyToAdjustmentFactorsFlag->LinkCustomAttributes = "";
			$this->ApplyToAdjustmentFactorsFlag->HrefValue = "";

			// ApplyToContingencyFlag
			$this->ApplyToContingencyFlag->LinkCustomAttributes = "";
			$this->ApplyToContingencyFlag->HrefValue = "";

			// IsMainComponent
			$this->IsMainComponent->LinkCustomAttributes = "";
			$this->IsMainComponent->HrefValue = "";

			// DomesticFlag
			$this->DomesticFlag->LinkCustomAttributes = "";
			$this->DomesticFlag->HrefValue = "";

			// LoadFlag
			$this->LoadFlag->LinkCustomAttributes = "";
			$this->LoadFlag->HrefValue = "";

			// AutoLoadFlag
			$this->AutoLoadFlag->LinkCustomAttributes = "";
			$this->AutoLoadFlag->HrefValue = "";

			// ActiveFlag
			$this->ActiveFlag->LinkCustomAttributes = "";
			$this->ActiveFlag->HrefValue = "";

			// GradeType_Idn
			$this->GradeType_Idn->LinkCustomAttributes = "";
			$this->GradeType_Idn->HrefValue = "";

			// PressureType_Idn
			$this->PressureType_Idn->LinkCustomAttributes = "";
			$this->PressureType_Idn->HrefValue = "";

			// SeamlessFlag
			$this->SeamlessFlag->LinkCustomAttributes = "";
			$this->SeamlessFlag->HrefValue = "";

			// ResponseType
			$this->ResponseType->LinkCustomAttributes = "";
			$this->ResponseType->HrefValue = "";

			// FMJobFlag
			$this->FMJobFlag->LinkCustomAttributes = "";
			$this->FMJobFlag->HrefValue = "";

			// RecommendedBoxes
			$this->RecommendedBoxes->LinkCustomAttributes = "";
			$this->RecommendedBoxes->HrefValue = "";

			// RecommendedWireFootage
			$this->RecommendedWireFootage->LinkCustomAttributes = "";
			$this->RecommendedWireFootage->HrefValue = "";

			// CoverageType_Idn
			$this->CoverageType_Idn->LinkCustomAttributes = "";
			$this->CoverageType_Idn->HrefValue = "";

			// HeadType_Idn
			$this->HeadType_Idn->LinkCustomAttributes = "";
			$this->HeadType_Idn->HrefValue = "";

			// FinishType_Idn
			$this->FinishType_Idn->LinkCustomAttributes = "";
			$this->FinishType_Idn->HrefValue = "";

			// Outlet_Idn
			$this->Outlet_Idn->LinkCustomAttributes = "";
			$this->Outlet_Idn->HrefValue = "";

			// RiserType_Idn
			$this->RiserType_Idn->LinkCustomAttributes = "";
			$this->RiserType_Idn->HrefValue = "";

			// BackFlowType_Idn
			$this->BackFlowType_Idn->LinkCustomAttributes = "";
			$this->BackFlowType_Idn->HrefValue = "";

			// ControlValve_Idn
			$this->ControlValve_Idn->LinkCustomAttributes = "";
			$this->ControlValve_Idn->HrefValue = "";

			// CheckValve_Idn
			$this->CheckValve_Idn->LinkCustomAttributes = "";
			$this->CheckValve_Idn->HrefValue = "";

			// FDCType_Idn
			$this->FDCType_Idn->LinkCustomAttributes = "";
			$this->FDCType_Idn->HrefValue = "";

			// BellType_Idn
			$this->BellType_Idn->LinkCustomAttributes = "";
			$this->BellType_Idn->HrefValue = "";

			// TappingTee_Idn
			$this->TappingTee_Idn->LinkCustomAttributes = "";
			$this->TappingTee_Idn->HrefValue = "";

			// UndergroundValve_Idn
			$this->UndergroundValve_Idn->LinkCustomAttributes = "";
			$this->UndergroundValve_Idn->HrefValue = "";

			// LiftDuration_Idn
			$this->LiftDuration_Idn->LinkCustomAttributes = "";
			$this->LiftDuration_Idn->HrefValue = "";

			// TrimPackageFlag
			$this->TrimPackageFlag->LinkCustomAttributes = "";
			$this->TrimPackageFlag->HrefValue = "";

			// ListedFlag
			$this->ListedFlag->LinkCustomAttributes = "";
			$this->ListedFlag->HrefValue = "";

			// BoxWireLength
			$this->BoxWireLength->LinkCustomAttributes = "";
			$this->BoxWireLength->HrefValue = "";

			// IsFirePump
			$this->IsFirePump->LinkCustomAttributes = "";
			$this->IsFirePump->HrefValue = "";

			// FirePumpType_Idn
			$this->FirePumpType_Idn->LinkCustomAttributes = "";
			$this->FirePumpType_Idn->HrefValue = "";

			// FirePumpAttribute_Idn
			$this->FirePumpAttribute_Idn->LinkCustomAttributes = "";
			$this->FirePumpAttribute_Idn->HrefValue = "";

			// IsDieselFuel
			$this->IsDieselFuel->LinkCustomAttributes = "";
			$this->IsDieselFuel->HrefValue = "";

			// IsSolution
			$this->IsSolution->LinkCustomAttributes = "";
			$this->IsSolution->HrefValue = "";

			// Position_Idn
			$this->Position_Idn->LinkCustomAttributes = "";
			$this->Position_Idn->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// Product_Idn
			$this->Product_Idn->EditAttrs["class"] = "form-control";
			$this->Product_Idn->EditCustomAttributes = "";
			$this->Product_Idn->EditValue = HtmlEncode($this->Product_Idn->AdvancedSearch->SearchValue);
			$this->Product_Idn->PlaceHolder = RemoveHtml($this->Product_Idn->caption());

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

			// WorksheetMaster_Idn
			$this->WorksheetMaster_Idn->EditAttrs["class"] = "form-control";
			$this->WorksheetMaster_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->WorksheetMaster_Idn->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->WorksheetMaster_Idn->AdvancedSearch->ViewValue = $this->WorksheetMaster_Idn->lookupCacheOption($curVal);
			else
				$this->WorksheetMaster_Idn->AdvancedSearch->ViewValue = $this->WorksheetMaster_Idn->Lookup !== NULL && is_array($this->WorksheetMaster_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->WorksheetMaster_Idn->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->WorksheetMaster_Idn->EditValue = array_values($this->WorksheetMaster_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[WorksheetMaster_Idn]" . SearchString("=", $this->WorksheetMaster_Idn->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->WorksheetMaster_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->WorksheetMaster_Idn->EditValue = $arwrk;
			}

			// WorksheetCategory_Idn
			$this->WorksheetCategory_Idn->EditAttrs["class"] = "form-control";
			$this->WorksheetCategory_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->WorksheetCategory_Idn->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->WorksheetCategory_Idn->AdvancedSearch->ViewValue = $this->WorksheetCategory_Idn->lookupCacheOption($curVal);
			else
				$this->WorksheetCategory_Idn->AdvancedSearch->ViewValue = $this->WorksheetCategory_Idn->Lookup !== NULL && is_array($this->WorksheetCategory_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->WorksheetCategory_Idn->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->WorksheetCategory_Idn->EditValue = array_values($this->WorksheetCategory_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[WorksheetCategory_Idn]" . SearchString("=", $this->WorksheetCategory_Idn->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->WorksheetCategory_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->WorksheetCategory_Idn->EditValue = $arwrk;
			}

			// Manufacturer_Idn
			$this->Manufacturer_Idn->EditAttrs["class"] = "form-control";
			$this->Manufacturer_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->Manufacturer_Idn->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Manufacturer_Idn->AdvancedSearch->ViewValue = $this->Manufacturer_Idn->lookupCacheOption($curVal);
			else
				$this->Manufacturer_Idn->AdvancedSearch->ViewValue = $this->Manufacturer_Idn->Lookup !== NULL && is_array($this->Manufacturer_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Manufacturer_Idn->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Manufacturer_Idn->EditValue = array_values($this->Manufacturer_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[Manufacturer_Idn]" . SearchString("=", $this->Manufacturer_Idn->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Manufacturer_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Manufacturer_Idn->EditValue = $arwrk;
			}

			// Rank
			$this->Rank->EditAttrs["class"] = "form-control";
			$this->Rank->EditCustomAttributes = "";
			$this->Rank->EditValue = HtmlEncode($this->Rank->AdvancedSearch->SearchValue);
			$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

			// Name
			$this->Name->EditAttrs["class"] = "form-control";
			$this->Name->EditCustomAttributes = "";
			if (!$this->Name->Raw)
				$this->Name->AdvancedSearch->SearchValue = HtmlDecode($this->Name->AdvancedSearch->SearchValue);
			$this->Name->EditValue = HtmlEncode($this->Name->AdvancedSearch->SearchValue);
			$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

			// MaterialUnitPrice
			$this->MaterialUnitPrice->EditAttrs["class"] = "form-control";
			$this->MaterialUnitPrice->EditCustomAttributes = "";
			$this->MaterialUnitPrice->EditValue = HtmlEncode($this->MaterialUnitPrice->AdvancedSearch->SearchValue);
			$this->MaterialUnitPrice->PlaceHolder = RemoveHtml($this->MaterialUnitPrice->caption());

			// FieldUnitPrice
			$this->FieldUnitPrice->EditAttrs["class"] = "form-control";
			$this->FieldUnitPrice->EditCustomAttributes = "";
			$this->FieldUnitPrice->EditValue = HtmlEncode($this->FieldUnitPrice->AdvancedSearch->SearchValue);
			$this->FieldUnitPrice->PlaceHolder = RemoveHtml($this->FieldUnitPrice->caption());

			// ShopUnitPrice
			$this->ShopUnitPrice->EditAttrs["class"] = "form-control";
			$this->ShopUnitPrice->EditCustomAttributes = "";
			$this->ShopUnitPrice->EditValue = HtmlEncode($this->ShopUnitPrice->AdvancedSearch->SearchValue);
			$this->ShopUnitPrice->PlaceHolder = RemoveHtml($this->ShopUnitPrice->caption());

			// EngineerUnitPrice
			$this->EngineerUnitPrice->EditAttrs["class"] = "form-control";
			$this->EngineerUnitPrice->EditCustomAttributes = "";
			$this->EngineerUnitPrice->EditValue = HtmlEncode($this->EngineerUnitPrice->AdvancedSearch->SearchValue);
			$this->EngineerUnitPrice->PlaceHolder = RemoveHtml($this->EngineerUnitPrice->caption());

			// DefaultQuantity
			$this->DefaultQuantity->EditAttrs["class"] = "form-control";
			$this->DefaultQuantity->EditCustomAttributes = "";
			$this->DefaultQuantity->EditValue = HtmlEncode($this->DefaultQuantity->AdvancedSearch->SearchValue);
			$this->DefaultQuantity->PlaceHolder = RemoveHtml($this->DefaultQuantity->caption());

			// ProductSize_Idn
			$this->ProductSize_Idn->EditAttrs["class"] = "form-control";
			$this->ProductSize_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProductSize_Idn->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ProductSize_Idn->AdvancedSearch->ViewValue = $this->ProductSize_Idn->lookupCacheOption($curVal);
			else
				$this->ProductSize_Idn->AdvancedSearch->ViewValue = $this->ProductSize_Idn->Lookup !== NULL && is_array($this->ProductSize_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->ProductSize_Idn->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ProductSize_Idn->EditValue = array_values($this->ProductSize_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[ProductSize_Idn]" . SearchString("=", $this->ProductSize_Idn->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ProductSize_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProductSize_Idn->EditValue = $arwrk;
			}

			// Description
			$this->Description->EditAttrs["class"] = "form-control";
			$this->Description->EditCustomAttributes = "";
			$this->Description->EditValue = HtmlEncode($this->Description->AdvancedSearch->SearchValue);
			$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

			// PipeType_Idn
			$this->PipeType_Idn->EditAttrs["class"] = "form-control";
			$this->PipeType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->PipeType_Idn->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PipeType_Idn->AdvancedSearch->ViewValue = $this->PipeType_Idn->lookupCacheOption($curVal);
			else
				$this->PipeType_Idn->AdvancedSearch->ViewValue = $this->PipeType_Idn->Lookup !== NULL && is_array($this->PipeType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->PipeType_Idn->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PipeType_Idn->EditValue = array_values($this->PipeType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[PipeType_Idn]" . SearchString("=", $this->PipeType_Idn->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->PipeType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PipeType_Idn->EditValue = $arwrk;
			}

			// ScheduleType_Idn
			$this->ScheduleType_Idn->EditAttrs["class"] = "form-control";
			$this->ScheduleType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->ScheduleType_Idn->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ScheduleType_Idn->AdvancedSearch->ViewValue = $this->ScheduleType_Idn->lookupCacheOption($curVal);
			else
				$this->ScheduleType_Idn->AdvancedSearch->ViewValue = $this->ScheduleType_Idn->Lookup !== NULL && is_array($this->ScheduleType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->ScheduleType_Idn->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ScheduleType_Idn->EditValue = array_values($this->ScheduleType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[ScheduleType_Idn]" . SearchString("=", $this->ScheduleType_Idn->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ScheduleType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ScheduleType_Idn->EditValue = $arwrk;
			}

			// Fitting_Idn
			$this->Fitting_Idn->EditAttrs["class"] = "form-control";
			$this->Fitting_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->Fitting_Idn->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Fitting_Idn->AdvancedSearch->ViewValue = $this->Fitting_Idn->lookupCacheOption($curVal);
			else
				$this->Fitting_Idn->AdvancedSearch->ViewValue = $this->Fitting_Idn->Lookup !== NULL && is_array($this->Fitting_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->Fitting_Idn->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Fitting_Idn->EditValue = array_values($this->Fitting_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[Fitting_Idn]" . SearchString("=", $this->Fitting_Idn->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->Fitting_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Fitting_Idn->EditValue = $arwrk;
			}

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
			$this->RecommendedBoxes->EditValue = HtmlEncode($this->RecommendedBoxes->AdvancedSearch->SearchValue);
			$this->RecommendedBoxes->PlaceHolder = RemoveHtml($this->RecommendedBoxes->caption());

			// RecommendedWireFootage
			$this->RecommendedWireFootage->EditAttrs["class"] = "form-control";
			$this->RecommendedWireFootage->EditCustomAttributes = "";
			$this->RecommendedWireFootage->EditValue = HtmlEncode($this->RecommendedWireFootage->AdvancedSearch->SearchValue);
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
			$this->BoxWireLength->EditValue = HtmlEncode($this->BoxWireLength->AdvancedSearch->SearchValue);
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
			$this->FirePumpAttribute_Idn->EditValue = HtmlEncode($this->FirePumpAttribute_Idn->AdvancedSearch->SearchValue);
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
		if ($this->Product_Idn->Required) {
			if (!$this->Product_Idn->IsDetailKey && $this->Product_Idn->FormValue != NULL && $this->Product_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Product_Idn->caption(), $this->Product_Idn->RequiredErrorMessage));
			}
		}
		if ($this->Department_Idn->Required) {
			if (!$this->Department_Idn->IsDetailKey && $this->Department_Idn->FormValue != NULL && $this->Department_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Department_Idn->caption(), $this->Department_Idn->RequiredErrorMessage));
			}
		}
		if ($this->WorksheetMaster_Idn->Required) {
			if (!$this->WorksheetMaster_Idn->IsDetailKey && $this->WorksheetMaster_Idn->FormValue != NULL && $this->WorksheetMaster_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->WorksheetMaster_Idn->caption(), $this->WorksheetMaster_Idn->RequiredErrorMessage));
			}
		}
		if ($this->WorksheetCategory_Idn->Required) {
			if (!$this->WorksheetCategory_Idn->IsDetailKey && $this->WorksheetCategory_Idn->FormValue != NULL && $this->WorksheetCategory_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->WorksheetCategory_Idn->caption(), $this->WorksheetCategory_Idn->RequiredErrorMessage));
			}
		}
		if ($this->Manufacturer_Idn->Required) {
			if (!$this->Manufacturer_Idn->IsDetailKey && $this->Manufacturer_Idn->FormValue != NULL && $this->Manufacturer_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Manufacturer_Idn->caption(), $this->Manufacturer_Idn->RequiredErrorMessage));
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
		if ($this->Name->Required) {
			if (!$this->Name->IsDetailKey && $this->Name->FormValue != NULL && $this->Name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Name->caption(), $this->Name->RequiredErrorMessage));
			}
		}
		if ($this->MaterialUnitPrice->Required) {
			if (!$this->MaterialUnitPrice->IsDetailKey && $this->MaterialUnitPrice->FormValue != NULL && $this->MaterialUnitPrice->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MaterialUnitPrice->caption(), $this->MaterialUnitPrice->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->MaterialUnitPrice->FormValue)) {
			AddMessage($FormError, $this->MaterialUnitPrice->errorMessage());
		}
		if ($this->FieldUnitPrice->Required) {
			if (!$this->FieldUnitPrice->IsDetailKey && $this->FieldUnitPrice->FormValue != NULL && $this->FieldUnitPrice->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FieldUnitPrice->caption(), $this->FieldUnitPrice->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->FieldUnitPrice->FormValue)) {
			AddMessage($FormError, $this->FieldUnitPrice->errorMessage());
		}
		if ($this->ShopUnitPrice->Required) {
			if (!$this->ShopUnitPrice->IsDetailKey && $this->ShopUnitPrice->FormValue != NULL && $this->ShopUnitPrice->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ShopUnitPrice->caption(), $this->ShopUnitPrice->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ShopUnitPrice->FormValue)) {
			AddMessage($FormError, $this->ShopUnitPrice->errorMessage());
		}
		if ($this->EngineerUnitPrice->Required) {
			if (!$this->EngineerUnitPrice->IsDetailKey && $this->EngineerUnitPrice->FormValue != NULL && $this->EngineerUnitPrice->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EngineerUnitPrice->caption(), $this->EngineerUnitPrice->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->EngineerUnitPrice->FormValue)) {
			AddMessage($FormError, $this->EngineerUnitPrice->errorMessage());
		}
		if ($this->DefaultQuantity->Required) {
			if (!$this->DefaultQuantity->IsDetailKey && $this->DefaultQuantity->FormValue != NULL && $this->DefaultQuantity->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DefaultQuantity->caption(), $this->DefaultQuantity->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DefaultQuantity->FormValue)) {
			AddMessage($FormError, $this->DefaultQuantity->errorMessage());
		}
		if ($this->ProductSize_Idn->Required) {
			if (!$this->ProductSize_Idn->IsDetailKey && $this->ProductSize_Idn->FormValue != NULL && $this->ProductSize_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProductSize_Idn->caption(), $this->ProductSize_Idn->RequiredErrorMessage));
			}
		}
		if ($this->Description->Required) {
			if (!$this->Description->IsDetailKey && $this->Description->FormValue != NULL && $this->Description->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Description->caption(), $this->Description->RequiredErrorMessage));
			}
		}
		if ($this->PipeType_Idn->Required) {
			if (!$this->PipeType_Idn->IsDetailKey && $this->PipeType_Idn->FormValue != NULL && $this->PipeType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PipeType_Idn->caption(), $this->PipeType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->ScheduleType_Idn->Required) {
			if (!$this->ScheduleType_Idn->IsDetailKey && $this->ScheduleType_Idn->FormValue != NULL && $this->ScheduleType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ScheduleType_Idn->caption(), $this->ScheduleType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->Fitting_Idn->Required) {
			if (!$this->Fitting_Idn->IsDetailKey && $this->Fitting_Idn->FormValue != NULL && $this->Fitting_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Fitting_Idn->caption(), $this->Fitting_Idn->RequiredErrorMessage));
			}
		}
		if ($this->GroovedFittingType_Idn->Required) {
			if (!$this->GroovedFittingType_Idn->IsDetailKey && $this->GroovedFittingType_Idn->FormValue != NULL && $this->GroovedFittingType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->GroovedFittingType_Idn->caption(), $this->GroovedFittingType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->ThreadedFittingType_Idn->Required) {
			if (!$this->ThreadedFittingType_Idn->IsDetailKey && $this->ThreadedFittingType_Idn->FormValue != NULL && $this->ThreadedFittingType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ThreadedFittingType_Idn->caption(), $this->ThreadedFittingType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->HangerType_Idn->Required) {
			if (!$this->HangerType_Idn->IsDetailKey && $this->HangerType_Idn->FormValue != NULL && $this->HangerType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->HangerType_Idn->caption(), $this->HangerType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->HangerSubType_Idn->Required) {
			if (!$this->HangerSubType_Idn->IsDetailKey && $this->HangerSubType_Idn->FormValue != NULL && $this->HangerSubType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->HangerSubType_Idn->caption(), $this->HangerSubType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->SubcontractCategory_Idn->Required) {
			if (!$this->SubcontractCategory_Idn->IsDetailKey && $this->SubcontractCategory_Idn->FormValue != NULL && $this->SubcontractCategory_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SubcontractCategory_Idn->caption(), $this->SubcontractCategory_Idn->RequiredErrorMessage));
			}
		}
		if ($this->ApplyToAdjustmentFactorsFlag->Required) {
			if ($this->ApplyToAdjustmentFactorsFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ApplyToAdjustmentFactorsFlag->caption(), $this->ApplyToAdjustmentFactorsFlag->RequiredErrorMessage));
			}
		}
		if ($this->ApplyToContingencyFlag->Required) {
			if ($this->ApplyToContingencyFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ApplyToContingencyFlag->caption(), $this->ApplyToContingencyFlag->RequiredErrorMessage));
			}
		}
		if ($this->IsMainComponent->Required) {
			if ($this->IsMainComponent->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IsMainComponent->caption(), $this->IsMainComponent->RequiredErrorMessage));
			}
		}
		if ($this->DomesticFlag->Required) {
			if ($this->DomesticFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DomesticFlag->caption(), $this->DomesticFlag->RequiredErrorMessage));
			}
		}
		if ($this->LoadFlag->Required) {
			if ($this->LoadFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LoadFlag->caption(), $this->LoadFlag->RequiredErrorMessage));
			}
		}
		if ($this->AutoLoadFlag->Required) {
			if ($this->AutoLoadFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AutoLoadFlag->caption(), $this->AutoLoadFlag->RequiredErrorMessage));
			}
		}
		if ($this->ActiveFlag->Required) {
			if ($this->ActiveFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActiveFlag->caption(), $this->ActiveFlag->RequiredErrorMessage));
			}
		}
		if ($this->GradeType_Idn->Required) {
			if (!$this->GradeType_Idn->IsDetailKey && $this->GradeType_Idn->FormValue != NULL && $this->GradeType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->GradeType_Idn->caption(), $this->GradeType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->PressureType_Idn->Required) {
			if (!$this->PressureType_Idn->IsDetailKey && $this->PressureType_Idn->FormValue != NULL && $this->PressureType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PressureType_Idn->caption(), $this->PressureType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->SeamlessFlag->Required) {
			if ($this->SeamlessFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SeamlessFlag->caption(), $this->SeamlessFlag->RequiredErrorMessage));
			}
		}
		if ($this->ResponseType->Required) {
			if ($this->ResponseType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ResponseType->caption(), $this->ResponseType->RequiredErrorMessage));
			}
		}
		if ($this->FMJobFlag->Required) {
			if ($this->FMJobFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FMJobFlag->caption(), $this->FMJobFlag->RequiredErrorMessage));
			}
		}
		if ($this->RecommendedBoxes->Required) {
			if (!$this->RecommendedBoxes->IsDetailKey && $this->RecommendedBoxes->FormValue != NULL && $this->RecommendedBoxes->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RecommendedBoxes->caption(), $this->RecommendedBoxes->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->RecommendedBoxes->FormValue)) {
			AddMessage($FormError, $this->RecommendedBoxes->errorMessage());
		}
		if ($this->RecommendedWireFootage->Required) {
			if (!$this->RecommendedWireFootage->IsDetailKey && $this->RecommendedWireFootage->FormValue != NULL && $this->RecommendedWireFootage->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RecommendedWireFootage->caption(), $this->RecommendedWireFootage->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->RecommendedWireFootage->FormValue)) {
			AddMessage($FormError, $this->RecommendedWireFootage->errorMessage());
		}
		if ($this->CoverageType_Idn->Required) {
			if (!$this->CoverageType_Idn->IsDetailKey && $this->CoverageType_Idn->FormValue != NULL && $this->CoverageType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CoverageType_Idn->caption(), $this->CoverageType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->HeadType_Idn->Required) {
			if (!$this->HeadType_Idn->IsDetailKey && $this->HeadType_Idn->FormValue != NULL && $this->HeadType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->HeadType_Idn->caption(), $this->HeadType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->FinishType_Idn->Required) {
			if (!$this->FinishType_Idn->IsDetailKey && $this->FinishType_Idn->FormValue != NULL && $this->FinishType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinishType_Idn->caption(), $this->FinishType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->Outlet_Idn->Required) {
			if (!$this->Outlet_Idn->IsDetailKey && $this->Outlet_Idn->FormValue != NULL && $this->Outlet_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Outlet_Idn->caption(), $this->Outlet_Idn->RequiredErrorMessage));
			}
		}
		if ($this->RiserType_Idn->Required) {
			if (!$this->RiserType_Idn->IsDetailKey && $this->RiserType_Idn->FormValue != NULL && $this->RiserType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RiserType_Idn->caption(), $this->RiserType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->BackFlowType_Idn->Required) {
			if (!$this->BackFlowType_Idn->IsDetailKey && $this->BackFlowType_Idn->FormValue != NULL && $this->BackFlowType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BackFlowType_Idn->caption(), $this->BackFlowType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->ControlValve_Idn->Required) {
			if (!$this->ControlValve_Idn->IsDetailKey && $this->ControlValve_Idn->FormValue != NULL && $this->ControlValve_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ControlValve_Idn->caption(), $this->ControlValve_Idn->RequiredErrorMessage));
			}
		}
		if ($this->CheckValve_Idn->Required) {
			if (!$this->CheckValve_Idn->IsDetailKey && $this->CheckValve_Idn->FormValue != NULL && $this->CheckValve_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CheckValve_Idn->caption(), $this->CheckValve_Idn->RequiredErrorMessage));
			}
		}
		if ($this->FDCType_Idn->Required) {
			if (!$this->FDCType_Idn->IsDetailKey && $this->FDCType_Idn->FormValue != NULL && $this->FDCType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FDCType_Idn->caption(), $this->FDCType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->BellType_Idn->Required) {
			if (!$this->BellType_Idn->IsDetailKey && $this->BellType_Idn->FormValue != NULL && $this->BellType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BellType_Idn->caption(), $this->BellType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->TappingTee_Idn->Required) {
			if (!$this->TappingTee_Idn->IsDetailKey && $this->TappingTee_Idn->FormValue != NULL && $this->TappingTee_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TappingTee_Idn->caption(), $this->TappingTee_Idn->RequiredErrorMessage));
			}
		}
		if ($this->UndergroundValve_Idn->Required) {
			if (!$this->UndergroundValve_Idn->IsDetailKey && $this->UndergroundValve_Idn->FormValue != NULL && $this->UndergroundValve_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UndergroundValve_Idn->caption(), $this->UndergroundValve_Idn->RequiredErrorMessage));
			}
		}
		if ($this->LiftDuration_Idn->Required) {
			if (!$this->LiftDuration_Idn->IsDetailKey && $this->LiftDuration_Idn->FormValue != NULL && $this->LiftDuration_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LiftDuration_Idn->caption(), $this->LiftDuration_Idn->RequiredErrorMessage));
			}
		}
		if ($this->TrimPackageFlag->Required) {
			if ($this->TrimPackageFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TrimPackageFlag->caption(), $this->TrimPackageFlag->RequiredErrorMessage));
			}
		}
		if ($this->ListedFlag->Required) {
			if ($this->ListedFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ListedFlag->caption(), $this->ListedFlag->RequiredErrorMessage));
			}
		}
		if ($this->BoxWireLength->Required) {
			if (!$this->BoxWireLength->IsDetailKey && $this->BoxWireLength->FormValue != NULL && $this->BoxWireLength->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoxWireLength->caption(), $this->BoxWireLength->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BoxWireLength->FormValue)) {
			AddMessage($FormError, $this->BoxWireLength->errorMessage());
		}
		if ($this->IsFirePump->Required) {
			if ($this->IsFirePump->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IsFirePump->caption(), $this->IsFirePump->RequiredErrorMessage));
			}
		}
		if ($this->FirePumpType_Idn->Required) {
			if (!$this->FirePumpType_Idn->IsDetailKey && $this->FirePumpType_Idn->FormValue != NULL && $this->FirePumpType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FirePumpType_Idn->caption(), $this->FirePumpType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->FirePumpAttribute_Idn->Required) {
			if (!$this->FirePumpAttribute_Idn->IsDetailKey && $this->FirePumpAttribute_Idn->FormValue != NULL && $this->FirePumpAttribute_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FirePumpAttribute_Idn->caption(), $this->FirePumpAttribute_Idn->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->FirePumpAttribute_Idn->FormValue)) {
			AddMessage($FormError, $this->FirePumpAttribute_Idn->errorMessage());
		}
		if ($this->IsDieselFuel->Required) {
			if ($this->IsDieselFuel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IsDieselFuel->caption(), $this->IsDieselFuel->RequiredErrorMessage));
			}
		}
		if ($this->IsSolution->Required) {
			if ($this->IsSolution->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IsSolution->caption(), $this->IsSolution->RequiredErrorMessage));
			}
		}
		if ($this->Position_Idn->Required) {
			if (!$this->Position_Idn->IsDetailKey && $this->Position_Idn->FormValue != NULL && $this->Position_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Position_Idn->caption(), $this->Position_Idn->RequiredErrorMessage));
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
				$thisKey .= $row['Product_Idn'];
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

			// Department_Idn
			$this->Department_Idn->setDbValueDef($rsnew, $this->Department_Idn->CurrentValue, NULL, $this->Department_Idn->ReadOnly);

			// WorksheetMaster_Idn
			$this->WorksheetMaster_Idn->setDbValueDef($rsnew, $this->WorksheetMaster_Idn->CurrentValue, NULL, $this->WorksheetMaster_Idn->ReadOnly);

			// WorksheetCategory_Idn
			$this->WorksheetCategory_Idn->setDbValueDef($rsnew, $this->WorksheetCategory_Idn->CurrentValue, NULL, $this->WorksheetCategory_Idn->ReadOnly);

			// Manufacturer_Idn
			$this->Manufacturer_Idn->setDbValueDef($rsnew, $this->Manufacturer_Idn->CurrentValue, NULL, $this->Manufacturer_Idn->ReadOnly);

			// Rank
			$this->Rank->setDbValueDef($rsnew, $this->Rank->CurrentValue, NULL, $this->Rank->ReadOnly);

			// Name
			$this->Name->setDbValueDef($rsnew, $this->Name->CurrentValue, NULL, $this->Name->ReadOnly);

			// MaterialUnitPrice
			$this->MaterialUnitPrice->setDbValueDef($rsnew, $this->MaterialUnitPrice->CurrentValue, NULL, $this->MaterialUnitPrice->ReadOnly);

			// FieldUnitPrice
			$this->FieldUnitPrice->setDbValueDef($rsnew, $this->FieldUnitPrice->CurrentValue, NULL, $this->FieldUnitPrice->ReadOnly);

			// ShopUnitPrice
			$this->ShopUnitPrice->setDbValueDef($rsnew, $this->ShopUnitPrice->CurrentValue, NULL, $this->ShopUnitPrice->ReadOnly);

			// EngineerUnitPrice
			$this->EngineerUnitPrice->setDbValueDef($rsnew, $this->EngineerUnitPrice->CurrentValue, NULL, $this->EngineerUnitPrice->ReadOnly);

			// DefaultQuantity
			$this->DefaultQuantity->setDbValueDef($rsnew, $this->DefaultQuantity->CurrentValue, NULL, $this->DefaultQuantity->ReadOnly);

			// ProductSize_Idn
			$this->ProductSize_Idn->setDbValueDef($rsnew, $this->ProductSize_Idn->CurrentValue, NULL, $this->ProductSize_Idn->ReadOnly);

			// Description
			$this->Description->setDbValueDef($rsnew, $this->Description->CurrentValue, NULL, $this->Description->ReadOnly);

			// PipeType_Idn
			$this->PipeType_Idn->setDbValueDef($rsnew, $this->PipeType_Idn->CurrentValue, NULL, $this->PipeType_Idn->ReadOnly);

			// ScheduleType_Idn
			$this->ScheduleType_Idn->setDbValueDef($rsnew, $this->ScheduleType_Idn->CurrentValue, NULL, $this->ScheduleType_Idn->ReadOnly);

			// Fitting_Idn
			$this->Fitting_Idn->setDbValueDef($rsnew, $this->Fitting_Idn->CurrentValue, NULL, $this->Fitting_Idn->ReadOnly);

			// GroovedFittingType_Idn
			$this->GroovedFittingType_Idn->setDbValueDef($rsnew, $this->GroovedFittingType_Idn->CurrentValue, NULL, $this->GroovedFittingType_Idn->ReadOnly);

			// ThreadedFittingType_Idn
			$this->ThreadedFittingType_Idn->setDbValueDef($rsnew, $this->ThreadedFittingType_Idn->CurrentValue, NULL, $this->ThreadedFittingType_Idn->ReadOnly);

			// HangerType_Idn
			$this->HangerType_Idn->setDbValueDef($rsnew, $this->HangerType_Idn->CurrentValue, NULL, $this->HangerType_Idn->ReadOnly);

			// HangerSubType_Idn
			$this->HangerSubType_Idn->setDbValueDef($rsnew, $this->HangerSubType_Idn->CurrentValue, NULL, $this->HangerSubType_Idn->ReadOnly);

			// SubcontractCategory_Idn
			$this->SubcontractCategory_Idn->setDbValueDef($rsnew, $this->SubcontractCategory_Idn->CurrentValue, NULL, $this->SubcontractCategory_Idn->ReadOnly);

			// ApplyToAdjustmentFactorsFlag
			$tmpBool = $this->ApplyToAdjustmentFactorsFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->ApplyToAdjustmentFactorsFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->ApplyToAdjustmentFactorsFlag->ReadOnly);

			// ApplyToContingencyFlag
			$tmpBool = $this->ApplyToContingencyFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->ApplyToContingencyFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->ApplyToContingencyFlag->ReadOnly);

			// IsMainComponent
			$tmpBool = $this->IsMainComponent->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->IsMainComponent->setDbValueDef($rsnew, $tmpBool, NULL, $this->IsMainComponent->ReadOnly);

			// DomesticFlag
			$tmpBool = $this->DomesticFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->DomesticFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->DomesticFlag->ReadOnly);

			// LoadFlag
			$tmpBool = $this->LoadFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->LoadFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->LoadFlag->ReadOnly);

			// AutoLoadFlag
			$tmpBool = $this->AutoLoadFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->AutoLoadFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->AutoLoadFlag->ReadOnly);

			// ActiveFlag
			$tmpBool = $this->ActiveFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->ActiveFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->ActiveFlag->ReadOnly);

			// GradeType_Idn
			$this->GradeType_Idn->setDbValueDef($rsnew, $this->GradeType_Idn->CurrentValue, NULL, $this->GradeType_Idn->ReadOnly);

			// PressureType_Idn
			$this->PressureType_Idn->setDbValueDef($rsnew, $this->PressureType_Idn->CurrentValue, NULL, $this->PressureType_Idn->ReadOnly);

			// SeamlessFlag
			$tmpBool = $this->SeamlessFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->SeamlessFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->SeamlessFlag->ReadOnly);

			// ResponseType
			$this->ResponseType->setDbValueDef($rsnew, $this->ResponseType->CurrentValue, NULL, $this->ResponseType->ReadOnly);

			// FMJobFlag
			$tmpBool = $this->FMJobFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->FMJobFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->FMJobFlag->ReadOnly);

			// RecommendedBoxes
			$this->RecommendedBoxes->setDbValueDef($rsnew, $this->RecommendedBoxes->CurrentValue, NULL, $this->RecommendedBoxes->ReadOnly);

			// RecommendedWireFootage
			$this->RecommendedWireFootage->setDbValueDef($rsnew, $this->RecommendedWireFootage->CurrentValue, NULL, $this->RecommendedWireFootage->ReadOnly);

			// CoverageType_Idn
			$this->CoverageType_Idn->setDbValueDef($rsnew, $this->CoverageType_Idn->CurrentValue, NULL, $this->CoverageType_Idn->ReadOnly);

			// HeadType_Idn
			$this->HeadType_Idn->setDbValueDef($rsnew, $this->HeadType_Idn->CurrentValue, NULL, $this->HeadType_Idn->ReadOnly);

			// FinishType_Idn
			$this->FinishType_Idn->setDbValueDef($rsnew, $this->FinishType_Idn->CurrentValue, NULL, $this->FinishType_Idn->ReadOnly);

			// Outlet_Idn
			$this->Outlet_Idn->setDbValueDef($rsnew, $this->Outlet_Idn->CurrentValue, NULL, $this->Outlet_Idn->ReadOnly);

			// RiserType_Idn
			$this->RiserType_Idn->setDbValueDef($rsnew, $this->RiserType_Idn->CurrentValue, NULL, $this->RiserType_Idn->ReadOnly);

			// BackFlowType_Idn
			$this->BackFlowType_Idn->setDbValueDef($rsnew, $this->BackFlowType_Idn->CurrentValue, NULL, $this->BackFlowType_Idn->ReadOnly);

			// ControlValve_Idn
			$this->ControlValve_Idn->setDbValueDef($rsnew, $this->ControlValve_Idn->CurrentValue, NULL, $this->ControlValve_Idn->ReadOnly);

			// CheckValve_Idn
			$this->CheckValve_Idn->setDbValueDef($rsnew, $this->CheckValve_Idn->CurrentValue, NULL, $this->CheckValve_Idn->ReadOnly);

			// FDCType_Idn
			$this->FDCType_Idn->setDbValueDef($rsnew, $this->FDCType_Idn->CurrentValue, NULL, $this->FDCType_Idn->ReadOnly);

			// BellType_Idn
			$this->BellType_Idn->setDbValueDef($rsnew, $this->BellType_Idn->CurrentValue, NULL, $this->BellType_Idn->ReadOnly);

			// TappingTee_Idn
			$this->TappingTee_Idn->setDbValueDef($rsnew, $this->TappingTee_Idn->CurrentValue, NULL, $this->TappingTee_Idn->ReadOnly);

			// UndergroundValve_Idn
			$this->UndergroundValve_Idn->setDbValueDef($rsnew, $this->UndergroundValve_Idn->CurrentValue, NULL, $this->UndergroundValve_Idn->ReadOnly);

			// LiftDuration_Idn
			$this->LiftDuration_Idn->setDbValueDef($rsnew, $this->LiftDuration_Idn->CurrentValue, NULL, $this->LiftDuration_Idn->ReadOnly);

			// TrimPackageFlag
			$tmpBool = $this->TrimPackageFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->TrimPackageFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->TrimPackageFlag->ReadOnly);

			// ListedFlag
			$tmpBool = $this->ListedFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->ListedFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->ListedFlag->ReadOnly);

			// BoxWireLength
			$this->BoxWireLength->setDbValueDef($rsnew, $this->BoxWireLength->CurrentValue, NULL, $this->BoxWireLength->ReadOnly);

			// IsFirePump
			$tmpBool = $this->IsFirePump->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->IsFirePump->setDbValueDef($rsnew, $tmpBool, NULL, $this->IsFirePump->ReadOnly);

			// FirePumpType_Idn
			$this->FirePumpType_Idn->setDbValueDef($rsnew, $this->FirePumpType_Idn->CurrentValue, NULL, $this->FirePumpType_Idn->ReadOnly);

			// FirePumpAttribute_Idn
			$this->FirePumpAttribute_Idn->setDbValueDef($rsnew, $this->FirePumpAttribute_Idn->CurrentValue, NULL, $this->FirePumpAttribute_Idn->ReadOnly);

			// IsDieselFuel
			$tmpBool = $this->IsDieselFuel->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->IsDieselFuel->setDbValueDef($rsnew, $tmpBool, NULL, $this->IsDieselFuel->ReadOnly);

			// IsSolution
			$tmpBool = $this->IsSolution->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->IsSolution->setDbValueDef($rsnew, $tmpBool, NULL, $this->IsSolution->ReadOnly);

			// Position_Idn
			$this->Position_Idn->setDbValueDef($rsnew, $this->Position_Idn->CurrentValue, NULL, $this->Position_Idn->ReadOnly);

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
		$hash .= GetFieldHash($rs->fields('Department_Idn')); // Department_Idn
		$hash .= GetFieldHash($rs->fields('WorksheetMaster_Idn')); // WorksheetMaster_Idn
		$hash .= GetFieldHash($rs->fields('WorksheetCategory_Idn')); // WorksheetCategory_Idn
		$hash .= GetFieldHash($rs->fields('Manufacturer_Idn')); // Manufacturer_Idn
		$hash .= GetFieldHash($rs->fields('Rank')); // Rank
		$hash .= GetFieldHash($rs->fields('Name')); // Name
		$hash .= GetFieldHash($rs->fields('MaterialUnitPrice')); // MaterialUnitPrice
		$hash .= GetFieldHash($rs->fields('FieldUnitPrice')); // FieldUnitPrice
		$hash .= GetFieldHash($rs->fields('ShopUnitPrice')); // ShopUnitPrice
		$hash .= GetFieldHash($rs->fields('EngineerUnitPrice')); // EngineerUnitPrice
		$hash .= GetFieldHash($rs->fields('DefaultQuantity')); // DefaultQuantity
		$hash .= GetFieldHash($rs->fields('ProductSize_Idn')); // ProductSize_Idn
		$hash .= GetFieldHash($rs->fields('Description')); // Description
		$hash .= GetFieldHash($rs->fields('PipeType_Idn')); // PipeType_Idn
		$hash .= GetFieldHash($rs->fields('ScheduleType_Idn')); // ScheduleType_Idn
		$hash .= GetFieldHash($rs->fields('Fitting_Idn')); // Fitting_Idn
		$hash .= GetFieldHash($rs->fields('GroovedFittingType_Idn')); // GroovedFittingType_Idn
		$hash .= GetFieldHash($rs->fields('ThreadedFittingType_Idn')); // ThreadedFittingType_Idn
		$hash .= GetFieldHash($rs->fields('HangerType_Idn')); // HangerType_Idn
		$hash .= GetFieldHash($rs->fields('HangerSubType_Idn')); // HangerSubType_Idn
		$hash .= GetFieldHash($rs->fields('SubcontractCategory_Idn')); // SubcontractCategory_Idn
		$hash .= GetFieldHash($rs->fields('ApplyToAdjustmentFactorsFlag')); // ApplyToAdjustmentFactorsFlag
		$hash .= GetFieldHash($rs->fields('ApplyToContingencyFlag')); // ApplyToContingencyFlag
		$hash .= GetFieldHash($rs->fields('IsMainComponent')); // IsMainComponent
		$hash .= GetFieldHash($rs->fields('DomesticFlag')); // DomesticFlag
		$hash .= GetFieldHash($rs->fields('LoadFlag')); // LoadFlag
		$hash .= GetFieldHash($rs->fields('AutoLoadFlag')); // AutoLoadFlag
		$hash .= GetFieldHash($rs->fields('ActiveFlag')); // ActiveFlag
		$hash .= GetFieldHash($rs->fields('GradeType_Idn')); // GradeType_Idn
		$hash .= GetFieldHash($rs->fields('PressureType_Idn')); // PressureType_Idn
		$hash .= GetFieldHash($rs->fields('SeamlessFlag')); // SeamlessFlag
		$hash .= GetFieldHash($rs->fields('ResponseType')); // ResponseType
		$hash .= GetFieldHash($rs->fields('FMJobFlag')); // FMJobFlag
		$hash .= GetFieldHash($rs->fields('RecommendedBoxes')); // RecommendedBoxes
		$hash .= GetFieldHash($rs->fields('RecommendedWireFootage')); // RecommendedWireFootage
		$hash .= GetFieldHash($rs->fields('CoverageType_Idn')); // CoverageType_Idn
		$hash .= GetFieldHash($rs->fields('HeadType_Idn')); // HeadType_Idn
		$hash .= GetFieldHash($rs->fields('FinishType_Idn')); // FinishType_Idn
		$hash .= GetFieldHash($rs->fields('Outlet_Idn')); // Outlet_Idn
		$hash .= GetFieldHash($rs->fields('RiserType_Idn')); // RiserType_Idn
		$hash .= GetFieldHash($rs->fields('BackFlowType_Idn')); // BackFlowType_Idn
		$hash .= GetFieldHash($rs->fields('ControlValve_Idn')); // ControlValve_Idn
		$hash .= GetFieldHash($rs->fields('CheckValve_Idn')); // CheckValve_Idn
		$hash .= GetFieldHash($rs->fields('FDCType_Idn')); // FDCType_Idn
		$hash .= GetFieldHash($rs->fields('BellType_Idn')); // BellType_Idn
		$hash .= GetFieldHash($rs->fields('TappingTee_Idn')); // TappingTee_Idn
		$hash .= GetFieldHash($rs->fields('UndergroundValve_Idn')); // UndergroundValve_Idn
		$hash .= GetFieldHash($rs->fields('LiftDuration_Idn')); // LiftDuration_Idn
		$hash .= GetFieldHash($rs->fields('TrimPackageFlag')); // TrimPackageFlag
		$hash .= GetFieldHash($rs->fields('ListedFlag')); // ListedFlag
		$hash .= GetFieldHash($rs->fields('BoxWireLength')); // BoxWireLength
		$hash .= GetFieldHash($rs->fields('IsFirePump')); // IsFirePump
		$hash .= GetFieldHash($rs->fields('FirePumpType_Idn')); // FirePumpType_Idn
		$hash .= GetFieldHash($rs->fields('FirePumpAttribute_Idn')); // FirePumpAttribute_Idn
		$hash .= GetFieldHash($rs->fields('IsDieselFuel')); // IsDieselFuel
		$hash .= GetFieldHash($rs->fields('IsSolution')); // IsSolution
		$hash .= GetFieldHash($rs->fields('Position_Idn')); // Position_Idn
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

		// Department_Idn
		$this->Department_Idn->setDbValueDef($rsnew, $this->Department_Idn->CurrentValue, NULL, strval($this->Department_Idn->CurrentValue) == "");

		// WorksheetMaster_Idn
		$this->WorksheetMaster_Idn->setDbValueDef($rsnew, $this->WorksheetMaster_Idn->CurrentValue, NULL, strval($this->WorksheetMaster_Idn->CurrentValue) == "");

		// WorksheetCategory_Idn
		$this->WorksheetCategory_Idn->setDbValueDef($rsnew, $this->WorksheetCategory_Idn->CurrentValue, NULL, strval($this->WorksheetCategory_Idn->CurrentValue) == "");

		// Manufacturer_Idn
		$this->Manufacturer_Idn->setDbValueDef($rsnew, $this->Manufacturer_Idn->CurrentValue, NULL, strval($this->Manufacturer_Idn->CurrentValue) == "");

		// Rank
		$this->Rank->setDbValueDef($rsnew, $this->Rank->CurrentValue, NULL, strval($this->Rank->CurrentValue) == "");

		// Name
		$this->Name->setDbValueDef($rsnew, $this->Name->CurrentValue, NULL, FALSE);

		// MaterialUnitPrice
		$this->MaterialUnitPrice->setDbValueDef($rsnew, $this->MaterialUnitPrice->CurrentValue, NULL, strval($this->MaterialUnitPrice->CurrentValue) == "");

		// FieldUnitPrice
		$this->FieldUnitPrice->setDbValueDef($rsnew, $this->FieldUnitPrice->CurrentValue, NULL, strval($this->FieldUnitPrice->CurrentValue) == "");

		// ShopUnitPrice
		$this->ShopUnitPrice->setDbValueDef($rsnew, $this->ShopUnitPrice->CurrentValue, NULL, strval($this->ShopUnitPrice->CurrentValue) == "");

		// EngineerUnitPrice
		$this->EngineerUnitPrice->setDbValueDef($rsnew, $this->EngineerUnitPrice->CurrentValue, NULL, strval($this->EngineerUnitPrice->CurrentValue) == "");

		// DefaultQuantity
		$this->DefaultQuantity->setDbValueDef($rsnew, $this->DefaultQuantity->CurrentValue, NULL, FALSE);

		// ProductSize_Idn
		$this->ProductSize_Idn->setDbValueDef($rsnew, $this->ProductSize_Idn->CurrentValue, NULL, strval($this->ProductSize_Idn->CurrentValue) == "");

		// Description
		$this->Description->setDbValueDef($rsnew, $this->Description->CurrentValue, NULL, strval($this->Description->CurrentValue) == "");

		// PipeType_Idn
		$this->PipeType_Idn->setDbValueDef($rsnew, $this->PipeType_Idn->CurrentValue, NULL, strval($this->PipeType_Idn->CurrentValue) == "");

		// ScheduleType_Idn
		$this->ScheduleType_Idn->setDbValueDef($rsnew, $this->ScheduleType_Idn->CurrentValue, NULL, strval($this->ScheduleType_Idn->CurrentValue) == "");

		// Fitting_Idn
		$this->Fitting_Idn->setDbValueDef($rsnew, $this->Fitting_Idn->CurrentValue, NULL, strval($this->Fitting_Idn->CurrentValue) == "");

		// GroovedFittingType_Idn
		$this->GroovedFittingType_Idn->setDbValueDef($rsnew, $this->GroovedFittingType_Idn->CurrentValue, NULL, strval($this->GroovedFittingType_Idn->CurrentValue) == "");

		// ThreadedFittingType_Idn
		$this->ThreadedFittingType_Idn->setDbValueDef($rsnew, $this->ThreadedFittingType_Idn->CurrentValue, NULL, strval($this->ThreadedFittingType_Idn->CurrentValue) == "");

		// HangerType_Idn
		$this->HangerType_Idn->setDbValueDef($rsnew, $this->HangerType_Idn->CurrentValue, NULL, strval($this->HangerType_Idn->CurrentValue) == "");

		// HangerSubType_Idn
		$this->HangerSubType_Idn->setDbValueDef($rsnew, $this->HangerSubType_Idn->CurrentValue, NULL, strval($this->HangerSubType_Idn->CurrentValue) == "");

		// SubcontractCategory_Idn
		$this->SubcontractCategory_Idn->setDbValueDef($rsnew, $this->SubcontractCategory_Idn->CurrentValue, NULL, strval($this->SubcontractCategory_Idn->CurrentValue) == "");

		// ApplyToAdjustmentFactorsFlag
		$tmpBool = $this->ApplyToAdjustmentFactorsFlag->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->ApplyToAdjustmentFactorsFlag->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->ApplyToAdjustmentFactorsFlag->CurrentValue) == "");

		// ApplyToContingencyFlag
		$tmpBool = $this->ApplyToContingencyFlag->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->ApplyToContingencyFlag->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->ApplyToContingencyFlag->CurrentValue) == "");

		// IsMainComponent
		$tmpBool = $this->IsMainComponent->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->IsMainComponent->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->IsMainComponent->CurrentValue) == "");

		// DomesticFlag
		$tmpBool = $this->DomesticFlag->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DomesticFlag->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DomesticFlag->CurrentValue) == "");

		// LoadFlag
		$tmpBool = $this->LoadFlag->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->LoadFlag->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->LoadFlag->CurrentValue) == "");

		// AutoLoadFlag
		$tmpBool = $this->AutoLoadFlag->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->AutoLoadFlag->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->AutoLoadFlag->CurrentValue) == "");

		// ActiveFlag
		$tmpBool = $this->ActiveFlag->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->ActiveFlag->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->ActiveFlag->CurrentValue) == "");

		// GradeType_Idn
		$this->GradeType_Idn->setDbValueDef($rsnew, $this->GradeType_Idn->CurrentValue, NULL, strval($this->GradeType_Idn->CurrentValue) == "");

		// PressureType_Idn
		$this->PressureType_Idn->setDbValueDef($rsnew, $this->PressureType_Idn->CurrentValue, NULL, strval($this->PressureType_Idn->CurrentValue) == "");

		// SeamlessFlag
		$tmpBool = $this->SeamlessFlag->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->SeamlessFlag->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->SeamlessFlag->CurrentValue) == "");

		// ResponseType
		$this->ResponseType->setDbValueDef($rsnew, $this->ResponseType->CurrentValue, NULL, strval($this->ResponseType->CurrentValue) == "");

		// FMJobFlag
		$tmpBool = $this->FMJobFlag->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->FMJobFlag->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->FMJobFlag->CurrentValue) == "");

		// RecommendedBoxes
		$this->RecommendedBoxes->setDbValueDef($rsnew, $this->RecommendedBoxes->CurrentValue, NULL, strval($this->RecommendedBoxes->CurrentValue) == "");

		// RecommendedWireFootage
		$this->RecommendedWireFootage->setDbValueDef($rsnew, $this->RecommendedWireFootage->CurrentValue, NULL, strval($this->RecommendedWireFootage->CurrentValue) == "");

		// CoverageType_Idn
		$this->CoverageType_Idn->setDbValueDef($rsnew, $this->CoverageType_Idn->CurrentValue, NULL, strval($this->CoverageType_Idn->CurrentValue) == "");

		// HeadType_Idn
		$this->HeadType_Idn->setDbValueDef($rsnew, $this->HeadType_Idn->CurrentValue, NULL, strval($this->HeadType_Idn->CurrentValue) == "");

		// FinishType_Idn
		$this->FinishType_Idn->setDbValueDef($rsnew, $this->FinishType_Idn->CurrentValue, NULL, strval($this->FinishType_Idn->CurrentValue) == "");

		// Outlet_Idn
		$this->Outlet_Idn->setDbValueDef($rsnew, $this->Outlet_Idn->CurrentValue, NULL, strval($this->Outlet_Idn->CurrentValue) == "");

		// RiserType_Idn
		$this->RiserType_Idn->setDbValueDef($rsnew, $this->RiserType_Idn->CurrentValue, NULL, strval($this->RiserType_Idn->CurrentValue) == "");

		// BackFlowType_Idn
		$this->BackFlowType_Idn->setDbValueDef($rsnew, $this->BackFlowType_Idn->CurrentValue, NULL, strval($this->BackFlowType_Idn->CurrentValue) == "");

		// ControlValve_Idn
		$this->ControlValve_Idn->setDbValueDef($rsnew, $this->ControlValve_Idn->CurrentValue, NULL, strval($this->ControlValve_Idn->CurrentValue) == "");

		// CheckValve_Idn
		$this->CheckValve_Idn->setDbValueDef($rsnew, $this->CheckValve_Idn->CurrentValue, NULL, strval($this->CheckValve_Idn->CurrentValue) == "");

		// FDCType_Idn
		$this->FDCType_Idn->setDbValueDef($rsnew, $this->FDCType_Idn->CurrentValue, NULL, strval($this->FDCType_Idn->CurrentValue) == "");

		// BellType_Idn
		$this->BellType_Idn->setDbValueDef($rsnew, $this->BellType_Idn->CurrentValue, NULL, strval($this->BellType_Idn->CurrentValue) == "");

		// TappingTee_Idn
		$this->TappingTee_Idn->setDbValueDef($rsnew, $this->TappingTee_Idn->CurrentValue, NULL, strval($this->TappingTee_Idn->CurrentValue) == "");

		// UndergroundValve_Idn
		$this->UndergroundValve_Idn->setDbValueDef($rsnew, $this->UndergroundValve_Idn->CurrentValue, NULL, strval($this->UndergroundValve_Idn->CurrentValue) == "");

		// LiftDuration_Idn
		$this->LiftDuration_Idn->setDbValueDef($rsnew, $this->LiftDuration_Idn->CurrentValue, NULL, strval($this->LiftDuration_Idn->CurrentValue) == "");

		// TrimPackageFlag
		$tmpBool = $this->TrimPackageFlag->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->TrimPackageFlag->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->TrimPackageFlag->CurrentValue) == "");

		// ListedFlag
		$tmpBool = $this->ListedFlag->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->ListedFlag->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->ListedFlag->CurrentValue) == "");

		// BoxWireLength
		$this->BoxWireLength->setDbValueDef($rsnew, $this->BoxWireLength->CurrentValue, NULL, strval($this->BoxWireLength->CurrentValue) == "");

		// IsFirePump
		$tmpBool = $this->IsFirePump->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->IsFirePump->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->IsFirePump->CurrentValue) == "");

		// FirePumpType_Idn
		$this->FirePumpType_Idn->setDbValueDef($rsnew, $this->FirePumpType_Idn->CurrentValue, NULL, strval($this->FirePumpType_Idn->CurrentValue) == "");

		// FirePumpAttribute_Idn
		$this->FirePumpAttribute_Idn->setDbValueDef($rsnew, $this->FirePumpAttribute_Idn->CurrentValue, NULL, strval($this->FirePumpAttribute_Idn->CurrentValue) == "");

		// IsDieselFuel
		$tmpBool = $this->IsDieselFuel->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->IsDieselFuel->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->IsDieselFuel->CurrentValue) == "");

		// IsSolution
		$tmpBool = $this->IsSolution->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->IsSolution->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->IsSolution->CurrentValue) == "");

		// Position_Idn
		$this->Position_Idn->setDbValueDef($rsnew, $this->Position_Idn->CurrentValue, NULL, strval($this->Position_Idn->CurrentValue) == "");

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
		$this->Product_Idn->AdvancedSearch->load();
		$this->Department_Idn->AdvancedSearch->load();
		$this->WorksheetMaster_Idn->AdvancedSearch->load();
		$this->WorksheetCategory_Idn->AdvancedSearch->load();
		$this->Manufacturer_Idn->AdvancedSearch->load();
		$this->Rank->AdvancedSearch->load();
		$this->Name->AdvancedSearch->load();
		$this->MaterialUnitPrice->AdvancedSearch->load();
		$this->FieldUnitPrice->AdvancedSearch->load();
		$this->ShopUnitPrice->AdvancedSearch->load();
		$this->EngineerUnitPrice->AdvancedSearch->load();
		$this->DefaultQuantity->AdvancedSearch->load();
		$this->ProductSize_Idn->AdvancedSearch->load();
		$this->Description->AdvancedSearch->load();
		$this->PipeType_Idn->AdvancedSearch->load();
		$this->ScheduleType_Idn->AdvancedSearch->load();
		$this->Fitting_Idn->AdvancedSearch->load();
		$this->GroovedFittingType_Idn->AdvancedSearch->load();
		$this->ThreadedFittingType_Idn->AdvancedSearch->load();
		$this->HangerType_Idn->AdvancedSearch->load();
		$this->HangerSubType_Idn->AdvancedSearch->load();
		$this->SubcontractCategory_Idn->AdvancedSearch->load();
		$this->ApplyToAdjustmentFactorsFlag->AdvancedSearch->load();
		$this->ApplyToContingencyFlag->AdvancedSearch->load();
		$this->IsMainComponent->AdvancedSearch->load();
		$this->DomesticFlag->AdvancedSearch->load();
		$this->LoadFlag->AdvancedSearch->load();
		$this->AutoLoadFlag->AdvancedSearch->load();
		$this->ActiveFlag->AdvancedSearch->load();
		$this->GradeType_Idn->AdvancedSearch->load();
		$this->PressureType_Idn->AdvancedSearch->load();
		$this->SeamlessFlag->AdvancedSearch->load();
		$this->ResponseType->AdvancedSearch->load();
		$this->FMJobFlag->AdvancedSearch->load();
		$this->RecommendedBoxes->AdvancedSearch->load();
		$this->RecommendedWireFootage->AdvancedSearch->load();
		$this->CoverageType_Idn->AdvancedSearch->load();
		$this->HeadType_Idn->AdvancedSearch->load();
		$this->FinishType_Idn->AdvancedSearch->load();
		$this->Outlet_Idn->AdvancedSearch->load();
		$this->RiserType_Idn->AdvancedSearch->load();
		$this->BackFlowType_Idn->AdvancedSearch->load();
		$this->ControlValve_Idn->AdvancedSearch->load();
		$this->CheckValve_Idn->AdvancedSearch->load();
		$this->FDCType_Idn->AdvancedSearch->load();
		$this->BellType_Idn->AdvancedSearch->load();
		$this->TappingTee_Idn->AdvancedSearch->load();
		$this->UndergroundValve_Idn->AdvancedSearch->load();
		$this->LiftDuration_Idn->AdvancedSearch->load();
		$this->TrimPackageFlag->AdvancedSearch->load();
		$this->ListedFlag->AdvancedSearch->load();
		$this->BoxWireLength->AdvancedSearch->load();
		$this->IsFirePump->AdvancedSearch->load();
		$this->FirePumpType_Idn->AdvancedSearch->load();
		$this->FirePumpAttribute_Idn->AdvancedSearch->load();
		$this->IsDieselFuel->AdvancedSearch->load();
		$this->IsSolution->AdvancedSearch->load();
		$this->Position_Idn->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fProductslist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fProductslist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fProductslist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_Products" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_Products\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fProductslist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fProductslistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
				case "x_WorksheetMaster_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_WorksheetCategory_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_Manufacturer_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_ProductSize_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_PipeType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_ScheduleType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_Fitting_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_GroovedFittingType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_ThreadedFittingType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_HangerType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_HangerSubType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_SubcontractCategory_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_ApplyToAdjustmentFactorsFlag":
					break;
				case "x_ApplyToContingencyFlag":
					break;
				case "x_IsMainComponent":
					break;
				case "x_DomesticFlag":
					break;
				case "x_LoadFlag":
					break;
				case "x_AutoLoadFlag":
					break;
				case "x_ActiveFlag":
					break;
				case "x_GradeType_Idn":
					break;
				case "x_PressureType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_SeamlessFlag":
					break;
				case "x_ResponseType":
					break;
				case "x_FMJobFlag":
					break;
				case "x_CoverageType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_HeadType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_FinishType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_Outlet_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_RiserType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_BackFlowType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_ControlValve_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_CheckValve_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_FDCType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_BellType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_TappingTee_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_UndergroundValve_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_LiftDuration_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_TrimPackageFlag":
					break;
				case "x_ListedFlag":
					break;
				case "x_IsFirePump":
					break;
				case "x_FirePumpType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_IsDieselFuel":
					break;
				case "x_IsSolution":
					break;
				case "x_Position_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
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
						case "x_WorksheetMaster_Idn":
							break;
						case "x_WorksheetCategory_Idn":
							break;
						case "x_Manufacturer_Idn":
							break;
						case "x_ProductSize_Idn":
							break;
						case "x_PipeType_Idn":
							break;
						case "x_ScheduleType_Idn":
							break;
						case "x_Fitting_Idn":
							break;
						case "x_GroovedFittingType_Idn":
							break;
						case "x_ThreadedFittingType_Idn":
							break;
						case "x_HangerType_Idn":
							break;
						case "x_HangerSubType_Idn":
							break;
						case "x_SubcontractCategory_Idn":
							break;
						case "x_GradeType_Idn":
							break;
						case "x_PressureType_Idn":
							break;
						case "x_CoverageType_Idn":
							break;
						case "x_HeadType_Idn":
							break;
						case "x_FinishType_Idn":
							break;
						case "x_Outlet_Idn":
							break;
						case "x_RiserType_Idn":
							break;
						case "x_BackFlowType_Idn":
							break;
						case "x_ControlValve_Idn":
							break;
						case "x_CheckValve_Idn":
							break;
						case "x_FDCType_Idn":
							break;
						case "x_BellType_Idn":
							break;
						case "x_TappingTee_Idn":
							break;
						case "x_UndergroundValve_Idn":
							break;
						case "x_LiftDuration_Idn":
							break;
						case "x_FirePumpType_Idn":
							break;
						case "x_Position_Idn":
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