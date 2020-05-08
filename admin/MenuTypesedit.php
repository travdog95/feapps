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
$MenuTypes_edit = new MenuTypes_edit();

// Run the page
$MenuTypes_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$MenuTypes_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fMenuTypesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fMenuTypesedit = currentForm = new ew.Form("fMenuTypesedit", "edit");

	// Validate form
	fMenuTypesedit.validate = function() {
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
			<?php if ($MenuTypes_edit->MenuType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_MenuType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $MenuTypes_edit->MenuType_Idn->caption(), $MenuTypes_edit->MenuType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($MenuTypes_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $MenuTypes_edit->Name->caption(), $MenuTypes_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($MenuTypes_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $MenuTypes_edit->Rank->caption(), $MenuTypes_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($MenuTypes_edit->Rank->errorMessage()) ?>");
			<?php if ($MenuTypes_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $MenuTypes_edit->ActiveFlag->caption(), $MenuTypes_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fMenuTypesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fMenuTypesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fMenuTypesedit.lists["x_ActiveFlag[]"] = <?php echo $MenuTypes_edit->ActiveFlag->Lookup->toClientList($MenuTypes_edit) ?>;
	fMenuTypesedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($MenuTypes_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fMenuTypesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $MenuTypes_edit->showPageHeader(); ?>
<?php
$MenuTypes_edit->showMessage();
?>
<?php if (!$MenuTypes_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $MenuTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fMenuTypesedit" id="fMenuTypesedit" class="<?php echo $MenuTypes_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="MenuTypes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$MenuTypes_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($MenuTypes_edit->MenuType_Idn->Visible) { // MenuType_Idn ?>
	<div id="r_MenuType_Idn" class="form-group row">
		<label id="elh_MenuTypes_MenuType_Idn" class="<?php echo $MenuTypes_edit->LeftColumnClass ?>"><?php echo $MenuTypes_edit->MenuType_Idn->caption() ?><?php echo $MenuTypes_edit->MenuType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $MenuTypes_edit->RightColumnClass ?>"><div <?php echo $MenuTypes_edit->MenuType_Idn->cellAttributes() ?>>
<span id="el_MenuTypes_MenuType_Idn">
<span<?php echo $MenuTypes_edit->MenuType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($MenuTypes_edit->MenuType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="MenuTypes" data-field="x_MenuType_Idn" name="x_MenuType_Idn" id="x_MenuType_Idn" value="<?php echo HtmlEncode($MenuTypes_edit->MenuType_Idn->CurrentValue) ?>">
<?php echo $MenuTypes_edit->MenuType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($MenuTypes_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_MenuTypes_Name" for="x_Name" class="<?php echo $MenuTypes_edit->LeftColumnClass ?>"><?php echo $MenuTypes_edit->Name->caption() ?><?php echo $MenuTypes_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $MenuTypes_edit->RightColumnClass ?>"><div <?php echo $MenuTypes_edit->Name->cellAttributes() ?>>
<span id="el_MenuTypes_Name">
<input type="text" data-table="MenuTypes" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($MenuTypes_edit->Name->getPlaceHolder()) ?>" value="<?php echo $MenuTypes_edit->Name->EditValue ?>"<?php echo $MenuTypes_edit->Name->editAttributes() ?>>
</span>
<?php echo $MenuTypes_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($MenuTypes_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_MenuTypes_Rank" for="x_Rank" class="<?php echo $MenuTypes_edit->LeftColumnClass ?>"><?php echo $MenuTypes_edit->Rank->caption() ?><?php echo $MenuTypes_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $MenuTypes_edit->RightColumnClass ?>"><div <?php echo $MenuTypes_edit->Rank->cellAttributes() ?>>
<span id="el_MenuTypes_Rank">
<input type="text" data-table="MenuTypes" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($MenuTypes_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $MenuTypes_edit->Rank->EditValue ?>"<?php echo $MenuTypes_edit->Rank->editAttributes() ?>>
</span>
<?php echo $MenuTypes_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($MenuTypes_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_MenuTypes_ActiveFlag" class="<?php echo $MenuTypes_edit->LeftColumnClass ?>"><?php echo $MenuTypes_edit->ActiveFlag->caption() ?><?php echo $MenuTypes_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $MenuTypes_edit->RightColumnClass ?>"><div <?php echo $MenuTypes_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_MenuTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($MenuTypes_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="MenuTypes" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_925817" value="1"<?php echo $selwrk ?><?php echo $MenuTypes_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_925817"></label>
</div>
</span>
<?php echo $MenuTypes_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$MenuTypes_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $MenuTypes_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $MenuTypes_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$MenuTypes_edit->IsModal) { ?>
<?php echo $MenuTypes_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$MenuTypes_edit->showPageFooter();
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
$MenuTypes_edit->terminate();
?>