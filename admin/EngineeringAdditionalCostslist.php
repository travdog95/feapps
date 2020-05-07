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
$EngineeringAdditionalCosts_list = new EngineeringAdditionalCosts_list();

// Run the page
$EngineeringAdditionalCosts_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$EngineeringAdditionalCosts_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$EngineeringAdditionalCosts_list->isExport()) { ?>
<script>
var fEngineeringAdditionalCostslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fEngineeringAdditionalCostslist = currentForm = new ew.Form("fEngineeringAdditionalCostslist", "list");
	fEngineeringAdditionalCostslist.formKeyCountName = '<?php echo $EngineeringAdditionalCosts_list->FormKeyCountName ?>';

	// Validate form
	fEngineeringAdditionalCostslist.validate = function() {
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
			<?php if ($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_EngineeringAdditionalCost_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->caption(), $EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EngineeringAdditionalCosts_list->LineNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_LineNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_list->LineNumber->caption(), $EngineeringAdditionalCosts_list->LineNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LineNumber");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_list->LineNumber->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_list->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_list->Quantity->caption(), $EngineeringAdditionalCosts_list->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_list->Quantity->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_list->Name->caption(), $EngineeringAdditionalCosts_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EngineeringAdditionalCosts_list->ManHours->Required) { ?>
				elm = this.getElements("x" + infix + "_ManHours");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_list->ManHours->caption(), $EngineeringAdditionalCosts_list->ManHours->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ManHours");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_list->ManHours->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_list->Rank->caption(), $EngineeringAdditionalCosts_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($EngineeringAdditionalCosts_list->Rank->errorMessage()) ?>");
			<?php if ($EngineeringAdditionalCosts_list->Parent_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Parent_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_list->Parent_Idn->caption(), $EngineeringAdditionalCosts_list->Parent_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($EngineeringAdditionalCosts_list->DefaultFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_DefaultFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $EngineeringAdditionalCosts_list->DefaultFlag->caption(), $EngineeringAdditionalCosts_list->DefaultFlag->RequiredErrorMessage)) ?>");
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
	fEngineeringAdditionalCostslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LineNumber", false)) return false;
		if (ew.valueChanged(fobj, infix, "Quantity", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "ManHours", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "Parent_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "DefaultFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fEngineeringAdditionalCostslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fEngineeringAdditionalCostslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fEngineeringAdditionalCostslist.lists["x_Parent_Idn"] = <?php echo $EngineeringAdditionalCosts_list->Parent_Idn->Lookup->toClientList($EngineeringAdditionalCosts_list) ?>;
	fEngineeringAdditionalCostslist.lists["x_Parent_Idn"].options = <?php echo JsonEncode($EngineeringAdditionalCosts_list->Parent_Idn->lookupOptions()) ?>;
	fEngineeringAdditionalCostslist.lists["x_DefaultFlag[]"] = <?php echo $EngineeringAdditionalCosts_list->DefaultFlag->Lookup->toClientList($EngineeringAdditionalCosts_list) ?>;
	fEngineeringAdditionalCostslist.lists["x_DefaultFlag[]"].options = <?php echo JsonEncode($EngineeringAdditionalCosts_list->DefaultFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fEngineeringAdditionalCostslist");
});
var fEngineeringAdditionalCostslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fEngineeringAdditionalCostslistsrch = currentSearchForm = new ew.Form("fEngineeringAdditionalCostslistsrch");

	// Dynamic selection lists
	// Filters

	fEngineeringAdditionalCostslistsrch.filterList = <?php echo $EngineeringAdditionalCosts_list->getFilterList() ?>;
	loadjs.done("fEngineeringAdditionalCostslistsrch");
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
<?php if (!$EngineeringAdditionalCosts_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($EngineeringAdditionalCosts_list->TotalRecords > 0 && $EngineeringAdditionalCosts_list->ExportOptions->visible()) { ?>
<?php $EngineeringAdditionalCosts_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->ImportOptions->visible()) { ?>
<?php $EngineeringAdditionalCosts_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->SearchOptions->visible()) { ?>
<?php $EngineeringAdditionalCosts_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->FilterOptions->visible()) { ?>
<?php $EngineeringAdditionalCosts_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$EngineeringAdditionalCosts_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$EngineeringAdditionalCosts_list->isExport() && !$EngineeringAdditionalCosts->CurrentAction) { ?>
<form name="fEngineeringAdditionalCostslistsrch" id="fEngineeringAdditionalCostslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fEngineeringAdditionalCostslistsrch-search-panel" class="<?php echo $EngineeringAdditionalCosts_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="EngineeringAdditionalCosts">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $EngineeringAdditionalCosts_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $EngineeringAdditionalCosts_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($EngineeringAdditionalCosts_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($EngineeringAdditionalCosts_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($EngineeringAdditionalCosts_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($EngineeringAdditionalCosts_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $EngineeringAdditionalCosts_list->showPageHeader(); ?>
<?php
$EngineeringAdditionalCosts_list->showMessage();
?>
<?php if ($EngineeringAdditionalCosts_list->TotalRecords > 0 || $EngineeringAdditionalCosts->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($EngineeringAdditionalCosts_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> EngineeringAdditionalCosts">
<?php if (!$EngineeringAdditionalCosts_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$EngineeringAdditionalCosts_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $EngineeringAdditionalCosts_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $EngineeringAdditionalCosts_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fEngineeringAdditionalCostslist" id="fEngineeringAdditionalCostslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="EngineeringAdditionalCosts">
<div id="gmp_EngineeringAdditionalCosts" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($EngineeringAdditionalCosts_list->TotalRecords > 0 || $EngineeringAdditionalCosts_list->isAdd() || $EngineeringAdditionalCosts_list->isCopy() || $EngineeringAdditionalCosts_list->isGridEdit()) { ?>
<table id="tbl_EngineeringAdditionalCostslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$EngineeringAdditionalCosts->RowType = ROWTYPE_HEADER;

// Render list options
$EngineeringAdditionalCosts_list->renderListOptions();

// Render list options (header, left)
$EngineeringAdditionalCosts_list->ListOptions->render("header", "left");
?>
<?php if ($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->Visible) { // EngineeringAdditionalCost_Idn ?>
	<?php if ($EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn) == "") { ?>
		<th data-name="EngineeringAdditionalCost_Idn" class="<?php echo $EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->headerCellClass() ?>"><div id="elh_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn" class="EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn"><div class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EngineeringAdditionalCost_Idn" class="<?php echo $EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn) ?>', 1);"><div id="elh_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn" class="EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->LineNumber->Visible) { // LineNumber ?>
	<?php if ($EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->LineNumber) == "") { ?>
		<th data-name="LineNumber" class="<?php echo $EngineeringAdditionalCosts_list->LineNumber->headerCellClass() ?>"><div id="elh_EngineeringAdditionalCosts_LineNumber" class="EngineeringAdditionalCosts_LineNumber"><div class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->LineNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LineNumber" class="<?php echo $EngineeringAdditionalCosts_list->LineNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->LineNumber) ?>', 1);"><div id="elh_EngineeringAdditionalCosts_LineNumber" class="EngineeringAdditionalCosts_LineNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->LineNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($EngineeringAdditionalCosts_list->LineNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EngineeringAdditionalCosts_list->LineNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->Quantity->Visible) { // Quantity ?>
	<?php if ($EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $EngineeringAdditionalCosts_list->Quantity->headerCellClass() ?>"><div id="elh_EngineeringAdditionalCosts_Quantity" class="EngineeringAdditionalCosts_Quantity"><div class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $EngineeringAdditionalCosts_list->Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->Quantity) ?>', 1);"><div id="elh_EngineeringAdditionalCosts_Quantity" class="EngineeringAdditionalCosts_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($EngineeringAdditionalCosts_list->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EngineeringAdditionalCosts_list->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->Name->Visible) { // Name ?>
	<?php if ($EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $EngineeringAdditionalCosts_list->Name->headerCellClass() ?>"><div id="elh_EngineeringAdditionalCosts_Name" class="EngineeringAdditionalCosts_Name"><div class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $EngineeringAdditionalCosts_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->Name) ?>', 1);"><div id="elh_EngineeringAdditionalCosts_Name" class="EngineeringAdditionalCosts_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($EngineeringAdditionalCosts_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EngineeringAdditionalCosts_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->ManHours->Visible) { // ManHours ?>
	<?php if ($EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->ManHours) == "") { ?>
		<th data-name="ManHours" class="<?php echo $EngineeringAdditionalCosts_list->ManHours->headerCellClass() ?>"><div id="elh_EngineeringAdditionalCosts_ManHours" class="EngineeringAdditionalCosts_ManHours"><div class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->ManHours->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ManHours" class="<?php echo $EngineeringAdditionalCosts_list->ManHours->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->ManHours) ?>', 1);"><div id="elh_EngineeringAdditionalCosts_ManHours" class="EngineeringAdditionalCosts_ManHours">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->ManHours->caption() ?></span><span class="ew-table-header-sort"><?php if ($EngineeringAdditionalCosts_list->ManHours->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EngineeringAdditionalCosts_list->ManHours->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->Rank->Visible) { // Rank ?>
	<?php if ($EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $EngineeringAdditionalCosts_list->Rank->headerCellClass() ?>"><div id="elh_EngineeringAdditionalCosts_Rank" class="EngineeringAdditionalCosts_Rank"><div class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $EngineeringAdditionalCosts_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->Rank) ?>', 1);"><div id="elh_EngineeringAdditionalCosts_Rank" class="EngineeringAdditionalCosts_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($EngineeringAdditionalCosts_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EngineeringAdditionalCosts_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->Parent_Idn->Visible) { // Parent_Idn ?>
	<?php if ($EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->Parent_Idn) == "") { ?>
		<th data-name="Parent_Idn" class="<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->headerCellClass() ?>"><div id="elh_EngineeringAdditionalCosts_Parent_Idn" class="EngineeringAdditionalCosts_Parent_Idn"><div class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->Parent_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Parent_Idn" class="<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->Parent_Idn) ?>', 1);"><div id="elh_EngineeringAdditionalCosts_Parent_Idn" class="EngineeringAdditionalCosts_Parent_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->Parent_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($EngineeringAdditionalCosts_list->Parent_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EngineeringAdditionalCosts_list->Parent_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->DefaultFlag->Visible) { // DefaultFlag ?>
	<?php if ($EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->DefaultFlag) == "") { ?>
		<th data-name="DefaultFlag" class="<?php echo $EngineeringAdditionalCosts_list->DefaultFlag->headerCellClass() ?>"><div id="elh_EngineeringAdditionalCosts_DefaultFlag" class="EngineeringAdditionalCosts_DefaultFlag"><div class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->DefaultFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DefaultFlag" class="<?php echo $EngineeringAdditionalCosts_list->DefaultFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $EngineeringAdditionalCosts_list->SortUrl($EngineeringAdditionalCosts_list->DefaultFlag) ?>', 1);"><div id="elh_EngineeringAdditionalCosts_DefaultFlag" class="EngineeringAdditionalCosts_DefaultFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $EngineeringAdditionalCosts_list->DefaultFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($EngineeringAdditionalCosts_list->DefaultFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($EngineeringAdditionalCosts_list->DefaultFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$EngineeringAdditionalCosts_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($EngineeringAdditionalCosts_list->isAdd() || $EngineeringAdditionalCosts_list->isCopy()) {
		$EngineeringAdditionalCosts_list->RowIndex = 0;
		$EngineeringAdditionalCosts_list->KeyCount = $EngineeringAdditionalCosts_list->RowIndex;
		if ($EngineeringAdditionalCosts_list->isCopy() && !$EngineeringAdditionalCosts_list->loadRow())
			$EngineeringAdditionalCosts->CurrentAction = "add";
		if ($EngineeringAdditionalCosts_list->isAdd())
			$EngineeringAdditionalCosts_list->loadRowValues();
		if ($EngineeringAdditionalCosts->EventCancelled) // Insert failed
			$EngineeringAdditionalCosts_list->restoreFormValues(); // Restore form values

		// Set row properties
		$EngineeringAdditionalCosts->resetAttributes();
		$EngineeringAdditionalCosts->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_EngineeringAdditionalCosts", "data-rowtype" => ROWTYPE_ADD]);
		$EngineeringAdditionalCosts->RowType = ROWTYPE_ADD;

		// Render row
		$EngineeringAdditionalCosts_list->renderRow();

		// Render list options
		$EngineeringAdditionalCosts_list->renderListOptions();
		$EngineeringAdditionalCosts_list->StartRowCount = 0;
?>
	<tr <?php echo $EngineeringAdditionalCosts->rowAttributes() ?>>
<?php

// Render list options (body, left)
$EngineeringAdditionalCosts_list->ListOptions->render("body", "left", $EngineeringAdditionalCosts_list->RowCount);
?>
	<?php if ($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->Visible) { // EngineeringAdditionalCost_Idn ?>
		<td data-name="EngineeringAdditionalCost_Idn">
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn" class="form-group EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn"></span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_EngineeringAdditionalCost_Idn" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_EngineeringAdditionalCost_Idn" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_EngineeringAdditionalCost_Idn" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->LineNumber->Visible) { // LineNumber ?>
		<td data-name="LineNumber">
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_LineNumber" class="form-group EngineeringAdditionalCosts_LineNumber">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_LineNumber" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->LineNumber->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->LineNumber->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->LineNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_LineNumber" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->LineNumber->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity">
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Quantity" class="form-group EngineeringAdditionalCosts_Quantity">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Quantity" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Quantity->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Quantity->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Quantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Quantity" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Quantity->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Name" class="form-group EngineeringAdditionalCosts_Name">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Name" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Name->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Name->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Name" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->ManHours->Visible) { // ManHours ?>
		<td data-name="ManHours">
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_ManHours" class="form-group EngineeringAdditionalCosts_ManHours">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_ManHours" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->ManHours->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->ManHours->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->ManHours->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_ManHours" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->ManHours->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Rank" class="form-group EngineeringAdditionalCosts_Rank">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Rank" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Rank->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Rank->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Rank" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Parent_Idn->Visible) { // Parent_Idn ?>
		<td data-name="Parent_Idn">
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Parent_Idn" class="form-group EngineeringAdditionalCosts_Parent_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="EngineeringAdditionalCosts" data-field="x_Parent_Idn" data-value-separator="<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn"<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->editAttributes() ?>>
			<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->selectOptionListHtml("x{$EngineeringAdditionalCosts_list->RowIndex}_Parent_Idn") ?>
		</select>
</div>
<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->Lookup->getParamTag($EngineeringAdditionalCosts_list, "p_x" . $EngineeringAdditionalCosts_list->RowIndex . "_Parent_Idn") ?>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Parent_Idn" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Parent_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->DefaultFlag->Visible) { // DefaultFlag ?>
		<td data-name="DefaultFlag">
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_DefaultFlag" class="form-group EngineeringAdditionalCosts_DefaultFlag">
<?php
$selwrk = ConvertToBool($EngineeringAdditionalCosts_list->DefaultFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="EngineeringAdditionalCosts" data-field="x_DefaultFlag" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]_302553" value="1"<?php echo $selwrk ?><?php echo $EngineeringAdditionalCosts_list->DefaultFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]_302553"></label>
</div>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_DefaultFlag" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->DefaultFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$EngineeringAdditionalCosts_list->ListOptions->render("body", "right", $EngineeringAdditionalCosts_list->RowCount);
?>
<script>
loadjs.ready(["fEngineeringAdditionalCostslist", "load"], function() {
	fEngineeringAdditionalCostslist.updateLists(<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($EngineeringAdditionalCosts_list->ExportAll && $EngineeringAdditionalCosts_list->isExport()) {
	$EngineeringAdditionalCosts_list->StopRecord = $EngineeringAdditionalCosts_list->TotalRecords;
} else {

	// Set the last record to display
	if ($EngineeringAdditionalCosts_list->TotalRecords > $EngineeringAdditionalCosts_list->StartRecord + $EngineeringAdditionalCosts_list->DisplayRecords - 1)
		$EngineeringAdditionalCosts_list->StopRecord = $EngineeringAdditionalCosts_list->StartRecord + $EngineeringAdditionalCosts_list->DisplayRecords - 1;
	else
		$EngineeringAdditionalCosts_list->StopRecord = $EngineeringAdditionalCosts_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($EngineeringAdditionalCosts->isConfirm() || $EngineeringAdditionalCosts_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($EngineeringAdditionalCosts_list->FormKeyCountName) && ($EngineeringAdditionalCosts_list->isGridAdd() || $EngineeringAdditionalCosts_list->isGridEdit() || $EngineeringAdditionalCosts->isConfirm())) {
		$EngineeringAdditionalCosts_list->KeyCount = $CurrentForm->getValue($EngineeringAdditionalCosts_list->FormKeyCountName);
		$EngineeringAdditionalCosts_list->StopRecord = $EngineeringAdditionalCosts_list->StartRecord + $EngineeringAdditionalCosts_list->KeyCount - 1;
	}
}
$EngineeringAdditionalCosts_list->RecordCount = $EngineeringAdditionalCosts_list->StartRecord - 1;
if ($EngineeringAdditionalCosts_list->Recordset && !$EngineeringAdditionalCosts_list->Recordset->EOF) {
	$EngineeringAdditionalCosts_list->Recordset->moveFirst();
	$selectLimit = $EngineeringAdditionalCosts_list->UseSelectLimit;
	if (!$selectLimit && $EngineeringAdditionalCosts_list->StartRecord > 1)
		$EngineeringAdditionalCosts_list->Recordset->move($EngineeringAdditionalCosts_list->StartRecord - 1);
} elseif (!$EngineeringAdditionalCosts->AllowAddDeleteRow && $EngineeringAdditionalCosts_list->StopRecord == 0) {
	$EngineeringAdditionalCosts_list->StopRecord = $EngineeringAdditionalCosts->GridAddRowCount;
}

// Initialize aggregate
$EngineeringAdditionalCosts->RowType = ROWTYPE_AGGREGATEINIT;
$EngineeringAdditionalCosts->resetAttributes();
$EngineeringAdditionalCosts_list->renderRow();
$EngineeringAdditionalCosts_list->EditRowCount = 0;
if ($EngineeringAdditionalCosts_list->isEdit())
	$EngineeringAdditionalCosts_list->RowIndex = 1;
if ($EngineeringAdditionalCosts_list->isGridAdd())
	$EngineeringAdditionalCosts_list->RowIndex = 0;
if ($EngineeringAdditionalCosts_list->isGridEdit())
	$EngineeringAdditionalCosts_list->RowIndex = 0;
while ($EngineeringAdditionalCosts_list->RecordCount < $EngineeringAdditionalCosts_list->StopRecord) {
	$EngineeringAdditionalCosts_list->RecordCount++;
	if ($EngineeringAdditionalCosts_list->RecordCount >= $EngineeringAdditionalCosts_list->StartRecord) {
		$EngineeringAdditionalCosts_list->RowCount++;
		if ($EngineeringAdditionalCosts_list->isGridAdd() || $EngineeringAdditionalCosts_list->isGridEdit() || $EngineeringAdditionalCosts->isConfirm()) {
			$EngineeringAdditionalCosts_list->RowIndex++;
			$CurrentForm->Index = $EngineeringAdditionalCosts_list->RowIndex;
			if ($CurrentForm->hasValue($EngineeringAdditionalCosts_list->FormActionName) && ($EngineeringAdditionalCosts->isConfirm() || $EngineeringAdditionalCosts_list->EventCancelled))
				$EngineeringAdditionalCosts_list->RowAction = strval($CurrentForm->getValue($EngineeringAdditionalCosts_list->FormActionName));
			elseif ($EngineeringAdditionalCosts_list->isGridAdd())
				$EngineeringAdditionalCosts_list->RowAction = "insert";
			else
				$EngineeringAdditionalCosts_list->RowAction = "";
		}

		// Set up key count
		$EngineeringAdditionalCosts_list->KeyCount = $EngineeringAdditionalCosts_list->RowIndex;

		// Init row class and style
		$EngineeringAdditionalCosts->resetAttributes();
		$EngineeringAdditionalCosts->CssClass = "";
		if ($EngineeringAdditionalCosts_list->isGridAdd()) {
			$EngineeringAdditionalCosts_list->loadRowValues(); // Load default values
		} else {
			$EngineeringAdditionalCosts_list->loadRowValues($EngineeringAdditionalCosts_list->Recordset); // Load row values
		}
		$EngineeringAdditionalCosts->RowType = ROWTYPE_VIEW; // Render view
		if ($EngineeringAdditionalCosts_list->isGridAdd()) // Grid add
			$EngineeringAdditionalCosts->RowType = ROWTYPE_ADD; // Render add
		if ($EngineeringAdditionalCosts_list->isGridAdd() && $EngineeringAdditionalCosts->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$EngineeringAdditionalCosts_list->restoreCurrentRowFormValues($EngineeringAdditionalCosts_list->RowIndex); // Restore form values
		if ($EngineeringAdditionalCosts_list->isEdit()) {
			if ($EngineeringAdditionalCosts_list->checkInlineEditKey() && $EngineeringAdditionalCosts_list->EditRowCount == 0) { // Inline edit
				$EngineeringAdditionalCosts->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($EngineeringAdditionalCosts_list->isGridEdit()) { // Grid edit
			if ($EngineeringAdditionalCosts->EventCancelled)
				$EngineeringAdditionalCosts_list->restoreCurrentRowFormValues($EngineeringAdditionalCosts_list->RowIndex); // Restore form values
			if ($EngineeringAdditionalCosts_list->RowAction == "insert")
				$EngineeringAdditionalCosts->RowType = ROWTYPE_ADD; // Render add
			else
				$EngineeringAdditionalCosts->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($EngineeringAdditionalCosts_list->isEdit() && $EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT && $EngineeringAdditionalCosts->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$EngineeringAdditionalCosts_list->restoreFormValues(); // Restore form values
		}
		if ($EngineeringAdditionalCosts_list->isGridEdit() && ($EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT || $EngineeringAdditionalCosts->RowType == ROWTYPE_ADD) && $EngineeringAdditionalCosts->EventCancelled) // Update failed
			$EngineeringAdditionalCosts_list->restoreCurrentRowFormValues($EngineeringAdditionalCosts_list->RowIndex); // Restore form values
		if ($EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT) // Edit row
			$EngineeringAdditionalCosts_list->EditRowCount++;

		// Set up row id / data-rowindex
		$EngineeringAdditionalCosts->RowAttrs->merge(["data-rowindex" => $EngineeringAdditionalCosts_list->RowCount, "id" => "r" . $EngineeringAdditionalCosts_list->RowCount . "_EngineeringAdditionalCosts", "data-rowtype" => $EngineeringAdditionalCosts->RowType]);

		// Render row
		$EngineeringAdditionalCosts_list->renderRow();

		// Render list options
		$EngineeringAdditionalCosts_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($EngineeringAdditionalCosts_list->RowAction != "delete" && $EngineeringAdditionalCosts_list->RowAction != "insertdelete" && !($EngineeringAdditionalCosts_list->RowAction == "insert" && $EngineeringAdditionalCosts->isConfirm() && $EngineeringAdditionalCosts_list->emptyRow())) {
?>
	<tr <?php echo $EngineeringAdditionalCosts->rowAttributes() ?>>
<?php

// Render list options (body, left)
$EngineeringAdditionalCosts_list->ListOptions->render("body", "left", $EngineeringAdditionalCosts_list->RowCount);
?>
	<?php if ($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->Visible) { // EngineeringAdditionalCost_Idn ?>
		<td data-name="EngineeringAdditionalCost_Idn" <?php echo $EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->cellAttributes() ?>>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn" class="form-group"></span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_EngineeringAdditionalCost_Idn" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_EngineeringAdditionalCost_Idn" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_EngineeringAdditionalCost_Idn" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->OldValue) ?>">
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn" class="form-group">
<span<?php echo $EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_EngineeringAdditionalCost_Idn" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_EngineeringAdditionalCost_Idn" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_EngineeringAdditionalCost_Idn" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn">
<span<?php echo $EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->LineNumber->Visible) { // LineNumber ?>
		<td data-name="LineNumber" <?php echo $EngineeringAdditionalCosts_list->LineNumber->cellAttributes() ?>>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_LineNumber" class="form-group">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_LineNumber" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->LineNumber->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->LineNumber->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->LineNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_LineNumber" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->LineNumber->OldValue) ?>">
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_LineNumber" class="form-group">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_LineNumber" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->LineNumber->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->LineNumber->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->LineNumber->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_LineNumber">
<span<?php echo $EngineeringAdditionalCosts_list->LineNumber->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_list->LineNumber->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $EngineeringAdditionalCosts_list->Quantity->cellAttributes() ?>>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Quantity" class="form-group">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Quantity" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Quantity->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Quantity->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Quantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Quantity" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Quantity->OldValue) ?>">
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Quantity" class="form-group">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Quantity" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Quantity->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Quantity->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Quantity->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Quantity">
<span<?php echo $EngineeringAdditionalCosts_list->Quantity->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_list->Quantity->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $EngineeringAdditionalCosts_list->Name->cellAttributes() ?>>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Name" class="form-group">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Name" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Name->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Name->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Name" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Name" class="form-group">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Name" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Name->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Name->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Name">
<span<?php echo $EngineeringAdditionalCosts_list->Name->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->ManHours->Visible) { // ManHours ?>
		<td data-name="ManHours" <?php echo $EngineeringAdditionalCosts_list->ManHours->cellAttributes() ?>>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_ManHours" class="form-group">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_ManHours" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->ManHours->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->ManHours->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->ManHours->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_ManHours" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->ManHours->OldValue) ?>">
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_ManHours" class="form-group">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_ManHours" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->ManHours->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->ManHours->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->ManHours->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_ManHours">
<span<?php echo $EngineeringAdditionalCosts_list->ManHours->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_list->ManHours->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $EngineeringAdditionalCosts_list->Rank->cellAttributes() ?>>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Rank" class="form-group">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Rank" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Rank->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Rank->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Rank" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Rank" class="form-group">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Rank" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Rank->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Rank->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Rank">
<span<?php echo $EngineeringAdditionalCosts_list->Rank->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Parent_Idn->Visible) { // Parent_Idn ?>
		<td data-name="Parent_Idn" <?php echo $EngineeringAdditionalCosts_list->Parent_Idn->cellAttributes() ?>>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Parent_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="EngineeringAdditionalCosts" data-field="x_Parent_Idn" data-value-separator="<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn"<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->editAttributes() ?>>
			<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->selectOptionListHtml("x{$EngineeringAdditionalCosts_list->RowIndex}_Parent_Idn") ?>
		</select>
</div>
<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->Lookup->getParamTag($EngineeringAdditionalCosts_list, "p_x" . $EngineeringAdditionalCosts_list->RowIndex . "_Parent_Idn") ?>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Parent_Idn" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Parent_Idn->OldValue) ?>">
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Parent_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="EngineeringAdditionalCosts" data-field="x_Parent_Idn" data-value-separator="<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn"<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->editAttributes() ?>>
			<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->selectOptionListHtml("x{$EngineeringAdditionalCosts_list->RowIndex}_Parent_Idn") ?>
		</select>
</div>
<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->Lookup->getParamTag($EngineeringAdditionalCosts_list, "p_x" . $EngineeringAdditionalCosts_list->RowIndex . "_Parent_Idn") ?>
</span>
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_Parent_Idn">
<span<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->viewAttributes() ?>><?php echo $EngineeringAdditionalCosts_list->Parent_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->DefaultFlag->Visible) { // DefaultFlag ?>
		<td data-name="DefaultFlag" <?php echo $EngineeringAdditionalCosts_list->DefaultFlag->cellAttributes() ?>>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_DefaultFlag" class="form-group">
<?php
$selwrk = ConvertToBool($EngineeringAdditionalCosts_list->DefaultFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="EngineeringAdditionalCosts" data-field="x_DefaultFlag" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]_924107" value="1"<?php echo $selwrk ?><?php echo $EngineeringAdditionalCosts_list->DefaultFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]_924107"></label>
</div>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_DefaultFlag" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->DefaultFlag->OldValue) ?>">
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_DefaultFlag" class="form-group">
<?php
$selwrk = ConvertToBool($EngineeringAdditionalCosts_list->DefaultFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="EngineeringAdditionalCosts" data-field="x_DefaultFlag" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]_591737" value="1"<?php echo $selwrk ?><?php echo $EngineeringAdditionalCosts_list->DefaultFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]_591737"></label>
</div>
</span>
<?php } ?>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $EngineeringAdditionalCosts_list->RowCount ?>_EngineeringAdditionalCosts_DefaultFlag">
<span<?php echo $EngineeringAdditionalCosts_list->DefaultFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DefaultFlag" class="custom-control-input" value="<?php echo $EngineeringAdditionalCosts_list->DefaultFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($EngineeringAdditionalCosts_list->DefaultFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DefaultFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$EngineeringAdditionalCosts_list->ListOptions->render("body", "right", $EngineeringAdditionalCosts_list->RowCount);
?>
	</tr>
<?php if ($EngineeringAdditionalCosts->RowType == ROWTYPE_ADD || $EngineeringAdditionalCosts->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fEngineeringAdditionalCostslist", "load"], function() {
	fEngineeringAdditionalCostslist.updateLists(<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$EngineeringAdditionalCosts_list->isGridAdd())
		if (!$EngineeringAdditionalCosts_list->Recordset->EOF)
			$EngineeringAdditionalCosts_list->Recordset->moveNext();
}
?>
<?php
	if ($EngineeringAdditionalCosts_list->isGridAdd() || $EngineeringAdditionalCosts_list->isGridEdit()) {
		$EngineeringAdditionalCosts_list->RowIndex = '$rowindex$';
		$EngineeringAdditionalCosts_list->loadRowValues();

		// Set row properties
		$EngineeringAdditionalCosts->resetAttributes();
		$EngineeringAdditionalCosts->RowAttrs->merge(["data-rowindex" => $EngineeringAdditionalCosts_list->RowIndex, "id" => "r0_EngineeringAdditionalCosts", "data-rowtype" => ROWTYPE_ADD]);
		$EngineeringAdditionalCosts->RowAttrs->appendClass("ew-template");
		$EngineeringAdditionalCosts->RowType = ROWTYPE_ADD;

		// Render row
		$EngineeringAdditionalCosts_list->renderRow();

		// Render list options
		$EngineeringAdditionalCosts_list->renderListOptions();
		$EngineeringAdditionalCosts_list->StartRowCount = 0;
?>
	<tr <?php echo $EngineeringAdditionalCosts->rowAttributes() ?>>
<?php

// Render list options (body, left)
$EngineeringAdditionalCosts_list->ListOptions->render("body", "left", $EngineeringAdditionalCosts_list->RowIndex);
?>
	<?php if ($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->Visible) { // EngineeringAdditionalCost_Idn ?>
		<td data-name="EngineeringAdditionalCost_Idn">
<span id="el$rowindex$_EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn" class="form-group EngineeringAdditionalCosts_EngineeringAdditionalCost_Idn"></span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_EngineeringAdditionalCost_Idn" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_EngineeringAdditionalCost_Idn" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_EngineeringAdditionalCost_Idn" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->EngineeringAdditionalCost_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->LineNumber->Visible) { // LineNumber ?>
		<td data-name="LineNumber">
<span id="el$rowindex$_EngineeringAdditionalCosts_LineNumber" class="form-group EngineeringAdditionalCosts_LineNumber">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_LineNumber" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->LineNumber->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->LineNumber->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->LineNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_LineNumber" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_LineNumber" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->LineNumber->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity">
<span id="el$rowindex$_EngineeringAdditionalCosts_Quantity" class="form-group EngineeringAdditionalCosts_Quantity">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Quantity" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Quantity->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Quantity->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Quantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Quantity" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Quantity->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_EngineeringAdditionalCosts_Name" class="form-group EngineeringAdditionalCosts_Name">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Name" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Name->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Name->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Name" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->ManHours->Visible) { // ManHours ?>
		<td data-name="ManHours">
<span id="el$rowindex$_EngineeringAdditionalCosts_ManHours" class="form-group EngineeringAdditionalCosts_ManHours">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_ManHours" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->ManHours->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->ManHours->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->ManHours->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_ManHours" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_ManHours" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->ManHours->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_EngineeringAdditionalCosts_Rank" class="form-group EngineeringAdditionalCosts_Rank">
<input type="text" data-table="EngineeringAdditionalCosts" data-field="x_Rank" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Rank->getPlaceHolder()) ?>" value="<?php echo $EngineeringAdditionalCosts_list->Rank->EditValue ?>"<?php echo $EngineeringAdditionalCosts_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Rank" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->Parent_Idn->Visible) { // Parent_Idn ?>
		<td data-name="Parent_Idn">
<span id="el$rowindex$_EngineeringAdditionalCosts_Parent_Idn" class="form-group EngineeringAdditionalCosts_Parent_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="EngineeringAdditionalCosts" data-field="x_Parent_Idn" data-value-separator="<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn"<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->editAttributes() ?>>
			<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->selectOptionListHtml("x{$EngineeringAdditionalCosts_list->RowIndex}_Parent_Idn") ?>
		</select>
</div>
<?php echo $EngineeringAdditionalCosts_list->Parent_Idn->Lookup->getParamTag($EngineeringAdditionalCosts_list, "p_x" . $EngineeringAdditionalCosts_list->RowIndex . "_Parent_Idn") ?>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_Parent_Idn" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_Parent_Idn" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->Parent_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($EngineeringAdditionalCosts_list->DefaultFlag->Visible) { // DefaultFlag ?>
		<td data-name="DefaultFlag">
<span id="el$rowindex$_EngineeringAdditionalCosts_DefaultFlag" class="form-group EngineeringAdditionalCosts_DefaultFlag">
<?php
$selwrk = ConvertToBool($EngineeringAdditionalCosts_list->DefaultFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="EngineeringAdditionalCosts" data-field="x_DefaultFlag" name="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]" id="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]_589328" value="1"<?php echo $selwrk ?><?php echo $EngineeringAdditionalCosts_list->DefaultFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]_589328"></label>
</div>
</span>
<input type="hidden" data-table="EngineeringAdditionalCosts" data-field="x_DefaultFlag" name="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]" id="o<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>_DefaultFlag[]" value="<?php echo HtmlEncode($EngineeringAdditionalCosts_list->DefaultFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$EngineeringAdditionalCosts_list->ListOptions->render("body", "right", $EngineeringAdditionalCosts_list->RowIndex);
?>
<script>
loadjs.ready(["fEngineeringAdditionalCostslist", "load"], function() {
	fEngineeringAdditionalCostslist.updateLists(<?php echo $EngineeringAdditionalCosts_list->RowIndex ?>);
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
<?php if ($EngineeringAdditionalCosts_list->isAdd() || $EngineeringAdditionalCosts_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $EngineeringAdditionalCosts_list->FormKeyCountName ?>" id="<?php echo $EngineeringAdditionalCosts_list->FormKeyCountName ?>" value="<?php echo $EngineeringAdditionalCosts_list->KeyCount ?>">
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $EngineeringAdditionalCosts_list->FormKeyCountName ?>" id="<?php echo $EngineeringAdditionalCosts_list->FormKeyCountName ?>" value="<?php echo $EngineeringAdditionalCosts_list->KeyCount ?>">
<?php echo $EngineeringAdditionalCosts_list->MultiSelectKey ?>
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $EngineeringAdditionalCosts_list->FormKeyCountName ?>" id="<?php echo $EngineeringAdditionalCosts_list->FormKeyCountName ?>" value="<?php echo $EngineeringAdditionalCosts_list->KeyCount ?>">
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $EngineeringAdditionalCosts_list->FormKeyCountName ?>" id="<?php echo $EngineeringAdditionalCosts_list->FormKeyCountName ?>" value="<?php echo $EngineeringAdditionalCosts_list->KeyCount ?>">
<?php echo $EngineeringAdditionalCosts_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$EngineeringAdditionalCosts->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($EngineeringAdditionalCosts_list->Recordset)
	$EngineeringAdditionalCosts_list->Recordset->Close();
?>
<?php if (!$EngineeringAdditionalCosts_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$EngineeringAdditionalCosts_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $EngineeringAdditionalCosts_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $EngineeringAdditionalCosts_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($EngineeringAdditionalCosts_list->TotalRecords == 0 && !$EngineeringAdditionalCosts->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $EngineeringAdditionalCosts_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$EngineeringAdditionalCosts_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$EngineeringAdditionalCosts_list->isExport()) { ?>
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
$EngineeringAdditionalCosts_list->terminate();
?>