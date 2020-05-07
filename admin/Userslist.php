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
$Users_list = new Users_list();

// Run the page
$Users_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Users_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Users_list->isExport()) { ?>
<script>
var fUserslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fUserslist = currentForm = new ew.Form("fUserslist", "list");
	fUserslist.formKeyCountName = '<?php echo $Users_list->FormKeyCountName ?>';

	// Validate form
	fUserslist.validate = function() {
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
			<?php if ($Users_list->User_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_User_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_list->User_Idn->caption(), $Users_list->User_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_list->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_list->FirstName->caption(), $Users_list->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_list->LastName->Required) { ?>
				elm = this.getElements("x" + infix + "_LastName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_list->LastName->caption(), $Users_list->LastName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_list->UserName->Required) { ?>
				elm = this.getElements("x" + infix + "_UserName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_list->UserName->caption(), $Users_list->UserName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_list->Department_Idn->Required) { ?>
				elm = this.getElements("x" + infix + "_Department_Idn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_list->Department_Idn->caption(), $Users_list->Department_Idn->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_list->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_list->_Email->caption(), $Users_list->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_list->IsContractor->Required) { ?>
				elm = this.getElements("x" + infix + "_IsContractor[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_list->IsContractor->caption(), $Users_list->IsContractor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_list->IsAdmin->Required) { ?>
				elm = this.getElements("x" + infix + "_IsAdmin[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_list->IsAdmin->caption(), $Users_list->IsAdmin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Users_list->ActiveFlag->Required) { ?>
				elm = this.getElements("x" + infix + "_ActiveFlag[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Users_list->ActiveFlag->caption(), $Users_list->ActiveFlag->RequiredErrorMessage)) ?>");
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
	fUserslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "FirstName", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastName", false)) return false;
		if (ew.valueChanged(fobj, infix, "UserName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Department_Idn", false)) return false;
		if (ew.valueChanged(fobj, infix, "_Email", false)) return false;
		if (ew.valueChanged(fobj, infix, "IsContractor[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "IsAdmin[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ActiveFlag[]", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fUserslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fUserslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fUserslist.lists["x_Department_Idn"] = <?php echo $Users_list->Department_Idn->Lookup->toClientList($Users_list) ?>;
	fUserslist.lists["x_Department_Idn"].options = <?php echo JsonEncode($Users_list->Department_Idn->lookupOptions()) ?>;
	fUserslist.lists["x_IsContractor[]"] = <?php echo $Users_list->IsContractor->Lookup->toClientList($Users_list) ?>;
	fUserslist.lists["x_IsContractor[]"].options = <?php echo JsonEncode($Users_list->IsContractor->options(FALSE, TRUE)) ?>;
	fUserslist.lists["x_IsAdmin[]"] = <?php echo $Users_list->IsAdmin->Lookup->toClientList($Users_list) ?>;
	fUserslist.lists["x_IsAdmin[]"].options = <?php echo JsonEncode($Users_list->IsAdmin->options(FALSE, TRUE)) ?>;
	fUserslist.lists["x_ActiveFlag[]"] = <?php echo $Users_list->ActiveFlag->Lookup->toClientList($Users_list) ?>;
	fUserslist.lists["x_ActiveFlag[]"].options = <?php echo JsonEncode($Users_list->ActiveFlag->options(FALSE, TRUE)) ?>;
	loadjs.done("fUserslist");
});
var fUserslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fUserslistsrch = currentSearchForm = new ew.Form("fUserslistsrch");

	// Dynamic selection lists
	// Filters

	fUserslistsrch.filterList = <?php echo $Users_list->getFilterList() ?>;
	loadjs.done("fUserslistsrch");
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
<?php if (!$Users_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Users_list->TotalRecords > 0 && $Users_list->ExportOptions->visible()) { ?>
<?php $Users_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Users_list->ImportOptions->visible()) { ?>
<?php $Users_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Users_list->SearchOptions->visible()) { ?>
<?php $Users_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Users_list->FilterOptions->visible()) { ?>
<?php $Users_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Users_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Users_list->isExport() && !$Users->CurrentAction) { ?>
<form name="fUserslistsrch" id="fUserslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fUserslistsrch-search-panel" class="<?php echo $Users_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Users">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Users_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Users_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Users_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Users_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Users_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Users_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Users_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Users_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Users_list->showPageHeader(); ?>
<?php
$Users_list->showMessage();
?>
<?php if ($Users_list->TotalRecords > 0 || $Users->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Users_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Users">
<?php if (!$Users_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Users_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Users_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Users_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fUserslist" id="fUserslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Users">
<div id="gmp_Users" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Users_list->TotalRecords > 0 || $Users_list->isAdd() || $Users_list->isCopy() || $Users_list->isGridEdit()) { ?>
<table id="tbl_Userslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Users->RowType = ROWTYPE_HEADER;

// Render list options
$Users_list->renderListOptions();

// Render list options (header, left)
$Users_list->ListOptions->render("header", "left");
?>
<?php if ($Users_list->User_Idn->Visible) { // User_Idn ?>
	<?php if ($Users_list->SortUrl($Users_list->User_Idn) == "") { ?>
		<th data-name="User_Idn" class="<?php echo $Users_list->User_Idn->headerCellClass() ?>"><div id="elh_Users_User_Idn" class="Users_User_Idn"><div class="ew-table-header-caption"><?php echo $Users_list->User_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="User_Idn" class="<?php echo $Users_list->User_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Users_list->SortUrl($Users_list->User_Idn) ?>', 1);"><div id="elh_Users_User_Idn" class="Users_User_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Users_list->User_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Users_list->User_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Users_list->User_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Users_list->FirstName->Visible) { // FirstName ?>
	<?php if ($Users_list->SortUrl($Users_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $Users_list->FirstName->headerCellClass() ?>"><div id="elh_Users_FirstName" class="Users_FirstName"><div class="ew-table-header-caption"><?php echo $Users_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $Users_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Users_list->SortUrl($Users_list->FirstName) ?>', 1);"><div id="elh_Users_FirstName" class="Users_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Users_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Users_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Users_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Users_list->LastName->Visible) { // LastName ?>
	<?php if ($Users_list->SortUrl($Users_list->LastName) == "") { ?>
		<th data-name="LastName" class="<?php echo $Users_list->LastName->headerCellClass() ?>"><div id="elh_Users_LastName" class="Users_LastName"><div class="ew-table-header-caption"><?php echo $Users_list->LastName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastName" class="<?php echo $Users_list->LastName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Users_list->SortUrl($Users_list->LastName) ?>', 1);"><div id="elh_Users_LastName" class="Users_LastName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Users_list->LastName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Users_list->LastName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Users_list->LastName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Users_list->UserName->Visible) { // UserName ?>
	<?php if ($Users_list->SortUrl($Users_list->UserName) == "") { ?>
		<th data-name="UserName" class="<?php echo $Users_list->UserName->headerCellClass() ?>"><div id="elh_Users_UserName" class="Users_UserName"><div class="ew-table-header-caption"><?php echo $Users_list->UserName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserName" class="<?php echo $Users_list->UserName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Users_list->SortUrl($Users_list->UserName) ?>', 1);"><div id="elh_Users_UserName" class="Users_UserName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Users_list->UserName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Users_list->UserName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Users_list->UserName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Users_list->Department_Idn->Visible) { // Department_Idn ?>
	<?php if ($Users_list->SortUrl($Users_list->Department_Idn) == "") { ?>
		<th data-name="Department_Idn" class="<?php echo $Users_list->Department_Idn->headerCellClass() ?>"><div id="elh_Users_Department_Idn" class="Users_Department_Idn"><div class="ew-table-header-caption"><?php echo $Users_list->Department_Idn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Department_Idn" class="<?php echo $Users_list->Department_Idn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Users_list->SortUrl($Users_list->Department_Idn) ?>', 1);"><div id="elh_Users_Department_Idn" class="Users_Department_Idn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Users_list->Department_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($Users_list->Department_Idn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Users_list->Department_Idn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Users_list->_Email->Visible) { // Email ?>
	<?php if ($Users_list->SortUrl($Users_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $Users_list->_Email->headerCellClass() ?>"><div id="elh_Users__Email" class="Users__Email"><div class="ew-table-header-caption"><?php echo $Users_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $Users_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Users_list->SortUrl($Users_list->_Email) ?>', 1);"><div id="elh_Users__Email" class="Users__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Users_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Users_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Users_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Users_list->IsContractor->Visible) { // IsContractor ?>
	<?php if ($Users_list->SortUrl($Users_list->IsContractor) == "") { ?>
		<th data-name="IsContractor" class="<?php echo $Users_list->IsContractor->headerCellClass() ?>"><div id="elh_Users_IsContractor" class="Users_IsContractor"><div class="ew-table-header-caption"><?php echo $Users_list->IsContractor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsContractor" class="<?php echo $Users_list->IsContractor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Users_list->SortUrl($Users_list->IsContractor) ?>', 1);"><div id="elh_Users_IsContractor" class="Users_IsContractor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Users_list->IsContractor->caption() ?></span><span class="ew-table-header-sort"><?php if ($Users_list->IsContractor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Users_list->IsContractor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Users_list->IsAdmin->Visible) { // IsAdmin ?>
	<?php if ($Users_list->SortUrl($Users_list->IsAdmin) == "") { ?>
		<th data-name="IsAdmin" class="<?php echo $Users_list->IsAdmin->headerCellClass() ?>"><div id="elh_Users_IsAdmin" class="Users_IsAdmin"><div class="ew-table-header-caption"><?php echo $Users_list->IsAdmin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsAdmin" class="<?php echo $Users_list->IsAdmin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Users_list->SortUrl($Users_list->IsAdmin) ?>', 1);"><div id="elh_Users_IsAdmin" class="Users_IsAdmin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Users_list->IsAdmin->caption() ?></span><span class="ew-table-header-sort"><?php if ($Users_list->IsAdmin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Users_list->IsAdmin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Users_list->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($Users_list->SortUrl($Users_list->ActiveFlag) == "") { ?>
		<th data-name="ActiveFlag" class="<?php echo $Users_list->ActiveFlag->headerCellClass() ?>"><div id="elh_Users_ActiveFlag" class="Users_ActiveFlag"><div class="ew-table-header-caption"><?php echo $Users_list->ActiveFlag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActiveFlag" class="<?php echo $Users_list->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Users_list->SortUrl($Users_list->ActiveFlag) ?>', 1);"><div id="elh_Users_ActiveFlag" class="Users_ActiveFlag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Users_list->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($Users_list->ActiveFlag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Users_list->ActiveFlag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Users_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($Users_list->isAdd() || $Users_list->isCopy()) {
		$Users_list->RowIndex = 0;
		$Users_list->KeyCount = $Users_list->RowIndex;
		if ($Users_list->isCopy() && !$Users_list->loadRow())
			$Users->CurrentAction = "add";
		if ($Users_list->isAdd())
			$Users_list->loadRowValues();
		if ($Users->EventCancelled) // Insert failed
			$Users_list->restoreFormValues(); // Restore form values

		// Set row properties
		$Users->resetAttributes();
		$Users->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_Users", "data-rowtype" => ROWTYPE_ADD]);
		$Users->RowType = ROWTYPE_ADD;

		// Render row
		$Users_list->renderRow();

		// Render list options
		$Users_list->renderListOptions();
		$Users_list->StartRowCount = 0;
?>
	<tr <?php echo $Users->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Users_list->ListOptions->render("body", "left", $Users_list->RowCount);
?>
	<?php if ($Users_list->User_Idn->Visible) { // User_Idn ?>
		<td data-name="User_Idn">
<span id="el<?php echo $Users_list->RowCount ?>_Users_User_Idn" class="form-group Users_User_Idn"></span>
<input type="hidden" data-table="Users" data-field="x_User_Idn" name="o<?php echo $Users_list->RowIndex ?>_User_Idn" id="o<?php echo $Users_list->RowIndex ?>_User_Idn" value="<?php echo HtmlEncode($Users_list->User_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<span id="el<?php echo $Users_list->RowCount ?>_Users_FirstName" class="form-group Users_FirstName">
<input type="text" data-table="Users" data-field="x_FirstName" name="x<?php echo $Users_list->RowIndex ?>_FirstName" id="x<?php echo $Users_list->RowIndex ?>_FirstName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($Users_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $Users_list->FirstName->EditValue ?>"<?php echo $Users_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x_FirstName" name="o<?php echo $Users_list->RowIndex ?>_FirstName" id="o<?php echo $Users_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($Users_list->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->LastName->Visible) { // LastName ?>
		<td data-name="LastName">
<span id="el<?php echo $Users_list->RowCount ?>_Users_LastName" class="form-group Users_LastName">
<input type="text" data-table="Users" data-field="x_LastName" name="x<?php echo $Users_list->RowIndex ?>_LastName" id="x<?php echo $Users_list->RowIndex ?>_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Users_list->LastName->getPlaceHolder()) ?>" value="<?php echo $Users_list->LastName->EditValue ?>"<?php echo $Users_list->LastName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x_LastName" name="o<?php echo $Users_list->RowIndex ?>_LastName" id="o<?php echo $Users_list->RowIndex ?>_LastName" value="<?php echo HtmlEncode($Users_list->LastName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->UserName->Visible) { // UserName ?>
		<td data-name="UserName">
<span id="el<?php echo $Users_list->RowCount ?>_Users_UserName" class="form-group Users_UserName">
<input type="text" data-table="Users" data-field="x_UserName" name="x<?php echo $Users_list->RowIndex ?>_UserName" id="x<?php echo $Users_list->RowIndex ?>_UserName" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($Users_list->UserName->getPlaceHolder()) ?>" value="<?php echo $Users_list->UserName->EditValue ?>"<?php echo $Users_list->UserName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x_UserName" name="o<?php echo $Users_list->RowIndex ?>_UserName" id="o<?php echo $Users_list->RowIndex ?>_UserName" value="<?php echo HtmlEncode($Users_list->UserName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el<?php echo $Users_list->RowCount ?>_Users_Department_Idn" class="form-group Users_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Users" data-field="x_Department_Idn" data-value-separator="<?php echo $Users_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Users_list->RowIndex ?>_Department_Idn" name="x<?php echo $Users_list->RowIndex ?>_Department_Idn"<?php echo $Users_list->Department_Idn->editAttributes() ?>>
			<?php echo $Users_list->Department_Idn->selectOptionListHtml("x{$Users_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Users_list->Department_Idn->Lookup->getParamTag($Users_list, "p_x" . $Users_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="Users" data-field="x_Department_Idn" name="o<?php echo $Users_list->RowIndex ?>_Department_Idn" id="o<?php echo $Users_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($Users_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->_Email->Visible) { // Email ?>
		<td data-name="_Email">
<span id="el<?php echo $Users_list->RowCount ?>_Users__Email" class="form-group Users__Email">
<input type="text" data-table="Users" data-field="x__Email" name="x<?php echo $Users_list->RowIndex ?>__Email" id="x<?php echo $Users_list->RowIndex ?>__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Users_list->_Email->getPlaceHolder()) ?>" value="<?php echo $Users_list->_Email->EditValue ?>"<?php echo $Users_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x__Email" name="o<?php echo $Users_list->RowIndex ?>__Email" id="o<?php echo $Users_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($Users_list->_Email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->IsContractor->Visible) { // IsContractor ?>
		<td data-name="IsContractor">
<span id="el<?php echo $Users_list->RowCount ?>_Users_IsContractor" class="form-group Users_IsContractor">
<?php
$selwrk = ConvertToBool($Users_list->IsContractor->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsContractor" name="x<?php echo $Users_list->RowIndex ?>_IsContractor[]" id="x<?php echo $Users_list->RowIndex ?>_IsContractor[]_334615" value="1"<?php echo $selwrk ?><?php echo $Users_list->IsContractor->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_IsContractor[]_334615"></label>
</div>
</span>
<input type="hidden" data-table="Users" data-field="x_IsContractor" name="o<?php echo $Users_list->RowIndex ?>_IsContractor[]" id="o<?php echo $Users_list->RowIndex ?>_IsContractor[]" value="<?php echo HtmlEncode($Users_list->IsContractor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->IsAdmin->Visible) { // IsAdmin ?>
		<td data-name="IsAdmin">
<span id="el<?php echo $Users_list->RowCount ?>_Users_IsAdmin" class="form-group Users_IsAdmin">
<?php
$selwrk = ConvertToBool($Users_list->IsAdmin->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsAdmin" name="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]" id="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]_433043" value="1"<?php echo $selwrk ?><?php echo $Users_list->IsAdmin->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]_433043"></label>
</div>
</span>
<input type="hidden" data-table="Users" data-field="x_IsAdmin" name="o<?php echo $Users_list->RowIndex ?>_IsAdmin[]" id="o<?php echo $Users_list->RowIndex ?>_IsAdmin[]" value="<?php echo HtmlEncode($Users_list->IsAdmin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el<?php echo $Users_list->RowCount ?>_Users_ActiveFlag" class="form-group Users_ActiveFlag">
<?php
$selwrk = ConvertToBool($Users_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_ActiveFlag" name="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]_614527" value="1"<?php echo $selwrk ?><?php echo $Users_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]_614527"></label>
</div>
</span>
<input type="hidden" data-table="Users" data-field="x_ActiveFlag" name="o<?php echo $Users_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Users_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Users_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Users_list->ListOptions->render("body", "right", $Users_list->RowCount);
?>
<script>
loadjs.ready(["fUserslist", "load"], function() {
	fUserslist.updateLists(<?php echo $Users_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($Users_list->ExportAll && $Users_list->isExport()) {
	$Users_list->StopRecord = $Users_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Users_list->TotalRecords > $Users_list->StartRecord + $Users_list->DisplayRecords - 1)
		$Users_list->StopRecord = $Users_list->StartRecord + $Users_list->DisplayRecords - 1;
	else
		$Users_list->StopRecord = $Users_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($Users->isConfirm() || $Users_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Users_list->FormKeyCountName) && ($Users_list->isGridAdd() || $Users_list->isGridEdit() || $Users->isConfirm())) {
		$Users_list->KeyCount = $CurrentForm->getValue($Users_list->FormKeyCountName);
		$Users_list->StopRecord = $Users_list->StartRecord + $Users_list->KeyCount - 1;
	}
}
$Users_list->RecordCount = $Users_list->StartRecord - 1;
if ($Users_list->Recordset && !$Users_list->Recordset->EOF) {
	$Users_list->Recordset->moveFirst();
	$selectLimit = $Users_list->UseSelectLimit;
	if (!$selectLimit && $Users_list->StartRecord > 1)
		$Users_list->Recordset->move($Users_list->StartRecord - 1);
} elseif (!$Users->AllowAddDeleteRow && $Users_list->StopRecord == 0) {
	$Users_list->StopRecord = $Users->GridAddRowCount;
}

// Initialize aggregate
$Users->RowType = ROWTYPE_AGGREGATEINIT;
$Users->resetAttributes();
$Users_list->renderRow();
$Users_list->EditRowCount = 0;
if ($Users_list->isEdit())
	$Users_list->RowIndex = 1;
if ($Users_list->isGridAdd())
	$Users_list->RowIndex = 0;
if ($Users_list->isGridEdit())
	$Users_list->RowIndex = 0;
while ($Users_list->RecordCount < $Users_list->StopRecord) {
	$Users_list->RecordCount++;
	if ($Users_list->RecordCount >= $Users_list->StartRecord) {
		$Users_list->RowCount++;
		if ($Users_list->isGridAdd() || $Users_list->isGridEdit() || $Users->isConfirm()) {
			$Users_list->RowIndex++;
			$CurrentForm->Index = $Users_list->RowIndex;
			if ($CurrentForm->hasValue($Users_list->FormActionName) && ($Users->isConfirm() || $Users_list->EventCancelled))
				$Users_list->RowAction = strval($CurrentForm->getValue($Users_list->FormActionName));
			elseif ($Users_list->isGridAdd())
				$Users_list->RowAction = "insert";
			else
				$Users_list->RowAction = "";
		}

		// Set up key count
		$Users_list->KeyCount = $Users_list->RowIndex;

		// Init row class and style
		$Users->resetAttributes();
		$Users->CssClass = "";
		if ($Users_list->isGridAdd()) {
			$Users_list->loadRowValues(); // Load default values
		} else {
			$Users_list->loadRowValues($Users_list->Recordset); // Load row values
		}
		$Users->RowType = ROWTYPE_VIEW; // Render view
		if ($Users_list->isGridAdd()) // Grid add
			$Users->RowType = ROWTYPE_ADD; // Render add
		if ($Users_list->isGridAdd() && $Users->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Users_list->restoreCurrentRowFormValues($Users_list->RowIndex); // Restore form values
		if ($Users_list->isEdit()) {
			if ($Users_list->checkInlineEditKey() && $Users_list->EditRowCount == 0) { // Inline edit
				$Users->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($Users_list->isGridEdit()) { // Grid edit
			if ($Users->EventCancelled)
				$Users_list->restoreCurrentRowFormValues($Users_list->RowIndex); // Restore form values
			if ($Users_list->RowAction == "insert")
				$Users->RowType = ROWTYPE_ADD; // Render add
			else
				$Users->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Users_list->isEdit() && $Users->RowType == ROWTYPE_EDIT && $Users->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$Users_list->restoreFormValues(); // Restore form values
		}
		if ($Users_list->isGridEdit() && ($Users->RowType == ROWTYPE_EDIT || $Users->RowType == ROWTYPE_ADD) && $Users->EventCancelled) // Update failed
			$Users_list->restoreCurrentRowFormValues($Users_list->RowIndex); // Restore form values
		if ($Users->RowType == ROWTYPE_EDIT) // Edit row
			$Users_list->EditRowCount++;

		// Set up row id / data-rowindex
		$Users->RowAttrs->merge(["data-rowindex" => $Users_list->RowCount, "id" => "r" . $Users_list->RowCount . "_Users", "data-rowtype" => $Users->RowType]);

		// Render row
		$Users_list->renderRow();

		// Render list options
		$Users_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Users_list->RowAction != "delete" && $Users_list->RowAction != "insertdelete" && !($Users_list->RowAction == "insert" && $Users->isConfirm() && $Users_list->emptyRow())) {
?>
	<tr <?php echo $Users->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Users_list->ListOptions->render("body", "left", $Users_list->RowCount);
?>
	<?php if ($Users_list->User_Idn->Visible) { // User_Idn ?>
		<td data-name="User_Idn" <?php echo $Users_list->User_Idn->cellAttributes() ?>>
<?php if ($Users->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_User_Idn" class="form-group"></span>
<input type="hidden" data-table="Users" data-field="x_User_Idn" name="o<?php echo $Users_list->RowIndex ?>_User_Idn" id="o<?php echo $Users_list->RowIndex ?>_User_Idn" value="<?php echo HtmlEncode($Users_list->User_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_User_Idn" class="form-group">
<span<?php echo $Users_list->User_Idn->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Users_list->User_Idn->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Users" data-field="x_User_Idn" name="x<?php echo $Users_list->RowIndex ?>_User_Idn" id="x<?php echo $Users_list->RowIndex ?>_User_Idn" value="<?php echo HtmlEncode($Users_list->User_Idn->CurrentValue) ?>">
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_User_Idn">
<span<?php echo $Users_list->User_Idn->viewAttributes() ?>><?php echo $Users_list->User_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Users_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $Users_list->FirstName->cellAttributes() ?>>
<?php if ($Users->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_FirstName" class="form-group">
<input type="text" data-table="Users" data-field="x_FirstName" name="x<?php echo $Users_list->RowIndex ?>_FirstName" id="x<?php echo $Users_list->RowIndex ?>_FirstName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($Users_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $Users_list->FirstName->EditValue ?>"<?php echo $Users_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x_FirstName" name="o<?php echo $Users_list->RowIndex ?>_FirstName" id="o<?php echo $Users_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($Users_list->FirstName->OldValue) ?>">
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_FirstName" class="form-group">
<input type="text" data-table="Users" data-field="x_FirstName" name="x<?php echo $Users_list->RowIndex ?>_FirstName" id="x<?php echo $Users_list->RowIndex ?>_FirstName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($Users_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $Users_list->FirstName->EditValue ?>"<?php echo $Users_list->FirstName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_FirstName">
<span<?php echo $Users_list->FirstName->viewAttributes() ?>><?php echo $Users_list->FirstName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Users_list->LastName->Visible) { // LastName ?>
		<td data-name="LastName" <?php echo $Users_list->LastName->cellAttributes() ?>>
<?php if ($Users->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_LastName" class="form-group">
<input type="text" data-table="Users" data-field="x_LastName" name="x<?php echo $Users_list->RowIndex ?>_LastName" id="x<?php echo $Users_list->RowIndex ?>_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Users_list->LastName->getPlaceHolder()) ?>" value="<?php echo $Users_list->LastName->EditValue ?>"<?php echo $Users_list->LastName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x_LastName" name="o<?php echo $Users_list->RowIndex ?>_LastName" id="o<?php echo $Users_list->RowIndex ?>_LastName" value="<?php echo HtmlEncode($Users_list->LastName->OldValue) ?>">
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_LastName" class="form-group">
<input type="text" data-table="Users" data-field="x_LastName" name="x<?php echo $Users_list->RowIndex ?>_LastName" id="x<?php echo $Users_list->RowIndex ?>_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Users_list->LastName->getPlaceHolder()) ?>" value="<?php echo $Users_list->LastName->EditValue ?>"<?php echo $Users_list->LastName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_LastName">
<span<?php echo $Users_list->LastName->viewAttributes() ?>><?php echo $Users_list->LastName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Users_list->UserName->Visible) { // UserName ?>
		<td data-name="UserName" <?php echo $Users_list->UserName->cellAttributes() ?>>
<?php if ($Users->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_UserName" class="form-group">
<input type="text" data-table="Users" data-field="x_UserName" name="x<?php echo $Users_list->RowIndex ?>_UserName" id="x<?php echo $Users_list->RowIndex ?>_UserName" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($Users_list->UserName->getPlaceHolder()) ?>" value="<?php echo $Users_list->UserName->EditValue ?>"<?php echo $Users_list->UserName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x_UserName" name="o<?php echo $Users_list->RowIndex ?>_UserName" id="o<?php echo $Users_list->RowIndex ?>_UserName" value="<?php echo HtmlEncode($Users_list->UserName->OldValue) ?>">
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_UserName" class="form-group">
<input type="text" data-table="Users" data-field="x_UserName" name="x<?php echo $Users_list->RowIndex ?>_UserName" id="x<?php echo $Users_list->RowIndex ?>_UserName" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($Users_list->UserName->getPlaceHolder()) ?>" value="<?php echo $Users_list->UserName->EditValue ?>"<?php echo $Users_list->UserName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_UserName">
<span<?php echo $Users_list->UserName->viewAttributes() ?>><?php echo $Users_list->UserName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Users_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn" <?php echo $Users_list->Department_Idn->cellAttributes() ?>>
<?php if ($Users->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Users" data-field="x_Department_Idn" data-value-separator="<?php echo $Users_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Users_list->RowIndex ?>_Department_Idn" name="x<?php echo $Users_list->RowIndex ?>_Department_Idn"<?php echo $Users_list->Department_Idn->editAttributes() ?>>
			<?php echo $Users_list->Department_Idn->selectOptionListHtml("x{$Users_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Users_list->Department_Idn->Lookup->getParamTag($Users_list, "p_x" . $Users_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="Users" data-field="x_Department_Idn" name="o<?php echo $Users_list->RowIndex ?>_Department_Idn" id="o<?php echo $Users_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($Users_list->Department_Idn->OldValue) ?>">
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_Department_Idn" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Users" data-field="x_Department_Idn" data-value-separator="<?php echo $Users_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Users_list->RowIndex ?>_Department_Idn" name="x<?php echo $Users_list->RowIndex ?>_Department_Idn"<?php echo $Users_list->Department_Idn->editAttributes() ?>>
			<?php echo $Users_list->Department_Idn->selectOptionListHtml("x{$Users_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Users_list->Department_Idn->Lookup->getParamTag($Users_list, "p_x" . $Users_list->RowIndex . "_Department_Idn") ?>
</span>
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_Department_Idn">
<span<?php echo $Users_list->Department_Idn->viewAttributes() ?>><?php echo $Users_list->Department_Idn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Users_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $Users_list->_Email->cellAttributes() ?>>
<?php if ($Users->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users__Email" class="form-group">
<input type="text" data-table="Users" data-field="x__Email" name="x<?php echo $Users_list->RowIndex ?>__Email" id="x<?php echo $Users_list->RowIndex ?>__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Users_list->_Email->getPlaceHolder()) ?>" value="<?php echo $Users_list->_Email->EditValue ?>"<?php echo $Users_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x__Email" name="o<?php echo $Users_list->RowIndex ?>__Email" id="o<?php echo $Users_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($Users_list->_Email->OldValue) ?>">
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users__Email" class="form-group">
<input type="text" data-table="Users" data-field="x__Email" name="x<?php echo $Users_list->RowIndex ?>__Email" id="x<?php echo $Users_list->RowIndex ?>__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Users_list->_Email->getPlaceHolder()) ?>" value="<?php echo $Users_list->_Email->EditValue ?>"<?php echo $Users_list->_Email->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users__Email">
<span<?php echo $Users_list->_Email->viewAttributes() ?>><?php echo $Users_list->_Email->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Users_list->IsContractor->Visible) { // IsContractor ?>
		<td data-name="IsContractor" <?php echo $Users_list->IsContractor->cellAttributes() ?>>
<?php if ($Users->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_IsContractor" class="form-group">
<?php
$selwrk = ConvertToBool($Users_list->IsContractor->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsContractor" name="x<?php echo $Users_list->RowIndex ?>_IsContractor[]" id="x<?php echo $Users_list->RowIndex ?>_IsContractor[]_318710" value="1"<?php echo $selwrk ?><?php echo $Users_list->IsContractor->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_IsContractor[]_318710"></label>
</div>
</span>
<input type="hidden" data-table="Users" data-field="x_IsContractor" name="o<?php echo $Users_list->RowIndex ?>_IsContractor[]" id="o<?php echo $Users_list->RowIndex ?>_IsContractor[]" value="<?php echo HtmlEncode($Users_list->IsContractor->OldValue) ?>">
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_IsContractor" class="form-group">
<?php
$selwrk = ConvertToBool($Users_list->IsContractor->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsContractor" name="x<?php echo $Users_list->RowIndex ?>_IsContractor[]" id="x<?php echo $Users_list->RowIndex ?>_IsContractor[]_512382" value="1"<?php echo $selwrk ?><?php echo $Users_list->IsContractor->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_IsContractor[]_512382"></label>
</div>
</span>
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_IsContractor">
<span<?php echo $Users_list->IsContractor->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsContractor" class="custom-control-input" value="<?php echo $Users_list->IsContractor->getViewValue() ?>" disabled<?php if (ConvertToBool($Users_list->IsContractor->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsContractor"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Users_list->IsAdmin->Visible) { // IsAdmin ?>
		<td data-name="IsAdmin" <?php echo $Users_list->IsAdmin->cellAttributes() ?>>
<?php if ($Users->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_IsAdmin" class="form-group">
<?php
$selwrk = ConvertToBool($Users_list->IsAdmin->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsAdmin" name="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]" id="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]_453110" value="1"<?php echo $selwrk ?><?php echo $Users_list->IsAdmin->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]_453110"></label>
</div>
</span>
<input type="hidden" data-table="Users" data-field="x_IsAdmin" name="o<?php echo $Users_list->RowIndex ?>_IsAdmin[]" id="o<?php echo $Users_list->RowIndex ?>_IsAdmin[]" value="<?php echo HtmlEncode($Users_list->IsAdmin->OldValue) ?>">
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_IsAdmin" class="form-group">
<?php
$selwrk = ConvertToBool($Users_list->IsAdmin->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsAdmin" name="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]" id="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]_230781" value="1"<?php echo $selwrk ?><?php echo $Users_list->IsAdmin->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]_230781"></label>
</div>
</span>
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_IsAdmin">
<span<?php echo $Users_list->IsAdmin->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_IsAdmin" class="custom-control-input" value="<?php echo $Users_list->IsAdmin->getViewValue() ?>" disabled<?php if (ConvertToBool($Users_list->IsAdmin->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_IsAdmin"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Users_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag" <?php echo $Users_list->ActiveFlag->cellAttributes() ?>>
<?php if ($Users->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Users_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_ActiveFlag" name="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]_717518" value="1"<?php echo $selwrk ?><?php echo $Users_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]_717518"></label>
</div>
</span>
<input type="hidden" data-table="Users" data-field="x_ActiveFlag" name="o<?php echo $Users_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Users_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Users_list->ActiveFlag->OldValue) ?>">
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_ActiveFlag" class="form-group">
<?php
$selwrk = ConvertToBool($Users_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_ActiveFlag" name="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]_920347" value="1"<?php echo $selwrk ?><?php echo $Users_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]_920347"></label>
</div>
</span>
<?php } ?>
<?php if ($Users->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Users_list->RowCount ?>_Users_ActiveFlag">
<span<?php echo $Users_list->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $Users_list->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($Users_list->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Users_list->ListOptions->render("body", "right", $Users_list->RowCount);
?>
	</tr>
<?php if ($Users->RowType == ROWTYPE_ADD || $Users->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fUserslist", "load"], function() {
	fUserslist.updateLists(<?php echo $Users_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Users_list->isGridAdd())
		if (!$Users_list->Recordset->EOF)
			$Users_list->Recordset->moveNext();
}
?>
<?php
	if ($Users_list->isGridAdd() || $Users_list->isGridEdit()) {
		$Users_list->RowIndex = '$rowindex$';
		$Users_list->loadRowValues();

		// Set row properties
		$Users->resetAttributes();
		$Users->RowAttrs->merge(["data-rowindex" => $Users_list->RowIndex, "id" => "r0_Users", "data-rowtype" => ROWTYPE_ADD]);
		$Users->RowAttrs->appendClass("ew-template");
		$Users->RowType = ROWTYPE_ADD;

		// Render row
		$Users_list->renderRow();

		// Render list options
		$Users_list->renderListOptions();
		$Users_list->StartRowCount = 0;
?>
	<tr <?php echo $Users->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Users_list->ListOptions->render("body", "left", $Users_list->RowIndex);
?>
	<?php if ($Users_list->User_Idn->Visible) { // User_Idn ?>
		<td data-name="User_Idn">
<span id="el$rowindex$_Users_User_Idn" class="form-group Users_User_Idn"></span>
<input type="hidden" data-table="Users" data-field="x_User_Idn" name="o<?php echo $Users_list->RowIndex ?>_User_Idn" id="o<?php echo $Users_list->RowIndex ?>_User_Idn" value="<?php echo HtmlEncode($Users_list->User_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<span id="el$rowindex$_Users_FirstName" class="form-group Users_FirstName">
<input type="text" data-table="Users" data-field="x_FirstName" name="x<?php echo $Users_list->RowIndex ?>_FirstName" id="x<?php echo $Users_list->RowIndex ?>_FirstName" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($Users_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $Users_list->FirstName->EditValue ?>"<?php echo $Users_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x_FirstName" name="o<?php echo $Users_list->RowIndex ?>_FirstName" id="o<?php echo $Users_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($Users_list->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->LastName->Visible) { // LastName ?>
		<td data-name="LastName">
<span id="el$rowindex$_Users_LastName" class="form-group Users_LastName">
<input type="text" data-table="Users" data-field="x_LastName" name="x<?php echo $Users_list->RowIndex ?>_LastName" id="x<?php echo $Users_list->RowIndex ?>_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Users_list->LastName->getPlaceHolder()) ?>" value="<?php echo $Users_list->LastName->EditValue ?>"<?php echo $Users_list->LastName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x_LastName" name="o<?php echo $Users_list->RowIndex ?>_LastName" id="o<?php echo $Users_list->RowIndex ?>_LastName" value="<?php echo HtmlEncode($Users_list->LastName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->UserName->Visible) { // UserName ?>
		<td data-name="UserName">
<span id="el$rowindex$_Users_UserName" class="form-group Users_UserName">
<input type="text" data-table="Users" data-field="x_UserName" name="x<?php echo $Users_list->RowIndex ?>_UserName" id="x<?php echo $Users_list->RowIndex ?>_UserName" size="30" maxlength="16" placeholder="<?php echo HtmlEncode($Users_list->UserName->getPlaceHolder()) ?>" value="<?php echo $Users_list->UserName->EditValue ?>"<?php echo $Users_list->UserName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x_UserName" name="o<?php echo $Users_list->RowIndex ?>_UserName" id="o<?php echo $Users_list->RowIndex ?>_UserName" value="<?php echo HtmlEncode($Users_list->UserName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->Department_Idn->Visible) { // Department_Idn ?>
		<td data-name="Department_Idn">
<span id="el$rowindex$_Users_Department_Idn" class="form-group Users_Department_Idn">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Users" data-field="x_Department_Idn" data-value-separator="<?php echo $Users_list->Department_Idn->displayValueSeparatorAttribute() ?>" id="x<?php echo $Users_list->RowIndex ?>_Department_Idn" name="x<?php echo $Users_list->RowIndex ?>_Department_Idn"<?php echo $Users_list->Department_Idn->editAttributes() ?>>
			<?php echo $Users_list->Department_Idn->selectOptionListHtml("x{$Users_list->RowIndex}_Department_Idn") ?>
		</select>
</div>
<?php echo $Users_list->Department_Idn->Lookup->getParamTag($Users_list, "p_x" . $Users_list->RowIndex . "_Department_Idn") ?>
</span>
<input type="hidden" data-table="Users" data-field="x_Department_Idn" name="o<?php echo $Users_list->RowIndex ?>_Department_Idn" id="o<?php echo $Users_list->RowIndex ?>_Department_Idn" value="<?php echo HtmlEncode($Users_list->Department_Idn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->_Email->Visible) { // Email ?>
		<td data-name="_Email">
<span id="el$rowindex$_Users__Email" class="form-group Users__Email">
<input type="text" data-table="Users" data-field="x__Email" name="x<?php echo $Users_list->RowIndex ?>__Email" id="x<?php echo $Users_list->RowIndex ?>__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Users_list->_Email->getPlaceHolder()) ?>" value="<?php echo $Users_list->_Email->EditValue ?>"<?php echo $Users_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="Users" data-field="x__Email" name="o<?php echo $Users_list->RowIndex ?>__Email" id="o<?php echo $Users_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($Users_list->_Email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->IsContractor->Visible) { // IsContractor ?>
		<td data-name="IsContractor">
<span id="el$rowindex$_Users_IsContractor" class="form-group Users_IsContractor">
<?php
$selwrk = ConvertToBool($Users_list->IsContractor->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsContractor" name="x<?php echo $Users_list->RowIndex ?>_IsContractor[]" id="x<?php echo $Users_list->RowIndex ?>_IsContractor[]_180613" value="1"<?php echo $selwrk ?><?php echo $Users_list->IsContractor->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_IsContractor[]_180613"></label>
</div>
</span>
<input type="hidden" data-table="Users" data-field="x_IsContractor" name="o<?php echo $Users_list->RowIndex ?>_IsContractor[]" id="o<?php echo $Users_list->RowIndex ?>_IsContractor[]" value="<?php echo HtmlEncode($Users_list->IsContractor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->IsAdmin->Visible) { // IsAdmin ?>
		<td data-name="IsAdmin">
<span id="el$rowindex$_Users_IsAdmin" class="form-group Users_IsAdmin">
<?php
$selwrk = ConvertToBool($Users_list->IsAdmin->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_IsAdmin" name="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]" id="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]_116268" value="1"<?php echo $selwrk ?><?php echo $Users_list->IsAdmin->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_IsAdmin[]_116268"></label>
</div>
</span>
<input type="hidden" data-table="Users" data-field="x_IsAdmin" name="o<?php echo $Users_list->RowIndex ?>_IsAdmin[]" id="o<?php echo $Users_list->RowIndex ?>_IsAdmin[]" value="<?php echo HtmlEncode($Users_list->IsAdmin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Users_list->ActiveFlag->Visible) { // ActiveFlag ?>
		<td data-name="ActiveFlag">
<span id="el$rowindex$_Users_ActiveFlag" class="form-group Users_ActiveFlag">
<?php
$selwrk = ConvertToBool($Users_list->ActiveFlag->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Users" data-field="x_ActiveFlag" name="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]" id="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]_778807" value="1"<?php echo $selwrk ?><?php echo $Users_list->ActiveFlag->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $Users_list->RowIndex ?>_ActiveFlag[]_778807"></label>
</div>
</span>
<input type="hidden" data-table="Users" data-field="x_ActiveFlag" name="o<?php echo $Users_list->RowIndex ?>_ActiveFlag[]" id="o<?php echo $Users_list->RowIndex ?>_ActiveFlag[]" value="<?php echo HtmlEncode($Users_list->ActiveFlag->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Users_list->ListOptions->render("body", "right", $Users_list->RowIndex);
?>
<script>
loadjs.ready(["fUserslist", "load"], function() {
	fUserslist.updateLists(<?php echo $Users_list->RowIndex ?>);
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
<?php if ($Users_list->isAdd() || $Users_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $Users_list->FormKeyCountName ?>" id="<?php echo $Users_list->FormKeyCountName ?>" value="<?php echo $Users_list->KeyCount ?>">
<?php } ?>
<?php if ($Users_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $Users_list->FormKeyCountName ?>" id="<?php echo $Users_list->FormKeyCountName ?>" value="<?php echo $Users_list->KeyCount ?>">
<?php echo $Users_list->MultiSelectKey ?>
<?php } ?>
<?php if ($Users_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $Users_list->FormKeyCountName ?>" id="<?php echo $Users_list->FormKeyCountName ?>" value="<?php echo $Users_list->KeyCount ?>">
<?php } ?>
<?php if ($Users_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $Users_list->FormKeyCountName ?>" id="<?php echo $Users_list->FormKeyCountName ?>" value="<?php echo $Users_list->KeyCount ?>">
<?php echo $Users_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$Users->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Users_list->Recordset)
	$Users_list->Recordset->Close();
?>
<?php if (!$Users_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Users_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Users_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Users_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Users_list->TotalRecords == 0 && !$Users->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Users_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Users_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Users_list->isExport()) { ?>
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
$Users_list->terminate();
?>