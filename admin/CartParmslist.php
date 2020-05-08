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
$CartParms_list = new CartParms_list();

// Run the page
$CartParms_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CartParms_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$CartParms_list->isExport()) { ?>
<script>
var fCartParmslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fCartParmslist = currentForm = new ew.Form("fCartParmslist", "list");
	fCartParmslist.formKeyCountName = '<?php echo $CartParms_list->FormKeyCountName ?>';

	// Validate form
	fCartParmslist.validate = function() {
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
			<?php if ($CartParms_list->CartParm_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_CartParm_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_list->CartParm_Idn->caption(), $CartParms_list->CartParm_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CartParms_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_list->Name->caption(), $CartParms_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CartParms_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_list->Department_Idn->caption(), $CartParms_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CartParms_list->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_list->WorksheetMaster_Idn->caption(), $CartParms_list->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CartParms_list->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_list->WorksheetCategory_Idn->caption(), $CartParms_list->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CartParms_list->GroupValue->Required) { ?>
				elm = this.getElements("x" + infix + "_GroupValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_list->GroupValue->caption(), $CartParms_list->GroupValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_GroupValue");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($CartParms_list->GroupValue->errorMessage()) ?>");
			<?php if ($CartParms_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_list->Rank->caption(), $CartParms_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($CartParms_list->Rank->errorMessage()) ?>");
			<?php if ($CartParms_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartParms_list->ActiveFlag->caption(), $CartParms_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fCartParmslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "WorksheetMaster_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "WorksheetCategory_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "GroupValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fCartParmslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCartParmslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fCartParmslist.lists["x_Department_Idn"] = <?php echo $CartParms_list->Department_Idn->Lookup->toClientList($CartParms_list) ?>;
	fCartParmslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($CartParms_list->Department_Idn->lookupOptions()) ?>;
	fCartParmslist.lists["x_WorksheetMaster_Idn"] = <?php echo $CartParms_list->WorksheetMaster_Idn->Lookup->toClientList($CartParms_list) ?>;
	fCartParmslist.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($CartParms_list->WorksheetMaster_Idn->lookupOptions()) ?>;
	fCartParmslist.lists["x_WorksheetCategory_Idn"] = <?php echo $CartParms_list->WorksheetCategory_Idn->Lookup->toClientList($CartParms_list) ?>;
	fCartParmslist.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($CartParms_list->WorksheetCategory_Idn->lookupOptions()) ?>;
	fCartParmslist.lists["x_ActiveFlag[]"] = <?php echo $CartParms_list->ActiveFlag->Lookup->toClientList($CartParms_list) ?>;
	fCartParmslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($CartParms_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fCartParmslist");
});
var fCartParmslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fCartParmslistsrch = currentSearchForm = new ew.Form("fCartParmslistsrch");

	// Dynamic selection lists
	// Filters

	fCartParmslistsrch.filterList = <?php echo $CartParms_list->getFilterList() ?>;
	loadjs.done("fCartParmslistsrch");
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
<?php if (!$CartParms_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($CartParms_list->TotalRecords > 0 && $CartParms_list->ExportOptions->visible()) { ?>
<?php $CartParms_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($CartParms_list->ImportOptions->visible()) { ?>
<?php $CartParms_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($CartParms_list->SearchOptions->visible()) { ?>
<?php $CartParms_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($CartParms_list->FilterOptions->visible()) { ?>
<?php $CartParms_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$CartParms_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$CartParms_list->isExport() && !$CartParms->CurrentAction) { ?>
<form name="fCartParmslistsrch" id="fCartParmslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fCartParmslistsrch-search-panel" class="<?php echo $CartParms_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="CartParms">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $CartParms_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($CartParms_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($CartParms_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $CartParms_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($CartParms_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($CartParms_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($CartParms_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($CartParms_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $CartParms_list->showPageHeader(); ?>
<?php
$CartParms_list->showMessage();
?>
<?php if ($CartParms_list->TotalRecords > 0 || $CartParms->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($CartParms_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> CartParms">
<?php if (!$CartParms_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$CartParms_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $CartParms_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $CartParms_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fCartParmslist" id="fCartParmslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CartParms">
<div id="gmp_CartParms" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($CartParms_list->TotalRecords > 0 || $CartParms_list->isAdd() || $CartParms_list->isCopy() || $CartParms_list->isGridEdit()) { ?>
<table id="tbl_CartParmslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$CartParms->RowType = ROWTYPE_HEADER;

// Render list options
$CartParms_list->renderListOptions();

// Render list options (header, left)
$CartParms_list->ListOptions->render("header", "left");
?>
<?php if ($CartParms_list->CartParm_Idn->Visible) { // CartParm_Idn ?>
	<?php if ($CartParms_list->SortUrl($CartParms_list->CartParm_Idn) == "") { ?>
		<th data-name="CartParm_Idn" class="<?php echo $CartParms_list->CartParm_Idn->headerCellClass() ?>"><div id="elh_CartParms_CartParm_Idn" class="CartParms_CartParm_Idn"><div class="ew-table-header-caption"><?php echo $CartParms_list->CartParm_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CartParm_Idn" class="<?php echo $CartParms_list->CartParm_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CartParms_list->SortUrl($CartParms_list->CartParm_Idn) ?>', 1);"><div id="elh_CartParms_CartParm_Idn" class="CartParms_CartParm_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartParms_list->CartParm_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartParms_list->CartParm_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CartParms_list->CartParm_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CartParms_list->Name->Visible) { // Name ?>
	<?php if ($CartParms_list->SortUrl($CartParms_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $CartParms_list->Name->headerCellClass() ?>"><div id="elh_CartParms_Name" class="CartParms_Name"><div class="ew-table-header-caption"><?php echo $CartParms_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $CartParms_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CartParms_list->SortUrl($CartParms_list->Name) ?>', 1);"><div id="elh_CartParms_Name" class="CartParms_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartParms_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($CartParms_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CartParms_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CartParms_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($CartParms_list->SortUrl($CartParms_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $CartParms_list->Department_Idn->headerCellClass() ?>"><div id="elh_CartParms_Department_Idn" class="CartParms_Department_Idn"><div class="ew-table-header-caption"><?php echo $CartParms_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $CartParms_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CartParms_list->SortUrl($CartParms_list->Department_Idn) ?>', 1);"><div id="elh_CartParms_Department_Idn" class="CartParms_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartParms_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartParms_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CartParms_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CartParms_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($CartParms_list->SortUrl($CartParms_list->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $CartParms_list->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_CartParms_WorksheetMaster_Idn" class="CartParms_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $CartParms_list->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $CartParms_list->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CartParms_list->SortUrl($CartParms_list->WorksheetMaster_Idn) ?>', 1);"><div id="elh_CartParms_WorksheetMaster_Idn" class="CartParms_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartParms_list->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartParms_list->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CartParms_list->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CartParms_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<?php if ($CartParms_list->SortUrl($CartParms_list->WorksheetCategory_Idn) == "") { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $CartParms_list->WorksheetCategory_Idn->headerCellClass() ?>"><div id="elh_CartParms_WorksheetCategory_Idn" class="CartParms_WorksheetCategory_Idn"><div class="ew-table-header-caption"><?php echo $CartParms_list->WorksheetCategory_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $CartParms_list->WorksheetCategory_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CartParms_list->SortUrl($CartParms_list->WorksheetCategory_Idn) ?>', 1);"><div id="elh_CartParms_WorksheetCategory_Idn" class="CartParms_WorksheetCategory_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartParms_list->WorksheetCategory_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartParms_list->WorksheetCategory_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CartParms_list->WorksheetCategory_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CartParms_list->GroupValue->Visible) { // GroupValue ?>
	<?php if ($CartParms_list->SortUrl($CartParms_list->GroupValue) == "") { ?>
		<th data-name="GroupValue" class="<?php echo $CartParms_list->GroupValue->headerCellClass() ?>"><div id="elh_CartParms_GroupValue" class="CartParms_GroupValue"><div class="ew-table-header-caption"><?php echo $CartParms_list->GroupValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GroupValue" class="<?php echo $CartParms_list->GroupValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CartParms_list->SortUrl($CartParms_list->GroupValue) ?>', 1);"><div id="elh_CartParms_GroupValue" class="CartParms_GroupValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartParms_list->GroupValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartParms_list->GroupValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CartParms_list->GroupValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CartParms_list->Rank->Visible) { // Rank ?>
	<?php if ($CartParms_list->SortUrl($CartParms_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $CartParms_list->Rank->headerCellClass() ?>"><div id="elh_CartParms_Rank" class="CartParms_Rank"><div class="ew-table-header-caption"><?php echo $CartParms_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $CartParms_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CartParms_list->SortUrl($CartParms_list->Rank) ?>', 1);"><div id="elh_CartParms_Rank" class="CartParms_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartParms_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartParms_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CartParms_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CartParms_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($CartParms_list->SortUrl($CartParms_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $CartParms_list->ActiveFlag->headerCellClass() ?>"><div id="elh_CartParms_ActiveFlag" class="CartParms_ActiveFlag"><div class="ew-table-header-caption"><?php echo $CartParms_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $CartParms_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CartParms_list->SortUrl($CartParms_list->ActiveFlag) ?>', 1);"><div id="elh_CartParms_ActiveFlag" class="CartParms_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartParms_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartParms_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CartParms_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$CartParms_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($CartParms_list->isAdd() || $CartParms_list->isCopy()) {
		$CartParms_list->RowIndex = 0;
		$CartParms_list->KeyCount = $CartParms_list->RowIndex;
		if ($CartParms_list->isCopy() && !$CartParms_list->loadRow())
			$CartParms->CurrentAction = "add";
		if ($CartParms_list->isAdd())
			$CartParms_list->loadRowValues();
		if ($CartParms->EventCancelled) // Insert failed
			$CartParms_list->restoreFormValues(); // Restore form values

		// Set row properties
		$CartParms->resetAttributes();
		$CartParms->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_CartParms", "data-rowtype" => ROWTYPE_ADD]);
		$CartParms->RowType = ROWTYPE_ADD;

		// Render row
		$CartParms_list->renderRow();

		// Render list options
		$CartParms_list->renderListOptions();
		$CartParms_list->StartRowCount = 0;
?>
	<tr <?php echo $CartParms->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CartParms_list->ListOptions->render("body", "left", $CartParms_list->RowCount);
?>
	<?php if ($CartParms_list->CartParm_Idn->Visible) { // CartParm_Idn ?>
		<td data-name="CartParm_Idn">
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_CartParm_Idn" class="form-group CartParms_CartParm_Idn"></span>
<input type="hidden" data-table="CartParms" data-field="x_CartParm_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_CartParm_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_CartParm_Idn" value="<?php echo HtmlEncode($CartParms_list->CartParm_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Name" class="form-group CartParms_Name">
<input type="text" data-table="CartParms" data-field="x_Name" name="x<?php echo $CartParms_list->RowIndex ?>_Name" id="x<?php echo $CartParms_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CartParms_list->Name->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->Name->EditValue ?>"<?php echo $CartParms_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="CartParms" data-field="x_Name" name="o<?php echo $CartParms_list->RowIndex ?>_Name" id="o<?php echo $CartParms_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($CartParms_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Department_Idn" class="form-group CartParms_Department_Idn">
<?php $CartParms_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_Department_Idn" data-value-separator="<?php echo $CartParms_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_Department_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_Department_Idn"<?php echo $CartParms_list->Department_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->Department_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->Department_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="CartParms" data-field="x_Department_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_Department_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($CartParms_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_WorksheetMaster_Idn" class="form-group CartParms_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $CartParms_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $CartParms_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->WorksheetMaster_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->WorksheetMaster_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="CartParms" data-field="x_WorksheetMaster_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($CartParms_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn">
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_WorksheetCategory_Idn" class="form-group CartParms_WorksheetCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $CartParms_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $CartParms_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->WorksheetCategory_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->WorksheetCategory_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<input type="hidden" data-table="CartParms" data-field="x_WorksheetCategory_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($CartParms_list->WorksheetCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->GroupValue->Visible) { // GroupValue ?>
		<td data-name="GroupValue">
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_GroupValue" class="form-group CartParms_GroupValue">
<input type="text" data-table="CartParms" data-field="x_GroupValue" name="x<?php echo $CartParms_list->RowIndex ?>_GroupValue" id="x<?php echo $CartParms_list->RowIndex ?>_GroupValue" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CartParms_list->GroupValue->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->GroupValue->EditValue ?>"<?php echo $CartParms_list->GroupValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="CartParms" data-field="x_GroupValue" name="o<?php echo $CartParms_list->RowIndex ?>_GroupValue" id="o<?php echo $CartParms_list->RowIndex ?>_GroupValue" value="<?php echo HtmlEncode($CartParms_list->GroupValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Rank" class="form-group CartParms_Rank">
<input type="text" data-table="CartParms" data-field="x_Rank" name="x<?php echo $CartParms_list->RowIndex ?>_Rank" id="x<?php echo $CartParms_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CartParms_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->Rank->EditValue ?>"<?php echo $CartParms_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="CartParms" data-field="x_Rank" name="o<?php echo $CartParms_list->RowIndex ?>_Rank" id="o<?php echo $CartParms_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($CartParms_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_ActiveFlag" class="form-group CartParms_ActiveFlag">
<?php
$selwrk = ConvertToBool($CartParms_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CartParms" data-field="x_ActiveFlag" name="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]_771853" value="1"<?php echo $selwrk ?><?php echo $CartParms_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]_771853"></label>
</div>
</span>
<input type="hidden" data-table="CartParms" data-field="x_ActiveFlag" name="o<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($CartParms_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CartParms_list->ListOptions->render("body", "right", $CartParms_list->RowCount);
?>
<script>
loadjs.ready(["fCartParmslist", "load"], function() {
	fCartParmslist.updateLists(<?php echo $CartParms_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($CartParms_list->ExportAll && $CartParms_list->isExport()) {
	$CartParms_list->StopRecord = $CartParms_list->TotalRecords;
} else {

	// Set the last record to display
	if ($CartParms_list->TotalRecords > $CartParms_list->StartRecord + $CartParms_list->DisplayRecords - 1)
		$CartParms_list->StopRecord = $CartParms_list->StartRecord + $CartParms_list->DisplayRecords - 1;
	else
		$CartParms_list->StopRecord = $CartParms_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($CartParms->isConfirm() || $CartParms_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($CartParms_list->FormKeyCountName) && ($CartParms_list->isGridAdd() || $CartParms_list->isGridEdit() || $CartParms->isConfirm())) {
		$CartParms_list->KeyCount = $CurrentForm->getValue($CartParms_list->FormKeyCountName);
		$CartParms_list->StopRecord = $CartParms_list->StartRecord + $CartParms_list->KeyCount - 1;
	}
}
$CartParms_list->RecordCount = $CartParms_list->StartRecord - 1;
if ($CartParms_list->Recordset && !$CartParms_list->Recordset->EOF) {
	$CartParms_list->Recordset->moveFirst();
	$selectLimit = $CartParms_list->UseSelectLimit;
	if (!$selectLimit && $CartParms_list->StartRecord > 1)
		$CartParms_list->Recordset->move($CartParms_list->StartRecord - 1);
} elseif (!$CartParms->AllowAddDeleteRow && $CartParms_list->StopRecord == 0) {
	$CartParms_list->StopRecord = $CartParms->GridAddRowCount;
}

// Initialize aggregate
$CartParms->RowType = ROWTYPE_AGGREGATEINIT;
$CartParms->resetAttributes();
$CartParms_list->renderRow();
$CartParms_list->EditRowCount = 0;
if ($CartParms_list->isEdit())
	$CartParms_list->RowIndex = 1;
if ($CartParms_list->isGridAdd())
	$CartParms_list->RowIndex = 0;
if ($CartParms_list->isGridEdit())
	$CartParms_list->RowIndex = 0;
while ($CartParms_list->RecordCount < $CartParms_list->StopRecord) {
	$CartParms_list->RecordCount++;
	if ($CartParms_list->RecordCount >= $CartParms_list->StartRecord) {
		$CartParms_list->RowCount++;
		if ($CartParms_list->isGridAdd() || $CartParms_list->isGridEdit() || $CartParms->isConfirm()) {
			$CartParms_list->RowIndex++;
			$CurrentForm->Index = $CartParms_list->RowIndex;
			if ($CurrentForm->hasValue($CartParms_list->FormActionName) && ($CartParms->isConfirm() || $CartParms_list->EventCancelled))
				$CartParms_list->RowAction = strval($CurrentForm->getValue($CartParms_list->FormActionName));
			elseif ($CartParms_list->isGridAdd())
				$CartParms_list->RowAction = "insert";
			else
				$CartParms_list->RowAction = "";
		}

		// Set up key count
		$CartParms_list->KeyCount = $CartParms_list->RowIndex;

		// Init row class and style
		$CartParms->resetAttributes();
		$CartParms->CssClass = "";
		if ($CartParms_list->isGridAdd()) {
			$CartParms_list->loadRowValues(); // Load default values
		} else {
			$CartParms_list->loadRowValues($CartParms_list->Recordset); // Load row values
		}
		$CartParms->RowType = ROWTYPE_VIEW; // Render view
		if ($CartParms_list->isGridAdd()) // Grid add
			$CartParms->RowType = ROWTYPE_ADD; // Render add
		if ($CartParms_list->isGridAdd() && $CartParms->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$CartParms_list->restoreCurrentRowFormValues($CartParms_list->RowIndex); // Restore form values
		if ($CartParms_list->isEdit()) {
			if ($CartParms_list->checkInlineEditKey() && $CartParms_list->EditRowCount == 0) { // Inline edit
				$CartParms->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($CartParms_list->isGridEdit()) { // Grid edit
			if ($CartParms->EventCancelled)
				$CartParms_list->restoreCurrentRowFormValues($CartParms_list->RowIndex); // Restore form values
			if ($CartParms_list->RowAction == "insert")
				$CartParms->RowType = ROWTYPE_ADD; // Render add
			else
				$CartParms->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($CartParms_list->isEdit() && $CartParms->RowType == ROWTYPE_EDIT && $CartParms->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$CartParms_list->restoreFormValues(); // Restore form values
		}
		if ($CartParms_list->isGridEdit() && ($CartParms->RowType == ROWTYPE_EDIT || $CartParms->RowType == ROWTYPE_ADD) && $CartParms->EventCancelled) // Update failed
			$CartParms_list->restoreCurrentRowFormValues($CartParms_list->RowIndex); // Restore form values
		if ($CartParms->RowType == ROWTYPE_EDIT) // Edit row
			$CartParms_list->EditRowCount++;

		// Set up row id / data-rowindex
		$CartParms->RowAttrs->merge(["data-rowindex" => $CartParms_list->RowCount, "id" => "r" . $CartParms_list->RowCount . "_CartParms", "data-rowtype" => $CartParms->RowType]);

		// Render row
		$CartParms_list->renderRow();

		// Render list options
		$CartParms_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($CartParms_list->RowAction != "delete" && $CartParms_list->RowAction != "insertdelete" && !($CartParms_list->RowAction == "insert" && $CartParms->isConfirm() && $CartParms_list->emptyRow())) {
?>
	<tr <?php echo $CartParms->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CartParms_list->ListOptions->render("body", "left", $CartParms_list->RowCount);
?>
	<?php if ($CartParms_list->CartParm_Idn->Visible) { // CartParm_Idn ?>
		<td data-name="CartParm_Idn" <?php echo $CartParms_list->CartParm_Idn->cellAttributes() ?>>
<?php if ($CartParms->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_CartParm_Idn" class="form-group"></span>
<input type="hidden" data-table="CartParms" data-field="x_CartParm_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_CartParm_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_CartParm_Idn" value="<?php echo HtmlEncode($CartParms_list->CartParm_Idn->OldValue) ?>">
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_CartParm_Idn" class="form-group">
<span<?php echo $CartParms_list->CartParm_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($CartParms_list->CartParm_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="CartParms" data-field="x_CartParm_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_CartParm_Idn" id="x<?php echo $CartParms_list->RowIndex ?>_CartParm_Idn" value="<?php echo HtmlEncode($CartParms_list->CartParm_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_CartParm_Idn">
<span<?php echo $CartParms_list->CartParm_Idn->viewAttributes() ?>><?php echo $CartParms_list->CartParm_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CartParms_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $CartParms_list->Name->cellAttributes() ?>>
<?php if ($CartParms->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Name" class="form-group">
<input type="text" data-table="CartParms" data-field="x_Name" name="x<?php echo $CartParms_list->RowIndex ?>_Name" id="x<?php echo $CartParms_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CartParms_list->Name->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->Name->EditValue ?>"<?php echo $CartParms_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="CartParms" data-field="x_Name" name="o<?php echo $CartParms_list->RowIndex ?>_Name" id="o<?php echo $CartParms_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($CartParms_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Name" class="form-group">
<input type="text" data-table="CartParms" data-field="x_Name" name="x<?php echo $CartParms_list->RowIndex ?>_Name" id="x<?php echo $CartParms_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CartParms_list->Name->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->Name->EditValue ?>"<?php echo $CartParms_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Name">
<span<?php echo $CartParms_list->Name->viewAttributes() ?>><?php echo $CartParms_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CartParms_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $CartParms_list->Department_Idn->cellAttributes() ?>>
<?php if ($CartParms->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Department_Idn" class="form-group">
<?php $CartParms_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_Department_Idn" data-value-separator="<?php echo $CartParms_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_Department_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_Department_Idn"<?php echo $CartParms_list->Department_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->Department_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->Department_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="CartParms" data-field="x_Department_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_Department_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($CartParms_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Department_Idn" class="form-group">
<?php $CartParms_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_Department_Idn" data-value-separator="<?php echo $CartParms_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_Department_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_Department_Idn"<?php echo $CartParms_list->Department_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->Department_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->Department_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Department_Idn">
<span<?php echo $CartParms_list->Department_Idn->viewAttributes() ?>><?php echo $CartParms_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CartParms_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $CartParms_list->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($CartParms->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_WorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $CartParms_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $CartParms_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->WorksheetMaster_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->WorksheetMaster_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="CartParms" data-field="x_WorksheetMaster_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($CartParms_list->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_WorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $CartParms_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $CartParms_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->WorksheetMaster_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->WorksheetMaster_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_WorksheetMaster_Idn">
<span<?php echo $CartParms_list->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $CartParms_list->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CartParms_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn" <?php echo $CartParms_list->WorksheetCategory_Idn->cellAttributes() ?>>
<?php if ($CartParms->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_WorksheetCategory_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $CartParms_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $CartParms_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->WorksheetCategory_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->WorksheetCategory_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<input type="hidden" data-table="CartParms" data-field="x_WorksheetCategory_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($CartParms_list->WorksheetCategory_Idn->OldValue) ?>">
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_WorksheetCategory_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $CartParms_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $CartParms_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->WorksheetCategory_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->WorksheetCategory_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_WorksheetCategory_Idn">
<span<?php echo $CartParms_list->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $CartParms_list->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CartParms_list->GroupValue->Visible) { // GroupValue ?>
		<td data-name="GroupValue" <?php echo $CartParms_list->GroupValue->cellAttributes() ?>>
<?php if ($CartParms->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_GroupValue" class="form-group">
<input type="text" data-table="CartParms" data-field="x_GroupValue" name="x<?php echo $CartParms_list->RowIndex ?>_GroupValue" id="x<?php echo $CartParms_list->RowIndex ?>_GroupValue" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CartParms_list->GroupValue->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->GroupValue->EditValue ?>"<?php echo $CartParms_list->GroupValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="CartParms" data-field="x_GroupValue" name="o<?php echo $CartParms_list->RowIndex ?>_GroupValue" id="o<?php echo $CartParms_list->RowIndex ?>_GroupValue" value="<?php echo HtmlEncode($CartParms_list->GroupValue->OldValue) ?>">
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_GroupValue" class="form-group">
<input type="text" data-table="CartParms" data-field="x_GroupValue" name="x<?php echo $CartParms_list->RowIndex ?>_GroupValue" id="x<?php echo $CartParms_list->RowIndex ?>_GroupValue" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CartParms_list->GroupValue->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->GroupValue->EditValue ?>"<?php echo $CartParms_list->GroupValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_GroupValue">
<span<?php echo $CartParms_list->GroupValue->viewAttributes() ?>><?php echo $CartParms_list->GroupValue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CartParms_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $CartParms_list->Rank->cellAttributes() ?>>
<?php if ($CartParms->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Rank" class="form-group">
<input type="text" data-table="CartParms" data-field="x_Rank" name="x<?php echo $CartParms_list->RowIndex ?>_Rank" id="x<?php echo $CartParms_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CartParms_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->Rank->EditValue ?>"<?php echo $CartParms_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="CartParms" data-field="x_Rank" name="o<?php echo $CartParms_list->RowIndex ?>_Rank" id="o<?php echo $CartParms_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($CartParms_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Rank" class="form-group">
<input type="text" data-table="CartParms" data-field="x_Rank" name="x<?php echo $CartParms_list->RowIndex ?>_Rank" id="x<?php echo $CartParms_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CartParms_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->Rank->EditValue ?>"<?php echo $CartParms_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_Rank">
<span<?php echo $CartParms_list->Rank->viewAttributes() ?>><?php echo $CartParms_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CartParms_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $CartParms_list->ActiveFlag->cellAttributes() ?>>
<?php if ($CartParms->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($CartParms_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CartParms" data-field="x_ActiveFlag" name="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]_846789" value="1"<?php echo $selwrk ?><?php echo $CartParms_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]_846789"></label>
</div>
</span>
<input type="hidden" data-table="CartParms" data-field="x_ActiveFlag" name="o<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($CartParms_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($CartParms_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CartParms" data-field="x_ActiveFlag" name="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]_113789" value="1"<?php echo $selwrk ?><?php echo $CartParms_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]_113789"></label>
</div>
</span>
<?php } ?>
<?php if ($CartParms->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CartParms_list->RowCount ?>_CartParms_ActiveFlag">
<span<?php echo $CartParms_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $CartParms_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($CartParms_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CartParms_list->ListOptions->render("body", "right", $CartParms_list->RowCount);
?>
	</tr>
<?php if ($CartParms->RowType == ROWTYPE_ADD || $CartParms->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fCartParmslist", "load"], function() {
	fCartParmslist.updateLists(<?php echo $CartParms_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$CartParms_list->isGridAdd())
		if (!$CartParms_list->Recordset->EOF)
			$CartParms_list->Recordset->moveNext();
}
?>
<?php
	if ($CartParms_list->isGridAdd() || $CartParms_list->isGridEdit()) {
		$CartParms_list->RowIndex = '$rowindex$';
		$CartParms_list->loadRowValues();

		// Set row properties
		$CartParms->resetAttributes();
		$CartParms->RowAttrs->merge(["data-rowindex" => $CartParms_list->RowIndex, "id" => "r0_CartParms", "data-rowtype" => ROWTYPE_ADD]);
		$CartParms->RowAttrs->appendClass("ew-template");
		$CartParms->RowType = ROWTYPE_ADD;

		// Render row
		$CartParms_list->renderRow();

		// Render list options
		$CartParms_list->renderListOptions();
		$CartParms_list->StartRowCount = 0;
?>
	<tr <?php echo $CartParms->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CartParms_list->ListOptions->render("body", "left", $CartParms_list->RowIndex);
?>
	<?php if ($CartParms_list->CartParm_Idn->Visible) { // CartParm_Idn ?>
		<td data-name="CartParm_Idn">
<span id="el$rowindex$_CartParms_CartParm_Idn" class="form-group CartParms_CartParm_Idn"></span>
<input type="hidden" data-table="CartParms" data-field="x_CartParm_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_CartParm_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_CartParm_Idn" value="<?php echo HtmlEncode($CartParms_list->CartParm_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_CartParms_Name" class="form-group CartParms_Name">
<input type="text" data-table="CartParms" data-field="x_Name" name="x<?php echo $CartParms_list->RowIndex ?>_Name" id="x<?php echo $CartParms_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CartParms_list->Name->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->Name->EditValue ?>"<?php echo $CartParms_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="CartParms" data-field="x_Name" name="o<?php echo $CartParms_list->RowIndex ?>_Name" id="o<?php echo $CartParms_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($CartParms_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_CartParms_Department_Idn" class="form-group CartParms_Department_Idn">
<?php $CartParms_list->Department_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_Department_Idn" data-value-separator="<?php echo $CartParms_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_Department_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_Department_Idn"<?php echo $CartParms_list->Department_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->Department_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->Department_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="CartParms" data-field="x_Department_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_Department_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($CartParms_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el$rowindex$_CartParms_WorksheetMaster_Idn" class="form-group CartParms_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $CartParms_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $CartParms_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->WorksheetMaster_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->WorksheetMaster_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="CartParms" data-field="x_WorksheetMaster_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($CartParms_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn">
<span id="el$rowindex$_CartParms_WorksheetCategory_Idn" class="form-group CartParms_WorksheetCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="CartParms" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $CartParms_list->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn"<?php echo $CartParms_list->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $CartParms_list->WorksheetCategory_Idn->selectOptionListHtml("x{$CartParms_list->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $CartParms_list->WorksheetCategory_Idn->Lookup->getParamTag($CartParms_list, "p_x" . $CartParms_list->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<input type="hidden" data-table="CartParms" data-field="x_WorksheetCategory_Idn" name="o<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $CartParms_list->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($CartParms_list->WorksheetCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->GroupValue->Visible) { // GroupValue ?>
		<td data-name="GroupValue">
<span id="el$rowindex$_CartParms_GroupValue" class="form-group CartParms_GroupValue">
<input type="text" data-table="CartParms" data-field="x_GroupValue" name="x<?php echo $CartParms_list->RowIndex ?>_GroupValue" id="x<?php echo $CartParms_list->RowIndex ?>_GroupValue" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CartParms_list->GroupValue->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->GroupValue->EditValue ?>"<?php echo $CartParms_list->GroupValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="CartParms" data-field="x_GroupValue" name="o<?php echo $CartParms_list->RowIndex ?>_GroupValue" id="o<?php echo $CartParms_list->RowIndex ?>_GroupValue" value="<?php echo HtmlEncode($CartParms_list->GroupValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_CartParms_Rank" class="form-group CartParms_Rank">
<input type="text" data-table="CartParms" data-field="x_Rank" name="x<?php echo $CartParms_list->RowIndex ?>_Rank" id="x<?php echo $CartParms_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CartParms_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CartParms_list->Rank->EditValue ?>"<?php echo $CartParms_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="CartParms" data-field="x_Rank" name="o<?php echo $CartParms_list->RowIndex ?>_Rank" id="o<?php echo $CartParms_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($CartParms_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartParms_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_CartParms_ActiveFlag" class="form-group CartParms_ActiveFlag">
<?php
$selwrk = ConvertToBool($CartParms_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CartParms" data-field="x_ActiveFlag" name="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]_447656" value="1"<?php echo $selwrk ?><?php echo $CartParms_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]_447656"></label>
</div>
</span>
<input type="hidden" data-table="CartParms" data-field="x_ActiveFlag" name="o<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $CartParms_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($CartParms_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CartParms_list->ListOptions->render("body", "right", $CartParms_list->RowIndex);
?>
<script>
loadjs.ready(["fCartParmslist", "load"], function() {
	fCartParmslist.updateLists(<?php echo $CartParms_list->RowIndex ?>);
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
<?php if ($CartParms_list->isAdd() || $CartParms_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $CartParms_list->FormKeyCountName ?>" id="<?php echo $CartParms_list->FormKeyCountName ?>" value="<?php echo $CartParms_list->KeyCount ?>">
<?php } ?>
<?php if ($CartParms_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $CartParms_list->FormKeyCountName ?>" id="<?php echo $CartParms_list->FormKeyCountName ?>" value="<?php echo $CartParms_list->KeyCount ?>">
<?php echo $CartParms_list->MultiSelectKey ?>
<?php } ?>
<?php if ($CartParms_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $CartParms_list->FormKeyCountName ?>" id="<?php echo $CartParms_list->FormKeyCountName ?>" value="<?php echo $CartParms_list->KeyCount ?>">
<?php } ?>
<?php if ($CartParms_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $CartParms_list->FormKeyCountName ?>" id="<?php echo $CartParms_list->FormKeyCountName ?>" value="<?php echo $CartParms_list->KeyCount ?>">
<?php echo $CartParms_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$CartParms->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($CartParms_list->Recordset)
	$CartParms_list->Recordset->Close();
?>
<?php if (!$CartParms_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$CartParms_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $CartParms_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $CartParms_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($CartParms_list->TotalRecords == 0 && !$CartParms->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $CartParms_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$CartParms_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$CartParms_list->isExport()) { ?>
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
$CartParms_list->terminate();
?>