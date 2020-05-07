<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Worksheet_actions_controller extends CI_Controller {

	function __construct()
	{
		//Includes parent class constructor
		parent::__construct();

		//Check authentication
        check_auth();

		//Load models
		$this->load->model('m_worksheet');
		$this->load->model('m_reference_table');

        //Load libraries
        $this->load->library("worksheet");
	}

	function get_worksheets()
	{
		$results = array(
			"return_code" => 0,
			"worksheets" => array()
			);
		$query = false;
		$job_keys = array();
		$post = $this->input->post();

		if (isset($post) && !empty($post))
		{
			$job_keys = get_job_keys($post['CopyFromJob']);

			$where = array(
				"w.Job_Idn" => $job_keys[0],
				"w.ChangeOrder" => $job_keys[1],
				"w.WorksheetMaster_Idn" => $post['AddWorksheetModal_ChildWorksheetMaster_Idn']
				);

			//Get worksheets
			$this->db
				->select("w.Name AS Name, w.Worksheet_Idn AS Worksheet_Idn")
				->from("Worksheets AS w")
				->join("WorksheetAreas AS wa", "w.WorksheetArea_Idn = wa.WorksheetArea_Idn", "left")
				->where($where)
				->order_by("wa.Rank ASC, w.Rank ASC");

			$query = $this->db->get();

			if ($query)
			{
				$results['worksheets'] = $query->result_array();
				$results['return_code'] = 1;
			}
			else
			{
				$results['return_code'] = -1;
			}
		}

		echo json_encode($results);
	}
}
/* End of file Worksheet_actions_controller.php */
/* Location: ./application/controllers/job.php */