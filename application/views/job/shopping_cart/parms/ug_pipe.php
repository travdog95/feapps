<?php 
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];
?>
<label for="PipeType<?php echo $id; ?>" class="bold">Fitting Finish</label>
<select name="PipeType<?php echo $id; ?>" id="PipeType<?php echo $id; ?>" class="form-control input-xs filter-results">
<?php
$fitting_finishes = $this->m_reference_table->get_where("PipeTypes", array("IsUnderground" => 1), "Rank ASC");
?>			
<?php foreach ($fitting_finishes as $fitting): ?>
	<option value="<?php echo $fitting['PipeType_Idn']; ?>"><?php echo quotes_to_entities($fitting['Name']); ?></option>
<?php endforeach; ?>
</select>

<label class="bold">Sizes</label>
<div class="checkbox">
    <?php $sizes = $this->m_reference_table->get_where("ProductSizes", "Value >= '4.0' AND Value <= '12.0'", "Value ASC"); ?>
    <?php foreach ($sizes as $size): ?>
        <label for="Size<?php echo $id."-".$size['ProductSize_Idn']; ?>" class="checkbox-inline">
            <input type="checkbox" id="Size<?php echo $id."-".$size['ProductSize_Idn']; ?>" name="Size[<?php echo $id."-".$size['ProductSize_Idn']; ?>]" class="filter-results cart-size<?php echo $id; ?>" data-worksheetcategory_idn="<?php echo $id; ?>" value="<?php echo $size['ProductSize_Idn']; ?>" />
            <?php echo quotes_to_entities($size['Name']); ?> &quot;
        </label>
    <?php endforeach; ?>
</div>

