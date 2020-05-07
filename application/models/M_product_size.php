<?php
class M_product_size extends CI_Model {
	
	private $_table_name = 'ProductSizes';

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
            'ActiveFlag' => 1,
            'Value >=' => '0.5',
            'Value <=' => '10.0'
        );
        
		$this->db
			->select("*")
			->from($this->_table_name)
            ->where_in('Department_Idn', $department_idns)
            ->where($where)
			->order_by('Value ASC');
			
		$query = $this->db->get();

        if ($query)
        {
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

    /**
     * Summary of get_sizes
     * @param mixed $where 
     * @param mixed $department_idn 
     * @return array
     */
    public function get_product_sizes($where = "", $department_idn)
    {
        //Declare and initialize
        $sizes = array();
        $query = false;
        $department_idns = array($department_idn,3);

        $this->db
            ->select("*")
            ->from($this->_table_name)
            ->where_in("Department_Idn", $department_idns)
            ->where($where)
            ->order_by("Value ASC");

		$query = $this->db->get();

        if ($query)
        {
		    //If any records were returned, load into rows array
		    if ($query->num_rows() > 0)
		    {
			    foreach ($query->result_array() as $row)
			    {
                    $sizes[] = $row;
			    }
		    }
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }

        return $sizes;
    }
}