<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * J Class
 *
 * @category	Job
 * @author		TKO Consulting, LLC
*/

class J
{
    //Declare and initialize member variables
    public $job_number = "";
    public $job = array();
    public $job_defaults = array();
    public $job_parms = array();
    public $field_hours = 0;
    public $shop_hours = 0;
    public $engineer_hours = 0;
    public $job_keys = array();
    public $RRs = array();
    //public $totals = array();
    public $bonded_markup = 0;
    public $debug = false;
    public $price_update_datetime = "";
    public $price_update_idn = 0;
    public $prices_outdated = false;

    //Private members
    private $CI;

	/**
     * Job Class Constructor
     *
     * @param   array
     * @param   integer
     */
	public function __construct($params = array('job_number' => ""))
	{
		// Set the super object to a local variable for use later
		$this->CI =& get_instance();

        //Declare and initialize variables
        $job = array();
		$job_data = array();
		$job_parms = array();
		$job_defaults = array();

        //Load models
        $this->CI->load->model('m_job');
        $this->CI->load->model('m_job_parm_detail');
		$this->CI->load->model('m_job_prepared_by');
		$this->CI->load->model('m_department');
		$this->CI->load->model('m_job_system_type');
		$this->CI->load->model('m_job_default');
        $this->CI->load->model('m_user');
        $this->CI->load->model('m_reference_table');

        //Load libraries
        //$this->CI->load->library('recap_row');

        if (!empty($params['job_number']))
        {
            //Set class properties
	        $this->job_number = $params['job_number'];
            $this->job_parms = $this->CI->m_job_parm_detail->get_job_parms($this->job_number);
            $this->job_keys = get_job_keys($this->job_number);

            //Get job data
            $job = $this->CI->m_job->get_by_job_number($this->job_number);

		    if (!empty($job))
		    {
                //Load job defaults into job_defaults array
                $this->job_defaults = $this->CI->m_job_default->get_values_by_type(array(3,4));

                //Calculate Bonded Markup
                $this->calc_bonded_markup();
                
                //Get job price update data
                $job_price_update = $this->CI->db->query("SELECT * FROM PriceUpdates WHERE PriceUpdate_Idn = {$job['PriceUpdate_Idn']} ")->row();

                $job_price_update_datetime = (isset($job_price_update->UpdateDateTime)) ? $job_price_update->UpdateDateTime : "";

			    //Load fields
			    $this->job = array(
				    'read_only' => 0,
				    'new_change_order' => 0,
				    'department_idn' => $job['Department_Idn'],
				    'department_name' => $this->CI->m_department->get_department_name($job['Department_Idn']),
				    'is_parent' => $job['IsParent'],
                    'is_shareable' => $job['IsShareable'],
                    'parent_idn' => $job['Parent_Idn'],
				    'job_number' => $this->job_number,
                    'created_by_idn' => $job['CreatedBy_Idn'],
                    'created_by_name' => $this->CI->m_user->get_first_name_by_idn($job['CreatedBy_Idn']),
				    'created_date' => format_date($job['CreateDateTime']),
				    'prepared_bys' => $this->CI->m_job_prepared_by->get_prepared_bys($this->job_number),
                    'prepared_by_names' => $this->CI->m_job_prepared_by->get_prepared_by_names($this->job_number),
				    'name' => $job['Name'],
				    'contractor' => $job['Contractor'],
				    'status_idn' => $job['JobStatus_Idn'],
				    'is_joint_job' => (empty($this->job_parms[27]['AlphaValue']) || $this->job_parms[27]['AlphaValue'] == "Y") ? "Y" : "N",
				    'is_underground' => (empty($this->job_parms[71]['AlphaValue']) || $this->job_parms[71]['AlphaValue'] == "Y") ? "Y" : "N",
				    'underground_options' => (empty($this->job_parms[72]['AlphaValue']) || $this->job_parms[72]['AlphaValue'] == "Y") ? "Y" : "N",
				    'system_types' => $this->CI->m_job_system_type->get_job_system_types($this->job_number),
				    'system_sub_types' => $this->CI->m_job_system_type->get_job_system_types($this->job_number,1),
				    'grooved_fitting' => (isset($this->job_parms[78])) ? number_format($this->job_parms[78]['NumericValue'],0) : 0,
				    'is_domestic_required' => (empty($this->job_parms[28]['AlphaValue']) || $this->job_parms[28]['AlphaValue'] == "Y") ? "Y" : "N",
				    'domestic_options' => (empty($this->job_parms[42]['AlphaValue']) || $this->job_parms[42]['AlphaValue'] == "Y") ? "Y" : "N",
				    'is_seamless_required' => (empty($this->job_parms[29]['AlphaValue']) || $this->job_parms[29]['AlphaValue'] == "Y") ? "Y" : "N",
				    'is_fm_job' => (empty($this->job_parms[69]['AlphaValue']) || $this->job_parms[69]['AlphaValue'] == "Y") ? "Y" : "N",
				    'is_davis_bacon_job' => (empty($this->job_parms[30]['AlphaValue']) || $this->job_parms[30]['AlphaValue'] == "Y") ? "Y" : "N",
				    'davis_bacon_pac' => number_format($this->job_parms[20]['NumericValue'] * 100, 1),
				    'miles_to_job' => $this->job_parms[31]['NumericValue'],
                    'bonded_mark_up' => $this->bonded_markup,
                    'job_date' => $job['JobDate'],
                    'notes' => $job['Notes'],
                    "is_favorite" => $this->is_favorite($this->job_number, $this->CI->session->userdata('user_idn')),
					"payroll_added_costs" => ($this->job_parms[30]['AlphaValue'] == "Y") ? $this->job_parms[20]['NumericValue'] : $this->job_parms[7]['NumericValue'],
					"is_parts_smarts" => (empty($this->job_parms[80]['AlphaValue']) || $this->job_parms[80]['AlphaValue'] == "N") ? "N" : "Y",
                    "estimate_type_idn" => $job['EstimateType_Idn'],
                    "price_update_idn" => $job['PriceUpdate_Idn'],
                    "price_update_datetime" => $job_price_update_datetime,
                    "formated_price_update_datetime" => date_format(date_create($job_price_update_datetime), "M j, Y g:i:s A"),
                    "prices_outdated" => ($job_price_update_datetime < get_latest_price_update("datetime")),
			    );

			    //Load labor rates
			    if ($job['Department_Idn'] == 1)
			    {
				    $this->job['field_labor_rate'] = $this->job_parms[1]['NumericValue'];
				    $this->job['shop_labor_rate'] = $this->job_parms[2]['NumericValue'];
				    $this->job['design_labor_rate'] = $this->job_parms[21]['NumericValue'];
			    }
			    else
			    {
				    $this->job['field_labor_rate'] = $this->job_parms[65]['NumericValue'];
				    $this->job['shop_labor_rate'] = $this->job_parms[64]['NumericValue'];
				    $this->job['design_labor_rate'] = $this->job_parms[66]['NumericValue'];
			    }
		    }
        }

        log_message('debug', "Job Class Initialized");
	}

    /**
     * load_recap_rows
     *
     * Loads all Recap Row objects into $this->RRs array for the current job.
     *
     * @access  public
     * @return  void
     */
    public function load_recap_rows()
    {     
        //Delcare and initialize variables
        $recap_rows = array();

        //Load models
        $this->CI->load->model('m_recap_row');

        //Get recap rows, except shop labor, and job mob
        //The reason why is because both the Job Mob and Shop Labor recap rows need the total Job Field and Shop Labor hours to correctly calculate their totals
        //$where = "RecapRow_Idn NOT IN (8,22,32,29)";
        $calc_shop_where = array("CalcShopFlag" => 1);
        $calc_shop_recap_rows = $this->CI->m_recap_row->get_by_department_idn($this->job['department_idn'], $calc_shop_where);

        //$parent = ($this->job['is_parent'] == 1) ? "parent" : "child";

        foreach ($calc_shop_recap_rows as $recap_row)
        {
            //Instantiate Recap row
            $rr_instance = "recap_row_".$recap_row['RecapRow_Idn']."_".$this->job_number;
            $this->CI->load->library('recap_row', array('recap_row_idn' => $recap_row['RecapRow_Idn'], 'j' => $this), $rr_instance);
            $this->RRs[$recap_row['RecapRow_Idn']] = $this->CI->$rr_instance;
        }

        //Calculate Field and Shop hours
        $this->_calc_shop_hours();
        $this->_calc_field_hours();

        //put labor hours in array for recap rows that need it
        $labor_hours = array(
            "ShopHours" => $this->shop_hours,
            "FieldHours" => $this->field_hours
        );

        //Calculate recap rows that need shop labor
        $where = array("CalcShopFlag" => 0);
        $recap_rows = $this->CI->m_recap_row->get_by_department_idn($this->job['department_idn'], $where);

        foreach ($recap_rows as $recap_row)
        {
            //Instantiate Recap row
            $rr_instance = "recap_row_".$recap_row['RecapRow_Idn']."_".$this->job_number;
            $this->CI->load->library('recap_row', array('recap_row_idn' => $recap_row['RecapRow_Idn'], 'j' => $this, 'labor_hours' => $labor_hours), $rr_instance);
            $this->RRs[$recap_row['RecapRow_Idn']] = $this->CI->$rr_instance;
        }

        return $this->RRs;
    }

    /**
    * calc_field_hours
    *
    * Calculates field hours by job and sets $this->field_hours property
    *
    * @access   private
    * @return   void
    */
    private function _calc_field_hours()
    {
        //Iterate through Recap Rows to total field hours
        foreach($this->RRs as $recap_row)
        {
            if ($this->debug)
            {
                echo "<p>".ceil($recap_row->field_hours)."</p>";
            }

            //Total shop hours
            $this->field_hours += ceil($recap_row->field_hours);
        }
    }

    /**
     * calc_shop_hours
     *
     * Calculates shop hours by job
     *
     * @access  public
     * @return  void
     */
    private function _calc_shop_hours()
    {
        //foreach ($recap_rows as $recap_row)
        foreach($this->RRs as $recap_row)
        {
            //Exclude
            if ($recap_row->recap_row['CalcShopFlag'] == 1)
            {
                //Total shop hours
                $this->shop_hours += ceil($recap_row->shop_hours);
            }
        }
    }

    /**
     * calc_bonded_markup
     *
     * Calculate Bonded mark up amount from Subcontracts worksheet. Sets bonded_markup property
     *
     * @access  public
     * @return  void
     */
    public function calc_bonded_markup()
    {
        //Load model
        $this->CI->load->model('m_miscellaneous_detail');

        //Get bonded markup
        $this->bonded_markup = $this->CI->m_miscellaneous_detail->get_bonded_markup($this->job_keys[0], $this->job_keys[1]);
    }

    /**
     * get_next_change_order
     *
     * Gets the next change order number for a job.
     *
     * @access  public
     * @param   mixed(string or integer)
     * @return  integer
     */
    public function get_next_change_order($job_idn)
    {
        //Delcare and initialize variables
        $next_change_order = 0;

        if ($job_idn > 0)
        {
            $next_change_order = $this->CI->m_job->get_next_change_order($job_idn);
        }

        return $next_change_order;
    }

    /**
     * Summary of is_favorite
     * @param mixed $job_number
     * @param mixed $user_id
     * @return int
     */
    function is_favorite($job_number, $user_id)
    {
        //Delcare and initialize variables
        $query = false;
        $where = array();
        $job_keys = array();
        $is_favorite = 0;

        if (!empty($job_number) && $job_number > 0 && $user_id > 0)
        {
            $job_keys = get_job_keys($job_number);

            $where['Job_Idn'] = $job_keys[0];
            $where['ChangeOrder'] = $job_keys[1];
            $where['User_Idn'] = $user_id;

            $this->CI->db
                ->select("*")
                ->from("UserFavoriteJobs")
                ->where($where);

            $query = $this->CI->db->get();

            if ($query->num_rows() > 0)
            {
                $is_favorite = 1;
            }
        }

        return $is_favorite;
    }

	function update_parent_worksheet_idn($job_number)
	{
		$job_keys = array();
		$children_worksheet_idns = array();
		$query = false;
		$set = array();
		$where = array();

		if (!empty($job_number))
		{
			$job_keys = get_job_keys($job_number);

			//Find children worksheets
			$this->CI->db
				->select("Worksheet_Idn")
				->from("Worksheets AS w")
				->join("WorksheetMasters AS wm", "wm.WorksheetMaster_Idn = w.WorksheetMaster_Idn", "left")
				->where("Job_Idn", $job_keys[0])
				->where("ChangeOrder", $job_keys[1])
				->where("AllowMultiple", 1);

			$query = $this->CI->db->get();

			if ($query)
			{
                foreach ($query->result_array() as $child)
                {
					$children_worksheet_idns[] = $child['Worksheet_Idn'];
				}

				foreach ($children_worksheet_idns as $idn)
				{
					//Find ParentWorksheet_Idn
					$this->CI->db
						->select("w2.Worksheet_Idn AS ParentWorksheet_Idn, w.Worksheet_Idn AS ChildWorksheet_Idn")
						->from("Worksheets AS w")
						->join("WorksheetMasterCategories AS wmc", "wmc.ChildWorksheetMaster_Idn = w.WorksheetMaster_Idn", "left")
						->join("Worksheets AS w2", "wmc.WorksheetMaster_Idn = w2.WorksheetMaster_Idn AND w.Job_Idn = w2.Job_Idn AND w.ChangeOrder = w2.ChangeOrder", "left")
						->where("w.Job_Idn", $job_keys[0])
						->where("w.ChangeOrder", $job_keys[1])
						->where("w.Worksheet_Idn", $idn);

					$query = $this->CI->db->get();

					if ($query)
					{
						foreach ($query->result_array() as $row)
						{
							$set = array(
								"ParentWorksheet_Idn" => $row['ParentWorksheet_Idn']
								);

							$where = array(
								"Worksheet_Idn" => $row['ChildWorksheet_Idn']
								);

							//Update ParentWorksheet_Idn
							if ($this->CI->m_reference_table->update("Worksheets", $set, $where) == false)
							{
								log_message("error", "Error updating ParentWorksheet_Idn");
							}
						}
					}
					else
					{
						log_message("error", "Error finding ParentWorksheet_Idn");
						return false;
					}
				}
			}
			else
			{
				log_message("error", "Error finding child Worksheets");
				return false;
			}
		}
		else
		{
			log_message("error", "No Job Number passed into function");
			return false;
		}

		return true;
	}
}
// END J Class