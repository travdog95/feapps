<?php
namespace PHPMaker2020\feapps51;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($HangerSubTypes_grid))
	$HangerSubTypes_grid = new HangerSubTypes_grid();

// Run the page
$HangerSubTypes_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HangerSubTypes_grid->Page_Render();
?>
<?php if (!$HangerSubTypes_grid->isExport()) { ?>
<script>
var fHangerSubTypesgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fHangerSubTypesgrid = new ew.Form("fHangerSubTypesgrid", "grid");
	fHangerSubTypesgrid.formKeyCountName = '<?php echo $HangerSubTypes_grid->FormKeyCountName ?>';

	// Validate form
	fHangerSubTypesgrid.validate = function() {
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
			<?php if ($HangerSubTypes_grid->HangerSubType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerSubType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_grid->HangerSubType_Idn->caption(), $HangerSubTypes_grid->HangerSubType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HangerSubTypes_grid->HangerType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_HangerType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_grid->HangerType_Idn->caption(), $HangerSubTypes_grid->HangerType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HangerSubTypes_grid->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_grid->Name->caption(), $HangerSubTypes_grid->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($HangerSubTypes_grid->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_grid->Rank->caption(), $HangerSubTypes_grid->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($HangerSubTypes_grid->Rank->errorMessage()) ?>");
			<?php if ($HangerSubTypes_grid->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $HangerSubTypes_grid->ActiveFlag->caption(), $HangerSubTypes_grid->ActiveFlag->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fHangerSubTypesgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "HangerType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fHangerSubTypesgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fHangerSubTypesgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fHangerSubTypesgrid.lists["x_HangerType_Idn"] = <?php echo $HangerSubTypes_grid->HangerType_Idn->Lookup->toClientList($HangerSubTypes_grid) ?>;
	fHangerSubTypesgrid.lists["x_HangerType_Idn"].options = <?php echo JsonEncode($HangerSubTypes_grid->HangerType_Idn->lookupOptions()) ?>;
	fHangerSubTypesgrid.lists["x_ActiveFlag[]"] = <?php echo $HangerSubTypes_grid->ActiveFlag->Lookup->toClientList($HangerSubTypes_grid) ?>;
	fHangerSubTypesgrid.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($HangerSubTypes_grid->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fHangerSubTypesgrid");
});
</script>
<?php } ?>
<?php
$HangerSubTypes_grid->renderOtherOptions();
?>
<?php if ($HangerSubTypes_grid->TotalRecords > 0 || $HangerSubTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($HangerSubTypes_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> HangerSubTypes">
<?php if ($HangerSubTypes_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $HangerSubTypes_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fHangerSubTypesgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_HangerSubTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_HangerSubTypesgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$HangerSubTypes->RowType = ROWTYPE_HEADER;

// Render list options
$HangerSubTypes_grid->renderListOptions();

// Render list options (header, left)
$HangerSubTypes_grid->ListOptions->render("header", "left");
?>
<?php if ($HangerSubTypes_grid->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
	<?php if ($HangerSubTypes_grid->SortUrl($HangerSubTypes_grid->HangerSubType_Idn) == "") { ?>
		<th data-name="HangerSubType_Idn" class="<?php echo $HangerSubTypes_grid->HangerSubType_Idn->headerCellClass() ?>"><div id="elh_HangerSubTypes_HangerSubType_Idn" class="HangerSubTypes_HangerSubType_Idn"><div class="ew-table-header-caption"><?php echo $HangerSubTypes_grid->HangerSubType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HangerSubType_Idn" class="<?php echo $HangerSubTypes_grid->HangerSubType_Idn->headerCellClass() ?>"><div><div id="elh_HangerSubTypes_HangerSubType_Idn" class="HangerSubTypes_HangerSubType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_grid->HangerSubType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_grid->HangerSubType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_grid->HangerSubType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_grid->HangerType_Idn->Visible) { // HangerType_Idn ?>
	<?php if ($HangerSubTypes_grid->SortUrl($HangerSubTypes_grid->HangerType_Idn) == "") { ?>
		<th data-name="HangerType_Idn" class="<?php echo $HangerSubTypes_grid->HangerType_Idn->headerCellClass() ?>"><div id="elh_HangerSubTypes_HangerType_Idn" class="HangerSubTypes_HangerType_Idn"><div class="ew-table-header-caption"><?php echo $HangerSubTypes_grid->HangerType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HangerType_Idn" class="<?php echo $HangerSubTypes_grid->HangerType_Idn->headerCellClass() ?>"><div><div id="elh_HangerSubTypes_HangerType_Idn" class="HangerSubTypes_HangerType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_grid->HangerType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_grid->HangerType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_grid->HangerType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_grid->Name->Visible) { // Name ?>
	<?php if ($HangerSubTypes_grid->SortUrl($HangerSubTypes_grid->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $HangerSubTypes_grid->Name->headerCellClass() ?>"><div id="elh_HangerSubTypes_Name" class="HangerSubTypes_Name"><div class="ew-table-header-caption"><?php echo $HangerSubTypes_grid->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $HangerSubTypes_grid->Name->headerCellClass() ?>"><div><div id="elh_HangerSubTypes_Name" class="HangerSubTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_grid->Name->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_grid->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_grid->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_grid->Rank->Visible) { // Rank ?>
	<?php if ($HangerSubTypes_grid->SortUrl($HangerSubTypes_grid->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $HangerSubTypes_grid->Rank->headerCellClass() ?>"><div id="elh_HangerSubTypes_Rank" class="HangerSubTypes_Rank"><div class="ew-table-header-caption"><?php echo $HangerSubTypes_grid->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $HangerSubTypes_grid->Rank->headerCellClass() ?>"><div><div id="elh_HangerSubTypes_Rank" class="HangerSubTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_grid->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_grid->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_grid->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_grid->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($HangerSubTypes_grid->SortUrl($HangerSubTypes_grid->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $HangerSubTypes_grid->ActiveFlag->headerCellClass() ?>"><div id="elh_HangerSubTypes_ActiveFlag" class="HangerSubTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $HangerSubTypes_grid->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $HangerSubTypes_grid->ActiveFlag->headerCellClass() ?>"><div><div id="elh_HangerSubTypes_ActiveFlag" class="HangerSubTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_grid->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_grid->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_grid->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$HangerSubTypes_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$HangerSubTypes_grid->StartRecord = 1;
$HangerSubTypes_grid->StopRecord = $HangerSubTypes_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($HangerSubTypes->isConfirm() || $HangerSubTypes_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($HangerSubTypes_grid->FormKeyCountName) && ($HangerSubTypes_grid->isGridAdd() || $HangerSubTypes_grid->isGridEdit() || $HangerSubTypes->isConfirm())) {
		$HangerSubTypes_grid->KeyCount = $CurrentForm->getValue($HangerSubTypes_grid->FormKeyCountName);
		$HangerSubTypes_grid->StopRecord = $HangerSubTypes_grid->StartRecord + $HangerSubTypes_grid->KeyCount - 1;
	}
}
$HangerSubTypes_grid->RecordCount = $HangerSubTypes_grid->StartRecord - 1;
if ($HangerSubTypes_grid->Recordset && !$HangerSubTypes_grid->Recordset->EOF) {
	$HangerSubTypes_grid->Recordset->moveFirst();
	$selectLimit = $HangerSubTypes_grid->UseSelectLimit;
	if (!$selectLimit && $HangerSubTypes_grid->StartRecord > 1)
		$HangerSubTypes_grid->Recordset->move($HangerSubTypes_grid->StartRecord - 1);
} elseif (!$HangerSubTypes->AllowAddDeleteRow && $HangerSubTypes_grid->StopRecord == 0) {
	$HangerSubTypes_grid->StopRecord = $HangerSubTypes->GridAddRowCount;
}

// Initialize aggregate
$HangerSubTypes->RowType = ROWTYPE_AGGREGATEINIT;
$HangerSubTypes->resetAttributes();
$HangerSubTypes_grid->renderRow();
if ($HangerSubTypes_grid->isGridAdd())
	$HangerSubTypes_grid->RowIndex = 0;
if ($HangerSubTypes_grid->isGridEdit())
	$HangerSubTypes_grid->RowIndex = 0;
while ($HangerSubTypes_grid->RecordCount < $HangerSubTypes_grid->StopRecord) {
	$HangerSubTypes_grid->RecordCount++;
	if ($HangerSubTypes_grid->RecordCount >= $HangerSubTypes_grid->StartRecord) {
		$HangerSubTypes_grid->RowCount++;
		if ($HangerSubTypes_grid->isGridAdd() || $HangerSubTypes_grid->isGridEdit() || $HangerSubTypes->isConfirm()) {
			$HangerSubTypes_grid->RowIndex++;
			$CurrentForm->Index = $HangerSubTypes_grid->RowIndex;
			if ($CurrentForm->hasValue($HangerSubTypes_grid->FormActionName) && ($HangerSubTypes->isConfirm() || $HangerSubTypes_grid->EventCancelled))
				$HangerSubTypes_grid->RowAction = strval($CurrentForm->getValue($HangerSubTypes_grid->FormActionName));
			elseif ($HangerSubTypes_grid->isGridAdd())
				$HangerSubTypes_grid->RowAction = "insert";
			else
				$HangerSubTypes_grid->RowAction = "";
		}

		// Set up key count
		$HangerSubTypes_grid->KeyCount = $HangerSubTypes_grid->RowIndex;

		// Init row class and style
		$HangerSubTypes->resetAttributes();
		$HangerSubTypes->CssClass = "";
		if ($HangerSubTypes_grid->isGridAdd()) {
			if ($HangerSubTypes->CurrentMode == "copy") {
				$HangerSubTypes_grid->loadRowValues($HangerSubTypes_grid->Recordset); // Load row values
				$HangerSubTypes_grid->setRecordKey($HangerSubTypes_grid->RowOldKey, $HangerSubTypes_grid->Recordset); // Set old record key
			} else {
				$HangerSubTypes_grid->loadRowValues(); // Load default values
				$HangerSubTypes_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$HangerSubTypes_grid->loadRowValues($HangerSubTypes_grid->Recordset); // Load row values
		}
		$HangerSubTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($HangerSubTypes_grid->isGridAdd()) // Grid add
			$HangerSubTypes->RowType = ROWTYPE_ADD; // Render add
		if ($HangerSubTypes_grid->isGridAdd() && $HangerSubTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$HangerSubTypes_grid->restoreCurrentRowFormValues($HangerSubTypes_grid->RowIndex); // Restore form values
		if ($HangerSubTypes_grid->isGridEdit()) { // Grid edit
			if ($HangerSubTypes->EventCancelled)
				$HangerSubTypes_grid->restoreCurrentRowFormValues($HangerSubTypes_grid->RowIndex); // Restore form values
			if ($HangerSubTypes_grid->RowAction == "insert")
				$HangerSubTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$HangerSubTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($HangerSubTypes_grid->isGridEdit() && ($HangerSubTypes->RowType == ROWTYPE_EDIT || $HangerSubTypes->RowType == ROWTYPE_ADD) && $HangerSubTypes->EventCancelled) // Update failed
			$HangerSubTypes_grid->restoreCurrentRowFormValues($HangerSubTypes_grid->RowIndex); // Restore form values
		if ($HangerSubTypes->RowType == ROWTYPE_EDIT) // Edit row
			$HangerSubTypes_grid->EditRowCount++;
		if ($HangerSubTypes->isConfirm()) // Confirm row
			$HangerSubTypes_grid->restoreCurrentRowFormValues($HangerSubTypes_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$HangerSubTypes->RowAttrs->merge(["data-rowindex" => $HangerSubTypes_grid->RowCount, "id" => "r" . $HangerSubTypes_grid->RowCount . "_HangerSubTypes", "data-rowtype" => $HangerSubTypes->RowType]);

		// Render row
		$HangerSubTypes_grid->renderRow();

		// Render list options
		$HangerSubTypes_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($HangerSubTypes_grid->RowAction != "delete" && $HangerSubTypes_grid->RowAction != "insertdelete" && !($HangerSubTypes_grid->RowAction == "insert" && $HangerSubTypes->isConfirm() && $HangerSubTypes_grid->emptyRow())) {
?>
	<tr <?php echo $HangerSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HangerSubTypes_grid->ListOptions->render("body", "left", $HangerSubTypes_grid->RowCount);
?>
	<?php if ($HangerSubTypes_grid->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<td data-name="HangerSubType_Idn" <?php echo $HangerSubTypes_grid->HangerSubType_Idn->cellAttributes() ?>>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_HangerSubType_Idn" class="form-group"></span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerSubType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_HangerSubType_Idn" class="form-group">
<span<?php echo $HangerSubTypes_grid->HangerSubType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_grid->HangerSubType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerSubType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_HangerSubType_Idn">
<span<?php echo $HangerSubTypes_grid->HangerSubType_Idn->viewAttributes() ?>><?php echo $HangerSubTypes_grid->HangerSubType_Idn->getViewValue() ?></span>
</span>
<?php if (!$HangerSubTypes->isConfirm()) { ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerSubType_Idn->FormValue) ?>">
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerSubType_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="fHangerSubTypesgrid$x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" id="fHangerSubTypesgrid$x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerSubType_Idn->FormValue) ?>">
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="fHangerSubTypesgrid$o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" id="fHangerSubTypesgrid$o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerSubType_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_grid->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td data-name="HangerType_Idn" <?php echo $HangerSubTypes_grid->HangerType_Idn->cellAttributes() ?>>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($HangerSubTypes_grid->HangerType_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_HangerType_Idn" class="form-group">
<span<?php echo $HangerSubTypes_grid->HangerType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_grid->HangerType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerType_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_HangerType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="HangerSubTypes" data-field="x_HangerType_Idn" data-value-separator="<?php echo $HangerSubTypes_grid->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn"<?php echo $HangerSubTypes_grid->HangerType_Idn->editAttributes() ?>>
			<?php echo $HangerSubTypes_grid->HangerType_Idn->selectOptionListHtml("x{$HangerSubTypes_grid->RowIndex}_HangerType_Idn") ?>
		</select>
</div>
<?php echo $HangerSubTypes_grid->HangerType_Idn->Lookup->getParamTag($HangerSubTypes_grid, "p_x" . $HangerSubTypes_grid->RowIndex . "_HangerType_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerType_Idn" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($HangerSubTypes_grid->HangerType_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_HangerType_Idn" class="form-group">
<span<?php echo $HangerSubTypes_grid->HangerType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_grid->HangerType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerType_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_HangerType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="HangerSubTypes" data-field="x_HangerType_Idn" data-value-separator="<?php echo $HangerSubTypes_grid->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn"<?php echo $HangerSubTypes_grid->HangerType_Idn->editAttributes() ?>>
			<?php echo $HangerSubTypes_grid->HangerType_Idn->selectOptionListHtml("x{$HangerSubTypes_grid->RowIndex}_HangerType_Idn") ?>
		</select>
</div>
<?php echo $HangerSubTypes_grid->HangerType_Idn->Lookup->getParamTag($HangerSubTypes_grid, "p_x" . $HangerSubTypes_grid->RowIndex . "_HangerType_Idn") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_HangerType_Idn">
<span<?php echo $HangerSubTypes_grid->HangerType_Idn->viewAttributes() ?>><?php echo $HangerSubTypes_grid->HangerType_Idn->getViewValue() ?></span>
</span>
<?php if (!$HangerSubTypes->isConfirm()) { ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerType_Idn" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerType_Idn->FormValue) ?>">
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerType_Idn" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerType_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerType_Idn" name="fHangerSubTypesgrid$x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" id="fHangerSubTypesgrid$x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerType_Idn->FormValue) ?>">
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerType_Idn" name="fHangerSubTypesgrid$o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" id="fHangerSubTypesgrid$o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerType_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_grid->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $HangerSubTypes_grid->Name->cellAttributes() ?>>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_Name" class="form-group">
<input type="text" data-table="HangerSubTypes" data-field="x_Name" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerSubTypes_grid->Name->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_grid->Name->EditValue ?>"<?php echo $HangerSubTypes_grid->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Name" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerSubTypes_grid->Name->OldValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_Name" class="form-group">
<input type="text" data-table="HangerSubTypes" data-field="x_Name" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerSubTypes_grid->Name->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_grid->Name->EditValue ?>"<?php echo $HangerSubTypes_grid->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_Name">
<span<?php echo $HangerSubTypes_grid->Name->viewAttributes() ?>><?php echo $HangerSubTypes_grid->Name->getViewValue() ?></span>
</span>
<?php if (!$HangerSubTypes->isConfirm()) { ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Name" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerSubTypes_grid->Name->FormValue) ?>">
<input type="hidden" data-table="HangerSubTypes" data-field="x_Name" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerSubTypes_grid->Name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Name" name="fHangerSubTypesgrid$x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" id="fHangerSubTypesgrid$x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerSubTypes_grid->Name->FormValue) ?>">
<input type="hidden" data-table="HangerSubTypes" data-field="x_Name" name="fHangerSubTypesgrid$o<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" id="fHangerSubTypesgrid$o<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerSubTypes_grid->Name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_grid->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $HangerSubTypes_grid->Rank->cellAttributes() ?>>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_Rank" class="form-group">
<input type="text" data-table="HangerSubTypes" data-field="x_Rank" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerSubTypes_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_grid->Rank->EditValue ?>"<?php echo $HangerSubTypes_grid->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Rank" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerSubTypes_grid->Rank->OldValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_Rank" class="form-group">
<input type="text" data-table="HangerSubTypes" data-field="x_Rank" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerSubTypes_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_grid->Rank->EditValue ?>"<?php echo $HangerSubTypes_grid->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_Rank">
<span<?php echo $HangerSubTypes_grid->Rank->viewAttributes() ?>><?php echo $HangerSubTypes_grid->Rank->getViewValue() ?></span>
</span>
<?php if (!$HangerSubTypes->isConfirm()) { ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Rank" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerSubTypes_grid->Rank->FormValue) ?>">
<input type="hidden" data-table="HangerSubTypes" data-field="x_Rank" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerSubTypes_grid->Rank->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Rank" name="fHangerSubTypesgrid$x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" id="fHangerSubTypesgrid$x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerSubTypes_grid->Rank->FormValue) ?>">
<input type="hidden" data-table="HangerSubTypes" data-field="x_Rank" name="fHangerSubTypesgrid$o<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" id="fHangerSubTypesgrid$o<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerSubTypes_grid->Rank->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_grid->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $HangerSubTypes_grid->ActiveFlag->cellAttributes() ?>>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($HangerSubTypes_grid->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]_794956" value="1"<?php echo $selwrk ?><?php echo $HangerSubTypes_grid->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]_794956"></label>
</div>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HangerSubTypes_grid->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($HangerSubTypes_grid->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]_553063" value="1"<?php echo $selwrk ?><?php echo $HangerSubTypes_grid->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]_553063"></label>
</div>
</span>
<?php } ?>
<?php if ($HangerSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $HangerSubTypes_grid->RowCount ?>_HangerSubTypes_ActiveFlag">
<span<?php echo $HangerSubTypes_grid->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HangerSubTypes_grid->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HangerSubTypes_grid->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php if (!$HangerSubTypes->isConfirm()) { ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag" value="<?php echo HtmlEncode($HangerSubTypes_grid->ActiveFlag->FormValue) ?>">
<input type="hidden" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HangerSubTypes_grid->ActiveFlag->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="fHangerSubTypesgrid$x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag" id="fHangerSubTypesgrid$x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag" value="<?php echo HtmlEncode($HangerSubTypes_grid->ActiveFlag->FormValue) ?>">
<input type="hidden" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="fHangerSubTypesgrid$o<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="fHangerSubTypesgrid$o<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HangerSubTypes_grid->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$HangerSubTypes_grid->ListOptions->render("body", "right", $HangerSubTypes_grid->RowCount);
?>
	</tr>
<?php if ($HangerSubTypes->RowType == ROWTYPE_ADD || $HangerSubTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fHangerSubTypesgrid", "load"], function() {
	fHangerSubTypesgrid.updateLists(<?php echo $HangerSubTypes_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$HangerSubTypes_grid->isGridAdd() || $HangerSubTypes->CurrentMode == "copy")
		if (!$HangerSubTypes_grid->Recordset->EOF)
			$HangerSubTypes_grid->Recordset->moveNext();
}
?>
<?php
	if ($HangerSubTypes->CurrentMode == "add" || $HangerSubTypes->CurrentMode == "copy" || $HangerSubTypes->CurrentMode == "edit") {
		$HangerSubTypes_grid->RowIndex = '$rowindex$';
		$HangerSubTypes_grid->loadRowValues();

		// Set row properties
		$HangerSubTypes->resetAttributes();
		$HangerSubTypes->RowAttrs->merge(["data-rowindex" => $HangerSubTypes_grid->RowIndex, "id" => "r0_HangerSubTypes", "data-rowtype" => ROWTYPE_ADD]);
		$HangerSubTypes->RowAttrs->appendClass("ew-template");
		$HangerSubTypes->RowType = ROWTYPE_ADD;

		// Render row
		$HangerSubTypes_grid->renderRow();

		// Render list options
		$HangerSubTypes_grid->renderListOptions();
		$HangerSubTypes_grid->StartRowCount = 0;
?>
	<tr <?php echo $HangerSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HangerSubTypes_grid->ListOptions->render("body", "left", $HangerSubTypes_grid->RowIndex);
?>
	<?php if ($HangerSubTypes_grid->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<td data-name="HangerSubType_Idn">
<?php if (!$HangerSubTypes->isConfirm()) { ?>
<span id="el$rowindex$_HangerSubTypes_HangerSubType_Idn" class="form-group HangerSubTypes_HangerSubType_Idn"></span>
<?php } else { ?>
<span id="el$rowindex$_HangerSubTypes_HangerSubType_Idn" class="form-group HangerSubTypes_HangerSubType_Idn">
<span<?php echo $HangerSubTypes_grid->HangerSubType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_grid->HangerSubType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerSubType_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerSubType_Idn" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerSubType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerSubType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_grid->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<td data-name="HangerType_Idn">
<?php if (!$HangerSubTypes->isConfirm()) { ?>
<?php if ($HangerSubTypes_grid->HangerType_Idn->getSessionValue() != "") { ?>
<span id="el$rowindex$_HangerSubTypes_HangerType_Idn" class="form-group HangerSubTypes_HangerType_Idn">
<span<?php echo $HangerSubTypes_grid->HangerType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_grid->HangerType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerType_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_HangerSubTypes_HangerType_Idn" class="form-group HangerSubTypes_HangerType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="HangerSubTypes" data-field="x_HangerType_Idn" data-value-separator="<?php echo $HangerSubTypes_grid->HangerType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn"<?php echo $HangerSubTypes_grid->HangerType_Idn->editAttributes() ?>>
			<?php echo $HangerSubTypes_grid->HangerType_Idn->selectOptionListHtml("x{$HangerSubTypes_grid->RowIndex}_HangerType_Idn") ?>
		</select>
</div>
<?php echo $HangerSubTypes_grid->HangerType_Idn->Lookup->getParamTag($HangerSubTypes_grid, "p_x" . $HangerSubTypes_grid->RowIndex . "_HangerType_Idn") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_HangerSubTypes_HangerType_Idn" class="form-group HangerSubTypes_HangerType_Idn">
<span<?php echo $HangerSubTypes_grid->HangerType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_grid->HangerType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerType_Idn" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerType_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_HangerType_Idn" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_HangerType_Idn" value="<?php echo HtmlEncode($HangerSubTypes_grid->HangerType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_grid->Name->Visible) { // Name ?>
		<td data-name="Name">
<?php if (!$HangerSubTypes->isConfirm()) { ?>
<span id="el$rowindex$_HangerSubTypes_Name" class="form-group HangerSubTypes_Name">
<input type="text" data-table="HangerSubTypes" data-field="x_Name" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($HangerSubTypes_grid->Name->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_grid->Name->EditValue ?>"<?php echo $HangerSubTypes_grid->Name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_HangerSubTypes_Name" class="form-group HangerSubTypes_Name">
<span<?php echo $HangerSubTypes_grid->Name->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_grid->Name->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Name" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerSubTypes_grid->Name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Name" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($HangerSubTypes_grid->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_grid->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<?php if (!$HangerSubTypes->isConfirm()) { ?>
<span id="el$rowindex$_HangerSubTypes_Rank" class="form-group HangerSubTypes_Rank">
<input type="text" data-table="HangerSubTypes" data-field="x_Rank" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($HangerSubTypes_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $HangerSubTypes_grid->Rank->EditValue ?>"<?php echo $HangerSubTypes_grid->Rank->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_HangerSubTypes_Rank" class="form-group HangerSubTypes_Rank">
<span<?php echo $HangerSubTypes_grid->Rank->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($HangerSubTypes_grid->Rank->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Rank" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerSubTypes_grid->Rank->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_Rank" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($HangerSubTypes_grid->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($HangerSubTypes_grid->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<?php if (!$HangerSubTypes->isConfirm()) { ?>
<span id="el$rowindex$_HangerSubTypes_ActiveFlag" class="form-group HangerSubTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($HangerSubTypes_grid->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]_899767" value="1"<?php echo $selwrk ?><?php echo $HangerSubTypes_grid->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]_899767"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_HangerSubTypes_ActiveFlag" class="form-group HangerSubTypes_ActiveFlag">
<span<?php echo $HangerSubTypes_grid->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HangerSubTypes_grid->ActiveFlag->ViewValue ?>" disabled<?php if (ConvertToBool($HangerSubTypes_grid->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<input type="hidden" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag" id="x<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag" value="<?php echo HtmlEncode($HangerSubTypes_grid->ActiveFlag->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="HangerSubTypes" data-field="x_ActiveFlag" name="o<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="o<?php echo $HangerSubTypes_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($HangerSubTypes_grid->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$HangerSubTypes_grid->ListOptions->render("body", "right", $HangerSubTypes_grid->RowIndex);
?>
<script>
loadjs.ready(["fHangerSubTypesgrid", "load"], function() {
	fHangerSubTypesgrid.updateLists(<?php echo $HangerSubTypes_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($HangerSubTypes->CurrentMode == "add" || $HangerSubTypes->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $HangerSubTypes_grid->FormKeyCountName ?>" id="<?php echo $HangerSubTypes_grid->FormKeyCountName ?>" value="<?php echo $HangerSubTypes_grid->KeyCount ?>">
<?php echo $HangerSubTypes_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($HangerSubTypes->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $HangerSubTypes_grid->FormKeyCountName ?>" id="<?php echo $HangerSubTypes_grid->FormKeyCountName ?>" value="<?php echo $HangerSubTypes_grid->KeyCount ?>">
<?php echo $HangerSubTypes_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($HangerSubTypes->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fHangerSubTypesgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($HangerSubTypes_grid->Recordset)
	$HangerSubTypes_grid->Recordset->Close();
?>
<?php if ($HangerSubTypes_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $HangerSubTypes_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($HangerSubTypes_grid->TotalRecords == 0 && !$HangerSubTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $HangerSubTypes_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$HangerSubTypes_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$HangerSubTypes_grid->terminate();
?>