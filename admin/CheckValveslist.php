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
$CheckValves_list = new CheckValves_list();

// Run the page
$CheckValves_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CheckValves_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$CheckValves_list->isExport()) { ?>
<script>
var fCheckValveslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fCheckValveslist = currentForm = new ew.Form("fCheckValveslist", "list");
	fCheckValveslist.formKeyCountName = '<?php echo $CheckValves_list->FormKeyCountName ?>';

	// Validate form
	fCheckValveslist.validate = function() {
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
			<?php if ($CheckValves_list->CheckValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_CheckValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CheckValves_list->CheckValve_Idn->caption(), $CheckValves_list->CheckValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CheckValves_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CheckValves_list->Name->caption(), $CheckValves_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CheckValves_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CheckValves_list->Rank->caption(), $CheckValves_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($CheckValves_list->Rank->errorMessage()) ?>");
			<?php if ($CheckValves_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CheckValves_list->ActiveFlag->caption(), $CheckValves_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fCheckValveslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fCheckValveslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCheckValveslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fCheckValveslist.lists["x_ActiveFlag[]"] = <?php echo $CheckValves_list->ActiveFlag->Lookup->toClientList($CheckValves_list) ?>;
	fCheckValveslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($CheckValves_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fCheckValveslist");
});
var fCheckValveslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fCheckValveslistsrch = currentSearchForm = new ew.Form("fCheckValveslistsrch");

	// Dynamic selection lists
	// Filters

	fCheckValveslistsrch.filterList = <?php echo $CheckValves_list->getFilterList() ?>;
	loadjs.done("fCheckValveslistsrch");
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
<?php if (!$CheckValves_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($CheckValves_list->TotalRecords > 0 && $CheckValves_list->ExportOptions->visible()) { ?>
<?php $CheckValves_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($CheckValves_list->ImportOptions->visible()) { ?>
<?php $CheckValves_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($CheckValves_list->SearchOptions->visible()) { ?>
<?php $CheckValves_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($CheckValves_list->FilterOptions->visible()) { ?>
<?php $CheckValves_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$CheckValves_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$CheckValves_list->isExport() && !$CheckValves->CurrentAction) { ?>
<form name="fCheckValveslistsrch" id="fCheckValveslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fCheckValveslistsrch-search-panel" class="<?php echo $CheckValves_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="CheckValves">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $CheckValves_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($CheckValves_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($CheckValves_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $CheckValves_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($CheckValves_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($CheckValves_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($CheckValves_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($CheckValves_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $CheckValves_list->showPageHeader(); ?>
<?php
$CheckValves_list->showMessage();
?>
<?php if ($CheckValves_list->TotalRecords > 0 || $CheckValves->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($CheckValves_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> CheckValves">
<?php if (!$CheckValves_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$CheckValves_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $CheckValves_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $CheckValves_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fCheckValveslist" id="fCheckValveslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CheckValves">
<div id="gmp_CheckValves" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($CheckValves_list->TotalRecords > 0 || $CheckValves_list->isAdd() || $CheckValves_list->isCopy() || $CheckValves_list->isGridEdit()) { ?>
<table id="tbl_CheckValveslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$CheckValves->RowType = ROWTYPE_HEADER;

// Render list options
$CheckValves_list->renderListOptions();

// Render list options (header, left)
$CheckValves_list->ListOptions->render("header", "left");
?>
<?php if ($CheckValves_list->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
	<?php if ($CheckValves_list->SortUrl($CheckValves_list->CheckValve_Idn) == "") { ?>
		<th data-name="CheckValve_Idn" class="<?php echo $CheckValves_list->CheckValve_Idn->headerCellClass() ?>"><div id="elh_CheckValves_CheckValve_Idn" class="CheckValves_CheckValve_Idn"><div class="ew-table-header-caption"><?php echo $CheckValves_list->CheckValve_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CheckValve_Idn" class="<?php echo $CheckValves_list->CheckValve_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CheckValves_list->SortUrl($CheckValves_list->CheckValve_Idn) ?>', 1);"><div id="elh_CheckValves_CheckValve_Idn" class="CheckValves_CheckValve_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CheckValves_list->CheckValve_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($CheckValves_list->CheckValve_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CheckValves_list->CheckValve_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CheckValves_list->Name->Visible) { // Name ?>
	<?php if ($CheckValves_list->SortUrl($CheckValves_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $CheckValves_list->Name->headerCellClass() ?>"><div id="elh_CheckValves_Name" class="CheckValves_Name"><div class="ew-table-header-caption"><?php echo $CheckValves_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $CheckValves_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CheckValves_list->SortUrl($CheckValves_list->Name) ?>', 1);"><div id="elh_CheckValves_Name" class="CheckValves_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CheckValves_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($CheckValves_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CheckValves_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CheckValves_list->Rank->Visible) { // Rank ?>
	<?php if ($CheckValves_list->SortUrl($CheckValves_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $CheckValves_list->Rank->headerCellClass() ?>"><div id="elh_CheckValves_Rank" class="CheckValves_Rank"><div class="ew-table-header-caption"><?php echo $CheckValves_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $CheckValves_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CheckValves_list->SortUrl($CheckValves_list->Rank) ?>', 1);"><div id="elh_CheckValves_Rank" class="CheckValves_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CheckValves_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($CheckValves_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CheckValves_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CheckValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($CheckValves_list->SortUrl($CheckValves_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $CheckValves_list->ActiveFlag->headerCellClass() ?>"><div id="elh_CheckValves_ActiveFlag" class="CheckValves_ActiveFlag"><div class="ew-table-header-caption"><?php echo $CheckValves_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $CheckValves_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CheckValves_list->SortUrl($CheckValves_list->ActiveFlag) ?>', 1);"><div id="elh_CheckValves_ActiveFlag" class="CheckValves_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CheckValves_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($CheckValves_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CheckValves_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$CheckValves_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($CheckValves_list->isAdd() || $CheckValves_list->isCopy()) {
		$CheckValves_list->RowIndex = 0;
		$CheckValves_list->KeyCount = $CheckValves_list->RowIndex;
		if ($CheckValves_list->isCopy() && !$CheckValves_list->loadRow())
			$CheckValves->CurrentAction = "add";
		if ($CheckValves_list->isAdd())
			$CheckValves_list->loadRowValues();
		if ($CheckValves->EventCancelled) // Insert failed
			$CheckValves_list->restoreFormValues(); // Restore form values

		// Set row properties
		$CheckValves->resetAttributes();
		$CheckValves->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_CheckValves", "data-rowtype" => ROWTYPE_ADD]);
		$CheckValves->RowType = ROWTYPE_ADD;

		// Render row
		$CheckValves_list->renderRow();

		// Render list options
		$CheckValves_list->renderListOptions();
		$CheckValves_list->StartRowCount = 0;
?>
	<tr <?php echo $CheckValves->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CheckValves_list->ListOptions->render("body", "left", $CheckValves_list->RowCount);
?>
	<?php if ($CheckValves_list->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
		<td data-name="CheckValve_Idn">
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_CheckValve_Idn" class="form-group CheckValves_CheckValve_Idn"></span>
<input type="hidden" data-table="CheckValves" data-field="x_CheckValve_Idn" name="o<?php echo $CheckValves_list->RowIndex ?>_CheckValve_Idn" id="o<?php echo $CheckValves_list->RowIndex ?>_CheckValve_Idn" value="<?php echo HtmlEncode($CheckValves_list->CheckValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CheckValves_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_Name" class="form-group CheckValves_Name">
<input type="text" data-table="CheckValves" data-field="x_Name" name="x<?php echo $CheckValves_list->RowIndex ?>_Name" id="x<?php echo $CheckValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CheckValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $CheckValves_list->Name->EditValue ?>"<?php echo $CheckValves_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="CheckValves" data-field="x_Name" name="o<?php echo $CheckValves_list->RowIndex ?>_Name" id="o<?php echo $CheckValves_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($CheckValves_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CheckValves_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_Rank" class="form-group CheckValves_Rank">
<input type="text" data-table="CheckValves" data-field="x_Rank" name="x<?php echo $CheckValves_list->RowIndex ?>_Rank" id="x<?php echo $CheckValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CheckValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CheckValves_list->Rank->EditValue ?>"<?php echo $CheckValves_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="CheckValves" data-field="x_Rank" name="o<?php echo $CheckValves_list->RowIndex ?>_Rank" id="o<?php echo $CheckValves_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($CheckValves_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CheckValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_ActiveFlag" class="form-group CheckValves_ActiveFlag">
<?php
$selwrk = ConvertToBool($CheckValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CheckValves" data-field="x_ActiveFlag" name="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]_457498" value="1"<?php echo $selwrk ?><?php echo $CheckValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]_457498"></label>
</div>
</span>
<input type="hidden" data-table="CheckValves" data-field="x_ActiveFlag" name="o<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($CheckValves_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CheckValves_list->ListOptions->render("body", "right", $CheckValves_list->RowCount);
?>
<script>
loadjs.ready(["fCheckValveslist", "load"], function() {
	fCheckValveslist.updateLists(<?php echo $CheckValves_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($CheckValves_list->ExportAll && $CheckValves_list->isExport()) {
	$CheckValves_list->StopRecord = $CheckValves_list->TotalRecords;
} else {

	// Set the last record to display
	if ($CheckValves_list->TotalRecords > $CheckValves_list->StartRecord + $CheckValves_list->DisplayRecords - 1)
		$CheckValves_list->StopRecord = $CheckValves_list->StartRecord + $CheckValves_list->DisplayRecords - 1;
	else
		$CheckValves_list->StopRecord = $CheckValves_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($CheckValves->isConfirm() || $CheckValves_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($CheckValves_list->FormKeyCountName) && ($CheckValves_list->isGridAdd() || $CheckValves_list->isGridEdit() || $CheckValves->isConfirm())) {
		$CheckValves_list->KeyCount = $CurrentForm->getValue($CheckValves_list->FormKeyCountName);
		$CheckValves_list->StopRecord = $CheckValves_list->StartRecord + $CheckValves_list->KeyCount - 1;
	}
}
$CheckValves_list->RecordCount = $CheckValves_list->StartRecord - 1;
if ($CheckValves_list->Recordset && !$CheckValves_list->Recordset->EOF) {
	$CheckValves_list->Recordset->moveFirst();
	$selectLimit = $CheckValves_list->UseSelectLimit;
	if (!$selectLimit && $CheckValves_list->StartRecord > 1)
		$CheckValves_list->Recordset->move($CheckValves_list->StartRecord - 1);
} elseif (!$CheckValves->AllowAddDeleteRow && $CheckValves_list->StopRecord == 0) {
	$CheckValves_list->StopRecord = $CheckValves->GridAddRowCount;
}

// Initialize aggregate
$CheckValves->RowType = ROWTYPE_AGGREGATEINIT;
$CheckValves->resetAttributes();
$CheckValves_list->renderRow();
$CheckValves_list->EditRowCount = 0;
if ($CheckValves_list->isEdit())
	$CheckValves_list->RowIndex = 1;
if ($CheckValves_list->isGridAdd())
	$CheckValves_list->RowIndex = 0;
if ($CheckValves_list->isGridEdit())
	$CheckValves_list->RowIndex = 0;
while ($CheckValves_list->RecordCount < $CheckValves_list->StopRecord) {
	$CheckValves_list->RecordCount++;
	if ($CheckValves_list->RecordCount >= $CheckValves_list->StartRecord) {
		$CheckValves_list->RowCount++;
		if ($CheckValves_list->isGridAdd() || $CheckValves_list->isGridEdit() || $CheckValves->isConfirm()) {
			$CheckValves_list->RowIndex++;
			$CurrentForm->Index = $CheckValves_list->RowIndex;
			if ($CurrentForm->hasValue($CheckValves_list->FormActionName) && ($CheckValves->isConfirm() || $CheckValves_list->EventCancelled))
				$CheckValves_list->RowAction = strval($CurrentForm->getValue($CheckValves_list->FormActionName));
			elseif ($CheckValves_list->isGridAdd())
				$CheckValves_list->RowAction = "insert";
			else
				$CheckValves_list->RowAction = "";
		}

		// Set up key count
		$CheckValves_list->KeyCount = $CheckValves_list->RowIndex;

		// Init row class and style
		$CheckValves->resetAttributes();
		$CheckValves->CssClass = "";
		if ($CheckValves_list->isGridAdd()) {
			$CheckValves_list->loadRowValues(); // Load default values
		} else {
			$CheckValves_list->loadRowValues($CheckValves_list->Recordset); // Load row values
		}
		$CheckValves->RowType = ROWTYPE_VIEW; // Render view
		if ($CheckValves_list->isGridAdd()) // Grid add
			$CheckValves->RowType = ROWTYPE_ADD; // Render add
		if ($CheckValves_list->isGridAdd() && $CheckValves->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$CheckValves_list->restoreCurrentRowFormValues($CheckValves_list->RowIndex); // Restore form values
		if ($CheckValves_list->isEdit()) {
			if ($CheckValves_list->checkInlineEditKey() && $CheckValves_list->EditRowCount == 0) { // Inline edit
				$CheckValves->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($CheckValves_list->isGridEdit()) { // Grid edit
			if ($CheckValves->EventCancelled)
				$CheckValves_list->restoreCurrentRowFormValues($CheckValves_list->RowIndex); // Restore form values
			if ($CheckValves_list->RowAction == "insert")
				$CheckValves->RowType = ROWTYPE_ADD; // Render add
			else
				$CheckValves->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($CheckValves_list->isEdit() && $CheckValves->RowType == ROWTYPE_EDIT && $CheckValves->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$CheckValves_list->restoreFormValues(); // Restore form values
		}
		if ($CheckValves_list->isGridEdit() && ($CheckValves->RowType == ROWTYPE_EDIT || $CheckValves->RowType == ROWTYPE_ADD) && $CheckValves->EventCancelled) // Update failed
			$CheckValves_list->restoreCurrentRowFormValues($CheckValves_list->RowIndex); // Restore form values
		if ($CheckValves->RowType == ROWTYPE_EDIT) // Edit row
			$CheckValves_list->EditRowCount++;

		// Set up row id / data-rowindex
		$CheckValves->RowAttrs->merge(["data-rowindex" => $CheckValves_list->RowCount, "id" => "r" . $CheckValves_list->RowCount . "_CheckValves", "data-rowtype" => $CheckValves->RowType]);

		// Render row
		$CheckValves_list->renderRow();

		// Render list options
		$CheckValves_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($CheckValves_list->RowAction != "delete" && $CheckValves_list->RowAction != "insertdelete" && !($CheckValves_list->RowAction == "insert" && $CheckValves->isConfirm() && $CheckValves_list->emptyRow())) {
?>
	<tr <?php echo $CheckValves->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CheckValves_list->ListOptions->render("body", "left", $CheckValves_list->RowCount);
?>
	<?php if ($CheckValves_list->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
		<td data-name="CheckValve_Idn" <?php echo $CheckValves_list->CheckValve_Idn->cellAttributes() ?>>
<?php if ($CheckValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_CheckValve_Idn" class="form-group"></span>
<input type="hidden" data-table="CheckValves" data-field="x_CheckValve_Idn" name="o<?php echo $CheckValves_list->RowIndex ?>_CheckValve_Idn" id="o<?php echo $CheckValves_list->RowIndex ?>_CheckValve_Idn" value="<?php echo HtmlEncode($CheckValves_list->CheckValve_Idn->OldValue) ?>">
<?php } ?>
<?php if ($CheckValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_CheckValve_Idn" class="form-group">
<span<?php echo $CheckValves_list->CheckValve_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($CheckValves_list->CheckValve_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="CheckValves" data-field="x_CheckValve_Idn" name="x<?php echo $CheckValves_list->RowIndex ?>_CheckValve_Idn" id="x<?php echo $CheckValves_list->RowIndex ?>_CheckValve_Idn" value="<?php echo HtmlEncode($CheckValves_list->CheckValve_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($CheckValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_CheckValve_Idn">
<span<?php echo $CheckValves_list->CheckValve_Idn->viewAttributes() ?>><?php echo $CheckValves_list->CheckValve_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CheckValves_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $CheckValves_list->Name->cellAttributes() ?>>
<?php if ($CheckValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_Name" class="form-group">
<input type="text" data-table="CheckValves" data-field="x_Name" name="x<?php echo $CheckValves_list->RowIndex ?>_Name" id="x<?php echo $CheckValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CheckValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $CheckValves_list->Name->EditValue ?>"<?php echo $CheckValves_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="CheckValves" data-field="x_Name" name="o<?php echo $CheckValves_list->RowIndex ?>_Name" id="o<?php echo $CheckValves_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($CheckValves_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($CheckValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_Name" class="form-group">
<input type="text" data-table="CheckValves" data-field="x_Name" name="x<?php echo $CheckValves_list->RowIndex ?>_Name" id="x<?php echo $CheckValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CheckValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $CheckValves_list->Name->EditValue ?>"<?php echo $CheckValves_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($CheckValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_Name">
<span<?php echo $CheckValves_list->Name->viewAttributes() ?>><?php echo $CheckValves_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CheckValves_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $CheckValves_list->Rank->cellAttributes() ?>>
<?php if ($CheckValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_Rank" class="form-group">
<input type="text" data-table="CheckValves" data-field="x_Rank" name="x<?php echo $CheckValves_list->RowIndex ?>_Rank" id="x<?php echo $CheckValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CheckValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CheckValves_list->Rank->EditValue ?>"<?php echo $CheckValves_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="CheckValves" data-field="x_Rank" name="o<?php echo $CheckValves_list->RowIndex ?>_Rank" id="o<?php echo $CheckValves_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($CheckValves_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($CheckValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_Rank" class="form-group">
<input type="text" data-table="CheckValves" data-field="x_Rank" name="x<?php echo $CheckValves_list->RowIndex ?>_Rank" id="x<?php echo $CheckValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CheckValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CheckValves_list->Rank->EditValue ?>"<?php echo $CheckValves_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($CheckValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_Rank">
<span<?php echo $CheckValves_list->Rank->viewAttributes() ?>><?php echo $CheckValves_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CheckValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $CheckValves_list->ActiveFlag->cellAttributes() ?>>
<?php if ($CheckValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($CheckValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CheckValves" data-field="x_ActiveFlag" name="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]_961886" value="1"<?php echo $selwrk ?><?php echo $CheckValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]_961886"></label>
</div>
</span>
<input type="hidden" data-table="CheckValves" data-field="x_ActiveFlag" name="o<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($CheckValves_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($CheckValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($CheckValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CheckValves" data-field="x_ActiveFlag" name="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]_367112" value="1"<?php echo $selwrk ?><?php echo $CheckValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]_367112"></label>
</div>
</span>
<?php } ?>
<?php if ($CheckValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CheckValves_list->RowCount ?>_CheckValves_ActiveFlag">
<span<?php echo $CheckValves_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $CheckValves_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($CheckValves_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CheckValves_list->ListOptions->render("body", "right", $CheckValves_list->RowCount);
?>
	</tr>
<?php if ($CheckValves->RowType == ROWTYPE_ADD || $CheckValves->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fCheckValveslist", "load"], function() {
	fCheckValveslist.updateLists(<?php echo $CheckValves_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$CheckValves_list->isGridAdd())
		if (!$CheckValves_list->Recordset->EOF)
			$CheckValves_list->Recordset->moveNext();
}
?>
<?php
	if ($CheckValves_list->isGridAdd() || $CheckValves_list->isGridEdit()) {
		$CheckValves_list->RowIndex = '$rowindex$';
		$CheckValves_list->loadRowValues();

		// Set row properties
		$CheckValves->resetAttributes();
		$CheckValves->RowAttrs->merge(["data-rowindex" => $CheckValves_list->RowIndex, "id" => "r0_CheckValves", "data-rowtype" => ROWTYPE_ADD]);
		$CheckValves->RowAttrs->appendClass("ew-template");
		$CheckValves->RowType = ROWTYPE_ADD;

		// Render row
		$CheckValves_list->renderRow();

		// Render list options
		$CheckValves_list->renderListOptions();
		$CheckValves_list->StartRowCount = 0;
?>
	<tr <?php echo $CheckValves->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CheckValves_list->ListOptions->render("body", "left", $CheckValves_list->RowIndex);
?>
	<?php if ($CheckValves_list->CheckValve_Idn->Visible) { // CheckValve_Idn ?>
		<td data-name="CheckValve_Idn">
<span id="el$rowindex$_CheckValves_CheckValve_Idn" class="form-group CheckValves_CheckValve_Idn"></span>
<input type="hidden" data-table="CheckValves" data-field="x_CheckValve_Idn" name="o<?php echo $CheckValves_list->RowIndex ?>_CheckValve_Idn" id="o<?php echo $CheckValves_list->RowIndex ?>_CheckValve_Idn" value="<?php echo HtmlEncode($CheckValves_list->CheckValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CheckValves_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_CheckValves_Name" class="form-group CheckValves_Name">
<input type="text" data-table="CheckValves" data-field="x_Name" name="x<?php echo $CheckValves_list->RowIndex ?>_Name" id="x<?php echo $CheckValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CheckValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $CheckValves_list->Name->EditValue ?>"<?php echo $CheckValves_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="CheckValves" data-field="x_Name" name="o<?php echo $CheckValves_list->RowIndex ?>_Name" id="o<?php echo $CheckValves_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($CheckValves_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CheckValves_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_CheckValves_Rank" class="form-group CheckValves_Rank">
<input type="text" data-table="CheckValves" data-field="x_Rank" name="x<?php echo $CheckValves_list->RowIndex ?>_Rank" id="x<?php echo $CheckValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CheckValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CheckValves_list->Rank->EditValue ?>"<?php echo $CheckValves_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="CheckValves" data-field="x_Rank" name="o<?php echo $CheckValves_list->RowIndex ?>_Rank" id="o<?php echo $CheckValves_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($CheckValves_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CheckValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_CheckValves_ActiveFlag" class="form-group CheckValves_ActiveFlag">
<?php
$selwrk = ConvertToBool($CheckValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CheckValves" data-field="x_ActiveFlag" name="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]_883394" value="1"<?php echo $selwrk ?><?php echo $CheckValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]_883394"></label>
</div>
</span>
<input type="hidden" data-table="CheckValves" data-field="x_ActiveFlag" name="o<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $CheckValves_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($CheckValves_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CheckValves_list->ListOptions->render("body", "right", $CheckValves_list->RowIndex);
?>
<script>
loadjs.ready(["fCheckValveslist", "load"], function() {
	fCheckValveslist.updateLists(<?php echo $CheckValves_list->RowIndex ?>);
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
<?php if ($CheckValves_list->isAdd() || $CheckValves_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $CheckValves_list->FormKeyCountName ?>" id="<?php echo $CheckValves_list->FormKeyCountName ?>" value="<?php echo $CheckValves_list->KeyCount ?>">
<?php } ?>
<?php if ($CheckValves_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $CheckValves_list->FormKeyCountName ?>" id="<?php echo $CheckValves_list->FormKeyCountName ?>" value="<?php echo $CheckValves_list->KeyCount ?>">
<?php echo $CheckValves_list->MultiSelectKey ?>
<?php } ?>
<?php if ($CheckValves_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $CheckValves_list->FormKeyCountName ?>" id="<?php echo $CheckValves_list->FormKeyCountName ?>" value="<?php echo $CheckValves_list->KeyCount ?>">
<?php } ?>
<?php if ($CheckValves_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $CheckValves_list->FormKeyCountName ?>" id="<?php echo $CheckValves_list->FormKeyCountName ?>" value="<?php echo $CheckValves_list->KeyCount ?>">
<?php echo $CheckValves_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$CheckValves->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($CheckValves_list->Recordset)
	$CheckValves_list->Recordset->Close();
?>
<?php if (!$CheckValves_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$CheckValves_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $CheckValves_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $CheckValves_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($CheckValves_list->TotalRecords == 0 && !$CheckValves->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $CheckValves_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$CheckValves_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$CheckValves_list->isExport()) { ?>
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
$CheckValves_list->terminate();
?>