<?php
class M_product extends CI_Model {
	
	private $_table_name = 'Products';

    function __construct()
    {
        parent::__construct();

        $this->load->model("m_reference_table");
    }

    /*
	 * Summary of get_product
     * 
     * Get product from Products table by Product_Idn, including foreign key id/name values
     * 
	 * @param mixed $product_idn
	 * @return array
	 */
	public function get_product($product_idn)
	{
        $product = array();

        if (isset($product_idn) && $product_idn > 0)
        {
            $product = $this->m_reference_table->get_where('Products', array('Product_Idn' => $product_idn))[0];

            //Departments
            $product['Departments'] = $this->m_reference_table->get_fields('jpr_Department', "*", array());

            //WorksheetMasters
            $product['WorksheetMasters'] = $this->m_reference_table->get_idns_names("WorksheetMasters", "WorksheetMaster_Idn", array("Department_Idn" => $product['Department_Idn']), true, 'Name');

            //WorksheetCategories
            $product['WorksheetCategories'] = $this->m_reference_table->get_idns_names("v_WorksheetMasterCategories", "WorksheetCategory_Idn", array("WorksheetMaster_Idn" => $product['WorksheetMaster_Idn']), true, 'Name');

            //Manufacturers
            $product['Manufacturers'] = $this->m_reference_table->get_idns_names("Manufacturers", "Manufacturer_Idn", array(), true, 'Name');

            //Product Sizes
            $product['ProductSizes'] = $this->m_reference_table->get_idns_names("ProductSizes", "ProductSize_Idn", array(), true, 'Name');

            //Schedule Types
            $product['ScheduleTypes'] = $this->m_reference_table->get_idns_names("ScheduleTypes", "ScheduleType_Idn", array(), true, 'Name');

            //Pipe Types
            $product['PipeTypes'] = $this->m_reference_table->get_idns_names("PipeTypes", "PipeType_Idn", array(), true, 'Name');

            //Grooved Fitting Types
            $product['GroovedFittingTypes'] = $this->m_reference_table->get_idns_names("GroovedFittingTypes", "GroovedFittingType_Idn", array(), true, 'Name');

            //Threaded Fitting Types
            $product['ThreadedFittingTypes'] = $this->m_reference_table->get_idns_names("ThreadedFittingTypes", "ThreadedFittingType_Idn", array(), true, 'Name');

            //Hanger Types
            $product['HangerTypes'] = $this->m_reference_table->get_idns_names("HangerTypes", "HangerType_Idn", array(), true, 'Name');

            //Hanger Sub Types
            $product['HangerSubTypes'] = $this->m_reference_table->get_idns_names("HangerSubTypes", "HangerSubType_Idn", array(), true, 'Name');

            //Subcontract Category
            //$product['SubcontractCategories'] = $this->m_reference_table->get_idns_names("SubcontractCategories", "SubcontractCategory_Idn", array(), true, 'Name');

            //Grade Types
            $product['GradeTypes'] = $this->m_reference_table->get_idns_names("GradeTypes", "GradeType_Idn", array(), true, 'Name');

            //Pressure Types
            $product['PressureTypes'] = $this->m_reference_table->get_idns_names("PressureTypes", "PressureType_Idn", array(), true, 'Name');

            //Coverage Types
            $product['CoverageTypes'] = $this->m_reference_table->get_idns_names("CoverageTypes", "CoverageType_Idn", array(), true, 'Name');

            //Head Types
            $product['HeadTypes'] = $this->m_reference_table->get_idns_names("HeadTypes", "HeadType_Idn", array(), true, 'Name');

            //Finish Types
            $product['FinishTypes'] = $this->m_reference_table->get_idns_names("FinishTypes", "FinishType_Idn", array(), true, 'Name');

            //Outlets
            $product['Outlets'] = $this->m_reference_table->get_idns_names("Outlets", "Outlet_Idn", array(), true, 'Name');

            //Riser Types
            $product['RiserTypes'] = $this->m_reference_table->get_idns_names("RiserTypes", "RiserType_Idn", array(), true, 'Name');

            //Backflow Types
            $product['BackflowTypes'] = $this->m_reference_table->get_idns_names("BackflowTypes", "BackflowType_Idn", array(), true, 'Name');

            //Control Valves
            $product['ControlValves'] = $this->m_reference_table->get_idns_names("ControlValves", "ControlValve_Idn", array(), true, 'Name');

            //Check Valve
            $product['CheckValves'] = $this->m_reference_table->get_idns_names("CheckValves", "CheckValve_Idn", array(), true, 'Name');

            //FDC Types
            $product['FDCTypes'] = $this->m_reference_table->get_idns_names("FDCTypes", "FdcType_Idn", array(), true, 'Name');

            //Bell Types
            $product['BellTypes'] = $this->m_reference_table->get_idns_names("BellTypes", "BellType_Idn", array(), true, 'Name');

            //Tapping Tees
            $product['TappingTees'] = $this->m_reference_table->get_idns_names("TappingTees", "TappingTee_Idn", array(), true, 'Name');

            //Underground Valves
            $product['UndergroundValves'] = $this->m_reference_table->get_idns_names("UndergroundValves", "UndergroundValve_Idn", array(), true, 'Name');

            //Lift Durations
            $product['LiftDurations'] = $this->m_reference_table->get_idns_names("LiftDurations", "LiftDuration_Idn", array(), true, 'Name');

            //Fire Pump Types
            $product['FirePumpTypes'] = $this->m_reference_table->get_idns_names("FirePumpTypes", "FirePumpType_Idn", array(), true, 'Name');

            //Fire Pump Attributes
            $product['FirePumpAttributes'] = $this->m_reference_table->get_idns_names("FirePumpAttributes", "FirePumpAttribute_Idn", array(), true, 'Name');

            //Positions
            $product['Positions'] = $this->m_reference_table->get_idns_names("Positions", "Position_Idn", array(), true, 'Name');

            //Fittings
            $fittings_where = array(
                "Department_Idn" => $product['Department_Idn'],
                "WorksheetMaster_Idn" => $product['WorksheetMaster_Idn'],
                "WorksheetCategory_Idn" => $product['WorksheetCategory_Idn'],
            );
            $product['Fittings'] = $this->m_reference_table->get_idns_names("Fittings", "Fitting_Idn", $fittings_where, true, 'Name');

        }

        return $product;

    }
}