<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Cart_query_lib Class
*
* @author   TKO Consulting, LLC
*/
class Cart_query_lib
{
    //Public members
    public $worksheet_idn = "";
    public $sql_select = "";
    public $sql_from = "";
    public $sql_where = array();
    public $sql_order_by = "";
    public $sql_wd_join = "";

    //Private members
    private $CI;

	public function __construct()
	{
        //Set Code Igniter object
		$this->CI =& get_instance();

        //Load models
        $this->CI->load->model('m_reference_table');
	}

    /**
     * Summary of _set_defaults
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     */
    private function _set_defaults($worksheet_category_idn, $post)
    {
        //Defaults
        $this->worksheet_idn = (isset($post['Worksheet_Idn'])) ? $post['Worksheet_Idn'] : "";

        $this->sql_select = "p.Product_Idn, wd.Quantity, p.Name, p.MaterialUnitPrice, p.FieldUnitPrice, p.ShopUnitPrice, p.Description";
        $this->sql_from = "Products AS p";
        $this->sql_where = array(
            "p.ActiveFlag" => 1,
            "p.WorksheetCategory_Idn" => $worksheet_category_idn,
            "p.Department_Idn" => $post['Department_Idn']
            );
        $this->sql_order_by = "p.Rank ASC";
        $this->sql_wd_join = "p.Product_Idn = wd.Product_Idn AND wd.Worksheet_Idn = {$this->worksheet_idn}";
    }

    /**
     * Summary of default_query
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function default_query($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $this->CI->db
            ->select($this->sql_select)
            ->from($this->sql_from)
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($this->sql_where)
            ->order_by($this->sql_order_by);

        return $this->CI->db->get();
    }

    /**
     * Summary of get_pipe
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_pipe($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        //SELECT
        $sql_select = "p.Product_Idn, wd.Quantity, p.Name, pt.Name AS Type, gt.Name AS Grade, p.MaterialUnitPrice, p.DomesticFlag AS Domestic";

        //WHERE
        $sql_where = array(
            "WorksheetCategory_Idn" => $worksheet_category_idn,
            );

        //Pipe Type
        if ($post['PipeType'.$worksheet_category_idn] > 0)
        {
            $sql_where['p.PipeType_Idn'] = $post['PipeType'.$worksheet_category_idn];
        }

        //Schedule Type
        if ($post['ScheduleType'.$worksheet_category_idn] > 0)
        {
            $sql_where['p.ScheduleType_Idn'] = $post['ScheduleType'.$worksheet_category_idn];
        }

        //Domestic
        if ($post['Domestic'.$worksheet_category_idn] == 1)
        {
            $sql_where['p.DomesticFlag'] = $post['Domestic'.$worksheet_category_idn];
        }

        //Sizes
        $where_sizes = "";
        if (isset($post['Size']))
        {
            $size_idns = array();
            foreach($post['Size'] as $size_idn)
            {
                $size_idns[] = $size_idn;
            }

            $where_sizes = "s.ProductSize_Idn IN (".implode(",", $size_idns).")";
        }

        $sql_order_by = "s.Rank ASC, st.Rank ASC, p.MaterialUnitPrice ASC";

        $this->CI->db
            ->select($sql_select)
            ->from($this->sql_from)
            ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn","left")
            ->join("PipeTypes AS pt", "p.PipeType_Idn = pt.PipeType_Idn", "left")
            ->join("ScheduleTypes AS st", "p.ScheduleType_Idn = st.ScheduleType_Idn","left")
            ->join("GradeTypes AS gt", "p.GradeType_Idn = gt.GradeType_Idn","left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        if (!empty($where_sizes))
        {
            $this->CI->db->where($where_sizes);
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_threaded_fittings
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_threaded_fittings($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        //SELECT
        $sql_select = "p.Product_Idn, wd.Quantity, p.Name, pt.Name AS Type, ft.Name AS FittingType, p.MaterialUnitPrice, p.DomesticFlag AS Domestic";

        //WHERE
        $sql_where = array(
            "p.WorksheetCategory_Idn" => $worksheet_category_idn,
            );
        
        //Pipe Type
        if (isset($post['PipeType'.$worksheet_category_idn]) && $post['PipeType'.$worksheet_category_idn] > 0)
        {
            $sql_where['p.PipeType_Idn'] = $post['PipeType'.$worksheet_category_idn];
        }

        //Schedule Type
        if (isset($post['ThreadedFittingType'.$worksheet_category_idn]) && $post['ThreadedFittingType'.$worksheet_category_idn] > 0)
        {
            $sql_where['p.ThreadedFittingType_Idn'] = $post['ThreadedFittingType'.$worksheet_category_idn];
        }

        //Domestic
        if ($post['Domestic'.$worksheet_category_idn] == 1)
        {
            $sql_where['p.DomesticFlag'] = $post['Domestic'.$worksheet_category_idn];
        }

        //Sizes
        $where_sizes = "";
        if (isset($post['Size']))
        {
            $size_idns = array();
            foreach($post['Size'] as $size_idn)
            {
                $size_idns[] = $size_idn;
            }

            $where_sizes = "s.ProductSize_Idn IN (".implode(",", $size_idns).")";
        }

        //Fittings
        $where_fittings = "";
        if (isset($post['Fitting']))
        {
            $fitting_idns = array();
            foreach($post['Fitting'] as $fitting_idn)
            {
                $fitting_idns[] = $fitting_idn;
            }

            $where_fittings = "p.Fitting_Idn IN (".implode(",", $fitting_idns).")";
        }

        $sql_order_by = "s.Rank ASC, f.Rank ASC, p.MaterialUnitPrice ASC";

        $this->CI->db
            ->select($sql_select)
            ->from($this->sql_from)
            ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn","left")
            ->join("PipeTypes AS pt", "p.PipeType_Idn = pt.PipeType_Idn", "left")
            ->join("ThreadedFittingTypes AS ft", "p.ThreadedFittingType_Idn = ft.ThreadedFittingType_Idn","left")
            ->join("Fittings AS f", "p.Fitting_Idn = f.Fitting_Idn","left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        if (!empty($where_sizes))
        {
            $this->CI->db->where($where_sizes);
        }

        if (!empty($where_fittings))
        {
            $this->CI->db->where($where_fittings);
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_grooved_fittings
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_grooved_fittings($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        //SELECT
        //$sql_select = "p.Product_Idn, wd.Quantity, p.Name, pt.Name AS Type, ft.Name AS FittingType, p.MaterialUnitPrice, p.DomesticFlag AS Domestic";
		$sql_select = "p.Product_Idn, wd.Quantity, p.Name, pt.Name AS Type, p.MaterialUnitPrice, p.DomesticFlag AS Domestic";

        //WHERE
        $sql_where = array(
            "p.WorksheetCategory_Idn" => $worksheet_category_idn,
            "p.ActiveFlag" => 1
            );

        //Pipe Type
        if (isset($post['PipeType'.$worksheet_category_idn]) && $post['PipeType'.$worksheet_category_idn] > 0)
        {
            $sql_where['p.PipeType_Idn'] = $post['PipeType'.$worksheet_category_idn];
        }

        //Grooved Fitting Type
		//if (isset($post['GroovedFittingType'.$worksheet_category_idn]) && $post['GroovedFittingType'.$worksheet_category_idn] > 0)
		//{
		//    $sql_where['p.GroovedFittingType_Idn'] = $post['GroovedFittingType'.$worksheet_category_idn];
		//}

        //Domestic
        if ($post['Domestic'.$worksheet_category_idn] == 1)
        {
            $sql_where['p.DomesticFlag'] = $post['Domestic'.$worksheet_category_idn];
        }

        //Sizes
        $where_sizes = "";
        if (isset($post['Size']))
        {
            $size_idns = array();
            foreach($post['Size'] as $size_idn)
            {
                $size_idns[] = $size_idn;
            }

            $where_sizes = "s.ProductSize_Idn IN (".implode(",", $size_idns).")";
        }

        //Fittings
        $where_fittings = "";
        if (isset($post['Fitting']))
        {
            $fitting_idns = array();
            foreach($post['Fitting'] as $fitting_idn)
            {
                $fitting_idns[] = $fitting_idn;
            }

            $where_fittings = "p.Fitting_Idn IN (".implode(",", $fitting_idns).")";
        }

        $sql_order_by = "s.Rank ASC, f.Rank ASC, p.MaterialUnitPrice ASC";

        $this->CI->db
            ->select($sql_select)
            ->from($this->sql_from)
            ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn","left")
            ->join("PipeTypes AS pt", "p.PipeType_Idn = pt.PipeType_Idn", "left")
            //->join("GroovedFittingTypes AS ft", "p.GroovedFittingType_Idn = ft.GroovedFittingType_Idn","left")
            ->join("Fittings AS f", "p.Fitting_Idn = f.Fitting_Idn","left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        if (!empty($where_sizes))
        {
            $this->CI->db->where($where_sizes);
        }

        if (!empty($where_fittings))
        {
            $this->CI->db->where($where_fittings);
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_other_fittings
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_other_fittings($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        //SELECT
        $sql_select = "p.Product_Idn, wd.Quantity, p.Name, pt.Name AS Type, p.MaterialUnitPrice, p.DomesticFlag AS Domestic";

        //WHERE
        $sql_where = array(
            "p.WorksheetCategory_Idn" => $worksheet_category_idn,
            "p.ActiveFlag" => 1
            );

        //Pipe Type
        if (isset($post['PipeType'.$worksheet_category_idn]) && $post['PipeType'.$worksheet_category_idn] > 0)
        {
            $sql_where['p.PipeType_Idn'] = $post['PipeType'.$worksheet_category_idn];
        }

        //Domestic
        if (isset($post['Domestic'.$worksheet_category_idn]) && $post['Domestic'.$worksheet_category_idn] == 1)
        {
            $sql_where['p.DomesticFlag'] = $post['Domestic'.$worksheet_category_idn];
        }

        //Sizes
        $where_sizes = "";
        if (isset($post['Size']))
        {
            $size_idns = array();
            foreach($post['Size'] as $size_idn)
            {
                $size_idns[] = $size_idn;
            }

            $where_sizes = "s.ProductSize_Idn IN (".implode(",", $size_idns).")";
        }

        //Fittings
        $where_fittings = "";
        if (isset($post['Fitting']))
        {
            $fitting_idns = array();
            foreach($post['Fitting'] as $fitting_idn)
            {
                $fitting_idns[] = $fitting_idn;
            }

            $where_fittings = "p.Fitting_Idn IN (".implode(",", $fitting_idns).")";
        }

        $sql_order_by = "s.Rank ASC, f.Rank ASC, p.MaterialUnitPrice ASC";

        $this->CI->db
            ->select($sql_select)
            ->from($this->sql_from)
            ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn","left")
            ->join("PipeTypes AS pt", "p.PipeType_Idn = pt.PipeType_Idn", "left")
            ->join("Fittings AS f", "p.Fitting_Idn = f.Fitting_Idn","left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        if (!empty($where_sizes))
        {
            $this->CI->db->where($where_sizes);
        }

        if (!empty($where_fittings))
        {
            $this->CI->db->where($where_fittings);
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_hangers
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_hangers($worksheet_category_idn, $post)
    {
        //Declare and initialize variables
        $sizes = (isset($post['Size'])) ? $post['Size'] : array();
        $rod_sizes = (isset($post['RodSize'])) ? $post['RodSize'] : array();

        $this->_set_defaults($worksheet_category_idn, $post);

        //SELECT
        $sql_select = "p.Product_Idn, wd.Quantity, p.Name, ht.Name AS Type, hst.Name AS SubType, p.MaterialUnitPrice";

        //WHERE
        $sql_where = array(
            "p.WorksheetCategory_Idn" => $worksheet_category_idn,
            "p.ActiveFlag" => 1
            );

        if (empty($rod_sizes))
        {
            //HangerType
            if ($post['HangerType'.$worksheet_category_idn] > 0)
            {
                $sql_where['p.HangerType_Idn'] = $post['HangerType'.$worksheet_category_idn];
            }
        }

        //Sizes
        $where_sizes = "";
        if (!empty($sizes) || !empty($rod_sizes))
        {
            $where_sizes = get_hanger_sizes($post['HangerType'.$worksheet_category_idn], $sizes, $rod_sizes);
        }
        else
        {
            $hanger_type_string = ($post['HangerType'.$worksheet_category_idn] > 0) ? "AND p.HangerType_Idn = {$post['HangerType'.$worksheet_category_idn]}" : "AND p.HangerType_Idn <> 7";
            $where_sizes = "(p.ProductSize_Idn = 0 OR p.ProductSize_Idn IS NULL) {$hanger_type_string}";
        }

        $sql_order_by = "s.Rank ASC, ht.Rank ASC, hst.Rank ASC, p.MaterialUnitPrice ASC";

        $this->CI->db
            ->select($sql_select)
            ->from($this->sql_from)
            ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn","left")
            ->join("HangerTypes AS ht", "p.HangerType_Idn = ht.HangerType_Idn", "left")
            ->join("HangerSubTypes AS hst", "p.HangerSubType_Idn = hst.HangerSubType_Idn", "left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        if (!empty($where_sizes))
        {
            $this->CI->db->where($where_sizes);
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_valves
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_valves($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        //SELECT
        $sql_select = "p.Product_Idn, wd.Quantity, p.Name, p.MaterialUnitPrice, p.FieldUnitPrice, p.ShopUnitPrice, p.DomesticFlag AS Domestic";

        //WHERE
        $sql_where = array(
            "p.WorksheetCategory_Idn" => $worksheet_category_idn,
            "p.ActiveFlag" => 1
            );

        //Domestic
        if ($post['Domestic'.$worksheet_category_idn] == 1)
        {
            $sql_where['p.DomesticFlag'] = $post['Domestic'.$worksheet_category_idn];
        }

        //Sizes
        $where_sizes = "";
        if (isset($post['Size']))
        {
            $size_idns = array();
            foreach($post['Size'] as $size_idn)
            {
                $size_idns[] = $size_idn;
            }

            $where_sizes = "s.ProductSize_Idn IN (".implode(",", $size_idns).")";
        }

        $sql_order_by = "s.Rank ASC, p.Rank ASC";

        $this->CI->db
            ->select($sql_select)
            ->from($this->sql_from)
            ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn","left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        if (!empty($where_sizes))
        {
            $this->CI->db->where($where_sizes);
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_lifts
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_lifts($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $sql_select = "p.Product_Idn, wd.Quantity, p.Name, p.MaterialUnitPrice, ld.Name AS LiftDurationName, p.Description";

        $this->CI->db
            ->select($sql_select)
            ->from($this->sql_from)
            ->join("LiftDurations AS ld", "p.LiftDuration_Idn = ld.LiftDuration_Idn","left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($this->sql_where)
            ->order_by($this->sql_order_by);

        //If Lift Durations are selected
        if (isset($post['LiftDuration']) && !empty($post['LiftDuration']))
        {
            //Build where in clause to include selected Lift Durations
            $lift_duration_idns = $post['LiftDuration'];

            //always include records with no lift duration (which could be 0 or null)
            array_push($lift_duration_idns, 0);
            $this->CI->db->where("(p.LiftDuration_Idn IN (".implode(',',$lift_duration_idns).") OR p.LiftDuration_Idn is null)");
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_riser
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_riser($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $riser_size = $post['RiserSize'.$worksheet_category_idn];
        $riser_type = (isset($post['RiserType'.$worksheet_category_idn])) ? $post['RiserType'.$worksheet_category_idn] : "";
        $trim_package_size = 0;
        $backflow_flag = $post['BackflowFlag'.$worksheet_category_idn];
        $backflow_type = $post['Backflow'.$worksheet_category_idn];
        $control_valve_flag = $post['ControlValveFlag'.$worksheet_category_idn];
        $control_valve = $post['ControlValve'.$worksheet_category_idn];
        $fdc_flag = $post['FDCFlag'.$worksheet_category_idn];
        $fdc_type = $post['FDC'.$worksheet_category_idn];
        $bell_flag = $post['BellFlag'.$worksheet_category_idn];
        $bell_type = $post['Bell'.$worksheet_category_idn];
        $check_valve_flag = (isset($post['CheckValveFlag'.$worksheet_category_idn])) ? $post['CheckValveFlag'.$worksheet_category_idn] : "N";
        $check_valve = (isset($post['CheckValve'.$worksheet_category_idn])) ? $post['CheckValve'.$worksheet_category_idn] : 0;
        $underground_size = $post['UndergroundSize'.$worksheet_category_idn];
        $domestic_required = 0;

        $sql_select = "p.RiserType_Idn, p.TrimPackageFlag, p.BackFlowType_Idn, p.ControlValve_Idn, p.FDCType_Idn, p.BellType_Idn, s.Rank AS SizeRank, p.Rank AS ProductRank, p.Product_Idn, p.Name, p.Description, MaterialUnitPrice, FieldUnitPrice, ShopUnitPrice";

        // $sql_where = "p.WorksheetCategory_Idn = {$worksheet_category_idn}";
        $sql_where = "p.ActiveFlag = 1 AND (";

        if (empty($riser_type))
        {
            $sql_where .= "s.Value = '{$riser_size}'";
        }
        else
        {
            $sql_where .= "(RiserType_Idn = {$riser_type} AND s.Value = '{$riser_size}')";
        }
        $sql_group_by = "p.RiserType_Idn, p.TrimPackageFlag, p.BackFlowType_Idn, p.ControlValve_Idn, p.FDCType_Idn, p.BellType_Idn, s.Rank, p.Rank, p.Product_Idn, p.Name, p.Description, MaterialUnitPrice, FieldUnitPrice, ShopUnitPrice";
        $sql_order_by = "p.RiserType_Idn DESC, p.TrimPackageFlag DESC, p.BackFlowType_Idn DESC, p.ControlValve_Idn DESC, p.FDCType_Idn DESC, p.BellType_Idn DESC, s.Rank ASC, p.Rank ASC";

        //Build sql using unions to sort by product attributes

        if ($riser_type == 4)
        {
            $trim_package_size = 0;
            if ($riser_size >= 1.5 && $riser_size <= 6)
            {
                $trim_package_size = 1.5;
            }
            else if ($riser_size == 8)
            {
                $trim_package_size = 8;
            }
            $sql_where .= " OR (TrimPackageFlag = 1 AND s.Value = '{$trim_package_size}')";
        }

        if ($backflow_flag == "Y" && $backflow_type > 0)
        {
            $sql_where .= " OR (BackFlowType_Idn = {$backflow_type} AND s.Value = '{$riser_size}')";
        }

        if ($control_valve_flag == "Y" && $control_valve > 0)
        {
            $sql_where .= " OR (ControlValve_Idn = {$control_valve} AND s.Value = '{$riser_size}')";
        }

        if ($fdc_flag == "Y" && $fdc_type > 0)
        {
            $sql_where .= " OR (FDCType_Idn = {$fdc_type} AND s.Value = '{$riser_size}')";
        }

        if ($bell_flag == "Y" && $bell_type > 0)
        {
            $sql_where .= " OR BellType_Idn = {$bell_type}";
        }

        if ($check_valve_flag == "Y")
        {
            $sql_where .= " OR (CheckValve_Idn = {$check_valve} AND s.Value = '{$riser_size}')";
        }

        $sql_where .= ")";

        //If underground and riser sizes are different, pull in branch line/grooved fitting/conc red with the greater size
        $fitting_size = 0;
        $sql_reducer = "";
        if ($underground_size != $riser_size)
        {
            $fitting_size = ($underground_size > $riser_size) ? $underground_size : $riser_size;

            $sql_reducer = "SELECT {$sql_select}
                            FROM Products AS p
                            LEFT JOIN ProductSizes AS s ON p.ProductSize_Idn = s.ProductSize_Idn
                            WHERE p.WorksheetCategory_Idn = 97
                                AND p.Fitting_Idn = 31
                                AND p.ActiveFlag = 1
                                AND s.Value = '{$fitting_size}'
                                AND p.PipeType_Idn = 2
                                AND p.DomesticFlag = {$domestic_required}
                            GROUP BY {$sql_group_by}";

			$sql = "SELECT {$sql_select}
					FROM Products AS p
                    LEFT JOIN ProductSizes AS s ON p.ProductSize_Idn = s.ProductSize_Idn
					WHERE {$sql_where}
						AND p.ActiveFlag = 1
                    GROUP BY {$sql_group_by}";

            $sql = "(".$sql.") UNION (".$sql_reducer.") ORDER BY {$sql_order_by}";

            return $this->CI->db->query($sql);
        }
        else
        {
            $this->CI->db
                ->select($sql_select)
                ->from($this->sql_from)
                ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn", "left")
                ->where($sql_where)
                // ->where("p.ActiveFlag", 1)
                ->group_by($sql_group_by)
                ->order_by($sql_order_by);
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_riser_nipples
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_riser_nipples($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $pipe_type = $post['PipeType'.$worksheet_category_idn];
		$fitting_pipe_type = "";
        $schedule_type = $post['ScheduleType'.$worksheet_category_idn];
        $size = $post['Size'.$worksheet_category_idn];
        $outlet = $post['Outlet'.$worksheet_category_idn];
        //$fitting_type = $post['FittingType'.$worksheet_category_idn];
        $fitting = (isset($post['Fitting'.$worksheet_category_idn])) ? $post['Fitting'.$worksheet_category_idn] : "0";
        $additional_fitting = $post['AdditionalFitting'.$worksheet_category_idn];
        $origin = $post['Domestic'.$worksheet_category_idn];

		//Pipe type logic for "Galvanized - Pipe only" option
		if ($pipe_type == 9999)
		{
			$pipe_type = 3;
			$fitting_pipe_type = 2;
		}
		else
		{
			$fitting_pipe_type = $pipe_type;
		}

        $sql_select = "p.WorksheetCategory_Idn, p.Product_Idn, wd.Quantity, p.Name AS Name, pt.Name AS PipeTypeName, p.MaterialUnitPrice, p.FieldUnitPrice, p.DomesticFlag AS Domestic";
        //$sql_select_end = ", p.MaterialUnitPrice, p.FieldUnitPrice, p.DomesticFlag AS Domestic";

        $sql_from = " LEFT JOIN WorksheetCategories AS wc ON p.WorksheetCategory_Idn = wc.WorksheetCategory_Idn";
        $sql_from .= " LEFT JOIN ProductSizes AS s ON p.ProductSize_Idn = s.ProductSize_Idn";
        $sql_from .= " LEFT JOIN PipeTypes AS pt ON p.PipeType_Idn = pt.PipeType_Idn";
        $sql_from .= " LEFT JOIN ScheduleTypes AS st ON p.ScheduleType_Idn = st.ScheduleType_Idn";
        $sql_from .= " LEFT JOIN Fittings AS f ON p.Fitting_Idn = f.Fitting_Idn";
        $sql_from .= " LEFT JOIN WorksheetDetails AS wd ON {$this->sql_wd_join}";

        /* SQL for Other Fittings */
        $sql_other_fittings_select = ", f.Name AS Type, 1 AS Rank";

        $sql_other_fittings_where = "p.WorksheetCategory_Idn = 99";
        $sql_other_fittings_where .= ($size > 0) ? " AND p.ProductSize_Idn = {$size}" : "";
        $sql_other_fittings_where .= ($outlet > 0) ? " AND p.Fitting_Idn = {$outlet}" : "";
        $sql_other_fittings_where .= ($fitting_pipe_type > 0) ? " AND p.PipeType_Idn = {$fitting_pipe_type}" : "";
        $sql_other_fittings_where .= ($origin == '2') ? "" : " AND p.DomesticFlag = 1";
        $sql_other_fittings_where .= " AND p.ActiveFlag = 1";

        $sql_other_fittings = "(SELECT {$sql_select} {$sql_other_fittings_select} FROM Products AS p {$sql_from} WHERE {$sql_other_fittings_where})";

        $sql_pipe_select = ", st.ShortName AS Type, 2 AS Rank";

        $sql_pipe_where = "p.WorksheetCategory_Idn = 89";
        $sql_pipe_where .= ($size > 0) ? " AND p.ProductSize_Idn = {$size}" : "";
        $sql_pipe_where .= ($schedule_type > 0) ? " and p.ScheduleType_Idn = {$schedule_type}" : "";
        $sql_pipe_where .= ($pipe_type > 0) ? " and p.PipeType_Idn = {$pipe_type}" : "";
        $sql_pipe_where .= ($origin == '2') ? "" : " AND p.DomesticFlag = 1";
        $sql_pipe_where .= " and p.ActiveFlag = 1";

        $sql_pipe = "UNION (SELECT {$sql_select} {$sql_pipe_select} FROM PRoducts AS p {$sql_from} WHERE {$sql_pipe_where})";

        ///* SQL for Threaded or Grooved Fittings */
        $sql_fittings_select = ", f.Name AS Type, 3 AS Rank";

        $sql_assembly_fittings = ($fitting > 0) ? $fitting : "";

        if ($additional_fitting > 0)
        {
            $sql_assembly_fittings .= (empty($sql_assembly_fittings)) ? $additional_fitting : ",".$additional_fitting;
        }

        $sql_fittings_where = "p.WorksheetCategory_Idn IN (90,97)"; //Threaded or grooved fittings only
        $sql_fittings_where .= " AND p.ProductSize_Idn = {$size}";
        $sql_fittings_where .= (empty($sql_assembly_fittings)) ? " AND p.Fitting_Idn = 0" : " AND p.Fitting_Idn IN ({$sql_assembly_fittings})";
        $sql_fittings_where .= ($fitting_pipe_type > 0) ? " AND p.PipeType_Idn = {$fitting_pipe_type}" : "";
        $sql_fittings_where .= ($origin == '2') ? "" : " AND p.DomesticFlag = 1";
        $sql_fittings_where .= " AND p.ActiveFlag = 1";

        $sql_fittings = "UNION (SELECT {$sql_select} {$sql_fittings_select} FROM Products AS p {$sql_from} WHERE {$sql_fittings_where})";

        $sql_riser_nipples = "{$sql_other_fittings} {$sql_pipe} {$sql_fittings} ORDER BY Rank ASC";

        return $this->CI->db->query($sql_riser_nipples);
    }

    /**
     * Summary of get_ug_pipes
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_ug_pipe($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $sql_where = array(
            "WorksheetCategory_Idn" => $worksheet_category_idn,
            "p.ActiveFlag" => 1
            );

        if ($post['PipeType'.$worksheet_category_idn] > 0)
        {
            $sql_where['p.PipeType_Idn'] = $post['PipeType'.$worksheet_category_idn];
        }

        $where_sizes = "";
        if (isset($post['Size']))
        {
            $size_idns = array();
            foreach($post['Size'] as $size_idn)
            {
                $size_idns[] = $size_idn;
            }

            $where_sizes = "s.ProductSize_Idn IN (".implode(",", $size_idns).")";
        }

        $sql_order_by = "s.Value ASC, p.MaterialUnitPrice ASC, p.Rank ASC";

        $this->CI->db
            ->select($this->sql_select)
            ->from($this->sql_from)
            ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn","left")
            ->join("PipeTypes AS pt", "p.PipeType_Idn = pt.PipeType_Idn", "left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        if (!empty($where_sizes))
        {
            $this->CI->db->where($where_sizes);
        }

        //If Lift Durations are selected
        if (isset($post['LiftDuration']) && !empty($post['LiftDuration']))
        {
            //Build where in clause to include selected Lift Durations
            $lift_duration_idns = $post['LiftDuration'];

            //always include records with no lift duration (which could be 0 or null)
            array_push($lift_duration_idns, 0);
            $this->CI->db->where("(p.LiftDuration_Idn IN (".implode(',',$lift_duration_idns).") OR p.LiftDuration_Idn is null)");
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_ug_fittings
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_ug_fittings($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $sql_where = array(
            "p.WorksheetCategory_Idn" => $worksheet_category_idn,
            "p.ActiveFlag" => 1
            );

        $where_sizes = "";
        if (isset($post['Size']))
        {
            $size_idns = array();
            foreach($post['Size'] as $size_idn)
            {
                $size_idns[] = $size_idn;
            }

            $where_sizes = "s.ProductSize_Idn IN (".implode(",", $size_idns).")";
        }

        $where_fittings = "";
        if (isset($post['Fitting']))
        {
            $fitting_idns = array();
            foreach($post['Fitting'] as $fitting_idn)
            {
                $fitting_idns[] = $fitting_idn;
            }

            $where_fittings = "f.Fitting_Idn IN (".implode(",", $fitting_idns).")";
        }

        $sql_order_by = "s.Value ASC, p.MaterialUnitPrice ASC, p.Rank ASC";

        $this->CI->db
            ->select($this->sql_select)
            ->from($this->sql_from)
            ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn","left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        if (!empty($where_sizes))
        {
            $this->CI->db->where($where_sizes);
        }

        if (!empty($where_fittings))
        {
            $this->CI->db->join("Fittings AS f", "p.Fitting_Idn = f.Fitting_Idn","left");
            $this->CI->db->where($where_fittings);
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_tapping_tees
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_tapping_tees($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $sql_where = array(
            "p.WorksheetCategory_Idn" => $worksheet_category_idn,
            "p.ActiveFlag" => 1
            );

        $where_sizes = "";
        if (isset($post['Size']))
        {
            $size_idns = array();
            foreach($post['Size'] as $size_idn)
            {
                $size_idns[] = $size_idn;
            }

            $where_sizes = "s.ProductSize_Idn IN (".implode(",", $size_idns).")";
        }

        $where_tapping_tees = "";
        if (isset($post['TappingTee'.$worksheet_category_idn]))
        {
            $where_tapping_tees = "p.TappingTee_Idn = {$post['TappingTee'.$worksheet_category_idn]}";
        }

        $sql_order_by = "s.Value ASC, p.MaterialUnitPrice ASC, p.Rank ASC";

        $this->CI->db
            ->select($this->sql_select)
            ->from($this->sql_from)
            ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn","left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        if (!empty($where_sizes))
        {
            $this->CI->db->where($where_sizes);
        }

        if (!empty($where_tapping_tees))
        {
            $this->CI->db->join("TappingTees AS t", "p.TappingTee_Idn = t.TappingTee_Idn","left");
            $this->CI->db->where($where_tapping_tees);
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_ug_valves
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_ug_valves($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $sql_where = array(
            "p.WorksheetCategory_Idn" => $worksheet_category_idn,
            "p.ActiveFlag" => 1
            );

        $where_sizes = "";
        if (isset($post['Size']))
        {
            $size_idns = array();
            foreach($post['Size'] as $size_idn)
            {
                $size_idns[] = $size_idn;
            }

            $where_sizes = "s.ProductSize_Idn IN (".implode(",", $size_idns).")";
        }

        $where_valves = "";
        if (isset($post['Valve'.$worksheet_category_idn]))
        {
            $where_valves = "p.UndergroundValve_Idn = {$post['Valve'.$worksheet_category_idn]}";
        }

        $sql_order_by = "s.Value ASC, p.MaterialUnitPrice ASC, p.Rank ASC";

        $this->CI->db
            ->select($this->sql_select)
            ->from($this->sql_from)
            ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn","left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        if (!empty($where_sizes))
        {
            $this->CI->db->where($where_sizes);
        }

        if (!empty($where_valves))
        {
            $this->CI->db->join("UndergroundValves AS uv", "p.UndergroundValve_Idn = uv.UndergroundValve_Idn","left");
            $this->CI->db->where($where_valves);
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_miscellaneous
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_miscellaneous($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $sql_where = array(
            "p.WorksheetCategory_Idn" => $worksheet_category_idn,
            "p.ActiveFlag" => 1,
            "p.Department_Idn" => 2
            );

        $sql_order_by = "p.Rank ASC";

        $worksheet_master_idn = (isset($post['WorksheetMaster_Idn'])) ? $post['WorksheetMaster_Idn']: 0;

        $this->CI->db
            ->select($this->sql_select)
            ->from($this->sql_from)
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        if ($worksheet_master_idn == 11 || $worksheet_master_idn == 29 || $worksheet_master_idn == 12 || $worksheet_master_idn == 16 || $worksheet_master_idn == 19 || $worksheet_master_idn == 21)
        {
            $this->CI->db->where(array("WorksheetMaster_Idn" => $worksheet_master_idn));
        }

        return $this->CI->db->get();
    }

    /**
     * Summary of get_miscellaneous
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_products($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $sql_where = "";
        if (isset($post['SearchProducts'.$worksheet_category_idn]) && !empty($post['SearchProducts'.$worksheet_category_idn]))
        {
            $sql_where = "p.Name Like '%{$post['SearchProducts'.$worksheet_category_idn]}%'";
        }
        else
        {
            $sql_where = "p.Name = ''";
        }

        $sql_where .= " AND p.ActiveFlag = 1";
        $sql_order_by = "p.Name ASC";

        $this->CI->db
            ->select("TOP 100 ".$this->sql_select)
            ->from($this->sql_from)
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        return $this->CI->db->get();
    }

    /**
     * Summary of get_heads
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_heads($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $sql_select = "";
        $sql_where = "";
        $coverage_type = $post['CoverageType'.$worksheet_category_idn];
        $head_type = $post['HeadType'.$worksheet_category_idn];
        $finish_type = $post['FinishType'.$worksheet_category_idn];
        $response_type = $post['ResponseType'.$worksheet_category_idn];

        $sql_select = $this->sql_select.", s.Name AS Size, ct.Name AS CoverageType, ht.Name AS HeadType, ft.Name AS FinishType";
        //$sql_from .= " LEFT JOIN coverage_types ct ON p.coverage_type_id = ct.coverage_type_id";
        //$sql_from .= " LEFT JOIN head_types ht ON p.head_type_id = ht.head_type_id";
        //$sql_from .= " LEFT JOIN finish_types ft ON p.finish_type_id = ft.finish_type_id";
        //$sql_from .= " LEFT JOIN p_sizes s ON p.size_id = s.size_id";

        $sql_where = "p.WorksheetCategory_Idn = {$worksheet_category_idn}";
        $sql_where .= ($coverage_type > 0) ? " AND p.CoverageType_Idn = {$coverage_type}" : "";
        $sql_where .= ($head_type > 0) ? " AND p.HeadType_Idn = {$head_type}" : "";
        $sql_where .= ($finish_type > 0) ? " AND p.FinishType_Idn = {$finish_type}" : "";
        $sql_where .= " AND (ResponseType = '{$response_type}' OR ResponseType IS NULL)";
        $sql_where .= " AND p.ActiveFlag = 1";

        $sql_order_by = "s.Rank ASC, ct.Rank ASC, ht.Rank ASC, ft.Rank ASC";

        $this->CI->db
            ->select($sql_select)
            ->from($this->sql_from)
            ->join("CoverageTypes AS ct", "p.CoverageType_Idn = ct.CoverageType_Idn","left")
            ->join("HeadTypes AS ht", "p.HeadType_Idn = ht.HeadType_Idn", "left")
            ->join("FinishTypes AS ft", "p.FinishType_Idn = ft.FinishType_Idn", "left")
            ->join("ProductSizes AS s", "p.ProductSize_Idn = s.ProductSize_Idn", "left")
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($sql_order_by);

        return $this->CI->db->get();
    }

    /**
     * Summary of get_fc_assemblies
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_fc_assemblies($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);
        $valve = $post['ControlValve'.$worksheet_category_idn];

        $sql_where = "p.WorksheetCategory_Idn IN (118, 120) AND p.ActiveFlag = 1";
        $sql_where .= ($valve > 0) ? " AND (p.ControlValve_Idn IS NULL OR p.ControlValve_Idn IN (0, {$valve}))" : "";

        $this->CI->db
            ->select($this->sql_select)
            ->from($this->sql_from)
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($this->sql_order_by);

        return $this->CI->db->get();
    }

    /**
     * Summary of get_fire_pumps
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_fire_pumps($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);

        $position = $post['Position'.$worksheet_category_idn];
        $fire_pump_type = $post['FirePumpType'.$worksheet_category_idn];
        $gpm = $post['GPM'.$worksheet_category_idn];
        $backflow_flag = $post['BackflowFlag'.$worksheet_category_idn];
        $backflow = (isset($post['Backflow'.$worksheet_category_idn])) ? $post['Backflow'.$worksheet_category_idn] : 0;
        $bypass = $post['Bypass'.$worksheet_category_idn];
        $test_header = $post['TestHeader'.$worksheet_category_idn];
        $flow_meter = $post['FlowMeter'.$worksheet_category_idn];
        $relief_valve = $post['ReliefValve'.$worksheet_category_idn];
        $diesel_fuel = ($fire_pump_type == 2) ? ",1" : ""; //If Diesel fire pump, then include Diesel Fuel product
        $main_component_size_idn = 0;

        if ($backflow_flag == "Y")
        {
            //Get Size of Main Components
            $this->CI->db
                ->select("ProductSize_Idn")
                ->from($this->sql_from)
                ->join("v_ProductGPMDetails AS g", "p.Product_Idn = g.Product_Idn", "left")
                ->where("p.IsMainComponent = 1 AND g.GPM_Idn = {$gpm} AND p.ActiveFlag = 1");
            $query = $this->CI->db->get();

            if ($query->num_rows() > 0)
            {
                foreach ($query->result_array() as $row)
                {
                    $main_component_size_idn = $row['ProductSize_Idn'];
                }
            }
        }

        //Format Fire Pump Attributes
        $fire_pump_atts = array($test_header,$bypass,$relief_valve,$flow_meter);

        $sql_fire_pump_attributes = "";
        if (array_sum($fire_pump_atts) > 0)
        {
            $sql_fire_pump_attributes .= ($test_header > 0) ? ",".$test_header : "";
            $sql_fire_pump_attributes .= ($bypass > 0) ? ",".$bypass : "";
            $sql_fire_pump_attributes .= ($flow_meter > 0) ? ",".$flow_meter : "";
            $sql_fire_pump_attributes .= ($relief_valve > 0) ? ",".$relief_valve : "";
        }

        $sql_where = "(";
        $sql_where .= "p.WorksheetCategory_Idn = {$worksheet_category_idn}";
        $sql_where .= " AND p.IsFirePump = 0";
        $sql_where .= " AND (p.FirePumpType_Idn IN (0,{$fire_pump_type}) OR p.FirePumpType_Idn is null)";
        $sql_where .= " AND (p.Position_Idn IN (0,{$position}) OR p.Position_Idn is null)"; //Does this apply to all products??
        $sql_where .= " AND (g.GPM_Idn IN ({$gpm}) OR g.GPM_Idn IS null)"; //Does this apply to all products??
        $sql_where .= " AND (p.FirePumpAttribute_Idn IN (0{$sql_fire_pump_attributes}) OR p.FirePumpAttribute_Idn is null)"; //Does this apply to all products??
        $sql_where .= " AND IsDieselFuel IN (0{$diesel_fuel})";
        $sql_where .= " AND p.ActiveFlag = 1";
        $sql_where .= ")";

        //Get Backflow Preventer
        if ($backflow_flag == "Y")
        {
            $sql_where .= "OR (p.WorksheetCategory_Idn = 106 AND BackFlowType_Idn = {$backflow} AND ProductSize_Idn = {$main_component_size_idn})";
        }

        $this->CI->db
            ->select("p.Product_Idn, p.Name, p.MaterialUnitPrice, p.FieldUnitPrice, p.ShopUnitPrice, p.Description")
            ->from($this->sql_from)
            ->join("v_ProductGPMDetails AS g", "p.Product_Idn = g.Product_Idn", "left")
            ->where($sql_where)
            ->order_by($this->sql_order_by);

        return $this->CI->db->get();
    }

	    /**
     * Summary of get_fc_assemblies
     * @param mixed $worksheet_category_idn
     * @param mixed $post
     * @return mixed
     */
    public function get_tanks($worksheet_category_idn, $post)
    {
        $this->_set_defaults($worksheet_category_idn, $post);
        $manufacturer = $post['Manufacturer'.$worksheet_category_idn];

        $sql_where = "p.WorksheetCategory_Idn = {$worksheet_category_idn} AND p.ActiveFlag = 1";
        $sql_where .= ($manufacturer > 0) ? " AND p.Manufacturer_Idn = {$manufacturer}" : "";

        $this->CI->db
            ->select($this->sql_select)
            ->from($this->sql_from)
            ->join("WorksheetDetails AS wd", $this->sql_wd_join, "left")
            ->where($sql_where)
            ->order_by($this->sql_order_by);

        return $this->CI->db->get();
    }


}
?>