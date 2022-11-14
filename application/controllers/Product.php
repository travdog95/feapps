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
		$this->load->model('m_product_relationship');

		$this->load->library("rfp_lib");
		$this->load->library("product_lib");
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
		$data['product'] = $this->product_lib->get_product($product_idn);

		if ($mode == "edit") 
		{
			$is_assembly_text = $data['product']['IsParent'] ? '<span class="em">Assembly</span> ' : "";
			//Load sub header
			$data['sub_header'] = $is_assembly_text."(".$product_idn.") ".$data['product']['Name'];
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
		$data['product'] = $this->product_lib->get_product($product_idn);

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

			$rfpIsSet = isset($post['RFP']);

			//If RFP was updated to unchecked
			if ($post['RFPSaved'] == 1 && !$rfpIsSet)
			{
				$this->rfp_lib->process_flow(array("Product_Idn" => $post['Product_Idn']), 1, 2);
			}

			if ($post['Mode'] == "edit")
			{
				$where = array("Product_Idn" => $post['Product_Idn']);
				$save = $this->m_reference_table->update("Products", $set, $where);

				if ($save && $this->product_lib->is_child($post['Product_Idn']))
				{
					//Find and update prices for parents
					$this->product_lib->find_and_update_prices_for_parents($post['Product_Idn']);
				}
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
			"deleted" => array(),
			"num_errors" => 0,
		);

		$set = array();
		$where = array();
		$html = "";

		$post = $this->input->post();

		if ($post)
		{
			$where['Parent_Idn'] = $post['Parent_Idn'];
			foreach($post['deleteChild_Idn'] as $child_idn)
			{
				$html = "";
				$where['Child_Idn'] = $child_idn;
				if (!$this->m_product_relationship->delete($where))
				{
					$save_results['num_errors']++;
				}
				else
				{
					$product = $this->product_lib->get_product($child_idn, false, false);
					$html = $this->load->view("product/product_search_results_row", array("search_result" => $product), true);
					$save_results['deleted'][] = array("Product_Idn" => $child_idn, "Html" => $html);
				}
			}

			if ($save_results['num_errors'] > 0)
			{
				$save_results['return_code'] = -1;
			}
			else
			{
				$save_results['return_code'] = 1;

				//Update is_parent flag on Product
				$this->product_lib->update_is_parent($where['Parent_Idn']);

				//Update parent prices
				if ($this->product_lib->calculate_and_update_assembly_prices($post['Parent_Idn']))
				{
					//if Parent is a child
					if ($this->product_lib->is_child($post['Parent_Idn']))
					{
						//Find and update prices for parents
						$this->product_lib->find_and_update_prices_for_parents($post['Parent_Idn']);
					}
				}
				else
				{
					$save_results['return_code'] = -1;
				}
			}
		}

		echo json_encode($save_results);
	}

	public function add_children() 
	{
		$save_results = array(
			"return_code" => 0,
			"echo" => array(),
			"added" => array(),
			"num_errors" => 0,
		);

		$set = array();
		$insert = array();
		$html = "";

		$post = $this->input->post();

		if ($post)
		{
			$insert['Parent_Idn'] = $post['Parent_Idn'];
			foreach($post['Child_Idn'] as $child_idn)
			{
				$html = "";
				$insert['Child_Idn'] = $child_idn;
				$insert['Quantity'] = 1;

				if ($this->m_product_relationship->insert($insert))
				{
					$child = $this->product_lib->get_product($child_idn, false, false);
					$child['Quantity'] = 1;
					$html = $this->load->view("product/product_child_row", array("child" => $child), true);
					$save_results['added'][] = array("Product_Idn" => $child_idn, "Html" => $html);
				}
				else
				{
					$save_results["num_errors"]++;
				}
			}

			if ($save_results['num_errors'] > 0)
			{
				$save_results['return_code'] = -1;
			}
			else
			{
				$save_results['return_code'] = 1;

				//Update is_parent flag on Product
				$this->product_lib->update_is_parent($post['Parent_Idn']);

				//Remove RFP flag
				$this->m_reference_table->update("Products", array("RFP" => 0), array("Product_Idn" => $post['Parent_Idn']));
			}

			//re-calculate assembly material unit and field prices
			$this->product_lib->calculate_and_update_assembly_prices($post['Parent_Idn']);

			//if Parent is a child
			if ($this->product_lib->is_child($post['Parent_Idn']))
			{
				//Find and update prices for parents
				$this->product_lib->find_and_update_prices_for_parents($post['Parent_Idn']);
			}
		}

		echo json_encode($save_results);
	}

	public function save_children() 
	{
		$save_results = array(
			"return_code" => 0,
			"echo" => array(),
			"updated" => array(),
		);
		$set = array();
		$update = array();
		$hasErrors = false;
		$parentSet = array();
		$where = array();

		$post = $this->input->post();
		
		if ($post)
		{
			//Iterate over child products to calculate quantity and price
			for($i = 0; $i < sizeof($post['Child_Idn']); $i++)
			{
				$update = array(
					'Child_Idn' => $post['Child_Idn'][$i],
					'Parent_Idn' => $post['Parent_Idn']
				);

				//Update the product relationship table
				$set['Quantity'] = $post['Quantity'][$i] == "" ? 0 : $post['Quantity'][$i];
				if (!$this->m_product_relationship->update($set, $update))
				{
					$hasErrors = true;
				}
			}
			
			//re-calculate assembly material unit and field prices
			if (!$this->product_lib->calculate_and_update_assembly_prices($post['Parent_Idn']))
			{
				$hasErrors = true;
			}

			//if Parent is a child
			if ($this->product_lib->is_child($post['Parent_Idn']))
			{
				//Find and update prices for parents
				if (!$this->product_lib->find_and_update_prices_for_parents($post['Parent_Idn']))
				{
					$hasErrors = true;
				}
			}
			
			$save_results['return_code'] = ($hasErrors) ? -1 : 1;
		}

		echo json_encode($save_results);
	}

	public function search()
	{
		$results = array(
			"return_code" => 0,
			"data" => array(),
		);

		$post = $this->input->post();
		
		if ($post)
		{
			$search_criteria = $post['searchInput'];
			$parent_idn = $post['Parent_Idn'];
			$parent = $this->product_lib->get_product($parent_idn, true, false);

			$search_results = $this->product_lib->get_search_results($parent_idn, $parent['Children'], $search_criteria);

			foreach($search_results as $product)
			{
				$html = $this->load->view("product/product_search_results_row", array("search_result" => $product), true);
				$results['data'][] = array("Product_Idn" => $product['Product_Idn'], "Html" => $html);
			}
			
			$results['return_code'] = 1;
		}

		echo json_encode($results);
	}

	public function calculate_parentPricing()
	{
		$ChildPricing = $this->db->query('SELECT pr.Child_Idn, p.MaterialUnitPrice, p.FieldUnitPrice, p.ShopUnitPrice, p.EngineerUnitPrice 
		FROM Products AS p
		JOIN ProductRelationships AS pr
			ON p.Product_Idn = pr.Child_Idn
		WHERE p.Product_Idn = pr.Child_Idn');

		$ChildQuantity = $this->db->query('SELECT Child_Idn, Quantity FROM ProductRelationships');

		$TotalChildPricing = $ChildPricing * $ChildQuantity;

		print_r($TotalChildPricing);
	}

}
/* End of file */
/* Location: ./application/controllers/Product.php */