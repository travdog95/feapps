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
$ProductSizes_list = new ProductSizes_list();

// Run the page
$ProductSizes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ProductSizes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ProductSizes_list->isExport()) { ?>
<script>
var fProductSizeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fProductSizeslist = currentForm = new ew.Form("fProductSizeslist", "list");
	fProductSizeslist.formKeyCountName = '<?php echo $ProductSizes_list->FormKeyCountName ?>';

	// Validate form
	fProductSizeslist.validate = function() {
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
			<?php if ($ProductSizes_list->ProductSize_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductSize_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_list->ProductSize_Idn->caption(), $ProductSizes_list->ProductSize_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ProductSizes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_list->Name->caption(), $ProductSizes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ProductSizes_list->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_list->Value->caption(), $ProductSizes_list->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ProductSizes_list->Value->errorMessage()) ?>");
			<?php if ($ProductSizes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_list->Rank->caption(), $ProductSizes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ProductSizes_list->Rank->errorMessage()) ?>");
			<?php if ($ProductSizes_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_list->Department_Idn->caption(), $ProductSizes_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ProductSizes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductSizes_list->ActiveFlag->caption(), $ProductSizes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fProductSizeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Value", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fProductSizeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fProductSizeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fProductSizeslist.lists["x_Department_Idn"] = <?php echo $ProductSizes_list->Department_Idn->Lookup->toClientList($ProductSizes_list) ?>;
	fProductSizeslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($ProductSizes_list->Department_Idn->lookupOptions()) ?>;
	fProductSizeslist.lists["x_ActiveFlag[]"] = <?php echo $ProductSizes_list->ActiveFlag->Lookup->toClientList($ProductSizes_list) ?>;
	fProductSizeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ProductSizes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fProductSizeslist");
});
var fProductSizeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fProductSizeslistsrch = currentSearchForm = new ew.Form("fProductSizeslistsrch");

	// Validate function for search
	fProductSizeslistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fProductSizeslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fProductSizeslistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fProductSizeslistsrch.lists["x_Department_Idn"] = <?php echo $ProductSizes_list->Department_Idn->Lookup->toClientList($ProductSizes_list) ?>;
	fProductSizeslistsrch.lists["x_Department_Idn"].options = <?php echo JsonEncode($ProductSizes_list->Department_Idn->lookupOptions()) ?>;

	// Filters
	fProductSizeslistsrch.filterList = <?php echo $ProductSizes_list->getFilterList() ?>;
	loadjs.done("fProductSizeslistsrch");
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
<?php if (!$ProductSizes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ProductSizes_list->TotalRecords > 0 && $ProductSizes_list->ExportOptions->visible()) { ?>
<?php $ProductSizes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ProductSizes_list->ImportOptions->visible()) { ?>
<?php $ProductSizes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ProductSizes_list->SearchOptions->visible()) { ?>
<?php $ProductSizes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ProductSizes_list->FilterOptions->visible()) { ?>
<?php $ProductSizes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ProductSizes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ProductSizes_list->isExport() && !$ProductSizes->CurrentAction) { ?>
<form name="fProductSizeslistsrch" id="fProductSizeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fProductSizeslistsrch-search-panel" class="<?php echo $ProductSizes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ProductSizes">
	<div class="ew-extended-search">
<?php

// Render search row
$ProductSizes->RowType = ROWTYPE_SEARCH;
$ProductSizes->resetAttributes();
$ProductSizes_list->renderRow();
?>
<?php if ($ProductSizes_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php
		$ProductSizes_list->SearchColumnCount++;
		if (($ProductSizes_list->SearchColumnCount - 1) % $ProductSizes_list->SearchFieldsPerRow == 0) {
			$ProductSizes_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ProductSizes_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Department_Idn" class="ew-cell form-group">
		<label for="x_Department_Idn" class="ew-search-caption ew-label"><?php echo $ProductSizes_list->Department_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Department_Idn" id="z_Department_Idn" value="=">
</span>
		<span id="el_ProductSizes_Department_Idn" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ProductSizes" data-field="x_Department_Idn" data-value-separator="<?php echo $ProductSizes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x_Department_Idn" name="x_Department_Idn"<?php echo $ProductSizes_list->Department_Idn->editAttributes() ?>>
			<?php echo $ProductSizes_list->Department_Idn->selectOptionListHtml("x_Department_Idn") ?>
		</select>
</div>
<?php echo $ProductSizes_list->Department_Idn->Lookup->getParamTag($ProductSizes_list, "p_x_Department_Idn") ?>
</span>
	</div>
	<?php if ($ProductSizes_list->SearchColumnCount % $ProductSizes_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($ProductSizes_list->SearchColumnCount % $ProductSizes_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $ProductSizes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ProductSizes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ProductSizes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ProductSizes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ProductSizes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ProductSizes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ProductSizes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ProductSizes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ProductSizes_list->showPageHeader(); ?>
<?php
$ProductSizes_list->showMessage();
?>
<?php if ($ProductSizes_list->TotalRecords > 0 || $ProductSizes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ProductSizes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ProductSizes">
<?php if (!$ProductSizes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ProductSizes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ProductSizes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ProductSizes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fProductSizeslist" id="fProductSizeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ProductSizes">
<div id="gmp_ProductSizes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ProductSizes_list->TotalRecords > 0 || $ProductSizes_list->isAdd() || $ProductSizes_list->isCopy() || $ProductSizes_list->isGridEdit()) { ?>
<table id="tbl_ProductSizeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ProductSizes->RowType = ROWTYPE_HEADER;

// Render list options
$ProductSizes_list->renderListOptions();

// Render list options (header, left)
$ProductSizes_list->ListOptions->render("header", "left");
?>
<?php if ($ProductSizes_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
	<?php if ($ProductSizes_list->SortUrl($ProductSizes_list->ProductSize_Idn) == "") { ?>
		<th data-name="ProductSize_Idn" class="<?php echo $ProductSizes_list->ProductSize_Idn->headerCellClass() ?>"><div id="elh_ProductSizes_ProductSize_Idn" class="ProductSizes_ProductSize_Idn"><div class="ew-table-header-caption"><?php echo $ProductSizes_list->ProductSize_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductSize_Idn" class="<?php echo $ProductSizes_list->ProductSize_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ProductSizes_list->SortUrl($ProductSizes_list->ProductSize_Idn) ?>', 1);"><div id="elh_ProductSizes_ProductSize_Idn" class="ProductSizes_ProductSize_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ProductSizes_list->ProductSize_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($ProductSizes_list->ProductSize_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ProductSizes_list->ProductSize_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ProductSizes_list->Name->Visible) { // Name ?>
	<?php if ($ProductSizes_list->SortUrl($ProductSizes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $ProductSizes_list->Name->headerCellClass() ?>"><div id="elh_ProductSizes_Name" class="ProductSizes_Name"><div class="ew-table-header-caption"><?php echo $ProductSizes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $ProductSizes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ProductSizes_list->SortUrl($ProductSizes_list->Name) ?>', 1);"><div id="elh_ProductSizes_Name" class="ProductSizes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ProductSizes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ProductSizes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ProductSizes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ProductSizes_list->Value->Visible) { // Value ?>
	<?php if ($ProductSizes_list->SortUrl($ProductSizes_list->Value) == "") { ?>
		<th data-name="Value" class="<?php echo $ProductSizes_list->Value->headerCellClass() ?>"><div id="elh_ProductSizes_Value" class="ProductSizes_Value"><div class="ew-table-header-caption"><?php echo $ProductSizes_list->Value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Value" class="<?php echo $ProductSizes_list->Value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ProductSizes_list->SortUrl($ProductSizes_list->Value) ?>', 1);"><div id="elh_ProductSizes_Value" class="ProductSizes_Value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ProductSizes_list->Value->caption() ?></span><span class="ew-table-header-sort"><?php if ($ProductSizes_list->Value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ProductSizes_list->Value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ProductSizes_list->Rank->Visible) { // Rank ?>
	<?php if ($ProductSizes_list->SortUrl($ProductSizes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $ProductSizes_list->Rank->headerCellClass() ?>"><div id="elh_ProductSizes_Rank" class="ProductSizes_Rank"><div class="ew-table-header-caption"><?php echo $ProductSizes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $ProductSizes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ProductSizes_list->SortUrl($ProductSizes_list->Rank) ?>', 1);"><div id="elh_ProductSizes_Rank" class="ProductSizes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ProductSizes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($ProductSizes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ProductSizes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ProductSizes_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($ProductSizes_list->SortUrl($ProductSizes_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $ProductSizes_list->Department_Idn->headerCellClass() ?>"><div id="elh_ProductSizes_Department_Idn" class="ProductSizes_Department_Idn"><div class="ew-table-header-caption"><?php echo $ProductSizes_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $ProductSizes_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ProductSizes_list->SortUrl($ProductSizes_list->Department_Idn) ?>', 1);"><div id="elh_ProductSizes_Department_Idn" class="ProductSizes_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ProductSizes_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($ProductSizes_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ProductSizes_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ProductSizes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($ProductSizes_list->SortUrl($ProductSizes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $ProductSizes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_ProductSizes_ActiveFlag" class="ProductSizes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $ProductSizes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $ProductSizes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ProductSizes_list->SortUrl($ProductSizes_list->ActiveFlag) ?>', 1);"><div id="elh_ProductSizes_ActiveFlag" class="ProductSizes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ProductSizes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($ProductSizes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ProductSizes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ProductSizes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($ProductSizes_list->isAdd() || $ProductSizes_list->isCopy()) {
		$ProductSizes_list->RowIndex = 0;
		$ProductSizes_list->KeyCount = $ProductSizes_list->RowIndex;
		if ($ProductSizes_list->isCopy() && !$ProductSizes_list->loadRow())
			$ProductSizes->CurrentAction = "add";
		if ($ProductSizes_list->isAdd())
			$ProductSizes_list->loadRowValues();
		if ($ProductSizes->EventCancelled) // Insert failed
			$ProductSizes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$ProductSizes->resetAttributes();
		$ProductSizes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_ProductSizes", "data-rowtype" => ROWTYPE_ADD]);
		$ProductSizes->RowType = ROWTYPE_ADD;

		// Render row
		$ProductSizes_list->renderRow();

		// Render list options
		$ProductSizes_list->renderListOptions();
		$ProductSizes_list->StartRowCount = 0;
?>
	<tr <?php echo $ProductSizes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ProductSizes_list->ListOptions->render("body", "left", $ProductSizes_list->RowCount);
?>
	<?php if ($ProductSizes_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td data-name="ProductSize_Idn">
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_ProductSize_Idn" class="form-group ProductSizes_ProductSize_Idn"></span>
<input type="hidden" data-table="ProductSizes" data-field="x_ProductSize_Idn" name="o<?php echo $ProductSizes_list->RowIndex ?>_ProductSize_Idn" id="o<?php echo $ProductSizes_list->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($ProductSizes_list->ProductSize_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Name" class="form-group ProductSizes_Name">
<input type="text" data-table="ProductSizes" data-field="x_Name" name="x<?php echo $ProductSizes_list->RowIndex ?>_Name" id="x<?php echo $ProductSizes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ProductSizes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Name->EditValue ?>"<?php echo $ProductSizes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Name" name="o<?php echo $ProductSizes_list->RowIndex ?>_Name" id="o<?php echo $ProductSizes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ProductSizes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Value" class="form-group ProductSizes_Value">
<input type="text" data-table="ProductSizes" data-field="x_Value" name="x<?php echo $ProductSizes_list->RowIndex ?>_Value" id="x<?php echo $ProductSizes_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ProductSizes_list->Value->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Value->EditValue ?>"<?php echo $ProductSizes_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Value" name="o<?php echo $ProductSizes_list->RowIndex ?>_Value" id="o<?php echo $ProductSizes_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($ProductSizes_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Rank" class="form-group ProductSizes_Rank">
<input type="text" data-table="ProductSizes" data-field="x_Rank" name="x<?php echo $ProductSizes_list->RowIndex ?>_Rank" id="x<?php echo $ProductSizes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ProductSizes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Rank->EditValue ?>"<?php echo $ProductSizes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Rank" name="o<?php echo $ProductSizes_list->RowIndex ?>_Rank" id="o<?php echo $ProductSizes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ProductSizes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Department_Idn" class="form-group ProductSizes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ProductSizes" data-field="x_Department_Idn" data-value-separator="<?php echo $ProductSizes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn" name="x<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn"<?php echo $ProductSizes_list->Department_Idn->editAttributes() ?>>
			<?php echo $ProductSizes_list->Department_Idn->selectOptionListHtml("x{$ProductSizes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $ProductSizes_list->Department_Idn->Lookup->getParamTag($ProductSizes_list, "p_x" . $ProductSizes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Department_Idn" name="o<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn" id="o<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($ProductSizes_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_ActiveFlag" class="form-group ProductSizes_ActiveFlag">
<?php
$selwrk = ConvertToBool($ProductSizes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ProductSizes" data-field="x_ActiveFlag" name="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]_781506" value="1"<?php echo $selwrk ?><?php echo $ProductSizes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]_781506"></label>
</div>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_ActiveFlag" name="o<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ProductSizes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ProductSizes_list->ListOptions->render("body", "right", $ProductSizes_list->RowCount);
?>
<script>
loadjs.ready(["fProductSizeslist", "load"], function() {
	fProductSizeslist.updateLists(<?php echo $ProductSizes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($ProductSizes_list->ExportAll && $ProductSizes_list->isExport()) {
	$ProductSizes_list->StopRecord = $ProductSizes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ProductSizes_list->TotalRecords > $ProductSizes_list->StartRecord + $ProductSizes_list->DisplayRecords - 1)
		$ProductSizes_list->StopRecord = $ProductSizes_list->StartRecord + $ProductSizes_list->DisplayRecords - 1;
	else
		$ProductSizes_list->StopRecord = $ProductSizes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($ProductSizes->isConfirm() || $ProductSizes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ProductSizes_list->FormKeyCountName) && ($ProductSizes_list->isGridAdd() || $ProductSizes_list->isGridEdit() || $ProductSizes->isConfirm())) {
		$ProductSizes_list->KeyCount = $CurrentForm->getValue($ProductSizes_list->FormKeyCountName);
		$ProductSizes_list->StopRecord = $ProductSizes_list->StartRecord + $ProductSizes_list->KeyCount - 1;
	}
}
$ProductSizes_list->RecordCount = $ProductSizes_list->StartRecord - 1;
if ($ProductSizes_list->Recordset && !$ProductSizes_list->Recordset->EOF) {
	$ProductSizes_list->Recordset->moveFirst();
	$selectLimit = $ProductSizes_list->UseSelectLimit;
	if (!$selectLimit && $ProductSizes_list->StartRecord > 1)
		$ProductSizes_list->Recordset->move($ProductSizes_list->StartRecord - 1);
} elseif (!$ProductSizes->AllowAddDeleteRow && $ProductSizes_list->StopRecord == 0) {
	$ProductSizes_list->StopRecord = $ProductSizes->GridAddRowCount;
}

// Initialize aggregate
$ProductSizes->RowType = ROWTYPE_AGGREGATEINIT;
$ProductSizes->resetAttributes();
$ProductSizes_list->renderRow();
$ProductSizes_list->EditRowCount = 0;
if ($ProductSizes_list->isEdit())
	$ProductSizes_list->RowIndex = 1;
if ($ProductSizes_list->isGridAdd())
	$ProductSizes_list->RowIndex = 0;
if ($ProductSizes_list->isGridEdit())
	$ProductSizes_list->RowIndex = 0;
while ($ProductSizes_list->RecordCount < $ProductSizes_list->StopRecord) {
	$ProductSizes_list->RecordCount++;
	if ($ProductSizes_list->RecordCount >= $ProductSizes_list->StartRecord) {
		$ProductSizes_list->RowCount++;
		if ($ProductSizes_list->isGridAdd() || $ProductSizes_list->isGridEdit() || $ProductSizes->isConfirm()) {
			$ProductSizes_list->RowIndex++;
			$CurrentForm->Index = $ProductSizes_list->RowIndex;
			if ($CurrentForm->hasValue($ProductSizes_list->FormActionName) && ($ProductSizes->isConfirm() || $ProductSizes_list->EventCancelled))
				$ProductSizes_list->RowAction = strval($CurrentForm->getValue($ProductSizes_list->FormActionName));
			elseif ($ProductSizes_list->isGridAdd())
				$ProductSizes_list->RowAction = "insert";
			else
				$ProductSizes_list->RowAction = "";
		}

		// Set up key count
		$ProductSizes_list->KeyCount = $ProductSizes_list->RowIndex;

		// Init row class and style
		$ProductSizes->resetAttributes();
		$ProductSizes->CssClass = "";
		if ($ProductSizes_list->isGridAdd()) {
			$ProductSizes_list->loadRowValues(); // Load default values
		} else {
			$ProductSizes_list->loadRowValues($ProductSizes_list->Recordset); // Load row values
		}
		$ProductSizes->RowType = ROWTYPE_VIEW; // Render view
		if ($ProductSizes_list->isGridAdd()) // Grid add
			$ProductSizes->RowType = ROWTYPE_ADD; // Render add
		if ($ProductSizes_list->isGridAdd() && $ProductSizes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ProductSizes_list->restoreCurrentRowFormValues($ProductSizes_list->RowIndex); // Restore form values
		if ($ProductSizes_list->isEdit()) {
			if ($ProductSizes_list->checkInlineEditKey() && $ProductSizes_list->EditRowCount == 0) { // Inline edit
				$ProductSizes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($ProductSizes_list->isGridEdit()) { // Grid edit
			if ($ProductSizes->EventCancelled)
				$ProductSizes_list->restoreCurrentRowFormValues($ProductSizes_list->RowIndex); // Restore form values
			if ($ProductSizes_list->RowAction == "insert")
				$ProductSizes->RowType = ROWTYPE_ADD; // Render add
			else
				$ProductSizes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ProductSizes_list->isEdit() && $ProductSizes->RowType == ROWTYPE_EDIT && $ProductSizes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$ProductSizes_list->restoreFormValues(); // Restore form values
		}
		if ($ProductSizes_list->isGridEdit() && ($ProductSizes->RowType == ROWTYPE_EDIT || $ProductSizes->RowType == ROWTYPE_ADD) && $ProductSizes->EventCancelled) // Update failed
			$ProductSizes_list->restoreCurrentRowFormValues($ProductSizes_list->RowIndex); // Restore form values
		if ($ProductSizes->RowType == ROWTYPE_EDIT) // Edit row
			$ProductSizes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$ProductSizes->RowAttrs->merge(["data-rowindex" => $ProductSizes_list->RowCount, "id" => "r" . $ProductSizes_list->RowCount . "_ProductSizes", "data-rowtype" => $ProductSizes->RowType]);

		// Render row
		$ProductSizes_list->renderRow();

		// Render list options
		$ProductSizes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ProductSizes_list->RowAction != "delete" && $ProductSizes_list->RowAction != "insertdelete" && !($ProductSizes_list->RowAction == "insert" && $ProductSizes->isConfirm() && $ProductSizes_list->emptyRow())) {
?>
	<tr <?php echo $ProductSizes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ProductSizes_list->ListOptions->render("body", "left", $ProductSizes_list->RowCount);
?>
	<?php if ($ProductSizes_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td data-name="ProductSize_Idn" <?php echo $ProductSizes_list->ProductSize_Idn->cellAttributes() ?>>
<?php if ($ProductSizes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_ProductSize_Idn" class="form-group"></span>
<input type="hidden" data-table="ProductSizes" data-field="x_ProductSize_Idn" name="o<?php echo $ProductSizes_list->RowIndex ?>_ProductSize_Idn" id="o<?php echo $ProductSizes_list->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($ProductSizes_list->ProductSize_Idn->OldValue) ?>">
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_ProductSize_Idn" class="form-group">
<span<?php echo $ProductSizes_list->ProductSize_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ProductSizes_list->ProductSize_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_ProductSize_Idn" name="x<?php echo $ProductSizes_list->RowIndex ?>_ProductSize_Idn" id="x<?php echo $ProductSizes_list->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($ProductSizes_list->ProductSize_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_ProductSize_Idn">
<span<?php echo $ProductSizes_list->ProductSize_Idn->viewAttributes() ?>><?php echo $ProductSizes_list->ProductSize_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $ProductSizes_list->Name->cellAttributes() ?>>
<?php if ($ProductSizes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Name" class="form-group">
<input type="text" data-table="ProductSizes" data-field="x_Name" name="x<?php echo $ProductSizes_list->RowIndex ?>_Name" id="x<?php echo $ProductSizes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ProductSizes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Name->EditValue ?>"<?php echo $ProductSizes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Name" name="o<?php echo $ProductSizes_list->RowIndex ?>_Name" id="o<?php echo $ProductSizes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ProductSizes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Name" class="form-group">
<input type="text" data-table="ProductSizes" data-field="x_Name" name="x<?php echo $ProductSizes_list->RowIndex ?>_Name" id="x<?php echo $ProductSizes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ProductSizes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Name->EditValue ?>"<?php echo $ProductSizes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Name">
<span<?php echo $ProductSizes_list->Name->viewAttributes() ?>><?php echo $ProductSizes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Value->Visible) { // Value ?>
		<td data-name="Value" <?php echo $ProductSizes_list->Value->cellAttributes() ?>>
<?php if ($ProductSizes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Value" class="form-group">
<input type="text" data-table="ProductSizes" data-field="x_Value" name="x<?php echo $ProductSizes_list->RowIndex ?>_Value" id="x<?php echo $ProductSizes_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ProductSizes_list->Value->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Value->EditValue ?>"<?php echo $ProductSizes_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Value" name="o<?php echo $ProductSizes_list->RowIndex ?>_Value" id="o<?php echo $ProductSizes_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($ProductSizes_list->Value->OldValue) ?>">
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Value" class="form-group">
<input type="text" data-table="ProductSizes" data-field="x_Value" name="x<?php echo $ProductSizes_list->RowIndex ?>_Value" id="x<?php echo $ProductSizes_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ProductSizes_list->Value->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Value->EditValue ?>"<?php echo $ProductSizes_list->Value->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Value">
<span<?php echo $ProductSizes_list->Value->viewAttributes() ?>><?php echo $ProductSizes_list->Value->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $ProductSizes_list->Rank->cellAttributes() ?>>
<?php if ($ProductSizes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Rank" class="form-group">
<input type="text" data-table="ProductSizes" data-field="x_Rank" name="x<?php echo $ProductSizes_list->RowIndex ?>_Rank" id="x<?php echo $ProductSizes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ProductSizes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Rank->EditValue ?>"<?php echo $ProductSizes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Rank" name="o<?php echo $ProductSizes_list->RowIndex ?>_Rank" id="o<?php echo $ProductSizes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ProductSizes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Rank" class="form-group">
<input type="text" data-table="ProductSizes" data-field="x_Rank" name="x<?php echo $ProductSizes_list->RowIndex ?>_Rank" id="x<?php echo $ProductSizes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ProductSizes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Rank->EditValue ?>"<?php echo $ProductSizes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Rank">
<span<?php echo $ProductSizes_list->Rank->viewAttributes() ?>><?php echo $ProductSizes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $ProductSizes_list->Department_Idn->cellAttributes() ?>>
<?php if ($ProductSizes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ProductSizes" data-field="x_Department_Idn" data-value-separator="<?php echo $ProductSizes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn" name="x<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn"<?php echo $ProductSizes_list->Department_Idn->editAttributes() ?>>
			<?php echo $ProductSizes_list->Department_Idn->selectOptionListHtml("x{$ProductSizes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $ProductSizes_list->Department_Idn->Lookup->getParamTag($ProductSizes_list, "p_x" . $ProductSizes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Department_Idn" name="o<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn" id="o<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($ProductSizes_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ProductSizes" data-field="x_Department_Idn" data-value-separator="<?php echo $ProductSizes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn" name="x<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn"<?php echo $ProductSizes_list->Department_Idn->editAttributes() ?>>
			<?php echo $ProductSizes_list->Department_Idn->selectOptionListHtml("x{$ProductSizes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $ProductSizes_list->Department_Idn->Lookup->getParamTag($ProductSizes_list, "p_x" . $ProductSizes_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_Department_Idn">
<span<?php echo $ProductSizes_list->Department_Idn->viewAttributes() ?>><?php echo $ProductSizes_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $ProductSizes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($ProductSizes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ProductSizes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ProductSizes" data-field="x_ActiveFlag" name="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]_570458" value="1"<?php echo $selwrk ?><?php echo $ProductSizes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]_570458"></label>
</div>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_ActiveFlag" name="o<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ProductSizes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ProductSizes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ProductSizes" data-field="x_ActiveFlag" name="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]_687857" value="1"<?php echo $selwrk ?><?php echo $ProductSizes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]_687857"></label>
</div>
</span>
<?php } ?>
<?php if ($ProductSizes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ProductSizes_list->RowCount ?>_ProductSizes_ActiveFlag">
<span<?php echo $ProductSizes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ProductSizes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ProductSizes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ProductSizes_list->ListOptions->render("body", "right", $ProductSizes_list->RowCount);
?>
	</tr>
<?php if ($ProductSizes->RowType == ROWTYPE_ADD || $ProductSizes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fProductSizeslist", "load"], function() {
	fProductSizeslist.updateLists(<?php echo $ProductSizes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ProductSizes_list->isGridAdd())
		if (!$ProductSizes_list->Recordset->EOF)
			$ProductSizes_list->Recordset->moveNext();
}
?>
<?php
	if ($ProductSizes_list->isGridAdd() || $ProductSizes_list->isGridEdit()) {
		$ProductSizes_list->RowIndex = '$rowindex$';
		$ProductSizes_list->loadRowValues();

		// Set row properties
		$ProductSizes->resetAttributes();
		$ProductSizes->RowAttrs->merge(["data-rowindex" => $ProductSizes_list->RowIndex, "id" => "r0_ProductSizes", "data-rowtype" => ROWTYPE_ADD]);
		$ProductSizes->RowAttrs->appendClass("ew-template");
		$ProductSizes->RowType = ROWTYPE_ADD;

		// Render row
		$ProductSizes_list->renderRow();

		// Render list options
		$ProductSizes_list->renderListOptions();
		$ProductSizes_list->StartRowCount = 0;
?>
	<tr <?php echo $ProductSizes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ProductSizes_list->ListOptions->render("body", "left", $ProductSizes_list->RowIndex);
?>
	<?php if ($ProductSizes_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td data-name="ProductSize_Idn">
<span id="el$rowindex$_ProductSizes_ProductSize_Idn" class="form-group ProductSizes_ProductSize_Idn"></span>
<input type="hidden" data-table="ProductSizes" data-field="x_ProductSize_Idn" name="o<?php echo $ProductSizes_list->RowIndex ?>_ProductSize_Idn" id="o<?php echo $ProductSizes_list->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($ProductSizes_list->ProductSize_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_ProductSizes_Name" class="form-group ProductSizes_Name">
<input type="text" data-table="ProductSizes" data-field="x_Name" name="x<?php echo $ProductSizes_list->RowIndex ?>_Name" id="x<?php echo $ProductSizes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ProductSizes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Name->EditValue ?>"<?php echo $ProductSizes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Name" name="o<?php echo $ProductSizes_list->RowIndex ?>_Name" id="o<?php echo $ProductSizes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ProductSizes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el$rowindex$_ProductSizes_Value" class="form-group ProductSizes_Value">
<input type="text" data-table="ProductSizes" data-field="x_Value" name="x<?php echo $ProductSizes_list->RowIndex ?>_Value" id="x<?php echo $ProductSizes_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ProductSizes_list->Value->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Value->EditValue ?>"<?php echo $ProductSizes_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Value" name="o<?php echo $ProductSizes_list->RowIndex ?>_Value" id="o<?php echo $ProductSizes_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($ProductSizes_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_ProductSizes_Rank" class="form-group ProductSizes_Rank">
<input type="text" data-table="ProductSizes" data-field="x_Rank" name="x<?php echo $ProductSizes_list->RowIndex ?>_Rank" id="x<?php echo $ProductSizes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ProductSizes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ProductSizes_list->Rank->EditValue ?>"<?php echo $ProductSizes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Rank" name="o<?php echo $ProductSizes_list->RowIndex ?>_Rank" id="o<?php echo $ProductSizes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ProductSizes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_ProductSizes_Department_Idn" class="form-group ProductSizes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ProductSizes" data-field="x_Department_Idn" data-value-separator="<?php echo $ProductSizes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn" name="x<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn"<?php echo $ProductSizes_list->Department_Idn->editAttributes() ?>>
			<?php echo $ProductSizes_list->Department_Idn->selectOptionListHtml("x{$ProductSizes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $ProductSizes_list->Department_Idn->Lookup->getParamTag($ProductSizes_list, "p_x" . $ProductSizes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_Department_Idn" name="o<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn" id="o<?php echo $ProductSizes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($ProductSizes_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ProductSizes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_ProductSizes_ActiveFlag" class="form-group ProductSizes_ActiveFlag">
<?php
$selwrk = ConvertToBool($ProductSizes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ProductSizes" data-field="x_ActiveFlag" name="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]_247026" value="1"<?php echo $selwrk ?><?php echo $ProductSizes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]_247026"></label>
</div>
</span>
<input type="hidden" data-table="ProductSizes" data-field="x_ActiveFlag" name="o<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ProductSizes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ProductSizes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ProductSizes_list->ListOptions->render("body", "right", $ProductSizes_list->RowIndex);
?>
<script>
loadjs.ready(["fProductSizeslist", "load"], function() {
	fProductSizeslist.updateLists(<?php echo $ProductSizes_list->RowIndex ?>);
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
<?php if ($ProductSizes_list->isAdd() || $ProductSizes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $ProductSizes_list->FormKeyCountName ?>" id="<?php echo $ProductSizes_list->FormKeyCountName ?>" value="<?php echo $ProductSizes_list->KeyCount ?>">
<?php } ?>
<?php if ($ProductSizes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $ProductSizes_list->FormKeyCountName ?>" id="<?php echo $ProductSizes_list->FormKeyCountName ?>" value="<?php echo $ProductSizes_list->KeyCount ?>">
<?php echo $ProductSizes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($ProductSizes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $ProductSizes_list->FormKeyCountName ?>" id="<?php echo $ProductSizes_list->FormKeyCountName ?>" value="<?php echo $ProductSizes_list->KeyCount ?>">
<?php } ?>
<?php if ($ProductSizes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $ProductSizes_list->FormKeyCountName ?>" id="<?php echo $ProductSizes_list->FormKeyCountName ?>" value="<?php echo $ProductSizes_list->KeyCount ?>">
<?php echo $ProductSizes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$ProductSizes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ProductSizes_list->Recordset)
	$ProductSizes_list->Recordset->Close();
?>
<?php if (!$ProductSizes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ProductSizes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ProductSizes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ProductSizes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ProductSizes_list->TotalRecords == 0 && !$ProductSizes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ProductSizes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ProductSizes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ProductSizes_list->isExport()) { ?>
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
$ProductSizes_list->terminate();
?>