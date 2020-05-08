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
$WorksheetColumns_list = new WorksheetColumns_list();

// Run the page
$WorksheetColumns_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetColumns_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$WorksheetColumns_list->isExport()) { ?>
<script>
var fWorksheetColumnslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fWorksheetColumnslist = currentForm = new ew.Form("fWorksheetColumnslist", "list");
	fWorksheetColumnslist.formKeyCountName = '<?php echo $WorksheetColumns_list->FormKeyCountName ?>';

	// Validate form
	fWorksheetColumnslist.validate = function() {
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
			<?php if ($WorksheetColumns_list->WorksheetColumn_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetColumn_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetColumns_list->WorksheetColumn_Idn->caption(), $WorksheetColumns_list->WorksheetColumn_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetColumns_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetColumns_list->Name->caption(), $WorksheetColumns_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetColumns_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetColumns_list->Rank->caption(), $WorksheetColumns_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetColumns_list->Rank->errorMessage()) ?>");
			<?php if ($WorksheetColumns_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetColumns_list->ActiveFlag->caption(), $WorksheetColumns_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fWorksheetColumnslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fWorksheetColumnslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetColumnslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetColumnslist.lists["x_ActiveFlag[]"] = <?php echo $WorksheetColumns_list->ActiveFlag->Lookup->toClientList($WorksheetColumns_list) ?>;
	fWorksheetColumnslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($WorksheetColumns_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fWorksheetColumnslist");
});
var fWorksheetColumnslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fWorksheetColumnslistsrch = currentSearchForm = new ew.Form("fWorksheetColumnslistsrch");

	// Dynamic selection lists
	// Filters

	fWorksheetColumnslistsrch.filterList = <?php echo $WorksheetColumns_list->getFilterList() ?>;
	loadjs.done("fWorksheetColumnslistsrch");
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
<?php if (!$WorksheetColumns_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($WorksheetColumns_list->TotalRecords > 0 && $WorksheetColumns_list->ExportOptions->visible()) { ?>
<?php $WorksheetColumns_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetColumns_list->ImportOptions->visible()) { ?>
<?php $WorksheetColumns_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetColumns_list->SearchOptions->visible()) { ?>
<?php $WorksheetColumns_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetColumns_list->FilterOptions->visible()) { ?>
<?php $WorksheetColumns_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$WorksheetColumns_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$WorksheetColumns_list->isExport() && !$WorksheetColumns->CurrentAction) { ?>
<form name="fWorksheetColumnslistsrch" id="fWorksheetColumnslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fWorksheetColumnslistsrch-search-panel" class="<?php echo $WorksheetColumns_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="WorksheetColumns">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $WorksheetColumns_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($WorksheetColumns_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($WorksheetColumns_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $WorksheetColumns_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($WorksheetColumns_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($WorksheetColumns_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($WorksheetColumns_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($WorksheetColumns_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $WorksheetColumns_list->showPageHeader(); ?>
<?php
$WorksheetColumns_list->showMessage();
?>
<?php if ($WorksheetColumns_list->TotalRecords > 0 || $WorksheetColumns->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($WorksheetColumns_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> WorksheetColumns">
<?php if (!$WorksheetColumns_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$WorksheetColumns_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetColumns_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetColumns_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fWorksheetColumnslist" id="fWorksheetColumnslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetColumns">
<div id="gmp_WorksheetColumns" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($WorksheetColumns_list->TotalRecords > 0 || $WorksheetColumns_list->isAdd() || $WorksheetColumns_list->isCopy() || $WorksheetColumns_list->isGridEdit()) { ?>
<table id="tbl_WorksheetColumnslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$WorksheetColumns->RowType = ROWTYPE_HEADER;

// Render list options
$WorksheetColumns_list->renderListOptions();

// Render list options (header, left)
$WorksheetColumns_list->ListOptions->render("header", "left");
?>
<?php if ($WorksheetColumns_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
	<?php if ($WorksheetColumns_list->SortUrl($WorksheetColumns_list->WorksheetColumn_Idn) == "") { ?>
		<th data-name="WorksheetColumn_Idn" class="<?php echo $WorksheetColumns_list->WorksheetColumn_Idn->headerCellClass() ?>"><div id="elh_WorksheetColumns_WorksheetColumn_Idn" class="WorksheetColumns_WorksheetColumn_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetColumns_list->WorksheetColumn_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetColumn_Idn" class="<?php echo $WorksheetColumns_list->WorksheetColumn_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetColumns_list->SortUrl($WorksheetColumns_list->WorksheetColumn_Idn) ?>', 1);"><div id="elh_WorksheetColumns_WorksheetColumn_Idn" class="WorksheetColumns_WorksheetColumn_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetColumns_list->WorksheetColumn_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetColumns_list->WorksheetColumn_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetColumns_list->WorksheetColumn_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetColumns_list->Name->Visible) { // Name ?>
	<?php if ($WorksheetColumns_list->SortUrl($WorksheetColumns_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $WorksheetColumns_list->Name->headerCellClass() ?>"><div id="elh_WorksheetColumns_Name" class="WorksheetColumns_Name"><div class="ew-table-header-caption"><?php echo $WorksheetColumns_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $WorksheetColumns_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetColumns_list->SortUrl($WorksheetColumns_list->Name) ?>', 1);"><div id="elh_WorksheetColumns_Name" class="WorksheetColumns_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetColumns_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($WorksheetColumns_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetColumns_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetColumns_list->Rank->Visible) { // Rank ?>
	<?php if ($WorksheetColumns_list->SortUrl($WorksheetColumns_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $WorksheetColumns_list->Rank->headerCellClass() ?>"><div id="elh_WorksheetColumns_Rank" class="WorksheetColumns_Rank"><div class="ew-table-header-caption"><?php echo $WorksheetColumns_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $WorksheetColumns_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetColumns_list->SortUrl($WorksheetColumns_list->Rank) ?>', 1);"><div id="elh_WorksheetColumns_Rank" class="WorksheetColumns_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetColumns_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetColumns_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetColumns_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetColumns_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($WorksheetColumns_list->SortUrl($WorksheetColumns_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $WorksheetColumns_list->ActiveFlag->headerCellClass() ?>"><div id="elh_WorksheetColumns_ActiveFlag" class="WorksheetColumns_ActiveFlag"><div class="ew-table-header-caption"><?php echo $WorksheetColumns_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $WorksheetColumns_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetColumns_list->SortUrl($WorksheetColumns_list->ActiveFlag) ?>', 1);"><div id="elh_WorksheetColumns_ActiveFlag" class="WorksheetColumns_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetColumns_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetColumns_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetColumns_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$WorksheetColumns_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($WorksheetColumns_list->isAdd() || $WorksheetColumns_list->isCopy()) {
		$WorksheetColumns_list->RowIndex = 0;
		$WorksheetColumns_list->KeyCount = $WorksheetColumns_list->RowIndex;
		if ($WorksheetColumns_list->isCopy() && !$WorksheetColumns_list->loadRow())
			$WorksheetColumns->CurrentAction = "add";
		if ($WorksheetColumns_list->isAdd())
			$WorksheetColumns_list->loadRowValues();
		if ($WorksheetColumns->EventCancelled) // Insert failed
			$WorksheetColumns_list->restoreFormValues(); // Restore form values

		// Set row properties
		$WorksheetColumns->resetAttributes();
		$WorksheetColumns->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_WorksheetColumns", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetColumns->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetColumns_list->renderRow();

		// Render list options
		$WorksheetColumns_list->renderListOptions();
		$WorksheetColumns_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetColumns->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetColumns_list->ListOptions->render("body", "left", $WorksheetColumns_list->RowCount);
?>
	<?php if ($WorksheetColumns_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td data-name="WorksheetColumn_Idn">
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_WorksheetColumn_Idn" class="form-group WorksheetColumns_WorksheetColumn_Idn"></span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_WorksheetColumn_Idn" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_WorksheetColumn_Idn" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($WorksheetColumns_list->WorksheetColumn_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetColumns_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_Name" class="form-group WorksheetColumns_Name">
<input type="text" data-table="WorksheetColumns" data-field="x_Name" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_Name" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetColumns_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetColumns_list->Name->EditValue ?>"<?php echo $WorksheetColumns_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_Name" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_Name" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($WorksheetColumns_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetColumns_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_Rank" class="form-group WorksheetColumns_Rank">
<input type="text" data-table="WorksheetColumns" data-field="x_Rank" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetColumns_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetColumns_list->Rank->EditValue ?>"<?php echo $WorksheetColumns_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_Rank" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetColumns_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetColumns_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_ActiveFlag" class="form-group WorksheetColumns_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetColumns_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetColumns" data-field="x_ActiveFlag" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]_250308" value="1"<?php echo $selwrk ?><?php echo $WorksheetColumns_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]_250308"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_ActiveFlag" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetColumns_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetColumns_list->ListOptions->render("body", "right", $WorksheetColumns_list->RowCount);
?>
<script>
loadjs.ready(["fWorksheetColumnslist", "load"], function() {
	fWorksheetColumnslist.updateLists(<?php echo $WorksheetColumns_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($WorksheetColumns_list->ExportAll && $WorksheetColumns_list->isExport()) {
	$WorksheetColumns_list->StopRecord = $WorksheetColumns_list->TotalRecords;
} else {

	// Set the last record to display
	if ($WorksheetColumns_list->TotalRecords > $WorksheetColumns_list->StartRecord + $WorksheetColumns_list->DisplayRecords - 1)
		$WorksheetColumns_list->StopRecord = $WorksheetColumns_list->StartRecord + $WorksheetColumns_list->DisplayRecords - 1;
	else
		$WorksheetColumns_list->StopRecord = $WorksheetColumns_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($WorksheetColumns->isConfirm() || $WorksheetColumns_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($WorksheetColumns_list->FormKeyCountName) && ($WorksheetColumns_list->isGridAdd() || $WorksheetColumns_list->isGridEdit() || $WorksheetColumns->isConfirm())) {
		$WorksheetColumns_list->KeyCount = $CurrentForm->getValue($WorksheetColumns_list->FormKeyCountName);
		$WorksheetColumns_list->StopRecord = $WorksheetColumns_list->StartRecord + $WorksheetColumns_list->KeyCount - 1;
	}
}
$WorksheetColumns_list->RecordCount = $WorksheetColumns_list->StartRecord - 1;
if ($WorksheetColumns_list->Recordset && !$WorksheetColumns_list->Recordset->EOF) {
	$WorksheetColumns_list->Recordset->moveFirst();
	$selectLimit = $WorksheetColumns_list->UseSelectLimit;
	if (!$selectLimit && $WorksheetColumns_list->StartRecord > 1)
		$WorksheetColumns_list->Recordset->move($WorksheetColumns_list->StartRecord - 1);
} elseif (!$WorksheetColumns->AllowAddDeleteRow && $WorksheetColumns_list->StopRecord == 0) {
	$WorksheetColumns_list->StopRecord = $WorksheetColumns->GridAddRowCount;
}

// Initialize aggregate
$WorksheetColumns->RowType = ROWTYPE_AGGREGATEINIT;
$WorksheetColumns->resetAttributes();
$WorksheetColumns_list->renderRow();
$WorksheetColumns_list->EditRowCount = 0;
if ($WorksheetColumns_list->isEdit())
	$WorksheetColumns_list->RowIndex = 1;
if ($WorksheetColumns_list->isGridAdd())
	$WorksheetColumns_list->RowIndex = 0;
if ($WorksheetColumns_list->isGridEdit())
	$WorksheetColumns_list->RowIndex = 0;
while ($WorksheetColumns_list->RecordCount < $WorksheetColumns_list->StopRecord) {
	$WorksheetColumns_list->RecordCount++;
	if ($WorksheetColumns_list->RecordCount >= $WorksheetColumns_list->StartRecord) {
		$WorksheetColumns_list->RowCount++;
		if ($WorksheetColumns_list->isGridAdd() || $WorksheetColumns_list->isGridEdit() || $WorksheetColumns->isConfirm()) {
			$WorksheetColumns_list->RowIndex++;
			$CurrentForm->Index = $WorksheetColumns_list->RowIndex;
			if ($CurrentForm->hasValue($WorksheetColumns_list->FormActionName) && ($WorksheetColumns->isConfirm() || $WorksheetColumns_list->EventCancelled))
				$WorksheetColumns_list->RowAction = strval($CurrentForm->getValue($WorksheetColumns_list->FormActionName));
			elseif ($WorksheetColumns_list->isGridAdd())
				$WorksheetColumns_list->RowAction = "insert";
			else
				$WorksheetColumns_list->RowAction = "";
		}

		// Set up key count
		$WorksheetColumns_list->KeyCount = $WorksheetColumns_list->RowIndex;

		// Init row class and style
		$WorksheetColumns->resetAttributes();
		$WorksheetColumns->CssClass = "";
		if ($WorksheetColumns_list->isGridAdd()) {
			$WorksheetColumns_list->loadRowValues(); // Load default values
		} else {
			$WorksheetColumns_list->loadRowValues($WorksheetColumns_list->Recordset); // Load row values
		}
		$WorksheetColumns->RowType = ROWTYPE_VIEW; // Render view
		if ($WorksheetColumns_list->isGridAdd()) // Grid add
			$WorksheetColumns->RowType = ROWTYPE_ADD; // Render add
		if ($WorksheetColumns_list->isGridAdd() && $WorksheetColumns->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$WorksheetColumns_list->restoreCurrentRowFormValues($WorksheetColumns_list->RowIndex); // Restore form values
		if ($WorksheetColumns_list->isEdit()) {
			if ($WorksheetColumns_list->checkInlineEditKey() && $WorksheetColumns_list->EditRowCount == 0) { // Inline edit
				$WorksheetColumns->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($WorksheetColumns_list->isGridEdit()) { // Grid edit
			if ($WorksheetColumns->EventCancelled)
				$WorksheetColumns_list->restoreCurrentRowFormValues($WorksheetColumns_list->RowIndex); // Restore form values
			if ($WorksheetColumns_list->RowAction == "insert")
				$WorksheetColumns->RowType = ROWTYPE_ADD; // Render add
			else
				$WorksheetColumns->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($WorksheetColumns_list->isEdit() && $WorksheetColumns->RowType == ROWTYPE_EDIT && $WorksheetColumns->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$WorksheetColumns_list->restoreFormValues(); // Restore form values
		}
		if ($WorksheetColumns_list->isGridEdit() && ($WorksheetColumns->RowType == ROWTYPE_EDIT || $WorksheetColumns->RowType == ROWTYPE_ADD) && $WorksheetColumns->EventCancelled) // Update failed
			$WorksheetColumns_list->restoreCurrentRowFormValues($WorksheetColumns_list->RowIndex); // Restore form values
		if ($WorksheetColumns->RowType == ROWTYPE_EDIT) // Edit row
			$WorksheetColumns_list->EditRowCount++;

		// Set up row id / data-rowindex
		$WorksheetColumns->RowAttrs->merge(["data-rowindex" => $WorksheetColumns_list->RowCount, "id" => "r" . $WorksheetColumns_list->RowCount . "_WorksheetColumns", "data-rowtype" => $WorksheetColumns->RowType]);

		// Render row
		$WorksheetColumns_list->renderRow();

		// Render list options
		$WorksheetColumns_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($WorksheetColumns_list->RowAction != "delete" && $WorksheetColumns_list->RowAction != "insertdelete" && !($WorksheetColumns_list->RowAction == "insert" && $WorksheetColumns->isConfirm() && $WorksheetColumns_list->emptyRow())) {
?>
	<tr <?php echo $WorksheetColumns->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetColumns_list->ListOptions->render("body", "left", $WorksheetColumns_list->RowCount);
?>
	<?php if ($WorksheetColumns_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td data-name="WorksheetColumn_Idn" <?php echo $WorksheetColumns_list->WorksheetColumn_Idn->cellAttributes() ?>>
<?php if ($WorksheetColumns->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_WorksheetColumn_Idn" class="form-group"></span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_WorksheetColumn_Idn" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_WorksheetColumn_Idn" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($WorksheetColumns_list->WorksheetColumn_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetColumns->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_WorksheetColumn_Idn" class="form-group">
<span<?php echo $WorksheetColumns_list->WorksheetColumn_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetColumns_list->WorksheetColumn_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_WorksheetColumn_Idn" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_WorksheetColumn_Idn" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($WorksheetColumns_list->WorksheetColumn_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetColumns->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_WorksheetColumn_Idn">
<span<?php echo $WorksheetColumns_list->WorksheetColumn_Idn->viewAttributes() ?>><?php echo $WorksheetColumns_list->WorksheetColumn_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetColumns_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $WorksheetColumns_list->Name->cellAttributes() ?>>
<?php if ($WorksheetColumns->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_Name" class="form-group">
<input type="text" data-table="WorksheetColumns" data-field="x_Name" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_Name" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetColumns_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetColumns_list->Name->EditValue ?>"<?php echo $WorksheetColumns_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_Name" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_Name" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($WorksheetColumns_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetColumns->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_Name" class="form-group">
<input type="text" data-table="WorksheetColumns" data-field="x_Name" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_Name" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetColumns_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetColumns_list->Name->EditValue ?>"<?php echo $WorksheetColumns_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($WorksheetColumns->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_Name">
<span<?php echo $WorksheetColumns_list->Name->viewAttributes() ?>><?php echo $WorksheetColumns_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetColumns_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $WorksheetColumns_list->Rank->cellAttributes() ?>>
<?php if ($WorksheetColumns->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_Rank" class="form-group">
<input type="text" data-table="WorksheetColumns" data-field="x_Rank" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetColumns_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetColumns_list->Rank->EditValue ?>"<?php echo $WorksheetColumns_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_Rank" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetColumns_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetColumns->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_Rank" class="form-group">
<input type="text" data-table="WorksheetColumns" data-field="x_Rank" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetColumns_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetColumns_list->Rank->EditValue ?>"<?php echo $WorksheetColumns_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($WorksheetColumns->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_Rank">
<span<?php echo $WorksheetColumns_list->Rank->viewAttributes() ?>><?php echo $WorksheetColumns_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetColumns_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $WorksheetColumns_list->ActiveFlag->cellAttributes() ?>>
<?php if ($WorksheetColumns->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetColumns_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetColumns" data-field="x_ActiveFlag" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]_435927" value="1"<?php echo $selwrk ?><?php echo $WorksheetColumns_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]_435927"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_ActiveFlag" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetColumns_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetColumns->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetColumns_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetColumns" data-field="x_ActiveFlag" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]_754232" value="1"<?php echo $selwrk ?><?php echo $WorksheetColumns_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]_754232"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetColumns->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetColumns_list->RowCount ?>_WorksheetColumns_ActiveFlag">
<span<?php echo $WorksheetColumns_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $WorksheetColumns_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetColumns_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetColumns_list->ListOptions->render("body", "right", $WorksheetColumns_list->RowCount);
?>
	</tr>
<?php if ($WorksheetColumns->RowType == ROWTYPE_ADD || $WorksheetColumns->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fWorksheetColumnslist", "load"], function() {
	fWorksheetColumnslist.updateLists(<?php echo $WorksheetColumns_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$WorksheetColumns_list->isGridAdd())
		if (!$WorksheetColumns_list->Recordset->EOF)
			$WorksheetColumns_list->Recordset->moveNext();
}
?>
<?php
	if ($WorksheetColumns_list->isGridAdd() || $WorksheetColumns_list->isGridEdit()) {
		$WorksheetColumns_list->RowIndex = '$rowindex$';
		$WorksheetColumns_list->loadRowValues();

		// Set row properties
		$WorksheetColumns->resetAttributes();
		$WorksheetColumns->RowAttrs->merge(["data-rowindex" => $WorksheetColumns_list->RowIndex, "id" => "r0_WorksheetColumns", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetColumns->RowAttrs->appendClass("ew-template");
		$WorksheetColumns->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetColumns_list->renderRow();

		// Render list options
		$WorksheetColumns_list->renderListOptions();
		$WorksheetColumns_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetColumns->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetColumns_list->ListOptions->render("body", "left", $WorksheetColumns_list->RowIndex);
?>
	<?php if ($WorksheetColumns_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td data-name="WorksheetColumn_Idn">
<span id="el$rowindex$_WorksheetColumns_WorksheetColumn_Idn" class="form-group WorksheetColumns_WorksheetColumn_Idn"></span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_WorksheetColumn_Idn" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_WorksheetColumn_Idn" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($WorksheetColumns_list->WorksheetColumn_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetColumns_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_WorksheetColumns_Name" class="form-group WorksheetColumns_Name">
<input type="text" data-table="WorksheetColumns" data-field="x_Name" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_Name" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($WorksheetColumns_list->Name->getPlaceHolder()) ?>" value="<?php echo $WorksheetColumns_list->Name->EditValue ?>"<?php echo $WorksheetColumns_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_Name" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_Name" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($WorksheetColumns_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetColumns_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_WorksheetColumns_Rank" class="form-group WorksheetColumns_Rank">
<input type="text" data-table="WorksheetColumns" data-field="x_Rank" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetColumns_list->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetColumns_list->Rank->EditValue ?>"<?php echo $WorksheetColumns_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_Rank" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetColumns_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetColumns_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_WorksheetColumns_ActiveFlag" class="form-group WorksheetColumns_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetColumns_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetColumns" data-field="x_ActiveFlag" name="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]_858439" value="1"<?php echo $selwrk ?><?php echo $WorksheetColumns_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]_858439"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetColumns" data-field="x_ActiveFlag" name="o<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetColumns_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetColumns_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetColumns_list->ListOptions->render("body", "right", $WorksheetColumns_list->RowIndex);
?>
<script>
loadjs.ready(["fWorksheetColumnslist", "load"], function() {
	fWorksheetColumnslist.updateLists(<?php echo $WorksheetColumns_list->RowIndex ?>);
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
<?php if ($WorksheetColumns_list->isAdd() || $WorksheetColumns_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $WorksheetColumns_list->FormKeyCountName ?>" id="<?php echo $WorksheetColumns_list->FormKeyCountName ?>" value="<?php echo $WorksheetColumns_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetColumns_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $WorksheetColumns_list->FormKeyCountName ?>" id="<?php echo $WorksheetColumns_list->FormKeyCountName ?>" value="<?php echo $WorksheetColumns_list->KeyCount ?>">
<?php echo $WorksheetColumns_list->MultiSelectKey ?>
<?php } ?>
<?php if ($WorksheetColumns_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $WorksheetColumns_list->FormKeyCountName ?>" id="<?php echo $WorksheetColumns_list->FormKeyCountName ?>" value="<?php echo $WorksheetColumns_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetColumns_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $WorksheetColumns_list->FormKeyCountName ?>" id="<?php echo $WorksheetColumns_list->FormKeyCountName ?>" value="<?php echo $WorksheetColumns_list->KeyCount ?>">
<?php echo $WorksheetColumns_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$WorksheetColumns->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($WorksheetColumns_list->Recordset)
	$WorksheetColumns_list->Recordset->Close();
?>
<?php if (!$WorksheetColumns_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$WorksheetColumns_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetColumns_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetColumns_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($WorksheetColumns_list->TotalRecords == 0 && !$WorksheetColumns->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $WorksheetColumns_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$WorksheetColumns_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$WorksheetColumns_list->isExport()) { ?>
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
$WorksheetColumns_list->terminate();
?>