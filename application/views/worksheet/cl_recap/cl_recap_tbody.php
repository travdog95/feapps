<?php
$job_keys = get_job_keys($job['job_number']);
?>
<tbody id="CrossmainHeader">
    <tr class="bold">
        <th colspan="2">
            Crossmain<br />
            <?php if ($this->session->userdata('read_only') == 0): ?>
                <button id="OpenAddWorksheetModal" class="btn btn-primary btn-xs openAddWorksheetModal" title="Add Worksheet" data-worksheet_master_idn="10">Add Worksheet</button>&nbsp;
                <button id="AddCrossmainMiscellaneousItem" class="btn btn-primary btn-xs add-miscellaneous" title="Add Miscellaneous Item" data-worksheet_master_idn="10" data-source="139">Add Misc Item</button>
            <?php endif; ?>
        </th>
        <th>No. of Systems</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>Cost Per Main</th>
        <th>Total List Price</th>
        <th>Man Hrs Per Item</th>
        <th>Total Man Hours</th>
        <th>Man Hrs Per Item</th>
        <th>Total Man Hours</th>
    </tr>
</tbody>
<tbody id="CrossmainBody">
<?php 
if (isset($child_worksheet_details[139]))
{
    $crossmain_worksheets = $child_worksheet_details[139];
    foreach($crossmain_worksheets as $w)
    {
        $this->load->view("worksheet/cl_recap/cl_recap_crossmain_row", array("Row" => $w));
    }
}

//Crossmain Miscellaneous Items
if (isset($miscellaneous_products[139]))
{
    $crossmain_misc_items = $miscellaneous_products[139];
    foreach($crossmain_misc_items as $m)
    {
        $this->load->view("worksheet/cl_recap/cl_recap_misc_row", array("Row" => $m));
    }
}
?>
</tbody>
<tbody id="BranchlineHeader">
    <tr class="bold">
        <th colspan="2">Branch Lines<br />
            <?php if ($this->session->userdata('read_only') == 0): ?>
                <button id="OpenAddAreaModal" class="btn btn-primary btn-xs" title="Add Area">Add Area</button>
            <?php endif; ?>
        </th>
        <th>No. of Heads</th>
        <th>Head Type</th>
        <th>Coverage Type</th>
        <th>Cost Per Head</th>
        <th>Total List Price</th>
        <th>Man Hrs Per Item</th>
        <th>Total Man Hours</th>
        <th>Man Hrs Per Item</th>
        <th>Total Man Hours</th>
    </tr>
</tbody>
<tbody id="BranchlineBody">
    <?php
    $areas = $this->m_reference_table->get_where("WorksheetAreas", array("Job_Idn" => $job_keys[0], "ChangeOrder" => $job_keys[1], "WorksheetMaster_Idn" => 9), "Rank ASC");
    $coverage_types = $this->m_reference_table->get_where("CoverageTypes", "ActiveFlag = 1", "Rank ASC");
    $head_types = $this->m_reference_table->get_where("HeadTypes", "ActiveFlag = 1", "Rank ASC");

    if (sizeof($areas) > 0)
    {
        foreach($areas as $area)
        {
            //Add num_cols
            $this->load->view("worksheet/cl_recap/cl_area_row", array("Row" => $area));

            //Load worksheets
            $area_worksheets = $this->m_reference_table->get_fields("Worksheets", "Worksheet_Idn", array("WorksheetArea_Idn" => $area['WorksheetArea_Idn']), "Rank ASC");

            foreach ($area_worksheets as $area_worksheet)
            {
                $w = array();
                $w = $child_worksheet_details[138][$area_worksheet['Worksheet_Idn']];
                $w['CoverageTypes'] = $coverage_types;
                $w['HeadTypes'] = $head_types;
                
                $this->load->view("worksheet/cl_recap/cl_recap_branchline_row", array("Row" => $w));
            }

            //Area Miscellaneous Items
            $area_misc_items = $this->m_reference_table->get_where("MiscellaneousDetails", "Worksheet_Idn = {$worksheet['Worksheet_Idn']} AND WorksheetCategory_Idn = 138 AND WorksheetArea_Idn = {$area['WorksheetArea_Idn']}", "LineNum ASC");
            foreach($area_misc_items as $m)
            {
                $m['RowType'] = "Miscellaneous";
                $this->load->view("worksheet/cl_recap/cl_recap_misc_row", array("Row" => $m));
            }
        }
    }
    ?>
</tbody>
<tbody id="FinishWork">
    <tr>
        <td colspan="<?php echo $worksheet_master['NumberOfColumns']; ?>" class="left-aligned bold">
            Finish Work &nbsp;&nbsp;
            <?php if ($this->session->userdata('read_only') == 0): ?>
                <!--<a href="#" id="AddFinishWork" class="add-miscellaneous" data-source="140">Add Finish Work</a>&nbsp;&nbsp;-->
                <input type="checkbox" id="NoFinishWork" name="NoFinishWork" value="1" <?php if ($worksheet['NoFinishWorkFlag'] == 1) echo 'checked="checked"'; ?> /> <label for="NoFinishWork">No Finish Work</label>
            <?php endif; ?>
        </td>
    </tr>
    <?php
    if(isset($miscellaneous_products[140]))
    {
        $finish_work = $miscellaneous_products[140];
        foreach ($finish_work as $f)
        {
            $this->load->view("worksheet/cl_recap/cl_recap_finish_work_row", array("Row" => $f));
        }
    }
    ?>
</tbody>
<tbody id="Miscellaneous">
    <tr>
        <td colspan="<?php echo $worksheet_master['NumberOfColumns']; ?>" class="left-aligned">
            <?php if ($this->session->userdata('read_only') == 0): ?>
                <a href="#" id="AddMiscellaneousItem" class="add-miscellaneous" data-source="108">Add Miscellaneous Item</a>&nbsp;&nbsp;
            <?php else: ?>
                <strong>Miscellaneous Items</strong>
            <?php endif; ?>
        </td>
    </tr>
    <?php
    if(isset($miscellaneous_products[108]))
    {
        $misc_items = $miscellaneous_products[108];
        foreach ($misc_items as $m)
        {
            $this->load->view("worksheet/cl_recap/cl_recap_misc_row", array("Row" => $m));
        }
    }
    ?>
</tbody>
