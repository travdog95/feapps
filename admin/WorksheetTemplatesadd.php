<?php
namespace PHPMaker2020\feapps51;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$WorksheetTemplates_add = new WorksheetTemplates_add();

// Run the page
$WorksheetTemplates_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetTemplates_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetTemplatesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fWorksheetTemplatesadd = currentForm = new ew.Form("fWorksheetTemplatesadd", "add");

	// Validate form
	fWorksheetTemplatesadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($WorksheetTemplates_add->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetTemplates_add->WorksheetMaster_Idn->caption(), $WorksheetTemplates_add->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetTemplates_add->WorksheetColumn_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetColumn_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetTemplates_add->WorksheetColumn_Idn->caption(), $WorksheetTemplates_add->WorksheetColumn_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetTemplates_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetTemplates_add->ActiveFlag->caption(), $WorksheetTemplates_add->ActiveFlag->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fWorksheetTemplatesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetTemplatesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetTemplatesadd.lists["x_WorksheetMaster_Idn"] = <?php echo $WorksheetTemplates_add->WorksheetMaster_Idn->Lookup->toClientList($WorksheetTemplates_add) ?>;
	fWorksheetTemplatesadd.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($WorksheetTemplates_add->WorksheetMaster_Idn->lookupOptions()) ?>;
	fWorksheetTemplatesadd.lists["x_WorksheetColumn_Idn"] = <?php echo $WorksheetTemplates_add->WorksheetColumn_Idn->Lookup->toClientList($WorksheetTemplates_add) ?>;
	fWorksheetTemplatesadd.lists["x_WorksheetColumn_Idn"].options = <?php echo JsonEncode($WorksheetTemplates_add->WorksheetColumn_Idn->lookupOptions()) ?>;
	fWorksheetTemplatesadd.lists["x_ActiveFlag[]"] = <?php echo $WorksheetTemplates_add->ActiveFlag->Lookup->toClientList($WorksheetTemplates_add) ?>;
	fWorksheetTemplatesadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($WorksheetTemplates_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fWorksheetTemplatesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetTemplates_add->showPageHeader(); ?>
<?php
$WorksheetTemplates_add->showMessage();
?>
<form name="fWorksheetTemplatesadd" id="fWorksheetTemplatesadd" class="<?php echo $WorksheetTemplates_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetTemplates">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$WorksheetTemplates_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($WorksheetTemplates_add->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_WorksheetTemplates_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $WorksheetTemplates_add->LeftColumnClass ?>"><?php echo $WorksheetTemplates_add->WorksheetMaster_Idn->caption() ?><?php echo $WorksheetTemplates_add->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetTemplates_add->RightColumnClass ?>"><div <?php echo $WorksheetTemplates_add->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_WorksheetTemplates_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetTemplates" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetTemplates_add->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $WorksheetTemplates_add->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetTemplates_add->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetTemplates_add->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetTemplates_add, "p_x_WorksheetMaster_Idn") ?>
</span>
<?php echo $WorksheetTemplates_add->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetTemplates_add->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
	<div id="r_WorksheetColumn_Idn" class="form-group row">
		<label id="elh_WorksheetTemplates_WorksheetColumn_Idn" for="x_WorksheetColumn_Idn" class="<?php echo $WorksheetTemplates_add->LeftColumnClass ?>"><?php echo $WorksheetTemplates_add->WorksheetColumn_Idn->caption() ?><?php echo $WorksheetTemplates_add->WorksheetColumn_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetTemplates_add->RightColumnClass ?>"><div <?php echo $WorksheetTemplates_add->WorksheetColumn_Idn->cellAttributes() ?>>
<span id="el_WorksheetTemplates_WorksheetColumn_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetTemplates" data-field="x_WorksheetColumn_Idn" data-value-separator="<?php echo $WorksheetTemplates_add->WorksheetColumn_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetColumn_Idn" name="x_WorksheetColumn_Idn"<?php echo $WorksheetTemplates_add->WorksheetColumn_Idn->editAttributes() ?>>
			<?php echo $WorksheetTemplates_add->WorksheetColumn_Idn->selectOptionListHtml("x_WorksheetColumn_Idn") ?>
		</select>
</div>
<?php echo $WorksheetTemplates_add->WorksheetColumn_Idn->Lookup->getParamTag($WorksheetTemplates_add, "p_x_WorksheetColumn_Idn") ?>
</span>
<?php echo $WorksheetTemplates_add->WorksheetColumn_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetTemplates_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_WorksheetTemplates_ActiveFlag" class="<?php echo $WorksheetTemplates_add->LeftColumnClass ?>"><?php echo $WorksheetTemplates_add->ActiveFlag->caption() ?><?php echo $WorksheetTemplates_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetTemplates_add->RightColumnClass ?>"><div <?php echo $WorksheetTemplates_add->ActiveFlag->cellAttributes() ?>>
<span id="el_WorksheetTemplates_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetTemplates_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetTemplates" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_373184" value="1"<?php echo $selwrk ?><?php echo $WorksheetTemplates_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_373184"></label>
</div>
</span>
<?php echo $WorksheetTemplates_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$WorksheetTemplates_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $WorksheetTemplates_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetTemplates_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$WorksheetTemplates_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$WorksheetTemplates_add->terminate();
?>