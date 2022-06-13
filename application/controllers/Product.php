<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	
	function __construct()
	{
		//Includes parent class constructor
		parent::__construct();

		//Check authentication
        check_auth();
		
		//Load reference table model
		$this->load->model('m_reference_table');
		$this->load->model('m_menu');
		$this->load->model('m_product');
	}

    /**
     * Summary of index
     */
    public function index()
	{
		//Decare and initialize variables
		$data = array(
			'menus' => array(),
			'active_page' => 'Product Maintenance',
			'bread_crumbs' => array(
				array(
					'name' => 'Product Maintenance',
					'link' => ''
				)
			)
		);
		
		//Load additional models
		
		//Load menus
		$data['menus'] = $this->m_menu->get_menus();

        //Load job search view
		$this->load->view('product/index', $data);
	}

	public function get_products()
	{
        $results = array(
            "data" => array()
            );
        $query = false;
        $data = array();
        $i = 1;
        $json = true;
        $get = $this->input->get();

		$this->db
			->select("p.*, d.Description AS DepartmentName, wm.Name as WorksheetMaster, wc.Name as WorksheetCategory, m.Name as Manufacturer")
			->from('Products AS p')
			->join('jpr_Department AS d', 'd.DepartmentID = p.Department_Idn', 'left')
			->join('WorksheetMasters AS wm', 'wm.WorksheetMaster_Idn = p.WorksheetMaster_Idn', 'left')
			->join('WorksheetCategories AS wc', 'wc.WorksheetCategory_Idn = p.WorksheetCategory_Idn', 'left')
			->join('Manufacturers AS m', 'm.Manufacturer_Idn = p.Manufacturer_Idn', 'left')
			->where("p.ActiveFlag", 1)
			->order_by('WorksheetMaster_Idn ASC, WorksheetCategory_Idn ASC');

		$query = $this->db->get();

		if ($query) {
			foreach ($query->result_array() as $row) {
				$data = array(
					'id' => $i++,
					'Product_Idn' => $row['Product_Idn'],
					'Department' => $row['DepartmentName'],
					'WorksheetMaster' => $row['WorksheetMaster'],
					'WorksheetCategory' => $row['WorksheetCategory'],
					'Name' => $row['Name'],
					'Manufacturer' => $row['Manufacturer'],
					'MaterialUnitPrice' => $row['MaterialUnitPrice'],
					'FieldUnitPrice' => $row['MaterialUnitPrice'],
					'ShopUnitPrice' => $row['ShopUnitPrice'],
					'EngineerUnitPrice' => $row['EngineerUnitPrice'],
					"FECI_Id" => $row['FECI_Id'],
					"ManufacturerPart_Id" => $row['ManufacturerPart_Id'],
					"IsParent" => $row['IsParent'] === 1 ? "Yes" : "No"
					);

				$results['data'][] = $data;
			}
		}

        if ($json) {
            echo json_encode($results);
        } else {
            return $results;
        }
	}

	public function detail($product_idn)
	{
		//Decare and initialize variables
		$data = array(
			'menus' => array(),
			'active_page' => 'Product Detail',
			'bread_crumbs' => array(
				array(
					'name' => 'Product Detail',
					'link' => ''
				)
			),
			'product_idn' => $product_idn
		);
			
		//Load menus
		$data['menus'] = $this->m_menu->get_menus();

		//Load Product
		$data['product'] = $this->m_product->get_product($product_idn);

		//Load sub header
		$data['sub_header'] = "ID: ".$product_idn." - ".$data['product']['Name'];
		
        //Load job search view
		$this->load->view('product/detail', $data);
	}

	public function save_product() {
		$save_results = array(
			"return_code" => 0,
			"echo" => array(),
		);
		$set = array();
		$where = array();

		$post = $this->input->post();

		if ($post && isset($post['Product_Idn']))
		{
			$where = array("Product_Idn" => $post['Product_Idn']);

			$schema = $this->m_product->get_schema();

			foreach ($schema as $field_name => $metadata)
			{
				//If post field matches schema field
				switch($metadata['dataType']) 
				{
					case "boolean":
						$set[$field_name] = isset($post[$field_name]) ? 1 : 0;
						break;
					case "integer":
						$set[$field_name] = isset($post[$field_name]) ? string_filter($post[$field_name], ",") : 0;
						break;

					case "float":
						$set[$field_name] = isset($post[$field_name]) ? string_filter($post[$field_name], ",") : 0;
						break;

					case "string":
						$set[$field_name] = isset($post[$field_name]) ? $post[$field_name] : "";
						break;

				}
			}

			$this->m_reference_table->update("Products", $set, $where);

			$save_results['echo'] = $set;
			$save_results['return_code'] = 1;
		}

		echo json_encode($save_results);
}
}
/* End of file */
/* Location: ./application/controllers/Product.php */