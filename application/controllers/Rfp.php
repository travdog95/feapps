<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rfp extends CI_Controller {

	function __construct()
	{
		//Includes parent class constructor
		parent::__construct();

		//Check authentication
        check_auth();

		//Load reference table model
		$this->load->model('m_reference_table');
		$this->load->model('m_menu');
	}

    /**
     * Summary of index
     */
    public function index()
	{
		//Decare and initialize variables
		$data = array(
			'menus' => array(),
			'active_page' => 'RFP Exceptions',
			'bread_crumbs' => array(
				array(
					'name' => 'RFP Exceptions',
					'link' => ''
				)
			)
		);

        $this->load->library("rfp_lib");

		$data['column_headers'] = array(
			"Status",
			'Job Number', 
			'Name',
			"Estimator",
			'Job Date',
			'Worksheet Name',
			'Product ID',
			'Product Name',
		);

		//Get Exceptions
        $data['exceptions'] = $this->rfp_lib->get_exceptions();

		//Load menus
		$data['menus'] = $this->m_menu->get_menus();

        //Load job search view
		$this->load->view('rfp/index', $data);
	}

}
/* End of file Rfp.php */
/* Location: ./application/controllers/rfp.php */