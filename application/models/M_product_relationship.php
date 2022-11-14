<?php
class M_product_relationship extends CI_Model {
	
	private $_table_name = 'ProductRelationships';

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_reference_table');
    }

    /**
     * get_schema
     */

    function get_schema()
    {
        return array(
            "Parent_Idn" => array(
                "dataType" => "integer",
                "default" => 0
            ),
            "Child_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "Quantity" => array(
                "dataType" => "float", 
                "default" => 1
            )
        );
    }

   /**
    * insert record into table
    *
    * @access   public
    * @param    $worksheet_idn(integer)
    * @return   boolean
    */
    
    function insert($data)
    {
        return $this->db->insert($this->_table_name, $data);
    }

    /**
     * Summary of delete
     * @param mixed $where 
     * @return bool
     */
    function delete($where)
    {
        return $this->db->delete($this->_table_name, $where);
    }

    function update($set, $where)
    {
        return $this->m_reference_table->update($this->_table_name, $set, $where);
    }

    function delete_by_worksheet($worksheet_idn)
    {
        $status = true;
        $product_idns = array();
        $where = array();

        if ($worksheet_idn > 0)
        {
            $product_idns = $this->get_product_idns($worksheet_idn);

            foreach($product_idns as $product_idn)
            {
                $where = array(
                    "Worksheet_Idn" => $worksheet_idn,
                    "Product_Idn" => $product_idn,
                );
                
                if (!$this->delete($where))
                {
                    $status = false;
                }
            }
        }

        return $status;
    }

}