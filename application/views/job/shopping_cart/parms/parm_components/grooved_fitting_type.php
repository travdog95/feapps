<label for="GroovedFittingType<?php echo $id; ?>" class="bold"><?php echo quotes_to_entities($label); ?></label>
<select name="GroovedFittingType<?php echo $id; ?>" id="GroovedFittingType<?php echo $id; ?>" class="form-control input-xs filter-results">
    <?php foreach ($fitting_types as $fitting_type): ?>
	    <option value="<?php echo $fitting_type['GroovedFittingType_Idn']; ?>"><?php echo quotes_to_entities($fitting_type['Name']); ?></option>
    <?php endforeach; ?>
</select>