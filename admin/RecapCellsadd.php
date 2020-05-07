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
$RecapCells_add = new RecapCells_add();

// Run the page
$RecapCells_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapCells_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapCellsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fRecapCellsadd = currentForm = new ew.Form("fRecapCellsadd", "add");

	// Validate form
	fRecapCellsadd.validate = function() {
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
			<?php if ($RecapCells_add->WorksheetColumn_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetColumn_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapCells_add->WorksheetColumn_Idn->caption(), $RecapCells_add->WorksheetColumn_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_WorksheetColumn_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapCells_add->WorksheetColumn_Idn->errorMessage()) ?>");
			<?php if ($RecapCells_add->RecapRow_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RecapRow_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapCells_add->RecapRow_Idn->caption(), $RecapCells_add->RecapRow_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapCells_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapCells_add->ActiveFlag->caption(), $RecapCells_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fRecapCellsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapCellsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRecapCellsadd.lists["x_RecapRow_Idn"] = <?php echo $RecapCells_add->RecapRow_Idn->Lookup->toClientList($RecapCells_add) ?>;
	fRecapCellsadd.lists["x_RecapRow_Idn"].options = <?php echo JsonEncode($RecapCells_add->RecapRow_Idn->lookupOptions()) ?>;
	fRecapCellsadd.lists["x_ActiveFlag[]"] = <?php echo $RecapCells_add->ActiveFlag->Lookup->toClientList($RecapCells_add) ?>;
	fRecapCellsadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($RecapCells_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fRecapCellsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapCells_add->showPageHeader(); ?>
<?php
$RecapCells_add->showMessage();
?>
<form name="fRecapCellsadd" id="fRecapCellsadd" class="<?php echo $RecapCells_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapCells">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$RecapCells_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($RecapCells_add->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
	<div id="r_WorksheetColumn_Idn" class="form-group row">
		<label id="elh_RecapCells_WorksheetColumn_Idn" for="x_WorksheetColumn_Idn" class="<?php echo $RecapCells_add->LeftColumnClass ?>"><?php echo $RecapCells_add->WorksheetColumn_Idn->caption() ?><?php echo $RecapCells_add->WorksheetColumn_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapCells_add->RightColumnClass ?>"><div <?php echo $RecapCells_add->WorksheetColumn_Idn->cellAttributes() ?>>
<span id="el_RecapCells_WorksheetColumn_Idn">
<input type="text" data-table="RecapCells" data-field="x_WorksheetColumn_Idn" name="x_WorksheetColumn_Idn" id="x_WorksheetColumn_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapCells_add->WorksheetColumn_Idn->getPlaceHolder()) ?>" value="<?php echo $RecapCells_add->WorksheetColumn_Idn->EditValue ?>"<?php echo $RecapCells_add->WorksheetColumn_Idn->editAttributes() ?>>
</span>
<?php echo $RecapCells_add->WorksheetColumn_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapCells_add->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
	<div id="r_RecapRow_Idn" class="form-group row">
		<label id="elh_RecapCells_RecapRow_Idn" for="x_RecapRow_Idn" class="<?php echo $RecapCells_add->LeftColumnClass ?>"><?php echo $RecapCells_add->RecapRow_Idn->caption() ?><?php echo $RecapCells_add->RecapRow_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapCells_add->RightColumnClass ?>"><div <?php echo $RecapCells_add->RecapRow_Idn->cellAttributes() ?>>
<span id="el_RecapCells_RecapRow_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapCells" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapCells_add->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x_RecapRow_Idn" name="x_RecapRow_Idn"<?php echo $RecapCells_add->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapCells_add->RecapRow_Idn->selectOptionListHtml("x_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapCells_add->RecapRow_Idn->Lookup->getParamTag($RecapCells_add, "p_x_RecapRow_Idn") ?>
</span>
<?php echo $RecapCells_add->RecapRow_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapCells_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_RecapCells_ActiveFlag" class="<?php echo $RecapCells_add->LeftColumnClass ?>"><?php echo $RecapCells_add->ActiveFlag->caption() ?><?php echo $RecapCells_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapCells_add->RightColumnClass ?>"><div <?php echo $RecapCells_add->ActiveFlag->cellAttributes() ?>>
<span id="el_RecapCells_ActiveFlag">
<?php
$selwrk = ConvertToBool($RecapCells_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapCells" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_369552" value="1"<?php echo $selwrk ?><?php echo $RecapCells_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_369552"></label>
</div>
</span>
<?php echo $RecapCells_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$RecapCells_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $RecapCells_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapCells_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$RecapCells_add->showPageFooter();
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
$RecapCells_add->terminate();
?>