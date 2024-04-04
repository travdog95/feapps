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
    public $subtotals = array();
    public $totals = array();
    public $bonded_markup = 0;
    public $debug = false;
    public $price_update_datetime = "";
    public $price_update_idn = 0;
    public $prices_outdated = false;
    public $total_sqft;
    public $total_heads;

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
                    'updated_date' => format_date($job['UpdateDateTime']),
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
                    //"total_sqft" => $job['TotalSqft'],
			    );

                //Total sqft
                $this->total_sqft = $job['TotalSqft'];
                $this->total_heads = $this->get_total_heads($this->job_number);

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
            $this->CI->load->library(
                'recap_row', 
                array(
                    'recap_row_idn' => $recap_row['RecapRow_Idn'], 
                    'j' => $this), 
                $rr_instance
            );

            $this->RRs[$recap_row['RecapRow_Idn']] = $this->CI->$rr_instance;
        }

        //Calculate Field and Shop hours
        $this->shop_hours = $this->_calc_shop_hours($this->RRs);
        $this->field_hours = $this->_calc_field_hours($this->RRs);
        $this->engineer_hours = $this->_calc_eng_hours($this->RRs);

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
            $this->CI->load->library(
                'recap_row', 
                array(
                    'recap_row_idn' => $recap_row['RecapRow_Idn'], 
                    'j' => $this, 
                    'labor_hours' => $labor_hours), 
                $rr_instance
            );

            $this->RRs[$recap_row['RecapRow_Idn']] = $this->CI->$rr_instance;
        }

        $this->_calc_subtotals();
        $this->_calc_totals();

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
    private function _calc_field_hours($labor_recap_rows)
    {
        $field_hours = 0;

        //Iterate through Recap Rows to total field hours
        foreach($labor_recap_rows as $recap_row)
        {
            if ($this->debug)
            {
                echo "<p>".$recap_row->recap_row_idn.": ".ceil($recap_row->field_hours)."</p>";
            }

            //Total shop hours
            $field_hours += ceil($recap_row->field_hours);
        }

        return $field_hours;
    }

    /**
     * calc_shop_hours
     *
     * Calculates shop hours by job
     *
     * @access  private
     * @return  void
     */
    private function _calc_shop_hours($labor_recap_rows)
    {
        $shop_hours = 0;
        //foreach ($recap_rows as $recap_row)
        foreach($labor_recap_rows as $recap_row)
        {
            //Exclude
            if ($recap_row->recap_row['CalcShopFlag'] == 1)
            {
                //Total shop hours
                $shop_hours += ceil($recap_row->shop_hours);
            }
        }

        return $shop_hours;
    }

    /**
     * _calc_eng_hours
     *
     * Calculates shop hours by job
     *
     * @access  private
     * @return  void
     */
    private function _calc_eng_hours($labor_recap_rows)
    {
        $recap_row_idn = ($this->job['department_idn'] == 1) ? 31 : 7;

        //Total engineer hours
       return $labor_recap_rows[$recap_row_idn]->engineer_hours;
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
    
    public function get_total_heads($job_number = 0)
	{
		$total_heads = 0;
		$job_keys = array();
		$where = array();
		$query;

		if (!empty($job_number))
		{
			$job_keys = get_job_keys($job_number);
			$where = array(
				"Job_Idn" => $job_keys[0],
				"ChangeOrder" => $job_keys[1],
				"WorksheetMaster_Idn" => 9
			);

			//sum Qty of Branchline worksheets
			$query = $this->CI->db
				->select("sum(Quantity) AS TotalHeads")
				->from("Worksheets")
				->where($where)
				->get()
				->row();

			$total_heads = ($query->TotalHeads == null) ? 0 : $query->TotalHeads;;
		}

		return $total_heads;
	}

    private function _calc_subtotals()
    {
        //Initialize variables
        $subtotals = array();
        $subtotal_categories = array();
        $columns = array();

        //Get Recap Subtotal Categories
        $subtotal_categories = $this->CI->m_reference_table->get_all("RecapSubtotalCategories", array(), false, "Rank");
        $columns = $this->CI->m_reference_table->get_all("WorksheetColumns", array(), true, "Rank");

        //Build subtotal_categories array
        foreach($subtotal_categories as $subtotal)
        {
            $subtotals[$subtotal['RecapSubtotalCategory_Idn']] = $subtotal;

            foreach($columns as $column)
            {
                $subtotals[$subtotal['RecapSubtotalCategory_Idn']]['Columns'][$column['WorksheetColumn_Idn']] = $column;
                $subtotals[$subtotal['RecapSubtotalCategory_Idn']]['Columns'][$column['WorksheetColumn_Idn']]['Value'] = 0;
                $subtotals[$subtotal['RecapSubtotalCategory_Idn']]['Columns'][$column['WorksheetColumn_Idn']]['Percentage'] = 0;
            }
        }

        $this->subtotals = $subtotals;

        $this->_calc_item_totals();

        $this->_calc_pac();
    
        $this->_calc_supervisory_fee();
    
        $this->_calc_contingencies();
    
        $this->_calc_total_direct_costs();

        $this->_calc_mark_up_costs();

        return true;
    }

    private function _calc_item_totals()
    {
        //RecapSubtotalCategory_Idn = 1
        $subtotal_category_idn = 1;
        foreach($this->RRs as $recap_row)
        {
            foreach($recap_row->recap_cells as $column_idn => $value)
            {
                $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Value'] += $value;
            }
        }
    }

    private function _calc_pac()
    {
        //RecapSubtotalCategory_Idn = 2
        $this->subtotals[2]['Percentage'] = 0;

        //Payroll added cost = Labor Item Total * Payroll added costs percentage
        $this->subtotals[2]['Columns'][5]['Value'] = round($this->subtotals[1]['Columns'][5]['Value'] * $this->job['payroll_added_costs'], 0);
        $this->subtotals[2]['Columns'][5]['Percentage'] = $this->job['payroll_added_costs'];
        
        //RecapSubtotalCategory_Idn = 3
        //Total after Payroll added cost
        $this->subtotals[3]['Columns'][5]['Value'] = $this->subtotals[1]['Columns'][5]['Value'] + $this->subtotals[2]['Columns'][5]['Value'];
    }

    private function _calc_supervisory_fee()
    {  
        //RecapSubtotalCategory_Idn = 8
        $this->subtotals[8]['Percentage'] = 0;

        //Get percentage
        $percentage = ($this->job['department_idn'] == 1) ? $this->job_parms[83]['NumericValue'] : $this->job_parms[17]['NumericValue'];
        $this->subtotals[8]['Columns'][5]['Percentage'] = $percentage;

        //Calc Supervisory Fee amount
        $this->subtotals[8]['Columns'][5]['Value'] = round($this->subtotals[3]['Columns'][5]['Value'] * $percentage, 0);
    }

    private function _calc_contingencies()
    {
        //RecapSubtotalCategory_Idn = 4
        $subtotal_category_idn = 4;
        $contingency_percents = array(
            '2' => $this->job_parms[23]['NumericValue'],
            '3' => $this->job_parms[24]['NumericValue'],
            '4' => $this->job_parms[25]['NumericValue'],
            '5' => $this->job_parms[26]['NumericValue']
        );

        $contingencies = array(
            '2' => $this->job_parms[33]['NumericValue'],
            '3' => $this->job_parms[34]['NumericValue'],
            '4' => $this->job_parms[35]['NumericValue'],
            '5' => $this->job_parms[36]['NumericValue']
        );

        //set percentage to 0
        $this->subtotals[$subtotal_category_idn]['Percentage'] = 0;

        foreach ($contingencies as $column_idn => $contingency)
        {
            if ($contingencies[$column_idn] > 0) //Override percentage
            {
                $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Percentage'] = 0;
                $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Value'] = round($contingencies[$column_idn], 0);
            }
            else
            {
                $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Percentage'] = $contingency_percents[$column_idn];
                $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Value'] = round($contingency_percents[$column_idn] * $this->subtotals[1]['Columns'][$column_idn]['Value'], 0);
            }
        }
    }

    private function _calc_total_direct_costs()
    {
        $subtotal_category_idn = 5;
        $direct_costs = array(1,2,3,4,5);

        foreach($direct_costs as $index => $column_idn)
        {
            //Set to Item Total
            $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Value'] = $this->subtotals[1]['Columns'][$column_idn]['Value'];

            if ($column_idn > 1)
            {
                //If Low Sub, High Sub, Material or Labor add contingencies
                $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Value'] += $this->subtotals[4]['Columns'][$column_idn]['Value'];

                //If Labor, add PAC and Supervisory fee
                if ($column_idn == 5) 
                {
                    $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Value'] = $this->subtotals[3]['Columns'][$column_idn]['Value'] + $this->subtotals[8]['Columns'][$column_idn]['Value'];
                }
            }
        }
    }

    private function _calc_mark_up_costs()
    {
        //RecapSubtotalCategory_Idn = 6
        $subtotal_category_idn = 6;
        $mark_ups = array(
            '1' => 0,
            '2' => $this->job_parms[61]['NumericValue'],
            '3' => $this->job_parms[57]['NumericValue'],
            '4' => $this->job_parms[62]['NumericValue'],
            '5' => $this->job_parms[58]['NumericValue']
        );

        //set percentage to 0
        $this->subtotals[$subtotal_category_idn]['Percentage'] = 0;

        foreach ($mark_ups as $column_idn => $mark_up)
        {
            $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Percentage'] = $mark_ups[$column_idn];

            if ($column_idn == 1)
            {
                //Bonded, add to Total of all Items value
                $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Value'] = $this->bonded_markup;
            }
            else
            {
                //Mark up percentage * Total Direct Cost
                $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Value'] = round($mark_ups[$column_idn] * $this->subtotals[5]['Columns'][$column_idn]['Value'], 0);
            }

            //Total after Capacity Costs = Total Direct + Mark Up Cost
            $this->subtotals[7]['Columns'][$column_idn]['Value'] = $this->subtotals[5]['Columns'][$column_idn]['Value'] + $this->subtotals[$subtotal_category_idn]['Columns'][$column_idn]['Value'];
        }
    }

    private function _calc_totals()
    {
        //Initialize variables
        $totals = array();
        $total_categories = array();

        //Get Recap Subtotal Categories
        $total_categories = $this->CI->m_reference_table->get_all("RecapTotalCategories", array(), true, "Rank");

        //Build subtotal_categories array
        foreach($total_categories as $total)
        {
            //Load table columns into an array
            $totals[$total['RecapTotalCategory_Idn']] = $total;

            //Add Value and Percentage to array
            $totals[$total['RecapTotalCategory_Idn']]['Value'] = 0;
            $totals[$total['RecapTotalCategory_Idn']]['Percentage'] = 0;
        }

        $this->totals = $totals;

        //Total of subtotals
        foreach ($this->subtotals[7]['Columns'] as $subtotal)
        {
            $this->totals[1]['Value'] += $subtotal['Value'];
        }

        //Commission
        $this->totals[2]['Value'] = round($this->totals[1]['Value'] * $this->job_parms[59]['NumericValue'], 0);
        $this->totals[2]['Percentage'] = $this->job_parms[59]['NumericValue'];

        //Subtotal - total after commission
        $this->totals[4]['Value'] = $this->totals[1]['Value'] + $this->totals[2]['Value'];

        //Profit Markup
        $profit_mark_up_percent = $this->job_parms[14]['NumericValue'];
        $profit_mark_up = $this->job_parms[46]['NumericValue'];

        if ($profit_mark_up == 0)
        {
            $this->totals[5]['Value'] = round($this->totals[4]['Value'] * $profit_mark_up_percent, 0);
            $this->totals[5]['Percentage'] = $profit_mark_up_percent;
        }
        else
        {
            $this->totals[5]['Value'] = $profit_mark_up;
        }

        //Total after profit mark up
        $this->totals[6]['Value'] = $this->totals[5]['Value'] + $this->totals[4]['Value'];
    
        //Sales or Use Taxes = Total Material Direct Cost * percentage
        $this->totals[7]['Value'] = round($this->subtotals[5]['Columns'][4]['Value'] * $this->job_parms[15]['NumericValue'], 0);
        $this->totals[7]['Percentage'] = $this->job_parms[15]['NumericValue'];
    
        //Total after taxes
        $this->totals[8]['Value'] = $this->totals[6]['Value'] + $this->totals[7]['Value'];

        //Depository Fee
        $depository_fee_percent = $this->job_parms[18]['NumericValue'];
        $depository_fee = $this->job_parms[48]['NumericValue'];

        //determine if it's overridden
        if ($this->job_parms[18]['AlphaValue'] == "N")
        {
            $this->totals[9]['Value'] = round($this->totals[8]['Value'] * $depository_fee_percent, 0);
            $this->totals[9]['Percentage'] = $depository_fee_percent;
        }
        else
        {
            $this->totals[9]['Value'] = $depository_fee;
        }

        //Total after Depository Fee
        $this->totals[10]['Value'] = $this->totals[8]['Value'] + $this->totals[9]['Value'];

        //Cost of bond
        $bond_percent = $this->job_parms[44]['NumericValue'];
        $bond = $this->job_parms[49]['NumericValue'];

        if ($bond == 0)
        {
            $this->totals[11]['Value'] = round($this->totals[10]['Value'] * $bond_percent, 0);
            $this->totals[11]['Percentage'] = $bond_percent;
        }
        else
        {
            $this->totals[11]['Value'] = $bond;
        }

        //Total after bond
        $this->totals[12]['Value'] = $this->totals[10]['Value'] + $this->totals[11]['Value'];

        //Gross Receipt
        $gross_receipt_percent = ($this->job['department_idn'] == 1) ? $this->job_parms[84]['NumericValue'] : $this->job_parms[45]['NumericValue'];
        $gross_receipt = $this->job_parms[50]['NumericValue'];

        if ($gross_receipt == 0)
        {
            $this->totals[14]['Value'] = round($this->totals[12]['Value'] * $gross_receipt_percent, 0);
            $this->totals[14]['Percentage'] = $gross_receipt_percent;
        }
        else
        {
            $this->totals[14]['Value'] = $gross_receipt;
        }

        //Total
        $this->totals[13]['Value'] = $this->totals[12]['Value'] + $this->totals[14]['Value'];
        
        return true;
    }
}
// END J Class