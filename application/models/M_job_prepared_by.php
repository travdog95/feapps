<?php
class M_job_prepared_by extends CI_Model {
	
	private $_table_name = 'JobPreparedBys';

    function __construct()
    {
        parent::__construct();
    }

	/**
	 * get_by_job_number
	 *
	 * Gets all columns from Jobs table by job_number (Job_Idn and ChangeOrder)
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
		
		if ($query != false)
		{
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
    
	/*
	 * get_by_job_number
	 *
	 * Gets all columns from Jobs table by Job_Idn and ChangeOrder
	 *
	 * @param 	$job_number(string)
	 * @return 	$job_data(array)
	 */
	
	public function get_prepared_bys($job_number)
	{
		//Delcare and initialize variables
		$prepared_bys = array();
		$job_keys = array();
		
		//Get job_keys
		$job_keys = get_job_keys($job_number);
		
		$query = $this->db->get_where($this->_table_name, array('Job_Idn' => $job_keys[0], 'ChangeOrder' => $job_keys[1]));
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$prepared_bys[] = $row['PreparedBy_Idn'];
			}
		}
		
		return $prepared_bys;
	}


	/**
	 * save_prepared_bys
	 *
	 * Inserts, updates and deletes JobPreparedBys records in table as needed
	 *
	 * @param	$job_number(string)
	 * @param	$save_prepared_bys(array)
	 * @return	boolean
	 */
	
	function save_prepared_bys($job_number, $save_prepared_bys = array())
	{
		//Initialize and declare variables
		$prepared_bys = array();
		$where = array();
		$set = array();
		$job_keys = array();
		
		$prepared_bys = $this->get_prepared_bys($job_number);
		
		$job_keys = get_job_keys($job_number);
		
		if (empty($save_prepared_bys))
		{
			//Delete all Job Prepared Bys by Job_Idn and ChangeOrder
			$where = array(
				"Job_Idn" => $job_keys[0],
				"ChangeOrder" => $job_keys[1]
			);
			
			if ($this->delete_prepared_bys($where) == false)
			{
				return false;
			}
		}
		else
		{
			//Read through existing values and delete values not in new values (save_prepared_bys)
			foreach ($prepared_bys as $prepared_by)
			{
				if (!in_array($prepared_by, $save_prepared_bys))
				{
					$where = array(
						"Job_Idn" => $job_keys[0],
						"ChangeOrder" => $job_keys[1],
						"PreparedBy_Idn" => $prepared_by
					);
					
					if ($this->delete_prepared_bys($where) == false)
					{
						return false;
					}
				}
			}
			
			//Read through new values and add records that are not table
			foreach ($save_prepared_bys as $save_prepared_by)
			{
				if (!in_array($save_prepared_by, $prepared_bys))
				{
					$set = array(
						"Job_Idn" => $job_keys[0],
						"ChangeOrder" => $job_keys[1],
						"PreparedBy_Idn" => $save_prepared_by
					);
					
					if ($this->insert_prepared_by($set) == false)
					{
						return false;
					}
				}
			}
		}
		
		return true;
	}
	
	/*
	 * delete_prepared_bys
	 *
	 * Delete all records in JobPreparedBys table by $where array ('column_name' => value)
	 *
	 * @param	$where(array)
	 * @return	boolean
	 */
	
	function delete_prepared_bys($where)
	{
		if ($this->db->delete($this->_table_name, $where))
		{
			return true;
		}
		else
		{
			write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
			
			return false;
		}
	}

	/*
	 * insert_prepared_by
	 *
	 * Insert record into JobPreparedBys table by $set array ('column_name' => value)
	 *
	 * @param	$set(array)
	 * @return	boolean
	 */
	
	function insert_prepared_by($set)
	{
		if ($this->db->insert($this->_table_name, $set))
		{
			return true;
		}
		else
		{
			write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
			
			return false;
		}
	}

    /*
     * get_prepared_by_names
     *
     * Gets all first names (last names too if $last_name argument is true) of prepared bys
     *
     * @param 	$job_number(string)
     * @param   $last_name(boolean)
     * @return 	$names(string)
     */
	
	public function get_prepared_by_names($job_number, $last_name = false)
	{
		//Delcare and initialize variables
		$names = "";
		$job_keys = array();
		
		//Get job_keys
		$job_keys = get_job_keys($job_number);
        
        $this->db
            ->select("LastName, FirstName")
            ->from($this->_table_name)
            ->join('Users', $this->_table_name.'.PreparedBy_Idn = Users.User_Idn')
            ->where('Job_idn', $job_keys[0])
            ->where('ChangeOrder', $job_keys[1])
            ->order_by('LastName ASC, FirstName ASC');
        
		$query = $this->db->get();
		
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
                    //Insert comma if another name is there
                    $names .= (empty($names)) ? "" : ", ";
                    
                    //Add last name if $last_name is true
                    $names .= ($last_name) ? $row['FirstName'].' '.$row['LastName'] : $row['FirstName'];
                }
            }
        }
		
		return $names;
	}
}