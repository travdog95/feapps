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
        $this->load->model('m_product_relationship');
        $this->load->model('m_product');
		$this->load->model('m_menu');

        //Load test library
        $this->load->library('j');
        $this->load->library('unit_test');
        $this->load->library('product_lib');
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

    function assemblies()
    {
        		//Decare and initialize variables
		$data = array(
			'menus' => array(),
			'active_page' => 'Assembly Tests',
			'bread_crumbs' => array(
				array(
					'name' => 'Tests',
					'link' => ''
				)
			),
		);

		//Load menus
		$data['menus'] = $this->m_menu->get_menus();

        //*** Count of Parents in Products and ProductRelationships Tables Match */

        //Get all Parent_Idns from ProductRelationships table
        $prod_relationship_parent_idns = $this->product_lib->get_all_product_relationship_parent_idns();

        //Get all Parent_Idns from Products table
        $prod_parent_idns = $this->product_lib->get_all_parent_idns();

        $tablesMatch_Test = sizeof($prod_relationship_parent_idns) == sizeof($prod_parent_idns);

        $tablesMatch_ExpectedResult = true;

        $tablesMatch_TestName = 'Count of Parents in Products and ProductRelationships Tables Match';

        $this->unit->run($tablesMatch_Test, $tablesMatch_ExpectedResult, $tablesMatch_TestName);

        //** END TEST */

        //Iterate over assemblies
        foreach($prod_parent_idns as $parent_idn)
        {
            //Get product info of parent
            $product = $this->product_lib->get_product($parent_idn);

            //Calculate children prices
            $children_prices = $this->product_lib->calculate_assembly_prices($parent_idn);

            //Material Price test and expected result
            $material_test = round($children_prices['MaterialUnitPrice'], 2) == round($product['MaterialUnitPrice'], 2);

            $material_expected_result = true;

            $material_test_name = "Parent/Children Material Price are equal (".$parent_idn.") <br /> Parent: $".number_format($product['MaterialUnitPrice'], 2)." Child: $".number_format($children_prices['MaterialUnitPrice'], 2);

            $this->unit->run($material_test, $material_expected_result, $material_test_name);

            //Field Price test and expected result
            $field_test = round($children_prices['FieldUnitPrice'], 2) == round($product['FieldUnitPrice'], 2);

            $field_expected_result = true;

            $field_test_name = "Parent/Children Price Price are equal (".$parent_idn.") <br /> Parent: $".number_format($product['FieldUnitPrice'], 2)." Child: $".number_format($children_prices['FieldUnitPrice'], 2);

            $this->unit->run($field_test, $field_expected_result, $field_test_name);
        }

        $data['report'] = $this->unit->report();

        //Load view
		$this->load->view('tests/assemblies', $data);

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