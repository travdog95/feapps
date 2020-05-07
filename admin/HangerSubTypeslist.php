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
$HangerSubTypes_list = new HangerSubTypes_list();

// Run the page
$HangerSubTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HangerSubTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$HangerSubTypes_list->isExport()) { ?>
<script>
var fHangerSubTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fHangerSubTypeslist = currentForm = new ew.Form("fHangerSubTypeslist", "list");
	fHangerSubTypeslist.formKeyCountName = '<?php echo $HangerSubTypes_list->FormKeyCountName ?>';

	// Validate form
	fHangerSubTypeslist.validate = function() {
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
			<?php if ($HangerSubTypes_list->HangerSubType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerSubType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_list->HangerSubType_Idn->caption(), $HangerSubTypes_list->HangerSubType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HangerSubTypes_list->HangerType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_list->HangerType_Idn->caption(), $HangerSubTypes_list->HangerType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HangerSubTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_list->Name->caption(), $HangerSubTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HangerSubTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_list->Rank->caption(), $HangerSubTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($HangerSubTypes_list->Rank->errorMessage()) ?>");
			<?php if ($HangerSubTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_list->ActiveFlag->caption(), $HangerSubTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fHangerSubTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "HangerType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fHangerSubTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fHangerSubTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fHangerSubTypeslist.lists["x_HangerType_Idn"] = <?php echo $HangerSubTypes_list->HangerType_Idn->Lookup->toClientList($HangerSubTypes_list) ?>;
	fHangerSubTypeslist.lists["x_HangerType_Idn"].options = <?php echo JsonEncode($HangerSubTypes_list->HangerType_Idn->lookupOptions()) ?>;
	fHangerSubTypeslist.lists["x_ActiveFlag[]"] = <?php echo $HangerSubTypes_list->ActiveFlag->Lookup->toClientList($HangerSubTypes_list) ?>;
	fHangerSubTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($HangerSubTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fHangerSubTypeslist");
});
var fHangerSubTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fHangerSubTypeslistsrch = currentSearchForm = new ew.Form("fHangerSubTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fHangerSubTypeslistsrch.filterList = <?php echo $HangerSubTypes_list->getFilterList() ?>;
	loadjs.done("fHangerSubTypeslistsrch");
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
<?php if (!$HangerSubTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($HangerSubTypes_list->TotalRecords > 0 && $HangerSubTypes_list->ExportOptions->visible()) { ?>
<?php $HangerSubTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($HangerSubTypes_list->ImportOptions->visible()) { ?>
<?php $HangerSubTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($HangerSubTypes_list->SearchOptions->visible()) { ?>
<?php $HangerSubTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($HangerSubTypes_list->FilterOptions->visible()) { ?>
<?php $HangerSubTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$HangerSubTypes_list->isExport() || Config("EXPORT_MASTER_RECORD") && $HangerSubTypes_list->isExport("print")) { ?>
<?php
if ($HangerSubTypes_list->DbMasterFilter != "" && $HangerSubTypes->getCurrentMasterTable() == "HangerTypes") {
	if ($HangerSubTypes_list->MasterRecordExists) {
		include_once "HangerTypesmaster.php";
	}
}
?>
<?php } ?>
<?php
$HangerSubTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$HangerSubTypes_list->isExport() && !$HangerSubTypes->CurrentAction) { ?>
<form name="fHangerSubTypeslistsrch" id="fHangerSubTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fHangerSubTypeslistsrch-search-panel" class="<?php echo $HangerSubTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="HangerSubTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $HangerSubTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($HangerSubTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($HangerSubTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $HangerSubTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($HangerSubTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($HangerSubTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($HangerSubTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($HangerSubTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $HangerSubTypes_list->showPageHeader(); ?>
<?php
$HangerSubTypes_list->showMessage();
?>
<?php if ($HangerSubTypes_list->TotalRecords > 0 || $HangerSubTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($HangerSubTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> HangerSubTypes">
<?php if (!$HangerSubTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$HangerSubTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $HangerSubTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $HangerSubTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fHangerSubTypeslist" id="fHangerSubTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="HangerSubTypes">
<?php if ($HangerSubTypes->getCurrentMasterTable() == "HangerTypes" && $HangerSubTypes->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="HangerTypes">
<input type="hidden" name="fk_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerType_Idn->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_HangerSubTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($HangerSubTypes_list->TotalRecords > 0 || $HangerSubTypes_list->isAdd() || $HangerSubTypes_list->isCopy() || $HangerSubTypes_list->isGridEdit()) { ?>
<table id="tbl_HangerSubTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$HangerSubTypes->RowType = ROWTYPE_HEADER;

// Render list options
$HangerSubTypes_list->renderListOptions();

// Render list options (header, left)
$HangerSubTypes_list->ListOptions->render("header", "left");
?>
<?php if ($HangerSubTypes_list->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
	<?php if ($HangerSubTypes_list->SortUrl($HangerSubTypes_list->HangerSubType_Idn) == "") { ?>
		<th data-name="HangerSubType_Idn" class="<?php echo $HangerSubTypes_list->HangerSubType_Idn->headerCellClass() ?>"><div id="elh_HangerSubTypes_HangerSubType_Idn" class="HangerSubTypes_HangerSubType_Idn"><div class="ew-table-header-caption"><?php echo $HangerSubTypes_list->HangerSubType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HangerSubType_Idn" class="<?php echo $HangerSubTypes_list->HangerSubType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HangerSubTypes_list->SortUrl($HangerSubTypes_list->HangerSubType_Idn) ?>', 1);"><div id="elh_HangerSubTypes_HangerSubType_Idn" class="HangerSubTypes_HangerSubType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_list->HangerSubType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_list->HangerSubType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_list->HangerSubType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
	<?php if ($HangerSubTypes_list->SortUrl($HangerSubTypes_list->HangerType_Idn) == "") { ?>
		<th data-name="HangerType_Idn" class="<?php echo $HangerSubTypes_list->HangerType_Idn->headerCellClass() ?>"><div id="elh_HangerSubTypes_HangerType_Idn" class="HangerSubTypes_HangerType_Idn"><div class="ew-table-header-caption"><?php echo $HangerSubTypes_list->HangerType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HangerType_Idn" class="<?php echo $HangerSubTypes_list->HangerType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HangerSubTypes_list->SortUrl($HangerSubTypes_list->HangerType_Idn) ?>', 1);"><div id="elh_HangerSubTypes_HangerType_Idn" class="HangerSubTypes_HangerType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_list->HangerType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_list->HangerType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_list->HangerType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_list->Name->Visible) { // Name ?>
	<?php if ($HangerSubTypes_list->SortUrl($HangerSubTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $HangerSubTypes_list->Name->headerCellClass() ?>"><div id="elh_HangerSubTypes_Name" class="HangerSubTypes_Name"><div class="ew-table-header-caption"><?php echo $HangerSubTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $HangerSubTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HangerSubTypes_list->SortUrl($HangerSubTypes_list->Name) ?>', 1);"><div id="elh_HangerSubTypes_Name" class="HangerSubTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($HangerSubTypes_list->SortUrl($HangerSubTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $HangerSubTypes_list->Rank->headerCellClass() ?>"><div id="elh_HangerSubTypes_Rank" class="HangerSubTypes_Rank"><div class="ew-table-header-caption"><?php echo $HangerSubTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $HangerSubTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HangerSubTypes_list->SortUrl($HangerSubTypes_list->Rank) ?>', 1);"><div id="elh_HangerSubTypes_Rank" class="HangerSubTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($HangerSubTypes_list->SortUrl($HangerSubTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $HangerSubTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_HangerSubTypes_ActiveFlag" class="HangerSubTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $HangerSubTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $HangerSubTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HangerSubTypes_list->SortUrl($HangerSubTypes_list->ActiveFlag) ?>', 1);"><div id="elh_HangerSubTypes_ActiveFlag" class="HangerSubTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$HangerSubTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($HangerSubTypes_list->isAdd() || $HangerSubTypes_list->isCopy()) {
		$HangerSubTypes_list->RowIndex = 0;
		$HangerSubTypes_list->KeyCount = $HangerSubTypes_list->RowIndex;
		if ($HangerSubTypes_list->isCopy() && !$HangerSubTypes_list->loadRow())
			$HangerSubTypes->CurrentAction = "add";
		if ($HangerSubTypes_list->isAdd())
			$HangerSubTypes_list->loadRowValues();
		if ($HangerSubTypes->EventCancelled) // Insert failed
			$HangerSubTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$HangerSubTypes->resetAttributes();
		$HangerSubTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_HangerSubTypes", "data-rowtype" => ROWTYPE_ADD]);
		$HangerSubTypes->RowType = ROWTYPE_ADD;

		// Render row
		$HangerSubTypes_list->renderRow();

		// Render list options
		$HangerSubTypes_list->renderListOptions();
		$HangerSubTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $HangerSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HangerSubTypes_list->ListOptions->render("body", "left", $HangerSubTypes_list->RowCount);
?>
	<?php if ($HangerSubTypes_list->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<td data-name="HangerSubType_Idn">
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_HangerSubType_Idn" class="form-group HangerSubTypes_HangerSubType_Idn"></span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerSubType_Idn" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerSubType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td data-name="HangerType_Idn">
<?php if ($HangerSubTypes_list->HangerType_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_HangerType_Idn" class="form-group HangerSubTypes_HangerType_Idn">
<span<?php echo $HangerSubTypes_list->HangerType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_list->HangerType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerType_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_HangerType_Idn" class="form-group HangerSubTypes_HangerType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="HangerSubTypes" data-field="x_HangerType_Idn" data-value-separator="<?php echo $HangerSubTypes_list->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn"<?php echo $HangerSubTypes_list->HangerType_Idn->editAttributes() ?>>
			<?php echo $HangerSubTypes_list->HangerType_Idn->selectOptionListHtml("x{$HangerSubTypes_list->RowIndex}_HangerType_Idn") ?>
		</select>
</div>
<?php echo $HangerSubTypes_list->HangerType_Idn->Lookup->getParamTag($HangerSubTypes_list, "p_x" . $HangerSubTypes_list->RowIndex . "_HangerType_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerType_Idn" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_Name" class="form-group HangerSubTypes_Name">
<input type="text" data-table="HangerSubTypes" data-field="x_Name" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_Name" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerSubTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_list->Name->EditValue ?>"<?php echo $HangerSubTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Name" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_Name" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerSubTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_Rank" class="form-group HangerSubTypes_Rank">
<input type="text" data-table="HangerSubTypes" data-field="x_Rank" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerSubTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_list->Rank->EditValue ?>"<?php echo $HangerSubTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Rank" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerSubTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_ActiveFlag" class="form-group HangerSubTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($HangerSubTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]_164330" value="1"<?php echo $selwrk ?><?php echo $HangerSubTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]_164330"></label>
</div>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HangerSubTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$HangerSubTypes_list->ListOptions->render("body", "right", $HangerSubTypes_list->RowCount);
?>
<script>
loadjs.ready(["fHangerSubTypeslist", "load"], function() {
	fHangerSubTypeslist.updateLists(<?php echo $HangerSubTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($HangerSubTypes_list->ExportAll && $HangerSubTypes_list->isExport()) {
	$HangerSubTypes_list->StopRecord = $HangerSubTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($HangerSubTypes_list->TotalRecords > $HangerSubTypes_list->StartRecord + $HangerSubTypes_list->DisplayRecords - 1)
		$HangerSubTypes_list->StopRecord = $HangerSubTypes_list->StartRecord + $HangerSubTypes_list->DisplayRecords - 1;
	else
		$HangerSubTypes_list->StopRecord = $HangerSubTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($HangerSubTypes->isConfirm() || $HangerSubTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($HangerSubTypes_list->FormKeyCountName) && ($HangerSubTypes_list->isGridAdd() || $HangerSubTypes_list->isGridEdit() || $HangerSubTypes->isConfirm())) {
		$HangerSubTypes_list->KeyCount = $CurrentForm->getValue($HangerSubTypes_list->FormKeyCountName);
		$HangerSubTypes_list->StopRecord = $HangerSubTypes_list->StartRecord + $HangerSubTypes_list->KeyCount - 1;
	}
}
$HangerSubTypes_list->RecordCount = $HangerSubTypes_list->StartRecord - 1;
if ($HangerSubTypes_list->Recordset && !$HangerSubTypes_list->Recordset->EOF) {
	$HangerSubTypes_list->Recordset->moveFirst();
	$selectLimit = $HangerSubTypes_list->UseSelectLimit;
	if (!$selectLimit && $HangerSubTypes_list->StartRecord > 1)
		$HangerSubTypes_list->Recordset->move($HangerSubTypes_list->StartRecord - 1);
} elseif (!$HangerSubTypes->AllowAddDeleteRow && $HangerSubTypes_list->StopRecord == 0) {
	$HangerSubTypes_list->StopRecord = $HangerSubTypes->GridAddRowCount;
}

// Initialize aggregate
$HangerSubTypes->RowType = ROWTYPE_AGGREGATEINIT;
$HangerSubTypes->resetAttributes();
$HangerSubTypes_list->renderRow();
$HangerSubTypes_list->EditRowCount = 0;
if ($HangerSubTypes_list->isEdit())
	$HangerSubTypes_list->RowIndex = 1;
if ($HangerSubTypes_list->isGridAdd())
	$HangerSubTypes_list->RowIndex = 0;
if ($HangerSubTypes_list->isGridEdit())
	$HangerSubTypes_list->RowIndex = 0;
while ($HangerSubTypes_list->RecordCount < $HangerSubTypes_list->StopRecord) {
	$HangerSubTypes_list->RecordCount++;
	if ($HangerSubTypes_list->RecordCount >= $HangerSubTypes_list->StartRecord) {
		$HangerSubTypes_list->RowCount++;
		if ($HangerSubTypes_list->isGridAdd() || $HangerSubTypes_list->isGridEdit() || $HangerSubTypes->isConfirm()) {
			$HangerSubTypes_list->RowIndex++;
			$CurrentForm->Index = $HangerSubTypes_list->RowIndex;
			if ($CurrentForm->hasValue($HangerSubTypes_list->FormActionName) && ($HangerSubTypes->isConfirm() || $HangerSubTypes_list->EventCancelled))
				$HangerSubTypes_list->RowAction = strval($CurrentForm->getValue($HangerSubTypes_list->FormActionName));
			elseif ($HangerSubTypes_list->isGridAdd())
				$HangerSubTypes_list->RowAction = "insert";
			else
				$HangerSubTypes_list->RowAction = "";
		}

		// Set up key count
		$HangerSubTypes_list->KeyCount = $HangerSubTypes_list->RowIndex;

		// Init row class and style
		$HangerSubTypes->resetAttributes();
		$HangerSubTypes->CssClass = "";
		if ($HangerSubTypes_list->isGridAdd()) {
			$HangerSubTypes_list->loadRowValues(); // Load default values
		} else {
			$HangerSubTypes_list->loadRowValues($HangerSubTypes_list->Recordset); // Load row values
		}
		$HangerSubTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($HangerSubTypes_list->isGridAdd()) // Grid add
			$HangerSubTypes->RowType = ROWTYPE_ADD; // Render add
		if ($HangerSubTypes_list->isGridAdd() && $HangerSubTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$HangerSubTypes_list->restoreCurrentRowFormValues($HangerSubTypes_list->RowIndex); // Restore form values
		if ($HangerSubTypes_list->isEdit()) {
			if ($HangerSubTypes_list->checkInlineEditKey() && $HangerSubTypes_list->EditRowCount == 0) { // Inline edit
				$HangerSubTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($HangerSubTypes_list->isGridEdit()) { // Grid edit
			if ($HangerSubTypes->EventCancelled)
				$HangerSubTypes_list->restoreCurrentRowFormValues($HangerSubTypes_list->RowIndex); // Restore form values
			if ($HangerSubTypes_list->RowAction == "insert")
				$HangerSubTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$HangerSubTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($HangerSubTypes_list->isEdit() && $HangerSubTypes->RowType == ROWTYPE_EDIT && $HangerSubTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$HangerSubTypes_list->restoreFormValues(); // Restore form values
		}
		if ($HangerSubTypes_list->isGridEdit() && ($HangerSubTypes->RowType == ROWTYPE_EDIT || $HangerSubTypes->RowType == ROWTYPE_ADD) && $HangerSubTypes->EventCancelled) // Update failed
			$HangerSubTypes_list->restoreCurrentRowFormValues($HangerSubTypes_list->RowIndex); // Restore form values
		if ($HangerSubTypes->RowType == ROWTYPE_EDIT) // Edit row
			$HangerSubTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$HangerSubTypes->RowAttrs->merge(["data-rowindex" => $HangerSubTypes_list->RowCount, "id" => "r" . $HangerSubTypes_list->RowCount . "_HangerSubTypes", "data-rowtype" => $HangerSubTypes->RowType]);

		// Render row
		$HangerSubTypes_list->renderRow();

		// Render list options
		$HangerSubTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($HangerSubTypes_list->RowAction != "delete" && $HangerSubTypes_list->RowAction != "insertdelete" && !($HangerSubTypes_list->RowAction == "insert" && $HangerSubTypes->isConfirm() && $HangerSubTypes_list->emptyRow())) {
?>
	<tr <?php echo $HangerSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HangerSubTypes_list->ListOptions->render("body", "left", $HangerSubTypes_list->RowCount);
?>
	<?php if ($HangerSubTypes_list->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<td data-name="HangerSubType_Idn" <?php echo $HangerSubTypes_list->HangerSubType_Idn->cellAttributes() ?>>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_HangerSubType_Idn" class="form-group"></span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerSubType_Idn" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerSubType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_HangerSubType_Idn" class="form-group">
<span<?php echo $HangerSubTypes_list->HangerSubType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_list->HangerSubType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerSubType_Idn" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerSubType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_HangerSubType_Idn">
<span<?php echo $HangerSubTypes_list->HangerSubType_Idn->viewAttributes() ?>><?php echo $HangerSubTypes_list->HangerSubType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td data-name="HangerType_Idn" <?php echo $HangerSubTypes_list->HangerType_Idn->cellAttributes() ?>>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($HangerSubTypes_list->HangerType_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_HangerType_Idn" class="form-group">
<span<?php echo $HangerSubTypes_list->HangerType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_list->HangerType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerType_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_HangerType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="HangerSubTypes" data-field="x_HangerType_Idn" data-value-separator="<?php echo $HangerSubTypes_list->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn"<?php echo $HangerSubTypes_list->HangerType_Idn->editAttributes() ?>>
			<?php echo $HangerSubTypes_list->HangerType_Idn->selectOptionListHtml("x{$HangerSubTypes_list->RowIndex}_HangerType_Idn") ?>
		</select>
</div>
<?php echo $HangerSubTypes_list->HangerType_Idn->Lookup->getParamTag($HangerSubTypes_list, "p_x" . $HangerSubTypes_list->RowIndex . "_HangerType_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerType_Idn" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($HangerSubTypes_list->HangerType_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_HangerType_Idn" class="form-group">
<span<?php echo $HangerSubTypes_list->HangerType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_list->HangerType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerType_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_HangerType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="HangerSubTypes" data-field="x_HangerType_Idn" data-value-separator="<?php echo $HangerSubTypes_list->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn"<?php echo $HangerSubTypes_list->HangerType_Idn->editAttributes() ?>>
			<?php echo $HangerSubTypes_list->HangerType_Idn->selectOptionListHtml("x{$HangerSubTypes_list->RowIndex}_HangerType_Idn") ?>
		</select>
</div>
<?php echo $HangerSubTypes_list->HangerType_Idn->Lookup->getParamTag($HangerSubTypes_list, "p_x" . $HangerSubTypes_list->RowIndex . "_HangerType_Idn") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_HangerType_Idn">
<span<?php echo $HangerSubTypes_list->HangerType_Idn->viewAttributes() ?>><?php echo $HangerSubTypes_list->HangerType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $HangerSubTypes_list->Name->cellAttributes() ?>>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_Name" class="form-group">
<input type="text" data-table="HangerSubTypes" data-field="x_Name" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_Name" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerSubTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_list->Name->EditValue ?>"<?php echo $HangerSubTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Name" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_Name" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerSubTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_Name" class="form-group">
<input type="text" data-table="HangerSubTypes" data-field="x_Name" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_Name" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerSubTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_list->Name->EditValue ?>"<?php echo $HangerSubTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_Name">
<span<?php echo $HangerSubTypes_list->Name->viewAttributes() ?>><?php echo $HangerSubTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $HangerSubTypes_list->Rank->cellAttributes() ?>>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_Rank" class="form-group">
<input type="text" data-table="HangerSubTypes" data-field="x_Rank" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerSubTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_list->Rank->EditValue ?>"<?php echo $HangerSubTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Rank" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerSubTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_Rank" class="form-group">
<input type="text" data-table="HangerSubTypes" data-field="x_Rank" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerSubTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_list->Rank->EditValue ?>"<?php echo $HangerSubTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_Rank">
<span<?php echo $HangerSubTypes_list->Rank->viewAttributes() ?>><?php echo $HangerSubTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $HangerSubTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($HangerSubTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]_875885" value="1"<?php echo $selwrk ?><?php echo $HangerSubTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]_875885"></label>
</div>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HangerSubTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($HangerSubTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]_746978" value="1"<?php echo $selwrk ?><?php echo $HangerSubTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]_746978"></label>
</div>
</span>
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerSubTypes_list->RowCount ?>_HangerSubTypes_ActiveFlag">
<span<?php echo $HangerSubTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HangerSubTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HangerSubTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$HangerSubTypes_list->ListOptions->render("body", "right", $HangerSubTypes_list->RowCount);
?>
	</tr>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD || $HangerSubTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fHangerSubTypeslist", "load"], function() {
	fHangerSubTypeslist.updateLists(<?php echo $HangerSubTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$HangerSubTypes_list->isGridAdd())
		if (!$HangerSubTypes_list->Recordset->EOF)
			$HangerSubTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($HangerSubTypes_list->isGridAdd() || $HangerSubTypes_list->isGridEdit()) {
		$HangerSubTypes_list->RowIndex = '$rowindex$';
		$HangerSubTypes_list->loadRowValues();

		// Set row properties
		$HangerSubTypes->resetAttributes();
		$HangerSubTypes->RowAttrs->merge(["data-rowindex" => $HangerSubTypes_list->RowIndex, "id" => "r0_HangerSubTypes", "data-rowtype" => ROWTYPE_ADD]);
		$HangerSubTypes->RowAttrs->appendClass("ew-template");
		$HangerSubTypes->RowType = ROWTYPE_ADD;

		// Render row
		$HangerSubTypes_list->renderRow();

		// Render list options
		$HangerSubTypes_list->renderListOptions();
		$HangerSubTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $HangerSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HangerSubTypes_list->ListOptions->render("body", "left", $HangerSubTypes_list->RowIndex);
?>
	<?php if ($HangerSubTypes_list->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<td data-name="HangerSubType_Idn">
<span id="el$rowindex$_HangerSubTypes_HangerSubType_Idn" class="form-group HangerSubTypes_HangerSubType_Idn"></span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerSubType_Idn" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerSubType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td data-name="HangerType_Idn">
<?php if ($HangerSubTypes_list->HangerType_Idn->getSessionValue() != "") { ?>
<span id="el$rowindex$_HangerSubTypes_HangerType_Idn" class="form-group HangerSubTypes_HangerType_Idn">
<span<?php echo $HangerSubTypes_list->HangerType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_list->HangerType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerType_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_HangerSubTypes_HangerType_Idn" class="form-group HangerSubTypes_HangerType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="HangerSubTypes" data-field="x_HangerType_Idn" data-value-separator="<?php echo $HangerSubTypes_list->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn"<?php echo $HangerSubTypes_list->HangerType_Idn->editAttributes() ?>>
			<?php echo $HangerSubTypes_list->HangerType_Idn->selectOptionListHtml("x{$HangerSubTypes_list->RowIndex}_HangerType_Idn") ?>
		</select>
</div>
<?php echo $HangerSubTypes_list->HangerType_Idn->Lookup->getParamTag($HangerSubTypes_list, "p_x" . $HangerSubTypes_list->RowIndex . "_HangerType_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerType_Idn" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_list->HangerType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_HangerSubTypes_Name" class="form-group HangerSubTypes_Name">
<input type="text" data-table="HangerSubTypes" data-field="x_Name" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_Name" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerSubTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_list->Name->EditValue ?>"<?php echo $HangerSubTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Name" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_Name" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerSubTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_HangerSubTypes_Rank" class="form-group HangerSubTypes_Rank">
<input type="text" data-table="HangerSubTypes" data-field="x_Rank" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerSubTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_list->Rank->EditValue ?>"<?php echo $HangerSubTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Rank" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerSubTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_HangerSubTypes_ActiveFlag" class="form-group HangerSubTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($HangerSubTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]_914210" value="1"<?php echo $selwrk ?><?php echo $HangerSubTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]_914210"></label>
</div>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="o<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HangerSubTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HangerSubTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$HangerSubTypes_list->ListOptions->render("body", "right", $HangerSubTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fHangerSubTypeslist", "load"], function() {
	fHangerSubTypeslist.updateLists(<?php echo $HangerSubTypes_list->RowIndex ?>);
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
<?php if ($HangerSubTypes_list->isAdd() || $HangerSubTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $HangerSubTypes_list->FormKeyCountName ?>" id="<?php echo $HangerSubTypes_list->FormKeyCountName ?>" value="<?php echo $HangerSubTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($HangerSubTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $HangerSubTypes_list->FormKeyCountName ?>" id="<?php echo $HangerSubTypes_list->FormKeyCountName ?>" value="<?php echo $HangerSubTypes_list->KeyCount ?>">
<?php echo $HangerSubTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($HangerSubTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $HangerSubTypes_list->FormKeyCountName ?>" id="<?php echo $HangerSubTypes_list->FormKeyCountName ?>" value="<?php echo $HangerSubTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($HangerSubTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $HangerSubTypes_list->FormKeyCountName ?>" id="<?php echo $HangerSubTypes_list->FormKeyCountName ?>" value="<?php echo $HangerSubTypes_list->KeyCount ?>">
<?php echo $HangerSubTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$HangerSubTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($HangerSubTypes_list->Recordset)
	$HangerSubTypes_list->Recordset->Close();
?>
<?php if (!$HangerSubTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$HangerSubTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $HangerSubTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $HangerSubTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($HangerSubTypes_list->TotalRecords == 0 && !$HangerSubTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $HangerSubTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$HangerSubTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$HangerSubTypes_list->isExport()) { ?>
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
$HangerSubTypes_list->terminate();
?>