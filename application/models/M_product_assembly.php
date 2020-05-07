<?php
class M_product_assembly extends CI_Model {

	private $_table_name = 'ProductAssemblies';

    function __construct()
    {
        parent::__construct();
    }

	/**
	 * Summary of calculate_assembly_totals
	 * @param mixed $product_assembly_idn
	 * @return integer[]
	 */
	public function calculate_assembly_totals($product_assembly_idn = 0)
	{
		$totals = array(
			"Material" => 0,
			"Field" => 0,
			"Shop" => 0
			);

		if ($product_assembly_idn > 0)
		{
			$where = array(
                "ProductAssembly_Idn" => $product_assembly_idn
            );

			$this->db
				->select("*")
				->from("ProductAssemblyDetails")
				->where($where);

			$query = $this->db->get();

            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            }
			else
            {
			    //If any records were returned, load into rows array
			    if ($query->num_rows() > 0)
			    {
				    foreach ($query->result_array() as $row)
				    {
					    $totals['Material'] += $row['Quantity'] * $row['MaterialUnitPrice'];
					    $totals['Field'] += $row['Quantity'] * $row['FieldUnitPrice'];
					    $totals['Shop'] += $row['Quantity'] * $row['ShopUnitPrice'];
				    }
			    }
            }
		}
		
		return $totals;
	}
}