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
$SystemSubTypes_preview = new SystemSubTypes_preview();

// Run the page
$SystemSubTypes_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SystemSubTypes_preview->Page_Render();
?>
<?php $SystemSubTypes_preview->showPageHeader(); ?>
<?php if ($SystemSubTypes_preview->TotalRecords > 0) { ?>
<div class="card ew-grid SystemSubTypes"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$SystemSubTypes_preview->renderListOptions();

// Render list options (header, left)
$SystemSubTypes_preview->ListOptions->render("header", "left");
?>
<?php if ($SystemSubTypes_preview->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
	<?php if ($SystemSubTypes->SortUrl($SystemSubTypes_preview->SystemSubType_Idn) == "") { ?>
		<th class="<?php echo $SystemSubTypes_preview->SystemSubType_Idn->headerCellClass() ?>"><?php echo $SystemSubTypes_preview->SystemSubType_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $SystemSubTypes_preview->SystemSubType_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($SystemSubTypes_preview->SystemSubType_Idn->Name) ?>" data-sort-order="<?php echo $SystemSubTypes_preview->SortField == $SystemSubTypes_preview->SystemSubType_Idn->Name && $SystemSubTypes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_preview->SystemSubType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_preview->SortField == $SystemSubTypes_preview->SystemSubType_Idn->Name) { ?><?php if ($SystemSubTypes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_preview->SystemType_Idn->Visible) { // SystemType_Idn ?>
	<?php if ($SystemSubTypes->SortUrl($SystemSubTypes_preview->SystemType_Idn) == "") { ?>
		<th class="<?php echo $SystemSubTypes_preview->SystemType_Idn->headerCellClass() ?>"><?php echo $SystemSubTypes_preview->SystemType_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $SystemSubTypes_preview->SystemType_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($SystemSubTypes_preview->SystemType_Idn->Name) ?>" data-sort-order="<?php echo $SystemSubTypes_preview->SortField == $SystemSubTypes_preview->SystemType_Idn->Name && $SystemSubTypes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_preview->SystemType_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_preview->SortField == $SystemSubTypes_preview->SystemType_Idn->Name) { ?><?php if ($SystemSubTypes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_preview->Name->Visible) { // Name ?>
	<?php if ($SystemSubTypes->SortUrl($SystemSubTypes_preview->Name) == "") { ?>
		<th class="<?php echo $SystemSubTypes_preview->Name->headerCellClass() ?>"><?php echo $SystemSubTypes_preview->Name->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $SystemSubTypes_preview->Name->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($SystemSubTypes_preview->Name->Name) ?>" data-sort-order="<?php echo $SystemSubTypes_preview->SortField == $SystemSubTypes_preview->Name->Name && $SystemSubTypes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_preview->Name->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_preview->SortField == $SystemSubTypes_preview->Name->Name) { ?><?php if ($SystemSubTypes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_preview->Rank->Visible) { // Rank ?>
	<?php if ($SystemSubTypes->SortUrl($SystemSubTypes_preview->Rank) == "") { ?>
		<th class="<?php echo $SystemSubTypes_preview->Rank->headerCellClass() ?>"><?php echo $SystemSubTypes_preview->Rank->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $SystemSubTypes_preview->Rank->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($SystemSubTypes_preview->Rank->Name) ?>" data-sort-order="<?php echo $SystemSubTypes_preview->SortField == $SystemSubTypes_preview->Rank->Name && $SystemSubTypes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_preview->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_preview->SortField == $SystemSubTypes_preview->Rank->Name) { ?><?php if ($SystemSubTypes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SystemSubTypes_preview->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($SystemSubTypes->SortUrl($SystemSubTypes_preview->ActiveFlag) == "") { ?>
		<th class="<?php echo $SystemSubTypes_preview->ActiveFlag->headerCellClass() ?>"><?php echo $SystemSubTypes_preview->ActiveFlag->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $SystemSubTypes_preview->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($SystemSubTypes_preview->ActiveFlag->Name) ?>" data-sort-order="<?php echo $SystemSubTypes_preview->SortField == $SystemSubTypes_preview->ActiveFlag->Name && $SystemSubTypes_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $SystemSubTypes_preview->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($SystemSubTypes_preview->SortField == $SystemSubTypes_preview->ActiveFlag->Name) { ?><?php if ($SystemSubTypes_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($SystemSubTypes_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$SystemSubTypes_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$SystemSubTypes_preview->RecCount = 0;
$SystemSubTypes_preview->RowCount = 0;
while ($SystemSubTypes_preview->Recordset && !$SystemSubTypes_preview->Recordset->EOF) {

	// Init row class and style
	$SystemSubTypes_preview->RecCount++;
	$SystemSubTypes_preview->RowCount++;
	$SystemSubTypes_preview->CssStyle = "";
	$SystemSubTypes_preview->loadListRowValues($SystemSubTypes_preview->Recordset);

	// Render row
	$SystemSubTypes->RowType = ROWTYPE_PREVIEW; // Preview record
	$SystemSubTypes_preview->resetAttributes();
	$SystemSubTypes_preview->renderListRow();

	// Render list options
	$SystemSubTypes_preview->renderListOptions();
?>
	<tr <?php echo $SystemSubTypes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$SystemSubTypes_preview->ListOptions->render("body", "left", $SystemSubTypes_preview->RowCount);
?>
<?php if ($SystemSubTypes_preview->SystemSubType_Idn->Visible) { // SystemSubType_Idn ?>
		<!-- SystemSubType_Idn -->
		<td<?php echo $SystemSubTypes_preview->SystemSubType_Idn->cellAttributes() ?>>
<span<?php echo $SystemSubTypes_preview->SystemSubType_Idn->viewAttributes() ?>><?php echo $SystemSubTypes_preview->SystemSubType_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($SystemSubTypes_preview->SystemType_Idn->Visible) { // SystemType_Idn ?>
		<!-- SystemType_Idn -->
		<td<?php echo $SystemSubTypes_preview->SystemType_Idn->cellAttributes() ?>>
<span<?php echo $SystemSubTypes_preview->SystemType_Idn->viewAttributes() ?>><?php echo $SystemSubTypes_preview->SystemType_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($SystemSubTypes_preview->Name->Visible) { // Name ?>
		<!-- Name -->
		<td<?php echo $SystemSubTypes_preview->Name->cellAttributes() ?>>
<span<?php echo $SystemSubTypes_preview->Name->viewAttributes() ?>><?php echo $SystemSubTypes_preview->Name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($SystemSubTypes_preview->Rank->Visible) { // Rank ?>
		<!-- Rank -->
		<td<?php echo $SystemSubTypes_preview->Rank->cellAttributes() ?>>
<span<?php echo $SystemSubTypes_preview->Rank->viewAttributes() ?>><?php echo $SystemSubTypes_preview->Rank->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($SystemSubTypes_preview->ActiveFlag->Visible) { // ActiveFlag ?>
		<!-- ActiveFlag -->
		<td<?php echo $SystemSubTypes_preview->ActiveFlag->cellAttributes() ?>>
<span<?php echo $SystemSubTypes_preview->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $SystemSubTypes_preview->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($SystemSubTypes_preview->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$SystemSubTypes_preview->ListOptions->render("body", "right", $SystemSubTypes_preview->RowCount);
?>
	</tr>
<?php
	$SystemSubTypes_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $SystemSubTypes_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($SystemSubTypes_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($SystemSubTypes_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$SystemSubTypes_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($SystemSubTypes_preview->Recordset)
	$SystemSubTypes_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$SystemSubTypes_preview->terminate();
?>