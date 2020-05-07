<?php
$this->load->model("m_reference_table");
$id = $category['WorksheetCategory_Idn'];

//Fitting
$pipe_types = $this->m_reference_table->get_fields("PipeTypes", "PipeType_Idn AS Value, Name", "Department_Idn IN (3) AND ActiveFlag = 1", "Rank ASC");
array_unshift($pipe_types, array("Value" => "0", "Name" => "ALL PIPE TYPES"));
array_push($pipe_types, array("Value" => "9999", "Name" => "Galvanized - Pipe Only"));
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $pipe_types, "element_id" => "PipeType", "label" => "Fitting", "filter" => 1)); 

//Schedule
$schedule_types = $this->m_reference_table->get_fields("ScheduleTypes", "ScheduleType_Idn AS Value, Name", "Department_Idn IN (2,3) AND ActiveFlag = 1", "Rank ASC");
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $schedule_types, "element_id" => "ScheduleType", "label" => "Schedule", "filter" => 1)); 

//Size
$sizes = $this->m_reference_table->get_fields("ProductSizes", "ProductSize_Idn AS Value, Name", "Value >= '1.0' AND Value <= '4.0' AND Department_Idn IN (2,3) AND ActiveFlag = 1", "Rank ASC");
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $sizes, "element_id" => "Size", "label" => "Size", "filter" => 1)); 

//Outlet
$outlets = $this->m_reference_table->get_fields("Fittings", "Fitting_Idn AS Value, Name", "Fitting_Idn IN (41,42) AND ActiveFlag = 1", "Rank ASC");
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $outlets, "element_id" => "Outlet", "label" => "Outlet", "filter" => 1)); 

//Fitting Type
$fitting_types = $this->m_reference_table->get_fields("WorksheetCategories", "WorksheetCategory_Idn AS Value, Name", "WorksheetCategory_Idn IN (90,97) AND ActiveFlag = 1", "Name ASC");
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $fitting_types, "element_id" => "FittingType", "label" => "Fitting Type", "filter" => 0)); 

//Fitting
$fittings = array(); //Leave empty will be filled by Javascript based on selected option in FittingType select element
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $fittings, "element_id" => "Fitting", "label" => "Fitting", "filter" => 1));

//Additional Fitting
$additional_fittings = $this->m_reference_table->get_fields("Fittings", "Fitting_Idn AS Value, Name", "Fitting_Idn IN (17,29,30) AND ActiveFlag = 1", "Name ASC");
array_unshift($additional_fittings, array("Value" => "0", "Name" => "NONE"));
$this->load->view("job/shopping_cart/parms/parm_components/select.php", array("id" => $id, "options" => $additional_fittings, "element_id" => "AdditionalFitting", "label" => "Additional Fitting", "filter" => 1)); 

//Domestic
$this->load->view("job/shopping_cart/parms/parm_components/domestic.php", array("id" => $id));
?>