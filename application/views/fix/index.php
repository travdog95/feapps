
<?php $this->load->view('inc/header'); ?>

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
        <div class="container"><?php
			//Load data for page_header
			$page_header_data = array(
				'active_page' => $active_page,
				'bread_crumbs' => $bread_crumbs
			);
			$this->load->view('inc/page_header', $page_header_data);
			?>

            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="text-center">
                    <a href="<?php echo base_url(); ?>fix/fix_pipe_exposure">Fix Pipe Exposure</a>
                </div>
            </div>

            <div class="row">
                <div class="text-center">
					<a href="<?php echo base_url(); ?>fix/fix_parent_worksheet_idns">Fix Parent Worksheet Idns</a>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
					<a href="<?php echo base_url(); ?>fix/update_department_on_wc">Update Department_Idn on WorksheetCategories Table</a>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                <p>These are the results. Deploying a commit.</p>
                    <?php if (!empty($results)): ?>
						<pre><?php print_r($results); ?></pre>
					<?php endif; ?>
				</div>
			</div>
            <!-- end: PAGE CONTENT-->
        </div>
        
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
        
<?php $this->load->view('inc/footer'); ?>

<?php $this->load->view('js/user'); ?>
<script>
    jQuery(document).ready(function() {
        Main.init();
    });
</script>

</body>
</html>