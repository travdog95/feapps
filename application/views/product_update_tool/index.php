
<?php $this->load->view('inc/header'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>lib/DataTables-1.10.15/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/pages/product/product_update_tool.css">

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
			    <div class="col-md-12 file-upload-container">
					<input type="file" name="fileUpload" id="fileUpload" class="btn btn-default btn-primary" size="50" />
					<input name="upload" id="upload" type="button" value="Upload" class="btn btn-default btn-primary" />
				</div>
				<?php
				$column_headers = array('ID','Material','Field','Shop','Design','Name','Description','Rank','FECI ID', 'Manufacturer Part ID','Domestic',"RFP",'Active',"Worksheet","Category","Department");
                // $column_headers = array('ID', 'Product Name', 'FECI ID', 'Manufacturer Part ID', 'RFP', 'Department');
                $num_rows_staging = 0;
				?>
                <div class="col-md-12">
                    <table id="data" class="table table-hover table-condensed table-striped">
                        <thead>
                            <tr>
								<?php foreach ($column_headers as $index => $column_header): ?>
									<th><?php echo $column_header; ?></th>
								<?php endforeach; ?>
                            </tr>
                        </thead>
						<tfoot>
                            <tr><?php foreach ($column_headers as $index => $column_header): ?>
                                <th><?php echo $column_header; ?></th><?php endforeach; ?>
                            </tr>
						</tfoot>
                    </table>
                </div>

                <div class="col-md-12 button-container">
                    <input type="button" class="btn btn-default btn-primary" id="ConfirmUpdateProducts" name="ConfirmUpdateProducts" value="Update Products" title="Update Products" />
                    <input type="button" class="btn btn-default btn-primary" id="ConfirmDeleteStagingRecords" name="ConfirmDeleteStagingRecords" value="Delete Staging Products" title="Delete Staging Records" />
                    <input type="button" class="btn btn-default btn-primary" id="UpdatePriceDateTime" name="UpdatePriceDateTime" value="Update System Price Date & Time" title="Update System Price Date & Time" />
                    <span id="SystemPriceUpdateDateTime" class="date-label"><?php echo $price_updatedatetime; ?></span>
                </div>
			</div>
            <!-- end: PAGE CONTENT-->
        </div>
		<!-- end: CONTAINER-->
    </div>
    <!-- end: MAIN CONTENT -->
</div>
<!-- end: MAIN CONTAINER -->
        
<?php $this->load->view('inc/footer'); ?>

<?php $this->load->view('product_update_tool/modals/update_products_confirmation'); ?>
<?php $this->load->view('product_update_tool/modals/delete_staging_records_confirmation'); ?>

<?php $this->load->view('js/user'); ?>
<script src="<?php echo base_url(); ?>lib/PapaParse/papaparse.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>lib/DataTables-1.10.15/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>lib/DataTables-1.10.15/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/pages/product/product_update_tool.js" type="text/javascript"></script>

<script>
    jQuery(document).ready(function() {
        Main.init();
    });
</script>

</body>
</html>