<?php
namespace PHPMaker2020\feapps51;

/**
 * Page class
 */
class Products_edit extends Products
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}";

	// Table name
	public $TableName = 'Products';

	// Page object name
	public $PageObjName = "Products_edit";

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

		// Table object (v_Administrators)
		if (!isset($GLOBALS['v_Administrators']))
			$GLOBALS['v_Administrators'] = new v_Administrators();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "Productsview.php")
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
	public $MultiPages; // Multi pages object

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
					$this->terminate(GetUrl("Productslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
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

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up multi page object
		$this->setupMultiPages();

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

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("Productslist.php");
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
			if (Get("Product_Idn") !== NULL) {
				$this->Product_Idn->setQueryStringValue(Get("Product_Idn"));
				$this->Product_Idn->setOldValue($this->Product_Idn->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->Product_Idn->setQueryStringValue(Key(0));
				$this->Product_Idn->setOldValue($this->Product_Idn->QueryStringValue);
			} elseif (Post("Product_Idn") !== NULL) {
				$this->Product_Idn->setFormValue(Post("Product_Idn"));
				$this->Product_Idn->setOldValue($this->Product_Idn->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->Product_Idn->setQueryStringValue(Route(2));
				$this->Product_Idn->setOldValue($this->Product_Idn->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_Product_Idn")) {
					$this->Product_Idn->setFormValue($CurrentForm->getValue("x_Product_Idn"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("Product_Idn") !== NULL) {
					$this->Product_Idn->setQueryStringValue(Get("Product_Idn"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->Product_Idn->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->Product_Idn->CurrentValue = NULL;
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
				$this->terminate("Productslist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->Product_Idn->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->Product_Idn->CurrentValue, $rs->fields('Product_Idn'))) {
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
					$this->terminate("Productslist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "Productslist.php")
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

		// Check field name 'Product_Idn' first before field var 'x_Product_Idn'
		$val = $CurrentForm->hasValue("Product_Idn") ? $CurrentForm->getValue("Product_Idn") : $CurrentForm->getValue("x_Product_Idn");
		if (!$this->Product_Idn->IsDetailKey)
			$this->Product_Idn->setFormValue($val);

		// Check field name 'Department_Idn' first before field var 'x_Department_Idn'
		$val = $CurrentForm->hasValue("Department_Idn") ? $CurrentForm->getValue("Department_Idn") : $CurrentForm->getValue("x_Department_Idn");
		if (!$this->Department_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Department_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Department_Idn->setFormValue($val);
		}

		// Check field name 'WorksheetMaster_Idn' first before field var 'x_WorksheetMaster_Idn'
		$val = $CurrentForm->hasValue("WorksheetMaster_Idn") ? $CurrentForm->getValue("WorksheetMaster_Idn") : $CurrentForm->getValue("x_WorksheetMaster_Idn");
		if (!$this->WorksheetMaster_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->WorksheetMaster_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->WorksheetMaster_Idn->setFormValue($val);
		}

		// Check field name 'WorksheetCategory_Idn' first before field var 'x_WorksheetCategory_Idn'
		$val = $CurrentForm->hasValue("WorksheetCategory_Idn") ? $CurrentForm->getValue("WorksheetCategory_Idn") : $CurrentForm->getValue("x_WorksheetCategory_Idn");
		if (!$this->WorksheetCategory_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->WorksheetCategory_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->WorksheetCategory_Idn->setFormValue($val);
		}

		// Check field name 'Manufacturer_Idn' first before field var 'x_Manufacturer_Idn'
		$val = $CurrentForm->hasValue("Manufacturer_Idn") ? $CurrentForm->getValue("Manufacturer_Idn") : $CurrentForm->getValue("x_Manufacturer_Idn");
		if (!$this->Manufacturer_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Manufacturer_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Manufacturer_Idn->setFormValue($val);
		}

		// Check field name 'Rank' first before field var 'x_Rank'
		$val = $CurrentForm->hasValue("Rank") ? $CurrentForm->getValue("Rank") : $CurrentForm->getValue("x_Rank");
		if (!$this->Rank->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Rank->Visible = FALSE; // Disable update for API request
			else
				$this->Rank->setFormValue($val);
		}

		// Check field name 'Name' first before field var 'x_Name'
		$val = $CurrentForm->hasValue("Name") ? $CurrentForm->getValue("Name") : $CurrentForm->getValue("x_Name");
		if (!$this->Name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Name->Visible = FALSE; // Disable update for API request
			else
				$this->Name->setFormValue($val);
		}

		// Check field name 'MaterialUnitPrice' first before field var 'x_MaterialUnitPrice'
		$val = $CurrentForm->hasValue("MaterialUnitPrice") ? $CurrentForm->getValue("MaterialUnitPrice") : $CurrentForm->getValue("x_MaterialUnitPrice");
		if (!$this->MaterialUnitPrice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->MaterialUnitPrice->Visible = FALSE; // Disable update for API request
			else
				$this->MaterialUnitPrice->setFormValue($val);
		}

		// Check field name 'FieldUnitPrice' first before field var 'x_FieldUnitPrice'
		$val = $CurrentForm->hasValue("FieldUnitPrice") ? $CurrentForm->getValue("FieldUnitPrice") : $CurrentForm->getValue("x_FieldUnitPrice");
		if (!$this->FieldUnitPrice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FieldUnitPrice->Visible = FALSE; // Disable update for API request
			else
				$this->FieldUnitPrice->setFormValue($val);
		}

		// Check field name 'ShopUnitPrice' first before field var 'x_ShopUnitPrice'
		$val = $CurrentForm->hasValue("ShopUnitPrice") ? $CurrentForm->getValue("ShopUnitPrice") : $CurrentForm->getValue("x_ShopUnitPrice");
		if (!$this->ShopUnitPrice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ShopUnitPrice->Visible = FALSE; // Disable update for API request
			else
				$this->ShopUnitPrice->setFormValue($val);
		}

		// Check field name 'EngineerUnitPrice' first before field var 'x_EngineerUnitPrice'
		$val = $CurrentForm->hasValue("EngineerUnitPrice") ? $CurrentForm->getValue("EngineerUnitPrice") : $CurrentForm->getValue("x_EngineerUnitPrice");
		if (!$this->EngineerUnitPrice->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->EngineerUnitPrice->Visible = FALSE; // Disable update for API request
			else
				$this->EngineerUnitPrice->setFormValue($val);
		}

		// Check field name 'DefaultQuantity' first before field var 'x_DefaultQuantity'
		$val = $CurrentForm->hasValue("DefaultQuantity") ? $CurrentForm->getValue("DefaultQuantity") : $CurrentForm->getValue("x_DefaultQuantity");
		if (!$this->DefaultQuantity->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DefaultQuantity->Visible = FALSE; // Disable update for API request
			else
				$this->DefaultQuantity->setFormValue($val);
		}

		// Check field name 'ProductSize_Idn' first before field var 'x_ProductSize_Idn'
		$val = $CurrentForm->hasValue("ProductSize_Idn") ? $CurrentForm->getValue("ProductSize_Idn") : $CurrentForm->getValue("x_ProductSize_Idn");
		if (!$this->ProductSize_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ProductSize_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->ProductSize_Idn->setFormValue($val);
		}

		// Check field name 'Description' first before field var 'x_Description'
		$val = $CurrentForm->hasValue("Description") ? $CurrentForm->getValue("Description") : $CurrentForm->getValue("x_Description");
		if (!$this->Description->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Description->Visible = FALSE; // Disable update for API request
			else
				$this->Description->setFormValue($val);
		}

		// Check field name 'PipeType_Idn' first before field var 'x_PipeType_Idn'
		$val = $CurrentForm->hasValue("PipeType_Idn") ? $CurrentForm->getValue("PipeType_Idn") : $CurrentForm->getValue("x_PipeType_Idn");
		if (!$this->PipeType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PipeType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->PipeType_Idn->setFormValue($val);
		}

		// Check field name 'ScheduleType_Idn' first before field var 'x_ScheduleType_Idn'
		$val = $CurrentForm->hasValue("ScheduleType_Idn") ? $CurrentForm->getValue("ScheduleType_Idn") : $CurrentForm->getValue("x_ScheduleType_Idn");
		if (!$this->ScheduleType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ScheduleType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->ScheduleType_Idn->setFormValue($val);
		}

		// Check field name 'Fitting_Idn' first before field var 'x_Fitting_Idn'
		$val = $CurrentForm->hasValue("Fitting_Idn") ? $CurrentForm->getValue("Fitting_Idn") : $CurrentForm->getValue("x_Fitting_Idn");
		if (!$this->Fitting_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Fitting_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Fitting_Idn->setFormValue($val);
		}

		// Check field name 'GroovedFittingType_Idn' first before field var 'x_GroovedFittingType_Idn'
		$val = $CurrentForm->hasValue("GroovedFittingType_Idn") ? $CurrentForm->getValue("GroovedFittingType_Idn") : $CurrentForm->getValue("x_GroovedFittingType_Idn");
		if (!$this->GroovedFittingType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->GroovedFittingType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->GroovedFittingType_Idn->setFormValue($val);
		}

		// Check field name 'ThreadedFittingType_Idn' first before field var 'x_ThreadedFittingType_Idn'
		$val = $CurrentForm->hasValue("ThreadedFittingType_Idn") ? $CurrentForm->getValue("ThreadedFittingType_Idn") : $CurrentForm->getValue("x_ThreadedFittingType_Idn");
		if (!$this->ThreadedFittingType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ThreadedFittingType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->ThreadedFittingType_Idn->setFormValue($val);
		}

		// Check field name 'HangerType_Idn' first before field var 'x_HangerType_Idn'
		$val = $CurrentForm->hasValue("HangerType_Idn") ? $CurrentForm->getValue("HangerType_Idn") : $CurrentForm->getValue("x_HangerType_Idn");
		if (!$this->HangerType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->HangerType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->HangerType_Idn->setFormValue($val);
		}

		// Check field name 'HangerSubType_Idn' first before field var 'x_HangerSubType_Idn'
		$val = $CurrentForm->hasValue("HangerSubType_Idn") ? $CurrentForm->getValue("HangerSubType_Idn") : $CurrentForm->getValue("x_HangerSubType_Idn");
		if (!$this->HangerSubType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->HangerSubType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->HangerSubType_Idn->setFormValue($val);
		}

		// Check field name 'SubcontractCategory_Idn' first before field var 'x_SubcontractCategory_Idn'
		$val = $CurrentForm->hasValue("SubcontractCategory_Idn") ? $CurrentForm->getValue("SubcontractCategory_Idn") : $CurrentForm->getValue("x_SubcontractCategory_Idn");
		if (!$this->SubcontractCategory_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->SubcontractCategory_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->SubcontractCategory_Idn->setFormValue($val);
		}

		// Check field name 'ApplyToAdjustmentFactorsFlag' first before field var 'x_ApplyToAdjustmentFactorsFlag'
		$val = $CurrentForm->hasValue("ApplyToAdjustmentFactorsFlag") ? $CurrentForm->getValue("ApplyToAdjustmentFactorsFlag") : $CurrentForm->getValue("x_ApplyToAdjustmentFactorsFlag");
		if (!$this->ApplyToAdjustmentFactorsFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ApplyToAdjustmentFactorsFlag->Visible = FALSE; // Disable update for API request
			else
				$this->ApplyToAdjustmentFactorsFlag->setFormValue($val);
		}

		// Check field name 'ApplyToContingencyFlag' first before field var 'x_ApplyToContingencyFlag'
		$val = $CurrentForm->hasValue("ApplyToContingencyFlag") ? $CurrentForm->getValue("ApplyToContingencyFlag") : $CurrentForm->getValue("x_ApplyToContingencyFlag");
		if (!$this->ApplyToContingencyFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ApplyToContingencyFlag->Visible = FALSE; // Disable update for API request
			else
				$this->ApplyToContingencyFlag->setFormValue($val);
		}

		// Check field name 'IsMainComponent' first before field var 'x_IsMainComponent'
		$val = $CurrentForm->hasValue("IsMainComponent") ? $CurrentForm->getValue("IsMainComponent") : $CurrentForm->getValue("x_IsMainComponent");
		if (!$this->IsMainComponent->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsMainComponent->Visible = FALSE; // Disable update for API request
			else
				$this->IsMainComponent->setFormValue($val);
		}

		// Check field name 'DomesticFlag' first before field var 'x_DomesticFlag'
		$val = $CurrentForm->hasValue("DomesticFlag") ? $CurrentForm->getValue("DomesticFlag") : $CurrentForm->getValue("x_DomesticFlag");
		if (!$this->DomesticFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DomesticFlag->Visible = FALSE; // Disable update for API request
			else
				$this->DomesticFlag->setFormValue($val);
		}

		// Check field name 'LoadFlag' first before field var 'x_LoadFlag'
		$val = $CurrentForm->hasValue("LoadFlag") ? $CurrentForm->getValue("LoadFlag") : $CurrentForm->getValue("x_LoadFlag");
		if (!$this->LoadFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LoadFlag->Visible = FALSE; // Disable update for API request
			else
				$this->LoadFlag->setFormValue($val);
		}

		// Check field name 'AutoLoadFlag' first before field var 'x_AutoLoadFlag'
		$val = $CurrentForm->hasValue("AutoLoadFlag") ? $CurrentForm->getValue("AutoLoadFlag") : $CurrentForm->getValue("x_AutoLoadFlag");
		if (!$this->AutoLoadFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->AutoLoadFlag->Visible = FALSE; // Disable update for API request
			else
				$this->AutoLoadFlag->setFormValue($val);
		}

		// Check field name 'ActiveFlag' first before field var 'x_ActiveFlag'
		$val = $CurrentForm->hasValue("ActiveFlag") ? $CurrentForm->getValue("ActiveFlag") : $CurrentForm->getValue("x_ActiveFlag");
		if (!$this->ActiveFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ActiveFlag->Visible = FALSE; // Disable update for API request
			else
				$this->ActiveFlag->setFormValue($val);
		}

		// Check field name 'GradeType_Idn' first before field var 'x_GradeType_Idn'
		$val = $CurrentForm->hasValue("GradeType_Idn") ? $CurrentForm->getValue("GradeType_Idn") : $CurrentForm->getValue("x_GradeType_Idn");
		if (!$this->GradeType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->GradeType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->GradeType_Idn->setFormValue($val);
		}

		// Check field name 'PressureType_Idn' first before field var 'x_PressureType_Idn'
		$val = $CurrentForm->hasValue("PressureType_Idn") ? $CurrentForm->getValue("PressureType_Idn") : $CurrentForm->getValue("x_PressureType_Idn");
		if (!$this->PressureType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PressureType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->PressureType_Idn->setFormValue($val);
		}

		// Check field name 'SeamlessFlag' first before field var 'x_SeamlessFlag'
		$val = $CurrentForm->hasValue("SeamlessFlag") ? $CurrentForm->getValue("SeamlessFlag") : $CurrentForm->getValue("x_SeamlessFlag");
		if (!$this->SeamlessFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->SeamlessFlag->Visible = FALSE; // Disable update for API request
			else
				$this->SeamlessFlag->setFormValue($val);
		}

		// Check field name 'ResponseType' first before field var 'x_ResponseType'
		$val = $CurrentForm->hasValue("ResponseType") ? $CurrentForm->getValue("ResponseType") : $CurrentForm->getValue("x_ResponseType");
		if (!$this->ResponseType->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ResponseType->Visible = FALSE; // Disable update for API request
			else
				$this->ResponseType->setFormValue($val);
		}

		// Check field name 'FMJobFlag' first before field var 'x_FMJobFlag'
		$val = $CurrentForm->hasValue("FMJobFlag") ? $CurrentForm->getValue("FMJobFlag") : $CurrentForm->getValue("x_FMJobFlag");
		if (!$this->FMJobFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FMJobFlag->Visible = FALSE; // Disable update for API request
			else
				$this->FMJobFlag->setFormValue($val);
		}

		// Check field name 'RecommendedBoxes' first before field var 'x_RecommendedBoxes'
		$val = $CurrentForm->hasValue("RecommendedBoxes") ? $CurrentForm->getValue("RecommendedBoxes") : $CurrentForm->getValue("x_RecommendedBoxes");
		if (!$this->RecommendedBoxes->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RecommendedBoxes->Visible = FALSE; // Disable update for API request
			else
				$this->RecommendedBoxes->setFormValue($val);
		}

		// Check field name 'RecommendedWireFootage' first before field var 'x_RecommendedWireFootage'
		$val = $CurrentForm->hasValue("RecommendedWireFootage") ? $CurrentForm->getValue("RecommendedWireFootage") : $CurrentForm->getValue("x_RecommendedWireFootage");
		if (!$this->RecommendedWireFootage->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RecommendedWireFootage->Visible = FALSE; // Disable update for API request
			else
				$this->RecommendedWireFootage->setFormValue($val);
		}

		// Check field name 'CoverageType_Idn' first before field var 'x_CoverageType_Idn'
		$val = $CurrentForm->hasValue("CoverageType_Idn") ? $CurrentForm->getValue("CoverageType_Idn") : $CurrentForm->getValue("x_CoverageType_Idn");
		if (!$this->CoverageType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CoverageType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->CoverageType_Idn->setFormValue($val);
		}

		// Check field name 'HeadType_Idn' first before field var 'x_HeadType_Idn'
		$val = $CurrentForm->hasValue("HeadType_Idn") ? $CurrentForm->getValue("HeadType_Idn") : $CurrentForm->getValue("x_HeadType_Idn");
		if (!$this->HeadType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->HeadType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->HeadType_Idn->setFormValue($val);
		}

		// Check field name 'FinishType_Idn' first before field var 'x_FinishType_Idn'
		$val = $CurrentForm->hasValue("FinishType_Idn") ? $CurrentForm->getValue("FinishType_Idn") : $CurrentForm->getValue("x_FinishType_Idn");
		if (!$this->FinishType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FinishType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->FinishType_Idn->setFormValue($val);
		}

		// Check field name 'Outlet_Idn' first before field var 'x_Outlet_Idn'
		$val = $CurrentForm->hasValue("Outlet_Idn") ? $CurrentForm->getValue("Outlet_Idn") : $CurrentForm->getValue("x_Outlet_Idn");
		if (!$this->Outlet_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Outlet_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Outlet_Idn->setFormValue($val);
		}

		// Check field name 'RiserType_Idn' first before field var 'x_RiserType_Idn'
		$val = $CurrentForm->hasValue("RiserType_Idn") ? $CurrentForm->getValue("RiserType_Idn") : $CurrentForm->getValue("x_RiserType_Idn");
		if (!$this->RiserType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RiserType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->RiserType_Idn->setFormValue($val);
		}

		// Check field name 'BackFlowType_Idn' first before field var 'x_BackFlowType_Idn'
		$val = $CurrentForm->hasValue("BackFlowType_Idn") ? $CurrentForm->getValue("BackFlowType_Idn") : $CurrentForm->getValue("x_BackFlowType_Idn");
		if (!$this->BackFlowType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->BackFlowType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->BackFlowType_Idn->setFormValue($val);
		}

		// Check field name 'ControlValve_Idn' first before field var 'x_ControlValve_Idn'
		$val = $CurrentForm->hasValue("ControlValve_Idn") ? $CurrentForm->getValue("ControlValve_Idn") : $CurrentForm->getValue("x_ControlValve_Idn");
		if (!$this->ControlValve_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ControlValve_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->ControlValve_Idn->setFormValue($val);
		}

		// Check field name 'CheckValve_Idn' first before field var 'x_CheckValve_Idn'
		$val = $CurrentForm->hasValue("CheckValve_Idn") ? $CurrentForm->getValue("CheckValve_Idn") : $CurrentForm->getValue("x_CheckValve_Idn");
		if (!$this->CheckValve_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CheckValve_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->CheckValve_Idn->setFormValue($val);
		}

		// Check field name 'FDCType_Idn' first before field var 'x_FDCType_Idn'
		$val = $CurrentForm->hasValue("FDCType_Idn") ? $CurrentForm->getValue("FDCType_Idn") : $CurrentForm->getValue("x_FDCType_Idn");
		if (!$this->FDCType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FDCType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->FDCType_Idn->setFormValue($val);
		}

		// Check field name 'BellType_Idn' first before field var 'x_BellType_Idn'
		$val = $CurrentForm->hasValue("BellType_Idn") ? $CurrentForm->getValue("BellType_Idn") : $CurrentForm->getValue("x_BellType_Idn");
		if (!$this->BellType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->BellType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->BellType_Idn->setFormValue($val);
		}

		// Check field name 'TappingTee_Idn' first before field var 'x_TappingTee_Idn'
		$val = $CurrentForm->hasValue("TappingTee_Idn") ? $CurrentForm->getValue("TappingTee_Idn") : $CurrentForm->getValue("x_TappingTee_Idn");
		if (!$this->TappingTee_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->TappingTee_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->TappingTee_Idn->setFormValue($val);
		}

		// Check field name 'UndergroundValve_Idn' first before field var 'x_UndergroundValve_Idn'
		$val = $CurrentForm->hasValue("UndergroundValve_Idn") ? $CurrentForm->getValue("UndergroundValve_Idn") : $CurrentForm->getValue("x_UndergroundValve_Idn");
		if (!$this->UndergroundValve_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->UndergroundValve_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->UndergroundValve_Idn->setFormValue($val);
		}

		// Check field name 'LiftDuration_Idn' first before field var 'x_LiftDuration_Idn'
		$val = $CurrentForm->hasValue("LiftDuration_Idn") ? $CurrentForm->getValue("LiftDuration_Idn") : $CurrentForm->getValue("x_LiftDuration_Idn");
		if (!$this->LiftDuration_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LiftDuration_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->LiftDuration_Idn->setFormValue($val);
		}

		// Check field name 'TrimPackageFlag' first before field var 'x_TrimPackageFlag'
		$val = $CurrentForm->hasValue("TrimPackageFlag") ? $CurrentForm->getValue("TrimPackageFlag") : $CurrentForm->getValue("x_TrimPackageFlag");
		if (!$this->TrimPackageFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->TrimPackageFlag->Visible = FALSE; // Disable update for API request
			else
				$this->TrimPackageFlag->setFormValue($val);
		}

		// Check field name 'ListedFlag' first before field var 'x_ListedFlag'
		$val = $CurrentForm->hasValue("ListedFlag") ? $CurrentForm->getValue("ListedFlag") : $CurrentForm->getValue("x_ListedFlag");
		if (!$this->ListedFlag->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ListedFlag->Visible = FALSE; // Disable update for API request
			else
				$this->ListedFlag->setFormValue($val);
		}

		// Check field name 'BoxWireLength' first before field var 'x_BoxWireLength'
		$val = $CurrentForm->hasValue("BoxWireLength") ? $CurrentForm->getValue("BoxWireLength") : $CurrentForm->getValue("x_BoxWireLength");
		if (!$this->BoxWireLength->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->BoxWireLength->Visible = FALSE; // Disable update for API request
			else
				$this->BoxWireLength->setFormValue($val);
		}

		// Check field name 'IsFirePump' first before field var 'x_IsFirePump'
		$val = $CurrentForm->hasValue("IsFirePump") ? $CurrentForm->getValue("IsFirePump") : $CurrentForm->getValue("x_IsFirePump");
		if (!$this->IsFirePump->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsFirePump->Visible = FALSE; // Disable update for API request
			else
				$this->IsFirePump->setFormValue($val);
		}

		// Check field name 'FirePumpType_Idn' first before field var 'x_FirePumpType_Idn'
		$val = $CurrentForm->hasValue("FirePumpType_Idn") ? $CurrentForm->getValue("FirePumpType_Idn") : $CurrentForm->getValue("x_FirePumpType_Idn");
		if (!$this->FirePumpType_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FirePumpType_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->FirePumpType_Idn->setFormValue($val);
		}

		// Check field name 'FirePumpAttribute_Idn' first before field var 'x_FirePumpAttribute_Idn'
		$val = $CurrentForm->hasValue("FirePumpAttribute_Idn") ? $CurrentForm->getValue("FirePumpAttribute_Idn") : $CurrentForm->getValue("x_FirePumpAttribute_Idn");
		if (!$this->FirePumpAttribute_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FirePumpAttribute_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->FirePumpAttribute_Idn->setFormValue($val);
		}

		// Check field name 'IsDieselFuel' first before field var 'x_IsDieselFuel'
		$val = $CurrentForm->hasValue("IsDieselFuel") ? $CurrentForm->getValue("IsDieselFuel") : $CurrentForm->getValue("x_IsDieselFuel");
		if (!$this->IsDieselFuel->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsDieselFuel->Visible = FALSE; // Disable update for API request
			else
				$this->IsDieselFuel->setFormValue($val);
		}

		// Check field name 'IsSolution' first before field var 'x_IsSolution'
		$val = $CurrentForm->hasValue("IsSolution") ? $CurrentForm->getValue("IsSolution") : $CurrentForm->getValue("x_IsSolution");
		if (!$this->IsSolution->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsSolution->Visible = FALSE; // Disable update for API request
			else
				$this->IsSolution->setFormValue($val);
		}

		// Check field name 'Position_Idn' first before field var 'x_Position_Idn'
		$val = $CurrentForm->hasValue("Position_Idn") ? $CurrentForm->getValue("Position_Idn") : $CurrentForm->getValue("x_Position_Idn");
		if (!$this->Position_Idn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Position_Idn->Visible = FALSE; // Disable update for API request
			else
				$this->Position_Idn->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
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
		$row = [];
		$row['Product_Idn'] = NULL;
		$row['Department_Idn'] = NULL;
		$row['WorksheetMaster_Idn'] = NULL;
		$row['WorksheetCategory_Idn'] = NULL;
		$row['Manufacturer_Idn'] = NULL;
		$row['Rank'] = NULL;
		$row['Name'] = NULL;
		$row['MaterialUnitPrice'] = NULL;
		$row['FieldUnitPrice'] = NULL;
		$row['ShopUnitPrice'] = NULL;
		$row['EngineerUnitPrice'] = NULL;
		$row['DefaultQuantity'] = NULL;
		$row['ProductSize_Idn'] = NULL;
		$row['Description'] = NULL;
		$row['PipeType_Idn'] = NULL;
		$row['ScheduleType_Idn'] = NULL;
		$row['Fitting_Idn'] = NULL;
		$row['GroovedFittingType_Idn'] = NULL;
		$row['ThreadedFittingType_Idn'] = NULL;
		$row['HangerType_Idn'] = NULL;
		$row['HangerSubType_Idn'] = NULL;
		$row['SubcontractCategory_Idn'] = NULL;
		$row['ApplyToAdjustmentFactorsFlag'] = NULL;
		$row['ApplyToContingencyFlag'] = NULL;
		$row['IsMainComponent'] = NULL;
		$row['DomesticFlag'] = NULL;
		$row['LoadFlag'] = NULL;
		$row['AutoLoadFlag'] = NULL;
		$row['ActiveFlag'] = NULL;
		$row['GradeType_Idn'] = NULL;
		$row['PressureType_Idn'] = NULL;
		$row['SeamlessFlag'] = NULL;
		$row['ResponseType'] = NULL;
		$row['FMJobFlag'] = NULL;
		$row['RecommendedBoxes'] = NULL;
		$row['RecommendedWireFootage'] = NULL;
		$row['CoverageType_Idn'] = NULL;
		$row['HeadType_Idn'] = NULL;
		$row['FinishType_Idn'] = NULL;
		$row['Outlet_Idn'] = NULL;
		$row['RiserType_Idn'] = NULL;
		$row['BackFlowType_Idn'] = NULL;
		$row['ControlValve_Idn'] = NULL;
		$row['CheckValve_Idn'] = NULL;
		$row['FDCType_Idn'] = NULL;
		$row['BellType_Idn'] = NULL;
		$row['TappingTee_Idn'] = NULL;
		$row['UndergroundValve_Idn'] = NULL;
		$row['LiftDuration_Idn'] = NULL;
		$row['TrimPackageFlag'] = NULL;
		$row['ListedFlag'] = NULL;
		$row['BoxWireLength'] = NULL;
		$row['IsFirePump'] = NULL;
		$row['FirePumpType_Idn'] = NULL;
		$row['FirePumpAttribute_Idn'] = NULL;
		$row['IsDieselFuel'] = NULL;
		$row['IsSolution'] = NULL;
		$row['Position_Idn'] = NULL;
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
			if (strval($this->MaterialUnitPrice->EditValue) != "" && is_numeric($this->MaterialUnitPrice->EditValue))
				$this->MaterialUnitPrice->EditValue = FormatNumber($this->MaterialUnitPrice->EditValue, -2, -2, -2, -2);
			

			// FieldUnitPrice
			$this->FieldUnitPrice->EditAttrs["class"] = "form-control";
			$this->FieldUnitPrice->EditCustomAttributes = "";
			$this->FieldUnitPrice->EditValue = HtmlEncode($this->FieldUnitPrice->CurrentValue);
			$this->FieldUnitPrice->PlaceHolder = RemoveHtml($this->FieldUnitPrice->caption());
			if (strval($this->FieldUnitPrice->EditValue) != "" && is_numeric($this->FieldUnitPrice->EditValue))
				$this->FieldUnitPrice->EditValue = FormatNumber($this->FieldUnitPrice->EditValue, -2, -2, -2, -2);
			

			// ShopUnitPrice
			$this->ShopUnitPrice->EditAttrs["class"] = "form-control";
			$this->ShopUnitPrice->EditCustomAttributes = "";
			$this->ShopUnitPrice->EditValue = HtmlEncode($this->ShopUnitPrice->CurrentValue);
			$this->ShopUnitPrice->PlaceHolder = RemoveHtml($this->ShopUnitPrice->caption());
			if (strval($this->ShopUnitPrice->EditValue) != "" && is_numeric($this->ShopUnitPrice->EditValue))
				$this->ShopUnitPrice->EditValue = FormatNumber($this->ShopUnitPrice->EditValue, -2, -2, -2, -2);
			

			// EngineerUnitPrice
			$this->EngineerUnitPrice->EditAttrs["class"] = "form-control";
			$this->EngineerUnitPrice->EditCustomAttributes = "";
			$this->EngineerUnitPrice->EditValue = HtmlEncode($this->EngineerUnitPrice->CurrentValue);
			$this->EngineerUnitPrice->PlaceHolder = RemoveHtml($this->EngineerUnitPrice->caption());
			if (strval($this->EngineerUnitPrice->EditValue) != "" && is_numeric($this->EngineerUnitPrice->EditValue))
				$this->EngineerUnitPrice->EditValue = FormatNumber($this->EngineerUnitPrice->EditValue, -2, -2, -2, -2);
			

			// DefaultQuantity
			$this->DefaultQuantity->EditAttrs["class"] = "form-control";
			$this->DefaultQuantity->EditCustomAttributes = "";
			$this->DefaultQuantity->EditValue = HtmlEncode($this->DefaultQuantity->CurrentValue);
			$this->DefaultQuantity->PlaceHolder = RemoveHtml($this->DefaultQuantity->caption());
			if (strval($this->DefaultQuantity->EditValue) != "" && is_numeric($this->DefaultQuantity->EditValue))
				$this->DefaultQuantity->EditValue = FormatNumber($this->DefaultQuantity->EditValue, -2, -2, -2, -2);
			

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("Productslist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Set up multi pages
	protected function setupMultiPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add(0);
		$pages->add(1);
		$pages->add(2);
		$pages->add(3);
		$pages->add(4);
		$this->MultiPages = $pages;
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
} // End class
?>