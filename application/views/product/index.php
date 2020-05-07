
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
                <div class="text-center">
                    <button id="InitiateRefreshProducts" class="btn btn-lg btn-danger">Refresh Products</button>
                </div>
            </div>
            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
        
<?php $this->load->view('inc/footer'); ?>

<?php $this->load->view('product/modals/refresh_products_confirmation'); ?>

<?php $this->load->view('js/user'); ?>
<script src="<?php echo base_url(); ?>js/pages/product.js" type="text/javascript"></script>

<script>
    jQuery(document).ready(function() {
        Main.init();
    });
</script>

</body>
</html>