<?php
class Page_model extends Model {
    function Page_model()
    {
        parent::Model();
    }
	
	/**
	 * get_number_of_pages
	 *
	 * return the number of pages in the database
	 *
	 * @access   public
	 * @param	lang	the language used for descriptions (optional)
	 * @return	number of pages
	 */	
	 function get_number_of_pages($lang)
	 {
		if (isset($lang)) {		
			$q = "SELECT COUNT(*) AS total FROM pages WHERE lang = ?";
			$data = array($lang);
			$query = $this->db->query($q,$data);
			$result = $query->result();
			$nb = $result[0]->total;
			return $nb;
		} else {
			$q = "SELECT COUNT(*) AS total FROM pages";
			$data = array($lang);
			$query = $this->db->query($q,$data);
			$result = $query->result();
			$nb = $result[0]->total;
			return $nb;
		}
	 }
	 
	/**
	 * get_pages
	 *
	 * return a number of pages starting at offset 
	 *
	 * @access   public
	 * @param	lang	the language used for descriptions (optional)
	 * @param	offset	the first page to return (starts at 0)
	 * @param	number	max number of pages to return
	 * @return	an array of pages object with the following properties
	 *			id : an id
	 *			path : the path in the url under /pages
	 *			title : the page title
	 *			content : content of the page
	 *			datetime : the date/time of the page
	 *			hires_image_path : the path to a hires image under dynamic_img
	 *			mp3_url : the url of a mp3 linked to that page
	 *			youtube_id : the id of a youtube video linked to that page
	 *			other_link_url : a URL linked to that page
	 */
    function get_page($lang,$offset,$number)
    {
		if (!isset($offset)) $offset = 0;
		if (!isset($number)) $number = 5;
		
		if ($lang) {
			$q= "SELECT * FROM pages WHERE lang = ? ORDER BY datetime DESC LIMIT ?,?";
			$data = array($lang,$offset,$number);
			$query = $this->db->query($q,$data);
			return $query->result();
		} else {
			$q= "SELECT * FROM pages ORDER BY datetime DESC LIMIT ?,?";
			$data = array($offset,$number);
			$query = $this->db->query($q,$data);
			return $query->result();		
		}
    }

	/**
	 * get_page_by_path
	 *
	 * return a specific page
	 *
	 * @access   public
	 * @param	lang	the language used for descriptions
	 * @param	path : the path in the URL under /page
	 * @return	a page object with the following properties
	 *			id : an id
	 *			path : the path in the url under /page
	 *			title : the page title
	 *			content : content of the page
	 *			datetime : the date/time of the page
	 *			hires_image_path : the path to a hires image under dynamic_img
	 *			mp3_url : the url of a mp3 linked to that page
	 *			youtube_id : the id of a youtube video linked to that page
	 *			other_link_url : a URL linked to that page
	 */    
	 function get_page_by_path($lang,$path)
    {
		$q= "SELECT * FROM pages WHERE lang = ? AND path = ?";
		$data = array($lang,$path);
		$query = $this->db->query($q,$data);
      return $query->row();
    }
	 
	/**
	 * get_page_by_id
	 *
	 * return a specific page
	 *
	 * @access   public
	 * @param	lang	the language used for descriptions
	 * @param	id : the page id
	 * @return	a page object with the following properties
	 *			id : an id
	 *			path : the path in the url under /pages
	 *			title : the page title
	 *			content : content of the page
	 *			datetime : the date/time of the page
	 *			hires_image_path : the path to a hires image under dynamic_img
	 *			mp3_url : the url of a mp3 linked to that page
	 *			youtube_id : the id of a youtube video linked to that page
	 *			other_link_url : a URL linked to that page
	 */
	function get_page_by_id($id)
	{
		$q= "SELECT * FROM pages WHERE id = ?";
		$data = array($id);
		$query = $this->db->query($q,$data);
		return $query->row();
	}	 
	
	/**
	 * update_page
	 *
	 * @access   public
	 * @param	id : the page id
	 * @param	fields_and_values : an array with the fields to update like array('path' => 'path_to_page', 'content' => 'content in html format', ...)
	 * @return	true if it worked ok
	 
	 */
	 function update_page($id,$fields_and_values)
    {
		$this->load->helper('string');
		
		$q = 'UPDATE pages SET ';
		$nb = count($fields_and_values);
		$i = 0;
		foreach ($fields_and_values as $key => $value)
		{
			$q .= "$key=" . $this->db->escape($value);
			if ($i < $nb-1) 
			{
				$q .= ', ';
			} else 
			{
				$q .= ' ';			
			}
			$i++;
		}
		$q .= "WHERE id=$id";
		
		$s = '[models/page_model:update_page] sql query = '.$q;
		log_message('debug',$s);
		
		return $this->db->simple_query($q);
    }
	 
	/**
	 * remove_page
	 *
	 * @access  public
	 * @param	id : the page id
	 * @return	true if it worked ok
	 */
	 function remove_page($id)
    {
		$q = "DELETE FROM pages WHERE id=$id";
		return $this->db->simple_query($q);
    }	 	 
	 
	/**
	 * add_page
	 *
	 * @access  public
	 * @param	fields_and_values : an array with the fields to update like array('path' => 'path_to_page', 'content' => 'content in html format', ...)
	 * @return	true if it worked ok
	 */
	 function add_page($fields_and_values)
    {
		$this->load->helper('string');
		
		$q = 'INSERT INTO pages (';
		$nb = count($fields_and_values);
		$i = 0;
		foreach ($fields_and_values as $key => $value)
		{
			if ($i < $nb-1) 
			{
				$q .= $key.', ';
			} else 
			{
				$q .= $key.') VALUES (';
			}
			$i++;
		}
		
		$i = 0;
		foreach ($fields_and_values as $key => $value)
		{
			if ($i < $nb-1) 
			{
				$q .= $this->db->escape($value).', ';
			} else 
			{
				$q .= $this->db->escape($value).') ';
			}
			$i++;
		}
		
		$s = '[models/page_model:add_page] sql query = '.$q;
		log_message('debug',$s);
		
		return $this->db->simple_query($q);
    }	 
}

/* End of file page_model.php */
/* Location: ./system/application/model/page_model.php */
