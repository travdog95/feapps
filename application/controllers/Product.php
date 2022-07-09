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
			->select("p.*, d.Description AS Department, wm.Name as WorksheetMaster, wc.Name as WorksheetCategory, m.Name as Manufacturer")
			->from('Products AS p')
			->join('jpr_Department AS d', 'd.DepartmentID = p.Department_Idn', 'left')
			->join('WorksheetMasters AS wm', 'wm.WorksheetMaster_Idn = p.WorksheetMaster_Idn', 'left')
			->join('WorksheetCategories AS wc', 'wc.WorksheetCategory_Idn = p.WorksheetCategory_Idn', 'left')
			->join('Manufacturers AS m', 'm.Manufacturer_Idn = p.Manufacturer_Idn', 'left')
			->order_by('WorksheetMaster_Idn ASC, WorksheetCategory_Idn ASC');

		if (!isset($get['active_only']) || $get['active_only'] == 1)
		{
			$this->db->where("p.ActiveFlag", 1);
		}

		$query = $this->db->get();

		if ($query) 
		{
			foreach ($query->result_array() as $row) 
			{

				$row['id'] = $i++;
				$row['IsParent'] = $row['IsParent'] == 1 ? "Yes" : "No";
				$row['ActiveFlag'] = $row['ActiveFlag'] == 1 ? "Yes" : "No";

				$results['data'][] = $row;
			}
		}

        if ($json) 
		{
            echo json_encode($results);
        } 
		else 
		{
            return $results;
        }
	}

	public function detail($mode, $product_idn = 0)
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
			'product_idn' => $product_idn,
			'mode' => $mode,
			'button_text' => $mode == "edit" ? "Save" : "Add",
		);
			
		//Load menus
		$data['menus'] = $this->m_menu->get_menus();

		//Load Product
		$data['product'] = $this->m_product->get_product($product_idn);

		if ($mode == "edit") 
		{
			//Load sub header
			$data['sub_header'] = "ID: ".$product_idn." - ".$data['product']['Name'];
		}

		if ($mode == "copy")
		{
			$data['product']['Product_Idn'] = "";
		}

        //Load job search view
		$this->load->view('product/detail', $data);
	}

	public function assembly($product_idn)
	{
		//Decare and initialize variables
		$data = array(
			'menus' => array(),
			'active_page' => 'Product Assembly',
			'bread_crumbs' => array(
				array(
					'name' => 'Product Assembly',
					'link' => ''
				)
			),
			'product_idn' => $product_idn
		);
			
		//Load menus
		$data['menus'] = $this->m_menu->get_menus();

		//Load Product
		$data['product'] = $this->m_product->get_product($product_idn);

		$search_criteria = array(
			"IDorName" => "",
			"WorksheetMaster_Idn" => $data['product']['WorksheetMaster_Idn'],
			"WorksheetCategory_Idn" => $data['product']['WorksheetCategory_Idn'],
		);

		$data['search_results'] = $this->m_product->get_search_results(
			$data['product']['Product_Idn'], 
			$data['product']['Children'],	
			$search_criteria
		);

		if (empty($data['product']))
		{
			$this->index();
		}
		else
		{
			//Load sub header
			// $data['sub_header'] = "ID: ".$product_idn." - ".$data['product']['Name'];
			
			//Load job search view
			$this->load->view('product/assembly', $data);
		}
	}

	public function save_product() 
	{
		$save_results = array(
			"return_code" => 0,
			"echo" => array(),
			"mode" => ""
		);
		$set = array();
		$where = array();

		$post = $this->input->post();

		if ($post)
		{
			$save_results['mode'] = $post['Mode'];
			
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

			if ($post['Mode'] == "edit")
			{
				$where = array("Product_Idn" => $post['Product_Idn']);
				$save = $this->m_reference_table->update("Products", $set, $where);
			}
			else
			{
				$save = $this->m_reference_table->insert("Products", $set);
				$save_results['NewProduct_Idn'] = $this->db->insert_id();
			}

			$save_results['echo'] = $save;
			$save_results['return_code'] = 1;
		}

		echo json_encode($save_results);
	}

	public function delete_children() 
	{
		$save_results = array(
			"return_code" => 0,
			"echo" => array(),
			"deleted" => array(),
		);
		$set = array();
		$where = array();
		$hasErrors = false;
		$html = "";

		$post = $this->input->post();

		if ($post)
		{
			$where['Parent_Idn'] = $post['Parent_Idn'];
			foreach($post['Child_Idn'] as $child_idn)
			{
				$html = "";
				$where['Child_Idn'] = $child_idn;
				if (!$this->m_reference_table->delete("ProductRelationships", $where))
				{
					$hasErrors = true;
				}
				else
				{
					$product = $this->m_product->get_product($child_idn, false, false);
					$html = $this->load->view("product/product_search_results_row", array("search_result" => $product), true);
					$save_results['deleted'][] = array("Product_Idn" => $child_idn, "Html" => $html);
				}
			}

			$save_results['return_code'] = ($hasErrors) ? -1 : 1;
		}

		echo json_encode($save_results);
	}

	public function add_children() 
	{
		$save_results = array(
			"return_code" => 0,
			"echo" => array(),
			"added" => array(),
		);
		$set = array();
		$insert = array();
		$hasErrors = false;
		$html = "";

		$post = $this->input->post();

		if ($post)
		{
			$insert['Parent_Idn'] = $post['Parent_Idn'];
			foreach($post['Child_Idn'] as $child_idn)
			{
				$html = "";
				$insert['Child_Idn'] = $child_idn;
				if (!$this->m_reference_table->insert("ProductRelationships", $insert))
				{
					$hasErrors = true;
				}
				else
				{
					$child = $this->m_product->get_product($child_idn, false, false);
					$html = $this->load->view("product/product_child_row", array("child" => $child), true);
					$save_results['added'][] = array("Product_Idn" => $child_idn, "Html" => $html);
				}
			}

			$save_results['return_code'] = ($hasErrors) ? -1 : 1;
		}

		echo json_encode($save_results);
	}

}
/* End of file */
/* Location: ./application/controllers/Product.php */