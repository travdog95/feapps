<?php 
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];
?>

<label class="bold">Search Products</label>
<input type="text" name="SearchProducts<?php echo $id; ?>" id="SearchProducts<?php echo $id; ?>" value="" class="form-control input-xs" />
<button id="SearchProductsButton" data-worksheetcategoryidn="<?php echo $id; ?>">Search</button> <br />

<label for="WorksheetCategory<?php echo $id; ?>" class="bold">Category</label>
<select name="WorksheetCategory<?php echo $id; ?>" id="WorksheetCategory<?php echo $id; ?>" class="form-control input-xs">
    <?php
    $categories = $this->m_reference_table->get_where("v_WorksheetMasterCategories", "WorksheetMaster_Idn = 11 AND WorksheetCategory_Idn <> 141", "Rank ASC");
    ?>
    <option value="0" selected></option>
    <?php foreach ($categories as $category): ?>
	    <option value="<?php echo $category['WorksheetCategory_Idn']; ?>"><?php echo quotes_to_entities($category['Name']); ?></option>
    <?php endforeach; ?>
</select>