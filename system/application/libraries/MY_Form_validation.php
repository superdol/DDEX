<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	function __construct()
	{
		parent::CI_Form_validation();
	}

	// --------------------------------------------------------------------

	/**
	* Valid Date (ISO format)
	*
	* @access    public
	* @param    string
	* @return    bool
	*/
	function valid_date($str)
	{
		$CI =& get_instance();
		$CI->form_validation->set_message('valid_date', 'The %s field must be entered in YYYY-MM-DD format.');

		if ( preg_match("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $str, $matches) ) 
		{
			$yyyy = $matches[1];            // first element of the array is year
			$mm = $matches[2];              // second element is month
			$dd = $matches[3];              // third element is days
			return ( checkdate($mm, $dd, $yyyy) );
		} 
		else 
		{
			return FALSE;
		}
	}

	/**
	* Valid Date/Time (ISO format)
	*
	* @access    public
	* @param    string
	* @return    bool
	*/
	function valid_datetime($str)
	{
		$CI =& get_instance();
		$CI->form_validation->set_message('valid_datetime', 'The %s field must be entered in YYYY-MM-DD HH:MM:SS format.');

		if ( preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $str, $matches) ) 
		{
			$yyyy = $matches[1];            // first element of the array is year
			$mm = $matches[2];              // second element is month
			$dd = $matches[3];              // third element is days
			$h = $matches[4];					 // fourth element is hour
			$m = $matches[5];					 // fifth element is minutes
			$s = $matches[6];					 // sixth element is seconds

			return ( checkdate($mm, $dd, $yyyy) && $h<24 && $m<60 && $s<60 );
		} 
		else 
		{
			return FALSE;
		}
	}
}


/* End of file MY_Form_validation.php */
/* Location: ./system/application/libraries/MY_Form_validation.php */
