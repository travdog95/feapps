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
$PipeExposures_list = new PipeExposures_list();

// Run the page
$PipeExposures_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeExposures_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$PipeExposures_list->isExport()) { ?>
<script>
var fPipeExposureslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fPipeExposureslist = currentForm = new ew.Form("fPipeExposureslist", "list");
	fPipeExposureslist.formKeyCountName = '<?php echo $PipeExposures_list->FormKeyCountName ?>';

	// Validate form
	fPipeExposureslist.validate = function() {
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
			<?php if ($PipeExposures_list->PipeExposure_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PipeExposure_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeExposures_list->PipeExposure_Idn->caption(), $PipeExposures_list->PipeExposure_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeExposures_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeExposures_list->Name->caption(), $PipeExposures_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeExposures_list->AdjustmentFactor_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_AdjustmentFactor_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeExposures_list->AdjustmentFactor_Idn->caption(), $PipeExposures_list->AdjustmentFactor_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeExposures_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeExposures_list->Rank->caption(), $PipeExposures_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PipeExposures_list->Rank->errorMessage()) ?>");
			<?php if ($PipeExposures_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeExposures_list->ActiveFlag->caption(), $PipeExposures_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fPipeExposureslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "AdjustmentFactor_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fPipeExposureslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPipeExposureslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fPipeExposureslist.lists["x_AdjustmentFactor_Idn"] = <?php echo $PipeExposures_list->AdjustmentFactor_Idn->Lookup->toClientList($PipeExposures_list) ?>;
	fPipeExposureslist.lists["x_AdjustmentFactor_Idn"].options = <?php echo JsonEncode($PipeExposures_list->AdjustmentFactor_Idn->lookupOptions()) ?>;
	fPipeExposureslist.lists["x_ActiveFlag[]"] = <?php echo $PipeExposures_list->ActiveFlag->Lookup->toClientList($PipeExposures_list) ?>;
	fPipeExposureslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($PipeExposures_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fPipeExposureslist");
});
var fPipeExposureslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fPipeExposureslistsrch = currentSearchForm = new ew.Form("fPipeExposureslistsrch");

	// Dynamic selection lists
	// Filters

	fPipeExposureslistsrch.filterList = <?php echo $PipeExposures_list->getFilterList() ?>;
	loadjs.done("fPipeExposureslistsrch");
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
<?php if (!$PipeExposures_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($PipeExposures_list->TotalRecords > 0 && $PipeExposures_list->ExportOptions->visible()) { ?>
<?php $PipeExposures_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($PipeExposures_list->ImportOptions->visible()) { ?>
<?php $PipeExposures_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($PipeExposures_list->SearchOptions->visible()) { ?>
<?php $PipeExposures_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($PipeExposures_list->FilterOptions->visible()) { ?>
<?php $PipeExposures_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$PipeExposures_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$PipeExposures_list->isExport() && !$PipeExposures->CurrentAction) { ?>
<form name="fPipeExposureslistsrch" id="fPipeExposureslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fPipeExposureslistsrch-search-panel" class="<?php echo $PipeExposures_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="PipeExposures">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $PipeExposures_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($PipeExposures_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($PipeExposures_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $PipeExposures_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($PipeExposures_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($PipeExposures_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($PipeExposures_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($PipeExposures_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $PipeExposures_list->showPageHeader(); ?>
<?php
$PipeExposures_list->showMessage();
?>
<?php if ($PipeExposures_list->TotalRecords > 0 || $PipeExposures->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($PipeExposures_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> PipeExposures">
<?php if (!$PipeExposures_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$PipeExposures_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PipeExposures_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $PipeExposures_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fPipeExposureslist" id="fPipeExposureslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeExposures">
<div id="gmp_PipeExposures" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($PipeExposures_list->TotalRecords > 0 || $PipeExposures_list->isAdd() || $PipeExposures_list->isCopy() || $PipeExposures_list->isGridEdit()) { ?>
<table id="tbl_PipeExposureslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$PipeExposures->RowType = ROWTYPE_HEADER;

// Render list options
$PipeExposures_list->renderListOptions();

// Render list options (header, left)
$PipeExposures_list->ListOptions->render("header", "left");
?>
<?php if ($PipeExposures_list->PipeExposure_Idn->Visible) { // PipeExposure_Idn ?>
	<?php if ($PipeExposures_list->SortUrl($PipeExposures_list->PipeExposure_Idn) == "") { ?>
		<th data-name="PipeExposure_Idn" class="<?php echo $PipeExposures_list->PipeExposure_Idn->headerCellClass() ?>"><div id="elh_PipeExposures_PipeExposure_Idn" class="PipeExposures_PipeExposure_Idn"><div class="ew-table-header-caption"><?php echo $PipeExposures_list->PipeExposure_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PipeExposure_Idn" class="<?php echo $PipeExposures_list->PipeExposure_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeExposures_list->SortUrl($PipeExposures_list->PipeExposure_Idn) ?>', 1);"><div id="elh_PipeExposures_PipeExposure_Idn" class="PipeExposures_PipeExposure_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeExposures_list->PipeExposure_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeExposures_list->PipeExposure_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeExposures_list->PipeExposure_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeExposures_list->Name->Visible) { // Name ?>
	<?php if ($PipeExposures_list->SortUrl($PipeExposures_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $PipeExposures_list->Name->headerCellClass() ?>"><div id="elh_PipeExposures_Name" class="PipeExposures_Name"><div class="ew-table-header-caption"><?php echo $PipeExposures_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $PipeExposures_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeExposures_list->SortUrl($PipeExposures_list->Name) ?>', 1);"><div id="elh_PipeExposures_Name" class="PipeExposures_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeExposures_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PipeExposures_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeExposures_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeExposures_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
	<?php if ($PipeExposures_list->SortUrl($PipeExposures_list->AdjustmentFactor_Idn) == "") { ?>
		<th data-name="AdjustmentFactor_Idn" class="<?php echo $PipeExposures_list->AdjustmentFactor_Idn->headerCellClass() ?>"><div id="elh_PipeExposures_AdjustmentFactor_Idn" class="PipeExposures_AdjustmentFactor_Idn"><div class="ew-table-header-caption"><?php echo $PipeExposures_list->AdjustmentFactor_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdjustmentFactor_Idn" class="<?php echo $PipeExposures_list->AdjustmentFactor_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeExposures_list->SortUrl($PipeExposures_list->AdjustmentFactor_Idn) ?>', 1);"><div id="elh_PipeExposures_AdjustmentFactor_Idn" class="PipeExposures_AdjustmentFactor_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeExposures_list->AdjustmentFactor_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeExposures_list->AdjustmentFactor_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeExposures_list->AdjustmentFactor_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeExposures_list->Rank->Visible) { // Rank ?>
	<?php if ($PipeExposures_list->SortUrl($PipeExposures_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $PipeExposures_list->Rank->headerCellClass() ?>"><div id="elh_PipeExposures_Rank" class="PipeExposures_Rank"><div class="ew-table-header-caption"><?php echo $PipeExposures_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $PipeExposures_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeExposures_list->SortUrl($PipeExposures_list->Rank) ?>', 1);"><div id="elh_PipeExposures_Rank" class="PipeExposures_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeExposures_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeExposures_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeExposures_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeExposures_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($PipeExposures_list->SortUrl($PipeExposures_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $PipeExposures_list->ActiveFlag->headerCellClass() ?>"><div id="elh_PipeExposures_ActiveFlag" class="PipeExposures_ActiveFlag"><div class="ew-table-header-caption"><?php echo $PipeExposures_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $PipeExposures_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeExposures_list->SortUrl($PipeExposures_list->ActiveFlag) ?>', 1);"><div id="elh_PipeExposures_ActiveFlag" class="PipeExposures_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeExposures_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeExposures_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeExposures_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$PipeExposures_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($PipeExposures_list->isAdd() || $PipeExposures_list->isCopy()) {
		$PipeExposures_list->RowIndex = 0;
		$PipeExposures_list->KeyCount = $PipeExposures_list->RowIndex;
		if ($PipeExposures_list->isCopy() && !$PipeExposures_list->loadRow())
			$PipeExposures->CurrentAction = "add";
		if ($PipeExposures_list->isAdd())
			$PipeExposures_list->loadRowValues();
		if ($PipeExposures->EventCancelled) // Insert failed
			$PipeExposures_list->restoreFormValues(); // Restore form values

		// Set row properties
		$PipeExposures->resetAttributes();
		$PipeExposures->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_PipeExposures", "data-rowtype" => ROWTYPE_ADD]);
		$PipeExposures->RowType = ROWTYPE_ADD;

		// Render row
		$PipeExposures_list->renderRow();

		// Render list options
		$PipeExposures_list->renderListOptions();
		$PipeExposures_list->StartRowCount = 0;
?>
	<tr <?php echo $PipeExposures->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PipeExposures_list->ListOptions->render("body", "left", $PipeExposures_list->RowCount);
?>
	<?php if ($PipeExposures_list->PipeExposure_Idn->Visible) { // PipeExposure_Idn ?>
		<td data-name="PipeExposure_Idn">
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_PipeExposure_Idn" class="form-group PipeExposures_PipeExposure_Idn"></span>
<input type="hidden" data-table="PipeExposures" data-field="x_PipeExposure_Idn" name="o<?php echo $PipeExposures_list->RowIndex ?>_PipeExposure_Idn" id="o<?php echo $PipeExposures_list->RowIndex ?>_PipeExposure_Idn" value="<?php echo HtmlEncode($PipeExposures_list->PipeExposure_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_Name" class="form-group PipeExposures_Name">
<input type="text" data-table="PipeExposures" data-field="x_Name" name="x<?php echo $PipeExposures_list->RowIndex ?>_Name" id="x<?php echo $PipeExposures_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeExposures_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeExposures_list->Name->EditValue ?>"<?php echo $PipeExposures_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_Name" name="o<?php echo $PipeExposures_list->RowIndex ?>_Name" id="o<?php echo $PipeExposures_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PipeExposures_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td data-name="AdjustmentFactor_Idn">
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_AdjustmentFactor_Idn" class="form-group PipeExposures_AdjustmentFactor_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="PipeExposures" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $PipeExposures_list->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn"<?php echo $PipeExposures_list->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $PipeExposures_list->AdjustmentFactor_Idn->selectOptionListHtml("x{$PipeExposures_list->RowIndex}_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $PipeExposures_list->AdjustmentFactor_Idn->Lookup->getParamTag($PipeExposures_list, "p_x" . $PipeExposures_list->RowIndex . "_AdjustmentFactor_Idn") ?>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($PipeExposures_list->AdjustmentFactor_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_Rank" class="form-group PipeExposures_Rank">
<input type="text" data-table="PipeExposures" data-field="x_Rank" name="x<?php echo $PipeExposures_list->RowIndex ?>_Rank" id="x<?php echo $PipeExposures_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeExposures_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeExposures_list->Rank->EditValue ?>"<?php echo $PipeExposures_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_Rank" name="o<?php echo $PipeExposures_list->RowIndex ?>_Rank" id="o<?php echo $PipeExposures_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PipeExposures_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_ActiveFlag" class="form-group PipeExposures_ActiveFlag">
<?php
$selwrk = ConvertToBool($PipeExposures_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeExposures" data-field="x_ActiveFlag" name="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]_416041" value="1"<?php echo $selwrk ?><?php echo $PipeExposures_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]_416041"></label>
</div>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_ActiveFlag" name="o<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PipeExposures_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PipeExposures_list->ListOptions->render("body", "right", $PipeExposures_list->RowCount);
?>
<script>
loadjs.ready(["fPipeExposureslist", "load"], function() {
	fPipeExposureslist.updateLists(<?php echo $PipeExposures_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($PipeExposures_list->ExportAll && $PipeExposures_list->isExport()) {
	$PipeExposures_list->StopRecord = $PipeExposures_list->TotalRecords;
} else {

	// Set the last record to display
	if ($PipeExposures_list->TotalRecords > $PipeExposures_list->StartRecord + $PipeExposures_list->DisplayRecords - 1)
		$PipeExposures_list->StopRecord = $PipeExposures_list->StartRecord + $PipeExposures_list->DisplayRecords - 1;
	else
		$PipeExposures_list->StopRecord = $PipeExposures_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($PipeExposures->isConfirm() || $PipeExposures_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($PipeExposures_list->FormKeyCountName) && ($PipeExposures_list->isGridAdd() || $PipeExposures_list->isGridEdit() || $PipeExposures->isConfirm())) {
		$PipeExposures_list->KeyCount = $CurrentForm->getValue($PipeExposures_list->FormKeyCountName);
		$PipeExposures_list->StopRecord = $PipeExposures_list->StartRecord + $PipeExposures_list->KeyCount - 1;
	}
}
$PipeExposures_list->RecordCount = $PipeExposures_list->StartRecord - 1;
if ($PipeExposures_list->Recordset && !$PipeExposures_list->Recordset->EOF) {
	$PipeExposures_list->Recordset->moveFirst();
	$selectLimit = $PipeExposures_list->UseSelectLimit;
	if (!$selectLimit && $PipeExposures_list->StartRecord > 1)
		$PipeExposures_list->Recordset->move($PipeExposures_list->StartRecord - 1);
} elseif (!$PipeExposures->AllowAddDeleteRow && $PipeExposures_list->StopRecord == 0) {
	$PipeExposures_list->StopRecord = $PipeExposures->GridAddRowCount;
}

// Initialize aggregate
$PipeExposures->RowType = ROWTYPE_AGGREGATEINIT;
$PipeExposures->resetAttributes();
$PipeExposures_list->renderRow();
$PipeExposures_list->EditRowCount = 0;
if ($PipeExposures_list->isEdit())
	$PipeExposures_list->RowIndex = 1;
if ($PipeExposures_list->isGridAdd())
	$PipeExposures_list->RowIndex = 0;
if ($PipeExposures_list->isGridEdit())
	$PipeExposures_list->RowIndex = 0;
while ($PipeExposures_list->RecordCount < $PipeExposures_list->StopRecord) {
	$PipeExposures_list->RecordCount++;
	if ($PipeExposures_list->RecordCount >= $PipeExposures_list->StartRecord) {
		$PipeExposures_list->RowCount++;
		if ($PipeExposures_list->isGridAdd() || $PipeExposures_list->isGridEdit() || $PipeExposures->isConfirm()) {
			$PipeExposures_list->RowIndex++;
			$CurrentForm->Index = $PipeExposures_list->RowIndex;
			if ($CurrentForm->hasValue($PipeExposures_list->FormActionName) && ($PipeExposures->isConfirm() || $PipeExposures_list->EventCancelled))
				$PipeExposures_list->RowAction = strval($CurrentForm->getValue($PipeExposures_list->FormActionName));
			elseif ($PipeExposures_list->isGridAdd())
				$PipeExposures_list->RowAction = "insert";
			else
				$PipeExposures_list->RowAction = "";
		}

		// Set up key count
		$PipeExposures_list->KeyCount = $PipeExposures_list->RowIndex;

		// Init row class and style
		$PipeExposures->resetAttributes();
		$PipeExposures->CssClass = "";
		if ($PipeExposures_list->isGridAdd()) {
			$PipeExposures_list->loadRowValues(); // Load default values
		} else {
			$PipeExposures_list->loadRowValues($PipeExposures_list->Recordset); // Load row values
		}
		$PipeExposures->RowType = ROWTYPE_VIEW; // Render view
		if ($PipeExposures_list->isGridAdd()) // Grid add
			$PipeExposures->RowType = ROWTYPE_ADD; // Render add
		if ($PipeExposures_list->isGridAdd() && $PipeExposures->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$PipeExposures_list->restoreCurrentRowFormValues($PipeExposures_list->RowIndex); // Restore form values
		if ($PipeExposures_list->isEdit()) {
			if ($PipeExposures_list->checkInlineEditKey() && $PipeExposures_list->EditRowCount == 0) { // Inline edit
				$PipeExposures->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($PipeExposures_list->isGridEdit()) { // Grid edit
			if ($PipeExposures->EventCancelled)
				$PipeExposures_list->restoreCurrentRowFormValues($PipeExposures_list->RowIndex); // Restore form values
			if ($PipeExposures_list->RowAction == "insert")
				$PipeExposures->RowType = ROWTYPE_ADD; // Render add
			else
				$PipeExposures->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($PipeExposures_list->isEdit() && $PipeExposures->RowType == ROWTYPE_EDIT && $PipeExposures->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$PipeExposures_list->restoreFormValues(); // Restore form values
		}
		if ($PipeExposures_list->isGridEdit() && ($PipeExposures->RowType == ROWTYPE_EDIT || $PipeExposures->RowType == ROWTYPE_ADD) && $PipeExposures->EventCancelled) // Update failed
			$PipeExposures_list->restoreCurrentRowFormValues($PipeExposures_list->RowIndex); // Restore form values
		if ($PipeExposures->RowType == ROWTYPE_EDIT) // Edit row
			$PipeExposures_list->EditRowCount++;

		// Set up row id / data-rowindex
		$PipeExposures->RowAttrs->merge(["data-rowindex" => $PipeExposures_list->RowCount, "id" => "r" . $PipeExposures_list->RowCount . "_PipeExposures", "data-rowtype" => $PipeExposures->RowType]);

		// Render row
		$PipeExposures_list->renderRow();

		// Render list options
		$PipeExposures_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($PipeExposures_list->RowAction != "delete" && $PipeExposures_list->RowAction != "insertdelete" && !($PipeExposures_list->RowAction == "insert" && $PipeExposures->isConfirm() && $PipeExposures_list->emptyRow())) {
?>
	<tr <?php echo $PipeExposures->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PipeExposures_list->ListOptions->render("body", "left", $PipeExposures_list->RowCount);
?>
	<?php if ($PipeExposures_list->PipeExposure_Idn->Visible) { // PipeExposure_Idn ?>
		<td data-name="PipeExposure_Idn" <?php echo $PipeExposures_list->PipeExposure_Idn->cellAttributes() ?>>
<?php if ($PipeExposures->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_PipeExposure_Idn" class="form-group"></span>
<input type="hidden" data-table="PipeExposures" data-field="x_PipeExposure_Idn" name="o<?php echo $PipeExposures_list->RowIndex ?>_PipeExposure_Idn" id="o<?php echo $PipeExposures_list->RowIndex ?>_PipeExposure_Idn" value="<?php echo HtmlEncode($PipeExposures_list->PipeExposure_Idn->OldValue) ?>">
<?php } ?>
<?php if ($PipeExposures->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_PipeExposure_Idn" class="form-group">
<span<?php echo $PipeExposures_list->PipeExposure_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($PipeExposures_list->PipeExposure_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_PipeExposure_Idn" name="x<?php echo $PipeExposures_list->RowIndex ?>_PipeExposure_Idn" id="x<?php echo $PipeExposures_list->RowIndex ?>_PipeExposure_Idn" value="<?php echo HtmlEncode($PipeExposures_list->PipeExposure_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($PipeExposures->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_PipeExposure_Idn">
<span<?php echo $PipeExposures_list->PipeExposure_Idn->viewAttributes() ?>><?php echo $PipeExposures_list->PipeExposure_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $PipeExposures_list->Name->cellAttributes() ?>>
<?php if ($PipeExposures->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_Name" class="form-group">
<input type="text" data-table="PipeExposures" data-field="x_Name" name="x<?php echo $PipeExposures_list->RowIndex ?>_Name" id="x<?php echo $PipeExposures_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeExposures_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeExposures_list->Name->EditValue ?>"<?php echo $PipeExposures_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_Name" name="o<?php echo $PipeExposures_list->RowIndex ?>_Name" id="o<?php echo $PipeExposures_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PipeExposures_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($PipeExposures->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_Name" class="form-group">
<input type="text" data-table="PipeExposures" data-field="x_Name" name="x<?php echo $PipeExposures_list->RowIndex ?>_Name" id="x<?php echo $PipeExposures_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeExposures_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeExposures_list->Name->EditValue ?>"<?php echo $PipeExposures_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($PipeExposures->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_Name">
<span<?php echo $PipeExposures_list->Name->viewAttributes() ?>><?php echo $PipeExposures_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td data-name="AdjustmentFactor_Idn" <?php echo $PipeExposures_list->AdjustmentFactor_Idn->cellAttributes() ?>>
<?php if ($PipeExposures->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_AdjustmentFactor_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="PipeExposures" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $PipeExposures_list->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn"<?php echo $PipeExposures_list->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $PipeExposures_list->AdjustmentFactor_Idn->selectOptionListHtml("x{$PipeExposures_list->RowIndex}_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $PipeExposures_list->AdjustmentFactor_Idn->Lookup->getParamTag($PipeExposures_list, "p_x" . $PipeExposures_list->RowIndex . "_AdjustmentFactor_Idn") ?>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($PipeExposures_list->AdjustmentFactor_Idn->OldValue) ?>">
<?php } ?>
<?php if ($PipeExposures->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_AdjustmentFactor_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="PipeExposures" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $PipeExposures_list->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn"<?php echo $PipeExposures_list->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $PipeExposures_list->AdjustmentFactor_Idn->selectOptionListHtml("x{$PipeExposures_list->RowIndex}_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $PipeExposures_list->AdjustmentFactor_Idn->Lookup->getParamTag($PipeExposures_list, "p_x" . $PipeExposures_list->RowIndex . "_AdjustmentFactor_Idn") ?>
</span>
<?php } ?>
<?php if ($PipeExposures->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_AdjustmentFactor_Idn">
<span<?php echo $PipeExposures_list->AdjustmentFactor_Idn->viewAttributes() ?>><?php echo $PipeExposures_list->AdjustmentFactor_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $PipeExposures_list->Rank->cellAttributes() ?>>
<?php if ($PipeExposures->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_Rank" class="form-group">
<input type="text" data-table="PipeExposures" data-field="x_Rank" name="x<?php echo $PipeExposures_list->RowIndex ?>_Rank" id="x<?php echo $PipeExposures_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeExposures_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeExposures_list->Rank->EditValue ?>"<?php echo $PipeExposures_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_Rank" name="o<?php echo $PipeExposures_list->RowIndex ?>_Rank" id="o<?php echo $PipeExposures_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PipeExposures_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($PipeExposures->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_Rank" class="form-group">
<input type="text" data-table="PipeExposures" data-field="x_Rank" name="x<?php echo $PipeExposures_list->RowIndex ?>_Rank" id="x<?php echo $PipeExposures_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeExposures_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeExposures_list->Rank->EditValue ?>"<?php echo $PipeExposures_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($PipeExposures->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_Rank">
<span<?php echo $PipeExposures_list->Rank->viewAttributes() ?>><?php echo $PipeExposures_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $PipeExposures_list->ActiveFlag->cellAttributes() ?>>
<?php if ($PipeExposures->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($PipeExposures_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeExposures" data-field="x_ActiveFlag" name="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]_856545" value="1"<?php echo $selwrk ?><?php echo $PipeExposures_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]_856545"></label>
</div>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_ActiveFlag" name="o<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PipeExposures_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($PipeExposures->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($PipeExposures_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeExposures" data-field="x_ActiveFlag" name="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]_177906" value="1"<?php echo $selwrk ?><?php echo $PipeExposures_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]_177906"></label>
</div>
</span>
<?php } ?>
<?php if ($PipeExposures->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeExposures_list->RowCount ?>_PipeExposures_ActiveFlag">
<span<?php echo $PipeExposures_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PipeExposures_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeExposures_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PipeExposures_list->ListOptions->render("body", "right", $PipeExposures_list->RowCount);
?>
	</tr>
<?php if ($PipeExposures->RowType == ROWTYPE_ADD || $PipeExposures->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fPipeExposureslist", "load"], function() {
	fPipeExposureslist.updateLists(<?php echo $PipeExposures_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$PipeExposures_list->isGridAdd())
		if (!$PipeExposures_list->Recordset->EOF)
			$PipeExposures_list->Recordset->moveNext();
}
?>
<?php
	if ($PipeExposures_list->isGridAdd() || $PipeExposures_list->isGridEdit()) {
		$PipeExposures_list->RowIndex = '$rowindex$';
		$PipeExposures_list->loadRowValues();

		// Set row properties
		$PipeExposures->resetAttributes();
		$PipeExposures->RowAttrs->merge(["data-rowindex" => $PipeExposures_list->RowIndex, "id" => "r0_PipeExposures", "data-rowtype" => ROWTYPE_ADD]);
		$PipeExposures->RowAttrs->appendClass("ew-template");
		$PipeExposures->RowType = ROWTYPE_ADD;

		// Render row
		$PipeExposures_list->renderRow();

		// Render list options
		$PipeExposures_list->renderListOptions();
		$PipeExposures_list->StartRowCount = 0;
?>
	<tr <?php echo $PipeExposures->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PipeExposures_list->ListOptions->render("body", "left", $PipeExposures_list->RowIndex);
?>
	<?php if ($PipeExposures_list->PipeExposure_Idn->Visible) { // PipeExposure_Idn ?>
		<td data-name="PipeExposure_Idn">
<span id="el$rowindex$_PipeExposures_PipeExposure_Idn" class="form-group PipeExposures_PipeExposure_Idn"></span>
<input type="hidden" data-table="PipeExposures" data-field="x_PipeExposure_Idn" name="o<?php echo $PipeExposures_list->RowIndex ?>_PipeExposure_Idn" id="o<?php echo $PipeExposures_list->RowIndex ?>_PipeExposure_Idn" value="<?php echo HtmlEncode($PipeExposures_list->PipeExposure_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_PipeExposures_Name" class="form-group PipeExposures_Name">
<input type="text" data-table="PipeExposures" data-field="x_Name" name="x<?php echo $PipeExposures_list->RowIndex ?>_Name" id="x<?php echo $PipeExposures_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeExposures_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeExposures_list->Name->EditValue ?>"<?php echo $PipeExposures_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_Name" name="o<?php echo $PipeExposures_list->RowIndex ?>_Name" id="o<?php echo $PipeExposures_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PipeExposures_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td data-name="AdjustmentFactor_Idn">
<span id="el$rowindex$_PipeExposures_AdjustmentFactor_Idn" class="form-group PipeExposures_AdjustmentFactor_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="PipeExposures" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $PipeExposures_list->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn"<?php echo $PipeExposures_list->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $PipeExposures_list->AdjustmentFactor_Idn->selectOptionListHtml("x{$PipeExposures_list->RowIndex}_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $PipeExposures_list->AdjustmentFactor_Idn->Lookup->getParamTag($PipeExposures_list, "p_x" . $PipeExposures_list->RowIndex . "_AdjustmentFactor_Idn") ?>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $PipeExposures_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($PipeExposures_list->AdjustmentFactor_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_PipeExposures_Rank" class="form-group PipeExposures_Rank">
<input type="text" data-table="PipeExposures" data-field="x_Rank" name="x<?php echo $PipeExposures_list->RowIndex ?>_Rank" id="x<?php echo $PipeExposures_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeExposures_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeExposures_list->Rank->EditValue ?>"<?php echo $PipeExposures_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_Rank" name="o<?php echo $PipeExposures_list->RowIndex ?>_Rank" id="o<?php echo $PipeExposures_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PipeExposures_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeExposures_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_PipeExposures_ActiveFlag" class="form-group PipeExposures_ActiveFlag">
<?php
$selwrk = ConvertToBool($PipeExposures_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeExposures" data-field="x_ActiveFlag" name="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]_144692" value="1"<?php echo $selwrk ?><?php echo $PipeExposures_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]_144692"></label>
</div>
</span>
<input type="hidden" data-table="PipeExposures" data-field="x_ActiveFlag" name="o<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PipeExposures_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PipeExposures_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PipeExposures_list->ListOptions->render("body", "right", $PipeExposures_list->RowIndex);
?>
<script>
loadjs.ready(["fPipeExposureslist", "load"], function() {
	fPipeExposureslist.updateLists(<?php echo $PipeExposures_list->RowIndex ?>);
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
<?php if ($PipeExposures_list->isAdd() || $PipeExposures_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $PipeExposures_list->FormKeyCountName ?>" id="<?php echo $PipeExposures_list->FormKeyCountName ?>" value="<?php echo $PipeExposures_list->KeyCount ?>">
<?php } ?>
<?php if ($PipeExposures_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $PipeExposures_list->FormKeyCountName ?>" id="<?php echo $PipeExposures_list->FormKeyCountName ?>" value="<?php echo $PipeExposures_list->KeyCount ?>">
<?php echo $PipeExposures_list->MultiSelectKey ?>
<?php } ?>
<?php if ($PipeExposures_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $PipeExposures_list->FormKeyCountName ?>" id="<?php echo $PipeExposures_list->FormKeyCountName ?>" value="<?php echo $PipeExposures_list->KeyCount ?>">
<?php } ?>
<?php if ($PipeExposures_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $PipeExposures_list->FormKeyCountName ?>" id="<?php echo $PipeExposures_list->FormKeyCountName ?>" value="<?php echo $PipeExposures_list->KeyCount ?>">
<?php echo $PipeExposures_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$PipeExposures->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($PipeExposures_list->Recordset)
	$PipeExposures_list->Recordset->Close();
?>
<?php if (!$PipeExposures_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$PipeExposures_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PipeExposures_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $PipeExposures_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($PipeExposures_list->TotalRecords == 0 && !$PipeExposures->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $PipeExposures_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$PipeExposures_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$PipeExposures_list->isExport()) { ?>
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
$PipeExposures_list->terminate();
?>