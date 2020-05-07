<label class="bold">Fittings</label> <?php if ($select_set_button == 1): ?><button id="SelectSet<?php echo $id; ?>" class="select-set btn btn-primary btn-sm" type="button">Select Set</button><?php endif; ?>
<div class="cart-grid-container form-inline">
    <?php foreach ($fittings as $fitting): ?>
	<div class="checkbox cart-grid-item">
		<label for="Fitting<?php echo $id."-".$fitting['Fitting_Idn']; ?>" class="checkbox-inline">
			<input type="checkbox" id="Fitting<?php echo $id."-".$fitting['Fitting_Idn']; ?>" name="Fitting[<?php echo $id."-".$fitting['Fitting_Idn']; ?>]" class="filter-results cart-fitting<?php echo $id; ?>" data-worksheetcategory_idn="<?php echo $id; ?>" value="<?php echo $fitting['Fitting_Idn']; ?>" /> <?php echo quotes_to_entities($fitting['Name']); ?>
		</label>
	</div>
	<?php endforeach; ?>
</div>