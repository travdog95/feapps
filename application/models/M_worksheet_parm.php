<?php
class M_worksheet_parm extends CI_Model {
	
	private $_table_name = 'WorksheetParms';

    function __construct()
    {
        parent::__construct();
    }

	/**
     * get_worksheet_parms_by_reference
     *
     * Gets column name ($column) from table by worksheet_idn and parm_reference
     * 
     * @param mixed $worksheet_idn 
	 * @param mixed $parm_reference 
	 * @param mixed $column 
	 * @return mixed
	 */
	public function get_worksheet_parms_by_reference($worksheet_idn, $parm_reference, $column)
	{
		//Delcare and initialize variables
		$data = array();
        $query = false;
		
        $this->db->select($column)
            ->from($this->_table_name)
            ->where('Worksheet_Idn', $worksheet_idn)
            ->where('ParmReference', $parm_reference);
        
		$query = $this->db->get();
        
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
			foreach ($query->result_array() as $row)
			{
                $data[] = (empty($row[$column])) ? null : $row[$column];
            }
        }
        
		return $data;
	}
	
    /**
     * Summary of get_all_worksheet_parms_by_reference
     * 
     * Groups Worksheet Parameters from WorksheetParms table by ParmReference for a given worksheet and returns values passed in column
     * 
     * @param mixed $worksheet_idn 
     * @param mixed $column 
     * @return array
     */
    public function get_all_worksheet_parms_by_reference($worksheet_idn = 0, $column = "")
    {
        $parm_references = array();
        $parms = array();

        $parm_references = $this->_get_worksheet_parm_references_by_worksheet($worksheet_idn);

        foreach($parm_references as $parm_reference)
        {
            $parms[$parm_reference] = $this->get_worksheet_parms_by_reference($worksheet_idn, $parm_reference, $column);
        }

        return $parms;
    }

    /**
     * Summary of _get_worksheet_parm_references
     * @access private
     * @param mixed $worksheet_idn 
     * @return array
     */
    private function _get_worksheet_parm_references_by_worksheet($worksheet_idn = 0)
    {
        $parm_references = array();
        $query = false;

        $this->db->select("ParmReference")
            ->from($this->_table_name)
            ->where("Worksheet_Idn", $worksheet_idn)
            ->group_by("ParmReference")
            ->order_by("ParmReference");
        
		$query = $this->db->get();
        
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
			foreach ($query->result_array() as $row)
			{
                $parm_references[] = $row["ParmReference"];
		    }
        }
        return $parm_references;
    }

    /**
	 * insert
	 *
	 * Inserts record into table
	 *
     * @access  public
	 * @param 	$data(array)
	 * @return 	bool
	 */
	
	public function insert($data)
	{
		//Insert row
		if ($this->db->insert($this->_table_name,$data))
        {
            return true;
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            return false;
        }
	}
}