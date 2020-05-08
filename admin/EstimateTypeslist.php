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
$EstimateTypes_list = new EstimateTypes_list();

// Run the page
$EstimateTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$EstimateTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$EstimateTypes_list->isExport()) { ?>
<script>
var fEstimateTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fEstimateTypeslist = currentForm = new ew.Form("fEstimateTypeslist", "list");
	fEstimateTypeslist.formKeyCountName = '<?php echo $EstimateTypes_list->FormKeyCountName ?>';

	// Validate form
	fEstimateTypeslist.validate = function() {
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
			<?php if ($EstimateTypes_list->EstimateType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_EstimateType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EstimateTypes_list->EstimateType_Idn->caption(), $EstimateTypes_list->EstimateType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EstimateTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EstimateTypes_list->Name->caption(), $EstimateTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EstimateTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EstimateTypes_list->Rank->caption(), $EstimateTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EstimateTypes_list->Rank->errorMessage()) ?>");
			<?php if ($EstimateTypes_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EstimateTypes_list->Department_Idn->caption(), $EstimateTypes_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EstimateTypes_list->Department_Idn->errorMessage()) ?>");
			<?php if ($EstimateTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EstimateTypes_list->ActiveFlag->caption(), $EstimateTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fEstimateTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fEstimateTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fEstimateTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fEstimateTypeslist.lists["x_ActiveFlag[]"] = <?php echo $EstimateTypes_list->ActiveFlag->Lookup->toClientList($EstimateTypes_list) ?>;
	fEstimateTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($EstimateTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fEstimateTypeslist");
});
var fEstimateTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fEstimateTypeslistsrch = currentSearchForm = new ew.Form("fEstimateTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fEstimateTypeslistsrch.filterList = <?php echo $EstimateTypes_list->getFilterList() ?>;
	loadjs.done("fEstimateTypeslistsrch");
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
<?php if (!$EstimateTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($EstimateTypes_list->TotalRecords > 0 && $EstimateTypes_list->ExportOptions->visible()) { ?>
<?php $EstimateTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($EstimateTypes_list->ImportOptions->visible()) { ?>
<?php $EstimateTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($EstimateTypes_list->SearchOptions->visible()) { ?>
<?php $EstimateTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($EstimateTypes_list->FilterOptions->visible()) { ?>
<?php $EstimateTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$EstimateTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$EstimateTypes_list->isExport() && !$EstimateTypes->CurrentAction) { ?>
<form name="fEstimateTypeslistsrch" id="fEstimateTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fEstimateTypeslistsrch-search-panel" class="<?php echo $EstimateTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="EstimateTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $EstimateTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($EstimateTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($EstimateTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $EstimateTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($EstimateTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($EstimateTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($EstimateTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($EstimateTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $EstimateTypes_list->showPageHeader(); ?>
<?php
$EstimateTypes_list->showMessage();
?>
<?php if ($EstimateTypes_list->TotalRecords > 0 || $EstimateTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($EstimateTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> EstimateTypes">
<?php if (!$EstimateTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$EstimateTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $EstimateTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $EstimateTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fEstimateTypeslist" id="fEstimateTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="EstimateTypes">
<div id="gmp_EstimateTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($EstimateTypes_list->TotalRecords > 0 || $EstimateTypes_list->isAdd() || $EstimateTypes_list->isCopy() || $EstimateTypes_list->isGridEdit()) { ?>
<table id="tbl_EstimateTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$EstimateTypes->RowType = ROWTYPE_HEADER;

// Render list options
$EstimateTypes_list->renderListOptions();

// Render list options (header, left)
$EstimateTypes_list->ListOptions->render("header", "left");
?>
<?php if ($EstimateTypes_list->EstimateType_Idn->Visible) { // EstimateType_Idn ?>
	<?php if ($EstimateTypes_list->SortUrl($EstimateTypes_list->EstimateType_Idn) == "") { ?>
		<th data-name="EstimateType_Idn" class="<?php echo $EstimateTypes_list->EstimateType_Idn->headerCellClass() ?>"><div id="elh_EstimateTypes_EstimateType_Idn" class="EstimateTypes_EstimateType_Idn"><div class="ew-table-header-caption"><?php echo $EstimateTypes_list->EstimateType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EstimateType_Idn" class="<?php echo $EstimateTypes_list->EstimateType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EstimateTypes_list->SortUrl($EstimateTypes_list->EstimateType_Idn) ?>', 1);"><div id="elh_EstimateTypes_EstimateType_Idn" class="EstimateTypes_EstimateType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EstimateTypes_list->EstimateType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($EstimateTypes_list->EstimateType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EstimateTypes_list->EstimateType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($EstimateTypes_list->Name->Visible) { // Name ?>
	<?php if ($EstimateTypes_list->SortUrl($EstimateTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $EstimateTypes_list->Name->headerCellClass() ?>"><div id="elh_EstimateTypes_Name" class="EstimateTypes_Name"><div class="ew-table-header-caption"><?php echo $EstimateTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $EstimateTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EstimateTypes_list->SortUrl($EstimateTypes_list->Name) ?>', 1);"><div id="elh_EstimateTypes_Name" class="EstimateTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EstimateTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($EstimateTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EstimateTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($EstimateTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($EstimateTypes_list->SortUrl($EstimateTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $EstimateTypes_list->Rank->headerCellClass() ?>"><div id="elh_EstimateTypes_Rank" class="EstimateTypes_Rank"><div class="ew-table-header-caption"><?php echo $EstimateTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $EstimateTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EstimateTypes_list->SortUrl($EstimateTypes_list->Rank) ?>', 1);"><div id="elh_EstimateTypes_Rank" class="EstimateTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EstimateTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($EstimateTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EstimateTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($EstimateTypes_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($EstimateTypes_list->SortUrl($EstimateTypes_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $EstimateTypes_list->Department_Idn->headerCellClass() ?>"><div id="elh_EstimateTypes_Department_Idn" class="EstimateTypes_Department_Idn"><div class="ew-table-header-caption"><?php echo $EstimateTypes_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $EstimateTypes_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EstimateTypes_list->SortUrl($EstimateTypes_list->Department_Idn) ?>', 1);"><div id="elh_EstimateTypes_Department_Idn" class="EstimateTypes_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EstimateTypes_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($EstimateTypes_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EstimateTypes_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($EstimateTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($EstimateTypes_list->SortUrl($EstimateTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $EstimateTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_EstimateTypes_ActiveFlag" class="EstimateTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $EstimateTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $EstimateTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EstimateTypes_list->SortUrl($EstimateTypes_list->ActiveFlag) ?>', 1);"><div id="elh_EstimateTypes_ActiveFlag" class="EstimateTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EstimateTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($EstimateTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EstimateTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$EstimateTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($EstimateTypes_list->isAdd() || $EstimateTypes_list->isCopy()) {
		$EstimateTypes_list->RowIndex = 0;
		$EstimateTypes_list->KeyCount = $EstimateTypes_list->RowIndex;
		if ($EstimateTypes_list->isCopy() && !$EstimateTypes_list->loadRow())
			$EstimateTypes->CurrentAction = "add";
		if ($EstimateTypes_list->isAdd())
			$EstimateTypes_list->loadRowValues();
		if ($EstimateTypes->EventCancelled) // Insert failed
			$EstimateTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$EstimateTypes->resetAttributes();
		$EstimateTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_EstimateTypes", "data-rowtype" => ROWTYPE_ADD]);
		$EstimateTypes->RowType = ROWTYPE_ADD;

		// Render row
		$EstimateTypes_list->renderRow();

		// Render list options
		$EstimateTypes_list->renderListOptions();
		$EstimateTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $EstimateTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$EstimateTypes_list->ListOptions->render("body", "left", $EstimateTypes_list->RowCount);
?>
	<?php if ($EstimateTypes_list->EstimateType_Idn->Visible) { // EstimateType_Idn ?>
		<td data-name="EstimateType_Idn">
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_EstimateType_Idn" class="form-group EstimateTypes_EstimateType_Idn"></span>
<input type="hidden" data-table="EstimateTypes" data-field="x_EstimateType_Idn" name="o<?php echo $EstimateTypes_list->RowIndex ?>_EstimateType_Idn" id="o<?php echo $EstimateTypes_list->RowIndex ?>_EstimateType_Idn" value="<?php echo HtmlEncode($EstimateTypes_list->EstimateType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Name" class="form-group EstimateTypes_Name">
<input type="text" data-table="EstimateTypes" data-field="x_Name" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Name" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Name->EditValue ?>"<?php echo $EstimateTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_Name" name="o<?php echo $EstimateTypes_list->RowIndex ?>_Name" id="o<?php echo $EstimateTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($EstimateTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Rank" class="form-group EstimateTypes_Rank">
<input type="text" data-table="EstimateTypes" data-field="x_Rank" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Rank" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Rank->EditValue ?>"<?php echo $EstimateTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_Rank" name="o<?php echo $EstimateTypes_list->RowIndex ?>_Rank" id="o<?php echo $EstimateTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($EstimateTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Department_Idn" class="form-group EstimateTypes_Department_Idn">
<input type="text" data-table="EstimateTypes" data-field="x_Department_Idn" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Department_Idn->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Department_Idn->EditValue ?>"<?php echo $EstimateTypes_list->Department_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_Department_Idn" name="o<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($EstimateTypes_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_ActiveFlag" class="form-group EstimateTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($EstimateTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="EstimateTypes" data-field="x_ActiveFlag" name="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]_705494" value="1"<?php echo $selwrk ?><?php echo $EstimateTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]_705494"></label>
</div>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_ActiveFlag" name="o<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($EstimateTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$EstimateTypes_list->ListOptions->render("body", "right", $EstimateTypes_list->RowCount);
?>
<script>
loadjs.ready(["fEstimateTypeslist", "load"], function() {
	fEstimateTypeslist.updateLists(<?php echo $EstimateTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($EstimateTypes_list->ExportAll && $EstimateTypes_list->isExport()) {
	$EstimateTypes_list->StopRecord = $EstimateTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($EstimateTypes_list->TotalRecords > $EstimateTypes_list->StartRecord + $EstimateTypes_list->DisplayRecords - 1)
		$EstimateTypes_list->StopRecord = $EstimateTypes_list->StartRecord + $EstimateTypes_list->DisplayRecords - 1;
	else
		$EstimateTypes_list->StopRecord = $EstimateTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($EstimateTypes->isConfirm() || $EstimateTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($EstimateTypes_list->FormKeyCountName) && ($EstimateTypes_list->isGridAdd() || $EstimateTypes_list->isGridEdit() || $EstimateTypes->isConfirm())) {
		$EstimateTypes_list->KeyCount = $CurrentForm->getValue($EstimateTypes_list->FormKeyCountName);
		$EstimateTypes_list->StopRecord = $EstimateTypes_list->StartRecord + $EstimateTypes_list->KeyCount - 1;
	}
}
$EstimateTypes_list->RecordCount = $EstimateTypes_list->StartRecord - 1;
if ($EstimateTypes_list->Recordset && !$EstimateTypes_list->Recordset->EOF) {
	$EstimateTypes_list->Recordset->moveFirst();
	$selectLimit = $EstimateTypes_list->UseSelectLimit;
	if (!$selectLimit && $EstimateTypes_list->StartRecord > 1)
		$EstimateTypes_list->Recordset->move($EstimateTypes_list->StartRecord - 1);
} elseif (!$EstimateTypes->AllowAddDeleteRow && $EstimateTypes_list->StopRecord == 0) {
	$EstimateTypes_list->StopRecord = $EstimateTypes->GridAddRowCount;
}

// Initialize aggregate
$EstimateTypes->RowType = ROWTYPE_AGGREGATEINIT;
$EstimateTypes->resetAttributes();
$EstimateTypes_list->renderRow();
$EstimateTypes_list->EditRowCount = 0;
if ($EstimateTypes_list->isEdit())
	$EstimateTypes_list->RowIndex = 1;
if ($EstimateTypes_list->isGridAdd())
	$EstimateTypes_list->RowIndex = 0;
if ($EstimateTypes_list->isGridEdit())
	$EstimateTypes_list->RowIndex = 0;
while ($EstimateTypes_list->RecordCount < $EstimateTypes_list->StopRecord) {
	$EstimateTypes_list->RecordCount++;
	if ($EstimateTypes_list->RecordCount >= $EstimateTypes_list->StartRecord) {
		$EstimateTypes_list->RowCount++;
		if ($EstimateTypes_list->isGridAdd() || $EstimateTypes_list->isGridEdit() || $EstimateTypes->isConfirm()) {
			$EstimateTypes_list->RowIndex++;
			$CurrentForm->Index = $EstimateTypes_list->RowIndex;
			if ($CurrentForm->hasValue($EstimateTypes_list->FormActionName) && ($EstimateTypes->isConfirm() || $EstimateTypes_list->EventCancelled))
				$EstimateTypes_list->RowAction = strval($CurrentForm->getValue($EstimateTypes_list->FormActionName));
			elseif ($EstimateTypes_list->isGridAdd())
				$EstimateTypes_list->RowAction = "insert";
			else
				$EstimateTypes_list->RowAction = "";
		}

		// Set up key count
		$EstimateTypes_list->KeyCount = $EstimateTypes_list->RowIndex;

		// Init row class and style
		$EstimateTypes->resetAttributes();
		$EstimateTypes->CssClass = "";
		if ($EstimateTypes_list->isGridAdd()) {
			$EstimateTypes_list->loadRowValues(); // Load default values
		} else {
			$EstimateTypes_list->loadRowValues($EstimateTypes_list->Recordset); // Load row values
		}
		$EstimateTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($EstimateTypes_list->isGridAdd()) // Grid add
			$EstimateTypes->RowType = ROWTYPE_ADD; // Render add
		if ($EstimateTypes_list->isGridAdd() && $EstimateTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$EstimateTypes_list->restoreCurrentRowFormValues($EstimateTypes_list->RowIndex); // Restore form values
		if ($EstimateTypes_list->isEdit()) {
			if ($EstimateTypes_list->checkInlineEditKey() && $EstimateTypes_list->EditRowCount == 0) { // Inline edit
				$EstimateTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($EstimateTypes_list->isGridEdit()) { // Grid edit
			if ($EstimateTypes->EventCancelled)
				$EstimateTypes_list->restoreCurrentRowFormValues($EstimateTypes_list->RowIndex); // Restore form values
			if ($EstimateTypes_list->RowAction == "insert")
				$EstimateTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$EstimateTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($EstimateTypes_list->isEdit() && $EstimateTypes->RowType == ROWTYPE_EDIT && $EstimateTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$EstimateTypes_list->restoreFormValues(); // Restore form values
		}
		if ($EstimateTypes_list->isGridEdit() && ($EstimateTypes->RowType == ROWTYPE_EDIT || $EstimateTypes->RowType == ROWTYPE_ADD) && $EstimateTypes->EventCancelled) // Update failed
			$EstimateTypes_list->restoreCurrentRowFormValues($EstimateTypes_list->RowIndex); // Restore form values
		if ($EstimateTypes->RowType == ROWTYPE_EDIT) // Edit row
			$EstimateTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$EstimateTypes->RowAttrs->merge(["data-rowindex" => $EstimateTypes_list->RowCount, "id" => "r" . $EstimateTypes_list->RowCount . "_EstimateTypes", "data-rowtype" => $EstimateTypes->RowType]);

		// Render row
		$EstimateTypes_list->renderRow();

		// Render list options
		$EstimateTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($EstimateTypes_list->RowAction != "delete" && $EstimateTypes_list->RowAction != "insertdelete" && !($EstimateTypes_list->RowAction == "insert" && $EstimateTypes->isConfirm() && $EstimateTypes_list->emptyRow())) {
?>
	<tr <?php echo $EstimateTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$EstimateTypes_list->ListOptions->render("body", "left", $EstimateTypes_list->RowCount);
?>
	<?php if ($EstimateTypes_list->EstimateType_Idn->Visible) { // EstimateType_Idn ?>
		<td data-name="EstimateType_Idn" <?php echo $EstimateTypes_list->EstimateType_Idn->cellAttributes() ?>>
<?php if ($EstimateTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_EstimateType_Idn" class="form-group"></span>
<input type="hidden" data-table="EstimateTypes" data-field="x_EstimateType_Idn" name="o<?php echo $EstimateTypes_list->RowIndex ?>_EstimateType_Idn" id="o<?php echo $EstimateTypes_list->RowIndex ?>_EstimateType_Idn" value="<?php echo HtmlEncode($EstimateTypes_list->EstimateType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($EstimateTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_EstimateType_Idn" class="form-group">
<span<?php echo $EstimateTypes_list->EstimateType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($EstimateTypes_list->EstimateType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_EstimateType_Idn" name="x<?php echo $EstimateTypes_list->RowIndex ?>_EstimateType_Idn" id="x<?php echo $EstimateTypes_list->RowIndex ?>_EstimateType_Idn" value="<?php echo HtmlEncode($EstimateTypes_list->EstimateType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($EstimateTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_EstimateType_Idn">
<span<?php echo $EstimateTypes_list->EstimateType_Idn->viewAttributes() ?>><?php echo $EstimateTypes_list->EstimateType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $EstimateTypes_list->Name->cellAttributes() ?>>
<?php if ($EstimateTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Name" class="form-group">
<input type="text" data-table="EstimateTypes" data-field="x_Name" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Name" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Name->EditValue ?>"<?php echo $EstimateTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_Name" name="o<?php echo $EstimateTypes_list->RowIndex ?>_Name" id="o<?php echo $EstimateTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($EstimateTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($EstimateTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Name" class="form-group">
<input type="text" data-table="EstimateTypes" data-field="x_Name" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Name" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Name->EditValue ?>"<?php echo $EstimateTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($EstimateTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Name">
<span<?php echo $EstimateTypes_list->Name->viewAttributes() ?>><?php echo $EstimateTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $EstimateTypes_list->Rank->cellAttributes() ?>>
<?php if ($EstimateTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Rank" class="form-group">
<input type="text" data-table="EstimateTypes" data-field="x_Rank" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Rank" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Rank->EditValue ?>"<?php echo $EstimateTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_Rank" name="o<?php echo $EstimateTypes_list->RowIndex ?>_Rank" id="o<?php echo $EstimateTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($EstimateTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($EstimateTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Rank" class="form-group">
<input type="text" data-table="EstimateTypes" data-field="x_Rank" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Rank" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Rank->EditValue ?>"<?php echo $EstimateTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($EstimateTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Rank">
<span<?php echo $EstimateTypes_list->Rank->viewAttributes() ?>><?php echo $EstimateTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $EstimateTypes_list->Department_Idn->cellAttributes() ?>>
<?php if ($EstimateTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Department_Idn" class="form-group">
<input type="text" data-table="EstimateTypes" data-field="x_Department_Idn" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Department_Idn->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Department_Idn->EditValue ?>"<?php echo $EstimateTypes_list->Department_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_Department_Idn" name="o<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($EstimateTypes_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($EstimateTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Department_Idn" class="form-group">
<input type="text" data-table="EstimateTypes" data-field="x_Department_Idn" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Department_Idn->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Department_Idn->EditValue ?>"<?php echo $EstimateTypes_list->Department_Idn->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($EstimateTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_Department_Idn">
<span<?php echo $EstimateTypes_list->Department_Idn->viewAttributes() ?>><?php echo $EstimateTypes_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $EstimateTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($EstimateTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($EstimateTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="EstimateTypes" data-field="x_ActiveFlag" name="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]_442696" value="1"<?php echo $selwrk ?><?php echo $EstimateTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]_442696"></label>
</div>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_ActiveFlag" name="o<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($EstimateTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($EstimateTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($EstimateTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="EstimateTypes" data-field="x_ActiveFlag" name="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]_964506" value="1"<?php echo $selwrk ?><?php echo $EstimateTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]_964506"></label>
</div>
</span>
<?php } ?>
<?php if ($EstimateTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EstimateTypes_list->RowCount ?>_EstimateTypes_ActiveFlag">
<span<?php echo $EstimateTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $EstimateTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($EstimateTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$EstimateTypes_list->ListOptions->render("body", "right", $EstimateTypes_list->RowCount);
?>
	</tr>
<?php if ($EstimateTypes->RowType == ROWTYPE_ADD || $EstimateTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fEstimateTypeslist", "load"], function() {
	fEstimateTypeslist.updateLists(<?php echo $EstimateTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$EstimateTypes_list->isGridAdd())
		if (!$EstimateTypes_list->Recordset->EOF)
			$EstimateTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($EstimateTypes_list->isGridAdd() || $EstimateTypes_list->isGridEdit()) {
		$EstimateTypes_list->RowIndex = '$rowindex$';
		$EstimateTypes_list->loadRowValues();

		// Set row properties
		$EstimateTypes->resetAttributes();
		$EstimateTypes->RowAttrs->merge(["data-rowindex" => $EstimateTypes_list->RowIndex, "id" => "r0_EstimateTypes", "data-rowtype" => ROWTYPE_ADD]);
		$EstimateTypes->RowAttrs->appendClass("ew-template");
		$EstimateTypes->RowType = ROWTYPE_ADD;

		// Render row
		$EstimateTypes_list->renderRow();

		// Render list options
		$EstimateTypes_list->renderListOptions();
		$EstimateTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $EstimateTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$EstimateTypes_list->ListOptions->render("body", "left", $EstimateTypes_list->RowIndex);
?>
	<?php if ($EstimateTypes_list->EstimateType_Idn->Visible) { // EstimateType_Idn ?>
		<td data-name="EstimateType_Idn">
<span id="el$rowindex$_EstimateTypes_EstimateType_Idn" class="form-group EstimateTypes_EstimateType_Idn"></span>
<input type="hidden" data-table="EstimateTypes" data-field="x_EstimateType_Idn" name="o<?php echo $EstimateTypes_list->RowIndex ?>_EstimateType_Idn" id="o<?php echo $EstimateTypes_list->RowIndex ?>_EstimateType_Idn" value="<?php echo HtmlEncode($EstimateTypes_list->EstimateType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_EstimateTypes_Name" class="form-group EstimateTypes_Name">
<input type="text" data-table="EstimateTypes" data-field="x_Name" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Name" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Name->EditValue ?>"<?php echo $EstimateTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_Name" name="o<?php echo $EstimateTypes_list->RowIndex ?>_Name" id="o<?php echo $EstimateTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($EstimateTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_EstimateTypes_Rank" class="form-group EstimateTypes_Rank">
<input type="text" data-table="EstimateTypes" data-field="x_Rank" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Rank" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Rank->EditValue ?>"<?php echo $EstimateTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_Rank" name="o<?php echo $EstimateTypes_list->RowIndex ?>_Rank" id="o<?php echo $EstimateTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($EstimateTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_EstimateTypes_Department_Idn" class="form-group EstimateTypes_Department_Idn">
<input type="text" data-table="EstimateTypes" data-field="x_Department_Idn" name="x<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" id="x<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EstimateTypes_list->Department_Idn->getPlaceHolder()) ?>" value="<?php echo $EstimateTypes_list->Department_Idn->EditValue ?>"<?php echo $EstimateTypes_list->Department_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_Department_Idn" name="o<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $EstimateTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($EstimateTypes_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EstimateTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_EstimateTypes_ActiveFlag" class="form-group EstimateTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($EstimateTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="EstimateTypes" data-field="x_ActiveFlag" name="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]_954959" value="1"<?php echo $selwrk ?><?php echo $EstimateTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]_954959"></label>
</div>
</span>
<input type="hidden" data-table="EstimateTypes" data-field="x_ActiveFlag" name="o<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $EstimateTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($EstimateTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$EstimateTypes_list->ListOptions->render("body", "right", $EstimateTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fEstimateTypeslist", "load"], function() {
	fEstimateTypeslist.updateLists(<?php echo $EstimateTypes_list->RowIndex ?>);
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
<?php if ($EstimateTypes_list->isAdd() || $EstimateTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $EstimateTypes_list->FormKeyCountName ?>" id="<?php echo $EstimateTypes_list->FormKeyCountName ?>" value="<?php echo $EstimateTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($EstimateTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $EstimateTypes_list->FormKeyCountName ?>" id="<?php echo $EstimateTypes_list->FormKeyCountName ?>" value="<?php echo $EstimateTypes_list->KeyCount ?>">
<?php echo $EstimateTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($EstimateTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $EstimateTypes_list->FormKeyCountName ?>" id="<?php echo $EstimateTypes_list->FormKeyCountName ?>" value="<?php echo $EstimateTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($EstimateTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $EstimateTypes_list->FormKeyCountName ?>" id="<?php echo $EstimateTypes_list->FormKeyCountName ?>" value="<?php echo $EstimateTypes_list->KeyCount ?>">
<?php echo $EstimateTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$EstimateTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($EstimateTypes_list->Recordset)
	$EstimateTypes_list->Recordset->Close();
?>
<?php if (!$EstimateTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$EstimateTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $EstimateTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $EstimateTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($EstimateTypes_list->TotalRecords == 0 && !$EstimateTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $EstimateTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$EstimateTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$EstimateTypes_list->isExport()) { ?>
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
$EstimateTypes_list->terminate();
?>