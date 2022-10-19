<?php
class M_reference_table extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }

	/**
	 * get_all
	 *
	 * Get all rows from entire table. By default, method returns records where ActiveFlag = 1
	 *
     * @access  public
	 * @param	$table_name(string)
	 * @param	$active(bool)
	 * @param	$where(mixed) array of where statements ('field_name' => value) or SQL string
	 * @return	$rows(array)
	 */

	public function get_all($table_name, $where = array(), $active = true, $order_by = "")
	{
		//Delcare and initialize variables
		$rows = array();
        $query = false;
		
		//Get all active records
		if (!empty($table_name) && is_string($table_name))
		{
			$this->db
				->select("*")
				->from($table_name);
			
			//Get records with ActiveFlag = 1	
			if ($active)
			{
				$this->db->where('ActiveFlag',1);
			}
			
			if (!empty($where))
			{
				$this->db->where($where);	
			}
            
            if (!empty($order_by))
            {
                $this->db->order_by($order_by);
            }
			
			$query = $this->db->get();
	
            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => get_caller_info()));
            }
            else
            {
			    //If any records were returned, load into rows array
			    if ($query->num_rows() > 0)
			    {
				    foreach ($query->result_array() as $row)
				    {
					    $rows[] = $row;
				    }
			    }
            }
		}
	    
        return $rows;	
	}

	/**
	 * get_idns_names
	 *
	 * Get all rows from entire table. By default, method returns records where ActiveFlag = 1
	 *
     * @access  public
	 * @param	$table_name(string)
	 * @param	$idn(string) name of idn column
	 * @param	$where(array) array of where statements ('field_name' => value)
	 * @param	$active(bool) defaults to true
	 * @return	$rows(array(idn => name)
	 */

	public function get_idns_names($table_name, $idn, $where=array(), $active = true, $order_by = "Rank")
	{
		//Delcare and initialize variables
		$rows = array();
		
		//Get all active records
		if (!empty($table_name) && is_string($table_name))
		{
			$this->db
				->select('*')
				->from($table_name)
				->order_by($order_by);
			
			//Get records with ActiveFlag = 1
			if ($active)
			{
				$this->db->where('ActiveFlag',1);
			}
			
			if (!empty($where))
			{
				$this->db->where($where);	
			}
			
			$query = $this->db->get();
            
            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => get_caller_info()));
            }
			else
            {
			    //If any records were returned, load into rows array
			    if ($query->num_rows() > 0)
			    {
				    foreach ($query->result_array() as $row)
				    {
					    $rows[$row[$idn]] = $row['Name'];
				    }
			    }
            }
		}
        
		return $rows;	
	}
    
    /**
     * get_where
     * 
     * Method to run simple $this->db->get_where() method that will return all fields in the table. Pass in table name and where array
     *
     * @access  public
     * @param   string $table_name)
     * @param   mixed $where
     * @return  array
     */
    
    function get_where($table_name, $where, $order_by = "")
    {
        //Delcare and initialize variables
        $query = false;
        $data = array();
        
        if (!empty($table_name) && !empty($where))
        {
			$this->db
				->select('*')
				->from($table_name)
                ->where($where);

            if (!empty($order_by))
            {
                $this->db->order_by($order_by);
            }

            $query = $this->db->get();
            
            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => get_caller_info()));
            }
            else
            {
                if ($query->num_rows() > 0)
                {
                    foreach ($query->result_array() as $row)
                    {
                        $data[] = $row;
                    }
                }
            }
        }
        
        return $data;
    }
    
    /**
     * get_field
     * 
     * Method to run simple $this->db->get_where() method that will only return specified field. Pass in table name, field name and where array
     *
     * @access  public
     * @param   string(table_name)
     * @param   string(field)
     * @param   array(where)
     * @return  array
     */
    
    public function get_field($table_name, $field, $where, $order_by = "")
    {
        //Delcare and initialize variables
        $query = false;
        $data = "";
        
        if (!empty($where) && !empty($table_name) && !empty($field))
        {
			$this->db
				->select($field)
				->from($table_name)
                ->where($where);
            
            if (!empty($order_by))
            {
                $this->db->order_by($order_by);
            }
            
            $query = $this->db->get();

            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => get_caller_info()));
            }
            else
            {
                // if ($query->num_rows() > 0)
                // {
                //     foreach ($query->result_array() as $row)
                //     {
                //         if ($query->num_rows() == 1)
                //         {
                //             $data = $row[$field];
                //         }
                //         else
                //         {
                //             $data[] = $row[$field];
                //         }
                //     }
                // }
                if ($query->num_rows() == 1)
                {
                    foreach ($query->result_array() as $row)
                    {
                        $data = $row[$field];
                    }
                }

            }
        }
        
        return $data;
    }
    /**
     * Summary of get_fields
     * @param mixed $from 
     * @param string $fields 
     * @param mixed $select 
     * @param mixed $order_by 
     * @return array
     */
    public function get_fields($from, $select, $where, $order_by = "")
    {
        //Delcare and initialize variables
        $query = false;
        $data = array();

        if (!empty($from) && !empty($select))
        {
			$this->db
				->select($select)
				->from($from);
                
            if (!empty($where))
            {
                $this->db->where($where);
            }
    
            if (!empty($order_by))
            {
                $this->db->order_by($order_by);
            }

            $query = $this->db->get();

            if ($query == false)
            {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => get_caller_info()));
            }
            else
            {
                if ($query->num_rows() > 0)
                {
                    foreach ($query->result_array() as $row)
                    {
                        $data[] = $row;
                    }
                }
            }
        }
        
        return $data;
    }

    /**
     * update
     *
     * Update records into table
     *
     * @access  public
     * @param   string ($table)
     * @param 	array ($set)
     * @param   array ($where)
     * @return 	bool
     */
	
	public function update($table, $set, $where)
	{
        //Update table
		if ($this->db->update($table, $set, $where))
        {
			write_feci_log(array("Message" => "Update ".$this->db->last_query(), "Script" => get_caller_info()));

            return true;
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => get_caller_info()));

            return false;
        }
	}

    /**
     * delete
     *
     * Delete records from table
     *
     * @access  public
     * @param   string ($table)
     * @param   mixed ($where)
     * @return 	bool
     */
	
	public function delete($table, $where)
	{
        //Update table
		if ($this->db->delete($table, $where))
        {
            write_feci_log(array("Message" => "Delete ".$this->db->last_query(), "Script" => get_caller_info()));

            return true;
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => get_caller_info()));

            return false;
        }
	}

    /**
     * insert record into table
     *
     * @access  public
     * @param   string $table
     * @param   array   $data
     * @return  boolean
     */
    
    function insert($table, $data)
    {
        if ($this->db->insert($table, $data))
        {
            //I think this line is messing up subsequent $this->db->insert_id() calls
            // write_feci_log(array("Message" => "Insert ".$this->db->last_query(), "Script" => get_caller_info()));

            return true;
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => get_caller_info()));

            return false;
        }
    }

        /**
     * insert record into table
     *
     * @access  public
     * @param   string $table
     * @param   array   $data
     * @return  integer
     */
    
    function insert_return_idn($table, $data)
    {
        if ($this->db->insert($table, $data))
        {
            $new_id = $this->db->insert_id();

            write_feci_log(array("Message" => "Insert ".$this->db->last_query(), "Script" => get_caller_info()));

            return $new_id;
        }
        else
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => get_caller_info()));

            return 0;
        }
    }

}