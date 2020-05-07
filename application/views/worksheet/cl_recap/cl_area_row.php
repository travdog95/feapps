<tr id="WorksheetArea_<?php echo $Row['WorksheetArea_Idn']; ?>" class="worksheet-area bold danger">
    <td>
        <input id="DeleteWorksheetArea_<?php echo $Row['WorksheetArea_Idn']; ?>" name="Delete[]" type="checkbox" class="delete" value="WorksheetArea_<?php echo $Row['WorksheetArea_Idn']; ?>" />
    </td>
    <td colspan="<?php echo $worksheet_master['NumberOfColumns'] - 1; ?>">
        <span class="pull-left">
			<!--
            <button id="CopyWorksheetArea<?php echo $Row['WorksheetArea_Idn']; ?>" class="btn btn-default btn-xs copy-area" data-worksheet_area_name="" data-worksheet_area_idn="<?php echo $Row['WorksheetArea_Idn']; ?>" title="Copy Worksheet Area" type="button">
                <span class="glyphicon glyphicon-copy glyphicon-xs" aria-hidden="true"></span>
            </button>
			-->
            <span class="area-name" data-worksheet_area_idn="<?php echo $Row['WorksheetArea_Idn']; ?>">
                <a href="#" id="WorksheetAreaName<?php echo $Row['WorksheetArea_Idn']; ?>" class="area-name-inline" data-pk="<?php echo $Row['WorksheetArea_Idn']; ?>" ><?php echo quotes_to_entities($Row['Name']); ?></a>
            </span>
            <button id="AddWorksheetToArea<?php echo $Row['WorksheetArea_Idn']; ?>" class="btn btn-link btn-xs add-worksheet-to-area" value="<?php echo $Row['WorksheetArea_Idn']; ?>" data-worksheet_master_idn="9">Add Worksheet</button>
            <button id="AddMiscellaneousItemToArea<?php echo $Row['WorksheetArea_Idn']; ?>" class="btn btn-link btn-xs add-miscellaneous" data-source="138" value="<?php echo $Row['WorksheetArea_Idn']; ?>">Add Misc Item</button>
        </span>
    </td>
</tr>