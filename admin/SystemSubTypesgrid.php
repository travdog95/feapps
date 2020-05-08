<?php
namespace PHPMaker2020\feapps51;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($SystemSubTypes_grid))
	$SystemSubTypes_grid = new SystemSubTypes_grid();

// Run the page
$SystemSubTypes_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SystemSubTypes_grid->Page_Render();
?>
<?php if (!$SystemSubTypes_grid->isExport()) { ?>
<script>
var fSystemSubTypesgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fSystemSubTypesgrid = new ew.Form("fSystemSubTypesgrid", "grid");
	fSystemSubTypesgrid.formKeyCountName = '<?php echo $SystemSubTypes_grid->FormKeyCountName ?>';

	// Validate form
	fSystemSubTypesgrid.validate = function() {
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
			<?php if ($SystemSubTypes_grid->SystemSubType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SystemSubType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_grid->SystemSubType_Idn->caption(), $SystemSubTypes_grid->SystemSubType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemSubTypes_grid->SystemType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_SystemType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_grid->SystemType_Idn->caption(), $SystemSubTypes_grid->SystemType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemSubTypes_grid->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_grid->Name->caption(), $SystemSubTypes_grid->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($SystemSubTypes_grid->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_grid->Rank->caption(), $SystemSubTypes_grid->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($SystemSubTypes_grid->Rank->errorMessage()) ?>");
			<?php if ($SystemSubTypes_grid->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $SystemSubTypes_grid->ActiveFlag->caption(), $SystemSubTypes_grid->ActiveFlag->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fSystemSubTypesgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "SystemType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fSystemSubTypesgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fSystemSubTypesgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fSystemSubTypesgrid.lists["x_SystemType_Idn"] = <?php echo $SystemSubTypes_grid->SystemType_Idn->Lookup->toClientList($SystemSubTypes_grid) ?>;
	fSystemSubTypesgrid.lists["x_SystemType_Idn"].options = <?php echo JsonEncode($SystemSubTypes_grid->SystemType_Idn->lookupOptions()) ?>;
	fSystemSubTypesgrid.lists["x_ActiveFlag[]"] = <?php echo $SystemSubTypes_grid->ActiveFlag->Lookup->toClientList($SystemSubTypes_grid) ?>;
	fSystemSubTypesgrid.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($SystemSubTypes_grid->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fSystemSubTypesgrid");
});
</script>
<?php } ?>
<?php
$SystemSubTypes_grid->renderOtherOptions();
?>
<?php if ($SystemSubTypes_grid->TotalRecords > 0 || $SystemSubTypes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($SystemSubTypes_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> SystemSubTypes">
<?php if ($SystemSubTypes_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $SystemSubTypes_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fSystemSubTypesgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_SystemSubTypes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_SystemSubTypesgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$SystemSubTypes->RowType = ROWTYPE_HEADER;

// Render list options
$SystemSubTypes_grid->renderListOptions();

// Render list options (header, left)
$SystemSubTypes_grid->ListOptions->render("header", "left");
?>
<?php if ($SystemSubTypes_grid->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
	<?php if ($SystemSubTypes_grid->SortUrl($SystemSubTypes_grid->SystemSubType_Idn) == "") { ?>
		<th data-name="SystemSubType_Idn" class="<?php echo $SystemSubTypes_grid->SystemSubType_Idn->headerCellClass() ?>"><div id="elh_SystemSubTypes_SystemSubType_Idn" class="SystemSubTypes_SystemSubType_Idn"><div class="ew-table-header-caption"><?php echo $SystemSubTypes_grid->SystemSubType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SystemSubType_Idn" class="<?php echo $SystemSubTypes_grid->SystemSubType_Idn->headerCellClass() ?>"><div><div id="elh_SystemSubTypes_SystemSubType_Idn" class="SystemSubTypes_SystemSubType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_grid->SystemSubType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_grid->SystemSubType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_grid->SystemSubType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_grid->SystemType_Idn->Visible) { // SystemType_Idn ?>
	<?php if ($SystemSubTypes_grid->SortUrl($SystemSubTypes_grid->SystemType_Idn) == "") { ?>
		<th data-name="SystemType_Idn" class="<?php echo $SystemSubTypes_grid->SystemType_Idn->headerCellClass() ?>"><div id="elh_SystemSubTypes_SystemType_Idn" class="SystemSubTypes_SystemType_Idn"><div class="ew-table-header-caption"><?php echo $SystemSubTypes_grid->SystemType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SystemType_Idn" class="<?php echo $SystemSubTypes_grid->SystemType_Idn->headerCellClass() ?>"><div><div id="elh_SystemSubTypes_SystemType_Idn" class="SystemSubTypes_SystemType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_grid->SystemType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_grid->SystemType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_grid->SystemType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_grid->Name->Visible) { // Name ?>
	<?php if ($SystemSubTypes_grid->SortUrl($SystemSubTypes_grid->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $SystemSubTypes_grid->Name->headerCellClass() ?>"><div id="elh_SystemSubTypes_Name" class="SystemSubTypes_Name"><div class="ew-table-header-caption"><?php echo $SystemSubTypes_grid->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $SystemSubTypes_grid->Name->headerCellClass() ?>"><div><div id="elh_SystemSubTypes_Name" class="SystemSubTypes_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_grid->Name->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_grid->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_grid->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_grid->Rank->Visible) { // Rank ?>
	<?php if ($SystemSubTypes_grid->SortUrl($SystemSubTypes_grid->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $SystemSubTypes_grid->Rank->headerCellClass() ?>"><div id="elh_SystemSubTypes_Rank" class="SystemSubTypes_Rank"><div class="ew-table-header-caption"><?php echo $SystemSubTypes_grid->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $SystemSubTypes_grid->Rank->headerCellClass() ?>"><div><div id="elh_SystemSubTypes_Rank" class="SystemSubTypes_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_grid->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_grid->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_grid->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_grid->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($SystemSubTypes_grid->SortUrl($SystemSubTypes_grid->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $SystemSubTypes_grid->ActiveFlag->headerCellClass() ?>"><div id="elh_SystemSubTypes_ActiveFlag" class="SystemSubTypes_ActiveFlag"><div class="ew-table-header-caption"><?php echo $SystemSubTypes_grid->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $SystemSubTypes_grid->ActiveFlag->headerCellClass() ?>"><div><div id="elh_SystemSubTypes_ActiveFlag" class="SystemSubTypes_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_grid->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_grid->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_grid->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$SystemSubTypes_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$SystemSubTypes_grid->StartRecord = 1;
$SystemSubTypes_grid->StopRecord = $SystemSubTypes_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($SystemSubTypes->isConfirm() || $SystemSubTypes_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($SystemSubTypes_grid->FormKeyCountName) && ($SystemSubTypes_grid->isGridAdd() || $SystemSubTypes_grid->isGridEdit() || $SystemSubTypes->isConfirm())) {
		$SystemSubTypes_grid->KeyCount = $CurrentForm->getValue($SystemSubTypes_grid->FormKeyCountName);
		$SystemSubTypes_grid->StopRecord = $SystemSubTypes_grid->StartRecord + $SystemSubTypes_grid->KeyCount - 1;
	}
}
$SystemSubTypes_grid->RecordCount = $SystemSubTypes_grid->StartRecord - 1;
if ($SystemSubTypes_grid->Recordset && !$SystemSubTypes_grid->Recordset->EOF) {
	$SystemSubTypes_grid->Recordset->moveFirst();
	$selectLimit = $SystemSubTypes_grid->UseSelectLimit;
	if (!$selectLimit && $SystemSubTypes_grid->StartRecord > 1)
		$SystemSubTypes_grid->Recordset->move($SystemSubTypes_grid->StartRecord - 1);
} elseif (!$SystemSubTypes->AllowAddDeleteRow && $SystemSubTypes_grid->StopRecord == 0) {
	$SystemSubTypes_grid->StopRecord = $SystemSubTypes->GridAddRowCount;
}

// Initialize aggregate
$SystemSubTypes->RowType = ROWTYPE_AGGREGATEINIT;
$SystemSubTypes->resetAttributes();
$SystemSubTypes_grid->renderRow();
if ($SystemSubTypes_grid->isGridAdd())
	$SystemSubTypes_grid->RowIndex = 0;
if ($SystemSubTypes_grid->isGridEdit())
	$SystemSubTypes_grid->RowIndex = 0;
while ($SystemSubTypes_grid->RecordCount < $SystemSubTypes_grid->StopRecord) {
	$SystemSubTypes_grid->RecordCount++;
	if ($SystemSubTypes_grid->RecordCount >= $SystemSubTypes_grid->StartRecord) {
		$SystemSubTypes_grid->RowCount++;
		if ($SystemSubTypes_grid->isGridAdd() || $SystemSubTypes_grid->isGridEdit() || $SystemSubTypes->isConfirm()) {
			$SystemSubTypes_grid->RowIndex++;
			$CurrentForm->Index = $SystemSubTypes_grid->RowIndex;
			if ($CurrentForm->hasValue($SystemSubTypes_grid->FormActionName) && ($SystemSubTypes->isConfirm() || $SystemSubTypes_grid->EventCancelled))
				$SystemSubTypes_grid->RowAction = strval($CurrentForm->getValue($SystemSubTypes_grid->FormActionName));
			elseif ($SystemSubTypes_grid->isGridAdd())
				$SystemSubTypes_grid->RowAction = "insert";
			else
				$SystemSubTypes_grid->RowAction = "";
		}

		// Set up key count
		$SystemSubTypes_grid->KeyCount = $SystemSubTypes_grid->RowIndex;

		// Init row class and style
		$SystemSubTypes->resetAttributes();
		$SystemSubTypes->CssClass = "";
		if ($SystemSubTypes_grid->isGridAdd()) {
			if ($SystemSubTypes->CurrentMode == "copy") {
				$SystemSubTypes_grid->loadRowValues($SystemSubTypes_grid->Recordset); // Load row values
				$SystemSubTypes_grid->setRecordKey($SystemSubTypes_grid->RowOldKey, $SystemSubTypes_grid->Recordset); // Set old record key
			} else {
				$SystemSubTypes_grid->loadRowValues(); // Load default values
				$SystemSubTypes_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$SystemSubTypes_grid->loadRowValues($SystemSubTypes_grid->Recordset); // Load row values
		}
		$SystemSubTypes->RowType = ROWTYPE_VIEW; // Render view
		if ($SystemSubTypes_grid->isGridAdd()) // Grid add
			$SystemSubTypes->RowType = ROWTYPE_ADD; // Render add
		if ($SystemSubTypes_grid->isGridAdd() && $SystemSubTypes->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$SystemSubTypes_grid->restoreCurrentRowFormValues($SystemSubTypes_grid->RowIndex); // Restore form values
		if ($SystemSubTypes_grid->isGridEdit()) { // Grid edit
			if ($SystemSubTypes->EventCancelled)
				$SystemSubTypes_grid->restoreCurrentRowFormValues($SystemSubTypes_grid->RowIndex); // Restore form values
			if ($SystemSubTypes_grid->RowAction == "insert")
				$SystemSubTypes->RowType = ROWTYPE_ADD; // Render add
			else
				$SystemSubTypes->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($SystemSubTypes_grid->isGridEdit() && ($SystemSubTypes->RowType == ROWTYPE_EDIT || $SystemSubTypes->RowType == ROWTYPE_ADD) && $SystemSubTypes->EventCancelled) // Update failed
			$SystemSubTypes_grid->restoreCurrentRowFormValues($SystemSubTypes_grid->RowIndex); // Restore form values
		if ($SystemSubTypes->RowType == ROWTYPE_EDIT) // Edit row
			$SystemSubTypes_grid->EditRowCount++;
		if ($SystemSubTypes->isConfirm()) // Confirm row
			$SystemSubTypes_grid->restoreCurrentRowFormValues($SystemSubTypes_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$SystemSubTypes->RowAttrs->merge(["data-rowindex" => $SystemSubTypes_grid->RowCount, "id" => "r" . $SystemSubTypes_grid->RowCount . "_SystemSubTypes", "data-rowtype" => $SystemSubTypes->RowType]);

		// Render row
		$SystemSubTypes_grid->renderRow();

		// Render list options
		$SystemSubTypes_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($SystemSubTypes_grid->RowAction != "delete" && $SystemSubTypes_grid->RowAction != "insertdelete" && !($SystemSubTypes_grid->RowAction == "insert" && $SystemSubTypes->isConfirm() && $SystemSubTypes_grid->emptyRow())) {
?>
	<tr <?php echo $SystemSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$SystemSubTypes_grid->ListOptions->render("body", "left", $SystemSubTypes_grid->RowCount);
?>
	<?php if ($SystemSubTypes_grid->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
		<td data-name="SystemSubType_Idn" <?php echo $SystemSubTypes_grid->SystemSubType_Idn->cellAttributes() ?>>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_SystemSubType_Idn" class="form-group"></span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemSubType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_SystemSubType_Idn" class="form-group">
<span<?php echo $SystemSubTypes_grid->SystemSubType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($SystemSubTypes_grid->SystemSubType_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemSubType_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_SystemSubType_Idn">
<span<?php echo $SystemSubTypes_grid->SystemSubType_Idn->viewAttributes() ?>><?php echo $SystemSubTypes_grid->SystemSubType_Idn->getViewValue() ?></span>
</span>
<?php if (!$SystemSubTypes->isConfirm()) { ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemSubType_Idn->FormValue) ?>">
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemSubType_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="fSystemSubTypesgrid$x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" id="fSystemSubTypesgrid$x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemSubType_Idn->FormValue) ?>">
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="fSystemSubTypesgrid$o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" id="fSystemSubTypesgrid$o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemSubType_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_grid->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<td data-name="SystemType_Idn" <?php echo $SystemSubTypes_grid->SystemType_Idn->cellAttributes() ?>>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_SystemType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemSubTypes" data-field="x_SystemType_Idn" data-value-separator="<?php echo $SystemSubTypes_grid->SystemType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn"<?php echo $SystemSubTypes_grid->SystemType_Idn->editAttributes() ?>>
			<?php echo $SystemSubTypes_grid->SystemType_Idn->selectOptionListHtml("x{$SystemSubTypes_grid->RowIndex}_SystemType_Idn") ?>
		</select>
</div>
<?php echo $SystemSubTypes_grid->SystemType_Idn->Lookup->getParamTag($SystemSubTypes_grid, "p_x" . $SystemSubTypes_grid->RowIndex . "_SystemType_Idn") ?>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemType_Idn" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_SystemType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemSubTypes" data-field="x_SystemType_Idn" data-value-separator="<?php echo $SystemSubTypes_grid->SystemType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn"<?php echo $SystemSubTypes_grid->SystemType_Idn->editAttributes() ?>>
			<?php echo $SystemSubTypes_grid->SystemType_Idn->selectOptionListHtml("x{$SystemSubTypes_grid->RowIndex}_SystemType_Idn") ?>
		</select>
</div>
<?php echo $SystemSubTypes_grid->SystemType_Idn->Lookup->getParamTag($SystemSubTypes_grid, "p_x" . $SystemSubTypes_grid->RowIndex . "_SystemType_Idn") ?>
</span>
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_SystemType_Idn">
<span<?php echo $SystemSubTypes_grid->SystemType_Idn->viewAttributes() ?>><?php echo $SystemSubTypes_grid->SystemType_Idn->getViewValue() ?></span>
</span>
<?php if (!$SystemSubTypes->isConfirm()) { ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemType_Idn" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemType_Idn->FormValue) ?>">
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemType_Idn" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemType_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemType_Idn" name="fSystemSubTypesgrid$x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" id="fSystemSubTypesgrid$x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemType_Idn->FormValue) ?>">
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemType_Idn" name="fSystemSubTypesgrid$o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" id="fSystemSubTypesgrid$o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemType_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_grid->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $SystemSubTypes_grid->Name->cellAttributes() ?>>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_Name" class="form-group">
<input type="text" data-table="SystemSubTypes" data-field="x_Name" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemSubTypes_grid->Name->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_grid->Name->EditValue ?>"<?php echo $SystemSubTypes_grid->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Name" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemSubTypes_grid->Name->OldValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_Name" class="form-group">
<input type="text" data-table="SystemSubTypes" data-field="x_Name" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemSubTypes_grid->Name->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_grid->Name->EditValue ?>"<?php echo $SystemSubTypes_grid->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_Name">
<span<?php echo $SystemSubTypes_grid->Name->viewAttributes() ?>><?php echo $SystemSubTypes_grid->Name->getViewValue() ?></span>
</span>
<?php if (!$SystemSubTypes->isConfirm()) { ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Name" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemSubTypes_grid->Name->FormValue) ?>">
<input type="hidden" data-table="SystemSubTypes" data-field="x_Name" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemSubTypes_grid->Name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Name" name="fSystemSubTypesgrid$x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" id="fSystemSubTypesgrid$x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemSubTypes_grid->Name->FormValue) ?>">
<input type="hidden" data-table="SystemSubTypes" data-field="x_Name" name="fSystemSubTypesgrid$o<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" id="fSystemSubTypesgrid$o<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemSubTypes_grid->Name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_grid->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $SystemSubTypes_grid->Rank->cellAttributes() ?>>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_Rank" class="form-group">
<input type="text" data-table="SystemSubTypes" data-field="x_Rank" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemSubTypes_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_grid->Rank->EditValue ?>"<?php echo $SystemSubTypes_grid->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Rank" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemSubTypes_grid->Rank->OldValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_Rank" class="form-group">
<input type="text" data-table="SystemSubTypes" data-field="x_Rank" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemSubTypes_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_grid->Rank->EditValue ?>"<?php echo $SystemSubTypes_grid->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_Rank">
<span<?php echo $SystemSubTypes_grid->Rank->viewAttributes() ?>><?php echo $SystemSubTypes_grid->Rank->getViewValue() ?></span>
</span>
<?php if (!$SystemSubTypes->isConfirm()) { ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Rank" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemSubTypes_grid->Rank->FormValue) ?>">
<input type="hidden" data-table="SystemSubTypes" data-field="x_Rank" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemSubTypes_grid->Rank->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Rank" name="fSystemSubTypesgrid$x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" id="fSystemSubTypesgrid$x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemSubTypes_grid->Rank->FormValue) ?>">
<input type="hidden" data-table="SystemSubTypes" data-field="x_Rank" name="fSystemSubTypesgrid$o<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" id="fSystemSubTypesgrid$o<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemSubTypes_grid->Rank->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_grid->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $SystemSubTypes_grid->ActiveFlag->cellAttributes() ?>>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($SystemSubTypes_grid->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]_670280" value="1"<?php echo $selwrk ?><?php echo $SystemSubTypes_grid->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]_670280"></label>
</div>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($SystemSubTypes_grid->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($SystemSubTypes_grid->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]_418924" value="1"<?php echo $selwrk ?><?php echo $SystemSubTypes_grid->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]_418924"></label>
</div>
</span>
<?php } ?>
<?php if ($SystemSubTypes->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $SystemSubTypes_grid->RowCount ?>_SystemSubTypes_ActiveFlag">
<span<?php echo $SystemSubTypes_grid->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $SystemSubTypes_grid->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($SystemSubTypes_grid->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php if (!$SystemSubTypes->isConfirm()) { ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag" value="<?php echo HtmlEncode($SystemSubTypes_grid->ActiveFlag->FormValue) ?>">
<input type="hidden" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($SystemSubTypes_grid->ActiveFlag->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="fSystemSubTypesgrid$x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag" id="fSystemSubTypesgrid$x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag" value="<?php echo HtmlEncode($SystemSubTypes_grid->ActiveFlag->FormValue) ?>">
<input type="hidden" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="fSystemSubTypesgrid$o<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="fSystemSubTypesgrid$o<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($SystemSubTypes_grid->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$SystemSubTypes_grid->ListOptions->render("body", "right", $SystemSubTypes_grid->RowCount);
?>
	</tr>
<?php if ($SystemSubTypes->RowType == ROWTYPE_ADD || $SystemSubTypes->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fSystemSubTypesgrid", "load"], function() {
	fSystemSubTypesgrid.updateLists(<?php echo $SystemSubTypes_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$SystemSubTypes_grid->isGridAdd() || $SystemSubTypes->CurrentMode == "copy")
		if (!$SystemSubTypes_grid->Recordset->EOF)
			$SystemSubTypes_grid->Recordset->moveNext();
}
?>
<?php
	if ($SystemSubTypes->CurrentMode == "add" || $SystemSubTypes->CurrentMode == "copy" || $SystemSubTypes->CurrentMode == "edit") {
		$SystemSubTypes_grid->RowIndex = '$rowindex$';
		$SystemSubTypes_grid->loadRowValues();

		// Set row properties
		$SystemSubTypes->resetAttributes();
		$SystemSubTypes->RowAttrs->merge(["data-rowindex" => $SystemSubTypes_grid->RowIndex, "id" => "r0_SystemSubTypes", "data-rowtype" => ROWTYPE_ADD]);
		$SystemSubTypes->RowAttrs->appendClass("ew-template");
		$SystemSubTypes->RowType = ROWTYPE_ADD;

		// Render row
		$SystemSubTypes_grid->renderRow();

		// Render list options
		$SystemSubTypes_grid->renderListOptions();
		$SystemSubTypes_grid->StartRowCount = 0;
?>
	<tr <?php echo $SystemSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$SystemSubTypes_grid->ListOptions->render("body", "left", $SystemSubTypes_grid->RowIndex);
?>
	<?php if ($SystemSubTypes_grid->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
		<td data-name="SystemSubType_Idn">
<?php if (!$SystemSubTypes->isConfirm()) { ?>
<span id="el$rowindex$_SystemSubTypes_SystemSubType_Idn" class="form-group SystemSubTypes_SystemSubType_Idn"></span>
<?php } else { ?>
<span id="el$rowindex$_SystemSubTypes_SystemSubType_Idn" class="form-group SystemSubTypes_SystemSubType_Idn">
<span<?php echo $SystemSubTypes_grid->SystemSubType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($SystemSubTypes_grid->SystemSubType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemSubType_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemSubType_Idn" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemSubType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemSubType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_grid->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<td data-name="SystemType_Idn">
<?php if (!$SystemSubTypes->isConfirm()) { ?>
<span id="el$rowindex$_SystemSubTypes_SystemType_Idn" class="form-group SystemSubTypes_SystemType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="SystemSubTypes" data-field="x_SystemType_Idn" data-value-separator="<?php echo $SystemSubTypes_grid->SystemType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn"<?php echo $SystemSubTypes_grid->SystemType_Idn->editAttributes() ?>>
			<?php echo $SystemSubTypes_grid->SystemType_Idn->selectOptionListHtml("x{$SystemSubTypes_grid->RowIndex}_SystemType_Idn") ?>
		</select>
</div>
<?php echo $SystemSubTypes_grid->SystemType_Idn->Lookup->getParamTag($SystemSubTypes_grid, "p_x" . $SystemSubTypes_grid->RowIndex . "_SystemType_Idn") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_SystemSubTypes_SystemType_Idn" class="form-group SystemSubTypes_SystemType_Idn">
<span<?php echo $SystemSubTypes_grid->SystemType_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($SystemSubTypes_grid->SystemType_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemType_Idn" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemType_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_SystemType_Idn" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_SystemType_Idn" value="<?php echo HtmlEncode($SystemSubTypes_grid->SystemType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_grid->Name->Visible) { // Name ?>
		<td data-name="Name">
<?php if (!$SystemSubTypes->isConfirm()) { ?>
<span id="el$rowindex$_SystemSubTypes_Name" class="form-group SystemSubTypes_Name">
<input type="text" data-table="SystemSubTypes" data-field="x_Name" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($SystemSubTypes_grid->Name->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_grid->Name->EditValue ?>"<?php echo $SystemSubTypes_grid->Name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_SystemSubTypes_Name" class="form-group SystemSubTypes_Name">
<span<?php echo $SystemSubTypes_grid->Name->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($SystemSubTypes_grid->Name->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Name" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemSubTypes_grid->Name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Name" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($SystemSubTypes_grid->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_grid->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<?php if (!$SystemSubTypes->isConfirm()) { ?>
<span id="el$rowindex$_SystemSubTypes_Rank" class="form-group SystemSubTypes_Rank">
<input type="text" data-table="SystemSubTypes" data-field="x_Rank" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($SystemSubTypes_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $SystemSubTypes_grid->Rank->EditValue ?>"<?php echo $SystemSubTypes_grid->Rank->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_SystemSubTypes_Rank" class="form-group SystemSubTypes_Rank">
<span<?php echo $SystemSubTypes_grid->Rank->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($SystemSubTypes_grid->Rank->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Rank" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemSubTypes_grid->Rank->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_Rank" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($SystemSubTypes_grid->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($SystemSubTypes_grid->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<?php if (!$SystemSubTypes->isConfirm()) { ?>
<span id="el$rowindex$_SystemSubTypes_ActiveFlag" class="form-group SystemSubTypes_ActiveFlag">
<?php
$selwrk = ConvertToBool($SystemSubTypes_grid->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]_514458" value="1"<?php echo $selwrk ?><?php echo $SystemSubTypes_grid->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]_514458"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_SystemSubTypes_ActiveFlag" class="form-group SystemSubTypes_ActiveFlag">
<span<?php echo $SystemSubTypes_grid->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $SystemSubTypes_grid->ActiveFlag->ViewValue ?>" disabled<?php if (ConvertToBool($SystemSubTypes_grid->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<input type="hidden" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag" id="x<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag" value="<?php echo HtmlEncode($SystemSubTypes_grid->ActiveFlag->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="SystemSubTypes" data-field="x_ActiveFlag" name="o<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]" id="o<?php echo $SystemSubTypes_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($SystemSubTypes_grid->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$SystemSubTypes_grid->ListOptions->render("body", "right", $SystemSubTypes_grid->RowIndex);
?>
<script>
loadjs.ready(["fSystemSubTypesgrid", "load"], function() {
	fSystemSubTypesgrid.updateLists(<?php echo $SystemSubTypes_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($SystemSubTypes->CurrentMode == "add" || $SystemSubTypes->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $SystemSubTypes_grid->FormKeyCountName ?>" id="<?php echo $SystemSubTypes_grid->FormKeyCountName ?>" value="<?php echo $SystemSubTypes_grid->KeyCount ?>">
<?php echo $SystemSubTypes_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($SystemSubTypes->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $SystemSubTypes_grid->FormKeyCountName ?>" id="<?php echo $SystemSubTypes_grid->FormKeyCountName ?>" value="<?php echo $SystemSubTypes_grid->KeyCount ?>">
<?php echo $SystemSubTypes_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($SystemSubTypes->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fSystemSubTypesgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($SystemSubTypes_grid->Recordset)
	$SystemSubTypes_grid->Recordset->Close();
?>
<?php if ($SystemSubTypes_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $SystemSubTypes_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($SystemSubTypes_grid->TotalRecords == 0 && !$SystemSubTypes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $SystemSubTypes_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$SystemSubTypes_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$SystemSubTypes_grid->terminate();
?>