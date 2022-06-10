<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils extends CI_Controller {

	function __construct()
	{
		//Includes parent class constructor
		parent::__construct();

		//Check authentication
        check_auth();

		//Load reference table model
		$this->load->model('m_reference_table');
	}

	/**
	 * Summary of fix_pipe_exposure
	 */
	public function get_options($table_name = "", $table_id = "", $filterBy = "", $filterByValue = "")
	{
		$options = array();
		$where = array($filterBy => $filterByValue);
        $results = $this->m_reference_table->get_idns_names($table_name, $table_id, $where, true, "Name");

		//reformat to multidimensional array for json encode
		foreach ($results as $value => $name)
		{
			$options[] = array(
				"value" => $value,
				"name" => $name,
			);
		}

		// $options = array(
		// 	"table" => $table_name,
		// 	"table_id" => $table_id,
		// 	"filterby" => $filterBy,
		// 	"filterByValue" => $filterByValue
		// );

		echo json_encode($options);
	}
}
/* End of file utils.php */
/* Location: ./application/controllers/utils.php */