<div id="box">
<h2>Add news</h2>
<div class="error_message">
<?php echo validation_errors(); ?>
</div>
<form action="/administrator/news/add" method="post">
	<label for="title">title</label>
	<input type="text" name="title" value="<?php echo set_value('title'); ?>"/>
	<label for="path">path</label>
	<input type="text" name="path" value="<?php echo set_value('path'); ?>"/>
	<label for="datetime">datetime</label>
	<input type="text" name="datetime" id="datetime" value="<?php echo set_value('datetime'); ?>"/>
	<label for="content">content</label>
	<textarea name="content" cols="80" rows="20" id="markItUp"><?php echo set_value('content'); ?></textarea>
	<label for="hires_image_path">hires_image_path</label>
	<input type="text" name="hires_image_path" value="<?php echo set_value('hires_image_path'); ?>"/>
	<label for="mp3_url">mp3_url</label>
	<input type="text" name="mp3_url" value="<?php echo set_value('mp3_url'); ?>"/>
	<label for="youtube_id">youtube_id</label>
	<input type="text" name="youtube_id" value="<?php echo set_value('youtube_id'); ?>"/>
	<label for="other_link_url">other_link_url</label>
	<input type="text" name="other_link_url" value="<?php echo set_value('other_link_url'); ?>"/>
	<label for="lang">language</label>
	<input type="text" name="lang" value="<?php echo set_value('lang'); ?>"/>
	<br/>
	<input class="button" type="submit" name="submit" value="submit"  />
</form>
<p><a href="/administrator/news" class="cancel"><- Cancel</a></p>
</div>
