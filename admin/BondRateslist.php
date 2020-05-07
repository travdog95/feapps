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
$BondRates_list = new BondRates_list();

// Run the page
$BondRates_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$BondRates_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$BondRates_list->isExport()) { ?>
<script>
var fBondRateslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fBondRateslist = currentForm = new ew.Form("fBondRateslist", "list");
	fBondRateslist.formKeyCountName = '<?php echo $BondRates_list->FormKeyCountName ?>';

	// Validate form
	fBondRateslist.validate = function() {
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
			<?php if ($BondRates_list->BondRate_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_BondRate_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_list->BondRate_Idn->caption(), $BondRates_list->BondRate_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($BondRates_list->StartValue->Required) { ?>
				elm = this.getElements("x" + infix + "_StartValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_list->StartValue->caption(), $BondRates_list->StartValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_list->StartValue->errorMessage()) ?>");
			<?php if ($BondRates_list->EndValue->Required) { ?>
				elm = this.getElements("x" + infix + "_EndValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_list->EndValue->caption(), $BondRates_list->EndValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_list->EndValue->errorMessage()) ?>");
			<?php if ($BondRates_list->Minimum->Required) { ?>
				elm = this.getElements("x" + infix + "_Minimum");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_list->Minimum->caption(), $BondRates_list->Minimum->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Minimum");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_list->Minimum->errorMessage()) ?>");
			<?php if ($BondRates_list->Rate->Required) { ?>
				elm = this.getElements("x" + infix + "_Rate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_list->Rate->caption(), $BondRates_list->Rate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_list->Rate->errorMessage()) ?>");
			<?php if ($BondRates_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_list->Rank->caption(), $BondRates_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($BondRates_list->Rank->errorMessage()) ?>");
			<?php if ($BondRates_list->IsSubcontract->Required) { ?>
				elm = this.getElements("x" + infix + "_IsSubcontract[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_list->IsSubcontract->caption(), $BondRates_list->IsSubcontract->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($BondRates_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $BondRates_list->ActiveFlag->caption(), $BondRates_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fBondRateslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "StartValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "EndValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "Minimum", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "IsSubcontract[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fBondRateslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fBondRateslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fBondRateslist.lists["x_IsSubcontract[]"] = <?php echo $BondRates_list->IsSubcontract->Lookup->toClientList($BondRates_list) ?>;
	fBondRateslist.lists["x_IsSubcontract[]"].options = <?php echo JsonEncode($BondRates_list->IsSubcontract->options(FALSE, TRUE)) ?>;
	fBondRateslist.lists["x_ActiveFlag[]"] = <?php echo $BondRates_list->ActiveFlag->Lookup->toClientList($BondRates_list) ?>;
	fBondRateslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($BondRates_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fBondRateslist");
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
<?php if (!$BondRates_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($BondRates_list->TotalRecords > 0 && $BondRates_list->ExportOptions->visible()) { ?>
<?php $BondRates_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($BondRates_list->ImportOptions->visible()) { ?>
<?php $BondRates_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$BondRates_list->renderOtherOptions();
?>
<?php $BondRates_list->showPageHeader(); ?>
<?php
$BondRates_list->showMessage();
?>
<?php if ($BondRates_list->TotalRecords > 0 || $BondRates->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($BondRates_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> BondRates">
<?php if (!$BondRates_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$BondRates_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $BondRates_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $BondRates_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fBondRateslist" id="fBondRateslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="BondRates">
<div id="gmp_BondRates" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($BondRates_list->TotalRecords > 0 || $BondRates_list->isAdd() || $BondRates_list->isCopy() || $BondRates_list->isGridEdit()) { ?>
<table id="tbl_BondRateslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$BondRates->RowType = ROWTYPE_HEADER;

// Render list options
$BondRates_list->renderListOptions();

// Render list options (header, left)
$BondRates_list->ListOptions->render("header", "left");
?>
<?php if ($BondRates_list->BondRate_Idn->Visible) { // BondRate_Idn ?>
	<?php if ($BondRates_list->SortUrl($BondRates_list->BondRate_Idn) == "") { ?>
		<th data-name="BondRate_Idn" class="<?php echo $BondRates_list->BondRate_Idn->headerCellClass() ?>"><div id="elh_BondRates_BondRate_Idn" class="BondRates_BondRate_Idn"><div class="ew-table-header-caption"><?php echo $BondRates_list->BondRate_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BondRate_Idn" class="<?php echo $BondRates_list->BondRate_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BondRates_list->SortUrl($BondRates_list->BondRate_Idn) ?>', 1);"><div id="elh_BondRates_BondRate_Idn" class="BondRates_BondRate_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BondRates_list->BondRate_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($BondRates_list->BondRate_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BondRates_list->BondRate_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BondRates_list->StartValue->Visible) { // StartValue ?>
	<?php if ($BondRates_list->SortUrl($BondRates_list->StartValue) == "") { ?>
		<th data-name="StartValue" class="<?php echo $BondRates_list->StartValue->headerCellClass() ?>"><div id="elh_BondRates_StartValue" class="BondRates_StartValue"><div class="ew-table-header-caption"><?php echo $BondRates_list->StartValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartValue" class="<?php echo $BondRates_list->StartValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BondRates_list->SortUrl($BondRates_list->StartValue) ?>', 1);"><div id="elh_BondRates_StartValue" class="BondRates_StartValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BondRates_list->StartValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($BondRates_list->StartValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BondRates_list->StartValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BondRates_list->EndValue->Visible) { // EndValue ?>
	<?php if ($BondRates_list->SortUrl($BondRates_list->EndValue) == "") { ?>
		<th data-name="EndValue" class="<?php echo $BondRates_list->EndValue->headerCellClass() ?>"><div id="elh_BondRates_EndValue" class="BondRates_EndValue"><div class="ew-table-header-caption"><?php echo $BondRates_list->EndValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndValue" class="<?php echo $BondRates_list->EndValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BondRates_list->SortUrl($BondRates_list->EndValue) ?>', 1);"><div id="elh_BondRates_EndValue" class="BondRates_EndValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BondRates_list->EndValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($BondRates_list->EndValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BondRates_list->EndValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BondRates_list->Minimum->Visible) { // Minimum ?>
	<?php if ($BondRates_list->SortUrl($BondRates_list->Minimum) == "") { ?>
		<th data-name="Minimum" class="<?php echo $BondRates_list->Minimum->headerCellClass() ?>"><div id="elh_BondRates_Minimum" class="BondRates_Minimum"><div class="ew-table-header-caption"><?php echo $BondRates_list->Minimum->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Minimum" class="<?php echo $BondRates_list->Minimum->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BondRates_list->SortUrl($BondRates_list->Minimum) ?>', 1);"><div id="elh_BondRates_Minimum" class="BondRates_Minimum">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BondRates_list->Minimum->caption() ?></span><span class="ew-table-header-sort"><?php if ($BondRates_list->Minimum->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BondRates_list->Minimum->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BondRates_list->Rate->Visible) { // Rate ?>
	<?php if ($BondRates_list->SortUrl($BondRates_list->Rate) == "") { ?>
		<th data-name="Rate" class="<?php echo $BondRates_list->Rate->headerCellClass() ?>"><div id="elh_BondRates_Rate" class="BondRates_Rate"><div class="ew-table-header-caption"><?php echo $BondRates_list->Rate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rate" class="<?php echo $BondRates_list->Rate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BondRates_list->SortUrl($BondRates_list->Rate) ?>', 1);"><div id="elh_BondRates_Rate" class="BondRates_Rate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BondRates_list->Rate->caption() ?></span><span class="ew-table-header-sort"><?php if ($BondRates_list->Rate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BondRates_list->Rate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BondRates_list->Rank->Visible) { // Rank ?>
	<?php if ($BondRates_list->SortUrl($BondRates_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $BondRates_list->Rank->headerCellClass() ?>"><div id="elh_BondRates_Rank" class="BondRates_Rank"><div class="ew-table-header-caption"><?php echo $BondRates_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $BondRates_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BondRates_list->SortUrl($BondRates_list->Rank) ?>', 1);"><div id="elh_BondRates_Rank" class="BondRates_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BondRates_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($BondRates_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BondRates_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BondRates_list->IsSubcontract->Visible) { // IsSubcontract ?>
	<?php if ($BondRates_list->SortUrl($BondRates_list->IsSubcontract) == "") { ?>
		<th data-name="IsSubcontract" class="<?php echo $BondRates_list->IsSubcontract->headerCellClass() ?>"><div id="elh_BondRates_IsSubcontract" class="BondRates_IsSubcontract"><div class="ew-table-header-caption"><?php echo $BondRates_list->IsSubcontract->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsSubcontract" class="<?php echo $BondRates_list->IsSubcontract->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BondRates_list->SortUrl($BondRates_list->IsSubcontract) ?>', 1);"><div id="elh_BondRates_IsSubcontract" class="BondRates_IsSubcontract">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BondRates_list->IsSubcontract->caption() ?></span><span class="ew-table-header-sort"><?php if ($BondRates_list->IsSubcontract->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BondRates_list->IsSubcontract->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($BondRates_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($BondRates_list->SortUrl($BondRates_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $BondRates_list->ActiveFlag->headerCellClass() ?>"><div id="elh_BondRates_ActiveFlag" class="BondRates_ActiveFlag"><div class="ew-table-header-caption"><?php echo $BondRates_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $BondRates_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $BondRates_list->SortUrl($BondRates_list->ActiveFlag) ?>', 1);"><div id="elh_BondRates_ActiveFlag" class="BondRates_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $BondRates_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($BondRates_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($BondRates_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$BondRates_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($BondRates_list->isAdd() || $BondRates_list->isCopy()) {
		$BondRates_list->RowIndex = 0;
		$BondRates_list->KeyCount = $BondRates_list->RowIndex;
		if ($BondRates_list->isCopy() && !$BondRates_list->loadRow())
			$BondRates->CurrentAction = "add";
		if ($BondRates_list->isAdd())
			$BondRates_list->loadRowValues();
		if ($BondRates->EventCancelled) // Insert failed
			$BondRates_list->restoreFormValues(); // Restore form values

		// Set row properties
		$BondRates->resetAttributes();
		$BondRates->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_BondRates", "data-rowtype" => ROWTYPE_ADD]);
		$BondRates->RowType = ROWTYPE_ADD;

		// Render row
		$BondRates_list->renderRow();

		// Render list options
		$BondRates_list->renderListOptions();
		$BondRates_list->StartRowCount = 0;
?>
	<tr <?php echo $BondRates->rowAttributes() ?>>
<?php

// Render list options (body, left)
$BondRates_list->ListOptions->render("body", "left", $BondRates_list->RowCount);
?>
	<?php if ($BondRates_list->BondRate_Idn->Visible) { // BondRate_Idn ?>
		<td data-name="BondRate_Idn">
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_BondRate_Idn" class="form-group BondRates_BondRate_Idn"></span>
<input type="hidden" data-table="BondRates" data-field="x_BondRate_Idn" name="o<?php echo $BondRates_list->RowIndex ?>_BondRate_Idn" id="o<?php echo $BondRates_list->RowIndex ?>_BondRate_Idn" value="<?php echo HtmlEncode($BondRates_list->BondRate_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->StartValue->Visible) { // StartValue ?>
		<td data-name="StartValue">
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_StartValue" class="form-group BondRates_StartValue">
<input type="text" data-table="BondRates" data-field="x_StartValue" name="x<?php echo $BondRates_list->RowIndex ?>_StartValue" id="x<?php echo $BondRates_list->RowIndex ?>_StartValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->StartValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->StartValue->EditValue ?>"<?php echo $BondRates_list->StartValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_StartValue" name="o<?php echo $BondRates_list->RowIndex ?>_StartValue" id="o<?php echo $BondRates_list->RowIndex ?>_StartValue" value="<?php echo HtmlEncode($BondRates_list->StartValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->EndValue->Visible) { // EndValue ?>
		<td data-name="EndValue">
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_EndValue" class="form-group BondRates_EndValue">
<input type="text" data-table="BondRates" data-field="x_EndValue" name="x<?php echo $BondRates_list->RowIndex ?>_EndValue" id="x<?php echo $BondRates_list->RowIndex ?>_EndValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->EndValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->EndValue->EditValue ?>"<?php echo $BondRates_list->EndValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_EndValue" name="o<?php echo $BondRates_list->RowIndex ?>_EndValue" id="o<?php echo $BondRates_list->RowIndex ?>_EndValue" value="<?php echo HtmlEncode($BondRates_list->EndValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->Minimum->Visible) { // Minimum ?>
		<td data-name="Minimum">
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Minimum" class="form-group BondRates_Minimum">
<input type="text" data-table="BondRates" data-field="x_Minimum" name="x<?php echo $BondRates_list->RowIndex ?>_Minimum" id="x<?php echo $BondRates_list->RowIndex ?>_Minimum" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->Minimum->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Minimum->EditValue ?>"<?php echo $BondRates_list->Minimum->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_Minimum" name="o<?php echo $BondRates_list->RowIndex ?>_Minimum" id="o<?php echo $BondRates_list->RowIndex ?>_Minimum" value="<?php echo HtmlEncode($BondRates_list->Minimum->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->Rate->Visible) { // Rate ?>
		<td data-name="Rate">
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Rate" class="form-group BondRates_Rate">
<input type="text" data-table="BondRates" data-field="x_Rate" name="x<?php echo $BondRates_list->RowIndex ?>_Rate" id="x<?php echo $BondRates_list->RowIndex ?>_Rate" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->Rate->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Rate->EditValue ?>"<?php echo $BondRates_list->Rate->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_Rate" name="o<?php echo $BondRates_list->RowIndex ?>_Rate" id="o<?php echo $BondRates_list->RowIndex ?>_Rate" value="<?php echo HtmlEncode($BondRates_list->Rate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Rank" class="form-group BondRates_Rank">
<input type="text" data-table="BondRates" data-field="x_Rank" name="x<?php echo $BondRates_list->RowIndex ?>_Rank" id="x<?php echo $BondRates_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BondRates_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Rank->EditValue ?>"<?php echo $BondRates_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_Rank" name="o<?php echo $BondRates_list->RowIndex ?>_Rank" id="o<?php echo $BondRates_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($BondRates_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->IsSubcontract->Visible) { // IsSubcontract ?>
		<td data-name="IsSubcontract">
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_IsSubcontract" class="form-group BondRates_IsSubcontract">
<?php
$selwrk = ConvertToBool($BondRates_list->IsSubcontract->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_IsSubcontract" name="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]" id="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]_318476" value="1"<?php echo $selwrk ?><?php echo $BondRates_list->IsSubcontract->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]_318476"></label>
</div>
</span>
<input type="hidden" data-table="BondRates" data-field="x_IsSubcontract" name="o<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]" id="o<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]" value="<?php echo HtmlEncode($BondRates_list->IsSubcontract->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_ActiveFlag" class="form-group BondRates_ActiveFlag">
<?php
$selwrk = ConvertToBool($BondRates_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_ActiveFlag" name="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]_264858" value="1"<?php echo $selwrk ?><?php echo $BondRates_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]_264858"></label>
</div>
</span>
<input type="hidden" data-table="BondRates" data-field="x_ActiveFlag" name="o<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($BondRates_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$BondRates_list->ListOptions->render("body", "right", $BondRates_list->RowCount);
?>
<script>
loadjs.ready(["fBondRateslist", "load"], function() {
	fBondRateslist.updateLists(<?php echo $BondRates_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($BondRates_list->ExportAll && $BondRates_list->isExport()) {
	$BondRates_list->StopRecord = $BondRates_list->TotalRecords;
} else {

	// Set the last record to display
	if ($BondRates_list->TotalRecords > $BondRates_list->StartRecord + $BondRates_list->DisplayRecords - 1)
		$BondRates_list->StopRecord = $BondRates_list->StartRecord + $BondRates_list->DisplayRecords - 1;
	else
		$BondRates_list->StopRecord = $BondRates_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($BondRates->isConfirm() || $BondRates_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($BondRates_list->FormKeyCountName) && ($BondRates_list->isGridAdd() || $BondRates_list->isGridEdit() || $BondRates->isConfirm())) {
		$BondRates_list->KeyCount = $CurrentForm->getValue($BondRates_list->FormKeyCountName);
		$BondRates_list->StopRecord = $BondRates_list->StartRecord + $BondRates_list->KeyCount - 1;
	}
}
$BondRates_list->RecordCount = $BondRates_list->StartRecord - 1;
if ($BondRates_list->Recordset && !$BondRates_list->Recordset->EOF) {
	$BondRates_list->Recordset->moveFirst();
	$selectLimit = $BondRates_list->UseSelectLimit;
	if (!$selectLimit && $BondRates_list->StartRecord > 1)
		$BondRates_list->Recordset->move($BondRates_list->StartRecord - 1);
} elseif (!$BondRates->AllowAddDeleteRow && $BondRates_list->StopRecord == 0) {
	$BondRates_list->StopRecord = $BondRates->GridAddRowCount;
}

// Initialize aggregate
$BondRates->RowType = ROWTYPE_AGGREGATEINIT;
$BondRates->resetAttributes();
$BondRates_list->renderRow();
$BondRates_list->EditRowCount = 0;
if ($BondRates_list->isEdit())
	$BondRates_list->RowIndex = 1;
if ($BondRates_list->isGridAdd())
	$BondRates_list->RowIndex = 0;
if ($BondRates_list->isGridEdit())
	$BondRates_list->RowIndex = 0;
while ($BondRates_list->RecordCount < $BondRates_list->StopRecord) {
	$BondRates_list->RecordCount++;
	if ($BondRates_list->RecordCount >= $BondRates_list->StartRecord) {
		$BondRates_list->RowCount++;
		if ($BondRates_list->isGridAdd() || $BondRates_list->isGridEdit() || $BondRates->isConfirm()) {
			$BondRates_list->RowIndex++;
			$CurrentForm->Index = $BondRates_list->RowIndex;
			if ($CurrentForm->hasValue($BondRates_list->FormActionName) && ($BondRates->isConfirm() || $BondRates_list->EventCancelled))
				$BondRates_list->RowAction = strval($CurrentForm->getValue($BondRates_list->FormActionName));
			elseif ($BondRates_list->isGridAdd())
				$BondRates_list->RowAction = "insert";
			else
				$BondRates_list->RowAction = "";
		}

		// Set up key count
		$BondRates_list->KeyCount = $BondRates_list->RowIndex;

		// Init row class and style
		$BondRates->resetAttributes();
		$BondRates->CssClass = "";
		if ($BondRates_list->isGridAdd()) {
			$BondRates_list->loadRowValues(); // Load default values
		} else {
			$BondRates_list->loadRowValues($BondRates_list->Recordset); // Load row values
		}
		$BondRates->RowType = ROWTYPE_VIEW; // Render view
		if ($BondRates_list->isGridAdd()) // Grid add
			$BondRates->RowType = ROWTYPE_ADD; // Render add
		if ($BondRates_list->isGridAdd() && $BondRates->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$BondRates_list->restoreCurrentRowFormValues($BondRates_list->RowIndex); // Restore form values
		if ($BondRates_list->isEdit()) {
			if ($BondRates_list->checkInlineEditKey() && $BondRates_list->EditRowCount == 0) { // Inline edit
				$BondRates->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($BondRates_list->isGridEdit()) { // Grid edit
			if ($BondRates->EventCancelled)
				$BondRates_list->restoreCurrentRowFormValues($BondRates_list->RowIndex); // Restore form values
			if ($BondRates_list->RowAction == "insert")
				$BondRates->RowType = ROWTYPE_ADD; // Render add
			else
				$BondRates->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($BondRates_list->isEdit() && $BondRates->RowType == ROWTYPE_EDIT && $BondRates->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$BondRates_list->restoreFormValues(); // Restore form values
		}
		if ($BondRates_list->isGridEdit() && ($BondRates->RowType == ROWTYPE_EDIT || $BondRates->RowType == ROWTYPE_ADD) && $BondRates->EventCancelled) // Update failed
			$BondRates_list->restoreCurrentRowFormValues($BondRates_list->RowIndex); // Restore form values
		if ($BondRates->RowType == ROWTYPE_EDIT) // Edit row
			$BondRates_list->EditRowCount++;

		// Set up row id / data-rowindex
		$BondRates->RowAttrs->merge(["data-rowindex" => $BondRates_list->RowCount, "id" => "r" . $BondRates_list->RowCount . "_BondRates", "data-rowtype" => $BondRates->RowType]);

		// Render row
		$BondRates_list->renderRow();

		// Render list options
		$BondRates_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($BondRates_list->RowAction != "delete" && $BondRates_list->RowAction != "insertdelete" && !($BondRates_list->RowAction == "insert" && $BondRates->isConfirm() && $BondRates_list->emptyRow())) {
?>
	<tr <?php echo $BondRates->rowAttributes() ?>>
<?php

// Render list options (body, left)
$BondRates_list->ListOptions->render("body", "left", $BondRates_list->RowCount);
?>
	<?php if ($BondRates_list->BondRate_Idn->Visible) { // BondRate_Idn ?>
		<td data-name="BondRate_Idn" <?php echo $BondRates_list->BondRate_Idn->cellAttributes() ?>>
<?php if ($BondRates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_BondRate_Idn" class="form-group"></span>
<input type="hidden" data-table="BondRates" data-field="x_BondRate_Idn" name="o<?php echo $BondRates_list->RowIndex ?>_BondRate_Idn" id="o<?php echo $BondRates_list->RowIndex ?>_BondRate_Idn" value="<?php echo HtmlEncode($BondRates_list->BondRate_Idn->OldValue) ?>">
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_BondRate_Idn" class="form-group">
<span<?php echo $BondRates_list->BondRate_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($BondRates_list->BondRate_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="BondRates" data-field="x_BondRate_Idn" name="x<?php echo $BondRates_list->RowIndex ?>_BondRate_Idn" id="x<?php echo $BondRates_list->RowIndex ?>_BondRate_Idn" value="<?php echo HtmlEncode($BondRates_list->BondRate_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_BondRate_Idn">
<span<?php echo $BondRates_list->BondRate_Idn->viewAttributes() ?>><?php echo $BondRates_list->BondRate_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BondRates_list->StartValue->Visible) { // StartValue ?>
		<td data-name="StartValue" <?php echo $BondRates_list->StartValue->cellAttributes() ?>>
<?php if ($BondRates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_StartValue" class="form-group">
<input type="text" data-table="BondRates" data-field="x_StartValue" name="x<?php echo $BondRates_list->RowIndex ?>_StartValue" id="x<?php echo $BondRates_list->RowIndex ?>_StartValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->StartValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->StartValue->EditValue ?>"<?php echo $BondRates_list->StartValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_StartValue" name="o<?php echo $BondRates_list->RowIndex ?>_StartValue" id="o<?php echo $BondRates_list->RowIndex ?>_StartValue" value="<?php echo HtmlEncode($BondRates_list->StartValue->OldValue) ?>">
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_StartValue" class="form-group">
<input type="text" data-table="BondRates" data-field="x_StartValue" name="x<?php echo $BondRates_list->RowIndex ?>_StartValue" id="x<?php echo $BondRates_list->RowIndex ?>_StartValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->StartValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->StartValue->EditValue ?>"<?php echo $BondRates_list->StartValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_StartValue">
<span<?php echo $BondRates_list->StartValue->viewAttributes() ?>><?php echo $BondRates_list->StartValue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BondRates_list->EndValue->Visible) { // EndValue ?>
		<td data-name="EndValue" <?php echo $BondRates_list->EndValue->cellAttributes() ?>>
<?php if ($BondRates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_EndValue" class="form-group">
<input type="text" data-table="BondRates" data-field="x_EndValue" name="x<?php echo $BondRates_list->RowIndex ?>_EndValue" id="x<?php echo $BondRates_list->RowIndex ?>_EndValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->EndValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->EndValue->EditValue ?>"<?php echo $BondRates_list->EndValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_EndValue" name="o<?php echo $BondRates_list->RowIndex ?>_EndValue" id="o<?php echo $BondRates_list->RowIndex ?>_EndValue" value="<?php echo HtmlEncode($BondRates_list->EndValue->OldValue) ?>">
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_EndValue" class="form-group">
<input type="text" data-table="BondRates" data-field="x_EndValue" name="x<?php echo $BondRates_list->RowIndex ?>_EndValue" id="x<?php echo $BondRates_list->RowIndex ?>_EndValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->EndValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->EndValue->EditValue ?>"<?php echo $BondRates_list->EndValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_EndValue">
<span<?php echo $BondRates_list->EndValue->viewAttributes() ?>><?php echo $BondRates_list->EndValue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BondRates_list->Minimum->Visible) { // Minimum ?>
		<td data-name="Minimum" <?php echo $BondRates_list->Minimum->cellAttributes() ?>>
<?php if ($BondRates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Minimum" class="form-group">
<input type="text" data-table="BondRates" data-field="x_Minimum" name="x<?php echo $BondRates_list->RowIndex ?>_Minimum" id="x<?php echo $BondRates_list->RowIndex ?>_Minimum" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->Minimum->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Minimum->EditValue ?>"<?php echo $BondRates_list->Minimum->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_Minimum" name="o<?php echo $BondRates_list->RowIndex ?>_Minimum" id="o<?php echo $BondRates_list->RowIndex ?>_Minimum" value="<?php echo HtmlEncode($BondRates_list->Minimum->OldValue) ?>">
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Minimum" class="form-group">
<input type="text" data-table="BondRates" data-field="x_Minimum" name="x<?php echo $BondRates_list->RowIndex ?>_Minimum" id="x<?php echo $BondRates_list->RowIndex ?>_Minimum" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->Minimum->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Minimum->EditValue ?>"<?php echo $BondRates_list->Minimum->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Minimum">
<span<?php echo $BondRates_list->Minimum->viewAttributes() ?>><?php echo $BondRates_list->Minimum->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BondRates_list->Rate->Visible) { // Rate ?>
		<td data-name="Rate" <?php echo $BondRates_list->Rate->cellAttributes() ?>>
<?php if ($BondRates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Rate" class="form-group">
<input type="text" data-table="BondRates" data-field="x_Rate" name="x<?php echo $BondRates_list->RowIndex ?>_Rate" id="x<?php echo $BondRates_list->RowIndex ?>_Rate" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->Rate->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Rate->EditValue ?>"<?php echo $BondRates_list->Rate->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_Rate" name="o<?php echo $BondRates_list->RowIndex ?>_Rate" id="o<?php echo $BondRates_list->RowIndex ?>_Rate" value="<?php echo HtmlEncode($BondRates_list->Rate->OldValue) ?>">
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Rate" class="form-group">
<input type="text" data-table="BondRates" data-field="x_Rate" name="x<?php echo $BondRates_list->RowIndex ?>_Rate" id="x<?php echo $BondRates_list->RowIndex ?>_Rate" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->Rate->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Rate->EditValue ?>"<?php echo $BondRates_list->Rate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Rate">
<span<?php echo $BondRates_list->Rate->viewAttributes() ?>><?php echo $BondRates_list->Rate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BondRates_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $BondRates_list->Rank->cellAttributes() ?>>
<?php if ($BondRates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Rank" class="form-group">
<input type="text" data-table="BondRates" data-field="x_Rank" name="x<?php echo $BondRates_list->RowIndex ?>_Rank" id="x<?php echo $BondRates_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BondRates_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Rank->EditValue ?>"<?php echo $BondRates_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_Rank" name="o<?php echo $BondRates_list->RowIndex ?>_Rank" id="o<?php echo $BondRates_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($BondRates_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Rank" class="form-group">
<input type="text" data-table="BondRates" data-field="x_Rank" name="x<?php echo $BondRates_list->RowIndex ?>_Rank" id="x<?php echo $BondRates_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BondRates_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Rank->EditValue ?>"<?php echo $BondRates_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_Rank">
<span<?php echo $BondRates_list->Rank->viewAttributes() ?>><?php echo $BondRates_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BondRates_list->IsSubcontract->Visible) { // IsSubcontract ?>
		<td data-name="IsSubcontract" <?php echo $BondRates_list->IsSubcontract->cellAttributes() ?>>
<?php if ($BondRates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_IsSubcontract" class="form-group">
<?php
$selwrk = ConvertToBool($BondRates_list->IsSubcontract->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_IsSubcontract" name="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]" id="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]_462309" value="1"<?php echo $selwrk ?><?php echo $BondRates_list->IsSubcontract->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]_462309"></label>
</div>
</span>
<input type="hidden" data-table="BondRates" data-field="x_IsSubcontract" name="o<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]" id="o<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]" value="<?php echo HtmlEncode($BondRates_list->IsSubcontract->OldValue) ?>">
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_IsSubcontract" class="form-group">
<?php
$selwrk = ConvertToBool($BondRates_list->IsSubcontract->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_IsSubcontract" name="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]" id="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]_923027" value="1"<?php echo $selwrk ?><?php echo $BondRates_list->IsSubcontract->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]_923027"></label>
</div>
</span>
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_IsSubcontract">
<span<?php echo $BondRates_list->IsSubcontract->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsSubcontract" class="custom-control-input" value="<?php echo $BondRates_list->IsSubcontract->getViewValue() ?>" disabled<?php if (ConvertToBool($BondRates_list->IsSubcontract->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsSubcontract"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($BondRates_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $BondRates_list->ActiveFlag->cellAttributes() ?>>
<?php if ($BondRates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($BondRates_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_ActiveFlag" name="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]_396172" value="1"<?php echo $selwrk ?><?php echo $BondRates_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]_396172"></label>
</div>
</span>
<input type="hidden" data-table="BondRates" data-field="x_ActiveFlag" name="o<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($BondRates_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($BondRates_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_ActiveFlag" name="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]_668123" value="1"<?php echo $selwrk ?><?php echo $BondRates_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]_668123"></label>
</div>
</span>
<?php } ?>
<?php if ($BondRates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $BondRates_list->RowCount ?>_BondRates_ActiveFlag">
<span<?php echo $BondRates_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $BondRates_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($BondRates_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$BondRates_list->ListOptions->render("body", "right", $BondRates_list->RowCount);
?>
	</tr>
<?php if ($BondRates->RowType == ROWTYPE_ADD || $BondRates->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fBondRateslist", "load"], function() {
	fBondRateslist.updateLists(<?php echo $BondRates_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$BondRates_list->isGridAdd())
		if (!$BondRates_list->Recordset->EOF)
			$BondRates_list->Recordset->moveNext();
}
?>
<?php
	if ($BondRates_list->isGridAdd() || $BondRates_list->isGridEdit()) {
		$BondRates_list->RowIndex = '$rowindex$';
		$BondRates_list->loadRowValues();

		// Set row properties
		$BondRates->resetAttributes();
		$BondRates->RowAttrs->merge(["data-rowindex" => $BondRates_list->RowIndex, "id" => "r0_BondRates", "data-rowtype" => ROWTYPE_ADD]);
		$BondRates->RowAttrs->appendClass("ew-template");
		$BondRates->RowType = ROWTYPE_ADD;

		// Render row
		$BondRates_list->renderRow();

		// Render list options
		$BondRates_list->renderListOptions();
		$BondRates_list->StartRowCount = 0;
?>
	<tr <?php echo $BondRates->rowAttributes() ?>>
<?php

// Render list options (body, left)
$BondRates_list->ListOptions->render("body", "left", $BondRates_list->RowIndex);
?>
	<?php if ($BondRates_list->BondRate_Idn->Visible) { // BondRate_Idn ?>
		<td data-name="BondRate_Idn">
<span id="el$rowindex$_BondRates_BondRate_Idn" class="form-group BondRates_BondRate_Idn"></span>
<input type="hidden" data-table="BondRates" data-field="x_BondRate_Idn" name="o<?php echo $BondRates_list->RowIndex ?>_BondRate_Idn" id="o<?php echo $BondRates_list->RowIndex ?>_BondRate_Idn" value="<?php echo HtmlEncode($BondRates_list->BondRate_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->StartValue->Visible) { // StartValue ?>
		<td data-name="StartValue">
<span id="el$rowindex$_BondRates_StartValue" class="form-group BondRates_StartValue">
<input type="text" data-table="BondRates" data-field="x_StartValue" name="x<?php echo $BondRates_list->RowIndex ?>_StartValue" id="x<?php echo $BondRates_list->RowIndex ?>_StartValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->StartValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->StartValue->EditValue ?>"<?php echo $BondRates_list->StartValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_StartValue" name="o<?php echo $BondRates_list->RowIndex ?>_StartValue" id="o<?php echo $BondRates_list->RowIndex ?>_StartValue" value="<?php echo HtmlEncode($BondRates_list->StartValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->EndValue->Visible) { // EndValue ?>
		<td data-name="EndValue">
<span id="el$rowindex$_BondRates_EndValue" class="form-group BondRates_EndValue">
<input type="text" data-table="BondRates" data-field="x_EndValue" name="x<?php echo $BondRates_list->RowIndex ?>_EndValue" id="x<?php echo $BondRates_list->RowIndex ?>_EndValue" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->EndValue->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->EndValue->EditValue ?>"<?php echo $BondRates_list->EndValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_EndValue" name="o<?php echo $BondRates_list->RowIndex ?>_EndValue" id="o<?php echo $BondRates_list->RowIndex ?>_EndValue" value="<?php echo HtmlEncode($BondRates_list->EndValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->Minimum->Visible) { // Minimum ?>
		<td data-name="Minimum">
<span id="el$rowindex$_BondRates_Minimum" class="form-group BondRates_Minimum">
<input type="text" data-table="BondRates" data-field="x_Minimum" name="x<?php echo $BondRates_list->RowIndex ?>_Minimum" id="x<?php echo $BondRates_list->RowIndex ?>_Minimum" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->Minimum->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Minimum->EditValue ?>"<?php echo $BondRates_list->Minimum->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_Minimum" name="o<?php echo $BondRates_list->RowIndex ?>_Minimum" id="o<?php echo $BondRates_list->RowIndex ?>_Minimum" value="<?php echo HtmlEncode($BondRates_list->Minimum->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->Rate->Visible) { // Rate ?>
		<td data-name="Rate">
<span id="el$rowindex$_BondRates_Rate" class="form-group BondRates_Rate">
<input type="text" data-table="BondRates" data-field="x_Rate" name="x<?php echo $BondRates_list->RowIndex ?>_Rate" id="x<?php echo $BondRates_list->RowIndex ?>_Rate" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($BondRates_list->Rate->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Rate->EditValue ?>"<?php echo $BondRates_list->Rate->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_Rate" name="o<?php echo $BondRates_list->RowIndex ?>_Rate" id="o<?php echo $BondRates_list->RowIndex ?>_Rate" value="<?php echo HtmlEncode($BondRates_list->Rate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_BondRates_Rank" class="form-group BondRates_Rank">
<input type="text" data-table="BondRates" data-field="x_Rank" name="x<?php echo $BondRates_list->RowIndex ?>_Rank" id="x<?php echo $BondRates_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($BondRates_list->Rank->getPlaceHolder()) ?>" value="<?php echo $BondRates_list->Rank->EditValue ?>"<?php echo $BondRates_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="BondRates" data-field="x_Rank" name="o<?php echo $BondRates_list->RowIndex ?>_Rank" id="o<?php echo $BondRates_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($BondRates_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->IsSubcontract->Visible) { // IsSubcontract ?>
		<td data-name="IsSubcontract">
<span id="el$rowindex$_BondRates_IsSubcontract" class="form-group BondRates_IsSubcontract">
<?php
$selwrk = ConvertToBool($BondRates_list->IsSubcontract->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_IsSubcontract" name="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]" id="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]_598341" value="1"<?php echo $selwrk ?><?php echo $BondRates_list->IsSubcontract->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]_598341"></label>
</div>
</span>
<input type="hidden" data-table="BondRates" data-field="x_IsSubcontract" name="o<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]" id="o<?php echo $BondRates_list->RowIndex ?>_IsSubcontract[]" value="<?php echo HtmlEncode($BondRates_list->IsSubcontract->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($BondRates_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_BondRates_ActiveFlag" class="form-group BondRates_ActiveFlag">
<?php
$selwrk = ConvertToBool($BondRates_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="BondRates" data-field="x_ActiveFlag" name="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]_249805" value="1"<?php echo $selwrk ?><?php echo $BondRates_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]_249805"></label>
</div>
</span>
<input type="hidden" data-table="BondRates" data-field="x_ActiveFlag" name="o<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $BondRates_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($BondRates_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$BondRates_list->ListOptions->render("body", "right", $BondRates_list->RowIndex);
?>
<script>
loadjs.ready(["fBondRateslist", "load"], function() {
	fBondRateslist.updateLists(<?php echo $BondRates_list->RowIndex ?>);
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
<?php if ($BondRates_list->isAdd() || $BondRates_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $BondRates_list->FormKeyCountName ?>" id="<?php echo $BondRates_list->FormKeyCountName ?>" value="<?php echo $BondRates_list->KeyCount ?>">
<?php } ?>
<?php if ($BondRates_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $BondRates_list->FormKeyCountName ?>" id="<?php echo $BondRates_list->FormKeyCountName ?>" value="<?php echo $BondRates_list->KeyCount ?>">
<?php echo $BondRates_list->MultiSelectKey ?>
<?php } ?>
<?php if ($BondRates_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $BondRates_list->FormKeyCountName ?>" id="<?php echo $BondRates_list->FormKeyCountName ?>" value="<?php echo $BondRates_list->KeyCount ?>">
<?php } ?>
<?php if ($BondRates_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $BondRates_list->FormKeyCountName ?>" id="<?php echo $BondRates_list->FormKeyCountName ?>" value="<?php echo $BondRates_list->KeyCount ?>">
<?php echo $BondRates_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$BondRates->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($BondRates_list->Recordset)
	$BondRates_list->Recordset->Close();
?>
<?php if (!$BondRates_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$BondRates_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $BondRates_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $BondRates_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($BondRates_list->TotalRecords == 0 && !$BondRates->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $BondRates_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$BondRates_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$BondRates_list->isExport()) { ?>
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
$BondRates_list->terminate();
?>