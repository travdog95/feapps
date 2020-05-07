<?php
$job_id = $job['job_number'];
$i = 0;
?>

<?php $this->load->view('inc/header'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>lib/DataTables-1.10.10/css/dataTables.bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/pages/job/price_differences.css" type="text/css" />

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

<?php
$form_attributes = array(
    'id' => 'JobPriceDifferences'
);
echo form_open('job/update_prices', $form_attributes);
?>

<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-md-12">
	<?php if (!empty($job)): ?>
		<table id="PriceDifferenceTable" class="table table-striped table-hover table-condensed table-bordered">
		<?php foreach($prices as $row): ?>

			<tr class="recap-row">
				<td colspan="10"><?php echo $row['ParentWorksheetMasterName']; ?></td>
			</tr>

			<?php foreach ($row['PriceDifferences'] as $p): ?>
					
				<?php 
				if ($row['ParentWorksheetMaster_Idn'] == 32 && $current_worksheet_idn != $p['Worksheet_Idn'])
				{
					$current_worksheet_idn = $p['Worksheet_Idn'];
					$p['NewWorksheet'] = 1;
				}
				else
				{
					$p['NewWorksheet'] = 0;
				}
				
				$this->load->view("job/price_difference_row", array("p" => $p));
				$i++;
				?>

			<?php endforeach; ?>
			
			<?php //Check for child worksheets ?>
			<?php if (!empty($row['Children'])): ?>

				<?php foreach ($row['Children'] as $child): ?>

					<?php if ($row['ParentWorksheetMaster_Idn'] == 32 || $row['ParentWorksheetMaster_Idn'] == 14): ?>
						<tr class="child-worksheet-master">
							<td colspan="10"><?php echo $child['ChildWorksheetMasterName']; ?></td>
						</tr>
					<?php endif; ?>

					<?php $current_worksheet_idn = 0; ?>
					<?php foreach ($child['PriceDifferences'] as $p): ?>
						
						<?php 
						if ($current_worksheet_idn != $p['Worksheet_Idn'])
						{
							$current_worksheet_idn = $p['Worksheet_Idn'];
							$p['NewWorksheet'] = 1;
						}
						else
						{
							$p['NewWorksheet'] = 0;
						}
						
						$this->load->view("job/price_difference_row", array("p" => $p)); 
						$i++;
						?>

					<?php endforeach; ?>

				<?php endforeach; ?>

			<?php endif; ?>
			
		<?php endforeach; ?>
		</table>
	<?php else: ?>
		<h2>Job does not exist!</h2>
	<?php endif; ?>
	</div>
</div>

<div class="row">
    <div class="buttons-recap feci-buttons">
        <p>
            <button id="UpdatePrices" name="UpdatePrices" class="save-button primary">Update Prices</button>
        </p>
    </div>
</div>
<?php echo form_close(); ?>
</div> <!-- END: container -->
</div> <!-- end: MAIN-CONTENT -->

<?php $this->load->view('inc/footer'); ?>

<?php
//Load modal dialgos
$this->load->view('modals/confirmation');
?>

<?php $this->load->view('js/user'); ?>
<?php $this->load->view('js/job'); ?>

<script src="<?php echo base_url(); ?>js/pages/job/price_differences.js"></script>
<script>
jQuery(document).ready(function() {
	Main.init();
}); 
</script>
</body>
</html>