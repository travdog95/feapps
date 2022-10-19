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
        $this->CI->load->model('m_reference_table');
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

    public function calculate_assembly_prices($assembly_idn)
    {
        $children = array();
        $material_unit_price = 0;
        $field_unit_price = 0;
        $set = array();
        $where = array();

        if ($assembly_idn > 0)
        {
            //Check to see if product has children
            $children = $this->CI->m_product->get_assembly_children($assembly_idn);

            //Calculate prices
            foreach ($children as $child)
            {
                $material_unit_price += $child['Quantity'] * $child['MaterialUnitPrice'];
                $field_unit_price += $child['Quantity'] * $child['FieldUnitPrice'];
            }

            $set = array("MaterialUnitPrice" => $material_unit_price, "FieldUnitPrice" => $field_unit_price);
            $where = array("Product_Idn" => $assembly_idn);

            return $this->CI->m_product->update($set, $where);
        }

        return false;
    }

    public function is_child($product_idn) 
    {
        $child_instances = array();

        if ($product_idn > 0)
        {
            $child_instances = $this->CI->m_reference_table->get_where("ProductRelationships", array("Child_Idn" => $product_idn));

            if (sizeof($child_instances) > 0) 
            {
                return true;
            }
        }

        return false;
    }

    public function get_top_level_parents($child_idn)
    {
        $top_level_parents = array();
        $parents = array();

        if ($child_idn > 0)
        {
            $parents = $this->get_parents($child_idn);

            foreach($parents as $parent)
            {
                if ($this->is_child($parent["Parent_Idn"]))
                {
                    $top_level_parents = array_merge($this->get_top_level_parents($parent['Parent_Idn']), $top_level_parents);
                }
                else
                {
                    $top_level_parents[] = $parent['Parent_Idn'];
                }
            }
        }

        return $top_level_parents;

    }

    public function get_parents($child_idn)
    {
        $parents = array();

        if ($child_idn > 0)
        {
            $parents = $this->CI->m_reference_table->get_fields("ProductRelationships", "Parent_Idn", array("Child_Idn" => $child_idn));
        }

        return $parents;

    }
}
