<?php
namespace PHPMaker2020\feapps51;

/**
 * Page class
 */
class WorksheetCategories_edit extends WorksheetCategories
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}";

	// Table name
	public $TableName = 'WorksheetCategories';

	// Page object name
	public $PageObjName = "WorksheetCategories_edit";

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

		// Table object (WorksheetCategories)
		if (!isset($GLOBALS["WorksheetCategories"]) || get_class($GLOBALS["WorksheetCategories"]) == PROJECT_NAMESPACE . "WorksheetCategories") {
			$GLOBALS["WorksheetCategories"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["WorksheetCategories"];
		}

		// Table object (v_Administrators)
		if (!isset($GLOBALS['v_Administrators']))
			$GLOBALS['v_Administrators'] = new v_Administrators();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'WorksheetCategories');

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
		global $WorksheetCategories;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($WorksheetCategories);
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
					if ($pageName == "WorksheetCategoriesview.php")
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->WorksheetCategory_Idn->Visible = FALSE;
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
					$this->terminate(GetUrl("WorksheetCategorieslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->WorksheetCategory_Idn->setVisibility();
		$this->Name->setVisibility();
		$this->ShortName->setVisibility();
		$this->Department_Idn->setVisibility();
		$this->FieldUnitPrice->setVisibility();
		$this->IsFitting->setVisibility();
		$this->CartFlag->setVisibility();
		$this->IsShared->setVisibility();
		$this->IsAssembly->setVisibility();
		$this->ActiveFlag->setVisibility();
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
		$this->setupLookupOptions($this->Department_Idn);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("WorksheetCategorieslist.php");
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
			if (Get("WorksheetCategory_Idn") !== NULL) {
				$this->WorksheetCategory_Idn->setQueryStringValue(Get("WorksheetCategory_Idn"));
				$this->WorksheetCategory_Idn->setOldValue($this->WorksheetCategory_Idn->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->WorksheetCategory_Idn->setQueryStringValue(Key(0));
				$this->WorksheetCategory_Idn->setOldValue($this->WorksheetCategory_Idn->QueryStringValue);
			} elseif (Post("WorksheetCategory_Idn") !== NULL) {
				$this->WorksheetCategory_Idn->setFormValue(Post("WorksheetCategory_Idn"));
				$this->WorksheetCategory_Idn->setOldValue($this->WorksheetCategory_Idn->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->WorksheetCategory_Idn->setQueryStringValue(Route(2));
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
				if ($CurrentForm->hasValue("x_WorksheetCategory_Idn")) {
					$this->WorksheetCategory_Idn->setFormValue($CurrentForm->getValue("x_WorksheetCategory_Idn"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("WorksheetCategory_Idn") !== NULL) {
					$this->WorksheetCategory_Idn->setQueryStringValue(Get("WorksheetCategory_Idn"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->WorksheetCategory_Idn->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->WorksheetCategory_Idn->CurrentValue = NULL;
				}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
			}

			// Load recordset
			$this->StartRecord = 1; // Initialize start position
			if ($rs = $this->loadRecordset()) // Load records
				$this->TotalRecords = $rs->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found
				if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
					$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate("WorksheetCategorieslist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->WorksheetCategory_Idn->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->WorksheetCategory_Idn->CurrentValue, $rs->fields('WorksheetCategory_Idn'))) {
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

			// Set up detail parameters
			$this->setupDetailParms();
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
					$this->terminate("WorksheetCategorieslist.php"); // Return to list page
				} else {
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "WorksheetCategorieslist.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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

		// Check field name 'WorksheetCategory_Idn' first before field var 'x_WorksheetCategory_Idn'
		$val = $CurrentForm->hasValue("WorksheetCategory_Idn") ? $CurrentForm->getValue("WorksheetCategory_Idn") : $CurrentForm->getValue("x_WorksheetCategory_Idn");
		if (!$this->WorksheetCategory_Idn->IsDetailKey)
			$this->WorksheetCategory_Idn->setFormValue($val);

		// Check field name 'Name' first before field var 'x_Name'
		$val = $CurrentForm->hasValue("Name") ? $CurrentForm->getValue("Name") : $CurrentForm->getValue("x_Name");
		if (!$this->Name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Name->Visible = FALSE; // Disable update for API request
			else
				$this->Name->setFormValue($val);
		}

		// Check field name 'ShortName' first before field var 'x_ShortName'
		$val = $CurrentForm->hasValue("ShortName") ? $CurrentForm->getValue("ShortName") : $CurrentForm->getValue("x_ShortName");
		if (!$this->ShortName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ShortName->Visible = FALSE; // Disable update for API request
			else
				$this->ShortName->setFormValue($val);
		}

		// Check field name 'Department_Idn' first before field var 'x_Department_Idn'
		$val = $CurrentForm->hasValue("Department_Idn") ? $CurrentForm->getValue("Department_Idn") : $CurrentForm->getValue("x_Department_Idn");
		if (!$this->Department_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Department_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Department_Idn->setFormValue($val);
		}

		// Check field name 'FieldUnitPrice' first before field var 'x_FieldUnitPrice'
		$val = $CurrentForm->hasValue("FieldUnitPrice") ? $CurrentForm->getValue("FieldUnitPrice") : $CurrentForm->getValue("x_FieldUnitPrice");
		if (!$this->FieldUnitPrice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FieldUnitPrice->Visible = FALSE; // Disable update for API request
			else
				$this->FieldUnitPrice->setFormValue($val);
		}

		// Check field name 'IsFitting' first before field var 'x_IsFitting'
		$val = $CurrentForm->hasValue("IsFitting") ? $CurrentForm->getValue("IsFitting") : $CurrentForm->getValue("x_IsFitting");
		if (!$this->IsFitting->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsFitting->Visible = FALSE; // Disable update for API request
			else
				$this->IsFitting->setFormValue($val);
		}

		// Check field name 'CartFlag' first before field var 'x_CartFlag'
		$val = $CurrentForm->hasValue("CartFlag") ? $CurrentForm->getValue("CartFlag") : $CurrentForm->getValue("x_CartFlag");
		if (!$this->CartFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CartFlag->Visible = FALSE; // Disable update for API request
			else
				$this->CartFlag->setFormValue($val);
		}

		// Check field name 'IsShared' first before field var 'x_IsShared'
		$val = $CurrentForm->hasValue("IsShared") ? $CurrentForm->getValue("IsShared") : $CurrentForm->getValue("x_IsShared");
		if (!$this->IsShared->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsShared->Visible = FALSE; // Disable update for API request
			else
				$this->IsShared->setFormValue($val);
		}

		// Check field name 'IsAssembly' first before field var 'x_IsAssembly'
		$val = $CurrentForm->hasValue("IsAssembly") ? $CurrentForm->getValue("IsAssembly") : $CurrentForm->getValue("x_IsAssembly");
		if (!$this->IsAssembly->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsAssembly->Visible = FALSE; // Disable update for API request
			else
				$this->IsAssembly->setFormValue($val);
		}

		// Check field name 'ActiveFlag' first before field var 'x_ActiveFlag'
		$val = $CurrentForm->hasValue("ActiveFlag") ? $CurrentForm->getValue("ActiveFlag") : $CurrentForm->getValue("x_ActiveFlag");
		if (!$this->ActiveFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ActiveFlag->Visible = FALSE; // Disable update for API request
			else
				$this->ActiveFlag->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->WorksheetCategory_Idn->CurrentValue = $this->WorksheetCategory_Idn->FormValue;
		$this->Name->CurrentValue = $this->Name->FormValue;
		$this->ShortName->CurrentValue = $this->ShortName->FormValue;
		$this->Department_Idn->CurrentValue = $this->Department_Idn->FormValue;
		$this->FieldUnitPrice->CurrentValue = $this->FieldUnitPrice->FormValue;
		$this->IsFitting->CurrentValue = $this->IsFitting->FormValue;
		$this->CartFlag->CurrentValue = $this->CartFlag->FormValue;
		$this->IsShared->CurrentValue = $this->IsShared->FormValue;
		$this->IsAssembly->CurrentValue = $this->IsAssembly->FormValue;
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
		$this->WorksheetCategory_Idn->setDbValue($row['WorksheetCategory_Idn']);
		$this->Name->setDbValue($row['Name']);
		$this->ShortName->setDbValue($row['ShortName']);
		$this->Department_Idn->setDbValue($row['Department_Idn']);
		$this->FieldUnitPrice->setDbValue($row['FieldUnitPrice']);
		$this->IsFitting->setDbValue((ConvertToBool($row['IsFitting']) ? "1" : "0"));
		$this->CartFlag->setDbValue((ConvertToBool($row['CartFlag']) ? "1" : "0"));
		$this->IsShared->setDbValue((ConvertToBool($row['IsShared']) ? "1" : "0"));
		$this->IsAssembly->setDbValue((ConvertToBool($row['IsAssembly']) ? "1" : "0"));
		$this->ActiveFlag->setDbValue((ConvertToBool($row['ActiveFlag']) ? "1" : "0"));
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['WorksheetCategory_Idn'] = NULL;
		$row['Name'] = NULL;
		$row['ShortName'] = NULL;
		$row['Department_Idn'] = NULL;
		$row['FieldUnitPrice'] = NULL;
		$row['IsFitting'] = NULL;
		$row['CartFlag'] = NULL;
		$row['IsShared'] = NULL;
		$row['IsAssembly'] = NULL;
		$row['ActiveFlag'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
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
		// Convert decimal values if posted back

		if ($this->FieldUnitPrice->FormValue == $this->FieldUnitPrice->CurrentValue && is_numeric(ConvertToFloatString($this->FieldUnitPrice->CurrentValue)))
			$this->FieldUnitPrice->CurrentValue = ConvertToFloatString($this->FieldUnitPrice->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// WorksheetCategory_Idn
		// Name
		// ShortName
		// Department_Idn
		// FieldUnitPrice
		// IsFitting
		// CartFlag
		// IsShared
		// IsAssembly
		// ActiveFlag

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// WorksheetCategory_Idn
			$this->WorksheetCategory_Idn->ViewValue = $this->WorksheetCategory_Idn->CurrentValue;
			$this->WorksheetCategory_Idn->ViewCustomAttributes = "";

			// Name
			$this->Name->ViewValue = $this->Name->CurrentValue;
			$this->Name->ViewCustomAttributes = "";

			// ShortName
			$this->ShortName->ViewValue = $this->ShortName->CurrentValue;
			$this->ShortName->ViewCustomAttributes = "";

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

			// Department_Idn
			$this->Department_Idn->LinkCustomAttributes = "";
			$this->Department_Idn->HrefValue = "";
			$this->Department_Idn->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// WorksheetCategory_Idn
			$this->WorksheetCategory_Idn->EditAttrs["class"] = "form-control";
			$this->WorksheetCategory_Idn->EditCustomAttributes = "";
			$this->WorksheetCategory_Idn->EditValue = $this->WorksheetCategory_Idn->CurrentValue;
			$this->WorksheetCategory_Idn->ViewCustomAttributes = "";

			// Name
			$this->Name->EditAttrs["class"] = "form-control";
			$this->Name->EditCustomAttributes = "";
			if (!$this->Name->Raw)
				$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
			$this->Name->EditValue = HtmlEncode($this->Name->CurrentValue);
			$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

			// ShortName
			$this->ShortName->EditAttrs["class"] = "form-control";
			$this->ShortName->EditCustomAttributes = "";
			if (!$this->ShortName->Raw)
				$this->ShortName->CurrentValue = HtmlDecode($this->ShortName->CurrentValue);
			$this->ShortName->EditValue = HtmlEncode($this->ShortName->CurrentValue);
			$this->ShortName->PlaceHolder = RemoveHtml($this->ShortName->caption());

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

			// FieldUnitPrice
			$this->FieldUnitPrice->EditAttrs["class"] = "form-control";
			$this->FieldUnitPrice->EditCustomAttributes = "";
			$this->FieldUnitPrice->EditValue = HtmlEncode($this->FieldUnitPrice->CurrentValue);
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

			// Edit refer script
			// WorksheetCategory_Idn

			$this->WorksheetCategory_Idn->LinkCustomAttributes = "";
			$this->WorksheetCategory_Idn->HrefValue = "";

			// Name
			$this->Name->LinkCustomAttributes = "";
			$this->Name->HrefValue = "";

			// ShortName
			$this->ShortName->LinkCustomAttributes = "";
			$this->ShortName->HrefValue = "";

			// Department_Idn
			$this->Department_Idn->LinkCustomAttributes = "";
			$this->Department_Idn->HrefValue = "";

			// FieldUnitPrice
			$this->FieldUnitPrice->LinkCustomAttributes = "";
			$this->FieldUnitPrice->HrefValue = "";

			// IsFitting
			$this->IsFitting->LinkCustomAttributes = "";
			$this->IsFitting->HrefValue = "";

			// CartFlag
			$this->CartFlag->LinkCustomAttributes = "";
			$this->CartFlag->HrefValue = "";

			// IsShared
			$this->IsShared->LinkCustomAttributes = "";
			$this->IsShared->HrefValue = "";

			// IsAssembly
			$this->IsAssembly->LinkCustomAttributes = "";
			$this->IsAssembly->HrefValue = "";

			// ActiveFlag
			$this->ActiveFlag->LinkCustomAttributes = "";
			$this->ActiveFlag->HrefValue = "";
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
		if ($this->WorksheetCategory_Idn->Required) {
			if (!$this->WorksheetCategory_Idn->IsDetailKey && $this->WorksheetCategory_Idn->FormValue != NULL && $this->WorksheetCategory_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->WorksheetCategory_Idn->caption(), $this->WorksheetCategory_Idn->RequiredErrorMessage));
			}
		}
		if ($this->Name->Required) {
			if (!$this->Name->IsDetailKey && $this->Name->FormValue != NULL && $this->Name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Name->caption(), $this->Name->RequiredErrorMessage));
			}
		}
		if ($this->ShortName->Required) {
			if (!$this->ShortName->IsDetailKey && $this->ShortName->FormValue != NULL && $this->ShortName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ShortName->caption(), $this->ShortName->RequiredErrorMessage));
			}
		}
		if ($this->Department_Idn->Required) {
			if (!$this->Department_Idn->IsDetailKey && $this->Department_Idn->FormValue != NULL && $this->Department_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Department_Idn->caption(), $this->Department_Idn->RequiredErrorMessage));
			}
		}
		if ($this->FieldUnitPrice->Required) {
			if (!$this->FieldUnitPrice->IsDetailKey && $this->FieldUnitPrice->FormValue != NULL && $this->FieldUnitPrice->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FieldUnitPrice->caption(), $this->FieldUnitPrice->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->FieldUnitPrice->FormValue)) {
			AddMessage($FormError, $this->FieldUnitPrice->errorMessage());
		}
		if ($this->IsFitting->Required) {
			if ($this->IsFitting->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IsFitting->caption(), $this->IsFitting->RequiredErrorMessage));
			}
		}
		if ($this->CartFlag->Required) {
			if ($this->CartFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CartFlag->caption(), $this->CartFlag->RequiredErrorMessage));
			}
		}
		if ($this->IsShared->Required) {
			if ($this->IsShared->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IsShared->caption(), $this->IsShared->RequiredErrorMessage));
			}
		}
		if ($this->IsAssembly->Required) {
			if ($this->IsAssembly->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IsAssembly->caption(), $this->IsAssembly->RequiredErrorMessage));
			}
		}
		if ($this->ActiveFlag->Required) {
			if ($this->ActiveFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActiveFlag->caption(), $this->ActiveFlag->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("WorksheetMasterCategories", $detailTblVar) && $GLOBALS["WorksheetMasterCategories"]->DetailEdit) {
			if (!isset($GLOBALS["WorksheetMasterCategories_grid"]))
				$GLOBALS["WorksheetMasterCategories_grid"] = new WorksheetMasterCategories_grid(); // Get detail page object
			$GLOBALS["WorksheetMasterCategories_grid"]->validateGridForm();
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

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// Name
			$this->Name->setDbValueDef($rsnew, $this->Name->CurrentValue, NULL, $this->Name->ReadOnly);

			// ShortName
			$this->ShortName->setDbValueDef($rsnew, $this->ShortName->CurrentValue, NULL, $this->ShortName->ReadOnly);

			// Department_Idn
			$this->Department_Idn->setDbValueDef($rsnew, $this->Department_Idn->CurrentValue, NULL, $this->Department_Idn->ReadOnly);

			// FieldUnitPrice
			$this->FieldUnitPrice->setDbValueDef($rsnew, $this->FieldUnitPrice->CurrentValue, NULL, $this->FieldUnitPrice->ReadOnly);

			// IsFitting
			$tmpBool = $this->IsFitting->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->IsFitting->setDbValueDef($rsnew, $tmpBool, NULL, $this->IsFitting->ReadOnly);

			// CartFlag
			$tmpBool = $this->CartFlag->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->CartFlag->setDbValueDef($rsnew, $tmpBool, NULL, $this->CartFlag->ReadOnly);

			// IsShared
			$tmpBool = $this->IsShared->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->IsShared->setDbValueDef($rsnew, $tmpBool, NULL, $this->IsShared->ReadOnly);

			// IsAssembly
			$tmpBool = $this->IsAssembly->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->IsAssembly->setDbValueDef($rsnew, $tmpBool, NULL, $this->IsAssembly->ReadOnly);

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

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("WorksheetMasterCategories", $detailTblVar) && $GLOBALS["WorksheetMasterCategories"]->DetailEdit) {
						if (!isset($GLOBALS["WorksheetMasterCategories_grid"]))
							$GLOBALS["WorksheetMasterCategories_grid"] = new WorksheetMasterCategories_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "WorksheetMasterCategories"); // Load user level of detail table
						$editRow = $GLOBALS["WorksheetMasterCategories_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
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

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("WorksheetMasterCategories", $detailTblVar)) {
				if (!isset($GLOBALS["WorksheetMasterCategories_grid"]))
					$GLOBALS["WorksheetMasterCategories_grid"] = new WorksheetMasterCategories_grid();
				if ($GLOBALS["WorksheetMasterCategories_grid"]->DetailEdit) {
					$GLOBALS["WorksheetMasterCategories_grid"]->CurrentMode = "edit";
					$GLOBALS["WorksheetMasterCategories_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["WorksheetMasterCategories_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["WorksheetMasterCategories_grid"]->setStartRecordNumber(1);
					$GLOBALS["WorksheetMasterCategories_grid"]->WorksheetCategory_Idn->IsDetailKey = TRUE;
					$GLOBALS["WorksheetMasterCategories_grid"]->WorksheetCategory_Idn->CurrentValue = $this->WorksheetCategory_Idn->CurrentValue;
					$GLOBALS["WorksheetMasterCategories_grid"]->WorksheetCategory_Idn->setSessionValue($GLOBALS["WorksheetMasterCategories_grid"]->WorksheetCategory_Idn->CurrentValue);
					$GLOBALS["WorksheetMasterCategories_grid"]->WorksheetMaster_Idn->setSessionValue(""); // Clear session key
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("WorksheetCategorieslist.php"), "", $this->TableVar, TRUE);
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
				case "x_Department_Idn":
					break;
				case "x_IsFitting":
					break;
				case "x_CartFlag":
					break;
				case "x_IsShared":
					break;
				case "x_IsAssembly":
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
} // End class
?>