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
$FirePumpAttributes_list = new FirePumpAttributes_list();

// Run the page
$FirePumpAttributes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$FirePumpAttributes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$FirePumpAttributes_list->isExport()) { ?>
<script>
var fFirePumpAttributeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fFirePumpAttributeslist = currentForm = new ew.Form("fFirePumpAttributeslist", "list");
	fFirePumpAttributeslist.formKeyCountName = '<?php echo $FirePumpAttributes_list->FormKeyCountName ?>';

	// Validate form
	fFirePumpAttributeslist.validate = function() {
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
			<?php if ($FirePumpAttributes_list->FirePumpAttribute_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_FirePumpAttribute_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpAttributes_list->FirePumpAttribute_Idn->caption(), $FirePumpAttributes_list->FirePumpAttribute_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FirePumpAttributes_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpAttributes_list->Name->caption(), $FirePumpAttributes_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FirePumpAttributes_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpAttributes_list->Rank->caption(), $FirePumpAttributes_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($FirePumpAttributes_list->Rank->errorMessage()) ?>");
			<?php if ($FirePumpAttributes_list->DefaultFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_DefaultFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpAttributes_list->DefaultFlag->caption(), $FirePumpAttributes_list->DefaultFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($FirePumpAttributes_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $FirePumpAttributes_list->ActiveFlag->caption(), $FirePumpAttributes_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fFirePumpAttributeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "DefaultFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fFirePumpAttributeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fFirePumpAttributeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fFirePumpAttributeslist.lists["x_DefaultFlag[]"] = <?php echo $FirePumpAttributes_list->DefaultFlag->Lookup->toClientList($FirePumpAttributes_list) ?>;
	fFirePumpAttributeslist.lists["x_DefaultFlag[]"].options = <?php echo JsonEncode($FirePumpAttributes_list->DefaultFlag->options(FALSE, TRUE)) ?>;
	fFirePumpAttributeslist.lists["x_ActiveFlag[]"] = <?php echo $FirePumpAttributes_list->ActiveFlag->Lookup->toClientList($FirePumpAttributes_list) ?>;
	fFirePumpAttributeslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($FirePumpAttributes_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fFirePumpAttributeslist");
});
var fFirePumpAttributeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fFirePumpAttributeslistsrch = currentSearchForm = new ew.Form("fFirePumpAttributeslistsrch");

	// Dynamic selection lists
	// Filters

	fFirePumpAttributeslistsrch.filterList = <?php echo $FirePumpAttributes_list->getFilterList() ?>;
	loadjs.done("fFirePumpAttributeslistsrch");
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
<?php if (!$FirePumpAttributes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($FirePumpAttributes_list->TotalRecords > 0 && $FirePumpAttributes_list->ExportOptions->visible()) { ?>
<?php $FirePumpAttributes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($FirePumpAttributes_list->ImportOptions->visible()) { ?>
<?php $FirePumpAttributes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($FirePumpAttributes_list->SearchOptions->visible()) { ?>
<?php $FirePumpAttributes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($FirePumpAttributes_list->FilterOptions->visible()) { ?>
<?php $FirePumpAttributes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$FirePumpAttributes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$FirePumpAttributes_list->isExport() && !$FirePumpAttributes->CurrentAction) { ?>
<form name="fFirePumpAttributeslistsrch" id="fFirePumpAttributeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fFirePumpAttributeslistsrch-search-panel" class="<?php echo $FirePumpAttributes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="FirePumpAttributes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $FirePumpAttributes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($FirePumpAttributes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($FirePumpAttributes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $FirePumpAttributes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($FirePumpAttributes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($FirePumpAttributes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($FirePumpAttributes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($FirePumpAttributes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $FirePumpAttributes_list->showPageHeader(); ?>
<?php
$FirePumpAttributes_list->showMessage();
?>
<?php if ($FirePumpAttributes_list->TotalRecords > 0 || $FirePumpAttributes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($FirePumpAttributes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> FirePumpAttributes">
<?php if (!$FirePumpAttributes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$FirePumpAttributes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FirePumpAttributes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $FirePumpAttributes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fFirePumpAttributeslist" id="fFirePumpAttributeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="FirePumpAttributes">
<div id="gmp_FirePumpAttributes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($FirePumpAttributes_list->TotalRecords > 0 || $FirePumpAttributes_list->isAdd() || $FirePumpAttributes_list->isCopy() || $FirePumpAttributes_list->isGridEdit()) { ?>
<table id="tbl_FirePumpAttributeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$FirePumpAttributes->RowType = ROWTYPE_HEADER;

// Render list options
$FirePumpAttributes_list->renderListOptions();

// Render list options (header, left)
$FirePumpAttributes_list->ListOptions->render("header", "left");
?>
<?php if ($FirePumpAttributes_list->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
	<?php if ($FirePumpAttributes_list->SortUrl($FirePumpAttributes_list->FirePumpAttribute_Idn) == "") { ?>
		<th data-name="FirePumpAttribute_Idn" class="<?php echo $FirePumpAttributes_list->FirePumpAttribute_Idn->headerCellClass() ?>"><div id="elh_FirePumpAttributes_FirePumpAttribute_Idn" class="FirePumpAttributes_FirePumpAttribute_Idn"><div class="ew-table-header-caption"><?php echo $FirePumpAttributes_list->FirePumpAttribute_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirePumpAttribute_Idn" class="<?php echo $FirePumpAttributes_list->FirePumpAttribute_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FirePumpAttributes_list->SortUrl($FirePumpAttributes_list->FirePumpAttribute_Idn) ?>', 1);"><div id="elh_FirePumpAttributes_FirePumpAttribute_Idn" class="FirePumpAttributes_FirePumpAttribute_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FirePumpAttributes_list->FirePumpAttribute_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($FirePumpAttributes_list->FirePumpAttribute_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FirePumpAttributes_list->FirePumpAttribute_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FirePumpAttributes_list->Name->Visible) { // Name ?>
	<?php if ($FirePumpAttributes_list->SortUrl($FirePumpAttributes_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $FirePumpAttributes_list->Name->headerCellClass() ?>"><div id="elh_FirePumpAttributes_Name" class="FirePumpAttributes_Name"><div class="ew-table-header-caption"><?php echo $FirePumpAttributes_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $FirePumpAttributes_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FirePumpAttributes_list->SortUrl($FirePumpAttributes_list->Name) ?>', 1);"><div id="elh_FirePumpAttributes_Name" class="FirePumpAttributes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FirePumpAttributes_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($FirePumpAttributes_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FirePumpAttributes_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FirePumpAttributes_list->Rank->Visible) { // Rank ?>
	<?php if ($FirePumpAttributes_list->SortUrl($FirePumpAttributes_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $FirePumpAttributes_list->Rank->headerCellClass() ?>"><div id="elh_FirePumpAttributes_Rank" class="FirePumpAttributes_Rank"><div class="ew-table-header-caption"><?php echo $FirePumpAttributes_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $FirePumpAttributes_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FirePumpAttributes_list->SortUrl($FirePumpAttributes_list->Rank) ?>', 1);"><div id="elh_FirePumpAttributes_Rank" class="FirePumpAttributes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FirePumpAttributes_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($FirePumpAttributes_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FirePumpAttributes_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FirePumpAttributes_list->DefaultFlag->Visible) { // DefaultFlag ?>
	<?php if ($FirePumpAttributes_list->SortUrl($FirePumpAttributes_list->DefaultFlag) == "") { ?>
		<th data-name="DefaultFlag" class="<?php echo $FirePumpAttributes_list->DefaultFlag->headerCellClass() ?>"><div id="elh_FirePumpAttributes_DefaultFlag" class="FirePumpAttributes_DefaultFlag"><div class="ew-table-header-caption"><?php echo $FirePumpAttributes_list->DefaultFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DefaultFlag" class="<?php echo $FirePumpAttributes_list->DefaultFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FirePumpAttributes_list->SortUrl($FirePumpAttributes_list->DefaultFlag) ?>', 1);"><div id="elh_FirePumpAttributes_DefaultFlag" class="FirePumpAttributes_DefaultFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FirePumpAttributes_list->DefaultFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($FirePumpAttributes_list->DefaultFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FirePumpAttributes_list->DefaultFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($FirePumpAttributes_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($FirePumpAttributes_list->SortUrl($FirePumpAttributes_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $FirePumpAttributes_list->ActiveFlag->headerCellClass() ?>"><div id="elh_FirePumpAttributes_ActiveFlag" class="FirePumpAttributes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $FirePumpAttributes_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $FirePumpAttributes_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $FirePumpAttributes_list->SortUrl($FirePumpAttributes_list->ActiveFlag) ?>', 1);"><div id="elh_FirePumpAttributes_ActiveFlag" class="FirePumpAttributes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $FirePumpAttributes_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($FirePumpAttributes_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($FirePumpAttributes_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$FirePumpAttributes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($FirePumpAttributes_list->isAdd() || $FirePumpAttributes_list->isCopy()) {
		$FirePumpAttributes_list->RowIndex = 0;
		$FirePumpAttributes_list->KeyCount = $FirePumpAttributes_list->RowIndex;
		if ($FirePumpAttributes_list->isCopy() && !$FirePumpAttributes_list->loadRow())
			$FirePumpAttributes->CurrentAction = "add";
		if ($FirePumpAttributes_list->isAdd())
			$FirePumpAttributes_list->loadRowValues();
		if ($FirePumpAttributes->EventCancelled) // Insert failed
			$FirePumpAttributes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$FirePumpAttributes->resetAttributes();
		$FirePumpAttributes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_FirePumpAttributes", "data-rowtype" => ROWTYPE_ADD]);
		$FirePumpAttributes->RowType = ROWTYPE_ADD;

		// Render row
		$FirePumpAttributes_list->renderRow();

		// Render list options
		$FirePumpAttributes_list->renderListOptions();
		$FirePumpAttributes_list->StartRowCount = 0;
?>
	<tr <?php echo $FirePumpAttributes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FirePumpAttributes_list->ListOptions->render("body", "left", $FirePumpAttributes_list->RowCount);
?>
	<?php if ($FirePumpAttributes_list->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
		<td data-name="FirePumpAttribute_Idn">
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_FirePumpAttribute_Idn" class="form-group FirePumpAttributes_FirePumpAttribute_Idn"></span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_FirePumpAttribute_Idn" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_FirePumpAttribute_Idn" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_FirePumpAttribute_Idn" value="<?php echo HtmlEncode($FirePumpAttributes_list->FirePumpAttribute_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_Name" class="form-group FirePumpAttributes_Name">
<input type="text" data-table="FirePumpAttributes" data-field="x_Name" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FirePumpAttributes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FirePumpAttributes_list->Name->EditValue ?>"<?php echo $FirePumpAttributes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_Name" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FirePumpAttributes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_Rank" class="form-group FirePumpAttributes_Rank">
<input type="text" data-table="FirePumpAttributes" data-field="x_Rank" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FirePumpAttributes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FirePumpAttributes_list->Rank->EditValue ?>"<?php echo $FirePumpAttributes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_Rank" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FirePumpAttributes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->DefaultFlag->Visible) { // DefaultFlag ?>
		<td data-name="DefaultFlag">
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_DefaultFlag" class="form-group FirePumpAttributes_DefaultFlag">
<?php
$selwrk = ConvertToBool($FirePumpAttributes_list->DefaultFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpAttributes" data-field="x_DefaultFlag" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]_860874" value="1"<?php echo $selwrk ?><?php echo $FirePumpAttributes_list->DefaultFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]_860874"></label>
</div>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_DefaultFlag" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]" value="<?php echo HtmlEncode($FirePumpAttributes_list->DefaultFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_ActiveFlag" class="form-group FirePumpAttributes_ActiveFlag">
<?php
$selwrk = ConvertToBool($FirePumpAttributes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpAttributes" data-field="x_ActiveFlag" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]_974734" value="1"<?php echo $selwrk ?><?php echo $FirePumpAttributes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]_974734"></label>
</div>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_ActiveFlag" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FirePumpAttributes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FirePumpAttributes_list->ListOptions->render("body", "right", $FirePumpAttributes_list->RowCount);
?>
<script>
loadjs.ready(["fFirePumpAttributeslist", "load"], function() {
	fFirePumpAttributeslist.updateLists(<?php echo $FirePumpAttributes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($FirePumpAttributes_list->ExportAll && $FirePumpAttributes_list->isExport()) {
	$FirePumpAttributes_list->StopRecord = $FirePumpAttributes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($FirePumpAttributes_list->TotalRecords > $FirePumpAttributes_list->StartRecord + $FirePumpAttributes_list->DisplayRecords - 1)
		$FirePumpAttributes_list->StopRecord = $FirePumpAttributes_list->StartRecord + $FirePumpAttributes_list->DisplayRecords - 1;
	else
		$FirePumpAttributes_list->StopRecord = $FirePumpAttributes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($FirePumpAttributes->isConfirm() || $FirePumpAttributes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($FirePumpAttributes_list->FormKeyCountName) && ($FirePumpAttributes_list->isGridAdd() || $FirePumpAttributes_list->isGridEdit() || $FirePumpAttributes->isConfirm())) {
		$FirePumpAttributes_list->KeyCount = $CurrentForm->getValue($FirePumpAttributes_list->FormKeyCountName);
		$FirePumpAttributes_list->StopRecord = $FirePumpAttributes_list->StartRecord + $FirePumpAttributes_list->KeyCount - 1;
	}
}
$FirePumpAttributes_list->RecordCount = $FirePumpAttributes_list->StartRecord - 1;
if ($FirePumpAttributes_list->Recordset && !$FirePumpAttributes_list->Recordset->EOF) {
	$FirePumpAttributes_list->Recordset->moveFirst();
	$selectLimit = $FirePumpAttributes_list->UseSelectLimit;
	if (!$selectLimit && $FirePumpAttributes_list->StartRecord > 1)
		$FirePumpAttributes_list->Recordset->move($FirePumpAttributes_list->StartRecord - 1);
} elseif (!$FirePumpAttributes->AllowAddDeleteRow && $FirePumpAttributes_list->StopRecord == 0) {
	$FirePumpAttributes_list->StopRecord = $FirePumpAttributes->GridAddRowCount;
}

// Initialize aggregate
$FirePumpAttributes->RowType = ROWTYPE_AGGREGATEINIT;
$FirePumpAttributes->resetAttributes();
$FirePumpAttributes_list->renderRow();
$FirePumpAttributes_list->EditRowCount = 0;
if ($FirePumpAttributes_list->isEdit())
	$FirePumpAttributes_list->RowIndex = 1;
if ($FirePumpAttributes_list->isGridAdd())
	$FirePumpAttributes_list->RowIndex = 0;
if ($FirePumpAttributes_list->isGridEdit())
	$FirePumpAttributes_list->RowIndex = 0;
while ($FirePumpAttributes_list->RecordCount < $FirePumpAttributes_list->StopRecord) {
	$FirePumpAttributes_list->RecordCount++;
	if ($FirePumpAttributes_list->RecordCount >= $FirePumpAttributes_list->StartRecord) {
		$FirePumpAttributes_list->RowCount++;
		if ($FirePumpAttributes_list->isGridAdd() || $FirePumpAttributes_list->isGridEdit() || $FirePumpAttributes->isConfirm()) {
			$FirePumpAttributes_list->RowIndex++;
			$CurrentForm->Index = $FirePumpAttributes_list->RowIndex;
			if ($CurrentForm->hasValue($FirePumpAttributes_list->FormActionName) && ($FirePumpAttributes->isConfirm() || $FirePumpAttributes_list->EventCancelled))
				$FirePumpAttributes_list->RowAction = strval($CurrentForm->getValue($FirePumpAttributes_list->FormActionName));
			elseif ($FirePumpAttributes_list->isGridAdd())
				$FirePumpAttributes_list->RowAction = "insert";
			else
				$FirePumpAttributes_list->RowAction = "";
		}

		// Set up key count
		$FirePumpAttributes_list->KeyCount = $FirePumpAttributes_list->RowIndex;

		// Init row class and style
		$FirePumpAttributes->resetAttributes();
		$FirePumpAttributes->CssClass = "";
		if ($FirePumpAttributes_list->isGridAdd()) {
			$FirePumpAttributes_list->loadRowValues(); // Load default values
		} else {
			$FirePumpAttributes_list->loadRowValues($FirePumpAttributes_list->Recordset); // Load row values
		}
		$FirePumpAttributes->RowType = ROWTYPE_VIEW; // Render view
		if ($FirePumpAttributes_list->isGridAdd()) // Grid add
			$FirePumpAttributes->RowType = ROWTYPE_ADD; // Render add
		if ($FirePumpAttributes_list->isGridAdd() && $FirePumpAttributes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$FirePumpAttributes_list->restoreCurrentRowFormValues($FirePumpAttributes_list->RowIndex); // Restore form values
		if ($FirePumpAttributes_list->isEdit()) {
			if ($FirePumpAttributes_list->checkInlineEditKey() && $FirePumpAttributes_list->EditRowCount == 0) { // Inline edit
				$FirePumpAttributes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($FirePumpAttributes_list->isGridEdit()) { // Grid edit
			if ($FirePumpAttributes->EventCancelled)
				$FirePumpAttributes_list->restoreCurrentRowFormValues($FirePumpAttributes_list->RowIndex); // Restore form values
			if ($FirePumpAttributes_list->RowAction == "insert")
				$FirePumpAttributes->RowType = ROWTYPE_ADD; // Render add
			else
				$FirePumpAttributes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($FirePumpAttributes_list->isEdit() && $FirePumpAttributes->RowType == ROWTYPE_EDIT && $FirePumpAttributes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$FirePumpAttributes_list->restoreFormValues(); // Restore form values
		}
		if ($FirePumpAttributes_list->isGridEdit() && ($FirePumpAttributes->RowType == ROWTYPE_EDIT || $FirePumpAttributes->RowType == ROWTYPE_ADD) && $FirePumpAttributes->EventCancelled) // Update failed
			$FirePumpAttributes_list->restoreCurrentRowFormValues($FirePumpAttributes_list->RowIndex); // Restore form values
		if ($FirePumpAttributes->RowType == ROWTYPE_EDIT) // Edit row
			$FirePumpAttributes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$FirePumpAttributes->RowAttrs->merge(["data-rowindex" => $FirePumpAttributes_list->RowCount, "id" => "r" . $FirePumpAttributes_list->RowCount . "_FirePumpAttributes", "data-rowtype" => $FirePumpAttributes->RowType]);

		// Render row
		$FirePumpAttributes_list->renderRow();

		// Render list options
		$FirePumpAttributes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($FirePumpAttributes_list->RowAction != "delete" && $FirePumpAttributes_list->RowAction != "insertdelete" && !($FirePumpAttributes_list->RowAction == "insert" && $FirePumpAttributes->isConfirm() && $FirePumpAttributes_list->emptyRow())) {
?>
	<tr <?php echo $FirePumpAttributes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FirePumpAttributes_list->ListOptions->render("body", "left", $FirePumpAttributes_list->RowCount);
?>
	<?php if ($FirePumpAttributes_list->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
		<td data-name="FirePumpAttribute_Idn" <?php echo $FirePumpAttributes_list->FirePumpAttribute_Idn->cellAttributes() ?>>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_FirePumpAttribute_Idn" class="form-group"></span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_FirePumpAttribute_Idn" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_FirePumpAttribute_Idn" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_FirePumpAttribute_Idn" value="<?php echo HtmlEncode($FirePumpAttributes_list->FirePumpAttribute_Idn->OldValue) ?>">
<?php } ?>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_FirePumpAttribute_Idn" class="form-group">
<span<?php echo $FirePumpAttributes_list->FirePumpAttribute_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($FirePumpAttributes_list->FirePumpAttribute_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_FirePumpAttribute_Idn" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_FirePumpAttribute_Idn" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_FirePumpAttribute_Idn" value="<?php echo HtmlEncode($FirePumpAttributes_list->FirePumpAttribute_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_FirePumpAttribute_Idn">
<span<?php echo $FirePumpAttributes_list->FirePumpAttribute_Idn->viewAttributes() ?>><?php echo $FirePumpAttributes_list->FirePumpAttribute_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $FirePumpAttributes_list->Name->cellAttributes() ?>>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_Name" class="form-group">
<input type="text" data-table="FirePumpAttributes" data-field="x_Name" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FirePumpAttributes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FirePumpAttributes_list->Name->EditValue ?>"<?php echo $FirePumpAttributes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_Name" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FirePumpAttributes_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_Name" class="form-group">
<input type="text" data-table="FirePumpAttributes" data-field="x_Name" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FirePumpAttributes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FirePumpAttributes_list->Name->EditValue ?>"<?php echo $FirePumpAttributes_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_Name">
<span<?php echo $FirePumpAttributes_list->Name->viewAttributes() ?>><?php echo $FirePumpAttributes_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $FirePumpAttributes_list->Rank->cellAttributes() ?>>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_Rank" class="form-group">
<input type="text" data-table="FirePumpAttributes" data-field="x_Rank" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FirePumpAttributes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FirePumpAttributes_list->Rank->EditValue ?>"<?php echo $FirePumpAttributes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_Rank" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FirePumpAttributes_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_Rank" class="form-group">
<input type="text" data-table="FirePumpAttributes" data-field="x_Rank" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FirePumpAttributes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FirePumpAttributes_list->Rank->EditValue ?>"<?php echo $FirePumpAttributes_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_Rank">
<span<?php echo $FirePumpAttributes_list->Rank->viewAttributes() ?>><?php echo $FirePumpAttributes_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->DefaultFlag->Visible) { // DefaultFlag ?>
		<td data-name="DefaultFlag" <?php echo $FirePumpAttributes_list->DefaultFlag->cellAttributes() ?>>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_DefaultFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FirePumpAttributes_list->DefaultFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpAttributes" data-field="x_DefaultFlag" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]_606605" value="1"<?php echo $selwrk ?><?php echo $FirePumpAttributes_list->DefaultFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]_606605"></label>
</div>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_DefaultFlag" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]" value="<?php echo HtmlEncode($FirePumpAttributes_list->DefaultFlag->OldValue) ?>">
<?php } ?>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_DefaultFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FirePumpAttributes_list->DefaultFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpAttributes" data-field="x_DefaultFlag" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]_356804" value="1"<?php echo $selwrk ?><?php echo $FirePumpAttributes_list->DefaultFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]_356804"></label>
</div>
</span>
<?php } ?>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_DefaultFlag">
<span<?php echo $FirePumpAttributes_list->DefaultFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_DefaultFlag" class="custom-control-input" value="<?php echo $FirePumpAttributes_list->DefaultFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FirePumpAttributes_list->DefaultFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_DefaultFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $FirePumpAttributes_list->ActiveFlag->cellAttributes() ?>>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FirePumpAttributes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpAttributes" data-field="x_ActiveFlag" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]_441221" value="1"<?php echo $selwrk ?><?php echo $FirePumpAttributes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]_441221"></label>
</div>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_ActiveFlag" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FirePumpAttributes_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($FirePumpAttributes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpAttributes" data-field="x_ActiveFlag" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]_632689" value="1"<?php echo $selwrk ?><?php echo $FirePumpAttributes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]_632689"></label>
</div>
</span>
<?php } ?>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $FirePumpAttributes_list->RowCount ?>_FirePumpAttributes_ActiveFlag">
<span<?php echo $FirePumpAttributes_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $FirePumpAttributes_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($FirePumpAttributes_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FirePumpAttributes_list->ListOptions->render("body", "right", $FirePumpAttributes_list->RowCount);
?>
	</tr>
<?php if ($FirePumpAttributes->RowType == ROWTYPE_ADD || $FirePumpAttributes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fFirePumpAttributeslist", "load"], function() {
	fFirePumpAttributeslist.updateLists(<?php echo $FirePumpAttributes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$FirePumpAttributes_list->isGridAdd())
		if (!$FirePumpAttributes_list->Recordset->EOF)
			$FirePumpAttributes_list->Recordset->moveNext();
}
?>
<?php
	if ($FirePumpAttributes_list->isGridAdd() || $FirePumpAttributes_list->isGridEdit()) {
		$FirePumpAttributes_list->RowIndex = '$rowindex$';
		$FirePumpAttributes_list->loadRowValues();

		// Set row properties
		$FirePumpAttributes->resetAttributes();
		$FirePumpAttributes->RowAttrs->merge(["data-rowindex" => $FirePumpAttributes_list->RowIndex, "id" => "r0_FirePumpAttributes", "data-rowtype" => ROWTYPE_ADD]);
		$FirePumpAttributes->RowAttrs->appendClass("ew-template");
		$FirePumpAttributes->RowType = ROWTYPE_ADD;

		// Render row
		$FirePumpAttributes_list->renderRow();

		// Render list options
		$FirePumpAttributes_list->renderListOptions();
		$FirePumpAttributes_list->StartRowCount = 0;
?>
	<tr <?php echo $FirePumpAttributes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$FirePumpAttributes_list->ListOptions->render("body", "left", $FirePumpAttributes_list->RowIndex);
?>
	<?php if ($FirePumpAttributes_list->FirePumpAttribute_Idn->Visible) { // FirePumpAttribute_Idn ?>
		<td data-name="FirePumpAttribute_Idn">
<span id="el$rowindex$_FirePumpAttributes_FirePumpAttribute_Idn" class="form-group FirePumpAttributes_FirePumpAttribute_Idn"></span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_FirePumpAttribute_Idn" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_FirePumpAttribute_Idn" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_FirePumpAttribute_Idn" value="<?php echo HtmlEncode($FirePumpAttributes_list->FirePumpAttribute_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_FirePumpAttributes_Name" class="form-group FirePumpAttributes_Name">
<input type="text" data-table="FirePumpAttributes" data-field="x_Name" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($FirePumpAttributes_list->Name->getPlaceHolder()) ?>" value="<?php echo $FirePumpAttributes_list->Name->EditValue ?>"<?php echo $FirePumpAttributes_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_Name" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($FirePumpAttributes_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_FirePumpAttributes_Rank" class="form-group FirePumpAttributes_Rank">
<input type="text" data-table="FirePumpAttributes" data-field="x_Rank" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($FirePumpAttributes_list->Rank->getPlaceHolder()) ?>" value="<?php echo $FirePumpAttributes_list->Rank->EditValue ?>"<?php echo $FirePumpAttributes_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_Rank" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($FirePumpAttributes_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->DefaultFlag->Visible) { // DefaultFlag ?>
		<td data-name="DefaultFlag">
<span id="el$rowindex$_FirePumpAttributes_DefaultFlag" class="form-group FirePumpAttributes_DefaultFlag">
<?php
$selwrk = ConvertToBool($FirePumpAttributes_list->DefaultFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpAttributes" data-field="x_DefaultFlag" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]_431593" value="1"<?php echo $selwrk ?><?php echo $FirePumpAttributes_list->DefaultFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]_431593"></label>
</div>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_DefaultFlag" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_DefaultFlag[]" value="<?php echo HtmlEncode($FirePumpAttributes_list->DefaultFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($FirePumpAttributes_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_FirePumpAttributes_ActiveFlag" class="form-group FirePumpAttributes_ActiveFlag">
<?php
$selwrk = ConvertToBool($FirePumpAttributes_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="FirePumpAttributes" data-field="x_ActiveFlag" name="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]_135326" value="1"<?php echo $selwrk ?><?php echo $FirePumpAttributes_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]_135326"></label>
</div>
</span>
<input type="hidden" data-table="FirePumpAttributes" data-field="x_ActiveFlag" name="o<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $FirePumpAttributes_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($FirePumpAttributes_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$FirePumpAttributes_list->ListOptions->render("body", "right", $FirePumpAttributes_list->RowIndex);
?>
<script>
loadjs.ready(["fFirePumpAttributeslist", "load"], function() {
	fFirePumpAttributeslist.updateLists(<?php echo $FirePumpAttributes_list->RowIndex ?>);
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
<?php if ($FirePumpAttributes_list->isAdd() || $FirePumpAttributes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $FirePumpAttributes_list->FormKeyCountName ?>" id="<?php echo $FirePumpAttributes_list->FormKeyCountName ?>" value="<?php echo $FirePumpAttributes_list->KeyCount ?>">
<?php } ?>
<?php if ($FirePumpAttributes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $FirePumpAttributes_list->FormKeyCountName ?>" id="<?php echo $FirePumpAttributes_list->FormKeyCountName ?>" value="<?php echo $FirePumpAttributes_list->KeyCount ?>">
<?php echo $FirePumpAttributes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($FirePumpAttributes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $FirePumpAttributes_list->FormKeyCountName ?>" id="<?php echo $FirePumpAttributes_list->FormKeyCountName ?>" value="<?php echo $FirePumpAttributes_list->KeyCount ?>">
<?php } ?>
<?php if ($FirePumpAttributes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $FirePumpAttributes_list->FormKeyCountName ?>" id="<?php echo $FirePumpAttributes_list->FormKeyCountName ?>" value="<?php echo $FirePumpAttributes_list->KeyCount ?>">
<?php echo $FirePumpAttributes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$FirePumpAttributes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($FirePumpAttributes_list->Recordset)
	$FirePumpAttributes_list->Recordset->Close();
?>
<?php if (!$FirePumpAttributes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$FirePumpAttributes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $FirePumpAttributes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $FirePumpAttributes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($FirePumpAttributes_list->TotalRecords == 0 && !$FirePumpAttributes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $FirePumpAttributes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$FirePumpAttributes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$FirePumpAttributes_list->isExport()) { ?>
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
$FirePumpAttributes_list->terminate();
?>