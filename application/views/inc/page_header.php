<?php
/* 
 * page_header view requires the following variables:
 * $active_page(string)
 */
?>
<?php $favorite_class = (isset($job['is_favorite']) && $job['is_favorite'] == 1) ? "fa-heart" : "fa-heart-o"; ?>

<!-- start: PAGE HEADER -->
<div id="PageHeader" class="row sticky">
    <div class="col-md-3 page-header-section page-header-section-left">
        <?php if (isset($worksheet_master['Name']) && isset($worksheet['Worksheet_Idn'])): ?>
            <span class="display_none print-me"><?php echo quotes_to_entities($worksheet_master['Name'])."(".$worksheet['Worksheet_Idn'].")"; ?></span>
        <?php endif; ?>

        <?php if (isset($worksheet_master['DisplayWorksheetName']) && $worksheet_master['DisplayWorksheetName'] == 1): ?>
            <input id="WorksheetName" name="WorksheetName" type="text" value="<?php echo quotes_to_entities($worksheet['Name']); ?>" class="form-control input-sm print-my-value bold monitor-change" />
        <?php endif; ?>
    </div>
	<div class="col-md-6 page-header-section page-header-section-center">
        <?php if (isset($job['name'])): ?>
            <h1><?php echo quotes_to_entities($job['name']); ?></h1>
        <?php endif; ?>

        <?php if (isset($worksheet_master['WorksheetMaster_Idn'])): ?>
            <h2><?php echo quotes_to_entities($worksheet_master['Name']); ?> Worksheet</h2>
        <?php else: ?>
            <h2><?php echo quotes_to_entities($active_page); ?></h2>
        <?php endif; ?>

        <?php if (isset($sub_header) && $sub_header != ""): ?>
            <p><?php echo $sub_header; ?></p>
        <?php endif; ?>
	</div>
	<div class="col-md-3 page-header-section page-header-section-right">
        <?php if (isset($job['job_number'])): ?>
            <?php echo $job['job_number']; ?> <i class="favorite fa <?php echo $favorite_class; ?>" aria-hidden="true"></i>
        <?php endif; ?>
	</div>
</div>

<?php if (isset($job['is_locked']) && $job['is_locked'] == 1): ?>
    <div class="job-is-locked">Job is locked</div>
<?php endif; ?>
<!-- <div class="message alert" role="alert"><?php if (isset($_REQUEST['message']) && !empty($_REQUEST['message'])) echo $_REQUEST['message']; ?></div> -->
<!-- end: PAGE HEADER -->
