<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {

	function __construct()
	{
		//Includes parent class constructor
		parent::__construct();
        
        //Load libraries
        $this->load->library('User');
	}
	
	public function index()
	{
		//Declare variables
		$data = array(
			'message' => ""
		);
		
		//If user is already logged in, redirect to home controller
		if ($this->session->userdata('user_name') != "")
		{
			redirect('home');
		}
		
		//Get session message
		$data['message'] .= $this->session->flashdata('message');
		
        //**********************************
        //  Authentication Form Validation
        //*********************************** 
		//Initialize form validation
		$this->load->library('form_validation');
		
		//Allows errors to be displayed in containing element
		$this->form_validation->set_error_delimiters('', '');
		
		//Set Validation rules
		$this->form_validation->set_rules('username', 'User Name', 'required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
		
		//If validation passes
		if ($this->form_validation->run())
		{
			//Authenticate user
			$results = $this->user->verify_user($this->input->post('username'), $this->input->post('password'));

			//Check to see if user authenticated
			if ($results['return_code'] == 1)
			{
				//Load custom session data when user authenticates
				$new_session_data = array(
					'user_name' => $this->user->user_name,
					'first_name' => $this->user->first_name,
					'last_name' => $this->user->last_name,
					'user_idn' => $this->user->user_idn,
					'department_idn' => $this->user->department_idn,
					'is_contractor' => $this->user->is_contractor,
					'is_admin' => $this->user->is_admin,
					'read_only' => $this->user->read_only, 
					'last_access' => time()
				);

				$this->session->set_userdata($new_session_data);
				
                //After authentication, go to Home Page
				redirect('home');
			}
			else
			{
                //Error handling
				$data['message'] .= ($results['return_code'] == 0) ? "Incorrect User Name or Password.  Please try again!" : "Unable to connect to server.";
			}
		}
		
        //Display Login Page
		$this->load->view('login',$data);
	}

	/*
	 * sign_off
	 *
	 * Destroys all session variables and returns user to login view
	 *
	 * @param ()
	 * @return ()
	 */
	public function sign_off()
	{
		//Destory session and return to login page
		$this->session->sess_destroy();
		$this->load->view('login');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */