<?php
class M_product_relationship extends CI_Model {
	
	private $_table_name = 'ProductRelationships';

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_reference_table');
    }

   /**
    * get_product_idns
    *
    * @access   public
    * @param    $worksheet_idn(integer)
    * @return   array
    */
    
    function get_children($parent_idn)
    {
        //Delcare and initialize variables
        $query = false;
        $children = array();
        $child_product_idns = array();
        $where = array();

        if ($parent_idn > 0)
        {
            $where = array(
                "Parent_Idn" => $parent_idn,
            );
            $children = $this->m_reference_table->get_where($this->_table_name, $where);
            
            foreach ($children as $child)
            {
                $child_product_idns[] = $child['Child_Idn'];
            }
        }
            
        return $child_product_idns;
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