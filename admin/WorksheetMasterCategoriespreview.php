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
WriteHeader(FALSE, "utf-8");

// Create page object
$WorksheetMasterCategories_preview = new WorksheetMasterCategories_preview();

// Run the page
$WorksheetMasterCategories_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasterCategories_preview->Page_Render();
?>
<?php $WorksheetMasterCategories_preview->showPageHeader(); ?>
<?php if ($WorksheetMasterCategories_preview->TotalRecords > 0) { ?>
<div class="card ew-grid WorksheetMasterCategories"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$WorksheetMasterCategories_preview->renderListOptions();

// Render list options (header, left)
$WorksheetMasterCategories_preview->ListOptions->render("header", "left");
?>
<?php if ($WorksheetMasterCategories_preview->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($WorksheetMasterCategories->SortUrl($WorksheetMasterCategories_preview->WorksheetMaster_Idn) == "") { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->WorksheetMaster_Idn->headerCellClass() ?>"><?php echo $WorksheetMasterCategories_preview->WorksheetMaster_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($WorksheetMasterCategories_preview->WorksheetMaster_Idn->Name) ?>" data-sort-order="<?php echo $WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->WorksheetMaster_Idn->Name && $WorksheetMasterCategories_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_preview->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->WorksheetMaster_Idn->Name) { ?><?php if ($WorksheetMasterCategories_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
	<?php if ($WorksheetMasterCategories->SortUrl($WorksheetMasterCategories_preview->WorksheetCategory_Idn) == "") { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->WorksheetCategory_Idn->headerCellClass() ?>"><?php echo $WorksheetMasterCategories_preview->WorksheetCategory_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->WorksheetCategory_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($WorksheetMasterCategories_preview->WorksheetCategory_Idn->Name) ?>" data-sort-order="<?php echo $WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->WorksheetCategory_Idn->Name && $WorksheetMasterCategories_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_preview->WorksheetCategory_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->WorksheetCategory_Idn->Name) { ?><?php if ($WorksheetMasterCategories_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->Rank->Visible) { // Rank ?>
	<?php if ($WorksheetMasterCategories->SortUrl($WorksheetMasterCategories_preview->Rank) == "") { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->Rank->headerCellClass() ?>"><?php echo $WorksheetMasterCategories_preview->Rank->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->Rank->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($WorksheetMasterCategories_preview->Rank->Name) ?>" data-sort-order="<?php echo $WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->Rank->Name && $WorksheetMasterCategories_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_preview->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->Rank->Name) { ?><?php if ($WorksheetMasterCategories_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
	<?php if ($WorksheetMasterCategories->SortUrl($WorksheetMasterCategories_preview->AutoLoadFlag) == "") { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->AutoLoadFlag->headerCellClass() ?>"><?php echo $WorksheetMasterCategories_preview->AutoLoadFlag->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->AutoLoadFlag->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($WorksheetMasterCategories_preview->AutoLoadFlag->Name) ?>" data-sort-order="<?php echo $WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->AutoLoadFlag->Name && $WorksheetMasterCategories_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_preview->AutoLoadFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->AutoLoadFlag->Name) { ?><?php if ($WorksheetMasterCategories_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->LoadFlag->Visible) { // LoadFlag ?>
	<?php if ($WorksheetMasterCategories->SortUrl($WorksheetMasterCategories_preview->LoadFlag) == "") { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->LoadFlag->headerCellClass() ?>"><?php echo $WorksheetMasterCategories_preview->LoadFlag->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->LoadFlag->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($WorksheetMasterCategories_preview->LoadFlag->Name) ?>" data-sort-order="<?php echo $WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->LoadFlag->Name && $WorksheetMasterCategories_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_preview->LoadFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->LoadFlag->Name) { ?><?php if ($WorksheetMasterCategories_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->AddMiscFlag->Visible) { // AddMiscFlag ?>
	<?php if ($WorksheetMasterCategories->SortUrl($WorksheetMasterCategories_preview->AddMiscFlag) == "") { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->AddMiscFlag->headerCellClass() ?>"><?php echo $WorksheetMasterCategories_preview->AddMiscFlag->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->AddMiscFlag->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($WorksheetMasterCategories_preview->AddMiscFlag->Name) ?>" data-sort-order="<?php echo $WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->AddMiscFlag->Name && $WorksheetMasterCategories_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_preview->AddMiscFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->AddMiscFlag->Name) { ?><?php if ($WorksheetMasterCategories_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
	<?php if ($WorksheetMasterCategories->SortUrl($WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn) == "") { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->headerCellClass() ?>"><?php echo $WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->Name) ?>" data-sort-order="<?php echo $WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->Name && $WorksheetMasterCategories_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterCategories_preview->SortField == $WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->Name) { ?><?php if ($WorksheetMasterCategories_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterCategories_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$WorksheetMasterCategories_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$WorksheetMasterCategories_preview->RecCount = 0;
$WorksheetMasterCategories_preview->RowCount = 0;
while ($WorksheetMasterCategories_preview->Recordset && !$WorksheetMasterCategories_preview->Recordset->EOF) {

	// Init row class and style
	$WorksheetMasterCategories_preview->RecCount++;
	$WorksheetMasterCategories_preview->RowCount++;
	$WorksheetMasterCategories_preview->CssStyle = "";
	$WorksheetMasterCategories_preview->loadListRowValues($WorksheetMasterCategories_preview->Recordset);

	// Render row
	$WorksheetMasterCategories->RowType = ROWTYPE_PREVIEW; // Preview record
	$WorksheetMasterCategories_preview->resetAttributes();
	$WorksheetMasterCategories_preview->renderListRow();

	// Render list options
	$WorksheetMasterCategories_preview->renderListOptions();
?>
	<tr <?php echo $WorksheetMasterCategories->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterCategories_preview->ListOptions->render("body", "left", $WorksheetMasterCategories_preview->RowCount);
?>
<?php if ($WorksheetMasterCategories_preview->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<!-- WorksheetMaster_Idn -->
		<td<?php echo $WorksheetMasterCategories_preview->WorksheetMaster_Idn->cellAttributes() ?>>
<span<?php echo $WorksheetMasterCategories_preview->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_preview->WorksheetMaster_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->WorksheetCategory_Idn->Visible) { // WorksheetCategory_Idn ?>
		<!-- WorksheetCategory_Idn -->
		<td<?php echo $WorksheetMasterCategories_preview->WorksheetCategory_Idn->cellAttributes() ?>>
<span<?php echo $WorksheetMasterCategories_preview->WorksheetCategory_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_preview->WorksheetCategory_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->Rank->Visible) { // Rank ?>
		<!-- Rank -->
		<td<?php echo $WorksheetMasterCategories_preview->Rank->cellAttributes() ?>>
<span<?php echo $WorksheetMasterCategories_preview->Rank->viewAttributes() ?>><?php echo $WorksheetMasterCategories_preview->Rank->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->AutoLoadFlag->Visible) { // AutoLoadFlag ?>
		<!-- AutoLoadFlag -->
		<td<?php echo $WorksheetMasterCategories_preview->AutoLoadFlag->cellAttributes() ?>>
<span<?php echo $WorksheetMasterCategories_preview->AutoLoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AutoLoadFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_preview->AutoLoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_preview->AutoLoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AutoLoadFlag"></label></div></span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->LoadFlag->Visible) { // LoadFlag ?>
		<!-- LoadFlag -->
		<td<?php echo $WorksheetMasterCategories_preview->LoadFlag->cellAttributes() ?>>
<span<?php echo $WorksheetMasterCategories_preview->LoadFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LoadFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_preview->LoadFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_preview->LoadFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LoadFlag"></label></div></span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->AddMiscFlag->Visible) { // AddMiscFlag ?>
		<!-- AddMiscFlag -->
		<td<?php echo $WorksheetMasterCategories_preview->AddMiscFlag->cellAttributes() ?>>
<span<?php echo $WorksheetMasterCategories_preview->AddMiscFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AddMiscFlag" class="custom-control-input" value="<?php echo $WorksheetMasterCategories_preview->AddMiscFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($WorksheetMasterCategories_preview->AddMiscFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AddMiscFlag"></label></div></span>
</td>
<?php } ?>
<?php if ($WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->Visible) { // ChildWorksheetMaster_Idn ?>
		<!-- ChildWorksheetMaster_Idn -->
		<td<?php echo $WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->cellAttributes() ?>>
<span<?php echo $WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterCategories_preview->ChildWorksheetMaster_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterCategories_preview->ListOptions->render("body", "right", $WorksheetMasterCategories_preview->RowCount);
?>
	</tr>
<?php
	$WorksheetMasterCategories_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $WorksheetMasterCategories_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($WorksheetMasterCategories_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($WorksheetMasterCategories_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$WorksheetMasterCategories_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($WorksheetMasterCategories_preview->Recordset)
	$WorksheetMasterCategories_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$WorksheetMasterCategories_preview->terminate();
?>