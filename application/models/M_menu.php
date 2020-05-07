<?php
class M_menu extends CI_Model {
	
	private $_table_name = 'Menus';

    function __construct()
    {
        parent::__construct();

        $this->load->model("m_reference_table");
    }
	
	/**
	 * Summary of get_menus_by_type
     * 
     * Get records from Menus table by MenuType_Idn. By default, method returns records where ActiveFlag = 1
     * 
	 * @param mixed $menu_type - 0 is all menu types
	 * @param mixed $job_number - get job menu items
	 * @return array
	 */
	public function get_menus_by_type($menu_type = 0, $job_number = "")
	{
		//Delcare and initialize variables
		$menus = array();
		$job_keys = array();

		if (is_int($menu_type))
		{
			//Get all menu items for all menu types sorted by Menu Types, then Menus
			if ($menu_type == 0)
			{
				$this->db
					->select("Menus.Menu_Idn, Menus.Name, Menus.ShortName, Menus.Link, Menus.MenuType_Idn, Menus.Icon, Menus.IsParent, Menus.ChildMenuType_Idn, Menus.ActiveFlag")
					->from($this->_table_name)
					->join('MenuTypes','MenuTypes.MenuType_Idn = Menus.MenuType_Idn')
                    ->where('Menus.ActiveFlag',1)
                    ->where('MenuTypes.ActiveFlag',1)
					->order_by('MenuTypes.Rank ASC, Menus.Rank ASC');
			}
			else
			{
				$this->db
					->select("*")
					->from($this->_table_name)
					->where('MenuType_Idn',$menu_type)
                    ->where('ActiveFlag',1)
					->order_by('Rank','ASC');
			}
			
			$query = $this->db->get();

			//If any records were returned, load into rows array
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$menus[$row['MenuType_Idn']][] = $row;
				}
			}
			
            if (!empty($job_number))
            {
                $job_keys = get_job_keys($job_number);

                //If all menu types, then add worksheet menu items
                $this->db
                    ->select("wm.Name, w.Worksheet_Idn, wm.WorksheetMaster_Idn")
                    ->from("RecapRows AS r")
                    ->join("RecapRowWorksheetMasters AS rwm", "r.RecapRow_Idn = rwm.RecapRow_Idn")
                    ->join("WorksheetMasters AS wm", "rwm.WorksheetMaster_Idn = wm.WorksheetMaster_Idn")
                    ->join("Worksheets AS w", "wm.WorksheetMaster_Idn = w.WorksheetMaster_Idn and w.Job_Idn = {$job_keys[0]} AND w.ChangeOrder = {$job_keys[1]}", "left")
                    ->where("r.Department_Idn", 2)
                    ->where("IsWorksheetFlag", 1)
                    ->order_by("r.Rank ASC");

                $query = $this->db->get();

                if ($query->num_rows() > 0)
                {
				    foreach ($query->result_array() as $row)
				    {
					    $menus[3][] = $row;
				    }
                }
            }
		}

        return $menus;	
	}

    /**
     * Summary of get_menus
     * @param mixed $job_number 
     * @return array
     */
    public function get_menus($job_number = "", $menu_type_idn = 1)
    {
        $menu_items = array();
        $job_keys = array();

        $where = array(
            "ActiveFlag" => 1,
            "MenuType_Idn" => $menu_type_idn
        );

        //Only include main menu items when there is no job number
        if (empty($job_number))
        {
            $where['MenuType_Idn'] = 1;
            $where['Menu_Idn <>'] = "9";
        }
        else
        {
            //If creating change order, strip * from job number
            $job_keys = get_job_keys($job_number);

            if ($job_keys[1] == "*")
            {
                $job_number = $job_keys[0];
            }
        }

        //Exclude worksheets if job is parent
        $is_parent = is_parent($job_number);
        if ($is_parent == 1)
        {
            $where['Menu_Idn <>'] = "8";
        }

		//If not admin, exclude admin menu items
        //if ($this->session->userdata('user_right_idn') != 2)
        if ($this->session->userdata('is_admin') == 0)
		{
			$where['AdminOnly'] = 0;
		}

        $menus = $this->m_reference_table->get_where("Menus", $where, "MenuType_Idn ASC, Rank ASC");
        $item = array();

        foreach($menus as $menu)
        {
            $item = array(
                "Name" => $menu['Name'],
                "Icon" => $menu['Icon'],
                "Link" => $menu['Link'],
                "ActiveMatch" => $menu['Link']
                );
            
            //Load Link
            //Add job number to job menu items
            if ($menu_type_idn == 2 && !empty($menu['Link']))
            {
                $item['Link'] .= "/".$job_number;
                $item['ActiveMatch'] .= "/".$job_number;
            }

            //Make Job menu active, if job number exists
            if ($menu['Menu_Idn'] == 9 && !empty($job_number))
            {
                $item['Active'] = true;
            }

            //Load Children
            $item['Children'] = array();
            if ($menu['ChildMenuType_Idn'] > 0 && $menu['ChildMenuType_Idn'] != null) 
            {
                if ($menu['Menu_Idn'] == 8) //Worksheet
                {
                    $item['Children'] = $this->_get_worksheets_for_menu($job_number);
                }
                else
                {
                    //recursion
                    $item['Children'] = $this->get_menus($job_number, $menu['ChildMenuType_Idn']);
                }

                if (sizeof($item['Children']) > 0)
                {
                    $item['Open'] = true;
                }
            }

            array_push($menu_items, $item);
        }

		//Add admin link
		//if ($this->session->userdata("user_right_idn") == 2 && $menu_type_idn == 1)
		if ($this->session->userdata("is_admin") == 1 && $menu_type_idn == 1)
		{
			$item = array(
                "Name" => "Administration",
                "Icon" => "clip-wrench",
                "Link" => "admin/index.php",
                "ActiveMatch" => "",
				"Children" => array()
				);

			array_push($menu_items, $item);
		}

        return $menu_items;
    }

    private function _get_worksheets_for_menu($job_number, $parent_worksheet_master_idn = 0)
    {
        $menu_items = array();
        $item = array();
        $worksheet_masters = array();
        $job_keys = get_job_keys($job_number);
        $mains_lines_flag = 0;
		$department_idn = get_department_idn($job_number);

        if ($parent_worksheet_master_idn == 0)
        {
            $include_underground = get_job_parm($job_number, 71);

            //If all menu types, then add worksheet menu items
            $this->db
                ->select("wm.Name, w.Worksheet_Idn, wm.WorksheetMaster_Idn, wm.AllowMultiple")
                ->from("RecapRows AS r")
                ->join("RecapRowWorksheetMasters AS rwm", "r.RecapRow_Idn = rwm.RecapRow_Idn")
                ->join("WorksheetMasters AS wm", "rwm.WorksheetMaster_Idn = wm.WorksheetMaster_Idn")
                ->join("Worksheets AS w", "wm.WorksheetMaster_Idn = w.WorksheetMaster_Idn and w.Job_Idn = {$job_keys[0]} AND w.ChangeOrder = {$job_keys[1]}", "left")
                ->where("r.Department_Idn", $department_idn)
                ->where("IsWorksheetFlag", 1)
                ->order_by("r.Rank ASC");
            

            if ($include_underground['AlphaValue'] == "N")
            {
                $this->db->where("wm.WorksheetMaster_Idn NOT IN (11,29)");
            }

            $query = $this->db->get();

            if ($query->num_rows() > 0)
            {
                foreach ($query->result_array() as $row)
                {
                    array_push($worksheet_masters, $row);
                }
            }
        }

        foreach ($worksheet_masters as $w)
        {
            $item = array(
                "Name" => $w['Name'],
                "Icon" => ""
                );

            //Set flag if cross mains and lines recap worksheet exists
            if ($w['WorksheetMaster_Idn'] == 32 && $w['Worksheet_Idn'] != null)
            {
                $mains_lines_flag = 1;
            }

            //If Cross Mains and Lines Recap doesn't exist and engineering worksheet doesn't exit, don't allow user to create engineering worksheet
            if ($w['WorksheetMaster_Idn'] == 22 && $mains_lines_flag == 0 && $w['Worksheet_Idn'] == null)
            {
                $item['Link'] = "";
            }
            else
            {
                //Load Link
                if ($w['Worksheet_Idn'] == null)
                {
                    $item['Link'] = "job/worksheet/0/?j=".$job_number."&wm=".$w['WorksheetMaster_Idn'];
                }
                else
                {
                    $item['Link'] = "job/worksheet/".$w['Worksheet_Idn'];
                }
            }

            //Load Children
            $item['Children'] = array();

            $item['ActiveMatch'] = $w['WorksheetMaster_Idn'];

            array_push($menu_items, $item);
        }

        return $menu_items;
    }
}