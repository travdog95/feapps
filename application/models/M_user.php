<?php
class M_user extends CI_Model {
	
	private $_table_name = 'Users';

    function __construct()
    {
        parent::__construct();
    }
	
    /*
     * get_where
     *
     * Gets entire row from Users table by $where variable
     *
     * @param   array($where('FieldName' => value)
     * @return  array
     */

	public function get_where($where)
	{
		//Delcare and initialize variables
		$user = array();
        
        if (!empty($where))
        {
		    //Get search results from table
		    // $this->db
			//     ->select("Users.User_Idn, Users.UserName, Users.FirstName, Users.LastName, Users.Email, Users.Password, Users.IsContractor, Users.UserRight_Idn, UR.Department_Idn")
			//     ->from($this->_table_name)
			//     ->join('UserRights AS UR', 'Users.UserRight_Idn = UR.UserRight_Idn')
			//     ->where($where);

		    $this->db
			    ->select("*")
			    ->from($this->_table_name)
			    ->where($where);
			$user = $this->db->get()->row();

		    //If any records were returned, load into search_results array
		    // if ($query->num_rows() > 0)
		    // {
			//     foreach ($query->result_array() as $row)
			//     {
			// 	    $user = $row;
			//     }
		    // }
        }
		
		return $user;
	}

	/*
	 * get_users
	 *
	 * Get all records from Users table
	 *
	 * @param 	$active(bool) default = true
	 * @return 	$users(array)
	 */
	public function get_users($active = true)
	{
		//Delcare and initialize variables
		$users = array();
		
		$this->db
			->select("*")
			->from($this->_table_name)
			->order_by('LastName ASC, FirstName ASC');
		
		//Get records with ActiveFlag = 1	
		if ($active)
		{
			$this->db->where('ActiveFlag',1);
		}
			
		$query = $this->db->get();

		//If any records were returned, load into rows array
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$users[] = $row;
			}
		}
		
		return $users;	
	}

	/*
	 * get_user_idns_names_by_department
	 *
	 * Get all records from Users table by Department_Idn
	 *
	 * @param	$department_idns(array)
	 * @param 	$active(bool) default = true
	 * @return 	$users(array)
	 */
	public function get_user_idns_names_by_department($department_idns, $active = true)
	{
		//Delcare and initialize variables
		$users = array();
		
		if (is_array($department_idns))
		{
			$this->db
				->select("User_Idn, LastName, FirstName")
				->from($this->_table_name)
//				->join('UserRights','Users.UserRight_Idn = UserRights.UserRight_Idn')
				->where_in('Department_Idn', $department_idns)
				->order_by('LastName ASC, FirstName ASC');
			
			//Get records with ActiveFlag = 1	
			if ($active)
			{
				$this->db->where('Users.ActiveFlag',1);
			}
				
			$query = $this->db->get();
	
			//If any records were returned, load into rows array
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$users[$row['User_Idn']] = $row['LastName'].', '.$row['FirstName'];
				}
			}
		}
		
		return $users;	
	}
    
    /**
     * get_first_name_by_idn
     *
     * Gets user's first name by User_Idn
     *
     * @param   int($user_idn)
     * @return  string($first_name)
     */
    
    function get_first_name_by_idn($user_idn)
    {
        //Delcare and initialize variables
        $first_name = "";
        $query = false;
        
        $this->db
            ->select('FirstName')
            ->from('Users')
            ->where('User_Idn', $user_idn);
        
        $query = $this->db->get();
        
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        else
        {
			//If any records were returned, load into rows array
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
                {
                    $first_name = $row['FirstName'];
                }
            }
        }
        
        return $first_name;
    }

    /**
     * Summary of get_favorite_jobs
     * @param mixed $user_idn 
     * @return array
     */
    public function get_favorite_jobs($user_idn)
    {
        $jobs = array();
        $query = false;

        if (!empty($user_idn))
        {
            $this->db
                ->select("j.*")
                ->from("Jobs AS j")
								->join("UserFavoriteJobs AS f", "j.Job_Idn = f.Job_Idn AND j.ChangeOrder = f.ChangeOrder AND f.User_Idn = {$user_idn}")
								->where("ActiveFlag = 1")
                ->order_by("UpdateDateTime DESC");
            
            $query = $this->db->get();
            
            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            }
            else
            {
                //If any records were returned, load into rows array
                if ($query->num_rows() > 0)
                {
                    foreach ($query->result_array() as $row)
                    {
                        $jobs[] = $row;
                    }
                }
            }
        }

        return $jobs;
    }
}