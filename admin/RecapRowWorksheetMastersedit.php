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
$RecapRowWorksheetMasters_edit = new RecapRowWorksheetMasters_edit();

// Run the page
$RecapRowWorksheetMasters_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapRowWorksheetMasters_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapRowWorksheetMastersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fRecapRowWorksheetMastersedit = currentForm = new ew.Form("fRecapRowWorksheetMastersedit", "edit");

	// Validate form
	fRecapRowWorksheetMastersedit.validate = function() {
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
			<?php if ($RecapRowWorksheetMasters_edit->RecapRow_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RecapRow_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRowWorksheetMasters_edit->RecapRow_Idn->caption(), $RecapRowWorksheetMasters_edit->RecapRow_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->caption(), $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
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
	fRecapRowWorksheetMastersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapRowWorksheetMastersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRecapRowWorksheetMastersedit.lists["x_RecapRow_Idn"] = <?php echo $RecapRowWorksheetMasters_edit->RecapRow_Idn->Lookup->toClientList($RecapRowWorksheetMasters_edit) ?>;
	fRecapRowWorksheetMastersedit.lists["x_RecapRow_Idn"].options = <?php echo JsonEncode($RecapRowWorksheetMasters_edit->RecapRow_Idn->lookupOptions()) ?>;
	fRecapRowWorksheetMastersedit.lists["x_WorksheetMaster_Idn"] = <?php echo $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->Lookup->toClientList($RecapRowWorksheetMasters_edit) ?>;
	fRecapRowWorksheetMastersedit.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->lookupOptions()) ?>;
	loadjs.done("fRecapRowWorksheetMastersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapRowWorksheetMasters_edit->showPageHeader(); ?>
<?php
$RecapRowWorksheetMasters_edit->showMessage();
?>
<?php if (!$RecapRowWorksheetMasters_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapRowWorksheetMasters_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fRecapRowWorksheetMastersedit" id="fRecapRowWorksheetMastersedit" class="<?php echo $RecapRowWorksheetMasters_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapRowWorksheetMasters">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$RecapRowWorksheetMasters_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($RecapRowWorksheetMasters_edit->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
	<div id="r_RecapRow_Idn" class="form-group row">
		<label id="elh_RecapRowWorksheetMasters_RecapRow_Idn" for="x_RecapRow_Idn" class="<?php echo $RecapRowWorksheetMasters_edit->LeftColumnClass ?>"><?php echo $RecapRowWorksheetMasters_edit->RecapRow_Idn->caption() ?><?php echo $RecapRowWorksheetMasters_edit->RecapRow_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRowWorksheetMasters_edit->RightColumnClass ?>"><div <?php echo $RecapRowWorksheetMasters_edit->RecapRow_Idn->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_edit->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x_RecapRow_Idn" name="x_RecapRow_Idn"<?php echo $RecapRowWorksheetMasters_edit->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_edit->RecapRow_Idn->selectOptionListHtml("x_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_edit->RecapRow_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_edit, "p_x_RecapRow_Idn") ?>
<input type="hidden" data-table="RecapRowWorksheetMasters" data-field="x_RecapRow_Idn" name="o_RecapRow_Idn" id="o_RecapRow_Idn" value="<?php echo HtmlEncode($RecapRowWorksheetMasters_edit->RecapRow_Idn->OldValue != null ? $RecapRowWorksheetMasters_edit->RecapRow_Idn->OldValue : $RecapRowWorksheetMasters_edit->RecapRow_Idn->CurrentValue) ?>">
<?php echo $RecapRowWorksheetMasters_edit->RecapRow_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_RecapRowWorksheetMasters_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $RecapRowWorksheetMasters_edit->LeftColumnClass ?>"><?php echo $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->caption() ?><?php echo $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRowWorksheetMasters_edit->RightColumnClass ?>"><div <?php echo $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_edit, "p_x_WorksheetMaster_Idn") ?>
<input type="hidden" data-table="RecapRowWorksheetMasters" data-field="x_WorksheetMaster_Idn" name="o_WorksheetMaster_Idn" id="o_WorksheetMaster_Idn" value="<?php echo HtmlEncode($RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->OldValue != null ? $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->OldValue : $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->CurrentValue) ?>">
<?php echo $RecapRowWorksheetMasters_edit->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$RecapRowWorksheetMasters_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $RecapRowWorksheetMasters_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapRowWorksheetMasters_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$RecapRowWorksheetMasters_edit->IsModal) { ?>
<?php echo $RecapRowWorksheetMasters_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$RecapRowWorksheetMasters_edit->showPageFooter();
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
$RecapRowWorksheetMasters_edit->terminate();
?>