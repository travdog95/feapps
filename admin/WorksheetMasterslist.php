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
$WorksheetMasters_list = new WorksheetMasters_list();

// Run the page
$WorksheetMasters_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasters_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$WorksheetMasters_list->isExport()) { ?>
<script>
var fWorksheetMasterslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fWorksheetMasterslist = currentForm = new ew.Form("fWorksheetMasterslist", "list");
	fWorksheetMasterslist.formKeyCountName = '<?php echo $WorksheetMasters_list->FormKeyCountName ?>';

	// Validate form
	fWorksheetMasterslist.validate = function() {
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
			<?php if ($WorksheetMasters_list->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_list->WorksheetMaster_Idn->caption(), $WorksheetMasters_list->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_list->Name->caption(), $WorksheetMasters_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_list->Department_Idn->caption(), $WorksheetMasters_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_list->Rank->caption(), $WorksheetMasters_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasters_list->Rank->errorMessage()) ?>");
			<?php if ($WorksheetMasters_list->NumberOfColumns->Required) { ?>
				elm = this.getElements("x" + infix + "_NumberOfColumns");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_list->NumberOfColumns->caption(), $WorksheetMasters_list->NumberOfColumns->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumberOfColumns");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasters_list->NumberOfColumns->errorMessage()) ?>");
			<?php if ($WorksheetMasters_list->AllowMultiple->Required) { ?>
				elm = this.getElements("x" + infix + "_AllowMultiple[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_list->AllowMultiple->caption(), $WorksheetMasters_list->AllowMultiple->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasters_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasters_list->ActiveFlag->caption(), $WorksheetMasters_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fWorksheetMasterslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "NumberOfColumns", false)) return false;
		if (ew.valueChanged(fobj, infix, "AllowMultiple[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fWorksheetMasterslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetMasterslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetMasterslist.lists["x_Department_Idn"] = <?php echo $WorksheetMasters_list->Department_Idn->Lookup->toClientList($WorksheetMasters_list) ?>;
	fWorksheetMasterslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($WorksheetMasters_list->Department_Idn->lookupOptions()) ?>;
	fWorksheetMasterslist.lists["x_AllowMultiple[]"] = <?php echo $WorksheetMasters_list->AllowMultiple->Lookup->toClientList($WorksheetMasters_list) ?>;
	fWorksheetMasterslist.lists["x_AllowMultiple[]"].options = <?php echo JsonEncode($WorksheetMasters_list->AllowMultiple->options(FALSE, TRUE)) ?>;
	fWorksheetMasterslist.lists["x_ActiveFlag[]"] = <?php echo $WorksheetMasters_list->ActiveFlag->Lookup->toClientList($WorksheetMasters_list) ?>;
	fWorksheetMasterslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($WorksheetMasters_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fWorksheetMasterslist");
});
var fWorksheetMasterslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fWorksheetMasterslistsrch = currentSearchForm = new ew.Form("fWorksheetMasterslistsrch");

	// Validate function for search
	fWorksheetMasterslistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fWorksheetMasterslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetMasterslistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetMasterslistsrch.lists["x_Department_Idn"] = <?php echo $WorksheetMasters_list->Department_Idn->Lookup->toClientList($WorksheetMasters_list) ?>;
	fWorksheetMasterslistsrch.lists["x_Department_Idn"].options = <?php echo JsonEncode($WorksheetMasters_list->Department_Idn->lookupOptions()) ?>;

	// Filters
	fWorksheetMasterslistsrch.filterList = <?php echo $WorksheetMasters_list->getFilterList() ?>;
	loadjs.done("fWorksheetMasterslistsrch");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
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
<?php if (!$WorksheetMasters_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($WorksheetMasters_list->TotalRecords > 0 && $WorksheetMasters_list->ExportOptions->visible()) { ?>
<?php $WorksheetMasters_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetMasters_list->ImportOptions->visible()) { ?>
<?php $WorksheetMasters_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetMasters_list->SearchOptions->visible()) { ?>
<?php $WorksheetMasters_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetMasters_list->FilterOptions->visible()) { ?>
<?php $WorksheetMasters_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$WorksheetMasters_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$WorksheetMasters_list->isExport() && !$WorksheetMasters->CurrentAction) { ?>
<form name="fWorksheetMasterslistsrch" id="fWorksheetMasterslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fWorksheetMasterslistsrch-search-panel" class="<?php echo $WorksheetMasters_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="WorksheetMasters">
	<div class="ew-extended-search">
<?php

// Render search row
$WorksheetMasters->RowType = ROWTYPE_SEARCH;
$WorksheetMasters->resetAttributes();
$WorksheetMasters_list->renderRow();
?>
<?php if ($WorksheetMasters_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php
		$WorksheetMasters_list->SearchColumnCount++;
		if (($WorksheetMasters_list->SearchColumnCount - 1) % $WorksheetMasters_list->SearchFieldsPerRow == 0) {
			$WorksheetMasters_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $WorksheetMasters_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Department_Idn" class="ew-cell form-group">
		<label for="x_Department_Idn" class="ew-search-caption ew-label"><?php echo $WorksheetMasters_list->Department_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Department_Idn" id="z_Department_Idn" value="=">
</span>
		<span id="el_WorksheetMasters_Department_Idn" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasters" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetMasters_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $WorksheetMasters_list->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasters_list->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasters_list->Department_Idn->Lookup->getParamTag($WorksheetMasters_list, "p_x_Department_Idn") ?>
</span>
	</div>
	<?php if ($WorksheetMasters_list->SearchColumnCount % $WorksheetMasters_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($WorksheetMasters_list->SearchColumnCount % $WorksheetMasters_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $WorksheetMasters_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($WorksheetMasters_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($WorksheetMasters_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $WorksheetMasters_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($WorksheetMasters_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($WorksheetMasters_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($WorksheetMasters_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($WorksheetMasters_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $WorksheetMasters_list->showPageHeader(); ?>
<?php
$WorksheetMasters_list->showMessage();
?>
<?php if ($WorksheetMasters_list->TotalRecords > 0 || $WorksheetMasters->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($WorksheetMasters_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> WorksheetMasters">
<?php if (!$WorksheetMasters_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$WorksheetMasters_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetMasters_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetMasters_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fWorksheetMasterslist" id="fWorksheetMasterslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetMasters">
<div id="gmp_WorksheetMasters" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($WorksheetMasters_list->TotalRecords > 0 || $WorksheetMasters_list->isAdd() || $WorksheetMasters_list->isCopy() || $WorksheetMasters_list->isGridEdit()) { ?>
<table id="tbl_WorksheetMasterslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$WorksheetMasters->RowType = ROWTYPE_HEADER;

// Render list options
$WorksheetMasters_list->renderListOptions();

// Render list options (header, left)
$WorksheetMasters_list->ListOptions->render("header", "left");
?>
<?php if ($WorksheetMasters_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($WorksheetMasters_list->SortUrl($WorksheetMasters_list->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetMasters_list->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasters_WorksheetMaster_Idn" class="WorksheetMasters_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasters_list->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetMasters_list->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasters_list->SortUrl($WorksheetMasters_list->WorksheetMaster_Idn) ?>', 1);"><div id="elh_WorksheetMasters_WorksheetMaster_Idn" class="WorksheetMasters_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasters_list->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasters_list->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasters_list->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasters_list->Name->Visible) { // Name ?>
	<?php if ($WorksheetMasters_list->SortUrl($WorksheetMasters_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $WorksheetMasters_list->Name->headerCellClass() ?>"><div id="elh_WorksheetMasters_Name" class="WorksheetMasters_Name"><div class="ew-table-header-caption"><?php echo $WorksheetMasters_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $WorksheetMasters_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasters_list->SortUrl($WorksheetMasters_list->Name) ?>', 1);"><div id="elh_WorksheetMasters_Name" class="WorksheetMasters_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasters_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasters_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasters_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasters_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($WorksheetMasters_list->SortUrl($WorksheetMasters_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $WorksheetMasters_list->Department_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasters_Department_Idn" class="WorksheetMasters_Department_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasters_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $WorksheetMasters_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasters_list->SortUrl($WorksheetMasters_list->Department_Idn) ?>', 1);"><div id="elh_WorksheetMasters_Department_Idn" class="WorksheetMasters_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasters_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasters_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasters_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasters_list->Rank->Visible) { // Rank ?>
	<?php if ($WorksheetMasters_list->SortUrl($WorksheetMasters_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $WorksheetMasters_list->Rank->headerCellClass() ?>"><div id="elh_WorksheetMasters_Rank" class="WorksheetMasters_Rank"><div class="ew-table-header-caption"><?php echo $WorksheetMasters_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $WorksheetMasters_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasters_list->SortUrl($WorksheetMasters_list->Rank) ?>', 1);"><div id="elh_WorksheetMasters_Rank" class="WorksheetMasters_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasters_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasters_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasters_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasters_list->NumberOfColumns->Visible) { // NumberOfColumns ?>
	<?php if ($WorksheetMasters_list->SortUrl($WorksheetMasters_list->NumberOfColumns) == "") { ?>
		<th data-name="NumberOfColumns" class="<?php echo $WorksheetMasters_list->NumberOfColumns->headerCellClass() ?>"><div id="elh_WorksheetMasters_NumberOfColumns" class="WorksheetMasters_NumberOfColumns"><div class="ew-table-header-caption"><?php echo $WorksheetMasters_list->NumberOfColumns->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NumberOfColumns" class="<?php echo $WorksheetMasters_list->NumberOfColumns->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasters_list->SortUrl($WorksheetMasters_list->NumberOfColumns) ?>', 1);"><div id="elh_WorksheetMasters_NumberOfColumns" class="WorksheetMasters_NumberOfColumns">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasters_list->NumberOfColumns->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasters_list->NumberOfColumns->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasters_list->NumberOfColumns->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasters_list->AllowMultiple->Visible) { // AllowMultiple ?>
	<?php if ($WorksheetMasters_list->SortUrl($WorksheetMasters_list->AllowMultiple) == "") { ?>
		<th data-name="AllowMultiple" class="<?php echo $WorksheetMasters_list->AllowMultiple->headerCellClass() ?>"><div id="elh_WorksheetMasters_AllowMultiple" class="WorksheetMasters_AllowMultiple"><div class="ew-table-header-caption"><?php echo $WorksheetMasters_list->AllowMultiple->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AllowMultiple" class="<?php echo $WorksheetMasters_list->AllowMultiple->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasters_list->SortUrl($WorksheetMasters_list->AllowMultiple) ?>', 1);"><div id="elh_WorksheetMasters_AllowMultiple" class="WorksheetMasters_AllowMultiple">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasters_list->AllowMultiple->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasters_list->AllowMultiple->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasters_list->AllowMultiple->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasters_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($WorksheetMasters_list->SortUrl($WorksheetMasters_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $WorksheetMasters_list->ActiveFlag->headerCellClass() ?>"><div id="elh_WorksheetMasters_ActiveFlag" class="WorksheetMasters_ActiveFlag"><div class="ew-table-header-caption"><?php echo $WorksheetMasters_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $WorksheetMasters_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasters_list->SortUrl($WorksheetMasters_list->ActiveFlag) ?>', 1);"><div id="elh_WorksheetMasters_ActiveFlag" class="WorksheetMasters_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasters_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasters_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasters_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$WorksheetMasters_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($WorksheetMasters_list->isAdd() || $WorksheetMasters_list->isCopy()) {
		$WorksheetMasters_list->RowIndex = 0;
		$WorksheetMasters_list->KeyCount = $WorksheetMasters_list->RowIndex;
		if ($WorksheetMasters_list->isCopy() && !$WorksheetMasters_list->loadRow())
			$WorksheetMasters->CurrentAction = "add";
		if ($WorksheetMasters_list->isAdd())
			$WorksheetMasters_list->loadRowValues();
		if ($WorksheetMasters->EventCancelled) // Insert failed
			$WorksheetMasters_list->restoreFormValues(); // Restore form values

		// Set row properties
		$WorksheetMasters->resetAttributes();
		$WorksheetMasters->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_WorksheetMasters", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetMasters->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetMasters_list->renderRow();

		// Render list options
		$WorksheetMasters_list->renderListOptions();
		$WorksheetMasters_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetMasters->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasters_list->ListOptions->render("body", "left", $WorksheetMasters_list->RowCount);
?>
	<?php if ($WorksheetMasters_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_WorksheetMaster_Idn" class="form-group WorksheetMasters_WorksheetMaster_Idn"></span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasters_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Name" class="form-group WorksheetMasters_Name">
<input type="text" data-table="WorksheetMasters" data-field="x_Name" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Name" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->Name->EditValue ?>"<?php echo $WorksheetMasters_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_Name" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_Name" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($WorksheetMasters_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Department_Idn" class="form-group WorksheetMasters_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasters" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetMasters_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn"<?php echo $WorksheetMasters_list->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasters_list->Department_Idn->selectOptionListHtml("x{$WorksheetMasters_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasters_list->Department_Idn->Lookup->getParamTag($WorksheetMasters_list, "p_x" . $WorksheetMasters_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_Department_Idn" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($WorksheetMasters_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Rank" class="form-group WorksheetMasters_Rank">
<input type="text" data-table="WorksheetMasters" data-field="x_Rank" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->Rank->EditValue ?>"<?php echo $WorksheetMasters_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_Rank" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasters_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->NumberOfColumns->Visible) { // NumberOfColumns ?>
		<td data-name="NumberOfColumns">
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_NumberOfColumns" class="form-group WorksheetMasters_NumberOfColumns">
<input type="text" data-table="WorksheetMasters" data-field="x_NumberOfColumns" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->NumberOfColumns->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->NumberOfColumns->EditValue ?>"<?php echo $WorksheetMasters_list->NumberOfColumns->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_NumberOfColumns" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" value="<?php echo HtmlEncode($WorksheetMasters_list->NumberOfColumns->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->AllowMultiple->Visible) { // AllowMultiple ?>
		<td data-name="AllowMultiple">
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_AllowMultiple" class="form-group WorksheetMasters_AllowMultiple">
<?php
$selwrk = ConvertToBool($WorksheetMasters_list->AllowMultiple->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_AllowMultiple" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]_112831" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_list->AllowMultiple->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]_112831"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_AllowMultiple" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]" value="<?php echo HtmlEncode($WorksheetMasters_list->AllowMultiple->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_ActiveFlag" class="form-group WorksheetMasters_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasters_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_ActiveFlag" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]_248543" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]_248543"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_ActiveFlag" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetMasters_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasters_list->ListOptions->render("body", "right", $WorksheetMasters_list->RowCount);
?>
<script>
loadjs.ready(["fWorksheetMasterslist", "load"], function() {
	fWorksheetMasterslist.updateLists(<?php echo $WorksheetMasters_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($WorksheetMasters_list->ExportAll && $WorksheetMasters_list->isExport()) {
	$WorksheetMasters_list->StopRecord = $WorksheetMasters_list->TotalRecords;
} else {

	// Set the last record to display
	if ($WorksheetMasters_list->TotalRecords > $WorksheetMasters_list->StartRecord + $WorksheetMasters_list->DisplayRecords - 1)
		$WorksheetMasters_list->StopRecord = $WorksheetMasters_list->StartRecord + $WorksheetMasters_list->DisplayRecords - 1;
	else
		$WorksheetMasters_list->StopRecord = $WorksheetMasters_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($WorksheetMasters->isConfirm() || $WorksheetMasters_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($WorksheetMasters_list->FormKeyCountName) && ($WorksheetMasters_list->isGridAdd() || $WorksheetMasters_list->isGridEdit() || $WorksheetMasters->isConfirm())) {
		$WorksheetMasters_list->KeyCount = $CurrentForm->getValue($WorksheetMasters_list->FormKeyCountName);
		$WorksheetMasters_list->StopRecord = $WorksheetMasters_list->StartRecord + $WorksheetMasters_list->KeyCount - 1;
	}
}
$WorksheetMasters_list->RecordCount = $WorksheetMasters_list->StartRecord - 1;
if ($WorksheetMasters_list->Recordset && !$WorksheetMasters_list->Recordset->EOF) {
	$WorksheetMasters_list->Recordset->moveFirst();
	$selectLimit = $WorksheetMasters_list->UseSelectLimit;
	if (!$selectLimit && $WorksheetMasters_list->StartRecord > 1)
		$WorksheetMasters_list->Recordset->move($WorksheetMasters_list->StartRecord - 1);
} elseif (!$WorksheetMasters->AllowAddDeleteRow && $WorksheetMasters_list->StopRecord == 0) {
	$WorksheetMasters_list->StopRecord = $WorksheetMasters->GridAddRowCount;
}

// Initialize aggregate
$WorksheetMasters->RowType = ROWTYPE_AGGREGATEINIT;
$WorksheetMasters->resetAttributes();
$WorksheetMasters_list->renderRow();
$WorksheetMasters_list->EditRowCount = 0;
if ($WorksheetMasters_list->isEdit())
	$WorksheetMasters_list->RowIndex = 1;
if ($WorksheetMasters_list->isGridAdd())
	$WorksheetMasters_list->RowIndex = 0;
if ($WorksheetMasters_list->isGridEdit())
	$WorksheetMasters_list->RowIndex = 0;
while ($WorksheetMasters_list->RecordCount < $WorksheetMasters_list->StopRecord) {
	$WorksheetMasters_list->RecordCount++;
	if ($WorksheetMasters_list->RecordCount >= $WorksheetMasters_list->StartRecord) {
		$WorksheetMasters_list->RowCount++;
		if ($WorksheetMasters_list->isGridAdd() || $WorksheetMasters_list->isGridEdit() || $WorksheetMasters->isConfirm()) {
			$WorksheetMasters_list->RowIndex++;
			$CurrentForm->Index = $WorksheetMasters_list->RowIndex;
			if ($CurrentForm->hasValue($WorksheetMasters_list->FormActionName) && ($WorksheetMasters->isConfirm() || $WorksheetMasters_list->EventCancelled))
				$WorksheetMasters_list->RowAction = strval($CurrentForm->getValue($WorksheetMasters_list->FormActionName));
			elseif ($WorksheetMasters_list->isGridAdd())
				$WorksheetMasters_list->RowAction = "insert";
			else
				$WorksheetMasters_list->RowAction = "";
		}

		// Set up key count
		$WorksheetMasters_list->KeyCount = $WorksheetMasters_list->RowIndex;

		// Init row class and style
		$WorksheetMasters->resetAttributes();
		$WorksheetMasters->CssClass = "";
		if ($WorksheetMasters_list->isGridAdd()) {
			$WorksheetMasters_list->loadRowValues(); // Load default values
		} else {
			$WorksheetMasters_list->loadRowValues($WorksheetMasters_list->Recordset); // Load row values
		}
		$WorksheetMasters->RowType = ROWTYPE_VIEW; // Render view
		if ($WorksheetMasters_list->isGridAdd()) // Grid add
			$WorksheetMasters->RowType = ROWTYPE_ADD; // Render add
		if ($WorksheetMasters_list->isGridAdd() && $WorksheetMasters->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$WorksheetMasters_list->restoreCurrentRowFormValues($WorksheetMasters_list->RowIndex); // Restore form values
		if ($WorksheetMasters_list->isEdit()) {
			if ($WorksheetMasters_list->checkInlineEditKey() && $WorksheetMasters_list->EditRowCount == 0) { // Inline edit
				$WorksheetMasters->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($WorksheetMasters_list->isGridEdit()) { // Grid edit
			if ($WorksheetMasters->EventCancelled)
				$WorksheetMasters_list->restoreCurrentRowFormValues($WorksheetMasters_list->RowIndex); // Restore form values
			if ($WorksheetMasters_list->RowAction == "insert")
				$WorksheetMasters->RowType = ROWTYPE_ADD; // Render add
			else
				$WorksheetMasters->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($WorksheetMasters_list->isEdit() && $WorksheetMasters->RowType == ROWTYPE_EDIT && $WorksheetMasters->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$WorksheetMasters_list->restoreFormValues(); // Restore form values
		}
		if ($WorksheetMasters_list->isGridEdit() && ($WorksheetMasters->RowType == ROWTYPE_EDIT || $WorksheetMasters->RowType == ROWTYPE_ADD) && $WorksheetMasters->EventCancelled) // Update failed
			$WorksheetMasters_list->restoreCurrentRowFormValues($WorksheetMasters_list->RowIndex); // Restore form values
		if ($WorksheetMasters->RowType == ROWTYPE_EDIT) // Edit row
			$WorksheetMasters_list->EditRowCount++;

		// Set up row id / data-rowindex
		$WorksheetMasters->RowAttrs->merge(["data-rowindex" => $WorksheetMasters_list->RowCount, "id" => "r" . $WorksheetMasters_list->RowCount . "_WorksheetMasters", "data-rowtype" => $WorksheetMasters->RowType]);

		// Render row
		$WorksheetMasters_list->renderRow();

		// Render list options
		$WorksheetMasters_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($WorksheetMasters_list->RowAction != "delete" && $WorksheetMasters_list->RowAction != "insertdelete" && !($WorksheetMasters_list->RowAction == "insert" && $WorksheetMasters->isConfirm() && $WorksheetMasters_list->emptyRow())) {
?>
	<tr <?php echo $WorksheetMasters->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasters_list->ListOptions->render("body", "left", $WorksheetMasters_list->RowCount);
?>
	<?php if ($WorksheetMasters_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $WorksheetMasters_list->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasters->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_WorksheetMaster_Idn" class="form-group"></span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasters_list->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_WorksheetMaster_Idn" class="form-group">
<span<?php echo $WorksheetMasters_list->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasters_list->WorksheetMaster_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasters_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasters_list->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasters_list->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $WorksheetMasters_list->Name->cellAttributes() ?>>
<?php if ($WorksheetMasters->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Name" class="form-group">
<input type="text" data-table="WorksheetMasters" data-field="x_Name" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Name" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->Name->EditValue ?>"<?php echo $WorksheetMasters_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_Name" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_Name" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($WorksheetMasters_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Name" class="form-group">
<input type="text" data-table="WorksheetMasters" data-field="x_Name" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Name" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->Name->EditValue ?>"<?php echo $WorksheetMasters_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Name">
<span<?php echo $WorksheetMasters_list->Name->viewAttributes() ?>><?php echo $WorksheetMasters_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $WorksheetMasters_list->Department_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasters->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasters" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetMasters_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn"<?php echo $WorksheetMasters_list->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasters_list->Department_Idn->selectOptionListHtml("x{$WorksheetMasters_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasters_list->Department_Idn->Lookup->getParamTag($WorksheetMasters_list, "p_x" . $WorksheetMasters_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_Department_Idn" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($WorksheetMasters_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasters" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetMasters_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn"<?php echo $WorksheetMasters_list->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasters_list->Department_Idn->selectOptionListHtml("x{$WorksheetMasters_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasters_list->Department_Idn->Lookup->getParamTag($WorksheetMasters_list, "p_x" . $WorksheetMasters_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Department_Idn">
<span<?php echo $WorksheetMasters_list->Department_Idn->viewAttributes() ?>><?php echo $WorksheetMasters_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $WorksheetMasters_list->Rank->cellAttributes() ?>>
<?php if ($WorksheetMasters->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Rank" class="form-group">
<input type="text" data-table="WorksheetMasters" data-field="x_Rank" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->Rank->EditValue ?>"<?php echo $WorksheetMasters_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_Rank" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasters_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Rank" class="form-group">
<input type="text" data-table="WorksheetMasters" data-field="x_Rank" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->Rank->EditValue ?>"<?php echo $WorksheetMasters_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_Rank">
<span<?php echo $WorksheetMasters_list->Rank->viewAttributes() ?>><?php echo $WorksheetMasters_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->NumberOfColumns->Visible) { // NumberOfColumns ?>
		<td data-name="NumberOfColumns" <?php echo $WorksheetMasters_list->NumberOfColumns->cellAttributes() ?>>
<?php if ($WorksheetMasters->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_NumberOfColumns" class="form-group">
<input type="text" data-table="WorksheetMasters" data-field="x_NumberOfColumns" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->NumberOfColumns->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->NumberOfColumns->EditValue ?>"<?php echo $WorksheetMasters_list->NumberOfColumns->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_NumberOfColumns" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" value="<?php echo HtmlEncode($WorksheetMasters_list->NumberOfColumns->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_NumberOfColumns" class="form-group">
<input type="text" data-table="WorksheetMasters" data-field="x_NumberOfColumns" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->NumberOfColumns->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->NumberOfColumns->EditValue ?>"<?php echo $WorksheetMasters_list->NumberOfColumns->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_NumberOfColumns">
<span<?php echo $WorksheetMasters_list->NumberOfColumns->viewAttributes() ?>><?php echo $WorksheetMasters_list->NumberOfColumns->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->AllowMultiple->Visible) { // AllowMultiple ?>
		<td data-name="AllowMultiple" <?php echo $WorksheetMasters_list->AllowMultiple->cellAttributes() ?>>
<?php if ($WorksheetMasters->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_AllowMultiple" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasters_list->AllowMultiple->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_AllowMultiple" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]_939560" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_list->AllowMultiple->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]_939560"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_AllowMultiple" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]" value="<?php echo HtmlEncode($WorksheetMasters_list->AllowMultiple->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_AllowMultiple" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasters_list->AllowMultiple->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_AllowMultiple" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]_811228" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_list->AllowMultiple->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]_811228"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_AllowMultiple">
<span<?php echo $WorksheetMasters_list->AllowMultiple->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AllowMultiple" class="custom-control-input" value="<?php echo $WorksheetMasters_list->AllowMultiple->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasters_list->AllowMultiple->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AllowMultiple"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $WorksheetMasters_list->ActiveFlag->cellAttributes() ?>>
<?php if ($WorksheetMasters->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasters_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_ActiveFlag" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]_937030" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]_937030"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_ActiveFlag" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetMasters_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasters_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_ActiveFlag" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]_334191" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]_334191"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetMasters->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasters_list->RowCount ?>_WorksheetMasters_ActiveFlag">
<span<?php echo $WorksheetMasters_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $WorksheetMasters_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasters_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasters_list->ListOptions->render("body", "right", $WorksheetMasters_list->RowCount);
?>
	</tr>
<?php if ($WorksheetMasters->RowType == ROWTYPE_ADD || $WorksheetMasters->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fWorksheetMasterslist", "load"], function() {
	fWorksheetMasterslist.updateLists(<?php echo $WorksheetMasters_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$WorksheetMasters_list->isGridAdd())
		if (!$WorksheetMasters_list->Recordset->EOF)
			$WorksheetMasters_list->Recordset->moveNext();
}
?>
<?php
	if ($WorksheetMasters_list->isGridAdd() || $WorksheetMasters_list->isGridEdit()) {
		$WorksheetMasters_list->RowIndex = '$rowindex$';
		$WorksheetMasters_list->loadRowValues();

		// Set row properties
		$WorksheetMasters->resetAttributes();
		$WorksheetMasters->RowAttrs->merge(["data-rowindex" => $WorksheetMasters_list->RowIndex, "id" => "r0_WorksheetMasters", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetMasters->RowAttrs->appendClass("ew-template");
		$WorksheetMasters->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetMasters_list->renderRow();

		// Render list options
		$WorksheetMasters_list->renderListOptions();
		$WorksheetMasters_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetMasters->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasters_list->ListOptions->render("body", "left", $WorksheetMasters_list->RowIndex);
?>
	<?php if ($WorksheetMasters_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el$rowindex$_WorksheetMasters_WorksheetMaster_Idn" class="form-group WorksheetMasters_WorksheetMaster_Idn"></span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasters_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_WorksheetMasters_Name" class="form-group WorksheetMasters_Name">
<input type="text" data-table="WorksheetMasters" data-field="x_Name" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Name" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->Name->EditValue ?>"<?php echo $WorksheetMasters_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_Name" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_Name" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($WorksheetMasters_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_WorksheetMasters_Department_Idn" class="form-group WorksheetMasters_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasters" data-field="x_Department_Idn" data-value-separator="<?php echo $WorksheetMasters_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn"<?php echo $WorksheetMasters_list->Department_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasters_list->Department_Idn->selectOptionListHtml("x{$WorksheetMasters_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasters_list->Department_Idn->Lookup->getParamTag($WorksheetMasters_list, "p_x" . $WorksheetMasters_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_Department_Idn" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($WorksheetMasters_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_WorksheetMasters_Rank" class="form-group WorksheetMasters_Rank">
<input type="text" data-table="WorksheetMasters" data-field="x_Rank" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->Rank->EditValue ?>"<?php echo $WorksheetMasters_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_Rank" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasters_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->NumberOfColumns->Visible) { // NumberOfColumns ?>
		<td data-name="NumberOfColumns">
<span id="el$rowindex$_WorksheetMasters_NumberOfColumns" class="form-group WorksheetMasters_NumberOfColumns">
<input type="text" data-table="WorksheetMasters" data-field="x_NumberOfColumns" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasters_list->NumberOfColumns->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasters_list->NumberOfColumns->EditValue ?>"<?php echo $WorksheetMasters_list->NumberOfColumns->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_NumberOfColumns" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_NumberOfColumns" value="<?php echo HtmlEncode($WorksheetMasters_list->NumberOfColumns->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->AllowMultiple->Visible) { // AllowMultiple ?>
		<td data-name="AllowMultiple">
<span id="el$rowindex$_WorksheetMasters_AllowMultiple" class="form-group WorksheetMasters_AllowMultiple">
<?php
$selwrk = ConvertToBool($WorksheetMasters_list->AllowMultiple->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_AllowMultiple" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]_376336" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_list->AllowMultiple->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]_376336"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_AllowMultiple" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_AllowMultiple[]" value="<?php echo HtmlEncode($WorksheetMasters_list->AllowMultiple->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasters_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_WorksheetMasters_ActiveFlag" class="form-group WorksheetMasters_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasters_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasters" data-field="x_ActiveFlag" name="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]_684078" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasters_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]_684078"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasters" data-field="x_ActiveFlag" name="o<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetMasters_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetMasters_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasters_list->ListOptions->render("body", "right", $WorksheetMasters_list->RowIndex);
?>
<script>
loadjs.ready(["fWorksheetMasterslist", "load"], function() {
	fWorksheetMasterslist.updateLists(<?php echo $WorksheetMasters_list->RowIndex ?>);
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
<?php if ($WorksheetMasters_list->isAdd() || $WorksheetMasters_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $WorksheetMasters_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasters_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasters_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetMasters_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $WorksheetMasters_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasters_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasters_list->KeyCount ?>">
<?php echo $WorksheetMasters_list->MultiSelectKey ?>
<?php } ?>
<?php if ($WorksheetMasters_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $WorksheetMasters_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasters_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasters_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetMasters_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $WorksheetMasters_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasters_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasters_list->KeyCount ?>">
<?php echo $WorksheetMasters_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$WorksheetMasters->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($WorksheetMasters_list->Recordset)
	$WorksheetMasters_list->Recordset->Close();
?>
<?php if (!$WorksheetMasters_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$WorksheetMasters_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetMasters_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetMasters_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($WorksheetMasters_list->TotalRecords == 0 && !$WorksheetMasters->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $WorksheetMasters_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$WorksheetMasters_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$WorksheetMasters_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$WorksheetMasters->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: true,
		container: "gmp_WorksheetMasters",
		width: "",
		height: ""
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$WorksheetMasters_list->terminate();
?>