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
$Menus_list = new Menus_list();

// Run the page
$Menus_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Menus_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Menus_list->isExport()) { ?>
<script>
var fMenuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fMenuslist = currentForm = new ew.Form("fMenuslist", "list");
	fMenuslist.formKeyCountName = '<?php echo $Menus_list->FormKeyCountName ?>';

	// Validate form
	fMenuslist.validate = function() {
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
			<?php if ($Menus_list->Menu_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Menu_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_list->Menu_Idn->caption(), $Menus_list->Menu_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_list->Name->Required) { ?>
				elm = this.getElements("x" + infix + "_Name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_list->Name->caption(), $Menus_list->Name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_list->ShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_ShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_list->ShortName->caption(), $Menus_list->ShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_list->Link->Required) { ?>
				elm = this.getElements("x" + infix + "_Link");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_list->Link->caption(), $Menus_list->Link->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_list->Icon->Required) { ?>
				elm = this.getElements("x" + infix + "_Icon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_list->Icon->caption(), $Menus_list->Icon->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_list->MenuType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_MenuType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_list->MenuType_Idn->caption(), $Menus_list->MenuType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_list->Rank->Required) { ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_list->Rank->caption(), $Menus_list->Rank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Menus_list->Rank->errorMessage()) ?>");
			<?php if ($Menus_list->ChildMenuType_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_ChildMenuType_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_list->ChildMenuType_Idn->caption(), $Menus_list->ChildMenuType_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_list->IsParent->Required) { ?>
				elm = this.getElements("x" + infix + "_IsParent[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_list->IsParent->caption(), $Menus_list->IsParent->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_list->AdminOnly->Required) { ?>
				elm = this.getElements("x" + infix + "_AdminOnly[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_list->AdminOnly->caption(), $Menus_list->AdminOnly->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Menus_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Menus_list->ActiveFlag->caption(), $Menus_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fMenuslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Name", false)) return false;
		if (ew.valueChanged(fobj, infix, "ShortName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Link", false)) return false;
		if (ew.valueChanged(fobj, infix, "Icon", false)) return false;
		if (ew.valueChanged(fobj, infix, "MenuType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rank", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChildMenuType_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "IsParent[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "AdminOnly[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fMenuslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fMenuslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fMenuslist.lists["x_MenuType_Idn"] = <?php echo $Menus_list->MenuType_Idn->Lookup->toClientList($Menus_list) ?>;
	fMenuslist.lists["x_MenuType_Idn"].options = <?php echo JsonEncode($Menus_list->MenuType_Idn->lookupOptions()) ?>;
	fMenuslist.lists["x_ChildMenuType_Idn"] = <?php echo $Menus_list->ChildMenuType_Idn->Lookup->toClientList($Menus_list) ?>;
	fMenuslist.lists["x_ChildMenuType_Idn"].options = <?php echo JsonEncode($Menus_list->ChildMenuType_Idn->lookupOptions()) ?>;
	fMenuslist.lists["x_IsParent[]"] = <?php echo $Menus_list->IsParent->Lookup->toClientList($Menus_list) ?>;
	fMenuslist.lists["x_IsParent[]"].options = <?php echo JsonEncode($Menus_list->IsParent->options(FALSE, TRUE)) ?>;
	fMenuslist.lists["x_AdminOnly[]"] = <?php echo $Menus_list->AdminOnly->Lookup->toClientList($Menus_list) ?>;
	fMenuslist.lists["x_AdminOnly[]"].options = <?php echo JsonEncode($Menus_list->AdminOnly->options(FALSE, TRUE)) ?>;
	fMenuslist.lists["x_ActiveFlag[]"] = <?php echo $Menus_list->ActiveFlag->Lookup->toClientList($Menus_list) ?>;
	fMenuslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Menus_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fMenuslist");
});
var fMenuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fMenuslistsrch = currentSearchForm = new ew.Form("fMenuslistsrch");

	// Dynamic selection lists
	// Filters

	fMenuslistsrch.filterList = <?php echo $Menus_list->getFilterList() ?>;
	loadjs.done("fMenuslistsrch");
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
<?php if (!$Menus_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Menus_list->TotalRecords > 0 && $Menus_list->ExportOptions->visible()) { ?>
<?php $Menus_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Menus_list->ImportOptions->visible()) { ?>
<?php $Menus_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Menus_list->SearchOptions->visible()) { ?>
<?php $Menus_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Menus_list->FilterOptions->visible()) { ?>
<?php $Menus_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Menus_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Menus_list->isExport() && !$Menus->CurrentAction) { ?>
<form name="fMenuslistsrch" id="fMenuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fMenuslistsrch-search-panel" class="<?php echo $Menus_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Menus">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Menus_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Menus_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Menus_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Menus_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Menus_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Menus_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Menus_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Menus_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Menus_list->showPageHeader(); ?>
<?php
$Menus_list->showMessage();
?>
<?php if ($Menus_list->TotalRecords > 0 || $Menus->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Menus_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Menus">
<?php if (!$Menus_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Menus_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Menus_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Menus_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fMenuslist" id="fMenuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Menus">
<div id="gmp_Menus" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Menus_list->TotalRecords > 0 || $Menus_list->isAdd() || $Menus_list->isCopy() || $Menus_list->isGridEdit()) { ?>
<table id="tbl_Menuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Menus->RowType = ROWTYPE_HEADER;

// Render list options
$Menus_list->renderListOptions();

// Render list options (header, left)
$Menus_list->ListOptions->render("header", "left");
?>
<?php if ($Menus_list->Menu_Idn->Visible) { // Menu_Idn ?>
	<?php if ($Menus_list->SortUrl($Menus_list->Menu_Idn) == "") { ?>
		<th data-name="Menu_Idn" class="<?php echo $Menus_list->Menu_Idn->headerCellClass() ?>"><div id="elh_Menus_Menu_Idn" class="Menus_Menu_Idn"><div class="ew-table-header-caption"><?php echo $Menus_list->Menu_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Menu_Idn" class="<?php echo $Menus_list->Menu_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Menus_list->SortUrl($Menus_list->Menu_Idn) ?>', 1);"><div id="elh_Menus_Menu_Idn" class="Menus_Menu_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Menus_list->Menu_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Menus_list->Menu_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Menus_list->Menu_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Menus_list->Name->Visible) { // Name ?>
	<?php if ($Menus_list->SortUrl($Menus_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $Menus_list->Name->headerCellClass() ?>"><div id="elh_Menus_Name" class="Menus_Name"><div class="ew-table-header-caption"><?php echo $Menus_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $Menus_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Menus_list->SortUrl($Menus_list->Name) ?>', 1);"><div id="elh_Menus_Name" class="Menus_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Menus_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Menus_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Menus_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Menus_list->ShortName->Visible) { // ShortName ?>
	<?php if ($Menus_list->SortUrl($Menus_list->ShortName) == "") { ?>
		<th data-name="ShortName" class="<?php echo $Menus_list->ShortName->headerCellClass() ?>"><div id="elh_Menus_ShortName" class="Menus_ShortName"><div class="ew-table-header-caption"><?php echo $Menus_list->ShortName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ShortName" class="<?php echo $Menus_list->ShortName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Menus_list->SortUrl($Menus_list->ShortName) ?>', 1);"><div id="elh_Menus_ShortName" class="Menus_ShortName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Menus_list->ShortName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Menus_list->ShortName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Menus_list->ShortName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Menus_list->Link->Visible) { // Link ?>
	<?php if ($Menus_list->SortUrl($Menus_list->Link) == "") { ?>
		<th data-name="Link" class="<?php echo $Menus_list->Link->headerCellClass() ?>"><div id="elh_Menus_Link" class="Menus_Link"><div class="ew-table-header-caption"><?php echo $Menus_list->Link->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Link" class="<?php echo $Menus_list->Link->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Menus_list->SortUrl($Menus_list->Link) ?>', 1);"><div id="elh_Menus_Link" class="Menus_Link">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Menus_list->Link->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Menus_list->Link->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Menus_list->Link->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Menus_list->Icon->Visible) { // Icon ?>
	<?php if ($Menus_list->SortUrl($Menus_list->Icon) == "") { ?>
		<th data-name="Icon" class="<?php echo $Menus_list->Icon->headerCellClass() ?>"><div id="elh_Menus_Icon" class="Menus_Icon"><div class="ew-table-header-caption"><?php echo $Menus_list->Icon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Icon" class="<?php echo $Menus_list->Icon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Menus_list->SortUrl($Menus_list->Icon) ?>', 1);"><div id="elh_Menus_Icon" class="Menus_Icon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Menus_list->Icon->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Menus_list->Icon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Menus_list->Icon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Menus_list->MenuType_Idn->Visible) { // MenuType_Idn ?>
	<?php if ($Menus_list->SortUrl($Menus_list->MenuType_Idn) == "") { ?>
		<th data-name="MenuType_Idn" class="<?php echo $Menus_list->MenuType_Idn->headerCellClass() ?>"><div id="elh_Menus_MenuType_Idn" class="Menus_MenuType_Idn"><div class="ew-table-header-caption"><?php echo $Menus_list->MenuType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MenuType_Idn" class="<?php echo $Menus_list->MenuType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Menus_list->SortUrl($Menus_list->MenuType_Idn) ?>', 1);"><div id="elh_Menus_MenuType_Idn" class="Menus_MenuType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Menus_list->MenuType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Menus_list->MenuType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Menus_list->MenuType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Menus_list->Rank->Visible) { // Rank ?>
	<?php if ($Menus_list->SortUrl($Menus_list->Rank) == "") { ?>
		<th data-name="Rank" class="<?php echo $Menus_list->Rank->headerCellClass() ?>"><div id="elh_Menus_Rank" class="Menus_Rank"><div class="ew-table-header-caption"><?php echo $Menus_list->Rank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rank" class="<?php echo $Menus_list->Rank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Menus_list->SortUrl($Menus_list->Rank) ?>', 1);"><div id="elh_Menus_Rank" class="Menus_Rank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Menus_list->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($Menus_list->Rank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Menus_list->Rank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Menus_list->ChildMenuType_Idn->Visible) { // ChildMenuType_Idn ?>
	<?php if ($Menus_list->SortUrl($Menus_list->ChildMenuType_Idn) == "") { ?>
		<th data-name="ChildMenuType_Idn" class="<?php echo $Menus_list->ChildMenuType_Idn->headerCellClass() ?>"><div id="elh_Menus_ChildMenuType_Idn" class="Menus_ChildMenuType_Idn"><div class="ew-table-header-caption"><?php echo $Menus_list->ChildMenuType_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChildMenuType_Idn" class="<?php echo $Menus_list->ChildMenuType_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Menus_list->SortUrl($Menus_list->ChildMenuType_Idn) ?>', 1);"><div id="elh_Menus_ChildMenuType_Idn" class="Menus_ChildMenuType_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Menus_list->ChildMenuType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Menus_list->ChildMenuType_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Menus_list->ChildMenuType_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Menus_list->IsParent->Visible) { // IsParent ?>
	<?php if ($Menus_list->SortUrl($Menus_list->IsParent) == "") { ?>
		<th data-name="IsParent" class="<?php echo $Menus_list->IsParent->headerCellClass() ?>"><div id="elh_Menus_IsParent" class="Menus_IsParent"><div class="ew-table-header-caption"><?php echo $Menus_list->IsParent->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsParent" class="<?php echo $Menus_list->IsParent->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Menus_list->SortUrl($Menus_list->IsParent) ?>', 1);"><div id="elh_Menus_IsParent" class="Menus_IsParent">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Menus_list->IsParent->caption() ?></span><span class="ew-table-header-sort"><?php if ($Menus_list->IsParent->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Menus_list->IsParent->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Menus_list->AdminOnly->Visible) { // AdminOnly ?>
	<?php if ($Menus_list->SortUrl($Menus_list->AdminOnly) == "") { ?>
		<th data-name="AdminOnly" class="<?php echo $Menus_list->AdminOnly->headerCellClass() ?>"><div id="elh_Menus_AdminOnly" class="Menus_AdminOnly"><div class="ew-table-header-caption"><?php echo $Menus_list->AdminOnly->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdminOnly" class="<?php echo $Menus_list->AdminOnly->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Menus_list->SortUrl($Menus_list->AdminOnly) ?>', 1);"><div id="elh_Menus_AdminOnly" class="Menus_AdminOnly">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Menus_list->AdminOnly->caption() ?></span><span class="ew-table-header-sort"><?php if ($Menus_list->AdminOnly->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Menus_list->AdminOnly->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Menus_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($Menus_list->SortUrl($Menus_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $Menus_list->ActiveFlag->headerCellClass() ?>"><div id="elh_Menus_ActiveFlag" class="Menus_ActiveFlag"><div class="ew-table-header-caption"><?php echo $Menus_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $Menus_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Menus_list->SortUrl($Menus_list->ActiveFlag) ?>', 1);"><div id="elh_Menus_ActiveFlag" class="Menus_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Menus_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Menus_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Menus_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Menus_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($Menus_list->isAdd() || $Menus_list->isCopy()) {
		$Menus_list->RowIndex = 0;
		$Menus_list->KeyCount = $Menus_list->RowIndex;
		if ($Menus_list->isCopy() && !$Menus_list->loadRow())
			$Menus->CurrentAction = "add";
		if ($Menus_list->isAdd())
			$Menus_list->loadRowValues();
		if ($Menus->EventCancelled) // Insert failed
			$Menus_list->restoreFormValues(); // Restore form values

		// Set row properties
		$Menus->resetAttributes();
		$Menus->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_Menus", "data-rowtype" => ROWTYPE_ADD]);
		$Menus->RowType = ROWTYPE_ADD;

		// Render row
		$Menus_list->renderRow();

		// Render list options
		$Menus_list->renderListOptions();
		$Menus_list->StartRowCount = 0;
?>
	<tr <?php echo $Menus->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Menus_list->ListOptions->render("body", "left", $Menus_list->RowCount);
?>
	<?php if ($Menus_list->Menu_Idn->Visible) { // Menu_Idn ?>
		<td data-name="Menu_Idn">
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Menu_Idn" class="form-group Menus_Menu_Idn"></span>
<input type="hidden" data-table="Menus" data-field="x_Menu_Idn" name="o<?php echo $Menus_list->RowIndex ?>_Menu_Idn" id="o<?php echo $Menus_list->RowIndex ?>_Menu_Idn" value="<?php echo HtmlEncode($Menus_list->Menu_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Name" class="form-group Menus_Name">
<input type="text" data-table="Menus" data-field="x_Name" name="x<?php echo $Menus_list->RowIndex ?>_Name" id="x<?php echo $Menus_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_list->Name->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Name->EditValue ?>"<?php echo $Menus_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Name" name="o<?php echo $Menus_list->RowIndex ?>_Name" id="o<?php echo $Menus_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Menus_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ShortName" class="form-group Menus_ShortName">
<input type="text" data-table="Menus" data-field="x_ShortName" name="x<?php echo $Menus_list->RowIndex ?>_ShortName" id="x<?php echo $Menus_list->RowIndex ?>_ShortName" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($Menus_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $Menus_list->ShortName->EditValue ?>"<?php echo $Menus_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_ShortName" name="o<?php echo $Menus_list->RowIndex ?>_ShortName" id="o<?php echo $Menus_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($Menus_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->Link->Visible) { // Link ?>
		<td data-name="Link">
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Link" class="form-group Menus_Link">
<input type="text" data-table="Menus" data-field="x_Link" name="x<?php echo $Menus_list->RowIndex ?>_Link" id="x<?php echo $Menus_list->RowIndex ?>_Link" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Menus_list->Link->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Link->EditValue ?>"<?php echo $Menus_list->Link->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Link" name="o<?php echo $Menus_list->RowIndex ?>_Link" id="o<?php echo $Menus_list->RowIndex ?>_Link" value="<?php echo HtmlEncode($Menus_list->Link->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->Icon->Visible) { // Icon ?>
		<td data-name="Icon">
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Icon" class="form-group Menus_Icon">
<input type="text" data-table="Menus" data-field="x_Icon" name="x<?php echo $Menus_list->RowIndex ?>_Icon" id="x<?php echo $Menus_list->RowIndex ?>_Icon" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_list->Icon->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Icon->EditValue ?>"<?php echo $Menus_list->Icon->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Icon" name="o<?php echo $Menus_list->RowIndex ?>_Icon" id="o<?php echo $Menus_list->RowIndex ?>_Icon" value="<?php echo HtmlEncode($Menus_list->Icon->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->MenuType_Idn->Visible) { // MenuType_Idn ?>
		<td data-name="MenuType_Idn">
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_MenuType_Idn" class="form-group Menus_MenuType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_MenuType_Idn" data-value-separator="<?php echo $Menus_list->MenuType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Menus_list->RowIndex ?>_MenuType_Idn" name="x<?php echo $Menus_list->RowIndex ?>_MenuType_Idn"<?php echo $Menus_list->MenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_list->MenuType_Idn->selectOptionListHtml("x{$Menus_list->RowIndex}_MenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_list->MenuType_Idn->Lookup->getParamTag($Menus_list, "p_x" . $Menus_list->RowIndex . "_MenuType_Idn") ?>
</span>
<input type="hidden" data-table="Menus" data-field="x_MenuType_Idn" name="o<?php echo $Menus_list->RowIndex ?>_MenuType_Idn" id="o<?php echo $Menus_list->RowIndex ?>_MenuType_Idn" value="<?php echo HtmlEncode($Menus_list->MenuType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Rank" class="form-group Menus_Rank">
<input type="text" data-table="Menus" data-field="x_Rank" name="x<?php echo $Menus_list->RowIndex ?>_Rank" id="x<?php echo $Menus_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Menus_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Rank->EditValue ?>"<?php echo $Menus_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Rank" name="o<?php echo $Menus_list->RowIndex ?>_Rank" id="o<?php echo $Menus_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Menus_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->ChildMenuType_Idn->Visible) { // ChildMenuType_Idn ?>
		<td data-name="ChildMenuType_Idn">
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ChildMenuType_Idn" class="form-group Menus_ChildMenuType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_ChildMenuType_Idn" data-value-separator="<?php echo $Menus_list->ChildMenuType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn" name="x<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn"<?php echo $Menus_list->ChildMenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_list->ChildMenuType_Idn->selectOptionListHtml("x{$Menus_list->RowIndex}_ChildMenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_list->ChildMenuType_Idn->Lookup->getParamTag($Menus_list, "p_x" . $Menus_list->RowIndex . "_ChildMenuType_Idn") ?>
</span>
<input type="hidden" data-table="Menus" data-field="x_ChildMenuType_Idn" name="o<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn" id="o<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn" value="<?php echo HtmlEncode($Menus_list->ChildMenuType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->IsParent->Visible) { // IsParent ?>
		<td data-name="IsParent">
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_IsParent" class="form-group Menus_IsParent">
<?php
$selwrk = ConvertToBool($Menus_list->IsParent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_IsParent" name="x<?php echo $Menus_list->RowIndex ?>_IsParent[]" id="x<?php echo $Menus_list->RowIndex ?>_IsParent[]_680369" value="1"<?php echo $selwrk ?><?php echo $Menus_list->IsParent->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_IsParent[]_680369"></label>
</div>
</span>
<input type="hidden" data-table="Menus" data-field="x_IsParent" name="o<?php echo $Menus_list->RowIndex ?>_IsParent[]" id="o<?php echo $Menus_list->RowIndex ?>_IsParent[]" value="<?php echo HtmlEncode($Menus_list->IsParent->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->AdminOnly->Visible) { // AdminOnly ?>
		<td data-name="AdminOnly">
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_AdminOnly" class="form-group Menus_AdminOnly">
<?php
$selwrk = ConvertToBool($Menus_list->AdminOnly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_AdminOnly" name="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]" id="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]_618599" value="1"<?php echo $selwrk ?><?php echo $Menus_list->AdminOnly->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]_618599"></label>
</div>
</span>
<input type="hidden" data-table="Menus" data-field="x_AdminOnly" name="o<?php echo $Menus_list->RowIndex ?>_AdminOnly[]" id="o<?php echo $Menus_list->RowIndex ?>_AdminOnly[]" value="<?php echo HtmlEncode($Menus_list->AdminOnly->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ActiveFlag" class="form-group Menus_ActiveFlag">
<?php
$selwrk = ConvertToBool($Menus_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_ActiveFlag" name="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]_784800" value="1"<?php echo $selwrk ?><?php echo $Menus_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]_784800"></label>
</div>
</span>
<input type="hidden" data-table="Menus" data-field="x_ActiveFlag" name="o<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Menus_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Menus_list->ListOptions->render("body", "right", $Menus_list->RowCount);
?>
<script>
loadjs.ready(["fMenuslist", "load"], function() {
	fMenuslist.updateLists(<?php echo $Menus_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($Menus_list->ExportAll && $Menus_list->isExport()) {
	$Menus_list->StopRecord = $Menus_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Menus_list->TotalRecords > $Menus_list->StartRecord + $Menus_list->DisplayRecords - 1)
		$Menus_list->StopRecord = $Menus_list->StartRecord + $Menus_list->DisplayRecords - 1;
	else
		$Menus_list->StopRecord = $Menus_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($Menus->isConfirm() || $Menus_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Menus_list->FormKeyCountName) && ($Menus_list->isGridAdd() || $Menus_list->isGridEdit() || $Menus->isConfirm())) {
		$Menus_list->KeyCount = $CurrentForm->getValue($Menus_list->FormKeyCountName);
		$Menus_list->StopRecord = $Menus_list->StartRecord + $Menus_list->KeyCount - 1;
	}
}
$Menus_list->RecordCount = $Menus_list->StartRecord - 1;
if ($Menus_list->Recordset && !$Menus_list->Recordset->EOF) {
	$Menus_list->Recordset->moveFirst();
	$selectLimit = $Menus_list->UseSelectLimit;
	if (!$selectLimit && $Menus_list->StartRecord > 1)
		$Menus_list->Recordset->move($Menus_list->StartRecord - 1);
} elseif (!$Menus->AllowAddDeleteRow && $Menus_list->StopRecord == 0) {
	$Menus_list->StopRecord = $Menus->GridAddRowCount;
}

// Initialize aggregate
$Menus->RowType = ROWTYPE_AGGREGATEINIT;
$Menus->resetAttributes();
$Menus_list->renderRow();
$Menus_list->EditRowCount = 0;
if ($Menus_list->isEdit())
	$Menus_list->RowIndex = 1;
if ($Menus_list->isGridAdd())
	$Menus_list->RowIndex = 0;
if ($Menus_list->isGridEdit())
	$Menus_list->RowIndex = 0;
while ($Menus_list->RecordCount < $Menus_list->StopRecord) {
	$Menus_list->RecordCount++;
	if ($Menus_list->RecordCount >= $Menus_list->StartRecord) {
		$Menus_list->RowCount++;
		if ($Menus_list->isGridAdd() || $Menus_list->isGridEdit() || $Menus->isConfirm()) {
			$Menus_list->RowIndex++;
			$CurrentForm->Index = $Menus_list->RowIndex;
			if ($CurrentForm->hasValue($Menus_list->FormActionName) && ($Menus->isConfirm() || $Menus_list->EventCancelled))
				$Menus_list->RowAction = strval($CurrentForm->getValue($Menus_list->FormActionName));
			elseif ($Menus_list->isGridAdd())
				$Menus_list->RowAction = "insert";
			else
				$Menus_list->RowAction = "";
		}

		// Set up key count
		$Menus_list->KeyCount = $Menus_list->RowIndex;

		// Init row class and style
		$Menus->resetAttributes();
		$Menus->CssClass = "";
		if ($Menus_list->isGridAdd()) {
			$Menus_list->loadRowValues(); // Load default values
		} else {
			$Menus_list->loadRowValues($Menus_list->Recordset); // Load row values
		}
		$Menus->RowType = ROWTYPE_VIEW; // Render view
		if ($Menus_list->isGridAdd()) // Grid add
			$Menus->RowType = ROWTYPE_ADD; // Render add
		if ($Menus_list->isGridAdd() && $Menus->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Menus_list->restoreCurrentRowFormValues($Menus_list->RowIndex); // Restore form values
		if ($Menus_list->isEdit()) {
			if ($Menus_list->checkInlineEditKey() && $Menus_list->EditRowCount == 0) { // Inline edit
				$Menus->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($Menus_list->isGridEdit()) { // Grid edit
			if ($Menus->EventCancelled)
				$Menus_list->restoreCurrentRowFormValues($Menus_list->RowIndex); // Restore form values
			if ($Menus_list->RowAction == "insert")
				$Menus->RowType = ROWTYPE_ADD; // Render add
			else
				$Menus->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Menus_list->isEdit() && $Menus->RowType == ROWTYPE_EDIT && $Menus->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$Menus_list->restoreFormValues(); // Restore form values
		}
		if ($Menus_list->isGridEdit() && ($Menus->RowType == ROWTYPE_EDIT || $Menus->RowType == ROWTYPE_ADD) && $Menus->EventCancelled) // Update failed
			$Menus_list->restoreCurrentRowFormValues($Menus_list->RowIndex); // Restore form values
		if ($Menus->RowType == ROWTYPE_EDIT) // Edit row
			$Menus_list->EditRowCount++;

		// Set up row id / data-rowindex
		$Menus->RowAttrs->merge(["data-rowindex" => $Menus_list->RowCount, "id" => "r" . $Menus_list->RowCount . "_Menus", "data-rowtype" => $Menus->RowType]);

		// Render row
		$Menus_list->renderRow();

		// Render list options
		$Menus_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Menus_list->RowAction != "delete" && $Menus_list->RowAction != "insertdelete" && !($Menus_list->RowAction == "insert" && $Menus->isConfirm() && $Menus_list->emptyRow())) {
?>
	<tr <?php echo $Menus->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Menus_list->ListOptions->render("body", "left", $Menus_list->RowCount);
?>
	<?php if ($Menus_list->Menu_Idn->Visible) { // Menu_Idn ?>
		<td data-name="Menu_Idn" <?php echo $Menus_list->Menu_Idn->cellAttributes() ?>>
<?php if ($Menus->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Menu_Idn" class="form-group"></span>
<input type="hidden" data-table="Menus" data-field="x_Menu_Idn" name="o<?php echo $Menus_list->RowIndex ?>_Menu_Idn" id="o<?php echo $Menus_list->RowIndex ?>_Menu_Idn" value="<?php echo HtmlEncode($Menus_list->Menu_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Menu_Idn" class="form-group">
<span<?php echo $Menus_list->Menu_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Menus_list->Menu_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Menus" data-field="x_Menu_Idn" name="x<?php echo $Menus_list->RowIndex ?>_Menu_Idn" id="x<?php echo $Menus_list->RowIndex ?>_Menu_Idn" value="<?php echo HtmlEncode($Menus_list->Menu_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Menu_Idn">
<span<?php echo $Menus_list->Menu_Idn->viewAttributes() ?>><?php echo $Menus_list->Menu_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Menus_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $Menus_list->Name->cellAttributes() ?>>
<?php if ($Menus->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Name" class="form-group">
<input type="text" data-table="Menus" data-field="x_Name" name="x<?php echo $Menus_list->RowIndex ?>_Name" id="x<?php echo $Menus_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_list->Name->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Name->EditValue ?>"<?php echo $Menus_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Name" name="o<?php echo $Menus_list->RowIndex ?>_Name" id="o<?php echo $Menus_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Menus_list->Name->OldValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Name" class="form-group">
<input type="text" data-table="Menus" data-field="x_Name" name="x<?php echo $Menus_list->RowIndex ?>_Name" id="x<?php echo $Menus_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_list->Name->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Name->EditValue ?>"<?php echo $Menus_list->Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Name">
<span<?php echo $Menus_list->Name->viewAttributes() ?>><?php echo $Menus_list->Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Menus_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName" <?php echo $Menus_list->ShortName->cellAttributes() ?>>
<?php if ($Menus->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ShortName" class="form-group">
<input type="text" data-table="Menus" data-field="x_ShortName" name="x<?php echo $Menus_list->RowIndex ?>_ShortName" id="x<?php echo $Menus_list->RowIndex ?>_ShortName" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($Menus_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $Menus_list->ShortName->EditValue ?>"<?php echo $Menus_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_ShortName" name="o<?php echo $Menus_list->RowIndex ?>_ShortName" id="o<?php echo $Menus_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($Menus_list->ShortName->OldValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ShortName" class="form-group">
<input type="text" data-table="Menus" data-field="x_ShortName" name="x<?php echo $Menus_list->RowIndex ?>_ShortName" id="x<?php echo $Menus_list->RowIndex ?>_ShortName" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($Menus_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $Menus_list->ShortName->EditValue ?>"<?php echo $Menus_list->ShortName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ShortName">
<span<?php echo $Menus_list->ShortName->viewAttributes() ?>><?php echo $Menus_list->ShortName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Menus_list->Link->Visible) { // Link ?>
		<td data-name="Link" <?php echo $Menus_list->Link->cellAttributes() ?>>
<?php if ($Menus->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Link" class="form-group">
<input type="text" data-table="Menus" data-field="x_Link" name="x<?php echo $Menus_list->RowIndex ?>_Link" id="x<?php echo $Menus_list->RowIndex ?>_Link" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Menus_list->Link->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Link->EditValue ?>"<?php echo $Menus_list->Link->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Link" name="o<?php echo $Menus_list->RowIndex ?>_Link" id="o<?php echo $Menus_list->RowIndex ?>_Link" value="<?php echo HtmlEncode($Menus_list->Link->OldValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Link" class="form-group">
<input type="text" data-table="Menus" data-field="x_Link" name="x<?php echo $Menus_list->RowIndex ?>_Link" id="x<?php echo $Menus_list->RowIndex ?>_Link" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Menus_list->Link->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Link->EditValue ?>"<?php echo $Menus_list->Link->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Link">
<span<?php echo $Menus_list->Link->viewAttributes() ?>><?php echo $Menus_list->Link->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Menus_list->Icon->Visible) { // Icon ?>
		<td data-name="Icon" <?php echo $Menus_list->Icon->cellAttributes() ?>>
<?php if ($Menus->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Icon" class="form-group">
<input type="text" data-table="Menus" data-field="x_Icon" name="x<?php echo $Menus_list->RowIndex ?>_Icon" id="x<?php echo $Menus_list->RowIndex ?>_Icon" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_list->Icon->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Icon->EditValue ?>"<?php echo $Menus_list->Icon->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Icon" name="o<?php echo $Menus_list->RowIndex ?>_Icon" id="o<?php echo $Menus_list->RowIndex ?>_Icon" value="<?php echo HtmlEncode($Menus_list->Icon->OldValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Icon" class="form-group">
<input type="text" data-table="Menus" data-field="x_Icon" name="x<?php echo $Menus_list->RowIndex ?>_Icon" id="x<?php echo $Menus_list->RowIndex ?>_Icon" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_list->Icon->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Icon->EditValue ?>"<?php echo $Menus_list->Icon->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Icon">
<span<?php echo $Menus_list->Icon->viewAttributes() ?>><?php echo $Menus_list->Icon->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Menus_list->MenuType_Idn->Visible) { // MenuType_Idn ?>
		<td data-name="MenuType_Idn" <?php echo $Menus_list->MenuType_Idn->cellAttributes() ?>>
<?php if ($Menus->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_MenuType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_MenuType_Idn" data-value-separator="<?php echo $Menus_list->MenuType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Menus_list->RowIndex ?>_MenuType_Idn" name="x<?php echo $Menus_list->RowIndex ?>_MenuType_Idn"<?php echo $Menus_list->MenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_list->MenuType_Idn->selectOptionListHtml("x{$Menus_list->RowIndex}_MenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_list->MenuType_Idn->Lookup->getParamTag($Menus_list, "p_x" . $Menus_list->RowIndex . "_MenuType_Idn") ?>
</span>
<input type="hidden" data-table="Menus" data-field="x_MenuType_Idn" name="o<?php echo $Menus_list->RowIndex ?>_MenuType_Idn" id="o<?php echo $Menus_list->RowIndex ?>_MenuType_Idn" value="<?php echo HtmlEncode($Menus_list->MenuType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_MenuType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_MenuType_Idn" data-value-separator="<?php echo $Menus_list->MenuType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Menus_list->RowIndex ?>_MenuType_Idn" name="x<?php echo $Menus_list->RowIndex ?>_MenuType_Idn"<?php echo $Menus_list->MenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_list->MenuType_Idn->selectOptionListHtml("x{$Menus_list->RowIndex}_MenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_list->MenuType_Idn->Lookup->getParamTag($Menus_list, "p_x" . $Menus_list->RowIndex . "_MenuType_Idn") ?>
</span>
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_MenuType_Idn">
<span<?php echo $Menus_list->MenuType_Idn->viewAttributes() ?>><?php echo $Menus_list->MenuType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Menus_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank" <?php echo $Menus_list->Rank->cellAttributes() ?>>
<?php if ($Menus->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Rank" class="form-group">
<input type="text" data-table="Menus" data-field="x_Rank" name="x<?php echo $Menus_list->RowIndex ?>_Rank" id="x<?php echo $Menus_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Menus_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Rank->EditValue ?>"<?php echo $Menus_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Rank" name="o<?php echo $Menus_list->RowIndex ?>_Rank" id="o<?php echo $Menus_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Menus_list->Rank->OldValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Rank" class="form-group">
<input type="text" data-table="Menus" data-field="x_Rank" name="x<?php echo $Menus_list->RowIndex ?>_Rank" id="x<?php echo $Menus_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Menus_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Rank->EditValue ?>"<?php echo $Menus_list->Rank->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_Rank">
<span<?php echo $Menus_list->Rank->viewAttributes() ?>><?php echo $Menus_list->Rank->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Menus_list->ChildMenuType_Idn->Visible) { // ChildMenuType_Idn ?>
		<td data-name="ChildMenuType_Idn" <?php echo $Menus_list->ChildMenuType_Idn->cellAttributes() ?>>
<?php if ($Menus->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ChildMenuType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_ChildMenuType_Idn" data-value-separator="<?php echo $Menus_list->ChildMenuType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn" name="x<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn"<?php echo $Menus_list->ChildMenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_list->ChildMenuType_Idn->selectOptionListHtml("x{$Menus_list->RowIndex}_ChildMenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_list->ChildMenuType_Idn->Lookup->getParamTag($Menus_list, "p_x" . $Menus_list->RowIndex . "_ChildMenuType_Idn") ?>
</span>
<input type="hidden" data-table="Menus" data-field="x_ChildMenuType_Idn" name="o<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn" id="o<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn" value="<?php echo HtmlEncode($Menus_list->ChildMenuType_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ChildMenuType_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_ChildMenuType_Idn" data-value-separator="<?php echo $Menus_list->ChildMenuType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn" name="x<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn"<?php echo $Menus_list->ChildMenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_list->ChildMenuType_Idn->selectOptionListHtml("x{$Menus_list->RowIndex}_ChildMenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_list->ChildMenuType_Idn->Lookup->getParamTag($Menus_list, "p_x" . $Menus_list->RowIndex . "_ChildMenuType_Idn") ?>
</span>
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ChildMenuType_Idn">
<span<?php echo $Menus_list->ChildMenuType_Idn->viewAttributes() ?>><?php echo $Menus_list->ChildMenuType_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Menus_list->IsParent->Visible) { // IsParent ?>
		<td data-name="IsParent" <?php echo $Menus_list->IsParent->cellAttributes() ?>>
<?php if ($Menus->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_IsParent" class="form-group">
<?php
$selwrk = ConvertToBool($Menus_list->IsParent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_IsParent" name="x<?php echo $Menus_list->RowIndex ?>_IsParent[]" id="x<?php echo $Menus_list->RowIndex ?>_IsParent[]_731543" value="1"<?php echo $selwrk ?><?php echo $Menus_list->IsParent->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_IsParent[]_731543"></label>
</div>
</span>
<input type="hidden" data-table="Menus" data-field="x_IsParent" name="o<?php echo $Menus_list->RowIndex ?>_IsParent[]" id="o<?php echo $Menus_list->RowIndex ?>_IsParent[]" value="<?php echo HtmlEncode($Menus_list->IsParent->OldValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_IsParent" class="form-group">
<?php
$selwrk = ConvertToBool($Menus_list->IsParent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_IsParent" name="x<?php echo $Menus_list->RowIndex ?>_IsParent[]" id="x<?php echo $Menus_list->RowIndex ?>_IsParent[]_250271" value="1"<?php echo $selwrk ?><?php echo $Menus_list->IsParent->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_IsParent[]_250271"></label>
</div>
</span>
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_IsParent">
<span<?php echo $Menus_list->IsParent->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsParent" class="custom-control-input" value="<?php echo $Menus_list->IsParent->getViewValue() ?>" disabled<?php if (ConvertToBool($Menus_list->IsParent->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsParent"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Menus_list->AdminOnly->Visible) { // AdminOnly ?>
		<td data-name="AdminOnly" <?php echo $Menus_list->AdminOnly->cellAttributes() ?>>
<?php if ($Menus->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_AdminOnly" class="form-group">
<?php
$selwrk = ConvertToBool($Menus_list->AdminOnly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_AdminOnly" name="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]" id="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]_910920" value="1"<?php echo $selwrk ?><?php echo $Menus_list->AdminOnly->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]_910920"></label>
</div>
</span>
<input type="hidden" data-table="Menus" data-field="x_AdminOnly" name="o<?php echo $Menus_list->RowIndex ?>_AdminOnly[]" id="o<?php echo $Menus_list->RowIndex ?>_AdminOnly[]" value="<?php echo HtmlEncode($Menus_list->AdminOnly->OldValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_AdminOnly" class="form-group">
<?php
$selwrk = ConvertToBool($Menus_list->AdminOnly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_AdminOnly" name="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]" id="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]_326005" value="1"<?php echo $selwrk ?><?php echo $Menus_list->AdminOnly->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]_326005"></label>
</div>
</span>
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_AdminOnly">
<span<?php echo $Menus_list->AdminOnly->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AdminOnly" class="custom-control-input" value="<?php echo $Menus_list->AdminOnly->getViewValue() ?>" disabled<?php if (ConvertToBool($Menus_list->AdminOnly->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AdminOnly"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Menus_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $Menus_list->ActiveFlag->cellAttributes() ?>>
<?php if ($Menus->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Menus_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_ActiveFlag" name="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]_412129" value="1"<?php echo $selwrk ?><?php echo $Menus_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]_412129"></label>
</div>
</span>
<input type="hidden" data-table="Menus" data-field="x_ActiveFlag" name="o<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Menus_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Menus_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_ActiveFlag" name="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]_282030" value="1"<?php echo $selwrk ?><?php echo $Menus_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]_282030"></label>
</div>
</span>
<?php } ?>
<?php if ($Menus->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Menus_list->RowCount ?>_Menus_ActiveFlag">
<span<?php echo $Menus_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Menus_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Menus_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Menus_list->ListOptions->render("body", "right", $Menus_list->RowCount);
?>
	</tr>
<?php if ($Menus->RowType == ROWTYPE_ADD || $Menus->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fMenuslist", "load"], function() {
	fMenuslist.updateLists(<?php echo $Menus_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Menus_list->isGridAdd())
		if (!$Menus_list->Recordset->EOF)
			$Menus_list->Recordset->moveNext();
}
?>
<?php
	if ($Menus_list->isGridAdd() || $Menus_list->isGridEdit()) {
		$Menus_list->RowIndex = '$rowindex$';
		$Menus_list->loadRowValues();

		// Set row properties
		$Menus->resetAttributes();
		$Menus->RowAttrs->merge(["data-rowindex" => $Menus_list->RowIndex, "id" => "r0_Menus", "data-rowtype" => ROWTYPE_ADD]);
		$Menus->RowAttrs->appendClass("ew-template");
		$Menus->RowType = ROWTYPE_ADD;

		// Render row
		$Menus_list->renderRow();

		// Render list options
		$Menus_list->renderListOptions();
		$Menus_list->StartRowCount = 0;
?>
	<tr <?php echo $Menus->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Menus_list->ListOptions->render("body", "left", $Menus_list->RowIndex);
?>
	<?php if ($Menus_list->Menu_Idn->Visible) { // Menu_Idn ?>
		<td data-name="Menu_Idn">
<span id="el$rowindex$_Menus_Menu_Idn" class="form-group Menus_Menu_Idn"></span>
<input type="hidden" data-table="Menus" data-field="x_Menu_Idn" name="o<?php echo $Menus_list->RowIndex ?>_Menu_Idn" id="o<?php echo $Menus_list->RowIndex ?>_Menu_Idn" value="<?php echo HtmlEncode($Menus_list->Menu_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->Name->Visible) { // Name ?>
		<td data-name="Name">
<span id="el$rowindex$_Menus_Name" class="form-group Menus_Name">
<input type="text" data-table="Menus" data-field="x_Name" name="x<?php echo $Menus_list->RowIndex ?>_Name" id="x<?php echo $Menus_list->RowIndex ?>_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_list->Name->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Name->EditValue ?>"<?php echo $Menus_list->Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Name" name="o<?php echo $Menus_list->RowIndex ?>_Name" id="o<?php echo $Menus_list->RowIndex ?>_Name" value="<?php echo HtmlEncode($Menus_list->Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->ShortName->Visible) { // ShortName ?>
		<td data-name="ShortName">
<span id="el$rowindex$_Menus_ShortName" class="form-group Menus_ShortName">
<input type="text" data-table="Menus" data-field="x_ShortName" name="x<?php echo $Menus_list->RowIndex ?>_ShortName" id="x<?php echo $Menus_list->RowIndex ?>_ShortName" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($Menus_list->ShortName->getPlaceHolder()) ?>" value="<?php echo $Menus_list->ShortName->EditValue ?>"<?php echo $Menus_list->ShortName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_ShortName" name="o<?php echo $Menus_list->RowIndex ?>_ShortName" id="o<?php echo $Menus_list->RowIndex ?>_ShortName" value="<?php echo HtmlEncode($Menus_list->ShortName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->Link->Visible) { // Link ?>
		<td data-name="Link">
<span id="el$rowindex$_Menus_Link" class="form-group Menus_Link">
<input type="text" data-table="Menus" data-field="x_Link" name="x<?php echo $Menus_list->RowIndex ?>_Link" id="x<?php echo $Menus_list->RowIndex ?>_Link" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Menus_list->Link->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Link->EditValue ?>"<?php echo $Menus_list->Link->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Link" name="o<?php echo $Menus_list->RowIndex ?>_Link" id="o<?php echo $Menus_list->RowIndex ?>_Link" value="<?php echo HtmlEncode($Menus_list->Link->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->Icon->Visible) { // Icon ?>
		<td data-name="Icon">
<span id="el$rowindex$_Menus_Icon" class="form-group Menus_Icon">
<input type="text" data-table="Menus" data-field="x_Icon" name="x<?php echo $Menus_list->RowIndex ?>_Icon" id="x<?php echo $Menus_list->RowIndex ?>_Icon" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Menus_list->Icon->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Icon->EditValue ?>"<?php echo $Menus_list->Icon->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Icon" name="o<?php echo $Menus_list->RowIndex ?>_Icon" id="o<?php echo $Menus_list->RowIndex ?>_Icon" value="<?php echo HtmlEncode($Menus_list->Icon->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->MenuType_Idn->Visible) { // MenuType_Idn ?>
		<td data-name="MenuType_Idn">
<span id="el$rowindex$_Menus_MenuType_Idn" class="form-group Menus_MenuType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_MenuType_Idn" data-value-separator="<?php echo $Menus_list->MenuType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Menus_list->RowIndex ?>_MenuType_Idn" name="x<?php echo $Menus_list->RowIndex ?>_MenuType_Idn"<?php echo $Menus_list->MenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_list->MenuType_Idn->selectOptionListHtml("x{$Menus_list->RowIndex}_MenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_list->MenuType_Idn->Lookup->getParamTag($Menus_list, "p_x" . $Menus_list->RowIndex . "_MenuType_Idn") ?>
</span>
<input type="hidden" data-table="Menus" data-field="x_MenuType_Idn" name="o<?php echo $Menus_list->RowIndex ?>_MenuType_Idn" id="o<?php echo $Menus_list->RowIndex ?>_MenuType_Idn" value="<?php echo HtmlEncode($Menus_list->MenuType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->Rank->Visible) { // Rank ?>
		<td data-name="Rank">
<span id="el$rowindex$_Menus_Rank" class="form-group Menus_Rank">
<input type="text" data-table="Menus" data-field="x_Rank" name="x<?php echo $Menus_list->RowIndex ?>_Rank" id="x<?php echo $Menus_list->RowIndex ?>_Rank" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Menus_list->Rank->getPlaceHolder()) ?>" value="<?php echo $Menus_list->Rank->EditValue ?>"<?php echo $Menus_list->Rank->editAttributes() ?>>
</span>
<input type="hidden" data-table="Menus" data-field="x_Rank" name="o<?php echo $Menus_list->RowIndex ?>_Rank" id="o<?php echo $Menus_list->RowIndex ?>_Rank" value="<?php echo HtmlEncode($Menus_list->Rank->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->ChildMenuType_Idn->Visible) { // ChildMenuType_Idn ?>
		<td data-name="ChildMenuType_Idn">
<span id="el$rowindex$_Menus_ChildMenuType_Idn" class="form-group Menus_ChildMenuType_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Menus" data-field="x_ChildMenuType_Idn" data-value-separator="<?php echo $Menus_list->ChildMenuType_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn" name="x<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn"<?php echo $Menus_list->ChildMenuType_Idn->editAttributes() ?>>
			<?php echo $Menus_list->ChildMenuType_Idn->selectOptionListHtml("x{$Menus_list->RowIndex}_ChildMenuType_Idn") ?>
		</select>
</div>
<?php echo $Menus_list->ChildMenuType_Idn->Lookup->getParamTag($Menus_list, "p_x" . $Menus_list->RowIndex . "_ChildMenuType_Idn") ?>
</span>
<input type="hidden" data-table="Menus" data-field="x_ChildMenuType_Idn" name="o<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn" id="o<?php echo $Menus_list->RowIndex ?>_ChildMenuType_Idn" value="<?php echo HtmlEncode($Menus_list->ChildMenuType_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->IsParent->Visible) { // IsParent ?>
		<td data-name="IsParent">
<span id="el$rowindex$_Menus_IsParent" class="form-group Menus_IsParent">
<?php
$selwrk = ConvertToBool($Menus_list->IsParent->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_IsParent" name="x<?php echo $Menus_list->RowIndex ?>_IsParent[]" id="x<?php echo $Menus_list->RowIndex ?>_IsParent[]_150164" value="1"<?php echo $selwrk ?><?php echo $Menus_list->IsParent->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_IsParent[]_150164"></label>
</div>
</span>
<input type="hidden" data-table="Menus" data-field="x_IsParent" name="o<?php echo $Menus_list->RowIndex ?>_IsParent[]" id="o<?php echo $Menus_list->RowIndex ?>_IsParent[]" value="<?php echo HtmlEncode($Menus_list->IsParent->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->AdminOnly->Visible) { // AdminOnly ?>
		<td data-name="AdminOnly">
<span id="el$rowindex$_Menus_AdminOnly" class="form-group Menus_AdminOnly">
<?php
$selwrk = ConvertToBool($Menus_list->AdminOnly->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_AdminOnly" name="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]" id="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]_745973" value="1"<?php echo $selwrk ?><?php echo $Menus_list->AdminOnly->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_AdminOnly[]_745973"></label>
</div>
</span>
<input type="hidden" data-table="Menus" data-field="x_AdminOnly" name="o<?php echo $Menus_list->RowIndex ?>_AdminOnly[]" id="o<?php echo $Menus_list->RowIndex ?>_AdminOnly[]" value="<?php echo HtmlEncode($Menus_list->AdminOnly->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Menus_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_Menus_ActiveFlag" class="form-group Menus_ActiveFlag">
<?php
$selwrk = ConvertToBool($Menus_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Menus" data-field="x_ActiveFlag" name="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]_163010" value="1"<?php echo $selwrk ?><?php echo $Menus_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]_163010"></label>
</div>
</span>
<input type="hidden" data-table="Menus" data-field="x_ActiveFlag" name="o<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Menus_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Menus_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Menus_list->ListOptions->render("body", "right", $Menus_list->RowIndex);
?>
<script>
loadjs.ready(["fMenuslist", "load"], function() {
	fMenuslist.updateLists(<?php echo $Menus_list->RowIndex ?>);
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
<?php if ($Menus_list->isAdd() || $Menus_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $Menus_list->FormKeyCountName ?>" id="<?php echo $Menus_list->FormKeyCountName ?>" value="<?php echo $Menus_list->KeyCount ?>">
<?php } ?>
<?php if ($Menus_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $Menus_list->FormKeyCountName ?>" id="<?php echo $Menus_list->FormKeyCountName ?>" value="<?php echo $Menus_list->KeyCount ?>">
<?php echo $Menus_list->MultiSelectKey ?>
<?php } ?>
<?php if ($Menus_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $Menus_list->FormKeyCountName ?>" id="<?php echo $Menus_list->FormKeyCountName ?>" value="<?php echo $Menus_list->KeyCount ?>">
<?php } ?>
<?php if ($Menus_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $Menus_list->FormKeyCountName ?>" id="<?php echo $Menus_list->FormKeyCountName ?>" value="<?php echo $Menus_list->KeyCount ?>">
<?php echo $Menus_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$Menus->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Menus_list->Recordset)
	$Menus_list->Recordset->Close();
?>
<?php if (!$Menus_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Menus_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Menus_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Menus_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Menus_list->TotalRecords == 0 && !$Menus->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Menus_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Menus_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Menus_list->isExport()) { ?>
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
$Menus_list->terminate();
?>