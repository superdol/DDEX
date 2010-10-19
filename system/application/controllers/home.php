<?php
class Home extends Controller {
	function index()
	{	
		// load template
		$this->load->library('ddex_template');

		// load language
		$this->ddex_template->load_language();
		
		// header
		$this->ddex_template->generate_header('ddex','home',array(
							array('name' => 'og:title', 'content' => 'DDEX'),
							array('name' => 'og:type', 'content' => 'website'),
							array('name' => 'og:url', 'content' => site_url()),
							array('name' => 'og:site_name', 'content' => 'DDEX'),
							array('name' => 'og:description', 'content' => 'DDEX'),
							array('name' => 'fb:admins', 'content' => 'geoffroy.montel'),
							));	
							
		// main
		$this->load->view('home');
		
		// footer
		$this->ddex_template->generate_footer();
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */