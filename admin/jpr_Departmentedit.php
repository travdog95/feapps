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
$jpr_Department_edit = new jpr_Department_edit();

// Run the page
$jpr_Department_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jpr_Department_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjpr_Departmentedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fjpr_Departmentedit = currentForm = new ew.Form("fjpr_Departmentedit", "edit");

	// Validate form
	fjpr_Departmentedit.validate = function() {
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
			<?php if ($jpr_Department_edit->DepartmentId->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jpr_Department_edit->DepartmentId->caption(), $jpr_Department_edit->DepartmentId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jpr_Department_edit->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jpr_Department_edit->Description->caption(), $jpr_Department_edit->Description->RequiredErrorMessage)) ?>");
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
	fjpr_Departmentedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjpr_Departmentedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fjpr_Departmentedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jpr_Department_edit->showPageHeader(); ?>
<?php
$jpr_Department_edit->showMessage();
?>
<?php if (!$jpr_Department_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jpr_Department_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fjpr_Departmentedit" id="fjpr_Departmentedit" class="<?php echo $jpr_Department_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jpr_Department">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$jpr_Department_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($jpr_Department_edit->DepartmentId->Visible) { // DepartmentId ?>
	<div id="r_DepartmentId" class="form-group row">
		<label id="elh_jpr_Department_DepartmentId" class="<?php echo $jpr_Department_edit->LeftColumnClass ?>"><?php echo $jpr_Department_edit->DepartmentId->caption() ?><?php echo $jpr_Department_edit->DepartmentId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jpr_Department_edit->RightColumnClass ?>"><div <?php echo $jpr_Department_edit->DepartmentId->cellAttributes() ?>>
<span id="el_jpr_Department_DepartmentId">
<span<?php echo $jpr_Department_edit->DepartmentId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($jpr_Department_edit->DepartmentId->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="jpr_Department" data-field="x_DepartmentId" name="x_DepartmentId" id="x_DepartmentId" value="<?php echo HtmlEncode($jpr_Department_edit->DepartmentId->CurrentValue) ?>">
<?php echo $jpr_Department_edit->DepartmentId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jpr_Department_edit->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_jpr_Department_Description" for="x_Description" class="<?php echo $jpr_Department_edit->LeftColumnClass ?>"><?php echo $jpr_Department_edit->Description->caption() ?><?php echo $jpr_Department_edit->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jpr_Department_edit->RightColumnClass ?>"><div <?php echo $jpr_Department_edit->Description->cellAttributes() ?>>
<span id="el_jpr_Department_Description">
<input type="text" data-table="jpr_Department" data-field="x_Description" name="x_Description" id="x_Description" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($jpr_Department_edit->Description->getPlaceHolder()) ?>" value="<?php echo $jpr_Department_edit->Description->EditValue ?>"<?php echo $jpr_Department_edit->Description->editAttributes() ?>>
</span>
<?php echo $jpr_Department_edit->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$jpr_Department_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jpr_Department_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jpr_Department_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$jpr_Department_edit->IsModal) { ?>
<?php echo $jpr_Department_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$jpr_Department_edit->showPageFooter();
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
$jpr_Department_edit->terminate();
?>