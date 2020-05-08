<?php
namespace PHPMaker2020\feapps51;

/**
 * Page class
 */
class JobDefaults_add extends JobDefaults
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}";

	// Table name
	public $TableName = 'JobDefaults';

	// Page object name
	public $PageObjName = "JobDefaults_add";

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

		// Table object (JobDefaults)
		if (!isset($GLOBALS["JobDefaults"]) || get_class($GLOBALS["JobDefaults"]) == PROJECT_NAMESPACE . "JobDefaults") {
			$GLOBALS["JobDefaults"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["JobDefaults"];
		}

		// Table object (v_Administrators)
		if (!isset($GLOBALS['v_Administrators']))
			$GLOBALS['v_Administrators'] = new v_Administrators();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'JobDefaults');

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
		global $JobDefaults;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($JobDefaults);
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
					if ($pageName == "JobDefaultsview.php")
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
			$key .= @$ar['JobDefault_Idn'];
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
			$this->JobDefault_Idn->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("JobDefaultslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->JobDefault_Idn->Visible = FALSE;
		$this->JobDefaultType_Idn->setVisibility();
		$this->Department_Idn->setVisibility();
		$this->ParentJobDefault_Idn->setVisibility();
		$this->Name->setVisibility();
		$this->NumericValue->setVisibility();
		$this->AlphaValue->setVisibility();
		$this->LoadFromJobDefault_Idn->setVisibility();
		$this->Rank->setVisibility();
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
		$this->setupLookupOptions($this->JobDefaultType_Idn);
		$this->setupLookupOptions($this->Department_Idn);
		$this->setupLookupOptions($this->LoadFromJobDefault_Idn);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("JobDefaultslist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("JobDefault_Idn") !== NULL) {
				$this->JobDefault_Idn->setQueryStringValue(Get("JobDefault_Idn"));
				$this->setKey("JobDefault_Idn", $this->JobDefault_Idn->CurrentValue); // Set up key
			} else {
				$this->setKey("JobDefault_Idn", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("JobDefaultslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "JobDefaultslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "JobDefaultsview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->JobDefault_Idn->CurrentValue = NULL;
		$this->JobDefault_Idn->OldValue = $this->JobDefault_Idn->CurrentValue;
		$this->JobDefaultType_Idn->CurrentValue = 0;
		$this->Department_Idn->CurrentValue = 0;
		$this->ParentJobDefault_Idn->CurrentValue = 0;
		$this->Name->CurrentValue = NULL;
		$this->Name->OldValue = $this->Name->CurrentValue;
		$this->NumericValue->CurrentValue = 0;
		$this->AlphaValue->CurrentValue = "NULL";
		$this->LoadFromJobDefault_Idn->CurrentValue = 0;
		$this->Rank->CurrentValue = 0;
		$this->ActiveFlag->CurrentValue = NULL;
		$this->ActiveFlag->OldValue = $this->ActiveFlag->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'JobDefaultType_Idn' first before field var 'x_JobDefaultType_Idn'
		$val = $CurrentForm->hasValue("JobDefaultType_Idn") ? $CurrentForm->getValue("JobDefaultType_Idn") : $CurrentForm->getValue("x_JobDefaultType_Idn");
		if (!$this->JobDefaultType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->JobDefaultType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->JobDefaultType_Idn->setFormValue($val);
		}

		// Check field name 'Department_Idn' first before field var 'x_Department_Idn'
		$val = $CurrentForm->hasValue("Department_Idn") ? $CurrentForm->getValue("Department_Idn") : $CurrentForm->getValue("x_Department_Idn");
		if (!$this->Department_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Department_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Department_Idn->setFormValue($val);
		}

		// Check field name 'ParentJobDefault_Idn' first before field var 'x_ParentJobDefault_Idn'
		$val = $CurrentForm->hasValue("ParentJobDefault_Idn") ? $CurrentForm->getValue("ParentJobDefault_Idn") : $CurrentForm->getValue("x_ParentJobDefault_Idn");
		if (!$this->ParentJobDefault_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ParentJobDefault_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->ParentJobDefault_Idn->setFormValue($val);
		}

		// Check field name 'Name' first before field var 'x_Name'
		$val = $CurrentForm->hasValue("Name") ? $CurrentForm->getValue("Name") : $CurrentForm->getValue("x_Name");
		if (!$this->Name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Name->Visible = FALSE; // Disable update for API request
			else
				$this->Name->setFormValue($val);
		}

		// Check field name 'NumericValue' first before field var 'x_NumericValue'
		$val = $CurrentForm->hasValue("NumericValue") ? $CurrentForm->getValue("NumericValue") : $CurrentForm->getValue("x_NumericValue");
		if (!$this->NumericValue->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->NumericValue->Visible = FALSE; // Disable update for API request
			else
				$this->NumericValue->setFormValue($val);
		}

		// Check field name 'AlphaValue' first before field var 'x_AlphaValue'
		$val = $CurrentForm->hasValue("AlphaValue") ? $CurrentForm->getValue("AlphaValue") : $CurrentForm->getValue("x_AlphaValue");
		if (!$this->AlphaValue->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->AlphaValue->Visible = FALSE; // Disable update for API request
			else
				$this->AlphaValue->setFormValue($val);
		}

		// Check field name 'LoadFromJobDefault_Idn' first before field var 'x_LoadFromJobDefault_Idn'
		$val = $CurrentForm->hasValue("LoadFromJobDefault_Idn") ? $CurrentForm->getValue("LoadFromJobDefault_Idn") : $CurrentForm->getValue("x_LoadFromJobDefault_Idn");
		if (!$this->LoadFromJobDefault_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LoadFromJobDefault_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->LoadFromJobDefault_Idn->setFormValue($val);
		}

		// Check field name 'Rank' first before field var 'x_Rank'
		$val = $CurrentForm->hasValue("Rank") ? $CurrentForm->getValue("Rank") : $CurrentForm->getValue("x_Rank");
		if (!$this->Rank->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Rank->Visible = FALSE; // Disable update for API request
			else
				$this->Rank->setFormValue($val);
		}

		// Check field name 'ActiveFlag' first before field var 'x_ActiveFlag'
		$val = $CurrentForm->hasValue("ActiveFlag") ? $CurrentForm->getValue("ActiveFlag") : $CurrentForm->getValue("x_ActiveFlag");
		if (!$this->ActiveFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ActiveFlag->Visible = FALSE; // Disable update for API request
			else
				$this->ActiveFlag->setFormValue($val);
		}

		// Check field name 'JobDefault_Idn' first before field var 'x_JobDefault_Idn'
		$val = $CurrentForm->hasValue("JobDefault_Idn") ? $CurrentForm->getValue("JobDefault_Idn") : $CurrentForm->getValue("x_JobDefault_Idn");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->JobDefaultType_Idn->CurrentValue = $this->JobDefaultType_Idn->FormValue;
		$this->Department_Idn->CurrentValue = $this->Department_Idn->FormValue;
		$this->ParentJobDefault_Idn->CurrentValue = $this->ParentJobDefault_Idn->FormValue;
		$this->Name->CurrentValue = $this->Name->FormValue;
		$this->NumericValue->CurrentValue = $this->NumericValue->FormValue;
		$this->AlphaValue->CurrentValue = $this->AlphaValue->FormValue;
		$this->LoadFromJobDefault_Idn->CurrentValue = $this->LoadFromJobDefault_Idn->FormValue;
		$this->Rank->CurrentValue = $this->Rank->FormValue;
		$this->ActiveFlag->CurrentValue = $this->ActiveFlag->FormValue;
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
		$this->JobDefault_Idn->setDbValue($row['JobDefault_Idn']);
		$this->JobDefaultType_Idn->setDbValue($row['JobDefaultType_Idn']);
		$this->Department_Idn->setDbValue($row['Department_Idn']);
		$this->ParentJobDefault_Idn->setDbValue($row['ParentJobDefault_Idn']);
		$this->Name->setDbValue($row['Name']);
		$this->NumericValue->setDbValue($row['NumericValue']);
		$this->AlphaValue->setDbValue($row['AlphaValue']);
		$this->LoadFromJobDefault_Idn->setDbValue($row['LoadFromJobDefault_Idn']);
		$this->Rank->setDbValue($row['Rank']);
		$this->ActiveFlag->setDbValue((ConvertToBool($row['ActiveFlag']) ? "1" : "0"));
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['JobDefault_Idn'] = $this->JobDefault_Idn->CurrentValue;
		$row['JobDefaultType_Idn'] = $this->JobDefaultType_Idn->CurrentValue;
		$row['Department_Idn'] = $this->Department_Idn->CurrentValue;
		$row['ParentJobDefault_Idn'] = $this->ParentJobDefault_Idn->CurrentValue;
		$row['Name'] = $this->Name->CurrentValue;
		$row['NumericValue'] = $this->NumericValue->CurrentValue;
		$row['AlphaValue'] = $this->AlphaValue->CurrentValue;
		$row['LoadFromJobDefault_Idn'] = $this->LoadFromJobDefault_Idn->CurrentValue;
		$row['Rank'] = $this->Rank->CurrentValue;
		$row['ActiveFlag'] = $this->ActiveFlag->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("JobDefault_Idn")) != "")
			$this->JobDefault_Idn->OldValue = $this->getKey("JobDefault_Idn"); // JobDefault_Idn
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

		if ($this->NumericValue->FormValue == $this->NumericValue->CurrentValue && is_numeric(ConvertToFloatString($this->NumericValue->CurrentValue)))
			$this->NumericValue->CurrentValue = ConvertToFloatString($this->NumericValue->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// JobDefaultType_Idn
			$this->JobDefaultType_Idn->EditAttrs["class"] = "form-control";
			$this->JobDefaultType_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobDefaultType_Idn->CurrentValue));
			if ($curVal != "")
				$this->JobDefaultType_Idn->ViewValue = $this->JobDefaultType_Idn->lookupCacheOption($curVal);
			else
				$this->JobDefaultType_Idn->ViewValue = $this->JobDefaultType_Idn->Lookup !== NULL && is_array($this->JobDefaultType_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->JobDefaultType_Idn->ViewValue !== NULL) { // Load from cache
				$this->JobDefaultType_Idn->EditValue = array_values($this->JobDefaultType_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[JobDefaultType_Idn]" . SearchString("=", $this->JobDefaultType_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->JobDefaultType_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobDefaultType_Idn->EditValue = $arwrk;
			}

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

			// ParentJobDefault_Idn
			$this->ParentJobDefault_Idn->EditAttrs["class"] = "form-control";
			$this->ParentJobDefault_Idn->EditCustomAttributes = "";
			$this->ParentJobDefault_Idn->EditValue = HtmlEncode($this->ParentJobDefault_Idn->CurrentValue);
			$this->ParentJobDefault_Idn->PlaceHolder = RemoveHtml($this->ParentJobDefault_Idn->caption());

			// Name
			$this->Name->EditAttrs["class"] = "form-control";
			$this->Name->EditCustomAttributes = "";
			if (!$this->Name->Raw)
				$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
			$this->Name->EditValue = HtmlEncode($this->Name->CurrentValue);
			$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

			// NumericValue
			$this->NumericValue->EditAttrs["class"] = "form-control";
			$this->NumericValue->EditCustomAttributes = "";
			$this->NumericValue->EditValue = HtmlEncode($this->NumericValue->CurrentValue);
			$this->NumericValue->PlaceHolder = RemoveHtml($this->NumericValue->caption());
			if (strval($this->NumericValue->EditValue) != "" && is_numeric($this->NumericValue->EditValue))
				$this->NumericValue->EditValue = FormatNumber($this->NumericValue->EditValue, -2, -2, -2, -2);
			

			// AlphaValue
			$this->AlphaValue->EditAttrs["class"] = "form-control";
			$this->AlphaValue->EditCustomAttributes = "";
			if (!$this->AlphaValue->Raw)
				$this->AlphaValue->CurrentValue = HtmlDecode($this->AlphaValue->CurrentValue);
			$this->AlphaValue->EditValue = HtmlEncode($this->AlphaValue->CurrentValue);
			$this->AlphaValue->PlaceHolder = RemoveHtml($this->AlphaValue->caption());

			// LoadFromJobDefault_Idn
			$this->LoadFromJobDefault_Idn->EditAttrs["class"] = "form-control";
			$this->LoadFromJobDefault_Idn->EditCustomAttributes = "";
			$curVal = trim(strval($this->LoadFromJobDefault_Idn->CurrentValue));
			if ($curVal != "")
				$this->LoadFromJobDefault_Idn->ViewValue = $this->LoadFromJobDefault_Idn->lookupCacheOption($curVal);
			else
				$this->LoadFromJobDefault_Idn->ViewValue = $this->LoadFromJobDefault_Idn->Lookup !== NULL && is_array($this->LoadFromJobDefault_Idn->Lookup->Options) ? $curVal : NULL;
			if ($this->LoadFromJobDefault_Idn->ViewValue !== NULL) { // Load from cache
				$this->LoadFromJobDefault_Idn->EditValue = array_values($this->LoadFromJobDefault_Idn->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "[JobDefault_Idn]" . SearchString("=", $this->LoadFromJobDefault_Idn->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "[ActiveFlag] = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->LoadFromJobDefault_Idn->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LoadFromJobDefault_Idn->EditValue = $arwrk;
			}

			// Rank
			$this->Rank->EditAttrs["class"] = "form-control";
			$this->Rank->EditCustomAttributes = "";
			$this->Rank->EditValue = HtmlEncode($this->Rank->CurrentValue);
			$this->Rank->PlaceHolder = RemoveHtml($this->Rank->caption());

			// ActiveFlag
			$this->ActiveFlag->EditCustomAttributes = "";
			$this->ActiveFlag->EditValue = $this->ActiveFlag->options(FALSE);

			// Add refer script
			// JobDefaultType_Idn

			$this->JobDefaultType_Idn->LinkCustomAttributes = "";
			$this->JobDefaultType_Idn->HrefValue = "";

			// Department_Idn
			$this->Department_Idn->LinkCustomAttributes = "";
			$this->Department_Idn->HrefValue = "";

			// ParentJobDefault_Idn
			$this->ParentJobDefault_Idn->LinkCustomAttributes = "";
			$this->ParentJobDefault_Idn->HrefValue = "";

			// Name
			$this->Name->LinkCustomAttributes = "";
			$this->Name->HrefValue = "";

			// NumericValue
			$this->NumericValue->LinkCustomAttributes = "";
			$this->NumericValue->HrefValue = "";

			// AlphaValue
			$this->AlphaValue->LinkCustomAttributes = "";
			$this->AlphaValue->HrefValue = "";

			// LoadFromJobDefault_Idn
			$this->LoadFromJobDefault_Idn->LinkCustomAttributes = "";
			$this->LoadFromJobDefault_Idn->HrefValue = "";

			// Rank
			$this->Rank->LinkCustomAttributes = "";
			$this->Rank->HrefValue = "";

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
		if ($this->JobDefaultType_Idn->Required) {
			if (!$this->JobDefaultType_Idn->IsDetailKey && $this->JobDefaultType_Idn->FormValue != NULL && $this->JobDefaultType_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->JobDefaultType_Idn->caption(), $this->JobDefaultType_Idn->RequiredErrorMessage));
			}
		}
		if ($this->Department_Idn->Required) {
			if (!$this->Department_Idn->IsDetailKey && $this->Department_Idn->FormValue != NULL && $this->Department_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Department_Idn->caption(), $this->Department_Idn->RequiredErrorMessage));
			}
		}
		if ($this->ParentJobDefault_Idn->Required) {
			if (!$this->ParentJobDefault_Idn->IsDetailKey && $this->ParentJobDefault_Idn->FormValue != NULL && $this->ParentJobDefault_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ParentJobDefault_Idn->caption(), $this->ParentJobDefault_Idn->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ParentJobDefault_Idn->FormValue)) {
			AddMessage($FormError, $this->ParentJobDefault_Idn->errorMessage());
		}
		if ($this->Name->Required) {
			if (!$this->Name->IsDetailKey && $this->Name->FormValue != NULL && $this->Name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Name->caption(), $this->Name->RequiredErrorMessage));
			}
		}
		if ($this->NumericValue->Required) {
			if (!$this->NumericValue->IsDetailKey && $this->NumericValue->FormValue != NULL && $this->NumericValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NumericValue->caption(), $this->NumericValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->NumericValue->FormValue)) {
			AddMessage($FormError, $this->NumericValue->errorMessage());
		}
		if ($this->AlphaValue->Required) {
			if (!$this->AlphaValue->IsDetailKey && $this->AlphaValue->FormValue != NULL && $this->AlphaValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AlphaValue->caption(), $this->AlphaValue->RequiredErrorMessage));
			}
		}
		if ($this->LoadFromJobDefault_Idn->Required) {
			if (!$this->LoadFromJobDefault_Idn->IsDetailKey && $this->LoadFromJobDefault_Idn->FormValue != NULL && $this->LoadFromJobDefault_Idn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LoadFromJobDefault_Idn->caption(), $this->LoadFromJobDefault_Idn->RequiredErrorMessage));
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

		// JobDefaultType_Idn
		$this->JobDefaultType_Idn->setDbValueDef($rsnew, $this->JobDefaultType_Idn->CurrentValue, NULL, strval($this->JobDefaultType_Idn->CurrentValue) == "");

		// Department_Idn
		$this->Department_Idn->setDbValueDef($rsnew, $this->Department_Idn->CurrentValue, NULL, strval($this->Department_Idn->CurrentValue) == "");

		// ParentJobDefault_Idn
		$this->ParentJobDefault_Idn->setDbValueDef($rsnew, $this->ParentJobDefault_Idn->CurrentValue, NULL, strval($this->ParentJobDefault_Idn->CurrentValue) == "");

		// Name
		$this->Name->setDbValueDef($rsnew, $this->Name->CurrentValue, NULL, strval($this->Name->CurrentValue) == "");

		// NumericValue
		$this->NumericValue->setDbValueDef($rsnew, $this->NumericValue->CurrentValue, NULL, strval($this->NumericValue->CurrentValue) == "");

		// AlphaValue
		$this->AlphaValue->setDbValueDef($rsnew, $this->AlphaValue->CurrentValue, NULL, strval($this->AlphaValue->CurrentValue) == "");

		// LoadFromJobDefault_Idn
		$this->LoadFromJobDefault_Idn->setDbValueDef($rsnew, $this->LoadFromJobDefault_Idn->CurrentValue, NULL, strval($this->LoadFromJobDefault_Idn->CurrentValue) == "");

		// Rank
		$this->Rank->setDbValueDef($rsnew, $this->Rank->CurrentValue, NULL, strval($this->Rank->CurrentValue) == "");

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("JobDefaultslist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
				case "x_JobDefaultType_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_Department_Idn":
					break;
				case "x_LoadFromJobDefault_Idn":
					$lookupFilter = function() {
						return "[ActiveFlag] = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
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
						case "x_JobDefaultType_Idn":
							break;
						case "x_Department_Idn":
							break;
						case "x_LoadFromJobDefault_Idn":
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