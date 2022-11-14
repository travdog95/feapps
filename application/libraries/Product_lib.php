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

    /*
	 * Summary of get_product
     * 
     * Get product from Products table by Product_Idn, including foreign key id/name values
     * 
	 * @param mixed $product_idn
	 * @return array
	 */
	public function get_product($product_idn, $get_children = true, $get_dropdown_data = true)
	{
        $product = array();
        $products = array();
        $metadata = array();
        $dropdown_data = array();

        if (isset($product_idn) && $product_idn > 0)
        {

        $products = $this->CI->m_reference_table->get_where('Products', array('Product_Idn' => $product_idn));
            
            if (!empty($products)) 
            {
                $product = $products[0];
            }
        }
        else 
        {
            $product = $this->CI->m_product->set_defaults();
        }

        if (!empty($product))
        {
            if ($get_dropdown_data)
            {
                $dropdown_data = $this->CI->m_product->get_dropdown_data($product);
            }

            if ($get_children)
            {
                $product['Children'] = $this->get_children($product_idn);
            }

            $metadata = $this->CI->m_product->get_metadata($product);
        }

        return array_merge($product, $metadata, $dropdown_data);

    }

    public function update_is_parent($product_idn)
    {
        $parent_updated = false;
        $set = array();
        $where = array();

        if ($product_idn > 0)
        {
            //Check to see if product has children
            $child_idns = $this->get_child_idns($product_idn);

            //Update flag accordingly
            $set['IsParent'] = (sizeof($child_idns) === 0) ? 0 : 1;

            $where = array(
                "Product_Idn" => $product_idn,
            );

            $parent_updated = $this->CI->m_product->update($set, $where);
        }

        return $parent_updated;
    }

    /** Calculate and update assembly prices */
    public function calculate_and_update_assembly_prices($assembly_idn)
    {
        $children = array();
        $material_unit_price = 0;
        $field_unit_price = 0;
        $set = array();
        $where = array();

        if ($assembly_idn > 0)
        {
            //Check to see if product has children
            $children = $this->get_assembly_children($assembly_idn);

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

    public function calculate_assembly_prices($assembly_idn, $recursive = true)
    {
        $children = array();
        $material_unit_price = 0;
        $field_unit_price = 0;
        $prices = array();

        if ($assembly_idn > 0)
        {
            //Check to see if product has children
            $children = $this->get_children($assembly_idn);

            //Calculate prices
            foreach ($children as $child)
            {
                //if child is parent, get children
                if ($recursive && $this->is_parent($child['Product_Idn']))
                {
                    //Call recursively
                    $child_parent_prices = $this->calculate_assembly_prices($child['Product_Idn']);

                    $material_unit_price += $child['Quantity'] * $child_parent_prices['MaterialUnitPrice'];
                    $field_unit_price += $child['Quantity'] * $child_parent_prices['FieldUnitPrice'];
                } 
                else 
                {
                    $material_unit_price += $child['Quantity'] * $child['MaterialUnitPrice'];
                    $field_unit_price += $child['Quantity'] * $child['FieldUnitPrice'];
                }
            }

            $prices = array("MaterialUnitPrice" => $material_unit_price, "FieldUnitPrice" => $field_unit_price);
        }

        return $prices;
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

    /** Recursive method to find, calculate and update material and field unit prices for parent by child_idn  */
    public function find_and_update_prices_for_parents($child_idn)
    {
        $updated = false;
        $has_errors = false;

        if ($child_idn > 0) 
        {
            //Find parents
            $parents = $this->get_parents($child_idn);

            //iterate over parents to calculate and update prices
            foreach ($parents as $parent)
            {
                //Calculate and update prices
                if (!$this->calculate_and_update_assembly_prices($parent['Parent_Idn'])) 
                {
                    $has_errors = true;
                }

                //If parent is child
                if ($this->is_child($parent['Parent_Idn'])) {
                    if (!$this->find_and_update_prices_for_parents($parent['Parent_Idn']))
                    {
                        $has_errors = true;
                    }
                }
            }

            $updated = !$has_errors;
        }

        return $updated;
    }

    public function get_children($product_idn, $add_metadata = true)
    {
        $children = array();
        $product_relations = array();
        $child = array();

        $product_relations = $this->CI->m_reference_table->get_where('ProductRelationships', array('Parent_Idn' => $product_idn));

        foreach($product_relations as $product_relationship)
        {
            //Get child product
            $child = $this->CI->m_reference_table->get_where('Products', array('Product_Idn' => $product_relationship['Child_Idn']))[0];

            $child['Quantity'] = $product_relationship['Quantity'];
            
            if ($add_metadata)
            {
                //Add metadata
                $metadata = $this->CI->m_product->get_metadata($child);

                //Merge product with metadata and add to children array
                $children[] = array_merge($child, $metadata);
            }
        }

        return $children;
    }

    public function get_assembly_children($parent_idn)
    {

        $children = array();

        $this->CI->db->select('pr.Parent_Idn, pr.Child_Idn, pr.Quantity, p.MaterialUnitPrice, p.FieldUnitPrice, p.ShopUnitPrice, p.EngineerUnitPrice')
            ->from('Products AS p')
            ->join('ProductRelationships AS pr', 'p.Product_Idn = pr.Child_Idn')
            ->where(array('pr.Parent_Idn'=>$parent_idn));

        $query = $this->CI->db->get();

        if($query->num_rows() > 0)
        {
            $children = $query->result_array();
        }

        return $children;
    }

    function get_all_parent_idns()
    {
        $parent_idns = array();

        $this->CI->db
            ->select("Product_Idn")
            ->from("Products")
            ->where(array("IsParent" => true));

        $query = $this->CI->db->get();

        //If any records were returned, load into rows array
        if ($query->num_rows() > 0)
        {
            foreach ($query->result_array() as $row)
            {
                $parent_idns[] = $row['Product_Idn'];
            }
        }

        return $parent_idns;
    }

    function get_all_product_relationship_parent_idns()
    {
        $parent_idns = array();

        $this->CI->db
            ->distinct()
            ->select("Parent_Idn")
            ->from("ProductRelationships");

        $query = $this->CI->db->get();

        //If any records were returned, load into rows array
        if ($query->num_rows() > 0)
        {
            foreach ($query->result_array() as $row)
            {
                $parent_idns[] = $row['Parent_Idn'];
            }
        }

        return $parent_idns;
    }

    public function get_search_results($parent_idn, $children, $search_criteria, $add_metadata = true)
    {
        $results = array();
        $products = array();
        $where = array("ActiveFlag" => 1, "Product_Idn <>" => $parent_idn);
        $metadata = array();
        $children_idns = array();

        //Put children_idns into array, so we can exlcude children from the search results
        foreach($children as $child)
        {
            $children_idns[] = $child['Product_Idn'];
        }

        $this->CI->db
            ->select('p.*')
            ->from("Products AS p")
            ->join("Manufacturers AS m", "p.Manufacturer_Idn = m.Manufacturer_Idn", "left")
            ->or_like("p.Name", $search_criteria)
            ->or_like("Product_Idn", $search_criteria)
            ->or_like("m.Name ", $search_criteria);
    
        $query = $this->CI->db->get();
            
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->CI->db->last_query(), "Script" => get_caller_info()));
        }
        else
        {
            if ($query->num_rows() > 0)
            {
                foreach ($query->result_array() as $row)
                {
                    if (!in_array($row['Product_Idn'], $children_idns))
                    {
                        $products[] = $row;
                    }
                }
            }
        }

        //Add metadata
        if ($add_metadata)
        {
            foreach($products as $product)
            {
                $metadata = $this->CI->m_product->get_metadata($product);
                $results[] = array_merge($product, $metadata);
            }
        }

        return $results;
    }

       /**
    * get_child_idns
    *
    * @access   public
    * @param    $parent_idn(integer)
    * @return   array
    */
    
    function get_child_idns($parent_idn)
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
            $children = $this->CI->m_reference_table->get_where("ProductRelationships", $where);
            
            foreach ($children as $child)
            {
                $child_product_idns[] = $child['Child_Idn'];
            }
        }
            
        return $child_product_idns;
    }

    function is_parent($product_idn)
    {
        $is_parent = false;

        if ($product_idn > 0)
        {
            $where = array(
                "Parent_Idn" => $product_idn
            );

            $parent_idns = $this->CI->m_reference_table->get_where("ProductRelationships", $where);

            if (sizeof($parent_idns) > 0)
            {
                $is_parent = true;
            }
        }

        return $is_parent;
    }
}
