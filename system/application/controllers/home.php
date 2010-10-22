<?php
class Home extends Controller {
	function index()
	{	
		// load template
		$this->load->library('ddex_template');

		// load language
		$lang = $this->ddex_template->load_language();
		
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
		// $this->load->view('home');
		$this->load->view('herobox');
		$this->load->view('content_header');
		
		// recent news
		$this->load->model('news_model');
		$number_of_news = $this->news_model->get_number_of_news($lang);
		$this->load->library('pagination');

		$config['base_url'] = base_url().'news/from/';
		$config['total_rows'] = $number_of_news;
		$config['per_page'] = 3;
		$config['num_links'] = 4;

		$this->pagination->initialize($config);

		$data['pagination']=$this->pagination->create_links();

		$data['last_news'] = $this->news_model->get_news($lang,0,$config['per_page']);

		$this->load->view('news/all_news',$data);

		$this->load->view('content_footer');
		
		// footer
		$this->ddex_template->generate_footer();
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */