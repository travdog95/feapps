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
$GPMs_list = new GPMs_list();

// Run the page
$GPMs_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GPMs_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$GPMs_list->isExport()) { ?>
<script>
var fGPMslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fGPMslist = currentForm = new ew.Form("fGPMslist", "list");
	fGPMslist.formKeyCountName = '<?php echo $GPMs_list->FormKeyCountName ?>';

	// Validate form
	fGPMslist.validate = function() {
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
			<?php if ($GPMs_list->GPM_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GPM_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GPMs_list->GPM_Idn->caption(), $GPMs_list->GPM_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GPMs_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GPMs_list->Name->caption(), $GPMs_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GPMs_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GPMs_list->Rank->caption(), $GPMs_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($GPMs_list->Rank->errorMessage()) ?>");
			<?php if ($GPMs_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GPMs_list->ActiveFlag->caption(), $GPMs_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fGPMslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fGPMslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fGPMslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fGPMslist.lists["x_ActiveFlag[]"] = <?php echo $GPMs_list->ActiveFlag->Lookup->toClientList($GPMs_list) ?>;
	fGPMslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($GPMs_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fGPMslist");
});
var fGPMslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fGPMslistsrch = currentSearchForm = new ew.Form("fGPMslistsrch");

	// Dynamic selection lists
	// Filters

	fGPMslistsrch.filterList = <?php echo $GPMs_list->getFilterList() ?>;
	loadjs.done("fGPMslistsrch");
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
<?php if (!$GPMs_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($GPMs_list->TotalRecords > 0 && $GPMs_list->ExportOptions->visible()) { ?>
<?php $GPMs_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($GPMs_list->ImportOptions->visible()) { ?>
<?php $GPMs_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($GPMs_list->SearchOptions->visible()) { ?>
<?php $GPMs_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($GPMs_list->FilterOptions->visible()) { ?>
<?php $GPMs_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$GPMs_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$GPMs_list->isExport() && !$GPMs->CurrentAction) { ?>
<form name="fGPMslistsrch" id="fGPMslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fGPMslistsrch-search-panel" class="<?php echo $GPMs_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="GPMs">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $GPMs_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($GPMs_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($GPMs_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $GPMs_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($GPMs_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($GPMs_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($GPMs_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($GPMs_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $GPMs_list->showPageHeader(); ?>
<?php
$GPMs_list->showMessage();
?>
<?php if ($GPMs_list->TotalRecords > 0 || $GPMs->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($GPMs_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> GPMs">
<?php if (!$GPMs_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$GPMs_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GPMs_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $GPMs_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fGPMslist" id="fGPMslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GPMs">
<div id="gmp_GPMs" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($GPMs_list->TotalRecords > 0 || $GPMs_list->isAdd() || $GPMs_list->isCopy() || $GPMs_list->isGridEdit()) { ?>
<table id="tbl_GPMslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$GPMs->RowType = ROWTYPE_HEADER;

// Render list options
$GPMs_list->renderListOptions();

// Render list options (header, left)
$GPMs_list->ListOptions->render("header", "left");
?>
<?php if ($GPMs_list->GPM_Idn->Visible) { // GPM_Idn ?>
	<?php if ($GPMs_list->SortUrl($GPMs_list->GPM_Idn) == "") { ?>
		<th data-name="GPM_Idn" class="<?php echo $GPMs_list->GPM_Idn->headerCellClass() ?>"><div id="elh_GPMs_GPM_Idn" class="GPMs_GPM_Idn"><div class="ew-table-header-caption"><?php echo $GPMs_list->GPM_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GPM_Idn" class="<?php echo $GPMs_list->GPM_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GPMs_list->SortUrl($GPMs_list->GPM_Idn) ?>', 1);"><div id="elh_GPMs_GPM_Idn" class="GPMs_GPM_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GPMs_list->GPM_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($GPMs_list->GPM_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GPMs_list->GPM_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($GPMs_list->Name->Visible) { // Name ?>
	<?php if ($GPMs_list->SortUrl($GPMs_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $GPMs_list->Name->headerCellClass() ?>"><div id="elh_GPMs_Name" class="GPMs_Name"><div class="ew-table-header-caption"><?php echo $GPMs_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $GPMs_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GPMs_list->SortUrl($GPMs_list->Name) ?>', 1);"><div id="elh_GPMs_Name" class="GPMs_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GPMs_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($GPMs_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GPMs_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($GPMs_list->Rank->Visible) { // Rank ?>
	<?php if ($GPMs_list->SortUrl($GPMs_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $GPMs_list->Rank->headerCellClass() ?>"><div id="elh_GPMs_Rank" class="GPMs_Rank"><div class="ew-table-header-caption"><?php echo $GPMs_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $GPMs_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GPMs_list->SortUrl($GPMs_list->Rank) ?>', 1);"><div id="elh_GPMs_Rank" class="GPMs_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GPMs_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($GPMs_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GPMs_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($GPMs_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($GPMs_list->SortUrl($GPMs_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $GPMs_list->ActiveFlag->headerCellClass() ?>"><div id="elh_GPMs_ActiveFlag" class="GPMs_ActiveFlag"><div class="ew-table-header-caption"><?php echo $GPMs_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $GPMs_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GPMs_list->SortUrl($GPMs_list->ActiveFlag) ?>', 1);"><div id="elh_GPMs_ActiveFlag" class="GPMs_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GPMs_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($GPMs_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GPMs_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$GPMs_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($GPMs_list->isAdd() || $GPMs_list->isCopy()) {
		$GPMs_list->RowIndex = 0;
		$GPMs_list->KeyCount = $GPMs_list->RowIndex;
		if ($GPMs_list->isCopy() && !$GPMs_list->loadRow())
			$GPMs->CurrentAction = "add";
		if ($GPMs_list->isAdd())
			$GPMs_list->loadRowValues();
		if ($GPMs->EventCancelled) // Insert failed
			$GPMs_list->restoreFormValues(); // Restore form values

		// Set row properties
		$GPMs->resetAttributes();
		$GPMs->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_GPMs", "data-rowtype" => ROWTYPE_ADD]);
		$GPMs->RowType = ROWTYPE_ADD;

		// Render row
		$GPMs_list->renderRow();

		// Render list options
		$GPMs_list->renderListOptions();
		$GPMs_list->StartRowCount = 0;
?>
	<tr <?php echo $GPMs->rowAttributes() ?>>
<?php

// Render list options (body, left)
$GPMs_list->ListOptions->render("body", "left", $GPMs_list->RowCount);
?>
	<?php if ($GPMs_list->GPM_Idn->Visible) { // GPM_Idn ?>
		<td data-name="GPM_Idn">
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_GPM_Idn" class="form-group GPMs_GPM_Idn"></span>
<input type="hidden" data-table="GPMs" data-field="x_GPM_Idn" name="o<?php echo $GPMs_list->RowIndex ?>_GPM_Idn" id="o<?php echo $GPMs_list->RowIndex ?>_GPM_Idn" value="<?php echo HtmlEncode($GPMs_list->GPM_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GPMs_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_Name" class="form-group GPMs_Name">
<input type="text" data-table="GPMs" data-field="x_Name" name="x<?php echo $GPMs_list->RowIndex ?>_Name" id="x<?php echo $GPMs_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GPMs_list->Name->getPlaceHolder()) ?>" value="<?php echo $GPMs_list->Name->EditValue ?>"<?php echo $GPMs_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="GPMs" data-field="x_Name" name="o<?php echo $GPMs_list->RowIndex ?>_Name" id="o<?php echo $GPMs_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($GPMs_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GPMs_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_Rank" class="form-group GPMs_Rank">
<input type="text" data-table="GPMs" data-field="x_Rank" name="x<?php echo $GPMs_list->RowIndex ?>_Rank" id="x<?php echo $GPMs_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GPMs_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GPMs_list->Rank->EditValue ?>"<?php echo $GPMs_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="GPMs" data-field="x_Rank" name="o<?php echo $GPMs_list->RowIndex ?>_Rank" id="o<?php echo $GPMs_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($GPMs_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GPMs_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_ActiveFlag" class="form-group GPMs_ActiveFlag">
<?php
$selwrk = ConvertToBool($GPMs_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GPMs" data-field="x_ActiveFlag" name="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]_296152" value="1"<?php echo $selwrk ?><?php echo $GPMs_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]_296152"></label>
</div>
</span>
<input type="hidden" data-table="GPMs" data-field="x_ActiveFlag" name="o<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($GPMs_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$GPMs_list->ListOptions->render("body", "right", $GPMs_list->RowCount);
?>
<script>
loadjs.ready(["fGPMslist", "load"], function() {
	fGPMslist.updateLists(<?php echo $GPMs_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($GPMs_list->ExportAll && $GPMs_list->isExport()) {
	$GPMs_list->StopRecord = $GPMs_list->TotalRecords;
} else {

	// Set the last record to display
	if ($GPMs_list->TotalRecords > $GPMs_list->StartRecord + $GPMs_list->DisplayRecords - 1)
		$GPMs_list->StopRecord = $GPMs_list->StartRecord + $GPMs_list->DisplayRecords - 1;
	else
		$GPMs_list->StopRecord = $GPMs_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($GPMs->isConfirm() || $GPMs_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($GPMs_list->FormKeyCountName) && ($GPMs_list->isGridAdd() || $GPMs_list->isGridEdit() || $GPMs->isConfirm())) {
		$GPMs_list->KeyCount = $CurrentForm->getValue($GPMs_list->FormKeyCountName);
		$GPMs_list->StopRecord = $GPMs_list->StartRecord + $GPMs_list->KeyCount - 1;
	}
}
$GPMs_list->RecordCount = $GPMs_list->StartRecord - 1;
if ($GPMs_list->Recordset && !$GPMs_list->Recordset->EOF) {
	$GPMs_list->Recordset->moveFirst();
	$selectLimit = $GPMs_list->UseSelectLimit;
	if (!$selectLimit && $GPMs_list->StartRecord > 1)
		$GPMs_list->Recordset->move($GPMs_list->StartRecord - 1);
} elseif (!$GPMs->AllowAddDeleteRow && $GPMs_list->StopRecord == 0) {
	$GPMs_list->StopRecord = $GPMs->GridAddRowCount;
}

// Initialize aggregate
$GPMs->RowType = ROWTYPE_AGGREGATEINIT;
$GPMs->resetAttributes();
$GPMs_list->renderRow();
$GPMs_list->EditRowCount = 0;
if ($GPMs_list->isEdit())
	$GPMs_list->RowIndex = 1;
if ($GPMs_list->isGridAdd())
	$GPMs_list->RowIndex = 0;
if ($GPMs_list->isGridEdit())
	$GPMs_list->RowIndex = 0;
while ($GPMs_list->RecordCount < $GPMs_list->StopRecord) {
	$GPMs_list->RecordCount++;
	if ($GPMs_list->RecordCount >= $GPMs_list->StartRecord) {
		$GPMs_list->RowCount++;
		if ($GPMs_list->isGridAdd() || $GPMs_list->isGridEdit() || $GPMs->isConfirm()) {
			$GPMs_list->RowIndex++;
			$CurrentForm->Index = $GPMs_list->RowIndex;
			if ($CurrentForm->hasValue($GPMs_list->FormActionName) && ($GPMs->isConfirm() || $GPMs_list->EventCancelled))
				$GPMs_list->RowAction = strval($CurrentForm->getValue($GPMs_list->FormActionName));
			elseif ($GPMs_list->isGridAdd())
				$GPMs_list->RowAction = "insert";
			else
				$GPMs_list->RowAction = "";
		}

		// Set up key count
		$GPMs_list->KeyCount = $GPMs_list->RowIndex;

		// Init row class and style
		$GPMs->resetAttributes();
		$GPMs->CssClass = "";
		if ($GPMs_list->isGridAdd()) {
			$GPMs_list->loadRowValues(); // Load default values
		} else {
			$GPMs_list->loadRowValues($GPMs_list->Recordset); // Load row values
		}
		$GPMs->RowType = ROWTYPE_VIEW; // Render view
		if ($GPMs_list->isGridAdd()) // Grid add
			$GPMs->RowType = ROWTYPE_ADD; // Render add
		if ($GPMs_list->isGridAdd() && $GPMs->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$GPMs_list->restoreCurrentRowFormValues($GPMs_list->RowIndex); // Restore form values
		if ($GPMs_list->isEdit()) {
			if ($GPMs_list->checkInlineEditKey() && $GPMs_list->EditRowCount == 0) { // Inline edit
				$GPMs->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($GPMs_list->isGridEdit()) { // Grid edit
			if ($GPMs->EventCancelled)
				$GPMs_list->restoreCurrentRowFormValues($GPMs_list->RowIndex); // Restore form values
			if ($GPMs_list->RowAction == "insert")
				$GPMs->RowType = ROWTYPE_ADD; // Render add
			else
				$GPMs->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($GPMs_list->isEdit() && $GPMs->RowType == ROWTYPE_EDIT && $GPMs->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$GPMs_list->restoreFormValues(); // Restore form values
		}
		if ($GPMs_list->isGridEdit() && ($GPMs->RowType == ROWTYPE_EDIT || $GPMs->RowType == ROWTYPE_ADD) && $GPMs->EventCancelled) // Update failed
			$GPMs_list->restoreCurrentRowFormValues($GPMs_list->RowIndex); // Restore form values
		if ($GPMs->RowType == ROWTYPE_EDIT) // Edit row
			$GPMs_list->EditRowCount++;

		// Set up row id / data-rowindex
		$GPMs->RowAttrs->merge(["data-rowindex" => $GPMs_list->RowCount, "id" => "r" . $GPMs_list->RowCount . "_GPMs", "data-rowtype" => $GPMs->RowType]);

		// Render row
		$GPMs_list->renderRow();

		// Render list options
		$GPMs_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($GPMs_list->RowAction != "delete" && $GPMs_list->RowAction != "insertdelete" && !($GPMs_list->RowAction == "insert" && $GPMs->isConfirm() && $GPMs_list->emptyRow())) {
?>
	<tr <?php echo $GPMs->rowAttributes() ?>>
<?php

// Render list options (body, left)
$GPMs_list->ListOptions->render("body", "left", $GPMs_list->RowCount);
?>
	<?php if ($GPMs_list->GPM_Idn->Visible) { // GPM_Idn ?>
		<td data-name="GPM_Idn" <?php echo $GPMs_list->GPM_Idn->cellAttributes() ?>>
<?php if ($GPMs->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_GPM_Idn" class="form-group"></span>
<input type="hidden" data-table="GPMs" data-field="x_GPM_Idn" name="o<?php echo $GPMs_list->RowIndex ?>_GPM_Idn" id="o<?php echo $GPMs_list->RowIndex ?>_GPM_Idn" value="<?php echo HtmlEncode($GPMs_list->GPM_Idn->OldValue) ?>">
<?php } ?>
<?php if ($GPMs->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_GPM_Idn" class="form-group">
<span<?php echo $GPMs_list->GPM_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($GPMs_list->GPM_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="GPMs" data-field="x_GPM_Idn" name="x<?php echo $GPMs_list->RowIndex ?>_GPM_Idn" id="x<?php echo $GPMs_list->RowIndex ?>_GPM_Idn" value="<?php echo HtmlEncode($GPMs_list->GPM_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($GPMs->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_GPM_Idn">
<span<?php echo $GPMs_list->GPM_Idn->viewAttributes() ?>><?php echo $GPMs_list->GPM_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($GPMs_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $GPMs_list->Name->cellAttributes() ?>>
<?php if ($GPMs->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_Name" class="form-group">
<input type="text" data-table="GPMs" data-field="x_Name" name="x<?php echo $GPMs_list->RowIndex ?>_Name" id="x<?php echo $GPMs_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GPMs_list->Name->getPlaceHolder()) ?>" value="<?php echo $GPMs_list->Name->EditValue ?>"<?php echo $GPMs_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="GPMs" data-field="x_Name" name="o<?php echo $GPMs_list->RowIndex ?>_Name" id="o<?php echo $GPMs_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($GPMs_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($GPMs->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_Name" class="form-group">
<input type="text" data-table="GPMs" data-field="x_Name" name="x<?php echo $GPMs_list->RowIndex ?>_Name" id="x<?php echo $GPMs_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GPMs_list->Name->getPlaceHolder()) ?>" value="<?php echo $GPMs_list->Name->EditValue ?>"<?php echo $GPMs_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($GPMs->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_Name">
<span<?php echo $GPMs_list->Name->viewAttributes() ?>><?php echo $GPMs_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($GPMs_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $GPMs_list->Rank->cellAttributes() ?>>
<?php if ($GPMs->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_Rank" class="form-group">
<input type="text" data-table="GPMs" data-field="x_Rank" name="x<?php echo $GPMs_list->RowIndex ?>_Rank" id="x<?php echo $GPMs_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GPMs_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GPMs_list->Rank->EditValue ?>"<?php echo $GPMs_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="GPMs" data-field="x_Rank" name="o<?php echo $GPMs_list->RowIndex ?>_Rank" id="o<?php echo $GPMs_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($GPMs_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($GPMs->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_Rank" class="form-group">
<input type="text" data-table="GPMs" data-field="x_Rank" name="x<?php echo $GPMs_list->RowIndex ?>_Rank" id="x<?php echo $GPMs_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GPMs_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GPMs_list->Rank->EditValue ?>"<?php echo $GPMs_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($GPMs->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_Rank">
<span<?php echo $GPMs_list->Rank->viewAttributes() ?>><?php echo $GPMs_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($GPMs_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $GPMs_list->ActiveFlag->cellAttributes() ?>>
<?php if ($GPMs->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($GPMs_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GPMs" data-field="x_ActiveFlag" name="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]_902397" value="1"<?php echo $selwrk ?><?php echo $GPMs_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]_902397"></label>
</div>
</span>
<input type="hidden" data-table="GPMs" data-field="x_ActiveFlag" name="o<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($GPMs_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($GPMs->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($GPMs_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GPMs" data-field="x_ActiveFlag" name="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]_378271" value="1"<?php echo $selwrk ?><?php echo $GPMs_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]_378271"></label>
</div>
</span>
<?php } ?>
<?php if ($GPMs->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GPMs_list->RowCount ?>_GPMs_ActiveFlag">
<span<?php echo $GPMs_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $GPMs_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($GPMs_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$GPMs_list->ListOptions->render("body", "right", $GPMs_list->RowCount);
?>
	</tr>
<?php if ($GPMs->RowType == ROWTYPE_ADD || $GPMs->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fGPMslist", "load"], function() {
	fGPMslist.updateLists(<?php echo $GPMs_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$GPMs_list->isGridAdd())
		if (!$GPMs_list->Recordset->EOF)
			$GPMs_list->Recordset->moveNext();
}
?>
<?php
	if ($GPMs_list->isGridAdd() || $GPMs_list->isGridEdit()) {
		$GPMs_list->RowIndex = '$rowindex$';
		$GPMs_list->loadRowValues();

		// Set row properties
		$GPMs->resetAttributes();
		$GPMs->RowAttrs->merge(["data-rowindex" => $GPMs_list->RowIndex, "id" => "r0_GPMs", "data-rowtype" => ROWTYPE_ADD]);
		$GPMs->RowAttrs->appendClass("ew-template");
		$GPMs->RowType = ROWTYPE_ADD;

		// Render row
		$GPMs_list->renderRow();

		// Render list options
		$GPMs_list->renderListOptions();
		$GPMs_list->StartRowCount = 0;
?>
	<tr <?php echo $GPMs->rowAttributes() ?>>
<?php

// Render list options (body, left)
$GPMs_list->ListOptions->render("body", "left", $GPMs_list->RowIndex);
?>
	<?php if ($GPMs_list->GPM_Idn->Visible) { // GPM_Idn ?>
		<td data-name="GPM_Idn">
<span id="el$rowindex$_GPMs_GPM_Idn" class="form-group GPMs_GPM_Idn"></span>
<input type="hidden" data-table="GPMs" data-field="x_GPM_Idn" name="o<?php echo $GPMs_list->RowIndex ?>_GPM_Idn" id="o<?php echo $GPMs_list->RowIndex ?>_GPM_Idn" value="<?php echo HtmlEncode($GPMs_list->GPM_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GPMs_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_GPMs_Name" class="form-group GPMs_Name">
<input type="text" data-table="GPMs" data-field="x_Name" name="x<?php echo $GPMs_list->RowIndex ?>_Name" id="x<?php echo $GPMs_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GPMs_list->Name->getPlaceHolder()) ?>" value="<?php echo $GPMs_list->Name->EditValue ?>"<?php echo $GPMs_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="GPMs" data-field="x_Name" name="o<?php echo $GPMs_list->RowIndex ?>_Name" id="o<?php echo $GPMs_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($GPMs_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GPMs_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_GPMs_Rank" class="form-group GPMs_Rank">
<input type="text" data-table="GPMs" data-field="x_Rank" name="x<?php echo $GPMs_list->RowIndex ?>_Rank" id="x<?php echo $GPMs_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GPMs_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GPMs_list->Rank->EditValue ?>"<?php echo $GPMs_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="GPMs" data-field="x_Rank" name="o<?php echo $GPMs_list->RowIndex ?>_Rank" id="o<?php echo $GPMs_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($GPMs_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GPMs_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_GPMs_ActiveFlag" class="form-group GPMs_ActiveFlag">
<?php
$selwrk = ConvertToBool($GPMs_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GPMs" data-field="x_ActiveFlag" name="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]_918173" value="1"<?php echo $selwrk ?><?php echo $GPMs_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]_918173"></label>
</div>
</span>
<input type="hidden" data-table="GPMs" data-field="x_ActiveFlag" name="o<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $GPMs_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($GPMs_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$GPMs_list->ListOptions->render("body", "right", $GPMs_list->RowIndex);
?>
<script>
loadjs.ready(["fGPMslist", "load"], function() {
	fGPMslist.updateLists(<?php echo $GPMs_list->RowIndex ?>);
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
<?php if ($GPMs_list->isAdd() || $GPMs_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $GPMs_list->FormKeyCountName ?>" id="<?php echo $GPMs_list->FormKeyCountName ?>" value="<?php echo $GPMs_list->KeyCount ?>">
<?php } ?>
<?php if ($GPMs_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $GPMs_list->FormKeyCountName ?>" id="<?php echo $GPMs_list->FormKeyCountName ?>" value="<?php echo $GPMs_list->KeyCount ?>">
<?php echo $GPMs_list->MultiSelectKey ?>
<?php } ?>
<?php if ($GPMs_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $GPMs_list->FormKeyCountName ?>" id="<?php echo $GPMs_list->FormKeyCountName ?>" value="<?php echo $GPMs_list->KeyCount ?>">
<?php } ?>
<?php if ($GPMs_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $GPMs_list->FormKeyCountName ?>" id="<?php echo $GPMs_list->FormKeyCountName ?>" value="<?php echo $GPMs_list->KeyCount ?>">
<?php echo $GPMs_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$GPMs->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($GPMs_list->Recordset)
	$GPMs_list->Recordset->Close();
?>
<?php if (!$GPMs_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$GPMs_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GPMs_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $GPMs_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($GPMs_list->TotalRecords == 0 && !$GPMs->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $GPMs_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$GPMs_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$GPMs_list->isExport()) { ?>
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
$GPMs_list->terminate();
?>