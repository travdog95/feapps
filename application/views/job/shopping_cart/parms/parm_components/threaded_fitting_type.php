<label for="ThreadedFittingType<?php echo $id; ?>" class="bold"><?php echo quotes_to_entities($label); ?></label>
<select name="ThreadedFittingType<?php echo $id; ?>" id="ThreadedFittingType<?php echo $id; ?>" class="form-control input-xs filter-results">
    <option value="0">ALL FITTING TYPES</option>
    <?php foreach ($fitting_types as $fitting_type): ?>
	    <option value="<?php echo $fitting_type['ThreadedFittingType_Idn']; ?>"><?php echo quotes_to_entities($fitting_type['Name']); ?></option>
    <?php endforeach; ?>
</select>
