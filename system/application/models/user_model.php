<?php
class User_model extends Model {
    function User_model()
    {
        parent::Model();
		$this->load->library('session');
    }
	
	function is_admin($login,$password)
	{
		$q = "SELECT users.id,users.login FROM users INNER JOIN administrators ON users.id = administrators.user_id WHERE users.login = ? AND users.password = ?";
		$data = array($login,$password);
		$q = $this->db->query($q,$data);

		if($q->num_rows() > 0)
		{
			$r = $q->result();
			$session_data = array('login' => $r[0]->login,'logged_in' => true,'is_admin' => true);
			$this->session->set_userdata($session_data);
			return true;
		} else 
		{ 
			return false; 
		}
	}
	
	function is_logged_in_and_admin()
	{
		if($this->session->userdata('logged_in') && $this->session->userdata('is_admin'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function force_logout()
	{
		$this->session->sess_destroy();
	}
}

/* End of file user_model.php */
/* Location: ./system/application/model/user_model.php */