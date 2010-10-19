<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Ddex Template Class
 */

class Ddex_template 
{
	private $language = NULL;

	function load_language()
	{		
		return 'en_EN';
	}

	function generate_header($title,$section,$metas)
	{
		$this->load_language();
		$CI =& get_instance();				
		$data['title'] = $title;;
		$data['section'] = $section;
		$data['metas'] = $metas;			
		$CI->load->view('header',$data);				
	}

	function generate_sidebar()
	{
		$this->load_language();
		$CI =& get_instance();		
		$CI->load->view('sidebar_header');		
		$CI->load->view('sidebar_footer');			 
	}

	function generate_footer()
	{
		$this->load_language();
		$CI =& get_instance();		
		$CI->load->view('footer');
	}

}

/* End of file Ddex_template.php */
/* Location: ./system/application/libraries/Ddex_template.php */