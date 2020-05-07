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
$Outlets_list = new Outlets_list();

// Run the page
$Outlets_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Outlets_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Outlets_list->isExport()) { ?>
<script>
var fOutletslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fOutletslist = currentForm = new ew.Form("fOutletslist", "list");
	fOutletslist.formKeyCountName = '<?php echo $Outlets_list->FormKeyCountName ?>';

	// Validate form
	fOutletslist.validate = function() {
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
			<?php if ($Outlets_list->Outlet_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Outlet_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Outlets_list->Outlet_Idn->caption(), $Outlets_list->Outlet_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Outlets_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Outlets_list->Name->caption(), $Outlets_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Outlets_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Outlets_list->Rank->caption(), $Outlets_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Outlets_list->Rank->errorMessage()) ?>");
			<?php if ($Outlets_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Outlets_list->ActiveFlag->caption(), $Outlets_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fOutletslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fOutletslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fOutletslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fOutletslist.lists["x_ActiveFlag[]"] = <?php echo $Outlets_list->ActiveFlag->Lookup->toClientList($Outlets_list) ?>;
	fOutletslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Outlets_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fOutletslist");
});
var fOutletslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fOutletslistsrch = currentSearchForm = new ew.Form("fOutletslistsrch");

	// Dynamic selection lists
	// Filters

	fOutletslistsrch.filterList = <?php echo $Outlets_list->getFilterList() ?>;
	loadjs.done("fOutletslistsrch");
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
<?php if (!$Outlets_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Outlets_list->TotalRecords > 0 && $Outlets_list->ExportOptions->visible()) { ?>
<?php $Outlets_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Outlets_list->ImportOptions->visible()) { ?>
<?php $Outlets_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Outlets_list->SearchOptions->visible()) { ?>
<?php $Outlets_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Outlets_list->FilterOptions->visible()) { ?>
<?php $Outlets_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Outlets_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Outlets_list->isExport() && !$Outlets->CurrentAction) { ?>
<form name="fOutletslistsrch" id="fOutletslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fOutletslistsrch-search-panel" class="<?php echo $Outlets_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Outlets">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Outlets_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Outlets_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Outlets_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Outlets_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Outlets_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Outlets_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Outlets_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Outlets_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Outlets_list->showPageHeader(); ?>
<?php
$Outlets_list->showMessage();
?>
<?php if ($Outlets_list->TotalRecords > 0 || $Outlets->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Outlets_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Outlets">
<?php if (!$Outlets_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Outlets_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Outlets_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Outlets_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fOutletslist" id="fOutletslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Outlets">
<div id="gmp_Outlets" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Outlets_list->TotalRecords > 0 || $Outlets_list->isAdd() || $Outlets_list->isCopy() || $Outlets_list->isGridEdit()) { ?>
<table id="tbl_Outletslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Outlets->RowType = ROWTYPE_HEADER;

// Render list options
$Outlets_list->renderListOptions();

// Render list options (header, left)
$Outlets_list->ListOptions->render("header", "left");
?>
<?php if ($Outlets_list->Outlet_Idn->Visible) { // Outlet_Idn ?>
	<?php if ($Outlets_list->SortUrl($Outlets_list->Outlet_Idn) == "") { ?>
		<th data-name="Outlet_Idn" class="<?php echo $Outlets_list->Outlet_Idn->headerCellClass() ?>"><div id="elh_Outlets_Outlet_Idn" class="Outlets_Outlet_Idn"><div class="ew-table-header-caption"><?php echo $Outlets_list->Outlet_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Outlet_Idn" class="<?php echo $Outlets_list->Outlet_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Outlets_list->SortUrl($Outlets_list->Outlet_Idn) ?>', 1);"><div id="elh_Outlets_Outlet_Idn" class="Outlets_Outlet_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Outlets_list->Outlet_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Outlets_list->Outlet_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Outlets_list->Outlet_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Outlets_list->Name->Visible) { // Name ?>
	<?php if ($Outlets_list->SortUrl($Outlets_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $Outlets_list->Name->headerCellClass() ?>"><div id="elh_Outlets_Name" class="Outlets_Name"><div class="ew-table-header-caption"><?php echo $Outlets_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $Outlets_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Outlets_list->SortUrl($Outlets_list->Name) ?>', 1);"><div id="elh_Outlets_Name" class="Outlets_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Outlets_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Outlets_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Outlets_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Outlets_list->Rank->Visible) { // Rank ?>
	<?php if ($Outlets_list->SortUrl($Outlets_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $Outlets_list->Rank->headerCellClass() ?>"><div id="elh_Outlets_Rank" class="Outlets_Rank"><div class="ew-table-header-caption"><?php echo $Outlets_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $Outlets_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Outlets_list->SortUrl($Outlets_list->Rank) ?>', 1);"><div id="elh_Outlets_Rank" class="Outlets_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Outlets_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($Outlets_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Outlets_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Outlets_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($Outlets_list->SortUrl($Outlets_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $Outlets_list->ActiveFlag->headerCellClass() ?>"><div id="elh_Outlets_ActiveFlag" class="Outlets_ActiveFlag"><div class="ew-table-header-caption"><?php echo $Outlets_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $Outlets_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Outlets_list->SortUrl($Outlets_list->ActiveFlag) ?>', 1);"><div id="elh_Outlets_ActiveFlag" class="Outlets_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Outlets_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Outlets_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Outlets_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Outlets_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($Outlets_list->isAdd() || $Outlets_list->isCopy()) {
		$Outlets_list->RowIndex = 0;
		$Outlets_list->KeyCount = $Outlets_list->RowIndex;
		if ($Outlets_list->isCopy() && !$Outlets_list->loadRow())
			$Outlets->CurrentAction = "add";
		if ($Outlets_list->isAdd())
			$Outlets_list->loadRowValues();
		if ($Outlets->EventCancelled) // Insert failed
			$Outlets_list->restoreFormValues(); // Restore form values

		// Set row properties
		$Outlets->resetAttributes();
		$Outlets->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_Outlets", "data-rowtype" => ROWTYPE_ADD]);
		$Outlets->RowType = ROWTYPE_ADD;

		// Render row
		$Outlets_list->renderRow();

		// Render list options
		$Outlets_list->renderListOptions();
		$Outlets_list->StartRowCount = 0;
?>
	<tr <?php echo $Outlets->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Outlets_list->ListOptions->render("body", "left", $Outlets_list->RowCount);
?>
	<?php if ($Outlets_list->Outlet_Idn->Visible) { // Outlet_Idn ?>
		<td data-name="Outlet_Idn">
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Outlet_Idn" class="form-group Outlets_Outlet_Idn"></span>
<input type="hidden" data-table="Outlets" data-field="x_Outlet_Idn" name="o<?php echo $Outlets_list->RowIndex ?>_Outlet_Idn" id="o<?php echo $Outlets_list->RowIndex ?>_Outlet_Idn" value="<?php echo HtmlEncode($Outlets_list->Outlet_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Outlets_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Name" class="form-group Outlets_Name">
<input type="text" data-table="Outlets" data-field="x_Name" name="x<?php echo $Outlets_list->RowIndex ?>_Name" id="x<?php echo $Outlets_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Outlets_list->Name->getPlaceHolder()) ?>" value="<?php echo $Outlets_list->Name->EditValue ?>"<?php echo $Outlets_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Outlets" data-field="x_Name" name="o<?php echo $Outlets_list->RowIndex ?>_Name" id="o<?php echo $Outlets_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Outlets_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Outlets_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Rank" class="form-group Outlets_Rank">
<input type="text" data-table="Outlets" data-field="x_Rank" name="x<?php echo $Outlets_list->RowIndex ?>_Rank" id="x<?php echo $Outlets_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Outlets_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Outlets_list->Rank->EditValue ?>"<?php echo $Outlets_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Outlets" data-field="x_Rank" name="o<?php echo $Outlets_list->RowIndex ?>_Rank" id="o<?php echo $Outlets_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Outlets_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Outlets_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_ActiveFlag" class="form-group Outlets_ActiveFlag">
<?php
$selwrk = ConvertToBool($Outlets_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Outlets" data-field="x_ActiveFlag" name="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]_726041" value="1"<?php echo $selwrk ?><?php echo $Outlets_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]_726041"></label>
</div>
</span>
<input type="hidden" data-table="Outlets" data-field="x_ActiveFlag" name="o<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Outlets_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Outlets_list->ListOptions->render("body", "right", $Outlets_list->RowCount);
?>
<script>
loadjs.ready(["fOutletslist", "load"], function() {
	fOutletslist.updateLists(<?php echo $Outlets_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($Outlets_list->ExportAll && $Outlets_list->isExport()) {
	$Outlets_list->StopRecord = $Outlets_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Outlets_list->TotalRecords > $Outlets_list->StartRecord + $Outlets_list->DisplayRecords - 1)
		$Outlets_list->StopRecord = $Outlets_list->StartRecord + $Outlets_list->DisplayRecords - 1;
	else
		$Outlets_list->StopRecord = $Outlets_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($Outlets->isConfirm() || $Outlets_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Outlets_list->FormKeyCountName) && ($Outlets_list->isGridAdd() || $Outlets_list->isGridEdit() || $Outlets->isConfirm())) {
		$Outlets_list->KeyCount = $CurrentForm->getValue($Outlets_list->FormKeyCountName);
		$Outlets_list->StopRecord = $Outlets_list->StartRecord + $Outlets_list->KeyCount - 1;
	}
}
$Outlets_list->RecordCount = $Outlets_list->StartRecord - 1;
if ($Outlets_list->Recordset && !$Outlets_list->Recordset->EOF) {
	$Outlets_list->Recordset->moveFirst();
	$selectLimit = $Outlets_list->UseSelectLimit;
	if (!$selectLimit && $Outlets_list->StartRecord > 1)
		$Outlets_list->Recordset->move($Outlets_list->StartRecord - 1);
} elseif (!$Outlets->AllowAddDeleteRow && $Outlets_list->StopRecord == 0) {
	$Outlets_list->StopRecord = $Outlets->GridAddRowCount;
}

// Initialize aggregate
$Outlets->RowType = ROWTYPE_AGGREGATEINIT;
$Outlets->resetAttributes();
$Outlets_list->renderRow();
$Outlets_list->EditRowCount = 0;
if ($Outlets_list->isEdit())
	$Outlets_list->RowIndex = 1;
if ($Outlets_list->isGridAdd())
	$Outlets_list->RowIndex = 0;
if ($Outlets_list->isGridEdit())
	$Outlets_list->RowIndex = 0;
while ($Outlets_list->RecordCount < $Outlets_list->StopRecord) {
	$Outlets_list->RecordCount++;
	if ($Outlets_list->RecordCount >= $Outlets_list->StartRecord) {
		$Outlets_list->RowCount++;
		if ($Outlets_list->isGridAdd() || $Outlets_list->isGridEdit() || $Outlets->isConfirm()) {
			$Outlets_list->RowIndex++;
			$CurrentForm->Index = $Outlets_list->RowIndex;
			if ($CurrentForm->hasValue($Outlets_list->FormActionName) && ($Outlets->isConfirm() || $Outlets_list->EventCancelled))
				$Outlets_list->RowAction = strval($CurrentForm->getValue($Outlets_list->FormActionName));
			elseif ($Outlets_list->isGridAdd())
				$Outlets_list->RowAction = "insert";
			else
				$Outlets_list->RowAction = "";
		}

		// Set up key count
		$Outlets_list->KeyCount = $Outlets_list->RowIndex;

		// Init row class and style
		$Outlets->resetAttributes();
		$Outlets->CssClass = "";
		if ($Outlets_list->isGridAdd()) {
			$Outlets_list->loadRowValues(); // Load default values
		} else {
			$Outlets_list->loadRowValues($Outlets_list->Recordset); // Load row values
		}
		$Outlets->RowType = ROWTYPE_VIEW; // Render view
		if ($Outlets_list->isGridAdd()) // Grid add
			$Outlets->RowType = ROWTYPE_ADD; // Render add
		if ($Outlets_list->isGridAdd() && $Outlets->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Outlets_list->restoreCurrentRowFormValues($Outlets_list->RowIndex); // Restore form values
		if ($Outlets_list->isEdit()) {
			if ($Outlets_list->checkInlineEditKey() && $Outlets_list->EditRowCount == 0) { // Inline edit
				$Outlets->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($Outlets_list->isGridEdit()) { // Grid edit
			if ($Outlets->EventCancelled)
				$Outlets_list->restoreCurrentRowFormValues($Outlets_list->RowIndex); // Restore form values
			if ($Outlets_list->RowAction == "insert")
				$Outlets->RowType = ROWTYPE_ADD; // Render add
			else
				$Outlets->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Outlets_list->isEdit() && $Outlets->RowType == ROWTYPE_EDIT && $Outlets->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$Outlets_list->restoreFormValues(); // Restore form values
		}
		if ($Outlets_list->isGridEdit() && ($Outlets->RowType == ROWTYPE_EDIT || $Outlets->RowType == ROWTYPE_ADD) && $Outlets->EventCancelled) // Update failed
			$Outlets_list->restoreCurrentRowFormValues($Outlets_list->RowIndex); // Restore form values
		if ($Outlets->RowType == ROWTYPE_EDIT) // Edit row
			$Outlets_list->EditRowCount++;

		// Set up row id / data-rowindex
		$Outlets->RowAttrs->merge(["data-rowindex" => $Outlets_list->RowCount, "id" => "r" . $Outlets_list->RowCount . "_Outlets", "data-rowtype" => $Outlets->RowType]);

		// Render row
		$Outlets_list->renderRow();

		// Render list options
		$Outlets_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Outlets_list->RowAction != "delete" && $Outlets_list->RowAction != "insertdelete" && !($Outlets_list->RowAction == "insert" && $Outlets->isConfirm() && $Outlets_list->emptyRow())) {
?>
	<tr <?php echo $Outlets->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Outlets_list->ListOptions->render("body", "left", $Outlets_list->RowCount);
?>
	<?php if ($Outlets_list->Outlet_Idn->Visible) { // Outlet_Idn ?>
		<td data-name="Outlet_Idn" <?php echo $Outlets_list->Outlet_Idn->cellAttributes() ?>>
<?php if ($Outlets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Outlet_Idn" class="form-group"></span>
<input type="hidden" data-table="Outlets" data-field="x_Outlet_Idn" name="o<?php echo $Outlets_list->RowIndex ?>_Outlet_Idn" id="o<?php echo $Outlets_list->RowIndex ?>_Outlet_Idn" value="<?php echo HtmlEncode($Outlets_list->Outlet_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Outlets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Outlet_Idn" class="form-group">
<span<?php echo $Outlets_list->Outlet_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Outlets_list->Outlet_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Outlets" data-field="x_Outlet_Idn" name="x<?php echo $Outlets_list->RowIndex ?>_Outlet_Idn" id="x<?php echo $Outlets_list->RowIndex ?>_Outlet_Idn" value="<?php echo HtmlEncode($Outlets_list->Outlet_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($Outlets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Outlet_Idn">
<span<?php echo $Outlets_list->Outlet_Idn->viewAttributes() ?>><?php echo $Outlets_list->Outlet_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Outlets_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $Outlets_list->Name->cellAttributes() ?>>
<?php if ($Outlets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Name" class="form-group">
<input type="text" data-table="Outlets" data-field="x_Name" name="x<?php echo $Outlets_list->RowIndex ?>_Name" id="x<?php echo $Outlets_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Outlets_list->Name->getPlaceHolder()) ?>" value="<?php echo $Outlets_list->Name->EditValue ?>"<?php echo $Outlets_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Outlets" data-field="x_Name" name="o<?php echo $Outlets_list->RowIndex ?>_Name" id="o<?php echo $Outlets_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Outlets_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($Outlets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Name" class="form-group">
<input type="text" data-table="Outlets" data-field="x_Name" name="x<?php echo $Outlets_list->RowIndex ?>_Name" id="x<?php echo $Outlets_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Outlets_list->Name->getPlaceHolder()) ?>" value="<?php echo $Outlets_list->Name->EditValue ?>"<?php echo $Outlets_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Outlets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Name">
<span<?php echo $Outlets_list->Name->viewAttributes() ?>><?php echo $Outlets_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Outlets_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $Outlets_list->Rank->cellAttributes() ?>>
<?php if ($Outlets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Rank" class="form-group">
<input type="text" data-table="Outlets" data-field="x_Rank" name="x<?php echo $Outlets_list->RowIndex ?>_Rank" id="x<?php echo $Outlets_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Outlets_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Outlets_list->Rank->EditValue ?>"<?php echo $Outlets_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Outlets" data-field="x_Rank" name="o<?php echo $Outlets_list->RowIndex ?>_Rank" id="o<?php echo $Outlets_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Outlets_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($Outlets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Rank" class="form-group">
<input type="text" data-table="Outlets" data-field="x_Rank" name="x<?php echo $Outlets_list->RowIndex ?>_Rank" id="x<?php echo $Outlets_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Outlets_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Outlets_list->Rank->EditValue ?>"<?php echo $Outlets_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Outlets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_Rank">
<span<?php echo $Outlets_list->Rank->viewAttributes() ?>><?php echo $Outlets_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Outlets_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $Outlets_list->ActiveFlag->cellAttributes() ?>>
<?php if ($Outlets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Outlets_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Outlets" data-field="x_ActiveFlag" name="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]_528127" value="1"<?php echo $selwrk ?><?php echo $Outlets_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]_528127"></label>
</div>
</span>
<input type="hidden" data-table="Outlets" data-field="x_ActiveFlag" name="o<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Outlets_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($Outlets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Outlets_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Outlets" data-field="x_ActiveFlag" name="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]_600526" value="1"<?php echo $selwrk ?><?php echo $Outlets_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]_600526"></label>
</div>
</span>
<?php } ?>
<?php if ($Outlets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Outlets_list->RowCount ?>_Outlets_ActiveFlag">
<span<?php echo $Outlets_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Outlets_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Outlets_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Outlets_list->ListOptions->render("body", "right", $Outlets_list->RowCount);
?>
	</tr>
<?php if ($Outlets->RowType == ROWTYPE_ADD || $Outlets->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fOutletslist", "load"], function() {
	fOutletslist.updateLists(<?php echo $Outlets_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Outlets_list->isGridAdd())
		if (!$Outlets_list->Recordset->EOF)
			$Outlets_list->Recordset->moveNext();
}
?>
<?php
	if ($Outlets_list->isGridAdd() || $Outlets_list->isGridEdit()) {
		$Outlets_list->RowIndex = '$rowindex$';
		$Outlets_list->loadRowValues();

		// Set row properties
		$Outlets->resetAttributes();
		$Outlets->RowAttrs->merge(["data-rowindex" => $Outlets_list->RowIndex, "id" => "r0_Outlets", "data-rowtype" => ROWTYPE_ADD]);
		$Outlets->RowAttrs->appendClass("ew-template");
		$Outlets->RowType = ROWTYPE_ADD;

		// Render row
		$Outlets_list->renderRow();

		// Render list options
		$Outlets_list->renderListOptions();
		$Outlets_list->StartRowCount = 0;
?>
	<tr <?php echo $Outlets->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Outlets_list->ListOptions->render("body", "left", $Outlets_list->RowIndex);
?>
	<?php if ($Outlets_list->Outlet_Idn->Visible) { // Outlet_Idn ?>
		<td data-name="Outlet_Idn">
<span id="el$rowindex$_Outlets_Outlet_Idn" class="form-group Outlets_Outlet_Idn"></span>
<input type="hidden" data-table="Outlets" data-field="x_Outlet_Idn" name="o<?php echo $Outlets_list->RowIndex ?>_Outlet_Idn" id="o<?php echo $Outlets_list->RowIndex ?>_Outlet_Idn" value="<?php echo HtmlEncode($Outlets_list->Outlet_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Outlets_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_Outlets_Name" class="form-group Outlets_Name">
<input type="text" data-table="Outlets" data-field="x_Name" name="x<?php echo $Outlets_list->RowIndex ?>_Name" id="x<?php echo $Outlets_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Outlets_list->Name->getPlaceHolder()) ?>" value="<?php echo $Outlets_list->Name->EditValue ?>"<?php echo $Outlets_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Outlets" data-field="x_Name" name="o<?php echo $Outlets_list->RowIndex ?>_Name" id="o<?php echo $Outlets_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Outlets_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Outlets_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_Outlets_Rank" class="form-group Outlets_Rank">
<input type="text" data-table="Outlets" data-field="x_Rank" name="x<?php echo $Outlets_list->RowIndex ?>_Rank" id="x<?php echo $Outlets_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Outlets_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Outlets_list->Rank->EditValue ?>"<?php echo $Outlets_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Outlets" data-field="x_Rank" name="o<?php echo $Outlets_list->RowIndex ?>_Rank" id="o<?php echo $Outlets_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Outlets_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Outlets_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_Outlets_ActiveFlag" class="form-group Outlets_ActiveFlag">
<?php
$selwrk = ConvertToBool($Outlets_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Outlets" data-field="x_ActiveFlag" name="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]_660105" value="1"<?php echo $selwrk ?><?php echo $Outlets_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]_660105"></label>
</div>
</span>
<input type="hidden" data-table="Outlets" data-field="x_ActiveFlag" name="o<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Outlets_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Outlets_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Outlets_list->ListOptions->render("body", "right", $Outlets_list->RowIndex);
?>
<script>
loadjs.ready(["fOutletslist", "load"], function() {
	fOutletslist.updateLists(<?php echo $Outlets_list->RowIndex ?>);
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
<?php if ($Outlets_list->isAdd() || $Outlets_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $Outlets_list->FormKeyCountName ?>" id="<?php echo $Outlets_list->FormKeyCountName ?>" value="<?php echo $Outlets_list->KeyCount ?>">
<?php } ?>
<?php if ($Outlets_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $Outlets_list->FormKeyCountName ?>" id="<?php echo $Outlets_list->FormKeyCountName ?>" value="<?php echo $Outlets_list->KeyCount ?>">
<?php echo $Outlets_list->MultiSelectKey ?>
<?php } ?>
<?php if ($Outlets_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $Outlets_list->FormKeyCountName ?>" id="<?php echo $Outlets_list->FormKeyCountName ?>" value="<?php echo $Outlets_list->KeyCount ?>">
<?php } ?>
<?php if ($Outlets_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $Outlets_list->FormKeyCountName ?>" id="<?php echo $Outlets_list->FormKeyCountName ?>" value="<?php echo $Outlets_list->KeyCount ?>">
<?php echo $Outlets_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$Outlets->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Outlets_list->Recordset)
	$Outlets_list->Recordset->Close();
?>
<?php if (!$Outlets_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Outlets_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Outlets_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Outlets_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Outlets_list->TotalRecords == 0 && !$Outlets->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Outlets_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Outlets_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Outlets_list->isExport()) { ?>
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
$Outlets_list->terminate();
?>