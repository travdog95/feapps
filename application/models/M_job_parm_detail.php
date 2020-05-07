<?php
class M_job_parm_detail extends CI_Model {
	
	private $_table_name = 'JobParmDetails';

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
	 * @param 	$data(array)
	 * @return 	bool
	 */
	public function insert($data)
	{
		//Declare and Initialize variables
		$query = false;
		
		//Insert row
		$query = $this->db->insert($this->_table_name,$data);
		
		if ($query == false)
		{
			write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
		}
		
		return $query;
	}
	
	/*
	 * get_job_parms
	 *
	 * Get JobParmDetails by Job Number and return as associative array with JobDefault_Idn as index
	 *
	 * @param	$job_number(string)
	 * @return	$job_parms(array)
	 */
	
	public function get_job_parms($job_number)
	{
		//Delcare and initialize variables
		$job_parms = array();
		$job_keys = array();

		//Get job_keys
		$job_keys = get_job_keys($job_number);
		
		//Compare JobParmDetails records with JobDefaults records and insert any missing records into JobParmDetails table
		$this->compare($job_number, true);
		
		//Get record from JobParmDetails table
		$query = $this->db->get_where($this->_table_name, array('Job_Idn' => $job_keys[0], 'ChangeOrder' => $job_keys[1]));
	
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				//Set job_default_idn
				$job_default_idn = $row['JobDefault_Idn'];
				
				//Remove JobDefault_Idn from array
				unset($row['JobDefault_Idn']);
				
				//Load row into associative array by job_default_type_idn
				$job_parms[$job_default_idn] = $row;
			}
		}
		
		return $job_parms;
	}
	
	/*
	 * save
	 *
	 * Save JobParmDetails record by Job_Idn, ChangeOrder and JobDefault_Idn 
	 *
	 * @param	$job_number(string)
	 * @param	$job_default_idn(integer)
	 * @param	$data(array) an array that contains the field name and value to save - 'AlphaValue' => 'N'
	 * @return	boolean
	 */
	
	function save($job_number, $job_default_idn=0, $data=array())
	{
		//Delcare and initialize variables
		$job_keys = array();
		$where = array();
		$save = false;
		
		//Get job keys
		$job_keys = get_job_keys($job_number);
		
		//Set where array
		$where = array(
			'Job_Idn' => $job_keys[0],
			'ChangeOrder' => $job_keys[1],
			'JobDefault_Idn' => $job_default_idn
		);
		
		//Only save record if necessary data exists
		if (array_sum($job_keys) > 0 && $job_default_idn > 0 && !empty($data))
		{
			//Check to see if record exists
			$save = $this->db->get_where($this->_table_name, $where);
			
			//If there's an error, then write log and set save_results
			if ($save == false)
			{
				write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
			}
			else
			{
				//Set where clause
				$this->db->where($where);
				
				//If record exists
				if ($save->num_rows() > 0)
				{
					//Update record
					$save = $this->db->update($this->_table_name, $data);
				}
				else
				{
					//Add fields to $data array for insert
					$data['Job_Idn'] = $where['Job_Idn'];
					$data['ChangeOrder'] = $where['ChangeOrder'];
					$data['JobDefault_Idn'] = $where['JobDefault_Idn'];
					
					//Insert Record	
					$save = $this->db->insert($this->_table_name, $data);
				}
				
				//Set save_results array
				if ($save == false)
				{
					write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
				}
			}
		}
		
		return $save;	
	}
	
	/*
	 * compare
	 *
	 * Compares records in JobParmDetails table with records JobDefaults table by Job_Idn and ChangeOrder, with the option to insert missing records into JobParmDetails table
	 *
	 * @param	$job_number(string)
	 * @param	$insert(bool) Insert any missing records into JobParmDetails table after compare
	 * @return	$missing_parm_idns(array) Number of missing rows in JobParmDetails table
	 */
	
	function compare($job_number, $insert = false)
	{
		//Delcare and initialize variables
		$job_keys = array();
		$missing = 0;
		$data = array();
		$missing_parm_idns = array();
		$load_flag = 0;
		$insert_row = false;
		
		//Get job keys
		$job_keys = get_job_keys($job_number);
		
		//Compare JobParmDetails records with JobDefaults records and instert any missing records into JobParmDetails table
		$sql = "SELECT *
				FROM JobDefaults AS jd 
				WHERE NOT EXISTS 
				(SELECT * FROM JobParmDetails AS jp
				WHERE jd.JobDefault_Idn = jp.JobDefault_Idn
				AND jp.Job_Idn = {$job_keys[0]} and jp.ChangeOrder = {$job_keys[1]})";
		$query = $this->db->query($sql);
		
		if ($query == false)
		{
			write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
		}
		else
		{
			$missing = $query->num_rows();
		}
		
		//missing records
		if ($missing > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$missing_parm_idns[] = $row['JobDefault_Idn'];
				
				if ($insert)
				{
					$load_flag = 0;
					$numeric_value = $row['NumericValue'];
					$alpha_value = $row['AlphaValue'];
					$load = false;

					//Build array to insert new record
					if ($row['LoadFromJobDefault_Idn'] > 0)
					{
						$load_flag = 1;
						//Get values from LoadFrom Job Default
						$this->db
							->select("NumericValue, AlphaValue")
							->from("JobDefaults")
							->where("JobDefault_Idn", $row['LoadFromJobDefault_Idn']);
						$load = $this->db->get();

						if ($load == false)
						{
							write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
						}
						else
						{
							if ($load->num_rows() > 0)
							{
								foreach ($load->result_array() as $job_default)
								{
									$numeric_value = $job_default['NumericValue'];
									$alpha_value = $job_default['AlphaValue'];
								}
							}
						}
					}

					$data = array(
						'Job_Idn' => $job_keys[0],
						'ChangeOrder' => $job_keys[1],
						'JobDefault_Idn' => $row['JobDefault_Idn'],
						'NumericValue' => $numeric_value,
						'AlphaValue' => $alpha_value,
						'LoadFlag' => $load_flag
					);
					
					//Insert into JobParmDetails table
					$insert_row = $this->insert($data);
				}
			}
		} //END: if ($missing > 0)
		
		return $missing_parm_idns;
	}
}