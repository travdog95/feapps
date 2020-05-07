<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_controller extends CI_Controller {

	function __construct()
	{
		//Includes parent class constructor
		parent::__construct();

		//Check authentication
        check_auth();

		//Load models
		$this->load->model('m_reference_table');
		$this->load->model('m_menu');
		$this->load->model('m_job');

        //Load Libraries
        $this->load->library("user");
	}

	public function index()
	{
		//Declare variables and initialize variables
		$data = array(
			'menus' => array(),
			'active_page' => 'Home',
			'bread_crumbs' => array()
		);

		//Load home menu items
		$data['menus'] = $this->m_menu->get_menus();

		//Load home view
		$this->load->view('home', $data);
	}

	/**
	 * Summary of create_folder
	 */
	public function create_folder()
	{
		$results = array(
			"return_code" => 0,
			//"html" => "",
			"folder" => array()
			);
		$insert_data = array();
		//$job = array();

		$post = $this->input->post(null, true);

		if ($post)
		{
			if ($post['NewFolderText'] != "")
			{
				$department_idn = (isset($post['NewFolderDepartment_Idn'])) ? $post['NewFolderDepartment_Idn'] : $post['NewFolderUserDepartment_Idn'];
				$insert_data = array(
					"Name" => $post['NewFolderText'],
					"IsPublic" => (isset($post['NewFolderIsPublic'])) ? 1 : 0,
					"User_Idn" => $this->session->userdata("user_idn"),
					"Department_Idn" => $department_idn
					);

				if ($this->m_reference_table->insert("Folders", $insert_data))
				{
					$results['folder'] = array(
						"Folder_Idn" => $this->db->insert_id(),
						"Name" => $insert_data['Name'],
						"IsPublic" => $insert_data['IsPublic']
						);
					//$job['FolderName'] = $post['NewFolderText'];
					$results['return_code'] = 1;
					//$results['html'] = $this->load->view("widgets/folders/folder_row", array("job" => $job), true);
				}
				else
				{
					$results['return_code'] = -1;
				}
			}
		}

		echo json_encode($results);
	}

	public function delete_folder($folder_idn = 0)
	{
		$results = array(
			"return_code" => 0,
			"folder_idn" => 0
			);

		if ($folder_idn > 0)
		{
			//Update jobs in folder
			if ($this->m_reference_table->update("Jobs", array("Folder_Idn" => 0), array("Folder_Idn" => $folder_idn)))
			{
				//Delete folder
				if ($this->m_reference_table->delete("Folders","Folder_Idn = {$folder_idn}"))
				{
					$results['return_code'] = 1;
					$results['folder_idn'] = $folder_idn;
				}
				else
				{
					$results['return_code'] = -1;
				}
			}
			else
			{
				$results['return_code'] = -1;
			}
		}

		echo json_encode($results);
	}

	/**
	 * Summary of get_jobs
	 */
	public function get_jobs($department_idn, $folders = 0)
	{
		$job_data = array();
		$jobs = array();
		$data = array();
		$where = array(
			"ActiveFlag" => 1
			);

		if ($folders == 1)
		{
			$where['Folder_Idn'] = 0;
		}

		if ($department_idn != 3)
		{
			$where['Department_Idn'] = $department_idn;
		}

		$jobs = $this->m_reference_table->get_fields("Jobs", "Job_Idn, ChangeOrder, Name, JobDate", $where, "JobDate ASC");

		foreach($jobs as $job)
		{
			$job_number = format_job_number($job['Job_Idn'], $job['ChangeOrder']);
			$data[] = array(
				"SelectJob" => '<input id="FolderJobNumber'.$job_number.'" name="FolderJobNumber[]" type="checkbox" value="'.$job_number.'" />',
				"JobName" => quotes_to_entities($job['Name']),
				"JobDate" => date("M j, Y", get_timestamp($job['JobDate'])),
				"JobNumber" => $job_number,
				"DT_RowId" => "AddJob_".$job_number
				);
		}

		$job_data = array(
			"data" => $data
		);

		echo json_encode($job_data);
	}

	public function get_favorite_jobs()
	{
		$job_number = "";
		$data = array();
		$jobs = $this->user->get_favorite_jobs($this->session->userdata("user_idn"));

		foreach($jobs as $job)
		{
			$job_number = format_job_number($job['Job_Idn'], $job['ChangeOrder']);
			$data[] = array(
				"JobName" => quotes_to_entities($job['Name']),
				"JobDate" => date("M j, Y", get_timestamp($job['JobDate'])),
				"JobNumber" => $job_number,
				"LastUpdated" => date("M j, Y g:i:s A", get_timestamp($job['UpdateDateTime']))
				);
		}

		$job_data = array(
			"data" => $data
		);

		echo json_encode($job_data);
	}

	public function get_recent_jobs()
	{
		$job_number = "";
		$data = array();
		$jobs = $this->user->get_recent_jobs($this->session->userdata("user_idn"), 30);

		foreach($jobs as $job)
		{
			$job_number = format_job_number($job['Job_Idn'], $job['ChangeOrder']);
			$data[] = array(
				"JobName" => quotes_to_entities($job['Name']),
				"JobDate" => date("M j, Y", get_timestamp($job['JobDate'])),
				"JobNumber" => $job_number,
				"LastUpdated" => date("M j, Y g:i:s A", get_timestamp($job['UpdateDateTime']))
				);
		}

		$job_data = array(
			"data" => $data
		);

		echo json_encode($job_data);
	}

	function add_jobs_to_folder($folder_idn = 0)
	{
		//Declare and initialize variables
		$results = array(
			"return_code" => 0,
			"jobs" => array()
		);

		$post = array();
		$where = "";
		$job_keys = array();
		$job = array();
		$job_data = array();

		if ($folder_idn > 0)
		{
			$post = $this->input->post(null, true);

			//Build where statement and html
			foreach($post['FolderJobNumber'] as $job_number)
			{
				$job_keys = get_job_keys($job_number);

				//Build where statement
				$where .= (empty($where)) ? "" : " OR ";
				$where .= "(Job_Idn = {$job_keys[0]} AND ChangeOrder = {$job_keys[1]})";

				//get jobs in folder
				//Get job info
				$job = $this->m_reference_table->get_fields("Jobs", "Job_Idn, ChangeOrder, Name, JobDate, UpdateDateTime", "Job_Idn = {$job_keys[0]} AND ChangeOrder = {$job_keys[1]} AND ActiveFlag = 1");
				$job[0]['Folder_Idn'] = $folder_idn;

				$job_data = array(
					"Folder_Idn" => $folder_idn,
					"JobNumber" => $job_number,
					"JobName" => $job[0]['Name'],
					"JobDate" => date("M d, Y", get_timestamp($job[0]['JobDate'])),
					"JobLastUpdatedDate" => date("M d, Y g:i A", get_timestamp($job[0]['UpdateDateTime']))
				);

				$results['jobs'][] = $job_data;

			}

			if ($this->m_reference_table->update("Jobs", array("Folder_Idn" => $folder_idn), $where))
			{
				$results['return_code'] = 1;
			}
			else
			{
				$results['return_code'] = -1;
			}
		}

		echo json_encode($results);
	}

	/**
	 * Summary of remove_job
	 * @param mixed $job_number
	 */
	function remove_job($job_number = "")
	{
		$results = array(
			"return_code" => 0
			);
		$job_keys = array();

		if ($job_number != "undefined" && !empty($job_number))
		{
			$job_keys = get_job_keys($job_number);

			if ($this->m_reference_table->update("Jobs", array("Folder_Idn" => 0), "Job_Idn = {$job_keys[0]} AND ChangeOrder = {$job_keys[1]}"))
			{
				$results['return_code'] = 1;
			}
			else
			{
				$results['return_code'] = -1;
			}
		}

		echo json_encode($results);
	}

	function update_folder()
	{
		//Declare and initialize variables
		$results = array(
			"return_code" => 0,
			"msg" => ""
			);

		$post = $this->input->post(null, true);

		if (!empty($post))
		{
			$folder_name = $post['value'];
			$folder_idn = $post['pk'];

		    if ($this->m_reference_table->update("Folders", array("Name" => $folder_name), "Folder_Idn = {$folder_idn}"))
		    {
		        $results['return_code'] = 1;
		    }
		    else
		    {
		        $results['return_code'] = -1;
				$results['msg'] = "Error updating folder name.";
		    }

		}

		echo json_encode($post);
	}

	//Toggles the IsPublic field in the the Folders table.
	//Accepts the following POST variables:
	//	folder_idn, name, is_public
	function share_folder()
	{
		//Declare and initialize variables
		$results = array(
			"return_code" => 0,
			"msg" => ""
			);

		$post = $this->input->post(null, true);

		if (!empty($post) && $post['folder_idn'] > 0)
		{
		    if ($this->m_reference_table->update("Folders", array("IsPublic" => $post['is_public']), "Folder_Idn = {$post['folder_idn']}"))
		    {
		        $results['return_code'] = 1;
		    }
		    else
		    {
		        $results['return_code'] = -1;
				$results['msg'] = "Error updating folder.";
		    }

		}

		echo json_encode($results);
	}

	function get_folders_by_user($user_idn = "")
	{
		$data = array();
		$folder_data = array();
		$user_idn = (empty($user_idn)) ? $this->session->userdata("user_idn") : $user_idn;

		$folders = $this->user->get_folders_by_user($user_idn);

		foreach($folders as $f)
		{

			$data[] = array(
				"FolderName" => quotes_to_entities($f['FolderName']),
				"Folder_Idn" => $f['Folder_Idn'],
				"IsPublic" => $f['IsPublic'],
				"Jobs" => array()
				);
		}

		$folder_data = array(
			"data" => $data
		);

		echo json_encode($folder_data);
	}

	function get_shared_folders($department_idn)
	{
		//Declare and initialize variables
		$data = array();
		$folder_data = array();
		$where = array(
			"IsPublic" => 1
		);
		$query;

		if ($department_idn != 3)
		{
			$where['Department_Idn'] = $department_idn;
		}

		$this->db
			->select("*")
			->from("Folders")
			->where($where);

		$query = $this->db->get();

		if ($query)
		{
			//Iterate through each record and load into $jobs array
			foreach ($query->result_array() as $row)
			{
				$data[] = array(
					"FolderName" => quotes_to_entities($row['Name']),
					"Folder_Idn" => $row['Folder_Idn'],
					"IsPublic" => $row['IsPublic'],
					"Jobs" => array()
					);
			}

			$folder_data = array(
				"data" => $data
			);
		}
		else
		{
			write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
		}

		echo json_encode($folder_data);
	}

	public function get_jobs_by_folder($folder_idn = 0)
	{
		$jobs = array();
		$jobs_data = array();
		$data = array();
		$where = array();

		if (!empty($folder_idn) && $folder_idn > 0)
		{
			$where = array(
				"ActiveFlag" => 1,
				"Folder_Idn" => $folder_idn
				);

			//Get jobs
			$jobs_data = $this->m_reference_table->get_fields("Jobs", "Job_Idn, ChangeOrder, Name, JobDate, UpdateDateTime", $where, "Name ASC");

			//Format data
			foreach($jobs_data as $job)
			{
				$job_number = format_job_number($job['Job_Idn'], $job['ChangeOrder']);

				$data = array(
					"Folder_Idn" => $folder_idn,
					"JobNumber" => $job_number,
					"JobName" => $job['Name'],
					"JobDate" => date("M d, Y", get_timestamp($job['JobDate'])),
					"JobLastUpdatedDate" => date("M d, Y g:i A", get_timestamp($job['UpdateDateTime']))
				);

				$jobs[] = $data;
			}
		}

		echo json_encode($jobs);
	}

	public function get_departments()
	{
		$departments = $this->m_reference_table->get_all("jpr_Department", array(), false);

		echo json_encode($departments);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */