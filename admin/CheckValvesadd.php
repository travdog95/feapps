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
$CheckValves_add = new CheckValves_add();

// Run the page
$CheckValves_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CheckValves_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCheckValvesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fCheckValvesadd = currentForm = new ew.Form("fCheckValvesadd", "add");

	// Validate form
	fCheckValvesadd.validate = function() {
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
			<?php if ($CheckValves_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CheckValves_add->Name->caption(), $CheckValves_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CheckValves_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CheckValves_add->Rank->caption(), $CheckValves_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($CheckValves_add->Rank->errorMessage()) ?>");
			<?php if ($CheckValves_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CheckValves_add->ActiveFlag->caption(), $CheckValves_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fCheckValvesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCheckValvesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fCheckValvesadd.lists["x_ActiveFlag[]"] = <?php echo $CheckValves_add->ActiveFlag->Lookup->toClientList($CheckValves_add) ?>;
	fCheckValvesadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($CheckValves_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fCheckValvesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $CheckValves_add->showPageHeader(); ?>
<?php
$CheckValves_add->showMessage();
?>
<form name="fCheckValvesadd" id="fCheckValvesadd" class="<?php echo $CheckValves_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CheckValves">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$CheckValves_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($CheckValves_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_CheckValves_Name" for="x_Name" class="<?php echo $CheckValves_add->LeftColumnClass ?>"><?php echo $CheckValves_add->Name->caption() ?><?php echo $CheckValves_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CheckValves_add->RightColumnClass ?>"><div <?php echo $CheckValves_add->Name->cellAttributes() ?>>
<span id="el_CheckValves_Name">
<input type="text" data-table="CheckValves" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CheckValves_add->Name->getPlaceHolder()) ?>" value="<?php echo $CheckValves_add->Name->EditValue ?>"<?php echo $CheckValves_add->Name->editAttributes() ?>>
</span>
<?php echo $CheckValves_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CheckValves_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_CheckValves_Rank" for="x_Rank" class="<?php echo $CheckValves_add->LeftColumnClass ?>"><?php echo $CheckValves_add->Rank->caption() ?><?php echo $CheckValves_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CheckValves_add->RightColumnClass ?>"><div <?php echo $CheckValves_add->Rank->cellAttributes() ?>>
<span id="el_CheckValves_Rank">
<input type="text" data-table="CheckValves" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CheckValves_add->Rank->getPlaceHolder()) ?>" value="<?php echo $CheckValves_add->Rank->EditValue ?>"<?php echo $CheckValves_add->Rank->editAttributes() ?>>
</span>
<?php echo $CheckValves_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CheckValves_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_CheckValves_ActiveFlag" class="<?php echo $CheckValves_add->LeftColumnClass ?>"><?php echo $CheckValves_add->ActiveFlag->caption() ?><?php echo $CheckValves_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CheckValves_add->RightColumnClass ?>"><div <?php echo $CheckValves_add->ActiveFlag->cellAttributes() ?>>
<span id="el_CheckValves_ActiveFlag">
<?php
$selwrk = ConvertToBool($CheckValves_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CheckValves" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_269995" value="1"<?php echo $selwrk ?><?php echo $CheckValves_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_269995"></label>
</div>
</span>
<?php echo $CheckValves_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$CheckValves_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $CheckValves_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $CheckValves_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$CheckValves_add->showPageFooter();
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
$CheckValves_add->terminate();
?>