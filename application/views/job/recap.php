<?php $this->load->view('inc/header'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/pages/job/recap.css" type="text/css">

</head>
<body>

<?php 
$site_header_data = array(
    'active_page' => $active_page
);

$this->load->view('inc/site_header', $site_header_data); 
?>

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
				//'bread_crumbs' => $bread_crumbs
			);
			$this->load->view('inc/page_header', $page_header_data);
            ?>
            
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- start: Recap Panel -->
                    <div class="panel panel-default">
                        <?php 
                        // $panel_heading_data = array(
                        //     'JobName' => $job['name'] ,
                        //     "DisplayWorksheetName" => 0
                        // );
                        //$this->load->view('inc/panel_heading', $panel_heading_data); 
                        ?>

                        <div id="pdfContent" class="panel-body">
                            <div class="well well-sm recap-header">

                                <div class="row">

                                    <div class="col-md-4 col-xs-4">
                                        <span class="bold">Prepared By:</span>
                                        <?php 
                                        echo quotes_to_entities($job['created_by_name']);
                                        
                                        if (!empty($job['prepared_by_names']))
                                        {
                                            echo ", ".quotes_to_entities($job['prepared_by_names']);
                                        }
                                        ?>
                                    </div>
                                    <!-- <div class="col-md-2 col-xs-2 text-center">
                                        
                                    </div> -->
									<div class="col-md-4 col-xs-4 text-center">
                                        <span class="bold"><em>Last Price Update:</em></span>
                                        <span><em><?php echo $job['formated_price_update_datetime']; ?></em></span><br />
                                        <?php if ($job['prices_outdated']): ?>
                                            <span><em>Prices are outdated!</em></span>
                                        <?php endif; ?>
										<?php if ($job['job_parms'][80]['AlphaValue'] == "Y"): ?>
  											<span><em>Parts and Smarts</em></span>
										<?php endif; ?>
									</div>
                                    <div class="col-md-4 col-xs-4 text-right">
                                        <span class="bold">Parent: </span><span id="parent"></span>
                                    </div> 
								</div>
								<div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <span class="bold">Estimate Date: </span><?php echo $job['created_date']; ?>
                                    </div> 

                                    <div class="col-md-4 col-xs-4 text-center">
                                        <span class="bold">Contractor: </span><?php echo quotes_to_entities($job['contractor']); ?>
                                    </div> 

                                    <div class="col-md-4 col-xs-4 text-right">
                                        <span class="bold">Peer Review:</span>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md col-xs-12">
                                        <span class="bold">Last Modified: </span>
                                        <span><?php echo $job['updated_date']; ?></span>
                                    </div>
                                </div>
                            </div>

                            <?php 
                            $form_attributes = array(
                                'id' => 'job_recap'
                            );
                            echo form_open('', $form_attributes);
                            ?>
                                <input type="hidden" id="job_number" name="job_number" value="<?php echo $job['job_number']; ?>" />
                                <input type="hidden" id="department_idn" name="department_idn" value="<?php echo $job['department_idn']; ?>" />
                                <div class="table-responsive custom-responsive-table">
                                    <table class="table table-striped table-condensed table-bordered custom-table" id="print-pdf">
                                    <!-- =========================
                                         CUSTOM TABLE START HERE 
                                    ============================== -->
                                        <thead>
                                            <tr>
                                                <th class="col-sm-2"></th>
                                                <th class="col-sm-1">Bonded</th>
                                                <th class="col-sm-1">Sub 18%</th>
                                                <th class="col-sm-1">Sub</th>
                                                <th class="col-sm-1">Material</th>
                                                <th class="col-sm-1">Labor</th>
                                                <th class="col-sm-1">&lt;Hours&gt;</th>
                                            </tr>
                                        </thead>

                                        <!-- TABLE BODY STARTS -->
                                        <tbody>
                                            
                                            <!-- LOAD RECAP ROWS -->
                                            
                                            <?php foreach ($recap_rows as $recap_cells): ?>
                                            <tr>
                                                <?php $c = 1; ?>
                                                <?php foreach ($recap_cells as $recap_row): ?>
                                                    <td class="<?php echo $recap_row['class']; ?>">
                                                        <?php if ($c == 1): ?>
                                                            <div class="to-left bold">
                                                                <?php echo $recap_row['contents']; ?>
                                                            </div>
                                                            <?php if (isset($recap_row['additional_first_cell_content'])): ?>
                                                                <div class="text-right bold">
                                                                    <?php echo $recap_row['additional_first_cell_content']; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php elseif ($c >= 2 && $c <= 6): ?>
                                                            <div class="text-right">
                                                                <?php echo $recap_row['contents']; ?>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="text-center">
                                                                <?php echo $recap_row['contents']; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <?php $c++; ?>
                                                <?php endforeach; ?>
                                            </tr>
                                            <?php endforeach; ?>
                                            
                                            
                                            <!-- END: LOAD RECAP ROWS -->


                                            <tr>
                                                <td colspan="6" class="rowdisabled">&nbsp;</td>
                                                <td>
                                                    <div class="to-left" style="position:absolute;"><strong>S</strong></div>
                                                    <div class="text-center">
                                                        &lt;<?php echo number_format($job['jm_shop_hours'], 0); ?>&gt;
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="danger">
                                                <td class="bold thick-border-top">TOTAL OF ALL ITEMS</td>
                                                <td class="thick-border-top">$<span id="item_total_1" class="item_total">0</span></td>
                                                <td class="thick-border-top">$<span id="item_total_2" class="item_total">0</span></td>
                                                <td class="thick-border-top">$<span id="item_total_3" class="item_total">0</span></td>
                                                <td class="thick-border-top">$<span id="item_total_4" class="item_total">0</span></td>
                                                <td class="thick-border-top">$<span id="item_total_5" class="item_total">0</span></td>
                                                <td class="nobgfill">
                                                    
                                                    <div class="to-left" style="position:absolute;"><strong>F</strong></div>
                                                    <div class="text-center">&lt;<?php echo number_format($job['jm_field_hours'], 0); ?>&gt;</div>

                                                </td>
                                            </tr>

                                            <!-- DARK GRAY SEPARATOR -->
                                            <tr class="rowdisabled">
                                                <td colspan="7"></td>
                                            </tr>
                                             <!-- /END DARK GRAY SEPARATOR -->

                                            <tr>
                                                <td>Payroll Added Costs - <span class="bold" id="pac"><?php echo number_format($job['payroll_added_costs'] * 100, 1) ?>%</span></td>
                                                <td class="rowdisabled"></td>
                                                <td class="rowdisabled"></td>
                                                <td class="rowdisabled"></td>
                                                <td class="rowdisabled"></td>
                                                <td>$<span class="pac" id="pac_5"></span></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Totals After P.A.C</td>
                                                <td class="rowdisabled"></td>
                                                <td class="rowdisabled"></td>
                                                <td class="rowdisabled"></td>
                                                <td class="rowdisabled"></td>
                                                <td>$<span class="total_after_pac" id="total_after_pac_5"></span></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Supervisory Fee</td>
                                                <td class="rowdisabled"></td>
                                                <td class="rowdisabled"></td>
                                                <td class="rowdisabled"></td>
                                                <td class="rowdisabled"></td>
                                                <td>
                                                    <div class="input-group tko-input-group-right">
                                                        $<span class="input-result supervisory_fee" id="supervisory_fee"></span>
                                                    </div>
                                                    <span style="float:right;">&nbsp;&nbsp;</span>

                                                    <div class="input-group tko-input-group-right">
                                                        <?php $supervisory_fee_percent = ($job['department_idn'] == 1) ? $job['job_parms'][83]['NumericValue'] : $job['job_parms'][17]['NumericValue']; ?>
                                                        <input type="text" class="check_num1 change print-my-value form-control input-xs width-45" name="supervisory_fee_percent" id="supervisory_fee_percent" value="<?php echo number_format($supervisory_fee_percent * 100, 1) ?>" title="Supervisory Fee %">
                                                        <span class="input-group-addon input-xs">%</span>
                                                    </div>

                                                </td>
                                                <td class="text-center"><strong>TOTAL FMH</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Contingences</td>
                                                <td class="rowdisabled"></td>
                                                <?php
                                                //Load contingency values
                                                $contingency_percents = array(
                                                    '2' => $job['job_parms'][23]['NumericValue'] * 100,
                                                    '3' => $job['job_parms'][24]['NumericValue'] * 100,
                                                    '4' => $job['job_parms'][25]['NumericValue'] * 100,
                                                    '5' => $job['job_parms'][26]['NumericValue'] * 100
                                                );

                                                $contingencies = array(
                                                    '2' => $job['job_parms'][33]['NumericValue'],
                                                    '3' => $job['job_parms'][34]['NumericValue'],
                                                    '4' => $job['job_parms'][35]['NumericValue'],
                                                    '5' => $job['job_parms'][36]['NumericValue']
                                                );
                                                ?>
                                                <?php for ($i = 2; $i <= 5; $i++): ?>
                                                <td style="min-width: 160px;">
                                                   <?php
                                                    $override_contingency_percent = ($contingencies[$i] == "0") ? 0 : 1;
                                                   ?>
                                                    <div class="input-group tko-input-group-right">
                                                        <span class="input-group-addon input-xs">$</span>
                                                        <input type="text" class="change check_num0 print-my-value form-control input-xs contingency width-75" name="contingency[<?php echo $i; ?>]" id="contingency_<?php echo $i; ?>" value="<?php echo $contingencies[$i]; ?>" title="Contingency" data-c="<?php echo $i; ?>">
                                                    </div>
													<span style="float:right;">&nbsp;&nbsp;</span>
													<div class="input-group tko-input-group-right">
                                                        <input type="text" class="change check_num1 print-my-value form-control input-xs contingency-percent width-45" name="contingency_percent[<?php echo $i; ?>]" id="contingency_<?php echo $i; ?>_percent" value="<?php echo $contingency_percents[$i]; ?>" title="Contingency %" data-c="<?php echo $i; ?>">
                                                        <span class="input-group-addon input-xs">%</span>
                                                    </div>
                                                    <input type="hidden" name="override_contingency_<?php echo $i; ?>_percent" id="override_contingency_<?php echo $i; ?>_percent" value="<?php echo $override_contingency_percent; ?>" />
                                                </td>
                                                <?php endfor; ?>
                                                <td class="text-center"><strong>&lt;<span id="total_fmh"><?php echo number_format(ceil($job['field_hours']), 0) ?></span>&gt;</strong></td>
                                            </tr>

                                            <!-- DARK GRAY SEPARATOR -->
                                            <tr class="rowdisabled">
                                                <td colspan="7"></td>
                                            </tr>
                                             <!-- /END DARK GRAY SEPARATOR -->

                                            <tr class="danger bold">
                                                <td>TOTAL DIRECT COSTS</td>
                                                <td>$<span id="total_direct_cost_1" class="total_direct_cost">0</span></td>
                                                <td>$<span id="total_direct_cost_2" class="total_direct_cost">0</span></td>
                                                <td>$<span id="total_direct_cost_3" class="total_direct_cost">0</span></td>
                                                <td>$<span id="total_direct_cost_4" class="total_direct_cost">0</span></td>
                                                <td>$<span id="total_direct_cost_5" class="total_direct_cost">0</span></td>
                                                <td>$<span id="total_direct_costs_total" class="total_direct_cost"></span></td>
                                            </tr>
                                            <tr>
                                                <td>Mark-Up of Costs</td>
                                                <td>$<span id="mark_up_1" class="mark_up">0</span></td>
                                                <td>
                                                    <span id="mark_up_percent_2" class="mark_up_percent"><?php echo number_format($job['job_parms'][61]['NumericValue'] * 100, 2) ?></span>%
                                                    $<span id="mark_up_2" class="mark_up">0</span>
                                                </td>
                                                <td>
                                                    <div class="input-group tko-input-group-right">
                                                        $<span id="mark_up_3" class="mark_up">0</span>
                                                    </div>
                                                    <span style="float:right;">&nbsp;&nbsp;</span>
                                                    <div class="input-group tko-input-group-right">
                                                        <input type="text" name="mark_up_percent_3" id="mark_up_percent_3" class="mark_up_percent check_num2 change print-my-value form-control input-xs width-75" value="<?php echo number_format($job['job_parms'][57]['NumericValue'] * 100, 4) ?>" />
                                                        <span class="input-group-addon input-xs">%</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span id="mark_up_percent_4" class="mark_up_percent"><?php echo number_format($job['job_parms'][62]['NumericValue'] * 100, 2) ?></span>%
                                                    $<span id="mark_up_4" class="mark_up">0</span>
                                                </td>
                                                <td>
                                                    <div class="input-group tko-input-group-right">
                                                        $<span id="mark_up_5" class="mark_up">0</span>
                                                    </div>
                                                    <span style="float:right;">&nbsp;&nbsp;</span>
                                                    <div class="input-group tko-input-group-right">
                                                        <input type="text" name="mark_up_percent_5" id="mark_up_percent_5" class="mark_up_percent check_num2 change print-my-value form-control input-xs width-75" value="<?php echo number_format($job['job_parms'][58]['NumericValue'] * 100, 4) ?>" />
                                                        <span class="input-group-addon input-xs">%</span>
                                                    </div>
                                                </td>
                                                <td><strong>$<span id="mark_up_costs_total" class=""></span></strong></td>

                                            </tr>
                                            <tr class="danger bold">
                                                <td>Total After Capacity Costs</td>
                                                <td>$<span id="total_capacity_cost_1" class="total_capacity_cost">0</span></td>
                                                <td>$<span id="total_capacity_cost_2" class="total_capacity_cost">0</span></td>
                                                <td>$<span id="total_capacity_cost_3" class="total_capacity_cost">0</span></td>
                                                <td>$<span id="total_capacity_cost_4" class="total_capacity_cost">0</span></td>
                                                <td>$<span id="total_capacity_cost_5" class="total_capacity_cost">0</span></td>
                                                <td class="nobgfill"></td>
                                            </tr>

                                            <!-- DARK GRAY SEPARATOR -->
                                            <tr class="rowdisabled">
                                                <td colspan="7"></td>
                                            </tr>
                                             <!-- /END DARK GRAY SEPARATOR -->

                                            <tr>
                                                <td colspan="2" class="bold">Notes &amp; Exclusions</td>
                                                <td colspan="3" class="bold left-aligned">TOTAL AFTER CAPACITY COSTS</td>
                                                <td>$<span id="total_capacity_cost"></span></td>
                                                <td rowspan="14" style="vertical-align: top;">
                                                    <?php if ($job['department_idn'] == 2) echo $recap_summary; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" rowspan="11" class="nobgfill" style="vertical-align:top">
                                                <textarea name="notes" id="notes"><?php echo quotes_to_entities($job['notes']); ?></textarea>
												<span id="notes-print" class="display_none print-me"></span>
                                            </td>
                                            <td colspan="3">
                                                <!-- TOTAL CALCULATION AREA NEXT TO NOTES -->

                                                    <div class="bold to-left">Regular Commission</div>
													<div class="input-group tko-input-group-right">
                                                        <input type="text" name="regular_commission_percent" id="regular_commission_percent" class="change check_num2 print-my-value form-control input-xs width-75" title="Regular Commission %" value="<?php echo number_format($job['job_parms'][59]['NumericValue'] * 100, 4) ?>" />
														<span class="input-group-addon input-xs">%</span>
													</div>


                                                </td>
                                                <td>$<span id="regular_commission"></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">

                                                    <div class="bold to-left">SUBTOTAL</div>

                                                </td>
                                                <td>$<span id="subtotal"></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <?php
                                                        $profit_mark_up_percent = $job['job_parms'][14]['NumericValue'] * 100;
                                                        $profit_mark_up = $job['job_parms'][46]['NumericValue'];
                                                        $override_profit_mark_up_percent = ($profit_mark_up == "0") ? 0 : 1;
                                                        ?>

                                                    
                                                    <div class="bold to-left">PROFIT MARKUP</div>
                                                    <div class="input-group tko-input-group-right">
                                                        <input type="text" name="profit_mark_up_percent" id="profit_mark_up_percent" class="change check_num2 print-my-value form-control input-xs width-75 highlight" data-original_value="<?php echo $profit_mark_up_percent; ?>" title="Profit Mark-Up %" value="<?php echo $profit_mark_up_percent; ?>" />
                                                        <span class="input-group-addon input-xs">%</span>
                                                    </div>
                                                    <span class="display_none approx-profit-mark-up-percent highlight" style="float: right;">~<span id="ApproximateProfitMarkUpPercent" class="approx-profit-mark-up-percent">12.54</span>% &nbsp;</span>
                                               </td>
                                                <td>
                                                    <div class="input-group tko-input-group-right">
														
                                                        <span class="input-group-addon input-xs">$</span>
                                                        <input type="text" name="profit_mark_up" id="profit_mark_up" class="change check_num0 print-my-value form-control input-xs width-90 text-right highlight" data-original_value="<?php $profit_mark_up; ?>" title="Profit Mark-Up" value="<?php echo $profit_mark_up; ?>" />
                                                    </div>

                                                    <input type="hidden" name="override_profit_mark_up_percent" id="override_profit_mark_up_percent" value="<?php echo $override_profit_mark_up_percent; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="bold to-left">Total After Profit Mark-Up</div>
                                                </td>
                                                <td>$<span id="total_after_profit_mark_up"></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="bold to-left">Sales or Use Taxes</div>
                                                    <div class="input-group tko-input-group-right">
                                                        <input type="text" name="sales_tax_percent" id="sales_tax_percent" class="change check_num2 print-my-value form-control input-xs width-75" title="Sales Tax %" value="<?php echo number_format($job['job_parms'][15]['NumericValue'] * 100, 2) ?>" />
                                                        <span class="input-group-addon input-xs">%</span>
                                                    </div>
                                                </td>
                                                <td>$<span id="sales_tax"></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="bold to-left">Total After Taxes</div>
                                                </td>
                                                <td>$<span id="total_after_sales_tax"></span></td>
                                            </tr>
                                            <?php
                                            $depository_fee_percent = $job['job_parms'][18]['NumericValue'] * 100;
                                            $depository_fee = $job['job_parms'][48]['NumericValue'];
                                            $override_depository_fee_percent = ($job['job_parms'][18]['AlphaValue'] == "N") ? 0 : 1;
                                            ?>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="bold to-left">Depository Fee 
                                                        <input type="checkbox" name="override_depository_fee_limit" id="override_depository_fee_limit" value="1" <?php if ($job['job_parms'][18]['AlphaValue'] == 'Y') echo 'checked="checked"'; ?> > 
                                                        <label for="override_depository_fee_limit">Override Limit</label>
                                                    </div>
                                                    <div class="input-group tko-input-group-right">
                                                        <input type="text" name="depository_fee_percent" id="depository_fee_percent" class="change check_num2 print-my-value form-control input-xs width-75" title="Depository Fee %" value="<?php echo $depository_fee_percent; ?>" />
                                                        <span class="input-group-addon input-xs">%</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group tko-input-group-right">
                                                        <span class="input-group-addon input-xs">$</span>
                                                        <input type="text" name="depository_fee" id="depository_fee" class="change check_num0 print-my-value form-control input-xs width-90 text-right" title="Depository Fee" value="<?php echo $depository_fee; ?>" />
                                                    </div>
                                                    <input type="hidden" name="override_depository_fee_percent" id="override_depository_fee_percent" value="<?php echo $override_depository_fee_percent; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="bold to-left">Total After Depository Fee</div>
                                                </td>
                                                <td>$<span id="total_after_depository_fee"></span></td>
                                            </tr>
                                            <?php
                                            $cost_of_bond_percent = $job['job_parms'][44]['NumericValue'] * 100;
                                            $cost_of_bond = $job['job_parms'][49]['NumericValue'];
                                            $override_cost_of_bond_percent = ($cost_of_bond == "0") ? 0 : 1;
                                            ?>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="bold to-left">Cost of Bond</div>
                                                    <div class="input-group tko-input-group-right">
                                                        <input type="text" name="cost_of_bond_percent" id="cost_of_bond_percent" class="change check_num2 print-my-value form-control input-xs width-75" title="Cost of Bond %" value="<?php echo $cost_of_bond_percent; ?>" />
                                                        <span class="input-group-addon input-xs">%</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group tko-input-group-right">
                                                        <span class="input-group-addon input-xs">$</span>
                                                        <input type="text" name="cost_of_bond" id="cost_of_bond" class="change check_num0 print-my-value form-control input-xs width-90 text-right" title="Cost of Bond" value="<?php echo $cost_of_bond; ?>" />
                                                    </div>
                                                    <input type="hidden" name="override_cost_of_bond_percent" id="override_cost_of_bond_percent" value="<?php echo $override_cost_of_bond_percent; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="bold to-left">Total After Bond</div>
                                                </td>
                                                <td>
                                                    $<span id="total_after_cost_of_bond"></span>
                                                </td>
                                            </tr>
                                            <?php
                                            $gross_receipt_percent = ($job['department_idn'] == 1) ? $job['job_parms'][84]['NumericValue'] * 100 : $job['job_parms'][45]['NumericValue'] * 100;
                                            $gross_receipt = $job['job_parms'][50]['NumericValue'];
                                            $override_gross_receipt_percent = ($gross_receipt == "0") ? 0 : 1;
                                            ?>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="bold to-left">G.L. Surcharge, Gross Receipts Tax, Etc.</div>
                                                    <div class="input-group tko-input-group-right">
                                                        <input type="text" name="gross_receipt_percent" id="gross_receipt_percent" class="change check_num2 print-my-value form-control input-xs width-75" title="Gross Receipt %" value="<?php echo $gross_receipt_percent; ?>" />
                                                        <span class="input-group-addon input-xs">%</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group tko-input-group-right">
                                                        <span class="input-group-addon input-xs">$</span>
                                                        <input type="text" name="gross_receipt" id="gross_receipt" class="change check_num0 print-my-value form-control input-xs width-90 text-right" title="Gross Receipt" value="<?php echo $gross_receipt; ?>" />
                                                    </div>
                                                    <input type="hidden" name="override_gross_receipt_percent" id="override_gross_receipt_percent" value="<?php echo $override_gross_receipt_percent; ?>" />
                                                </td>
                                            </tr>
 
                                            <tr class="danger">
                                                <td colspan="2" class="bold compact">
                                                    <p>Case 1 Total: $<span id="case1_total"></span></p>
                                                    <p>Case 2 Total: $<span id="case2_total"></span></p>
                                                    <input type="hidden" name="case_type" id="case_type" value="" />
                                                </td>
                                                <td colspan="3" class="bold total">TOTAL:</td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input type="text" name="total" id="total" class="change check_num0 print-my-value form-control text-right bold" />
													</div>
												</td>
                                            </tr>
                                        </tbody>
                                         <!-- /END TABLE BODY -->
                                    </table>
                                </div>
                                 <!-- /END RESPONSIVE TABLE -->

                            <!-- BUTTONS -->
                            <?php if ($this->session->userdata('read_only') == 0): ?>

                                <div class="feci-buttons recap-buttons-container">
                                    <div>
                                        <?php if ($job['is_locked'] == 0): ?>
                                            <input type="submit" class="primary" id="save_recap" value="save recap" /> 
                                        <?php endif; ?>
                                        <?php if ($this->session->userdata('is_admin') == 1): ?>
                                            <?php if ($job['is_locked'] == 1): ?>
                                                <button class="danger" id="unlock_job">Unlock Job</button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($job['is_locked'] == 0): ?>
                                                <button class="danger" id="lock_job">Lock Job</button>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <?php if ($this->session->userdata('user_idn') == 3 || $this->session->userdata('user_idn') == 32): ?>
                                            <button class="primary" id="accounting">Accounting Data</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                             <!-- /END BUTTONS -->

                            <?php echo form_close(); ?>
                            <!-- /END WEB FORM -->
                        </div>
                    </div>
                    <!-- end: RESPONSIVE TABLE PANEL -->
                </div>
            </div>
            <!-- end: PAGE CONTENT-->
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->

<!-- Modal Dialogs //-->
<?php $this->load->view('job/modals/parent'); ?>
<?php $this->load->view('job/modals/copy_job'); ?>
<?php $this->load->view('job/modals/remove_child_jobs'); ?>
<?php $this->load->view('job/modals/delete_jobs'); ?>
<?php $this->load->view('modals/confirmation'); ?>

<?php $this->load->view('inc/footer'); ?>

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="<?php echo base_url();?>assets/js/index.js"></script>

<?php $this->load->view('js/user'); ?>
<?php $this->load->view('js/job'); ?>

<script type="text/javascript" src="<?php echo base_url(); ?>js/pages/job/recap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/pages/job/copy_job.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/pages/job/export.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>lib/jsPDF-1.3.2/jspdf.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>lib/html2canvas-1.0.0-rc.7/html2canvas.min.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

<script>
jQuery(document).ready(function () {
    Main.init();
    //Index.init();
});
</script>

</body>
</html>