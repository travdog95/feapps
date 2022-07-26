<?php $this->load->view('inc/header'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>lib/DataTables-1.10.15/css/dataTables.bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>lib/XEditable-1.5.1/css/bootstrap-editable.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pages/home.css" />

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
                <div class="col-md-6">
                    <?php $favorite_jobs_data = array("title" => "My Favorites", "table_id" => "MyFavoritesTable"); ?>
                    <?php $this->load->view('widgets/jobs', $favorite_jobs_data); ?>
                </div>
                <div class="col-md-6">
                    <?php $recent_jobs_data = array("title" => "My Recent Jobs", "table_id" => "MyRecentsTable"); ?>
                    <?php $this->load->view('widgets/jobs', $recent_jobs_data); ?>
               </div>
            </div>
			<div class="row">
				<div class="col-md-6">
                    <?php $folders_data = array("title" => "My Folders", "table_id" => "MyFoldersTable"); ?>
					<?php $this->load->view('widgets/folders', $folders_data); ?>
				</div>
                <div class="col-md-6">
					<?php $folders_data = array("title" => "Shared Folders", "table_id" => "SharedFoldersTable"); ?>
					<?php $this->load->view('widgets/folders', $folders_data); ?>
                </div>
			</div>
            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
        
<?php $this->load->view('inc/footer'); ?>

<?php //Modals ?>
<?php $this->load->view('modals/add_jobs_to_folder'); ?>
<?php $this->load->view('modals/confirmation'); ?>
<?php $this->load->view('job/modals/copy_job'); ?>

<?php $this->load->view('js/user'); ?>
<script src="<?php echo base_url(); ?>lib/DataTables-1.10.15/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>lib/DataTables-1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>lib/XEditable-1.5.1/js/bootstrap-editable.min.js"></script>
<script src="<?php echo base_url(); ?>js/pages/job/copy_job.js"></script>
<script src="<?php echo base_url(); ?>js/pages/home.js"></script>

<script>
    jQuery(document).ready(function() {
        Main.init();
    });
</script>

</body>
</html>