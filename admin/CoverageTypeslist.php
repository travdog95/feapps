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
$CoverageTypes_list = new CoverageTypes_list();

// Run the page
$CoverageTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CoverageTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$CoverageTypes_list->isExport()) { ?>
<script>
var fCoverageTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fCoverageTypeslist = currentForm = new ew.Form("fCoverageTypeslist", "list");
	fCoverageTypeslist.formKeyCountName = '<?php echo $CoverageTypes_list->FormKeyCountName ?>';

	// Validate form
	fCoverageTypeslist.validate = function() {
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
			<?php if ($CoverageTypes_list->CoverageType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_CoverageType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CoverageTypes_list->CoverageType_Idn->caption(), $CoverageTypes_list->CoverageType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CoverageTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CoverageTypes_list->Name->caption(), $CoverageTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CoverageTypes_list->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CoverageTypes_list->ShortName->caption(), $CoverageTypes_list->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($CoverageTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CoverageTypes_list->Rank->caption(), $CoverageTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($CoverageTypes_list->Rank->errorMessage()) ?>");
			<?php if ($CoverageTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CoverageTypes_list->ActiveFlag->caption(), $CoverageTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fCoverageTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "ShortName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fCoverageTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCoverageTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fCoverageTypeslist.lists["x_ActiveFlag[]"] = <?php echo $CoverageTypes_list->ActiveFlag->Lookup->toClientList($CoverageTypes_list) ?>;
	fCoverageTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($CoverageTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fCoverageTypeslist");
});
var fCoverageTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fCoverageTypeslistsrch = currentSearchForm = new ew.Form("fCoverageTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fCoverageTypeslistsrch.filterList = <?php echo $CoverageTypes_list->getFilterList() ?>;
	loadjs.done("fCoverageTypeslistsrch");
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
<?php if (!$CoverageTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($CoverageTypes_list->TotalRecords > 0 && $CoverageTypes_list->ExportOptions->visible()) { ?>
<?php $CoverageTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($CoverageTypes_list->ImportOptions->visible()) { ?>
<?php $CoverageTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($CoverageTypes_list->SearchOptions->visible()) { ?>
<?php $CoverageTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($CoverageTypes_list->FilterOptions->visible()) { ?>
<?php $CoverageTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$CoverageTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$CoverageTypes_list->isExport() && !$CoverageTypes->CurrentAction) { ?>
<form name="fCoverageTypeslistsrch" id="fCoverageTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fCoverageTypeslistsrch-search-panel" class="<?php echo $CoverageTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="CoverageTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $CoverageTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($CoverageTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($CoverageTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $CoverageTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($CoverageTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($CoverageTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($CoverageTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($CoverageTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $CoverageTypes_list->showPageHeader(); ?>
<?php
$CoverageTypes_list->showMessage();
?>
<?php if ($CoverageTypes_list->TotalRecords > 0 || $CoverageTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($CoverageTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> CoverageTypes">
<?php if (!$CoverageTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$CoverageTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $CoverageTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $CoverageTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fCoverageTypeslist" id="fCoverageTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CoverageTypes">
<div id="gmp_CoverageTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($CoverageTypes_list->TotalRecords > 0 || $CoverageTypes_list->isAdd() || $CoverageTypes_list->isCopy() || $CoverageTypes_list->isGridEdit()) { ?>
<table id="tbl_CoverageTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$CoverageTypes->RowType = ROWTYPE_HEADER;

// Render list options
$CoverageTypes_list->renderListOptions();

// Render list options (header, left)
$CoverageTypes_list->ListOptions->render("header", "left");
?>
<?php if ($CoverageTypes_list->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
	<?php if ($CoverageTypes_list->SortUrl($CoverageTypes_list->CoverageType_Idn) == "") { ?>
		<th data-name="CoverageType_Idn" class="<?php echo $CoverageTypes_list->CoverageType_Idn->headerCellClass() ?>"><div id="elh_CoverageTypes_CoverageType_Idn" class="CoverageTypes_CoverageType_Idn"><div class="ew-table-header-caption"><?php echo $CoverageTypes_list->CoverageType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CoverageType_Idn" class="<?php echo $CoverageTypes_list->CoverageType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CoverageTypes_list->SortUrl($CoverageTypes_list->CoverageType_Idn) ?>', 1);"><div id="elh_CoverageTypes_CoverageType_Idn" class="CoverageTypes_CoverageType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CoverageTypes_list->CoverageType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($CoverageTypes_list->CoverageType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CoverageTypes_list->CoverageType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CoverageTypes_list->Name->Visible) { // Name ?>
	<?php if ($CoverageTypes_list->SortUrl($CoverageTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $CoverageTypes_list->Name->headerCellClass() ?>"><div id="elh_CoverageTypes_Name" class="CoverageTypes_Name"><div class="ew-table-header-caption"><?php echo $CoverageTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $CoverageTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CoverageTypes_list->SortUrl($CoverageTypes_list->Name) ?>', 1);"><div id="elh_CoverageTypes_Name" class="CoverageTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CoverageTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($CoverageTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CoverageTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CoverageTypes_list->ShortName->Visible) { // ShortName ?>
	<?php if ($CoverageTypes_list->SortUrl($CoverageTypes_list->ShortName) == "") { ?>
		<th data-name="ShortName" class="<?php echo $CoverageTypes_list->ShortName->headerCellClass() ?>"><div id="elh_CoverageTypes_ShortName" class="CoverageTypes_ShortName"><div class="ew-table-header-caption"><?php echo $CoverageTypes_list->ShortName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShortName" class="<?php echo $CoverageTypes_list->ShortName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CoverageTypes_list->SortUrl($CoverageTypes_list->ShortName) ?>', 1);"><div id="elh_CoverageTypes_ShortName" class="CoverageTypes_ShortName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CoverageTypes_list->ShortName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($CoverageTypes_list->ShortName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CoverageTypes_list->ShortName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CoverageTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($CoverageTypes_list->SortUrl($CoverageTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $CoverageTypes_list->Rank->headerCellClass() ?>"><div id="elh_CoverageTypes_Rank" class="CoverageTypes_Rank"><div class="ew-table-header-caption"><?php echo $CoverageTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $CoverageTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CoverageTypes_list->SortUrl($CoverageTypes_list->Rank) ?>', 1);"><div id="elh_CoverageTypes_Rank" class="CoverageTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CoverageTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($CoverageTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CoverageTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CoverageTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($CoverageTypes_list->SortUrl($CoverageTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $CoverageTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_CoverageTypes_ActiveFlag" class="CoverageTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $CoverageTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $CoverageTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $CoverageTypes_list->SortUrl($CoverageTypes_list->ActiveFlag) ?>', 1);"><div id="elh_CoverageTypes_ActiveFlag" class="CoverageTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CoverageTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($CoverageTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($CoverageTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$CoverageTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($CoverageTypes_list->isAdd() || $CoverageTypes_list->isCopy()) {
		$CoverageTypes_list->RowIndex = 0;
		$CoverageTypes_list->KeyCount = $CoverageTypes_list->RowIndex;
		if ($CoverageTypes_list->isCopy() && !$CoverageTypes_list->loadRow())
			$CoverageTypes->CurrentAction = "add";
		if ($CoverageTypes_list->isAdd())
			$CoverageTypes_list->loadRowValues();
		if ($CoverageTypes->EventCancelled) // Insert failed
			$CoverageTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$CoverageTypes->resetAttributes();
		$CoverageTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_CoverageTypes", "data-rowtype" => ROWTYPE_ADD]);
		$CoverageTypes->RowType = ROWTYPE_ADD;

		// Render row
		$CoverageTypes_list->renderRow();

		// Render list options
		$CoverageTypes_list->renderListOptions();
		$CoverageTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $CoverageTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CoverageTypes_list->ListOptions->render("body", "left", $CoverageTypes_list->RowCount);
?>
	<?php if ($CoverageTypes_list->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
		<td data-name="CoverageType_Idn">
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_CoverageType_Idn" class="form-group CoverageTypes_CoverageType_Idn"></span>
<input type="hidden" data-table="CoverageTypes" data-field="x_CoverageType_Idn" name="o<?php echo $CoverageTypes_list->RowIndex ?>_CoverageType_Idn" id="o<?php echo $CoverageTypes_list->RowIndex ?>_CoverageType_Idn" value="<?php echo HtmlEncode($CoverageTypes_list->CoverageType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_Name" class="form-group CoverageTypes_Name">
<input type="text" data-table="CoverageTypes" data-field="x_Name" name="x<?php echo $CoverageTypes_list->RowIndex ?>_Name" id="x<?php echo $CoverageTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CoverageTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->Name->EditValue ?>"<?php echo $CoverageTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_Name" name="o<?php echo $CoverageTypes_list->RowIndex ?>_Name" id="o<?php echo $CoverageTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($CoverageTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_ShortName" class="form-group CoverageTypes_ShortName">
<input type="text" data-table="CoverageTypes" data-field="x_ShortName" name="x<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" id="x<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($CoverageTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->ShortName->EditValue ?>"<?php echo $CoverageTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_ShortName" name="o<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" id="o<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($CoverageTypes_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_Rank" class="form-group CoverageTypes_Rank">
<input type="text" data-table="CoverageTypes" data-field="x_Rank" name="x<?php echo $CoverageTypes_list->RowIndex ?>_Rank" id="x<?php echo $CoverageTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CoverageTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->Rank->EditValue ?>"<?php echo $CoverageTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_Rank" name="o<?php echo $CoverageTypes_list->RowIndex ?>_Rank" id="o<?php echo $CoverageTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($CoverageTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_ActiveFlag" class="form-group CoverageTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($CoverageTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CoverageTypes" data-field="x_ActiveFlag" name="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]_440390" value="1"<?php echo $selwrk ?><?php echo $CoverageTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]_440390"></label>
</div>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_ActiveFlag" name="o<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($CoverageTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CoverageTypes_list->ListOptions->render("body", "right", $CoverageTypes_list->RowCount);
?>
<script>
loadjs.ready(["fCoverageTypeslist", "load"], function() {
	fCoverageTypeslist.updateLists(<?php echo $CoverageTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($CoverageTypes_list->ExportAll && $CoverageTypes_list->isExport()) {
	$CoverageTypes_list->StopRecord = $CoverageTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($CoverageTypes_list->TotalRecords > $CoverageTypes_list->StartRecord + $CoverageTypes_list->DisplayRecords - 1)
		$CoverageTypes_list->StopRecord = $CoverageTypes_list->StartRecord + $CoverageTypes_list->DisplayRecords - 1;
	else
		$CoverageTypes_list->StopRecord = $CoverageTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($CoverageTypes->isConfirm() || $CoverageTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($CoverageTypes_list->FormKeyCountName) && ($CoverageTypes_list->isGridAdd() || $CoverageTypes_list->isGridEdit() || $CoverageTypes->isConfirm())) {
		$CoverageTypes_list->KeyCount = $CurrentForm->getValue($CoverageTypes_list->FormKeyCountName);
		$CoverageTypes_list->StopRecord = $CoverageTypes_list->StartRecord + $CoverageTypes_list->KeyCount - 1;
	}
}
$CoverageTypes_list->RecordCount = $CoverageTypes_list->StartRecord - 1;
if ($CoverageTypes_list->Recordset && !$CoverageTypes_list->Recordset->EOF) {
	$CoverageTypes_list->Recordset->moveFirst();
	$selectLimit = $CoverageTypes_list->UseSelectLimit;
	if (!$selectLimit && $CoverageTypes_list->StartRecord > 1)
		$CoverageTypes_list->Recordset->move($CoverageTypes_list->StartRecord - 1);
} elseif (!$CoverageTypes->AllowAddDeleteRow && $CoverageTypes_list->StopRecord == 0) {
	$CoverageTypes_list->StopRecord = $CoverageTypes->GridAddRowCount;
}

// Initialize aggregate
$CoverageTypes->RowType = ROWTYPE_AGGREGATEINIT;
$CoverageTypes->resetAttributes();
$CoverageTypes_list->renderRow();
$CoverageTypes_list->EditRowCount = 0;
if ($CoverageTypes_list->isEdit())
	$CoverageTypes_list->RowIndex = 1;
if ($CoverageTypes_list->isGridAdd())
	$CoverageTypes_list->RowIndex = 0;
if ($CoverageTypes_list->isGridEdit())
	$CoverageTypes_list->RowIndex = 0;
while ($CoverageTypes_list->RecordCount < $CoverageTypes_list->StopRecord) {
	$CoverageTypes_list->RecordCount++;
	if ($CoverageTypes_list->RecordCount >= $CoverageTypes_list->StartRecord) {
		$CoverageTypes_list->RowCount++;
		if ($CoverageTypes_list->isGridAdd() || $CoverageTypes_list->isGridEdit() || $CoverageTypes->isConfirm()) {
			$CoverageTypes_list->RowIndex++;
			$CurrentForm->Index = $CoverageTypes_list->RowIndex;
			if ($CurrentForm->hasValue($CoverageTypes_list->FormActionName) && ($CoverageTypes->isConfirm() || $CoverageTypes_list->EventCancelled))
				$CoverageTypes_list->RowAction = strval($CurrentForm->getValue($CoverageTypes_list->FormActionName));
			elseif ($CoverageTypes_list->isGridAdd())
				$CoverageTypes_list->RowAction = "insert";
			else
				$CoverageTypes_list->RowAction = "";
		}

		// Set up key count
		$CoverageTypes_list->KeyCount = $CoverageTypes_list->RowIndex;

		// Init row class and style
		$CoverageTypes->resetAttributes();
		$CoverageTypes->CssClass = "";
		if ($CoverageTypes_list->isGridAdd()) {
			$CoverageTypes_list->loadRowValues(); // Load default values
		} else {
			$CoverageTypes_list->loadRowValues($CoverageTypes_list->Recordset); // Load row values
		}
		$CoverageTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($CoverageTypes_list->isGridAdd()) // Grid add
			$CoverageTypes->RowType = ROWTYPE_ADD; // Render add
		if ($CoverageTypes_list->isGridAdd() && $CoverageTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$CoverageTypes_list->restoreCurrentRowFormValues($CoverageTypes_list->RowIndex); // Restore form values
		if ($CoverageTypes_list->isEdit()) {
			if ($CoverageTypes_list->checkInlineEditKey() && $CoverageTypes_list->EditRowCount == 0) { // Inline edit
				$CoverageTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($CoverageTypes_list->isGridEdit()) { // Grid edit
			if ($CoverageTypes->EventCancelled)
				$CoverageTypes_list->restoreCurrentRowFormValues($CoverageTypes_list->RowIndex); // Restore form values
			if ($CoverageTypes_list->RowAction == "insert")
				$CoverageTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$CoverageTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($CoverageTypes_list->isEdit() && $CoverageTypes->RowType == ROWTYPE_EDIT && $CoverageTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$CoverageTypes_list->restoreFormValues(); // Restore form values
		}
		if ($CoverageTypes_list->isGridEdit() && ($CoverageTypes->RowType == ROWTYPE_EDIT || $CoverageTypes->RowType == ROWTYPE_ADD) && $CoverageTypes->EventCancelled) // Update failed
			$CoverageTypes_list->restoreCurrentRowFormValues($CoverageTypes_list->RowIndex); // Restore form values
		if ($CoverageTypes->RowType == ROWTYPE_EDIT) // Edit row
			$CoverageTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$CoverageTypes->RowAttrs->merge(["data-rowindex" => $CoverageTypes_list->RowCount, "id" => "r" . $CoverageTypes_list->RowCount . "_CoverageTypes", "data-rowtype" => $CoverageTypes->RowType]);

		// Render row
		$CoverageTypes_list->renderRow();

		// Render list options
		$CoverageTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($CoverageTypes_list->RowAction != "delete" && $CoverageTypes_list->RowAction != "insertdelete" && !($CoverageTypes_list->RowAction == "insert" && $CoverageTypes->isConfirm() && $CoverageTypes_list->emptyRow())) {
?>
	<tr <?php echo $CoverageTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CoverageTypes_list->ListOptions->render("body", "left", $CoverageTypes_list->RowCount);
?>
	<?php if ($CoverageTypes_list->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
		<td data-name="CoverageType_Idn" <?php echo $CoverageTypes_list->CoverageType_Idn->cellAttributes() ?>>
<?php if ($CoverageTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_CoverageType_Idn" class="form-group"></span>
<input type="hidden" data-table="CoverageTypes" data-field="x_CoverageType_Idn" name="o<?php echo $CoverageTypes_list->RowIndex ?>_CoverageType_Idn" id="o<?php echo $CoverageTypes_list->RowIndex ?>_CoverageType_Idn" value="<?php echo HtmlEncode($CoverageTypes_list->CoverageType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($CoverageTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_CoverageType_Idn" class="form-group">
<span<?php echo $CoverageTypes_list->CoverageType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($CoverageTypes_list->CoverageType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_CoverageType_Idn" name="x<?php echo $CoverageTypes_list->RowIndex ?>_CoverageType_Idn" id="x<?php echo $CoverageTypes_list->RowIndex ?>_CoverageType_Idn" value="<?php echo HtmlEncode($CoverageTypes_list->CoverageType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($CoverageTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_CoverageType_Idn">
<span<?php echo $CoverageTypes_list->CoverageType_Idn->viewAttributes() ?>><?php echo $CoverageTypes_list->CoverageType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $CoverageTypes_list->Name->cellAttributes() ?>>
<?php if ($CoverageTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_Name" class="form-group">
<input type="text" data-table="CoverageTypes" data-field="x_Name" name="x<?php echo $CoverageTypes_list->RowIndex ?>_Name" id="x<?php echo $CoverageTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CoverageTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->Name->EditValue ?>"<?php echo $CoverageTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_Name" name="o<?php echo $CoverageTypes_list->RowIndex ?>_Name" id="o<?php echo $CoverageTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($CoverageTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($CoverageTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_Name" class="form-group">
<input type="text" data-table="CoverageTypes" data-field="x_Name" name="x<?php echo $CoverageTypes_list->RowIndex ?>_Name" id="x<?php echo $CoverageTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CoverageTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->Name->EditValue ?>"<?php echo $CoverageTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($CoverageTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_Name">
<span<?php echo $CoverageTypes_list->Name->viewAttributes() ?>><?php echo $CoverageTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName" <?php echo $CoverageTypes_list->ShortName->cellAttributes() ?>>
<?php if ($CoverageTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_ShortName" class="form-group">
<input type="text" data-table="CoverageTypes" data-field="x_ShortName" name="x<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" id="x<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($CoverageTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->ShortName->EditValue ?>"<?php echo $CoverageTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_ShortName" name="o<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" id="o<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($CoverageTypes_list->ShortName->OldValue) ?>">
<?php } ?>
<?php if ($CoverageTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_ShortName" class="form-group">
<input type="text" data-table="CoverageTypes" data-field="x_ShortName" name="x<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" id="x<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($CoverageTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->ShortName->EditValue ?>"<?php echo $CoverageTypes_list->ShortName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($CoverageTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_ShortName">
<span<?php echo $CoverageTypes_list->ShortName->viewAttributes() ?>><?php echo $CoverageTypes_list->ShortName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $CoverageTypes_list->Rank->cellAttributes() ?>>
<?php if ($CoverageTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_Rank" class="form-group">
<input type="text" data-table="CoverageTypes" data-field="x_Rank" name="x<?php echo $CoverageTypes_list->RowIndex ?>_Rank" id="x<?php echo $CoverageTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CoverageTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->Rank->EditValue ?>"<?php echo $CoverageTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_Rank" name="o<?php echo $CoverageTypes_list->RowIndex ?>_Rank" id="o<?php echo $CoverageTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($CoverageTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($CoverageTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_Rank" class="form-group">
<input type="text" data-table="CoverageTypes" data-field="x_Rank" name="x<?php echo $CoverageTypes_list->RowIndex ?>_Rank" id="x<?php echo $CoverageTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CoverageTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->Rank->EditValue ?>"<?php echo $CoverageTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($CoverageTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_Rank">
<span<?php echo $CoverageTypes_list->Rank->viewAttributes() ?>><?php echo $CoverageTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $CoverageTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($CoverageTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($CoverageTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CoverageTypes" data-field="x_ActiveFlag" name="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]_192881" value="1"<?php echo $selwrk ?><?php echo $CoverageTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]_192881"></label>
</div>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_ActiveFlag" name="o<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($CoverageTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($CoverageTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($CoverageTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CoverageTypes" data-field="x_ActiveFlag" name="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]_259058" value="1"<?php echo $selwrk ?><?php echo $CoverageTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]_259058"></label>
</div>
</span>
<?php } ?>
<?php if ($CoverageTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CoverageTypes_list->RowCount ?>_CoverageTypes_ActiveFlag">
<span<?php echo $CoverageTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $CoverageTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($CoverageTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CoverageTypes_list->ListOptions->render("body", "right", $CoverageTypes_list->RowCount);
?>
	</tr>
<?php if ($CoverageTypes->RowType == ROWTYPE_ADD || $CoverageTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fCoverageTypeslist", "load"], function() {
	fCoverageTypeslist.updateLists(<?php echo $CoverageTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$CoverageTypes_list->isGridAdd())
		if (!$CoverageTypes_list->Recordset->EOF)
			$CoverageTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($CoverageTypes_list->isGridAdd() || $CoverageTypes_list->isGridEdit()) {
		$CoverageTypes_list->RowIndex = '$rowindex$';
		$CoverageTypes_list->loadRowValues();

		// Set row properties
		$CoverageTypes->resetAttributes();
		$CoverageTypes->RowAttrs->merge(["data-rowindex" => $CoverageTypes_list->RowIndex, "id" => "r0_CoverageTypes", "data-rowtype" => ROWTYPE_ADD]);
		$CoverageTypes->RowAttrs->appendClass("ew-template");
		$CoverageTypes->RowType = ROWTYPE_ADD;

		// Render row
		$CoverageTypes_list->renderRow();

		// Render list options
		$CoverageTypes_list->renderListOptions();
		$CoverageTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $CoverageTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CoverageTypes_list->ListOptions->render("body", "left", $CoverageTypes_list->RowIndex);
?>
	<?php if ($CoverageTypes_list->CoverageType_Idn->Visible) { // CoverageType_Idn ?>
		<td data-name="CoverageType_Idn">
<span id="el$rowindex$_CoverageTypes_CoverageType_Idn" class="form-group CoverageTypes_CoverageType_Idn"></span>
<input type="hidden" data-table="CoverageTypes" data-field="x_CoverageType_Idn" name="o<?php echo $CoverageTypes_list->RowIndex ?>_CoverageType_Idn" id="o<?php echo $CoverageTypes_list->RowIndex ?>_CoverageType_Idn" value="<?php echo HtmlEncode($CoverageTypes_list->CoverageType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_CoverageTypes_Name" class="form-group CoverageTypes_Name">
<input type="text" data-table="CoverageTypes" data-field="x_Name" name="x<?php echo $CoverageTypes_list->RowIndex ?>_Name" id="x<?php echo $CoverageTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($CoverageTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->Name->EditValue ?>"<?php echo $CoverageTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_Name" name="o<?php echo $CoverageTypes_list->RowIndex ?>_Name" id="o<?php echo $CoverageTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($CoverageTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el$rowindex$_CoverageTypes_ShortName" class="form-group CoverageTypes_ShortName">
<input type="text" data-table="CoverageTypes" data-field="x_ShortName" name="x<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" id="x<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($CoverageTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->ShortName->EditValue ?>"<?php echo $CoverageTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_ShortName" name="o<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" id="o<?php echo $CoverageTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($CoverageTypes_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_CoverageTypes_Rank" class="form-group CoverageTypes_Rank">
<input type="text" data-table="CoverageTypes" data-field="x_Rank" name="x<?php echo $CoverageTypes_list->RowIndex ?>_Rank" id="x<?php echo $CoverageTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($CoverageTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $CoverageTypes_list->Rank->EditValue ?>"<?php echo $CoverageTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_Rank" name="o<?php echo $CoverageTypes_list->RowIndex ?>_Rank" id="o<?php echo $CoverageTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($CoverageTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CoverageTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_CoverageTypes_ActiveFlag" class="form-group CoverageTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($CoverageTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="CoverageTypes" data-field="x_ActiveFlag" name="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]_567402" value="1"<?php echo $selwrk ?><?php echo $CoverageTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]_567402"></label>
</div>
</span>
<input type="hidden" data-table="CoverageTypes" data-field="x_ActiveFlag" name="o<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $CoverageTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($CoverageTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CoverageTypes_list->ListOptions->render("body", "right", $CoverageTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fCoverageTypeslist", "load"], function() {
	fCoverageTypeslist.updateLists(<?php echo $CoverageTypes_list->RowIndex ?>);
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
<?php if ($CoverageTypes_list->isAdd() || $CoverageTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $CoverageTypes_list->FormKeyCountName ?>" id="<?php echo $CoverageTypes_list->FormKeyCountName ?>" value="<?php echo $CoverageTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($CoverageTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $CoverageTypes_list->FormKeyCountName ?>" id="<?php echo $CoverageTypes_list->FormKeyCountName ?>" value="<?php echo $CoverageTypes_list->KeyCount ?>">
<?php echo $CoverageTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($CoverageTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $CoverageTypes_list->FormKeyCountName ?>" id="<?php echo $CoverageTypes_list->FormKeyCountName ?>" value="<?php echo $CoverageTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($CoverageTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $CoverageTypes_list->FormKeyCountName ?>" id="<?php echo $CoverageTypes_list->FormKeyCountName ?>" value="<?php echo $CoverageTypes_list->KeyCount ?>">
<?php echo $CoverageTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$CoverageTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($CoverageTypes_list->Recordset)
	$CoverageTypes_list->Recordset->Close();
?>
<?php if (!$CoverageTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$CoverageTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $CoverageTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $CoverageTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($CoverageTypes_list->TotalRecords == 0 && !$CoverageTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $CoverageTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$CoverageTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$CoverageTypes_list->isExport()) { ?>
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
$CoverageTypes_list->terminate();
?>