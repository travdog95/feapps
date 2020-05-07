<?php
class M_job_volume_correction extends CI_Model {
	
	private $_table_name = 'JobVolumeCorrections';
    
    public $default = 2;

    function __construct()
    {
        parent::__construct();
    }

	/*
	 * get_by_job_number
	 *
	 * Gets all columns from Jobs table by Job_Idn and ChangeOrder
	 *
	 * @param 	$job_number(string)
	 * @return 	$job_data(array)
	 */
	
	public function get_by_job_number($job_number)
	{
		//Delcare and initialize variables
		$job_data = array();
		$job_keys = array();
		
		//Get job_keys
		$job_keys = get_job_keys($job_number);
		
		$query = $this->db->get_where($this->_table_name, array('Job_Idn' => $job_keys[0], 'ChangeOrder' => $job_keys[1]));
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$job_data[] = $row;
			}
		}
		
		return $job_data;
	}
	
	/*
	 * insert
	 *
	 * Inserts record into table
	 *
	 * @param 	$job_data(array)
	 * @return 	bool
	 */
	
	public function insert($job_data)
	{
		//Insert row
		return $this->db->insert($this->_table_name,$job_data);
	}
}