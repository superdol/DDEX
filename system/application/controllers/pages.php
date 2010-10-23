<?php
class Pages extends Controller {
	function show($path)
	{					
		// load template
		$lang = $this->load->library('ddex_template');

		// load language
		$lang = $this->ddex_template->load_language();
		
		// main content
		$this->load->model('page_model');
		$page = $this->page_model->get_page_by_path($lang,$path);
		
		if (!$page) 
		{
			show_404();
		}
		else 
		{	
			$title = $page->title.' - '.lang('label_name');
			$section = '';
			
			// Facebook metadata
			$metas = array(
							array('name' => 'og:title', 'content' => $page->title),
							array('name' => 'og:type', 'content' => 'article'),
							array('name' => 'og:url', 'content' => site_url('/'.$page->path)),
							array('name' => 'og:site_name', 'content' => lang('label_name')),
							array('name' => 'og:description', 'content' => lang('label_description')),
							array('name' => 'fb:admins', 'content' => lang('label_facebook_administrator')),
							);
			
			$this->ddex_template->generate_header($title,$section,$metas);
			$data['page'] = $page;
			$this->load->view('content_header');
			$this->load->view('pages/page',$data);
			$this->load->view('content_footer');

			// sidebar & footer
			$this->ddex_template->generate_sidebar();
			$this->ddex_template->generate_footer();
		}
	}
}

/* End of file pages.php */
/* Location: ./system/application/controllers/pages.php */