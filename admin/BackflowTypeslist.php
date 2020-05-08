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
$BackflowTypes_list = new BackflowTypes_list();

// Run the page
$BackflowTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$BackflowTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$BackflowTypes_list->isExport()) { ?>
<script>
var fBackflowTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fBackflowTypeslist = currentForm = new ew.Form("fBackflowTypeslist", "list");
	fBackflowTypeslist.formKeyCountName = '<?php echo $BackflowTypes_list->FormKeyCountName ?>';

	// Validate form
	fBackflowTypeslist.validate = function() {
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
			<?php if ($BackflowTypes_list->BackflowType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_BackflowType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BackflowTypes_list->BackflowType_Idn->caption(), $BackflowTypes_list->BackflowType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BackflowType_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BackflowTypes_list->BackflowType_Idn->errorMessage()) ?>");
			<?php if ($BackflowTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BackflowTypes_list->Name->caption(), $BackflowTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($BackflowTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BackflowTypes_list->Rank->caption(), $BackflowTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BackflowTypes_list->Rank->errorMessage()) ?>");
			<?php if ($BackflowTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BackflowTypes_list->ActiveFlag->caption(), $BackflowTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fBackflowTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "BackflowType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fBackflowTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fBackflowTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fBackflowTypeslist.lists["x_ActiveFlag[]"] = <?php echo $BackflowTypes_list->ActiveFlag->Lookup->toClientList($BackflowTypes_list) ?>;
	fBackflowTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($BackflowTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fBackflowTypeslist");
});
var fBackflowTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fBackflowTypeslistsrch = currentSearchForm = new ew.Form("fBackflowTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fBackflowTypeslistsrch.filterList = <?php echo $BackflowTypes_list->getFilterList() ?>;
	loadjs.done("fBackflowTypeslistsrch");
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
<?php if (!$BackflowTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($BackflowTypes_list->TotalRecords > 0 && $BackflowTypes_list->ExportOptions->visible()) { ?>
<?php $BackflowTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($BackflowTypes_list->ImportOptions->visible()) { ?>
<?php $BackflowTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($BackflowTypes_list->SearchOptions->visible()) { ?>
<?php $BackflowTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($BackflowTypes_list->FilterOptions->visible()) { ?>
<?php $BackflowTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$BackflowTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$BackflowTypes_list->isExport() && !$BackflowTypes->CurrentAction) { ?>
<form name="fBackflowTypeslistsrch" id="fBackflowTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fBackflowTypeslistsrch-search-panel" class="<?php echo $BackflowTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="BackflowTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $BackflowTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($BackflowTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($BackflowTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $BackflowTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($BackflowTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($BackflowTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($BackflowTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($BackflowTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $BackflowTypes_list->showPageHeader(); ?>
<?php
$BackflowTypes_list->showMessage();
?>
<?php if ($BackflowTypes_list->TotalRecords > 0 || $BackflowTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($BackflowTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> BackflowTypes">
<?php if (!$BackflowTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$BackflowTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $BackflowTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $BackflowTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fBackflowTypeslist" id="fBackflowTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="BackflowTypes">
<div id="gmp_BackflowTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($BackflowTypes_list->TotalRecords > 0 || $BackflowTypes_list->isAdd() || $BackflowTypes_list->isCopy() || $BackflowTypes_list->isGridEdit()) { ?>
<table id="tbl_BackflowTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$BackflowTypes->RowType = ROWTYPE_HEADER;

// Render list options
$BackflowTypes_list->renderListOptions();

// Render list options (header, left)
$BackflowTypes_list->ListOptions->render("header", "left");
?>
<?php if ($BackflowTypes_list->BackflowType_Idn->Visible) { // BackflowType_Idn ?>
	<?php if ($BackflowTypes_list->SortUrl($BackflowTypes_list->BackflowType_Idn) == "") { ?>
		<th data-name="BackflowType_Idn" class="<?php echo $BackflowTypes_list->BackflowType_Idn->headerCellClass() ?>"><div id="elh_BackflowTypes_BackflowType_Idn" class="BackflowTypes_BackflowType_Idn"><div class="ew-table-header-caption"><?php echo $BackflowTypes_list->BackflowType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BackflowType_Idn" class="<?php echo $BackflowTypes_list->BackflowType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BackflowTypes_list->SortUrl($BackflowTypes_list->BackflowType_Idn) ?>', 1);"><div id="elh_BackflowTypes_BackflowType_Idn" class="BackflowTypes_BackflowType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BackflowTypes_list->BackflowType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($BackflowTypes_list->BackflowType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BackflowTypes_list->BackflowType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BackflowTypes_list->Name->Visible) { // Name ?>
	<?php if ($BackflowTypes_list->SortUrl($BackflowTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $BackflowTypes_list->Name->headerCellClass() ?>"><div id="elh_BackflowTypes_Name" class="BackflowTypes_Name"><div class="ew-table-header-caption"><?php echo $BackflowTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $BackflowTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BackflowTypes_list->SortUrl($BackflowTypes_list->Name) ?>', 1);"><div id="elh_BackflowTypes_Name" class="BackflowTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BackflowTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($BackflowTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BackflowTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BackflowTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($BackflowTypes_list->SortUrl($BackflowTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $BackflowTypes_list->Rank->headerCellClass() ?>"><div id="elh_BackflowTypes_Rank" class="BackflowTypes_Rank"><div class="ew-table-header-caption"><?php echo $BackflowTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $BackflowTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BackflowTypes_list->SortUrl($BackflowTypes_list->Rank) ?>', 1);"><div id="elh_BackflowTypes_Rank" class="BackflowTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BackflowTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($BackflowTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BackflowTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BackflowTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($BackflowTypes_list->SortUrl($BackflowTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $BackflowTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_BackflowTypes_ActiveFlag" class="BackflowTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $BackflowTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $BackflowTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BackflowTypes_list->SortUrl($BackflowTypes_list->ActiveFlag) ?>', 1);"><div id="elh_BackflowTypes_ActiveFlag" class="BackflowTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BackflowTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($BackflowTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BackflowTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$BackflowTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($BackflowTypes_list->isAdd() || $BackflowTypes_list->isCopy()) {
		$BackflowTypes_list->RowIndex = 0;
		$BackflowTypes_list->KeyCount = $BackflowTypes_list->RowIndex;
		if ($BackflowTypes_list->isCopy() && !$BackflowTypes_list->loadRow())
			$BackflowTypes->CurrentAction = "add";
		if ($BackflowTypes_list->isAdd())
			$BackflowTypes_list->loadRowValues();
		if ($BackflowTypes->EventCancelled) // Insert failed
			$BackflowTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$BackflowTypes->resetAttributes();
		$BackflowTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_BackflowTypes", "data-rowtype" => ROWTYPE_ADD]);
		$BackflowTypes->RowType = ROWTYPE_ADD;

		// Render row
		$BackflowTypes_list->renderRow();

		// Render list options
		$BackflowTypes_list->renderListOptions();
		$BackflowTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $BackflowTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$BackflowTypes_list->ListOptions->render("body", "left", $BackflowTypes_list->RowCount);
?>
	<?php if ($BackflowTypes_list->BackflowType_Idn->Visible) { // BackflowType_Idn ?>
		<td data-name="BackflowType_Idn">
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_BackflowType_Idn" class="form-group BackflowTypes_BackflowType_Idn">
<input type="text" data-table="BackflowTypes" data-field="x_BackflowType_Idn" name="x<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" id="x<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BackflowTypes_list->BackflowType_Idn->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->BackflowType_Idn->EditValue ?>"<?php echo $BackflowTypes_list->BackflowType_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_BackflowType_Idn" name="o<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" id="o<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" value="<?php echo HtmlEncode($BackflowTypes_list->BackflowType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BackflowTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_Name" class="form-group BackflowTypes_Name">
<input type="text" data-table="BackflowTypes" data-field="x_Name" name="x<?php echo $BackflowTypes_list->RowIndex ?>_Name" id="x<?php echo $BackflowTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($BackflowTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->Name->EditValue ?>"<?php echo $BackflowTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_Name" name="o<?php echo $BackflowTypes_list->RowIndex ?>_Name" id="o<?php echo $BackflowTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($BackflowTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BackflowTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_Rank" class="form-group BackflowTypes_Rank">
<input type="text" data-table="BackflowTypes" data-field="x_Rank" name="x<?php echo $BackflowTypes_list->RowIndex ?>_Rank" id="x<?php echo $BackflowTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BackflowTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->Rank->EditValue ?>"<?php echo $BackflowTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_Rank" name="o<?php echo $BackflowTypes_list->RowIndex ?>_Rank" id="o<?php echo $BackflowTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($BackflowTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BackflowTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_ActiveFlag" class="form-group BackflowTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($BackflowTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BackflowTypes" data-field="x_ActiveFlag" name="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]_449873" value="1"<?php echo $selwrk ?><?php echo $BackflowTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]_449873"></label>
</div>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_ActiveFlag" name="o<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($BackflowTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$BackflowTypes_list->ListOptions->render("body", "right", $BackflowTypes_list->RowCount);
?>
<script>
loadjs.ready(["fBackflowTypeslist", "load"], function() {
	fBackflowTypeslist.updateLists(<?php echo $BackflowTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($BackflowTypes_list->ExportAll && $BackflowTypes_list->isExport()) {
	$BackflowTypes_list->StopRecord = $BackflowTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($BackflowTypes_list->TotalRecords > $BackflowTypes_list->StartRecord + $BackflowTypes_list->DisplayRecords - 1)
		$BackflowTypes_list->StopRecord = $BackflowTypes_list->StartRecord + $BackflowTypes_list->DisplayRecords - 1;
	else
		$BackflowTypes_list->StopRecord = $BackflowTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($BackflowTypes->isConfirm() || $BackflowTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($BackflowTypes_list->FormKeyCountName) && ($BackflowTypes_list->isGridAdd() || $BackflowTypes_list->isGridEdit() || $BackflowTypes->isConfirm())) {
		$BackflowTypes_list->KeyCount = $CurrentForm->getValue($BackflowTypes_list->FormKeyCountName);
		$BackflowTypes_list->StopRecord = $BackflowTypes_list->StartRecord + $BackflowTypes_list->KeyCount - 1;
	}
}
$BackflowTypes_list->RecordCount = $BackflowTypes_list->StartRecord - 1;
if ($BackflowTypes_list->Recordset && !$BackflowTypes_list->Recordset->EOF) {
	$BackflowTypes_list->Recordset->moveFirst();
	$selectLimit = $BackflowTypes_list->UseSelectLimit;
	if (!$selectLimit && $BackflowTypes_list->StartRecord > 1)
		$BackflowTypes_list->Recordset->move($BackflowTypes_list->StartRecord - 1);
} elseif (!$BackflowTypes->AllowAddDeleteRow && $BackflowTypes_list->StopRecord == 0) {
	$BackflowTypes_list->StopRecord = $BackflowTypes->GridAddRowCount;
}

// Initialize aggregate
$BackflowTypes->RowType = ROWTYPE_AGGREGATEINIT;
$BackflowTypes->resetAttributes();
$BackflowTypes_list->renderRow();
$BackflowTypes_list->EditRowCount = 0;
if ($BackflowTypes_list->isEdit())
	$BackflowTypes_list->RowIndex = 1;
if ($BackflowTypes_list->isGridAdd())
	$BackflowTypes_list->RowIndex = 0;
if ($BackflowTypes_list->isGridEdit())
	$BackflowTypes_list->RowIndex = 0;
while ($BackflowTypes_list->RecordCount < $BackflowTypes_list->StopRecord) {
	$BackflowTypes_list->RecordCount++;
	if ($BackflowTypes_list->RecordCount >= $BackflowTypes_list->StartRecord) {
		$BackflowTypes_list->RowCount++;
		if ($BackflowTypes_list->isGridAdd() || $BackflowTypes_list->isGridEdit() || $BackflowTypes->isConfirm()) {
			$BackflowTypes_list->RowIndex++;
			$CurrentForm->Index = $BackflowTypes_list->RowIndex;
			if ($CurrentForm->hasValue($BackflowTypes_list->FormActionName) && ($BackflowTypes->isConfirm() || $BackflowTypes_list->EventCancelled))
				$BackflowTypes_list->RowAction = strval($CurrentForm->getValue($BackflowTypes_list->FormActionName));
			elseif ($BackflowTypes_list->isGridAdd())
				$BackflowTypes_list->RowAction = "insert";
			else
				$BackflowTypes_list->RowAction = "";
		}

		// Set up key count
		$BackflowTypes_list->KeyCount = $BackflowTypes_list->RowIndex;

		// Init row class and style
		$BackflowTypes->resetAttributes();
		$BackflowTypes->CssClass = "";
		if ($BackflowTypes_list->isGridAdd()) {
			$BackflowTypes_list->loadRowValues(); // Load default values
		} else {
			$BackflowTypes_list->loadRowValues($BackflowTypes_list->Recordset); // Load row values
		}
		$BackflowTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($BackflowTypes_list->isGridAdd()) // Grid add
			$BackflowTypes->RowType = ROWTYPE_ADD; // Render add
		if ($BackflowTypes_list->isGridAdd() && $BackflowTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$BackflowTypes_list->restoreCurrentRowFormValues($BackflowTypes_list->RowIndex); // Restore form values
		if ($BackflowTypes_list->isEdit()) {
			if ($BackflowTypes_list->checkInlineEditKey() && $BackflowTypes_list->EditRowCount == 0) { // Inline edit
				$BackflowTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($BackflowTypes_list->isGridEdit()) { // Grid edit
			if ($BackflowTypes->EventCancelled)
				$BackflowTypes_list->restoreCurrentRowFormValues($BackflowTypes_list->RowIndex); // Restore form values
			if ($BackflowTypes_list->RowAction == "insert")
				$BackflowTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$BackflowTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($BackflowTypes_list->isEdit() && $BackflowTypes->RowType == ROWTYPE_EDIT && $BackflowTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$BackflowTypes_list->restoreFormValues(); // Restore form values
		}
		if ($BackflowTypes_list->isGridEdit() && ($BackflowTypes->RowType == ROWTYPE_EDIT || $BackflowTypes->RowType == ROWTYPE_ADD) && $BackflowTypes->EventCancelled) // Update failed
			$BackflowTypes_list->restoreCurrentRowFormValues($BackflowTypes_list->RowIndex); // Restore form values
		if ($BackflowTypes->RowType == ROWTYPE_EDIT) // Edit row
			$BackflowTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$BackflowTypes->RowAttrs->merge(["data-rowindex" => $BackflowTypes_list->RowCount, "id" => "r" . $BackflowTypes_list->RowCount . "_BackflowTypes", "data-rowtype" => $BackflowTypes->RowType]);

		// Render row
		$BackflowTypes_list->renderRow();

		// Render list options
		$BackflowTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($BackflowTypes_list->RowAction != "delete" && $BackflowTypes_list->RowAction != "insertdelete" && !($BackflowTypes_list->RowAction == "insert" && $BackflowTypes->isConfirm() && $BackflowTypes_list->emptyRow())) {
?>
	<tr <?php echo $BackflowTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$BackflowTypes_list->ListOptions->render("body", "left", $BackflowTypes_list->RowCount);
?>
	<?php if ($BackflowTypes_list->BackflowType_Idn->Visible) { // BackflowType_Idn ?>
		<td data-name="BackflowType_Idn" <?php echo $BackflowTypes_list->BackflowType_Idn->cellAttributes() ?>>
<?php if ($BackflowTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_BackflowType_Idn" class="form-group">
<input type="text" data-table="BackflowTypes" data-field="x_BackflowType_Idn" name="x<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" id="x<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BackflowTypes_list->BackflowType_Idn->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->BackflowType_Idn->EditValue ?>"<?php echo $BackflowTypes_list->BackflowType_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_BackflowType_Idn" name="o<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" id="o<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" value="<?php echo HtmlEncode($BackflowTypes_list->BackflowType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($BackflowTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="BackflowTypes" data-field="x_BackflowType_Idn" name="x<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" id="x<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BackflowTypes_list->BackflowType_Idn->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->BackflowType_Idn->EditValue ?>"<?php echo $BackflowTypes_list->BackflowType_Idn->editAttributes() ?>>
<input type="hidden" data-table="BackflowTypes" data-field="x_BackflowType_Idn" name="o<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" id="o<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" value="<?php echo HtmlEncode($BackflowTypes_list->BackflowType_Idn->OldValue != null ? $BackflowTypes_list->BackflowType_Idn->OldValue : $BackflowTypes_list->BackflowType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($BackflowTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_BackflowType_Idn">
<span<?php echo $BackflowTypes_list->BackflowType_Idn->viewAttributes() ?>><?php echo $BackflowTypes_list->BackflowType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BackflowTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $BackflowTypes_list->Name->cellAttributes() ?>>
<?php if ($BackflowTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_Name" class="form-group">
<input type="text" data-table="BackflowTypes" data-field="x_Name" name="x<?php echo $BackflowTypes_list->RowIndex ?>_Name" id="x<?php echo $BackflowTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($BackflowTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->Name->EditValue ?>"<?php echo $BackflowTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_Name" name="o<?php echo $BackflowTypes_list->RowIndex ?>_Name" id="o<?php echo $BackflowTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($BackflowTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($BackflowTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_Name" class="form-group">
<input type="text" data-table="BackflowTypes" data-field="x_Name" name="x<?php echo $BackflowTypes_list->RowIndex ?>_Name" id="x<?php echo $BackflowTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($BackflowTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->Name->EditValue ?>"<?php echo $BackflowTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($BackflowTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_Name">
<span<?php echo $BackflowTypes_list->Name->viewAttributes() ?>><?php echo $BackflowTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BackflowTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $BackflowTypes_list->Rank->cellAttributes() ?>>
<?php if ($BackflowTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_Rank" class="form-group">
<input type="text" data-table="BackflowTypes" data-field="x_Rank" name="x<?php echo $BackflowTypes_list->RowIndex ?>_Rank" id="x<?php echo $BackflowTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BackflowTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->Rank->EditValue ?>"<?php echo $BackflowTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_Rank" name="o<?php echo $BackflowTypes_list->RowIndex ?>_Rank" id="o<?php echo $BackflowTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($BackflowTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($BackflowTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_Rank" class="form-group">
<input type="text" data-table="BackflowTypes" data-field="x_Rank" name="x<?php echo $BackflowTypes_list->RowIndex ?>_Rank" id="x<?php echo $BackflowTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BackflowTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->Rank->EditValue ?>"<?php echo $BackflowTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($BackflowTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_Rank">
<span<?php echo $BackflowTypes_list->Rank->viewAttributes() ?>><?php echo $BackflowTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BackflowTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $BackflowTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($BackflowTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($BackflowTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BackflowTypes" data-field="x_ActiveFlag" name="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]_426267" value="1"<?php echo $selwrk ?><?php echo $BackflowTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]_426267"></label>
</div>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_ActiveFlag" name="o<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($BackflowTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($BackflowTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($BackflowTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BackflowTypes" data-field="x_ActiveFlag" name="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]_916924" value="1"<?php echo $selwrk ?><?php echo $BackflowTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]_916924"></label>
</div>
</span>
<?php } ?>
<?php if ($BackflowTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BackflowTypes_list->RowCount ?>_BackflowTypes_ActiveFlag">
<span<?php echo $BackflowTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $BackflowTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($BackflowTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$BackflowTypes_list->ListOptions->render("body", "right", $BackflowTypes_list->RowCount);
?>
	</tr>
<?php if ($BackflowTypes->RowType == ROWTYPE_ADD || $BackflowTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fBackflowTypeslist", "load"], function() {
	fBackflowTypeslist.updateLists(<?php echo $BackflowTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$BackflowTypes_list->isGridAdd())
		if (!$BackflowTypes_list->Recordset->EOF)
			$BackflowTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($BackflowTypes_list->isGridAdd() || $BackflowTypes_list->isGridEdit()) {
		$BackflowTypes_list->RowIndex = '$rowindex$';
		$BackflowTypes_list->loadRowValues();

		// Set row properties
		$BackflowTypes->resetAttributes();
		$BackflowTypes->RowAttrs->merge(["data-rowindex" => $BackflowTypes_list->RowIndex, "id" => "r0_BackflowTypes", "data-rowtype" => ROWTYPE_ADD]);
		$BackflowTypes->RowAttrs->appendClass("ew-template");
		$BackflowTypes->RowType = ROWTYPE_ADD;

		// Render row
		$BackflowTypes_list->renderRow();

		// Render list options
		$BackflowTypes_list->renderListOptions();
		$BackflowTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $BackflowTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$BackflowTypes_list->ListOptions->render("body", "left", $BackflowTypes_list->RowIndex);
?>
	<?php if ($BackflowTypes_list->BackflowType_Idn->Visible) { // BackflowType_Idn ?>
		<td data-name="BackflowType_Idn">
<span id="el$rowindex$_BackflowTypes_BackflowType_Idn" class="form-group BackflowTypes_BackflowType_Idn">
<input type="text" data-table="BackflowTypes" data-field="x_BackflowType_Idn" name="x<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" id="x<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BackflowTypes_list->BackflowType_Idn->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->BackflowType_Idn->EditValue ?>"<?php echo $BackflowTypes_list->BackflowType_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_BackflowType_Idn" name="o<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" id="o<?php echo $BackflowTypes_list->RowIndex ?>_BackflowType_Idn" value="<?php echo HtmlEncode($BackflowTypes_list->BackflowType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BackflowTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_BackflowTypes_Name" class="form-group BackflowTypes_Name">
<input type="text" data-table="BackflowTypes" data-field="x_Name" name="x<?php echo $BackflowTypes_list->RowIndex ?>_Name" id="x<?php echo $BackflowTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($BackflowTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->Name->EditValue ?>"<?php echo $BackflowTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_Name" name="o<?php echo $BackflowTypes_list->RowIndex ?>_Name" id="o<?php echo $BackflowTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($BackflowTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BackflowTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_BackflowTypes_Rank" class="form-group BackflowTypes_Rank">
<input type="text" data-table="BackflowTypes" data-field="x_Rank" name="x<?php echo $BackflowTypes_list->RowIndex ?>_Rank" id="x<?php echo $BackflowTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BackflowTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BackflowTypes_list->Rank->EditValue ?>"<?php echo $BackflowTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_Rank" name="o<?php echo $BackflowTypes_list->RowIndex ?>_Rank" id="o<?php echo $BackflowTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($BackflowTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BackflowTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_BackflowTypes_ActiveFlag" class="form-group BackflowTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($BackflowTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BackflowTypes" data-field="x_ActiveFlag" name="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]_117412" value="1"<?php echo $selwrk ?><?php echo $BackflowTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]_117412"></label>
</div>
</span>
<input type="hidden" data-table="BackflowTypes" data-field="x_ActiveFlag" name="o<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $BackflowTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($BackflowTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$BackflowTypes_list->ListOptions->render("body", "right", $BackflowTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fBackflowTypeslist", "load"], function() {
	fBackflowTypeslist.updateLists(<?php echo $BackflowTypes_list->RowIndex ?>);
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
<?php if ($BackflowTypes_list->isAdd() || $BackflowTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $BackflowTypes_list->FormKeyCountName ?>" id="<?php echo $BackflowTypes_list->FormKeyCountName ?>" value="<?php echo $BackflowTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($BackflowTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $BackflowTypes_list->FormKeyCountName ?>" id="<?php echo $BackflowTypes_list->FormKeyCountName ?>" value="<?php echo $BackflowTypes_list->KeyCount ?>">
<?php echo $BackflowTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($BackflowTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $BackflowTypes_list->FormKeyCountName ?>" id="<?php echo $BackflowTypes_list->FormKeyCountName ?>" value="<?php echo $BackflowTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($BackflowTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $BackflowTypes_list->FormKeyCountName ?>" id="<?php echo $BackflowTypes_list->FormKeyCountName ?>" value="<?php echo $BackflowTypes_list->KeyCount ?>">
<?php echo $BackflowTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$BackflowTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($BackflowTypes_list->Recordset)
	$BackflowTypes_list->Recordset->Close();
?>
<?php if (!$BackflowTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$BackflowTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $BackflowTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $BackflowTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($BackflowTypes_list->TotalRecords == 0 && !$BackflowTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $BackflowTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$BackflowTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$BackflowTypes_list->isExport()) { ?>
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
$BackflowTypes_list->terminate();
?>