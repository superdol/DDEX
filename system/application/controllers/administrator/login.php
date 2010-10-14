<?php
class Login extends Controller {
	
	function index()
	{
		$this->load->view('administrator/header');
		
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
				// display validation errors
				$this->load->view('administrator/login');
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
					$this->load->view('administrator/login',$data);
				}
			}
		}
		
		$this->load->view('administrator/footer');

	}
}

/* End of file login.php */
/* Location: ./system/application/controllers/admin/login.php */
