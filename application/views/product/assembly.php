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
			<table class="parent-component table table-striped table-condensed table-bordered custom-table table-centered">
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
			<form id="childComponentsForm" name="childComponentsForm" action="/controllers/product.php" method="post">
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
			<form class="form-inline search-container">
				<div class="form-group">
					<label class="sr-only" for="searchById">Search by ID or Name</label>
					<input type="text" id="searchById" class="form-control"	placeholder="Search by ID or Name" />

				</div>
				<div class="form-group">
					<label class="sr-only" for="searchByWorksheetMaster">Worksheet Master</label>
					<select id="searchByWorksheetMaster" class="form-control">
						<option>Search by Worksheet Master</option>
						<?php foreach($product['WorksheetMasters'] as $id => $worksheet_master): ?>
							<option value="<?php echo $id; ?>" <?php if ($id == $product['WorksheetMaster_Idn']) echo 'selected'; ?>><?php echo $worksheet_master; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label class="sr-only" for="searchByWorksheetCategory">Worksheet Category</label>
					<select id="searchByWorksheetCategory" class="form-control">
						<option>Search by Category</option>
						<?php foreach($product['WorksheetCategories'] as $id => $worksheet_category): ?>
							<option value="<?php echo $id; ?>" <?php if ($id == $product['WorksheetCategory_Idn']) echo 'selected'; ?>><?php echo $worksheet_category; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<button id="searchButton" class="btn btn-default">Search</button>
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
					<?php foreach($search_results as $search_result): ?>
						<?php $this->load->view('product/product_search_results_row', array("search_result" => $search_result)); ?>
					<?php endforeach; ?>
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