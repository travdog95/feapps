<?php
namespace PHPMaker2020\feapps51;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($WorksheetMasterCategories_grid))
	$WorksheetMasterCategories_grid = new WorksheetMasterCategories_grid();

// Run the page
$WorksheetMasterCategories_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasterCategories_grid->Page_Render();
?>
<?php if (!$WorksheetMasterCategories_grid->isExport()) { ?>
<script>
var fWorksheetMasterCategoriesgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fWorksheetMasterCategoriesgrid = new ew.Form("fWorksheetMasterCategoriesgrid", "grid");
	fWorksheetMasterCategoriesgrid.formKeyCountName = '<?php echo $WorksheetMasterCategories_grid->FormKeyCountName ?>';

	// Validate form
	fWorksheetMasterCategoriesgrid.validate = function() {
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
			<?php if ($WorksheetMasterCategories_grid->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_grid->WorksheetMaster_Idn->caption(), $WorksheetMasterCategories_grid->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->errorMessage()) ?>");
			<?php if ($WorksheetMasterCategories_grid->WorksheetCategory_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetCategory_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_grid->WorksheetCategory_Idn->caption(), $WorksheetMasterCategories_grid->WorksheetCategory_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_grid->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_grid->Rank->caption(), $WorksheetMasterCategories_grid->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($WorksheetMasterCategories_grid->Rank->errorMessage()) ?>");
			<?php if ($WorksheetMasterCategories_grid->AutoLoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_AutoLoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_grid->AutoLoadFlag->caption(), $WorksheetMasterCategories_grid->AutoLoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_grid->LoadFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_LoadFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_grid->LoadFlag->caption(), $WorksheetMasterCategories_grid->LoadFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_grid->AddMiscFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_AddMiscFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_grid->AddMiscFlag->caption(), $WorksheetMasterCategories_grid->AddMiscFlag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ChildWorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->caption(), $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fWorksheetMasterCategoriesgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "WorksheetMaster_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "WorksheetCategory_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "AutoLoadFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "LoadFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "AddMiscFlag[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ChildWorksheetMaster_Idn", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fWorksheetMasterCategoriesgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetMasterCategoriesgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetMasterCategoriesgrid.lists["x_WorksheetCategory_Idn"] = <?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->Lookup->toClientList($WorksheetMasterCategories_grid) ?>;
	fWorksheetMasterCategoriesgrid.lists["x_WorksheetCategory_Idn"].options = <?php echo JsonEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->lookupOptions()) ?>;
	fWorksheetMasterCategoriesgrid.lists["x_AutoLoadFlag[]"] = <?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->Lookup->toClientList($WorksheetMasterCategories_grid) ?>;
	fWorksheetMasterCategoriesgrid.lists["x_AutoLoadFlag[]"].options = <?php echo JsonEncode($WorksheetMasterCategories_grid->AutoLoadFlag->options(FALSE, TRUE)) ?>;
	fWorksheetMasterCategoriesgrid.lists["x_LoadFlag[]"] = <?php echo $WorksheetMasterCategories_grid->LoadFlag->Lookup->toClientList($WorksheetMasterCategories_grid) ?>;
	fWorksheetMasterCategoriesgrid.lists["x_LoadFlag[]"].options = <?php echo JsonEncode($WorksheetMasterCategories_grid->LoadFlag->options(FALSE, TRUE)) ?>;
	fWorksheetMasterCategoriesgrid.lists["x_AddMiscFlag[]"] = <?php echo $WorksheetMasterCategories_grid->AddMiscFlag->Lookup->toClientList($WorksheetMasterCategories_grid) ?>;
	fWorksheetMasterCategoriesgrid.lists["x_AddMiscFlag[]"].options = <?php echo JsonEncode($WorksheetMasterCategories_grid->AddMiscFlag->options(FALSE, TRUE)) ?>;
	fWorksheetMasterCategoriesgrid.lists["x_ChildWorksheetMaster_Idn"] = <?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->Lookup->toClientList($WorksheetMasterCategories_grid) ?>;
	fWorksheetMasterCategoriesgrid.lists["x_ChildWorksheetMaster_Idn"].options = <?php echo JsonEncode($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->lookupOptions()) ?>;
	loadjs.done("fWorksheetMasterCategoriesgrid");
});
</script>
<?php } ?>
<?php
$WorksheetMasterCategories_grid->renderOtherOptions();
?>
<?php if ($WorksheetMasterCategories_grid->TotalRecords > 0 || $WorksheetMasterCategories->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($WorksheetMasterCategories_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> WorksheetMasterCategories">
<?php if ($WorksheetMasterCategories_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $WorksheetMasterCategories_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fWorksheetMasterCategoriesgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_WorksheetMasterCategories" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_WorksheetMasterCategoriesgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$WorksheetMasterCategories->RowType = ROWTYPE_HEADER;

// Render list options
$WorksheetMasterCategories_grid->renderListOptions();

// Render list options (header, left)
$WorksheetMasterCategories_grid->ListOptions->render("header", "left");
?>
<?php if ($WorksheetMasterCategories_grid->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($WorksheetMasterCategories_grid->SortUrl($WorksheetMasterCategories_grid->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_WorksheetMaster_Idn" class="WorksheetMasterCategories_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->headerCellClass() ?>"><div><div id="elh_WorksheetMasterCategories_WorksheetMaster_Idn" class="WorksheetMasterCategories_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_grid->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_grid->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_grid->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<?php if ($WorksheetMasterCategories_grid->SortUrl($WorksheetMasterCategories_grid->WorksheetCategory_Idn) == "") { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_WorksheetCategory_Idn" class="WorksheetMasterCategories_WorksheetCategory_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetCategory_Idn" class="<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->headerCellClass() ?>"><div><div id="elh_WorksheetMasterCategories_WorksheetCategory_Idn" class="WorksheetMasterCategories_WorksheetCategory_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_grid->WorksheetCategory_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_grid->WorksheetCategory_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_grid->Rank->Visible) { // Rank ?>
	<?php if ($WorksheetMasterCategories_grid->SortUrl($WorksheetMasterCategories_grid->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $WorksheetMasterCategories_grid->Rank->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_Rank" class="WorksheetMasterCategories_Rank"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $WorksheetMasterCategories_grid->Rank->headerCellClass() ?>"><div><div id="elh_WorksheetMasterCategories_Rank" class="WorksheetMasterCategories_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_grid->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_grid->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_grid->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
	<?php if ($WorksheetMasterCategories_grid->SortUrl($WorksheetMasterCategories_grid->AutoLoadFlag) == "") { ?>
		<th data-name="AutoLoadFlag" class="<?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_AutoLoadFlag" class="WorksheetMasterCategories_AutoLoadFlag"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AutoLoadFlag" class="<?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->headerCellClass() ?>"><div><div id="elh_WorksheetMasterCategories_AutoLoadFlag" class="WorksheetMasterCategories_AutoLoadFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_grid->AutoLoadFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_grid->AutoLoadFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_grid->LoadFlag->Visible) { // LoadFlag ?>
	<?php if ($WorksheetMasterCategories_grid->SortUrl($WorksheetMasterCategories_grid->LoadFlag) == "") { ?>
		<th data-name="LoadFlag" class="<?php echo $WorksheetMasterCategories_grid->LoadFlag->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_LoadFlag" class="WorksheetMasterCategories_LoadFlag"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->LoadFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LoadFlag" class="<?php echo $WorksheetMasterCategories_grid->LoadFlag->headerCellClass() ?>"><div><div id="elh_WorksheetMasterCategories_LoadFlag" class="WorksheetMasterCategories_LoadFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->LoadFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_grid->LoadFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_grid->LoadFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_grid->AddMiscFlag->Visible) { // AddMiscFlag ?>
	<?php if ($WorksheetMasterCategories_grid->SortUrl($WorksheetMasterCategories_grid->AddMiscFlag) == "") { ?>
		<th data-name="AddMiscFlag" class="<?php echo $WorksheetMasterCategories_grid->AddMiscFlag->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_AddMiscFlag" class="WorksheetMasterCategories_AddMiscFlag"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->AddMiscFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AddMiscFlag" class="<?php echo $WorksheetMasterCategories_grid->AddMiscFlag->headerCellClass() ?>"><div><div id="elh_WorksheetMasterCategories_AddMiscFlag" class="WorksheetMasterCategories_AddMiscFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->AddMiscFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_grid->AddMiscFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_grid->AddMiscFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
	<?php if ($WorksheetMasterCategories_grid->SortUrl($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn) == "") { ?>
		<th data-name="ChildWorksheetMaster_Idn" class="<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="WorksheetMasterCategories_ChildWorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChildWorksheetMaster_Idn" class="<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->headerCellClass() ?>"><div><div id="elh_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="WorksheetMasterCategories_ChildWorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$WorksheetMasterCategories_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$WorksheetMasterCategories_grid->StartRecord = 1;
$WorksheetMasterCategories_grid->StopRecord = $WorksheetMasterCategories_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($WorksheetMasterCategories->isConfirm() || $WorksheetMasterCategories_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($WorksheetMasterCategories_grid->FormKeyCountName) && ($WorksheetMasterCategories_grid->isGridAdd() || $WorksheetMasterCategories_grid->isGridEdit() || $WorksheetMasterCategories->isConfirm())) {
		$WorksheetMasterCategories_grid->KeyCount = $CurrentForm->getValue($WorksheetMasterCategories_grid->FormKeyCountName);
		$WorksheetMasterCategories_grid->StopRecord = $WorksheetMasterCategories_grid->StartRecord + $WorksheetMasterCategories_grid->KeyCount - 1;
	}
}
$WorksheetMasterCategories_grid->RecordCount = $WorksheetMasterCategories_grid->StartRecord - 1;
if ($WorksheetMasterCategories_grid->Recordset && !$WorksheetMasterCategories_grid->Recordset->EOF) {
	$WorksheetMasterCategories_grid->Recordset->moveFirst();
	$selectLimit = $WorksheetMasterCategories_grid->UseSelectLimit;
	if (!$selectLimit && $WorksheetMasterCategories_grid->StartRecord > 1)
		$WorksheetMasterCategories_grid->Recordset->move($WorksheetMasterCategories_grid->StartRecord - 1);
} elseif (!$WorksheetMasterCategories->AllowAddDeleteRow && $WorksheetMasterCategories_grid->StopRecord == 0) {
	$WorksheetMasterCategories_grid->StopRecord = $WorksheetMasterCategories->GridAddRowCount;
}

// Initialize aggregate
$WorksheetMasterCategories->RowType = ROWTYPE_AGGREGATEINIT;
$WorksheetMasterCategories->resetAttributes();
$WorksheetMasterCategories_grid->renderRow();
if ($WorksheetMasterCategories_grid->isGridAdd())
	$WorksheetMasterCategories_grid->RowIndex = 0;
if ($WorksheetMasterCategories_grid->isGridEdit())
	$WorksheetMasterCategories_grid->RowIndex = 0;
while ($WorksheetMasterCategories_grid->RecordCount < $WorksheetMasterCategories_grid->StopRecord) {
	$WorksheetMasterCategories_grid->RecordCount++;
	if ($WorksheetMasterCategories_grid->RecordCount >= $WorksheetMasterCategories_grid->StartRecord) {
		$WorksheetMasterCategories_grid->RowCount++;
		if ($WorksheetMasterCategories_grid->isGridAdd() || $WorksheetMasterCategories_grid->isGridEdit() || $WorksheetMasterCategories->isConfirm()) {
			$WorksheetMasterCategories_grid->RowIndex++;
			$CurrentForm->Index = $WorksheetMasterCategories_grid->RowIndex;
			if ($CurrentForm->hasValue($WorksheetMasterCategories_grid->FormActionName) && ($WorksheetMasterCategories->isConfirm() || $WorksheetMasterCategories_grid->EventCancelled))
				$WorksheetMasterCategories_grid->RowAction = strval($CurrentForm->getValue($WorksheetMasterCategories_grid->FormActionName));
			elseif ($WorksheetMasterCategories_grid->isGridAdd())
				$WorksheetMasterCategories_grid->RowAction = "insert";
			else
				$WorksheetMasterCategories_grid->RowAction = "";
		}

		// Set up key count
		$WorksheetMasterCategories_grid->KeyCount = $WorksheetMasterCategories_grid->RowIndex;

		// Init row class and style
		$WorksheetMasterCategories->resetAttributes();
		$WorksheetMasterCategories->CssClass = "";
		if ($WorksheetMasterCategories_grid->isGridAdd()) {
			if ($WorksheetMasterCategories->CurrentMode == "copy") {
				$WorksheetMasterCategories_grid->loadRowValues($WorksheetMasterCategories_grid->Recordset); // Load row values
				$WorksheetMasterCategories_grid->setRecordKey($WorksheetMasterCategories_grid->RowOldKey, $WorksheetMasterCategories_grid->Recordset); // Set old record key
			} else {
				$WorksheetMasterCategories_grid->loadRowValues(); // Load default values
				$WorksheetMasterCategories_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$WorksheetMasterCategories_grid->loadRowValues($WorksheetMasterCategories_grid->Recordset); // Load row values
		}
		$WorksheetMasterCategories->RowType = ROWTYPE_VIEW; // Render view
		if ($WorksheetMasterCategories_grid->isGridAdd()) // Grid add
			$WorksheetMasterCategories->RowType = ROWTYPE_ADD; // Render add
		if ($WorksheetMasterCategories_grid->isGridAdd() && $WorksheetMasterCategories->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$WorksheetMasterCategories_grid->restoreCurrentRowFormValues($WorksheetMasterCategories_grid->RowIndex); // Restore form values
		if ($WorksheetMasterCategories_grid->isGridEdit()) { // Grid edit
			if ($WorksheetMasterCategories->EventCancelled)
				$WorksheetMasterCategories_grid->restoreCurrentRowFormValues($WorksheetMasterCategories_grid->RowIndex); // Restore form values
			if ($WorksheetMasterCategories_grid->RowAction == "insert")
				$WorksheetMasterCategories->RowType = ROWTYPE_ADD; // Render add
			else
				$WorksheetMasterCategories->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($WorksheetMasterCategories_grid->isGridEdit() && ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT || $WorksheetMasterCategories->RowType == ROWTYPE_ADD) && $WorksheetMasterCategories->EventCancelled) // Update failed
			$WorksheetMasterCategories_grid->restoreCurrentRowFormValues($WorksheetMasterCategories_grid->RowIndex); // Restore form values
		if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) // Edit row
			$WorksheetMasterCategories_grid->EditRowCount++;
		if ($WorksheetMasterCategories->isConfirm()) // Confirm row
			$WorksheetMasterCategories_grid->restoreCurrentRowFormValues($WorksheetMasterCategories_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$WorksheetMasterCategories->RowAttrs->merge(["data-rowindex" => $WorksheetMasterCategories_grid->RowCount, "id" => "r" . $WorksheetMasterCategories_grid->RowCount . "_WorksheetMasterCategories", "data-rowtype" => $WorksheetMasterCategories->RowType]);

		// Render row
		$WorksheetMasterCategories_grid->renderRow();

		// Render list options
		$WorksheetMasterCategories_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($WorksheetMasterCategories_grid->RowAction != "delete" && $WorksheetMasterCategories_grid->RowAction != "insertdelete" && !($WorksheetMasterCategories_grid->RowAction == "insert" && $WorksheetMasterCategories->isConfirm() && $WorksheetMasterCategories_grid->emptyRow())) {
?>
	<tr <?php echo $WorksheetMasterCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterCategories_grid->ListOptions->render("body", "left", $WorksheetMasterCategories_grid->RowCount);
?>
	<?php if ($WorksheetMasterCategories_grid->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($WorksheetMasterCategories_grid->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group">
<span<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_grid->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->EditValue ?>"<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($WorksheetMasterCategories_grid->WorksheetMaster_Idn->getSessionValue() != "") { ?>

<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group">
<span<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_grid->WorksheetMaster_Idn->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->EditValue ?>"<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->OldValue != null ? $WorksheetMasterCategories_grid->WorksheetMaster_Idn->OldValue : $WorksheetMasterCategories_grid->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" id="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" id="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn" <?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($WorksheetMasterCategories_grid->WorksheetCategory_Idn->getSessionValue() != "") { ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group">
<span<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_grid->WorksheetCategory_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn"<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_grid->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->Lookup->getParamTag($WorksheetMasterCategories_grid, "p_x" . $WorksheetMasterCategories_grid->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($WorksheetMasterCategories_grid->WorksheetCategory_Idn->getSessionValue() != "") { ?>

<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group">
<span<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_grid->WorksheetCategory_Idn->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->CurrentValue) ?>">
<?php } else { ?>

<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn"<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_grid->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->Lookup->getParamTag($WorksheetMasterCategories_grid, "p_x" . $WorksheetMasterCategories_grid->RowIndex . "_WorksheetCategory_Idn") ?>

<?php } ?>

<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->OldValue != null ? $WorksheetMasterCategories_grid->WorksheetCategory_Idn->OldValue : $WorksheetMasterCategories_grid->WorksheetCategory_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->getViewValue() ?></span>
</span>
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" id="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" id="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $WorksheetMasterCategories_grid->Rank->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_Rank" class="form-group">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_Rank" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_grid->Rank->EditValue ?>"<?php echo $WorksheetMasterCategories_grid->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_Rank" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->Rank->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_Rank" class="form-group">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_Rank" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_grid->Rank->EditValue ?>"<?php echo $WorksheetMasterCategories_grid->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_Rank">
<span<?php echo $WorksheetMasterCategories_grid->Rank->viewAttributes() ?>><?php echo $WorksheetMasterCategories_grid->Rank->getViewValue() ?></span>
</span>
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_Rank" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->Rank->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_Rank" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->Rank->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_Rank" name="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" id="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->Rank->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_Rank" name="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" id="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->Rank->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<td data-name="AutoLoadFlag" <?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_AutoLoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_grid->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]_477107" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]_477107"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AutoLoadFlag->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_AutoLoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_grid->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]_428846" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]_428846"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_AutoLoadFlag">
<span<?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AutoLoadFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_grid->AutoLoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AutoLoadFlag"></label></div></span>
</span>
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AutoLoadFlag->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AutoLoadFlag->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag" id="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AutoLoadFlag->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]" id="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AutoLoadFlag->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->LoadFlag->Visible) { // LoadFlag ?>
		<td data-name="LoadFlag" <?php echo $WorksheetMasterCategories_grid->LoadFlag->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_LoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_grid->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]_493562" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_grid->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]_493562"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->LoadFlag->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_LoadFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_grid->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]_572664" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_grid->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]_572664"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_LoadFlag">
<span<?php echo $WorksheetMasterCategories_grid->LoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LoadFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_grid->LoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_grid->LoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LoadFlag"></label></div></span>
</span>
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->LoadFlag->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->LoadFlag->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag" id="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->LoadFlag->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]" id="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->LoadFlag->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->AddMiscFlag->Visible) { // AddMiscFlag ?>
		<td data-name="AddMiscFlag" <?php echo $WorksheetMasterCategories_grid->AddMiscFlag->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_AddMiscFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_grid->AddMiscFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]_587714" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_grid->AddMiscFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]_587714"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AddMiscFlag->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_AddMiscFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_grid->AddMiscFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]_536680" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_grid->AddMiscFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]_536680"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_AddMiscFlag">
<span<?php echo $WorksheetMasterCategories_grid->AddMiscFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AddMiscFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_grid->AddMiscFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_grid->AddMiscFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AddMiscFlag"></label></div></span>
</span>
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AddMiscFlag->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AddMiscFlag->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag" id="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AddMiscFlag->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]" id="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AddMiscFlag->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
		<td data-name="ChildWorksheetMaster_Idn" <?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn"<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_grid->RowIndex}_ChildWorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterCategories_grid, "p_x" . $WorksheetMasterCategories_grid->RowIndex . "_ChildWorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn"<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_grid->RowIndex}_ChildWorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterCategories_grid, "p_x" . $WorksheetMasterCategories_grid->RowIndex . "_ChildWorksheetMaster_Idn") ?>
</span>
<?php } ?>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetMasterCategories_grid->RowCount ?>_WorksheetMasterCategories_ChildWorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" name="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" id="fWorksheetMasterCategoriesgrid$x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->FormValue) ?>">
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" name="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" id="fWorksheetMasterCategoriesgrid$o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterCategories_grid->ListOptions->render("body", "right", $WorksheetMasterCategories_grid->RowCount);
?>
	</tr>
<?php if ($WorksheetMasterCategories->RowType == ROWTYPE_ADD || $WorksheetMasterCategories->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fWorksheetMasterCategoriesgrid", "load"], function() {
	fWorksheetMasterCategoriesgrid.updateLists(<?php echo $WorksheetMasterCategories_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$WorksheetMasterCategories_grid->isGridAdd() || $WorksheetMasterCategories->CurrentMode == "copy")
		if (!$WorksheetMasterCategories_grid->Recordset->EOF)
			$WorksheetMasterCategories_grid->Recordset->moveNext();
}
?>
<?php
	if ($WorksheetMasterCategories->CurrentMode == "add" || $WorksheetMasterCategories->CurrentMode == "copy" || $WorksheetMasterCategories->CurrentMode == "edit") {
		$WorksheetMasterCategories_grid->RowIndex = '$rowindex$';
		$WorksheetMasterCategories_grid->loadRowValues();

		// Set row properties
		$WorksheetMasterCategories->resetAttributes();
		$WorksheetMasterCategories->RowAttrs->merge(["data-rowindex" => $WorksheetMasterCategories_grid->RowIndex, "id" => "r0_WorksheetMasterCategories", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetMasterCategories->RowAttrs->appendClass("ew-template");
		$WorksheetMasterCategories->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetMasterCategories_grid->renderRow();

		// Render list options
		$WorksheetMasterCategories_grid->renderListOptions();
		$WorksheetMasterCategories_grid->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetMasterCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterCategories_grid->ListOptions->render("body", "left", $WorksheetMasterCategories_grid->RowIndex);
?>
	<?php if ($WorksheetMasterCategories_grid->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<?php if ($WorksheetMasterCategories_grid->WorksheetMaster_Idn->getSessionValue() != "") { ?>
<span id="el$rowindex$_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group WorksheetMasterCategories_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_grid->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group WorksheetMasterCategories_WorksheetMaster_Idn">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->EditValue ?>"<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterCategories_WorksheetMaster_Idn" class="form-group WorksheetMasterCategories_WorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_grid->WorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_grid->WorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<td data-name="WorksheetCategory_Idn">
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<?php if ($WorksheetMasterCategories_grid->WorksheetCategory_Idn->getSessionValue() != "") { ?>
<span id="el$rowindex$_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group WorksheetMasterCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_grid->WorksheetCategory_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group WorksheetMasterCategories_WorksheetCategory_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn"<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_grid->RowIndex}_WorksheetCategory_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->Lookup->getParamTag($WorksheetMasterCategories_grid, "p_x" . $WorksheetMasterCategories_grid->RowIndex . "_WorksheetCategory_Idn") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterCategories_WorksheetCategory_Idn" class="form-group WorksheetMasterCategories_WorksheetCategory_Idn">
<span<?php echo $WorksheetMasterCategories_grid->WorksheetCategory_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_grid->WorksheetCategory_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_WorksheetCategory_Idn" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_WorksheetCategory_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->WorksheetCategory_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<span id="el$rowindex$_WorksheetMasterCategories_Rank" class="form-group WorksheetMasterCategories_Rank">
<input type="text" data-table="WorksheetMasterCategories" data-field="x_Rank" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($WorksheetMasterCategories_grid->Rank->getPlaceHolder()) ?>" value="<?php echo $WorksheetMasterCategories_grid->Rank->EditValue ?>"<?php echo $WorksheetMasterCategories_grid->Rank->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterCategories_Rank" class="form-group WorksheetMasterCategories_Rank">
<span<?php echo $WorksheetMasterCategories_grid->Rank->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_grid->Rank->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_Rank" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->Rank->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_Rank" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_Rank" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<td data-name="AutoLoadFlag">
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<span id="el$rowindex$_WorksheetMasterCategories_AutoLoadFlag" class="form-group WorksheetMasterCategories_AutoLoadFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_grid->AutoLoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]_817428" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]_817428"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterCategories_AutoLoadFlag" class="form-group WorksheetMasterCategories_AutoLoadFlag">
<span<?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AutoLoadFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_grid->AutoLoadFlag->ViewValue ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_grid->AutoLoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AutoLoadFlag"></label></div></span>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AutoLoadFlag->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AutoLoadFlag" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AutoLoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AutoLoadFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->LoadFlag->Visible) { // LoadFlag ?>
		<td data-name="LoadFlag">
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<span id="el$rowindex$_WorksheetMasterCategories_LoadFlag" class="form-group WorksheetMasterCategories_LoadFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_grid->LoadFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]_701628" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_grid->LoadFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]_701628"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterCategories_LoadFlag" class="form-group WorksheetMasterCategories_LoadFlag">
<span<?php echo $WorksheetMasterCategories_grid->LoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LoadFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_grid->LoadFlag->ViewValue ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_grid->LoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LoadFlag"></label></div></span>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->LoadFlag->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_LoadFlag" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_LoadFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->LoadFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->AddMiscFlag->Visible) { // AddMiscFlag ?>
		<td data-name="AddMiscFlag">
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<span id="el$rowindex$_WorksheetMasterCategories_AddMiscFlag" class="form-group WorksheetMasterCategories_AddMiscFlag">
<?php
$selwrk = ConvertToBool($WorksheetMasterCategories_grid->AddMiscFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]_830550" value="1"<?php echo $selwrk ?><?php echo $WorksheetMasterCategories_grid->AddMiscFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]_830550"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterCategories_AddMiscFlag" class="form-group WorksheetMasterCategories_AddMiscFlag">
<span<?php echo $WorksheetMasterCategories_grid->AddMiscFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AddMiscFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_grid->AddMiscFlag->ViewValue ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_grid->AddMiscFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AddMiscFlag"></label></div></span>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AddMiscFlag->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_AddMiscFlag" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_AddMiscFlag[]" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->AddMiscFlag->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
		<td data-name="ChildWorksheetMaster_Idn">
<?php if (!$WorksheetMasterCategories->isConfirm()) { ?>
<span id="el$rowindex$_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="form-group WorksheetMasterCategories_ChildWorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn"<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetMasterCategories_grid->RowIndex}_ChildWorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->Lookup->getParamTag($WorksheetMasterCategories_grid, "p_x" . $WorksheetMasterCategories_grid->RowIndex . "_ChildWorksheetMaster_Idn") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_WorksheetMasterCategories_ChildWorksheetMaster_Idn" class="form-group WorksheetMasterCategories_ChildWorksheetMaster_Idn">
<span<?php echo $WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" name="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" id="x<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="WorksheetMasterCategories" data-field="x_ChildWorksheetMaster_Idn" name="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" id="o<?php echo $WorksheetMasterCategories_grid->RowIndex ?>_ChildWorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetMasterCategories_grid->ChildWorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterCategories_grid->ListOptions->render("body", "right", $WorksheetMasterCategories_grid->RowIndex);
?>
<script>
loadjs.ready(["fWorksheetMasterCategoriesgrid", "load"], function() {
	fWorksheetMasterCategoriesgrid.updateLists(<?php echo $WorksheetMasterCategories_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($WorksheetMasterCategories->CurrentMode == "add" || $WorksheetMasterCategories->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $WorksheetMasterCategories_grid->FormKeyCountName ?>" id="<?php echo $WorksheetMasterCategories_grid->FormKeyCountName ?>" value="<?php echo $WorksheetMasterCategories_grid->KeyCount ?>">
<?php echo $WorksheetMasterCategories_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($WorksheetMasterCategories->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $WorksheetMasterCategories_grid->FormKeyCountName ?>" id="<?php echo $WorksheetMasterCategories_grid->FormKeyCountName ?>" value="<?php echo $WorksheetMasterCategories_grid->KeyCount ?>">
<?php echo $WorksheetMasterCategories_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($WorksheetMasterCategories->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fWorksheetMasterCategoriesgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($WorksheetMasterCategories_grid->Recordset)
	$WorksheetMasterCategories_grid->Recordset->Close();
?>
<?php if ($WorksheetMasterCategories_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $WorksheetMasterCategories_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($WorksheetMasterCategories_grid->TotalRecords == 0 && !$WorksheetMasterCategories->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $WorksheetMasterCategories_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$WorksheetMasterCategories_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$WorksheetMasterCategories_grid->terminate();
?>