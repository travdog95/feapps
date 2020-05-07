<?php
class M_volume_correction extends CI_Model {
	
    private $_table_name = "VolumeCorrections";
    
    function __construct()
    {
        parent::__construct();
    }

	/**
     * get_value_by_idn
	 *
	 * Get value of volume correction by idn
	 *
     * @access  public
	 * @param	$volume_correction_idn(integer)
	 * @return	float
	 */

	public function get_value_by_idn($volume_correction_idn)
	{
		//Delcare and initialize variables
        $query = false;
        $value = 0;
		
		$this->db
			->select("Value")
			->from($this->_table_name)
            ->where('VolumeCorrection_Idn',$volume_correction_idn);
			
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
					$value = $row['Value'];
				}
			}
        }
	    
        return $value;	
	}
}