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
$ShopFabricationMultipliers_list = new ShopFabricationMultipliers_list();

// Run the page
$ShopFabricationMultipliers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ShopFabricationMultipliers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ShopFabricationMultipliers_list->isExport()) { ?>
<script>
var fShopFabricationMultiplierslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fShopFabricationMultiplierslist = currentForm = new ew.Form("fShopFabricationMultiplierslist", "list");
	fShopFabricationMultiplierslist.formKeyCountName = '<?php echo $ShopFabricationMultipliers_list->FormKeyCountName ?>';

	// Validate form
	fShopFabricationMultiplierslist.validate = function() {
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
			<?php if ($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ShopFabricationMultiplier_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->caption(), $ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ShopFabricationMultipliers_list->PipeType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_PipeType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabricationMultipliers_list->PipeType_Idn->caption(), $ShopFabricationMultipliers_list->PipeType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ShopFabricationMultipliers_list->Multiplier->Required) { ?>
				elm = this.getElements("x" + infix + "_Multiplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabricationMultipliers_list->Multiplier->caption(), $ShopFabricationMultipliers_list->Multiplier->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Multiplier");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ShopFabricationMultipliers_list->Multiplier->errorMessage()) ?>");
			<?php if ($ShopFabricationMultipliers_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ShopFabricationMultipliers_list->ActiveFlag->caption(), $ShopFabricationMultipliers_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fShopFabricationMultiplierslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "PipeType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Multiplier", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fShopFabricationMultiplierslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fShopFabricationMultiplierslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fShopFabricationMultiplierslist.lists["x_PipeType_Idn"] = <?php echo $ShopFabricationMultipliers_list->PipeType_Idn->Lookup->toClientList($ShopFabricationMultipliers_list) ?>;
	fShopFabricationMultiplierslist.lists["x_PipeType_Idn"].options = <?php echo JsonEncode($ShopFabricationMultipliers_list->PipeType_Idn->lookupOptions()) ?>;
	fShopFabricationMultiplierslist.lists["x_ActiveFlag[]"] = <?php echo $ShopFabricationMultipliers_list->ActiveFlag->Lookup->toClientList($ShopFabricationMultipliers_list) ?>;
	fShopFabricationMultiplierslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($ShopFabricationMultipliers_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fShopFabricationMultiplierslist");
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
<?php if (!$ShopFabricationMultipliers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ShopFabricationMultipliers_list->TotalRecords > 0 && $ShopFabricationMultipliers_list->ExportOptions->visible()) { ?>
<?php $ShopFabricationMultipliers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ShopFabricationMultipliers_list->ImportOptions->visible()) { ?>
<?php $ShopFabricationMultipliers_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ShopFabricationMultipliers_list->renderOtherOptions();
?>
<?php $ShopFabricationMultipliers_list->showPageHeader(); ?>
<?php
$ShopFabricationMultipliers_list->showMessage();
?>
<?php if ($ShopFabricationMultipliers_list->TotalRecords > 0 || $ShopFabricationMultipliers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ShopFabricationMultipliers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ShopFabricationMultipliers">
<?php if (!$ShopFabricationMultipliers_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ShopFabricationMultipliers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ShopFabricationMultipliers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ShopFabricationMultipliers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fShopFabricationMultiplierslist" id="fShopFabricationMultiplierslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ShopFabricationMultipliers">
<div id="gmp_ShopFabricationMultipliers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ShopFabricationMultipliers_list->TotalRecords > 0 || $ShopFabricationMultipliers_list->isAdd() || $ShopFabricationMultipliers_list->isCopy() || $ShopFabricationMultipliers_list->isGridEdit()) { ?>
<table id="tbl_ShopFabricationMultiplierslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ShopFabricationMultipliers->RowType = ROWTYPE_HEADER;

// Render list options
$ShopFabricationMultipliers_list->renderListOptions();

// Render list options (header, left)
$ShopFabricationMultipliers_list->ListOptions->render("header", "left");
?>
<?php if ($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->Visible) { // ShopFabricationMultiplier_Idn ?>
	<?php if ($ShopFabricationMultipliers_list->SortUrl($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn) == "") { ?>
		<th data-name="ShopFabricationMultiplier_Idn" class="<?php echo $ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->headerCellClass() ?>"><div id="elh_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn" class="ShopFabricationMultipliers_ShopFabricationMultiplier_Idn"><div class="ew-table-header-caption"><?php echo $ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShopFabricationMultiplier_Idn" class="<?php echo $ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ShopFabricationMultipliers_list->SortUrl($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn) ?>', 1);"><div id="elh_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn" class="ShopFabricationMultipliers_ShopFabricationMultiplier_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ShopFabricationMultipliers_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
	<?php if ($ShopFabricationMultipliers_list->SortUrl($ShopFabricationMultipliers_list->PipeType_Idn) == "") { ?>
		<th data-name="PipeType_Idn" class="<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->headerCellClass() ?>"><div id="elh_ShopFabricationMultipliers_PipeType_Idn" class="ShopFabricationMultipliers_PipeType_Idn"><div class="ew-table-header-caption"><?php echo $ShopFabricationMultipliers_list->PipeType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PipeType_Idn" class="<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ShopFabricationMultipliers_list->SortUrl($ShopFabricationMultipliers_list->PipeType_Idn) ?>', 1);"><div id="elh_ShopFabricationMultipliers_PipeType_Idn" class="ShopFabricationMultipliers_PipeType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ShopFabricationMultipliers_list->PipeType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($ShopFabricationMultipliers_list->PipeType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ShopFabricationMultipliers_list->PipeType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ShopFabricationMultipliers_list->Multiplier->Visible) { // Multiplier ?>
	<?php if ($ShopFabricationMultipliers_list->SortUrl($ShopFabricationMultipliers_list->Multiplier) == "") { ?>
		<th data-name="Multiplier" class="<?php echo $ShopFabricationMultipliers_list->Multiplier->headerCellClass() ?>"><div id="elh_ShopFabricationMultipliers_Multiplier" class="ShopFabricationMultipliers_Multiplier"><div class="ew-table-header-caption"><?php echo $ShopFabricationMultipliers_list->Multiplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Multiplier" class="<?php echo $ShopFabricationMultipliers_list->Multiplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ShopFabricationMultipliers_list->SortUrl($ShopFabricationMultipliers_list->Multiplier) ?>', 1);"><div id="elh_ShopFabricationMultipliers_Multiplier" class="ShopFabricationMultipliers_Multiplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ShopFabricationMultipliers_list->Multiplier->caption() ?></span><span class="ew-table-header-sort"><?php if ($ShopFabricationMultipliers_list->Multiplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ShopFabricationMultipliers_list->Multiplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ShopFabricationMultipliers_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($ShopFabricationMultipliers_list->SortUrl($ShopFabricationMultipliers_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $ShopFabricationMultipliers_list->ActiveFlag->headerCellClass() ?>"><div id="elh_ShopFabricationMultipliers_ActiveFlag" class="ShopFabricationMultipliers_ActiveFlag"><div class="ew-table-header-caption"><?php echo $ShopFabricationMultipliers_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $ShopFabricationMultipliers_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ShopFabricationMultipliers_list->SortUrl($ShopFabricationMultipliers_list->ActiveFlag) ?>', 1);"><div id="elh_ShopFabricationMultipliers_ActiveFlag" class="ShopFabricationMultipliers_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ShopFabricationMultipliers_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($ShopFabricationMultipliers_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ShopFabricationMultipliers_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ShopFabricationMultipliers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($ShopFabricationMultipliers_list->isAdd() || $ShopFabricationMultipliers_list->isCopy()) {
		$ShopFabricationMultipliers_list->RowIndex = 0;
		$ShopFabricationMultipliers_list->KeyCount = $ShopFabricationMultipliers_list->RowIndex;
		if ($ShopFabricationMultipliers_list->isCopy() && !$ShopFabricationMultipliers_list->loadRow())
			$ShopFabricationMultipliers->CurrentAction = "add";
		if ($ShopFabricationMultipliers_list->isAdd())
			$ShopFabricationMultipliers_list->loadRowValues();
		if ($ShopFabricationMultipliers->EventCancelled) // Insert failed
			$ShopFabricationMultipliers_list->restoreFormValues(); // Restore form values

		// Set row properties
		$ShopFabricationMultipliers->resetAttributes();
		$ShopFabricationMultipliers->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_ShopFabricationMultipliers", "data-rowtype" => ROWTYPE_ADD]);
		$ShopFabricationMultipliers->RowType = ROWTYPE_ADD;

		// Render row
		$ShopFabricationMultipliers_list->renderRow();

		// Render list options
		$ShopFabricationMultipliers_list->renderListOptions();
		$ShopFabricationMultipliers_list->StartRowCount = 0;
?>
	<tr <?php echo $ShopFabricationMultipliers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ShopFabricationMultipliers_list->ListOptions->render("body", "left", $ShopFabricationMultipliers_list->RowCount);
?>
	<?php if ($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->Visible) { // ShopFabricationMultiplier_Idn ?>
		<td data-name="ShopFabricationMultiplier_Idn">
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn" class="form-group ShopFabricationMultipliers_ShopFabricationMultiplier_Idn"></span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_ShopFabricationMultiplier_Idn" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ShopFabricationMultiplier_Idn" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ShopFabricationMultiplier_Idn" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabricationMultipliers_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td data-name="PipeType_Idn">
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_PipeType_Idn" class="form-group ShopFabricationMultipliers_PipeType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ShopFabricationMultipliers" data-field="x_PipeType_Idn" data-value-separator="<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn"<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->editAttributes() ?>>
			<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->selectOptionListHtml("x{$ShopFabricationMultipliers_list->RowIndex}_PipeType_Idn") ?>
		</select>
</div>
<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->Lookup->getParamTag($ShopFabricationMultipliers_list, "p_x" . $ShopFabricationMultipliers_list->RowIndex . "_PipeType_Idn") ?>
</span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_PipeType_Idn" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->PipeType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabricationMultipliers_list->Multiplier->Visible) { // Multiplier ?>
		<td data-name="Multiplier">
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_Multiplier" class="form-group ShopFabricationMultipliers_Multiplier">
<input type="text" data-table="ShopFabricationMultipliers" data-field="x_Multiplier" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ShopFabricationMultipliers_list->Multiplier->getPlaceHolder()) ?>" value="<?php echo $ShopFabricationMultipliers_list->Multiplier->EditValue ?>"<?php echo $ShopFabricationMultipliers_list->Multiplier->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_Multiplier" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->Multiplier->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabricationMultipliers_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_ActiveFlag" class="form-group ShopFabricationMultipliers_ActiveFlag">
<?php
$selwrk = ConvertToBool($ShopFabricationMultipliers_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ShopFabricationMultipliers" data-field="x_ActiveFlag" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]_104999" value="1"<?php echo $selwrk ?><?php echo $ShopFabricationMultipliers_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]_104999"></label>
</div>
</span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_ActiveFlag" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ShopFabricationMultipliers_list->ListOptions->render("body", "right", $ShopFabricationMultipliers_list->RowCount);
?>
<script>
loadjs.ready(["fShopFabricationMultiplierslist", "load"], function() {
	fShopFabricationMultiplierslist.updateLists(<?php echo $ShopFabricationMultipliers_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($ShopFabricationMultipliers_list->ExportAll && $ShopFabricationMultipliers_list->isExport()) {
	$ShopFabricationMultipliers_list->StopRecord = $ShopFabricationMultipliers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ShopFabricationMultipliers_list->TotalRecords > $ShopFabricationMultipliers_list->StartRecord + $ShopFabricationMultipliers_list->DisplayRecords - 1)
		$ShopFabricationMultipliers_list->StopRecord = $ShopFabricationMultipliers_list->StartRecord + $ShopFabricationMultipliers_list->DisplayRecords - 1;
	else
		$ShopFabricationMultipliers_list->StopRecord = $ShopFabricationMultipliers_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($ShopFabricationMultipliers->isConfirm() || $ShopFabricationMultipliers_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ShopFabricationMultipliers_list->FormKeyCountName) && ($ShopFabricationMultipliers_list->isGridAdd() || $ShopFabricationMultipliers_list->isGridEdit() || $ShopFabricationMultipliers->isConfirm())) {
		$ShopFabricationMultipliers_list->KeyCount = $CurrentForm->getValue($ShopFabricationMultipliers_list->FormKeyCountName);
		$ShopFabricationMultipliers_list->StopRecord = $ShopFabricationMultipliers_list->StartRecord + $ShopFabricationMultipliers_list->KeyCount - 1;
	}
}
$ShopFabricationMultipliers_list->RecordCount = $ShopFabricationMultipliers_list->StartRecord - 1;
if ($ShopFabricationMultipliers_list->Recordset && !$ShopFabricationMultipliers_list->Recordset->EOF) {
	$ShopFabricationMultipliers_list->Recordset->moveFirst();
	$selectLimit = $ShopFabricationMultipliers_list->UseSelectLimit;
	if (!$selectLimit && $ShopFabricationMultipliers_list->StartRecord > 1)
		$ShopFabricationMultipliers_list->Recordset->move($ShopFabricationMultipliers_list->StartRecord - 1);
} elseif (!$ShopFabricationMultipliers->AllowAddDeleteRow && $ShopFabricationMultipliers_list->StopRecord == 0) {
	$ShopFabricationMultipliers_list->StopRecord = $ShopFabricationMultipliers->GridAddRowCount;
}

// Initialize aggregate
$ShopFabricationMultipliers->RowType = ROWTYPE_AGGREGATEINIT;
$ShopFabricationMultipliers->resetAttributes();
$ShopFabricationMultipliers_list->renderRow();
$ShopFabricationMultipliers_list->EditRowCount = 0;
if ($ShopFabricationMultipliers_list->isEdit())
	$ShopFabricationMultipliers_list->RowIndex = 1;
if ($ShopFabricationMultipliers_list->isGridAdd())
	$ShopFabricationMultipliers_list->RowIndex = 0;
if ($ShopFabricationMultipliers_list->isGridEdit())
	$ShopFabricationMultipliers_list->RowIndex = 0;
while ($ShopFabricationMultipliers_list->RecordCount < $ShopFabricationMultipliers_list->StopRecord) {
	$ShopFabricationMultipliers_list->RecordCount++;
	if ($ShopFabricationMultipliers_list->RecordCount >= $ShopFabricationMultipliers_list->StartRecord) {
		$ShopFabricationMultipliers_list->RowCount++;
		if ($ShopFabricationMultipliers_list->isGridAdd() || $ShopFabricationMultipliers_list->isGridEdit() || $ShopFabricationMultipliers->isConfirm()) {
			$ShopFabricationMultipliers_list->RowIndex++;
			$CurrentForm->Index = $ShopFabricationMultipliers_list->RowIndex;
			if ($CurrentForm->hasValue($ShopFabricationMultipliers_list->FormActionName) && ($ShopFabricationMultipliers->isConfirm() || $ShopFabricationMultipliers_list->EventCancelled))
				$ShopFabricationMultipliers_list->RowAction = strval($CurrentForm->getValue($ShopFabricationMultipliers_list->FormActionName));
			elseif ($ShopFabricationMultipliers_list->isGridAdd())
				$ShopFabricationMultipliers_list->RowAction = "insert";
			else
				$ShopFabricationMultipliers_list->RowAction = "";
		}

		// Set up key count
		$ShopFabricationMultipliers_list->KeyCount = $ShopFabricationMultipliers_list->RowIndex;

		// Init row class and style
		$ShopFabricationMultipliers->resetAttributes();
		$ShopFabricationMultipliers->CssClass = "";
		if ($ShopFabricationMultipliers_list->isGridAdd()) {
			$ShopFabricationMultipliers_list->loadRowValues(); // Load default values
		} else {
			$ShopFabricationMultipliers_list->loadRowValues($ShopFabricationMultipliers_list->Recordset); // Load row values
		}
		$ShopFabricationMultipliers->RowType = ROWTYPE_VIEW; // Render view
		if ($ShopFabricationMultipliers_list->isGridAdd()) // Grid add
			$ShopFabricationMultipliers->RowType = ROWTYPE_ADD; // Render add
		if ($ShopFabricationMultipliers_list->isGridAdd() && $ShopFabricationMultipliers->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ShopFabricationMultipliers_list->restoreCurrentRowFormValues($ShopFabricationMultipliers_list->RowIndex); // Restore form values
		if ($ShopFabricationMultipliers_list->isEdit()) {
			if ($ShopFabricationMultipliers_list->checkInlineEditKey() && $ShopFabricationMultipliers_list->EditRowCount == 0) { // Inline edit
				$ShopFabricationMultipliers->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($ShopFabricationMultipliers_list->isGridEdit()) { // Grid edit
			if ($ShopFabricationMultipliers->EventCancelled)
				$ShopFabricationMultipliers_list->restoreCurrentRowFormValues($ShopFabricationMultipliers_list->RowIndex); // Restore form values
			if ($ShopFabricationMultipliers_list->RowAction == "insert")
				$ShopFabricationMultipliers->RowType = ROWTYPE_ADD; // Render add
			else
				$ShopFabricationMultipliers->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ShopFabricationMultipliers_list->isEdit() && $ShopFabricationMultipliers->RowType == ROWTYPE_EDIT && $ShopFabricationMultipliers->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$ShopFabricationMultipliers_list->restoreFormValues(); // Restore form values
		}
		if ($ShopFabricationMultipliers_list->isGridEdit() && ($ShopFabricationMultipliers->RowType == ROWTYPE_EDIT || $ShopFabricationMultipliers->RowType == ROWTYPE_ADD) && $ShopFabricationMultipliers->EventCancelled) // Update failed
			$ShopFabricationMultipliers_list->restoreCurrentRowFormValues($ShopFabricationMultipliers_list->RowIndex); // Restore form values
		if ($ShopFabricationMultipliers->RowType == ROWTYPE_EDIT) // Edit row
			$ShopFabricationMultipliers_list->EditRowCount++;

		// Set up row id / data-rowindex
		$ShopFabricationMultipliers->RowAttrs->merge(["data-rowindex" => $ShopFabricationMultipliers_list->RowCount, "id" => "r" . $ShopFabricationMultipliers_list->RowCount . "_ShopFabricationMultipliers", "data-rowtype" => $ShopFabricationMultipliers->RowType]);

		// Render row
		$ShopFabricationMultipliers_list->renderRow();

		// Render list options
		$ShopFabricationMultipliers_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ShopFabricationMultipliers_list->RowAction != "delete" && $ShopFabricationMultipliers_list->RowAction != "insertdelete" && !($ShopFabricationMultipliers_list->RowAction == "insert" && $ShopFabricationMultipliers->isConfirm() && $ShopFabricationMultipliers_list->emptyRow())) {
?>
	<tr <?php echo $ShopFabricationMultipliers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ShopFabricationMultipliers_list->ListOptions->render("body", "left", $ShopFabricationMultipliers_list->RowCount);
?>
	<?php if ($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->Visible) { // ShopFabricationMultiplier_Idn ?>
		<td data-name="ShopFabricationMultiplier_Idn" <?php echo $ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->cellAttributes() ?>>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn" class="form-group"></span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_ShopFabricationMultiplier_Idn" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ShopFabricationMultiplier_Idn" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ShopFabricationMultiplier_Idn" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->OldValue) ?>">
<?php } ?>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn" class="form-group">
<span<?php echo $ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_ShopFabricationMultiplier_Idn" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ShopFabricationMultiplier_Idn" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ShopFabricationMultiplier_Idn" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn">
<span<?php echo $ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->viewAttributes() ?>><?php echo $ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ShopFabricationMultipliers_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td data-name="PipeType_Idn" <?php echo $ShopFabricationMultipliers_list->PipeType_Idn->cellAttributes() ?>>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_PipeType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ShopFabricationMultipliers" data-field="x_PipeType_Idn" data-value-separator="<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn"<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->editAttributes() ?>>
			<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->selectOptionListHtml("x{$ShopFabricationMultipliers_list->RowIndex}_PipeType_Idn") ?>
		</select>
</div>
<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->Lookup->getParamTag($ShopFabricationMultipliers_list, "p_x" . $ShopFabricationMultipliers_list->RowIndex . "_PipeType_Idn") ?>
</span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_PipeType_Idn" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->PipeType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_PipeType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ShopFabricationMultipliers" data-field="x_PipeType_Idn" data-value-separator="<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn"<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->editAttributes() ?>>
			<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->selectOptionListHtml("x{$ShopFabricationMultipliers_list->RowIndex}_PipeType_Idn") ?>
		</select>
</div>
<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->Lookup->getParamTag($ShopFabricationMultipliers_list, "p_x" . $ShopFabricationMultipliers_list->RowIndex . "_PipeType_Idn") ?>
</span>
<?php } ?>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_PipeType_Idn">
<span<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->viewAttributes() ?>><?php echo $ShopFabricationMultipliers_list->PipeType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ShopFabricationMultipliers_list->Multiplier->Visible) { // Multiplier ?>
		<td data-name="Multiplier" <?php echo $ShopFabricationMultipliers_list->Multiplier->cellAttributes() ?>>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_Multiplier" class="form-group">
<input type="text" data-table="ShopFabricationMultipliers" data-field="x_Multiplier" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ShopFabricationMultipliers_list->Multiplier->getPlaceHolder()) ?>" value="<?php echo $ShopFabricationMultipliers_list->Multiplier->EditValue ?>"<?php echo $ShopFabricationMultipliers_list->Multiplier->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_Multiplier" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->Multiplier->OldValue) ?>">
<?php } ?>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_Multiplier" class="form-group">
<input type="text" data-table="ShopFabricationMultipliers" data-field="x_Multiplier" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ShopFabricationMultipliers_list->Multiplier->getPlaceHolder()) ?>" value="<?php echo $ShopFabricationMultipliers_list->Multiplier->EditValue ?>"<?php echo $ShopFabricationMultipliers_list->Multiplier->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_Multiplier">
<span<?php echo $ShopFabricationMultipliers_list->Multiplier->viewAttributes() ?>><?php echo $ShopFabricationMultipliers_list->Multiplier->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ShopFabricationMultipliers_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $ShopFabricationMultipliers_list->ActiveFlag->cellAttributes() ?>>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ShopFabricationMultipliers_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ShopFabricationMultipliers" data-field="x_ActiveFlag" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]_242057" value="1"<?php echo $selwrk ?><?php echo $ShopFabricationMultipliers_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]_242057"></label>
</div>
</span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_ActiveFlag" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($ShopFabricationMultipliers_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ShopFabricationMultipliers" data-field="x_ActiveFlag" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]_679296" value="1"<?php echo $selwrk ?><?php echo $ShopFabricationMultipliers_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]_679296"></label>
</div>
</span>
<?php } ?>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ShopFabricationMultipliers_list->RowCount ?>_ShopFabricationMultipliers_ActiveFlag">
<span<?php echo $ShopFabricationMultipliers_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $ShopFabricationMultipliers_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($ShopFabricationMultipliers_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ShopFabricationMultipliers_list->ListOptions->render("body", "right", $ShopFabricationMultipliers_list->RowCount);
?>
	</tr>
<?php if ($ShopFabricationMultipliers->RowType == ROWTYPE_ADD || $ShopFabricationMultipliers->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fShopFabricationMultiplierslist", "load"], function() {
	fShopFabricationMultiplierslist.updateLists(<?php echo $ShopFabricationMultipliers_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ShopFabricationMultipliers_list->isGridAdd())
		if (!$ShopFabricationMultipliers_list->Recordset->EOF)
			$ShopFabricationMultipliers_list->Recordset->moveNext();
}
?>
<?php
	if ($ShopFabricationMultipliers_list->isGridAdd() || $ShopFabricationMultipliers_list->isGridEdit()) {
		$ShopFabricationMultipliers_list->RowIndex = '$rowindex$';
		$ShopFabricationMultipliers_list->loadRowValues();

		// Set row properties
		$ShopFabricationMultipliers->resetAttributes();
		$ShopFabricationMultipliers->RowAttrs->merge(["data-rowindex" => $ShopFabricationMultipliers_list->RowIndex, "id" => "r0_ShopFabricationMultipliers", "data-rowtype" => ROWTYPE_ADD]);
		$ShopFabricationMultipliers->RowAttrs->appendClass("ew-template");
		$ShopFabricationMultipliers->RowType = ROWTYPE_ADD;

		// Render row
		$ShopFabricationMultipliers_list->renderRow();

		// Render list options
		$ShopFabricationMultipliers_list->renderListOptions();
		$ShopFabricationMultipliers_list->StartRowCount = 0;
?>
	<tr <?php echo $ShopFabricationMultipliers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ShopFabricationMultipliers_list->ListOptions->render("body", "left", $ShopFabricationMultipliers_list->RowIndex);
?>
	<?php if ($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->Visible) { // ShopFabricationMultiplier_Idn ?>
		<td data-name="ShopFabricationMultiplier_Idn">
<span id="el$rowindex$_ShopFabricationMultipliers_ShopFabricationMultiplier_Idn" class="form-group ShopFabricationMultipliers_ShopFabricationMultiplier_Idn"></span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_ShopFabricationMultiplier_Idn" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ShopFabricationMultiplier_Idn" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ShopFabricationMultiplier_Idn" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->ShopFabricationMultiplier_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabricationMultipliers_list->PipeType_Idn->Visible) { // PipeType_Idn ?>
		<td data-name="PipeType_Idn">
<span id="el$rowindex$_ShopFabricationMultipliers_PipeType_Idn" class="form-group ShopFabricationMultipliers_PipeType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ShopFabricationMultipliers" data-field="x_PipeType_Idn" data-value-separator="<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn"<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->editAttributes() ?>>
			<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->selectOptionListHtml("x{$ShopFabricationMultipliers_list->RowIndex}_PipeType_Idn") ?>
		</select>
</div>
<?php echo $ShopFabricationMultipliers_list->PipeType_Idn->Lookup->getParamTag($ShopFabricationMultipliers_list, "p_x" . $ShopFabricationMultipliers_list->RowIndex . "_PipeType_Idn") ?>
</span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_PipeType_Idn" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_PipeType_Idn" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->PipeType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabricationMultipliers_list->Multiplier->Visible) { // Multiplier ?>
		<td data-name="Multiplier">
<span id="el$rowindex$_ShopFabricationMultipliers_Multiplier" class="form-group ShopFabricationMultipliers_Multiplier">
<input type="text" data-table="ShopFabricationMultipliers" data-field="x_Multiplier" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ShopFabricationMultipliers_list->Multiplier->getPlaceHolder()) ?>" value="<?php echo $ShopFabricationMultipliers_list->Multiplier->EditValue ?>"<?php echo $ShopFabricationMultipliers_list->Multiplier->editAttributes() ?>>
</span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_Multiplier" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_Multiplier" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->Multiplier->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ShopFabricationMultipliers_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_ShopFabricationMultipliers_ActiveFlag" class="form-group ShopFabricationMultipliers_ActiveFlag">
<?php
$selwrk = ConvertToBool($ShopFabricationMultipliers_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ShopFabricationMultipliers" data-field="x_ActiveFlag" name="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]_671315" value="1"<?php echo $selwrk ?><?php echo $ShopFabricationMultipliers_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]_671315"></label>
</div>
</span>
<input type="hidden" data-table="ShopFabricationMultipliers" data-field="x_ActiveFlag" name="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $ShopFabricationMultipliers_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($ShopFabricationMultipliers_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ShopFabricationMultipliers_list->ListOptions->render("body", "right", $ShopFabricationMultipliers_list->RowIndex);
?>
<script>
loadjs.ready(["fShopFabricationMultiplierslist", "load"], function() {
	fShopFabricationMultiplierslist.updateLists(<?php echo $ShopFabricationMultipliers_list->RowIndex ?>);
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
<?php if ($ShopFabricationMultipliers_list->isAdd() || $ShopFabricationMultipliers_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $ShopFabricationMultipliers_list->FormKeyCountName ?>" id="<?php echo $ShopFabricationMultipliers_list->FormKeyCountName ?>" value="<?php echo $ShopFabricationMultipliers_list->KeyCount ?>">
<?php } ?>
<?php if ($ShopFabricationMultipliers_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $ShopFabricationMultipliers_list->FormKeyCountName ?>" id="<?php echo $ShopFabricationMultipliers_list->FormKeyCountName ?>" value="<?php echo $ShopFabricationMultipliers_list->KeyCount ?>">
<?php echo $ShopFabricationMultipliers_list->MultiSelectKey ?>
<?php } ?>
<?php if ($ShopFabricationMultipliers_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $ShopFabricationMultipliers_list->FormKeyCountName ?>" id="<?php echo $ShopFabricationMultipliers_list->FormKeyCountName ?>" value="<?php echo $ShopFabricationMultipliers_list->KeyCount ?>">
<?php } ?>
<?php if ($ShopFabricationMultipliers_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $ShopFabricationMultipliers_list->FormKeyCountName ?>" id="<?php echo $ShopFabricationMultipliers_list->FormKeyCountName ?>" value="<?php echo $ShopFabricationMultipliers_list->KeyCount ?>">
<?php echo $ShopFabricationMultipliers_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$ShopFabricationMultipliers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ShopFabricationMultipliers_list->Recordset)
	$ShopFabricationMultipliers_list->Recordset->Close();
?>
<?php if (!$ShopFabricationMultipliers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ShopFabricationMultipliers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ShopFabricationMultipliers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ShopFabricationMultipliers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ShopFabricationMultipliers_list->TotalRecords == 0 && !$ShopFabricationMultipliers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ShopFabricationMultipliers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ShopFabricationMultipliers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ShopFabricationMultipliers_list->isExport()) { ?>
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
$ShopFabricationMultipliers_list->terminate();
?>