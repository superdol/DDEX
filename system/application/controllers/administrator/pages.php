<?php
class Pages extends Controller {
	
	function index()
	{		
		return $this->from(0);
	}
	
	function from($page_number)
	{
		$this->load->model('user_model');
		
		if(! $this->user_model->is_logged_in_and_admin())
		{
			redirect('administrator/login','refresh');
		} else 
		{
			if (!isset($page_number)) $page_number=0;

			// main content
			$this->load->model('page_model');
			$number_of_pages = $this->page_model->get_number_of_pages(NULL);
			$this->load->library('pagination');

			$config['base_url'] = base_url().'administrator/pages/from/';
			$config['total_rows'] = $number_of_pages;
			$config['per_page'] = 10;
			$config['num_links'] = 4;
			$config['uri_segment'] = 4;

			$this->pagination->initialize($config);

			$data['pagination']=$this->pagination->create_links();

			$data['last_pages'] = $this->page_model->get_pages(NULL,(int)$page_number,$config['per_page']);

			// load template
			$this->load->library('ddex_template');		
			
			// generate header
			$this->ddex_template->generate_backoffice_header('DDEX BO - Manage pages','pages',NULL);
			
			// view dashboard
			$this->load->view('administrator/pages/list',$data);
			
			// generate footer
			$this->ddex_template->generate_backoffice_footer();
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
			$this->load->model('page_model');
			$page = $this->page_model->get_page_by_id($id);
			
			if (!$page) {
				show_error('you tried to edit a page that does not exist');
			} else
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('title','title','trim|xss_clean|required|');
				$this->form_validation->set_rules('path','path','trim|xss_clean|required|strtolower');
				$this->form_validation->set_rules('datetime','datetime','trim|xss_clean|valid_datetime');
				$this->form_validation->set_rules('content','content','trim|xss_clean|required');
				$this->form_validation->set_rules('lang','lang','trim|xss_clean|required');
						
				if ($this->form_validation->run() == TRUE)
				{
					$fields_and_values = array (
						'title' => $this->input->post('title', TRUE),
						'path' => $this->input->post('path', TRUE),
						'datetime' => $this->input->post('datetime', TRUE),
						'content' => $this->input->post('content', TRUE),
						'lang' => $this->input->post('lang', TRUE) );
						
					$s = '[controllers/administrator/page:edit] content = '.$fields_and_values['content'];
					log_message('debug',$s);

					$this->page_model->update_page($id,$fields_and_values);
					
					// successfully edited
					redirect('/administrator/pages', 'refresh');				
				}	
				else
				{
					$data['page'] = $page;
					
					// load template
					$this->load->library('ddex_template');		
					
					// generate header
					$this->ddex_template->generate_backoffice_header('DDEX BO - Edit page','page',NULL);
					
					// view dashboard
					$this->load->view('administrator/pages/edit',$data);
					
					// generate footer
					$this->ddex_template->generate_backoffice_footer();
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
			$this->load->model('page_model');
			if ($this->page_model->remove_page($id))
			{
				// successfully removed
				redirect('/administrator/pages', 'refresh');
			}
			else
			{
				show_error('you tried to edit a page that does not exist');
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
			$this->load->model('page_model');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title','title','trim|xss_clean|required|');
			$this->form_validation->set_rules('path','path','trim|xss_clean|required|strtolower');
			$this->form_validation->set_rules('datetime','datetime','trim|xss_clean|valid_datetime|required');
			$this->form_validation->set_rules('content','content','trim|xss_clean|required');
			$this->form_validation->set_rules('lang','lang','trim|xss_clean|required');
					
			if ($this->form_validation->run() == TRUE)
			{
				$fields_and_values = array (
						'title' => $this->input->post('title', TRUE),
						'path' => $this->input->post('path', TRUE),
						'datetime' => $this->input->post('datetime', TRUE),
						'content' => $this->input->post('content', TRUE),
						'lang' => $this->input->post('lang', TRUE) );
					
				$this->page_model->add_page($fields_and_values);
				
				// successfully edited
				redirect('/administrator/pages', 'refresh');				
			}	
			else
			{			
				// load template
				$this->load->library('ddex_template');		
				
				// generate header
				$this->ddex_template->generate_backoffice_header('DDEX BO - Add page','page',NULL);
				
				// view dashboard
				$this->load->view('administrator/pages/add');
				
				// generate footer
				$this->ddex_template->generate_backoffice_footer();
			}
		}		
	}

}

/* End of file pages.php */
/* Location: ./system/application/controllers/admin/pages.php */
