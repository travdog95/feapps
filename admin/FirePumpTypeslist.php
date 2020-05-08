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
$FirePumpTypes_list = new FirePumpTypes_list();

// Run the page
$FirePumpTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FirePumpTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$FirePumpTypes_list->isExport()) { ?>
<script>
var fFirePumpTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fFirePumpTypeslist = currentForm = new ew.Form("fFirePumpTypeslist", "list");
	fFirePumpTypeslist.formKeyCountName = '<?php echo $FirePumpTypes_list->FormKeyCountName ?>';

	// Validate form
	fFirePumpTypeslist.validate = function() {
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
			<?php if ($FirePumpTypes_list->FirePumpType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FirePumpType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpTypes_list->FirePumpType_Idn->caption(), $FirePumpTypes_list->FirePumpType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FirePumpTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpTypes_list->Name->caption(), $FirePumpTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FirePumpTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpTypes_list->Rank->caption(), $FirePumpTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($FirePumpTypes_list->Rank->errorMessage()) ?>");
			<?php if ($FirePumpTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpTypes_list->ActiveFlag->caption(), $FirePumpTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fFirePumpTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fFirePumpTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fFirePumpTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fFirePumpTypeslist.lists["x_ActiveFlag[]"] = <?php echo $FirePumpTypes_list->ActiveFlag->Lookup->toClientList($FirePumpTypes_list) ?>;
	fFirePumpTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($FirePumpTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fFirePumpTypeslist");
});
var fFirePumpTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fFirePumpTypeslistsrch = currentSearchForm = new ew.Form("fFirePumpTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fFirePumpTypeslistsrch.filterList = <?php echo $FirePumpTypes_list->getFilterList() ?>;
	loadjs.done("fFirePumpTypeslistsrch");
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
<?php if (!$FirePumpTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($FirePumpTypes_list->TotalRecords > 0 && $FirePumpTypes_list->ExportOptions->visible()) { ?>
<?php $FirePumpTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($FirePumpTypes_list->ImportOptions->visible()) { ?>
<?php $FirePumpTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($FirePumpTypes_list->SearchOptions->visible()) { ?>
<?php $FirePumpTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($FirePumpTypes_list->FilterOptions->visible()) { ?>
<?php $FirePumpTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$FirePumpTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$FirePumpTypes_list->isExport() && !$FirePumpTypes->CurrentAction) { ?>
<form name="fFirePumpTypeslistsrch" id="fFirePumpTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fFirePumpTypeslistsrch-search-panel" class="<?php echo $FirePumpTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="FirePumpTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $FirePumpTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($FirePumpTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($FirePumpTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $FirePumpTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($FirePumpTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($FirePumpTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($FirePumpTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($FirePumpTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $FirePumpTypes_list->showPageHeader(); ?>
<?php
$FirePumpTypes_list->showMessage();
?>
<?php if ($FirePumpTypes_list->TotalRecords > 0 || $FirePumpTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($FirePumpTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> FirePumpTypes">
<?php if (!$FirePumpTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$FirePumpTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FirePumpTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $FirePumpTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fFirePumpTypeslist" id="fFirePumpTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FirePumpTypes">
<div id="gmp_FirePumpTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($FirePumpTypes_list->TotalRecords > 0 || $FirePumpTypes_list->isAdd() || $FirePumpTypes_list->isCopy() || $FirePumpTypes_list->isGridEdit()) { ?>
<table id="tbl_FirePumpTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$FirePumpTypes->RowType = ROWTYPE_HEADER;

// Render list options
$FirePumpTypes_list->renderListOptions();

// Render list options (header, left)
$FirePumpTypes_list->ListOptions->render("header", "left");
?>
<?php if ($FirePumpTypes_list->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
	<?php if ($FirePumpTypes_list->SortUrl($FirePumpTypes_list->FirePumpType_Idn) == "") { ?>
		<th data-name="FirePumpType_Idn" class="<?php echo $FirePumpTypes_list->FirePumpType_Idn->headerCellClass() ?>"><div id="elh_FirePumpTypes_FirePumpType_Idn" class="FirePumpTypes_FirePumpType_Idn"><div class="ew-table-header-caption"><?php echo $FirePumpTypes_list->FirePumpType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirePumpType_Idn" class="<?php echo $FirePumpTypes_list->FirePumpType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FirePumpTypes_list->SortUrl($FirePumpTypes_list->FirePumpType_Idn) ?>', 1);"><div id="elh_FirePumpTypes_FirePumpType_Idn" class="FirePumpTypes_FirePumpType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FirePumpTypes_list->FirePumpType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($FirePumpTypes_list->FirePumpType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FirePumpTypes_list->FirePumpType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FirePumpTypes_list->Name->Visible) { // Name ?>
	<?php if ($FirePumpTypes_list->SortUrl($FirePumpTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $FirePumpTypes_list->Name->headerCellClass() ?>"><div id="elh_FirePumpTypes_Name" class="FirePumpTypes_Name"><div class="ew-table-header-caption"><?php echo $FirePumpTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $FirePumpTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FirePumpTypes_list->SortUrl($FirePumpTypes_list->Name) ?>', 1);"><div id="elh_FirePumpTypes_Name" class="FirePumpTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FirePumpTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($FirePumpTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FirePumpTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FirePumpTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($FirePumpTypes_list->SortUrl($FirePumpTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $FirePumpTypes_list->Rank->headerCellClass() ?>"><div id="elh_FirePumpTypes_Rank" class="FirePumpTypes_Rank"><div class="ew-table-header-caption"><?php echo $FirePumpTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $FirePumpTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FirePumpTypes_list->SortUrl($FirePumpTypes_list->Rank) ?>', 1);"><div id="elh_FirePumpTypes_Rank" class="FirePumpTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FirePumpTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($FirePumpTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FirePumpTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FirePumpTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($FirePumpTypes_list->SortUrl($FirePumpTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $FirePumpTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_FirePumpTypes_ActiveFlag" class="FirePumpTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $FirePumpTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $FirePumpTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FirePumpTypes_list->SortUrl($FirePumpTypes_list->ActiveFlag) ?>', 1);"><div id="elh_FirePumpTypes_ActiveFlag" class="FirePumpTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FirePumpTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($FirePumpTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FirePumpTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$FirePumpTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($FirePumpTypes_list->isAdd() || $FirePumpTypes_list->isCopy()) {
		$FirePumpTypes_list->RowIndex = 0;
		$FirePumpTypes_list->KeyCount = $FirePumpTypes_list->RowIndex;
		if ($FirePumpTypes_list->isCopy() && !$FirePumpTypes_list->loadRow())
			$FirePumpTypes->CurrentAction = "add";
		if ($FirePumpTypes_list->isAdd())
			$FirePumpTypes_list->loadRowValues();
		if ($FirePumpTypes->EventCancelled) // Insert failed
			$FirePumpTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$FirePumpTypes->resetAttributes();
		$FirePumpTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_FirePumpTypes", "data-rowtype" => ROWTYPE_ADD]);
		$FirePumpTypes->RowType = ROWTYPE_ADD;

		// Render row
		$FirePumpTypes_list->renderRow();

		// Render list options
		$FirePumpTypes_list->renderListOptions();
		$FirePumpTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $FirePumpTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FirePumpTypes_list->ListOptions->render("body", "left", $FirePumpTypes_list->RowCount);
?>
	<?php if ($FirePumpTypes_list->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
		<td data-name="FirePumpType_Idn">
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_FirePumpType_Idn" class="form-group FirePumpTypes_FirePumpType_Idn"></span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_FirePumpType_Idn" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_FirePumpType_Idn" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_FirePumpType_Idn" value="<?php echo HtmlEncode($FirePumpTypes_list->FirePumpType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_Name" class="form-group FirePumpTypes_Name">
<input type="text" data-table="FirePumpTypes" data-field="x_Name" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_Name" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FirePumpTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FirePumpTypes_list->Name->EditValue ?>"<?php echo $FirePumpTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_Name" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_Name" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FirePumpTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_Rank" class="form-group FirePumpTypes_Rank">
<input type="text" data-table="FirePumpTypes" data-field="x_Rank" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FirePumpTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FirePumpTypes_list->Rank->EditValue ?>"<?php echo $FirePumpTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_Rank" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FirePumpTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_ActiveFlag" class="form-group FirePumpTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($FirePumpTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpTypes" data-field="x_ActiveFlag" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]_437679" value="1"<?php echo $selwrk ?><?php echo $FirePumpTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]_437679"></label>
</div>
</span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_ActiveFlag" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FirePumpTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FirePumpTypes_list->ListOptions->render("body", "right", $FirePumpTypes_list->RowCount);
?>
<script>
loadjs.ready(["fFirePumpTypeslist", "load"], function() {
	fFirePumpTypeslist.updateLists(<?php echo $FirePumpTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($FirePumpTypes_list->ExportAll && $FirePumpTypes_list->isExport()) {
	$FirePumpTypes_list->StopRecord = $FirePumpTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($FirePumpTypes_list->TotalRecords > $FirePumpTypes_list->StartRecord + $FirePumpTypes_list->DisplayRecords - 1)
		$FirePumpTypes_list->StopRecord = $FirePumpTypes_list->StartRecord + $FirePumpTypes_list->DisplayRecords - 1;
	else
		$FirePumpTypes_list->StopRecord = $FirePumpTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($FirePumpTypes->isConfirm() || $FirePumpTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($FirePumpTypes_list->FormKeyCountName) && ($FirePumpTypes_list->isGridAdd() || $FirePumpTypes_list->isGridEdit() || $FirePumpTypes->isConfirm())) {
		$FirePumpTypes_list->KeyCount = $CurrentForm->getValue($FirePumpTypes_list->FormKeyCountName);
		$FirePumpTypes_list->StopRecord = $FirePumpTypes_list->StartRecord + $FirePumpTypes_list->KeyCount - 1;
	}
}
$FirePumpTypes_list->RecordCount = $FirePumpTypes_list->StartRecord - 1;
if ($FirePumpTypes_list->Recordset && !$FirePumpTypes_list->Recordset->EOF) {
	$FirePumpTypes_list->Recordset->moveFirst();
	$selectLimit = $FirePumpTypes_list->UseSelectLimit;
	if (!$selectLimit && $FirePumpTypes_list->StartRecord > 1)
		$FirePumpTypes_list->Recordset->move($FirePumpTypes_list->StartRecord - 1);
} elseif (!$FirePumpTypes->AllowAddDeleteRow && $FirePumpTypes_list->StopRecord == 0) {
	$FirePumpTypes_list->StopRecord = $FirePumpTypes->GridAddRowCount;
}

// Initialize aggregate
$FirePumpTypes->RowType = ROWTYPE_AGGREGATEINIT;
$FirePumpTypes->resetAttributes();
$FirePumpTypes_list->renderRow();
$FirePumpTypes_list->EditRowCount = 0;
if ($FirePumpTypes_list->isEdit())
	$FirePumpTypes_list->RowIndex = 1;
if ($FirePumpTypes_list->isGridAdd())
	$FirePumpTypes_list->RowIndex = 0;
if ($FirePumpTypes_list->isGridEdit())
	$FirePumpTypes_list->RowIndex = 0;
while ($FirePumpTypes_list->RecordCount < $FirePumpTypes_list->StopRecord) {
	$FirePumpTypes_list->RecordCount++;
	if ($FirePumpTypes_list->RecordCount >= $FirePumpTypes_list->StartRecord) {
		$FirePumpTypes_list->RowCount++;
		if ($FirePumpTypes_list->isGridAdd() || $FirePumpTypes_list->isGridEdit() || $FirePumpTypes->isConfirm()) {
			$FirePumpTypes_list->RowIndex++;
			$CurrentForm->Index = $FirePumpTypes_list->RowIndex;
			if ($CurrentForm->hasValue($FirePumpTypes_list->FormActionName) && ($FirePumpTypes->isConfirm() || $FirePumpTypes_list->EventCancelled))
				$FirePumpTypes_list->RowAction = strval($CurrentForm->getValue($FirePumpTypes_list->FormActionName));
			elseif ($FirePumpTypes_list->isGridAdd())
				$FirePumpTypes_list->RowAction = "insert";
			else
				$FirePumpTypes_list->RowAction = "";
		}

		// Set up key count
		$FirePumpTypes_list->KeyCount = $FirePumpTypes_list->RowIndex;

		// Init row class and style
		$FirePumpTypes->resetAttributes();
		$FirePumpTypes->CssClass = "";
		if ($FirePumpTypes_list->isGridAdd()) {
			$FirePumpTypes_list->loadRowValues(); // Load default values
		} else {
			$FirePumpTypes_list->loadRowValues($FirePumpTypes_list->Recordset); // Load row values
		}
		$FirePumpTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($FirePumpTypes_list->isGridAdd()) // Grid add
			$FirePumpTypes->RowType = ROWTYPE_ADD; // Render add
		if ($FirePumpTypes_list->isGridAdd() && $FirePumpTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$FirePumpTypes_list->restoreCurrentRowFormValues($FirePumpTypes_list->RowIndex); // Restore form values
		if ($FirePumpTypes_list->isEdit()) {
			if ($FirePumpTypes_list->checkInlineEditKey() && $FirePumpTypes_list->EditRowCount == 0) { // Inline edit
				$FirePumpTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($FirePumpTypes_list->isGridEdit()) { // Grid edit
			if ($FirePumpTypes->EventCancelled)
				$FirePumpTypes_list->restoreCurrentRowFormValues($FirePumpTypes_list->RowIndex); // Restore form values
			if ($FirePumpTypes_list->RowAction == "insert")
				$FirePumpTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$FirePumpTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($FirePumpTypes_list->isEdit() && $FirePumpTypes->RowType == ROWTYPE_EDIT && $FirePumpTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$FirePumpTypes_list->restoreFormValues(); // Restore form values
		}
		if ($FirePumpTypes_list->isGridEdit() && ($FirePumpTypes->RowType == ROWTYPE_EDIT || $FirePumpTypes->RowType == ROWTYPE_ADD) && $FirePumpTypes->EventCancelled) // Update failed
			$FirePumpTypes_list->restoreCurrentRowFormValues($FirePumpTypes_list->RowIndex); // Restore form values
		if ($FirePumpTypes->RowType == ROWTYPE_EDIT) // Edit row
			$FirePumpTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$FirePumpTypes->RowAttrs->merge(["data-rowindex" => $FirePumpTypes_list->RowCount, "id" => "r" . $FirePumpTypes_list->RowCount . "_FirePumpTypes", "data-rowtype" => $FirePumpTypes->RowType]);

		// Render row
		$FirePumpTypes_list->renderRow();

		// Render list options
		$FirePumpTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($FirePumpTypes_list->RowAction != "delete" && $FirePumpTypes_list->RowAction != "insertdelete" && !($FirePumpTypes_list->RowAction == "insert" && $FirePumpTypes->isConfirm() && $FirePumpTypes_list->emptyRow())) {
?>
	<tr <?php echo $FirePumpTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FirePumpTypes_list->ListOptions->render("body", "left", $FirePumpTypes_list->RowCount);
?>
	<?php if ($FirePumpTypes_list->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
		<td data-name="FirePumpType_Idn" <?php echo $FirePumpTypes_list->FirePumpType_Idn->cellAttributes() ?>>
<?php if ($FirePumpTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_FirePumpType_Idn" class="form-group"></span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_FirePumpType_Idn" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_FirePumpType_Idn" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_FirePumpType_Idn" value="<?php echo HtmlEncode($FirePumpTypes_list->FirePumpType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($FirePumpTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_FirePumpType_Idn" class="form-group">
<span<?php echo $FirePumpTypes_list->FirePumpType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($FirePumpTypes_list->FirePumpType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_FirePumpType_Idn" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_FirePumpType_Idn" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_FirePumpType_Idn" value="<?php echo HtmlEncode($FirePumpTypes_list->FirePumpType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($FirePumpTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_FirePumpType_Idn">
<span<?php echo $FirePumpTypes_list->FirePumpType_Idn->viewAttributes() ?>><?php echo $FirePumpTypes_list->FirePumpType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FirePumpTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $FirePumpTypes_list->Name->cellAttributes() ?>>
<?php if ($FirePumpTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_Name" class="form-group">
<input type="text" data-table="FirePumpTypes" data-field="x_Name" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_Name" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FirePumpTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FirePumpTypes_list->Name->EditValue ?>"<?php echo $FirePumpTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_Name" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_Name" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FirePumpTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($FirePumpTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_Name" class="form-group">
<input type="text" data-table="FirePumpTypes" data-field="x_Name" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_Name" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FirePumpTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FirePumpTypes_list->Name->EditValue ?>"<?php echo $FirePumpTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FirePumpTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_Name">
<span<?php echo $FirePumpTypes_list->Name->viewAttributes() ?>><?php echo $FirePumpTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FirePumpTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $FirePumpTypes_list->Rank->cellAttributes() ?>>
<?php if ($FirePumpTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_Rank" class="form-group">
<input type="text" data-table="FirePumpTypes" data-field="x_Rank" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FirePumpTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FirePumpTypes_list->Rank->EditValue ?>"<?php echo $FirePumpTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_Rank" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FirePumpTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($FirePumpTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_Rank" class="form-group">
<input type="text" data-table="FirePumpTypes" data-field="x_Rank" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FirePumpTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FirePumpTypes_list->Rank->EditValue ?>"<?php echo $FirePumpTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FirePumpTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_Rank">
<span<?php echo $FirePumpTypes_list->Rank->viewAttributes() ?>><?php echo $FirePumpTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FirePumpTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $FirePumpTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($FirePumpTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FirePumpTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpTypes" data-field="x_ActiveFlag" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]_220268" value="1"<?php echo $selwrk ?><?php echo $FirePumpTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]_220268"></label>
</div>
</span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_ActiveFlag" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FirePumpTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($FirePumpTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FirePumpTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpTypes" data-field="x_ActiveFlag" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]_717577" value="1"<?php echo $selwrk ?><?php echo $FirePumpTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]_717577"></label>
</div>
</span>
<?php } ?>
<?php if ($FirePumpTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FirePumpTypes_list->RowCount ?>_FirePumpTypes_ActiveFlag">
<span<?php echo $FirePumpTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FirePumpTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FirePumpTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FirePumpTypes_list->ListOptions->render("body", "right", $FirePumpTypes_list->RowCount);
?>
	</tr>
<?php if ($FirePumpTypes->RowType == ROWTYPE_ADD || $FirePumpTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fFirePumpTypeslist", "load"], function() {
	fFirePumpTypeslist.updateLists(<?php echo $FirePumpTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$FirePumpTypes_list->isGridAdd())
		if (!$FirePumpTypes_list->Recordset->EOF)
			$FirePumpTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($FirePumpTypes_list->isGridAdd() || $FirePumpTypes_list->isGridEdit()) {
		$FirePumpTypes_list->RowIndex = '$rowindex$';
		$FirePumpTypes_list->loadRowValues();

		// Set row properties
		$FirePumpTypes->resetAttributes();
		$FirePumpTypes->RowAttrs->merge(["data-rowindex" => $FirePumpTypes_list->RowIndex, "id" => "r0_FirePumpTypes", "data-rowtype" => ROWTYPE_ADD]);
		$FirePumpTypes->RowAttrs->appendClass("ew-template");
		$FirePumpTypes->RowType = ROWTYPE_ADD;

		// Render row
		$FirePumpTypes_list->renderRow();

		// Render list options
		$FirePumpTypes_list->renderListOptions();
		$FirePumpTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $FirePumpTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FirePumpTypes_list->ListOptions->render("body", "left", $FirePumpTypes_list->RowIndex);
?>
	<?php if ($FirePumpTypes_list->FirePumpType_Idn->Visible) { // FirePumpType_Idn ?>
		<td data-name="FirePumpType_Idn">
<span id="el$rowindex$_FirePumpTypes_FirePumpType_Idn" class="form-group FirePumpTypes_FirePumpType_Idn"></span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_FirePumpType_Idn" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_FirePumpType_Idn" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_FirePumpType_Idn" value="<?php echo HtmlEncode($FirePumpTypes_list->FirePumpType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_FirePumpTypes_Name" class="form-group FirePumpTypes_Name">
<input type="text" data-table="FirePumpTypes" data-field="x_Name" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_Name" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FirePumpTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FirePumpTypes_list->Name->EditValue ?>"<?php echo $FirePumpTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_Name" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_Name" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FirePumpTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_FirePumpTypes_Rank" class="form-group FirePumpTypes_Rank">
<input type="text" data-table="FirePumpTypes" data-field="x_Rank" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FirePumpTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FirePumpTypes_list->Rank->EditValue ?>"<?php echo $FirePumpTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_Rank" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FirePumpTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_FirePumpTypes_ActiveFlag" class="form-group FirePumpTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($FirePumpTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpTypes" data-field="x_ActiveFlag" name="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]_590710" value="1"<?php echo $selwrk ?><?php echo $FirePumpTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]_590710"></label>
</div>
</span>
<input type="hidden" data-table="FirePumpTypes" data-field="x_ActiveFlag" name="o<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FirePumpTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FirePumpTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FirePumpTypes_list->ListOptions->render("body", "right", $FirePumpTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fFirePumpTypeslist", "load"], function() {
	fFirePumpTypeslist.updateLists(<?php echo $FirePumpTypes_list->RowIndex ?>);
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
<?php if ($FirePumpTypes_list->isAdd() || $FirePumpTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $FirePumpTypes_list->FormKeyCountName ?>" id="<?php echo $FirePumpTypes_list->FormKeyCountName ?>" value="<?php echo $FirePumpTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($FirePumpTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $FirePumpTypes_list->FormKeyCountName ?>" id="<?php echo $FirePumpTypes_list->FormKeyCountName ?>" value="<?php echo $FirePumpTypes_list->KeyCount ?>">
<?php echo $FirePumpTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($FirePumpTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $FirePumpTypes_list->FormKeyCountName ?>" id="<?php echo $FirePumpTypes_list->FormKeyCountName ?>" value="<?php echo $FirePumpTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($FirePumpTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $FirePumpTypes_list->FormKeyCountName ?>" id="<?php echo $FirePumpTypes_list->FormKeyCountName ?>" value="<?php echo $FirePumpTypes_list->KeyCount ?>">
<?php echo $FirePumpTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$FirePumpTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($FirePumpTypes_list->Recordset)
	$FirePumpTypes_list->Recordset->Close();
?>
<?php if (!$FirePumpTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$FirePumpTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FirePumpTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $FirePumpTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($FirePumpTypes_list->TotalRecords == 0 && !$FirePumpTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $FirePumpTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$FirePumpTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$FirePumpTypes_list->isExport()) { ?>
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
$FirePumpTypes_list->terminate();
?>