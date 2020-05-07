<?php
namespace PHPMaker2020\feapps51;

/**
 * Page class
 */
class WorksheetMasters_add extends WorksheetMasters
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}";

	// Table name
	public $TableName = 'WorksheetMasters';

	// Page object name
	public $PageObjName = "WorksheetMasters_add";

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

		// Table object (v_Administrators)
		if (!isset($GLOBALS['v_Administrators']))
			$GLOBALS['v_Administrators'] = new v_Administrators();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "WorksheetMastersview.php")
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
					$this->terminate(GetUrl("WorksheetMasterslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->WorksheetMaster_Idn->Visible = FALSE;
		$this->Name->setVisibility();
		$this->Department_Idn->setVisibility();
		$this->Rank->setVisibility();
		$this->NumberOfColumns->setVisibility();
		$this->AllowMultiple->setVisibility();
		$this->DisplayAdjustmentFactors->setVisibility();
		$this->DisplayWorksheetDetails->setVisibility();
		$this->DisplayShopFabrication->setVisibility();
		$this->DisplayWorksheetName->setVisibility();
		$this->DisplayWorksheetHeader->setVisibility();
		$this->UseRadioButtonsForSizes->setVisibility();
		$this->DisplayFieldHoursOverride->setVisibility();
		$this->DisplayShopHours->setVisibility();
		$this->DisplayShopHoursOverride->setVisibility();
		$this->DisplayUserShopHoursOnly->setVisibility();
		$this->DisplayPipeExposure->setVisibility();
		$this->DisplayVolumeCorrection->setVisibility();
		$this->DisplayManhourAdjustment->setVisibility();
		$this->IsSubcontractWorksheet->setVisibility();
		$this->DisplayDeleteItemsButtons->setVisibility();
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
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("WorksheetMasterslist.php");
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
			if (Get("WorksheetMaster_Idn") !== NULL) {
				$this->WorksheetMaster_Idn->setQueryStringValue(Get("WorksheetMaster_Idn"));
				$this->setKey("WorksheetMaster_Idn", $this->WorksheetMaster_Idn->CurrentValue); // Set up key
			} else {
				$this->setKey("WorksheetMaster_Idn", ""); // Clear key
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

		// Set up detail parameters
		$this->setupDetailParms();

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
					$this->terminate("WorksheetMasterslist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() != "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "WorksheetMasterslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "WorksheetMastersview.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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
		$this->WorksheetMaster_Idn->CurrentValue = NULL;
		$this->WorksheetMaster_Idn->OldValue = $this->WorksheetMaster_Idn->CurrentValue;
		$this->Name->CurrentValue = "NULL";
		$this->Department_Idn->CurrentValue = 0;
		$this->Rank->CurrentValue = 0;
		$this->NumberOfColumns->CurrentValue = 0;
		$this->AllowMultiple->CurrentValue = 0;
		$this->DisplayAdjustmentFactors->CurrentValue = 0;
		$this->DisplayWorksheetDetails->CurrentValue = 0;
		$this->DisplayShopFabrication->CurrentValue = 0;
		$this->DisplayWorksheetName->CurrentValue = 1;
		$this->DisplayWorksheetHeader->CurrentValue = 1;
		$this->UseRadioButtonsForSizes->CurrentValue = 0;
		$this->DisplayFieldHoursOverride->CurrentValue = 0;
		$this->DisplayShopHours->CurrentValue = 0;
		$this->DisplayShopHoursOverride->CurrentValue = 0;
		$this->DisplayUserShopHoursOnly->CurrentValue = 0;
		$this->DisplayPipeExposure->CurrentValue = 0;
		$this->DisplayVolumeCorrection->CurrentValue = 0;
		$this->DisplayManhourAdjustment->CurrentValue = 0;
		$this->IsSubcontractWorksheet->CurrentValue = 0;
		$this->DisplayDeleteItemsButtons->CurrentValue = 1;
		$this->ActiveFlag->CurrentValue = 1;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'Name' first before field var 'x_Name'
		$val = $CurrentForm->hasValue("Name") ? $CurrentForm->getValue("Name") : $CurrentForm->getValue("x_Name");
		if (!$this->Name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Name->Visible = FALSE; // Disable update for API request
			else
				$this->Name->setFormValue($val);
		}

		// Check field name 'Department_Idn' first before field var 'x_Department_Idn'
		$val = $CurrentForm->hasValue("Department_Idn") ? $CurrentForm->getValue("Department_Idn") : $CurrentForm->getValue("x_Department_Idn");
		if (!$this->Department_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Department_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Department_Idn->setFormValue($val);
		}

		// Check field name 'Rank' first before field var 'x_Rank'
		$val = $CurrentForm->hasValue("Rank") ? $CurrentForm->getValue("Rank") : $CurrentForm->getValue("x_Rank");
		if (!$this->Rank->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Rank->Visible = FALSE; // Disable update for API request
			else
				$this->Rank->setFormValue($val);
		}

		// Check field name 'NumberOfColumns' first before field var 'x_NumberOfColumns'
		$val = $CurrentForm->hasValue("NumberOfColumns") ? $CurrentForm->getValue("NumberOfColumns") : $CurrentForm->getValue("x_NumberOfColumns");
		if (!$this->NumberOfColumns->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->NumberOfColumns->Visible = FALSE; // Disable update for API request
			else
				$this->NumberOfColumns->setFormValue($val);
		}

		// Check field name 'AllowMultiple' first before field var 'x_AllowMultiple'
		$val = $CurrentForm->hasValue("AllowMultiple") ? $CurrentForm->getValue("AllowMultiple") : $CurrentForm->getValue("x_AllowMultiple");
		if (!$this->AllowMultiple->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->AllowMultiple->Visible = FALSE; // Disable update for API request
			else
				$this->AllowMultiple->setFormValue($val);
		}

		// Check field name 'DisplayAdjustmentFactors' first before field var 'x_DisplayAdjustmentFactors'
		$val = $CurrentForm->hasValue("DisplayAdjustmentFactors") ? $CurrentForm->getValue("DisplayAdjustmentFactors") : $CurrentForm->getValue("x_DisplayAdjustmentFactors");
		if (!$this->DisplayAdjustmentFactors->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayAdjustmentFactors->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayAdjustmentFactors->setFormValue($val);
		}

		// Check field name 'DisplayWorksheetDetails' first before field var 'x_DisplayWorksheetDetails'
		$val = $CurrentForm->hasValue("DisplayWorksheetDetails") ? $CurrentForm->getValue("DisplayWorksheetDetails") : $CurrentForm->getValue("x_DisplayWorksheetDetails");
		if (!$this->DisplayWorksheetDetails->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayWorksheetDetails->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayWorksheetDetails->setFormValue($val);
		}

		// Check field name 'DisplayShopFabrication' first before field var 'x_DisplayShopFabrication'
		$val = $CurrentForm->hasValue("DisplayShopFabrication") ? $CurrentForm->getValue("DisplayShopFabrication") : $CurrentForm->getValue("x_DisplayShopFabrication");
		if (!$this->DisplayShopFabrication->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayShopFabrication->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayShopFabrication->setFormValue($val);
		}

		// Check field name 'DisplayWorksheetName' first before field var 'x_DisplayWorksheetName'
		$val = $CurrentForm->hasValue("DisplayWorksheetName") ? $CurrentForm->getValue("DisplayWorksheetName") : $CurrentForm->getValue("x_DisplayWorksheetName");
		if (!$this->DisplayWorksheetName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayWorksheetName->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayWorksheetName->setFormValue($val);
		}

		// Check field name 'DisplayWorksheetHeader' first before field var 'x_DisplayWorksheetHeader'
		$val = $CurrentForm->hasValue("DisplayWorksheetHeader") ? $CurrentForm->getValue("DisplayWorksheetHeader") : $CurrentForm->getValue("x_DisplayWorksheetHeader");
		if (!$this->DisplayWorksheetHeader->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayWorksheetHeader->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayWorksheetHeader->setFormValue($val);
		}

		// Check field name 'UseRadioButtonsForSizes' first before field var 'x_UseRadioButtonsForSizes'
		$val = $CurrentForm->hasValue("UseRadioButtonsForSizes") ? $CurrentForm->getValue("UseRadioButtonsForSizes") : $CurrentForm->getValue("x_UseRadioButtonsForSizes");
		if (!$this->UseRadioButtonsForSizes->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->UseRadioButtonsForSizes->Visible = FALSE; // Disable update for API request
			else
				$this->UseRadioButtonsForSizes->setFormValue($val);
		}

		// Check field name 'DisplayFieldHoursOverride' first before field var 'x_DisplayFieldHoursOverride'
		$val = $CurrentForm->hasValue("DisplayFieldHoursOverride") ? $CurrentForm->getValue("DisplayFieldHoursOverride") : $CurrentForm->getValue("x_DisplayFieldHoursOverride");
		if (!$this->DisplayFieldHoursOverride->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayFieldHoursOverride->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayFieldHoursOverride->setFormValue($val);
		}

		// Check field name 'DisplayShopHours' first before field var 'x_DisplayShopHours'
		$val = $CurrentForm->hasValue("DisplayShopHours") ? $CurrentForm->getValue("DisplayShopHours") : $CurrentForm->getValue("x_DisplayShopHours");
		if (!$this->DisplayShopHours->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayShopHours->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayShopHours->setFormValue($val);
		}

		// Check field name 'DisplayShopHoursOverride' first before field var 'x_DisplayShopHoursOverride'
		$val = $CurrentForm->hasValue("DisplayShopHoursOverride") ? $CurrentForm->getValue("DisplayShopHoursOverride") : $CurrentForm->getValue("x_DisplayShopHoursOverride");
		if (!$this->DisplayShopHoursOverride->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayShopHoursOverride->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayShopHoursOverride->setFormValue($val);
		}

		// Check field name 'DisplayUserShopHoursOnly' first before field var 'x_DisplayUserShopHoursOnly'
		$val = $CurrentForm->hasValue("DisplayUserShopHoursOnly") ? $CurrentForm->getValue("DisplayUserShopHoursOnly") : $CurrentForm->getValue("x_DisplayUserShopHoursOnly");
		if (!$this->DisplayUserShopHoursOnly->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayUserShopHoursOnly->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayUserShopHoursOnly->setFormValue($val);
		}

		// Check field name 'DisplayPipeExposure' first before field var 'x_DisplayPipeExposure'
		$val = $CurrentForm->hasValue("DisplayPipeExposure") ? $CurrentForm->getValue("DisplayPipeExposure") : $CurrentForm->getValue("x_DisplayPipeExposure");
		if (!$this->DisplayPipeExposure->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayPipeExposure->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayPipeExposure->setFormValue($val);
		}

		// Check field name 'DisplayVolumeCorrection' first before field var 'x_DisplayVolumeCorrection'
		$val = $CurrentForm->hasValue("DisplayVolumeCorrection") ? $CurrentForm->getValue("DisplayVolumeCorrection") : $CurrentForm->getValue("x_DisplayVolumeCorrection");
		if (!$this->DisplayVolumeCorrection->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayVolumeCorrection->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayVolumeCorrection->setFormValue($val);
		}

		// Check field name 'DisplayManhourAdjustment' first before field var 'x_DisplayManhourAdjustment'
		$val = $CurrentForm->hasValue("DisplayManhourAdjustment") ? $CurrentForm->getValue("DisplayManhourAdjustment") : $CurrentForm->getValue("x_DisplayManhourAdjustment");
		if (!$this->DisplayManhourAdjustment->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayManhourAdjustment->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayManhourAdjustment->setFormValue($val);
		}

		// Check field name 'IsSubcontractWorksheet' first before field var 'x_IsSubcontractWorksheet'
		$val = $CurrentForm->hasValue("IsSubcontractWorksheet") ? $CurrentForm->getValue("IsSubcontractWorksheet") : $CurrentForm->getValue("x_IsSubcontractWorksheet");
		if (!$this->IsSubcontractWorksheet->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsSubcontractWorksheet->Visible = FALSE; // Disable update for API request
			else
				$this->IsSubcontractWorksheet->setFormValue($val);
		}

		// Check field name 'DisplayDeleteItemsButtons' first before field var 'x_DisplayDeleteItemsButtons'
		$val = $CurrentForm->hasValue("DisplayDeleteItemsButtons") ? $CurrentForm->getValue("DisplayDeleteItemsButtons") : $CurrentForm->getValue("x_DisplayDeleteItemsButtons");
		if (!$this->DisplayDeleteItemsButtons->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DisplayDeleteItemsButtons->Visible = FALSE; // Disable update for API request
			else
				$this->DisplayDeleteItemsButtons->setFormValue($val);
		}

		// Check field name 'ActiveFlag' first before field var 'x_ActiveFlag'
		$val = $CurrentForm->hasValue("ActiveFlag") ? $CurrentForm->getValue("ActiveFlag") : $CurrentForm->getValue("x_ActiveFlag");
		if (!$this->ActiveFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ActiveFlag->Visible = FALSE; // Disable update for API request
			else
				$this->ActiveFlag->setFormValue($val);
		}

		// Check field name 'WorksheetMaster_Idn' first before field var 'x_WorksheetMaster_Idn'
		$val = $CurrentForm->hasValue("WorksheetMaster_Idn") ? $CurrentForm->getValue("WorksheetMaster_Idn") : $CurrentForm->getValue("x_WorksheetMaster_Idn");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Name->CurrentValue = $this->Name->FormValue;
		$this->Department_Idn->CurrentValue = $this->Department_Idn->FormValue;
		$this->Rank->CurrentValue = $this->Rank->FormValue;
		$this->NumberOfColumns->CurrentValue = $this->NumberOfColumns->FormValue;
		$this->AllowMultiple->CurrentValue = $this->AllowMultiple->FormValue;
		$this->DisplayAdjustmentFactors->CurrentValue = $this->DisplayAdjustmentFactors->FormValue;
		$this->DisplayWorksheetDetails->CurrentValue = $this->DisplayWorksheetDetails->FormValue;
		$this->DisplayShopFabrication->CurrentValue = $this->DisplayShopFabrication->FormValue;
		$this->DisplayWorksheetName->CurrentValue = $this->DisplayWorksheetName->FormValue;
		$this->DisplayWorksheetHeader->CurrentValue = $this->DisplayWorksheetHeader->FormValue;
		$this->UseRadioButtonsForSizes->CurrentValue = $this->UseRadioButtonsForSizes->FormValue;
		$this->DisplayFieldHoursOverride->CurrentValue = $this->DisplayFieldHoursOverride->FormValue;
		$this->DisplayShopHours->CurrentValue = $this->DisplayShopHours->FormValue;
		$this->DisplayShopHoursOverride->CurrentValue = $this->DisplayShopHoursOverride->FormValue;
		$this->DisplayUserShopHoursOnly->CurrentValue = $this->DisplayUserShopHoursOnly->FormValue;
		$this->DisplayPipeExposure->CurrentValue = $this->DisplayPipeExposure->FormValue;
		$this->DisplayVolumeCorrection->CurrentValue = $this->DisplayVolumeCorrection->FormValue;
		$this->DisplayManhourAdjustment->CurrentValue = $this->DisplayManhourAdjustment->FormValue;
		$this->IsSubcontractWorksheet->CurrentValue = $this->IsSubcontractWorksheet->FormValue;
		$this->DisplayDeleteItemsButtons->CurrentValue = $this->DisplayDeleteItemsButtons->FormValue;
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

			// DisplayAdjustmentFactors
			$this->DisplayAdjustmentFactors->LinkCustomAttributes = "";
			$this->DisplayAdjustmentFactors->HrefValue = "";
			$this->DisplayAdjustmentFactors->TooltipValue = "";

			// DisplayWorksheetDetails
			$this->DisplayWorksheetDetails->LinkCustomAttributes = "";
			$this->DisplayWorksheetDetails->HrefValue = "";
			$this->DisplayWorksheetDetails->TooltipValue = "";

			// DisplayShopFabrication
			$this->DisplayShopFabrication->LinkCustomAttributes = "";
			$this->DisplayShopFabrication->HrefValue = "";
			$this->DisplayShopFabrication->TooltipValue = "";

			// DisplayWorksheetName
			$this->DisplayWorksheetName->LinkCustomAttributes = "";
			$this->DisplayWorksheetName->HrefValue = "";
			$this->DisplayWorksheetName->TooltipValue = "";

			// DisplayWorksheetHeader
			$this->DisplayWorksheetHeader->LinkCustomAttributes = "";
			$this->DisplayWorksheetHeader->HrefValue = "";
			$this->DisplayWorksheetHeader->TooltipValue = "";

			// UseRadioButtonsForSizes
			$this->UseRadioButtonsForSizes->LinkCustomAttributes = "";
			$this->UseRadioButtonsForSizes->HrefValue = "";
			$this->UseRadioButtonsForSizes->TooltipValue = "";

			// DisplayFieldHoursOverride
			$this->DisplayFieldHoursOverride->LinkCustomAttributes = "";
			$this->DisplayFieldHoursOverride->HrefValue = "";
			$this->DisplayFieldHoursOverride->TooltipValue = "";

			// DisplayShopHours
			$this->DisplayShopHours->LinkCustomAttributes = "";
			$this->DisplayShopHours->HrefValue = "";
			$this->DisplayShopHours->TooltipValue = "";

			// DisplayShopHoursOverride
			$this->DisplayShopHoursOverride->LinkCustomAttributes = "";
			$this->DisplayShopHoursOverride->HrefValue = "";
			$this->DisplayShopHoursOverride->TooltipValue = "";

			// DisplayUserShopHoursOnly
			$this->DisplayUserShopHoursOnly->LinkCustomAttributes = "";
			$this->DisplayUserShopHoursOnly->HrefValue = "";
			$this->DisplayUserShopHoursOnly->TooltipValue = "";

			// DisplayPipeExposure
			$this->DisplayPipeExposure->LinkCustomAttributes = "";
			$this->DisplayPipeExposure->HrefValue = "";
			$this->DisplayPipeExposure->TooltipValue = "";

			// DisplayVolumeCorrection
			$this->DisplayVolumeCorrection->LinkCustomAttributes = "";
			$this->DisplayVolumeCorrection->HrefValue = "";
			$this->DisplayVolumeCorrection->TooltipValue = "";

			// DisplayManhourAdjustment
			$this->DisplayManhourAdjustment->LinkCustomAttributes = "";
			$this->DisplayManhourAdjustment->HrefValue = "";
			$this->DisplayManhourAdjustment->TooltipValue = "";

			// IsSubcontractWorksheet
			$this->IsSubcontractWorksheet->LinkCustomAttributes = "";
			$this->IsSubcontractWorksheet->HrefValue = "";
			$this->IsSubcontractWorksheet->TooltipValue = "";

			// DisplayDeleteItemsButtons
			$this->DisplayDeleteItemsButtons->LinkCustomAttributes = "";
			$this->DisplayDeleteItemsButtons->HrefValue = "";
			$this->DisplayDeleteItemsButtons->TooltipValue = "";

			// ActiveFlag
			$this->ActiveFlag->LinkCustomAttributes = "";
			$this->ActiveFlag->HrefValue = "";
			$this->ActiveFlag->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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

			// DisplayAdjustmentFactors
			$this->DisplayAdjustmentFactors->EditCustomAttributes = "";
			$this->DisplayAdjustmentFactors->EditValue = $this->DisplayAdjustmentFactors->options(FALSE);

			// DisplayWorksheetDetails
			$this->DisplayWorksheetDetails->EditCustomAttributes = "";
			$this->DisplayWorksheetDetails->EditValue = $this->DisplayWorksheetDetails->options(FALSE);

			// DisplayShopFabrication
			$this->DisplayShopFabrication->EditCustomAttributes = "";
			$this->DisplayShopFabrication->EditValue = $this->DisplayShopFabrication->options(FALSE);

			// DisplayWorksheetName
			$this->DisplayWorksheetName->EditCustomAttributes = "";
			$this->DisplayWorksheetName->EditValue = $this->DisplayWorksheetName->options(FALSE);

			// DisplayWorksheetHeader
			$this->DisplayWorksheetHeader->EditCustomAttributes = "";
			$this->DisplayWorksheetHeader->EditValue = $this->DisplayWorksheetHeader->options(FALSE);

			// UseRadioButtonsForSizes
			$this->UseRadioButtonsForSizes->EditCustomAttributes = "";
			$this->UseRadioButtonsForSizes->EditValue = $this->UseRadioButtonsForSizes->options(FALSE);

			// DisplayFieldHoursOverride
			$this->DisplayFieldHoursOverride->EditCustomAttributes = "";
			$this->DisplayFieldHoursOverride->EditValue = $this->DisplayFieldHoursOverride->options(FALSE);

			// DisplayShopHours
			$this->DisplayShopHours->EditCustomAttributes = "";
			$this->DisplayShopHours->EditValue = $this->DisplayShopHours->options(FALSE);

			// DisplayShopHoursOverride
			$this->DisplayShopHoursOverride->EditCustomAttributes = "";
			$this->DisplayShopHoursOverride->EditValue = $this->DisplayShopHoursOverride->options(FALSE);

			// DisplayUserShopHoursOnly
			$this->DisplayUserShopHoursOnly->EditCustomAttributes = "";
			$this->DisplayUserShopHoursOnly->EditValue = $this->DisplayUserShopHoursOnly->options(FALSE);

			// DisplayPipeExposure
			$this->DisplayPipeExposure->EditCustomAttributes = "";
			$this->DisplayPipeExposure->EditValue = $this->DisplayPipeExposure->options(FALSE);

			// DisplayVolumeCorrection
			$this->DisplayVolumeCorrection->EditCustomAttributes = "";
			$this->DisplayVolumeCorrection->EditValue = $this->DisplayVolumeCorrection->options(FALSE);

			// DisplayManhourAdjustment
			$this->DisplayManhourAdjustment->EditCustomAttributes = "";
			$this->DisplayManhourAdjustment->EditValue = $this->DisplayManhourAdjustment->options(FALSE);

			// IsSubcontractWorksheet
			$this->IsSubcontractWorksheet->EditCustomAttributes = "";
			$this->IsSubcontractWorksheet->EditValue = $this->IsSubcontractWorksheet->options(FALSE);

			// DisplayDeleteItemsButtons
			$this->DisplayDeleteItemsButtons->EditCustomAttributes = "";
			$this->DisplayDeleteItemsButtons->EditValue = $this->DisplayDeleteItemsButtons->options(FALSE);

			// ActiveFlag
			$this->ActiveFlag->EditCustomAttributes = "";
			$this->ActiveFlag->EditValue = $this->ActiveFlag->options(FALSE);

			// Add refer script
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

			// DisplayAdjustmentFactors
			$this->DisplayAdjustmentFactors->LinkCustomAttributes = "";
			$this->DisplayAdjustmentFactors->HrefValue = "";

			// DisplayWorksheetDetails
			$this->DisplayWorksheetDetails->LinkCustomAttributes = "";
			$this->DisplayWorksheetDetails->HrefValue = "";

			// DisplayShopFabrication
			$this->DisplayShopFabrication->LinkCustomAttributes = "";
			$this->DisplayShopFabrication->HrefValue = "";

			// DisplayWorksheetName
			$this->DisplayWorksheetName->LinkCustomAttributes = "";
			$this->DisplayWorksheetName->HrefValue = "";

			// DisplayWorksheetHeader
			$this->DisplayWorksheetHeader->LinkCustomAttributes = "";
			$this->DisplayWorksheetHeader->HrefValue = "";

			// UseRadioButtonsForSizes
			$this->UseRadioButtonsForSizes->LinkCustomAttributes = "";
			$this->UseRadioButtonsForSizes->HrefValue = "";

			// DisplayFieldHoursOverride
			$this->DisplayFieldHoursOverride->LinkCustomAttributes = "";
			$this->DisplayFieldHoursOverride->HrefValue = "";

			// DisplayShopHours
			$this->DisplayShopHours->LinkCustomAttributes = "";
			$this->DisplayShopHours->HrefValue = "";

			// DisplayShopHoursOverride
			$this->DisplayShopHoursOverride->LinkCustomAttributes = "";
			$this->DisplayShopHoursOverride->HrefValue = "";

			// DisplayUserShopHoursOnly
			$this->DisplayUserShopHoursOnly->LinkCustomAttributes = "";
			$this->DisplayUserShopHoursOnly->HrefValue = "";

			// DisplayPipeExposure
			$this->DisplayPipeExposure->LinkCustomAttributes = "";
			$this->DisplayPipeExposure->HrefValue = "";

			// DisplayVolumeCorrection
			$this->DisplayVolumeCorrection->LinkCustomAttributes = "";
			$this->DisplayVolumeCorrection->HrefValue = "";

			// DisplayManhourAdjustment
			$this->DisplayManhourAdjustment->LinkCustomAttributes = "";
			$this->DisplayManhourAdjustment->HrefValue = "";

			// IsSubcontractWorksheet
			$this->IsSubcontractWorksheet->LinkCustomAttributes = "";
			$this->IsSubcontractWorksheet->HrefValue = "";

			// DisplayDeleteItemsButtons
			$this->DisplayDeleteItemsButtons->LinkCustomAttributes = "";
			$this->DisplayDeleteItemsButtons->HrefValue = "";

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
		if ($this->DisplayAdjustmentFactors->Required) {
			if ($this->DisplayAdjustmentFactors->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayAdjustmentFactors->caption(), $this->DisplayAdjustmentFactors->RequiredErrorMessage));
			}
		}
		if ($this->DisplayWorksheetDetails->Required) {
			if ($this->DisplayWorksheetDetails->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayWorksheetDetails->caption(), $this->DisplayWorksheetDetails->RequiredErrorMessage));
			}
		}
		if ($this->DisplayShopFabrication->Required) {
			if ($this->DisplayShopFabrication->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayShopFabrication->caption(), $this->DisplayShopFabrication->RequiredErrorMessage));
			}
		}
		if ($this->DisplayWorksheetName->Required) {
			if ($this->DisplayWorksheetName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayWorksheetName->caption(), $this->DisplayWorksheetName->RequiredErrorMessage));
			}
		}
		if ($this->DisplayWorksheetHeader->Required) {
			if ($this->DisplayWorksheetHeader->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayWorksheetHeader->caption(), $this->DisplayWorksheetHeader->RequiredErrorMessage));
			}
		}
		if ($this->UseRadioButtonsForSizes->Required) {
			if ($this->UseRadioButtonsForSizes->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UseRadioButtonsForSizes->caption(), $this->UseRadioButtonsForSizes->RequiredErrorMessage));
			}
		}
		if ($this->DisplayFieldHoursOverride->Required) {
			if ($this->DisplayFieldHoursOverride->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayFieldHoursOverride->caption(), $this->DisplayFieldHoursOverride->RequiredErrorMessage));
			}
		}
		if ($this->DisplayShopHours->Required) {
			if ($this->DisplayShopHours->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayShopHours->caption(), $this->DisplayShopHours->RequiredErrorMessage));
			}
		}
		if ($this->DisplayShopHoursOverride->Required) {
			if ($this->DisplayShopHoursOverride->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayShopHoursOverride->caption(), $this->DisplayShopHoursOverride->RequiredErrorMessage));
			}
		}
		if ($this->DisplayUserShopHoursOnly->Required) {
			if ($this->DisplayUserShopHoursOnly->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayUserShopHoursOnly->caption(), $this->DisplayUserShopHoursOnly->RequiredErrorMessage));
			}
		}
		if ($this->DisplayPipeExposure->Required) {
			if ($this->DisplayPipeExposure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayPipeExposure->caption(), $this->DisplayPipeExposure->RequiredErrorMessage));
			}
		}
		if ($this->DisplayVolumeCorrection->Required) {
			if ($this->DisplayVolumeCorrection->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayVolumeCorrection->caption(), $this->DisplayVolumeCorrection->RequiredErrorMessage));
			}
		}
		if ($this->DisplayManhourAdjustment->Required) {
			if ($this->DisplayManhourAdjustment->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayManhourAdjustment->caption(), $this->DisplayManhourAdjustment->RequiredErrorMessage));
			}
		}
		if ($this->IsSubcontractWorksheet->Required) {
			if ($this->IsSubcontractWorksheet->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IsSubcontractWorksheet->caption(), $this->IsSubcontractWorksheet->RequiredErrorMessage));
			}
		}
		if ($this->DisplayDeleteItemsButtons->Required) {
			if ($this->DisplayDeleteItemsButtons->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DisplayDeleteItemsButtons->caption(), $this->DisplayDeleteItemsButtons->RequiredErrorMessage));
			}
		}
		if ($this->ActiveFlag->Required) {
			if ($this->ActiveFlag->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActiveFlag->caption(), $this->ActiveFlag->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("WorksheetMasterCategories", $detailTblVar) && $GLOBALS["WorksheetMasterCategories"]->DetailAdd) {
			if (!isset($GLOBALS["WorksheetMasterCategories_grid"]))
				$GLOBALS["WorksheetMasterCategories_grid"] = new WorksheetMasterCategories_grid(); // Get detail page object
			$GLOBALS["WorksheetMasterCategories_grid"]->validateGridForm();
		}
		if (in_array("WorksheetMasterSizes", $detailTblVar) && $GLOBALS["WorksheetMasterSizes"]->DetailAdd) {
			if (!isset($GLOBALS["WorksheetMasterSizes_grid"]))
				$GLOBALS["WorksheetMasterSizes_grid"] = new WorksheetMasterSizes_grid(); // Get detail page object
			$GLOBALS["WorksheetMasterSizes_grid"]->validateGridForm();
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

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

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

		// DisplayAdjustmentFactors
		$tmpBool = $this->DisplayAdjustmentFactors->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayAdjustmentFactors->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayAdjustmentFactors->CurrentValue) == "");

		// DisplayWorksheetDetails
		$tmpBool = $this->DisplayWorksheetDetails->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayWorksheetDetails->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayWorksheetDetails->CurrentValue) == "");

		// DisplayShopFabrication
		$tmpBool = $this->DisplayShopFabrication->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayShopFabrication->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayShopFabrication->CurrentValue) == "");

		// DisplayWorksheetName
		$tmpBool = $this->DisplayWorksheetName->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayWorksheetName->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayWorksheetName->CurrentValue) == "");

		// DisplayWorksheetHeader
		$tmpBool = $this->DisplayWorksheetHeader->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayWorksheetHeader->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayWorksheetHeader->CurrentValue) == "");

		// UseRadioButtonsForSizes
		$tmpBool = $this->UseRadioButtonsForSizes->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->UseRadioButtonsForSizes->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->UseRadioButtonsForSizes->CurrentValue) == "");

		// DisplayFieldHoursOverride
		$tmpBool = $this->DisplayFieldHoursOverride->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayFieldHoursOverride->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayFieldHoursOverride->CurrentValue) == "");

		// DisplayShopHours
		$tmpBool = $this->DisplayShopHours->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayShopHours->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayShopHours->CurrentValue) == "");

		// DisplayShopHoursOverride
		$tmpBool = $this->DisplayShopHoursOverride->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayShopHoursOverride->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayShopHoursOverride->CurrentValue) == "");

		// DisplayUserShopHoursOnly
		$tmpBool = $this->DisplayUserShopHoursOnly->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayUserShopHoursOnly->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayUserShopHoursOnly->CurrentValue) == "");

		// DisplayPipeExposure
		$tmpBool = $this->DisplayPipeExposure->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayPipeExposure->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayPipeExposure->CurrentValue) == "");

		// DisplayVolumeCorrection
		$tmpBool = $this->DisplayVolumeCorrection->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayVolumeCorrection->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayVolumeCorrection->CurrentValue) == "");

		// DisplayManhourAdjustment
		$tmpBool = $this->DisplayManhourAdjustment->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayManhourAdjustment->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayManhourAdjustment->CurrentValue) == "");

		// IsSubcontractWorksheet
		$tmpBool = $this->IsSubcontractWorksheet->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->IsSubcontractWorksheet->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->IsSubcontractWorksheet->CurrentValue) == "");

		// DisplayDeleteItemsButtons
		$tmpBool = $this->DisplayDeleteItemsButtons->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->DisplayDeleteItemsButtons->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->DisplayDeleteItemsButtons->CurrentValue) == "");

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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("WorksheetMasterCategories", $detailTblVar) && $GLOBALS["WorksheetMasterCategories"]->DetailAdd) {
				$GLOBALS["WorksheetMasterCategories"]->WorksheetMaster_Idn->setSessionValue($this->WorksheetMaster_Idn->CurrentValue); // Set master key
				if (!isset($GLOBALS["WorksheetMasterCategories_grid"]))
					$GLOBALS["WorksheetMasterCategories_grid"] = new WorksheetMasterCategories_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "WorksheetMasterCategories"); // Load user level of detail table
				$addRow = $GLOBALS["WorksheetMasterCategories_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["WorksheetMasterCategories"]->WorksheetMaster_Idn->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("WorksheetMasterSizes", $detailTblVar) && $GLOBALS["WorksheetMasterSizes"]->DetailAdd) {
				$GLOBALS["WorksheetMasterSizes"]->WorksheetMaster_Idn->setSessionValue($this->WorksheetMaster_Idn->CurrentValue); // Set master key
				if (!isset($GLOBALS["WorksheetMasterSizes_grid"]))
					$GLOBALS["WorksheetMasterSizes_grid"] = new WorksheetMasterSizes_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "WorksheetMasterSizes"); // Load user level of detail table
				$addRow = $GLOBALS["WorksheetMasterSizes_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["WorksheetMasterSizes"]->WorksheetMaster_Idn->setSessionValue(""); // Clear master key if insert failed
				}
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() != "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
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
				if ($GLOBALS["WorksheetMasterCategories_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["WorksheetMasterCategories_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["WorksheetMasterCategories_grid"]->CurrentMode = "add";
					$GLOBALS["WorksheetMasterCategories_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["WorksheetMasterCategories_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["WorksheetMasterCategories_grid"]->setStartRecordNumber(1);
					$GLOBALS["WorksheetMasterCategories_grid"]->WorksheetMaster_Idn->IsDetailKey = TRUE;
					$GLOBALS["WorksheetMasterCategories_grid"]->WorksheetMaster_Idn->CurrentValue = $this->WorksheetMaster_Idn->CurrentValue;
					$GLOBALS["WorksheetMasterCategories_grid"]->WorksheetMaster_Idn->setSessionValue($GLOBALS["WorksheetMasterCategories_grid"]->WorksheetMaster_Idn->CurrentValue);
					$GLOBALS["WorksheetMasterCategories_grid"]->WorksheetCategory_Idn->setSessionValue(""); // Clear session key
				}
			}
			if (in_array("WorksheetMasterSizes", $detailTblVar)) {
				if (!isset($GLOBALS["WorksheetMasterSizes_grid"]))
					$GLOBALS["WorksheetMasterSizes_grid"] = new WorksheetMasterSizes_grid();
				if ($GLOBALS["WorksheetMasterSizes_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["WorksheetMasterSizes_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["WorksheetMasterSizes_grid"]->CurrentMode = "add";
					$GLOBALS["WorksheetMasterSizes_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["WorksheetMasterSizes_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["WorksheetMasterSizes_grid"]->setStartRecordNumber(1);
					$GLOBALS["WorksheetMasterSizes_grid"]->WorksheetMaster_Idn->IsDetailKey = TRUE;
					$GLOBALS["WorksheetMasterSizes_grid"]->WorksheetMaster_Idn->CurrentValue = $this->WorksheetMaster_Idn->CurrentValue;
					$GLOBALS["WorksheetMasterSizes_grid"]->WorksheetMaster_Idn->setSessionValue($GLOBALS["WorksheetMasterSizes_grid"]->WorksheetMaster_Idn->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("WorksheetMasterslist.php"), "", $this->TableVar, TRUE);
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