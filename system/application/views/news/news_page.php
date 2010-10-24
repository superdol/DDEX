<div id="latest-news">
<div class="news-item first">
<h2><a href="/news/<?php print $news->path; ?>"><?php print $news->title; ?></a></h2>
<p class="news-date">Posted on <span class="date-item"><?php echo date('jS F Y', strtotime($news->datetime)); ?></span></p>
<?php if ($news->hires_image_path) {?>
	<p><img class="news-image" src="/media/img/220w/<?php print $news->hires_image_path; ?>" /></p>
<?php } ?>
<p class="news-content"><?php echo $news->content; ?></p>
<?php if ($news->youtube_id) { ?>
<div class="news-video">
	<object width="560" height="315">
		<param name="movie" value="<?php print 'http://www.youtube.com/v/'.$news->youtube_id; ?>"></param>
		<param name="allowFullScreen" value="true"></param>
		<param name="allowscriptaccess" value="always"></param>
		<embed src="<?php print 'http://www.youtube.com/v/'.$news->youtube_id; ?>" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="560" height="315"></embed>
	</object>
</div>
<?php } ?>
<?php if ($news->mp3_url ) { ?>
	<p class="news-mp3"><a href="<?php print $news->mp3_url ?>">download mp3</a></p>
<?php } ?>
<?php if ($news->other_link_url  ) { ?>
	<p class="news-other-link">see also : <a href="<?php print $news->other_link_url ?>"><?php print $news->other_link_url ?></a></p>
<?php } ?>
<div class="social-media">
	<ul>
						<li class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="ddex" data-lang="fr">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>
		<li class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(site_url('/news/'.$news->path));?>&amp;layout=button_count&amp;show_faces=true&amp;width=150&amp;action=like&amp;colorscheme=light&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:20px;" allowTransparency="true"></iframe></li>
	</ul>
</div>	
</div>
</div>