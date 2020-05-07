<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Job Mob Class
 *
 * @category	Worksheet
 * @author		TKO Consulting, LLC
*/

class Job_mob extends Worksheet
{
    //Declare and initialize member variables
    
    //Public members
    public $jm;
    public $fts_sections = array();

    //Calculated values
    public $des_wag_hrs = 0;

    //Private members
    private $_j = null;
    
    /**
     * Job Mob Class Constructor
     *
     * The constructor loads the Job Mob class used to display and caluclate Job Mobilization worksheet information
     *
     * @param   array
     */

    public function __construct($params = array('w_id' => 0, 'j' => null))
    {
        //Instantiate Parent class
        parent::__construct($params);

        //Load models
        $this->CI->load->model('m_job_mob_worksheet');
        $this->CI->load->model('m_worksheet_parm');
        
        // If Worksheet_Idn being passed, set it
        if ($params['w_id'] > 0) {
            //Set class properties
            $this->w_id = $params['w_id'];
            $this->_j = $params['j'];
            
            $this->jm = $this->calc_job_mob_worksheet();
        }
        
        log_message('debug', "Job Mob Class Initialized");
    }
    
    /**
     * calc_job_mob_worksheet
     *
     * Gets job mob worksheet
     *
     * @access   private
     * @return   void
     */
    
    public function calc_job_mob_worksheet()
    {
        //Delcare and initialize variables
        $job_number = "";
        $jm = array();
        $fts_sections = "";
        $design_labor_rate = 0;
        $del_travel_hours = 0;
        $del_days = 0;
        $freight = 0;
        $miles_to_job = 0;
        
        $work_weeks = 0;
        $subsistence_factors = array();
        $meal_days = 0;
        $motel_days = 0;
        $field_subsistence_motel = 0;
        $field_subsistence_meal = 0;
        $sub_week = 0;
        
        //Instantiate j class if $j is NULL
        if ($this->_j === null) {
            //Format job_number
            $job_number = format_job_number($this->w['Job_Idn'], $this->w['ChangeOrder']);
            
            //$this->_j = new J(array('job_number' => $job_number));
            $this->CI->load('j', array('job_number' => $job_number));
            $this->_j = $this->CI->j;
        }
            
        //Get fts_sections
        $fts_sections = $this->CI->m_worksheet_parm->get_worksheet_parms_by_reference($this->w_id, 'FTSSections', 'ParmValue');

        if (!empty($fts_sections)) {
            $this->fts_sections = explode(",", $fts_sections['0']);
        }
        
        //Load labor rates
        $design_labor_rate = $this->_j->job['design_labor_rate'];
        
        //Get Job mob worksheet
        $jm = $this->CI->m_job_mob_worksheet->get_by_worksheet_idn($this->w_id);
        $this->jm = $jm;
        
        //Calculated fields
        $this->des_wag_hrs = round($jm['des_wag_miles'] / 60, 2);

        //Initialize properties
        $this->high_sub = 0; //3
        $this->low_sub = 0;  //2
        $this->field = 0;
        
        //******************************************
        // DESIGN TRAVEL
        //******************************************
        //Calc Designer Vehicle/Airfare Expenses
        $this->high_sub += round($jm['des_exp_veh_miles'] * $this->_j->job_parms[16]['NumericValue'] * $jm['des_exp_veh_trips'], 2) +
            round($jm['des_exp_air_rate'] * $jm['des_exp_air_trips'], 2) +
            round($jm['des_exp_car_days'] * $jm['des_exp_car_rate'] * $jm['des_exp_car_trips'], 2);

        //Calc Designer Travel Wages
        $this->jm_eng_hours = ($this->des_wag_hrs * $jm['des_wag_trips']) + ($jm['des_wag_air_hrs'] * $jm['des_wag_air_trips']);
        $this->field += $this->des_wag_hrs * $design_labor_rate * $jm['des_wag_trips'] +
            round($jm['des_wag_air_hrs'] * $design_labor_rate, 2) * $jm['des_wag_air_trips'];
        
        //Calc Designer Subsistence
        $this->high_sub += round($jm['des_sub_lod_days'] * $jm['des_sub_lod_rate'], 2) +
            round($jm['des_sub_mea_days'] * $jm['des_sub_mea_rate'], 2);
        
        //******************************************
        // FIELD TRAVEL & SUBSISTENCE
        //******************************************
        $miles_to_job = $this->_j->job_parms[31]['NumericValue'];

        //Calculate Travel Hours (Job Mob Field Hours)
        if ($miles_to_job >= 60) {
            $this->field_hours = round(round(round($jm['f_wag_miles'] / 60, 2) * $jm['f_wag_workers'], 1) * $jm['f_wag_trips'], 1) + round($jm['f_wag_air_hrs'] * $jm['f_wag_air_trips'], 2);
        } else {
            $this->field_hours = 0;
        }
        
        /******** Row 1 *******/
        //Calc Field Truck Expense
        if (in_array(1, $this->fts_sections)) {
            $f_trk_office = (round($jm['f_trk_exp_off_mil'] * $this->_j->job_parms[16]['NumericValue'], 2) * $jm['f_trk_exp_off_trips']);
            $f_trk_hotel = (round($jm['f_trk_exp_hot_mil'] * $this->_j->job_parms[16]['NumericValue'], 2) * $jm['f_trk_exp_hot_trips']);
            $this->high_sub += $f_trk_office + $f_trk_hotel;
        }
        
        /******** Row 2 *******/
        //Field Airfare/Vehicle Expense
        //if ($miles_to_job >= 450)
        if (in_array(2, $this->fts_sections)) {
            //Calc Field Airfare / Vehicle Expense
            $this->high_sub += round($jm['f_veh_exp_air_rate'] * $jm['f_veh_exp_air_trips'], 2) + round($jm['f_veh_exp_car_days'] * $jm['f_veh_exp_car_rate'] * $jm['f_veh_exp_car_trips'], 2);
        }
        
        /******** Row 3 *******/
        //Calc Field Travel Wages
        //			if ($miles_to_job >= 60)
        if (in_array(3, $this->fts_sections)) {
            $field_travel_wages = round(round($jm['f_wag_miles'] / 60 * $jm['f_wag_workers'], 2) * $jm['f_wag_rate'] * $jm['f_wag_trips'], 2) +
                round($jm['f_wag_air_hrs'] * $jm['f_wag_air_rate'] * $jm['f_wag_air_trips'], 2);
            $this->field += $field_travel_wages;
        }
        
        /******** Row 4 *******/
        //Calc Field Subsistence
        if (in_array(4, $this->fts_sections)) {
            //$work_weeks = round((round($this->_j->calc_field_hours(), 1) + round($this->field_hours, 1)) / 40, 2);
            $work_weeks = round((round($this->_j->field_hours, 1) + round($this->field_hours, 2)) / 40, 2);
            $subsistence_factors = $this->get_subsistence_factors($this->_j->job_parms[31]['NumericValue']);
            $meal_days = $subsistence_factors['meal_days'];
            $motel_days = $subsistence_factors['motel_days'];
            
            $field_subsistence_motel = round(round($this->_j->job_parms[32]['NumericValue'] / 2, 2) * $motel_days, 2);
            $field_subsistence_meal = round($this->_j->job_parms[3]['NumericValue'] * $meal_days, 2);
            $sub_week = $field_subsistence_motel + $field_subsistence_meal + $jm['f_sub_pay'];
            $this->high_sub += round($sub_week * $work_weeks, 2);
        }
        
        /******** Row 5 *******/
        //Calc Sunday Travel Subsistence
        //if ($miles_to_job >= 100 and $miles_to_job < 450)
        if (in_array(5, $this->fts_sections)) {
            $this->high_sub += round($jm['f_sun_wrk_weeks'] * (round($this->_j->job_parms[32]['NumericValue'] / 2, 2) + $jm['f_sun_meal']), 2);
        }
        
        /******* Row 6 *******/
        //Interim Travel Time
        //if ($miles_to_job >= 100)
        if (in_array(6, $this->fts_sections)) {
            $this->field += round($jm['interim_hours'] * $jm['interim_rate'] * $jm['interim_trips'], 2);
        }
        
        //******************************************
        // FREIGHT COSTS
        //******************************************
        
        //Calc Delivery Truck Expense
        $this->high_sub += round($jm['del_exp_stk_mil'] * $this->_j->job_parms[81]['NumericValue'], 2) * $jm['del_exp_stk_trips'];
        
        //Calc Delivery Driver's Travel Wag
        $del_travel_hours = round($jm['del_wag_miles'] / 60, 2);
        $this->jm_shop_hours = $del_travel_hours * $jm['del_wag_trips'];
        $this->field += $del_travel_hours * $jm['del_wag_rate'] * $jm['del_wag_trips'];
        
        //Calc Delivery Driver's Subsistence
        $del_days = round($del_travel_hours / 8, 1);
        $this->high_sub += round($del_days * $jm['del_sub_rate'], 2) * $jm['del_sub_trips'];
        
        //Calc Freight / Common Carrier
        $freight = round($jm['frt_loads'] * $jm['frt_rate'], 2);
        if ($jm['frt_quoted'] == 1) {
            $this->low_sub += $freight;
        } else {
            $this->high_sub += $freight;
        }
    }
    
    /**
     * get_subsistence_factors
     *
     * Returns array of subsistence factors
     * 0 - Meals factors
     * 1 - Motel days
     * 2 - ID
     * 3 - Pay
     * 4 - disabled
     *
     * @access  public
     * @return  array
     */
    
    public function get_subsistence_factors($miles_to_job, $ajax = 0)
    {
        //Delcare and initialize variables
        $subs_factors = array();
        $meals_days = 0;
        $motel_days = 0;
        $id = 0;
        $pay = 0;
        $disabled = 0;
        $fts_sections = "";
        
        if ($miles_to_job < 60) {
            $disabled = 1;
            $fts_sections = "1";
        } elseif ($miles_to_job >= 60 && $miles_to_job < 100) {
            $motel_days = 3;
            $meals_days = 4;
            $id = 329;
            $pay = 0;
            //$pay = number_format($this->_j->job_parms[4]['NumericValue'],2);
            $fts_sections = "1,3,4";
        } elseif ($miles_to_job >= 100 && $miles_to_job < 450) {
            $motel_days = 4;
            $meals_days = 5;
            $id = 330;
            $pay = 40;
            //$pay = number_format($this->_j->job_parms[5]['NumericValue'],2);
            $fts_sections = "1,3,4,5,6";
        } else { //Over 450
            $motel_days = 7;
            $meals_days = 7;
            $id = 331;
            $pay = 80;
            //$pay = number_format($this->_j->job_parms[6]['NumericValue'],2);
            $fts_sections = "1,2,3,4,6";
        }
        
        $subs_factors = array(
            "meal_days" => $meals_days,
            "motel_days" => $motel_days,
            "id" => $id,
            "pay" => $pay,
            "fts_sections" => $fts_sections
            );

        if ($ajax == 1) {
            echo json_encode($subs_factors);
        } else {
            return $subs_factors;
        }
    }
}
// END Job Mob Class
