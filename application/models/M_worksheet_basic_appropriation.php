<?php
class M_worksheet_basic_appropriation extends CI_Model {
	
	private $_table_name = 'WorksheetBasicAppropriationDetails';

    function __construct()
    {
        parent::__construct();
    }

	/**
	 * get_by_worksheet_idn
	 *
	 * Gets worksheet basic appropriations and corresponding man hours per item by worksheet_idn
	 *
     * @access  public
	 * @param 	$w_id(integer)
	 * @return 	$data(array)
	 */
	
	public function get_by_worksheet_idn($w_id, $worksheet_area_idn = 0)
	{
		//Delcare and initialize variables
		$data = array();
        $query = false;
		
        //Total of Basic Appropriations section
        $sql = "SELECT Quantity,
				    ba.AdjustmentFactor_Idn,
				    asf2.Value AS AdjustmentFactorValue,
				    ba.LaborClass_Idn,
				    asf.Value AS LaborClassValue,
				    ba.OriginalSystemQuantity,
				    ba.BranchLineWorksheet_Idn,
                    w.Name,
                    wp.Parm_Idn,
                    pe.Name AS PipeExposure
			    FROM WorksheetBasicAppropriationDetails AS ba
			    LEFT JOIN Worksheets AS w ON (ba.BranchlineWorksheet_Idn = w.Worksheet_Idn)
			    LEFT JOIN AdjustmentSubFactors AS asf ON (ba.LaborClass_Idn = asf.AdjustmentSubFactor_Idn)
			    LEFT JOIN AdjustmentSubFactors AS asf2 ON (ba.AdjustmentFactor_Idn = asf2.AdjustmentSubFactor_Idn)
                LEFT JOIN WorksheetParms AS wp ON (ba.BranchLineWorksheet_Idn = wp.Worksheet_Idn AND wp.ParmReference = 'PipeExposure')
                LEFT JOIN PipeExposures AS pe ON (wp.Parm_Idn = pe.PipeExposure_Idn)
			    WHERE ba.Worksheet_Idn = {$w_id}";

        if ($worksheet_area_idn > 0)
        {
            $sql .= " AND w.WorksheetArea_Idn = {$worksheet_area_idn}";
        }

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

    public function insert($worksheet_idn, $job_number)
    {
        //Declare and initialize variables
        $job_keys = get_job_keys($job_number);
        $query = false;
        $branch_line_worksheet_idn = 0;
        $adjustment_factor_idn = 0;
        $insert_data = array();
        $insert = false;
        $labor_class_adjustments = array();
        $labor_class_idn = 0;
		$branch_labor_class_idn = 0;
        $pipe_exposure_adjustment_factor = 0;

        //Load model
        $this->load->model("m_reference_table");
		$this->load->model("m_worksheet");

        //Load library
        $this->load->library("worksheet");

        //Get Branch Line Worksheets for job
        $this->db->select("Worksheet_Idn")
            ->from("Worksheets")
            ->where("WorksheetMaster_Idn", 9)
            ->where("Job_Idn", $job_keys[0])
            ->where("ChangeOrder", $job_keys[1])
			->where("Worksheet_Idn NOT IN (SELECT BranchLineWorksheet_Idn FROM WorksheetBasicAppropriationDetails where Worksheet_Idn = {$worksheet_idn})");

        $query = $this->db->get();

        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
            //Iterate through branch line worksheets and create corresponding engineering data
            foreach ($query->result_array() as $row)
            {
                $branch_line_worksheet_idn = $row['Worksheet_Idn'];

                //Get Labor Class on branch line worksheet
                $labor_class_adjustments = $this->m_worksheet->get_labor_class_adjustments($branch_line_worksheet_idn);

				$branch_labor_class_idn = $labor_class_adjustments['AdjustmentSubFactor_Idn'];

				//Get Pipe Exposure
				$pipe_exposure_adjustment_factor = ($this->m_reference_table->get_field("WorksheetParms", "Parm_Idn", "Worksheet_Idn = {$branch_line_worksheet_idn} and ParmReference = 'PipeExposure'") == 1) ? 34 : 35;

				//Get labor class for Engineering worksheet
				$labor_class_idn = $this->m_reference_table->get_field("AdjustmentSubFactors", "AdjustmentSubFactor_Idn", "AdjustmentFactor_Idn = {$pipe_exposure_adjustment_factor} AND LaborClass_Idn = {$branch_labor_class_idn}");

                $insert_data = array(
                    "Worksheet_Idn" => $worksheet_idn,
                    "BranchLineWorksheet_Idn" => $branch_line_worksheet_idn,
                    "AdjustmentFactor_Idn" => $adjustment_factor_idn,
                    "LaborClass_Idn" => $labor_class_idn
                    );

                $insert = $this->m_reference_table->insert($this->_table_name, $insert_data);

				if ($insert == false)
				{
					return false;
				}
            }
        }

        return true;
    }

	public function update($branch_line_worksheet_idn, $job_number)
	{
		//Declare and Initialize variables
		$job_keys = array();
		$engineering_worksheet_idn = 0;
		$labor_class_adjustments = array();
		$branch_labor_class_idn = 0;
		$pipe_exposure_adjustment_factor = 0;
		$labor_class_idn = 0;
		$update = false;

		//Load models
        $this->load->model("m_reference_table");

        $job_keys = get_job_keys($job_number);

		//Get Engineering worksheet_idn
		$engineering_worksheet_idn = $this->m_reference_table->get_field("Worksheets", "Worksheet_Idn", "Job_Idn = {$job_keys[0]} AND ChangeOrder = {$job_keys[1]} AND WorksheetMaster_Idn = 22");

		if (!empty($engineering_worksheet_idn) && $engineering_worksheet_idn > 0)
		{
			//Get Labor Class on branch line worksheet
			$labor_class_adjustments = $this->m_worksheet->get_labor_class_adjustments($branch_line_worksheet_idn);

			$branch_labor_class_idn = $labor_class_adjustments['AdjustmentSubFactor_Idn'];

			//Get Pipe Exposure
			$pipe_exposure_adjustment_factor = ($this->m_reference_table->get_field("WorksheetParms", "Parm_Idn", "Worksheet_Idn = {$branch_line_worksheet_idn} and ParmReference = 'PipeExposure'") == 1) ? 34 : 35;

			//Get labor class for Engineering worksheet
			$labor_class_idn = $this->m_reference_table->get_field("AdjustmentSubFactors", "AdjustmentSubFactor_Idn", "AdjustmentFactor_Idn = {$pipe_exposure_adjustment_factor} AND LaborClass_Idn = {$branch_labor_class_idn}");

			$update = $this->m_reference_table->update($this->_table_name, array("LaborClass_Idn" => $labor_class_idn), "Worksheet_Idn = {$engineering_worksheet_idn} AND BranchLineWorksheet_Idn = {$branch_line_worksheet_idn}");

			if ($update == false)
			{
				return false;
			}
		}

		return true;
	}
}