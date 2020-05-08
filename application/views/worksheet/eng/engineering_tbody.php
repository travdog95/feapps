<tbody id="BasicAppropriations">
<?php
//Load model
$this->load->model("m_worksheet_basic_appropriation");

//Get job keys
$job_keys = get_job_keys($job['job_number']);

//Get areas
$areas = $this->m_reference_table->get_where("WorksheetAreas", array("Job_Idn" => $job_keys[0], "ChangeOrder" => $job_keys[1], "WorksheetMaster_Idn" => 9), "Rank ASC");
//Get Labor Classes
$both_labor_classes = $this->m_reference_table->get_where("AdjustmentSubFactors", "ActiveFlag = 1 AND AdjustmentFactor_Idn in (34,35)", "AdjustmentFactor_Idn ASC, Rank ASC");
//Get Individual Adjustment Factors
$individual_adjustment_factors = $this->m_reference_table->get_where("AdjustmentSubFactors", array("AdjustmentFactor_Idn" => 36, "ActiveFlag" => 1), "Rank ASC");
array_unshift($individual_adjustment_factors, array("AdjustmentSubFactor_Idn" => 0, "Value" => 1, "Name" => "--None--"));
//Get associated Cross Mains and Lines Recap worksheet
$mains_lines_worksheet_idn = $this->m_reference_table->get_field("Worksheets", "Worksheet_Idn", array("Job_Idn" => $job_keys[0], "ChangeOrder" => $job_keys[1], "WorksheetMaster_Idn" => 32));

$labor_classes = array();
$adjustment_factor_idn = 0;
$pipe_exposure = 0;
foreach($both_labor_classes as $lc)
{
    if ($adjustment_factor_idn != $lc['AdjustmentFactor_Idn'])
    {
        $adjustment_factor_idn = $lc['AdjustmentFactor_Idn'];
    }

    $labor_classes[$adjustment_factor_idn][] = $lc;
}

if (sizeof($areas) > 0)
{
    foreach($areas as $area)
    {
        //Load area row
        $this->load->view("worksheet/eng/engineering_area_row", array("Row" => $area));

        //Load basic appropriations
        $basic_appropriations = $this->m_worksheet_basic_appropriation->get_by_worksheet_idn($worksheet['Worksheet_Idn'], $area['WorksheetArea_Idn']);

        foreach ($basic_appropriations as $ba)
        {
            $pipe_exposure = ($ba['Parm_Idn'] == 1) ? 34 : 35;
            $ba['RowType'] = "Worksheet";
            $this->load->view("worksheet/eng/engineering_basic_appropriations_row", array("Row" => $ba, "LaborClasses" => $labor_classes[$pipe_exposure], "IndividualAdjustmentFactors" => $individual_adjustment_factors));
        }

        //Area Miscellaneous Items
        $area_misc_items = $this->m_reference_table->get_where("MiscellaneousDetails", "Worksheet_Idn = {$mains_lines_worksheet_idn} AND WorksheetCategory_Idn = 138 AND WorksheetArea_Idn = {$area['WorksheetArea_Idn']}", "LineNum ASC");

        foreach($area_misc_items as $m)
        {
            $m['RowType'] = "Miscellaneous";
            $m['BranchLineWorksheet_Idn'] = 0;
            $this->load->view("worksheet/eng/engineering_basic_appropriations_row", array("Row" => $m));
        }
    }
}
?>
    <tr class="worksheet-total">
        <td colspan="2">
            <span class="pull-left">Total Heads</span>
        </td>
        <td class="whitebgfill">
            <span id="BasicAppropriationsTotalHeads">0</span>
        </td>
        <td colspan="3">
            &nbsp;
        </td>
        <td class="whitebgfill">
            &lt;<span id="BasicAppropriationsEngineeringHoursSubTotal"></span>&gt;
        </td>
    </tr>
</tbody>
<?php
$adjustment_factors = $this->m_reference_table->get_where("AdjustmentSubFactors", "AdjustmentFactor_Idn = 37 AND ActiveFlag = 1", "Rank ASC");
?>
<tbody id="AdjustmentFactors">
    <tr class="worksheet-total">
        <td colspan="7">
        <?php if ($this->session->userdata('read_only') == 0): ?>
            <select id="AdjustmentFactorsSelect" class="btn btn-sm" multiple="multiple">
                <?php foreach($adjustment_factors as $af): ?>
                <option value="<?php echo $af['AdjustmentSubFactor_Idn']; ?>" data-value="<?php echo $af['Value']; ?>"><?php echo quotes_to_entities($af['Name']); ?></option>
                <?php endforeach; ?>
            </select>
        <?php else: ?>
            <strong>Adjustment Factors</strong>
        <?php endif; ?>

        </td>
    </tr>
    <?php 
    //Get Adjustment factors
    $worksheet_adjustment_factors = $this->m_worksheet->get_adjustment_factors_by_worksheet_idn($worksheet['Worksheet_Idn']);

    foreach ($worksheet_adjustment_factors as $af)
    {
        $this->load->view("worksheet/eng/engineering_adjustment_factor_row", array("Row" => $af));
    }
    ?>
    <tr class="worksheet-total">
        <td colspan="6">
            <span class="pull-left">Basic Appropriations Total</span>
        </td>
        <td class="whitebgfill">
            &lt;<span id="BasicAppropriationsEngineeringHoursTotal"></span>&gt;
        </td>
    </tr>
</tbody>

<tbody id="AdditionalCosts">
    <tr class="worksheet-total">
        <td colspan="7">
            <?php if ($this->session->userdata('read_only') == 0): ?>

                <?php
                //Get Adjustment factors
                $additional_costs = $this->m_reference_table->get_where("EngineeringAdditionalCosts", "Parent_Idn = 0 AND DefaultFlag = 0", "Rank ASC");
                ?>
                <select id="AdditionalCostsSelect" class="btn btn-sm" multiple="multiple">
                    <?php foreach($additional_costs as $ac): ?>
                    <option value="<?php echo $ac['EngineeringAdditionalCost_Idn']; ?>" data-manhours="<?php echo $ac['ManHours']; ?>" data-quantity="<?php echo $ac['Quantity']; ?>" data-defaultflag="<?php echo $ac['DefaultFlag']; ?>" data-rank="<?php echo $ac['Rank']; ?>"><?php echo quotes_to_entities($ac['Name']); ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>

        </td>
    </tr>
    <?php
    $worksheet_additoinal_costs = $this->m_worksheet->get_engineering_additional_costs_by_worksheet_idn($worksheet['Worksheet_Idn']);
    foreach ($worksheet_additoinal_costs as $ac)
    {
        $this->load->view("worksheet/eng/engineering_additional_costs_row", array("Row" => $ac));
    }
    ?>
</tbody>
