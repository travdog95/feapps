<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	function __construct()
	{
		//Includes parent class constructor
		parent::__construct();

		//Check authentication
        check_auth();

        //Load models
        $this->load->model('m_reference_table');
		$this->load->model('m_menu');

        //Load test library

    }

    public function index($results = array())
    {
		//Decare and initialize variables
		$data = array(
			'menus' => array(),
			'active_page' => 'Tests',
			'bread_crumbs' => array(
				array(
					'name' => 'Tests',
					'link' => ''
				)
			),
			"results" => $results
		);

		//Load menus
		$data['menus'] = $this->m_menu->get_menus();

        //Load view
		$this->load->view('tests/index', $data);
    }

    function job_recap($job_number, $recap_row_idn = 0)
    {
        if (isset($job_number) && !empty($job_number))
        {
            $this->load->library('j', array('job_number' => $job_number));
            $j = $this->j;

            //echo json_encode($j);

            $this->load->library('recap_row', array('recap_row_idn' => $recap_row_idn, 'j' => $j));

            echo json_encode($this->recap_row);
            // $j->load_recap_rows();

            // if ($recap_row_idn > 0)
            // {
            //     echo json_encode($j->RRs[$recap_row_idn]);
            // }
            // else
            // {
            //     echo json_encode($j->RRs);
            // }
        }
    }

    function phpinfo()
    {
        phpinfo();
    }

    function parent($parent_job_idn)
    {
        $this->load->library('j', array("job_number" => $parent_job_idn));

        if ($this->j->job['is_parent'] == 1)
        {
            $this->load->library('parentjob', array("job_number" => $parent_job_idn));
            $j = $this->parentjob;

            $j->get_children();

            $j->load_recap_rows();

        }
        else
        {
            $this->j->load_recap_rows();
        }

        //print_r($j->job);
    }
}