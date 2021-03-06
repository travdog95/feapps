<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Parent Class
 *
 * @category	ParentJob
 * @author		TKO Consulting, LLC
*/

class ParentJob extends J
{
    //Declare and initialize member variables
    public $children = array();
    //public $totals = array();
    
    private $CI;
	/**
     * ParentJob Class Constructor
     *
     * @param   array
     * @param   integer
     */
    
    public function __construct($params = array('job_number' => ""))
    {
        //Run J construct to get job data
        parent::__construct($params);
        
        // Set the super object to a local variable for use later
        $this->CI =& get_instance();

        $this->get_children($params['job_number']);
    }
    
    /**
    * get_children()
    *
    * Get children jobs for parent
    *
    * @access   public
    * @param    string
    * @return   void
    */
    
    public function get_children($parent_id)
    {
        //Delcare and initialize variables
        $children = array();
        $child_job_number = "";

        //Make sure parent_id doesn't have "-" in it.
        $parent_keys = get_job_keys($parent_id);
        
        //Load models
        $this->CI->load->model('m_reference_table');
        
        //Get children by parent_id from database
        $children = $this->CI->m_reference_table->get_all('Jobs', array('Parent_Idn' => $parent_keys[0]));
    
        //Load children job objects into children member
        foreach ($children as $index => $child) {
            //Format child job number
            $child_job_number = format_job_number($child['Job_Idn'], $child['ChangeOrder']);
            
            //Load child job into array
            $child_instance = 'child'.$child_job_number;
            $this->CI->load->library('j', array('job_number' => $child_job_number), $child_instance);

            $this->children[$index] = $this->CI->$child_instance;
            
            //Calculate total sqft and total heads
            $this->total_sqft += $this->children[$index]->total_sqft;
            $this->total_heads += $this->children[$index]->total_heads;
            
            //Get recap rows for child job
            $this->children[$index]->load_recap_rows();
        }
    }
}
// END ParentJob Class
