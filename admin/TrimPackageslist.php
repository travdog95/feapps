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
$TrimPackages_list = new TrimPackages_list();

// Run the page
$TrimPackages_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TrimPackages_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$TrimPackages_list->isExport()) { ?>
<script>
var fTrimPackageslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fTrimPackageslist = currentForm = new ew.Form("fTrimPackageslist", "list");
	fTrimPackageslist.formKeyCountName = '<?php echo $TrimPackages_list->FormKeyCountName ?>';

	// Validate form
	fTrimPackageslist.validate = function() {
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
			<?php if ($TrimPackages_list->TrimPackage_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_TrimPackage_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TrimPackages_list->TrimPackage_Idn->caption(), $TrimPackages_list->TrimPackage_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($TrimPackages_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TrimPackages_list->Name->caption(), $TrimPackages_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($TrimPackages_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TrimPackages_list->Rank->caption(), $TrimPackages_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($TrimPackages_list->Rank->errorMessage()) ?>");
			<?php if ($TrimPackages_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TrimPackages_list->ActiveFlag->caption(), $TrimPackages_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fTrimPackageslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fTrimPackageslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fTrimPackageslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fTrimPackageslist.lists["x_ActiveFlag[]"] = <?php echo $TrimPackages_list->ActiveFlag->Lookup->toClientList($TrimPackages_list) ?>;
	fTrimPackageslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($TrimPackages_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fTrimPackageslist");
});
var fTrimPackageslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fTrimPackageslistsrch = currentSearchForm = new ew.Form("fTrimPackageslistsrch");

	// Dynamic selection lists
	// Filters

	fTrimPackageslistsrch.filterList = <?php echo $TrimPackages_list->getFilterList() ?>;
	loadjs.done("fTrimPackageslistsrch");
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
<?php if (!$TrimPackages_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($TrimPackages_list->TotalRecords > 0 && $TrimPackages_list->ExportOptions->visible()) { ?>
<?php $TrimPackages_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($TrimPackages_list->ImportOptions->visible()) { ?>
<?php $TrimPackages_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($TrimPackages_list->SearchOptions->visible()) { ?>
<?php $TrimPackages_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($TrimPackages_list->FilterOptions->visible()) { ?>
<?php $TrimPackages_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$TrimPackages_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$TrimPackages_list->isExport() && !$TrimPackages->CurrentAction) { ?>
<form name="fTrimPackageslistsrch" id="fTrimPackageslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fTrimPackageslistsrch-search-panel" class="<?php echo $TrimPackages_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="TrimPackages">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $TrimPackages_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($TrimPackages_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($TrimPackages_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $TrimPackages_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($TrimPackages_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($TrimPackages_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($TrimPackages_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($TrimPackages_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $TrimPackages_list->showPageHeader(); ?>
<?php
$TrimPackages_list->showMessage();
?>
<?php if ($TrimPackages_list->TotalRecords > 0 || $TrimPackages->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($TrimPackages_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> TrimPackages">
<?php if (!$TrimPackages_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$TrimPackages_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $TrimPackages_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $TrimPackages_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fTrimPackageslist" id="fTrimPackageslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TrimPackages">
<div id="gmp_TrimPackages" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($TrimPackages_list->TotalRecords > 0 || $TrimPackages_list->isAdd() || $TrimPackages_list->isCopy() || $TrimPackages_list->isGridEdit()) { ?>
<table id="tbl_TrimPackageslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$TrimPackages->RowType = ROWTYPE_HEADER;

// Render list options
$TrimPackages_list->renderListOptions();

// Render list options (header, left)
$TrimPackages_list->ListOptions->render("header", "left");
?>
<?php if ($TrimPackages_list->TrimPackage_Idn->Visible) { // TrimPackage_Idn ?>
	<?php if ($TrimPackages_list->SortUrl($TrimPackages_list->TrimPackage_Idn) == "") { ?>
		<th data-name="TrimPackage_Idn" class="<?php echo $TrimPackages_list->TrimPackage_Idn->headerCellClass() ?>"><div id="elh_TrimPackages_TrimPackage_Idn" class="TrimPackages_TrimPackage_Idn"><div class="ew-table-header-caption"><?php echo $TrimPackages_list->TrimPackage_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TrimPackage_Idn" class="<?php echo $TrimPackages_list->TrimPackage_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $TrimPackages_list->SortUrl($TrimPackages_list->TrimPackage_Idn) ?>', 1);"><div id="elh_TrimPackages_TrimPackage_Idn" class="TrimPackages_TrimPackage_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TrimPackages_list->TrimPackage_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($TrimPackages_list->TrimPackage_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($TrimPackages_list->TrimPackage_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TrimPackages_list->Name->Visible) { // Name ?>
	<?php if ($TrimPackages_list->SortUrl($TrimPackages_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $TrimPackages_list->Name->headerCellClass() ?>"><div id="elh_TrimPackages_Name" class="TrimPackages_Name"><div class="ew-table-header-caption"><?php echo $TrimPackages_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $TrimPackages_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $TrimPackages_list->SortUrl($TrimPackages_list->Name) ?>', 1);"><div id="elh_TrimPackages_Name" class="TrimPackages_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TrimPackages_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($TrimPackages_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($TrimPackages_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TrimPackages_list->Rank->Visible) { // Rank ?>
	<?php if ($TrimPackages_list->SortUrl($TrimPackages_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $TrimPackages_list->Rank->headerCellClass() ?>"><div id="elh_TrimPackages_Rank" class="TrimPackages_Rank"><div class="ew-table-header-caption"><?php echo $TrimPackages_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $TrimPackages_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $TrimPackages_list->SortUrl($TrimPackages_list->Rank) ?>', 1);"><div id="elh_TrimPackages_Rank" class="TrimPackages_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TrimPackages_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($TrimPackages_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($TrimPackages_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TrimPackages_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($TrimPackages_list->SortUrl($TrimPackages_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $TrimPackages_list->ActiveFlag->headerCellClass() ?>"><div id="elh_TrimPackages_ActiveFlag" class="TrimPackages_ActiveFlag"><div class="ew-table-header-caption"><?php echo $TrimPackages_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $TrimPackages_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $TrimPackages_list->SortUrl($TrimPackages_list->ActiveFlag) ?>', 1);"><div id="elh_TrimPackages_ActiveFlag" class="TrimPackages_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TrimPackages_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($TrimPackages_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($TrimPackages_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$TrimPackages_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($TrimPackages_list->isAdd() || $TrimPackages_list->isCopy()) {
		$TrimPackages_list->RowIndex = 0;
		$TrimPackages_list->KeyCount = $TrimPackages_list->RowIndex;
		if ($TrimPackages_list->isCopy() && !$TrimPackages_list->loadRow())
			$TrimPackages->CurrentAction = "add";
		if ($TrimPackages_list->isAdd())
			$TrimPackages_list->loadRowValues();
		if ($TrimPackages->EventCancelled) // Insert failed
			$TrimPackages_list->restoreFormValues(); // Restore form values

		// Set row properties
		$TrimPackages->resetAttributes();
		$TrimPackages->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_TrimPackages", "data-rowtype" => ROWTYPE_ADD]);
		$TrimPackages->RowType = ROWTYPE_ADD;

		// Render row
		$TrimPackages_list->renderRow();

		// Render list options
		$TrimPackages_list->renderListOptions();
		$TrimPackages_list->StartRowCount = 0;
?>
	<tr <?php echo $TrimPackages->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TrimPackages_list->ListOptions->render("body", "left", $TrimPackages_list->RowCount);
?>
	<?php if ($TrimPackages_list->TrimPackage_Idn->Visible) { // TrimPackage_Idn ?>
		<td data-name="TrimPackage_Idn">
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_TrimPackage_Idn" class="form-group TrimPackages_TrimPackage_Idn"></span>
<input type="hidden" data-table="TrimPackages" data-field="x_TrimPackage_Idn" name="o<?php echo $TrimPackages_list->RowIndex ?>_TrimPackage_Idn" id="o<?php echo $TrimPackages_list->RowIndex ?>_TrimPackage_Idn" value="<?php echo HtmlEncode($TrimPackages_list->TrimPackage_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TrimPackages_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_Name" class="form-group TrimPackages_Name">
<input type="text" data-table="TrimPackages" data-field="x_Name" name="x<?php echo $TrimPackages_list->RowIndex ?>_Name" id="x<?php echo $TrimPackages_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TrimPackages_list->Name->getPlaceHolder()) ?>" value="<?php echo $TrimPackages_list->Name->EditValue ?>"<?php echo $TrimPackages_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="TrimPackages" data-field="x_Name" name="o<?php echo $TrimPackages_list->RowIndex ?>_Name" id="o<?php echo $TrimPackages_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($TrimPackages_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TrimPackages_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_Rank" class="form-group TrimPackages_Rank">
<input type="text" data-table="TrimPackages" data-field="x_Rank" name="x<?php echo $TrimPackages_list->RowIndex ?>_Rank" id="x<?php echo $TrimPackages_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TrimPackages_list->Rank->getPlaceHolder()) ?>" value="<?php echo $TrimPackages_list->Rank->EditValue ?>"<?php echo $TrimPackages_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="TrimPackages" data-field="x_Rank" name="o<?php echo $TrimPackages_list->RowIndex ?>_Rank" id="o<?php echo $TrimPackages_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($TrimPackages_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TrimPackages_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_ActiveFlag" class="form-group TrimPackages_ActiveFlag">
<?php
$selwrk = ConvertToBool($TrimPackages_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="TrimPackages" data-field="x_ActiveFlag" name="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]_877585" value="1"<?php echo $selwrk ?><?php echo $TrimPackages_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]_877585"></label>
</div>
</span>
<input type="hidden" data-table="TrimPackages" data-field="x_ActiveFlag" name="o<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($TrimPackages_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TrimPackages_list->ListOptions->render("body", "right", $TrimPackages_list->RowCount);
?>
<script>
loadjs.ready(["fTrimPackageslist", "load"], function() {
	fTrimPackageslist.updateLists(<?php echo $TrimPackages_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($TrimPackages_list->ExportAll && $TrimPackages_list->isExport()) {
	$TrimPackages_list->StopRecord = $TrimPackages_list->TotalRecords;
} else {

	// Set the last record to display
	if ($TrimPackages_list->TotalRecords > $TrimPackages_list->StartRecord + $TrimPackages_list->DisplayRecords - 1)
		$TrimPackages_list->StopRecord = $TrimPackages_list->StartRecord + $TrimPackages_list->DisplayRecords - 1;
	else
		$TrimPackages_list->StopRecord = $TrimPackages_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($TrimPackages->isConfirm() || $TrimPackages_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($TrimPackages_list->FormKeyCountName) && ($TrimPackages_list->isGridAdd() || $TrimPackages_list->isGridEdit() || $TrimPackages->isConfirm())) {
		$TrimPackages_list->KeyCount = $CurrentForm->getValue($TrimPackages_list->FormKeyCountName);
		$TrimPackages_list->StopRecord = $TrimPackages_list->StartRecord + $TrimPackages_list->KeyCount - 1;
	}
}
$TrimPackages_list->RecordCount = $TrimPackages_list->StartRecord - 1;
if ($TrimPackages_list->Recordset && !$TrimPackages_list->Recordset->EOF) {
	$TrimPackages_list->Recordset->moveFirst();
	$selectLimit = $TrimPackages_list->UseSelectLimit;
	if (!$selectLimit && $TrimPackages_list->StartRecord > 1)
		$TrimPackages_list->Recordset->move($TrimPackages_list->StartRecord - 1);
} elseif (!$TrimPackages->AllowAddDeleteRow && $TrimPackages_list->StopRecord == 0) {
	$TrimPackages_list->StopRecord = $TrimPackages->GridAddRowCount;
}

// Initialize aggregate
$TrimPackages->RowType = ROWTYPE_AGGREGATEINIT;
$TrimPackages->resetAttributes();
$TrimPackages_list->renderRow();
$TrimPackages_list->EditRowCount = 0;
if ($TrimPackages_list->isEdit())
	$TrimPackages_list->RowIndex = 1;
if ($TrimPackages_list->isGridAdd())
	$TrimPackages_list->RowIndex = 0;
if ($TrimPackages_list->isGridEdit())
	$TrimPackages_list->RowIndex = 0;
while ($TrimPackages_list->RecordCount < $TrimPackages_list->StopRecord) {
	$TrimPackages_list->RecordCount++;
	if ($TrimPackages_list->RecordCount >= $TrimPackages_list->StartRecord) {
		$TrimPackages_list->RowCount++;
		if ($TrimPackages_list->isGridAdd() || $TrimPackages_list->isGridEdit() || $TrimPackages->isConfirm()) {
			$TrimPackages_list->RowIndex++;
			$CurrentForm->Index = $TrimPackages_list->RowIndex;
			if ($CurrentForm->hasValue($TrimPackages_list->FormActionName) && ($TrimPackages->isConfirm() || $TrimPackages_list->EventCancelled))
				$TrimPackages_list->RowAction = strval($CurrentForm->getValue($TrimPackages_list->FormActionName));
			elseif ($TrimPackages_list->isGridAdd())
				$TrimPackages_list->RowAction = "insert";
			else
				$TrimPackages_list->RowAction = "";
		}

		// Set up key count
		$TrimPackages_list->KeyCount = $TrimPackages_list->RowIndex;

		// Init row class and style
		$TrimPackages->resetAttributes();
		$TrimPackages->CssClass = "";
		if ($TrimPackages_list->isGridAdd()) {
			$TrimPackages_list->loadRowValues(); // Load default values
		} else {
			$TrimPackages_list->loadRowValues($TrimPackages_list->Recordset); // Load row values
		}
		$TrimPackages->RowType = ROWTYPE_VIEW; // Render view
		if ($TrimPackages_list->isGridAdd()) // Grid add
			$TrimPackages->RowType = ROWTYPE_ADD; // Render add
		if ($TrimPackages_list->isGridAdd() && $TrimPackages->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$TrimPackages_list->restoreCurrentRowFormValues($TrimPackages_list->RowIndex); // Restore form values
		if ($TrimPackages_list->isEdit()) {
			if ($TrimPackages_list->checkInlineEditKey() && $TrimPackages_list->EditRowCount == 0) { // Inline edit
				$TrimPackages->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($TrimPackages_list->isGridEdit()) { // Grid edit
			if ($TrimPackages->EventCancelled)
				$TrimPackages_list->restoreCurrentRowFormValues($TrimPackages_list->RowIndex); // Restore form values
			if ($TrimPackages_list->RowAction == "insert")
				$TrimPackages->RowType = ROWTYPE_ADD; // Render add
			else
				$TrimPackages->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($TrimPackages_list->isEdit() && $TrimPackages->RowType == ROWTYPE_EDIT && $TrimPackages->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$TrimPackages_list->restoreFormValues(); // Restore form values
		}
		if ($TrimPackages_list->isGridEdit() && ($TrimPackages->RowType == ROWTYPE_EDIT || $TrimPackages->RowType == ROWTYPE_ADD) && $TrimPackages->EventCancelled) // Update failed
			$TrimPackages_list->restoreCurrentRowFormValues($TrimPackages_list->RowIndex); // Restore form values
		if ($TrimPackages->RowType == ROWTYPE_EDIT) // Edit row
			$TrimPackages_list->EditRowCount++;

		// Set up row id / data-rowindex
		$TrimPackages->RowAttrs->merge(["data-rowindex" => $TrimPackages_list->RowCount, "id" => "r" . $TrimPackages_list->RowCount . "_TrimPackages", "data-rowtype" => $TrimPackages->RowType]);

		// Render row
		$TrimPackages_list->renderRow();

		// Render list options
		$TrimPackages_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($TrimPackages_list->RowAction != "delete" && $TrimPackages_list->RowAction != "insertdelete" && !($TrimPackages_list->RowAction == "insert" && $TrimPackages->isConfirm() && $TrimPackages_list->emptyRow())) {
?>
	<tr <?php echo $TrimPackages->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TrimPackages_list->ListOptions->render("body", "left", $TrimPackages_list->RowCount);
?>
	<?php if ($TrimPackages_list->TrimPackage_Idn->Visible) { // TrimPackage_Idn ?>
		<td data-name="TrimPackage_Idn" <?php echo $TrimPackages_list->TrimPackage_Idn->cellAttributes() ?>>
<?php if ($TrimPackages->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_TrimPackage_Idn" class="form-group"></span>
<input type="hidden" data-table="TrimPackages" data-field="x_TrimPackage_Idn" name="o<?php echo $TrimPackages_list->RowIndex ?>_TrimPackage_Idn" id="o<?php echo $TrimPackages_list->RowIndex ?>_TrimPackage_Idn" value="<?php echo HtmlEncode($TrimPackages_list->TrimPackage_Idn->OldValue) ?>">
<?php } ?>
<?php if ($TrimPackages->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_TrimPackage_Idn" class="form-group">
<span<?php echo $TrimPackages_list->TrimPackage_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($TrimPackages_list->TrimPackage_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="TrimPackages" data-field="x_TrimPackage_Idn" name="x<?php echo $TrimPackages_list->RowIndex ?>_TrimPackage_Idn" id="x<?php echo $TrimPackages_list->RowIndex ?>_TrimPackage_Idn" value="<?php echo HtmlEncode($TrimPackages_list->TrimPackage_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($TrimPackages->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_TrimPackage_Idn">
<span<?php echo $TrimPackages_list->TrimPackage_Idn->viewAttributes() ?>><?php echo $TrimPackages_list->TrimPackage_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($TrimPackages_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $TrimPackages_list->Name->cellAttributes() ?>>
<?php if ($TrimPackages->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_Name" class="form-group">
<input type="text" data-table="TrimPackages" data-field="x_Name" name="x<?php echo $TrimPackages_list->RowIndex ?>_Name" id="x<?php echo $TrimPackages_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TrimPackages_list->Name->getPlaceHolder()) ?>" value="<?php echo $TrimPackages_list->Name->EditValue ?>"<?php echo $TrimPackages_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="TrimPackages" data-field="x_Name" name="o<?php echo $TrimPackages_list->RowIndex ?>_Name" id="o<?php echo $TrimPackages_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($TrimPackages_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($TrimPackages->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_Name" class="form-group">
<input type="text" data-table="TrimPackages" data-field="x_Name" name="x<?php echo $TrimPackages_list->RowIndex ?>_Name" id="x<?php echo $TrimPackages_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TrimPackages_list->Name->getPlaceHolder()) ?>" value="<?php echo $TrimPackages_list->Name->EditValue ?>"<?php echo $TrimPackages_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($TrimPackages->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_Name">
<span<?php echo $TrimPackages_list->Name->viewAttributes() ?>><?php echo $TrimPackages_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($TrimPackages_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $TrimPackages_list->Rank->cellAttributes() ?>>
<?php if ($TrimPackages->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_Rank" class="form-group">
<input type="text" data-table="TrimPackages" data-field="x_Rank" name="x<?php echo $TrimPackages_list->RowIndex ?>_Rank" id="x<?php echo $TrimPackages_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TrimPackages_list->Rank->getPlaceHolder()) ?>" value="<?php echo $TrimPackages_list->Rank->EditValue ?>"<?php echo $TrimPackages_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="TrimPackages" data-field="x_Rank" name="o<?php echo $TrimPackages_list->RowIndex ?>_Rank" id="o<?php echo $TrimPackages_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($TrimPackages_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($TrimPackages->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_Rank" class="form-group">
<input type="text" data-table="TrimPackages" data-field="x_Rank" name="x<?php echo $TrimPackages_list->RowIndex ?>_Rank" id="x<?php echo $TrimPackages_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TrimPackages_list->Rank->getPlaceHolder()) ?>" value="<?php echo $TrimPackages_list->Rank->EditValue ?>"<?php echo $TrimPackages_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($TrimPackages->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_Rank">
<span<?php echo $TrimPackages_list->Rank->viewAttributes() ?>><?php echo $TrimPackages_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($TrimPackages_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $TrimPackages_list->ActiveFlag->cellAttributes() ?>>
<?php if ($TrimPackages->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($TrimPackages_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="TrimPackages" data-field="x_ActiveFlag" name="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]_426559" value="1"<?php echo $selwrk ?><?php echo $TrimPackages_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]_426559"></label>
</div>
</span>
<input type="hidden" data-table="TrimPackages" data-field="x_ActiveFlag" name="o<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($TrimPackages_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($TrimPackages->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($TrimPackages_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="TrimPackages" data-field="x_ActiveFlag" name="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]_685201" value="1"<?php echo $selwrk ?><?php echo $TrimPackages_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]_685201"></label>
</div>
</span>
<?php } ?>
<?php if ($TrimPackages->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TrimPackages_list->RowCount ?>_TrimPackages_ActiveFlag">
<span<?php echo $TrimPackages_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $TrimPackages_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($TrimPackages_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TrimPackages_list->ListOptions->render("body", "right", $TrimPackages_list->RowCount);
?>
	</tr>
<?php if ($TrimPackages->RowType == ROWTYPE_ADD || $TrimPackages->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fTrimPackageslist", "load"], function() {
	fTrimPackageslist.updateLists(<?php echo $TrimPackages_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$TrimPackages_list->isGridAdd())
		if (!$TrimPackages_list->Recordset->EOF)
			$TrimPackages_list->Recordset->moveNext();
}
?>
<?php
	if ($TrimPackages_list->isGridAdd() || $TrimPackages_list->isGridEdit()) {
		$TrimPackages_list->RowIndex = '$rowindex$';
		$TrimPackages_list->loadRowValues();

		// Set row properties
		$TrimPackages->resetAttributes();
		$TrimPackages->RowAttrs->merge(["data-rowindex" => $TrimPackages_list->RowIndex, "id" => "r0_TrimPackages", "data-rowtype" => ROWTYPE_ADD]);
		$TrimPackages->RowAttrs->appendClass("ew-template");
		$TrimPackages->RowType = ROWTYPE_ADD;

		// Render row
		$TrimPackages_list->renderRow();

		// Render list options
		$TrimPackages_list->renderListOptions();
		$TrimPackages_list->StartRowCount = 0;
?>
	<tr <?php echo $TrimPackages->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TrimPackages_list->ListOptions->render("body", "left", $TrimPackages_list->RowIndex);
?>
	<?php if ($TrimPackages_list->TrimPackage_Idn->Visible) { // TrimPackage_Idn ?>
		<td data-name="TrimPackage_Idn">
<span id="el$rowindex$_TrimPackages_TrimPackage_Idn" class="form-group TrimPackages_TrimPackage_Idn"></span>
<input type="hidden" data-table="TrimPackages" data-field="x_TrimPackage_Idn" name="o<?php echo $TrimPackages_list->RowIndex ?>_TrimPackage_Idn" id="o<?php echo $TrimPackages_list->RowIndex ?>_TrimPackage_Idn" value="<?php echo HtmlEncode($TrimPackages_list->TrimPackage_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TrimPackages_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_TrimPackages_Name" class="form-group TrimPackages_Name">
<input type="text" data-table="TrimPackages" data-field="x_Name" name="x<?php echo $TrimPackages_list->RowIndex ?>_Name" id="x<?php echo $TrimPackages_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TrimPackages_list->Name->getPlaceHolder()) ?>" value="<?php echo $TrimPackages_list->Name->EditValue ?>"<?php echo $TrimPackages_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="TrimPackages" data-field="x_Name" name="o<?php echo $TrimPackages_list->RowIndex ?>_Name" id="o<?php echo $TrimPackages_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($TrimPackages_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TrimPackages_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_TrimPackages_Rank" class="form-group TrimPackages_Rank">
<input type="text" data-table="TrimPackages" data-field="x_Rank" name="x<?php echo $TrimPackages_list->RowIndex ?>_Rank" id="x<?php echo $TrimPackages_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TrimPackages_list->Rank->getPlaceHolder()) ?>" value="<?php echo $TrimPackages_list->Rank->EditValue ?>"<?php echo $TrimPackages_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="TrimPackages" data-field="x_Rank" name="o<?php echo $TrimPackages_list->RowIndex ?>_Rank" id="o<?php echo $TrimPackages_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($TrimPackages_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TrimPackages_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_TrimPackages_ActiveFlag" class="form-group TrimPackages_ActiveFlag">
<?php
$selwrk = ConvertToBool($TrimPackages_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="TrimPackages" data-field="x_ActiveFlag" name="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]_851350" value="1"<?php echo $selwrk ?><?php echo $TrimPackages_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]_851350"></label>
</div>
</span>
<input type="hidden" data-table="TrimPackages" data-field="x_ActiveFlag" name="o<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $TrimPackages_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($TrimPackages_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TrimPackages_list->ListOptions->render("body", "right", $TrimPackages_list->RowIndex);
?>
<script>
loadjs.ready(["fTrimPackageslist", "load"], function() {
	fTrimPackageslist.updateLists(<?php echo $TrimPackages_list->RowIndex ?>);
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
<?php if ($TrimPackages_list->isAdd() || $TrimPackages_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $TrimPackages_list->FormKeyCountName ?>" id="<?php echo $TrimPackages_list->FormKeyCountName ?>" value="<?php echo $TrimPackages_list->KeyCount ?>">
<?php } ?>
<?php if ($TrimPackages_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $TrimPackages_list->FormKeyCountName ?>" id="<?php echo $TrimPackages_list->FormKeyCountName ?>" value="<?php echo $TrimPackages_list->KeyCount ?>">
<?php echo $TrimPackages_list->MultiSelectKey ?>
<?php } ?>
<?php if ($TrimPackages_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $TrimPackages_list->FormKeyCountName ?>" id="<?php echo $TrimPackages_list->FormKeyCountName ?>" value="<?php echo $TrimPackages_list->KeyCount ?>">
<?php } ?>
<?php if ($TrimPackages_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $TrimPackages_list->FormKeyCountName ?>" id="<?php echo $TrimPackages_list->FormKeyCountName ?>" value="<?php echo $TrimPackages_list->KeyCount ?>">
<?php echo $TrimPackages_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$TrimPackages->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($TrimPackages_list->Recordset)
	$TrimPackages_list->Recordset->Close();
?>
<?php if (!$TrimPackages_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$TrimPackages_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $TrimPackages_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $TrimPackages_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($TrimPackages_list->TotalRecords == 0 && !$TrimPackages->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $TrimPackages_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$TrimPackages_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$TrimPackages_list->isExport()) { ?>
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
$TrimPackages_list->terminate();
?>