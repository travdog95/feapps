<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//if (!function_exists('some_function'))
//{
//    function some_function()
//    {
//        //Enables me to use the CI objects (replaces $this usage)
//        $CI =& get_instance();
//    }
//}

if (!function_exists('format_date'))
{
	/*
	 * format_date
	 *
	 * Function formats date string or current date if $date parm is empty to Long Date and Time format
	 * 
	 *
	 * @param	$date(string)
	 * @param	$datetime_flag(bool)
	 * @return	$formatted_date(string)
	 */

	function format_date($date="", $datetime_flag = 0)
	{
		//Declare Variables
		$formatted_date = "";
		$date_string = "";
		$timestamp = 0;
		
		//If date is empty, get current date/time
		$timestamp = (empty($date)) ? time() : strtotime($date);
		
		//Determine format of date
		$date_string = ($datetime_flag == 1) ? "F j, Y G:i:s" : "F j, Y";

		//Format date
		$formatted_date = date($date_string, $timestamp);
		
		return $formatted_date;	
	}
}

if (!function_exists('get_timestamp'))
{
	
	/*
	 * get_timestamp
	 *
	 * Function converts an MSSQL DateTime or Date field into a php timestamp
	 *
	 * @param ($datetime(datetime))
	 * @return ($timestamp(int))
	 */

	function get_timestamp($datetime)
	{
		$year = substr($datetime,0,4);
		$month = substr($datetime,5,2);
		$day = substr($datetime,8,2);
		$hour = substr($datetime,11,2);
		$minute = substr($datetime,14,2);
		$second = substr($datetime,17,2);
		
		$timestamp = mktime($hour,$minute,$second,$month,$day,$year);
		return $timestamp;
	}
}

if (!function_exists('get_current_date'))
{
	
	/*
	 * get_current_date
	 *
	 * Function returns current date in MSSQL format 'YYYY-MM-DD'
	 *
	 * @param	$datetime_flag(integer)
	 * @return 	$formatted_date(string)
	 */

	function get_current_date($datetime_flag = 0, $timezone = null)
	{
		$formatted_date = "";
		$timezone = $timezone === null ? "America/Denver" : $timezone;
		
		date_default_timezone_set($timezone);
		
		$formatted_date = ($datetime_flag == 1) ? date('Y-m-d H:i:s'): date('Y-m-d');
		
		return $formatted_date;
	}
}


if ( ! function_exists('timespan_to_days'))
{
	function timespan_to_days($seconds = 1, $time = '')
	{
		$CI =& get_instance();
		$CI->lang->load('date');

		if ( ! is_numeric($seconds))
		{
			$seconds = 1;
		}

		if ( ! is_numeric($time))
		{
			$time = time();
		}

		if ($time <= $seconds)
		{
			$seconds = 1;
		}
		else
		{
			$seconds = $time - $seconds;
		}

		$str = '';
		$years = floor($seconds / 31536000);

		if ($years > 0)
		{
			$str .= $years.' '.$CI->lang->line((($years	> 1) ? 'date_years' : 'date_year')).', ';
		}

		$seconds -= $years * 31536000;
		$months = floor($seconds / 2628000);

		if ($years > 0 OR $months > 0)
		{
			if ($months > 0)
			{
				$str .= $months.' '.$CI->lang->line((($months	> 1) ? 'date_months' : 'date_month')).', ';
			}

			$seconds -= $months * 2628000;
		}

		$weeks = floor($seconds / 604800);

		if ($years > 0 OR $months > 0 OR $weeks > 0)
		{
			if ($weeks > 0)
			{
				$str .= $weeks.' '.$CI->lang->line((($weeks	> 1) ? 'date_weeks' : 'date_week')).', ';
			}

			$seconds -= $weeks * 604800;
		}

		$days = floor($seconds / 86400);

		if ($months > 0 OR $weeks > 0 OR $days > 0)
		{
			if ($days > 0)
			{
				$str .= $days.' '.$CI->lang->line((($days	> 1) ? 'date_days' : 'date_day')).', ';
			}

			$seconds -= $days * 86400;
		}

		return substr(trim($str), 0, -1);
	}
}

if ( ! function_exists('super_trim'))
{
	/**
	 * super_trim
	 *
	 * Function replaces new lines, carriage returns, tabs and multiple spaces witha a single space.
	 * Relly nice for formatting a string for a log.
	 *
	 * @access	public
	 * @param	$string(string)
	 * @return	string
	 */
	
	function super_trim($string)
	{
		return preg_replace("/\s+/", " ", str_replace(array("\n", "\t", "\r"), " ", $string));
	}
}

if ( ! function_exists('in_array_recursive'))
{
	/*
	 * in_array_recursive
	 *
	 * Searches for needle recursively in a multidimensiional array
	 *
	 * @param	$needle(mixed)
	 * @param	$haystack(array)
	 * @param	$strict(boolean)
	 * @return	boolean
	 */
	
	function in_array_recursive($needle, $haystack, $strict = false) 
	{
		foreach ($haystack as $item) 
		{
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_recursive($needle, $item, $strict))) 
			{
				return true;
			}
		}
	
		return false;
	}
}

if ( ! function_exists('check_idn'))
{
	/*
     * check_idn
     *
     * Check to see if idn is valid
     *
     * @param	$strict(boolean)
     * @return	boolean
     */
	
	function check_idn($idn) 
	{
        $valid = true;
        
        if (!is_numeric($idn))
        {
            return false;
        }
        
        //Outside range of int or negative number
        if ($idn > 2147483647 || $idn < 0)
        {
            return false;
        }
        
        return $valid;
    }
}

if ( ! function_exists('string_filter'))
{
	/*
     * string_filter
     *
     * Look for a string and remove it
     *
     * @param	$input(string)
     * @param   $remove_me(string)
     * @return	string
     */

    function string_filter($input, $remove_me) 
    {
        $return_string = "";
        for ($i = 0; $i < strlen($input); $i++) 
        {  // Search through string and append unfiltered values to return_string.
            $c = substr($input,$i,1);
            if (strstr($c, $remove_me) == false)
            {
                $return_string .= $c;
            }
        }
        return $return_string;
    }
}

if ( ! function_exists('get_caller_info'))
{
	function get_caller_info() {
		$c = '';
		$file = '';
		$func = '';
		$class = '';
		$trace = debug_backtrace();
		if (isset($trace[2])) {
			$file = $trace[1]['file'];
			$func = $trace[2]['function'];
			if ((substr($func, 0, 7) == 'include') || (substr($func, 0, 7) == 'require')) {
				$func = '';
			}
		} else if (isset($trace[1])) {
			$file = $trace[1]['file'];
			$func = '';
		}
		if (isset($trace[3]['class'])) {
			$class = $trace[3]['class'];
			$func = $trace[3]['function'];
			$file = $trace[2]['file'];
		} else if (isset($trace[2]['class'])) {
			$class = $trace[2]['class'];
			$func = $trace[2]['function'];
			$file = $trace[1]['file'];
		}
		if ($file != '') $file = basename($file);
		$c = $file . ": ";
		$c .= ($class != '') ? ":" . $class . "->" : "";
		$c .= ($func != '') ? $func . "(): " : "";
		return($c);
	}
}

function json_output($status_header, $response)
{
	$CI =& get_instance();
	$CI->output->set_content_type('application/json');
	$CI->output->set_status_header($status_header);
	$CI->output->set_output(json_encode($response));

}
?>