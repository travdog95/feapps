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
$jpr_Department_list = new jpr_Department_list();

// Run the page
$jpr_Department_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jpr_Department_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jpr_Department_list->isExport()) { ?>
<script>
var fjpr_Departmentlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fjpr_Departmentlist = currentForm = new ew.Form("fjpr_Departmentlist", "list");
	fjpr_Departmentlist.formKeyCountName = '<?php echo $jpr_Department_list->FormKeyCountName ?>';

	// Validate form
	fjpr_Departmentlist.validate = function() {
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
			<?php if ($jpr_Department_list->DepartmentId->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jpr_Department_list->DepartmentId->caption(), $jpr_Department_list->DepartmentId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jpr_Department_list->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jpr_Department_list->Description->caption(), $jpr_Department_list->Description->RequiredErrorMessage)) ?>");
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
	fjpr_Departmentlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Description", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fjpr_Departmentlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjpr_Departmentlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fjpr_Departmentlist");
});
var fjpr_Departmentlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fjpr_Departmentlistsrch = currentSearchForm = new ew.Form("fjpr_Departmentlistsrch");

	// Dynamic selection lists
	// Filters

	fjpr_Departmentlistsrch.filterList = <?php echo $jpr_Department_list->getFilterList() ?>;
	loadjs.done("fjpr_Departmentlistsrch");
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
<?php if (!$jpr_Department_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($jpr_Department_list->TotalRecords > 0 && $jpr_Department_list->ExportOptions->visible()) { ?>
<?php $jpr_Department_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($jpr_Department_list->ImportOptions->visible()) { ?>
<?php $jpr_Department_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($jpr_Department_list->SearchOptions->visible()) { ?>
<?php $jpr_Department_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($jpr_Department_list->FilterOptions->visible()) { ?>
<?php $jpr_Department_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$jpr_Department_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$jpr_Department_list->isExport() && !$jpr_Department->CurrentAction) { ?>
<form name="fjpr_Departmentlistsrch" id="fjpr_Departmentlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fjpr_Departmentlistsrch-search-panel" class="<?php echo $jpr_Department_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="jpr_Department">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $jpr_Department_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($jpr_Department_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($jpr_Department_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $jpr_Department_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($jpr_Department_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($jpr_Department_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($jpr_Department_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($jpr_Department_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $jpr_Department_list->showPageHeader(); ?>
<?php
$jpr_Department_list->showMessage();
?>
<?php if ($jpr_Department_list->TotalRecords > 0 || $jpr_Department->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($jpr_Department_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> jpr_Department">
<?php if (!$jpr_Department_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$jpr_Department_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jpr_Department_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jpr_Department_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fjpr_Departmentlist" id="fjpr_Departmentlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jpr_Department">
<div id="gmp_jpr_Department" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($jpr_Department_list->TotalRecords > 0 || $jpr_Department_list->isAdd() || $jpr_Department_list->isCopy() || $jpr_Department_list->isGridEdit()) { ?>
<table id="tbl_jpr_Departmentlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$jpr_Department->RowType = ROWTYPE_HEADER;

// Render list options
$jpr_Department_list->renderListOptions();

// Render list options (header, left)
$jpr_Department_list->ListOptions->render("header", "left");
?>
<?php if ($jpr_Department_list->DepartmentId->Visible) { // DepartmentId ?>
	<?php if ($jpr_Department_list->SortUrl($jpr_Department_list->DepartmentId) == "") { ?>
		<th data-name="DepartmentId" class="<?php echo $jpr_Department_list->DepartmentId->headerCellClass() ?>"><div id="elh_jpr_Department_DepartmentId" class="jpr_Department_DepartmentId"><div class="ew-table-header-caption"><?php echo $jpr_Department_list->DepartmentId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentId" class="<?php echo $jpr_Department_list->DepartmentId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jpr_Department_list->SortUrl($jpr_Department_list->DepartmentId) ?>', 1);"><div id="elh_jpr_Department_DepartmentId" class="jpr_Department_DepartmentId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jpr_Department_list->DepartmentId->caption() ?></span><span class="ew-table-header-sort"><?php if ($jpr_Department_list->DepartmentId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jpr_Department_list->DepartmentId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jpr_Department_list->Description->Visible) { // Description ?>
	<?php if ($jpr_Department_list->SortUrl($jpr_Department_list->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $jpr_Department_list->Description->headerCellClass() ?>"><div id="elh_jpr_Department_Description" class="jpr_Department_Description"><div class="ew-table-header-caption"><?php echo $jpr_Department_list->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $jpr_Department_list->Description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jpr_Department_list->SortUrl($jpr_Department_list->Description) ?>', 1);"><div id="elh_jpr_Department_Description" class="jpr_Department_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jpr_Department_list->Description->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jpr_Department_list->Description->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jpr_Department_list->Description->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$jpr_Department_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($jpr_Department_list->isAdd() || $jpr_Department_list->isCopy()) {
		$jpr_Department_list->RowIndex = 0;
		$jpr_Department_list->KeyCount = $jpr_Department_list->RowIndex;
		if ($jpr_Department_list->isCopy() && !$jpr_Department_list->loadRow())
			$jpr_Department->CurrentAction = "add";
		if ($jpr_Department_list->isAdd())
			$jpr_Department_list->loadRowValues();
		if ($jpr_Department->EventCancelled) // Insert failed
			$jpr_Department_list->restoreFormValues(); // Restore form values

		// Set row properties
		$jpr_Department->resetAttributes();
		$jpr_Department->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_jpr_Department", "data-rowtype" => ROWTYPE_ADD]);
		$jpr_Department->RowType = ROWTYPE_ADD;

		// Render row
		$jpr_Department_list->renderRow();

		// Render list options
		$jpr_Department_list->renderListOptions();
		$jpr_Department_list->StartRowCount = 0;
?>
	<tr <?php echo $jpr_Department->rowAttributes() ?>>
<?php

// Render list options (body, left)
$jpr_Department_list->ListOptions->render("body", "left", $jpr_Department_list->RowCount);
?>
	<?php if ($jpr_Department_list->DepartmentId->Visible) { // DepartmentId ?>
		<td data-name="DepartmentId">
<span id="el<?php echo $jpr_Department_list->RowCount ?>_jpr_Department_DepartmentId" class="form-group jpr_Department_DepartmentId"></span>
<input type="hidden" data-table="jpr_Department" data-field="x_DepartmentId" name="o<?php echo $jpr_Department_list->RowIndex ?>_DepartmentId" id="o<?php echo $jpr_Department_list->RowIndex ?>_DepartmentId" value="<?php echo HtmlEncode($jpr_Department_list->DepartmentId->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($jpr_Department_list->Description->Visible) { // Description ?>
		<td data-name="Description">
<span id="el<?php echo $jpr_Department_list->RowCount ?>_jpr_Department_Description" class="form-group jpr_Department_Description">
<input type="text" data-table="jpr_Department" data-field="x_Description" name="x<?php echo $jpr_Department_list->RowIndex ?>_Description" id="x<?php echo $jpr_Department_list->RowIndex ?>_Description" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($jpr_Department_list->Description->getPlaceHolder()) ?>" value="<?php echo $jpr_Department_list->Description->EditValue ?>"<?php echo $jpr_Department_list->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="jpr_Department" data-field="x_Description" name="o<?php echo $jpr_Department_list->RowIndex ?>_Description" id="o<?php echo $jpr_Department_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($jpr_Department_list->Description->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jpr_Department_list->ListOptions->render("body", "right", $jpr_Department_list->RowCount);
?>
<script>
loadjs.ready(["fjpr_Departmentlist", "load"], function() {
	fjpr_Departmentlist.updateLists(<?php echo $jpr_Department_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($jpr_Department_list->ExportAll && $jpr_Department_list->isExport()) {
	$jpr_Department_list->StopRecord = $jpr_Department_list->TotalRecords;
} else {

	// Set the last record to display
	if ($jpr_Department_list->TotalRecords > $jpr_Department_list->StartRecord + $jpr_Department_list->DisplayRecords - 1)
		$jpr_Department_list->StopRecord = $jpr_Department_list->StartRecord + $jpr_Department_list->DisplayRecords - 1;
	else
		$jpr_Department_list->StopRecord = $jpr_Department_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($jpr_Department->isConfirm() || $jpr_Department_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($jpr_Department_list->FormKeyCountName) && ($jpr_Department_list->isGridAdd() || $jpr_Department_list->isGridEdit() || $jpr_Department->isConfirm())) {
		$jpr_Department_list->KeyCount = $CurrentForm->getValue($jpr_Department_list->FormKeyCountName);
		$jpr_Department_list->StopRecord = $jpr_Department_list->StartRecord + $jpr_Department_list->KeyCount - 1;
	}
}
$jpr_Department_list->RecordCount = $jpr_Department_list->StartRecord - 1;
if ($jpr_Department_list->Recordset && !$jpr_Department_list->Recordset->EOF) {
	$jpr_Department_list->Recordset->moveFirst();
	$selectLimit = $jpr_Department_list->UseSelectLimit;
	if (!$selectLimit && $jpr_Department_list->StartRecord > 1)
		$jpr_Department_list->Recordset->move($jpr_Department_list->StartRecord - 1);
} elseif (!$jpr_Department->AllowAddDeleteRow && $jpr_Department_list->StopRecord == 0) {
	$jpr_Department_list->StopRecord = $jpr_Department->GridAddRowCount;
}

// Initialize aggregate
$jpr_Department->RowType = ROWTYPE_AGGREGATEINIT;
$jpr_Department->resetAttributes();
$jpr_Department_list->renderRow();
$jpr_Department_list->EditRowCount = 0;
if ($jpr_Department_list->isEdit())
	$jpr_Department_list->RowIndex = 1;
if ($jpr_Department_list->isGridAdd())
	$jpr_Department_list->RowIndex = 0;
if ($jpr_Department_list->isGridEdit())
	$jpr_Department_list->RowIndex = 0;
while ($jpr_Department_list->RecordCount < $jpr_Department_list->StopRecord) {
	$jpr_Department_list->RecordCount++;
	if ($jpr_Department_list->RecordCount >= $jpr_Department_list->StartRecord) {
		$jpr_Department_list->RowCount++;
		if ($jpr_Department_list->isGridAdd() || $jpr_Department_list->isGridEdit() || $jpr_Department->isConfirm()) {
			$jpr_Department_list->RowIndex++;
			$CurrentForm->Index = $jpr_Department_list->RowIndex;
			if ($CurrentForm->hasValue($jpr_Department_list->FormActionName) && ($jpr_Department->isConfirm() || $jpr_Department_list->EventCancelled))
				$jpr_Department_list->RowAction = strval($CurrentForm->getValue($jpr_Department_list->FormActionName));
			elseif ($jpr_Department_list->isGridAdd())
				$jpr_Department_list->RowAction = "insert";
			else
				$jpr_Department_list->RowAction = "";
		}

		// Set up key count
		$jpr_Department_list->KeyCount = $jpr_Department_list->RowIndex;

		// Init row class and style
		$jpr_Department->resetAttributes();
		$jpr_Department->CssClass = "";
		if ($jpr_Department_list->isGridAdd()) {
			$jpr_Department_list->loadRowValues(); // Load default values
		} else {
			$jpr_Department_list->loadRowValues($jpr_Department_list->Recordset); // Load row values
		}
		$jpr_Department->RowType = ROWTYPE_VIEW; // Render view
		if ($jpr_Department_list->isGridAdd()) // Grid add
			$jpr_Department->RowType = ROWTYPE_ADD; // Render add
		if ($jpr_Department_list->isGridAdd() && $jpr_Department->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$jpr_Department_list->restoreCurrentRowFormValues($jpr_Department_list->RowIndex); // Restore form values
		if ($jpr_Department_list->isEdit()) {
			if ($jpr_Department_list->checkInlineEditKey() && $jpr_Department_list->EditRowCount == 0) { // Inline edit
				$jpr_Department->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($jpr_Department_list->isGridEdit()) { // Grid edit
			if ($jpr_Department->EventCancelled)
				$jpr_Department_list->restoreCurrentRowFormValues($jpr_Department_list->RowIndex); // Restore form values
			if ($jpr_Department_list->RowAction == "insert")
				$jpr_Department->RowType = ROWTYPE_ADD; // Render add
			else
				$jpr_Department->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($jpr_Department_list->isEdit() && $jpr_Department->RowType == ROWTYPE_EDIT && $jpr_Department->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$jpr_Department_list->restoreFormValues(); // Restore form values
		}
		if ($jpr_Department_list->isGridEdit() && ($jpr_Department->RowType == ROWTYPE_EDIT || $jpr_Department->RowType == ROWTYPE_ADD) && $jpr_Department->EventCancelled) // Update failed
			$jpr_Department_list->restoreCurrentRowFormValues($jpr_Department_list->RowIndex); // Restore form values
		if ($jpr_Department->RowType == ROWTYPE_EDIT) // Edit row
			$jpr_Department_list->EditRowCount++;

		// Set up row id / data-rowindex
		$jpr_Department->RowAttrs->merge(["data-rowindex" => $jpr_Department_list->RowCount, "id" => "r" . $jpr_Department_list->RowCount . "_jpr_Department", "data-rowtype" => $jpr_Department->RowType]);

		// Render row
		$jpr_Department_list->renderRow();

		// Render list options
		$jpr_Department_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($jpr_Department_list->RowAction != "delete" && $jpr_Department_list->RowAction != "insertdelete" && !($jpr_Department_list->RowAction == "insert" && $jpr_Department->isConfirm() && $jpr_Department_list->emptyRow())) {
?>
	<tr <?php echo $jpr_Department->rowAttributes() ?>>
<?php

// Render list options (body, left)
$jpr_Department_list->ListOptions->render("body", "left", $jpr_Department_list->RowCount);
?>
	<?php if ($jpr_Department_list->DepartmentId->Visible) { // DepartmentId ?>
		<td data-name="DepartmentId" <?php echo $jpr_Department_list->DepartmentId->cellAttributes() ?>>
<?php if ($jpr_Department->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $jpr_Department_list->RowCount ?>_jpr_Department_DepartmentId" class="form-group"></span>
<input type="hidden" data-table="jpr_Department" data-field="x_DepartmentId" name="o<?php echo $jpr_Department_list->RowIndex ?>_DepartmentId" id="o<?php echo $jpr_Department_list->RowIndex ?>_DepartmentId" value="<?php echo HtmlEncode($jpr_Department_list->DepartmentId->OldValue) ?>">
<?php } ?>
<?php if ($jpr_Department->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $jpr_Department_list->RowCount ?>_jpr_Department_DepartmentId" class="form-group">
<span<?php echo $jpr_Department_list->DepartmentId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($jpr_Department_list->DepartmentId->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="jpr_Department" data-field="x_DepartmentId" name="x<?php echo $jpr_Department_list->RowIndex ?>_DepartmentId" id="x<?php echo $jpr_Department_list->RowIndex ?>_DepartmentId" value="<?php echo HtmlEncode($jpr_Department_list->DepartmentId->CurrentValue) ?>">
<?php } ?>
<?php if ($jpr_Department->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $jpr_Department_list->RowCount ?>_jpr_Department_DepartmentId">
<span<?php echo $jpr_Department_list->DepartmentId->viewAttributes() ?>><?php echo $jpr_Department_list->DepartmentId->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($jpr_Department_list->Description->Visible) { // Description ?>
		<td data-name="Description" <?php echo $jpr_Department_list->Description->cellAttributes() ?>>
<?php if ($jpr_Department->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $jpr_Department_list->RowCount ?>_jpr_Department_Description" class="form-group">
<input type="text" data-table="jpr_Department" data-field="x_Description" name="x<?php echo $jpr_Department_list->RowIndex ?>_Description" id="x<?php echo $jpr_Department_list->RowIndex ?>_Description" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($jpr_Department_list->Description->getPlaceHolder()) ?>" value="<?php echo $jpr_Department_list->Description->EditValue ?>"<?php echo $jpr_Department_list->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="jpr_Department" data-field="x_Description" name="o<?php echo $jpr_Department_list->RowIndex ?>_Description" id="o<?php echo $jpr_Department_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($jpr_Department_list->Description->OldValue) ?>">
<?php } ?>
<?php if ($jpr_Department->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $jpr_Department_list->RowCount ?>_jpr_Department_Description" class="form-group">
<input type="text" data-table="jpr_Department" data-field="x_Description" name="x<?php echo $jpr_Department_list->RowIndex ?>_Description" id="x<?php echo $jpr_Department_list->RowIndex ?>_Description" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($jpr_Department_list->Description->getPlaceHolder()) ?>" value="<?php echo $jpr_Department_list->Description->EditValue ?>"<?php echo $jpr_Department_list->Description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($jpr_Department->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $jpr_Department_list->RowCount ?>_jpr_Department_Description">
<span<?php echo $jpr_Department_list->Description->viewAttributes() ?>><?php echo $jpr_Department_list->Description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jpr_Department_list->ListOptions->render("body", "right", $jpr_Department_list->RowCount);
?>
	</tr>
<?php if ($jpr_Department->RowType == ROWTYPE_ADD || $jpr_Department->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fjpr_Departmentlist", "load"], function() {
	fjpr_Departmentlist.updateLists(<?php echo $jpr_Department_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$jpr_Department_list->isGridAdd())
		if (!$jpr_Department_list->Recordset->EOF)
			$jpr_Department_list->Recordset->moveNext();
}
?>
<?php
	if ($jpr_Department_list->isGridAdd() || $jpr_Department_list->isGridEdit()) {
		$jpr_Department_list->RowIndex = '$rowindex$';
		$jpr_Department_list->loadRowValues();

		// Set row properties
		$jpr_Department->resetAttributes();
		$jpr_Department->RowAttrs->merge(["data-rowindex" => $jpr_Department_list->RowIndex, "id" => "r0_jpr_Department", "data-rowtype" => ROWTYPE_ADD]);
		$jpr_Department->RowAttrs->appendClass("ew-template");
		$jpr_Department->RowType = ROWTYPE_ADD;

		// Render row
		$jpr_Department_list->renderRow();

		// Render list options
		$jpr_Department_list->renderListOptions();
		$jpr_Department_list->StartRowCount = 0;
?>
	<tr <?php echo $jpr_Department->rowAttributes() ?>>
<?php

// Render list options (body, left)
$jpr_Department_list->ListOptions->render("body", "left", $jpr_Department_list->RowIndex);
?>
	<?php if ($jpr_Department_list->DepartmentId->Visible) { // DepartmentId ?>
		<td data-name="DepartmentId">
<span id="el$rowindex$_jpr_Department_DepartmentId" class="form-group jpr_Department_DepartmentId"></span>
<input type="hidden" data-table="jpr_Department" data-field="x_DepartmentId" name="o<?php echo $jpr_Department_list->RowIndex ?>_DepartmentId" id="o<?php echo $jpr_Department_list->RowIndex ?>_DepartmentId" value="<?php echo HtmlEncode($jpr_Department_list->DepartmentId->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($jpr_Department_list->Description->Visible) { // Description ?>
		<td data-name="Description">
<span id="el$rowindex$_jpr_Department_Description" class="form-group jpr_Department_Description">
<input type="text" data-table="jpr_Department" data-field="x_Description" name="x<?php echo $jpr_Department_list->RowIndex ?>_Description" id="x<?php echo $jpr_Department_list->RowIndex ?>_Description" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($jpr_Department_list->Description->getPlaceHolder()) ?>" value="<?php echo $jpr_Department_list->Description->EditValue ?>"<?php echo $jpr_Department_list->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="jpr_Department" data-field="x_Description" name="o<?php echo $jpr_Department_list->RowIndex ?>_Description" id="o<?php echo $jpr_Department_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($jpr_Department_list->Description->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jpr_Department_list->ListOptions->render("body", "right", $jpr_Department_list->RowIndex);
?>
<script>
loadjs.ready(["fjpr_Departmentlist", "load"], function() {
	fjpr_Departmentlist.updateLists(<?php echo $jpr_Department_list->RowIndex ?>);
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
<?php if ($jpr_Department_list->isAdd() || $jpr_Department_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $jpr_Department_list->FormKeyCountName ?>" id="<?php echo $jpr_Department_list->FormKeyCountName ?>" value="<?php echo $jpr_Department_list->KeyCount ?>">
<?php } ?>
<?php if ($jpr_Department_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $jpr_Department_list->FormKeyCountName ?>" id="<?php echo $jpr_Department_list->FormKeyCountName ?>" value="<?php echo $jpr_Department_list->KeyCount ?>">
<?php echo $jpr_Department_list->MultiSelectKey ?>
<?php } ?>
<?php if ($jpr_Department_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $jpr_Department_list->FormKeyCountName ?>" id="<?php echo $jpr_Department_list->FormKeyCountName ?>" value="<?php echo $jpr_Department_list->KeyCount ?>">
<?php } ?>
<?php if ($jpr_Department_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $jpr_Department_list->FormKeyCountName ?>" id="<?php echo $jpr_Department_list->FormKeyCountName ?>" value="<?php echo $jpr_Department_list->KeyCount ?>">
<?php echo $jpr_Department_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$jpr_Department->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($jpr_Department_list->Recordset)
	$jpr_Department_list->Recordset->Close();
?>
<?php if (!$jpr_Department_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$jpr_Department_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jpr_Department_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jpr_Department_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($jpr_Department_list->TotalRecords == 0 && !$jpr_Department->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $jpr_Department_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$jpr_Department_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jpr_Department_list->isExport()) { ?>
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
$jpr_Department_list->terminate();
?>