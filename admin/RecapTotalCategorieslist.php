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
$RecapTotalCategories_list = new RecapTotalCategories_list();

// Run the page
$RecapTotalCategories_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapTotalCategories_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$RecapTotalCategories_list->isExport()) { ?>
<script>
var fRecapTotalCategorieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fRecapTotalCategorieslist = currentForm = new ew.Form("fRecapTotalCategorieslist", "list");
	fRecapTotalCategorieslist.formKeyCountName = '<?php echo $RecapTotalCategories_list->FormKeyCountName ?>';

	// Validate form
	fRecapTotalCategorieslist.validate = function() {
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
			<?php if ($RecapTotalCategories_list->RecapTotalCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RecapTotalCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapTotalCategories_list->RecapTotalCategory_Idn->caption(), $RecapTotalCategories_list->RecapTotalCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapTotalCategories_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapTotalCategories_list->Name->caption(), $RecapTotalCategories_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapTotalCategories_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapTotalCategories_list->Rank->caption(), $RecapTotalCategories_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapTotalCategories_list->Rank->errorMessage()) ?>");
			<?php if ($RecapTotalCategories_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapTotalCategories_list->ActiveFlag->caption(), $RecapTotalCategories_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fRecapTotalCategorieslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fRecapTotalCategorieslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapTotalCategorieslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRecapTotalCategorieslist.lists["x_ActiveFlag[]"] = <?php echo $RecapTotalCategories_list->ActiveFlag->Lookup->toClientList($RecapTotalCategories_list) ?>;
	fRecapTotalCategorieslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($RecapTotalCategories_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fRecapTotalCategorieslist");
});
var fRecapTotalCategorieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fRecapTotalCategorieslistsrch = currentSearchForm = new ew.Form("fRecapTotalCategorieslistsrch");

	// Dynamic selection lists
	// Filters

	fRecapTotalCategorieslistsrch.filterList = <?php echo $RecapTotalCategories_list->getFilterList() ?>;
	loadjs.done("fRecapTotalCategorieslistsrch");
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
<?php if (!$RecapTotalCategories_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($RecapTotalCategories_list->TotalRecords > 0 && $RecapTotalCategories_list->ExportOptions->visible()) { ?>
<?php $RecapTotalCategories_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($RecapTotalCategories_list->ImportOptions->visible()) { ?>
<?php $RecapTotalCategories_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($RecapTotalCategories_list->SearchOptions->visible()) { ?>
<?php $RecapTotalCategories_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($RecapTotalCategories_list->FilterOptions->visible()) { ?>
<?php $RecapTotalCategories_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$RecapTotalCategories_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$RecapTotalCategories_list->isExport() && !$RecapTotalCategories->CurrentAction) { ?>
<form name="fRecapTotalCategorieslistsrch" id="fRecapTotalCategorieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fRecapTotalCategorieslistsrch-search-panel" class="<?php echo $RecapTotalCategories_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="RecapTotalCategories">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $RecapTotalCategories_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($RecapTotalCategories_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($RecapTotalCategories_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $RecapTotalCategories_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($RecapTotalCategories_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($RecapTotalCategories_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($RecapTotalCategories_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($RecapTotalCategories_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $RecapTotalCategories_list->showPageHeader(); ?>
<?php
$RecapTotalCategories_list->showMessage();
?>
<?php if ($RecapTotalCategories_list->TotalRecords > 0 || $RecapTotalCategories->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($RecapTotalCategories_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> RecapTotalCategories">
<?php if (!$RecapTotalCategories_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$RecapTotalCategories_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapTotalCategories_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RecapTotalCategories_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fRecapTotalCategorieslist" id="fRecapTotalCategorieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapTotalCategories">
<div id="gmp_RecapTotalCategories" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($RecapTotalCategories_list->TotalRecords > 0 || $RecapTotalCategories_list->isAdd() || $RecapTotalCategories_list->isCopy() || $RecapTotalCategories_list->isGridEdit()) { ?>
<table id="tbl_RecapTotalCategorieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$RecapTotalCategories->RowType = ROWTYPE_HEADER;

// Render list options
$RecapTotalCategories_list->renderListOptions();

// Render list options (header, left)
$RecapTotalCategories_list->ListOptions->render("header", "left");
?>
<?php if ($RecapTotalCategories_list->RecapTotalCategory_Idn->Visible) { // RecapTotalCategory_Idn ?>
	<?php if ($RecapTotalCategories_list->SortUrl($RecapTotalCategories_list->RecapTotalCategory_Idn) == "") { ?>
		<th data-name="RecapTotalCategory_Idn" class="<?php echo $RecapTotalCategories_list->RecapTotalCategory_Idn->headerCellClass() ?>"><div id="elh_RecapTotalCategories_RecapTotalCategory_Idn" class="RecapTotalCategories_RecapTotalCategory_Idn"><div class="ew-table-header-caption"><?php echo $RecapTotalCategories_list->RecapTotalCategory_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RecapTotalCategory_Idn" class="<?php echo $RecapTotalCategories_list->RecapTotalCategory_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapTotalCategories_list->SortUrl($RecapTotalCategories_list->RecapTotalCategory_Idn) ?>', 1);"><div id="elh_RecapTotalCategories_RecapTotalCategory_Idn" class="RecapTotalCategories_RecapTotalCategory_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapTotalCategories_list->RecapTotalCategory_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapTotalCategories_list->RecapTotalCategory_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapTotalCategories_list->RecapTotalCategory_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapTotalCategories_list->Name->Visible) { // Name ?>
	<?php if ($RecapTotalCategories_list->SortUrl($RecapTotalCategories_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $RecapTotalCategories_list->Name->headerCellClass() ?>"><div id="elh_RecapTotalCategories_Name" class="RecapTotalCategories_Name"><div class="ew-table-header-caption"><?php echo $RecapTotalCategories_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $RecapTotalCategories_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapTotalCategories_list->SortUrl($RecapTotalCategories_list->Name) ?>', 1);"><div id="elh_RecapTotalCategories_Name" class="RecapTotalCategories_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapTotalCategories_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($RecapTotalCategories_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapTotalCategories_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapTotalCategories_list->Rank->Visible) { // Rank ?>
	<?php if ($RecapTotalCategories_list->SortUrl($RecapTotalCategories_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $RecapTotalCategories_list->Rank->headerCellClass() ?>"><div id="elh_RecapTotalCategories_Rank" class="RecapTotalCategories_Rank"><div class="ew-table-header-caption"><?php echo $RecapTotalCategories_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $RecapTotalCategories_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapTotalCategories_list->SortUrl($RecapTotalCategories_list->Rank) ?>', 1);"><div id="elh_RecapTotalCategories_Rank" class="RecapTotalCategories_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapTotalCategories_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapTotalCategories_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapTotalCategories_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapTotalCategories_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($RecapTotalCategories_list->SortUrl($RecapTotalCategories_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $RecapTotalCategories_list->ActiveFlag->headerCellClass() ?>"><div id="elh_RecapTotalCategories_ActiveFlag" class="RecapTotalCategories_ActiveFlag"><div class="ew-table-header-caption"><?php echo $RecapTotalCategories_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $RecapTotalCategories_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapTotalCategories_list->SortUrl($RecapTotalCategories_list->ActiveFlag) ?>', 1);"><div id="elh_RecapTotalCategories_ActiveFlag" class="RecapTotalCategories_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapTotalCategories_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapTotalCategories_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapTotalCategories_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$RecapTotalCategories_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($RecapTotalCategories_list->isAdd() || $RecapTotalCategories_list->isCopy()) {
		$RecapTotalCategories_list->RowIndex = 0;
		$RecapTotalCategories_list->KeyCount = $RecapTotalCategories_list->RowIndex;
		if ($RecapTotalCategories_list->isCopy() && !$RecapTotalCategories_list->loadRow())
			$RecapTotalCategories->CurrentAction = "add";
		if ($RecapTotalCategories_list->isAdd())
			$RecapTotalCategories_list->loadRowValues();
		if ($RecapTotalCategories->EventCancelled) // Insert failed
			$RecapTotalCategories_list->restoreFormValues(); // Restore form values

		// Set row properties
		$RecapTotalCategories->resetAttributes();
		$RecapTotalCategories->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_RecapTotalCategories", "data-rowtype" => ROWTYPE_ADD]);
		$RecapTotalCategories->RowType = ROWTYPE_ADD;

		// Render row
		$RecapTotalCategories_list->renderRow();

		// Render list options
		$RecapTotalCategories_list->renderListOptions();
		$RecapTotalCategories_list->StartRowCount = 0;
?>
	<tr <?php echo $RecapTotalCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapTotalCategories_list->ListOptions->render("body", "left", $RecapTotalCategories_list->RowCount);
?>
	<?php if ($RecapTotalCategories_list->RecapTotalCategory_Idn->Visible) { // RecapTotalCategory_Idn ?>
		<td data-name="RecapTotalCategory_Idn">
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_RecapTotalCategory_Idn" class="form-group RecapTotalCategories_RecapTotalCategory_Idn"></span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_RecapTotalCategory_Idn" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_RecapTotalCategory_Idn" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_RecapTotalCategory_Idn" value="<?php echo HtmlEncode($RecapTotalCategories_list->RecapTotalCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapTotalCategories_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_Name" class="form-group RecapTotalCategories_Name">
<input type="text" data-table="RecapTotalCategories" data-field="x_Name" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapTotalCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapTotalCategories_list->Name->EditValue ?>"<?php echo $RecapTotalCategories_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_Name" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RecapTotalCategories_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapTotalCategories_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_Rank" class="form-group RecapTotalCategories_Rank">
<input type="text" data-table="RecapTotalCategories" data-field="x_Rank" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapTotalCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapTotalCategories_list->Rank->EditValue ?>"<?php echo $RecapTotalCategories_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_Rank" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RecapTotalCategories_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapTotalCategories_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_ActiveFlag" class="form-group RecapTotalCategories_ActiveFlag">
<?php
$selwrk = ConvertToBool($RecapTotalCategories_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapTotalCategories" data-field="x_ActiveFlag" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]_146511" value="1"<?php echo $selwrk ?><?php echo $RecapTotalCategories_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]_146511"></label>
</div>
</span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_ActiveFlag" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RecapTotalCategories_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapTotalCategories_list->ListOptions->render("body", "right", $RecapTotalCategories_list->RowCount);
?>
<script>
loadjs.ready(["fRecapTotalCategorieslist", "load"], function() {
	fRecapTotalCategorieslist.updateLists(<?php echo $RecapTotalCategories_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($RecapTotalCategories_list->ExportAll && $RecapTotalCategories_list->isExport()) {
	$RecapTotalCategories_list->StopRecord = $RecapTotalCategories_list->TotalRecords;
} else {

	// Set the last record to display
	if ($RecapTotalCategories_list->TotalRecords > $RecapTotalCategories_list->StartRecord + $RecapTotalCategories_list->DisplayRecords - 1)
		$RecapTotalCategories_list->StopRecord = $RecapTotalCategories_list->StartRecord + $RecapTotalCategories_list->DisplayRecords - 1;
	else
		$RecapTotalCategories_list->StopRecord = $RecapTotalCategories_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($RecapTotalCategories->isConfirm() || $RecapTotalCategories_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($RecapTotalCategories_list->FormKeyCountName) && ($RecapTotalCategories_list->isGridAdd() || $RecapTotalCategories_list->isGridEdit() || $RecapTotalCategories->isConfirm())) {
		$RecapTotalCategories_list->KeyCount = $CurrentForm->getValue($RecapTotalCategories_list->FormKeyCountName);
		$RecapTotalCategories_list->StopRecord = $RecapTotalCategories_list->StartRecord + $RecapTotalCategories_list->KeyCount - 1;
	}
}
$RecapTotalCategories_list->RecordCount = $RecapTotalCategories_list->StartRecord - 1;
if ($RecapTotalCategories_list->Recordset && !$RecapTotalCategories_list->Recordset->EOF) {
	$RecapTotalCategories_list->Recordset->moveFirst();
	$selectLimit = $RecapTotalCategories_list->UseSelectLimit;
	if (!$selectLimit && $RecapTotalCategories_list->StartRecord > 1)
		$RecapTotalCategories_list->Recordset->move($RecapTotalCategories_list->StartRecord - 1);
} elseif (!$RecapTotalCategories->AllowAddDeleteRow && $RecapTotalCategories_list->StopRecord == 0) {
	$RecapTotalCategories_list->StopRecord = $RecapTotalCategories->GridAddRowCount;
}

// Initialize aggregate
$RecapTotalCategories->RowType = ROWTYPE_AGGREGATEINIT;
$RecapTotalCategories->resetAttributes();
$RecapTotalCategories_list->renderRow();
$RecapTotalCategories_list->EditRowCount = 0;
if ($RecapTotalCategories_list->isEdit())
	$RecapTotalCategories_list->RowIndex = 1;
if ($RecapTotalCategories_list->isGridAdd())
	$RecapTotalCategories_list->RowIndex = 0;
if ($RecapTotalCategories_list->isGridEdit())
	$RecapTotalCategories_list->RowIndex = 0;
while ($RecapTotalCategories_list->RecordCount < $RecapTotalCategories_list->StopRecord) {
	$RecapTotalCategories_list->RecordCount++;
	if ($RecapTotalCategories_list->RecordCount >= $RecapTotalCategories_list->StartRecord) {
		$RecapTotalCategories_list->RowCount++;
		if ($RecapTotalCategories_list->isGridAdd() || $RecapTotalCategories_list->isGridEdit() || $RecapTotalCategories->isConfirm()) {
			$RecapTotalCategories_list->RowIndex++;
			$CurrentForm->Index = $RecapTotalCategories_list->RowIndex;
			if ($CurrentForm->hasValue($RecapTotalCategories_list->FormActionName) && ($RecapTotalCategories->isConfirm() || $RecapTotalCategories_list->EventCancelled))
				$RecapTotalCategories_list->RowAction = strval($CurrentForm->getValue($RecapTotalCategories_list->FormActionName));
			elseif ($RecapTotalCategories_list->isGridAdd())
				$RecapTotalCategories_list->RowAction = "insert";
			else
				$RecapTotalCategories_list->RowAction = "";
		}

		// Set up key count
		$RecapTotalCategories_list->KeyCount = $RecapTotalCategories_list->RowIndex;

		// Init row class and style
		$RecapTotalCategories->resetAttributes();
		$RecapTotalCategories->CssClass = "";
		if ($RecapTotalCategories_list->isGridAdd()) {
			$RecapTotalCategories_list->loadRowValues(); // Load default values
		} else {
			$RecapTotalCategories_list->loadRowValues($RecapTotalCategories_list->Recordset); // Load row values
		}
		$RecapTotalCategories->RowType = ROWTYPE_VIEW; // Render view
		if ($RecapTotalCategories_list->isGridAdd()) // Grid add
			$RecapTotalCategories->RowType = ROWTYPE_ADD; // Render add
		if ($RecapTotalCategories_list->isGridAdd() && $RecapTotalCategories->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$RecapTotalCategories_list->restoreCurrentRowFormValues($RecapTotalCategories_list->RowIndex); // Restore form values
		if ($RecapTotalCategories_list->isEdit()) {
			if ($RecapTotalCategories_list->checkInlineEditKey() && $RecapTotalCategories_list->EditRowCount == 0) { // Inline edit
				$RecapTotalCategories->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($RecapTotalCategories_list->isGridEdit()) { // Grid edit
			if ($RecapTotalCategories->EventCancelled)
				$RecapTotalCategories_list->restoreCurrentRowFormValues($RecapTotalCategories_list->RowIndex); // Restore form values
			if ($RecapTotalCategories_list->RowAction == "insert")
				$RecapTotalCategories->RowType = ROWTYPE_ADD; // Render add
			else
				$RecapTotalCategories->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($RecapTotalCategories_list->isEdit() && $RecapTotalCategories->RowType == ROWTYPE_EDIT && $RecapTotalCategories->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$RecapTotalCategories_list->restoreFormValues(); // Restore form values
		}
		if ($RecapTotalCategories_list->isGridEdit() && ($RecapTotalCategories->RowType == ROWTYPE_EDIT || $RecapTotalCategories->RowType == ROWTYPE_ADD) && $RecapTotalCategories->EventCancelled) // Update failed
			$RecapTotalCategories_list->restoreCurrentRowFormValues($RecapTotalCategories_list->RowIndex); // Restore form values
		if ($RecapTotalCategories->RowType == ROWTYPE_EDIT) // Edit row
			$RecapTotalCategories_list->EditRowCount++;

		// Set up row id / data-rowindex
		$RecapTotalCategories->RowAttrs->merge(["data-rowindex" => $RecapTotalCategories_list->RowCount, "id" => "r" . $RecapTotalCategories_list->RowCount . "_RecapTotalCategories", "data-rowtype" => $RecapTotalCategories->RowType]);

		// Render row
		$RecapTotalCategories_list->renderRow();

		// Render list options
		$RecapTotalCategories_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($RecapTotalCategories_list->RowAction != "delete" && $RecapTotalCategories_list->RowAction != "insertdelete" && !($RecapTotalCategories_list->RowAction == "insert" && $RecapTotalCategories->isConfirm() && $RecapTotalCategories_list->emptyRow())) {
?>
	<tr <?php echo $RecapTotalCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapTotalCategories_list->ListOptions->render("body", "left", $RecapTotalCategories_list->RowCount);
?>
	<?php if ($RecapTotalCategories_list->RecapTotalCategory_Idn->Visible) { // RecapTotalCategory_Idn ?>
		<td data-name="RecapTotalCategory_Idn" <?php echo $RecapTotalCategories_list->RecapTotalCategory_Idn->cellAttributes() ?>>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_RecapTotalCategory_Idn" class="form-group"></span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_RecapTotalCategory_Idn" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_RecapTotalCategory_Idn" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_RecapTotalCategory_Idn" value="<?php echo HtmlEncode($RecapTotalCategories_list->RecapTotalCategory_Idn->OldValue) ?>">
<?php } ?>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_RecapTotalCategory_Idn" class="form-group">
<span<?php echo $RecapTotalCategories_list->RecapTotalCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($RecapTotalCategories_list->RecapTotalCategory_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_RecapTotalCategory_Idn" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_RecapTotalCategory_Idn" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_RecapTotalCategory_Idn" value="<?php echo HtmlEncode($RecapTotalCategories_list->RecapTotalCategory_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_RecapTotalCategory_Idn">
<span<?php echo $RecapTotalCategories_list->RecapTotalCategory_Idn->viewAttributes() ?>><?php echo $RecapTotalCategories_list->RecapTotalCategory_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapTotalCategories_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $RecapTotalCategories_list->Name->cellAttributes() ?>>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_Name" class="form-group">
<input type="text" data-table="RecapTotalCategories" data-field="x_Name" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapTotalCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapTotalCategories_list->Name->EditValue ?>"<?php echo $RecapTotalCategories_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_Name" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RecapTotalCategories_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_Name" class="form-group">
<input type="text" data-table="RecapTotalCategories" data-field="x_Name" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapTotalCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapTotalCategories_list->Name->EditValue ?>"<?php echo $RecapTotalCategories_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_Name">
<span<?php echo $RecapTotalCategories_list->Name->viewAttributes() ?>><?php echo $RecapTotalCategories_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapTotalCategories_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $RecapTotalCategories_list->Rank->cellAttributes() ?>>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_Rank" class="form-group">
<input type="text" data-table="RecapTotalCategories" data-field="x_Rank" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapTotalCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapTotalCategories_list->Rank->EditValue ?>"<?php echo $RecapTotalCategories_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_Rank" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RecapTotalCategories_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_Rank" class="form-group">
<input type="text" data-table="RecapTotalCategories" data-field="x_Rank" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapTotalCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapTotalCategories_list->Rank->EditValue ?>"<?php echo $RecapTotalCategories_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_Rank">
<span<?php echo $RecapTotalCategories_list->Rank->viewAttributes() ?>><?php echo $RecapTotalCategories_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapTotalCategories_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $RecapTotalCategories_list->ActiveFlag->cellAttributes() ?>>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapTotalCategories_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapTotalCategories" data-field="x_ActiveFlag" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]_997887" value="1"<?php echo $selwrk ?><?php echo $RecapTotalCategories_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]_997887"></label>
</div>
</span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_ActiveFlag" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RecapTotalCategories_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapTotalCategories_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapTotalCategories" data-field="x_ActiveFlag" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]_828855" value="1"<?php echo $selwrk ?><?php echo $RecapTotalCategories_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]_828855"></label>
</div>
</span>
<?php } ?>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapTotalCategories_list->RowCount ?>_RecapTotalCategories_ActiveFlag">
<span<?php echo $RecapTotalCategories_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $RecapTotalCategories_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapTotalCategories_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapTotalCategories_list->ListOptions->render("body", "right", $RecapTotalCategories_list->RowCount);
?>
	</tr>
<?php if ($RecapTotalCategories->RowType == ROWTYPE_ADD || $RecapTotalCategories->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fRecapTotalCategorieslist", "load"], function() {
	fRecapTotalCategorieslist.updateLists(<?php echo $RecapTotalCategories_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$RecapTotalCategories_list->isGridAdd())
		if (!$RecapTotalCategories_list->Recordset->EOF)
			$RecapTotalCategories_list->Recordset->moveNext();
}
?>
<?php
	if ($RecapTotalCategories_list->isGridAdd() || $RecapTotalCategories_list->isGridEdit()) {
		$RecapTotalCategories_list->RowIndex = '$rowindex$';
		$RecapTotalCategories_list->loadRowValues();

		// Set row properties
		$RecapTotalCategories->resetAttributes();
		$RecapTotalCategories->RowAttrs->merge(["data-rowindex" => $RecapTotalCategories_list->RowIndex, "id" => "r0_RecapTotalCategories", "data-rowtype" => ROWTYPE_ADD]);
		$RecapTotalCategories->RowAttrs->appendClass("ew-template");
		$RecapTotalCategories->RowType = ROWTYPE_ADD;

		// Render row
		$RecapTotalCategories_list->renderRow();

		// Render list options
		$RecapTotalCategories_list->renderListOptions();
		$RecapTotalCategories_list->StartRowCount = 0;
?>
	<tr <?php echo $RecapTotalCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapTotalCategories_list->ListOptions->render("body", "left", $RecapTotalCategories_list->RowIndex);
?>
	<?php if ($RecapTotalCategories_list->RecapTotalCategory_Idn->Visible) { // RecapTotalCategory_Idn ?>
		<td data-name="RecapTotalCategory_Idn">
<span id="el$rowindex$_RecapTotalCategories_RecapTotalCategory_Idn" class="form-group RecapTotalCategories_RecapTotalCategory_Idn"></span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_RecapTotalCategory_Idn" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_RecapTotalCategory_Idn" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_RecapTotalCategory_Idn" value="<?php echo HtmlEncode($RecapTotalCategories_list->RecapTotalCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapTotalCategories_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_RecapTotalCategories_Name" class="form-group RecapTotalCategories_Name">
<input type="text" data-table="RecapTotalCategories" data-field="x_Name" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapTotalCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapTotalCategories_list->Name->EditValue ?>"<?php echo $RecapTotalCategories_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_Name" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RecapTotalCategories_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapTotalCategories_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_RecapTotalCategories_Rank" class="form-group RecapTotalCategories_Rank">
<input type="text" data-table="RecapTotalCategories" data-field="x_Rank" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapTotalCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapTotalCategories_list->Rank->EditValue ?>"<?php echo $RecapTotalCategories_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_Rank" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RecapTotalCategories_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapTotalCategories_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_RecapTotalCategories_ActiveFlag" class="form-group RecapTotalCategories_ActiveFlag">
<?php
$selwrk = ConvertToBool($RecapTotalCategories_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapTotalCategories" data-field="x_ActiveFlag" name="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]_607464" value="1"<?php echo $selwrk ?><?php echo $RecapTotalCategories_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]_607464"></label>
</div>
</span>
<input type="hidden" data-table="RecapTotalCategories" data-field="x_ActiveFlag" name="o<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RecapTotalCategories_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RecapTotalCategories_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapTotalCategories_list->ListOptions->render("body", "right", $RecapTotalCategories_list->RowIndex);
?>
<script>
loadjs.ready(["fRecapTotalCategorieslist", "load"], function() {
	fRecapTotalCategorieslist.updateLists(<?php echo $RecapTotalCategories_list->RowIndex ?>);
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
<?php if ($RecapTotalCategories_list->isAdd() || $RecapTotalCategories_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $RecapTotalCategories_list->FormKeyCountName ?>" id="<?php echo $RecapTotalCategories_list->FormKeyCountName ?>" value="<?php echo $RecapTotalCategories_list->KeyCount ?>">
<?php } ?>
<?php if ($RecapTotalCategories_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $RecapTotalCategories_list->FormKeyCountName ?>" id="<?php echo $RecapTotalCategories_list->FormKeyCountName ?>" value="<?php echo $RecapTotalCategories_list->KeyCount ?>">
<?php echo $RecapTotalCategories_list->MultiSelectKey ?>
<?php } ?>
<?php if ($RecapTotalCategories_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $RecapTotalCategories_list->FormKeyCountName ?>" id="<?php echo $RecapTotalCategories_list->FormKeyCountName ?>" value="<?php echo $RecapTotalCategories_list->KeyCount ?>">
<?php } ?>
<?php if ($RecapTotalCategories_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $RecapTotalCategories_list->FormKeyCountName ?>" id="<?php echo $RecapTotalCategories_list->FormKeyCountName ?>" value="<?php echo $RecapTotalCategories_list->KeyCount ?>">
<?php echo $RecapTotalCategories_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$RecapTotalCategories->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($RecapTotalCategories_list->Recordset)
	$RecapTotalCategories_list->Recordset->Close();
?>
<?php if (!$RecapTotalCategories_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$RecapTotalCategories_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapTotalCategories_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RecapTotalCategories_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($RecapTotalCategories_list->TotalRecords == 0 && !$RecapTotalCategories->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $RecapTotalCategories_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$RecapTotalCategories_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$RecapTotalCategories_list->isExport()) { ?>
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
$RecapTotalCategories_list->terminate();
?>