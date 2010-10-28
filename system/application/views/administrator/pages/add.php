<div id="box">
<h2>Add page</h2>
<div class="error_message">
<?php echo validation_errors(); ?>
</div>
<form action="/administrator/pages/add" method="post">
	<label for="title">title</label>
	<input type="text" name="title" value="<?php echo set_value('title'); ?>"/>
	<label for="path">path</label>
	<input type="text" name="path" value="<?php echo set_value('path'); ?>"/>
	<label for="datetime">datetime</label>
	<input type="text" name="datetime" id="datetime" value="<?php echo set_value('datetime'); ?>"/>
	<label for="content">content</label>
	<textarea name="content" cols="80" rows="20" id="markItUp"><?php echo set_value('content'); ?></textarea>
	<input type="hidden" name="lang" value="en_EN"/>
	<br/>
	<input class="button" type="submit" name="submit" value="submit"  />
</form>
<p><a href="/administrator/pages" class="cancel"><- Cancel</a></p>
</div>
