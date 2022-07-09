<?php $this->load->view('inc/header'); ?>

<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>lib/DataTables-1.10.15/css/dataTables.bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pages/job/search.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pages/product/product.css" />

<script src="<?php echo base_url(); ?>lib/DataTables-1.10.15/js/jquery.dataTables.min.js" defer></script>
<!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" defer></script> -->

<script src="<?php echo base_url(); ?>lib/DataTables-1.10.15/js/dataTables.bootstrap.min.js" defer></script>

<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" defer></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js" defer></script>

<script src="<?php echo base_url(); ?>js/pages/product/product.js" defer></script>

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
    <div class="col-md-12">
	    <table id="productsTable" class="table table-striped table-hover table-bordered table-condensed display" summary="Products" data-page-length='25' style="width: 100%">
	    <thead>
			<tr>
				<th>Actions</th>
				<th>ID</th>
				<th>Department</th>
				<th>Assembly</th>
				<th>Worksheet Master</th>
                <th>Category</th>
				<th>Name</th>
				<th>Manufacturer</th>
				<th>Material</th>
				<th>Field</th>
				<th>Shop</th>
				<th>Active</th>
				<th>FECI_Id</th>
				<th>ManufacturerPart_Id</th>
				<th>Engineer</th>
				<th>RFP</th>
			</tr>
	    </thead>
		<tfoot>
            <tr>
				<th></th>
				<th class="searchable">ID</th>
				<th class="searchable">Department</th>
				<th class="searchable">Assembly</th>
				<th class="searchable">Worksheet Master</th>
                <th class="searchable">Category</th>
				<th class="searchable">Name</th>
				<th class="searchable">Manufacturer</th>
				<th>Material</th>
				<th>Field</th>
				<th>Shop</th>
				<th class="searchable">Active</th>
				<th>FECI_Id</th>
				<th>ManufacturerPart_Id</th>
				<th>Engineer</th>
				<th>RFP</th>
            </tr>
		</tfoot>
	    </table>
    </div>
</div>

</div>
</div>
<!-- end: PAGE -->

</div>
<!-- end: MAIN CONTAINER -->

<!-- Modal Dialogs //-->
<?php $this->load->view('modals/confirmation'); ?>

<?php $this->load->view('inc/footer'); ?>

<?php $this->load->view('js/user'); ?>
<script>
jQuery(document).ready(function() {
	Main.init();
}); 
</script>

</body>
</html>