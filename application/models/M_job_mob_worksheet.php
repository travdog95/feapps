<?php
class M_job_mob_worksheet extends CI_Model {
	
	private $_table_name = 'JobMobWorksheets';

    function __construct()
    {
        parent::__construct();
    }

	/*
	 * get_by_worksheet_idn
	 *
	 * Gets all columns from JobMobWorksheets table by Worksheet_Idn
	 *
	 * @param 	$worksheet_idn(int)
	 * @return 	$job_mob_data(array)
	 */
	
	public function get_by_worksheet_idn($worksheet_idn)
	{
		//Delcare and initialize variables
		$job_mob_data = array();
		
		$query = $this->db->get_where($this->_table_name, array('Worksheet_Idn' => $worksheet_idn));
		
		if ($query->num_rows() == 1)
		{
			foreach ($query->result_array() as $row)
			{
				$job_mob_data = $row;
			}
		}
		
		return $job_mob_data;
	}
	
	/*
	 * insert
	 *
	 * Inserts record into table
	 *
	 * @param 	$job_mob_data(array)
	 * @return 	bool
	 */
	
	public function insert($job_mob_data)
	{
		//Insert row
		return $this->db->insert($this->_table_name,$job_mob_data);
	}
}