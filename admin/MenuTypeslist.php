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
$MenuTypes_list = new MenuTypes_list();

// Run the page
$MenuTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$MenuTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$MenuTypes_list->isExport()) { ?>
<script>
var fMenuTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fMenuTypeslist = currentForm = new ew.Form("fMenuTypeslist", "list");
	fMenuTypeslist.formKeyCountName = '<?php echo $MenuTypes_list->FormKeyCountName ?>';

	// Validate form
	fMenuTypeslist.validate = function() {
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
			<?php if ($MenuTypes_list->MenuType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_MenuType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $MenuTypes_list->MenuType_Idn->caption(), $MenuTypes_list->MenuType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($MenuTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $MenuTypes_list->Name->caption(), $MenuTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($MenuTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $MenuTypes_list->Rank->caption(), $MenuTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($MenuTypes_list->Rank->errorMessage()) ?>");
			<?php if ($MenuTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $MenuTypes_list->ActiveFlag->caption(), $MenuTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fMenuTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fMenuTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fMenuTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fMenuTypeslist.lists["x_ActiveFlag[]"] = <?php echo $MenuTypes_list->ActiveFlag->Lookup->toClientList($MenuTypes_list) ?>;
	fMenuTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($MenuTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fMenuTypeslist");
});
var fMenuTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fMenuTypeslistsrch = currentSearchForm = new ew.Form("fMenuTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fMenuTypeslistsrch.filterList = <?php echo $MenuTypes_list->getFilterList() ?>;
	loadjs.done("fMenuTypeslistsrch");
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
<?php if (!$MenuTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($MenuTypes_list->TotalRecords > 0 && $MenuTypes_list->ExportOptions->visible()) { ?>
<?php $MenuTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($MenuTypes_list->ImportOptions->visible()) { ?>
<?php $MenuTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($MenuTypes_list->SearchOptions->visible()) { ?>
<?php $MenuTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($MenuTypes_list->FilterOptions->visible()) { ?>
<?php $MenuTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$MenuTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$MenuTypes_list->isExport() && !$MenuTypes->CurrentAction) { ?>
<form name="fMenuTypeslistsrch" id="fMenuTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fMenuTypeslistsrch-search-panel" class="<?php echo $MenuTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="MenuTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $MenuTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($MenuTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($MenuTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $MenuTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($MenuTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($MenuTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($MenuTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($MenuTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $MenuTypes_list->showPageHeader(); ?>
<?php
$MenuTypes_list->showMessage();
?>
<?php if ($MenuTypes_list->TotalRecords > 0 || $MenuTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($MenuTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> MenuTypes">
<?php if (!$MenuTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$MenuTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $MenuTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $MenuTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fMenuTypeslist" id="fMenuTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="MenuTypes">
<div id="gmp_MenuTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($MenuTypes_list->TotalRecords > 0 || $MenuTypes_list->isAdd() || $MenuTypes_list->isCopy() || $MenuTypes_list->isGridEdit()) { ?>
<table id="tbl_MenuTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$MenuTypes->RowType = ROWTYPE_HEADER;

// Render list options
$MenuTypes_list->renderListOptions();

// Render list options (header, left)
$MenuTypes_list->ListOptions->render("header", "left");
?>
<?php if ($MenuTypes_list->MenuType_Idn->Visible) { // MenuType_Idn ?>
	<?php if ($MenuTypes_list->SortUrl($MenuTypes_list->MenuType_Idn) == "") { ?>
		<th data-name="MenuType_Idn" class="<?php echo $MenuTypes_list->MenuType_Idn->headerCellClass() ?>"><div id="elh_MenuTypes_MenuType_Idn" class="MenuTypes_MenuType_Idn"><div class="ew-table-header-caption"><?php echo $MenuTypes_list->MenuType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MenuType_Idn" class="<?php echo $MenuTypes_list->MenuType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $MenuTypes_list->SortUrl($MenuTypes_list->MenuType_Idn) ?>', 1);"><div id="elh_MenuTypes_MenuType_Idn" class="MenuTypes_MenuType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $MenuTypes_list->MenuType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($MenuTypes_list->MenuType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($MenuTypes_list->MenuType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($MenuTypes_list->Name->Visible) { // Name ?>
	<?php if ($MenuTypes_list->SortUrl($MenuTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $MenuTypes_list->Name->headerCellClass() ?>"><div id="elh_MenuTypes_Name" class="MenuTypes_Name"><div class="ew-table-header-caption"><?php echo $MenuTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $MenuTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $MenuTypes_list->SortUrl($MenuTypes_list->Name) ?>', 1);"><div id="elh_MenuTypes_Name" class="MenuTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $MenuTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($MenuTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($MenuTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($MenuTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($MenuTypes_list->SortUrl($MenuTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $MenuTypes_list->Rank->headerCellClass() ?>"><div id="elh_MenuTypes_Rank" class="MenuTypes_Rank"><div class="ew-table-header-caption"><?php echo $MenuTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $MenuTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $MenuTypes_list->SortUrl($MenuTypes_list->Rank) ?>', 1);"><div id="elh_MenuTypes_Rank" class="MenuTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $MenuTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($MenuTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($MenuTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($MenuTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($MenuTypes_list->SortUrl($MenuTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $MenuTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_MenuTypes_ActiveFlag" class="MenuTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $MenuTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $MenuTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $MenuTypes_list->SortUrl($MenuTypes_list->ActiveFlag) ?>', 1);"><div id="elh_MenuTypes_ActiveFlag" class="MenuTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $MenuTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($MenuTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($MenuTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$MenuTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($MenuTypes_list->isAdd() || $MenuTypes_list->isCopy()) {
		$MenuTypes_list->RowIndex = 0;
		$MenuTypes_list->KeyCount = $MenuTypes_list->RowIndex;
		if ($MenuTypes_list->isCopy() && !$MenuTypes_list->loadRow())
			$MenuTypes->CurrentAction = "add";
		if ($MenuTypes_list->isAdd())
			$MenuTypes_list->loadRowValues();
		if ($MenuTypes->EventCancelled) // Insert failed
			$MenuTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$MenuTypes->resetAttributes();
		$MenuTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_MenuTypes", "data-rowtype" => ROWTYPE_ADD]);
		$MenuTypes->RowType = ROWTYPE_ADD;

		// Render row
		$MenuTypes_list->renderRow();

		// Render list options
		$MenuTypes_list->renderListOptions();
		$MenuTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $MenuTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$MenuTypes_list->ListOptions->render("body", "left", $MenuTypes_list->RowCount);
?>
	<?php if ($MenuTypes_list->MenuType_Idn->Visible) { // MenuType_Idn ?>
		<td data-name="MenuType_Idn">
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_MenuType_Idn" class="form-group MenuTypes_MenuType_Idn"></span>
<input type="hidden" data-table="MenuTypes" data-field="x_MenuType_Idn" name="o<?php echo $MenuTypes_list->RowIndex ?>_MenuType_Idn" id="o<?php echo $MenuTypes_list->RowIndex ?>_MenuType_Idn" value="<?php echo HtmlEncode($MenuTypes_list->MenuType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($MenuTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_Name" class="form-group MenuTypes_Name">
<input type="text" data-table="MenuTypes" data-field="x_Name" name="x<?php echo $MenuTypes_list->RowIndex ?>_Name" id="x<?php echo $MenuTypes_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($MenuTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $MenuTypes_list->Name->EditValue ?>"<?php echo $MenuTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="MenuTypes" data-field="x_Name" name="o<?php echo $MenuTypes_list->RowIndex ?>_Name" id="o<?php echo $MenuTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($MenuTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($MenuTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_Rank" class="form-group MenuTypes_Rank">
<input type="text" data-table="MenuTypes" data-field="x_Rank" name="x<?php echo $MenuTypes_list->RowIndex ?>_Rank" id="x<?php echo $MenuTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($MenuTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $MenuTypes_list->Rank->EditValue ?>"<?php echo $MenuTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="MenuTypes" data-field="x_Rank" name="o<?php echo $MenuTypes_list->RowIndex ?>_Rank" id="o<?php echo $MenuTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($MenuTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($MenuTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_ActiveFlag" class="form-group MenuTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($MenuTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="MenuTypes" data-field="x_ActiveFlag" name="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]_985934" value="1"<?php echo $selwrk ?><?php echo $MenuTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]_985934"></label>
</div>
</span>
<input type="hidden" data-table="MenuTypes" data-field="x_ActiveFlag" name="o<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($MenuTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$MenuTypes_list->ListOptions->render("body", "right", $MenuTypes_list->RowCount);
?>
<script>
loadjs.ready(["fMenuTypeslist", "load"], function() {
	fMenuTypeslist.updateLists(<?php echo $MenuTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($MenuTypes_list->ExportAll && $MenuTypes_list->isExport()) {
	$MenuTypes_list->StopRecord = $MenuTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($MenuTypes_list->TotalRecords > $MenuTypes_list->StartRecord + $MenuTypes_list->DisplayRecords - 1)
		$MenuTypes_list->StopRecord = $MenuTypes_list->StartRecord + $MenuTypes_list->DisplayRecords - 1;
	else
		$MenuTypes_list->StopRecord = $MenuTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($MenuTypes->isConfirm() || $MenuTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($MenuTypes_list->FormKeyCountName) && ($MenuTypes_list->isGridAdd() || $MenuTypes_list->isGridEdit() || $MenuTypes->isConfirm())) {
		$MenuTypes_list->KeyCount = $CurrentForm->getValue($MenuTypes_list->FormKeyCountName);
		$MenuTypes_list->StopRecord = $MenuTypes_list->StartRecord + $MenuTypes_list->KeyCount - 1;
	}
}
$MenuTypes_list->RecordCount = $MenuTypes_list->StartRecord - 1;
if ($MenuTypes_list->Recordset && !$MenuTypes_list->Recordset->EOF) {
	$MenuTypes_list->Recordset->moveFirst();
	$selectLimit = $MenuTypes_list->UseSelectLimit;
	if (!$selectLimit && $MenuTypes_list->StartRecord > 1)
		$MenuTypes_list->Recordset->move($MenuTypes_list->StartRecord - 1);
} elseif (!$MenuTypes->AllowAddDeleteRow && $MenuTypes_list->StopRecord == 0) {
	$MenuTypes_list->StopRecord = $MenuTypes->GridAddRowCount;
}

// Initialize aggregate
$MenuTypes->RowType = ROWTYPE_AGGREGATEINIT;
$MenuTypes->resetAttributes();
$MenuTypes_list->renderRow();
$MenuTypes_list->EditRowCount = 0;
if ($MenuTypes_list->isEdit())
	$MenuTypes_list->RowIndex = 1;
if ($MenuTypes_list->isGridAdd())
	$MenuTypes_list->RowIndex = 0;
if ($MenuTypes_list->isGridEdit())
	$MenuTypes_list->RowIndex = 0;
while ($MenuTypes_list->RecordCount < $MenuTypes_list->StopRecord) {
	$MenuTypes_list->RecordCount++;
	if ($MenuTypes_list->RecordCount >= $MenuTypes_list->StartRecord) {
		$MenuTypes_list->RowCount++;
		if ($MenuTypes_list->isGridAdd() || $MenuTypes_list->isGridEdit() || $MenuTypes->isConfirm()) {
			$MenuTypes_list->RowIndex++;
			$CurrentForm->Index = $MenuTypes_list->RowIndex;
			if ($CurrentForm->hasValue($MenuTypes_list->FormActionName) && ($MenuTypes->isConfirm() || $MenuTypes_list->EventCancelled))
				$MenuTypes_list->RowAction = strval($CurrentForm->getValue($MenuTypes_list->FormActionName));
			elseif ($MenuTypes_list->isGridAdd())
				$MenuTypes_list->RowAction = "insert";
			else
				$MenuTypes_list->RowAction = "";
		}

		// Set up key count
		$MenuTypes_list->KeyCount = $MenuTypes_list->RowIndex;

		// Init row class and style
		$MenuTypes->resetAttributes();
		$MenuTypes->CssClass = "";
		if ($MenuTypes_list->isGridAdd()) {
			$MenuTypes_list->loadRowValues(); // Load default values
		} else {
			$MenuTypes_list->loadRowValues($MenuTypes_list->Recordset); // Load row values
		}
		$MenuTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($MenuTypes_list->isGridAdd()) // Grid add
			$MenuTypes->RowType = ROWTYPE_ADD; // Render add
		if ($MenuTypes_list->isGridAdd() && $MenuTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$MenuTypes_list->restoreCurrentRowFormValues($MenuTypes_list->RowIndex); // Restore form values
		if ($MenuTypes_list->isEdit()) {
			if ($MenuTypes_list->checkInlineEditKey() && $MenuTypes_list->EditRowCount == 0) { // Inline edit
				$MenuTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($MenuTypes_list->isGridEdit()) { // Grid edit
			if ($MenuTypes->EventCancelled)
				$MenuTypes_list->restoreCurrentRowFormValues($MenuTypes_list->RowIndex); // Restore form values
			if ($MenuTypes_list->RowAction == "insert")
				$MenuTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$MenuTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($MenuTypes_list->isEdit() && $MenuTypes->RowType == ROWTYPE_EDIT && $MenuTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$MenuTypes_list->restoreFormValues(); // Restore form values
		}
		if ($MenuTypes_list->isGridEdit() && ($MenuTypes->RowType == ROWTYPE_EDIT || $MenuTypes->RowType == ROWTYPE_ADD) && $MenuTypes->EventCancelled) // Update failed
			$MenuTypes_list->restoreCurrentRowFormValues($MenuTypes_list->RowIndex); // Restore form values
		if ($MenuTypes->RowType == ROWTYPE_EDIT) // Edit row
			$MenuTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$MenuTypes->RowAttrs->merge(["data-rowindex" => $MenuTypes_list->RowCount, "id" => "r" . $MenuTypes_list->RowCount . "_MenuTypes", "data-rowtype" => $MenuTypes->RowType]);

		// Render row
		$MenuTypes_list->renderRow();

		// Render list options
		$MenuTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($MenuTypes_list->RowAction != "delete" && $MenuTypes_list->RowAction != "insertdelete" && !($MenuTypes_list->RowAction == "insert" && $MenuTypes->isConfirm() && $MenuTypes_list->emptyRow())) {
?>
	<tr <?php echo $MenuTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$MenuTypes_list->ListOptions->render("body", "left", $MenuTypes_list->RowCount);
?>
	<?php if ($MenuTypes_list->MenuType_Idn->Visible) { // MenuType_Idn ?>
		<td data-name="MenuType_Idn" <?php echo $MenuTypes_list->MenuType_Idn->cellAttributes() ?>>
<?php if ($MenuTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_MenuType_Idn" class="form-group"></span>
<input type="hidden" data-table="MenuTypes" data-field="x_MenuType_Idn" name="o<?php echo $MenuTypes_list->RowIndex ?>_MenuType_Idn" id="o<?php echo $MenuTypes_list->RowIndex ?>_MenuType_Idn" value="<?php echo HtmlEncode($MenuTypes_list->MenuType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($MenuTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_MenuType_Idn" class="form-group">
<span<?php echo $MenuTypes_list->MenuType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($MenuTypes_list->MenuType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="MenuTypes" data-field="x_MenuType_Idn" name="x<?php echo $MenuTypes_list->RowIndex ?>_MenuType_Idn" id="x<?php echo $MenuTypes_list->RowIndex ?>_MenuType_Idn" value="<?php echo HtmlEncode($MenuTypes_list->MenuType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($MenuTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_MenuType_Idn">
<span<?php echo $MenuTypes_list->MenuType_Idn->viewAttributes() ?>><?php echo $MenuTypes_list->MenuType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($MenuTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $MenuTypes_list->Name->cellAttributes() ?>>
<?php if ($MenuTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_Name" class="form-group">
<input type="text" data-table="MenuTypes" data-field="x_Name" name="x<?php echo $MenuTypes_list->RowIndex ?>_Name" id="x<?php echo $MenuTypes_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($MenuTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $MenuTypes_list->Name->EditValue ?>"<?php echo $MenuTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="MenuTypes" data-field="x_Name" name="o<?php echo $MenuTypes_list->RowIndex ?>_Name" id="o<?php echo $MenuTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($MenuTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($MenuTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_Name" class="form-group">
<input type="text" data-table="MenuTypes" data-field="x_Name" name="x<?php echo $MenuTypes_list->RowIndex ?>_Name" id="x<?php echo $MenuTypes_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($MenuTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $MenuTypes_list->Name->EditValue ?>"<?php echo $MenuTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($MenuTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_Name">
<span<?php echo $MenuTypes_list->Name->viewAttributes() ?>><?php echo $MenuTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($MenuTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $MenuTypes_list->Rank->cellAttributes() ?>>
<?php if ($MenuTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_Rank" class="form-group">
<input type="text" data-table="MenuTypes" data-field="x_Rank" name="x<?php echo $MenuTypes_list->RowIndex ?>_Rank" id="x<?php echo $MenuTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($MenuTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $MenuTypes_list->Rank->EditValue ?>"<?php echo $MenuTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="MenuTypes" data-field="x_Rank" name="o<?php echo $MenuTypes_list->RowIndex ?>_Rank" id="o<?php echo $MenuTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($MenuTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($MenuTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_Rank" class="form-group">
<input type="text" data-table="MenuTypes" data-field="x_Rank" name="x<?php echo $MenuTypes_list->RowIndex ?>_Rank" id="x<?php echo $MenuTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($MenuTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $MenuTypes_list->Rank->EditValue ?>"<?php echo $MenuTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($MenuTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_Rank">
<span<?php echo $MenuTypes_list->Rank->viewAttributes() ?>><?php echo $MenuTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($MenuTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $MenuTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($MenuTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($MenuTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="MenuTypes" data-field="x_ActiveFlag" name="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]_435834" value="1"<?php echo $selwrk ?><?php echo $MenuTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]_435834"></label>
</div>
</span>
<input type="hidden" data-table="MenuTypes" data-field="x_ActiveFlag" name="o<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($MenuTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($MenuTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($MenuTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="MenuTypes" data-field="x_ActiveFlag" name="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]_530233" value="1"<?php echo $selwrk ?><?php echo $MenuTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]_530233"></label>
</div>
</span>
<?php } ?>
<?php if ($MenuTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $MenuTypes_list->RowCount ?>_MenuTypes_ActiveFlag">
<span<?php echo $MenuTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $MenuTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($MenuTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$MenuTypes_list->ListOptions->render("body", "right", $MenuTypes_list->RowCount);
?>
	</tr>
<?php if ($MenuTypes->RowType == ROWTYPE_ADD || $MenuTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fMenuTypeslist", "load"], function() {
	fMenuTypeslist.updateLists(<?php echo $MenuTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$MenuTypes_list->isGridAdd())
		if (!$MenuTypes_list->Recordset->EOF)
			$MenuTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($MenuTypes_list->isGridAdd() || $MenuTypes_list->isGridEdit()) {
		$MenuTypes_list->RowIndex = '$rowindex$';
		$MenuTypes_list->loadRowValues();

		// Set row properties
		$MenuTypes->resetAttributes();
		$MenuTypes->RowAttrs->merge(["data-rowindex" => $MenuTypes_list->RowIndex, "id" => "r0_MenuTypes", "data-rowtype" => ROWTYPE_ADD]);
		$MenuTypes->RowAttrs->appendClass("ew-template");
		$MenuTypes->RowType = ROWTYPE_ADD;

		// Render row
		$MenuTypes_list->renderRow();

		// Render list options
		$MenuTypes_list->renderListOptions();
		$MenuTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $MenuTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$MenuTypes_list->ListOptions->render("body", "left", $MenuTypes_list->RowIndex);
?>
	<?php if ($MenuTypes_list->MenuType_Idn->Visible) { // MenuType_Idn ?>
		<td data-name="MenuType_Idn">
<span id="el$rowindex$_MenuTypes_MenuType_Idn" class="form-group MenuTypes_MenuType_Idn"></span>
<input type="hidden" data-table="MenuTypes" data-field="x_MenuType_Idn" name="o<?php echo $MenuTypes_list->RowIndex ?>_MenuType_Idn" id="o<?php echo $MenuTypes_list->RowIndex ?>_MenuType_Idn" value="<?php echo HtmlEncode($MenuTypes_list->MenuType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($MenuTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_MenuTypes_Name" class="form-group MenuTypes_Name">
<input type="text" data-table="MenuTypes" data-field="x_Name" name="x<?php echo $MenuTypes_list->RowIndex ?>_Name" id="x<?php echo $MenuTypes_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($MenuTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $MenuTypes_list->Name->EditValue ?>"<?php echo $MenuTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="MenuTypes" data-field="x_Name" name="o<?php echo $MenuTypes_list->RowIndex ?>_Name" id="o<?php echo $MenuTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($MenuTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($MenuTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_MenuTypes_Rank" class="form-group MenuTypes_Rank">
<input type="text" data-table="MenuTypes" data-field="x_Rank" name="x<?php echo $MenuTypes_list->RowIndex ?>_Rank" id="x<?php echo $MenuTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($MenuTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $MenuTypes_list->Rank->EditValue ?>"<?php echo $MenuTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="MenuTypes" data-field="x_Rank" name="o<?php echo $MenuTypes_list->RowIndex ?>_Rank" id="o<?php echo $MenuTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($MenuTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($MenuTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_MenuTypes_ActiveFlag" class="form-group MenuTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($MenuTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="MenuTypes" data-field="x_ActiveFlag" name="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]_354670" value="1"<?php echo $selwrk ?><?php echo $MenuTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]_354670"></label>
</div>
</span>
<input type="hidden" data-table="MenuTypes" data-field="x_ActiveFlag" name="o<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $MenuTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($MenuTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$MenuTypes_list->ListOptions->render("body", "right", $MenuTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fMenuTypeslist", "load"], function() {
	fMenuTypeslist.updateLists(<?php echo $MenuTypes_list->RowIndex ?>);
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
<?php if ($MenuTypes_list->isAdd() || $MenuTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $MenuTypes_list->FormKeyCountName ?>" id="<?php echo $MenuTypes_list->FormKeyCountName ?>" value="<?php echo $MenuTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($MenuTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $MenuTypes_list->FormKeyCountName ?>" id="<?php echo $MenuTypes_list->FormKeyCountName ?>" value="<?php echo $MenuTypes_list->KeyCount ?>">
<?php echo $MenuTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($MenuTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $MenuTypes_list->FormKeyCountName ?>" id="<?php echo $MenuTypes_list->FormKeyCountName ?>" value="<?php echo $MenuTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($MenuTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $MenuTypes_list->FormKeyCountName ?>" id="<?php echo $MenuTypes_list->FormKeyCountName ?>" value="<?php echo $MenuTypes_list->KeyCount ?>">
<?php echo $MenuTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$MenuTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($MenuTypes_list->Recordset)
	$MenuTypes_list->Recordset->Close();
?>
<?php if (!$MenuTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$MenuTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $MenuTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $MenuTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($MenuTypes_list->TotalRecords == 0 && !$MenuTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $MenuTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$MenuTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$MenuTypes_list->isExport()) { ?>
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
$MenuTypes_list->terminate();
?>