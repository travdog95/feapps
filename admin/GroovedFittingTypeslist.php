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
$GroovedFittingTypes_list = new GroovedFittingTypes_list();

// Run the page
$GroovedFittingTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$GroovedFittingTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$GroovedFittingTypes_list->isExport()) { ?>
<script>
var fGroovedFittingTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fGroovedFittingTypeslist = currentForm = new ew.Form("fGroovedFittingTypeslist", "list");
	fGroovedFittingTypeslist.formKeyCountName = '<?php echo $GroovedFittingTypes_list->FormKeyCountName ?>';

	// Validate form
	fGroovedFittingTypeslist.validate = function() {
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
			<?php if ($GroovedFittingTypes_list->GroovedFittingType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_GroovedFittingType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GroovedFittingTypes_list->GroovedFittingType_Idn->caption(), $GroovedFittingTypes_list->GroovedFittingType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GroovedFittingTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GroovedFittingTypes_list->Name->caption(), $GroovedFittingTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($GroovedFittingTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GroovedFittingTypes_list->Rank->caption(), $GroovedFittingTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($GroovedFittingTypes_list->Rank->errorMessage()) ?>");
			<?php if ($GroovedFittingTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $GroovedFittingTypes_list->ActiveFlag->caption(), $GroovedFittingTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fGroovedFittingTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fGroovedFittingTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fGroovedFittingTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fGroovedFittingTypeslist.lists["x_ActiveFlag[]"] = <?php echo $GroovedFittingTypes_list->ActiveFlag->Lookup->toClientList($GroovedFittingTypes_list) ?>;
	fGroovedFittingTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($GroovedFittingTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fGroovedFittingTypeslist");
});
var fGroovedFittingTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fGroovedFittingTypeslistsrch = currentSearchForm = new ew.Form("fGroovedFittingTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fGroovedFittingTypeslistsrch.filterList = <?php echo $GroovedFittingTypes_list->getFilterList() ?>;
	loadjs.done("fGroovedFittingTypeslistsrch");
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
<?php if (!$GroovedFittingTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($GroovedFittingTypes_list->TotalRecords > 0 && $GroovedFittingTypes_list->ExportOptions->visible()) { ?>
<?php $GroovedFittingTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($GroovedFittingTypes_list->ImportOptions->visible()) { ?>
<?php $GroovedFittingTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($GroovedFittingTypes_list->SearchOptions->visible()) { ?>
<?php $GroovedFittingTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($GroovedFittingTypes_list->FilterOptions->visible()) { ?>
<?php $GroovedFittingTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$GroovedFittingTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$GroovedFittingTypes_list->isExport() && !$GroovedFittingTypes->CurrentAction) { ?>
<form name="fGroovedFittingTypeslistsrch" id="fGroovedFittingTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fGroovedFittingTypeslistsrch-search-panel" class="<?php echo $GroovedFittingTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="GroovedFittingTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $GroovedFittingTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($GroovedFittingTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($GroovedFittingTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $GroovedFittingTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($GroovedFittingTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($GroovedFittingTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($GroovedFittingTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($GroovedFittingTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $GroovedFittingTypes_list->showPageHeader(); ?>
<?php
$GroovedFittingTypes_list->showMessage();
?>
<?php if ($GroovedFittingTypes_list->TotalRecords > 0 || $GroovedFittingTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($GroovedFittingTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> GroovedFittingTypes">
<?php if (!$GroovedFittingTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$GroovedFittingTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GroovedFittingTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $GroovedFittingTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fGroovedFittingTypeslist" id="fGroovedFittingTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="GroovedFittingTypes">
<div id="gmp_GroovedFittingTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($GroovedFittingTypes_list->TotalRecords > 0 || $GroovedFittingTypes_list->isAdd() || $GroovedFittingTypes_list->isCopy() || $GroovedFittingTypes_list->isGridEdit()) { ?>
<table id="tbl_GroovedFittingTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$GroovedFittingTypes->RowType = ROWTYPE_HEADER;

// Render list options
$GroovedFittingTypes_list->renderListOptions();

// Render list options (header, left)
$GroovedFittingTypes_list->ListOptions->render("header", "left");
?>
<?php if ($GroovedFittingTypes_list->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
	<?php if ($GroovedFittingTypes_list->SortUrl($GroovedFittingTypes_list->GroovedFittingType_Idn) == "") { ?>
		<th data-name="GroovedFittingType_Idn" class="<?php echo $GroovedFittingTypes_list->GroovedFittingType_Idn->headerCellClass() ?>"><div id="elh_GroovedFittingTypes_GroovedFittingType_Idn" class="GroovedFittingTypes_GroovedFittingType_Idn"><div class="ew-table-header-caption"><?php echo $GroovedFittingTypes_list->GroovedFittingType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GroovedFittingType_Idn" class="<?php echo $GroovedFittingTypes_list->GroovedFittingType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GroovedFittingTypes_list->SortUrl($GroovedFittingTypes_list->GroovedFittingType_Idn) ?>', 1);"><div id="elh_GroovedFittingTypes_GroovedFittingType_Idn" class="GroovedFittingTypes_GroovedFittingType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GroovedFittingTypes_list->GroovedFittingType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($GroovedFittingTypes_list->GroovedFittingType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GroovedFittingTypes_list->GroovedFittingType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($GroovedFittingTypes_list->Name->Visible) { // Name ?>
	<?php if ($GroovedFittingTypes_list->SortUrl($GroovedFittingTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $GroovedFittingTypes_list->Name->headerCellClass() ?>"><div id="elh_GroovedFittingTypes_Name" class="GroovedFittingTypes_Name"><div class="ew-table-header-caption"><?php echo $GroovedFittingTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $GroovedFittingTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GroovedFittingTypes_list->SortUrl($GroovedFittingTypes_list->Name) ?>', 1);"><div id="elh_GroovedFittingTypes_Name" class="GroovedFittingTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GroovedFittingTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($GroovedFittingTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GroovedFittingTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($GroovedFittingTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($GroovedFittingTypes_list->SortUrl($GroovedFittingTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $GroovedFittingTypes_list->Rank->headerCellClass() ?>"><div id="elh_GroovedFittingTypes_Rank" class="GroovedFittingTypes_Rank"><div class="ew-table-header-caption"><?php echo $GroovedFittingTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $GroovedFittingTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GroovedFittingTypes_list->SortUrl($GroovedFittingTypes_list->Rank) ?>', 1);"><div id="elh_GroovedFittingTypes_Rank" class="GroovedFittingTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GroovedFittingTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($GroovedFittingTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GroovedFittingTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($GroovedFittingTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($GroovedFittingTypes_list->SortUrl($GroovedFittingTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $GroovedFittingTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_GroovedFittingTypes_ActiveFlag" class="GroovedFittingTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $GroovedFittingTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $GroovedFittingTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $GroovedFittingTypes_list->SortUrl($GroovedFittingTypes_list->ActiveFlag) ?>', 1);"><div id="elh_GroovedFittingTypes_ActiveFlag" class="GroovedFittingTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $GroovedFittingTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($GroovedFittingTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($GroovedFittingTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$GroovedFittingTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($GroovedFittingTypes_list->isAdd() || $GroovedFittingTypes_list->isCopy()) {
		$GroovedFittingTypes_list->RowIndex = 0;
		$GroovedFittingTypes_list->KeyCount = $GroovedFittingTypes_list->RowIndex;
		if ($GroovedFittingTypes_list->isCopy() && !$GroovedFittingTypes_list->loadRow())
			$GroovedFittingTypes->CurrentAction = "add";
		if ($GroovedFittingTypes_list->isAdd())
			$GroovedFittingTypes_list->loadRowValues();
		if ($GroovedFittingTypes->EventCancelled) // Insert failed
			$GroovedFittingTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$GroovedFittingTypes->resetAttributes();
		$GroovedFittingTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_GroovedFittingTypes", "data-rowtype" => ROWTYPE_ADD]);
		$GroovedFittingTypes->RowType = ROWTYPE_ADD;

		// Render row
		$GroovedFittingTypes_list->renderRow();

		// Render list options
		$GroovedFittingTypes_list->renderListOptions();
		$GroovedFittingTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $GroovedFittingTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$GroovedFittingTypes_list->ListOptions->render("body", "left", $GroovedFittingTypes_list->RowCount);
?>
	<?php if ($GroovedFittingTypes_list->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
		<td data-name="GroovedFittingType_Idn">
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_GroovedFittingType_Idn" class="form-group GroovedFittingTypes_GroovedFittingType_Idn"></span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_GroovedFittingType_Idn" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_GroovedFittingType_Idn" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_GroovedFittingType_Idn" value="<?php echo HtmlEncode($GroovedFittingTypes_list->GroovedFittingType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GroovedFittingTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_Name" class="form-group GroovedFittingTypes_Name">
<input type="text" data-table="GroovedFittingTypes" data-field="x_Name" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GroovedFittingTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $GroovedFittingTypes_list->Name->EditValue ?>"<?php echo $GroovedFittingTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_Name" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($GroovedFittingTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GroovedFittingTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_Rank" class="form-group GroovedFittingTypes_Rank">
<input type="text" data-table="GroovedFittingTypes" data-field="x_Rank" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GroovedFittingTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GroovedFittingTypes_list->Rank->EditValue ?>"<?php echo $GroovedFittingTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_Rank" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($GroovedFittingTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GroovedFittingTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_ActiveFlag" class="form-group GroovedFittingTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($GroovedFittingTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GroovedFittingTypes" data-field="x_ActiveFlag" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]_179011" value="1"<?php echo $selwrk ?><?php echo $GroovedFittingTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]_179011"></label>
</div>
</span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_ActiveFlag" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($GroovedFittingTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$GroovedFittingTypes_list->ListOptions->render("body", "right", $GroovedFittingTypes_list->RowCount);
?>
<script>
loadjs.ready(["fGroovedFittingTypeslist", "load"], function() {
	fGroovedFittingTypeslist.updateLists(<?php echo $GroovedFittingTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($GroovedFittingTypes_list->ExportAll && $GroovedFittingTypes_list->isExport()) {
	$GroovedFittingTypes_list->StopRecord = $GroovedFittingTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($GroovedFittingTypes_list->TotalRecords > $GroovedFittingTypes_list->StartRecord + $GroovedFittingTypes_list->DisplayRecords - 1)
		$GroovedFittingTypes_list->StopRecord = $GroovedFittingTypes_list->StartRecord + $GroovedFittingTypes_list->DisplayRecords - 1;
	else
		$GroovedFittingTypes_list->StopRecord = $GroovedFittingTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($GroovedFittingTypes->isConfirm() || $GroovedFittingTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($GroovedFittingTypes_list->FormKeyCountName) && ($GroovedFittingTypes_list->isGridAdd() || $GroovedFittingTypes_list->isGridEdit() || $GroovedFittingTypes->isConfirm())) {
		$GroovedFittingTypes_list->KeyCount = $CurrentForm->getValue($GroovedFittingTypes_list->FormKeyCountName);
		$GroovedFittingTypes_list->StopRecord = $GroovedFittingTypes_list->StartRecord + $GroovedFittingTypes_list->KeyCount - 1;
	}
}
$GroovedFittingTypes_list->RecordCount = $GroovedFittingTypes_list->StartRecord - 1;
if ($GroovedFittingTypes_list->Recordset && !$GroovedFittingTypes_list->Recordset->EOF) {
	$GroovedFittingTypes_list->Recordset->moveFirst();
	$selectLimit = $GroovedFittingTypes_list->UseSelectLimit;
	if (!$selectLimit && $GroovedFittingTypes_list->StartRecord > 1)
		$GroovedFittingTypes_list->Recordset->move($GroovedFittingTypes_list->StartRecord - 1);
} elseif (!$GroovedFittingTypes->AllowAddDeleteRow && $GroovedFittingTypes_list->StopRecord == 0) {
	$GroovedFittingTypes_list->StopRecord = $GroovedFittingTypes->GridAddRowCount;
}

// Initialize aggregate
$GroovedFittingTypes->RowType = ROWTYPE_AGGREGATEINIT;
$GroovedFittingTypes->resetAttributes();
$GroovedFittingTypes_list->renderRow();
$GroovedFittingTypes_list->EditRowCount = 0;
if ($GroovedFittingTypes_list->isEdit())
	$GroovedFittingTypes_list->RowIndex = 1;
if ($GroovedFittingTypes_list->isGridAdd())
	$GroovedFittingTypes_list->RowIndex = 0;
if ($GroovedFittingTypes_list->isGridEdit())
	$GroovedFittingTypes_list->RowIndex = 0;
while ($GroovedFittingTypes_list->RecordCount < $GroovedFittingTypes_list->StopRecord) {
	$GroovedFittingTypes_list->RecordCount++;
	if ($GroovedFittingTypes_list->RecordCount >= $GroovedFittingTypes_list->StartRecord) {
		$GroovedFittingTypes_list->RowCount++;
		if ($GroovedFittingTypes_list->isGridAdd() || $GroovedFittingTypes_list->isGridEdit() || $GroovedFittingTypes->isConfirm()) {
			$GroovedFittingTypes_list->RowIndex++;
			$CurrentForm->Index = $GroovedFittingTypes_list->RowIndex;
			if ($CurrentForm->hasValue($GroovedFittingTypes_list->FormActionName) && ($GroovedFittingTypes->isConfirm() || $GroovedFittingTypes_list->EventCancelled))
				$GroovedFittingTypes_list->RowAction = strval($CurrentForm->getValue($GroovedFittingTypes_list->FormActionName));
			elseif ($GroovedFittingTypes_list->isGridAdd())
				$GroovedFittingTypes_list->RowAction = "insert";
			else
				$GroovedFittingTypes_list->RowAction = "";
		}

		// Set up key count
		$GroovedFittingTypes_list->KeyCount = $GroovedFittingTypes_list->RowIndex;

		// Init row class and style
		$GroovedFittingTypes->resetAttributes();
		$GroovedFittingTypes->CssClass = "";
		if ($GroovedFittingTypes_list->isGridAdd()) {
			$GroovedFittingTypes_list->loadRowValues(); // Load default values
		} else {
			$GroovedFittingTypes_list->loadRowValues($GroovedFittingTypes_list->Recordset); // Load row values
		}
		$GroovedFittingTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($GroovedFittingTypes_list->isGridAdd()) // Grid add
			$GroovedFittingTypes->RowType = ROWTYPE_ADD; // Render add
		if ($GroovedFittingTypes_list->isGridAdd() && $GroovedFittingTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$GroovedFittingTypes_list->restoreCurrentRowFormValues($GroovedFittingTypes_list->RowIndex); // Restore form values
		if ($GroovedFittingTypes_list->isEdit()) {
			if ($GroovedFittingTypes_list->checkInlineEditKey() && $GroovedFittingTypes_list->EditRowCount == 0) { // Inline edit
				$GroovedFittingTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($GroovedFittingTypes_list->isGridEdit()) { // Grid edit
			if ($GroovedFittingTypes->EventCancelled)
				$GroovedFittingTypes_list->restoreCurrentRowFormValues($GroovedFittingTypes_list->RowIndex); // Restore form values
			if ($GroovedFittingTypes_list->RowAction == "insert")
				$GroovedFittingTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$GroovedFittingTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($GroovedFittingTypes_list->isEdit() && $GroovedFittingTypes->RowType == ROWTYPE_EDIT && $GroovedFittingTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$GroovedFittingTypes_list->restoreFormValues(); // Restore form values
		}
		if ($GroovedFittingTypes_list->isGridEdit() && ($GroovedFittingTypes->RowType == ROWTYPE_EDIT || $GroovedFittingTypes->RowType == ROWTYPE_ADD) && $GroovedFittingTypes->EventCancelled) // Update failed
			$GroovedFittingTypes_list->restoreCurrentRowFormValues($GroovedFittingTypes_list->RowIndex); // Restore form values
		if ($GroovedFittingTypes->RowType == ROWTYPE_EDIT) // Edit row
			$GroovedFittingTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$GroovedFittingTypes->RowAttrs->merge(["data-rowindex" => $GroovedFittingTypes_list->RowCount, "id" => "r" . $GroovedFittingTypes_list->RowCount . "_GroovedFittingTypes", "data-rowtype" => $GroovedFittingTypes->RowType]);

		// Render row
		$GroovedFittingTypes_list->renderRow();

		// Render list options
		$GroovedFittingTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($GroovedFittingTypes_list->RowAction != "delete" && $GroovedFittingTypes_list->RowAction != "insertdelete" && !($GroovedFittingTypes_list->RowAction == "insert" && $GroovedFittingTypes->isConfirm() && $GroovedFittingTypes_list->emptyRow())) {
?>
	<tr <?php echo $GroovedFittingTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$GroovedFittingTypes_list->ListOptions->render("body", "left", $GroovedFittingTypes_list->RowCount);
?>
	<?php if ($GroovedFittingTypes_list->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
		<td data-name="GroovedFittingType_Idn" <?php echo $GroovedFittingTypes_list->GroovedFittingType_Idn->cellAttributes() ?>>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_GroovedFittingType_Idn" class="form-group"></span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_GroovedFittingType_Idn" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_GroovedFittingType_Idn" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_GroovedFittingType_Idn" value="<?php echo HtmlEncode($GroovedFittingTypes_list->GroovedFittingType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_GroovedFittingType_Idn" class="form-group">
<span<?php echo $GroovedFittingTypes_list->GroovedFittingType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($GroovedFittingTypes_list->GroovedFittingType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_GroovedFittingType_Idn" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_GroovedFittingType_Idn" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_GroovedFittingType_Idn" value="<?php echo HtmlEncode($GroovedFittingTypes_list->GroovedFittingType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_GroovedFittingType_Idn">
<span<?php echo $GroovedFittingTypes_list->GroovedFittingType_Idn->viewAttributes() ?>><?php echo $GroovedFittingTypes_list->GroovedFittingType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($GroovedFittingTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $GroovedFittingTypes_list->Name->cellAttributes() ?>>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_Name" class="form-group">
<input type="text" data-table="GroovedFittingTypes" data-field="x_Name" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GroovedFittingTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $GroovedFittingTypes_list->Name->EditValue ?>"<?php echo $GroovedFittingTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_Name" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($GroovedFittingTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_Name" class="form-group">
<input type="text" data-table="GroovedFittingTypes" data-field="x_Name" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GroovedFittingTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $GroovedFittingTypes_list->Name->EditValue ?>"<?php echo $GroovedFittingTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_Name">
<span<?php echo $GroovedFittingTypes_list->Name->viewAttributes() ?>><?php echo $GroovedFittingTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($GroovedFittingTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $GroovedFittingTypes_list->Rank->cellAttributes() ?>>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_Rank" class="form-group">
<input type="text" data-table="GroovedFittingTypes" data-field="x_Rank" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GroovedFittingTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GroovedFittingTypes_list->Rank->EditValue ?>"<?php echo $GroovedFittingTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_Rank" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($GroovedFittingTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_Rank" class="form-group">
<input type="text" data-table="GroovedFittingTypes" data-field="x_Rank" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GroovedFittingTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GroovedFittingTypes_list->Rank->EditValue ?>"<?php echo $GroovedFittingTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_Rank">
<span<?php echo $GroovedFittingTypes_list->Rank->viewAttributes() ?>><?php echo $GroovedFittingTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($GroovedFittingTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $GroovedFittingTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($GroovedFittingTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GroovedFittingTypes" data-field="x_ActiveFlag" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]_929136" value="1"<?php echo $selwrk ?><?php echo $GroovedFittingTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]_929136"></label>
</div>
</span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_ActiveFlag" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($GroovedFittingTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($GroovedFittingTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GroovedFittingTypes" data-field="x_ActiveFlag" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]_529279" value="1"<?php echo $selwrk ?><?php echo $GroovedFittingTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]_529279"></label>
</div>
</span>
<?php } ?>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $GroovedFittingTypes_list->RowCount ?>_GroovedFittingTypes_ActiveFlag">
<span<?php echo $GroovedFittingTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $GroovedFittingTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($GroovedFittingTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$GroovedFittingTypes_list->ListOptions->render("body", "right", $GroovedFittingTypes_list->RowCount);
?>
	</tr>
<?php if ($GroovedFittingTypes->RowType == ROWTYPE_ADD || $GroovedFittingTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fGroovedFittingTypeslist", "load"], function() {
	fGroovedFittingTypeslist.updateLists(<?php echo $GroovedFittingTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$GroovedFittingTypes_list->isGridAdd())
		if (!$GroovedFittingTypes_list->Recordset->EOF)
			$GroovedFittingTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($GroovedFittingTypes_list->isGridAdd() || $GroovedFittingTypes_list->isGridEdit()) {
		$GroovedFittingTypes_list->RowIndex = '$rowindex$';
		$GroovedFittingTypes_list->loadRowValues();

		// Set row properties
		$GroovedFittingTypes->resetAttributes();
		$GroovedFittingTypes->RowAttrs->merge(["data-rowindex" => $GroovedFittingTypes_list->RowIndex, "id" => "r0_GroovedFittingTypes", "data-rowtype" => ROWTYPE_ADD]);
		$GroovedFittingTypes->RowAttrs->appendClass("ew-template");
		$GroovedFittingTypes->RowType = ROWTYPE_ADD;

		// Render row
		$GroovedFittingTypes_list->renderRow();

		// Render list options
		$GroovedFittingTypes_list->renderListOptions();
		$GroovedFittingTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $GroovedFittingTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$GroovedFittingTypes_list->ListOptions->render("body", "left", $GroovedFittingTypes_list->RowIndex);
?>
	<?php if ($GroovedFittingTypes_list->GroovedFittingType_Idn->Visible) { // GroovedFittingType_Idn ?>
		<td data-name="GroovedFittingType_Idn">
<span id="el$rowindex$_GroovedFittingTypes_GroovedFittingType_Idn" class="form-group GroovedFittingTypes_GroovedFittingType_Idn"></span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_GroovedFittingType_Idn" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_GroovedFittingType_Idn" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_GroovedFittingType_Idn" value="<?php echo HtmlEncode($GroovedFittingTypes_list->GroovedFittingType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GroovedFittingTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_GroovedFittingTypes_Name" class="form-group GroovedFittingTypes_Name">
<input type="text" data-table="GroovedFittingTypes" data-field="x_Name" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($GroovedFittingTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $GroovedFittingTypes_list->Name->EditValue ?>"<?php echo $GroovedFittingTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_Name" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($GroovedFittingTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GroovedFittingTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_GroovedFittingTypes_Rank" class="form-group GroovedFittingTypes_Rank">
<input type="text" data-table="GroovedFittingTypes" data-field="x_Rank" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($GroovedFittingTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $GroovedFittingTypes_list->Rank->EditValue ?>"<?php echo $GroovedFittingTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_Rank" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($GroovedFittingTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($GroovedFittingTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_GroovedFittingTypes_ActiveFlag" class="form-group GroovedFittingTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($GroovedFittingTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="GroovedFittingTypes" data-field="x_ActiveFlag" name="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]_424706" value="1"<?php echo $selwrk ?><?php echo $GroovedFittingTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]_424706"></label>
</div>
</span>
<input type="hidden" data-table="GroovedFittingTypes" data-field="x_ActiveFlag" name="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $GroovedFittingTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($GroovedFittingTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$GroovedFittingTypes_list->ListOptions->render("body", "right", $GroovedFittingTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fGroovedFittingTypeslist", "load"], function() {
	fGroovedFittingTypeslist.updateLists(<?php echo $GroovedFittingTypes_list->RowIndex ?>);
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
<?php if ($GroovedFittingTypes_list->isAdd() || $GroovedFittingTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $GroovedFittingTypes_list->FormKeyCountName ?>" id="<?php echo $GroovedFittingTypes_list->FormKeyCountName ?>" value="<?php echo $GroovedFittingTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($GroovedFittingTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $GroovedFittingTypes_list->FormKeyCountName ?>" id="<?php echo $GroovedFittingTypes_list->FormKeyCountName ?>" value="<?php echo $GroovedFittingTypes_list->KeyCount ?>">
<?php echo $GroovedFittingTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($GroovedFittingTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $GroovedFittingTypes_list->FormKeyCountName ?>" id="<?php echo $GroovedFittingTypes_list->FormKeyCountName ?>" value="<?php echo $GroovedFittingTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($GroovedFittingTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $GroovedFittingTypes_list->FormKeyCountName ?>" id="<?php echo $GroovedFittingTypes_list->FormKeyCountName ?>" value="<?php echo $GroovedFittingTypes_list->KeyCount ?>">
<?php echo $GroovedFittingTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$GroovedFittingTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($GroovedFittingTypes_list->Recordset)
	$GroovedFittingTypes_list->Recordset->Close();
?>
<?php if (!$GroovedFittingTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$GroovedFittingTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $GroovedFittingTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $GroovedFittingTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($GroovedFittingTypes_list->TotalRecords == 0 && !$GroovedFittingTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $GroovedFittingTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$GroovedFittingTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$GroovedFittingTypes_list->isExport()) { ?>
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
$GroovedFittingTypes_list->terminate();
?>