<label for="ScheduleType<?php echo $id; ?>" class="bold">Schedule</label>
<select name="ScheduleType<?php echo $id; ?>" id="ScheduleType<?php echo $id; ?>" class="form-control input-xs filter-results">
    <option value="0">ALL SCHEDULE TYPES</option>
    <?php foreach ($schedule_types as $schedule_type): ?>
	    <option value="<?php echo $schedule_type['ScheduleType_Idn']; ?>"><?php echo quotes_to_entities($schedule_type['Name']); ?></option>
    <?php endforeach; ?>
</select>
