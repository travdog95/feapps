<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Application specific global variables
class Globals
{
    private static $CI;
    public static $initialized = false;
    private static $tablesAndKeys = array(
        array("Fittings", "Fitting_Idn")
    );
    public static $metadata = array();

    private static function initialize()
    {
        if (self::$initialized)
            return;

        self::$CI =& get_instance(); 
        self::$initialized = true;
    }

    public static function loadMetadata()
    {  
        self::initialize();
        // You may need to load the model if it hasn't been pre-loaded
        self::$CI->load->model('m_reference_table');

        foreach(self::$tablesAndKeys as $tableAndKey)
        {
            self::$metadata[$tableAndKey[0]] = self::$CI->m_reference_table->get_idns_names($tableAndKey[0], $tableAndKey[1]);
        }

    }
}
?>