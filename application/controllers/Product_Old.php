<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	
	function __construct()
	{
		//Includes parent class constructor
		parent::__construct();

		//Check authentication
        check_auth();
		
		//Load reference table model
		$this->load->model('m_reference_table');
		$this->load->model('m_menu');
	}

    /**
     * Summary of index
     */
    public function index()
	{
		//Decare and initialize variables
		$data = array(
			'menus' => array(),
			'active_page' => 'Product Refresh',
			'bread_crumbs' => array(
				array(
					'name' => 'Product Refresh',
					'link' => ''
				)
			)
		);
		
		//Load additional models
		
		//Load menus
		$data['menus'] = $this->m_menu->get_menus();
		
        //Load job search view
		$this->load->view('product/index', $data);
	}

	/**
	 * Summary of refresh
	 */
	public function backup_product_table()
	{
        $results = array("status" => 0);

        //empty ProductsOld table
        if ($this->db->empty_table("ProductsOld"))
        {
            //Copy Products table to ProductsOld
            if ($this->db->query("INSERT INTO ProductsOld SELECT * FROM Products"))
            {
                if ($this->db->empty_table("Products"))
                {
                    $results['status'] = 1;
                }
            }
        }

        echo json_encode($results);
	}
	
    public function copy_products()
    {
        $results = array(
            "status" => 0,
            "inserts" => 0,
            "errors" => 0,
            "error_ids" => array()
            );
        $products = array();
        $product = array();
        $query = false;

        $products = $this->m_reference_table->get_all("p_products", array(), false);

        //Turn identity insert on
        $sql = "SET IDENTITY_INSERT Products ON";
        $query = $this->db->query($sql);

        foreach($products as $p)
        {
            //Conversions
            $active_flag = ($p['active_flag'] == "Y") ? 1 : 0;
            $apply_to_contingency_flag = ($p['is_not_contingency'] == 1) ? 0 : 1;
            $is_solution = (strpos($p['name'], "GLYC") > 0 && $p['sub_category_id'] == 101) ? 1 : 0;
            $fm_job_flag = ($p['fm_job'] == "Y") ? 1 : 0;
            $load_flag = ($p['display_flag'] == "Y") ? 1 : 0;
            $seamless_flag = ($p['seamless_flag'] == "Y") ? 1 : 0;
            $domestic_flag = ($p['domestic_flag'] == "Y") ? 1 : 0;

            //Load array for insert
            $product = array(
                "Product_Idn" => $p['id'],
                "Department_Idn" => $p['module_id'],
                "WorksheetMaster_Idn" => $p['category_id'],
                "WorksheetCategory_Idn" => $p['sub_category_id'],
                "Rank" => $p['rank'],
                "Name" => $p['name'],
                "Description" => $p['description'],
                "MaterialUnitPrice" => $p['price'],
                "FieldUnitPrice" => $p['field'],
                "ShopUnitPrice" => $p['shop'],
                "EngineerUnitPrice" => $p['design'],
                "ProductSize_Idn" => $p['size_id'],
                "ScheduleType_Idn" => $p['schedule_type_id'],
                "PipeType_Idn" => $p['pipe_type_id'],
                "DomesticFlag" => $domestic_flag,
                "GradeType_Idn" => $p['grade_type_id'],
                "PressureType_Idn" => $p['pressure_type_id'],
                "HangerType_Idn" => $p['hanger_type_id'],
                "HangerSubType_Idn" => $p['hanger_sub_type_id'],
                "Fitting_Idn" => $p['fitting_id'],
                "ThreadedFittingType_Idn" => $p['fitting_type_id'],
                "GroovedFittingType_Idn" => $p['grooved_fitting_id'],
                "ResponseType" => $p['response_type'],
                "CoverageType_Idn" => $p['coverage_type_id'],
                "HeadType_Idn" => $p['head_type_id'],
                "FinishType_Idn" => $p['finish_type_id'],
                "Outlet_Idn" => $p['outlet_id'],
                "BackFlowType_Idn" => $p['backflow_type_id'],
                "BellType_Idn" => $p['bell_type_id'],
                "FDCType_Idn" => $p['fdc_type_id'],
                "RiserType_Idn" => $p['riser_type_id'],
                "ControlValve_Idn" => $p['control_valve_id'],
                "CheckValve_Idn" => $p['check_valve_id'],
                "TappingTee_Idn" => $p['tapping_tee_id'],
                "UndergroundValve_Idn" => $p['ug_valve_id'],
                "SubcontractCategory_Idn" => $p['subcontract_category_id'],
                "LiftDuration_Idn" => $p['lift_duration_id'],
                "FirePumpType_Idn" => $p['fire_pump_type_id'],
                "TrimPackageFlag" => $p['trim_package_flag'],
                "ListedFlag" => $p['listed_flag'],
                "IsDieselFuel" => $p['is_diesel_fuel'],
                "ApplyToContingencyFlag" => $apply_to_contingency_flag,
                "IsFirePump" => $p['is_fire_pump'],
                "IsSolution" => $is_solution,
                "Position_Idn" => $p['position_id'],
                "FirePumpAttribute_Idn" => $p['fire_pump_attribute_id'],
                "SeamlessFlag" => $seamless_flag,
                "FMJobFlag" => $fm_job_flag,
                "ApplyToAdjustmentFactorsFlag" => $p['adjustment_factors_apply'],
                "LoadFlag" => $load_flag,
                "AutoLoadFlag" => $p['auto_load_flag'],
                "ActiveFlag" => $active_flag
                );

            //Insert product
            if ($this->m_reference_table->insert("Products", $product))
            {
                $results['inserts']++;
            }
            else
            {
                $results['errors']++;
                $results['error_ids'][] = $p['id'];
            }
        }

        //Turn identity insert on
        $sql = "SET IDENTITY_INSERT Products OFF";
        $query = $this->db->query($sql);

        $this->_update_is_main_component();

        echo json_encode($results);
    }

    private function _update_is_main_component()
    {
        $this->db->query("UPDATE Products SET IsMainComponent = 1 WHERE Product_Idn IN (SELECT Product_Idn FROM ProductsOld WHERE IsMainComponent = 1)");
    }

    public function import_product_updates()
    {
        $results = array(
            "updates" => 0,
            "errors" => 0
        );
        $set = array();
        $where = array();
        $products = $this->m_reference_table->get_all("Products$", array(), false);
        $fittings = array("Ell","Tee","R/C","Coupling","Union","Caps","Plugs");
        $fitting_idns = array(1,2,4,5,6,7,8);

        foreach ($products as $p)
        {
            $where = array(
                "Product_Idn" => $p['Product_Idn']
            );

            $set = array(
                "Name" => $p['Name'],
                "Rank" => $p['Rank'],
                "Manufacturer_Idn" => 5
            );

            //Fitting
            if (in_array($p['Fitting'], $fittings))
            {
                $index = array_search($p['Fitting'], $fittings);
                $set['Fitting_Idn'] = $fitting_idns[$index];
            }

            if ($this->m_reference_table->update("Products", $set, $where))
            {
                $results['updates']++;
            }
            else
            {
                $results['errors']++;
            }
        }

        echo json_encode($results);
    }
}
/* End of file job.php */
/* Location: ./application/controllers/job.php */