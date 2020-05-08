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
$RecapCells_edit = new RecapCells_edit();

// Run the page
$RecapCells_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapCells_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRecapCellsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fRecapCellsedit = currentForm = new ew.Form("fRecapCellsedit", "edit");

	// Validate form
	fRecapCellsedit.validate = function() {
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
			<?php if ($RecapCells_edit->WorksheetColumn_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetColumn_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapCells_edit->WorksheetColumn_Idn->caption(), $RecapCells_edit->WorksheetColumn_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_WorksheetColumn_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapCells_edit->WorksheetColumn_Idn->errorMessage()) ?>");
			<?php if ($RecapCells_edit->RecapRow_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RecapRow_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapCells_edit->RecapRow_Idn->caption(), $RecapCells_edit->RecapRow_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapCells_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapCells_edit->ActiveFlag->caption(), $RecapCells_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fRecapCellsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapCellsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRecapCellsedit.lists["x_RecapRow_Idn"] = <?php echo $RecapCells_edit->RecapRow_Idn->Lookup->toClientList($RecapCells_edit) ?>;
	fRecapCellsedit.lists["x_RecapRow_Idn"].options = <?php echo JsonEncode($RecapCells_edit->RecapRow_Idn->lookupOptions()) ?>;
	fRecapCellsedit.lists["x_ActiveFlag[]"] = <?php echo $RecapCells_edit->ActiveFlag->Lookup->toClientList($RecapCells_edit) ?>;
	fRecapCellsedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($RecapCells_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fRecapCellsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $RecapCells_edit->showPageHeader(); ?>
<?php
$RecapCells_edit->showMessage();
?>
<?php if (!$RecapCells_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapCells_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fRecapCellsedit" id="fRecapCellsedit" class="<?php echo $RecapCells_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapCells">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$RecapCells_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($RecapCells_edit->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
	<div id="r_WorksheetColumn_Idn" class="form-group row">
		<label id="elh_RecapCells_WorksheetColumn_Idn" for="x_WorksheetColumn_Idn" class="<?php echo $RecapCells_edit->LeftColumnClass ?>"><?php echo $RecapCells_edit->WorksheetColumn_Idn->caption() ?><?php echo $RecapCells_edit->WorksheetColumn_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapCells_edit->RightColumnClass ?>"><div <?php echo $RecapCells_edit->WorksheetColumn_Idn->cellAttributes() ?>>
<input type="text" data-table="RecapCells" data-field="x_WorksheetColumn_Idn" name="x_WorksheetColumn_Idn" id="x_WorksheetColumn_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapCells_edit->WorksheetColumn_Idn->getPlaceHolder()) ?>" value="<?php echo $RecapCells_edit->WorksheetColumn_Idn->EditValue ?>"<?php echo $RecapCells_edit->WorksheetColumn_Idn->editAttributes() ?>>
<input type="hidden" data-table="RecapCells" data-field="x_WorksheetColumn_Idn" name="o_WorksheetColumn_Idn" id="o_WorksheetColumn_Idn" value="<?php echo HtmlEncode($RecapCells_edit->WorksheetColumn_Idn->OldValue != null ? $RecapCells_edit->WorksheetColumn_Idn->OldValue : $RecapCells_edit->WorksheetColumn_Idn->CurrentValue) ?>">
<?php echo $RecapCells_edit->WorksheetColumn_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapCells_edit->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
	<div id="r_RecapRow_Idn" class="form-group row">
		<label id="elh_RecapCells_RecapRow_Idn" for="x_RecapRow_Idn" class="<?php echo $RecapCells_edit->LeftColumnClass ?>"><?php echo $RecapCells_edit->RecapRow_Idn->caption() ?><?php echo $RecapCells_edit->RecapRow_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapCells_edit->RightColumnClass ?>"><div <?php echo $RecapCells_edit->RecapRow_Idn->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapCells" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapCells_edit->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x_RecapRow_Idn" name="x_RecapRow_Idn"<?php echo $RecapCells_edit->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapCells_edit->RecapRow_Idn->selectOptionListHtml("x_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapCells_edit->RecapRow_Idn->Lookup->getParamTag($RecapCells_edit, "p_x_RecapRow_Idn") ?>
<input type="hidden" data-table="RecapCells" data-field="x_RecapRow_Idn" name="o_RecapRow_Idn" id="o_RecapRow_Idn" value="<?php echo HtmlEncode($RecapCells_edit->RecapRow_Idn->OldValue != null ? $RecapCells_edit->RecapRow_Idn->OldValue : $RecapCells_edit->RecapRow_Idn->CurrentValue) ?>">
<?php echo $RecapCells_edit->RecapRow_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($RecapCells_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_RecapCells_ActiveFlag" class="<?php echo $RecapCells_edit->LeftColumnClass ?>"><?php echo $RecapCells_edit->ActiveFlag->caption() ?><?php echo $RecapCells_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $RecapCells_edit->RightColumnClass ?>"><div <?php echo $RecapCells_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_RecapCells_ActiveFlag">
<?php
$selwrk = ConvertToBool($RecapCells_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapCells" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_431277" value="1"<?php echo $selwrk ?><?php echo $RecapCells_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_431277"></label>
</div>
</span>
<?php echo $RecapCells_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$RecapCells_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $RecapCells_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $RecapCells_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$RecapCells_edit->IsModal) { ?>
<?php echo $RecapCells_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$RecapCells_edit->showPageFooter();
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
$RecapCells_edit->terminate();
?>