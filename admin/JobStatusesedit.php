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
$JobStatuses_edit = new JobStatuses_edit();

// Run the page
$JobStatuses_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobStatuses_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fJobStatusesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fJobStatusesedit = currentForm = new ew.Form("fJobStatusesedit", "edit");

	// Validate form
	fJobStatusesedit.validate = function() {
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
			<?php if ($JobStatuses_edit->JobStatus_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_JobStatus_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobStatuses_edit->JobStatus_Idn->caption(), $JobStatuses_edit->JobStatus_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobStatuses_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobStatuses_edit->Name->caption(), $JobStatuses_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobStatuses_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobStatuses_edit->Rank->caption(), $JobStatuses_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobStatuses_edit->Rank->errorMessage()) ?>");
			<?php if ($JobStatuses_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobStatuses_edit->ActiveFlag->caption(), $JobStatuses_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fJobStatusesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fJobStatusesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fJobStatusesedit.lists["x_ActiveFlag[]"] = <?php echo $JobStatuses_edit->ActiveFlag->Lookup->toClientList($JobStatuses_edit) ?>;
	fJobStatusesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($JobStatuses_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fJobStatusesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $JobStatuses_edit->showPageHeader(); ?>
<?php
$JobStatuses_edit->showMessage();
?>
<?php if (!$JobStatuses_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobStatuses_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fJobStatusesedit" id="fJobStatusesedit" class="<?php echo $JobStatuses_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobStatuses">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$JobStatuses_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($JobStatuses_edit->JobStatus_Idn->Visible) { // JobStatus_Idn ?>
	<div id="r_JobStatus_Idn" class="form-group row">
		<label id="elh_JobStatuses_JobStatus_Idn" class="<?php echo $JobStatuses_edit->LeftColumnClass ?>"><?php echo $JobStatuses_edit->JobStatus_Idn->caption() ?><?php echo $JobStatuses_edit->JobStatus_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobStatuses_edit->RightColumnClass ?>"><div <?php echo $JobStatuses_edit->JobStatus_Idn->cellAttributes() ?>>
<span id="el_JobStatuses_JobStatus_Idn">
<span<?php echo $JobStatuses_edit->JobStatus_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($JobStatuses_edit->JobStatus_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="JobStatuses" data-field="x_JobStatus_Idn" name="x_JobStatus_Idn" id="x_JobStatus_Idn" value="<?php echo HtmlEncode($JobStatuses_edit->JobStatus_Idn->CurrentValue) ?>">
<?php echo $JobStatuses_edit->JobStatus_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobStatuses_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_JobStatuses_Name" for="x_Name" class="<?php echo $JobStatuses_edit->LeftColumnClass ?>"><?php echo $JobStatuses_edit->Name->caption() ?><?php echo $JobStatuses_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobStatuses_edit->RightColumnClass ?>"><div <?php echo $JobStatuses_edit->Name->cellAttributes() ?>>
<span id="el_JobStatuses_Name">
<input type="text" data-table="JobStatuses" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobStatuses_edit->Name->getPlaceHolder()) ?>" value="<?php echo $JobStatuses_edit->Name->EditValue ?>"<?php echo $JobStatuses_edit->Name->editAttributes() ?>>
</span>
<?php echo $JobStatuses_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobStatuses_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_JobStatuses_Rank" for="x_Rank" class="<?php echo $JobStatuses_edit->LeftColumnClass ?>"><?php echo $JobStatuses_edit->Rank->caption() ?><?php echo $JobStatuses_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobStatuses_edit->RightColumnClass ?>"><div <?php echo $JobStatuses_edit->Rank->cellAttributes() ?>>
<span id="el_JobStatuses_Rank">
<input type="text" data-table="JobStatuses" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobStatuses_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $JobStatuses_edit->Rank->EditValue ?>"<?php echo $JobStatuses_edit->Rank->editAttributes() ?>>
</span>
<?php echo $JobStatuses_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobStatuses_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_JobStatuses_ActiveFlag" class="<?php echo $JobStatuses_edit->LeftColumnClass ?>"><?php echo $JobStatuses_edit->ActiveFlag->caption() ?><?php echo $JobStatuses_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobStatuses_edit->RightColumnClass ?>"><div <?php echo $JobStatuses_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_JobStatuses_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobStatuses_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobStatuses" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_240438" value="1"<?php echo $selwrk ?><?php echo $JobStatuses_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_240438"></label>
</div>
</span>
<?php echo $JobStatuses_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$JobStatuses_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $JobStatuses_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobStatuses_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$JobStatuses_edit->IsModal) { ?>
<?php echo $JobStatuses_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$JobStatuses_edit->showPageFooter();
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
$JobStatuses_edit->terminate();
?>