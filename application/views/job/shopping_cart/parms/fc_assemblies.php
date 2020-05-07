<?php
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];

//Fitting
$valves = $this->m_reference_table->get_fields("ControlValves", "ControlValve_Idn AS Value, Name", "ActiveFlag = 1", "Rank ASC");
array_unshift($valves, array("Value" => "0", "Name" => "-ALL-"));
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $valves, "element_id" => "ControlValve", "label" => "Valve", "filter" => 1)); 
?>