<?php
class M_worksheet extends CI_Model {
	
	private $_table_name = 'Worksheets';

    function __construct()
    {
        parent::__construct();

        $this->load->model("m_worksheet_detail");
        $this->load->library("rfp_lib");
    }

    /*
     * get_worksheet_by_idn
     *
     * Get worksheet
     *
     * @param   $w_id(mixed)
     * @return  $data(array)
     */
    
    function get_worksheet_by_idn($w_id)
    {
        //Delcare and initialize variables
		$data = array();
        $query = false;
		
		$query = $this->db->get_where('Worksheets', array('Worksheet_Idn' => $w_id));
		
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
            if($query->num_rows() > 0)
		    {
			    foreach ($query->result_array() as $row)
			    {
				    $data = $row;
			    }
		    }
        }

        return $data;
    }
    
    
	/**
	 * get_by_job_number
	 *
	 * Gets all columns from Worksheets table by Job_Idn and ChangeOrder
	 *
     * @access  public
	 * @param 	$job_number(string)
	 * @param	$order_by(string)
	 * @return 	$worksheets(array)
	 */
	
	public function get_by_job_number($job_number, $order_by="")
	{
		//Delcare and initialize variables
		$worksheets = array();
		$job_keys = array();
		$where = array();
        $query = false;
		
		//Get job_keys
		$job_keys = get_job_keys($job_number);
		
		$where = array(
			'Job_Idn' => $job_keys[0], 
			'ChangeOrder' => $job_keys[1]
		);
		
		$this->db
			->select('*')
			->from('Worksheets')
			->where($where);
			
		if (!empty($order_by))
		{
			$this->db->order_by($order_by);	
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
			    foreach ($query->result_array() as $row)
			    {
				    $worksheets[] = $row;
			    }
		    }
        }

		return $worksheets;
	}
	
	/**
     * get_idn_by
     *
     * Get worksheet_idn by the $where parameter passed into method
     *
     * @access  public
     * @param 	$where(array)
     * @return 	integer
     */
	
	public function get_idn_by($where)
	{
		//Delcare and initialize variables
        $query = false;
        $idn = 0;
		
		$this->db
			->select('Worksheet_Idn')
			->from('Worksheets')
			->where($where);
        
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
				    $idn = $row['Worksheet_Idn'];
			    }
		    }
        }

		return $idn;
	}

    /**
	 * insert
	 *
	 * Inserts record into table
	 *
     * @access  public
	 * @param 	$data(array)
	 * @return 	$new_idn(int)
	 */
	
	public function insert($data)
	{
		//Declare and Initialize variables
		$new_idn = 0;
		
		//Insert row
		if ($this->db->insert($this->_table_name,$data))
        {
		    //Get new idn
		    $new_idn = $this->db->insert_id();
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));       
        }
		
		return $new_idn;
	}

	/**
	 * get_worksheet_details
	 *
	 * Gets all columns from WorksheetDetails table by Worksheet_Idn
	 *
     * @access  public
	 * @param 	$worksheet_idn(int)
	 * @return 	$worksheet_details(array)
	 */
	
	public function get_worksheet_details($worksheet_idn)
	{
		//Delcare and initialize variables
		$worksheet_details = array();
        $query = false;
		
		$query = $this->db->get_where('WorksheetDetails', array('Worksheet_Idn' => $worksheet_idn));
		
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
				    $worksheet_details[] = $row;
			    }
		    }
        }
		
		return $worksheet_details;
	}
	
	/**
     * get_worksheet_details_extended
     *
     * Gets extended product data for worksheet_details table by Worksheet_Idn with optional select and order by arguments. 
     * Returns a multi-dimensional array by WorksheetCategory_Idn which is sorted by Rank from WorksheetMasterCategories table.
     *
     * @access  public
     * @param 	number ($worksheet_idn)
     * @param   number ($worksheet_master_idn) 
     * @param   array (order_by)
     * @return 	array ($worksheet_details)
     */
	
	public function get_worksheet_details_extended($worksheet_idn, $worksheet_master_idn, $select = array(), $where = array(), $order_by = array())
	{
		//Delcare and initialize variables
		$worksheet_details = array();
        $query = false;
        $select_defaults = array();
        $sql_select = "";
        $select_merge = array();
        $sql_order_by = "";
        $i = 0;
		
        $select_defaults = array(
            "wd.*", 
            "p.WorksheetCategory_Idn",
            "wc.Rank AS WorksheetCategoryRank",
            "p.Name AS Name", 
            "p.Description AS Description",
            //"p.Rank AS ProductRank", 
            "p.DomesticFlag", 
            "p.FieldUnitPrice AS ProductFieldUnitPrice", 
            "p.MaterialUnitPrice AS ProductMaterialPrice",
            "p.ShopUnitPrice AS ProductShopUnitPrice",
            "p.EngineerUnitPrice AS ProductDesignUnitPrice",
            "p.Description AS ProductDescription",
            "p.ActiveFlag AS ActiveFlag",
            "p.LoadFlag AS LoadFlag",
            "p.AutoLoadFlag AS AutoLoadFlag",
            "p.ProductSize_Idn",
            "p.ApplyToAdjustmentFactorsFlag",
            "p.HeadType_Idn",
            "p.ScheduleType_Idn",
            "p.Fitting_Idn",
            "p.HangerType_Idn",
            "wm.DisplayShopHours",
            "p.RFP",
        );

        //Load model
        $this->load->model("m_worksheet_master");

        //Get categories for worksheet master
        $categories = $this->m_worksheet_master->get_categories($worksheet_master_idn);
        $category_data = get_category_sorting_data();
        $category_order_by = array();
        $category_joins = array();
        $category_select = array();

        //Build Select Statement
        //If $select array argument has data, merge $select and $select_defaults arrays before converting to comma separated string for db query
        if (empty($select))
        {
            $select_merge = $select_defaults;
        }
        else
        {
            $select_merge = array_merge($select_defaults, $select);
        }

        //Build Where statement
        if (empty($where))
        {
            $where = array(
                'Worksheet_Idn' => $worksheet_idn,
                'wc.WorksheetMaster_Idn' => $worksheet_master_idn
            );
        }

        foreach($categories as $category)
        {
            //Add category specific feilds to Select statement
            $category_select = (isset($category_data['WorksheetCategory'.$category['WorksheetCategory_Idn']]['Select'])) ? $category_data['WorksheetCategory'.$category['WorksheetCategory_Idn']]['Select'] : array();

            if (!empty($category_select))
            {
                $sql_select = implode(",", array_merge($select_merge, $category_select));
            }
            else
            {
                $sql_select = implode(",", array_merge($select_merge, $category_data['Default']['Select']));
            }

            //Begin to build query
            $this->db
                ->select($sql_select)
                ->from('WorksheetDetails AS wd')
                ->join('Products AS p','wd.Product_idn = p.Product_Idn', 'left')
                ->join('ProductSizes AS s', 'p.ProductSize_Idn = s.ProductSize_Idn', 'left')
                ->join('WorksheetMasterCategories AS wc','wc.WorksheetCategory_Idn = p.WorksheetCategory_Idn', 'left')
                ->join("WorksheetMasters AS wm", "wm.WorksheetMaster_Idn = wc.WorksheetMaster_Idn", "left");

            //check for join statements
            $category_joins = (isset($category_data['WorksheetCategory'.$category['WorksheetCategory_Idn']]['Joins'])) ? $category_data['WorksheetCategory'.$category['WorksheetCategory_Idn']]['Joins'] : array();

            if (!empty($category_joins))
            {
                foreach($category_joins as $join)
                {
                    $this->db->join($join['Table'], $join['On'], $join['Type']);
                }
            }

            //Where statement
            $where['wc.WorksheetCategory_Idn'] = $category['WorksheetCategory_Idn'];
            $this->db->where($where);

            //Build order by statement
            $category_order_by = (isset($category_data['WorksheetCategory'.$category['WorksheetCategory_Idn']]['OrderBy'])) ? $category_data['WorksheetCategory'.$category['WorksheetCategory_Idn']]['OrderBy'] : array();

            if (empty($category_order_by))
            {
                $category_order_by = $category_data['Default']['OrderBy'];
            }
            $order_by = $category_order_by;

            //Order By statement
            $sql_order_by = implode(",", $order_by);
            $this->db->order_by($sql_order_by);
            
            //Execute query
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
                        //Add Type
                        $row['RowType'] = "Product";

                        //Is new (1) or product updated (2) rfp exception
                        $row['IsRFPException'] = $this->rfp_lib->is_worksheet_detail_exception($worksheet_idn, $row['Product_Idn'], array(1,2));

                        //Add Category Product Rank
                        $category_product_rank = "";
                        if (!empty($category_order_by))
                        {
                            foreach($category_order_by as $o)
                            {
                                $category_product_rank .= format_for_rank($row[$o]);
                            }
                        }
                        
                        $row['CategoryProductRank'] = $category_product_rank;
                        $row['CategoryName'] = $category['Name'];

						//Accesories head types don't cound has heads
						if ($row['HeadType_Idn'] == 4)
						{
							$row['CategoryName'] = "Accessory";
						}

                        //Additional fields to match MiscellaneousDetails table
                        $row['IsMiscellaneousDetail'] = 0;
                        $row['IsHead'] = ($row['HeadType_Idn'] > 0 && $row['HeadType_Idn'] != 4) ? 1 : 0; //Accessories head types don't count as heads
                        $row['ProductAssembly_Idn'] = 0;
                        $row['LineNum'] = 0;
                        $row['MaterialMarkUp'] = 0;
                        $row['FieldMarkUp'] = 0;
                        $row['ShopMarkUp'] = 0;
                        $row['EngineerMarkUp'] = 0;
                        $row['FinishWork_Idn'] = 0;
                        $row['WorksheetArea_Idn'] = 0;
                        $row['IsChildWorksheet'] = 0;

                        $worksheet_details[$row['WorksheetCategory_Idn']][] = $row;
                    }
                }
            }
        }
		
		return $worksheet_details;
	}

    /**
     * get_miscellaneous_details_extended
     *
     * Gets extended miscellaneous product data from miscellaneous_details table by Worksheet_Idn with optional where and order by arguments. 
     * Returns a multi-dimensional array by WorksheetCategory_Idn which is sorted by Rank from WorksheetMasterCategories table.
     *
     * @access  public
     * @param 	number  $worksheet_idn
     * @param   array   $where
     * @param   array   $order_by
     * @return 	array
     */
	
	public function get_miscellaneous_details_extended($worksheet_idn, $where = array(), $order_by = array())
	{
		//Delcare and initialize variables
		$miscellaneous_details = array();
        $query = false;
        $sql_order_by = "";
		
        if (empty($where))
        {
            $where = array(
                'Worksheet_Idn' => $worksheet_idn
            );
        }

		$this->db
			->select('md.*, wc.Rank AS WorksheetCategoryRank')
			->from('MiscellaneousDetails AS md')
            ->join('WorksheetMasterCategories AS wc','wc.WorksheetCategory_Idn = md.WorksheetCategory_Idn', 'left')
			->where($where);

        //Default order by to WorksheetMasterCategory rank, then MiscellaneousDetail LineNum
        $sql_order_by = (empty($order_by)) ? "wc.Rank ASC, md.LineNum ASC" : implode(",", $order_by);

        $this->db->order_by($sql_order_by);
        
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
                    //Row type
                    $row['RowType'] = "Miscellaneous";

                    //Additional fields to match MiscellaneousDetails table
                    $row['IsMiscellaneousDetail'] = 1;
                    $row['Product_Idn'] = $row['MiscellaneousDetail_Idn'];
                    $row['CategoryProductRank'] = $row['LineNum'];
                    $row['Description'] = "";
                    $row['ActiveFlag'] = 1;
                    $row['ProductSize_Idn'] = 0;
                    $row['ApplyToAdjustmentFactorsFlag'] = 0;
                    $row['IsChildWorksheet'] = 0;

                    if ($query->num_rows() == 1)
                    {
                        $miscellaneous_details[$row['WorksheetCategory_Idn']][] = $row;
                    }
                    else
                    {
                        $miscellaneous_details[$row['WorksheetCategory_Idn']][] = $row;
                    }
			    }
		    }
        }
		
		return $miscellaneous_details;
	}

    
    public function get_child_worksheet_details($worksheet_master_idn = 0, $job_number = "", $worksheet_idn)
    {
        //Delcare and initialize variables
        $child_worksheet_details = array();
        $child_worksheet_idns = array();
        $worksheet_category_idn = 0;
        $job_keys = array();

        if ($worksheet_master_idn > 0 && !empty($job_number))
        {
            $job_keys = get_job_keys($job_number);

            $child_worksheet_idns = $this->get_child_worksheet_idns($job_keys, $worksheet_master_idn);

            foreach ($child_worksheet_idns as $child_worksheet_idn)
            {
                //$w = new Worksheet(array("w_id" => $child_worksheet_idn));
                $child_instance = "child".$child_worksheet_idn;
                $this->load->library('worksheet', array("w_id" => $child_worksheet_idn), $child_instance);
                $w = $this->$child_instance;

                $w->get_totals($child_worksheet_idn);

                //Get worksheet category
                $worksheet_category_idn = $this->get_worksheet_category_idn($worksheet_idn, $child_worksheet_idn);

                $row = $w->w;

                $row['RowType'] = "Worksheet";
                $row['CategoryProductRank'] = $w->w['Rank'];
                $row['WorksheetCategory_Idn'] = $worksheet_category_idn;
                $row['Product_Idn'] = $child_worksheet_idn;
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

                $child_worksheet_details[$worksheet_category_idn][$child_worksheet_idn] = $row;
            }
        }

        return $child_worksheet_details;
    }

  /**
	 * insert_worksheet_details
	 *
	 * Inserts record into table
	 *
     * @access  public
	 * @param 	array   $worksheet_details_data
	 * @return 	bool
	 */
	
	public function insert_worksheet_details($worksheet_details_data)
	{
		//Insert row
        return $this->m_worksheet_detail->insert($worksheet_details_data);
	}

	/**
	 * get_factor_details_by_worksheet_idn
	 *
	 * Gets all columns from WorksheetFactorDetails table by Worksheet_Idn
	 *
     * @access
	 * @param 	$worksheet_idn(int)
	 * @return 	$worksheet_factors(array)
	 */
	
	public function get_factor_details_by_worksheet_idn($worksheet_idn)
	{
		//Delcare and initialize variables
		$worksheet_factors = array();
		$query = false;
        
		$query = $this->db->get_where('WorksheetFactorDetails', array('Worksheet_Idn' => $worksheet_idn));
		
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
				    $worksheet_factors[] = $row;
			    }
		    }
        }
		
		return $worksheet_factors;
	}	
	
	/**
	 * insert_worksheet_factor_details
	 *
	 * Inserts record into table
	 *
     * @access  public
	 * @param 	$worksheet_factor_details_data(array)
	 * @return 	bool
	 */
	
	public function insert_worksheet_factor_details($worksheet_factor_details_data)
	{
		//Insert row
		if ($this->db->insert('WorksheetFactorDetails',$worksheet_factor_details_data))
        {
            return true;
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            
            return false;
        }
	}
	
	/**
	 * get_worksheet_parms_by_worksheet_idn
	 *
	 * Gets all columns from WorksheetParms table by Worksheet_Idn
	 *
     * @access  public
	 * @param 	$worksheet_idn(int)
	 * @return 	$worksheet_parms(array)
	 */
	
	public function get_worksheet_parms_by_worksheet_idn($worksheet_idn)
	{
		//Delcare and initialize variables
		$worksheet_parms = array();
        $query = false;
		
		$query = $this->db->get_where('WorksheetParms', array('Worksheet_Idn' => $worksheet_idn));
        
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
				    $worksheet_parms[] = $row;
			    }
		    }
        }
		
		return $worksheet_parms;
	}	
	
	/**
	 * insert_worksheet_factor_details
	 *
	 * Inserts record into table
	 *
     * @access  public
	 * @param 	$worksheet_parms_data(array)
	 * @return 	bool
	 */
	
	public function insert_worksheet_parms($worksheet_parms_data)
	{
		//Insert row
		if ($this->db->insert('WorksheetParms',$worksheet_parms_data))
        {
            return true;
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            
            return false;
        }
	}
	
	/**
	 * get_miscellaneous_details
	 *
	 * Gets all columns from MiscellaneousDetails table by Worksheet_Idn
	 *
     * @access  public
	 * @param 	$worksheet_idn(int)
	 * @return 	$miscellaneous_details(array)
	 */
	
	public function get_miscellaneous_details($worksheet_idn)
	{
		//Delcare and initialize variables
		$miscellaneous_details = array();
        $query = false;
		
		$query = $this->db->get_where('MiscellaneousDetails', array('Worksheet_Idn' => $worksheet_idn));
		
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
				    $miscellaneous_details[] = $row;
			    }
		    }
        }
		
		return $miscellaneous_details;
	}	
	
	/**
	 * insert_miscellaneous_details
	 *
	 * Inserts record into table
	 *
     * @access  public
	 * @param 	$miscellaneous_details_data(array)
	 * @return 	bool
	 */
	
	public function insert_miscellaneous_details($miscellaneous_details_data)
	{
		//Insert row
		if ($this->db->insert('MiscellaneousDetails',$miscellaneous_details_data))
        {
            return true;
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            
            return false;
        }
	}
	
	/**
	 * get_basic_appropriation_details_by_worksheet_idn
	 *
	 * Gets all columns from WorksheetBasicAppropriationDetails table by Worksheet_Idn
	 *
     * @access  public
	 * @param 	$worksheet_idn(int)
	 * @return 	$basic_appropriations(array)
	 */
	
	public function get_basic_appropriation_details_by_worksheet_idn($worksheet_idn)
	{
		//Delcare and initialize variables
		$basic_appropriations = array();
        $query = false;
		
		$query = $this->db->get_where('WorksheetBasicAppropriationDetails', array('Worksheet_Idn' => $worksheet_idn));
		
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
				    $basic_appropriations[] = $row;
			    }
		    }
        }
		
		return $basic_appropriations;
	}	
	
	/**
	 * insert_basic_appropriation_details
	 *
	 * Inserts record into table
	 *
     * @access  public
	 * @param 	$basic_appropriations_data(array)
	 * @return 	bool
	 */
	
	public function insert_basic_appropriation_details($basic_appropriations_data)
	{
		//Insert row
		if ($this->db->insert('WorksheetBasicAppropriationDetails',$basic_appropriations_data))
        {
            return true;
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            
            return false;
        }
	}
	
	/**
	 * get_engineering_additional_costs_by_worksheet_idn
	 *
	 * Gets all columns from WorksheetEngineeringAdditionalCosts table by Worksheet_Idn
	 *
     * @access  public
	 * @param 	$worksheet_idn(int)
	 * @return 	$additional_costs(array)
	 */
	
	public function get_engineering_additional_costs_by_worksheet_idn($worksheet_idn)
	{
		//Delcare and initialize variables
		$additional_costs = array();
        $query = false;

        $this->db
            ->select("weac.*, eac.Name, eac.Rank, eac.DefaultFlag, eac.Parent_Idn")
            ->from("WorksheetEngineeringAdditionalCosts AS weac")
            ->join("EngineeringAdditionalCosts AS eac","weac.AdditionalCost_Idn = eac.EngineeringAdditionalCost_Idn", "left")
            ->where(array('Worksheet_Idn' => $worksheet_idn))
            ->order_by("Rank ASC");

		$query = $this->db->get();
		//$query = $this->db->get_where('WorksheetEngineeringAdditionalCosts', array('Worksheet_Idn' => $worksheet_idn));
		
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
                    $additional_costs[] = $row;
                }
            }
        }
		
		return $additional_costs;
	}	
	
	/**
	 * insert_engineering_additional_costs
	 *
	 * Inserts record into table
	 *
     * @access  public
	 * @param 	$additional_costs_data(array)
	 * @return 	bool
	 */
	
	public function insert_engineering_additional_costs($additional_costs_data)
	{
		//Insert row
		if ($this->db->insert('WorksheetEngineeringAdditionalCosts',$additional_costs_data))
        {
            return true;
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            
            return false;
        }
	}

	/**
	 * update_basic_appropriations_details
	 *
	 * Update WorksheetBasicAppropriationDetails
	 *
     * @access  public
	 * @param 	$update(array) fields and values to update
	 * @param 	$where(array) where fields and values
	 * @return 	bool
	 */
	
	public function update_basic_appropriations_details($update, $where = array())
	{
		//Set where statement if array contains data
		if (!empty($where))
		{
			$this->db->where($where);
		}
		
		//Update table
		if ($this->db->update('WorksheetBasicAppropriationDetails', $update))
        {
            return true;
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            
            return false;
        }
	}
    
    /**
     * get_worksheet_totals
     *
     * Calculates the material, field hours, shop hours and engineer hours for each WorksheetDetails and MiscellaneousDetails record.
     *
     * @access  public
     * @param   $w_id(integer)
     * @return  $totals(array)
     */
    
    function get_worksheet_totals($w_id)
    {
        //Delcare and initialize variables
        $sql = "";
        $query = false;
        $totals = array();
        
        $sql = "SELECT 
	                WorksheetColumn_Idn,
	                SUM(Quantity * MaterialUnitPrice) AS material,
	                SUM(Quantity * FieldUnitPrice) AS field_hours,
	                SUM(Quantity * ShopUnitPrice) AS shop_hours,
	                SUM(Quantity * EngineerUnitPrice) AS engineering_hours
                FROM WorksheetDetails AS wd
                WHERE Worksheet_Idn = {$w_id}
                GROUP BY WorksheetColumn_Idn
                UNION
                SELECT 
	                WorksheetColumn_Idn,
	                SUM(Quantity * MaterialUnitPrice) AS material,
	                SUM(Quantity * FieldUnitPrice) AS field_hours,
	                SUM(Quantity * ShopUnitPrice) AS shop_hours,
	                SUM(Quantity * EngineerUnitPrice) AS engineering_hours
                FROM MiscellaneousDetails AS md
                WHERE Worksheet_Idn = {$w_id}
                GROUP BY WorksheetColumn_Idn";

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
                    $totals[] = $row;
                }
            }
        }

        return $totals;
    }
    
    /**
     * get_heads
     *
     * Get number heads from WorksheetDetails and MiscellaneousDetails tables.
     *
     * @access  public
     * @param   $w_id(integer)
     * @return  array
     */
    
    function get_heads($w_id)
    {
        //Delcare and initialize variables
        $sql = "";
        $query = false;
        $data = array();
        
        //Get heads from WorksheetDetails and MiscellaneousDetails tables
        $sql = "SELECT 
	                Worksheet_Idn,
	                1 AS IsHead,
	                SUM(Quantity) AS num_heads
                FROM WorksheetDetails AS wd,
	                Products AS p
                WHERE wd.Product_Idn = p.Product_Idn
	                AND Worksheet_Idn = {$w_id}
	                AND WorksheetCategory_Idn = 92
	                AND p.CoverageType_Idn <> 8
                GROUP BY Worksheet_Idn
                UNION
                SELECT 
	                Worksheet_Idn,
	                IsHead,
	                SUM(Quantity) AS num_heads
                FROM MiscellaneousDetails AS md
                WHERE Worksheet_Idn = {$w_id}
	                AND WorksheetCategory_Idn = 92
	                AND IsHead = 1
                GROUP BY Worksheet_Idn, IsHead";
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
                    $data[] = $row;
                }
            }
        }    
        
        return $data;
    }
    
    /**
     * get_labor_class_adjustments
     *
     * WhatFunctionDoes...
     *
     * @access  public
     * @param   $w_id(integer)
     * @return  array
     */
    
    function get_labor_class_adjustments($w_id)
    {
        //Delcare and initialize variables
        $sql = "";
        $query = false;
        $data = array();
        
        $sql = "SELECT wfd.AdjustmentSubFactor_Idn, asf.Value
                FROM WorksheetFactorDetails AS wfd
                LEFT JOIN AdjustmentSubFactors as asf ON (wfd.AdjustmentSubFactor_Idn = asf.AdjustmentSubFactor_Idn)
                WHERE Worksheet_Idn = {$w_id}
                AND asf.AdjustmentFactor_Idn = 21";
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
                    $data = $row;
                }
            }
        }    
        
        return $data;
    }
    
    /**
     * get_child_worksheets_idns
     *
     * Get the worksheet_idns for all child worksheets by Job_Idn, ChangeOrder and WorksheetMaster_Idn
     *
     * @access  public
     * @param   $job_keys(array)
     * @param   $worksheet_master_idn(integer)
     * @return  array of objects
     */
    
    function get_child_worksheet_idns($job_keys, $worksheet_master_idn)
    {
        //Delcare and initialize variables
        $data = array();
        $sql = "";
        $query = false;
        
        if ($job_keys[0] > 0 && $worksheet_master_idn > 0)
        {
            $sql = "SELECT Worksheet_Idn
				    FROM v_WorksheetMasterCategories AS c
				    JOIN Worksheets AS w ON (w.WorksheetMaster_Idn = c.ChildWorksheetMaster_Idn)
				    WHERE c.WorksheetMaster_Idn = {$worksheet_master_idn} 
					    AND c.ChildWorksheetMaster_Idn > 0
					    AND w.Job_Idn = {$job_keys[0]}
					    AND w.ChangeOrder = {$job_keys[1]}
                    ORDER BY ChildWorksheetMaster_Idn, w.Rank";
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
                        //Get worksheet_idn
                        $data[] = $row['Worksheet_Idn'];
                    }
                }
            }
        }
                
        return $data;
    }

    /**
     * Summary of get_child_worksheet_idns_by_parent
     * @param mixed $parent_worksheet_idn 
     * @return array worksheet_idns
     */
    function get_child_worksheet_idns_by_parent($parent_worksheet_idn)
    {
        $job_keys = array();
        $worksheet = array();
        $child_worksheet_idns = array();

        if ($parent_worksheet_idn > 0)
        {
            //Get Worksheet 
            $worksheet = $this->get_worksheet_by_idn($parent_worksheet_idn);

            //Set job keys
            $job_keys = array($worksheet['Job_Idn'], $worksheet['ChangeOrder']);

            //Get child worksheet_idns
            $child_worksheet_idns = $this->get_child_worksheet_idns($job_keys, $worksheet['WorksheetMaster_Idn']);
        }

        return $child_worksheet_idns;
    }
    
    /**
     * get_non_applicable_hours
     *
     * Calculates field hours of products in a worksheet where Adjustment Factors do not apply
     *
     * @access  public
     * @param   $w_id(integer)
     * @return  float
     */
    
    function get_non_applicable_hours($w_id)
    {
        //Delcare and initialize variables
        $sql = "";
        $query = false;
        $non_applicable_hours = 0;
        
        //Determine non_applicable hours
		$sql = "SELECT wd.Worksheet_Idn, sum(wd.Quantity * wd.FieldUnitPrice) AS NonApplicable
                FROM WorksheetDetails AS wd
                JOIN Products AS p ON wd.Product_Idn = p.Product_Idn
                WHERE wd.Worksheet_Idn = {$w_id}
                    AND p.ApplyToAdjustmentFactorsFlag = 0
                GROUP BY wd.Worksheet_Idn
                ORDER BY wd.Worksheet_Idn";
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
                    $non_applicable_hours = $row['NonApplicable'];
                }
            }
        }
        return $non_applicable_hours;
    }
    
    /**
     * get_adjustment_factors_by_worksheet_idn
     *
     * Gets Value, UserValue and UserValueFlag columns from AdjustmentSubFactors table by worksheet
     *
     * @access  public
     * @param   $w_id(integer)
     * @return  array
     */
    
    function get_adjustment_factors_by_worksheet_idn($w_id)
    {
        //Delcare and initialize variables
        $sql = "";
        $query = false;
        $data = array();
        
        //Get values from AdjustmentSubFactors table
        $sql = "SELECT af.AdjustmentFactor_Idn, asf.Value, asf.Name, wfd.*
                FROM WorksheetFactorDetails AS wfd
                LEFT JOIN AdjustmentSubFactors AS asf ON wfd.AdjustmentSubFactor_Idn = asf.AdjustmentSubFactor_Idn
                LEFT JOIN AdjustmentFactors AS af ON asf.AdjustmentFactor_Idn = af.AdjustmentFactor_Idn
                WHERE wfd.Worksheet_Idn = {$w_id}
                ORDER BY wfd.Rank";
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
                    $row['RowType'] = "AdjustmentFactor";
                    $data[$row['Rank']] = $row;
                }
            }
        }
        
        return $data;
    }
    
    /**
        * get_job_number_by_worksheet_idn
        *
        * @access   public
        * @param    $worksheet_idn(integer)
        * @return   string
        */
    
    function get_job_number_by_worksheet_idn($worksheet_idn = 0)
    {
        //Delcare and initialize variables
        $query = false;
        $job_number = "";
        
        if ($worksheet_idn > 0)
        {
            $this->db->select('Job_Idn, ChangeOrder')
                ->from($this->_table_name)
                ->where('Worksheet_Idn', $worksheet_idn);
            
            $query = $this->db->get();
            
            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            }
            else
            {
                if ($query->num_rows() == 1)
                {
                    foreach ($query->result_array() as $row)
                    {
                        $job_number = format_job_number($row['Job_Idn'], $row['ChangeOrder']);
                    }
                }
            }
        }
        
        return $job_number;
    }

    /**
     * Summary of get_parent_worksheet_idn
     * @param mixed $job_number 
     * @param mixed $worksheet_master_idn 
     * @return mixed
     */
    public function get_parent_worksheet_idn($job_number, $worksheet_master_idn)
    {
        $parent_worksheet_idn = 0;
        $query = false;
        $job_keys = array();
        
        if (!empty($job_number) && !empty($worksheet_master_idn))
        {
            $job_keys = get_job_keys($job_number);

            $this->db
                ->select("Worksheet_Idn")
                ->from("Worksheets")
                ->where("Job_Idn = {$job_keys[0]} AND ChangeOrder = {$job_keys[1]} AND WorksheetMaster_Idn = (SELECT WorksheetMaster_Idn FROM WorksheetMasterCategories WHERE ChildWorksheetMaster_Idn = {$worksheet_master_idn})");

            $query = $this->db->get();
        
            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            }
            else
            {
                if ($query->num_rows() == 1)
                {
                    foreach ($query->result_array() as $row)
                    {
                        $parent_worksheet_idn = $row['Worksheet_Idn'];
                    }
                }
            }
        }

        return $parent_worksheet_idn;
    }

    /**
     * Summary of get_worksheet_category_idn
     * @param mixed $parent_worksheet_idn 
     * @param mixed $child_worksheet_idn 
     * @return mixed
     */
    function get_worksheet_category_idn($parent_worksheet_idn, $child_worksheet_idn)
    {
        $worksheet_category_idn = 0;
        $query = false;
        
        $this->db
            ->select("WorksheetCategory_Idn")
            ->from("WorksheetMasterCategories")
            ->where("ChildWorksheetMaster_Idn = (SELECT WorksheetMaster_Idn FROM Worksheets WHERE Worksheet_Idn = {$child_worksheet_idn}) AND WorksheetMaster_Idn = (SELECT WorksheetMaster_Idn FROM Worksheets WHERE Worksheet_Idn = {$parent_worksheet_idn})");

        $query = $this->db->get();
        
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
            foreach ($query->result_array() as $row)
            {
                $worksheet_category_idn = $row['WorksheetCategory_Idn'];
            }
        }

        return $worksheet_category_idn;
    }

    function get_next_adjustment_factor_rank($worksheet_idn)
    {
        $next_rank = 0;
        
        if ($worksheet_idn > 0)
        {
            $query = false;

            $this->db
                ->select("Rank")
                ->from("WorksheetFactorDetails")
                ->where("Worksheet_Idn = {$worksheet_idn} AND Rank NOT IN (1, 500, 501)")
                ->order_by("Rank DESC");

            $query = $this->db->get();

            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            }
            else
            {
                $row = $query->row();

                if (isset($row))
                {
                    $next_rank = $row->Rank + 1;
                }
                else
                {
                    $next_rank = 2;
                }
            }
        }

        return $next_rank;
    }

    /**
     * Summary of get_shop_fabrication_multipliers
     * @return array
     */
    function get_shop_fabrication_multipliers()
    {
        $query = false;
        $multipliers = array();
        
        $this->db
            ->select("m.*, pt.Name, pt.Rank")
            ->from("ShopFabricationMultipliers AS m")
            ->join("PipeTypes AS pt","m.PipeType_Idn = pt.PipeType_Idn", "left")
            ->where("m.ActiveFlag = 1");

        $query = $this->db->get();
        
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
            foreach ($query->result_array() as $row)
            {
                $multipliers[] = $row;
            }
        }

        return $multipliers;
    }
}