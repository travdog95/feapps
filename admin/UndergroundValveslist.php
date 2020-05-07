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
$UndergroundValves_list = new UndergroundValves_list();

// Run the page
$UndergroundValves_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$UndergroundValves_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$UndergroundValves_list->isExport()) { ?>
<script>
var fUndergroundValveslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fUndergroundValveslist = currentForm = new ew.Form("fUndergroundValveslist", "list");
	fUndergroundValveslist.formKeyCountName = '<?php echo $UndergroundValves_list->FormKeyCountName ?>';

	// Validate form
	fUndergroundValveslist.validate = function() {
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
			<?php if ($UndergroundValves_list->UndergroundValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_UndergroundValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $UndergroundValves_list->UndergroundValve_Idn->caption(), $UndergroundValves_list->UndergroundValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($UndergroundValves_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $UndergroundValves_list->Name->caption(), $UndergroundValves_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($UndergroundValves_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $UndergroundValves_list->Rank->caption(), $UndergroundValves_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($UndergroundValves_list->Rank->errorMessage()) ?>");
			<?php if ($UndergroundValves_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $UndergroundValves_list->ActiveFlag->caption(), $UndergroundValves_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fUndergroundValveslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fUndergroundValveslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fUndergroundValveslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fUndergroundValveslist.lists["x_ActiveFlag[]"] = <?php echo $UndergroundValves_list->ActiveFlag->Lookup->toClientList($UndergroundValves_list) ?>;
	fUndergroundValveslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($UndergroundValves_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fUndergroundValveslist");
});
var fUndergroundValveslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fUndergroundValveslistsrch = currentSearchForm = new ew.Form("fUndergroundValveslistsrch");

	// Dynamic selection lists
	// Filters

	fUndergroundValveslistsrch.filterList = <?php echo $UndergroundValves_list->getFilterList() ?>;
	loadjs.done("fUndergroundValveslistsrch");
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
<?php if (!$UndergroundValves_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($UndergroundValves_list->TotalRecords > 0 && $UndergroundValves_list->ExportOptions->visible()) { ?>
<?php $UndergroundValves_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($UndergroundValves_list->ImportOptions->visible()) { ?>
<?php $UndergroundValves_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($UndergroundValves_list->SearchOptions->visible()) { ?>
<?php $UndergroundValves_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($UndergroundValves_list->FilterOptions->visible()) { ?>
<?php $UndergroundValves_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$UndergroundValves_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$UndergroundValves_list->isExport() && !$UndergroundValves->CurrentAction) { ?>
<form name="fUndergroundValveslistsrch" id="fUndergroundValveslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fUndergroundValveslistsrch-search-panel" class="<?php echo $UndergroundValves_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="UndergroundValves">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $UndergroundValves_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($UndergroundValves_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($UndergroundValves_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $UndergroundValves_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($UndergroundValves_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($UndergroundValves_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($UndergroundValves_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($UndergroundValves_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $UndergroundValves_list->showPageHeader(); ?>
<?php
$UndergroundValves_list->showMessage();
?>
<?php if ($UndergroundValves_list->TotalRecords > 0 || $UndergroundValves->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($UndergroundValves_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> UndergroundValves">
<?php if (!$UndergroundValves_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$UndergroundValves_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $UndergroundValves_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $UndergroundValves_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fUndergroundValveslist" id="fUndergroundValveslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="UndergroundValves">
<div id="gmp_UndergroundValves" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($UndergroundValves_list->TotalRecords > 0 || $UndergroundValves_list->isAdd() || $UndergroundValves_list->isCopy() || $UndergroundValves_list->isGridEdit()) { ?>
<table id="tbl_UndergroundValveslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$UndergroundValves->RowType = ROWTYPE_HEADER;

// Render list options
$UndergroundValves_list->renderListOptions();

// Render list options (header, left)
$UndergroundValves_list->ListOptions->render("header", "left");
?>
<?php if ($UndergroundValves_list->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
	<?php if ($UndergroundValves_list->SortUrl($UndergroundValves_list->UndergroundValve_Idn) == "") { ?>
		<th data-name="UndergroundValve_Idn" class="<?php echo $UndergroundValves_list->UndergroundValve_Idn->headerCellClass() ?>"><div id="elh_UndergroundValves_UndergroundValve_Idn" class="UndergroundValves_UndergroundValve_Idn"><div class="ew-table-header-caption"><?php echo $UndergroundValves_list->UndergroundValve_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UndergroundValve_Idn" class="<?php echo $UndergroundValves_list->UndergroundValve_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $UndergroundValves_list->SortUrl($UndergroundValves_list->UndergroundValve_Idn) ?>', 1);"><div id="elh_UndergroundValves_UndergroundValve_Idn" class="UndergroundValves_UndergroundValve_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $UndergroundValves_list->UndergroundValve_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($UndergroundValves_list->UndergroundValve_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($UndergroundValves_list->UndergroundValve_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($UndergroundValves_list->Name->Visible) { // Name ?>
	<?php if ($UndergroundValves_list->SortUrl($UndergroundValves_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $UndergroundValves_list->Name->headerCellClass() ?>"><div id="elh_UndergroundValves_Name" class="UndergroundValves_Name"><div class="ew-table-header-caption"><?php echo $UndergroundValves_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $UndergroundValves_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $UndergroundValves_list->SortUrl($UndergroundValves_list->Name) ?>', 1);"><div id="elh_UndergroundValves_Name" class="UndergroundValves_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $UndergroundValves_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($UndergroundValves_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($UndergroundValves_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($UndergroundValves_list->Rank->Visible) { // Rank ?>
	<?php if ($UndergroundValves_list->SortUrl($UndergroundValves_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $UndergroundValves_list->Rank->headerCellClass() ?>"><div id="elh_UndergroundValves_Rank" class="UndergroundValves_Rank"><div class="ew-table-header-caption"><?php echo $UndergroundValves_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $UndergroundValves_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $UndergroundValves_list->SortUrl($UndergroundValves_list->Rank) ?>', 1);"><div id="elh_UndergroundValves_Rank" class="UndergroundValves_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $UndergroundValves_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($UndergroundValves_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($UndergroundValves_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($UndergroundValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($UndergroundValves_list->SortUrl($UndergroundValves_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $UndergroundValves_list->ActiveFlag->headerCellClass() ?>"><div id="elh_UndergroundValves_ActiveFlag" class="UndergroundValves_ActiveFlag"><div class="ew-table-header-caption"><?php echo $UndergroundValves_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $UndergroundValves_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $UndergroundValves_list->SortUrl($UndergroundValves_list->ActiveFlag) ?>', 1);"><div id="elh_UndergroundValves_ActiveFlag" class="UndergroundValves_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $UndergroundValves_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($UndergroundValves_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($UndergroundValves_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$UndergroundValves_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($UndergroundValves_list->isAdd() || $UndergroundValves_list->isCopy()) {
		$UndergroundValves_list->RowIndex = 0;
		$UndergroundValves_list->KeyCount = $UndergroundValves_list->RowIndex;
		if ($UndergroundValves_list->isCopy() && !$UndergroundValves_list->loadRow())
			$UndergroundValves->CurrentAction = "add";
		if ($UndergroundValves_list->isAdd())
			$UndergroundValves_list->loadRowValues();
		if ($UndergroundValves->EventCancelled) // Insert failed
			$UndergroundValves_list->restoreFormValues(); // Restore form values

		// Set row properties
		$UndergroundValves->resetAttributes();
		$UndergroundValves->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_UndergroundValves", "data-rowtype" => ROWTYPE_ADD]);
		$UndergroundValves->RowType = ROWTYPE_ADD;

		// Render row
		$UndergroundValves_list->renderRow();

		// Render list options
		$UndergroundValves_list->renderListOptions();
		$UndergroundValves_list->StartRowCount = 0;
?>
	<tr <?php echo $UndergroundValves->rowAttributes() ?>>
<?php

// Render list options (body, left)
$UndergroundValves_list->ListOptions->render("body", "left", $UndergroundValves_list->RowCount);
?>
	<?php if ($UndergroundValves_list->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
		<td data-name="UndergroundValve_Idn">
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_UndergroundValve_Idn" class="form-group UndergroundValves_UndergroundValve_Idn"></span>
<input type="hidden" data-table="UndergroundValves" data-field="x_UndergroundValve_Idn" name="o<?php echo $UndergroundValves_list->RowIndex ?>_UndergroundValve_Idn" id="o<?php echo $UndergroundValves_list->RowIndex ?>_UndergroundValve_Idn" value="<?php echo HtmlEncode($UndergroundValves_list->UndergroundValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($UndergroundValves_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_Name" class="form-group UndergroundValves_Name">
<input type="text" data-table="UndergroundValves" data-field="x_Name" name="x<?php echo $UndergroundValves_list->RowIndex ?>_Name" id="x<?php echo $UndergroundValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($UndergroundValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $UndergroundValves_list->Name->EditValue ?>"<?php echo $UndergroundValves_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="UndergroundValves" data-field="x_Name" name="o<?php echo $UndergroundValves_list->RowIndex ?>_Name" id="o<?php echo $UndergroundValves_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($UndergroundValves_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($UndergroundValves_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_Rank" class="form-group UndergroundValves_Rank">
<input type="text" data-table="UndergroundValves" data-field="x_Rank" name="x<?php echo $UndergroundValves_list->RowIndex ?>_Rank" id="x<?php echo $UndergroundValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($UndergroundValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $UndergroundValves_list->Rank->EditValue ?>"<?php echo $UndergroundValves_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="UndergroundValves" data-field="x_Rank" name="o<?php echo $UndergroundValves_list->RowIndex ?>_Rank" id="o<?php echo $UndergroundValves_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($UndergroundValves_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($UndergroundValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_ActiveFlag" class="form-group UndergroundValves_ActiveFlag">
<?php
$selwrk = ConvertToBool($UndergroundValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="UndergroundValves" data-field="x_ActiveFlag" name="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]_613119" value="1"<?php echo $selwrk ?><?php echo $UndergroundValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]_613119"></label>
</div>
</span>
<input type="hidden" data-table="UndergroundValves" data-field="x_ActiveFlag" name="o<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($UndergroundValves_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$UndergroundValves_list->ListOptions->render("body", "right", $UndergroundValves_list->RowCount);
?>
<script>
loadjs.ready(["fUndergroundValveslist", "load"], function() {
	fUndergroundValveslist.updateLists(<?php echo $UndergroundValves_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($UndergroundValves_list->ExportAll && $UndergroundValves_list->isExport()) {
	$UndergroundValves_list->StopRecord = $UndergroundValves_list->TotalRecords;
} else {

	// Set the last record to display
	if ($UndergroundValves_list->TotalRecords > $UndergroundValves_list->StartRecord + $UndergroundValves_list->DisplayRecords - 1)
		$UndergroundValves_list->StopRecord = $UndergroundValves_list->StartRecord + $UndergroundValves_list->DisplayRecords - 1;
	else
		$UndergroundValves_list->StopRecord = $UndergroundValves_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($UndergroundValves->isConfirm() || $UndergroundValves_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($UndergroundValves_list->FormKeyCountName) && ($UndergroundValves_list->isGridAdd() || $UndergroundValves_list->isGridEdit() || $UndergroundValves->isConfirm())) {
		$UndergroundValves_list->KeyCount = $CurrentForm->getValue($UndergroundValves_list->FormKeyCountName);
		$UndergroundValves_list->StopRecord = $UndergroundValves_list->StartRecord + $UndergroundValves_list->KeyCount - 1;
	}
}
$UndergroundValves_list->RecordCount = $UndergroundValves_list->StartRecord - 1;
if ($UndergroundValves_list->Recordset && !$UndergroundValves_list->Recordset->EOF) {
	$UndergroundValves_list->Recordset->moveFirst();
	$selectLimit = $UndergroundValves_list->UseSelectLimit;
	if (!$selectLimit && $UndergroundValves_list->StartRecord > 1)
		$UndergroundValves_list->Recordset->move($UndergroundValves_list->StartRecord - 1);
} elseif (!$UndergroundValves->AllowAddDeleteRow && $UndergroundValves_list->StopRecord == 0) {
	$UndergroundValves_list->StopRecord = $UndergroundValves->GridAddRowCount;
}

// Initialize aggregate
$UndergroundValves->RowType = ROWTYPE_AGGREGATEINIT;
$UndergroundValves->resetAttributes();
$UndergroundValves_list->renderRow();
$UndergroundValves_list->EditRowCount = 0;
if ($UndergroundValves_list->isEdit())
	$UndergroundValves_list->RowIndex = 1;
if ($UndergroundValves_list->isGridAdd())
	$UndergroundValves_list->RowIndex = 0;
if ($UndergroundValves_list->isGridEdit())
	$UndergroundValves_list->RowIndex = 0;
while ($UndergroundValves_list->RecordCount < $UndergroundValves_list->StopRecord) {
	$UndergroundValves_list->RecordCount++;
	if ($UndergroundValves_list->RecordCount >= $UndergroundValves_list->StartRecord) {
		$UndergroundValves_list->RowCount++;
		if ($UndergroundValves_list->isGridAdd() || $UndergroundValves_list->isGridEdit() || $UndergroundValves->isConfirm()) {
			$UndergroundValves_list->RowIndex++;
			$CurrentForm->Index = $UndergroundValves_list->RowIndex;
			if ($CurrentForm->hasValue($UndergroundValves_list->FormActionName) && ($UndergroundValves->isConfirm() || $UndergroundValves_list->EventCancelled))
				$UndergroundValves_list->RowAction = strval($CurrentForm->getValue($UndergroundValves_list->FormActionName));
			elseif ($UndergroundValves_list->isGridAdd())
				$UndergroundValves_list->RowAction = "insert";
			else
				$UndergroundValves_list->RowAction = "";
		}

		// Set up key count
		$UndergroundValves_list->KeyCount = $UndergroundValves_list->RowIndex;

		// Init row class and style
		$UndergroundValves->resetAttributes();
		$UndergroundValves->CssClass = "";
		if ($UndergroundValves_list->isGridAdd()) {
			$UndergroundValves_list->loadRowValues(); // Load default values
		} else {
			$UndergroundValves_list->loadRowValues($UndergroundValves_list->Recordset); // Load row values
		}
		$UndergroundValves->RowType = ROWTYPE_VIEW; // Render view
		if ($UndergroundValves_list->isGridAdd()) // Grid add
			$UndergroundValves->RowType = ROWTYPE_ADD; // Render add
		if ($UndergroundValves_list->isGridAdd() && $UndergroundValves->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$UndergroundValves_list->restoreCurrentRowFormValues($UndergroundValves_list->RowIndex); // Restore form values
		if ($UndergroundValves_list->isEdit()) {
			if ($UndergroundValves_list->checkInlineEditKey() && $UndergroundValves_list->EditRowCount == 0) { // Inline edit
				$UndergroundValves->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($UndergroundValves_list->isGridEdit()) { // Grid edit
			if ($UndergroundValves->EventCancelled)
				$UndergroundValves_list->restoreCurrentRowFormValues($UndergroundValves_list->RowIndex); // Restore form values
			if ($UndergroundValves_list->RowAction == "insert")
				$UndergroundValves->RowType = ROWTYPE_ADD; // Render add
			else
				$UndergroundValves->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($UndergroundValves_list->isEdit() && $UndergroundValves->RowType == ROWTYPE_EDIT && $UndergroundValves->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$UndergroundValves_list->restoreFormValues(); // Restore form values
		}
		if ($UndergroundValves_list->isGridEdit() && ($UndergroundValves->RowType == ROWTYPE_EDIT || $UndergroundValves->RowType == ROWTYPE_ADD) && $UndergroundValves->EventCancelled) // Update failed
			$UndergroundValves_list->restoreCurrentRowFormValues($UndergroundValves_list->RowIndex); // Restore form values
		if ($UndergroundValves->RowType == ROWTYPE_EDIT) // Edit row
			$UndergroundValves_list->EditRowCount++;

		// Set up row id / data-rowindex
		$UndergroundValves->RowAttrs->merge(["data-rowindex" => $UndergroundValves_list->RowCount, "id" => "r" . $UndergroundValves_list->RowCount . "_UndergroundValves", "data-rowtype" => $UndergroundValves->RowType]);

		// Render row
		$UndergroundValves_list->renderRow();

		// Render list options
		$UndergroundValves_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($UndergroundValves_list->RowAction != "delete" && $UndergroundValves_list->RowAction != "insertdelete" && !($UndergroundValves_list->RowAction == "insert" && $UndergroundValves->isConfirm() && $UndergroundValves_list->emptyRow())) {
?>
	<tr <?php echo $UndergroundValves->rowAttributes() ?>>
<?php

// Render list options (body, left)
$UndergroundValves_list->ListOptions->render("body", "left", $UndergroundValves_list->RowCount);
?>
	<?php if ($UndergroundValves_list->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
		<td data-name="UndergroundValve_Idn" <?php echo $UndergroundValves_list->UndergroundValve_Idn->cellAttributes() ?>>
<?php if ($UndergroundValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_UndergroundValve_Idn" class="form-group"></span>
<input type="hidden" data-table="UndergroundValves" data-field="x_UndergroundValve_Idn" name="o<?php echo $UndergroundValves_list->RowIndex ?>_UndergroundValve_Idn" id="o<?php echo $UndergroundValves_list->RowIndex ?>_UndergroundValve_Idn" value="<?php echo HtmlEncode($UndergroundValves_list->UndergroundValve_Idn->OldValue) ?>">
<?php } ?>
<?php if ($UndergroundValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_UndergroundValve_Idn" class="form-group">
<span<?php echo $UndergroundValves_list->UndergroundValve_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($UndergroundValves_list->UndergroundValve_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="UndergroundValves" data-field="x_UndergroundValve_Idn" name="x<?php echo $UndergroundValves_list->RowIndex ?>_UndergroundValve_Idn" id="x<?php echo $UndergroundValves_list->RowIndex ?>_UndergroundValve_Idn" value="<?php echo HtmlEncode($UndergroundValves_list->UndergroundValve_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($UndergroundValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_UndergroundValve_Idn">
<span<?php echo $UndergroundValves_list->UndergroundValve_Idn->viewAttributes() ?>><?php echo $UndergroundValves_list->UndergroundValve_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($UndergroundValves_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $UndergroundValves_list->Name->cellAttributes() ?>>
<?php if ($UndergroundValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_Name" class="form-group">
<input type="text" data-table="UndergroundValves" data-field="x_Name" name="x<?php echo $UndergroundValves_list->RowIndex ?>_Name" id="x<?php echo $UndergroundValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($UndergroundValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $UndergroundValves_list->Name->EditValue ?>"<?php echo $UndergroundValves_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="UndergroundValves" data-field="x_Name" name="o<?php echo $UndergroundValves_list->RowIndex ?>_Name" id="o<?php echo $UndergroundValves_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($UndergroundValves_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($UndergroundValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_Name" class="form-group">
<input type="text" data-table="UndergroundValves" data-field="x_Name" name="x<?php echo $UndergroundValves_list->RowIndex ?>_Name" id="x<?php echo $UndergroundValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($UndergroundValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $UndergroundValves_list->Name->EditValue ?>"<?php echo $UndergroundValves_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($UndergroundValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_Name">
<span<?php echo $UndergroundValves_list->Name->viewAttributes() ?>><?php echo $UndergroundValves_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($UndergroundValves_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $UndergroundValves_list->Rank->cellAttributes() ?>>
<?php if ($UndergroundValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_Rank" class="form-group">
<input type="text" data-table="UndergroundValves" data-field="x_Rank" name="x<?php echo $UndergroundValves_list->RowIndex ?>_Rank" id="x<?php echo $UndergroundValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($UndergroundValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $UndergroundValves_list->Rank->EditValue ?>"<?php echo $UndergroundValves_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="UndergroundValves" data-field="x_Rank" name="o<?php echo $UndergroundValves_list->RowIndex ?>_Rank" id="o<?php echo $UndergroundValves_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($UndergroundValves_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($UndergroundValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_Rank" class="form-group">
<input type="text" data-table="UndergroundValves" data-field="x_Rank" name="x<?php echo $UndergroundValves_list->RowIndex ?>_Rank" id="x<?php echo $UndergroundValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($UndergroundValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $UndergroundValves_list->Rank->EditValue ?>"<?php echo $UndergroundValves_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($UndergroundValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_Rank">
<span<?php echo $UndergroundValves_list->Rank->viewAttributes() ?>><?php echo $UndergroundValves_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($UndergroundValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $UndergroundValves_list->ActiveFlag->cellAttributes() ?>>
<?php if ($UndergroundValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($UndergroundValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="UndergroundValves" data-field="x_ActiveFlag" name="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]_151741" value="1"<?php echo $selwrk ?><?php echo $UndergroundValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]_151741"></label>
</div>
</span>
<input type="hidden" data-table="UndergroundValves" data-field="x_ActiveFlag" name="o<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($UndergroundValves_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($UndergroundValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($UndergroundValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="UndergroundValves" data-field="x_ActiveFlag" name="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]_993213" value="1"<?php echo $selwrk ?><?php echo $UndergroundValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]_993213"></label>
</div>
</span>
<?php } ?>
<?php if ($UndergroundValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $UndergroundValves_list->RowCount ?>_UndergroundValves_ActiveFlag">
<span<?php echo $UndergroundValves_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $UndergroundValves_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($UndergroundValves_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$UndergroundValves_list->ListOptions->render("body", "right", $UndergroundValves_list->RowCount);
?>
	</tr>
<?php if ($UndergroundValves->RowType == ROWTYPE_ADD || $UndergroundValves->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fUndergroundValveslist", "load"], function() {
	fUndergroundValveslist.updateLists(<?php echo $UndergroundValves_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$UndergroundValves_list->isGridAdd())
		if (!$UndergroundValves_list->Recordset->EOF)
			$UndergroundValves_list->Recordset->moveNext();
}
?>
<?php
	if ($UndergroundValves_list->isGridAdd() || $UndergroundValves_list->isGridEdit()) {
		$UndergroundValves_list->RowIndex = '$rowindex$';
		$UndergroundValves_list->loadRowValues();

		// Set row properties
		$UndergroundValves->resetAttributes();
		$UndergroundValves->RowAttrs->merge(["data-rowindex" => $UndergroundValves_list->RowIndex, "id" => "r0_UndergroundValves", "data-rowtype" => ROWTYPE_ADD]);
		$UndergroundValves->RowAttrs->appendClass("ew-template");
		$UndergroundValves->RowType = ROWTYPE_ADD;

		// Render row
		$UndergroundValves_list->renderRow();

		// Render list options
		$UndergroundValves_list->renderListOptions();
		$UndergroundValves_list->StartRowCount = 0;
?>
	<tr <?php echo $UndergroundValves->rowAttributes() ?>>
<?php

// Render list options (body, left)
$UndergroundValves_list->ListOptions->render("body", "left", $UndergroundValves_list->RowIndex);
?>
	<?php if ($UndergroundValves_list->UndergroundValve_Idn->Visible) { // UndergroundValve_Idn ?>
		<td data-name="UndergroundValve_Idn">
<span id="el$rowindex$_UndergroundValves_UndergroundValve_Idn" class="form-group UndergroundValves_UndergroundValve_Idn"></span>
<input type="hidden" data-table="UndergroundValves" data-field="x_UndergroundValve_Idn" name="o<?php echo $UndergroundValves_list->RowIndex ?>_UndergroundValve_Idn" id="o<?php echo $UndergroundValves_list->RowIndex ?>_UndergroundValve_Idn" value="<?php echo HtmlEncode($UndergroundValves_list->UndergroundValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($UndergroundValves_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_UndergroundValves_Name" class="form-group UndergroundValves_Name">
<input type="text" data-table="UndergroundValves" data-field="x_Name" name="x<?php echo $UndergroundValves_list->RowIndex ?>_Name" id="x<?php echo $UndergroundValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($UndergroundValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $UndergroundValves_list->Name->EditValue ?>"<?php echo $UndergroundValves_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="UndergroundValves" data-field="x_Name" name="o<?php echo $UndergroundValves_list->RowIndex ?>_Name" id="o<?php echo $UndergroundValves_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($UndergroundValves_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($UndergroundValves_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_UndergroundValves_Rank" class="form-group UndergroundValves_Rank">
<input type="text" data-table="UndergroundValves" data-field="x_Rank" name="x<?php echo $UndergroundValves_list->RowIndex ?>_Rank" id="x<?php echo $UndergroundValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($UndergroundValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $UndergroundValves_list->Rank->EditValue ?>"<?php echo $UndergroundValves_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="UndergroundValves" data-field="x_Rank" name="o<?php echo $UndergroundValves_list->RowIndex ?>_Rank" id="o<?php echo $UndergroundValves_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($UndergroundValves_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($UndergroundValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_UndergroundValves_ActiveFlag" class="form-group UndergroundValves_ActiveFlag">
<?php
$selwrk = ConvertToBool($UndergroundValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="UndergroundValves" data-field="x_ActiveFlag" name="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]_265108" value="1"<?php echo $selwrk ?><?php echo $UndergroundValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]_265108"></label>
</div>
</span>
<input type="hidden" data-table="UndergroundValves" data-field="x_ActiveFlag" name="o<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $UndergroundValves_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($UndergroundValves_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$UndergroundValves_list->ListOptions->render("body", "right", $UndergroundValves_list->RowIndex);
?>
<script>
loadjs.ready(["fUndergroundValveslist", "load"], function() {
	fUndergroundValveslist.updateLists(<?php echo $UndergroundValves_list->RowIndex ?>);
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
<?php if ($UndergroundValves_list->isAdd() || $UndergroundValves_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $UndergroundValves_list->FormKeyCountName ?>" id="<?php echo $UndergroundValves_list->FormKeyCountName ?>" value="<?php echo $UndergroundValves_list->KeyCount ?>">
<?php } ?>
<?php if ($UndergroundValves_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $UndergroundValves_list->FormKeyCountName ?>" id="<?php echo $UndergroundValves_list->FormKeyCountName ?>" value="<?php echo $UndergroundValves_list->KeyCount ?>">
<?php echo $UndergroundValves_list->MultiSelectKey ?>
<?php } ?>
<?php if ($UndergroundValves_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $UndergroundValves_list->FormKeyCountName ?>" id="<?php echo $UndergroundValves_list->FormKeyCountName ?>" value="<?php echo $UndergroundValves_list->KeyCount ?>">
<?php } ?>
<?php if ($UndergroundValves_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $UndergroundValves_list->FormKeyCountName ?>" id="<?php echo $UndergroundValves_list->FormKeyCountName ?>" value="<?php echo $UndergroundValves_list->KeyCount ?>">
<?php echo $UndergroundValves_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$UndergroundValves->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($UndergroundValves_list->Recordset)
	$UndergroundValves_list->Recordset->Close();
?>
<?php if (!$UndergroundValves_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$UndergroundValves_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $UndergroundValves_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $UndergroundValves_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($UndergroundValves_list->TotalRecords == 0 && !$UndergroundValves->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $UndergroundValves_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$UndergroundValves_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$UndergroundValves_list->isExport()) { ?>
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
$UndergroundValves_list->terminate();
?>