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
$JobTypes_edit = new JobTypes_edit();

// Run the page
$JobTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fJobTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fJobTypesedit = currentForm = new ew.Form("fJobTypesedit", "edit");

	// Validate form
	fJobTypesedit.validate = function() {
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
			<?php if ($JobTypes_edit->JobType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_JobType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobTypes_edit->JobType_Idn->caption(), $JobTypes_edit->JobType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobTypes_edit->Name->caption(), $JobTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobTypes_edit->Rank->caption(), $JobTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($JobTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobTypes_edit->ActiveFlag->caption(), $JobTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fJobTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fJobTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fJobTypesedit.lists["x_ActiveFlag[]"] = <?php echo $JobTypes_edit->ActiveFlag->Lookup->toClientList($JobTypes_edit) ?>;
	fJobTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($JobTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fJobTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $JobTypes_edit->showPageHeader(); ?>
<?php
$JobTypes_edit->showMessage();
?>
<?php if (!$JobTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fJobTypesedit" id="fJobTypesedit" class="<?php echo $JobTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$JobTypes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($JobTypes_edit->JobType_Idn->Visible) { // JobType_Idn ?>
	<div id="r_JobType_Idn" class="form-group row">
		<label id="elh_JobTypes_JobType_Idn" class="<?php echo $JobTypes_edit->LeftColumnClass ?>"><?php echo $JobTypes_edit->JobType_Idn->caption() ?><?php echo $JobTypes_edit->JobType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobTypes_edit->RightColumnClass ?>"><div <?php echo $JobTypes_edit->JobType_Idn->cellAttributes() ?>>
<span id="el_JobTypes_JobType_Idn">
<span<?php echo $JobTypes_edit->JobType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($JobTypes_edit->JobType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="JobTypes" data-field="x_JobType_Idn" name="x_JobType_Idn" id="x_JobType_Idn" value="<?php echo HtmlEncode($JobTypes_edit->JobType_Idn->CurrentValue) ?>">
<?php echo $JobTypes_edit->JobType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_JobTypes_Name" for="x_Name" class="<?php echo $JobTypes_edit->LeftColumnClass ?>"><?php echo $JobTypes_edit->Name->caption() ?><?php echo $JobTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobTypes_edit->RightColumnClass ?>"><div <?php echo $JobTypes_edit->Name->cellAttributes() ?>>
<span id="el_JobTypes_Name">
<input type="text" data-table="JobTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($JobTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $JobTypes_edit->Name->EditValue ?>"<?php echo $JobTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $JobTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_JobTypes_Rank" for="x_Rank" class="<?php echo $JobTypes_edit->LeftColumnClass ?>"><?php echo $JobTypes_edit->Rank->caption() ?><?php echo $JobTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobTypes_edit->RightColumnClass ?>"><div <?php echo $JobTypes_edit->Rank->cellAttributes() ?>>
<span id="el_JobTypes_Rank">
<input type="text" data-table="JobTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $JobTypes_edit->Rank->EditValue ?>"<?php echo $JobTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $JobTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_JobTypes_ActiveFlag" class="<?php echo $JobTypes_edit->LeftColumnClass ?>"><?php echo $JobTypes_edit->ActiveFlag->caption() ?><?php echo $JobTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobTypes_edit->RightColumnClass ?>"><div <?php echo $JobTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_JobTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_154048" value="1"<?php echo $selwrk ?><?php echo $JobTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_154048"></label>
</div>
</span>
<?php echo $JobTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$JobTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $JobTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$JobTypes_edit->IsModal) { ?>
<?php echo $JobTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$JobTypes_edit->showPageFooter();
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
$JobTypes_edit->terminate();
?>