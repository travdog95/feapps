<?php $this->load->view('inc/header'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>lib/DataTables-1.10.10/css/dataTables.bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/pages/job/information.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>lib/Chosen-1.6.2/chosen.min.css" type="text/css">
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
    'id' => 'job_information'
);
echo form_open('job/save_information', $form_attributes);
?>

<!-- start: PAGE CONTENT -->
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-12">
			<?php if (!empty($job)): ?>
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="department" class="col-xs-2 col-form-label">Department</label>
                    <div class="col-xs-10">
                        <span id="department"><?php echo quotes_to_entities($job['department_name']); ?></span>
                        <input type="hidden" id="department_idn" name="department_idn" value="<?php echo $job['department_idn']; ?>" />
                    </div>
                </div>
                <div class="form-group row" id="is_parent_container" style="display:none;">
                    <label class="col-xs-2 col-form-label">Parent?</label>
                    <div class="col-xs-10">
                        <input type="radio" name="is_parent" id="is_parent_yes" value="Y" <?php if ($job['is_parent'] == "1") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_parent_yes">Yes</label>
                        <input type="radio" name="is_parent" id="is_parent_no" value="N" <?php if ($job['is_parent'] == "0") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_parent_no">No</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">Job Number</label>
                    <div class="col-xs-10">
                        <span><?php if ($job['job_number'] != "0") echo $job['job_number']; ?></span><?php if ($job['new_change_order'] == 1): ?>
                        <span><em>--New Change Order--</em></span><?php endif; ?><?php if ($job['is_parent'] == 1): ?>
                        <span><em>--PARENT--</em></span><?php endif; ?>
                        <input type="hidden" name="job_number" id="job_number" value="<?php echo $job['job_number']; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">Created By</label>
                    <div class="col-xs-10">
                        <span id="created_by"><?php echo quotes_to_entities($job['created_by_name']); ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">Creation Date</label>
                    <div class="col-xs-10">
                        <span id="create_date"><?php echo $job['created_date']; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">Prepared By</label>
                    <div class="col-xs-10">
                        <select id="prepared_bys" name="prepared_bys[]" class="form-control input-sm chosen-select" data-placeholder="Choose prepared by..." multiple><?php foreach($prepared_bys as $user_idn => $name): ?>
                            <option value="<?php echo $user_idn; ?>" <?php if (in_array($user_idn, $job['prepared_bys'])) echo ' selected="selected"'; ?>><?php echo quotes_to_entities($name); ?></option><?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">Share?</label>
                    <div class="col-xs-10">
                        <input type="radio" name="is_shareable" id="is_shareable_yes" value="Y" <?php if ($job['is_shareable'] == "Y") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_shareable_yes">Yes</label>
                        <input type="radio" name="is_shareable" id="is_shareable_no" value="N" <?php if ($job['is_shareable'] == "N") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_shareable_no">No</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">Name</label>
                    <div class="col-xs-10">
                        <input type="text" name="name" id="name" value="<?php echo quotes_to_entities($job['name']); ?>" data-recent-value="<?php echo quotes_to_entities($job['name']); ?>" class="monitor-change form-control input-sm" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">Contractor</label>
                    <div class="col-xs-10">
                        <input type="text" name="contractor" id="contractor" class="form-control input-sm monitor-change" value="<?php echo quotes_to_entities($job['contractor']); ?>" data-recent-value="<?php echo quotes_to_entities($job['contractor']); ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">Status</label>
                    <div class="col-xs-10">
                        <select id="status" name="status" data-original_value="<?php echo $job['status_idn']; ?>" class="monitor-change form-control input-sm"><?php foreach($statuses as $status_idn => $status): ?>
                            <option value="<?php echo $status_idn; ?>" <?php if ($job['status_idn'] == $status_idn) echo ' selected="selected"'; ?>><?php echo quotes_to_entities($status); ?></option><?php endforeach; ?>
                        </select>
                    </div>
                </div>
				<?php if ($job['department_idn'] == 1): ?>
<!--                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">Estimate Type</label>
                    <div class="col-xs-10">
                        <select id="estimate_type" name="estimate_type" data-recent-value="<?php echo $job['estimate_type_idn']; ?>" class="monitor-change form-control input-sm"><?php foreach($estimate_types as $estimate_type_idn => $estimate_type): ?>
                            <option value="<?php echo $estimate_type_idn; ?>" <?php if ($job['estimate_type_idn'] == $estimate_type_idn) echo ' selected="selected"'; ?>><?php echo quotes_to_entities($estimate_type); ?></option><?php endforeach; ?>
                        </select>
                    </div>
                </div>
                -->
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-label">Job Type</label>
                        <div class="col-xs-10">
                            <select id="job_type" name="job_type" data-recent-value="<?php echo $job['job_type_idn']; ?>" class="monitor-change form-control input-sm"><?php foreach($job_types as $job_type_idn => $job_type): ?>
                                <option value="<?php echo $job_type_idn; ?>" <?php if ($job['job_type_idn'] == $job_type_idn) echo ' selected="selected"'; ?>><?php echo quotes_to_entities($job_type); ?></option><?php endforeach; ?>
                            </select>
                        </div>
                    </div>
				<?php endif; ?>

                <?php if ($job['department_idn'] == 2): ?>

                <div class="is_joint_job form-group row">
                    <label class="col-xs-2 col-form-label">Joint Job?</label>
                    <div class="col-xs-10">
                        <input type="radio" name="is_joint_job" id="is_joint_job_yes" value="Y" <?php if ($job['is_joint_job'] == "Y") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_joint_job_yes">Yes</label>
                        <input type="radio" name="is_joint_job" id="is_joint_job_no" value="N" <?php if ($job['is_joint_job'] == "N") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_joint_job_no">No</label>
                    </div>
                </div>
                <div class="is_underground form-group row">
                    <label class="col-xs-2 col-form-label">Underground?</label>
                    <div class="col-xs-10">
                        <input type="radio" name="is_underground" id="is_underground_yes" value="Y" <?php if ($job['is_underground'] == "Y") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_underground_yes">Yes</label>
                        <input type="radio" name="is_underground" id="is_underground_no" value="N" <?php if ($job['is_underground'] == "N") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_underground_no">No</label>
                        <span class="underground_options" style="display:none;">
                            &nbsp;<strong>&rsaquo;&rsaquo;</strong>&nbsp;
                            <input type="radio" name="underground_options" id="underground_out" value="Y" <?php if ($job['underground_options'] == "Y") echo ' checked="checked"'; ?> class="monitor-change" /><label for="underground_out">5' 0" Out</label>
                            <input type="radio" name="underground_options" id="underground_other" value="N" <?php if ($job['underground_options'] == "N") echo ' checked="checked"'; ?> class="monitor-change" /><label for="underground_other">Other</label>
                        </span>
                    </div>
                </div>
				<?php endif; ?>
            </div>

            <div class="col-md-6">
                <?php if ($job['department_idn'] == 2): ?>

                    <div class="system_types form-group row">
                        <label class="col-xs-2 col-form-label">System Types</label>
                        <div class="col-xs-10">
                            <?php $i = 0; ?>
                            <?php foreach($system_types as $system_type_idn => $system_type_name): ?>
                                <?php $i++;
                                if ($i > 1): ?>
                                <!--<label  class="field_label">&nbsp;</label>-->
                                <?php endif; ?>
                                <input type="checkbox" class="system_type monitor-change" name="system_types[]" id="system_type<?php echo $system_type_idn; ?>" value="<?php echo $system_type_idn; ?>" <?php if (in_array($system_type_idn, $job['system_types'], true)) echo ' checked="checked"'; ?> />
                                <label for="system_type<?php echo $system_type_idn; ?>"><?php echo quotes_to_entities($system_type_name); ?></label><?php if (!empty($system_sub_types[$system_type_idn])): ?><?php foreach($system_sub_types[$system_type_idn] as $system_sub_type_idn => $system_sub_type_name): ?>
                                <input type="checkbox" class="system_sub_type<?php echo $system_type_idn; ?> monitor-change" name="system_sub_types[]" id="system_sub_type<?php echo $system_sub_type_idn; ?>" value="<?php echo $system_sub_type_idn; ?>" <?php if (in_array($system_sub_type_idn, $job['system_sub_types'], true)) echo ' checked="checked"'; ?> />
                                <label for="system_sub_type<?php echo $system_sub_type_idn; ?>"><?php echo quotes_to_entities($system_sub_type_name); ?></label><?php endforeach; ?><?php endif; ?>
                                <br />
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!--<div class="grooved_fitting form-group row">
                        <label class="col-xs-2 col-form-label">Grooved Fitting</label>
                        <div class="col-xs-10">
                            <select name="grooved_fitting" id="grooved_fitting" data-recent-value="<?php echo $job['grooved_fitting']; ?>" class="monitor-change form-control input-sm">
                                <option value="0"></option><?php foreach($grooved_fittings as $idn => $name): ?>
                                <option value="<?php echo $idn; ?>" <?php if ($idn == $job['grooved_fitting']) echo ' selected="selected"'; ?>><?php echo quotes_to_entities($name); ?></option><?php endforeach; ?>
                            </select>
                        </div>
                    </div>-->
				<?php endif; ?>
                <div class="is_domestic_required form-group row">
                    <label class="col-xs-2 col-form-label">Domestic Required?</label>
                    <div class="col-xs-10">
                        <input type="radio" name="is_domestic_required" id="is_domestic_required_yes" value="Y" <?php if ($job['is_domestic_required'] == "Y") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_domestic_required_yes">Yes</label>
                        <input type="radio" name="is_domestic_required" id="is_domestic_required_no" value="N" <?php if ($job['is_domestic_required'] == "N") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_domestic_required_no">No</label>
                        <span class="domestic_options" style="display:none;">
                            &nbsp;<strong>&rsaquo;&rsaquo;</strong>&nbsp;
                            <input type="radio" name="domestic_options" id="domestic_pipe_fittings" value="Y" <?php if ($job['domestic_options'] == "Y") echo ' checked="checked"'; ?> class="monitor-change" /><label for="domestic_pipe_fittings">Pipes &amp; Fittings</label>
                            <input type="radio" name="domestic_options" id="domestic_pipe_only" value="N" <?php if ($job['domestic_options'] == "N") echo ' checked="checked"'; ?> class="monitor-change" /><label for="domestic_pipe_only">Pipe Only</label>
                        </span>
                    </div>
                </div>
                <div class="is_seamless_required form-group row">
                    <label class="col-xs-2 col-form-label">Seamless Required?</label>
                    <div class="col-xs-10">
                        <input type="radio" name="is_seamless_required" id="is_seamless_required_yes" value="Y" <?php if ($job['is_seamless_required'] == "Y") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_seamless_required_yes">Yes</label>
                        <input type="radio" name="is_seamless_required" id="is_seamless_required_no" value="N" <?php if ($job['is_seamless_required'] == "N") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_seamless_required_no">No</label>
                    </div>
                </div>
				<?php if ($job['department_idn'] == 1): ?>
                <div class="is_parts_smarts form-group row">
                    <label class="col-xs-2 col-form-label">Parts & Smarts?</label>
                    <div class="col-xs-10">
                        <input type="radio" name="is_parts_smarts" id="is_parts_smarts_yes" value="Y" <?php if ($job['is_parts_smarts'] == "Y") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_parts_smarts_yes">Yes</label>
                        <input type="radio" name="is_parts_smarts" id="is_parts_smarts_no" value="N" <?php if ($job['is_parts_smarts'] == "N") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_parts_smarts_no">No</label>
                    </div>
                </div>
				<?php endif; ?>
				<?php if ($job['department_idn'] == 2): ?>
                <div class="is_fm_job form-group row">
                    <label class="col-xs-2 col-form-label">FM Job?</label>
                    <div class="col-xs-10">
                        <input type="radio" name="is_fm_job" id="is_fm_job_yes" value="Y" <?php if ($job['is_fm_job'] == "Y") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_fm_job_yes">Yes</label>
                        <input type="radio" name="is_fm_job" id="is_fm_job_no" value="N" <?php if ($job['is_fm_job'] == "N") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_fm_job_no">No</label>
                    </div>
                </div>
				<?php endif; ?>
                <div class="is_davis_bacon_job form-group row">
                    <div class="col-md-2">
                        <label class="col-form-label">Davis Bacon Job?</label>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" name="is_davis_bacon_job" id="is_davis_bacon_job_yes" value="Y" <?php if ($job['is_davis_bacon_job'] == "Y") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_davis_bacon_job_yes">Yes</label>
                        <input type="radio" name="is_davis_bacon_job" id="is_davis_bacon_job_no" value="N" <?php if ($job['is_davis_bacon_job'] == "N") echo ' checked="checked"'; ?> class="monitor-change" /><label for="is_davis_bacon_job_no">No</label>
                    </div>
                    <div class="col-md-8">
                        <span class="davis_bacon_pac" style="display:none;">
                            <div class="input-group">
                                <input type="text" name="davis_bacon_pac" id="davis_bacon_pac" value="<?php echo $job['davis_bacon_pac']; ?>" data-recent-value="<?php echo $job['davis_bacon_pac']; ?>" title="Davis Bacon P.A.C." class="monitor-change check_num2 form-control input-sm" placeholder="Davis Bacon PAC %" />
                                <span class="input-group-addon">%</span>
                            </div>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="miles_to_job" class="col-form-label">Miles to Job</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" id="miles_to_job" name="miles_to_job" value="<?php echo $job['miles_to_job']; ?>" data-recent-value="<?php echo $job['miles_to_job']; ?>" class="monitor-change check_num2 form-control input-sm" />
                    </div>
                </div>

                <?php if ($job['department_idn'] == 2): ?>
                <div class="has_overtime form-group row">
                    <label class="col-xs-2 col-form-label">Does this project have OT, Shift or Holiday work?</label>
                    <div class="col-xs-10">
                        <input type="radio" name="has_overtime" id="has_overtime_yes" value="Y" <?php if (@$job['has_overtime'] == "Y") echo ' checked="checked"'; ?> class="monitor-change" /><label for="has_overtime_yes">Yes</label>
                        <input type="radio" name="has_overtime" id="has_overtime_no" value="N" <?php if (@$job['has_overtime'] == "N") echo ' checked="checked"'; ?> class="monitor-change" /><label for="has_overtime_no">No</label>
                        <span class="overtime_message" style="display:none;">
                            <strong><em>Adjust Labor Rates accordingly!</em></strong>
                        </span>
                    </div>
                </div>
				<?php endif; ?>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="field_labor_rate" class="col-form-label">Field Labor</label>
                        <div class="labor_rates input-group">
                            <span class="input-group-addon">$</span>
                            <input type="text" id="field_labor_rate" name="field_labor_rate" class="labor_rate monitor-change check_num2 form-control input-sm" value="<?php echo $job['field_labor_rate']; ?>" data-recent-value="<?php echo $job['field_labor_rate']; ?>" title="Field Labor Rate" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="design_labor_rate" class="col-form-label">Design Labor</label>
                        <div class="labor_rates input-group">
                            <span class="input-group-addon">$</span>
                            <input type="text" id="design_labor_rate" name="design_labor_rate" class="labor_rate monitor-change check_num2 form-control input-sm" value="<?php echo $job['design_labor_rate']; ?>" data-recent-value="<?php echo $job['design_labor_rate']; ?>" title="Design Labor Rate" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="shop_labor_rate" class="col-form-label">Shop Labor</label>
                        <div class="labor_rates input-group">
                            <span class="input-group-addon">$</span>
                            <input type="text" id="shop_labor_rate" name="shop_labor_rate" class="labor_rate monitor-change check_num2 form-control input-sm" value="<?php echo $job['shop_labor_rate']; ?>" data-recent-value="<?php echo $job['shop_labor_rate']; ?>" title="Shop Labor Rate" />
                        </div>
                </div>

            </div>
			<?php else: ?>
				Job does not exist!
			<?php endif; ?>
        </div>
    </div>
	</div>
    <?php if ($this->session->userdata('read_only') == 0): ?>

        <div class="row">
            <div class="buttons-recap feci-buttons">
                <p>
                    <input type="submit" id="save" name="save" class="save-button primary" value="Save">
                    <input type="submit" id="save_goto_recap" name="save_goto_recap" class="save-button primary" value="Save &amp; Go recap">
                </p>
                <input type="hidden" name="button_clicked" id="button_clicked" value="" />
            </div>
        </div>
    <?php endif; ?>
    
        <?php echo form_close(); ?>
    </div> <!-- END: container -->
</div> <!-- end: MAIN-CONTENT -->
</div> <!-- end: MAIN CONTAINER -->
        
<?php $this->load->view('inc/footer'); ?>

<?php $this->load->view('js/user'); ?>
<?php $this->load->view('js/job'); ?>

<script src="<?php echo base_url(); ?>lib/Chosen-1.6.2/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/pages/job/information.js"></script>
<script>
jQuery(document).ready(function() {
	Main.init();
}); 
</script>
</body>
</html>