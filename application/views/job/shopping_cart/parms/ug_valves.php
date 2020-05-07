<?php 
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];
?>

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

<label for="Valve<?php echo $id; ?>" class="bold">Valve</label>
<select name="Valve<?php echo $id; ?>" id="Valve<?php echo $id; ?>" class="form-control input-xs filter-results">
<?php
$valves = $this->m_reference_table->get_where("UndergroundValves", array("ActiveFlag" => 1), "Rank ASC");
?>			
<?php foreach ($valves as $valve): ?>
	<option value="<?php echo $valve['UndergroundValve_Idn']; ?>"><?php echo quotes_to_entities($valve['Name']); ?></option>
<?php endforeach; ?>
</select>