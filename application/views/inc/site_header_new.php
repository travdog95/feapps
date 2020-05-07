
<?php $favorite_class = ($job['is_favorite'] == 1) ? "fa-heart" : "fa-heart-o"; ?>

<!-- Message box -->
<div id="messageBox" class="alert alert-dismissible hide" role="alert">
	<button id="dismissMessageBox" type="button" class="close" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<span class="messageBoxText">&nbsp;</span>
</div>

<!-- start: HEADER -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <!-- start: TOP NAVIGATION CONTAINER -->
    <div class="container">
        <div class="navbar-header">
            <!-- start: RESPONSIVE MENU TOGGLER -->
            <!-- <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="clip-list-2">Button</span>
            </button> -->
            <!-- end: RESPONSIVE MENU TOGGLER -->
            <!-- start: LOGO -->
            <a class="navbar-brand" href="<?php echo base_url(); ?>home">
                <img src="<?php echo base_url(); ?>assets/images/feci_logo.png" width="106px">
            </a>
            <!-- end: LOGO -->
        </div>
        <div class="navbar-tools" style="border: 1px solid red;">
            <!-- <div class="row"> -->
                <span style="background-color: green; width: 30%; display: inline-block">
                    <?php if (isset($worksheet_master['Name']) && isset($worksheet['Worksheet_Idn'])): ?>
                        <span class="display_none print-me"><?php echo quotes_to_entities($worksheet_master['Name'])."(".$worksheet['Worksheet_Idn'].")"; ?></span>
                    <?php endif; ?>

                    <?php if (isset($worksheet_master['DisplayWorksheetName']) && $worksheet_master['DisplayWorksheetName'] == 1): ?>
                        <input id="WorksheetName" name="WorksheetName" type="text" value="<?php echo quotes_to_entities($worksheet['Name']); ?>" class="form-control input-sm print-my-value bold monitor-change" />
                    <?php endif; ?>
                    Test
                </span>
                <!-- <div class="col-md-5 text-center"  style="background-color: yellow;"> -->
                <span class="text-center"  style="background-color: yellow; width: 30%; display: inline-block;">
                    <?php if (isset($job['name'])): ?>
                        <div class="site-primary-title"><?php echo quotes_to_entities($job['name']); ?></div>
                    <?php endif; ?>

                    <?php if (isset($worksheet_master['WorksheetMaster_Idn'])): ?>
                        <div class="site-secondary-title"><?php echo quotes_to_entities($worksheet_master['Name']); ?> Worksheet</div>
                    <?php else: ?>
                        <div class="site-secondary-title"><?php echo quotes_to_entities($active_page); ?></div>
                    <?php endif; ?>
                    </span>
                <span class="text-right" style="background-color: gray; width: 30%; display: inline-block;">
                    <?php if (isset($job['job_number'])): ?>
                        <?php echo $job['job_number']; ?> <i class="favorite fa <?php echo $favorite_class; ?>" aria-hidden="true"></i>
                    <?php endif; ?>
                    Test
                </span>
            <!-- </div> -->

            <!-- start: TOP NAVIGATION MENU -->
            <!-- end: TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- end: TOP NAVIGATION CONTAINER -->
</div>
<!-- end: HEADER -->