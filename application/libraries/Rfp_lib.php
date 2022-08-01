<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
* Rfp Class
*
* @author   TKO Consulting, LLC
*/
class Rfp_lib
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

    public function get_exceptions()
    {
        //Declare and initialize variables
        $data = array();
      
        //Get worksheetDetails
        $this->CI->db
            ->select("w.Job_Idn, w.ChangeOrder, j.Name AS JobName, j.JobDate, w.Name AS WorksheetName, wd.Product_Idn, p.Name as ProductName")
            ->from("WorksheetDetails AS wd")
            ->join("Worksheets AS w", "w.Worksheet_Idn = wd.Worksheet_Idn", "left")
            ->join("Products AS p", "wd.Product_Idn = p.Product_Idn", "left")
            ->join("Jobs AS j", "w.Job_Idn = j.Job_Idn AND w.ChangeOrder = j.ChangeOrder", "left")
            ->where("p.RFP", "1");

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

}
