<div class="modal fade" id="SelectJobModal" tabindex="-1">
    <div class="modal-dialog dynamic-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Job</h4>
            </div>
			<?php echo form_open("", array("id" => "SelectJobForm")); ?>
            <div class="modal-body">
                <!--<input type="hidden" id="AddJobsToFolder-Folder_Idn" name="AddJobsToFolder-Folder_Idn" value="" />-->
                <table id="SelectJobTable" class="table table-striped table-hover table-bordered display" summary="Job search results." style="width:100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Job Date</th>
                            <th>Job Number</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <span class="modal-message"></span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="SelectJob" class="btn btn-primary">Select</button>
                <div style="clear:both;"></div>
            </div><?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->