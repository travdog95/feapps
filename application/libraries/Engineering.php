<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Engineering Class
*
* @author   TKO Consulting, LLC
*/
class Engineering
{
    //Public members
    public $additional_costs = array();
    
    //Private members
    private $CI;

	public function __construct()
	{
        //Set Code Igniter object
		$this->CI =& get_instance();
        
        //Load models
        $this->CI->load->model('m_reference_table');
	}
	
    public function get_additional_costs()
    {
        //Declare and initialize variables
        //$query = array();

        //$this->CI->db->select("eac.*, ")

        //$this->additional_costs = array();
    }
}
?>