
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
        <div class="navbar-tools">
            <!-- start: TOP NAVIGATION MENU -->
            <ul class="nav navbar-right">
                
                <!-- start: USER DROPDOWN -->
                <li class="dropdown current-user">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                        <img src="<?php echo base_url(); ?>assets/images/avatar-1-small.jpg" class="circle-img" alt="">
                        <span class="username"><?php echo quotes_to_entities($this->session->userdata('first_name'))." ".quotes_to_entities($this->session->userdata('last_name')); ?></span>
                        <i class="clip-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                    	<!--
                        <li>
                            <a href="pages_user_profile.html">
                                <i class="clip-user-2"></i>
                                &nbsp;My Profile
                            </a>
                        </li>
                        -->
                        <li>
                            <a href="<?php echo base_url(); ?>sign_off" title="Log Out">
                                <i class="clip-exit"></i>
                                &nbsp;Log Out
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- end: USER DROPDOWN -->
            </ul>
            <!-- end: TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- end: TOP NAVIGATION CONTAINER -->
</div>
<!-- end: HEADER -->