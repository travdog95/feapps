<?php
namespace PHPMaker2020\feapps51;

/**
 * Page class
 */
class WorksheetMasterCategories_edit extends WorksheetMasterCategories
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}";

	// Table name
	public $TableName = 'WorksheetMasterCategories';

	// Page object name
	public $PageObjName = "WorksheetMasterCategories_edit";

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

		// Table object (WorksheetMasterCategories)
		if (!isset($GLOBALS["WorksheetMasterCategories"]) || get_class($GLOBALS["WorksheetMasterCategories"]) == PROJECT_NAMESPACE . "WorksheetMasterCategories") {
			$GLOBALS["WorksheetMasterCategories"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["WorksheetMasterCategories"];
		}

		// Table object (WorksheetCategories)
		if (!isset($GLOBALS['WorksheetCategories']))
			$GLOBALS['WorksheetCategories'] = new WorksheetCategories();

		// Table object (WorksheetMasters)
		if (!isset($GLOBALS['WorksheetMasters']))
			$GLOBALS['WorksheetMasters'] = new WorksheetMasters();

		// Table object (v_Administrators)
		if (!isset($GLOBALS['v_Administrators']))
			$GLOBALS['v_Administrators'] = new v_Administrators();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'WorksheetMasterCategories');

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
		global $WorksheetMasterCategories;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($WorksheetMasterCategories);
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "WorksheetMasterCategoriesview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
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
			$key .= @$ar['WorksheetMaster_Idn'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['WorksheetCategory_Idn'];
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $DisplayRecords = 1;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecordCount;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("WorksheetMasterCategorieslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->WorksheetMaster_Idn->setVisibility();
		$this->WorksheetCategory_Idn->setVisibility();
		$this->Rank->setVisibility();
		$this->AutoLoadFlag->setVisibility();
		$this->LoadFlag->setVisibility();
		$this->AddMiscFlag->setVisibility();
		$this->ChildWorksheetMaster_Idn->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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

		// Set up lookup cache
		$this->setupLookupOptions($this->WorksheetCategory_Idn);
		$this->setupLookupOptions($this->ChildWorksheetMaster_Idn);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("WorksheetMasterCategorieslist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("WorksheetMaster_Idn") !== NULL) {
				$this->WorksheetMaster_Idn->setQueryStringValue(Get("WorksheetMaster_Idn"));
				$this->WorksheetMaster_Idn->setOldValue($this->WorksheetMaster_Idn->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->WorksheetMaster_Idn->setQueryStringValue(Key(0));
				$this->WorksheetMaster_Idn->setOldValue($this->WorksheetMaster_Idn->QueryStringValue);
			} elseif (Post("WorksheetMaster_Idn") !== NULL) {
				$this->WorksheetMaster_Idn->setFormValue(Post("WorksheetMaster_Idn"));
				$this->WorksheetMaster_Idn->setOldValue($this->WorksheetMaster_Idn->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->WorksheetMaster_Idn->setQueryStringValue(Route(2));
				$this->WorksheetMaster_Idn->setOldValue($this->WorksheetMaster_Idn->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}
			if (Get("WorksheetCategory_Idn") !== NULL) {
				$this->WorksheetCategory_Idn->setQueryStringValue(Get("WorksheetCategory_Idn"));
				$this->WorksheetCategory_Idn->setOldValue($this->WorksheetCategory_Idn->QueryStringValue);
			} elseif (Key(1) !== NULL) {
				$this->WorksheetCategory_Idn->setQueryStringValue(Key(1));
				$this->WorksheetCategory_Idn->setOldValue($this->WorksheetCategory_Idn->QueryStringValue);
			} elseif (Post("WorksheetCategory_Idn") !== NULL) {
				$this->WorksheetCategory_Idn->setFormValue(Post("WorksheetCategory_Idn"));
				$this->WorksheetCategory_Idn->setOldValue($this->WorksheetCategory_Idn->FormValue);
			} elseif (Route(3) !== NULL) {
				$this->WorksheetCategory_Idn->setQueryStringValue(Route(3));
				$this->WorksheetCategory_Idn->setOldValue($this->WorksheetCategory_Idn->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_WorksheetMaster_Idn")) {
					$this->WorksheetMaster_Idn->setFormValue($CurrentForm->getValue("x_WorksheetMaster_Idn"));
				}
				if ($CurrentForm->hasValue("x_WorksheetCategory_Idn")) {
					$this->WorksheetCategory_Idn->setFormValue($CurrentForm->getValue("x_WorksheetCategory_Idn"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("WorksheetMaster_Idn") !== NULL) {
					$this->WorksheetMaster_Idn->setQueryStringValue(Get("WorksheetMaster_Idn"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->WorksheetMaster_Idn->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->WorksheetMaster_Idn->CurrentValue = NULL;
				}
				if (Get("WorksheetCategory_Idn") !== NULL) {
					$this->WorksheetCategory_Idn->setQueryStringValue(Get("WorksheetCategory_Idn"));
					$loadByQuery = TRUE;
				} elseif (Route(3) !== NULL) {
					$this->WorksheetCategory_Idn->setQueryStringValue(Route(3));
					$loadByQuery = TRUE;
				} else {
					$this->WorksheetCategory_Idn->CurrentValue = NULL;
				}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
			}

			// Set up master detail parameters
			$this->setupMasterParms();

			// Load recordset
			$this->StartRecord = 1; // Initialize start position
			if ($rs = $this->loadRecordset()) // Load records
				$this->TotalRecords = $rs->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found
				if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
					$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate("WorksheetMasterCategorieslist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->WorksheetMaster_Idn->CurrentValue != NULL && $this->WorksheetCategory_Idn->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->WorksheetMaster_Idn->CurrentValue, $rs->fields('WorksheetMaster_Idn')) && SameString($this->WorksheetCategory_Idn->CurrentValue, $rs->fields('WorksheetCategory_Idn'))) {
							$this->setStartRecordNumber($this->StartRecord); // Save record position
							$loaded = TRUE;
							break;
						} else {
							$this->StartRecord++;
							$rs->moveNext();
						}
					}
				}
			}

			// Load current row values
			if ($loaded)
				$this->loadRowValues($rs);
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
					$this->terminate("WorksheetMasterCategorieslist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "WorksheetMasterCategorieslist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
		$this->Pager = new PrevNextPager($this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager);
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

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

		// Check field name 'Rank' first before field var 'x_Rank'
		$val = $CurrentForm->hasValue("Rank") ? $CurrentForm->getValue("Rank") : $CurrentForm->getValue("x_Rank");
		if (!$this->Rank->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Rank->Visible = FALSE; // Disable update for API request
			else
				$this->Rank->setFormValue($val);
		}

		// Check field name 'AutoLoadFlag' first before field var 'x_AutoLoadFlag'
		$val = $CurrentForm->hasValue("AutoLoadFlag") ? $CurrentForm->getValue("AutoLoadFlag") : $CurrentForm->getValue("x_AutoLoadFlag");
		if (!$this->AutoLoadFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->AutoLoadFlag->Visible = FALSE; // Disable update for API request
			else
				$this->AutoLoadFlag->setFormValue($val);
		}

		// Check field name 'LoadFlag' first before field var 'x_LoadFlag'
		$val = $CurrentForm->hasValue("LoadFlag") ? $CurrentForm->getValue("LoadFlag") : $CurrentForm->getValue("x_LoadFlag");
		if (!$this->LoadFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LoadFlag->Visible = FALSE; // Disable update for API request
			else
				$this->LoadFlag->setFormValue($val);
		}

		// Check field name 'AddMiscFlag' first before field var 'x_AddMiscFlag'
		$val = $CurrentForm->hasValue("AddMiscFlag") ? $CurrentForm->getValue("AddMiscFlag") : $CurrentForm->getValue("x_AddMiscFlag");
		if (!$this->AddMiscFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->AddMiscFlag->Visible = FALSE; // Disable update for API request
			else
				$this->AddMiscFlag->setFormValue($val);
		}

		// Check field name 'ChildWorksheetMaster_Idn' first before field var 'x_ChildWorksheetMaster_Idn'
		$val = $CurrentForm->hasValue("ChildWorksheetMaster_Idn") ? $CurrentForm->getValue("ChildWorksheetMaster_Idn") : $CurrentForm->getValue("x_ChildWorksheetMaster_Idn");
		if (!$this->ChildWorksheetMaster_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ChildWorksheetMaster_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->ChildWorksheetMaster_Idn->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->WorksheetMaster_Idn->CurrentValue = $this->WorksheetMaster_Idn->FormValue;
		$this->WorksheetCategory_Idn->CurrentValue = $this->WorksheetCategory_Idn->FormValue;
		$this->Rank->CurrentValue = $this->Rank->FormValue;
		$this->AutoLoadFlag->CurrentValue = $this->AutoLoadFlag->FormValue;
		$this->LoadFlag->CurrentValue = $this->LoadFlag->FormValue;
		$this->AddMiscFlag->CurrentValue = $this->AddMiscFlag->FormValue;
		$this->ChildWorksheetMaster_Idn->CurrentValue = $this->ChildWorksheetMaster_Idn->FormValue;
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
		$this->WorksheetCategory_Idn->setDbValue($row['WorksheetCategory_Idn']);
		$this->Rank->setDbValue($row['Rank']);
		$this->AutoLoadFlag->setDbValue((ConvertToBool($row['AutoLoadFlag']) ? "1" : "0"));
		$this->LoadFlag->setDbValue((ConvertToBool($row['LoadFlag']) ? "1" : "0"));
		$this->AddMiscFlag->setDbValue((ConvertToBool($row['AddMiscFlag']) ? "1" : "0"));
		$this->ChildWorksheetMaster_Idn->setDbValue($row['ChildWorksheetMaster_Idn']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['WorksheetMaster_Idn'] = NULL;
		$row['WorksheetCategory_Idn'] = NULL;
		$row['Rank'] = NULL;
		$row['AutoLoadFlag'] = NULL;
		$row['LoadFlag'] = NULL;
		$row['AddMiscFlag'] = NULL;
		$row['ChildWorksheetMaster_Idn'] = NULL;
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
		if (strval($this->getKey("WorksheetCategory_Idn")) != "")
			$this->WorksheetCategory_Idn->OldValue = $this->getKey("WorksheetCategory_Idn"); // WorksheetCategory_Idn
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// WorksheetMaster_Idn
		// WorksheetCategory_Idn
		// Rank
		// AutoLoadFlag
		// LoadFlag
		// AddMiscFlag
		// ChildWorksheetMaster_Idn

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// WorksheetMaster_Idn
			$this->WorksheetMaster_Idn->EditAttrs["class"] = "form-control";
			$this->WorksheetMaster_Idn->EditCustomAttributes = "";
			$this->WorksheetMaster_Idn->EditValue = HtmlEncode($this->WorksheetMaster_Idn->CurrentValue);
			$this->WorksheetMaster_Idn->PlaceHolder = RemoveHtml($this->WorksheetMaster_Idn->caption());

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

			// Rank
			$this->Rank->EditAttrs["class"] = "form-control";
			$this->Rank->EditCustomAttributes = "";
			$this->Rank->EditValue = HtmlEncode($this->Rank->CurrentValue);
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
			$curVal = trim(strval($this->ChildWorksheetMaster_Idn->CurrentValue));
			if ($curVal != "")
				$this->ChildWorksheetMaster_Idn->ViewValue = $this->ChildWorksheetMaster_Idn->lookupCacheOption($curVal);
			else
				$this->ChildWorksheetMaster_Idn->ViewValue = $this->ChildWorksheetMaster_Idn->Lookup !== NULL && is_array($this->ChildWorksheetMaster_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->ChildWorksheetMaster_Idn->ViewValue !== NULL) { // Load from cache
				$this->ChildWorksheetMaster_Idn->EditValue = array_values($this->ChildWorksheetMaster_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[WorksheetMaster_Idn]" . SearchString("=", $this->ChildWorksheetMaster_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->ChildWorksheetMaster_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][2] = FormatNumber($arwrk[$i][2], 0, -2, -2, -2);
				}
				$this->ChildWorksheetMaster_Idn->EditValue = $arwrk;
			}

			// Edit refer script
			// WorksheetMaster_Idn

			$this->WorksheetMaster_Idn->LinkCustomAttributes = "";
			$this->WorksheetMaster_Idn->HrefValue = "";

			// WorksheetCategory_Idn
			$this->WorksheetCategory_Idn->LinkCustomAttributes = "";
			$this->WorksheetCategory_Idn->HrefValue = "";

			// Rank
			$this->Rank->LinkCustomAttributes = "";
			$this->Rank->HrefValue = "";

			// AutoLoadFlag
			$this->AutoLoadFlag->LinkCustomAttributes = "";
			$this->AutoLoadFlag->HrefValue = "";

			// LoadFlag
			$this->LoadFlag->LinkCustomAttributes = "";
			$this->LoadFlag->HrefValue = "";

			// AddMiscFlag
			$this->AddMiscFlag->LinkCustomAttributes = "";
			$this->AddMiscFlag->HrefValue = "";

			// ChildWorksheetMaster_Idn
			$this->ChildWorksheetMaster_Idn->LinkCustomAttributes = "";
			$this->ChildWorksheetMaster_Idn->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
		if (!CheckInteger($this->WorksheetMaster_Idn->FormValue)) {
			AddMessage($FormError, $this->WorksheetMaster_Idn->errorMessage());
		}
		if ($this->WorksheetCategory_Idn->Required) {
			if (!$this->WorksheetCategory_Idn->IsDetailKey && $this->WorksheetCategory_Idn->FormValue != NULL && $this->WorksheetCategory_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->WorksheetCategory_Idn->caption(), $this->WorksheetCategory_Idn->RequiredErrorMessage));
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
		if ($this->AutoLoadFlag->Required) {
			if ($this->AutoLoadFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AutoLoadFlag->caption(), $this->AutoLoadFlag->RequiredErrorMessage));
			}
		}
		if ($this->LoadFlag->Required) {
			if ($this->LoadFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LoadFlag->caption(), $this->LoadFlag->RequiredErrorMessage));
			}
		}
		if ($this->AddMiscFlag->Required) {
			if ($this->AddMiscFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AddMiscFlag->caption(), $this->AddMiscFlag->RequiredErrorMessage));
			}
		}
		if ($this->ChildWorksheetMaster_Idn->Required) {
			if (!$this->ChildWorksheetMaster_Idn->IsDetailKey && $this->ChildWorksheetMaster_Idn->FormValue != NULL && $this->ChildWorksheetMaster_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChildWorksheetMaster_Idn->caption(), $this->ChildWorksheetMaster_Idn->RequiredErrorMessage));
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

			// WorksheetMaster_Idn
			$this->WorksheetMaster_Idn->setDbValueDef($rsnew, $this->WorksheetMaster_Idn->CurrentValue, 0, $this->WorksheetMaster_Idn->ReadOnly);

			// WorksheetCategory_Idn
			$this->WorksheetCategory_Idn->setDbValueDef($rsnew, $this->WorksheetCategory_Idn->CurrentValue, 0, $this->WorksheetCategory_Idn->ReadOnly);

			// Rank
			$this->Rank->setDbValueDef($rsnew, $this->Rank->CurrentValue, NULL, $this->Rank->ReadOnly);

			// AutoLoadFlag
			$tmpBool = $this->AutoLoadFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->AutoLoadFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->AutoLoadFlag->ReadOnly);

			// LoadFlag
			$tmpBool = $this->LoadFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->LoadFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->LoadFlag->ReadOnly);

			// AddMiscFlag
			$tmpBool = $this->AddMiscFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->AddMiscFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->AddMiscFlag->ReadOnly);

			// ChildWorksheetMaster_Idn
			$this->ChildWorksheetMaster_Idn->setDbValueDef($rsnew, $this->ChildWorksheetMaster_Idn->CurrentValue, NULL, $this->ChildWorksheetMaster_Idn->ReadOnly);

			// Check referential integrity for master table 'WorksheetMasters'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_WorksheetMasters();
			$keyValue = isset($rsnew['WorksheetMaster_Idn']) ? $rsnew['WorksheetMaster_Idn'] : $rsold['WorksheetMaster_Idn'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@WorksheetMaster_Idn@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["WorksheetMasters"]))
					$GLOBALS["WorksheetMasters"] = new WorksheetMasters();
				$rsmaster = $GLOBALS["WorksheetMasters"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "WorksheetMasters", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER")) ?: Get(Config("TABLE_MASTER"))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "WorksheetMasters") {
				$validMaster = TRUE;
				if (($parm = Get("fk_WorksheetMaster_Idn") ?: Get("WorksheetMaster_Idn")) !== NULL) {
					$GLOBALS["WorksheetMasters"]->WorksheetMaster_Idn->setQueryStringValue($parm);
					$this->WorksheetMaster_Idn->setQueryStringValue($GLOBALS["WorksheetMasters"]->WorksheetMaster_Idn->QueryStringValue);
					$this->WorksheetMaster_Idn->setSessionValue($this->WorksheetMaster_Idn->QueryStringValue);
					if (!is_numeric($GLOBALS["WorksheetMasters"]->WorksheetMaster_Idn->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "WorksheetCategories") {
				$validMaster = TRUE;
				if (($parm = Get("fk_WorksheetCategory_Idn") ?: Get("WorksheetCategory_Idn")) !== NULL) {
					$GLOBALS["WorksheetCategories"]->WorksheetCategory_Idn->setQueryStringValue($parm);
					$this->WorksheetCategory_Idn->setQueryStringValue($GLOBALS["WorksheetCategories"]->WorksheetCategory_Idn->QueryStringValue);
					$this->WorksheetCategory_Idn->setSessionValue($this->WorksheetCategory_Idn->QueryStringValue);
					if (!is_numeric($GLOBALS["WorksheetCategories"]->WorksheetCategory_Idn->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER")) ?: Post(Config("TABLE_MASTER"))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "WorksheetMasters") {
				$validMaster = TRUE;
				if (($parm = Post("fk_WorksheetMaster_Idn") ?: Post("WorksheetMaster_Idn")) !== NULL) {
					$GLOBALS["WorksheetMasters"]->WorksheetMaster_Idn->setFormValue($parm);
					$this->WorksheetMaster_Idn->setFormValue($GLOBALS["WorksheetMasters"]->WorksheetMaster_Idn->FormValue);
					$this->WorksheetMaster_Idn->setSessionValue($this->WorksheetMaster_Idn->FormValue);
					if (!is_numeric($GLOBALS["WorksheetMasters"]->WorksheetMaster_Idn->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "WorksheetCategories") {
				$validMaster = TRUE;
				if (($parm = Post("fk_WorksheetCategory_Idn") ?: Post("WorksheetCategory_Idn")) !== NULL) {
					$GLOBALS["WorksheetCategories"]->WorksheetCategory_Idn->setFormValue($parm);
					$this->WorksheetCategory_Idn->setFormValue($GLOBALS["WorksheetCategories"]->WorksheetCategory_Idn->FormValue);
					$this->WorksheetCategory_Idn->setSessionValue($this->WorksheetCategory_Idn->FormValue);
					if (!is_numeric($GLOBALS["WorksheetCategories"]->WorksheetCategory_Idn->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "WorksheetMasters") {
				if ($this->WorksheetMaster_Idn->CurrentValue == "")
					$this->WorksheetMaster_Idn->setSessionValue("");
			}
			if ($masterTblVar != "WorksheetCategories") {
				if ($this->WorksheetCategory_Idn->CurrentValue == "")
					$this->WorksheetCategory_Idn->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("WorksheetMasterCategorieslist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
				case "x_WorksheetCategory_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_AutoLoadFlag":
					break;
				case "x_LoadFlag":
					break;
				case "x_AddMiscFlag":
					break;
				case "x_ChildWorksheetMaster_Idn":
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
						case "x_WorksheetCategory_Idn":
							break;
						case "x_ChildWorksheetMaster_Idn":
							$row[2] = FormatNumber($row[2], 0, -2, -2, -2);
							$row['df2'] = $row[2];
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
} // End class
?>