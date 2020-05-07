<div class="modal fade" id="AddAreaModal" tabindex="-1">
    <div class="modal-dialog dynamic-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Area</h4>
            </div>
            <?php echo form_open("", array("id" => "AddAreaForm")); ?>
            <div class="modal-body">
                <input type="hidden" id="NewAreaJobNumber" name="NewAreaJobNumber" value="" />
                <input type="hidden" id="NewAreaWorksheetMaster_Idn" name="NewAreaWorksheetMaster_Idn" value="" />
                <div class="form-group">
                    <label for="NewAreaName">Area Name</label>
                    <input type="text" class="form-control" id="NewAreaName" name="NewAreaName" placeholder="Name" />
                </div>
                <div class="form-group">
                    <label for="NewAreaPosition">Position</label>
                    <select id="NewAreaPosition" name="NewAreaPosition" class="form-control">
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <span class="modal-message"></span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="AddArea" class="btn btn-primary">Add</button>
                <div style="clear:both;"></div>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->