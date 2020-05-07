<?php 
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];

//Coverage Types
$coverage_types = $this->m_reference_table->get_fields("CoverageTypes", "CoverageType_Idn AS Value, ShortName AS Name", "ActiveFlag = 1", "Rank ASC");
array_unshift($coverage_types, array("Value" => "0", "Name" => "-ALL-"));
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $coverage_types, "element_id" => "CoverageType", "label" => "Coverage Types", "filter" => 1)); 
?>
<div>
    <input type="radio" name="ResponseType<?php echo $id; ?>" id="ResponseType<?php echo $id."-QR"; ?>" class="filter-results" value="Q" title="QR" checked="checked" />
    <label for="ResponseType<?php echo $id."-QR"; ?>">QR</label>
    <input type="radio" name="ResponseType<?php echo $id; ?>" id="ResponseType<?php echo $id."-SR"; ?>" class="filter-results" value="S" title="SR" />
    <label for="ResponseType<?php echo $id."-SR"; ?>">SR</label>
</div>
<?php
//Head Types
$head_types = $this->m_reference_table->get_fields("HeadTypes", "HeadType_Idn AS Value, Name", "ActiveFlag = 1", "Rank ASC");
array_unshift($head_types, array("Value" => "0", "Name" => "-ALL-"));
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $head_types, "element_id" => "HeadType", "label" => "Head Types", "filter" => 1)); 

//Finish Types
$finish_types = $this->m_reference_table->get_fields("FinishTypes", "FinishType_Idn AS Value, Name", "ActiveFlag = 1", "Rank ASC");
array_unshift($finish_types, array("Value" => "0", "Name" => "-ALL-"));
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $finish_types, "element_id" => "FinishType", "label" => "Finish Types", "filter" => 1)); 
?>