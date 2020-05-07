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
$v_Administrators_list = new v_Administrators_list();

// Run the page
$v_Administrators_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_Administrators_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_Administrators_list->isExport()) { ?>
<script>
var fv_Administratorslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_Administratorslist = currentForm = new ew.Form("fv_Administratorslist", "list");
	fv_Administratorslist.formKeyCountName = '<?php echo $v_Administrators_list->FormKeyCountName ?>';
	loadjs.done("fv_Administratorslist");
});
var fv_Administratorslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fv_Administratorslistsrch = currentSearchForm = new ew.Form("fv_Administratorslistsrch");

	// Dynamic selection lists
	// Filters

	fv_Administratorslistsrch.filterList = <?php echo $v_Administrators_list->getFilterList() ?>;
	loadjs.done("fv_Administratorslistsrch");
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
	ew.PREVIEW_OVERLAY = false;
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
<?php if (!$v_Administrators_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_Administrators_list->TotalRecords > 0 && $v_Administrators_list->ExportOptions->visible()) { ?>
<?php $v_Administrators_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_Administrators_list->ImportOptions->visible()) { ?>
<?php $v_Administrators_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_Administrators_list->SearchOptions->visible()) { ?>
<?php $v_Administrators_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_Administrators_list->FilterOptions->visible()) { ?>
<?php $v_Administrators_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_Administrators_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_Administrators_list->isExport() && !$v_Administrators->CurrentAction) { ?>
<form name="fv_Administratorslistsrch" id="fv_Administratorslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fv_Administratorslistsrch-search-panel" class="<?php echo $v_Administrators_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_Administrators">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $v_Administrators_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($v_Administrators_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($v_Administrators_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_Administrators_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_Administrators_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_Administrators_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_Administrators_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_Administrators_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $v_Administrators_list->showPageHeader(); ?>
<?php
$v_Administrators_list->showMessage();
?>
<?php if ($v_Administrators_list->TotalRecords > 0 || $v_Administrators->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_Administrators_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_Administrators">
<?php if (!$v_Administrators_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$v_Administrators_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_Administrators_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_Administrators_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fv_Administratorslist" id="fv_Administratorslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_Administrators">
<div id="gmp_v_Administrators" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_Administrators_list->TotalRecords > 0 || $v_Administrators_list->isGridEdit()) { ?>
<table id="tbl_v_Administratorslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_Administrators->RowType = ROWTYPE_HEADER;

// Render list options
$v_Administrators_list->renderListOptions();

// Render list options (header, left)
$v_Administrators_list->ListOptions->render("header", "left");
?>
<?php if ($v_Administrators_list->User_Idn->Visible) { // User_Idn ?>
	<?php if ($v_Administrators_list->SortUrl($v_Administrators_list->User_Idn) == "") { ?>
		<th data-name="User_Idn" class="<?php echo $v_Administrators_list->User_Idn->headerCellClass() ?>"><div id="elh_v_Administrators_User_Idn" class="v_Administrators_User_Idn"><div class="ew-table-header-caption"><?php echo $v_Administrators_list->User_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="User_Idn" class="<?php echo $v_Administrators_list->User_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_Administrators_list->SortUrl($v_Administrators_list->User_Idn) ?>', 1);"><div id="elh_v_Administrators_User_Idn" class="v_Administrators_User_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_Administrators_list->User_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_Administrators_list->User_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_Administrators_list->User_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_Administrators_list->FirstName->Visible) { // FirstName ?>
	<?php if ($v_Administrators_list->SortUrl($v_Administrators_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $v_Administrators_list->FirstName->headerCellClass() ?>"><div id="elh_v_Administrators_FirstName" class="v_Administrators_FirstName"><div class="ew-table-header-caption"><?php echo $v_Administrators_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $v_Administrators_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_Administrators_list->SortUrl($v_Administrators_list->FirstName) ?>', 1);"><div id="elh_v_Administrators_FirstName" class="v_Administrators_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_Administrators_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_Administrators_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_Administrators_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_Administrators_list->LastName->Visible) { // LastName ?>
	<?php if ($v_Administrators_list->SortUrl($v_Administrators_list->LastName) == "") { ?>
		<th data-name="LastName" class="<?php echo $v_Administrators_list->LastName->headerCellClass() ?>"><div id="elh_v_Administrators_LastName" class="v_Administrators_LastName"><div class="ew-table-header-caption"><?php echo $v_Administrators_list->LastName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastName" class="<?php echo $v_Administrators_list->LastName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_Administrators_list->SortUrl($v_Administrators_list->LastName) ?>', 1);"><div id="elh_v_Administrators_LastName" class="v_Administrators_LastName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_Administrators_list->LastName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_Administrators_list->LastName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_Administrators_list->LastName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_Administrators_list->UserName->Visible) { // UserName ?>
	<?php if ($v_Administrators_list->SortUrl($v_Administrators_list->UserName) == "") { ?>
		<th data-name="UserName" class="<?php echo $v_Administrators_list->UserName->headerCellClass() ?>"><div id="elh_v_Administrators_UserName" class="v_Administrators_UserName"><div class="ew-table-header-caption"><?php echo $v_Administrators_list->UserName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserName" class="<?php echo $v_Administrators_list->UserName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_Administrators_list->SortUrl($v_Administrators_list->UserName) ?>', 1);"><div id="elh_v_Administrators_UserName" class="v_Administrators_UserName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_Administrators_list->UserName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_Administrators_list->UserName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_Administrators_list->UserName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_Administrators_list->_Email->Visible) { // Email ?>
	<?php if ($v_Administrators_list->SortUrl($v_Administrators_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $v_Administrators_list->_Email->headerCellClass() ?>"><div id="elh_v_Administrators__Email" class="v_Administrators__Email"><div class="ew-table-header-caption"><?php echo $v_Administrators_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $v_Administrators_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_Administrators_list->SortUrl($v_Administrators_list->_Email) ?>', 1);"><div id="elh_v_Administrators__Email" class="v_Administrators__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_Administrators_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_Administrators_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_Administrators_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_Administrators_list->Password->Visible) { // Password ?>
	<?php if ($v_Administrators_list->SortUrl($v_Administrators_list->Password) == "") { ?>
		<th data-name="Password" class="<?php echo $v_Administrators_list->Password->headerCellClass() ?>"><div id="elh_v_Administrators_Password" class="v_Administrators_Password"><div class="ew-table-header-caption"><?php echo $v_Administrators_list->Password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Password" class="<?php echo $v_Administrators_list->Password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_Administrators_list->SortUrl($v_Administrators_list->Password) ?>', 1);"><div id="elh_v_Administrators_Password" class="v_Administrators_Password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_Administrators_list->Password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_Administrators_list->Password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_Administrators_list->Password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_Administrators_list->IsContractor->Visible) { // IsContractor ?>
	<?php if ($v_Administrators_list->SortUrl($v_Administrators_list->IsContractor) == "") { ?>
		<th data-name="IsContractor" class="<?php echo $v_Administrators_list->IsContractor->headerCellClass() ?>"><div id="elh_v_Administrators_IsContractor" class="v_Administrators_IsContractor"><div class="ew-table-header-caption"><?php echo $v_Administrators_list->IsContractor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsContractor" class="<?php echo $v_Administrators_list->IsContractor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_Administrators_list->SortUrl($v_Administrators_list->IsContractor) ?>', 1);"><div id="elh_v_Administrators_IsContractor" class="v_Administrators_IsContractor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_Administrators_list->IsContractor->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_Administrators_list->IsContractor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_Administrators_list->IsContractor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_Administrators_list->IsAdmin->Visible) { // IsAdmin ?>
	<?php if ($v_Administrators_list->SortUrl($v_Administrators_list->IsAdmin) == "") { ?>
		<th data-name="IsAdmin" class="<?php echo $v_Administrators_list->IsAdmin->headerCellClass() ?>"><div id="elh_v_Administrators_IsAdmin" class="v_Administrators_IsAdmin"><div class="ew-table-header-caption"><?php echo $v_Administrators_list->IsAdmin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsAdmin" class="<?php echo $v_Administrators_list->IsAdmin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_Administrators_list->SortUrl($v_Administrators_list->IsAdmin) ?>', 1);"><div id="elh_v_Administrators_IsAdmin" class="v_Administrators_IsAdmin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_Administrators_list->IsAdmin->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_Administrators_list->IsAdmin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_Administrators_list->IsAdmin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_Administrators_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($v_Administrators_list->SortUrl($v_Administrators_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $v_Administrators_list->Department_Idn->headerCellClass() ?>"><div id="elh_v_Administrators_Department_Idn" class="v_Administrators_Department_Idn"><div class="ew-table-header-caption"><?php echo $v_Administrators_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $v_Administrators_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_Administrators_list->SortUrl($v_Administrators_list->Department_Idn) ?>', 1);"><div id="elh_v_Administrators_Department_Idn" class="v_Administrators_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_Administrators_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_Administrators_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_Administrators_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_Administrators_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($v_Administrators_list->SortUrl($v_Administrators_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $v_Administrators_list->ActiveFlag->headerCellClass() ?>"><div id="elh_v_Administrators_ActiveFlag" class="v_Administrators_ActiveFlag"><div class="ew-table-header-caption"><?php echo $v_Administrators_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $v_Administrators_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_Administrators_list->SortUrl($v_Administrators_list->ActiveFlag) ?>', 1);"><div id="elh_v_Administrators_ActiveFlag" class="v_Administrators_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_Administrators_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_Administrators_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_Administrators_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_Administrators_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_Administrators_list->ExportAll && $v_Administrators_list->isExport()) {
	$v_Administrators_list->StopRecord = $v_Administrators_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_Administrators_list->TotalRecords > $v_Administrators_list->StartRecord + $v_Administrators_list->DisplayRecords - 1)
		$v_Administrators_list->StopRecord = $v_Administrators_list->StartRecord + $v_Administrators_list->DisplayRecords - 1;
	else
		$v_Administrators_list->StopRecord = $v_Administrators_list->TotalRecords;
}
$v_Administrators_list->RecordCount = $v_Administrators_list->StartRecord - 1;
if ($v_Administrators_list->Recordset && !$v_Administrators_list->Recordset->EOF) {
	$v_Administrators_list->Recordset->moveFirst();
	$selectLimit = $v_Administrators_list->UseSelectLimit;
	if (!$selectLimit && $v_Administrators_list->StartRecord > 1)
		$v_Administrators_list->Recordset->move($v_Administrators_list->StartRecord - 1);
} elseif (!$v_Administrators->AllowAddDeleteRow && $v_Administrators_list->StopRecord == 0) {
	$v_Administrators_list->StopRecord = $v_Administrators->GridAddRowCount;
}

// Initialize aggregate
$v_Administrators->RowType = ROWTYPE_AGGREGATEINIT;
$v_Administrators->resetAttributes();
$v_Administrators_list->renderRow();
while ($v_Administrators_list->RecordCount < $v_Administrators_list->StopRecord) {
	$v_Administrators_list->RecordCount++;
	if ($v_Administrators_list->RecordCount >= $v_Administrators_list->StartRecord) {
		$v_Administrators_list->RowCount++;

		// Set up key count
		$v_Administrators_list->KeyCount = $v_Administrators_list->RowIndex;

		// Init row class and style
		$v_Administrators->resetAttributes();
		$v_Administrators->CssClass = "";
		if ($v_Administrators_list->isGridAdd()) {
		} else {
			$v_Administrators_list->loadRowValues($v_Administrators_list->Recordset); // Load row values
		}
		$v_Administrators->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_Administrators->RowAttrs->merge(["data-rowindex" => $v_Administrators_list->RowCount, "id" => "r" . $v_Administrators_list->RowCount . "_v_Administrators", "data-rowtype" => $v_Administrators->RowType]);

		// Render row
		$v_Administrators_list->renderRow();

		// Render list options
		$v_Administrators_list->renderListOptions();
?>
	<tr <?php echo $v_Administrators->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_Administrators_list->ListOptions->render("body", "left", $v_Administrators_list->RowCount);
?>
	<?php if ($v_Administrators_list->User_Idn->Visible) { // User_Idn ?>
		<td data-name="User_Idn" <?php echo $v_Administrators_list->User_Idn->cellAttributes() ?>>
<span id="el<?php echo $v_Administrators_list->RowCount ?>_v_Administrators_User_Idn">
<span<?php echo $v_Administrators_list->User_Idn->viewAttributes() ?>><?php echo $v_Administrators_list->User_Idn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_Administrators_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $v_Administrators_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $v_Administrators_list->RowCount ?>_v_Administrators_FirstName">
<span<?php echo $v_Administrators_list->FirstName->viewAttributes() ?>><?php echo $v_Administrators_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_Administrators_list->LastName->Visible) { // LastName ?>
		<td data-name="LastName" <?php echo $v_Administrators_list->LastName->cellAttributes() ?>>
<span id="el<?php echo $v_Administrators_list->RowCount ?>_v_Administrators_LastName">
<span<?php echo $v_Administrators_list->LastName->viewAttributes() ?>><?php echo $v_Administrators_list->LastName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_Administrators_list->UserName->Visible) { // UserName ?>
		<td data-name="UserName" <?php echo $v_Administrators_list->UserName->cellAttributes() ?>>
<span id="el<?php echo $v_Administrators_list->RowCount ?>_v_Administrators_UserName">
<span<?php echo $v_Administrators_list->UserName->viewAttributes() ?>><?php echo $v_Administrators_list->UserName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_Administrators_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $v_Administrators_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $v_Administrators_list->RowCount ?>_v_Administrators__Email">
<span<?php echo $v_Administrators_list->_Email->viewAttributes() ?>><?php echo $v_Administrators_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_Administrators_list->Password->Visible) { // Password ?>
		<td data-name="Password" <?php echo $v_Administrators_list->Password->cellAttributes() ?>>
<span id="el<?php echo $v_Administrators_list->RowCount ?>_v_Administrators_Password">
<span<?php echo $v_Administrators_list->Password->viewAttributes() ?>><?php echo $v_Administrators_list->Password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_Administrators_list->IsContractor->Visible) { // IsContractor ?>
		<td data-name="IsContractor" <?php echo $v_Administrators_list->IsContractor->cellAttributes() ?>>
<span id="el<?php echo $v_Administrators_list->RowCount ?>_v_Administrators_IsContractor">
<span<?php echo $v_Administrators_list->IsContractor->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsContractor" class="custom-control-input" value="<?php echo $v_Administrators_list->IsContractor->getViewValue() ?>" disabled<?php if (ConvertToBool($v_Administrators_list->IsContractor->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsContractor"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_Administrators_list->IsAdmin->Visible) { // IsAdmin ?>
		<td data-name="IsAdmin" <?php echo $v_Administrators_list->IsAdmin->cellAttributes() ?>>
<span id="el<?php echo $v_Administrators_list->RowCount ?>_v_Administrators_IsAdmin">
<span<?php echo $v_Administrators_list->IsAdmin->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsAdmin" class="custom-control-input" value="<?php echo $v_Administrators_list->IsAdmin->getViewValue() ?>" disabled<?php if (ConvertToBool($v_Administrators_list->IsAdmin->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsAdmin"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_Administrators_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $v_Administrators_list->Department_Idn->cellAttributes() ?>>
<span id="el<?php echo $v_Administrators_list->RowCount ?>_v_Administrators_Department_Idn">
<span<?php echo $v_Administrators_list->Department_Idn->viewAttributes() ?>><?php echo $v_Administrators_list->Department_Idn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_Administrators_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $v_Administrators_list->ActiveFlag->cellAttributes() ?>>
<span id="el<?php echo $v_Administrators_list->RowCount ?>_v_Administrators_ActiveFlag">
<span<?php echo $v_Administrators_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $v_Administrators_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($v_Administrators_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_Administrators_list->ListOptions->render("body", "right", $v_Administrators_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_Administrators_list->isGridAdd())
		$v_Administrators_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_Administrators->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_Administrators_list->Recordset)
	$v_Administrators_list->Recordset->Close();
?>
<?php if (!$v_Administrators_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_Administrators_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_Administrators_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_Administrators_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_Administrators_list->TotalRecords == 0 && !$v_Administrators->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_Administrators_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_Administrators_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_Administrators_list->isExport()) { ?>
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
$v_Administrators_list->terminate();
?>