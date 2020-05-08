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
$ControlValves_list = new ControlValves_list();

// Run the page
$ControlValves_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ControlValves_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ControlValves_list->isExport()) { ?>
<script>
var fControlValveslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fControlValveslist = currentForm = new ew.Form("fControlValveslist", "list");
	fControlValveslist.formKeyCountName = '<?php echo $ControlValves_list->FormKeyCountName ?>';

	// Validate form
	fControlValveslist.validate = function() {
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
			<?php if ($ControlValves_list->ControlValve_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ControlValve_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ControlValves_list->ControlValve_Idn->caption(), $ControlValves_list->ControlValve_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ControlValve_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ControlValves_list->ControlValve_Idn->errorMessage()) ?>");
			<?php if ($ControlValves_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ControlValves_list->Name->caption(), $ControlValves_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ControlValves_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ControlValves_list->Rank->caption(), $ControlValves_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ControlValves_list->Rank->errorMessage()) ?>");
			<?php if ($ControlValves_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ControlValves_list->ActiveFlag->caption(), $ControlValves_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fControlValveslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ControlValve_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fControlValveslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fControlValveslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fControlValveslist.lists["x_ActiveFlag[]"] = <?php echo $ControlValves_list->ActiveFlag->Lookup->toClientList($ControlValves_list) ?>;
	fControlValveslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ControlValves_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fControlValveslist");
});
var fControlValveslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fControlValveslistsrch = currentSearchForm = new ew.Form("fControlValveslistsrch");

	// Dynamic selection lists
	// Filters

	fControlValveslistsrch.filterList = <?php echo $ControlValves_list->getFilterList() ?>;
	loadjs.done("fControlValveslistsrch");
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
<?php if (!$ControlValves_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ControlValves_list->TotalRecords > 0 && $ControlValves_list->ExportOptions->visible()) { ?>
<?php $ControlValves_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ControlValves_list->ImportOptions->visible()) { ?>
<?php $ControlValves_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ControlValves_list->SearchOptions->visible()) { ?>
<?php $ControlValves_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ControlValves_list->FilterOptions->visible()) { ?>
<?php $ControlValves_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ControlValves_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ControlValves_list->isExport() && !$ControlValves->CurrentAction) { ?>
<form name="fControlValveslistsrch" id="fControlValveslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fControlValveslistsrch-search-panel" class="<?php echo $ControlValves_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ControlValves">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ControlValves_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ControlValves_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ControlValves_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ControlValves_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ControlValves_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ControlValves_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ControlValves_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ControlValves_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ControlValves_list->showPageHeader(); ?>
<?php
$ControlValves_list->showMessage();
?>
<?php if ($ControlValves_list->TotalRecords > 0 || $ControlValves->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ControlValves_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ControlValves">
<?php if (!$ControlValves_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ControlValves_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ControlValves_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ControlValves_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fControlValveslist" id="fControlValveslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ControlValves">
<div id="gmp_ControlValves" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ControlValves_list->TotalRecords > 0 || $ControlValves_list->isAdd() || $ControlValves_list->isCopy() || $ControlValves_list->isGridEdit()) { ?>
<table id="tbl_ControlValveslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ControlValves->RowType = ROWTYPE_HEADER;

// Render list options
$ControlValves_list->renderListOptions();

// Render list options (header, left)
$ControlValves_list->ListOptions->render("header", "left");
?>
<?php if ($ControlValves_list->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
	<?php if ($ControlValves_list->SortUrl($ControlValves_list->ControlValve_Idn) == "") { ?>
		<th data-name="ControlValve_Idn" class="<?php echo $ControlValves_list->ControlValve_Idn->headerCellClass() ?>"><div id="elh_ControlValves_ControlValve_Idn" class="ControlValves_ControlValve_Idn"><div class="ew-table-header-caption"><?php echo $ControlValves_list->ControlValve_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ControlValve_Idn" class="<?php echo $ControlValves_list->ControlValve_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ControlValves_list->SortUrl($ControlValves_list->ControlValve_Idn) ?>', 1);"><div id="elh_ControlValves_ControlValve_Idn" class="ControlValves_ControlValve_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ControlValves_list->ControlValve_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($ControlValves_list->ControlValve_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ControlValves_list->ControlValve_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ControlValves_list->Name->Visible) { // Name ?>
	<?php if ($ControlValves_list->SortUrl($ControlValves_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $ControlValves_list->Name->headerCellClass() ?>"><div id="elh_ControlValves_Name" class="ControlValves_Name"><div class="ew-table-header-caption"><?php echo $ControlValves_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $ControlValves_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ControlValves_list->SortUrl($ControlValves_list->Name) ?>', 1);"><div id="elh_ControlValves_Name" class="ControlValves_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ControlValves_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ControlValves_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ControlValves_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ControlValves_list->Rank->Visible) { // Rank ?>
	<?php if ($ControlValves_list->SortUrl($ControlValves_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $ControlValves_list->Rank->headerCellClass() ?>"><div id="elh_ControlValves_Rank" class="ControlValves_Rank"><div class="ew-table-header-caption"><?php echo $ControlValves_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $ControlValves_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ControlValves_list->SortUrl($ControlValves_list->Rank) ?>', 1);"><div id="elh_ControlValves_Rank" class="ControlValves_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ControlValves_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($ControlValves_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ControlValves_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ControlValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($ControlValves_list->SortUrl($ControlValves_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $ControlValves_list->ActiveFlag->headerCellClass() ?>"><div id="elh_ControlValves_ActiveFlag" class="ControlValves_ActiveFlag"><div class="ew-table-header-caption"><?php echo $ControlValves_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $ControlValves_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ControlValves_list->SortUrl($ControlValves_list->ActiveFlag) ?>', 1);"><div id="elh_ControlValves_ActiveFlag" class="ControlValves_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ControlValves_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($ControlValves_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ControlValves_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ControlValves_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($ControlValves_list->isAdd() || $ControlValves_list->isCopy()) {
		$ControlValves_list->RowIndex = 0;
		$ControlValves_list->KeyCount = $ControlValves_list->RowIndex;
		if ($ControlValves_list->isCopy() && !$ControlValves_list->loadRow())
			$ControlValves->CurrentAction = "add";
		if ($ControlValves_list->isAdd())
			$ControlValves_list->loadRowValues();
		if ($ControlValves->EventCancelled) // Insert failed
			$ControlValves_list->restoreFormValues(); // Restore form values

		// Set row properties
		$ControlValves->resetAttributes();
		$ControlValves->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_ControlValves", "data-rowtype" => ROWTYPE_ADD]);
		$ControlValves->RowType = ROWTYPE_ADD;

		// Render row
		$ControlValves_list->renderRow();

		// Render list options
		$ControlValves_list->renderListOptions();
		$ControlValves_list->StartRowCount = 0;
?>
	<tr <?php echo $ControlValves->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ControlValves_list->ListOptions->render("body", "left", $ControlValves_list->RowCount);
?>
	<?php if ($ControlValves_list->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
		<td data-name="ControlValve_Idn">
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_ControlValve_Idn" class="form-group ControlValves_ControlValve_Idn">
<input type="text" data-table="ControlValves" data-field="x_ControlValve_Idn" name="x<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" id="x<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ControlValves_list->ControlValve_Idn->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->ControlValve_Idn->EditValue ?>"<?php echo $ControlValves_list->ControlValve_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_ControlValve_Idn" name="o<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" id="o<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" value="<?php echo HtmlEncode($ControlValves_list->ControlValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ControlValves_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_Name" class="form-group ControlValves_Name">
<input type="text" data-table="ControlValves" data-field="x_Name" name="x<?php echo $ControlValves_list->RowIndex ?>_Name" id="x<?php echo $ControlValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ControlValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->Name->EditValue ?>"<?php echo $ControlValves_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_Name" name="o<?php echo $ControlValves_list->RowIndex ?>_Name" id="o<?php echo $ControlValves_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ControlValves_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ControlValves_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_Rank" class="form-group ControlValves_Rank">
<input type="text" data-table="ControlValves" data-field="x_Rank" name="x<?php echo $ControlValves_list->RowIndex ?>_Rank" id="x<?php echo $ControlValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ControlValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->Rank->EditValue ?>"<?php echo $ControlValves_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_Rank" name="o<?php echo $ControlValves_list->RowIndex ?>_Rank" id="o<?php echo $ControlValves_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ControlValves_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ControlValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_ActiveFlag" class="form-group ControlValves_ActiveFlag">
<?php
$selwrk = ConvertToBool($ControlValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ControlValves" data-field="x_ActiveFlag" name="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]_112276" value="1"<?php echo $selwrk ?><?php echo $ControlValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]_112276"></label>
</div>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_ActiveFlag" name="o<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ControlValves_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ControlValves_list->ListOptions->render("body", "right", $ControlValves_list->RowCount);
?>
<script>
loadjs.ready(["fControlValveslist", "load"], function() {
	fControlValveslist.updateLists(<?php echo $ControlValves_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($ControlValves_list->ExportAll && $ControlValves_list->isExport()) {
	$ControlValves_list->StopRecord = $ControlValves_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ControlValves_list->TotalRecords > $ControlValves_list->StartRecord + $ControlValves_list->DisplayRecords - 1)
		$ControlValves_list->StopRecord = $ControlValves_list->StartRecord + $ControlValves_list->DisplayRecords - 1;
	else
		$ControlValves_list->StopRecord = $ControlValves_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($ControlValves->isConfirm() || $ControlValves_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ControlValves_list->FormKeyCountName) && ($ControlValves_list->isGridAdd() || $ControlValves_list->isGridEdit() || $ControlValves->isConfirm())) {
		$ControlValves_list->KeyCount = $CurrentForm->getValue($ControlValves_list->FormKeyCountName);
		$ControlValves_list->StopRecord = $ControlValves_list->StartRecord + $ControlValves_list->KeyCount - 1;
	}
}
$ControlValves_list->RecordCount = $ControlValves_list->StartRecord - 1;
if ($ControlValves_list->Recordset && !$ControlValves_list->Recordset->EOF) {
	$ControlValves_list->Recordset->moveFirst();
	$selectLimit = $ControlValves_list->UseSelectLimit;
	if (!$selectLimit && $ControlValves_list->StartRecord > 1)
		$ControlValves_list->Recordset->move($ControlValves_list->StartRecord - 1);
} elseif (!$ControlValves->AllowAddDeleteRow && $ControlValves_list->StopRecord == 0) {
	$ControlValves_list->StopRecord = $ControlValves->GridAddRowCount;
}

// Initialize aggregate
$ControlValves->RowType = ROWTYPE_AGGREGATEINIT;
$ControlValves->resetAttributes();
$ControlValves_list->renderRow();
$ControlValves_list->EditRowCount = 0;
if ($ControlValves_list->isEdit())
	$ControlValves_list->RowIndex = 1;
if ($ControlValves_list->isGridAdd())
	$ControlValves_list->RowIndex = 0;
if ($ControlValves_list->isGridEdit())
	$ControlValves_list->RowIndex = 0;
while ($ControlValves_list->RecordCount < $ControlValves_list->StopRecord) {
	$ControlValves_list->RecordCount++;
	if ($ControlValves_list->RecordCount >= $ControlValves_list->StartRecord) {
		$ControlValves_list->RowCount++;
		if ($ControlValves_list->isGridAdd() || $ControlValves_list->isGridEdit() || $ControlValves->isConfirm()) {
			$ControlValves_list->RowIndex++;
			$CurrentForm->Index = $ControlValves_list->RowIndex;
			if ($CurrentForm->hasValue($ControlValves_list->FormActionName) && ($ControlValves->isConfirm() || $ControlValves_list->EventCancelled))
				$ControlValves_list->RowAction = strval($CurrentForm->getValue($ControlValves_list->FormActionName));
			elseif ($ControlValves_list->isGridAdd())
				$ControlValves_list->RowAction = "insert";
			else
				$ControlValves_list->RowAction = "";
		}

		// Set up key count
		$ControlValves_list->KeyCount = $ControlValves_list->RowIndex;

		// Init row class and style
		$ControlValves->resetAttributes();
		$ControlValves->CssClass = "";
		if ($ControlValves_list->isGridAdd()) {
			$ControlValves_list->loadRowValues(); // Load default values
		} else {
			$ControlValves_list->loadRowValues($ControlValves_list->Recordset); // Load row values
		}
		$ControlValves->RowType = ROWTYPE_VIEW; // Render view
		if ($ControlValves_list->isGridAdd()) // Grid add
			$ControlValves->RowType = ROWTYPE_ADD; // Render add
		if ($ControlValves_list->isGridAdd() && $ControlValves->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ControlValves_list->restoreCurrentRowFormValues($ControlValves_list->RowIndex); // Restore form values
		if ($ControlValves_list->isEdit()) {
			if ($ControlValves_list->checkInlineEditKey() && $ControlValves_list->EditRowCount == 0) { // Inline edit
				$ControlValves->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($ControlValves_list->isGridEdit()) { // Grid edit
			if ($ControlValves->EventCancelled)
				$ControlValves_list->restoreCurrentRowFormValues($ControlValves_list->RowIndex); // Restore form values
			if ($ControlValves_list->RowAction == "insert")
				$ControlValves->RowType = ROWTYPE_ADD; // Render add
			else
				$ControlValves->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ControlValves_list->isEdit() && $ControlValves->RowType == ROWTYPE_EDIT && $ControlValves->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$ControlValves_list->restoreFormValues(); // Restore form values
		}
		if ($ControlValves_list->isGridEdit() && ($ControlValves->RowType == ROWTYPE_EDIT || $ControlValves->RowType == ROWTYPE_ADD) && $ControlValves->EventCancelled) // Update failed
			$ControlValves_list->restoreCurrentRowFormValues($ControlValves_list->RowIndex); // Restore form values
		if ($ControlValves->RowType == ROWTYPE_EDIT) // Edit row
			$ControlValves_list->EditRowCount++;

		// Set up row id / data-rowindex
		$ControlValves->RowAttrs->merge(["data-rowindex" => $ControlValves_list->RowCount, "id" => "r" . $ControlValves_list->RowCount . "_ControlValves", "data-rowtype" => $ControlValves->RowType]);

		// Render row
		$ControlValves_list->renderRow();

		// Render list options
		$ControlValves_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ControlValves_list->RowAction != "delete" && $ControlValves_list->RowAction != "insertdelete" && !($ControlValves_list->RowAction == "insert" && $ControlValves->isConfirm() && $ControlValves_list->emptyRow())) {
?>
	<tr <?php echo $ControlValves->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ControlValves_list->ListOptions->render("body", "left", $ControlValves_list->RowCount);
?>
	<?php if ($ControlValves_list->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
		<td data-name="ControlValve_Idn" <?php echo $ControlValves_list->ControlValve_Idn->cellAttributes() ?>>
<?php if ($ControlValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_ControlValve_Idn" class="form-group">
<input type="text" data-table="ControlValves" data-field="x_ControlValve_Idn" name="x<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" id="x<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ControlValves_list->ControlValve_Idn->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->ControlValve_Idn->EditValue ?>"<?php echo $ControlValves_list->ControlValve_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_ControlValve_Idn" name="o<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" id="o<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" value="<?php echo HtmlEncode($ControlValves_list->ControlValve_Idn->OldValue) ?>">
<?php } ?>
<?php if ($ControlValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="ControlValves" data-field="x_ControlValve_Idn" name="x<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" id="x<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ControlValves_list->ControlValve_Idn->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->ControlValve_Idn->EditValue ?>"<?php echo $ControlValves_list->ControlValve_Idn->editAttributes() ?>>
<input type="hidden" data-table="ControlValves" data-field="x_ControlValve_Idn" name="o<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" id="o<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" value="<?php echo HtmlEncode($ControlValves_list->ControlValve_Idn->OldValue != null ? $ControlValves_list->ControlValve_Idn->OldValue : $ControlValves_list->ControlValve_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($ControlValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_ControlValve_Idn">
<span<?php echo $ControlValves_list->ControlValve_Idn->viewAttributes() ?>><?php echo $ControlValves_list->ControlValve_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ControlValves_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $ControlValves_list->Name->cellAttributes() ?>>
<?php if ($ControlValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_Name" class="form-group">
<input type="text" data-table="ControlValves" data-field="x_Name" name="x<?php echo $ControlValves_list->RowIndex ?>_Name" id="x<?php echo $ControlValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ControlValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->Name->EditValue ?>"<?php echo $ControlValves_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_Name" name="o<?php echo $ControlValves_list->RowIndex ?>_Name" id="o<?php echo $ControlValves_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ControlValves_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($ControlValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_Name" class="form-group">
<input type="text" data-table="ControlValves" data-field="x_Name" name="x<?php echo $ControlValves_list->RowIndex ?>_Name" id="x<?php echo $ControlValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ControlValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->Name->EditValue ?>"<?php echo $ControlValves_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ControlValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_Name">
<span<?php echo $ControlValves_list->Name->viewAttributes() ?>><?php echo $ControlValves_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ControlValves_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $ControlValves_list->Rank->cellAttributes() ?>>
<?php if ($ControlValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_Rank" class="form-group">
<input type="text" data-table="ControlValves" data-field="x_Rank" name="x<?php echo $ControlValves_list->RowIndex ?>_Rank" id="x<?php echo $ControlValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ControlValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->Rank->EditValue ?>"<?php echo $ControlValves_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_Rank" name="o<?php echo $ControlValves_list->RowIndex ?>_Rank" id="o<?php echo $ControlValves_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ControlValves_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($ControlValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_Rank" class="form-group">
<input type="text" data-table="ControlValves" data-field="x_Rank" name="x<?php echo $ControlValves_list->RowIndex ?>_Rank" id="x<?php echo $ControlValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ControlValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->Rank->EditValue ?>"<?php echo $ControlValves_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ControlValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_Rank">
<span<?php echo $ControlValves_list->Rank->viewAttributes() ?>><?php echo $ControlValves_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ControlValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $ControlValves_list->ActiveFlag->cellAttributes() ?>>
<?php if ($ControlValves->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ControlValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ControlValves" data-field="x_ActiveFlag" name="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]_455805" value="1"<?php echo $selwrk ?><?php echo $ControlValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]_455805"></label>
</div>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_ActiveFlag" name="o<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ControlValves_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($ControlValves->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ControlValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ControlValves" data-field="x_ActiveFlag" name="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]_161792" value="1"<?php echo $selwrk ?><?php echo $ControlValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]_161792"></label>
</div>
</span>
<?php } ?>
<?php if ($ControlValves->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ControlValves_list->RowCount ?>_ControlValves_ActiveFlag">
<span<?php echo $ControlValves_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ControlValves_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ControlValves_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ControlValves_list->ListOptions->render("body", "right", $ControlValves_list->RowCount);
?>
	</tr>
<?php if ($ControlValves->RowType == ROWTYPE_ADD || $ControlValves->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fControlValveslist", "load"], function() {
	fControlValveslist.updateLists(<?php echo $ControlValves_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ControlValves_list->isGridAdd())
		if (!$ControlValves_list->Recordset->EOF)
			$ControlValves_list->Recordset->moveNext();
}
?>
<?php
	if ($ControlValves_list->isGridAdd() || $ControlValves_list->isGridEdit()) {
		$ControlValves_list->RowIndex = '$rowindex$';
		$ControlValves_list->loadRowValues();

		// Set row properties
		$ControlValves->resetAttributes();
		$ControlValves->RowAttrs->merge(["data-rowindex" => $ControlValves_list->RowIndex, "id" => "r0_ControlValves", "data-rowtype" => ROWTYPE_ADD]);
		$ControlValves->RowAttrs->appendClass("ew-template");
		$ControlValves->RowType = ROWTYPE_ADD;

		// Render row
		$ControlValves_list->renderRow();

		// Render list options
		$ControlValves_list->renderListOptions();
		$ControlValves_list->StartRowCount = 0;
?>
	<tr <?php echo $ControlValves->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ControlValves_list->ListOptions->render("body", "left", $ControlValves_list->RowIndex);
?>
	<?php if ($ControlValves_list->ControlValve_Idn->Visible) { // ControlValve_Idn ?>
		<td data-name="ControlValve_Idn">
<span id="el$rowindex$_ControlValves_ControlValve_Idn" class="form-group ControlValves_ControlValve_Idn">
<input type="text" data-table="ControlValves" data-field="x_ControlValve_Idn" name="x<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" id="x<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ControlValves_list->ControlValve_Idn->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->ControlValve_Idn->EditValue ?>"<?php echo $ControlValves_list->ControlValve_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_ControlValve_Idn" name="o<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" id="o<?php echo $ControlValves_list->RowIndex ?>_ControlValve_Idn" value="<?php echo HtmlEncode($ControlValves_list->ControlValve_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ControlValves_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_ControlValves_Name" class="form-group ControlValves_Name">
<input type="text" data-table="ControlValves" data-field="x_Name" name="x<?php echo $ControlValves_list->RowIndex ?>_Name" id="x<?php echo $ControlValves_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ControlValves_list->Name->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->Name->EditValue ?>"<?php echo $ControlValves_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_Name" name="o<?php echo $ControlValves_list->RowIndex ?>_Name" id="o<?php echo $ControlValves_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ControlValves_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ControlValves_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_ControlValves_Rank" class="form-group ControlValves_Rank">
<input type="text" data-table="ControlValves" data-field="x_Rank" name="x<?php echo $ControlValves_list->RowIndex ?>_Rank" id="x<?php echo $ControlValves_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ControlValves_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ControlValves_list->Rank->EditValue ?>"<?php echo $ControlValves_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_Rank" name="o<?php echo $ControlValves_list->RowIndex ?>_Rank" id="o<?php echo $ControlValves_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ControlValves_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ControlValves_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_ControlValves_ActiveFlag" class="form-group ControlValves_ActiveFlag">
<?php
$selwrk = ConvertToBool($ControlValves_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ControlValves" data-field="x_ActiveFlag" name="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]_457000" value="1"<?php echo $selwrk ?><?php echo $ControlValves_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]_457000"></label>
</div>
</span>
<input type="hidden" data-table="ControlValves" data-field="x_ActiveFlag" name="o<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ControlValves_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ControlValves_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ControlValves_list->ListOptions->render("body", "right", $ControlValves_list->RowIndex);
?>
<script>
loadjs.ready(["fControlValveslist", "load"], function() {
	fControlValveslist.updateLists(<?php echo $ControlValves_list->RowIndex ?>);
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
<?php if ($ControlValves_list->isAdd() || $ControlValves_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $ControlValves_list->FormKeyCountName ?>" id="<?php echo $ControlValves_list->FormKeyCountName ?>" value="<?php echo $ControlValves_list->KeyCount ?>">
<?php } ?>
<?php if ($ControlValves_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $ControlValves_list->FormKeyCountName ?>" id="<?php echo $ControlValves_list->FormKeyCountName ?>" value="<?php echo $ControlValves_list->KeyCount ?>">
<?php echo $ControlValves_list->MultiSelectKey ?>
<?php } ?>
<?php if ($ControlValves_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $ControlValves_list->FormKeyCountName ?>" id="<?php echo $ControlValves_list->FormKeyCountName ?>" value="<?php echo $ControlValves_list->KeyCount ?>">
<?php } ?>
<?php if ($ControlValves_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $ControlValves_list->FormKeyCountName ?>" id="<?php echo $ControlValves_list->FormKeyCountName ?>" value="<?php echo $ControlValves_list->KeyCount ?>">
<?php echo $ControlValves_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$ControlValves->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ControlValves_list->Recordset)
	$ControlValves_list->Recordset->Close();
?>
<?php if (!$ControlValves_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ControlValves_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ControlValves_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ControlValves_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ControlValves_list->TotalRecords == 0 && !$ControlValves->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ControlValves_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ControlValves_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ControlValves_list->isExport()) { ?>
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
$ControlValves_list->terminate();
?>