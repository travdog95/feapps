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
$Fittings_list = new Fittings_list();

// Run the page
$Fittings_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Fittings_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Fittings_list->isExport()) { ?>
<script>
var fFittingslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fFittingslist = currentForm = new ew.Form("fFittingslist", "list");
	fFittingslist.formKeyCountName = '<?php echo $Fittings_list->FormKeyCountName ?>';

	// Validate form
	fFittingslist.validate = function() {
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
			<?php if ($Fittings_list->Fitting_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Fitting_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_list->Fitting_Idn->caption(), $Fittings_list->Fitting_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_list->Name->caption(), $Fittings_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_list->Department_Idn->caption(), $Fittings_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_list->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_list->WorksheetMaster_Idn->caption(), $Fittings_list->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_list->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_list->WorksheetCategory_Idn->caption(), $Fittings_list->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_list->PartOfSetFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_PartOfSetFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_list->PartOfSetFlag->caption(), $Fittings_list->PartOfSetFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Fittings_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_list->Rank->caption(), $Fittings_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Fittings_list->Rank->errorMessage()) ?>");
			<?php if ($Fittings_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Fittings_list->ActiveFlag->caption(), $Fittings_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fFittingslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "WorksheetMaster_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "WorksheetCategory_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "PartOfSetFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fFittingslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fFittingslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fFittingslist.lists["x_Department_Idn"] = <?php echo $Fittings_list->Department_Idn->Lookup->toClientList($Fittings_list) ?>;
	fFittingslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($Fittings_list->Department_Idn->lookupOptions()) ?>;
	fFittingslist.lists["x_WorksheetMaster_Idn"] = <?php echo $Fittings_list->WorksheetMaster_Idn->Lookup->toClientList($Fittings_list) ?>;
	fFittingslist.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($Fittings_list->WorksheetMaster_Idn->lookupOptions()) ?>;
	fFittingslist.lists["x_WorksheetCategory_Idn"] = <?php echo $Fittings_list->WorksheetCategory_Idn->Lookup->toClientList($Fittings_list) ?>;
	fFittingslist.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($Fittings_list->WorksheetCategory_Idn->lookupOptions()) ?>;
	fFittingslist.lists["x_PartOfSetFlag[]"] = <?php echo $Fittings_list->PartOfSetFlag->Lookup->toClientList($Fittings_list) ?>;
	fFittingslist.lists["x_PartOfSetFlag[]"].options = <?php echo JsonEncode($Fittings_list->PartOfSetFlag->options(FALSE, TRUE)) ?>;
	fFittingslist.lists["x_ActiveFlag[]"] = <?php echo $Fittings_list->ActiveFlag->Lookup->toClientList($Fittings_list) ?>;
	fFittingslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Fittings_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fFittingslist");
});
var fFittingslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fFittingslistsrch = currentSearchForm = new ew.Form("fFittingslistsrch");

	// Dynamic selection lists
	// Filters

	fFittingslistsrch.filterList = <?php echo $Fittings_list->getFilterList() ?>;
	loadjs.done("fFittingslistsrch");
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
<?php if (!$Fittings_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Fittings_list->TotalRecords > 0 && $Fittings_list->ExportOptions->visible()) { ?>
<?php $Fittings_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Fittings_list->ImportOptions->visible()) { ?>
<?php $Fittings_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Fittings_list->SearchOptions->visible()) { ?>
<?php $Fittings_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Fittings_list->FilterOptions->visible()) { ?>
<?php $Fittings_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Fittings_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Fittings_list->isExport() && !$Fittings->CurrentAction) { ?>
<form name="fFittingslistsrch" id="fFittingslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fFittingslistsrch-search-panel" class="<?php echo $Fittings_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Fittings">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Fittings_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Fittings_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Fittings_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Fittings_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Fittings_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Fittings_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Fittings_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Fittings_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Fittings_list->showPageHeader(); ?>
<?php
$Fittings_list->showMessage();
?>
<?php if ($Fittings_list->TotalRecords > 0 || $Fittings->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Fittings_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Fittings">
<?php if (!$Fittings_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Fittings_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Fittings_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Fittings_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fFittingslist" id="fFittingslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Fittings">
<div id="gmp_Fittings" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Fittings_list->TotalRecords > 0 || $Fittings_list->isAdd() || $Fittings_list->isCopy() || $Fittings_list->isGridEdit()) { ?>
<table id="tbl_Fittingslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Fittings->RowType = ROWTYPE_HEADER;

// Render list options
$Fittings_list->renderListOptions();

// Render list options (header, left)
$Fittings_list->ListOptions->render("header", "left");
?>
<?php if ($Fittings_list->Fitting_Idn->Visible) { // Fitting_Idn ?>
	<?php if ($Fittings_list->SortUrl($Fittings_list->Fitting_Idn) == "") { ?>
		<th data-name="Fitting_Idn" class="<?php echo $Fittings_list->Fitting_Idn->headerCellClass() ?>"><div id="elh_Fittings_Fitting_Idn" class="Fittings_Fitting_Idn"><div class="ew-table-header-caption"><?php echo $Fittings_list->Fitting_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fitting_Idn" class="<?php echo $Fittings_list->Fitting_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Fittings_list->SortUrl($Fittings_list->Fitting_Idn) ?>', 1);"><div id="elh_Fittings_Fitting_Idn" class="Fittings_Fitting_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Fittings_list->Fitting_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Fittings_list->Fitting_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Fittings_list->Fitting_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Fittings_list->Name->Visible) { // Name ?>
	<?php if ($Fittings_list->SortUrl($Fittings_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $Fittings_list->Name->headerCellClass() ?>"><div id="elh_Fittings_Name" class="Fittings_Name"><div class="ew-table-header-caption"><?php echo $Fittings_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $Fittings_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Fittings_list->SortUrl($Fittings_list->Name) ?>', 1);"><div id="elh_Fittings_Name" class="Fittings_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Fittings_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Fittings_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Fittings_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Fittings_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($Fittings_list->SortUrl($Fittings_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $Fittings_list->Department_Idn->headerCellClass() ?>"><div id="elh_Fittings_Department_Idn" class="Fittings_Department_Idn"><div class="ew-table-header-caption"><?php echo $Fittings_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $Fittings_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Fittings_list->SortUrl($Fittings_list->Department_Idn) ?>', 1);"><div id="elh_Fittings_Department_Idn" class="Fittings_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Fittings_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Fittings_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Fittings_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Fittings_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($Fittings_list->SortUrl($Fittings_list->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $Fittings_list->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_Fittings_WorksheetMaster_Idn" class="Fittings_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $Fittings_list->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $Fittings_list->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Fittings_list->SortUrl($Fittings_list->WorksheetMaster_Idn) ?>', 1);"><div id="elh_Fittings_WorksheetMaster_Idn" class="Fittings_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Fittings_list->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Fittings_list->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Fittings_list->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Fittings_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<?php if ($Fittings_list->SortUrl($Fittings_list->WorksheetCategory_Idn) == "") { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $Fittings_list->WorksheetCategory_Idn->headerCellClass() ?>"><div id="elh_Fittings_WorksheetCategory_Idn" class="Fittings_WorksheetCategory_Idn"><div class="ew-table-header-caption"><?php echo $Fittings_list->WorksheetCategory_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $Fittings_list->WorksheetCategory_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Fittings_list->SortUrl($Fittings_list->WorksheetCategory_Idn) ?>', 1);"><div id="elh_Fittings_WorksheetCategory_Idn" class="Fittings_WorksheetCategory_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Fittings_list->WorksheetCategory_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Fittings_list->WorksheetCategory_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Fittings_list->WorksheetCategory_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Fittings_list->PartOfSetFlag->Visible) { // PartOfSetFlag ?>
	<?php if ($Fittings_list->SortUrl($Fittings_list->PartOfSetFlag) == "") { ?>
		<th data-name="PartOfSetFlag" class="<?php echo $Fittings_list->PartOfSetFlag->headerCellClass() ?>"><div id="elh_Fittings_PartOfSetFlag" class="Fittings_PartOfSetFlag"><div class="ew-table-header-caption"><?php echo $Fittings_list->PartOfSetFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PartOfSetFlag" class="<?php echo $Fittings_list->PartOfSetFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Fittings_list->SortUrl($Fittings_list->PartOfSetFlag) ?>', 1);"><div id="elh_Fittings_PartOfSetFlag" class="Fittings_PartOfSetFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Fittings_list->PartOfSetFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Fittings_list->PartOfSetFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Fittings_list->PartOfSetFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Fittings_list->Rank->Visible) { // Rank ?>
	<?php if ($Fittings_list->SortUrl($Fittings_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $Fittings_list->Rank->headerCellClass() ?>"><div id="elh_Fittings_Rank" class="Fittings_Rank"><div class="ew-table-header-caption"><?php echo $Fittings_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $Fittings_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Fittings_list->SortUrl($Fittings_list->Rank) ?>', 1);"><div id="elh_Fittings_Rank" class="Fittings_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Fittings_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($Fittings_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Fittings_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Fittings_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($Fittings_list->SortUrl($Fittings_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $Fittings_list->ActiveFlag->headerCellClass() ?>"><div id="elh_Fittings_ActiveFlag" class="Fittings_ActiveFlag"><div class="ew-table-header-caption"><?php echo $Fittings_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $Fittings_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Fittings_list->SortUrl($Fittings_list->ActiveFlag) ?>', 1);"><div id="elh_Fittings_ActiveFlag" class="Fittings_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Fittings_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Fittings_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Fittings_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Fittings_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($Fittings_list->isAdd() || $Fittings_list->isCopy()) {
		$Fittings_list->RowIndex = 0;
		$Fittings_list->KeyCount = $Fittings_list->RowIndex;
		if ($Fittings_list->isCopy() && !$Fittings_list->loadRow())
			$Fittings->CurrentAction = "add";
		if ($Fittings_list->isAdd())
			$Fittings_list->loadRowValues();
		if ($Fittings->EventCancelled) // Insert failed
			$Fittings_list->restoreFormValues(); // Restore form values

		// Set row properties
		$Fittings->resetAttributes();
		$Fittings->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_Fittings", "data-rowtype" => ROWTYPE_ADD]);
		$Fittings->RowType = ROWTYPE_ADD;

		// Render row
		$Fittings_list->renderRow();

		// Render list options
		$Fittings_list->renderListOptions();
		$Fittings_list->StartRowCount = 0;
?>
	<tr <?php echo $Fittings->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Fittings_list->ListOptions->render("body", "left", $Fittings_list->RowCount);
?>
	<?php if ($Fittings_list->Fitting_Idn->Visible) { // Fitting_Idn ?>
		<td data-name="Fitting_Idn">
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Fitting_Idn" class="form-group Fittings_Fitting_Idn"></span>
<input type="hidden" data-table="Fittings" data-field="x_Fitting_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_Fitting_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_Fitting_Idn" value="<?php echo HtmlEncode($Fittings_list->Fitting_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Name" class="form-group Fittings_Name">
<input type="text" data-table="Fittings" data-field="x_Name" name="x<?php echo $Fittings_list->RowIndex ?>_Name" id="x<?php echo $Fittings_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Fittings_list->Name->getPlaceHolder()) ?>" value="<?php echo $Fittings_list->Name->EditValue ?>"<?php echo $Fittings_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Fittings" data-field="x_Name" name="o<?php echo $Fittings_list->RowIndex ?>_Name" id="o<?php echo $Fittings_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Fittings_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Department_Idn" class="form-group Fittings_Department_Idn">
<?php $Fittings_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_Department_Idn" data-value-separator="<?php echo $Fittings_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_Department_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_Department_Idn"<?php echo $Fittings_list->Department_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->Department_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->Department_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="Fittings" data-field="x_Department_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_Department_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($Fittings_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_WorksheetMaster_Idn" class="form-group Fittings_WorksheetMaster_Idn">
<?php $Fittings_list->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $Fittings_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $Fittings_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->WorksheetMaster_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->WorksheetMaster_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="Fittings" data-field="x_WorksheetMaster_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($Fittings_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn">
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_WorksheetCategory_Idn" class="form-group Fittings_WorksheetCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $Fittings_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $Fittings_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->WorksheetCategory_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->WorksheetCategory_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<input type="hidden" data-table="Fittings" data-field="x_WorksheetCategory_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($Fittings_list->WorksheetCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->PartOfSetFlag->Visible) { // PartOfSetFlag ?>
		<td data-name="PartOfSetFlag">
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_PartOfSetFlag" class="form-group Fittings_PartOfSetFlag">
<?php
$selwrk = ConvertToBool($Fittings_list->PartOfSetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_PartOfSetFlag" name="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]" id="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]_146577" value="1"<?php echo $selwrk ?><?php echo $Fittings_list->PartOfSetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]_146577"></label>
</div>
</span>
<input type="hidden" data-table="Fittings" data-field="x_PartOfSetFlag" name="o<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]" id="o<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]" value="<?php echo HtmlEncode($Fittings_list->PartOfSetFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Rank" class="form-group Fittings_Rank">
<input type="text" data-table="Fittings" data-field="x_Rank" name="x<?php echo $Fittings_list->RowIndex ?>_Rank" id="x<?php echo $Fittings_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Fittings_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Fittings_list->Rank->EditValue ?>"<?php echo $Fittings_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Fittings" data-field="x_Rank" name="o<?php echo $Fittings_list->RowIndex ?>_Rank" id="o<?php echo $Fittings_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Fittings_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_ActiveFlag" class="form-group Fittings_ActiveFlag">
<?php
$selwrk = ConvertToBool($Fittings_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_ActiveFlag" name="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]_277798" value="1"<?php echo $selwrk ?><?php echo $Fittings_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]_277798"></label>
</div>
</span>
<input type="hidden" data-table="Fittings" data-field="x_ActiveFlag" name="o<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Fittings_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Fittings_list->ListOptions->render("body", "right", $Fittings_list->RowCount);
?>
<script>
loadjs.ready(["fFittingslist", "load"], function() {
	fFittingslist.updateLists(<?php echo $Fittings_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($Fittings_list->ExportAll && $Fittings_list->isExport()) {
	$Fittings_list->StopRecord = $Fittings_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Fittings_list->TotalRecords > $Fittings_list->StartRecord + $Fittings_list->DisplayRecords - 1)
		$Fittings_list->StopRecord = $Fittings_list->StartRecord + $Fittings_list->DisplayRecords - 1;
	else
		$Fittings_list->StopRecord = $Fittings_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($Fittings->isConfirm() || $Fittings_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Fittings_list->FormKeyCountName) && ($Fittings_list->isGridAdd() || $Fittings_list->isGridEdit() || $Fittings->isConfirm())) {
		$Fittings_list->KeyCount = $CurrentForm->getValue($Fittings_list->FormKeyCountName);
		$Fittings_list->StopRecord = $Fittings_list->StartRecord + $Fittings_list->KeyCount - 1;
	}
}
$Fittings_list->RecordCount = $Fittings_list->StartRecord - 1;
if ($Fittings_list->Recordset && !$Fittings_list->Recordset->EOF) {
	$Fittings_list->Recordset->moveFirst();
	$selectLimit = $Fittings_list->UseSelectLimit;
	if (!$selectLimit && $Fittings_list->StartRecord > 1)
		$Fittings_list->Recordset->move($Fittings_list->StartRecord - 1);
} elseif (!$Fittings->AllowAddDeleteRow && $Fittings_list->StopRecord == 0) {
	$Fittings_list->StopRecord = $Fittings->GridAddRowCount;
}

// Initialize aggregate
$Fittings->RowType = ROWTYPE_AGGREGATEINIT;
$Fittings->resetAttributes();
$Fittings_list->renderRow();
$Fittings_list->EditRowCount = 0;
if ($Fittings_list->isEdit())
	$Fittings_list->RowIndex = 1;
if ($Fittings_list->isGridAdd())
	$Fittings_list->RowIndex = 0;
if ($Fittings_list->isGridEdit())
	$Fittings_list->RowIndex = 0;
while ($Fittings_list->RecordCount < $Fittings_list->StopRecord) {
	$Fittings_list->RecordCount++;
	if ($Fittings_list->RecordCount >= $Fittings_list->StartRecord) {
		$Fittings_list->RowCount++;
		if ($Fittings_list->isGridAdd() || $Fittings_list->isGridEdit() || $Fittings->isConfirm()) {
			$Fittings_list->RowIndex++;
			$CurrentForm->Index = $Fittings_list->RowIndex;
			if ($CurrentForm->hasValue($Fittings_list->FormActionName) && ($Fittings->isConfirm() || $Fittings_list->EventCancelled))
				$Fittings_list->RowAction = strval($CurrentForm->getValue($Fittings_list->FormActionName));
			elseif ($Fittings_list->isGridAdd())
				$Fittings_list->RowAction = "insert";
			else
				$Fittings_list->RowAction = "";
		}

		// Set up key count
		$Fittings_list->KeyCount = $Fittings_list->RowIndex;

		// Init row class and style
		$Fittings->resetAttributes();
		$Fittings->CssClass = "";
		if ($Fittings_list->isGridAdd()) {
			$Fittings_list->loadRowValues(); // Load default values
		} else {
			$Fittings_list->loadRowValues($Fittings_list->Recordset); // Load row values
		}
		$Fittings->RowType = ROWTYPE_VIEW; // Render view
		if ($Fittings_list->isGridAdd()) // Grid add
			$Fittings->RowType = ROWTYPE_ADD; // Render add
		if ($Fittings_list->isGridAdd() && $Fittings->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Fittings_list->restoreCurrentRowFormValues($Fittings_list->RowIndex); // Restore form values
		if ($Fittings_list->isEdit()) {
			if ($Fittings_list->checkInlineEditKey() && $Fittings_list->EditRowCount == 0) { // Inline edit
				$Fittings->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($Fittings_list->isGridEdit()) { // Grid edit
			if ($Fittings->EventCancelled)
				$Fittings_list->restoreCurrentRowFormValues($Fittings_list->RowIndex); // Restore form values
			if ($Fittings_list->RowAction == "insert")
				$Fittings->RowType = ROWTYPE_ADD; // Render add
			else
				$Fittings->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Fittings_list->isEdit() && $Fittings->RowType == ROWTYPE_EDIT && $Fittings->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$Fittings_list->restoreFormValues(); // Restore form values
		}
		if ($Fittings_list->isGridEdit() && ($Fittings->RowType == ROWTYPE_EDIT || $Fittings->RowType == ROWTYPE_ADD) && $Fittings->EventCancelled) // Update failed
			$Fittings_list->restoreCurrentRowFormValues($Fittings_list->RowIndex); // Restore form values
		if ($Fittings->RowType == ROWTYPE_EDIT) // Edit row
			$Fittings_list->EditRowCount++;

		// Set up row id / data-rowindex
		$Fittings->RowAttrs->merge(["data-rowindex" => $Fittings_list->RowCount, "id" => "r" . $Fittings_list->RowCount . "_Fittings", "data-rowtype" => $Fittings->RowType]);

		// Render row
		$Fittings_list->renderRow();

		// Render list options
		$Fittings_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Fittings_list->RowAction != "delete" && $Fittings_list->RowAction != "insertdelete" && !($Fittings_list->RowAction == "insert" && $Fittings->isConfirm() && $Fittings_list->emptyRow())) {
?>
	<tr <?php echo $Fittings->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Fittings_list->ListOptions->render("body", "left", $Fittings_list->RowCount);
?>
	<?php if ($Fittings_list->Fitting_Idn->Visible) { // Fitting_Idn ?>
		<td data-name="Fitting_Idn" <?php echo $Fittings_list->Fitting_Idn->cellAttributes() ?>>
<?php if ($Fittings->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Fitting_Idn" class="form-group"></span>
<input type="hidden" data-table="Fittings" data-field="x_Fitting_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_Fitting_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_Fitting_Idn" value="<?php echo HtmlEncode($Fittings_list->Fitting_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Fitting_Idn" class="form-group">
<span<?php echo $Fittings_list->Fitting_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Fittings_list->Fitting_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Fittings" data-field="x_Fitting_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_Fitting_Idn" id="x<?php echo $Fittings_list->RowIndex ?>_Fitting_Idn" value="<?php echo HtmlEncode($Fittings_list->Fitting_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Fitting_Idn">
<span<?php echo $Fittings_list->Fitting_Idn->viewAttributes() ?>><?php echo $Fittings_list->Fitting_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Fittings_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $Fittings_list->Name->cellAttributes() ?>>
<?php if ($Fittings->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Name" class="form-group">
<input type="text" data-table="Fittings" data-field="x_Name" name="x<?php echo $Fittings_list->RowIndex ?>_Name" id="x<?php echo $Fittings_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Fittings_list->Name->getPlaceHolder()) ?>" value="<?php echo $Fittings_list->Name->EditValue ?>"<?php echo $Fittings_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Fittings" data-field="x_Name" name="o<?php echo $Fittings_list->RowIndex ?>_Name" id="o<?php echo $Fittings_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Fittings_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Name" class="form-group">
<input type="text" data-table="Fittings" data-field="x_Name" name="x<?php echo $Fittings_list->RowIndex ?>_Name" id="x<?php echo $Fittings_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Fittings_list->Name->getPlaceHolder()) ?>" value="<?php echo $Fittings_list->Name->EditValue ?>"<?php echo $Fittings_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Name">
<span<?php echo $Fittings_list->Name->viewAttributes() ?>><?php echo $Fittings_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Fittings_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $Fittings_list->Department_Idn->cellAttributes() ?>>
<?php if ($Fittings->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Department_Idn" class="form-group">
<?php $Fittings_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_Department_Idn" data-value-separator="<?php echo $Fittings_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_Department_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_Department_Idn"<?php echo $Fittings_list->Department_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->Department_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->Department_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="Fittings" data-field="x_Department_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_Department_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($Fittings_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Department_Idn" class="form-group">
<?php $Fittings_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_Department_Idn" data-value-separator="<?php echo $Fittings_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_Department_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_Department_Idn"<?php echo $Fittings_list->Department_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->Department_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->Department_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Department_Idn">
<span<?php echo $Fittings_list->Department_Idn->viewAttributes() ?>><?php echo $Fittings_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Fittings_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $Fittings_list->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($Fittings->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_WorksheetMaster_Idn" class="form-group">
<?php $Fittings_list->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $Fittings_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $Fittings_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->WorksheetMaster_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->WorksheetMaster_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="Fittings" data-field="x_WorksheetMaster_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($Fittings_list->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_WorksheetMaster_Idn" class="form-group">
<?php $Fittings_list->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $Fittings_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $Fittings_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->WorksheetMaster_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->WorksheetMaster_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_WorksheetMaster_Idn">
<span<?php echo $Fittings_list->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $Fittings_list->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Fittings_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn" <?php echo $Fittings_list->WorksheetCategory_Idn->cellAttributes() ?>>
<?php if ($Fittings->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_WorksheetCategory_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $Fittings_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $Fittings_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->WorksheetCategory_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->WorksheetCategory_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<input type="hidden" data-table="Fittings" data-field="x_WorksheetCategory_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($Fittings_list->WorksheetCategory_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_WorksheetCategory_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $Fittings_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $Fittings_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->WorksheetCategory_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->WorksheetCategory_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_WorksheetCategory_Idn">
<span<?php echo $Fittings_list->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $Fittings_list->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Fittings_list->PartOfSetFlag->Visible) { // PartOfSetFlag ?>
		<td data-name="PartOfSetFlag" <?php echo $Fittings_list->PartOfSetFlag->cellAttributes() ?>>
<?php if ($Fittings->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_PartOfSetFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Fittings_list->PartOfSetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_PartOfSetFlag" name="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]" id="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]_795553" value="1"<?php echo $selwrk ?><?php echo $Fittings_list->PartOfSetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]_795553"></label>
</div>
</span>
<input type="hidden" data-table="Fittings" data-field="x_PartOfSetFlag" name="o<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]" id="o<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]" value="<?php echo HtmlEncode($Fittings_list->PartOfSetFlag->OldValue) ?>">
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_PartOfSetFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Fittings_list->PartOfSetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_PartOfSetFlag" name="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]" id="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]_860029" value="1"<?php echo $selwrk ?><?php echo $Fittings_list->PartOfSetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]_860029"></label>
</div>
</span>
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_PartOfSetFlag">
<span<?php echo $Fittings_list->PartOfSetFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_PartOfSetFlag" class="custom-control-input" value="<?php echo $Fittings_list->PartOfSetFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Fittings_list->PartOfSetFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_PartOfSetFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Fittings_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $Fittings_list->Rank->cellAttributes() ?>>
<?php if ($Fittings->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Rank" class="form-group">
<input type="text" data-table="Fittings" data-field="x_Rank" name="x<?php echo $Fittings_list->RowIndex ?>_Rank" id="x<?php echo $Fittings_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Fittings_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Fittings_list->Rank->EditValue ?>"<?php echo $Fittings_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Fittings" data-field="x_Rank" name="o<?php echo $Fittings_list->RowIndex ?>_Rank" id="o<?php echo $Fittings_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Fittings_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Rank" class="form-group">
<input type="text" data-table="Fittings" data-field="x_Rank" name="x<?php echo $Fittings_list->RowIndex ?>_Rank" id="x<?php echo $Fittings_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Fittings_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Fittings_list->Rank->EditValue ?>"<?php echo $Fittings_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_Rank">
<span<?php echo $Fittings_list->Rank->viewAttributes() ?>><?php echo $Fittings_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Fittings_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $Fittings_list->ActiveFlag->cellAttributes() ?>>
<?php if ($Fittings->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Fittings_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_ActiveFlag" name="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]_344714" value="1"<?php echo $selwrk ?><?php echo $Fittings_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]_344714"></label>
</div>
</span>
<input type="hidden" data-table="Fittings" data-field="x_ActiveFlag" name="o<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Fittings_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Fittings_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_ActiveFlag" name="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]_697899" value="1"<?php echo $selwrk ?><?php echo $Fittings_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]_697899"></label>
</div>
</span>
<?php } ?>
<?php if ($Fittings->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Fittings_list->RowCount ?>_Fittings_ActiveFlag">
<span<?php echo $Fittings_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Fittings_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Fittings_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Fittings_list->ListOptions->render("body", "right", $Fittings_list->RowCount);
?>
	</tr>
<?php if ($Fittings->RowType == ROWTYPE_ADD || $Fittings->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fFittingslist", "load"], function() {
	fFittingslist.updateLists(<?php echo $Fittings_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Fittings_list->isGridAdd())
		if (!$Fittings_list->Recordset->EOF)
			$Fittings_list->Recordset->moveNext();
}
?>
<?php
	if ($Fittings_list->isGridAdd() || $Fittings_list->isGridEdit()) {
		$Fittings_list->RowIndex = '$rowindex$';
		$Fittings_list->loadRowValues();

		// Set row properties
		$Fittings->resetAttributes();
		$Fittings->RowAttrs->merge(["data-rowindex" => $Fittings_list->RowIndex, "id" => "r0_Fittings", "data-rowtype" => ROWTYPE_ADD]);
		$Fittings->RowAttrs->appendClass("ew-template");
		$Fittings->RowType = ROWTYPE_ADD;

		// Render row
		$Fittings_list->renderRow();

		// Render list options
		$Fittings_list->renderListOptions();
		$Fittings_list->StartRowCount = 0;
?>
	<tr <?php echo $Fittings->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Fittings_list->ListOptions->render("body", "left", $Fittings_list->RowIndex);
?>
	<?php if ($Fittings_list->Fitting_Idn->Visible) { // Fitting_Idn ?>
		<td data-name="Fitting_Idn">
<span id="el$rowindex$_Fittings_Fitting_Idn" class="form-group Fittings_Fitting_Idn"></span>
<input type="hidden" data-table="Fittings" data-field="x_Fitting_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_Fitting_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_Fitting_Idn" value="<?php echo HtmlEncode($Fittings_list->Fitting_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_Fittings_Name" class="form-group Fittings_Name">
<input type="text" data-table="Fittings" data-field="x_Name" name="x<?php echo $Fittings_list->RowIndex ?>_Name" id="x<?php echo $Fittings_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Fittings_list->Name->getPlaceHolder()) ?>" value="<?php echo $Fittings_list->Name->EditValue ?>"<?php echo $Fittings_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Fittings" data-field="x_Name" name="o<?php echo $Fittings_list->RowIndex ?>_Name" id="o<?php echo $Fittings_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Fittings_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_Fittings_Department_Idn" class="form-group Fittings_Department_Idn">
<?php $Fittings_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_Department_Idn" data-value-separator="<?php echo $Fittings_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_Department_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_Department_Idn"<?php echo $Fittings_list->Department_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->Department_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->Department_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="Fittings" data-field="x_Department_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_Department_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($Fittings_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el$rowindex$_Fittings_WorksheetMaster_Idn" class="form-group Fittings_WorksheetMaster_Idn">
<?php $Fittings_list->WorksheetMaster_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $Fittings_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $Fittings_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->WorksheetMaster_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->WorksheetMaster_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="Fittings" data-field="x_WorksheetMaster_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($Fittings_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn">
<span id="el$rowindex$_Fittings_WorksheetCategory_Idn" class="form-group Fittings_WorksheetCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Fittings" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $Fittings_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $Fittings_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $Fittings_list->WorksheetCategory_Idn->selectOptionListHtml("x{$Fittings_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $Fittings_list->WorksheetCategory_Idn->Lookup->getParamTag($Fittings_list, "p_x" . $Fittings_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<input type="hidden" data-table="Fittings" data-field="x_WorksheetCategory_Idn" name="o<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $Fittings_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($Fittings_list->WorksheetCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->PartOfSetFlag->Visible) { // PartOfSetFlag ?>
		<td data-name="PartOfSetFlag">
<span id="el$rowindex$_Fittings_PartOfSetFlag" class="form-group Fittings_PartOfSetFlag">
<?php
$selwrk = ConvertToBool($Fittings_list->PartOfSetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_PartOfSetFlag" name="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]" id="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]_188112" value="1"<?php echo $selwrk ?><?php echo $Fittings_list->PartOfSetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]_188112"></label>
</div>
</span>
<input type="hidden" data-table="Fittings" data-field="x_PartOfSetFlag" name="o<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]" id="o<?php echo $Fittings_list->RowIndex ?>_PartOfSetFlag[]" value="<?php echo HtmlEncode($Fittings_list->PartOfSetFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_Fittings_Rank" class="form-group Fittings_Rank">
<input type="text" data-table="Fittings" data-field="x_Rank" name="x<?php echo $Fittings_list->RowIndex ?>_Rank" id="x<?php echo $Fittings_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Fittings_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Fittings_list->Rank->EditValue ?>"<?php echo $Fittings_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Fittings" data-field="x_Rank" name="o<?php echo $Fittings_list->RowIndex ?>_Rank" id="o<?php echo $Fittings_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Fittings_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Fittings_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_Fittings_ActiveFlag" class="form-group Fittings_ActiveFlag">
<?php
$selwrk = ConvertToBool($Fittings_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Fittings" data-field="x_ActiveFlag" name="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]_661057" value="1"<?php echo $selwrk ?><?php echo $Fittings_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]_661057"></label>
</div>
</span>
<input type="hidden" data-table="Fittings" data-field="x_ActiveFlag" name="o<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Fittings_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Fittings_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Fittings_list->ListOptions->render("body", "right", $Fittings_list->RowIndex);
?>
<script>
loadjs.ready(["fFittingslist", "load"], function() {
	fFittingslist.updateLists(<?php echo $Fittings_list->RowIndex ?>);
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
<?php if ($Fittings_list->isAdd() || $Fittings_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $Fittings_list->FormKeyCountName ?>" id="<?php echo $Fittings_list->FormKeyCountName ?>" value="<?php echo $Fittings_list->KeyCount ?>">
<?php } ?>
<?php if ($Fittings_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $Fittings_list->FormKeyCountName ?>" id="<?php echo $Fittings_list->FormKeyCountName ?>" value="<?php echo $Fittings_list->KeyCount ?>">
<?php echo $Fittings_list->MultiSelectKey ?>
<?php } ?>
<?php if ($Fittings_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $Fittings_list->FormKeyCountName ?>" id="<?php echo $Fittings_list->FormKeyCountName ?>" value="<?php echo $Fittings_list->KeyCount ?>">
<?php } ?>
<?php if ($Fittings_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $Fittings_list->FormKeyCountName ?>" id="<?php echo $Fittings_list->FormKeyCountName ?>" value="<?php echo $Fittings_list->KeyCount ?>">
<?php echo $Fittings_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$Fittings->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Fittings_list->Recordset)
	$Fittings_list->Recordset->Close();
?>
<?php if (!$Fittings_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Fittings_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Fittings_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Fittings_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Fittings_list->TotalRecords == 0 && !$Fittings->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Fittings_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Fittings_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Fittings_list->isExport()) { ?>
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
$Fittings_list->terminate();
?>