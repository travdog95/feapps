<div class="modal fade" id="AddJobsToFolderModal" tabindex="-1">
    <div class="modal-dialog dynamic-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Jobs to '<span id="AddJobsToFolder_FolderName"></span>'</h4>
            </div>
			<?php echo form_open("", array("id" => "AddJobsToFolderForm")); ?>
            <div class="modal-body">
				<input type="hidden" id="AddJobsToFolder-Folder_Idn" name="AddJobsToFolder-Folder_Idn" value="" />
				<table id="AddJobsToFolderTable" class="table table-striped table-hover table-condensed table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th></th>
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
                <button type="submit" id="AddJobs" class="btn btn-primary">Add</button>
                <div style="clear:both;"></div>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->