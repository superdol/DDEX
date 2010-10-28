<?php
class News_model extends Model {
    function News_model()
    {
        parent::Model();
    }
	
	/**
	 * get_number_of_news
	 *
	 * return the number of news in the database
	 *
	 * @access   public
	 * @param	lang	the language used for descriptions (optional)
	 * @return	number of news
	 */	
	 function get_number_of_news($lang)
	 {
		if (isset($lang)) {		
			$q = "SELECT COUNT(*) AS total FROM news WHERE lang = ?";
			$data = array($lang);
			$query = $this->db->query($q,$data);
			$result = $query->result();
			$nb = $result[0]->total;
			return $nb;
		} else {
			$q = "SELECT COUNT(*) AS total FROM news";
			$data = array($lang);
			$query = $this->db->query($q,$data);
			$result = $query->result();
			$nb = $result[0]->total;
			return $nb;
		}
	 }
	 
	/**
	 * get_news
	 *
	 * return a number of news starting at offset 
	 *
	 * @access   public
	 * @param	lang	the language used for descriptions (optional)
	 * @param	offset	the first news to return (starts at 0)
	 * @param	number	max number of news to return
	 * @return	an array of news object with the following properties
	 *			id : an id
	 *			path : the path in the url under /news
	 *			title : the news title
	 *			content : content of the news
	 *			datetime : the date/time of the news
	 *			hires_image_path : the path to a hires image under dynamic_img
	 *			mp3_url : the url of a mp3 linked to that news
	 *			youtube_id : the id of a youtube video linked to that news
	 *			other_link_url : a URL linked to that news
	 */
    function get_news($lang,$offset,$number)
    {
		if (!isset($offset)) $offset = 0;
		if (!isset($number)) $number = 5;
		
		if ($lang) {
			$q= "SELECT * FROM news WHERE lang = ? ORDER BY datetime DESC LIMIT ?,?";
			$data = array($lang,$offset,$number);
			$query = $this->db->query($q,$data);
			return $query->result();
		} else {
			$q= "SELECT * FROM news ORDER BY datetime DESC LIMIT ?,?";
			$data = array($offset,$number);
			$query = $this->db->query($q,$data);
			return $query->result();		
		}
    }

	/**
	 * get_news_by_path
	 *
	 * return a specific news
	 *
	 * @access   public
	 * @param	lang	the language used for descriptions
	 * @param	path : the path in the URL under /news
	 * @return	a news object with the following properties
	 *			id : an id
	 *			path : the path in the url under /news
	 *			title : the news title
	 *			content : content of the news
	 *			datetime : the date/time of the news
	 *			hires_image_path : the path to a hires image under dynamic_img
	 *			mp3_url : the url of a mp3 linked to that news
	 *			youtube_id : the id of a youtube video linked to that news
	 *			other_link_url : a URL linked to that news
	 */    
	 function get_news_by_path($lang,$path)
    {
		$q= "SELECT * FROM news WHERE lang = ? AND path = ?";
		$data = array($lang,$path);
		$query = $this->db->query($q,$data);
      return $query->row();
    }
	 
	/**
	 * get_news_by_id
	 *
	 * return a specific news
	 *
	 * @access   public
	 * @param	lang	the language used for descriptions
	 * @param	id : the news id
	 * @return	a news object with the following properties
	 *			id : an id
	 *			path : the path in the url under /news
	 *			title : the news title
	 *			content : content of the news
	 *			datetime : the date/time of the news
	 *			hires_image_path : the path to a hires image under dynamic_img
	 *			mp3_url : the url of a mp3 linked to that news
	 *			youtube_id : the id of a youtube video linked to that news
	 *			other_link_url : a URL linked to that news
	 */
	function get_news_by_id($id)
	{
		$q= "SELECT * FROM news WHERE id = ?";
		$data = array($id);
		$query = $this->db->query($q,$data);
		return $query->row();
	}	 
	
	/**
	 * update_news
	 *
	 * @access   public
	 * @param	id : the news id
	 * @param	fields_and_values : an array with the fields to update like array('path' => 'path_to_news', 'content' => 'content in html format', ...)
	 * @return	true if it worked ok
	 
	 */
	 function update_news($id,$fields_and_values)
    {
		$this->load->helper('string');
		
		$q = 'UPDATE news SET ';
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
		
		$s = '[models/news_model:update_news] sql query = '.$q;
		log_message('debug',$s);
		
		return $this->db->simple_query($q);
    }
	 
	/**
	 * remove_news
	 *
	 * @access  public
	 * @param	id : the news id
	 * @return	true if it worked ok
	 */
	 function remove_news($id)
    {
		$q = "DELETE FROM news WHERE id=$id";
		return $this->db->simple_query($q);
    }	 	 
	 
	/**
	 * add_news
	 *
	 * @access  public
	 * @param	fields_and_values : an array with the fields to update like array('path' => 'path_to_news', 'content' => 'content in html format', ...)
	 * @return	true if it worked ok
	 */
	 function add_news($fields_and_values)
    {
		$this->load->helper('string');
		
		$q = 'INSERT INTO news (';
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
		
		$s = '[models/news_model:add_news] sql query = '.$q;
		log_message('debug',$s);
		
		return $this->db->simple_query($q);
    }	 
}

/* End of file news_model.php */
/* Location: ./system/application/model/news_model.php */
