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
$WorksheetCategories_list = new WorksheetCategories_list();

// Run the page
$WorksheetCategories_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetCategories_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$WorksheetCategories_list->isExport()) { ?>
<script>
var fWorksheetCategorieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fWorksheetCategorieslist = currentForm = new ew.Form("fWorksheetCategorieslist", "list");
	fWorksheetCategorieslist.formKeyCountName = '<?php echo $WorksheetCategories_list->FormKeyCountName ?>';

	// Validate form
	fWorksheetCategorieslist.validate = function() {
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
			<?php if ($WorksheetCategories_list->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_list->WorksheetCategory_Idn->caption(), $WorksheetCategories_list->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_list->Name->caption(), $WorksheetCategories_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_list->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_list->ShortName->caption(), $WorksheetCategories_list->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_list->Department_Idn->caption(), $WorksheetCategories_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_list->FieldUnitPrice->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_list->FieldUnitPrice->caption(), $WorksheetCategories_list->FieldUnitPrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FieldUnitPrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetCategories_list->FieldUnitPrice->errorMessage()) ?>");
			<?php if ($WorksheetCategories_list->IsFitting->Required) { ?>
				elm = this.getElements("x" + infix + "_IsFitting[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_list->IsFitting->caption(), $WorksheetCategories_list->IsFitting->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_list->CartFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_CartFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_list->CartFlag->caption(), $WorksheetCategories_list->CartFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_list->IsShared->Required) { ?>
				elm = this.getElements("x" + infix + "_IsShared[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_list->IsShared->caption(), $WorksheetCategories_list->IsShared->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_list->IsAssembly->Required) { ?>
				elm = this.getElements("x" + infix + "_IsAssembly[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_list->IsAssembly->caption(), $WorksheetCategories_list->IsAssembly->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetCategories_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetCategories_list->ActiveFlag->caption(), $WorksheetCategories_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fWorksheetCategorieslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "ShortName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "FieldUnitPrice", false)) return false;
		if (ew.valueChanged(fobj, infix, "IsFitting[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "CartFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "IsShared[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "IsAssembly[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fWorksheetCategorieslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetCategorieslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetCategorieslist.lists["x_Department_Idn"] = <?php echo $WorksheetCategories_list->Department_Idn->Lookup->toClientList($WorksheetCategories_list) ?>;
	fWorksheetCategorieslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($WorksheetCategories_list->Department_Idn->lookupOptions()) ?>;
	fWorksheetCategorieslist.lists["x_IsFitting[]"] = <?php echo $WorksheetCategories_list->IsFitting->Lookup->toClientList($WorksheetCategories_list) ?>;
	fWorksheetCategorieslist.lists["x_IsFitting[]"].options = <?php echo JsonEncode($WorksheetCategories_list->IsFitting->options(FALSE, TRUE)) ?>;
	fWorksheetCategorieslist.lists["x_CartFlag[]"] = <?php echo $WorksheetCategories_list->CartFlag->Lookup->toClientList($WorksheetCategories_list) ?>;
	fWorksheetCategorieslist.lists["x_CartFlag[]"].options = <?php echo JsonEncode($WorksheetCategories_list->CartFlag->options(FALSE, TRUE)) ?>;
	fWorksheetCategorieslist.lists["x_IsShared[]"] = <?php echo $WorksheetCategories_list->IsShared->Lookup->toClientList($WorksheetCategories_list) ?>;
	fWorksheetCategorieslist.lists["x_IsShared[]"].options = <?php echo JsonEncode($WorksheetCategories_list->IsShared->options(FALSE, TRUE)) ?>;
	fWorksheetCategorieslist.lists["x_IsAssembly[]"] = <?php echo $WorksheetCategories_list->IsAssembly->Lookup->toClientList($WorksheetCategories_list) ?>;
	fWorksheetCategorieslist.lists["x_IsAssembly[]"].options = <?php echo JsonEncode($WorksheetCategories_list->IsAssembly->options(FALSE, TRUE)) ?>;
	fWorksheetCategorieslist.lists["x_ActiveFlag[]"] = <?php echo $WorksheetCategories_list->ActiveFlag->Lookup->toClientList($WorksheetCategories_list) ?>;
	fWorksheetCategorieslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($WorksheetCategories_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fWorksheetCategorieslist");
});
var fWorksheetCategorieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fWorksheetCategorieslistsrch = currentSearchForm = new ew.Form("fWorksheetCategorieslistsrch");

	// Dynamic selection lists
	// Filters

	fWorksheetCategorieslistsrch.filterList = <?php echo $WorksheetCategories_list->getFilterList() ?>;
	loadjs.done("fWorksheetCategorieslistsrch");
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
<?php if (!$WorksheetCategories_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($WorksheetCategories_list->TotalRecords > 0 && $WorksheetCategories_list->ExportOptions->visible()) { ?>
<?php $WorksheetCategories_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetCategories_list->ImportOptions->visible()) { ?>
<?php $WorksheetCategories_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetCategories_list->SearchOptions->visible()) { ?>
<?php $WorksheetCategories_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetCategories_list->FilterOptions->visible()) { ?>
<?php $WorksheetCategories_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$WorksheetCategories_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$WorksheetCategories_list->isExport() && !$WorksheetCategories->CurrentAction) { ?>
<form name="fWorksheetCategorieslistsrch" id="fWorksheetCategorieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fWorksheetCategorieslistsrch-search-panel" class="<?php echo $WorksheetCategories_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="WorksheetCategories">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $WorksheetCategories_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($WorksheetCategories_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($WorksheetCategories_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $WorksheetCategories_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($WorksheetCategories_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($WorksheetCategories_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($WorksheetCategories_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($WorksheetCategories_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $WorksheetCategories_list->showPageHeader(); ?>
<?php
$WorksheetCategories_list->showMessage();
?>
<?php if ($WorksheetCategories_list->TotalRecords > 0 || $WorksheetCategories->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($WorksheetCategories_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> WorksheetCategories">
<?php if (!$WorksheetCategories_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$WorksheetCategories_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetCategories_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetCategories_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fWorksheetCategorieslist" id="fWorksheetCategorieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetCategories">
<div id="gmp_WorksheetCategories" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($WorksheetCategories_list->TotalRecords > 0 || $WorksheetCategories_list->isAdd() || $WorksheetCategories_list->isCopy() || $WorksheetCategories_list->isGridEdit()) { ?>
<table id="tbl_WorksheetCategorieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$WorksheetCategories->RowType = ROWTYPE_HEADER;

// Render list options
$WorksheetCategories_list->renderListOptions();

// Render list options (header, left)
$WorksheetCategories_list->ListOptions->render("header", "left");
?>
<?php if ($WorksheetCategories_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<?php if ($WorksheetCategories_list->SortUrl($WorksheetCategories_list->WorksheetCategory_Idn) == "") { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $WorksheetCategories_list->WorksheetCategory_Idn->headerCellClass() ?>"><div id="elh_WorksheetCategories_WorksheetCategory_Idn" class="WorksheetCategories_WorksheetCategory_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetCategories_list->WorksheetCategory_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $WorksheetCategories_list->WorksheetCategory_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetCategories_list->SortUrl($WorksheetCategories_list->WorksheetCategory_Idn) ?>', 1);"><div id="elh_WorksheetCategories_WorksheetCategory_Idn" class="WorksheetCategories_WorksheetCategory_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetCategories_list->WorksheetCategory_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetCategories_list->WorksheetCategory_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetCategories_list->WorksheetCategory_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetCategories_list->Name->Visible) { // Name ?>
	<?php if ($WorksheetCategories_list->SortUrl($WorksheetCategories_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $WorksheetCategories_list->Name->headerCellClass() ?>"><div id="elh_WorksheetCategories_Name" class="WorksheetCategories_Name"><div class="ew-table-header-caption"><?php echo $WorksheetCategories_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $WorksheetCategories_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetCategories_list->SortUrl($WorksheetCategories_list->Name) ?>', 1);"><div id="elh_WorksheetCategories_Name" class="WorksheetCategories_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetCategories_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($WorksheetCategories_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetCategories_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetCategories_list->ShortName->Visible) { // ShortName ?>
	<?php if ($WorksheetCategories_list->SortUrl($WorksheetCategories_list->ShortName) == "") { ?>
		<th data-name="ShortName" class="<?php echo $WorksheetCategories_list->ShortName->headerCellClass() ?>"><div id="elh_WorksheetCategories_ShortName" class="WorksheetCategories_ShortName"><div class="ew-table-header-caption"><?php echo $WorksheetCategories_list->ShortName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShortName" class="<?php echo $WorksheetCategories_list->ShortName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetCategories_list->SortUrl($WorksheetCategories_list->ShortName) ?>', 1);"><div id="elh_WorksheetCategories_ShortName" class="WorksheetCategories_ShortName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetCategories_list->ShortName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($WorksheetCategories_list->ShortName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetCategories_list->ShortName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetCategories_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($WorksheetCategories_list->SortUrl($WorksheetCategories_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $WorksheetCategories_list->Department_Idn->headerCellClass() ?>"><div id="elh_WorksheetCategories_Department_Idn" class="WorksheetCategories_Department_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetCategories_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $WorksheetCategories_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetCategories_list->SortUrl($WorksheetCategories_list->Department_Idn) ?>', 1);"><div id="elh_WorksheetCategories_Department_Idn" class="WorksheetCategories_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetCategories_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetCategories_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetCategories_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetCategories_list->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
	<?php if ($WorksheetCategories_list->SortUrl($WorksheetCategories_list->FieldUnitPrice) == "") { ?>
		<th data-name="FieldUnitPrice" class="<?php echo $WorksheetCategories_list->FieldUnitPrice->headerCellClass() ?>"><div id="elh_WorksheetCategories_FieldUnitPrice" class="WorksheetCategories_FieldUnitPrice"><div class="ew-table-header-caption"><?php echo $WorksheetCategories_list->FieldUnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FieldUnitPrice" class="<?php echo $WorksheetCategories_list->FieldUnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetCategories_list->SortUrl($WorksheetCategories_list->FieldUnitPrice) ?>', 1);"><div id="elh_WorksheetCategories_FieldUnitPrice" class="WorksheetCategories_FieldUnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetCategories_list->FieldUnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetCategories_list->FieldUnitPrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetCategories_list->FieldUnitPrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetCategories_list->IsFitting->Visible) { // IsFitting ?>
	<?php if ($WorksheetCategories_list->SortUrl($WorksheetCategories_list->IsFitting) == "") { ?>
		<th data-name="IsFitting" class="<?php echo $WorksheetCategories_list->IsFitting->headerCellClass() ?>"><div id="elh_WorksheetCategories_IsFitting" class="WorksheetCategories_IsFitting"><div class="ew-table-header-caption"><?php echo $WorksheetCategories_list->IsFitting->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsFitting" class="<?php echo $WorksheetCategories_list->IsFitting->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetCategories_list->SortUrl($WorksheetCategories_list->IsFitting) ?>', 1);"><div id="elh_WorksheetCategories_IsFitting" class="WorksheetCategories_IsFitting">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetCategories_list->IsFitting->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetCategories_list->IsFitting->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetCategories_list->IsFitting->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetCategories_list->CartFlag->Visible) { // CartFlag ?>
	<?php if ($WorksheetCategories_list->SortUrl($WorksheetCategories_list->CartFlag) == "") { ?>
		<th data-name="CartFlag" class="<?php echo $WorksheetCategories_list->CartFlag->headerCellClass() ?>"><div id="elh_WorksheetCategories_CartFlag" class="WorksheetCategories_CartFlag"><div class="ew-table-header-caption"><?php echo $WorksheetCategories_list->CartFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CartFlag" class="<?php echo $WorksheetCategories_list->CartFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetCategories_list->SortUrl($WorksheetCategories_list->CartFlag) ?>', 1);"><div id="elh_WorksheetCategories_CartFlag" class="WorksheetCategories_CartFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetCategories_list->CartFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetCategories_list->CartFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetCategories_list->CartFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetCategories_list->IsShared->Visible) { // IsShared ?>
	<?php if ($WorksheetCategories_list->SortUrl($WorksheetCategories_list->IsShared) == "") { ?>
		<th data-name="IsShared" class="<?php echo $WorksheetCategories_list->IsShared->headerCellClass() ?>"><div id="elh_WorksheetCategories_IsShared" class="WorksheetCategories_IsShared"><div class="ew-table-header-caption"><?php echo $WorksheetCategories_list->IsShared->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsShared" class="<?php echo $WorksheetCategories_list->IsShared->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetCategories_list->SortUrl($WorksheetCategories_list->IsShared) ?>', 1);"><div id="elh_WorksheetCategories_IsShared" class="WorksheetCategories_IsShared">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetCategories_list->IsShared->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetCategories_list->IsShared->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetCategories_list->IsShared->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetCategories_list->IsAssembly->Visible) { // IsAssembly ?>
	<?php if ($WorksheetCategories_list->SortUrl($WorksheetCategories_list->IsAssembly) == "") { ?>
		<th data-name="IsAssembly" class="<?php echo $WorksheetCategories_list->IsAssembly->headerCellClass() ?>"><div id="elh_WorksheetCategories_IsAssembly" class="WorksheetCategories_IsAssembly"><div class="ew-table-header-caption"><?php echo $WorksheetCategories_list->IsAssembly->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsAssembly" class="<?php echo $WorksheetCategories_list->IsAssembly->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetCategories_list->SortUrl($WorksheetCategories_list->IsAssembly) ?>', 1);"><div id="elh_WorksheetCategories_IsAssembly" class="WorksheetCategories_IsAssembly">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetCategories_list->IsAssembly->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetCategories_list->IsAssembly->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetCategories_list->IsAssembly->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetCategories_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($WorksheetCategories_list->SortUrl($WorksheetCategories_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $WorksheetCategories_list->ActiveFlag->headerCellClass() ?>"><div id="elh_WorksheetCategories_ActiveFlag" class="WorksheetCategories_ActiveFlag"><div class="ew-table-header-caption"><?php echo $WorksheetCategories_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $WorksheetCategories_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetCategories_list->SortUrl($WorksheetCategories_list->ActiveFlag) ?>', 1);"><div id="elh_WorksheetCategories_ActiveFlag" class="WorksheetCategories_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetCategories_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetCategories_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetCategories_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$WorksheetCategories_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($WorksheetCategories_list->isAdd() || $WorksheetCategories_list->isCopy()) {
		$WorksheetCategories_list->RowIndex = 0;
		$WorksheetCategories_list->KeyCount = $WorksheetCategories_list->RowIndex;
		if ($WorksheetCategories_list->isCopy() && !$WorksheetCategories_list->loadRow())
			$WorksheetCategories->CurrentAction = "add";
		if ($WorksheetCategories_list->isAdd())
			$WorksheetCategories_list->loadRowValues();
		if ($WorksheetCategories->EventCancelled) // Insert failed
			$WorksheetCategories_list->restoreFormValues(); // Restore form values

		// Set row properties
		$WorksheetCategories->resetAttributes();
		$WorksheetCategories->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_WorksheetCategories", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetCategories->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetCategories_list->renderRow();

		// Render list options
		$WorksheetCategories_list->renderListOptions();
		$WorksheetCategories_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetCategories_list->ListOptions->render("body", "left", $WorksheetCategories_list->RowCount);
?>
	<?php if ($WorksheetCategories_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn">
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_WorksheetCategory_Idn" class="form-group WorksheetCategories_WorksheetCategory_Idn"></span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_WorksheetCategory_Idn" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetCategories_list->WorksheetCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_Name" class="form-group WorksheetCategories_Name">
<input type="text" data-table="WorksheetCategories" data-field="x_Name" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_Name" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->Name->EditValue ?>"<?php echo $WorksheetCategories_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_Name" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_Name" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($WorksheetCategories_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_ShortName" class="form-group WorksheetCategories_ShortName">
<input type="text" data-table="WorksheetCategories" data-field="x_ShortName" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->ShortName->EditValue ?>"<?php echo $WorksheetCategories_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_ShortName" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($WorksheetCategories_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_Department_Idn" class="form-group WorksheetCategories_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetCategories" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetCategories_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn"<?php echo $WorksheetCategories_list->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetCategories_list->Department_Idn->selectOptionListHtml("x{$WorksheetCategories_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetCategories_list->Department_Idn->Lookup->getParamTag($WorksheetCategories_list, "p_x" . $WorksheetCategories_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_Department_Idn" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($WorksheetCategories_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<td data-name="FieldUnitPrice">
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_FieldUnitPrice" class="form-group WorksheetCategories_FieldUnitPrice">
<input type="text" data-table="WorksheetCategories" data-field="x_FieldUnitPrice" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" size="10" maxlength="8" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->FieldUnitPrice->EditValue ?>"<?php echo $WorksheetCategories_list->FieldUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_FieldUnitPrice" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" value="<?php echo HtmlEncode($WorksheetCategories_list->FieldUnitPrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->IsFitting->Visible) { // IsFitting ?>
		<td data-name="IsFitting">
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsFitting" class="form-group WorksheetCategories_IsFitting">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsFitting->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsFitting" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]_889329" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsFitting->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]_889329"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_IsFitting" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]" value="<?php echo HtmlEncode($WorksheetCategories_list->IsFitting->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->CartFlag->Visible) { // CartFlag ?>
		<td data-name="CartFlag">
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_CartFlag" class="form-group WorksheetCategories_CartFlag">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->CartFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_CartFlag" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]_776757" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->CartFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]_776757"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_CartFlag" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]" value="<?php echo HtmlEncode($WorksheetCategories_list->CartFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->IsShared->Visible) { // IsShared ?>
		<td data-name="IsShared">
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsShared" class="form-group WorksheetCategories_IsShared">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsShared->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsShared" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]_974614" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsShared->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]_974614"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_IsShared" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]" value="<?php echo HtmlEncode($WorksheetCategories_list->IsShared->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->IsAssembly->Visible) { // IsAssembly ?>
		<td data-name="IsAssembly">
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsAssembly" class="form-group WorksheetCategories_IsAssembly">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsAssembly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsAssembly" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]_631413" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsAssembly->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]_631413"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_IsAssembly" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]" value="<?php echo HtmlEncode($WorksheetCategories_list->IsAssembly->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_ActiveFlag" class="form-group WorksheetCategories_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_ActiveFlag" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]_492509" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]_492509"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_ActiveFlag" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetCategories_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetCategories_list->ListOptions->render("body", "right", $WorksheetCategories_list->RowCount);
?>
<script>
loadjs.ready(["fWorksheetCategorieslist", "load"], function() {
	fWorksheetCategorieslist.updateLists(<?php echo $WorksheetCategories_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($WorksheetCategories_list->ExportAll && $WorksheetCategories_list->isExport()) {
	$WorksheetCategories_list->StopRecord = $WorksheetCategories_list->TotalRecords;
} else {

	// Set the last record to display
	if ($WorksheetCategories_list->TotalRecords > $WorksheetCategories_list->StartRecord + $WorksheetCategories_list->DisplayRecords - 1)
		$WorksheetCategories_list->StopRecord = $WorksheetCategories_list->StartRecord + $WorksheetCategories_list->DisplayRecords - 1;
	else
		$WorksheetCategories_list->StopRecord = $WorksheetCategories_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($WorksheetCategories->isConfirm() || $WorksheetCategories_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($WorksheetCategories_list->FormKeyCountName) && ($WorksheetCategories_list->isGridAdd() || $WorksheetCategories_list->isGridEdit() || $WorksheetCategories->isConfirm())) {
		$WorksheetCategories_list->KeyCount = $CurrentForm->getValue($WorksheetCategories_list->FormKeyCountName);
		$WorksheetCategories_list->StopRecord = $WorksheetCategories_list->StartRecord + $WorksheetCategories_list->KeyCount - 1;
	}
}
$WorksheetCategories_list->RecordCount = $WorksheetCategories_list->StartRecord - 1;
if ($WorksheetCategories_list->Recordset && !$WorksheetCategories_list->Recordset->EOF) {
	$WorksheetCategories_list->Recordset->moveFirst();
	$selectLimit = $WorksheetCategories_list->UseSelectLimit;
	if (!$selectLimit && $WorksheetCategories_list->StartRecord > 1)
		$WorksheetCategories_list->Recordset->move($WorksheetCategories_list->StartRecord - 1);
} elseif (!$WorksheetCategories->AllowAddDeleteRow && $WorksheetCategories_list->StopRecord == 0) {
	$WorksheetCategories_list->StopRecord = $WorksheetCategories->GridAddRowCount;
}

// Initialize aggregate
$WorksheetCategories->RowType = ROWTYPE_AGGREGATEINIT;
$WorksheetCategories->resetAttributes();
$WorksheetCategories_list->renderRow();
$WorksheetCategories_list->EditRowCount = 0;
if ($WorksheetCategories_list->isEdit())
	$WorksheetCategories_list->RowIndex = 1;
if ($WorksheetCategories_list->isGridAdd())
	$WorksheetCategories_list->RowIndex = 0;
if ($WorksheetCategories_list->isGridEdit())
	$WorksheetCategories_list->RowIndex = 0;
while ($WorksheetCategories_list->RecordCount < $WorksheetCategories_list->StopRecord) {
	$WorksheetCategories_list->RecordCount++;
	if ($WorksheetCategories_list->RecordCount >= $WorksheetCategories_list->StartRecord) {
		$WorksheetCategories_list->RowCount++;
		if ($WorksheetCategories_list->isGridAdd() || $WorksheetCategories_list->isGridEdit() || $WorksheetCategories->isConfirm()) {
			$WorksheetCategories_list->RowIndex++;
			$CurrentForm->Index = $WorksheetCategories_list->RowIndex;
			if ($CurrentForm->hasValue($WorksheetCategories_list->FormActionName) && ($WorksheetCategories->isConfirm() || $WorksheetCategories_list->EventCancelled))
				$WorksheetCategories_list->RowAction = strval($CurrentForm->getValue($WorksheetCategories_list->FormActionName));
			elseif ($WorksheetCategories_list->isGridAdd())
				$WorksheetCategories_list->RowAction = "insert";
			else
				$WorksheetCategories_list->RowAction = "";
		}

		// Set up key count
		$WorksheetCategories_list->KeyCount = $WorksheetCategories_list->RowIndex;

		// Init row class and style
		$WorksheetCategories->resetAttributes();
		$WorksheetCategories->CssClass = "";
		if ($WorksheetCategories_list->isGridAdd()) {
			$WorksheetCategories_list->loadRowValues(); // Load default values
		} else {
			$WorksheetCategories_list->loadRowValues($WorksheetCategories_list->Recordset); // Load row values
		}
		$WorksheetCategories->RowType = ROWTYPE_VIEW; // Render view
		if ($WorksheetCategories_list->isGridAdd()) // Grid add
			$WorksheetCategories->RowType = ROWTYPE_ADD; // Render add
		if ($WorksheetCategories_list->isGridAdd() && $WorksheetCategories->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$WorksheetCategories_list->restoreCurrentRowFormValues($WorksheetCategories_list->RowIndex); // Restore form values
		if ($WorksheetCategories_list->isEdit()) {
			if ($WorksheetCategories_list->checkInlineEditKey() && $WorksheetCategories_list->EditRowCount == 0) { // Inline edit
				$WorksheetCategories->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($WorksheetCategories_list->isGridEdit()) { // Grid edit
			if ($WorksheetCategories->EventCancelled)
				$WorksheetCategories_list->restoreCurrentRowFormValues($WorksheetCategories_list->RowIndex); // Restore form values
			if ($WorksheetCategories_list->RowAction == "insert")
				$WorksheetCategories->RowType = ROWTYPE_ADD; // Render add
			else
				$WorksheetCategories->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($WorksheetCategories_list->isEdit() && $WorksheetCategories->RowType == ROWTYPE_EDIT && $WorksheetCategories->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$WorksheetCategories_list->restoreFormValues(); // Restore form values
		}
		if ($WorksheetCategories_list->isGridEdit() && ($WorksheetCategories->RowType == ROWTYPE_EDIT || $WorksheetCategories->RowType == ROWTYPE_ADD) && $WorksheetCategories->EventCancelled) // Update failed
			$WorksheetCategories_list->restoreCurrentRowFormValues($WorksheetCategories_list->RowIndex); // Restore form values
		if ($WorksheetCategories->RowType == ROWTYPE_EDIT) // Edit row
			$WorksheetCategories_list->EditRowCount++;

		// Set up row id / data-rowindex
		$WorksheetCategories->RowAttrs->merge(["data-rowindex" => $WorksheetCategories_list->RowCount, "id" => "r" . $WorksheetCategories_list->RowCount . "_WorksheetCategories", "data-rowtype" => $WorksheetCategories->RowType]);

		// Render row
		$WorksheetCategories_list->renderRow();

		// Render list options
		$WorksheetCategories_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($WorksheetCategories_list->RowAction != "delete" && $WorksheetCategories_list->RowAction != "insertdelete" && !($WorksheetCategories_list->RowAction == "insert" && $WorksheetCategories->isConfirm() && $WorksheetCategories_list->emptyRow())) {
?>
	<tr <?php echo $WorksheetCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetCategories_list->ListOptions->render("body", "left", $WorksheetCategories_list->RowCount);
?>
	<?php if ($WorksheetCategories_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn" <?php echo $WorksheetCategories_list->WorksheetCategory_Idn->cellAttributes() ?>>
<?php if ($WorksheetCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_WorksheetCategory_Idn" class="form-group"></span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_WorksheetCategory_Idn" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetCategories_list->WorksheetCategory_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_WorksheetCategory_Idn" class="form-group">
<span<?php echo $WorksheetCategories_list->WorksheetCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetCategories_list->WorksheetCategory_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_WorksheetCategory_Idn" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_WorksheetCategory_Idn" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetCategories_list->WorksheetCategory_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetCategories_list->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $WorksheetCategories_list->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $WorksheetCategories_list->Name->cellAttributes() ?>>
<?php if ($WorksheetCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_Name" class="form-group">
<input type="text" data-table="WorksheetCategories" data-field="x_Name" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_Name" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->Name->EditValue ?>"<?php echo $WorksheetCategories_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_Name" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_Name" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($WorksheetCategories_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_Name" class="form-group">
<input type="text" data-table="WorksheetCategories" data-field="x_Name" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_Name" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->Name->EditValue ?>"<?php echo $WorksheetCategories_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_Name">
<span<?php echo $WorksheetCategories_list->Name->viewAttributes() ?>><?php echo $WorksheetCategories_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName" <?php echo $WorksheetCategories_list->ShortName->cellAttributes() ?>>
<?php if ($WorksheetCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_ShortName" class="form-group">
<input type="text" data-table="WorksheetCategories" data-field="x_ShortName" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->ShortName->EditValue ?>"<?php echo $WorksheetCategories_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_ShortName" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($WorksheetCategories_list->ShortName->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_ShortName" class="form-group">
<input type="text" data-table="WorksheetCategories" data-field="x_ShortName" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->ShortName->EditValue ?>"<?php echo $WorksheetCategories_list->ShortName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_ShortName">
<span<?php echo $WorksheetCategories_list->ShortName->viewAttributes() ?>><?php echo $WorksheetCategories_list->ShortName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $WorksheetCategories_list->Department_Idn->cellAttributes() ?>>
<?php if ($WorksheetCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetCategories" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetCategories_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn"<?php echo $WorksheetCategories_list->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetCategories_list->Department_Idn->selectOptionListHtml("x{$WorksheetCategories_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetCategories_list->Department_Idn->Lookup->getParamTag($WorksheetCategories_list, "p_x" . $WorksheetCategories_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_Department_Idn" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($WorksheetCategories_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetCategories" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetCategories_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn"<?php echo $WorksheetCategories_list->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetCategories_list->Department_Idn->selectOptionListHtml("x{$WorksheetCategories_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetCategories_list->Department_Idn->Lookup->getParamTag($WorksheetCategories_list, "p_x" . $WorksheetCategories_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_Department_Idn">
<span<?php echo $WorksheetCategories_list->Department_Idn->viewAttributes() ?>><?php echo $WorksheetCategories_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<td data-name="FieldUnitPrice" <?php echo $WorksheetCategories_list->FieldUnitPrice->cellAttributes() ?>>
<?php if ($WorksheetCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_FieldUnitPrice" class="form-group">
<input type="text" data-table="WorksheetCategories" data-field="x_FieldUnitPrice" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" size="10" maxlength="8" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->FieldUnitPrice->EditValue ?>"<?php echo $WorksheetCategories_list->FieldUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_FieldUnitPrice" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" value="<?php echo HtmlEncode($WorksheetCategories_list->FieldUnitPrice->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_FieldUnitPrice" class="form-group">
<input type="text" data-table="WorksheetCategories" data-field="x_FieldUnitPrice" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" size="10" maxlength="8" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->FieldUnitPrice->EditValue ?>"<?php echo $WorksheetCategories_list->FieldUnitPrice->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_FieldUnitPrice">
<span<?php echo $WorksheetCategories_list->FieldUnitPrice->viewAttributes() ?>><?php echo $WorksheetCategories_list->FieldUnitPrice->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->IsFitting->Visible) { // IsFitting ?>
		<td data-name="IsFitting" <?php echo $WorksheetCategories_list->IsFitting->cellAttributes() ?>>
<?php if ($WorksheetCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsFitting" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsFitting->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsFitting" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]_463012" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsFitting->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]_463012"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_IsFitting" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]" value="<?php echo HtmlEncode($WorksheetCategories_list->IsFitting->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsFitting" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsFitting->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsFitting" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]_710086" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsFitting->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]_710086"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsFitting">
<span<?php echo $WorksheetCategories_list->IsFitting->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsFitting" class="custom-control-input" value="<?php echo $WorksheetCategories_list->IsFitting->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories_list->IsFitting->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsFitting"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->CartFlag->Visible) { // CartFlag ?>
		<td data-name="CartFlag" <?php echo $WorksheetCategories_list->CartFlag->cellAttributes() ?>>
<?php if ($WorksheetCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_CartFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->CartFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_CartFlag" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]_768733" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->CartFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]_768733"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_CartFlag" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]" value="<?php echo HtmlEncode($WorksheetCategories_list->CartFlag->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_CartFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->CartFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_CartFlag" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]_492916" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->CartFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]_492916"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_CartFlag">
<span<?php echo $WorksheetCategories_list->CartFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CartFlag" class="custom-control-input" value="<?php echo $WorksheetCategories_list->CartFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories_list->CartFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CartFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->IsShared->Visible) { // IsShared ?>
		<td data-name="IsShared" <?php echo $WorksheetCategories_list->IsShared->cellAttributes() ?>>
<?php if ($WorksheetCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsShared" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsShared->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsShared" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]_486395" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsShared->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]_486395"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_IsShared" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]" value="<?php echo HtmlEncode($WorksheetCategories_list->IsShared->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsShared" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsShared->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsShared" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]_911902" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsShared->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]_911902"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsShared">
<span<?php echo $WorksheetCategories_list->IsShared->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsShared" class="custom-control-input" value="<?php echo $WorksheetCategories_list->IsShared->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories_list->IsShared->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsShared"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->IsAssembly->Visible) { // IsAssembly ?>
		<td data-name="IsAssembly" <?php echo $WorksheetCategories_list->IsAssembly->cellAttributes() ?>>
<?php if ($WorksheetCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsAssembly" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsAssembly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsAssembly" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]_974918" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsAssembly->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]_974918"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_IsAssembly" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]" value="<?php echo HtmlEncode($WorksheetCategories_list->IsAssembly->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsAssembly" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsAssembly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsAssembly" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]_625666" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsAssembly->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]_625666"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_IsAssembly">
<span<?php echo $WorksheetCategories_list->IsAssembly->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsAssembly" class="custom-control-input" value="<?php echo $WorksheetCategories_list->IsAssembly->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories_list->IsAssembly->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsAssembly"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $WorksheetCategories_list->ActiveFlag->cellAttributes() ?>>
<?php if ($WorksheetCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_ActiveFlag" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]_136323" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]_136323"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_ActiveFlag" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetCategories_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_ActiveFlag" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]_814045" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]_814045"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetCategories_list->RowCount ?>_WorksheetCategories_ActiveFlag">
<span<?php echo $WorksheetCategories_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $WorksheetCategories_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetCategories_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetCategories_list->ListOptions->render("body", "right", $WorksheetCategories_list->RowCount);
?>
	</tr>
<?php if ($WorksheetCategories->RowType == ROWTYPE_ADD || $WorksheetCategories->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fWorksheetCategorieslist", "load"], function() {
	fWorksheetCategorieslist.updateLists(<?php echo $WorksheetCategories_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$WorksheetCategories_list->isGridAdd())
		if (!$WorksheetCategories_list->Recordset->EOF)
			$WorksheetCategories_list->Recordset->moveNext();
}
?>
<?php
	if ($WorksheetCategories_list->isGridAdd() || $WorksheetCategories_list->isGridEdit()) {
		$WorksheetCategories_list->RowIndex = '$rowindex$';
		$WorksheetCategories_list->loadRowValues();

		// Set row properties
		$WorksheetCategories->resetAttributes();
		$WorksheetCategories->RowAttrs->merge(["data-rowindex" => $WorksheetCategories_list->RowIndex, "id" => "r0_WorksheetCategories", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetCategories->RowAttrs->appendClass("ew-template");
		$WorksheetCategories->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetCategories_list->renderRow();

		// Render list options
		$WorksheetCategories_list->renderListOptions();
		$WorksheetCategories_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetCategories_list->ListOptions->render("body", "left", $WorksheetCategories_list->RowIndex);
?>
	<?php if ($WorksheetCategories_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn">
<span id="el$rowindex$_WorksheetCategories_WorksheetCategory_Idn" class="form-group WorksheetCategories_WorksheetCategory_Idn"></span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_WorksheetCategory_Idn" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetCategories_list->WorksheetCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_WorksheetCategories_Name" class="form-group WorksheetCategories_Name">
<input type="text" data-table="WorksheetCategories" data-field="x_Name" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_Name" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->Name->EditValue ?>"<?php echo $WorksheetCategories_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_Name" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_Name" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($WorksheetCategories_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el$rowindex$_WorksheetCategories_ShortName" class="form-group WorksheetCategories_ShortName">
<input type="text" data-table="WorksheetCategories" data-field="x_ShortName" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->ShortName->EditValue ?>"<?php echo $WorksheetCategories_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_ShortName" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($WorksheetCategories_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_WorksheetCategories_Department_Idn" class="form-group WorksheetCategories_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetCategories" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetCategories_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn"<?php echo $WorksheetCategories_list->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetCategories_list->Department_Idn->selectOptionListHtml("x{$WorksheetCategories_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetCategories_list->Department_Idn->Lookup->getParamTag($WorksheetCategories_list, "p_x" . $WorksheetCategories_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_Department_Idn" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($WorksheetCategories_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<td data-name="FieldUnitPrice">
<span id="el$rowindex$_WorksheetCategories_FieldUnitPrice" class="form-group WorksheetCategories_FieldUnitPrice">
<input type="text" data-table="WorksheetCategories" data-field="x_FieldUnitPrice" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" size="10" maxlength="8" placeholder="<?php echo HtmlEncode($WorksheetCategories_list->FieldUnitPrice->getPlaceHolder()) ?>" value="<?php echo $WorksheetCategories_list->FieldUnitPrice->EditValue ?>"<?php echo $WorksheetCategories_list->FieldUnitPrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_FieldUnitPrice" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_FieldUnitPrice" value="<?php echo HtmlEncode($WorksheetCategories_list->FieldUnitPrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->IsFitting->Visible) { // IsFitting ?>
		<td data-name="IsFitting">
<span id="el$rowindex$_WorksheetCategories_IsFitting" class="form-group WorksheetCategories_IsFitting">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsFitting->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsFitting" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]_353247" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsFitting->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]_353247"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_IsFitting" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsFitting[]" value="<?php echo HtmlEncode($WorksheetCategories_list->IsFitting->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->CartFlag->Visible) { // CartFlag ?>
		<td data-name="CartFlag">
<span id="el$rowindex$_WorksheetCategories_CartFlag" class="form-group WorksheetCategories_CartFlag">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->CartFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_CartFlag" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]_456036" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->CartFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]_456036"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_CartFlag" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_CartFlag[]" value="<?php echo HtmlEncode($WorksheetCategories_list->CartFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->IsShared->Visible) { // IsShared ?>
		<td data-name="IsShared">
<span id="el$rowindex$_WorksheetCategories_IsShared" class="form-group WorksheetCategories_IsShared">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsShared->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsShared" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]_307586" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsShared->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]_307586"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_IsShared" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsShared[]" value="<?php echo HtmlEncode($WorksheetCategories_list->IsShared->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->IsAssembly->Visible) { // IsAssembly ?>
		<td data-name="IsAssembly">
<span id="el$rowindex$_WorksheetCategories_IsAssembly" class="form-group WorksheetCategories_IsAssembly">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->IsAssembly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_IsAssembly" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]_732964" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->IsAssembly->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]_732964"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_IsAssembly" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_IsAssembly[]" value="<?php echo HtmlEncode($WorksheetCategories_list->IsAssembly->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetCategories_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_WorksheetCategories_ActiveFlag" class="form-group WorksheetCategories_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetCategories_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetCategories" data-field="x_ActiveFlag" name="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]_867022" value="1"<?php echo $selwrk ?><?php echo $WorksheetCategories_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]_867022"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetCategories" data-field="x_ActiveFlag" name="o<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetCategories_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetCategories_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetCategories_list->ListOptions->render("body", "right", $WorksheetCategories_list->RowIndex);
?>
<script>
loadjs.ready(["fWorksheetCategorieslist", "load"], function() {
	fWorksheetCategorieslist.updateLists(<?php echo $WorksheetCategories_list->RowIndex ?>);
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
<?php if ($WorksheetCategories_list->isAdd() || $WorksheetCategories_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $WorksheetCategories_list->FormKeyCountName ?>" id="<?php echo $WorksheetCategories_list->FormKeyCountName ?>" value="<?php echo $WorksheetCategories_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetCategories_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $WorksheetCategories_list->FormKeyCountName ?>" id="<?php echo $WorksheetCategories_list->FormKeyCountName ?>" value="<?php echo $WorksheetCategories_list->KeyCount ?>">
<?php echo $WorksheetCategories_list->MultiSelectKey ?>
<?php } ?>
<?php if ($WorksheetCategories_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $WorksheetCategories_list->FormKeyCountName ?>" id="<?php echo $WorksheetCategories_list->FormKeyCountName ?>" value="<?php echo $WorksheetCategories_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetCategories_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $WorksheetCategories_list->FormKeyCountName ?>" id="<?php echo $WorksheetCategories_list->FormKeyCountName ?>" value="<?php echo $WorksheetCategories_list->KeyCount ?>">
<?php echo $WorksheetCategories_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$WorksheetCategories->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($WorksheetCategories_list->Recordset)
	$WorksheetCategories_list->Recordset->Close();
?>
<?php if (!$WorksheetCategories_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$WorksheetCategories_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetCategories_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetCategories_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($WorksheetCategories_list->TotalRecords == 0 && !$WorksheetCategories->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $WorksheetCategories_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$WorksheetCategories_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$WorksheetCategories_list->isExport()) { ?>
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
$WorksheetCategories_list->terminate();
?>