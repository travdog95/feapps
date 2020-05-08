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
$FDCTypes_list = new FDCTypes_list();

// Run the page
$FDCTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FDCTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$FDCTypes_list->isExport()) { ?>
<script>
var fFDCTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fFDCTypeslist = currentForm = new ew.Form("fFDCTypeslist", "list");
	fFDCTypeslist.formKeyCountName = '<?php echo $FDCTypes_list->FormKeyCountName ?>';

	// Validate form
	fFDCTypeslist.validate = function() {
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
			<?php if ($FDCTypes_list->FdcType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FdcType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FDCTypes_list->FdcType_Idn->caption(), $FDCTypes_list->FdcType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FDCTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FDCTypes_list->Name->caption(), $FDCTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FDCTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FDCTypes_list->Rank->caption(), $FDCTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($FDCTypes_list->Rank->errorMessage()) ?>");
			<?php if ($FDCTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FDCTypes_list->ActiveFlag->caption(), $FDCTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fFDCTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fFDCTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fFDCTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fFDCTypeslist.lists["x_ActiveFlag[]"] = <?php echo $FDCTypes_list->ActiveFlag->Lookup->toClientList($FDCTypes_list) ?>;
	fFDCTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($FDCTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fFDCTypeslist");
});
var fFDCTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fFDCTypeslistsrch = currentSearchForm = new ew.Form("fFDCTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fFDCTypeslistsrch.filterList = <?php echo $FDCTypes_list->getFilterList() ?>;
	loadjs.done("fFDCTypeslistsrch");
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
<?php if (!$FDCTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($FDCTypes_list->TotalRecords > 0 && $FDCTypes_list->ExportOptions->visible()) { ?>
<?php $FDCTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($FDCTypes_list->ImportOptions->visible()) { ?>
<?php $FDCTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($FDCTypes_list->SearchOptions->visible()) { ?>
<?php $FDCTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($FDCTypes_list->FilterOptions->visible()) { ?>
<?php $FDCTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$FDCTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$FDCTypes_list->isExport() && !$FDCTypes->CurrentAction) { ?>
<form name="fFDCTypeslistsrch" id="fFDCTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fFDCTypeslistsrch-search-panel" class="<?php echo $FDCTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="FDCTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $FDCTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($FDCTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($FDCTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $FDCTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($FDCTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($FDCTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($FDCTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($FDCTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $FDCTypes_list->showPageHeader(); ?>
<?php
$FDCTypes_list->showMessage();
?>
<?php if ($FDCTypes_list->TotalRecords > 0 || $FDCTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($FDCTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> FDCTypes">
<?php if (!$FDCTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$FDCTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FDCTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $FDCTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fFDCTypeslist" id="fFDCTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FDCTypes">
<div id="gmp_FDCTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($FDCTypes_list->TotalRecords > 0 || $FDCTypes_list->isAdd() || $FDCTypes_list->isCopy() || $FDCTypes_list->isGridEdit()) { ?>
<table id="tbl_FDCTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$FDCTypes->RowType = ROWTYPE_HEADER;

// Render list options
$FDCTypes_list->renderListOptions();

// Render list options (header, left)
$FDCTypes_list->ListOptions->render("header", "left");
?>
<?php if ($FDCTypes_list->FdcType_Idn->Visible) { // FdcType_Idn ?>
	<?php if ($FDCTypes_list->SortUrl($FDCTypes_list->FdcType_Idn) == "") { ?>
		<th data-name="FdcType_Idn" class="<?php echo $FDCTypes_list->FdcType_Idn->headerCellClass() ?>"><div id="elh_FDCTypes_FdcType_Idn" class="FDCTypes_FdcType_Idn"><div class="ew-table-header-caption"><?php echo $FDCTypes_list->FdcType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FdcType_Idn" class="<?php echo $FDCTypes_list->FdcType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FDCTypes_list->SortUrl($FDCTypes_list->FdcType_Idn) ?>', 1);"><div id="elh_FDCTypes_FdcType_Idn" class="FDCTypes_FdcType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FDCTypes_list->FdcType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($FDCTypes_list->FdcType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FDCTypes_list->FdcType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FDCTypes_list->Name->Visible) { // Name ?>
	<?php if ($FDCTypes_list->SortUrl($FDCTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $FDCTypes_list->Name->headerCellClass() ?>"><div id="elh_FDCTypes_Name" class="FDCTypes_Name"><div class="ew-table-header-caption"><?php echo $FDCTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $FDCTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FDCTypes_list->SortUrl($FDCTypes_list->Name) ?>', 1);"><div id="elh_FDCTypes_Name" class="FDCTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FDCTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($FDCTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FDCTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FDCTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($FDCTypes_list->SortUrl($FDCTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $FDCTypes_list->Rank->headerCellClass() ?>"><div id="elh_FDCTypes_Rank" class="FDCTypes_Rank"><div class="ew-table-header-caption"><?php echo $FDCTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $FDCTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FDCTypes_list->SortUrl($FDCTypes_list->Rank) ?>', 1);"><div id="elh_FDCTypes_Rank" class="FDCTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FDCTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($FDCTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FDCTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FDCTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($FDCTypes_list->SortUrl($FDCTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $FDCTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_FDCTypes_ActiveFlag" class="FDCTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $FDCTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $FDCTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FDCTypes_list->SortUrl($FDCTypes_list->ActiveFlag) ?>', 1);"><div id="elh_FDCTypes_ActiveFlag" class="FDCTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FDCTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($FDCTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FDCTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$FDCTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($FDCTypes_list->isAdd() || $FDCTypes_list->isCopy()) {
		$FDCTypes_list->RowIndex = 0;
		$FDCTypes_list->KeyCount = $FDCTypes_list->RowIndex;
		if ($FDCTypes_list->isCopy() && !$FDCTypes_list->loadRow())
			$FDCTypes->CurrentAction = "add";
		if ($FDCTypes_list->isAdd())
			$FDCTypes_list->loadRowValues();
		if ($FDCTypes->EventCancelled) // Insert failed
			$FDCTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$FDCTypes->resetAttributes();
		$FDCTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_FDCTypes", "data-rowtype" => ROWTYPE_ADD]);
		$FDCTypes->RowType = ROWTYPE_ADD;

		// Render row
		$FDCTypes_list->renderRow();

		// Render list options
		$FDCTypes_list->renderListOptions();
		$FDCTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $FDCTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FDCTypes_list->ListOptions->render("body", "left", $FDCTypes_list->RowCount);
?>
	<?php if ($FDCTypes_list->FdcType_Idn->Visible) { // FdcType_Idn ?>
		<td data-name="FdcType_Idn">
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_FdcType_Idn" class="form-group FDCTypes_FdcType_Idn"></span>
<input type="hidden" data-table="FDCTypes" data-field="x_FdcType_Idn" name="o<?php echo $FDCTypes_list->RowIndex ?>_FdcType_Idn" id="o<?php echo $FDCTypes_list->RowIndex ?>_FdcType_Idn" value="<?php echo HtmlEncode($FDCTypes_list->FdcType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FDCTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_Name" class="form-group FDCTypes_Name">
<input type="text" data-table="FDCTypes" data-field="x_Name" name="x<?php echo $FDCTypes_list->RowIndex ?>_Name" id="x<?php echo $FDCTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FDCTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FDCTypes_list->Name->EditValue ?>"<?php echo $FDCTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FDCTypes" data-field="x_Name" name="o<?php echo $FDCTypes_list->RowIndex ?>_Name" id="o<?php echo $FDCTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FDCTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FDCTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_Rank" class="form-group FDCTypes_Rank">
<input type="text" data-table="FDCTypes" data-field="x_Rank" name="x<?php echo $FDCTypes_list->RowIndex ?>_Rank" id="x<?php echo $FDCTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FDCTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FDCTypes_list->Rank->EditValue ?>"<?php echo $FDCTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FDCTypes" data-field="x_Rank" name="o<?php echo $FDCTypes_list->RowIndex ?>_Rank" id="o<?php echo $FDCTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FDCTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FDCTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_ActiveFlag" class="form-group FDCTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($FDCTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FDCTypes" data-field="x_ActiveFlag" name="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]_789059" value="1"<?php echo $selwrk ?><?php echo $FDCTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]_789059"></label>
</div>
</span>
<input type="hidden" data-table="FDCTypes" data-field="x_ActiveFlag" name="o<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FDCTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FDCTypes_list->ListOptions->render("body", "right", $FDCTypes_list->RowCount);
?>
<script>
loadjs.ready(["fFDCTypeslist", "load"], function() {
	fFDCTypeslist.updateLists(<?php echo $FDCTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($FDCTypes_list->ExportAll && $FDCTypes_list->isExport()) {
	$FDCTypes_list->StopRecord = $FDCTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($FDCTypes_list->TotalRecords > $FDCTypes_list->StartRecord + $FDCTypes_list->DisplayRecords - 1)
		$FDCTypes_list->StopRecord = $FDCTypes_list->StartRecord + $FDCTypes_list->DisplayRecords - 1;
	else
		$FDCTypes_list->StopRecord = $FDCTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($FDCTypes->isConfirm() || $FDCTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($FDCTypes_list->FormKeyCountName) && ($FDCTypes_list->isGridAdd() || $FDCTypes_list->isGridEdit() || $FDCTypes->isConfirm())) {
		$FDCTypes_list->KeyCount = $CurrentForm->getValue($FDCTypes_list->FormKeyCountName);
		$FDCTypes_list->StopRecord = $FDCTypes_list->StartRecord + $FDCTypes_list->KeyCount - 1;
	}
}
$FDCTypes_list->RecordCount = $FDCTypes_list->StartRecord - 1;
if ($FDCTypes_list->Recordset && !$FDCTypes_list->Recordset->EOF) {
	$FDCTypes_list->Recordset->moveFirst();
	$selectLimit = $FDCTypes_list->UseSelectLimit;
	if (!$selectLimit && $FDCTypes_list->StartRecord > 1)
		$FDCTypes_list->Recordset->move($FDCTypes_list->StartRecord - 1);
} elseif (!$FDCTypes->AllowAddDeleteRow && $FDCTypes_list->StopRecord == 0) {
	$FDCTypes_list->StopRecord = $FDCTypes->GridAddRowCount;
}

// Initialize aggregate
$FDCTypes->RowType = ROWTYPE_AGGREGATEINIT;
$FDCTypes->resetAttributes();
$FDCTypes_list->renderRow();
$FDCTypes_list->EditRowCount = 0;
if ($FDCTypes_list->isEdit())
	$FDCTypes_list->RowIndex = 1;
if ($FDCTypes_list->isGridAdd())
	$FDCTypes_list->RowIndex = 0;
if ($FDCTypes_list->isGridEdit())
	$FDCTypes_list->RowIndex = 0;
while ($FDCTypes_list->RecordCount < $FDCTypes_list->StopRecord) {
	$FDCTypes_list->RecordCount++;
	if ($FDCTypes_list->RecordCount >= $FDCTypes_list->StartRecord) {
		$FDCTypes_list->RowCount++;
		if ($FDCTypes_list->isGridAdd() || $FDCTypes_list->isGridEdit() || $FDCTypes->isConfirm()) {
			$FDCTypes_list->RowIndex++;
			$CurrentForm->Index = $FDCTypes_list->RowIndex;
			if ($CurrentForm->hasValue($FDCTypes_list->FormActionName) && ($FDCTypes->isConfirm() || $FDCTypes_list->EventCancelled))
				$FDCTypes_list->RowAction = strval($CurrentForm->getValue($FDCTypes_list->FormActionName));
			elseif ($FDCTypes_list->isGridAdd())
				$FDCTypes_list->RowAction = "insert";
			else
				$FDCTypes_list->RowAction = "";
		}

		// Set up key count
		$FDCTypes_list->KeyCount = $FDCTypes_list->RowIndex;

		// Init row class and style
		$FDCTypes->resetAttributes();
		$FDCTypes->CssClass = "";
		if ($FDCTypes_list->isGridAdd()) {
			$FDCTypes_list->loadRowValues(); // Load default values
		} else {
			$FDCTypes_list->loadRowValues($FDCTypes_list->Recordset); // Load row values
		}
		$FDCTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($FDCTypes_list->isGridAdd()) // Grid add
			$FDCTypes->RowType = ROWTYPE_ADD; // Render add
		if ($FDCTypes_list->isGridAdd() && $FDCTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$FDCTypes_list->restoreCurrentRowFormValues($FDCTypes_list->RowIndex); // Restore form values
		if ($FDCTypes_list->isEdit()) {
			if ($FDCTypes_list->checkInlineEditKey() && $FDCTypes_list->EditRowCount == 0) { // Inline edit
				$FDCTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($FDCTypes_list->isGridEdit()) { // Grid edit
			if ($FDCTypes->EventCancelled)
				$FDCTypes_list->restoreCurrentRowFormValues($FDCTypes_list->RowIndex); // Restore form values
			if ($FDCTypes_list->RowAction == "insert")
				$FDCTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$FDCTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($FDCTypes_list->isEdit() && $FDCTypes->RowType == ROWTYPE_EDIT && $FDCTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$FDCTypes_list->restoreFormValues(); // Restore form values
		}
		if ($FDCTypes_list->isGridEdit() && ($FDCTypes->RowType == ROWTYPE_EDIT || $FDCTypes->RowType == ROWTYPE_ADD) && $FDCTypes->EventCancelled) // Update failed
			$FDCTypes_list->restoreCurrentRowFormValues($FDCTypes_list->RowIndex); // Restore form values
		if ($FDCTypes->RowType == ROWTYPE_EDIT) // Edit row
			$FDCTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$FDCTypes->RowAttrs->merge(["data-rowindex" => $FDCTypes_list->RowCount, "id" => "r" . $FDCTypes_list->RowCount . "_FDCTypes", "data-rowtype" => $FDCTypes->RowType]);

		// Render row
		$FDCTypes_list->renderRow();

		// Render list options
		$FDCTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($FDCTypes_list->RowAction != "delete" && $FDCTypes_list->RowAction != "insertdelete" && !($FDCTypes_list->RowAction == "insert" && $FDCTypes->isConfirm() && $FDCTypes_list->emptyRow())) {
?>
	<tr <?php echo $FDCTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FDCTypes_list->ListOptions->render("body", "left", $FDCTypes_list->RowCount);
?>
	<?php if ($FDCTypes_list->FdcType_Idn->Visible) { // FdcType_Idn ?>
		<td data-name="FdcType_Idn" <?php echo $FDCTypes_list->FdcType_Idn->cellAttributes() ?>>
<?php if ($FDCTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_FdcType_Idn" class="form-group"></span>
<input type="hidden" data-table="FDCTypes" data-field="x_FdcType_Idn" name="o<?php echo $FDCTypes_list->RowIndex ?>_FdcType_Idn" id="o<?php echo $FDCTypes_list->RowIndex ?>_FdcType_Idn" value="<?php echo HtmlEncode($FDCTypes_list->FdcType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($FDCTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_FdcType_Idn" class="form-group">
<span<?php echo $FDCTypes_list->FdcType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($FDCTypes_list->FdcType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="FDCTypes" data-field="x_FdcType_Idn" name="x<?php echo $FDCTypes_list->RowIndex ?>_FdcType_Idn" id="x<?php echo $FDCTypes_list->RowIndex ?>_FdcType_Idn" value="<?php echo HtmlEncode($FDCTypes_list->FdcType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($FDCTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_FdcType_Idn">
<span<?php echo $FDCTypes_list->FdcType_Idn->viewAttributes() ?>><?php echo $FDCTypes_list->FdcType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FDCTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $FDCTypes_list->Name->cellAttributes() ?>>
<?php if ($FDCTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_Name" class="form-group">
<input type="text" data-table="FDCTypes" data-field="x_Name" name="x<?php echo $FDCTypes_list->RowIndex ?>_Name" id="x<?php echo $FDCTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FDCTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FDCTypes_list->Name->EditValue ?>"<?php echo $FDCTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FDCTypes" data-field="x_Name" name="o<?php echo $FDCTypes_list->RowIndex ?>_Name" id="o<?php echo $FDCTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FDCTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($FDCTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_Name" class="form-group">
<input type="text" data-table="FDCTypes" data-field="x_Name" name="x<?php echo $FDCTypes_list->RowIndex ?>_Name" id="x<?php echo $FDCTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FDCTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FDCTypes_list->Name->EditValue ?>"<?php echo $FDCTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FDCTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_Name">
<span<?php echo $FDCTypes_list->Name->viewAttributes() ?>><?php echo $FDCTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FDCTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $FDCTypes_list->Rank->cellAttributes() ?>>
<?php if ($FDCTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_Rank" class="form-group">
<input type="text" data-table="FDCTypes" data-field="x_Rank" name="x<?php echo $FDCTypes_list->RowIndex ?>_Rank" id="x<?php echo $FDCTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FDCTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FDCTypes_list->Rank->EditValue ?>"<?php echo $FDCTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FDCTypes" data-field="x_Rank" name="o<?php echo $FDCTypes_list->RowIndex ?>_Rank" id="o<?php echo $FDCTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FDCTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($FDCTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_Rank" class="form-group">
<input type="text" data-table="FDCTypes" data-field="x_Rank" name="x<?php echo $FDCTypes_list->RowIndex ?>_Rank" id="x<?php echo $FDCTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FDCTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FDCTypes_list->Rank->EditValue ?>"<?php echo $FDCTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FDCTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_Rank">
<span<?php echo $FDCTypes_list->Rank->viewAttributes() ?>><?php echo $FDCTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FDCTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $FDCTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($FDCTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FDCTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FDCTypes" data-field="x_ActiveFlag" name="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]_672331" value="1"<?php echo $selwrk ?><?php echo $FDCTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]_672331"></label>
</div>
</span>
<input type="hidden" data-table="FDCTypes" data-field="x_ActiveFlag" name="o<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FDCTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($FDCTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FDCTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FDCTypes" data-field="x_ActiveFlag" name="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]_559087" value="1"<?php echo $selwrk ?><?php echo $FDCTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]_559087"></label>
</div>
</span>
<?php } ?>
<?php if ($FDCTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FDCTypes_list->RowCount ?>_FDCTypes_ActiveFlag">
<span<?php echo $FDCTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FDCTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FDCTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FDCTypes_list->ListOptions->render("body", "right", $FDCTypes_list->RowCount);
?>
	</tr>
<?php if ($FDCTypes->RowType == ROWTYPE_ADD || $FDCTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fFDCTypeslist", "load"], function() {
	fFDCTypeslist.updateLists(<?php echo $FDCTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$FDCTypes_list->isGridAdd())
		if (!$FDCTypes_list->Recordset->EOF)
			$FDCTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($FDCTypes_list->isGridAdd() || $FDCTypes_list->isGridEdit()) {
		$FDCTypes_list->RowIndex = '$rowindex$';
		$FDCTypes_list->loadRowValues();

		// Set row properties
		$FDCTypes->resetAttributes();
		$FDCTypes->RowAttrs->merge(["data-rowindex" => $FDCTypes_list->RowIndex, "id" => "r0_FDCTypes", "data-rowtype" => ROWTYPE_ADD]);
		$FDCTypes->RowAttrs->appendClass("ew-template");
		$FDCTypes->RowType = ROWTYPE_ADD;

		// Render row
		$FDCTypes_list->renderRow();

		// Render list options
		$FDCTypes_list->renderListOptions();
		$FDCTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $FDCTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FDCTypes_list->ListOptions->render("body", "left", $FDCTypes_list->RowIndex);
?>
	<?php if ($FDCTypes_list->FdcType_Idn->Visible) { // FdcType_Idn ?>
		<td data-name="FdcType_Idn">
<span id="el$rowindex$_FDCTypes_FdcType_Idn" class="form-group FDCTypes_FdcType_Idn"></span>
<input type="hidden" data-table="FDCTypes" data-field="x_FdcType_Idn" name="o<?php echo $FDCTypes_list->RowIndex ?>_FdcType_Idn" id="o<?php echo $FDCTypes_list->RowIndex ?>_FdcType_Idn" value="<?php echo HtmlEncode($FDCTypes_list->FdcType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FDCTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_FDCTypes_Name" class="form-group FDCTypes_Name">
<input type="text" data-table="FDCTypes" data-field="x_Name" name="x<?php echo $FDCTypes_list->RowIndex ?>_Name" id="x<?php echo $FDCTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FDCTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FDCTypes_list->Name->EditValue ?>"<?php echo $FDCTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FDCTypes" data-field="x_Name" name="o<?php echo $FDCTypes_list->RowIndex ?>_Name" id="o<?php echo $FDCTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FDCTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FDCTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_FDCTypes_Rank" class="form-group FDCTypes_Rank">
<input type="text" data-table="FDCTypes" data-field="x_Rank" name="x<?php echo $FDCTypes_list->RowIndex ?>_Rank" id="x<?php echo $FDCTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FDCTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FDCTypes_list->Rank->EditValue ?>"<?php echo $FDCTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FDCTypes" data-field="x_Rank" name="o<?php echo $FDCTypes_list->RowIndex ?>_Rank" id="o<?php echo $FDCTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FDCTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FDCTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_FDCTypes_ActiveFlag" class="form-group FDCTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($FDCTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FDCTypes" data-field="x_ActiveFlag" name="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]_424351" value="1"<?php echo $selwrk ?><?php echo $FDCTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]_424351"></label>
</div>
</span>
<input type="hidden" data-table="FDCTypes" data-field="x_ActiveFlag" name="o<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FDCTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FDCTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FDCTypes_list->ListOptions->render("body", "right", $FDCTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fFDCTypeslist", "load"], function() {
	fFDCTypeslist.updateLists(<?php echo $FDCTypes_list->RowIndex ?>);
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
<?php if ($FDCTypes_list->isAdd() || $FDCTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $FDCTypes_list->FormKeyCountName ?>" id="<?php echo $FDCTypes_list->FormKeyCountName ?>" value="<?php echo $FDCTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($FDCTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $FDCTypes_list->FormKeyCountName ?>" id="<?php echo $FDCTypes_list->FormKeyCountName ?>" value="<?php echo $FDCTypes_list->KeyCount ?>">
<?php echo $FDCTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($FDCTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $FDCTypes_list->FormKeyCountName ?>" id="<?php echo $FDCTypes_list->FormKeyCountName ?>" value="<?php echo $FDCTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($FDCTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $FDCTypes_list->FormKeyCountName ?>" id="<?php echo $FDCTypes_list->FormKeyCountName ?>" value="<?php echo $FDCTypes_list->KeyCount ?>">
<?php echo $FDCTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$FDCTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($FDCTypes_list->Recordset)
	$FDCTypes_list->Recordset->Close();
?>
<?php if (!$FDCTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$FDCTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FDCTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $FDCTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($FDCTypes_list->TotalRecords == 0 && !$FDCTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $FDCTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$FDCTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$FDCTypes_list->isExport()) { ?>
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
$FDCTypes_list->terminate();
?>