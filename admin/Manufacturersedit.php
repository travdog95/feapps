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
$Manufacturers_edit = new Manufacturers_edit();

// Run the page
$Manufacturers_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Manufacturers_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fManufacturersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fManufacturersedit = currentForm = new ew.Form("fManufacturersedit", "edit");

	// Validate form
	fManufacturersedit.validate = function() {
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
			<?php if ($Manufacturers_edit->Manufacturer_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Manufacturer_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Manufacturers_edit->Manufacturer_Idn->caption(), $Manufacturers_edit->Manufacturer_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Manufacturers_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Manufacturers_edit->Name->caption(), $Manufacturers_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Manufacturers_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Manufacturers_edit->ActiveFlag->caption(), $Manufacturers_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fManufacturersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fManufacturersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fManufacturersedit.lists["x_ActiveFlag[]"] = <?php echo $Manufacturers_edit->ActiveFlag->Lookup->toClientList($Manufacturers_edit) ?>;
	fManufacturersedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Manufacturers_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fManufacturersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Manufacturers_edit->showPageHeader(); ?>
<?php
$Manufacturers_edit->showMessage();
?>
<?php if (!$Manufacturers_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Manufacturers_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fManufacturersedit" id="fManufacturersedit" class="<?php echo $Manufacturers_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Manufacturers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Manufacturers_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Manufacturers_edit->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
	<div id="r_Manufacturer_Idn" class="form-group row">
		<label id="elh_Manufacturers_Manufacturer_Idn" class="<?php echo $Manufacturers_edit->LeftColumnClass ?>"><?php echo $Manufacturers_edit->Manufacturer_Idn->caption() ?><?php echo $Manufacturers_edit->Manufacturer_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Manufacturers_edit->RightColumnClass ?>"><div <?php echo $Manufacturers_edit->Manufacturer_Idn->cellAttributes() ?>>
<span id="el_Manufacturers_Manufacturer_Idn">
<span<?php echo $Manufacturers_edit->Manufacturer_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Manufacturers_edit->Manufacturer_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Manufacturers" data-field="x_Manufacturer_Idn" name="x_Manufacturer_Idn" id="x_Manufacturer_Idn" value="<?php echo HtmlEncode($Manufacturers_edit->Manufacturer_Idn->CurrentValue) ?>">
<?php echo $Manufacturers_edit->Manufacturer_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Manufacturers_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_Manufacturers_Name" for="x_Name" class="<?php echo $Manufacturers_edit->LeftColumnClass ?>"><?php echo $Manufacturers_edit->Name->caption() ?><?php echo $Manufacturers_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Manufacturers_edit->RightColumnClass ?>"><div <?php echo $Manufacturers_edit->Name->cellAttributes() ?>>
<span id="el_Manufacturers_Name">
<input type="text" data-table="Manufacturers" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Manufacturers_edit->Name->getPlaceHolder()) ?>" value="<?php echo $Manufacturers_edit->Name->EditValue ?>"<?php echo $Manufacturers_edit->Name->editAttributes() ?>>
</span>
<?php echo $Manufacturers_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Manufacturers_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_Manufacturers_ActiveFlag" class="<?php echo $Manufacturers_edit->LeftColumnClass ?>"><?php echo $Manufacturers_edit->ActiveFlag->caption() ?><?php echo $Manufacturers_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Manufacturers_edit->RightColumnClass ?>"><div <?php echo $Manufacturers_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_Manufacturers_ActiveFlag">
<?php
$selwrk = ConvertToBool($Manufacturers_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Manufacturers" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_679474" value="1"<?php echo $selwrk ?><?php echo $Manufacturers_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_679474"></label>
</div>
</span>
<?php echo $Manufacturers_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Manufacturers_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Manufacturers_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Manufacturers_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$Manufacturers_edit->IsModal) { ?>
<?php echo $Manufacturers_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$Manufacturers_edit->showPageFooter();
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
$Manufacturers_edit->terminate();
?>