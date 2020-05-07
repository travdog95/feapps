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
$RecapSubtotalCategories_list = new RecapSubtotalCategories_list();

// Run the page
$RecapSubtotalCategories_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapSubtotalCategories_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$RecapSubtotalCategories_list->isExport()) { ?>
<script>
var fRecapSubtotalCategorieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fRecapSubtotalCategorieslist = currentForm = new ew.Form("fRecapSubtotalCategorieslist", "list");
	fRecapSubtotalCategorieslist.formKeyCountName = '<?php echo $RecapSubtotalCategories_list->FormKeyCountName ?>';

	// Validate form
	fRecapSubtotalCategorieslist.validate = function() {
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
			<?php if ($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RecapSubtotalCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->caption(), $RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapSubtotalCategories_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapSubtotalCategories_list->Name->caption(), $RecapSubtotalCategories_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapSubtotalCategories_list->Percentage->Required) { ?>
				elm = this.getElements("x" + infix + "_Percentage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapSubtotalCategories_list->Percentage->caption(), $RecapSubtotalCategories_list->Percentage->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Percentage");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapSubtotalCategories_list->Percentage->errorMessage()) ?>");
			<?php if ($RecapSubtotalCategories_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapSubtotalCategories_list->Rank->caption(), $RecapSubtotalCategories_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapSubtotalCategories_list->Rank->errorMessage()) ?>");

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
	fRecapSubtotalCategorieslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Percentage", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fRecapSubtotalCategorieslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapSubtotalCategorieslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fRecapSubtotalCategorieslist");
});
var fRecapSubtotalCategorieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fRecapSubtotalCategorieslistsrch = currentSearchForm = new ew.Form("fRecapSubtotalCategorieslistsrch");

	// Dynamic selection lists
	// Filters

	fRecapSubtotalCategorieslistsrch.filterList = <?php echo $RecapSubtotalCategories_list->getFilterList() ?>;
	loadjs.done("fRecapSubtotalCategorieslistsrch");
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
<?php if (!$RecapSubtotalCategories_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($RecapSubtotalCategories_list->TotalRecords > 0 && $RecapSubtotalCategories_list->ExportOptions->visible()) { ?>
<?php $RecapSubtotalCategories_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($RecapSubtotalCategories_list->ImportOptions->visible()) { ?>
<?php $RecapSubtotalCategories_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($RecapSubtotalCategories_list->SearchOptions->visible()) { ?>
<?php $RecapSubtotalCategories_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($RecapSubtotalCategories_list->FilterOptions->visible()) { ?>
<?php $RecapSubtotalCategories_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$RecapSubtotalCategories_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$RecapSubtotalCategories_list->isExport() && !$RecapSubtotalCategories->CurrentAction) { ?>
<form name="fRecapSubtotalCategorieslistsrch" id="fRecapSubtotalCategorieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fRecapSubtotalCategorieslistsrch-search-panel" class="<?php echo $RecapSubtotalCategories_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="RecapSubtotalCategories">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $RecapSubtotalCategories_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $RecapSubtotalCategories_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($RecapSubtotalCategories_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($RecapSubtotalCategories_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($RecapSubtotalCategories_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($RecapSubtotalCategories_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $RecapSubtotalCategories_list->showPageHeader(); ?>
<?php
$RecapSubtotalCategories_list->showMessage();
?>
<?php if ($RecapSubtotalCategories_list->TotalRecords > 0 || $RecapSubtotalCategories->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($RecapSubtotalCategories_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> RecapSubtotalCategories">
<?php if (!$RecapSubtotalCategories_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$RecapSubtotalCategories_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapSubtotalCategories_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RecapSubtotalCategories_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fRecapSubtotalCategorieslist" id="fRecapSubtotalCategorieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapSubtotalCategories">
<div id="gmp_RecapSubtotalCategories" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($RecapSubtotalCategories_list->TotalRecords > 0 || $RecapSubtotalCategories_list->isAdd() || $RecapSubtotalCategories_list->isCopy() || $RecapSubtotalCategories_list->isGridEdit()) { ?>
<table id="tbl_RecapSubtotalCategorieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$RecapSubtotalCategories->RowType = ROWTYPE_HEADER;

// Render list options
$RecapSubtotalCategories_list->renderListOptions();

// Render list options (header, left)
$RecapSubtotalCategories_list->ListOptions->render("header", "left");
?>
<?php if ($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->Visible) { // RecapSubtotalCategory_Idn ?>
	<?php if ($RecapSubtotalCategories_list->SortUrl($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn) == "") { ?>
		<th data-name="RecapSubtotalCategory_Idn" class="<?php echo $RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->headerCellClass() ?>"><div id="elh_RecapSubtotalCategories_RecapSubtotalCategory_Idn" class="RecapSubtotalCategories_RecapSubtotalCategory_Idn"><div class="ew-table-header-caption"><?php echo $RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RecapSubtotalCategory_Idn" class="<?php echo $RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapSubtotalCategories_list->SortUrl($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn) ?>', 1);"><div id="elh_RecapSubtotalCategories_RecapSubtotalCategory_Idn" class="RecapSubtotalCategories_RecapSubtotalCategory_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapSubtotalCategories_list->Name->Visible) { // Name ?>
	<?php if ($RecapSubtotalCategories_list->SortUrl($RecapSubtotalCategories_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $RecapSubtotalCategories_list->Name->headerCellClass() ?>"><div id="elh_RecapSubtotalCategories_Name" class="RecapSubtotalCategories_Name"><div class="ew-table-header-caption"><?php echo $RecapSubtotalCategories_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $RecapSubtotalCategories_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapSubtotalCategories_list->SortUrl($RecapSubtotalCategories_list->Name) ?>', 1);"><div id="elh_RecapSubtotalCategories_Name" class="RecapSubtotalCategories_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapSubtotalCategories_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($RecapSubtotalCategories_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapSubtotalCategories_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapSubtotalCategories_list->Percentage->Visible) { // Percentage ?>
	<?php if ($RecapSubtotalCategories_list->SortUrl($RecapSubtotalCategories_list->Percentage) == "") { ?>
		<th data-name="Percentage" class="<?php echo $RecapSubtotalCategories_list->Percentage->headerCellClass() ?>"><div id="elh_RecapSubtotalCategories_Percentage" class="RecapSubtotalCategories_Percentage"><div class="ew-table-header-caption"><?php echo $RecapSubtotalCategories_list->Percentage->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Percentage" class="<?php echo $RecapSubtotalCategories_list->Percentage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapSubtotalCategories_list->SortUrl($RecapSubtotalCategories_list->Percentage) ?>', 1);"><div id="elh_RecapSubtotalCategories_Percentage" class="RecapSubtotalCategories_Percentage">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapSubtotalCategories_list->Percentage->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapSubtotalCategories_list->Percentage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapSubtotalCategories_list->Percentage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapSubtotalCategories_list->Rank->Visible) { // Rank ?>
	<?php if ($RecapSubtotalCategories_list->SortUrl($RecapSubtotalCategories_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $RecapSubtotalCategories_list->Rank->headerCellClass() ?>"><div id="elh_RecapSubtotalCategories_Rank" class="RecapSubtotalCategories_Rank"><div class="ew-table-header-caption"><?php echo $RecapSubtotalCategories_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $RecapSubtotalCategories_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapSubtotalCategories_list->SortUrl($RecapSubtotalCategories_list->Rank) ?>', 1);"><div id="elh_RecapSubtotalCategories_Rank" class="RecapSubtotalCategories_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapSubtotalCategories_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapSubtotalCategories_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapSubtotalCategories_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$RecapSubtotalCategories_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($RecapSubtotalCategories_list->isAdd() || $RecapSubtotalCategories_list->isCopy()) {
		$RecapSubtotalCategories_list->RowIndex = 0;
		$RecapSubtotalCategories_list->KeyCount = $RecapSubtotalCategories_list->RowIndex;
		if ($RecapSubtotalCategories_list->isCopy() && !$RecapSubtotalCategories_list->loadRow())
			$RecapSubtotalCategories->CurrentAction = "add";
		if ($RecapSubtotalCategories_list->isAdd())
			$RecapSubtotalCategories_list->loadRowValues();
		if ($RecapSubtotalCategories->EventCancelled) // Insert failed
			$RecapSubtotalCategories_list->restoreFormValues(); // Restore form values

		// Set row properties
		$RecapSubtotalCategories->resetAttributes();
		$RecapSubtotalCategories->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_RecapSubtotalCategories", "data-rowtype" => ROWTYPE_ADD]);
		$RecapSubtotalCategories->RowType = ROWTYPE_ADD;

		// Render row
		$RecapSubtotalCategories_list->renderRow();

		// Render list options
		$RecapSubtotalCategories_list->renderListOptions();
		$RecapSubtotalCategories_list->StartRowCount = 0;
?>
	<tr <?php echo $RecapSubtotalCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapSubtotalCategories_list->ListOptions->render("body", "left", $RecapSubtotalCategories_list->RowCount);
?>
	<?php if ($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->Visible) { // RecapSubtotalCategory_Idn ?>
		<td data-name="RecapSubtotalCategory_Idn">
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_RecapSubtotalCategory_Idn" class="form-group RecapSubtotalCategories_RecapSubtotalCategory_Idn"></span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_RecapSubtotalCategory_Idn" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_RecapSubtotalCategory_Idn" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_RecapSubtotalCategory_Idn" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapSubtotalCategories_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Name" class="form-group RecapSubtotalCategories_Name">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Name" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Name->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_Name" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapSubtotalCategories_list->Percentage->Visible) { // Percentage ?>
		<td data-name="Percentage">
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Percentage" class="form-group RecapSubtotalCategories_Percentage">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Percentage" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Percentage->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Percentage->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Percentage->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_Percentage" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->Percentage->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapSubtotalCategories_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Rank" class="form-group RecapSubtotalCategories_Rank">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Rank" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Rank->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_Rank" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapSubtotalCategories_list->ListOptions->render("body", "right", $RecapSubtotalCategories_list->RowCount);
?>
<script>
loadjs.ready(["fRecapSubtotalCategorieslist", "load"], function() {
	fRecapSubtotalCategorieslist.updateLists(<?php echo $RecapSubtotalCategories_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($RecapSubtotalCategories_list->ExportAll && $RecapSubtotalCategories_list->isExport()) {
	$RecapSubtotalCategories_list->StopRecord = $RecapSubtotalCategories_list->TotalRecords;
} else {

	// Set the last record to display
	if ($RecapSubtotalCategories_list->TotalRecords > $RecapSubtotalCategories_list->StartRecord + $RecapSubtotalCategories_list->DisplayRecords - 1)
		$RecapSubtotalCategories_list->StopRecord = $RecapSubtotalCategories_list->StartRecord + $RecapSubtotalCategories_list->DisplayRecords - 1;
	else
		$RecapSubtotalCategories_list->StopRecord = $RecapSubtotalCategories_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($RecapSubtotalCategories->isConfirm() || $RecapSubtotalCategories_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($RecapSubtotalCategories_list->FormKeyCountName) && ($RecapSubtotalCategories_list->isGridAdd() || $RecapSubtotalCategories_list->isGridEdit() || $RecapSubtotalCategories->isConfirm())) {
		$RecapSubtotalCategories_list->KeyCount = $CurrentForm->getValue($RecapSubtotalCategories_list->FormKeyCountName);
		$RecapSubtotalCategories_list->StopRecord = $RecapSubtotalCategories_list->StartRecord + $RecapSubtotalCategories_list->KeyCount - 1;
	}
}
$RecapSubtotalCategories_list->RecordCount = $RecapSubtotalCategories_list->StartRecord - 1;
if ($RecapSubtotalCategories_list->Recordset && !$RecapSubtotalCategories_list->Recordset->EOF) {
	$RecapSubtotalCategories_list->Recordset->moveFirst();
	$selectLimit = $RecapSubtotalCategories_list->UseSelectLimit;
	if (!$selectLimit && $RecapSubtotalCategories_list->StartRecord > 1)
		$RecapSubtotalCategories_list->Recordset->move($RecapSubtotalCategories_list->StartRecord - 1);
} elseif (!$RecapSubtotalCategories->AllowAddDeleteRow && $RecapSubtotalCategories_list->StopRecord == 0) {
	$RecapSubtotalCategories_list->StopRecord = $RecapSubtotalCategories->GridAddRowCount;
}

// Initialize aggregate
$RecapSubtotalCategories->RowType = ROWTYPE_AGGREGATEINIT;
$RecapSubtotalCategories->resetAttributes();
$RecapSubtotalCategories_list->renderRow();
$RecapSubtotalCategories_list->EditRowCount = 0;
if ($RecapSubtotalCategories_list->isEdit())
	$RecapSubtotalCategories_list->RowIndex = 1;
if ($RecapSubtotalCategories_list->isGridAdd())
	$RecapSubtotalCategories_list->RowIndex = 0;
if ($RecapSubtotalCategories_list->isGridEdit())
	$RecapSubtotalCategories_list->RowIndex = 0;
while ($RecapSubtotalCategories_list->RecordCount < $RecapSubtotalCategories_list->StopRecord) {
	$RecapSubtotalCategories_list->RecordCount++;
	if ($RecapSubtotalCategories_list->RecordCount >= $RecapSubtotalCategories_list->StartRecord) {
		$RecapSubtotalCategories_list->RowCount++;
		if ($RecapSubtotalCategories_list->isGridAdd() || $RecapSubtotalCategories_list->isGridEdit() || $RecapSubtotalCategories->isConfirm()) {
			$RecapSubtotalCategories_list->RowIndex++;
			$CurrentForm->Index = $RecapSubtotalCategories_list->RowIndex;
			if ($CurrentForm->hasValue($RecapSubtotalCategories_list->FormActionName) && ($RecapSubtotalCategories->isConfirm() || $RecapSubtotalCategories_list->EventCancelled))
				$RecapSubtotalCategories_list->RowAction = strval($CurrentForm->getValue($RecapSubtotalCategories_list->FormActionName));
			elseif ($RecapSubtotalCategories_list->isGridAdd())
				$RecapSubtotalCategories_list->RowAction = "insert";
			else
				$RecapSubtotalCategories_list->RowAction = "";
		}

		// Set up key count
		$RecapSubtotalCategories_list->KeyCount = $RecapSubtotalCategories_list->RowIndex;

		// Init row class and style
		$RecapSubtotalCategories->resetAttributes();
		$RecapSubtotalCategories->CssClass = "";
		if ($RecapSubtotalCategories_list->isGridAdd()) {
			$RecapSubtotalCategories_list->loadRowValues(); // Load default values
		} else {
			$RecapSubtotalCategories_list->loadRowValues($RecapSubtotalCategories_list->Recordset); // Load row values
		}
		$RecapSubtotalCategories->RowType = ROWTYPE_VIEW; // Render view
		if ($RecapSubtotalCategories_list->isGridAdd()) // Grid add
			$RecapSubtotalCategories->RowType = ROWTYPE_ADD; // Render add
		if ($RecapSubtotalCategories_list->isGridAdd() && $RecapSubtotalCategories->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$RecapSubtotalCategories_list->restoreCurrentRowFormValues($RecapSubtotalCategories_list->RowIndex); // Restore form values
		if ($RecapSubtotalCategories_list->isEdit()) {
			if ($RecapSubtotalCategories_list->checkInlineEditKey() && $RecapSubtotalCategories_list->EditRowCount == 0) { // Inline edit
				$RecapSubtotalCategories->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($RecapSubtotalCategories_list->isGridEdit()) { // Grid edit
			if ($RecapSubtotalCategories->EventCancelled)
				$RecapSubtotalCategories_list->restoreCurrentRowFormValues($RecapSubtotalCategories_list->RowIndex); // Restore form values
			if ($RecapSubtotalCategories_list->RowAction == "insert")
				$RecapSubtotalCategories->RowType = ROWTYPE_ADD; // Render add
			else
				$RecapSubtotalCategories->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($RecapSubtotalCategories_list->isEdit() && $RecapSubtotalCategories->RowType == ROWTYPE_EDIT && $RecapSubtotalCategories->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$RecapSubtotalCategories_list->restoreFormValues(); // Restore form values
		}
		if ($RecapSubtotalCategories_list->isGridEdit() && ($RecapSubtotalCategories->RowType == ROWTYPE_EDIT || $RecapSubtotalCategories->RowType == ROWTYPE_ADD) && $RecapSubtotalCategories->EventCancelled) // Update failed
			$RecapSubtotalCategories_list->restoreCurrentRowFormValues($RecapSubtotalCategories_list->RowIndex); // Restore form values
		if ($RecapSubtotalCategories->RowType == ROWTYPE_EDIT) // Edit row
			$RecapSubtotalCategories_list->EditRowCount++;

		// Set up row id / data-rowindex
		$RecapSubtotalCategories->RowAttrs->merge(["data-rowindex" => $RecapSubtotalCategories_list->RowCount, "id" => "r" . $RecapSubtotalCategories_list->RowCount . "_RecapSubtotalCategories", "data-rowtype" => $RecapSubtotalCategories->RowType]);

		// Render row
		$RecapSubtotalCategories_list->renderRow();

		// Render list options
		$RecapSubtotalCategories_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($RecapSubtotalCategories_list->RowAction != "delete" && $RecapSubtotalCategories_list->RowAction != "insertdelete" && !($RecapSubtotalCategories_list->RowAction == "insert" && $RecapSubtotalCategories->isConfirm() && $RecapSubtotalCategories_list->emptyRow())) {
?>
	<tr <?php echo $RecapSubtotalCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapSubtotalCategories_list->ListOptions->render("body", "left", $RecapSubtotalCategories_list->RowCount);
?>
	<?php if ($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->Visible) { // RecapSubtotalCategory_Idn ?>
		<td data-name="RecapSubtotalCategory_Idn" <?php echo $RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->cellAttributes() ?>>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_RecapSubtotalCategory_Idn" class="form-group"></span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_RecapSubtotalCategory_Idn" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_RecapSubtotalCategory_Idn" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_RecapSubtotalCategory_Idn" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->OldValue) ?>">
<?php } ?>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_RecapSubtotalCategory_Idn" class="form-group">
<span<?php echo $RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_RecapSubtotalCategory_Idn" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_RecapSubtotalCategory_Idn" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_RecapSubtotalCategory_Idn" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_RecapSubtotalCategory_Idn">
<span<?php echo $RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->viewAttributes() ?>><?php echo $RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapSubtotalCategories_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $RecapSubtotalCategories_list->Name->cellAttributes() ?>>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Name" class="form-group">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Name" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Name->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_Name" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Name" class="form-group">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Name" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Name->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Name">
<span<?php echo $RecapSubtotalCategories_list->Name->viewAttributes() ?>><?php echo $RecapSubtotalCategories_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapSubtotalCategories_list->Percentage->Visible) { // Percentage ?>
		<td data-name="Percentage" <?php echo $RecapSubtotalCategories_list->Percentage->cellAttributes() ?>>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Percentage" class="form-group">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Percentage" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Percentage->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Percentage->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Percentage->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_Percentage" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->Percentage->OldValue) ?>">
<?php } ?>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Percentage" class="form-group">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Percentage" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Percentage->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Percentage->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Percentage->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Percentage">
<span<?php echo $RecapSubtotalCategories_list->Percentage->viewAttributes() ?>><?php echo $RecapSubtotalCategories_list->Percentage->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapSubtotalCategories_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $RecapSubtotalCategories_list->Rank->cellAttributes() ?>>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Rank" class="form-group">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Rank" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Rank->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_Rank" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Rank" class="form-group">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Rank" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Rank->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapSubtotalCategories_list->RowCount ?>_RecapSubtotalCategories_Rank">
<span<?php echo $RecapSubtotalCategories_list->Rank->viewAttributes() ?>><?php echo $RecapSubtotalCategories_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapSubtotalCategories_list->ListOptions->render("body", "right", $RecapSubtotalCategories_list->RowCount);
?>
	</tr>
<?php if ($RecapSubtotalCategories->RowType == ROWTYPE_ADD || $RecapSubtotalCategories->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fRecapSubtotalCategorieslist", "load"], function() {
	fRecapSubtotalCategorieslist.updateLists(<?php echo $RecapSubtotalCategories_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$RecapSubtotalCategories_list->isGridAdd())
		if (!$RecapSubtotalCategories_list->Recordset->EOF)
			$RecapSubtotalCategories_list->Recordset->moveNext();
}
?>
<?php
	if ($RecapSubtotalCategories_list->isGridAdd() || $RecapSubtotalCategories_list->isGridEdit()) {
		$RecapSubtotalCategories_list->RowIndex = '$rowindex$';
		$RecapSubtotalCategories_list->loadRowValues();

		// Set row properties
		$RecapSubtotalCategories->resetAttributes();
		$RecapSubtotalCategories->RowAttrs->merge(["data-rowindex" => $RecapSubtotalCategories_list->RowIndex, "id" => "r0_RecapSubtotalCategories", "data-rowtype" => ROWTYPE_ADD]);
		$RecapSubtotalCategories->RowAttrs->appendClass("ew-template");
		$RecapSubtotalCategories->RowType = ROWTYPE_ADD;

		// Render row
		$RecapSubtotalCategories_list->renderRow();

		// Render list options
		$RecapSubtotalCategories_list->renderListOptions();
		$RecapSubtotalCategories_list->StartRowCount = 0;
?>
	<tr <?php echo $RecapSubtotalCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapSubtotalCategories_list->ListOptions->render("body", "left", $RecapSubtotalCategories_list->RowIndex);
?>
	<?php if ($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->Visible) { // RecapSubtotalCategory_Idn ?>
		<td data-name="RecapSubtotalCategory_Idn">
<span id="el$rowindex$_RecapSubtotalCategories_RecapSubtotalCategory_Idn" class="form-group RecapSubtotalCategories_RecapSubtotalCategory_Idn"></span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_RecapSubtotalCategory_Idn" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_RecapSubtotalCategory_Idn" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_RecapSubtotalCategory_Idn" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->RecapSubtotalCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapSubtotalCategories_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_RecapSubtotalCategories_Name" class="form-group RecapSubtotalCategories_Name">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Name" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Name->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_Name" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapSubtotalCategories_list->Percentage->Visible) { // Percentage ?>
		<td data-name="Percentage">
<span id="el$rowindex$_RecapSubtotalCategories_Percentage" class="form-group RecapSubtotalCategories_Percentage">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Percentage" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Percentage->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Percentage->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Percentage->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_Percentage" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Percentage" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->Percentage->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapSubtotalCategories_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_RecapSubtotalCategories_Rank" class="form-group RecapSubtotalCategories_Rank">
<input type="text" data-table="RecapSubtotalCategories" data-field="x_Rank" name="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" id="x<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapSubtotalCategories_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapSubtotalCategories_list->Rank->EditValue ?>"<?php echo $RecapSubtotalCategories_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapSubtotalCategories" data-field="x_Rank" name="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" id="o<?php echo $RecapSubtotalCategories_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RecapSubtotalCategories_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapSubtotalCategories_list->ListOptions->render("body", "right", $RecapSubtotalCategories_list->RowIndex);
?>
<script>
loadjs.ready(["fRecapSubtotalCategorieslist", "load"], function() {
	fRecapSubtotalCategorieslist.updateLists(<?php echo $RecapSubtotalCategories_list->RowIndex ?>);
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
<?php if ($RecapSubtotalCategories_list->isAdd() || $RecapSubtotalCategories_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $RecapSubtotalCategories_list->FormKeyCountName ?>" id="<?php echo $RecapSubtotalCategories_list->FormKeyCountName ?>" value="<?php echo $RecapSubtotalCategories_list->KeyCount ?>">
<?php } ?>
<?php if ($RecapSubtotalCategories_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $RecapSubtotalCategories_list->FormKeyCountName ?>" id="<?php echo $RecapSubtotalCategories_list->FormKeyCountName ?>" value="<?php echo $RecapSubtotalCategories_list->KeyCount ?>">
<?php echo $RecapSubtotalCategories_list->MultiSelectKey ?>
<?php } ?>
<?php if ($RecapSubtotalCategories_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $RecapSubtotalCategories_list->FormKeyCountName ?>" id="<?php echo $RecapSubtotalCategories_list->FormKeyCountName ?>" value="<?php echo $RecapSubtotalCategories_list->KeyCount ?>">
<?php } ?>
<?php if ($RecapSubtotalCategories_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $RecapSubtotalCategories_list->FormKeyCountName ?>" id="<?php echo $RecapSubtotalCategories_list->FormKeyCountName ?>" value="<?php echo $RecapSubtotalCategories_list->KeyCount ?>">
<?php echo $RecapSubtotalCategories_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$RecapSubtotalCategories->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($RecapSubtotalCategories_list->Recordset)
	$RecapSubtotalCategories_list->Recordset->Close();
?>
<?php if (!$RecapSubtotalCategories_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$RecapSubtotalCategories_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapSubtotalCategories_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RecapSubtotalCategories_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($RecapSubtotalCategories_list->TotalRecords == 0 && !$RecapSubtotalCategories->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $RecapSubtotalCategories_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$RecapSubtotalCategories_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$RecapSubtotalCategories_list->isExport()) { ?>
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
$RecapSubtotalCategories_list->terminate();
?>