<div id="box">
<h2>Editing news #<?php echo $news->id ?></h2>
<div class="error_message">
<?php echo validation_errors(); ?>
</div>
<form action="/administrator/news/edit/<?php echo $news->id ?>" method="post">
	<input type="hidden" name="id" value="<?php echo $news->id ?>">
	<label for="title">title</label>
	<input type="text" name="title" value="<?php echo $news->title ?>"/>
	<label for="path">path</label>
	<input type="text" name="path" value="<?php echo $news->path ?>"/>
	<label for="datetime">datetime</label>
	<input type="text" name="datetime" id="datetime" value="<?php echo $news->datetime ?>"/>
	<label for="content">content</label>
	<textarea name="content" cols="80" rows="20" id="markItUp"><?php echo $news->content ?></textarea>
	<label for="hires_image_path">hires_image_path</label>
	<input type="text" name="hires_image_path" value="<?php echo $news->hires_image_path ?>"/>
	<label for="mp3_url">mp3_url</label>
	<input type="text" name="mp3_url" value="<?php echo $news->mp3_url ?>"/>
	<label for="youtube_id">youtube_id</label>
	<input type="text" name="youtube_id" value="<?php echo $news->youtube_id ?>"/>
	<label for="other_link_url">other_link_url</label>
	<input type="text" name="other_link_url" value="<?php echo $news->other_link_url ?>"/>
	<input type="hidden" name="lang" value="en_EN"/>
	<br/>
	<input class="button" type="submit" name="submit" value="submit"  />
</form>
<p><a href="/administrator/news" class="cancel"><- Cancel</a></p>
</div>
