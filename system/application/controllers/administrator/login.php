<?php
class Login extends Controller {
	
	function index()
	{	
		$this->load->model('user_model');
	
		if($this->user_model->is_logged_in_and_admin())
		{
			redirect('administrator/dashboard','refresh');
		} else 
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('login','login','required');
			$this->form_validation->set_rules('password','password','required');

			if(!$this->form_validation->run())
			{
				// load template
				$this->load->library('myapp_template');		
				
				// generate header
				$this->myapp_template->generate_backoffice_header_without_menu('DDEX BO - Login','login',NULL);

				// display validation errors
				$this->load->view('administrator/login');

				// generate footer
				$this->myapp_template->generate_backoffice_footer();
			} else 
			{
				$login = $this->input->post('login');
				$password = $this->input->post('password');
				$is_admin = $this->user_model->is_admin($login,$password); 

				if($is_admin)
				{
					redirect('administrator/dashboard','refresh');
				} else 
				{
					$data['error_credentials'] = 'Wrong Username/Password';
					// load template
					$this->load->library('myapp_template');		
					
					// generate header
					$this->myapp_template->generate_backoffice_header_without_menu('DDEX BO - Login','home',NULL);

					// display validation errors
					$this->load->view('administrator/login',$data);

					// generate footer
					$this->myapp_template->generate_backoffice_footer();
				}
			}
		}
	}
}

/* End of file login.php */
/* Location: ./system/application/controllers/admin/login.php */
