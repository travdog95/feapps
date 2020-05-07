<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Jobs extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/job_model', 'job_model');
    }

    public function index_get()
    {
        $id = $this->get( 'id' );
        $fields = $this->get('fields');
        $params = array(
            'where' => array(),
            'order_by' => "",
            'fields' => $fields
        );

        if ( $id === null )
        {
            $params['where'] = array(
                "j.Department_Idn" => 2
            );
            $params['order_by'] = "Job_Idn DESC";

            // get jobs
            $jobs = $this->job_model->get_jobs($params);

            // Check if the users data store contains users
            if ( $jobs )
            {
                // Set the response and exit
                $this->response( $jobs, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No jobs were found'
                ], 404 );
            }
        }
        else
        {
            $job_keys = get_job_keys($id);

            // get job by job_number
            $where = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1]
            );
            $job = $this->job_model->get_jobs($where);

            if (!empty($job))
            {
                $this->response( $job, 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such job found'
                ], 404 );
            }
        }
    }
}