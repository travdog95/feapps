<?php

function get_productPricing($product_Idn)
{
    $children = array();
    $product_relations = array();
    $child = array();

$product_relations = $this->m_reference_table->get_where('ProductRelationships', array('Parent_Idn' => $product_idn));

    foreach($product_relations as $product_relationship)
    {
        //Get child product
        $MaterialUnitPrice = $this->m_reference_table->get_where('Products', array('Product_Idn' => $product_relationship['Child_Idn']))[0];

        $child['Quantity']=$product_relationship['Quantity'];
        
        //Add metadata
        $metadata = $this->get_metadata($child);

        //Merge product with metadata and add to children array
        $children[] = array_merge($child, $metadata);
    }

    return $children;
}

?>

ALTER TABLE ProductRelationships ADD TotalMaterialUnitPrice NUMERIC(13,3)