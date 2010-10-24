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
			// load template
			$this->load->library('myapp_template');		
			
			// generate header
			$this->myapp_template->generate_backoffice_header('DDEX BO - Dashboard','home',NULL);
			
			// view dashboard
			$this->load->view('administrator/dashboard');
			
			// generate footer
			$this->myapp_template->generate_backoffice_footer();
		}
	}
}

/* End of file dashboard.php */
/* Location: ./system/application/controllers/admin/dashboard.php */
