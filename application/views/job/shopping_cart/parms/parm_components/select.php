<label for="<?php echo $element_id.$id; ?>" class="bold"><?php echo quotes_to_entities($label); ?></label>
<?php $filter = (isset($filter)) ? $filter : 1; ?>
<select name="<?php echo $element_id.$id; ?>" id="<?php echo $element_id.$id; ?>" class="form-control input-xs <?php if ($filter == 1): ?>filter-results<?php endif; ?>">
    <?php foreach ($options as $option): ?>
	    <option value="<?php echo $option['Value']; ?>"><?php echo quotes_to_entities($option['Name']); ?></option>
    <?php endforeach; ?>
</select>