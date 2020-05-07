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
$FinishTypes_list = new FinishTypes_list();

// Run the page
$FinishTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FinishTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$FinishTypes_list->isExport()) { ?>
<script>
var fFinishTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fFinishTypeslist = currentForm = new ew.Form("fFinishTypeslist", "list");
	fFinishTypeslist.formKeyCountName = '<?php echo $FinishTypes_list->FormKeyCountName ?>';

	// Validate form
	fFinishTypeslist.validate = function() {
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
			<?php if ($FinishTypes_list->FinishType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FinishType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishTypes_list->FinishType_Idn->caption(), $FinishTypes_list->FinishType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FinishTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishTypes_list->Name->caption(), $FinishTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FinishTypes_list->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishTypes_list->ShortName->caption(), $FinishTypes_list->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FinishTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishTypes_list->Rank->caption(), $FinishTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($FinishTypes_list->Rank->errorMessage()) ?>");
			<?php if ($FinishTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishTypes_list->ActiveFlag->caption(), $FinishTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fFinishTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "ShortName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fFinishTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fFinishTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fFinishTypeslist.lists["x_ActiveFlag[]"] = <?php echo $FinishTypes_list->ActiveFlag->Lookup->toClientList($FinishTypes_list) ?>;
	fFinishTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($FinishTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fFinishTypeslist");
});
var fFinishTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fFinishTypeslistsrch = currentSearchForm = new ew.Form("fFinishTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fFinishTypeslistsrch.filterList = <?php echo $FinishTypes_list->getFilterList() ?>;
	loadjs.done("fFinishTypeslistsrch");
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
<?php if (!$FinishTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($FinishTypes_list->TotalRecords > 0 && $FinishTypes_list->ExportOptions->visible()) { ?>
<?php $FinishTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($FinishTypes_list->ImportOptions->visible()) { ?>
<?php $FinishTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($FinishTypes_list->SearchOptions->visible()) { ?>
<?php $FinishTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($FinishTypes_list->FilterOptions->visible()) { ?>
<?php $FinishTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$FinishTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$FinishTypes_list->isExport() && !$FinishTypes->CurrentAction) { ?>
<form name="fFinishTypeslistsrch" id="fFinishTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fFinishTypeslistsrch-search-panel" class="<?php echo $FinishTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="FinishTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $FinishTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($FinishTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($FinishTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $FinishTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($FinishTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($FinishTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($FinishTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($FinishTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $FinishTypes_list->showPageHeader(); ?>
<?php
$FinishTypes_list->showMessage();
?>
<?php if ($FinishTypes_list->TotalRecords > 0 || $FinishTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($FinishTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> FinishTypes">
<?php if (!$FinishTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$FinishTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FinishTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $FinishTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fFinishTypeslist" id="fFinishTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FinishTypes">
<div id="gmp_FinishTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($FinishTypes_list->TotalRecords > 0 || $FinishTypes_list->isAdd() || $FinishTypes_list->isCopy() || $FinishTypes_list->isGridEdit()) { ?>
<table id="tbl_FinishTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$FinishTypes->RowType = ROWTYPE_HEADER;

// Render list options
$FinishTypes_list->renderListOptions();

// Render list options (header, left)
$FinishTypes_list->ListOptions->render("header", "left");
?>
<?php if ($FinishTypes_list->FinishType_Idn->Visible) { // FinishType_Idn ?>
	<?php if ($FinishTypes_list->SortUrl($FinishTypes_list->FinishType_Idn) == "") { ?>
		<th data-name="FinishType_Idn" class="<?php echo $FinishTypes_list->FinishType_Idn->headerCellClass() ?>"><div id="elh_FinishTypes_FinishType_Idn" class="FinishTypes_FinishType_Idn"><div class="ew-table-header-caption"><?php echo $FinishTypes_list->FinishType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinishType_Idn" class="<?php echo $FinishTypes_list->FinishType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FinishTypes_list->SortUrl($FinishTypes_list->FinishType_Idn) ?>', 1);"><div id="elh_FinishTypes_FinishType_Idn" class="FinishTypes_FinishType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FinishTypes_list->FinishType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($FinishTypes_list->FinishType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FinishTypes_list->FinishType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FinishTypes_list->Name->Visible) { // Name ?>
	<?php if ($FinishTypes_list->SortUrl($FinishTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $FinishTypes_list->Name->headerCellClass() ?>"><div id="elh_FinishTypes_Name" class="FinishTypes_Name"><div class="ew-table-header-caption"><?php echo $FinishTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $FinishTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FinishTypes_list->SortUrl($FinishTypes_list->Name) ?>', 1);"><div id="elh_FinishTypes_Name" class="FinishTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FinishTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($FinishTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FinishTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FinishTypes_list->ShortName->Visible) { // ShortName ?>
	<?php if ($FinishTypes_list->SortUrl($FinishTypes_list->ShortName) == "") { ?>
		<th data-name="ShortName" class="<?php echo $FinishTypes_list->ShortName->headerCellClass() ?>"><div id="elh_FinishTypes_ShortName" class="FinishTypes_ShortName"><div class="ew-table-header-caption"><?php echo $FinishTypes_list->ShortName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShortName" class="<?php echo $FinishTypes_list->ShortName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FinishTypes_list->SortUrl($FinishTypes_list->ShortName) ?>', 1);"><div id="elh_FinishTypes_ShortName" class="FinishTypes_ShortName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FinishTypes_list->ShortName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($FinishTypes_list->ShortName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FinishTypes_list->ShortName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FinishTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($FinishTypes_list->SortUrl($FinishTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $FinishTypes_list->Rank->headerCellClass() ?>"><div id="elh_FinishTypes_Rank" class="FinishTypes_Rank"><div class="ew-table-header-caption"><?php echo $FinishTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $FinishTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FinishTypes_list->SortUrl($FinishTypes_list->Rank) ?>', 1);"><div id="elh_FinishTypes_Rank" class="FinishTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FinishTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($FinishTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FinishTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FinishTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($FinishTypes_list->SortUrl($FinishTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $FinishTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_FinishTypes_ActiveFlag" class="FinishTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $FinishTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $FinishTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FinishTypes_list->SortUrl($FinishTypes_list->ActiveFlag) ?>', 1);"><div id="elh_FinishTypes_ActiveFlag" class="FinishTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FinishTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($FinishTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FinishTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$FinishTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($FinishTypes_list->isAdd() || $FinishTypes_list->isCopy()) {
		$FinishTypes_list->RowIndex = 0;
		$FinishTypes_list->KeyCount = $FinishTypes_list->RowIndex;
		if ($FinishTypes_list->isCopy() && !$FinishTypes_list->loadRow())
			$FinishTypes->CurrentAction = "add";
		if ($FinishTypes_list->isAdd())
			$FinishTypes_list->loadRowValues();
		if ($FinishTypes->EventCancelled) // Insert failed
			$FinishTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$FinishTypes->resetAttributes();
		$FinishTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_FinishTypes", "data-rowtype" => ROWTYPE_ADD]);
		$FinishTypes->RowType = ROWTYPE_ADD;

		// Render row
		$FinishTypes_list->renderRow();

		// Render list options
		$FinishTypes_list->renderListOptions();
		$FinishTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $FinishTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FinishTypes_list->ListOptions->render("body", "left", $FinishTypes_list->RowCount);
?>
	<?php if ($FinishTypes_list->FinishType_Idn->Visible) { // FinishType_Idn ?>
		<td data-name="FinishType_Idn">
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_FinishType_Idn" class="form-group FinishTypes_FinishType_Idn"></span>
<input type="hidden" data-table="FinishTypes" data-field="x_FinishType_Idn" name="o<?php echo $FinishTypes_list->RowIndex ?>_FinishType_Idn" id="o<?php echo $FinishTypes_list->RowIndex ?>_FinishType_Idn" value="<?php echo HtmlEncode($FinishTypes_list->FinishType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_Name" class="form-group FinishTypes_Name">
<input type="text" data-table="FinishTypes" data-field="x_Name" name="x<?php echo $FinishTypes_list->RowIndex ?>_Name" id="x<?php echo $FinishTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FinishTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->Name->EditValue ?>"<?php echo $FinishTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_Name" name="o<?php echo $FinishTypes_list->RowIndex ?>_Name" id="o<?php echo $FinishTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FinishTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_ShortName" class="form-group FinishTypes_ShortName">
<input type="text" data-table="FinishTypes" data-field="x_ShortName" name="x<?php echo $FinishTypes_list->RowIndex ?>_ShortName" id="x<?php echo $FinishTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($FinishTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->ShortName->EditValue ?>"<?php echo $FinishTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_ShortName" name="o<?php echo $FinishTypes_list->RowIndex ?>_ShortName" id="o<?php echo $FinishTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($FinishTypes_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_Rank" class="form-group FinishTypes_Rank">
<input type="text" data-table="FinishTypes" data-field="x_Rank" name="x<?php echo $FinishTypes_list->RowIndex ?>_Rank" id="x<?php echo $FinishTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FinishTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->Rank->EditValue ?>"<?php echo $FinishTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_Rank" name="o<?php echo $FinishTypes_list->RowIndex ?>_Rank" id="o<?php echo $FinishTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FinishTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_ActiveFlag" class="form-group FinishTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($FinishTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FinishTypes" data-field="x_ActiveFlag" name="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]_437273" value="1"<?php echo $selwrk ?><?php echo $FinishTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]_437273"></label>
</div>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_ActiveFlag" name="o<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FinishTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FinishTypes_list->ListOptions->render("body", "right", $FinishTypes_list->RowCount);
?>
<script>
loadjs.ready(["fFinishTypeslist", "load"], function() {
	fFinishTypeslist.updateLists(<?php echo $FinishTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($FinishTypes_list->ExportAll && $FinishTypes_list->isExport()) {
	$FinishTypes_list->StopRecord = $FinishTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($FinishTypes_list->TotalRecords > $FinishTypes_list->StartRecord + $FinishTypes_list->DisplayRecords - 1)
		$FinishTypes_list->StopRecord = $FinishTypes_list->StartRecord + $FinishTypes_list->DisplayRecords - 1;
	else
		$FinishTypes_list->StopRecord = $FinishTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($FinishTypes->isConfirm() || $FinishTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($FinishTypes_list->FormKeyCountName) && ($FinishTypes_list->isGridAdd() || $FinishTypes_list->isGridEdit() || $FinishTypes->isConfirm())) {
		$FinishTypes_list->KeyCount = $CurrentForm->getValue($FinishTypes_list->FormKeyCountName);
		$FinishTypes_list->StopRecord = $FinishTypes_list->StartRecord + $FinishTypes_list->KeyCount - 1;
	}
}
$FinishTypes_list->RecordCount = $FinishTypes_list->StartRecord - 1;
if ($FinishTypes_list->Recordset && !$FinishTypes_list->Recordset->EOF) {
	$FinishTypes_list->Recordset->moveFirst();
	$selectLimit = $FinishTypes_list->UseSelectLimit;
	if (!$selectLimit && $FinishTypes_list->StartRecord > 1)
		$FinishTypes_list->Recordset->move($FinishTypes_list->StartRecord - 1);
} elseif (!$FinishTypes->AllowAddDeleteRow && $FinishTypes_list->StopRecord == 0) {
	$FinishTypes_list->StopRecord = $FinishTypes->GridAddRowCount;
}

// Initialize aggregate
$FinishTypes->RowType = ROWTYPE_AGGREGATEINIT;
$FinishTypes->resetAttributes();
$FinishTypes_list->renderRow();
$FinishTypes_list->EditRowCount = 0;
if ($FinishTypes_list->isEdit())
	$FinishTypes_list->RowIndex = 1;
if ($FinishTypes_list->isGridAdd())
	$FinishTypes_list->RowIndex = 0;
if ($FinishTypes_list->isGridEdit())
	$FinishTypes_list->RowIndex = 0;
while ($FinishTypes_list->RecordCount < $FinishTypes_list->StopRecord) {
	$FinishTypes_list->RecordCount++;
	if ($FinishTypes_list->RecordCount >= $FinishTypes_list->StartRecord) {
		$FinishTypes_list->RowCount++;
		if ($FinishTypes_list->isGridAdd() || $FinishTypes_list->isGridEdit() || $FinishTypes->isConfirm()) {
			$FinishTypes_list->RowIndex++;
			$CurrentForm->Index = $FinishTypes_list->RowIndex;
			if ($CurrentForm->hasValue($FinishTypes_list->FormActionName) && ($FinishTypes->isConfirm() || $FinishTypes_list->EventCancelled))
				$FinishTypes_list->RowAction = strval($CurrentForm->getValue($FinishTypes_list->FormActionName));
			elseif ($FinishTypes_list->isGridAdd())
				$FinishTypes_list->RowAction = "insert";
			else
				$FinishTypes_list->RowAction = "";
		}

		// Set up key count
		$FinishTypes_list->KeyCount = $FinishTypes_list->RowIndex;

		// Init row class and style
		$FinishTypes->resetAttributes();
		$FinishTypes->CssClass = "";
		if ($FinishTypes_list->isGridAdd()) {
			$FinishTypes_list->loadRowValues(); // Load default values
		} else {
			$FinishTypes_list->loadRowValues($FinishTypes_list->Recordset); // Load row values
		}
		$FinishTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($FinishTypes_list->isGridAdd()) // Grid add
			$FinishTypes->RowType = ROWTYPE_ADD; // Render add
		if ($FinishTypes_list->isGridAdd() && $FinishTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$FinishTypes_list->restoreCurrentRowFormValues($FinishTypes_list->RowIndex); // Restore form values
		if ($FinishTypes_list->isEdit()) {
			if ($FinishTypes_list->checkInlineEditKey() && $FinishTypes_list->EditRowCount == 0) { // Inline edit
				$FinishTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($FinishTypes_list->isGridEdit()) { // Grid edit
			if ($FinishTypes->EventCancelled)
				$FinishTypes_list->restoreCurrentRowFormValues($FinishTypes_list->RowIndex); // Restore form values
			if ($FinishTypes_list->RowAction == "insert")
				$FinishTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$FinishTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($FinishTypes_list->isEdit() && $FinishTypes->RowType == ROWTYPE_EDIT && $FinishTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$FinishTypes_list->restoreFormValues(); // Restore form values
		}
		if ($FinishTypes_list->isGridEdit() && ($FinishTypes->RowType == ROWTYPE_EDIT || $FinishTypes->RowType == ROWTYPE_ADD) && $FinishTypes->EventCancelled) // Update failed
			$FinishTypes_list->restoreCurrentRowFormValues($FinishTypes_list->RowIndex); // Restore form values
		if ($FinishTypes->RowType == ROWTYPE_EDIT) // Edit row
			$FinishTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$FinishTypes->RowAttrs->merge(["data-rowindex" => $FinishTypes_list->RowCount, "id" => "r" . $FinishTypes_list->RowCount . "_FinishTypes", "data-rowtype" => $FinishTypes->RowType]);

		// Render row
		$FinishTypes_list->renderRow();

		// Render list options
		$FinishTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($FinishTypes_list->RowAction != "delete" && $FinishTypes_list->RowAction != "insertdelete" && !($FinishTypes_list->RowAction == "insert" && $FinishTypes->isConfirm() && $FinishTypes_list->emptyRow())) {
?>
	<tr <?php echo $FinishTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FinishTypes_list->ListOptions->render("body", "left", $FinishTypes_list->RowCount);
?>
	<?php if ($FinishTypes_list->FinishType_Idn->Visible) { // FinishType_Idn ?>
		<td data-name="FinishType_Idn" <?php echo $FinishTypes_list->FinishType_Idn->cellAttributes() ?>>
<?php if ($FinishTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_FinishType_Idn" class="form-group"></span>
<input type="hidden" data-table="FinishTypes" data-field="x_FinishType_Idn" name="o<?php echo $FinishTypes_list->RowIndex ?>_FinishType_Idn" id="o<?php echo $FinishTypes_list->RowIndex ?>_FinishType_Idn" value="<?php echo HtmlEncode($FinishTypes_list->FinishType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($FinishTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_FinishType_Idn" class="form-group">
<span<?php echo $FinishTypes_list->FinishType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($FinishTypes_list->FinishType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_FinishType_Idn" name="x<?php echo $FinishTypes_list->RowIndex ?>_FinishType_Idn" id="x<?php echo $FinishTypes_list->RowIndex ?>_FinishType_Idn" value="<?php echo HtmlEncode($FinishTypes_list->FinishType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($FinishTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_FinishType_Idn">
<span<?php echo $FinishTypes_list->FinishType_Idn->viewAttributes() ?>><?php echo $FinishTypes_list->FinishType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $FinishTypes_list->Name->cellAttributes() ?>>
<?php if ($FinishTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_Name" class="form-group">
<input type="text" data-table="FinishTypes" data-field="x_Name" name="x<?php echo $FinishTypes_list->RowIndex ?>_Name" id="x<?php echo $FinishTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FinishTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->Name->EditValue ?>"<?php echo $FinishTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_Name" name="o<?php echo $FinishTypes_list->RowIndex ?>_Name" id="o<?php echo $FinishTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FinishTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($FinishTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_Name" class="form-group">
<input type="text" data-table="FinishTypes" data-field="x_Name" name="x<?php echo $FinishTypes_list->RowIndex ?>_Name" id="x<?php echo $FinishTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FinishTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->Name->EditValue ?>"<?php echo $FinishTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FinishTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_Name">
<span<?php echo $FinishTypes_list->Name->viewAttributes() ?>><?php echo $FinishTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName" <?php echo $FinishTypes_list->ShortName->cellAttributes() ?>>
<?php if ($FinishTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_ShortName" class="form-group">
<input type="text" data-table="FinishTypes" data-field="x_ShortName" name="x<?php echo $FinishTypes_list->RowIndex ?>_ShortName" id="x<?php echo $FinishTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($FinishTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->ShortName->EditValue ?>"<?php echo $FinishTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_ShortName" name="o<?php echo $FinishTypes_list->RowIndex ?>_ShortName" id="o<?php echo $FinishTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($FinishTypes_list->ShortName->OldValue) ?>">
<?php } ?>
<?php if ($FinishTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_ShortName" class="form-group">
<input type="text" data-table="FinishTypes" data-field="x_ShortName" name="x<?php echo $FinishTypes_list->RowIndex ?>_ShortName" id="x<?php echo $FinishTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($FinishTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->ShortName->EditValue ?>"<?php echo $FinishTypes_list->ShortName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FinishTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_ShortName">
<span<?php echo $FinishTypes_list->ShortName->viewAttributes() ?>><?php echo $FinishTypes_list->ShortName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $FinishTypes_list->Rank->cellAttributes() ?>>
<?php if ($FinishTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_Rank" class="form-group">
<input type="text" data-table="FinishTypes" data-field="x_Rank" name="x<?php echo $FinishTypes_list->RowIndex ?>_Rank" id="x<?php echo $FinishTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FinishTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->Rank->EditValue ?>"<?php echo $FinishTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_Rank" name="o<?php echo $FinishTypes_list->RowIndex ?>_Rank" id="o<?php echo $FinishTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FinishTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($FinishTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_Rank" class="form-group">
<input type="text" data-table="FinishTypes" data-field="x_Rank" name="x<?php echo $FinishTypes_list->RowIndex ?>_Rank" id="x<?php echo $FinishTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FinishTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->Rank->EditValue ?>"<?php echo $FinishTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FinishTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_Rank">
<span<?php echo $FinishTypes_list->Rank->viewAttributes() ?>><?php echo $FinishTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $FinishTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($FinishTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FinishTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FinishTypes" data-field="x_ActiveFlag" name="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]_239743" value="1"<?php echo $selwrk ?><?php echo $FinishTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]_239743"></label>
</div>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_ActiveFlag" name="o<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FinishTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($FinishTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FinishTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FinishTypes" data-field="x_ActiveFlag" name="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]_158309" value="1"<?php echo $selwrk ?><?php echo $FinishTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]_158309"></label>
</div>
</span>
<?php } ?>
<?php if ($FinishTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FinishTypes_list->RowCount ?>_FinishTypes_ActiveFlag">
<span<?php echo $FinishTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FinishTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FinishTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FinishTypes_list->ListOptions->render("body", "right", $FinishTypes_list->RowCount);
?>
	</tr>
<?php if ($FinishTypes->RowType == ROWTYPE_ADD || $FinishTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fFinishTypeslist", "load"], function() {
	fFinishTypeslist.updateLists(<?php echo $FinishTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$FinishTypes_list->isGridAdd())
		if (!$FinishTypes_list->Recordset->EOF)
			$FinishTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($FinishTypes_list->isGridAdd() || $FinishTypes_list->isGridEdit()) {
		$FinishTypes_list->RowIndex = '$rowindex$';
		$FinishTypes_list->loadRowValues();

		// Set row properties
		$FinishTypes->resetAttributes();
		$FinishTypes->RowAttrs->merge(["data-rowindex" => $FinishTypes_list->RowIndex, "id" => "r0_FinishTypes", "data-rowtype" => ROWTYPE_ADD]);
		$FinishTypes->RowAttrs->appendClass("ew-template");
		$FinishTypes->RowType = ROWTYPE_ADD;

		// Render row
		$FinishTypes_list->renderRow();

		// Render list options
		$FinishTypes_list->renderListOptions();
		$FinishTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $FinishTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FinishTypes_list->ListOptions->render("body", "left", $FinishTypes_list->RowIndex);
?>
	<?php if ($FinishTypes_list->FinishType_Idn->Visible) { // FinishType_Idn ?>
		<td data-name="FinishType_Idn">
<span id="el$rowindex$_FinishTypes_FinishType_Idn" class="form-group FinishTypes_FinishType_Idn"></span>
<input type="hidden" data-table="FinishTypes" data-field="x_FinishType_Idn" name="o<?php echo $FinishTypes_list->RowIndex ?>_FinishType_Idn" id="o<?php echo $FinishTypes_list->RowIndex ?>_FinishType_Idn" value="<?php echo HtmlEncode($FinishTypes_list->FinishType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_FinishTypes_Name" class="form-group FinishTypes_Name">
<input type="text" data-table="FinishTypes" data-field="x_Name" name="x<?php echo $FinishTypes_list->RowIndex ?>_Name" id="x<?php echo $FinishTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FinishTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->Name->EditValue ?>"<?php echo $FinishTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_Name" name="o<?php echo $FinishTypes_list->RowIndex ?>_Name" id="o<?php echo $FinishTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FinishTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el$rowindex$_FinishTypes_ShortName" class="form-group FinishTypes_ShortName">
<input type="text" data-table="FinishTypes" data-field="x_ShortName" name="x<?php echo $FinishTypes_list->RowIndex ?>_ShortName" id="x<?php echo $FinishTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($FinishTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->ShortName->EditValue ?>"<?php echo $FinishTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_ShortName" name="o<?php echo $FinishTypes_list->RowIndex ?>_ShortName" id="o<?php echo $FinishTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($FinishTypes_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_FinishTypes_Rank" class="form-group FinishTypes_Rank">
<input type="text" data-table="FinishTypes" data-field="x_Rank" name="x<?php echo $FinishTypes_list->RowIndex ?>_Rank" id="x<?php echo $FinishTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FinishTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FinishTypes_list->Rank->EditValue ?>"<?php echo $FinishTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_Rank" name="o<?php echo $FinishTypes_list->RowIndex ?>_Rank" id="o<?php echo $FinishTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FinishTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_FinishTypes_ActiveFlag" class="form-group FinishTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($FinishTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FinishTypes" data-field="x_ActiveFlag" name="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]_251025" value="1"<?php echo $selwrk ?><?php echo $FinishTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]_251025"></label>
</div>
</span>
<input type="hidden" data-table="FinishTypes" data-field="x_ActiveFlag" name="o<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FinishTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FinishTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FinishTypes_list->ListOptions->render("body", "right", $FinishTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fFinishTypeslist", "load"], function() {
	fFinishTypeslist.updateLists(<?php echo $FinishTypes_list->RowIndex ?>);
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
<?php if ($FinishTypes_list->isAdd() || $FinishTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $FinishTypes_list->FormKeyCountName ?>" id="<?php echo $FinishTypes_list->FormKeyCountName ?>" value="<?php echo $FinishTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($FinishTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $FinishTypes_list->FormKeyCountName ?>" id="<?php echo $FinishTypes_list->FormKeyCountName ?>" value="<?php echo $FinishTypes_list->KeyCount ?>">
<?php echo $FinishTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($FinishTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $FinishTypes_list->FormKeyCountName ?>" id="<?php echo $FinishTypes_list->FormKeyCountName ?>" value="<?php echo $FinishTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($FinishTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $FinishTypes_list->FormKeyCountName ?>" id="<?php echo $FinishTypes_list->FormKeyCountName ?>" value="<?php echo $FinishTypes_list->KeyCount ?>">
<?php echo $FinishTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$FinishTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($FinishTypes_list->Recordset)
	$FinishTypes_list->Recordset->Close();
?>
<?php if (!$FinishTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$FinishTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FinishTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $FinishTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($FinishTypes_list->TotalRecords == 0 && !$FinishTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $FinishTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$FinishTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$FinishTypes_list->isExport()) { ?>
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
$FinishTypes_list->terminate();
?>