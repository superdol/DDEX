<div id="box">
<h2>Editing page #<?php echo $page->id ?></h2>
<div class="error_message">
<?php echo validation_errors(); ?>
</div>
<form action="/administrator/pages/edit/<?php echo $page->id ?>" method="post">
	<input type="hidden" name="id" value="<?php echo $page->id ?>">
	<label for="title">title</label>
	<input type="text" name="title" value="<?php echo $page->title ?>"/>
	<label for="path">path</label>
	<input type="text" name="path" value="<?php echo $page->path ?>"/>
	<label for="datetime">datetime</label>
	<input type="text" name="datetime" id="datetime" value="<?php echo $page->datetime ?>"/>
	<label for="content">content</label>
	<textarea name="content" cols="80" rows="20" id="markItUp"><?php echo $page->content ?></textarea>
	<input class="button" type="submit" name="submit" value="submit"  />
	<input type="hidden" name="lang" value="en_EN"/>
</form>
<p><a href="/administrator/pages" class="cancel"><- Cancel</a></p>
</div>
