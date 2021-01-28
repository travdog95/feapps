<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Worksheet Class
 *
 * @category	Worksheet
 * @author		TKO Consulting, LLC
*/

class Worksheet
{
    //Declare and initialize member variables

    //Public members
	public $w_id;
    public $w = array();
    public $wm = array();

	//worksheet totals
	public $material = 0;
	public $field_hours = 0;
	public $shop_hours = 0;
	public $engineering_hours = 0;
	public $additional_shop_hours = 0;
	public $low_sub = 0;
	public $high_sub = 0;
	public $bonded = 0;

	//Branchline
	public $num_heads = 0;
	public $mat_cost_per_head = 0;
	public $fmh_cost_per_head = 0;
	public $smh_cost_per_head = 0;
	public $labor_class_id = 0;
	public $labor_class_value = 0;

	//Other
	public $total_records = 0;
	public $area_name = "";
    public $CI;
    public $_job_keys = array();

	/**
     * Worksheet Class Constructor
     *
     * The constructor loads the Worksheet class used to display and caluclate worksheet information
     *
     * @param   array
     */

	public function __construct($params = array('w_id' => 0))
	{
		// Set the super object to a local variable for use later
		$this->CI =& get_instance();

        //Load models
        $this->CI->load->model('m_worksheet');
        $this->CI->load->model('m_reference_table');
        $this->CI->load->model("m_worksheet_parm");
        $this->CI->load->model("m_miscellaneous_detail");

        //Load Worksheet Master library
        //$this->CI->load->library('worksheet_master');

        // If Worksheet_Idn being passed, set it
		if ($params['w_id'] > 0)
		{
		    $this->w_id = $params['w_id'];

            $this->w = $this->get_worksheet($this->w_id);
        }

        log_message('debug', "Worksheet Class Initialized");
	}

    /**
     * get_worksheet
     *
     * Get all data from Worksheets table
     *
     * @param   $w_id(integer)
     * @return  array
     */

    public function get_worksheet($w_id)
    {
        //Declare and initialize variables
        $worksheet_area = array();

        //Set Worksheet_Idn
        $this->w_id = $w_id;

        //Get worksheet
        $this->w = $this->CI->m_worksheet->get_worksheet_by_idn($this->w_id);

        if (!empty($this->w) && $this->w_id > 0)
        {
            //Get area name
            if ($this->w['WorksheetArea_Idn'] > 0)
            {
                //Load Model
                $this->CI->load->model('m_worksheet_area');

                //Get worksheet area
                $worksheet_area = $this->CI->m_worksheet_area->get_by_idn($this->w['WorksheetArea_Idn']);

                //Set Worksheet area name
                $this->area_name = $worksheet_area['Name'];
            }

            //Load Worksheet Parms by ParmReference for Parm_Idn and ParmValue
            $this->w['WorksheetParms']['ParmIdns'] = $this->CI->m_worksheet_parm->get_all_worksheet_parms_by_reference($this->w_id, "Parm_Idn");
            $this->w['WorksheetParms']['ParmValues'] = $this->CI->m_worksheet_parm->get_all_worksheet_parms_by_reference($this->w_id, "ParmValue");

            //Worksheet Factor Details
            $this->w['WorksheetFactorDetails'] = $this->CI->m_worksheet->get_adjustment_factors_by_worksheet_idn($this->w_id);

            //Job Mob
            if ($this->w['WorksheetMaster_Idn'] == 8)
            {
                //Load job mob model
                $this->CI->load->model("m_job_mob_worksheet");

                $this->w['JobMob'] = $this->CI->m_job_mob_worksheet->get_by_worksheet_idn($this->w_id);
            }

            //Get worksheet master
            $this->CI->load->library('worksheet_master', array('worksheet_master' => $this->w['WorksheetMaster_Idn']));
            $this->wm = $this->CI->worksheet_master->get_worksheet_master($this->w['WorksheetMaster_Idn']);

			//$this->w['WorksheetMaster'] = $this->wm;

            //Set job_keys
            $this->_job_keys = array($this->w['Job_Idn'],$this->w['ChangeOrder']);
        }

        return $this->w;
    }

	/**
	 * Summary of copy_worksheet
	 * @param mixed $worksheet_idn
	 * @param mixed $new_worksheet_name
	 * @param mixed $new_worksheet_area_idn
	 * @return integer
	 */
	public function copy_worksheet($worksheet_idn, $new_worksheet_name = "", $new_worksheet_area_idn = 0, $job_number = 0, $parent_worksheet_idn = 0)
	{
		$new_worksheet_idn = 0;
		$new_engineering_worksheet_idn = 0;
		$worksheet = array();
		$results = array(
			"return_code" => 0,
			"new_worksheet_idn" => 0
			);

		if ($worksheet_idn != 0 && !empty($worksheet_idn) && $job_number > 0)
		{
			$job_keys = get_job_keys($job_number);

			//Get record from Worksheets table
			$worksheet = $this->CI->m_worksheet->get_worksheet_by_idn($worksheet_idn);

			//Override fields for new worksheet
			unset($worksheet['Worksheet_Idn']);
			$worksheet['WorksheetArea_Idn'] = $new_worksheet_area_idn;
			$worksheet['Name'] = $new_worksheet_name;
			$worksheet['CopyUpdateFlag'] = 1;
			$worksheet['CreateDateTime'] = get_current_date(1);
			$worksheet['Job_Idn'] = $job_keys[0];
			$worksheet['ChangeOrder'] = $job_keys[1];
			$worksheet['ParentWorksheet_Idn'] = $parent_worksheet_idn;

			//Create new worksheet
			$new_worksheet_idn = $this->CI->m_worksheet->insert($worksheet);

			if ($new_worksheet_idn > 0)
			{
				//******** Copy WorksheetDetails ********

				//Get records
				$worksheet_details = $this->CI->m_worksheet->get_worksheet_details($worksheet_idn);

				foreach($worksheet_details as $row)
				{
					//Load new worksheet_idn
					$row['Worksheet_Idn'] = $new_worksheet_idn;

					if ($this->CI->m_worksheet->insert_worksheet_details($row) == FALSE)
					{
						$results['return_code'] = -1;
						write_feci_log("Error inserting into WorksheetDetails table for worksheet {$new_worksheet_idn}");
					}
				}

				//******** Copy WorksheetFactorDetails ********
				//Get records
				$worksheet_factors = $this->CI->m_worksheet->get_factor_details_by_worksheet_idn($worksheet_idn);

				foreach($worksheet_factors as $row)
				{
					//Load new worksheet_idn
					$row['Worksheet_Idn'] = $new_worksheet_idn;

					if ($this->CI->m_worksheet->insert_worksheet_factor_details($row) == FALSE)
					{
						$results['return_code'] = -1;
						write_feci_log("Error inserting into WorksheetFactorDetails table for worksheet {$new_worksheet_idn}");
					}
				}

				//******** Copy WorksheetParms ********
				//Get records
				$worksheet_parms = $this->CI->m_worksheet->get_worksheet_parms_by_worksheet_idn($worksheet_idn);

				foreach($worksheet_parms as $row)
				{
					//Load new worksheet_idn
					$row['Worksheet_Idn'] = $new_worksheet_idn;

					if ($this->CI->m_worksheet->insert_worksheet_parms($row) == FALSE)
					{
						$results['return_code'] = -1;
						write_feci_log("Error inserting into WorksheetParms table for worksheet {$new_worksheet_idn}");
					}
				}

				//******** Copy MiscellaneousDetails ********
				//Get records
				$miscellaneous_details = $this->CI->m_worksheet->get_miscellaneous_details($worksheet_idn);

				foreach($miscellaneous_details as $row)
				{
					//Load new worksheet_idn
					$row['Worksheet_Idn'] = $new_worksheet_idn;

					//Remove MiscellaneousDetail_Idn from $row
					unset($row['MiscellaneousDetail_Idn']);

					if ($this->CI->m_worksheet->insert_miscellaneous_details($row) == FALSE)
					{
						$results['return_code'] = -1;
						write_feci_log("Error inserting into MiscellaneousDetails table for worksheet {$new_worksheet_idn}");
					}
				}

				//******** Copy WorksheetBasicAppropriationDetails for Engineering worksheet (22) ********
				//Insert worksheet_basic_appropriation_detail records with new engineering worksheet_id and with old branchline_worksheet_id's
				//assuming engineering worksheet will be created before branchline worksheets
				//After branchline worksheets are created, I update the branchline_worksheet_id (see below)
				if ($worksheet['WorksheetMaster_Idn'] == 22)
				{
					//Set this to update record later
					$new_engineering_worksheet_idn = $new_worksheet_idn;

					//Get records
					$worksheet_basic_appropriations = $this->CI->m_worksheet->get_basic_appropriation_details_by_worksheet_idn($worksheet_idn);

					foreach($worksheet_basic_appropriations as $row)
					{
						//Load new worksheet_idn
						$row['Worksheet_Idn'] = $new_worksheet_idn;

						if ($this->CI->m_worksheet->insert_basic_appropriation_details($row) == FALSE)
						{
							$results['return_code'] = -1;
							write_feci_log("Error inserting into WorksheetBasicAppropriationDetails table for worksheet {$new_worksheet_idn}");
						}
					}

					//******** Copy WorksheetEngineeringAdditionalCosts ********
					//Get records
					//$additional_costs = $this->CI->m_worksheet->get_engineering_additional_costs_by_worksheet_idn($worksheet_idn);
					$additional_costs = $this->CI->m_reference_table->get_where("WorksheetEngineeringAdditionalCosts", "Worksheet_Idn = {$worksheet_idn}");

					foreach($additional_costs as $row)
					{
						//Load new worksheet_idn
						$row['Worksheet_Idn'] = $new_worksheet_idn;

						if ($this->CI->m_worksheet->insert_engineering_additional_costs($row) == FALSE)
						{
							$results['return_code'] = -1;
							write_feci_log("Error inserting into WorksheetEngineeringAdditionalCosts table for worksheet {$new_worksheet_idn}");
						}
					}
				}

				//Update basic appropropriations Branch line worksheets
				if ($worksheet['WorksheetMaster_Idn'] == 9)
				{
					$update = array(
						'BranchLineWorksheet_Idn' => $new_worksheet_idn
					)
					;
					$where = array(
						'Worksheet_Idn' => $new_engineering_worksheet_idn,
						'BranchLineWorksheet_Idn' => $worksheet_idn
					);

					if ($this->CI->m_worksheet->update_basic_appropriations_details($update, $where) == FALSE)
					{
						$results['return_code'] = -1;
						write_feci_log("Error updating WorksheetBasicAppropriationDetails table for worksheet {$new_worksheet_idn}");
					}
				}

				if ($worksheet['WorksheetMaster_Idn'] == 8)
				{
					//******** Copy JobMobWorksheets ********
					//load model
					$this->CI->load->model('m_job_mob_worksheet');
					$job_mob = array();

					//Get records
					$job_mob = $this->CI->m_job_mob_worksheet->get_by_worksheet_idn($worksheet_idn);

					if(!empty($job_mob))
					{
						//Load new worksheet_idn
						$job_mob['Worksheet_Idn'] = $new_worksheet_idn;

						if ($this->CI->m_job_mob_worksheet->insert($job_mob) == FALSE)
						{
							$results['return_code'] = -1;
							write_feci_log("Error inserting into JobMobWorksheets table for worksheet {$new_worksheet_idn}");
						}
					}
				}

				if ($results['return_code'] == 0)
				{
					$results['return_code'] = 1;
					$results['new_worksheet_idn'] = $new_worksheet_idn;
				}
			}
			else //if ($new_worksheet_idn > 0)
			{
				$results['return_code'] = -1;
				write_feci_log("Error copying worksheet {$worksheet_idn}");
			}
		}

		return $results;
	}

    /**
     * get_totals
     *
     * Calculates worksheet totals.
     *
     * @access  public
     * @param   $w_id(integer)
     * @return  $totals(array)
     */

    public function get_totals($w_id)
    {
        //Delcare and initialize variables
        //$query = false;
        $totals = array();
        $labor_class_adjustments = array();
        $heads = array();

        //Get worksheet if necessary
        if (empty($this->w))
        {
            $this->get_worksheet($w_id);
        }

        //Get totals from WorksheetDetails and MiscellaneousDetails tables
        $totals = $this->CI->m_worksheet->get_worksheet_totals($w_id);

        if (!empty($totals))
        {
            //Subcontracts
            if ($this->wm['IsSubcontractWorksheet'] == 1)
            {
                foreach ($totals as $total)
                {
                    switch ($total['WorksheetColumn_Idn'])
                    {
                        case 1: //Bonded
                            $this->bonded += round($total['material'], 2);
                            break;
                        case 2: //Low Sub
                            $this->low_sub += round($total['material'], 2);
                            break;
                        case 3: //High Sub
                            $this->high_sub += round($total['material'], 2);
                            break;
                    }
                }
            }
            else
            {
                //Read through summary of WorksheetDetails and MiscellaneousDetails array
                foreach ($totals as $total)
                {
                    $this->material += round($total['material'], 2);
                    $this->engineering_hours += round($total['engineering_hours'], 2);
                    $this->field_hours += round($total['field_hours'], 2);
                    $this->shop_hours += round($total['shop_hours'], 2);
                }

            }

            
            //Add Additional shop hours
            $this->shop_hours += round($this->w['AdditionalShopHours'], 2);
            $this->addtional_shop_hrs = round($this->w['AdditionalShopHours'], 2);
        }

        //Get child worksheet idns
        $child_worksheet_idns = $this->CI->m_worksheet->get_child_worksheet_idns($this->_job_keys, $this->w['WorksheetMaster_Idn']);

        //If Worksheet has children
        if (!empty($child_worksheet_idns))
        {
            foreach($child_worksheet_idns as $worksheet_idn)
            {
                //$w = new Worksheet;
                $worksheet_instance = 'w'.$worksheet_idn;
                $this->CI->load->library('worksheet', array('w_id' => $worksheet_idn), $worksheet_instance);
                $w = $this->CI->$worksheet_instance;

                $w->get_totals($worksheet_idn);

                //Add Branchline costs per head to material, field hours and shop hours for Crossmains and lines recap
                if ($w->w['WorksheetMaster_Idn'] == 9)
                {
                    $this->material += $w->w['Quantity'] * $w->mat_cost_per_head;
                    $this->field_hours += $w->w['Quantity'] * $w->fmh_cost_per_head;
                    $this->shop_hours += $w->w['Quantity'] * $w->smh_cost_per_head;

                    //echo "<p>w_id: ".$worksheet_idn." Material: ".$w->mat_cost_per_head."</p>";
                    //echo "<p>w_id: ".$worksheet_idn." Field Hours: ".$w->fmh_cost_per_head."</p>";
                    //echo "<p>w_id: ".$worksheet_idn." Shop Hours: ".$w->smh_cost_per_head."</p>";
                }
                else
                {
                    $this->material += $w->w['Quantity'] * $w->material;
                    $this->field_hours += $w->w['Quantity'] * $w->field_hours;
                    $this->shop_hours += $w->w['Quantity'] * $w->shop_hours;

                    //echo "<p>w_id: ".$worksheet_idn." Material: ".$w->material."</p>";
                    //echo "<p>w_id: ".$worksheet_idn." Field Hours: ".$w->field_hours."</p>";
                    //echo "<p>w_id: ".$worksheet_idn." Shop Hours: ".$w->shop_hours."</p>";
                }
            }
        }

        //Apply adjustment factors to pipe & fittings and conduit & wire worksheets and branchline
        if ($this->wm['DisplayAdjustmentFactors'] == 1)
        {
            $this->field_hours = round($this->apply_adj_factors($w_id, $this->field_hours), 2);
        }

        //Calculate exceptions
        switch ($this->w['WorksheetMaster_Idn'])
        {
            case 9: //Branch Line
                $this->num_heads = 0;
                $this->mat_cost_per_head = 0;
                $this->fmh_cost_per_head = 0;
                $this->smh_cost_per_head = 0;

                //Get Worksheet Heads
                $heads = $this->CI->m_worksheet->get_heads($w_id);

                if(sizeof($heads) > 0)
                {
                    foreach ($heads as $head)
                    {
                        $this->num_heads += $head['num_heads'];
                    }
                }

                if ($this->num_heads > 0)
                {
                    $this->mat_cost_per_head = round(ceil($this->material) / $this->num_heads, 2);
                    $this->fmh_cost_per_head = round($this->field_hours / $this->num_heads, 2);
                }

                //Calculate shop per head
                if ($this->w['OverrideShopHours'] == 1)
                {
                    $this->smh_cost_per_head = $this->w['UserShopHours'];
                }
                else
                {
                    $shop_fabrication_factor = 0;
                    $shop_fabrication_multiplier = 0;

                    if ($this->w['ShopFabrication_Idn'] > 0)
                    {
                        $shop_fabrication_factor = $this->CI->m_reference_table->get_field("ShopFabrications", "Value", "ShopFabrication_Idn = {$this->w['ShopFabrication_Idn']}");
                    }

                    if ($this->w['ShopFabricationMultiplier_Idn'] > 0)
                    {
                        $shop_fabrication_multiplier = $this->CI->m_reference_table->get_field("ShopFabricationMultipliers", "Multiplier", "ShopFabricationMultiplier_Idn = {$this->w['ShopFabricationMultiplier_Idn']}");
                    }

                    $this->smh_cost_per_head = round($shop_fabrication_factor * $shop_fabrication_multiplier, 2);
                }

                //Get Labor Class adjustments
                $labor_class_adjustments = $this->CI->m_worksheet->get_labor_class_adjustments($w_id);

                if (!empty($labor_class_adjustments))
                {
                    $this->labor_class_id = $labor_class_adjustments['AdjustmentSubFactor_Idn'];
                    $this->labor_class_value = $labor_class_adjustments['Value'];
                }

                $this->material = $this->mat_cost_per_head;
                $this->field_hours = $this->fmh_cost_per_head;
                $this->shop_hours = $this->smh_cost_per_head;
                break;
            case 22: //Sprinkler Engineering
                $basic_approprations = array();
                $adjustment_factor_value = 0;
                $original_sys_qty = 0;
                $identical_qty = 0;
                $engineering_hours = 0;

                if ($this->w['OverrideEngineerHours'] == 1)
                {
                    $this->engineering_hours = $this->w['UserEngineerHours'];
                }
                else
                {
                    //Load model
                    $this->CI->load->model('m_worksheet_basic_appropriation');

                    $basic_approprations = $this->CI->m_worksheet_basic_appropriation->get_by_worksheet_idn($this->w_id);

                    if (sizeof($basic_approprations) > 0)
                    {
                        foreach ($basic_approprations as $basic_appropriation)
                        {
                            $adjustment_factor_value = ($basic_appropriation['AdjustmentFactor_Idn'] == 0) ? 1 : $basic_appropriation['AdjustmentFactorValue'];

                            if ($basic_appropriation['AdjustmentFactor_Idn'] == 148) //Identical or Similar Systems
                            {
                                //Calc qtys
                                $original_sys_qty = $basic_appropriation['OriginalSystemQuantity'];
                                $identical_qty = $basic_appropriation['Quantity'] - $original_sys_qty;
                                //Original
                                $engineering_hours += number_format(round($basic_appropriation['LaborClassValue'] * $basic_appropriation['AdjustmentFactorValue'], 2) * $original_sys_qty, 2);
                                //Identical
                                $engineering_hours += number_format(round(.25 * $basic_appropriation['LaborClassValue'],2) * $identical_qty, 2) ;
                            }
                            else
                            {
                                $engineering_hours += number_format(round($basic_appropriation['LaborClassValue'] * $adjustment_factor_value,2) * $basic_appropriation['Quantity'], 2) ;
                            }
                        }
                    }

                    //Total of Adjustment factors
                    $this->engineering_hours = $this->apply_adj_factors($w_id, $engineering_hours);

                    //Total Addtional costs
                    $this->engineering_hours += $this->get_engineering_additional_costs($w_id);
                }
                break;
        } //END: switch

        //Apply Man Hour adjustment
        //if ($this->wm['DisplayVolumeCorrection'] == 1)
        if ($this->wm['DisplayManhourAdjustment'] == 1 || $this->wm['DisplayVolumeCorrection'] == 1)
        {
            //Load model
            $this->CI->load->model('m_volume_correction');

            $this->field_hours = round($this->field_hours * $this->CI->m_volume_correction->get_value_by_idn($this->w['VolumeCorrection_Idn']), 2);
        }

        //Field hours override
        if ($this->wm['DisplayFieldHoursOverride'] == 1 && $this->w['OverrideFieldHours'] == 1)
        {
            $this->field_hours = $this->w['UserFieldHours'];
        }

        //Shop Hours override
        if (($this->wm['DisplayShopHoursOverride'] == 1 && $this->w['OverrideShopHours'] == 1)
            || $this->wm['DisplayUserShopHoursOnly'] == 1)
        {
            $this->shop_hours = $this->w['UserShopHours'];
        }
    }

    /**
     * apply_adj_factors
     *
     * Applies adjustment factor to only applicable worksheet line items where Product.ApplyToAdjustmentFactorsFlag is 1.
     *
     * @access  public
     * @param   $w_id(integer)
     * @param   $hours(float)
     * @return  float
     */

	public function apply_adj_factors($w_id, $hours = 0)
	{
        //Declare and initialize variables
		$applicable_hours = 0;
		$non_applicable_hours = 0;
        $adjustment_factors = array();
		$additional_hours = 0;
        $adj_value = 0;

		$non_applicable_hours = $this->CI->m_worksheet->get_non_applicable_hours($w_id);

        //Determin Applicable hours
		$applicable_hours = $hours - $non_applicable_hours;

        //Get adjustment factors
        $adjustment_factors = $this->CI->m_worksheet->get_adjustment_factors_by_worksheet_idn($w_id);

        foreach ($adjustment_factors as $adjustment_factor)
        {
            $adjustment_factor_value = ($adjustment_factor['Value'] == NULL) ? 1 : $adjustment_factor['Value'];
            $adj_value = ($adjustment_factor['UserValueFlag'] == 1) ? $adjustment_factor['UserValue'] : $adjustment_factor_value;

            if ($this->w['WorksheetMaster_Idn'] == 22)
            {
                $additional_hours += round($applicable_hours * $adj_value, 2);
            }
            else
            {
                $applicable_hours = round($applicable_hours * $adj_value, 2);
            }
        }
		return $applicable_hours + $additional_hours + $non_applicable_hours;
	}

    /**
     * get_engineering_additional_costs
     *
     * WhatFunctionDoes...
     *
     * @access  public
     * @param   $w_id(integer)
     * @return  float
     */

    public function get_engineering_additional_costs($w_id)
	{
        //Delcare and initialize variables
        $additional_cost = 0;
        $additional_costs = array();

        //Load model
        $this->CI->load->model('m_reference_table');

        $additional_costs = $this->CI->m_reference_table->get_where('WorksheetEngineeringAdditionalCosts',array('Worksheet_Idn' => $w_id));

		if (sizeof($additional_costs) > 0)
		{
            foreach ($additional_costs as $row)
            {
				$additional_cost += number_format($row['Quantity'] * $row['FieldManHours'], 2);
            }
		}

		return $additional_cost;
	}

    /**
     * migrate_worksheet_recap_to_miscellaneous
     *
     * Migrates all WorksheetRecapDetails records for crossmains and branch lines worksheets to MiscellaneousDetails table
     *
     * @access  public
     * @return  string
     */

    function migrate_worksheet_recap_to_miscellaneous()
    {
        //Delcare and initialize variables
        $results = array();
        $worksheet_recap_details = array();
        $set = array();
        $job_idn = 0;
        $change_order = 0;
        $worksheet_category_idn = 0;
        $worksheet_idn = 0;

        //Load model
        //$this->CI->load->model('m_worksheet');
        //$this->CI->load->model('m_miscellaneous_detail');

        //Get records from WorksheetRecapDetails
        //$worksheet_recap_details = $this->CI->m_miscellaneous_detail->get_worksheet_recap_details_for_crossmains_lines(); This method doesn't exist anymore?!

        foreach ($worksheet_recap_details as $worksheet_recap_detail)
        {
            //Check to see if a new Worksheet needs to be created
            if ($job_idn != $worksheet_recap_detail['Job_Idn'] || $change_order != $worksheet_recap_detail['ChangeOrder'])
            {
                $job_idn = $worksheet_recap_detail['Job_Idn'];
                $change_order = $worksheet_recap_detail['ChangeOrder'];

                //Load set array for worksheet record insert
                $set = array(
                    'Job_Idn' => $job_idn,
                    'ChangeOrder' => $change_order,
                    'WorksheetMaster_Idn' => 32,
                    'CreateDateTime' => get_current_date(1)
                );

                $worksheet_idn = $this->CI->m_worksheet->insert($set);

                //echo "<p>Job_Idn: ".$job_idn." ChangeOrder: ".$change_order."</p>";
            }

            if ($job_idn > 0 && $worksheet_idn > 0)
            {
                //Determine worskheet_category_idn
                if ($worksheet_recap_detail['WorksheetArea_Idn'] > 0)
                {
                    $worksheet_category_idn = 138;
                }
                else if ($worksheet_recap_detail['FinishWork_Idn'] > 0)
                {
                    $worksheet_category_idn = 140;
                }
                else if($worksheet_recap_detail['WorksheetMaster_Idn'] == 10)
                {
                    $worksheet_category_idn = 139;
                }
                else
                {
                    $worksheet_category_idn = 108;
                }

                //Load set array
                $set = array(
                    'Worksheet_Idn' => $worksheet_idn,
                    'LineNum' => $worksheet_recap_detail['Line_Idn'],
                    'Quantity' => $worksheet_recap_detail['Quantity'],
                    'Name' => $worksheet_recap_detail['Name'],
                    'MaterialUnitPrice' => $worksheet_recap_detail['MaterialUnitPrice'],
                    'FieldUnitPrice' => $worksheet_recap_detail['FieldUnitPrice'],
                    'ShopUnitPrice' => $worksheet_recap_detail['ShopUnitPrice'],
                    'EngineerUnitPrice' => $worksheet_recap_detail['EngineerUnitPrice'],
                    'WorksheetArea_Idn' => $worksheet_recap_detail['WorksheetArea_Idn'],
                    'WorksheetCategory_Idn' => $worksheet_category_idn
                );

                if($this->CI->m_miscellaneous_detail->insert($set))
                {
                    $results['success'][] = $worksheet_recap_detail['WorksheetRecap_Idn'];
                }
                else
                {
                    $results['failure'][] = $worksheet_recap_detail['WorksheetRecap_Idn'];
                }
            }
        }

        echo json_encode($results);
    }

    /**
     * create_worksheet
     *
     * Create a new worksheet based on job number and worksheet_master_idn
     *
     * @access  public
     * @param   string ($job_number)
     * @param   number ($worksheet_master_idn)
     * @param   array
     * @return  mixed (false if no worksheet was created, worksheet_idn if it was created)
     */

    public function create_worksheet($job_number, $worksheet_master_idn, $data = array())
    {
        //Delcare and initialize variables
        $worksheet_idn = 0;
        $job_keys = array();
        $wm = array();
        $worksheet_data = array();
        $current_date_time = get_current_date(1);
        $job_volume_corrections = array();
        $parent_worksheet_idn = 0;
        $pipe_exposure = 0;
        $where = array();
        $insert_data = array();

        $job_keys = get_job_keys($job_number);
        //$worksheet_master = new Worksheet_master(array('worksheet_master_idn' => $worksheet_master_idn));

        $this->CI->load->library('worksheet_master', array('worksheet_master_idn' => $worksheet_master_idn), 'create_worksheet_wm');
        $worksheet_master = $this->CI->create_worksheet_wm;

        $wm = $worksheet_master->wm;

        if ($wm['AllowMultiple'] == 0)
        {
            $where = array(
                'Job_Idn' => $job_keys[0],
                'ChangeOrder' => $job_keys[1],
                'WorksheetMaster_Idn' => $worksheet_master_idn
            );

            $worksheet_data = $this->CI->m_reference_table->get_where("Worksheets", $where);

            if (!empty($worksheet_data))
            {
                return false;
            }
        }

        //Get parent worksheet_idn
        $parent_worksheet_idn = $this->get_parent_worksheet_idn($job_number, $worksheet_master_idn);

        $worksheet_data = array(
            'Name' => $wm['Name'],
            'Job_Idn' => $job_keys[0],
            'ChangeOrder' => $job_keys[1],
            'WorksheetMaster_Idn' => $worksheet_master_idn,
            'Quantity' => 1,
            'CreateDateTime' => $current_date_time,
            'ParentWorksheet_Idn' => $parent_worksheet_idn
        );

        //Include additional items in $data array for worksheet insert, if it has data
        if (!empty($data))
        {
            //Get pipe exposure out of array
            if (isset($data['PipeExposure_Idn']))
            {
                $pipe_exposure = $data['PipeExposure_Idn'];
                unset($data['PipeExposure_Idn']);
            }

            $worksheet_data = array_merge($worksheet_data, $data);
        }

        //Insert record into Worksheets table
        $worksheet_idn = $this->CI->m_worksheet->insert($worksheet_data);

        if ($worksheet_idn > 0)
        {
            //Load models
            $this->CI->load->model('m_job');
            $this->CI->load->model('m_job_volume_correction');

            //Update Job
            $this->CI->m_job->save($job_number, array('UpdateDateTime' => $current_date_time));

            //Check Volume Correction
            if ($wm['DisplayManhourAdjustment'] == 1)
            {
                //INSERT Job Volume Correction record if it doesn't already exists
                $job_volume_corrections = $this->CI->m_reference_table->get_where('JobVolumeCorrections',
                    array('Job_Idn' => $job_keys[0], 'ChangeOrder' => $job_keys[1], 'WorksheetMaster_Idn' => $worksheet_master_idn));

                if (sizeof($job_volume_corrections) == 0)
                {
                    $this->CI->m_job_volume_correction->insert(
                        array('Job_Idn' => $job_keys[0], 'ChangeOrder' => $job_keys[1], 'WorksheetMaster_Idn' => $worksheet_master_idn, 'VolumeCorrection_Idn' => $this->CI->m_job_volume_correction->default));
                }
            }

            //Insert Default adjustment factors
            if ($wm['DisplayAdjustmentFactors'] == 1)
            {
                if ($wm['WorksheetMaster_Idn'] == 2)
                {
                    //(Height-Threaded 10 feet, Labor Class Adj Class 2
                    $worksheet_factor_ranks = array(1,500); 
                    $worksheet_factor_idns = array(76,112);
                    $worksheet_factor_values = array(
                        0 => 0,
                        1 => $this->CI->m_reference_table->get_field('AdjustmentSubFactors', 'Value', array('AdjustmentSubFactor_Idn' => $worksheet_factor_idns[1])),
                    );
                }
                else
                {
                    //(Height-Threaded 10 feet, Labor Class Adj Class 3, Efficiency Factor
                    $worksheet_factor_ranks = array(1,500,501); 
                    $worksheet_factor_idns = array(69,61,60);
                    $worksheet_factor_values = array(
                        0 => 0,
                        1 => $this->CI->m_reference_table->get_field('AdjustmentSubFactors', 'Value', array('AdjustmentSubFactor_Idn' => 61)),
                        2 => $this->CI->m_reference_table->get_field('AdjustmentSubFactors', 'Value', array('AdjustmentSubFactor_Idn' => 60))
                    );
                }

                $worksheet_factor_data = array();

                foreach ($worksheet_factor_idns as $key => $worksheet_factor_idn)
                {
                    $worksheet_factor_data = array(
                        'Worksheet_Idn' => $worksheet_idn,
                        'Rank' => $worksheet_factor_ranks[$key],
                        'AdjustmentSubFactor_Idn' => $worksheet_factor_idn,
                        'UserValue' => $worksheet_factor_values[$key],
                        'Section' => 0
                    );

                    $this->CI->m_worksheet->insert_worksheet_factor_details($worksheet_factor_data);
                }
            }

            //Insert Default products
            $this->create_default_products($worksheet_master_idn, $worksheet_idn);

            if ($wm['DisplayWorksheetHeader'] == 1)
            {

            }

            //Insert default engineering additional costs
            switch ($worksheet_master_idn)
            {
                case 7: //SH engineering
                    $sh_eng_defaults = $this->save_sh_engineering_defaults($worksheet_idn, $job_number);
                    break;
                case 8: //Job mobilization
                    //Load libraries
                    $this->CI->load->library("j", array('job_number' => $job_number));
                    $j = $this->CI->j;

                    $this->CI->load->library("job_mob");

                    //Get job info
                    //$j = new J(array('job_number' => $job_number));


                    $field_labor_rate = $j->job['field_labor_rate'];
                    $shop_labor_rate = $j->job['shop_labor_rate'];
                    $design_labor_rate = $j->job['design_labor_rate'];
                    $miles_to_job = $j->job['miles_to_job'];
                    $subsistence_factors = $this->CI->job_mob->get_subsistence_factors($miles_to_job);
                    $sub_pay = ($j->job_parms[30]['AlphaValue'] == "Y") ? 0 : $subsistence_factors['pay']; //If davis bacon job, no pay
                    $round_trip = $miles_to_job * 2;
                    $motel_costs = $j->job_parms[32]['NumericValue'] / 2 * $subsistence_factors['motel_days'];
                    $meal_costs = $j->job_parms[3]['NumericValue'] * $subsistence_factors['meal_days'];
                    $sunday_motel_costs = $j->job_parms[32]['NumericValue'] / 2;
                    $insert_data = array(
                        "Worksheet_Idn" => $worksheet_idn,
                        "des_exp_veh_trips" => 2,
                        "des_wag_rate" => $design_labor_rate,
                        "des_wag_air_rate" => $design_labor_rate,
                        "des_wag_trips" => 2,
                        "des_wag_air_hrs" => 4,
                        "f_trk_exp_off_trips" => 2,
                        "f_wag_trips" => 2,
                        "f_wag_rate" => $field_labor_rate,
                        "f_wag_air_rate" => $field_labor_rate,
                        "f_wag_workers" => 2,
                        "f_wag_air_hrs" => 8,
                        "f_sub_pay" => $sub_pay,
                        "f_sub_meals" => $meal_costs,
                        "f_sub_motel" => $motel_costs,
                        "f_sub_motel_days" => $subsistence_factors['motel_days'],
                        "f_sub_meals_days" => $subsistence_factors['meal_days'],
                        "f_sun_motel" => $sunday_motel_costs,
                        "del_exp_stk_trips" => 1,
                        "del_wag_rate" => $shop_labor_rate,
                        "del_wag_trips" => 1,
                        "del_sub_rate" => $j->job_parms[3]['NumericValue'],
                        "del_sub_trips" => 1,
                        "des_exp_veh_miles" => $round_trip,
                        "des_wag_miles" => $round_trip,
                        "f_trk_exp_off_mil" => $round_trip,
                        "f_wag_miles" => $round_trip,
                        "del_exp_stk_mil" => $round_trip,
                        "del_wag_miles" => $round_trip,
                        "interim_rate" =>$j->job_parms[74]['NumericValue']
                        );

                    $this->CI->m_reference_table->insert("JobMobWorksheets", $insert_data);

                    //Insert default fts sections into worksheet parms
                    $worksheet_parms_insert_data = array(
                        "Worksheet_Idn" => $worksheet_idn,
                        "Parm_Idn" => 0,
                        "ParmReference" => "FTSSections",
                        "ParmValue" => $subsistence_factors['fts_sections']
                        );
                    $this->CI->m_reference_table->insert("WorksheetParms", $worksheet_parms_insert_data);

                    break;
                case 9: //Branch Line
                    //Create default Pipe Exposure Worksheet Parm
                    $insert_data = array(
                        "Worksheet_Idn" => $worksheet_idn,
                        "ParmReference" => "PipeExposure",
                        "Parm_Idn" => $pipe_exposure
                        );
                    $this->CI->m_reference_table->insert("WorksheetParms", $insert_data);

                    break;
                case 22: //Engineer
                    $this->create_engineering_defaults($worksheet_idn);
                    break;
            }
        }

        return $worksheet_idn;
    }

   /**
    * create_default_products
    *
    * Insert default products into WorksheetDetails table by WorksheetMaster
    *
    * @param    number(worksheet_master_idn)
    * @return   boolean
    */

    function create_default_products($worksheet_master_idn, $worksheet_idn)
    {
    	//Delcare and initialize variables
        $results = false;
        $query = false;
        $data = array();

        $this->CI->db->select('Product_Idn, MaterialUnitPrice, p.FieldUnitPrice, ShopUnitPrice, EngineerUnitPrice, SubcontractCategory_Idn, DefaultQuantity');
        $this->CI->db->from('Products AS p');
        $this->CI->db->join('v_WorksheetMasterCategories AS c', 'p.WorksheetMaster_Idn = c.WorksheetMaster_Idn AND p.WorksheetCategory_Idn = c.WorksheetCategory_Idn');
        $this->CI->db->where('((c.AutoLoadFlag = 1 AND p.LoadFlag = 1) OR p.AutoLoadFlag = 1)');
        $this->CI->db->where('p.ActiveFlag',1);
        $this->CI->db->where('p.WorksheetMaster_Idn', $worksheet_master_idn);
        $this->CI->db->order_by('p.Rank', 'ASC');

        $query = $this->CI->db->get();

        if ($query)
        {
            $results = true;

            if ($query->num_rows() > 0)
            {
                foreach ($query->result_array() as $row)
                {
                    $data = array(
                        'Worksheet_Idn' => $worksheet_idn,
                        'Product_Idn' => $row['Product_Idn'],
                        'MaterialUnitPrice' => $row['MaterialUnitPrice'],
                        'FieldUnitPrice' => $row['FieldUnitPrice'],
                        'ShopUnitPrice' => $row['ShopUnitPrice'],
                        'EngineerUnitPrice' => $row['EngineerUnitPrice'],
                        'OriginalMaterialUnitPrice' => $row['MaterialUnitPrice'],
                        'OriginalFieldUnitPrice' => $row['FieldUnitPrice'],
                        'OriginalShopUnitPrice' => $row['ShopUnitPrice'],
                        'OriginalEngineerUnitPrice' => $row['EngineerUnitPrice'],
                        'WorksheetColumn_Idn' => $row['SubcontractCategory_Idn'],
                        'Quantity' => $row['DefaultQuantity']
                    );

                    $this->CI->m_worksheet->insert_worksheet_details($data);
                }
            }
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->CI->db->last_query(), "Script" => __METHOD__));
        }

        return $results;
    }

   /**
    * create_engineering_defaults
    *
    * Insert defaults into WorksheetEngineeringAdditionalCosts table
    *
    * @param    number($worksheet_idn)
    * @return   void
    */

    function create_engineering_defaults($worksheet_idn)
    {
    	//Delcare and initialize variables
        $query = false;
        $data = array();
        $job_number = 0;
        $insert_basic_appropriation_details = false;

        //Load models
        $this->CI->load->model('m_worksheet_basic_appropriation');

        $job_number = $this->CI->m_worksheet->get_job_number_by_worksheet_idn($worksheet_idn);

        $this->CI->db->select('*');
        $this->CI->db->from('EngineeringAdditionalCosts');
        $this->CI->db->where('DefaultFlag', 1);
        $this->CI->db->order_by('Rank', 'ASC');

        $query = $this->CI->db->get();

        if ($query)
        {
            if ($query->num_rows() > 0)
            {
                foreach ($query->result_array() as $row)
                {
                    $data = array(
                        'Worksheet_Idn' => $worksheet_idn,
                        'AdditionalCost_Idn' => $row['EngineeringAdditionalCost_Idn'],
                        'Quantity' => $row['Quantity'],
                        'FieldManHours' => $row['ManHours']
                    );

                    $this->CI->m_worksheet->insert_engineering_additional_costs($data);
                }
            }
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->CI->db->last_query(), "Script" => __METHOD__));
        }

        //Worksheet Basic Appropriation Details
        $insert_basic_appropriation_details = $this->CI->m_worksheet_basic_appropriation->insert($worksheet_idn, $job_number);

        //Insert Labor Classes

        //Insert Individual Adjustment Factors

        //Engineering Adjustment Factors

        //Additional costs

    }

    /**
     * get_worksheet_master_parameters
     *
     * Gets worksheet parameters for worksheet_master
     *
     * @param   $worksheet_master_idn
     * @return  array
     */

    function get_worksheet_master_parameters($worksheet_master_idn, $department_idn)
    {
        //Delcare and initialize variables
        $data = array(
            'sizes' => array(),
            'pipe_types' => array(),
            'schedule_types' => array(),
            'fitting_materials' => array(),
            'fittings' => array()
        );

        //Load models
        $this->CI->load->model('m_product_size');
        $this->CI->load->model('m_pipe_type');
        $this->CI->load->model('m_schedule_type');

        $data['sizes'] = $this->CI->m_product_size->get_for_worksheet_parms($worksheet_master_idn, $department_idn);

        $data['pipe_types'] = $this->CI->m_pipe_type->get_for_worksheet_parms($worksheet_master_idn, $department_idn);

        $data['fittings'] = $this->get_fittings($worksheet_master_idn, $department_idn);

        $data['fitting_materials'] = $this->CI->m_reference_table->get_all('ThreadedFittingTypes', array(), true, 'Rank ASC');

        $data['schedule_types'] = $this->CI->m_schedule_type->get_for_worksheet_parms($worksheet_master_idn, $department_idn);

        return $data;
    }

   /**
    * get_fittings
    *
    * Get fitting for worksheet parameters section
    *
    * @param    number(worksheet_master_idn)
    * @param    number(department_idn)
    * @return   array
    */

    function get_fittings($worksheet_master_idn, $department_idn)
    {
    	//Delcare and initialize variables
        $data = array();
        $query = false;

        $this->CI->db->select('WorksheetCategory_Idn, Name')
                ->from('WorksheetCategories')
                ->where_in('WorksheetCategory_Idn', array(90,97))
                ->where('ActiveFlag', 1)
                ->order_by('Name', 'ASC');

        $query = $this->CI->db->get();

        if ($query)
        {
            if ($query->num_rows() > 0)
            {
                foreach ($query->result_array() as $row)
                {
                    $data[$row['WorksheetCategory_Idn']] = $row['Name'];
                }

                //Add Both option
                $data[0] = "Both";
            }
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->CI->db->last_query(), "Script" => __METHOD__));
        }

        return $data;
    }

    /**
     * get_products
     *
     * Get all products for worksheet by worksheet category
     *
     * @param    number(worksheet_idn)
     * @param    number(worksheet_category_idn)
     * @return   array
     */

    public function get_products($worksheet_idn, $worksheet_category_idn = null)
    {
        return $this->CI->m_worksheet->get_worksheet_details_extended($worksheet_idn, $this->w['WorksheetMaster_Idn']);
    }

    /**
     * Summary of get_child_worksheet_details
     * @param mixed $worksheet_master_idn
     * @param mixed $job_number
     * @param mixed $worksheet_idn
     * @return mixed
     */
    public function get_child_worksheet_details($worksheet_master_idn, $job_number, $worksheet_idn)
    {
        return $this->CI->m_worksheet->get_child_worksheet_details($worksheet_master_idn, $job_number, $worksheet_idn);
    }

    /**
     * get_miscellaneous_products
     *
     * Get all miscellaneous products for worksheet by worksheet category
     *
     * @param    number(worksheet_idn)
     * @param    number(worksheet_category_idn)
     * @return   array
     */

    public function get_miscellaneous_products($worksheet_idn, $worksheet_category_idn = null)
    {
        return $this->CI->m_worksheet->get_miscellaneous_details_extended($worksheet_idn, array("Worksheet_Idn" => $worksheet_idn, "WorksheetMaster_Idn" => $this->w['WorksheetMaster_Idn']));
    }

    /**
     * Summary of get_parent_worksheet_idn
     * @param mixed $job_number
     * @param mixed $worksheet_master_idn
     * @return mixed
     */
    public function get_parent_worksheet_idn($job_number, $worksheet_master_idn)
    {
        return $this->CI->m_worksheet->get_parent_worksheet_idn($job_number, $worksheet_master_idn);
    }

    /**
     * Summary of save_worksheet_parm
     * @param mixed $worksheet_idn
     * @param array $post
     * @return array
     */
    public function save_worksheet_parms($worksheet_idn, $post)
    {
        $delete_where = array();
        $errors = array();

        //Sizes
        if (isset($post['size_ids']))
        {
            //Delete existing PipeSizes parms
            $delete_where = array(
                "Worksheet_Idn" => $worksheet_idn,
                "ParmReference" => "ProductSizes"
                );

            $this->CI->m_reference_table->delete("WorksheetParms", $delete_where);

            //Insert selected sizes
            foreach($post['size_ids'] as $size_idn)
            {
                array_merge($this->save_worksheet_parm($worksheet_idn, $size_idn, "ProductSizes", true), $errors);
            }
        }

        //Pipe Type
        if (isset($post['pipe_type_id']))
        {
            array_merge($this->save_worksheet_parm($worksheet_idn, $post['pipe_type_id'], "PipeType"), $errors);
        }

        //Save Pipe Options
        if (isset($post['pipe_options']))
        {
            array_merge($this->save_worksheet_parm($worksheet_idn, $post['pipe_options'], "PipeOption"), $errors);
        }

        //Schedule Type
        if (isset($post['schedule_type_id']))
        {
            array_merge($this->save_worksheet_parm($worksheet_idn, $post['schedule_type_id'], "ScheduleType"), $errors);
        }

        //Fitting Type
        if (isset($post['fitting_id']))
        {
            array_merge($this->save_worksheet_parm($worksheet_idn, $post['fitting_id'], "FittingType"), $errors);
        }

        //Fitting Material
        if (isset($post['fitting_material_id']))
        {
            array_merge($this->save_worksheet_parm($worksheet_idn, $post['fitting_material_id'], "FittingMaterial"), $errors);
        }

        return $errors;
    }

    /**
     * Summary of save_worksheet_parm
     * @param mixed $worksheet_idn
     * @param mixed $parm_idn
     * @param mixed $parm_reference
     * @param bool $insert_only
     * @return array
     */
    public function save_worksheet_parm($worksheet_idn, $parm_idn, $parm_reference, $insert_only = false)
    {
        //Declare and initialize variables
        $errors = array();
        $worksheet_parm_insert = array();

        $worksheet_parm_set = array(
            "Parm_Idn" => $parm_idn
            );

        $worksheet_parm_where = array(
            "Worksheet_Idn" => $worksheet_idn,
            "ParmReference" => $parm_reference
            );

        //Check to see if PipeType parm already exists for worksheet
        $worksheet_parm = $this->CI->m_reference_table->get_where("WorksheetParms", $worksheet_parm_where);

        if (empty($worksheet_parm) || $insert_only == true)
        {
            $worksheet_parm_insert = array_merge($worksheet_parm_set, $worksheet_parm_where);

            //Insert
            if ($this->CI->m_reference_table->insert("WorksheetParms", $worksheet_parm_insert) == false)
            {
                $errors[] = "Worksheet Parms - {$parm_reference} : {$parm_idn}";
            }
        }
        else
        {
            //Update
            if ($this->CI->m_reference_table->update("WorksheetParms", $worksheet_parm_set, $worksheet_parm_where) == false)
            {
                $errors[] = "Worksheet Parms - {$parm_reference} : {$parm_idn}";
            }
        }

        return $errors;
    }

    /**
     * Summary of insert_worksheet_detail_by_product_idns
     * @param mixed $product_idns
     * @param mixed $worksheet_idn
     * @return bool
     */
    function insert_worksheet_detail_by_product_idns($product_idns, $worksheet_idn)
    {
        //Declare and initialize variables
        $insert = false;

        if (!empty($product_idns) && $worksheet_idn > 0)
        {
            $where = array();
            $product = array();
            $insert_data = array();
            $inserts = array();

            //Load models
            $this->CI->load->model('m_worksheet_detail');

            //If $product_idns is not array, create array with value of $product_idns
            if (!is_array($product_idns))
            {
                $product_idns = array($product_idns);
            }

            foreach ($product_idns as $product_idn)
            {
                $where = array(
                    "Product_Idn" => $product_idn,
                    "ActiveFlag" => 1
                    );

                //Get product
                $product = $this->CI->m_reference_table->get_where("Products", $where);

                $product = $product[0];

                //Load data for insert
                $insert_data = array(
                    'Worksheet_Idn' => $worksheet_idn,
                    'Product_Idn' => $product_idn,
                    'Quantity' => 0,
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

                $inserts[] = $this->CI->m_worksheet_detail->insert($insert_data);
            }

            $insert = (in_array(false, $inserts)) ? false : true;
        }

        return $insert;
    }

    /**
     * Summary of save_adjustment_factor
     * @param mixed $data
     * @return mixed
     */
    function save_adjustment_factor($data)
    {
        //declare and initialize variables
        $save = false;
        $table_name = "WorksheetFactorDetails";
        $set = array();
        $keys = array();

        if (!empty($data))
        {
            $keys = array(
                "Worksheet_Idn" => $data['Worksheet_Idn'],
                "Section" => $data['Section'],
                "Rank" => $data['Rank']
                );

            $af_data = $this->CI->m_reference_table->get_where($table_name, $keys);

            if (empty($af_data))
            {
                //Insert record
                $save = $this->CI->m_reference_table->insert($table_name, $data);
            }
            else
            {
                $set = array(
                    "AdjustmentSubFactor_Idn" => $data['AdjustmentSubFactor_Idn']
                    );

				if (isset($data['UserValue']) && $data['UserValue'] != 'x')
				{
					$set['UserValue'] = number_format(str_replace(",","",$data['UserValue']), 2);
					$set['UserValueFlag'] = 1;
				}

                //Update record
                $save = $this->CI->m_reference_table->update($table_name, $set, $keys);
            }
        }

        return $save;
    }

    /**
     * Summary of save_engineering_worksheet
     * @param mixed $data
     * @return int
     */
    function save_engineering_worksheet($data)
    {
        $errors = 0;
        $set = array();
        $where = array();

        //Basic appropriations
        $branchline_worksheet_idn = 0;
        $individual_adjustment_factor = 0;
        $original_system_quantity = 0;

        //Additional costs
        $quantity = 0;
        $field_hours = 0;
        $additional_cost = 0;

        //Save Labor Class & Individual Adjustment Factors
        $where = array("Worksheet_Idn" => $data['Worksheet_Idn']);

        if (isset($data['LaborClass'])) 
        {
            foreach($data['LaborClass'] as $index => $labor_class)
            {
                //Set values
                $branchline_worksheet_idn = substr($index, strpos($index,"_") + 1);
                $individual_adjustment_factor = $data['IndividualAdjustmentFactor'][$index];

                if ($individual_adjustment_factor == 148)
                {
                    $original_system_quantity = $data['OriginalSystemQuantity'][$index];
                }

                //Build set and where clauses
                $set = array(
                    "LaborClass_Idn" => $labor_class,
                    "AdjustmentFactor_Idn" => $individual_adjustment_factor,
                    "OriginalSystemQuantity" => $original_system_quantity
                    );

                $where['BranchlineWorksheet_Idn'] = $branchline_worksheet_idn;

                //Save record
                if ($this->CI->m_reference_table->update("WorksheetBasicAppropriationDetails", $set, $where) == false)
                {
                    $errors++;
                }
            }
        }

        $where = array("Worksheet_Idn" => $data['Worksheet_Idn']);

        //Save Additional Costs
        foreach($data['Quantity'] as $index => $quantity)
        {
            //Set values
            $field_hours = (isset($data['EngineeringUnitPrice'][$index])) ? $data['EngineeringUnitPrice'][$index] : 0;
            $additional_cost = substr($index, strpos($index,"_") + 1);

            //Build set and where clauses
            $set = array(
                "Quantity" => string_filter($quantity, ","),
                "FieldManHours" => string_filter($field_hours, ",")
                );

            $where['AdditionalCost_Idn'] = $additional_cost;

            //Save record
            if ($this->CI->m_reference_table->update("WorksheetEngineeringAdditionalCosts", $set, $where) == false)
            {
                $errors++;
            }
        }

        return $errors;
    }

    function save_jobmob_worksheet($data)
    {
        $errors = 0;
        $set = array();
        $where = array();
        $fts_sections = "";
        $job_keys = array();

        //Load models
        $this->CI->load->model("m_job_parm_detail");

        $job_keys = get_job_keys($data['JobNumber']);

        //*************Save Worksheet parms*****************//

        //Field and Subsistence sections
        if (isset($data['fts_section']))
        {
            $fts_sections = implode(",", $data['fts_section']);
        }

        $set = array(
            "Parm_Idn" => 0,
            "ParmValue" => $fts_sections
            );

        $where = array(
            "Worksheet_Idn" => $data['Worksheet_Idn'],
            "ParmReference" => "FTSSections"
            );

        if ($this->CI->m_reference_table->update("WorksheetParms", $set, $where) == false)
        {
            $errors++;
        }

        //Miles to job
        $set = array(
            "NumericValue" => string_filter($data['Miles'], ","));
        $where = array(
            "Job_Idn" => $job_keys[0],
            "ChangeOrder" => $job_keys[1],
            "JobDefault_Idn" => 31
            );

        if ($this->CI->m_reference_table->update("JobParmDetails", $set, $where) == false)
        {
            $errors++;
        }

        //Motel daily rate
        $set = array(
            "NumericValue" => string_filter($data['MotelDailyRate'], ","));
        $where = array(
            "Job_Idn" => $job_keys[0],
            "ChangeOrder" => $job_keys[1],
            "JobDefault_Idn" => 32
            );

        if ($this->CI->m_reference_table->update("JobParmDetails", $set, $where) == false)
        {
            $errors++;
        }

        //Save job Mob worksheet data
        $set = array();
        $where = array();

        $set = array(
            "des_exp_air_rate" => string_filter($data['AirFare'], ","),
            "frt_quoted" => (isset($data['frt_quoted'])) ? 1 : 0,
            "des_exp_veh_miles" => string_filter($data['DES_EXP_VEH_MILES'], ","),
			"des_exp_veh_trips" => string_filter($data['DES_EXP_VEH_TRIPS'], ","),
			"des_exp_air_trips" => string_filter($data['DES_EXP_AIR_TRIPS'], ","),
			"des_exp_car_days" => string_filter($data['DES_EXP_CAR_DAYS'], ","),
			"des_exp_car_rate" => string_filter($data['DES_EXP_CAR_RATE'], ","),
			"des_exp_car_trips" => string_filter($data['DES_EXP_CAR_TRIPS'], ","),
			"des_wag_miles" => string_filter($data['DES_WAG_MILES'], ","),
			"des_wag_trips" => string_filter($data['DES_WAG_TRIPS'], ","),
			"des_wag_air_hrs" => string_filter($data['DES_WAG_AIR_HRS'], ","),
			"des_wag_air_trips" => string_filter($data['DES_WAG_AIR_TRIPS'], ","),
			"des_sub_lod_days" => string_filter($data['DES_SUB_LOD_DAYS'], ","),
			"des_sub_lod_rate" => string_filter($data['DES_SUB_LOD_RATE'], ","),
			"des_sub_mea_days" => string_filter($data['DES_SUB_MEA_DAYS'], ","),
			"des_sub_mea_rate" => string_filter($data['DES_SUB_MEA_RATE'], ",")
            );

        if (in_array(1,$data['fts_section']))
        {
            $set['f_trk_exp_off_mil'] = string_filter($data['F_TRK_EXP_OFF_MIL'], ",");
            $set['f_trk_exp_off_trips'] = string_filter($data['F_TRK_EXP_OFF_TRIPS'], ",");
            $set['f_trk_exp_hot_mil'] = string_filter($data['F_TRK_EXP_HOT_MIL'], ",");
            $set['f_trk_exp_hot_trips'] = string_filter($data['F_TRK_EXP_HOT_TRIPS'], ",");
        }
        else
        {
            //$set['f_trk_exp_off_mil'] = 0;
            $set['f_trk_exp_off_trips'] = 0;
            //$set['f_trk_exp_hot_mil'] = 0;
            $set['f_trk_exp_hot_trips'] = 0;
        }

        //fts_section2
        if (in_array(2,$data['fts_section']))
        {
            $set['f_veh_exp_air_trips'] = string_filter($data['F_VEH_EXP_AIR_TRIPS'], ",");
            $set['f_veh_exp_air_rate'] = string_filter($data['F_VEH_EXP_AIR_RATE'], ",");
            $set['f_veh_exp_car_days'] = string_filter($data['F_VEH_EXP_CAR_DAYS'], ",");
            $set['f_veh_exp_car_rate'] = string_filter($data['F_VEH_EXP_CAR_RATE'], ",");
            $set['f_veh_exp_car_trips'] = string_filter($data['F_VEH_EXP_CAR_TRIPS'], ",");
        }
        else
        {
            $set['f_veh_exp_air_trips'] = 0;
            $set['f_veh_exp_car_trips'] = 0;
        }

        //fts section 3
        if (in_array(3,$data['fts_section']))
        {
            $set['f_wag_miles'] = string_filter($data['F_WAG_MILES'], ",");
            $set['f_wag_workers'] = string_filter($data['F_WAG_WORKERS'], ",");
            $set['f_wag_rate'] = string_filter($data['F_WAG_RATE'], ",");
            $set['f_wag_trips'] = string_filter($data['F_WAG_TRIPS'], ",");
            $set['f_wag_air_hrs'] = string_filter($data['F_WAG_AIR_HRS'], ",");
            $set['f_wag_air_rate'] = string_filter($data['F_WAG_AIR_RATE'], ",");
            $set['f_wag_air_trips'] = string_filter($data['F_WAG_AIR_TRIPS'], ",");
        }
        else
        {
            $set['f_wag_trips'] = 0;
            $set['f_wag_air_trips'] = 0;
        }

        //Subsistence
        //fts section 4
        if (in_array(4,$data['fts_section']))
        {
            $set['override_total_field_hours'] = (isset($data['OVERRIDE_TOTAL_FIELD_HOURS'])) ? 1 : 0;
            $set['user_total_field_hours'] = string_filter($data['USER_TOTAL_FIELD_HOURS'], ",");
            $set['f_sub_pay'] = string_filter($data['F_SUB_PAY'], ",");
        }
        else
        {

        }
        //$sql_f_sub_tvl_hrs = (isset($_POST['F_SUB_TVL_HRS'])) ? string_filter($_POST['F_SUB_TVL_HRS'], ',') : 0;
        //$sql_f_sub_motel = (isset($_POST['F_SUB_MOTEL'])) ? string_filter($_POST['F_SUB_MOTEL'], ',') : 0;
        //$sql_f_sub_meals = (isset($_POST['F_SUB_MEALS'])) ? string_filter($_POST['F_SUB_MEALS'], ',') : 0;
        //$sql_f_sub_pay = (isset($_POST['F_SUB_PAY'])) ? string_filter($_POST['F_SUB_PAY'], ',') : 0;
        //$sql_override_total_field_hours = (isset($_POST['OVERRIDE_TOTAL_FIELD_HOURS'])) ? string_filter($_POST['OVERRIDE_TOTAL_FIELD_HOURS'], ',') : 0;
        //$sql .= ", f_sub_tvl_hrs =  {$sql_f_sub_tvl_hrs},
        //    f_sub_motel =  {$sql_f_sub_motel},
        //    f_sub_meals =  {$sql_f_sub_meals},
        //    f_sub_pay =  {$sql_f_sub_pay},
        //    override_total_field_hours = {$sql_override_total_field_hours}";

        //Sunday Travel
        if (in_array(5,$data['fts_section']))
        {
            $set['f_sun_wrk_weeks'] = string_filter($data['F_SUN_WRK_WEEKS'], ",");
            $set['f_sun_meal'] = string_filter($data['F_SUN_MEAL'], ",");
        }
        else
        {
            $set['f_sun_wrk_weeks'] = 0;
            $set['f_sun_meal'] = 0;
        }

        //Interim Travel
        if (in_array(6,$data['fts_section']))
        {
            $set['interim_hours'] = string_filter($data['INTERIM_HOURS'], ",");
            $set['interim_rate'] = string_filter($data['INTERIM_RATE'], ",");
            $set['interim_trips'] = string_filter($data['INTERIM_TRIPS'], ",");
        }
        else
        {
            $set['interim_trips'] = 0;
        }

        //Freight costs
        $set['del_exp_stk_mil'] = string_filter($data['DEL_EXP_STK_MIL'], ",");
        $set['del_exp_stk_trips'] = string_filter($data['DEL_EXP_STK_TRIPS'], ",");
        $set['del_wag_miles'] = string_filter($data['DEL_WAG_MILES'], ",");
        $set['del_wag_rate'] = string_filter($data['DEL_WAG_RATE'], ",");
        $set['del_wag_trips'] = string_filter($data['DEL_WAG_TRIPS'], ",");
        $set['del_sub_rate'] = string_filter($data['DEL_SUB_RATE'], ",");
        $set['del_sub_trips'] = string_filter($data['DEL_SUB_TRIPS'], ",");
        $set['frt_loads'] = string_filter($data['FRT_LOADS'], ",");
        $set['frt_rate'] = string_filter($data['FRT_RATE'], ",");
        $set['frt_quoted'] = (isset($data['frt_quoted'])) ? 1 : 0;

        $where = array("Worksheet_Idn" => $data['Worksheet_Idn']);

        //Save record
        if ($this->CI->m_reference_table->update("JobMobWorksheets", $set, $where) == false)
        {
            $errors++;
        }

        return $errors;
    }

	//function update_eng_labor_class($job_number = 0, $branch_line_worksheet_idn = 0, $pipe_exposure = 0)
	//{
	//    $results = false;
	//    $job_keys = array();
	//    $engineering_worksheet_idn = 0;
	//    $where = "";

	//    if ($job_number > 0 && $branch_line_worksheet_idn > 0)
	//    {
	//        $job_keys = get_job_keys($job_number);
	//        $where = "Job_Idn = {$job_keys[0]} and ChangeOrder = {$job_keys[1]} and WorksheetMaster_Idn = 22";

	//        //Get engineering worksheet_idn
	//        $engineering_worksheet_idn = $this->CI->m_reference_table->get_field("Worksheets", "Worksheet_Idn", $where);

	//        //Get Branch line labor class

	//        //Update Basic Appropriation labor class
	//    }

	//    return $results;
    //}

    public function save_sh_engineering_defaults($worksheet_idn, $job_number)
    {
        $results = array(
            "return_code" => 0,
            "inserts" => 0,
            "updates" => 0,
            "errors" => 0,
        );
        $panels_and_as_builts_results = array();
        $design_build_systems_results = array();
        $power_supply_results = array();

        if (isset($worksheet_idn) && $worksheet_idn > 0 && isset($job_number) && !empty($job_number))
        {

            $panels_and_as_builts_results = $this->save_panels_and_as_builts($worksheet_idn, $job_number);

            $design_build_systems_results = $this->save_design_build_systems($worksheet_idn, $job_number);

            $power_supply_results = $this->save_power_supplies($worksheet_idn, $job_number);

            //Combine results
            $results['inserts'] = $panels_and_as_builts_results['inserts'] + $design_build_systems_results['inserts'] + $power_supply_results['inserts'];
            $results['errors'] = $panels_and_as_builts_results['errors'] + $design_build_systems_results['errors'] + $power_supply_results['errors'];
            $results['updates'] = $panels_and_as_builts_results['updates'] + $design_build_systems_results['updates'] + $power_supply_results['updates'];

            if ($results['errors'] > 0)
            {
                $results['return_code'] = -1;
            }

            if ($results['inserts'] > 0 || $results['updates'] > 0)
            {
                $results['return_code'] = 1;
            }
        }
        else
        {
            write_feci_log(array("Message" => "Invalid arguments passed to ".__METHOD__, "Script" => get_caller_info()));
        }
        return $results;
    }

    public function save_panels_and_as_builts($worksheet_idn, $job_number)
    {
        $results = array(
            "inserts" => 0,
            "updates" => 0,
            "errors" => 0,
        );
        if (isset($worksheet_idn) && !empty($worksheet_idn) && isset($job_number) && !empty($job_number))
        {
            $job_keys = get_job_keys($job_number);

            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1],
                "p.WorksheetCategory_Idn" => 3
            );

            //Get all panels from panels and devices worksheets
            $this->CI->db
                ->select('wd.Product_Idn, p.Name, p.EngineerUnitPrice, sum(wd.Quantity) AS Quantity')
                ->from('Worksheets AS w')
                ->join('WorksheetDetails AS wd', 'w.Worksheet_Idn = wd.Worksheet_Idn', 'Left')
                ->join('Products AS p', 'wd.Product_Idn = p.Product_Idn', 'Left')
                ->where($where)
                ->group_by("wd.Product_Idn, p.name, p.EngineerUnitPrice")
                ->order_by("wd.Product_Idn, p.name, p.EngineerUnitPrice");
            $query = $this->CI->db->get();

            if ($query->num_rows() > 0)
            {
                //Insert or update misc detail for each panel in Control or Releasing Panels (WorksheetCategory_Idn = 43),
                //and another record in As-Builts and O & M's (WorksheetCategory_Idn = 61) for half the engineering hours
                foreach ($query->result_array() as $row)
                {
                    //**************************************************
                    // Release panel logic (WorksheetCategory_Idn = 43)
                    //**************************************************
                    $release_panel_where = array(
                        "Worksheet_Idn" => $worksheet_idn,
                        "WorksheetCategory_Idn" => 43,
                        "MasterProduct_Idn" => $row['Product_Idn']
                    );

                    //Check to see if matching misc detail exists
                    $this->CI->db
                        ->select("MiscellaneousDetail_Idn")
                        ->from("MiscellaneousDetails")
                        ->where($release_panel_where);
                    $query = $this->CI->db->get();

                    if ($query->num_rows() > 0)
                    {
                        //Update release panel
                        $release_panel_set = array(
                            "Quantity" => $row['Quantity']
                        );

                        if ($this->CI->m_miscellaneous_detail->update($release_panel_set, $release_panel_where))
                        {
                            $results['updates']++;
                        }
                        else
                        {
                            $results['errors']++;
                        }
                    }
                    else
                    {
                        //Insert relase panel
                        $panel_data = array(
                            "Worksheet_Idn" => $worksheet_idn,
                            "Quantity" => $row['Quantity'],
                            "Name" => $row['Name'],
                            "EngineerUnitPrice" => $row['EngineerUnitPrice'],
                            "OriginalEngineerUnitPrice" => $row['EngineerUnitPrice'],
                            "WorksheetCategory_Idn" => 43,
                            "MasterProduct_Idn" => $row['Product_Idn']
                        );
                        
                        if ($this->CI->m_miscellaneous_detail->insert($panel_data))
                        {
                            $results['inserts']++;
                        }
                        else
                        {
                            $results['errors']++;
                        }
                    }

                    //************************************************************
                    // As Builts and O & M's logic (WorksheetCategory_Idn = 61)
                    //************************************************************
                    $builts_where = array(
                        "Worksheet_Idn" => $worksheet_idn,
                        "WorksheetCategory_Idn" => 61,
                        "MasterProduct_Idn" => $row['Product_Idn']
                    );
                    
                    //Check to see if matching misc detail exists
                    $this->CI->db
                        ->select("MiscellaneousDetail_Idn")
                        ->from("MiscellaneousDetails")
                        ->where($builts_where);
                    $query = $this->CI->db->get();

                    if ($query->num_rows() > 0)
                    {
                        //Update release panel
                        $builts_set = array(
                            "Quantity" => $row['Quantity']
                        );

                        if ($this->CI->m_miscellaneous_detail->update($builts_set, $builts_where))
                        {
                            $results['updates']++;
                        }
                        else
                        {
                            $results['errors']++;
                        }
                    }
                    else
                    {
                        //Insert misc detail record
                        $half_eng_unit_price = round($row['EngineerUnitPrice'] / 2);
                        $builts_data = array(
                            "Worksheet_Idn" => $worksheet_idn,
                            "Quantity" => $row['Quantity'],
                            "Name" => $row['Name'],
                            "EngineerUnitPrice" => $half_eng_unit_price,
                            "OriginalEngineerUnitPrice" => $half_eng_unit_price,
                            "WorksheetCategory_Idn" => 61,
                            "MasterProduct_Idn" => $row['Product_Idn']
                        );

                        if ($this->CI->m_miscellaneous_detail->insert($builts_data))
                        {
                            $results['inserts']++;
                        }
                        else
                        {
                            $results['errors']++;
                        }
                    }
                }
            }
        }
        else
        {
            write_feci_log(array("Message" => "Invalid arguments passed to ".__METHOD__, "Script" => get_caller_info()));
        }

        return $results;
    }

    public function save_design_build_systems($worksheet_idn, $job_number)
    {
        $job_keys = array();
        $results = array(
            "inserts" => 0,
            "updates" => 0,
            "errors" => 0
        );

        if (isset($worksheet_idn) && !empty($worksheet_idn) && !empty($job_number))
        {
            $job_keys = get_job_keys($job_number);

            //*******************************************************************
            // Save misc detail records for Design Build Systems
            //*******************************************************************
            //Get count of devices (detectors(4), pull stations(5), modules(41) and notification (7))
            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1],
            );

            $this->CI->db
                ->select_sum('wd.Quantity')
                ->from('Worksheets AS w')
                ->join('WorksheetDetails AS wd', 'w.Worksheet_Idn = wd.Worksheet_Idn', 'Left')
                ->join('Products AS p', 'wd.Product_Idn = p.Product_Idn', 'Left')
                ->where($where)
                ->where_in("p.WorksheetCategory_Idn", array(4,5,7,41));
            $query = $this->CI->db->get();

            //Insert misc detail for 1-20 devices into Design Build Systems (WorksheetCategory_Idn = 55)
            $row = $query->row();
            $num_devices = $row->Quantity;
            
            $delete_where = array(
                "Worksheet_Idn" => $worksheet_idn,
                "WorksheetCategory_Idn" => 55
            );

            //Delete existing records, because it's easier
            $this->CI->m_miscellaneous_detail->delete($delete_where);

            if ($num_devices > 0)
            {
                //write_feci_log(array("Message" => "num_devices=".$num_devices, "Script" => "save_design_build_systems"));
                
                //Insert row for 1-20 devices into Design Build Systems category
                $device_data = array(
                    "Worksheet_Idn" => $worksheet_idn,
                    "Quantity" => 1,
                    "Name" => "1-20 Devices",
                    "EngineerUnitPrice" => 2,
                    "OriginalEngineerUnitPrice" => 2,
                    "WorksheetCategory_Idn" => 55
                );

                if ($this->CI->m_miscellaneous_detail->insert($device_data))
                {
                    $results['inserts']++;
                }
                else
                {
                    $results['errors']++;
                }

                //If there are more than 20 devices, insert a misc line item with quantity of devices over 20 
                $twenty_plus_devices = $num_devices - 20;

                if ($twenty_plus_devices > 0)
                {
                    $device_data = array(
                        "Worksheet_Idn" => $worksheet_idn,
                        "Quantity" => $twenty_plus_devices,
                        "Name" => "Each Additional Device",
                        "EngineerUnitPrice" => '.05',
                        "OriginalEngineerUnitPrice" => '.05',
                        "WorksheetCategory_Idn" => 55
                    );

                    if ($this->CI->m_miscellaneous_detail->insert($device_data))
                    {
                        $results['inserts']++;
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
            write_feci_log(array("Message" => "Invalid arguments passed to ".__METHOD__, "Script" => get_caller_info()));
        }

        return $results;
    }

    public function save_power_supplies($worksheet_idn, $job_number)
    {
        $job_keys = array();
        $results = array(
            "inserts" => 0,
            "updates" => 0,
            "errors" => 0
        );

        if (isset($worksheet_idn) && !empty($worksheet_idn) && !empty($job_number))
        {
            $job_keys = get_job_keys($job_number);

            //Get count of power supplies (10)
            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1],
                "p.WorksheetCategory_Idn" => 10
            );

            $this->CI->db
                ->select_sum('wd.Quantity')
                ->from('Worksheets AS w')
                ->join('WorksheetDetails AS wd', 'w.Worksheet_Idn = wd.Worksheet_Idn', 'Left')
                ->join('Products AS p', 'wd.Product_Idn = p.Product_Idn', 'Left')
                ->where($where);

            $query = $this->CI->db->get();

                //Insert misc detail for first power supply (WorksheetCategory_Idn = 58)
            $row = $query->row();
            $num_power_supplies = $row->Quantity;
            
            $delete_where = array(
                "Worksheet_Idn" => $worksheet_idn,
                "WorksheetCategory_Idn" => 58
            );

            //Delete existing records, because it's easier
            $this->CI->m_miscellaneous_detail->delete($delete_where);

            if ($num_power_supplies > 0)
            {
                //Insert row for 1-20 power_supplies into Design Build Systems category
                $power_supply_data = array(
                    "Worksheet_Idn" => $worksheet_idn,
                    "Quantity" => 1,
                    "Name" => "First Power Supply",
                    "EngineerUnitPrice" => 4,
                    "OriginalEngineerUnitPrice" => 4,
                    "WorksheetCategory_Idn" => 58
                );

                if ($this->CI->m_miscellaneous_detail->insert($power_supply_data))
                {
                    $results['inserts']++;
                }
                else
                {
                    $results['errors']++;
                }

                //If there are more than 1 power_supply, insert a misc line item with quantity of power_supplies  
                $remaining_power_supplies = $num_power_supplies - 1;

                if ($num_power_supplies > 1)
                {
                    $additional_power_supply_data = array(
                        "Worksheet_Idn" => $worksheet_idn,
                        "Quantity" => $remaining_power_supplies,
                        "Name" => "Each Additional Power Supply",
                        "EngineerUnitPrice" => '2',
                        "OriginalEngineerUnitPrice" => '2',
                        "WorksheetCategory_Idn" => 58
                    );

                    if ($this->CI->m_miscellaneous_detail->insert($additional_power_supply_data))
                    {
                        $results['inserts']++;
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
            write_feci_log(array("Message" => "Invalid arguments passed to ".__METHOD__, "Script" => get_caller_info()));
        }

        return $results;
    }

    public function delete_sh_eng_detail($eng_worksheet_idn, $job_number, $delete_id)
    {
        $where = array();
        $delete_panels = "";
        $delete_design_build_systems = array();
        $delete_power_supplies = array();

        if ($eng_worksheet_idn > 0 && isset($job_number) && isset($delete_id))
        {
            $where = array(
                "Product_Idn" => $delete_id
            );
    
            //Get Panel & Devices WorksheetCategory
            $worksheet_category_idn = $this->CI->m_reference_table->get_field("Products","WorksheetCategory_Idn",$where);

            switch($worksheet_category_idn)
            {
                case 3: //Panels
                    //Delete corresponding Release Panel and Built As MiscellaneousDetails records
                    $delete_panels = "Worksheet_Idn = {$eng_worksheet_idn} AND WorksheetCategory_Idn IN (61,43) AND MasterProduct_Idn = {$delete_id}";
                    $this->CI->m_miscellaneous_detail->delete($delete_panels);
                    $this->save_panels_and_as_builts($eng_worksheet_idn, $job_number);
                    break;
                case 4: //Devices
                case 5:
                case 7:
                case 41:
                    //Delete and recalculate Device count in Design Build Systems                
                    $delete_design_build_systems = array(
                        "Worksheet_Idn" => $eng_worksheet_idn,
                        "WorksheetCategory_Idn" => 55
                    );
                    $this->CI->m_miscellaneous_detail->delete($delete_design_build_systems);

                    //Recreate misc detail records in Design Build Systems
                    $this->save_design_build_systems($eng_worksheet_idn, $job_number);
                    break;
                case 10: //Power Supply
                    //Delete and recalculate Power Supplies
                    $delete_power_supplies = array(
                        "Worksheet_Idn" => $eng_worksheet_idn,
                        "WorksheetCategory_Idn" => 58
                    );
                    $this->CI->m_miscellaneous_detail->delete($delete_power_supplies);

                    //Recreate misc detail records in Design Build Systems
                    $this->save_power_supplies($eng_worksheet_idn, $job_number);
                    break;
            }
        }
        else
        {
            write_feci_log(array("Message" => "Invalid arguments passed to ".__METHOD__, "Script" => get_caller_info()));
        }

        return true;
    }

    public function saveDefaults()
    {
        $response = array(
            "status" => 500,
            "message" => "Internal server error.",
            "inserts" => array(),
            "deletes" => array(),
            "errors" => array()
        );
        $matches = array();
        
        //Get worksheet parameters from header
        $post = $this->CI->input->post();

        if (!empty($post))
        {
            $worksheet_master = $this->wm;
            $worksheet_idn = $this->w_id;
            $worksheet_master_idn = $worksheet_master['WorksheetMaster_Idn'];
            $existing_product_idns = (isset($post['Id'])) ? $post['Id'] : array();

            //*****************************************
            //Save worksheet parms
            //*****************************************
            if (!isset($post['Debug']))
            {
                $response['errors'] = array_merge($this->save_worksheet_parms($worksheet_idn, $post));
            }

            //Get All Products in worksheet categories
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

            $worksheet_master_products = $this->CI->m_reference_table->get_where("Products", $sql_where, "WorksheetCategory_Idn ASC, Rank ASC");

            $matches = $this->_find_matching_products($worksheet_master_products, $post);

            $compared_products = compare_products($matches['potential_adds']);

            $products_to_add = $compared_products['filtered_products'];

            if (isset($post['Debug']))
            {
                $response['debug'] = $matches['debug'];
            }
            else
            {
                //Insert products
                $i = 0;
                foreach($products_to_add as $product)
                {
                    if (in_array($product['Product_Idn'], $existing_product_idns) == false) //Only insert product does not exsit in worksheet
                    {
                        if ($this->insert_worksheet_detail_by_product_idns($product['Product_Idn'], $worksheet_idn))
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
                            $product_data = $this->CI->m_worksheet->get_worksheet_details_extended($worksheet_idn, $worksheet_master_idn, array(), $where);
                            $Row = $product_data[$product['WorksheetCategory_Idn']][0];

                            //Get html for new row
                            $html = $this->CI->load->view("worksheet/worksheet_products", array("Row" => $Row, "CategoryName" => $Row['CategoryName'], 'worksheet_master' => $worksheet_master), true);

                            $response['inserts'][] = array("Html" => $html, "CategoryProductRank" => $Row['CategoryProductRank'], "WorksheetCategory_Idn" => $product['WorksheetCategory_Idn']);

                            $i++;
                        }
                        else
                        {
                            $response['errors'][] = $product['Product_Idn'];
                        }
                    }
                }

                //Delete products
                if (!empty($matches['deletes']))
                {
                    $this->CI->load->model('m_worksheet_detail');
                }
                $where = array();

                foreach($matches['deletes'] as $product_idn)
                {
                    $where = array(
                        "Worksheet_Idn" => $worksheet_idn,
                        "Product_Idn" => $product_idn
                        );

                    if ($this->CI->m_worksheet_detail->delete($where))
                    {
                        $response['deletes'][] = $product_idn;
                    }
                    else
                    {
                        $response['errors'][] = $product_idn;
                    }
                }
            }
        }
        else
        {
            $response['status'] = 400;
            $response['message'] = "Invalid post data";
        }

        if (sizeof($response['errors']) > 0)
        {
            $response['status'] = 204;
            $response['message'] = "Completed with errors.";
        }
        else
        {
            $response['status'] = 200;
            $response['message'] = "Worksheet defaults saved successfully.";
        }

        return $response;

    }

    private function _find_matching_products($worksheet_master_products, $post)
    {
        $matches = array(
            'potential_adds' => array(),
            'deletes' => array(),
            'debug' => array()
        );
        $worksheet_master = $this->wm;
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
        $job_number = format_job_number($this->_job_keys[0], $this->_job_keys[1]);
        $domestic_required = get_job_parm($job_number,28);
        $grooved_fitting = get_job_parm($job_number,78);

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
                    if ($domestic_required['AlphaValue'] == 'N' || ($domestic_required['AlphaValue'] == 'Y' && $product['DomesticFlag'] == 1))
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
                if (round($grooved_fitting['NumericValue'],0) == 0 || round($grooved_fitting['NumericValue'],0) == 3 || $product['WorksheetCategory_Idn'] != 97)
                {
                    $match['grooved_fitting'] = 1;
                }
                else
                {
                    //product matches grooved fitting type
                    if ($product['GroovedFittingType_Idn'] == round($grooved_fitting['NumericValue'], 0))
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

            if (isset($post['Debug']) && $post['Debug'] == $product['Product_Idn'])
            {
                $match['product_idn'] = $product['Product_Idn'];
                $matches['debug'] = $match;               
            }
        } //END: foreach

        $matches['potential_adds'] = $potential_products_to_add;
        $matches['deletes'] = $products_to_delete;

        return $matches;
    }
}
// END Worksheet Class