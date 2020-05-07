<?php
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];

//Pipe Type
$manufacturers = $this->m_reference_table->get_fields("Manufacturers", "Manufacturer_Idn AS Value, Name", "ActiveFlag = 1", "Name ASC");
array_unshift($manufacturers, array("Value" => "0", "Name" => "-ALL-"));
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $manufacturers, "element_id" => "Manufacturer", "label" => "Manufacturer", "filter" => 1));

?>