<?php
class M_worksheet_detail extends CI_Model {
	
	private $_table_name = 'WorksheetDetails';

    function __construct()
    {
        parent::__construct();
    }

   /**
    * get_product_idns
    *
    * @access   public
    * @param    $worksheet_idn(integer)
    * @return   array
    */
    
    function get_product_idns($worksheet_idn)
    {
        //Delcare and initialize variables
        $query = false;
        $product_ins = array();

        if ($worksheet_idn > 0)
        {
            $this->db->select('Product_Idn')
                ->from($this->_table_name)
                ->where('Worksheet_Idn', $worksheet_idn);
            
            $query = $this->db->get();
            
            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            }
            else
            {
                foreach ($query->result_array() as $row)
                {
                    $product_ins[] = $row['Product_Idn'];
                }
            }
        }
            
        return $product_ins;
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
        if ($this->db->insert($this->_table_name, $data))
        {
            return true;   
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));

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
        $delete = false;

        if (!empty($where))
        {
            if ($this->db->delete($this->_table_name, $where))
            {
                $delete = true;   
            }
            else
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));

                $delete = false;
            }
        }

        return $delete;
    }
}