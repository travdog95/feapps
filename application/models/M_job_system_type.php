<?php
class M_job_system_type extends CI_Model {
	
	private $_table_name = 'JobSystemTypes';

    function __construct()
    {
        parent::__construct();
    }

	/**
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
		$query = false;
		
		//Get job_keys
		$job_keys = get_job_keys($job_number);
		
		$query = $this->db->get_where($this->_table_name, array('Job_Idn' => $job_keys[0], 'ChangeOrder' => $job_keys[1]));
		
		if ($query != false)
		{
			//If data is returned, iterate threough results and create array of rows
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$job_data[] = $row;
				}
			}
		}
		else
		{
			write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
		}
		
		return $job_data;
	}
	
	/**
	 * insert
	 *
	 * Inserts record into table
	 *
	 * @param 	$job_data(array)
	 * @return 	bool
	 */
	
	public function insert_row($data)
	{
		//Declare and Initialize Variables
		$query = false;
		
		//Insert row
		$query = $this->db->insert($this->_table_name,$data);
		
		if ($query == false)
		{
			write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
		}
		
		return $query;
	}
	
	/**
	 * delete_by_job_number
	 *
	 * Delete all records by Job_Idn and ChangeOrder
	 *
	 * @param 	$job_number(string)
	 * @return 	bool
	 */
	
	public function delete_by_job_number($job_number)
	{
		//Declare and initialize variables
		$job_keys = array();
		$where = array();
		$query = false;
		
		$job_keys = get_job_keys($job_number);
		
		$where = array(
			'Job_Idn' => $job_keys[0],
			'ChangeOrder' => $job_keys[1]
		);
		
		//Delete all records by Job_Idn and ChangeOrder
		$query = $this->db->delete($this->_table_name, $where);
		
		if ($query == false)
		{
			write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
		}
		
		return $query;
	}
	
	/**
	 * get_job_system_types
	 *
	 * Get SystemType_Idns from JobSystemTypes table by Job_Idn and ChangeOrder
	 *
	 * @param 	$job_number(string)
	 * @return 	$job_system_types(array)
	 */
	
	public function get_job_system_types($job_number, $is_sub_type=0)
	{
		//Delcare and initialize variables
		$job_system_types = array();
		$job_keys = array();
		$where = array();
		$query = false;
		
		//Get job_keys
		$job_keys = get_job_keys($job_number);

		$where = array(
			'Job_Idn' => $job_keys[0], 
			'ChangeOrder' => $job_keys[1],
			'IsSubType' => $is_sub_type
		);
		
		//Get search results from table
		$this->db
			->select("SystemType_Idn")
			->from($this->_table_name)
			->where($where);

		$query = $this->db->get();
		
		if ($query != false)
		{
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					//Load SystemType_Idn into array
					$job_system_types[] = $row['SystemType_Idn'];
				}
			}
		}
		else
		{
			write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
		}
		
		return $job_system_types;
	}
}