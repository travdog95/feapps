<?php
class Job_model extends CI_Model
{
    private $_table_name = 'Jobs';

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * get_jobs
     *
     * Gets records from Jobs table based on criteria sent via $where argument
     *
     * @access  public
     * @param	$params(array(
     *              "where" => array(),
     *              "select" => array(),
     *              "order_by" => "",
     *              "limit" => 0,
     *              "offset" => 0    
     *          )) 
     * @return 	$jobs(array)
     */

//    public function get_jobs($where = array(), $limit = 0, $offset = 0, $order_by = "")
    public function get_jobs($params = array())
    {   
        //Delcare and initialize variables
        $jobs = array();
        $job = array();
        $sql = "";
        $query = false;
        
        //Get search results from table
        $this->db
            ->select("j.*, ub.FirstName AS UpdatedByFirstName, cb.FirstName AS CreatedByFirstName")
            ->from('Jobs AS j')
            ->where(array("j.ActiveFlag" => 1))
            ->join('Users AS ub', 'j.LastUpdatedBy_Idn = ub.User_Idn', 'left')
            ->join('Users AS cb', 'j.CreatedBy_Idn = cb.User_Idn', 'left');

        if (!empty($params['where'])) 
        {
            $this->db->where($params['where']);
        }

        if (!empty($params['order_by']))
        {
            $this->db->order_by($params['order_by']);
        }
        //    ->limit($limit, $offset);

        $query = $this->db->get();
        
        if ($query) {
            //Iterate through each record and load into $jobs array
            foreach ($query->result_array() as $row) {
                $job = array();
                //add JobNumber
                $row['JobNumber'] = format_job_number($row['Job_Idn'], $row['ChangeOrder']);

                if (!empty($params['fields'])) {
                    //insert field logic here
                    $job['JobNumber'] = $row['JobNumber'];
                    
                } else {
                
                    $row['PreparedBys'] = array();
                    
                    $prepared_bys_where = array(
                        'Job_Idn' => $row['Job_Idn'],
                        'ChangeOrder' => $row['ChangeOrder']
                    );
                    
                    //Check for PreparedBys records and load as array into PreparedBys field
                    $row['PreparedBys'] = $this->get_prepared_by_names($prepared_bys_where);

                    $job = $row;
                }
                //Load search results into $jobs array
                $jobs[] = $job;
            }

            //If just one job, return as one item and not an array 
            if ($query->num_rows() == 1) {
                $jobs = $jobs[0];
            }

        } else {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        
        return $jobs;
    }
    
    /**
     * get_prepared_by_names
     *
     * Gets records from JobPreparedBys table based on criteria sent via $where argument
     *
     * @access  public
     * @param 	$where(array) associative array containing key/value pair matching field name and value
     * @return 	$prepared_by_names(array)
     */
    
    public function get_prepared_by_names($where)
    {
        //Declare and initialize variables
        $prepared_by_names = array();
        $query = false;
    
        $this->db
            ->select('u.FirstName')
            ->from('JobPreparedBys AS jpb')
            ->join('Users AS u', 'jpb.PreparedBy_Idn = u.User_Idn')
            ->where($where);
            
        $query = $this->db->get();
        
        if ($query == false) {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        } else {
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $prepared_by_names[] = $row['FirstName'];
                }
            }
        }
        
        return $prepared_by_names;
    }

    /**
     * insert
     *
     * Inserts record into Jobs table
     *
     * @access  public
     * @param 	$job_data(array)
     * @return 	$query
     */
    
    public function insert($job_data)
    {
        //Insert row
        $query = $this->db->insert('Jobs', $job_data);
        
        if ($query == false) {
            write_feci_log('SQL Error '.$this->db->last_query().' in class '.get_class($this));
        }
        
        return $query;
    }
    
    /**
     * delete_by_job_number
     *
     * Delete job by setting ActiveFlag = 0
     *
     * @access  public
     * @param 	$job_number(string)
     * @return 	bool
     */
    public function delete($job_number)
    {
        //Declare and initialize variables
        $job_keys = array();
        $update = array();
        $where = array();
        
        //Get job keys
        $job_keys = get_job_keys($job_number);
        $update = array(
            'ActiveFlag' => 0
        );
        
        //Set Job_Idn and ChangeOrder for where statement
        $where = array(
            'Job_Idn' => $job_keys[0],
            'ChangeOrder' => $job_keys[1]
        );
        
        $this->db->where($where);
        
        //Set ActiveFlag = 0
        if ($this->db->update($this->_table_name, $update)) {
            return true;
        } else {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            
            return false;
        }
    }
    
    /**
     * save
     *
     * Save Jobs record by Job_Idn, ChangeOrder.
     * Update will happen if Job_Idn and ChangeOrder exist in database.
     * Insert will happen if $job_number = "0" or change order = "*"
     * save method will also add any missing Job Parm Details records.
     *
     * @access  public
     * @param	$job_number(string)
     * @param	$set(array) an array that contains the field name and value to update - 'Contractor' => 'Blue Diamond'
     * @return	$save_results(array)
     */
    public function save($job_number, $set)
    {
        //Delcare and initialize variables
        $save_results = array(
            'return_code' => 0,
            'job_number' => "0",
            'save_type' => "",
            'message' => ""
        );
        $job_keys = array();
        $where = array();
        $save = false;
        $compare = false;
        $new_job_idn = 0;
        
        if (!empty($set)) {
            //Get job keys
            $job_keys = get_job_keys($job_number);
            
            //Set where array
            $where = array(
                'Job_Idn' => $job_keys[0],
                'ChangeOrder' => $job_keys[1]
            );
        
            //Query to see if Jobs record exists
            $query = $this->db->get_where($this->_table_name, $where);
            
            if ($query == false) {
                write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
            } else {
                //If record exists
                if ($query->num_rows() > 0) {
                    //Update $save_results
                    $save_results['save_type'] = "U";
                    $save_results['job_number'] = $job_keys[0]."-".$job_keys[1];
                    
                    //Set where clause and update table
                    $this->db->where($where);
                    
                    //Update Jobs table
                    $save = $this->db->update($this->_table_name, $set);
                    
                    if ($save == false) {
                        write_feci_log(array("Message" => 'SQL Error '.$this->db->last_query(), "Script" => __METHOD__));
                        
                        $save_results['message'] .= "Error updating Job ".$job_number;
                    } else {
                        //Update $save_results
                        $save_results['return_code'] = 1;
                    }
                } else {
                    //***************** Insert new job record  ******************************/
                    //Update $save_results
                    $save_results['save_type'] = "I";

                    $set['PriceUpdate_Idn'] = get_latest_price_update("idn");

                    //Add change order to $set array if JobNumber_Idn ($job_keys[0]) is 0
                    if ($job_keys[0] == 0) {
                        //Set ChangeOrder value
                        $set['ChangeOrder'] = 0;
                        
                        //Get next Job_Idn from Job_Idns table
                        $job_keys[0] = $this->get_next_job_idn();
                        
                        //Populate new Job_Idn for query
                        $set['Job_Idn'] = $job_keys[0];
                    }
                    
                    //Set job_number for save results
                    $save_results['job_number'] = $job_keys[0]."-".$job_keys[1];
                    
                    //Insert Record
                    $save = $this->db->insert($this->_table_name, $set);
                    
                    if ($save) {
                        //Update $save_results
                        $save_results['return_code'] = 1;
                        
                        //Compare JobParmDetails records with JobDefaults records and insert any missing records into JobParmDetails table
                        $compare = $this->m_job_parm_detail->compare($save_results['job_number'], true);
                    } else {
                        $save_results['message'] .= "Error inserting Job ".$save_results['job_number'];
                        $save_results['return_code'] = -1;
                    }
                }
            }
        } //END: (!empty($set))
        
        return $save_results;
    }

    /**
     * get_next_change_order
     *
     * Determines next change order number by Job_Idn
     *
     * @access  public
     * @param	$job_idn(mixed)
     * @return	$chang_order(integer)
     */
    public function get_next_change_order($job_idn)
    {
        //Delcare and initialize variables
        $change_order = 0;
        
        //Check parm
        if ($job_idn > 0) {
            //Check to see if job_idn exists and get highest change order
            $this->db->select('ChangeOrder')
                ->from($this->_table_name)
                ->where('Job_Idn', $job_idn)
                ->order_by('ChangeOrder DESC')
                ->limit(1);
                
            $query = $this->db->get()->row();
            
            $change_order = $row;
        }
        
        return $change_order;
    }

    /**
     * get_next_job_idn()
     *
     * Inserts record into Job_Idns table and returns new id
     *
     * @access  public
     * @return	$job_idn(int)
     */
    
    public function get_next_job_idn()
    {
        //Delcare and initialize variables
        $job_idn = 0;
        $set = array('Used' => 1);
        
        if ($this->db->insert('Job_Idns', $set)) {
            $job_idn = $this->db->insert_id();
        } else {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        
        return $job_idn;
    }
}
