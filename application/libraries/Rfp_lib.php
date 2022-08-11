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

    public function is_worksheet_detail_exception($worksheet_idn, $product_idn)
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
                ->where($where)
                ->where_in("RFPExceptionStatus_Idn", array(1,2));

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
                ->select("j.Job_Idn, j.ChangeOrder, j.Name AS JobName, j.JobDate, w.Name AS WorksheetName, p.Product_Idn, p.Name as ProductName, s.Name AS RFPStatus")
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
                    $data[] = $row;
                }
            }
        }

        return $data;
    }
}
