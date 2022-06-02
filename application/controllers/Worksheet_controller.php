<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Worksheet_controller extends CI_Controller {
	
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
        $this->load->library("worksheet_master");
	}

    /**
     * Summary of add_worksheet
     * 
     */
    public function add_worksheet()
    {
        $results = array(
            "html" => "",
            "after" => ""
            );

        $post = $this->input->post();

        if (!empty($post))
        {
            $job_number = $post['AddWorksheetModal_JobNumber'];
            $job_keys = get_job_keys($job_number);
            $worksheet_idn = $post['AddWorksheetModal_Worksheet_Idn'];
            $worksheet_master_idn = $post['AddWorksheetModal_WorksheetMaster_Idn'];
            $child_worksheet_master_idn = (isset($post['AddWorksheetModal_ChildWorksheetMaster_Idn'])) ? $post['AddWorksheetModal_ChildWorksheetMaster_Idn'] : 0;
            $worksheet_area_idn = (isset($post['AddWorksheetModal_WorksheetArea_Idn'])) ? $post['AddWorksheetModal_WorksheetArea_Idn'] : 0;
            $worksheet_name = $post['AddWorksheetName'];
            $field_labor_rate = $post['AddWorksheetModal_FieldLaborRate'];
            $new_worksheet_idn = 0;
            $new_worksheet_data = array();
            $view = "";
            $row = array();
            $job = array();

            //Add child worksheet
            if ($child_worksheet_master_idn > 0)
            {
                switch($child_worksheet_master_idn)
                {
                    case "10": //Crossmains
                        break;
                    case "9": //Branch Line
                        $new_worksheet_data = array(
                            "WorksheetArea_Idn" => $worksheet_area_idn,
                            "HeadType_Idn" => $post['HeadType'],
                            "CoverageType_Idn" => $post['CoverageType'],
                            "PipeExposure_Idn" => $post['PipeExposure']
                            );
                        break;
                }

                //Name
                $new_worksheet_data['Name'] = $worksheet_name;

                $worksheet_master_idn = $child_worksheet_master_idn;
            }

            //Get existing worksheets
            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1],
                "WorksheetMaster_Idn" => $worksheet_master_idn
                );

			if ($worksheet_area_idn > 0)
			{
				$where['WorksheetArea_Idn'] = $worksheet_area_idn;
			}

            $worksheets = $this->m_reference_table->get_where("Worksheets", $where, "Rank ASC");

            //Create new worksheet
            $new_worksheet_idn = $this->worksheet->create_worksheet($job_number, $worksheet_master_idn, $new_worksheet_data);

            switch($worksheet_master_idn)
            {
                case "10": //Crossmain
                    $view = "worksheet/cl_recap/cl_recap_crossmain_row";
                    break;
                case "9": //Branch line
                    $view = "worksheet/cl_recap/cl_recap_branchline_row";
                    break;
            }

            //Load data for view
            //$w = new Worksheet(array("w_id" => $new_worksheet_idn));
            $this->load->library('worksheet', array("w_id" => $new_worksheet_idn), 'add_worksheet_instance');
            $w = $this->add_worksheet_instance;

            $w->get_totals($new_worksheet_idn);

            //Get worksheet category
            $worksheet_category_idn = $this->m_worksheet->get_worksheet_category_idn($worksheet_idn, $new_worksheet_idn);

            $row = $w->w;

            $row['RowType'] = "Worksheet";
            $row['WorksheetCategory_Idn'] = $worksheet_category_idn;
            $row['Product_Idn'] = $new_worksheet_idn;
            $row['IsHead'] = 0;
            $row['IsMiscellaneousDetail'] = 0;
            $row['ProductSize_Idn'] = 0;
            $row['ApplyToAdjustmentFactorsFlag'] = 0;
            $row['MaterialUnitPrice'] = $w->material;
            $row['FieldUnitPrice'] = $w->field_hours;
            $row['ShopUnitPrice'] = $w->shop_hours;
            $row['OriginalMaterialUnitPrice'] = $w->material;
            $row['OriginalFieldUnitPrice'] = $w->field_hours;
            $row['OriginalShopUnitPrice'] = $w->shop_hours;
            $row['Description'] = "";
            $row['DomesticFlag'] = 0;
            $row['IsChildWorksheet'] = 1;

            $job['field_labor_rate'] = $field_labor_rate;

			//If branch line
            if ($worksheet_master_idn == 9)
            {
                $row['CoverageTypes'] = $this->m_reference_table->get_where("CoverageTypes", "ActiveFlag = 1", "Rank ASC");
                $row['HeadTypes'] = $this->m_reference_table->get_where("HeadTypes", "ActiveFlag = 1", "Rank ASC");

				//Insert row in WorksheetBasicAppropriationDetails for engineering worksheet
				//if engineering worksheet exists, add any new branchline worksheet to WorksheetBasicAppropriationDetails table
				$query = false;
				$this->load->model('m_worksheet_basic_appropriation');
				$BranchLineWorksheet_Idn = "";

				//Get Engineering Worksheet_Idn
				$this->db->select("Worksheet_Idn")
						->from("Worksheets")
						->where("WorksheetMaster_Idn", 22)
						->where("Job_Idn", $job_keys[0])
						->where("ChangeOrder", $job_keys[1]);

				$query = $this->db->get();

				if ($query)
				{
					if ($query->num_rows() > 0)
					{
						foreach ($query->result_array() as $eng_row)
						{
							$BranchLineWorksheet_Idn = $eng_row['Worksheet_Idn'];
						}

						if ($this->m_worksheet_basic_appropriation->insert($BranchLineWorksheet_Idn, $job_number))
						{
							$results['eng'] = "inserted";
						}
						else
						{
							$results['eng'] = "error";
						}
					}
				}

            }

            //Get html for worksheet
            $results['html'] = $this->load->view($view, array("Row" => $row, "job" => $job), true);

            //////////////////////
            //Re-sort worksheets
            //////////////////////

            $sort_me = array();

            if ($post['AddWorksheetPosition'] == "top")
            {
                $sort_me[] = $new_worksheet_idn;
            }

            foreach($worksheets as $w)
            {
                $sort_me[] = $w['Worksheet_Idn'];

                if ($w['Worksheet_Idn'] == $post['AddWorksheetPosition'])
                {
                    $sort_me[] = $new_worksheet_idn;
                }
            }

            if($post['AddWorksheetPosition'] == "bottom")
            {
                $sort_me[] = $new_worksheet_idn;
            }

            sort_records("Worksheets", $sort_me, "Worksheet_Idn");

            //Set results
            $results['after'] = $post['AddWorksheetPosition'];
        }

        echo json_encode($results);
    }

	public function copy_worksheet()
	{
		$results = array(
			"html" => "",
			"after" => ""
			);

		$post = $this->input->post();

        if (!empty($post))
        {
			$job_number = $post['AddWorksheetModal_JobNumber'];
			$job_keys = get_job_keys($job_number);
			$worksheet_idn = $post['AddWorksheetModal_Worksheet_Idn'];
			$worksheet_master_idn = $post['AddWorksheetModal_WorksheetMaster_Idn'];
			$child_worksheet_master_idn = (isset($post['AddWorksheetModal_ChildWorksheetMaster_Idn'])) ? $post['AddWorksheetModal_ChildWorksheetMaster_Idn'] : 0;
			$worksheet_area_idn = (isset($post['AddWorksheetModal_WorksheetArea_Idn'])) ? $post['AddWorksheetModal_WorksheetArea_Idn'] : 0;
			$worksheet_category_idn = (isset($post['AddWorksheetModal_WorksheetCategory_Idn'])) ? $post['AddWorksheetModal_WorksheetCategory_Idn'] : 0;
			$field_labor_rate = $post['AddWorksheetModal_FieldLaborRate'];

			//$from_job_number = (isset($post['CopyFromJob']) && !empty($post['CopyFromJob'])) ? $post['CopyFromJob'] : "";
			//$from_job_keys = get_job_keys($from_job_number);
			$from_worksheet_idn = (isset($post['CopyFromJobWorksheet']) && !empty($post['CopyFromJobWorksheet'])) ? $post['CopyFromJobWorksheet'] : "";
			$new_worksheet_name = $post['AddWorksheetName'];
			$target_worksheet_area_idn = (isset($post['AddWorksheetArea'])) ? $post['AddWorksheetArea'] : 0;

			$new_worksheet_idn = 0;
			$new_worksheet_area_idn = 0;
			$new_worksheet_data = array();
			$parent_worksheet_master_idn = 0;
			$worksheet_master = array();
			$view = "";
			$row = array();
			$job = array();

			if ($child_worksheet_master_idn > 0)
			{
			    $parent_worksheet_master_idn = $worksheet_master_idn;
			    $worksheet_master_idn = $child_worksheet_master_idn;

			    //Get parent worksheet master object
			    $worksheet_master = $this->worksheet_master->get_worksheet_master($parent_worksheet_master_idn);
			}

			//if copying worksheet to different Area
			if ($target_worksheet_area_idn > 0)
			{
			    $new_worksheet_area_idn = $target_worksheet_area_idn;
			}
			else
			{
			    $new_worksheet_area_idn = $worksheet_area_idn;
			}

			//Get existing worksheets
			$where = array(
			    "Job_Idn" => $job_keys[0],
			    "ChangeOrder" => $job_keys[1],
			    "WorksheetMaster_Idn" => $worksheet_master_idn
			    );

			if ($new_worksheet_area_idn > 0)
			{
			    $where['WorksheetArea_Idn'] = $new_worksheet_area_idn;
			}

			$worksheets = $this->m_reference_table->get_where("Worksheets", $where, "Rank ASC");

			//Create new worksheet
			$new_worksheet_data = $this->worksheet->copy_worksheet($from_worksheet_idn, $new_worksheet_name, $new_worksheet_area_idn, $job_number, $worksheet_idn);

			if ($new_worksheet_data['return_code'] == 1)
			{
			    $new_worksheet_idn = $new_worksheet_data['new_worksheet_idn'];

			    switch($worksheet_master_idn)
			    {
			        case "10": //Crossmain
			            $view = "worksheet/cl_recap/cl_recap_crossmain_row";
			            break;
			        case "9": //Branch line
			            $view = "worksheet/cl_recap/cl_recap_branchline_row";
			            break;
			        default:
			            $view = "worksheet/worksheet_products";
			    }

			    //Load data for view
			    //$w = new Worksheet(array("w_id" => $new_worksheet_idn));
                $this->load->library('worksheet', array("w_id" => $new_worksheet_idn), 'copy_worksheet_instance');
                $w = $this->copy_worksheet_instance;
    
			    $w->get_totals($new_worksheet_idn);

			    //Get worksheet category
			    //$worksheet_category_idn = $this->m_worksheet->get_worksheet_category_idn($worksheet_idn, $new_worksheet_idn);

			    $row = $w->w;

			    $row['RowType'] = "Worksheet";
			    $row['WorksheetCategory_Idn'] = $worksheet_category_idn;
			    $row['Product_Idn'] = $new_worksheet_idn;
			    $row['IsHead'] = 0;
			    $row['IsMiscellaneousDetail'] = 0;
			    $row['ProductSize_Idn'] = 0;
			    $row['ApplyToAdjustmentFactorsFlag'] = 0;
			    $row['MaterialUnitPrice'] = $w->material;
			    $row['FieldUnitPrice'] = $w->field_hours;
			    $row['ShopUnitPrice'] = $w->shop_hours;
			    $row['OriginalMaterialUnitPrice'] = $w->material;
			    $row['OriginalFieldUnitPrice'] = $w->field_hours;
			    $row['OriginalShopUnitPrice'] = $w->shop_hours;
			    $row['Description'] = "";
			    $row['DomesticFlag'] = 0;
			    $row['IsChildWorksheet'] = 1;
			    //$worksheet_master = $w->wm;

			    //Needed for worksheet_products view
			    $row['ProductAssembly_Idn'] = 0;
			    $row['CategoryName'] = "";
			    $row['CategoryProductRank'] = 0;

			    $job['field_labor_rate'] = $field_labor_rate;

			    if ($worksheet_master_idn == 9)
			    {
			        $row['CoverageTypes'] = $this->m_reference_table->get_where("CoverageTypes", "ActiveFlag = 1", "Rank ASC");
			        $row['HeadTypes'] = $this->m_reference_table->get_where("HeadTypes", "ActiveFlag = 1", "Rank ASC");
			    }

			    //Get html for worksheet
			    $results['html'] = $this->load->view($view, array("Row" => $row, "job" => $job, "worksheet_master" => $worksheet_master), true);

			    //////////////////////
			    //Re-sort worksheets
			    //////////////////////

			    $sort_me = array();

			    if ($post['AddWorksheetPosition'] == "top")
			    {
			        $sort_me[] = $new_worksheet_idn;
			    }

			    foreach($worksheets as $w)
			    {
			        $sort_me[] = $w['Worksheet_Idn'];

			        if ($w['Worksheet_Idn'] == $post['AddWorksheetPosition'])
			        {
			            $sort_me[] = $new_worksheet_idn;
			        }
			    }

			    if($post['AddWorksheetPosition'] == "bottom")
			    {
			        $sort_me[] = $new_worksheet_idn;
			    }

			    sort_records("Worksheets", $sort_me, "Worksheet_Idn");

			    //Set results
			    $results['after'] = $post['AddWorksheetPosition'];
			}
		}

		echo json_encode($results);
	}

    /**
     * Summary of add_area
     */
    public function add_area()
    {
        //Declare and initialize variables
        $results = array(
            "html" => "",
            "after" => ""
            );
        $data = array();
        $job_keys = array();
        $new_area_idn = 0;
        $areas = array();
        $where = array();
        $row = array();
        $worksheet_master = array();

        //Load models
        $this->load->model("m_worksheet_area");

        $post = $this->input->post();

        if (!empty($post))
        {
            $job_keys = get_job_keys($post['NewAreaJobNumber']);

            //Get existing areas
            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1]
                );
            $areas = $this->m_reference_table->get_where("WorksheetAreas", $where, "Rank ASC");

            //Load data for insert
            $data = array(
                "Name" => $post['NewAreaName'],
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1],
                "WorksheetMaster_Idn" => $post['NewAreaWorksheetMaster_Idn']
            );

            //Insert area
            $new_area_idn = $this->m_worksheet_area->insert($data);

            //Get HTML
            $row = array(
                "WorksheetArea_Idn" => $new_area_idn,
                "Name" => $post['NewAreaName']
                );
            $worksheet_master = array("NumberOfColumns" => 11);
            $results['html'] = $this->load->view("worksheet/cl_recap/cl_area_row", array("Row" => $row, "worksheet_master" => $worksheet_master), true);

            //////////////////////
            //Re-sort areas
            //////////////////////

            $sort_me = array();

            if ($post['NewAreaPosition'] == "top")
            {
                $sort_me[] = $new_area_idn;
            }

            foreach($areas as $a)
            {
                $sort_me[] = $a['WorksheetArea_Idn'];

                if ($a['WorksheetArea_Idn'] == $post['NewAreaPosition'])
                {
                    $sort_me[] = $new_area_idn;
                }
            }

            if($post['NewAreaPosition'] == "bottom")
            {
                $sort_me[] = $new_area_idn;
            }

            sort_records("WorksheetAreas", $sort_me, "WorksheetArea_Idn");

            //Set position
            $results['after'] = $post['NewAreaPosition'];
        }

        echo json_encode($results);
    }

    /**
     * Summary of add_miscellaneous
     */
    public function add_miscellaneous_handler()
    {
        //Declare and initialize variables
        $results = array();
        $finish_works = array();

        //Get post data
        $post = $this->input->post();

        if (!empty($post))
        {
            if ($post['WorksheetCategory_Idn'] == 140)
            {
                $results['html'] = array();
                //Get finish works
                $finish_works = $this->m_reference_table->get_all("FinishWorks", array(), true, "Rank");
                foreach($finish_works as $finish_work)
                {
                    if (!isset($post['FinishWork']) || !in_array($finish_work['FinishWork_Idn'], $post['FinishWork']))
                    {
                        $results['html'][] = $this->_add_miscellaneous($post, $finish_work);
                    }
                }
            }
            else
            {
                $results['html'] = $this->_add_miscellaneous($post);
            }
        }

        echo json_encode($results);
    }

    /**
     * Summary of _insert_miscellaneous_detail
     * @param mixed $data 
     * @return mixed
     */
    private function _add_miscellaneous($post, $finish_work = array())
    {
        $html = "";
        $insert_data = array();
        $row = array();
        $view = "";
        $finish_work_idn = 0;
        $field_unit_price = 0;
        $new_miscellaneous_idn = 0;
        $name = "";

        //Load model
        $this->load->model("m_miscellaneous_detail");

        if (!empty($finish_work))
        {
            $finish_work_idn = $finish_work['FinishWork_Idn'];
            $field_unit_price = $finish_work['Value'];
            $name = quotes_to_entities($finish_work['Name']);
        }

        $insert_data = array(
            "Worksheet_Idn" => $post['Worksheet_Idn'],
            "WorksheetCategory_Idn" => $post['WorksheetCategory_Idn'],
            "LineNum" => $this->m_miscellaneous_detail->get_next_line_num($post['Worksheet_Idn'], $post['WorksheetCategory_Idn']),
            "WorksheetArea_Idn" => $post['WorksheetArea_Idn'],
            "FinishWork_Idn" => $finish_work_idn,
            "FieldUnitPrice" => $field_unit_price,
            "Name" => $name
            );

        if ($this->m_reference_table->insert("MiscellaneousDetails", $insert_data))
        {
            $new_miscellaneous_idn = $this->db->insert_id();

            $row = array(
                "RowType" => "Miscellaneous",
                "MiscellaneousDetail_Idn" => $new_miscellaneous_idn,
                "WorksheetArea_Idn" => $post['WorksheetArea_Idn'],
                "Name" => $name,
                "Quantity" => 0,
                "MaterialUnitPrice" => 0,
                "ShopUnitPrice" => 0,
                "FieldUnitPrice" => $field_unit_price,
                "FinishWork_Idn" => $finish_work_idn
                );

                $view = ($post['WorksheetCategory_Idn'] == 140) ? "cl_recap_finish_work_row": "cl_recap_misc_row";

            $html = $this->load->view("worksheet/cl_recap/".$view, array("Row" => $row), true);
        }

        return $html;
    }

	/*
	 * load_parms
	 *
	 * Get products from worksheet parameters
	 *
	 * @param	POST(array)
	 * @return	JSON
	 */
	public function load_parms()
	{
		//Decare and initialize variables
        $products = array();

        //Only display view if
		if ($this->input->post())
		{
            json_encode($products);
		}
	}

	/**
	 * Summary of delete_products
     *
     * Delete products from worksheet found in MiscellaneousDetails and WorksheetDetails tables
     *
	 * @param mixed $worksheet_idn
	 * @param mixed $job_number
	 */
	public function delete_products($worksheet_idn, $job_number, $worksheet_master_idn)
	{
		//Declare and initialize variables
		$results = array(
			'return_code' => 0,
			'num_deleted' => 0,
            'deleted' => array(),
            'errors' => 0,
            'message' => ""
		);
        $table_name = "";
        $product_assembly_idn = 0;
        $where = array();
        $post = $this->input->post(null, true);
        $worksheets = array();
        $misc_items = array();
        $area_errors = 0;
        $job_keys = array();

        //Delete Worksheets, WorksheetDetails and MiscellaneousDetails and Assemblies
        if (isset($post['Delete']) && !empty($post['Delete']))
        {
		    //If post call, load into $delete_ids array
            $delete_ids = $post['Delete'];
            
            $job_keys = get_job_keys($job_number);

			//Loop through products
			foreach($delete_ids as $delete_id)
			{
                $pos = strpos($delete_id,"_");
                $prefix = substr($delete_id, 0, $pos);
                $id = substr($delete_id, $pos + 1);

                switch($prefix)
                {
                    case "Product":
                        $table_name = "WorksheetDetails";
                        $where = array(
                            'Worksheet_Idn' => $worksheet_idn,
                            'Product_Idn' => $id
                        );

                        if ($this->m_reference_table->delete($table_name, $where))
                        {
                            $results['num_deleted']++;
                            $results['deleted'][] = $delete_id;

                            if ($worksheet_master_idn == 1)
                            {
                                //If Product deleted from panels and devices worksheet, delete corresponding engineering misc detail record
                                $eng_where = array(
                                    "Job_Idn" => $job_keys[0],
                                    "ChangeOrder" => $job_keys[1],
                                    "WorksheetMaster_Idn" => 7
                                );
                                $eng_worksheet_idn = $this->m_reference_table->get_field("Worksheets", "Worksheet_Idn", $eng_where);

                                if (!empty($eng_worksheet_idn) && $eng_worksheet_idn > 0)
                                {
                                    $this->worksheet->delete_sh_eng_detail($eng_worksheet_idn, $job_number, $id);
                                }
                            }
                        }
                        else
                        {
                            $results['errors']++;
                            $results['return_code'] = 3;
                            write_feci_log('Error deleting '.$delete_id.' in worksheet '.$worksheet_idn.'.');
                        }
                        break;
                    case "Miscellaneous":
                        $table_name = "MiscellaneousDetails";
                        $where = array(
                            'MiscellaneousDetail_Idn' => $id
                            );

                        //Get ProductAssembly_Idn
                        $product_assembly_idn = $this->m_reference_table->get_field($table_name, "ProductAssembly_Idn", $where);

                        //Delete miscellaneous detail record
                        if ($this->m_reference_table->delete($table_name, $where))
                        {
                            //Delete assembly, if necessary
                            if ($product_assembly_idn > 0)
                            {
                                if ($this->delete_assembly($product_assembly_idn) === false)
                                {
                                    $results['errors']++;
                                    $results['return_code'] = 3;
                                }
                            }

                            $results['num_deleted']++;
                            $results['deleted'][] = $delete_id;
                        }
                        else
                        {
                            $results['errors']++;
                            $results['return_code'] = 3;
                            write_feci_log('Error deleting product '.$delete_id.' in worksheet '.$worksheet_idn.'.');
                        }
                        break;
                    case "Worksheet":
                        //Get worksheet_idn
                        $child_worksheet_idn = $id;

                        //Delete worksheet
                        if ($this->delete_worksheet($child_worksheet_idn))
                        {
                            $results['num_deleted']++;
                            $results['deleted'][] = $delete_id;
                        }
                        else
                        {
                            $results['errors']++;
                            $results['return_code'] = 3;
                        }
                        break;
                    case "AdjustmentFactorRow":
                        $table_name = "WorksheetFactorDetails";
                        $where = array(
                            "Worksheet_Idn" => $worksheet_idn,
                            "Rank" => $id,
                            "Section" => 0 //Sections are for Engineering worksheet
                            );
                        
                        //Delete WorksheetFactorDetails record
                        if ($this->m_reference_table->delete($table_name, $where))
                        {
                            $results['num_deleted']++;
                            $results['deleted'][] = $delete_id;
                        }
                        else
                        {
                            $results['errors']++;
                            $results['return_code'] = 3;
                            write_feci_log('Error deleting '.$delete_id.' in worksheet '.$worksheet_idn.'.');
                        }
                        break;
                    case "WorksheetArea":
                        //Delete worksheets in area
                        $worksheets = $this->m_reference_table->get_fields("Worksheets", "Worksheet_Idn", "WorksheetArea_Idn = {$id}");

                        foreach($worksheets as $w)
                        {
                            //Delete worksheet
                            if ($this->delete_worksheet($w['Worksheet_Idn']))
                            {
                                $results['num_deleted']++;
                                $results['deleted'][] = "Worksheet_".$w['Worksheet_Idn'];
                            }
                            else
                            {
                                $area_errors++;
                                $results['errors']++;
                                $results['return_code'] = 3;
                            }
                        }

                        //Delete miscellaneous items
                        $misc_items = $this->m_reference_table->get_fields("MiscellaneousDetails", "MiscellaneousDetail_Idn", "WorksheetArea_Idn = {$id}");

                        foreach($misc_items as $m)
                        {
                            $table_name = "MiscellaneousDetails";
                            $where = array("MiscellaneousDetail_Idn" => $m['MiscellaneousDetail_Idn']);

                            //Delete miscellaneous detail record
                            if ($this->m_reference_table->delete($table_name, $where))
                            {
                                $results['num_deleted']++;
                                $results['deleted'][] = "Miscellaneous_".$m['MiscellaneousDetail_Idn'];
                            }
                            else
                            {
                                $area_errors++;
                                $results['errors']++;
                                $results['return_code'] = 3;
                            }
                        }

                        //Delete area
                        if ($area_errors == 0)
                        {
                            $table_name = "WorksheetAreas";
                            $where = array("WorksheetArea_Idn" => $id);

                            //Delete miscellaneous detail record
                            if ($this->m_reference_table->delete($table_name, $where))
                            {
                                $results['num_deleted']++;
                                $results['deleted'][] = $delete_id;
                            }
                            else
                            {
                                $results['errors']++;
                                $results['return_code'] = 3;
                            }
                        }
                        break;
                }
			} //END: foreach
			
            //No errors
			if ($results['return_code'] == 0)
			{
                $s = ($results['num_deleted'] == 1) ? "" : "s";
                $results['message'] = $results['num_deleted'].' item'.$s.' deleted.';
                $results['return_code'] = 1;
			}
            else //Errors
            {
                $results['messsage'] = $results['errors']." error(s) while deleting items, check log for details.";
            }

            job_update($job_number);
        }

		echo json_encode($results);
	}

   /**
    * load_worksheet_parms
    * 
    * Loads products onto worksheet based on selected worksheet parms
    *  {
    *      inserts: "",
    *      updates: "",
    *      deletes: "",
    *      errors: ""
    *  }
    */
    public function load_worksheet_parms($worksheet_idn)
	{
        //Initialize and declare variables
		$results = array(
            "inserts" => array(),
            "potential_inserts" => array(),
            "deletes" => array(),
            "errors" => array()
		);
        $Row = array();

        //Post Data
        $post = $this->input->post(null, true);

        if (!empty($post))
        {
            //*****************************************
            //Save worksheet parms
            //*****************************************
            $results['errors'] = array_merge($this->worksheet->save_worksheet_parms($worksheet_idn, $post));

            //*****************************************
            // Add Products to WorksheetDetails
            //*****************************************

            $worksheet_master = $post['wm'];
            $worksheet_master_idn = $post['wm']['WorksheetMaster_Idn'];
            $job_parms = $post['jp'];
            $worksheet_master_products = array();

            //Get all products from all categories in worksheet master
            $sql_where = "";
            $shared_categories = (isset($worksheet_master['SharedCategories'])) ? implode(",",$worksheet_master['SharedCategories']) : "";
            $not_shared_categories = (isset($worksheet_master['NotSharedCategories'])) ? implode(",",$worksheet_master['NotSharedCategories']) : "";

            //if worksheet has both shared and not shared categories
            if (!empty($shared_categories) && !empty($not_shared_categories))
            {
                $sql_where = "(WorksheetCategory_Idn IN ({$shared_categories}) OR (WorksheetMaster_Idn = {$worksheet_master_idn} AND WorksheetCategory_Idn IN ({$not_shared_categories})))";
            }
            
            //if worksheet has only not shared categories
            if (empty($shared_categories) && !empty($not_shared_categories))
            {
                $sql_where = "WorksheetMaster_Idn = {$worksheet_master_idn} AND WorksheetCategory_Idn IN ({$not_shared_categories})";
            }

            //if worksheet has only shared categores
            if (!empty($shared_categories) && empty($not_shared_categories)) 
            {
                $sql_where = "WorksheetCategory_Idn IN ({$shared_categories})";
            }

            $sql_where .= (empty($sql_where)) ? "ActiveFlag = 1" : " AND ActiveFlag = 1";

            $sql_where .= " AND (LoadFlag = 1 OR AutoLoadFlag = 1)";

            $worksheet_master_products = $this->m_reference_table->get_where("Products", $sql_where, "WorksheetCategory_Idn ASC, Rank ASC");

            //Test for matches
            if (!empty($worksheet_master_products))
            {
                //$match = $this->worksheet->get_parm_match($worksheet_idn, $post);

                $origin_worksheet_categories = array(89,97,36,39); //Pipe and Grooved Fittings
                $pipe_type_categories = array(89,90,97,98,99,96,36,37,39,152);
                $fitting_categories = array(90,97);
                $auto_load_categories = (isset($worksheet_master['AutoLoadCategories'])) ? $worksheet_master['AutoLoadCategories'] : array();
                $potential_products_to_add = array();
                $compared_products = array();
                $products_to_add = array();
                $products_to_delete = array();
                $product_qty = 0;
                $existing_product_idns = (isset($post['Id'])) ? $post['Id'] : array();
                $row_id = "";

                foreach($worksheet_master_products as $product)
                {
                    $match = array(
                        "size" => 0,
                        "schedule" => 0,
                        "pipe" => 0,
                        "origin" => 0,
                        "display" => 0,
                        "fitting" => 0,
                        "threaded_fitting" => 0,
                        "grooved_fitting" => 0
                        );
                    $default = 0;
                    
                    //Get quantity from worksheet if product is on worksheet
                    if (in_array($product['Product_Idn'], $existing_product_idns))
                    {
                        //$index = array_search($product['Product_Idn'], $existing_product_idns);
                        $row_id = "Product_".$product['Product_Idn'];
                        $product_qty = string_filter($post['Qty'][$row_id], ",");
                    }

                    //Match Display
                    $match['display'] = $product['LoadFlag'];
                
                    //Default
                    //If products auto_load_flag is 1 or the category (p_sub_category_details) auto_load flag is 1 and product display_flag is 1, then load the product into the worksheet
                    if ($product['AutoLoadFlag'] == 1 || (in_array($product['WorksheetCategory_Idn'], $auto_load_categories) && $match['display'] == 1))
                    {
                        $default = 1;
                    }

                    if ($default == 0)
                    {
                        //********************************************************************
                        //  Check product against job parms
                        //********************************************************************
                        if (in_array($product['WorksheetCategory_Idn'], $origin_worksheet_categories)
                            && $product['ScheduleType_Idn'] != 4
                            && $product['ScheduleType_Idn'] != 5)
                        {
                            if ($job_parms[28]['AlphaValue'] == 'N' || ($job_parms[28]['AlphaValue'] == 'Y' && $product['DomesticFlag'] == 1))
                            {
                                $match['origin'] = 1;
                            }
                        }
                        else
                        {
                            $match['origin'] = 1;
                        }
                        
                        //Grooved Fitting Type
                        //If is blank, both or not Grooved Fitting product
                        if (round($job_parms[78]['NumericValue'],0) == 0 || round($job_parms[78]['NumericValue'],0) == 3 || $product['WorksheetCategory_Idn'] != 97)
                        {
                            $match['grooved_fitting'] = 1;
                        }
                        else
                        {
                            //product matches grooved fitting type
                            if ($product['GroovedFittingType_Idn'] == round($job_parms[78]['NumericValue'], 0))
                            {
                                $match['grooved_fitting'] = 1;
                            }
                        }

                        //********************************************************************
                        //Check Product against worksheet Parms
                        //********************************************************************
                        //Size
                        if (in_array($product['ProductSize_Idn'], $post['size_ids']))
                        {
                            $match['size'] = 1;
                        }

                        //Schedule
                        if ($product['WorksheetCategory_Idn'] == 89 || $product['WorksheetCategory_Idn'] == 36) //Pipe
                        {
                            if (isset($post['schedule_type_id']) && $post['schedule_type_id'] == $product['ScheduleType_Idn'])
                            {
                                $match['schedule'] = 1;
                            }
                        }
                        else
                        {
                            $match['schedule'] = 1;
                        }

                        //Pipe Type
                        if (in_array($product['WorksheetCategory_Idn'], $pipe_type_categories))
                        {
                            //Match to Black Pipe Type if threaded or grooved fittings and Fittings options is Pipe Only and Pipe Type is Galvanized or Custom HD Galv
                            if (($product['WorksheetCategory_Idn'] == 90 || $product['WorksheetCategory_Idn'] == 97) 
                                && $post['pipe_options'] == 0 
                                && ($post['pipe_type_id'] == 3 || $post['pipe_type_id'] == 8))
                            {
                                if ($product['PipeType_Idn'] == 2)
                                {
                                    $match['pipe'] = 1;
                                }
                            }
                            //Match to Custom HDGlav to Galvanized pipe type if threaded or grooved fittings
                            elseif(($product['WorksheetCategory_Idn'] == 90 || $product['WorksheetCategory_Idn'] == 97)
                                && $post['pipe_type_id'] == 8 
                                && $product['PipeType_Idn'] == 3)
                            {
                                $match['pipe'] = 1;
                            }
                            //Electronics Div - Grooved and Black or Galvanized pipe type is selected
                            elseif ($product['WorksheetCategory_Idn'] == 39 
                                && ($post['pipe_type_id'] == 2 || $post['pipe_type_id'] == 3)
                                ) 
                            {
                                $match['pipe'] = 1;
                            }
                            elseif ($post['pipe_type_id'] == $product['PipeType_Idn'])
                            {
                                $match['pipe'] = 1;
                            }
                        }
                        else
                        {
                            $match['pipe'] = 1;
                        }

                        //Fitting
                        if (in_array($product['WorksheetCategory_Idn'], $fitting_categories))
                        {
                            if (isset($post['fitting_id']) && $post['fitting_id'] == 0) //Match both grooved and threaded fitting
                            {
                                $match['fitting'] = 1;
                            }
                            
                            //If fitting matches category
                            if (isset($post['fitting_id']) && $post['fitting_id'] == $product['WorksheetCategory_Idn'])
                            {
                                $match['fitting'] = 1;
                            }
                        }
                        else
                        {
                            $match['fitting'] = 1;
                        }

                        //Threaded Fitting type
                        if (isset($post['fitting_material_id']) && $product['WorksheetCategory_Idn'] == 90)
                        {
                            if ($post['fitting_material_id'] == $product['ThreadedFittingType_Idn'])
                            {
                                $match['threaded_fitting'] = 1;
                            }
                        }
                        else
                        {
                            $match['threaded_fitting'] = 1;
                        }

                    } //END: default = 0

                    //Load product into potential products to add array if default or all matches
                    if ($default == 1 || sizeof($match) == array_sum($match))
                    {
                        $potential_products_to_add[] = $product;
                    }

                    //Remove product if they exist in worksheet, do not match, are not default, have a quantity of zero
                    if (in_array($product['Product_Idn'], $existing_product_idns)
                        && sizeof($match) != array_sum($match)
                        && $default == 0
                        && $product_qty == 0)
                    {
                        $products_to_delete[] = $product['Product_Idn'];
                    }
                } //END: foreach

                //Compare products and remove more expensive duplicate
                $compared_products = compare_products($potential_products_to_add);

                $products_to_add = $compared_products['filtered_products'];

                //$results['potential_inserts'] = $potential_products_to_add;

                //Insert products
                if (!empty($products_to_add))
                {
                    $i = 0;
                    foreach($products_to_add as $product)
                    {
                        if (in_array($product['Product_Idn'], $existing_product_idns) == false) //Only insert product does not exsit in worksheet
                        {
                            if ($this->worksheet->insert_worksheet_detail_by_product_idns($product['Product_Idn'], $worksheet_idn))
                            {
                                //Add to worksheet
                                $html= "";
                                $where = array();

                                //Build where
                                $where = array(
                                    'wd.Product_Idn' => $product['Product_Idn'],
                                    'wd.Worksheet_Idn' => $worksheet_idn,
                                    'wm.WorksheetMaster_Idn' => $worksheet_master_idn
                                    );

                                //Get data for view
                                $product_data = $this->m_worksheet->get_worksheet_details_extended($worksheet_idn, $worksheet_master_idn, array(), $where);
                                $Row = $product_data[$product['WorksheetCategory_Idn']][0];

                                //Get html for new row
                                $html = $this->load->view("worksheet/worksheet_products", array("Row" => $Row, "CategoryName" => $Row['CategoryName'], 'worksheet_master' => $worksheet_master), true);

                                //$results['inserts'][$i]['html'] = $html;
                                //$results['inserts'][$i]['worksheet_category_idn'] = $product['WorksheetCategory_Idn'];
                                $results['inserts'][] = array("Html" => $html, "CategoryProductRank" => $Row['CategoryProductRank'], "WorksheetCategory_Idn" => $product['WorksheetCategory_Idn']);

                                $i++;
                            }
                            else
                            {
                                $results['errors'][] = $product['Product_Idn'];
                            }
                        }
                    }
                }

                //Delete products
                if (!empty($products_to_delete))
                {
                    $where = array();
                    foreach($products_to_delete as $product_idn)
                    {
                        $where = array(
                            "Worksheet_Idn" => $worksheet_idn,
                            "Product_Idn" => $product_idn
                            );

                        if ($this->m_worksheet_detail->delete($where))
                        {
                            $results['deletes'][] = $product_idn;
                        }
                    }
                }
            } //END: if (!empty($worksheet_master_products))
        } //END: if (!empty($post))

        echo json_encode($results);
    }

    /**
     * Summary of delete_worksheet
     * @param mixed $worksheet_idn 
     */
    function delete_worksheet_ajax($worksheet_idn = 0)
    {
        //Declare and initialize variables
        $results = array(
            "message" => "",
            "return_code" => 0
            );

        if ($worksheet_idn > 0)
        {
            if ($this->delete_worksheet($worksheet_idn))
            {
                $results = array(
                    "return_code" => 1,
                    "message" => "Worksheet deleted."
                    );
            }
            else
            {
                $results = array(
                    "return_code" => 3, 
                    "message" => "Error deleting worksheet."
                    );
            }
        }

        echo json_encode($results);
    }

    function delete_worksheet($worksheet_idn = 0)
    {
        $delete = array();
        $deleted = false;
        $worksheet = array();

        //If worksheet exists, delete
        $worksheet = $this->m_worksheet->get_worksheet_by_idn($worksheet_idn);

        if (!empty($worksheet))
        {
            $where = array("Worksheet_Idn" => $worksheet_idn);

            //Delete worksheet factor details
            $delete['WorksheetFactorDetails'] = $this->m_reference_table->delete("WorksheetFactorDetails", $where);

            //Delete Job Mob
            $delete['JobMobWorksheets'] = $this->m_reference_table->delete("JobMobWorksheets", $where);

            //Delete worksheet parms
            $delete['WorksheetParms'] = $this->m_reference_table->delete("WorksheetParms", $where);

            //Delete Assembly Details
            $assembly_detail_where = "ProductAssembly_Idn IN (SELECT ProductAssembly_Idn FROM ProductAssemblies WHERE Worksheet_Idn = {$worksheet_idn})";
            $delete['ProductAssemblyDetails'] = $this->m_reference_table->delete("ProductAssemblyDetails", $assembly_detail_where);

            //Delete Assemblies
            $delete['ProductAssemblies'] = $this->m_reference_table->delete("ProductAssemblies", $where);

            //Delete miscellaneous details
            $delete['MiscellaneousDetails'] = $this->m_reference_table->delete("MiscellaneousDetails", $where);

            //Delete basic appropriation details
            $basic_appropriation_where = "Worksheet_Idn = {$worksheet_idn} OR BranchLineWorksheet_Idn = {$worksheet_idn}";
            $delete['WorksheetBasicAppropriationDetails'] = $this->m_reference_table->delete("WorksheetBasicAppropriationDetails", $basic_appropriation_where);

            //Delete Engineering additional costs
            $delete['WorksheetEngineeringAdditionalCosts'] = $this->m_reference_table->delete("WorksheetEngineeringAdditionalCosts", $where);

            //Delete worksheet details
            $delete['WorksheetDetails'] = $this->m_reference_table->delete("WorksheetDetails", $where);


            //Delete WorksheetAreas
            if ($worksheet['WorksheetMaster_Idn'] == 32) //Cross mains and lines
            {
                $delete_wa = array(
                    "Job_Idn" => $worksheet['Job_Idn'], 
                    "ChangeOrder" => $worksheet['ChangeOrder'], 
                    "WorksheetMaster_Idn" => 9
                    );
                $delete['WorksheetAreas'] = $this->m_reference_table->delete("WorksheetAreas", $delete_wa);
            }
            
            //Delete WorksheetRecapDetails

            //Get child worksheets
            $child_worksheet_idns = $this->m_worksheet->get_child_worksheet_idns_by_parent($worksheet_idn);
            if (empty($child_worksheet_idns))
            {
                $delete['Children'] = array(true);
            }
            else
            {
                foreach ($child_worksheet_idns as $child_worksheet_idn)
                {
                    //Delete child worksheets
                    $delete['Children'][$child_worksheet_idn] = $this->delete_worksheet($child_worksheet_idn);
                }
            }

            //Panels and Devices or Panels and Devices Recap
            if($worksheet['WorksheetMaster_Idn'] == 1 || $worksheet['WorksheetMaster_Idn'] == 25)
            {
                $this->load->model("m_miscellaneous_detail");

                //Get Engineering Worksheet_Idn for job
				$eng_where = array(
					"Job_Idn" => $worksheet['Job_Idn'],
					"ChangeOrder" => $worksheet['ChangeOrder'],
					"WorksheetMaster_Idn" => 7
				);
                $eng_worksheet_idn = $this->m_reference_table->get_field("Worksheets", "Worksheet_Idn", $eng_where);
                
                //Delete all related misc detail records on engineering worksheet
                $eng_delete_where = "Worksheet_Idn = {$eng_worksheet_idn} AND WorksheetCategory_Idn IN (4,5,7,41,43,61,55,58)";
                $this->m_miscellaneous_detail->delete($eng_delete_where);

                if ($worksheet['WorksheetMaster_Idn'] == 1)
                {
                    //Update related misc detail records, for panels and devices worksheet delete only
                    $this->worksheet->save_sh_engineering_defaults($eng_worksheet_idn, format_job_number($worksheet['Job_Idn'], $worksheet['ChangeOrder']));
                }
            }
            
            //Delete worksheet
            $delete['Worksheets'] = $this->m_reference_table->delete("Worksheets", $where);

            //Set return
            if (array_search(false, $delete) == false && array_search(false, $delete['Children']) == false)
            {
                //Job updated
                job_update(format_job_number($worksheet['Job_Idn'], $worksheet['ChangeOrder']));

                $deleted = true;
            }
            else
            {
                write_feci_log(array("Message" => "Error deleting worksheet: ". json_encode($delete), "Script" => __METHOD__));
 
                $deleted = false;
            }
        }

        return $deleted;
    }

    /**
     * Summary of delete_assembly
     * @param mixed $assembly_idn 
     * @return bool
     */
    function delete_assembly($assembly_idn)
    {
        $delete = false;
        $table_name = "";
        $where = array();

        if ($assembly_idn > 0)
        {
            //Delete details
            $where = array("ProductAssembly_Idn" => $assembly_idn);
            $table_name = "ProductAssemblyDetails";

            if ($this->m_reference_table->delete($table_name, $where)) //Delete details
            {
                $table_name = "ProductAssemblies";
                if ($this->m_reference_table->delete($table_name, $where)) //Delete assembly
                {
                    $delete = true;
                }
                else
                {
                    write_feci_log("Error deleting from ProductAssembly table ({$assembly_idn}");
                }
            }
            else
            {
                write_feci_log("Error deleting from ProductAssemblyDetails table ({$assembly_idn}");
            }
        }

        return $delete;
    }

    /**
     * Summary of get_assembly_details, return HTML
     * @param mixed $assembly_idn 
     */
    function get_assembly_details($assembly_idn)
    {
        $html = "";
        $details = array();

        if ($assembly_idn > 0)
        {
            //Get assembly details data and load view
            $details = $this->m_reference_table->get_where("ProductAssemblyDetails", array("ProductAssembly_Idn" => $assembly_idn));

            $html = $this->load->view("worksheet/assembly_details", array("details" => $details), true);
        }
        else
        {
            $html = "No details.";
        }

        echo $html;
    }

    /**
     * Summary of get_adjustment_sub_factors
     * 
     * Get AdjustmentSubFactors and story in multi-dimensional array that is grouped by AdjustmentFactor_Idn
     */
    function get_adjustment_sub_factors()
    {
        $adjustment_sub_factors = array();
        $temp = array();
        $adjustment_factor_idn = 0;

        $temp = $this->m_reference_table->get_where("AdjustmentSubFactors", "ActiveFlag = 1", "AdjustmentFactor_Idn, Rank");

        foreach($temp as $row)
        {
            if ($adjustment_factor_idn != $row['AdjustmentFactor_Idn'])
            {
                $adjustment_factor_idn = $row['AdjustmentFactor_Idn'];
            }

            $adjustment_sub_factors[$adjustment_factor_idn][] = $row;
        }

        echo json_encode($adjustment_sub_factors);
    }

    /**
     * Summary of add_adjustment_factor
     * 
     * Method returns JSON with HTML to display adjustment factor row on worksheet
     * @param mixed $worksheet_idn 
     * @param mixed $num_cols
     */
    function add_adjustment_factor($worksheet_idn, $num_cols, $worksheet_master_idn)
    {
        $results = array(
            "html" => ""
            );

        if ($worksheet_idn > 0)
        {
            $rank = 0;
            $insert_data = array();
            $factor_data = array();
            $insert = false;
            $adjustment_factor_worksheet_master_idn = ($worksheet_master_idn == 2) ? 2 : 4;
            //Determine rank
            $rank = $this->m_worksheet->get_next_adjustment_factor_rank($worksheet_idn);

            //Load insert data
            $insert_data = array(
                "Worksheet_Idn" => $worksheet_idn,
                "Rank" => $rank
            );

            //Insert data
	        $insert = $this->m_worksheet->insert_worksheet_factor_details($insert_data);

            if ($insert)
            {
                //Prep data for view
                $factor_data['Row'] = $insert_data;
                $factor_data['Row']['AdjustmentFactor_Idn'] = 0;
                $factor_data['Row']['AdjustmentFactors'] = get_adjustment_factors($adjustment_factor_worksheet_master_idn, $rank);
                $factor_data['Row']['RowType'] = "AdjustmentFactor";
                $factor_data['Row']['Add'] = 1;
                $factor_data['worksheet_master']['NumberOfColumns'] = $num_cols;

                //Get HTML
                $results['html'] = $this->load->view("worksheet/adjustment_factor_row", $factor_data, true);
            }
        }

        echo json_encode($results);
    }

    function save_engineering_adjustment_factors($worksheet_idn)
    {
        $results = array(
            "deletes" => array(),
            "inserts" => array(),
            "errors" => 0
            );
        $worksheet_factor_details = array();
        $worksheet_sub_factor_idns = array();
        $ui_adjustment_factors = array();
        $adjustment_factors = array();
        $insert_data = array();
        $rank = 1;

        $post = $this->input->post(null, true);
        
        if($post['Ajax'] && $worksheet_idn > 0)
        {
            //Adjustment factors from UI
            if (isset($post['SelectedAdjustmentFactors']))
            {
                $ui_adjustment_factors = $post['SelectedAdjustmentFactors'];
            }

            $adjustment_factors = $post['AdjustmentFactors'];

            //Get worksheet factor details
            $worksheet_factor_details = $this->m_reference_table->get_where("WorksheetFactorDetails", "Worksheet_Idn = {$worksheet_idn}","Rank ASC");

            foreach($worksheet_factor_details as $wfd)
            {
                $worksheet_sub_factor_idns[] = $wfd['AdjustmentSubFactor_Idn'];
            }

            //Find deletes and inserts
            foreach($adjustment_factors as $af)
            {
                //Find Deletes
                if (in_array($af['AdjustmentSubFactor_Idn'], $worksheet_sub_factor_idns) && !in_array($af['AdjustmentSubFactor_Idn'], $ui_adjustment_factors))
                {
                    if ($this->m_reference_table->delete("WorksheetFactorDetails", "Worksheet_Idn = {$worksheet_idn} AND AdjustmentSubFactor_Idn = {$af['AdjustmentSubFactor_Idn']}"))
                    {
                        $results['deletes'][] = $af['AdjustmentSubFactor_Idn'];
                    }
                    else
                    {
                        $results['errors']++;
                    }
                }
                else if(in_array($af['AdjustmentSubFactor_Idn'], $ui_adjustment_factors) && !in_array($af['AdjustmentSubFactor_Idn'], $worksheet_sub_factor_idns))
                {
                    //Load insert data
                    $insert_data = array(
                        "Worksheet_Idn" => $worksheet_idn,
                        "AdjustmentSubFactor_Idn" => $af['AdjustmentSubFactor_Idn'],
                        "Rank" => $rank
                    );

                    //Insert data
                    if ($this->m_worksheet->insert_worksheet_factor_details($insert_data))
                    {
                        $insert_data['Name'] = $af['Name'];
                        $insert_data['Value'] = $af['Value'];
                        $results['inserts'][] = array("Rank" => $rank, "Html" => $this->load->view("worksheet/eng/engineering_adjustment_factor_row", array("Row" => $insert_data), true));
                    }
                    else
                    {
                        $results['errors']++;
                    }
                }

                $rank++;
            }
        }

        echo json_encode($results);
    }

    /**
     * Summary of get_worksheet_engineering_adjustment_factors
     * @param mixed $worksheet_idn 
     */
    function get_worksheet_engineering_adjustment_factors($worksheet_idn)
    {
        echo json_encode($this->m_reference_table->get_where("WorksheetFactorDetails", "Worksheet_Idn = {$worksheet_idn}", "Rank ASC"));
    }

    /**
     * Summary of save_engineering_additional_costs
     * @param mixed $worksheet_idn 
     */
    function save_engineering_additional_costs($worksheet_idn)
    {
        $results = array(
            "deletes" => array(),
            "inserts" => array(),
            "errors" => 0
            );
        $worksheet_additional_costs = array(); //Currently in database
        $worksheet_additional_costs_idns = array();
        $ui_additional_costs = array(); //Currently on UI
        $additional_costs = array(); //All additional costs
        $children = array();
        $insert_data = array();
        $rank = 1;

        $post = $this->input->post(null, true);
        
        if($post['Ajax'] && $worksheet_idn > 0)
        {
            //Adjustment factors from UI
            if (isset($post['SelectedAdditionalCosts']))
            {
                $ui_additional_costs = $post['SelectedAdditionalCosts'];
            }

            $additional_costs = $post['AdditionalCosts'];

            //Get worksheet factor details
            $worksheet_additional_costs = $this->m_reference_table->get_where("WorksheetEngineeringAdditionalCosts", "Worksheet_Idn = {$worksheet_idn}");

            foreach($worksheet_additional_costs as $wac)
            {
                $worksheet_additional_costs_idns[] = $wac['AdditionalCost_Idn'];
            }

            //Find deletes and inserts
            foreach($additional_costs as $ac)
            {
                //Get children
                $children = $this->m_reference_table->get_where("EngineeringAdditionalCosts", "Parent_Idn = {$ac['AdditionalCost_Idn']}","Rank ASC");

                //Find Deletes
                if (in_array($ac['AdditionalCost_Idn'], $worksheet_additional_costs_idns) && !in_array($ac['AdditionalCost_Idn'], $ui_additional_costs))
                {
                    if ($this->m_reference_table->delete("WorksheetEngineeringAdditionalCosts", "Worksheet_Idn = {$worksheet_idn} AND AdditionalCost_Idn = {$ac['AdditionalCost_Idn']}"))
                    {
                        $results['deletes'][] = $ac['AdditionalCost_Idn'];

                        //Delete children
                        if (!empty($children))
                        {
                            foreach($children as $child)
                            {
                                if ($this->m_reference_table->delete("WorksheetEngineeringAdditionalCosts", "Worksheet_Idn = {$worksheet_idn} AND AdditionalCost_Idn = {$child['EngineeringAdditionalCost_Idn']}"))
                                {
                                    $results['deletes'][] = $child['EngineeringAdditionalCost_Idn'];
                                }
                                else
                                {
                                    $results['errors']++;
                                }
                            }
                        }
                    }
                    else
                    {
                        $results['errors']++;
                    }
                }
                else if(in_array($ac['AdditionalCost_Idn'], $ui_additional_costs) && !in_array($ac['AdditionalCost_Idn'], $worksheet_additional_costs_idns))
                {
                    //Load insert data
                    $insert_data = array(
                        "Worksheet_Idn" => $worksheet_idn,
                        "AdditionalCost_Idn" => $ac['AdditionalCost_Idn'],
                        "Quantity" => $ac['Quantity'],
                        "FieldManHours" => $ac['ManHours']
                    );

                    //Insert data
                    if ($this->m_worksheet->insert_engineering_additional_costs($insert_data))
                    {
                        $view = "worksheet/eng/engineering_additional_costs_row";
                        $insert_data['Name'] = $ac['Name'];
                        $insert_data['DefaultFlag'] = $ac['DefaultFlag'];
                        $insert_data['Parent_Idn'] = 0;
                        $insert_data['Rank'] = $ac['Rank'];
                        $results['inserts'][] = array("Rank" => $ac['Rank'], "Html" => $this->load->view($view, array("Row" => $insert_data), true));

                        //Check to see if there are children items
                        if (!empty($children))
                        {
                            foreach($children as $child)
                            {
                                //Load insert data
                                $insert_data = array(
                                    "Worksheet_Idn" => $worksheet_idn,
                                    "AdditionalCost_Idn" => $child['EngineeringAdditionalCost_Idn'],
                                    "Quantity" => $child['Quantity'],
                                    "FieldManHours" => $child['ManHours']
                                );

                                if ($this->m_worksheet->insert_engineering_additional_costs($insert_data))
                                {
                                    $insert_data['Name'] = $child['Name'];
                                    $insert_data['DefaultFlag'] = $child['DefaultFlag'];
                                    $insert_data['Parent_Idn'] = $child['Parent_Idn'];
                                    $insert_data['Rank'] = $child['Rank'];
                                    $results['inserts'][] = array("Rank" => $child['Rank'], "Html" => $this->load->view($view, array("Row" => $insert_data), true));
                                }
                                else
                                {
                                    $results['errors']++;
                                }
                            }
                        }
                    }
                    else
                    {
                        $results['errors']++;
                    }
                }

                $rank++;
            }
        }

        echo json_encode($results);

    }

	function get_eq_braces($job_number)
	{
		$html = "";

		$html = '<div>'.get_eq_braces($job_number).'</div>';
		$html .= '<div>Add additional braces from Other Work and Standpipes worksheets</div>';

		echo $html;
    }
    
    function get_eq_braces_data($job_number)
    {
        echo get_eq_braces_data($job_number);
    }

    function save_area_name()
    {
        $results = array(
            "return_code" => 0,
            "post" => array()
        );

        $post = $this->input->post();

        if (isset($post['pk']) && $post['pk'] > 0)
        {
            $set = array(
                "Name" => $post['value']
            );
            $where = array(
                "WorksheetArea_Idn" => $post['pk']
            );

            $results['return_code'] = ($this->m_reference_table->update("WorksheetAreas", $set, $where)) ? 1 : -1;
        }

        $results['post'] = $post;

        echo json_encode($results);
    }

    function parse_worksheet_categories()
    {
        $data = array();

        //$select = "wc.Name, wc.ShortName, wc.FieldUnitPrice, wc.CartFlag, wc.IsFitting, wc.IsShared, wc.IsAssembly, wc.ActiveFlag";
        $select = "*";
        $from = "WorksheetCategories AS wc";
        $where = array("wc.ActiveFlag" => 1);
        $this->db
            ->select($select)
            ->from($from)
            ->where($where);
     //       ->join("WorksheetMasterCategories AS wmc","wmc.WorksheetCategory_Idn = wc.WorksheetCategory_Idn","left")
       //     ->join("WorksheetMasters AS wm","wm.WorksheetMaster_Idn = wmc.WorksheetMaster_Idn");
        
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
                    $department = get_department_by_worksheet_category($row['WorksheetCategory_Idn']);
                    $data[] = array(
                        "name" => $row['Name'],
                        "shortName" => ($row['ShortName'] == null) ? "" : $row['ShortName'],
                        "fieldUnitPrice" => ($row['FieldUnitPrice'] == 0) ? 0 : $row['FieldUnitPrice'],
//                        "cartFlag" => ($row['CartFlag'] == 1) ? true : false,
                        "isFitting" => ($row['IsFitting'] == 1) ? true : false,
                        "isShared" => ($row['IsShared'] == 1) ? true : false,
                        "isAssembly" => ($row['IsAssembly'] == 1) ? true : false,
                        "isActive" => true,
//                        "rank" => ($row['Rank'] == null) ? 0 : $row['Rank'],
//                        "autoLoadFlag" => ($row['AutoLoadFlag'] == 1) ? true : false,
//                        "loadFlag" => ($row['LoadFlag'] == 1) ? true : false,
//                        "addMiscFlag" => ($row['AddMiscFlag'] == 1) ? true : false,
                        "department" => ($department == 1) ? "Special Hazard" : "Sprinkler",
                    );
                }
            }
        }

        echo json_encode($data);
    }
}
/* End of file worksheet_controller.php */
/* Location: ./application/controllers/job.php */