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
$JobTypes_list = new JobTypes_list();

// Run the page
$JobTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$JobTypes_list->isExport()) { ?>
<script>
var fJobTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fJobTypeslist = currentForm = new ew.Form("fJobTypeslist", "list");
	fJobTypeslist.formKeyCountName = '<?php echo $JobTypes_list->FormKeyCountName ?>';

	// Validate form
	fJobTypeslist.validate = function() {
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
			<?php if ($JobTypes_list->JobType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_JobType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobTypes_list->JobType_Idn->caption(), $JobTypes_list->JobType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobTypes_list->Name->caption(), $JobTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobTypes_list->Rank->caption(), $JobTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobTypes_list->Rank->errorMessage()) ?>");
			<?php if ($JobTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobTypes_list->ActiveFlag->caption(), $JobTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fJobTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fJobTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fJobTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fJobTypeslist.lists["x_ActiveFlag[]"] = <?php echo $JobTypes_list->ActiveFlag->Lookup->toClientList($JobTypes_list) ?>;
	fJobTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($JobTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fJobTypeslist");
});
var fJobTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fJobTypeslistsrch = currentSearchForm = new ew.Form("fJobTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fJobTypeslistsrch.filterList = <?php echo $JobTypes_list->getFilterList() ?>;
	loadjs.done("fJobTypeslistsrch");
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
<?php if (!$JobTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($JobTypes_list->TotalRecords > 0 && $JobTypes_list->ExportOptions->visible()) { ?>
<?php $JobTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($JobTypes_list->ImportOptions->visible()) { ?>
<?php $JobTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($JobTypes_list->SearchOptions->visible()) { ?>
<?php $JobTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($JobTypes_list->FilterOptions->visible()) { ?>
<?php $JobTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$JobTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$JobTypes_list->isExport() && !$JobTypes->CurrentAction) { ?>
<form name="fJobTypeslistsrch" id="fJobTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fJobTypeslistsrch-search-panel" class="<?php echo $JobTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="JobTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $JobTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($JobTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($JobTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $JobTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($JobTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($JobTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($JobTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($JobTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $JobTypes_list->showPageHeader(); ?>
<?php
$JobTypes_list->showMessage();
?>
<?php if ($JobTypes_list->TotalRecords > 0 || $JobTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($JobTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> JobTypes">
<?php if (!$JobTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$JobTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $JobTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fJobTypeslist" id="fJobTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobTypes">
<div id="gmp_JobTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($JobTypes_list->TotalRecords > 0 || $JobTypes_list->isAdd() || $JobTypes_list->isCopy() || $JobTypes_list->isGridEdit()) { ?>
<table id="tbl_JobTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$JobTypes->RowType = ROWTYPE_HEADER;

// Render list options
$JobTypes_list->renderListOptions();

// Render list options (header, left)
$JobTypes_list->ListOptions->render("header", "left");
?>
<?php if ($JobTypes_list->JobType_Idn->Visible) { // JobType_Idn ?>
	<?php if ($JobTypes_list->SortUrl($JobTypes_list->JobType_Idn) == "") { ?>
		<th data-name="JobType_Idn" class="<?php echo $JobTypes_list->JobType_Idn->headerCellClass() ?>"><div id="elh_JobTypes_JobType_Idn" class="JobTypes_JobType_Idn"><div class="ew-table-header-caption"><?php echo $JobTypes_list->JobType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobType_Idn" class="<?php echo $JobTypes_list->JobType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobTypes_list->SortUrl($JobTypes_list->JobType_Idn) ?>', 1);"><div id="elh_JobTypes_JobType_Idn" class="JobTypes_JobType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobTypes_list->JobType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobTypes_list->JobType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobTypes_list->JobType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobTypes_list->Name->Visible) { // Name ?>
	<?php if ($JobTypes_list->SortUrl($JobTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $JobTypes_list->Name->headerCellClass() ?>"><div id="elh_JobTypes_Name" class="JobTypes_Name"><div class="ew-table-header-caption"><?php echo $JobTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $JobTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobTypes_list->SortUrl($JobTypes_list->Name) ?>', 1);"><div id="elh_JobTypes_Name" class="JobTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($JobTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($JobTypes_list->SortUrl($JobTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $JobTypes_list->Rank->headerCellClass() ?>"><div id="elh_JobTypes_Rank" class="JobTypes_Rank"><div class="ew-table-header-caption"><?php echo $JobTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $JobTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobTypes_list->SortUrl($JobTypes_list->Rank) ?>', 1);"><div id="elh_JobTypes_Rank" class="JobTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($JobTypes_list->SortUrl($JobTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $JobTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_JobTypes_ActiveFlag" class="JobTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $JobTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $JobTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobTypes_list->SortUrl($JobTypes_list->ActiveFlag) ?>', 1);"><div id="elh_JobTypes_ActiveFlag" class="JobTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$JobTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($JobTypes_list->isAdd() || $JobTypes_list->isCopy()) {
		$JobTypes_list->RowIndex = 0;
		$JobTypes_list->KeyCount = $JobTypes_list->RowIndex;
		if ($JobTypes_list->isCopy() && !$JobTypes_list->loadRow())
			$JobTypes->CurrentAction = "add";
		if ($JobTypes_list->isAdd())
			$JobTypes_list->loadRowValues();
		if ($JobTypes->EventCancelled) // Insert failed
			$JobTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$JobTypes->resetAttributes();
		$JobTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_JobTypes", "data-rowtype" => ROWTYPE_ADD]);
		$JobTypes->RowType = ROWTYPE_ADD;

		// Render row
		$JobTypes_list->renderRow();

		// Render list options
		$JobTypes_list->renderListOptions();
		$JobTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $JobTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobTypes_list->ListOptions->render("body", "left", $JobTypes_list->RowCount);
?>
	<?php if ($JobTypes_list->JobType_Idn->Visible) { // JobType_Idn ?>
		<td data-name="JobType_Idn">
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_JobType_Idn" class="form-group JobTypes_JobType_Idn"></span>
<input type="hidden" data-table="JobTypes" data-field="x_JobType_Idn" name="o<?php echo $JobTypes_list->RowIndex ?>_JobType_Idn" id="o<?php echo $JobTypes_list->RowIndex ?>_JobType_Idn" value="<?php echo HtmlEncode($JobTypes_list->JobType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_Name" class="form-group JobTypes_Name">
<input type="text" data-table="JobTypes" data-field="x_Name" name="x<?php echo $JobTypes_list->RowIndex ?>_Name" id="x<?php echo $JobTypes_list->RowIndex ?>_Name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($JobTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobTypes_list->Name->EditValue ?>"<?php echo $JobTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobTypes" data-field="x_Name" name="o<?php echo $JobTypes_list->RowIndex ?>_Name" id="o<?php echo $JobTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_Rank" class="form-group JobTypes_Rank">
<input type="text" data-table="JobTypes" data-field="x_Rank" name="x<?php echo $JobTypes_list->RowIndex ?>_Rank" id="x<?php echo $JobTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobTypes_list->Rank->EditValue ?>"<?php echo $JobTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobTypes" data-field="x_Rank" name="o<?php echo $JobTypes_list->RowIndex ?>_Rank" id="o<?php echo $JobTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_ActiveFlag" class="form-group JobTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobTypes" data-field="x_ActiveFlag" name="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]_541086" value="1"<?php echo $selwrk ?><?php echo $JobTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]_541086"></label>
</div>
</span>
<input type="hidden" data-table="JobTypes" data-field="x_ActiveFlag" name="o<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobTypes_list->ListOptions->render("body", "right", $JobTypes_list->RowCount);
?>
<script>
loadjs.ready(["fJobTypeslist", "load"], function() {
	fJobTypeslist.updateLists(<?php echo $JobTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($JobTypes_list->ExportAll && $JobTypes_list->isExport()) {
	$JobTypes_list->StopRecord = $JobTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($JobTypes_list->TotalRecords > $JobTypes_list->StartRecord + $JobTypes_list->DisplayRecords - 1)
		$JobTypes_list->StopRecord = $JobTypes_list->StartRecord + $JobTypes_list->DisplayRecords - 1;
	else
		$JobTypes_list->StopRecord = $JobTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($JobTypes->isConfirm() || $JobTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($JobTypes_list->FormKeyCountName) && ($JobTypes_list->isGridAdd() || $JobTypes_list->isGridEdit() || $JobTypes->isConfirm())) {
		$JobTypes_list->KeyCount = $CurrentForm->getValue($JobTypes_list->FormKeyCountName);
		$JobTypes_list->StopRecord = $JobTypes_list->StartRecord + $JobTypes_list->KeyCount - 1;
	}
}
$JobTypes_list->RecordCount = $JobTypes_list->StartRecord - 1;
if ($JobTypes_list->Recordset && !$JobTypes_list->Recordset->EOF) {
	$JobTypes_list->Recordset->moveFirst();
	$selectLimit = $JobTypes_list->UseSelectLimit;
	if (!$selectLimit && $JobTypes_list->StartRecord > 1)
		$JobTypes_list->Recordset->move($JobTypes_list->StartRecord - 1);
} elseif (!$JobTypes->AllowAddDeleteRow && $JobTypes_list->StopRecord == 0) {
	$JobTypes_list->StopRecord = $JobTypes->GridAddRowCount;
}

// Initialize aggregate
$JobTypes->RowType = ROWTYPE_AGGREGATEINIT;
$JobTypes->resetAttributes();
$JobTypes_list->renderRow();
$JobTypes_list->EditRowCount = 0;
if ($JobTypes_list->isEdit())
	$JobTypes_list->RowIndex = 1;
if ($JobTypes_list->isGridAdd())
	$JobTypes_list->RowIndex = 0;
if ($JobTypes_list->isGridEdit())
	$JobTypes_list->RowIndex = 0;
while ($JobTypes_list->RecordCount < $JobTypes_list->StopRecord) {
	$JobTypes_list->RecordCount++;
	if ($JobTypes_list->RecordCount >= $JobTypes_list->StartRecord) {
		$JobTypes_list->RowCount++;
		if ($JobTypes_list->isGridAdd() || $JobTypes_list->isGridEdit() || $JobTypes->isConfirm()) {
			$JobTypes_list->RowIndex++;
			$CurrentForm->Index = $JobTypes_list->RowIndex;
			if ($CurrentForm->hasValue($JobTypes_list->FormActionName) && ($JobTypes->isConfirm() || $JobTypes_list->EventCancelled))
				$JobTypes_list->RowAction = strval($CurrentForm->getValue($JobTypes_list->FormActionName));
			elseif ($JobTypes_list->isGridAdd())
				$JobTypes_list->RowAction = "insert";
			else
				$JobTypes_list->RowAction = "";
		}

		// Set up key count
		$JobTypes_list->KeyCount = $JobTypes_list->RowIndex;

		// Init row class and style
		$JobTypes->resetAttributes();
		$JobTypes->CssClass = "";
		if ($JobTypes_list->isGridAdd()) {
			$JobTypes_list->loadRowValues(); // Load default values
		} else {
			$JobTypes_list->loadRowValues($JobTypes_list->Recordset); // Load row values
		}
		$JobTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($JobTypes_list->isGridAdd()) // Grid add
			$JobTypes->RowType = ROWTYPE_ADD; // Render add
		if ($JobTypes_list->isGridAdd() && $JobTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$JobTypes_list->restoreCurrentRowFormValues($JobTypes_list->RowIndex); // Restore form values
		if ($JobTypes_list->isEdit()) {
			if ($JobTypes_list->checkInlineEditKey() && $JobTypes_list->EditRowCount == 0) { // Inline edit
				$JobTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($JobTypes_list->isGridEdit()) { // Grid edit
			if ($JobTypes->EventCancelled)
				$JobTypes_list->restoreCurrentRowFormValues($JobTypes_list->RowIndex); // Restore form values
			if ($JobTypes_list->RowAction == "insert")
				$JobTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$JobTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($JobTypes_list->isEdit() && $JobTypes->RowType == ROWTYPE_EDIT && $JobTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$JobTypes_list->restoreFormValues(); // Restore form values
		}
		if ($JobTypes_list->isGridEdit() && ($JobTypes->RowType == ROWTYPE_EDIT || $JobTypes->RowType == ROWTYPE_ADD) && $JobTypes->EventCancelled) // Update failed
			$JobTypes_list->restoreCurrentRowFormValues($JobTypes_list->RowIndex); // Restore form values
		if ($JobTypes->RowType == ROWTYPE_EDIT) // Edit row
			$JobTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$JobTypes->RowAttrs->merge(["data-rowindex" => $JobTypes_list->RowCount, "id" => "r" . $JobTypes_list->RowCount . "_JobTypes", "data-rowtype" => $JobTypes->RowType]);

		// Render row
		$JobTypes_list->renderRow();

		// Render list options
		$JobTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($JobTypes_list->RowAction != "delete" && $JobTypes_list->RowAction != "insertdelete" && !($JobTypes_list->RowAction == "insert" && $JobTypes->isConfirm() && $JobTypes_list->emptyRow())) {
?>
	<tr <?php echo $JobTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobTypes_list->ListOptions->render("body", "left", $JobTypes_list->RowCount);
?>
	<?php if ($JobTypes_list->JobType_Idn->Visible) { // JobType_Idn ?>
		<td data-name="JobType_Idn" <?php echo $JobTypes_list->JobType_Idn->cellAttributes() ?>>
<?php if ($JobTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_JobType_Idn" class="form-group"></span>
<input type="hidden" data-table="JobTypes" data-field="x_JobType_Idn" name="o<?php echo $JobTypes_list->RowIndex ?>_JobType_Idn" id="o<?php echo $JobTypes_list->RowIndex ?>_JobType_Idn" value="<?php echo HtmlEncode($JobTypes_list->JobType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($JobTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_JobType_Idn" class="form-group">
<span<?php echo $JobTypes_list->JobType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($JobTypes_list->JobType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="JobTypes" data-field="x_JobType_Idn" name="x<?php echo $JobTypes_list->RowIndex ?>_JobType_Idn" id="x<?php echo $JobTypes_list->RowIndex ?>_JobType_Idn" value="<?php echo HtmlEncode($JobTypes_list->JobType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($JobTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_JobType_Idn">
<span<?php echo $JobTypes_list->JobType_Idn->viewAttributes() ?>><?php echo $JobTypes_list->JobType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $JobTypes_list->Name->cellAttributes() ?>>
<?php if ($JobTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_Name" class="form-group">
<input type="text" data-table="JobTypes" data-field="x_Name" name="x<?php echo $JobTypes_list->RowIndex ?>_Name" id="x<?php echo $JobTypes_list->RowIndex ?>_Name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($JobTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobTypes_list->Name->EditValue ?>"<?php echo $JobTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobTypes" data-field="x_Name" name="o<?php echo $JobTypes_list->RowIndex ?>_Name" id="o<?php echo $JobTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($JobTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_Name" class="form-group">
<input type="text" data-table="JobTypes" data-field="x_Name" name="x<?php echo $JobTypes_list->RowIndex ?>_Name" id="x<?php echo $JobTypes_list->RowIndex ?>_Name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($JobTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobTypes_list->Name->EditValue ?>"<?php echo $JobTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_Name">
<span<?php echo $JobTypes_list->Name->viewAttributes() ?>><?php echo $JobTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $JobTypes_list->Rank->cellAttributes() ?>>
<?php if ($JobTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_Rank" class="form-group">
<input type="text" data-table="JobTypes" data-field="x_Rank" name="x<?php echo $JobTypes_list->RowIndex ?>_Rank" id="x<?php echo $JobTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobTypes_list->Rank->EditValue ?>"<?php echo $JobTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobTypes" data-field="x_Rank" name="o<?php echo $JobTypes_list->RowIndex ?>_Rank" id="o<?php echo $JobTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($JobTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_Rank" class="form-group">
<input type="text" data-table="JobTypes" data-field="x_Rank" name="x<?php echo $JobTypes_list->RowIndex ?>_Rank" id="x<?php echo $JobTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobTypes_list->Rank->EditValue ?>"<?php echo $JobTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_Rank">
<span<?php echo $JobTypes_list->Rank->viewAttributes() ?>><?php echo $JobTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $JobTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($JobTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($JobTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobTypes" data-field="x_ActiveFlag" name="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]_585846" value="1"<?php echo $selwrk ?><?php echo $JobTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]_585846"></label>
</div>
</span>
<input type="hidden" data-table="JobTypes" data-field="x_ActiveFlag" name="o<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($JobTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($JobTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobTypes" data-field="x_ActiveFlag" name="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]_984383" value="1"<?php echo $selwrk ?><?php echo $JobTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]_984383"></label>
</div>
</span>
<?php } ?>
<?php if ($JobTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobTypes_list->RowCount ?>_JobTypes_ActiveFlag">
<span<?php echo $JobTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobTypes_list->ListOptions->render("body", "right", $JobTypes_list->RowCount);
?>
	</tr>
<?php if ($JobTypes->RowType == ROWTYPE_ADD || $JobTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fJobTypeslist", "load"], function() {
	fJobTypeslist.updateLists(<?php echo $JobTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$JobTypes_list->isGridAdd())
		if (!$JobTypes_list->Recordset->EOF)
			$JobTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($JobTypes_list->isGridAdd() || $JobTypes_list->isGridEdit()) {
		$JobTypes_list->RowIndex = '$rowindex$';
		$JobTypes_list->loadRowValues();

		// Set row properties
		$JobTypes->resetAttributes();
		$JobTypes->RowAttrs->merge(["data-rowindex" => $JobTypes_list->RowIndex, "id" => "r0_JobTypes", "data-rowtype" => ROWTYPE_ADD]);
		$JobTypes->RowAttrs->appendClass("ew-template");
		$JobTypes->RowType = ROWTYPE_ADD;

		// Render row
		$JobTypes_list->renderRow();

		// Render list options
		$JobTypes_list->renderListOptions();
		$JobTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $JobTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobTypes_list->ListOptions->render("body", "left", $JobTypes_list->RowIndex);
?>
	<?php if ($JobTypes_list->JobType_Idn->Visible) { // JobType_Idn ?>
		<td data-name="JobType_Idn">
<span id="el$rowindex$_JobTypes_JobType_Idn" class="form-group JobTypes_JobType_Idn"></span>
<input type="hidden" data-table="JobTypes" data-field="x_JobType_Idn" name="o<?php echo $JobTypes_list->RowIndex ?>_JobType_Idn" id="o<?php echo $JobTypes_list->RowIndex ?>_JobType_Idn" value="<?php echo HtmlEncode($JobTypes_list->JobType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_JobTypes_Name" class="form-group JobTypes_Name">
<input type="text" data-table="JobTypes" data-field="x_Name" name="x<?php echo $JobTypes_list->RowIndex ?>_Name" id="x<?php echo $JobTypes_list->RowIndex ?>_Name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($JobTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobTypes_list->Name->EditValue ?>"<?php echo $JobTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobTypes" data-field="x_Name" name="o<?php echo $JobTypes_list->RowIndex ?>_Name" id="o<?php echo $JobTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_JobTypes_Rank" class="form-group JobTypes_Rank">
<input type="text" data-table="JobTypes" data-field="x_Rank" name="x<?php echo $JobTypes_list->RowIndex ?>_Rank" id="x<?php echo $JobTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobTypes_list->Rank->EditValue ?>"<?php echo $JobTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobTypes" data-field="x_Rank" name="o<?php echo $JobTypes_list->RowIndex ?>_Rank" id="o<?php echo $JobTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_JobTypes_ActiveFlag" class="form-group JobTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobTypes" data-field="x_ActiveFlag" name="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]_822319" value="1"<?php echo $selwrk ?><?php echo $JobTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]_822319"></label>
</div>
</span>
<input type="hidden" data-table="JobTypes" data-field="x_ActiveFlag" name="o<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobTypes_list->ListOptions->render("body", "right", $JobTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fJobTypeslist", "load"], function() {
	fJobTypeslist.updateLists(<?php echo $JobTypes_list->RowIndex ?>);
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
<?php if ($JobTypes_list->isAdd() || $JobTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $JobTypes_list->FormKeyCountName ?>" id="<?php echo $JobTypes_list->FormKeyCountName ?>" value="<?php echo $JobTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($JobTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $JobTypes_list->FormKeyCountName ?>" id="<?php echo $JobTypes_list->FormKeyCountName ?>" value="<?php echo $JobTypes_list->KeyCount ?>">
<?php echo $JobTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($JobTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $JobTypes_list->FormKeyCountName ?>" id="<?php echo $JobTypes_list->FormKeyCountName ?>" value="<?php echo $JobTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($JobTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $JobTypes_list->FormKeyCountName ?>" id="<?php echo $JobTypes_list->FormKeyCountName ?>" value="<?php echo $JobTypes_list->KeyCount ?>">
<?php echo $JobTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$JobTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($JobTypes_list->Recordset)
	$JobTypes_list->Recordset->Close();
?>
<?php if (!$JobTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$JobTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $JobTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($JobTypes_list->TotalRecords == 0 && !$JobTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $JobTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$JobTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$JobTypes_list->isExport()) { ?>
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
$JobTypes_list->terminate();
?>