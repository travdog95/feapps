<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Job extends CI_Controller
{
    public function __construct()
    {
        //Includes parent class constructor
        parent::__construct();

        //Check authentication
        check_auth();
        
        //Load reference table model
        $this->load->model('m_job');
        $this->load->model('m_reference_table');
        $this->load->model('m_menu');
    }
    
    /*
     * search
     *
     * @return	job/search view
     */
    public function search()
    {
        //Decare and initialize variables
        $data = array(
            'menus' => array(),
            'active_page' => 'Search Jobs',
            'bread_crumbs' => array(
                array(
                    'name' => 'Search Jobs',
                    'link' => ''
                )
            )
        );

        //Load menus
        $data['menus'] = $this->m_menu->get_menus();

        //Load job search view
        $this->load->view('job/search', $data);
    }

    public function get_jobs()
    {
        $results = array(
            "data" => array()
            );
        $query = false;
        $data = array();
        $prepared_bys = array();
        $i = 1;
        $json = true;
        $get = $this->input->get();

        if ($get['department_idn'] != "") {
            $department_idn = $get['department_idn'];

            //Load model
            $this->load->model("m_job");

            $this->db
                ->select("j.Job_Idn, j.ChangeOrder, j.Name, Contractor, JobDate, IsShareable, IsParent, Parent_Idn, CreatedBy_Idn, CreateDateTime, UpdateDateTime, ub.FirstName AS UpdatedByFirstName, cb.FirstName AS CreatedByFirstName, f.Name AS FolderName, d.Description AS DepartmentName")
                ->from('Jobs AS j')
                ->join('Users AS ub', 'j.LastUpdatedBy_Idn = ub.User_Idn', 'left')
                ->join('Users AS cb', 'j.CreatedBy_Idn = cb.User_Idn', 'left')
                ->join('Folders AS f', 'j.Folder_Idn = f.Folder_Idn', 'left')
                ->join('jpr_Department as d', 'j.Department_Idn = d.DepartmentId', 'left')
                ->where("j.ActiveFlag", 1)
                ->order_by('Name ASC, JobDate ASC');

            if ($department_idn != "3") {
                $this->db->where("j.Department_Idn", $department_idn);
            }

            $query = $this->db->get();

            if ($query) {
                foreach ($query->result_array() as $row) {
                    $job_number = ($row['ChangeOrder'] > 0) ? $row['Job_Idn']."-".$row['ChangeOrder'] : $row['Job_Idn'];

                    $parent_child = "";
                    if ($row['IsParent'] == 1) {
                        $parent_child = "P";
                    }

                    if ($row['Parent_Idn'] > 0) {
                        $parent_child = "C";
                    }

                    $prepared_bys_where = array(
                        'Job_Idn' => $row['Job_Idn'],
                        'ChangeOrder' => $row['ChangeOrder']
                    );

                    //Check for PreparedBys records and load as array into PreparedBys field
                    $prepared_bys = $this->m_job->get_prepared_by_names($prepared_bys_where);

                    $prepared_by = (sizeof($prepared_bys) > 0) ? $row['CreatedByFirstName'].", ".implode(",", $prepared_bys) : $row['CreatedByFirstName'];

                    $folder_name = ($row['FolderName'] == null) ? "" : $row['FolderName'];

                    $data = array(
                        'id' => $i++,
                        'job_number' => $job_number,
                        //'parent/child' => $parent_child,
                        'department' => $row['DepartmentName'],
                        'folder_name' => $folder_name,
                        'name' => $row['Name'],
                        'contractor' => $row['Contractor'],
                        'prepared_by' => $prepared_by,
                        'job_date' => $row['JobDate'],
                        'updated_date' => $row['UpdateDateTime'],
                        'updated_by' => $row['UpdatedByFirstName']
                        );

                    $results['data'][] = $data;
                }
            }
        }

        if ($json) {
            echo json_encode($results);
        } else {
            return $results;
        }
    }

    /*
     * copy
     *
     * Copies job. Job information is passed via post
     * Copy Job records from the following tables
     * Jobs
     * JobPreparedBys
     * JobParmDetails
     * JobSystemTypes
     * JobVolumeCorrections
     * WorksheetAreas
     * WorksheetRecapDetails
     * Worksheets
     * WorksheetDetails
     * WorksheetFactorDetails
     * WorksheetParms
     * MiscellaneousDetails
     * JobMobWorksheets
     * WorksheetBasicAppropriationDetails
     * WorksheetEngineeringAdditionalCosts
     *
     * @param	$ajax(int) if 1, this is an aj
     * @param	$data(array) array containing job_number, job_name
     * @return	$results(array) if ajax, returns JSON, if not, returns array
     */
    
    public function copy($ajax=0, $data=array())
    {
        //Delcare and initialize variables
        $job_data = array();
        $results = array(
            'return_code' => 0,
            'new_job_idn' => 0
        );
        $insert_job = false;

        //If post call, load into $data array
        if (empty($data) && $this->input->post() != false) {
            //Load post data into array
            $data = $this->input->post();
        }

        //Get job to copy
        $job_data = $this->m_job->get_by_job_number($data['job_number']);
        
        //Prepare data for insert
        //Remove Job_Idn element if exists
        //unset($job_data['Job_Idn']);
        //Set defaults
        $job_data['Job_Idn'] = $this->m_job->get_next_job_idn();
        $job_data['Name'] = "Copy of ".$job_data['Name'];
        $job_data['ChangeOrder'] = 0;
        $job_data['JobDate'] = get_current_date();
        $job_data['IsParent'] = 0;
        $job_data['CreatedBy_Idn'] = $this->session->userdata('user_idn');
        $job_data['LastUpdatedBy_Idn'] = $this->session->userdata('user_idn');
        $job_data['CreateDateTime'] = get_current_date(1);
        $job_data['UpdateDateTime'] = get_current_date(1);
        $job_data['JointJob_Idn'] = 0;
        $job_data['JointChangeOrder'] = 0;
        $job_data['IsValidated'] = 0;
        
        //Insert record into Jobs table and return new Job_Idn
        $insert_job = $this->m_job->insert($job_data);
        
        if ($insert_job != false) {
            $results['new_job_idn'] = $job_data['Job_Idn'];
            $results['return_code'] = 1;

            //******** Copy JobPreparedBys ********
            //Load model
            $this->load->model('m_job_prepared_by');
            
            //Get JobPreparedBys records
            $job_prepared_bys = $this->m_job_prepared_by->get_by_job_number($data['job_number']);
            
            foreach ($job_prepared_bys as $row) {
                $row['Job_Idn'] = $results['new_job_idn'];
                $row['ChangeOrder'] = 0;

                if ($this->m_job_prepared_by->insert($row) == false) {
                    $results['return_code'] = -1;
                    write_feci_log("Error inserting into JobPreparedBys table for Job Number {$row['Job_Idn']}-{$row['ChangeOrder']}");
                }
            }
            
            //******** Copy JobParmDetails ********
            //Load model
            $this->load->model('m_job_parm_detail');
            
            //Get records
            $job_parm_details = $this->m_job_parm_detail->get_by_job_number($data['job_number']);
            
            foreach ($job_parm_details as $row) {
                $row['Job_Idn'] = $results['new_job_idn'];
                $row['ChangeOrder'] = 0;
                
                if ($this->m_job_parm_detail->insert($row) == false) {
                    $results['return_code'] = -1;
                    write_feci_log("Error inserting into JobParmDetails table for Job Number {$row['Job_Idn']}-{$row['ChangeOrder']}");
                }
            }

            //******** Copy JobSystemTypes ********
            //Load model
            $this->load->model('m_job_system_type');
            
            //Get records
            $job_system_types = $this->m_job_system_type->get_by_job_number($data['job_number']);
            
            foreach ($job_system_types as $row) {
                $row['Job_Idn'] = $results['new_job_idn'];
                $row['ChangeOrder'] = 0;

                if ($this->m_job_system_type->insert_row($row) == false) {
                    $results['return_code'] = -1;
                    write_feci_log("Error inserting into JobSystemTypes table for Job Number {$row['Job_Idn']}-{$row['ChangeOrder']}");
                }
            }

            //******** Copy JobVolumeCorrections ********
            //Load model
            $this->load->model('m_job_volume_correction');
            
            //Get records
            $job_volume_corrections = $this->m_job_volume_correction->get_by_job_number($data['job_number']);
            
            foreach ($job_volume_corrections as $row) {
                $row['Job_Idn'] = $results['new_job_idn'];
                $row['ChangeOrder'] = 0;

                if ($this->m_job_volume_correction->insert($row) == false) {
                    $results['return_code'] = -1;
                    write_feci_log("Error inserting into JobVolumeCorrections table for Job Number {$row['Job_Idn']}-{$row['ChangeOrder']}");
                }
            }

            //******** Copy WorksheetAreas ********
            //Load model
            $this->load->model('m_worksheet_area');
            
            //Get records
            $worksheet_areas = $this->m_worksheet_area->get_by_job_number($data['job_number']);
            $new_worksheet_areas = array();
            $worksheet_area_idn = 0;
            $new_worksheet_area_idn = 0;
            
            foreach ($worksheet_areas as $row) {
                //Load existing WorksheetArea_Idn to use later
                $worksheet_area_idn = $row['WorksheetArea_Idn'];
                
                //Remove element so DB will create new Idn
                unset($row['WorksheetArea_Idn']);
                
                //Load new Job_Idn and set ChangeOrder to 0
                $row['Job_Idn'] = $results['new_job_idn'];
                $row['ChangeOrder'] = 0;
                
                $new_worksheet_area_idn = $this->m_worksheet_area->insert($row);
                
                if ($new_worksheet_area_idn > 0) {
                    $new_worksheet_areas[$worksheet_area_idn] = $new_worksheet_area_idn;
                } else {
                    $results['return_code'] = -1;
                    write_feci_log("Error inserting into WorksheetAreas table for Job Number {$row['Job_Idn']}-{$row['ChangeOrder']}");
                }
            }

            //******** Copy WorksheetRecapDetails ********
            //Sprinkler module only
            if ($job_data['Department_Idn'] == 2) {
                //Load model
                $this->load->model('m_worksheet_recap_detail');
                
                //Get records
                $worksheet_recap_details = $this->m_worksheet_recap_detail->get_by_job_number($data['job_number']);
                
                foreach ($worksheet_recap_details as $row) {
                    //If record has a worksheet area, set it to new value
                    if ($row['WorksheetArea_Idn'] > 0) {
                        $row['WorksheetArea_Idn'] = $new_worksheet_areas[$row['WorksheetArea_Idn']];
                    }
                    
                    //Load new Job_Idn
                    $row['Job_Idn'] = $results['new_job_idn'];
                    $row['ChangeOrder'] = 0;
                    
                    //Remove WorksheetRecap_Idn element
                    unset($row['WorksheetRecap_Idn']);
                    
                    //If error with new record
                    if ($this->m_worksheet_recap_detail->insert($row) > 0) {
                    } else {
                        $results['return_code'] = -1;
                        write_feci_log("Error inserting into WorksheetRecapDetails table for Job Number {$row['Job_Idn']}-{$row['ChangeOrder']}");
                    }
                }
            }
            
            //******** Copy Worksheets ********
            //Load model
            $this->load->model('m_worksheet');
            
            //Get records
            $worksheets = $this->m_worksheet->get_by_job_number($data['job_number'], 'WorksheetArea_Idn, WorksheetMaster_Idn');
            
            $new_worksheet_idn = 0;
            $worksheet_idn = 0;
            
            foreach ($worksheets as $worksheet) {
                //Load existing worksheet_idn for later use
                $worksheet_idn = $worksheet['Worksheet_Idn'];
                
                //Remove Worksheet_Idn element
                unset($worksheet['Worksheet_Idn']);
                
                //If record has a worksheet area, set it to new value
                if ($worksheet['WorksheetArea_Idn'] > 0) {
                    $worksheet['WorksheetArea_Idn'] = $new_worksheet_areas[$worksheet['WorksheetArea_Idn']];
                }
                
                //Set to new Job_Idn and change order to 0
                $worksheet['Job_Idn'] = $results['new_job_idn'];
                $worksheet['ChangeOrder'] = 0;
            
                //Set Copy update flag to 1
                $worksheet['CopyUpdateFlag'] = 1;
                $worksheet['CreateDateTime'] = get_current_date(1);
                
                //Create new worksheet
                $new_worksheet_idn = $this->m_worksheet->insert($worksheet);
                
                if ($new_worksheet_idn > 0) {
                    //******** Copy WorksheetDetails ********
                    
                    //Get records
                    $worksheet_details = $this->m_worksheet->get_worksheet_details($worksheet_idn);
                    
                    foreach ($worksheet_details as $row) {
                        //Load new worksheet_idn
                        $row['Worksheet_Idn'] = $new_worksheet_idn;
                        
                        if ($this->m_worksheet->insert_worksheet_details($row) == false) {
                            $results['return_code'] = -1;
                            write_feci_log("Error inserting into WorksheetDetails table for worksheet {$new_worksheet_idn}");
                        }
                    }

                    //******** Copy WorksheetFactorDetails ********
                    //Get records
                    $worksheet_factors = $this->m_worksheet->get_factor_details_by_worksheet_idn($worksheet_idn);
                    
                    foreach ($worksheet_factors as $row) {
                        //Load new worksheet_idn
                        $row['Worksheet_Idn'] = $new_worksheet_idn;
                        
                        if ($this->m_worksheet->insert_worksheet_factor_details($row) == false) {
                            $results['return_code'] = -1;
                            write_feci_log("Error inserting into WorksheetFactorDetails table for worksheet {$new_worksheet_idn}");
                        }
                    }

                    //******** Copy WorksheetParms ********
                    //Get records
                    $worksheet_parms = $this->m_worksheet->get_worksheet_parms_by_worksheet_idn($worksheet_idn);
                    
                    foreach ($worksheet_parms as $row) {
                        //Load new worksheet_idn
                        $row['Worksheet_Idn'] = $new_worksheet_idn;
                        
                        if ($this->m_worksheet->insert_worksheet_parms($row) == false) {
                            $results['return_code'] = -1;
                            write_feci_log("Error inserting into WorksheetParms table for worksheet {$new_worksheet_idn}");
                        }
                    }

                    //******** Copy MiscellaneousDetails ********
                    //Get records
                    $miscellaneous_details = $this->m_worksheet->get_miscellaneous_details($worksheet_idn);
                    
                    foreach ($miscellaneous_details as $row) {
                        //Load new worksheet_idn
                        $row['Worksheet_Idn'] = $new_worksheet_idn;
                        
                        //Remove MiscellaneousDetail_Idn from $row
                        unset($row['MiscellaneousDetail_Idn']);
                        
                        if ($this->m_worksheet->insert_miscellaneous_details($row) == false) {
                            $results['return_code'] = -1;
                            write_feci_log("Error inserting into MiscellaneousDetails table for worksheet {$new_worksheet_idn}");
                        }
                    }

                    //******** Copy WorksheetBasicAppropriationDetails for Engineering worksheet (22) ********
                    //Insert worksheet_basic_appropriation_detail records with new engineering worksheet_id and with old branchline_worksheet_id's
                    //assuming engineering worksheet will be created before branchline worksheets
                    //After branchline worksheets are created, I update the branchline_worksheet_id (see below)
                    if ($worksheet['WorksheetMaster_Idn'] == 22) {
                        //Set this to update record later
                        $new_engineering_worksheet_idn = $new_worksheet_idn;
                        
                        //Get records
                        $worksheet_basic_appropriations = $this->m_worksheet->get_basic_appropriation_details_by_worksheet_idn($worksheet_idn);
                        
                        foreach ($worksheet_basic_appropriations as $row) {
                            //Load new worksheet_idn
                            $row['Worksheet_Idn'] = $new_worksheet_idn;
                            
                            if ($this->m_worksheet->insert_basic_appropriation_details($row) == false) {
                                $results['return_code'] = -1;
                                write_feci_log("Error inserting into WorksheetBasicAppropriationDetails table for worksheet {$new_worksheet_idn}");
                            }
                        }
                        
                        //******** Copy WorksheetEngineeringAdditionalCosts ********
                        //Get records
                        //$additional_costs = $this->m_worksheet->get_engineering_additional_costs_by_worksheet_idn($worksheet_idn);
                        $additional_costs = $this->m_reference_table->get_where("WorksheetEngineeringAdditionalCosts", "Worksheet_Idn = {$worksheet_idn}");

                        foreach ($additional_costs as $row) {
                            //Load new worksheet_idn
                            $row['Worksheet_Idn'] = $new_worksheet_idn;
                            
                            if ($this->m_worksheet->insert_engineering_additional_costs($row) == false) {
                                $results['return_code'] = -1;
                                write_feci_log("Error inserting into WorksheetEngineeringAdditionalCosts table for worksheet {$new_worksheet_idn}");
                            }
                        }
                    }
                    
                    //Update basic appropropriations Branch line worksheets
                    if ($worksheet['WorksheetMaster_Idn'] == 9) {
                        $update = array(
                            'BranchLineWorksheet_Idn' => $new_worksheet_idn
                        )
                        ;
                        $where = array(
                            'Worksheet_Idn' => $new_engineering_worksheet_idn,
                            'BranchLineWorksheet_Idn' => $worksheet_idn
                        );
                        
                        if ($this->m_worksheet->update_basic_appropriations_details($update, $where) == false) {
                            $results['return_code'] = -1;
                            write_feci_log("Error updating WorksheetBasicAppropriationDetails table for worksheet {$new_worksheet_idn}");
                        }
                    }
                    
                    if ($worksheet['WorksheetMaster_Idn'] == 8) {
                        //******** Copy JobMobWorksheets ********
                        //load model
                        $this->load->model('m_job_mob_worksheet');
                        $job_mob = array();
                        
                        //Get records
                        $job_mob = $this->m_job_mob_worksheet->get_by_worksheet_idn($worksheet_idn);
    
                        if (!empty($job_mob)) {
                            //Load new worksheet_idn
                            $job_mob['Worksheet_Idn'] = $new_worksheet_idn;
                            
                            if ($this->m_job_mob_worksheet->insert($job_mob) == false) {
                                $results['return_code'] = -1;
                                write_feci_log("Error inserting into JobMobWorksheets table for worksheet {$new_worksheet_idn}");
                            }
                        }
                    }
                    
                    if ($results['return_code'] == 0) {
                        $results['return_code'] = 1;
                    }
                } else { //if ($new_worksheet_idn > 0)
                    $results['return_code'] = -1;
                    write_feci_log("Error inserting into Worksheets table for Job Number {$row['Job_Idn']}-{$row['ChangeOrder']}");
                }
            } //END: foreach($worksheets as $worksheet)

            //Load J library
            $this->load->library('j');

            //Update ParentWorksheet_Idn
            $this->j->update_parent_worksheet_idn($results['new_job_idn']);
        }
        
        if ($ajax == 1) {
            echo json_encode($results);
        } else {
            return $results;
        }
    }

    /*
     * delete
     *
     * Delete job by setting ActiveFlag = 0
     *
     * @param	$ajax(int) if not = 0, the call is an ajax call and will return JSON
     * @param 	$job_numbers(array) array of job numbers
     * @return 	$restults(array)
     */
    
    public function delete($ajax = 0, $job_numbers = array())
    {
        //Declare and initialize variables
        $results = array(
            'return_code' => 0,
            'num_jobs_deleted' => 0,
            'job_numbers_deleted' => array()
        );
        //$job_keys = array();
        $post = $this->input->post();

        //If post call, load into $job_numbers array
        if (isset($post) && !empty($post)) {
            $job_numbers = $post['job_numbers'];
        }
    
        if (!empty($job_numbers)) {
            //Loop through jobs and set ActiveFlag = 0
            foreach ($job_numbers as $job_number) {
                if ($this->m_job->delete_by_job_number($job_number)) {
                    $results['num_jobs_deleted']++;
                    $results['job_numbers_deleted'][] = $job_number;
                    write_feci_log('Job '.$job_number.' deleted.');
                } else {
                    $results['return_code'] = -1;
                    write_feci_log('Error deleting job '.$job_number.'.');
                }
            }
            
            if ($results['return_code'] == 0) {
                $results['return_code'] = 1;
            }
        }

        if ($ajax == 0) {
            return $results;
        } else {
            echo json_encode($results);
        }
    }
    
    /*
     * information
     *
     * Function will contains all the logic to create a new job. If $deparment_idn is 0, that means user has
     * permissions to create a job in either module, sprinkler or special hazard. If so, a modal dialog will appear and
     * ask user to choose
     *
     * @param	$job_number(string)
     * @param	$department_idn(int)
     *
     */
    public function information($job_number="0", $department_idn=0)
    {
        //Delcare and initialize variables
        $data = array(
            'menus' => array(),
            'prepared_bys' => array(),
            'statuses' => array(),
            'system_types' => array(),
            'system_sub_types' => array(),
            'grooved_fitting' => array(),
            'job' => array(),
            'active_page' => 'Job Information',
            'bread_crumbs' => array(
                array(
                    'name' => 'Job Information',
                    'link' => ''
                )
            )
        );
        $job_keys = array();
        $parent_data = array();
        
        //Load models
        $this->load->model('m_user');
        
        //Load menus
        $data['menus'] = $this->m_menu->get_menus($job_number);
        
        //Get job keys
        $job_keys = get_job_keys($job_number);
        
        //Create logic
        if ($job_keys[0] == "0" || $job_keys[1] === '*') {
            //Get department_idn if creating new change order
            if ($job_keys[1] === "*") {
                //Get parent job data
                $parent_data = $this->get_job($job_keys[0]);
                
                //Set department_idn
                $department_idn = $parent_data['department_idn'];
            }
            
            if ($department_idn == 0) {
                //Send to job/create
                $this->create_job();
            } else {
                //Determine page name
                $page_name = ($job_keys[0] == "0") ? 'Create Job' : 'Create Change Order';
                    
                //Modify Bread Crumbs
                $data['bread_crumbs']  = array(
                    array(
                        'name' => $page_name,
                        'link' => ''
                    )
                );
                
                //Modify Active Page
                $data['active_page'] = $page_name;
                
                //Load job defaults
                $data['job'] = $this->get_job_defaults($department_idn);
                
                //Load job data if creating new change order to display on page.
                if ($job_keys[1] === '*') {
                    $data['job']['job_number'] = $job_number;
                    $data['job']['name'] = $parent_data['name'];
                    $data['job']['contractor'] = $parent_data['contractor'];
                    $data['job']['new_change_order'] = 1;
                }
            }
        } else {
            //Get job data from Jobs table
            $data['job'] = $this->get_job($job_number);

            $department_idn = $data['job']['department_idn'];
        }

        //Load Select elements for Job info form
        //Load models
        $this->load->model('m_system_type');

        //Load select options and checkboxes
        $data['prepared_bys'] = $this->m_user->get_user_idns_names_by_department(array(3,$department_idn));
        $data['statuses'] = $this->m_reference_table->get_idns_names('JobStatuses', 'JobStatus_Idn');
        $data['system_types'] = $this->m_reference_table->get_idns_names('SystemTypes', 'SystemType_Idn', array('Department_Idn' => $department_idn));

        if ($department_idn == 1) {
            $data['estimate_types'] = $this->m_reference_table->get_idns_names('EstimateTypes', 'EstimateType_Idn', array('Department_Idn' => $department_idn));
            $data['job_types'] = $this->m_reference_table->get_idns_names('JobTypes', 'JobType_Idn');
        }

        //Get system sub types Name with multi-dimensional array ([SystemType_Idn][SystemSubType_Idn])
        $data['system_sub_types'] = $this->m_system_type->get_system_sub_types($department_idn);
        //$data['grooved_fittings'] = $this->m_reference_table->get_idns_names('GroovedFittingTypes', 'GroovedFittingType_Idn');

        //Load view
        $this->load->view('job/information', $data);
    }
    
    /*
     * save_information
     *
     * Function will contains all the logic to create a new job. If $deparment_idn is 0, that means user has
     * permissions to create a job in either module, sprinkler or special hazard. If so, a modal dialog will appear and
     * ask user to choose
     *
     * @param	$data(array)
     */
    public function save_information($data=array())
    {
        //Declare and initialize variables
        $job_data = array();
        $job_parm_data = array();
        $system_types = array();
        $system_sub_types = array();
        //$job_prepared_bys = array();
        $save_results = array();
        $update = array();
        $job_keys = array();
        
        //Load models
        $this->load->model('m_job_parm_detail');
        $this->load->model('m_job_system_type');
        $this->load->model('m_job_prepared_by');
        
        //Load post data into array
        $data = $this->input->post();
        
        //Parse post data into separate arrays to save to JobPreparedBys, JobParmDetails and Jobs tables
        $job_data['IsParent'] = ($data['is_parent'] == 'Y') ? 1 : 0;
        $job_data['Name'] = $data['name'];
        $job_data['Contractor'] = (isset($data['contractor'])) ? $data['contractor'] : "";
        $job_data['JobStatus_Idn'] = $data['status'];
        $job_data['LastUpdatedBy_Idn'] = $this->session->userdata('user_idn');
        $job_data['Department_Idn'] = $data['department_idn'];
        $job_data['UpdateDateTime'] = get_current_date(1);
        $job_data['IsShareable'] = ($data['is_shareable'] == "Y") ? 1 : 0;
        $job_data['JobType_Idn'] = (isset($data['job_type'])) ? $data['job_type'] : 0;

        $job_keys = get_job_keys($data['job_number']);

        if ($data['job_number'] == "0" || $job_keys[1] === "*") {
            $job_data['JobDate'] = get_current_date();
            $job_data['CreatedBy_Idn'] = $this->session->userdata('user_idn');
            $job_data['CreateDateTime'] = get_current_date(1);

            if ($job_keys[1] === "*") {
                //Get next change order
                $job_keys[1] = $this->m_job->get_next_change_order($job_keys[0]);
                //rebuild $data['job_number'] with new change order
                $data['job_number'] = format_job_number($job_keys[0], $job_keys[1]);

                $job_data['Job_Idn'] = $job_keys[0];
                $job_data['ChangeOrder'] = $job_keys[1];
            }
        }

        //Save Jobs record
        $save_results = $this->m_job->save($data['job_number'], $job_data);

        //Job Parm data
        //Joint Job
        if (isset($data['is_joint_job'])) {
            $job_parm_data['27'] = $data['is_joint_job'];
        }
        //Domestic 28
        $job_parm_data['28'] = $data['is_domestic_required'];
        //Domestic options 42
        $job_parm_data['42'] = $data['domestic_options'];

        //Davis Bacon Job 30
        $job_parm_data['30'] = $data['is_davis_bacon_job'];
        //Davis Bacon PAC 20
        $job_parm_data['20'] = str_replace(",", "", $data['davis_bacon_pac']) / 100;

        //Labor Rates
        if ($data['department_idn'] == 1) {
            //Field labor rate 1,65
            $job_parm_data['1'] = str_replace(",", "", $data['field_labor_rate']);
            //Design labor rate 21,66
            $job_parm_data['21'] = str_replace(",", "", $data['design_labor_rate']);
            //Shop labor rate 2,64
            $job_parm_data['2'] = str_replace(",", "", $data['shop_labor_rate']);

            //Parts & Smarts
            if (isset($data['is_parts_smarts'])) {
                $job_parm_data['80'] = $data['is_parts_smarts'];
            }
        } else {
            //Field labor rate 1,65
            $job_parm_data['65'] = str_replace(",", "", $data['field_labor_rate']);
            //Design labor rate 21,66
            $job_parm_data['66'] = str_replace(",", "", $data['design_labor_rate']);
            //Shop labor rate 2,64
            $job_parm_data['64'] = str_replace(",", "", $data['shop_labor_rate']);
        }

        //Miles to job 31
        $job_parm_data['31'] = str_replace(",", "", $data['miles_to_job']);

        //Sprinkler Job
        if ($data['department_idn'] == 2) {
            //FM Job 69
            $job_parm_data['69'] = $data['is_fm_job'];
            //Underground 71
            $job_parm_data['71'] = $data['is_underground'];
            //Underground Options 72
            $job_parm_data['72'] = $data['underground_options'];
            //Grooved fitting 78
            //$job_parm_data['78'] = $data['grooved_fitting'];
            //Seamless 29
            $job_parm_data['29'] = $data['is_seamless_required'];

            //Overtime, Shift or Holiday work
            $job_parm_data['82'] = (isset($data['has_overtime'])) ? $data['has_overtime'] : "N";
        }

        if ($save_results['return_code'] == 1) {
            //If new job, set job_number
            if ($data['job_number'] == "0") {
                $data['job_number'] = $save_results['job_number'];

                //Get job keys
                $job_keys = get_job_keys($data['job_number']);

            } else { //Existing job number

                //Get job keys
                $job_keys = get_job_keys($data['job_number']);

                //If miles to job is updated to a new value, update all the miles fields on the job mob worksheet
                if ($job_parm_data['31'] != str_replace(",", "", $data['recentValues']['miles_to_job'])) {
                    //get Job Mob worksheet_idn
                    $job_mob_where = array(
                        "Job_Idn" => $job_keys[0],
                        "ChangeOrder" => $job_keys[1],
                        "WorksheetMaster_Idn" => 8
                    );
                    $worksheet_idn = $this->m_reference_table->get_field("Worksheets", "Worksheet_Idn", $job_mob_where);
                    //update job mob trip fields
                    $miles_fields = array("DES_EXP_VEH_MILES", "DES_WAG_MILES","F_TRK_EXP_OFF_MIL","F_WAG_MILES","DEL_EXP_STK_MIL","DEL_WAG_MILES");
                    $miles = $job_parm_data['31'] * 2;
                    $set = array();
            
                    foreach($miles_fields as $field) {
                        $field = strtolower($field);
                        $set[$field] = $miles; 
                    }
            
                    $where = array("Worksheet_Idn" => $worksheet_idn);
            
                    $this->m_reference_table->update("JobMobWorksheets", $set, $where);
                }
            }
    
            
            //Save JobParmDetails records
            foreach ($job_parm_data as $parm_id => $value) {
                $field_name = (is_numeric($value)) ? "NumericValue" : "AlphaValue";
                
                $update = array($field_name => $value);
                
                $save_results['job_parm_detail'][$parm_id] = $this->m_job_parm_detail->save($data['job_number'], $parm_id, $update);
            }
            
            //Delete and insert JobSystemTypes
            if ($this->m_job_system_type->delete_by_job_number($data['job_number'])) {
                //Insert System Types
                if (!empty($data['system_types'])) {
                    foreach ($data['system_types'] as $value) {
                        $system_types = array(
                            'Job_Idn' => $job_keys[0],
                            'ChangeOrder' => $job_keys[1],
                            'SystemType_Idn' => $value,
                            'IsSubType' => 0,
                            'Value' => 1
                        );
                        
                        $save_results['job_system_types'][$value] = $this->m_job_system_type->insert_row($system_types);
                    }
                }
                
                //Insert System Sub Types
                if (!empty($data['system_sub_types'])) {
                    foreach ($data['system_sub_types'] as $value) {
                        $system_sub_types = array(
                            'Job_Idn' => $job_keys[0],
                            'ChangeOrder' => $job_keys[1],
                            'SystemType_Idn' => $value,
                            'IsSubType' => 1,
                            'Value' => 1
                        );
                        
                        $save_results['job_system_sub_types'][$value] = $this->m_job_system_type->insert_row($system_sub_types);
                    }
                }
            }
            
            //Initialize $data['prepared_bys'] if empty
            if (!isset($data['prepared_bys'])) {
                $data['prepared_bys'] = array();
            }
            
            //Save Job Prepared Bys
            $save_results['job_prepared_bys'] = $this->m_job_prepared_by->save_prepared_bys($data['job_number'], $data['prepared_bys']);
        } //END: if ($save_results['return_code'] == 1
        
        
        //Add button_clicked to save results array
        $save_results['button_clicked'] = $data['button_clicked'];
        
        //Return -1 if any errors
        $save_results['return_code'] = (in_array_recursive(false, $save_results, true)) ? "-1" : "1";
        
        echo json_encode($save_results);
    }
    
    /*
     * create
     *
     * Create job. If department is known, simply display job information view
     * If deparment is not known, user must select department
     *
     * @param	$department_idn(integer)
     */
    public function create_job($department_idn = 0)
    {
        //Delcare and initialize variables
        $data = array(
            'choose_department' => 0,
            'menus' => array(),
            'active_page' => 'Create Job',
            'bread_crumbs' => array(
                array(
                    'name' => 'Create Job',
                    'link' => ''
                )
            )
        );
        
        //Load menus
        $data['menus'] = $this->m_menu->get_menus();
        
        //If user has permission to both modules, user must choose which type of job to create
        if ($this->session->userdata('department_idn') == 3 && $department_idn == 0) {
            $data['choose_department'] = 1;
            
            $this->load->view('job/create', $data);
        } else {
            if ($department_idn == 0) {
                //if department_idn is 0, load department from session data
                $department_idn = $this->session->userdata('department_idn');
            }
            
            //Call job/information
            $this->information("0", $department_idn);
        }
    }
    
    /*
     * recap
     *
     * Display recap page
     *
     * @param	$job_number(string)
     * @return	Recap view
     */
    public function recap($job_number = '0')
    {
        //Delcare and initialize variables
        $data = array(
            'menus' => array(),
            'active_page' => 'Job Recap',
            'bread_crumbs' => array(
                array(
                    'name' => 'Job Information',
                    'link' => 'job/information/'.$job_number
                ),
                array(
                    'name' => 'Job Recap',
                    'link' => ''
                )
            ),
            'job' => array(),
            'worksheet' => array(),
            'recap_rows' => array()
        );
        $recap_rows = array();
        $Job = null; //Job object
        $value_classes = array(
            1 => 'bonded',
            2 => 'high_sub',
            3 => 'low_sub',
            4 => 'material',
            5 => 'labor',
            6 => 'hours'
        );
        $job_keys = array();
        
        //Load models
        $this->load->model('m_recap_row');
        
        //***************** Get Data for Recap ****************************//
        
        //Load job data
        if ($job_number != '0' && !empty($job_number)) {
            //Load menus
            $data['menus'] = $this->m_menu->get_menus($job_number);
            $job_keys = get_job_keys($job_number);

            if ($this->m_job->is_parent($job_number)) {
                //Instantiate ParentJob
                $this->load->library('j');
                $this->load->library('parentjob', array('job_number' => $job_number));
                $Job = $this->parentjob;

                $Job->load_recap_rows();
            } else {
                //Instantiate Job
                $this->load->library('j', array('job_number' => $job_number));
                $Job = $this->j;

                $Job->load_recap_rows();
            }
            
            $data['job'] = $Job->job;
            $data['job']['job_parms'] = $Job->job_parms;
            $data['job']['job_defaults'] = $Job->job_defaults;
            $data['job']['field_hours'] = $Job->field_hours;
            $data['job']['shop_hours'] = $Job->shop_hours;
            $data['job']['engineer_hours'] = $Job->engineer_hours;
            
            //Parent, child or neither
            $data['job']['classification'] = "";
            if ($data['job']['is_parent'] == 1) {
                $data['job']['classification'] = "Parent";
            } elseif ($data['job']['parent_idn'] > 0) {
                $data['job']['classification'] = "Child";
            } else {
                $data['job']['classification'] = "Job";
            }
        } else {
            //Load menus
            $data['menus'] = $this->m_menu->get_menus();
        }
        
        //Parse recap rows for view
        $recap_rows = $this->m_recap_row->get_by_department_idn($data['job']['department_idn']);
        
        $rr_index = 0;
        $class = "";
        $contents = "";
        $first_cell_contents = "";
        $rr_name = "";
        $mains_lines_flag = 0;

        $data['job']['jm_shop_hours'] = 0;
        $data['job']['jm_field_hours'] = 0;

        foreach ($recap_rows as $recap_row) {
            $recap_row_idn = $recap_row['RecapRow_Idn'];
            if ($recap_row_idn == 1 && $Job->job_parms[71]['AlphaValue'] == "N") {
                //Skip Underground//
            } else {
                //set RecapRow_Idn
                $worksheet_idn = 0;
                $additional_worksheet_idn = 0;
                $additional_first_cell_content = "";
                $new_worksheet_query_string = "";
                $worksheet_master_idn = 0;
                $additional_worksheet_master_idn = 0;
            
                $worksheet_idn = $Job->RRs[$recap_row_idn]->worksheet_idn;
                $additional_worksheet_idn = $Job->RRs[$recap_row_idn]->addtional_worksheet_idn;
                //$additional_first_cell_content = $j->RRs[$recap_row_idn]->additional_name;

                //Load Recap Row first cell
                $rr_name = $Job->RRs[$recap_row['RecapRow_Idn']]->name;
            
                //Load content for first cell
                if ($Job->RRs[$recap_row_idn]->recap_row['IsWorksheetFlag'] == 1 && $Job->job['is_parent'] == 0) {
                    $worksheet_master_idn = $Job->RRs[$recap_row_idn]->recap_row_worksheet_masters[0]['WorksheetMaster_Idn'];

                    //Set flag if cross mains and lines recap worksheet exists
                    if ($worksheet_master_idn == 32 && $worksheet_idn > 0) {
                        $mains_lines_flag = 1;
                    }

                    //If Cross Mains and Lines Recap doesn't exist and engineering worksheet doesn't exit, don't allow user to create engineering worksheet
                    if ($worksheet_master_idn == 22 && $mains_lines_flag == 0 && $worksheet_idn == 0) {
                        $first_cell_contents = $rr_name;
                    } else {
                        $new_worksheet_query_string = ($worksheet_idn == 0) ? "/?j=".$job_number."&wm=".$worksheet_master_idn : "";
                        $first_cell_contents = '<a href="'.base_url().'job/worksheet/'.$worksheet_idn.$new_worksheet_query_string.'">'.$rr_name.'</a>';
                    }
                } else {
                    $first_cell_contents = $rr_name;
                }
            
                //Create link for additional_name
                if (!empty($Job->RRs[$recap_row_idn]->additional_name)) {
                    $additional_worksheet_master_idn = $Job->RRs[$recap_row_idn]->recap_row_worksheet_masters[1]['WorksheetMaster_Idn'];
                    $new_worksheet_query_string = ($additional_worksheet_idn == 0) ? "/?j=".$job_number."&wm=".$additional_worksheet_master_idn : "";
                    $additional_first_cell_content = '<a href="'.base_url().'job/worksheet/'.$additional_worksheet_idn.$new_worksheet_query_string.'">'.$j->RRs[$recap_row_idn]->additional_name.'</a>';
                }
            
                $data['recap_rows'][$rr_index][0] = array('contents' => $first_cell_contents, 'class' => '', 'additional_first_cell_content' => $additional_first_cell_content);
            
                //Get Job Mob labor hours
                if ($recap_row_idn == 8 || $recap_row_idn == 32) {
                    $data['job']['jm_shop_hours'] = ceil($Job->RRs[$recap_row_idn]->shop_hours);
                    $data['job']['jm_field_hours'] = ceil($Job->RRs[$recap_row_idn]->field_hours);
                }
                
                //Set recap cell content and class
                foreach ($Job->RRs[$recap_row_idn]->recap_cells as $rc_index => $recap_cell) {
                    //Disable row and empty contents of cell is disabled
                    if ($recap_cell === false) {
                        $contents = "";
                        $class = "rowdisabled";
                    } else {
                        $class = "";
                        //Load contents of cell
                        if ($rc_index == 6) { //Hours
                            $contents = '&lt;<span class="'.$value_classes[$rc_index].' recap_cell_'.$rc_index.'">'.number_format($recap_cell, 0).'</span>&gt;';
                        
                            //Load Job Mob Shop hours
                            if ($recap_row['RecapRow_Idn'] == 8 || $recap_row['RecapRow_Idn'] == 32) {
                                $contents = '<div class="to-left" style="position:absolute;"><strong>E</strong></div><div class="text-center">'.$contents.'</div>';
                            }
                        } else {
                            $contents = '$<span class="'.$value_classes[$rc_index].' recap_cell_'.$rc_index.'">'.number_format($recap_cell, 0).'</span>';
                        }
                    }
                
                    $data['recap_rows'][$rr_index][$rc_index] = array('contents' => $contents, 'class' => $class);
                
                }
            
                //Increment index for recap row
                $rr_index++;
            }
        }

		$summary_data = array(
			"total_sqft" => $Job->total_sqft,
			"total_heads" => $Job->total_heads,
			"is_parent" => $Job->job['is_parent']
		);

		$data['recap_summary'] = $this->load->view('job/recap_summary', $summary_data, true);
        $this->load->view('job/recap', $data);
    }

    /*
     * get_job_defaults
     *
     * Gets job defaults primarily from JobParms table
     *
     * @param	$department_idn(integer)
     * @return	$job(array)
     */
    
    public function get_job_defaults($department_idn)
    {
        //Delcare and initialize variables
        $job = array();
        $job_parms = array();
        $job_defaults = array();
        
        //Load models
        $this->load->model('m_job_default');
        $this->load->model('m_department');
        
        //Load job defaults into job_defaults array
        $job_defaults = $this->m_job_default->get_values_by_type(array(3,4));
        
        //Load fields
        $job = array(
            'read_only' => 0,
            'new_change_order' => 0,
            'department_idn' => $department_idn,
            'department_name' => $this->m_department->get_department_name($department_idn),
            'is_parent' => 0,
            'job_number' => '0',
            'created_by_idn' => $this->session->userdata('user_idn'),
            'created_by_name'=> $this->session->userdata('first_name'),
            'created_date' => format_date(),
            'prepared_bys' => array(),
            'prepared_by_names' => "",
            'name' => '',
            'contractor' => '',
            'status_idn' => 1,
            'is_joint_job' => (empty($job_defaults[27]['AlphaValue']) || $job_defaults[27]['AlphaValue'] == "Y") ? "Y" : "N",
            'is_underground' => (empty($job_defaults[71]['AlphaValue']) || $job_defaults[71]['AlphaValue'] == "Y") ? "Y" : "N",
            'underground_options' => (empty($job_defaults[72]['AlphaValue']) || $job_defaults[72]['AlphaValue'] == "Y") ? "Y" : "N",
            'system_types' => array(),
            'system_sub_types' => array(),
            //'grooved_fitting' => number_format($job_defaults[78]['NumericValue'],0),
            'is_domestic_required' => (empty($job_defaults[28]['AlphaValue']) || $job_defaults[28]['AlphaValue'] == "Y") ? "Y" : "N",
            'domestic_options' => (empty($job_defaults[42]['AlphaValue']) || $job_defaults[42]['AlphaValue'] == "Y") ? "Y" : "N",
            'is_seamless_required' => (empty($job_defaults[29]['AlphaValue']) || $job_defaults[29]['AlphaValue'] == "Y") ? "Y" : "N",
            'is_fm_job' => (empty($job_defaults[69]['AlphaValue']) || $job_defaults[69]['AlphaValue'] == "Y") ? "Y" : "N",
            'is_davis_bacon_job' => (empty($job_defaults[30]['AlphaValue']) || $job_defaults[30]['AlphaValue'] == "Y") ? "Y" : "N",
            'davis_bacon_pac' => number_format($job_defaults[20]['NumericValue'] * 100, 1),
            'field_labor_rate' => 0,
            'design_labor_rate' => 0,
            'shop_labor_rate' => 0,
            'miles_to_job' => $job_defaults[31]['NumericValue'],
            'job_parms' => $job_parms,
            'job_defaults' => $job_defaults,
            'is_shareable' => 0,
            'is_parts_smarts' => (empty($job_defaults[80]['AlphaValue']) || $job_defaults[80]['AlphaValue'] == "N") ? "N" : "Y",
            'parts_smarts_field_labor_rate' => $job_defaults[80]['NumericValue'],
            'estimate_type_idn' => 0,
            'job_type_idn' => ($department_idn == 1) ? 1 : 0, //default to Fire Alarm for Electronic Division jobs
        );
        
        //Load labor rates
        if ($department_idn == 1) {
            $job['field_labor_rate'] = $job_defaults[1]['NumericValue'];
            $job['shop_labor_rate'] = $job_defaults[2]['NumericValue'];
            $job['design_labor_rate'] = $job_defaults[21]['NumericValue'];
        } else {
            $job['field_labor_rate'] = $job_defaults[65]['NumericValue'];
            $job['shop_labor_rate'] = $job_defaults[64]['NumericValue'];
            $job['design_labor_rate'] = $job_defaults[66]['NumericValue'];
        }
        
        return $job;
    }

    /*
     * get_job
     *
     * Gets job information primarily from Jobs and JobParms tables
     *
     * @param	$job_number(string)
     * @return	$job(array)
     */
    
    public function get_job($job_number)
    {
        //Delcare and initialize variables
        $job_data = array();
        $job_parms = array();
        $job_defaults = array();
        $job = array();
        
        //Load job
        $job = $this->m_job->get_by_job_number($job_number);
        
        if (!empty($job)) {
            //Load models
            $this->load->model('m_department');
            $this->load->model('m_job_prepared_by');
            $this->load->model('m_job_parm_detail');
            $this->load->model('m_job_system_type');
            $this->load->model('m_job_default');
            $this->load->model('m_user');
            
            //Load job parm details into job_parms array
            $job_parms = $this->m_job_parm_detail->get_job_parms($job_number);
            
            //Load job defaults into job_defaults array
            $job_defaults = $this->m_job_default->get_values_by_type(array(3,4));
            
            //Load fields
            $job_data = array(
                'read_only' => 0,
                'new_change_order' => 0,
                'department_idn' => $job['Department_Idn'],
                'department_name' => $this->m_department->get_department_name($job['Department_Idn']),
                'is_parent' => $job['IsParent'],
                'is_shareable' => $job['IsShareable'],
                'job_number' => $job_number,
                'created_by_idn' => $job['CreatedBy_Idn'],
                'created_by_name' => $this->m_user->get_first_name_by_idn($job['CreatedBy_Idn']),
                'created_date' => format_date($job['CreateDateTime']),
                'prepared_bys' => $this->m_job_prepared_by->get_prepared_bys($job_number),
                'prepared_by_names' => $this->m_job_prepared_by->get_prepared_by_names($job_number),
                'name' => $job['Name'],
                'contractor' => $job['Contractor'],
                'status_idn' => $job['JobStatus_Idn'],
                'is_joint_job' => (empty($job_parms[27]['AlphaValue']) || $job_parms[27]['AlphaValue'] == "Y") ? "Y" : "N",
                'is_underground' => (empty($job_parms[71]['AlphaValue']) || $job_parms[71]['AlphaValue'] == "Y") ? "Y" : "N",
                'underground_options' => (empty($job_parms[72]['AlphaValue']) || $job_parms[72]['AlphaValue'] == "Y") ? "Y" : "N",
                'system_types' => $this->m_job_system_type->get_job_system_types($job_number),
                'system_sub_types' => $this->m_job_system_type->get_job_system_types($job_number, 1),
                'grooved_fitting' => (isset($job_parms[78])) ? number_format($job_parms[78]['NumericValue'], 0) : 0,
                'is_domestic_required' => (empty($job_parms[28]['AlphaValue']) || $job_parms[28]['AlphaValue'] == "Y") ? "Y" : "N",
                'domestic_options' => (empty($job_parms[42]['AlphaValue']) || $job_parms[42]['AlphaValue'] == "Y") ? "Y" : "N",
                'is_seamless_required' => (empty($job_parms[29]['AlphaValue']) || $job_parms[29]['AlphaValue'] == "Y") ? "Y" : "N",
                'is_fm_job' => (empty($job_parms[69]['AlphaValue']) || $job_parms[69]['AlphaValue'] == "Y") ? "Y" : "N",
                'is_davis_bacon_job' => (empty($job_parms[30]['AlphaValue']) || $job_parms[30]['AlphaValue'] == "Y") ? "Y" : "N",
                'davis_bacon_pac' => number_format($job_parms[20]['NumericValue'] * 100, 1),
                'miles_to_job' => $job_parms[31]['NumericValue'],
                'job_parms' => $job_parms,
                'job_defaults' => $job_defaults,
                'is_parts_smarts' => (empty($job_parms[80]['AlphaValue']) || $job_parms[80]['AlphaValue'] == "N") ? "N" : "Y",
                'parts_smarts_field_labor_rate' => $job_parms[80]['NumericValue'],
                'estimate_type_idn' => $job['EstimateType_Idn'],
                'has_overtime' => (empty($job_parms[82]['AlphaValue']) || $job_parms[82]['AlphaValue'] == "Y") ? "Y" : "N",
                'job_type_idn' => $job['JobType_Idn'],
            );
            
            //Load labor rates
            if ($job['Department_Idn'] == 1) {
                $job_data['field_labor_rate'] = $job_parms[1]['NumericValue'];
                $job_data['shop_labor_rate'] = $job_parms[2]['NumericValue'];
                $job_data['design_labor_rate'] = $job_parms[21]['NumericValue'];
            } else {
                $job_data['field_labor_rate'] = $job_parms[65]['NumericValue'];
                $job_data['shop_labor_rate'] = $job_parms[64]['NumericValue'];
                $job_data['design_labor_rate'] = $job_parms[66]['NumericValue'];
            }
        }
        return $job_data;
    }
    
    /**
     * worksheet
     *
     * Display worksheet by Worksheet_Idn
     *
     * @access  public
     * @param   $w_id(integer)
     * @return  void
     */
    
    public function worksheet($w_id = "")
    {
        //Delcare and initialize variables
        $job_number = "";
        $data = array(
            'active_page' => '',
            'bread_crumbs' => array(),
            'job' => array(
                'job_parms' => array(),
                'job_defaults' => array(),
                'field_hours' => array(),
                'shop_hours' => array(),
                'engineering_hours' => array()
                ),
            'menus' => array(),
            'miscellaneous_products' => array(),
            'products' => array(),
            'worksheet' => array(),
            'worksheet_master' => array(),
            'worksheet_master_parameters' => array(),
            'manufacturers' => array()
        );
        $worksheet_master_idn = 0;
        $get = array();
        $job_number = "";
        
        //Check to see if w_id is valid
        if (check_idn($w_id)) {
            if (empty($w_id)) {
                $get = $this->input->get();
                
                //Check query string
                if (!empty($get)) {
                    //Load worksheet library
                    $this->load->library("worksheet");

                    //Set job number and worksheet master from GET variables
                    $job_number = $get['j'];
                    $worksheet_master_idn = $get['wm'];
                    
                    //Create worksheet
                    $w_id = $this->worksheet->create_worksheet($job_number, $worksheet_master_idn);

                    redirect('job/worksheet/'.$w_id);
                }
            }

            //Get worksheet
            //$w = new Worksheet();
            //$w->get_worksheet($w_id);
            $this->load->library('worksheet', array('w_id' => $w_id));
            $w = $this->worksheet;

            if (!empty($w->w)) {
                $data['active_page'] = $w->wm['Name'];

                $data['worksheet'] = $w->w;

                $data['worksheet_master'] = $w->wm;

                $worksheet_master_idn = $w->wm['WorksheetMaster_Idn'];

                $job_number = format_job_number($w->_job_keys[0], $w->_job_keys[1]);

                //Products
                $data['products'] = $w->get_products($w_id);

                //Child worksheet details
                $data['child_worksheet_details'] = $w->get_child_worksheet_details($worksheet_master_idn, $job_number, $w_id);

                //Miscellaneous products
                $data['miscellaneous_products'] = $w->get_miscellaneous_products($w_id);

                if ($w->wm['DisplayWorksheetHeader'] == 1) {
                    //Load worksheet paramaters data
                    $data['worksheet_master_parameters'] = $w->get_worksheet_master_parameters($worksheet_master_idn, $w->wm['Department_Idn']);
                }

                if ($w->wm['DisplayManhourAdjustment'] == 1) {
                    $data['VolumeCorrections'] = $this->m_reference_table->get_where("VolumeCorrections", "ActiveFlag = 1", "Rank ASC");
                }

                if ($w->wm['WorksheetMaster_Idn'] == 9) {
                    $data['ShopFabrications'] = $this->m_reference_table->get_where("ShopFabrications", "ActiveFlag = 1", "Rank ASC");
                    $data['ShopFabricationMultipliers'] = $this->m_worksheet->get_shop_fabrication_multipliers();
                }

                //Get manufacturers
                $data['manufacturers'] = $this->m_reference_table->get_where("Manufacturers", "ActiveFlag = 1", "Name ASC");

                //Load job data
                if ($job_number != '0' && !empty($job_number)) {
                    //Instantiate Job
                    //$j = new J(array('job_number' => $job_number));
                    $this->load->library('j', array('job_number' => $job_number));
                    $j = $this->j;

                    $j->load_recap_rows(); //This takes forever!!! I need to refactor

                    $data['job'] = $j->job;
                    $data['job']['job_parms'] = $j->job_parms;
                    $data['job']['job_defaults'] = $j->job_defaults;
                    $data['job']['field_hours'] = $j->field_hours;
                    $data['job']['shop_hours'] = $j->shop_hours;
                    $data['job']['engineer_hours'] = $j->engineer_hours;
                }

                //Load Total Panels and Power Supplies and total devices for Conduit and Wire worksheet
                $data['total_panels'] = 0;
                $data['total_devices'] = 0;
                if ($w->w['WorksheetMaster_Idn'] == 2) {
                    $data['total_panels'] = $this->get_sum_quantity_by_worksheet_category_idns($job_number, array(3,10));
                    $data['total_devices'] = $this->get_sum_quantity_by_worksheet_category_idns($job_number, array(4,5,7,41));
                }

                //Breadcrumbs
                $data['bread_crumbs'] = array(
                    array(
                            'name' => 'Job Information',
                            'link' => 'job/information/'.$job_number
                    ),
                    array(
                            'name' => 'Job Recap',
                            'link' => 'job/recap/'.$job_number
                    ),
                    array(
                            'name' => $w->wm['Name'],
                            'link' => ''
                    )
                );
            } else {
                $data['message'] = "Worksheet ".$w_id." does not exist!";
                $data['active_page'] = "Worksheet";
            }
        } else {
            $data['message'] = "Worksheet is not valid!";
            $data['active_page'] = "Worksheet";
        }

        //Load menus
        $data['menus'] = $this->m_menu->get_menus($job_number);

        $this->load->view('job/worksheet', $data);
    }

    /**
     * save_worksheet
     *
     * save worksheet
     *
     * @access  public
     * @param   $get(array)
     * @return  void
     */

    public function save_worksheet($data = array())
    {
        //Delcare and initialize variables
        $worksheet_data = array();
        $results = array(
                'return_code' => 0,
                'message' => ''
        );
        $table = "";
        $set = array();
        $where = array();
        $errors = 0;
        $data = $this->input->post();
        $job_keys = array();

        //Load models
        $this->load->model('m_worksheet');

        if (isset($data['Worksheet_Idn']) && $data['Worksheet_Idn'] > 0) {
            //Check to see if worksheet exists
            $worksheet_data = $this->m_worksheet->get_worksheet_by_idn($data['Worksheet_Idn']);
            $job_keys = get_job_keys($data['JobNumber']);

            //Worksheet exists, save the data
            if (!empty($worksheet_data)) {
                //Check to see if Engineering worksheet
                if ($worksheet_data['WorksheetMaster_Idn'] == 22) {
                    //Load worksheet library
                    $this->load->library("worksheet");

                    $errors = $this->worksheet->save_engineering_worksheet($data);
                } elseif ($worksheet_data['WorksheetMaster_Idn'] == 8) { //Jobmob
                    //Load worksheet library
                    $this->load->library("worksheet");

                    $errors = $this->worksheet->save_jobmob_worksheet($data);
                } else {
                    ////////////////////////////////////////
                    //Save Rows
                    ////////////////////////////////////////
                    if (isset($data['Id'])) {
                        //Iterate through records
                        foreach ($data['Id'] as $i => $id) {
                            //Initialize and set common key/value pairs for update
                            $row_type = $data['RowType'][$i];
                            $index = $data['RowType'][$i]."_".$id;
                            //Where
                            $where = array(
                                    'Worksheet_Idn' => $data['Worksheet_Idn'],
                            );

                            /////////////////////////////////
                            //Build SET statement
                            /////////////////////////////////
                            //Quantity, MaterialUnitPrice and WorksheetColumn_Idn
                            $worksheet_column_idn = (isset($data['Sub'.$index])) ? $data['Sub'.$index] : 0;
                            $quantity = (isset($data['Qty'][$index])) ? string_filter($data['Qty'][$index], ",") : 0;
                            $material_unit_price = (isset($data['MaterialUnitPrice'][$index])) ? string_filter($data['MaterialUnitPrice'][$index], ",") : 0;
                            $set = array(
                                    'Quantity' => $quantity,
                                    'MaterialUnitPrice' => $material_unit_price,
                                    'WorksheetColumn_Idn' => $worksheet_column_idn
                            );

                            //Field Unit Price
                            if (isset($data['FieldUnitPrice'][$index])) {
                                $set['FieldUnitPrice'] = string_filter($data['FieldUnitPrice'][$index], ",");
                            }

                            //Shop Unit Price
                            if (isset($data['ShopUnitPrice'][$index])) {
                                $set['ShopUnitPrice'] = string_filter($data['ShopUnitPrice'][$index], ",");
                            }

                            //Engineer Unit Price
                            if (isset($data['EngineerUnitPrice'][$index])) {
                                $set['EngineerUnitPrice'] = string_filter($data['EngineerUnitPrice'][$index], ",");
                            }

                            switch ($row_type) {
                                case "Product":
                                        //Table name
                                        $table = "WorksheetDetails";

                                        //Where
                                        $where['Product_Idn'] = $id;
                                        break;
                                case "Worksheet":
                                        //Worksheet
                                        $table = "Worksheets";

                                        $set = array('Quantity' => string_filter($quantity, ","));

                                        //Head type
                                        if (isset($data['HeadType'][$index])) {
                                            $set['HeadType_Idn'] = $data['HeadType'][$index];
                                        }

                                        //Coverage type
                                        if (isset($data['CoverageType'][$index])) {
                                            $set['CoverageType_Idn'] = $data['CoverageType'][$index];
                                        }

                                        $where = array('Worksheet_Idn' => $id);
                                        break;
                                case "Miscellaneous":
                                        //Miscellaneous
                                        $table = "MiscellaneousDetails";

                                        //Set
                                        $set['MaterialMarkUp'] = (isset($data['BondedMarkup'.$index])) ? $data['BondedMarkup'.$index] / 100 : 0;

                                        if (isset($data['Name'][$index])) {
                                            $set['Name'] = $data['Name'][$index];
                                        }

                                        //Where
                                        $where['MiscellaneousDetail_Idn'] = $id;
                                        break;
                            }

                            //Save worksheet detail
                            if ($this->m_reference_table->update($table, $set, $where) == false) {
                                $errors++;
                            }
                        } //END: foreach
                    }
                } //END: if engineering worksheet

                //Pipe Exposures
                if (isset($data['PipeExposure'])) {
                    $this->load->library("worksheet");
                    $this->worksheet->save_worksheet_parm($data['Worksheet_Idn'], $data['PipeExposure'], "PipeExposure");
                }

                $adjustment_factors = array();
                if (isset($data['AdjustmentFactor'])) {
                    //Load worksheetmaster_idn into data array
                    $data['WorksheetMaster_Idn'] = $worksheet_data['WorksheetMaster_Idn'];
                    $adjustment_factors = $this->_save_adjustment_factors($data);
                }

                //Save SH Engineering worksheet data on save from Panels and Devices
                if ($worksheet_data['WorksheetMaster_Idn'] == 1) {
                    $this->load->library("worksheet");

                    $eng_where = array(
                    "Job_Idn" => $job_keys[0],
                    "ChangeOrder" => $job_keys[1],
                    "WorksheetMaster_Idn" => 7
                );
                    $eng_worksheet_idn = $this->m_reference_table->get_field("Worksheets", "Worksheet_Idn", $eng_where);
                    //Only if engineering worksheet already exists
                    if (!empty($eng_worksheet_idn)) {
                        $this->worksheet->save_sh_engineering_defaults($eng_worksheet_idn, $data['JobNumber']);
                    }
                }

                ////////////////////////////////////
                //SAVE WORKSHEET
                ////////////////////////////////////

                //Where
                $where = array(
                    'Worksheet_Idn' => $data['Worksheet_Idn']
                    );

                //Set
                $set = array();

                //Worksheet Name
                if (isset($data['WorksheetName'])) {
                    $set['Name'] = $data['WorksheetName'];
                }

                //NoFinishWork Flag
                $set['NoFinishWorkFlag'] = (isset($data['NoFinishWork'])) ? $data['NoFinishWork'] : 0;

                //Set Field Overrides
                if (isset($data['OverrideFieldHours'])) {
                    $set['OverrideFieldHours'] = 1;
                    $set['UserFieldHours'] = string_filter($data['UserFieldHours'], ",");
                } else {
                    $set['OverrideFieldHours'] = 0;
                    $set['UserFieldHours'] = 0;
                }

                //Manhour Adjustment (Volume Hours)
                $set['OverrideVolumeCorrection'] = (isset($data['OverrideDefaultManhourAdjustment'])) ? 1 : 0;
                $set['VolumeCorrection_Idn'] = (isset($data['VolumeAdjustment'])) ? $data['VolumeAdjustment'] : 0;

                //Shop hours
                $set['OverrideShopHours'] = (isset($data['OverrideShopHours'])) ? 1 : 0;
                $set['UserShopHours'] = (isset($data['UserShopHours'])) ? string_filter($data['UserShopHours'], ",") : 0;

                //Engineering hours
                $set['OverrideEngineerHours'] = (isset($data['OverrideEngineerHours'])) ? 1 : 0;
                $set['UserEngineerHours'] = (isset($data['UserEngineerHours'])) ? string_filter($data['UserEngineerHours'], ",") : 0;

                //Shop Fabrication
                $set['ShopFabrication_Idn'] = (isset($data['ShopFabrication'])) ? $data['ShopFabrication'] : 0;
                $set['ShopFabricationMultiplier_Idn'] = (isset($data['ShopFabricationMultiplier'])) ? $data['ShopFabricationMultiplier'] : 0;

                //Manufacturer
                if (isset($data['Manufacturer'])) {
                    $set['Manufacturer_Idn'] = $data['Manufacturer'];
                }

                //Save Worksheets table
                if ($this->m_reference_table->update("Worksheets", $set, $where) == false) {
                    $errors++;
                }

                //When the branch line worksheet is saved, make sure Labor class on Engineering Basic Appropriation matches labor class on branch line
                //if ($worksheet_data['WorksheetMaster_Idn'] == 9)
                //{
                //    if ($this->worksheet->update_eng_labor_class($data['JobNumber'], $data['Worksheet_Idn'], $data['PipeExposure']) == false)
                //    {
                //        $errors++;
                //    }
                //}

                //Set results array based on update results
                if ($errors == 0) {
                    $results['return_code'] = 1;
                    $results['message'] = "Worksheet saved!";
                    $results['adjustment_factors'] = $adjustment_factors;
                } else {
                    $results['return_code'] = 3;
                    $results['message'] = "Error saving worksheet!";
                }

                //Job Update Date
                job_update($data['JobNumber']);
            } else {
                $results['return_code'] = 3;
                $results['message'] = "Worksheet doesn't exist!";
            }
        } else {
            $results['return_code'] = 3;
            $results['message'] = "Not a valid worksheet!";
        }

        echo json_encode($results);
    }

    /**
     * create_change_order
     *
     * Parse job number for creation of new change order.
     *
     * @access  public
     * @param   string(job_number)
     * @return  void
     */

    public function create_change_order($job_number)
    {
        //Declare and Initialize variables
        $job_keys = array();
        $job_idn = 0;
        
        //Get job keys so I can get job_idn
        $job_keys = get_job_keys($job_number);
        
        //Set job_idn
        $job_idn = $job_keys[0];
        
        //Re-format job_number with *
        $job_number = format_job_number($job_idn, "*");
        
        //Call job/information
        $this->information($job_number);
    }
    
    /**
     * view_child_jobs
     *
     * Get child jobs of a parent job
     *
     * @access  public
     * @param   string(parent_idn)
     * @return  string(html)
     */
    
    public function get_child_jobs($parent_job_number)
    {
        //Delcare and initialize variables
        $data = array(
            "child_jobs" => array(),
            "session_data" => array()
        );
        
        //Load session data
        $data['session_data'] = $this->session->all_userdata();

        $parent_job_keys = get_job_keys($parent_job_number);

        //Get parent object
        //$parent = new ParentJob(array('job_number' => $parent_idn));
        $this->load->library('j');
        $this->load->library('ParentJob', array('job_number' => $parent_job_number));
        $parent = $this->parentjob;
        
        //get child jobs
        //$parent->get_children($parent_job_keys[0]);
        
        $data['child_jobs'] = $parent->children;
        
        //Load view
        $this->load->view('job/modals/get_child_jobs', $data, false);
    }
    
    /**
     * add_parent
     *
     * Returns html for bootstrap dialog to see all parent jobs
     *
     * @access  public
     * @param   string(job_number)
     * @return  string(html)
     */
    
    public function get_parents($job_number, $department_idn)
    {
        //Delcare and initialize variables
        $data = array(
            "parent_jobs" => array(),
            "session_data" => array()
        );
        $parents = array();
        $parent_job_number = "";
        
        //Load session data
        $data['session_data'] = $this->session->all_userdata();

        //get parent jobs
        $parents = $this->m_job->get_jobs(" AND IsParent = 1 AND j.Department_Idn = {$department_idn}");

        foreach ($parents as $parent) {
            $parent_job_number = format_job_number($parent['Job_Idn'], $parent['ChangeOrder']);

            //$data['parent_jobs'][] = new J(array('job_number' => $parent_job_number));
            $parent_instance = "parent".$parent_job_number;
            $this->load->library('j', array('job_number' => $parent_job_number), $parent_instance);
            $data['parent_jobs'][] = $this->$parent_instance;
        }
        
        $this->load->view('job/modals/add_parent', $data, false);
    }
    
    /*
     * delete
     *
     * Delete job by setting ActiveFlag = 0
     *
     * @param	$ajax(int) if not = 0, the call is an ajax call and will return JSON
     * @param 	$job_numbers(array) array of job numbers
     * @return 	$restults(array)
     */
    
    public function remove_parent($ajax = 0, $job_numbers = array())
    {
        //Declare and initialize variables
        $results = array(
            'return_code' => 0,
            'num_jobs_removed' => 0,
            'job_numbers_removed' => array()
        );
        $set = array();
        $job_keys = array();
        
        //If post call, load into $job_numbers array
        if (empty($job_numbers) && isset($_POST['remove_child_job'])) {
            $job_numbers = $_POST['remove_child_job'];
        }
        
        if (!empty($job_numbers)) {
            //Load array to set Parent_Idn = 0
            $set = array(
                "Parent_Idn" => 0,
                "UpdateDateTime" => format_date("", 1),
                "LastUpdatedBy_Idn" => $this->session->userdata("user_idn")
            );
            
            //Loop through jobs and set ActiveFlag = 0
            foreach ($job_numbers as $job_number) {
                if ($this->m_job->save($job_number, $set)) {
                    $results['num_jobs_removed']++;
                    $results['job_numbers_removed'][] = $job_number;
                    write_feci_log('Job '.$job_number.' parent removed.');
                } else {
                    $results['return_code'] = -1;
                    write_feci_log('Error removing job '.$job_number.'.');
                }
            }
            
            if ($results['return_code'] == 0) {
                $results['return_code'] = 1;
            }
        }

        if ($ajax == 0) {
            return $results;
        } else {
            echo json_encode($results);
        }
    }
    
    /*
     * add_parent
     *
     * Add parent to child job
     *
     * @access  public
     * @param	$ajax(int) if not = 0, the call is an ajax call and will return JSON
     * @param 	$parent_job_number(string) parent job number
     * @param 	$child_job_number(string) child job number
     * @return 	array
     */
    
    public function add_parent($ajax = 0, $parent_job_number, $child_job_number)
    {
        //Declare and initialize variables
        $results = array(
            'return_code' => 0,
        );
        $set = array();
       
        if (!empty($parent_job_number) && !empty($child_job_number)) {
            $set = array(
                "Parent_Idn" => $parent_job_number,
                "UpdateDateTime" => format_date("", 1),
                "LastUpdatedBy_Idn" => $this->session->userdata("user_idn")
            );
            
            $results = $this->m_job->save($child_job_number, $set);
        }

        if ($ajax == 0) {
            return $results;
        } else {
            echo json_encode($results);
        }
    }
    
    /*
     * save_recap
     *
     * Function contains all the logic to save a job recap.
     *
     * @param	$data(array)
     */
    public function save_recap($get=array())
    {
        //Declare and initialize variables
        $results = array(
            "return_code" => -1,
            "message" => "",
            "post" => array()
        );
        $data = array();
        $job_keys = array();
        
        //Load models
        $this->load->model('m_job_parm_detail');
        
        //Load post data into array
        $data = (empty($get)) ? $this->input->post() : $get;

        $results['data'] = $data;
        
        if (!empty($data) && $data['job_number'] > 0) {
            $job_keys = get_job_keys($data['job_number']);
             
            //Supervisory fee
            $supervisory_fee_percent = str_replace(",", "", $data['supervisory_fee_percent']) / 100;
            $supervisory_fee_parm_idn = ($data['department_idn'] == 1) ? 83 : 17;
            if ($this->m_job_parm_detail->save($data['job_number'], $supervisory_fee_parm_idn, array('NumericValue' => $supervisory_fee_percent))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Supervisory Fee.";
                $results['return_code'] = -1;
            }
            
            //Contingencies
            //Map JobDefault_Idn to column
            $contingecy_job_defaults = array(
                2 => 33,
                3 => 34,
                4 => 35,
                5 => 36
            );
            
            $contingecy_percent_job_defaults = array(
                2 => 23,
                3 => 24,
                4 => 25,
                5 => 26
            );
            
            $contingency = 0;
            $contingency_percent = 0;
            foreach ($data['contingency'] as $col => $amount) {
                $contingency_percent = str_replace(",", "", $data['contingency_percent'][$col]) / 100;
                $contingency = str_replace(",", "", $amount);
                
                //If there is a percent, set contingency amount to 0
                if ($contingency_percent > 0) {
                    $contingency = 0;
                }

                //Save Contingency percent
                if ($this->m_job_parm_detail->save($data['job_number'], $contingecy_percent_job_defaults[$col], array('NumericValue' => $contingency_percent))) {
                    $results['return_code'] = 1;
                } else {
                    $results['message'] .= "Error saving Contingency Percent.";
                    $results['return_code'] = -1;
                }
                
                //Save Contingency amount
                if ($this->m_job_parm_detail->save($data['job_number'], $contingecy_job_defaults[$col], array('NumericValue' => $contingency))) {
                    $results['return_code'] = 1;
                } else {
                    $results['message'] .= "Error saving Contingency.";
                    $results['return_code'] = -1;
                }
            }
        
            //Mark up costs
            //High Sub
            $high_sub_mark_up_percent = str_replace(",", "", $data['mark_up_percent_3']) / 100;
            
            if ($this->m_job_parm_detail->save($data['job_number'], 57, array('NumericValue' => $high_sub_mark_up_percent))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Mark-Up of Costs.";
                $results['return_code'] = -1;
            }

            $labor_mark_up_percent = str_replace(",", "", $data['mark_up_percent_5']) / 100;
            
            if ($this->m_job_parm_detail->save($data['job_number'], 58, array('NumericValue' => $labor_mark_up_percent))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Mark-Up of Costs.";
                $results['return_code'] = -1;
            }
            
            //Regular commission
            $commission_percent = str_replace(",", "", $data['regular_commission_percent']) / 100;
            
            if ($this->m_job_parm_detail->save($data['job_number'], 59, array('NumericValue' => $commission_percent))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Commission.";
                $results['return_code'] = -1;
            }

            //Profit mark up
            $profit_mark_up_percent = (array_key_exists('profit_mark_up_percent', $data)) ? str_replace(",", "", $data['profit_mark_up_percent']) / 100 : 0;
            $profit_mark_up = (array_key_exists('profit_mark_up', $data)) ? str_replace(",", "", $data['profit_mark_up']) : 0;
            
            //If there is a percent, set profit mark-up amount to 0
            if ($profit_mark_up_percent > 0) {
                $profit_mark_up = 0;
            }

            //Save profit mark-up percent
            if ($this->m_job_parm_detail->save($data['job_number'], 14, array('NumericValue' => $profit_mark_up_percent))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Profit Mark-Up Percent.";
                $results['return_code'] = -1;
            }
            
            //Save Profit Mark-Up amount
            if ($this->m_job_parm_detail->save($data['job_number'], 46, array('NumericValue' => $profit_mark_up))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Profit Mark-Up.";
                $results['return_code'] = -1;
            }
            
            //Sales Tax
            $sales_tax_percent = str_replace(",", "", $data['sales_tax_percent']) / 100;
            
            if ($this->m_job_parm_detail->save($data['job_number'], 15, array('NumericValue' => $sales_tax_percent))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Sales Tax.";
                $results['return_code'] = -1;
            }
            
            //Depository Fee
            $depository_fee_percent = str_replace(",", "", $data['depository_fee_percent']) / 100;
            $depository_fee = str_replace(",", "", $data['depository_fee']);
            $override_depository_fee_limit = (empty($data['override_depository_fee_limit'])) ? "N" : "Y";
            
            //Save override depository fee limit
            //Save Depository Fee percent
            if ($this->m_job_parm_detail->save($data['job_number'], 18, array('AlphaValue' => $override_depository_fee_limit))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Depository Fee Override Limit.";
                $results['return_code'] = -1;
            }
            
            //If there is a percent, set profit mark-up amount to 0
            if ($depository_fee_percent > 0) {
                $depository_fee = 0;
            }

            //Save Depository Fee percent
            if ($this->m_job_parm_detail->save($data['job_number'], 18, array('NumericValue' => $depository_fee_percent))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Depository Fee Percent.";
                $results['return_code'] = -1;
            }
            
            //Save Depository fee amount
            if ($this->m_job_parm_detail->save($data['job_number'], 48, array('NumericValue' => $depository_fee))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Depository Fee.";
                $results['return_code'] = -1;
            }
            
            //Cost of bond
            $cost_of_bond_percent = str_replace(",", "", $data['cost_of_bond_percent']) / 100;
            $cost_of_bond = str_replace(",", "", $data['cost_of_bond']);
            
            //If there is a percent, set amount to 0
            if ($cost_of_bond_percent > 0) {
                $cost_of_bond = 0;
            }

            //Save Cost of Bond percent
            if ($this->m_job_parm_detail->save($data['job_number'], 44, array('NumericValue' => $cost_of_bond_percent))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Cost of Bond Percent.";
                $results['return_code'] = -1;
            }
            
            //Save Cost of Bond amount
            if ($this->m_job_parm_detail->save($data['job_number'], 49, array('NumericValue' => $cost_of_bond))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Cost of Bond.";
                $results['return_code'] = -1;
            }
            
            //Gross receipt
            $gross_receipt_percent = str_replace(",", "", $data['gross_receipt_percent']) / 100;
            $gross_receipt = str_replace(",", "", $data['gross_receipt']);
            
            //If there is a percent, set amount to 0
            if ($gross_receipt_percent > 0) {
                $gross_receipt = 0;
            }

            //Save Gross Receipt percent
            $gross_receipt_parm_idn = ($data['department_idn'] == 1) ? 84 : 45;

            if ($this->m_job_parm_detail->save($data['job_number'], $gross_receipt_parm_idn, array('NumericValue' => $gross_receipt_percent))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Gross Receipt Percent.";
                $results['return_code'] = -1;
            }
            
            //Save Gross Receipt amount
            if ($this->m_job_parm_detail->save($data['job_number'], 50, array('NumericValue' => $gross_receipt))) {
                $results['return_code'] = 1;
            } else {
                $results['message'] .= "Error saving Gross Receipt.";
                $results['return_code'] = -1;
            }
            
            //total sqft
            $total_sqft = 0;

            if (isset($data['bs_total_sqft'])) {
                $total_sqft = ($this->m_job->is_parent($data['job_number'])) ? 0 : str_replace(",","",$data['bs_total_sqft']);
            }
            
            $job_recap_data = array(
                'Notes' => $data['notes'],
                'TotalSqft' => $total_sqft
            );

            //Save job data on Jobs record
            $job_results = $this->m_job->save($data['job_number'], $job_recap_data);        
            
            job_update($data['job_number']);
        } else {
            $results['message'] = "Error saving recap.";
        }
        
        echo json_encode($results);
    }

    private function _save_adjustment_factors($data)
    {
        $results = array(
            "saves" => array(),
            "errors" => 0
            );
        $af_data = array();
        $i = 0;
        $worksheet_idn = $data['Worksheet_Idn'];

        //Load models
        $this->load->model('m_worksheet_basic_appropriation');

        //Load library
        $this->load->library("worksheet");

        // if (isset($data['AdjustmentSubFactor']))
        // {
        // 	//$results['numAdjustmentSubFactor'] = sizeof($data['AdjustmentSubFactor']);

        //     foreach($data['AdjustmentSubFactor'] as $adjustment_sub_factor_idn)
        //     {
        //         $af_data = array(
        //             "Worksheet_Idn" => $worksheet_idn,
        //             "Rank" => $data['AdjustmentFactorRank'][$i],
        //             "Section" => 0,
        //             "AdjustmentSubFactor_Idn" => $adjustment_sub_factor_idn
        //             );

        // 		if (isset($data['AdjustmentFactorValue'][$i]))
        // 		{
        // 			$af_data['UserValue'] = $data['AdjustmentFactorValue'][$i];
        // 		}

        // 		$results['af_data'][] = $af_data;

        //         $this->worksheet->save_adjustment_factor($af_data);

        // 		//Update Engineering Labor Class if Branch Line worksheet
        // 		if ($data['WorksheetMaster_Idn'] == 9 && $data['AdjustmentFactor'][$i] == 21)
        // 		{
        // 			$this->m_worksheet_basic_appropriation->update($worksheet_idn, $data['JobNumber']);
        // 		}
        //         $i++;
        //     }
        // }

        for ($i = 0; $i < sizeof($data['AdjustmentFactorRank']); $i++) {
            // if ($data['AdjustmentFactor'][$i] > 0)
            // {
            $af_data = array(
                    "Worksheet_Idn" => $worksheet_idn,
                    "Rank" => $data['AdjustmentFactorRank'][$i],
                    "Section" => 0,
                    "AdjustmentSubFactor_Idn" => (isset($data['AdjustmentSubFactor'][$i])) ? $data['AdjustmentSubFactor'][$i] : 0,
                    );

            if (isset($data['AdjustmentFactorValue'][$i])) {
                $af_data['UserValue'] = $data['AdjustmentFactorValue'][$i];
            }

            $results['af_data'][] = $af_data;

            $this->worksheet->save_adjustment_factor($af_data);

            //Update Engineering Labor Class if Branch Line worksheet
            if ($data['WorksheetMaster_Idn'] == 9 && $data['AdjustmentFactor'][$i] == 21) {
                $this->m_worksheet_basic_appropriation->update($worksheet_idn, $data['JobNumber']);
            }
            //}
        }


        return $results;
    }

    public function save_favorite($job_number, $user_id, $flag)
    {
        $results = array(
            "return_code" => 0
            );

        if (!empty($job_number) && $job_number > 0) {
            $job_keys = get_job_keys($job_number);
            $data = array(
                "Job_Idn" => $job_keys[0],
                "ChangeOrder" => $job_keys[1],
                "User_Idn" => $user_id
                );

            if ($flag == 1) {
                //insert record into UserFavoriteJobs
                if ($this->m_reference_table->insert("UserFavoriteJobs", $data)) {
                    $results['return_code'] = 1;
                }
            } else {
                //delete record into UserFavoriteJobs
                if ($this->m_reference_table->delete("UserFavoriteJobs", $data)) {
                    $results['return_code'] = 1;
                }
            }
        }
        echo json_encode($results);
    }

    public function price_differences($job_number="0")
    {
        //Delcare and initialize variables
        $data = array(
            'menus' => array(),
            'job' => array(),
            'prices' => array(),
            'active_page' => 'Price Differences',
            'bread_crumbs' => array(
                array(
                    'name' => 'Price Differences',
                    'link' => ''
                )
            )
        );
        $job_keys = array();

        //Load models
        $this->load->model('m_user');

        //Load menus
        $data['menus'] = $this->m_menu->get_menus($job_number);
        //Get Job
        $data['job'] = $this->get_job($job_number);

        //Get job keys
        $job_keys = get_job_keys($job_number);

        $data['prices'] = $this->_get_prices_differences($job_number);

        //Load view
        $this->load->view('job/price_differences', $data);
    }

    private function _get_prices_differences($job_number)
    {
        $prices = array();

        if ($job_number > 0) {
            $prices = $this->m_job->get_price_changes($job_number);
        }

        return $prices;
    }

    /**
     * Summary of update_prices
     */
    public function update_prices()
    {
        //Declare and Initialize variables
        $results = array(
            "updates" => 0,
            "errors" => 0,
            "job_number" => 0,
            "return_code" => 0
        );
        $job_keys = array();
        $post = $this->input->post();

        if (!empty($post) && isset($post['job_number']) && $post['job_number'] > 0) {
            //Load models
            $this->load->model('m_product_assembly');

            //load post data
            $results['job_number'] = $post['job_number'];
            $price_differences = $post['price_differences'];

            //get job keys
            $job_keys = get_job_keys($post['job_number']);
            $assemblies = array();
            $i = 0;
            $table_name = "";
            $where = array();

            for ($i; $i < sizeof($price_differences); $i++) {
                //Load price difference metadata for update
                $set = array();
                $worksheet_id = $price_differences[$i]['Worksheet_Idn'];
                $product_id = $price_differences[$i]['Product_Idn'];
                $mat_unit_price = trim($price_differences[$i]['MaterialUnitPrice']);
                $field_unit_price = trim($price_differences[$i]['FieldUnitPrice']);
                $shop_unit_price = trim($price_differences[$i]['ShopUnitPrice']);
                $eng_unit_price = (isset($price_differences[$i]['EngineeringUnitPrice'])) ? trim($price_differences[$i]['EngineeringUnitPrice']) : "-";
                $assembly_idn = (isset($price_differences[$i]['ProductAssembly_Idn'])) ? $price_differences[$i]['ProductAssembly_Idn'] : "-";
                //$miscellaneous_detail_idn = $price_differences[$i]['MiscellaneousDetail_Idn'];

                if ($mat_unit_price != "-") {
                    $set['MaterialUnitPrice'] = $mat_unit_price;
                }

                if ($field_unit_price != "-") {
                    $set['FieldUnitPrice'] = $field_unit_price;
                }

                if ($shop_unit_price != "-") {
                    $set['ShopUnitPrice'] = $shop_unit_price;
                }

                if ($eng_unit_price != "-") {
                    $set['EngineerUnitPrice'] = $eng_unit_price;
                }

                if ($assembly_idn > 0) {
                    $table_name = "ProductAssemblyDetails";
                    $where = array(
                        "ProductAssembly_Idn" => $assembly_idn,
                        "Product_Idn" => $product_id
                    );
                    $assemblies[] = $assembly_idn;
                } else {
                    $table_name = "WorksheetDetails";
                    $where = array(
                        "Worksheet_Idn" => $worksheet_id,
                        "Product_Idn" => $product_id
                    );
                }

                if ($this->m_reference_table->update($table_name, $set, $where)) {
                    $results['updates']++;
                } else {
                    $results['errors']++;
                }
            }

            //Recalculate Assembly totals and update Miscellaneous details record
            $assemblies = array_unique($assemblies);
            $assembly_totals = array();

            foreach ($assemblies as $a) {
                $assembly_totals = $this->m_product_assembly->calculate_assembly_totals($a);

                //Update miscellaneous detail record
                $set = array(
                    "MaterialUnitPrice" => $assembly_totals['Material'],
                    "FieldUnitPrice" => $assembly_totals['Field'],
                    "ShopUnitPrice" => $assembly_totals['Shop']
                    );

                $where = array(
                    "ProductAssembly_Idn" => $a
                    );

                if ($this->m_reference_table->update("MiscellaneousDetails", $set, $where) == false) {
                    $results['errors']++;
                }
            }

            //Update job record with latest PriceUpdate_Idn
            $latest_price_update_idn = get_latest_price_update("idn");

            $this->m_job->save($post['job_number'], array("PriceUpdate_Idn" => $latest_price_update_idn));

            if ($results['errors'] == 0) {
                $results['return_code'] = 1;
            }
        }

        echo json_encode($results);
    }

    public function check_job_number($job_number)
    {
        $results = array(
            "return_code" => 0,
            "job_name" => ""
            );
        $job_keys = array();

        if (!empty($job_number)) {
            $job_keys = get_job_keys($job_number);

            $this->db
                ->select('Job_Idn, ChangeOrder, Name')
                ->from("Jobs")
                ->where("Job_Idn", $job_keys[0])
                ->where("ChangeOrder", $job_keys[1])
                ->where("ActiveFlag", 1);

            $query = $this->db->get();

            if ($query) {
                if ($query->num_rows() == 1) {
                    $results['return_code'] = 1;
                    $row = $query->row_array();
                    $results['job_name'] = $row['Name'];
                } else {
                    $results['return_code'] = -1;
                }
            } else {
                $results['return_code'] = -1;
                write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => __METHOD__));
            }
        }

        echo json_encode($results);
    }

    public function get_sum_quantity_by_worksheet_category_idns($job_number = "0", $worksheet_category_idns = array())
    {
        $response = array(
            'status' => 0,
            'total' => 0,
            'message' => ''
        );
        
        if (empty($job_number) || empty($worksheet_category_idns)) {
            $response['status'] = 400;
            $response['message'] = 'Bad request.';
        } else {
            $job_keys = get_job_keys($job_number);
            $total = 0;
            $wd_total = 0;
            $md_total = 0;

            //Get total from WorksheetDetails
            $query = $this->db
                ->select("SUM(wd.Quantity) AS TotalWD")
                ->from("WorksheetDetails AS wd")
                ->join("Worksheets AS w", "w.Worksheet_Idn = wd.Worksheet_Idn", "left")
                ->join("Products AS p", "wd.Product_Idn = p.Product_Idn", "left")
                ->where("w.Job_Idn = {$job_keys[0]}")
                ->where("w.ChangeOrder = {$job_keys[1]}")
                ->where_in("p.WorksheetCategory_Idn", $worksheet_category_idns)
                ->get()
                ->row();
            $wd_total = ($query->TotalWD == null) ? 0 : $query->TotalWD;

            //Get total from MiscellaneousDetails
            $query = $this->db
                ->select("SUM(md.Quantity) AS TotalMD")
                ->from("MiscellaneousDetails AS md")
                ->join("Worksheets AS w", "w.Worksheet_Idn = md.Worksheet_Idn", "left")
                ->where("w.Job_Idn = {$job_keys[0]}")
                ->where("w.ChangeOrder = {$job_keys[1]}")
                ->where_in("md.WorksheetCategory_Idn", $worksheet_category_idns)
                ->get()
                ->row();
            $md_total = ($query->TotalMD == null) ? 0 : $query->TotalMD;

            $total = $wd_total + $md_total;

            $response = array(
                'status' => 200,
                'total' => $total,
                'message' => 'Totals calculated successfully.'
            );
        }

        return $total;
    }

	// public function get_total_heads($job_number = 0)
	// {
	// 	$total_heads = 0;
	// 	$job_keys = array();
	// 	$where = array();
	// 	$query;

	// 	if (!empty($job_number))
	// 	{
	// 		$job_keys = get_job_keys($job_number);
	// 		$where = array(
	// 			"Job_Idn" => $job_keys[0],
	// 			"ChangeOrder" => $job_keys[1],
	// 			"WorksheetMaster_Idn" => 9
	// 		);

	// 		//sum Qty of Branchline worksheets
	// 		$query = $this->db
	// 			->select("sum(Quantity) AS TotalHeads")
	// 			->from("Worksheets")
	// 			->where($where)
	// 			->get()
	// 			->row();

	// 		$total_heads = ($query->TotalHeads == null) ? 0 : $query->TotalHeads;;
	// 	}

	// 	return $total_heads;
	// }
}
/* End of file job.php */
/* Location: ./application/controllers/job.php */
