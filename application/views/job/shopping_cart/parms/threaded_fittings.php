<?php 
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];

if ($worksheet_master['Department_Idn'] == 2)
{
  //Pipe Type
  $pipe_types = $this->m_reference_table->get_where("PipeTypes", "Department_Idn IN (2,3) AND ActiveFlag = 1", "Rank ASC");
  $this->load->view("job/shopping_cart/parms/parm_components/pipe_type.php", array("id" => $id, "pipe_types" => $pipe_types, "label" => "Fitting Finish")); 

  //Fitting Type
  $fitting_types = $this->m_reference_table->get_where("ThreadedFittingTypes", "ActiveFlag = 1", "Rank ASC");
  $this->load->view("job/shopping_cart/parms/parm_components/threaded_fitting_type.php", array("id" => $id, "fitting_types" => $fitting_types, "label" => "Fitting Type")); 
}

//Sizes
$sizes = ($worksheet_master['Department_Idn'] == 2) ? $this->m_reference_table->get_where("ProductSizes", "Value >= '0.5' AND Value <= '4.0' AND Department_Idn IN (2,3)", "Value ASC") : $worksheet_master['WorksheetMasterSizes']; 
$this->load->view("job/shopping_cart/parms/parm_components/sizes.php", array("id" => $id, "sizes" => $sizes)); 

//Fittings
$fittings = $this->m_reference_table->get_where("Fittings", "WorksheetCategory_Idn = {$id} AND Department_Idn = {$worksheet_master['Department_Idn']} AND ActiveFlag = 1", "Rank ASC");
$this->load->view("job/shopping_cart/parms/parm_components/fittings.php", array("id" => $id, "fittings" => $fittings, "select_set_button" => 1)); 

//Domestic
$this->load->view("job/shopping_cart/parms/parm_components/domestic.php", array("id" => $id));
?>