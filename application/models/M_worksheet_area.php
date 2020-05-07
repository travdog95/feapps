<?php
class M_worksheet_area extends CI_Model {
	
	private $_table_name = 'WorksheetAreas';

    function __construct()
    {
        parent::__construct();
    }

	/**
	 * get_by_job_number
	 *
	 * Gets all columns from WorksheetAreas table by Job_Idn and ChangeOrder
	 *
     * @access  public
	 * @param 	$job_number(string)
	 * @return 	$data(array)
	 */
	
	public function get_by_job_number($job_number)
	{
		//Delcare and initialize variables
		$data = array();
		$job_keys = array();
        $query = false;
		
		//Get job_keys
		$job_keys = get_job_keys($job_number);
		
		$query = $this->db->get_where($this->_table_name, array('Job_Idn' => $job_keys[0], 'ChangeOrder' => $job_keys[1]));
        
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
		    if ($query->num_rows() > 0)
		    {
			    foreach ($query->result_array() as $row)
			    {
				    $data[] = $row;
			    }
		    }
        }
		
		return $data;
	}
	
    /**
     * get_by_idn
     *
     * Get worksheet area record by WorksheetArea_Idn
     *
     * @access  public
     * @param   $worksheet_area_idn(integer)
     * @return  $data(array)
     */

    function get_by_idn($worksheet_area_idn)
    {
        //Delcare and initialize variables
        $data = array();
        $query = false;
        
		$query = $this->db->get_where($this->_table_name, array('WorksheetArea_Idn' => $worksheet_area_idn));
        
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
		    if ($query->num_rows() > 0)
		    {
			    foreach ($query->result_array() as $row)
			    {
				    $data = $row;
			    }
		    }
        }
		
		return $data;
    }
    
    /**
	 * insert
	 *
	 * Inserts record into table
	 *
     * @access  public
	 * @param 	$data(array)
	 * @return 	$new_worksheet_area_idn(int)
	 */
	
	public function insert($data)
	{
		//Declare and initialize variables
		$new_worksheet_area_idn = 0;
		
		//Insert row
		if ($this->db->insert($this->_table_name,$data))
        {
 		    //Get new WorksheetArea_Idn
		    $new_worksheet_area_idn = $this->db->insert_id();
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
		
		
		return $new_worksheet_area_idn;
	}
}