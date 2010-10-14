<?php
class Logout extends Controller {
	
	function index()
	{
		$this->load->model('user_model');
		$this->user_model->force_logout(); 
		redirect('administrator/login','refresh');
	}
}

/* End of file logout.php */
/* Location: ./system/application/controllers/admin/logout.php */
