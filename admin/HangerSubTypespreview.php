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
$HangerSubTypes_preview = new HangerSubTypes_preview();

// Run the page
$HangerSubTypes_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$HangerSubTypes_preview->Page_Render();
?>
<?php $HangerSubTypes_preview->showPageHeader(); ?>
<?php if ($HangerSubTypes_preview->TotalRecords > 0) { ?>
<div class="card ew-grid HangerSubTypes"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$HangerSubTypes_preview->renderListOptions();

// Render list options (header, left)
$HangerSubTypes_preview->ListOptions->render("header", "left");
?>
<?php if ($HangerSubTypes_preview->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
	<?php if ($HangerSubTypes->SortUrl($HangerSubTypes_preview->HangerSubType_Idn) == "") { ?>
		<th class="<?php echo $HangerSubTypes_preview->HangerSubType_Idn->headerCellClass() ?>"><?php echo $HangerSubTypes_preview->HangerSubType_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $HangerSubTypes_preview->HangerSubType_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($HangerSubTypes_preview->HangerSubType_Idn->Name) ?>" data-sort-order="<?php echo $HangerSubTypes_preview->SortField == $HangerSubTypes_preview->HangerSubType_Idn->Name && $HangerSubTypes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_preview->HangerSubType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_preview->SortField == $HangerSubTypes_preview->HangerSubType_Idn->Name) { ?><?php if ($HangerSubTypes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_preview->HangerType_Idn->Visible) { // HangerType_Idn ?>
	<?php if ($HangerSubTypes->SortUrl($HangerSubTypes_preview->HangerType_Idn) == "") { ?>
		<th class="<?php echo $HangerSubTypes_preview->HangerType_Idn->headerCellClass() ?>"><?php echo $HangerSubTypes_preview->HangerType_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $HangerSubTypes_preview->HangerType_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($HangerSubTypes_preview->HangerType_Idn->Name) ?>" data-sort-order="<?php echo $HangerSubTypes_preview->SortField == $HangerSubTypes_preview->HangerType_Idn->Name && $HangerSubTypes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_preview->HangerType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_preview->SortField == $HangerSubTypes_preview->HangerType_Idn->Name) { ?><?php if ($HangerSubTypes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_preview->Name->Visible) { // Name ?>
	<?php if ($HangerSubTypes->SortUrl($HangerSubTypes_preview->Name) == "") { ?>
		<th class="<?php echo $HangerSubTypes_preview->Name->headerCellClass() ?>"><?php echo $HangerSubTypes_preview->Name->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $HangerSubTypes_preview->Name->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($HangerSubTypes_preview->Name->Name) ?>" data-sort-order="<?php echo $HangerSubTypes_preview->SortField == $HangerSubTypes_preview->Name->Name && $HangerSubTypes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_preview->Name->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_preview->SortField == $HangerSubTypes_preview->Name->Name) { ?><?php if ($HangerSubTypes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_preview->Rank->Visible) { // Rank ?>
	<?php if ($HangerSubTypes->SortUrl($HangerSubTypes_preview->Rank) == "") { ?>
		<th class="<?php echo $HangerSubTypes_preview->Rank->headerCellClass() ?>"><?php echo $HangerSubTypes_preview->Rank->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $HangerSubTypes_preview->Rank->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($HangerSubTypes_preview->Rank->Name) ?>" data-sort-order="<?php echo $HangerSubTypes_preview->SortField == $HangerSubTypes_preview->Rank->Name && $HangerSubTypes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_preview->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_preview->SortField == $HangerSubTypes_preview->Rank->Name) { ?><?php if ($HangerSubTypes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($HangerSubTypes_preview->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($HangerSubTypes->SortUrl($HangerSubTypes_preview->ActiveFlag) == "") { ?>
		<th class="<?php echo $HangerSubTypes_preview->ActiveFlag->headerCellClass() ?>"><?php echo $HangerSubTypes_preview->ActiveFlag->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $HangerSubTypes_preview->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($HangerSubTypes_preview->ActiveFlag->Name) ?>" data-sort-order="<?php echo $HangerSubTypes_preview->SortField == $HangerSubTypes_preview->ActiveFlag->Name && $HangerSubTypes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $HangerSubTypes_preview->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($HangerSubTypes_preview->SortField == $HangerSubTypes_preview->ActiveFlag->Name) { ?><?php if ($HangerSubTypes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($HangerSubTypes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$HangerSubTypes_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$HangerSubTypes_preview->RecCount = 0;
$HangerSubTypes_preview->RowCount = 0;
while ($HangerSubTypes_preview->Recordset && !$HangerSubTypes_preview->Recordset->EOF) {

	// Init row class and style
	$HangerSubTypes_preview->RecCount++;
	$HangerSubTypes_preview->RowCount++;
	$HangerSubTypes_preview->CssStyle = "";
	$HangerSubTypes_preview->loadListRowValues($HangerSubTypes_preview->Recordset);

	// Render row
	$HangerSubTypes->RowType = ROWTYPE_PREVIEW; // Preview record
	$HangerSubTypes_preview->resetAttributes();
	$HangerSubTypes_preview->renderListRow();

	// Render list options
	$HangerSubTypes_preview->renderListOptions();
?>
	<tr <?php echo $HangerSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$HangerSubTypes_preview->ListOptions->render("body", "left", $HangerSubTypes_preview->RowCount);
?>
<?php if ($HangerSubTypes_preview->HangerSubType_Idn->Visible) { // HangerSubType_Idn ?>
		<!-- HangerSubType_Idn -->
		<td<?php echo $HangerSubTypes_preview->HangerSubType_Idn->cellAttributes() ?>>
<span<?php echo $HangerSubTypes_preview->HangerSubType_Idn->viewAttributes() ?>><?php echo $HangerSubTypes_preview->HangerSubType_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($HangerSubTypes_preview->HangerType_Idn->Visible) { // HangerType_Idn ?>
		<!-- HangerType_Idn -->
		<td<?php echo $HangerSubTypes_preview->HangerType_Idn->cellAttributes() ?>>
<span<?php echo $HangerSubTypes_preview->HangerType_Idn->viewAttributes() ?>><?php echo $HangerSubTypes_preview->HangerType_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($HangerSubTypes_preview->Name->Visible) { // Name ?>
		<!-- Name -->
		<td<?php echo $HangerSubTypes_preview->Name->cellAttributes() ?>>
<span<?php echo $HangerSubTypes_preview->Name->viewAttributes() ?>><?php echo $HangerSubTypes_preview->Name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($HangerSubTypes_preview->Rank->Visible) { // Rank ?>
		<!-- Rank -->
		<td<?php echo $HangerSubTypes_preview->Rank->cellAttributes() ?>>
<span<?php echo $HangerSubTypes_preview->Rank->viewAttributes() ?>><?php echo $HangerSubTypes_preview->Rank->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($HangerSubTypes_preview->ActiveFlag->Visible) { // ActiveFlag ?>
		<!-- ActiveFlag -->
		<td<?php echo $HangerSubTypes_preview->ActiveFlag->cellAttributes() ?>>
<span<?php echo $HangerSubTypes_preview->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $HangerSubTypes_preview->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($HangerSubTypes_preview->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$HangerSubTypes_preview->ListOptions->render("body", "right", $HangerSubTypes_preview->RowCount);
?>
	</tr>
<?php
	$HangerSubTypes_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $HangerSubTypes_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($HangerSubTypes_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($HangerSubTypes_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$HangerSubTypes_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($HangerSubTypes_preview->Recordset)
	$HangerSubTypes_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$HangerSubTypes_preview->terminate();
?>