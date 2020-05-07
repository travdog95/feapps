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
$GradeTypes_list = new GradeTypes_list();

// Run the page
$GradeTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GradeTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$GradeTypes_list->isExport()) { ?>
<script>
var fGradeTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fGradeTypeslist = currentForm = new ew.Form("fGradeTypeslist", "list");
	fGradeTypeslist.formKeyCountName = '<?php echo $GradeTypes_list->FormKeyCountName ?>';

	// Validate form
	fGradeTypeslist.validate = function() {
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
			<?php if ($GradeTypes_list->GradeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GradeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GradeTypes_list->GradeType_Idn->caption(), $GradeTypes_list->GradeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GradeTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GradeTypes_list->Name->caption(), $GradeTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GradeTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GradeTypes_list->Rank->caption(), $GradeTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($GradeTypes_list->Rank->errorMessage()) ?>");
			<?php if ($GradeTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GradeTypes_list->ActiveFlag->caption(), $GradeTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fGradeTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fGradeTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fGradeTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fGradeTypeslist.lists["x_ActiveFlag[]"] = <?php echo $GradeTypes_list->ActiveFlag->Lookup->toClientList($GradeTypes_list) ?>;
	fGradeTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($GradeTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fGradeTypeslist");
});
var fGradeTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fGradeTypeslistsrch = currentSearchForm = new ew.Form("fGradeTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fGradeTypeslistsrch.filterList = <?php echo $GradeTypes_list->getFilterList() ?>;
	loadjs.done("fGradeTypeslistsrch");
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
<?php if (!$GradeTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($GradeTypes_list->TotalRecords > 0 && $GradeTypes_list->ExportOptions->visible()) { ?>
<?php $GradeTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($GradeTypes_list->ImportOptions->visible()) { ?>
<?php $GradeTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($GradeTypes_list->SearchOptions->visible()) { ?>
<?php $GradeTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($GradeTypes_list->FilterOptions->visible()) { ?>
<?php $GradeTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$GradeTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$GradeTypes_list->isExport() && !$GradeTypes->CurrentAction) { ?>
<form name="fGradeTypeslistsrch" id="fGradeTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fGradeTypeslistsrch-search-panel" class="<?php echo $GradeTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="GradeTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $GradeTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($GradeTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($GradeTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $GradeTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($GradeTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($GradeTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($GradeTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($GradeTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $GradeTypes_list->showPageHeader(); ?>
<?php
$GradeTypes_list->showMessage();
?>
<?php if ($GradeTypes_list->TotalRecords > 0 || $GradeTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($GradeTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> GradeTypes">
<?php if (!$GradeTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$GradeTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GradeTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $GradeTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fGradeTypeslist" id="fGradeTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GradeTypes">
<div id="gmp_GradeTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($GradeTypes_list->TotalRecords > 0 || $GradeTypes_list->isAdd() || $GradeTypes_list->isCopy() || $GradeTypes_list->isGridEdit()) { ?>
<table id="tbl_GradeTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$GradeTypes->RowType = ROWTYPE_HEADER;

// Render list options
$GradeTypes_list->renderListOptions();

// Render list options (header, left)
$GradeTypes_list->ListOptions->render("header", "left");
?>
<?php if ($GradeTypes_list->GradeType_Idn->Visible) { // GradeType_Idn ?>
	<?php if ($GradeTypes_list->SortUrl($GradeTypes_list->GradeType_Idn) == "") { ?>
		<th data-name="GradeType_Idn" class="<?php echo $GradeTypes_list->GradeType_Idn->headerCellClass() ?>"><div id="elh_GradeTypes_GradeType_Idn" class="GradeTypes_GradeType_Idn"><div class="ew-table-header-caption"><?php echo $GradeTypes_list->GradeType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GradeType_Idn" class="<?php echo $GradeTypes_list->GradeType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GradeTypes_list->SortUrl($GradeTypes_list->GradeType_Idn) ?>', 1);"><div id="elh_GradeTypes_GradeType_Idn" class="GradeTypes_GradeType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GradeTypes_list->GradeType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($GradeTypes_list->GradeType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GradeTypes_list->GradeType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($GradeTypes_list->Name->Visible) { // Name ?>
	<?php if ($GradeTypes_list->SortUrl($GradeTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $GradeTypes_list->Name->headerCellClass() ?>"><div id="elh_GradeTypes_Name" class="GradeTypes_Name"><div class="ew-table-header-caption"><?php echo $GradeTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $GradeTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GradeTypes_list->SortUrl($GradeTypes_list->Name) ?>', 1);"><div id="elh_GradeTypes_Name" class="GradeTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GradeTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($GradeTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GradeTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($GradeTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($GradeTypes_list->SortUrl($GradeTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $GradeTypes_list->Rank->headerCellClass() ?>"><div id="elh_GradeTypes_Rank" class="GradeTypes_Rank"><div class="ew-table-header-caption"><?php echo $GradeTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $GradeTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GradeTypes_list->SortUrl($GradeTypes_list->Rank) ?>', 1);"><div id="elh_GradeTypes_Rank" class="GradeTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GradeTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($GradeTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GradeTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($GradeTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($GradeTypes_list->SortUrl($GradeTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $GradeTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_GradeTypes_ActiveFlag" class="GradeTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $GradeTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $GradeTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GradeTypes_list->SortUrl($GradeTypes_list->ActiveFlag) ?>', 1);"><div id="elh_GradeTypes_ActiveFlag" class="GradeTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GradeTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($GradeTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GradeTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$GradeTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($GradeTypes_list->isAdd() || $GradeTypes_list->isCopy()) {
		$GradeTypes_list->RowIndex = 0;
		$GradeTypes_list->KeyCount = $GradeTypes_list->RowIndex;
		if ($GradeTypes_list->isCopy() && !$GradeTypes_list->loadRow())
			$GradeTypes->CurrentAction = "add";
		if ($GradeTypes_list->isAdd())
			$GradeTypes_list->loadRowValues();
		if ($GradeTypes->EventCancelled) // Insert failed
			$GradeTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$GradeTypes->resetAttributes();
		$GradeTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_GradeTypes", "data-rowtype" => ROWTYPE_ADD]);
		$GradeTypes->RowType = ROWTYPE_ADD;

		// Render row
		$GradeTypes_list->renderRow();

		// Render list options
		$GradeTypes_list->renderListOptions();
		$GradeTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $GradeTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$GradeTypes_list->ListOptions->render("body", "left", $GradeTypes_list->RowCount);
?>
	<?php if ($GradeTypes_list->GradeType_Idn->Visible) { // GradeType_Idn ?>
		<td data-name="GradeType_Idn">
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_GradeType_Idn" class="form-group GradeTypes_GradeType_Idn"></span>
<input type="hidden" data-table="GradeTypes" data-field="x_GradeType_Idn" name="o<?php echo $GradeTypes_list->RowIndex ?>_GradeType_Idn" id="o<?php echo $GradeTypes_list->RowIndex ?>_GradeType_Idn" value="<?php echo HtmlEncode($GradeTypes_list->GradeType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GradeTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_Name" class="form-group GradeTypes_Name">
<input type="text" data-table="GradeTypes" data-field="x_Name" name="x<?php echo $GradeTypes_list->RowIndex ?>_Name" id="x<?php echo $GradeTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GradeTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $GradeTypes_list->Name->EditValue ?>"<?php echo $GradeTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="GradeTypes" data-field="x_Name" name="o<?php echo $GradeTypes_list->RowIndex ?>_Name" id="o<?php echo $GradeTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($GradeTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GradeTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_Rank" class="form-group GradeTypes_Rank">
<input type="text" data-table="GradeTypes" data-field="x_Rank" name="x<?php echo $GradeTypes_list->RowIndex ?>_Rank" id="x<?php echo $GradeTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GradeTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GradeTypes_list->Rank->EditValue ?>"<?php echo $GradeTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="GradeTypes" data-field="x_Rank" name="o<?php echo $GradeTypes_list->RowIndex ?>_Rank" id="o<?php echo $GradeTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($GradeTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GradeTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_ActiveFlag" class="form-group GradeTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($GradeTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GradeTypes" data-field="x_ActiveFlag" name="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]_681156" value="1"<?php echo $selwrk ?><?php echo $GradeTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]_681156"></label>
</div>
</span>
<input type="hidden" data-table="GradeTypes" data-field="x_ActiveFlag" name="o<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($GradeTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$GradeTypes_list->ListOptions->render("body", "right", $GradeTypes_list->RowCount);
?>
<script>
loadjs.ready(["fGradeTypeslist", "load"], function() {
	fGradeTypeslist.updateLists(<?php echo $GradeTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($GradeTypes_list->ExportAll && $GradeTypes_list->isExport()) {
	$GradeTypes_list->StopRecord = $GradeTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($GradeTypes_list->TotalRecords > $GradeTypes_list->StartRecord + $GradeTypes_list->DisplayRecords - 1)
		$GradeTypes_list->StopRecord = $GradeTypes_list->StartRecord + $GradeTypes_list->DisplayRecords - 1;
	else
		$GradeTypes_list->StopRecord = $GradeTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($GradeTypes->isConfirm() || $GradeTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($GradeTypes_list->FormKeyCountName) && ($GradeTypes_list->isGridAdd() || $GradeTypes_list->isGridEdit() || $GradeTypes->isConfirm())) {
		$GradeTypes_list->KeyCount = $CurrentForm->getValue($GradeTypes_list->FormKeyCountName);
		$GradeTypes_list->StopRecord = $GradeTypes_list->StartRecord + $GradeTypes_list->KeyCount - 1;
	}
}
$GradeTypes_list->RecordCount = $GradeTypes_list->StartRecord - 1;
if ($GradeTypes_list->Recordset && !$GradeTypes_list->Recordset->EOF) {
	$GradeTypes_list->Recordset->moveFirst();
	$selectLimit = $GradeTypes_list->UseSelectLimit;
	if (!$selectLimit && $GradeTypes_list->StartRecord > 1)
		$GradeTypes_list->Recordset->move($GradeTypes_list->StartRecord - 1);
} elseif (!$GradeTypes->AllowAddDeleteRow && $GradeTypes_list->StopRecord == 0) {
	$GradeTypes_list->StopRecord = $GradeTypes->GridAddRowCount;
}

// Initialize aggregate
$GradeTypes->RowType = ROWTYPE_AGGREGATEINIT;
$GradeTypes->resetAttributes();
$GradeTypes_list->renderRow();
$GradeTypes_list->EditRowCount = 0;
if ($GradeTypes_list->isEdit())
	$GradeTypes_list->RowIndex = 1;
if ($GradeTypes_list->isGridAdd())
	$GradeTypes_list->RowIndex = 0;
if ($GradeTypes_list->isGridEdit())
	$GradeTypes_list->RowIndex = 0;
while ($GradeTypes_list->RecordCount < $GradeTypes_list->StopRecord) {
	$GradeTypes_list->RecordCount++;
	if ($GradeTypes_list->RecordCount >= $GradeTypes_list->StartRecord) {
		$GradeTypes_list->RowCount++;
		if ($GradeTypes_list->isGridAdd() || $GradeTypes_list->isGridEdit() || $GradeTypes->isConfirm()) {
			$GradeTypes_list->RowIndex++;
			$CurrentForm->Index = $GradeTypes_list->RowIndex;
			if ($CurrentForm->hasValue($GradeTypes_list->FormActionName) && ($GradeTypes->isConfirm() || $GradeTypes_list->EventCancelled))
				$GradeTypes_list->RowAction = strval($CurrentForm->getValue($GradeTypes_list->FormActionName));
			elseif ($GradeTypes_list->isGridAdd())
				$GradeTypes_list->RowAction = "insert";
			else
				$GradeTypes_list->RowAction = "";
		}

		// Set up key count
		$GradeTypes_list->KeyCount = $GradeTypes_list->RowIndex;

		// Init row class and style
		$GradeTypes->resetAttributes();
		$GradeTypes->CssClass = "";
		if ($GradeTypes_list->isGridAdd()) {
			$GradeTypes_list->loadRowValues(); // Load default values
		} else {
			$GradeTypes_list->loadRowValues($GradeTypes_list->Recordset); // Load row values
		}
		$GradeTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($GradeTypes_list->isGridAdd()) // Grid add
			$GradeTypes->RowType = ROWTYPE_ADD; // Render add
		if ($GradeTypes_list->isGridAdd() && $GradeTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$GradeTypes_list->restoreCurrentRowFormValues($GradeTypes_list->RowIndex); // Restore form values
		if ($GradeTypes_list->isEdit()) {
			if ($GradeTypes_list->checkInlineEditKey() && $GradeTypes_list->EditRowCount == 0) { // Inline edit
				$GradeTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($GradeTypes_list->isGridEdit()) { // Grid edit
			if ($GradeTypes->EventCancelled)
				$GradeTypes_list->restoreCurrentRowFormValues($GradeTypes_list->RowIndex); // Restore form values
			if ($GradeTypes_list->RowAction == "insert")
				$GradeTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$GradeTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($GradeTypes_list->isEdit() && $GradeTypes->RowType == ROWTYPE_EDIT && $GradeTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$GradeTypes_list->restoreFormValues(); // Restore form values
		}
		if ($GradeTypes_list->isGridEdit() && ($GradeTypes->RowType == ROWTYPE_EDIT || $GradeTypes->RowType == ROWTYPE_ADD) && $GradeTypes->EventCancelled) // Update failed
			$GradeTypes_list->restoreCurrentRowFormValues($GradeTypes_list->RowIndex); // Restore form values
		if ($GradeTypes->RowType == ROWTYPE_EDIT) // Edit row
			$GradeTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$GradeTypes->RowAttrs->merge(["data-rowindex" => $GradeTypes_list->RowCount, "id" => "r" . $GradeTypes_list->RowCount . "_GradeTypes", "data-rowtype" => $GradeTypes->RowType]);

		// Render row
		$GradeTypes_list->renderRow();

		// Render list options
		$GradeTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($GradeTypes_list->RowAction != "delete" && $GradeTypes_list->RowAction != "insertdelete" && !($GradeTypes_list->RowAction == "insert" && $GradeTypes->isConfirm() && $GradeTypes_list->emptyRow())) {
?>
	<tr <?php echo $GradeTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$GradeTypes_list->ListOptions->render("body", "left", $GradeTypes_list->RowCount);
?>
	<?php if ($GradeTypes_list->GradeType_Idn->Visible) { // GradeType_Idn ?>
		<td data-name="GradeType_Idn" <?php echo $GradeTypes_list->GradeType_Idn->cellAttributes() ?>>
<?php if ($GradeTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_GradeType_Idn" class="form-group"></span>
<input type="hidden" data-table="GradeTypes" data-field="x_GradeType_Idn" name="o<?php echo $GradeTypes_list->RowIndex ?>_GradeType_Idn" id="o<?php echo $GradeTypes_list->RowIndex ?>_GradeType_Idn" value="<?php echo HtmlEncode($GradeTypes_list->GradeType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($GradeTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_GradeType_Idn" class="form-group">
<span<?php echo $GradeTypes_list->GradeType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($GradeTypes_list->GradeType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="GradeTypes" data-field="x_GradeType_Idn" name="x<?php echo $GradeTypes_list->RowIndex ?>_GradeType_Idn" id="x<?php echo $GradeTypes_list->RowIndex ?>_GradeType_Idn" value="<?php echo HtmlEncode($GradeTypes_list->GradeType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($GradeTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_GradeType_Idn">
<span<?php echo $GradeTypes_list->GradeType_Idn->viewAttributes() ?>><?php echo $GradeTypes_list->GradeType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($GradeTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $GradeTypes_list->Name->cellAttributes() ?>>
<?php if ($GradeTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_Name" class="form-group">
<input type="text" data-table="GradeTypes" data-field="x_Name" name="x<?php echo $GradeTypes_list->RowIndex ?>_Name" id="x<?php echo $GradeTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GradeTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $GradeTypes_list->Name->EditValue ?>"<?php echo $GradeTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="GradeTypes" data-field="x_Name" name="o<?php echo $GradeTypes_list->RowIndex ?>_Name" id="o<?php echo $GradeTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($GradeTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($GradeTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_Name" class="form-group">
<input type="text" data-table="GradeTypes" data-field="x_Name" name="x<?php echo $GradeTypes_list->RowIndex ?>_Name" id="x<?php echo $GradeTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GradeTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $GradeTypes_list->Name->EditValue ?>"<?php echo $GradeTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($GradeTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_Name">
<span<?php echo $GradeTypes_list->Name->viewAttributes() ?>><?php echo $GradeTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($GradeTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $GradeTypes_list->Rank->cellAttributes() ?>>
<?php if ($GradeTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_Rank" class="form-group">
<input type="text" data-table="GradeTypes" data-field="x_Rank" name="x<?php echo $GradeTypes_list->RowIndex ?>_Rank" id="x<?php echo $GradeTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GradeTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GradeTypes_list->Rank->EditValue ?>"<?php echo $GradeTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="GradeTypes" data-field="x_Rank" name="o<?php echo $GradeTypes_list->RowIndex ?>_Rank" id="o<?php echo $GradeTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($GradeTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($GradeTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_Rank" class="form-group">
<input type="text" data-table="GradeTypes" data-field="x_Rank" name="x<?php echo $GradeTypes_list->RowIndex ?>_Rank" id="x<?php echo $GradeTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GradeTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GradeTypes_list->Rank->EditValue ?>"<?php echo $GradeTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($GradeTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_Rank">
<span<?php echo $GradeTypes_list->Rank->viewAttributes() ?>><?php echo $GradeTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($GradeTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $GradeTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($GradeTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($GradeTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GradeTypes" data-field="x_ActiveFlag" name="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]_303386" value="1"<?php echo $selwrk ?><?php echo $GradeTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]_303386"></label>
</div>
</span>
<input type="hidden" data-table="GradeTypes" data-field="x_ActiveFlag" name="o<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($GradeTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($GradeTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($GradeTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GradeTypes" data-field="x_ActiveFlag" name="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]_556683" value="1"<?php echo $selwrk ?><?php echo $GradeTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]_556683"></label>
</div>
</span>
<?php } ?>
<?php if ($GradeTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GradeTypes_list->RowCount ?>_GradeTypes_ActiveFlag">
<span<?php echo $GradeTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $GradeTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($GradeTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$GradeTypes_list->ListOptions->render("body", "right", $GradeTypes_list->RowCount);
?>
	</tr>
<?php if ($GradeTypes->RowType == ROWTYPE_ADD || $GradeTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fGradeTypeslist", "load"], function() {
	fGradeTypeslist.updateLists(<?php echo $GradeTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$GradeTypes_list->isGridAdd())
		if (!$GradeTypes_list->Recordset->EOF)
			$GradeTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($GradeTypes_list->isGridAdd() || $GradeTypes_list->isGridEdit()) {
		$GradeTypes_list->RowIndex = '$rowindex$';
		$GradeTypes_list->loadRowValues();

		// Set row properties
		$GradeTypes->resetAttributes();
		$GradeTypes->RowAttrs->merge(["data-rowindex" => $GradeTypes_list->RowIndex, "id" => "r0_GradeTypes", "data-rowtype" => ROWTYPE_ADD]);
		$GradeTypes->RowAttrs->appendClass("ew-template");
		$GradeTypes->RowType = ROWTYPE_ADD;

		// Render row
		$GradeTypes_list->renderRow();

		// Render list options
		$GradeTypes_list->renderListOptions();
		$GradeTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $GradeTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$GradeTypes_list->ListOptions->render("body", "left", $GradeTypes_list->RowIndex);
?>
	<?php if ($GradeTypes_list->GradeType_Idn->Visible) { // GradeType_Idn ?>
		<td data-name="GradeType_Idn">
<span id="el$rowindex$_GradeTypes_GradeType_Idn" class="form-group GradeTypes_GradeType_Idn"></span>
<input type="hidden" data-table="GradeTypes" data-field="x_GradeType_Idn" name="o<?php echo $GradeTypes_list->RowIndex ?>_GradeType_Idn" id="o<?php echo $GradeTypes_list->RowIndex ?>_GradeType_Idn" value="<?php echo HtmlEncode($GradeTypes_list->GradeType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GradeTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_GradeTypes_Name" class="form-group GradeTypes_Name">
<input type="text" data-table="GradeTypes" data-field="x_Name" name="x<?php echo $GradeTypes_list->RowIndex ?>_Name" id="x<?php echo $GradeTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GradeTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $GradeTypes_list->Name->EditValue ?>"<?php echo $GradeTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="GradeTypes" data-field="x_Name" name="o<?php echo $GradeTypes_list->RowIndex ?>_Name" id="o<?php echo $GradeTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($GradeTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GradeTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_GradeTypes_Rank" class="form-group GradeTypes_Rank">
<input type="text" data-table="GradeTypes" data-field="x_Rank" name="x<?php echo $GradeTypes_list->RowIndex ?>_Rank" id="x<?php echo $GradeTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GradeTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GradeTypes_list->Rank->EditValue ?>"<?php echo $GradeTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="GradeTypes" data-field="x_Rank" name="o<?php echo $GradeTypes_list->RowIndex ?>_Rank" id="o<?php echo $GradeTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($GradeTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GradeTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_GradeTypes_ActiveFlag" class="form-group GradeTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($GradeTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GradeTypes" data-field="x_ActiveFlag" name="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]_279479" value="1"<?php echo $selwrk ?><?php echo $GradeTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]_279479"></label>
</div>
</span>
<input type="hidden" data-table="GradeTypes" data-field="x_ActiveFlag" name="o<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $GradeTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($GradeTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$GradeTypes_list->ListOptions->render("body", "right", $GradeTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fGradeTypeslist", "load"], function() {
	fGradeTypeslist.updateLists(<?php echo $GradeTypes_list->RowIndex ?>);
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
<?php if ($GradeTypes_list->isAdd() || $GradeTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $GradeTypes_list->FormKeyCountName ?>" id="<?php echo $GradeTypes_list->FormKeyCountName ?>" value="<?php echo $GradeTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($GradeTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $GradeTypes_list->FormKeyCountName ?>" id="<?php echo $GradeTypes_list->FormKeyCountName ?>" value="<?php echo $GradeTypes_list->KeyCount ?>">
<?php echo $GradeTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($GradeTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $GradeTypes_list->FormKeyCountName ?>" id="<?php echo $GradeTypes_list->FormKeyCountName ?>" value="<?php echo $GradeTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($GradeTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $GradeTypes_list->FormKeyCountName ?>" id="<?php echo $GradeTypes_list->FormKeyCountName ?>" value="<?php echo $GradeTypes_list->KeyCount ?>">
<?php echo $GradeTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$GradeTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($GradeTypes_list->Recordset)
	$GradeTypes_list->Recordset->Close();
?>
<?php if (!$GradeTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$GradeTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GradeTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $GradeTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($GradeTypes_list->TotalRecords == 0 && !$GradeTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $GradeTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$GradeTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$GradeTypes_list->isExport()) { ?>
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
$GradeTypes_list->terminate();
?>