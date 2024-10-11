<?php $this->load->view('inc/header'); ?>

<!-- <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>lib/DataTables-1.10.15/css/dataTables.bootstrap.min.css" /> -->
<link href="https://cdn.datatables.net/v/bs/dt-2.0.8/datatables.min.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pages/job/search.css" />

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
<div class="row row-center">
	<div class="input-group">
		<div class="input-group-btn">
			<button type="button" id="filterSearchActive" class="btn filter-search <?php echo ($filter == "" || $filter == "active") ? "btn-primary": "btn-secondary"; ?>">Active</button>
			<button type="button" id="filterSearchArchived" class="btn filter-search <?php echo ($filter == "archived") ? "btn-primary": "btn-secondary"; ?>">Archived</button>
			<button type="button" id="filterSearchDeleted" class="btn filter-search <?php echo ($filter == "deleted") ? "btn-primary": "btn-secondary"; ?> filter">Deleted</button>
		</div>
	</div>
</div>
<!-- start: PAGE CONTENT -->
<div class="row">
  <div class="col-md-12">
	  <table id="JobSearchResults" class="table table-striped table-hover table-bordered display nowrap responsive" summary="Job search results." data-page-length='25' style="width: 100%">
	    <thead>
				<tr>
					<th></th>
					<th>Copy</th>
					<th>Job Number</th>
					<th>Name</th>
					<th>Folder</th>
					<th>Department</th>
					<th>Contractor</th>
					<th>Prepared By</th>
					<th>Job Date</th>
					<th>Updated Date</th>
					<th>Updated By</th>
					<th>Job Status</th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th>Job Number</th>
					<th>Name</th>
					<th>Folder</th>
					<th>Department</th>
					<th>Contractor</th>
					<th>Prepared By</th>
					<th>Job Date</th>
					<th>Updated Date</th>
					<th>Updated By</th>
					<th>Job Status</th>
				</tr>

	    </thead>
			<tfoot>
				<tr> 
					<th></th>
					<th></th>
					<th>Job Number</th>
					<th>Name</th>
					<th>Folder</th>
					<th>Department</th>
					<th>Contractor</th>
					<th>Prepared By</th>
					<th>Job Date</th>
					<th>Updated Date</th>
					<th>Updated By</th>
					<th>Job Status</th>
				</tr>
			</tfoot>
	  </table>
  </div>
</div>
<div class="row button-group">
  <div class="col-md-12">
    <button type="button" class="btn btn-secondary delete_jobs" id="deleteJobs"><span class="glyphicon glyphicon-trash glyphicon-xs" title="Delete selected jobs" aria-hidden="true"></span></button>
		<button type="button" class="btn btn-secondary archive_jobs" id="archiveJobs"><span class="glyphicon glyphicon-folder-close glyphicon-xs" title="Archive selected jobs" aria-hidden="true"></span></button>
		<button type="button" class="btn btn-secondary unarchive_jobs" id="unarchiveJobs"><span class="glyphicon glyphicon-folder-open glyphicon-xs" title="Unarchive selected jobs" aria-hidden="true"></span></button>
	</div>
</div>
</div>
</div>
<!-- end: PAGE -->

</div>
<!-- end: MAIN CONTAINER -->

<!-- Modal Dialogs //-->
<?php $this->load->view('job/modals/copy_job'); ?>
<?php $this->load->view('job/modals/delete_jobs'); ?>

<?php $this->load->view('inc/footer'); ?>

<!-- <script src="<?php echo base_url(); ?>lib/DataTables-1.10.15/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>lib/DataTables-1.10.15/js/dataTables.bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/v/bs/dt-2.0.8/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>js/pages/job/copy_job.js"></script>
<script src="<?php echo base_url(); ?>js/pages/job/search.js"></script>
<?php $this->load->view('js/user'); ?>

<script>
jQuery(document).ready(function() {
	//Main.init();
});
</script>
</body>
</html>