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
$ThreadedFittingTypes_list = new ThreadedFittingTypes_list();

// Run the page
$ThreadedFittingTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ThreadedFittingTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ThreadedFittingTypes_list->isExport()) { ?>
<script>
var fThreadedFittingTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fThreadedFittingTypeslist = currentForm = new ew.Form("fThreadedFittingTypeslist", "list");
	fThreadedFittingTypeslist.formKeyCountName = '<?php echo $ThreadedFittingTypes_list->FormKeyCountName ?>';

	// Validate form
	fThreadedFittingTypeslist.validate = function() {
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
			<?php if ($ThreadedFittingTypes_list->ThreadedFittingType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ThreadedFittingType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ThreadedFittingTypes_list->ThreadedFittingType_Idn->caption(), $ThreadedFittingTypes_list->ThreadedFittingType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ThreadedFittingTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ThreadedFittingTypes_list->Name->caption(), $ThreadedFittingTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ThreadedFittingTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ThreadedFittingTypes_list->Rank->caption(), $ThreadedFittingTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ThreadedFittingTypes_list->Rank->errorMessage()) ?>");
			<?php if ($ThreadedFittingTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ThreadedFittingTypes_list->ActiveFlag->caption(), $ThreadedFittingTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fThreadedFittingTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fThreadedFittingTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fThreadedFittingTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fThreadedFittingTypeslist.lists["x_ActiveFlag[]"] = <?php echo $ThreadedFittingTypes_list->ActiveFlag->Lookup->toClientList($ThreadedFittingTypes_list) ?>;
	fThreadedFittingTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ThreadedFittingTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fThreadedFittingTypeslist");
});
var fThreadedFittingTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fThreadedFittingTypeslistsrch = currentSearchForm = new ew.Form("fThreadedFittingTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fThreadedFittingTypeslistsrch.filterList = <?php echo $ThreadedFittingTypes_list->getFilterList() ?>;
	loadjs.done("fThreadedFittingTypeslistsrch");
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
<?php if (!$ThreadedFittingTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ThreadedFittingTypes_list->TotalRecords > 0 && $ThreadedFittingTypes_list->ExportOptions->visible()) { ?>
<?php $ThreadedFittingTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ThreadedFittingTypes_list->ImportOptions->visible()) { ?>
<?php $ThreadedFittingTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ThreadedFittingTypes_list->SearchOptions->visible()) { ?>
<?php $ThreadedFittingTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ThreadedFittingTypes_list->FilterOptions->visible()) { ?>
<?php $ThreadedFittingTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ThreadedFittingTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ThreadedFittingTypes_list->isExport() && !$ThreadedFittingTypes->CurrentAction) { ?>
<form name="fThreadedFittingTypeslistsrch" id="fThreadedFittingTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fThreadedFittingTypeslistsrch-search-panel" class="<?php echo $ThreadedFittingTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ThreadedFittingTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ThreadedFittingTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ThreadedFittingTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ThreadedFittingTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ThreadedFittingTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ThreadedFittingTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ThreadedFittingTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ThreadedFittingTypes_list->showPageHeader(); ?>
<?php
$ThreadedFittingTypes_list->showMessage();
?>
<?php if ($ThreadedFittingTypes_list->TotalRecords > 0 || $ThreadedFittingTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ThreadedFittingTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ThreadedFittingTypes">
<?php if (!$ThreadedFittingTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ThreadedFittingTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ThreadedFittingTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ThreadedFittingTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fThreadedFittingTypeslist" id="fThreadedFittingTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ThreadedFittingTypes">
<div id="gmp_ThreadedFittingTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ThreadedFittingTypes_list->TotalRecords > 0 || $ThreadedFittingTypes_list->isAdd() || $ThreadedFittingTypes_list->isCopy() || $ThreadedFittingTypes_list->isGridEdit()) { ?>
<table id="tbl_ThreadedFittingTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ThreadedFittingTypes->RowType = ROWTYPE_HEADER;

// Render list options
$ThreadedFittingTypes_list->renderListOptions();

// Render list options (header, left)
$ThreadedFittingTypes_list->ListOptions->render("header", "left");
?>
<?php if ($ThreadedFittingTypes_list->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
	<?php if ($ThreadedFittingTypes_list->SortUrl($ThreadedFittingTypes_list->ThreadedFittingType_Idn) == "") { ?>
		<th data-name="ThreadedFittingType_Idn" class="<?php echo $ThreadedFittingTypes_list->ThreadedFittingType_Idn->headerCellClass() ?>"><div id="elh_ThreadedFittingTypes_ThreadedFittingType_Idn" class="ThreadedFittingTypes_ThreadedFittingType_Idn"><div class="ew-table-header-caption"><?php echo $ThreadedFittingTypes_list->ThreadedFittingType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ThreadedFittingType_Idn" class="<?php echo $ThreadedFittingTypes_list->ThreadedFittingType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ThreadedFittingTypes_list->SortUrl($ThreadedFittingTypes_list->ThreadedFittingType_Idn) ?>', 1);"><div id="elh_ThreadedFittingTypes_ThreadedFittingType_Idn" class="ThreadedFittingTypes_ThreadedFittingType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ThreadedFittingTypes_list->ThreadedFittingType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($ThreadedFittingTypes_list->ThreadedFittingType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ThreadedFittingTypes_list->ThreadedFittingType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ThreadedFittingTypes_list->Name->Visible) { // Name ?>
	<?php if ($ThreadedFittingTypes_list->SortUrl($ThreadedFittingTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $ThreadedFittingTypes_list->Name->headerCellClass() ?>"><div id="elh_ThreadedFittingTypes_Name" class="ThreadedFittingTypes_Name"><div class="ew-table-header-caption"><?php echo $ThreadedFittingTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $ThreadedFittingTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ThreadedFittingTypes_list->SortUrl($ThreadedFittingTypes_list->Name) ?>', 1);"><div id="elh_ThreadedFittingTypes_Name" class="ThreadedFittingTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ThreadedFittingTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ThreadedFittingTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ThreadedFittingTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ThreadedFittingTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($ThreadedFittingTypes_list->SortUrl($ThreadedFittingTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $ThreadedFittingTypes_list->Rank->headerCellClass() ?>"><div id="elh_ThreadedFittingTypes_Rank" class="ThreadedFittingTypes_Rank"><div class="ew-table-header-caption"><?php echo $ThreadedFittingTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $ThreadedFittingTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ThreadedFittingTypes_list->SortUrl($ThreadedFittingTypes_list->Rank) ?>', 1);"><div id="elh_ThreadedFittingTypes_Rank" class="ThreadedFittingTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ThreadedFittingTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($ThreadedFittingTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ThreadedFittingTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ThreadedFittingTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($ThreadedFittingTypes_list->SortUrl($ThreadedFittingTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $ThreadedFittingTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_ThreadedFittingTypes_ActiveFlag" class="ThreadedFittingTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $ThreadedFittingTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $ThreadedFittingTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ThreadedFittingTypes_list->SortUrl($ThreadedFittingTypes_list->ActiveFlag) ?>', 1);"><div id="elh_ThreadedFittingTypes_ActiveFlag" class="ThreadedFittingTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ThreadedFittingTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($ThreadedFittingTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ThreadedFittingTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ThreadedFittingTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($ThreadedFittingTypes_list->isAdd() || $ThreadedFittingTypes_list->isCopy()) {
		$ThreadedFittingTypes_list->RowIndex = 0;
		$ThreadedFittingTypes_list->KeyCount = $ThreadedFittingTypes_list->RowIndex;
		if ($ThreadedFittingTypes_list->isCopy() && !$ThreadedFittingTypes_list->loadRow())
			$ThreadedFittingTypes->CurrentAction = "add";
		if ($ThreadedFittingTypes_list->isAdd())
			$ThreadedFittingTypes_list->loadRowValues();
		if ($ThreadedFittingTypes->EventCancelled) // Insert failed
			$ThreadedFittingTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$ThreadedFittingTypes->resetAttributes();
		$ThreadedFittingTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_ThreadedFittingTypes", "data-rowtype" => ROWTYPE_ADD]);
		$ThreadedFittingTypes->RowType = ROWTYPE_ADD;

		// Render row
		$ThreadedFittingTypes_list->renderRow();

		// Render list options
		$ThreadedFittingTypes_list->renderListOptions();
		$ThreadedFittingTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $ThreadedFittingTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ThreadedFittingTypes_list->ListOptions->render("body", "left", $ThreadedFittingTypes_list->RowCount);
?>
	<?php if ($ThreadedFittingTypes_list->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
		<td data-name="ThreadedFittingType_Idn">
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_ThreadedFittingType_Idn" class="form-group ThreadedFittingTypes_ThreadedFittingType_Idn"></span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_ThreadedFittingType_Idn" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ThreadedFittingType_Idn" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ThreadedFittingType_Idn" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->ThreadedFittingType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ThreadedFittingTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_Name" class="form-group ThreadedFittingTypes_Name">
<input type="text" data-table="ThreadedFittingTypes" data-field="x_Name" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ThreadedFittingTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ThreadedFittingTypes_list->Name->EditValue ?>"<?php echo $ThreadedFittingTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_Name" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ThreadedFittingTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_Rank" class="form-group ThreadedFittingTypes_Rank">
<input type="text" data-table="ThreadedFittingTypes" data-field="x_Rank" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ThreadedFittingTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ThreadedFittingTypes_list->Rank->EditValue ?>"<?php echo $ThreadedFittingTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_Rank" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ThreadedFittingTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_ActiveFlag" class="form-group ThreadedFittingTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($ThreadedFittingTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ThreadedFittingTypes" data-field="x_ActiveFlag" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]_756442" value="1"<?php echo $selwrk ?><?php echo $ThreadedFittingTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]_756442"></label>
</div>
</span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_ActiveFlag" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ThreadedFittingTypes_list->ListOptions->render("body", "right", $ThreadedFittingTypes_list->RowCount);
?>
<script>
loadjs.ready(["fThreadedFittingTypeslist", "load"], function() {
	fThreadedFittingTypeslist.updateLists(<?php echo $ThreadedFittingTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($ThreadedFittingTypes_list->ExportAll && $ThreadedFittingTypes_list->isExport()) {
	$ThreadedFittingTypes_list->StopRecord = $ThreadedFittingTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ThreadedFittingTypes_list->TotalRecords > $ThreadedFittingTypes_list->StartRecord + $ThreadedFittingTypes_list->DisplayRecords - 1)
		$ThreadedFittingTypes_list->StopRecord = $ThreadedFittingTypes_list->StartRecord + $ThreadedFittingTypes_list->DisplayRecords - 1;
	else
		$ThreadedFittingTypes_list->StopRecord = $ThreadedFittingTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($ThreadedFittingTypes->isConfirm() || $ThreadedFittingTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ThreadedFittingTypes_list->FormKeyCountName) && ($ThreadedFittingTypes_list->isGridAdd() || $ThreadedFittingTypes_list->isGridEdit() || $ThreadedFittingTypes->isConfirm())) {
		$ThreadedFittingTypes_list->KeyCount = $CurrentForm->getValue($ThreadedFittingTypes_list->FormKeyCountName);
		$ThreadedFittingTypes_list->StopRecord = $ThreadedFittingTypes_list->StartRecord + $ThreadedFittingTypes_list->KeyCount - 1;
	}
}
$ThreadedFittingTypes_list->RecordCount = $ThreadedFittingTypes_list->StartRecord - 1;
if ($ThreadedFittingTypes_list->Recordset && !$ThreadedFittingTypes_list->Recordset->EOF) {
	$ThreadedFittingTypes_list->Recordset->moveFirst();
	$selectLimit = $ThreadedFittingTypes_list->UseSelectLimit;
	if (!$selectLimit && $ThreadedFittingTypes_list->StartRecord > 1)
		$ThreadedFittingTypes_list->Recordset->move($ThreadedFittingTypes_list->StartRecord - 1);
} elseif (!$ThreadedFittingTypes->AllowAddDeleteRow && $ThreadedFittingTypes_list->StopRecord == 0) {
	$ThreadedFittingTypes_list->StopRecord = $ThreadedFittingTypes->GridAddRowCount;
}

// Initialize aggregate
$ThreadedFittingTypes->RowType = ROWTYPE_AGGREGATEINIT;
$ThreadedFittingTypes->resetAttributes();
$ThreadedFittingTypes_list->renderRow();
$ThreadedFittingTypes_list->EditRowCount = 0;
if ($ThreadedFittingTypes_list->isEdit())
	$ThreadedFittingTypes_list->RowIndex = 1;
if ($ThreadedFittingTypes_list->isGridAdd())
	$ThreadedFittingTypes_list->RowIndex = 0;
if ($ThreadedFittingTypes_list->isGridEdit())
	$ThreadedFittingTypes_list->RowIndex = 0;
while ($ThreadedFittingTypes_list->RecordCount < $ThreadedFittingTypes_list->StopRecord) {
	$ThreadedFittingTypes_list->RecordCount++;
	if ($ThreadedFittingTypes_list->RecordCount >= $ThreadedFittingTypes_list->StartRecord) {
		$ThreadedFittingTypes_list->RowCount++;
		if ($ThreadedFittingTypes_list->isGridAdd() || $ThreadedFittingTypes_list->isGridEdit() || $ThreadedFittingTypes->isConfirm()) {
			$ThreadedFittingTypes_list->RowIndex++;
			$CurrentForm->Index = $ThreadedFittingTypes_list->RowIndex;
			if ($CurrentForm->hasValue($ThreadedFittingTypes_list->FormActionName) && ($ThreadedFittingTypes->isConfirm() || $ThreadedFittingTypes_list->EventCancelled))
				$ThreadedFittingTypes_list->RowAction = strval($CurrentForm->getValue($ThreadedFittingTypes_list->FormActionName));
			elseif ($ThreadedFittingTypes_list->isGridAdd())
				$ThreadedFittingTypes_list->RowAction = "insert";
			else
				$ThreadedFittingTypes_list->RowAction = "";
		}

		// Set up key count
		$ThreadedFittingTypes_list->KeyCount = $ThreadedFittingTypes_list->RowIndex;

		// Init row class and style
		$ThreadedFittingTypes->resetAttributes();
		$ThreadedFittingTypes->CssClass = "";
		if ($ThreadedFittingTypes_list->isGridAdd()) {
			$ThreadedFittingTypes_list->loadRowValues(); // Load default values
		} else {
			$ThreadedFittingTypes_list->loadRowValues($ThreadedFittingTypes_list->Recordset); // Load row values
		}
		$ThreadedFittingTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($ThreadedFittingTypes_list->isGridAdd()) // Grid add
			$ThreadedFittingTypes->RowType = ROWTYPE_ADD; // Render add
		if ($ThreadedFittingTypes_list->isGridAdd() && $ThreadedFittingTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ThreadedFittingTypes_list->restoreCurrentRowFormValues($ThreadedFittingTypes_list->RowIndex); // Restore form values
		if ($ThreadedFittingTypes_list->isEdit()) {
			if ($ThreadedFittingTypes_list->checkInlineEditKey() && $ThreadedFittingTypes_list->EditRowCount == 0) { // Inline edit
				$ThreadedFittingTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($ThreadedFittingTypes_list->isGridEdit()) { // Grid edit
			if ($ThreadedFittingTypes->EventCancelled)
				$ThreadedFittingTypes_list->restoreCurrentRowFormValues($ThreadedFittingTypes_list->RowIndex); // Restore form values
			if ($ThreadedFittingTypes_list->RowAction == "insert")
				$ThreadedFittingTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$ThreadedFittingTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ThreadedFittingTypes_list->isEdit() && $ThreadedFittingTypes->RowType == ROWTYPE_EDIT && $ThreadedFittingTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$ThreadedFittingTypes_list->restoreFormValues(); // Restore form values
		}
		if ($ThreadedFittingTypes_list->isGridEdit() && ($ThreadedFittingTypes->RowType == ROWTYPE_EDIT || $ThreadedFittingTypes->RowType == ROWTYPE_ADD) && $ThreadedFittingTypes->EventCancelled) // Update failed
			$ThreadedFittingTypes_list->restoreCurrentRowFormValues($ThreadedFittingTypes_list->RowIndex); // Restore form values
		if ($ThreadedFittingTypes->RowType == ROWTYPE_EDIT) // Edit row
			$ThreadedFittingTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$ThreadedFittingTypes->RowAttrs->merge(["data-rowindex" => $ThreadedFittingTypes_list->RowCount, "id" => "r" . $ThreadedFittingTypes_list->RowCount . "_ThreadedFittingTypes", "data-rowtype" => $ThreadedFittingTypes->RowType]);

		// Render row
		$ThreadedFittingTypes_list->renderRow();

		// Render list options
		$ThreadedFittingTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ThreadedFittingTypes_list->RowAction != "delete" && $ThreadedFittingTypes_list->RowAction != "insertdelete" && !($ThreadedFittingTypes_list->RowAction == "insert" && $ThreadedFittingTypes->isConfirm() && $ThreadedFittingTypes_list->emptyRow())) {
?>
	<tr <?php echo $ThreadedFittingTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ThreadedFittingTypes_list->ListOptions->render("body", "left", $ThreadedFittingTypes_list->RowCount);
?>
	<?php if ($ThreadedFittingTypes_list->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
		<td data-name="ThreadedFittingType_Idn" <?php echo $ThreadedFittingTypes_list->ThreadedFittingType_Idn->cellAttributes() ?>>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_ThreadedFittingType_Idn" class="form-group"></span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_ThreadedFittingType_Idn" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ThreadedFittingType_Idn" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ThreadedFittingType_Idn" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->ThreadedFittingType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_ThreadedFittingType_Idn" class="form-group">
<span<?php echo $ThreadedFittingTypes_list->ThreadedFittingType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ThreadedFittingTypes_list->ThreadedFittingType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_ThreadedFittingType_Idn" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ThreadedFittingType_Idn" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ThreadedFittingType_Idn" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->ThreadedFittingType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_ThreadedFittingType_Idn">
<span<?php echo $ThreadedFittingTypes_list->ThreadedFittingType_Idn->viewAttributes() ?>><?php echo $ThreadedFittingTypes_list->ThreadedFittingType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ThreadedFittingTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $ThreadedFittingTypes_list->Name->cellAttributes() ?>>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_Name" class="form-group">
<input type="text" data-table="ThreadedFittingTypes" data-field="x_Name" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ThreadedFittingTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ThreadedFittingTypes_list->Name->EditValue ?>"<?php echo $ThreadedFittingTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_Name" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_Name" class="form-group">
<input type="text" data-table="ThreadedFittingTypes" data-field="x_Name" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ThreadedFittingTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ThreadedFittingTypes_list->Name->EditValue ?>"<?php echo $ThreadedFittingTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_Name">
<span<?php echo $ThreadedFittingTypes_list->Name->viewAttributes() ?>><?php echo $ThreadedFittingTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ThreadedFittingTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $ThreadedFittingTypes_list->Rank->cellAttributes() ?>>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_Rank" class="form-group">
<input type="text" data-table="ThreadedFittingTypes" data-field="x_Rank" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ThreadedFittingTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ThreadedFittingTypes_list->Rank->EditValue ?>"<?php echo $ThreadedFittingTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_Rank" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_Rank" class="form-group">
<input type="text" data-table="ThreadedFittingTypes" data-field="x_Rank" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ThreadedFittingTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ThreadedFittingTypes_list->Rank->EditValue ?>"<?php echo $ThreadedFittingTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_Rank">
<span<?php echo $ThreadedFittingTypes_list->Rank->viewAttributes() ?>><?php echo $ThreadedFittingTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ThreadedFittingTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $ThreadedFittingTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ThreadedFittingTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ThreadedFittingTypes" data-field="x_ActiveFlag" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]_807284" value="1"<?php echo $selwrk ?><?php echo $ThreadedFittingTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]_807284"></label>
</div>
</span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_ActiveFlag" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ThreadedFittingTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ThreadedFittingTypes" data-field="x_ActiveFlag" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]_114512" value="1"<?php echo $selwrk ?><?php echo $ThreadedFittingTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]_114512"></label>
</div>
</span>
<?php } ?>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ThreadedFittingTypes_list->RowCount ?>_ThreadedFittingTypes_ActiveFlag">
<span<?php echo $ThreadedFittingTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ThreadedFittingTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ThreadedFittingTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ThreadedFittingTypes_list->ListOptions->render("body", "right", $ThreadedFittingTypes_list->RowCount);
?>
	</tr>
<?php if ($ThreadedFittingTypes->RowType == ROWTYPE_ADD || $ThreadedFittingTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fThreadedFittingTypeslist", "load"], function() {
	fThreadedFittingTypeslist.updateLists(<?php echo $ThreadedFittingTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ThreadedFittingTypes_list->isGridAdd())
		if (!$ThreadedFittingTypes_list->Recordset->EOF)
			$ThreadedFittingTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($ThreadedFittingTypes_list->isGridAdd() || $ThreadedFittingTypes_list->isGridEdit()) {
		$ThreadedFittingTypes_list->RowIndex = '$rowindex$';
		$ThreadedFittingTypes_list->loadRowValues();

		// Set row properties
		$ThreadedFittingTypes->resetAttributes();
		$ThreadedFittingTypes->RowAttrs->merge(["data-rowindex" => $ThreadedFittingTypes_list->RowIndex, "id" => "r0_ThreadedFittingTypes", "data-rowtype" => ROWTYPE_ADD]);
		$ThreadedFittingTypes->RowAttrs->appendClass("ew-template");
		$ThreadedFittingTypes->RowType = ROWTYPE_ADD;

		// Render row
		$ThreadedFittingTypes_list->renderRow();

		// Render list options
		$ThreadedFittingTypes_list->renderListOptions();
		$ThreadedFittingTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $ThreadedFittingTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ThreadedFittingTypes_list->ListOptions->render("body", "left", $ThreadedFittingTypes_list->RowIndex);
?>
	<?php if ($ThreadedFittingTypes_list->ThreadedFittingType_Idn->Visible) { // ThreadedFittingType_Idn ?>
		<td data-name="ThreadedFittingType_Idn">
<span id="el$rowindex$_ThreadedFittingTypes_ThreadedFittingType_Idn" class="form-group ThreadedFittingTypes_ThreadedFittingType_Idn"></span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_ThreadedFittingType_Idn" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ThreadedFittingType_Idn" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ThreadedFittingType_Idn" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->ThreadedFittingType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ThreadedFittingTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_ThreadedFittingTypes_Name" class="form-group ThreadedFittingTypes_Name">
<input type="text" data-table="ThreadedFittingTypes" data-field="x_Name" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ThreadedFittingTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $ThreadedFittingTypes_list->Name->EditValue ?>"<?php echo $ThreadedFittingTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_Name" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ThreadedFittingTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_ThreadedFittingTypes_Rank" class="form-group ThreadedFittingTypes_Rank">
<input type="text" data-table="ThreadedFittingTypes" data-field="x_Rank" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ThreadedFittingTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ThreadedFittingTypes_list->Rank->EditValue ?>"<?php echo $ThreadedFittingTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_Rank" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ThreadedFittingTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_ThreadedFittingTypes_ActiveFlag" class="form-group ThreadedFittingTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($ThreadedFittingTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ThreadedFittingTypes" data-field="x_ActiveFlag" name="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]_420228" value="1"<?php echo $selwrk ?><?php echo $ThreadedFittingTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]_420228"></label>
</div>
</span>
<input type="hidden" data-table="ThreadedFittingTypes" data-field="x_ActiveFlag" name="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ThreadedFittingTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ThreadedFittingTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ThreadedFittingTypes_list->ListOptions->render("body", "right", $ThreadedFittingTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fThreadedFittingTypeslist", "load"], function() {
	fThreadedFittingTypeslist.updateLists(<?php echo $ThreadedFittingTypes_list->RowIndex ?>);
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
<?php if ($ThreadedFittingTypes_list->isAdd() || $ThreadedFittingTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $ThreadedFittingTypes_list->FormKeyCountName ?>" id="<?php echo $ThreadedFittingTypes_list->FormKeyCountName ?>" value="<?php echo $ThreadedFittingTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($ThreadedFittingTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $ThreadedFittingTypes_list->FormKeyCountName ?>" id="<?php echo $ThreadedFittingTypes_list->FormKeyCountName ?>" value="<?php echo $ThreadedFittingTypes_list->KeyCount ?>">
<?php echo $ThreadedFittingTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($ThreadedFittingTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $ThreadedFittingTypes_list->FormKeyCountName ?>" id="<?php echo $ThreadedFittingTypes_list->FormKeyCountName ?>" value="<?php echo $ThreadedFittingTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($ThreadedFittingTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $ThreadedFittingTypes_list->FormKeyCountName ?>" id="<?php echo $ThreadedFittingTypes_list->FormKeyCountName ?>" value="<?php echo $ThreadedFittingTypes_list->KeyCount ?>">
<?php echo $ThreadedFittingTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$ThreadedFittingTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ThreadedFittingTypes_list->Recordset)
	$ThreadedFittingTypes_list->Recordset->Close();
?>
<?php if (!$ThreadedFittingTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ThreadedFittingTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ThreadedFittingTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ThreadedFittingTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ThreadedFittingTypes_list->TotalRecords == 0 && !$ThreadedFittingTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ThreadedFittingTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ThreadedFittingTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ThreadedFittingTypes_list->isExport()) { ?>
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
$ThreadedFittingTypes_list->terminate();
?>