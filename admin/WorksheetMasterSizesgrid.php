<?php
namespace PHPMaker2020\feapps51;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($WorksheetMasterSizes_grid))
	$WorksheetMasterSizes_grid = new WorksheetMasterSizes_grid();

// Run the page
$WorksheetMasterSizes_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasterSizes_grid->Page_Render();
?>
<?php if (!$WorksheetMasterSizes_grid->isExport()) { ?>
<script>
var fWorksheetMasterSizesgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fWorksheetMasterSizesgrid = new ew.Form("fWorksheetMasterSizesgrid", "grid");
	fWorksheetMasterSizesgrid.formKeyCountName = '<?php echo $WorksheetMasterSizes_grid->FormKeyCountName ?>';

	// Validate form
	fWorksheetMasterSizesgrid.validate = function() {
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
			<?php if ($WorksheetMasterSizes_grid->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterSizes_grid->WorksheetMaster_Idn->caption(), $WorksheetMasterSizes_grid->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterSizes_grid->ProductSize_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ProductSize_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterSizes_grid->ProductSize_Idn->caption(), $WorksheetMasterSizes_grid->ProductSize_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fWorksheetMasterSizesgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "WorksheetMaster_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProductSize_Idn", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fWorksheetMasterSizesgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetMasterSizesgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetMasterSizesgrid.lists["x_WorksheetMaster_Idn"] = <?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->Lookup->toClientList($WorksheetMasterSizes_grid) ?>;
	fWorksheetMasterSizesgrid.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->lookupOptions()) ?>;
	fWorksheetMasterSizesgrid.lists["x_ProductSize_Idn"] = <?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->Lookup->toClientList($WorksheetMasterSizes_grid) ?>;
	fWorksheetMasterSizesgrid.lists["x_ProductSize_Idn"].options = <?php echo JsonEncode($WorksheetMasterSizes_grid->ProductSize_Idn->lookupOptions()) ?>;
	loadjs.done("fWorksheetMasterSizesgrid");
});
</script>
<?php } ?>
<?php
$WorksheetMasterSizes_grid->renderOtherOptions();
?>
<?php if ($WorksheetMasterSizes_grid->TotalRecords > 0 || $WorksheetMasterSizes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($WorksheetMasterSizes_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> WorksheetMasterSizes">
<?php if ($WorksheetMasterSizes_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $WorksheetMasterSizes_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fWorksheetMasterSizesgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_WorksheetMasterSizes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_WorksheetMasterSizesgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$WorksheetMasterSizes->RowType = ROWTYPE_HEADER;

// Render list options
$WorksheetMasterSizes_grid->renderListOptions();

// Render list options (header, left)
$WorksheetMasterSizes_grid->ListOptions->render("header", "left");
?>
<?php if ($WorksheetMasterSizes_grid->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($WorksheetMasterSizes_grid->SortUrl($WorksheetMasterSizes_grid->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasterSizes_WorksheetMaster_Idn" class="WorksheetMasterSizes_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->headerCellClass() ?>"><div><div id="elh_WorksheetMasterSizes_WorksheetMaster_Idn" class="WorksheetMasterSizes_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterSizes_grid->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterSizes_grid->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterSizes_grid->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
	<?php if ($WorksheetMasterSizes_grid->SortUrl($WorksheetMasterSizes_grid->ProductSize_Idn) == "") { ?>
		<th data-name="ProductSize_Idn" class="<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasterSizes_ProductSize_Idn" class="WorksheetMasterSizes_ProductSize_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductSize_Idn" class="<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->headerCellClass() ?>"><div><div id="elh_WorksheetMasterSizes_ProductSize_Idn" class="WorksheetMasterSizes_ProductSize_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterSizes_grid->ProductSize_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterSizes_grid->ProductSize_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$WorksheetMasterSizes_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$WorksheetMasterSizes_grid->StartRecord = 1;
$WorksheetMasterSizes_grid->StopRecord = $WorksheetMasterSizes_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($WorksheetMasterSizes->isConfirm() || $WorksheetMasterSizes_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($WorksheetMasterSizes_grid->FormKeyCountName) && ($WorksheetMasterSizes_grid->isGridAdd() || $WorksheetMasterSizes_grid->isGridEdit() || $WorksheetMasterSizes->isConfirm())) {
		$WorksheetMasterSizes_grid->KeyCount = $CurrentForm->getValue($WorksheetMasterSizes_grid->FormKeyCountName);
		$WorksheetMasterSizes_grid->StopRecord = $WorksheetMasterSizes_grid->StartRecord + $WorksheetMasterSizes_grid->KeyCount - 1;
	}
}
$WorksheetMasterSizes_grid->RecordCount = $WorksheetMasterSizes_grid->StartRecord - 1;
if ($WorksheetMasterSizes_grid->Recordset && !$WorksheetMasterSizes_grid->Recordset->EOF) {
	$WorksheetMasterSizes_grid->Recordset->moveFirst();
	$selectLimit = $WorksheetMasterSizes_grid->UseSelectLimit;
	if (!$selectLimit && $WorksheetMasterSizes_grid->StartRecord > 1)
		$WorksheetMasterSizes_grid->Recordset->move($WorksheetMasterSizes_grid->StartRecord - 1);
} elseif (!$WorksheetMasterSizes->AllowAddDeleteRow && $WorksheetMasterSizes_grid->StopRecord == 0) {
	$WorksheetMasterSizes_grid->StopRecord = $WorksheetMasterSizes->GridAddRowCount;
}

// Initialize aggregate
$WorksheetMasterSizes->RowType = ROWTYPE_AGGREGATEINIT;
$WorksheetMasterSizes->resetAttributes();
$WorksheetMasterSizes_grid->renderRow();
if ($WorksheetMasterSizes_grid->isGridAdd())
	$WorksheetMasterSizes_grid->RowIndex = 0;
if ($WorksheetMasterSizes_grid->isGridEdit())
	$WorksheetMasterSizes_grid->RowIndex = 0;
while ($WorksheetMasterSizes_grid->RecordCount < $WorksheetMasterSizes_grid->StopRecord) {
	$WorksheetMasterSizes_grid->RecordCount++;
	if ($WorksheetMasterSizes_grid->RecordCount >= $WorksheetMasterSizes_grid->StartRecord) {
		$WorksheetMasterSizes_grid->RowCount++;
		if ($WorksheetMasterSizes_grid->isGridAdd() || $WorksheetMasterSizes_grid->isGridEdit() || $WorksheetMasterSizes->isConfirm()) {
			$WorksheetMasterSizes_grid->RowIndex++;
			$CurrentForm->Index = $WorksheetMasterSizes_grid->RowIndex;
			if ($CurrentForm->hasValue($WorksheetMasterSizes_grid->FormActionName) && ($WorksheetMasterSizes->isConfirm() || $WorksheetMasterSizes_grid->EventCancelled))
				$WorksheetMasterSizes_grid->RowAction = strval($CurrentForm->getValue($WorksheetMasterSizes_grid->FormActionName));
			elseif ($WorksheetMasterSizes_grid->isGridAdd())
				$WorksheetMasterSizes_grid->RowAction = "insert";
			else
				$WorksheetMasterSizes_grid->RowAction = "";
		}

		// Set up key count
		$WorksheetMasterSizes_grid->KeyCount = $WorksheetMasterSizes_grid->RowIndex;

		// Init row class and style
		$WorksheetMasterSizes->resetAttributes();
		$WorksheetMasterSizes->CssClass = "";
		if ($WorksheetMasterSizes_grid->isGridAdd()) {
			if ($WorksheetMasterSizes->CurrentMode == "copy") {
				$WorksheetMasterSizes_grid->loadRowValues($WorksheetMasterSizes_grid->Recordset); // Load row values
				$WorksheetMasterSizes_grid->setRecordKey($WorksheetMasterSizes_grid->RowOldKey, $WorksheetMasterSizes_grid->Recordset); // Set old record key
			} else {
				$WorksheetMasterSizes_grid->loadRowValues(); // Load default values
				$WorksheetMasterSizes_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$WorksheetMasterSizes_grid->loadRowValues($WorksheetMasterSizes_grid->Recordset); // Load row values
		}
		$WorksheetMasterSizes->RowType = ROWTYPE_VIEW; // Render view
		if ($WorksheetMasterSizes_grid->isGridAdd()) // Grid add
			$WorksheetMasterSizes->RowType = ROWTYPE_ADD; // Render add
		if ($WorksheetMasterSizes_grid->isGridAdd() && $WorksheetMasterSizes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$WorksheetMasterSizes_grid->restoreCurrentRowFormValues($WorksheetMasterSizes_grid->RowIndex); // Restore form values
		if ($WorksheetMasterSizes_grid->isGridEdit()) { // Grid edit
			if ($WorksheetMasterSizes->EventCancelled)
				$WorksheetMasterSizes_grid->restoreCurrentRowFormValues($WorksheetMasterSizes_grid->RowIndex); // Restore form values
			if ($WorksheetMasterSizes_grid->RowAction == "insert")
				$WorksheetMasterSizes->RowType = ROWTYPE_ADD; // Render add
			else
				$WorksheetMasterSizes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($WorksheetMasterSizes_grid->isGridEdit() && ($WorksheetMasterSizes->RowType == ROWTYPE_EDIT || $WorksheetMasterSizes->RowType == ROWTYPE_ADD) && $WorksheetMasterSizes->EventCancelled) // Update failed
			$WorksheetMasterSizes_grid->restoreCurrentRowFormValues($WorksheetMasterSizes_grid->RowIndex); // Restore form values
		if ($WorksheetMasterSizes->RowType == ROWTYPE_EDIT) // Edit row
			$WorksheetMasterSizes_grid->EditRowCount++;
		if ($WorksheetMasterSizes->isConfirm()) // Confirm row
			$WorksheetMasterSizes_grid->restoreCurrentRowFormValues($WorksheetMasterSizes_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$WorksheetMasterSizes->RowAttrs->merge(["data-rowindex" => $WorksheetMasterSizes_grid->RowCount, "id" => "r" . $WorksheetMasterSizes_grid->RowCount . "_WorksheetMasterSizes", "data-rowtype" => $WorksheetMasterSizes->RowType]);

		// Render row
		$WorksheetMasterSizes_grid->renderRow();

		// Render list options
		$WorksheetMasterSizes_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($WorksheetMasterSizes_grid->RowAction != "delete" && $WorksheetMasterSizes_grid->RowAction != "insertdelete" && !($WorksheetMasterSizes_grid->RowAction == "insert" && $WorksheetMasterSizes->isConfirm() && $WorksheetMasterSizes_grid->emptyRow())) {
?>
	<tr <?php echo $WorksheetMasterSizes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterSizes_grid->ListOptions->render("body", "left", $WorksheetMasterSizes_grid->RowCount);
?>
	<?php if ($WorksheetMasterSizes_grid->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($WorksheetMasterSizes_grid->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $WorksheetMasterSizes_grid->RowCount ?>_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group">
<span<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterSizes_grid->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $WorksheetMasterSizes_grid->RowCount ?>_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn"<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_grid->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterSizes_grid, "p_x" . $WorksheetMasterSizes_grid->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($WorksheetMasterSizes_grid->WorksheetMaster_Idn->getSessionValue() != "") { ?>

<span id="el<?php echo $WorksheetMasterSizes_grid->RowCount ?>_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group">
<span<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterSizes_grid->WorksheetMaster_Idn->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>

<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn"<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_grid->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterSizes_grid, "p_x" . $WorksheetMasterSizes_grid->RowIndex . "_WorksheetMaster_Idn") ?>

<?php } ?>

<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->OldValue != null ? $WorksheetMasterSizes_grid->WorksheetMaster_Idn->OldValue : $WorksheetMasterSizes_grid->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterSizes_grid->RowCount ?>_WorksheetMasterSizes_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php if (!$WorksheetMasterSizes->isConfirm()) { ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="fWorksheetMasterSizesgrid$x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" id="fWorksheetMasterSizesgrid$x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="fWorksheetMasterSizesgrid$o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" id="fWorksheetMasterSizesgrid$o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterSizes_grid->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td data-name="ProductSize_Idn" <?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterSizes_grid->RowCount ?>_WorksheetMasterSizes_ProductSize_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn"<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_grid->RowIndex}_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->Lookup->getParamTag($WorksheetMasterSizes_grid, "p_x" . $WorksheetMasterSizes_grid->RowIndex . "_ProductSize_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" id="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->ProductSize_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn"<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_grid->RowIndex}_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->Lookup->getParamTag($WorksheetMasterSizes_grid, "p_x" . $WorksheetMasterSizes_grid->RowIndex . "_ProductSize_Idn") ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" id="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->ProductSize_Idn->OldValue != null ? $WorksheetMasterSizes_grid->ProductSize_Idn->OldValue : $WorksheetMasterSizes_grid->ProductSize_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterSizes_grid->RowCount ?>_WorksheetMasterSizes_ProductSize_Idn">
<span<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->viewAttributes() ?>><?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->getViewValue() ?></span>
</span>
<?php if (!$WorksheetMasterSizes->isConfirm()) { ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->ProductSize_Idn->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" id="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->ProductSize_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="fWorksheetMasterSizesgrid$x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" id="fWorksheetMasterSizesgrid$x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->ProductSize_Idn->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="fWorksheetMasterSizesgrid$o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" id="fWorksheetMasterSizesgrid$o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->ProductSize_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterSizes_grid->ListOptions->render("body", "right", $WorksheetMasterSizes_grid->RowCount);
?>
	</tr>
<?php if ($WorksheetMasterSizes->RowType == ROWTYPE_ADD || $WorksheetMasterSizes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fWorksheetMasterSizesgrid", "load"], function() {
	fWorksheetMasterSizesgrid.updateLists(<?php echo $WorksheetMasterSizes_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$WorksheetMasterSizes_grid->isGridAdd() || $WorksheetMasterSizes->CurrentMode == "copy")
		if (!$WorksheetMasterSizes_grid->Recordset->EOF)
			$WorksheetMasterSizes_grid->Recordset->moveNext();
}
?>
<?php
	if ($WorksheetMasterSizes->CurrentMode == "add" || $WorksheetMasterSizes->CurrentMode == "copy" || $WorksheetMasterSizes->CurrentMode == "edit") {
		$WorksheetMasterSizes_grid->RowIndex = '$rowindex$';
		$WorksheetMasterSizes_grid->loadRowValues();

		// Set row properties
		$WorksheetMasterSizes->resetAttributes();
		$WorksheetMasterSizes->RowAttrs->merge(["data-rowindex" => $WorksheetMasterSizes_grid->RowIndex, "id" => "r0_WorksheetMasterSizes", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetMasterSizes->RowAttrs->appendClass("ew-template");
		$WorksheetMasterSizes->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetMasterSizes_grid->renderRow();

		// Render list options
		$WorksheetMasterSizes_grid->renderListOptions();
		$WorksheetMasterSizes_grid->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetMasterSizes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterSizes_grid->ListOptions->render("body", "left", $WorksheetMasterSizes_grid->RowIndex);
?>
	<?php if ($WorksheetMasterSizes_grid->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<?php if (!$WorksheetMasterSizes->isConfirm()) { ?>
<?php if ($WorksheetMasterSizes_grid->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el$rowindex$_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group WorksheetMasterSizes_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterSizes_grid->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group WorksheetMasterSizes_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn"<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_grid->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterSizes_grid, "p_x" . $WorksheetMasterSizes_grid->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterSizes_WorksheetMaster_Idn" class="form-group WorksheetMasterSizes_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterSizes_grid->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterSizes_grid->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterSizes_grid->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<td data-name="ProductSize_Idn">
<?php if (!$WorksheetMasterSizes->isConfirm()) { ?>
<span id="el$rowindex$_WorksheetMasterSizes_ProductSize_Idn" class="form-group WorksheetMasterSizes_ProductSize_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" data-value-separator="<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn"<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->selectOptionListHtml("x{$WorksheetMasterSizes_grid->RowIndex}_ProductSize_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->Lookup->getParamTag($WorksheetMasterSizes_grid, "p_x" . $WorksheetMasterSizes_grid->RowIndex . "_ProductSize_Idn") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterSizes_ProductSize_Idn" class="form-group WorksheetMasterSizes_ProductSize_Idn">
<span<?php echo $WorksheetMasterSizes_grid->ProductSize_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterSizes_grid->ProductSize_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" id="x<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->ProductSize_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="WorksheetMasterSizes" data-field="x_ProductSize_Idn" name="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" id="o<?php echo $WorksheetMasterSizes_grid->RowIndex ?>_ProductSize_Idn" value="<?php echo HtmlEncode($WorksheetMasterSizes_grid->ProductSize_Idn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterSizes_grid->ListOptions->render("body", "right", $WorksheetMasterSizes_grid->RowIndex);
?>
<script>
loadjs.ready(["fWorksheetMasterSizesgrid", "load"], function() {
	fWorksheetMasterSizesgrid.updateLists(<?php echo $WorksheetMasterSizes_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($WorksheetMasterSizes->CurrentMode == "add" || $WorksheetMasterSizes->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $WorksheetMasterSizes_grid->FormKeyCountName ?>" id="<?php echo $WorksheetMasterSizes_grid->FormKeyCountName ?>" value="<?php echo $WorksheetMasterSizes_grid->KeyCount ?>">
<?php echo $WorksheetMasterSizes_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($WorksheetMasterSizes->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $WorksheetMasterSizes_grid->FormKeyCountName ?>" id="<?php echo $WorksheetMasterSizes_grid->FormKeyCountName ?>" value="<?php echo $WorksheetMasterSizes_grid->KeyCount ?>">
<?php echo $WorksheetMasterSizes_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($WorksheetMasterSizes->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fWorksheetMasterSizesgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($WorksheetMasterSizes_grid->Recordset)
	$WorksheetMasterSizes_grid->Recordset->Close();
?>
<?php if ($WorksheetMasterSizes_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $WorksheetMasterSizes_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($WorksheetMasterSizes_grid->TotalRecords == 0 && !$WorksheetMasterSizes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $WorksheetMasterSizes_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$WorksheetMasterSizes_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$WorksheetMasterSizes_grid->terminate();
?>