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
$AdjustmentSubFactors_list = new AdjustmentSubFactors_list();

// Run the page
$AdjustmentSubFactors_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AdjustmentSubFactors_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$AdjustmentSubFactors_list->isExport()) { ?>
<script>
var fAdjustmentSubFactorslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fAdjustmentSubFactorslist = currentForm = new ew.Form("fAdjustmentSubFactorslist", "list");
	fAdjustmentSubFactorslist.formKeyCountName = '<?php echo $AdjustmentSubFactors_list->FormKeyCountName ?>';

	// Validate form
	fAdjustmentSubFactorslist.validate = function() {
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
			<?php if ($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_AdjustmentSubFactor_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->caption(), $AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_list->AdjustmentFactor_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_AdjustmentFactor_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_list->AdjustmentFactor_Idn->caption(), $AdjustmentSubFactors_list->AdjustmentFactor_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_list->Name->caption(), $AdjustmentSubFactors_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_list->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_list->Value->caption(), $AdjustmentSubFactors_list->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($AdjustmentSubFactors_list->Value->errorMessage()) ?>");
			<?php if ($AdjustmentSubFactors_list->LaborClass_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LaborClass_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_list->LaborClass_Idn->caption(), $AdjustmentSubFactors_list->LaborClass_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_list->Rank->caption(), $AdjustmentSubFactors_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($AdjustmentSubFactors_list->Rank->errorMessage()) ?>");
			<?php if ($AdjustmentSubFactors_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_list->ActiveFlag->caption(), $AdjustmentSubFactors_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fAdjustmentSubFactorslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "AdjustmentFactor_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Value", false)) return false;
		if (ew.valueChanged(fobj, infix, "LaborClass_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fAdjustmentSubFactorslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fAdjustmentSubFactorslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fAdjustmentSubFactorslist.lists["x_AdjustmentFactor_Idn"] = <?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->Lookup->toClientList($AdjustmentSubFactors_list) ?>;
	fAdjustmentSubFactorslist.lists["x_AdjustmentFactor_Idn"].options = <?php echo JsonEncode($AdjustmentSubFactors_list->AdjustmentFactor_Idn->lookupOptions()) ?>;
	fAdjustmentSubFactorslist.lists["x_LaborClass_Idn"] = <?php echo $AdjustmentSubFactors_list->LaborClass_Idn->Lookup->toClientList($AdjustmentSubFactors_list) ?>;
	fAdjustmentSubFactorslist.lists["x_LaborClass_Idn"].options = <?php echo JsonEncode($AdjustmentSubFactors_list->LaborClass_Idn->lookupOptions()) ?>;
	fAdjustmentSubFactorslist.lists["x_ActiveFlag[]"] = <?php echo $AdjustmentSubFactors_list->ActiveFlag->Lookup->toClientList($AdjustmentSubFactors_list) ?>;
	fAdjustmentSubFactorslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($AdjustmentSubFactors_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fAdjustmentSubFactorslist");
});
var fAdjustmentSubFactorslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fAdjustmentSubFactorslistsrch = currentSearchForm = new ew.Form("fAdjustmentSubFactorslistsrch");

	// Dynamic selection lists
	// Filters

	fAdjustmentSubFactorslistsrch.filterList = <?php echo $AdjustmentSubFactors_list->getFilterList() ?>;
	loadjs.done("fAdjustmentSubFactorslistsrch");
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
<?php if (!$AdjustmentSubFactors_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($AdjustmentSubFactors_list->TotalRecords > 0 && $AdjustmentSubFactors_list->ExportOptions->visible()) { ?>
<?php $AdjustmentSubFactors_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_list->ImportOptions->visible()) { ?>
<?php $AdjustmentSubFactors_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_list->SearchOptions->visible()) { ?>
<?php $AdjustmentSubFactors_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_list->FilterOptions->visible()) { ?>
<?php $AdjustmentSubFactors_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$AdjustmentSubFactors_list->isExport() || Config("EXPORT_MASTER_RECORD") && $AdjustmentSubFactors_list->isExport("print")) { ?>
<?php
if ($AdjustmentSubFactors_list->DbMasterFilter != "" && $AdjustmentSubFactors->getCurrentMasterTable() == "AdjustmentFactors") {
	if ($AdjustmentSubFactors_list->MasterRecordExists) {
		include_once "AdjustmentFactorsmaster.php";
	}
}
?>
<?php } ?>
<?php
$AdjustmentSubFactors_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$AdjustmentSubFactors_list->isExport() && !$AdjustmentSubFactors->CurrentAction) { ?>
<form name="fAdjustmentSubFactorslistsrch" id="fAdjustmentSubFactorslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fAdjustmentSubFactorslistsrch-search-panel" class="<?php echo $AdjustmentSubFactors_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="AdjustmentSubFactors">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $AdjustmentSubFactors_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $AdjustmentSubFactors_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($AdjustmentSubFactors_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($AdjustmentSubFactors_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($AdjustmentSubFactors_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($AdjustmentSubFactors_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $AdjustmentSubFactors_list->showPageHeader(); ?>
<?php
$AdjustmentSubFactors_list->showMessage();
?>
<?php if ($AdjustmentSubFactors_list->TotalRecords > 0 || $AdjustmentSubFactors->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($AdjustmentSubFactors_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> AdjustmentSubFactors">
<?php if (!$AdjustmentSubFactors_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$AdjustmentSubFactors_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $AdjustmentSubFactors_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $AdjustmentSubFactors_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fAdjustmentSubFactorslist" id="fAdjustmentSubFactorslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AdjustmentSubFactors">
<?php if ($AdjustmentSubFactors->getCurrentMasterTable() == "AdjustmentFactors" && $AdjustmentSubFactors->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="AdjustmentFactors">
<input type="hidden" name="fk_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentFactor_Idn->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_AdjustmentSubFactors" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($AdjustmentSubFactors_list->TotalRecords > 0 || $AdjustmentSubFactors_list->isAdd() || $AdjustmentSubFactors_list->isCopy() || $AdjustmentSubFactors_list->isGridEdit()) { ?>
<table id="tbl_AdjustmentSubFactorslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$AdjustmentSubFactors->RowType = ROWTYPE_HEADER;

// Render list options
$AdjustmentSubFactors_list->renderListOptions();

// Render list options (header, left)
$AdjustmentSubFactors_list->ListOptions->render("header", "left");
?>
<?php if ($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
	<?php if ($AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn) == "") { ?>
		<th data-name="AdjustmentSubFactor_Idn" class="<?php echo $AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="AdjustmentSubFactors_AdjustmentSubFactor_Idn"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdjustmentSubFactor_Idn" class="<?php echo $AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn) ?>', 1);"><div id="elh_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="AdjustmentSubFactors_AdjustmentSubFactor_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
	<?php if ($AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->AdjustmentFactor_Idn) == "") { ?>
		<th data-name="AdjustmentFactor_Idn" class="<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_AdjustmentFactor_Idn" class="AdjustmentSubFactors_AdjustmentFactor_Idn"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdjustmentFactor_Idn" class="<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->AdjustmentFactor_Idn) ?>', 1);"><div id="elh_AdjustmentSubFactors_AdjustmentFactor_Idn" class="AdjustmentSubFactors_AdjustmentFactor_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_list->AdjustmentFactor_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_list->AdjustmentFactor_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_list->Name->Visible) { // Name ?>
	<?php if ($AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $AdjustmentSubFactors_list->Name->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_Name" class="AdjustmentSubFactors_Name"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $AdjustmentSubFactors_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->Name) ?>', 1);"><div id="elh_AdjustmentSubFactors_Name" class="AdjustmentSubFactors_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_list->Value->Visible) { // Value ?>
	<?php if ($AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->Value) == "") { ?>
		<th data-name="Value" class="<?php echo $AdjustmentSubFactors_list->Value->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_Value" class="AdjustmentSubFactors_Value"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->Value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Value" class="<?php echo $AdjustmentSubFactors_list->Value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->Value) ?>', 1);"><div id="elh_AdjustmentSubFactors_Value" class="AdjustmentSubFactors_Value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->Value->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_list->Value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_list->Value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_list->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
	<?php if ($AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->LaborClass_Idn) == "") { ?>
		<th data-name="LaborClass_Idn" class="<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_LaborClass_Idn" class="AdjustmentSubFactors_LaborClass_Idn"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->LaborClass_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LaborClass_Idn" class="<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->LaborClass_Idn) ?>', 1);"><div id="elh_AdjustmentSubFactors_LaborClass_Idn" class="AdjustmentSubFactors_LaborClass_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->LaborClass_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_list->LaborClass_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_list->LaborClass_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_list->Rank->Visible) { // Rank ?>
	<?php if ($AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $AdjustmentSubFactors_list->Rank->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_Rank" class="AdjustmentSubFactors_Rank"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $AdjustmentSubFactors_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->Rank) ?>', 1);"><div id="elh_AdjustmentSubFactors_Rank" class="AdjustmentSubFactors_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $AdjustmentSubFactors_list->ActiveFlag->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_ActiveFlag" class="AdjustmentSubFactors_ActiveFlag"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $AdjustmentSubFactors_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $AdjustmentSubFactors_list->SortUrl($AdjustmentSubFactors_list->ActiveFlag) ?>', 1);"><div id="elh_AdjustmentSubFactors_ActiveFlag" class="AdjustmentSubFactors_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$AdjustmentSubFactors_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($AdjustmentSubFactors_list->isAdd() || $AdjustmentSubFactors_list->isCopy()) {
		$AdjustmentSubFactors_list->RowIndex = 0;
		$AdjustmentSubFactors_list->KeyCount = $AdjustmentSubFactors_list->RowIndex;
		if ($AdjustmentSubFactors_list->isCopy() && !$AdjustmentSubFactors_list->loadRow())
			$AdjustmentSubFactors->CurrentAction = "add";
		if ($AdjustmentSubFactors_list->isAdd())
			$AdjustmentSubFactors_list->loadRowValues();
		if ($AdjustmentSubFactors->EventCancelled) // Insert failed
			$AdjustmentSubFactors_list->restoreFormValues(); // Restore form values

		// Set row properties
		$AdjustmentSubFactors->resetAttributes();
		$AdjustmentSubFactors->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_AdjustmentSubFactors", "data-rowtype" => ROWTYPE_ADD]);
		$AdjustmentSubFactors->RowType = ROWTYPE_ADD;

		// Render row
		$AdjustmentSubFactors_list->renderRow();

		// Render list options
		$AdjustmentSubFactors_list->renderListOptions();
		$AdjustmentSubFactors_list->StartRowCount = 0;
?>
	<tr <?php echo $AdjustmentSubFactors->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AdjustmentSubFactors_list->ListOptions->render("body", "left", $AdjustmentSubFactors_list->RowCount);
?>
	<?php if ($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
		<td data-name="AdjustmentSubFactor_Idn">
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="form-group AdjustmentSubFactors_AdjustmentSubFactor_Idn"></span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentSubFactor_Idn" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td data-name="AdjustmentFactor_Idn">
<?php if ($AdjustmentSubFactors_list->AdjustmentFactor_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group AdjustmentSubFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_list->AdjustmentFactor_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentFactor_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group AdjustmentSubFactors_AdjustmentFactor_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn"<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_list->RowIndex}_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->Lookup->getParamTag($AdjustmentSubFactors_list, "p_x" . $AdjustmentSubFactors_list->RowIndex . "_AdjustmentFactor_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentFactor_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Name" class="form-group AdjustmentSubFactors_Name">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Name" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Name->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Name" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Value" class="form-group AdjustmentSubFactors_Value">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Value" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Value->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Value->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Value" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
		<td data-name="LaborClass_Idn">
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_LaborClass_Idn" class="form-group AdjustmentSubFactors_LaborClass_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn"<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_list->RowIndex}_LaborClass_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->Lookup->getParamTag($AdjustmentSubFactors_list, "p_x" . $AdjustmentSubFactors_list->RowIndex . "_LaborClass_Idn") ?>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->LaborClass_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Rank" class="form-group AdjustmentSubFactors_Rank">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Rank" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Rank->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Rank" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_ActiveFlag" class="form-group AdjustmentSubFactors_ActiveFlag">
<?php
$selwrk = ConvertToBool($AdjustmentSubFactors_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]_477184" value="1"<?php echo $selwrk ?><?php echo $AdjustmentSubFactors_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]_477184"></label>
</div>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AdjustmentSubFactors_list->ListOptions->render("body", "right", $AdjustmentSubFactors_list->RowCount);
?>
<script>
loadjs.ready(["fAdjustmentSubFactorslist", "load"], function() {
	fAdjustmentSubFactorslist.updateLists(<?php echo $AdjustmentSubFactors_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($AdjustmentSubFactors_list->ExportAll && $AdjustmentSubFactors_list->isExport()) {
	$AdjustmentSubFactors_list->StopRecord = $AdjustmentSubFactors_list->TotalRecords;
} else {

	// Set the last record to display
	if ($AdjustmentSubFactors_list->TotalRecords > $AdjustmentSubFactors_list->StartRecord + $AdjustmentSubFactors_list->DisplayRecords - 1)
		$AdjustmentSubFactors_list->StopRecord = $AdjustmentSubFactors_list->StartRecord + $AdjustmentSubFactors_list->DisplayRecords - 1;
	else
		$AdjustmentSubFactors_list->StopRecord = $AdjustmentSubFactors_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($AdjustmentSubFactors->isConfirm() || $AdjustmentSubFactors_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($AdjustmentSubFactors_list->FormKeyCountName) && ($AdjustmentSubFactors_list->isGridAdd() || $AdjustmentSubFactors_list->isGridEdit() || $AdjustmentSubFactors->isConfirm())) {
		$AdjustmentSubFactors_list->KeyCount = $CurrentForm->getValue($AdjustmentSubFactors_list->FormKeyCountName);
		$AdjustmentSubFactors_list->StopRecord = $AdjustmentSubFactors_list->StartRecord + $AdjustmentSubFactors_list->KeyCount - 1;
	}
}
$AdjustmentSubFactors_list->RecordCount = $AdjustmentSubFactors_list->StartRecord - 1;
if ($AdjustmentSubFactors_list->Recordset && !$AdjustmentSubFactors_list->Recordset->EOF) {
	$AdjustmentSubFactors_list->Recordset->moveFirst();
	$selectLimit = $AdjustmentSubFactors_list->UseSelectLimit;
	if (!$selectLimit && $AdjustmentSubFactors_list->StartRecord > 1)
		$AdjustmentSubFactors_list->Recordset->move($AdjustmentSubFactors_list->StartRecord - 1);
} elseif (!$AdjustmentSubFactors->AllowAddDeleteRow && $AdjustmentSubFactors_list->StopRecord == 0) {
	$AdjustmentSubFactors_list->StopRecord = $AdjustmentSubFactors->GridAddRowCount;
}

// Initialize aggregate
$AdjustmentSubFactors->RowType = ROWTYPE_AGGREGATEINIT;
$AdjustmentSubFactors->resetAttributes();
$AdjustmentSubFactors_list->renderRow();
$AdjustmentSubFactors_list->EditRowCount = 0;
if ($AdjustmentSubFactors_list->isEdit())
	$AdjustmentSubFactors_list->RowIndex = 1;
if ($AdjustmentSubFactors_list->isGridAdd())
	$AdjustmentSubFactors_list->RowIndex = 0;
if ($AdjustmentSubFactors_list->isGridEdit())
	$AdjustmentSubFactors_list->RowIndex = 0;
while ($AdjustmentSubFactors_list->RecordCount < $AdjustmentSubFactors_list->StopRecord) {
	$AdjustmentSubFactors_list->RecordCount++;
	if ($AdjustmentSubFactors_list->RecordCount >= $AdjustmentSubFactors_list->StartRecord) {
		$AdjustmentSubFactors_list->RowCount++;
		if ($AdjustmentSubFactors_list->isGridAdd() || $AdjustmentSubFactors_list->isGridEdit() || $AdjustmentSubFactors->isConfirm()) {
			$AdjustmentSubFactors_list->RowIndex++;
			$CurrentForm->Index = $AdjustmentSubFactors_list->RowIndex;
			if ($CurrentForm->hasValue($AdjustmentSubFactors_list->FormActionName) && ($AdjustmentSubFactors->isConfirm() || $AdjustmentSubFactors_list->EventCancelled))
				$AdjustmentSubFactors_list->RowAction = strval($CurrentForm->getValue($AdjustmentSubFactors_list->FormActionName));
			elseif ($AdjustmentSubFactors_list->isGridAdd())
				$AdjustmentSubFactors_list->RowAction = "insert";
			else
				$AdjustmentSubFactors_list->RowAction = "";
		}

		// Set up key count
		$AdjustmentSubFactors_list->KeyCount = $AdjustmentSubFactors_list->RowIndex;

		// Init row class and style
		$AdjustmentSubFactors->resetAttributes();
		$AdjustmentSubFactors->CssClass = "";
		if ($AdjustmentSubFactors_list->isGridAdd()) {
			$AdjustmentSubFactors_list->loadRowValues(); // Load default values
		} else {
			$AdjustmentSubFactors_list->loadRowValues($AdjustmentSubFactors_list->Recordset); // Load row values
		}
		$AdjustmentSubFactors->RowType = ROWTYPE_VIEW; // Render view
		if ($AdjustmentSubFactors_list->isGridAdd()) // Grid add
			$AdjustmentSubFactors->RowType = ROWTYPE_ADD; // Render add
		if ($AdjustmentSubFactors_list->isGridAdd() && $AdjustmentSubFactors->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$AdjustmentSubFactors_list->restoreCurrentRowFormValues($AdjustmentSubFactors_list->RowIndex); // Restore form values
		if ($AdjustmentSubFactors_list->isEdit()) {
			if ($AdjustmentSubFactors_list->checkInlineEditKey() && $AdjustmentSubFactors_list->EditRowCount == 0) { // Inline edit
				$AdjustmentSubFactors->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($AdjustmentSubFactors_list->isGridEdit()) { // Grid edit
			if ($AdjustmentSubFactors->EventCancelled)
				$AdjustmentSubFactors_list->restoreCurrentRowFormValues($AdjustmentSubFactors_list->RowIndex); // Restore form values
			if ($AdjustmentSubFactors_list->RowAction == "insert")
				$AdjustmentSubFactors->RowType = ROWTYPE_ADD; // Render add
			else
				$AdjustmentSubFactors->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($AdjustmentSubFactors_list->isEdit() && $AdjustmentSubFactors->RowType == ROWTYPE_EDIT && $AdjustmentSubFactors->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$AdjustmentSubFactors_list->restoreFormValues(); // Restore form values
		}
		if ($AdjustmentSubFactors_list->isGridEdit() && ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT || $AdjustmentSubFactors->RowType == ROWTYPE_ADD) && $AdjustmentSubFactors->EventCancelled) // Update failed
			$AdjustmentSubFactors_list->restoreCurrentRowFormValues($AdjustmentSubFactors_list->RowIndex); // Restore form values
		if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) // Edit row
			$AdjustmentSubFactors_list->EditRowCount++;

		// Set up row id / data-rowindex
		$AdjustmentSubFactors->RowAttrs->merge(["data-rowindex" => $AdjustmentSubFactors_list->RowCount, "id" => "r" . $AdjustmentSubFactors_list->RowCount . "_AdjustmentSubFactors", "data-rowtype" => $AdjustmentSubFactors->RowType]);

		// Render row
		$AdjustmentSubFactors_list->renderRow();

		// Render list options
		$AdjustmentSubFactors_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($AdjustmentSubFactors_list->RowAction != "delete" && $AdjustmentSubFactors_list->RowAction != "insertdelete" && !($AdjustmentSubFactors_list->RowAction == "insert" && $AdjustmentSubFactors->isConfirm() && $AdjustmentSubFactors_list->emptyRow())) {
?>
	<tr <?php echo $AdjustmentSubFactors->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AdjustmentSubFactors_list->ListOptions->render("body", "left", $AdjustmentSubFactors_list->RowCount);
?>
	<?php if ($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
		<td data-name="AdjustmentSubFactor_Idn" <?php echo $AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="form-group"></span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentSubFactor_Idn" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="form-group">
<span<?php echo $AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentSubFactor_Idn" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_AdjustmentSubFactor_Idn">
<span<?php echo $AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td data-name="AdjustmentFactor_Idn" <?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($AdjustmentSubFactors_list->AdjustmentFactor_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group">
<span<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_list->AdjustmentFactor_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentFactor_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn"<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_list->RowIndex}_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->Lookup->getParamTag($AdjustmentSubFactors_list, "p_x" . $AdjustmentSubFactors_list->RowIndex . "_AdjustmentFactor_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentFactor_Idn->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($AdjustmentSubFactors_list->AdjustmentFactor_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group">
<span<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_list->AdjustmentFactor_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentFactor_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn"<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_list->RowIndex}_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->Lookup->getParamTag($AdjustmentSubFactors_list, "p_x" . $AdjustmentSubFactors_list->RowIndex . "_AdjustmentFactor_Idn") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $AdjustmentSubFactors_list->Name->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Name" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Name" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Name->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Name" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Name" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Name" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Name->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Name">
<span<?php echo $AdjustmentSubFactors_list->Name->viewAttributes() ?>><?php echo $AdjustmentSubFactors_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->Value->Visible) { // Value ?>
		<td data-name="Value" <?php echo $AdjustmentSubFactors_list->Value->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Value" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Value" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Value->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Value->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Value" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->Value->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Value" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Value" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Value->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Value->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Value->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Value">
<span<?php echo $AdjustmentSubFactors_list->Value->viewAttributes() ?>><?php echo $AdjustmentSubFactors_list->Value->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
		<td data-name="LaborClass_Idn" <?php echo $AdjustmentSubFactors_list->LaborClass_Idn->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_LaborClass_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn"<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_list->RowIndex}_LaborClass_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->Lookup->getParamTag($AdjustmentSubFactors_list, "p_x" . $AdjustmentSubFactors_list->RowIndex . "_LaborClass_Idn") ?>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->LaborClass_Idn->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_LaborClass_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn"<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_list->RowIndex}_LaborClass_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->Lookup->getParamTag($AdjustmentSubFactors_list, "p_x" . $AdjustmentSubFactors_list->RowIndex . "_LaborClass_Idn") ?>
</span>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_LaborClass_Idn">
<span<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_list->LaborClass_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $AdjustmentSubFactors_list->Rank->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Rank" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Rank" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Rank->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Rank" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Rank" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Rank" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Rank->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_Rank">
<span<?php echo $AdjustmentSubFactors_list->Rank->viewAttributes() ?>><?php echo $AdjustmentSubFactors_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $AdjustmentSubFactors_list->ActiveFlag->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($AdjustmentSubFactors_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]_623524" value="1"<?php echo $selwrk ?><?php echo $AdjustmentSubFactors_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]_623524"></label>
</div>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($AdjustmentSubFactors_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]_952291" value="1"<?php echo $selwrk ?><?php echo $AdjustmentSubFactors_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]_952291"></label>
</div>
</span>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_list->RowCount ?>_AdjustmentSubFactors_ActiveFlag">
<span<?php echo $AdjustmentSubFactors_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $AdjustmentSubFactors_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($AdjustmentSubFactors_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AdjustmentSubFactors_list->ListOptions->render("body", "right", $AdjustmentSubFactors_list->RowCount);
?>
	</tr>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD || $AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fAdjustmentSubFactorslist", "load"], function() {
	fAdjustmentSubFactorslist.updateLists(<?php echo $AdjustmentSubFactors_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$AdjustmentSubFactors_list->isGridAdd())
		if (!$AdjustmentSubFactors_list->Recordset->EOF)
			$AdjustmentSubFactors_list->Recordset->moveNext();
}
?>
<?php
	if ($AdjustmentSubFactors_list->isGridAdd() || $AdjustmentSubFactors_list->isGridEdit()) {
		$AdjustmentSubFactors_list->RowIndex = '$rowindex$';
		$AdjustmentSubFactors_list->loadRowValues();

		// Set row properties
		$AdjustmentSubFactors->resetAttributes();
		$AdjustmentSubFactors->RowAttrs->merge(["data-rowindex" => $AdjustmentSubFactors_list->RowIndex, "id" => "r0_AdjustmentSubFactors", "data-rowtype" => ROWTYPE_ADD]);
		$AdjustmentSubFactors->RowAttrs->appendClass("ew-template");
		$AdjustmentSubFactors->RowType = ROWTYPE_ADD;

		// Render row
		$AdjustmentSubFactors_list->renderRow();

		// Render list options
		$AdjustmentSubFactors_list->renderListOptions();
		$AdjustmentSubFactors_list->StartRowCount = 0;
?>
	<tr <?php echo $AdjustmentSubFactors->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AdjustmentSubFactors_list->ListOptions->render("body", "left", $AdjustmentSubFactors_list->RowIndex);
?>
	<?php if ($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
		<td data-name="AdjustmentSubFactor_Idn">
<span id="el$rowindex$_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="form-group AdjustmentSubFactors_AdjustmentSubFactor_Idn"></span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentSubFactor_Idn" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentSubFactor_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td data-name="AdjustmentFactor_Idn">
<?php if ($AdjustmentSubFactors_list->AdjustmentFactor_Idn->getSessionValue() != "") { ?>
<span id="el$rowindex$_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group AdjustmentSubFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_list->AdjustmentFactor_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentFactor_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group AdjustmentSubFactors_AdjustmentFactor_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn"<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_list->RowIndex}_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_list->AdjustmentFactor_Idn->Lookup->getParamTag($AdjustmentSubFactors_list, "p_x" . $AdjustmentSubFactors_list->RowIndex . "_AdjustmentFactor_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->AdjustmentFactor_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_AdjustmentSubFactors_Name" class="form-group AdjustmentSubFactors_Name">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Name" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Name->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Name" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el$rowindex$_AdjustmentSubFactors_Value" class="form-group AdjustmentSubFactors_Value">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Value" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Value->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Value->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Value" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
		<td data-name="LaborClass_Idn">
<span id="el$rowindex$_AdjustmentSubFactors_LaborClass_Idn" class="form-group AdjustmentSubFactors_LaborClass_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn"<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_list->RowIndex}_LaborClass_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_list->LaborClass_Idn->Lookup->getParamTag($AdjustmentSubFactors_list, "p_x" . $AdjustmentSubFactors_list->RowIndex . "_LaborClass_Idn") ?>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_LaborClass_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->LaborClass_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_AdjustmentSubFactors_Rank" class="form-group AdjustmentSubFactors_Rank">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Rank" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_list->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_list->Rank->EditValue ?>"<?php echo $AdjustmentSubFactors_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Rank" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_AdjustmentSubFactors_ActiveFlag" class="form-group AdjustmentSubFactors_ActiveFlag">
<?php
$selwrk = ConvertToBool($AdjustmentSubFactors_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]_764529" value="1"<?php echo $selwrk ?><?php echo $AdjustmentSubFactors_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]_764529"></label>
</div>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $AdjustmentSubFactors_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($AdjustmentSubFactors_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AdjustmentSubFactors_list->ListOptions->render("body", "right", $AdjustmentSubFactors_list->RowIndex);
?>
<script>
loadjs.ready(["fAdjustmentSubFactorslist", "load"], function() {
	fAdjustmentSubFactorslist.updateLists(<?php echo $AdjustmentSubFactors_list->RowIndex ?>);
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
<?php if ($AdjustmentSubFactors_list->isAdd() || $AdjustmentSubFactors_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $AdjustmentSubFactors_list->FormKeyCountName ?>" id="<?php echo $AdjustmentSubFactors_list->FormKeyCountName ?>" value="<?php echo $AdjustmentSubFactors_list->KeyCount ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $AdjustmentSubFactors_list->FormKeyCountName ?>" id="<?php echo $AdjustmentSubFactors_list->FormKeyCountName ?>" value="<?php echo $AdjustmentSubFactors_list->KeyCount ?>">
<?php echo $AdjustmentSubFactors_list->MultiSelectKey ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $AdjustmentSubFactors_list->FormKeyCountName ?>" id="<?php echo $AdjustmentSubFactors_list->FormKeyCountName ?>" value="<?php echo $AdjustmentSubFactors_list->KeyCount ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $AdjustmentSubFactors_list->FormKeyCountName ?>" id="<?php echo $AdjustmentSubFactors_list->FormKeyCountName ?>" value="<?php echo $AdjustmentSubFactors_list->KeyCount ?>">
<?php echo $AdjustmentSubFactors_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$AdjustmentSubFactors->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($AdjustmentSubFactors_list->Recordset)
	$AdjustmentSubFactors_list->Recordset->Close();
?>
<?php if (!$AdjustmentSubFactors_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$AdjustmentSubFactors_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $AdjustmentSubFactors_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $AdjustmentSubFactors_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($AdjustmentSubFactors_list->TotalRecords == 0 && !$AdjustmentSubFactors->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $AdjustmentSubFactors_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$AdjustmentSubFactors_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$AdjustmentSubFactors_list->isExport()) { ?>
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
$AdjustmentSubFactors_list->terminate();
?>