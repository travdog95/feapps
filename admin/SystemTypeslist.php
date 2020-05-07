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
$SystemTypes_list = new SystemTypes_list();

// Run the page
$SystemTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SystemTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$SystemTypes_list->isExport()) { ?>
<script>
var fSystemTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fSystemTypeslist = currentForm = new ew.Form("fSystemTypeslist", "list");
	fSystemTypeslist.formKeyCountName = '<?php echo $SystemTypes_list->FormKeyCountName ?>';

	// Validate form
	fSystemTypeslist.validate = function() {
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
			<?php if ($SystemTypes_list->SystemType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SystemType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemTypes_list->SystemType_Idn->caption(), $SystemTypes_list->SystemType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemTypes_list->Name->caption(), $SystemTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemTypes_list->Rank->caption(), $SystemTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($SystemTypes_list->Rank->errorMessage()) ?>");
			<?php if ($SystemTypes_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemTypes_list->Department_Idn->caption(), $SystemTypes_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemTypes_list->ActiveFlag->caption(), $SystemTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fSystemTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fSystemTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fSystemTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fSystemTypeslist.lists["x_Department_Idn"] = <?php echo $SystemTypes_list->Department_Idn->Lookup->toClientList($SystemTypes_list) ?>;
	fSystemTypeslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($SystemTypes_list->Department_Idn->lookupOptions()) ?>;
	fSystemTypeslist.lists["x_ActiveFlag[]"] = <?php echo $SystemTypes_list->ActiveFlag->Lookup->toClientList($SystemTypes_list) ?>;
	fSystemTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($SystemTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fSystemTypeslist");
});
var fSystemTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fSystemTypeslistsrch = currentSearchForm = new ew.Form("fSystemTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fSystemTypeslistsrch.filterList = <?php echo $SystemTypes_list->getFilterList() ?>;
	loadjs.done("fSystemTypeslistsrch");
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
<?php if (!$SystemTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($SystemTypes_list->TotalRecords > 0 && $SystemTypes_list->ExportOptions->visible()) { ?>
<?php $SystemTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($SystemTypes_list->ImportOptions->visible()) { ?>
<?php $SystemTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($SystemTypes_list->SearchOptions->visible()) { ?>
<?php $SystemTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($SystemTypes_list->FilterOptions->visible()) { ?>
<?php $SystemTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$SystemTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$SystemTypes_list->isExport() && !$SystemTypes->CurrentAction) { ?>
<form name="fSystemTypeslistsrch" id="fSystemTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fSystemTypeslistsrch-search-panel" class="<?php echo $SystemTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="SystemTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $SystemTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($SystemTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($SystemTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $SystemTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($SystemTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($SystemTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($SystemTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($SystemTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $SystemTypes_list->showPageHeader(); ?>
<?php
$SystemTypes_list->showMessage();
?>
<?php if ($SystemTypes_list->TotalRecords > 0 || $SystemTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($SystemTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> SystemTypes">
<?php if (!$SystemTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$SystemTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $SystemTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $SystemTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fSystemTypeslist" id="fSystemTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SystemTypes">
<div id="gmp_SystemTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($SystemTypes_list->TotalRecords > 0 || $SystemTypes_list->isAdd() || $SystemTypes_list->isCopy() || $SystemTypes_list->isGridEdit()) { ?>
<table id="tbl_SystemTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$SystemTypes->RowType = ROWTYPE_HEADER;

// Render list options
$SystemTypes_list->renderListOptions();

// Render list options (header, left)
$SystemTypes_list->ListOptions->render("header", "left");
?>
<?php if ($SystemTypes_list->SystemType_Idn->Visible) { // SystemType_Idn ?>
	<?php if ($SystemTypes_list->SortUrl($SystemTypes_list->SystemType_Idn) == "") { ?>
		<th data-name="SystemType_Idn" class="<?php echo $SystemTypes_list->SystemType_Idn->headerCellClass() ?>"><div id="elh_SystemTypes_SystemType_Idn" class="SystemTypes_SystemType_Idn"><div class="ew-table-header-caption"><?php echo $SystemTypes_list->SystemType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SystemType_Idn" class="<?php echo $SystemTypes_list->SystemType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $SystemTypes_list->SortUrl($SystemTypes_list->SystemType_Idn) ?>', 1);"><div id="elh_SystemTypes_SystemType_Idn" class="SystemTypes_SystemType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemTypes_list->SystemType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemTypes_list->SystemType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemTypes_list->SystemType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemTypes_list->Name->Visible) { // Name ?>
	<?php if ($SystemTypes_list->SortUrl($SystemTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $SystemTypes_list->Name->headerCellClass() ?>"><div id="elh_SystemTypes_Name" class="SystemTypes_Name"><div class="ew-table-header-caption"><?php echo $SystemTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $SystemTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $SystemTypes_list->SortUrl($SystemTypes_list->Name) ?>', 1);"><div id="elh_SystemTypes_Name" class="SystemTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($SystemTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($SystemTypes_list->SortUrl($SystemTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $SystemTypes_list->Rank->headerCellClass() ?>"><div id="elh_SystemTypes_Rank" class="SystemTypes_Rank"><div class="ew-table-header-caption"><?php echo $SystemTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $SystemTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $SystemTypes_list->SortUrl($SystemTypes_list->Rank) ?>', 1);"><div id="elh_SystemTypes_Rank" class="SystemTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemTypes_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($SystemTypes_list->SortUrl($SystemTypes_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $SystemTypes_list->Department_Idn->headerCellClass() ?>"><div id="elh_SystemTypes_Department_Idn" class="SystemTypes_Department_Idn"><div class="ew-table-header-caption"><?php echo $SystemTypes_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $SystemTypes_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $SystemTypes_list->SortUrl($SystemTypes_list->Department_Idn) ?>', 1);"><div id="elh_SystemTypes_Department_Idn" class="SystemTypes_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemTypes_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemTypes_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemTypes_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($SystemTypes_list->SortUrl($SystemTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $SystemTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_SystemTypes_ActiveFlag" class="SystemTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $SystemTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $SystemTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $SystemTypes_list->SortUrl($SystemTypes_list->ActiveFlag) ?>', 1);"><div id="elh_SystemTypes_ActiveFlag" class="SystemTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$SystemTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($SystemTypes_list->isAdd() || $SystemTypes_list->isCopy()) {
		$SystemTypes_list->RowIndex = 0;
		$SystemTypes_list->KeyCount = $SystemTypes_list->RowIndex;
		if ($SystemTypes_list->isCopy() && !$SystemTypes_list->loadRow())
			$SystemTypes->CurrentAction = "add";
		if ($SystemTypes_list->isAdd())
			$SystemTypes_list->loadRowValues();
		if ($SystemTypes->EventCancelled) // Insert failed
			$SystemTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$SystemTypes->resetAttributes();
		$SystemTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_SystemTypes", "data-rowtype" => ROWTYPE_ADD]);
		$SystemTypes->RowType = ROWTYPE_ADD;

		// Render row
		$SystemTypes_list->renderRow();

		// Render list options
		$SystemTypes_list->renderListOptions();
		$SystemTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $SystemTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$SystemTypes_list->ListOptions->render("body", "left", $SystemTypes_list->RowCount);
?>
	<?php if ($SystemTypes_list->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<td data-name="SystemType_Idn">
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_SystemType_Idn" class="form-group SystemTypes_SystemType_Idn"></span>
<input type="hidden" data-table="SystemTypes" data-field="x_SystemType_Idn" name="o<?php echo $SystemTypes_list->RowIndex ?>_SystemType_Idn" id="o<?php echo $SystemTypes_list->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemTypes_list->SystemType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Name" class="form-group SystemTypes_Name">
<input type="text" data-table="SystemTypes" data-field="x_Name" name="x<?php echo $SystemTypes_list->RowIndex ?>_Name" id="x<?php echo $SystemTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $SystemTypes_list->Name->EditValue ?>"<?php echo $SystemTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_Name" name="o<?php echo $SystemTypes_list->RowIndex ?>_Name" id="o<?php echo $SystemTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Rank" class="form-group SystemTypes_Rank">
<input type="text" data-table="SystemTypes" data-field="x_Rank" name="x<?php echo $SystemTypes_list->RowIndex ?>_Rank" id="x<?php echo $SystemTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemTypes_list->Rank->EditValue ?>"<?php echo $SystemTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_Rank" name="o<?php echo $SystemTypes_list->RowIndex ?>_Rank" id="o<?php echo $SystemTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Department_Idn" class="form-group SystemTypes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $SystemTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn"<?php echo $SystemTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $SystemTypes_list->Department_Idn->selectOptionListHtml("x{$SystemTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $SystemTypes_list->Department_Idn->Lookup->getParamTag($SystemTypes_list, "p_x" . $SystemTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_Department_Idn" name="o<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($SystemTypes_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_ActiveFlag" class="form-group SystemTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($SystemTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]_108655" value="1"<?php echo $selwrk ?><?php echo $SystemTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]_108655"></label>
</div>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_ActiveFlag" name="o<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($SystemTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$SystemTypes_list->ListOptions->render("body", "right", $SystemTypes_list->RowCount);
?>
<script>
loadjs.ready(["fSystemTypeslist", "load"], function() {
	fSystemTypeslist.updateLists(<?php echo $SystemTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($SystemTypes_list->ExportAll && $SystemTypes_list->isExport()) {
	$SystemTypes_list->StopRecord = $SystemTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($SystemTypes_list->TotalRecords > $SystemTypes_list->StartRecord + $SystemTypes_list->DisplayRecords - 1)
		$SystemTypes_list->StopRecord = $SystemTypes_list->StartRecord + $SystemTypes_list->DisplayRecords - 1;
	else
		$SystemTypes_list->StopRecord = $SystemTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($SystemTypes->isConfirm() || $SystemTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($SystemTypes_list->FormKeyCountName) && ($SystemTypes_list->isGridAdd() || $SystemTypes_list->isGridEdit() || $SystemTypes->isConfirm())) {
		$SystemTypes_list->KeyCount = $CurrentForm->getValue($SystemTypes_list->FormKeyCountName);
		$SystemTypes_list->StopRecord = $SystemTypes_list->StartRecord + $SystemTypes_list->KeyCount - 1;
	}
}
$SystemTypes_list->RecordCount = $SystemTypes_list->StartRecord - 1;
if ($SystemTypes_list->Recordset && !$SystemTypes_list->Recordset->EOF) {
	$SystemTypes_list->Recordset->moveFirst();
	$selectLimit = $SystemTypes_list->UseSelectLimit;
	if (!$selectLimit && $SystemTypes_list->StartRecord > 1)
		$SystemTypes_list->Recordset->move($SystemTypes_list->StartRecord - 1);
} elseif (!$SystemTypes->AllowAddDeleteRow && $SystemTypes_list->StopRecord == 0) {
	$SystemTypes_list->StopRecord = $SystemTypes->GridAddRowCount;
}

// Initialize aggregate
$SystemTypes->RowType = ROWTYPE_AGGREGATEINIT;
$SystemTypes->resetAttributes();
$SystemTypes_list->renderRow();
$SystemTypes_list->EditRowCount = 0;
if ($SystemTypes_list->isEdit())
	$SystemTypes_list->RowIndex = 1;
if ($SystemTypes_list->isGridAdd())
	$SystemTypes_list->RowIndex = 0;
if ($SystemTypes_list->isGridEdit())
	$SystemTypes_list->RowIndex = 0;
while ($SystemTypes_list->RecordCount < $SystemTypes_list->StopRecord) {
	$SystemTypes_list->RecordCount++;
	if ($SystemTypes_list->RecordCount >= $SystemTypes_list->StartRecord) {
		$SystemTypes_list->RowCount++;
		if ($SystemTypes_list->isGridAdd() || $SystemTypes_list->isGridEdit() || $SystemTypes->isConfirm()) {
			$SystemTypes_list->RowIndex++;
			$CurrentForm->Index = $SystemTypes_list->RowIndex;
			if ($CurrentForm->hasValue($SystemTypes_list->FormActionName) && ($SystemTypes->isConfirm() || $SystemTypes_list->EventCancelled))
				$SystemTypes_list->RowAction = strval($CurrentForm->getValue($SystemTypes_list->FormActionName));
			elseif ($SystemTypes_list->isGridAdd())
				$SystemTypes_list->RowAction = "insert";
			else
				$SystemTypes_list->RowAction = "";
		}

		// Set up key count
		$SystemTypes_list->KeyCount = $SystemTypes_list->RowIndex;

		// Init row class and style
		$SystemTypes->resetAttributes();
		$SystemTypes->CssClass = "";
		if ($SystemTypes_list->isGridAdd()) {
			$SystemTypes_list->loadRowValues(); // Load default values
		} else {
			$SystemTypes_list->loadRowValues($SystemTypes_list->Recordset); // Load row values
		}
		$SystemTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($SystemTypes_list->isGridAdd()) // Grid add
			$SystemTypes->RowType = ROWTYPE_ADD; // Render add
		if ($SystemTypes_list->isGridAdd() && $SystemTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$SystemTypes_list->restoreCurrentRowFormValues($SystemTypes_list->RowIndex); // Restore form values
		if ($SystemTypes_list->isEdit()) {
			if ($SystemTypes_list->checkInlineEditKey() && $SystemTypes_list->EditRowCount == 0) { // Inline edit
				$SystemTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($SystemTypes_list->isGridEdit()) { // Grid edit
			if ($SystemTypes->EventCancelled)
				$SystemTypes_list->restoreCurrentRowFormValues($SystemTypes_list->RowIndex); // Restore form values
			if ($SystemTypes_list->RowAction == "insert")
				$SystemTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$SystemTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($SystemTypes_list->isEdit() && $SystemTypes->RowType == ROWTYPE_EDIT && $SystemTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$SystemTypes_list->restoreFormValues(); // Restore form values
		}
		if ($SystemTypes_list->isGridEdit() && ($SystemTypes->RowType == ROWTYPE_EDIT || $SystemTypes->RowType == ROWTYPE_ADD) && $SystemTypes->EventCancelled) // Update failed
			$SystemTypes_list->restoreCurrentRowFormValues($SystemTypes_list->RowIndex); // Restore form values
		if ($SystemTypes->RowType == ROWTYPE_EDIT) // Edit row
			$SystemTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$SystemTypes->RowAttrs->merge(["data-rowindex" => $SystemTypes_list->RowCount, "id" => "r" . $SystemTypes_list->RowCount . "_SystemTypes", "data-rowtype" => $SystemTypes->RowType]);

		// Render row
		$SystemTypes_list->renderRow();

		// Render list options
		$SystemTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($SystemTypes_list->RowAction != "delete" && $SystemTypes_list->RowAction != "insertdelete" && !($SystemTypes_list->RowAction == "insert" && $SystemTypes->isConfirm() && $SystemTypes_list->emptyRow())) {
?>
	<tr <?php echo $SystemTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$SystemTypes_list->ListOptions->render("body", "left", $SystemTypes_list->RowCount);
?>
	<?php if ($SystemTypes_list->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<td data-name="SystemType_Idn" <?php echo $SystemTypes_list->SystemType_Idn->cellAttributes() ?>>
<?php if ($SystemTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_SystemType_Idn" class="form-group"></span>
<input type="hidden" data-table="SystemTypes" data-field="x_SystemType_Idn" name="o<?php echo $SystemTypes_list->RowIndex ?>_SystemType_Idn" id="o<?php echo $SystemTypes_list->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemTypes_list->SystemType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($SystemTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_SystemType_Idn" class="form-group">
<span<?php echo $SystemTypes_list->SystemType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($SystemTypes_list->SystemType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_SystemType_Idn" name="x<?php echo $SystemTypes_list->RowIndex ?>_SystemType_Idn" id="x<?php echo $SystemTypes_list->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemTypes_list->SystemType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($SystemTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_SystemType_Idn">
<span<?php echo $SystemTypes_list->SystemType_Idn->viewAttributes() ?>><?php echo $SystemTypes_list->SystemType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $SystemTypes_list->Name->cellAttributes() ?>>
<?php if ($SystemTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Name" class="form-group">
<input type="text" data-table="SystemTypes" data-field="x_Name" name="x<?php echo $SystemTypes_list->RowIndex ?>_Name" id="x<?php echo $SystemTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $SystemTypes_list->Name->EditValue ?>"<?php echo $SystemTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_Name" name="o<?php echo $SystemTypes_list->RowIndex ?>_Name" id="o<?php echo $SystemTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($SystemTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Name" class="form-group">
<input type="text" data-table="SystemTypes" data-field="x_Name" name="x<?php echo $SystemTypes_list->RowIndex ?>_Name" id="x<?php echo $SystemTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $SystemTypes_list->Name->EditValue ?>"<?php echo $SystemTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($SystemTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Name">
<span<?php echo $SystemTypes_list->Name->viewAttributes() ?>><?php echo $SystemTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $SystemTypes_list->Rank->cellAttributes() ?>>
<?php if ($SystemTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Rank" class="form-group">
<input type="text" data-table="SystemTypes" data-field="x_Rank" name="x<?php echo $SystemTypes_list->RowIndex ?>_Rank" id="x<?php echo $SystemTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemTypes_list->Rank->EditValue ?>"<?php echo $SystemTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_Rank" name="o<?php echo $SystemTypes_list->RowIndex ?>_Rank" id="o<?php echo $SystemTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($SystemTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Rank" class="form-group">
<input type="text" data-table="SystemTypes" data-field="x_Rank" name="x<?php echo $SystemTypes_list->RowIndex ?>_Rank" id="x<?php echo $SystemTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemTypes_list->Rank->EditValue ?>"<?php echo $SystemTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($SystemTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Rank">
<span<?php echo $SystemTypes_list->Rank->viewAttributes() ?>><?php echo $SystemTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $SystemTypes_list->Department_Idn->cellAttributes() ?>>
<?php if ($SystemTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $SystemTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn"<?php echo $SystemTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $SystemTypes_list->Department_Idn->selectOptionListHtml("x{$SystemTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $SystemTypes_list->Department_Idn->Lookup->getParamTag($SystemTypes_list, "p_x" . $SystemTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_Department_Idn" name="o<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($SystemTypes_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($SystemTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $SystemTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn"<?php echo $SystemTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $SystemTypes_list->Department_Idn->selectOptionListHtml("x{$SystemTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $SystemTypes_list->Department_Idn->Lookup->getParamTag($SystemTypes_list, "p_x" . $SystemTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($SystemTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_Department_Idn">
<span<?php echo $SystemTypes_list->Department_Idn->viewAttributes() ?>><?php echo $SystemTypes_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $SystemTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($SystemTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($SystemTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]_104635" value="1"<?php echo $selwrk ?><?php echo $SystemTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]_104635"></label>
</div>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_ActiveFlag" name="o<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($SystemTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($SystemTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($SystemTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]_425477" value="1"<?php echo $selwrk ?><?php echo $SystemTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]_425477"></label>
</div>
</span>
<?php } ?>
<?php if ($SystemTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemTypes_list->RowCount ?>_SystemTypes_ActiveFlag">
<span<?php echo $SystemTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $SystemTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($SystemTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$SystemTypes_list->ListOptions->render("body", "right", $SystemTypes_list->RowCount);
?>
	</tr>
<?php if ($SystemTypes->RowType == ROWTYPE_ADD || $SystemTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fSystemTypeslist", "load"], function() {
	fSystemTypeslist.updateLists(<?php echo $SystemTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$SystemTypes_list->isGridAdd())
		if (!$SystemTypes_list->Recordset->EOF)
			$SystemTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($SystemTypes_list->isGridAdd() || $SystemTypes_list->isGridEdit()) {
		$SystemTypes_list->RowIndex = '$rowindex$';
		$SystemTypes_list->loadRowValues();

		// Set row properties
		$SystemTypes->resetAttributes();
		$SystemTypes->RowAttrs->merge(["data-rowindex" => $SystemTypes_list->RowIndex, "id" => "r0_SystemTypes", "data-rowtype" => ROWTYPE_ADD]);
		$SystemTypes->RowAttrs->appendClass("ew-template");
		$SystemTypes->RowType = ROWTYPE_ADD;

		// Render row
		$SystemTypes_list->renderRow();

		// Render list options
		$SystemTypes_list->renderListOptions();
		$SystemTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $SystemTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$SystemTypes_list->ListOptions->render("body", "left", $SystemTypes_list->RowIndex);
?>
	<?php if ($SystemTypes_list->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<td data-name="SystemType_Idn">
<span id="el$rowindex$_SystemTypes_SystemType_Idn" class="form-group SystemTypes_SystemType_Idn"></span>
<input type="hidden" data-table="SystemTypes" data-field="x_SystemType_Idn" name="o<?php echo $SystemTypes_list->RowIndex ?>_SystemType_Idn" id="o<?php echo $SystemTypes_list->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemTypes_list->SystemType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_SystemTypes_Name" class="form-group SystemTypes_Name">
<input type="text" data-table="SystemTypes" data-field="x_Name" name="x<?php echo $SystemTypes_list->RowIndex ?>_Name" id="x<?php echo $SystemTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $SystemTypes_list->Name->EditValue ?>"<?php echo $SystemTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_Name" name="o<?php echo $SystemTypes_list->RowIndex ?>_Name" id="o<?php echo $SystemTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_SystemTypes_Rank" class="form-group SystemTypes_Rank">
<input type="text" data-table="SystemTypes" data-field="x_Rank" name="x<?php echo $SystemTypes_list->RowIndex ?>_Rank" id="x<?php echo $SystemTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemTypes_list->Rank->EditValue ?>"<?php echo $SystemTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_Rank" name="o<?php echo $SystemTypes_list->RowIndex ?>_Rank" id="o<?php echo $SystemTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_SystemTypes_Department_Idn" class="form-group SystemTypes_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemTypes" data-field="x_Department_Idn" data-value-separator="<?php echo $SystemTypes_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn" name="x<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn"<?php echo $SystemTypes_list->Department_Idn->editAttributes() ?>>
			<?php echo $SystemTypes_list->Department_Idn->selectOptionListHtml("x{$SystemTypes_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $SystemTypes_list->Department_Idn->Lookup->getParamTag($SystemTypes_list, "p_x" . $SystemTypes_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_Department_Idn" name="o<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn" id="o<?php echo $SystemTypes_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($SystemTypes_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_SystemTypes_ActiveFlag" class="form-group SystemTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($SystemTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]_562268" value="1"<?php echo $selwrk ?><?php echo $SystemTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]_562268"></label>
</div>
</span>
<input type="hidden" data-table="SystemTypes" data-field="x_ActiveFlag" name="o<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $SystemTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($SystemTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$SystemTypes_list->ListOptions->render("body", "right", $SystemTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fSystemTypeslist", "load"], function() {
	fSystemTypeslist.updateLists(<?php echo $SystemTypes_list->RowIndex ?>);
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
<?php if ($SystemTypes_list->isAdd() || $SystemTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $SystemTypes_list->FormKeyCountName ?>" id="<?php echo $SystemTypes_list->FormKeyCountName ?>" value="<?php echo $SystemTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($SystemTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $SystemTypes_list->FormKeyCountName ?>" id="<?php echo $SystemTypes_list->FormKeyCountName ?>" value="<?php echo $SystemTypes_list->KeyCount ?>">
<?php echo $SystemTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($SystemTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $SystemTypes_list->FormKeyCountName ?>" id="<?php echo $SystemTypes_list->FormKeyCountName ?>" value="<?php echo $SystemTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($SystemTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $SystemTypes_list->FormKeyCountName ?>" id="<?php echo $SystemTypes_list->FormKeyCountName ?>" value="<?php echo $SystemTypes_list->KeyCount ?>">
<?php echo $SystemTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$SystemTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($SystemTypes_list->Recordset)
	$SystemTypes_list->Recordset->Close();
?>
<?php if (!$SystemTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$SystemTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $SystemTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $SystemTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($SystemTypes_list->TotalRecords == 0 && !$SystemTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $SystemTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$SystemTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$SystemTypes_list->isExport()) { ?>
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
$SystemTypes_list->terminate();
?>