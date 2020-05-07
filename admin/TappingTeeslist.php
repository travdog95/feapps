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
$TappingTees_list = new TappingTees_list();

// Run the page
$TappingTees_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TappingTees_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$TappingTees_list->isExport()) { ?>
<script>
var fTappingTeeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fTappingTeeslist = currentForm = new ew.Form("fTappingTeeslist", "list");
	fTappingTeeslist.formKeyCountName = '<?php echo $TappingTees_list->FormKeyCountName ?>';

	// Validate form
	fTappingTeeslist.validate = function() {
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
			<?php if ($TappingTees_list->TappingTee_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_TappingTee_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TappingTees_list->TappingTee_Idn->caption(), $TappingTees_list->TappingTee_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TappingTee_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($TappingTees_list->TappingTee_Idn->errorMessage()) ?>");
			<?php if ($TappingTees_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TappingTees_list->Name->caption(), $TappingTees_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($TappingTees_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TappingTees_list->Rank->caption(), $TappingTees_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($TappingTees_list->Rank->errorMessage()) ?>");
			<?php if ($TappingTees_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TappingTees_list->ActiveFlag->caption(), $TappingTees_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fTappingTeeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "TappingTee_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fTappingTeeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fTappingTeeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fTappingTeeslist.lists["x_ActiveFlag[]"] = <?php echo $TappingTees_list->ActiveFlag->Lookup->toClientList($TappingTees_list) ?>;
	fTappingTeeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($TappingTees_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fTappingTeeslist");
});
var fTappingTeeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fTappingTeeslistsrch = currentSearchForm = new ew.Form("fTappingTeeslistsrch");

	// Dynamic selection lists
	// Filters

	fTappingTeeslistsrch.filterList = <?php echo $TappingTees_list->getFilterList() ?>;
	loadjs.done("fTappingTeeslistsrch");
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
<?php if (!$TappingTees_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($TappingTees_list->TotalRecords > 0 && $TappingTees_list->ExportOptions->visible()) { ?>
<?php $TappingTees_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($TappingTees_list->ImportOptions->visible()) { ?>
<?php $TappingTees_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($TappingTees_list->SearchOptions->visible()) { ?>
<?php $TappingTees_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($TappingTees_list->FilterOptions->visible()) { ?>
<?php $TappingTees_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$TappingTees_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$TappingTees_list->isExport() && !$TappingTees->CurrentAction) { ?>
<form name="fTappingTeeslistsrch" id="fTappingTeeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fTappingTeeslistsrch-search-panel" class="<?php echo $TappingTees_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="TappingTees">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $TappingTees_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($TappingTees_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($TappingTees_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $TappingTees_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($TappingTees_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($TappingTees_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($TappingTees_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($TappingTees_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $TappingTees_list->showPageHeader(); ?>
<?php
$TappingTees_list->showMessage();
?>
<?php if ($TappingTees_list->TotalRecords > 0 || $TappingTees->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($TappingTees_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> TappingTees">
<?php if (!$TappingTees_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$TappingTees_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $TappingTees_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $TappingTees_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fTappingTeeslist" id="fTappingTeeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TappingTees">
<div id="gmp_TappingTees" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($TappingTees_list->TotalRecords > 0 || $TappingTees_list->isAdd() || $TappingTees_list->isCopy() || $TappingTees_list->isGridEdit()) { ?>
<table id="tbl_TappingTeeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$TappingTees->RowType = ROWTYPE_HEADER;

// Render list options
$TappingTees_list->renderListOptions();

// Render list options (header, left)
$TappingTees_list->ListOptions->render("header", "left");
?>
<?php if ($TappingTees_list->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
	<?php if ($TappingTees_list->SortUrl($TappingTees_list->TappingTee_Idn) == "") { ?>
		<th data-name="TappingTee_Idn" class="<?php echo $TappingTees_list->TappingTee_Idn->headerCellClass() ?>"><div id="elh_TappingTees_TappingTee_Idn" class="TappingTees_TappingTee_Idn"><div class="ew-table-header-caption"><?php echo $TappingTees_list->TappingTee_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TappingTee_Idn" class="<?php echo $TappingTees_list->TappingTee_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $TappingTees_list->SortUrl($TappingTees_list->TappingTee_Idn) ?>', 1);"><div id="elh_TappingTees_TappingTee_Idn" class="TappingTees_TappingTee_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TappingTees_list->TappingTee_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($TappingTees_list->TappingTee_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($TappingTees_list->TappingTee_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TappingTees_list->Name->Visible) { // Name ?>
	<?php if ($TappingTees_list->SortUrl($TappingTees_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $TappingTees_list->Name->headerCellClass() ?>"><div id="elh_TappingTees_Name" class="TappingTees_Name"><div class="ew-table-header-caption"><?php echo $TappingTees_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $TappingTees_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $TappingTees_list->SortUrl($TappingTees_list->Name) ?>', 1);"><div id="elh_TappingTees_Name" class="TappingTees_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TappingTees_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($TappingTees_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($TappingTees_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TappingTees_list->Rank->Visible) { // Rank ?>
	<?php if ($TappingTees_list->SortUrl($TappingTees_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $TappingTees_list->Rank->headerCellClass() ?>"><div id="elh_TappingTees_Rank" class="TappingTees_Rank"><div class="ew-table-header-caption"><?php echo $TappingTees_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $TappingTees_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $TappingTees_list->SortUrl($TappingTees_list->Rank) ?>', 1);"><div id="elh_TappingTees_Rank" class="TappingTees_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TappingTees_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($TappingTees_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($TappingTees_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TappingTees_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($TappingTees_list->SortUrl($TappingTees_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $TappingTees_list->ActiveFlag->headerCellClass() ?>"><div id="elh_TappingTees_ActiveFlag" class="TappingTees_ActiveFlag"><div class="ew-table-header-caption"><?php echo $TappingTees_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $TappingTees_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $TappingTees_list->SortUrl($TappingTees_list->ActiveFlag) ?>', 1);"><div id="elh_TappingTees_ActiveFlag" class="TappingTees_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TappingTees_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($TappingTees_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($TappingTees_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$TappingTees_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($TappingTees_list->isAdd() || $TappingTees_list->isCopy()) {
		$TappingTees_list->RowIndex = 0;
		$TappingTees_list->KeyCount = $TappingTees_list->RowIndex;
		if ($TappingTees_list->isCopy() && !$TappingTees_list->loadRow())
			$TappingTees->CurrentAction = "add";
		if ($TappingTees_list->isAdd())
			$TappingTees_list->loadRowValues();
		if ($TappingTees->EventCancelled) // Insert failed
			$TappingTees_list->restoreFormValues(); // Restore form values

		// Set row properties
		$TappingTees->resetAttributes();
		$TappingTees->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_TappingTees", "data-rowtype" => ROWTYPE_ADD]);
		$TappingTees->RowType = ROWTYPE_ADD;

		// Render row
		$TappingTees_list->renderRow();

		// Render list options
		$TappingTees_list->renderListOptions();
		$TappingTees_list->StartRowCount = 0;
?>
	<tr <?php echo $TappingTees->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TappingTees_list->ListOptions->render("body", "left", $TappingTees_list->RowCount);
?>
	<?php if ($TappingTees_list->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
		<td data-name="TappingTee_Idn">
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_TappingTee_Idn" class="form-group TappingTees_TappingTee_Idn">
<input type="text" data-table="TappingTees" data-field="x_TappingTee_Idn" name="x<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" id="x<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TappingTees_list->TappingTee_Idn->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->TappingTee_Idn->EditValue ?>"<?php echo $TappingTees_list->TappingTee_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_TappingTee_Idn" name="o<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" id="o<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" value="<?php echo HtmlEncode($TappingTees_list->TappingTee_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TappingTees_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_Name" class="form-group TappingTees_Name">
<input type="text" data-table="TappingTees" data-field="x_Name" name="x<?php echo $TappingTees_list->RowIndex ?>_Name" id="x<?php echo $TappingTees_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TappingTees_list->Name->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->Name->EditValue ?>"<?php echo $TappingTees_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_Name" name="o<?php echo $TappingTees_list->RowIndex ?>_Name" id="o<?php echo $TappingTees_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($TappingTees_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TappingTees_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_Rank" class="form-group TappingTees_Rank">
<input type="text" data-table="TappingTees" data-field="x_Rank" name="x<?php echo $TappingTees_list->RowIndex ?>_Rank" id="x<?php echo $TappingTees_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TappingTees_list->Rank->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->Rank->EditValue ?>"<?php echo $TappingTees_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_Rank" name="o<?php echo $TappingTees_list->RowIndex ?>_Rank" id="o<?php echo $TappingTees_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($TappingTees_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TappingTees_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_ActiveFlag" class="form-group TappingTees_ActiveFlag">
<?php
$selwrk = ConvertToBool($TappingTees_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="TappingTees" data-field="x_ActiveFlag" name="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]_474049" value="1"<?php echo $selwrk ?><?php echo $TappingTees_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]_474049"></label>
</div>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_ActiveFlag" name="o<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($TappingTees_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TappingTees_list->ListOptions->render("body", "right", $TappingTees_list->RowCount);
?>
<script>
loadjs.ready(["fTappingTeeslist", "load"], function() {
	fTappingTeeslist.updateLists(<?php echo $TappingTees_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($TappingTees_list->ExportAll && $TappingTees_list->isExport()) {
	$TappingTees_list->StopRecord = $TappingTees_list->TotalRecords;
} else {

	// Set the last record to display
	if ($TappingTees_list->TotalRecords > $TappingTees_list->StartRecord + $TappingTees_list->DisplayRecords - 1)
		$TappingTees_list->StopRecord = $TappingTees_list->StartRecord + $TappingTees_list->DisplayRecords - 1;
	else
		$TappingTees_list->StopRecord = $TappingTees_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($TappingTees->isConfirm() || $TappingTees_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($TappingTees_list->FormKeyCountName) && ($TappingTees_list->isGridAdd() || $TappingTees_list->isGridEdit() || $TappingTees->isConfirm())) {
		$TappingTees_list->KeyCount = $CurrentForm->getValue($TappingTees_list->FormKeyCountName);
		$TappingTees_list->StopRecord = $TappingTees_list->StartRecord + $TappingTees_list->KeyCount - 1;
	}
}
$TappingTees_list->RecordCount = $TappingTees_list->StartRecord - 1;
if ($TappingTees_list->Recordset && !$TappingTees_list->Recordset->EOF) {
	$TappingTees_list->Recordset->moveFirst();
	$selectLimit = $TappingTees_list->UseSelectLimit;
	if (!$selectLimit && $TappingTees_list->StartRecord > 1)
		$TappingTees_list->Recordset->move($TappingTees_list->StartRecord - 1);
} elseif (!$TappingTees->AllowAddDeleteRow && $TappingTees_list->StopRecord == 0) {
	$TappingTees_list->StopRecord = $TappingTees->GridAddRowCount;
}

// Initialize aggregate
$TappingTees->RowType = ROWTYPE_AGGREGATEINIT;
$TappingTees->resetAttributes();
$TappingTees_list->renderRow();
$TappingTees_list->EditRowCount = 0;
if ($TappingTees_list->isEdit())
	$TappingTees_list->RowIndex = 1;
if ($TappingTees_list->isGridAdd())
	$TappingTees_list->RowIndex = 0;
if ($TappingTees_list->isGridEdit())
	$TappingTees_list->RowIndex = 0;
while ($TappingTees_list->RecordCount < $TappingTees_list->StopRecord) {
	$TappingTees_list->RecordCount++;
	if ($TappingTees_list->RecordCount >= $TappingTees_list->StartRecord) {
		$TappingTees_list->RowCount++;
		if ($TappingTees_list->isGridAdd() || $TappingTees_list->isGridEdit() || $TappingTees->isConfirm()) {
			$TappingTees_list->RowIndex++;
			$CurrentForm->Index = $TappingTees_list->RowIndex;
			if ($CurrentForm->hasValue($TappingTees_list->FormActionName) && ($TappingTees->isConfirm() || $TappingTees_list->EventCancelled))
				$TappingTees_list->RowAction = strval($CurrentForm->getValue($TappingTees_list->FormActionName));
			elseif ($TappingTees_list->isGridAdd())
				$TappingTees_list->RowAction = "insert";
			else
				$TappingTees_list->RowAction = "";
		}

		// Set up key count
		$TappingTees_list->KeyCount = $TappingTees_list->RowIndex;

		// Init row class and style
		$TappingTees->resetAttributes();
		$TappingTees->CssClass = "";
		if ($TappingTees_list->isGridAdd()) {
			$TappingTees_list->loadRowValues(); // Load default values
		} else {
			$TappingTees_list->loadRowValues($TappingTees_list->Recordset); // Load row values
		}
		$TappingTees->RowType = ROWTYPE_VIEW; // Render view
		if ($TappingTees_list->isGridAdd()) // Grid add
			$TappingTees->RowType = ROWTYPE_ADD; // Render add
		if ($TappingTees_list->isGridAdd() && $TappingTees->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$TappingTees_list->restoreCurrentRowFormValues($TappingTees_list->RowIndex); // Restore form values
		if ($TappingTees_list->isEdit()) {
			if ($TappingTees_list->checkInlineEditKey() && $TappingTees_list->EditRowCount == 0) { // Inline edit
				$TappingTees->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($TappingTees_list->isGridEdit()) { // Grid edit
			if ($TappingTees->EventCancelled)
				$TappingTees_list->restoreCurrentRowFormValues($TappingTees_list->RowIndex); // Restore form values
			if ($TappingTees_list->RowAction == "insert")
				$TappingTees->RowType = ROWTYPE_ADD; // Render add
			else
				$TappingTees->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($TappingTees_list->isEdit() && $TappingTees->RowType == ROWTYPE_EDIT && $TappingTees->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$TappingTees_list->restoreFormValues(); // Restore form values
		}
		if ($TappingTees_list->isGridEdit() && ($TappingTees->RowType == ROWTYPE_EDIT || $TappingTees->RowType == ROWTYPE_ADD) && $TappingTees->EventCancelled) // Update failed
			$TappingTees_list->restoreCurrentRowFormValues($TappingTees_list->RowIndex); // Restore form values
		if ($TappingTees->RowType == ROWTYPE_EDIT) // Edit row
			$TappingTees_list->EditRowCount++;

		// Set up row id / data-rowindex
		$TappingTees->RowAttrs->merge(["data-rowindex" => $TappingTees_list->RowCount, "id" => "r" . $TappingTees_list->RowCount . "_TappingTees", "data-rowtype" => $TappingTees->RowType]);

		// Render row
		$TappingTees_list->renderRow();

		// Render list options
		$TappingTees_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($TappingTees_list->RowAction != "delete" && $TappingTees_list->RowAction != "insertdelete" && !($TappingTees_list->RowAction == "insert" && $TappingTees->isConfirm() && $TappingTees_list->emptyRow())) {
?>
	<tr <?php echo $TappingTees->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TappingTees_list->ListOptions->render("body", "left", $TappingTees_list->RowCount);
?>
	<?php if ($TappingTees_list->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
		<td data-name="TappingTee_Idn" <?php echo $TappingTees_list->TappingTee_Idn->cellAttributes() ?>>
<?php if ($TappingTees->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_TappingTee_Idn" class="form-group">
<input type="text" data-table="TappingTees" data-field="x_TappingTee_Idn" name="x<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" id="x<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TappingTees_list->TappingTee_Idn->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->TappingTee_Idn->EditValue ?>"<?php echo $TappingTees_list->TappingTee_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_TappingTee_Idn" name="o<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" id="o<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" value="<?php echo HtmlEncode($TappingTees_list->TappingTee_Idn->OldValue) ?>">
<?php } ?>
<?php if ($TappingTees->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="TappingTees" data-field="x_TappingTee_Idn" name="x<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" id="x<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TappingTees_list->TappingTee_Idn->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->TappingTee_Idn->EditValue ?>"<?php echo $TappingTees_list->TappingTee_Idn->editAttributes() ?>>
<input type="hidden" data-table="TappingTees" data-field="x_TappingTee_Idn" name="o<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" id="o<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" value="<?php echo HtmlEncode($TappingTees_list->TappingTee_Idn->OldValue != null ? $TappingTees_list->TappingTee_Idn->OldValue : $TappingTees_list->TappingTee_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($TappingTees->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_TappingTee_Idn">
<span<?php echo $TappingTees_list->TappingTee_Idn->viewAttributes() ?>><?php echo $TappingTees_list->TappingTee_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($TappingTees_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $TappingTees_list->Name->cellAttributes() ?>>
<?php if ($TappingTees->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_Name" class="form-group">
<input type="text" data-table="TappingTees" data-field="x_Name" name="x<?php echo $TappingTees_list->RowIndex ?>_Name" id="x<?php echo $TappingTees_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TappingTees_list->Name->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->Name->EditValue ?>"<?php echo $TappingTees_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_Name" name="o<?php echo $TappingTees_list->RowIndex ?>_Name" id="o<?php echo $TappingTees_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($TappingTees_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($TappingTees->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_Name" class="form-group">
<input type="text" data-table="TappingTees" data-field="x_Name" name="x<?php echo $TappingTees_list->RowIndex ?>_Name" id="x<?php echo $TappingTees_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TappingTees_list->Name->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->Name->EditValue ?>"<?php echo $TappingTees_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($TappingTees->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_Name">
<span<?php echo $TappingTees_list->Name->viewAttributes() ?>><?php echo $TappingTees_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($TappingTees_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $TappingTees_list->Rank->cellAttributes() ?>>
<?php if ($TappingTees->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_Rank" class="form-group">
<input type="text" data-table="TappingTees" data-field="x_Rank" name="x<?php echo $TappingTees_list->RowIndex ?>_Rank" id="x<?php echo $TappingTees_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TappingTees_list->Rank->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->Rank->EditValue ?>"<?php echo $TappingTees_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_Rank" name="o<?php echo $TappingTees_list->RowIndex ?>_Rank" id="o<?php echo $TappingTees_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($TappingTees_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($TappingTees->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_Rank" class="form-group">
<input type="text" data-table="TappingTees" data-field="x_Rank" name="x<?php echo $TappingTees_list->RowIndex ?>_Rank" id="x<?php echo $TappingTees_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TappingTees_list->Rank->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->Rank->EditValue ?>"<?php echo $TappingTees_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($TappingTees->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_Rank">
<span<?php echo $TappingTees_list->Rank->viewAttributes() ?>><?php echo $TappingTees_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($TappingTees_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $TappingTees_list->ActiveFlag->cellAttributes() ?>>
<?php if ($TappingTees->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($TappingTees_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="TappingTees" data-field="x_ActiveFlag" name="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]_926581" value="1"<?php echo $selwrk ?><?php echo $TappingTees_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]_926581"></label>
</div>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_ActiveFlag" name="o<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($TappingTees_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($TappingTees->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($TappingTees_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="TappingTees" data-field="x_ActiveFlag" name="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]_697017" value="1"<?php echo $selwrk ?><?php echo $TappingTees_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]_697017"></label>
</div>
</span>
<?php } ?>
<?php if ($TappingTees->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TappingTees_list->RowCount ?>_TappingTees_ActiveFlag">
<span<?php echo $TappingTees_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $TappingTees_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($TappingTees_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TappingTees_list->ListOptions->render("body", "right", $TappingTees_list->RowCount);
?>
	</tr>
<?php if ($TappingTees->RowType == ROWTYPE_ADD || $TappingTees->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fTappingTeeslist", "load"], function() {
	fTappingTeeslist.updateLists(<?php echo $TappingTees_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$TappingTees_list->isGridAdd())
		if (!$TappingTees_list->Recordset->EOF)
			$TappingTees_list->Recordset->moveNext();
}
?>
<?php
	if ($TappingTees_list->isGridAdd() || $TappingTees_list->isGridEdit()) {
		$TappingTees_list->RowIndex = '$rowindex$';
		$TappingTees_list->loadRowValues();

		// Set row properties
		$TappingTees->resetAttributes();
		$TappingTees->RowAttrs->merge(["data-rowindex" => $TappingTees_list->RowIndex, "id" => "r0_TappingTees", "data-rowtype" => ROWTYPE_ADD]);
		$TappingTees->RowAttrs->appendClass("ew-template");
		$TappingTees->RowType = ROWTYPE_ADD;

		// Render row
		$TappingTees_list->renderRow();

		// Render list options
		$TappingTees_list->renderListOptions();
		$TappingTees_list->StartRowCount = 0;
?>
	<tr <?php echo $TappingTees->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TappingTees_list->ListOptions->render("body", "left", $TappingTees_list->RowIndex);
?>
	<?php if ($TappingTees_list->TappingTee_Idn->Visible) { // TappingTee_Idn ?>
		<td data-name="TappingTee_Idn">
<span id="el$rowindex$_TappingTees_TappingTee_Idn" class="form-group TappingTees_TappingTee_Idn">
<input type="text" data-table="TappingTees" data-field="x_TappingTee_Idn" name="x<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" id="x<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TappingTees_list->TappingTee_Idn->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->TappingTee_Idn->EditValue ?>"<?php echo $TappingTees_list->TappingTee_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_TappingTee_Idn" name="o<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" id="o<?php echo $TappingTees_list->RowIndex ?>_TappingTee_Idn" value="<?php echo HtmlEncode($TappingTees_list->TappingTee_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TappingTees_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_TappingTees_Name" class="form-group TappingTees_Name">
<input type="text" data-table="TappingTees" data-field="x_Name" name="x<?php echo $TappingTees_list->RowIndex ?>_Name" id="x<?php echo $TappingTees_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TappingTees_list->Name->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->Name->EditValue ?>"<?php echo $TappingTees_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_Name" name="o<?php echo $TappingTees_list->RowIndex ?>_Name" id="o<?php echo $TappingTees_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($TappingTees_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TappingTees_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_TappingTees_Rank" class="form-group TappingTees_Rank">
<input type="text" data-table="TappingTees" data-field="x_Rank" name="x<?php echo $TappingTees_list->RowIndex ?>_Rank" id="x<?php echo $TappingTees_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($TappingTees_list->Rank->getPlaceHolder()) ?>" value="<?php echo $TappingTees_list->Rank->EditValue ?>"<?php echo $TappingTees_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_Rank" name="o<?php echo $TappingTees_list->RowIndex ?>_Rank" id="o<?php echo $TappingTees_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($TappingTees_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TappingTees_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_TappingTees_ActiveFlag" class="form-group TappingTees_ActiveFlag">
<?php
$selwrk = ConvertToBool($TappingTees_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="TappingTees" data-field="x_ActiveFlag" name="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]_583931" value="1"<?php echo $selwrk ?><?php echo $TappingTees_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]_583931"></label>
</div>
</span>
<input type="hidden" data-table="TappingTees" data-field="x_ActiveFlag" name="o<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $TappingTees_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($TappingTees_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TappingTees_list->ListOptions->render("body", "right", $TappingTees_list->RowIndex);
?>
<script>
loadjs.ready(["fTappingTeeslist", "load"], function() {
	fTappingTeeslist.updateLists(<?php echo $TappingTees_list->RowIndex ?>);
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
<?php if ($TappingTees_list->isAdd() || $TappingTees_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $TappingTees_list->FormKeyCountName ?>" id="<?php echo $TappingTees_list->FormKeyCountName ?>" value="<?php echo $TappingTees_list->KeyCount ?>">
<?php } ?>
<?php if ($TappingTees_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $TappingTees_list->FormKeyCountName ?>" id="<?php echo $TappingTees_list->FormKeyCountName ?>" value="<?php echo $TappingTees_list->KeyCount ?>">
<?php echo $TappingTees_list->MultiSelectKey ?>
<?php } ?>
<?php if ($TappingTees_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $TappingTees_list->FormKeyCountName ?>" id="<?php echo $TappingTees_list->FormKeyCountName ?>" value="<?php echo $TappingTees_list->KeyCount ?>">
<?php } ?>
<?php if ($TappingTees_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $TappingTees_list->FormKeyCountName ?>" id="<?php echo $TappingTees_list->FormKeyCountName ?>" value="<?php echo $TappingTees_list->KeyCount ?>">
<?php echo $TappingTees_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$TappingTees->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($TappingTees_list->Recordset)
	$TappingTees_list->Recordset->Close();
?>
<?php if (!$TappingTees_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$TappingTees_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $TappingTees_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $TappingTees_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($TappingTees_list->TotalRecords == 0 && !$TappingTees->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $TappingTees_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$TappingTees_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$TappingTees_list->isExport()) { ?>
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
$TappingTees_list->terminate();
?>