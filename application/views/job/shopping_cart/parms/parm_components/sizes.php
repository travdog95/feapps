<label class="bold">Sizes</label>
<div class="cart-grid-container form-inline">
	<?php
	$i = 1;
	?>
    <?php foreach ($sizes as $size): ?>

			<div class="cart-grid-item checkbox">
				<label for="Size<?php echo $id."-".$size['ProductSize_Idn']; ?>" class="checkbox-inline">
					<input type="checkbox" id="Size<?php echo $id."-".$size['ProductSize_Idn']; ?>" name="Size[<?php echo $id."-".$size['ProductSize_Idn']; ?>]" class="filter-results cart-size<?php echo $id; ?>" data-worksheetcategory_idn="<?php echo $id; ?>" value="<?php echo $size['ProductSize_Idn']; ?>" />
					<?php echo quotes_to_entities($size['Name']); ?>&quot;
				</label>
			</div>

		<?php $i++; ?>
    <?php endforeach; ?>
</div>