<?php
$row_title = (!empty($Row['ShortName'])) ? $Row['ShortName'] : $Row['Name'];
$copy_link = "";
?>

<tr id="Category<?php echo $Row['WorksheetCategory_Idn']; ?>" class="Category bold danger" data-LoadFlag="<?php echo $Row['LoadFlag']; ?>" data-AutoLoadFlag="<?php echo $Row['AutoLoadFlag']; ?>" data-ChildWorksheetMaster_Idn="<?php echo ($Row['ChildWorksheetMaster_Idn'] == null) ? 0 : $Row['ChildWorksheetMaster_Idn']; ?>">
	<td colspan="<?php echo $worksheet_master['NumberOfColumns']; ?>" class="bold left-aligned row">
        <div class="row">
            <div class="col-md-3 hidden-print">
				<?php
            $link_class = "open-shopping-cart";
            $link_text = "Shop for";
            $link = "#";
            if (in_array($Row['WorksheetCategory_Idn'], array(96, 106, 109)))
            {
                $link_text = "Build";
            }

            if ($Row['ChildWorksheetMaster_Idn'] > 0)
            {
                $link_text = "Add Worksheet";
                $link_class = "";
                $link = base_url()."job/worksheet/0/?j=".$job['job_number']."&wm=".$Row['ChildWorksheetMaster_Idn'];
				$copy_link = '<button id="OpenAddWorksheetModal" class="btn btn-primary btn-xs" title="Copy Worksheet" data-worksheet_master_idn="'.$Row['ChildWorksheetMaster_Idn'].'" data-worksheet_category_idn="'.$Row['WorksheetCategory_Idn'].'">Copy Worksheet</button>';
            }
				?>
		    <a href="<?php echo $link; ?>" class="<?php echo $link_class; ?>" data-worksheetcategory_idn="<?php echo $Row['WorksheetCategory_Idn']; ?>"><?php echo $link_text." ".$Row['Name']; ?></a>&nbsp;

			<?php echo $copy_link; ?>

            <?php if ($Row['WorksheetCategory_Idn'] == 100): ?>
                <span>Total Field Hours &lt;<span id="TotalFieldHours"><?php echo number_format($Row['TotalFieldHours'], 1); ?></span>&gt;</span>
            <?php endif; ?>

            </div>
            <div class="col-md-6 text-center"><span class="text-center"><?php echo $row_title; ?></span></div>
            <div class="col-md-3 text-right">
			</div>
        </div>
	</td>
</tr>