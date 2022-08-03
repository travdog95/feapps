<?php
class M_rfp_exception extends CI_Model {
	
	private $_table_name = 'RFPExceptions';

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_reference_table');
        $this->load->library("rfp_lib");
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