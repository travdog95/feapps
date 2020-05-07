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
$RecapCells_list = new RecapCells_list();

// Run the page
$RecapCells_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapCells_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$RecapCells_list->isExport()) { ?>
<script>
var fRecapCellslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fRecapCellslist = currentForm = new ew.Form("fRecapCellslist", "list");
	fRecapCellslist.formKeyCountName = '<?php echo $RecapCells_list->FormKeyCountName ?>';

	// Validate form
	fRecapCellslist.validate = function() {
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
			<?php if ($RecapCells_list->WorksheetColumn_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetColumn_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapCells_list->WorksheetColumn_Idn->caption(), $RecapCells_list->WorksheetColumn_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_WorksheetColumn_Idn");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($RecapCells_list->WorksheetColumn_Idn->errorMessage()) ?>");
			<?php if ($RecapCells_list->RecapRow_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RecapRow_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapCells_list->RecapRow_Idn->caption(), $RecapCells_list->RecapRow_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapCells_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapCells_list->ActiveFlag->caption(), $RecapCells_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fRecapCellslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "WorksheetColumn_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "RecapRow_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fRecapCellslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapCellslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRecapCellslist.lists["x_RecapRow_Idn"] = <?php echo $RecapCells_list->RecapRow_Idn->Lookup->toClientList($RecapCells_list) ?>;
	fRecapCellslist.lists["x_RecapRow_Idn"].options = <?php echo JsonEncode($RecapCells_list->RecapRow_Idn->lookupOptions()) ?>;
	fRecapCellslist.lists["x_ActiveFlag[]"] = <?php echo $RecapCells_list->ActiveFlag->Lookup->toClientList($RecapCells_list) ?>;
	fRecapCellslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($RecapCells_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fRecapCellslist");
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
<?php if (!$RecapCells_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($RecapCells_list->TotalRecords > 0 && $RecapCells_list->ExportOptions->visible()) { ?>
<?php $RecapCells_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($RecapCells_list->ImportOptions->visible()) { ?>
<?php $RecapCells_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$RecapCells_list->renderOtherOptions();
?>
<?php $RecapCells_list->showPageHeader(); ?>
<?php
$RecapCells_list->showMessage();
?>
<?php if ($RecapCells_list->TotalRecords > 0 || $RecapCells->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($RecapCells_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> RecapCells">
<?php if (!$RecapCells_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$RecapCells_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapCells_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RecapCells_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fRecapCellslist" id="fRecapCellslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapCells">
<div id="gmp_RecapCells" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($RecapCells_list->TotalRecords > 0 || $RecapCells_list->isAdd() || $RecapCells_list->isCopy() || $RecapCells_list->isGridEdit()) { ?>
<table id="tbl_RecapCellslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$RecapCells->RowType = ROWTYPE_HEADER;

// Render list options
$RecapCells_list->renderListOptions();

// Render list options (header, left)
$RecapCells_list->ListOptions->render("header", "left");
?>
<?php if ($RecapCells_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
	<?php if ($RecapCells_list->SortUrl($RecapCells_list->WorksheetColumn_Idn) == "") { ?>
		<th data-name="WorksheetColumn_Idn" class="<?php echo $RecapCells_list->WorksheetColumn_Idn->headerCellClass() ?>"><div id="elh_RecapCells_WorksheetColumn_Idn" class="RecapCells_WorksheetColumn_Idn"><div class="ew-table-header-caption"><?php echo $RecapCells_list->WorksheetColumn_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetColumn_Idn" class="<?php echo $RecapCells_list->WorksheetColumn_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapCells_list->SortUrl($RecapCells_list->WorksheetColumn_Idn) ?>', 1);"><div id="elh_RecapCells_WorksheetColumn_Idn" class="RecapCells_WorksheetColumn_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapCells_list->WorksheetColumn_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapCells_list->WorksheetColumn_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapCells_list->WorksheetColumn_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapCells_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
	<?php if ($RecapCells_list->SortUrl($RecapCells_list->RecapRow_Idn) == "") { ?>
		<th data-name="RecapRow_Idn" class="<?php echo $RecapCells_list->RecapRow_Idn->headerCellClass() ?>"><div id="elh_RecapCells_RecapRow_Idn" class="RecapCells_RecapRow_Idn"><div class="ew-table-header-caption"><?php echo $RecapCells_list->RecapRow_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RecapRow_Idn" class="<?php echo $RecapCells_list->RecapRow_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapCells_list->SortUrl($RecapCells_list->RecapRow_Idn) ?>', 1);"><div id="elh_RecapCells_RecapRow_Idn" class="RecapCells_RecapRow_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapCells_list->RecapRow_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapCells_list->RecapRow_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapCells_list->RecapRow_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapCells_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($RecapCells_list->SortUrl($RecapCells_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $RecapCells_list->ActiveFlag->headerCellClass() ?>"><div id="elh_RecapCells_ActiveFlag" class="RecapCells_ActiveFlag"><div class="ew-table-header-caption"><?php echo $RecapCells_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $RecapCells_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapCells_list->SortUrl($RecapCells_list->ActiveFlag) ?>', 1);"><div id="elh_RecapCells_ActiveFlag" class="RecapCells_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapCells_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapCells_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapCells_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$RecapCells_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($RecapCells_list->isAdd() || $RecapCells_list->isCopy()) {
		$RecapCells_list->RowIndex = 0;
		$RecapCells_list->KeyCount = $RecapCells_list->RowIndex;
		if ($RecapCells_list->isCopy() && !$RecapCells_list->loadRow())
			$RecapCells->CurrentAction = "add";
		if ($RecapCells_list->isAdd())
			$RecapCells_list->loadRowValues();
		if ($RecapCells->EventCancelled) // Insert failed
			$RecapCells_list->restoreFormValues(); // Restore form values

		// Set row properties
		$RecapCells->resetAttributes();
		$RecapCells->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_RecapCells", "data-rowtype" => ROWTYPE_ADD]);
		$RecapCells->RowType = ROWTYPE_ADD;

		// Render row
		$RecapCells_list->renderRow();

		// Render list options
		$RecapCells_list->renderListOptions();
		$RecapCells_list->StartRowCount = 0;
?>
	<tr <?php echo $RecapCells->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapCells_list->ListOptions->render("body", "left", $RecapCells_list->RowCount);
?>
	<?php if ($RecapCells_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td data-name="WorksheetColumn_Idn">
<span id="el<?php echo $RecapCells_list->RowCount ?>_RecapCells_WorksheetColumn_Idn" class="form-group RecapCells_WorksheetColumn_Idn">
<input type="text" data-table="RecapCells" data-field="x_WorksheetColumn_Idn" name="x<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" id="x<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapCells_list->WorksheetColumn_Idn->getPlaceHolder()) ?>" value="<?php echo $RecapCells_list->WorksheetColumn_Idn->EditValue ?>"<?php echo $RecapCells_list->WorksheetColumn_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapCells" data-field="x_WorksheetColumn_Idn" name="o<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" id="o<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($RecapCells_list->WorksheetColumn_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapCells_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td data-name="RecapRow_Idn">
<span id="el<?php echo $RecapCells_list->RowCount ?>_RecapCells_RecapRow_Idn" class="form-group RecapCells_RecapRow_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapCells" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapCells_list->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" name="x<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn"<?php echo $RecapCells_list->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapCells_list->RecapRow_Idn->selectOptionListHtml("x{$RecapCells_list->RowIndex}_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapCells_list->RecapRow_Idn->Lookup->getParamTag($RecapCells_list, "p_x" . $RecapCells_list->RowIndex . "_RecapRow_Idn") ?>
</span>
<input type="hidden" data-table="RecapCells" data-field="x_RecapRow_Idn" name="o<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" id="o<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapCells_list->RecapRow_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapCells_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $RecapCells_list->RowCount ?>_RecapCells_ActiveFlag" class="form-group RecapCells_ActiveFlag">
<?php
$selwrk = ConvertToBool($RecapCells_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapCells" data-field="x_ActiveFlag" name="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]_330652" value="1"<?php echo $selwrk ?><?php echo $RecapCells_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]_330652"></label>
</div>
</span>
<input type="hidden" data-table="RecapCells" data-field="x_ActiveFlag" name="o<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RecapCells_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapCells_list->ListOptions->render("body", "right", $RecapCells_list->RowCount);
?>
<script>
loadjs.ready(["fRecapCellslist", "load"], function() {
	fRecapCellslist.updateLists(<?php echo $RecapCells_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($RecapCells_list->ExportAll && $RecapCells_list->isExport()) {
	$RecapCells_list->StopRecord = $RecapCells_list->TotalRecords;
} else {

	// Set the last record to display
	if ($RecapCells_list->TotalRecords > $RecapCells_list->StartRecord + $RecapCells_list->DisplayRecords - 1)
		$RecapCells_list->StopRecord = $RecapCells_list->StartRecord + $RecapCells_list->DisplayRecords - 1;
	else
		$RecapCells_list->StopRecord = $RecapCells_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($RecapCells->isConfirm() || $RecapCells_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($RecapCells_list->FormKeyCountName) && ($RecapCells_list->isGridAdd() || $RecapCells_list->isGridEdit() || $RecapCells->isConfirm())) {
		$RecapCells_list->KeyCount = $CurrentForm->getValue($RecapCells_list->FormKeyCountName);
		$RecapCells_list->StopRecord = $RecapCells_list->StartRecord + $RecapCells_list->KeyCount - 1;
	}
}
$RecapCells_list->RecordCount = $RecapCells_list->StartRecord - 1;
if ($RecapCells_list->Recordset && !$RecapCells_list->Recordset->EOF) {
	$RecapCells_list->Recordset->moveFirst();
	$selectLimit = $RecapCells_list->UseSelectLimit;
	if (!$selectLimit && $RecapCells_list->StartRecord > 1)
		$RecapCells_list->Recordset->move($RecapCells_list->StartRecord - 1);
} elseif (!$RecapCells->AllowAddDeleteRow && $RecapCells_list->StopRecord == 0) {
	$RecapCells_list->StopRecord = $RecapCells->GridAddRowCount;
}

// Initialize aggregate
$RecapCells->RowType = ROWTYPE_AGGREGATEINIT;
$RecapCells->resetAttributes();
$RecapCells_list->renderRow();
$RecapCells_list->EditRowCount = 0;
if ($RecapCells_list->isEdit())
	$RecapCells_list->RowIndex = 1;
if ($RecapCells_list->isGridAdd())
	$RecapCells_list->RowIndex = 0;
if ($RecapCells_list->isGridEdit())
	$RecapCells_list->RowIndex = 0;
while ($RecapCells_list->RecordCount < $RecapCells_list->StopRecord) {
	$RecapCells_list->RecordCount++;
	if ($RecapCells_list->RecordCount >= $RecapCells_list->StartRecord) {
		$RecapCells_list->RowCount++;
		if ($RecapCells_list->isGridAdd() || $RecapCells_list->isGridEdit() || $RecapCells->isConfirm()) {
			$RecapCells_list->RowIndex++;
			$CurrentForm->Index = $RecapCells_list->RowIndex;
			if ($CurrentForm->hasValue($RecapCells_list->FormActionName) && ($RecapCells->isConfirm() || $RecapCells_list->EventCancelled))
				$RecapCells_list->RowAction = strval($CurrentForm->getValue($RecapCells_list->FormActionName));
			elseif ($RecapCells_list->isGridAdd())
				$RecapCells_list->RowAction = "insert";
			else
				$RecapCells_list->RowAction = "";
		}

		// Set up key count
		$RecapCells_list->KeyCount = $RecapCells_list->RowIndex;

		// Init row class and style
		$RecapCells->resetAttributes();
		$RecapCells->CssClass = "";
		if ($RecapCells_list->isGridAdd()) {
			$RecapCells_list->loadRowValues(); // Load default values
		} else {
			$RecapCells_list->loadRowValues($RecapCells_list->Recordset); // Load row values
		}
		$RecapCells->RowType = ROWTYPE_VIEW; // Render view
		if ($RecapCells_list->isGridAdd()) // Grid add
			$RecapCells->RowType = ROWTYPE_ADD; // Render add
		if ($RecapCells_list->isGridAdd() && $RecapCells->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$RecapCells_list->restoreCurrentRowFormValues($RecapCells_list->RowIndex); // Restore form values
		if ($RecapCells_list->isEdit()) {
			if ($RecapCells_list->checkInlineEditKey() && $RecapCells_list->EditRowCount == 0) { // Inline edit
				$RecapCells->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($RecapCells_list->isGridEdit()) { // Grid edit
			if ($RecapCells->EventCancelled)
				$RecapCells_list->restoreCurrentRowFormValues($RecapCells_list->RowIndex); // Restore form values
			if ($RecapCells_list->RowAction == "insert")
				$RecapCells->RowType = ROWTYPE_ADD; // Render add
			else
				$RecapCells->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($RecapCells_list->isEdit() && $RecapCells->RowType == ROWTYPE_EDIT && $RecapCells->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$RecapCells_list->restoreFormValues(); // Restore form values
		}
		if ($RecapCells_list->isGridEdit() && ($RecapCells->RowType == ROWTYPE_EDIT || $RecapCells->RowType == ROWTYPE_ADD) && $RecapCells->EventCancelled) // Update failed
			$RecapCells_list->restoreCurrentRowFormValues($RecapCells_list->RowIndex); // Restore form values
		if ($RecapCells->RowType == ROWTYPE_EDIT) // Edit row
			$RecapCells_list->EditRowCount++;

		// Set up row id / data-rowindex
		$RecapCells->RowAttrs->merge(["data-rowindex" => $RecapCells_list->RowCount, "id" => "r" . $RecapCells_list->RowCount . "_RecapCells", "data-rowtype" => $RecapCells->RowType]);

		// Render row
		$RecapCells_list->renderRow();

		// Render list options
		$RecapCells_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($RecapCells_list->RowAction != "delete" && $RecapCells_list->RowAction != "insertdelete" && !($RecapCells_list->RowAction == "insert" && $RecapCells->isConfirm() && $RecapCells_list->emptyRow())) {
?>
	<tr <?php echo $RecapCells->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapCells_list->ListOptions->render("body", "left", $RecapCells_list->RowCount);
?>
	<?php if ($RecapCells_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td data-name="WorksheetColumn_Idn" <?php echo $RecapCells_list->WorksheetColumn_Idn->cellAttributes() ?>>
<?php if ($RecapCells->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapCells_list->RowCount ?>_RecapCells_WorksheetColumn_Idn" class="form-group">
<input type="text" data-table="RecapCells" data-field="x_WorksheetColumn_Idn" name="x<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" id="x<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapCells_list->WorksheetColumn_Idn->getPlaceHolder()) ?>" value="<?php echo $RecapCells_list->WorksheetColumn_Idn->EditValue ?>"<?php echo $RecapCells_list->WorksheetColumn_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapCells" data-field="x_WorksheetColumn_Idn" name="o<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" id="o<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($RecapCells_list->WorksheetColumn_Idn->OldValue) ?>">
<?php } ?>
<?php if ($RecapCells->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="RecapCells" data-field="x_WorksheetColumn_Idn" name="x<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" id="x<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapCells_list->WorksheetColumn_Idn->getPlaceHolder()) ?>" value="<?php echo $RecapCells_list->WorksheetColumn_Idn->EditValue ?>"<?php echo $RecapCells_list->WorksheetColumn_Idn->editAttributes() ?>>
<input type="hidden" data-table="RecapCells" data-field="x_WorksheetColumn_Idn" name="o<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" id="o<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($RecapCells_list->WorksheetColumn_Idn->OldValue != null ? $RecapCells_list->WorksheetColumn_Idn->OldValue : $RecapCells_list->WorksheetColumn_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($RecapCells->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapCells_list->RowCount ?>_RecapCells_WorksheetColumn_Idn">
<span<?php echo $RecapCells_list->WorksheetColumn_Idn->viewAttributes() ?>><?php echo $RecapCells_list->WorksheetColumn_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapCells_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td data-name="RecapRow_Idn" <?php echo $RecapCells_list->RecapRow_Idn->cellAttributes() ?>>
<?php if ($RecapCells->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapCells_list->RowCount ?>_RecapCells_RecapRow_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapCells" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapCells_list->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" name="x<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn"<?php echo $RecapCells_list->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapCells_list->RecapRow_Idn->selectOptionListHtml("x{$RecapCells_list->RowIndex}_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapCells_list->RecapRow_Idn->Lookup->getParamTag($RecapCells_list, "p_x" . $RecapCells_list->RowIndex . "_RecapRow_Idn") ?>
</span>
<input type="hidden" data-table="RecapCells" data-field="x_RecapRow_Idn" name="o<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" id="o<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapCells_list->RecapRow_Idn->OldValue) ?>">
<?php } ?>
<?php if ($RecapCells->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapCells" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapCells_list->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" name="x<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn"<?php echo $RecapCells_list->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapCells_list->RecapRow_Idn->selectOptionListHtml("x{$RecapCells_list->RowIndex}_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapCells_list->RecapRow_Idn->Lookup->getParamTag($RecapCells_list, "p_x" . $RecapCells_list->RowIndex . "_RecapRow_Idn") ?>
<input type="hidden" data-table="RecapCells" data-field="x_RecapRow_Idn" name="o<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" id="o<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapCells_list->RecapRow_Idn->OldValue != null ? $RecapCells_list->RecapRow_Idn->OldValue : $RecapCells_list->RecapRow_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($RecapCells->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapCells_list->RowCount ?>_RecapCells_RecapRow_Idn">
<span<?php echo $RecapCells_list->RecapRow_Idn->viewAttributes() ?>><?php echo $RecapCells_list->RecapRow_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapCells_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $RecapCells_list->ActiveFlag->cellAttributes() ?>>
<?php if ($RecapCells->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapCells_list->RowCount ?>_RecapCells_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapCells_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapCells" data-field="x_ActiveFlag" name="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]_789272" value="1"<?php echo $selwrk ?><?php echo $RecapCells_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]_789272"></label>
</div>
</span>
<input type="hidden" data-table="RecapCells" data-field="x_ActiveFlag" name="o<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RecapCells_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($RecapCells->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $RecapCells_list->RowCount ?>_RecapCells_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($RecapCells_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapCells" data-field="x_ActiveFlag" name="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]_271172" value="1"<?php echo $selwrk ?><?php echo $RecapCells_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]_271172"></label>
</div>
</span>
<?php } ?>
<?php if ($RecapCells->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapCells_list->RowCount ?>_RecapCells_ActiveFlag">
<span<?php echo $RecapCells_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $RecapCells_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($RecapCells_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapCells_list->ListOptions->render("body", "right", $RecapCells_list->RowCount);
?>
	</tr>
<?php if ($RecapCells->RowType == ROWTYPE_ADD || $RecapCells->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fRecapCellslist", "load"], function() {
	fRecapCellslist.updateLists(<?php echo $RecapCells_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$RecapCells_list->isGridAdd())
		if (!$RecapCells_list->Recordset->EOF)
			$RecapCells_list->Recordset->moveNext();
}
?>
<?php
	if ($RecapCells_list->isGridAdd() || $RecapCells_list->isGridEdit()) {
		$RecapCells_list->RowIndex = '$rowindex$';
		$RecapCells_list->loadRowValues();

		// Set row properties
		$RecapCells->resetAttributes();
		$RecapCells->RowAttrs->merge(["data-rowindex" => $RecapCells_list->RowIndex, "id" => "r0_RecapCells", "data-rowtype" => ROWTYPE_ADD]);
		$RecapCells->RowAttrs->appendClass("ew-template");
		$RecapCells->RowType = ROWTYPE_ADD;

		// Render row
		$RecapCells_list->renderRow();

		// Render list options
		$RecapCells_list->renderListOptions();
		$RecapCells_list->StartRowCount = 0;
?>
	<tr <?php echo $RecapCells->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapCells_list->ListOptions->render("body", "left", $RecapCells_list->RowIndex);
?>
	<?php if ($RecapCells_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td data-name="WorksheetColumn_Idn">
<span id="el$rowindex$_RecapCells_WorksheetColumn_Idn" class="form-group RecapCells_WorksheetColumn_Idn">
<input type="text" data-table="RecapCells" data-field="x_WorksheetColumn_Idn" name="x<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" id="x<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($RecapCells_list->WorksheetColumn_Idn->getPlaceHolder()) ?>" value="<?php echo $RecapCells_list->WorksheetColumn_Idn->EditValue ?>"<?php echo $RecapCells_list->WorksheetColumn_Idn->editAttributes() ?>>
</span>
<input type="hidden" data-table="RecapCells" data-field="x_WorksheetColumn_Idn" name="o<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" id="o<?php echo $RecapCells_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($RecapCells_list->WorksheetColumn_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapCells_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td data-name="RecapRow_Idn">
<span id="el$rowindex$_RecapCells_RecapRow_Idn" class="form-group RecapCells_RecapRow_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapCells" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapCells_list->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" name="x<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn"<?php echo $RecapCells_list->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapCells_list->RecapRow_Idn->selectOptionListHtml("x{$RecapCells_list->RowIndex}_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapCells_list->RecapRow_Idn->Lookup->getParamTag($RecapCells_list, "p_x" . $RecapCells_list->RowIndex . "_RecapRow_Idn") ?>
</span>
<input type="hidden" data-table="RecapCells" data-field="x_RecapRow_Idn" name="o<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" id="o<?php echo $RecapCells_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapCells_list->RecapRow_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapCells_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_RecapCells_ActiveFlag" class="form-group RecapCells_ActiveFlag">
<?php
$selwrk = ConvertToBool($RecapCells_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="RecapCells" data-field="x_ActiveFlag" name="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]_414041" value="1"<?php echo $selwrk ?><?php echo $RecapCells_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]_414041"></label>
</div>
</span>
<input type="hidden" data-table="RecapCells" data-field="x_ActiveFlag" name="o<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $RecapCells_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($RecapCells_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapCells_list->ListOptions->render("body", "right", $RecapCells_list->RowIndex);
?>
<script>
loadjs.ready(["fRecapCellslist", "load"], function() {
	fRecapCellslist.updateLists(<?php echo $RecapCells_list->RowIndex ?>);
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
<?php if ($RecapCells_list->isAdd() || $RecapCells_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $RecapCells_list->FormKeyCountName ?>" id="<?php echo $RecapCells_list->FormKeyCountName ?>" value="<?php echo $RecapCells_list->KeyCount ?>">
<?php } ?>
<?php if ($RecapCells_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $RecapCells_list->FormKeyCountName ?>" id="<?php echo $RecapCells_list->FormKeyCountName ?>" value="<?php echo $RecapCells_list->KeyCount ?>">
<?php echo $RecapCells_list->MultiSelectKey ?>
<?php } ?>
<?php if ($RecapCells_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $RecapCells_list->FormKeyCountName ?>" id="<?php echo $RecapCells_list->FormKeyCountName ?>" value="<?php echo $RecapCells_list->KeyCount ?>">
<?php } ?>
<?php if ($RecapCells_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $RecapCells_list->FormKeyCountName ?>" id="<?php echo $RecapCells_list->FormKeyCountName ?>" value="<?php echo $RecapCells_list->KeyCount ?>">
<?php echo $RecapCells_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$RecapCells->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($RecapCells_list->Recordset)
	$RecapCells_list->Recordset->Close();
?>
<?php if (!$RecapCells_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$RecapCells_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapCells_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RecapCells_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($RecapCells_list->TotalRecords == 0 && !$RecapCells->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $RecapCells_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$RecapCells_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$RecapCells_list->isExport()) { ?>
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
$RecapCells_list->terminate();
?>