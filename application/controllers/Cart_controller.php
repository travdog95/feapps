<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_controller extends CI_Controller {

	function __construct()
	{
		//Includes parent class constructor
		parent::__construct();

		//Check authentication
        check_auth();

		//Load models
		$this->load->model('m_worksheet');
		$this->load->model('m_worksheet_detail');
		$this->load->model('m_reference_table');
		$this->load->model('m_miscellaneous_detail');

        //Load libraries
        $this->load->library("worksheet");
	}

    /*
     * Method that returns search results in HTML through json
     *  {
     *      return_code: 0,
     *      message: "",
     *      body: "",
     *      sql: ""
     *  }
     */
    public function filter_cart($worksheet_category_idn)
	{
		//Declare and initialize variables
		$results = array(
			"return_code" => 0,
            "message" => "",
            "body" => "",
            "sql" => ""
		);
        $query = false;

        //Scrub post Data
        $post = $this->input->post(null, true);

        $worksheet_master_idn = (isset($post['WorksheetMaster_Idn'])) ? $post['WorksheetMaster_Idn'] : 0;

        //Load Libraries
        $this->load->library("cart_query_lib");

        //Get column info for cart results
        $columns = get_cart_columns($worksheet_category_idn);

        //Get query
        switch ($worksheet_category_idn)
        {
            case 29: //Miscellaneous
            case 54: //Defaults
            case 108:
                $query = $this->cart_query_lib->get_miscellaneous($worksheet_category_idn, $post);
                break;
            //Pipe
            case 89: //Sprinkler
            case 36: //Special Hazard
                $query = $this->cart_query_lib->get_pipe($worksheet_category_idn, $post);
                break;
            //Threaded Fittings
            case 90: //Sprinkler
            case 37: //Special Hazard
                $query = $this->cart_query_lib->get_threaded_fittings($worksheet_category_idn, $post);
                break;
            //Grooved Fittings
            case 97: //Sprinkler
            case 39: //Special Hazard
                $query = $this->cart_query_lib->get_grooved_fittings($worksheet_category_idn, $post);
                break;
            case 99: //other fittings
            case 98: //CPVC Fittings
                $query = $this->cart_query_lib->get_other_fittings($worksheet_category_idn, $post);
                break;
            case 91: //Hangers
                $query = $this->cart_query_lib->get_hangers($worksheet_category_idn, $post);
                break;
            case 92: //Heads
                $query = $this->cart_query_lib->get_heads($worksheet_category_idn, $post);
                break;
            case 96: //Riser Nipples
                $query = $this->cart_query_lib->get_riser_nipples($worksheet_category_idn, $post);
                break;
            case 118: //Valves
                $query = $this->cart_query_lib->get_valves($worksheet_category_idn, $post);
                break;
            case 100: //Lifts
                $query = $this->cart_query_lib->get_lifts($worksheet_category_idn, $post);
                break;
            case 106: //Riser
            case 109: //Manifold
                $query = $this->cart_query_lib->get_riser($worksheet_category_idn, $post);
                break;
            case 114: //Fire Pumps
                $query = $this->cart_query_lib->get_fire_pumps($worksheet_category_idn, $post);
                break;
            case 120: //Floor Control Assemblies
                $query = $this->cart_query_lib->get_fc_assemblies($worksheet_category_idn, $post);
                break;
            case 125: //UG Pipe
                $query = $this->cart_query_lib->get_ug_pipe($worksheet_category_idn, $post);
                break;
            case 126: //UG Fittings
                $query = $this->cart_query_lib->get_ug_fittings($worksheet_category_idn, $post);
                break;
            case 127: //Tapping Tees
                $query = $this->cart_query_lib->get_tapping_tees($worksheet_category_idn, $post);
                break;
            case 128: //UG Valves
                $query = $this->cart_query_lib->get_ug_valves($worksheet_category_idn, $post);
                break;
            case 141: //Products
                $query = $this->cart_query_lib->get_products($worksheet_category_idn, $post);
                break;
            default:
                $query = $this->cart_query_lib->default_query($worksheet_category_idn, $post);
                break;
        }

		//Tanks and Nozzles
		if ($worksheet_master_idn == 3)
		{
			$query = $this->cart_query_lib->get_tanks($worksheet_category_idn, $post);
		}

        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            $results['return_code'] = 3;
            $results['message'] = "Error getting products.";
        }
        else
        {
            //Filter products whree name is the same, and price is the cheapest
            //$compared_products = array();
            $filtered_products = array();

			//the compare_products function is broken...it's filtering too many of the products out.
			//$compared_products = compare_products($query->result_array());
            //$filtered_products = $compared_products['filtered_products'];

			$filtered_products = $query->result_array();

            foreach($filtered_products as $product)
            {
                $product['WorksheetCategory_Idn'] = $worksheet_category_idn;
                $product['IsAssembly'] = $post['IsAssembly'.$worksheet_category_idn];
                $product['WorksheetMaster_Idn'] = $worksheet_master_idn;
                $cart_results_row_data = array(
                    'product_row' => $product,
                    'columns' => $columns
                    );
                $results['body'] .= $this->load->view("job/shopping_cart/cart_results_row", $cart_results_row_data, true);
            }

            $s = ($query->num_rows() == 1) ? "" : "s";
            $results['message'] = $query->num_rows()." product{$s} found";
            $results['return_code'] = 1;
        }

        $results['sql'] = $this->db->last_query();

        echo json_encode($results);
    }

    /**
     * Saves products from shopping cart. Results are return in JSON format
     *  {
     *      inserts: "",
     *      updates: "",
     *      deletes: "",
     *      errors: "",
     *      misc: ""
     *  }
     */
    public function save_cart_products($worksheet_category_idn)
	{
        //Initialize and declare variables
		$results = array(
            "inserts" => array(),
            "updates" => array(),
            "deletes" => array(),
            "errors" => array(),
            "misc" => array (
                "Html" => "",
                "After" => "",
                "IsAssembly" => 0
            ),
            "message" => ""
		);

        $worksheet_idn = 0;
        $worksheet_master_idn = 0;
        $existing_product_idns = array();
        $all_products = array();
        $selected_products = array();
        $is_assembly = 0;
        $worksheet_master = array();
        $category_product_rank = "";
        $row = "";
        $job_number = "";

        //Post Data
        $post = $this->input->post(null, true);

        if (!empty($post))
        {
            $worksheet_idn = (isset($post['Worksheet_Idn'])) ? $post['Worksheet_Idn'] : "";
            $worksheet_master_idn = (isset($post['WorksheetMaster_Idn'])) ? $post['WorksheetMaster_Idn'] : "";

            $all_products = (isset($post['Quantities'])) ? $post['Quantities'] : array();
            $selected_products = (isset($post['Products'])) ? $post['Products'] : array();
            $is_assembly = (isset($post['IsAssembly'.$worksheet_category_idn])) ? $post['IsAssembly'.$worksheet_category_idn] : 0;
            $worksheet_master = array(
                "DisplayShopHours" => $post['DisplayShopHours'],
                "WorksheetMaster_Idn" => $post['WorksheetMaster_Idn']
                );

            $job_number = format_job_number($post['Job_Idn'], $post['ChangeOrder']);
        }

        //Insert assembly
        if ($is_assembly == 1)
        {
            //Get line num
            $line_num = $this->m_miscellaneous_detail->get_next_line_num($worksheet_idn, $worksheet_category_idn);

            //Create assembly and set $miscellaneous_item to true if successful
            if ($this->create_assembly($worksheet_category_idn, $post))
            {
                $html= "";
                $where = array();

                //Build where
                $where = array(
                    'Worksheet_Idn' => $worksheet_idn,
                    "wc.WorksheetMaster_Idn" => $worksheet_master_idn,
                    'wc.WorksheetCategory_Idn' => $worksheet_category_idn,
                    "LineNum" => $line_num);

                //Get data for view
                $product_data = $this->m_worksheet->get_miscellaneous_details_extended($worksheet_idn, $where);

                //Additional attributes
                //$product_data[$worksheet_category_idn][0]['DisplayShopHours'] = $post['DisplayShopHours'];
                $product_data[$worksheet_category_idn][0]['AddedFromShoppingCart'] = 1;

                //Get html for new row
                $html = $this->load->view("worksheet/worksheet_products", array("Row" => $product_data[$worksheet_category_idn][0], "worksheet_master" => $worksheet_master, "CategoryName" => ""), true);

                $results['misc'] = array(
                    "Html" => $html,
                    "After" => $line_num - 1,
                    "IsAssembly" => 1
                    );

                $results['message'] = "Assembly added.";
            }
            else
            {
                $results['errors'][] = array();
            }
        }

        //Insert miscellaneous product
        if (!empty($post['CartMiscellaneousProduct'.$worksheet_category_idn]))
        {
            //Get line num
            $line_num = $this->m_miscellaneous_detail->get_next_line_num($worksheet_idn, $worksheet_category_idn);

			$is_head = 0;
			$category_name = "";
			if (isset($post['IsHead'.$worksheet_category_idn]))
			{
				$is_head = 1;
				$category_name = $post['CategoryName'];
			}

            //Load data
            $insert_data = array(
                'Worksheet_Idn' => $worksheet_idn,
                'Quantity' => "1.0",
                'LineNum' => $line_num,
                'Name' => $post['CartMiscellaneousProduct'.$worksheet_category_idn],
                'WorksheetCategory_Idn' => $worksheet_category_idn,
                'WorksheetArea_Idn' => 0,
                'ProductAssembly_Idn' => 0,
                'IsHead' => $is_head,
                'WorksheetColumn_Idn' => 1
            );

            ////Insert record into database
            if ($this->m_reference_table->insert("MiscellaneousDetails", $insert_data))
            {
                $html= "";
                $where = array();

                //Build where
                $where = array(
                    'Worksheet_Idn' => $worksheet_idn,
                    "wc.WorksheetMaster_Idn" => $worksheet_master_idn,
                    'wc.WorksheetCategory_Idn' => $worksheet_category_idn,
                    "LineNum" => $line_num);

                //Get data for view
                $product_data = $this->m_worksheet->get_miscellaneous_details_extended($worksheet_idn, $where);

                //Additional attributes
                $product_data[$worksheet_category_idn][0]['AddedFromShoppingCart'] = 1;

                if ($post['IsSubcontractWorksheet'] == 1)
                {
                    //Get html for new row
                    $html = $this->load->view("worksheet/worksheet_subcontract_products", $product_data[$worksheet_category_idn][0], true);
                }
                else
                {
                    //Get html for new row
                    $html = $this->load->view("worksheet/worksheet_products", array("Row" => $product_data[$worksheet_category_idn][0], "worksheet_master" => $worksheet_master, "CategoryName" => $category_name), true);
                }

                $results['misc'] = array(
                    "Html" => $html,
                    "After" => $line_num - 1,
                    "IsAssembly" => 0
                    );

                $results['message'] = "Miscellaneous product added.";
            }
            else
            {
                $results['errors'][] = array();
            }
        }

        //If there are shopping cart results
        if (!empty($all_products) && $is_assembly == 0)
        {
            //Get Product_Idns from WorksheetDetails for worksheet category
            $existing_product_idns = $this->m_worksheet_detail->get_product_idns($worksheet_idn);

            ////If saving products from Products tab, set worksheet_category_idn = WorksheetCategory from cart
            //if ($worksheet_category_idn == 141)
            //{
            //    $worksheet_category_idn = (isset($post['WorksheetCategory'.$worksheet_category_idn])) ? $post['WorksheetCategory'.$worksheet_category_idn] : 0;
            //}

            //Iterate through all products from results
            foreach ($all_products as $product_idn => $qty)
            {
                //Format quantity fields
                $quantity = (is_numeric(string_filter($qty,','))) ? string_filter($qty,',') : 0;
                $original_quantity = (is_numeric(string_filter($post['OriginalQuantities'][$product_idn],','))) ? string_filter($post['OriginalQuantities'][$product_idn],',') : 0;

                //Get SH Engineering Worksheet_Idn if product is on Panels and Devices in the following Worksheet Categories: Panels (3), Devices (4,5,7,41), Power Supply (10)
                if ($worksheet_master_idn == 1 && in_array($worksheet_category_idn, array(3,4,5,41,7,10)))
                {
                    //Get engineering worksheet_idn
                    $eng_where = array(
                        "Job_Idn" => $post['Job_Idn'],
                        "ChangeOrder" => $post['ChangeOrder'],
                        "WorksheetMaster_Idn" => 7
                    );
                    $eng_worksheet_idn = $this->m_reference_table->get_field("Worksheets", "Worksheet_Idn", $eng_where);
                }
                
                //Check to see if product selected
                if (in_array($product_idn, $selected_products))
                {
                    if (in_array($product_idn, $existing_product_idns))
                    {
                        //If quantity changed, update quantity in database
                        if ($quantity != $original_quantity)
                        {
                            //Update quantity
                            if ($this->m_reference_table->update('WorksheetDetails', array('Quantity' => $quantity), array('Product_Idn' => $product_idn, 'Worksheet_Idn' => $worksheet_idn)))
                            {
                                //If panels and devices worksheet, update corresponding engineering details
                                if ($worksheet_master_idn == 1 && in_array($worksheet_category_idn, array(3,4,5,41,7,10)))
                                {
                                    $this->worksheet->save_sh_engineering_defaults($eng_worksheet_idn, $job_number);
                                }

                                $results['updates'][] = array("RowType" => "Product", "Product_Idn" => $product_idn, "Quantity" => $quantity);
                            }
                            else
                            {
                                $results['errors'][] = array("Product_Idn" => $product_idn, "Quantity" => $quantity);
                            }
                        }
                    }
                    else
                    {
                        //Get data from Products table
                        $product = $this->m_reference_table->get_where('Products', array('Product_Idn' => $product_idn));
                        $product = $product[0];

                        //Default to Low Sub is product does not have value
                        //$WorksheetColumn_Idn = ($product['SubcontractCategory_Idn'] == 0) ? 1 : $product['SubcontractCategory_Idn'];

                        //Load data
                        $insert_data = array(
                            'Worksheet_Idn' => $worksheet_idn,
                            'Product_Idn' => $product_idn,
                            'Quantity' => $quantity,
                            'MaterialUnitPrice' => $product['MaterialUnitPrice'],
                            'OriginalMaterialUnitPrice' => $product['MaterialUnitPrice'],
                            'FieldUnitPrice' => $product['FieldUnitPrice'],
                            'OriginalFieldUnitPrice' => $product['FieldUnitPrice'],
                            'ShopUnitPrice' => $product['ShopUnitPrice'],
                            'OriginalShopUnitPrice' => $product['ShopUnitPrice'],
                            'EngineerUnitPrice' => $product['EngineerUnitPrice'],
                            'OriginalEngineerUnitPrice' => $product['EngineerUnitPrice'],
                            'WorksheetColumn_Idn' => $product['SubcontractCategory_Idn']
                        );

                        //Insert record into database
                        if ($this->m_worksheet_detail->insert($insert_data))
                        {
                            $html= "";
                            $where = array();

                            //If panels and devices worksheet, update corresponding engineering details
                            if ($worksheet_master_idn == 1 && in_array($worksheet_category_idn, array(3,4,5,41,7,10)))
                            {
                                $this->worksheet->save_sh_engineering_defaults($eng_worksheet_idn, $job_number);
                            }

                            //Build where
                            $where = array(
                                'wd.Product_Idn' => $product_idn,
                                'wd.Worksheet_Idn' => $worksheet_idn,
                                'wm.WorksheetMaster_Idn' => $worksheet_master_idn
                                );

                            //Get data for view
                            $product_data = $this->m_worksheet->get_worksheet_details_extended($worksheet_idn, $worksheet_master_idn, array(), $where);
                            $row = $product_data[$worksheet_category_idn][0];

                            //Additional attributes
                            $row['AddedFromShoppingCart'] = 1;

                            $category_product_rank = $row['CategoryProductRank'];

                            if ($post['IsSubcontractWorksheet'] == 1)
                            {
                                //Get html for new row
                                $html = $this->load->view("worksheet/worksheet_subcontract_products", $row, true);
                            }
                            else
                            {
                                //Get html for new row
                                $html = $this->load->view("worksheet/worksheet_products", array("Row" => $row, "worksheet_master" => $worksheet_master, "CategoryName" => $row['CategoryName']), true);
                            }

                            $results['inserts'][] = array("Html" => $html, "CategoryProductRank" => $category_product_rank);
                        }
                        else
                        {
                            $results['errors'][] = array(array("Product_Idn" => $product_idn, "Quantity" => $quantity));
                        }
                    }
                }
                else
                {
                    //Delete product from database
                    if (in_array($product_idn, $existing_product_idns))
                    {
                        if ($this->m_reference_table->delete('WorksheetDetails', array('Product_Idn' => $product_idn, 'Worksheet_Idn' => $worksheet_idn)))
                        {
                            //If Panels and devices product, delete corresponding SH engineering records 
                            if ($worksheet_master_idn == 1 && in_array($worksheet_category_idn, array(3,4,5,41,7,10)))
                            {
                                $this->worksheet->delete_sh_eng_detail($eng_worksheet_idn, $job_number, $product_idn);
                            }

                            $results['deletes'][] = $product_idn;
                        }
                        else
                        {
                            $results['errors'][] = $product_idn;
                        }
                    }
                }
            }
        }

        echo json_encode($results);
    }

    /**
     * Summary of select_fittings_set
     * @param mixed $worksheet_category_idn
     */
    public function get_fittings_set($worksheet_category_idn)
    {
        //Declare and initialize variables
        $sets = array();
        $post = $this->input->post(null, true);
        $sizes = (isset($post['Size'])) ? $post['Size'] : array();
        $te_fittings = array(13,15);
        //$te_sizes = array(1,9);
        $fitting_sets = $this->m_reference_table->get_where("Fittings", "WorksheetCategory_Idn = {$worksheet_category_idn} AND PartOfSetFlag = 1 AND ActiveFlag = 1", "Rank ASC");

        foreach ($fitting_sets as $fitting_set)
        {
            if ($fitting_set['Fitting_Idn'] == 17 && $worksheet_category_idn == 90) //If R/C for threaded fittings
            {
                if ($sizes && in_array(2, $sizes) && !in_array($fitting_set['Fitting_Idn'], $sets)) //If 1" is selected
                {
                    $sets[] = $fitting_set['Fitting_Idn'];
                }
            }
            elseif (!in_array($fitting_set['Fitting_Idn'], $te_fittings) && $worksheet_category_idn == 90) //If E or T for threaded fittings
            {
                //if $sizes is set and any value besides 1 and 9 are in the sizes array, check the fitting type
                if ($sizes)
                {
                    foreach ($sizes as $size_id)
                    {
                        if ($size_id != 1 && $size_id != 9 && !in_array($fitting_set['Fitting_Idn'], $sets))
                        {
                            $sets[] = $fitting_set['Fitting_Idn'];
                        }
                    }
                }
                else
                {
                    if (!in_array($fitting_set['Fitting_Idn'], $sets)) $sets[] = $fitting_set['Fitting_Idn'];
                }
            }
            elseif ($fitting_set['Fitting_Idn'] == 48 && $worksheet_category_idn == 98) //If Head Adapter for CPVC fittings
            {
                if ($sizes	&& (in_array(2, $sizes) || in_array(9, $sizes)) && !in_array($fitting_set['Fitting_Idn'], $sets)) //If 3/4" or 1" is selected
                {
                    $sets[] = $fitting_set['Fitting_Idn'];
                }
            }
            else
            {
                if (!in_array($fitting_set['Fitting_Idn'], $sets)) $sets[] = $fitting_set['Fitting_Idn'];
            }
        }

        echo json_encode($sets);
    }

    /**
     * Summary of create_assembly
     * @param mixed $worksheet_category_idn
     * @param mixed $data
     * @return bool
     */
    public function create_assembly($worksheet_category_idn, $data)
    {
        //Declare and initialize variables
        $assembly = false;
        $worksheet_idn = (isset($data['Worksheet_Idn'])) ? $data['Worksheet_Idn'] : 0;
        $products = (isset($data['Products'])) ? $data['Products'] : array();

        if (!empty($products))
        {
            //Create assembly
            $new_assembly_idn = 0;
            $assembly_data = array(
                "Worksheet_Idn" => $worksheet_idn,
                "WorksheetCategory_Idn" => $worksheet_category_idn,
                "OriginalPrice" => $data['AssemblyPrice'.$worksheet_category_idn],
                "OriginalField" => $data['AssemblyFieldHours'.$worksheet_category_idn]
                );

            if ($this->m_reference_table->insert("ProductAssemblies", $assembly_data))
            {
                $new_assembly_idn = $this->db->insert_id();
                $assembly_detail_data = array();
                $product = array();

                //Create ProductAssemblyDetails records
                foreach ($products as $product_idn)
                {
                    //Get product data
                    $product = $this->m_reference_table->get_fields("Products", "Name, DomesticFlag, PipeType_Idn, ScheduleType_Idn, Fitting_Idn", array("Product_Idn" => $product_idn));

                    $assembly_detail_data = array(
                        "ProductAssembly_Idn" => $new_assembly_idn,
                        "Product_Idn" => $product_idn,
                        "Quantity" => 1,
                        "Name" => $product[0]['Name'],
                        "MaterialUnitPrice" => $data['MaterialUnitPrice'][$worksheet_category_idn.'-'.$product_idn],
                        "FieldUnitPrice" => $data['FieldUnitPrice'][$worksheet_category_idn.'-'.$product_idn],
                        "DomesticFlag" => $product[0]['DomesticFlag'],
                        "PipeType_Idn" => $product[0]['PipeType_Idn'],
                        "ScheduleType_Idn" => $product[0]['ScheduleType_Idn'],
                        "Fitting_Idn" => $product[0]['Fitting_Idn']
                        );

                    $this->m_reference_table->insert("ProductAssemblyDetails", $assembly_detail_data);
                }
            }

            //Create MiscellaneousDetail

            //Get next line id
            $next_line_num = $this->m_miscellaneous_detail->get_next_line_num($worksheet_idn, $worksheet_category_idn);

            //Load data for MiscellaneousDetails table
            $misc_data = array(
                'Worksheet_Idn' => $worksheet_idn,
                'Quantity' => "1.0",
                'LineNum' => $next_line_num,
                'Name' => $data['AssemblyName'.$worksheet_category_idn],
                'WorksheetCategory_Idn' => $worksheet_category_idn,
                'MaterialUnitPrice' => $data['AssemblyPrice'.$worksheet_category_idn],
                'FieldUnitPrice' => $data['AssemblyFieldHours'.$worksheet_category_idn],
                'WorksheetArea_Idn' => 0,
                'ProductAssembly_Idn' => $new_assembly_idn,
                'IsHead' => 0,
                'WorksheetColumn_Idn' => 0
            );

            //Insert record into database
            $assembly = $this->m_reference_table->insert("MiscellaneousDetails", $misc_data);
        }

        return $assembly;
    }

    /**
     * Summary of get_riser_fittings
     * @param mixed $worksheet_category_idn
     */
    public function get_riser_fittings($worksheet_category_idn)
    {
        //Declare and initialize variables
        $fittings = array();
        $results = array();
        $fitting_idns = ($worksheet_category_idn == 97) ? "26,27,29,30" : "13,14,15,16";

        $fittings = $this->m_reference_table->get_fields("Fittings", "Fitting_Idn, Name", "Fitting_Idn IN ({$fitting_idns})");

        foreach ($fittings as $fitting)
        {
            $results[] = array("name" => $fitting['Name'], "value" => $fitting['Fitting_Idn']);
        }

        echo json_encode($results);
    }

    /**
     * Summary of get_category_sorting_data
     */
    public function get_category_sorting_data()
    {
        echo json_encode(get_category_sorting_data());
    }
}
/* End of file worksheet_controller.php */
/* Location: ./application/controllers/job.php */