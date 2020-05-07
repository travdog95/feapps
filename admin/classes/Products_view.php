<?php
namespace PHPMaker2020\feapps51;

/**
 * Page class
 */
class Products_view extends Products
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}";

	// Table name
	public $TableName = 'Products';

	// Page object name
	public $PageObjName = "Products_view";

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
		$keyUrl = "";
		if (Get("Product_Idn") !== NULL) {
			$this->RecKey["Product_Idn"] = Get("Product_Idn");
			$keyUrl .= "&amp;Product_Idn=" . urlencode($this->RecKey["Product_Idn"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;

		// Table object (v_Administrators)
		if (!isset($GLOBALS['v_Administrators']))
			$GLOBALS['v_Administrators'] = new v_Administrators();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecords = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecKey = [];
	public $IsModal = FALSE;
	public $MultiPages; // Multi pages object

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SkipHeaderFooter;

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
			if (!$Security->canView()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("Productslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

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
		if (Get("Product_Idn") !== NULL) {
			if ($ExportFileName != "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("Product_Idn");
		}

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
		if (!$Security->canView()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("Productslist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;
		if ($this->isPageRequest()) { // Validate request
			if (Get("Product_Idn") !== NULL) {
				$this->Product_Idn->setQueryStringValue(Get("Product_Idn"));
				$this->RecKey["Product_Idn"] = $this->Product_Idn->QueryStringValue;
			} elseif (IsApi() && Key(0) !== NULL) {
				$this->Product_Idn->setQueryStringValue(Key(0));
				$this->RecKey["Product_Idn"] = $this->Product_Idn->QueryStringValue;
			} elseif (Post("Product_Idn") !== NULL) {
				$this->Product_Idn->setFormValue(Post("Product_Idn"));
				$this->RecKey["Product_Idn"] = $this->Product_Idn->FormValue;
			} elseif (IsApi() && Route(2) !== NULL) {
				$this->Product_Idn->setFormValue(Route(2));
				$this->RecKey["Product_Idn"] = $this->Product_Idn->FormValue;
			} else {
				$loadCurrentRecord = TRUE;
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display
					$this->StartRecord = 1; // Initialize start position
					if ($this->Recordset = $this->loadRecordset()) // Load records
						$this->TotalRecords = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecords <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$this->terminate("Productslist.php"); // Return to list page
					} elseif ($loadCurrentRecord) { // Load current record position
						$this->setupStartRecord(); // Set up start record position

						// Point to current record
						if ($this->StartRecord <= $this->TotalRecords) {
							$matchRecord = TRUE;
							$this->Recordset->move($this->StartRecord - 1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (SameString($this->Product_Idn->CurrentValue, $this->Recordset->fields('Product_Idn'))) {
								$this->setStartRecordNumber($this->StartRecord); // Save record position
								$matchRecord = TRUE;
								break;
							} else {
								$this->StartRecord++;
								$this->Recordset->moveNext();
							}
						}
					}
					if (!$matchRecord) {
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "Productslist.php"; // No matching record, return to list
					} else {
						$this->loadRowValues($this->Recordset); // Load row values
					}
			}

			// Export data only
			if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
				$this->exportData();
				$this->terminate();
			}
		} else {
			$returnUrl = "Productslist.php"; // Not page request, return to list
		}
		if ($returnUrl != "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager);
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl != "" && $Security->canAdd());

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl != "" && $Security->canEdit());

		// Copy
		$item = &$option->add("copy");
		$copycaption = HtmlTitle($Language->phrase("ViewPageCopyLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->CopyUrl) . "'});\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		$item->Visible = ($this->CopyUrl != "" && $Security->canAdd());

		// Delete
		$item = &$option->add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery($this->DeleteUrl, "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl != "" && $Security->canDelete());

		// Set up action default
		$option = $options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = TRUE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

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
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fProductsview, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fProductsview, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fProductsview, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_Products" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_Products\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fProductsview, key:' . ArrayToJsonAttribute($this->RecKey) . ', sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
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
		$selectLimit = FALSE;

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
		$this->setupStartRecord(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecords <= 0) {
			$this->StopRecord = $this->TotalRecords;
		} else {
			$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
		}
		$this->ExportDoc = GetExportDocument($this, "v");
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
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "view");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("Productslist.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
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
} // End class
?>