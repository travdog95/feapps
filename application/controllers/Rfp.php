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
    
		$this->load->library("rfp_lib");

		require_once APPPATH . 'third_party/ssp.class.php';

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

		$data['column_headers'] = array(
			"Status",
			'Job Number', 
			'Name',
			"Estimator",
			'Job Date',
			'Worksheet Name',
			'Product ID',
			'Product Name',
			"Assembly",
			"Create Date",
			"Update Date"
		);

		//Get Exceptions
        $data['exceptions'] = $this->rfp_lib->get_exceptions();

		//Load menus
		$data['menus'] = $this->m_menu->get_menus();

        //Load job search view
		$this->load->view('rfp/index', $data);
	}

	public function exceptions()
	{
		$results = array(
			"data" 				=> array(),
			"recordsTotal" 		=> 0,
			"recordsFiltered" 	=> 0,
			"draw" 				=> 0,
			"request"			=> $this->input->post(),
		);
		$row_values = array();

		$post = $this->input->post();

		$columns = array(
			array(
				"db" => "s.Name",
				"dt" => 0,
				"searchable" => true
			),
			array(
				"db" => "JobNumber",
				"dt" => 1,
				// "searchable" => true
			),
			array(
				"db" => "JobName",
				"dt" => 2,
			),
			array(
				"db" => "EstimatorName",
				"dt" => 3,
			),
			array(
				"db" => "j.JobDate",
				"dt" => 4,
			),
			array(
				"db" => "w.Name",
				"dt" => 5,
			),
			array(
				"db" => "p.Product_Idn",
				"dt" => 6,
				"searchable" => true
			),
			array(
				"db" => "p.Name",
				"dt" => 7,
				"searchable" => true
			),
			array(
				"db" => "p.IsParent",
				"dt" => 8,
			),
			array(
				"db" => "rfp.CreateDate",
				"dt" => 9,
			),
			array(
				"db" => "rfp.UpdateDate",
				"dt" => 10,
			),
		);

		$select = "s.Name, w.Job_Idn + '-' + w.ChangeOrder AS JobNumber, j.Name AS JobName, u.FirstName + ' ' + u.LastName AS EstimatorName, j.JobDate, w.Name AS WorksheetName, p.Product_Idn, p.Name as ProductName, p.IsParent, rfp.CreateDate, rfp.UpdateDate";
		$from = "RFPExceptions AS rfp";
		$joins = array(
			array("RFPExceptionStatuses AS s", "rfp.RFPExceptionStatus_Idn = s.RFPExceptionStatus_Idn", "left"),
			array("Worksheets AS w", "w.Worksheet_Idn = rfp.Worksheet_Idn", "left"),
			array("Products AS p", "p.Product_Idn = rfp.Product_Idn", "left"),
			array("Jobs AS j", "w.Job_Idn = j.Job_Idn AND w.ChangeOrder = j.ChangeOrder", "left"),
			array("Users AS u", "j.CreatedBy_Idn = u.User_Idn", "left")
		);

		$order_by = SSP::order($post, $columns);

		$dtColumns = SSP::pluck($columns, "dt");

		//Get all records
		$this->db
			->select($select)
			->from($from)
			->order_by($order_by);

		foreach ($joins as $join) 
		{
			$this->db->join($join[0], $join[1], $join[2]);
		}
	
		if (isset($post['search']) && $post['search']['value'] != '') 
		{
			$str = $post['search']['value'];

			for ( $i=0, $ien=count($post['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $post['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];

				if ( isset($column['searchable']) && $column['searchable'] == 'true' ) {
					$this->db->or_like($column['db'], $str);
				}
			}
		}

		$queryAllRows = $this->db->get();

		if ($queryAllRows == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
			$results['recordsTotal'] = $queryAllRows->num_rows();
			$results['recordsFiltered'] = $queryAllRows->num_rows();
		}

		//Get records to display
		$this->db
			->select($select)
			->from($from)
			->order_by($order_by);

		foreach ($joins as $join) 
		{
			$this->db->join($join[0], $join[1], $join[2]);
		}

		if (isset($post['search']) && $post['search']['value'] != '') 
		{
			$str = $post['search']['value'];

			for ( $i=0, $ien=count($post['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $post['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];

				if ( isset($column['searchable']) && $column['searchable'] == 'true' ) {
					$this->db->or_like($column['db'], $str);
				}
			}
		}

		if (isset($post['start']) && $post['length'] != -1) 
		{
			$this->db->limit(intval($post['length']), intval($post['start']));
		}

		$query = $this->db->get();

		if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
            if ($query->num_rows() > 0)
            {
				$results['draw'] = isset ( $post['draw'] ) ?
					intval( $post['draw'] + 1 ) :
					0;
				foreach ($query->result_array() as $row)
                {
					$rowValues = array();
					foreach($row as $field => $value)
					{
						$rowValues[] = $value;
					}
                    $results['data'][] = $rowValues;
                }
            }
		}

		echo json_encode($results) ;
	}

	public function activeExceptions()
	{
		$results = array(
			"data" => array()
		);
		$exceptions = $this->rfp_lib->get_active_exceptions();
		$results['data'] = $exceptions;

		echo json_encode($results);
	}
}
/* End of file Rfp.php */
/* Location: ./application/controllers/rfp.php */