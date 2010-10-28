<?php
class News extends Controller {
	
	function index()
	{		
		return $this->from(0);
	}
	
	function from($news_number)
	{
		$this->load->model('user_model');
		
		if(! $this->user_model->is_logged_in_and_admin())
		{
			redirect('administrator/login','refresh');
		} else 
		{
			if (!isset($news_number)) $news_number=0;

			// main content
			$this->load->model('news_model');
			$number_of_news = $this->news_model->get_number_of_news(NULL);
			$this->load->library('pagination');

			$config['base_url'] = base_url().'administrator/news/from/';
			$config['total_rows'] = $number_of_news;
			$config['per_page'] = 10;
			$config['num_links'] = 4;
			$config['uri_segment'] = 4;

			$this->pagination->initialize($config);

			$data['pagination']=$this->pagination->create_links();

			$data['last_news'] = $this->news_model->get_news(NULL,(int)$news_number,$config['per_page']);

			// load template
			$this->load->library('myapp_template');		
			
			// generate header
			$this->myapp_template->generate_backoffice_header('DDEX BO - Manage news','news',NULL);
			
			// view dashboard
			$this->load->view('administrator/news/list',$data);
			
			// generate footer
			$this->myapp_template->generate_backoffice_footer();
		}
	}
	
	function edit($id) 
	{
		$this->load->model('user_model');
		
		if(! $this->user_model->is_logged_in_and_admin())
		{
			redirect('administrator/login','refresh');
		} else 
		{
			// main content
			$this->load->model('news_model');
			$news = $this->news_model->get_news_by_id($id);
			
			if (!$news) {
				show_error('you tried to edit a news that does not exist');
			} else
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('title','title','trim|xss_clean|required|');
				$this->form_validation->set_rules('path','path','trim|xss_clean|required|strtolower');
				$this->form_validation->set_rules('datetime','datetime','trim|xss_clean|valid_datetime|required');
				$this->form_validation->set_rules('content','content','trim|xss_clean|required');
				$this->form_validation->set_rules('hires_image_path','hires_image_path','trim|xss_clean');
				$this->form_validation->set_rules('mp3_url','mp3_url','trim|xss_clean');
				$this->form_validation->set_rules('youtube_id','youtube_id','trim|xss_clean');
				$this->form_validation->set_rules('other_link_url','other_link_url','trim|xss_clean');
				$this->form_validation->set_rules('lang','lang','trim|xss_clean|required');
						
				if ($this->form_validation->run() == TRUE)
				{
					$fields_and_values = array (
						'title' => $this->input->post('title', TRUE),
						'path' => $this->input->post('path', TRUE),
						'datetime' => $this->input->post('datetime', TRUE),
						'content' => $this->input->post('content', TRUE),
						'hires_image_path' => $this->input->post('hires_image_path', TRUE),
						'mp3_url' => $this->input->post('mp3_url', TRUE),
						'youtube_id' => $this->input->post('youtube_id', TRUE),
						'other_link_url' => $this->input->post('other_link_url', TRUE),
						'lang' => $this->input->post('lang', TRUE) );
						
					$s = '[controllers/administrator/news:edit] content = '.$fields_and_values['content'];
					log_message('debug',$s);

					$this->news_model->update_news($id,$fields_and_values);
					
					// successfully edited
					redirect('/administrator/news', 'refresh');				
				}	
				else
				{
					$data['news'] = $news;
					
					// load template
					$this->load->library('myapp_template');		
					
					// generate header
					$this->myapp_template->generate_backoffice_header('DDEX BO - Edit news','news',NULL);
					
					// view dashboard
					$this->load->view('administrator/news/edit',$data);
					
					// generate footer
					$this->myapp_template->generate_backoffice_footer();
				}
		
			}
		}		
	}
	
	function delete($id) 
	{
		$this->load->model('user_model');
		
		if(! $this->user_model->is_logged_in_and_admin())
		{
			redirect('administrator/login','refresh');
		} else 
		{
			// main content
			$this->load->model('news_model');
			if ($this->news_model->remove_news($id))
			{
				// successfully removed
				redirect('/administrator/news', 'refresh');			
			}
			else
			{
				show_error('you tried to edit a news that does not exist');
			}			
		}
	}
	
	function add()
	{
		$this->load->model('user_model');
		
		if(! $this->user_model->is_logged_in_and_admin())
		{
			redirect('administrator/login','refresh');
		} else 
		{
			// main content
			$this->load->model('news_model');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title','title','trim|xss_clean|required|');
			$this->form_validation->set_rules('path','path','trim|xss_clean|required|strtolower');
			$this->form_validation->set_rules('datetime','datetime','trim|xss_clean|valid_datetime|required');
			$this->form_validation->set_rules('content','content','trim|xss_clean|required');
			$this->form_validation->set_rules('hires_image_path','hires_image_path','trim|xss_clean');
			$this->form_validation->set_rules('mp3_url','mp3_url','trim|xss_clean');
			$this->form_validation->set_rules('youtube_id','youtube_id','trim|xss_clean');
			$this->form_validation->set_rules('other_link_url','other_link_url','trim|xss_clean');
			$this->form_validation->set_rules('lang','lang','trim|xss_clean|required');
					
			if ($this->form_validation->run() == TRUE)
			{
				$fields_and_values = array (
						'title' => $this->input->post('title', TRUE),
						'path' => $this->input->post('path', TRUE),
						'datetime' => $this->input->post('datetime', TRUE),
						'content' => $this->input->post('content', TRUE),
						'hires_image_path' => $this->input->post('hires_image_path', TRUE),
						'mp3_url' => $this->input->post('mp3_url', TRUE),
						'youtube_id' => $this->input->post('youtube_id', TRUE),
						'other_link_url' => $this->input->post('other_link_url', TRUE),
						'lang' => $this->input->post('lang', TRUE) );
					
				$this->news_model->add_news($fields_and_values);
				
				// successfully edited
				redirect('/administrator/news', 'refresh');				
			}	
			else
			{			
				// load template
				$this->load->library('myapp_template');		
				
				// generate header
				$this->myapp_template->generate_backoffice_header('DDEX BO - Add news','news',NULL);
				
				// view dashboard
				$this->load->view('administrator/news/add');
				
				// generate footer
				$this->myapp_template->generate_backoffice_footer();
			}
		}		
	}

}

/* End of file news.php */
/* Location: ./system/application/controllers/admin/news.php */
