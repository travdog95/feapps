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
$WorksheetTemplates_list = new WorksheetTemplates_list();

// Run the page
$WorksheetTemplates_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetTemplates_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$WorksheetTemplates_list->isExport()) { ?>
<script>
var fWorksheetTemplateslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fWorksheetTemplateslist = currentForm = new ew.Form("fWorksheetTemplateslist", "list");
	fWorksheetTemplateslist.formKeyCountName = '<?php echo $WorksheetTemplates_list->FormKeyCountName ?>';

	// Validate form
	fWorksheetTemplateslist.validate = function() {
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
			<?php if ($WorksheetTemplates_list->WorksheetMaster_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetMaster_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetTemplates_list->WorksheetMaster_Idn->caption(), $WorksheetTemplates_list->WorksheetMaster_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetTemplates_list->WorksheetColumn_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_WorksheetColumn_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetTemplates_list->WorksheetColumn_Idn->caption(), $WorksheetTemplates_list->WorksheetColumn_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($WorksheetTemplates_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorksheetTemplates_list->ActiveFlag->caption(), $WorksheetTemplates_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fWorksheetTemplateslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "WorksheetMaster_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "WorksheetColumn_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fWorksheetTemplateslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fWorksheetTemplateslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fWorksheetTemplateslist.lists["x_WorksheetMaster_Idn"] = <?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->Lookup->toClientList($WorksheetTemplates_list) ?>;
	fWorksheetTemplateslist.lists["x_WorksheetMaster_Idn"].options = <?php echo JsonEncode($WorksheetTemplates_list->WorksheetMaster_Idn->lookupOptions()) ?>;
	fWorksheetTemplateslist.lists["x_WorksheetColumn_Idn"] = <?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->Lookup->toClientList($WorksheetTemplates_list) ?>;
	fWorksheetTemplateslist.lists["x_WorksheetColumn_Idn"].options = <?php echo JsonEncode($WorksheetTemplates_list->WorksheetColumn_Idn->lookupOptions()) ?>;
	fWorksheetTemplateslist.lists["x_ActiveFlag[]"] = <?php echo $WorksheetTemplates_list->ActiveFlag->Lookup->toClientList($WorksheetTemplates_list) ?>;
	fWorksheetTemplateslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($WorksheetTemplates_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fWorksheetTemplateslist");
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
<?php if (!$WorksheetTemplates_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($WorksheetTemplates_list->TotalRecords > 0 && $WorksheetTemplates_list->ExportOptions->visible()) { ?>
<?php $WorksheetTemplates_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($WorksheetTemplates_list->ImportOptions->visible()) { ?>
<?php $WorksheetTemplates_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$WorksheetTemplates_list->renderOtherOptions();
?>
<?php $WorksheetTemplates_list->showPageHeader(); ?>
<?php
$WorksheetTemplates_list->showMessage();
?>
<?php if ($WorksheetTemplates_list->TotalRecords > 0 || $WorksheetTemplates->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($WorksheetTemplates_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> WorksheetTemplates">
<?php if (!$WorksheetTemplates_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$WorksheetTemplates_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetTemplates_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetTemplates_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fWorksheetTemplateslist" id="fWorksheetTemplateslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorksheetTemplates">
<div id="gmp_WorksheetTemplates" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($WorksheetTemplates_list->TotalRecords > 0 || $WorksheetTemplates_list->isAdd() || $WorksheetTemplates_list->isCopy() || $WorksheetTemplates_list->isGridEdit()) { ?>
<table id="tbl_WorksheetTemplateslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$WorksheetTemplates->RowType = ROWTYPE_HEADER;

// Render list options
$WorksheetTemplates_list->renderListOptions();

// Render list options (header, left)
$WorksheetTemplates_list->ListOptions->render("header", "left");
?>
<?php if ($WorksheetTemplates_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($WorksheetTemplates_list->SortUrl($WorksheetTemplates_list->WorksheetMaster_Idn) == "") { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->headerCellClass() ?>"><div id="elh_WorksheetTemplates_WorksheetMaster_Idn" class="WorksheetTemplates_WorksheetMaster_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetMaster_Idn" class="<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetTemplates_list->SortUrl($WorksheetTemplates_list->WorksheetMaster_Idn) ?>', 1);"><div id="elh_WorksheetTemplates_WorksheetMaster_Idn" class="WorksheetTemplates_WorksheetMaster_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetTemplates_list->WorksheetMaster_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetTemplates_list->WorksheetMaster_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetTemplates_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
	<?php if ($WorksheetTemplates_list->SortUrl($WorksheetTemplates_list->WorksheetColumn_Idn) == "") { ?>
		<th data-name="WorksheetColumn_Idn" class="<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->headerCellClass() ?>"><div id="elh_WorksheetTemplates_WorksheetColumn_Idn" class="WorksheetTemplates_WorksheetColumn_Idn"><div class="ew-table-header-caption"><?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WorksheetColumn_Idn" class="<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetTemplates_list->SortUrl($WorksheetTemplates_list->WorksheetColumn_Idn) ?>', 1);"><div id="elh_WorksheetTemplates_WorksheetColumn_Idn" class="WorksheetTemplates_WorksheetColumn_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetTemplates_list->WorksheetColumn_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetTemplates_list->WorksheetColumn_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetTemplates_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($WorksheetTemplates_list->SortUrl($WorksheetTemplates_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $WorksheetTemplates_list->ActiveFlag->headerCellClass() ?>"><div id="elh_WorksheetTemplates_ActiveFlag" class="WorksheetTemplates_ActiveFlag"><div class="ew-table-header-caption"><?php echo $WorksheetTemplates_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $WorksheetTemplates_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $WorksheetTemplates_list->SortUrl($WorksheetTemplates_list->ActiveFlag) ?>', 1);"><div id="elh_WorksheetTemplates_ActiveFlag" class="WorksheetTemplates_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetTemplates_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetTemplates_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetTemplates_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$WorksheetTemplates_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($WorksheetTemplates_list->isAdd() || $WorksheetTemplates_list->isCopy()) {
		$WorksheetTemplates_list->RowIndex = 0;
		$WorksheetTemplates_list->KeyCount = $WorksheetTemplates_list->RowIndex;
		if ($WorksheetTemplates_list->isCopy() && !$WorksheetTemplates_list->loadRow())
			$WorksheetTemplates->CurrentAction = "add";
		if ($WorksheetTemplates_list->isAdd())
			$WorksheetTemplates_list->loadRowValues();
		if ($WorksheetTemplates->EventCancelled) // Insert failed
			$WorksheetTemplates_list->restoreFormValues(); // Restore form values

		// Set row properties
		$WorksheetTemplates->resetAttributes();
		$WorksheetTemplates->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_WorksheetTemplates", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetTemplates->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetTemplates_list->renderRow();

		// Render list options
		$WorksheetTemplates_list->renderListOptions();
		$WorksheetTemplates_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetTemplates->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetTemplates_list->ListOptions->render("body", "left", $WorksheetTemplates_list->RowCount);
?>
	<?php if ($WorksheetTemplates_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el<?php echo $WorksheetTemplates_list->RowCount ?>_WorksheetTemplates_WorksheetMaster_Idn" class="form-group WorksheetTemplates_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetTemplates" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetTemplates_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetTemplates_list, "p_x" . $WorksheetTemplates_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetTemplates" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetTemplates_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetTemplates_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td data-name="WorksheetColumn_Idn">
<span id="el<?php echo $WorksheetTemplates_list->RowCount ?>_WorksheetTemplates_WorksheetColumn_Idn" class="form-group WorksheetTemplates_WorksheetColumn_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetTemplates" data-field="x_WorksheetColumn_Idn" data-value-separator="<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn"<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->editAttributes() ?>>
			<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->selectOptionListHtml("x{$WorksheetTemplates_list->RowIndex}_WorksheetColumn_Idn") ?>
		</select>
</div>
<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->Lookup->getParamTag($WorksheetTemplates_list, "p_x" . $WorksheetTemplates_list->RowIndex . "_WorksheetColumn_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetTemplates" data-field="x_WorksheetColumn_Idn" name="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" id="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($WorksheetTemplates_list->WorksheetColumn_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetTemplates_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $WorksheetTemplates_list->RowCount ?>_WorksheetTemplates_ActiveFlag" class="form-group WorksheetTemplates_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetTemplates_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetTemplates" data-field="x_ActiveFlag" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]_208072" value="1"<?php echo $selwrk ?><?php echo $WorksheetTemplates_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]_208072"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetTemplates" data-field="x_ActiveFlag" name="o<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetTemplates_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetTemplates_list->ListOptions->render("body", "right", $WorksheetTemplates_list->RowCount);
?>
<script>
loadjs.ready(["fWorksheetTemplateslist", "load"], function() {
	fWorksheetTemplateslist.updateLists(<?php echo $WorksheetTemplates_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($WorksheetTemplates_list->ExportAll && $WorksheetTemplates_list->isExport()) {
	$WorksheetTemplates_list->StopRecord = $WorksheetTemplates_list->TotalRecords;
} else {

	// Set the last record to display
	if ($WorksheetTemplates_list->TotalRecords > $WorksheetTemplates_list->StartRecord + $WorksheetTemplates_list->DisplayRecords - 1)
		$WorksheetTemplates_list->StopRecord = $WorksheetTemplates_list->StartRecord + $WorksheetTemplates_list->DisplayRecords - 1;
	else
		$WorksheetTemplates_list->StopRecord = $WorksheetTemplates_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($WorksheetTemplates->isConfirm() || $WorksheetTemplates_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($WorksheetTemplates_list->FormKeyCountName) && ($WorksheetTemplates_list->isGridAdd() || $WorksheetTemplates_list->isGridEdit() || $WorksheetTemplates->isConfirm())) {
		$WorksheetTemplates_list->KeyCount = $CurrentForm->getValue($WorksheetTemplates_list->FormKeyCountName);
		$WorksheetTemplates_list->StopRecord = $WorksheetTemplates_list->StartRecord + $WorksheetTemplates_list->KeyCount - 1;
	}
}
$WorksheetTemplates_list->RecordCount = $WorksheetTemplates_list->StartRecord - 1;
if ($WorksheetTemplates_list->Recordset && !$WorksheetTemplates_list->Recordset->EOF) {
	$WorksheetTemplates_list->Recordset->moveFirst();
	$selectLimit = $WorksheetTemplates_list->UseSelectLimit;
	if (!$selectLimit && $WorksheetTemplates_list->StartRecord > 1)
		$WorksheetTemplates_list->Recordset->move($WorksheetTemplates_list->StartRecord - 1);
} elseif (!$WorksheetTemplates->AllowAddDeleteRow && $WorksheetTemplates_list->StopRecord == 0) {
	$WorksheetTemplates_list->StopRecord = $WorksheetTemplates->GridAddRowCount;
}

// Initialize aggregate
$WorksheetTemplates->RowType = ROWTYPE_AGGREGATEINIT;
$WorksheetTemplates->resetAttributes();
$WorksheetTemplates_list->renderRow();
$WorksheetTemplates_list->EditRowCount = 0;
if ($WorksheetTemplates_list->isEdit())
	$WorksheetTemplates_list->RowIndex = 1;
if ($WorksheetTemplates_list->isGridAdd())
	$WorksheetTemplates_list->RowIndex = 0;
if ($WorksheetTemplates_list->isGridEdit())
	$WorksheetTemplates_list->RowIndex = 0;
while ($WorksheetTemplates_list->RecordCount < $WorksheetTemplates_list->StopRecord) {
	$WorksheetTemplates_list->RecordCount++;
	if ($WorksheetTemplates_list->RecordCount >= $WorksheetTemplates_list->StartRecord) {
		$WorksheetTemplates_list->RowCount++;
		if ($WorksheetTemplates_list->isGridAdd() || $WorksheetTemplates_list->isGridEdit() || $WorksheetTemplates->isConfirm()) {
			$WorksheetTemplates_list->RowIndex++;
			$CurrentForm->Index = $WorksheetTemplates_list->RowIndex;
			if ($CurrentForm->hasValue($WorksheetTemplates_list->FormActionName) && ($WorksheetTemplates->isConfirm() || $WorksheetTemplates_list->EventCancelled))
				$WorksheetTemplates_list->RowAction = strval($CurrentForm->getValue($WorksheetTemplates_list->FormActionName));
			elseif ($WorksheetTemplates_list->isGridAdd())
				$WorksheetTemplates_list->RowAction = "insert";
			else
				$WorksheetTemplates_list->RowAction = "";
		}

		// Set up key count
		$WorksheetTemplates_list->KeyCount = $WorksheetTemplates_list->RowIndex;

		// Init row class and style
		$WorksheetTemplates->resetAttributes();
		$WorksheetTemplates->CssClass = "";
		if ($WorksheetTemplates_list->isGridAdd()) {
			$WorksheetTemplates_list->loadRowValues(); // Load default values
		} else {
			$WorksheetTemplates_list->loadRowValues($WorksheetTemplates_list->Recordset); // Load row values
		}
		$WorksheetTemplates->RowType = ROWTYPE_VIEW; // Render view
		if ($WorksheetTemplates_list->isGridAdd()) // Grid add
			$WorksheetTemplates->RowType = ROWTYPE_ADD; // Render add
		if ($WorksheetTemplates_list->isGridAdd() && $WorksheetTemplates->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$WorksheetTemplates_list->restoreCurrentRowFormValues($WorksheetTemplates_list->RowIndex); // Restore form values
		if ($WorksheetTemplates_list->isEdit()) {
			if ($WorksheetTemplates_list->checkInlineEditKey() && $WorksheetTemplates_list->EditRowCount == 0) { // Inline edit
				$WorksheetTemplates->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($WorksheetTemplates_list->isGridEdit()) { // Grid edit
			if ($WorksheetTemplates->EventCancelled)
				$WorksheetTemplates_list->restoreCurrentRowFormValues($WorksheetTemplates_list->RowIndex); // Restore form values
			if ($WorksheetTemplates_list->RowAction == "insert")
				$WorksheetTemplates->RowType = ROWTYPE_ADD; // Render add
			else
				$WorksheetTemplates->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($WorksheetTemplates_list->isEdit() && $WorksheetTemplates->RowType == ROWTYPE_EDIT && $WorksheetTemplates->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$WorksheetTemplates_list->restoreFormValues(); // Restore form values
		}
		if ($WorksheetTemplates_list->isGridEdit() && ($WorksheetTemplates->RowType == ROWTYPE_EDIT || $WorksheetTemplates->RowType == ROWTYPE_ADD) && $WorksheetTemplates->EventCancelled) // Update failed
			$WorksheetTemplates_list->restoreCurrentRowFormValues($WorksheetTemplates_list->RowIndex); // Restore form values
		if ($WorksheetTemplates->RowType == ROWTYPE_EDIT) // Edit row
			$WorksheetTemplates_list->EditRowCount++;

		// Set up row id / data-rowindex
		$WorksheetTemplates->RowAttrs->merge(["data-rowindex" => $WorksheetTemplates_list->RowCount, "id" => "r" . $WorksheetTemplates_list->RowCount . "_WorksheetTemplates", "data-rowtype" => $WorksheetTemplates->RowType]);

		// Render row
		$WorksheetTemplates_list->renderRow();

		// Render list options
		$WorksheetTemplates_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($WorksheetTemplates_list->RowAction != "delete" && $WorksheetTemplates_list->RowAction != "insertdelete" && !($WorksheetTemplates_list->RowAction == "insert" && $WorksheetTemplates->isConfirm() && $WorksheetTemplates_list->emptyRow())) {
?>
	<tr <?php echo $WorksheetTemplates->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetTemplates_list->ListOptions->render("body", "left", $WorksheetTemplates_list->RowCount);
?>
	<?php if ($WorksheetTemplates_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn" <?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->cellAttributes() ?>>
<?php if ($WorksheetTemplates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetTemplates_list->RowCount ?>_WorksheetTemplates_WorksheetMaster_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetTemplates" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetTemplates_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetTemplates_list, "p_x" . $WorksheetTemplates_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetTemplates" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetTemplates_list->WorksheetMaster_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetTemplates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetTemplates" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetTemplates_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetTemplates_list, "p_x" . $WorksheetTemplates_list->RowIndex . "_WorksheetMaster_Idn") ?>
<input type="hidden" data-table="WorksheetTemplates" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetTemplates_list->WorksheetMaster_Idn->OldValue != null ? $WorksheetTemplates_list->WorksheetMaster_Idn->OldValue : $WorksheetTemplates_list->WorksheetMaster_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetTemplates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetTemplates_list->RowCount ?>_WorksheetTemplates_WorksheetMaster_Idn">
<span<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetTemplates_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td data-name="WorksheetColumn_Idn" <?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->cellAttributes() ?>>
<?php if ($WorksheetTemplates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetTemplates_list->RowCount ?>_WorksheetTemplates_WorksheetColumn_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetTemplates" data-field="x_WorksheetColumn_Idn" data-value-separator="<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn"<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->editAttributes() ?>>
			<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->selectOptionListHtml("x{$WorksheetTemplates_list->RowIndex}_WorksheetColumn_Idn") ?>
		</select>
</div>
<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->Lookup->getParamTag($WorksheetTemplates_list, "p_x" . $WorksheetTemplates_list->RowIndex . "_WorksheetColumn_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetTemplates" data-field="x_WorksheetColumn_Idn" name="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" id="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($WorksheetTemplates_list->WorksheetColumn_Idn->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetTemplates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetTemplates" data-field="x_WorksheetColumn_Idn" data-value-separator="<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn"<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->editAttributes() ?>>
			<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->selectOptionListHtml("x{$WorksheetTemplates_list->RowIndex}_WorksheetColumn_Idn") ?>
		</select>
</div>
<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->Lookup->getParamTag($WorksheetTemplates_list, "p_x" . $WorksheetTemplates_list->RowIndex . "_WorksheetColumn_Idn") ?>
<input type="hidden" data-table="WorksheetTemplates" data-field="x_WorksheetColumn_Idn" name="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" id="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($WorksheetTemplates_list->WorksheetColumn_Idn->OldValue != null ? $WorksheetTemplates_list->WorksheetColumn_Idn->OldValue : $WorksheetTemplates_list->WorksheetColumn_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($WorksheetTemplates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetTemplates_list->RowCount ?>_WorksheetTemplates_WorksheetColumn_Idn">
<span<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->viewAttributes() ?>><?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($WorksheetTemplates_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $WorksheetTemplates_list->ActiveFlag->cellAttributes() ?>>
<?php if ($WorksheetTemplates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $WorksheetTemplates_list->RowCount ?>_WorksheetTemplates_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetTemplates_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetTemplates" data-field="x_ActiveFlag" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]_185819" value="1"<?php echo $selwrk ?><?php echo $WorksheetTemplates_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]_185819"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetTemplates" data-field="x_ActiveFlag" name="o<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetTemplates_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($WorksheetTemplates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $WorksheetTemplates_list->RowCount ?>_WorksheetTemplates_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($WorksheetTemplates_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetTemplates" data-field="x_ActiveFlag" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]_895235" value="1"<?php echo $selwrk ?><?php echo $WorksheetTemplates_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]_895235"></label>
</div>
</span>
<?php } ?>
<?php if ($WorksheetTemplates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $WorksheetTemplates_list->RowCount ?>_WorksheetTemplates_ActiveFlag">
<span<?php echo $WorksheetTemplates_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $WorksheetTemplates_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetTemplates_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetTemplates_list->ListOptions->render("body", "right", $WorksheetTemplates_list->RowCount);
?>
	</tr>
<?php if ($WorksheetTemplates->RowType == ROWTYPE_ADD || $WorksheetTemplates->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fWorksheetTemplateslist", "load"], function() {
	fWorksheetTemplateslist.updateLists(<?php echo $WorksheetTemplates_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$WorksheetTemplates_list->isGridAdd())
		if (!$WorksheetTemplates_list->Recordset->EOF)
			$WorksheetTemplates_list->Recordset->moveNext();
}
?>
<?php
	if ($WorksheetTemplates_list->isGridAdd() || $WorksheetTemplates_list->isGridEdit()) {
		$WorksheetTemplates_list->RowIndex = '$rowindex$';
		$WorksheetTemplates_list->loadRowValues();

		// Set row properties
		$WorksheetTemplates->resetAttributes();
		$WorksheetTemplates->RowAttrs->merge(["data-rowindex" => $WorksheetTemplates_list->RowIndex, "id" => "r0_WorksheetTemplates", "data-rowtype" => ROWTYPE_ADD]);
		$WorksheetTemplates->RowAttrs->appendClass("ew-template");
		$WorksheetTemplates->RowType = ROWTYPE_ADD;

		// Render row
		$WorksheetTemplates_list->renderRow();

		// Render list options
		$WorksheetTemplates_list->renderListOptions();
		$WorksheetTemplates_list->StartRowCount = 0;
?>
	<tr <?php echo $WorksheetTemplates->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetTemplates_list->ListOptions->render("body", "left", $WorksheetTemplates_list->RowIndex);
?>
	<?php if ($WorksheetTemplates_list->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<td data-name="WorksheetMaster_Idn">
<span id="el$rowindex$_WorksheetTemplates_WorksheetMaster_Idn" class="form-group WorksheetTemplates_WorksheetMaster_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetTemplates" data-field="x_WorksheetMaster_Idn" data-value-separator="<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn"<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->editAttributes() ?>>
			<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->selectOptionListHtml("x{$WorksheetTemplates_list->RowIndex}_WorksheetMaster_Idn") ?>
		</select>
</div>
<?php echo $WorksheetTemplates_list->WorksheetMaster_Idn->Lookup->getParamTag($WorksheetTemplates_list, "p_x" . $WorksheetTemplates_list->RowIndex . "_WorksheetMaster_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetTemplates" data-field="x_WorksheetMaster_Idn" name="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" id="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetMaster_Idn" value="<?php echo HtmlEncode($WorksheetTemplates_list->WorksheetMaster_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetTemplates_list->WorksheetColumn_Idn->Visible) { // WorksheetColumn_Idn ?>
		<td data-name="WorksheetColumn_Idn">
<span id="el$rowindex$_WorksheetTemplates_WorksheetColumn_Idn" class="form-group WorksheetTemplates_WorksheetColumn_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="WorksheetTemplates" data-field="x_WorksheetColumn_Idn" data-value-separator="<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn"<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->editAttributes() ?>>
			<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->selectOptionListHtml("x{$WorksheetTemplates_list->RowIndex}_WorksheetColumn_Idn") ?>
		</select>
</div>
<?php echo $WorksheetTemplates_list->WorksheetColumn_Idn->Lookup->getParamTag($WorksheetTemplates_list, "p_x" . $WorksheetTemplates_list->RowIndex . "_WorksheetColumn_Idn") ?>
</span>
<input type="hidden" data-table="WorksheetTemplates" data-field="x_WorksheetColumn_Idn" name="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" id="o<?php echo $WorksheetTemplates_list->RowIndex ?>_WorksheetColumn_Idn" value="<?php echo HtmlEncode($WorksheetTemplates_list->WorksheetColumn_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($WorksheetTemplates_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_WorksheetTemplates_ActiveFlag" class="form-group WorksheetTemplates_ActiveFlag">
<?php
$selwrk = ConvertToBool($WorksheetTemplates_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="WorksheetTemplates" data-field="x_ActiveFlag" name="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]_863853" value="1"<?php echo $selwrk ?><?php echo $WorksheetTemplates_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]_863853"></label>
</div>
</span>
<input type="hidden" data-table="WorksheetTemplates" data-field="x_ActiveFlag" name="o<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $WorksheetTemplates_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($WorksheetTemplates_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorksheetTemplates_list->ListOptions->render("body", "right", $WorksheetTemplates_list->RowIndex);
?>
<script>
loadjs.ready(["fWorksheetTemplateslist", "load"], function() {
	fWorksheetTemplateslist.updateLists(<?php echo $WorksheetTemplates_list->RowIndex ?>);
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
<?php if ($WorksheetTemplates_list->isAdd() || $WorksheetTemplates_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $WorksheetTemplates_list->FormKeyCountName ?>" id="<?php echo $WorksheetTemplates_list->FormKeyCountName ?>" value="<?php echo $WorksheetTemplates_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetTemplates_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $WorksheetTemplates_list->FormKeyCountName ?>" id="<?php echo $WorksheetTemplates_list->FormKeyCountName ?>" value="<?php echo $WorksheetTemplates_list->KeyCount ?>">
<?php echo $WorksheetTemplates_list->MultiSelectKey ?>
<?php } ?>
<?php if ($WorksheetTemplates_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $WorksheetTemplates_list->FormKeyCountName ?>" id="<?php echo $WorksheetTemplates_list->FormKeyCountName ?>" value="<?php echo $WorksheetTemplates_list->KeyCount ?>">
<?php } ?>
<?php if ($WorksheetTemplates_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $WorksheetTemplates_list->FormKeyCountName ?>" id="<?php echo $WorksheetTemplates_list->FormKeyCountName ?>" value="<?php echo $WorksheetTemplates_list->KeyCount ?>">
<?php echo $WorksheetTemplates_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$WorksheetTemplates->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($WorksheetTemplates_list->Recordset)
	$WorksheetTemplates_list->Recordset->Close();
?>
<?php if (!$WorksheetTemplates_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$WorksheetTemplates_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $WorksheetTemplates_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorksheetTemplates_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($WorksheetTemplates_list->TotalRecords == 0 && !$WorksheetTemplates->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $WorksheetTemplates_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$WorksheetTemplates_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$WorksheetTemplates_list->isExport()) { ?>
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
$WorksheetTemplates_list->terminate();
?>