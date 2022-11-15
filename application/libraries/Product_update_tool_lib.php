<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
* ProductUpdateTool_lib Class
*
* @author   TKO Consulting, LLC
*/
class Product_update_tool_lib
{
    //Public members
    //Private members
    private $CI;
    private $_differences = array("MaterialUnitPrice", "FieldUnitPrice", "ShopUnitPrice","Name","FECI_Id","ManufacturerPart_Id","RFP");

    public function __construct()
    {
        //Set Code Igniter object
        $this->CI =& get_instance();

        //Load models
        $this->CI->load->model('m_product');
        $this->CI->load->model('m_reference_table');

        //Load libraries
        $this->CI->load->library('product_lib');
    }

    public function has_differences($staging_product)
    {
        $has_differences = false;

        if ($staging_product)
        {
            $product = $this->CI->product_lib->get_product($staging_product['Product_Idn'], false, false);

            foreach ($this->_differences as $diff)
            {
                if ($product[$diff] != $staging_product[$diff])
                {
                    return true;
                }
            }
        }

        return $has_differences;
    }
}
