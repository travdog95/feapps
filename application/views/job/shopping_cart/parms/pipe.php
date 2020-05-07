<?php 
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];

//Pipe Type
$pipe_types = $this->m_reference_table->get_where("PipeTypes", "Department_Idn IN (2,3) AND ActiveFlag = 1", "Rank ASC");
$this->load->view("job/shopping_cart/parms/parm_components/pipe_type.php", array("id" => $id, "pipe_types" => $pipe_types, "label" => "Pipe")); 

//Schedule type
$schedule_types = $this->m_reference_table->get_where("ScheduleTypes", "Department_Idn IN (2,3) AND ActiveFlag = 1", "Rank ASC");
$this->load->view("job/shopping_cart/parms/parm_components/schedule_type.php", array("id" => $id, "schedule_types" => $schedule_types)); 

//Sizes
$sizes = ($worksheet_master['Department_Idn'] == 2) ? $this->m_reference_table->get_where("ProductSizes", "Value >= '0.5' AND Value <= '12.0' AND Department_Idn IN (2,3)", "Value ASC") : $worksheet_master['WorksheetMasterSizes']; 
$this->load->view("job/shopping_cart/parms/parm_components/sizes.php", array("id" => $id, "sizes" => $sizes));

//Domestic
$this->load->view("job/shopping_cart/parms/parm_components/domestic.php", array("id" => $id));
?>