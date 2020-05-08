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
$JobDefaults_list = new JobDefaults_list();

// Run the page
$JobDefaults_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobDefaults_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$JobDefaults_list->isExport()) { ?>
<script>
var fJobDefaultslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fJobDefaultslist = currentForm = new ew.Form("fJobDefaultslist", "list");
	fJobDefaultslist.formKeyCountName = '<?php echo $JobDefaults_list->FormKeyCountName ?>';

	// Validate form
	fJobDefaultslist.validate = function() {
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
			<?php if ($JobDefaults_list->JobDefault_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_JobDefault_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_list->JobDefault_Idn->caption(), $JobDefaults_list->JobDefault_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_list->JobDefaultType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_JobDefaultType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_list->JobDefaultType_Idn->caption(), $JobDefaults_list->JobDefaultType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_list->Department_Idn->caption(), $JobDefaults_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_list->ParentJobDefault_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ParentJobDefault_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_list->ParentJobDefault_Idn->caption(), $JobDefaults_list->ParentJobDefault_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ParentJobDefault_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobDefaults_list->ParentJobDefault_Idn->errorMessage()) ?>");
			<?php if ($JobDefaults_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_list->Name->caption(), $JobDefaults_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_list->NumericValue->Required) { ?>
				elm = this.getElements("x" + infix + "_NumericValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_list->NumericValue->caption(), $JobDefaults_list->NumericValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NumericValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobDefaults_list->NumericValue->errorMessage()) ?>");
			<?php if ($JobDefaults_list->AlphaValue->Required) { ?>
				elm = this.getElements("x" + infix + "_AlphaValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_list->AlphaValue->caption(), $JobDefaults_list->AlphaValue->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_list->LoadFromJobDefault_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LoadFromJobDefault_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_list->LoadFromJobDefault_Idn->caption(), $JobDefaults_list->LoadFromJobDefault_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($JobDefaults_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_list->Rank->caption(), $JobDefaults_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($JobDefaults_list->Rank->errorMessage()) ?>");
			<?php if ($JobDefaults_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobDefaults_list->ActiveFlag->caption(), $JobDefaults_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fJobDefaultslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "JobDefaultType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ParentJobDefault_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "NumericValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "AlphaValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "LoadFromJobDefault_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fJobDefaultslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fJobDefaultslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fJobDefaultslist.lists["x_JobDefaultType_Idn"] = <?php echo $JobDefaults_list->JobDefaultType_Idn->Lookup->toClientList($JobDefaults_list) ?>;
	fJobDefaultslist.lists["x_JobDefaultType_Idn"].options = <?php echo JsonEncode($JobDefaults_list->JobDefaultType_Idn->lookupOptions()) ?>;
	fJobDefaultslist.lists["x_Department_Idn"] = <?php echo $JobDefaults_list->Department_Idn->Lookup->toClientList($JobDefaults_list) ?>;
	fJobDefaultslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($JobDefaults_list->Department_Idn->lookupOptions()) ?>;
	fJobDefaultslist.lists["x_LoadFromJobDefault_Idn"] = <?php echo $JobDefaults_list->LoadFromJobDefault_Idn->Lookup->toClientList($JobDefaults_list) ?>;
	fJobDefaultslist.lists["x_LoadFromJobDefault_Idn"].options = <?php echo JsonEncode($JobDefaults_list->LoadFromJobDefault_Idn->lookupOptions()) ?>;
	fJobDefaultslist.lists["x_ActiveFlag[]"] = <?php echo $JobDefaults_list->ActiveFlag->Lookup->toClientList($JobDefaults_list) ?>;
	fJobDefaultslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($JobDefaults_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fJobDefaultslist");
});
var fJobDefaultslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fJobDefaultslistsrch = currentSearchForm = new ew.Form("fJobDefaultslistsrch");

	// Dynamic selection lists
	// Filters

	fJobDefaultslistsrch.filterList = <?php echo $JobDefaults_list->getFilterList() ?>;
	loadjs.done("fJobDefaultslistsrch");
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
<?php if (!$JobDefaults_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($JobDefaults_list->TotalRecords > 0 && $JobDefaults_list->ExportOptions->visible()) { ?>
<?php $JobDefaults_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($JobDefaults_list->ImportOptions->visible()) { ?>
<?php $JobDefaults_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($JobDefaults_list->SearchOptions->visible()) { ?>
<?php $JobDefaults_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($JobDefaults_list->FilterOptions->visible()) { ?>
<?php $JobDefaults_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$JobDefaults_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$JobDefaults_list->isExport() && !$JobDefaults->CurrentAction) { ?>
<form name="fJobDefaultslistsrch" id="fJobDefaultslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fJobDefaultslistsrch-search-panel" class="<?php echo $JobDefaults_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="JobDefaults">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $JobDefaults_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($JobDefaults_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($JobDefaults_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $JobDefaults_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($JobDefaults_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($JobDefaults_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($JobDefaults_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($JobDefaults_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $JobDefaults_list->showPageHeader(); ?>
<?php
$JobDefaults_list->showMessage();
?>
<?php if ($JobDefaults_list->TotalRecords > 0 || $JobDefaults->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($JobDefaults_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> JobDefaults">
<?php if (!$JobDefaults_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$JobDefaults_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobDefaults_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $JobDefaults_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fJobDefaultslist" id="fJobDefaultslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobDefaults">
<div id="gmp_JobDefaults" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($JobDefaults_list->TotalRecords > 0 || $JobDefaults_list->isAdd() || $JobDefaults_list->isCopy() || $JobDefaults_list->isGridEdit()) { ?>
<table id="tbl_JobDefaultslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$JobDefaults->RowType = ROWTYPE_HEADER;

// Render list options
$JobDefaults_list->renderListOptions();

// Render list options (header, left)
$JobDefaults_list->ListOptions->render("header", "left");
?>
<?php if ($JobDefaults_list->JobDefault_Idn->Visible) { // JobDefault_Idn ?>
	<?php if ($JobDefaults_list->SortUrl($JobDefaults_list->JobDefault_Idn) == "") { ?>
		<th data-name="JobDefault_Idn" class="<?php echo $JobDefaults_list->JobDefault_Idn->headerCellClass() ?>"><div id="elh_JobDefaults_JobDefault_Idn" class="JobDefaults_JobDefault_Idn"><div class="ew-table-header-caption"><?php echo $JobDefaults_list->JobDefault_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobDefault_Idn" class="<?php echo $JobDefaults_list->JobDefault_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaults_list->SortUrl($JobDefaults_list->JobDefault_Idn) ?>', 1);"><div id="elh_JobDefaults_JobDefault_Idn" class="JobDefaults_JobDefault_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaults_list->JobDefault_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobDefaults_list->JobDefault_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaults_list->JobDefault_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaults_list->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
	<?php if ($JobDefaults_list->SortUrl($JobDefaults_list->JobDefaultType_Idn) == "") { ?>
		<th data-name="JobDefaultType_Idn" class="<?php echo $JobDefaults_list->JobDefaultType_Idn->headerCellClass() ?>"><div id="elh_JobDefaults_JobDefaultType_Idn" class="JobDefaults_JobDefaultType_Idn"><div class="ew-table-header-caption"><?php echo $JobDefaults_list->JobDefaultType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobDefaultType_Idn" class="<?php echo $JobDefaults_list->JobDefaultType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaults_list->SortUrl($JobDefaults_list->JobDefaultType_Idn) ?>', 1);"><div id="elh_JobDefaults_JobDefaultType_Idn" class="JobDefaults_JobDefaultType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaults_list->JobDefaultType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobDefaults_list->JobDefaultType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaults_list->JobDefaultType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaults_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($JobDefaults_list->SortUrl($JobDefaults_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $JobDefaults_list->Department_Idn->headerCellClass() ?>"><div id="elh_JobDefaults_Department_Idn" class="JobDefaults_Department_Idn"><div class="ew-table-header-caption"><?php echo $JobDefaults_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $JobDefaults_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaults_list->SortUrl($JobDefaults_list->Department_Idn) ?>', 1);"><div id="elh_JobDefaults_Department_Idn" class="JobDefaults_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaults_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobDefaults_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaults_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaults_list->ParentJobDefault_Idn->Visible) { // ParentJobDefault_Idn ?>
	<?php if ($JobDefaults_list->SortUrl($JobDefaults_list->ParentJobDefault_Idn) == "") { ?>
		<th data-name="ParentJobDefault_Idn" class="<?php echo $JobDefaults_list->ParentJobDefault_Idn->headerCellClass() ?>"><div id="elh_JobDefaults_ParentJobDefault_Idn" class="JobDefaults_ParentJobDefault_Idn"><div class="ew-table-header-caption"><?php echo $JobDefaults_list->ParentJobDefault_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ParentJobDefault_Idn" class="<?php echo $JobDefaults_list->ParentJobDefault_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaults_list->SortUrl($JobDefaults_list->ParentJobDefault_Idn) ?>', 1);"><div id="elh_JobDefaults_ParentJobDefault_Idn" class="JobDefaults_ParentJobDefault_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaults_list->ParentJobDefault_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobDefaults_list->ParentJobDefault_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaults_list->ParentJobDefault_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaults_list->Name->Visible) { // Name ?>
	<?php if ($JobDefaults_list->SortUrl($JobDefaults_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $JobDefaults_list->Name->headerCellClass() ?>"><div id="elh_JobDefaults_Name" class="JobDefaults_Name"><div class="ew-table-header-caption"><?php echo $JobDefaults_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $JobDefaults_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaults_list->SortUrl($JobDefaults_list->Name) ?>', 1);"><div id="elh_JobDefaults_Name" class="JobDefaults_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaults_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($JobDefaults_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaults_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaults_list->NumericValue->Visible) { // NumericValue ?>
	<?php if ($JobDefaults_list->SortUrl($JobDefaults_list->NumericValue) == "") { ?>
		<th data-name="NumericValue" class="<?php echo $JobDefaults_list->NumericValue->headerCellClass() ?>"><div id="elh_JobDefaults_NumericValue" class="JobDefaults_NumericValue"><div class="ew-table-header-caption"><?php echo $JobDefaults_list->NumericValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NumericValue" class="<?php echo $JobDefaults_list->NumericValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaults_list->SortUrl($JobDefaults_list->NumericValue) ?>', 1);"><div id="elh_JobDefaults_NumericValue" class="JobDefaults_NumericValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaults_list->NumericValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobDefaults_list->NumericValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaults_list->NumericValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaults_list->AlphaValue->Visible) { // AlphaValue ?>
	<?php if ($JobDefaults_list->SortUrl($JobDefaults_list->AlphaValue) == "") { ?>
		<th data-name="AlphaValue" class="<?php echo $JobDefaults_list->AlphaValue->headerCellClass() ?>"><div id="elh_JobDefaults_AlphaValue" class="JobDefaults_AlphaValue"><div class="ew-table-header-caption"><?php echo $JobDefaults_list->AlphaValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AlphaValue" class="<?php echo $JobDefaults_list->AlphaValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaults_list->SortUrl($JobDefaults_list->AlphaValue) ?>', 1);"><div id="elh_JobDefaults_AlphaValue" class="JobDefaults_AlphaValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaults_list->AlphaValue->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($JobDefaults_list->AlphaValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaults_list->AlphaValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaults_list->LoadFromJobDefault_Idn->Visible) { // LoadFromJobDefault_Idn ?>
	<?php if ($JobDefaults_list->SortUrl($JobDefaults_list->LoadFromJobDefault_Idn) == "") { ?>
		<th data-name="LoadFromJobDefault_Idn" class="<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->headerCellClass() ?>"><div id="elh_JobDefaults_LoadFromJobDefault_Idn" class="JobDefaults_LoadFromJobDefault_Idn"><div class="ew-table-header-caption"><?php echo $JobDefaults_list->LoadFromJobDefault_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LoadFromJobDefault_Idn" class="<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaults_list->SortUrl($JobDefaults_list->LoadFromJobDefault_Idn) ?>', 1);"><div id="elh_JobDefaults_LoadFromJobDefault_Idn" class="JobDefaults_LoadFromJobDefault_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaults_list->LoadFromJobDefault_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobDefaults_list->LoadFromJobDefault_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaults_list->LoadFromJobDefault_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaults_list->Rank->Visible) { // Rank ?>
	<?php if ($JobDefaults_list->SortUrl($JobDefaults_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $JobDefaults_list->Rank->headerCellClass() ?>"><div id="elh_JobDefaults_Rank" class="JobDefaults_Rank"><div class="ew-table-header-caption"><?php echo $JobDefaults_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $JobDefaults_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaults_list->SortUrl($JobDefaults_list->Rank) ?>', 1);"><div id="elh_JobDefaults_Rank" class="JobDefaults_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaults_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobDefaults_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaults_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobDefaults_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($JobDefaults_list->SortUrl($JobDefaults_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $JobDefaults_list->ActiveFlag->headerCellClass() ?>"><div id="elh_JobDefaults_ActiveFlag" class="JobDefaults_ActiveFlag"><div class="ew-table-header-caption"><?php echo $JobDefaults_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $JobDefaults_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $JobDefaults_list->SortUrl($JobDefaults_list->ActiveFlag) ?>', 1);"><div id="elh_JobDefaults_ActiveFlag" class="JobDefaults_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobDefaults_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobDefaults_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($JobDefaults_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$JobDefaults_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($JobDefaults_list->isAdd() || $JobDefaults_list->isCopy()) {
		$JobDefaults_list->RowIndex = 0;
		$JobDefaults_list->KeyCount = $JobDefaults_list->RowIndex;
		if ($JobDefaults_list->isCopy() && !$JobDefaults_list->loadRow())
			$JobDefaults->CurrentAction = "add";
		if ($JobDefaults_list->isAdd())
			$JobDefaults_list->loadRowValues();
		if ($JobDefaults->EventCancelled) // Insert failed
			$JobDefaults_list->restoreFormValues(); // Restore form values

		// Set row properties
		$JobDefaults->resetAttributes();
		$JobDefaults->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_JobDefaults", "data-rowtype" => ROWTYPE_ADD]);
		$JobDefaults->RowType = ROWTYPE_ADD;

		// Render row
		$JobDefaults_list->renderRow();

		// Render list options
		$JobDefaults_list->renderListOptions();
		$JobDefaults_list->StartRowCount = 0;
?>
	<tr <?php echo $JobDefaults->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobDefaults_list->ListOptions->render("body", "left", $JobDefaults_list->RowCount);
?>
	<?php if ($JobDefaults_list->JobDefault_Idn->Visible) { // JobDefault_Idn ?>
		<td data-name="JobDefault_Idn">
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_JobDefault_Idn" class="form-group JobDefaults_JobDefault_Idn"></span>
<input type="hidden" data-table="JobDefaults" data-field="x_JobDefault_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefault_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefault_Idn" value="<?php echo HtmlEncode($JobDefaults_list->JobDefault_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
		<td data-name="JobDefaultType_Idn">
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_JobDefaultType_Idn" class="form-group JobDefaults_JobDefaultType_Idn">
<?php $JobDefaults_list->JobDefaultType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_JobDefaultType_Idn" data-value-separator="<?php echo $JobDefaults_list->JobDefaultType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn"<?php echo $JobDefaults_list->JobDefaultType_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->JobDefaultType_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_JobDefaultType_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->JobDefaultType_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_JobDefaultType_Idn") ?>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_JobDefaultType_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn" value="<?php echo HtmlEncode($JobDefaults_list->JobDefaultType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Department_Idn" class="form-group JobDefaults_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_Department_Idn" data-value-separator="<?php echo $JobDefaults_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn"<?php echo $JobDefaults_list->Department_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->Department_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->Department_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_Department_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($JobDefaults_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->ParentJobDefault_Idn->Visible) { // ParentJobDefault_Idn ?>
		<td data-name="ParentJobDefault_Idn">
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_ParentJobDefault_Idn" class="form-group JobDefaults_ParentJobDefault_Idn">
<input type="text" data-table="JobDefaults" data-field="x_ParentJobDefault_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" id="x<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_list->ParentJobDefault_Idn->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->ParentJobDefault_Idn->EditValue ?>"<?php echo $JobDefaults_list->ParentJobDefault_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_ParentJobDefault_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" value="<?php echo HtmlEncode($JobDefaults_list->ParentJobDefault_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Name" class="form-group JobDefaults_Name">
<input type="text" data-table="JobDefaults" data-field="x_Name" name="x<?php echo $JobDefaults_list->RowIndex ?>_Name" id="x<?php echo $JobDefaults_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobDefaults_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->Name->EditValue ?>"<?php echo $JobDefaults_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_Name" name="o<?php echo $JobDefaults_list->RowIndex ?>_Name" id="o<?php echo $JobDefaults_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobDefaults_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->NumericValue->Visible) { // NumericValue ?>
		<td data-name="NumericValue">
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_NumericValue" class="form-group JobDefaults_NumericValue">
<input type="text" data-table="JobDefaults" data-field="x_NumericValue" name="x<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" id="x<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($JobDefaults_list->NumericValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->NumericValue->EditValue ?>"<?php echo $JobDefaults_list->NumericValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_NumericValue" name="o<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" id="o<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" value="<?php echo HtmlEncode($JobDefaults_list->NumericValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->AlphaValue->Visible) { // AlphaValue ?>
		<td data-name="AlphaValue">
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_AlphaValue" class="form-group JobDefaults_AlphaValue">
<input type="text" data-table="JobDefaults" data-field="x_AlphaValue" name="x<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" id="x<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($JobDefaults_list->AlphaValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->AlphaValue->EditValue ?>"<?php echo $JobDefaults_list->AlphaValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_AlphaValue" name="o<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" id="o<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" value="<?php echo HtmlEncode($JobDefaults_list->AlphaValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->LoadFromJobDefault_Idn->Visible) { // LoadFromJobDefault_Idn ?>
		<td data-name="LoadFromJobDefault_Idn">
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_LoadFromJobDefault_Idn" class="form-group JobDefaults_LoadFromJobDefault_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_LoadFromJobDefault_Idn" data-value-separator="<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn"<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_LoadFromJobDefault_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_LoadFromJobDefault_Idn") ?>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_LoadFromJobDefault_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn" value="<?php echo HtmlEncode($JobDefaults_list->LoadFromJobDefault_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Rank" class="form-group JobDefaults_Rank">
<input type="text" data-table="JobDefaults" data-field="x_Rank" name="x<?php echo $JobDefaults_list->RowIndex ?>_Rank" id="x<?php echo $JobDefaults_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->Rank->EditValue ?>"<?php echo $JobDefaults_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_Rank" name="o<?php echo $JobDefaults_list->RowIndex ?>_Rank" id="o<?php echo $JobDefaults_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobDefaults_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_ActiveFlag" class="form-group JobDefaults_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobDefaults_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobDefaults" data-field="x_ActiveFlag" name="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]_463872" value="1"<?php echo $selwrk ?><?php echo $JobDefaults_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]_463872"></label>
</div>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_ActiveFlag" name="o<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobDefaults_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobDefaults_list->ListOptions->render("body", "right", $JobDefaults_list->RowCount);
?>
<script>
loadjs.ready(["fJobDefaultslist", "load"], function() {
	fJobDefaultslist.updateLists(<?php echo $JobDefaults_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($JobDefaults_list->ExportAll && $JobDefaults_list->isExport()) {
	$JobDefaults_list->StopRecord = $JobDefaults_list->TotalRecords;
} else {

	// Set the last record to display
	if ($JobDefaults_list->TotalRecords > $JobDefaults_list->StartRecord + $JobDefaults_list->DisplayRecords - 1)
		$JobDefaults_list->StopRecord = $JobDefaults_list->StartRecord + $JobDefaults_list->DisplayRecords - 1;
	else
		$JobDefaults_list->StopRecord = $JobDefaults_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($JobDefaults->isConfirm() || $JobDefaults_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($JobDefaults_list->FormKeyCountName) && ($JobDefaults_list->isGridAdd() || $JobDefaults_list->isGridEdit() || $JobDefaults->isConfirm())) {
		$JobDefaults_list->KeyCount = $CurrentForm->getValue($JobDefaults_list->FormKeyCountName);
		$JobDefaults_list->StopRecord = $JobDefaults_list->StartRecord + $JobDefaults_list->KeyCount - 1;
	}
}
$JobDefaults_list->RecordCount = $JobDefaults_list->StartRecord - 1;
if ($JobDefaults_list->Recordset && !$JobDefaults_list->Recordset->EOF) {
	$JobDefaults_list->Recordset->moveFirst();
	$selectLimit = $JobDefaults_list->UseSelectLimit;
	if (!$selectLimit && $JobDefaults_list->StartRecord > 1)
		$JobDefaults_list->Recordset->move($JobDefaults_list->StartRecord - 1);
} elseif (!$JobDefaults->AllowAddDeleteRow && $JobDefaults_list->StopRecord == 0) {
	$JobDefaults_list->StopRecord = $JobDefaults->GridAddRowCount;
}

// Initialize aggregate
$JobDefaults->RowType = ROWTYPE_AGGREGATEINIT;
$JobDefaults->resetAttributes();
$JobDefaults_list->renderRow();
$JobDefaults_list->EditRowCount = 0;
if ($JobDefaults_list->isEdit())
	$JobDefaults_list->RowIndex = 1;
if ($JobDefaults_list->isGridAdd())
	$JobDefaults_list->RowIndex = 0;
if ($JobDefaults_list->isGridEdit())
	$JobDefaults_list->RowIndex = 0;
while ($JobDefaults_list->RecordCount < $JobDefaults_list->StopRecord) {
	$JobDefaults_list->RecordCount++;
	if ($JobDefaults_list->RecordCount >= $JobDefaults_list->StartRecord) {
		$JobDefaults_list->RowCount++;
		if ($JobDefaults_list->isGridAdd() || $JobDefaults_list->isGridEdit() || $JobDefaults->isConfirm()) {
			$JobDefaults_list->RowIndex++;
			$CurrentForm->Index = $JobDefaults_list->RowIndex;
			if ($CurrentForm->hasValue($JobDefaults_list->FormActionName) && ($JobDefaults->isConfirm() || $JobDefaults_list->EventCancelled))
				$JobDefaults_list->RowAction = strval($CurrentForm->getValue($JobDefaults_list->FormActionName));
			elseif ($JobDefaults_list->isGridAdd())
				$JobDefaults_list->RowAction = "insert";
			else
				$JobDefaults_list->RowAction = "";
		}

		// Set up key count
		$JobDefaults_list->KeyCount = $JobDefaults_list->RowIndex;

		// Init row class and style
		$JobDefaults->resetAttributes();
		$JobDefaults->CssClass = "";
		if ($JobDefaults_list->isGridAdd()) {
			$JobDefaults_list->loadRowValues(); // Load default values
		} else {
			$JobDefaults_list->loadRowValues($JobDefaults_list->Recordset); // Load row values
		}
		$JobDefaults->RowType = ROWTYPE_VIEW; // Render view
		if ($JobDefaults_list->isGridAdd()) // Grid add
			$JobDefaults->RowType = ROWTYPE_ADD; // Render add
		if ($JobDefaults_list->isGridAdd() && $JobDefaults->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$JobDefaults_list->restoreCurrentRowFormValues($JobDefaults_list->RowIndex); // Restore form values
		if ($JobDefaults_list->isEdit()) {
			if ($JobDefaults_list->checkInlineEditKey() && $JobDefaults_list->EditRowCount == 0) { // Inline edit
				$JobDefaults->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($JobDefaults_list->isGridEdit()) { // Grid edit
			if ($JobDefaults->EventCancelled)
				$JobDefaults_list->restoreCurrentRowFormValues($JobDefaults_list->RowIndex); // Restore form values
			if ($JobDefaults_list->RowAction == "insert")
				$JobDefaults->RowType = ROWTYPE_ADD; // Render add
			else
				$JobDefaults->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($JobDefaults_list->isEdit() && $JobDefaults->RowType == ROWTYPE_EDIT && $JobDefaults->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$JobDefaults_list->restoreFormValues(); // Restore form values
		}
		if ($JobDefaults_list->isGridEdit() && ($JobDefaults->RowType == ROWTYPE_EDIT || $JobDefaults->RowType == ROWTYPE_ADD) && $JobDefaults->EventCancelled) // Update failed
			$JobDefaults_list->restoreCurrentRowFormValues($JobDefaults_list->RowIndex); // Restore form values
		if ($JobDefaults->RowType == ROWTYPE_EDIT) // Edit row
			$JobDefaults_list->EditRowCount++;

		// Set up row id / data-rowindex
		$JobDefaults->RowAttrs->merge(["data-rowindex" => $JobDefaults_list->RowCount, "id" => "r" . $JobDefaults_list->RowCount . "_JobDefaults", "data-rowtype" => $JobDefaults->RowType]);

		// Render row
		$JobDefaults_list->renderRow();

		// Render list options
		$JobDefaults_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($JobDefaults_list->RowAction != "delete" && $JobDefaults_list->RowAction != "insertdelete" && !($JobDefaults_list->RowAction == "insert" && $JobDefaults->isConfirm() && $JobDefaults_list->emptyRow())) {
?>
	<tr <?php echo $JobDefaults->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobDefaults_list->ListOptions->render("body", "left", $JobDefaults_list->RowCount);
?>
	<?php if ($JobDefaults_list->JobDefault_Idn->Visible) { // JobDefault_Idn ?>
		<td data-name="JobDefault_Idn" <?php echo $JobDefaults_list->JobDefault_Idn->cellAttributes() ?>>
<?php if ($JobDefaults->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_JobDefault_Idn" class="form-group"></span>
<input type="hidden" data-table="JobDefaults" data-field="x_JobDefault_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefault_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefault_Idn" value="<?php echo HtmlEncode($JobDefaults_list->JobDefault_Idn->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_JobDefault_Idn" class="form-group">
<span<?php echo $JobDefaults_list->JobDefault_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($JobDefaults_list->JobDefault_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_JobDefault_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_JobDefault_Idn" id="x<?php echo $JobDefaults_list->RowIndex ?>_JobDefault_Idn" value="<?php echo HtmlEncode($JobDefaults_list->JobDefault_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_JobDefault_Idn">
<span<?php echo $JobDefaults_list->JobDefault_Idn->viewAttributes() ?>><?php echo $JobDefaults_list->JobDefault_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
		<td data-name="JobDefaultType_Idn" <?php echo $JobDefaults_list->JobDefaultType_Idn->cellAttributes() ?>>
<?php if ($JobDefaults->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_JobDefaultType_Idn" class="form-group">
<?php $JobDefaults_list->JobDefaultType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_JobDefaultType_Idn" data-value-separator="<?php echo $JobDefaults_list->JobDefaultType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn"<?php echo $JobDefaults_list->JobDefaultType_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->JobDefaultType_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_JobDefaultType_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->JobDefaultType_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_JobDefaultType_Idn") ?>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_JobDefaultType_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn" value="<?php echo HtmlEncode($JobDefaults_list->JobDefaultType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_JobDefaultType_Idn" class="form-group">
<?php $JobDefaults_list->JobDefaultType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_JobDefaultType_Idn" data-value-separator="<?php echo $JobDefaults_list->JobDefaultType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn"<?php echo $JobDefaults_list->JobDefaultType_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->JobDefaultType_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_JobDefaultType_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->JobDefaultType_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_JobDefaultType_Idn") ?>
</span>
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_JobDefaultType_Idn">
<span<?php echo $JobDefaults_list->JobDefaultType_Idn->viewAttributes() ?>><?php echo $JobDefaults_list->JobDefaultType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $JobDefaults_list->Department_Idn->cellAttributes() ?>>
<?php if ($JobDefaults->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_Department_Idn" data-value-separator="<?php echo $JobDefaults_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn"<?php echo $JobDefaults_list->Department_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->Department_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->Department_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_Department_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($JobDefaults_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_Department_Idn" data-value-separator="<?php echo $JobDefaults_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn"<?php echo $JobDefaults_list->Department_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->Department_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->Department_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Department_Idn">
<span<?php echo $JobDefaults_list->Department_Idn->viewAttributes() ?>><?php echo $JobDefaults_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->ParentJobDefault_Idn->Visible) { // ParentJobDefault_Idn ?>
		<td data-name="ParentJobDefault_Idn" <?php echo $JobDefaults_list->ParentJobDefault_Idn->cellAttributes() ?>>
<?php if ($JobDefaults->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_ParentJobDefault_Idn" class="form-group">
<input type="text" data-table="JobDefaults" data-field="x_ParentJobDefault_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" id="x<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_list->ParentJobDefault_Idn->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->ParentJobDefault_Idn->EditValue ?>"<?php echo $JobDefaults_list->ParentJobDefault_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_ParentJobDefault_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" value="<?php echo HtmlEncode($JobDefaults_list->ParentJobDefault_Idn->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_ParentJobDefault_Idn" class="form-group">
<input type="text" data-table="JobDefaults" data-field="x_ParentJobDefault_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" id="x<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_list->ParentJobDefault_Idn->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->ParentJobDefault_Idn->EditValue ?>"<?php echo $JobDefaults_list->ParentJobDefault_Idn->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_ParentJobDefault_Idn">
<span<?php echo $JobDefaults_list->ParentJobDefault_Idn->viewAttributes() ?>><?php echo $JobDefaults_list->ParentJobDefault_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $JobDefaults_list->Name->cellAttributes() ?>>
<?php if ($JobDefaults->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Name" class="form-group">
<input type="text" data-table="JobDefaults" data-field="x_Name" name="x<?php echo $JobDefaults_list->RowIndex ?>_Name" id="x<?php echo $JobDefaults_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobDefaults_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->Name->EditValue ?>"<?php echo $JobDefaults_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_Name" name="o<?php echo $JobDefaults_list->RowIndex ?>_Name" id="o<?php echo $JobDefaults_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobDefaults_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Name" class="form-group">
<input type="text" data-table="JobDefaults" data-field="x_Name" name="x<?php echo $JobDefaults_list->RowIndex ?>_Name" id="x<?php echo $JobDefaults_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobDefaults_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->Name->EditValue ?>"<?php echo $JobDefaults_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Name">
<span<?php echo $JobDefaults_list->Name->viewAttributes() ?>><?php echo $JobDefaults_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->NumericValue->Visible) { // NumericValue ?>
		<td data-name="NumericValue" <?php echo $JobDefaults_list->NumericValue->cellAttributes() ?>>
<?php if ($JobDefaults->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_NumericValue" class="form-group">
<input type="text" data-table="JobDefaults" data-field="x_NumericValue" name="x<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" id="x<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($JobDefaults_list->NumericValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->NumericValue->EditValue ?>"<?php echo $JobDefaults_list->NumericValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_NumericValue" name="o<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" id="o<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" value="<?php echo HtmlEncode($JobDefaults_list->NumericValue->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_NumericValue" class="form-group">
<input type="text" data-table="JobDefaults" data-field="x_NumericValue" name="x<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" id="x<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($JobDefaults_list->NumericValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->NumericValue->EditValue ?>"<?php echo $JobDefaults_list->NumericValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_NumericValue">
<span<?php echo $JobDefaults_list->NumericValue->viewAttributes() ?>><?php echo $JobDefaults_list->NumericValue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->AlphaValue->Visible) { // AlphaValue ?>
		<td data-name="AlphaValue" <?php echo $JobDefaults_list->AlphaValue->cellAttributes() ?>>
<?php if ($JobDefaults->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_AlphaValue" class="form-group">
<input type="text" data-table="JobDefaults" data-field="x_AlphaValue" name="x<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" id="x<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($JobDefaults_list->AlphaValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->AlphaValue->EditValue ?>"<?php echo $JobDefaults_list->AlphaValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_AlphaValue" name="o<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" id="o<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" value="<?php echo HtmlEncode($JobDefaults_list->AlphaValue->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_AlphaValue" class="form-group">
<input type="text" data-table="JobDefaults" data-field="x_AlphaValue" name="x<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" id="x<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($JobDefaults_list->AlphaValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->AlphaValue->EditValue ?>"<?php echo $JobDefaults_list->AlphaValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_AlphaValue">
<span<?php echo $JobDefaults_list->AlphaValue->viewAttributes() ?>><?php echo $JobDefaults_list->AlphaValue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->LoadFromJobDefault_Idn->Visible) { // LoadFromJobDefault_Idn ?>
		<td data-name="LoadFromJobDefault_Idn" <?php echo $JobDefaults_list->LoadFromJobDefault_Idn->cellAttributes() ?>>
<?php if ($JobDefaults->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_LoadFromJobDefault_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_LoadFromJobDefault_Idn" data-value-separator="<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn"<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_LoadFromJobDefault_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_LoadFromJobDefault_Idn") ?>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_LoadFromJobDefault_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn" value="<?php echo HtmlEncode($JobDefaults_list->LoadFromJobDefault_Idn->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_LoadFromJobDefault_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_LoadFromJobDefault_Idn" data-value-separator="<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn"<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_LoadFromJobDefault_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_LoadFromJobDefault_Idn") ?>
</span>
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_LoadFromJobDefault_Idn">
<span<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->viewAttributes() ?>><?php echo $JobDefaults_list->LoadFromJobDefault_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $JobDefaults_list->Rank->cellAttributes() ?>>
<?php if ($JobDefaults->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Rank" class="form-group">
<input type="text" data-table="JobDefaults" data-field="x_Rank" name="x<?php echo $JobDefaults_list->RowIndex ?>_Rank" id="x<?php echo $JobDefaults_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->Rank->EditValue ?>"<?php echo $JobDefaults_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_Rank" name="o<?php echo $JobDefaults_list->RowIndex ?>_Rank" id="o<?php echo $JobDefaults_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobDefaults_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Rank" class="form-group">
<input type="text" data-table="JobDefaults" data-field="x_Rank" name="x<?php echo $JobDefaults_list->RowIndex ?>_Rank" id="x<?php echo $JobDefaults_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->Rank->EditValue ?>"<?php echo $JobDefaults_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_Rank">
<span<?php echo $JobDefaults_list->Rank->viewAttributes() ?>><?php echo $JobDefaults_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $JobDefaults_list->ActiveFlag->cellAttributes() ?>>
<?php if ($JobDefaults->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($JobDefaults_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobDefaults" data-field="x_ActiveFlag" name="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]_534781" value="1"<?php echo $selwrk ?><?php echo $JobDefaults_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]_534781"></label>
</div>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_ActiveFlag" name="o<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobDefaults_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($JobDefaults_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobDefaults" data-field="x_ActiveFlag" name="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]_186564" value="1"<?php echo $selwrk ?><?php echo $JobDefaults_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]_186564"></label>
</div>
</span>
<?php } ?>
<?php if ($JobDefaults->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobDefaults_list->RowCount ?>_JobDefaults_ActiveFlag">
<span<?php echo $JobDefaults_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $JobDefaults_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($JobDefaults_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobDefaults_list->ListOptions->render("body", "right", $JobDefaults_list->RowCount);
?>
	</tr>
<?php if ($JobDefaults->RowType == ROWTYPE_ADD || $JobDefaults->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fJobDefaultslist", "load"], function() {
	fJobDefaultslist.updateLists(<?php echo $JobDefaults_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$JobDefaults_list->isGridAdd())
		if (!$JobDefaults_list->Recordset->EOF)
			$JobDefaults_list->Recordset->moveNext();
}
?>
<?php
	if ($JobDefaults_list->isGridAdd() || $JobDefaults_list->isGridEdit()) {
		$JobDefaults_list->RowIndex = '$rowindex$';
		$JobDefaults_list->loadRowValues();

		// Set row properties
		$JobDefaults->resetAttributes();
		$JobDefaults->RowAttrs->merge(["data-rowindex" => $JobDefaults_list->RowIndex, "id" => "r0_JobDefaults", "data-rowtype" => ROWTYPE_ADD]);
		$JobDefaults->RowAttrs->appendClass("ew-template");
		$JobDefaults->RowType = ROWTYPE_ADD;

		// Render row
		$JobDefaults_list->renderRow();

		// Render list options
		$JobDefaults_list->renderListOptions();
		$JobDefaults_list->StartRowCount = 0;
?>
	<tr <?php echo $JobDefaults->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobDefaults_list->ListOptions->render("body", "left", $JobDefaults_list->RowIndex);
?>
	<?php if ($JobDefaults_list->JobDefault_Idn->Visible) { // JobDefault_Idn ?>
		<td data-name="JobDefault_Idn">
<span id="el$rowindex$_JobDefaults_JobDefault_Idn" class="form-group JobDefaults_JobDefault_Idn"></span>
<input type="hidden" data-table="JobDefaults" data-field="x_JobDefault_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefault_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefault_Idn" value="<?php echo HtmlEncode($JobDefaults_list->JobDefault_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->JobDefaultType_Idn->Visible) { // JobDefaultType_Idn ?>
		<td data-name="JobDefaultType_Idn">
<span id="el$rowindex$_JobDefaults_JobDefaultType_Idn" class="form-group JobDefaults_JobDefaultType_Idn">
<?php $JobDefaults_list->JobDefaultType_Idn->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_JobDefaultType_Idn" data-value-separator="<?php echo $JobDefaults_list->JobDefaultType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn"<?php echo $JobDefaults_list->JobDefaultType_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->JobDefaultType_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_JobDefaultType_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->JobDefaultType_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_JobDefaultType_Idn") ?>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_JobDefaultType_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_JobDefaultType_Idn" value="<?php echo HtmlEncode($JobDefaults_list->JobDefaultType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_JobDefaults_Department_Idn" class="form-group JobDefaults_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_Department_Idn" data-value-separator="<?php echo $JobDefaults_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn"<?php echo $JobDefaults_list->Department_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->Department_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->Department_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_Department_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($JobDefaults_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->ParentJobDefault_Idn->Visible) { // ParentJobDefault_Idn ?>
		<td data-name="ParentJobDefault_Idn">
<span id="el$rowindex$_JobDefaults_ParentJobDefault_Idn" class="form-group JobDefaults_ParentJobDefault_Idn">
<input type="text" data-table="JobDefaults" data-field="x_ParentJobDefault_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" id="x<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_list->ParentJobDefault_Idn->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->ParentJobDefault_Idn->EditValue ?>"<?php echo $JobDefaults_list->ParentJobDefault_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_ParentJobDefault_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_ParentJobDefault_Idn" value="<?php echo HtmlEncode($JobDefaults_list->ParentJobDefault_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_JobDefaults_Name" class="form-group JobDefaults_Name">
<input type="text" data-table="JobDefaults" data-field="x_Name" name="x<?php echo $JobDefaults_list->RowIndex ?>_Name" id="x<?php echo $JobDefaults_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($JobDefaults_list->Name->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->Name->EditValue ?>"<?php echo $JobDefaults_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_Name" name="o<?php echo $JobDefaults_list->RowIndex ?>_Name" id="o<?php echo $JobDefaults_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($JobDefaults_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->NumericValue->Visible) { // NumericValue ?>
		<td data-name="NumericValue">
<span id="el$rowindex$_JobDefaults_NumericValue" class="form-group JobDefaults_NumericValue">
<input type="text" data-table="JobDefaults" data-field="x_NumericValue" name="x<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" id="x<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($JobDefaults_list->NumericValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->NumericValue->EditValue ?>"<?php echo $JobDefaults_list->NumericValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_NumericValue" name="o<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" id="o<?php echo $JobDefaults_list->RowIndex ?>_NumericValue" value="<?php echo HtmlEncode($JobDefaults_list->NumericValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->AlphaValue->Visible) { // AlphaValue ?>
		<td data-name="AlphaValue">
<span id="el$rowindex$_JobDefaults_AlphaValue" class="form-group JobDefaults_AlphaValue">
<input type="text" data-table="JobDefaults" data-field="x_AlphaValue" name="x<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" id="x<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($JobDefaults_list->AlphaValue->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->AlphaValue->EditValue ?>"<?php echo $JobDefaults_list->AlphaValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_AlphaValue" name="o<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" id="o<?php echo $JobDefaults_list->RowIndex ?>_AlphaValue" value="<?php echo HtmlEncode($JobDefaults_list->AlphaValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->LoadFromJobDefault_Idn->Visible) { // LoadFromJobDefault_Idn ?>
		<td data-name="LoadFromJobDefault_Idn">
<span id="el$rowindex$_JobDefaults_LoadFromJobDefault_Idn" class="form-group JobDefaults_LoadFromJobDefault_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="JobDefaults" data-field="x_LoadFromJobDefault_Idn" data-value-separator="<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn" name="x<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn"<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->editAttributes() ?>>
			<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->selectOptionListHtml("x{$JobDefaults_list->RowIndex}_LoadFromJobDefault_Idn") ?>
		</select>
</div>
<?php echo $JobDefaults_list->LoadFromJobDefault_Idn->Lookup->getParamTag($JobDefaults_list, "p_x" . $JobDefaults_list->RowIndex . "_LoadFromJobDefault_Idn") ?>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_LoadFromJobDefault_Idn" name="o<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn" id="o<?php echo $JobDefaults_list->RowIndex ?>_LoadFromJobDefault_Idn" value="<?php echo HtmlEncode($JobDefaults_list->LoadFromJobDefault_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_JobDefaults_Rank" class="form-group JobDefaults_Rank">
<input type="text" data-table="JobDefaults" data-field="x_Rank" name="x<?php echo $JobDefaults_list->RowIndex ?>_Rank" id="x<?php echo $JobDefaults_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($JobDefaults_list->Rank->getPlaceHolder()) ?>" value="<?php echo $JobDefaults_list->Rank->EditValue ?>"<?php echo $JobDefaults_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_Rank" name="o<?php echo $JobDefaults_list->RowIndex ?>_Rank" id="o<?php echo $JobDefaults_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($JobDefaults_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobDefaults_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_JobDefaults_ActiveFlag" class="form-group JobDefaults_ActiveFlag">
<?php
$selwrk = ConvertToBool($JobDefaults_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="JobDefaults" data-field="x_ActiveFlag" name="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]_171199" value="1"<?php echo $selwrk ?><?php echo $JobDefaults_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]_171199"></label>
</div>
</span>
<input type="hidden" data-table="JobDefaults" data-field="x_ActiveFlag" name="o<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $JobDefaults_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($JobDefaults_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobDefaults_list->ListOptions->render("body", "right", $JobDefaults_list->RowIndex);
?>
<script>
loadjs.ready(["fJobDefaultslist", "load"], function() {
	fJobDefaultslist.updateLists(<?php echo $JobDefaults_list->RowIndex ?>);
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
<?php if ($JobDefaults_list->isAdd() || $JobDefaults_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $JobDefaults_list->FormKeyCountName ?>" id="<?php echo $JobDefaults_list->FormKeyCountName ?>" value="<?php echo $JobDefaults_list->KeyCount ?>">
<?php } ?>
<?php if ($JobDefaults_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $JobDefaults_list->FormKeyCountName ?>" id="<?php echo $JobDefaults_list->FormKeyCountName ?>" value="<?php echo $JobDefaults_list->KeyCount ?>">
<?php echo $JobDefaults_list->MultiSelectKey ?>
<?php } ?>
<?php if ($JobDefaults_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $JobDefaults_list->FormKeyCountName ?>" id="<?php echo $JobDefaults_list->FormKeyCountName ?>" value="<?php echo $JobDefaults_list->KeyCount ?>">
<?php } ?>
<?php if ($JobDefaults_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $JobDefaults_list->FormKeyCountName ?>" id="<?php echo $JobDefaults_list->FormKeyCountName ?>" value="<?php echo $JobDefaults_list->KeyCount ?>">
<?php echo $JobDefaults_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$JobDefaults->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($JobDefaults_list->Recordset)
	$JobDefaults_list->Recordset->Close();
?>
<?php if (!$JobDefaults_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$JobDefaults_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $JobDefaults_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $JobDefaults_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($JobDefaults_list->TotalRecords == 0 && !$JobDefaults->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $JobDefaults_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$JobDefaults_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$JobDefaults_list->isExport()) { ?>
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
$JobDefaults_list->terminate();
?>