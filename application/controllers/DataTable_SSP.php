<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataTable_SSP extends CI_Controller {

	function __construct()
	{
		//Includes parent class constructor
		parent::__construct();
        
        require_once APPPATH . 'third_party/ssp.class.php';
        // $this->db = db_connect();
	}

    public function index()
    {
        // this is database details
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "ProductsStaging2";

        //primary key
        $primaryKey = "Product_Idn";

        $columns = array(
            array(
                "db" => "Product_Idn",
                "dt" => 0,
            ),
            array(
                "db" => "Name",
                "dt" => 1,
            ),
            array(
                "db" => "FECI_Id",
                "dt" => 2,
            ),
            array(
                "db" => "ManufacturerPart_Id",
                "dt" => 3,
            ),
            array(
                "db" => "RFP",
                "dt" => 4,
            ),
            array(
                "db" => "MaterialUnitPrice",
                "dt" => 5,
            ),
        );

        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
}

/* Location: ./application/controllers/DataTable_SSP.php */