<?php
namespace PHPMaker2020\feapps51;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($AdjustmentSubFactors_grid))
	$AdjustmentSubFactors_grid = new AdjustmentSubFactors_grid();

// Run the page
$AdjustmentSubFactors_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AdjustmentSubFactors_grid->Page_Render();
?>
<?php if (!$AdjustmentSubFactors_grid->isExport()) { ?>
<script>
var fAdjustmentSubFactorsgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fAdjustmentSubFactorsgrid = new ew.Form("fAdjustmentSubFactorsgrid", "grid");
	fAdjustmentSubFactorsgrid.formKeyCountName = '<?php echo $AdjustmentSubFactors_grid->FormKeyCountName ?>';

	// Validate form
	fAdjustmentSubFactorsgrid.validate = function() {
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
			<?php if ($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_AdjustmentSubFactor_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->caption(), $AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_AdjustmentFactor_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->caption(), $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_grid->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_grid->Name->caption(), $AdjustmentSubFactors_grid->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_grid->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_grid->Value->caption(), $AdjustmentSubFactors_grid->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($AdjustmentSubFactors_grid->Value->errorMessage()) ?>");
			<?php if ($AdjustmentSubFactors_grid->LaborClass_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_LaborClass_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_grid->LaborClass_Idn->caption(), $AdjustmentSubFactors_grid->LaborClass_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($AdjustmentSubFactors_grid->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_grid->Rank->caption(), $AdjustmentSubFactors_grid->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($AdjustmentSubFactors_grid->Rank->errorMessage()) ?>");
			<?php if ($AdjustmentSubFactors_grid->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AdjustmentSubFactors_grid->ActiveFlag->caption(), $AdjustmentSubFactors_grid->ActiveFlag->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fAdjustmentSubFactorsgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "AdjustmentFactor_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "Value", false)) return false;
		if (ew.valueChanged(fobj, infix, "LaborClass_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fAdjustmentSubFactorsgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fAdjustmentSubFactorsgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fAdjustmentSubFactorsgrid.lists["x_AdjustmentFactor_Idn"] = <?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->Lookup->toClientList($AdjustmentSubFactors_grid) ?>;
	fAdjustmentSubFactorsgrid.lists["x_AdjustmentFactor_Idn"].options = <?php echo JsonEncode($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->lookupOptions()) ?>;
	fAdjustmentSubFactorsgrid.lists["x_LaborClass_Idn"] = <?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->Lookup->toClientList($AdjustmentSubFactors_grid) ?>;
	fAdjustmentSubFactorsgrid.lists["x_LaborClass_Idn"].options = <?php echo JsonEncode($AdjustmentSubFactors_grid->LaborClass_Idn->lookupOptions()) ?>;
	fAdjustmentSubFactorsgrid.lists["x_ActiveFlag[]"] = <?php echo $AdjustmentSubFactors_grid->ActiveFlag->Lookup->toClientList($AdjustmentSubFactors_grid) ?>;
	fAdjustmentSubFactorsgrid.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($AdjustmentSubFactors_grid->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fAdjustmentSubFactorsgrid");
});
</script>
<?php } ?>
<?php
$AdjustmentSubFactors_grid->renderOtherOptions();
?>
<?php if ($AdjustmentSubFactors_grid->TotalRecords > 0 || $AdjustmentSubFactors->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($AdjustmentSubFactors_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> AdjustmentSubFactors">
<?php if ($AdjustmentSubFactors_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $AdjustmentSubFactors_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fAdjustmentSubFactorsgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_AdjustmentSubFactors" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_AdjustmentSubFactorsgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$AdjustmentSubFactors->RowType = ROWTYPE_HEADER;

// Render list options
$AdjustmentSubFactors_grid->renderListOptions();

// Render list options (header, left)
$AdjustmentSubFactors_grid->ListOptions->render("header", "left");
?>
<?php if ($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
	<?php if ($AdjustmentSubFactors_grid->SortUrl($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn) == "") { ?>
		<th data-name="AdjustmentSubFactor_Idn" class="<?php echo $AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="AdjustmentSubFactors_AdjustmentSubFactor_Idn"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdjustmentSubFactor_Idn" class="<?php echo $AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->headerCellClass() ?>"><div><div id="elh_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="AdjustmentSubFactors_AdjustmentSubFactor_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
	<?php if ($AdjustmentSubFactors_grid->SortUrl($AdjustmentSubFactors_grid->AdjustmentFactor_Idn) == "") { ?>
		<th data-name="AdjustmentFactor_Idn" class="<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_AdjustmentFactor_Idn" class="AdjustmentSubFactors_AdjustmentFactor_Idn"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdjustmentFactor_Idn" class="<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->headerCellClass() ?>"><div><div id="elh_AdjustmentSubFactors_AdjustmentFactor_Idn" class="AdjustmentSubFactors_AdjustmentFactor_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_grid->Name->Visible) { // Name ?>
	<?php if ($AdjustmentSubFactors_grid->SortUrl($AdjustmentSubFactors_grid->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $AdjustmentSubFactors_grid->Name->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_Name" class="AdjustmentSubFactors_Name"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $AdjustmentSubFactors_grid->Name->headerCellClass() ?>"><div><div id="elh_AdjustmentSubFactors_Name" class="AdjustmentSubFactors_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->Name->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_grid->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_grid->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_grid->Value->Visible) { // Value ?>
	<?php if ($AdjustmentSubFactors_grid->SortUrl($AdjustmentSubFactors_grid->Value) == "") { ?>
		<th data-name="Value" class="<?php echo $AdjustmentSubFactors_grid->Value->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_Value" class="AdjustmentSubFactors_Value"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->Value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Value" class="<?php echo $AdjustmentSubFactors_grid->Value->headerCellClass() ?>"><div><div id="elh_AdjustmentSubFactors_Value" class="AdjustmentSubFactors_Value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->Value->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_grid->Value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_grid->Value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_grid->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
	<?php if ($AdjustmentSubFactors_grid->SortUrl($AdjustmentSubFactors_grid->LaborClass_Idn) == "") { ?>
		<th data-name="LaborClass_Idn" class="<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_LaborClass_Idn" class="AdjustmentSubFactors_LaborClass_Idn"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LaborClass_Idn" class="<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->headerCellClass() ?>"><div><div id="elh_AdjustmentSubFactors_LaborClass_Idn" class="AdjustmentSubFactors_LaborClass_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_grid->LaborClass_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_grid->LaborClass_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_grid->Rank->Visible) { // Rank ?>
	<?php if ($AdjustmentSubFactors_grid->SortUrl($AdjustmentSubFactors_grid->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $AdjustmentSubFactors_grid->Rank->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_Rank" class="AdjustmentSubFactors_Rank"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $AdjustmentSubFactors_grid->Rank->headerCellClass() ?>"><div><div id="elh_AdjustmentSubFactors_Rank" class="AdjustmentSubFactors_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_grid->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_grid->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_grid->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($AdjustmentSubFactors_grid->SortUrl($AdjustmentSubFactors_grid->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $AdjustmentSubFactors_grid->ActiveFlag->headerCellClass() ?>"><div id="elh_AdjustmentSubFactors_ActiveFlag" class="AdjustmentSubFactors_ActiveFlag"><div class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $AdjustmentSubFactors_grid->ActiveFlag->headerCellClass() ?>"><div><div id="elh_AdjustmentSubFactors_ActiveFlag" class="AdjustmentSubFactors_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_grid->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_grid->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_grid->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$AdjustmentSubFactors_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$AdjustmentSubFactors_grid->StartRecord = 1;
$AdjustmentSubFactors_grid->StopRecord = $AdjustmentSubFactors_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($AdjustmentSubFactors->isConfirm() || $AdjustmentSubFactors_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($AdjustmentSubFactors_grid->FormKeyCountName) && ($AdjustmentSubFactors_grid->isGridAdd() || $AdjustmentSubFactors_grid->isGridEdit() || $AdjustmentSubFactors->isConfirm())) {
		$AdjustmentSubFactors_grid->KeyCount = $CurrentForm->getValue($AdjustmentSubFactors_grid->FormKeyCountName);
		$AdjustmentSubFactors_grid->StopRecord = $AdjustmentSubFactors_grid->StartRecord + $AdjustmentSubFactors_grid->KeyCount - 1;
	}
}
$AdjustmentSubFactors_grid->RecordCount = $AdjustmentSubFactors_grid->StartRecord - 1;
if ($AdjustmentSubFactors_grid->Recordset && !$AdjustmentSubFactors_grid->Recordset->EOF) {
	$AdjustmentSubFactors_grid->Recordset->moveFirst();
	$selectLimit = $AdjustmentSubFactors_grid->UseSelectLimit;
	if (!$selectLimit && $AdjustmentSubFactors_grid->StartRecord > 1)
		$AdjustmentSubFactors_grid->Recordset->move($AdjustmentSubFactors_grid->StartRecord - 1);
} elseif (!$AdjustmentSubFactors->AllowAddDeleteRow && $AdjustmentSubFactors_grid->StopRecord == 0) {
	$AdjustmentSubFactors_grid->StopRecord = $AdjustmentSubFactors->GridAddRowCount;
}

// Initialize aggregate
$AdjustmentSubFactors->RowType = ROWTYPE_AGGREGATEINIT;
$AdjustmentSubFactors->resetAttributes();
$AdjustmentSubFactors_grid->renderRow();
if ($AdjustmentSubFactors_grid->isGridAdd())
	$AdjustmentSubFactors_grid->RowIndex = 0;
if ($AdjustmentSubFactors_grid->isGridEdit())
	$AdjustmentSubFactors_grid->RowIndex = 0;
while ($AdjustmentSubFactors_grid->RecordCount < $AdjustmentSubFactors_grid->StopRecord) {
	$AdjustmentSubFactors_grid->RecordCount++;
	if ($AdjustmentSubFactors_grid->RecordCount >= $AdjustmentSubFactors_grid->StartRecord) {
		$AdjustmentSubFactors_grid->RowCount++;
		if ($AdjustmentSubFactors_grid->isGridAdd() || $AdjustmentSubFactors_grid->isGridEdit() || $AdjustmentSubFactors->isConfirm()) {
			$AdjustmentSubFactors_grid->RowIndex++;
			$CurrentForm->Index = $AdjustmentSubFactors_grid->RowIndex;
			if ($CurrentForm->hasValue($AdjustmentSubFactors_grid->FormActionName) && ($AdjustmentSubFactors->isConfirm() || $AdjustmentSubFactors_grid->EventCancelled))
				$AdjustmentSubFactors_grid->RowAction = strval($CurrentForm->getValue($AdjustmentSubFactors_grid->FormActionName));
			elseif ($AdjustmentSubFactors_grid->isGridAdd())
				$AdjustmentSubFactors_grid->RowAction = "insert";
			else
				$AdjustmentSubFactors_grid->RowAction = "";
		}

		// Set up key count
		$AdjustmentSubFactors_grid->KeyCount = $AdjustmentSubFactors_grid->RowIndex;

		// Init row class and style
		$AdjustmentSubFactors->resetAttributes();
		$AdjustmentSubFactors->CssClass = "";
		if ($AdjustmentSubFactors_grid->isGridAdd()) {
			if ($AdjustmentSubFactors->CurrentMode == "copy") {
				$AdjustmentSubFactors_grid->loadRowValues($AdjustmentSubFactors_grid->Recordset); // Load row values
				$AdjustmentSubFactors_grid->setRecordKey($AdjustmentSubFactors_grid->RowOldKey, $AdjustmentSubFactors_grid->Recordset); // Set old record key
			} else {
				$AdjustmentSubFactors_grid->loadRowValues(); // Load default values
				$AdjustmentSubFactors_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$AdjustmentSubFactors_grid->loadRowValues($AdjustmentSubFactors_grid->Recordset); // Load row values
		}
		$AdjustmentSubFactors->RowType = ROWTYPE_VIEW; // Render view
		if ($AdjustmentSubFactors_grid->isGridAdd()) // Grid add
			$AdjustmentSubFactors->RowType = ROWTYPE_ADD; // Render add
		if ($AdjustmentSubFactors_grid->isGridAdd() && $AdjustmentSubFactors->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$AdjustmentSubFactors_grid->restoreCurrentRowFormValues($AdjustmentSubFactors_grid->RowIndex); // Restore form values
		if ($AdjustmentSubFactors_grid->isGridEdit()) { // Grid edit
			if ($AdjustmentSubFactors->EventCancelled)
				$AdjustmentSubFactors_grid->restoreCurrentRowFormValues($AdjustmentSubFactors_grid->RowIndex); // Restore form values
			if ($AdjustmentSubFactors_grid->RowAction == "insert")
				$AdjustmentSubFactors->RowType = ROWTYPE_ADD; // Render add
			else
				$AdjustmentSubFactors->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($AdjustmentSubFactors_grid->isGridEdit() && ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT || $AdjustmentSubFactors->RowType == ROWTYPE_ADD) && $AdjustmentSubFactors->EventCancelled) // Update failed
			$AdjustmentSubFactors_grid->restoreCurrentRowFormValues($AdjustmentSubFactors_grid->RowIndex); // Restore form values
		if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) // Edit row
			$AdjustmentSubFactors_grid->EditRowCount++;
		if ($AdjustmentSubFactors->isConfirm()) // Confirm row
			$AdjustmentSubFactors_grid->restoreCurrentRowFormValues($AdjustmentSubFactors_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$AdjustmentSubFactors->RowAttrs->merge(["data-rowindex" => $AdjustmentSubFactors_grid->RowCount, "id" => "r" . $AdjustmentSubFactors_grid->RowCount . "_AdjustmentSubFactors", "data-rowtype" => $AdjustmentSubFactors->RowType]);

		// Render row
		$AdjustmentSubFactors_grid->renderRow();

		// Render list options
		$AdjustmentSubFactors_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($AdjustmentSubFactors_grid->RowAction != "delete" && $AdjustmentSubFactors_grid->RowAction != "insertdelete" && !($AdjustmentSubFactors_grid->RowAction == "insert" && $AdjustmentSubFactors->isConfirm() && $AdjustmentSubFactors_grid->emptyRow())) {
?>
	<tr <?php echo $AdjustmentSubFactors->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AdjustmentSubFactors_grid->ListOptions->render("body", "left", $AdjustmentSubFactors_grid->RowCount);
?>
	<?php if ($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
		<td data-name="AdjustmentSubFactor_Idn" <?php echo $AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="form-group"></span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="form-group">
<span<?php echo $AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_AdjustmentSubFactor_Idn">
<span<?php echo $AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->getViewValue() ?></span>
</span>
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" id="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" id="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td data-name="AdjustmentFactor_Idn" <?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group">
<span<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn"<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_grid->RowIndex}_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->Lookup->getParamTag($AdjustmentSubFactors_grid, "p_x" . $AdjustmentSubFactors_grid->RowIndex . "_AdjustmentFactor_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group">
<span<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn"<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_grid->RowIndex}_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->Lookup->getParamTag($AdjustmentSubFactors_grid, "p_x" . $AdjustmentSubFactors_grid->RowIndex . "_AdjustmentFactor_Idn") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->getViewValue() ?></span>
</span>
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" name="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" id="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" name="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" id="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $AdjustmentSubFactors_grid->Name->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_Name" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Name" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_grid->Name->EditValue ?>"<?php echo $AdjustmentSubFactors_grid->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Name" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Name->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_Name" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Name" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_grid->Name->EditValue ?>"<?php echo $AdjustmentSubFactors_grid->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_Name">
<span<?php echo $AdjustmentSubFactors_grid->Name->viewAttributes() ?>><?php echo $AdjustmentSubFactors_grid->Name->getViewValue() ?></span>
</span>
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Name" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Name->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Name" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Name" name="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" id="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Name->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Name" name="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" id="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->Value->Visible) { // Value ?>
		<td data-name="Value" <?php echo $AdjustmentSubFactors_grid->Value->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_Value" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Value" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Value->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_grid->Value->EditValue ?>"<?php echo $AdjustmentSubFactors_grid->Value->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Value" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Value->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_Value" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Value" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Value->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_grid->Value->EditValue ?>"<?php echo $AdjustmentSubFactors_grid->Value->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_Value">
<span<?php echo $AdjustmentSubFactors_grid->Value->viewAttributes() ?>><?php echo $AdjustmentSubFactors_grid->Value->getViewValue() ?></span>
</span>
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Value" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Value->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Value" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Value->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Value" name="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" id="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Value->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Value" name="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" id="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Value->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
		<td data-name="LaborClass_Idn" <?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_LaborClass_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn"<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_grid->RowIndex}_LaborClass_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->Lookup->getParamTag($AdjustmentSubFactors_grid, "p_x" . $AdjustmentSubFactors_grid->RowIndex . "_LaborClass_Idn") ?>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->LaborClass_Idn->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_LaborClass_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn"<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_grid->RowIndex}_LaborClass_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->Lookup->getParamTag($AdjustmentSubFactors_grid, "p_x" . $AdjustmentSubFactors_grid->RowIndex . "_LaborClass_Idn") ?>
</span>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_LaborClass_Idn">
<span<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->getViewValue() ?></span>
</span>
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->LaborClass_Idn->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->LaborClass_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" name="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" id="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->LaborClass_Idn->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" name="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" id="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->LaborClass_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $AdjustmentSubFactors_grid->Rank->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_Rank" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Rank" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_grid->Rank->EditValue ?>"<?php echo $AdjustmentSubFactors_grid->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Rank" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Rank->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_Rank" class="form-group">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Rank" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_grid->Rank->EditValue ?>"<?php echo $AdjustmentSubFactors_grid->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_Rank">
<span<?php echo $AdjustmentSubFactors_grid->Rank->viewAttributes() ?>><?php echo $AdjustmentSubFactors_grid->Rank->getViewValue() ?></span>
</span>
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Rank" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Rank->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Rank" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Rank->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Rank" name="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" id="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Rank->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Rank" name="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" id="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Rank->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $AdjustmentSubFactors_grid->ActiveFlag->cellAttributes() ?>>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($AdjustmentSubFactors_grid->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]_986813" value="1"<?php echo $selwrk ?><?php echo $AdjustmentSubFactors_grid->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]_986813"></label>
</div>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($AdjustmentSubFactors_grid->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]_739349" value="1"<?php echo $selwrk ?><?php echo $AdjustmentSubFactors_grid->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]_739349"></label>
</div>
</span>
<?php } ?>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AdjustmentSubFactors_grid->RowCount ?>_AdjustmentSubFactors_ActiveFlag">
<span<?php echo $AdjustmentSubFactors_grid->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $AdjustmentSubFactors_grid->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($AdjustmentSubFactors_grid->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->ActiveFlag->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->ActiveFlag->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag" id="fAdjustmentSubFactorsgrid$x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->ActiveFlag->FormValue) ?>">
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]" id="fAdjustmentSubFactorsgrid$o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AdjustmentSubFactors_grid->ListOptions->render("body", "right", $AdjustmentSubFactors_grid->RowCount);
?>
	</tr>
<?php if ($AdjustmentSubFactors->RowType == ROWTYPE_ADD || $AdjustmentSubFactors->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fAdjustmentSubFactorsgrid", "load"], function() {
	fAdjustmentSubFactorsgrid.updateLists(<?php echo $AdjustmentSubFactors_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$AdjustmentSubFactors_grid->isGridAdd() || $AdjustmentSubFactors->CurrentMode == "copy")
		if (!$AdjustmentSubFactors_grid->Recordset->EOF)
			$AdjustmentSubFactors_grid->Recordset->moveNext();
}
?>
<?php
	if ($AdjustmentSubFactors->CurrentMode == "add" || $AdjustmentSubFactors->CurrentMode == "copy" || $AdjustmentSubFactors->CurrentMode == "edit") {
		$AdjustmentSubFactors_grid->RowIndex = '$rowindex$';
		$AdjustmentSubFactors_grid->loadRowValues();

		// Set row properties
		$AdjustmentSubFactors->resetAttributes();
		$AdjustmentSubFactors->RowAttrs->merge(["data-rowindex" => $AdjustmentSubFactors_grid->RowIndex, "id" => "r0_AdjustmentSubFactors", "data-rowtype" => ROWTYPE_ADD]);
		$AdjustmentSubFactors->RowAttrs->appendClass("ew-template");
		$AdjustmentSubFactors->RowType = ROWTYPE_ADD;

		// Render row
		$AdjustmentSubFactors_grid->renderRow();

		// Render list options
		$AdjustmentSubFactors_grid->renderListOptions();
		$AdjustmentSubFactors_grid->StartRowCount = 0;
?>
	<tr <?php echo $AdjustmentSubFactors->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AdjustmentSubFactors_grid->ListOptions->render("body", "left", $AdjustmentSubFactors_grid->RowIndex);
?>
	<?php if ($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
		<td data-name="AdjustmentSubFactor_Idn">
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<span id="el$rowindex$_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="form-group AdjustmentSubFactors_AdjustmentSubFactor_Idn"></span>
<?php } else { ?>
<span id="el$rowindex$_AdjustmentSubFactors_AdjustmentSubFactor_Idn" class="form-group AdjustmentSubFactors_AdjustmentSubFactor_Idn">
<span<?php echo $AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentSubFactor_Idn" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentSubFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentSubFactor_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<td data-name="AdjustmentFactor_Idn">
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<?php if ($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->getSessionValue() != "") { ?>
<span id="el$rowindex$_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group AdjustmentSubFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group AdjustmentSubFactors_AdjustmentFactor_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn"<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_grid->RowIndex}_AdjustmentFactor_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->Lookup->getParamTag($AdjustmentSubFactors_grid, "p_x" . $AdjustmentSubFactors_grid->RowIndex . "_AdjustmentFactor_Idn") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_AdjustmentSubFactors_AdjustmentFactor_Idn" class="form-group AdjustmentSubFactors_AdjustmentFactor_Idn">
<span<?php echo $AdjustmentSubFactors_grid->AdjustmentFactor_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_AdjustmentFactor_Idn" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_AdjustmentFactor_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->AdjustmentFactor_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->Name->Visible) { // Name ?>
		<td data-name="Name">
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<span id="el$rowindex$_AdjustmentSubFactors_Name" class="form-group AdjustmentSubFactors_Name">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Name" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Name->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_grid->Name->EditValue ?>"<?php echo $AdjustmentSubFactors_grid->Name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_AdjustmentSubFactors_Name" class="form-group AdjustmentSubFactors_Name">
<span<?php echo $AdjustmentSubFactors_grid->Name->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_grid->Name->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Name" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Name" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Name" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->Value->Visible) { // Value ?>
		<td data-name="Value">
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<span id="el$rowindex$_AdjustmentSubFactors_Value" class="form-group AdjustmentSubFactors_Value">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Value" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Value->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_grid->Value->EditValue ?>"<?php echo $AdjustmentSubFactors_grid->Value->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_AdjustmentSubFactors_Value" class="form-group AdjustmentSubFactors_Value">
<span<?php echo $AdjustmentSubFactors_grid->Value->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_grid->Value->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Value" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Value->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Value" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Value" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Value->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
		<td data-name="LaborClass_Idn">
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<span id="el$rowindex$_AdjustmentSubFactors_LaborClass_Idn" class="form-group AdjustmentSubFactors_LaborClass_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" data-value-separator="<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn"<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->editAttributes() ?>>
			<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->selectOptionListHtml("x{$AdjustmentSubFactors_grid->RowIndex}_LaborClass_Idn") ?>
		</select>
</div>
<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->Lookup->getParamTag($AdjustmentSubFactors_grid, "p_x" . $AdjustmentSubFactors_grid->RowIndex . "_LaborClass_Idn") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_AdjustmentSubFactors_LaborClass_Idn" class="form-group AdjustmentSubFactors_LaborClass_Idn">
<span<?php echo $AdjustmentSubFactors_grid->LaborClass_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_grid->LaborClass_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->LaborClass_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_LaborClass_Idn" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_LaborClass_Idn" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->LaborClass_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<span id="el$rowindex$_AdjustmentSubFactors_Rank" class="form-group AdjustmentSubFactors_Rank">
<input type="text" data-table="AdjustmentSubFactors" data-field="x_Rank" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $AdjustmentSubFactors_grid->Rank->EditValue ?>"<?php echo $AdjustmentSubFactors_grid->Rank->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_AdjustmentSubFactors_Rank" class="form-group AdjustmentSubFactors_Rank">
<span<?php echo $AdjustmentSubFactors_grid->Rank->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($AdjustmentSubFactors_grid->Rank->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Rank" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Rank->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_Rank" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AdjustmentSubFactors_grid->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<?php if (!$AdjustmentSubFactors->isConfirm()) { ?>
<span id="el$rowindex$_AdjustmentSubFactors_ActiveFlag" class="form-group AdjustmentSubFactors_ActiveFlag">
<?php
$selwrk = ConvertToBool($AdjustmentSubFactors_grid->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]_915832" value="1"<?php echo $selwrk ?><?php echo $AdjustmentSubFactors_grid->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]_915832"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_AdjustmentSubFactors_ActiveFlag" class="form-group AdjustmentSubFactors_ActiveFlag">
<span<?php echo $AdjustmentSubFactors_grid->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $AdjustmentSubFactors_grid->ActiveFlag->ViewValue ?>" disabled<?php if (ConvertToBool($AdjustmentSubFactors_grid->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag" id="x<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->ActiveFlag->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="AdjustmentSubFactors" data-field="x_ActiveFlag" name="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]" id="o<?php echo $AdjustmentSubFactors_grid->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($AdjustmentSubFactors_grid->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AdjustmentSubFactors_grid->ListOptions->render("body", "right", $AdjustmentSubFactors_grid->RowIndex);
?>
<script>
loadjs.ready(["fAdjustmentSubFactorsgrid", "load"], function() {
	fAdjustmentSubFactorsgrid.updateLists(<?php echo $AdjustmentSubFactors_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($AdjustmentSubFactors->CurrentMode == "add" || $AdjustmentSubFactors->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $AdjustmentSubFactors_grid->FormKeyCountName ?>" id="<?php echo $AdjustmentSubFactors_grid->FormKeyCountName ?>" value="<?php echo $AdjustmentSubFactors_grid->KeyCount ?>">
<?php echo $AdjustmentSubFactors_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($AdjustmentSubFactors->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $AdjustmentSubFactors_grid->FormKeyCountName ?>" id="<?php echo $AdjustmentSubFactors_grid->FormKeyCountName ?>" value="<?php echo $AdjustmentSubFactors_grid->KeyCount ?>">
<?php echo $AdjustmentSubFactors_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($AdjustmentSubFactors->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fAdjustmentSubFactorsgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($AdjustmentSubFactors_grid->Recordset)
	$AdjustmentSubFactors_grid->Recordset->Close();
?>
<?php if ($AdjustmentSubFactors_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $AdjustmentSubFactors_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($AdjustmentSubFactors_grid->TotalRecords == 0 && !$AdjustmentSubFactors->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $AdjustmentSubFactors_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$AdjustmentSubFactors_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$AdjustmentSubFactors_grid->terminate();
?>