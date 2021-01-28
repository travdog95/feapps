<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Recap Row Class
 *
 * @category	Job Recap
 * @author		TKO Consulting, LLC
*/

class Recap_row
{
    //Declare and initialize member variables
    public $recap_row_idn = 0;
    public $job_number = "";
    public $recap_cells = array();
	public $name;
	public $additional_name;
    public $field_hours = 0;
    public $shop_hours = 0;
    public $engineer_hours = 0;
    public $recap_row;
    public $recap_row_worksheet_masters = array();
    public $worksheet_idn = 0;
    public $addtional_worksheet_idn = 0;

    //Private members
    private $CI;
    private $_where = array();

	/**
     * Recap Row Class Constructor
     *
     * The constructor loads the Recap Row class used to get totals by Worksheet Column (Bonded, Sub 18%, Sub, Material, Labor, Hours)
     * @param   string
     * @param   integer
     */

	public function __construct($params = array('recap_row_idn' => 0, 'j' => null, 'labor_hours' => array()))
	{
        //Declare and initialize variables
        $j = $params['j'];
        $recap_row = array();;

		// Set the super object to a local variable for use later
		$this->CI =& get_instance();

        //Load models
        $this->CI->load->model('m_recap_row');
        $this->CI->load->model('m_worksheet');
        $this->CI->load->model('m_job_parm_detail');

        //Set class properties
        $this->recap_row_idn = $params['recap_row_idn'];
	    $this->job_number = $j->job_number;
        $recap_row = $this->CI->m_recap_row->get_by_idn($this->recap_row_idn, false); //Get Recap row and related worksheet master(s)
        $this->recap_row = $recap_row[0];
        $this->name = $this->recap_row['Name'];
        $this->recap_row_worksheet_masters = $this->CI->m_recap_row->get_by_idn($this->recap_row_idn, true);
        $this->additional_name = "";
        $job_keys = get_job_keys($this->job_number);

        // if ($this->job_number == 2072)
        // {
        //     echo json_encode($j->children);
        // }

        //Set recap cell activity
        $this->_initiate_recap_cells($this->recap_row_idn);

        //Load where array with job_idn and change order
        $this->_where = array(
            'Job_Idn' => $job_keys[0],
            'ChangeOrder' => $job_keys[1]
        );

        if ($this->recap_row['CalcShopFlag'] == 0)
        {
            $this->shop_hours = $params['labor_hours']['ShopHours'];
        }

        //If job is parent, iterate over child jobs to calculate cell and labor totals
        if ($j->job['is_parent'] == 1)
        {
            $this->worksheet_idn = 0;
            $this->addtional_worksheet_idn = 0;

            foreach ($j->children as $child)
            {
                //Job Mob
                // if ($this->recap_row_idn == 8) {

                // } else {
                    //Labor amounts
                    $this->field_hours += ceil($child->RRs[$this->recap_row_idn]->field_hours);
                    $this->shop_hours += ceil($child->RRs[$this->recap_row_idn]->shop_hours);
                    $this->engineer_hours += ceil($child->RRs[$this->recap_row_idn]->engineer_hours);

                    //Total recap cell amounts
                    for ($i = 1; $i <= 6; $i++)
                    {
                        if ($this->recap_cells[$i] !== false)
                        {
                            $this->recap_cells[$i] += ceil($child->RRs[$this->recap_row_idn]->recap_cells[$i]);
                        }
                    }
                // }
            }
        }
        else
        {
            //Load class properties
            switch($this->recap_row_idn)
            {
                case 1: //Underground
                    $this->_load_underground($j);
                    break;
                case 22: //Shop Labor
                case 29:
                    //Get shop hours
                    $this->recap_cells[5] = ceil($this->shop_hours * $j->job['shop_labor_rate']);
                    $this->recap_cells[6] = $this->shop_hours;
                    break;
                default:
                    $this->_load_row($j);
                    break;
            }
        }

        log_message('debug', "Recap Row Class Initialized");
	}

    /**
     * _initiate_recap_cells
     *
     * Initiates recap_cells property by populating property with associative array with WorksheetColumn_Idn and true for active cells and false for inactive cells.
     *
     * @access  private
     * @return  void
     */

    private function _initiate_recap_cells()
    {
        //Delcare and initialize variables
        $recap_cells = array();
        $where = array();

        //Load model
        $this->CI->load->model('m_reference_table');

        //Load where
        $where = array('RecapRow_Idn' => $this->recap_row_idn);

        //Get Recap Cells
        $recap_cells = $this->CI->m_reference_table->get_where('RecapCells', $where);

        //Iterate through results to set property to false
        foreach ($recap_cells as $recap_cell)
        {
            $this->recap_cells[$recap_cell['WorksheetColumn_Idn']] = ($recap_cell['ActiveFlag'] == 1) ? 0 : false;
        }
    }

    /**
     * _load_underground()
     *
     * Loads cells for underground row
     *
     * @access  private
     * @param   object
     * @return  void
     */

    private function _load_underground($j)
    {
        //Delcare and initialize variables
        $worksheet_idn = 0;
        $w;
        $w2;

        //Set additional name for Underground Subcontracts
        $this->additional_name = "Subcontract";

        //Read through Worksheet Masters
        foreach ($this->recap_row_worksheet_masters as $recap_row_worksheet_master)
        {
            //Load WorksheetMaster_Idn into where array
            $this->_where['WorksheetMaster_Idn'] = $recap_row_worksheet_master['WorksheetMaster_Idn'];

            //Get worksheet_idn(s)
            if ($recap_row_worksheet_master['WorksheetMaster_Idn'] == 11)
            {
                $worksheet_idn = $this->CI->m_worksheet->get_idn_by($this->_where);
                //If worksheet exists
                if ($worksheet_idn > 0)
                {
                    //$w = new Worksheet;
                    $worksheet_instance = 'underground'.$worksheet_idn;
                    $this->CI->load->library('worksheet', array('w_id' => $worksheet_idn), $worksheet_instance);
                    $w = $this->CI->$worksheet_instance;

                    $w->get_totals($worksheet_idn);

                    $this->recap_cells[4] = ceil($w->material);
                    $this->recap_cells[5] = ceil(ceil($w->field_hours) * $j->job_parms[65]['NumericValue']);
                    $this->recap_cells[6] = ceil($w->field_hours);

                    //Total field, shop & engineer hours
                    $this->field_hours += $w->field_hours;
                    $this->shop_hours += $w->shop_hours;
                    $this->engineer_hours += $w->engineering_hours;
                }

                //Set worksheet_idn
                $this->worksheet_idn = $worksheet_idn;
            }
            else if($recap_row_worksheet_master['WorksheetMaster_Idn'] == 29)
            {
                $worksheet_idn = $this->CI->m_worksheet->get_idn_by($this->_where);

                if ($worksheet_idn > 0)
                {
                    //$w2 = new Worksheet;
                    $worksheet_instance = 'underground_sub'.$worksheet_idn;
                    $this->CI->load->library('worksheet', array('w_id' => $worksheet_idn), $worksheet_instance);
                    $w2 = $this->CI->$worksheet_instance;

                    $w2->get_totals($worksheet_idn);

                    $this->recap_cells[1] = ceil($w2->bonded);
                    $this->recap_cells[2] = ceil($w2->low_sub);
                    $this->recap_cells[3] = ceil($w2->high_sub);

                    //Total shop & engineer hours
                    $this->shop_hours += $w2->shop_hours;
                    $this->engineer_hours += $w2->engineering_hours;
                }

                //Set additional worksheet_idn
                $this->addtional_worksheet_idn = $worksheet_idn;
            }
        }
    }

    /**
     * _load_row
     *
     * Loads cells for recap row
     *
     * @access  private
     * @param   object($j)
     * @return  void
     */

    function _load_row($j)
    {
        //Delcare and initialize variables
        $worksheet_idn = 0;
        $w;

        //Load WorksheetMaster_Idn into where array
        $this->_where['WorksheetMaster_Idn'] = $this->recap_row_worksheet_masters[0]['WorksheetMaster_Idn'];

        //Get worksheet_idn
        $worksheet_idn = $this->CI->m_worksheet->get_idn_by($this->_where);

        $this->worksheet_idn = $worksheet_idn;

        if ($worksheet_idn > 0)
        {
            if ($this->recap_row_idn == 8 || $this->recap_row_idn == 32) //Job Mob
            {
                //$w = new Job_mob(array('w_id' => $worksheet_idn, 'j' => $j));
                $this->CI->load->library('job_mob', array('w_id' => $worksheet_idn, 'j' => $j));
                $w = $this->CI->job_mob;

				$this->shop_hours = $w->jm_shop_hours;
				$this->engineer_hours = $w->jm_eng_hours;
			}
            else
            {
                //Get worksheet totals
                //$w = new Worksheet(array('w_id' => $worksheet_idn));
                $worksheet_instance = 'worksheet'.$worksheet_idn;
                $this->CI->load->library('worksheet', array('w_id' => $worksheet_idn), $worksheet_instance);
                $w = $this->CI->$worksheet_instance;

                $w->get_totals($worksheet_idn);

				$this->shop_hours = $w->shop_hours;
				$this->engineer_hours = $w->engineering_hours;
            }

            //Total shop & engineer hours
            $this->field_hours = $w->field_hours;

            foreach ($this->recap_cells as $column => $recap_cell)
            {
                if ($recap_cell !== false)
                {
                    switch($column)
                    {
                        case 1: //Bonded
                            $this->recap_cells[$column] = ceil($w->bonded);
                            break;
                        case 2: //Low Sub (18%)
                            $this->recap_cells[$column] = ceil($w->low_sub);
                            break;
                        case 3: //High Sub (37%)
                            $this->recap_cells[$column] = ceil($w->high_sub);
                            break;
                        case 4: //Material
                            $this->recap_cells[$column] = ceil($w->material);
                            break;
                        case 5: //Labor
                            if ($this->recap_row_idn == 7  || $this->recap_row_idn == 31) //Engineering
                            {
                                $this->recap_cells[$column] = ceil(ceil($w->engineering_hours) * $j->job['design_labor_rate']);
                            }
							else if ($this->recap_row_idn == 8 || $this->recap_row_idn == 32) //Job mob
                            {
                                $this->recap_cells[$column] = ceil($w->field);
                            }
                            else
                            {
                                $this->recap_cells[$column] = ceil(ceil($w->field_hours) * $j->job['field_labor_rate']);
                            }
                            break;
                        case 6: //Hours
                            if ($this->recap_row_idn == 7  || $this->recap_row_idn == 31) //Engineering
                            {
                                $this->recap_cells[$column] = ceil($w->engineering_hours);
                            }
							else if ($this->recap_row_idn == 8 || $this->recap_row_idn == 32) //Job mob
							{
								$this->recap_cells[$column] = ceil($w->jm_eng_hours); //job mob engineering hours
							}
                            else
                            {
                                $this->recap_cells[$column] = ceil($w->field_hours);
                            }
                            break;
                    }
                }
            }
        }
    }
}
// END Recap_row Class