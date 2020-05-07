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
$HeadTypes_list = new HeadTypes_list();

// Run the page
$HeadTypes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HeadTypes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$HeadTypes_list->isExport()) { ?>
<script>
var fHeadTypeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fHeadTypeslist = currentForm = new ew.Form("fHeadTypeslist", "list");
	fHeadTypeslist.formKeyCountName = '<?php echo $HeadTypes_list->FormKeyCountName ?>';

	// Validate form
	fHeadTypeslist.validate = function() {
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
			<?php if ($HeadTypes_list->HeadType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HeadType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HeadTypes_list->HeadType_Idn->caption(), $HeadTypes_list->HeadType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HeadTypes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HeadTypes_list->Name->caption(), $HeadTypes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HeadTypes_list->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HeadTypes_list->ShortName->caption(), $HeadTypes_list->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HeadTypes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HeadTypes_list->Rank->caption(), $HeadTypes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($HeadTypes_list->Rank->errorMessage()) ?>");
			<?php if ($HeadTypes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HeadTypes_list->ActiveFlag->caption(), $HeadTypes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fHeadTypeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "ShortName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fHeadTypeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fHeadTypeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fHeadTypeslist.lists["x_ActiveFlag[]"] = <?php echo $HeadTypes_list->ActiveFlag->Lookup->toClientList($HeadTypes_list) ?>;
	fHeadTypeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($HeadTypes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fHeadTypeslist");
});
var fHeadTypeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fHeadTypeslistsrch = currentSearchForm = new ew.Form("fHeadTypeslistsrch");

	// Dynamic selection lists
	// Filters

	fHeadTypeslistsrch.filterList = <?php echo $HeadTypes_list->getFilterList() ?>;
	loadjs.done("fHeadTypeslistsrch");
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
<?php if (!$HeadTypes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($HeadTypes_list->TotalRecords > 0 && $HeadTypes_list->ExportOptions->visible()) { ?>
<?php $HeadTypes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($HeadTypes_list->ImportOptions->visible()) { ?>
<?php $HeadTypes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($HeadTypes_list->SearchOptions->visible()) { ?>
<?php $HeadTypes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($HeadTypes_list->FilterOptions->visible()) { ?>
<?php $HeadTypes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$HeadTypes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$HeadTypes_list->isExport() && !$HeadTypes->CurrentAction) { ?>
<form name="fHeadTypeslistsrch" id="fHeadTypeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fHeadTypeslistsrch-search-panel" class="<?php echo $HeadTypes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="HeadTypes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $HeadTypes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($HeadTypes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($HeadTypes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $HeadTypes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($HeadTypes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($HeadTypes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($HeadTypes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($HeadTypes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $HeadTypes_list->showPageHeader(); ?>
<?php
$HeadTypes_list->showMessage();
?>
<?php if ($HeadTypes_list->TotalRecords > 0 || $HeadTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($HeadTypes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> HeadTypes">
<?php if (!$HeadTypes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$HeadTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $HeadTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $HeadTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fHeadTypeslist" id="fHeadTypeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="HeadTypes">
<div id="gmp_HeadTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($HeadTypes_list->TotalRecords > 0 || $HeadTypes_list->isAdd() || $HeadTypes_list->isCopy() || $HeadTypes_list->isGridEdit()) { ?>
<table id="tbl_HeadTypeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$HeadTypes->RowType = ROWTYPE_HEADER;

// Render list options
$HeadTypes_list->renderListOptions();

// Render list options (header, left)
$HeadTypes_list->ListOptions->render("header", "left");
?>
<?php if ($HeadTypes_list->HeadType_Idn->Visible) { // HeadType_Idn ?>
	<?php if ($HeadTypes_list->SortUrl($HeadTypes_list->HeadType_Idn) == "") { ?>
		<th data-name="HeadType_Idn" class="<?php echo $HeadTypes_list->HeadType_Idn->headerCellClass() ?>"><div id="elh_HeadTypes_HeadType_Idn" class="HeadTypes_HeadType_Idn"><div class="ew-table-header-caption"><?php echo $HeadTypes_list->HeadType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HeadType_Idn" class="<?php echo $HeadTypes_list->HeadType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HeadTypes_list->SortUrl($HeadTypes_list->HeadType_Idn) ?>', 1);"><div id="elh_HeadTypes_HeadType_Idn" class="HeadTypes_HeadType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HeadTypes_list->HeadType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($HeadTypes_list->HeadType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HeadTypes_list->HeadType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HeadTypes_list->Name->Visible) { // Name ?>
	<?php if ($HeadTypes_list->SortUrl($HeadTypes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $HeadTypes_list->Name->headerCellClass() ?>"><div id="elh_HeadTypes_Name" class="HeadTypes_Name"><div class="ew-table-header-caption"><?php echo $HeadTypes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $HeadTypes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HeadTypes_list->SortUrl($HeadTypes_list->Name) ?>', 1);"><div id="elh_HeadTypes_Name" class="HeadTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HeadTypes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($HeadTypes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HeadTypes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HeadTypes_list->ShortName->Visible) { // ShortName ?>
	<?php if ($HeadTypes_list->SortUrl($HeadTypes_list->ShortName) == "") { ?>
		<th data-name="ShortName" class="<?php echo $HeadTypes_list->ShortName->headerCellClass() ?>"><div id="elh_HeadTypes_ShortName" class="HeadTypes_ShortName"><div class="ew-table-header-caption"><?php echo $HeadTypes_list->ShortName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShortName" class="<?php echo $HeadTypes_list->ShortName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HeadTypes_list->SortUrl($HeadTypes_list->ShortName) ?>', 1);"><div id="elh_HeadTypes_ShortName" class="HeadTypes_ShortName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HeadTypes_list->ShortName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($HeadTypes_list->ShortName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HeadTypes_list->ShortName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HeadTypes_list->Rank->Visible) { // Rank ?>
	<?php if ($HeadTypes_list->SortUrl($HeadTypes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $HeadTypes_list->Rank->headerCellClass() ?>"><div id="elh_HeadTypes_Rank" class="HeadTypes_Rank"><div class="ew-table-header-caption"><?php echo $HeadTypes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $HeadTypes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HeadTypes_list->SortUrl($HeadTypes_list->Rank) ?>', 1);"><div id="elh_HeadTypes_Rank" class="HeadTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HeadTypes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($HeadTypes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HeadTypes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HeadTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($HeadTypes_list->SortUrl($HeadTypes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $HeadTypes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_HeadTypes_ActiveFlag" class="HeadTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $HeadTypes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $HeadTypes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $HeadTypes_list->SortUrl($HeadTypes_list->ActiveFlag) ?>', 1);"><div id="elh_HeadTypes_ActiveFlag" class="HeadTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HeadTypes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($HeadTypes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HeadTypes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$HeadTypes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($HeadTypes_list->isAdd() || $HeadTypes_list->isCopy()) {
		$HeadTypes_list->RowIndex = 0;
		$HeadTypes_list->KeyCount = $HeadTypes_list->RowIndex;
		if ($HeadTypes_list->isCopy() && !$HeadTypes_list->loadRow())
			$HeadTypes->CurrentAction = "add";
		if ($HeadTypes_list->isAdd())
			$HeadTypes_list->loadRowValues();
		if ($HeadTypes->EventCancelled) // Insert failed
			$HeadTypes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$HeadTypes->resetAttributes();
		$HeadTypes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_HeadTypes", "data-rowtype" => ROWTYPE_ADD]);
		$HeadTypes->RowType = ROWTYPE_ADD;

		// Render row
		$HeadTypes_list->renderRow();

		// Render list options
		$HeadTypes_list->renderListOptions();
		$HeadTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $HeadTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HeadTypes_list->ListOptions->render("body", "left", $HeadTypes_list->RowCount);
?>
	<?php if ($HeadTypes_list->HeadType_Idn->Visible) { // HeadType_Idn ?>
		<td data-name="HeadType_Idn">
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_HeadType_Idn" class="form-group HeadTypes_HeadType_Idn"></span>
<input type="hidden" data-table="HeadTypes" data-field="x_HeadType_Idn" name="o<?php echo $HeadTypes_list->RowIndex ?>_HeadType_Idn" id="o<?php echo $HeadTypes_list->RowIndex ?>_HeadType_Idn" value="<?php echo HtmlEncode($HeadTypes_list->HeadType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_Name" class="form-group HeadTypes_Name">
<input type="text" data-table="HeadTypes" data-field="x_Name" name="x<?php echo $HeadTypes_list->RowIndex ?>_Name" id="x<?php echo $HeadTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HeadTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->Name->EditValue ?>"<?php echo $HeadTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_Name" name="o<?php echo $HeadTypes_list->RowIndex ?>_Name" id="o<?php echo $HeadTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($HeadTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_ShortName" class="form-group HeadTypes_ShortName">
<input type="text" data-table="HeadTypes" data-field="x_ShortName" name="x<?php echo $HeadTypes_list->RowIndex ?>_ShortName" id="x<?php echo $HeadTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($HeadTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->ShortName->EditValue ?>"<?php echo $HeadTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_ShortName" name="o<?php echo $HeadTypes_list->RowIndex ?>_ShortName" id="o<?php echo $HeadTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($HeadTypes_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_Rank" class="form-group HeadTypes_Rank">
<input type="text" data-table="HeadTypes" data-field="x_Rank" name="x<?php echo $HeadTypes_list->RowIndex ?>_Rank" id="x<?php echo $HeadTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HeadTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->Rank->EditValue ?>"<?php echo $HeadTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_Rank" name="o<?php echo $HeadTypes_list->RowIndex ?>_Rank" id="o<?php echo $HeadTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HeadTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_ActiveFlag" class="form-group HeadTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($HeadTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HeadTypes" data-field="x_ActiveFlag" name="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]_256493" value="1"<?php echo $selwrk ?><?php echo $HeadTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]_256493"></label>
</div>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_ActiveFlag" name="o<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HeadTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$HeadTypes_list->ListOptions->render("body", "right", $HeadTypes_list->RowCount);
?>
<script>
loadjs.ready(["fHeadTypeslist", "load"], function() {
	fHeadTypeslist.updateLists(<?php echo $HeadTypes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($HeadTypes_list->ExportAll && $HeadTypes_list->isExport()) {
	$HeadTypes_list->StopRecord = $HeadTypes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($HeadTypes_list->TotalRecords > $HeadTypes_list->StartRecord + $HeadTypes_list->DisplayRecords - 1)
		$HeadTypes_list->StopRecord = $HeadTypes_list->StartRecord + $HeadTypes_list->DisplayRecords - 1;
	else
		$HeadTypes_list->StopRecord = $HeadTypes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($HeadTypes->isConfirm() || $HeadTypes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($HeadTypes_list->FormKeyCountName) && ($HeadTypes_list->isGridAdd() || $HeadTypes_list->isGridEdit() || $HeadTypes->isConfirm())) {
		$HeadTypes_list->KeyCount = $CurrentForm->getValue($HeadTypes_list->FormKeyCountName);
		$HeadTypes_list->StopRecord = $HeadTypes_list->StartRecord + $HeadTypes_list->KeyCount - 1;
	}
}
$HeadTypes_list->RecordCount = $HeadTypes_list->StartRecord - 1;
if ($HeadTypes_list->Recordset && !$HeadTypes_list->Recordset->EOF) {
	$HeadTypes_list->Recordset->moveFirst();
	$selectLimit = $HeadTypes_list->UseSelectLimit;
	if (!$selectLimit && $HeadTypes_list->StartRecord > 1)
		$HeadTypes_list->Recordset->move($HeadTypes_list->StartRecord - 1);
} elseif (!$HeadTypes->AllowAddDeleteRow && $HeadTypes_list->StopRecord == 0) {
	$HeadTypes_list->StopRecord = $HeadTypes->GridAddRowCount;
}

// Initialize aggregate
$HeadTypes->RowType = ROWTYPE_AGGREGATEINIT;
$HeadTypes->resetAttributes();
$HeadTypes_list->renderRow();
$HeadTypes_list->EditRowCount = 0;
if ($HeadTypes_list->isEdit())
	$HeadTypes_list->RowIndex = 1;
if ($HeadTypes_list->isGridAdd())
	$HeadTypes_list->RowIndex = 0;
if ($HeadTypes_list->isGridEdit())
	$HeadTypes_list->RowIndex = 0;
while ($HeadTypes_list->RecordCount < $HeadTypes_list->StopRecord) {
	$HeadTypes_list->RecordCount++;
	if ($HeadTypes_list->RecordCount >= $HeadTypes_list->StartRecord) {
		$HeadTypes_list->RowCount++;
		if ($HeadTypes_list->isGridAdd() || $HeadTypes_list->isGridEdit() || $HeadTypes->isConfirm()) {
			$HeadTypes_list->RowIndex++;
			$CurrentForm->Index = $HeadTypes_list->RowIndex;
			if ($CurrentForm->hasValue($HeadTypes_list->FormActionName) && ($HeadTypes->isConfirm() || $HeadTypes_list->EventCancelled))
				$HeadTypes_list->RowAction = strval($CurrentForm->getValue($HeadTypes_list->FormActionName));
			elseif ($HeadTypes_list->isGridAdd())
				$HeadTypes_list->RowAction = "insert";
			else
				$HeadTypes_list->RowAction = "";
		}

		// Set up key count
		$HeadTypes_list->KeyCount = $HeadTypes_list->RowIndex;

		// Init row class and style
		$HeadTypes->resetAttributes();
		$HeadTypes->CssClass = "";
		if ($HeadTypes_list->isGridAdd()) {
			$HeadTypes_list->loadRowValues(); // Load default values
		} else {
			$HeadTypes_list->loadRowValues($HeadTypes_list->Recordset); // Load row values
		}
		$HeadTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($HeadTypes_list->isGridAdd()) // Grid add
			$HeadTypes->RowType = ROWTYPE_ADD; // Render add
		if ($HeadTypes_list->isGridAdd() && $HeadTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$HeadTypes_list->restoreCurrentRowFormValues($HeadTypes_list->RowIndex); // Restore form values
		if ($HeadTypes_list->isEdit()) {
			if ($HeadTypes_list->checkInlineEditKey() && $HeadTypes_list->EditRowCount == 0) { // Inline edit
				$HeadTypes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($HeadTypes_list->isGridEdit()) { // Grid edit
			if ($HeadTypes->EventCancelled)
				$HeadTypes_list->restoreCurrentRowFormValues($HeadTypes_list->RowIndex); // Restore form values
			if ($HeadTypes_list->RowAction == "insert")
				$HeadTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$HeadTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($HeadTypes_list->isEdit() && $HeadTypes->RowType == ROWTYPE_EDIT && $HeadTypes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$HeadTypes_list->restoreFormValues(); // Restore form values
		}
		if ($HeadTypes_list->isGridEdit() && ($HeadTypes->RowType == ROWTYPE_EDIT || $HeadTypes->RowType == ROWTYPE_ADD) && $HeadTypes->EventCancelled) // Update failed
			$HeadTypes_list->restoreCurrentRowFormValues($HeadTypes_list->RowIndex); // Restore form values
		if ($HeadTypes->RowType == ROWTYPE_EDIT) // Edit row
			$HeadTypes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$HeadTypes->RowAttrs->merge(["data-rowindex" => $HeadTypes_list->RowCount, "id" => "r" . $HeadTypes_list->RowCount . "_HeadTypes", "data-rowtype" => $HeadTypes->RowType]);

		// Render row
		$HeadTypes_list->renderRow();

		// Render list options
		$HeadTypes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($HeadTypes_list->RowAction != "delete" && $HeadTypes_list->RowAction != "insertdelete" && !($HeadTypes_list->RowAction == "insert" && $HeadTypes->isConfirm() && $HeadTypes_list->emptyRow())) {
?>
	<tr <?php echo $HeadTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HeadTypes_list->ListOptions->render("body", "left", $HeadTypes_list->RowCount);
?>
	<?php if ($HeadTypes_list->HeadType_Idn->Visible) { // HeadType_Idn ?>
		<td data-name="HeadType_Idn" <?php echo $HeadTypes_list->HeadType_Idn->cellAttributes() ?>>
<?php if ($HeadTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_HeadType_Idn" class="form-group"></span>
<input type="hidden" data-table="HeadTypes" data-field="x_HeadType_Idn" name="o<?php echo $HeadTypes_list->RowIndex ?>_HeadType_Idn" id="o<?php echo $HeadTypes_list->RowIndex ?>_HeadType_Idn" value="<?php echo HtmlEncode($HeadTypes_list->HeadType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($HeadTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_HeadType_Idn" class="form-group">
<span<?php echo $HeadTypes_list->HeadType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HeadTypes_list->HeadType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_HeadType_Idn" name="x<?php echo $HeadTypes_list->RowIndex ?>_HeadType_Idn" id="x<?php echo $HeadTypes_list->RowIndex ?>_HeadType_Idn" value="<?php echo HtmlEncode($HeadTypes_list->HeadType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($HeadTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_HeadType_Idn">
<span<?php echo $HeadTypes_list->HeadType_Idn->viewAttributes() ?>><?php echo $HeadTypes_list->HeadType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $HeadTypes_list->Name->cellAttributes() ?>>
<?php if ($HeadTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_Name" class="form-group">
<input type="text" data-table="HeadTypes" data-field="x_Name" name="x<?php echo $HeadTypes_list->RowIndex ?>_Name" id="x<?php echo $HeadTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HeadTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->Name->EditValue ?>"<?php echo $HeadTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_Name" name="o<?php echo $HeadTypes_list->RowIndex ?>_Name" id="o<?php echo $HeadTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($HeadTypes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($HeadTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_Name" class="form-group">
<input type="text" data-table="HeadTypes" data-field="x_Name" name="x<?php echo $HeadTypes_list->RowIndex ?>_Name" id="x<?php echo $HeadTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HeadTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->Name->EditValue ?>"<?php echo $HeadTypes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($HeadTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_Name">
<span<?php echo $HeadTypes_list->Name->viewAttributes() ?>><?php echo $HeadTypes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName" <?php echo $HeadTypes_list->ShortName->cellAttributes() ?>>
<?php if ($HeadTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_ShortName" class="form-group">
<input type="text" data-table="HeadTypes" data-field="x_ShortName" name="x<?php echo $HeadTypes_list->RowIndex ?>_ShortName" id="x<?php echo $HeadTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($HeadTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->ShortName->EditValue ?>"<?php echo $HeadTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_ShortName" name="o<?php echo $HeadTypes_list->RowIndex ?>_ShortName" id="o<?php echo $HeadTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($HeadTypes_list->ShortName->OldValue) ?>">
<?php } ?>
<?php if ($HeadTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_ShortName" class="form-group">
<input type="text" data-table="HeadTypes" data-field="x_ShortName" name="x<?php echo $HeadTypes_list->RowIndex ?>_ShortName" id="x<?php echo $HeadTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($HeadTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->ShortName->EditValue ?>"<?php echo $HeadTypes_list->ShortName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($HeadTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_ShortName">
<span<?php echo $HeadTypes_list->ShortName->viewAttributes() ?>><?php echo $HeadTypes_list->ShortName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $HeadTypes_list->Rank->cellAttributes() ?>>
<?php if ($HeadTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_Rank" class="form-group">
<input type="text" data-table="HeadTypes" data-field="x_Rank" name="x<?php echo $HeadTypes_list->RowIndex ?>_Rank" id="x<?php echo $HeadTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HeadTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->Rank->EditValue ?>"<?php echo $HeadTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_Rank" name="o<?php echo $HeadTypes_list->RowIndex ?>_Rank" id="o<?php echo $HeadTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HeadTypes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($HeadTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_Rank" class="form-group">
<input type="text" data-table="HeadTypes" data-field="x_Rank" name="x<?php echo $HeadTypes_list->RowIndex ?>_Rank" id="x<?php echo $HeadTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HeadTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->Rank->EditValue ?>"<?php echo $HeadTypes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($HeadTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_Rank">
<span<?php echo $HeadTypes_list->Rank->viewAttributes() ?>><?php echo $HeadTypes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $HeadTypes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($HeadTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($HeadTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HeadTypes" data-field="x_ActiveFlag" name="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]_902536" value="1"<?php echo $selwrk ?><?php echo $HeadTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]_902536"></label>
</div>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_ActiveFlag" name="o<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HeadTypes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($HeadTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($HeadTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HeadTypes" data-field="x_ActiveFlag" name="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]_532059" value="1"<?php echo $selwrk ?><?php echo $HeadTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]_532059"></label>
</div>
</span>
<?php } ?>
<?php if ($HeadTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HeadTypes_list->RowCount ?>_HeadTypes_ActiveFlag">
<span<?php echo $HeadTypes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HeadTypes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HeadTypes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$HeadTypes_list->ListOptions->render("body", "right", $HeadTypes_list->RowCount);
?>
	</tr>
<?php if ($HeadTypes->RowType == ROWTYPE_ADD || $HeadTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fHeadTypeslist", "load"], function() {
	fHeadTypeslist.updateLists(<?php echo $HeadTypes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$HeadTypes_list->isGridAdd())
		if (!$HeadTypes_list->Recordset->EOF)
			$HeadTypes_list->Recordset->moveNext();
}
?>
<?php
	if ($HeadTypes_list->isGridAdd() || $HeadTypes_list->isGridEdit()) {
		$HeadTypes_list->RowIndex = '$rowindex$';
		$HeadTypes_list->loadRowValues();

		// Set row properties
		$HeadTypes->resetAttributes();
		$HeadTypes->RowAttrs->merge(["data-rowindex" => $HeadTypes_list->RowIndex, "id" => "r0_HeadTypes", "data-rowtype" => ROWTYPE_ADD]);
		$HeadTypes->RowAttrs->appendClass("ew-template");
		$HeadTypes->RowType = ROWTYPE_ADD;

		// Render row
		$HeadTypes_list->renderRow();

		// Render list options
		$HeadTypes_list->renderListOptions();
		$HeadTypes_list->StartRowCount = 0;
?>
	<tr <?php echo $HeadTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HeadTypes_list->ListOptions->render("body", "left", $HeadTypes_list->RowIndex);
?>
	<?php if ($HeadTypes_list->HeadType_Idn->Visible) { // HeadType_Idn ?>
		<td data-name="HeadType_Idn">
<span id="el$rowindex$_HeadTypes_HeadType_Idn" class="form-group HeadTypes_HeadType_Idn"></span>
<input type="hidden" data-table="HeadTypes" data-field="x_HeadType_Idn" name="o<?php echo $HeadTypes_list->RowIndex ?>_HeadType_Idn" id="o<?php echo $HeadTypes_list->RowIndex ?>_HeadType_Idn" value="<?php echo HtmlEncode($HeadTypes_list->HeadType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_HeadTypes_Name" class="form-group HeadTypes_Name">
<input type="text" data-table="HeadTypes" data-field="x_Name" name="x<?php echo $HeadTypes_list->RowIndex ?>_Name" id="x<?php echo $HeadTypes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HeadTypes_list->Name->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->Name->EditValue ?>"<?php echo $HeadTypes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_Name" name="o<?php echo $HeadTypes_list->RowIndex ?>_Name" id="o<?php echo $HeadTypes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($HeadTypes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el$rowindex$_HeadTypes_ShortName" class="form-group HeadTypes_ShortName">
<input type="text" data-table="HeadTypes" data-field="x_ShortName" name="x<?php echo $HeadTypes_list->RowIndex ?>_ShortName" id="x<?php echo $HeadTypes_list->RowIndex ?>_ShortName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($HeadTypes_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->ShortName->EditValue ?>"<?php echo $HeadTypes_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_ShortName" name="o<?php echo $HeadTypes_list->RowIndex ?>_ShortName" id="o<?php echo $HeadTypes_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($HeadTypes_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_HeadTypes_Rank" class="form-group HeadTypes_Rank">
<input type="text" data-table="HeadTypes" data-field="x_Rank" name="x<?php echo $HeadTypes_list->RowIndex ?>_Rank" id="x<?php echo $HeadTypes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HeadTypes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $HeadTypes_list->Rank->EditValue ?>"<?php echo $HeadTypes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_Rank" name="o<?php echo $HeadTypes_list->RowIndex ?>_Rank" id="o<?php echo $HeadTypes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HeadTypes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HeadTypes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_HeadTypes_ActiveFlag" class="form-group HeadTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($HeadTypes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HeadTypes" data-field="x_ActiveFlag" name="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]_124577" value="1"<?php echo $selwrk ?><?php echo $HeadTypes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]_124577"></label>
</div>
</span>
<input type="hidden" data-table="HeadTypes" data-field="x_ActiveFlag" name="o<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HeadTypes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HeadTypes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$HeadTypes_list->ListOptions->render("body", "right", $HeadTypes_list->RowIndex);
?>
<script>
loadjs.ready(["fHeadTypeslist", "load"], function() {
	fHeadTypeslist.updateLists(<?php echo $HeadTypes_list->RowIndex ?>);
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
<?php if ($HeadTypes_list->isAdd() || $HeadTypes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $HeadTypes_list->FormKeyCountName ?>" id="<?php echo $HeadTypes_list->FormKeyCountName ?>" value="<?php echo $HeadTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($HeadTypes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $HeadTypes_list->FormKeyCountName ?>" id="<?php echo $HeadTypes_list->FormKeyCountName ?>" value="<?php echo $HeadTypes_list->KeyCount ?>">
<?php echo $HeadTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($HeadTypes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $HeadTypes_list->FormKeyCountName ?>" id="<?php echo $HeadTypes_list->FormKeyCountName ?>" value="<?php echo $HeadTypes_list->KeyCount ?>">
<?php } ?>
<?php if ($HeadTypes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $HeadTypes_list->FormKeyCountName ?>" id="<?php echo $HeadTypes_list->FormKeyCountName ?>" value="<?php echo $HeadTypes_list->KeyCount ?>">
<?php echo $HeadTypes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$HeadTypes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($HeadTypes_list->Recordset)
	$HeadTypes_list->Recordset->Close();
?>
<?php if (!$HeadTypes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$HeadTypes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $HeadTypes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $HeadTypes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($HeadTypes_list->TotalRecords == 0 && !$HeadTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $HeadTypes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$HeadTypes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$HeadTypes_list->isExport()) { ?>
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
$HeadTypes_list->terminate();
?>