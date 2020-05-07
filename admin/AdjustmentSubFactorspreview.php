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
$AdjustmentSubFactors_preview = new AdjustmentSubFactors_preview();

// Run the page
$AdjustmentSubFactors_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AdjustmentSubFactors_preview->Page_Render();
?>
<?php $AdjustmentSubFactors_preview->showPageHeader(); ?>
<?php if ($AdjustmentSubFactors_preview->TotalRecords > 0) { ?>
<div class="card ew-grid AdjustmentSubFactors"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$AdjustmentSubFactors_preview->renderListOptions();

// Render list options (header, left)
$AdjustmentSubFactors_preview->ListOptions->render("header", "left");
?>
<?php if ($AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
	<?php if ($AdjustmentSubFactors->SortUrl($AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn) == "") { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->headerCellClass() ?>"><?php echo $AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->Name) ?>" data-sort-order="<?php echo $AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->Name && $AdjustmentSubFactors_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->Name) { ?><?php if ($AdjustmentSubFactors_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
	<?php if ($AdjustmentSubFactors->SortUrl($AdjustmentSubFactors_preview->AdjustmentFactor_Idn) == "") { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->AdjustmentFactor_Idn->headerCellClass() ?>"><?php echo $AdjustmentSubFactors_preview->AdjustmentFactor_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->AdjustmentFactor_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($AdjustmentSubFactors_preview->AdjustmentFactor_Idn->Name) ?>" data-sort-order="<?php echo $AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->AdjustmentFactor_Idn->Name && $AdjustmentSubFactors_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_preview->AdjustmentFactor_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->AdjustmentFactor_Idn->Name) { ?><?php if ($AdjustmentSubFactors_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->Name->Visible) { // Name ?>
	<?php if ($AdjustmentSubFactors->SortUrl($AdjustmentSubFactors_preview->Name) == "") { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->Name->headerCellClass() ?>"><?php echo $AdjustmentSubFactors_preview->Name->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->Name->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($AdjustmentSubFactors_preview->Name->Name) ?>" data-sort-order="<?php echo $AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->Name->Name && $AdjustmentSubFactors_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_preview->Name->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->Name->Name) { ?><?php if ($AdjustmentSubFactors_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->Value->Visible) { // Value ?>
	<?php if ($AdjustmentSubFactors->SortUrl($AdjustmentSubFactors_preview->Value) == "") { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->Value->headerCellClass() ?>"><?php echo $AdjustmentSubFactors_preview->Value->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->Value->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($AdjustmentSubFactors_preview->Value->Name) ?>" data-sort-order="<?php echo $AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->Value->Name && $AdjustmentSubFactors_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_preview->Value->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->Value->Name) { ?><?php if ($AdjustmentSubFactors_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
	<?php if ($AdjustmentSubFactors->SortUrl($AdjustmentSubFactors_preview->LaborClass_Idn) == "") { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->LaborClass_Idn->headerCellClass() ?>"><?php echo $AdjustmentSubFactors_preview->LaborClass_Idn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->LaborClass_Idn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($AdjustmentSubFactors_preview->LaborClass_Idn->Name) ?>" data-sort-order="<?php echo $AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->LaborClass_Idn->Name && $AdjustmentSubFactors_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_preview->LaborClass_Idn->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->LaborClass_Idn->Name) { ?><?php if ($AdjustmentSubFactors_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->Rank->Visible) { // Rank ?>
	<?php if ($AdjustmentSubFactors->SortUrl($AdjustmentSubFactors_preview->Rank) == "") { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->Rank->headerCellClass() ?>"><?php echo $AdjustmentSubFactors_preview->Rank->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->Rank->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($AdjustmentSubFactors_preview->Rank->Name) ?>" data-sort-order="<?php echo $AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->Rank->Name && $AdjustmentSubFactors_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_preview->Rank->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->Rank->Name) { ?><?php if ($AdjustmentSubFactors_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->ActiveFlag->Visible) { // ActiveFlag ?>
	<?php if ($AdjustmentSubFactors->SortUrl($AdjustmentSubFactors_preview->ActiveFlag) == "") { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->ActiveFlag->headerCellClass() ?>"><?php echo $AdjustmentSubFactors_preview->ActiveFlag->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $AdjustmentSubFactors_preview->ActiveFlag->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($AdjustmentSubFactors_preview->ActiveFlag->Name) ?>" data-sort-order="<?php echo $AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->ActiveFlag->Name && $AdjustmentSubFactors_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AdjustmentSubFactors_preview->ActiveFlag->caption() ?></span><span class="ew-table-header-sort"><?php if ($AdjustmentSubFactors_preview->SortField == $AdjustmentSubFactors_preview->ActiveFlag->Name) { ?><?php if ($AdjustmentSubFactors_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($AdjustmentSubFactors_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$AdjustmentSubFactors_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$AdjustmentSubFactors_preview->RecCount = 0;
$AdjustmentSubFactors_preview->RowCount = 0;
while ($AdjustmentSubFactors_preview->Recordset && !$AdjustmentSubFactors_preview->Recordset->EOF) {

	// Init row class and style
	$AdjustmentSubFactors_preview->RecCount++;
	$AdjustmentSubFactors_preview->RowCount++;
	$AdjustmentSubFactors_preview->CssStyle = "";
	$AdjustmentSubFactors_preview->loadListRowValues($AdjustmentSubFactors_preview->Recordset);

	// Render row
	$AdjustmentSubFactors->RowType = ROWTYPE_PREVIEW; // Preview record
	$AdjustmentSubFactors_preview->resetAttributes();
	$AdjustmentSubFactors_preview->renderListRow();

	// Render list options
	$AdjustmentSubFactors_preview->renderListOptions();
?>
	<tr <?php echo $AdjustmentSubFactors->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AdjustmentSubFactors_preview->ListOptions->render("body", "left", $AdjustmentSubFactors_preview->RowCount);
?>
<?php if ($AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->Visible) { // AdjustmentSubFactor_Idn ?>
		<!-- AdjustmentSubFactor_Idn -->
		<td<?php echo $AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->cellAttributes() ?>>
<span<?php echo $AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_preview->AdjustmentSubFactor_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->AdjustmentFactor_Idn->Visible) { // AdjustmentFactor_Idn ?>
		<!-- AdjustmentFactor_Idn -->
		<td<?php echo $AdjustmentSubFactors_preview->AdjustmentFactor_Idn->cellAttributes() ?>>
<span<?php echo $AdjustmentSubFactors_preview->AdjustmentFactor_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_preview->AdjustmentFactor_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->Name->Visible) { // Name ?>
		<!-- Name -->
		<td<?php echo $AdjustmentSubFactors_preview->Name->cellAttributes() ?>>
<span<?php echo $AdjustmentSubFactors_preview->Name->viewAttributes() ?>><?php echo $AdjustmentSubFactors_preview->Name->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->Value->Visible) { // Value ?>
		<!-- Value -->
		<td<?php echo $AdjustmentSubFactors_preview->Value->cellAttributes() ?>>
<span<?php echo $AdjustmentSubFactors_preview->Value->viewAttributes() ?>><?php echo $AdjustmentSubFactors_preview->Value->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->LaborClass_Idn->Visible) { // LaborClass_Idn ?>
		<!-- LaborClass_Idn -->
		<td<?php echo $AdjustmentSubFactors_preview->LaborClass_Idn->cellAttributes() ?>>
<span<?php echo $AdjustmentSubFactors_preview->LaborClass_Idn->viewAttributes() ?>><?php echo $AdjustmentSubFactors_preview->LaborClass_Idn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->Rank->Visible) { // Rank ?>
		<!-- Rank -->
		<td<?php echo $AdjustmentSubFactors_preview->Rank->cellAttributes() ?>>
<span<?php echo $AdjustmentSubFactors_preview->Rank->viewAttributes() ?>><?php echo $AdjustmentSubFactors_preview->Rank->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($AdjustmentSubFactors_preview->ActiveFlag->Visible) { // ActiveFlag ?>
		<!-- ActiveFlag -->
		<td<?php echo $AdjustmentSubFactors_preview->ActiveFlag->cellAttributes() ?>>
<span<?php echo $AdjustmentSubFactors_preview->ActiveFlag->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ActiveFlag" class="custom-control-input" value="<?php echo $AdjustmentSubFactors_preview->ActiveFlag->getViewValue() ?>" disabled<?php if (ConvertToBool($AdjustmentSubFactors_preview->ActiveFlag->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ActiveFlag"></label></div></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$AdjustmentSubFactors_preview->ListOptions->render("body", "right", $AdjustmentSubFactors_preview->RowCount);
?>
	</tr>
<?php
	$AdjustmentSubFactors_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $AdjustmentSubFactors_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($AdjustmentSubFactors_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($AdjustmentSubFactors_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$AdjustmentSubFactors_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($AdjustmentSubFactors_preview->Recordset)
	$AdjustmentSubFactors_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$AdjustmentSubFactors_preview->terminate();
?>