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
$LiftDurations_list = new LiftDurations_list();

// Run the page
$LiftDurations_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LiftDurations_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$LiftDurations_list->isExport()) { ?>
<script>
var fLiftDurationslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fLiftDurationslist = currentForm = new ew.Form("fLiftDurationslist", "list");
	fLiftDurationslist.formKeyCountName = '<?php echo $LiftDurations_list->FormKeyCountName ?>';

	// Validate form
	fLiftDurationslist.validate = function() {
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
			<?php if ($LiftDurations_list->LiftDuration_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LiftDuration_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LiftDurations_list->LiftDuration_Idn->caption(), $LiftDurations_list->LiftDuration_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($LiftDurations_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LiftDurations_list->Name->caption(), $LiftDurations_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($LiftDurations_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LiftDurations_list->Rank->caption(), $LiftDurations_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($LiftDurations_list->Rank->errorMessage()) ?>");
			<?php if ($LiftDurations_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LiftDurations_list->ActiveFlag->caption(), $LiftDurations_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fLiftDurationslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fLiftDurationslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fLiftDurationslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fLiftDurationslist.lists["x_ActiveFlag[]"] = <?php echo $LiftDurations_list->ActiveFlag->Lookup->toClientList($LiftDurations_list) ?>;
	fLiftDurationslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($LiftDurations_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fLiftDurationslist");
});
var fLiftDurationslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fLiftDurationslistsrch = currentSearchForm = new ew.Form("fLiftDurationslistsrch");

	// Dynamic selection lists
	// Filters

	fLiftDurationslistsrch.filterList = <?php echo $LiftDurations_list->getFilterList() ?>;
	loadjs.done("fLiftDurationslistsrch");
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
<?php if (!$LiftDurations_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($LiftDurations_list->TotalRecords > 0 && $LiftDurations_list->ExportOptions->visible()) { ?>
<?php $LiftDurations_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($LiftDurations_list->ImportOptions->visible()) { ?>
<?php $LiftDurations_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($LiftDurations_list->SearchOptions->visible()) { ?>
<?php $LiftDurations_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($LiftDurations_list->FilterOptions->visible()) { ?>
<?php $LiftDurations_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$LiftDurations_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$LiftDurations_list->isExport() && !$LiftDurations->CurrentAction) { ?>
<form name="fLiftDurationslistsrch" id="fLiftDurationslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fLiftDurationslistsrch-search-panel" class="<?php echo $LiftDurations_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="LiftDurations">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $LiftDurations_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($LiftDurations_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($LiftDurations_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $LiftDurations_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($LiftDurations_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($LiftDurations_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($LiftDurations_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($LiftDurations_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $LiftDurations_list->showPageHeader(); ?>
<?php
$LiftDurations_list->showMessage();
?>
<?php if ($LiftDurations_list->TotalRecords > 0 || $LiftDurations->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($LiftDurations_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> LiftDurations">
<?php if (!$LiftDurations_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$LiftDurations_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $LiftDurations_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $LiftDurations_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fLiftDurationslist" id="fLiftDurationslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LiftDurations">
<div id="gmp_LiftDurations" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($LiftDurations_list->TotalRecords > 0 || $LiftDurations_list->isAdd() || $LiftDurations_list->isCopy() || $LiftDurations_list->isGridEdit()) { ?>
<table id="tbl_LiftDurationslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$LiftDurations->RowType = ROWTYPE_HEADER;

// Render list options
$LiftDurations_list->renderListOptions();

// Render list options (header, left)
$LiftDurations_list->ListOptions->render("header", "left");
?>
<?php if ($LiftDurations_list->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
	<?php if ($LiftDurations_list->SortUrl($LiftDurations_list->LiftDuration_Idn) == "") { ?>
		<th data-name="LiftDuration_Idn" class="<?php echo $LiftDurations_list->LiftDuration_Idn->headerCellClass() ?>"><div id="elh_LiftDurations_LiftDuration_Idn" class="LiftDurations_LiftDuration_Idn"><div class="ew-table-header-caption"><?php echo $LiftDurations_list->LiftDuration_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LiftDuration_Idn" class="<?php echo $LiftDurations_list->LiftDuration_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $LiftDurations_list->SortUrl($LiftDurations_list->LiftDuration_Idn) ?>', 1);"><div id="elh_LiftDurations_LiftDuration_Idn" class="LiftDurations_LiftDuration_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LiftDurations_list->LiftDuration_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($LiftDurations_list->LiftDuration_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($LiftDurations_list->LiftDuration_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LiftDurations_list->Name->Visible) { // Name ?>
	<?php if ($LiftDurations_list->SortUrl($LiftDurations_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $LiftDurations_list->Name->headerCellClass() ?>"><div id="elh_LiftDurations_Name" class="LiftDurations_Name"><div class="ew-table-header-caption"><?php echo $LiftDurations_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $LiftDurations_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $LiftDurations_list->SortUrl($LiftDurations_list->Name) ?>', 1);"><div id="elh_LiftDurations_Name" class="LiftDurations_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LiftDurations_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($LiftDurations_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($LiftDurations_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LiftDurations_list->Rank->Visible) { // Rank ?>
	<?php if ($LiftDurations_list->SortUrl($LiftDurations_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $LiftDurations_list->Rank->headerCellClass() ?>"><div id="elh_LiftDurations_Rank" class="LiftDurations_Rank"><div class="ew-table-header-caption"><?php echo $LiftDurations_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $LiftDurations_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $LiftDurations_list->SortUrl($LiftDurations_list->Rank) ?>', 1);"><div id="elh_LiftDurations_Rank" class="LiftDurations_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LiftDurations_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($LiftDurations_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($LiftDurations_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LiftDurations_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($LiftDurations_list->SortUrl($LiftDurations_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $LiftDurations_list->ActiveFlag->headerCellClass() ?>"><div id="elh_LiftDurations_ActiveFlag" class="LiftDurations_ActiveFlag"><div class="ew-table-header-caption"><?php echo $LiftDurations_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $LiftDurations_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $LiftDurations_list->SortUrl($LiftDurations_list->ActiveFlag) ?>', 1);"><div id="elh_LiftDurations_ActiveFlag" class="LiftDurations_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LiftDurations_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($LiftDurations_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($LiftDurations_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$LiftDurations_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($LiftDurations_list->isAdd() || $LiftDurations_list->isCopy()) {
		$LiftDurations_list->RowIndex = 0;
		$LiftDurations_list->KeyCount = $LiftDurations_list->RowIndex;
		if ($LiftDurations_list->isCopy() && !$LiftDurations_list->loadRow())
			$LiftDurations->CurrentAction = "add";
		if ($LiftDurations_list->isAdd())
			$LiftDurations_list->loadRowValues();
		if ($LiftDurations->EventCancelled) // Insert failed
			$LiftDurations_list->restoreFormValues(); // Restore form values

		// Set row properties
		$LiftDurations->resetAttributes();
		$LiftDurations->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_LiftDurations", "data-rowtype" => ROWTYPE_ADD]);
		$LiftDurations->RowType = ROWTYPE_ADD;

		// Render row
		$LiftDurations_list->renderRow();

		// Render list options
		$LiftDurations_list->renderListOptions();
		$LiftDurations_list->StartRowCount = 0;
?>
	<tr <?php echo $LiftDurations->rowAttributes() ?>>
<?php

// Render list options (body, left)
$LiftDurations_list->ListOptions->render("body", "left", $LiftDurations_list->RowCount);
?>
	<?php if ($LiftDurations_list->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
		<td data-name="LiftDuration_Idn">
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_LiftDuration_Idn" class="form-group LiftDurations_LiftDuration_Idn"></span>
<input type="hidden" data-table="LiftDurations" data-field="x_LiftDuration_Idn" name="o<?php echo $LiftDurations_list->RowIndex ?>_LiftDuration_Idn" id="o<?php echo $LiftDurations_list->RowIndex ?>_LiftDuration_Idn" value="<?php echo HtmlEncode($LiftDurations_list->LiftDuration_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LiftDurations_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_Name" class="form-group LiftDurations_Name">
<input type="text" data-table="LiftDurations" data-field="x_Name" name="x<?php echo $LiftDurations_list->RowIndex ?>_Name" id="x<?php echo $LiftDurations_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($LiftDurations_list->Name->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_list->Name->EditValue ?>"<?php echo $LiftDurations_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="LiftDurations" data-field="x_Name" name="o<?php echo $LiftDurations_list->RowIndex ?>_Name" id="o<?php echo $LiftDurations_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($LiftDurations_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LiftDurations_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_Rank" class="form-group LiftDurations_Rank">
<input type="text" data-table="LiftDurations" data-field="x_Rank" name="x<?php echo $LiftDurations_list->RowIndex ?>_Rank" id="x<?php echo $LiftDurations_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($LiftDurations_list->Rank->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_list->Rank->EditValue ?>"<?php echo $LiftDurations_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="LiftDurations" data-field="x_Rank" name="o<?php echo $LiftDurations_list->RowIndex ?>_Rank" id="o<?php echo $LiftDurations_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($LiftDurations_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LiftDurations_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_ActiveFlag" class="form-group LiftDurations_ActiveFlag">
<?php
$selwrk = ConvertToBool($LiftDurations_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="LiftDurations" data-field="x_ActiveFlag" name="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]_610696" value="1"<?php echo $selwrk ?><?php echo $LiftDurations_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]_610696"></label>
</div>
</span>
<input type="hidden" data-table="LiftDurations" data-field="x_ActiveFlag" name="o<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($LiftDurations_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$LiftDurations_list->ListOptions->render("body", "right", $LiftDurations_list->RowCount);
?>
<script>
loadjs.ready(["fLiftDurationslist", "load"], function() {
	fLiftDurationslist.updateLists(<?php echo $LiftDurations_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($LiftDurations_list->ExportAll && $LiftDurations_list->isExport()) {
	$LiftDurations_list->StopRecord = $LiftDurations_list->TotalRecords;
} else {

	// Set the last record to display
	if ($LiftDurations_list->TotalRecords > $LiftDurations_list->StartRecord + $LiftDurations_list->DisplayRecords - 1)
		$LiftDurations_list->StopRecord = $LiftDurations_list->StartRecord + $LiftDurations_list->DisplayRecords - 1;
	else
		$LiftDurations_list->StopRecord = $LiftDurations_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($LiftDurations->isConfirm() || $LiftDurations_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($LiftDurations_list->FormKeyCountName) && ($LiftDurations_list->isGridAdd() || $LiftDurations_list->isGridEdit() || $LiftDurations->isConfirm())) {
		$LiftDurations_list->KeyCount = $CurrentForm->getValue($LiftDurations_list->FormKeyCountName);
		$LiftDurations_list->StopRecord = $LiftDurations_list->StartRecord + $LiftDurations_list->KeyCount - 1;
	}
}
$LiftDurations_list->RecordCount = $LiftDurations_list->StartRecord - 1;
if ($LiftDurations_list->Recordset && !$LiftDurations_list->Recordset->EOF) {
	$LiftDurations_list->Recordset->moveFirst();
	$selectLimit = $LiftDurations_list->UseSelectLimit;
	if (!$selectLimit && $LiftDurations_list->StartRecord > 1)
		$LiftDurations_list->Recordset->move($LiftDurations_list->StartRecord - 1);
} elseif (!$LiftDurations->AllowAddDeleteRow && $LiftDurations_list->StopRecord == 0) {
	$LiftDurations_list->StopRecord = $LiftDurations->GridAddRowCount;
}

// Initialize aggregate
$LiftDurations->RowType = ROWTYPE_AGGREGATEINIT;
$LiftDurations->resetAttributes();
$LiftDurations_list->renderRow();
$LiftDurations_list->EditRowCount = 0;
if ($LiftDurations_list->isEdit())
	$LiftDurations_list->RowIndex = 1;
if ($LiftDurations_list->isGridAdd())
	$LiftDurations_list->RowIndex = 0;
if ($LiftDurations_list->isGridEdit())
	$LiftDurations_list->RowIndex = 0;
while ($LiftDurations_list->RecordCount < $LiftDurations_list->StopRecord) {
	$LiftDurations_list->RecordCount++;
	if ($LiftDurations_list->RecordCount >= $LiftDurations_list->StartRecord) {
		$LiftDurations_list->RowCount++;
		if ($LiftDurations_list->isGridAdd() || $LiftDurations_list->isGridEdit() || $LiftDurations->isConfirm()) {
			$LiftDurations_list->RowIndex++;
			$CurrentForm->Index = $LiftDurations_list->RowIndex;
			if ($CurrentForm->hasValue($LiftDurations_list->FormActionName) && ($LiftDurations->isConfirm() || $LiftDurations_list->EventCancelled))
				$LiftDurations_list->RowAction = strval($CurrentForm->getValue($LiftDurations_list->FormActionName));
			elseif ($LiftDurations_list->isGridAdd())
				$LiftDurations_list->RowAction = "insert";
			else
				$LiftDurations_list->RowAction = "";
		}

		// Set up key count
		$LiftDurations_list->KeyCount = $LiftDurations_list->RowIndex;

		// Init row class and style
		$LiftDurations->resetAttributes();
		$LiftDurations->CssClass = "";
		if ($LiftDurations_list->isGridAdd()) {
			$LiftDurations_list->loadRowValues(); // Load default values
		} else {
			$LiftDurations_list->loadRowValues($LiftDurations_list->Recordset); // Load row values
		}
		$LiftDurations->RowType = ROWTYPE_VIEW; // Render view
		if ($LiftDurations_list->isGridAdd()) // Grid add
			$LiftDurations->RowType = ROWTYPE_ADD; // Render add
		if ($LiftDurations_list->isGridAdd() && $LiftDurations->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$LiftDurations_list->restoreCurrentRowFormValues($LiftDurations_list->RowIndex); // Restore form values
		if ($LiftDurations_list->isEdit()) {
			if ($LiftDurations_list->checkInlineEditKey() && $LiftDurations_list->EditRowCount == 0) { // Inline edit
				$LiftDurations->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($LiftDurations_list->isGridEdit()) { // Grid edit
			if ($LiftDurations->EventCancelled)
				$LiftDurations_list->restoreCurrentRowFormValues($LiftDurations_list->RowIndex); // Restore form values
			if ($LiftDurations_list->RowAction == "insert")
				$LiftDurations->RowType = ROWTYPE_ADD; // Render add
			else
				$LiftDurations->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($LiftDurations_list->isEdit() && $LiftDurations->RowType == ROWTYPE_EDIT && $LiftDurations->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$LiftDurations_list->restoreFormValues(); // Restore form values
		}
		if ($LiftDurations_list->isGridEdit() && ($LiftDurations->RowType == ROWTYPE_EDIT || $LiftDurations->RowType == ROWTYPE_ADD) && $LiftDurations->EventCancelled) // Update failed
			$LiftDurations_list->restoreCurrentRowFormValues($LiftDurations_list->RowIndex); // Restore form values
		if ($LiftDurations->RowType == ROWTYPE_EDIT) // Edit row
			$LiftDurations_list->EditRowCount++;

		// Set up row id / data-rowindex
		$LiftDurations->RowAttrs->merge(["data-rowindex" => $LiftDurations_list->RowCount, "id" => "r" . $LiftDurations_list->RowCount . "_LiftDurations", "data-rowtype" => $LiftDurations->RowType]);

		// Render row
		$LiftDurations_list->renderRow();

		// Render list options
		$LiftDurations_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($LiftDurations_list->RowAction != "delete" && $LiftDurations_list->RowAction != "insertdelete" && !($LiftDurations_list->RowAction == "insert" && $LiftDurations->isConfirm() && $LiftDurations_list->emptyRow())) {
?>
	<tr <?php echo $LiftDurations->rowAttributes() ?>>
<?php

// Render list options (body, left)
$LiftDurations_list->ListOptions->render("body", "left", $LiftDurations_list->RowCount);
?>
	<?php if ($LiftDurations_list->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
		<td data-name="LiftDuration_Idn" <?php echo $LiftDurations_list->LiftDuration_Idn->cellAttributes() ?>>
<?php if ($LiftDurations->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_LiftDuration_Idn" class="form-group"></span>
<input type="hidden" data-table="LiftDurations" data-field="x_LiftDuration_Idn" name="o<?php echo $LiftDurations_list->RowIndex ?>_LiftDuration_Idn" id="o<?php echo $LiftDurations_list->RowIndex ?>_LiftDuration_Idn" value="<?php echo HtmlEncode($LiftDurations_list->LiftDuration_Idn->OldValue) ?>">
<?php } ?>
<?php if ($LiftDurations->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_LiftDuration_Idn" class="form-group">
<span<?php echo $LiftDurations_list->LiftDuration_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($LiftDurations_list->LiftDuration_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="LiftDurations" data-field="x_LiftDuration_Idn" name="x<?php echo $LiftDurations_list->RowIndex ?>_LiftDuration_Idn" id="x<?php echo $LiftDurations_list->RowIndex ?>_LiftDuration_Idn" value="<?php echo HtmlEncode($LiftDurations_list->LiftDuration_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($LiftDurations->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_LiftDuration_Idn">
<span<?php echo $LiftDurations_list->LiftDuration_Idn->viewAttributes() ?>><?php echo $LiftDurations_list->LiftDuration_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LiftDurations_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $LiftDurations_list->Name->cellAttributes() ?>>
<?php if ($LiftDurations->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_Name" class="form-group">
<input type="text" data-table="LiftDurations" data-field="x_Name" name="x<?php echo $LiftDurations_list->RowIndex ?>_Name" id="x<?php echo $LiftDurations_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($LiftDurations_list->Name->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_list->Name->EditValue ?>"<?php echo $LiftDurations_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="LiftDurations" data-field="x_Name" name="o<?php echo $LiftDurations_list->RowIndex ?>_Name" id="o<?php echo $LiftDurations_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($LiftDurations_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($LiftDurations->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_Name" class="form-group">
<input type="text" data-table="LiftDurations" data-field="x_Name" name="x<?php echo $LiftDurations_list->RowIndex ?>_Name" id="x<?php echo $LiftDurations_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($LiftDurations_list->Name->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_list->Name->EditValue ?>"<?php echo $LiftDurations_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($LiftDurations->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_Name">
<span<?php echo $LiftDurations_list->Name->viewAttributes() ?>><?php echo $LiftDurations_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LiftDurations_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $LiftDurations_list->Rank->cellAttributes() ?>>
<?php if ($LiftDurations->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_Rank" class="form-group">
<input type="text" data-table="LiftDurations" data-field="x_Rank" name="x<?php echo $LiftDurations_list->RowIndex ?>_Rank" id="x<?php echo $LiftDurations_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($LiftDurations_list->Rank->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_list->Rank->EditValue ?>"<?php echo $LiftDurations_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="LiftDurations" data-field="x_Rank" name="o<?php echo $LiftDurations_list->RowIndex ?>_Rank" id="o<?php echo $LiftDurations_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($LiftDurations_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($LiftDurations->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_Rank" class="form-group">
<input type="text" data-table="LiftDurations" data-field="x_Rank" name="x<?php echo $LiftDurations_list->RowIndex ?>_Rank" id="x<?php echo $LiftDurations_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($LiftDurations_list->Rank->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_list->Rank->EditValue ?>"<?php echo $LiftDurations_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($LiftDurations->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_Rank">
<span<?php echo $LiftDurations_list->Rank->viewAttributes() ?>><?php echo $LiftDurations_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LiftDurations_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $LiftDurations_list->ActiveFlag->cellAttributes() ?>>
<?php if ($LiftDurations->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($LiftDurations_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="LiftDurations" data-field="x_ActiveFlag" name="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]_570158" value="1"<?php echo $selwrk ?><?php echo $LiftDurations_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]_570158"></label>
</div>
</span>
<input type="hidden" data-table="LiftDurations" data-field="x_ActiveFlag" name="o<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($LiftDurations_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($LiftDurations->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($LiftDurations_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="LiftDurations" data-field="x_ActiveFlag" name="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]_730209" value="1"<?php echo $selwrk ?><?php echo $LiftDurations_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]_730209"></label>
</div>
</span>
<?php } ?>
<?php if ($LiftDurations->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LiftDurations_list->RowCount ?>_LiftDurations_ActiveFlag">
<span<?php echo $LiftDurations_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $LiftDurations_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($LiftDurations_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$LiftDurations_list->ListOptions->render("body", "right", $LiftDurations_list->RowCount);
?>
	</tr>
<?php if ($LiftDurations->RowType == ROWTYPE_ADD || $LiftDurations->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fLiftDurationslist", "load"], function() {
	fLiftDurationslist.updateLists(<?php echo $LiftDurations_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$LiftDurations_list->isGridAdd())
		if (!$LiftDurations_list->Recordset->EOF)
			$LiftDurations_list->Recordset->moveNext();
}
?>
<?php
	if ($LiftDurations_list->isGridAdd() || $LiftDurations_list->isGridEdit()) {
		$LiftDurations_list->RowIndex = '$rowindex$';
		$LiftDurations_list->loadRowValues();

		// Set row properties
		$LiftDurations->resetAttributes();
		$LiftDurations->RowAttrs->merge(["data-rowindex" => $LiftDurations_list->RowIndex, "id" => "r0_LiftDurations", "data-rowtype" => ROWTYPE_ADD]);
		$LiftDurations->RowAttrs->appendClass("ew-template");
		$LiftDurations->RowType = ROWTYPE_ADD;

		// Render row
		$LiftDurations_list->renderRow();

		// Render list options
		$LiftDurations_list->renderListOptions();
		$LiftDurations_list->StartRowCount = 0;
?>
	<tr <?php echo $LiftDurations->rowAttributes() ?>>
<?php

// Render list options (body, left)
$LiftDurations_list->ListOptions->render("body", "left", $LiftDurations_list->RowIndex);
?>
	<?php if ($LiftDurations_list->LiftDuration_Idn->Visible) { // LiftDuration_Idn ?>
		<td data-name="LiftDuration_Idn">
<span id="el$rowindex$_LiftDurations_LiftDuration_Idn" class="form-group LiftDurations_LiftDuration_Idn"></span>
<input type="hidden" data-table="LiftDurations" data-field="x_LiftDuration_Idn" name="o<?php echo $LiftDurations_list->RowIndex ?>_LiftDuration_Idn" id="o<?php echo $LiftDurations_list->RowIndex ?>_LiftDuration_Idn" value="<?php echo HtmlEncode($LiftDurations_list->LiftDuration_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LiftDurations_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_LiftDurations_Name" class="form-group LiftDurations_Name">
<input type="text" data-table="LiftDurations" data-field="x_Name" name="x<?php echo $LiftDurations_list->RowIndex ?>_Name" id="x<?php echo $LiftDurations_list->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($LiftDurations_list->Name->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_list->Name->EditValue ?>"<?php echo $LiftDurations_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="LiftDurations" data-field="x_Name" name="o<?php echo $LiftDurations_list->RowIndex ?>_Name" id="o<?php echo $LiftDurations_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($LiftDurations_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LiftDurations_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_LiftDurations_Rank" class="form-group LiftDurations_Rank">
<input type="text" data-table="LiftDurations" data-field="x_Rank" name="x<?php echo $LiftDurations_list->RowIndex ?>_Rank" id="x<?php echo $LiftDurations_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($LiftDurations_list->Rank->getPlaceHolder()) ?>" value="<?php echo $LiftDurations_list->Rank->EditValue ?>"<?php echo $LiftDurations_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="LiftDurations" data-field="x_Rank" name="o<?php echo $LiftDurations_list->RowIndex ?>_Rank" id="o<?php echo $LiftDurations_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($LiftDurations_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LiftDurations_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_LiftDurations_ActiveFlag" class="form-group LiftDurations_ActiveFlag">
<?php
$selwrk = ConvertToBool($LiftDurations_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="LiftDurations" data-field="x_ActiveFlag" name="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]_552461" value="1"<?php echo $selwrk ?><?php echo $LiftDurations_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]_552461"></label>
</div>
</span>
<input type="hidden" data-table="LiftDurations" data-field="x_ActiveFlag" name="o<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $LiftDurations_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($LiftDurations_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$LiftDurations_list->ListOptions->render("body", "right", $LiftDurations_list->RowIndex);
?>
<script>
loadjs.ready(["fLiftDurationslist", "load"], function() {
	fLiftDurationslist.updateLists(<?php echo $LiftDurations_list->RowIndex ?>);
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
<?php if ($LiftDurations_list->isAdd() || $LiftDurations_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $LiftDurations_list->FormKeyCountName ?>" id="<?php echo $LiftDurations_list->FormKeyCountName ?>" value="<?php echo $LiftDurations_list->KeyCount ?>">
<?php } ?>
<?php if ($LiftDurations_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $LiftDurations_list->FormKeyCountName ?>" id="<?php echo $LiftDurations_list->FormKeyCountName ?>" value="<?php echo $LiftDurations_list->KeyCount ?>">
<?php echo $LiftDurations_list->MultiSelectKey ?>
<?php } ?>
<?php if ($LiftDurations_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $LiftDurations_list->FormKeyCountName ?>" id="<?php echo $LiftDurations_list->FormKeyCountName ?>" value="<?php echo $LiftDurations_list->KeyCount ?>">
<?php } ?>
<?php if ($LiftDurations_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $LiftDurations_list->FormKeyCountName ?>" id="<?php echo $LiftDurations_list->FormKeyCountName ?>" value="<?php echo $LiftDurations_list->KeyCount ?>">
<?php echo $LiftDurations_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$LiftDurations->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($LiftDurations_list->Recordset)
	$LiftDurations_list->Recordset->Close();
?>
<?php if (!$LiftDurations_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$LiftDurations_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $LiftDurations_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $LiftDurations_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($LiftDurations_list->TotalRecords == 0 && !$LiftDurations->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $LiftDurations_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$LiftDurations_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$LiftDurations_list->isExport()) { ?>
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
$LiftDurations_list->terminate();
?>