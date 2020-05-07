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
$RiserTypes_list = new RiserTypes_list();

// Run the page
$RiserTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RiserTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$RiserTypes_list->isExport()) { ?>
<script>
var fRiserTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fRiserTypeslist = currentForm = new ew.Form("fRiserTypeslist", "list");
	fRiserTypeslist.formKeyCountName = '<?php echo $RiserTypes_list->FormKeyCountName ?>';

	// Validate form
	fRiserTypeslist.validate = function() {
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
			<?php if ($RiserTypes_list->RiserType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RiserType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RiserTypes_list->RiserType_Idn->caption(), $RiserTypes_list->RiserType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RiserTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RiserTypes_list->Name->caption(), $RiserTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RiserTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RiserTypes_list->Rank->caption(), $RiserTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RiserTypes_list->Rank->errorMessage()) ?>");
			<?php if ($RiserTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RiserTypes_list->ActiveFlag->caption(), $RiserTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fRiserTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fRiserTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRiserTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRiserTypeslist.lists["x_ActiveFlag[]"] = <?php echo $RiserTypes_list->ActiveFlag->Lookup->toClientList($RiserTypes_list) ?>;
	fRiserTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($RiserTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fRiserTypeslist");
});
var fRiserTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fRiserTypeslistsrch = currentSearchForm = new ew.Form("fRiserTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fRiserTypeslistsrch.filterList = <?php echo $RiserTypes_list->getFilterList() ?>;
	loadjs.done("fRiserTypeslistsrch");
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
<?php if (!$RiserTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($RiserTypes_list->TotalRecords > 0 && $RiserTypes_list->ExportOptions->visible()) { ?>
<?php $RiserTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($RiserTypes_list->ImportOptions->visible()) { ?>
<?php $RiserTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($RiserTypes_list->SearchOptions->visible()) { ?>
<?php $RiserTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($RiserTypes_list->FilterOptions->visible()) { ?>
<?php $RiserTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$RiserTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$RiserTypes_list->isExport() && !$RiserTypes->CurrentAction) { ?>
<form name="fRiserTypeslistsrch" id="fRiserTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fRiserTypeslistsrch-search-panel" class="<?php echo $RiserTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="RiserTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $RiserTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($RiserTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($RiserTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $RiserTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($RiserTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($RiserTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($RiserTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($RiserTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $RiserTypes_list->showPageHeader(); ?>
<?php
$RiserTypes_list->showMessage();
?>
<?php if ($RiserTypes_list->TotalRecords > 0 || $RiserTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($RiserTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> RiserTypes">
<?php if (!$RiserTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$RiserTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RiserTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RiserTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fRiserTypeslist" id="fRiserTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RiserTypes">
<div id="gmp_RiserTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($RiserTypes_list->TotalRecords > 0 || $RiserTypes_list->isAdd() || $RiserTypes_list->isCopy() || $RiserTypes_list->isGridEdit()) { ?>
<table id="tbl_RiserTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$RiserTypes->RowType = ROWTYPE_HEADER;

// Render list options
$RiserTypes_list->renderListOptions();

// Render list options (header, left)
$RiserTypes_list->ListOptions->render("header", "left");
?>
<?php if ($RiserTypes_list->RiserType_Idn->Visible) { // RiserType_Idn ?>
	<?php if ($RiserTypes_list->SortUrl($RiserTypes_list->RiserType_Idn) == "") { ?>
		<th data-name="RiserType_Idn" class="<?php echo $RiserTypes_list->RiserType_Idn->headerCellClass() ?>"><div id="elh_RiserTypes_RiserType_Idn" class="RiserTypes_RiserType_Idn"><div class="ew-table-header-caption"><?php echo $RiserTypes_list->RiserType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RiserType_Idn" class="<?php echo $RiserTypes_list->RiserType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RiserTypes_list->SortUrl($RiserTypes_list->RiserType_Idn) ?>', 1);"><div id="elh_RiserTypes_RiserType_Idn" class="RiserTypes_RiserType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RiserTypes_list->RiserType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($RiserTypes_list->RiserType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RiserTypes_list->RiserType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RiserTypes_list->Name->Visible) { // Name ?>
	<?php if ($RiserTypes_list->SortUrl($RiserTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $RiserTypes_list->Name->headerCellClass() ?>"><div id="elh_RiserTypes_Name" class="RiserTypes_Name"><div class="ew-table-header-caption"><?php echo $RiserTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $RiserTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RiserTypes_list->SortUrl($RiserTypes_list->Name) ?>', 1);"><div id="elh_RiserTypes_Name" class="RiserTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RiserTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($RiserTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RiserTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RiserTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($RiserTypes_list->SortUrl($RiserTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $RiserTypes_list->Rank->headerCellClass() ?>"><div id="elh_RiserTypes_Rank" class="RiserTypes_Rank"><div class="ew-table-header-caption"><?php echo $RiserTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $RiserTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RiserTypes_list->SortUrl($RiserTypes_list->Rank) ?>', 1);"><div id="elh_RiserTypes_Rank" class="RiserTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RiserTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($RiserTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RiserTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RiserTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($RiserTypes_list->SortUrl($RiserTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $RiserTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_RiserTypes_ActiveFlag" class="RiserTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $RiserTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $RiserTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RiserTypes_list->SortUrl($RiserTypes_list->ActiveFlag) ?>', 1);"><div id="elh_RiserTypes_ActiveFlag" class="RiserTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RiserTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($RiserTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RiserTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$RiserTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($RiserTypes_list->isAdd() || $RiserTypes_list->isCopy()) {
		$RiserTypes_list->RowIndex = 0;
		$RiserTypes_list->KeyCount = $RiserTypes_list->RowIndex;
		if ($RiserTypes_list->isCopy() && !$RiserTypes_list->loadRow())
			$RiserTypes->CurrentAction = "add";
		if ($RiserTypes_list->isAdd())
			$RiserTypes_list->loadRowValues();
		if ($RiserTypes->EventCancelled) // Insert failed
			$RiserTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$RiserTypes->resetAttributes();
		$RiserTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_RiserTypes", "data-rowtype" => ROWTYPE_ADD]);
		$RiserTypes->RowType = ROWTYPE_ADD;

		// Render row
		$RiserTypes_list->renderRow();

		// Render list options
		$RiserTypes_list->renderListOptions();
		$RiserTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $RiserTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RiserTypes_list->ListOptions->render("body", "left", $RiserTypes_list->RowCount);
?>
	<?php if ($RiserTypes_list->RiserType_Idn->Visible) { // RiserType_Idn ?>
		<td data-name="RiserType_Idn">
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_RiserType_Idn" class="form-group RiserTypes_RiserType_Idn"></span>
<input type="hidden" data-table="RiserTypes" data-field="x_RiserType_Idn" name="o<?php echo $RiserTypes_list->RowIndex ?>_RiserType_Idn" id="o<?php echo $RiserTypes_list->RowIndex ?>_RiserType_Idn" value="<?php echo HtmlEncode($RiserTypes_list->RiserType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RiserTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_Name" class="form-group RiserTypes_Name">
<input type="text" data-table="RiserTypes" data-field="x_Name" name="x<?php echo $RiserTypes_list->RowIndex ?>_Name" id="x<?php echo $RiserTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RiserTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $RiserTypes_list->Name->EditValue ?>"<?php echo $RiserTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RiserTypes" data-field="x_Name" name="o<?php echo $RiserTypes_list->RowIndex ?>_Name" id="o<?php echo $RiserTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RiserTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RiserTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_Rank" class="form-group RiserTypes_Rank">
<input type="text" data-table="RiserTypes" data-field="x_Rank" name="x<?php echo $RiserTypes_list->RowIndex ?>_Rank" id="x<?php echo $RiserTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RiserTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RiserTypes_list->Rank->EditValue ?>"<?php echo $RiserTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RiserTypes" data-field="x_Rank" name="o<?php echo $RiserTypes_list->RowIndex ?>_Rank" id="o<?php echo $RiserTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RiserTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RiserTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_ActiveFlag" class="form-group RiserTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($RiserTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RiserTypes" data-field="x_ActiveFlag" name="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]_613412" value="1"<?php echo $selwrk ?><?php echo $RiserTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]_613412"></label>
</div>
</span>
<input type="hidden" data-table="RiserTypes" data-field="x_ActiveFlag" name="o<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RiserTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RiserTypes_list->ListOptions->render("body", "right", $RiserTypes_list->RowCount);
?>
<script>
loadjs.ready(["fRiserTypeslist", "load"], function() {
	fRiserTypeslist.updateLists(<?php echo $RiserTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($RiserTypes_list->ExportAll && $RiserTypes_list->isExport()) {
	$RiserTypes_list->StopRecord = $RiserTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($RiserTypes_list->TotalRecords > $RiserTypes_list->StartRecord + $RiserTypes_list->DisplayRecords - 1)
		$RiserTypes_list->StopRecord = $RiserTypes_list->StartRecord + $RiserTypes_list->DisplayRecords - 1;
	else
		$RiserTypes_list->StopRecord = $RiserTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($RiserTypes->isConfirm() || $RiserTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($RiserTypes_list->FormKeyCountName) && ($RiserTypes_list->isGridAdd() || $RiserTypes_list->isGridEdit() || $RiserTypes->isConfirm())) {
		$RiserTypes_list->KeyCount = $CurrentForm->getValue($RiserTypes_list->FormKeyCountName);
		$RiserTypes_list->StopRecord = $RiserTypes_list->StartRecord + $RiserTypes_list->KeyCount - 1;
	}
}
$RiserTypes_list->RecordCount = $RiserTypes_list->StartRecord - 1;
if ($RiserTypes_list->Recordset && !$RiserTypes_list->Recordset->EOF) {
	$RiserTypes_list->Recordset->moveFirst();
	$selectLimit = $RiserTypes_list->UseSelectLimit;
	if (!$selectLimit && $RiserTypes_list->StartRecord > 1)
		$RiserTypes_list->Recordset->move($RiserTypes_list->StartRecord - 1);
} elseif (!$RiserTypes->AllowAddDeleteRow && $RiserTypes_list->StopRecord == 0) {
	$RiserTypes_list->StopRecord = $RiserTypes->GridAddRowCount;
}

// Initialize aggregate
$RiserTypes->RowType = ROWTYPE_AGGREGATEINIT;
$RiserTypes->resetAttributes();
$RiserTypes_list->renderRow();
$RiserTypes_list->EditRowCount = 0;
if ($RiserTypes_list->isEdit())
	$RiserTypes_list->RowIndex = 1;
if ($RiserTypes_list->isGridAdd())
	$RiserTypes_list->RowIndex = 0;
if ($RiserTypes_list->isGridEdit())
	$RiserTypes_list->RowIndex = 0;
while ($RiserTypes_list->RecordCount < $RiserTypes_list->StopRecord) {
	$RiserTypes_list->RecordCount++;
	if ($RiserTypes_list->RecordCount >= $RiserTypes_list->StartRecord) {
		$RiserTypes_list->RowCount++;
		if ($RiserTypes_list->isGridAdd() || $RiserTypes_list->isGridEdit() || $RiserTypes->isConfirm()) {
			$RiserTypes_list->RowIndex++;
			$CurrentForm->Index = $RiserTypes_list->RowIndex;
			if ($CurrentForm->hasValue($RiserTypes_list->FormActionName) && ($RiserTypes->isConfirm() || $RiserTypes_list->EventCancelled))
				$RiserTypes_list->RowAction = strval($CurrentForm->getValue($RiserTypes_list->FormActionName));
			elseif ($RiserTypes_list->isGridAdd())
				$RiserTypes_list->RowAction = "insert";
			else
				$RiserTypes_list->RowAction = "";
		}

		// Set up key count
		$RiserTypes_list->KeyCount = $RiserTypes_list->RowIndex;

		// Init row class and style
		$RiserTypes->resetAttributes();
		$RiserTypes->CssClass = "";
		if ($RiserTypes_list->isGridAdd()) {
			$RiserTypes_list->loadRowValues(); // Load default values
		} else {
			$RiserTypes_list->loadRowValues($RiserTypes_list->Recordset); // Load row values
		}
		$RiserTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($RiserTypes_list->isGridAdd()) // Grid add
			$RiserTypes->RowType = ROWTYPE_ADD; // Render add
		if ($RiserTypes_list->isGridAdd() && $RiserTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$RiserTypes_list->restoreCurrentRowFormValues($RiserTypes_list->RowIndex); // Restore form values
		if ($RiserTypes_list->isEdit()) {
			if ($RiserTypes_list->checkInlineEditKey() && $RiserTypes_list->EditRowCount == 0) { // Inline edit
				$RiserTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($RiserTypes_list->isGridEdit()) { // Grid edit
			if ($RiserTypes->EventCancelled)
				$RiserTypes_list->restoreCurrentRowFormValues($RiserTypes_list->RowIndex); // Restore form values
			if ($RiserTypes_list->RowAction == "insert")
				$RiserTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$RiserTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($RiserTypes_list->isEdit() && $RiserTypes->RowType == ROWTYPE_EDIT && $RiserTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$RiserTypes_list->restoreFormValues(); // Restore form values
		}
		if ($RiserTypes_list->isGridEdit() && ($RiserTypes->RowType == ROWTYPE_EDIT || $RiserTypes->RowType == ROWTYPE_ADD) && $RiserTypes->EventCancelled) // Update failed
			$RiserTypes_list->restoreCurrentRowFormValues($RiserTypes_list->RowIndex); // Restore form values
		if ($RiserTypes->RowType == ROWTYPE_EDIT) // Edit row
			$RiserTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$RiserTypes->RowAttrs->merge(["data-rowindex" => $RiserTypes_list->RowCount, "id" => "r" . $RiserTypes_list->RowCount . "_RiserTypes", "data-rowtype" => $RiserTypes->RowType]);

		// Render row
		$RiserTypes_list->renderRow();

		// Render list options
		$RiserTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($RiserTypes_list->RowAction != "delete" && $RiserTypes_list->RowAction != "insertdelete" && !($RiserTypes_list->RowAction == "insert" && $RiserTypes->isConfirm() && $RiserTypes_list->emptyRow())) {
?>
	<tr <?php echo $RiserTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RiserTypes_list->ListOptions->render("body", "left", $RiserTypes_list->RowCount);
?>
	<?php if ($RiserTypes_list->RiserType_Idn->Visible) { // RiserType_Idn ?>
		<td data-name="RiserType_Idn" <?php echo $RiserTypes_list->RiserType_Idn->cellAttributes() ?>>
<?php if ($RiserTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_RiserType_Idn" class="form-group"></span>
<input type="hidden" data-table="RiserTypes" data-field="x_RiserType_Idn" name="o<?php echo $RiserTypes_list->RowIndex ?>_RiserType_Idn" id="o<?php echo $RiserTypes_list->RowIndex ?>_RiserType_Idn" value="<?php echo HtmlEncode($RiserTypes_list->RiserType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($RiserTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_RiserType_Idn" class="form-group">
<span<?php echo $RiserTypes_list->RiserType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($RiserTypes_list->RiserType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="RiserTypes" data-field="x_RiserType_Idn" name="x<?php echo $RiserTypes_list->RowIndex ?>_RiserType_Idn" id="x<?php echo $RiserTypes_list->RowIndex ?>_RiserType_Idn" value="<?php echo HtmlEncode($RiserTypes_list->RiserType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($RiserTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_RiserType_Idn">
<span<?php echo $RiserTypes_list->RiserType_Idn->viewAttributes() ?>><?php echo $RiserTypes_list->RiserType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RiserTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $RiserTypes_list->Name->cellAttributes() ?>>
<?php if ($RiserTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_Name" class="form-group">
<input type="text" data-table="RiserTypes" data-field="x_Name" name="x<?php echo $RiserTypes_list->RowIndex ?>_Name" id="x<?php echo $RiserTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RiserTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $RiserTypes_list->Name->EditValue ?>"<?php echo $RiserTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RiserTypes" data-field="x_Name" name="o<?php echo $RiserTypes_list->RowIndex ?>_Name" id="o<?php echo $RiserTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RiserTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($RiserTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_Name" class="form-group">
<input type="text" data-table="RiserTypes" data-field="x_Name" name="x<?php echo $RiserTypes_list->RowIndex ?>_Name" id="x<?php echo $RiserTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RiserTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $RiserTypes_list->Name->EditValue ?>"<?php echo $RiserTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($RiserTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_Name">
<span<?php echo $RiserTypes_list->Name->viewAttributes() ?>><?php echo $RiserTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RiserTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $RiserTypes_list->Rank->cellAttributes() ?>>
<?php if ($RiserTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_Rank" class="form-group">
<input type="text" data-table="RiserTypes" data-field="x_Rank" name="x<?php echo $RiserTypes_list->RowIndex ?>_Rank" id="x<?php echo $RiserTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RiserTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RiserTypes_list->Rank->EditValue ?>"<?php echo $RiserTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RiserTypes" data-field="x_Rank" name="o<?php echo $RiserTypes_list->RowIndex ?>_Rank" id="o<?php echo $RiserTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RiserTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($RiserTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_Rank" class="form-group">
<input type="text" data-table="RiserTypes" data-field="x_Rank" name="x<?php echo $RiserTypes_list->RowIndex ?>_Rank" id="x<?php echo $RiserTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RiserTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RiserTypes_list->Rank->EditValue ?>"<?php echo $RiserTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($RiserTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_Rank">
<span<?php echo $RiserTypes_list->Rank->viewAttributes() ?>><?php echo $RiserTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RiserTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $RiserTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($RiserTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RiserTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RiserTypes" data-field="x_ActiveFlag" name="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]_313079" value="1"<?php echo $selwrk ?><?php echo $RiserTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]_313079"></label>
</div>
</span>
<input type="hidden" data-table="RiserTypes" data-field="x_ActiveFlag" name="o<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RiserTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($RiserTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RiserTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RiserTypes" data-field="x_ActiveFlag" name="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]_381822" value="1"<?php echo $selwrk ?><?php echo $RiserTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]_381822"></label>
</div>
</span>
<?php } ?>
<?php if ($RiserTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RiserTypes_list->RowCount ?>_RiserTypes_ActiveFlag">
<span<?php echo $RiserTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $RiserTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RiserTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RiserTypes_list->ListOptions->render("body", "right", $RiserTypes_list->RowCount);
?>
	</tr>
<?php if ($RiserTypes->RowType == ROWTYPE_ADD || $RiserTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fRiserTypeslist", "load"], function() {
	fRiserTypeslist.updateLists(<?php echo $RiserTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$RiserTypes_list->isGridAdd())
		if (!$RiserTypes_list->Recordset->EOF)
			$RiserTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($RiserTypes_list->isGridAdd() || $RiserTypes_list->isGridEdit()) {
		$RiserTypes_list->RowIndex = '$rowindex$';
		$RiserTypes_list->loadRowValues();

		// Set row properties
		$RiserTypes->resetAttributes();
		$RiserTypes->RowAttrs->merge(["data-rowindex" => $RiserTypes_list->RowIndex, "id" => "r0_RiserTypes", "data-rowtype" => ROWTYPE_ADD]);
		$RiserTypes->RowAttrs->appendClass("ew-template");
		$RiserTypes->RowType = ROWTYPE_ADD;

		// Render row
		$RiserTypes_list->renderRow();

		// Render list options
		$RiserTypes_list->renderListOptions();
		$RiserTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $RiserTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RiserTypes_list->ListOptions->render("body", "left", $RiserTypes_list->RowIndex);
?>
	<?php if ($RiserTypes_list->RiserType_Idn->Visible) { // RiserType_Idn ?>
		<td data-name="RiserType_Idn">
<span id="el$rowindex$_RiserTypes_RiserType_Idn" class="form-group RiserTypes_RiserType_Idn"></span>
<input type="hidden" data-table="RiserTypes" data-field="x_RiserType_Idn" name="o<?php echo $RiserTypes_list->RowIndex ?>_RiserType_Idn" id="o<?php echo $RiserTypes_list->RowIndex ?>_RiserType_Idn" value="<?php echo HtmlEncode($RiserTypes_list->RiserType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RiserTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_RiserTypes_Name" class="form-group RiserTypes_Name">
<input type="text" data-table="RiserTypes" data-field="x_Name" name="x<?php echo $RiserTypes_list->RowIndex ?>_Name" id="x<?php echo $RiserTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RiserTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $RiserTypes_list->Name->EditValue ?>"<?php echo $RiserTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RiserTypes" data-field="x_Name" name="o<?php echo $RiserTypes_list->RowIndex ?>_Name" id="o<?php echo $RiserTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RiserTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RiserTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_RiserTypes_Rank" class="form-group RiserTypes_Rank">
<input type="text" data-table="RiserTypes" data-field="x_Rank" name="x<?php echo $RiserTypes_list->RowIndex ?>_Rank" id="x<?php echo $RiserTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RiserTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RiserTypes_list->Rank->EditValue ?>"<?php echo $RiserTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RiserTypes" data-field="x_Rank" name="o<?php echo $RiserTypes_list->RowIndex ?>_Rank" id="o<?php echo $RiserTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RiserTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RiserTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_RiserTypes_ActiveFlag" class="form-group RiserTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($RiserTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RiserTypes" data-field="x_ActiveFlag" name="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]_371507" value="1"<?php echo $selwrk ?><?php echo $RiserTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]_371507"></label>
</div>
</span>
<input type="hidden" data-table="RiserTypes" data-field="x_ActiveFlag" name="o<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RiserTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RiserTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RiserTypes_list->ListOptions->render("body", "right", $RiserTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fRiserTypeslist", "load"], function() {
	fRiserTypeslist.updateLists(<?php echo $RiserTypes_list->RowIndex ?>);
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
<?php if ($RiserTypes_list->isAdd() || $RiserTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $RiserTypes_list->FormKeyCountName ?>" id="<?php echo $RiserTypes_list->FormKeyCountName ?>" value="<?php echo $RiserTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($RiserTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $RiserTypes_list->FormKeyCountName ?>" id="<?php echo $RiserTypes_list->FormKeyCountName ?>" value="<?php echo $RiserTypes_list->KeyCount ?>">
<?php echo $RiserTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($RiserTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $RiserTypes_list->FormKeyCountName ?>" id="<?php echo $RiserTypes_list->FormKeyCountName ?>" value="<?php echo $RiserTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($RiserTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $RiserTypes_list->FormKeyCountName ?>" id="<?php echo $RiserTypes_list->FormKeyCountName ?>" value="<?php echo $RiserTypes_list->KeyCount ?>">
<?php echo $RiserTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$RiserTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($RiserTypes_list->Recordset)
	$RiserTypes_list->Recordset->Close();
?>
<?php if (!$RiserTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$RiserTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RiserTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RiserTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($RiserTypes_list->TotalRecords == 0 && !$RiserTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $RiserTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$RiserTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$RiserTypes_list->isExport()) { ?>
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
$RiserTypes_list->terminate();
?>