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
$PipeTypes_list = new PipeTypes_list();

// Run the page
$PipeTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$PipeTypes_list->isExport()) { ?>
<script>
var fPipeTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fPipeTypeslist = currentForm = new ew.Form("fPipeTypeslist", "list");
	fPipeTypeslist.formKeyCountName = '<?php echo $PipeTypes_list->FormKeyCountName ?>';

	// Validate form
	fPipeTypeslist.validate = function() {
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
			<?php if ($PipeTypes_list->PipeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PipeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_list->PipeType_Idn->caption(), $PipeTypes_list->PipeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_list->Name->caption(), $PipeTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeTypes_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_list->Department_Idn->caption(), $PipeTypes_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeTypes_list->IsUnderground->Required) { ?>
				elm = this.getElements("x" + infix + "_IsUnderground[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_list->IsUnderground->caption(), $PipeTypes_list->IsUnderground->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_list->Rank->caption(), $PipeTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PipeTypes_list->Rank->errorMessage()) ?>");
			<?php if ($PipeTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeTypes_list->ActiveFlag->caption(), $PipeTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fPipeTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "IsUnderground[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fPipeTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPipeTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fPipeTypeslist.lists["x_Department_Idn"] = <?php echo $PipeTypes_list->Department_Idn->Lookup->toClientList($PipeTypes_list) ?>;
	fPipeTypeslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($PipeTypes_list->Department_Idn->lookupOptions()) ?>;
	fPipeTypeslist.lists["x_IsUnderground[]"] = <?php echo $PipeTypes_list->IsUnderground->Lookup->toClientList($PipeTypes_list) ?>;
	fPipeTypeslist.lists["x_IsUnderground[]"].options = <?php echo JsonEncode($PipeTypes_list->IsUnderground->options(FALSE, TRUE)) ?>;
	fPipeTypeslist.lists["x_ActiveFlag[]"] = <?php echo $PipeTypes_list->ActiveFlag->Lookup->toClientList($PipeTypes_list) ?>;
	fPipeTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($PipeTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fPipeTypeslist");
});
var fPipeTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fPipeTypeslistsrch = currentSearchForm = new ew.Form("fPipeTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fPipeTypeslistsrch.filterList = <?php echo $PipeTypes_list->getFilterList() ?>;
	loadjs.done("fPipeTypeslistsrch");
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
<?php if (!$PipeTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($PipeTypes_list->TotalRecords > 0 && $PipeTypes_list->ExportOptions->visible()) { ?>
<?php $PipeTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($PipeTypes_list->ImportOptions->visible()) { ?>
<?php $PipeTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($PipeTypes_list->SearchOptions->visible()) { ?>
<?php $PipeTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($PipeTypes_list->FilterOptions->visible()) { ?>
<?php $PipeTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$PipeTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$PipeTypes_list->isExport() && !$PipeTypes->CurrentAction) { ?>
<form name="fPipeTypeslistsrch" id="fPipeTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fPipeTypeslistsrch-search-panel" class="<?php echo $PipeTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="PipeTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $PipeTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($PipeTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($PipeTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $PipeTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($PipeTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($PipeTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($PipeTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($PipeTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $PipeTypes_list->showPageHeader(); ?>
<?php
$PipeTypes_list->showMessage();
?>
<?php if ($PipeTypes_list->TotalRecords > 0 || $PipeTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($PipeTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> PipeTypes">
<?php if (!$PipeTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$PipeTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PipeTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $PipeTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fPipeTypeslist" id="fPipeTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeTypes">
<div id="gmp_PipeTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($PipeTypes_list->TotalRecords > 0 || $PipeTypes_list->isAdd() || $PipeTypes_list->isCopy() || $PipeTypes_list->isGridEdit()) { ?>
<table id="tbl_PipeTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$PipeTypes->RowType = ROWTYPE_HEADER;

// Render list options
$PipeTypes_list->renderListOptions();

// Render list options (header, left)
$PipeTypes_list->ListOptions->render("header", "left");
?>
<?php if ($PipeTypes_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
	<?php if ($PipeTypes_list->SortUrl($PipeTypes_list->PipeType_Idn) == "") { ?>
		<th data-name="PipeType_Idn" class="<?php echo $PipeTypes_list->PipeType_Idn->headerCellClass() ?>"><div id="elh_PipeTypes_PipeType_Idn" class="PipeTypes_PipeType_Idn"><div class="ew-table-header-caption"><?php echo $PipeTypes_list->PipeType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PipeType_Idn" class="<?php echo $PipeTypes_list->PipeType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeTypes_list->SortUrl($PipeTypes_list->PipeType_Idn) ?>', 1);"><div id="elh_PipeTypes_PipeType_Idn" class="PipeTypes_PipeType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeTypes_list->PipeType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeTypes_list->PipeType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeTypes_list->PipeType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeTypes_list->Name->Visible) { // Name ?>
	<?php if ($PipeTypes_list->SortUrl($PipeTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $PipeTypes_list->Name->headerCellClass() ?>"><div id="elh_PipeTypes_Name" class="PipeTypes_Name"><div class="ew-table-header-caption"><?php echo $PipeTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $PipeTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeTypes_list->SortUrl($PipeTypes_list->Name) ?>', 1);"><div id="elh_PipeTypes_Name" class="PipeTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PipeTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeTypes_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($PipeTypes_list->SortUrl($PipeTypes_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $PipeTypes_list->Department_Idn->headerCellClass() ?>"><div id="elh_PipeTypes_Department_Idn" class="PipeTypes_Department_Idn"><div class="ew-table-header-caption"><?php echo $PipeTypes_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $PipeTypes_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeTypes_list->SortUrl($PipeTypes_list->Department_Idn) ?>', 1);"><div id="elh_PipeTypes_Department_Idn" class="PipeTypes_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeTypes_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeTypes_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeTypes_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeTypes_list->IsUnderground->Visible) { // IsUnderground ?>
	<?php if ($PipeTypes_list->SortUrl($PipeTypes_list->IsUnderground) == "") { ?>
		<th data-name="IsUnderground" class="<?php echo $PipeTypes_list->IsUnderground->headerCellClass() ?>"><div id="elh_PipeTypes_IsUnderground" class="PipeTypes_IsUnderground"><div class="ew-table-header-caption"><?php echo $PipeTypes_list->IsUnderground->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsUnderground" class="<?php echo $PipeTypes_list->IsUnderground->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeTypes_list->SortUrl($PipeTypes_list->IsUnderground) ?>', 1);"><div id="elh_PipeTypes_IsUnderground" class="PipeTypes_IsUnderground">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeTypes_list->IsUnderground->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeTypes_list->IsUnderground->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeTypes_list->IsUnderground->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($PipeTypes_list->SortUrl($PipeTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $PipeTypes_list->Rank->headerCellClass() ?>"><div id="elh_PipeTypes_Rank" class="PipeTypes_Rank"><div class="ew-table-header-caption"><?php echo $PipeTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $PipeTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeTypes_list->SortUrl($PipeTypes_list->Rank) ?>', 1);"><div id="elh_PipeTypes_Rank" class="PipeTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($PipeTypes_list->SortUrl($PipeTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $PipeTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_PipeTypes_ActiveFlag" class="PipeTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $PipeTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $PipeTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeTypes_list->SortUrl($PipeTypes_list->ActiveFlag) ?>', 1);"><div id="elh_PipeTypes_ActiveFlag" class="PipeTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$PipeTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($PipeTypes_list->isAdd() || $PipeTypes_list->isCopy()) {
		$PipeTypes_list->RowIndex = 0;
		$PipeTypes_list->KeyCount = $PipeTypes_list->RowIndex;
		if ($PipeTypes_list->isCopy() && !$PipeTypes_list->loadRow())
			$PipeTypes->CurrentAction = "add";
		if ($PipeTypes_list->isAdd())
			$PipeTypes_list->loadRowValues();
		if ($PipeTypes->EventCancelled) // Insert failed
			$PipeTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$PipeTypes->resetAttributes();
		$PipeTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_PipeTypes", "data-rowtype" => ROWTYPE_ADD]);
		$PipeTypes->RowType = ROWTYPE_ADD;

		// Render row
		$PipeTypes_list->renderRow();

		// Render list options
		$PipeTypes_list->renderListOptions();
		$PipeTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $PipeTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PipeTypes_list->ListOptions->render("body", "left", $PipeTypes_list->RowCount);
?>
	<?php if ($PipeTypes_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td data-name="PipeType_Idn">
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_PipeType_Idn" class="form-group PipeTypes_PipeType_Idn"></span>
<input type="hidden" data-table="PipeTypes" data-field="x_PipeType_Idn" name="o<?php echo $PipeTypes_list->RowIndex ?>_PipeType_Idn" id="o<?php echo $PipeTypes_list->RowIndex ?>_PipeType_Idn" value="<?php echo HtmlEncode($PipeTypes_list->PipeType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Name" class="form-group PipeTypes_Name">
<input type="text" data-table="PipeTypes" data-field="x_Name" name="x<?php echo $PipeTypes_list->RowIndex ?>_Name" id="x<?php echo $PipeTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_list->Name->EditValue ?>"<?php echo $PipeTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_Name" name="o<?php echo $PipeTypes_list->RowIndex ?>_Name" id="o<?php echo $PipeTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PipeTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Department_Idn" class="form-group PipeTypes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="PipeTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $PipeTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn"<?php echo $PipeTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $PipeTypes_list->Department_Idn->selectOptionListHtml("x{$PipeTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $PipeTypes_list->Department_Idn->Lookup->getParamTag($PipeTypes_list, "p_x" . $PipeTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_Department_Idn" name="o<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($PipeTypes_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->IsUnderground->Visible) { // IsUnderground ?>
		<td data-name="IsUnderground">
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_IsUnderground" class="form-group PipeTypes_IsUnderground">
<?php
$selwrk = ConvertToBool($PipeTypes_list->IsUnderground->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_IsUnderground" name="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]" id="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]_624354" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_list->IsUnderground->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]_624354"></label>
</div>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_IsUnderground" name="o<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]" id="o<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]" value="<?php echo HtmlEncode($PipeTypes_list->IsUnderground->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Rank" class="form-group PipeTypes_Rank">
<input type="text" data-table="PipeTypes" data-field="x_Rank" name="x<?php echo $PipeTypes_list->RowIndex ?>_Rank" id="x<?php echo $PipeTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_list->Rank->EditValue ?>"<?php echo $PipeTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_Rank" name="o<?php echo $PipeTypes_list->RowIndex ?>_Rank" id="o<?php echo $PipeTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PipeTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_ActiveFlag" class="form-group PipeTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($PipeTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_ActiveFlag" name="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]_219041" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]_219041"></label>
</div>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_ActiveFlag" name="o<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PipeTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PipeTypes_list->ListOptions->render("body", "right", $PipeTypes_list->RowCount);
?>
<script>
loadjs.ready(["fPipeTypeslist", "load"], function() {
	fPipeTypeslist.updateLists(<?php echo $PipeTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($PipeTypes_list->ExportAll && $PipeTypes_list->isExport()) {
	$PipeTypes_list->StopRecord = $PipeTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($PipeTypes_list->TotalRecords > $PipeTypes_list->StartRecord + $PipeTypes_list->DisplayRecords - 1)
		$PipeTypes_list->StopRecord = $PipeTypes_list->StartRecord + $PipeTypes_list->DisplayRecords - 1;
	else
		$PipeTypes_list->StopRecord = $PipeTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($PipeTypes->isConfirm() || $PipeTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($PipeTypes_list->FormKeyCountName) && ($PipeTypes_list->isGridAdd() || $PipeTypes_list->isGridEdit() || $PipeTypes->isConfirm())) {
		$PipeTypes_list->KeyCount = $CurrentForm->getValue($PipeTypes_list->FormKeyCountName);
		$PipeTypes_list->StopRecord = $PipeTypes_list->StartRecord + $PipeTypes_list->KeyCount - 1;
	}
}
$PipeTypes_list->RecordCount = $PipeTypes_list->StartRecord - 1;
if ($PipeTypes_list->Recordset && !$PipeTypes_list->Recordset->EOF) {
	$PipeTypes_list->Recordset->moveFirst();
	$selectLimit = $PipeTypes_list->UseSelectLimit;
	if (!$selectLimit && $PipeTypes_list->StartRecord > 1)
		$PipeTypes_list->Recordset->move($PipeTypes_list->StartRecord - 1);
} elseif (!$PipeTypes->AllowAddDeleteRow && $PipeTypes_list->StopRecord == 0) {
	$PipeTypes_list->StopRecord = $PipeTypes->GridAddRowCount;
}

// Initialize aggregate
$PipeTypes->RowType = ROWTYPE_AGGREGATEINIT;
$PipeTypes->resetAttributes();
$PipeTypes_list->renderRow();
$PipeTypes_list->EditRowCount = 0;
if ($PipeTypes_list->isEdit())
	$PipeTypes_list->RowIndex = 1;
if ($PipeTypes_list->isGridAdd())
	$PipeTypes_list->RowIndex = 0;
if ($PipeTypes_list->isGridEdit())
	$PipeTypes_list->RowIndex = 0;
while ($PipeTypes_list->RecordCount < $PipeTypes_list->StopRecord) {
	$PipeTypes_list->RecordCount++;
	if ($PipeTypes_list->RecordCount >= $PipeTypes_list->StartRecord) {
		$PipeTypes_list->RowCount++;
		if ($PipeTypes_list->isGridAdd() || $PipeTypes_list->isGridEdit() || $PipeTypes->isConfirm()) {
			$PipeTypes_list->RowIndex++;
			$CurrentForm->Index = $PipeTypes_list->RowIndex;
			if ($CurrentForm->hasValue($PipeTypes_list->FormActionName) && ($PipeTypes->isConfirm() || $PipeTypes_list->EventCancelled))
				$PipeTypes_list->RowAction = strval($CurrentForm->getValue($PipeTypes_list->FormActionName));
			elseif ($PipeTypes_list->isGridAdd())
				$PipeTypes_list->RowAction = "insert";
			else
				$PipeTypes_list->RowAction = "";
		}

		// Set up key count
		$PipeTypes_list->KeyCount = $PipeTypes_list->RowIndex;

		// Init row class and style
		$PipeTypes->resetAttributes();
		$PipeTypes->CssClass = "";
		if ($PipeTypes_list->isGridAdd()) {
			$PipeTypes_list->loadRowValues(); // Load default values
		} else {
			$PipeTypes_list->loadRowValues($PipeTypes_list->Recordset); // Load row values
		}
		$PipeTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($PipeTypes_list->isGridAdd()) // Grid add
			$PipeTypes->RowType = ROWTYPE_ADD; // Render add
		if ($PipeTypes_list->isGridAdd() && $PipeTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$PipeTypes_list->restoreCurrentRowFormValues($PipeTypes_list->RowIndex); // Restore form values
		if ($PipeTypes_list->isEdit()) {
			if ($PipeTypes_list->checkInlineEditKey() && $PipeTypes_list->EditRowCount == 0) { // Inline edit
				$PipeTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($PipeTypes_list->isGridEdit()) { // Grid edit
			if ($PipeTypes->EventCancelled)
				$PipeTypes_list->restoreCurrentRowFormValues($PipeTypes_list->RowIndex); // Restore form values
			if ($PipeTypes_list->RowAction == "insert")
				$PipeTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$PipeTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($PipeTypes_list->isEdit() && $PipeTypes->RowType == ROWTYPE_EDIT && $PipeTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$PipeTypes_list->restoreFormValues(); // Restore form values
		}
		if ($PipeTypes_list->isGridEdit() && ($PipeTypes->RowType == ROWTYPE_EDIT || $PipeTypes->RowType == ROWTYPE_ADD) && $PipeTypes->EventCancelled) // Update failed
			$PipeTypes_list->restoreCurrentRowFormValues($PipeTypes_list->RowIndex); // Restore form values
		if ($PipeTypes->RowType == ROWTYPE_EDIT) // Edit row
			$PipeTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$PipeTypes->RowAttrs->merge(["data-rowindex" => $PipeTypes_list->RowCount, "id" => "r" . $PipeTypes_list->RowCount . "_PipeTypes", "data-rowtype" => $PipeTypes->RowType]);

		// Render row
		$PipeTypes_list->renderRow();

		// Render list options
		$PipeTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($PipeTypes_list->RowAction != "delete" && $PipeTypes_list->RowAction != "insertdelete" && !($PipeTypes_list->RowAction == "insert" && $PipeTypes->isConfirm() && $PipeTypes_list->emptyRow())) {
?>
	<tr <?php echo $PipeTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PipeTypes_list->ListOptions->render("body", "left", $PipeTypes_list->RowCount);
?>
	<?php if ($PipeTypes_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td data-name="PipeType_Idn" <?php echo $PipeTypes_list->PipeType_Idn->cellAttributes() ?>>
<?php if ($PipeTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_PipeType_Idn" class="form-group"></span>
<input type="hidden" data-table="PipeTypes" data-field="x_PipeType_Idn" name="o<?php echo $PipeTypes_list->RowIndex ?>_PipeType_Idn" id="o<?php echo $PipeTypes_list->RowIndex ?>_PipeType_Idn" value="<?php echo HtmlEncode($PipeTypes_list->PipeType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_PipeType_Idn" class="form-group">
<span<?php echo $PipeTypes_list->PipeType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($PipeTypes_list->PipeType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_PipeType_Idn" name="x<?php echo $PipeTypes_list->RowIndex ?>_PipeType_Idn" id="x<?php echo $PipeTypes_list->RowIndex ?>_PipeType_Idn" value="<?php echo HtmlEncode($PipeTypes_list->PipeType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_PipeType_Idn">
<span<?php echo $PipeTypes_list->PipeType_Idn->viewAttributes() ?>><?php echo $PipeTypes_list->PipeType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $PipeTypes_list->Name->cellAttributes() ?>>
<?php if ($PipeTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Name" class="form-group">
<input type="text" data-table="PipeTypes" data-field="x_Name" name="x<?php echo $PipeTypes_list->RowIndex ?>_Name" id="x<?php echo $PipeTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_list->Name->EditValue ?>"<?php echo $PipeTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_Name" name="o<?php echo $PipeTypes_list->RowIndex ?>_Name" id="o<?php echo $PipeTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PipeTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Name" class="form-group">
<input type="text" data-table="PipeTypes" data-field="x_Name" name="x<?php echo $PipeTypes_list->RowIndex ?>_Name" id="x<?php echo $PipeTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_list->Name->EditValue ?>"<?php echo $PipeTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Name">
<span<?php echo $PipeTypes_list->Name->viewAttributes() ?>><?php echo $PipeTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $PipeTypes_list->Department_Idn->cellAttributes() ?>>
<?php if ($PipeTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="PipeTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $PipeTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn"<?php echo $PipeTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $PipeTypes_list->Department_Idn->selectOptionListHtml("x{$PipeTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $PipeTypes_list->Department_Idn->Lookup->getParamTag($PipeTypes_list, "p_x" . $PipeTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_Department_Idn" name="o<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($PipeTypes_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="PipeTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $PipeTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn"<?php echo $PipeTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $PipeTypes_list->Department_Idn->selectOptionListHtml("x{$PipeTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $PipeTypes_list->Department_Idn->Lookup->getParamTag($PipeTypes_list, "p_x" . $PipeTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Department_Idn">
<span<?php echo $PipeTypes_list->Department_Idn->viewAttributes() ?>><?php echo $PipeTypes_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->IsUnderground->Visible) { // IsUnderground ?>
		<td data-name="IsUnderground" <?php echo $PipeTypes_list->IsUnderground->cellAttributes() ?>>
<?php if ($PipeTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_IsUnderground" class="form-group">
<?php
$selwrk = ConvertToBool($PipeTypes_list->IsUnderground->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_IsUnderground" name="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]" id="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]_919343" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_list->IsUnderground->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]_919343"></label>
</div>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_IsUnderground" name="o<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]" id="o<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]" value="<?php echo HtmlEncode($PipeTypes_list->IsUnderground->OldValue) ?>">
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_IsUnderground" class="form-group">
<?php
$selwrk = ConvertToBool($PipeTypes_list->IsUnderground->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_IsUnderground" name="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]" id="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]_516851" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_list->IsUnderground->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]_516851"></label>
</div>
</span>
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_IsUnderground">
<span<?php echo $PipeTypes_list->IsUnderground->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsUnderground" class="custom-control-input" value="<?php echo $PipeTypes_list->IsUnderground->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeTypes_list->IsUnderground->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsUnderground"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $PipeTypes_list->Rank->cellAttributes() ?>>
<?php if ($PipeTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Rank" class="form-group">
<input type="text" data-table="PipeTypes" data-field="x_Rank" name="x<?php echo $PipeTypes_list->RowIndex ?>_Rank" id="x<?php echo $PipeTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_list->Rank->EditValue ?>"<?php echo $PipeTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_Rank" name="o<?php echo $PipeTypes_list->RowIndex ?>_Rank" id="o<?php echo $PipeTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PipeTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Rank" class="form-group">
<input type="text" data-table="PipeTypes" data-field="x_Rank" name="x<?php echo $PipeTypes_list->RowIndex ?>_Rank" id="x<?php echo $PipeTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_list->Rank->EditValue ?>"<?php echo $PipeTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_Rank">
<span<?php echo $PipeTypes_list->Rank->viewAttributes() ?>><?php echo $PipeTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $PipeTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($PipeTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($PipeTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_ActiveFlag" name="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]_369468" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]_369468"></label>
</div>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_ActiveFlag" name="o<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PipeTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($PipeTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_ActiveFlag" name="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]_510667" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]_510667"></label>
</div>
</span>
<?php } ?>
<?php if ($PipeTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeTypes_list->RowCount ?>_PipeTypes_ActiveFlag">
<span<?php echo $PipeTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PipeTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PipeTypes_list->ListOptions->render("body", "right", $PipeTypes_list->RowCount);
?>
	</tr>
<?php if ($PipeTypes->RowType == ROWTYPE_ADD || $PipeTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fPipeTypeslist", "load"], function() {
	fPipeTypeslist.updateLists(<?php echo $PipeTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$PipeTypes_list->isGridAdd())
		if (!$PipeTypes_list->Recordset->EOF)
			$PipeTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($PipeTypes_list->isGridAdd() || $PipeTypes_list->isGridEdit()) {
		$PipeTypes_list->RowIndex = '$rowindex$';
		$PipeTypes_list->loadRowValues();

		// Set row properties
		$PipeTypes->resetAttributes();
		$PipeTypes->RowAttrs->merge(["data-rowindex" => $PipeTypes_list->RowIndex, "id" => "r0_PipeTypes", "data-rowtype" => ROWTYPE_ADD]);
		$PipeTypes->RowAttrs->appendClass("ew-template");
		$PipeTypes->RowType = ROWTYPE_ADD;

		// Render row
		$PipeTypes_list->renderRow();

		// Render list options
		$PipeTypes_list->renderListOptions();
		$PipeTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $PipeTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PipeTypes_list->ListOptions->render("body", "left", $PipeTypes_list->RowIndex);
?>
	<?php if ($PipeTypes_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td data-name="PipeType_Idn">
<span id="el$rowindex$_PipeTypes_PipeType_Idn" class="form-group PipeTypes_PipeType_Idn"></span>
<input type="hidden" data-table="PipeTypes" data-field="x_PipeType_Idn" name="o<?php echo $PipeTypes_list->RowIndex ?>_PipeType_Idn" id="o<?php echo $PipeTypes_list->RowIndex ?>_PipeType_Idn" value="<?php echo HtmlEncode($PipeTypes_list->PipeType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_PipeTypes_Name" class="form-group PipeTypes_Name">
<input type="text" data-table="PipeTypes" data-field="x_Name" name="x<?php echo $PipeTypes_list->RowIndex ?>_Name" id="x<?php echo $PipeTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_list->Name->EditValue ?>"<?php echo $PipeTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_Name" name="o<?php echo $PipeTypes_list->RowIndex ?>_Name" id="o<?php echo $PipeTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PipeTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_PipeTypes_Department_Idn" class="form-group PipeTypes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="PipeTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $PipeTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn"<?php echo $PipeTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $PipeTypes_list->Department_Idn->selectOptionListHtml("x{$PipeTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $PipeTypes_list->Department_Idn->Lookup->getParamTag($PipeTypes_list, "p_x" . $PipeTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_Department_Idn" name="o<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $PipeTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($PipeTypes_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->IsUnderground->Visible) { // IsUnderground ?>
		<td data-name="IsUnderground">
<span id="el$rowindex$_PipeTypes_IsUnderground" class="form-group PipeTypes_IsUnderground">
<?php
$selwrk = ConvertToBool($PipeTypes_list->IsUnderground->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_IsUnderground" name="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]" id="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]_261918" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_list->IsUnderground->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]_261918"></label>
</div>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_IsUnderground" name="o<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]" id="o<?php echo $PipeTypes_list->RowIndex ?>_IsUnderground[]" value="<?php echo HtmlEncode($PipeTypes_list->IsUnderground->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_PipeTypes_Rank" class="form-group PipeTypes_Rank">
<input type="text" data-table="PipeTypes" data-field="x_Rank" name="x<?php echo $PipeTypes_list->RowIndex ?>_Rank" id="x<?php echo $PipeTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeTypes_list->Rank->EditValue ?>"<?php echo $PipeTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_Rank" name="o<?php echo $PipeTypes_list->RowIndex ?>_Rank" id="o<?php echo $PipeTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PipeTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_PipeTypes_ActiveFlag" class="form-group PipeTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($PipeTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeTypes" data-field="x_ActiveFlag" name="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]_941447" value="1"<?php echo $selwrk ?><?php echo $PipeTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]_941447"></label>
</div>
</span>
<input type="hidden" data-table="PipeTypes" data-field="x_ActiveFlag" name="o<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PipeTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PipeTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PipeTypes_list->ListOptions->render("body", "right", $PipeTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fPipeTypeslist", "load"], function() {
	fPipeTypeslist.updateLists(<?php echo $PipeTypes_list->RowIndex ?>);
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
<?php if ($PipeTypes_list->isAdd() || $PipeTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $PipeTypes_list->FormKeyCountName ?>" id="<?php echo $PipeTypes_list->FormKeyCountName ?>" value="<?php echo $PipeTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($PipeTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $PipeTypes_list->FormKeyCountName ?>" id="<?php echo $PipeTypes_list->FormKeyCountName ?>" value="<?php echo $PipeTypes_list->KeyCount ?>">
<?php echo $PipeTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($PipeTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $PipeTypes_list->FormKeyCountName ?>" id="<?php echo $PipeTypes_list->FormKeyCountName ?>" value="<?php echo $PipeTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($PipeTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $PipeTypes_list->FormKeyCountName ?>" id="<?php echo $PipeTypes_list->FormKeyCountName ?>" value="<?php echo $PipeTypes_list->KeyCount ?>">
<?php echo $PipeTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$PipeTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($PipeTypes_list->Recordset)
	$PipeTypes_list->Recordset->Close();
?>
<?php if (!$PipeTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$PipeTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PipeTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $PipeTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($PipeTypes_list->TotalRecords == 0 && !$PipeTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $PipeTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$PipeTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$PipeTypes_list->isExport()) { ?>
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
$PipeTypes_list->terminate();
?>