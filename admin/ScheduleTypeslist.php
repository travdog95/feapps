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
$ScheduleTypes_list = new ScheduleTypes_list();

// Run the page
$ScheduleTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ScheduleTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ScheduleTypes_list->isExport()) { ?>
<script>
var fScheduleTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fScheduleTypeslist = currentForm = new ew.Form("fScheduleTypeslist", "list");
	fScheduleTypeslist.formKeyCountName = '<?php echo $ScheduleTypes_list->FormKeyCountName ?>';

	// Validate form
	fScheduleTypeslist.validate = function() {
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
			<?php if ($ScheduleTypes_list->ScheduleType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ScheduleType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_list->ScheduleType_Idn->caption(), $ScheduleTypes_list->ScheduleType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ScheduleTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_list->Name->caption(), $ScheduleTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ScheduleTypes_list->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_list->ShortName->caption(), $ScheduleTypes_list->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ScheduleTypes_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_list->Department_Idn->caption(), $ScheduleTypes_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ScheduleTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_list->Rank->caption(), $ScheduleTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ScheduleTypes_list->Rank->errorMessage()) ?>");
			<?php if ($ScheduleTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ScheduleTypes_list->ActiveFlag->caption(), $ScheduleTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fScheduleTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "ShortName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fScheduleTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fScheduleTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fScheduleTypeslist.lists["x_Department_Idn"] = <?php echo $ScheduleTypes_list->Department_Idn->Lookup->toClientList($ScheduleTypes_list) ?>;
	fScheduleTypeslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($ScheduleTypes_list->Department_Idn->lookupOptions()) ?>;
	fScheduleTypeslist.lists["x_ActiveFlag[]"] = <?php echo $ScheduleTypes_list->ActiveFlag->Lookup->toClientList($ScheduleTypes_list) ?>;
	fScheduleTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ScheduleTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fScheduleTypeslist");
});
var fScheduleTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fScheduleTypeslistsrch = currentSearchForm = new ew.Form("fScheduleTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fScheduleTypeslistsrch.filterList = <?php echo $ScheduleTypes_list->getFilterList() ?>;
	loadjs.done("fScheduleTypeslistsrch");
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
<?php if (!$ScheduleTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ScheduleTypes_list->TotalRecords > 0 && $ScheduleTypes_list->ExportOptions->visible()) { ?>
<?php $ScheduleTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ScheduleTypes_list->ImportOptions->visible()) { ?>
<?php $ScheduleTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ScheduleTypes_list->SearchOptions->visible()) { ?>
<?php $ScheduleTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ScheduleTypes_list->FilterOptions->visible()) { ?>
<?php $ScheduleTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ScheduleTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ScheduleTypes_list->isExport() && !$ScheduleTypes->CurrentAction) { ?>
<form name="fScheduleTypeslistsrch" id="fScheduleTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fScheduleTypeslistsrch-search-panel" class="<?php echo $ScheduleTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ScheduleTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ScheduleTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ScheduleTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ScheduleTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ScheduleTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ScheduleTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ScheduleTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ScheduleTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ScheduleTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ScheduleTypes_list->showPageHeader(); ?>
<?php
$ScheduleTypes_list->showMessage();
?>
<?php if ($ScheduleTypes_list->TotalRecords > 0 || $ScheduleTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ScheduleTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ScheduleTypes">
<?php if (!$ScheduleTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ScheduleTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ScheduleTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ScheduleTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fScheduleTypeslist" id="fScheduleTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ScheduleTypes">
<div id="gmp_ScheduleTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ScheduleTypes_list->TotalRecords > 0 || $ScheduleTypes_list->isAdd() || $ScheduleTypes_list->isCopy() || $ScheduleTypes_list->isGridEdit()) { ?>
<table id="tbl_ScheduleTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ScheduleTypes->RowType = ROWTYPE_HEADER;

// Render list options
$ScheduleTypes_list->renderListOptions();

// Render list options (header, left)
$ScheduleTypes_list->ListOptions->render("header", "left");
?>
<?php if ($ScheduleTypes_list->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
	<?php if ($ScheduleTypes_list->SortUrl($ScheduleTypes_list->ScheduleType_Idn) == "") { ?>
		<th data-name="ScheduleType_Idn" class="<?php echo $ScheduleTypes_list->ScheduleType_Idn->headerCellClass() ?>"><div id="elh_ScheduleTypes_ScheduleType_Idn" class="ScheduleTypes_ScheduleType_Idn"><div class="ew-table-header-caption"><?php echo $ScheduleTypes_list->ScheduleType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ScheduleType_Idn" class="<?php echo $ScheduleTypes_list->ScheduleType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ScheduleTypes_list->SortUrl($ScheduleTypes_list->ScheduleType_Idn) ?>', 1);"><div id="elh_ScheduleTypes_ScheduleType_Idn" class="ScheduleTypes_ScheduleType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ScheduleTypes_list->ScheduleType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($ScheduleTypes_list->ScheduleType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ScheduleTypes_list->ScheduleType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ScheduleTypes_list->Name->Visible) { // Name ?>
	<?php if ($ScheduleTypes_list->SortUrl($ScheduleTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $ScheduleTypes_list->Name->headerCellClass() ?>"><div id="elh_ScheduleTypes_Name" class="ScheduleTypes_Name"><div class="ew-table-header-caption"><?php echo $ScheduleTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $ScheduleTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ScheduleTypes_list->SortUrl($ScheduleTypes_list->Name) ?>', 1);"><div id="elh_ScheduleTypes_Name" class="ScheduleTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ScheduleTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ScheduleTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ScheduleTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ScheduleTypes_list->ShortName->Visible) { // ShortName ?>
	<?php if ($ScheduleTypes_list->SortUrl($ScheduleTypes_list->ShortName) == "") { ?>
		<th data-name="ShortName" class="<?php echo $ScheduleTypes_list->ShortName->headerCellClass() ?>"><div id="elh_ScheduleTypes_ShortName" class="ScheduleTypes_ShortName"><div class="ew-table-header-caption"><?php echo $ScheduleTypes_list->ShortName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShortName" class="<?php echo $ScheduleTypes_list->ShortName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ScheduleTypes_list->SortUrl($ScheduleTypes_list->ShortName) ?>', 1);"><div id="elh_ScheduleTypes_ShortName" class="ScheduleTypes_ShortName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ScheduleTypes_list->ShortName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ScheduleTypes_list->ShortName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ScheduleTypes_list->ShortName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ScheduleTypes_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($ScheduleTypes_list->SortUrl($ScheduleTypes_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $ScheduleTypes_list->Department_Idn->headerCellClass() ?>"><div id="elh_ScheduleTypes_Department_Idn" class="ScheduleTypes_Department_Idn"><div class="ew-table-header-caption"><?php echo $ScheduleTypes_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $ScheduleTypes_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ScheduleTypes_list->SortUrl($ScheduleTypes_list->Department_Idn) ?>', 1);"><div id="elh_ScheduleTypes_Department_Idn" class="ScheduleTypes_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ScheduleTypes_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($ScheduleTypes_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ScheduleTypes_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ScheduleTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($ScheduleTypes_list->SortUrl($ScheduleTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $ScheduleTypes_list->Rank->headerCellClass() ?>"><div id="elh_ScheduleTypes_Rank" class="ScheduleTypes_Rank"><div class="ew-table-header-caption"><?php echo $ScheduleTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $ScheduleTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ScheduleTypes_list->SortUrl($ScheduleTypes_list->Rank) ?>', 1);"><div id="elh_ScheduleTypes_Rank" class="ScheduleTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ScheduleTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($ScheduleTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ScheduleTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ScheduleTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($ScheduleTypes_list->SortUrl($ScheduleTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $ScheduleTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_ScheduleTypes_ActiveFlag" class="ScheduleTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $ScheduleTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $ScheduleTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ScheduleTypes_list->SortUrl($ScheduleTypes_list->ActiveFlag) ?>', 1);"><div id="elh_ScheduleTypes_ActiveFlag" class="ScheduleTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ScheduleTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($ScheduleTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ScheduleTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ScheduleTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($ScheduleTypes_list->isAdd() || $ScheduleTypes_list->isCopy()) {
		$ScheduleTypes_list->RowIndex = 0;
		$ScheduleTypes_list->KeyCount = $ScheduleTypes_list->RowIndex;
		if ($ScheduleTypes_list->isCopy() && !$ScheduleTypes_list->loadRow())
			$ScheduleTypes->CurrentAction = "add";
		if ($ScheduleTypes_list->isAdd())
			$ScheduleTypes_list->loadRowValues();
		if ($ScheduleTypes->EventCancelled) // Insert failed
			$ScheduleTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$ScheduleTypes->resetAttributes();
		$ScheduleTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_ScheduleTypes", "data-rowtype" => ROWTYPE_ADD]);
		$ScheduleTypes->RowType = ROWTYPE_ADD;

		// Render row
		$ScheduleTypes_list->renderRow();

		// Render list options
		$ScheduleTypes_list->renderListOptions();
		$ScheduleTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $ScheduleTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ScheduleTypes_list->ListOptions->render("body", "left", $ScheduleTypes_list->RowCount);
?>
	<?php if ($ScheduleTypes_list->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
		<td data-name="ScheduleType_Idn">
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ScheduleType_Idn" class="form-group ScheduleTypes_ScheduleType_Idn"></span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_ScheduleType_Idn" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_ScheduleType_Idn" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_ScheduleType_Idn" value="<?php echo HtmlEncode($ScheduleTypes_list->ScheduleType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Name" class="form-group ScheduleTypes_Name">
<input type="text" data-table="ScheduleTypes" data-field="x_Name" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Name" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->Name->EditValue ?>"<?php echo $ScheduleTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_Name" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_Name" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ScheduleTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ShortName" class="form-group ScheduleTypes_ShortName">
<input type="text" data-table="ScheduleTypes" data-field="x_ShortName" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->ShortName->EditValue ?>"<?php echo $ScheduleTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_ShortName" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($ScheduleTypes_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Department_Idn" class="form-group ScheduleTypes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ScheduleTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $ScheduleTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn"<?php echo $ScheduleTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $ScheduleTypes_list->Department_Idn->selectOptionListHtml("x{$ScheduleTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $ScheduleTypes_list->Department_Idn->Lookup->getParamTag($ScheduleTypes_list, "p_x" . $ScheduleTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_Department_Idn" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($ScheduleTypes_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Rank" class="form-group ScheduleTypes_Rank">
<input type="text" data-table="ScheduleTypes" data-field="x_Rank" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->Rank->EditValue ?>"<?php echo $ScheduleTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_Rank" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ScheduleTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ActiveFlag" class="form-group ScheduleTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($ScheduleTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ScheduleTypes" data-field="x_ActiveFlag" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]_507823" value="1"<?php echo $selwrk ?><?php echo $ScheduleTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]_507823"></label>
</div>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_ActiveFlag" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ScheduleTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ScheduleTypes_list->ListOptions->render("body", "right", $ScheduleTypes_list->RowCount);
?>
<script>
loadjs.ready(["fScheduleTypeslist", "load"], function() {
	fScheduleTypeslist.updateLists(<?php echo $ScheduleTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($ScheduleTypes_list->ExportAll && $ScheduleTypes_list->isExport()) {
	$ScheduleTypes_list->StopRecord = $ScheduleTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ScheduleTypes_list->TotalRecords > $ScheduleTypes_list->StartRecord + $ScheduleTypes_list->DisplayRecords - 1)
		$ScheduleTypes_list->StopRecord = $ScheduleTypes_list->StartRecord + $ScheduleTypes_list->DisplayRecords - 1;
	else
		$ScheduleTypes_list->StopRecord = $ScheduleTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($ScheduleTypes->isConfirm() || $ScheduleTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ScheduleTypes_list->FormKeyCountName) && ($ScheduleTypes_list->isGridAdd() || $ScheduleTypes_list->isGridEdit() || $ScheduleTypes->isConfirm())) {
		$ScheduleTypes_list->KeyCount = $CurrentForm->getValue($ScheduleTypes_list->FormKeyCountName);
		$ScheduleTypes_list->StopRecord = $ScheduleTypes_list->StartRecord + $ScheduleTypes_list->KeyCount - 1;
	}
}
$ScheduleTypes_list->RecordCount = $ScheduleTypes_list->StartRecord - 1;
if ($ScheduleTypes_list->Recordset && !$ScheduleTypes_list->Recordset->EOF) {
	$ScheduleTypes_list->Recordset->moveFirst();
	$selectLimit = $ScheduleTypes_list->UseSelectLimit;
	if (!$selectLimit && $ScheduleTypes_list->StartRecord > 1)
		$ScheduleTypes_list->Recordset->move($ScheduleTypes_list->StartRecord - 1);
} elseif (!$ScheduleTypes->AllowAddDeleteRow && $ScheduleTypes_list->StopRecord == 0) {
	$ScheduleTypes_list->StopRecord = $ScheduleTypes->GridAddRowCount;
}

// Initialize aggregate
$ScheduleTypes->RowType = ROWTYPE_AGGREGATEINIT;
$ScheduleTypes->resetAttributes();
$ScheduleTypes_list->renderRow();
$ScheduleTypes_list->EditRowCount = 0;
if ($ScheduleTypes_list->isEdit())
	$ScheduleTypes_list->RowIndex = 1;
if ($ScheduleTypes_list->isGridAdd())
	$ScheduleTypes_list->RowIndex = 0;
if ($ScheduleTypes_list->isGridEdit())
	$ScheduleTypes_list->RowIndex = 0;
while ($ScheduleTypes_list->RecordCount < $ScheduleTypes_list->StopRecord) {
	$ScheduleTypes_list->RecordCount++;
	if ($ScheduleTypes_list->RecordCount >= $ScheduleTypes_list->StartRecord) {
		$ScheduleTypes_list->RowCount++;
		if ($ScheduleTypes_list->isGridAdd() || $ScheduleTypes_list->isGridEdit() || $ScheduleTypes->isConfirm()) {
			$ScheduleTypes_list->RowIndex++;
			$CurrentForm->Index = $ScheduleTypes_list->RowIndex;
			if ($CurrentForm->hasValue($ScheduleTypes_list->FormActionName) && ($ScheduleTypes->isConfirm() || $ScheduleTypes_list->EventCancelled))
				$ScheduleTypes_list->RowAction = strval($CurrentForm->getValue($ScheduleTypes_list->FormActionName));
			elseif ($ScheduleTypes_list->isGridAdd())
				$ScheduleTypes_list->RowAction = "insert";
			else
				$ScheduleTypes_list->RowAction = "";
		}

		// Set up key count
		$ScheduleTypes_list->KeyCount = $ScheduleTypes_list->RowIndex;

		// Init row class and style
		$ScheduleTypes->resetAttributes();
		$ScheduleTypes->CssClass = "";
		if ($ScheduleTypes_list->isGridAdd()) {
			$ScheduleTypes_list->loadRowValues(); // Load default values
		} else {
			$ScheduleTypes_list->loadRowValues($ScheduleTypes_list->Recordset); // Load row values
		}
		$ScheduleTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($ScheduleTypes_list->isGridAdd()) // Grid add
			$ScheduleTypes->RowType = ROWTYPE_ADD; // Render add
		if ($ScheduleTypes_list->isGridAdd() && $ScheduleTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ScheduleTypes_list->restoreCurrentRowFormValues($ScheduleTypes_list->RowIndex); // Restore form values
		if ($ScheduleTypes_list->isEdit()) {
			if ($ScheduleTypes_list->checkInlineEditKey() && $ScheduleTypes_list->EditRowCount == 0) { // Inline edit
				$ScheduleTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($ScheduleTypes_list->isGridEdit()) { // Grid edit
			if ($ScheduleTypes->EventCancelled)
				$ScheduleTypes_list->restoreCurrentRowFormValues($ScheduleTypes_list->RowIndex); // Restore form values
			if ($ScheduleTypes_list->RowAction == "insert")
				$ScheduleTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$ScheduleTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ScheduleTypes_list->isEdit() && $ScheduleTypes->RowType == ROWTYPE_EDIT && $ScheduleTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$ScheduleTypes_list->restoreFormValues(); // Restore form values
		}
		if ($ScheduleTypes_list->isGridEdit() && ($ScheduleTypes->RowType == ROWTYPE_EDIT || $ScheduleTypes->RowType == ROWTYPE_ADD) && $ScheduleTypes->EventCancelled) // Update failed
			$ScheduleTypes_list->restoreCurrentRowFormValues($ScheduleTypes_list->RowIndex); // Restore form values
		if ($ScheduleTypes->RowType == ROWTYPE_EDIT) // Edit row
			$ScheduleTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$ScheduleTypes->RowAttrs->merge(["data-rowindex" => $ScheduleTypes_list->RowCount, "id" => "r" . $ScheduleTypes_list->RowCount . "_ScheduleTypes", "data-rowtype" => $ScheduleTypes->RowType]);

		// Render row
		$ScheduleTypes_list->renderRow();

		// Render list options
		$ScheduleTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ScheduleTypes_list->RowAction != "delete" && $ScheduleTypes_list->RowAction != "insertdelete" && !($ScheduleTypes_list->RowAction == "insert" && $ScheduleTypes->isConfirm() && $ScheduleTypes_list->emptyRow())) {
?>
	<tr <?php echo $ScheduleTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ScheduleTypes_list->ListOptions->render("body", "left", $ScheduleTypes_list->RowCount);
?>
	<?php if ($ScheduleTypes_list->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
		<td data-name="ScheduleType_Idn" <?php echo $ScheduleTypes_list->ScheduleType_Idn->cellAttributes() ?>>
<?php if ($ScheduleTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ScheduleType_Idn" class="form-group"></span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_ScheduleType_Idn" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_ScheduleType_Idn" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_ScheduleType_Idn" value="<?php echo HtmlEncode($ScheduleTypes_list->ScheduleType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ScheduleType_Idn" class="form-group">
<span<?php echo $ScheduleTypes_list->ScheduleType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ScheduleTypes_list->ScheduleType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_ScheduleType_Idn" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_ScheduleType_Idn" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_ScheduleType_Idn" value="<?php echo HtmlEncode($ScheduleTypes_list->ScheduleType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ScheduleType_Idn">
<span<?php echo $ScheduleTypes_list->ScheduleType_Idn->viewAttributes() ?>><?php echo $ScheduleTypes_list->ScheduleType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $ScheduleTypes_list->Name->cellAttributes() ?>>
<?php if ($ScheduleTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Name" class="form-group">
<input type="text" data-table="ScheduleTypes" data-field="x_Name" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Name" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->Name->EditValue ?>"<?php echo $ScheduleTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_Name" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_Name" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ScheduleTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Name" class="form-group">
<input type="text" data-table="ScheduleTypes" data-field="x_Name" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Name" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->Name->EditValue ?>"<?php echo $ScheduleTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Name">
<span<?php echo $ScheduleTypes_list->Name->viewAttributes() ?>><?php echo $ScheduleTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName" <?php echo $ScheduleTypes_list->ShortName->cellAttributes() ?>>
<?php if ($ScheduleTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ShortName" class="form-group">
<input type="text" data-table="ScheduleTypes" data-field="x_ShortName" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->ShortName->EditValue ?>"<?php echo $ScheduleTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_ShortName" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($ScheduleTypes_list->ShortName->OldValue) ?>">
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ShortName" class="form-group">
<input type="text" data-table="ScheduleTypes" data-field="x_ShortName" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->ShortName->EditValue ?>"<?php echo $ScheduleTypes_list->ShortName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ShortName">
<span<?php echo $ScheduleTypes_list->ShortName->viewAttributes() ?>><?php echo $ScheduleTypes_list->ShortName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $ScheduleTypes_list->Department_Idn->cellAttributes() ?>>
<?php if ($ScheduleTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ScheduleTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $ScheduleTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn"<?php echo $ScheduleTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $ScheduleTypes_list->Department_Idn->selectOptionListHtml("x{$ScheduleTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $ScheduleTypes_list->Department_Idn->Lookup->getParamTag($ScheduleTypes_list, "p_x" . $ScheduleTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_Department_Idn" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($ScheduleTypes_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ScheduleTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $ScheduleTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn"<?php echo $ScheduleTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $ScheduleTypes_list->Department_Idn->selectOptionListHtml("x{$ScheduleTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $ScheduleTypes_list->Department_Idn->Lookup->getParamTag($ScheduleTypes_list, "p_x" . $ScheduleTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Department_Idn">
<span<?php echo $ScheduleTypes_list->Department_Idn->viewAttributes() ?>><?php echo $ScheduleTypes_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $ScheduleTypes_list->Rank->cellAttributes() ?>>
<?php if ($ScheduleTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Rank" class="form-group">
<input type="text" data-table="ScheduleTypes" data-field="x_Rank" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->Rank->EditValue ?>"<?php echo $ScheduleTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_Rank" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ScheduleTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Rank" class="form-group">
<input type="text" data-table="ScheduleTypes" data-field="x_Rank" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->Rank->EditValue ?>"<?php echo $ScheduleTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_Rank">
<span<?php echo $ScheduleTypes_list->Rank->viewAttributes() ?>><?php echo $ScheduleTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $ScheduleTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($ScheduleTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ScheduleTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ScheduleTypes" data-field="x_ActiveFlag" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]_506213" value="1"<?php echo $selwrk ?><?php echo $ScheduleTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]_506213"></label>
</div>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_ActiveFlag" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ScheduleTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ScheduleTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ScheduleTypes" data-field="x_ActiveFlag" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]_901930" value="1"<?php echo $selwrk ?><?php echo $ScheduleTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]_901930"></label>
</div>
</span>
<?php } ?>
<?php if ($ScheduleTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ScheduleTypes_list->RowCount ?>_ScheduleTypes_ActiveFlag">
<span<?php echo $ScheduleTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ScheduleTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ScheduleTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ScheduleTypes_list->ListOptions->render("body", "right", $ScheduleTypes_list->RowCount);
?>
	</tr>
<?php if ($ScheduleTypes->RowType == ROWTYPE_ADD || $ScheduleTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fScheduleTypeslist", "load"], function() {
	fScheduleTypeslist.updateLists(<?php echo $ScheduleTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ScheduleTypes_list->isGridAdd())
		if (!$ScheduleTypes_list->Recordset->EOF)
			$ScheduleTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($ScheduleTypes_list->isGridAdd() || $ScheduleTypes_list->isGridEdit()) {
		$ScheduleTypes_list->RowIndex = '$rowindex$';
		$ScheduleTypes_list->loadRowValues();

		// Set row properties
		$ScheduleTypes->resetAttributes();
		$ScheduleTypes->RowAttrs->merge(["data-rowindex" => $ScheduleTypes_list->RowIndex, "id" => "r0_ScheduleTypes", "data-rowtype" => ROWTYPE_ADD]);
		$ScheduleTypes->RowAttrs->appendClass("ew-template");
		$ScheduleTypes->RowType = ROWTYPE_ADD;

		// Render row
		$ScheduleTypes_list->renderRow();

		// Render list options
		$ScheduleTypes_list->renderListOptions();
		$ScheduleTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $ScheduleTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ScheduleTypes_list->ListOptions->render("body", "left", $ScheduleTypes_list->RowIndex);
?>
	<?php if ($ScheduleTypes_list->ScheduleType_Idn->Visible) { // ScheduleType_Idn ?>
		<td data-name="ScheduleType_Idn">
<span id="el$rowindex$_ScheduleTypes_ScheduleType_Idn" class="form-group ScheduleTypes_ScheduleType_Idn"></span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_ScheduleType_Idn" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_ScheduleType_Idn" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_ScheduleType_Idn" value="<?php echo HtmlEncode($ScheduleTypes_list->ScheduleType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_ScheduleTypes_Name" class="form-group ScheduleTypes_Name">
<input type="text" data-table="ScheduleTypes" data-field="x_Name" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Name" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->Name->EditValue ?>"<?php echo $ScheduleTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_Name" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_Name" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ScheduleTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el$rowindex$_ScheduleTypes_ShortName" class="form-group ScheduleTypes_ShortName">
<input type="text" data-table="ScheduleTypes" data-field="x_ShortName" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->ShortName->EditValue ?>"<?php echo $ScheduleTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_ShortName" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($ScheduleTypes_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_ScheduleTypes_Department_Idn" class="form-group ScheduleTypes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ScheduleTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $ScheduleTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn"<?php echo $ScheduleTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $ScheduleTypes_list->Department_Idn->selectOptionListHtml("x{$ScheduleTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $ScheduleTypes_list->Department_Idn->Lookup->getParamTag($ScheduleTypes_list, "p_x" . $ScheduleTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_Department_Idn" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($ScheduleTypes_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_ScheduleTypes_Rank" class="form-group ScheduleTypes_Rank">
<input type="text" data-table="ScheduleTypes" data-field="x_Rank" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ScheduleTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ScheduleTypes_list->Rank->EditValue ?>"<?php echo $ScheduleTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_Rank" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ScheduleTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ScheduleTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_ScheduleTypes_ActiveFlag" class="form-group ScheduleTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($ScheduleTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ScheduleTypes" data-field="x_ActiveFlag" name="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]_386022" value="1"<?php echo $selwrk ?><?php echo $ScheduleTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]_386022"></label>
</div>
</span>
<input type="hidden" data-table="ScheduleTypes" data-field="x_ActiveFlag" name="o<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ScheduleTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ScheduleTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ScheduleTypes_list->ListOptions->render("body", "right", $ScheduleTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fScheduleTypeslist", "load"], function() {
	fScheduleTypeslist.updateLists(<?php echo $ScheduleTypes_list->RowIndex ?>);
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
<?php if ($ScheduleTypes_list->isAdd() || $ScheduleTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $ScheduleTypes_list->FormKeyCountName ?>" id="<?php echo $ScheduleTypes_list->FormKeyCountName ?>" value="<?php echo $ScheduleTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($ScheduleTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $ScheduleTypes_list->FormKeyCountName ?>" id="<?php echo $ScheduleTypes_list->FormKeyCountName ?>" value="<?php echo $ScheduleTypes_list->KeyCount ?>">
<?php echo $ScheduleTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($ScheduleTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $ScheduleTypes_list->FormKeyCountName ?>" id="<?php echo $ScheduleTypes_list->FormKeyCountName ?>" value="<?php echo $ScheduleTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($ScheduleTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $ScheduleTypes_list->FormKeyCountName ?>" id="<?php echo $ScheduleTypes_list->FormKeyCountName ?>" value="<?php echo $ScheduleTypes_list->KeyCount ?>">
<?php echo $ScheduleTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$ScheduleTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ScheduleTypes_list->Recordset)
	$ScheduleTypes_list->Recordset->Close();
?>
<?php if (!$ScheduleTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ScheduleTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ScheduleTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ScheduleTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ScheduleTypes_list->TotalRecords == 0 && !$ScheduleTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ScheduleTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ScheduleTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ScheduleTypes_list->isExport()) { ?>
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
$ScheduleTypes_list->terminate();
?>