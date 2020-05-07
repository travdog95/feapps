<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
if (!function_exists('some_function'))
{
	function some_function()
	{
		//Enables me to use the CI objects (replaces $this usage)
		$CI =& get_instance();
	}
}
*/

if (!function_exists('get_job_keys'))
{
	/*
	 * get_job_keys
	 *
	 * Function converts job numbers string (234-4 or 312) to Job_Idn and ChangeOrder
	 *
	 * @param ($job_number(string))
	 * @return ($job_keys(array))
	 */

	function get_job_keys($job_number)
	{
		//Delcare and initialize variables
		$needle = "";
		$pos = 0;
		$job_idn = 0;
		$change_order = 0;
		$job_keys = array(0,0);

		$needle = "-";
		$pos = strpos($job_number, $needle);
		if ($pos === false)
		{
			$job_keys = array(intval($job_number), 0);
		}
		else
		{
			$job_idn = intval(substr($job_number, 0, $pos));
			$change_order = substr($job_number, $pos + 1);

            //Convert to integer if not a new change order
            $change_order = ($change_order === "*") ? $change_order : intval($change_order);

			$job_keys = array($job_idn, $change_order);
		}

		return $job_keys;
	}
}

if (!function_exists('format_job_number'))
{

	/*
	 * format_job_number
	 *
	 * Function formats Job_Idn and ChangeOrder to job number string (234-4 or 312)
	 *
	 * @param ($job_idn(int), $change_order(int))
	 * @return ($job_number(string))
	 */

	function format_job_number($job_idn, $change_order = 0)
	{
		//Delcare and initialize variables
		$job_number = "";

		$job_number = (!empty($change_order)) ? $job_idn."-".$change_order : $job_idn;

		return $job_number;
	}
}

if ( ! function_exists('write_feci_log'))
{
	/*
	 * write_feci_log
	 *
	 * Writes data to log table, if function is passed a string, it's used as Message
	 * If function is passed array, array is used to write log record
	 *
	 * @param	$data(mixed) string or array
	 */

	function write_feci_log($data)
	{
		//Declare and initialize variables
		$log_data = array(
			'Message' => '',
			'CreateDateTime' => '',
			'UserName' => '',
			'Script' => ''
		);

		if (!empty($data))
		{
			if (is_array($data))
			{
				$log_data = $data;
			}
			else
			{
				$log_data['Message'] = $data;
			}

			//Delcare and initialize variables
			$CI =& get_instance();

			//Load log model
			$CI->load->model('m_feci_log');

			//Set CreateDateTime if not passed
			if (empty($log_data['CreateDateTime']))
			{
				$log_data['CreateDateTime'] = get_current_date(1);
			}

			//Set UserName if not passed
			if (empty($log_data['UserName']))
			{
				$log_data['UserName'] = $CI->session->userdata('user_name');
			}

			$CI->m_feci_log->insert($log_data);
		}
	}
}

if ( ! function_exists('check_auth'))
{
    function check_auth()
	{
		$CI =& get_instance();

		//If user has not authentication and is not an ajax request, send to authentication controller
		if ($CI->session->userdata('user_name') == "" && !$CI->input->is_ajax_request())
		{
			$CI->session->set_flashdata('message', 'Please sign in!');

			//Redirect to admin controller
			redirect('authentication');
		}
	}
}

if ( ! function_exists('get_cart_columns'))
{
    function get_cart_columns($worksheet_category_idn)
    {
        $columns = array(
            "titles" => array("&nbsp;", "Quantity", "Name", "Material", "Field", "Shop"),
            "names" => array("Product_Idn", "Quantity", "Name", "MaterialUnitPrice", "FieldUnitPrice", "ShopUnitPrice"),
            "widths" => array(5, 10, 40, 15, 15, 15)
            );

        switch($worksheet_category_idn)
        {
            case 89: //Pipe
                $columns = array(
                    "titles" => array("&nbsp;", "Quantity", "Name", "Type", "Grade", "Price", "Domestic"),
                    "names" => array("Product_Idn", "Quantity", "Name", "Type", "Grade", "MaterialUnitPrice", "Domestic"),
                    "widths" => array(5, 10, 40, 10, 10, 15, 10)
                    );
                break;
            case 90: //Threaded Fittings
            //case 97: //Grooved
                $columns = array(
                    "titles" => array("&nbsp;", "Quantity", "Name", "Type", "Fitting Type", "Price", "Domestic"),
                    "names" => array("Product_Idn", "Quantity", "Name", "Type", "FittingType", "MaterialUnitPrice", "Domestic"),
                    "widths" => array(5, 10, 40, 10, 15, 10, 10)
                    );
                break;
            case 99: //Other Fittings
            case 98: //CPVC Fittings
            case 97: //Grooved
                $columns = array(
                    "titles" => array("&nbsp;", "Quantity", "Name", "Type", "Price", "Domestic"),
                    "names" => array("Product_Idn", "Quantity", "Name", "Type", "MaterialUnitPrice", "Domestic"),
                    "widths" => array(5, 10, 50, 10, 15, 10)
                    );
                break;
            case 91: //Hangers
                $columns = array(
                    "titles" => array("&nbsp;", "Quantity", "Name", "Type", "Sub Type", "Price"),
                    "names" => array("Product_Idn", "Quantity", "Name", "Type", "SubType", "MaterialUnitPrice"),
                    "widths" => array(5, 10, 50, 10, 15, 10)
                    );
                break;
            case 92: //Heads
                $columns = array(
                    "titles" => array("&nbsp;", "Quantity", "Name", "Size", "Coverage", "Head", "Price", "Finish"),
                    "names" => array("Product_Idn", "Quantity", "Name", "Size", "CoverageType", "HeadType", "MaterialUnitPrice", "FinishType"),
                    "widths" => array(5, 10, 45, 8, 8, 8, 8, 8)
                    );
                break;
            case 100: //Lifts
                $columns = array(
                    "titles" => array("&nbsp;", "Quantity", "Name", "Material", "Duration"),
                    "names" => array("Product_Idn", "Quantity", "Name", "MaterialUnitPrice", "LiftDurationName"),
                    "widths" => array(5, 10, 55, 15, 15)
                    );
                break;
            case 106: //Risers
            case 109: //Manifolds
                $columns = array(
                    "titles" => array("&nbsp;", "Name", "Material", "Field", "Shop"),
                    "names" => array("Product_Idn", "Name", "MaterialUnitPrice", "FieldUnitPrice", "ShopUnitPrice"),
                    "widths" => array(5, 50, 15, 15, 15)
                    );
                break;
            case 118: //Valves
                $columns = array(
                    "titles" => array("&nbsp;", "Quantity", "Name", "Material", "Field", "Shop", "Domestic"),
                    "names" => array("Product_Idn", "Quantity", "Name", "MaterialUnitPrice", "FieldUnitPrice", "ShopUnitPrice", "Domestic"),
                    "widths" => array(5, 10, 40, 10, 15, 10, 10)
                    );
                break;
            case 96: //Riser Nipples
                $columns = array(
                    "titles" => array("&nbsp;", "Quantity", "Name", "Pipe", "Type", "Material", "Field", "Domestic"),
                    "names" => array("Product_Idn", "Quantity", "Name", "PipeTypeName", "Type", "MaterialUnitPrice", "FieldUnitPrice", "Domestic"),
                    "widths" => array(5, 10, 35, 10, 10, 10, 10, 10)
                    );
                break;
            case 114: //Fire Pumps
                $columns = array(
                    "titles" => array("&nbsp;", "Name", "Material", "Field", "Shop"),
                    "names" => array("Product_Idn", "Name", "MaterialUnitPrice", "FieldUnitPrice", "ShopUnitPrice"),
                    "widths" => array(5, 50, 15, 15, 15)
                    );
                break;
        }

        return $columns;
    }
}

/*
 * compare_products
 *
 *
 *
 * @param	$products(array) an array of products to compare
 * @return	multi-dimensional array - filtered products and removed products
 */
if ( ! function_exists('compare_products'))
{
    function compare_products($products)
    {
        $results = array();
        $filtered_products = array();
        $removed_products = array();
        $sorted_products = array();
        $temp = array();
        $matched_index = 0;

        $sorted_products = $products;

        //Sort $products array by price
        usort($sorted_products, function ($a, $b) {
            return $a['MaterialUnitPrice'] - $b['MaterialUnitPrice'];
        });

        foreach ($sorted_products as $index => $product)
        {
            //Resort array by price so the lowest prices are first
            $temp = $sorted_products;

            //Remove current product from temp
            unset($temp[$index]);

            $matched_index = multidimensional_search($temp,array('Name' => $product['Name']));

            //Match found
            if ($matched_index >= 0)
            {
                //Keep the product with the lower price by adding to filtered_products array
                if ($product['MaterialUnitPrice'] <= $sorted_products[$matched_index]['MaterialUnitPrice'])
                {
                    $product['Match'] = 1;
                    $filtered_products[] = $product;
                }
                else
                {
                    //Add matched more expensive product to removed_products array
                    //$removed_products[] = $product;
                    $product['Match'] = 0;
                    $removed_products[] = $product['Product_Idn'];
                }
            }
            else
            {
                //No match found
                $product['Match'] = 0;
                $filtered_products[] = $product;
            }
        }

        //If products are removed, iterate through $products array and remove them so that I can maintain original order of products
        if (sizeof($removed_products) > 0)
        {
            foreach ($products as $index => $product)
            {
                if(in_array($product['Product_Idn'], $removed_products))
                {
                    unset($products[$index]);
                }
            }
        }

        $results = array(
            'filtered_products' => $products,
            'removed_products' => $removed_products
        );

        return $results;
    }
}

if ( ! function_exists('multidimensional_search'))
{
    function multidimensional_search($parents, $searched)
    {
        if (empty($searched) || empty($parents))
        {
            return -1;
        }

        foreach ($parents as $key => $value)
        {
            $exists = true;
            foreach ($searched as $skey => $svalue)
            {
                //echo $parents[$key][$skey]." = ".$svalue." ".$key."<br />";
                $exists = ($exists && isset($parents[$key][$skey]) && $parents[$key][$skey] == $svalue);
            }

            if ($exists)
            {
                return $key;
            }
        }

        return -1;
    }
}

if ( ! function_exists('job_update'))
{
    function job_update($job_number)
    {
        //Declare and initialize variables
		$CI =& get_instance();
		$user_idn = $CI->session->userdata('user_idn');
        $job_keys = get_job_keys($job_number);
        $set = array(
            "UpdateDateTime" => format_date("", 1),
            "LastUpdatedBy_Idn" => $user_idn
            );
        $where = array(
            "Job_Idn" => $job_keys[0],
            "ChangeOrder" => $job_keys[1]
            );

        //Load models
		$CI->load->model('m_reference_table');

        //Save UpdateDateTime on Jobs table
        $CI->m_reference_table->update("Jobs", $set, $where);
    }
}

if (! function_exists('get_hanger_sizes'))
{
    function get_hanger_sizes($hanger_type, $sizes, $rod_sizes)
    {
        //Declare and Initialize Variables
		$CI =& get_instance();
    	$string = "";
        $sql_where = "";
        $hanger_sizes = array();
        $hanger_size_idns = array();
        $rod_size_idns = array();

        //Load models
		$CI->load->model('m_reference_table');

        if (!empty($sizes))
        {
            foreach ($sizes as $size)
            {
                switch ($size)
                {
                    case 0: // 1" <= 2"
                        $sql_where .= (empty($sql_where)) ? "" : " OR ";
                        $sql_where .= "Value BETWEEN 1 AND 2";
                        break;
                    case 1: //2 1/2" - 3";
                        $sql_where .= (empty($sql_where)) ? "" : " OR ";
                        $sql_where .= "Value BETWEEN 2.5 AND 3";
                        break;
                    case 2:
                        $sql_where .= (empty($sql_where)) ? "" : " OR ";
                        $sql_where .= "Value = 4";
                        break;
                    case 3:
                        $sql_where .= (empty($sql_where)) ? "" : " OR ";
                        $sql_where .= "Value = 6";
                        break;
                    case 4:
                        $sql_where .= (empty($sql_where)) ? "" : " OR ";
                        $sql_where .= "Value = 8";
                        break;
                }
            }

            //Get Hanger Size by value
            $hanger_sizes = $CI->m_reference_table->get_where("ProductSizes", $sql_where, "Rank ASC");

            //Load ProductSize_Idns into an array
            foreach ($hanger_sizes as $hanger_size)
            {
                $hanger_size_idns[] = $hanger_size['ProductSize_Idn'];
            }

            if (empty($addrod_sizes))
            {
                $hanger_type_string = ($hanger_type > 0) ? "AND p.HangerType_Idn = {$hanger_type}" : "AND p.HangerType_Idn <> 7";
                $string = "(p.ProductSize_Idn IN (0,".implode(",", $hanger_size_idns).") OR p.ProductSize_Idn IS NULL) {$hanger_type_string}";
            }
        }

        if (!empty($rod_sizes))
        {
            //Load ProductSize_Idns into an array
            foreach ($rod_sizes as $rod_size)
            {
                $rod_size_idns[] = $rod_size['ProductSize_Idn'];
            }

            if (empty($sizes))
            {
                $string = "(((p.ProductSize_Idn = 0 OR p.ProductSize_Idn IS NULL) AND p.HangerType_Idn = {$hanger_type}) OR (p.ProductSize_Idn IN (".implode(",", $rod_size_idns).") AND p.HangerType_Idn = 7))";
            }
            else
            {
                $string = "(((p.ProductSize_Idn IN (0,".implode(",", $hanger_size_idns).") OR p.ProductSize_Idn IS NULL) AND p.HangerType_Idn = {$hanger_type}) OR (p.ProductSize_Idn IN (".implode(",", $rod_sizes).") AND p.HangerType_Idn = 7))";
            }
        }

        return $string;
    }
}

if (! function_exists('get_adjustment_factors'))
{
    function get_adjustment_factors($worksheet_master_idn, $rank)
    {
        //Declare and Initialize Variables
		$CI =& get_instance();
        $adjustment_factors = array();
        $sql_where = "";

        if ($rank > 0 && $worksheet_master_idn > 0)
        {
            //Include Models
            $CI->load->model("m_reference_table");

            //Set where statement
            $sql_where = "WorksheetMaster_Idn = {$worksheet_master_idn} AND ActiveFlag = 1 AND AdjustmentFactor_Idn ";

            if ($worksheet_master_idn == 2)
            {
                switch($rank)
                {
                    case 1: //Height
                        $sql_where .= "= 1";
                        break;
                    case 500: //Labor Class
                        $sql_where .= "= 9";
                        break;
                    default:
                        $sql_where .= "NOT IN (1,9)";
                }
            }
            else
            {
                switch($rank)
                {
                    case 1: //First Grooved, Threaded or Lifts
                        $sql_where .= "IN (23,14,15)";
                        break;
                    case 500: //Labor Class
                        $sql_where .= "= 21";
                        break;
                    case 501: //Efficiency Factor
                        $sql_where .= "= 22";
                        break;
                    default:
                        $sql_where .= "NOT IN (23,14,15,21,22)";
                }

            }

            $adjustment_factors = $CI->m_reference_table->get_where("AdjustmentFactors", $sql_where, "Rank ASC");

            if ($rank <> 1 && $rank <> 500 && $rank <> 501)
            {
                array_unshift($adjustment_factors, array("AdjustmentFactor_Idn" => 0, "Name" => ""));
            }
        }

        return $adjustment_factors;
    }
}

if (! function_exists('sort_records'))
{
    function sort_records($table_name, $sort_me = array(), $where_field, $sort_field = "Rank")
    {
        //Declare and Initialize Variables
		$CI =& get_instance();
        $sorted = false;
        $errors = 0;

        //Load model
        $CI->load->model("m_reference_table");

        if (!empty($table_name) && !empty($sort_me))
        {
            $i = 1;
            $set = array();
            $where = array();

            foreach($sort_me as $s)
            {
                $set[$sort_field] = $i;
                $where[$where_field] = $s;

                if ($CI->m_reference_table->update($table_name, $set, $where) == false)
                {
                    $errors++;
                }
                $i++;
                //write_feci_log($CI->db->last_query());
            }
        }

        $sorted = ($errors == 0) ? true : false;

        return $sorted;
    }
}

if (! function_exists('get_job_parm'))
{
    function get_job_parm($job_number, $job_parm_idn)
    {
        //Declare and Initialize Variables
		$CI =& get_instance();
        $job_keys = array();
        $row = array();
        $where = array();
        $parm_values = array();

        if (!empty($job_number) && $job_parm_idn > 0)
        {
            $job_keys = get_job_keys($job_number);

            //Load model
            $CI->load->model("m_reference_table");

            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1],
                "JobDefault_Idn" => $job_parm_idn
                );

            $row = $CI->m_reference_table->get_where("JobParmDetails", $where);

			if (isset($row))
			{
				$parm_values = array(
					"AlphaValue" => @$row[0]['AlphaValue'],
					"NumericValue" => @$row[0]['NumericValue']
					);
			}
        }

        return $parm_values;
    }
}

if (! function_exists('is_parent'))
{
    function is_parent($job_number)
    {
        //Declare and Initialize Variables
		$CI =& get_instance();
        $job_keys = array();
        $where = array();

        if (!empty($job_number))
        {
            $job_keys = get_job_keys($job_number);

            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1]
                );

            return $CI->m_reference_table->get_field("Jobs", "IsParent", $where);
        }
        else
        {
            return false;
        }
    }
}

if (! function_exists('get_category_sorting_data'))
{
    function get_category_sorting_data()
    {
        //Load defaults
        $fitting_defaults = array(
                "Select" => array("s.Rank AS ProductSizeRank", "f.Rank AS FittingRank"),
                "Joins" => array(
                    array(
                        "Table" => "Fittings AS f",
                        "On" => "p.Fitting_Idn = f.Fitting_Idn",
                        "Type" => "left"
                    )
                ),
                "OrderBy" => array("ProductSizeRank", "FittingRank")
            );

        $defaults = array(
                "Select" => array("p.Rank AS ProductRank"),
                "Joins" => array(),
                "OrderBy" => array("ProductRank")
            );

        $data = array(
            //Pipe
            "WorksheetCategory89" => array(
                "Select" => array("s.Rank AS ProductSizeRank", "st.Rank AS ScheduleTypeRank"),
                "Joins" => array(
                    array(
                        "Table" => "ScheduleTypes AS st",
                        "On" => "p.ScheduleType_Idn = st.ScheduleType_Idn",
                        "Type" => "left"
                    )
                ),
                "OrderBy" => array("ProductSizeRank", "ScheduleTypeRank")
            ),
            //Fittings
            "WorksheetCategory90" => $fitting_defaults,
            "WorksheetCategory97" => $fitting_defaults,
            "WorksheetCategory98" => $fitting_defaults,
            "WorksheetCategory99" => $fitting_defaults,
            //Heads
            "WorksheetCategory92" => array(
                "Select" => array("s.Rank AS ProductSizeRank", "ct.Rank AS CoverageTypeRank", "ht.Rank AS HeadTypeRank", "ft.Rank AS FinishTypeRank"),
                "Joins" => array(
                    array(
                        "Table" => "CoverageTypes AS ct",
                        "On" => "p.CoverageType_Idn = ct.CoverageType_Idn",
                        "Type" => "left"
                    ),
                    array(
                        "Table" => "HeadTypes AS ht",
                        "On" => "p.HeadType_Idn = ht.HeadType_Idn",
                        "Type" => "left"
                    ),
                    array(
                        "Table" => "FinishTypes AS ft",
                        "On" => "p.FinishType_Idn = ft.FinishType_Idn",
                        "Type" => "left"
                    )
                ),
                "OrderBy" => array("ProductSizeRank", "CoverageTypeRank", "HeadTypeRank", "FinishTypeRank")
            ),
            //Hangers
            "WorksheetCategory91" => array(
                "Select" => array("s.Rank AS ProductSizeRank", "ht.Rank AS HangerTypeRank"),
                "Joins" => array(
                    array(
                        "Table" => "HangerTypes AS ht",
                        "On" => "p.HangerType_Idn = ht.HangerType_Idn",
                        "Type" => "left"
                    )
                ),
                "OrderBy" => array("ProductSizeRank", "HangerTypeRank")
            ),
            ////Defaults
            //"WorksheetCategory54" => $misc_defaults,
            ////Miscellaneous Defaults
            //"WorksheetCategory85" => $misc_defaults,
            ////Lifts
            //"WorksheetCategory100" => $misc_defaults,
            ////Miscellaneous Work
            //"WorksheetCategory105" => $misc_defaults,
            //Default
            "Default" => $defaults
        );

        return $data;
    }
}

if (! function_exists('format_for_rank'))
{
    function format_for_rank($num)
    {
        $num_digits = 5;
        $formatted = "";

        if (strlen(strval($num)) < $num_digits)
        {
            $formatted = str_pad($num, $num_digits, '0', STR_PAD_LEFT);
        }

        return $formatted;
    }
}

if (! function_exists('get_department_idn'))
{
    function get_department_idn($job_number)
    {

		$CI =& get_instance();
        $job_keys = array();
		$where = array();

		if (!empty($job_number))
        {
            $job_keys = get_job_keys($job_number);

            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1]
                );

            return $CI->m_reference_table->get_field("Jobs", "Department_Idn", $where);
        }
		else
		{
			return false;
		}
    }
}

if (! function_exists('get_recommended_boxes'))
{
    function get_recommended_boxes($job_number)
    {

		$CI =& get_instance();
        $job_keys = array();
		$where = array();
		$boxes = 0;
		$query = false;

		if (!empty($job_number))
        {
            $job_keys = get_job_keys($job_number);

            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1],
				"w.WorksheetMaster_Idn" => 1,
				"p.RecommendedBoxes >" => 0,
				"p.RecommendedBoxes IS NOT NULL" => null
                );

			$CI->db
				->select("wd.Quantity * p.RecommendedBoxes AS Boxes")
				->from("Worksheets AS w")
				->join("WorksheetDetails AS wd", "w.Worksheet_Idn = wd.Worksheet_Idn", "left")
				->join("Products AS p", "wd.Product_Idn = p.Product_Idn", "left")
				->where($where);

			$query = $CI->db->get();

			if ($query == false)
			{
				write_feci_log(array("Message" => "SQL Error ".$CI->db->last_query(), "Script" => __METHOD__));
			}
			else
			{
				if ($query->num_rows() > 0)
				{
					foreach ($query->result_array() as $row)
					{
						$boxes += $row['Boxes'];
					}
				}
			}

            return $boxes;
        }
		else
		{
			return false;
		}
    }
}

if (! function_exists('get_recommended_wire'))
{
    function get_recommended_wire($job_number)
    {

		$CI =& get_instance();
        $job_keys = array();
		$where = array();
		$wire = 0;
		$query = false;

		if (!empty($job_number))
        {
            $job_keys = get_job_keys($job_number);

            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1],
				"w.WorksheetMaster_Idn" => 1,
				"p.RecommendedWireFootage >" => 0,
				"p.RecommendedWireFootage IS NOT NULL" => null
                );

			$CI->db
				->select("wd.Quantity * p.RecommendedWireFootage AS FeetOfWire")
				->from("Worksheets AS w")
				->join("WorksheetDetails AS wd", "w.Worksheet_Idn = wd.Worksheet_Idn", "left")
				->join("Products AS p", "wd.Product_Idn = p.Product_Idn", "left")
				->where($where);

			$query = $CI->db->get();

			if ($query == false)
			{
				write_feci_log(array("Message" => "SQL Error ".$CI->db->last_query(), "Script" => __METHOD__));
			}
			else
			{
				if ($query->num_rows() > 0)
				{
					foreach ($query->result_array() as $row)
					{
						$wire += $row['FeetOfWire'];
					}
				}
			}

            return $wire;
        }
		else
		{
			return false;
		}
    }
}

if (! function_exists('get_eq_braces'))
{
    function get_eq_braces($job_number)
    {
		//Declare and initialize variables
		$html = "";
		$eq_data = array();

		if (!empty($job_number))
        {
            $eq_data = get_eq_braces_data($job_number, false);

			$html = '<span id="MainPipe">'.number_format($eq_data['main_piping'], 0).'</span> ft. main piping / <input id="MainPipeDenominator" type="text" value="40" class="width-35" data-recent-value="40"> + <span id="MainFittings">'.number_format($eq_data['main_fittings'], 0).'</span> qty main fittings = <span id="EQBraceQty" class="bold">'.number_format($eq_data['eq_braces'], 0).'</span>&nbsp;<span><button id="CopyEQBraceQty" class="btn btn-default btn-xs" data-product-idn="2489" type="button" title="Copy EQ Brace Quantity"><span class="glyphicon glyphicon-copy glyphicon-xs"></span></button></span>';
        }

		return $html;
    }
}

if (! function_exists('get_eq_braces_data'))
{
    function get_eq_braces_data($job_number, $json = true)
    {
		//Declare and initialize variables
		$data = array(
            'main_piping' => 0,
            'main_piping_details' => array(),
            'main_fittings' => 0,
            'main_fittings_details' => array(),
			'eq_braces' => 0,
			'message' => 0
			);
		$CI =& get_instance();
        $job_keys = array();
		$where = array();
		$query = false;

		if (!empty($job_number))
        {
            $job_keys = get_job_keys($job_number);

			$where = array(
				"Job_Idn" => $job_keys[0],
				"ChangeOrder" => $job_keys[1],
				"wd.Quantity <>" => 0,
				"p.WorksheetCategory_Idn" => 89
				);

			$CI->db
				->select("w.Worksheet_Idn, w.Quantity as WorksheetQuantity, SUM(wd.Quantity) AS MainPiping")
				->from("Worksheets AS w")
				->join("WorksheetDetails AS wd", "w.Worksheet_Idn = wd.Worksheet_Idn", "left")
				->join("Products AS p", "wd.Product_Idn = p.Product_Idn", "left")
				->where($where)
				->where_in("w.WorksheetMaster_Idn", array(10,13))
				->group_by("w.Worksheet_Idn, w.Quantity")
				->order_by("w.Worksheet_Idn, w.Quantity");

			$query = $CI->db->get();

			if ($query == false)
			{
				write_feci_log(array("Message" => "SQL Error ".$CI->db->last_query(), "Script" => __METHOD__));
			}
			else
			{
				foreach ($query->result_array() as $row)
				{
                    
                    $data['main_piping'] = $data['main_piping'] + ($row['MainPiping'] * $row['WorksheetQuantity']);
                    $data['main_piping_details'][] = $row;
				}
			}

			$where = array(
				"Job_Idn" => $job_keys[0],
				"ChangeOrder" => $job_keys[1],
				"wd.Quantity <>" => 0
				);

			$CI->db
				->select("w.Worksheet_Idn, w.Quantity as WorksheetQuantity, SUM(wd.Quantity) AS MainFittings")
				->from("Worksheets AS w")
				->join("WorksheetDetails AS wd", "w.Worksheet_Idn = wd.Worksheet_Idn", "left")
				->join("Products AS p", "wd.Product_Idn = p.Product_Idn", "left")
				->where($where)
				->where_in("w.WorksheetMaster_Idn", array(10,13))
				->where_in("p.WorksheetCategory_Idn", array(90,97,98)) //CPVC, Threaded & grooved fittings
				->where_in("p.Fitting_Idn", array(13,15,16,26,27,14,39,40,46,47)) //E, T, RT, VE, VT, RE, CPVC (39,40,46,47)
				->group_by("w.Worksheet_Idn, w.Quantity")
				->order_by("w.Worksheet_Idn, w.Quantity");

			$query = $CI->db->get();

			if ($query == false)
			{
				$data['message'] = -1;
				write_feci_log(array("Message" => "SQL Error ".$CI->db->last_query(), "Script" => __METHOD__));
			}
			else
			{
				$data['message'] = 1;
				foreach ($query->result_array() as $row)
				{
                    $data['main_fittings'] = $data['main_fittings'] + ($row['MainFittings'] * $row['WorksheetQuantity']);
                    $data['main_fittings_details'][] = $row;
				}
			}

			$data['eq_braces'] = round(round($data['main_piping'] / 40, 0) + $data['main_fittings']);

			if ($json)
			{
				return json_encode($data);
			}
			else
			{
				return $data;
			}
        }
		else
		{
			if ($json)
			{
				return json_encode($data);
			}
			else
			{
				return $data;
			}
		}
    }
}

if (! function_exists('get_latest_price_update'))
{
    /**
     * $type:
     *  "idn"
     *  "datetime"
     * $date_format
     *  ""
     */
    function get_latest_price_update($type, $date_format = "")
    {
        $CI =& get_instance();

        switch ($type)
        {
            case "idn":
                return $CI->db->query("SELECT PriceUpdate_Idn FROM PriceUpdates ORDER BY UpdateDateTime DESC")->row()->PriceUpdate_Idn;
                break;
            case "datetime":
                $datetime = $CI->db->query("SELECT UpdateDateTime FROM PriceUpdates ORDER BY UpdateDateTime DESC")->row()->UpdateDateTime;

                if (empty($date_format))
                {
                    return $datetime;
                }
                else
                {
                    return date_format(date_create($datetime), $date_format);
                }
                break;
            default:
                return "";
        }
    }
}

if (! function_exists('get_department_by_worksheet_category'))
{
    function get_department_by_worksheet_category($category)
    {
		if (!empty($category))
        {
            $CI =& get_instance();
            $where = array(
                "wmc.WorksheetCategory_Idn" => $category,
                );

            $CI->db
                ->select("Department_Idn")
                ->from("WorksheetMasters AS wm")
                ->join("WorksheetMasterCategories AS wmc", "wm.WorksheetMaster_Idn = wmc.WorksheetMaster_Idn","left")
                ->where($where);
            $query = $CI->db->get();
    
            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$CI->db->last_query(), "Script" => __METHOD__));
                return false;
            }
            else
            {
                $row = $query->row();
                return @$row->Department_Idn;
            }
        }
		else
		{
			return false;
		}
    }
}
?>