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
$ScheduleTypes_edit = new ScheduleTypes_edit();

// Run the page
$ScheduleTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ScheduleTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fScheduleTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fScheduleTypesedit = currentForm = new ew.Form("fScheduleTypesedit", "edit");

	// Validate form
	fScheduleTypesedit.validate = function() {
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
			<?php if ($ScheduleTypes_edit->ScheduleType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ScheduleType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_edit->ScheduleType_Idn->caption(), $ScheduleTypes_edit->ScheduleType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ScheduleTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_edit->Name->caption(), $ScheduleTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ScheduleTypes_edit->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_edit->ShortName->caption(), $ScheduleTypes_edit->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ScheduleTypes_edit->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_edit->Department_Idn->caption(), $ScheduleTypes_edit->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ScheduleTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_edit->Rank->caption(), $ScheduleTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ScheduleTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($ScheduleTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_edit->ActiveFlag->caption(), $ScheduleTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fScheduleTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fScheduleTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fScheduleTypesedit.lists["x_Department_Idn"] = <?php echo $ScheduleTypes_edit->Department_Idn->Lookup->toClientList($ScheduleTypes_edit) ?>;
	fScheduleTypesedit.lists["x_Department_Idn"].options = <?php echo JsonEncode($ScheduleTypes_edit->Department_Idn->lookupOptions()) ?>;
	fScheduleTypesedit.lists["x_ActiveFlag[]"] = <?php echo $ScheduleTypes_edit->ActiveFlag->Lookup->toClientList($ScheduleTypes_edit) ?>;
	fScheduleTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ScheduleTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fScheduleTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ScheduleTypes_edit->showPageHeader(); ?>
<?php
$ScheduleTypes_edit->showMessage();
?>
<?php if (!$ScheduleTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ScheduleTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fScheduleTypesedit" id="fScheduleTypesedit" class="<?php echo $ScheduleTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ScheduleTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ScheduleTypes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ScheduleTypes_edit->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
	<div id="r_ScheduleType_Idn" class="form-group row">
		<label id="elh_ScheduleTypes_ScheduleType_Idn" class="<?php echo $ScheduleTypes_edit->LeftColumnClass ?>"><?php echo $ScheduleTypes_edit->ScheduleType_Idn->caption() ?><?php echo $ScheduleTypes_edit->ScheduleType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ScheduleTypes_edit->RightColumnClass ?>"><div <?php echo $ScheduleTypes_edit->ScheduleType_Idn->cellAttributes() ?>>
<span id="el_ScheduleTypes_ScheduleType_Idn">
<span<?php echo $ScheduleTypes_edit->ScheduleType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ScheduleTypes_edit->ScheduleType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_ScheduleType_Idn" name="x_ScheduleType_Idn" id="x_ScheduleType_Idn" value="<?php echo HtmlEncode($ScheduleTypes_edit->ScheduleType_Idn->CurrentValue) ?>">
<?php echo $ScheduleTypes_edit->ScheduleType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ScheduleTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_ScheduleTypes_Name" for="x_Name" class="<?php echo $ScheduleTypes_edit->LeftColumnClass ?>"><?php echo $ScheduleTypes_edit->Name->caption() ?><?php echo $ScheduleTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ScheduleTypes_edit->RightColumnClass ?>"><div <?php echo $ScheduleTypes_edit->Name->cellAttributes() ?>>
<span id="el_ScheduleTypes_Name">
<input type="text" data-table="ScheduleTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ScheduleTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_edit->Name->EditValue ?>"<?php echo $ScheduleTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $ScheduleTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ScheduleTypes_edit->ShortName->Visible) { // ShortName ?>
	<div id="r_ShortName" class="form-group row">
		<label id="elh_ScheduleTypes_ShortName" for="x_ShortName" class="<?php echo $ScheduleTypes_edit->LeftColumnClass ?>"><?php echo $ScheduleTypes_edit->ShortName->caption() ?><?php echo $ScheduleTypes_edit->ShortName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ScheduleTypes_edit->RightColumnClass ?>"><div <?php echo $ScheduleTypes_edit->ShortName->cellAttributes() ?>>
<span id="el_ScheduleTypes_ShortName">
<input type="text" data-table="ScheduleTypes" data-field="x_ShortName" name="x_ShortName" id="x_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($ScheduleTypes_edit->ShortName->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_edit->ShortName->EditValue ?>"<?php echo $ScheduleTypes_edit->ShortName->editAttributes() ?>>
</span>
<?php echo $ScheduleTypes_edit->ShortName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ScheduleTypes_edit->Department_Idn->Visible) { // Department_Idn ?>
	<div id="r_Department_Idn" class="form-group row">
		<label id="elh_ScheduleTypes_Department_Idn" for="x_Department_Idn" class="<?php echo $ScheduleTypes_edit->LeftColumnClass ?>"><?php echo $ScheduleTypes_edit->Department_Idn->caption() ?><?php echo $ScheduleTypes_edit->Department_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ScheduleTypes_edit->RightColumnClass ?>"><div <?php echo $ScheduleTypes_edit->Department_Idn->cellAttributes() ?>>
<span id="el_ScheduleTypes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ScheduleTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $ScheduleTypes_edit->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $ScheduleTypes_edit->Department_Idn->editAttributes() ?>>
			<?php echo $ScheduleTypes_edit->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $ScheduleTypes_edit->Department_Idn->Lookup->getParamTag($ScheduleTypes_edit, "p_x_Department_Idn") ?>
</span>
<?php echo $ScheduleTypes_edit->Department_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ScheduleTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_ScheduleTypes_Rank" for="x_Rank" class="<?php echo $ScheduleTypes_edit->LeftColumnClass ?>"><?php echo $ScheduleTypes_edit->Rank->caption() ?><?php echo $ScheduleTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ScheduleTypes_edit->RightColumnClass ?>"><div <?php echo $ScheduleTypes_edit->Rank->cellAttributes() ?>>
<span id="el_ScheduleTypes_Rank">
<input type="text" data-table="ScheduleTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ScheduleTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_edit->Rank->EditValue ?>"<?php echo $ScheduleTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $ScheduleTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ScheduleTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_ScheduleTypes_ActiveFlag" class="<?php echo $ScheduleTypes_edit->LeftColumnClass ?>"><?php echo $ScheduleTypes_edit->ActiveFlag->caption() ?><?php echo $ScheduleTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ScheduleTypes_edit->RightColumnClass ?>"><div <?php echo $ScheduleTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_ScheduleTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($ScheduleTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ScheduleTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_330019" value="1"<?php echo $selwrk ?><?php echo $ScheduleTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_330019"></label>
</div>
</span>
<?php echo $ScheduleTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ScheduleTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ScheduleTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ScheduleTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ScheduleTypes_edit->IsModal) { ?>
<?php echo $ScheduleTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ScheduleTypes_edit->showPageFooter();
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
$ScheduleTypes_edit->terminate();
?>