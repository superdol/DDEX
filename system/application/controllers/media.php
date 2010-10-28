<?php
class Media extends Controller {
	
	function img()
	{
		$width = FALSE;
		$height = FALSE;
		$path = '';
		
		$n = $this->uri->total_segments();
		
		// check template http://www.mydomain/com/index.php/media/img/100w100h/local/path/to/image/in/dynamic_img folder
		if ($n >= 3) 
		{
			if (preg_match('/^(\d*)w(\d*)h$/',$this->uri->segment(3),$matches)) 
			{
				$width = $matches[1];
				$height = $matches[2];
			}
			elseif (preg_match('/^(\d*)w$/',$this->uri->segment(3),$matches)) 
			{
				$width = $matches[1];
			}
			elseif (preg_match('/^(\d*)h$/',$this->uri->segment(3),$matches)) 
			{
				$height = $matches[1];
			}
			
			if ($width || $height) 
			{
				for ($i=4;$i<$n;$i++) 
				{
					$path = $path.$this->uri->segment($i).'/';
				}
				$path = $path.$this->uri->segment($n);
			} else 
			{
				for ($i=3;$i<$n;$i++) 
				{
					$path = $path.$this->uri->segment($i).'/';
				}
				$path = $path.$this->uri->segment($n);			
			}
		}
		
		$this->config->load('myapp_settings');
		$folder = $this->config->item('dynamic_img_folder_path');
		$full_path = $folder.'/'.$path;

		$this->load->model('media_model');		
		$this->media_model->get_image($full_path,$width,$height);
	}
}

/* End of file media.php */
/* Location: ./system/application/controllers/media.php */
