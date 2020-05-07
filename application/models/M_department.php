<?php
class M_department extends CI_Model {
	
	private $_table_name = 'jpr_Department';

    function __construct()
    {
        parent::__construct();
    }

	/*
	 * get_departments
	 *
	 * Get all records from jpr_Department table
	 *
	 * @param NONE
	 * @return ($departments(array))
	 */

	public function get_departments()
	{
		//Delcare and initialize variables
		$departments = array();
		
		$this->db
			->select("*")
			->from($this->_table_name)
			->order_by('Description','ASC');
		
		$query = $this->db->get();

		//If any records were returned, load into rows array
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$departments[] = $row;
			}
		}
		
		return $departments;	
	}

	/*
	 * get_department_name
	 *
	 * Get department name by id
	 *
	 * @param	department_idn(int)
	 * @return	department_name(string)
	 */

	public function get_department_name($department_idn=0)
	{
		//Delcare and initialize variables
		$department_name = "";
		
		$this->db
			->select("Description")
			->from($this->_table_name)
			->where('DepartmentID', $department_idn);
		
		$query = $this->db->get();

		//If any records were returned, load into rows array
		if ($query->num_rows() == 1)
		{
			foreach ($query->result_array() as $row)
			{
				$department_name = $row['Description'];
			}
		}
		
		return $department_name;	
	}
}