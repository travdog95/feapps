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
$AdjustmentFactors_list = new AdjustmentFactors_list();

// Run the page
$AdjustmentFactors_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AdjustmentFactors_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$AdjustmentFactors_list->isExport()) { ?>
<script>
var fAdjustmentFactorslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fAdjustmentFactorslist = currentForm = new ew.Form("fAdjustmentFactorslist", "list");
	fAdjustmentFactorslist.formKeyCountName = '<?php echo $AdjustmentFactors_list->FormKeyCountName ?>';

	// Validate form
	fAdjustmentFactorslist.validate = function() {
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
			<?php if ($AdjustmentFactors_list->AdjustmentFactor_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_AdjustmentFactor_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_list->AdjustmentFactor_Idn->caption(), $AdjustmentFactors_list->AdjustmentFactor_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentFactors_list->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_list->WorksheetMaster_Idn->caption(), $AdjustmentFactors_list->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentFactors_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_list->Name->caption(), $AdjustmentFactors_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentFactors_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_list->Rank->caption(), $AdjustmentFactors_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($AdjustmentFactors_list->Rank->errorMessage()) ?>");
			<?php if ($AdjustmentFactors_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentFactors_list->ActiveFlag->caption(), $AdjustmentFactors_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fAdjustmentFactorslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "WorksheetMaster_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fAdjustmentFactorslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fAdjustmentFactorslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fAdjustmentFactorslist.lists["x_WorksheetMaster_Idn"] = <?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->Lookup->toClientList($AdjustmentFactors_list) ?>;
	fAdjustmentFactorslist.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($AdjustmentFactors_list->WorksheetMaster_Idn->lookupOptions()) ?>;
	fAdjustmentFactorslist.lists["x_ActiveFlag[]"] = <?php echo $AdjustmentFactors_list->ActiveFlag->Lookup->toClientList($AdjustmentFactors_list) ?>;
	fAdjustmentFactorslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($AdjustmentFactors_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fAdjustmentFactorslist");
});
var fAdjustmentFactorslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fAdjustmentFactorslistsrch = currentSearchForm = new ew.Form("fAdjustmentFactorslistsrch");

	// Validate function for search
	fAdjustmentFactorslistsrch.validate = function(fobj) {
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
	fAdjustmentFactorslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fAdjustmentFactorslistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fAdjustmentFactorslistsrch.lists["x_WorksheetMaster_Idn"] = <?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->Lookup->toClientList($AdjustmentFactors_list) ?>;
	fAdjustmentFactorslistsrch.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($AdjustmentFactors_list->WorksheetMaster_Idn->lookupOptions()) ?>;

	// Filters
	fAdjustmentFactorslistsrch.filterList = <?php echo $AdjustmentFactors_list->getFilterList() ?>;
	loadjs.done("fAdjustmentFactorslistsrch");
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
<?php if (!$AdjustmentFactors_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($AdjustmentFactors_list->TotalRecords > 0 && $AdjustmentFactors_list->ExportOptions->visible()) { ?>
<?php $AdjustmentFactors_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($AdjustmentFactors_list->ImportOptions->visible()) { ?>
<?php $AdjustmentFactors_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($AdjustmentFactors_list->SearchOptions->visible()) { ?>
<?php $AdjustmentFactors_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($AdjustmentFactors_list->FilterOptions->visible()) { ?>
<?php $AdjustmentFactors_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$AdjustmentFactors_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$AdjustmentFactors_list->isExport() && !$AdjustmentFactors->CurrentAction) { ?>
<form name="fAdjustmentFactorslistsrch" id="fAdjustmentFactorslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fAdjustmentFactorslistsrch-search-panel" class="<?php echo $AdjustmentFactors_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="AdjustmentFactors">
	<div class="ew-extended-search">
<?php

// Render search row
$AdjustmentFactors->RowType = ROWTYPE_SEARCH;
$AdjustmentFactors->resetAttributes();
$AdjustmentFactors_list->renderRow();
?>
<?php if ($AdjustmentFactors_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php
		$AdjustmentFactors_list->SearchColumnCount++;
		if (($AdjustmentFactors_list->SearchColumnCount - 1) % $AdjustmentFactors_list->SearchFieldsPerRow == 0) {
			$AdjustmentFactors_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $AdjustmentFactors_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_WorksheetMaster_Idn" class="ew-cell form-group">
		<label for="x_WorksheetMaster_Idn" class="ew-search-caption ew-label"><?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_WorksheetMaster_Idn" id="z_WorksheetMaster_Idn" value="=">
</span>
		<span id="el_AdjustmentFactors_WorksheetMaster_Idn" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentFactors" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x_WorksheetMaster_Idn" name="x_WorksheetMaster_Idn"<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->selectOptionListHtml("x_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->Lookup->getParamTag($AdjustmentFactors_list, "p_x_WorksheetMaster_Idn") ?>
</span>
	</div>
	<?php if ($AdjustmentFactors_list->SearchColumnCount % $AdjustmentFactors_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($AdjustmentFactors_list->SearchColumnCount % $AdjustmentFactors_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $AdjustmentFactors_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($AdjustmentFactors_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($AdjustmentFactors_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $AdjustmentFactors_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($AdjustmentFactors_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($AdjustmentFactors_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($AdjustmentFactors_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($AdjustmentFactors_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $AdjustmentFactors_list->showPageHeader(); ?>
<?php
$AdjustmentFactors_list->showMessage();
?>
<?php if ($AdjustmentFactors_list->TotalRecords > 0 || $AdjustmentFactors->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($AdjustmentFactors_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> AdjustmentFactors">
<?php if (!$AdjustmentFactors_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$AdjustmentFactors_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $AdjustmentFactors_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $AdjustmentFactors_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fAdjustmentFactorslist" id="fAdjustmentFactorslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AdjustmentFactors">
<div id="gmp_AdjustmentFactors" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($AdjustmentFactors_list->TotalRecords > 0 || $AdjustmentFactors_list->isAdd() || $AdjustmentFactors_list->isCopy() || $AdjustmentFactors_list->isGridEdit()) { ?>
<table id="tbl_AdjustmentFactorslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$AdjustmentFactors->RowType = ROWTYPE_HEADER;

// Render list options
$AdjustmentFactors_list->renderListOptions();

// Render list options (header, left)
$AdjustmentFactors_list->ListOptions->render("header", "left");
?>
<?php if ($AdjustmentFactors_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
	<?php if ($AdjustmentFactors_list->SortUrl($AdjustmentFactors_list->AdjustmentFactor_Idn) == "") { ?>
		<th data-name="AdjustmentFactor_Idn" class="<?php echo $AdjustmentFactors_list->AdjustmentFactor_Idn->headerCellClass() ?>"><div id="elh_AdjustmentFactors_AdjustmentFactor_Idn" class="AdjustmentFactors_AdjustmentFactor_Idn"><div class="ew-table-header-caption"><?php echo $AdjustmentFactors_list->AdjustmentFactor_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdjustmentFactor_Idn" class="<?php echo $AdjustmentFactors_list->AdjustmentFactor_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentFactors_list->SortUrl($AdjustmentFactors_list->AdjustmentFactor_Idn) ?>', 1);"><div id="elh_AdjustmentFactors_AdjustmentFactor_Idn" class="AdjustmentFactors_AdjustmentFactor_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentFactors_list->AdjustmentFactor_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentFactors_list->AdjustmentFactor_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentFactors_list->AdjustmentFactor_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentFactors_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($AdjustmentFactors_list->SortUrl($AdjustmentFactors_list->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_AdjustmentFactors_WorksheetMaster_Idn" class="AdjustmentFactors_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentFactors_list->SortUrl($AdjustmentFactors_list->WorksheetMaster_Idn) ?>', 1);"><div id="elh_AdjustmentFactors_WorksheetMaster_Idn" class="AdjustmentFactors_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentFactors_list->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentFactors_list->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentFactors_list->Name->Visible) { // Name ?>
	<?php if ($AdjustmentFactors_list->SortUrl($AdjustmentFactors_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $AdjustmentFactors_list->Name->headerCellClass() ?>"><div id="elh_AdjustmentFactors_Name" class="AdjustmentFactors_Name"><div class="ew-table-header-caption"><?php echo $AdjustmentFactors_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $AdjustmentFactors_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentFactors_list->SortUrl($AdjustmentFactors_list->Name) ?>', 1);"><div id="elh_AdjustmentFactors_Name" class="AdjustmentFactors_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentFactors_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentFactors_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentFactors_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentFactors_list->Rank->Visible) { // Rank ?>
	<?php if ($AdjustmentFactors_list->SortUrl($AdjustmentFactors_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $AdjustmentFactors_list->Rank->headerCellClass() ?>"><div id="elh_AdjustmentFactors_Rank" class="AdjustmentFactors_Rank"><div class="ew-table-header-caption"><?php echo $AdjustmentFactors_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $AdjustmentFactors_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentFactors_list->SortUrl($AdjustmentFactors_list->Rank) ?>', 1);"><div id="elh_AdjustmentFactors_Rank" class="AdjustmentFactors_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentFactors_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentFactors_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentFactors_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentFactors_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($AdjustmentFactors_list->SortUrl($AdjustmentFactors_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $AdjustmentFactors_list->ActiveFlag->headerCellClass() ?>"><div id="elh_AdjustmentFactors_ActiveFlag" class="AdjustmentFactors_ActiveFlag"><div class="ew-table-header-caption"><?php echo $AdjustmentFactors_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $AdjustmentFactors_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentFactors_list->SortUrl($AdjustmentFactors_list->ActiveFlag) ?>', 1);"><div id="elh_AdjustmentFactors_ActiveFlag" class="AdjustmentFactors_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentFactors_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentFactors_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentFactors_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$AdjustmentFactors_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($AdjustmentFactors_list->isAdd() || $AdjustmentFactors_list->isCopy()) {
		$AdjustmentFactors_list->RowIndex = 0;
		$AdjustmentFactors_list->KeyCount = $AdjustmentFactors_list->RowIndex;
		if ($AdjustmentFactors_list->isCopy() && !$AdjustmentFactors_list->loadRow())
			$AdjustmentFactors->CurrentAction = "add";
		if ($AdjustmentFactors_list->isAdd())
			$AdjustmentFactors_list->loadRowValues();
		if ($AdjustmentFactors->EventCancelled) // Insert failed
			$AdjustmentFactors_list->restoreFormValues(); // Restore form values

		// Set row properties
		$AdjustmentFactors->resetAttributes();
		$AdjustmentFactors->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_AdjustmentFactors", "data-rowtype" => ROWTYPE_ADD]);
		$AdjustmentFactors->RowType = ROWTYPE_ADD;

		// Render row
		$AdjustmentFactors_list->renderRow();

		// Render list options
		$AdjustmentFactors_list->renderListOptions();
		$AdjustmentFactors_list->StartRowCount = 0;
?>
	<tr <?php echo $AdjustmentFactors->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AdjustmentFactors_list->ListOptions->render("body", "left", $AdjustmentFactors_list->RowCount);
?>
	<?php if ($AdjustmentFactors_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td data-name="AdjustmentFactor_Idn">
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_AdjustmentFactor_Idn" class="form-group AdjustmentFactors_AdjustmentFactor_Idn"></span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentFactors_list->AdjustmentFactor_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_WorksheetMaster_Idn" class="form-group AdjustmentFactors_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentFactors" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->selectOptionListHtml("x{$AdjustmentFactors_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->Lookup->getParamTag($AdjustmentFactors_list, "p_x" . $AdjustmentFactors_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_WorksheetMaster_Idn" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($AdjustmentFactors_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_Name" class="form-group AdjustmentFactors_Name">
<input type="text" data-table="AdjustmentFactors" data-field="x_Name" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentFactors_list->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_list->Name->EditValue ?>"<?php echo $AdjustmentFactors_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_Name" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentFactors_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_Rank" class="form-group AdjustmentFactors_Rank">
<input type="text" data-table="AdjustmentFactors" data-field="x_Rank" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentFactors_list->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_list->Rank->EditValue ?>"<?php echo $AdjustmentFactors_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_Rank" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentFactors_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_ActiveFlag" class="form-group AdjustmentFactors_ActiveFlag">
<?php
$selwrk = ConvertToBool($AdjustmentFactors_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]_642832" value="1"<?php echo $selwrk ?><?php echo $AdjustmentFactors_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]_642832"></label>
</div>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_ActiveFlag" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($AdjustmentFactors_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AdjustmentFactors_list->ListOptions->render("body", "right", $AdjustmentFactors_list->RowCount);
?>
<script>
loadjs.ready(["fAdjustmentFactorslist", "load"], function() {
	fAdjustmentFactorslist.updateLists(<?php echo $AdjustmentFactors_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($AdjustmentFactors_list->ExportAll && $AdjustmentFactors_list->isExport()) {
	$AdjustmentFactors_list->StopRecord = $AdjustmentFactors_list->TotalRecords;
} else {

	// Set the last record to display
	if ($AdjustmentFactors_list->TotalRecords > $AdjustmentFactors_list->StartRecord + $AdjustmentFactors_list->DisplayRecords - 1)
		$AdjustmentFactors_list->StopRecord = $AdjustmentFactors_list->StartRecord + $AdjustmentFactors_list->DisplayRecords - 1;
	else
		$AdjustmentFactors_list->StopRecord = $AdjustmentFactors_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($AdjustmentFactors->isConfirm() || $AdjustmentFactors_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($AdjustmentFactors_list->FormKeyCountName) && ($AdjustmentFactors_list->isGridAdd() || $AdjustmentFactors_list->isGridEdit() || $AdjustmentFactors->isConfirm())) {
		$AdjustmentFactors_list->KeyCount = $CurrentForm->getValue($AdjustmentFactors_list->FormKeyCountName);
		$AdjustmentFactors_list->StopRecord = $AdjustmentFactors_list->StartRecord + $AdjustmentFactors_list->KeyCount - 1;
	}
}
$AdjustmentFactors_list->RecordCount = $AdjustmentFactors_list->StartRecord - 1;
if ($AdjustmentFactors_list->Recordset && !$AdjustmentFactors_list->Recordset->EOF) {
	$AdjustmentFactors_list->Recordset->moveFirst();
	$selectLimit = $AdjustmentFactors_list->UseSelectLimit;
	if (!$selectLimit && $AdjustmentFactors_list->StartRecord > 1)
		$AdjustmentFactors_list->Recordset->move($AdjustmentFactors_list->StartRecord - 1);
} elseif (!$AdjustmentFactors->AllowAddDeleteRow && $AdjustmentFactors_list->StopRecord == 0) {
	$AdjustmentFactors_list->StopRecord = $AdjustmentFactors->GridAddRowCount;
}

// Initialize aggregate
$AdjustmentFactors->RowType = ROWTYPE_AGGREGATEINIT;
$AdjustmentFactors->resetAttributes();
$AdjustmentFactors_list->renderRow();
$AdjustmentFactors_list->EditRowCount = 0;
if ($AdjustmentFactors_list->isEdit())
	$AdjustmentFactors_list->RowIndex = 1;
if ($AdjustmentFactors_list->isGridAdd())
	$AdjustmentFactors_list->RowIndex = 0;
if ($AdjustmentFactors_list->isGridEdit())
	$AdjustmentFactors_list->RowIndex = 0;
while ($AdjustmentFactors_list->RecordCount < $AdjustmentFactors_list->StopRecord) {
	$AdjustmentFactors_list->RecordCount++;
	if ($AdjustmentFactors_list->RecordCount >= $AdjustmentFactors_list->StartRecord) {
		$AdjustmentFactors_list->RowCount++;
		if ($AdjustmentFactors_list->isGridAdd() || $AdjustmentFactors_list->isGridEdit() || $AdjustmentFactors->isConfirm()) {
			$AdjustmentFactors_list->RowIndex++;
			$CurrentForm->Index = $AdjustmentFactors_list->RowIndex;
			if ($CurrentForm->hasValue($AdjustmentFactors_list->FormActionName) && ($AdjustmentFactors->isConfirm() || $AdjustmentFactors_list->EventCancelled))
				$AdjustmentFactors_list->RowAction = strval($CurrentForm->getValue($AdjustmentFactors_list->FormActionName));
			elseif ($AdjustmentFactors_list->isGridAdd())
				$AdjustmentFactors_list->RowAction = "insert";
			else
				$AdjustmentFactors_list->RowAction = "";
		}

		// Set up key count
		$AdjustmentFactors_list->KeyCount = $AdjustmentFactors_list->RowIndex;

		// Init row class and style
		$AdjustmentFactors->resetAttributes();
		$AdjustmentFactors->CssClass = "";
		if ($AdjustmentFactors_list->isGridAdd()) {
			$AdjustmentFactors_list->loadRowValues(); // Load default values
		} else {
			$AdjustmentFactors_list->loadRowValues($AdjustmentFactors_list->Recordset); // Load row values
		}
		$AdjustmentFactors->RowType = ROWTYPE_VIEW; // Render view
		if ($AdjustmentFactors_list->isGridAdd()) // Grid add
			$AdjustmentFactors->RowType = ROWTYPE_ADD; // Render add
		if ($AdjustmentFactors_list->isGridAdd() && $AdjustmentFactors->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$AdjustmentFactors_list->restoreCurrentRowFormValues($AdjustmentFactors_list->RowIndex); // Restore form values
		if ($AdjustmentFactors_list->isEdit()) {
			if ($AdjustmentFactors_list->checkInlineEditKey() && $AdjustmentFactors_list->EditRowCount == 0) { // Inline edit
				$AdjustmentFactors->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($AdjustmentFactors_list->isGridEdit()) { // Grid edit
			if ($AdjustmentFactors->EventCancelled)
				$AdjustmentFactors_list->restoreCurrentRowFormValues($AdjustmentFactors_list->RowIndex); // Restore form values
			if ($AdjustmentFactors_list->RowAction == "insert")
				$AdjustmentFactors->RowType = ROWTYPE_ADD; // Render add
			else
				$AdjustmentFactors->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($AdjustmentFactors_list->isEdit() && $AdjustmentFactors->RowType == ROWTYPE_EDIT && $AdjustmentFactors->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$AdjustmentFactors_list->restoreFormValues(); // Restore form values
		}
		if ($AdjustmentFactors_list->isGridEdit() && ($AdjustmentFactors->RowType == ROWTYPE_EDIT || $AdjustmentFactors->RowType == ROWTYPE_ADD) && $AdjustmentFactors->EventCancelled) // Update failed
			$AdjustmentFactors_list->restoreCurrentRowFormValues($AdjustmentFactors_list->RowIndex); // Restore form values
		if ($AdjustmentFactors->RowType == ROWTYPE_EDIT) // Edit row
			$AdjustmentFactors_list->EditRowCount++;

		// Set up row id / data-rowindex
		$AdjustmentFactors->RowAttrs->merge(["data-rowindex" => $AdjustmentFactors_list->RowCount, "id" => "r" . $AdjustmentFactors_list->RowCount . "_AdjustmentFactors", "data-rowtype" => $AdjustmentFactors->RowType]);

		// Render row
		$AdjustmentFactors_list->renderRow();

		// Render list options
		$AdjustmentFactors_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($AdjustmentFactors_list->RowAction != "delete" && $AdjustmentFactors_list->RowAction != "insertdelete" && !($AdjustmentFactors_list->RowAction == "insert" && $AdjustmentFactors->isConfirm() && $AdjustmentFactors_list->emptyRow())) {
?>
	<tr <?php echo $AdjustmentFactors->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AdjustmentFactors_list->ListOptions->render("body", "left", $AdjustmentFactors_list->RowCount);
?>
	<?php if ($AdjustmentFactors_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td data-name="AdjustmentFactor_Idn" <?php echo $AdjustmentFactors_list->AdjustmentFactor_Idn->cellAttributes() ?>>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_AdjustmentFactor_Idn" class="form-group"></span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentFactors_list->AdjustmentFactor_Idn->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_AdjustmentFactor_Idn" class="form-group">
<span<?php echo $AdjustmentFactors_list->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentFactors_list->AdjustmentFactor_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_AdjustmentFactor_Idn" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentFactors_list->AdjustmentFactor_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentFactors_list->AdjustmentFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentFactors_list->AdjustmentFactor_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_WorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentFactors" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->selectOptionListHtml("x{$AdjustmentFactors_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->Lookup->getParamTag($AdjustmentFactors_list, "p_x" . $AdjustmentFactors_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_WorksheetMaster_Idn" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($AdjustmentFactors_list->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_WorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentFactors" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->selectOptionListHtml("x{$AdjustmentFactors_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->Lookup->getParamTag($AdjustmentFactors_list, "p_x" . $AdjustmentFactors_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<?php } ?>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_WorksheetMaster_Idn">
<span<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $AdjustmentFactors_list->Name->cellAttributes() ?>>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_Name" class="form-group">
<input type="text" data-table="AdjustmentFactors" data-field="x_Name" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentFactors_list->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_list->Name->EditValue ?>"<?php echo $AdjustmentFactors_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_Name" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentFactors_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_Name" class="form-group">
<input type="text" data-table="AdjustmentFactors" data-field="x_Name" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentFactors_list->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_list->Name->EditValue ?>"<?php echo $AdjustmentFactors_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_Name">
<span<?php echo $AdjustmentFactors_list->Name->viewAttributes() ?>><?php echo $AdjustmentFactors_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $AdjustmentFactors_list->Rank->cellAttributes() ?>>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_Rank" class="form-group">
<input type="text" data-table="AdjustmentFactors" data-field="x_Rank" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentFactors_list->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_list->Rank->EditValue ?>"<?php echo $AdjustmentFactors_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_Rank" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentFactors_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_Rank" class="form-group">
<input type="text" data-table="AdjustmentFactors" data-field="x_Rank" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentFactors_list->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_list->Rank->EditValue ?>"<?php echo $AdjustmentFactors_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_Rank">
<span<?php echo $AdjustmentFactors_list->Rank->viewAttributes() ?>><?php echo $AdjustmentFactors_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $AdjustmentFactors_list->ActiveFlag->cellAttributes() ?>>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($AdjustmentFactors_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]_248360" value="1"<?php echo $selwrk ?><?php echo $AdjustmentFactors_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]_248360"></label>
</div>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_ActiveFlag" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($AdjustmentFactors_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($AdjustmentFactors_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]_706979" value="1"<?php echo $selwrk ?><?php echo $AdjustmentFactors_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]_706979"></label>
</div>
</span>
<?php } ?>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentFactors_list->RowCount ?>_AdjustmentFactors_ActiveFlag">
<span<?php echo $AdjustmentFactors_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $AdjustmentFactors_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($AdjustmentFactors_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AdjustmentFactors_list->ListOptions->render("body", "right", $AdjustmentFactors_list->RowCount);
?>
	</tr>
<?php if ($AdjustmentFactors->RowType == ROWTYPE_ADD || $AdjustmentFactors->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fAdjustmentFactorslist", "load"], function() {
	fAdjustmentFactorslist.updateLists(<?php echo $AdjustmentFactors_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$AdjustmentFactors_list->isGridAdd())
		if (!$AdjustmentFactors_list->Recordset->EOF)
			$AdjustmentFactors_list->Recordset->moveNext();
}
?>
<?php
	if ($AdjustmentFactors_list->isGridAdd() || $AdjustmentFactors_list->isGridEdit()) {
		$AdjustmentFactors_list->RowIndex = '$rowindex$';
		$AdjustmentFactors_list->loadRowValues();

		// Set row properties
		$AdjustmentFactors->resetAttributes();
		$AdjustmentFactors->RowAttrs->merge(["data-rowindex" => $AdjustmentFactors_list->RowIndex, "id" => "r0_AdjustmentFactors", "data-rowtype" => ROWTYPE_ADD]);
		$AdjustmentFactors->RowAttrs->appendClass("ew-template");
		$AdjustmentFactors->RowType = ROWTYPE_ADD;

		// Render row
		$AdjustmentFactors_list->renderRow();

		// Render list options
		$AdjustmentFactors_list->renderListOptions();
		$AdjustmentFactors_list->StartRowCount = 0;
?>
	<tr <?php echo $AdjustmentFactors->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AdjustmentFactors_list->ListOptions->render("body", "left", $AdjustmentFactors_list->RowIndex);
?>
	<?php if ($AdjustmentFactors_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td data-name="AdjustmentFactor_Idn">
<span id="el$rowindex$_AdjustmentFactors_AdjustmentFactor_Idn" class="form-group AdjustmentFactors_AdjustmentFactor_Idn"></span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentFactors_list->AdjustmentFactor_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el$rowindex$_AdjustmentFactors_WorksheetMaster_Idn" class="form-group AdjustmentFactors_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentFactors" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->selectOptionListHtml("x{$AdjustmentFactors_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentFactors_list->WorksheetMaster_Idn->Lookup->getParamTag($AdjustmentFactors_list, "p_x" . $AdjustmentFactors_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_WorksheetMaster_Idn" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($AdjustmentFactors_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_AdjustmentFactors_Name" class="form-group AdjustmentFactors_Name">
<input type="text" data-table="AdjustmentFactors" data-field="x_Name" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentFactors_list->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_list->Name->EditValue ?>"<?php echo $AdjustmentFactors_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_Name" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentFactors_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_AdjustmentFactors_Rank" class="form-group AdjustmentFactors_Rank">
<input type="text" data-table="AdjustmentFactors" data-field="x_Rank" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentFactors_list->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentFactors_list->Rank->EditValue ?>"<?php echo $AdjustmentFactors_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_Rank" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentFactors_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentFactors_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_AdjustmentFactors_ActiveFlag" class="form-group AdjustmentFactors_ActiveFlag">
<?php
$selwrk = ConvertToBool($AdjustmentFactors_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]_812819" value="1"<?php echo $selwrk ?><?php echo $AdjustmentFactors_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]_812819"></label>
</div>
</span>
<input type="hidden" data-table="AdjustmentFactors" data-field="x_ActiveFlag" name="o<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $AdjustmentFactors_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($AdjustmentFactors_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AdjustmentFactors_list->ListOptions->render("body", "right", $AdjustmentFactors_list->RowIndex);
?>
<script>
loadjs.ready(["fAdjustmentFactorslist", "load"], function() {
	fAdjustmentFactorslist.updateLists(<?php echo $AdjustmentFactors_list->RowIndex ?>);
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
<?php if ($AdjustmentFactors_list->isAdd() || $AdjustmentFactors_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $AdjustmentFactors_list->FormKeyCountName ?>" id="<?php echo $AdjustmentFactors_list->FormKeyCountName ?>" value="<?php echo $AdjustmentFactors_list->KeyCount ?>">
<?php } ?>
<?php if ($AdjustmentFactors_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $AdjustmentFactors_list->FormKeyCountName ?>" id="<?php echo $AdjustmentFactors_list->FormKeyCountName ?>" value="<?php echo $AdjustmentFactors_list->KeyCount ?>">
<?php echo $AdjustmentFactors_list->MultiSelectKey ?>
<?php } ?>
<?php if ($AdjustmentFactors_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $AdjustmentFactors_list->FormKeyCountName ?>" id="<?php echo $AdjustmentFactors_list->FormKeyCountName ?>" value="<?php echo $AdjustmentFactors_list->KeyCount ?>">
<?php } ?>
<?php if ($AdjustmentFactors_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $AdjustmentFactors_list->FormKeyCountName ?>" id="<?php echo $AdjustmentFactors_list->FormKeyCountName ?>" value="<?php echo $AdjustmentFactors_list->KeyCount ?>">
<?php echo $AdjustmentFactors_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$AdjustmentFactors->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($AdjustmentFactors_list->Recordset)
	$AdjustmentFactors_list->Recordset->Close();
?>
<?php if (!$AdjustmentFactors_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$AdjustmentFactors_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $AdjustmentFactors_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $AdjustmentFactors_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($AdjustmentFactors_list->TotalRecords == 0 && !$AdjustmentFactors->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $AdjustmentFactors_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$AdjustmentFactors_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$AdjustmentFactors_list->isExport()) { ?>
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
$AdjustmentFactors_list->terminate();
?>