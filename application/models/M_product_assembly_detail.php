<?php
class M_product_assembly_detail extends CI_Model {
	
	private $_table_name = 'ProductAssemblyDetails';

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_reference_table');
        $this->load->model('m_rfp_exception');
        $this->load->model('m_product_assembly');
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
            //check to see if an rfp exception needs to be created
            if ($this->rfp_lib->is_product_exception($data['Product_Idn']))
            {
                $insert_data = array(
                    "Worksheet_Idn" => $this->m_product_assembly->get_worksheet_idn($data['ProductAssembly_Idn']),
                    "RFPExceptionStatus_Idn" => 1, //new
                    "MiscellaneousDetail_Idn" => $this->m_product_assembly->get_miscellaneous_detail_idn($data['ProductAssembly_Idn']),
                );

                $this->m_rfp_exception->insert($insert_data);
            }

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
        if ($this->m_reference_table->delete($this->_table_name, $where))
        {
            //check to see if an rfp exception needs to be created
            if ($this->rfp_lib->is_product_exception($where['Product_Idn']))
            {
                $misc_detail_idn = $this->m_product_assembly->get_miscellaneous_detail_idn($data['ProductAssembly_Idn']);
                $this->m_rfp_exception->delete("MiscellaneousDetail_Idn", $misc_detail_idn);
            }
            return true;
        } 
        else 
        {
            return false;
        }
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