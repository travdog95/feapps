<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
* Product_lib Class
*
* @author   TKO Consulting, LLC
*/
class Product_lib
{
    //Public members
    //Private members
    private $CI;

    public function __construct()
    {
        //Set Code Igniter object
        $this->CI =& get_instance();

        //Load models
        $this->CI->load->model('m_product');
        $this->CI->load->model('m_product_relationship');
    }

    public function update_is_parent($product_idn)
    {
        $parent_updated = false;
        $set = array();
        $where = array();

        if ($product_idn > 0)
        {
            //Check to see if product has children
            $children = $this->CI->m_product_relationship->get_children($product_idn);

            //Update flag accordingly
            $set['IsParent'] = (sizeof($children) === 0) ? 0 : 1;

            $where = array(
                "Product_Idn" => $product_idn,
            );

            $parent_updated = $this->CI->m_product->update($set, $where);
        }

        return $parent_updated;
    }
}
