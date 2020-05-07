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
$WorksheetMasterSizes_add = new WorksheetMasterSizes_add();

// Run the page
$WorksheetMasterSizes_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasterSizes_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fWorksheetMasterSizesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fWorksheetMasterSizesadd = currentForm = new ew.Form("fWorksheetMasterSizesadd", "add");

	// Validate form
	fWorksheetMasterSizesadd.validate = function() {
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
			<?php if ($WorksheetMasterSizes_add->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterSizes_add->WorksheetMaster_Idn->caption(), $WorksheetMasterSizes_add->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterSizes_add->ProductSize_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductSize_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterSizes_add->ProductSize_Idn->caption(), $WorksheetMasterSizes_add->ProductSize_Idn->RequiredErrorMessage)) ?>");
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
	fWorksheetMasterSizesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetMasterSizesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetMasterSizesadd.lists["x_WorksheetMaster_Idn"] = <?php echo $WorksheetMasterSizes_add->WorksheetMaster_Idn->Lookup->toClientList($WorksheetMasterSizes_add) ?>;
	fWorksheetMasterSizesadd.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($WorksheetMasterSizes_add->WorksheetMaster_Idn->lookupOptions()) ?>;
	fWorksheetMasterSizesadd.lists["x_ProductSize_Idn"] = <?php echo $WorksheetMasterSizes_add->ProductSize_Idn->Lookup->toClientList($WorksheetMasterSizes_add) ?>;
	fWorksheetMasterSizesadd.lists["x_ProductSize_Idn"].options = <?php echo JsonEncode($WorksheetMasterSizes_add->ProductSize_Idn->lookupOptions()) ?>;
	loadjs.done("fWorksheetMasterSizesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $WorksheetMasterSizes_add->showPageHeader(); ?>
<?php
$WorksheetMasterSizes_add->showMessage();
?>
<form name="fWorksheetMasterSizesadd" id="fWorksheetMasterSizesadd" class="<?php echo $WorksheetMasterSizes_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetMasterSizes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$WorksheetMasterSizes_add->IsModal ?>">
<?php if ($WorksheetMasterSizes->getCurrentMasterTable() == "WorksheetMasters") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="WorksheetMasters">
<input type="hidden" name="fk_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_add->WorksheetMaster_Idn->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($WorksheetMasterSizes_add->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_WorksheetMasterSizes_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $WorksheetMasterSizes_add->LeftColumnClass ?>"><?php echo $WorksheetMasterSizes_add->WorksheetMaster_Idn->caption() ?><?php echo $WorksheetMasterSizes_add->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasterSizes_add->RightColumnClass ?>"><div <?php echo $WorksheetMasterSizes_add->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterSizes_add->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el_WorksheetMasterSizes_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterSizes_add->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterSizes_add->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_add->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el_WorksheetMasterSizes_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_add->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $WorksheetMasterSizes_add->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_add->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_add->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterSizes_add, "p_x_WorksheetMaster_Idn") ?>
</span>
<?php } ?>
<?php echo $WorksheetMasterSizes_add->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorksheetMasterSizes_add->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
	<div id="r_ProductSize_Idn" class="form-group row">
		<label id="elh_WorksheetMasterSizes_ProductSize_Idn" for="x_ProductSize_Idn" class="<?php echo $WorksheetMasterSizes_add->LeftColumnClass ?>"><?php echo $WorksheetMasterSizes_add->ProductSize_Idn->caption() ?><?php echo $WorksheetMasterSizes_add->ProductSize_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorksheetMasterSizes_add->RightColumnClass ?>"><div <?php echo $WorksheetMasterSizes_add->ProductSize_Idn->cellAttributes() ?>>
<span id="el_WorksheetMasterSizes_ProductSize_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_add->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x_ProductSize_Idn" name="x_ProductSize_Idn"<?php echo $WorksheetMasterSizes_add->ProductSize_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_add->ProductSize_Idn->selectOptionListHtml("x_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_add->ProductSize_Idn->Lookup->getParamTag($WorksheetMasterSizes_add, "p_x_ProductSize_Idn") ?>
</span>
<?php echo $WorksheetMasterSizes_add->ProductSize_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$WorksheetMasterSizes_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $WorksheetMasterSizes_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorksheetMasterSizes_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$WorksheetMasterSizes_add->showPageFooter();
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
$WorksheetMasterSizes_add->terminate();
?>