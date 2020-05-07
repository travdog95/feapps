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
$RecapRowWorksheetMasters_add = new RecapRowWorksheetMasters_add();

// Run the page
$RecapRowWorksheetMasters_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapRowWorksheetMasters_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapRowWorksheetMastersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fRecapRowWorksheetMastersadd = currentForm = new ew.Form("fRecapRowWorksheetMastersadd", "add");

	// Validate form
	fRecapRowWorksheetMastersadd.validate = function() {
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
			<?php if ($RecapRowWorksheetMasters_add->RecapRow_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RecapRow_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRowWorksheetMasters_add->RecapRow_Idn->caption(), $RecapRowWorksheetMasters_add->RecapRow_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRowWorksheetMasters_add->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRowWorksheetMasters_add->WorksheetMaster_Idn->caption(), $RecapRowWorksheetMasters_add->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
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
	fRecapRowWorksheetMastersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapRowWorksheetMastersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRecapRowWorksheetMastersadd.lists["x_RecapRow_Idn"] = <?php echo $RecapRowWorksheetMasters_add->RecapRow_Idn->Lookup->toClientList($RecapRowWorksheetMasters_add) ?>;
	fRecapRowWorksheetMastersadd.lists["x_RecapRow_Idn"].options = <?php echo JsonEncode($RecapRowWorksheetMasters_add->RecapRow_Idn->lookupOptions()) ?>;
	fRecapRowWorksheetMastersadd.lists["x_WorksheetMaster_Idn"] = <?php echo $RecapRowWorksheetMasters_add->WorksheetMaster_Idn->Lookup->toClientList($RecapRowWorksheetMasters_add) ?>;
	fRecapRowWorksheetMastersadd.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($RecapRowWorksheetMasters_add->WorksheetMaster_Idn->lookupOptions()) ?>;
	loadjs.done("fRecapRowWorksheetMastersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapRowWorksheetMasters_add->showPageHeader(); ?>
<?php
$RecapRowWorksheetMasters_add->showMessage();
?>
<form name="fRecapRowWorksheetMastersadd" id="fRecapRowWorksheetMastersadd" class="<?php echo $RecapRowWorksheetMasters_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapRowWorksheetMasters">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$RecapRowWorksheetMasters_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($RecapRowWorksheetMasters_add->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
	<div id="r_RecapRow_Idn" class="form-group row">
		<label id="elh_RecapRowWorksheetMasters_RecapRow_Idn" for="x_RecapRow_Idn" class="<?php echo $RecapRowWorksheetMasters_add->LeftColumnClass ?>"><?php echo $RecapRowWorksheetMasters_add->RecapRow_Idn->caption() ?><?php echo $RecapRowWorksheetMasters_add->RecapRow_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRowWorksheetMasters_add->RightColumnClass ?>"><div <?php echo $RecapRowWorksheetMasters_add->RecapRow_Idn->cellAttributes() ?>>
<span id="el_RecapRowWorksheetMasters_RecapRow_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_add->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x_RecapRow_Idn" name="x_RecapRow_Idn"<?php echo $RecapRowWorksheetMasters_add->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_add->RecapRow_Idn->selectOptionListHtml("x_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_add->RecapRow_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_add, "p_x_RecapRow_Idn") ?>
</span>
<?php echo $RecapRowWorksheetMasters_add->RecapRow_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapRowWorksheetMasters_add->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<div id="r_WorksheetMaster_Idn" class="form-group row">
		<label id="elh_RecapRowWorksheetMasters_WorksheetMaster_Idn" for="x_WorksheetMaster_Idn" class="<?php echo $RecapRowWorksheetMasters_add->LeftColumnClass ?>"><?php echo $RecapRowWorksheetMasters_add->WorksheetMaster_Idn->caption() ?><?php echo $RecapRowWorksheetMasters_add->WorksheetMaster_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapRowWorksheetMasters_add->RightColumnClass ?>"><div <?php echo $RecapRowWorksheetMasters_add->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el_RecapRowWorksheetMasters_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_add->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $RecapRowWorksheetMasters_add->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_add->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_add->WorksheetMaster_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_add, "p_x_WorksheetMaster_Idn") ?>
</span>
<?php echo $RecapRowWorksheetMasters_add->WorksheetMaster_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$RecapRowWorksheetMasters_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $RecapRowWorksheetMasters_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapRowWorksheetMasters_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$RecapRowWorksheetMasters_add->showPageFooter();
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
$RecapRowWorksheetMasters_add->terminate();
?>