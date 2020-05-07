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
$RecapRowWorksheetMasters_list = new RecapRowWorksheetMasters_list();

// Run the page
$RecapRowWorksheetMasters_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$RecapRowWorksheetMasters_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$RecapRowWorksheetMasters_list->isExport()) { ?>
<script>
var fRecapRowWorksheetMasterslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fRecapRowWorksheetMasterslist = currentForm = new ew.Form("fRecapRowWorksheetMasterslist", "list");
	fRecapRowWorksheetMasterslist.formKeyCountName = '<?php echo $RecapRowWorksheetMasters_list->FormKeyCountName ?>';

	// Validate form
	fRecapRowWorksheetMasterslist.validate = function() {
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
			<?php if ($RecapRowWorksheetMasters_list->RecapRow_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_RecapRow_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRowWorksheetMasters_list->RecapRow_Idn->caption(), $RecapRowWorksheetMasters_list->RecapRow_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->caption(), $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
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
	fRecapRowWorksheetMasterslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "RecapRow_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "WorksheetMaster_Idn", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fRecapRowWorksheetMasterslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRecapRowWorksheetMasterslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fRecapRowWorksheetMasterslist.lists["x_RecapRow_Idn"] = <?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->Lookup->toClientList($RecapRowWorksheetMasters_list) ?>;
	fRecapRowWorksheetMasterslist.lists["x_RecapRow_Idn"].options = <?php echo JsonEncode($RecapRowWorksheetMasters_list->RecapRow_Idn->lookupOptions()) ?>;
	fRecapRowWorksheetMasterslist.lists["x_WorksheetMaster_Idn"] = <?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->Lookup->toClientList($RecapRowWorksheetMasters_list) ?>;
	fRecapRowWorksheetMasterslist.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->lookupOptions()) ?>;
	loadjs.done("fRecapRowWorksheetMasterslist");
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
<?php if (!$RecapRowWorksheetMasters_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($RecapRowWorksheetMasters_list->TotalRecords > 0 && $RecapRowWorksheetMasters_list->ExportOptions->visible()) { ?>
<?php $RecapRowWorksheetMasters_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($RecapRowWorksheetMasters_list->ImportOptions->visible()) { ?>
<?php $RecapRowWorksheetMasters_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$RecapRowWorksheetMasters_list->renderOtherOptions();
?>
<?php $RecapRowWorksheetMasters_list->showPageHeader(); ?>
<?php
$RecapRowWorksheetMasters_list->showMessage();
?>
<?php if ($RecapRowWorksheetMasters_list->TotalRecords > 0 || $RecapRowWorksheetMasters->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($RecapRowWorksheetMasters_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> RecapRowWorksheetMasters">
<?php if (!$RecapRowWorksheetMasters_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$RecapRowWorksheetMasters_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapRowWorksheetMasters_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RecapRowWorksheetMasters_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fRecapRowWorksheetMasterslist" id="fRecapRowWorksheetMasterslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="RecapRowWorksheetMasters">
<div id="gmp_RecapRowWorksheetMasters" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($RecapRowWorksheetMasters_list->TotalRecords > 0 || $RecapRowWorksheetMasters_list->isAdd() || $RecapRowWorksheetMasters_list->isCopy() || $RecapRowWorksheetMasters_list->isGridEdit()) { ?>
<table id="tbl_RecapRowWorksheetMasterslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$RecapRowWorksheetMasters->RowType = ROWTYPE_HEADER;

// Render list options
$RecapRowWorksheetMasters_list->renderListOptions();

// Render list options (header, left)
$RecapRowWorksheetMasters_list->ListOptions->render("header", "left");
?>
<?php if ($RecapRowWorksheetMasters_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
	<?php if ($RecapRowWorksheetMasters_list->SortUrl($RecapRowWorksheetMasters_list->RecapRow_Idn) == "") { ?>
		<th data-name="RecapRow_Idn" class="<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->headerCellClass() ?>"><div id="elh_RecapRowWorksheetMasters_RecapRow_Idn" class="RecapRowWorksheetMasters_RecapRow_Idn"><div class="ew-table-header-caption"><?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RecapRow_Idn" class="<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapRowWorksheetMasters_list->SortUrl($RecapRowWorksheetMasters_list->RecapRow_Idn) ?>', 1);"><div id="elh_RecapRowWorksheetMasters_RecapRow_Idn" class="RecapRowWorksheetMasters_RecapRow_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapRowWorksheetMasters_list->RecapRow_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapRowWorksheetMasters_list->RecapRow_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($RecapRowWorksheetMasters_list->SortUrl($RecapRowWorksheetMasters_list->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_RecapRowWorksheetMasters_WorksheetMaster_Idn" class="RecapRowWorksheetMasters_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $RecapRowWorksheetMasters_list->SortUrl($RecapRowWorksheetMasters_list->WorksheetMaster_Idn) ?>', 1);"><div id="elh_RecapRowWorksheetMasters_WorksheetMaster_Idn" class="RecapRowWorksheetMasters_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$RecapRowWorksheetMasters_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($RecapRowWorksheetMasters_list->isAdd() || $RecapRowWorksheetMasters_list->isCopy()) {
		$RecapRowWorksheetMasters_list->RowIndex = 0;
		$RecapRowWorksheetMasters_list->KeyCount = $RecapRowWorksheetMasters_list->RowIndex;
		if ($RecapRowWorksheetMasters_list->isCopy() && !$RecapRowWorksheetMasters_list->loadRow())
			$RecapRowWorksheetMasters->CurrentAction = "add";
		if ($RecapRowWorksheetMasters_list->isAdd())
			$RecapRowWorksheetMasters_list->loadRowValues();
		if ($RecapRowWorksheetMasters->EventCancelled) // Insert failed
			$RecapRowWorksheetMasters_list->restoreFormValues(); // Restore form values

		// Set row properties
		$RecapRowWorksheetMasters->resetAttributes();
		$RecapRowWorksheetMasters->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_RecapRowWorksheetMasters", "data-rowtype" => ROWTYPE_ADD]);
		$RecapRowWorksheetMasters->RowType = ROWTYPE_ADD;

		// Render row
		$RecapRowWorksheetMasters_list->renderRow();

		// Render list options
		$RecapRowWorksheetMasters_list->renderListOptions();
		$RecapRowWorksheetMasters_list->StartRowCount = 0;
?>
	<tr <?php echo $RecapRowWorksheetMasters->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapRowWorksheetMasters_list->ListOptions->render("body", "left", $RecapRowWorksheetMasters_list->RowCount);
?>
	<?php if ($RecapRowWorksheetMasters_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td data-name="RecapRow_Idn">
<span id="el<?php echo $RecapRowWorksheetMasters_list->RowCount ?>_RecapRowWorksheetMasters_RecapRow_Idn" class="form-group RecapRowWorksheetMasters_RecapRow_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" name="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn"<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->selectOptionListHtml("x{$RecapRowWorksheetMasters_list->RowIndex}_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_list, "p_x" . $RecapRowWorksheetMasters_list->RowIndex . "_RecapRow_Idn") ?>
</span>
<input type="hidden" data-table="RecapRowWorksheetMasters" data-field="x_RecapRow_Idn" name="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" id="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapRowWorksheetMasters_list->RecapRow_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el<?php echo $RecapRowWorksheetMasters_list->RowCount ?>_RecapRowWorksheetMasters_WorksheetMaster_Idn" class="form-group RecapRowWorksheetMasters_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->selectOptionListHtml("x{$RecapRowWorksheetMasters_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_list, "p_x" . $RecapRowWorksheetMasters_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="RecapRowWorksheetMasters" data-field="x_WorksheetMaster_Idn" name="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapRowWorksheetMasters_list->ListOptions->render("body", "right", $RecapRowWorksheetMasters_list->RowCount);
?>
<script>
loadjs.ready(["fRecapRowWorksheetMasterslist", "load"], function() {
	fRecapRowWorksheetMasterslist.updateLists(<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($RecapRowWorksheetMasters_list->ExportAll && $RecapRowWorksheetMasters_list->isExport()) {
	$RecapRowWorksheetMasters_list->StopRecord = $RecapRowWorksheetMasters_list->TotalRecords;
} else {

	// Set the last record to display
	if ($RecapRowWorksheetMasters_list->TotalRecords > $RecapRowWorksheetMasters_list->StartRecord + $RecapRowWorksheetMasters_list->DisplayRecords - 1)
		$RecapRowWorksheetMasters_list->StopRecord = $RecapRowWorksheetMasters_list->StartRecord + $RecapRowWorksheetMasters_list->DisplayRecords - 1;
	else
		$RecapRowWorksheetMasters_list->StopRecord = $RecapRowWorksheetMasters_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($RecapRowWorksheetMasters->isConfirm() || $RecapRowWorksheetMasters_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($RecapRowWorksheetMasters_list->FormKeyCountName) && ($RecapRowWorksheetMasters_list->isGridAdd() || $RecapRowWorksheetMasters_list->isGridEdit() || $RecapRowWorksheetMasters->isConfirm())) {
		$RecapRowWorksheetMasters_list->KeyCount = $CurrentForm->getValue($RecapRowWorksheetMasters_list->FormKeyCountName);
		$RecapRowWorksheetMasters_list->StopRecord = $RecapRowWorksheetMasters_list->StartRecord + $RecapRowWorksheetMasters_list->KeyCount - 1;
	}
}
$RecapRowWorksheetMasters_list->RecordCount = $RecapRowWorksheetMasters_list->StartRecord - 1;
if ($RecapRowWorksheetMasters_list->Recordset && !$RecapRowWorksheetMasters_list->Recordset->EOF) {
	$RecapRowWorksheetMasters_list->Recordset->moveFirst();
	$selectLimit = $RecapRowWorksheetMasters_list->UseSelectLimit;
	if (!$selectLimit && $RecapRowWorksheetMasters_list->StartRecord > 1)
		$RecapRowWorksheetMasters_list->Recordset->move($RecapRowWorksheetMasters_list->StartRecord - 1);
} elseif (!$RecapRowWorksheetMasters->AllowAddDeleteRow && $RecapRowWorksheetMasters_list->StopRecord == 0) {
	$RecapRowWorksheetMasters_list->StopRecord = $RecapRowWorksheetMasters->GridAddRowCount;
}

// Initialize aggregate
$RecapRowWorksheetMasters->RowType = ROWTYPE_AGGREGATEINIT;
$RecapRowWorksheetMasters->resetAttributes();
$RecapRowWorksheetMasters_list->renderRow();
$RecapRowWorksheetMasters_list->EditRowCount = 0;
if ($RecapRowWorksheetMasters_list->isEdit())
	$RecapRowWorksheetMasters_list->RowIndex = 1;
if ($RecapRowWorksheetMasters_list->isGridAdd())
	$RecapRowWorksheetMasters_list->RowIndex = 0;
if ($RecapRowWorksheetMasters_list->isGridEdit())
	$RecapRowWorksheetMasters_list->RowIndex = 0;
while ($RecapRowWorksheetMasters_list->RecordCount < $RecapRowWorksheetMasters_list->StopRecord) {
	$RecapRowWorksheetMasters_list->RecordCount++;
	if ($RecapRowWorksheetMasters_list->RecordCount >= $RecapRowWorksheetMasters_list->StartRecord) {
		$RecapRowWorksheetMasters_list->RowCount++;
		if ($RecapRowWorksheetMasters_list->isGridAdd() || $RecapRowWorksheetMasters_list->isGridEdit() || $RecapRowWorksheetMasters->isConfirm()) {
			$RecapRowWorksheetMasters_list->RowIndex++;
			$CurrentForm->Index = $RecapRowWorksheetMasters_list->RowIndex;
			if ($CurrentForm->hasValue($RecapRowWorksheetMasters_list->FormActionName) && ($RecapRowWorksheetMasters->isConfirm() || $RecapRowWorksheetMasters_list->EventCancelled))
				$RecapRowWorksheetMasters_list->RowAction = strval($CurrentForm->getValue($RecapRowWorksheetMasters_list->FormActionName));
			elseif ($RecapRowWorksheetMasters_list->isGridAdd())
				$RecapRowWorksheetMasters_list->RowAction = "insert";
			else
				$RecapRowWorksheetMasters_list->RowAction = "";
		}

		// Set up key count
		$RecapRowWorksheetMasters_list->KeyCount = $RecapRowWorksheetMasters_list->RowIndex;

		// Init row class and style
		$RecapRowWorksheetMasters->resetAttributes();
		$RecapRowWorksheetMasters->CssClass = "";
		if ($RecapRowWorksheetMasters_list->isGridAdd()) {
			$RecapRowWorksheetMasters_list->loadRowValues(); // Load default values
		} else {
			$RecapRowWorksheetMasters_list->loadRowValues($RecapRowWorksheetMasters_list->Recordset); // Load row values
		}
		$RecapRowWorksheetMasters->RowType = ROWTYPE_VIEW; // Render view
		if ($RecapRowWorksheetMasters_list->isGridAdd()) // Grid add
			$RecapRowWorksheetMasters->RowType = ROWTYPE_ADD; // Render add
		if ($RecapRowWorksheetMasters_list->isGridAdd() && $RecapRowWorksheetMasters->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$RecapRowWorksheetMasters_list->restoreCurrentRowFormValues($RecapRowWorksheetMasters_list->RowIndex); // Restore form values
		if ($RecapRowWorksheetMasters_list->isEdit()) {
			if ($RecapRowWorksheetMasters_list->checkInlineEditKey() && $RecapRowWorksheetMasters_list->EditRowCount == 0) { // Inline edit
				$RecapRowWorksheetMasters->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($RecapRowWorksheetMasters_list->isGridEdit()) { // Grid edit
			if ($RecapRowWorksheetMasters->EventCancelled)
				$RecapRowWorksheetMasters_list->restoreCurrentRowFormValues($RecapRowWorksheetMasters_list->RowIndex); // Restore form values
			if ($RecapRowWorksheetMasters_list->RowAction == "insert")
				$RecapRowWorksheetMasters->RowType = ROWTYPE_ADD; // Render add
			else
				$RecapRowWorksheetMasters->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($RecapRowWorksheetMasters_list->isEdit() && $RecapRowWorksheetMasters->RowType == ROWTYPE_EDIT && $RecapRowWorksheetMasters->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$RecapRowWorksheetMasters_list->restoreFormValues(); // Restore form values
		}
		if ($RecapRowWorksheetMasters_list->isGridEdit() && ($RecapRowWorksheetMasters->RowType == ROWTYPE_EDIT || $RecapRowWorksheetMasters->RowType == ROWTYPE_ADD) && $RecapRowWorksheetMasters->EventCancelled) // Update failed
			$RecapRowWorksheetMasters_list->restoreCurrentRowFormValues($RecapRowWorksheetMasters_list->RowIndex); // Restore form values
		if ($RecapRowWorksheetMasters->RowType == ROWTYPE_EDIT) // Edit row
			$RecapRowWorksheetMasters_list->EditRowCount++;

		// Set up row id / data-rowindex
		$RecapRowWorksheetMasters->RowAttrs->merge(["data-rowindex" => $RecapRowWorksheetMasters_list->RowCount, "id" => "r" . $RecapRowWorksheetMasters_list->RowCount . "_RecapRowWorksheetMasters", "data-rowtype" => $RecapRowWorksheetMasters->RowType]);

		// Render row
		$RecapRowWorksheetMasters_list->renderRow();

		// Render list options
		$RecapRowWorksheetMasters_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($RecapRowWorksheetMasters_list->RowAction != "delete" && $RecapRowWorksheetMasters_list->RowAction != "insertdelete" && !($RecapRowWorksheetMasters_list->RowAction == "insert" && $RecapRowWorksheetMasters->isConfirm() && $RecapRowWorksheetMasters_list->emptyRow())) {
?>
	<tr <?php echo $RecapRowWorksheetMasters->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapRowWorksheetMasters_list->ListOptions->render("body", "left", $RecapRowWorksheetMasters_list->RowCount);
?>
	<?php if ($RecapRowWorksheetMasters_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td data-name="RecapRow_Idn" <?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->cellAttributes() ?>>
<?php if ($RecapRowWorksheetMasters->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapRowWorksheetMasters_list->RowCount ?>_RecapRowWorksheetMasters_RecapRow_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" name="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn"<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->selectOptionListHtml("x{$RecapRowWorksheetMasters_list->RowIndex}_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_list, "p_x" . $RecapRowWorksheetMasters_list->RowIndex . "_RecapRow_Idn") ?>
</span>
<input type="hidden" data-table="RecapRowWorksheetMasters" data-field="x_RecapRow_Idn" name="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" id="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapRowWorksheetMasters_list->RecapRow_Idn->OldValue) ?>">
<?php } ?>
<?php if ($RecapRowWorksheetMasters->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" name="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn"<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->selectOptionListHtml("x{$RecapRowWorksheetMasters_list->RowIndex}_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_list, "p_x" . $RecapRowWorksheetMasters_list->RowIndex . "_RecapRow_Idn") ?>
<input type="hidden" data-table="RecapRowWorksheetMasters" data-field="x_RecapRow_Idn" name="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" id="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapRowWorksheetMasters_list->RecapRow_Idn->OldValue != null ? $RecapRowWorksheetMasters_list->RecapRow_Idn->OldValue : $RecapRowWorksheetMasters_list->RecapRow_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($RecapRowWorksheetMasters->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapRowWorksheetMasters_list->RowCount ?>_RecapRowWorksheetMasters_RecapRow_Idn">
<span<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->viewAttributes() ?>><?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($RecapRowWorksheetMasters->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $RecapRowWorksheetMasters_list->RowCount ?>_RecapRowWorksheetMasters_WorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->selectOptionListHtml("x{$RecapRowWorksheetMasters_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_list, "p_x" . $RecapRowWorksheetMasters_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="RecapRowWorksheetMasters" data-field="x_WorksheetMaster_Idn" name="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($RecapRowWorksheetMasters->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->selectOptionListHtml("x{$RecapRowWorksheetMasters_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_list, "p_x" . $RecapRowWorksheetMasters_list->RowIndex . "_WorksheetMaster_Idn") ?>
<input type="hidden" data-table="RecapRowWorksheetMasters" data-field="x_WorksheetMaster_Idn" name="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->OldValue != null ? $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->OldValue : $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($RecapRowWorksheetMasters->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $RecapRowWorksheetMasters_list->RowCount ?>_RecapRowWorksheetMasters_WorksheetMaster_Idn">
<span<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapRowWorksheetMasters_list->ListOptions->render("body", "right", $RecapRowWorksheetMasters_list->RowCount);
?>
	</tr>
<?php if ($RecapRowWorksheetMasters->RowType == ROWTYPE_ADD || $RecapRowWorksheetMasters->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fRecapRowWorksheetMasterslist", "load"], function() {
	fRecapRowWorksheetMasterslist.updateLists(<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$RecapRowWorksheetMasters_list->isGridAdd())
		if (!$RecapRowWorksheetMasters_list->Recordset->EOF)
			$RecapRowWorksheetMasters_list->Recordset->moveNext();
}
?>
<?php
	if ($RecapRowWorksheetMasters_list->isGridAdd() || $RecapRowWorksheetMasters_list->isGridEdit()) {
		$RecapRowWorksheetMasters_list->RowIndex = '$rowindex$';
		$RecapRowWorksheetMasters_list->loadRowValues();

		// Set row properties
		$RecapRowWorksheetMasters->resetAttributes();
		$RecapRowWorksheetMasters->RowAttrs->merge(["data-rowindex" => $RecapRowWorksheetMasters_list->RowIndex, "id" => "r0_RecapRowWorksheetMasters", "data-rowtype" => ROWTYPE_ADD]);
		$RecapRowWorksheetMasters->RowAttrs->appendClass("ew-template");
		$RecapRowWorksheetMasters->RowType = ROWTYPE_ADD;

		// Render row
		$RecapRowWorksheetMasters_list->renderRow();

		// Render list options
		$RecapRowWorksheetMasters_list->renderListOptions();
		$RecapRowWorksheetMasters_list->StartRowCount = 0;
?>
	<tr <?php echo $RecapRowWorksheetMasters->rowAttributes() ?>>
<?php

// Render list options (body, left)
$RecapRowWorksheetMasters_list->ListOptions->render("body", "left", $RecapRowWorksheetMasters_list->RowIndex);
?>
	<?php if ($RecapRowWorksheetMasters_list->RecapRow_Idn->Visible) { // RecapRow_Idn ?>
		<td data-name="RecapRow_Idn">
<span id="el$rowindex$_RecapRowWorksheetMasters_RecapRow_Idn" class="form-group RecapRowWorksheetMasters_RecapRow_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_RecapRow_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" name="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn"<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->selectOptionListHtml("x{$RecapRowWorksheetMasters_list->RowIndex}_RecapRow_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_list->RecapRow_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_list, "p_x" . $RecapRowWorksheetMasters_list->RowIndex . "_RecapRow_Idn") ?>
</span>
<input type="hidden" data-table="RecapRowWorksheetMasters" data-field="x_RecapRow_Idn" name="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" id="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_RecapRow_Idn" value="<?php echo HtmlEncode($RecapRowWorksheetMasters_list->RecapRow_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el$rowindex$_RecapRowWorksheetMasters_WorksheetMaster_Idn" class="form-group RecapRowWorksheetMasters_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="RecapRowWorksheetMasters" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->selectOptionListHtml("x{$RecapRowWorksheetMasters_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $RecapRowWorksheetMasters_list->WorksheetMaster_Idn->Lookup->getParamTag($RecapRowWorksheetMasters_list, "p_x" . $RecapRowWorksheetMasters_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="RecapRowWorksheetMasters" data-field="x_WorksheetMaster_Idn" name="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($RecapRowWorksheetMasters_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$RecapRowWorksheetMasters_list->ListOptions->render("body", "right", $RecapRowWorksheetMasters_list->RowIndex);
?>
<script>
loadjs.ready(["fRecapRowWorksheetMasterslist", "load"], function() {
	fRecapRowWorksheetMasterslist.updateLists(<?php echo $RecapRowWorksheetMasters_list->RowIndex ?>);
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
<?php if ($RecapRowWorksheetMasters_list->isAdd() || $RecapRowWorksheetMasters_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $RecapRowWorksheetMasters_list->FormKeyCountName ?>" id="<?php echo $RecapRowWorksheetMasters_list->FormKeyCountName ?>" value="<?php echo $RecapRowWorksheetMasters_list->KeyCount ?>">
<?php } ?>
<?php if ($RecapRowWorksheetMasters_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $RecapRowWorksheetMasters_list->FormKeyCountName ?>" id="<?php echo $RecapRowWorksheetMasters_list->FormKeyCountName ?>" value="<?php echo $RecapRowWorksheetMasters_list->KeyCount ?>">
<?php echo $RecapRowWorksheetMasters_list->MultiSelectKey ?>
<?php } ?>
<?php if ($RecapRowWorksheetMasters_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $RecapRowWorksheetMasters_list->FormKeyCountName ?>" id="<?php echo $RecapRowWorksheetMasters_list->FormKeyCountName ?>" value="<?php echo $RecapRowWorksheetMasters_list->KeyCount ?>">
<?php } ?>
<?php if ($RecapRowWorksheetMasters_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $RecapRowWorksheetMasters_list->FormKeyCountName ?>" id="<?php echo $RecapRowWorksheetMasters_list->FormKeyCountName ?>" value="<?php echo $RecapRowWorksheetMasters_list->KeyCount ?>">
<?php echo $RecapRowWorksheetMasters_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$RecapRowWorksheetMasters->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($RecapRowWorksheetMasters_list->Recordset)
	$RecapRowWorksheetMasters_list->Recordset->Close();
?>
<?php if (!$RecapRowWorksheetMasters_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$RecapRowWorksheetMasters_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $RecapRowWorksheetMasters_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $RecapRowWorksheetMasters_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($RecapRowWorksheetMasters_list->TotalRecords == 0 && !$RecapRowWorksheetMasters->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $RecapRowWorksheetMasters_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$RecapRowWorksheetMasters_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$RecapRowWorksheetMasters_list->isExport()) { ?>
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
$RecapRowWorksheetMasters_list->terminate();
?>