<?php $favorite_class = ($job['is_favorite'] == 1) ? "fa-heart" : "fa-heart-o"; ?>

<div class="panel-heading">
    <div class="row">
        <div class="col-md-3 col-xs-3">
			<?php if (isset($worksheet_master['Name']) && isset($worksheet['Worksheet_Idn'])): ?>
				<span class="display_none print-me"><?php echo quotes_to_entities($worksheet_master['Name'])."(".$worksheet['Worksheet_Idn'].")"; ?></span>
			<?php endif; ?>

			<?php if (isset($worksheet_master['DisplayWorksheetName']) && $worksheet_master['DisplayWorksheetName'] == 1): ?>
				<input id="WorksheetName" name="WorksheetName" type="text" value="<?php echo quotes_to_entities($worksheet['Name']); ?>" class="form-control input-sm print-my-value bold monitor-change" />
			<?php endif; ?>

        </div>
        <div class="col-md-6 col-xs-6">
            <!--<h2><?php echo quotes_to_entities($job['name']); ?></h2>-->
			<?php if (isset($worksheet_master['WorksheetMaster_Idn'])): ?>
				<h2 class=""><?php echo quotes_to_entities($worksheet_master['Name']); ?> Worksheet</h2>
				<h3><?php echo quotes_to_entities($job['name']); ?>
				</h3>
			<?php else: ?>
				<h2><?php echo quotes_to_entities($active_page); ?></h2>
			<?php endif; ?>
        </div>
        <div class="col-md-3 col-xs-3 text-right">
			<?php echo $job['job_number']; ?> <i class="favorite fa <?php echo $favorite_class; ?>" aria-hidden="true"></i>
        </div>
    </div>
</div>
