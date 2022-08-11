<?php
class M_miscellaneous_detail extends CI_Model {
	
	private $_table_name = 'MiscellaneousDetails';

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_reference_table');
		$this->load->model('m_rfp_exception');
		$this->load->library('rfp_lib');
	}

	/**
	 * get_bonded_markup
	 *
	 * Get bonded markup from miscellaneous worksheets by Job_Idn and ChangeOrder
	 *
		 * @access  public
	 * @param	$job_idn(integer)
		 * @param   $change_order(integer)
	 * @return	float
	 */

	public function get_bonded_markup($job_idn, $change_order)
	{
		//Delcare and initialize variables
		$bonded_markup = 0;
		
		//Get all active records
		if ($job_idn > 0)
		{
			$this->db
				->select("SUM(MD.Quantity * MD.MaterialUnitPrice * MD.MaterialMarkUp) AS MarkUpAmount")
				->from('MiscellaneousDetails AS MD')
				->join('Worksheets AS W', 'MD.Worksheet_Idn = W.Worksheet_Idn')
				->where('W.Job_Idn', $job_idn)
                ->where('W.ChangeOrder', $change_order);
			
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
					    $bonded_markup = ceil($row['MarkUpAmount']);
				    }
			    }
            }
		}
		
		return $bonded_markup;
	}

	/**
	* get_next_line_num
	*
	* Get the next LineNum value for a worksheet category
	* 
	* @access   public
	* @param    number  
	* @param    number
	* @return   number
	*/

	public function get_next_line_num($worksheet_idn, $worksheet_category_idn)
	{
		$line_num = 0;
		$where = array();
		$query = false;

		if ($worksheet_idn > 0)
		{
			$where = array(
				"Worksheet_Idn" => $worksheet_idn,
				"WorksheetCategory_Idn" => $worksheet_category_idn
			);

			$this->db
				->select("LineNum")
				->from($this->_table_name)
				->where($where)
				->order_by("LineNum DESC")
				->limit(1);
			
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
						$line_num = $row['LineNum'] + 1;
					}
				}
				else
				{
					$line_num = 1;
				}
			}
		}
		return $line_num;
	}

	/**
	 * Insert
	 */
	public function insert($insert_data, $get_next_line_num = true)
	{
		if (isset($insert_data) && !empty($insert_data))
		{
			if ($get_next_line_num)
			{
				$insert_data['LineNum'] = $this->get_next_line_num($insert_data['Worksheet_Idn'], $insert_data['WorksheetCategory_Idn']);
			}

			return $this->m_reference_table->insert($this->_table_name, $insert_data);
		}
		else
		{
			write_feci_log(array("Message" => "Missing data to insert record", "Script" => __METHOD__));
		}

		return false;
	}

	/**
	 * Update
	 */
	public function update($set, $where)
	{
		if (isset($set) && !empty($set))
		{
			return $this->m_reference_table->update($this->_table_name, $set, $where);
		}
		else
		{
			write_feci_log(array("Message" => "Missing set data to update record", "Script" => __METHOD__));
		}

		return false;
	}

	/**
	 * Delete
	 */
	public function delete($where)
	{
		if ($this->m_reference_table->delete($this->_table_name, $where))
		{
			//check to see if an rfp exception needs to be created
			if ($this->rfp_lib->is_misc_product_exception($where['MiscellaneousDetail_Idn']))
			{
				$delete_where = array(
					"MiscellaneousDetail_Idn" => $where['MiscellaneousDetail_Idn'],
				);
				$this->m_rfp_exception->delete($delete_where);
			}

			return true;
		}

		return false;
	}
}