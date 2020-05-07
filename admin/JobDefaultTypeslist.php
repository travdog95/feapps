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
$JobDefaultTypes_list = new JobDefaultTypes_list();

// Run the page
$JobDefaultTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobDefaultTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$JobDefaultTypes_list->isExport()) { ?>
<script>
var fJobDefaultTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fJobDefaultTypeslist = currentForm = new ew.Form("fJobDefaultTypeslist", "list");
	fJobDefaultTypeslist.formKeyCountName = '<?php echo $JobDefaultTypes_list->FormKeyCountName ?>';

	// Validate form
	fJobDefaultTypeslist.validate = function() {
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
			<?php if ($JobDefaultTypes_list->JobDefaultType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_JobDefaultType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaultTypes_list->JobDefaultType_Idn->caption(), $JobDefaultTypes_list->JobDefaultType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaultTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaultTypes_list->Name->caption(), $JobDefaultTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaultTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaultTypes_list->Rank->caption(), $JobDefaultTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobDefaultTypes_list->Rank->errorMessage()) ?>");
			<?php if ($JobDefaultTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaultTypes_list->ActiveFlag->caption(), $JobDefaultTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fJobDefaultTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fJobDefaultTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fJobDefaultTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fJobDefaultTypeslist.lists["x_ActiveFlag[]"] = <?php echo $JobDefaultTypes_list->ActiveFlag->Lookup->toClientList($JobDefaultTypes_list) ?>;
	fJobDefaultTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($JobDefaultTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fJobDefaultTypeslist");
});
var fJobDefaultTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fJobDefaultTypeslistsrch = currentSearchForm = new ew.Form("fJobDefaultTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fJobDefaultTypeslistsrch.filterList = <?php echo $JobDefaultTypes_list->getFilterList() ?>;
	loadjs.done("fJobDefaultTypeslistsrch");
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
<?php if (!$JobDefaultTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($JobDefaultTypes_list->TotalRecords > 0 && $JobDefaultTypes_list->ExportOptions->visible()) { ?>
<?php $JobDefaultTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($JobDefaultTypes_list->ImportOptions->visible()) { ?>
<?php $JobDefaultTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($JobDefaultTypes_list->SearchOptions->visible()) { ?>
<?php $JobDefaultTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($JobDefaultTypes_list->FilterOptions->visible()) { ?>
<?php $JobDefaultTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$JobDefaultTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$JobDefaultTypes_list->isExport() && !$JobDefaultTypes->CurrentAction) { ?>
<form name="fJobDefaultTypeslistsrch" id="fJobDefaultTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fJobDefaultTypeslistsrch-search-panel" class="<?php echo $JobDefaultTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="JobDefaultTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $JobDefaultTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($JobDefaultTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($JobDefaultTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $JobDefaultTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($JobDefaultTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($JobDefaultTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($JobDefaultTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($JobDefaultTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $JobDefaultTypes_list->showPageHeader(); ?>
<?php
$JobDefaultTypes_list->showMessage();
?>
<?php if ($JobDefaultTypes_list->TotalRecords > 0 || $JobDefaultTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($JobDefaultTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> JobDefaultTypes">
<?php if (!$JobDefaultTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$JobDefaultTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobDefaultTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $JobDefaultTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fJobDefaultTypeslist" id="fJobDefaultTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobDefaultTypes">
<div id="gmp_JobDefaultTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($JobDefaultTypes_list->TotalRecords > 0 || $JobDefaultTypes_list->isAdd() || $JobDefaultTypes_list->isCopy() || $JobDefaultTypes_list->isGridEdit()) { ?>
<table id="tbl_JobDefaultTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$JobDefaultTypes->RowType = ROWTYPE_HEADER;

// Render list options
$JobDefaultTypes_list->renderListOptions();

// Render list options (header, left)
$JobDefaultTypes_list->ListOptions->render("header", "left");
?>
<?php if ($JobDefaultTypes_list->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
	<?php if ($JobDefaultTypes_list->SortUrl($JobDefaultTypes_list->JobDefaultType_Idn) == "") { ?>
		<th data-name="JobDefaultType_Idn" class="<?php echo $JobDefaultTypes_list->JobDefaultType_Idn->headerCellClass() ?>"><div id="elh_JobDefaultTypes_JobDefaultType_Idn" class="JobDefaultTypes_JobDefaultType_Idn"><div class="ew-table-header-caption"><?php echo $JobDefaultTypes_list->JobDefaultType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobDefaultType_Idn" class="<?php echo $JobDefaultTypes_list->JobDefaultType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaultTypes_list->SortUrl($JobDefaultTypes_list->JobDefaultType_Idn) ?>', 1);"><div id="elh_JobDefaultTypes_JobDefaultType_Idn" class="JobDefaultTypes_JobDefaultType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaultTypes_list->JobDefaultType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobDefaultTypes_list->JobDefaultType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaultTypes_list->JobDefaultType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaultTypes_list->Name->Visible) { // Name ?>
	<?php if ($JobDefaultTypes_list->SortUrl($JobDefaultTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $JobDefaultTypes_list->Name->headerCellClass() ?>"><div id="elh_JobDefaultTypes_Name" class="JobDefaultTypes_Name"><div class="ew-table-header-caption"><?php echo $JobDefaultTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $JobDefaultTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaultTypes_list->SortUrl($JobDefaultTypes_list->Name) ?>', 1);"><div id="elh_JobDefaultTypes_Name" class="JobDefaultTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaultTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($JobDefaultTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaultTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaultTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($JobDefaultTypes_list->SortUrl($JobDefaultTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $JobDefaultTypes_list->Rank->headerCellClass() ?>"><div id="elh_JobDefaultTypes_Rank" class="JobDefaultTypes_Rank"><div class="ew-table-header-caption"><?php echo $JobDefaultTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $JobDefaultTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaultTypes_list->SortUrl($JobDefaultTypes_list->Rank) ?>', 1);"><div id="elh_JobDefaultTypes_Rank" class="JobDefaultTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaultTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobDefaultTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaultTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaultTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($JobDefaultTypes_list->SortUrl($JobDefaultTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $JobDefaultTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_JobDefaultTypes_ActiveFlag" class="JobDefaultTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $JobDefaultTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $JobDefaultTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaultTypes_list->SortUrl($JobDefaultTypes_list->ActiveFlag) ?>', 1);"><div id="elh_JobDefaultTypes_ActiveFlag" class="JobDefaultTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaultTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobDefaultTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaultTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$JobDefaultTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($JobDefaultTypes_list->isAdd() || $JobDefaultTypes_list->isCopy()) {
		$JobDefaultTypes_list->RowIndex = 0;
		$JobDefaultTypes_list->KeyCount = $JobDefaultTypes_list->RowIndex;
		if ($JobDefaultTypes_list->isCopy() && !$JobDefaultTypes_list->loadRow())
			$JobDefaultTypes->CurrentAction = "add";
		if ($JobDefaultTypes_list->isAdd())
			$JobDefaultTypes_list->loadRowValues();
		if ($JobDefaultTypes->EventCancelled) // Insert failed
			$JobDefaultTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$JobDefaultTypes->resetAttributes();
		$JobDefaultTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_JobDefaultTypes", "data-rowtype" => ROWTYPE_ADD]);
		$JobDefaultTypes->RowType = ROWTYPE_ADD;

		// Render row
		$JobDefaultTypes_list->renderRow();

		// Render list options
		$JobDefaultTypes_list->renderListOptions();
		$JobDefaultTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $JobDefaultTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobDefaultTypes_list->ListOptions->render("body", "left", $JobDefaultTypes_list->RowCount);
?>
	<?php if ($JobDefaultTypes_list->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
		<td data-name="JobDefaultType_Idn">
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_JobDefaultType_Idn" class="form-group JobDefaultTypes_JobDefaultType_Idn"></span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_JobDefaultType_Idn" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_JobDefaultType_Idn" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_JobDefaultType_Idn" value="<?php echo HtmlEncode($JobDefaultTypes_list->JobDefaultType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaultTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_Name" class="form-group JobDefaultTypes_Name">
<input type="text" data-table="JobDefaultTypes" data-field="x_Name" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobDefaultTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobDefaultTypes_list->Name->EditValue ?>"<?php echo $JobDefaultTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_Name" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobDefaultTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaultTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_Rank" class="form-group JobDefaultTypes_Rank">
<input type="text" data-table="JobDefaultTypes" data-field="x_Rank" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaultTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobDefaultTypes_list->Rank->EditValue ?>"<?php echo $JobDefaultTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_Rank" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobDefaultTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaultTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_ActiveFlag" class="form-group JobDefaultTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobDefaultTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobDefaultTypes" data-field="x_ActiveFlag" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]_551593" value="1"<?php echo $selwrk ?><?php echo $JobDefaultTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]_551593"></label>
</div>
</span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_ActiveFlag" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobDefaultTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobDefaultTypes_list->ListOptions->render("body", "right", $JobDefaultTypes_list->RowCount);
?>
<script>
loadjs.ready(["fJobDefaultTypeslist", "load"], function() {
	fJobDefaultTypeslist.updateLists(<?php echo $JobDefaultTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($JobDefaultTypes_list->ExportAll && $JobDefaultTypes_list->isExport()) {
	$JobDefaultTypes_list->StopRecord = $JobDefaultTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($JobDefaultTypes_list->TotalRecords > $JobDefaultTypes_list->StartRecord + $JobDefaultTypes_list->DisplayRecords - 1)
		$JobDefaultTypes_list->StopRecord = $JobDefaultTypes_list->StartRecord + $JobDefaultTypes_list->DisplayRecords - 1;
	else
		$JobDefaultTypes_list->StopRecord = $JobDefaultTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($JobDefaultTypes->isConfirm() || $JobDefaultTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($JobDefaultTypes_list->FormKeyCountName) && ($JobDefaultTypes_list->isGridAdd() || $JobDefaultTypes_list->isGridEdit() || $JobDefaultTypes->isConfirm())) {
		$JobDefaultTypes_list->KeyCount = $CurrentForm->getValue($JobDefaultTypes_list->FormKeyCountName);
		$JobDefaultTypes_list->StopRecord = $JobDefaultTypes_list->StartRecord + $JobDefaultTypes_list->KeyCount - 1;
	}
}
$JobDefaultTypes_list->RecordCount = $JobDefaultTypes_list->StartRecord - 1;
if ($JobDefaultTypes_list->Recordset && !$JobDefaultTypes_list->Recordset->EOF) {
	$JobDefaultTypes_list->Recordset->moveFirst();
	$selectLimit = $JobDefaultTypes_list->UseSelectLimit;
	if (!$selectLimit && $JobDefaultTypes_list->StartRecord > 1)
		$JobDefaultTypes_list->Recordset->move($JobDefaultTypes_list->StartRecord - 1);
} elseif (!$JobDefaultTypes->AllowAddDeleteRow && $JobDefaultTypes_list->StopRecord == 0) {
	$JobDefaultTypes_list->StopRecord = $JobDefaultTypes->GridAddRowCount;
}

// Initialize aggregate
$JobDefaultTypes->RowType = ROWTYPE_AGGREGATEINIT;
$JobDefaultTypes->resetAttributes();
$JobDefaultTypes_list->renderRow();
$JobDefaultTypes_list->EditRowCount = 0;
if ($JobDefaultTypes_list->isEdit())
	$JobDefaultTypes_list->RowIndex = 1;
if ($JobDefaultTypes_list->isGridAdd())
	$JobDefaultTypes_list->RowIndex = 0;
if ($JobDefaultTypes_list->isGridEdit())
	$JobDefaultTypes_list->RowIndex = 0;
while ($JobDefaultTypes_list->RecordCount < $JobDefaultTypes_list->StopRecord) {
	$JobDefaultTypes_list->RecordCount++;
	if ($JobDefaultTypes_list->RecordCount >= $JobDefaultTypes_list->StartRecord) {
		$JobDefaultTypes_list->RowCount++;
		if ($JobDefaultTypes_list->isGridAdd() || $JobDefaultTypes_list->isGridEdit() || $JobDefaultTypes->isConfirm()) {
			$JobDefaultTypes_list->RowIndex++;
			$CurrentForm->Index = $JobDefaultTypes_list->RowIndex;
			if ($CurrentForm->hasValue($JobDefaultTypes_list->FormActionName) && ($JobDefaultTypes->isConfirm() || $JobDefaultTypes_list->EventCancelled))
				$JobDefaultTypes_list->RowAction = strval($CurrentForm->getValue($JobDefaultTypes_list->FormActionName));
			elseif ($JobDefaultTypes_list->isGridAdd())
				$JobDefaultTypes_list->RowAction = "insert";
			else
				$JobDefaultTypes_list->RowAction = "";
		}

		// Set up key count
		$JobDefaultTypes_list->KeyCount = $JobDefaultTypes_list->RowIndex;

		// Init row class and style
		$JobDefaultTypes->resetAttributes();
		$JobDefaultTypes->CssClass = "";
		if ($JobDefaultTypes_list->isGridAdd()) {
			$JobDefaultTypes_list->loadRowValues(); // Load default values
		} else {
			$JobDefaultTypes_list->loadRowValues($JobDefaultTypes_list->Recordset); // Load row values
		}
		$JobDefaultTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($JobDefaultTypes_list->isGridAdd()) // Grid add
			$JobDefaultTypes->RowType = ROWTYPE_ADD; // Render add
		if ($JobDefaultTypes_list->isGridAdd() && $JobDefaultTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$JobDefaultTypes_list->restoreCurrentRowFormValues($JobDefaultTypes_list->RowIndex); // Restore form values
		if ($JobDefaultTypes_list->isEdit()) {
			if ($JobDefaultTypes_list->checkInlineEditKey() && $JobDefaultTypes_list->EditRowCount == 0) { // Inline edit
				$JobDefaultTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($JobDefaultTypes_list->isGridEdit()) { // Grid edit
			if ($JobDefaultTypes->EventCancelled)
				$JobDefaultTypes_list->restoreCurrentRowFormValues($JobDefaultTypes_list->RowIndex); // Restore form values
			if ($JobDefaultTypes_list->RowAction == "insert")
				$JobDefaultTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$JobDefaultTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($JobDefaultTypes_list->isEdit() && $JobDefaultTypes->RowType == ROWTYPE_EDIT && $JobDefaultTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$JobDefaultTypes_list->restoreFormValues(); // Restore form values
		}
		if ($JobDefaultTypes_list->isGridEdit() && ($JobDefaultTypes->RowType == ROWTYPE_EDIT || $JobDefaultTypes->RowType == ROWTYPE_ADD) && $JobDefaultTypes->EventCancelled) // Update failed
			$JobDefaultTypes_list->restoreCurrentRowFormValues($JobDefaultTypes_list->RowIndex); // Restore form values
		if ($JobDefaultTypes->RowType == ROWTYPE_EDIT) // Edit row
			$JobDefaultTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$JobDefaultTypes->RowAttrs->merge(["data-rowindex" => $JobDefaultTypes_list->RowCount, "id" => "r" . $JobDefaultTypes_list->RowCount . "_JobDefaultTypes", "data-rowtype" => $JobDefaultTypes->RowType]);

		// Render row
		$JobDefaultTypes_list->renderRow();

		// Render list options
		$JobDefaultTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($JobDefaultTypes_list->RowAction != "delete" && $JobDefaultTypes_list->RowAction != "insertdelete" && !($JobDefaultTypes_list->RowAction == "insert" && $JobDefaultTypes->isConfirm() && $JobDefaultTypes_list->emptyRow())) {
?>
	<tr <?php echo $JobDefaultTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobDefaultTypes_list->ListOptions->render("body", "left", $JobDefaultTypes_list->RowCount);
?>
	<?php if ($JobDefaultTypes_list->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
		<td data-name="JobDefaultType_Idn" <?php echo $JobDefaultTypes_list->JobDefaultType_Idn->cellAttributes() ?>>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_JobDefaultType_Idn" class="form-group"></span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_JobDefaultType_Idn" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_JobDefaultType_Idn" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_JobDefaultType_Idn" value="<?php echo HtmlEncode($JobDefaultTypes_list->JobDefaultType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_JobDefaultType_Idn" class="form-group">
<span<?php echo $JobDefaultTypes_list->JobDefaultType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($JobDefaultTypes_list->JobDefaultType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_JobDefaultType_Idn" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_JobDefaultType_Idn" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_JobDefaultType_Idn" value="<?php echo HtmlEncode($JobDefaultTypes_list->JobDefaultType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_JobDefaultType_Idn">
<span<?php echo $JobDefaultTypes_list->JobDefaultType_Idn->viewAttributes() ?>><?php echo $JobDefaultTypes_list->JobDefaultType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaultTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $JobDefaultTypes_list->Name->cellAttributes() ?>>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_Name" class="form-group">
<input type="text" data-table="JobDefaultTypes" data-field="x_Name" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobDefaultTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobDefaultTypes_list->Name->EditValue ?>"<?php echo $JobDefaultTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_Name" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobDefaultTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_Name" class="form-group">
<input type="text" data-table="JobDefaultTypes" data-field="x_Name" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobDefaultTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobDefaultTypes_list->Name->EditValue ?>"<?php echo $JobDefaultTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_Name">
<span<?php echo $JobDefaultTypes_list->Name->viewAttributes() ?>><?php echo $JobDefaultTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaultTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $JobDefaultTypes_list->Rank->cellAttributes() ?>>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_Rank" class="form-group">
<input type="text" data-table="JobDefaultTypes" data-field="x_Rank" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaultTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobDefaultTypes_list->Rank->EditValue ?>"<?php echo $JobDefaultTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_Rank" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobDefaultTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_Rank" class="form-group">
<input type="text" data-table="JobDefaultTypes" data-field="x_Rank" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaultTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobDefaultTypes_list->Rank->EditValue ?>"<?php echo $JobDefaultTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_Rank">
<span<?php echo $JobDefaultTypes_list->Rank->viewAttributes() ?>><?php echo $JobDefaultTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaultTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $JobDefaultTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($JobDefaultTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobDefaultTypes" data-field="x_ActiveFlag" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]_559447" value="1"<?php echo $selwrk ?><?php echo $JobDefaultTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]_559447"></label>
</div>
</span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_ActiveFlag" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobDefaultTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($JobDefaultTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobDefaultTypes" data-field="x_ActiveFlag" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]_144259" value="1"<?php echo $selwrk ?><?php echo $JobDefaultTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]_144259"></label>
</div>
</span>
<?php } ?>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaultTypes_list->RowCount ?>_JobDefaultTypes_ActiveFlag">
<span<?php echo $JobDefaultTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobDefaultTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobDefaultTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobDefaultTypes_list->ListOptions->render("body", "right", $JobDefaultTypes_list->RowCount);
?>
	</tr>
<?php if ($JobDefaultTypes->RowType == ROWTYPE_ADD || $JobDefaultTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fJobDefaultTypeslist", "load"], function() {
	fJobDefaultTypeslist.updateLists(<?php echo $JobDefaultTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$JobDefaultTypes_list->isGridAdd())
		if (!$JobDefaultTypes_list->Recordset->EOF)
			$JobDefaultTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($JobDefaultTypes_list->isGridAdd() || $JobDefaultTypes_list->isGridEdit()) {
		$JobDefaultTypes_list->RowIndex = '$rowindex$';
		$JobDefaultTypes_list->loadRowValues();

		// Set row properties
		$JobDefaultTypes->resetAttributes();
		$JobDefaultTypes->RowAttrs->merge(["data-rowindex" => $JobDefaultTypes_list->RowIndex, "id" => "r0_JobDefaultTypes", "data-rowtype" => ROWTYPE_ADD]);
		$JobDefaultTypes->RowAttrs->appendClass("ew-template");
		$JobDefaultTypes->RowType = ROWTYPE_ADD;

		// Render row
		$JobDefaultTypes_list->renderRow();

		// Render list options
		$JobDefaultTypes_list->renderListOptions();
		$JobDefaultTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $JobDefaultTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobDefaultTypes_list->ListOptions->render("body", "left", $JobDefaultTypes_list->RowIndex);
?>
	<?php if ($JobDefaultTypes_list->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
		<td data-name="JobDefaultType_Idn">
<span id="el$rowindex$_JobDefaultTypes_JobDefaultType_Idn" class="form-group JobDefaultTypes_JobDefaultType_Idn"></span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_JobDefaultType_Idn" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_JobDefaultType_Idn" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_JobDefaultType_Idn" value="<?php echo HtmlEncode($JobDefaultTypes_list->JobDefaultType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaultTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_JobDefaultTypes_Name" class="form-group JobDefaultTypes_Name">
<input type="text" data-table="JobDefaultTypes" data-field="x_Name" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobDefaultTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobDefaultTypes_list->Name->EditValue ?>"<?php echo $JobDefaultTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_Name" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobDefaultTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaultTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_JobDefaultTypes_Rank" class="form-group JobDefaultTypes_Rank">
<input type="text" data-table="JobDefaultTypes" data-field="x_Rank" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaultTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobDefaultTypes_list->Rank->EditValue ?>"<?php echo $JobDefaultTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_Rank" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobDefaultTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaultTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_JobDefaultTypes_ActiveFlag" class="form-group JobDefaultTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobDefaultTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobDefaultTypes" data-field="x_ActiveFlag" name="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]_435944" value="1"<?php echo $selwrk ?><?php echo $JobDefaultTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]_435944"></label>
</div>
</span>
<input type="hidden" data-table="JobDefaultTypes" data-field="x_ActiveFlag" name="o<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobDefaultTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobDefaultTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobDefaultTypes_list->ListOptions->render("body", "right", $JobDefaultTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fJobDefaultTypeslist", "load"], function() {
	fJobDefaultTypeslist.updateLists(<?php echo $JobDefaultTypes_list->RowIndex ?>);
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
<?php if ($JobDefaultTypes_list->isAdd() || $JobDefaultTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $JobDefaultTypes_list->FormKeyCountName ?>" id="<?php echo $JobDefaultTypes_list->FormKeyCountName ?>" value="<?php echo $JobDefaultTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($JobDefaultTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $JobDefaultTypes_list->FormKeyCountName ?>" id="<?php echo $JobDefaultTypes_list->FormKeyCountName ?>" value="<?php echo $JobDefaultTypes_list->KeyCount ?>">
<?php echo $JobDefaultTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($JobDefaultTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $JobDefaultTypes_list->FormKeyCountName ?>" id="<?php echo $JobDefaultTypes_list->FormKeyCountName ?>" value="<?php echo $JobDefaultTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($JobDefaultTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $JobDefaultTypes_list->FormKeyCountName ?>" id="<?php echo $JobDefaultTypes_list->FormKeyCountName ?>" value="<?php echo $JobDefaultTypes_list->KeyCount ?>">
<?php echo $JobDefaultTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$JobDefaultTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($JobDefaultTypes_list->Recordset)
	$JobDefaultTypes_list->Recordset->Close();
?>
<?php if (!$JobDefaultTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$JobDefaultTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobDefaultTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $JobDefaultTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($JobDefaultTypes_list->TotalRecords == 0 && !$JobDefaultTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $JobDefaultTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$JobDefaultTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$JobDefaultTypes_list->isExport()) { ?>
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
$JobDefaultTypes_list->terminate();
?>