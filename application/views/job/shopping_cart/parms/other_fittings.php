<?php 
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];

//Pipe Type
$pipe_types = $this->m_reference_table->get_where("PipeTypes", "Department_Idn IN (2,3) AND ActiveFlag = 1", "Rank ASC");
$this->load->view("job/shopping_cart/parms/parm_components/pipe_type.php", array("id" => $id, "pipe_types" => $pipe_types, "label" => "Fitting Finish")); 

//Sizes
$sizes = $this->m_reference_table->get_where("ProductSizes", "Value >= '0.5' AND Value <= '12.0' AND Department_Idn IN (2,3)", "Value ASC"); 
$this->load->view("job/shopping_cart/parms/parm_components/sizes.php", array("id" => $id, "sizes" => $sizes)); 

//Fittings
$fittings = $this->m_reference_table->get_where("Fittings", "WorksheetCategory_Idn = {$id} AND Department_Idn = 2 AND ActiveFlag = 1", "Rank ASC");
$this->load->view("job/shopping_cart/parms/parm_components/fittings.php", array("id" => $id, "fittings" => $fittings, "select_set_button" => 0)); 

//Domestic
$this->load->view("job/shopping_cart/parms/parm_components/domestic.php", array("id" => $id));
?>