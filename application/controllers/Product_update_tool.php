<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Update_Tool extends CI_Controller {

	function __construct()
	{
		//Includes parent class constructor
		parent::__construct();

		//Check authentication
    check_auth();

		//Load reference table model
		$this->load->model('m_reference_table');
		$this->load->model('m_menu');
		$this->load->library("product_lib");
		$this->load->library("product_update_tool_lib");

		require_once APPPATH . 'third_party/ssp.class.php';

	}

    /**
     * Summary of index
     */
    public function index()
	{
		//Decare and initialize variables
		$data = array(
			'menus' => array(),
			'active_page' => 'Product Update Tool',
			'bread_crumbs' => array(
				array(
					'name' => 'Product Update Tool',
					'link' => ''
				)
			)
		);

		//Load additional models

		//Load menus
		$data['menus'] = $this->m_menu->get_menus();

		$data['price_updatedatetime'] = get_latest_price_update("datetime", "M j, Y g:i:s A");

        //Load job search view
		$this->load->view('product_update_tool/index', $data);
	}

	function save_staging_data($data = array())
	{
        $results = array(
            "status" => 0,
            "inserts" => 0,
            "errors" => 0,
            "error_ids" => array()
        );
		$product = array();
		$staging_product = array();

		if ($this->input->post())
		{
			$data = $this->input->post();
		}

		if (!empty($data))
		{
			//Delete all records in ProductStaging table
			if ($this->db->empty_table("ProductsStaging2"))
			{
				$results['status'] = 1;

				//Insert rows into table
				foreach (json_decode($data['json']) as $row)
				{
					if (!empty($row->ID))
					{
						$staging_product = array(
							"Product_Idn" => string_filter($row->ID, ","),	
							"MaterialUnitPrice" => $row->Material == "" ? "0" : string_filter($row->Material, ","),	
							"ShopUnitPrice" => $row->Shop == "" ? "0" : string_filter($row->Shop, ","),	
							"FieldUnitPrice" => $row->Field == "" ? "0" : string_filter($row->Field, ","),	
							"EngineerUnitPrice" => $row->Engineer == "" ? "0" : string_filter($row->Engineer, ","),	
							"Name" => $row->Name,	
							"Description" => $row->Description,
							"Rank" => $row->Rank,
							"FECI_Id" => $row->FECI_Id,
							//"Manufacturer_Idn" => $row->Manufacturer_Idn,
							"ManufacturerPart_Id" => $row->ManufacturerPart_Id,
							"DomesticFlag" => $row->Domestic == "Yes" || $row->Domestic == 1 ? 1 : 0,
							"RFP" => $row->RFP == "Yes" || $row->RFP == 1 ? 1 : 0,
							"ActiveFlag" => $row->Active == "Yes" || $row->Active == 1 ? 1 : 0
						);

						if ($this->product_update_tool_lib->has_differences($staging_product))
						{

							//insert row
							if ($this->m_reference_table->insert("ProductsStaging2", $staging_product))
							{
								$results['inserts']++;
							}
							else
							{
								$results['errors']++;
								$results['error_ids'][] = $row->Product_Idn;
							}
						}
					}
				}
			}
		}

		echo json_encode($results);
	}

	function get_product_staging()
	{
		$results = array(
			"data" 				=> array(),
			"recordsTotal" 		=> 0,
			"recordsFiltered" 	=> 0,
			"draw" 				=> 0,
			"request"			=> $this->input->post(),
		);
		$row_values = array();

		$post = $this->input->post();

		$columns = array(
            array(
                "db" => "s.Product_Idn",
                "dt" => 0,
				"searchable" => true
            ),
            array(
                "db" => "s.MaterialUnitPrice",
                "dt" => 1,
            ),
            array(
                "db" => "s.FieldUnitPrice",
                "dt" => 2,
            ),
            array(
                "db" => "s.ShopUnitPrice",
                "dt" => 3,
            ),
            array(
                "db" => "s.EngineerUnitPrice",
                "dt" => 4,
            ),
			array(
                "db" => "s.Name",
                "dt" => 5,
				"searchable" => true
            ),
			array(
                "db" => "s.Description",
                "dt" => 6,
            ),
			array(
                "db" => "s.Rank",
                "dt" => 7,
            ),
            array(
                "db" => "s.FECI_Id",
                "dt" => 8,
				"searchable" => true
            ),
            array(
                "db" => "s.ManufacturerPart_Id",
                "dt" => 9,
				"searchable" => true
            ),
            array(
                "db" => "s.RFP",
                "dt" => 10,
				"searchable" => true
            ),
            array(
                "db" => "w.Name",
                "dt" => 11,
				"searchable" => true
            ),
            array(
                "db" => "c.Name",
                "dt" => 12,
				"searchable" => true
            ),
            array(
                "db" => "d.Description",
                "dt" => 13,
				"searchable" => true
            ),
        );

		$select = "
			s.Product_Idn,
			s.MaterialUnitPrice,
			s.FieldUnitPrice,
			s.ShopUnitPrice,
			s.EngineerUnitPrice,
			s.Name,
			s.Description,
			s.Rank,
			s.FECI_Id,
			s.ManufacturerPart_Id,
			S.DomesticFlag,
			s.RFP,
			s.ActiveFlag,
			w.Name AS Worksheet,
			c.Name AS Category,
			d.Description AS Department,
			p.MaterialUnitPrice AS CurrentMaterialUnitPrice,
			p.FieldUnitPrice AS CurrentFieldUnitPrice,
			p.ShopUnitPrice AS CurrentShopUnitPrice,
			p.EngineerUnitPrice AS CurrentEngineerUnitPrice,
			p.Name AS CurrentName,
			p.Description AS CurrentDescription,
			p.Rank AS CurrentRank,
			p.FECI_Id AS CurrentFECI_Id,
			p.ManufacturerPart_Id AS CurrentManufacturerPart_Id,
			p.DomesticFlag AS CurrentDomestic,
			p.RFP AS CurrentRFP,
			p.ActiveFlag AS CurrentActive";
		$from = "ProductsStaging2 AS s";
		$joins = array( 
			array("Products AS p", "p.Product_Idn = s.Product_Idn", "left"),
			array("jpr_Department AS d", "p.Department_Idn = d.DepartmentId", "left"),
			array("WorksheetMasters AS w", "p.WorksheetMaster_Idn = w.WorksheetMaster_Idn", "left"),
			array("WorksheetCategories AS c", "p.WorksheetCategory_Idn = c.WorksheetCategory_Idn", "left"),
		);
		$order_by = SSP::order($post, $columns);

		$dtColumns = SSP::pluck( $columns, 'dt' );

		//Get all records
		$this->db
			->select($select)
			->from($from)
			->order_by($order_by);

		foreach ($joins as $join) 
		{
			$this->db->join($join[0], $join[1], $join[2]);
		}

		if (isset($post['search']) && $post['search']['value'] != '') 
		{
			$str = $post['search']['value'];

			for ( $i=0, $ien=count($post['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $post['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];

				if ( isset($column['searchable']) && $column['searchable'] == 'true' ) {
					$this->db->or_like($column['db'], $str);
				}
			}
		}

		$queryAllRows = $this->db->get();

		if ($queryAllRows == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
			$results['recordsTotal'] = $queryAllRows->num_rows();
			$results['recordsFiltered'] = $queryAllRows->num_rows();
		}

		//Get records to display
		$this->db
			->select($select)
			->from($from)
			->order_by($order_by);

		foreach ($joins as $join) 
		{
			$this->db->join($join[0], $join[1], $join[2]);
		}

		if (isset($post['search']) && $post['search']['value'] != '') 
		{
			$str = $post['search']['value'];

			for ( $i=0, $ien=count($post['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $post['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];

				if ( isset($column['searchable']) && $column['searchable'] == 'true' ) {
					$this->db->or_like($column['db'], $str);
				}
			}
		}

		if (isset($post['start']) && $post['length'] != -1) 
		{
			$this->db->limit(intval($post['length']), intval($post['start']));
		}

		$query = $this->db->get();

		if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
            if ($query->num_rows() > 0)
            {
				$results['draw'] = isset ( $post['draw'] ) ?
					intval( $post['draw'] + 1 ) :
					0;
				foreach ($query->result_array() as $row)
                {
					$rowValues = array();
					foreach($row as $field => $value)
					{
						$rowValues[] = $value;
					}
                    $results['data'][] = $rowValues;
                }
            }
		}

		echo json_encode($results) ;
	}

	/**
	 * Summary of update_products
	 */
    public function update_products()
    {
        $results = array(
            "status" => 0,
            "updates" => 0,
            "errors" => 0,
            "error_ids" => array(),
			"logs" => array()
            );
        $query = false;
		$price_changes = false;
		$log = array();
		$logs = array();

		$sql = "SELECT p.Product_Idn,
					s.MaterialUnitPrice,
					p.MaterialUnitPrice AS original_price,
					s.FieldUnitPrice,
					p.FieldUnitPrice AS original_field,
					s.ShopUnitPrice,
					p.ShopUnitPrice AS original_shop,
					s.EngineerUnitPrice,
					p.EngineerUnitPrice AS original_design,
					s.Name,
					p.Name AS original_name,
					s.Description,
					p.Description AS original_description,
					s.Rank,
					P.Rank AS original_rank,
					p.FECI_Id AS original_FECI_Id,
					s.FECI_Id,
					p.ManufacturerPart_Id AS original_ManufacturerPart_Id,
					s.ManufacturerPart_Id,
					s.DomesticFlag,
					p.DomesticFlag AS original_domestic,
					p.RFP AS original_RFP,
					s.RFP,
					s.ActiveFlag,
					p.ActiveFlag AS original_active,
					p.IsParent
				FROM ProductsStaging2 AS s
				LEFT JOIN Products AS p ON (p.Product_Idn = s.Product_Idn)
				WHERE p.MaterialUnitPrice <> s.MaterialUnitPrice
					OR p.FieldUnitPrice <> s.FieldUnitPrice
					OR p.ShopUnitPrice <> s.ShopUnitPrice
					OR p.EngineerUnitPrice <> s.EngineerUnitPrice
					OR p.Name <> s.Name
					OR p.Description <> s.Description
					OR p.Rank <> s.Rank
					OR p.FECI_Id <> s.FECI_Id
					OR (p.FECI_Id is null AND s.FECI_Id <> '')
					OR (s.FECI_Id is null AND p.FECI_Id <> '')
					OR p.ManufacturerPart_Id <> s.ManufacturerPart_Id
					OR (p.ManufacturerPart_Id is null AND s.ManufacturerPart_Id <> '')
					OR (s.ManufacturerPart_Id is null AND p.ManufacturerPart_Id <> '')
					OR p.DomesticFlag <> s.DomesticFlag
					OR p.RFP <> s.RFP
					OR (p.RFP is null AND s.RFP = 1)
					OR (s.RFP is null AND p.RFP = 1)
					OR p.ActiveFlag <> s.ActiveFlag
					OR (p.ActiveFlag is null AND s.ActiveFlag = 1)
					OR (s.ActiveFlag is null AND p.ActiveFlag = 1)";
		$query = $this->db->query($sql);

		if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
            if ($query->num_rows() > 0)
            {
                foreach ($query->result_array() as $row)
                {
					if ($row['IsParent'] == 0)
					{
						$set_data = array();
						$price_changes = false;
						$log = array(
							"Product_Idn" => $row['Product_Idn'],
							"Data" => array()
						);

						//Only update values that changes
						if ($row['MaterialUnitPrice'] != $row['original_price'])
						{
							$set_data['MaterialUnitPrice'] = $row['MaterialUnitPrice'];
							$price_changes = true;
						}

						if ($row['FieldUnitPrice'] != $row['original_field'])
						{
							$set_data['FieldUnitPrice'] = $row['FieldUnitPrice'];
							$price_changes = true;
						}

						if ($row['ShopUnitPrice'] != $row['original_shop'])
						{
							$set_data['ShopUnitPrice'] = $row['ShopUnitPrice'];
						}

						if ($row['EngineerUnitPrice'] != $row['original_design'])
						{
							$set_data['EngineerUnitPrice'] = $row['EngineerUnitPrice'];
						}

						if ($row['Name'] != $row['original_name'])
						{
							$set_data['Name'] = $row['Name'];
						}

						if ($row['Description'] != $row['original_description'])
						{
							$set_data['Description'] = $row['Description'];
						}

						if ($row['Rank'] != $row['original_rank'])
						{
							$set_data['Rank'] = $row['Rank'];
						}

						if ($row['FECI_Id'] != $row['original_FECI_Id'])
						{
							$set_data['FECI_Id'] = $row['FECI_Id'];
						}

						if ($row['ManufacturerPart_Id'] != $row['original_ManufacturerPart_Id'])
						{
							$set_data['ManufacturerPart_Id'] = $row['ManufacturerPart_Id'];
						}

						if ($row['DomesticFlag'] != $row['original_domestic'])
						{
							$set_data['DomesticFlag'] = $row['DomesticFlag'];
						}

						if ($row['RFP'] != $row['original_RFP'])
						{
							$set_data['RFP'] = $row['RFP'];
						}

						if ($row['ActiveFlag'] != $row['original_active'])
						{
							$set_data['ActiveFlag'] = $row['ActiveFlag'];
						}

						if (sizeof($set_data) > 0)
						{
							if ($this->db->update("Products", $set_data, array("Product_Idn" => $row['Product_Idn'])))
							{
								$results['updates']++;
								$log['Data'] = $set_data;
								$logs[] = $log;

								write_feci_log(array("Message" => json_encode($log), "Script" => "Product_update_tool->update_products()"));

		
								//If there was a change in material or field prices and the product is a child product
								if ($price_changes && $this->product_lib->is_child($row['Product_Idn'])) {
									//
									$this->product_lib->find_and_update_prices_for_parents($row['Product_Idn']);
								}
							}
							else
							{
								$results['errors']++;
								$results['error_ids'][] = $row['Product_Idn'];
							}
		
						}
					} 
                }
            }
		}

		$results['logs'] = $logs;

        echo json_encode($results);
    }

	public function delete_staging_records()
	{
		$results = array(
			"status" => 0,
			);
		$sql = "";

		//Delete records from ProductsStaging2
		$sql = "DELETE FROM ProductsStaging2";

		if ($this->db->query($sql))
		{
			$results['status'] = 1;
		}
		else
		{
			$results['status'] = -1;
		}

		echo json_encode($results);
	}

	public function update_price_datetime() {
		$results = array(
			"status" => 0,
			"update_datetime" => "",
			"formatted_update_datetime" => ""
		);

		$current_datetime = time();
		$insert = array(
			"User_Idn" => $this->session->userdata('user_idn'),
			"UpdateDateTime" => date("Y-m-d H:i:s", $current_datetime)
		);

		$results['status'] = ($this->m_reference_table->insert("PriceUpdates", $insert)) ? 1 : -1;
		$results['update_datetime'] = $insert['UpdateDateTime'];
		$results['formatted_update_datetime'] = date("M j, Y g:i:s A");

		echo json_encode($results);
	}
}
/* End of file job.php */
/* Location: ./application/controllers/job.php */