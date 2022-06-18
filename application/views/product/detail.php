<?php $this->load->view('inc/header'); ?>

<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pages/product/product_detail.css" />
<script src="<?php echo base_url(); ?>js/pages/product/product_detail.js" defer></script>

</head>
<body>

<?php $this->load->view('inc/site_header'); ?>

<!-- start: MAIN CONTAINER -->
<div class="main-container">
	<?php $this->load->view('inc/navbar'); ?>

	<!-- start: PAGE -->
	<div class="main-content">
		<div class="container" id="productDetailUI">
			<?php $this->load->view('inc/page_header'); ?>

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#primary" aria-controls="primary" role="tab" data-toggle="tab">Primary</a></li>
				<li role="presentation"><a href="#secondary" aria-controls="secondary" role="tab" data-toggle="tab">Secondary</a></li>
				<li role="presentation"><a href="#electronicsDivision" aria-controls="electronicsDivision" role="tab" data-toggle="tab">Electronics Division</a></li>
				<li role="presentation"><a href="#sprinkerDivision" aria-controls="sprinkerDivision" role="tab" data-toggle="tab">Sprinkler</a></li>
				<li role="presentation"><a href="#firePump" aria-controls="firePump" role="tab" data-toggle="tab">Fire Pump</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="primary">
					<?php $this->load->view('product/detail_primary_tab'); ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="secondary">
					<?php $this->load->view('product/detail_secondary_tab'); ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="electronicsDivision">
					<?php $this->load->view('product/detail_electronics_tab'); ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="sprinkerDivision">
					<?php $this->load->view('product/detail_sprinkler_tab'); ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="firePump">
					<?php $this->load->view('product/detail_fire_pump_tab'); ?>
				</div>
			</div>
			<div class="button-container">
				<button id="cancelProductButton" class="btn btn-default">Cancel</button>
				<button id="saveProductButton" class="btn btn-primary"><?php echo $button_text; ?></button>
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