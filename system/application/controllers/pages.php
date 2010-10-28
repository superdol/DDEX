<?php
class Pages extends Controller {
	function show($path)
	{					
		// load template
		$lang = $this->load->library('myapp_template');

		// load language
		$lang = $this->myapp_template->load_language();
		
		// main content
		$this->load->model('page_model');
		$page = $this->page_model->get_page_by_path($lang,$path);
		
		if (!$page) 
		{
			show_404();
		}
		else 
		{	
			$title = 'DDEX | '.$page->title;
			$section = '';
			
			// Facebook metadata
			$metas = array(
							array('name' => 'og:title', 'content' => $page->title),
							array('name' => 'og:type', 'content' => 'article'),
							array('name' => 'og:url', 'content' => site_url('/'.$page->path)),
							array('name' => 'og:site_name', 'content' => 'DDEX'),
							array('name' => 'og:description', 'content' => 'Digital Data EXchange (DDEX) website'),
							array('name' => 'fb:admins', 'content' => $this->config->item('myapp_facebook_admins')),
							array('name' => 'fb:app_id', 'content' => $this->config->item('myapp_facebook_app_id')),
							);
			
			$this->myapp_template->generate_header($title,$section,$metas);
			$data['page'] = $page;
			$this->load->view('content_header');
			$this->load->view('pages/page',$data);

			// sidebar & footer
			$this->myapp_template->generate_sidebar();
			$this->load->view('content_footer');
			$this->myapp_template->generate_footer();
		}
	}
}

/* End of file pages.php */
/* Location: ./system/application/controllers/pages.php */