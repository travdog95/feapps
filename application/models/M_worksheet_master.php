<?php
class M_worksheet_master extends CI_Model {
	
	private $_table_name = 'WorksheetMasters';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * get_by_idn
     *
     * Get WorksheetMaster record by WorksheetMaster_Idn
     *
     * @access  public
     * @param   $worksheet_master_idn(mixed)
     * @return  $data(array)
     */
    
    function get_by_idn($worksheet_master_idn)
    {
        //Delcare and initialize variables
		$data = array();
        $query = false;
		
		$query = $this->db->get_where($this->_table_name, array('WorksheetMaster_Idn' => $worksheet_master_idn));
		
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
				    $data = $row;
			    }
		    }
        }

        return $data;
    }
    
    /**
     * get_all_by_department_idn
     *
     * Get all active worksheet master records by Department_Idn
     *
     * @param   $department_idn(integer)
     * @return  array
     */
    
    function get_all_by_department_idn($department_idn)
    {
        //Delcare and initialize variables
        $data = array();
        $query = false;
        
        $this->db->select("*")
            ->from($this->_table_name)
            ->where('Department_Idn', $department_idn)
            ->where('ActiveFlag', 1)
            ->order_by('Rank','Asc');
        
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
                    $data[$row['WorksheetMaster_Idn']] = $row;
                }
            }
        }
        
        return $data;
    }
    
    /**
     * get_categories
     *
     * Loads WorksheetMasterCategires member
     * 
     * @access  public
     * @param   number
     * @return  array
     */
    
    function get_categories($worksheet_master_idn)
    {
        //Declare and initialize variables
        $query = false;
        $data = array();
        
        //Load controller

        $this->db->select("*")
            ->from('v_WorksheetMasterCategories')
            ->where('WorksheetMaster_Idn', $worksheet_master_idn)
            ->where('ActiveFlag', 1)
            ->order_by('Rank','Asc');
        
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
                    $data[] = $row;
                }
            }
        }
        
        return $data;
    }
    
    /**
     * get_sizes
     *
     * Loads WorksheetMasterCategires member
     * 
     * @access  public
     * @param   number
     * @return  array
     */
    
    function get_sizes($worksheet_master_idn)
    {
        //Declare and initialize variables
        $query = false;
        $data = array();
        
        $this->db->select('WorksheetMaster_Idn, s.*')
            ->from('WorksheetMasterSizes AS wms')
            ->join('ProductSizes AS s', 'wms.ProductSize_Idn = s.ProductSize_Idn')
            ->where('WorksheetMaster_Idn', $worksheet_master_idn)
            ->where('s.ActiveFlag', 1)
            ->order_by('s.Value','Asc');
        
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
                    $data[] = $row;
                }
            }
        }
        
        return $data;
    }
    
    /**
    * get_defaults
    * 
    * Get default categories. Categories where LoadFlag is 1.
    *
    * @param    number
    * @return   array
    */
    
    function get_defaults($worksheet_master_idn)
    {
        //Delcare and initialize variables
        $query = false;
        $data = array();
        
        $this->db->select('WorksheetCategory_Idn')
            ->from('WorksheetMasterCategories')
            ->where('WorksheetMaster_Idn', $worksheet_master_idn)
            ->where('LoadFlag', 1)
            ->order_by('Rank','Asc');
        
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
                    $data[] = $row['WorksheetCategory_Idn'];
                }
            }
        }
        
        return $data;
    }

    /**
     * get_parent
     * 
     * Get parent WorksheetMaster_Idn if on exists, else return 0.
     *
     * @param    number
     * @return   number
     */
    
    function get_parent($worksheet_master_idn)
    {
        //Delcare and initialize variables
        $query = false;
        $parent = 0;
        
        $this->db->select('WorksheetMaster_Idn')
            ->from('WorksheetMasterCategories')
            ->where('ChildWorksheetMaster_Idn', $worksheet_master_idn);
        
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
                    $parent = $row['WorksheetMaster_Idn'];
                }
            }
        }
        
        return $parent;
    }

    /**
     * Summary of get_shared_categories
     * @param mixed $worksheet_master_idn 
     * @param mixed $is_shared 
     * @return array
     */
    function get_shared_categories($worksheet_master_idn, $is_shared = 0)
    {
        //Delcare and initialize variables
        $query = false;
        $data = array();

        $this->db->select('WorksheetCategory_Idn')
            ->from('v_WorksheetMasterCategories')
            ->where('WorksheetMaster_Idn', $worksheet_master_idn)
            ->where('ActiveFlag', 1)
            ->where("IsShared", $is_shared)
            ->order_by('Rank','Asc');
        
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
                    $data[] = $row['WorksheetCategory_Idn'];
                }
            }
        }
        
        return $data;
    }

    /**
     * Summary of get_auto_load_categories
     * @param mixed $worksheet_master_idn 
     * @return array
     */
    function get_auto_load_categories($worksheet_master_idn)
    {
        //Delcare and initialize variables
        $query = false;
        $data = array();
        
        $this->db->select('WorksheetCategory_Idn')
            ->from('WorksheetMasterCategories')
            ->where('WorksheetMaster_Idn', $worksheet_master_idn)
            ->where('AutoLoadFlag', 1)
            ->order_by('Rank','Asc');
        
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
                    $data[] = $row['WorksheetCategory_Idn'];
                }
            }
        }
        
        return $data;
    }

}