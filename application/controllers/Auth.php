<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() 
    {
   		//Includes parent class constructor
		parent::__construct();

        $this->load->model('auth_model');
    }

    public function login()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != 'POST')
        {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
        else
        {
            $check_auth_client = $this->auth_model->check_auth_client();

            if ($check_auth_client)
            {
                $params = $_REQUEST;

                $user_name = $params['user_name'];
                $password = $params['password'];

                $response = $this->auth_model->login($user_name, $password);
                //echo $response;
                json_output($response['status'], $response);
            }
        }
    }

    public function logout()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != 'POST')
        {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
        else
        {
            $check_auth_client = $this->auth_model->check_auth_client();

            if ($check_auth_client)
            {
                $response = $this->auth_model->logout();
                json_output($response['status'], $response);
            }
        }
    }
}
