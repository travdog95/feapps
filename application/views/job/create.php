<?php $this->load->view('inc/header'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pages/job/create.css" />

</head>
<body>

<?php $this->load->view('inc/site_header'); ?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">
    
	<?php 
    //Load Navbar
    $menu_data = array(
		'menus' => $menus,
		'active_page' => $active_page
	);
    $this->load->view('inc/navbar', $menu_data);
    ?>
    <!-- start: PAGE -->
    <div class="main-content">        
        <div class="container">
			<?php
			//Load data for page_header 
			$page_header_data = array(
				'active_page' => $active_page,
				'bread_crumbs' => $bread_crumbs
			);
			$this->load->view('inc/page_header', $page_header_data); 
			?>
            
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-4">
                    <button id="create_sprinkler" class="btn btn-icon btn-block">
                        <i class="fa fa-play-circle-o"></i>
                            SPRINKLER
                    </button>
                </div>
                <div class="col-sm-4">
                    <button id="create_special_hazard" class="btn btn-icon btn-block">
                        <i class="fa fa-play-circle-o"></i>
                            ELECTRONICS DIVISION 
                    </button>
                </div>
            </div>

            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
        
<?php $this->load->view('inc/footer'); ?>

<script src="<?php echo base_url(); ?>js/pages/job/create.js"></script>

<?php $this->load->view('js/user'); ?>
<script>
jQuery(document).ready(function() {
	Main.init();
});
</script>

</body>
</html>