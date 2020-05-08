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
$Manufacturers_add = new Manufacturers_add();

// Run the page
$Manufacturers_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Manufacturers_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fManufacturersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fManufacturersadd = currentForm = new ew.Form("fManufacturersadd", "add");

	// Validate form
	fManufacturersadd.validate = function() {
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
			<?php if ($Manufacturers_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Manufacturers_add->Name->caption(), $Manufacturers_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Manufacturers_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Manufacturers_add->ActiveFlag->caption(), $Manufacturers_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fManufacturersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fManufacturersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fManufacturersadd.lists["x_ActiveFlag[]"] = <?php echo $Manufacturers_add->ActiveFlag->Lookup->toClientList($Manufacturers_add) ?>;
	fManufacturersadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Manufacturers_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fManufacturersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Manufacturers_add->showPageHeader(); ?>
<?php
$Manufacturers_add->showMessage();
?>
<form name="fManufacturersadd" id="fManufacturersadd" class="<?php echo $Manufacturers_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Manufacturers">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$Manufacturers_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Manufacturers_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_Manufacturers_Name" for="x_Name" class="<?php echo $Manufacturers_add->LeftColumnClass ?>"><?php echo $Manufacturers_add->Name->caption() ?><?php echo $Manufacturers_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Manufacturers_add->RightColumnClass ?>"><div <?php echo $Manufacturers_add->Name->cellAttributes() ?>>
<span id="el_Manufacturers_Name">
<input type="text" data-table="Manufacturers" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Manufacturers_add->Name->getPlaceHolder()) ?>" value="<?php echo $Manufacturers_add->Name->EditValue ?>"<?php echo $Manufacturers_add->Name->editAttributes() ?>>
</span>
<?php echo $Manufacturers_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Manufacturers_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_Manufacturers_ActiveFlag" class="<?php echo $Manufacturers_add->LeftColumnClass ?>"><?php echo $Manufacturers_add->ActiveFlag->caption() ?><?php echo $Manufacturers_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Manufacturers_add->RightColumnClass ?>"><div <?php echo $Manufacturers_add->ActiveFlag->cellAttributes() ?>>
<span id="el_Manufacturers_ActiveFlag">
<?php
$selwrk = ConvertToBool($Manufacturers_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Manufacturers" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_281760" value="1"<?php echo $selwrk ?><?php echo $Manufacturers_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_281760"></label>
</div>
</span>
<?php echo $Manufacturers_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Manufacturers_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Manufacturers_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Manufacturers_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Manufacturers_add->showPageFooter();
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
$Manufacturers_add->terminate();
?>