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
$v_WorksheetMasterCategories_list = new v_WorksheetMasterCategories_list();

// Run the page
$v_WorksheetMasterCategories_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_WorksheetMasterCategories_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_WorksheetMasterCategories_list->isExport()) { ?>
<script>
var fv_WorksheetMasterCategorieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_WorksheetMasterCategorieslist = currentForm = new ew.Form("fv_WorksheetMasterCategorieslist", "list");
	fv_WorksheetMasterCategorieslist.formKeyCountName = '<?php echo $v_WorksheetMasterCategories_list->FormKeyCountName ?>';
	loadjs.done("fv_WorksheetMasterCategorieslist");
});
var fv_WorksheetMasterCategorieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fv_WorksheetMasterCategorieslistsrch = currentSearchForm = new ew.Form("fv_WorksheetMasterCategorieslistsrch");

	// Dynamic selection lists
	// Filters

	fv_WorksheetMasterCategorieslistsrch.filterList = <?php echo $v_WorksheetMasterCategories_list->getFilterList() ?>;
	loadjs.done("fv_WorksheetMasterCategorieslistsrch");
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
<?php if (!$v_WorksheetMasterCategories_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_WorksheetMasterCategories_list->TotalRecords > 0 && $v_WorksheetMasterCategories_list->ExportOptions->visible()) { ?>
<?php $v_WorksheetMasterCategories_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->ImportOptions->visible()) { ?>
<?php $v_WorksheetMasterCategories_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->SearchOptions->visible()) { ?>
<?php $v_WorksheetMasterCategories_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->FilterOptions->visible()) { ?>
<?php $v_WorksheetMasterCategories_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_WorksheetMasterCategories_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_WorksheetMasterCategories_list->isExport() && !$v_WorksheetMasterCategories->CurrentAction) { ?>
<form name="fv_WorksheetMasterCategorieslistsrch" id="fv_WorksheetMasterCategorieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fv_WorksheetMasterCategorieslistsrch-search-panel" class="<?php echo $v_WorksheetMasterCategories_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_WorksheetMasterCategories">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $v_WorksheetMasterCategories_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($v_WorksheetMasterCategories_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($v_WorksheetMasterCategories_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_WorksheetMasterCategories_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_WorksheetMasterCategories_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_WorksheetMasterCategories_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_WorksheetMasterCategories_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_WorksheetMasterCategories_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $v_WorksheetMasterCategories_list->showPageHeader(); ?>
<?php
$v_WorksheetMasterCategories_list->showMessage();
?>
<?php if ($v_WorksheetMasterCategories_list->TotalRecords > 0 || $v_WorksheetMasterCategories->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_WorksheetMasterCategories_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_WorksheetMasterCategories">
<?php if (!$v_WorksheetMasterCategories_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$v_WorksheetMasterCategories_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_WorksheetMasterCategories_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_WorksheetMasterCategories_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fv_WorksheetMasterCategorieslist" id="fv_WorksheetMasterCategorieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_WorksheetMasterCategories">
<div id="gmp_v_WorksheetMasterCategories" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_WorksheetMasterCategories_list->TotalRecords > 0 || $v_WorksheetMasterCategories_list->isGridEdit()) { ?>
<table id="tbl_v_WorksheetMasterCategorieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_WorksheetMasterCategories->RowType = ROWTYPE_HEADER;

// Render list options
$v_WorksheetMasterCategories_list->renderListOptions();

// Render list options (header, left)
$v_WorksheetMasterCategories_list->ListOptions->render("header", "left");
?>
<?php if ($v_WorksheetMasterCategories_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $v_WorksheetMasterCategories_list->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_WorksheetMaster_Idn" class="v_WorksheetMasterCategories_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $v_WorksheetMasterCategories_list->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->WorksheetMaster_Idn) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_WorksheetMaster_Idn" class="v_WorksheetMasterCategories_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->WorksheetCategory_Idn) == "") { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $v_WorksheetMasterCategories_list->WorksheetCategory_Idn->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_WorksheetCategory_Idn" class="v_WorksheetMasterCategories_WorksheetCategory_Idn"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->WorksheetCategory_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $v_WorksheetMasterCategories_list->WorksheetCategory_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->WorksheetCategory_Idn) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_WorksheetCategory_Idn" class="v_WorksheetMasterCategories_WorksheetCategory_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->WorksheetCategory_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->WorksheetCategory_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->WorksheetCategory_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->Rank->Visible) { // Rank ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $v_WorksheetMasterCategories_list->Rank->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_Rank" class="v_WorksheetMasterCategories_Rank"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $v_WorksheetMasterCategories_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->Rank) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_Rank" class="v_WorksheetMasterCategories_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->AutoLoadFlag) == "") { ?>
		<th data-name="AutoLoadFlag" class="<?php echo $v_WorksheetMasterCategories_list->AutoLoadFlag->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_AutoLoadFlag" class="v_WorksheetMasterCategories_AutoLoadFlag"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->AutoLoadFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AutoLoadFlag" class="<?php echo $v_WorksheetMasterCategories_list->AutoLoadFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->AutoLoadFlag) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_AutoLoadFlag" class="v_WorksheetMasterCategories_AutoLoadFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->AutoLoadFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->AutoLoadFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->AutoLoadFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->LoadFlag->Visible) { // LoadFlag ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->LoadFlag) == "") { ?>
		<th data-name="LoadFlag" class="<?php echo $v_WorksheetMasterCategories_list->LoadFlag->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_LoadFlag" class="v_WorksheetMasterCategories_LoadFlag"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->LoadFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LoadFlag" class="<?php echo $v_WorksheetMasterCategories_list->LoadFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->LoadFlag) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_LoadFlag" class="v_WorksheetMasterCategories_LoadFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->LoadFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->LoadFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->LoadFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->AddMiscFlag->Visible) { // AddMiscFlag ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->AddMiscFlag) == "") { ?>
		<th data-name="AddMiscFlag" class="<?php echo $v_WorksheetMasterCategories_list->AddMiscFlag->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_AddMiscFlag" class="v_WorksheetMasterCategories_AddMiscFlag"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->AddMiscFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AddMiscFlag" class="<?php echo $v_WorksheetMasterCategories_list->AddMiscFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->AddMiscFlag) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_AddMiscFlag" class="v_WorksheetMasterCategories_AddMiscFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->AddMiscFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->AddMiscFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->AddMiscFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn) == "") { ?>
		<th data-name="ChildWorksheetMaster_Idn" class="<?php echo $v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="v_WorksheetMasterCategories_ChildWorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChildWorksheetMaster_Idn" class="<?php echo $v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="v_WorksheetMasterCategories_ChildWorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $v_WorksheetMasterCategories_list->Department_Idn->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_Department_Idn" class="v_WorksheetMasterCategories_Department_Idn"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $v_WorksheetMasterCategories_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->Department_Idn) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_Department_Idn" class="v_WorksheetMasterCategories_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->Name->Visible) { // Name ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $v_WorksheetMasterCategories_list->Name->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_Name" class="v_WorksheetMasterCategories_Name"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $v_WorksheetMasterCategories_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->Name) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_Name" class="v_WorksheetMasterCategories_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->ShortName->Visible) { // ShortName ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->ShortName) == "") { ?>
		<th data-name="ShortName" class="<?php echo $v_WorksheetMasterCategories_list->ShortName->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_ShortName" class="v_WorksheetMasterCategories_ShortName"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->ShortName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShortName" class="<?php echo $v_WorksheetMasterCategories_list->ShortName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->ShortName) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_ShortName" class="v_WorksheetMasterCategories_ShortName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->ShortName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->ShortName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->ShortName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->FieldUnitPrice) == "") { ?>
		<th data-name="FieldUnitPrice" class="<?php echo $v_WorksheetMasterCategories_list->FieldUnitPrice->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_FieldUnitPrice" class="v_WorksheetMasterCategories_FieldUnitPrice"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->FieldUnitPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FieldUnitPrice" class="<?php echo $v_WorksheetMasterCategories_list->FieldUnitPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->FieldUnitPrice) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_FieldUnitPrice" class="v_WorksheetMasterCategories_FieldUnitPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->FieldUnitPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->FieldUnitPrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->FieldUnitPrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->IsFitting->Visible) { // IsFitting ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->IsFitting) == "") { ?>
		<th data-name="IsFitting" class="<?php echo $v_WorksheetMasterCategories_list->IsFitting->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_IsFitting" class="v_WorksheetMasterCategories_IsFitting"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->IsFitting->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsFitting" class="<?php echo $v_WorksheetMasterCategories_list->IsFitting->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->IsFitting) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_IsFitting" class="v_WorksheetMasterCategories_IsFitting">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->IsFitting->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->IsFitting->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->IsFitting->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->CartFlag->Visible) { // CartFlag ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->CartFlag) == "") { ?>
		<th data-name="CartFlag" class="<?php echo $v_WorksheetMasterCategories_list->CartFlag->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_CartFlag" class="v_WorksheetMasterCategories_CartFlag"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->CartFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CartFlag" class="<?php echo $v_WorksheetMasterCategories_list->CartFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->CartFlag) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_CartFlag" class="v_WorksheetMasterCategories_CartFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->CartFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->CartFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->CartFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->IsShared->Visible) { // IsShared ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->IsShared) == "") { ?>
		<th data-name="IsShared" class="<?php echo $v_WorksheetMasterCategories_list->IsShared->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_IsShared" class="v_WorksheetMasterCategories_IsShared"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->IsShared->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsShared" class="<?php echo $v_WorksheetMasterCategories_list->IsShared->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->IsShared) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_IsShared" class="v_WorksheetMasterCategories_IsShared">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->IsShared->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->IsShared->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->IsShared->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->IsAssembly->Visible) { // IsAssembly ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->IsAssembly) == "") { ?>
		<th data-name="IsAssembly" class="<?php echo $v_WorksheetMasterCategories_list->IsAssembly->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_IsAssembly" class="v_WorksheetMasterCategories_IsAssembly"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->IsAssembly->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsAssembly" class="<?php echo $v_WorksheetMasterCategories_list->IsAssembly->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->IsAssembly) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_IsAssembly" class="v_WorksheetMasterCategories_IsAssembly">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->IsAssembly->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->IsAssembly->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->IsAssembly->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $v_WorksheetMasterCategories_list->ActiveFlag->headerCellClass() ?>"><div id="elh_v_WorksheetMasterCategories_ActiveFlag" class="v_WorksheetMasterCategories_ActiveFlag"><div class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $v_WorksheetMasterCategories_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_WorksheetMasterCategories_list->SortUrl($v_WorksheetMasterCategories_list->ActiveFlag) ?>', 1);"><div id="elh_v_WorksheetMasterCategories_ActiveFlag" class="v_WorksheetMasterCategories_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_WorksheetMasterCategories_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_WorksheetMasterCategories_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_WorksheetMasterCategories_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_WorksheetMasterCategories_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_WorksheetMasterCategories_list->ExportAll && $v_WorksheetMasterCategories_list->isExport()) {
	$v_WorksheetMasterCategories_list->StopRecord = $v_WorksheetMasterCategories_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_WorksheetMasterCategories_list->TotalRecords > $v_WorksheetMasterCategories_list->StartRecord + $v_WorksheetMasterCategories_list->DisplayRecords - 1)
		$v_WorksheetMasterCategories_list->StopRecord = $v_WorksheetMasterCategories_list->StartRecord + $v_WorksheetMasterCategories_list->DisplayRecords - 1;
	else
		$v_WorksheetMasterCategories_list->StopRecord = $v_WorksheetMasterCategories_list->TotalRecords;
}
$v_WorksheetMasterCategories_list->RecordCount = $v_WorksheetMasterCategories_list->StartRecord - 1;
if ($v_WorksheetMasterCategories_list->Recordset && !$v_WorksheetMasterCategories_list->Recordset->EOF) {
	$v_WorksheetMasterCategories_list->Recordset->moveFirst();
	$selectLimit = $v_WorksheetMasterCategories_list->UseSelectLimit;
	if (!$selectLimit && $v_WorksheetMasterCategories_list->StartRecord > 1)
		$v_WorksheetMasterCategories_list->Recordset->move($v_WorksheetMasterCategories_list->StartRecord - 1);
} elseif (!$v_WorksheetMasterCategories->AllowAddDeleteRow && $v_WorksheetMasterCategories_list->StopRecord == 0) {
	$v_WorksheetMasterCategories_list->StopRecord = $v_WorksheetMasterCategories->GridAddRowCount;
}

// Initialize aggregate
$v_WorksheetMasterCategories->RowType = ROWTYPE_AGGREGATEINIT;
$v_WorksheetMasterCategories->resetAttributes();
$v_WorksheetMasterCategories_list->renderRow();
while ($v_WorksheetMasterCategories_list->RecordCount < $v_WorksheetMasterCategories_list->StopRecord) {
	$v_WorksheetMasterCategories_list->RecordCount++;
	if ($v_WorksheetMasterCategories_list->RecordCount >= $v_WorksheetMasterCategories_list->StartRecord) {
		$v_WorksheetMasterCategories_list->RowCount++;

		// Set up key count
		$v_WorksheetMasterCategories_list->KeyCount = $v_WorksheetMasterCategories_list->RowIndex;

		// Init row class and style
		$v_WorksheetMasterCategories->resetAttributes();
		$v_WorksheetMasterCategories->CssClass = "";
		if ($v_WorksheetMasterCategories_list->isGridAdd()) {
		} else {
			$v_WorksheetMasterCategories_list->loadRowValues($v_WorksheetMasterCategories_list->Recordset); // Load row values
		}
		$v_WorksheetMasterCategories->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_WorksheetMasterCategories->RowAttrs->merge(["data-rowindex" => $v_WorksheetMasterCategories_list->RowCount, "id" => "r" . $v_WorksheetMasterCategories_list->RowCount . "_v_WorksheetMasterCategories", "data-rowtype" => $v_WorksheetMasterCategories->RowType]);

		// Render row
		$v_WorksheetMasterCategories_list->renderRow();

		// Render list options
		$v_WorksheetMasterCategories_list->renderListOptions();
?>
	<tr <?php echo $v_WorksheetMasterCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_WorksheetMasterCategories_list->ListOptions->render("body", "left", $v_WorksheetMasterCategories_list->RowCount);
?>
	<?php if ($v_WorksheetMasterCategories_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $v_WorksheetMasterCategories_list->WorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_WorksheetMaster_Idn">
<span<?php echo $v_WorksheetMasterCategories_list->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $v_WorksheetMasterCategories_list->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn" <?php echo $v_WorksheetMasterCategories_list->WorksheetCategory_Idn->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_WorksheetCategory_Idn">
<span<?php echo $v_WorksheetMasterCategories_list->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $v_WorksheetMasterCategories_list->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $v_WorksheetMasterCategories_list->Rank->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_Rank">
<span<?php echo $v_WorksheetMasterCategories_list->Rank->viewAttributes() ?>><?php echo $v_WorksheetMasterCategories_list->Rank->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<td data-name="AutoLoadFlag" <?php echo $v_WorksheetMasterCategories_list->AutoLoadFlag->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_AutoLoadFlag">
<span<?php echo $v_WorksheetMasterCategories_list->AutoLoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AutoLoadFlag" class="custom-control-input" value="<?php echo $v_WorksheetMasterCategories_list->AutoLoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($v_WorksheetMasterCategories_list->AutoLoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AutoLoadFlag"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->LoadFlag->Visible) { // LoadFlag ?>
		<td data-name="LoadFlag" <?php echo $v_WorksheetMasterCategories_list->LoadFlag->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_LoadFlag">
<span<?php echo $v_WorksheetMasterCategories_list->LoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LoadFlag" class="custom-control-input" value="<?php echo $v_WorksheetMasterCategories_list->LoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($v_WorksheetMasterCategories_list->LoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LoadFlag"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->AddMiscFlag->Visible) { // AddMiscFlag ?>
		<td data-name="AddMiscFlag" <?php echo $v_WorksheetMasterCategories_list->AddMiscFlag->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_AddMiscFlag">
<span<?php echo $v_WorksheetMasterCategories_list->AddMiscFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AddMiscFlag" class="custom-control-input" value="<?php echo $v_WorksheetMasterCategories_list->AddMiscFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($v_WorksheetMasterCategories_list->AddMiscFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AddMiscFlag"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
		<td data-name="ChildWorksheetMaster_Idn" <?php echo $v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_ChildWorksheetMaster_Idn">
<span<?php echo $v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->viewAttributes() ?>><?php echo $v_WorksheetMasterCategories_list->ChildWorksheetMaster_Idn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $v_WorksheetMasterCategories_list->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_Department_Idn">
<span<?php echo $v_WorksheetMasterCategories_list->Department_Idn->viewAttributes() ?>><?php echo $v_WorksheetMasterCategories_list->Department_Idn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $v_WorksheetMasterCategories_list->Name->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_Name">
<span<?php echo $v_WorksheetMasterCategories_list->Name->viewAttributes() ?>><?php echo $v_WorksheetMasterCategories_list->Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName" <?php echo $v_WorksheetMasterCategories_list->ShortName->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_ShortName">
<span<?php echo $v_WorksheetMasterCategories_list->ShortName->viewAttributes() ?>><?php echo $v_WorksheetMasterCategories_list->ShortName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->FieldUnitPrice->Visible) { // FieldUnitPrice ?>
		<td data-name="FieldUnitPrice" <?php echo $v_WorksheetMasterCategories_list->FieldUnitPrice->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_FieldUnitPrice">
<span<?php echo $v_WorksheetMasterCategories_list->FieldUnitPrice->viewAttributes() ?>><?php echo $v_WorksheetMasterCategories_list->FieldUnitPrice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->IsFitting->Visible) { // IsFitting ?>
		<td data-name="IsFitting" <?php echo $v_WorksheetMasterCategories_list->IsFitting->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_IsFitting">
<span<?php echo $v_WorksheetMasterCategories_list->IsFitting->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsFitting" class="custom-control-input" value="<?php echo $v_WorksheetMasterCategories_list->IsFitting->getViewValue() ?>" disabled<?php if (ConvertToBool($v_WorksheetMasterCategories_list->IsFitting->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsFitting"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->CartFlag->Visible) { // CartFlag ?>
		<td data-name="CartFlag" <?php echo $v_WorksheetMasterCategories_list->CartFlag->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_CartFlag">
<span<?php echo $v_WorksheetMasterCategories_list->CartFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CartFlag" class="custom-control-input" value="<?php echo $v_WorksheetMasterCategories_list->CartFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($v_WorksheetMasterCategories_list->CartFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CartFlag"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->IsShared->Visible) { // IsShared ?>
		<td data-name="IsShared" <?php echo $v_WorksheetMasterCategories_list->IsShared->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_IsShared">
<span<?php echo $v_WorksheetMasterCategories_list->IsShared->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsShared" class="custom-control-input" value="<?php echo $v_WorksheetMasterCategories_list->IsShared->getViewValue() ?>" disabled<?php if (ConvertToBool($v_WorksheetMasterCategories_list->IsShared->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsShared"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->IsAssembly->Visible) { // IsAssembly ?>
		<td data-name="IsAssembly" <?php echo $v_WorksheetMasterCategories_list->IsAssembly->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_IsAssembly">
<span<?php echo $v_WorksheetMasterCategories_list->IsAssembly->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsAssembly" class="custom-control-input" value="<?php echo $v_WorksheetMasterCategories_list->IsAssembly->getViewValue() ?>" disabled<?php if (ConvertToBool($v_WorksheetMasterCategories_list->IsAssembly->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsAssembly"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_WorksheetMasterCategories_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $v_WorksheetMasterCategories_list->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $v_WorksheetMasterCategories_list->RowCount ?>_v_WorksheetMasterCategories_ActiveFlag">
<span<?php echo $v_WorksheetMasterCategories_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $v_WorksheetMasterCategories_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($v_WorksheetMasterCategories_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_WorksheetMasterCategories_list->ListOptions->render("body", "right", $v_WorksheetMasterCategories_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_WorksheetMasterCategories_list->isGridAdd())
		$v_WorksheetMasterCategories_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_WorksheetMasterCategories->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_WorksheetMasterCategories_list->Recordset)
	$v_WorksheetMasterCategories_list->Recordset->Close();
?>
<?php if (!$v_WorksheetMasterCategories_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_WorksheetMasterCategories_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_WorksheetMasterCategories_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_WorksheetMasterCategories_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_WorksheetMasterCategories_list->TotalRecords == 0 && !$v_WorksheetMasterCategories->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_WorksheetMasterCategories_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_WorksheetMasterCategories_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_WorksheetMasterCategories_list->isExport()) { ?>
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
$v_WorksheetMasterCategories_list->terminate();
?>