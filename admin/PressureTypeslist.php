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
$PressureTypes_list = new PressureTypes_list();

// Run the page
$PressureTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PressureTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$PressureTypes_list->isExport()) { ?>
<script>
var fPressureTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fPressureTypeslist = currentForm = new ew.Form("fPressureTypeslist", "list");
	fPressureTypeslist.formKeyCountName = '<?php echo $PressureTypes_list->FormKeyCountName ?>';

	// Validate form
	fPressureTypeslist.validate = function() {
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
			<?php if ($PressureTypes_list->PressureType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PressureType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PressureTypes_list->PressureType_Idn->caption(), $PressureTypes_list->PressureType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PressureTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PressureTypes_list->Name->caption(), $PressureTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PressureTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PressureTypes_list->Rank->caption(), $PressureTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PressureTypes_list->Rank->errorMessage()) ?>");
			<?php if ($PressureTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PressureTypes_list->ActiveFlag->caption(), $PressureTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fPressureTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fPressureTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPressureTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fPressureTypeslist.lists["x_ActiveFlag[]"] = <?php echo $PressureTypes_list->ActiveFlag->Lookup->toClientList($PressureTypes_list) ?>;
	fPressureTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($PressureTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fPressureTypeslist");
});
var fPressureTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fPressureTypeslistsrch = currentSearchForm = new ew.Form("fPressureTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fPressureTypeslistsrch.filterList = <?php echo $PressureTypes_list->getFilterList() ?>;
	loadjs.done("fPressureTypeslistsrch");
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
<?php if (!$PressureTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($PressureTypes_list->TotalRecords > 0 && $PressureTypes_list->ExportOptions->visible()) { ?>
<?php $PressureTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($PressureTypes_list->ImportOptions->visible()) { ?>
<?php $PressureTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($PressureTypes_list->SearchOptions->visible()) { ?>
<?php $PressureTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($PressureTypes_list->FilterOptions->visible()) { ?>
<?php $PressureTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$PressureTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$PressureTypes_list->isExport() && !$PressureTypes->CurrentAction) { ?>
<form name="fPressureTypeslistsrch" id="fPressureTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fPressureTypeslistsrch-search-panel" class="<?php echo $PressureTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="PressureTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $PressureTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($PressureTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($PressureTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $PressureTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($PressureTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($PressureTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($PressureTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($PressureTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $PressureTypes_list->showPageHeader(); ?>
<?php
$PressureTypes_list->showMessage();
?>
<?php if ($PressureTypes_list->TotalRecords > 0 || $PressureTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($PressureTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> PressureTypes">
<?php if (!$PressureTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$PressureTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PressureTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $PressureTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fPressureTypeslist" id="fPressureTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PressureTypes">
<div id="gmp_PressureTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($PressureTypes_list->TotalRecords > 0 || $PressureTypes_list->isAdd() || $PressureTypes_list->isCopy() || $PressureTypes_list->isGridEdit()) { ?>
<table id="tbl_PressureTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$PressureTypes->RowType = ROWTYPE_HEADER;

// Render list options
$PressureTypes_list->renderListOptions();

// Render list options (header, left)
$PressureTypes_list->ListOptions->render("header", "left");
?>
<?php if ($PressureTypes_list->PressureType_Idn->Visible) { // PressureType_Idn ?>
	<?php if ($PressureTypes_list->SortUrl($PressureTypes_list->PressureType_Idn) == "") { ?>
		<th data-name="PressureType_Idn" class="<?php echo $PressureTypes_list->PressureType_Idn->headerCellClass() ?>"><div id="elh_PressureTypes_PressureType_Idn" class="PressureTypes_PressureType_Idn"><div class="ew-table-header-caption"><?php echo $PressureTypes_list->PressureType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PressureType_Idn" class="<?php echo $PressureTypes_list->PressureType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PressureTypes_list->SortUrl($PressureTypes_list->PressureType_Idn) ?>', 1);"><div id="elh_PressureTypes_PressureType_Idn" class="PressureTypes_PressureType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PressureTypes_list->PressureType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($PressureTypes_list->PressureType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PressureTypes_list->PressureType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PressureTypes_list->Name->Visible) { // Name ?>
	<?php if ($PressureTypes_list->SortUrl($PressureTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $PressureTypes_list->Name->headerCellClass() ?>"><div id="elh_PressureTypes_Name" class="PressureTypes_Name"><div class="ew-table-header-caption"><?php echo $PressureTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $PressureTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PressureTypes_list->SortUrl($PressureTypes_list->Name) ?>', 1);"><div id="elh_PressureTypes_Name" class="PressureTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PressureTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PressureTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PressureTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PressureTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($PressureTypes_list->SortUrl($PressureTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $PressureTypes_list->Rank->headerCellClass() ?>"><div id="elh_PressureTypes_Rank" class="PressureTypes_Rank"><div class="ew-table-header-caption"><?php echo $PressureTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $PressureTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PressureTypes_list->SortUrl($PressureTypes_list->Rank) ?>', 1);"><div id="elh_PressureTypes_Rank" class="PressureTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PressureTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($PressureTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PressureTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PressureTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($PressureTypes_list->SortUrl($PressureTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $PressureTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_PressureTypes_ActiveFlag" class="PressureTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $PressureTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $PressureTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PressureTypes_list->SortUrl($PressureTypes_list->ActiveFlag) ?>', 1);"><div id="elh_PressureTypes_ActiveFlag" class="PressureTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PressureTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($PressureTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PressureTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$PressureTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($PressureTypes_list->isAdd() || $PressureTypes_list->isCopy()) {
		$PressureTypes_list->RowIndex = 0;
		$PressureTypes_list->KeyCount = $PressureTypes_list->RowIndex;
		if ($PressureTypes_list->isCopy() && !$PressureTypes_list->loadRow())
			$PressureTypes->CurrentAction = "add";
		if ($PressureTypes_list->isAdd())
			$PressureTypes_list->loadRowValues();
		if ($PressureTypes->EventCancelled) // Insert failed
			$PressureTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$PressureTypes->resetAttributes();
		$PressureTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_PressureTypes", "data-rowtype" => ROWTYPE_ADD]);
		$PressureTypes->RowType = ROWTYPE_ADD;

		// Render row
		$PressureTypes_list->renderRow();

		// Render list options
		$PressureTypes_list->renderListOptions();
		$PressureTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $PressureTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PressureTypes_list->ListOptions->render("body", "left", $PressureTypes_list->RowCount);
?>
	<?php if ($PressureTypes_list->PressureType_Idn->Visible) { // PressureType_Idn ?>
		<td data-name="PressureType_Idn">
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_PressureType_Idn" class="form-group PressureTypes_PressureType_Idn"></span>
<input type="hidden" data-table="PressureTypes" data-field="x_PressureType_Idn" name="o<?php echo $PressureTypes_list->RowIndex ?>_PressureType_Idn" id="o<?php echo $PressureTypes_list->RowIndex ?>_PressureType_Idn" value="<?php echo HtmlEncode($PressureTypes_list->PressureType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PressureTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_Name" class="form-group PressureTypes_Name">
<input type="text" data-table="PressureTypes" data-field="x_Name" name="x<?php echo $PressureTypes_list->RowIndex ?>_Name" id="x<?php echo $PressureTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PressureTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $PressureTypes_list->Name->EditValue ?>"<?php echo $PressureTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PressureTypes" data-field="x_Name" name="o<?php echo $PressureTypes_list->RowIndex ?>_Name" id="o<?php echo $PressureTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PressureTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PressureTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_Rank" class="form-group PressureTypes_Rank">
<input type="text" data-table="PressureTypes" data-field="x_Rank" name="x<?php echo $PressureTypes_list->RowIndex ?>_Rank" id="x<?php echo $PressureTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PressureTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PressureTypes_list->Rank->EditValue ?>"<?php echo $PressureTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PressureTypes" data-field="x_Rank" name="o<?php echo $PressureTypes_list->RowIndex ?>_Rank" id="o<?php echo $PressureTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PressureTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PressureTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_ActiveFlag" class="form-group PressureTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($PressureTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PressureTypes" data-field="x_ActiveFlag" name="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]_412546" value="1"<?php echo $selwrk ?><?php echo $PressureTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]_412546"></label>
</div>
</span>
<input type="hidden" data-table="PressureTypes" data-field="x_ActiveFlag" name="o<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PressureTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PressureTypes_list->ListOptions->render("body", "right", $PressureTypes_list->RowCount);
?>
<script>
loadjs.ready(["fPressureTypeslist", "load"], function() {
	fPressureTypeslist.updateLists(<?php echo $PressureTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($PressureTypes_list->ExportAll && $PressureTypes_list->isExport()) {
	$PressureTypes_list->StopRecord = $PressureTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($PressureTypes_list->TotalRecords > $PressureTypes_list->StartRecord + $PressureTypes_list->DisplayRecords - 1)
		$PressureTypes_list->StopRecord = $PressureTypes_list->StartRecord + $PressureTypes_list->DisplayRecords - 1;
	else
		$PressureTypes_list->StopRecord = $PressureTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($PressureTypes->isConfirm() || $PressureTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($PressureTypes_list->FormKeyCountName) && ($PressureTypes_list->isGridAdd() || $PressureTypes_list->isGridEdit() || $PressureTypes->isConfirm())) {
		$PressureTypes_list->KeyCount = $CurrentForm->getValue($PressureTypes_list->FormKeyCountName);
		$PressureTypes_list->StopRecord = $PressureTypes_list->StartRecord + $PressureTypes_list->KeyCount - 1;
	}
}
$PressureTypes_list->RecordCount = $PressureTypes_list->StartRecord - 1;
if ($PressureTypes_list->Recordset && !$PressureTypes_list->Recordset->EOF) {
	$PressureTypes_list->Recordset->moveFirst();
	$selectLimit = $PressureTypes_list->UseSelectLimit;
	if (!$selectLimit && $PressureTypes_list->StartRecord > 1)
		$PressureTypes_list->Recordset->move($PressureTypes_list->StartRecord - 1);
} elseif (!$PressureTypes->AllowAddDeleteRow && $PressureTypes_list->StopRecord == 0) {
	$PressureTypes_list->StopRecord = $PressureTypes->GridAddRowCount;
}

// Initialize aggregate
$PressureTypes->RowType = ROWTYPE_AGGREGATEINIT;
$PressureTypes->resetAttributes();
$PressureTypes_list->renderRow();
$PressureTypes_list->EditRowCount = 0;
if ($PressureTypes_list->isEdit())
	$PressureTypes_list->RowIndex = 1;
if ($PressureTypes_list->isGridAdd())
	$PressureTypes_list->RowIndex = 0;
if ($PressureTypes_list->isGridEdit())
	$PressureTypes_list->RowIndex = 0;
while ($PressureTypes_list->RecordCount < $PressureTypes_list->StopRecord) {
	$PressureTypes_list->RecordCount++;
	if ($PressureTypes_list->RecordCount >= $PressureTypes_list->StartRecord) {
		$PressureTypes_list->RowCount++;
		if ($PressureTypes_list->isGridAdd() || $PressureTypes_list->isGridEdit() || $PressureTypes->isConfirm()) {
			$PressureTypes_list->RowIndex++;
			$CurrentForm->Index = $PressureTypes_list->RowIndex;
			if ($CurrentForm->hasValue($PressureTypes_list->FormActionName) && ($PressureTypes->isConfirm() || $PressureTypes_list->EventCancelled))
				$PressureTypes_list->RowAction = strval($CurrentForm->getValue($PressureTypes_list->FormActionName));
			elseif ($PressureTypes_list->isGridAdd())
				$PressureTypes_list->RowAction = "insert";
			else
				$PressureTypes_list->RowAction = "";
		}

		// Set up key count
		$PressureTypes_list->KeyCount = $PressureTypes_list->RowIndex;

		// Init row class and style
		$PressureTypes->resetAttributes();
		$PressureTypes->CssClass = "";
		if ($PressureTypes_list->isGridAdd()) {
			$PressureTypes_list->loadRowValues(); // Load default values
		} else {
			$PressureTypes_list->loadRowValues($PressureTypes_list->Recordset); // Load row values
		}
		$PressureTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($PressureTypes_list->isGridAdd()) // Grid add
			$PressureTypes->RowType = ROWTYPE_ADD; // Render add
		if ($PressureTypes_list->isGridAdd() && $PressureTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$PressureTypes_list->restoreCurrentRowFormValues($PressureTypes_list->RowIndex); // Restore form values
		if ($PressureTypes_list->isEdit()) {
			if ($PressureTypes_list->checkInlineEditKey() && $PressureTypes_list->EditRowCount == 0) { // Inline edit
				$PressureTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($PressureTypes_list->isGridEdit()) { // Grid edit
			if ($PressureTypes->EventCancelled)
				$PressureTypes_list->restoreCurrentRowFormValues($PressureTypes_list->RowIndex); // Restore form values
			if ($PressureTypes_list->RowAction == "insert")
				$PressureTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$PressureTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($PressureTypes_list->isEdit() && $PressureTypes->RowType == ROWTYPE_EDIT && $PressureTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$PressureTypes_list->restoreFormValues(); // Restore form values
		}
		if ($PressureTypes_list->isGridEdit() && ($PressureTypes->RowType == ROWTYPE_EDIT || $PressureTypes->RowType == ROWTYPE_ADD) && $PressureTypes->EventCancelled) // Update failed
			$PressureTypes_list->restoreCurrentRowFormValues($PressureTypes_list->RowIndex); // Restore form values
		if ($PressureTypes->RowType == ROWTYPE_EDIT) // Edit row
			$PressureTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$PressureTypes->RowAttrs->merge(["data-rowindex" => $PressureTypes_list->RowCount, "id" => "r" . $PressureTypes_list->RowCount . "_PressureTypes", "data-rowtype" => $PressureTypes->RowType]);

		// Render row
		$PressureTypes_list->renderRow();

		// Render list options
		$PressureTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($PressureTypes_list->RowAction != "delete" && $PressureTypes_list->RowAction != "insertdelete" && !($PressureTypes_list->RowAction == "insert" && $PressureTypes->isConfirm() && $PressureTypes_list->emptyRow())) {
?>
	<tr <?php echo $PressureTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PressureTypes_list->ListOptions->render("body", "left", $PressureTypes_list->RowCount);
?>
	<?php if ($PressureTypes_list->PressureType_Idn->Visible) { // PressureType_Idn ?>
		<td data-name="PressureType_Idn" <?php echo $PressureTypes_list->PressureType_Idn->cellAttributes() ?>>
<?php if ($PressureTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_PressureType_Idn" class="form-group"></span>
<input type="hidden" data-table="PressureTypes" data-field="x_PressureType_Idn" name="o<?php echo $PressureTypes_list->RowIndex ?>_PressureType_Idn" id="o<?php echo $PressureTypes_list->RowIndex ?>_PressureType_Idn" value="<?php echo HtmlEncode($PressureTypes_list->PressureType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($PressureTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_PressureType_Idn" class="form-group">
<span<?php echo $PressureTypes_list->PressureType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($PressureTypes_list->PressureType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="PressureTypes" data-field="x_PressureType_Idn" name="x<?php echo $PressureTypes_list->RowIndex ?>_PressureType_Idn" id="x<?php echo $PressureTypes_list->RowIndex ?>_PressureType_Idn" value="<?php echo HtmlEncode($PressureTypes_list->PressureType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($PressureTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_PressureType_Idn">
<span<?php echo $PressureTypes_list->PressureType_Idn->viewAttributes() ?>><?php echo $PressureTypes_list->PressureType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PressureTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $PressureTypes_list->Name->cellAttributes() ?>>
<?php if ($PressureTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_Name" class="form-group">
<input type="text" data-table="PressureTypes" data-field="x_Name" name="x<?php echo $PressureTypes_list->RowIndex ?>_Name" id="x<?php echo $PressureTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PressureTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $PressureTypes_list->Name->EditValue ?>"<?php echo $PressureTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PressureTypes" data-field="x_Name" name="o<?php echo $PressureTypes_list->RowIndex ?>_Name" id="o<?php echo $PressureTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PressureTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($PressureTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_Name" class="form-group">
<input type="text" data-table="PressureTypes" data-field="x_Name" name="x<?php echo $PressureTypes_list->RowIndex ?>_Name" id="x<?php echo $PressureTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PressureTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $PressureTypes_list->Name->EditValue ?>"<?php echo $PressureTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($PressureTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_Name">
<span<?php echo $PressureTypes_list->Name->viewAttributes() ?>><?php echo $PressureTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PressureTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $PressureTypes_list->Rank->cellAttributes() ?>>
<?php if ($PressureTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_Rank" class="form-group">
<input type="text" data-table="PressureTypes" data-field="x_Rank" name="x<?php echo $PressureTypes_list->RowIndex ?>_Rank" id="x<?php echo $PressureTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PressureTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PressureTypes_list->Rank->EditValue ?>"<?php echo $PressureTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PressureTypes" data-field="x_Rank" name="o<?php echo $PressureTypes_list->RowIndex ?>_Rank" id="o<?php echo $PressureTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PressureTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($PressureTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_Rank" class="form-group">
<input type="text" data-table="PressureTypes" data-field="x_Rank" name="x<?php echo $PressureTypes_list->RowIndex ?>_Rank" id="x<?php echo $PressureTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PressureTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PressureTypes_list->Rank->EditValue ?>"<?php echo $PressureTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($PressureTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_Rank">
<span<?php echo $PressureTypes_list->Rank->viewAttributes() ?>><?php echo $PressureTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PressureTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $PressureTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($PressureTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($PressureTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PressureTypes" data-field="x_ActiveFlag" name="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]_283680" value="1"<?php echo $selwrk ?><?php echo $PressureTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]_283680"></label>
</div>
</span>
<input type="hidden" data-table="PressureTypes" data-field="x_ActiveFlag" name="o<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PressureTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($PressureTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($PressureTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PressureTypes" data-field="x_ActiveFlag" name="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]_855033" value="1"<?php echo $selwrk ?><?php echo $PressureTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]_855033"></label>
</div>
</span>
<?php } ?>
<?php if ($PressureTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PressureTypes_list->RowCount ?>_PressureTypes_ActiveFlag">
<span<?php echo $PressureTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PressureTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PressureTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PressureTypes_list->ListOptions->render("body", "right", $PressureTypes_list->RowCount);
?>
	</tr>
<?php if ($PressureTypes->RowType == ROWTYPE_ADD || $PressureTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fPressureTypeslist", "load"], function() {
	fPressureTypeslist.updateLists(<?php echo $PressureTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$PressureTypes_list->isGridAdd())
		if (!$PressureTypes_list->Recordset->EOF)
			$PressureTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($PressureTypes_list->isGridAdd() || $PressureTypes_list->isGridEdit()) {
		$PressureTypes_list->RowIndex = '$rowindex$';
		$PressureTypes_list->loadRowValues();

		// Set row properties
		$PressureTypes->resetAttributes();
		$PressureTypes->RowAttrs->merge(["data-rowindex" => $PressureTypes_list->RowIndex, "id" => "r0_PressureTypes", "data-rowtype" => ROWTYPE_ADD]);
		$PressureTypes->RowAttrs->appendClass("ew-template");
		$PressureTypes->RowType = ROWTYPE_ADD;

		// Render row
		$PressureTypes_list->renderRow();

		// Render list options
		$PressureTypes_list->renderListOptions();
		$PressureTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $PressureTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PressureTypes_list->ListOptions->render("body", "left", $PressureTypes_list->RowIndex);
?>
	<?php if ($PressureTypes_list->PressureType_Idn->Visible) { // PressureType_Idn ?>
		<td data-name="PressureType_Idn">
<span id="el$rowindex$_PressureTypes_PressureType_Idn" class="form-group PressureTypes_PressureType_Idn"></span>
<input type="hidden" data-table="PressureTypes" data-field="x_PressureType_Idn" name="o<?php echo $PressureTypes_list->RowIndex ?>_PressureType_Idn" id="o<?php echo $PressureTypes_list->RowIndex ?>_PressureType_Idn" value="<?php echo HtmlEncode($PressureTypes_list->PressureType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PressureTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_PressureTypes_Name" class="form-group PressureTypes_Name">
<input type="text" data-table="PressureTypes" data-field="x_Name" name="x<?php echo $PressureTypes_list->RowIndex ?>_Name" id="x<?php echo $PressureTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PressureTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $PressureTypes_list->Name->EditValue ?>"<?php echo $PressureTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PressureTypes" data-field="x_Name" name="o<?php echo $PressureTypes_list->RowIndex ?>_Name" id="o<?php echo $PressureTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PressureTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PressureTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_PressureTypes_Rank" class="form-group PressureTypes_Rank">
<input type="text" data-table="PressureTypes" data-field="x_Rank" name="x<?php echo $PressureTypes_list->RowIndex ?>_Rank" id="x<?php echo $PressureTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PressureTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PressureTypes_list->Rank->EditValue ?>"<?php echo $PressureTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PressureTypes" data-field="x_Rank" name="o<?php echo $PressureTypes_list->RowIndex ?>_Rank" id="o<?php echo $PressureTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PressureTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PressureTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_PressureTypes_ActiveFlag" class="form-group PressureTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($PressureTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PressureTypes" data-field="x_ActiveFlag" name="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]_397452" value="1"<?php echo $selwrk ?><?php echo $PressureTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]_397452"></label>
</div>
</span>
<input type="hidden" data-table="PressureTypes" data-field="x_ActiveFlag" name="o<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PressureTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PressureTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PressureTypes_list->ListOptions->render("body", "right", $PressureTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fPressureTypeslist", "load"], function() {
	fPressureTypeslist.updateLists(<?php echo $PressureTypes_list->RowIndex ?>);
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
<?php if ($PressureTypes_list->isAdd() || $PressureTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $PressureTypes_list->FormKeyCountName ?>" id="<?php echo $PressureTypes_list->FormKeyCountName ?>" value="<?php echo $PressureTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($PressureTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $PressureTypes_list->FormKeyCountName ?>" id="<?php echo $PressureTypes_list->FormKeyCountName ?>" value="<?php echo $PressureTypes_list->KeyCount ?>">
<?php echo $PressureTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($PressureTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $PressureTypes_list->FormKeyCountName ?>" id="<?php echo $PressureTypes_list->FormKeyCountName ?>" value="<?php echo $PressureTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($PressureTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $PressureTypes_list->FormKeyCountName ?>" id="<?php echo $PressureTypes_list->FormKeyCountName ?>" value="<?php echo $PressureTypes_list->KeyCount ?>">
<?php echo $PressureTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$PressureTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($PressureTypes_list->Recordset)
	$PressureTypes_list->Recordset->Close();
?>
<?php if (!$PressureTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$PressureTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PressureTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $PressureTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($PressureTypes_list->TotalRecords == 0 && !$PressureTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $PressureTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$PressureTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$PressureTypes_list->isExport()) { ?>
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
$PressureTypes_list->terminate();
?>