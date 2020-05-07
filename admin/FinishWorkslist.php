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
$FinishWorks_list = new FinishWorks_list();

// Run the page
$FinishWorks_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FinishWorks_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$FinishWorks_list->isExport()) { ?>
<script>
var fFinishWorkslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fFinishWorkslist = currentForm = new ew.Form("fFinishWorkslist", "list");
	fFinishWorkslist.formKeyCountName = '<?php echo $FinishWorks_list->FormKeyCountName ?>';

	// Validate form
	fFinishWorkslist.validate = function() {
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
			<?php if ($FinishWorks_list->FinishWork_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FinishWork_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishWorks_list->FinishWork_Idn->caption(), $FinishWorks_list->FinishWork_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FinishWorks_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishWorks_list->Name->caption(), $FinishWorks_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FinishWorks_list->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishWorks_list->Value->caption(), $FinishWorks_list->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($FinishWorks_list->Value->errorMessage()) ?>");
			<?php if ($FinishWorks_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishWorks_list->Rank->caption(), $FinishWorks_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($FinishWorks_list->Rank->errorMessage()) ?>");
			<?php if ($FinishWorks_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FinishWorks_list->ActiveFlag->caption(), $FinishWorks_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fFinishWorkslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Value", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fFinishWorkslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fFinishWorkslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fFinishWorkslist.lists["x_ActiveFlag[]"] = <?php echo $FinishWorks_list->ActiveFlag->Lookup->toClientList($FinishWorks_list) ?>;
	fFinishWorkslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($FinishWorks_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fFinishWorkslist");
});
var fFinishWorkslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fFinishWorkslistsrch = currentSearchForm = new ew.Form("fFinishWorkslistsrch");

	// Dynamic selection lists
	// Filters

	fFinishWorkslistsrch.filterList = <?php echo $FinishWorks_list->getFilterList() ?>;
	loadjs.done("fFinishWorkslistsrch");
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
<?php if (!$FinishWorks_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($FinishWorks_list->TotalRecords > 0 && $FinishWorks_list->ExportOptions->visible()) { ?>
<?php $FinishWorks_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($FinishWorks_list->ImportOptions->visible()) { ?>
<?php $FinishWorks_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($FinishWorks_list->SearchOptions->visible()) { ?>
<?php $FinishWorks_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($FinishWorks_list->FilterOptions->visible()) { ?>
<?php $FinishWorks_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$FinishWorks_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$FinishWorks_list->isExport() && !$FinishWorks->CurrentAction) { ?>
<form name="fFinishWorkslistsrch" id="fFinishWorkslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fFinishWorkslistsrch-search-panel" class="<?php echo $FinishWorks_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="FinishWorks">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $FinishWorks_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($FinishWorks_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($FinishWorks_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $FinishWorks_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($FinishWorks_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($FinishWorks_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($FinishWorks_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($FinishWorks_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $FinishWorks_list->showPageHeader(); ?>
<?php
$FinishWorks_list->showMessage();
?>
<?php if ($FinishWorks_list->TotalRecords > 0 || $FinishWorks->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($FinishWorks_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> FinishWorks">
<?php if (!$FinishWorks_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$FinishWorks_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FinishWorks_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $FinishWorks_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fFinishWorkslist" id="fFinishWorkslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FinishWorks">
<div id="gmp_FinishWorks" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($FinishWorks_list->TotalRecords > 0 || $FinishWorks_list->isAdd() || $FinishWorks_list->isCopy() || $FinishWorks_list->isGridEdit()) { ?>
<table id="tbl_FinishWorkslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$FinishWorks->RowType = ROWTYPE_HEADER;

// Render list options
$FinishWorks_list->renderListOptions();

// Render list options (header, left)
$FinishWorks_list->ListOptions->render("header", "left");
?>
<?php if ($FinishWorks_list->FinishWork_Idn->Visible) { // FinishWork_Idn ?>
	<?php if ($FinishWorks_list->SortUrl($FinishWorks_list->FinishWork_Idn) == "") { ?>
		<th data-name="FinishWork_Idn" class="<?php echo $FinishWorks_list->FinishWork_Idn->headerCellClass() ?>"><div id="elh_FinishWorks_FinishWork_Idn" class="FinishWorks_FinishWork_Idn"><div class="ew-table-header-caption"><?php echo $FinishWorks_list->FinishWork_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinishWork_Idn" class="<?php echo $FinishWorks_list->FinishWork_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FinishWorks_list->SortUrl($FinishWorks_list->FinishWork_Idn) ?>', 1);"><div id="elh_FinishWorks_FinishWork_Idn" class="FinishWorks_FinishWork_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FinishWorks_list->FinishWork_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($FinishWorks_list->FinishWork_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FinishWorks_list->FinishWork_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FinishWorks_list->Name->Visible) { // Name ?>
	<?php if ($FinishWorks_list->SortUrl($FinishWorks_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $FinishWorks_list->Name->headerCellClass() ?>"><div id="elh_FinishWorks_Name" class="FinishWorks_Name"><div class="ew-table-header-caption"><?php echo $FinishWorks_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $FinishWorks_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FinishWorks_list->SortUrl($FinishWorks_list->Name) ?>', 1);"><div id="elh_FinishWorks_Name" class="FinishWorks_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FinishWorks_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($FinishWorks_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FinishWorks_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FinishWorks_list->Value->Visible) { // Value ?>
	<?php if ($FinishWorks_list->SortUrl($FinishWorks_list->Value) == "") { ?>
		<th data-name="Value" class="<?php echo $FinishWorks_list->Value->headerCellClass() ?>"><div id="elh_FinishWorks_Value" class="FinishWorks_Value"><div class="ew-table-header-caption"><?php echo $FinishWorks_list->Value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Value" class="<?php echo $FinishWorks_list->Value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FinishWorks_list->SortUrl($FinishWorks_list->Value) ?>', 1);"><div id="elh_FinishWorks_Value" class="FinishWorks_Value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FinishWorks_list->Value->caption() ?></span><span class="ew-table-header-sort"><?php if ($FinishWorks_list->Value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FinishWorks_list->Value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FinishWorks_list->Rank->Visible) { // Rank ?>
	<?php if ($FinishWorks_list->SortUrl($FinishWorks_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $FinishWorks_list->Rank->headerCellClass() ?>"><div id="elh_FinishWorks_Rank" class="FinishWorks_Rank"><div class="ew-table-header-caption"><?php echo $FinishWorks_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $FinishWorks_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FinishWorks_list->SortUrl($FinishWorks_list->Rank) ?>', 1);"><div id="elh_FinishWorks_Rank" class="FinishWorks_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FinishWorks_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($FinishWorks_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FinishWorks_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FinishWorks_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($FinishWorks_list->SortUrl($FinishWorks_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $FinishWorks_list->ActiveFlag->headerCellClass() ?>"><div id="elh_FinishWorks_ActiveFlag" class="FinishWorks_ActiveFlag"><div class="ew-table-header-caption"><?php echo $FinishWorks_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $FinishWorks_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FinishWorks_list->SortUrl($FinishWorks_list->ActiveFlag) ?>', 1);"><div id="elh_FinishWorks_ActiveFlag" class="FinishWorks_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FinishWorks_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($FinishWorks_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FinishWorks_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$FinishWorks_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($FinishWorks_list->isAdd() || $FinishWorks_list->isCopy()) {
		$FinishWorks_list->RowIndex = 0;
		$FinishWorks_list->KeyCount = $FinishWorks_list->RowIndex;
		if ($FinishWorks_list->isCopy() && !$FinishWorks_list->loadRow())
			$FinishWorks->CurrentAction = "add";
		if ($FinishWorks_list->isAdd())
			$FinishWorks_list->loadRowValues();
		if ($FinishWorks->EventCancelled) // Insert failed
			$FinishWorks_list->restoreFormValues(); // Restore form values

		// Set row properties
		$FinishWorks->resetAttributes();
		$FinishWorks->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_FinishWorks", "data-rowtype" => ROWTYPE_ADD]);
		$FinishWorks->RowType = ROWTYPE_ADD;

		// Render row
		$FinishWorks_list->renderRow();

		// Render list options
		$FinishWorks_list->renderListOptions();
		$FinishWorks_list->StartRowCount = 0;
?>
	<tr <?php echo $FinishWorks->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FinishWorks_list->ListOptions->render("body", "left", $FinishWorks_list->RowCount);
?>
	<?php if ($FinishWorks_list->FinishWork_Idn->Visible) { // FinishWork_Idn ?>
		<td data-name="FinishWork_Idn">
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_FinishWork_Idn" class="form-group FinishWorks_FinishWork_Idn"></span>
<input type="hidden" data-table="FinishWorks" data-field="x_FinishWork_Idn" name="o<?php echo $FinishWorks_list->RowIndex ?>_FinishWork_Idn" id="o<?php echo $FinishWorks_list->RowIndex ?>_FinishWork_Idn" value="<?php echo HtmlEncode($FinishWorks_list->FinishWork_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Name" class="form-group FinishWorks_Name">
<input type="text" data-table="FinishWorks" data-field="x_Name" name="x<?php echo $FinishWorks_list->RowIndex ?>_Name" id="x<?php echo $FinishWorks_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FinishWorks_list->Name->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Name->EditValue ?>"<?php echo $FinishWorks_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_Name" name="o<?php echo $FinishWorks_list->RowIndex ?>_Name" id="o<?php echo $FinishWorks_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FinishWorks_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Value" class="form-group FinishWorks_Value">
<input type="text" data-table="FinishWorks" data-field="x_Value" name="x<?php echo $FinishWorks_list->RowIndex ?>_Value" id="x<?php echo $FinishWorks_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($FinishWorks_list->Value->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Value->EditValue ?>"<?php echo $FinishWorks_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_Value" name="o<?php echo $FinishWorks_list->RowIndex ?>_Value" id="o<?php echo $FinishWorks_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($FinishWorks_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Rank" class="form-group FinishWorks_Rank">
<input type="text" data-table="FinishWorks" data-field="x_Rank" name="x<?php echo $FinishWorks_list->RowIndex ?>_Rank" id="x<?php echo $FinishWorks_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FinishWorks_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Rank->EditValue ?>"<?php echo $FinishWorks_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_Rank" name="o<?php echo $FinishWorks_list->RowIndex ?>_Rank" id="o<?php echo $FinishWorks_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FinishWorks_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_ActiveFlag" class="form-group FinishWorks_ActiveFlag">
<?php
$selwrk = ConvertToBool($FinishWorks_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FinishWorks" data-field="x_ActiveFlag" name="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]_363865" value="1"<?php echo $selwrk ?><?php echo $FinishWorks_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]_363865"></label>
</div>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_ActiveFlag" name="o<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FinishWorks_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FinishWorks_list->ListOptions->render("body", "right", $FinishWorks_list->RowCount);
?>
<script>
loadjs.ready(["fFinishWorkslist", "load"], function() {
	fFinishWorkslist.updateLists(<?php echo $FinishWorks_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($FinishWorks_list->ExportAll && $FinishWorks_list->isExport()) {
	$FinishWorks_list->StopRecord = $FinishWorks_list->TotalRecords;
} else {

	// Set the last record to display
	if ($FinishWorks_list->TotalRecords > $FinishWorks_list->StartRecord + $FinishWorks_list->DisplayRecords - 1)
		$FinishWorks_list->StopRecord = $FinishWorks_list->StartRecord + $FinishWorks_list->DisplayRecords - 1;
	else
		$FinishWorks_list->StopRecord = $FinishWorks_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($FinishWorks->isConfirm() || $FinishWorks_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($FinishWorks_list->FormKeyCountName) && ($FinishWorks_list->isGridAdd() || $FinishWorks_list->isGridEdit() || $FinishWorks->isConfirm())) {
		$FinishWorks_list->KeyCount = $CurrentForm->getValue($FinishWorks_list->FormKeyCountName);
		$FinishWorks_list->StopRecord = $FinishWorks_list->StartRecord + $FinishWorks_list->KeyCount - 1;
	}
}
$FinishWorks_list->RecordCount = $FinishWorks_list->StartRecord - 1;
if ($FinishWorks_list->Recordset && !$FinishWorks_list->Recordset->EOF) {
	$FinishWorks_list->Recordset->moveFirst();
	$selectLimit = $FinishWorks_list->UseSelectLimit;
	if (!$selectLimit && $FinishWorks_list->StartRecord > 1)
		$FinishWorks_list->Recordset->move($FinishWorks_list->StartRecord - 1);
} elseif (!$FinishWorks->AllowAddDeleteRow && $FinishWorks_list->StopRecord == 0) {
	$FinishWorks_list->StopRecord = $FinishWorks->GridAddRowCount;
}

// Initialize aggregate
$FinishWorks->RowType = ROWTYPE_AGGREGATEINIT;
$FinishWorks->resetAttributes();
$FinishWorks_list->renderRow();
$FinishWorks_list->EditRowCount = 0;
if ($FinishWorks_list->isEdit())
	$FinishWorks_list->RowIndex = 1;
if ($FinishWorks_list->isGridAdd())
	$FinishWorks_list->RowIndex = 0;
if ($FinishWorks_list->isGridEdit())
	$FinishWorks_list->RowIndex = 0;
while ($FinishWorks_list->RecordCount < $FinishWorks_list->StopRecord) {
	$FinishWorks_list->RecordCount++;
	if ($FinishWorks_list->RecordCount >= $FinishWorks_list->StartRecord) {
		$FinishWorks_list->RowCount++;
		if ($FinishWorks_list->isGridAdd() || $FinishWorks_list->isGridEdit() || $FinishWorks->isConfirm()) {
			$FinishWorks_list->RowIndex++;
			$CurrentForm->Index = $FinishWorks_list->RowIndex;
			if ($CurrentForm->hasValue($FinishWorks_list->FormActionName) && ($FinishWorks->isConfirm() || $FinishWorks_list->EventCancelled))
				$FinishWorks_list->RowAction = strval($CurrentForm->getValue($FinishWorks_list->FormActionName));
			elseif ($FinishWorks_list->isGridAdd())
				$FinishWorks_list->RowAction = "insert";
			else
				$FinishWorks_list->RowAction = "";
		}

		// Set up key count
		$FinishWorks_list->KeyCount = $FinishWorks_list->RowIndex;

		// Init row class and style
		$FinishWorks->resetAttributes();
		$FinishWorks->CssClass = "";
		if ($FinishWorks_list->isGridAdd()) {
			$FinishWorks_list->loadRowValues(); // Load default values
		} else {
			$FinishWorks_list->loadRowValues($FinishWorks_list->Recordset); // Load row values
		}
		$FinishWorks->RowType = ROWTYPE_VIEW; // Render view
		if ($FinishWorks_list->isGridAdd()) // Grid add
			$FinishWorks->RowType = ROWTYPE_ADD; // Render add
		if ($FinishWorks_list->isGridAdd() && $FinishWorks->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$FinishWorks_list->restoreCurrentRowFormValues($FinishWorks_list->RowIndex); // Restore form values
		if ($FinishWorks_list->isEdit()) {
			if ($FinishWorks_list->checkInlineEditKey() && $FinishWorks_list->EditRowCount == 0) { // Inline edit
				$FinishWorks->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($FinishWorks_list->isGridEdit()) { // Grid edit
			if ($FinishWorks->EventCancelled)
				$FinishWorks_list->restoreCurrentRowFormValues($FinishWorks_list->RowIndex); // Restore form values
			if ($FinishWorks_list->RowAction == "insert")
				$FinishWorks->RowType = ROWTYPE_ADD; // Render add
			else
				$FinishWorks->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($FinishWorks_list->isEdit() && $FinishWorks->RowType == ROWTYPE_EDIT && $FinishWorks->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$FinishWorks_list->restoreFormValues(); // Restore form values
		}
		if ($FinishWorks_list->isGridEdit() && ($FinishWorks->RowType == ROWTYPE_EDIT || $FinishWorks->RowType == ROWTYPE_ADD) && $FinishWorks->EventCancelled) // Update failed
			$FinishWorks_list->restoreCurrentRowFormValues($FinishWorks_list->RowIndex); // Restore form values
		if ($FinishWorks->RowType == ROWTYPE_EDIT) // Edit row
			$FinishWorks_list->EditRowCount++;

		// Set up row id / data-rowindex
		$FinishWorks->RowAttrs->merge(["data-rowindex" => $FinishWorks_list->RowCount, "id" => "r" . $FinishWorks_list->RowCount . "_FinishWorks", "data-rowtype" => $FinishWorks->RowType]);

		// Render row
		$FinishWorks_list->renderRow();

		// Render list options
		$FinishWorks_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($FinishWorks_list->RowAction != "delete" && $FinishWorks_list->RowAction != "insertdelete" && !($FinishWorks_list->RowAction == "insert" && $FinishWorks->isConfirm() && $FinishWorks_list->emptyRow())) {
?>
	<tr <?php echo $FinishWorks->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FinishWorks_list->ListOptions->render("body", "left", $FinishWorks_list->RowCount);
?>
	<?php if ($FinishWorks_list->FinishWork_Idn->Visible) { // FinishWork_Idn ?>
		<td data-name="FinishWork_Idn" <?php echo $FinishWorks_list->FinishWork_Idn->cellAttributes() ?>>
<?php if ($FinishWorks->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_FinishWork_Idn" class="form-group"></span>
<input type="hidden" data-table="FinishWorks" data-field="x_FinishWork_Idn" name="o<?php echo $FinishWorks_list->RowIndex ?>_FinishWork_Idn" id="o<?php echo $FinishWorks_list->RowIndex ?>_FinishWork_Idn" value="<?php echo HtmlEncode($FinishWorks_list->FinishWork_Idn->OldValue) ?>">
<?php } ?>
<?php if ($FinishWorks->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_FinishWork_Idn" class="form-group">
<span<?php echo $FinishWorks_list->FinishWork_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($FinishWorks_list->FinishWork_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_FinishWork_Idn" name="x<?php echo $FinishWorks_list->RowIndex ?>_FinishWork_Idn" id="x<?php echo $FinishWorks_list->RowIndex ?>_FinishWork_Idn" value="<?php echo HtmlEncode($FinishWorks_list->FinishWork_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($FinishWorks->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_FinishWork_Idn">
<span<?php echo $FinishWorks_list->FinishWork_Idn->viewAttributes() ?>><?php echo $FinishWorks_list->FinishWork_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $FinishWorks_list->Name->cellAttributes() ?>>
<?php if ($FinishWorks->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Name" class="form-group">
<input type="text" data-table="FinishWorks" data-field="x_Name" name="x<?php echo $FinishWorks_list->RowIndex ?>_Name" id="x<?php echo $FinishWorks_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FinishWorks_list->Name->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Name->EditValue ?>"<?php echo $FinishWorks_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_Name" name="o<?php echo $FinishWorks_list->RowIndex ?>_Name" id="o<?php echo $FinishWorks_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FinishWorks_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($FinishWorks->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Name" class="form-group">
<input type="text" data-table="FinishWorks" data-field="x_Name" name="x<?php echo $FinishWorks_list->RowIndex ?>_Name" id="x<?php echo $FinishWorks_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FinishWorks_list->Name->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Name->EditValue ?>"<?php echo $FinishWorks_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FinishWorks->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Name">
<span<?php echo $FinishWorks_list->Name->viewAttributes() ?>><?php echo $FinishWorks_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->Value->Visible) { // Value ?>
		<td data-name="Value" <?php echo $FinishWorks_list->Value->cellAttributes() ?>>
<?php if ($FinishWorks->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Value" class="form-group">
<input type="text" data-table="FinishWorks" data-field="x_Value" name="x<?php echo $FinishWorks_list->RowIndex ?>_Value" id="x<?php echo $FinishWorks_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($FinishWorks_list->Value->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Value->EditValue ?>"<?php echo $FinishWorks_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_Value" name="o<?php echo $FinishWorks_list->RowIndex ?>_Value" id="o<?php echo $FinishWorks_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($FinishWorks_list->Value->OldValue) ?>">
<?php } ?>
<?php if ($FinishWorks->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Value" class="form-group">
<input type="text" data-table="FinishWorks" data-field="x_Value" name="x<?php echo $FinishWorks_list->RowIndex ?>_Value" id="x<?php echo $FinishWorks_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($FinishWorks_list->Value->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Value->EditValue ?>"<?php echo $FinishWorks_list->Value->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FinishWorks->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Value">
<span<?php echo $FinishWorks_list->Value->viewAttributes() ?>><?php echo $FinishWorks_list->Value->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $FinishWorks_list->Rank->cellAttributes() ?>>
<?php if ($FinishWorks->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Rank" class="form-group">
<input type="text" data-table="FinishWorks" data-field="x_Rank" name="x<?php echo $FinishWorks_list->RowIndex ?>_Rank" id="x<?php echo $FinishWorks_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FinishWorks_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Rank->EditValue ?>"<?php echo $FinishWorks_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_Rank" name="o<?php echo $FinishWorks_list->RowIndex ?>_Rank" id="o<?php echo $FinishWorks_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FinishWorks_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($FinishWorks->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Rank" class="form-group">
<input type="text" data-table="FinishWorks" data-field="x_Rank" name="x<?php echo $FinishWorks_list->RowIndex ?>_Rank" id="x<?php echo $FinishWorks_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FinishWorks_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Rank->EditValue ?>"<?php echo $FinishWorks_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FinishWorks->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_Rank">
<span<?php echo $FinishWorks_list->Rank->viewAttributes() ?>><?php echo $FinishWorks_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $FinishWorks_list->ActiveFlag->cellAttributes() ?>>
<?php if ($FinishWorks->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FinishWorks_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FinishWorks" data-field="x_ActiveFlag" name="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]_783399" value="1"<?php echo $selwrk ?><?php echo $FinishWorks_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]_783399"></label>
</div>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_ActiveFlag" name="o<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FinishWorks_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($FinishWorks->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FinishWorks_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FinishWorks" data-field="x_ActiveFlag" name="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]_326410" value="1"<?php echo $selwrk ?><?php echo $FinishWorks_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]_326410"></label>
</div>
</span>
<?php } ?>
<?php if ($FinishWorks->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FinishWorks_list->RowCount ?>_FinishWorks_ActiveFlag">
<span<?php echo $FinishWorks_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FinishWorks_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FinishWorks_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FinishWorks_list->ListOptions->render("body", "right", $FinishWorks_list->RowCount);
?>
	</tr>
<?php if ($FinishWorks->RowType == ROWTYPE_ADD || $FinishWorks->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fFinishWorkslist", "load"], function() {
	fFinishWorkslist.updateLists(<?php echo $FinishWorks_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$FinishWorks_list->isGridAdd())
		if (!$FinishWorks_list->Recordset->EOF)
			$FinishWorks_list->Recordset->moveNext();
}
?>
<?php
	if ($FinishWorks_list->isGridAdd() || $FinishWorks_list->isGridEdit()) {
		$FinishWorks_list->RowIndex = '$rowindex$';
		$FinishWorks_list->loadRowValues();

		// Set row properties
		$FinishWorks->resetAttributes();
		$FinishWorks->RowAttrs->merge(["data-rowindex" => $FinishWorks_list->RowIndex, "id" => "r0_FinishWorks", "data-rowtype" => ROWTYPE_ADD]);
		$FinishWorks->RowAttrs->appendClass("ew-template");
		$FinishWorks->RowType = ROWTYPE_ADD;

		// Render row
		$FinishWorks_list->renderRow();

		// Render list options
		$FinishWorks_list->renderListOptions();
		$FinishWorks_list->StartRowCount = 0;
?>
	<tr <?php echo $FinishWorks->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FinishWorks_list->ListOptions->render("body", "left", $FinishWorks_list->RowIndex);
?>
	<?php if ($FinishWorks_list->FinishWork_Idn->Visible) { // FinishWork_Idn ?>
		<td data-name="FinishWork_Idn">
<span id="el$rowindex$_FinishWorks_FinishWork_Idn" class="form-group FinishWorks_FinishWork_Idn"></span>
<input type="hidden" data-table="FinishWorks" data-field="x_FinishWork_Idn" name="o<?php echo $FinishWorks_list->RowIndex ?>_FinishWork_Idn" id="o<?php echo $FinishWorks_list->RowIndex ?>_FinishWork_Idn" value="<?php echo HtmlEncode($FinishWorks_list->FinishWork_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_FinishWorks_Name" class="form-group FinishWorks_Name">
<input type="text" data-table="FinishWorks" data-field="x_Name" name="x<?php echo $FinishWorks_list->RowIndex ?>_Name" id="x<?php echo $FinishWorks_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FinishWorks_list->Name->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Name->EditValue ?>"<?php echo $FinishWorks_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_Name" name="o<?php echo $FinishWorks_list->RowIndex ?>_Name" id="o<?php echo $FinishWorks_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FinishWorks_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el$rowindex$_FinishWorks_Value" class="form-group FinishWorks_Value">
<input type="text" data-table="FinishWorks" data-field="x_Value" name="x<?php echo $FinishWorks_list->RowIndex ?>_Value" id="x<?php echo $FinishWorks_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($FinishWorks_list->Value->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Value->EditValue ?>"<?php echo $FinishWorks_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_Value" name="o<?php echo $FinishWorks_list->RowIndex ?>_Value" id="o<?php echo $FinishWorks_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($FinishWorks_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_FinishWorks_Rank" class="form-group FinishWorks_Rank">
<input type="text" data-table="FinishWorks" data-field="x_Rank" name="x<?php echo $FinishWorks_list->RowIndex ?>_Rank" id="x<?php echo $FinishWorks_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FinishWorks_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FinishWorks_list->Rank->EditValue ?>"<?php echo $FinishWorks_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_Rank" name="o<?php echo $FinishWorks_list->RowIndex ?>_Rank" id="o<?php echo $FinishWorks_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FinishWorks_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FinishWorks_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_FinishWorks_ActiveFlag" class="form-group FinishWorks_ActiveFlag">
<?php
$selwrk = ConvertToBool($FinishWorks_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FinishWorks" data-field="x_ActiveFlag" name="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]_248360" value="1"<?php echo $selwrk ?><?php echo $FinishWorks_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]_248360"></label>
</div>
</span>
<input type="hidden" data-table="FinishWorks" data-field="x_ActiveFlag" name="o<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FinishWorks_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FinishWorks_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FinishWorks_list->ListOptions->render("body", "right", $FinishWorks_list->RowIndex);
?>
<script>
loadjs.ready(["fFinishWorkslist", "load"], function() {
	fFinishWorkslist.updateLists(<?php echo $FinishWorks_list->RowIndex ?>);
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
<?php if ($FinishWorks_list->isAdd() || $FinishWorks_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $FinishWorks_list->FormKeyCountName ?>" id="<?php echo $FinishWorks_list->FormKeyCountName ?>" value="<?php echo $FinishWorks_list->KeyCount ?>">
<?php } ?>
<?php if ($FinishWorks_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $FinishWorks_list->FormKeyCountName ?>" id="<?php echo $FinishWorks_list->FormKeyCountName ?>" value="<?php echo $FinishWorks_list->KeyCount ?>">
<?php echo $FinishWorks_list->MultiSelectKey ?>
<?php } ?>
<?php if ($FinishWorks_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $FinishWorks_list->FormKeyCountName ?>" id="<?php echo $FinishWorks_list->FormKeyCountName ?>" value="<?php echo $FinishWorks_list->KeyCount ?>">
<?php } ?>
<?php if ($FinishWorks_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $FinishWorks_list->FormKeyCountName ?>" id="<?php echo $FinishWorks_list->FormKeyCountName ?>" value="<?php echo $FinishWorks_list->KeyCount ?>">
<?php echo $FinishWorks_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$FinishWorks->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($FinishWorks_list->Recordset)
	$FinishWorks_list->Recordset->Close();
?>
<?php if (!$FinishWorks_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$FinishWorks_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FinishWorks_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $FinishWorks_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($FinishWorks_list->TotalRecords == 0 && !$FinishWorks->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $FinishWorks_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$FinishWorks_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$FinishWorks_list->isExport()) { ?>
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
$FinishWorks_list->terminate();
?>