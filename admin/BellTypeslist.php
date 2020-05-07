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
$BellTypes_list = new BellTypes_list();

// Run the page
$BellTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$BellTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$BellTypes_list->isExport()) { ?>
<script>
var fBellTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fBellTypeslist = currentForm = new ew.Form("fBellTypeslist", "list");
	fBellTypeslist.formKeyCountName = '<?php echo $BellTypes_list->FormKeyCountName ?>';

	// Validate form
	fBellTypeslist.validate = function() {
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
			<?php if ($BellTypes_list->BellType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_BellType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BellTypes_list->BellType_Idn->caption(), $BellTypes_list->BellType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($BellTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BellTypes_list->Name->caption(), $BellTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($BellTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BellTypes_list->Rank->caption(), $BellTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BellTypes_list->Rank->errorMessage()) ?>");
			<?php if ($BellTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BellTypes_list->ActiveFlag->caption(), $BellTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fBellTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fBellTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fBellTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fBellTypeslist.lists["x_ActiveFlag[]"] = <?php echo $BellTypes_list->ActiveFlag->Lookup->toClientList($BellTypes_list) ?>;
	fBellTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($BellTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fBellTypeslist");
});
var fBellTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fBellTypeslistsrch = currentSearchForm = new ew.Form("fBellTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fBellTypeslistsrch.filterList = <?php echo $BellTypes_list->getFilterList() ?>;
	loadjs.done("fBellTypeslistsrch");
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
<?php if (!$BellTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($BellTypes_list->TotalRecords > 0 && $BellTypes_list->ExportOptions->visible()) { ?>
<?php $BellTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($BellTypes_list->ImportOptions->visible()) { ?>
<?php $BellTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($BellTypes_list->SearchOptions->visible()) { ?>
<?php $BellTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($BellTypes_list->FilterOptions->visible()) { ?>
<?php $BellTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$BellTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$BellTypes_list->isExport() && !$BellTypes->CurrentAction) { ?>
<form name="fBellTypeslistsrch" id="fBellTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fBellTypeslistsrch-search-panel" class="<?php echo $BellTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="BellTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $BellTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($BellTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($BellTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $BellTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($BellTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($BellTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($BellTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($BellTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $BellTypes_list->showPageHeader(); ?>
<?php
$BellTypes_list->showMessage();
?>
<?php if ($BellTypes_list->TotalRecords > 0 || $BellTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($BellTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> BellTypes">
<?php if (!$BellTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$BellTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $BellTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $BellTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fBellTypeslist" id="fBellTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="BellTypes">
<div id="gmp_BellTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($BellTypes_list->TotalRecords > 0 || $BellTypes_list->isAdd() || $BellTypes_list->isCopy() || $BellTypes_list->isGridEdit()) { ?>
<table id="tbl_BellTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$BellTypes->RowType = ROWTYPE_HEADER;

// Render list options
$BellTypes_list->renderListOptions();

// Render list options (header, left)
$BellTypes_list->ListOptions->render("header", "left");
?>
<?php if ($BellTypes_list->BellType_Idn->Visible) { // BellType_Idn ?>
	<?php if ($BellTypes_list->SortUrl($BellTypes_list->BellType_Idn) == "") { ?>
		<th data-name="BellType_Idn" class="<?php echo $BellTypes_list->BellType_Idn->headerCellClass() ?>"><div id="elh_BellTypes_BellType_Idn" class="BellTypes_BellType_Idn"><div class="ew-table-header-caption"><?php echo $BellTypes_list->BellType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BellType_Idn" class="<?php echo $BellTypes_list->BellType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BellTypes_list->SortUrl($BellTypes_list->BellType_Idn) ?>', 1);"><div id="elh_BellTypes_BellType_Idn" class="BellTypes_BellType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BellTypes_list->BellType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($BellTypes_list->BellType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BellTypes_list->BellType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BellTypes_list->Name->Visible) { // Name ?>
	<?php if ($BellTypes_list->SortUrl($BellTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $BellTypes_list->Name->headerCellClass() ?>"><div id="elh_BellTypes_Name" class="BellTypes_Name"><div class="ew-table-header-caption"><?php echo $BellTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $BellTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BellTypes_list->SortUrl($BellTypes_list->Name) ?>', 1);"><div id="elh_BellTypes_Name" class="BellTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BellTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($BellTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BellTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BellTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($BellTypes_list->SortUrl($BellTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $BellTypes_list->Rank->headerCellClass() ?>"><div id="elh_BellTypes_Rank" class="BellTypes_Rank"><div class="ew-table-header-caption"><?php echo $BellTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $BellTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BellTypes_list->SortUrl($BellTypes_list->Rank) ?>', 1);"><div id="elh_BellTypes_Rank" class="BellTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BellTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($BellTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BellTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BellTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($BellTypes_list->SortUrl($BellTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $BellTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_BellTypes_ActiveFlag" class="BellTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $BellTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $BellTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BellTypes_list->SortUrl($BellTypes_list->ActiveFlag) ?>', 1);"><div id="elh_BellTypes_ActiveFlag" class="BellTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BellTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($BellTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BellTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$BellTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($BellTypes_list->isAdd() || $BellTypes_list->isCopy()) {
		$BellTypes_list->RowIndex = 0;
		$BellTypes_list->KeyCount = $BellTypes_list->RowIndex;
		if ($BellTypes_list->isCopy() && !$BellTypes_list->loadRow())
			$BellTypes->CurrentAction = "add";
		if ($BellTypes_list->isAdd())
			$BellTypes_list->loadRowValues();
		if ($BellTypes->EventCancelled) // Insert failed
			$BellTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$BellTypes->resetAttributes();
		$BellTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_BellTypes", "data-rowtype" => ROWTYPE_ADD]);
		$BellTypes->RowType = ROWTYPE_ADD;

		// Render row
		$BellTypes_list->renderRow();

		// Render list options
		$BellTypes_list->renderListOptions();
		$BellTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $BellTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$BellTypes_list->ListOptions->render("body", "left", $BellTypes_list->RowCount);
?>
	<?php if ($BellTypes_list->BellType_Idn->Visible) { // BellType_Idn ?>
		<td data-name="BellType_Idn">
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_BellType_Idn" class="form-group BellTypes_BellType_Idn"></span>
<input type="hidden" data-table="BellTypes" data-field="x_BellType_Idn" name="o<?php echo $BellTypes_list->RowIndex ?>_BellType_Idn" id="o<?php echo $BellTypes_list->RowIndex ?>_BellType_Idn" value="<?php echo HtmlEncode($BellTypes_list->BellType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BellTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_Name" class="form-group BellTypes_Name">
<input type="text" data-table="BellTypes" data-field="x_Name" name="x<?php echo $BellTypes_list->RowIndex ?>_Name" id="x<?php echo $BellTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($BellTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $BellTypes_list->Name->EditValue ?>"<?php echo $BellTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="BellTypes" data-field="x_Name" name="o<?php echo $BellTypes_list->RowIndex ?>_Name" id="o<?php echo $BellTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($BellTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BellTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_Rank" class="form-group BellTypes_Rank">
<input type="text" data-table="BellTypes" data-field="x_Rank" name="x<?php echo $BellTypes_list->RowIndex ?>_Rank" id="x<?php echo $BellTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BellTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BellTypes_list->Rank->EditValue ?>"<?php echo $BellTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="BellTypes" data-field="x_Rank" name="o<?php echo $BellTypes_list->RowIndex ?>_Rank" id="o<?php echo $BellTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($BellTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BellTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_ActiveFlag" class="form-group BellTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($BellTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BellTypes" data-field="x_ActiveFlag" name="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]_233152" value="1"<?php echo $selwrk ?><?php echo $BellTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]_233152"></label>
</div>
</span>
<input type="hidden" data-table="BellTypes" data-field="x_ActiveFlag" name="o<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($BellTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$BellTypes_list->ListOptions->render("body", "right", $BellTypes_list->RowCount);
?>
<script>
loadjs.ready(["fBellTypeslist", "load"], function() {
	fBellTypeslist.updateLists(<?php echo $BellTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($BellTypes_list->ExportAll && $BellTypes_list->isExport()) {
	$BellTypes_list->StopRecord = $BellTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($BellTypes_list->TotalRecords > $BellTypes_list->StartRecord + $BellTypes_list->DisplayRecords - 1)
		$BellTypes_list->StopRecord = $BellTypes_list->StartRecord + $BellTypes_list->DisplayRecords - 1;
	else
		$BellTypes_list->StopRecord = $BellTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($BellTypes->isConfirm() || $BellTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($BellTypes_list->FormKeyCountName) && ($BellTypes_list->isGridAdd() || $BellTypes_list->isGridEdit() || $BellTypes->isConfirm())) {
		$BellTypes_list->KeyCount = $CurrentForm->getValue($BellTypes_list->FormKeyCountName);
		$BellTypes_list->StopRecord = $BellTypes_list->StartRecord + $BellTypes_list->KeyCount - 1;
	}
}
$BellTypes_list->RecordCount = $BellTypes_list->StartRecord - 1;
if ($BellTypes_list->Recordset && !$BellTypes_list->Recordset->EOF) {
	$BellTypes_list->Recordset->moveFirst();
	$selectLimit = $BellTypes_list->UseSelectLimit;
	if (!$selectLimit && $BellTypes_list->StartRecord > 1)
		$BellTypes_list->Recordset->move($BellTypes_list->StartRecord - 1);
} elseif (!$BellTypes->AllowAddDeleteRow && $BellTypes_list->StopRecord == 0) {
	$BellTypes_list->StopRecord = $BellTypes->GridAddRowCount;
}

// Initialize aggregate
$BellTypes->RowType = ROWTYPE_AGGREGATEINIT;
$BellTypes->resetAttributes();
$BellTypes_list->renderRow();
$BellTypes_list->EditRowCount = 0;
if ($BellTypes_list->isEdit())
	$BellTypes_list->RowIndex = 1;
if ($BellTypes_list->isGridAdd())
	$BellTypes_list->RowIndex = 0;
if ($BellTypes_list->isGridEdit())
	$BellTypes_list->RowIndex = 0;
while ($BellTypes_list->RecordCount < $BellTypes_list->StopRecord) {
	$BellTypes_list->RecordCount++;
	if ($BellTypes_list->RecordCount >= $BellTypes_list->StartRecord) {
		$BellTypes_list->RowCount++;
		if ($BellTypes_list->isGridAdd() || $BellTypes_list->isGridEdit() || $BellTypes->isConfirm()) {
			$BellTypes_list->RowIndex++;
			$CurrentForm->Index = $BellTypes_list->RowIndex;
			if ($CurrentForm->hasValue($BellTypes_list->FormActionName) && ($BellTypes->isConfirm() || $BellTypes_list->EventCancelled))
				$BellTypes_list->RowAction = strval($CurrentForm->getValue($BellTypes_list->FormActionName));
			elseif ($BellTypes_list->isGridAdd())
				$BellTypes_list->RowAction = "insert";
			else
				$BellTypes_list->RowAction = "";
		}

		// Set up key count
		$BellTypes_list->KeyCount = $BellTypes_list->RowIndex;

		// Init row class and style
		$BellTypes->resetAttributes();
		$BellTypes->CssClass = "";
		if ($BellTypes_list->isGridAdd()) {
			$BellTypes_list->loadRowValues(); // Load default values
		} else {
			$BellTypes_list->loadRowValues($BellTypes_list->Recordset); // Load row values
		}
		$BellTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($BellTypes_list->isGridAdd()) // Grid add
			$BellTypes->RowType = ROWTYPE_ADD; // Render add
		if ($BellTypes_list->isGridAdd() && $BellTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$BellTypes_list->restoreCurrentRowFormValues($BellTypes_list->RowIndex); // Restore form values
		if ($BellTypes_list->isEdit()) {
			if ($BellTypes_list->checkInlineEditKey() && $BellTypes_list->EditRowCount == 0) { // Inline edit
				$BellTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($BellTypes_list->isGridEdit()) { // Grid edit
			if ($BellTypes->EventCancelled)
				$BellTypes_list->restoreCurrentRowFormValues($BellTypes_list->RowIndex); // Restore form values
			if ($BellTypes_list->RowAction == "insert")
				$BellTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$BellTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($BellTypes_list->isEdit() && $BellTypes->RowType == ROWTYPE_EDIT && $BellTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$BellTypes_list->restoreFormValues(); // Restore form values
		}
		if ($BellTypes_list->isGridEdit() && ($BellTypes->RowType == ROWTYPE_EDIT || $BellTypes->RowType == ROWTYPE_ADD) && $BellTypes->EventCancelled) // Update failed
			$BellTypes_list->restoreCurrentRowFormValues($BellTypes_list->RowIndex); // Restore form values
		if ($BellTypes->RowType == ROWTYPE_EDIT) // Edit row
			$BellTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$BellTypes->RowAttrs->merge(["data-rowindex" => $BellTypes_list->RowCount, "id" => "r" . $BellTypes_list->RowCount . "_BellTypes", "data-rowtype" => $BellTypes->RowType]);

		// Render row
		$BellTypes_list->renderRow();

		// Render list options
		$BellTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($BellTypes_list->RowAction != "delete" && $BellTypes_list->RowAction != "insertdelete" && !($BellTypes_list->RowAction == "insert" && $BellTypes->isConfirm() && $BellTypes_list->emptyRow())) {
?>
	<tr <?php echo $BellTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$BellTypes_list->ListOptions->render("body", "left", $BellTypes_list->RowCount);
?>
	<?php if ($BellTypes_list->BellType_Idn->Visible) { // BellType_Idn ?>
		<td data-name="BellType_Idn" <?php echo $BellTypes_list->BellType_Idn->cellAttributes() ?>>
<?php if ($BellTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_BellType_Idn" class="form-group"></span>
<input type="hidden" data-table="BellTypes" data-field="x_BellType_Idn" name="o<?php echo $BellTypes_list->RowIndex ?>_BellType_Idn" id="o<?php echo $BellTypes_list->RowIndex ?>_BellType_Idn" value="<?php echo HtmlEncode($BellTypes_list->BellType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($BellTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_BellType_Idn" class="form-group">
<span<?php echo $BellTypes_list->BellType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($BellTypes_list->BellType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="BellTypes" data-field="x_BellType_Idn" name="x<?php echo $BellTypes_list->RowIndex ?>_BellType_Idn" id="x<?php echo $BellTypes_list->RowIndex ?>_BellType_Idn" value="<?php echo HtmlEncode($BellTypes_list->BellType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($BellTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_BellType_Idn">
<span<?php echo $BellTypes_list->BellType_Idn->viewAttributes() ?>><?php echo $BellTypes_list->BellType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BellTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $BellTypes_list->Name->cellAttributes() ?>>
<?php if ($BellTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_Name" class="form-group">
<input type="text" data-table="BellTypes" data-field="x_Name" name="x<?php echo $BellTypes_list->RowIndex ?>_Name" id="x<?php echo $BellTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($BellTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $BellTypes_list->Name->EditValue ?>"<?php echo $BellTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="BellTypes" data-field="x_Name" name="o<?php echo $BellTypes_list->RowIndex ?>_Name" id="o<?php echo $BellTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($BellTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($BellTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_Name" class="form-group">
<input type="text" data-table="BellTypes" data-field="x_Name" name="x<?php echo $BellTypes_list->RowIndex ?>_Name" id="x<?php echo $BellTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($BellTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $BellTypes_list->Name->EditValue ?>"<?php echo $BellTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($BellTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_Name">
<span<?php echo $BellTypes_list->Name->viewAttributes() ?>><?php echo $BellTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BellTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $BellTypes_list->Rank->cellAttributes() ?>>
<?php if ($BellTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_Rank" class="form-group">
<input type="text" data-table="BellTypes" data-field="x_Rank" name="x<?php echo $BellTypes_list->RowIndex ?>_Rank" id="x<?php echo $BellTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BellTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BellTypes_list->Rank->EditValue ?>"<?php echo $BellTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="BellTypes" data-field="x_Rank" name="o<?php echo $BellTypes_list->RowIndex ?>_Rank" id="o<?php echo $BellTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($BellTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($BellTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_Rank" class="form-group">
<input type="text" data-table="BellTypes" data-field="x_Rank" name="x<?php echo $BellTypes_list->RowIndex ?>_Rank" id="x<?php echo $BellTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BellTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BellTypes_list->Rank->EditValue ?>"<?php echo $BellTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($BellTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_Rank">
<span<?php echo $BellTypes_list->Rank->viewAttributes() ?>><?php echo $BellTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BellTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $BellTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($BellTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($BellTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BellTypes" data-field="x_ActiveFlag" name="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]_704991" value="1"<?php echo $selwrk ?><?php echo $BellTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]_704991"></label>
</div>
</span>
<input type="hidden" data-table="BellTypes" data-field="x_ActiveFlag" name="o<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($BellTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($BellTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($BellTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BellTypes" data-field="x_ActiveFlag" name="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]_482413" value="1"<?php echo $selwrk ?><?php echo $BellTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]_482413"></label>
</div>
</span>
<?php } ?>
<?php if ($BellTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BellTypes_list->RowCount ?>_BellTypes_ActiveFlag">
<span<?php echo $BellTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $BellTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($BellTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$BellTypes_list->ListOptions->render("body", "right", $BellTypes_list->RowCount);
?>
	</tr>
<?php if ($BellTypes->RowType == ROWTYPE_ADD || $BellTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fBellTypeslist", "load"], function() {
	fBellTypeslist.updateLists(<?php echo $BellTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$BellTypes_list->isGridAdd())
		if (!$BellTypes_list->Recordset->EOF)
			$BellTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($BellTypes_list->isGridAdd() || $BellTypes_list->isGridEdit()) {
		$BellTypes_list->RowIndex = '$rowindex$';
		$BellTypes_list->loadRowValues();

		// Set row properties
		$BellTypes->resetAttributes();
		$BellTypes->RowAttrs->merge(["data-rowindex" => $BellTypes_list->RowIndex, "id" => "r0_BellTypes", "data-rowtype" => ROWTYPE_ADD]);
		$BellTypes->RowAttrs->appendClass("ew-template");
		$BellTypes->RowType = ROWTYPE_ADD;

		// Render row
		$BellTypes_list->renderRow();

		// Render list options
		$BellTypes_list->renderListOptions();
		$BellTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $BellTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$BellTypes_list->ListOptions->render("body", "left", $BellTypes_list->RowIndex);
?>
	<?php if ($BellTypes_list->BellType_Idn->Visible) { // BellType_Idn ?>
		<td data-name="BellType_Idn">
<span id="el$rowindex$_BellTypes_BellType_Idn" class="form-group BellTypes_BellType_Idn"></span>
<input type="hidden" data-table="BellTypes" data-field="x_BellType_Idn" name="o<?php echo $BellTypes_list->RowIndex ?>_BellType_Idn" id="o<?php echo $BellTypes_list->RowIndex ?>_BellType_Idn" value="<?php echo HtmlEncode($BellTypes_list->BellType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BellTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_BellTypes_Name" class="form-group BellTypes_Name">
<input type="text" data-table="BellTypes" data-field="x_Name" name="x<?php echo $BellTypes_list->RowIndex ?>_Name" id="x<?php echo $BellTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($BellTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $BellTypes_list->Name->EditValue ?>"<?php echo $BellTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="BellTypes" data-field="x_Name" name="o<?php echo $BellTypes_list->RowIndex ?>_Name" id="o<?php echo $BellTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($BellTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BellTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_BellTypes_Rank" class="form-group BellTypes_Rank">
<input type="text" data-table="BellTypes" data-field="x_Rank" name="x<?php echo $BellTypes_list->RowIndex ?>_Rank" id="x<?php echo $BellTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BellTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BellTypes_list->Rank->EditValue ?>"<?php echo $BellTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="BellTypes" data-field="x_Rank" name="o<?php echo $BellTypes_list->RowIndex ?>_Rank" id="o<?php echo $BellTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($BellTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BellTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_BellTypes_ActiveFlag" class="form-group BellTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($BellTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BellTypes" data-field="x_ActiveFlag" name="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]_793094" value="1"<?php echo $selwrk ?><?php echo $BellTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]_793094"></label>
</div>
</span>
<input type="hidden" data-table="BellTypes" data-field="x_ActiveFlag" name="o<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $BellTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($BellTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$BellTypes_list->ListOptions->render("body", "right", $BellTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fBellTypeslist", "load"], function() {
	fBellTypeslist.updateLists(<?php echo $BellTypes_list->RowIndex ?>);
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
<?php if ($BellTypes_list->isAdd() || $BellTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $BellTypes_list->FormKeyCountName ?>" id="<?php echo $BellTypes_list->FormKeyCountName ?>" value="<?php echo $BellTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($BellTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $BellTypes_list->FormKeyCountName ?>" id="<?php echo $BellTypes_list->FormKeyCountName ?>" value="<?php echo $BellTypes_list->KeyCount ?>">
<?php echo $BellTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($BellTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $BellTypes_list->FormKeyCountName ?>" id="<?php echo $BellTypes_list->FormKeyCountName ?>" value="<?php echo $BellTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($BellTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $BellTypes_list->FormKeyCountName ?>" id="<?php echo $BellTypes_list->FormKeyCountName ?>" value="<?php echo $BellTypes_list->KeyCount ?>">
<?php echo $BellTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$BellTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($BellTypes_list->Recordset)
	$BellTypes_list->Recordset->Close();
?>
<?php if (!$BellTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$BellTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $BellTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $BellTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($BellTypes_list->TotalRecords == 0 && !$BellTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $BellTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$BellTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$BellTypes_list->isExport()) { ?>
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
$BellTypes_list->terminate();
?>