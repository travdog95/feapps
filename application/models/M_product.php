<?php
class M_product extends CI_Model {
	
	private $_table_name = 'Products';

    function __construct()
    {
        parent::__construct();

        $this->load->model("m_reference_table");
    }

    /*
	 * Summary of get_product
     * 
     * Get product from Products table by Product_Idn, including foreign key id/name values
     * 
	 * @param mixed $product_idn
	 * @return array
	 */
	public function get_product($product_idn)
	{
        $product = array();

        if (isset($product_idn) && $product_idn > 0)
        {
            $product = $this->m_reference_table->get_where('Products', array('Product_Idn' => $product_idn))[0];

            //Departments
            $product['Departments'] = $this->m_reference_table->get_fields('jpr_Department', "*", array());

            //WorksheetMasters
            $product['WorksheetMasters'] = $this->m_reference_table->get_idns_names("WorksheetMasters", "WorksheetMaster_Idn", array("Department_Idn" => $product['Department_Idn']), true, 'Name');

            //WorksheetCategories
            $product['WorksheetCategories'] = $this->m_reference_table->get_idns_names("v_WorksheetMasterCategories", "WorksheetCategory_Idn", array("WorksheetMaster_Idn" => $product['WorksheetMaster_Idn']), true, 'Name');

            //Manufacturers
            $product['Manufacturers'] = $this->m_reference_table->get_idns_names("Manufacturers", "Manufacturer_Idn", array(), true, 'Name');

            //Product Sizes
            $product['ProductSizes'] = $this->m_reference_table->get_idns_names("ProductSizes", "ProductSize_Idn", array(), true, 'Name');

            //Schedule Types
            $product['ScheduleTypes'] = $this->m_reference_table->get_idns_names("ScheduleTypes", "ScheduleType_Idn", array(), true, 'Name');

            //Pipe Types
            $product['PipeTypes'] = $this->m_reference_table->get_idns_names("PipeTypes", "PipeType_Idn", array(), true, 'Name');

            //Fittings
            $fittings_where = array(
                "Department_Idn" => $product['Department_Idn'],
                "WorksheetMaster_Idn" => $product['WorksheetMaster_Idn'],
                "WorksheetCategory_Idn" => $product['WorksheetCategory_Idn'],
            );
            $product['Fittings'] = $this->m_reference_table->get_idns_names("Fittings", "Fitting_Idn", $fittings_where, true, 'Name');

        }

        return $product;

    }
}