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
$JobStatuses_list = new JobStatuses_list();

// Run the page
$JobStatuses_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobStatuses_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$JobStatuses_list->isExport()) { ?>
<script>
var fJobStatuseslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fJobStatuseslist = currentForm = new ew.Form("fJobStatuseslist", "list");
	fJobStatuseslist.formKeyCountName = '<?php echo $JobStatuses_list->FormKeyCountName ?>';

	// Validate form
	fJobStatuseslist.validate = function() {
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
			<?php if ($JobStatuses_list->JobStatus_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_JobStatus_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobStatuses_list->JobStatus_Idn->caption(), $JobStatuses_list->JobStatus_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobStatuses_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobStatuses_list->Name->caption(), $JobStatuses_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobStatuses_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobStatuses_list->Rank->caption(), $JobStatuses_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobStatuses_list->Rank->errorMessage()) ?>");
			<?php if ($JobStatuses_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobStatuses_list->ActiveFlag->caption(), $JobStatuses_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fJobStatuseslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fJobStatuseslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fJobStatuseslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fJobStatuseslist.lists["x_ActiveFlag[]"] = <?php echo $JobStatuses_list->ActiveFlag->Lookup->toClientList($JobStatuses_list) ?>;
	fJobStatuseslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($JobStatuses_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fJobStatuseslist");
});
var fJobStatuseslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fJobStatuseslistsrch = currentSearchForm = new ew.Form("fJobStatuseslistsrch");

	// Dynamic selection lists
	// Filters

	fJobStatuseslistsrch.filterList = <?php echo $JobStatuses_list->getFilterList() ?>;
	loadjs.done("fJobStatuseslistsrch");
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
<?php if (!$JobStatuses_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($JobStatuses_list->TotalRecords > 0 && $JobStatuses_list->ExportOptions->visible()) { ?>
<?php $JobStatuses_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($JobStatuses_list->ImportOptions->visible()) { ?>
<?php $JobStatuses_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($JobStatuses_list->SearchOptions->visible()) { ?>
<?php $JobStatuses_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($JobStatuses_list->FilterOptions->visible()) { ?>
<?php $JobStatuses_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$JobStatuses_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$JobStatuses_list->isExport() && !$JobStatuses->CurrentAction) { ?>
<form name="fJobStatuseslistsrch" id="fJobStatuseslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fJobStatuseslistsrch-search-panel" class="<?php echo $JobStatuses_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="JobStatuses">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $JobStatuses_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($JobStatuses_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($JobStatuses_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $JobStatuses_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($JobStatuses_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($JobStatuses_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($JobStatuses_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($JobStatuses_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $JobStatuses_list->showPageHeader(); ?>
<?php
$JobStatuses_list->showMessage();
?>
<?php if ($JobStatuses_list->TotalRecords > 0 || $JobStatuses->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($JobStatuses_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> JobStatuses">
<?php if (!$JobStatuses_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$JobStatuses_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobStatuses_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $JobStatuses_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fJobStatuseslist" id="fJobStatuseslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobStatuses">
<div id="gmp_JobStatuses" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($JobStatuses_list->TotalRecords > 0 || $JobStatuses_list->isAdd() || $JobStatuses_list->isCopy() || $JobStatuses_list->isGridEdit()) { ?>
<table id="tbl_JobStatuseslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$JobStatuses->RowType = ROWTYPE_HEADER;

// Render list options
$JobStatuses_list->renderListOptions();

// Render list options (header, left)
$JobStatuses_list->ListOptions->render("header", "left");
?>
<?php if ($JobStatuses_list->JobStatus_Idn->Visible) { // JobStatus_Idn ?>
	<?php if ($JobStatuses_list->SortUrl($JobStatuses_list->JobStatus_Idn) == "") { ?>
		<th data-name="JobStatus_Idn" class="<?php echo $JobStatuses_list->JobStatus_Idn->headerCellClass() ?>"><div id="elh_JobStatuses_JobStatus_Idn" class="JobStatuses_JobStatus_Idn"><div class="ew-table-header-caption"><?php echo $JobStatuses_list->JobStatus_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobStatus_Idn" class="<?php echo $JobStatuses_list->JobStatus_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobStatuses_list->SortUrl($JobStatuses_list->JobStatus_Idn) ?>', 1);"><div id="elh_JobStatuses_JobStatus_Idn" class="JobStatuses_JobStatus_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobStatuses_list->JobStatus_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobStatuses_list->JobStatus_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobStatuses_list->JobStatus_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobStatuses_list->Name->Visible) { // Name ?>
	<?php if ($JobStatuses_list->SortUrl($JobStatuses_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $JobStatuses_list->Name->headerCellClass() ?>"><div id="elh_JobStatuses_Name" class="JobStatuses_Name"><div class="ew-table-header-caption"><?php echo $JobStatuses_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $JobStatuses_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobStatuses_list->SortUrl($JobStatuses_list->Name) ?>', 1);"><div id="elh_JobStatuses_Name" class="JobStatuses_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobStatuses_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($JobStatuses_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobStatuses_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobStatuses_list->Rank->Visible) { // Rank ?>
	<?php if ($JobStatuses_list->SortUrl($JobStatuses_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $JobStatuses_list->Rank->headerCellClass() ?>"><div id="elh_JobStatuses_Rank" class="JobStatuses_Rank"><div class="ew-table-header-caption"><?php echo $JobStatuses_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $JobStatuses_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobStatuses_list->SortUrl($JobStatuses_list->Rank) ?>', 1);"><div id="elh_JobStatuses_Rank" class="JobStatuses_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobStatuses_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobStatuses_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobStatuses_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobStatuses_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($JobStatuses_list->SortUrl($JobStatuses_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $JobStatuses_list->ActiveFlag->headerCellClass() ?>"><div id="elh_JobStatuses_ActiveFlag" class="JobStatuses_ActiveFlag"><div class="ew-table-header-caption"><?php echo $JobStatuses_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $JobStatuses_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobStatuses_list->SortUrl($JobStatuses_list->ActiveFlag) ?>', 1);"><div id="elh_JobStatuses_ActiveFlag" class="JobStatuses_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobStatuses_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobStatuses_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobStatuses_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$JobStatuses_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($JobStatuses_list->isAdd() || $JobStatuses_list->isCopy()) {
		$JobStatuses_list->RowIndex = 0;
		$JobStatuses_list->KeyCount = $JobStatuses_list->RowIndex;
		if ($JobStatuses_list->isCopy() && !$JobStatuses_list->loadRow())
			$JobStatuses->CurrentAction = "add";
		if ($JobStatuses_list->isAdd())
			$JobStatuses_list->loadRowValues();
		if ($JobStatuses->EventCancelled) // Insert failed
			$JobStatuses_list->restoreFormValues(); // Restore form values

		// Set row properties
		$JobStatuses->resetAttributes();
		$JobStatuses->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_JobStatuses", "data-rowtype" => ROWTYPE_ADD]);
		$JobStatuses->RowType = ROWTYPE_ADD;

		// Render row
		$JobStatuses_list->renderRow();

		// Render list options
		$JobStatuses_list->renderListOptions();
		$JobStatuses_list->StartRowCount = 0;
?>
	<tr <?php echo $JobStatuses->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobStatuses_list->ListOptions->render("body", "left", $JobStatuses_list->RowCount);
?>
	<?php if ($JobStatuses_list->JobStatus_Idn->Visible) { // JobStatus_Idn ?>
		<td data-name="JobStatus_Idn">
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_JobStatus_Idn" class="form-group JobStatuses_JobStatus_Idn"></span>
<input type="hidden" data-table="JobStatuses" data-field="x_JobStatus_Idn" name="o<?php echo $JobStatuses_list->RowIndex ?>_JobStatus_Idn" id="o<?php echo $JobStatuses_list->RowIndex ?>_JobStatus_Idn" value="<?php echo HtmlEncode($JobStatuses_list->JobStatus_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobStatuses_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_Name" class="form-group JobStatuses_Name">
<input type="text" data-table="JobStatuses" data-field="x_Name" name="x<?php echo $JobStatuses_list->RowIndex ?>_Name" id="x<?php echo $JobStatuses_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobStatuses_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobStatuses_list->Name->EditValue ?>"<?php echo $JobStatuses_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobStatuses" data-field="x_Name" name="o<?php echo $JobStatuses_list->RowIndex ?>_Name" id="o<?php echo $JobStatuses_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobStatuses_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobStatuses_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_Rank" class="form-group JobStatuses_Rank">
<input type="text" data-table="JobStatuses" data-field="x_Rank" name="x<?php echo $JobStatuses_list->RowIndex ?>_Rank" id="x<?php echo $JobStatuses_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobStatuses_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobStatuses_list->Rank->EditValue ?>"<?php echo $JobStatuses_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobStatuses" data-field="x_Rank" name="o<?php echo $JobStatuses_list->RowIndex ?>_Rank" id="o<?php echo $JobStatuses_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobStatuses_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobStatuses_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_ActiveFlag" class="form-group JobStatuses_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobStatuses_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobStatuses" data-field="x_ActiveFlag" name="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]_416106" value="1"<?php echo $selwrk ?><?php echo $JobStatuses_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]_416106"></label>
</div>
</span>
<input type="hidden" data-table="JobStatuses" data-field="x_ActiveFlag" name="o<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobStatuses_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobStatuses_list->ListOptions->render("body", "right", $JobStatuses_list->RowCount);
?>
<script>
loadjs.ready(["fJobStatuseslist", "load"], function() {
	fJobStatuseslist.updateLists(<?php echo $JobStatuses_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($JobStatuses_list->ExportAll && $JobStatuses_list->isExport()) {
	$JobStatuses_list->StopRecord = $JobStatuses_list->TotalRecords;
} else {

	// Set the last record to display
	if ($JobStatuses_list->TotalRecords > $JobStatuses_list->StartRecord + $JobStatuses_list->DisplayRecords - 1)
		$JobStatuses_list->StopRecord = $JobStatuses_list->StartRecord + $JobStatuses_list->DisplayRecords - 1;
	else
		$JobStatuses_list->StopRecord = $JobStatuses_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($JobStatuses->isConfirm() || $JobStatuses_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($JobStatuses_list->FormKeyCountName) && ($JobStatuses_list->isGridAdd() || $JobStatuses_list->isGridEdit() || $JobStatuses->isConfirm())) {
		$JobStatuses_list->KeyCount = $CurrentForm->getValue($JobStatuses_list->FormKeyCountName);
		$JobStatuses_list->StopRecord = $JobStatuses_list->StartRecord + $JobStatuses_list->KeyCount - 1;
	}
}
$JobStatuses_list->RecordCount = $JobStatuses_list->StartRecord - 1;
if ($JobStatuses_list->Recordset && !$JobStatuses_list->Recordset->EOF) {
	$JobStatuses_list->Recordset->moveFirst();
	$selectLimit = $JobStatuses_list->UseSelectLimit;
	if (!$selectLimit && $JobStatuses_list->StartRecord > 1)
		$JobStatuses_list->Recordset->move($JobStatuses_list->StartRecord - 1);
} elseif (!$JobStatuses->AllowAddDeleteRow && $JobStatuses_list->StopRecord == 0) {
	$JobStatuses_list->StopRecord = $JobStatuses->GridAddRowCount;
}

// Initialize aggregate
$JobStatuses->RowType = ROWTYPE_AGGREGATEINIT;
$JobStatuses->resetAttributes();
$JobStatuses_list->renderRow();
$JobStatuses_list->EditRowCount = 0;
if ($JobStatuses_list->isEdit())
	$JobStatuses_list->RowIndex = 1;
if ($JobStatuses_list->isGridAdd())
	$JobStatuses_list->RowIndex = 0;
if ($JobStatuses_list->isGridEdit())
	$JobStatuses_list->RowIndex = 0;
while ($JobStatuses_list->RecordCount < $JobStatuses_list->StopRecord) {
	$JobStatuses_list->RecordCount++;
	if ($JobStatuses_list->RecordCount >= $JobStatuses_list->StartRecord) {
		$JobStatuses_list->RowCount++;
		if ($JobStatuses_list->isGridAdd() || $JobStatuses_list->isGridEdit() || $JobStatuses->isConfirm()) {
			$JobStatuses_list->RowIndex++;
			$CurrentForm->Index = $JobStatuses_list->RowIndex;
			if ($CurrentForm->hasValue($JobStatuses_list->FormActionName) && ($JobStatuses->isConfirm() || $JobStatuses_list->EventCancelled))
				$JobStatuses_list->RowAction = strval($CurrentForm->getValue($JobStatuses_list->FormActionName));
			elseif ($JobStatuses_list->isGridAdd())
				$JobStatuses_list->RowAction = "insert";
			else
				$JobStatuses_list->RowAction = "";
		}

		// Set up key count
		$JobStatuses_list->KeyCount = $JobStatuses_list->RowIndex;

		// Init row class and style
		$JobStatuses->resetAttributes();
		$JobStatuses->CssClass = "";
		if ($JobStatuses_list->isGridAdd()) {
			$JobStatuses_list->loadRowValues(); // Load default values
		} else {
			$JobStatuses_list->loadRowValues($JobStatuses_list->Recordset); // Load row values
		}
		$JobStatuses->RowType = ROWTYPE_VIEW; // Render view
		if ($JobStatuses_list->isGridAdd()) // Grid add
			$JobStatuses->RowType = ROWTYPE_ADD; // Render add
		if ($JobStatuses_list->isGridAdd() && $JobStatuses->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$JobStatuses_list->restoreCurrentRowFormValues($JobStatuses_list->RowIndex); // Restore form values
		if ($JobStatuses_list->isEdit()) {
			if ($JobStatuses_list->checkInlineEditKey() && $JobStatuses_list->EditRowCount == 0) { // Inline edit
				$JobStatuses->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($JobStatuses_list->isGridEdit()) { // Grid edit
			if ($JobStatuses->EventCancelled)
				$JobStatuses_list->restoreCurrentRowFormValues($JobStatuses_list->RowIndex); // Restore form values
			if ($JobStatuses_list->RowAction == "insert")
				$JobStatuses->RowType = ROWTYPE_ADD; // Render add
			else
				$JobStatuses->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($JobStatuses_list->isEdit() && $JobStatuses->RowType == ROWTYPE_EDIT && $JobStatuses->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$JobStatuses_list->restoreFormValues(); // Restore form values
		}
		if ($JobStatuses_list->isGridEdit() && ($JobStatuses->RowType == ROWTYPE_EDIT || $JobStatuses->RowType == ROWTYPE_ADD) && $JobStatuses->EventCancelled) // Update failed
			$JobStatuses_list->restoreCurrentRowFormValues($JobStatuses_list->RowIndex); // Restore form values
		if ($JobStatuses->RowType == ROWTYPE_EDIT) // Edit row
			$JobStatuses_list->EditRowCount++;

		// Set up row id / data-rowindex
		$JobStatuses->RowAttrs->merge(["data-rowindex" => $JobStatuses_list->RowCount, "id" => "r" . $JobStatuses_list->RowCount . "_JobStatuses", "data-rowtype" => $JobStatuses->RowType]);

		// Render row
		$JobStatuses_list->renderRow();

		// Render list options
		$JobStatuses_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($JobStatuses_list->RowAction != "delete" && $JobStatuses_list->RowAction != "insertdelete" && !($JobStatuses_list->RowAction == "insert" && $JobStatuses->isConfirm() && $JobStatuses_list->emptyRow())) {
?>
	<tr <?php echo $JobStatuses->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobStatuses_list->ListOptions->render("body", "left", $JobStatuses_list->RowCount);
?>
	<?php if ($JobStatuses_list->JobStatus_Idn->Visible) { // JobStatus_Idn ?>
		<td data-name="JobStatus_Idn" <?php echo $JobStatuses_list->JobStatus_Idn->cellAttributes() ?>>
<?php if ($JobStatuses->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_JobStatus_Idn" class="form-group"></span>
<input type="hidden" data-table="JobStatuses" data-field="x_JobStatus_Idn" name="o<?php echo $JobStatuses_list->RowIndex ?>_JobStatus_Idn" id="o<?php echo $JobStatuses_list->RowIndex ?>_JobStatus_Idn" value="<?php echo HtmlEncode($JobStatuses_list->JobStatus_Idn->OldValue) ?>">
<?php } ?>
<?php if ($JobStatuses->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_JobStatus_Idn" class="form-group">
<span<?php echo $JobStatuses_list->JobStatus_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($JobStatuses_list->JobStatus_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="JobStatuses" data-field="x_JobStatus_Idn" name="x<?php echo $JobStatuses_list->RowIndex ?>_JobStatus_Idn" id="x<?php echo $JobStatuses_list->RowIndex ?>_JobStatus_Idn" value="<?php echo HtmlEncode($JobStatuses_list->JobStatus_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($JobStatuses->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_JobStatus_Idn">
<span<?php echo $JobStatuses_list->JobStatus_Idn->viewAttributes() ?>><?php echo $JobStatuses_list->JobStatus_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobStatuses_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $JobStatuses_list->Name->cellAttributes() ?>>
<?php if ($JobStatuses->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_Name" class="form-group">
<input type="text" data-table="JobStatuses" data-field="x_Name" name="x<?php echo $JobStatuses_list->RowIndex ?>_Name" id="x<?php echo $JobStatuses_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobStatuses_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobStatuses_list->Name->EditValue ?>"<?php echo $JobStatuses_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobStatuses" data-field="x_Name" name="o<?php echo $JobStatuses_list->RowIndex ?>_Name" id="o<?php echo $JobStatuses_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobStatuses_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($JobStatuses->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_Name" class="form-group">
<input type="text" data-table="JobStatuses" data-field="x_Name" name="x<?php echo $JobStatuses_list->RowIndex ?>_Name" id="x<?php echo $JobStatuses_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobStatuses_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobStatuses_list->Name->EditValue ?>"<?php echo $JobStatuses_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobStatuses->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_Name">
<span<?php echo $JobStatuses_list->Name->viewAttributes() ?>><?php echo $JobStatuses_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobStatuses_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $JobStatuses_list->Rank->cellAttributes() ?>>
<?php if ($JobStatuses->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_Rank" class="form-group">
<input type="text" data-table="JobStatuses" data-field="x_Rank" name="x<?php echo $JobStatuses_list->RowIndex ?>_Rank" id="x<?php echo $JobStatuses_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobStatuses_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobStatuses_list->Rank->EditValue ?>"<?php echo $JobStatuses_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobStatuses" data-field="x_Rank" name="o<?php echo $JobStatuses_list->RowIndex ?>_Rank" id="o<?php echo $JobStatuses_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobStatuses_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($JobStatuses->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_Rank" class="form-group">
<input type="text" data-table="JobStatuses" data-field="x_Rank" name="x<?php echo $JobStatuses_list->RowIndex ?>_Rank" id="x<?php echo $JobStatuses_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobStatuses_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobStatuses_list->Rank->EditValue ?>"<?php echo $JobStatuses_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobStatuses->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_Rank">
<span<?php echo $JobStatuses_list->Rank->viewAttributes() ?>><?php echo $JobStatuses_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobStatuses_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $JobStatuses_list->ActiveFlag->cellAttributes() ?>>
<?php if ($JobStatuses->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($JobStatuses_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobStatuses" data-field="x_ActiveFlag" name="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]_843854" value="1"<?php echo $selwrk ?><?php echo $JobStatuses_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]_843854"></label>
</div>
</span>
<input type="hidden" data-table="JobStatuses" data-field="x_ActiveFlag" name="o<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobStatuses_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($JobStatuses->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($JobStatuses_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobStatuses" data-field="x_ActiveFlag" name="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]_853698" value="1"<?php echo $selwrk ?><?php echo $JobStatuses_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]_853698"></label>
</div>
</span>
<?php } ?>
<?php if ($JobStatuses->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobStatuses_list->RowCount ?>_JobStatuses_ActiveFlag">
<span<?php echo $JobStatuses_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobStatuses_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobStatuses_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobStatuses_list->ListOptions->render("body", "right", $JobStatuses_list->RowCount);
?>
	</tr>
<?php if ($JobStatuses->RowType == ROWTYPE_ADD || $JobStatuses->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fJobStatuseslist", "load"], function() {
	fJobStatuseslist.updateLists(<?php echo $JobStatuses_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$JobStatuses_list->isGridAdd())
		if (!$JobStatuses_list->Recordset->EOF)
			$JobStatuses_list->Recordset->moveNext();
}
?>
<?php
	if ($JobStatuses_list->isGridAdd() || $JobStatuses_list->isGridEdit()) {
		$JobStatuses_list->RowIndex = '$rowindex$';
		$JobStatuses_list->loadRowValues();

		// Set row properties
		$JobStatuses->resetAttributes();
		$JobStatuses->RowAttrs->merge(["data-rowindex" => $JobStatuses_list->RowIndex, "id" => "r0_JobStatuses", "data-rowtype" => ROWTYPE_ADD]);
		$JobStatuses->RowAttrs->appendClass("ew-template");
		$JobStatuses->RowType = ROWTYPE_ADD;

		// Render row
		$JobStatuses_list->renderRow();

		// Render list options
		$JobStatuses_list->renderListOptions();
		$JobStatuses_list->StartRowCount = 0;
?>
	<tr <?php echo $JobStatuses->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobStatuses_list->ListOptions->render("body", "left", $JobStatuses_list->RowIndex);
?>
	<?php if ($JobStatuses_list->JobStatus_Idn->Visible) { // JobStatus_Idn ?>
		<td data-name="JobStatus_Idn">
<span id="el$rowindex$_JobStatuses_JobStatus_Idn" class="form-group JobStatuses_JobStatus_Idn"></span>
<input type="hidden" data-table="JobStatuses" data-field="x_JobStatus_Idn" name="o<?php echo $JobStatuses_list->RowIndex ?>_JobStatus_Idn" id="o<?php echo $JobStatuses_list->RowIndex ?>_JobStatus_Idn" value="<?php echo HtmlEncode($JobStatuses_list->JobStatus_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobStatuses_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_JobStatuses_Name" class="form-group JobStatuses_Name">
<input type="text" data-table="JobStatuses" data-field="x_Name" name="x<?php echo $JobStatuses_list->RowIndex ?>_Name" id="x<?php echo $JobStatuses_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobStatuses_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobStatuses_list->Name->EditValue ?>"<?php echo $JobStatuses_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobStatuses" data-field="x_Name" name="o<?php echo $JobStatuses_list->RowIndex ?>_Name" id="o<?php echo $JobStatuses_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobStatuses_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobStatuses_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_JobStatuses_Rank" class="form-group JobStatuses_Rank">
<input type="text" data-table="JobStatuses" data-field="x_Rank" name="x<?php echo $JobStatuses_list->RowIndex ?>_Rank" id="x<?php echo $JobStatuses_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobStatuses_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobStatuses_list->Rank->EditValue ?>"<?php echo $JobStatuses_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobStatuses" data-field="x_Rank" name="o<?php echo $JobStatuses_list->RowIndex ?>_Rank" id="o<?php echo $JobStatuses_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobStatuses_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobStatuses_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_JobStatuses_ActiveFlag" class="form-group JobStatuses_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobStatuses_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobStatuses" data-field="x_ActiveFlag" name="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]_805574" value="1"<?php echo $selwrk ?><?php echo $JobStatuses_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]_805574"></label>
</div>
</span>
<input type="hidden" data-table="JobStatuses" data-field="x_ActiveFlag" name="o<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobStatuses_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobStatuses_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobStatuses_list->ListOptions->render("body", "right", $JobStatuses_list->RowIndex);
?>
<script>
loadjs.ready(["fJobStatuseslist", "load"], function() {
	fJobStatuseslist.updateLists(<?php echo $JobStatuses_list->RowIndex ?>);
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
<?php if ($JobStatuses_list->isAdd() || $JobStatuses_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $JobStatuses_list->FormKeyCountName ?>" id="<?php echo $JobStatuses_list->FormKeyCountName ?>" value="<?php echo $JobStatuses_list->KeyCount ?>">
<?php } ?>
<?php if ($JobStatuses_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $JobStatuses_list->FormKeyCountName ?>" id="<?php echo $JobStatuses_list->FormKeyCountName ?>" value="<?php echo $JobStatuses_list->KeyCount ?>">
<?php echo $JobStatuses_list->MultiSelectKey ?>
<?php } ?>
<?php if ($JobStatuses_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $JobStatuses_list->FormKeyCountName ?>" id="<?php echo $JobStatuses_list->FormKeyCountName ?>" value="<?php echo $JobStatuses_list->KeyCount ?>">
<?php } ?>
<?php if ($JobStatuses_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $JobStatuses_list->FormKeyCountName ?>" id="<?php echo $JobStatuses_list->FormKeyCountName ?>" value="<?php echo $JobStatuses_list->KeyCount ?>">
<?php echo $JobStatuses_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$JobStatuses->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($JobStatuses_list->Recordset)
	$JobStatuses_list->Recordset->Close();
?>
<?php if (!$JobStatuses_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$JobStatuses_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobStatuses_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $JobStatuses_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($JobStatuses_list->TotalRecords == 0 && !$JobStatuses->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $JobStatuses_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$JobStatuses_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$JobStatuses_list->isExport()) { ?>
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
$JobStatuses_list->terminate();
?>