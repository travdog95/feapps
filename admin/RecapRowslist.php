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
$RecapRows_list = new RecapRows_list();

// Run the page
$RecapRows_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapRows_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$RecapRows_list->isExport()) { ?>
<script>
var fRecapRowslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fRecapRowslist = currentForm = new ew.Form("fRecapRowslist", "list");
	fRecapRowslist.formKeyCountName = '<?php echo $RecapRows_list->FormKeyCountName ?>';

	// Validate form
	fRecapRowslist.validate = function() {
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
			<?php if ($RecapRows_list->RecapRow_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RecapRow_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_list->RecapRow_Idn->caption(), $RecapRows_list->RecapRow_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_list->Name->caption(), $RecapRows_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_list->Department_Idn->caption(), $RecapRows_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_list->CalcShopFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_CalcShopFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_list->CalcShopFlag->caption(), $RecapRows_list->CalcShopFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_list->IsWorksheetFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_IsWorksheetFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_list->IsWorksheetFlag->caption(), $RecapRows_list->IsWorksheetFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_list->DisplayFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_DisplayFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_list->DisplayFlag->caption(), $RecapRows_list->DisplayFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRows_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_list->Rank->caption(), $RecapRows_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapRows_list->Rank->errorMessage()) ?>");
			<?php if ($RecapRows_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRows_list->ActiveFlag->caption(), $RecapRows_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fRecapRowslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "CalcShopFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "IsWorksheetFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "DisplayFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fRecapRowslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapRowslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRecapRowslist.lists["x_Department_Idn"] = <?php echo $RecapRows_list->Department_Idn->Lookup->toClientList($RecapRows_list) ?>;
	fRecapRowslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($RecapRows_list->Department_Idn->lookupOptions()) ?>;
	fRecapRowslist.lists["x_CalcShopFlag[]"] = <?php echo $RecapRows_list->CalcShopFlag->Lookup->toClientList($RecapRows_list) ?>;
	fRecapRowslist.lists["x_CalcShopFlag[]"].options = <?php echo JsonEncode($RecapRows_list->CalcShopFlag->options(FALSE, TRUE)) ?>;
	fRecapRowslist.lists["x_IsWorksheetFlag[]"] = <?php echo $RecapRows_list->IsWorksheetFlag->Lookup->toClientList($RecapRows_list) ?>;
	fRecapRowslist.lists["x_IsWorksheetFlag[]"].options = <?php echo JsonEncode($RecapRows_list->IsWorksheetFlag->options(FALSE, TRUE)) ?>;
	fRecapRowslist.lists["x_DisplayFlag[]"] = <?php echo $RecapRows_list->DisplayFlag->Lookup->toClientList($RecapRows_list) ?>;
	fRecapRowslist.lists["x_DisplayFlag[]"].options = <?php echo JsonEncode($RecapRows_list->DisplayFlag->options(FALSE, TRUE)) ?>;
	fRecapRowslist.lists["x_ActiveFlag[]"] = <?php echo $RecapRows_list->ActiveFlag->Lookup->toClientList($RecapRows_list) ?>;
	fRecapRowslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($RecapRows_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fRecapRowslist");
});
var fRecapRowslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fRecapRowslistsrch = currentSearchForm = new ew.Form("fRecapRowslistsrch");

	// Dynamic selection lists
	// Filters

	fRecapRowslistsrch.filterList = <?php echo $RecapRows_list->getFilterList() ?>;
	loadjs.done("fRecapRowslistsrch");
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
<?php if (!$RecapRows_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($RecapRows_list->TotalRecords > 0 && $RecapRows_list->ExportOptions->visible()) { ?>
<?php $RecapRows_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($RecapRows_list->ImportOptions->visible()) { ?>
<?php $RecapRows_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($RecapRows_list->SearchOptions->visible()) { ?>
<?php $RecapRows_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($RecapRows_list->FilterOptions->visible()) { ?>
<?php $RecapRows_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$RecapRows_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$RecapRows_list->isExport() && !$RecapRows->CurrentAction) { ?>
<form name="fRecapRowslistsrch" id="fRecapRowslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fRecapRowslistsrch-search-panel" class="<?php echo $RecapRows_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="RecapRows">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $RecapRows_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($RecapRows_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($RecapRows_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $RecapRows_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($RecapRows_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($RecapRows_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($RecapRows_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($RecapRows_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $RecapRows_list->showPageHeader(); ?>
<?php
$RecapRows_list->showMessage();
?>
<?php if ($RecapRows_list->TotalRecords > 0 || $RecapRows->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($RecapRows_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> RecapRows">
<?php if (!$RecapRows_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$RecapRows_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapRows_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RecapRows_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fRecapRowslist" id="fRecapRowslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapRows">
<div id="gmp_RecapRows" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($RecapRows_list->TotalRecords > 0 || $RecapRows_list->isAdd() || $RecapRows_list->isCopy() || $RecapRows_list->isGridEdit()) { ?>
<table id="tbl_RecapRowslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$RecapRows->RowType = ROWTYPE_HEADER;

// Render list options
$RecapRows_list->renderListOptions();

// Render list options (header, left)
$RecapRows_list->ListOptions->render("header", "left");
?>
<?php if ($RecapRows_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
	<?php if ($RecapRows_list->SortUrl($RecapRows_list->RecapRow_Idn) == "") { ?>
		<th data-name="RecapRow_Idn" class="<?php echo $RecapRows_list->RecapRow_Idn->headerCellClass() ?>"><div id="elh_RecapRows_RecapRow_Idn" class="RecapRows_RecapRow_Idn"><div class="ew-table-header-caption"><?php echo $RecapRows_list->RecapRow_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RecapRow_Idn" class="<?php echo $RecapRows_list->RecapRow_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapRows_list->SortUrl($RecapRows_list->RecapRow_Idn) ?>', 1);"><div id="elh_RecapRows_RecapRow_Idn" class="RecapRows_RecapRow_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapRows_list->RecapRow_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapRows_list->RecapRow_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapRows_list->RecapRow_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapRows_list->Name->Visible) { // Name ?>
	<?php if ($RecapRows_list->SortUrl($RecapRows_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $RecapRows_list->Name->headerCellClass() ?>"><div id="elh_RecapRows_Name" class="RecapRows_Name"><div class="ew-table-header-caption"><?php echo $RecapRows_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $RecapRows_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapRows_list->SortUrl($RecapRows_list->Name) ?>', 1);"><div id="elh_RecapRows_Name" class="RecapRows_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapRows_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($RecapRows_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapRows_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapRows_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($RecapRows_list->SortUrl($RecapRows_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $RecapRows_list->Department_Idn->headerCellClass() ?>"><div id="elh_RecapRows_Department_Idn" class="RecapRows_Department_Idn"><div class="ew-table-header-caption"><?php echo $RecapRows_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $RecapRows_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapRows_list->SortUrl($RecapRows_list->Department_Idn) ?>', 1);"><div id="elh_RecapRows_Department_Idn" class="RecapRows_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapRows_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapRows_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapRows_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapRows_list->CalcShopFlag->Visible) { // CalcShopFlag ?>
	<?php if ($RecapRows_list->SortUrl($RecapRows_list->CalcShopFlag) == "") { ?>
		<th data-name="CalcShopFlag" class="<?php echo $RecapRows_list->CalcShopFlag->headerCellClass() ?>"><div id="elh_RecapRows_CalcShopFlag" class="RecapRows_CalcShopFlag"><div class="ew-table-header-caption"><?php echo $RecapRows_list->CalcShopFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CalcShopFlag" class="<?php echo $RecapRows_list->CalcShopFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapRows_list->SortUrl($RecapRows_list->CalcShopFlag) ?>', 1);"><div id="elh_RecapRows_CalcShopFlag" class="RecapRows_CalcShopFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapRows_list->CalcShopFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapRows_list->CalcShopFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapRows_list->CalcShopFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapRows_list->IsWorksheetFlag->Visible) { // IsWorksheetFlag ?>
	<?php if ($RecapRows_list->SortUrl($RecapRows_list->IsWorksheetFlag) == "") { ?>
		<th data-name="IsWorksheetFlag" class="<?php echo $RecapRows_list->IsWorksheetFlag->headerCellClass() ?>"><div id="elh_RecapRows_IsWorksheetFlag" class="RecapRows_IsWorksheetFlag"><div class="ew-table-header-caption"><?php echo $RecapRows_list->IsWorksheetFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsWorksheetFlag" class="<?php echo $RecapRows_list->IsWorksheetFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapRows_list->SortUrl($RecapRows_list->IsWorksheetFlag) ?>', 1);"><div id="elh_RecapRows_IsWorksheetFlag" class="RecapRows_IsWorksheetFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapRows_list->IsWorksheetFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapRows_list->IsWorksheetFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapRows_list->IsWorksheetFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapRows_list->DisplayFlag->Visible) { // DisplayFlag ?>
	<?php if ($RecapRows_list->SortUrl($RecapRows_list->DisplayFlag) == "") { ?>
		<th data-name="DisplayFlag" class="<?php echo $RecapRows_list->DisplayFlag->headerCellClass() ?>"><div id="elh_RecapRows_DisplayFlag" class="RecapRows_DisplayFlag"><div class="ew-table-header-caption"><?php echo $RecapRows_list->DisplayFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DisplayFlag" class="<?php echo $RecapRows_list->DisplayFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapRows_list->SortUrl($RecapRows_list->DisplayFlag) ?>', 1);"><div id="elh_RecapRows_DisplayFlag" class="RecapRows_DisplayFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapRows_list->DisplayFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapRows_list->DisplayFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapRows_list->DisplayFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapRows_list->Rank->Visible) { // Rank ?>
	<?php if ($RecapRows_list->SortUrl($RecapRows_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $RecapRows_list->Rank->headerCellClass() ?>"><div id="elh_RecapRows_Rank" class="RecapRows_Rank"><div class="ew-table-header-caption"><?php echo $RecapRows_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $RecapRows_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapRows_list->SortUrl($RecapRows_list->Rank) ?>', 1);"><div id="elh_RecapRows_Rank" class="RecapRows_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapRows_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapRows_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapRows_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapRows_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($RecapRows_list->SortUrl($RecapRows_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $RecapRows_list->ActiveFlag->headerCellClass() ?>"><div id="elh_RecapRows_ActiveFlag" class="RecapRows_ActiveFlag"><div class="ew-table-header-caption"><?php echo $RecapRows_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $RecapRows_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapRows_list->SortUrl($RecapRows_list->ActiveFlag) ?>', 1);"><div id="elh_RecapRows_ActiveFlag" class="RecapRows_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapRows_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapRows_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapRows_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$RecapRows_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($RecapRows_list->isAdd() || $RecapRows_list->isCopy()) {
		$RecapRows_list->RowIndex = 0;
		$RecapRows_list->KeyCount = $RecapRows_list->RowIndex;
		if ($RecapRows_list->isCopy() && !$RecapRows_list->loadRow())
			$RecapRows->CurrentAction = "add";
		if ($RecapRows_list->isAdd())
			$RecapRows_list->loadRowValues();
		if ($RecapRows->EventCancelled) // Insert failed
			$RecapRows_list->restoreFormValues(); // Restore form values

		// Set row properties
		$RecapRows->resetAttributes();
		$RecapRows->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_RecapRows", "data-rowtype" => ROWTYPE_ADD]);
		$RecapRows->RowType = ROWTYPE_ADD;

		// Render row
		$RecapRows_list->renderRow();

		// Render list options
		$RecapRows_list->renderListOptions();
		$RecapRows_list->StartRowCount = 0;
?>
	<tr <?php echo $RecapRows->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapRows_list->ListOptions->render("body", "left", $RecapRows_list->RowCount);
?>
	<?php if ($RecapRows_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td data-name="RecapRow_Idn">
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_RecapRow_Idn" class="form-group RecapRows_RecapRow_Idn"></span>
<input type="hidden" data-table="RecapRows" data-field="x_RecapRow_Idn" name="o<?php echo $RecapRows_list->RowIndex ?>_RecapRow_Idn" id="o<?php echo $RecapRows_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapRows_list->RecapRow_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Name" class="form-group RecapRows_Name">
<input type="text" data-table="RecapRows" data-field="x_Name" name="x<?php echo $RecapRows_list->RowIndex ?>_Name" id="x<?php echo $RecapRows_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapRows_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapRows_list->Name->EditValue ?>"<?php echo $RecapRows_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_Name" name="o<?php echo $RecapRows_list->RowIndex ?>_Name" id="o<?php echo $RecapRows_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RecapRows_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Department_Idn" class="form-group RecapRows_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRows" data-field="x_Department_Idn" data-value-separator="<?php echo $RecapRows_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRows_list->RowIndex ?>_Department_Idn" name="x<?php echo $RecapRows_list->RowIndex ?>_Department_Idn"<?php echo $RecapRows_list->Department_Idn->editAttributes() ?>>
			<?php echo $RecapRows_list->Department_Idn->selectOptionListHtml("x{$RecapRows_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $RecapRows_list->Department_Idn->Lookup->getParamTag($RecapRows_list, "p_x" . $RecapRows_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_Department_Idn" name="o<?php echo $RecapRows_list->RowIndex ?>_Department_Idn" id="o<?php echo $RecapRows_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($RecapRows_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->CalcShopFlag->Visible) { // CalcShopFlag ?>
		<td data-name="CalcShopFlag">
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_CalcShopFlag" class="form-group RecapRows_CalcShopFlag">
<?php
$selwrk = ConvertToBool($RecapRows_list->CalcShopFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_CalcShopFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]_707850" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->CalcShopFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]_707850"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_CalcShopFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]" value="<?php echo HtmlEncode($RecapRows_list->CalcShopFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->IsWorksheetFlag->Visible) { // IsWorksheetFlag ?>
		<td data-name="IsWorksheetFlag">
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_IsWorksheetFlag" class="form-group RecapRows_IsWorksheetFlag">
<?php
$selwrk = ConvertToBool($RecapRows_list->IsWorksheetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_IsWorksheetFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]_629693" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->IsWorksheetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]_629693"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_IsWorksheetFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]" value="<?php echo HtmlEncode($RecapRows_list->IsWorksheetFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->DisplayFlag->Visible) { // DisplayFlag ?>
		<td data-name="DisplayFlag">
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_DisplayFlag" class="form-group RecapRows_DisplayFlag">
<?php
$selwrk = ConvertToBool($RecapRows_list->DisplayFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_DisplayFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]_831063" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->DisplayFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]_831063"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_DisplayFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]" value="<?php echo HtmlEncode($RecapRows_list->DisplayFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Rank" class="form-group RecapRows_Rank">
<input type="text" data-table="RecapRows" data-field="x_Rank" name="x<?php echo $RecapRows_list->RowIndex ?>_Rank" id="x<?php echo $RecapRows_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapRows_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapRows_list->Rank->EditValue ?>"<?php echo $RecapRows_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_Rank" name="o<?php echo $RecapRows_list->RowIndex ?>_Rank" id="o<?php echo $RecapRows_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RecapRows_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_ActiveFlag" class="form-group RecapRows_ActiveFlag">
<?php
$selwrk = ConvertToBool($RecapRows_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_ActiveFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]_122523" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]_122523"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_ActiveFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RecapRows_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapRows_list->ListOptions->render("body", "right", $RecapRows_list->RowCount);
?>
<script>
loadjs.ready(["fRecapRowslist", "load"], function() {
	fRecapRowslist.updateLists(<?php echo $RecapRows_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($RecapRows_list->ExportAll && $RecapRows_list->isExport()) {
	$RecapRows_list->StopRecord = $RecapRows_list->TotalRecords;
} else {

	// Set the last record to display
	if ($RecapRows_list->TotalRecords > $RecapRows_list->StartRecord + $RecapRows_list->DisplayRecords - 1)
		$RecapRows_list->StopRecord = $RecapRows_list->StartRecord + $RecapRows_list->DisplayRecords - 1;
	else
		$RecapRows_list->StopRecord = $RecapRows_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($RecapRows->isConfirm() || $RecapRows_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($RecapRows_list->FormKeyCountName) && ($RecapRows_list->isGridAdd() || $RecapRows_list->isGridEdit() || $RecapRows->isConfirm())) {
		$RecapRows_list->KeyCount = $CurrentForm->getValue($RecapRows_list->FormKeyCountName);
		$RecapRows_list->StopRecord = $RecapRows_list->StartRecord + $RecapRows_list->KeyCount - 1;
	}
}
$RecapRows_list->RecordCount = $RecapRows_list->StartRecord - 1;
if ($RecapRows_list->Recordset && !$RecapRows_list->Recordset->EOF) {
	$RecapRows_list->Recordset->moveFirst();
	$selectLimit = $RecapRows_list->UseSelectLimit;
	if (!$selectLimit && $RecapRows_list->StartRecord > 1)
		$RecapRows_list->Recordset->move($RecapRows_list->StartRecord - 1);
} elseif (!$RecapRows->AllowAddDeleteRow && $RecapRows_list->StopRecord == 0) {
	$RecapRows_list->StopRecord = $RecapRows->GridAddRowCount;
}

// Initialize aggregate
$RecapRows->RowType = ROWTYPE_AGGREGATEINIT;
$RecapRows->resetAttributes();
$RecapRows_list->renderRow();
$RecapRows_list->EditRowCount = 0;
if ($RecapRows_list->isEdit())
	$RecapRows_list->RowIndex = 1;
if ($RecapRows_list->isGridAdd())
	$RecapRows_list->RowIndex = 0;
if ($RecapRows_list->isGridEdit())
	$RecapRows_list->RowIndex = 0;
while ($RecapRows_list->RecordCount < $RecapRows_list->StopRecord) {
	$RecapRows_list->RecordCount++;
	if ($RecapRows_list->RecordCount >= $RecapRows_list->StartRecord) {
		$RecapRows_list->RowCount++;
		if ($RecapRows_list->isGridAdd() || $RecapRows_list->isGridEdit() || $RecapRows->isConfirm()) {
			$RecapRows_list->RowIndex++;
			$CurrentForm->Index = $RecapRows_list->RowIndex;
			if ($CurrentForm->hasValue($RecapRows_list->FormActionName) && ($RecapRows->isConfirm() || $RecapRows_list->EventCancelled))
				$RecapRows_list->RowAction = strval($CurrentForm->getValue($RecapRows_list->FormActionName));
			elseif ($RecapRows_list->isGridAdd())
				$RecapRows_list->RowAction = "insert";
			else
				$RecapRows_list->RowAction = "";
		}

		// Set up key count
		$RecapRows_list->KeyCount = $RecapRows_list->RowIndex;

		// Init row class and style
		$RecapRows->resetAttributes();
		$RecapRows->CssClass = "";
		if ($RecapRows_list->isGridAdd()) {
			$RecapRows_list->loadRowValues(); // Load default values
		} else {
			$RecapRows_list->loadRowValues($RecapRows_list->Recordset); // Load row values
		}
		$RecapRows->RowType = ROWTYPE_VIEW; // Render view
		if ($RecapRows_list->isGridAdd()) // Grid add
			$RecapRows->RowType = ROWTYPE_ADD; // Render add
		if ($RecapRows_list->isGridAdd() && $RecapRows->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$RecapRows_list->restoreCurrentRowFormValues($RecapRows_list->RowIndex); // Restore form values
		if ($RecapRows_list->isEdit()) {
			if ($RecapRows_list->checkInlineEditKey() && $RecapRows_list->EditRowCount == 0) { // Inline edit
				$RecapRows->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($RecapRows_list->isGridEdit()) { // Grid edit
			if ($RecapRows->EventCancelled)
				$RecapRows_list->restoreCurrentRowFormValues($RecapRows_list->RowIndex); // Restore form values
			if ($RecapRows_list->RowAction == "insert")
				$RecapRows->RowType = ROWTYPE_ADD; // Render add
			else
				$RecapRows->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($RecapRows_list->isEdit() && $RecapRows->RowType == ROWTYPE_EDIT && $RecapRows->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$RecapRows_list->restoreFormValues(); // Restore form values
		}
		if ($RecapRows_list->isGridEdit() && ($RecapRows->RowType == ROWTYPE_EDIT || $RecapRows->RowType == ROWTYPE_ADD) && $RecapRows->EventCancelled) // Update failed
			$RecapRows_list->restoreCurrentRowFormValues($RecapRows_list->RowIndex); // Restore form values
		if ($RecapRows->RowType == ROWTYPE_EDIT) // Edit row
			$RecapRows_list->EditRowCount++;

		// Set up row id / data-rowindex
		$RecapRows->RowAttrs->merge(["data-rowindex" => $RecapRows_list->RowCount, "id" => "r" . $RecapRows_list->RowCount . "_RecapRows", "data-rowtype" => $RecapRows->RowType]);

		// Render row
		$RecapRows_list->renderRow();

		// Render list options
		$RecapRows_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($RecapRows_list->RowAction != "delete" && $RecapRows_list->RowAction != "insertdelete" && !($RecapRows_list->RowAction == "insert" && $RecapRows->isConfirm() && $RecapRows_list->emptyRow())) {
?>
	<tr <?php echo $RecapRows->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapRows_list->ListOptions->render("body", "left", $RecapRows_list->RowCount);
?>
	<?php if ($RecapRows_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td data-name="RecapRow_Idn" <?php echo $RecapRows_list->RecapRow_Idn->cellAttributes() ?>>
<?php if ($RecapRows->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_RecapRow_Idn" class="form-group"></span>
<input type="hidden" data-table="RecapRows" data-field="x_RecapRow_Idn" name="o<?php echo $RecapRows_list->RowIndex ?>_RecapRow_Idn" id="o<?php echo $RecapRows_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapRows_list->RecapRow_Idn->OldValue) ?>">
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_RecapRow_Idn" class="form-group">
<span<?php echo $RecapRows_list->RecapRow_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($RecapRows_list->RecapRow_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_RecapRow_Idn" name="x<?php echo $RecapRows_list->RowIndex ?>_RecapRow_Idn" id="x<?php echo $RecapRows_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapRows_list->RecapRow_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_RecapRow_Idn">
<span<?php echo $RecapRows_list->RecapRow_Idn->viewAttributes() ?>><?php echo $RecapRows_list->RecapRow_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapRows_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $RecapRows_list->Name->cellAttributes() ?>>
<?php if ($RecapRows->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Name" class="form-group">
<input type="text" data-table="RecapRows" data-field="x_Name" name="x<?php echo $RecapRows_list->RowIndex ?>_Name" id="x<?php echo $RecapRows_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapRows_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapRows_list->Name->EditValue ?>"<?php echo $RecapRows_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_Name" name="o<?php echo $RecapRows_list->RowIndex ?>_Name" id="o<?php echo $RecapRows_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RecapRows_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Name" class="form-group">
<input type="text" data-table="RecapRows" data-field="x_Name" name="x<?php echo $RecapRows_list->RowIndex ?>_Name" id="x<?php echo $RecapRows_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapRows_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapRows_list->Name->EditValue ?>"<?php echo $RecapRows_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Name">
<span<?php echo $RecapRows_list->Name->viewAttributes() ?>><?php echo $RecapRows_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapRows_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $RecapRows_list->Department_Idn->cellAttributes() ?>>
<?php if ($RecapRows->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRows" data-field="x_Department_Idn" data-value-separator="<?php echo $RecapRows_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRows_list->RowIndex ?>_Department_Idn" name="x<?php echo $RecapRows_list->RowIndex ?>_Department_Idn"<?php echo $RecapRows_list->Department_Idn->editAttributes() ?>>
			<?php echo $RecapRows_list->Department_Idn->selectOptionListHtml("x{$RecapRows_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $RecapRows_list->Department_Idn->Lookup->getParamTag($RecapRows_list, "p_x" . $RecapRows_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_Department_Idn" name="o<?php echo $RecapRows_list->RowIndex ?>_Department_Idn" id="o<?php echo $RecapRows_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($RecapRows_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRows" data-field="x_Department_Idn" data-value-separator="<?php echo $RecapRows_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRows_list->RowIndex ?>_Department_Idn" name="x<?php echo $RecapRows_list->RowIndex ?>_Department_Idn"<?php echo $RecapRows_list->Department_Idn->editAttributes() ?>>
			<?php echo $RecapRows_list->Department_Idn->selectOptionListHtml("x{$RecapRows_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $RecapRows_list->Department_Idn->Lookup->getParamTag($RecapRows_list, "p_x" . $RecapRows_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Department_Idn">
<span<?php echo $RecapRows_list->Department_Idn->viewAttributes() ?>><?php echo $RecapRows_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapRows_list->CalcShopFlag->Visible) { // CalcShopFlag ?>
		<td data-name="CalcShopFlag" <?php echo $RecapRows_list->CalcShopFlag->cellAttributes() ?>>
<?php if ($RecapRows->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_CalcShopFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapRows_list->CalcShopFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_CalcShopFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]_393071" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->CalcShopFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]_393071"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_CalcShopFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]" value="<?php echo HtmlEncode($RecapRows_list->CalcShopFlag->OldValue) ?>">
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_CalcShopFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapRows_list->CalcShopFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_CalcShopFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]_198201" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->CalcShopFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]_198201"></label>
</div>
</span>
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_CalcShopFlag">
<span<?php echo $RecapRows_list->CalcShopFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CalcShopFlag" class="custom-control-input" value="<?php echo $RecapRows_list->CalcShopFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapRows_list->CalcShopFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CalcShopFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapRows_list->IsWorksheetFlag->Visible) { // IsWorksheetFlag ?>
		<td data-name="IsWorksheetFlag" <?php echo $RecapRows_list->IsWorksheetFlag->cellAttributes() ?>>
<?php if ($RecapRows->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_IsWorksheetFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapRows_list->IsWorksheetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_IsWorksheetFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]_193327" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->IsWorksheetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]_193327"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_IsWorksheetFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]" value="<?php echo HtmlEncode($RecapRows_list->IsWorksheetFlag->OldValue) ?>">
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_IsWorksheetFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapRows_list->IsWorksheetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_IsWorksheetFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]_292395" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->IsWorksheetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]_292395"></label>
</div>
</span>
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_IsWorksheetFlag">
<span<?php echo $RecapRows_list->IsWorksheetFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsWorksheetFlag" class="custom-control-input" value="<?php echo $RecapRows_list->IsWorksheetFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapRows_list->IsWorksheetFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsWorksheetFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapRows_list->DisplayFlag->Visible) { // DisplayFlag ?>
		<td data-name="DisplayFlag" <?php echo $RecapRows_list->DisplayFlag->cellAttributes() ?>>
<?php if ($RecapRows->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_DisplayFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapRows_list->DisplayFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_DisplayFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]_839752" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->DisplayFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]_839752"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_DisplayFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]" value="<?php echo HtmlEncode($RecapRows_list->DisplayFlag->OldValue) ?>">
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_DisplayFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapRows_list->DisplayFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_DisplayFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]_904376" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->DisplayFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]_904376"></label>
</div>
</span>
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_DisplayFlag">
<span<?php echo $RecapRows_list->DisplayFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DisplayFlag" class="custom-control-input" value="<?php echo $RecapRows_list->DisplayFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapRows_list->DisplayFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DisplayFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapRows_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $RecapRows_list->Rank->cellAttributes() ?>>
<?php if ($RecapRows->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Rank" class="form-group">
<input type="text" data-table="RecapRows" data-field="x_Rank" name="x<?php echo $RecapRows_list->RowIndex ?>_Rank" id="x<?php echo $RecapRows_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapRows_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapRows_list->Rank->EditValue ?>"<?php echo $RecapRows_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_Rank" name="o<?php echo $RecapRows_list->RowIndex ?>_Rank" id="o<?php echo $RecapRows_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RecapRows_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Rank" class="form-group">
<input type="text" data-table="RecapRows" data-field="x_Rank" name="x<?php echo $RecapRows_list->RowIndex ?>_Rank" id="x<?php echo $RecapRows_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapRows_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapRows_list->Rank->EditValue ?>"<?php echo $RecapRows_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_Rank">
<span<?php echo $RecapRows_list->Rank->viewAttributes() ?>><?php echo $RecapRows_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapRows_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $RecapRows_list->ActiveFlag->cellAttributes() ?>>
<?php if ($RecapRows->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapRows_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_ActiveFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]_901331" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]_901331"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_ActiveFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RecapRows_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapRows_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_ActiveFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]_281826" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]_281826"></label>
</div>
</span>
<?php } ?>
<?php if ($RecapRows->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapRows_list->RowCount ?>_RecapRows_ActiveFlag">
<span<?php echo $RecapRows_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $RecapRows_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapRows_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapRows_list->ListOptions->render("body", "right", $RecapRows_list->RowCount);
?>
	</tr>
<?php if ($RecapRows->RowType == ROWTYPE_ADD || $RecapRows->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fRecapRowslist", "load"], function() {
	fRecapRowslist.updateLists(<?php echo $RecapRows_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$RecapRows_list->isGridAdd())
		if (!$RecapRows_list->Recordset->EOF)
			$RecapRows_list->Recordset->moveNext();
}
?>
<?php
	if ($RecapRows_list->isGridAdd() || $RecapRows_list->isGridEdit()) {
		$RecapRows_list->RowIndex = '$rowindex$';
		$RecapRows_list->loadRowValues();

		// Set row properties
		$RecapRows->resetAttributes();
		$RecapRows->RowAttrs->merge(["data-rowindex" => $RecapRows_list->RowIndex, "id" => "r0_RecapRows", "data-rowtype" => ROWTYPE_ADD]);
		$RecapRows->RowAttrs->appendClass("ew-template");
		$RecapRows->RowType = ROWTYPE_ADD;

		// Render row
		$RecapRows_list->renderRow();

		// Render list options
		$RecapRows_list->renderListOptions();
		$RecapRows_list->StartRowCount = 0;
?>
	<tr <?php echo $RecapRows->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapRows_list->ListOptions->render("body", "left", $RecapRows_list->RowIndex);
?>
	<?php if ($RecapRows_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td data-name="RecapRow_Idn">
<span id="el$rowindex$_RecapRows_RecapRow_Idn" class="form-group RecapRows_RecapRow_Idn"></span>
<input type="hidden" data-table="RecapRows" data-field="x_RecapRow_Idn" name="o<?php echo $RecapRows_list->RowIndex ?>_RecapRow_Idn" id="o<?php echo $RecapRows_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapRows_list->RecapRow_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_RecapRows_Name" class="form-group RecapRows_Name">
<input type="text" data-table="RecapRows" data-field="x_Name" name="x<?php echo $RecapRows_list->RowIndex ?>_Name" id="x<?php echo $RecapRows_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($RecapRows_list->Name->getPlaceHolder()) ?>" value="<?php echo $RecapRows_list->Name->EditValue ?>"<?php echo $RecapRows_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_Name" name="o<?php echo $RecapRows_list->RowIndex ?>_Name" id="o<?php echo $RecapRows_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($RecapRows_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_RecapRows_Department_Idn" class="form-group RecapRows_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRows" data-field="x_Department_Idn" data-value-separator="<?php echo $RecapRows_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRows_list->RowIndex ?>_Department_Idn" name="x<?php echo $RecapRows_list->RowIndex ?>_Department_Idn"<?php echo $RecapRows_list->Department_Idn->editAttributes() ?>>
			<?php echo $RecapRows_list->Department_Idn->selectOptionListHtml("x{$RecapRows_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $RecapRows_list->Department_Idn->Lookup->getParamTag($RecapRows_list, "p_x" . $RecapRows_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_Department_Idn" name="o<?php echo $RecapRows_list->RowIndex ?>_Department_Idn" id="o<?php echo $RecapRows_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($RecapRows_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->CalcShopFlag->Visible) { // CalcShopFlag ?>
		<td data-name="CalcShopFlag">
<span id="el$rowindex$_RecapRows_CalcShopFlag" class="form-group RecapRows_CalcShopFlag">
<?php
$selwrk = ConvertToBool($RecapRows_list->CalcShopFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_CalcShopFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]_382614" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->CalcShopFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]_382614"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_CalcShopFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_CalcShopFlag[]" value="<?php echo HtmlEncode($RecapRows_list->CalcShopFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->IsWorksheetFlag->Visible) { // IsWorksheetFlag ?>
		<td data-name="IsWorksheetFlag">
<span id="el$rowindex$_RecapRows_IsWorksheetFlag" class="form-group RecapRows_IsWorksheetFlag">
<?php
$selwrk = ConvertToBool($RecapRows_list->IsWorksheetFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_IsWorksheetFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]_444539" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->IsWorksheetFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]_444539"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_IsWorksheetFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_IsWorksheetFlag[]" value="<?php echo HtmlEncode($RecapRows_list->IsWorksheetFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->DisplayFlag->Visible) { // DisplayFlag ?>
		<td data-name="DisplayFlag">
<span id="el$rowindex$_RecapRows_DisplayFlag" class="form-group RecapRows_DisplayFlag">
<?php
$selwrk = ConvertToBool($RecapRows_list->DisplayFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_DisplayFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]_134707" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->DisplayFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]_134707"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_DisplayFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_DisplayFlag[]" value="<?php echo HtmlEncode($RecapRows_list->DisplayFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_RecapRows_Rank" class="form-group RecapRows_Rank">
<input type="text" data-table="RecapRows" data-field="x_Rank" name="x<?php echo $RecapRows_list->RowIndex ?>_Rank" id="x<?php echo $RecapRows_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapRows_list->Rank->getPlaceHolder()) ?>" value="<?php echo $RecapRows_list->Rank->EditValue ?>"<?php echo $RecapRows_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_Rank" name="o<?php echo $RecapRows_list->RowIndex ?>_Rank" id="o<?php echo $RecapRows_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($RecapRows_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRows_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_RecapRows_ActiveFlag" class="form-group RecapRows_ActiveFlag">
<?php
$selwrk = ConvertToBool($RecapRows_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapRows" data-field="x_ActiveFlag" name="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]_377095" value="1"<?php echo $selwrk ?><?php echo $RecapRows_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]_377095"></label>
</div>
</span>
<input type="hidden" data-table="RecapRows" data-field="x_ActiveFlag" name="o<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RecapRows_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RecapRows_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapRows_list->ListOptions->render("body", "right", $RecapRows_list->RowIndex);
?>
<script>
loadjs.ready(["fRecapRowslist", "load"], function() {
	fRecapRowslist.updateLists(<?php echo $RecapRows_list->RowIndex ?>);
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
<?php if ($RecapRows_list->isAdd() || $RecapRows_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $RecapRows_list->FormKeyCountName ?>" id="<?php echo $RecapRows_list->FormKeyCountName ?>" value="<?php echo $RecapRows_list->KeyCount ?>">
<?php } ?>
<?php if ($RecapRows_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $RecapRows_list->FormKeyCountName ?>" id="<?php echo $RecapRows_list->FormKeyCountName ?>" value="<?php echo $RecapRows_list->KeyCount ?>">
<?php echo $RecapRows_list->MultiSelectKey ?>
<?php } ?>
<?php if ($RecapRows_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $RecapRows_list->FormKeyCountName ?>" id="<?php echo $RecapRows_list->FormKeyCountName ?>" value="<?php echo $RecapRows_list->KeyCount ?>">
<?php } ?>
<?php if ($RecapRows_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $RecapRows_list->FormKeyCountName ?>" id="<?php echo $RecapRows_list->FormKeyCountName ?>" value="<?php echo $RecapRows_list->KeyCount ?>">
<?php echo $RecapRows_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$RecapRows->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($RecapRows_list->Recordset)
	$RecapRows_list->Recordset->Close();
?>
<?php if (!$RecapRows_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$RecapRows_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapRows_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RecapRows_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($RecapRows_list->TotalRecords == 0 && !$RecapRows->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $RecapRows_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$RecapRows_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$RecapRows_list->isExport()) { ?>
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
$RecapRows_list->terminate();
?>