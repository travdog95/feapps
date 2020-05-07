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
$SystemSubTypes_list = new SystemSubTypes_list();

// Run the page
$SystemSubTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SystemSubTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$SystemSubTypes_list->isExport()) { ?>
<script>
var fSystemSubTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fSystemSubTypeslist = currentForm = new ew.Form("fSystemSubTypeslist", "list");
	fSystemSubTypeslist.formKeyCountName = '<?php echo $SystemSubTypes_list->FormKeyCountName ?>';

	// Validate form
	fSystemSubTypeslist.validate = function() {
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
			<?php if ($SystemSubTypes_list->SystemSubType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SystemSubType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_list->SystemSubType_Idn->caption(), $SystemSubTypes_list->SystemSubType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemSubTypes_list->SystemType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SystemType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_list->SystemType_Idn->caption(), $SystemSubTypes_list->SystemType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemSubTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_list->Name->caption(), $SystemSubTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemSubTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_list->Rank->caption(), $SystemSubTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($SystemSubTypes_list->Rank->errorMessage()) ?>");
			<?php if ($SystemSubTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_list->ActiveFlag->caption(), $SystemSubTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fSystemSubTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "SystemType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fSystemSubTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fSystemSubTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fSystemSubTypeslist.lists["x_SystemType_Idn"] = <?php echo $SystemSubTypes_list->SystemType_Idn->Lookup->toClientList($SystemSubTypes_list) ?>;
	fSystemSubTypeslist.lists["x_SystemType_Idn"].options = <?php echo JsonEncode($SystemSubTypes_list->SystemType_Idn->lookupOptions()) ?>;
	fSystemSubTypeslist.lists["x_ActiveFlag[]"] = <?php echo $SystemSubTypes_list->ActiveFlag->Lookup->toClientList($SystemSubTypes_list) ?>;
	fSystemSubTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($SystemSubTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fSystemSubTypeslist");
});
var fSystemSubTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fSystemSubTypeslistsrch = currentSearchForm = new ew.Form("fSystemSubTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fSystemSubTypeslistsrch.filterList = <?php echo $SystemSubTypes_list->getFilterList() ?>;
	loadjs.done("fSystemSubTypeslistsrch");
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
<?php if (!$SystemSubTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($SystemSubTypes_list->TotalRecords > 0 && $SystemSubTypes_list->ExportOptions->visible()) { ?>
<?php $SystemSubTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($SystemSubTypes_list->ImportOptions->visible()) { ?>
<?php $SystemSubTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($SystemSubTypes_list->SearchOptions->visible()) { ?>
<?php $SystemSubTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($SystemSubTypes_list->FilterOptions->visible()) { ?>
<?php $SystemSubTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$SystemSubTypes_list->isExport() || Config("EXPORT_MASTER_RECORD") && $SystemSubTypes_list->isExport("print")) { ?>
<?php
if ($SystemSubTypes_list->DbMasterFilter != "" && $SystemSubTypes->getCurrentMasterTable() == "SystemTypes") {
	if ($SystemSubTypes_list->MasterRecordExists) {
		include_once "SystemTypesmaster.php";
	}
}
?>
<?php } ?>
<?php
$SystemSubTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$SystemSubTypes_list->isExport() && !$SystemSubTypes->CurrentAction) { ?>
<form name="fSystemSubTypeslistsrch" id="fSystemSubTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fSystemSubTypeslistsrch-search-panel" class="<?php echo $SystemSubTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="SystemSubTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $SystemSubTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($SystemSubTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($SystemSubTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $SystemSubTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($SystemSubTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($SystemSubTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($SystemSubTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($SystemSubTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $SystemSubTypes_list->showPageHeader(); ?>
<?php
$SystemSubTypes_list->showMessage();
?>
<?php if ($SystemSubTypes_list->TotalRecords > 0 || $SystemSubTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($SystemSubTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> SystemSubTypes">
<?php if (!$SystemSubTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$SystemSubTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $SystemSubTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $SystemSubTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fSystemSubTypeslist" id="fSystemSubTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SystemSubTypes">
<?php if ($SystemSubTypes->getCurrentMasterTable() == "SystemTypes" && $SystemSubTypes->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="SystemTypes">
<input type="hidden" name="fk_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_list->SystemSubType_Idn->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_SystemSubTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($SystemSubTypes_list->TotalRecords > 0 || $SystemSubTypes_list->isAdd() || $SystemSubTypes_list->isCopy() || $SystemSubTypes_list->isGridEdit()) { ?>
<table id="tbl_SystemSubTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$SystemSubTypes->RowType = ROWTYPE_HEADER;

// Render list options
$SystemSubTypes_list->renderListOptions();

// Render list options (header, left)
$SystemSubTypes_list->ListOptions->render("header", "left");
?>
<?php if ($SystemSubTypes_list->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
	<?php if ($SystemSubTypes_list->SortUrl($SystemSubTypes_list->SystemSubType_Idn) == "") { ?>
		<th data-name="SystemSubType_Idn" class="<?php echo $SystemSubTypes_list->SystemSubType_Idn->headerCellClass() ?>"><div id="elh_SystemSubTypes_SystemSubType_Idn" class="SystemSubTypes_SystemSubType_Idn"><div class="ew-table-header-caption"><?php echo $SystemSubTypes_list->SystemSubType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SystemSubType_Idn" class="<?php echo $SystemSubTypes_list->SystemSubType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $SystemSubTypes_list->SortUrl($SystemSubTypes_list->SystemSubType_Idn) ?>', 1);"><div id="elh_SystemSubTypes_SystemSubType_Idn" class="SystemSubTypes_SystemSubType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_list->SystemSubType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_list->SystemSubType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_list->SystemSubType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_list->SystemType_Idn->Visible) { // SystemType_Idn ?>
	<?php if ($SystemSubTypes_list->SortUrl($SystemSubTypes_list->SystemType_Idn) == "") { ?>
		<th data-name="SystemType_Idn" class="<?php echo $SystemSubTypes_list->SystemType_Idn->headerCellClass() ?>"><div id="elh_SystemSubTypes_SystemType_Idn" class="SystemSubTypes_SystemType_Idn"><div class="ew-table-header-caption"><?php echo $SystemSubTypes_list->SystemType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SystemType_Idn" class="<?php echo $SystemSubTypes_list->SystemType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $SystemSubTypes_list->SortUrl($SystemSubTypes_list->SystemType_Idn) ?>', 1);"><div id="elh_SystemSubTypes_SystemType_Idn" class="SystemSubTypes_SystemType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_list->SystemType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_list->SystemType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_list->SystemType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_list->Name->Visible) { // Name ?>
	<?php if ($SystemSubTypes_list->SortUrl($SystemSubTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $SystemSubTypes_list->Name->headerCellClass() ?>"><div id="elh_SystemSubTypes_Name" class="SystemSubTypes_Name"><div class="ew-table-header-caption"><?php echo $SystemSubTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $SystemSubTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $SystemSubTypes_list->SortUrl($SystemSubTypes_list->Name) ?>', 1);"><div id="elh_SystemSubTypes_Name" class="SystemSubTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($SystemSubTypes_list->SortUrl($SystemSubTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $SystemSubTypes_list->Rank->headerCellClass() ?>"><div id="elh_SystemSubTypes_Rank" class="SystemSubTypes_Rank"><div class="ew-table-header-caption"><?php echo $SystemSubTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $SystemSubTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $SystemSubTypes_list->SortUrl($SystemSubTypes_list->Rank) ?>', 1);"><div id="elh_SystemSubTypes_Rank" class="SystemSubTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($SystemSubTypes_list->SortUrl($SystemSubTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $SystemSubTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_SystemSubTypes_ActiveFlag" class="SystemSubTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $SystemSubTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $SystemSubTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $SystemSubTypes_list->SortUrl($SystemSubTypes_list->ActiveFlag) ?>', 1);"><div id="elh_SystemSubTypes_ActiveFlag" class="SystemSubTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$SystemSubTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($SystemSubTypes_list->isAdd() || $SystemSubTypes_list->isCopy()) {
		$SystemSubTypes_list->RowIndex = 0;
		$SystemSubTypes_list->KeyCount = $SystemSubTypes_list->RowIndex;
		if ($SystemSubTypes_list->isCopy() && !$SystemSubTypes_list->loadRow())
			$SystemSubTypes->CurrentAction = "add";
		if ($SystemSubTypes_list->isAdd())
			$SystemSubTypes_list->loadRowValues();
		if ($SystemSubTypes->EventCancelled) // Insert failed
			$SystemSubTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$SystemSubTypes->resetAttributes();
		$SystemSubTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_SystemSubTypes", "data-rowtype" => ROWTYPE_ADD]);
		$SystemSubTypes->RowType = ROWTYPE_ADD;

		// Render row
		$SystemSubTypes_list->renderRow();

		// Render list options
		$SystemSubTypes_list->renderListOptions();
		$SystemSubTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $SystemSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$SystemSubTypes_list->ListOptions->render("body", "left", $SystemSubTypes_list->RowCount);
?>
	<?php if ($SystemSubTypes_list->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
		<td data-name="SystemSubType_Idn">
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_SystemSubType_Idn" class="form-group SystemSubTypes_SystemSubType_Idn"></span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemSubType_Idn" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_list->SystemSubType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<td data-name="SystemType_Idn">
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_SystemType_Idn" class="form-group SystemSubTypes_SystemType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemSubTypes" data-field="x_SystemType_Idn" data-value-separator="<?php echo $SystemSubTypes_list->SystemType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn"<?php echo $SystemSubTypes_list->SystemType_Idn->editAttributes() ?>>
			<?php echo $SystemSubTypes_list->SystemType_Idn->selectOptionListHtml("x{$SystemSubTypes_list->RowIndex}_SystemType_Idn") ?>
		</select>
</div>
<?php echo $SystemSubTypes_list->SystemType_Idn->Lookup->getParamTag($SystemSubTypes_list, "p_x" . $SystemSubTypes_list->RowIndex . "_SystemType_Idn") ?>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemType_Idn" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_list->SystemType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_Name" class="form-group SystemSubTypes_Name">
<input type="text" data-table="SystemSubTypes" data-field="x_Name" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_Name" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemSubTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_list->Name->EditValue ?>"<?php echo $SystemSubTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Name" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_Name" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemSubTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_Rank" class="form-group SystemSubTypes_Rank">
<input type="text" data-table="SystemSubTypes" data-field="x_Rank" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemSubTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_list->Rank->EditValue ?>"<?php echo $SystemSubTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Rank" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemSubTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_ActiveFlag" class="form-group SystemSubTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($SystemSubTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]_818142" value="1"<?php echo $selwrk ?><?php echo $SystemSubTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]_818142"></label>
</div>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($SystemSubTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$SystemSubTypes_list->ListOptions->render("body", "right", $SystemSubTypes_list->RowCount);
?>
<script>
loadjs.ready(["fSystemSubTypeslist", "load"], function() {
	fSystemSubTypeslist.updateLists(<?php echo $SystemSubTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($SystemSubTypes_list->ExportAll && $SystemSubTypes_list->isExport()) {
	$SystemSubTypes_list->StopRecord = $SystemSubTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($SystemSubTypes_list->TotalRecords > $SystemSubTypes_list->StartRecord + $SystemSubTypes_list->DisplayRecords - 1)
		$SystemSubTypes_list->StopRecord = $SystemSubTypes_list->StartRecord + $SystemSubTypes_list->DisplayRecords - 1;
	else
		$SystemSubTypes_list->StopRecord = $SystemSubTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($SystemSubTypes->isConfirm() || $SystemSubTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($SystemSubTypes_list->FormKeyCountName) && ($SystemSubTypes_list->isGridAdd() || $SystemSubTypes_list->isGridEdit() || $SystemSubTypes->isConfirm())) {
		$SystemSubTypes_list->KeyCount = $CurrentForm->getValue($SystemSubTypes_list->FormKeyCountName);
		$SystemSubTypes_list->StopRecord = $SystemSubTypes_list->StartRecord + $SystemSubTypes_list->KeyCount - 1;
	}
}
$SystemSubTypes_list->RecordCount = $SystemSubTypes_list->StartRecord - 1;
if ($SystemSubTypes_list->Recordset && !$SystemSubTypes_list->Recordset->EOF) {
	$SystemSubTypes_list->Recordset->moveFirst();
	$selectLimit = $SystemSubTypes_list->UseSelectLimit;
	if (!$selectLimit && $SystemSubTypes_list->StartRecord > 1)
		$SystemSubTypes_list->Recordset->move($SystemSubTypes_list->StartRecord - 1);
} elseif (!$SystemSubTypes->AllowAddDeleteRow && $SystemSubTypes_list->StopRecord == 0) {
	$SystemSubTypes_list->StopRecord = $SystemSubTypes->GridAddRowCount;
}

// Initialize aggregate
$SystemSubTypes->RowType = ROWTYPE_AGGREGATEINIT;
$SystemSubTypes->resetAttributes();
$SystemSubTypes_list->renderRow();
$SystemSubTypes_list->EditRowCount = 0;
if ($SystemSubTypes_list->isEdit())
	$SystemSubTypes_list->RowIndex = 1;
if ($SystemSubTypes_list->isGridAdd())
	$SystemSubTypes_list->RowIndex = 0;
if ($SystemSubTypes_list->isGridEdit())
	$SystemSubTypes_list->RowIndex = 0;
while ($SystemSubTypes_list->RecordCount < $SystemSubTypes_list->StopRecord) {
	$SystemSubTypes_list->RecordCount++;
	if ($SystemSubTypes_list->RecordCount >= $SystemSubTypes_list->StartRecord) {
		$SystemSubTypes_list->RowCount++;
		if ($SystemSubTypes_list->isGridAdd() || $SystemSubTypes_list->isGridEdit() || $SystemSubTypes->isConfirm()) {
			$SystemSubTypes_list->RowIndex++;
			$CurrentForm->Index = $SystemSubTypes_list->RowIndex;
			if ($CurrentForm->hasValue($SystemSubTypes_list->FormActionName) && ($SystemSubTypes->isConfirm() || $SystemSubTypes_list->EventCancelled))
				$SystemSubTypes_list->RowAction = strval($CurrentForm->getValue($SystemSubTypes_list->FormActionName));
			elseif ($SystemSubTypes_list->isGridAdd())
				$SystemSubTypes_list->RowAction = "insert";
			else
				$SystemSubTypes_list->RowAction = "";
		}

		// Set up key count
		$SystemSubTypes_list->KeyCount = $SystemSubTypes_list->RowIndex;

		// Init row class and style
		$SystemSubTypes->resetAttributes();
		$SystemSubTypes->CssClass = "";
		if ($SystemSubTypes_list->isGridAdd()) {
			$SystemSubTypes_list->loadRowValues(); // Load default values
		} else {
			$SystemSubTypes_list->loadRowValues($SystemSubTypes_list->Recordset); // Load row values
		}
		$SystemSubTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($SystemSubTypes_list->isGridAdd()) // Grid add
			$SystemSubTypes->RowType = ROWTYPE_ADD; // Render add
		if ($SystemSubTypes_list->isGridAdd() && $SystemSubTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$SystemSubTypes_list->restoreCurrentRowFormValues($SystemSubTypes_list->RowIndex); // Restore form values
		if ($SystemSubTypes_list->isEdit()) {
			if ($SystemSubTypes_list->checkInlineEditKey() && $SystemSubTypes_list->EditRowCount == 0) { // Inline edit
				$SystemSubTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($SystemSubTypes_list->isGridEdit()) { // Grid edit
			if ($SystemSubTypes->EventCancelled)
				$SystemSubTypes_list->restoreCurrentRowFormValues($SystemSubTypes_list->RowIndex); // Restore form values
			if ($SystemSubTypes_list->RowAction == "insert")
				$SystemSubTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$SystemSubTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($SystemSubTypes_list->isEdit() && $SystemSubTypes->RowType == ROWTYPE_EDIT && $SystemSubTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$SystemSubTypes_list->restoreFormValues(); // Restore form values
		}
		if ($SystemSubTypes_list->isGridEdit() && ($SystemSubTypes->RowType == ROWTYPE_EDIT || $SystemSubTypes->RowType == ROWTYPE_ADD) && $SystemSubTypes->EventCancelled) // Update failed
			$SystemSubTypes_list->restoreCurrentRowFormValues($SystemSubTypes_list->RowIndex); // Restore form values
		if ($SystemSubTypes->RowType == ROWTYPE_EDIT) // Edit row
			$SystemSubTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$SystemSubTypes->RowAttrs->merge(["data-rowindex" => $SystemSubTypes_list->RowCount, "id" => "r" . $SystemSubTypes_list->RowCount . "_SystemSubTypes", "data-rowtype" => $SystemSubTypes->RowType]);

		// Render row
		$SystemSubTypes_list->renderRow();

		// Render list options
		$SystemSubTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($SystemSubTypes_list->RowAction != "delete" && $SystemSubTypes_list->RowAction != "insertdelete" && !($SystemSubTypes_list->RowAction == "insert" && $SystemSubTypes->isConfirm() && $SystemSubTypes_list->emptyRow())) {
?>
	<tr <?php echo $SystemSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$SystemSubTypes_list->ListOptions->render("body", "left", $SystemSubTypes_list->RowCount);
?>
	<?php if ($SystemSubTypes_list->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
		<td data-name="SystemSubType_Idn" <?php echo $SystemSubTypes_list->SystemSubType_Idn->cellAttributes() ?>>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_SystemSubType_Idn" class="form-group"></span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemSubType_Idn" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_list->SystemSubType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_SystemSubType_Idn" class="form-group">
<span<?php echo $SystemSubTypes_list->SystemSubType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($SystemSubTypes_list->SystemSubType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_SystemSubType_Idn" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_list->SystemSubType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_SystemSubType_Idn">
<span<?php echo $SystemSubTypes_list->SystemSubType_Idn->viewAttributes() ?>><?php echo $SystemSubTypes_list->SystemSubType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<td data-name="SystemType_Idn" <?php echo $SystemSubTypes_list->SystemType_Idn->cellAttributes() ?>>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_SystemType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemSubTypes" data-field="x_SystemType_Idn" data-value-separator="<?php echo $SystemSubTypes_list->SystemType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn"<?php echo $SystemSubTypes_list->SystemType_Idn->editAttributes() ?>>
			<?php echo $SystemSubTypes_list->SystemType_Idn->selectOptionListHtml("x{$SystemSubTypes_list->RowIndex}_SystemType_Idn") ?>
		</select>
</div>
<?php echo $SystemSubTypes_list->SystemType_Idn->Lookup->getParamTag($SystemSubTypes_list, "p_x" . $SystemSubTypes_list->RowIndex . "_SystemType_Idn") ?>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemType_Idn" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_list->SystemType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_SystemType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemSubTypes" data-field="x_SystemType_Idn" data-value-separator="<?php echo $SystemSubTypes_list->SystemType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn"<?php echo $SystemSubTypes_list->SystemType_Idn->editAttributes() ?>>
			<?php echo $SystemSubTypes_list->SystemType_Idn->selectOptionListHtml("x{$SystemSubTypes_list->RowIndex}_SystemType_Idn") ?>
		</select>
</div>
<?php echo $SystemSubTypes_list->SystemType_Idn->Lookup->getParamTag($SystemSubTypes_list, "p_x" . $SystemSubTypes_list->RowIndex . "_SystemType_Idn") ?>
</span>
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_SystemType_Idn">
<span<?php echo $SystemSubTypes_list->SystemType_Idn->viewAttributes() ?>><?php echo $SystemSubTypes_list->SystemType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $SystemSubTypes_list->Name->cellAttributes() ?>>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_Name" class="form-group">
<input type="text" data-table="SystemSubTypes" data-field="x_Name" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_Name" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemSubTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_list->Name->EditValue ?>"<?php echo $SystemSubTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Name" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_Name" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemSubTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_Name" class="form-group">
<input type="text" data-table="SystemSubTypes" data-field="x_Name" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_Name" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemSubTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_list->Name->EditValue ?>"<?php echo $SystemSubTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_Name">
<span<?php echo $SystemSubTypes_list->Name->viewAttributes() ?>><?php echo $SystemSubTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $SystemSubTypes_list->Rank->cellAttributes() ?>>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_Rank" class="form-group">
<input type="text" data-table="SystemSubTypes" data-field="x_Rank" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemSubTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_list->Rank->EditValue ?>"<?php echo $SystemSubTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Rank" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemSubTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_Rank" class="form-group">
<input type="text" data-table="SystemSubTypes" data-field="x_Rank" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemSubTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_list->Rank->EditValue ?>"<?php echo $SystemSubTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_Rank">
<span<?php echo $SystemSubTypes_list->Rank->viewAttributes() ?>><?php echo $SystemSubTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $SystemSubTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($SystemSubTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]_125537" value="1"<?php echo $selwrk ?><?php echo $SystemSubTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]_125537"></label>
</div>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($SystemSubTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($SystemSubTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]_222511" value="1"<?php echo $selwrk ?><?php echo $SystemSubTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]_222511"></label>
</div>
</span>
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemSubTypes_list->RowCount ?>_SystemSubTypes_ActiveFlag">
<span<?php echo $SystemSubTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $SystemSubTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($SystemSubTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$SystemSubTypes_list->ListOptions->render("body", "right", $SystemSubTypes_list->RowCount);
?>
	</tr>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD || $SystemSubTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fSystemSubTypeslist", "load"], function() {
	fSystemSubTypeslist.updateLists(<?php echo $SystemSubTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$SystemSubTypes_list->isGridAdd())
		if (!$SystemSubTypes_list->Recordset->EOF)
			$SystemSubTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($SystemSubTypes_list->isGridAdd() || $SystemSubTypes_list->isGridEdit()) {
		$SystemSubTypes_list->RowIndex = '$rowindex$';
		$SystemSubTypes_list->loadRowValues();

		// Set row properties
		$SystemSubTypes->resetAttributes();
		$SystemSubTypes->RowAttrs->merge(["data-rowindex" => $SystemSubTypes_list->RowIndex, "id" => "r0_SystemSubTypes", "data-rowtype" => ROWTYPE_ADD]);
		$SystemSubTypes->RowAttrs->appendClass("ew-template");
		$SystemSubTypes->RowType = ROWTYPE_ADD;

		// Render row
		$SystemSubTypes_list->renderRow();

		// Render list options
		$SystemSubTypes_list->renderListOptions();
		$SystemSubTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $SystemSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$SystemSubTypes_list->ListOptions->render("body", "left", $SystemSubTypes_list->RowIndex);
?>
	<?php if ($SystemSubTypes_list->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
		<td data-name="SystemSubType_Idn">
<span id="el$rowindex$_SystemSubTypes_SystemSubType_Idn" class="form-group SystemSubTypes_SystemSubType_Idn"></span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemSubType_Idn" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_list->SystemSubType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<td data-name="SystemType_Idn">
<span id="el$rowindex$_SystemSubTypes_SystemType_Idn" class="form-group SystemSubTypes_SystemType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemSubTypes" data-field="x_SystemType_Idn" data-value-separator="<?php echo $SystemSubTypes_list->SystemType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn"<?php echo $SystemSubTypes_list->SystemType_Idn->editAttributes() ?>>
			<?php echo $SystemSubTypes_list->SystemType_Idn->selectOptionListHtml("x{$SystemSubTypes_list->RowIndex}_SystemType_Idn") ?>
		</select>
</div>
<?php echo $SystemSubTypes_list->SystemType_Idn->Lookup->getParamTag($SystemSubTypes_list, "p_x" . $SystemSubTypes_list->RowIndex . "_SystemType_Idn") ?>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemType_Idn" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_list->SystemType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_SystemSubTypes_Name" class="form-group SystemSubTypes_Name">
<input type="text" data-table="SystemSubTypes" data-field="x_Name" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_Name" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemSubTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_list->Name->EditValue ?>"<?php echo $SystemSubTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Name" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_Name" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemSubTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_SystemSubTypes_Rank" class="form-group SystemSubTypes_Rank">
<input type="text" data-table="SystemSubTypes" data-field="x_Rank" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemSubTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_list->Rank->EditValue ?>"<?php echo $SystemSubTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Rank" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemSubTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_SystemSubTypes_ActiveFlag" class="form-group SystemSubTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($SystemSubTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]_378755" value="1"<?php echo $selwrk ?><?php echo $SystemSubTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]_378755"></label>
</div>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="o<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $SystemSubTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($SystemSubTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$SystemSubTypes_list->ListOptions->render("body", "right", $SystemSubTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fSystemSubTypeslist", "load"], function() {
	fSystemSubTypeslist.updateLists(<?php echo $SystemSubTypes_list->RowIndex ?>);
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
<?php if ($SystemSubTypes_list->isAdd() || $SystemSubTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $SystemSubTypes_list->FormKeyCountName ?>" id="<?php echo $SystemSubTypes_list->FormKeyCountName ?>" value="<?php echo $SystemSubTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($SystemSubTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $SystemSubTypes_list->FormKeyCountName ?>" id="<?php echo $SystemSubTypes_list->FormKeyCountName ?>" value="<?php echo $SystemSubTypes_list->KeyCount ?>">
<?php echo $SystemSubTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($SystemSubTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $SystemSubTypes_list->FormKeyCountName ?>" id="<?php echo $SystemSubTypes_list->FormKeyCountName ?>" value="<?php echo $SystemSubTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($SystemSubTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $SystemSubTypes_list->FormKeyCountName ?>" id="<?php echo $SystemSubTypes_list->FormKeyCountName ?>" value="<?php echo $SystemSubTypes_list->KeyCount ?>">
<?php echo $SystemSubTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$SystemSubTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($SystemSubTypes_list->Recordset)
	$SystemSubTypes_list->Recordset->Close();
?>
<?php if (!$SystemSubTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$SystemSubTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $SystemSubTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $SystemSubTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($SystemSubTypes_list->TotalRecords == 0 && !$SystemSubTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $SystemSubTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$SystemSubTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$SystemSubTypes_list->isExport()) { ?>
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
$SystemSubTypes_list->terminate();
?>