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
$HangerTypes_list = new HangerTypes_list();

// Run the page
$HangerTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HangerTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$HangerTypes_list->isExport()) { ?>
<script>
var fHangerTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fHangerTypeslist = currentForm = new ew.Form("fHangerTypeslist", "list");
	fHangerTypeslist.formKeyCountName = '<?php echo $HangerTypes_list->FormKeyCountName ?>';

	// Validate form
	fHangerTypeslist.validate = function() {
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
			<?php if ($HangerTypes_list->HangerType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerTypes_list->HangerType_Idn->caption(), $HangerTypes_list->HangerType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HangerTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerTypes_list->Name->caption(), $HangerTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HangerTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerTypes_list->Rank->caption(), $HangerTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($HangerTypes_list->Rank->errorMessage()) ?>");
			<?php if ($HangerTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerTypes_list->ActiveFlag->caption(), $HangerTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fHangerTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fHangerTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fHangerTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fHangerTypeslist.lists["x_ActiveFlag[]"] = <?php echo $HangerTypes_list->ActiveFlag->Lookup->toClientList($HangerTypes_list) ?>;
	fHangerTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($HangerTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fHangerTypeslist");
});
var fHangerTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fHangerTypeslistsrch = currentSearchForm = new ew.Form("fHangerTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fHangerTypeslistsrch.filterList = <?php echo $HangerTypes_list->getFilterList() ?>;
	loadjs.done("fHangerTypeslistsrch");
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
<?php if (!$HangerTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($HangerTypes_list->TotalRecords > 0 && $HangerTypes_list->ExportOptions->visible()) { ?>
<?php $HangerTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($HangerTypes_list->ImportOptions->visible()) { ?>
<?php $HangerTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($HangerTypes_list->SearchOptions->visible()) { ?>
<?php $HangerTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($HangerTypes_list->FilterOptions->visible()) { ?>
<?php $HangerTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$HangerTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$HangerTypes_list->isExport() && !$HangerTypes->CurrentAction) { ?>
<form name="fHangerTypeslistsrch" id="fHangerTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fHangerTypeslistsrch-search-panel" class="<?php echo $HangerTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="HangerTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $HangerTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($HangerTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($HangerTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $HangerTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($HangerTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($HangerTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($HangerTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($HangerTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $HangerTypes_list->showPageHeader(); ?>
<?php
$HangerTypes_list->showMessage();
?>
<?php if ($HangerTypes_list->TotalRecords > 0 || $HangerTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($HangerTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> HangerTypes">
<?php if (!$HangerTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$HangerTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $HangerTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $HangerTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fHangerTypeslist" id="fHangerTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="HangerTypes">
<div id="gmp_HangerTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($HangerTypes_list->TotalRecords > 0 || $HangerTypes_list->isAdd() || $HangerTypes_list->isCopy() || $HangerTypes_list->isGridEdit()) { ?>
<table id="tbl_HangerTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$HangerTypes->RowType = ROWTYPE_HEADER;

// Render list options
$HangerTypes_list->renderListOptions();

// Render list options (header, left)
$HangerTypes_list->ListOptions->render("header", "left");
?>
<?php if ($HangerTypes_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
	<?php if ($HangerTypes_list->SortUrl($HangerTypes_list->HangerType_Idn) == "") { ?>
		<th data-name="HangerType_Idn" class="<?php echo $HangerTypes_list->HangerType_Idn->headerCellClass() ?>"><div id="elh_HangerTypes_HangerType_Idn" class="HangerTypes_HangerType_Idn"><div class="ew-table-header-caption"><?php echo $HangerTypes_list->HangerType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HangerType_Idn" class="<?php echo $HangerTypes_list->HangerType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HangerTypes_list->SortUrl($HangerTypes_list->HangerType_Idn) ?>', 1);"><div id="elh_HangerTypes_HangerType_Idn" class="HangerTypes_HangerType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerTypes_list->HangerType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerTypes_list->HangerType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerTypes_list->HangerType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerTypes_list->Name->Visible) { // Name ?>
	<?php if ($HangerTypes_list->SortUrl($HangerTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $HangerTypes_list->Name->headerCellClass() ?>"><div id="elh_HangerTypes_Name" class="HangerTypes_Name"><div class="ew-table-header-caption"><?php echo $HangerTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $HangerTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HangerTypes_list->SortUrl($HangerTypes_list->Name) ?>', 1);"><div id="elh_HangerTypes_Name" class="HangerTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($HangerTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($HangerTypes_list->SortUrl($HangerTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $HangerTypes_list->Rank->headerCellClass() ?>"><div id="elh_HangerTypes_Rank" class="HangerTypes_Rank"><div class="ew-table-header-caption"><?php echo $HangerTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $HangerTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HangerTypes_list->SortUrl($HangerTypes_list->Rank) ?>', 1);"><div id="elh_HangerTypes_Rank" class="HangerTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($HangerTypes_list->SortUrl($HangerTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $HangerTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_HangerTypes_ActiveFlag" class="HangerTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $HangerTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $HangerTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HangerTypes_list->SortUrl($HangerTypes_list->ActiveFlag) ?>', 1);"><div id="elh_HangerTypes_ActiveFlag" class="HangerTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$HangerTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($HangerTypes_list->isAdd() || $HangerTypes_list->isCopy()) {
		$HangerTypes_list->RowIndex = 0;
		$HangerTypes_list->KeyCount = $HangerTypes_list->RowIndex;
		if ($HangerTypes_list->isCopy() && !$HangerTypes_list->loadRow())
			$HangerTypes->CurrentAction = "add";
		if ($HangerTypes_list->isAdd())
			$HangerTypes_list->loadRowValues();
		if ($HangerTypes->EventCancelled) // Insert failed
			$HangerTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$HangerTypes->resetAttributes();
		$HangerTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_HangerTypes", "data-rowtype" => ROWTYPE_ADD]);
		$HangerTypes->RowType = ROWTYPE_ADD;

		// Render row
		$HangerTypes_list->renderRow();

		// Render list options
		$HangerTypes_list->renderListOptions();
		$HangerTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $HangerTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HangerTypes_list->ListOptions->render("body", "left", $HangerTypes_list->RowCount);
?>
	<?php if ($HangerTypes_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td data-name="HangerType_Idn">
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_HangerType_Idn" class="form-group HangerTypes_HangerType_Idn"></span>
<input type="hidden" data-table="HangerTypes" data-field="x_HangerType_Idn" name="o<?php echo $HangerTypes_list->RowIndex ?>_HangerType_Idn" id="o<?php echo $HangerTypes_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerTypes_list->HangerType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_Name" class="form-group HangerTypes_Name">
<input type="text" data-table="HangerTypes" data-field="x_Name" name="x<?php echo $HangerTypes_list->RowIndex ?>_Name" id="x<?php echo $HangerTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HangerTypes_list->Name->EditValue ?>"<?php echo $HangerTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerTypes" data-field="x_Name" name="o<?php echo $HangerTypes_list->RowIndex ?>_Name" id="o<?php echo $HangerTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_Rank" class="form-group HangerTypes_Rank">
<input type="text" data-table="HangerTypes" data-field="x_Rank" name="x<?php echo $HangerTypes_list->RowIndex ?>_Rank" id="x<?php echo $HangerTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerTypes_list->Rank->EditValue ?>"<?php echo $HangerTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerTypes" data-field="x_Rank" name="o<?php echo $HangerTypes_list->RowIndex ?>_Rank" id="o<?php echo $HangerTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_ActiveFlag" class="form-group HangerTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($HangerTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]_476290" value="1"<?php echo $selwrk ?><?php echo $HangerTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]_476290"></label>
</div>
</span>
<input type="hidden" data-table="HangerTypes" data-field="x_ActiveFlag" name="o<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HangerTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$HangerTypes_list->ListOptions->render("body", "right", $HangerTypes_list->RowCount);
?>
<script>
loadjs.ready(["fHangerTypeslist", "load"], function() {
	fHangerTypeslist.updateLists(<?php echo $HangerTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($HangerTypes_list->ExportAll && $HangerTypes_list->isExport()) {
	$HangerTypes_list->StopRecord = $HangerTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($HangerTypes_list->TotalRecords > $HangerTypes_list->StartRecord + $HangerTypes_list->DisplayRecords - 1)
		$HangerTypes_list->StopRecord = $HangerTypes_list->StartRecord + $HangerTypes_list->DisplayRecords - 1;
	else
		$HangerTypes_list->StopRecord = $HangerTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($HangerTypes->isConfirm() || $HangerTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($HangerTypes_list->FormKeyCountName) && ($HangerTypes_list->isGridAdd() || $HangerTypes_list->isGridEdit() || $HangerTypes->isConfirm())) {
		$HangerTypes_list->KeyCount = $CurrentForm->getValue($HangerTypes_list->FormKeyCountName);
		$HangerTypes_list->StopRecord = $HangerTypes_list->StartRecord + $HangerTypes_list->KeyCount - 1;
	}
}
$HangerTypes_list->RecordCount = $HangerTypes_list->StartRecord - 1;
if ($HangerTypes_list->Recordset && !$HangerTypes_list->Recordset->EOF) {
	$HangerTypes_list->Recordset->moveFirst();
	$selectLimit = $HangerTypes_list->UseSelectLimit;
	if (!$selectLimit && $HangerTypes_list->StartRecord > 1)
		$HangerTypes_list->Recordset->move($HangerTypes_list->StartRecord - 1);
} elseif (!$HangerTypes->AllowAddDeleteRow && $HangerTypes_list->StopRecord == 0) {
	$HangerTypes_list->StopRecord = $HangerTypes->GridAddRowCount;
}

// Initialize aggregate
$HangerTypes->RowType = ROWTYPE_AGGREGATEINIT;
$HangerTypes->resetAttributes();
$HangerTypes_list->renderRow();
$HangerTypes_list->EditRowCount = 0;
if ($HangerTypes_list->isEdit())
	$HangerTypes_list->RowIndex = 1;
if ($HangerTypes_list->isGridAdd())
	$HangerTypes_list->RowIndex = 0;
if ($HangerTypes_list->isGridEdit())
	$HangerTypes_list->RowIndex = 0;
while ($HangerTypes_list->RecordCount < $HangerTypes_list->StopRecord) {
	$HangerTypes_list->RecordCount++;
	if ($HangerTypes_list->RecordCount >= $HangerTypes_list->StartRecord) {
		$HangerTypes_list->RowCount++;
		if ($HangerTypes_list->isGridAdd() || $HangerTypes_list->isGridEdit() || $HangerTypes->isConfirm()) {
			$HangerTypes_list->RowIndex++;
			$CurrentForm->Index = $HangerTypes_list->RowIndex;
			if ($CurrentForm->hasValue($HangerTypes_list->FormActionName) && ($HangerTypes->isConfirm() || $HangerTypes_list->EventCancelled))
				$HangerTypes_list->RowAction = strval($CurrentForm->getValue($HangerTypes_list->FormActionName));
			elseif ($HangerTypes_list->isGridAdd())
				$HangerTypes_list->RowAction = "insert";
			else
				$HangerTypes_list->RowAction = "";
		}

		// Set up key count
		$HangerTypes_list->KeyCount = $HangerTypes_list->RowIndex;

		// Init row class and style
		$HangerTypes->resetAttributes();
		$HangerTypes->CssClass = "";
		if ($HangerTypes_list->isGridAdd()) {
			$HangerTypes_list->loadRowValues(); // Load default values
		} else {
			$HangerTypes_list->loadRowValues($HangerTypes_list->Recordset); // Load row values
		}
		$HangerTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($HangerTypes_list->isGridAdd()) // Grid add
			$HangerTypes->RowType = ROWTYPE_ADD; // Render add
		if ($HangerTypes_list->isGridAdd() && $HangerTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$HangerTypes_list->restoreCurrentRowFormValues($HangerTypes_list->RowIndex); // Restore form values
		if ($HangerTypes_list->isEdit()) {
			if ($HangerTypes_list->checkInlineEditKey() && $HangerTypes_list->EditRowCount == 0) { // Inline edit
				$HangerTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($HangerTypes_list->isGridEdit()) { // Grid edit
			if ($HangerTypes->EventCancelled)
				$HangerTypes_list->restoreCurrentRowFormValues($HangerTypes_list->RowIndex); // Restore form values
			if ($HangerTypes_list->RowAction == "insert")
				$HangerTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$HangerTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($HangerTypes_list->isEdit() && $HangerTypes->RowType == ROWTYPE_EDIT && $HangerTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$HangerTypes_list->restoreFormValues(); // Restore form values
		}
		if ($HangerTypes_list->isGridEdit() && ($HangerTypes->RowType == ROWTYPE_EDIT || $HangerTypes->RowType == ROWTYPE_ADD) && $HangerTypes->EventCancelled) // Update failed
			$HangerTypes_list->restoreCurrentRowFormValues($HangerTypes_list->RowIndex); // Restore form values
		if ($HangerTypes->RowType == ROWTYPE_EDIT) // Edit row
			$HangerTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$HangerTypes->RowAttrs->merge(["data-rowindex" => $HangerTypes_list->RowCount, "id" => "r" . $HangerTypes_list->RowCount . "_HangerTypes", "data-rowtype" => $HangerTypes->RowType]);

		// Render row
		$HangerTypes_list->renderRow();

		// Render list options
		$HangerTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($HangerTypes_list->RowAction != "delete" && $HangerTypes_list->RowAction != "insertdelete" && !($HangerTypes_list->RowAction == "insert" && $HangerTypes->isConfirm() && $HangerTypes_list->emptyRow())) {
?>
	<tr <?php echo $HangerTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HangerTypes_list->ListOptions->render("body", "left", $HangerTypes_list->RowCount);
?>
	<?php if ($HangerTypes_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td data-name="HangerType_Idn" <?php echo $HangerTypes_list->HangerType_Idn->cellAttributes() ?>>
<?php if ($HangerTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_HangerType_Idn" class="form-group"></span>
<input type="hidden" data-table="HangerTypes" data-field="x_HangerType_Idn" name="o<?php echo $HangerTypes_list->RowIndex ?>_HangerType_Idn" id="o<?php echo $HangerTypes_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerTypes_list->HangerType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($HangerTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_HangerType_Idn" class="form-group">
<span<?php echo $HangerTypes_list->HangerType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerTypes_list->HangerType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="HangerTypes" data-field="x_HangerType_Idn" name="x<?php echo $HangerTypes_list->RowIndex ?>_HangerType_Idn" id="x<?php echo $HangerTypes_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerTypes_list->HangerType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($HangerTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_HangerType_Idn">
<span<?php echo $HangerTypes_list->HangerType_Idn->viewAttributes() ?>><?php echo $HangerTypes_list->HangerType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HangerTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $HangerTypes_list->Name->cellAttributes() ?>>
<?php if ($HangerTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_Name" class="form-group">
<input type="text" data-table="HangerTypes" data-field="x_Name" name="x<?php echo $HangerTypes_list->RowIndex ?>_Name" id="x<?php echo $HangerTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HangerTypes_list->Name->EditValue ?>"<?php echo $HangerTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerTypes" data-field="x_Name" name="o<?php echo $HangerTypes_list->RowIndex ?>_Name" id="o<?php echo $HangerTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($HangerTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_Name" class="form-group">
<input type="text" data-table="HangerTypes" data-field="x_Name" name="x<?php echo $HangerTypes_list->RowIndex ?>_Name" id="x<?php echo $HangerTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HangerTypes_list->Name->EditValue ?>"<?php echo $HangerTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($HangerTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_Name">
<span<?php echo $HangerTypes_list->Name->viewAttributes() ?>><?php echo $HangerTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HangerTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $HangerTypes_list->Rank->cellAttributes() ?>>
<?php if ($HangerTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_Rank" class="form-group">
<input type="text" data-table="HangerTypes" data-field="x_Rank" name="x<?php echo $HangerTypes_list->RowIndex ?>_Rank" id="x<?php echo $HangerTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerTypes_list->Rank->EditValue ?>"<?php echo $HangerTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerTypes" data-field="x_Rank" name="o<?php echo $HangerTypes_list->RowIndex ?>_Rank" id="o<?php echo $HangerTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($HangerTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_Rank" class="form-group">
<input type="text" data-table="HangerTypes" data-field="x_Rank" name="x<?php echo $HangerTypes_list->RowIndex ?>_Rank" id="x<?php echo $HangerTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerTypes_list->Rank->EditValue ?>"<?php echo $HangerTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($HangerTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_Rank">
<span<?php echo $HangerTypes_list->Rank->viewAttributes() ?>><?php echo $HangerTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HangerTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $HangerTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($HangerTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($HangerTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]_667811" value="1"<?php echo $selwrk ?><?php echo $HangerTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]_667811"></label>
</div>
</span>
<input type="hidden" data-table="HangerTypes" data-field="x_ActiveFlag" name="o<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HangerTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($HangerTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($HangerTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]_733853" value="1"<?php echo $selwrk ?><?php echo $HangerTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]_733853"></label>
</div>
</span>
<?php } ?>
<?php if ($HangerTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerTypes_list->RowCount ?>_HangerTypes_ActiveFlag">
<span<?php echo $HangerTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HangerTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HangerTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$HangerTypes_list->ListOptions->render("body", "right", $HangerTypes_list->RowCount);
?>
	</tr>
<?php if ($HangerTypes->RowType == ROWTYPE_ADD || $HangerTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fHangerTypeslist", "load"], function() {
	fHangerTypeslist.updateLists(<?php echo $HangerTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$HangerTypes_list->isGridAdd())
		if (!$HangerTypes_list->Recordset->EOF)
			$HangerTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($HangerTypes_list->isGridAdd() || $HangerTypes_list->isGridEdit()) {
		$HangerTypes_list->RowIndex = '$rowindex$';
		$HangerTypes_list->loadRowValues();

		// Set row properties
		$HangerTypes->resetAttributes();
		$HangerTypes->RowAttrs->merge(["data-rowindex" => $HangerTypes_list->RowIndex, "id" => "r0_HangerTypes", "data-rowtype" => ROWTYPE_ADD]);
		$HangerTypes->RowAttrs->appendClass("ew-template");
		$HangerTypes->RowType = ROWTYPE_ADD;

		// Render row
		$HangerTypes_list->renderRow();

		// Render list options
		$HangerTypes_list->renderListOptions();
		$HangerTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $HangerTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HangerTypes_list->ListOptions->render("body", "left", $HangerTypes_list->RowIndex);
?>
	<?php if ($HangerTypes_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td data-name="HangerType_Idn">
<span id="el$rowindex$_HangerTypes_HangerType_Idn" class="form-group HangerTypes_HangerType_Idn"></span>
<input type="hidden" data-table="HangerTypes" data-field="x_HangerType_Idn" name="o<?php echo $HangerTypes_list->RowIndex ?>_HangerType_Idn" id="o<?php echo $HangerTypes_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerTypes_list->HangerType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_HangerTypes_Name" class="form-group HangerTypes_Name">
<input type="text" data-table="HangerTypes" data-field="x_Name" name="x<?php echo $HangerTypes_list->RowIndex ?>_Name" id="x<?php echo $HangerTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HangerTypes_list->Name->EditValue ?>"<?php echo $HangerTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerTypes" data-field="x_Name" name="o<?php echo $HangerTypes_list->RowIndex ?>_Name" id="o<?php echo $HangerTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_HangerTypes_Rank" class="form-group HangerTypes_Rank">
<input type="text" data-table="HangerTypes" data-field="x_Rank" name="x<?php echo $HangerTypes_list->RowIndex ?>_Rank" id="x<?php echo $HangerTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerTypes_list->Rank->EditValue ?>"<?php echo $HangerTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerTypes" data-field="x_Rank" name="o<?php echo $HangerTypes_list->RowIndex ?>_Rank" id="o<?php echo $HangerTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_HangerTypes_ActiveFlag" class="form-group HangerTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($HangerTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]_301467" value="1"<?php echo $selwrk ?><?php echo $HangerTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]_301467"></label>
</div>
</span>
<input type="hidden" data-table="HangerTypes" data-field="x_ActiveFlag" name="o<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HangerTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HangerTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$HangerTypes_list->ListOptions->render("body", "right", $HangerTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fHangerTypeslist", "load"], function() {
	fHangerTypeslist.updateLists(<?php echo $HangerTypes_list->RowIndex ?>);
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
<?php if ($HangerTypes_list->isAdd() || $HangerTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $HangerTypes_list->FormKeyCountName ?>" id="<?php echo $HangerTypes_list->FormKeyCountName ?>" value="<?php echo $HangerTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($HangerTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $HangerTypes_list->FormKeyCountName ?>" id="<?php echo $HangerTypes_list->FormKeyCountName ?>" value="<?php echo $HangerTypes_list->KeyCount ?>">
<?php echo $HangerTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($HangerTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $HangerTypes_list->FormKeyCountName ?>" id="<?php echo $HangerTypes_list->FormKeyCountName ?>" value="<?php echo $HangerTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($HangerTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $HangerTypes_list->FormKeyCountName ?>" id="<?php echo $HangerTypes_list->FormKeyCountName ?>" value="<?php echo $HangerTypes_list->KeyCount ?>">
<?php echo $HangerTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$HangerTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($HangerTypes_list->Recordset)
	$HangerTypes_list->Recordset->Close();
?>
<?php if (!$HangerTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$HangerTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $HangerTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $HangerTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($HangerTypes_list->TotalRecords == 0 && !$HangerTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $HangerTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$HangerTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$HangerTypes_list->isExport()) { ?>
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
$HangerTypes_list->terminate();
?>