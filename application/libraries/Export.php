<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
* Export Class
*
* @author   TKO Consulting, LLC
*/
class Export
{
    //Public members
    //Private members
    private $CI;

    public function __construct()
    {
        //Set Code Igniter object
        $this->CI =& get_instance();

        //Load models
        $this->CI->load->model('m_reference_table');
    }

    /**
     * format_accounting_data
     *
     * Gets user data by user_name
     *
     * @access  public
     * @param   array
     * @return  array
     */

    public function get_accounting_data($job_numbers = array())
    {
        //Declare and initialize variables
        $data = array();
        $job_keys = array();
        $row = array();
        $row_defaults = array();
        $subcontract_data = array();
        $columns = $this->CI->m_reference_table->get_idns_names("WorksheetColumns", "WorksheetColumn_Idn");

        foreach ($job_numbers as $job_number)
        {
            $job_keys = get_job_keys($job_number);
            $row_defaults = array($job_keys[0], $job_keys[1], $job_number);

            //Instantiate Job
            $this->CI->load->library('j', array('job_number' => $job_number));
            $Job = $this->CI->j;
            $Job->load_recap_rows();
            
            //get Subcontract data
            $subcontract_data = $this->_get_subcontract_data($job_number, $Job->job['department_idn']);
            $amount = 0;

            foreach($subcontract_data as $sub)
            {
                //add defaults into row array
                $row = $row_defaults;

                //add subcontract data into row array
                $amount = $sub['Quantity'] * $sub['MaterialUnitPrice'];
                array_push($row, "Subcontract", $columns[$sub['WorksheetColumn_Idn']], $sub['Name'], $amount);

                //add row to data
                array_push($data, $row);
            }

            //Get job mob data
            $jobmob_data = $this->_get_jobmob_data($Job);

            foreach($jobmob_data as $jobmob)
            {
                if ($jobmob['Value'] > 0 && ($jobmob['WorksheetColumn_Idn'] == 2 || $jobmob['WorksheetColumn_Idn'] == 3))
                {
                    //add defaults into row array
                    $row = $row_defaults;

                    //add jobmob data into row array
                    array_push($row, "JobMob", $columns[$jobmob['WorksheetColumn_Idn']], $jobmob['Name'], $jobmob['Value']);

                    //add row to data
                    array_push($data, $row);
                }
            }

            //Get direct costs
            foreach($Job->subtotals[5]['Columns'] as $direct_cost)
            {
                //Load defaults
                $direct_costs_row = $row_defaults;
                //add direct cost data
                array_push($direct_costs_row, "Recap", $columns[$direct_cost['WorksheetColumn_Idn']], "Total Direct Cost", $direct_cost['Value']);
                //Add direct row to data
                array_push($data, $direct_costs_row);
            }

            //Get regular commission amount
            $commission_row = $row_defaults;
            array_push($commission_row, "Recap", "Totals", "Regular Commission", $Job->totals[2]['Value']);
            array_push($data, $commission_row);

            //Get profit mark-up amount
            $profit_markup_row = $row_defaults;
            array_push($profit_markup_row, "Recap", "Totals", "Profit Mark-Up", $Job->totals[5]['Value']);
            array_push($data, $profit_markup_row);

            //Get job total amount
            $job_total_row = $row_defaults;
            array_push($job_total_row, "Recap", "Totals", "Total", $Job->totals[13]['Value']);
            array_push($data, $job_total_row);

        }

        return $data;
    }

    private function _get_subcontract_data($job_number, $department_idn)
    {
        $data = array();
        $job_keys = get_job_keys($job_number);
        $worksheet_master_idn = ($department_idn == 1) ? 6 : 16;
        
        //Get worksheetDetails
        $this->CI->db
            ->select("wd.Quantity, wd.MaterialUnitPrice, p.Name, wd.WorksheetColumn_Idn")
            ->from("WorksheetDetails AS wd")
            ->join("Worksheets AS w", "w.Worksheet_Idn = wd.Worksheet_Idn", "left")
            ->join("Products AS p", "wd.Product_Idn = p.Product_Idn", "left")
            ->where("w.Job_Idn", $job_keys[0])
            ->where("w.ChangeOrder", $job_keys[1])
            ->where("w.WorksheetMaster_Idn", $worksheet_master_idn);

        $query = $this->CI->db->get();

        if ($query)
        {
            foreach ($query->result_array() as $row)
            {
                array_push($data, $row);
            }
        }

        //Get Miscellaneous Details
        $this->CI->db
            ->select("md.Quantity, md.MaterialUnitPrice, md.Name, md.WorksheetColumn_Idn")
            ->from("MiscellaneousDetails AS md")
            ->join("Worksheets AS w", "w.Worksheet_Idn = md.Worksheet_Idn", "left")
            ->where("w.Job_Idn", $job_keys[0])
            ->where("w.ChangeOrder", $job_keys[1])
            ->where("w.WorksheetMaster_Idn", $worksheet_master_idn);

        $query = $this->CI->db->get();

        if ($query)
        {
            foreach ($query->result_array() as $row)
            {
                array_push($data, $row);
            }
        }
    
        return $data;
    }

    private function _get_jobmob_data($Job)
    {
        //Get job keys
        $job_keys = get_job_keys($Job->job_number);

        //Get jobmob worksheet_idn
        $where = array(
            "Job_Idn" => $job_keys[0],
            "ChangeOrder" => $job_keys[1],
            "WorksheetMaster_Idn" => 8
        );
        $worksheet_idn = $this->CI->m_reference_table->get_field("Worksheets", "Worksheet_Idn", $where);

        //Get job mob worksheet data
        $this->CI->load->library('job_mob', array('w_id' => $worksheet_idn, 'j' => $Job));
        $JobMob = $this->CI->job_mob;

        return $JobMob->rows;
    }
}
