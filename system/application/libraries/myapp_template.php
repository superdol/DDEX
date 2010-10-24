<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Template Class
 */

class Myapp_template 
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

	function generate_backoffice_header_without_menu($title,$section,$metas)
	{
		$this->load_language();
		$CI =& get_instance();				
		$data['title'] = $title;;
		$data['section'] = $section;
		$data['metas'] = $metas;			
		$CI->load->view('administrator/header_without_menu',$data);				
	}
	
	function generate_backoffice_header($title,$section,$metas)
	{
		$this->load_language();
		$CI =& get_instance();				
		$data['title'] = $title;;
		$data['section'] = $section;
		$data['metas'] = $metas;			
		$CI->load->view('administrator/header',$data);				
	}

	function generate_backoffice_footer()
	{
		$this->load_language();
		$CI =& get_instance();		
		$CI->load->view('administrator/footer');
	}

}

/* End of file Myapp_template.php */
/* Location: ./system/application/libraries/Myapp_template.php */