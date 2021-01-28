<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export_controller extends CI_Controller {
  
    function __construct()
    {
        //Includes parent class constructor
        parent::__construct();

        //Check authentication
        check_auth();

        //Load models
        $this->load->model('m_reference_table');

        //Load libraries
        $this->load->library("export");
    }

    public function accounting()
    {
        //$job_numbers = array("951-0");

        $job_numbers = $this->input->get('job_numbers');

        $data = array();

        if (!empty($job_numbers))
        {
            $filename = "Accounting_".date("Y_m_d-H_i_s").".csv";

            header('Content-type:text/csv');
            header('Content-Disposition: attachment;filename='.$filename);
            header('Cache-Control: no-store, no-cache, mus-revalidate');
            header('Cache-Control: post-check=0, pre-check=0');
            header('Pragma: no-cache');
            header('Expries:0');

            $handle = fopen('php://output','w');

            $headers = array(
                "Job_Idn", "ChangeOrder", "JobNumber", "Page", "Column", "Description", "Amount"
            );

            fputcsv($handle, $headers);

            //Get data for job_numbers
            $data = $this->export->get_accounting_data($job_numbers);

            foreach ($data as $row)
            {
                fputcsv($handle, $row);
            }

            fclose($handle);
            exit;
        }
    }

    public function test()
    {
        $job_numbers = array("951-0");

        $data = $this->export->get_accounting_data($job_numbers);

        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    public function test_subtotals($job_number)
    {
        $this->load->library('j', array('job_number' => $job_number));
        $Job = $this->j;
        $Job->load_recap_rows();

        echo "<pre>";
        print_r($Job->subtotals);
        echo "</pre>";
    }

    public function test_totals($job_number)
    {
        $this->load->library('j', array('job_number' => $job_number));
        $Job = $this->j;
        $Job->load_recap_rows();

        echo "<pre>";
        print_r($Job->totals);
        echo "</pre>";
    }

    public function test_query()
    {
        print_r($this->input->get('job_numbers'));
    }
}
