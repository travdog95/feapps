<?php $this->load->view('inc/header'); ?>

<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pages/product/product_assembly.css" />
<script src="<?php echo base_url(); ?>js/pages/product/product_assembly.js" defer></script>

</head>
<body>

<?php $this->load->view('inc/site_header'); ?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">
	<?php $this->load->view('inc/navbar'); ?>

	<!-- start: PAGE -->
	<div class="main-content">
		<div class="container">
			<?php $this->load->view('inc/page_header'); ?>
			<div><h4>Parent</h4></div>
			<table class="parent-component table table-striped table-condensed table-bordered custom-table table-centered" id="parentProductTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Department</th>
						<th>Worksheet Master</th>
						<th>Category</th>
						<th>Manufacturer</th>
						<th>Material Price</th>
						<th>Field Labor</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $product['Product_Idn']; ?></td>
						<td><?php echo $product['Name']; ?></td>
						<td><?php echo $product['Department']; ?></td>
						<td><?php echo $product['WorksheetMaster']; ?></td>
						<td><?php echo $product['WorksheetCategory']; ?></td>
						<td><?php echo $product['Manufacturer']; ?></td>
						<td><?php echo number_format($product['MaterialUnitPrice'], 2); ?></td>
						<td><?php echo number_format($product['FieldUnitPrice'], 2); ?></td>
					</tr>
				</tbody>
			</table>
			<div><h4>Child Components</h4></div>
			<form id="childComponentsForm">
			<input type="hidden" name="Parent_Idn" value="<?php echo $product['Product_Idn']; ?>" />
			<table id="childComponentsTable" class="table table-striped table-condensed table-bordered custom-table table-centered">
				<thead>
					<tr>
						<th></th>
						<th>ID</th>
						<th>Name</th>
						<th>Quantity</th>
						<th>Department</th>
						<th>Worksheet Master</th>
						<th>Category</th>
						<th>Manufacturer</th>
						<th>Material Price</th>
						<th>Field Labor</th>
					</tr>
				</thead>
				<tbody>
				<?php if (!empty($product['Children'])): ?>
					<?php foreach($product['Children'] as $child): ?>
						<?php $this->load->view("product/product_child_row", array("child" => $child)); ?>
					<?php endforeach; ?>
				<?php else: ?>
					<!-- <?php $this->load->view("product/no_children_row", array("colspan" => 9)); ?> -->
				<?php endif; ?>
				</tbody>
			</table>
			</form>
			<div class="button-container">
				<button id="deleteChildrenButton" class="btn btn-primary" disabled>Delete Child</button>
				<button id="saveChildrenButton" class="btn btn-primary">Save</button>
			</div>
			<form id="searchForm" class="form-inline search-container">
				<input type="hidden" name="Parent_Idn" value="<?php echo $product['Product_Idn']; ?>" />
				<div class="form-group">
					<label class="sr-only" for="searchInput">Search by ID or Name or Manufacturer</label>
					<input type="text" id="searchInput" name="searchInput" class="form-control" placeholder="Search by ID or Name or Manufacturer" />
				</div>
				<button id="searchButton" class="btn btn-default">Search</button>
				<span id="searchResultsMessage"></span>
			</form>
			<form id="searchResultsForm">
			<input type="hidden" name="Parent_Idn" value="<?php echo $product['Product_Idn']; ?>" />
			<table id="searchResultsTable" data-search-results class="table table-striped table-condensed table-bordered custom-table table-centered">
				<thead>
					<tr>
						<th></th>
						<th>ID</th>
						<th>Name</th>
						<th>Department</th>
						<th>Worksheet Master</th>
						<th>Category</th>
						<th>Manufacturer</th>
						<th>Material Price</th>
						<th>Field Labor</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			</form>
			<div class="button-container">
				<button id="addChildrenButton" class="btn btn-primary" disabled>Add Child</button>
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