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
$ShopFabrications_list = new ShopFabrications_list();

// Run the page
$ShopFabrications_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ShopFabrications_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ShopFabrications_list->isExport()) { ?>
<script>
var fShopFabricationslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fShopFabricationslist = currentForm = new ew.Form("fShopFabricationslist", "list");
	fShopFabricationslist.formKeyCountName = '<?php echo $ShopFabrications_list->FormKeyCountName ?>';

	// Validate form
	fShopFabricationslist.validate = function() {
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
			<?php if ($ShopFabrications_list->ShopFabrication_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ShopFabrication_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabrications_list->ShopFabrication_Idn->caption(), $ShopFabrications_list->ShopFabrication_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ShopFabrications_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabrications_list->Name->caption(), $ShopFabrications_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ShopFabrications_list->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabrications_list->Value->caption(), $ShopFabrications_list->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ShopFabrications_list->Value->errorMessage()) ?>");
			<?php if ($ShopFabrications_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabrications_list->Rank->caption(), $ShopFabrications_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ShopFabrications_list->Rank->errorMessage()) ?>");
			<?php if ($ShopFabrications_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabrications_list->ActiveFlag->caption(), $ShopFabrications_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fShopFabricationslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Value", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fShopFabricationslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fShopFabricationslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fShopFabricationslist.lists["x_ActiveFlag[]"] = <?php echo $ShopFabrications_list->ActiveFlag->Lookup->toClientList($ShopFabrications_list) ?>;
	fShopFabricationslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ShopFabrications_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fShopFabricationslist");
});
var fShopFabricationslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fShopFabricationslistsrch = currentSearchForm = new ew.Form("fShopFabricationslistsrch");

	// Dynamic selection lists
	// Filters

	fShopFabricationslistsrch.filterList = <?php echo $ShopFabrications_list->getFilterList() ?>;
	loadjs.done("fShopFabricationslistsrch");
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
<?php if (!$ShopFabrications_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ShopFabrications_list->TotalRecords > 0 && $ShopFabrications_list->ExportOptions->visible()) { ?>
<?php $ShopFabrications_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ShopFabrications_list->ImportOptions->visible()) { ?>
<?php $ShopFabrications_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ShopFabrications_list->SearchOptions->visible()) { ?>
<?php $ShopFabrications_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ShopFabrications_list->FilterOptions->visible()) { ?>
<?php $ShopFabrications_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ShopFabrications_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ShopFabrications_list->isExport() && !$ShopFabrications->CurrentAction) { ?>
<form name="fShopFabricationslistsrch" id="fShopFabricationslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fShopFabricationslistsrch-search-panel" class="<?php echo $ShopFabrications_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ShopFabrications">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ShopFabrications_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ShopFabrications_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ShopFabrications_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ShopFabrications_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ShopFabrications_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ShopFabrications_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ShopFabrications_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ShopFabrications_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ShopFabrications_list->showPageHeader(); ?>
<?php
$ShopFabrications_list->showMessage();
?>
<?php if ($ShopFabrications_list->TotalRecords > 0 || $ShopFabrications->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ShopFabrications_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ShopFabrications">
<?php if (!$ShopFabrications_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ShopFabrications_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ShopFabrications_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ShopFabrications_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fShopFabricationslist" id="fShopFabricationslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ShopFabrications">
<div id="gmp_ShopFabrications" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ShopFabrications_list->TotalRecords > 0 || $ShopFabrications_list->isAdd() || $ShopFabrications_list->isCopy() || $ShopFabrications_list->isGridEdit()) { ?>
<table id="tbl_ShopFabricationslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ShopFabrications->RowType = ROWTYPE_HEADER;

// Render list options
$ShopFabrications_list->renderListOptions();

// Render list options (header, left)
$ShopFabrications_list->ListOptions->render("header", "left");
?>
<?php if ($ShopFabrications_list->ShopFabrication_Idn->Visible) { // ShopFabrication_Idn ?>
	<?php if ($ShopFabrications_list->SortUrl($ShopFabrications_list->ShopFabrication_Idn) == "") { ?>
		<th data-name="ShopFabrication_Idn" class="<?php echo $ShopFabrications_list->ShopFabrication_Idn->headerCellClass() ?>"><div id="elh_ShopFabrications_ShopFabrication_Idn" class="ShopFabrications_ShopFabrication_Idn"><div class="ew-table-header-caption"><?php echo $ShopFabrications_list->ShopFabrication_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShopFabrication_Idn" class="<?php echo $ShopFabrications_list->ShopFabrication_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ShopFabrications_list->SortUrl($ShopFabrications_list->ShopFabrication_Idn) ?>', 1);"><div id="elh_ShopFabrications_ShopFabrication_Idn" class="ShopFabrications_ShopFabrication_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ShopFabrications_list->ShopFabrication_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($ShopFabrications_list->ShopFabrication_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ShopFabrications_list->ShopFabrication_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ShopFabrications_list->Name->Visible) { // Name ?>
	<?php if ($ShopFabrications_list->SortUrl($ShopFabrications_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $ShopFabrications_list->Name->headerCellClass() ?>"><div id="elh_ShopFabrications_Name" class="ShopFabrications_Name"><div class="ew-table-header-caption"><?php echo $ShopFabrications_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $ShopFabrications_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ShopFabrications_list->SortUrl($ShopFabrications_list->Name) ?>', 1);"><div id="elh_ShopFabrications_Name" class="ShopFabrications_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ShopFabrications_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ShopFabrications_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ShopFabrications_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ShopFabrications_list->Value->Visible) { // Value ?>
	<?php if ($ShopFabrications_list->SortUrl($ShopFabrications_list->Value) == "") { ?>
		<th data-name="Value" class="<?php echo $ShopFabrications_list->Value->headerCellClass() ?>"><div id="elh_ShopFabrications_Value" class="ShopFabrications_Value"><div class="ew-table-header-caption"><?php echo $ShopFabrications_list->Value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Value" class="<?php echo $ShopFabrications_list->Value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ShopFabrications_list->SortUrl($ShopFabrications_list->Value) ?>', 1);"><div id="elh_ShopFabrications_Value" class="ShopFabrications_Value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ShopFabrications_list->Value->caption() ?></span><span class="ew-table-header-sort"><?php if ($ShopFabrications_list->Value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ShopFabrications_list->Value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ShopFabrications_list->Rank->Visible) { // Rank ?>
	<?php if ($ShopFabrications_list->SortUrl($ShopFabrications_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $ShopFabrications_list->Rank->headerCellClass() ?>"><div id="elh_ShopFabrications_Rank" class="ShopFabrications_Rank"><div class="ew-table-header-caption"><?php echo $ShopFabrications_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $ShopFabrications_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ShopFabrications_list->SortUrl($ShopFabrications_list->Rank) ?>', 1);"><div id="elh_ShopFabrications_Rank" class="ShopFabrications_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ShopFabrications_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($ShopFabrications_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ShopFabrications_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ShopFabrications_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($ShopFabrications_list->SortUrl($ShopFabrications_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $ShopFabrications_list->ActiveFlag->headerCellClass() ?>"><div id="elh_ShopFabrications_ActiveFlag" class="ShopFabrications_ActiveFlag"><div class="ew-table-header-caption"><?php echo $ShopFabrications_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $ShopFabrications_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ShopFabrications_list->SortUrl($ShopFabrications_list->ActiveFlag) ?>', 1);"><div id="elh_ShopFabrications_ActiveFlag" class="ShopFabrications_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ShopFabrications_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($ShopFabrications_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ShopFabrications_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ShopFabrications_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($ShopFabrications_list->isAdd() || $ShopFabrications_list->isCopy()) {
		$ShopFabrications_list->RowIndex = 0;
		$ShopFabrications_list->KeyCount = $ShopFabrications_list->RowIndex;
		if ($ShopFabrications_list->isCopy() && !$ShopFabrications_list->loadRow())
			$ShopFabrications->CurrentAction = "add";
		if ($ShopFabrications_list->isAdd())
			$ShopFabrications_list->loadRowValues();
		if ($ShopFabrications->EventCancelled) // Insert failed
			$ShopFabrications_list->restoreFormValues(); // Restore form values

		// Set row properties
		$ShopFabrications->resetAttributes();
		$ShopFabrications->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_ShopFabrications", "data-rowtype" => ROWTYPE_ADD]);
		$ShopFabrications->RowType = ROWTYPE_ADD;

		// Render row
		$ShopFabrications_list->renderRow();

		// Render list options
		$ShopFabrications_list->renderListOptions();
		$ShopFabrications_list->StartRowCount = 0;
?>
	<tr <?php echo $ShopFabrications->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ShopFabrications_list->ListOptions->render("body", "left", $ShopFabrications_list->RowCount);
?>
	<?php if ($ShopFabrications_list->ShopFabrication_Idn->Visible) { // ShopFabrication_Idn ?>
		<td data-name="ShopFabrication_Idn">
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_ShopFabrication_Idn" class="form-group ShopFabrications_ShopFabrication_Idn"></span>
<input type="hidden" data-table="ShopFabrications" data-field="x_ShopFabrication_Idn" name="o<?php echo $ShopFabrications_list->RowIndex ?>_ShopFabrication_Idn" id="o<?php echo $ShopFabrications_list->RowIndex ?>_ShopFabrication_Idn" value="<?php echo HtmlEncode($ShopFabrications_list->ShopFabrication_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Name" class="form-group ShopFabrications_Name">
<input type="text" data-table="ShopFabrications" data-field="x_Name" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Name" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Name->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Name->EditValue ?>"<?php echo $ShopFabrications_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_Name" name="o<?php echo $ShopFabrications_list->RowIndex ?>_Name" id="o<?php echo $ShopFabrications_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ShopFabrications_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Value" class="form-group ShopFabrications_Value">
<input type="text" data-table="ShopFabrications" data-field="x_Value" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Value" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Value->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Value->EditValue ?>"<?php echo $ShopFabrications_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_Value" name="o<?php echo $ShopFabrications_list->RowIndex ?>_Value" id="o<?php echo $ShopFabrications_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($ShopFabrications_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Rank" class="form-group ShopFabrications_Rank">
<input type="text" data-table="ShopFabrications" data-field="x_Rank" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Rank" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Rank->EditValue ?>"<?php echo $ShopFabrications_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_Rank" name="o<?php echo $ShopFabrications_list->RowIndex ?>_Rank" id="o<?php echo $ShopFabrications_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ShopFabrications_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_ActiveFlag" class="form-group ShopFabrications_ActiveFlag">
<?php
$selwrk = ConvertToBool($ShopFabrications_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ShopFabrications" data-field="x_ActiveFlag" name="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]_821661" value="1"<?php echo $selwrk ?><?php echo $ShopFabrications_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]_821661"></label>
</div>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_ActiveFlag" name="o<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ShopFabrications_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ShopFabrications_list->ListOptions->render("body", "right", $ShopFabrications_list->RowCount);
?>
<script>
loadjs.ready(["fShopFabricationslist", "load"], function() {
	fShopFabricationslist.updateLists(<?php echo $ShopFabrications_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($ShopFabrications_list->ExportAll && $ShopFabrications_list->isExport()) {
	$ShopFabrications_list->StopRecord = $ShopFabrications_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ShopFabrications_list->TotalRecords > $ShopFabrications_list->StartRecord + $ShopFabrications_list->DisplayRecords - 1)
		$ShopFabrications_list->StopRecord = $ShopFabrications_list->StartRecord + $ShopFabrications_list->DisplayRecords - 1;
	else
		$ShopFabrications_list->StopRecord = $ShopFabrications_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($ShopFabrications->isConfirm() || $ShopFabrications_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ShopFabrications_list->FormKeyCountName) && ($ShopFabrications_list->isGridAdd() || $ShopFabrications_list->isGridEdit() || $ShopFabrications->isConfirm())) {
		$ShopFabrications_list->KeyCount = $CurrentForm->getValue($ShopFabrications_list->FormKeyCountName);
		$ShopFabrications_list->StopRecord = $ShopFabrications_list->StartRecord + $ShopFabrications_list->KeyCount - 1;
	}
}
$ShopFabrications_list->RecordCount = $ShopFabrications_list->StartRecord - 1;
if ($ShopFabrications_list->Recordset && !$ShopFabrications_list->Recordset->EOF) {
	$ShopFabrications_list->Recordset->moveFirst();
	$selectLimit = $ShopFabrications_list->UseSelectLimit;
	if (!$selectLimit && $ShopFabrications_list->StartRecord > 1)
		$ShopFabrications_list->Recordset->move($ShopFabrications_list->StartRecord - 1);
} elseif (!$ShopFabrications->AllowAddDeleteRow && $ShopFabrications_list->StopRecord == 0) {
	$ShopFabrications_list->StopRecord = $ShopFabrications->GridAddRowCount;
}

// Initialize aggregate
$ShopFabrications->RowType = ROWTYPE_AGGREGATEINIT;
$ShopFabrications->resetAttributes();
$ShopFabrications_list->renderRow();
$ShopFabrications_list->EditRowCount = 0;
if ($ShopFabrications_list->isEdit())
	$ShopFabrications_list->RowIndex = 1;
if ($ShopFabrications_list->isGridAdd())
	$ShopFabrications_list->RowIndex = 0;
if ($ShopFabrications_list->isGridEdit())
	$ShopFabrications_list->RowIndex = 0;
while ($ShopFabrications_list->RecordCount < $ShopFabrications_list->StopRecord) {
	$ShopFabrications_list->RecordCount++;
	if ($ShopFabrications_list->RecordCount >= $ShopFabrications_list->StartRecord) {
		$ShopFabrications_list->RowCount++;
		if ($ShopFabrications_list->isGridAdd() || $ShopFabrications_list->isGridEdit() || $ShopFabrications->isConfirm()) {
			$ShopFabrications_list->RowIndex++;
			$CurrentForm->Index = $ShopFabrications_list->RowIndex;
			if ($CurrentForm->hasValue($ShopFabrications_list->FormActionName) && ($ShopFabrications->isConfirm() || $ShopFabrications_list->EventCancelled))
				$ShopFabrications_list->RowAction = strval($CurrentForm->getValue($ShopFabrications_list->FormActionName));
			elseif ($ShopFabrications_list->isGridAdd())
				$ShopFabrications_list->RowAction = "insert";
			else
				$ShopFabrications_list->RowAction = "";
		}

		// Set up key count
		$ShopFabrications_list->KeyCount = $ShopFabrications_list->RowIndex;

		// Init row class and style
		$ShopFabrications->resetAttributes();
		$ShopFabrications->CssClass = "";
		if ($ShopFabrications_list->isGridAdd()) {
			$ShopFabrications_list->loadRowValues(); // Load default values
		} else {
			$ShopFabrications_list->loadRowValues($ShopFabrications_list->Recordset); // Load row values
		}
		$ShopFabrications->RowType = ROWTYPE_VIEW; // Render view
		if ($ShopFabrications_list->isGridAdd()) // Grid add
			$ShopFabrications->RowType = ROWTYPE_ADD; // Render add
		if ($ShopFabrications_list->isGridAdd() && $ShopFabrications->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ShopFabrications_list->restoreCurrentRowFormValues($ShopFabrications_list->RowIndex); // Restore form values
		if ($ShopFabrications_list->isEdit()) {
			if ($ShopFabrications_list->checkInlineEditKey() && $ShopFabrications_list->EditRowCount == 0) { // Inline edit
				$ShopFabrications->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($ShopFabrications_list->isGridEdit()) { // Grid edit
			if ($ShopFabrications->EventCancelled)
				$ShopFabrications_list->restoreCurrentRowFormValues($ShopFabrications_list->RowIndex); // Restore form values
			if ($ShopFabrications_list->RowAction == "insert")
				$ShopFabrications->RowType = ROWTYPE_ADD; // Render add
			else
				$ShopFabrications->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ShopFabrications_list->isEdit() && $ShopFabrications->RowType == ROWTYPE_EDIT && $ShopFabrications->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$ShopFabrications_list->restoreFormValues(); // Restore form values
		}
		if ($ShopFabrications_list->isGridEdit() && ($ShopFabrications->RowType == ROWTYPE_EDIT || $ShopFabrications->RowType == ROWTYPE_ADD) && $ShopFabrications->EventCancelled) // Update failed
			$ShopFabrications_list->restoreCurrentRowFormValues($ShopFabrications_list->RowIndex); // Restore form values
		if ($ShopFabrications->RowType == ROWTYPE_EDIT) // Edit row
			$ShopFabrications_list->EditRowCount++;

		// Set up row id / data-rowindex
		$ShopFabrications->RowAttrs->merge(["data-rowindex" => $ShopFabrications_list->RowCount, "id" => "r" . $ShopFabrications_list->RowCount . "_ShopFabrications", "data-rowtype" => $ShopFabrications->RowType]);

		// Render row
		$ShopFabrications_list->renderRow();

		// Render list options
		$ShopFabrications_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ShopFabrications_list->RowAction != "delete" && $ShopFabrications_list->RowAction != "insertdelete" && !($ShopFabrications_list->RowAction == "insert" && $ShopFabrications->isConfirm() && $ShopFabrications_list->emptyRow())) {
?>
	<tr <?php echo $ShopFabrications->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ShopFabrications_list->ListOptions->render("body", "left", $ShopFabrications_list->RowCount);
?>
	<?php if ($ShopFabrications_list->ShopFabrication_Idn->Visible) { // ShopFabrication_Idn ?>
		<td data-name="ShopFabrication_Idn" <?php echo $ShopFabrications_list->ShopFabrication_Idn->cellAttributes() ?>>
<?php if ($ShopFabrications->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_ShopFabrication_Idn" class="form-group"></span>
<input type="hidden" data-table="ShopFabrications" data-field="x_ShopFabrication_Idn" name="o<?php echo $ShopFabrications_list->RowIndex ?>_ShopFabrication_Idn" id="o<?php echo $ShopFabrications_list->RowIndex ?>_ShopFabrication_Idn" value="<?php echo HtmlEncode($ShopFabrications_list->ShopFabrication_Idn->OldValue) ?>">
<?php } ?>
<?php if ($ShopFabrications->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_ShopFabrication_Idn" class="form-group">
<span<?php echo $ShopFabrications_list->ShopFabrication_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ShopFabrications_list->ShopFabrication_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_ShopFabrication_Idn" name="x<?php echo $ShopFabrications_list->RowIndex ?>_ShopFabrication_Idn" id="x<?php echo $ShopFabrications_list->RowIndex ?>_ShopFabrication_Idn" value="<?php echo HtmlEncode($ShopFabrications_list->ShopFabrication_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($ShopFabrications->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_ShopFabrication_Idn">
<span<?php echo $ShopFabrications_list->ShopFabrication_Idn->viewAttributes() ?>><?php echo $ShopFabrications_list->ShopFabrication_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $ShopFabrications_list->Name->cellAttributes() ?>>
<?php if ($ShopFabrications->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Name" class="form-group">
<input type="text" data-table="ShopFabrications" data-field="x_Name" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Name" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Name->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Name->EditValue ?>"<?php echo $ShopFabrications_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_Name" name="o<?php echo $ShopFabrications_list->RowIndex ?>_Name" id="o<?php echo $ShopFabrications_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ShopFabrications_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($ShopFabrications->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Name" class="form-group">
<input type="text" data-table="ShopFabrications" data-field="x_Name" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Name" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Name->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Name->EditValue ?>"<?php echo $ShopFabrications_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ShopFabrications->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Name">
<span<?php echo $ShopFabrications_list->Name->viewAttributes() ?>><?php echo $ShopFabrications_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->Value->Visible) { // Value ?>
		<td data-name="Value" <?php echo $ShopFabrications_list->Value->cellAttributes() ?>>
<?php if ($ShopFabrications->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Value" class="form-group">
<input type="text" data-table="ShopFabrications" data-field="x_Value" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Value" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Value->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Value->EditValue ?>"<?php echo $ShopFabrications_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_Value" name="o<?php echo $ShopFabrications_list->RowIndex ?>_Value" id="o<?php echo $ShopFabrications_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($ShopFabrications_list->Value->OldValue) ?>">
<?php } ?>
<?php if ($ShopFabrications->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Value" class="form-group">
<input type="text" data-table="ShopFabrications" data-field="x_Value" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Value" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Value->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Value->EditValue ?>"<?php echo $ShopFabrications_list->Value->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ShopFabrications->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Value">
<span<?php echo $ShopFabrications_list->Value->viewAttributes() ?>><?php echo $ShopFabrications_list->Value->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $ShopFabrications_list->Rank->cellAttributes() ?>>
<?php if ($ShopFabrications->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Rank" class="form-group">
<input type="text" data-table="ShopFabrications" data-field="x_Rank" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Rank" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Rank->EditValue ?>"<?php echo $ShopFabrications_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_Rank" name="o<?php echo $ShopFabrications_list->RowIndex ?>_Rank" id="o<?php echo $ShopFabrications_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ShopFabrications_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($ShopFabrications->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Rank" class="form-group">
<input type="text" data-table="ShopFabrications" data-field="x_Rank" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Rank" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Rank->EditValue ?>"<?php echo $ShopFabrications_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ShopFabrications->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_Rank">
<span<?php echo $ShopFabrications_list->Rank->viewAttributes() ?>><?php echo $ShopFabrications_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $ShopFabrications_list->ActiveFlag->cellAttributes() ?>>
<?php if ($ShopFabrications->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ShopFabrications_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ShopFabrications" data-field="x_ActiveFlag" name="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]_279459" value="1"<?php echo $selwrk ?><?php echo $ShopFabrications_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]_279459"></label>
</div>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_ActiveFlag" name="o<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ShopFabrications_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($ShopFabrications->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ShopFabrications_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ShopFabrications" data-field="x_ActiveFlag" name="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]_707360" value="1"<?php echo $selwrk ?><?php echo $ShopFabrications_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]_707360"></label>
</div>
</span>
<?php } ?>
<?php if ($ShopFabrications->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ShopFabrications_list->RowCount ?>_ShopFabrications_ActiveFlag">
<span<?php echo $ShopFabrications_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ShopFabrications_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ShopFabrications_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ShopFabrications_list->ListOptions->render("body", "right", $ShopFabrications_list->RowCount);
?>
	</tr>
<?php if ($ShopFabrications->RowType == ROWTYPE_ADD || $ShopFabrications->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fShopFabricationslist", "load"], function() {
	fShopFabricationslist.updateLists(<?php echo $ShopFabrications_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ShopFabrications_list->isGridAdd())
		if (!$ShopFabrications_list->Recordset->EOF)
			$ShopFabrications_list->Recordset->moveNext();
}
?>
<?php
	if ($ShopFabrications_list->isGridAdd() || $ShopFabrications_list->isGridEdit()) {
		$ShopFabrications_list->RowIndex = '$rowindex$';
		$ShopFabrications_list->loadRowValues();

		// Set row properties
		$ShopFabrications->resetAttributes();
		$ShopFabrications->RowAttrs->merge(["data-rowindex" => $ShopFabrications_list->RowIndex, "id" => "r0_ShopFabrications", "data-rowtype" => ROWTYPE_ADD]);
		$ShopFabrications->RowAttrs->appendClass("ew-template");
		$ShopFabrications->RowType = ROWTYPE_ADD;

		// Render row
		$ShopFabrications_list->renderRow();

		// Render list options
		$ShopFabrications_list->renderListOptions();
		$ShopFabrications_list->StartRowCount = 0;
?>
	<tr <?php echo $ShopFabrications->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ShopFabrications_list->ListOptions->render("body", "left", $ShopFabrications_list->RowIndex);
?>
	<?php if ($ShopFabrications_list->ShopFabrication_Idn->Visible) { // ShopFabrication_Idn ?>
		<td data-name="ShopFabrication_Idn">
<span id="el$rowindex$_ShopFabrications_ShopFabrication_Idn" class="form-group ShopFabrications_ShopFabrication_Idn"></span>
<input type="hidden" data-table="ShopFabrications" data-field="x_ShopFabrication_Idn" name="o<?php echo $ShopFabrications_list->RowIndex ?>_ShopFabrication_Idn" id="o<?php echo $ShopFabrications_list->RowIndex ?>_ShopFabrication_Idn" value="<?php echo HtmlEncode($ShopFabrications_list->ShopFabrication_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_ShopFabrications_Name" class="form-group ShopFabrications_Name">
<input type="text" data-table="ShopFabrications" data-field="x_Name" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Name" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Name->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Name->EditValue ?>"<?php echo $ShopFabrications_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_Name" name="o<?php echo $ShopFabrications_list->RowIndex ?>_Name" id="o<?php echo $ShopFabrications_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($ShopFabrications_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->Value->Visible) { // Value ?>
		<td data-name="Value">
<span id="el$rowindex$_ShopFabrications_Value" class="form-group ShopFabrications_Value">
<input type="text" data-table="ShopFabrications" data-field="x_Value" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Value" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Value->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Value->EditValue ?>"<?php echo $ShopFabrications_list->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_Value" name="o<?php echo $ShopFabrications_list->RowIndex ?>_Value" id="o<?php echo $ShopFabrications_list->RowIndex ?>_Value" value="<?php echo HtmlEncode($ShopFabrications_list->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_ShopFabrications_Rank" class="form-group ShopFabrications_Rank">
<input type="text" data-table="ShopFabrications" data-field="x_Rank" name="x<?php echo $ShopFabrications_list->RowIndex ?>_Rank" id="x<?php echo $ShopFabrications_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ShopFabrications_list->Rank->getPlaceHolder()) ?>" value="<?php echo $ShopFabrications_list->Rank->EditValue ?>"<?php echo $ShopFabrications_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_Rank" name="o<?php echo $ShopFabrications_list->RowIndex ?>_Rank" id="o<?php echo $ShopFabrications_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($ShopFabrications_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabrications_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_ShopFabrications_ActiveFlag" class="form-group ShopFabrications_ActiveFlag">
<?php
$selwrk = ConvertToBool($ShopFabrications_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ShopFabrications" data-field="x_ActiveFlag" name="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]_670442" value="1"<?php echo $selwrk ?><?php echo $ShopFabrications_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]_670442"></label>
</div>
</span>
<input type="hidden" data-table="ShopFabrications" data-field="x_ActiveFlag" name="o<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ShopFabrications_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ShopFabrications_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ShopFabrications_list->ListOptions->render("body", "right", $ShopFabrications_list->RowIndex);
?>
<script>
loadjs.ready(["fShopFabricationslist", "load"], function() {
	fShopFabricationslist.updateLists(<?php echo $ShopFabrications_list->RowIndex ?>);
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
<?php if ($ShopFabrications_list->isAdd() || $ShopFabrications_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $ShopFabrications_list->FormKeyCountName ?>" id="<?php echo $ShopFabrications_list->FormKeyCountName ?>" value="<?php echo $ShopFabrications_list->KeyCount ?>">
<?php } ?>
<?php if ($ShopFabrications_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $ShopFabrications_list->FormKeyCountName ?>" id="<?php echo $ShopFabrications_list->FormKeyCountName ?>" value="<?php echo $ShopFabrications_list->KeyCount ?>">
<?php echo $ShopFabrications_list->MultiSelectKey ?>
<?php } ?>
<?php if ($ShopFabrications_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $ShopFabrications_list->FormKeyCountName ?>" id="<?php echo $ShopFabrications_list->FormKeyCountName ?>" value="<?php echo $ShopFabrications_list->KeyCount ?>">
<?php } ?>
<?php if ($ShopFabrications_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $ShopFabrications_list->FormKeyCountName ?>" id="<?php echo $ShopFabrications_list->FormKeyCountName ?>" value="<?php echo $ShopFabrications_list->KeyCount ?>">
<?php echo $ShopFabrications_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$ShopFabrications->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ShopFabrications_list->Recordset)
	$ShopFabrications_list->Recordset->Close();
?>
<?php if (!$ShopFabrications_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ShopFabrications_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ShopFabrications_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ShopFabrications_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ShopFabrications_list->TotalRecords == 0 && !$ShopFabrications->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ShopFabrications_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ShopFabrications_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ShopFabrications_list->isExport()) { ?>
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
$ShopFabrications_list->terminate();
?>