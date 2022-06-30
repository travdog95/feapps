<?php $this->load->view('inc/header'); ?>

<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pages/product/product_component.css" />
<script src="<?php echo base_url(); ?>js/pages/product/product_component.js" defer></script>

</head>
<body>

<?php $this->load->view('inc/site_header'); ?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">
	<?php $this->load->view('inc/navbar'); ?>

	<!-- start: PAGE -->
	<div class="main-content">
		<div class="container" id="productComponentUI">
			<?php $this->load->view('inc/page_header'); ?>
			<div class="search-container">
			<input
				id="Search"
				class="search-input"
				placeholder="Search for Product"
				data-search-input
				/>
			</div>
			<div class="children">
				<?php if (!empty($product['Children'])): ?>
					<?php foreach($product['Children'] as $child): ?>
						<div class="child-row">
							<div class="child-checkbox"><input type="checkbox" /></div>
							<div><?php echo $child['Product_Idn']; ?></div>
							<div><?php echo $child['Name']; ?></div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<div class="button-container">
				<button id="deleteChildrenButton" class="btn btn-primary">Delete Children</button>
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