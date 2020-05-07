<?php 
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];
?>

<label class="bold">Sizes</label>
<div class="checkbox">
    <?php $sizes = $this->m_reference_table->get_where("ProductSizes", "Value >= '0.5' AND Value <= '8.0' AND Department_Idn IN (2,3)", "Value ASC"); ?>
    <?php foreach ($sizes as $size): ?>
        <label for="Size<?php echo $id."-".$size['ProductSize_Idn']; ?>" class="checkbox-inline">
            <input type="checkbox" id="Size<?php echo $id."-".$size['ProductSize_Idn']; ?>" name="Size[<?php echo $id."-".$size['ProductSize_Idn']; ?>]" class="filter-results cart-size<?php echo $id; ?>" data-worksheetcategory_idn="<?php echo $id; ?>" value="<?php echo $size['ProductSize_Idn']; ?>" />
            <?php echo quotes_to_entities($size['Name']); ?>&quot;
        </label>
    <?php endforeach; ?>
</div>

<label class="bold">Domestic</label>
<div>
    <input type="radio" name="Domestic<?php echo $id; ?>" id="Domestic<?php echo $id."-1"; ?>" class="filter-results" value="1" title="Yes" <?php if (0 == 1) echo 'checked="checked"'; ?> />
    Yes
    <input type="radio" name="Domestic<?php echo $id; ?>" id="Domestic<?php echo $id."-2"; ?>" class="filter-results" value="2" title="Either" <?php if (0 == 1) echo 'checked="checked"'; ?> />
    Either
</div>
