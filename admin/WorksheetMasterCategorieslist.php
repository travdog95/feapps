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
$WorksheetMasterCategories_list = new WorksheetMasterCategories_list();

// Run the page
$WorksheetMasterCategories_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasterCategories_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$WorksheetMasterCategories_list->isExport()) { ?>
<script>
var fWorksheetMasterCategorieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fWorksheetMasterCategorieslist = currentForm = new ew.Form("fWorksheetMasterCategorieslist", "list");
	fWorksheetMasterCategorieslist.formKeyCountName = '<?php echo $WorksheetMasterCategories_list->FormKeyCountName ?>';

	// Validate form
	fWorksheetMasterCategorieslist.validate = function() {
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
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($WorksheetMasterCategories_list->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_list->WorksheetMaster_Idn->caption(), $WorksheetMasterCategories_list->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->errorMessage()) ?>");
			<?php if ($WorksheetMasterCategories_list->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_list->WorksheetCategory_Idn->caption(), $WorksheetMasterCategories_list->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_list->Rank->caption(), $WorksheetMasterCategories_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasterCategories_list->Rank->errorMessage()) ?>");
			<?php if ($WorksheetMasterCategories_list->AutoLoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_AutoLoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_list->AutoLoadFlag->caption(), $WorksheetMasterCategories_list->AutoLoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_list->LoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_LoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_list->LoadFlag->caption(), $WorksheetMasterCategories_list->LoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_list->AddMiscFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_AddMiscFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_list->AddMiscFlag->caption(), $WorksheetMasterCategories_list->AddMiscFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ChildWorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->caption(), $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	fWorksheetMasterCategorieslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "WorksheetMaster_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "WorksheetCategory_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "AutoLoadFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "LoadFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "AddMiscFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ChildWorksheetMaster_Idn", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fWorksheetMasterCategorieslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetMasterCategorieslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetMasterCategorieslist.lists["x_WorksheetCategory_Idn"] = <?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->Lookup->toClientList($WorksheetMasterCategories_list) ?>;
	fWorksheetMasterCategorieslist.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($WorksheetMasterCategories_list->WorksheetCategory_Idn->lookupOptions()) ?>;
	fWorksheetMasterCategorieslist.lists["x_AutoLoadFlag[]"] = <?php echo $WorksheetMasterCategories_list->AutoLoadFlag->Lookup->toClientList($WorksheetMasterCategories_list) ?>;
	fWorksheetMasterCategorieslist.lists["x_AutoLoadFlag[]"].options = <?php echo JsonEncode($WorksheetMasterCategories_list->AutoLoadFlag->options(FALSE, TRUE)) ?>;
	fWorksheetMasterCategorieslist.lists["x_LoadFlag[]"] = <?php echo $WorksheetMasterCategories_list->LoadFlag->Lookup->toClientList($WorksheetMasterCategories_list) ?>;
	fWorksheetMasterCategorieslist.lists["x_LoadFlag[]"].options = <?php echo JsonEncode($WorksheetMasterCategories_list->LoadFlag->options(FALSE, TRUE)) ?>;
	fWorksheetMasterCategorieslist.lists["x_AddMiscFlag[]"] = <?php echo $WorksheetMasterCategories_list->AddMiscFlag->Lookup->toClientList($WorksheetMasterCategories_list) ?>;
	fWorksheetMasterCategorieslist.lists["x_AddMiscFlag[]"].options = <?php echo JsonEncode($WorksheetMasterCategories_list->AddMiscFlag->options(FALSE, TRUE)) ?>;
	fWorksheetMasterCategorieslist.lists["x_ChildWorksheetMaster_Idn"] = <?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Lookup->toClientList($WorksheetMasterCategories_list) ?>;
	fWorksheetMasterCategorieslist.lists["x_ChildWorksheetMaster_Idn"].options = <?php echo JsonEncode($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->lookupOptions()) ?>;
	loadjs.done("fWorksheetMasterCategorieslist");
});
var fWorksheetMasterCategorieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fWorksheetMasterCategorieslistsrch = currentSearchForm = new ew.Form("fWorksheetMasterCategorieslistsrch");

	// Validate function for search
	fWorksheetMasterCategorieslistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fWorksheetMasterCategorieslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetMasterCategorieslistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetMasterCategorieslistsrch.lists["x_WorksheetCategory_Idn"] = <?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->Lookup->toClientList($WorksheetMasterCategories_list) ?>;
	fWorksheetMasterCategorieslistsrch.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($WorksheetMasterCategories_list->WorksheetCategory_Idn->lookupOptions()) ?>;

	// Filters
	fWorksheetMasterCategorieslistsrch.filterList = <?php echo $WorksheetMasterCategories_list->getFilterList() ?>;
	loadjs.done("fWorksheetMasterCategorieslistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = true;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$WorksheetMasterCategories_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($WorksheetMasterCategories_list->TotalRecords > 0 && $WorksheetMasterCategories_list->ExportOptions->visible()) { ?>
<?php $WorksheetMasterCategories_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_list->ImportOptions->visible()) { ?>
<?php $WorksheetMasterCategories_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_list->SearchOptions->visible()) { ?>
<?php $WorksheetMasterCategories_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_list->FilterOptions->visible()) { ?>
<?php $WorksheetMasterCategories_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$WorksheetMasterCategories_list->isExport() || Config("EXPORT_MASTER_RECORD") && $WorksheetMasterCategories_list->isExport("print")) { ?>
<?php
if ($WorksheetMasterCategories_list->DbMasterFilter != "" && $WorksheetMasterCategories->getCurrentMasterTable() == "WorksheetMasters") {
	if ($WorksheetMasterCategories_list->MasterRecordExists) {
		include_once "WorksheetMastersmaster.php";
	}
}
?>
<?php
if ($WorksheetMasterCategories_list->DbMasterFilter != "" && $WorksheetMasterCategories->getCurrentMasterTable() == "WorksheetCategories") {
	if ($WorksheetMasterCategories_list->MasterRecordExists) {
		include_once "WorksheetCategoriesmaster.php";
	}
}
?>
<?php } ?>
<?php
$WorksheetMasterCategories_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$WorksheetMasterCategories_list->isExport() && !$WorksheetMasterCategories->CurrentAction) { ?>
<form name="fWorksheetMasterCategorieslistsrch" id="fWorksheetMasterCategorieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fWorksheetMasterCategorieslistsrch-search-panel" class="<?php echo $WorksheetMasterCategories_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="WorksheetMasterCategories">
	<div class="ew-extended-search">
<?php

// Render search row
$WorksheetMasterCategories->RowType = ROWTYPE_SEARCH;
$WorksheetMasterCategories->resetAttributes();
$WorksheetMasterCategories_list->renderRow();
?>
<?php if ($WorksheetMasterCategories_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php
		$WorksheetMasterCategories_list->SearchColumnCount++;
		if (($WorksheetMasterCategories_list->SearchColumnCount - 1) % $WorksheetMasterCategories_list->SearchFieldsPerRow == 0) {
			$WorksheetMasterCategories_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $WorksheetMasterCategories_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_WorksheetMaster_Idn" class="ew-cell form-group">
		<label for="x_WorksheetMaster_Idn" class="ew-search-caption ew-label"><?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_WorksheetMaster_Idn" id="z_WorksheetMaster_Idn" value="=">
</span>
		<span id="el_WorksheetMasterCategories_WorksheetMaster_Idn" class="ew-search-field">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn" id="x_WorksheetMaster_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->EditValue ?>"<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->editAttributes() ?>>
</span>
	</div>
	<?php if ($WorksheetMasterCategories_list->SearchColumnCount % $WorksheetMasterCategories_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<?php
		$WorksheetMasterCategories_list->SearchColumnCount++;
		if (($WorksheetMasterCategories_list->SearchColumnCount - 1) % $WorksheetMasterCategories_list->SearchFieldsPerRow == 0) {
			$WorksheetMasterCategories_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $WorksheetMasterCategories_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_WorksheetCategory_Idn" class="ew-cell form-group">
		<label for="x_WorksheetCategory_Idn" class="ew-search-caption ew-label"><?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_WorksheetCategory_Idn" id="z_WorksheetCategory_Idn" value="=">
</span>
		<span id="el_WorksheetMasterCategories_WorksheetCategory_Idn" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetCategory_Idn" name="x_WorksheetCategory_Idn"<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->selectOptionListHtml("x_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->Lookup->getParamTag($WorksheetMasterCategories_list, "p_x_WorksheetCategory_Idn") ?>
</span>
	</div>
	<?php if ($WorksheetMasterCategories_list->SearchColumnCount % $WorksheetMasterCategories_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($WorksheetMasterCategories_list->SearchColumnCount % $WorksheetMasterCategories_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $WorksheetMasterCategories_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $WorksheetMasterCategories_list->showPageHeader(); ?>
<?php
$WorksheetMasterCategories_list->showMessage();
?>
<?php if ($WorksheetMasterCategories_list->TotalRecords > 0 || $WorksheetMasterCategories->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($WorksheetMasterCategories_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> WorksheetMasterCategories">
<?php if (!$WorksheetMasterCategories_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$WorksheetMasterCategories_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetMasterCategories_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetMasterCategories_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fWorksheetMasterCategorieslist" id="fWorksheetMasterCategorieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetMasterCategories">
<?php if ($WorksheetMasterCategories->getCurrentMasterTable() == "WorksheetMasters" && $WorksheetMasterCategories->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="WorksheetMasters">
<input type="hidden" name="fk_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->getSessionValue()) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->getCurrentMasterTable() == "WorksheetCategories" && $WorksheetMasterCategories->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="WorksheetCategories">
<input type="hidden" name="fk_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetCategory_Idn->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_WorksheetMasterCategories" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($WorksheetMasterCategories_list->TotalRecords > 0 || $WorksheetMasterCategories_list->isAdd() || $WorksheetMasterCategories_list->isCopy() || $WorksheetMasterCategories_list->isGridEdit()) { ?>
<table id="tbl_WorksheetMasterCategorieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$WorksheetMasterCategories->RowType = ROWTYPE_HEADER;

// Render list options
$WorksheetMasterCategories_list->renderListOptions();

// Render list options (header, left)
$WorksheetMasterCategories_list->ListOptions->render("header", "left");
?>
<?php if ($WorksheetMasterCategories_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_WorksheetMaster_Idn" class="WorksheetMasterCategories_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->WorksheetMaster_Idn) ?>', 1);"><div id="elh_WorksheetMasterCategories_WorksheetMaster_Idn" class="WorksheetMasterCategories_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_list->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_list->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<?php if ($WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->WorksheetCategory_Idn) == "") { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_WorksheetCategory_Idn" class="WorksheetMasterCategories_WorksheetCategory_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->WorksheetCategory_Idn) ?>', 1);"><div id="elh_WorksheetMasterCategories_WorksheetCategory_Idn" class="WorksheetMasterCategories_WorksheetCategory_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_list->WorksheetCategory_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_list->WorksheetCategory_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_list->Rank->Visible) { // Rank ?>
	<?php if ($WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $WorksheetMasterCategories_list->Rank->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_Rank" class="WorksheetMasterCategories_Rank"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $WorksheetMasterCategories_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->Rank) ?>', 1);"><div id="elh_WorksheetMasterCategories_Rank" class="WorksheetMasterCategories_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_list->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
	<?php if ($WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->AutoLoadFlag) == "") { ?>
		<th data-name="AutoLoadFlag" class="<?php echo $WorksheetMasterCategories_list->AutoLoadFlag->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_AutoLoadFlag" class="WorksheetMasterCategories_AutoLoadFlag"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->AutoLoadFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AutoLoadFlag" class="<?php echo $WorksheetMasterCategories_list->AutoLoadFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->AutoLoadFlag) ?>', 1);"><div id="elh_WorksheetMasterCategories_AutoLoadFlag" class="WorksheetMasterCategories_AutoLoadFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->AutoLoadFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_list->AutoLoadFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_list->AutoLoadFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_list->LoadFlag->Visible) { // LoadFlag ?>
	<?php if ($WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->LoadFlag) == "") { ?>
		<th data-name="LoadFlag" class="<?php echo $WorksheetMasterCategories_list->LoadFlag->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_LoadFlag" class="WorksheetMasterCategories_LoadFlag"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->LoadFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LoadFlag" class="<?php echo $WorksheetMasterCategories_list->LoadFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->LoadFlag) ?>', 1);"><div id="elh_WorksheetMasterCategories_LoadFlag" class="WorksheetMasterCategories_LoadFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->LoadFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_list->LoadFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_list->LoadFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_list->AddMiscFlag->Visible) { // AddMiscFlag ?>
	<?php if ($WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->AddMiscFlag) == "") { ?>
		<th data-name="AddMiscFlag" class="<?php echo $WorksheetMasterCategories_list->AddMiscFlag->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_AddMiscFlag" class="WorksheetMasterCategories_AddMiscFlag"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->AddMiscFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AddMiscFlag" class="<?php echo $WorksheetMasterCategories_list->AddMiscFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->AddMiscFlag) ?>', 1);"><div id="elh_WorksheetMasterCategories_AddMiscFlag" class="WorksheetMasterCategories_AddMiscFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->AddMiscFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_list->AddMiscFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_list->AddMiscFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
	<?php if ($WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn) == "") { ?>
		<th data-name="ChildWorksheetMaster_Idn" class="<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="WorksheetMasterCategories_ChildWorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChildWorksheetMaster_Idn" class="<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasterCategories_list->SortUrl($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn) ?>', 1);"><div id="elh_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="WorksheetMasterCategories_ChildWorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$WorksheetMasterCategories_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($WorksheetMasterCategories_list->isAdd() || $WorksheetMasterCategories_list->isCopy()) {
		$WorksheetMasterCategories_list->RowIndex = 0;
		$WorksheetMasterCategories_list->KeyCount = $WorksheetMasterCategories_list->RowIndex;
		if ($WorksheetMasterCategories_list->isCopy() && !$WorksheetMasterCategories_list->loadRow())
			$WorksheetMasterCategories->CurrentAction = "add";
		if ($WorksheetMasterCategories_list->isAdd())
			$WorksheetMasterCategories_list->loadRowValues();
		if ($WorksheetMasterCategories->EventCancelled) // Insert failed
			$WorksheetMasterCategories_list->restoreFormValues(); // Restore form values

		// Set row properties
		$WorksheetMasterCategories->resetAttributes();
		$WorksheetMasterCategories->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_WorksheetMasterCategories", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetMasterCategories->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetMasterCategories_list->renderRow();

		// Render list options
		$WorksheetMasterCategories_list->renderListOptions();
		$WorksheetMasterCategories_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetMasterCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterCategories_list->ListOptions->render("body", "left", $WorksheetMasterCategories_list->RowCount);
?>
	<?php if ($WorksheetMasterCategories_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<?php if ($WorksheetMasterCategories_list->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group WorksheetMasterCategories_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_list->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group WorksheetMasterCategories_WorksheetMaster_Idn">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->EditValue ?>"<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn">
<?php if ($WorksheetMasterCategories_list->WorksheetCategory_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group WorksheetMasterCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_list->WorksheetCategory_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetCategory_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group WorksheetMasterCategories_WorksheetCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->Lookup->getParamTag($WorksheetMasterCategories_list, "p_x" . $WorksheetMasterCategories_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_Rank" class="form-group WorksheetMasterCategories_Rank">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_Rank" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_list->Rank->EditValue ?>"<?php echo $WorksheetMasterCategories_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_Rank" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<td data-name="AutoLoadFlag">
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_AutoLoadFlag" class="form-group WorksheetMasterCategories_AutoLoadFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]_244510" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]_244510"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->AutoLoadFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->LoadFlag->Visible) { // LoadFlag ?>
		<td data-name="LoadFlag">
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_LoadFlag" class="form-group WorksheetMasterCategories_LoadFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]_295249" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]_295249"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->LoadFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->AddMiscFlag->Visible) { // AddMiscFlag ?>
		<td data-name="AddMiscFlag">
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_AddMiscFlag" class="form-group WorksheetMasterCategories_AddMiscFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->AddMiscFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]_990054" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->AddMiscFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]_990054"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->AddMiscFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
		<td data-name="ChildWorksheetMaster_Idn">
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="form-group WorksheetMasterCategories_ChildWorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn"<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_list->RowIndex}_ChildWorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterCategories_list, "p_x" . $WorksheetMasterCategories_list->RowIndex . "_ChildWorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterCategories_list->ListOptions->render("body", "right", $WorksheetMasterCategories_list->RowCount);
?>
<script>
loadjs.ready(["fWorksheetMasterCategorieslist", "load"], function() {
	fWorksheetMasterCategorieslist.updateLists(<?php echo $WorksheetMasterCategories_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($WorksheetMasterCategories_list->ExportAll && $WorksheetMasterCategories_list->isExport()) {
	$WorksheetMasterCategories_list->StopRecord = $WorksheetMasterCategories_list->TotalRecords;
} else {

	// Set the last record to display
	if ($WorksheetMasterCategories_list->TotalRecords > $WorksheetMasterCategories_list->StartRecord + $WorksheetMasterCategories_list->DisplayRecords - 1)
		$WorksheetMasterCategories_list->StopRecord = $WorksheetMasterCategories_list->StartRecord + $WorksheetMasterCategories_list->DisplayRecords - 1;
	else
		$WorksheetMasterCategories_list->StopRecord = $WorksheetMasterCategories_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($WorksheetMasterCategories->isConfirm() || $WorksheetMasterCategories_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($WorksheetMasterCategories_list->FormKeyCountName) && ($WorksheetMasterCategories_list->isGridAdd() || $WorksheetMasterCategories_list->isGridEdit() || $WorksheetMasterCategories->isConfirm())) {
		$WorksheetMasterCategories_list->KeyCount = $CurrentForm->getValue($WorksheetMasterCategories_list->FormKeyCountName);
		$WorksheetMasterCategories_list->StopRecord = $WorksheetMasterCategories_list->StartRecord + $WorksheetMasterCategories_list->KeyCount - 1;
	}
}
$WorksheetMasterCategories_list->RecordCount = $WorksheetMasterCategories_list->StartRecord - 1;
if ($WorksheetMasterCategories_list->Recordset && !$WorksheetMasterCategories_list->Recordset->EOF) {
	$WorksheetMasterCategories_list->Recordset->moveFirst();
	$selectLimit = $WorksheetMasterCategories_list->UseSelectLimit;
	if (!$selectLimit && $WorksheetMasterCategories_list->StartRecord > 1)
		$WorksheetMasterCategories_list->Recordset->move($WorksheetMasterCategories_list->StartRecord - 1);
} elseif (!$WorksheetMasterCategories->AllowAddDeleteRow && $WorksheetMasterCategories_list->StopRecord == 0) {
	$WorksheetMasterCategories_list->StopRecord = $WorksheetMasterCategories->GridAddRowCount;
}

// Initialize aggregate
$WorksheetMasterCategories->RowType = ROWTYPE_AGGREGATEINIT;
$WorksheetMasterCategories->resetAttributes();
$WorksheetMasterCategories_list->renderRow();
$WorksheetMasterCategories_list->EditRowCount = 0;
if ($WorksheetMasterCategories_list->isEdit())
	$WorksheetMasterCategories_list->RowIndex = 1;
if ($WorksheetMasterCategories_list->isGridAdd())
	$WorksheetMasterCategories_list->RowIndex = 0;
if ($WorksheetMasterCategories_list->isGridEdit())
	$WorksheetMasterCategories_list->RowIndex = 0;
while ($WorksheetMasterCategories_list->RecordCount < $WorksheetMasterCategories_list->StopRecord) {
	$WorksheetMasterCategories_list->RecordCount++;
	if ($WorksheetMasterCategories_list->RecordCount >= $WorksheetMasterCategories_list->StartRecord) {
		$WorksheetMasterCategories_list->RowCount++;
		if ($WorksheetMasterCategories_list->isGridAdd() || $WorksheetMasterCategories_list->isGridEdit() || $WorksheetMasterCategories->isConfirm()) {
			$WorksheetMasterCategories_list->RowIndex++;
			$CurrentForm->Index = $WorksheetMasterCategories_list->RowIndex;
			if ($CurrentForm->hasValue($WorksheetMasterCategories_list->FormActionName) && ($WorksheetMasterCategories->isConfirm() || $WorksheetMasterCategories_list->EventCancelled))
				$WorksheetMasterCategories_list->RowAction = strval($CurrentForm->getValue($WorksheetMasterCategories_list->FormActionName));
			elseif ($WorksheetMasterCategories_list->isGridAdd())
				$WorksheetMasterCategories_list->RowAction = "insert";
			else
				$WorksheetMasterCategories_list->RowAction = "";
		}

		// Set up key count
		$WorksheetMasterCategories_list->KeyCount = $WorksheetMasterCategories_list->RowIndex;

		// Init row class and style
		$WorksheetMasterCategories->resetAttributes();
		$WorksheetMasterCategories->CssClass = "";
		if ($WorksheetMasterCategories_list->isGridAdd()) {
			$WorksheetMasterCategories_list->loadRowValues(); // Load default values
		} else {
			$WorksheetMasterCategories_list->loadRowValues($WorksheetMasterCategories_list->Recordset); // Load row values
		}
		$WorksheetMasterCategories->RowType = ROWTYPE_VIEW; // Render view
		if ($WorksheetMasterCategories_list->isGridAdd()) // Grid add
			$WorksheetMasterCategories->RowType = ROWTYPE_ADD; // Render add
		if ($WorksheetMasterCategories_list->isGridAdd() && $WorksheetMasterCategories->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$WorksheetMasterCategories_list->restoreCurrentRowFormValues($WorksheetMasterCategories_list->RowIndex); // Restore form values
		if ($WorksheetMasterCategories_list->isEdit()) {
			if ($WorksheetMasterCategories_list->checkInlineEditKey() && $WorksheetMasterCategories_list->EditRowCount == 0) { // Inline edit
				$WorksheetMasterCategories->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($WorksheetMasterCategories_list->isGridEdit()) { // Grid edit
			if ($WorksheetMasterCategories->EventCancelled)
				$WorksheetMasterCategories_list->restoreCurrentRowFormValues($WorksheetMasterCategories_list->RowIndex); // Restore form values
			if ($WorksheetMasterCategories_list->RowAction == "insert")
				$WorksheetMasterCategories->RowType = ROWTYPE_ADD; // Render add
			else
				$WorksheetMasterCategories->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($WorksheetMasterCategories_list->isEdit() && $WorksheetMasterCategories->RowType == ROWTYPE_EDIT && $WorksheetMasterCategories->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$WorksheetMasterCategories_list->restoreFormValues(); // Restore form values
		}
		if ($WorksheetMasterCategories_list->isGridEdit() && ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT || $WorksheetMasterCategories->RowType == ROWTYPE_ADD) && $WorksheetMasterCategories->EventCancelled) // Update failed
			$WorksheetMasterCategories_list->restoreCurrentRowFormValues($WorksheetMasterCategories_list->RowIndex); // Restore form values
		if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) // Edit row
			$WorksheetMasterCategories_list->EditRowCount++;

		// Set up row id / data-rowindex
		$WorksheetMasterCategories->RowAttrs->merge(["data-rowindex" => $WorksheetMasterCategories_list->RowCount, "id" => "r" . $WorksheetMasterCategories_list->RowCount . "_WorksheetMasterCategories", "data-rowtype" => $WorksheetMasterCategories->RowType]);

		// Render row
		$WorksheetMasterCategories_list->renderRow();

		// Render list options
		$WorksheetMasterCategories_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($WorksheetMasterCategories_list->RowAction != "delete" && $WorksheetMasterCategories_list->RowAction != "insertdelete" && !($WorksheetMasterCategories_list->RowAction == "insert" && $WorksheetMasterCategories->isConfirm() && $WorksheetMasterCategories_list->emptyRow())) {
?>
	<tr <?php echo $WorksheetMasterCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterCategories_list->ListOptions->render("body", "left", $WorksheetMasterCategories_list->RowCount);
?>
	<?php if ($WorksheetMasterCategories_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($WorksheetMasterCategories_list->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group">
<span<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_list->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->EditValue ?>"<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($WorksheetMasterCategories_list->WorksheetMaster_Idn->getSessionValue() != "") { ?>

<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group">
<span<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_list->WorksheetMaster_Idn->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->EditValue ?>"<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->OldValue != null ? $WorksheetMasterCategories_list->WorksheetMaster_Idn->OldValue : $WorksheetMasterCategories_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn" <?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($WorksheetMasterCategories_list->WorksheetCategory_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group">
<span<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_list->WorksheetCategory_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetCategory_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->Lookup->getParamTag($WorksheetMasterCategories_list, "p_x" . $WorksheetMasterCategories_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetCategory_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($WorksheetMasterCategories_list->WorksheetCategory_Idn->getSessionValue() != "") { ?>

<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group">
<span<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_list->WorksheetCategory_Idn->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetCategory_Idn->CurrentValue) ?>">
<?php } else { ?>

<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->Lookup->getParamTag($WorksheetMasterCategories_list, "p_x" . $WorksheetMasterCategories_list->RowIndex . "_WorksheetCategory_Idn") ?>

<?php } ?>

<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetCategory_Idn->OldValue != null ? $WorksheetMasterCategories_list->WorksheetCategory_Idn->OldValue : $WorksheetMasterCategories_list->WorksheetCategory_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $WorksheetMasterCategories_list->Rank->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_Rank" class="form-group">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_Rank" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_list->Rank->EditValue ?>"<?php echo $WorksheetMasterCategories_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_Rank" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_Rank" class="form-group">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_Rank" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_list->Rank->EditValue ?>"<?php echo $WorksheetMasterCategories_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_Rank">
<span<?php echo $WorksheetMasterCategories_list->Rank->viewAttributes() ?>><?php echo $WorksheetMasterCategories_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<td data-name="AutoLoadFlag" <?php echo $WorksheetMasterCategories_list->AutoLoadFlag->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_AutoLoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]_297560" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]_297560"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->AutoLoadFlag->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_AutoLoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]_540955" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]_540955"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_AutoLoadFlag">
<span<?php echo $WorksheetMasterCategories_list->AutoLoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AutoLoadFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_list->AutoLoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_list->AutoLoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AutoLoadFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->LoadFlag->Visible) { // LoadFlag ?>
		<td data-name="LoadFlag" <?php echo $WorksheetMasterCategories_list->LoadFlag->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_LoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]_277327" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]_277327"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->LoadFlag->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_LoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]_759152" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]_759152"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_LoadFlag">
<span<?php echo $WorksheetMasterCategories_list->LoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LoadFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_list->LoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_list->LoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LoadFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->AddMiscFlag->Visible) { // AddMiscFlag ?>
		<td data-name="AddMiscFlag" <?php echo $WorksheetMasterCategories_list->AddMiscFlag->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_AddMiscFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->AddMiscFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]_645944" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->AddMiscFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]_645944"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->AddMiscFlag->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_AddMiscFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->AddMiscFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]_999333" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->AddMiscFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]_999333"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_AddMiscFlag">
<span<?php echo $WorksheetMasterCategories_list->AddMiscFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AddMiscFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_list->AddMiscFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_list->AddMiscFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AddMiscFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
		<td data-name="ChildWorksheetMaster_Idn" <?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn"<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_list->RowIndex}_ChildWorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterCategories_list, "p_x" . $WorksheetMasterCategories_list->RowIndex . "_ChildWorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn"<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_list->RowIndex}_ChildWorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterCategories_list, "p_x" . $WorksheetMasterCategories_list->RowIndex . "_ChildWorksheetMaster_Idn") ?>
</span>
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_list->RowCount ?>_WorksheetMasterCategories_ChildWorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterCategories_list->ListOptions->render("body", "right", $WorksheetMasterCategories_list->RowCount);
?>
	</tr>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD || $WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fWorksheetMasterCategorieslist", "load"], function() {
	fWorksheetMasterCategorieslist.updateLists(<?php echo $WorksheetMasterCategories_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$WorksheetMasterCategories_list->isGridAdd())
		if (!$WorksheetMasterCategories_list->Recordset->EOF)
			$WorksheetMasterCategories_list->Recordset->moveNext();
}
?>
<?php
	if ($WorksheetMasterCategories_list->isGridAdd() || $WorksheetMasterCategories_list->isGridEdit()) {
		$WorksheetMasterCategories_list->RowIndex = '$rowindex$';
		$WorksheetMasterCategories_list->loadRowValues();

		// Set row properties
		$WorksheetMasterCategories->resetAttributes();
		$WorksheetMasterCategories->RowAttrs->merge(["data-rowindex" => $WorksheetMasterCategories_list->RowIndex, "id" => "r0_WorksheetMasterCategories", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetMasterCategories->RowAttrs->appendClass("ew-template");
		$WorksheetMasterCategories->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetMasterCategories_list->renderRow();

		// Render list options
		$WorksheetMasterCategories_list->renderListOptions();
		$WorksheetMasterCategories_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetMasterCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterCategories_list->ListOptions->render("body", "left", $WorksheetMasterCategories_list->RowIndex);
?>
	<?php if ($WorksheetMasterCategories_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<?php if ($WorksheetMasterCategories_list->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el$rowindex$_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group WorksheetMasterCategories_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_list->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group WorksheetMasterCategories_WorksheetMaster_Idn">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->EditValue ?>"<?php echo $WorksheetMasterCategories_list->WorksheetMaster_Idn->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn">
<?php if ($WorksheetMasterCategories_list->WorksheetCategory_Idn->getSessionValue() != "") { ?>
<span id="el$rowindex$_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group WorksheetMasterCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_list->WorksheetCategory_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetCategory_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group WorksheetMasterCategories_WorksheetCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_list->WorksheetCategory_Idn->Lookup->getParamTag($WorksheetMasterCategories_list, "p_x" . $WorksheetMasterCategories_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->WorksheetCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_WorksheetMasterCategories_Rank" class="form-group WorksheetMasterCategories_Rank">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_Rank" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_list->Rank->EditValue ?>"<?php echo $WorksheetMasterCategories_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_Rank" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<td data-name="AutoLoadFlag">
<span id="el$rowindex$_WorksheetMasterCategories_AutoLoadFlag" class="form-group WorksheetMasterCategories_AutoLoadFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]_336490" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]_336490"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AutoLoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->AutoLoadFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->LoadFlag->Visible) { // LoadFlag ?>
		<td data-name="LoadFlag">
<span id="el$rowindex$_WorksheetMasterCategories_LoadFlag" class="form-group WorksheetMasterCategories_LoadFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]_848329" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]_848329"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_LoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->LoadFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->AddMiscFlag->Visible) { // AddMiscFlag ?>
		<td data-name="AddMiscFlag">
<span id="el$rowindex$_WorksheetMasterCategories_AddMiscFlag" class="form-group WorksheetMasterCategories_AddMiscFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_list->AddMiscFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]_609373" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_list->AddMiscFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]_609373"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_AddMiscFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->AddMiscFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
		<td data-name="ChildWorksheetMaster_Idn">
<span id="el$rowindex$_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="form-group WorksheetMasterCategories_ChildWorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn"<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_list->RowIndex}_ChildWorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterCategories_list, "p_x" . $WorksheetMasterCategories_list->RowIndex . "_ChildWorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_list->RowIndex ?>_ChildWorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterCategories_list->ListOptions->render("body", "right", $WorksheetMasterCategories_list->RowIndex);
?>
<script>
loadjs.ready(["fWorksheetMasterCategorieslist", "load"], function() {
	fWorksheetMasterCategorieslist.updateLists(<?php echo $WorksheetMasterCategories_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($WorksheetMasterCategories_list->isAdd() || $WorksheetMasterCategories_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $WorksheetMasterCategories_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasterCategories_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasterCategories_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $WorksheetMasterCategories_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasterCategories_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasterCategories_list->KeyCount ?>">
<?php echo $WorksheetMasterCategories_list->MultiSelectKey ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $WorksheetMasterCategories_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasterCategories_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasterCategories_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $WorksheetMasterCategories_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasterCategories_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasterCategories_list->KeyCount ?>">
<?php echo $WorksheetMasterCategories_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$WorksheetMasterCategories->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($WorksheetMasterCategories_list->Recordset)
	$WorksheetMasterCategories_list->Recordset->Close();
?>
<?php if (!$WorksheetMasterCategories_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$WorksheetMasterCategories_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetMasterCategories_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetMasterCategories_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($WorksheetMasterCategories_list->TotalRecords == 0 && !$WorksheetMasterCategories->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $WorksheetMasterCategories_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$WorksheetMasterCategories_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$WorksheetMasterCategories_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$WorksheetMasterCategories_list->terminate();
?>