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
						$product = array(
							"Product_Idn" => string_filter($row->ID, ","),
							"MaterialUnitPrice" => $row->Material == "" ? "0" : string_filter($row->Material, ","),
							"ShopUnitPrice" => $row->Shop == "" ? "0" : string_filter($row->Shop, ","),
							"FieldUnitPrice" => $row->Field == "" ? "0" : string_filter($row->Field, ","),
							"EngineerUnitPrice" => $row->Engineer == "" ? "0" : string_filter($row->Engineer, ","),
							"Name" => $row->Name,
							"FECI_Id" => $row->FECI_Id,
							"ManufacturerPart_Id" => $row->ManufacturerPart_Id,
							"RFP" => $row->RFP == "Yes" || $row->RFP == 1 ? 1 : 0,
							);

						//insert row
						if ($this->m_reference_table->insert("ProductsStaging2", $product))
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

		echo json_encode($results);
	}

	function get_product_staging()
	{
		$results = array(
			"data" => array()
		);

		$this->db
			->select("s.Product_Idn,
				d.Description AS Department,
				w.Name AS Worksheet,
				c.Name AS Category,
				s.Name,
				p.Name as CurrentName,
				s.MaterialUnitPrice,
				p.MaterialUnitPrice AS CurrentMaterialUnitPrice,
				s.FieldUnitPrice,
				p.FieldUnitPrice AS CurrentFieldUnitPrice,
				s.ShopUnitPrice,
				p.ShopUnitPrice AS CurrentShopUnitPrice,
				s.EngineerUnitPrice,
				p.EngineerUnitPrice AS CurrentEngineerUnitPrice,
				p.FECI_Id AS CurrentFECI_Id,
				s.FECI_Id,
				p.ManufacturerPart_Id AS CurrentManufacturerPart_Id,
				s.ManufacturerPart_Id,
				p.RFP AS CurrentRFP,
				s.RFP")
			->from("ProductsStaging2 AS s")
			->join("Products AS p", "p.Product_Idn = s.Product_Idn", "left")
			->join("jpr_Department AS d", "p.Department_Idn = d.DepartmentId", "left")
			->join("WorksheetMasters AS w", "p.WorksheetMaster_Idn = w.WorksheetMaster_Idn", "left")
			->join("WorksheetCategories AS c", "p.WorksheetCategory_Idn = c.WorksheetCategory_Idn", "left");

		$query = $this->db->get();

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
                    $results['data'][] = $row;
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
            "error_ids" => array()
            );
        $query = false;

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
					p.FECI_Id AS original_FECI_Id,
					s.FECI_Id,
					p.ManufacturerPart_Id AS original_ManufacturerPart_Id,
					s.ManufacturerPart_Id,
					p.RFP AS original_RFP,
					s.RFP
				FROM ProductsStaging2 AS s
				LEFT JOIN Products AS p ON (p.Product_Idn = s.Product_Idn)
				WHERE p.MaterialUnitPrice <> s.MaterialUnitPrice
					OR p.FieldUnitPrice <> s.FieldUnitPrice
					OR p.ShopUnitPrice <> s.ShopUnitPrice
					OR p.EngineerUnitPrice <> s.EngineerUnitPrice
					OR p.Name <> s.Name
					OR p.FECI_Id <> s.FECI_Id
					OR p.ManufacturerPart_Id <> s.ManufacturerPart_Id
					OR p.RFP <> s.RFP";
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
                    $sql_set_array = array();

					//Only update values that changes
					if ($row['MaterialUnitPrice'] != $row['original_price'])
					{
						$sql_set_array[] = "MaterialUnitPrice = '{$row['MaterialUnitPrice']}'";
					}

					if ($row['FieldUnitPrice'] != $row['original_field'])
					{
						$sql_set_array[] = "FieldUnitPrice = '{$row['FieldUnitPrice']}'";
					}

					if ($row['ShopUnitPrice'] != $row['original_shop'])
					{
						$sql_set_array[] = "ShopUnitPrice = '{$row['ShopUnitPrice']}'";
					}

					if ($row['EngineerUnitPrice'] != $row['original_design'])
					{
						$sql_set_array[] = "EngineerUnitPrice = '{$row['EngineerUnitPrice']}'";
					}

					if ($row['Name'] != $row['original_name'])
					{
						$sql_set_array[] = "Name = '{$row['Name']}'";
					}

					if ($row['FECI_Id'] != $row['original_FECI_Id'])
					{
						$sql_set_array[] = "FECI_Id = '{$row['FECI_Id']}'";
					}

					if ($row['ManufacturerPart_Id'] != $row['original_ManufacturerPart_Id'])
					{
						$sql_set_array[] = "ManufacturerPart_Id = '{$row['ManufacturerPart_Id']}'";
					}

					if ($row['RFP'] != $row['original_RFP'])
					{
						$sql_set_array[] = "RFP = {$row['RFP']}";
					}

					$sql_set = implode(",", $sql_set_array);

					$sql = "UPDATE Products
							SET {$sql_set}
							WHERE Product_Idn = {$row['Product_Idn']}";

					if ($this->db->query($sql))
					{
						$results['updates']++;
					}
					else
					{
						$results['errors']++;
						$results['error_ids'][] = $row['Product_Idn'];
					}

                }
            }
		}

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