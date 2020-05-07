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
$WorksheetMasterSizes_list = new WorksheetMasterSizes_list();

// Run the page
$WorksheetMasterSizes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasterSizes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$WorksheetMasterSizes_list->isExport()) { ?>
<script>
var fWorksheetMasterSizeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fWorksheetMasterSizeslist = currentForm = new ew.Form("fWorksheetMasterSizeslist", "list");
	fWorksheetMasterSizeslist.formKeyCountName = '<?php echo $WorksheetMasterSizes_list->FormKeyCountName ?>';

	// Validate form
	fWorksheetMasterSizeslist.validate = function() {
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
			<?php if ($WorksheetMasterSizes_list->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterSizes_list->WorksheetMaster_Idn->caption(), $WorksheetMasterSizes_list->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterSizes_list->ProductSize_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductSize_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterSizes_list->ProductSize_Idn->caption(), $WorksheetMasterSizes_list->ProductSize_Idn->RequiredErrorMessage)) ?>");
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
	fWorksheetMasterSizeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "WorksheetMaster_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProductSize_Idn", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fWorksheetMasterSizeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetMasterSizeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetMasterSizeslist.lists["x_WorksheetMaster_Idn"] = <?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->Lookup->toClientList($WorksheetMasterSizes_list) ?>;
	fWorksheetMasterSizeslist.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($WorksheetMasterSizes_list->WorksheetMaster_Idn->lookupOptions()) ?>;
	fWorksheetMasterSizeslist.lists["x_ProductSize_Idn"] = <?php echo $WorksheetMasterSizes_list->ProductSize_Idn->Lookup->toClientList($WorksheetMasterSizes_list) ?>;
	fWorksheetMasterSizeslist.lists["x_ProductSize_Idn"].options = <?php echo JsonEncode($WorksheetMasterSizes_list->ProductSize_Idn->lookupOptions()) ?>;
	loadjs.done("fWorksheetMasterSizeslist");
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
<?php if (!$WorksheetMasterSizes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($WorksheetMasterSizes_list->TotalRecords > 0 && $WorksheetMasterSizes_list->ExportOptions->visible()) { ?>
<?php $WorksheetMasterSizes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetMasterSizes_list->ImportOptions->visible()) { ?>
<?php $WorksheetMasterSizes_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$WorksheetMasterSizes_list->isExport() || Config("EXPORT_MASTER_RECORD") && $WorksheetMasterSizes_list->isExport("print")) { ?>
<?php
if ($WorksheetMasterSizes_list->DbMasterFilter != "" && $WorksheetMasterSizes->getCurrentMasterTable() == "WorksheetMasters") {
	if ($WorksheetMasterSizes_list->MasterRecordExists) {
		include_once "WorksheetMastersmaster.php";
	}
}
?>
<?php } ?>
<?php
$WorksheetMasterSizes_list->renderOtherOptions();
?>
<?php $WorksheetMasterSizes_list->showPageHeader(); ?>
<?php
$WorksheetMasterSizes_list->showMessage();
?>
<?php if ($WorksheetMasterSizes_list->TotalRecords > 0 || $WorksheetMasterSizes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($WorksheetMasterSizes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> WorksheetMasterSizes">
<?php if (!$WorksheetMasterSizes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$WorksheetMasterSizes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetMasterSizes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetMasterSizes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fWorksheetMasterSizeslist" id="fWorksheetMasterSizeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetMasterSizes">
<?php if ($WorksheetMasterSizes->getCurrentMasterTable() == "WorksheetMasters" && $WorksheetMasterSizes->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="WorksheetMasters">
<input type="hidden" name="fk_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->WorksheetMaster_Idn->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_WorksheetMasterSizes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($WorksheetMasterSizes_list->TotalRecords > 0 || $WorksheetMasterSizes_list->isAdd() || $WorksheetMasterSizes_list->isCopy() || $WorksheetMasterSizes_list->isGridEdit()) { ?>
<table id="tbl_WorksheetMasterSizeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$WorksheetMasterSizes->RowType = ROWTYPE_HEADER;

// Render list options
$WorksheetMasterSizes_list->renderListOptions();

// Render list options (header, left)
$WorksheetMasterSizes_list->ListOptions->render("header", "left");
?>
<?php if ($WorksheetMasterSizes_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($WorksheetMasterSizes_list->SortUrl($WorksheetMasterSizes_list->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasterSizes_WorksheetMaster_Idn" class="WorksheetMasterSizes_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasterSizes_list->SortUrl($WorksheetMasterSizes_list->WorksheetMaster_Idn) ?>', 1);"><div id="elh_WorksheetMasterSizes_WorksheetMaster_Idn" class="WorksheetMasterSizes_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterSizes_list->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterSizes_list->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterSizes_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
	<?php if ($WorksheetMasterSizes_list->SortUrl($WorksheetMasterSizes_list->ProductSize_Idn) == "") { ?>
		<th data-name="ProductSize_Idn" class="<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasterSizes_ProductSize_Idn" class="WorksheetMasterSizes_ProductSize_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasterSizes_list->ProductSize_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductSize_Idn" class="<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetMasterSizes_list->SortUrl($WorksheetMasterSizes_list->ProductSize_Idn) ?>', 1);"><div id="elh_WorksheetMasterSizes_ProductSize_Idn" class="WorksheetMasterSizes_ProductSize_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterSizes_list->ProductSize_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterSizes_list->ProductSize_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterSizes_list->ProductSize_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$WorksheetMasterSizes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($WorksheetMasterSizes_list->isAdd() || $WorksheetMasterSizes_list->isCopy()) {
		$WorksheetMasterSizes_list->RowIndex = 0;
		$WorksheetMasterSizes_list->KeyCount = $WorksheetMasterSizes_list->RowIndex;
		if ($WorksheetMasterSizes_list->isCopy() && !$WorksheetMasterSizes_list->loadRow())
			$WorksheetMasterSizes->CurrentAction = "add";
		if ($WorksheetMasterSizes_list->isAdd())
			$WorksheetMasterSizes_list->loadRowValues();
		if ($WorksheetMasterSizes->EventCancelled) // Insert failed
			$WorksheetMasterSizes_list->restoreFormValues(); // Restore form values

		// Set row properties
		$WorksheetMasterSizes->resetAttributes();
		$WorksheetMasterSizes->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_WorksheetMasterSizes", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetMasterSizes->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetMasterSizes_list->renderRow();

		// Render list options
		$WorksheetMasterSizes_list->renderListOptions();
		$WorksheetMasterSizes_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetMasterSizes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterSizes_list->ListOptions->render("body", "left", $WorksheetMasterSizes_list->RowCount);
?>
	<?php if ($WorksheetMasterSizes_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<?php if ($WorksheetMasterSizes_list->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $WorksheetMasterSizes_list->RowCount ?>_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group WorksheetMasterSizes_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterSizes_list->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $WorksheetMasterSizes_list->RowCount ?>_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group WorksheetMasterSizes_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterSizes_list, "p_x" . $WorksheetMasterSizes_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterSizes_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td data-name="ProductSize_Idn">
<span id="el<?php echo $WorksheetMasterSizes_list->RowCount ?>_WorksheetMasterSizes_ProductSize_Idn" class="form-group WorksheetMasterSizes_ProductSize_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn"<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_list->RowIndex}_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->Lookup->getParamTag($WorksheetMasterSizes_list, "p_x" . $WorksheetMasterSizes_list->RowIndex . "_ProductSize_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" id="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->ProductSize_Idn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterSizes_list->ListOptions->render("body", "right", $WorksheetMasterSizes_list->RowCount);
?>
<script>
loadjs.ready(["fWorksheetMasterSizeslist", "load"], function() {
	fWorksheetMasterSizeslist.updateLists(<?php echo $WorksheetMasterSizes_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($WorksheetMasterSizes_list->ExportAll && $WorksheetMasterSizes_list->isExport()) {
	$WorksheetMasterSizes_list->StopRecord = $WorksheetMasterSizes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($WorksheetMasterSizes_list->TotalRecords > $WorksheetMasterSizes_list->StartRecord + $WorksheetMasterSizes_list->DisplayRecords - 1)
		$WorksheetMasterSizes_list->StopRecord = $WorksheetMasterSizes_list->StartRecord + $WorksheetMasterSizes_list->DisplayRecords - 1;
	else
		$WorksheetMasterSizes_list->StopRecord = $WorksheetMasterSizes_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($WorksheetMasterSizes->isConfirm() || $WorksheetMasterSizes_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($WorksheetMasterSizes_list->FormKeyCountName) && ($WorksheetMasterSizes_list->isGridAdd() || $WorksheetMasterSizes_list->isGridEdit() || $WorksheetMasterSizes->isConfirm())) {
		$WorksheetMasterSizes_list->KeyCount = $CurrentForm->getValue($WorksheetMasterSizes_list->FormKeyCountName);
		$WorksheetMasterSizes_list->StopRecord = $WorksheetMasterSizes_list->StartRecord + $WorksheetMasterSizes_list->KeyCount - 1;
	}
}
$WorksheetMasterSizes_list->RecordCount = $WorksheetMasterSizes_list->StartRecord - 1;
if ($WorksheetMasterSizes_list->Recordset && !$WorksheetMasterSizes_list->Recordset->EOF) {
	$WorksheetMasterSizes_list->Recordset->moveFirst();
	$selectLimit = $WorksheetMasterSizes_list->UseSelectLimit;
	if (!$selectLimit && $WorksheetMasterSizes_list->StartRecord > 1)
		$WorksheetMasterSizes_list->Recordset->move($WorksheetMasterSizes_list->StartRecord - 1);
} elseif (!$WorksheetMasterSizes->AllowAddDeleteRow && $WorksheetMasterSizes_list->StopRecord == 0) {
	$WorksheetMasterSizes_list->StopRecord = $WorksheetMasterSizes->GridAddRowCount;
}

// Initialize aggregate
$WorksheetMasterSizes->RowType = ROWTYPE_AGGREGATEINIT;
$WorksheetMasterSizes->resetAttributes();
$WorksheetMasterSizes_list->renderRow();
$WorksheetMasterSizes_list->EditRowCount = 0;
if ($WorksheetMasterSizes_list->isEdit())
	$WorksheetMasterSizes_list->RowIndex = 1;
if ($WorksheetMasterSizes_list->isGridAdd())
	$WorksheetMasterSizes_list->RowIndex = 0;
if ($WorksheetMasterSizes_list->isGridEdit())
	$WorksheetMasterSizes_list->RowIndex = 0;
while ($WorksheetMasterSizes_list->RecordCount < $WorksheetMasterSizes_list->StopRecord) {
	$WorksheetMasterSizes_list->RecordCount++;
	if ($WorksheetMasterSizes_list->RecordCount >= $WorksheetMasterSizes_list->StartRecord) {
		$WorksheetMasterSizes_list->RowCount++;
		if ($WorksheetMasterSizes_list->isGridAdd() || $WorksheetMasterSizes_list->isGridEdit() || $WorksheetMasterSizes->isConfirm()) {
			$WorksheetMasterSizes_list->RowIndex++;
			$CurrentForm->Index = $WorksheetMasterSizes_list->RowIndex;
			if ($CurrentForm->hasValue($WorksheetMasterSizes_list->FormActionName) && ($WorksheetMasterSizes->isConfirm() || $WorksheetMasterSizes_list->EventCancelled))
				$WorksheetMasterSizes_list->RowAction = strval($CurrentForm->getValue($WorksheetMasterSizes_list->FormActionName));
			elseif ($WorksheetMasterSizes_list->isGridAdd())
				$WorksheetMasterSizes_list->RowAction = "insert";
			else
				$WorksheetMasterSizes_list->RowAction = "";
		}

		// Set up key count
		$WorksheetMasterSizes_list->KeyCount = $WorksheetMasterSizes_list->RowIndex;

		// Init row class and style
		$WorksheetMasterSizes->resetAttributes();
		$WorksheetMasterSizes->CssClass = "";
		if ($WorksheetMasterSizes_list->isGridAdd()) {
			$WorksheetMasterSizes_list->loadRowValues(); // Load default values
		} else {
			$WorksheetMasterSizes_list->loadRowValues($WorksheetMasterSizes_list->Recordset); // Load row values
		}
		$WorksheetMasterSizes->RowType = ROWTYPE_VIEW; // Render view
		if ($WorksheetMasterSizes_list->isGridAdd()) // Grid add
			$WorksheetMasterSizes->RowType = ROWTYPE_ADD; // Render add
		if ($WorksheetMasterSizes_list->isGridAdd() && $WorksheetMasterSizes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$WorksheetMasterSizes_list->restoreCurrentRowFormValues($WorksheetMasterSizes_list->RowIndex); // Restore form values
		if ($WorksheetMasterSizes_list->isEdit()) {
			if ($WorksheetMasterSizes_list->checkInlineEditKey() && $WorksheetMasterSizes_list->EditRowCount == 0) { // Inline edit
				$WorksheetMasterSizes->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($WorksheetMasterSizes_list->isGridEdit()) { // Grid edit
			if ($WorksheetMasterSizes->EventCancelled)
				$WorksheetMasterSizes_list->restoreCurrentRowFormValues($WorksheetMasterSizes_list->RowIndex); // Restore form values
			if ($WorksheetMasterSizes_list->RowAction == "insert")
				$WorksheetMasterSizes->RowType = ROWTYPE_ADD; // Render add
			else
				$WorksheetMasterSizes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($WorksheetMasterSizes_list->isEdit() && $WorksheetMasterSizes->RowType == ROWTYPE_EDIT && $WorksheetMasterSizes->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$WorksheetMasterSizes_list->restoreFormValues(); // Restore form values
		}
		if ($WorksheetMasterSizes_list->isGridEdit() && ($WorksheetMasterSizes->RowType == ROWTYPE_EDIT || $WorksheetMasterSizes->RowType == ROWTYPE_ADD) && $WorksheetMasterSizes->EventCancelled) // Update failed
			$WorksheetMasterSizes_list->restoreCurrentRowFormValues($WorksheetMasterSizes_list->RowIndex); // Restore form values
		if ($WorksheetMasterSizes->RowType == ROWTYPE_EDIT) // Edit row
			$WorksheetMasterSizes_list->EditRowCount++;

		// Set up row id / data-rowindex
		$WorksheetMasterSizes->RowAttrs->merge(["data-rowindex" => $WorksheetMasterSizes_list->RowCount, "id" => "r" . $WorksheetMasterSizes_list->RowCount . "_WorksheetMasterSizes", "data-rowtype" => $WorksheetMasterSizes->RowType]);

		// Render row
		$WorksheetMasterSizes_list->renderRow();

		// Render list options
		$WorksheetMasterSizes_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($WorksheetMasterSizes_list->RowAction != "delete" && $WorksheetMasterSizes_list->RowAction != "insertdelete" && !($WorksheetMasterSizes_list->RowAction == "insert" && $WorksheetMasterSizes->isConfirm() && $WorksheetMasterSizes_list->emptyRow())) {
?>
	<tr <?php echo $WorksheetMasterSizes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterSizes_list->ListOptions->render("body", "left", $WorksheetMasterSizes_list->RowCount);
?>
	<?php if ($WorksheetMasterSizes_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($WorksheetMasterSizes_list->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $WorksheetMasterSizes_list->RowCount ?>_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group">
<span<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterSizes_list->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $WorksheetMasterSizes_list->RowCount ?>_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterSizes_list, "p_x" . $WorksheetMasterSizes_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($WorksheetMasterSizes_list->WorksheetMaster_Idn->getSessionValue() != "") { ?>

<span id="el<?php echo $WorksheetMasterSizes_list->RowCount ?>_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group">
<span<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterSizes_list->WorksheetMaster_Idn->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>

<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterSizes_list, "p_x" . $WorksheetMasterSizes_list->RowIndex . "_WorksheetMaster_Idn") ?>

<?php } ?>

<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->WorksheetMaster_Idn->OldValue != null ? $WorksheetMasterSizes_list->WorksheetMaster_Idn->OldValue : $WorksheetMasterSizes_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterSizes_list->RowCount ?>_WorksheetMasterSizes_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterSizes_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td data-name="ProductSize_Idn" <?php echo $WorksheetMasterSizes_list->ProductSize_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterSizes_list->RowCount ?>_WorksheetMasterSizes_ProductSize_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn"<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_list->RowIndex}_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->Lookup->getParamTag($WorksheetMasterSizes_list, "p_x" . $WorksheetMasterSizes_list->RowIndex . "_ProductSize_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" id="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->ProductSize_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn"<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_list->RowIndex}_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->Lookup->getParamTag($WorksheetMasterSizes_list, "p_x" . $WorksheetMasterSizes_list->RowIndex . "_ProductSize_Idn") ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" id="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->ProductSize_Idn->OldValue != null ? $WorksheetMasterSizes_list->ProductSize_Idn->OldValue : $WorksheetMasterSizes_list->ProductSize_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterSizes_list->RowCount ?>_WorksheetMasterSizes_ProductSize_Idn">
<span<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->viewAttributes() ?>><?php echo $WorksheetMasterSizes_list->ProductSize_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterSizes_list->ListOptions->render("body", "right", $WorksheetMasterSizes_list->RowCount);
?>
	</tr>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_ADD || $WorksheetMasterSizes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fWorksheetMasterSizeslist", "load"], function() {
	fWorksheetMasterSizeslist.updateLists(<?php echo $WorksheetMasterSizes_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$WorksheetMasterSizes_list->isGridAdd())
		if (!$WorksheetMasterSizes_list->Recordset->EOF)
			$WorksheetMasterSizes_list->Recordset->moveNext();
}
?>
<?php
	if ($WorksheetMasterSizes_list->isGridAdd() || $WorksheetMasterSizes_list->isGridEdit()) {
		$WorksheetMasterSizes_list->RowIndex = '$rowindex$';
		$WorksheetMasterSizes_list->loadRowValues();

		// Set row properties
		$WorksheetMasterSizes->resetAttributes();
		$WorksheetMasterSizes->RowAttrs->merge(["data-rowindex" => $WorksheetMasterSizes_list->RowIndex, "id" => "r0_WorksheetMasterSizes", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetMasterSizes->RowAttrs->appendClass("ew-template");
		$WorksheetMasterSizes->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetMasterSizes_list->renderRow();

		// Render list options
		$WorksheetMasterSizes_list->renderListOptions();
		$WorksheetMasterSizes_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetMasterSizes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterSizes_list->ListOptions->render("body", "left", $WorksheetMasterSizes_list->RowIndex);
?>
	<?php if ($WorksheetMasterSizes_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<?php if ($WorksheetMasterSizes_list->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el$rowindex$_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group WorksheetMasterSizes_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterSizes_list->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group WorksheetMasterSizes_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_list->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterSizes_list, "p_x" . $WorksheetMasterSizes_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterSizes_list->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td data-name="ProductSize_Idn">
<span id="el$rowindex$_WorksheetMasterSizes_ProductSize_Idn" class="form-group WorksheetMasterSizes_ProductSize_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" name="x<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn"<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_list->RowIndex}_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_list->ProductSize_Idn->Lookup->getParamTag($WorksheetMasterSizes_list, "p_x" . $WorksheetMasterSizes_list->RowIndex . "_ProductSize_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" id="o<?php echo $WorksheetMasterSizes_list->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_list->ProductSize_Idn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterSizes_list->ListOptions->render("body", "right", $WorksheetMasterSizes_list->RowIndex);
?>
<script>
loadjs.ready(["fWorksheetMasterSizeslist", "load"], function() {
	fWorksheetMasterSizeslist.updateLists(<?php echo $WorksheetMasterSizes_list->RowIndex ?>);
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
<?php if ($WorksheetMasterSizes_list->isAdd() || $WorksheetMasterSizes_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $WorksheetMasterSizes_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasterSizes_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasterSizes_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetMasterSizes_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $WorksheetMasterSizes_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasterSizes_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasterSizes_list->KeyCount ?>">
<?php echo $WorksheetMasterSizes_list->MultiSelectKey ?>
<?php } ?>
<?php if ($WorksheetMasterSizes_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $WorksheetMasterSizes_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasterSizes_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasterSizes_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetMasterSizes_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $WorksheetMasterSizes_list->FormKeyCountName ?>" id="<?php echo $WorksheetMasterSizes_list->FormKeyCountName ?>" value="<?php echo $WorksheetMasterSizes_list->KeyCount ?>">
<?php echo $WorksheetMasterSizes_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$WorksheetMasterSizes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($WorksheetMasterSizes_list->Recordset)
	$WorksheetMasterSizes_list->Recordset->Close();
?>
<?php if (!$WorksheetMasterSizes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$WorksheetMasterSizes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetMasterSizes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetMasterSizes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($WorksheetMasterSizes_list->TotalRecords == 0 && !$WorksheetMasterSizes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $WorksheetMasterSizes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$WorksheetMasterSizes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$WorksheetMasterSizes_list->isExport()) { ?>
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
$WorksheetMasterSizes_list->terminate();
?>