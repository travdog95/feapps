<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
* Rfp Class
*
* @author   TKO Consulting, LLC
*/
class Rfp_lib
{
    //Public members
    //Private members
    private $CI;

    public function __construct()
    {
        //Set Code Igniter object
        $this->CI =& get_instance();

        //Load models
        $this->CI->load->model('m_rfp_exception');
        $this->CI->load->model('m_product_relationship');
    }

    /**
     * get_exceptions
     *
     * Gets user data by user_name
     *
     * @access  public
     * @param   array
     * @return  array
     */

    public function get_exceptions()
    {
        return $this->CI->m_rfp_exception->all_extended();
    }

    public function is_product_exception($product_idn)
    {
        $is_exception = false;
        $product_has_exception = false;
        $child_idns = array();
        $child_has_exception = false;

        if ($product_idn > 0)
        {
            $child_idns = $this->CI->m_product_relationship->get_children($product_idn);

            foreach ($child_idns as $child_idn)
            {
                if ($this->is_product_exception($child_idn))
                {
                    $child_has_exception = true;
                }
            }

            $this->CI->db
                ->select("Product_Idn")
                ->from("Products")
                ->where("Product_Idn", $product_idn)
                ->where("RFP", 1);

            $query = $this->CI->db->get();

            if ($query)
            {
                if ($query->num_rows() > 0)
                {
                    $product_has_exception = true;
                }
            }
        }

        if ($product_has_exception || $child_has_exception)
        {
            $is_exception = true;
        }

        return ($product_has_exception || $child_has_exception);
    }

    public function is_misc_product_exception($misc_detail_idn)
    {
        $is_exception = false;

        if ($misc_detail_idn > 0)
        {
            $this->CI->db
                ->select("p.Product_Idn")
                ->from("MiscellaneousDetails AS md")
                ->join("ProductAssemblyDetails AS pad", "pad.ProductAssembly_Idn = md.ProductAssembly_Idn", "left")
                ->join("Products AS p", "pad.Product_Idn = p.Product_Idn", "left")
                ->where("md.MiscellaneousDetail_Idn", $misc_detail_idn)
                ->where("RFP", 1);

            $query = $this->CI->db->get();

            if ($query)
            {
                if ($query->num_rows() > 0)
                {
                    $is_exception = true;
                }
            }
        }

        return $is_exception;
    }

    /**
     * $status_idns - simple array of statuses to query for, i.e. array(1, 2, 3)
     */
    public function is_worksheet_detail_exception($worksheet_idn, $product_idn, $status_idns = array())
    {
        $is_exception = false;
        $where = array();

        if ($worksheet_idn > 0 && $product_idn > 0)
        {
            $where = array(
                "Worksheet_Idn" => $worksheet_idn,
                "Product_Idn" => $product_idn
            );

            $this->CI->db
                ->select("RFPException_Idn")
                ->from("RFPExceptions")
                ->where($where);

            if (sizeof($status_idns) > 0)
            {
                $this->CI->db->where_in("RFPExceptionStatus_Idn", $status_idns);
            }

            $query = $this->CI->db->get();

            if ($query)
            {
                if ($query->num_rows() > 0)
                {
                    $is_exception = true;
                }
            }
        }

        return $is_exception;
    }

    public function by_user($user_idn)
    {
        $data = array();
        $where = array();

        if ($user_idn > 0)
        {
            $where = array(
                "CreatedBy_Idn" => $user_idn,
                "RFPExceptionStatus_Idn" => 2,
            );

            $this->CI->db
                ->select("j.Job_Idn, j.ChangeOrder, j.Name AS JobName, j.JobDate, w.Name AS WorksheetName, p.Product_Idn, p.Name as ProductName")
                ->from("RFPExceptions AS rfp")
                ->join("Worksheets AS w", "rfp.Worksheet_Idn = w.Worksheet_Idn", "left")
                ->join("Products AS p", "rfp.Product_Idn = p.Product_Idn", "left")
                ->join("Jobs AS j", "j.Job_Idn = w.Job_Idn AND j.ChangeOrder = w.ChangeOrder", "left")
                ->where($where);

            $query = $this->CI->db->get();

            if ($query && $query->num_rows() > 0)
            {
                foreach ($query->result_array() as $row)
                {
                    $row['JobNumber'] = format_job_number($row['Job_Idn'], $row['ChangeOrder']);
                    $row['JobDate'] = date("M d, Y", get_timestamp($row['JobDate']));
                    $data[] = $row;
                }
            }
        }

        return $data;
    }

    public function process_flow($where, $current_status_idn, $new_status_idn)
    {
        $set = array();

        if (sizeof($where) > 0 && $current_status_idn > 0 && $new_status_idn)
        {
            $product_idn = $where['Product_Idn'];

            $where["RFPExceptionStatus_Idn"] = $current_status_idn;

            $set = array(
                "RFPExceptionStatus_Idn" => $new_status_idn,
            );
    
            $this->CI->db
                ->select("*")
                ->from("RFPExceptions")
                ->where($where);

            $query = $this->CI->db->get();

            if ($query && $query->num_rows() > 0)
            {
                foreach ($query->result_array() as $row)
                {
                    $this->CI->m_rfp_exception->update($set, $where);
                }
            }

            $is_child = $this->CI->product_lib->is_child($product_idn);

            if ($is_child)
            {
                $this->process_child($product_idn);
            }
        }
    }

    public function process_flow_by_job($job_number, $current_status_idn, $new_status_idn)
    {
        $where = array();
        $set = array();
        $rfp_where = array();
        $results = array(
            "updates" => 0,
            "errors" => 0,
        );

        if ($job_number > 0 && $current_status_idn > 0 && $new_status_idn)
        {
            $job_keys = get_job_keys($job_number);

            $where = array(
                "RFPExceptionStatus_Idn" => $current_status_idn,
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1],
            );

            //Get job worksheets with rfp exceptions
            $this->CI->db
                ->select("w.Worksheet_Idn")
                ->from("Worksheets AS w")
                ->join("RFPExceptions as rfp", "w.Worksheet_Idn = rfp.Worksheet_Idn")
                ->where($where);

            $query = $this->CI->db->get();

            if ($query && $query->num_rows() > 0)
            {
                $set = array(
                    "RFPExceptionStatus_Idn" => $new_status_idn,
                );

                foreach ($query->result_array() as $row)
                {
                    $rfp_where = array(
                        "Worksheet_Idn" => $row['Worksheet_Idn'],
                        "RFPExceptionStatus_Idn" => $current_status_idn,
                    );

                    if ($this->CI->m_rfp_exception->update($set, $rfp_where))
                    {
                        $results['updates']++;
                    }
                    else
                    {
                        $results['errors']++;
                    }
                }
            }
        }
    }

    public function delete_by_job($job_number)
    {
        $results = array(
            "deletes" => 0,
            "errors" => 0,
        );
        $where = array();
        $job_keys = array();

        if ($job_number != "")
        {            
            $job_keys = get_job_keys($job_number);

            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1],
            );

            $this->CI->db
                ->select("w.Worksheet_Idn")
                ->from("Worksheets AS w")
                ->join("RFPExceptions as rfp", "w.Worksheet_Idn = rfp.Worksheet_Idn")
                ->where($where);

            $query = $this->CI->db->get();

            foreach ($query->result_array() as $row)
            {
                $rfp_where = array(
                    "Worksheet_Idn" => $row['Worksheet_Idn'],
                );

                if ($this->CI->m_rfp_exception->delete($rfp_where))
                {
                    $results['deletes']++;
                }
                else
                {
                    $results['errors']++;
                }
            }
        }

        return $results;
    }

    public function process_child($child_idn)
    {
        $new_rfp_status_idn = 0;
        //Find top level parent
        $top_level_parents = $this->CI->product_lib->get_top_level_parents($child_idn);
        
        foreach($top_level_parents as $top_level_parent_idn)
        {
            $children = $this->CI->m_product->get_children($top_level_parent_idn);
            
            //If all children have RFP equal to 0, then change state to Product Updated (2)
            //Else, change state to Children Partially Updated (4)
            $new_rfp_status_idn = $this->are_all_children_not_rfp($children) ? 2 : 4;

            //update RFP status on parent
            $this->CI->m_rfp_exception->update(array("RFPExceptionStatus_Idn" => $new_rfp_status_idn), array("Product_Idn" => $top_level_parent_idn));

        }

        return true;
    }

    public function are_all_children_not_rfp($children)
    {
        $child_children = array();

        foreach ($children as $child)
        {
            if ($child['IsParent'] == 1)
            {
                $child_children = $this->CI->m_product->get_children($child['Product_Idn']);
                if (!$this->are_all_children_not_rfp($child_children)) 
                {
                    return false;
                }
            }

            if ($child['RFP'] == 1)
            {
                return false;
            }
        }

        return true;
    }
}
