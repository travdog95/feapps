<?php
if (1 == 1)
{
	$this->load->model('m_reference_table');
	$pipe_exposures = $this->m_reference_table->get_where("PipeExposures", "ActiveFlag = 1", "Rank ASC");
	$coverage_types = $this->m_reference_table->get_where("CoverageTypes", "ActiveFlag = 1", "Rank ASC");
	$head_types = $this->m_reference_table->get_where("HeadTypes", "ActiveFlag = 1", "Rank ASC");
}
?>

<div class="modal fade" id="AddWorksheetModal" tabindex="-1">
    <div class="modal-dialog dynamic-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="AddWorksheetModal_Action"></span> Worksheet</h4>
            </div>
            <?php echo form_open("", array("id" => "AddWorksheetForm")); ?>
            <div class="modal-body">
                <input type="hidden" id="AddWorksheetModal_JobNumber" name="AddWorksheetModal_JobNumber" value="<?php echo $job['job_number']; ?>" />
                <input type="hidden" id="AddWorksheetModal_WorksheetMaster_Idn" name="AddWorksheetModal_WorksheetMaster_Idn" value="" />
                <input type="hidden" id="AddWorksheetModal_ChildWorksheetMaster_Idn" name="AddWorksheetModal_ChildWorksheetMaster_Idn" value="" />
                <input type="hidden" id="AddWorksheetModal_WorksheetArea_Idn" name="AddWorksheetModal_WorksheetArea_Idn" value="" />
                <input type="hidden" id="AddWorksheetModal_Worksheet_Idn" name="AddWorksheetModal_Worksheet_Idn" value="" />
                <input type="hidden" id="AddWorksheetModal_WorksheetCategory_Idn" name="AddWorksheetModal_WorksheetCategory_Idn" value="" />
                <input type="hidden" id="AddWorksheetModal_FieldLaborRate" name="AddWorksheetModal_FieldLaborRate" value="" />

                <div class="checkbox copy-worksheet-checkbox">
                    <label>
                        <input id="CopyWorksheetCheckbox" name="CopyWorksheetCheckbox" type="checkbox"> Copy Worksheet?
                    </label>
                </div>

                <div id="CopyFromJobDiv" class="form-inline copy-from-job display_none">
                    <div class="form-group">
                        <input type="text" id="CopyFromJob" name="CopyFromJob" class="form-control" placeholder="Copy From Job" />
                    </div>
                    <button type="button" id="SearchJobs" class="btn btn-default search-jobs" title="Search Jobs">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </button>
                    <div class="form-group">
                        <p class="form-control-static" id="CopyJobName">&nbsp;</p>
                    </div>
                </div>
                <div class="form-group copy-from-job display_none">
                    <label for="CopyFromJobWorksheet">Select Worksheet</label>
                    <select id="CopyFromJobWorksheet" name="CopyFromJobWorksheet" class="form-control">
                    </select>
                </div>

                <div class="form-group branch-line copy-from-job-branch-line hide">
                    <label for="AddWorksheetModal_PipeExposure">Pipe Exposure</label>
                    <select id="AddWorksheetModal_PipeExposure" name="PipeExposure" class="form-control">
                        <?php foreach($pipe_exposures as $p): ?>
                            <option value="<?php echo $p['PipeExposure_Idn']; ?>"><?php echo quotes_to_entities($p['Name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group branch-line copy-from-job-branch-line hide">
                    <label for="HeadType">Head Type</label>
                    <select id="HeadType" name="HeadType" class="form-control">
                        <?php foreach($head_types as $h): ?>
                            <option value="<?php echo $h['HeadType_Idn']; ?>"><?php echo quotes_to_entities($h['Name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group branch-line copy-from-job-branch-line hide">
                    <label for="CoverageType">Coverage Type</label>
                    <select id="CoverageType" name="CoverageType" class="form-control">
                        <?php foreach($coverage_types as $c): ?>
                            <option value="<?php echo $c['CoverageType_Idn']; ?>"><?php echo quotes_to_entities($c['Name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="AddWorksheetName">Worksheet Name</label>
                    <input type="text" id="AddWorksheetName" name="AddWorksheetName" class="form-control" placeholder="Name" />
                </div>
                <div class="form-group branch-line hide">
                    <label for="AddWorksheetArea"><span class="AddWorksheetModal_Action">Add</span> to Area</label>
                    <select id="AddWorksheetArea" name="AddWorksheetArea" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <label for="AddWorksheetPosition">Position</label>
                    <select id="AddWorksheetPosition" name="AddWorksheetPosition" class="form-control">
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <span class="modal-message"></span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="AddWorksheet" class="btn btn-primary AddWorksheetModal_Action">Add</button>
                <div style="clear:both;"></div>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->