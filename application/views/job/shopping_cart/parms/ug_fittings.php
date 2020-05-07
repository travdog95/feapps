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

<label class="bold">Fittings</label>
<div class="checkbox">
    <?php $fittings = $this->m_reference_table->get_where("Fittings", "WorksheetMaster_Idn = 11 AND ActiveFlag = 1", "Rank ASC"); ?>
    <?php foreach ($fittings as $fitting): ?>
        <label for="Fitting<?php echo $id."-".$fitting['Fitting_Idn']; ?>" class="checkbox-inline">
            <input type="checkbox" id="Fitting<?php echo $id."-".$fitting['Fitting_Idn']; ?>" name="Fitting[<?php echo $id."-".$fitting['Fitting_Idn']; ?>]" class="filter-results" data-worksheetcategory_idn="<?php echo $id; ?>" value="<?php echo $fitting['Fitting_Idn']; ?>" />
            <?php echo quotes_to_entities($fitting['Name']); ?>
        </label>
    <?php endforeach; ?>
</div>
