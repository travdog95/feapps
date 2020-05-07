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
$WorksheetMasterSizes_preview = new WorksheetMasterSizes_preview();

// Run the page
$WorksheetMasterSizes_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorksheetMasterSizes_preview->Page_Render();
?>
<?php $WorksheetMasterSizes_preview->showPageHeader(); ?>
<?php if ($WorksheetMasterSizes_preview->TotalRecords > 0) { ?>
<div class="card ew-grid WorksheetMasterSizes"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$WorksheetMasterSizes_preview->renderListOptions();

// Render list options (header, left)
$WorksheetMasterSizes_preview->ListOptions->render("header", "left");
?>
<?php if ($WorksheetMasterSizes_preview->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
	<?php if ($WorksheetMasterSizes->SortUrl($WorksheetMasterSizes_preview->WorksheetMaster_Idn) == "") { ?>
		<th class="<?php echo $WorksheetMasterSizes_preview->WorksheetMaster_Idn->headerCellClass() ?>"><?php echo $WorksheetMasterSizes_preview->WorksheetMaster_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $WorksheetMasterSizes_preview->WorksheetMaster_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($WorksheetMasterSizes_preview->WorksheetMaster_Idn->Name) ?>" data-sort-order="<?php echo $WorksheetMasterSizes_preview->SortField == $WorksheetMasterSizes_preview->WorksheetMaster_Idn->Name && $WorksheetMasterSizes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterSizes_preview->WorksheetMaster_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterSizes_preview->SortField == $WorksheetMasterSizes_preview->WorksheetMaster_Idn->Name) { ?><?php if ($WorksheetMasterSizes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterSizes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorksheetMasterSizes_preview->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
	<?php if ($WorksheetMasterSizes->SortUrl($WorksheetMasterSizes_preview->ProductSize_Idn) == "") { ?>
		<th class="<?php echo $WorksheetMasterSizes_preview->ProductSize_Idn->headerCellClass() ?>"><?php echo $WorksheetMasterSizes_preview->ProductSize_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $WorksheetMasterSizes_preview->ProductSize_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($WorksheetMasterSizes_preview->ProductSize_Idn->Name) ?>" data-sort-order="<?php echo $WorksheetMasterSizes_preview->SortField == $WorksheetMasterSizes_preview->ProductSize_Idn->Name && $WorksheetMasterSizes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorksheetMasterSizes_preview->ProductSize_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorksheetMasterSizes_preview->SortField == $WorksheetMasterSizes_preview->ProductSize_Idn->Name) { ?><?php if ($WorksheetMasterSizes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($WorksheetMasterSizes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$WorksheetMasterSizes_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$WorksheetMasterSizes_preview->RecCount = 0;
$WorksheetMasterSizes_preview->RowCount = 0;
while ($WorksheetMasterSizes_preview->Recordset && !$WorksheetMasterSizes_preview->Recordset->EOF) {

	// Init row class and style
	$WorksheetMasterSizes_preview->RecCount++;
	$WorksheetMasterSizes_preview->RowCount++;
	$WorksheetMasterSizes_preview->CssStyle = "";
	$WorksheetMasterSizes_preview->loadListRowValues($WorksheetMasterSizes_preview->Recordset);

	// Render row
	$WorksheetMasterSizes->RowType = ROWTYPE_PREVIEW; // Preview record
	$WorksheetMasterSizes_preview->resetAttributes();
	$WorksheetMasterSizes_preview->renderListRow();

	// Render list options
	$WorksheetMasterSizes_preview->renderListOptions();
?>
	<tr <?php echo $WorksheetMasterSizes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorksheetMasterSizes_preview->ListOptions->render("body", "left", $WorksheetMasterSizes_preview->RowCount);
?>
<?php if ($WorksheetMasterSizes_preview->WorksheetMaster_Idn->Visible) { // WorksheetMaster_Idn ?>
		<!-- WorksheetMaster_Idn -->
		<td<?php echo $WorksheetMasterSizes_preview->WorksheetMaster_Idn->cellAttributes() ?>>
<span<?php echo $WorksheetMasterSizes_preview->WorksheetMaster_Idn->viewAttributes() ?>><?php echo $WorksheetMasterSizes_preview->WorksheetMaster_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($WorksheetMasterSizes_preview->ProductSize_Idn->Visible) { // ProductSize_Idn ?>
		<!-- ProductSize_Idn -->
		<td<?php echo $WorksheetMasterSizes_preview->ProductSize_Idn->cellAttributes() ?>>
<span<?php echo $WorksheetMasterSizes_preview->ProductSize_Idn->viewAttributes() ?>><?php echo $WorksheetMasterSizes_preview->ProductSize_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$WorksheetMasterSizes_preview->ListOptions->render("body", "right", $WorksheetMasterSizes_preview->RowCount);
?>
	</tr>
<?php
	$WorksheetMasterSizes_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $WorksheetMasterSizes_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($WorksheetMasterSizes_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($WorksheetMasterSizes_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$WorksheetMasterSizes_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($WorksheetMasterSizes_preview->Recordset)
	$WorksheetMasterSizes_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$WorksheetMasterSizes_preview->terminate();
?>