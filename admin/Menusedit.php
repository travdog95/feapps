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
$Menus_edit = new Menus_edit();

// Run the page
$Menus_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Menus_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fMenusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fMenusedit = currentForm = new ew.Form("fMenusedit", "edit");

	// Validate form
	fMenusedit.validate = function() {
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
			<?php if ($Menus_edit->Menu_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Menu_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_edit->Menu_Idn->caption(), $Menus_edit->Menu_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_edit->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_edit->Name->caption(), $Menus_edit->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_edit->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_edit->ShortName->caption(), $Menus_edit->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_edit->Link->Required) { ?>
				elm = this.getElements("x" + infix + "_Link");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_edit->Link->caption(), $Menus_edit->Link->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_edit->Icon->Required) { ?>
				elm = this.getElements("x" + infix + "_Icon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_edit->Icon->caption(), $Menus_edit->Icon->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_edit->MenuType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_MenuType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_edit->MenuType_Idn->caption(), $Menus_edit->MenuType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_edit->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_edit->Rank->caption(), $Menus_edit->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Menus_edit->Rank->errorMessage()) ?>");
			<?php if ($Menus_edit->ChildMenuType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ChildMenuType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_edit->ChildMenuType_Idn->caption(), $Menus_edit->ChildMenuType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_edit->IsParent->Required) { ?>
				elm = this.getElements("x" + infix + "_IsParent[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_edit->IsParent->caption(), $Menus_edit->IsParent->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_edit->AdminOnly->Required) { ?>
				elm = this.getElements("x" + infix + "_AdminOnly[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_edit->AdminOnly->caption(), $Menus_edit->AdminOnly->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_edit->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_edit->ActiveFlag->caption(), $Menus_edit->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fMenusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fMenusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fMenusedit.lists["x_MenuType_Idn"] = <?php echo $Menus_edit->MenuType_Idn->Lookup->toClientList($Menus_edit) ?>;
	fMenusedit.lists["x_MenuType_Idn"].options = <?php echo JsonEncode($Menus_edit->MenuType_Idn->lookupOptions()) ?>;
	fMenusedit.lists["x_ChildMenuType_Idn"] = <?php echo $Menus_edit->ChildMenuType_Idn->Lookup->toClientList($Menus_edit) ?>;
	fMenusedit.lists["x_ChildMenuType_Idn"].options = <?php echo JsonEncode($Menus_edit->ChildMenuType_Idn->lookupOptions()) ?>;
	fMenusedit.lists["x_IsParent[]"] = <?php echo $Menus_edit->IsParent->Lookup->toClientList($Menus_edit) ?>;
	fMenusedit.lists["x_IsParent[]"].options = <?php echo JsonEncode($Menus_edit->IsParent->options(FALSE, TRUE)) ?>;
	fMenusedit.lists["x_AdminOnly[]"] = <?php echo $Menus_edit->AdminOnly->Lookup->toClientList($Menus_edit) ?>;
	fMenusedit.lists["x_AdminOnly[]"].options = <?php echo JsonEncode($Menus_edit->AdminOnly->options(FALSE, TRUE)) ?>;
	fMenusedit.lists["x_ActiveFlag[]"] = <?php echo $Menus_edit->ActiveFlag->Lookup->toClientList($Menus_edit) ?>;
	fMenusedit.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Menus_edit->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fMenusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Menus_edit->showPageHeader(); ?>
<?php
$Menus_edit->showMessage();
?>
<?php if (!$Menus_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Menus_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fMenusedit" id="fMenusedit" class="<?php echo $Menus_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Menus">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Menus_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Menus_edit->Menu_Idn->Visible) { // Menu_Idn ?>
	<div id="r_Menu_Idn" class="form-group row">
		<label id="elh_Menus_Menu_Idn" class="<?php echo $Menus_edit->LeftColumnClass ?>"><?php echo $Menus_edit->Menu_Idn->caption() ?><?php echo $Menus_edit->Menu_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_edit->RightColumnClass ?>"><div <?php echo $Menus_edit->Menu_Idn->cellAttributes() ?>>
<span id="el_Menus_Menu_Idn">
<span<?php echo $Menus_edit->Menu_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Menus_edit->Menu_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Menus" data-field="x_Menu_Idn" name="x_Menu_Idn" id="x_Menu_Idn" value="<?php echo HtmlEncode($Menus_edit->Menu_Idn->CurrentValue) ?>">
<?php echo $Menus_edit->Menu_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_edit->Name->Visible) { // Name ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_Menus_Name" for="x_Name" class="<?php echo $Menus_edit->LeftColumnClass ?>"><?php echo $Menus_edit->Name->caption() ?><?php echo $Menus_edit->Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_edit->RightColumnClass ?>"><div <?php echo $Menus_edit->Name->cellAttributes() ?>>
<span id="el_Menus_Name">
<input type="text" data-table="Menus" data-field="x_Name" name="x_Name" id="x_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_edit->Name->getPlaceHolder()) ?>" value="<?php echo $Menus_edit->Name->EditValue ?>"<?php echo $Menus_edit->Name->editAttributes() ?>>
</span>
<?php echo $Menus_edit->Name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_edit->ShortName->Visible) { // ShortName ?>
	<div id="r_ShortName" class="form-group row">
		<label id="elh_Menus_ShortName" for="x_ShortName" class="<?php echo $Menus_edit->LeftColumnClass ?>"><?php echo $Menus_edit->ShortName->caption() ?><?php echo $Menus_edit->ShortName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_edit->RightColumnClass ?>"><div <?php echo $Menus_edit->ShortName->cellAttributes() ?>>
<span id="el_Menus_ShortName">
<input type="text" data-table="Menus" data-field="x_ShortName" name="x_ShortName" id="x_ShortName" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($Menus_edit->ShortName->getPlaceHolder()) ?>" value="<?php echo $Menus_edit->ShortName->EditValue ?>"<?php echo $Menus_edit->ShortName->editAttributes() ?>>
</span>
<?php echo $Menus_edit->ShortName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_edit->Link->Visible) { // Link ?>
	<div id="r_Link" class="form-group row">
		<label id="elh_Menus_Link" for="x_Link" class="<?php echo $Menus_edit->LeftColumnClass ?>"><?php echo $Menus_edit->Link->caption() ?><?php echo $Menus_edit->Link->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_edit->RightColumnClass ?>"><div <?php echo $Menus_edit->Link->cellAttributes() ?>>
<span id="el_Menus_Link">
<input type="text" data-table="Menus" data-field="x_Link" name="x_Link" id="x_Link" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Menus_edit->Link->getPlaceHolder()) ?>" value="<?php echo $Menus_edit->Link->EditValue ?>"<?php echo $Menus_edit->Link->editAttributes() ?>>
</span>
<?php echo $Menus_edit->Link->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_edit->Icon->Visible) { // Icon ?>
	<div id="r_Icon" class="form-group row">
		<label id="elh_Menus_Icon" for="x_Icon" class="<?php echo $Menus_edit->LeftColumnClass ?>"><?php echo $Menus_edit->Icon->caption() ?><?php echo $Menus_edit->Icon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_edit->RightColumnClass ?>"><div <?php echo $Menus_edit->Icon->cellAttributes() ?>>
<span id="el_Menus_Icon">
<input type="text" data-table="Menus" data-field="x_Icon" name="x_Icon" id="x_Icon" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_edit->Icon->getPlaceHolder()) ?>" value="<?php echo $Menus_edit->Icon->EditValue ?>"<?php echo $Menus_edit->Icon->editAttributes() ?>>
</span>
<?php echo $Menus_edit->Icon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_edit->MenuType_Idn->Visible) { // MenuType_Idn ?>
	<div id="r_MenuType_Idn" class="form-group row">
		<label id="elh_Menus_MenuType_Idn" for="x_MenuType_Idn" class="<?php echo $Menus_edit->LeftColumnClass ?>"><?php echo $Menus_edit->MenuType_Idn->caption() ?><?php echo $Menus_edit->MenuType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_edit->RightColumnClass ?>"><div <?php echo $Menus_edit->MenuType_Idn->cellAttributes() ?>>
<span id="el_Menus_MenuType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_MenuType_Idn" data-value-separator="<?php echo $Menus_edit->MenuType_Idn->displayValueSeparatorAttribute() ?>" id="x_MenuType_Idn" name="x_MenuType_Idn"<?php echo $Menus_edit->MenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_edit->MenuType_Idn->selectOptionListHtml("x_MenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_edit->MenuType_Idn->Lookup->getParamTag($Menus_edit, "p_x_MenuType_Idn") ?>
</span>
<?php echo $Menus_edit->MenuType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_edit->Rank->Visible) { // Rank ?>
	<div id="r_Rank" class="form-group row">
		<label id="elh_Menus_Rank" for="x_Rank" class="<?php echo $Menus_edit->LeftColumnClass ?>"><?php echo $Menus_edit->Rank->caption() ?><?php echo $Menus_edit->Rank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_edit->RightColumnClass ?>"><div <?php echo $Menus_edit->Rank->cellAttributes() ?>>
<span id="el_Menus_Rank">
<input type="text" data-table="Menus" data-field="x_Rank" name="x_Rank" id="x_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Menus_edit->Rank->getPlaceHolder()) ?>" value="<?php echo $Menus_edit->Rank->EditValue ?>"<?php echo $Menus_edit->Rank->editAttributes() ?>>
</span>
<?php echo $Menus_edit->Rank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_edit->ChildMenuType_Idn->Visible) { // ChildMenuType_Idn ?>
	<div id="r_ChildMenuType_Idn" class="form-group row">
		<label id="elh_Menus_ChildMenuType_Idn" for="x_ChildMenuType_Idn" class="<?php echo $Menus_edit->LeftColumnClass ?>"><?php echo $Menus_edit->ChildMenuType_Idn->caption() ?><?php echo $Menus_edit->ChildMenuType_Idn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_edit->RightColumnClass ?>"><div <?php echo $Menus_edit->ChildMenuType_Idn->cellAttributes() ?>>
<span id="el_Menus_ChildMenuType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_ChildMenuType_Idn" data-value-separator="<?php echo $Menus_edit->ChildMenuType_Idn->displayValueSeparatorAttribute() ?>" id="x_ChildMenuType_Idn" name="x_ChildMenuType_Idn"<?php echo $Menus_edit->ChildMenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_edit->ChildMenuType_Idn->selectOptionListHtml("x_ChildMenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_edit->ChildMenuType_Idn->Lookup->getParamTag($Menus_edit, "p_x_ChildMenuType_Idn") ?>
</span>
<?php echo $Menus_edit->ChildMenuType_Idn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_edit->IsParent->Visible) { // IsParent ?>
	<div id="r_IsParent" class="form-group row">
		<label id="elh_Menus_IsParent" class="<?php echo $Menus_edit->LeftColumnClass ?>"><?php echo $Menus_edit->IsParent->caption() ?><?php echo $Menus_edit->IsParent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_edit->RightColumnClass ?>"><div <?php echo $Menus_edit->IsParent->cellAttributes() ?>>
<span id="el_Menus_IsParent">
<?php
$selwrk = ConvertToBool($Menus_edit->IsParent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_IsParent" name="x_IsParent[]" id="x_IsParent[]_321384" value="1"<?php echo $selwrk ?><?php echo $Menus_edit->IsParent->editAttributes() ?>>
	<label class="custom-control-label" for="x_IsParent[]_321384"></label>
</div>
</span>
<?php echo $Menus_edit->IsParent->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_edit->AdminOnly->Visible) { // AdminOnly ?>
	<div id="r_AdminOnly" class="form-group row">
		<label id="elh_Menus_AdminOnly" class="<?php echo $Menus_edit->LeftColumnClass ?>"><?php echo $Menus_edit->AdminOnly->caption() ?><?php echo $Menus_edit->AdminOnly->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_edit->RightColumnClass ?>"><div <?php echo $Menus_edit->AdminOnly->cellAttributes() ?>>
<span id="el_Menus_AdminOnly">
<?php
$selwrk = ConvertToBool($Menus_edit->AdminOnly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_AdminOnly" name="x_AdminOnly[]" id="x_AdminOnly[]_899999" value="1"<?php echo $selwrk ?><?php echo $Menus_edit->AdminOnly->editAttributes() ?>>
	<label class="custom-control-label" for="x_AdminOnly[]_899999"></label>
</div>
</span>
<?php echo $Menus_edit->AdminOnly->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Menus_edit->ActiveFlag->Visible) { // ActiveFlag ?>
	<div id="r_ActiveFlag" class="form-group row">
		<label id="elh_Menus_ActiveFlag" class="<?php echo $Menus_edit->LeftColumnClass ?>"><?php echo $Menus_edit->ActiveFlag->caption() ?><?php echo $Menus_edit->ActiveFlag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Menus_edit->RightColumnClass ?>"><div <?php echo $Menus_edit->ActiveFlag->cellAttributes() ?>>
<span id="el_Menus_ActiveFlag">
<?php
$selwrk = ConvertToBool($Menus_edit->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_ActiveFlag" name="x_ActiveFlag[]" id="x_ActiveFlag[]_813124" value="1"<?php echo $selwrk ?><?php echo $Menus_edit->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x_ActiveFlag[]_813124"></label>
</div>
</span>
<?php echo $Menus_edit->ActiveFlag->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Menus_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Menus_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Menus_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$Menus_edit->IsModal) { ?>
<?php echo $Menus_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$Menus_edit->showPageFooter();
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
$Menus_edit->terminate();
?>