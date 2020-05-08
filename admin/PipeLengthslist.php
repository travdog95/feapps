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
$PipeLengths_list = new PipeLengths_list();

// Run the page
$PipeLengths_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PipeLengths_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$PipeLengths_list->isExport()) { ?>
<script>
var fPipeLengthslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fPipeLengthslist = currentForm = new ew.Form("fPipeLengthslist", "list");
	fPipeLengthslist.formKeyCountName = '<?php echo $PipeLengths_list->FormKeyCountName ?>';

	// Validate form
	fPipeLengthslist.validate = function() {
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
			<?php if ($PipeLengths_list->PipeLength_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PipeLength_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeLengths_list->PipeLength_Idn->caption(), $PipeLengths_list->PipeLength_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeLengths_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeLengths_list->Name->caption(), $PipeLengths_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PipeLengths_list->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeLengths_list->Value->caption(), $PipeLengths_list->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PipeLengths_list->Value->errorMessage()) ?>");
			<?php if ($PipeLengths_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeLengths_list->Rank->caption(), $PipeLengths_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PipeLengths_list->Rank->errorMessage()) ?>");
			<?php if ($PipeLengths_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PipeLengths_list->ActiveFlag->caption(), $PipeLengths_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fPipeLengthslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Value", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fPipeLengthslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPipeLengthslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fPipeLengthslist.lists["x_ActiveFlag[]"] = <?php echo $PipeLengths_list->ActiveFlag->Lookup->toClientList($PipeLengths_list) ?>;
	fPipeLengthslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($PipeLengths_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fPipeLengthslist");
});
var fPipeLengthslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fPipeLengthslistsrch = currentSearchForm = new ew.Form("fPipeLengthslistsrch");

	// Dynamic selection lists
	// Filters

	fPipeLengthslistsrch.filterList = <?php echo $PipeLengths_list->getFilterList() ?>;
	loadjs.done("fPipeLengthslistsrch");
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
<?php if (!$PipeLengths_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($PipeLengths_list->TotalRecords > 0 && $PipeLengths_list->ExportOptions->visible()) { ?>
<?php $PipeLengths_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($PipeLengths_list->ImportOptions->visible()) { ?>
<?php $PipeLengths_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($PipeLengths_list->SearchOptions->visible()) { ?>
<?php $PipeLengths_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($PipeLengths_list->FilterOptions->visible()) { ?>
<?php $PipeLengths_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$PipeLengths_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$PipeLengths_list->isExport() && !$PipeLengths->CurrentAction) { ?>
<form name="fPipeLengthslistsrch" id="fPipeLengthslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fPipeLengthslistsrch-search-panel" class="<?php echo $PipeLengths_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="PipeLengths">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $PipeLengths_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($PipeLengths_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($PipeLengths_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $PipeLengths_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($PipeLengths_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($PipeLengths_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($PipeLengths_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($PipeLengths_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $PipeLengths_list->showPageHeader(); ?>
<?php
$PipeLengths_list->showMessage();
?>
<?php if ($PipeLengths_list->TotalRecords > 0 || $PipeLengths->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($PipeLengths_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> PipeLengths">
<?php if (!$PipeLengths_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$PipeLengths_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PipeLengths_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $PipeLengths_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fPipeLengthslist" id="fPipeLengthslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PipeLengths">
<div id="gmp_PipeLengths" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($PipeLengths_list->TotalRecords > 0 || $PipeLengths_list->isAdd() || $PipeLengths_list->isCopy() || $PipeLengths_list->isGridEdit()) { ?>
<table id="tbl_PipeLengthslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$PipeLengths->RowType = ROWTYPE_HEADER;

// Render list options
$PipeLengths_list->renderListOptions();

// Render list options (header, left)
$PipeLengths_list->ListOptions->render("header", "left");
?>
<?php if ($PipeLengths_list->PipeLength_Idn->Visible) { // PipeLength_Idn ?>
	<?php if ($PipeLengths_list->SortUrl($PipeLengths_list->PipeLength_Idn) == "") { ?>
		<th data-name="PipeLength_Idn" class="<?php echo $PipeLengths_list->PipeLength_Idn->headerCellClass() ?>"><div id="elh_PipeLengths_PipeLength_Idn" class="PipeLengths_PipeLength_Idn"><div class="ew-table-header-caption"><?php echo $PipeLengths_list->PipeLength_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PipeLength_Idn" class="<?php echo $PipeLengths_list->PipeLength_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeLengths_list->SortUrl($PipeLengths_list->PipeLength_Idn) ?>', 1);"><div id="elh_PipeLengths_PipeLength_Idn" class="PipeLengths_PipeLength_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeLengths_list->PipeLength_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeLengths_list->PipeLength_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeLengths_list->PipeLength_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeLengths_list->Name->Visible) { // Name ?>
	<?php if ($PipeLengths_list->SortUrl($PipeLengths_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $PipeLengths_list->Name->headerCellClass() ?>"><div id="elh_PipeLengths_Name" class="PipeLengths_Name"><div class="ew-table-header-caption"><?php echo $PipeLengths_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $PipeLengths_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeLengths_list->SortUrl($PipeLengths_list->Name) ?>', 1);"><div id="elh_PipeLengths_Name" class="PipeLengths_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeLengths_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PipeLengths_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeLengths_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeLengths_list->Value->Visible) { // Value ?>
	<?php if ($PipeLengths_list->SortUrl($PipeLengths_list->Value) == "") { ?>
		<th data-name="Value" class="<?php echo $PipeLengths_list->Value->headerCellClass() ?>"><div id="elh_PipeLengths_Value" class="PipeLengths_Value"><div class="ew-table-header-caption"><?php echo $PipeLengths_list->Value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Value" class="<?php echo $PipeLengths_list->Value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeLengths_list->SortUrl($PipeLengths_list->Value) ?>', 1);"><div id="elh_PipeLengths_Value" class="PipeLengths_Value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeLengths_list->Value->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeLengths_list->Value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeLengths_list->Value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeLengths_list->Rank->Visible) { // Rank ?>
	<?php if ($PipeLengths_list->SortUrl($PipeLengths_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $PipeLengths_list->Rank->headerCellClass() ?>"><div id="elh_PipeLengths_Rank" class="PipeLengths_Rank"><div class="ew-table-header-caption"><?php echo $PipeLengths_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $PipeLengths_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeLengths_list->SortUrl($PipeLengths_list->Rank) ?>', 1);"><div id="elh_PipeLengths_Rank" class="PipeLengths_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeLengths_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeLengths_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeLengths_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PipeLengths_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($PipeLengths_list->SortUrl($PipeLengths_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $PipeLengths_list->ActiveFlag->headerCellClass() ?>"><div id="elh_PipeLengths_ActiveFlag" class="PipeLengths_ActiveFlag"><div class="ew-table-header-caption"><?php echo $PipeLengths_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $PipeLengths_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PipeLengths_list->SortUrl($PipeLengths_list->ActiveFlag) ?>', 1);"><div id="elh_PipeLengths_ActiveFlag" class="PipeLengths_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PipeLengths_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($PipeLengths_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PipeLengths_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$PipeLengths_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($PipeLengths_list->isAdd() || $PipeLengths_list->isCopy()) {
		$PipeLengths_list->RowIndex = 0;
		$PipeLengths_list->KeyCount = $PipeLengths_list->RowIndex;
		if ($PipeLengths_list->isCopy() && !$PipeLengths_list->loadRow())
			$PipeLengths->CurrentAction = "add";
		if ($PipeLengths_list->isAdd())
			$PipeLengths_list->loadRowValues();
		if ($PipeLengths->EventCancelled) // Insert failed
			$PipeLengths_list->restoreFormValues(); // Restore form values

		// Set row properties
		$PipeLengths->resetAttributes();
		$PipeLengths->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_PipeLengths", "data-rowtype" => ROWTYPE_ADD]);
		$PipeLengths->RowType = ROWTYPE_ADD;

		// Render row
		$PipeLengths_list->renderRow();

		// Render list options
		$PipeLengths_list->renderListOptions();
		$PipeLengths_list->StartRowCount = 0;
?>
	<tr <?php echo $PipeLengths->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PipeLengths_list->ListOptions->render("body", "left", $PipeLengths_list->RowCount);
?>
	<?php if ($PipeLengths_list->PipeLength_Idn->Visible) { // PipeLength_Idn ?>
		<td data-name="PipeLength_Idn">
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_PipeLength_Idn" class="form-group PipeLengths_PipeLength_Idn"></span>
<input type="hidden" data-table="PipeLengths" data-field="x_PipeLength_Idn" name="o<?php echo $PipeLengths_list->RowIndex ?>_PipeLength_Idn" id="o<?php echo $PipeLengths_list->RowIndex ?>_PipeLength_Idn" value="<?php echo HtmlEncode($PipeLengths_list->PipeLength_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Name" class="form-group PipeLengths_Name">
<input type="text" data-table="PipeLengths" data-field="x_Name" name="x<?php echo $PipeLengths_list->RowIndex ?>_Name" id="x<?php echo $PipeLengths_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeLengths_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Name->EditValue ?>"<?php echo $PipeLengths_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_Name" name="o<?php echo $PipeLengths_list->RowIndex ?>_Name" id="o<?php echo $PipeLengths_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PipeLengths_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Value" class="form-group PipeLengths_Value">
<input type="text" data-table="PipeLengths" data-field="x_Value" name="x<?php echo $PipeLengths_list->RowIndex ?>_Value" id="x<?php echo $PipeLengths_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PipeLengths_list->Value->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Value->EditValue ?>"<?php echo $PipeLengths_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_Value" name="o<?php echo $PipeLengths_list->RowIndex ?>_Value" id="o<?php echo $PipeLengths_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($PipeLengths_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Rank" class="form-group PipeLengths_Rank">
<input type="text" data-table="PipeLengths" data-field="x_Rank" name="x<?php echo $PipeLengths_list->RowIndex ?>_Rank" id="x<?php echo $PipeLengths_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeLengths_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Rank->EditValue ?>"<?php echo $PipeLengths_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_Rank" name="o<?php echo $PipeLengths_list->RowIndex ?>_Rank" id="o<?php echo $PipeLengths_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PipeLengths_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_ActiveFlag" class="form-group PipeLengths_ActiveFlag">
<?php
$selwrk = ConvertToBool($PipeLengths_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeLengths" data-field="x_ActiveFlag" name="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]_958121" value="1"<?php echo $selwrk ?><?php echo $PipeLengths_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]_958121"></label>
</div>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_ActiveFlag" name="o<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PipeLengths_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PipeLengths_list->ListOptions->render("body", "right", $PipeLengths_list->RowCount);
?>
<script>
loadjs.ready(["fPipeLengthslist", "load"], function() {
	fPipeLengthslist.updateLists(<?php echo $PipeLengths_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($PipeLengths_list->ExportAll && $PipeLengths_list->isExport()) {
	$PipeLengths_list->StopRecord = $PipeLengths_list->TotalRecords;
} else {

	// Set the last record to display
	if ($PipeLengths_list->TotalRecords > $PipeLengths_list->StartRecord + $PipeLengths_list->DisplayRecords - 1)
		$PipeLengths_list->StopRecord = $PipeLengths_list->StartRecord + $PipeLengths_list->DisplayRecords - 1;
	else
		$PipeLengths_list->StopRecord = $PipeLengths_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($PipeLengths->isConfirm() || $PipeLengths_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($PipeLengths_list->FormKeyCountName) && ($PipeLengths_list->isGridAdd() || $PipeLengths_list->isGridEdit() || $PipeLengths->isConfirm())) {
		$PipeLengths_list->KeyCount = $CurrentForm->getValue($PipeLengths_list->FormKeyCountName);
		$PipeLengths_list->StopRecord = $PipeLengths_list->StartRecord + $PipeLengths_list->KeyCount - 1;
	}
}
$PipeLengths_list->RecordCount = $PipeLengths_list->StartRecord - 1;
if ($PipeLengths_list->Recordset && !$PipeLengths_list->Recordset->EOF) {
	$PipeLengths_list->Recordset->moveFirst();
	$selectLimit = $PipeLengths_list->UseSelectLimit;
	if (!$selectLimit && $PipeLengths_list->StartRecord > 1)
		$PipeLengths_list->Recordset->move($PipeLengths_list->StartRecord - 1);
} elseif (!$PipeLengths->AllowAddDeleteRow && $PipeLengths_list->StopRecord == 0) {
	$PipeLengths_list->StopRecord = $PipeLengths->GridAddRowCount;
}

// Initialize aggregate
$PipeLengths->RowType = ROWTYPE_AGGREGATEINIT;
$PipeLengths->resetAttributes();
$PipeLengths_list->renderRow();
$PipeLengths_list->EditRowCount = 0;
if ($PipeLengths_list->isEdit())
	$PipeLengths_list->RowIndex = 1;
if ($PipeLengths_list->isGridAdd())
	$PipeLengths_list->RowIndex = 0;
if ($PipeLengths_list->isGridEdit())
	$PipeLengths_list->RowIndex = 0;
while ($PipeLengths_list->RecordCount < $PipeLengths_list->StopRecord) {
	$PipeLengths_list->RecordCount++;
	if ($PipeLengths_list->RecordCount >= $PipeLengths_list->StartRecord) {
		$PipeLengths_list->RowCount++;
		if ($PipeLengths_list->isGridAdd() || $PipeLengths_list->isGridEdit() || $PipeLengths->isConfirm()) {
			$PipeLengths_list->RowIndex++;
			$CurrentForm->Index = $PipeLengths_list->RowIndex;
			if ($CurrentForm->hasValue($PipeLengths_list->FormActionName) && ($PipeLengths->isConfirm() || $PipeLengths_list->EventCancelled))
				$PipeLengths_list->RowAction = strval($CurrentForm->getValue($PipeLengths_list->FormActionName));
			elseif ($PipeLengths_list->isGridAdd())
				$PipeLengths_list->RowAction = "insert";
			else
				$PipeLengths_list->RowAction = "";
		}

		// Set up key count
		$PipeLengths_list->KeyCount = $PipeLengths_list->RowIndex;

		// Init row class and style
		$PipeLengths->resetAttributes();
		$PipeLengths->CssClass = "";
		if ($PipeLengths_list->isGridAdd()) {
			$PipeLengths_list->loadRowValues(); // Load default values
		} else {
			$PipeLengths_list->loadRowValues($PipeLengths_list->Recordset); // Load row values
		}
		$PipeLengths->RowType = ROWTYPE_VIEW; // Render view
		if ($PipeLengths_list->isGridAdd()) // Grid add
			$PipeLengths->RowType = ROWTYPE_ADD; // Render add
		if ($PipeLengths_list->isGridAdd() && $PipeLengths->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$PipeLengths_list->restoreCurrentRowFormValues($PipeLengths_list->RowIndex); // Restore form values
		if ($PipeLengths_list->isEdit()) {
			if ($PipeLengths_list->checkInlineEditKey() && $PipeLengths_list->EditRowCount == 0) { // Inline edit
				$PipeLengths->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($PipeLengths_list->isGridEdit()) { // Grid edit
			if ($PipeLengths->EventCancelled)
				$PipeLengths_list->restoreCurrentRowFormValues($PipeLengths_list->RowIndex); // Restore form values
			if ($PipeLengths_list->RowAction == "insert")
				$PipeLengths->RowType = ROWTYPE_ADD; // Render add
			else
				$PipeLengths->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($PipeLengths_list->isEdit() && $PipeLengths->RowType == ROWTYPE_EDIT && $PipeLengths->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$PipeLengths_list->restoreFormValues(); // Restore form values
		}
		if ($PipeLengths_list->isGridEdit() && ($PipeLengths->RowType == ROWTYPE_EDIT || $PipeLengths->RowType == ROWTYPE_ADD) && $PipeLengths->EventCancelled) // Update failed
			$PipeLengths_list->restoreCurrentRowFormValues($PipeLengths_list->RowIndex); // Restore form values
		if ($PipeLengths->RowType == ROWTYPE_EDIT) // Edit row
			$PipeLengths_list->EditRowCount++;

		// Set up row id / data-rowindex
		$PipeLengths->RowAttrs->merge(["data-rowindex" => $PipeLengths_list->RowCount, "id" => "r" . $PipeLengths_list->RowCount . "_PipeLengths", "data-rowtype" => $PipeLengths->RowType]);

		// Render row
		$PipeLengths_list->renderRow();

		// Render list options
		$PipeLengths_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($PipeLengths_list->RowAction != "delete" && $PipeLengths_list->RowAction != "insertdelete" && !($PipeLengths_list->RowAction == "insert" && $PipeLengths->isConfirm() && $PipeLengths_list->emptyRow())) {
?>
	<tr <?php echo $PipeLengths->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PipeLengths_list->ListOptions->render("body", "left", $PipeLengths_list->RowCount);
?>
	<?php if ($PipeLengths_list->PipeLength_Idn->Visible) { // PipeLength_Idn ?>
		<td data-name="PipeLength_Idn" <?php echo $PipeLengths_list->PipeLength_Idn->cellAttributes() ?>>
<?php if ($PipeLengths->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_PipeLength_Idn" class="form-group"></span>
<input type="hidden" data-table="PipeLengths" data-field="x_PipeLength_Idn" name="o<?php echo $PipeLengths_list->RowIndex ?>_PipeLength_Idn" id="o<?php echo $PipeLengths_list->RowIndex ?>_PipeLength_Idn" value="<?php echo HtmlEncode($PipeLengths_list->PipeLength_Idn->OldValue) ?>">
<?php } ?>
<?php if ($PipeLengths->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_PipeLength_Idn" class="form-group">
<span<?php echo $PipeLengths_list->PipeLength_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($PipeLengths_list->PipeLength_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_PipeLength_Idn" name="x<?php echo $PipeLengths_list->RowIndex ?>_PipeLength_Idn" id="x<?php echo $PipeLengths_list->RowIndex ?>_PipeLength_Idn" value="<?php echo HtmlEncode($PipeLengths_list->PipeLength_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($PipeLengths->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_PipeLength_Idn">
<span<?php echo $PipeLengths_list->PipeLength_Idn->viewAttributes() ?>><?php echo $PipeLengths_list->PipeLength_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $PipeLengths_list->Name->cellAttributes() ?>>
<?php if ($PipeLengths->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Name" class="form-group">
<input type="text" data-table="PipeLengths" data-field="x_Name" name="x<?php echo $PipeLengths_list->RowIndex ?>_Name" id="x<?php echo $PipeLengths_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeLengths_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Name->EditValue ?>"<?php echo $PipeLengths_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_Name" name="o<?php echo $PipeLengths_list->RowIndex ?>_Name" id="o<?php echo $PipeLengths_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PipeLengths_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($PipeLengths->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Name" class="form-group">
<input type="text" data-table="PipeLengths" data-field="x_Name" name="x<?php echo $PipeLengths_list->RowIndex ?>_Name" id="x<?php echo $PipeLengths_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeLengths_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Name->EditValue ?>"<?php echo $PipeLengths_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($PipeLengths->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Name">
<span<?php echo $PipeLengths_list->Name->viewAttributes() ?>><?php echo $PipeLengths_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->Value->Visible) { // Value ?>
		<td data-name="Value" <?php echo $PipeLengths_list->Value->cellAttributes() ?>>
<?php if ($PipeLengths->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Value" class="form-group">
<input type="text" data-table="PipeLengths" data-field="x_Value" name="x<?php echo $PipeLengths_list->RowIndex ?>_Value" id="x<?php echo $PipeLengths_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PipeLengths_list->Value->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Value->EditValue ?>"<?php echo $PipeLengths_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_Value" name="o<?php echo $PipeLengths_list->RowIndex ?>_Value" id="o<?php echo $PipeLengths_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($PipeLengths_list->Value->OldValue) ?>">
<?php } ?>
<?php if ($PipeLengths->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Value" class="form-group">
<input type="text" data-table="PipeLengths" data-field="x_Value" name="x<?php echo $PipeLengths_list->RowIndex ?>_Value" id="x<?php echo $PipeLengths_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PipeLengths_list->Value->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Value->EditValue ?>"<?php echo $PipeLengths_list->Value->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($PipeLengths->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Value">
<span<?php echo $PipeLengths_list->Value->viewAttributes() ?>><?php echo $PipeLengths_list->Value->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $PipeLengths_list->Rank->cellAttributes() ?>>
<?php if ($PipeLengths->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Rank" class="form-group">
<input type="text" data-table="PipeLengths" data-field="x_Rank" name="x<?php echo $PipeLengths_list->RowIndex ?>_Rank" id="x<?php echo $PipeLengths_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeLengths_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Rank->EditValue ?>"<?php echo $PipeLengths_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_Rank" name="o<?php echo $PipeLengths_list->RowIndex ?>_Rank" id="o<?php echo $PipeLengths_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PipeLengths_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($PipeLengths->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Rank" class="form-group">
<input type="text" data-table="PipeLengths" data-field="x_Rank" name="x<?php echo $PipeLengths_list->RowIndex ?>_Rank" id="x<?php echo $PipeLengths_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeLengths_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Rank->EditValue ?>"<?php echo $PipeLengths_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($PipeLengths->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_Rank">
<span<?php echo $PipeLengths_list->Rank->viewAttributes() ?>><?php echo $PipeLengths_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $PipeLengths_list->ActiveFlag->cellAttributes() ?>>
<?php if ($PipeLengths->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($PipeLengths_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeLengths" data-field="x_ActiveFlag" name="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]_331889" value="1"<?php echo $selwrk ?><?php echo $PipeLengths_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]_331889"></label>
</div>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_ActiveFlag" name="o<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PipeLengths_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($PipeLengths->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($PipeLengths_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeLengths" data-field="x_ActiveFlag" name="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]_422099" value="1"<?php echo $selwrk ?><?php echo $PipeLengths_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]_422099"></label>
</div>
</span>
<?php } ?>
<?php if ($PipeLengths->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $PipeLengths_list->RowCount ?>_PipeLengths_ActiveFlag">
<span<?php echo $PipeLengths_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $PipeLengths_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($PipeLengths_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PipeLengths_list->ListOptions->render("body", "right", $PipeLengths_list->RowCount);
?>
	</tr>
<?php if ($PipeLengths->RowType == ROWTYPE_ADD || $PipeLengths->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fPipeLengthslist", "load"], function() {
	fPipeLengthslist.updateLists(<?php echo $PipeLengths_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$PipeLengths_list->isGridAdd())
		if (!$PipeLengths_list->Recordset->EOF)
			$PipeLengths_list->Recordset->moveNext();
}
?>
<?php
	if ($PipeLengths_list->isGridAdd() || $PipeLengths_list->isGridEdit()) {
		$PipeLengths_list->RowIndex = '$rowindex$';
		$PipeLengths_list->loadRowValues();

		// Set row properties
		$PipeLengths->resetAttributes();
		$PipeLengths->RowAttrs->merge(["data-rowindex" => $PipeLengths_list->RowIndex, "id" => "r0_PipeLengths", "data-rowtype" => ROWTYPE_ADD]);
		$PipeLengths->RowAttrs->appendClass("ew-template");
		$PipeLengths->RowType = ROWTYPE_ADD;

		// Render row
		$PipeLengths_list->renderRow();

		// Render list options
		$PipeLengths_list->renderListOptions();
		$PipeLengths_list->StartRowCount = 0;
?>
	<tr <?php echo $PipeLengths->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PipeLengths_list->ListOptions->render("body", "left", $PipeLengths_list->RowIndex);
?>
	<?php if ($PipeLengths_list->PipeLength_Idn->Visible) { // PipeLength_Idn ?>
		<td data-name="PipeLength_Idn">
<span id="el$rowindex$_PipeLengths_PipeLength_Idn" class="form-group PipeLengths_PipeLength_Idn"></span>
<input type="hidden" data-table="PipeLengths" data-field="x_PipeLength_Idn" name="o<?php echo $PipeLengths_list->RowIndex ?>_PipeLength_Idn" id="o<?php echo $PipeLengths_list->RowIndex ?>_PipeLength_Idn" value="<?php echo HtmlEncode($PipeLengths_list->PipeLength_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_PipeLengths_Name" class="form-group PipeLengths_Name">
<input type="text" data-table="PipeLengths" data-field="x_Name" name="x<?php echo $PipeLengths_list->RowIndex ?>_Name" id="x<?php echo $PipeLengths_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PipeLengths_list->Name->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Name->EditValue ?>"<?php echo $PipeLengths_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_Name" name="o<?php echo $PipeLengths_list->RowIndex ?>_Name" id="o<?php echo $PipeLengths_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($PipeLengths_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el$rowindex$_PipeLengths_Value" class="form-group PipeLengths_Value">
<input type="text" data-table="PipeLengths" data-field="x_Value" name="x<?php echo $PipeLengths_list->RowIndex ?>_Value" id="x<?php echo $PipeLengths_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PipeLengths_list->Value->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Value->EditValue ?>"<?php echo $PipeLengths_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_Value" name="o<?php echo $PipeLengths_list->RowIndex ?>_Value" id="o<?php echo $PipeLengths_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($PipeLengths_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_PipeLengths_Rank" class="form-group PipeLengths_Rank">
<input type="text" data-table="PipeLengths" data-field="x_Rank" name="x<?php echo $PipeLengths_list->RowIndex ?>_Rank" id="x<?php echo $PipeLengths_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PipeLengths_list->Rank->getPlaceHolder()) ?>" value="<?php echo $PipeLengths_list->Rank->EditValue ?>"<?php echo $PipeLengths_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_Rank" name="o<?php echo $PipeLengths_list->RowIndex ?>_Rank" id="o<?php echo $PipeLengths_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($PipeLengths_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($PipeLengths_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_PipeLengths_ActiveFlag" class="form-group PipeLengths_ActiveFlag">
<?php
$selwrk = ConvertToBool($PipeLengths_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="PipeLengths" data-field="x_ActiveFlag" name="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]_426177" value="1"<?php echo $selwrk ?><?php echo $PipeLengths_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]_426177"></label>
</div>
</span>
<input type="hidden" data-table="PipeLengths" data-field="x_ActiveFlag" name="o<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $PipeLengths_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($PipeLengths_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PipeLengths_list->ListOptions->render("body", "right", $PipeLengths_list->RowIndex);
?>
<script>
loadjs.ready(["fPipeLengthslist", "load"], function() {
	fPipeLengthslist.updateLists(<?php echo $PipeLengths_list->RowIndex ?>);
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
<?php if ($PipeLengths_list->isAdd() || $PipeLengths_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $PipeLengths_list->FormKeyCountName ?>" id="<?php echo $PipeLengths_list->FormKeyCountName ?>" value="<?php echo $PipeLengths_list->KeyCount ?>">
<?php } ?>
<?php if ($PipeLengths_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $PipeLengths_list->FormKeyCountName ?>" id="<?php echo $PipeLengths_list->FormKeyCountName ?>" value="<?php echo $PipeLengths_list->KeyCount ?>">
<?php echo $PipeLengths_list->MultiSelectKey ?>
<?php } ?>
<?php if ($PipeLengths_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $PipeLengths_list->FormKeyCountName ?>" id="<?php echo $PipeLengths_list->FormKeyCountName ?>" value="<?php echo $PipeLengths_list->KeyCount ?>">
<?php } ?>
<?php if ($PipeLengths_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $PipeLengths_list->FormKeyCountName ?>" id="<?php echo $PipeLengths_list->FormKeyCountName ?>" value="<?php echo $PipeLengths_list->KeyCount ?>">
<?php echo $PipeLengths_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$PipeLengths->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($PipeLengths_list->Recordset)
	$PipeLengths_list->Recordset->Close();
?>
<?php if (!$PipeLengths_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$PipeLengths_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PipeLengths_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $PipeLengths_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($PipeLengths_list->TotalRecords == 0 && !$PipeLengths->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $PipeLengths_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$PipeLengths_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$PipeLengths_list->isExport()) { ?>
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
$PipeLengths_list->terminate();
?>