<?php
class M_pipe_type extends CI_Model {
	
	private $_table_name = 'PipeTypes';

    function __construct()
    {
        parent::__construct();
    }
	
	/*
     * get_for_worksheet_parms
	 *
	 * Get records from Menus table by MenuType_Idn. By default, method returns records where ActiveFlag = 1
	 *
	 * @param	number(worksheet_master_idn)
     * @param 	number($department_idn)
	 * @return 	array($data)
	 */

	public function get_for_worksheet_parms($worksheet_master_idn, $department_idn)
	{
		//Delcare and initialize variables
		$data = array();
        $department_idns = array($department_idn,3);
		$where = array();
        
        //Determine query variables
        $where = array (
            'ActiveFlag' => 1
        );
        
        if ($worksheet_master_idn == 11)
        {
            $where['IsUnderground'] = 1;
        }
        else
        {
            $this->db->where_in('Department_Idn', $department_idns);
        }
        
		$this->db
			->select("*")
			->from($this->_table_name)
            ->where($where)
			->order_by('Rank ASC');
			
		$query = $this->db->get();

        if ($query)
        {
            //write_feci_log(array("Message" => "Test ".$this->db->last_query(), "Script" => __METHOD__));
            
		    //If any records were returned, load into rows array
		    if ($query->num_rows() > 0)
		    {
			    foreach ($query->result_array() as $row)
			    {
                    $data[] = $row;
			    }
		    }
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }

        return $data;	
	}
}