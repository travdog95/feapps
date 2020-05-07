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
$VolumeCorrections_list = new VolumeCorrections_list();

// Run the page
$VolumeCorrections_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$VolumeCorrections_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$VolumeCorrections_list->isExport()) { ?>
<script>
var fVolumeCorrectionslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fVolumeCorrectionslist = currentForm = new ew.Form("fVolumeCorrectionslist", "list");
	fVolumeCorrectionslist.formKeyCountName = '<?php echo $VolumeCorrections_list->FormKeyCountName ?>';

	// Validate form
	fVolumeCorrectionslist.validate = function() {
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
			<?php if ($VolumeCorrections_list->VolumeCorrection_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_VolumeCorrection_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_list->VolumeCorrection_Idn->caption(), $VolumeCorrections_list->VolumeCorrection_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($VolumeCorrections_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_list->Name->caption(), $VolumeCorrections_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($VolumeCorrections_list->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_list->Value->caption(), $VolumeCorrections_list->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($VolumeCorrections_list->Value->errorMessage()) ?>");
			<?php if ($VolumeCorrections_list->Hours->Required) { ?>
				elm = this.getElements("x" + infix + "_Hours");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_list->Hours->caption(), $VolumeCorrections_list->Hours->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Hours");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($VolumeCorrections_list->Hours->errorMessage()) ?>");
			<?php if ($VolumeCorrections_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_list->Rank->caption(), $VolumeCorrections_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($VolumeCorrections_list->Rank->errorMessage()) ?>");
			<?php if ($VolumeCorrections_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $VolumeCorrections_list->ActiveFlag->caption(), $VolumeCorrections_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fVolumeCorrectionslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Value", false)) return false;
		if (ew.valueChanged(fobj, infix, "Hours", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fVolumeCorrectionslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fVolumeCorrectionslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fVolumeCorrectionslist.lists["x_ActiveFlag[]"] = <?php echo $VolumeCorrections_list->ActiveFlag->Lookup->toClientList($VolumeCorrections_list) ?>;
	fVolumeCorrectionslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($VolumeCorrections_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fVolumeCorrectionslist");
});
var fVolumeCorrectionslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fVolumeCorrectionslistsrch = currentSearchForm = new ew.Form("fVolumeCorrectionslistsrch");

	// Dynamic selection lists
	// Filters

	fVolumeCorrectionslistsrch.filterList = <?php echo $VolumeCorrections_list->getFilterList() ?>;
	loadjs.done("fVolumeCorrectionslistsrch");
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
<?php if (!$VolumeCorrections_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($VolumeCorrections_list->TotalRecords > 0 && $VolumeCorrections_list->ExportOptions->visible()) { ?>
<?php $VolumeCorrections_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($VolumeCorrections_list->ImportOptions->visible()) { ?>
<?php $VolumeCorrections_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($VolumeCorrections_list->SearchOptions->visible()) { ?>
<?php $VolumeCorrections_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($VolumeCorrections_list->FilterOptions->visible()) { ?>
<?php $VolumeCorrections_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$VolumeCorrections_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$VolumeCorrections_list->isExport() && !$VolumeCorrections->CurrentAction) { ?>
<form name="fVolumeCorrectionslistsrch" id="fVolumeCorrectionslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fVolumeCorrectionslistsrch-search-panel" class="<?php echo $VolumeCorrections_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="VolumeCorrections">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $VolumeCorrections_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($VolumeCorrections_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($VolumeCorrections_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $VolumeCorrections_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($VolumeCorrections_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($VolumeCorrections_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($VolumeCorrections_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($VolumeCorrections_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $VolumeCorrections_list->showPageHeader(); ?>
<?php
$VolumeCorrections_list->showMessage();
?>
<?php if ($VolumeCorrections_list->TotalRecords > 0 || $VolumeCorrections->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($VolumeCorrections_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> VolumeCorrections">
<?php if (!$VolumeCorrections_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$VolumeCorrections_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $VolumeCorrections_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $VolumeCorrections_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fVolumeCorrectionslist" id="fVolumeCorrectionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="VolumeCorrections">
<div id="gmp_VolumeCorrections" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($VolumeCorrections_list->TotalRecords > 0 || $VolumeCorrections_list->isAdd() || $VolumeCorrections_list->isCopy() || $VolumeCorrections_list->isGridEdit()) { ?>
<table id="tbl_VolumeCorrectionslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$VolumeCorrections->RowType = ROWTYPE_HEADER;

// Render list options
$VolumeCorrections_list->renderListOptions();

// Render list options (header, left)
$VolumeCorrections_list->ListOptions->render("header", "left");
?>
<?php if ($VolumeCorrections_list->VolumeCorrection_Idn->Visible) { // VolumeCorrection_Idn ?>
	<?php if ($VolumeCorrections_list->SortUrl($VolumeCorrections_list->VolumeCorrection_Idn) == "") { ?>
		<th data-name="VolumeCorrection_Idn" class="<?php echo $VolumeCorrections_list->VolumeCorrection_Idn->headerCellClass() ?>"><div id="elh_VolumeCorrections_VolumeCorrection_Idn" class="VolumeCorrections_VolumeCorrection_Idn"><div class="ew-table-header-caption"><?php echo $VolumeCorrections_list->VolumeCorrection_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VolumeCorrection_Idn" class="<?php echo $VolumeCorrections_list->VolumeCorrection_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $VolumeCorrections_list->SortUrl($VolumeCorrections_list->VolumeCorrection_Idn) ?>', 1);"><div id="elh_VolumeCorrections_VolumeCorrection_Idn" class="VolumeCorrections_VolumeCorrection_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $VolumeCorrections_list->VolumeCorrection_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($VolumeCorrections_list->VolumeCorrection_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($VolumeCorrections_list->VolumeCorrection_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($VolumeCorrections_list->Name->Visible) { // Name ?>
	<?php if ($VolumeCorrections_list->SortUrl($VolumeCorrections_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $VolumeCorrections_list->Name->headerCellClass() ?>"><div id="elh_VolumeCorrections_Name" class="VolumeCorrections_Name"><div class="ew-table-header-caption"><?php echo $VolumeCorrections_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $VolumeCorrections_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $VolumeCorrections_list->SortUrl($VolumeCorrections_list->Name) ?>', 1);"><div id="elh_VolumeCorrections_Name" class="VolumeCorrections_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $VolumeCorrections_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($VolumeCorrections_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($VolumeCorrections_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($VolumeCorrections_list->Value->Visible) { // Value ?>
	<?php if ($VolumeCorrections_list->SortUrl($VolumeCorrections_list->Value) == "") { ?>
		<th data-name="Value" class="<?php echo $VolumeCorrections_list->Value->headerCellClass() ?>"><div id="elh_VolumeCorrections_Value" class="VolumeCorrections_Value"><div class="ew-table-header-caption"><?php echo $VolumeCorrections_list->Value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Value" class="<?php echo $VolumeCorrections_list->Value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $VolumeCorrections_list->SortUrl($VolumeCorrections_list->Value) ?>', 1);"><div id="elh_VolumeCorrections_Value" class="VolumeCorrections_Value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $VolumeCorrections_list->Value->caption() ?></span><span class="ew-table-header-sort"><?php if ($VolumeCorrections_list->Value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($VolumeCorrections_list->Value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($VolumeCorrections_list->Hours->Visible) { // Hours ?>
	<?php if ($VolumeCorrections_list->SortUrl($VolumeCorrections_list->Hours) == "") { ?>
		<th data-name="Hours" class="<?php echo $VolumeCorrections_list->Hours->headerCellClass() ?>"><div id="elh_VolumeCorrections_Hours" class="VolumeCorrections_Hours"><div class="ew-table-header-caption"><?php echo $VolumeCorrections_list->Hours->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Hours" class="<?php echo $VolumeCorrections_list->Hours->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $VolumeCorrections_list->SortUrl($VolumeCorrections_list->Hours) ?>', 1);"><div id="elh_VolumeCorrections_Hours" class="VolumeCorrections_Hours">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $VolumeCorrections_list->Hours->caption() ?></span><span class="ew-table-header-sort"><?php if ($VolumeCorrections_list->Hours->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($VolumeCorrections_list->Hours->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($VolumeCorrections_list->Rank->Visible) { // Rank ?>
	<?php if ($VolumeCorrections_list->SortUrl($VolumeCorrections_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $VolumeCorrections_list->Rank->headerCellClass() ?>"><div id="elh_VolumeCorrections_Rank" class="VolumeCorrections_Rank"><div class="ew-table-header-caption"><?php echo $VolumeCorrections_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $VolumeCorrections_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $VolumeCorrections_list->SortUrl($VolumeCorrections_list->Rank) ?>', 1);"><div id="elh_VolumeCorrections_Rank" class="VolumeCorrections_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $VolumeCorrections_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($VolumeCorrections_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($VolumeCorrections_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($VolumeCorrections_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($VolumeCorrections_list->SortUrl($VolumeCorrections_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $VolumeCorrections_list->ActiveFlag->headerCellClass() ?>"><div id="elh_VolumeCorrections_ActiveFlag" class="VolumeCorrections_ActiveFlag"><div class="ew-table-header-caption"><?php echo $VolumeCorrections_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $VolumeCorrections_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $VolumeCorrections_list->SortUrl($VolumeCorrections_list->ActiveFlag) ?>', 1);"><div id="elh_VolumeCorrections_ActiveFlag" class="VolumeCorrections_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $VolumeCorrections_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($VolumeCorrections_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($VolumeCorrections_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$VolumeCorrections_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($VolumeCorrections_list->isAdd() || $VolumeCorrections_list->isCopy()) {
		$VolumeCorrections_list->RowIndex = 0;
		$VolumeCorrections_list->KeyCount = $VolumeCorrections_list->RowIndex;
		if ($VolumeCorrections_list->isCopy() && !$VolumeCorrections_list->loadRow())
			$VolumeCorrections->CurrentAction = "add";
		if ($VolumeCorrections_list->isAdd())
			$VolumeCorrections_list->loadRowValues();
		if ($VolumeCorrections->EventCancelled) // Insert failed
			$VolumeCorrections_list->restoreFormValues(); // Restore form values

		// Set row properties
		$VolumeCorrections->resetAttributes();
		$VolumeCorrections->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_VolumeCorrections", "data-rowtype" => ROWTYPE_ADD]);
		$VolumeCorrections->RowType = ROWTYPE_ADD;

		// Render row
		$VolumeCorrections_list->renderRow();

		// Render list options
		$VolumeCorrections_list->renderListOptions();
		$VolumeCorrections_list->StartRowCount = 0;
?>
	<tr <?php echo $VolumeCorrections->rowAttributes() ?>>
<?php

// Render list options (body, left)
$VolumeCorrections_list->ListOptions->render("body", "left", $VolumeCorrections_list->RowCount);
?>
	<?php if ($VolumeCorrections_list->VolumeCorrection_Idn->Visible) { // VolumeCorrection_Idn ?>
		<td data-name="VolumeCorrection_Idn">
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_VolumeCorrection_Idn" class="form-group VolumeCorrections_VolumeCorrection_Idn"></span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_VolumeCorrection_Idn" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_VolumeCorrection_Idn" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_VolumeCorrection_Idn" value="<?php echo HtmlEncode($VolumeCorrections_list->VolumeCorrection_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Name" class="form-group VolumeCorrections_Name">
<input type="text" data-table="VolumeCorrections" data-field="x_Name" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Name" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Name->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Name->EditValue ?>"<?php echo $VolumeCorrections_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Name" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Name" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($VolumeCorrections_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Value" class="form-group VolumeCorrections_Value">
<input type="text" data-table="VolumeCorrections" data-field="x_Value" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Value" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Value->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Value->EditValue ?>"<?php echo $VolumeCorrections_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Value" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Value" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($VolumeCorrections_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Hours->Visible) { // Hours ?>
		<td data-name="Hours">
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Hours" class="form-group VolumeCorrections_Hours">
<input type="text" data-table="VolumeCorrections" data-field="x_Hours" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Hours->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Hours->EditValue ?>"<?php echo $VolumeCorrections_list->Hours->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Hours" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" value="<?php echo HtmlEncode($VolumeCorrections_list->Hours->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Rank" class="form-group VolumeCorrections_Rank">
<input type="text" data-table="VolumeCorrections" data-field="x_Rank" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Rank->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Rank->EditValue ?>"<?php echo $VolumeCorrections_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Rank" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($VolumeCorrections_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_ActiveFlag" class="form-group VolumeCorrections_ActiveFlag">
<?php
$selwrk = ConvertToBool($VolumeCorrections_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="VolumeCorrections" data-field="x_ActiveFlag" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]_552744" value="1"<?php echo $selwrk ?><?php echo $VolumeCorrections_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]_552744"></label>
</div>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_ActiveFlag" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($VolumeCorrections_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$VolumeCorrections_list->ListOptions->render("body", "right", $VolumeCorrections_list->RowCount);
?>
<script>
loadjs.ready(["fVolumeCorrectionslist", "load"], function() {
	fVolumeCorrectionslist.updateLists(<?php echo $VolumeCorrections_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($VolumeCorrections_list->ExportAll && $VolumeCorrections_list->isExport()) {
	$VolumeCorrections_list->StopRecord = $VolumeCorrections_list->TotalRecords;
} else {

	// Set the last record to display
	if ($VolumeCorrections_list->TotalRecords > $VolumeCorrections_list->StartRecord + $VolumeCorrections_list->DisplayRecords - 1)
		$VolumeCorrections_list->StopRecord = $VolumeCorrections_list->StartRecord + $VolumeCorrections_list->DisplayRecords - 1;
	else
		$VolumeCorrections_list->StopRecord = $VolumeCorrections_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($VolumeCorrections->isConfirm() || $VolumeCorrections_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($VolumeCorrections_list->FormKeyCountName) && ($VolumeCorrections_list->isGridAdd() || $VolumeCorrections_list->isGridEdit() || $VolumeCorrections->isConfirm())) {
		$VolumeCorrections_list->KeyCount = $CurrentForm->getValue($VolumeCorrections_list->FormKeyCountName);
		$VolumeCorrections_list->StopRecord = $VolumeCorrections_list->StartRecord + $VolumeCorrections_list->KeyCount - 1;
	}
}
$VolumeCorrections_list->RecordCount = $VolumeCorrections_list->StartRecord - 1;
if ($VolumeCorrections_list->Recordset && !$VolumeCorrections_list->Recordset->EOF) {
	$VolumeCorrections_list->Recordset->moveFirst();
	$selectLimit = $VolumeCorrections_list->UseSelectLimit;
	if (!$selectLimit && $VolumeCorrections_list->StartRecord > 1)
		$VolumeCorrections_list->Recordset->move($VolumeCorrections_list->StartRecord - 1);
} elseif (!$VolumeCorrections->AllowAddDeleteRow && $VolumeCorrections_list->StopRecord == 0) {
	$VolumeCorrections_list->StopRecord = $VolumeCorrections->GridAddRowCount;
}

// Initialize aggregate
$VolumeCorrections->RowType = ROWTYPE_AGGREGATEINIT;
$VolumeCorrections->resetAttributes();
$VolumeCorrections_list->renderRow();
$VolumeCorrections_list->EditRowCount = 0;
if ($VolumeCorrections_list->isEdit())
	$VolumeCorrections_list->RowIndex = 1;
if ($VolumeCorrections_list->isGridAdd())
	$VolumeCorrections_list->RowIndex = 0;
if ($VolumeCorrections_list->isGridEdit())
	$VolumeCorrections_list->RowIndex = 0;
while ($VolumeCorrections_list->RecordCount < $VolumeCorrections_list->StopRecord) {
	$VolumeCorrections_list->RecordCount++;
	if ($VolumeCorrections_list->RecordCount >= $VolumeCorrections_list->StartRecord) {
		$VolumeCorrections_list->RowCount++;
		if ($VolumeCorrections_list->isGridAdd() || $VolumeCorrections_list->isGridEdit() || $VolumeCorrections->isConfirm()) {
			$VolumeCorrections_list->RowIndex++;
			$CurrentForm->Index = $VolumeCorrections_list->RowIndex;
			if ($CurrentForm->hasValue($VolumeCorrections_list->FormActionName) && ($VolumeCorrections->isConfirm() || $VolumeCorrections_list->EventCancelled))
				$VolumeCorrections_list->RowAction = strval($CurrentForm->getValue($VolumeCorrections_list->FormActionName));
			elseif ($VolumeCorrections_list->isGridAdd())
				$VolumeCorrections_list->RowAction = "insert";
			else
				$VolumeCorrections_list->RowAction = "";
		}

		// Set up key count
		$VolumeCorrections_list->KeyCount = $VolumeCorrections_list->RowIndex;

		// Init row class and style
		$VolumeCorrections->resetAttributes();
		$VolumeCorrections->CssClass = "";
		if ($VolumeCorrections_list->isGridAdd()) {
			$VolumeCorrections_list->loadRowValues(); // Load default values
		} else {
			$VolumeCorrections_list->loadRowValues($VolumeCorrections_list->Recordset); // Load row values
		}
		$VolumeCorrections->RowType = ROWTYPE_VIEW; // Render view
		if ($VolumeCorrections_list->isGridAdd()) // Grid add
			$VolumeCorrections->RowType = ROWTYPE_ADD; // Render add
		if ($VolumeCorrections_list->isGridAdd() && $VolumeCorrections->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$VolumeCorrections_list->restoreCurrentRowFormValues($VolumeCorrections_list->RowIndex); // Restore form values
		if ($VolumeCorrections_list->isEdit()) {
			if ($VolumeCorrections_list->checkInlineEditKey() && $VolumeCorrections_list->EditRowCount == 0) { // Inline edit
				$VolumeCorrections->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($VolumeCorrections_list->isGridEdit()) { // Grid edit
			if ($VolumeCorrections->EventCancelled)
				$VolumeCorrections_list->restoreCurrentRowFormValues($VolumeCorrections_list->RowIndex); // Restore form values
			if ($VolumeCorrections_list->RowAction == "insert")
				$VolumeCorrections->RowType = ROWTYPE_ADD; // Render add
			else
				$VolumeCorrections->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($VolumeCorrections_list->isEdit() && $VolumeCorrections->RowType == ROWTYPE_EDIT && $VolumeCorrections->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$VolumeCorrections_list->restoreFormValues(); // Restore form values
		}
		if ($VolumeCorrections_list->isGridEdit() && ($VolumeCorrections->RowType == ROWTYPE_EDIT || $VolumeCorrections->RowType == ROWTYPE_ADD) && $VolumeCorrections->EventCancelled) // Update failed
			$VolumeCorrections_list->restoreCurrentRowFormValues($VolumeCorrections_list->RowIndex); // Restore form values
		if ($VolumeCorrections->RowType == ROWTYPE_EDIT) // Edit row
			$VolumeCorrections_list->EditRowCount++;

		// Set up row id / data-rowindex
		$VolumeCorrections->RowAttrs->merge(["data-rowindex" => $VolumeCorrections_list->RowCount, "id" => "r" . $VolumeCorrections_list->RowCount . "_VolumeCorrections", "data-rowtype" => $VolumeCorrections->RowType]);

		// Render row
		$VolumeCorrections_list->renderRow();

		// Render list options
		$VolumeCorrections_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($VolumeCorrections_list->RowAction != "delete" && $VolumeCorrections_list->RowAction != "insertdelete" && !($VolumeCorrections_list->RowAction == "insert" && $VolumeCorrections->isConfirm() && $VolumeCorrections_list->emptyRow())) {
?>
	<tr <?php echo $VolumeCorrections->rowAttributes() ?>>
<?php

// Render list options (body, left)
$VolumeCorrections_list->ListOptions->render("body", "left", $VolumeCorrections_list->RowCount);
?>
	<?php if ($VolumeCorrections_list->VolumeCorrection_Idn->Visible) { // VolumeCorrection_Idn ?>
		<td data-name="VolumeCorrection_Idn" <?php echo $VolumeCorrections_list->VolumeCorrection_Idn->cellAttributes() ?>>
<?php if ($VolumeCorrections->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_VolumeCorrection_Idn" class="form-group"></span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_VolumeCorrection_Idn" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_VolumeCorrection_Idn" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_VolumeCorrection_Idn" value="<?php echo HtmlEncode($VolumeCorrections_list->VolumeCorrection_Idn->OldValue) ?>">
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_VolumeCorrection_Idn" class="form-group">
<span<?php echo $VolumeCorrections_list->VolumeCorrection_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($VolumeCorrections_list->VolumeCorrection_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_VolumeCorrection_Idn" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_VolumeCorrection_Idn" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_VolumeCorrection_Idn" value="<?php echo HtmlEncode($VolumeCorrections_list->VolumeCorrection_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_VolumeCorrection_Idn">
<span<?php echo $VolumeCorrections_list->VolumeCorrection_Idn->viewAttributes() ?>><?php echo $VolumeCorrections_list->VolumeCorrection_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $VolumeCorrections_list->Name->cellAttributes() ?>>
<?php if ($VolumeCorrections->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Name" class="form-group">
<input type="text" data-table="VolumeCorrections" data-field="x_Name" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Name" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Name->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Name->EditValue ?>"<?php echo $VolumeCorrections_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Name" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Name" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($VolumeCorrections_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Name" class="form-group">
<input type="text" data-table="VolumeCorrections" data-field="x_Name" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Name" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Name->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Name->EditValue ?>"<?php echo $VolumeCorrections_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Name">
<span<?php echo $VolumeCorrections_list->Name->viewAttributes() ?>><?php echo $VolumeCorrections_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Value->Visible) { // Value ?>
		<td data-name="Value" <?php echo $VolumeCorrections_list->Value->cellAttributes() ?>>
<?php if ($VolumeCorrections->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Value" class="form-group">
<input type="text" data-table="VolumeCorrections" data-field="x_Value" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Value" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Value->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Value->EditValue ?>"<?php echo $VolumeCorrections_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Value" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Value" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($VolumeCorrections_list->Value->OldValue) ?>">
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Value" class="form-group">
<input type="text" data-table="VolumeCorrections" data-field="x_Value" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Value" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Value->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Value->EditValue ?>"<?php echo $VolumeCorrections_list->Value->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Value">
<span<?php echo $VolumeCorrections_list->Value->viewAttributes() ?>><?php echo $VolumeCorrections_list->Value->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Hours->Visible) { // Hours ?>
		<td data-name="Hours" <?php echo $VolumeCorrections_list->Hours->cellAttributes() ?>>
<?php if ($VolumeCorrections->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Hours" class="form-group">
<input type="text" data-table="VolumeCorrections" data-field="x_Hours" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Hours->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Hours->EditValue ?>"<?php echo $VolumeCorrections_list->Hours->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Hours" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" value="<?php echo HtmlEncode($VolumeCorrections_list->Hours->OldValue) ?>">
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Hours" class="form-group">
<input type="text" data-table="VolumeCorrections" data-field="x_Hours" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Hours->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Hours->EditValue ?>"<?php echo $VolumeCorrections_list->Hours->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Hours">
<span<?php echo $VolumeCorrections_list->Hours->viewAttributes() ?>><?php echo $VolumeCorrections_list->Hours->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $VolumeCorrections_list->Rank->cellAttributes() ?>>
<?php if ($VolumeCorrections->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Rank" class="form-group">
<input type="text" data-table="VolumeCorrections" data-field="x_Rank" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Rank->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Rank->EditValue ?>"<?php echo $VolumeCorrections_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Rank" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($VolumeCorrections_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Rank" class="form-group">
<input type="text" data-table="VolumeCorrections" data-field="x_Rank" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Rank->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Rank->EditValue ?>"<?php echo $VolumeCorrections_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_Rank">
<span<?php echo $VolumeCorrections_list->Rank->viewAttributes() ?>><?php echo $VolumeCorrections_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $VolumeCorrections_list->ActiveFlag->cellAttributes() ?>>
<?php if ($VolumeCorrections->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($VolumeCorrections_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="VolumeCorrections" data-field="x_ActiveFlag" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]_636644" value="1"<?php echo $selwrk ?><?php echo $VolumeCorrections_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]_636644"></label>
</div>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_ActiveFlag" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($VolumeCorrections_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($VolumeCorrections_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="VolumeCorrections" data-field="x_ActiveFlag" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]_911296" value="1"<?php echo $selwrk ?><?php echo $VolumeCorrections_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]_911296"></label>
</div>
</span>
<?php } ?>
<?php if ($VolumeCorrections->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $VolumeCorrections_list->RowCount ?>_VolumeCorrections_ActiveFlag">
<span<?php echo $VolumeCorrections_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $VolumeCorrections_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($VolumeCorrections_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$VolumeCorrections_list->ListOptions->render("body", "right", $VolumeCorrections_list->RowCount);
?>
	</tr>
<?php if ($VolumeCorrections->RowType == ROWTYPE_ADD || $VolumeCorrections->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fVolumeCorrectionslist", "load"], function() {
	fVolumeCorrectionslist.updateLists(<?php echo $VolumeCorrections_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$VolumeCorrections_list->isGridAdd())
		if (!$VolumeCorrections_list->Recordset->EOF)
			$VolumeCorrections_list->Recordset->moveNext();
}
?>
<?php
	if ($VolumeCorrections_list->isGridAdd() || $VolumeCorrections_list->isGridEdit()) {
		$VolumeCorrections_list->RowIndex = '$rowindex$';
		$VolumeCorrections_list->loadRowValues();

		// Set row properties
		$VolumeCorrections->resetAttributes();
		$VolumeCorrections->RowAttrs->merge(["data-rowindex" => $VolumeCorrections_list->RowIndex, "id" => "r0_VolumeCorrections", "data-rowtype" => ROWTYPE_ADD]);
		$VolumeCorrections->RowAttrs->appendClass("ew-template");
		$VolumeCorrections->RowType = ROWTYPE_ADD;

		// Render row
		$VolumeCorrections_list->renderRow();

		// Render list options
		$VolumeCorrections_list->renderListOptions();
		$VolumeCorrections_list->StartRowCount = 0;
?>
	<tr <?php echo $VolumeCorrections->rowAttributes() ?>>
<?php

// Render list options (body, left)
$VolumeCorrections_list->ListOptions->render("body", "left", $VolumeCorrections_list->RowIndex);
?>
	<?php if ($VolumeCorrections_list->VolumeCorrection_Idn->Visible) { // VolumeCorrection_Idn ?>
		<td data-name="VolumeCorrection_Idn">
<span id="el$rowindex$_VolumeCorrections_VolumeCorrection_Idn" class="form-group VolumeCorrections_VolumeCorrection_Idn"></span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_VolumeCorrection_Idn" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_VolumeCorrection_Idn" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_VolumeCorrection_Idn" value="<?php echo HtmlEncode($VolumeCorrections_list->VolumeCorrection_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_VolumeCorrections_Name" class="form-group VolumeCorrections_Name">
<input type="text" data-table="VolumeCorrections" data-field="x_Name" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Name" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Name->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Name->EditValue ?>"<?php echo $VolumeCorrections_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Name" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Name" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($VolumeCorrections_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el$rowindex$_VolumeCorrections_Value" class="form-group VolumeCorrections_Value">
<input type="text" data-table="VolumeCorrections" data-field="x_Value" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Value" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Value->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Value->EditValue ?>"<?php echo $VolumeCorrections_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Value" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Value" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($VolumeCorrections_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Hours->Visible) { // Hours ?>
		<td data-name="Hours">
<span id="el$rowindex$_VolumeCorrections_Hours" class="form-group VolumeCorrections_Hours">
<input type="text" data-table="VolumeCorrections" data-field="x_Hours" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Hours->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Hours->EditValue ?>"<?php echo $VolumeCorrections_list->Hours->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Hours" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Hours" value="<?php echo HtmlEncode($VolumeCorrections_list->Hours->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_VolumeCorrections_Rank" class="form-group VolumeCorrections_Rank">
<input type="text" data-table="VolumeCorrections" data-field="x_Rank" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($VolumeCorrections_list->Rank->getPlaceHolder()) ?>" value="<?php echo $VolumeCorrections_list->Rank->EditValue ?>"<?php echo $VolumeCorrections_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_Rank" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($VolumeCorrections_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($VolumeCorrections_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_VolumeCorrections_ActiveFlag" class="form-group VolumeCorrections_ActiveFlag">
<?php
$selwrk = ConvertToBool($VolumeCorrections_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="VolumeCorrections" data-field="x_ActiveFlag" name="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]_230009" value="1"<?php echo $selwrk ?><?php echo $VolumeCorrections_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]_230009"></label>
</div>
</span>
<input type="hidden" data-table="VolumeCorrections" data-field="x_ActiveFlag" name="o<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $VolumeCorrections_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($VolumeCorrections_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$VolumeCorrections_list->ListOptions->render("body", "right", $VolumeCorrections_list->RowIndex);
?>
<script>
loadjs.ready(["fVolumeCorrectionslist", "load"], function() {
	fVolumeCorrectionslist.updateLists(<?php echo $VolumeCorrections_list->RowIndex ?>);
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
<?php if ($VolumeCorrections_list->isAdd() || $VolumeCorrections_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $VolumeCorrections_list->FormKeyCountName ?>" id="<?php echo $VolumeCorrections_list->FormKeyCountName ?>" value="<?php echo $VolumeCorrections_list->KeyCount ?>">
<?php } ?>
<?php if ($VolumeCorrections_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $VolumeCorrections_list->FormKeyCountName ?>" id="<?php echo $VolumeCorrections_list->FormKeyCountName ?>" value="<?php echo $VolumeCorrections_list->KeyCount ?>">
<?php echo $VolumeCorrections_list->MultiSelectKey ?>
<?php } ?>
<?php if ($VolumeCorrections_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $VolumeCorrections_list->FormKeyCountName ?>" id="<?php echo $VolumeCorrections_list->FormKeyCountName ?>" value="<?php echo $VolumeCorrections_list->KeyCount ?>">
<?php } ?>
<?php if ($VolumeCorrections_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $VolumeCorrections_list->FormKeyCountName ?>" id="<?php echo $VolumeCorrections_list->FormKeyCountName ?>" value="<?php echo $VolumeCorrections_list->KeyCount ?>">
<?php echo $VolumeCorrections_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$VolumeCorrections->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($VolumeCorrections_list->Recordset)
	$VolumeCorrections_list->Recordset->Close();
?>
<?php if (!$VolumeCorrections_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$VolumeCorrections_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $VolumeCorrections_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $VolumeCorrections_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($VolumeCorrections_list->TotalRecords == 0 && !$VolumeCorrections->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $VolumeCorrections_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$VolumeCorrections_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$VolumeCorrections_list->isExport()) { ?>
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
$VolumeCorrections_list->terminate();
?>