<?php
class M_job_default extends CI_Model {
	
	private $_table_name = 'JobDefaults';

    function __construct()
    {
        parent::__construct();
    }

	/*
	 * get_by_type
	 *
	 * Gets all records by JobDefaultType_Idn
	 *
	 * @param 	$type_idn(mixed) could be integer or array
	 * @return 	$rows(array)
	 */
	
	public function get_by_type($type_idn, $select = "*")
	{
		//Delcare and initialize variables
		$rows = array();
		$job_default_idn = 0;
		
		$this->db
			->select($select)
			->from($this->_table_name)
			->where('ActiveFlag',1)
			->order_by('Rank ASC');
			
		if (is_array($type_idn))
		{
			$this->db->where_in('JobDefaultType_Idn', $type_idn);
		}
		else
		{
			$this->db->where('JobDefaultType_Idn', $type_idn);
		}
			
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				//Set job_default_idn
				$job_default_idn = $row['JobDefault_Idn'];
				
				//Remove JobDefault_Idn from array
				unset($row['JobDefault_Idn']);
				
				//Load row into associative array by job_default_type_idn
				$rows[$job_default_idn] = $row;
			}
		}
		
		return $rows;
	}
	
	/*
	 * get_values_by_type
	 *
	 * Gets NumericValue and AlphaValue from table by JobDefaultType_Idn
	 *
	 * @param 	$type_idn(mixed) could be integer or array
	 * @return 	$rows(array)
	 */
	
	public function get_values_by_type($type_idn)
	{
		//Delcare and initialize variables
		$rows = array();
		
		$rows = $this->get_by_type($type_idn, "JobDefault_Idn, JobDefaultType_Idn, NumericValue, AlphaValue");
				
		return $rows;
	}
}