<?php
class M_recap_row extends CI_Model {
	
	private $_table_name = 'RecapRows';

    function __construct()
    {
        parent::__construct();
    }
	
	/**
     * get_by_department_idn
     *
     * Get all active rows from table by Department_Idn, ordered by Rank. Optional where associative array can be passed in.
     *
     * @access  public
     * @param	$department_idn(integer)
     * @param   $where(array)
     * @return	$rows(array)
     */

	public function get_by_department_idn($department_idn, $where = array())
	{
		//Delcare and initialize variables
		$rows = array();
        $query = false;
		
		//Get all active records
		$this->db
			->select("*")
			->from($this->_table_name)
            ->where('ActiveFlag', 1)
            ->where('Department_Idn', $department_idn)
            ->order_by('Rank','asc');
		
        if (!empty($where))
        {
            $this->db->where($where);
        }
        
		$query = $this->db->get();
            
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
			//If any records were returned, load into rows array
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$rows[] = $row;
				}
			}
        }
	    
        return $rows;	
	}
    
	/**
     * get_by_idn
     *
     * Get all active rows from table by Department_Idn, ordered by Rank.
     *
     * @access  public
     * @param	$recap_row_idn(integer)
     * @param   $worksheet_masters(boolean)
     * @return	$row(array)
     */

	public function get_by_idn($recap_row_idn, $worksheet_masters = false)
	{
		//Delcare and initialize variables
		$recap_rows = array();
        $query = false;
		
		//Get all active records
		$this->db
			->select("*")
			->from($this->_table_name)
            ->where($this->_table_name.'.ActiveFlag', 1)
            ->where($this->_table_name.'.RecapRow_Idn', $recap_row_idn);
        
        //Join with RecapRowWorksheetDetails table if $worksheet_masters flag set to true
        if ($worksheet_masters)
        {
            $this->db->join('RecapRowWorksheetMasters', 'RecapRows.RecapRow_Idn = RecapRowWorksheetMasters.RecapRow_Idn', 'left');
        }
        
		$query = $this->db->get();
        
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
			//If any records were returned, load into rows array
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
                    //if ($query->num_rows() == 1)
                    //{
                    //    $recap_rows = $row;
                    //}
                    //else
                    //{
                        $recap_rows[] = $row;
                    //}
				}
			}
        }
	    
        return $recap_rows;	
	}
}