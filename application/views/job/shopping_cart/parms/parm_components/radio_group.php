<label class="bold"><?php echo quotes_to_entities($label); ?></label>
<div>
<?php foreach ($options as $option): 
    $value = $option['Value'];
    $name = quotes_to_entities($option['Name']);
    $checked = ($value == $default) ? 'checked="checked"' : '';
    $filter_results = ($filter) ? "filter-results" : "";
    ?>
    <label for="<?php echo $element_id.$id."-".$value; ?>">
        <input type="radio" name="<?php echo $element_id.$id; ?>" id="<?php echo $element_id.$id."-".$value; ?>" class="<?php echo $filter_results; ?>" value="<?php echo $value; ?>" title="<?php echo $name; ?>" <?php echo $checked; ?> />
    <?php echo $name; ?></label>
<?php endforeach; ?>
</div>