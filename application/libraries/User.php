<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* User Class
*
* @author   TKO Consulting, LLC
*/
class User
{
    //Public members
    public $user_idn = 0;
    public $first_name = "";
    public $last_name = "";
    public $user_name = "";
    public $email = "";
    public $is_contractor = 0;
    public $active_flag = 0;
    public $department_idn = 0;
    public $read_only = 0;

    //Private members
    private $CI;

	public function __construct()
	{
        //Set Code Igniter object
		$this->CI =& get_instance();

        //Load models
        $this->CI->load->model('m_user');
        $this->CI->load->model('m_reference_table');
	}

    /**
     * get_by_user_name
     *
     * Gets user data by user_name
     *
     * @access  public
     * @param   string
     * @return  array
     */

    public function get_by_user_name($user_name)
	{
		//Declare and initialize variables
        $user = array();
        $where = array(
            'ActiveFlag' => 1,
            'UserName' => $user_name);

        //Get User
        $user = $this->CI->m_user->get_where($where);

        //Set properties
        $this->_set_properties($user);

        return $user;
	}

    /**
     * get_by_user_name_password
     *
     * Get user by username and password
     *
     * @param   string
     * @param   string
     * @return  array
     */
    public function get_by_user_name_password($user_name, $password)
    {
		//Declare and initialize variables
        $user = array();
        $where = array(
            'ActiveFlag' => 1,
            'UserName' => $user_name,
            'Password' => $password
        );

        //Get User
        $user = $this->CI->m_user->get_where($where);

        //Set properties
        $this->_set_properties($user);

        return $user;
    }

	/*
     * verify_user
     *
     * Verifies authentication attempt by checking the Users table by UserName and Password
     *
     * @param	$username(string)
     * @param 	$password(string)
     * @return	$results(array)
     */
	public function verify_user($user_name, $password)
	{
		//Declare and Initialize variables
		$results = array (
			'user' => array(),
			'return_code' => 0
		);

		//Get User record from table
		$results['user'] = $this->get_by_user_name_password($user_name, $password);

		if (!empty($results['user']))
		{
			$results['return_code'] = 1;
		}

		return $results;
	}

    /**
     * _set_properties
     *
     * Sets properties based on field names of Users table
     *
     * @param   array
     * @return  void
     */
    private function _set_properties($user)
    {
        if (!empty($user))
        {
            //Load members
            // $this->active_flag = 1;
            // $this->user_idn = $user['User_Idn'];
            // $this->user_name = $user['UserName'];
            // $this->first_name = $user['FirstName'];
            // $this->last_name = $user['LastName'];
            // $this->email = $user['Email'];
            // $this->is_contractor = $user['IsContractor'];
            // $this->department_idn = $user['Department_Idn'];
            // $this->user_right_idn = $user['UserRight_Idn'];

            $this->active_flag = $user->ActiveFlag;
            $this->user_idn = $user->User_Idn;
            $this->user_name = $user->UserName;
            $this->first_name = $user->FirstName;
            $this->last_name = $user->LastName;
            $this->email = $user->Email;
            $this->is_contractor = $user->IsContractor;
            $this->department_idn = $user->Department_Idn;
            $this->is_admin = $user->IsAdmin;
            $this->read_only = $user->ReadOnly; 
        }
    }

    /**
     * Summary of get_recent_jobs
     * @param mixed $user_idn
     * @param mixed $days
     * @return mixed
     */
    public function get_recent_jobs($user_idn = "", $days = 120)
    {
        //Declare and initialize variables
        $jobs = array();
        $where = "";
        $table_name = "";
        $order_by = "";

        if (!empty($user_idn))
        {
            $table_name = "Jobs";
            $where = "ActiveFlag = 1 AND ((CreatedBy_Idn = {$user_idn} AND CreateDateTime >= Dateadd(d,-{$days},getdate())) OR (LastUpdatedBy_Idn = {$user_idn} AND UpdateDateTime > = Dateadd(d,-{$days},getdate())))";
            $order_by = "UpdateDateTime DESC";

            $jobs = $this->CI->m_reference_table->get_where($table_name, $where, $order_by);
        }

        return $jobs;
    }

    /**
     * Summary of get_favorite_jobs
     * @param mixed $user_idn
     * @return mixed
     */
    public function get_favorite_jobs($user_idn = "")
    {
        //Declare and initialize variables
        $jobs = array();

        if (!empty($user_idn))
        {
            $jobs = $this->CI->m_user->get_favorite_jobs($user_idn);
        }

        return $jobs;
    }

	/**
	 * Summary of get_folders_by_user
	 * @param mixed $user_idn
	 * @return mixed
	 */

	public function get_folders_by_user($user_idn)
	{
		//Declare and initialize variables
		$folders = array();

		if ($user_idn > 0)
		{
			$this->CI->load->model('m_job');

			$this->CI->db
				->select("Name AS FolderName, Folder_Idn, IsPublic")
				->from("Folders")
				->where("User_Idn = {$user_idn}");

			$query = $this->CI->db->get();

			if ($query)
			{
				//Iterate through each record and load into $jobs array
				foreach ($query->result_array() as $folder)
				{
					//Load search results into $jobs array
					$folders[] = $folder;
				}
			}
			else
			{
				write_feci_log(array("Message" => "SQL Error ".$this->CI->db->last_query(), "Script" => __METHOD__));
			}

		}

		return $folders;
	}
}
?>