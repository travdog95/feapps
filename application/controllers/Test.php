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
        $this->load->library('j');
        $this->load->library('');
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
            if ($this->m_job->is_parent($job_number)) {
                //Instantiate ParentJob
                $this->load->library('j');
                $this->load->library('parentjob', array('job_number' => $job_number));
                $Job = $this->parentjob;

                //This is now part of the construct of ParentJob object
                //$Job->get_children($job_keys[0]);

            } else {
                //Instantiate Job
                $this->load->library('j', array('job_number' => $job_number));
                $Job = $this->j;

            }

            //$j = new J(array('job_number' => $job_number));

            $Job->load_recap_rows();

            if ($recap_row_idn > 0)
            {
                echo json_encode($Job->RRs[$recap_row_idn]);
            }
            else
            {
                echo json_encode($Job->RRs);
            }
        }
    }

    function budget_summary($job_number)
    {
        $job_keys = get_job_keys($job_number);

		$this->load->model('m_menu');

        //check to see if it's a parent job
        if ($this->m_job->is_parent($job_number))
        {
            //Instantiate ParentJob
            $j = new ParentJob(array('job_number' => $job_number));
        }
        else
        {
            //Instantiate Job
            $j = new J(array('job_number' => $job_number));
        }

        $j->load_recap_rows();

        echo "<p>Total Sqft: ".$j->total_sqft."</p>";
        echo "<p>Total Heads: ".$j->total_heads."</p>";
    }

    function phpinfo()
    {
        echo phpinfo();
        exit;
    }

    function parent_recap_rows($job_number)
    {
        if (isset($job_number) && !empty($job_number))
        {
            if ($this->m_job->is_parent($job_number)) {
                //Instantiate ParentJob
                $this->load->library('j');
                $this->load->library('parentjob', array('job_number' => $job_number));
                $Parent = $this->parentjob;
            } else {
                echo "<p>Not a parent!</p>";
            }


            $Parent->load_recap_rows();

            foreach($Parent->children as $child) {
                foreach($child->RRs as $recap_row) {
                    if ($recap_row->recap_row_idn == 8) {
                        echo json_encode($recap_row);
                    }
                }
            }
        }
    }
}