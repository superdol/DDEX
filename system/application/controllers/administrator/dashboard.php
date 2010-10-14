<?php
class Dashboard extends Controller {
	
	function index()
	{
		$this->load->model('user_model');	
		if(! $this->user_model->is_logged_in_and_admin())
		{
			redirect('administrator/login','refresh');
		} else 
		{
			$this->load->view('administrator/header');
			$this->load->view('administrator/menu');
			$this->load->view('administrator/dashboard');
			$this->load->view('administrator/footer');		
		}
	}
}

/* End of file dashboard.php */
/* Location: ./system/application/controllers/admin/dashboard.php */
