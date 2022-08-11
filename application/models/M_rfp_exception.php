<?php
class M_rfp_exception extends CI_Model {
	
	private $_table_name = 'RFPExceptions';

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_reference_table');
        $this->load->library("rfp_lib");
    }

    function all()
    {
        return $this->m_reference_table->get_all($this->_table_name);
    }

    function all_extended()
    {
        //Declare and initialize variables
        $data = array();    

        $this->db
            ->select("w.Job_Idn, w.ChangeOrder, j.Name AS JobName, u.FirstName, u.LastName, j.JobDate, w.Name AS WorksheetName, p.Product_Idn, p.Name as ProductName, s.Name AS RFPStatus")
            ->from("RFPExceptions AS rfp")
            ->join("RFPExceptionStatuses AS s", "rfp.RFPExceptionStatus_Idn = s.RFPExceptionStatus_Idn", "left")
            ->join("Worksheets AS w", "w.Worksheet_Idn = rfp.Worksheet_Idn", "left")
            ->join("Products AS p", "p.Product_Idn = rfp.Product_Idn", "left")
            ->join("Jobs AS j", "w.Job_Idn = j.Job_Idn AND w.ChangeOrder = j.ChangeOrder", "left")
            ->join("Users AS u", "j.CreatedBy_Idn = u.User_Idn", "left");

        $query = $this->db->get();

        if ($query)
        {
            foreach ($query->result_array() as $row)
            {
                array_push($data, $row);
            }
        }
    
        return $data;
    }

   /**
    * insert record into table
    *
    * @access   public
    * @param    $data(array)
    * @return   boolean
    */
    
    function insert($data)
    {
        $new_idn = $this->m_reference_table->insert_return_idn($this->_table_name, $data);
        
        if ($new_idn)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Summary of delete
     * @param mixed $where 
     * @return bool
     */
    function delete($where)
    {
        return $this->m_reference_table->delete($this->_table_name, $where);
    }

    /**
     * Summary of update
     * @param mixed $set 
     * @param mixed $where 
     * @return bool
     */
    function update($set, $where)
    {
        return $this->m_reference_table->update($this->_table_name, $set, $where);
    }
}