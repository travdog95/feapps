<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * WorksheetMaster Class
 *
 * @category	WorksheetMaster
 * @author		TKO Consulting, LLC
*/

class Worksheet_master
{
    //Declare and initialize member variables
    
    //Public members
    public $wm = array();
    
    //Private members
    private $CI;
    
	/**
     * Worksheet Master Class Constructor
     *
     * The constructor loads the Worksheet Master class used to put WorksheetMaster records into a class
     * 
     * @param   array
     */
	public function __construct($params = array())
	{
		// Set the super object to a local variable for use later
		$this->CI =& get_instance();
        
        //Load Worksheet model
        $this->CI->load->model('m_worksheet_master');
        
        // If Worksheet_Idn being passed, set it
		if (sizeof($params) > 0 && isset($params['worksheet_master_idn']) && $params['worksheet_master_idn'] > 0)
		{
            $this->wm = $this->get_worksheet_master($params['worksheet_master_idn']);
        }
             
        log_message('debug', "Worksheet Master Class Initialized");
	}
    
    /**
     * get_worksheet_master
     *
     * Get all data from WorksheetMasters table
     *
     * @access  public
     * @param   $worksheet_master_idn(integer)
     * @return  array
     */
    
    function get_worksheet_master($worksheet_master_idn)
    {
        //Get worksheet
        $this->wm = $this->CI->m_worksheet_master->get_by_idn($worksheet_master_idn);

        //Get categories
        $this->wm['WorksheetMasterCategories'] = $this->CI->m_worksheet_master->get_categories($worksheet_master_idn);
        
        //Get sizes
        $this->wm['WorksheetMasterSizes'] = $this->CI->m_worksheet_master->get_sizes($worksheet_master_idn);
        
        //Get categories to display by default
        $this->wm['DefaultCategories'] = $this->CI->m_worksheet_master->get_defaults($worksheet_master_idn);

        $this->wm['HasRecap'] = $this->CI->m_worksheet_master->get_parent($worksheet_master_idn);

        //Get shared categories
        $this->wm['SharedCategories'] = $this->CI->m_worksheet_master->get_shared_categories($worksheet_master_idn, 1);

        //Get not shared categories
        $this->wm['NotSharedCategories'] = $this->CI->m_worksheet_master->get_shared_categories($worksheet_master_idn, 0);

        //Get categories to auto load
        $this->wm['AutoLoadCategories'] = $this->CI->m_worksheet_master->get_auto_load_categories($worksheet_master_idn);

        return $this->wm;
    }
}
?>