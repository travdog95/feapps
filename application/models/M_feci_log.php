<?php
class M_feci_log extends CI_Model {
	
	private $_table_name = 'Log';

    function __construct()
    {
        parent::__construct();
    }

	/**
	 * insert
	 *
	 * Inserts record into table
	 *
	 * @param 	$data(array)
	 */
	
	public function insert($data)
	{
		//Declare and Initialize variables
		$sql = "";
		//Insert row
		$query = $this->db->insert($this->_table_name,$data);
		
		if ($query == false)
		{
			$sql = $this->db->last_query();
			
			log_message("error","ERROR inserting record into Log table: ".super_trim($sql));
		}
	}
}