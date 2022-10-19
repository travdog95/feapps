<?php
class M_job extends CI_Model
{
    private $_table_name = 'Jobs';

    public function __construct()
    {
        parent::__construct();

        $this->load->library("rfp_lib");
    }
    
    /**
     * get_jobs
     *
     * Gets records from Jobs table based on criteria sent via $where argument
     *
     * @access  public
     * @param	$sql_where(string) String containing the where statements for the SQL
     * @param	$limit(int)
     * @param	$offset(int)
     * @return 	$jobs(array)
     */

    public function get_jobs($sql_where = "", $limit = 0, $offset = 0, $order_by = "")
    {
        //Delcare and initialize variables
        $jobs = array();
        $sql = "";
        $query = false;
        
        if (empty($order_by)) {
            $order_by = "Name ASC";
        }
        if ($limit == 0 && $offset == 0) {
            $sql = "SELECT j.Job_Idn, j.ChangeOrder, Name, Contractor, j.Department_Idn, JobStatus_Idn, JobDate, IsShareable, IsParent, Parent_Idn, CreatedBy_Idn, CreateDateTime, UpdateDateTime, ub.FirstName AS UpdatedByFirstName, cb.FirstName AS CreatedByFirstName,
                    ROW_NUMBER() OVER (ORDER BY j.Name ASC, j.JobDate ASC) AS RowNum
					FROM jobs AS j
					LEFT JOIN Users AS ub ON (j.LastUpdatedBy_Idn = ub.User_Idn)
					LEFT JOIN Users AS cb ON (j.CreatedBy_Idn = cb.User_Idn)
					WHERE j.ActiveFlag = 1
						{$sql_where}
					ORDER BY {$order_by}";
        } else {
            $sql = ";WITH Results_CTE AS
                    (
                        SELECT j.Job_Idn, j.ChangeOrder, Name, Contractor, j.Department_Idn, JobStatus_Idn, JobDate, IsShareable, IsParent, Parent_Idn, CreatedBy_Idn, CreateDateTime, UpdateDateTime, ub.FirstName AS UpdatedByFirstName, cb.FirstName AS CreatedByFirstName,
                            ROW_NUMBER() OVER (ORDER BY j.Name ASC, j.JobDate ASC) AS RowNum
                        FROM jobs AS j
                        LEFT JOIN Users AS ub ON (j.LastUpdatedBy_Idn = ub.User_Idn)
                        LEFT JOIN Users AS cb ON (j.CreatedBy_Idn = cb.User_Idn)
                        WHERE j.ActiveFlag = 1 
                            {$sql_where}
                    )
                    SELECT Job_Idn, ChangeOrder, Name, Contractor, j.Department_Idn, JobStatus_Idn, JobDate, IsShareable, IsParent, Parent_Idn, CreatedBy_Idn, CreateDateTime, UpdateDateTime, UpdatedByFirstName, CreatedByFirstName
                    FROM Results_CTE AS j
                    WHERE RowNum > {$offset}
                    AND RowNum <= {$offset} + {$limit}
                    ORDER BY {$order_by}";
        }

        $query = $this->db->query($sql);
        
        if ($query !== false) {
            //Iterate through each record and load into $jobs array
            foreach ($query->result_array() as $row) {
                $row['PreparedBys'] = array();
                
                $prepared_bys_where = array(
                    'Job_Idn' => $row['Job_Idn'],
                    'ChangeOrder' => $row['ChangeOrder']
                );
                
                //Check for PreparedBys records and load as array into PreparedBys field
                $row['PreparedBys'] = $this->get_prepared_by_names($prepared_bys_where);
                
                //Add Total to job row
                $row['Total'] = 0;
    
                //Load search results into $jobs array
                $jobs[] = $row;
            }
        } else {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        }
        
        return $jobs;
    }
    
    /**
     * get_total_jobs
     *
     * Gets records from Jobs table based on criteria sent via $where argument
     *
     * @access  public
     * @param	$where(array) associative array containing key/value pair matching field name and value
     * @param	$like(array) associative array containing key/value pair matching field name and value
     * @param	$where_in(array) array first value (with index of 0) is field name, second value (with index of 1) is array of values
     * @return 	$total_jobs(int)
     */
    // public function get_total_jobs($where = array(), $like = array(), $custom_where = "")
    // {
    //     //Delcare and initialize variables
    //     $total_jobs = 0;
        
    //     //Get search results from table
    //     $this->db
    //         ->select("j.Job_Idn, j.ChangeOrder")
    //         ->distinct()
    //         ->from('Jobs AS j')
    //         ->join('JobPreparedBys AS jpb', 'j.Job_Idn = jpb.Job_Idn AND j.ChangeOrder = jpb.ChangeOrder', 'left');
            
    //     if (!empty($where)) {
    //         $this->db->where($where);
    //     }
        
    //     if (!empty($like)) {
    //         $this->db->like($like);
    //     }
        
    //     if (!empty($custom_where)) {
    //         $this->db->where($custom_where);
    //     }
        
    //     $query = $this->db->get();
        
    //     if ($query == false) {
    //         write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
    //     } else {
    //         $total_jobs = $query->num_rows();
    //     }
        
    //     return $total_jobs;
    // }
    
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
     * get_by_job_number
     *
     * Gets all columns from Jobs table by Job_Idn and ChangeOrder
     *
     * @access  public
     * @param 	$job_number(string)
     * @return 	$job_data(array)
     */
    
    public function get_by_job_number($job_number)
    {
        //Delcare and initialize variables
        $job_data = array();
        $job_keys = array();
        $query = false;
        
        //Get job_keys
        $job_keys = get_job_keys($job_number);
        
        $query = $this->db->get_where('Jobs', array('Job_Idn' => $job_keys[0], 'ChangeOrder' => $job_keys[1]));
        
        if ($query == false) {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
        } else {
            if ($query->num_rows() == 1) {
                foreach ($query->result_array() as $row) {
                    $job_data = $row;
                }
            }
        }
        
        return $job_data;
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
            write_feci_log();
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
    public function delete_by_job_number($job_number)
    {
        //Declare and initialize variables
        $job_keys = array();
        $update = array();
        $where = array();
        $delete_rfps_results = array();
        
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
            //Delete any RFP Exceptions
            $delete_rfps_results = $this->rfp_lib->delete_by_job($job_number);
            
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
            
            ////New change order logic
            //if (!is_numeric($job_keys[1]))
            //{
            //    //Get next change order number
            //    $job_keys[1] = $this->get_next_change_order($job_keys[0]);
                
            //    //Add Job_Idn and ChangeOrder to $set array for insert
            //    $set['Job_Idn'] = $job_keys[0];
            //    $set['ChangeOrder'] = $job_keys[1];
            //}
            
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
                
            $query = $this->db->get();
            
            if ($query == false) {
                $change_order = -1;
                
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            } else {
                if ($query->num_rows() > 0) {
                    foreach ($query->result_array() as $row) {
                        $change_order = $row['ChangeOrder'] + 1;
                    }
                } else {
                    $change_order = -1;
                }
            }
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
    
    /**
     * is_parent
     *
     * Quick check to see if job is a parent job
     *
     * @access  public
     * @param   string(job_number)
     * @return  boolean
     */
    
    public function is_parent($job_number = "")
    {
        //Delcare and initialize variables
        $query = false;
        $is_parent = false;
        $job_keys = array();
        $where = array();
        
        if (!empty($job_number)) {
            //Get job_keys
            $job_keys = get_job_keys($job_number);
            
            //Set where clause
            $where = array(
                'Job_Idn' => $job_keys[0],
                'ChangeOrder' => $job_keys[1],
                'ActiveFlag' => 1
            );
            
            //Check to see if job_idn exists and get highest change order
            $this->db->select('IsParent')
                ->from($this->_table_name)
                ->where($where);
            
            $query = $this->db->get();
            
            if ($query) {
                if ($query->num_rows() == 1) {
                    foreach ($query->result_array() as $row) {
                        $is_parent = ($row['IsParent'] == 1) ? true : false;
                    }
                }
            } else {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            }
        }
        
        return $is_parent;
    }

    public function get_folders_by_user($user_idn)
    {
        //Declare and initialize variables
        $folders = array();
        $sql = "";

        if ($user_idn > 0) {
            $sql = "SELECT f.Name AS FolderName, f.Folder_Idn, f.IsPublic, j.Job_Idn, j.ChangeOrder, j.Name, Department_Idn, JobStatus_Idn, JobDate, IsShareable, IsParent, Parent_Idn, CreatedBy_Idn, CreateDateTime, UpdateDateTime, ub.FirstName AS UpdatedByFirstName, cb.FirstName AS CreatedByFirstName
					FROM Folders AS f
					LEFT JOIN Jobs AS j ON (j.Folder_Idn = f.Folder_Idn AND j.ActiveFlag = 1)
					LEFT JOIN Users AS ub ON (j.LastUpdatedBy_Idn = ub.User_Idn)
					LEFT JOIN Users AS cb ON (j.CreatedBy_Idn = cb.User_Idn)
					WHERE f.User_Idn = {$user_idn}
					ORDER BY f.Name ASC, j.Job_Idn ASC, j.ChangeOrder ASC";

            $query = $this->db->query($sql);

            if ($query) {
                //Iterate through each record and load into $jobs array
                foreach ($query->result_array() as $row) {
                    $row['PreparedBys'] = array();

                    $prepared_bys_where = array(
                        'Job_Idn' => $row['Job_Idn'],
                        'ChangeOrder' => $row['ChangeOrder']
                    );

                    //Check for PreparedBys records and load as array into PreparedBys field
                    $row['PreparedBys'] = $this->get_prepared_by_names($prepared_bys_where);

                    //Add Total to job row
                    $row['Total'] = 0;

                    //Load search results into $jobs array
                    $folders[] = $row;
                }
            } else {
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            }
        }

        return $folders;
    }

    public function get_price_changes($job_number)
    {
        $rows = array();
        $department_idn = 0;
        $job_keys = array();
        $sql = "";

        if ($job_number > 0) {
            $department_idn = get_department_idn($job_number);
            $job_keys = get_job_keys($job_number);

            $sql = "SELECT RR.RecapRow_Idn, RR.Name AS RecapRowName, RRWM.WorksheetMaster_Idn AS ParentWorksheetMaster_Idn, PWM.Name AS ParentWorksheetMasterName
					FROM RecapRows AS RR
					JOIN RecapRowWorksheetMasters AS RRWM ON (RR.RecapRow_Idn = RRWM.RecapRow_Idn)
					LEFT JOIN WorksheetMasters AS PWM on (RRWM.WorksheetMaster_Idn = PWM.WorksheetMaster_Idn)
					WHERE RR.ActiveFlag = 1
						AND RR.Department_Idn = {$department_idn}
					ORDER BY RR.Rank";

            $recap_row_query = $this->db->query($sql);

            if ($recap_row_query) {
                //Iterate through each record and load into $jobs array
                foreach ($recap_row_query->result_array() as $recap_row) {
                    //Load price difference for Recap Row
                    $recap_row['PriceDifferences'] = $this->get_worksheet_price_differences($job_keys, $recap_row['ParentWorksheetMaster_Idn']);

                    //Load price differences for child worksheets
                    $recap_row['Children'] = array();

                    $this->db->select("WMC.WorksheetMaster_Idn AS ParentWorksheetMaster_Idn, WMC.ChildWorksheetMaster_Idn, WM.Name AS ChildWorksheetMasterName")
                        ->from("WorksheetMasterCategories AS WMC")
                        ->join("WorksheetMasters AS WM", "WM.WorksheetMaster_Idn = WMC.ChildWorksheetMaster_Idn", "INNER")
                        ->where("WMC.WorksheetMaster_Idn = {$recap_row['ParentWorksheetMaster_Idn']}")
                        ->order_by("WMC.Rank");

                    $children_query = $this->db->get();

                    if ($children_query) {
                        if ($children_query->num_rows() > 0) {
                            foreach ($children_query->result_array() as $child) {
                                $child['PriceDifferences'] = $this->get_worksheet_price_differences($job_keys, $child['ChildWorksheetMaster_Idn']);

                                $recap_row['Children'][] = $child;
                            }
                        }
                    }

                    $rows[] = $recap_row;
                }
            }
        }

        return $rows;
    }

    public function get_worksheet_price_differences($job_keys, $worksheet_master_idn)
    {
        $sql = "";
        $price_differences = array();

        if (!empty($job_keys) && !empty($worksheet_master_idn) && $worksheet_master_idn > 0) {
            $sql = "SELECT p.Product_Idn,
						wd.Quantity,
						p.Name AS ProductName,
						p.MaterialUnitPrice AS new_mup,
						wd.MaterialUnitPrice AS old_mup,
						p.FieldUnitPrice AS new_fup,
						wd.FieldUnitPrice AS old_fup,
						p.ShopUnitPrice AS new_sup,
						wd.ShopUnitPrice AS old_sup,
						p.EngineerUnitPrice AS new_eup,
						wd.EngineerUnitPrice AS old_eup,
						w.Worksheet_Idn AS Worksheet_Idn,
						w.Name AS WorksheetName,
						w.WorksheetMaster_Idn,
						'0' AS ProductAssembly_Idn,
						'0' AS MiscellaneousDetail_Idn
					FROM Worksheets AS w
					left join WorksheetDetails AS wd ON (w.Worksheet_Idn = wd.Worksheet_Idn)
					left join Products AS p on (p.Product_idn = wd.Product_Idn)
					WHERE w.Job_Idn = {$job_keys[0]}
						AND w.ChangeOrder = {$job_keys[1]}
						AND w.WorksheetMaster_Idn = {$worksheet_master_idn}
						AND ((p.MaterialUnitPrice <> wd.MaterialUnitPrice AND p.MaterialUnitPrice > 0)
						OR (p.FieldUnitPrice <> wd.FieldUnitPrice AND p.FieldUnitPrice > 0)
						OR (p.ShopUnitPrice <> wd.ShopUnitPrice AND p.ShopUnitPrice > 0)
						OR (p.EngineerUnitPrice <> wd.EngineerUnitPrice AND p.EngineerUnitPrice > 0))
					UNION
					SELECT p.Product_Idn,
						ad.Quantity,
						p.Name AS ProductName,
						p.MaterialUnitPrice AS new_mup,
						ad.MaterialUnitPrice AS old_mup,
						p.FieldUnitPrice AS new_fup,
						ad.FieldUnitPrice AS old_fup,
						p.ShopUnitPrice AS new_sup,
						ad.ShopUnitPrice AS old_sup,
						'0' AS new_eup,
						'0' AS old_eup,
						w.Worksheet_Idn AS Worksheet_Idn,
						w.Name AS WorksheetName,
						w.WorksheetMaster_Idn,
						ad.ProductAssembly_Idn,
						md.MiscellaneousDetail_Idn
					FROM Worksheets AS w
					LEFT JOIN MiscellaneousDetails AS md ON (w.Worksheet_Idn = md.Worksheet_Idn AND md.ProductAssembly_Idn > 0)
					left join ProductAssemblyDetails AS ad ON (md.ProductAssembly_Idn = ad.ProductAssembly_Idn)
					left join Products AS p ON (p.Product_Idn = ad.Product_Idn)
					WHERE w.Job_Idn = {$job_keys[0]}
						AND w.ChangeOrder = {$job_keys[1]}
						AND w.WorksheetMaster_Idn = {$worksheet_master_idn}
						AND ((p.MaterialUnitPrice <> ad.MaterialUnitPrice AND p.MaterialUnitPrice > 0)
						OR (p.FieldUnitPrice <> ad.FieldUnitPrice AND p.FieldUnitPrice > 0)
						OR (p.ShopUnitPrice <> ad.ShopUnitPrice AND p.ShopUnitPrice > 0))
					ORDER BY Worksheet_Idn, Product_Idn";
            $query = $this->db->query($sql);

            if ($query) {
                foreach ($query->result_array() as $p) {
                    //Material
                    $new_mup = "-";
                    $old_mup = "-";
                    if ($p['new_mup'] != $p['old_mup'] && $p['new_mup'] > 0) {
                        $new_mup = $p['new_mup'];
                        $old_mup = $p['old_mup'];
                    }

                    $p['new_mup'] = $new_mup;
                    $p['old_mup'] = $old_mup;

                    //Field
                    $new_fup = "-";
                    $old_fup = "-";
                    if ($p['new_fup'] != $p['old_fup'] && $p['new_fup'] > 0) {
                        $new_fup = $p['new_fup'];
                        $old_fup = $p['old_fup'];
                    }

                    $p['new_fup'] = $new_fup;
                    $p['old_fup'] = $old_fup;

                    //Shop
                    $new_sup = "-";
                    $old_sup = "-";
                    if ($p['new_sup'] != $p['old_sup'] && $p['new_sup'] > 0) {
                        $new_sup = $p['new_sup'];
                        $old_sup = $p['old_sup'];
                    }

                    $p['new_sup'] = $new_sup;
                    $p['old_sup'] = $old_sup;

                    //Engineering
                    $new_eup = "-";
                    $old_eup = "-";
                    if ($p['new_eup'] != $p['old_eup'] && $p['new_eup'] > 0) {
                        $new_eup = $p['new_eup'];
                        $old_eup = $p['old_eup'];
                    }

                    $p['new_eup'] = $new_eup;
                    $p['old_eup'] = $old_eup;

                    $p['IsRFPException'] = $this->rfp_lib->is_worksheet_detail_exception($p['Worksheet_Idn'], $p['Product_Idn'], array(1,2));

                    $price_differences[] = $p;
                }
            }
        }

        return $price_differences;
    }
}
