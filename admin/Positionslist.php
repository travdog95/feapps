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
$Positions_list = new Positions_list();

// Run the page
$Positions_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Positions_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Positions_list->isExport()) { ?>
<script>
var fPositionslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fPositionslist = currentForm = new ew.Form("fPositionslist", "list");
	fPositionslist.formKeyCountName = '<?php echo $Positions_list->FormKeyCountName ?>';

	// Validate form
	fPositionslist.validate = function() {
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
			<?php if ($Positions_list->Position_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Position_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Positions_list->Position_Idn->caption(), $Positions_list->Position_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Positions_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Positions_list->Name->caption(), $Positions_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Positions_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Positions_list->Rank->caption(), $Positions_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Positions_list->Rank->errorMessage()) ?>");
			<?php if ($Positions_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Positions_list->ActiveFlag->caption(), $Positions_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fPositionslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fPositionslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPositionslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fPositionslist.lists["x_ActiveFlag[]"] = <?php echo $Positions_list->ActiveFlag->Lookup->toClientList($Positions_list) ?>;
	fPositionslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Positions_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fPositionslist");
});
var fPositionslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fPositionslistsrch = currentSearchForm = new ew.Form("fPositionslistsrch");

	// Dynamic selection lists
	// Filters

	fPositionslistsrch.filterList = <?php echo $Positions_list->getFilterList() ?>;
	loadjs.done("fPositionslistsrch");
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
<?php if (!$Positions_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Positions_list->TotalRecords > 0 && $Positions_list->ExportOptions->visible()) { ?>
<?php $Positions_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Positions_list->ImportOptions->visible()) { ?>
<?php $Positions_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Positions_list->SearchOptions->visible()) { ?>
<?php $Positions_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Positions_list->FilterOptions->visible()) { ?>
<?php $Positions_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Positions_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Positions_list->isExport() && !$Positions->CurrentAction) { ?>
<form name="fPositionslistsrch" id="fPositionslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fPositionslistsrch-search-panel" class="<?php echo $Positions_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Positions">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Positions_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Positions_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Positions_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Positions_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Positions_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Positions_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Positions_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Positions_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Positions_list->showPageHeader(); ?>
<?php
$Positions_list->showMessage();
?>
<?php if ($Positions_list->TotalRecords > 0 || $Positions->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Positions_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Positions">
<?php if (!$Positions_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Positions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Positions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Positions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fPositionslist" id="fPositionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Positions">
<div id="gmp_Positions" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Positions_list->TotalRecords > 0 || $Positions_list->isAdd() || $Positions_list->isCopy() || $Positions_list->isGridEdit()) { ?>
<table id="tbl_Positionslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Positions->RowType = ROWTYPE_HEADER;

// Render list options
$Positions_list->renderListOptions();

// Render list options (header, left)
$Positions_list->ListOptions->render("header", "left");
?>
<?php if ($Positions_list->Position_Idn->Visible) { // Position_Idn ?>
	<?php if ($Positions_list->SortUrl($Positions_list->Position_Idn) == "") { ?>
		<th data-name="Position_Idn" class="<?php echo $Positions_list->Position_Idn->headerCellClass() ?>"><div id="elh_Positions_Position_Idn" class="Positions_Position_Idn"><div class="ew-table-header-caption"><?php echo $Positions_list->Position_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Position_Idn" class="<?php echo $Positions_list->Position_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Positions_list->SortUrl($Positions_list->Position_Idn) ?>', 1);"><div id="elh_Positions_Position_Idn" class="Positions_Position_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Positions_list->Position_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Positions_list->Position_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Positions_list->Position_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Positions_list->Name->Visible) { // Name ?>
	<?php if ($Positions_list->SortUrl($Positions_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $Positions_list->Name->headerCellClass() ?>"><div id="elh_Positions_Name" class="Positions_Name"><div class="ew-table-header-caption"><?php echo $Positions_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $Positions_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Positions_list->SortUrl($Positions_list->Name) ?>', 1);"><div id="elh_Positions_Name" class="Positions_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Positions_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Positions_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Positions_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Positions_list->Rank->Visible) { // Rank ?>
	<?php if ($Positions_list->SortUrl($Positions_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $Positions_list->Rank->headerCellClass() ?>"><div id="elh_Positions_Rank" class="Positions_Rank"><div class="ew-table-header-caption"><?php echo $Positions_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $Positions_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Positions_list->SortUrl($Positions_list->Rank) ?>', 1);"><div id="elh_Positions_Rank" class="Positions_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Positions_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($Positions_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Positions_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Positions_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($Positions_list->SortUrl($Positions_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $Positions_list->ActiveFlag->headerCellClass() ?>"><div id="elh_Positions_ActiveFlag" class="Positions_ActiveFlag"><div class="ew-table-header-caption"><?php echo $Positions_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $Positions_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Positions_list->SortUrl($Positions_list->ActiveFlag) ?>', 1);"><div id="elh_Positions_ActiveFlag" class="Positions_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Positions_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Positions_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Positions_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Positions_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($Positions_list->isAdd() || $Positions_list->isCopy()) {
		$Positions_list->RowIndex = 0;
		$Positions_list->KeyCount = $Positions_list->RowIndex;
		if ($Positions_list->isCopy() && !$Positions_list->loadRow())
			$Positions->CurrentAction = "add";
		if ($Positions_list->isAdd())
			$Positions_list->loadRowValues();
		if ($Positions->EventCancelled) // Insert failed
			$Positions_list->restoreFormValues(); // Restore form values

		// Set row properties
		$Positions->resetAttributes();
		$Positions->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_Positions", "data-rowtype" => ROWTYPE_ADD]);
		$Positions->RowType = ROWTYPE_ADD;

		// Render row
		$Positions_list->renderRow();

		// Render list options
		$Positions_list->renderListOptions();
		$Positions_list->StartRowCount = 0;
?>
	<tr <?php echo $Positions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Positions_list->ListOptions->render("body", "left", $Positions_list->RowCount);
?>
	<?php if ($Positions_list->Position_Idn->Visible) { // Position_Idn ?>
		<td data-name="Position_Idn">
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Position_Idn" class="form-group Positions_Position_Idn"></span>
<input type="hidden" data-table="Positions" data-field="x_Position_Idn" name="o<?php echo $Positions_list->RowIndex ?>_Position_Idn" id="o<?php echo $Positions_list->RowIndex ?>_Position_Idn" value="<?php echo HtmlEncode($Positions_list->Position_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Positions_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Name" class="form-group Positions_Name">
<input type="text" data-table="Positions" data-field="x_Name" name="x<?php echo $Positions_list->RowIndex ?>_Name" id="x<?php echo $Positions_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Positions_list->Name->getPlaceHolder()) ?>" value="<?php echo $Positions_list->Name->EditValue ?>"<?php echo $Positions_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Positions" data-field="x_Name" name="o<?php echo $Positions_list->RowIndex ?>_Name" id="o<?php echo $Positions_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Positions_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Positions_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Rank" class="form-group Positions_Rank">
<input type="text" data-table="Positions" data-field="x_Rank" name="x<?php echo $Positions_list->RowIndex ?>_Rank" id="x<?php echo $Positions_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Positions_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Positions_list->Rank->EditValue ?>"<?php echo $Positions_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Positions" data-field="x_Rank" name="o<?php echo $Positions_list->RowIndex ?>_Rank" id="o<?php echo $Positions_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Positions_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Positions_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_ActiveFlag" class="form-group Positions_ActiveFlag">
<?php
$selwrk = ConvertToBool($Positions_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Positions" data-field="x_ActiveFlag" name="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]_314082" value="1"<?php echo $selwrk ?><?php echo $Positions_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]_314082"></label>
</div>
</span>
<input type="hidden" data-table="Positions" data-field="x_ActiveFlag" name="o<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Positions_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Positions_list->ListOptions->render("body", "right", $Positions_list->RowCount);
?>
<script>
loadjs.ready(["fPositionslist", "load"], function() {
	fPositionslist.updateLists(<?php echo $Positions_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($Positions_list->ExportAll && $Positions_list->isExport()) {
	$Positions_list->StopRecord = $Positions_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Positions_list->TotalRecords > $Positions_list->StartRecord + $Positions_list->DisplayRecords - 1)
		$Positions_list->StopRecord = $Positions_list->StartRecord + $Positions_list->DisplayRecords - 1;
	else
		$Positions_list->StopRecord = $Positions_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($Positions->isConfirm() || $Positions_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Positions_list->FormKeyCountName) && ($Positions_list->isGridAdd() || $Positions_list->isGridEdit() || $Positions->isConfirm())) {
		$Positions_list->KeyCount = $CurrentForm->getValue($Positions_list->FormKeyCountName);
		$Positions_list->StopRecord = $Positions_list->StartRecord + $Positions_list->KeyCount - 1;
	}
}
$Positions_list->RecordCount = $Positions_list->StartRecord - 1;
if ($Positions_list->Recordset && !$Positions_list->Recordset->EOF) {
	$Positions_list->Recordset->moveFirst();
	$selectLimit = $Positions_list->UseSelectLimit;
	if (!$selectLimit && $Positions_list->StartRecord > 1)
		$Positions_list->Recordset->move($Positions_list->StartRecord - 1);
} elseif (!$Positions->AllowAddDeleteRow && $Positions_list->StopRecord == 0) {
	$Positions_list->StopRecord = $Positions->GridAddRowCount;
}

// Initialize aggregate
$Positions->RowType = ROWTYPE_AGGREGATEINIT;
$Positions->resetAttributes();
$Positions_list->renderRow();
$Positions_list->EditRowCount = 0;
if ($Positions_list->isEdit())
	$Positions_list->RowIndex = 1;
if ($Positions_list->isGridAdd())
	$Positions_list->RowIndex = 0;
if ($Positions_list->isGridEdit())
	$Positions_list->RowIndex = 0;
while ($Positions_list->RecordCount < $Positions_list->StopRecord) {
	$Positions_list->RecordCount++;
	if ($Positions_list->RecordCount >= $Positions_list->StartRecord) {
		$Positions_list->RowCount++;
		if ($Positions_list->isGridAdd() || $Positions_list->isGridEdit() || $Positions->isConfirm()) {
			$Positions_list->RowIndex++;
			$CurrentForm->Index = $Positions_list->RowIndex;
			if ($CurrentForm->hasValue($Positions_list->FormActionName) && ($Positions->isConfirm() || $Positions_list->EventCancelled))
				$Positions_list->RowAction = strval($CurrentForm->getValue($Positions_list->FormActionName));
			elseif ($Positions_list->isGridAdd())
				$Positions_list->RowAction = "insert";
			else
				$Positions_list->RowAction = "";
		}

		// Set up key count
		$Positions_list->KeyCount = $Positions_list->RowIndex;

		// Init row class and style
		$Positions->resetAttributes();
		$Positions->CssClass = "";
		if ($Positions_list->isGridAdd()) {
			$Positions_list->loadRowValues(); // Load default values
		} else {
			$Positions_list->loadRowValues($Positions_list->Recordset); // Load row values
		}
		$Positions->RowType = ROWTYPE_VIEW; // Render view
		if ($Positions_list->isGridAdd()) // Grid add
			$Positions->RowType = ROWTYPE_ADD; // Render add
		if ($Positions_list->isGridAdd() && $Positions->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Positions_list->restoreCurrentRowFormValues($Positions_list->RowIndex); // Restore form values
		if ($Positions_list->isEdit()) {
			if ($Positions_list->checkInlineEditKey() && $Positions_list->EditRowCount == 0) { // Inline edit
				$Positions->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($Positions_list->isGridEdit()) { // Grid edit
			if ($Positions->EventCancelled)
				$Positions_list->restoreCurrentRowFormValues($Positions_list->RowIndex); // Restore form values
			if ($Positions_list->RowAction == "insert")
				$Positions->RowType = ROWTYPE_ADD; // Render add
			else
				$Positions->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Positions_list->isEdit() && $Positions->RowType == ROWTYPE_EDIT && $Positions->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$Positions_list->restoreFormValues(); // Restore form values
		}
		if ($Positions_list->isGridEdit() && ($Positions->RowType == ROWTYPE_EDIT || $Positions->RowType == ROWTYPE_ADD) && $Positions->EventCancelled) // Update failed
			$Positions_list->restoreCurrentRowFormValues($Positions_list->RowIndex); // Restore form values
		if ($Positions->RowType == ROWTYPE_EDIT) // Edit row
			$Positions_list->EditRowCount++;

		// Set up row id / data-rowindex
		$Positions->RowAttrs->merge(["data-rowindex" => $Positions_list->RowCount, "id" => "r" . $Positions_list->RowCount . "_Positions", "data-rowtype" => $Positions->RowType]);

		// Render row
		$Positions_list->renderRow();

		// Render list options
		$Positions_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Positions_list->RowAction != "delete" && $Positions_list->RowAction != "insertdelete" && !($Positions_list->RowAction == "insert" && $Positions->isConfirm() && $Positions_list->emptyRow())) {
?>
	<tr <?php echo $Positions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Positions_list->ListOptions->render("body", "left", $Positions_list->RowCount);
?>
	<?php if ($Positions_list->Position_Idn->Visible) { // Position_Idn ?>
		<td data-name="Position_Idn" <?php echo $Positions_list->Position_Idn->cellAttributes() ?>>
<?php if ($Positions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Position_Idn" class="form-group"></span>
<input type="hidden" data-table="Positions" data-field="x_Position_Idn" name="o<?php echo $Positions_list->RowIndex ?>_Position_Idn" id="o<?php echo $Positions_list->RowIndex ?>_Position_Idn" value="<?php echo HtmlEncode($Positions_list->Position_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Positions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Position_Idn" class="form-group">
<span<?php echo $Positions_list->Position_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Positions_list->Position_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Positions" data-field="x_Position_Idn" name="x<?php echo $Positions_list->RowIndex ?>_Position_Idn" id="x<?php echo $Positions_list->RowIndex ?>_Position_Idn" value="<?php echo HtmlEncode($Positions_list->Position_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($Positions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Position_Idn">
<span<?php echo $Positions_list->Position_Idn->viewAttributes() ?>><?php echo $Positions_list->Position_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Positions_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $Positions_list->Name->cellAttributes() ?>>
<?php if ($Positions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Name" class="form-group">
<input type="text" data-table="Positions" data-field="x_Name" name="x<?php echo $Positions_list->RowIndex ?>_Name" id="x<?php echo $Positions_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Positions_list->Name->getPlaceHolder()) ?>" value="<?php echo $Positions_list->Name->EditValue ?>"<?php echo $Positions_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Positions" data-field="x_Name" name="o<?php echo $Positions_list->RowIndex ?>_Name" id="o<?php echo $Positions_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Positions_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($Positions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Name" class="form-group">
<input type="text" data-table="Positions" data-field="x_Name" name="x<?php echo $Positions_list->RowIndex ?>_Name" id="x<?php echo $Positions_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Positions_list->Name->getPlaceHolder()) ?>" value="<?php echo $Positions_list->Name->EditValue ?>"<?php echo $Positions_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Positions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Name">
<span<?php echo $Positions_list->Name->viewAttributes() ?>><?php echo $Positions_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Positions_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $Positions_list->Rank->cellAttributes() ?>>
<?php if ($Positions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Rank" class="form-group">
<input type="text" data-table="Positions" data-field="x_Rank" name="x<?php echo $Positions_list->RowIndex ?>_Rank" id="x<?php echo $Positions_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Positions_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Positions_list->Rank->EditValue ?>"<?php echo $Positions_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Positions" data-field="x_Rank" name="o<?php echo $Positions_list->RowIndex ?>_Rank" id="o<?php echo $Positions_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Positions_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($Positions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Rank" class="form-group">
<input type="text" data-table="Positions" data-field="x_Rank" name="x<?php echo $Positions_list->RowIndex ?>_Rank" id="x<?php echo $Positions_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Positions_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Positions_list->Rank->EditValue ?>"<?php echo $Positions_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Positions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_Rank">
<span<?php echo $Positions_list->Rank->viewAttributes() ?>><?php echo $Positions_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Positions_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $Positions_list->ActiveFlag->cellAttributes() ?>>
<?php if ($Positions->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Positions_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Positions" data-field="x_ActiveFlag" name="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]_972672" value="1"<?php echo $selwrk ?><?php echo $Positions_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]_972672"></label>
</div>
</span>
<input type="hidden" data-table="Positions" data-field="x_ActiveFlag" name="o<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Positions_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($Positions->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Positions_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Positions" data-field="x_ActiveFlag" name="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]_952820" value="1"<?php echo $selwrk ?><?php echo $Positions_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]_952820"></label>
</div>
</span>
<?php } ?>
<?php if ($Positions->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Positions_list->RowCount ?>_Positions_ActiveFlag">
<span<?php echo $Positions_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Positions_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Positions_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Positions_list->ListOptions->render("body", "right", $Positions_list->RowCount);
?>
	</tr>
<?php if ($Positions->RowType == ROWTYPE_ADD || $Positions->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fPositionslist", "load"], function() {
	fPositionslist.updateLists(<?php echo $Positions_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Positions_list->isGridAdd())
		if (!$Positions_list->Recordset->EOF)
			$Positions_list->Recordset->moveNext();
}
?>
<?php
	if ($Positions_list->isGridAdd() || $Positions_list->isGridEdit()) {
		$Positions_list->RowIndex = '$rowindex$';
		$Positions_list->loadRowValues();

		// Set row properties
		$Positions->resetAttributes();
		$Positions->RowAttrs->merge(["data-rowindex" => $Positions_list->RowIndex, "id" => "r0_Positions", "data-rowtype" => ROWTYPE_ADD]);
		$Positions->RowAttrs->appendClass("ew-template");
		$Positions->RowType = ROWTYPE_ADD;

		// Render row
		$Positions_list->renderRow();

		// Render list options
		$Positions_list->renderListOptions();
		$Positions_list->StartRowCount = 0;
?>
	<tr <?php echo $Positions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Positions_list->ListOptions->render("body", "left", $Positions_list->RowIndex);
?>
	<?php if ($Positions_list->Position_Idn->Visible) { // Position_Idn ?>
		<td data-name="Position_Idn">
<span id="el$rowindex$_Positions_Position_Idn" class="form-group Positions_Position_Idn"></span>
<input type="hidden" data-table="Positions" data-field="x_Position_Idn" name="o<?php echo $Positions_list->RowIndex ?>_Position_Idn" id="o<?php echo $Positions_list->RowIndex ?>_Position_Idn" value="<?php echo HtmlEncode($Positions_list->Position_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Positions_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_Positions_Name" class="form-group Positions_Name">
<input type="text" data-table="Positions" data-field="x_Name" name="x<?php echo $Positions_list->RowIndex ?>_Name" id="x<?php echo $Positions_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Positions_list->Name->getPlaceHolder()) ?>" value="<?php echo $Positions_list->Name->EditValue ?>"<?php echo $Positions_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Positions" data-field="x_Name" name="o<?php echo $Positions_list->RowIndex ?>_Name" id="o<?php echo $Positions_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Positions_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Positions_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_Positions_Rank" class="form-group Positions_Rank">
<input type="text" data-table="Positions" data-field="x_Rank" name="x<?php echo $Positions_list->RowIndex ?>_Rank" id="x<?php echo $Positions_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Positions_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Positions_list->Rank->EditValue ?>"<?php echo $Positions_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Positions" data-field="x_Rank" name="o<?php echo $Positions_list->RowIndex ?>_Rank" id="o<?php echo $Positions_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Positions_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Positions_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_Positions_ActiveFlag" class="form-group Positions_ActiveFlag">
<?php
$selwrk = ConvertToBool($Positions_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Positions" data-field="x_ActiveFlag" name="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]_801631" value="1"<?php echo $selwrk ?><?php echo $Positions_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]_801631"></label>
</div>
</span>
<input type="hidden" data-table="Positions" data-field="x_ActiveFlag" name="o<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Positions_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Positions_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Positions_list->ListOptions->render("body", "right", $Positions_list->RowIndex);
?>
<script>
loadjs.ready(["fPositionslist", "load"], function() {
	fPositionslist.updateLists(<?php echo $Positions_list->RowIndex ?>);
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
<?php if ($Positions_list->isAdd() || $Positions_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $Positions_list->FormKeyCountName ?>" id="<?php echo $Positions_list->FormKeyCountName ?>" value="<?php echo $Positions_list->KeyCount ?>">
<?php } ?>
<?php if ($Positions_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $Positions_list->FormKeyCountName ?>" id="<?php echo $Positions_list->FormKeyCountName ?>" value="<?php echo $Positions_list->KeyCount ?>">
<?php echo $Positions_list->MultiSelectKey ?>
<?php } ?>
<?php if ($Positions_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $Positions_list->FormKeyCountName ?>" id="<?php echo $Positions_list->FormKeyCountName ?>" value="<?php echo $Positions_list->KeyCount ?>">
<?php } ?>
<?php if ($Positions_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $Positions_list->FormKeyCountName ?>" id="<?php echo $Positions_list->FormKeyCountName ?>" value="<?php echo $Positions_list->KeyCount ?>">
<?php echo $Positions_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$Positions->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Positions_list->Recordset)
	$Positions_list->Recordset->Close();
?>
<?php if (!$Positions_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Positions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Positions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Positions_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Positions_list->TotalRecords == 0 && !$Positions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Positions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Positions_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Positions_list->isExport()) { ?>
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
$Positions_list->terminate();
?>