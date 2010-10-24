<?php
class News extends Controller {
	
	function index()
	{		
		return $this->from(0);
	}
	
	function from($news_number)
	{
		if (!isset($news_number)) $news_number=0;
		
		// load template
		$this->load->library('myapp_template');

		// load language
		$lang = $this->myapp_template->load_language();
		
		// header
		$this->myapp_template->generate_header('DDEX | news','news',array(
							array('name' => 'og:title', 'content' => 'DDEX | news')),
							array('name' => 'og:type', 'content' => 'website'),
							array('name' => 'og:url', 'content' => site_url('news')),
							array('name' => 'og:site_name', 'content' => 'DDEX'),
							array('name' => 'og:description', 'content' => 'Digital Data EXchange (DDEX) website'),
							array('name' => 'fb:admins', 'content' => $this->config->item('myapp_facebook_admins')),
							array('name' => 'fb:app_id', 'content' => $this->config->item('myapp_facebook_app_id')));
									
		// main content		
		$this->load->model('news_model');
		$number_of_news = $this->news_model->get_number_of_news($lang);
		$this->load->library('pagination');

		$config['base_url'] = base_url().'news/from/';
		$config['total_rows'] = $number_of_news;
		$config['per_page'] = 3;
		$config['num_links'] = 4;

		$this->pagination->initialize($config);

		$data['pagination']=$this->pagination->create_links();

		$data['last_news'] = $this->news_model->get_news($lang,(int)$news_number,$config['per_page']);
		$this->load->view('content_header');
		$this->load->view('news/all_news',$data);
		$this->load->view('content_footer');
		
		// sidebar & footer
		$this->myapp_template->generate_sidebar();
		$this->myapp_template->generate_footer();
	}

	function show($path)
	{					
		// load template
		$this->load->library('myapp_template');

		// load language
		$lang = $this->myapp_template->load_language();
		
		// main content
		$this->load->model('news_model');
		$news = $this->news_model->get_news_by_path($lang,$path);
		
		if (!$news) 
		{
			show_404();
		}
		else 
		{	
			$title = 'DDEX | '.$news->title;
			$section = 'news';
			
			// Facebook metadata
			if (!$news->mp3_url && !$news->youtube_id) {
				$metas = array(
								array('name' => 'og:title', 'content' => $news->title),
								array('name' => 'og:type', 'content' => 'article'),
								array('name' => 'og:url', 'content' => site_url('/news/'.$news->path)),
								array('name' => 'og:site_name', 'content' => 'DDEX'),
								array('name' => 'og:description', 'content' => 'Digital Data EXchange (DDEX) website'),
								array('name' => 'fb:admins', 'content' => $this->config->item('myapp_facebook_admins')),
								array('name' => 'fb:app_id', 'content' => $this->config->item('myapp_facebook_app_id')),
								);
			}
			elseif ($news->youtube_id) {
				$metas = array(
								array('name' => 'og:title', 'content' => $news->title),
								array('name' => 'og:type', 'content' => 'article'),
								array('name' => 'og:url', 'content' => site_url('/news/'.$news->path)),
								array('name' => 'og:site_name', 'content' => 'DDEX'),
								array('name' => 'og:description', 'content' => 'Digital Data EXchange (DDEX) website'),
								array('name' => 'fb:admins', 'content' => $this->config->item('myapp_facebook_admins')),
								array('name' => 'fb:app_id', 'content' => $this->config->item('myapp_facebook_app_id')),
								array('name' => 'og:image', 'content' => 'http://img.youtube.com/vi/'.$news->youtube_id.'/0.jpg'),
								array('name' => 'og:video', 'content' => 'http://www.youtube.com/v/'.$news->youtube_id),
								array('name' => 'video_height', 'content' => '560'),
								array('name' => 'video_width', 'content' => '315'),
								array('name' => 'video_type', 'content' => 'application/x-shockwave-flash'),
								);
			}
			elseif ($news->mp3_url) {
				$metas = array(
								array('name' => 'og:title', 'content' => $news->title),
								array('name' => 'og:type', 'content' => 'article'),
								array('name' => 'og:url', 'content' => site_url('/news/'.$news->path)),
								array('name' => 'og:site_name', 'content' => 'DDEX'),
								array('name' => 'og:description', 'content' => 'Digital Data EXchange (DDEX) website'),
								array('name' => 'fb:admins', 'content' => $this->config->item('myapp_facebook_admins')),
								array('name' => 'fb:app_id', 'content' => $this->config->item('myapp_facebook_app_id')),
								array('name' => 'og:image', 'content' => site_url('/media/img/220w/'.$news->hires_image_path)),
								array('name' => 'og:audio', 'content' => $news->mp3_url),
								);
			}
			
			$this->myapp_template->generate_header($title,$section,$metas);
			$data['news'] = $news;
			$this->load->view('content_header');
			$this->load->view('news/news_page',$data);
			$this->load->view('content_footer');

			// sidebar & footer
			$this->myapp_template->generate_sidebar();
			$this->myapp_template->generate_footer();
		}
	}
}

/* End of file news.php */
/* Location: ./system/application/controllers/news.php */