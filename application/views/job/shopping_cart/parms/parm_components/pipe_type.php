<label for="PipeType<?php echo $id; ?>" class="bold"><?php echo quotes_to_entities($label); ?></label>
<select name="PipeType<?php echo $id; ?>" id="PipeType<?php echo $id; ?>" class="form-control input-xs filter-results">
    <option value="0">ALL PIPE TYPES</option>
    <?php foreach ($pipe_types as $pipe_type): ?>
	    <option value="<?php echo $pipe_type['PipeType_Idn']; ?>"><?php echo quotes_to_entities($pipe_type['Name']); ?></option>
    <?php endforeach; ?>
</select>
