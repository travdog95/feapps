<?php
class M_system_type extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }

	/*
	 * get_system_sub_types
	 *
	 * Get all rows from SystemSubTypes table by module. Function returns a multi-dimensional array of Name([SystemType_Idn][SystemSubType_Idn])
	 *
	 * @param	$department_idn(integer)
	 * @return	$rows(array)
	 */

	public function get_system_sub_types($department_idn)
	{
		//Delcare and initialize variables
		$rows = array();
		
		//Get all active records
		if ($department_idn > 0)
		{
			$this->db
				->select("SST.SystemType_Idn, SST.SystemSubType_Idn, SST.Name")
				->from('SystemSubTypes AS SST')
				->join('SystemTypes AS ST', 'SST.SystemType_Idn = ST.SystemType_Idn')
				->where(array('ST.Department_Idn' => $department_idn, 'ST.ActiveFlag' => 1, 'SST.ActiveFlag' => 1))
				->order_by('ST.Rank ASC, SST.Rank ASC');
			
			$query = $this->db->get();
	
			//If any records were returned, load into rows array
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$rows[$row['SystemType_Idn']][$row['SystemSubType_Idn']] = $row['Name'];
				}
			}
		}
		
		return $rows;
	}
}