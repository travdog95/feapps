<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fix extends CI_Controller {

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
	public function index($results = array())
	{
		//Decare and initialize variables
		$data = array(
			'menus' => array(),
			'active_page' => 'Fix Stuff',
			'bread_crumbs' => array(
				array(
					'name' => 'Fix Stuff',
					'link' => ''
				)
			),
			"results" => $results
		);

		//Load menus
		$data['menus'] = $this->m_menu->get_menus();

        //Load job search view
		$this->load->view('fix/index', $data);
	}

	/**
	 * Summary of fix_pipe_exposure
	 */
	public function fix_pipe_exposure()
	{
        $results = array(
            "inserts" => 0,
            "errors" => 0
            );
        $insert_data = array();

        $this->db->select("Worksheet_Idn")
            ->from("Worksheets")
            ->where("WorksheetMaster_Idn = 9");

        $query = $this->db->get();

        foreach($query->result_array() as $w)
        {
            $this->db->select("Worksheet_Idn")
                ->from("WorksheetParms")
                ->where("ParmReference = 'PipeExposure' AND Worksheet_Idn = {$w['Worksheet_Idn']}");
            $query = $this->db->get();

            if ($query->num_rows() == 0)
            {
                //Insert PipeExposure
                $insert_data = array(
                    "Worksheet_Idn" => $w['Worksheet_Idn'],
                    "ParmReference" => 'PipeExposure',
                    "Parm_Idn" => 2
                    );

                if ($this->m_reference_table->insert("WorksheetParms", $insert_data))
                {
                    $results['inserts']++;
                }
                else
                {
                    $results['errors']++;
                }
            }
        }

		$this->index($results);
	}

	function fix_parent_worksheet_idns()
	{
		$results = array(
				"updates" => 0,
				"errors" => 0
				);
		$query = false;
		$set = array();
		$where = array();
		$sql = "";

		$sql = "select w.Job_Idn, w.ChangeOrder, w2.Worksheet_Idn AS ParentWorksheet_Idn, w.Worksheet_Idn AS ChildWorksheet_Idn, w.ParentWorksheet_Idn AS CurrentParentWorksheet_Idn
				from worksheets as w
				left join Jobs as j on (w.Job_Idn = j.Job_Idn AND w.ChangeOrder = j.ChangeOrder)
				left join WorksheetMasterCategories as wmc on (wmc.ChildWorksheetMaster_Idn = w.WorksheetMaster_Idn)
				left join Worksheets as w2 on (wmc.WorksheetMaster_Idn = w2.WorksheetMaster_Idn and w.Job_Idn = w2.Job_Idn and w.ChangeOrder = w2.ChangeOrder)
				where w2.Worksheet_Idn <> w.ParentWorksheet_Idn
					and j.ActiveFlag = 1
					and w.Worksheet_Idn IN (select Worksheet_Idn
				from worksheets AS w
				left join WorksheetMasters WM on wm.WorksheetMaster_Idn = w.WorksheetMaster_Idn
				where wm.AllowMultiple = 1)";

        $query = $this->db->query($sql);

        foreach($query->result_array() as $w)
        {
			$set = array(
				"ParentWorksheet_Idn" => $w['ParentWorksheet_Idn']
			);
			$where = array(
				"Worksheet_Idn" => $w['ChildWorksheet_Idn']
				);

			if ($this->m_reference_table->update("Worksheets", $set, $where))
			{
				$results['updates']++;
			}
			else
			{
				$results['errors']++;
			}
		}

		$this->index($results);
	}

	function update_department_on_wc()
	{
		$results = array(
			"updates" => 0,
			"errors" => 0
			);
		$query = false;
		$set = array();
		$where = array();
		$sql = "";

		$sql = "select wm.Worksheetmaster_Idn, wm.Department_Idn, wc.WorksheetCategory_Idn
						from worksheetmasters AS wm
						left join WorksheetMasterCategories AS wmc on (wmc.WorksheetMaster_Idn = wm.WorksheetMaster_Idn)
						left join WorksheetCategories AS wc on (wmc.WorksheetCategory_Idn = wc.WorksheetCategory_Idn)
						order by wm.department_idn, wm.worksheetmaster_idn, wc.WorksheetCategory_Idn";

		$query = $this->db->query($sql);
		
		foreach($query->result_array() as $row)
		{
			$set = array(
				"Department_Idn" => $row['Department_Idn']
			);
			$where = array( 
				"WorksheetCategory_Idn" => $row['WorksheetCategory_Idn']
			);

			if ($this->m_reference_table->update("WorksheetCategories", $set, $where))
			{
				$results['updates']++;
			}
			else
			{
				$results['errors']++;
			}
		}

		$this->index($results);
	}

	function import_sh_products()
	{
		$query;
		$results = array(
			"inserts" => array(),
			"errors" => array()
		);
		$translateMe = array(93,96,94,84,95,89,90,91,97,92,54,29);
		$categoryTranslationTable = array(
			93 => 148,
			96 => 88,
			94 => 134,
			84 => 144,
			95 => 34,
			89 => 149,
			90 => 150,
			91 => 151,
			97 => 152,
			92 => 153,
			54 => 145,
			29 => 154
		);
		$manufacturerTranslationTable = array(
			2 => 5,
			6 => 1,
			4 => 3,
			3 => 2,
			5 => 4,
			0 => 0
		);
		$this->db->select("*")
			->from("p_products$");
			//->where_in("id", array(135));
		$query = $this->db->get();

		foreach($query->result_array() as $p)
		{
			$insert_data = array(
				"Name" => $p['name'],
				"Rank" => $p['rank'],
				"DomesticFlag" => $p['domestic_flag'],
				"WorksheetMaster_Idn" => $p['category_id'],
				"WorksheetCategory_Idn" => (in_array($p['sub_category_id'], $translateMe)) ? $categoryTranslationTable[$p['sub_category_id']] : $p['sub_category_id'],
				"Manufacturer_Idn" => $manufacturerTranslationTable[$p['manufacturer_id']],
				"MaterialUnitPrice" => $p['price'],
				"FieldUnitPrice" => $p['field'],
				"ShopUnitPrice" => $p['shop'],
				"EngineerUnitPrice" => $p['design'],
				"ProductSize_Idn" => $p['size_id'],
				"Department_Idn" => 1
			);

			if ($this->m_reference_table->insert("Products", $insert_data))
			{
				$results['inserts'][] = $insert_data;
			}
			else
			{
				$results['errors'][] = $insert_data;
			}
		}

		echo json_encode($results);
	}

	function add_missing_product_attributes()
	{
		$query;
		$results = array(
			"updates" => array(),
			"errors" => array()
		);
		$set = array();
		$where = array();

		$this->db
			->select("*")
			->from("Sheet1$");
		$query = $this->db->get();

		foreach($query->result_array() as $p)
		{
			$set = array(
				"ScheduleType_Idn" => $p['schedule_type_id'],
				"PipeType_Idn" => $p['pipe_type_id'],
				"PressureType_Idn" => $p['pressure_type_id'],
				"HangerType_Idn" => $p['hanger_type_id'],
				"Fitting_Idn" => ($p['fitting_type_id'] == 13) ? 68 : $p['fitting_type_id'],
				"SeamlessFlag" => ($p['seamless_flag'] == 'Y') ? 1 : 0
			);

			$where = array(
				"Name" => $p['name'],
				"WorksheetCategory_Idn" => $p['sub_category_id']
			);

			if ($this->m_reference_table->update("Products", $set, $where))
			{
				$results['updates'][] = array("set" => $set, "where" => $where);
			}
			else
			{
				$results['errors'][] = array("set" => $set, "where" => $where);
			}
		}

		echo json_encode($results);
	}
}
/* End of file fix.php */
/* Location: ./application/controllers/fix.php */