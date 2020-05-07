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
$Menus_add = new Menus_add();

// Run the page
$Menus_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Menus_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fMenusadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fMenusadd = currentForm = new ew.Form("fMenusadd", "add");

	// Validate form
	fMenusadd.validate = function() {
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
			<?php if ($Menus_add->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_add->Name->caption(), $Menus_add->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_add->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_add->ShortName->caption(), $Menus_add->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_add->Link->Required) { ?>
				elm = this.getElements("x" + infix + "_Link");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_add->Link->caption(), $Menus_add->Link->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_add->Icon->Required) { ?>
				elm = this.getElements("x" + infix + "_Icon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_add->Icon->caption(), $Menus_add->Icon->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_add->MenuType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_MenuType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_add->MenuType_Idn->caption(), $Menus_add->MenuType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_add->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_add->Rank->caption(), $Menus_add->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Menus_add->Rank->errorMessage()) ?>");
			<?php if ($Menus_add->ChildMenuType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ChildMenuType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_add->ChildMenuType_Idn->caption(), $Menus_add->ChildMenuType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_add->IsParent->Required) { ?>
				elm = this.getElements("x" + infix + "_IsParent[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_add->IsParent->caption(), $Menus_add->IsParent->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_add->AdminOnly->Required) { ?>
				elm = this.getElements("x" + infix + "_AdminOnly[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_add->AdminOnly->caption(), $Menus_add->AdminOnly->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_add->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_add->ActiveFlag->caption(), $Menus_add->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fMenusadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fMenusadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fMenusadd.lists["x_MenuType_Idn"] = <?php echo $Menus_add->MenuType_Idn->Lookup->toClientList($Menus_add) ?>;
	fMenusadd.lists["x_MenuType_Idn"].options = <?php echo JsonEncode($Menus_add->MenuType_Idn->lookupOptions()) ?>;
	fMenusadd.lists["x_ChildMenuType_Idn"] = <?php echo $Menus_add->ChildMenuType_Idn->Lookup->toClientList($Menus_add) ?>;
	fMenusadd.lists["x_ChildMenuType_Idn"].options = <?php echo JsonEncode($Menus_add->ChildMenuType_Idn->lookupOptions()) ?>;
	fMenusadd.lists["x_IsParent[]"] = <?php echo $Menus_add->IsParent->Lookup->toClientList($Menus_add) ?>;
	fMenusadd.lists["x_IsParent[]"].options = <?php echo JsonEncode($Menus_add->IsParent->options(FALSE, TRUE)) ?>;
	fMenusadd.lists["x_AdminOnly[]"] = <?php echo $Menus_add->AdminOnly->Lookup->toClientList($Menus_add) ?>;
	fMenusadd.lists["x_AdminOnly[]"].options = <?php echo JsonEncode($Menus_add->AdminOnly->options(FALSE, TRUE)) ?>;
	fMenusadd.lists["x_ActiveFlag[]"] = <?php echo $Menus_add->ActiveFlag->Lookup->toClientList($Menus_add) ?>;
	fMenusadd.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Menus_add->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fMenusadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Menus_add->showPageHeader(); ?>
<?php
$Menus_add->showMessage();
?>
<form name="fMenusadd" id="fMenusadd" class="<?php echo $Menus_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Menus">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$Menus_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Menus_add->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_Menus_Name" for="x_Name" class="<?php echo $Menus_add->LeftColumnClass ?>"><?php echo $Menus_add->Name->caption() ?><?php echo $Menus_add->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_add->RightColumnClass ?>"><div <?php echo $Menus_add->Name->cellAttributes() ?>>
<span id="el_Menus_Name">
<input type="text" data-table="Menus" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_add->Name->getPlaceHolder()) ?>" value="<?php echo $Menus_add->Name->EditValue ?>"<?php echo $Menus_add->Name->editAttributes() ?>>
</span>
<?php echo $Menus_add->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_add->ShortName->Visible) { // ShortName ?>
	<div id="r_ShortName" class="form-group row">
		<label id="elh_Menus_ShortName" for="x_ShortName" class="<?php echo $Menus_add->LeftColumnClass ?>"><?php echo $Menus_add->ShortName->caption() ?><?php echo $Menus_add->ShortName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_add->RightColumnClass ?>"><div <?php echo $Menus_add->ShortName->cellAttributes() ?>>
<span id="el_Menus_ShortName">
<input type="text" data-table="Menus" data-field="x_ShortName" name="x_ShortName" id="x_ShortName" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($Menus_add->ShortName->getPlaceHolder()) ?>" value="<?php echo $Menus_add->ShortName->EditValue ?>"<?php echo $Menus_add->ShortName->editAttributes() ?>>
</span>
<?php echo $Menus_add->ShortName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_add->Link->Visible) { // Link ?>
	<div id="r_Link" class="form-group row">
		<label id="elh_Menus_Link" for="x_Link" class="<?php echo $Menus_add->LeftColumnClass ?>"><?php echo $Menus_add->Link->caption() ?><?php echo $Menus_add->Link->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_add->RightColumnClass ?>"><div <?php echo $Menus_add->Link->cellAttributes() ?>>
<span id="el_Menus_Link">
<input type="text" data-table="Menus" data-field="x_Link" name="x_Link" id="x_Link" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Menus_add->Link->getPlaceHolder()) ?>" value="<?php echo $Menus_add->Link->EditValue ?>"<?php echo $Menus_add->Link->editAttributes() ?>>
</span>
<?php echo $Menus_add->Link->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_add->Icon->Visible) { // Icon ?>
	<div id="r_Icon" class="form-group row">
		<label id="elh_Menus_Icon" for="x_Icon" class="<?php echo $Menus_add->LeftColumnClass ?>"><?php echo $Menus_add->Icon->caption() ?><?php echo $Menus_add->Icon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_add->RightColumnClass ?>"><div <?php echo $Menus_add->Icon->cellAttributes() ?>>
<span id="el_Menus_Icon">
<input type="text" data-table="Menus" data-field="x_Icon" name="x_Icon" id="x_Icon" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_add->Icon->getPlaceHolder()) ?>" value="<?php echo $Menus_add->Icon->EditValue ?>"<?php echo $Menus_add->Icon->editAttributes() ?>>
</span>
<?php echo $Menus_add->Icon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_add->MenuType_Idn->Visible) { // MenuType_Idn ?>
	<div id="r_MenuType_Idn" class="form-group row">
		<label id="elh_Menus_MenuType_Idn" for="x_MenuType_Idn" class="<?php echo $Menus_add->LeftColumnClass ?>"><?php echo $Menus_add->MenuType_Idn->caption() ?><?php echo $Menus_add->MenuType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_add->RightColumnClass ?>"><div <?php echo $Menus_add->MenuType_Idn->cellAttributes() ?>>
<span id="el_Menus_MenuType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_MenuType_Idn" data-value-separator="<?php echo $Menus_add->MenuType_Idn->displayValueSeparatorAttribute() ?>" id="x_MenuType_Idn" name="x_MenuType_Idn"<?php echo $Menus_add->MenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_add->MenuType_Idn->selectOptionListHtml("x_MenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_add->MenuType_Idn->Lookup->getParamTag($Menus_add, "p_x_MenuType_Idn") ?>
</span>
<?php echo $Menus_add->MenuType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_add->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_Menus_Rank" for="x_Rank" class="<?php echo $Menus_add->LeftColumnClass ?>"><?php echo $Menus_add->Rank->caption() ?><?php echo $Menus_add->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_add->RightColumnClass ?>"><div <?php echo $Menus_add->Rank->cellAttributes() ?>>
<span id="el_Menus_Rank">
<input type="text" data-table="Menus" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Menus_add->Rank->getPlaceHolder()) ?>" value="<?php echo $Menus_add->Rank->EditValue ?>"<?php echo $Menus_add->Rank->editAttributes() ?>>
</span>
<?php echo $Menus_add->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_add->ChildMenuType_Idn->Visible) { // ChildMenuType_Idn ?>
	<div id="r_ChildMenuType_Idn" class="form-group row">
		<label id="elh_Menus_ChildMenuType_Idn" for="x_ChildMenuType_Idn" class="<?php echo $Menus_add->LeftColumnClass ?>"><?php echo $Menus_add->ChildMenuType_Idn->caption() ?><?php echo $Menus_add->ChildMenuType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_add->RightColumnClass ?>"><div <?php echo $Menus_add->ChildMenuType_Idn->cellAttributes() ?>>
<span id="el_Menus_ChildMenuType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_ChildMenuType_Idn" data-value-separator="<?php echo $Menus_add->ChildMenuType_Idn->displayValueSeparatorAttribute() ?>" id="x_ChildMenuType_Idn" name="x_ChildMenuType_Idn"<?php echo $Menus_add->ChildMenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_add->ChildMenuType_Idn->selectOptionListHtml("x_ChildMenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_add->ChildMenuType_Idn->Lookup->getParamTag($Menus_add, "p_x_ChildMenuType_Idn") ?>
</span>
<?php echo $Menus_add->ChildMenuType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_add->IsParent->Visible) { // IsParent ?>
	<div id="r_IsParent" class="form-group row">
		<label id="elh_Menus_IsParent" class="<?php echo $Menus_add->LeftColumnClass ?>"><?php echo $Menus_add->IsParent->caption() ?><?php echo $Menus_add->IsParent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_add->RightColumnClass ?>"><div <?php echo $Menus_add->IsParent->cellAttributes() ?>>
<span id="el_Menus_IsParent">
<?php
$selwrk = ConvertToBool($Menus_add->IsParent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_IsParent" name="x_IsParent[]" id="x_IsParent[]_798084" value="1"<?php echo $selwrk ?><?php echo $Menus_add->IsParent->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsParent[]_798084"></label>
</div>
</span>
<?php echo $Menus_add->IsParent->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_add->AdminOnly->Visible) { // AdminOnly ?>
	<div id="r_AdminOnly" class="form-group row">
		<label id="elh_Menus_AdminOnly" class="<?php echo $Menus_add->LeftColumnClass ?>"><?php echo $Menus_add->AdminOnly->caption() ?><?php echo $Menus_add->AdminOnly->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_add->RightColumnClass ?>"><div <?php echo $Menus_add->AdminOnly->cellAttributes() ?>>
<span id="el_Menus_AdminOnly">
<?php
$selwrk = ConvertToBool($Menus_add->AdminOnly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_AdminOnly" name="x_AdminOnly[]" id="x_AdminOnly[]_437228" value="1"<?php echo $selwrk ?><?php echo $Menus_add->AdminOnly->editAttributes() ?>>
	<label class="custom-control-label" for="x_AdminOnly[]_437228"></label>
</div>
</span>
<?php echo $Menus_add->AdminOnly->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_add->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_Menus_ActiveFlag" class="<?php echo $Menus_add->LeftColumnClass ?>"><?php echo $Menus_add->ActiveFlag->caption() ?><?php echo $Menus_add->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_add->RightColumnClass ?>"><div <?php echo $Menus_add->ActiveFlag->cellAttributes() ?>>
<span id="el_Menus_ActiveFlag">
<?php
$selwrk = ConvertToBool($Menus_add->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_749750" value="1"<?php echo $selwrk ?><?php echo $Menus_add->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_749750"></label>
</div>
</span>
<?php echo $Menus_add->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Menus_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Menus_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Menus_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Menus_add->showPageFooter();
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
$Menus_add->terminate();
?>