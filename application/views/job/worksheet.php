<?php 
$this->load->view('inc/header');
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>lib/DataTables-1.10.10/css/dataTables.bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>lib/Bootstrap-Multiselect/bootstrap-multiselect.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/pages/worksheet/worksheet.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/pages/worksheet/column_widths.css" type="text/css">

<?php //Job mob ?>
<?php if ($worksheet_master['WorksheetMaster_Idn'] == 8): ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>css/pages/worksheet/jobmob.css" type="text/css">

<?php endif; ?>

<?php //Crossmains and Lines recap ?>
<?php if ($worksheet_master['WorksheetMaster_Idn'] == 32): ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>lib/XEditable-1.5.1/css/bootstrap-editable.css" type="text/css">
<?php endif; ?>

</head>
<body>
<?php $this->load->view('inc/site_header'); ?>
<?php
//Create form
$form_attributes = array(
    'id' => 'worksheet',
    "autocomplete" => "off"
);
echo form_open('', $form_attributes);
?>
<div class="main-container">
    
    <?php 
    //Load Navbar
    $this->load->view('inc/navbar');
    ?>
<div class="main-content">        
<div class="container">
	<?php
	//Load data for page_header 
	$this->load->view('inc/page_header');
	?>

    <?php if (!empty($worksheet)): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">

				<div class="panel-body">
                    <?php 
                    //Display Worksheet Header
                    if ($worksheet_master['DisplayWorksheetHeader'] == 1)
                    {
                        //Load view
                        $this->load->view('worksheet/worksheet_parameters');
                    }

                    ?>
                    <input type="hidden" name="Worksheet_Idn" value="<?php echo $worksheet['Worksheet_Idn']; ?>" />
                    <input type="hidden" name="JobNumber" value="<?php echo $job['job_number']; ?>" />

                    <div>

					<table id="WorksheetTable" class="table table-striped table-condensed table-bordered custom-table table-centered">

                    <?php 
                    if ($worksheet_master['IsSubcontractWorksheet'] == 1)
                    {
                        // SUBCONTRACT WORKSHEETS

                        //table head 
                        $this->load->view("worksheet/sub/subcontract_thead");

                        //table body
                        $this->load->view("worksheet/sub/subcontract_tbody");

                        //table foot
                        $this->load->view("worksheet/sub/subcontract_tfoot");
                    }
                    elseif ($worksheet_master['WorksheetMaster_Idn'] == 32) 
                    {
                        //CROSS MAINS AND LINES RECAP

                        //table head 
                        $this->load->view("worksheet/cl_recap/cl_recap_thead");

                        //table body
                        $this->load->view("worksheet/cl_recap/cl_recap_tbody");

                        //table foot
                        $this->load->view("worksheet/worksheet_tfoot");
                    }
                    elseif ($worksheet_master['WorksheetMaster_Idn'] == 22)
                    {
                        //ENGINEERING
                        //table head
                        $this->load->view("worksheet/eng/engineering_thead");

                        //Table body
                        $worksheet_tbody_data = array(
                            "job_number" => $job['job_number']
                            ); 
                        $this->load->view("worksheet/eng/engineering_tbody");

                        //Table foot
                        $this->load->view("worksheet/eng/engineering_tfoot"); 
                    }
                    elseif ($worksheet_master['WorksheetMaster_Idn'] == 8)
                    {
                        //JOB MOBILIZATION
                        //Header
                        $this->load->view("worksheet/job_mob/header");

                        //Design Travel
                        $this->load->view("worksheet/job_mob/design_travel");

                        //Field Travel & Subsistence
                        $this->load->view("worksheet/job_mob/field");

                        //Freight costs
                        $this->load->view("worksheet/job_mob/freight_costs");

                        //Totals
                        $this->load->view("worksheet/job_mob/totals");

                    }
                    else
                    {
                        //NORMAL WORKSHEETS

                        //table head
                        $this->load->view("worksheet/worksheet_thead");

                        //Table body
                        $worksheet_tbody_data = array(
                            "job_number" => $job['job_number']
                            ); 
                        $this->load->view("worksheet/worksheet_tbody");

                        //Table foot
                        $this->load->view("worksheet/worksheet_tfoot"); 
                    }
                    ?>
				    </table>

					</div> <!-- end: div.table-responsive -->
                        
                    <!-- WORKSHEET MESSAGE -->
                    <?php if ($this->session->userdata('read_only') == 0): ?>
                        <?php if ($job['is_locked'] == 0): ?>

                        <div class="message-wrapper feci-buttons">
                            <?php if ($worksheet_master['DisplayDeleteItemsButtons'] == 1): ?>
                            <p>
                                <button type="button" id="DeleteProductsConfirmation" class="danger">Delete Selected Items</button>
                            </p>
                            <?php endif; ?>
                            
                            <p>
                                <?php if ($worksheet_master['DisplayDeleteItemsButtons'] == 1): ?>  
                                    <button type="button" id="DeleteZeroQuantityItemsConfirmation" class="secondary">Delete Zero Quantity Items</button>
                                <?php endif; ?>
                                <button type="button" id="DeleteWorksheetConfirmation" class="secondary">Delete Worksheet</button>
                            </p>
                        </div>
                        <?php endif; ?>
                        <!-- BUTTONS -->
                        <div class="buttons-recap feci-buttons">
                            <?php if ($job['is_locked'] == 0): ?>
                            <p>
                                <input type="submit" id="save" name="save" class="save-button primary" value="Save Worksheet">
                                <input type="submit" id="save_goto_recap" name="save_goto_recap" class="save-button primary" value="Save Worksheet &amp; Go recap">
                            </p>
                            <?php endif; ?>
                            <!-- <p>
                                <button type="button" id="DeleteWorksheetConfirmation" class="secondary">Delete Worksheet</button>
                            </p> -->
                        </div>
                    <?php endif; ?>
				</div> <!-- end: div.panel-body -->
			</div> <!-- end: div.panel -->
		</div> <!-- end: div.col-md-12 -->
	</div> <!-- end: div.row -->
    <?php endif; ?>
</div> <!-- end: div.container -->
</div> <!-- end: div.main-conent -->
</div> <!-- end: div.main-container -->

<?php $this->load->view('inc/footer'); ?>

<?php echo form_close(); ?>
     
<!-- Modal Dialogs -->
<?php 
$this->load->view('job/modals/delete_products');
$this->load->view('job/modals/delete_worksheet'); 
$this->load->view('job/modals/fire_pumps_table'); 
$this->load->view('job/modals/add_worksheet');
$this->load->view('job/modals/add_area');
$this->load->view('modals/select_job');

//Shopping Cart
if (isset($worksheet_master['WorksheetMasterCategories']))
{
    $shopping_cart_data = array(
        'worksheet_parms' => $worksheet['WorksheetParms'],
        'job_parms' => $job['job_parms'],
        'total_panels' => $total_panels,
        'total_devices' => $total_devices
        );

    $this->load->view('job/modals/shopping_cart', $shopping_cart_data);
}
?>

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        
<script src="<?php echo base_url();?>lib/DataTables-1.10.10/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>lib/DataTables-1.10.10/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>lib/Bootstrap-Multiselect/bootstrap-multiselect.js"></script>


<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

<?php $this->load->view('js/user'); ?>
<?php $this->load->view('js/job'); ?>
<?php $this->load->view('js/worksheet'); ?>

<script src="<?php echo base_url(); ?>js/pages/job/worksheet.js"></script>
<script src="<?php echo base_url(); ?>js/pages/job/cart.js"></script>
<script src="<?php echo base_url(); ?>js/pages/worksheet/worksheet_actions.js"></script>

<?php if ($worksheet_master['WorksheetMaster_Idn'] == 22): ?>
    <script src="<?php echo base_url(); ?>js/pages/worksheet/engineering.js"></script>
<?php endif; ?>

<?php if ($worksheet_master['WorksheetMaster_Idn'] == 8): ?>
    <script src="<?php echo base_url(); ?>js/pages/worksheet/jobmob.js"></script>
<?php endif; ?>

<?php //Crossmains and Lines recap ?>
<?php if ($worksheet_master['WorksheetMaster_Idn'] == 32): ?>
    <script src="<?php echo base_url(); ?>lib/XEditable-1.5.1/js/bootstrap-editable.min.js"></script>
<?php endif; ?>

<script>
    jQuery(document).ready(function() {
        Main.init();
    });
</script>

</body>
</html>