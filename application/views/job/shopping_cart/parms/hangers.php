<?php 
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];
$sizes = array('1" - 2"', '2 1/2" - 3"', '4"', '6"', '8"');
$start_values = array("1", "2.5", "4", "6", "8");
$end_values = array("2", "3", "4", "6", "8");
?>

<label class="bold">Sizes</label>
<div class="checkbox">
    <?php for ($i = 0; $i < sizeof($sizes); $i++): ?>
        <label for="Size<?php echo $id."-".$i; ?>" class="checkbox-inline">
            <input type="checkbox" id="Size<?php echo $id."-".$i; ?>" name="Size[<?php echo $id."-".$i; ?>]" class="filter-results cart-size<?php echo $id; ?>" data-worksheetcategory_idn="<?php echo $id; ?>" data-start_value="<?php echo $start_values[$i]; ?>" data-end_value="<?php echo $end_values[$i]; ?>" value="<?php echo $i; ?>" />
            <?php echo $sizes[$i]; ?>
        </label>
    <?php endfor; ?>
</div>
<?php
$hanger_types = $this->m_reference_table->get_where("HangerTypes", "HangerType_Idn <> 7 AND ActiveFlag = 1", "Rank ASC");
?>
<label for="HangerType<?php echo $id; ?>" class="bold">Type</label>
<select name="HangerType<?php echo $id; ?>" id="HangerType<?php echo $id; ?>" class="form-control input-xs filter-results" onchange="cart.hanger_usability(<?php echo $id; ?>);">
    <option value="0">ALL TYPES</option>
    <?php foreach ($hanger_types as $hanger_type): ?>
	    <option value="<?php echo $hanger_type['HangerType_Idn']; ?>"><?php echo quotes_to_entities($hanger_type['Name']); ?></option>
    <?php endforeach; ?>
</select>

<div id="AdditionalRodSizes<?php echo $id; ?>">
    <label class="bold">Additional Rod</label>
    <div class="checkbox">
        <?php $rod_sizes = $this->m_reference_table->get_where("ProductSizes", "Value >= '0.375' AND Value <= '0.875'", "Value ASC"); ?>
        <?php foreach ($rod_sizes as $size): ?>
            <label for="RodSize<?php echo $id."-".$size['ProductSize_Idn']; ?>" class="checkbox-inline">
                <input type="checkbox" id="RodSize<?php echo $id."-".$size['ProductSize_Idn']; ?>" name="RodSize[<?php echo $id."-".$size['ProductSize_Idn']; ?>]" class="filter-results cart-rod-size<?php echo $id; ?>" data-worksheetcategory_idn="<?php echo $id; ?>" value="<?php echo $size['ProductSize_Idn']; ?>" />
                <?php echo quotes_to_entities($size['Name']); ?>&quot;
            </label>
        <?php endforeach; ?>
    </div>
</div>