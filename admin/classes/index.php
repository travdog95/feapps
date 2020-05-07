<?php
namespace PHPMaker2020\feapps51;

/**
 * Class for index
 */
class index
{

	// Project ID
	public $ProjectID = "{F9BE56C1-2B96-4EAD-A4B7-9962C6BB1A43}";

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

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Constructor
	public function __construct() {
		$this->CheckToken = Config("CHECK_TOKEN");
	}

	// Terminate page
	public function terminate($url = "")
	{

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Page Redirecting event
		$this->Page_Redirecting($url);

		// Go to URL if specified
		if ($url != "") {
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	//
	// Page run
	//

	public function run()
	{
		global $Language, $UserProfile, $Security, $Breadcrumb;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// User profile
		$UserProfile = new UserProfile();

		// Security object
		$Security = new AdvancedSecurity();
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Breadcrumb
		$Breadcrumb = new Breadcrumb();

		// If session expired, show session expired message
		if (Get("expired") == "1")
			$this->setFailureMessage($Language->phrase("SessionExpired"));
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		if ($Security->allowList(CurrentProjectID() . 'Products'))
			$this->terminate("Productslist.php"); // Exit and go to default page
		if ($Security->allowList(CurrentProjectID() . 'AdjustmentFactors'))
			$this->terminate("AdjustmentFactorslist.php");
		if ($Security->allowList(CurrentProjectID() . 'AdjustmentSubFactors'))
			$this->terminate("AdjustmentSubFactorslist.php");
		if ($Security->allowList(CurrentProjectID() . 'BackflowTypes'))
			$this->terminate("BackflowTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'BellTypes'))
			$this->terminate("BellTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'BondRates'))
			$this->terminate("BondRateslist.php");
		if ($Security->allowList(CurrentProjectID() . 'CartParms'))
			$this->terminate("CartParmslist.php");
		if ($Security->allowList(CurrentProjectID() . 'CheckValves'))
			$this->terminate("CheckValveslist.php");
		if ($Security->allowList(CurrentProjectID() . 'ControlValves'))
			$this->terminate("ControlValveslist.php");
		if ($Security->allowList(CurrentProjectID() . 'CoverageTypes'))
			$this->terminate("CoverageTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'EngineeringAdditionalCosts'))
			$this->terminate("EngineeringAdditionalCostslist.php");
		if ($Security->allowList(CurrentProjectID() . 'EstimateTypes'))
			$this->terminate("EstimateTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'FDCTypes'))
			$this->terminate("FDCTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'FinishTypes'))
			$this->terminate("FinishTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'FinishWorks'))
			$this->terminate("FinishWorkslist.php");
		if ($Security->allowList(CurrentProjectID() . 'FirePumpAttributes'))
			$this->terminate("FirePumpAttributeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'FirePumpTypes'))
			$this->terminate("FirePumpTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'Fittings'))
			$this->terminate("Fittingslist.php");
		if ($Security->allowList(CurrentProjectID() . 'GPMs'))
			$this->terminate("GPMslist.php");
		if ($Security->allowList(CurrentProjectID() . 'GradeTypes'))
			$this->terminate("GradeTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'GroovedFittingTypes'))
			$this->terminate("GroovedFittingTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'HangerSubTypes'))
			$this->terminate("HangerSubTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'HangerTypes'))
			$this->terminate("HangerTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'HeadTypes'))
			$this->terminate("HeadTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'JobDefaults'))
			$this->terminate("JobDefaultslist.php");
		if ($Security->allowList(CurrentProjectID() . 'JobDefaultTypes'))
			$this->terminate("JobDefaultTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'JobStatuses'))
			$this->terminate("JobStatuseslist.php");
		if ($Security->allowList(CurrentProjectID() . 'JobTypes'))
			$this->terminate("JobTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'jpr_Department'))
			$this->terminate("jpr_Departmentlist.php");
		if ($Security->allowList(CurrentProjectID() . 'LiftDurations'))
			$this->terminate("LiftDurationslist.php");
		if ($Security->allowList(CurrentProjectID() . 'Manufacturers'))
			$this->terminate("Manufacturerslist.php");
		if ($Security->allowList(CurrentProjectID() . 'Menus'))
			$this->terminate("Menuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'MenuTypes'))
			$this->terminate("MenuTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'Outlets'))
			$this->terminate("Outletslist.php");
		if ($Security->allowList(CurrentProjectID() . 'PipeExposures'))
			$this->terminate("PipeExposureslist.php");
		if ($Security->allowList(CurrentProjectID() . 'PipeLengths'))
			$this->terminate("PipeLengthslist.php");
		if ($Security->allowList(CurrentProjectID() . 'PipeTypes'))
			$this->terminate("PipeTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'Positions'))
			$this->terminate("Positionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'PressureTypes'))
			$this->terminate("PressureTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'ProductSizes'))
			$this->terminate("ProductSizeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'RecapCells'))
			$this->terminate("RecapCellslist.php");
		if ($Security->allowList(CurrentProjectID() . 'RecapRows'))
			$this->terminate("RecapRowslist.php");
		if ($Security->allowList(CurrentProjectID() . 'RecapRowWorksheetMasters'))
			$this->terminate("RecapRowWorksheetMasterslist.php");
		if ($Security->allowList(CurrentProjectID() . 'RecapSubtotalCategories'))
			$this->terminate("RecapSubtotalCategorieslist.php");
		if ($Security->allowList(CurrentProjectID() . 'RecapTotalCategories'))
			$this->terminate("RecapTotalCategorieslist.php");
		if ($Security->allowList(CurrentProjectID() . 'RiserTypes'))
			$this->terminate("RiserTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'ScheduleTypes'))
			$this->terminate("ScheduleTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'ShopFabricationMultipliers'))
			$this->terminate("ShopFabricationMultiplierslist.php");
		if ($Security->allowList(CurrentProjectID() . 'ShopFabrications'))
			$this->terminate("ShopFabricationslist.php");
		if ($Security->allowList(CurrentProjectID() . 'SystemSubTypes'))
			$this->terminate("SystemSubTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'SystemTypes'))
			$this->terminate("SystemTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'TappingTees'))
			$this->terminate("TappingTeeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'ThreadedFittingTypes'))
			$this->terminate("ThreadedFittingTypeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'TrimPackages'))
			$this->terminate("TrimPackageslist.php");
		if ($Security->allowList(CurrentProjectID() . 'UndergroundValves'))
			$this->terminate("UndergroundValveslist.php");
		if ($Security->allowList(CurrentProjectID() . 'Users'))
			$this->terminate("Userslist.php");
		if ($Security->allowList(CurrentProjectID() . 'VolumeCorrections'))
			$this->terminate("VolumeCorrectionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'WorksheetCategories'))
			$this->terminate("WorksheetCategorieslist.php");
		if ($Security->allowList(CurrentProjectID() . 'WorksheetColumns'))
			$this->terminate("WorksheetColumnslist.php");
		if ($Security->allowList(CurrentProjectID() . 'WorksheetMasterCategories'))
			$this->terminate("WorksheetMasterCategorieslist.php");
		if ($Security->allowList(CurrentProjectID() . 'WorksheetMasters'))
			$this->terminate("WorksheetMasterslist.php");
		if ($Security->allowList(CurrentProjectID() . 'WorksheetMasterSizes'))
			$this->terminate("WorksheetMasterSizeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'WorksheetTemplates'))
			$this->terminate("WorksheetTemplateslist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_Administrators'))
			$this->terminate("v_Administratorslist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_WorksheetMasterCategories'))
			$this->terminate("v_WorksheetMasterCategorieslist.php");
		if ($Security->isLoggedIn()) {
			$this->setFailureMessage(DeniedMessage() . "<br><br><a href=\"logout.php\">" . $Language->phrase("BackToLogin") . "</a>");
		} else {
			$this->terminate("login.php"); // Exit and go to login page
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>