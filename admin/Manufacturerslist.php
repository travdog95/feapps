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
$Manufacturers_list = new Manufacturers_list();

// Run the page
$Manufacturers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Manufacturers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Manufacturers_list->isExport()) { ?>
<script>
var fManufacturerslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fManufacturerslist = currentForm = new ew.Form("fManufacturerslist", "list");
	fManufacturerslist.formKeyCountName = '<?php echo $Manufacturers_list->FormKeyCountName ?>';

	// Validate form
	fManufacturerslist.validate = function() {
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
			<?php if ($Manufacturers_list->Manufacturer_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Manufacturer_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Manufacturers_list->Manufacturer_Idn->caption(), $Manufacturers_list->Manufacturer_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Manufacturers_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Manufacturers_list->Name->caption(), $Manufacturers_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Manufacturers_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Manufacturers_list->ActiveFlag->caption(), $Manufacturers_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fManufacturerslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fManufacturerslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fManufacturerslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fManufacturerslist.lists["x_ActiveFlag[]"] = <?php echo $Manufacturers_list->ActiveFlag->Lookup->toClientList($Manufacturers_list) ?>;
	fManufacturerslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Manufacturers_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fManufacturerslist");
});
var fManufacturerslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fManufacturerslistsrch = currentSearchForm = new ew.Form("fManufacturerslistsrch");

	// Dynamic selection lists
	// Filters

	fManufacturerslistsrch.filterList = <?php echo $Manufacturers_list->getFilterList() ?>;
	loadjs.done("fManufacturerslistsrch");
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
<?php if (!$Manufacturers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Manufacturers_list->TotalRecords > 0 && $Manufacturers_list->ExportOptions->visible()) { ?>
<?php $Manufacturers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Manufacturers_list->ImportOptions->visible()) { ?>
<?php $Manufacturers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Manufacturers_list->SearchOptions->visible()) { ?>
<?php $Manufacturers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Manufacturers_list->FilterOptions->visible()) { ?>
<?php $Manufacturers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Manufacturers_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Manufacturers_list->isExport() && !$Manufacturers->CurrentAction) { ?>
<form name="fManufacturerslistsrch" id="fManufacturerslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fManufacturerslistsrch-search-panel" class="<?php echo $Manufacturers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Manufacturers">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Manufacturers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Manufacturers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Manufacturers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Manufacturers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Manufacturers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Manufacturers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Manufacturers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Manufacturers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Manufacturers_list->showPageHeader(); ?>
<?php
$Manufacturers_list->showMessage();
?>
<?php if ($Manufacturers_list->TotalRecords > 0 || $Manufacturers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Manufacturers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Manufacturers">
<?php if (!$Manufacturers_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Manufacturers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Manufacturers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Manufacturers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fManufacturerslist" id="fManufacturerslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Manufacturers">
<div id="gmp_Manufacturers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Manufacturers_list->TotalRecords > 0 || $Manufacturers_list->isAdd() || $Manufacturers_list->isCopy() || $Manufacturers_list->isGridEdit()) { ?>
<table id="tbl_Manufacturerslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Manufacturers->RowType = ROWTYPE_HEADER;

// Render list options
$Manufacturers_list->renderListOptions();

// Render list options (header, left)
$Manufacturers_list->ListOptions->render("header", "left");
?>
<?php if ($Manufacturers_list->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
	<?php if ($Manufacturers_list->SortUrl($Manufacturers_list->Manufacturer_Idn) == "") { ?>
		<th data-name="Manufacturer_Idn" class="<?php echo $Manufacturers_list->Manufacturer_Idn->headerCellClass() ?>"><div id="elh_Manufacturers_Manufacturer_Idn" class="Manufacturers_Manufacturer_Idn"><div class="ew-table-header-caption"><?php echo $Manufacturers_list->Manufacturer_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Manufacturer_Idn" class="<?php echo $Manufacturers_list->Manufacturer_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Manufacturers_list->SortUrl($Manufacturers_list->Manufacturer_Idn) ?>', 1);"><div id="elh_Manufacturers_Manufacturer_Idn" class="Manufacturers_Manufacturer_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Manufacturers_list->Manufacturer_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Manufacturers_list->Manufacturer_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Manufacturers_list->Manufacturer_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Manufacturers_list->Name->Visible) { // Name ?>
	<?php if ($Manufacturers_list->SortUrl($Manufacturers_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $Manufacturers_list->Name->headerCellClass() ?>"><div id="elh_Manufacturers_Name" class="Manufacturers_Name"><div class="ew-table-header-caption"><?php echo $Manufacturers_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $Manufacturers_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Manufacturers_list->SortUrl($Manufacturers_list->Name) ?>', 1);"><div id="elh_Manufacturers_Name" class="Manufacturers_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Manufacturers_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Manufacturers_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Manufacturers_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Manufacturers_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($Manufacturers_list->SortUrl($Manufacturers_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $Manufacturers_list->ActiveFlag->headerCellClass() ?>"><div id="elh_Manufacturers_ActiveFlag" class="Manufacturers_ActiveFlag"><div class="ew-table-header-caption"><?php echo $Manufacturers_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $Manufacturers_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Manufacturers_list->SortUrl($Manufacturers_list->ActiveFlag) ?>', 1);"><div id="elh_Manufacturers_ActiveFlag" class="Manufacturers_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Manufacturers_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Manufacturers_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Manufacturers_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Manufacturers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($Manufacturers_list->isAdd() || $Manufacturers_list->isCopy()) {
		$Manufacturers_list->RowIndex = 0;
		$Manufacturers_list->KeyCount = $Manufacturers_list->RowIndex;
		if ($Manufacturers_list->isCopy() && !$Manufacturers_list->loadRow())
			$Manufacturers->CurrentAction = "add";
		if ($Manufacturers_list->isAdd())
			$Manufacturers_list->loadRowValues();
		if ($Manufacturers->EventCancelled) // Insert failed
			$Manufacturers_list->restoreFormValues(); // Restore form values

		// Set row properties
		$Manufacturers->resetAttributes();
		$Manufacturers->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_Manufacturers", "data-rowtype" => ROWTYPE_ADD]);
		$Manufacturers->RowType = ROWTYPE_ADD;

		// Render row
		$Manufacturers_list->renderRow();

		// Render list options
		$Manufacturers_list->renderListOptions();
		$Manufacturers_list->StartRowCount = 0;
?>
	<tr <?php echo $Manufacturers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Manufacturers_list->ListOptions->render("body", "left", $Manufacturers_list->RowCount);
?>
	<?php if ($Manufacturers_list->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
		<td data-name="Manufacturer_Idn">
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_Manufacturer_Idn" class="form-group Manufacturers_Manufacturer_Idn"></span>
<input type="hidden" data-table="Manufacturers" data-field="x_Manufacturer_Idn" name="o<?php echo $Manufacturers_list->RowIndex ?>_Manufacturer_Idn" id="o<?php echo $Manufacturers_list->RowIndex ?>_Manufacturer_Idn" value="<?php echo HtmlEncode($Manufacturers_list->Manufacturer_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Manufacturers_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_Name" class="form-group Manufacturers_Name">
<input type="text" data-table="Manufacturers" data-field="x_Name" name="x<?php echo $Manufacturers_list->RowIndex ?>_Name" id="x<?php echo $Manufacturers_list->RowIndex ?>_Name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Manufacturers_list->Name->getPlaceHolder()) ?>" value="<?php echo $Manufacturers_list->Name->EditValue ?>"<?php echo $Manufacturers_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Manufacturers" data-field="x_Name" name="o<?php echo $Manufacturers_list->RowIndex ?>_Name" id="o<?php echo $Manufacturers_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Manufacturers_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Manufacturers_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_ActiveFlag" class="form-group Manufacturers_ActiveFlag">
<?php
$selwrk = ConvertToBool($Manufacturers_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Manufacturers" data-field="x_ActiveFlag" name="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]_801974" value="1"<?php echo $selwrk ?><?php echo $Manufacturers_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]_801974"></label>
</div>
</span>
<input type="hidden" data-table="Manufacturers" data-field="x_ActiveFlag" name="o<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Manufacturers_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Manufacturers_list->ListOptions->render("body", "right", $Manufacturers_list->RowCount);
?>
<script>
loadjs.ready(["fManufacturerslist", "load"], function() {
	fManufacturerslist.updateLists(<?php echo $Manufacturers_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($Manufacturers_list->ExportAll && $Manufacturers_list->isExport()) {
	$Manufacturers_list->StopRecord = $Manufacturers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Manufacturers_list->TotalRecords > $Manufacturers_list->StartRecord + $Manufacturers_list->DisplayRecords - 1)
		$Manufacturers_list->StopRecord = $Manufacturers_list->StartRecord + $Manufacturers_list->DisplayRecords - 1;
	else
		$Manufacturers_list->StopRecord = $Manufacturers_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($Manufacturers->isConfirm() || $Manufacturers_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Manufacturers_list->FormKeyCountName) && ($Manufacturers_list->isGridAdd() || $Manufacturers_list->isGridEdit() || $Manufacturers->isConfirm())) {
		$Manufacturers_list->KeyCount = $CurrentForm->getValue($Manufacturers_list->FormKeyCountName);
		$Manufacturers_list->StopRecord = $Manufacturers_list->StartRecord + $Manufacturers_list->KeyCount - 1;
	}
}
$Manufacturers_list->RecordCount = $Manufacturers_list->StartRecord - 1;
if ($Manufacturers_list->Recordset && !$Manufacturers_list->Recordset->EOF) {
	$Manufacturers_list->Recordset->moveFirst();
	$selectLimit = $Manufacturers_list->UseSelectLimit;
	if (!$selectLimit && $Manufacturers_list->StartRecord > 1)
		$Manufacturers_list->Recordset->move($Manufacturers_list->StartRecord - 1);
} elseif (!$Manufacturers->AllowAddDeleteRow && $Manufacturers_list->StopRecord == 0) {
	$Manufacturers_list->StopRecord = $Manufacturers->GridAddRowCount;
}

// Initialize aggregate
$Manufacturers->RowType = ROWTYPE_AGGREGATEINIT;
$Manufacturers->resetAttributes();
$Manufacturers_list->renderRow();
$Manufacturers_list->EditRowCount = 0;
if ($Manufacturers_list->isEdit())
	$Manufacturers_list->RowIndex = 1;
if ($Manufacturers_list->isGridAdd())
	$Manufacturers_list->RowIndex = 0;
if ($Manufacturers_list->isGridEdit())
	$Manufacturers_list->RowIndex = 0;
while ($Manufacturers_list->RecordCount < $Manufacturers_list->StopRecord) {
	$Manufacturers_list->RecordCount++;
	if ($Manufacturers_list->RecordCount >= $Manufacturers_list->StartRecord) {
		$Manufacturers_list->RowCount++;
		if ($Manufacturers_list->isGridAdd() || $Manufacturers_list->isGridEdit() || $Manufacturers->isConfirm()) {
			$Manufacturers_list->RowIndex++;
			$CurrentForm->Index = $Manufacturers_list->RowIndex;
			if ($CurrentForm->hasValue($Manufacturers_list->FormActionName) && ($Manufacturers->isConfirm() || $Manufacturers_list->EventCancelled))
				$Manufacturers_list->RowAction = strval($CurrentForm->getValue($Manufacturers_list->FormActionName));
			elseif ($Manufacturers_list->isGridAdd())
				$Manufacturers_list->RowAction = "insert";
			else
				$Manufacturers_list->RowAction = "";
		}

		// Set up key count
		$Manufacturers_list->KeyCount = $Manufacturers_list->RowIndex;

		// Init row class and style
		$Manufacturers->resetAttributes();
		$Manufacturers->CssClass = "";
		if ($Manufacturers_list->isGridAdd()) {
			$Manufacturers_list->loadRowValues(); // Load default values
		} else {
			$Manufacturers_list->loadRowValues($Manufacturers_list->Recordset); // Load row values
		}
		$Manufacturers->RowType = ROWTYPE_VIEW; // Render view
		if ($Manufacturers_list->isGridAdd()) // Grid add
			$Manufacturers->RowType = ROWTYPE_ADD; // Render add
		if ($Manufacturers_list->isGridAdd() && $Manufacturers->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Manufacturers_list->restoreCurrentRowFormValues($Manufacturers_list->RowIndex); // Restore form values
		if ($Manufacturers_list->isEdit()) {
			if ($Manufacturers_list->checkInlineEditKey() && $Manufacturers_list->EditRowCount == 0) { // Inline edit
				$Manufacturers->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($Manufacturers_list->isGridEdit()) { // Grid edit
			if ($Manufacturers->EventCancelled)
				$Manufacturers_list->restoreCurrentRowFormValues($Manufacturers_list->RowIndex); // Restore form values
			if ($Manufacturers_list->RowAction == "insert")
				$Manufacturers->RowType = ROWTYPE_ADD; // Render add
			else
				$Manufacturers->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Manufacturers_list->isEdit() && $Manufacturers->RowType == ROWTYPE_EDIT && $Manufacturers->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$Manufacturers_list->restoreFormValues(); // Restore form values
		}
		if ($Manufacturers_list->isGridEdit() && ($Manufacturers->RowType == ROWTYPE_EDIT || $Manufacturers->RowType == ROWTYPE_ADD) && $Manufacturers->EventCancelled) // Update failed
			$Manufacturers_list->restoreCurrentRowFormValues($Manufacturers_list->RowIndex); // Restore form values
		if ($Manufacturers->RowType == ROWTYPE_EDIT) // Edit row
			$Manufacturers_list->EditRowCount++;

		// Set up row id / data-rowindex
		$Manufacturers->RowAttrs->merge(["data-rowindex" => $Manufacturers_list->RowCount, "id" => "r" . $Manufacturers_list->RowCount . "_Manufacturers", "data-rowtype" => $Manufacturers->RowType]);

		// Render row
		$Manufacturers_list->renderRow();

		// Render list options
		$Manufacturers_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Manufacturers_list->RowAction != "delete" && $Manufacturers_list->RowAction != "insertdelete" && !($Manufacturers_list->RowAction == "insert" && $Manufacturers->isConfirm() && $Manufacturers_list->emptyRow())) {
?>
	<tr <?php echo $Manufacturers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Manufacturers_list->ListOptions->render("body", "left", $Manufacturers_list->RowCount);
?>
	<?php if ($Manufacturers_list->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
		<td data-name="Manufacturer_Idn" <?php echo $Manufacturers_list->Manufacturer_Idn->cellAttributes() ?>>
<?php if ($Manufacturers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_Manufacturer_Idn" class="form-group"></span>
<input type="hidden" data-table="Manufacturers" data-field="x_Manufacturer_Idn" name="o<?php echo $Manufacturers_list->RowIndex ?>_Manufacturer_Idn" id="o<?php echo $Manufacturers_list->RowIndex ?>_Manufacturer_Idn" value="<?php echo HtmlEncode($Manufacturers_list->Manufacturer_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Manufacturers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_Manufacturer_Idn" class="form-group">
<span<?php echo $Manufacturers_list->Manufacturer_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Manufacturers_list->Manufacturer_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Manufacturers" data-field="x_Manufacturer_Idn" name="x<?php echo $Manufacturers_list->RowIndex ?>_Manufacturer_Idn" id="x<?php echo $Manufacturers_list->RowIndex ?>_Manufacturer_Idn" value="<?php echo HtmlEncode($Manufacturers_list->Manufacturer_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($Manufacturers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_Manufacturer_Idn">
<span<?php echo $Manufacturers_list->Manufacturer_Idn->viewAttributes() ?>><?php echo $Manufacturers_list->Manufacturer_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Manufacturers_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $Manufacturers_list->Name->cellAttributes() ?>>
<?php if ($Manufacturers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_Name" class="form-group">
<input type="text" data-table="Manufacturers" data-field="x_Name" name="x<?php echo $Manufacturers_list->RowIndex ?>_Name" id="x<?php echo $Manufacturers_list->RowIndex ?>_Name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Manufacturers_list->Name->getPlaceHolder()) ?>" value="<?php echo $Manufacturers_list->Name->EditValue ?>"<?php echo $Manufacturers_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Manufacturers" data-field="x_Name" name="o<?php echo $Manufacturers_list->RowIndex ?>_Name" id="o<?php echo $Manufacturers_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Manufacturers_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($Manufacturers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_Name" class="form-group">
<input type="text" data-table="Manufacturers" data-field="x_Name" name="x<?php echo $Manufacturers_list->RowIndex ?>_Name" id="x<?php echo $Manufacturers_list->RowIndex ?>_Name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Manufacturers_list->Name->getPlaceHolder()) ?>" value="<?php echo $Manufacturers_list->Name->EditValue ?>"<?php echo $Manufacturers_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Manufacturers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_Name">
<span<?php echo $Manufacturers_list->Name->viewAttributes() ?>><?php echo $Manufacturers_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Manufacturers_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $Manufacturers_list->ActiveFlag->cellAttributes() ?>>
<?php if ($Manufacturers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Manufacturers_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Manufacturers" data-field="x_ActiveFlag" name="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]_595410" value="1"<?php echo $selwrk ?><?php echo $Manufacturers_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]_595410"></label>
</div>
</span>
<input type="hidden" data-table="Manufacturers" data-field="x_ActiveFlag" name="o<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Manufacturers_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($Manufacturers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Manufacturers_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Manufacturers" data-field="x_ActiveFlag" name="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]_739599" value="1"<?php echo $selwrk ?><?php echo $Manufacturers_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]_739599"></label>
</div>
</span>
<?php } ?>
<?php if ($Manufacturers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Manufacturers_list->RowCount ?>_Manufacturers_ActiveFlag">
<span<?php echo $Manufacturers_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Manufacturers_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Manufacturers_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Manufacturers_list->ListOptions->render("body", "right", $Manufacturers_list->RowCount);
?>
	</tr>
<?php if ($Manufacturers->RowType == ROWTYPE_ADD || $Manufacturers->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fManufacturerslist", "load"], function() {
	fManufacturerslist.updateLists(<?php echo $Manufacturers_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Manufacturers_list->isGridAdd())
		if (!$Manufacturers_list->Recordset->EOF)
			$Manufacturers_list->Recordset->moveNext();
}
?>
<?php
	if ($Manufacturers_list->isGridAdd() || $Manufacturers_list->isGridEdit()) {
		$Manufacturers_list->RowIndex = '$rowindex$';
		$Manufacturers_list->loadRowValues();

		// Set row properties
		$Manufacturers->resetAttributes();
		$Manufacturers->RowAttrs->merge(["data-rowindex" => $Manufacturers_list->RowIndex, "id" => "r0_Manufacturers", "data-rowtype" => ROWTYPE_ADD]);
		$Manufacturers->RowAttrs->appendClass("ew-template");
		$Manufacturers->RowType = ROWTYPE_ADD;

		// Render row
		$Manufacturers_list->renderRow();

		// Render list options
		$Manufacturers_list->renderListOptions();
		$Manufacturers_list->StartRowCount = 0;
?>
	<tr <?php echo $Manufacturers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Manufacturers_list->ListOptions->render("body", "left", $Manufacturers_list->RowIndex);
?>
	<?php if ($Manufacturers_list->Manufacturer_Idn->Visible) { // Manufacturer_Idn ?>
		<td data-name="Manufacturer_Idn">
<span id="el$rowindex$_Manufacturers_Manufacturer_Idn" class="form-group Manufacturers_Manufacturer_Idn"></span>
<input type="hidden" data-table="Manufacturers" data-field="x_Manufacturer_Idn" name="o<?php echo $Manufacturers_list->RowIndex ?>_Manufacturer_Idn" id="o<?php echo $Manufacturers_list->RowIndex ?>_Manufacturer_Idn" value="<?php echo HtmlEncode($Manufacturers_list->Manufacturer_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Manufacturers_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_Manufacturers_Name" class="form-group Manufacturers_Name">
<input type="text" data-table="Manufacturers" data-field="x_Name" name="x<?php echo $Manufacturers_list->RowIndex ?>_Name" id="x<?php echo $Manufacturers_list->RowIndex ?>_Name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Manufacturers_list->Name->getPlaceHolder()) ?>" value="<?php echo $Manufacturers_list->Name->EditValue ?>"<?php echo $Manufacturers_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Manufacturers" data-field="x_Name" name="o<?php echo $Manufacturers_list->RowIndex ?>_Name" id="o<?php echo $Manufacturers_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Manufacturers_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Manufacturers_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_Manufacturers_ActiveFlag" class="form-group Manufacturers_ActiveFlag">
<?php
$selwrk = ConvertToBool($Manufacturers_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Manufacturers" data-field="x_ActiveFlag" name="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]_655229" value="1"<?php echo $selwrk ?><?php echo $Manufacturers_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]_655229"></label>
</div>
</span>
<input type="hidden" data-table="Manufacturers" data-field="x_ActiveFlag" name="o<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Manufacturers_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Manufacturers_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Manufacturers_list->ListOptions->render("body", "right", $Manufacturers_list->RowIndex);
?>
<script>
loadjs.ready(["fManufacturerslist", "load"], function() {
	fManufacturerslist.updateLists(<?php echo $Manufacturers_list->RowIndex ?>);
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
<?php if ($Manufacturers_list->isAdd() || $Manufacturers_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $Manufacturers_list->FormKeyCountName ?>" id="<?php echo $Manufacturers_list->FormKeyCountName ?>" value="<?php echo $Manufacturers_list->KeyCount ?>">
<?php } ?>
<?php if ($Manufacturers_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $Manufacturers_list->FormKeyCountName ?>" id="<?php echo $Manufacturers_list->FormKeyCountName ?>" value="<?php echo $Manufacturers_list->KeyCount ?>">
<?php echo $Manufacturers_list->MultiSelectKey ?>
<?php } ?>
<?php if ($Manufacturers_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $Manufacturers_list->FormKeyCountName ?>" id="<?php echo $Manufacturers_list->FormKeyCountName ?>" value="<?php echo $Manufacturers_list->KeyCount ?>">
<?php } ?>
<?php if ($Manufacturers_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $Manufacturers_list->FormKeyCountName ?>" id="<?php echo $Manufacturers_list->FormKeyCountName ?>" value="<?php echo $Manufacturers_list->KeyCount ?>">
<?php echo $Manufacturers_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$Manufacturers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Manufacturers_list->Recordset)
	$Manufacturers_list->Recordset->Close();
?>
<?php if (!$Manufacturers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Manufacturers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Manufacturers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Manufacturers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Manufacturers_list->TotalRecords == 0 && !$Manufacturers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Manufacturers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Manufacturers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Manufacturers_list->isExport()) { ?>
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
$Manufacturers_list->terminate();
?>