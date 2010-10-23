<div id="latest-news">
<div class="news-item first">
<h2><a href="/<?php print $page->path; ?>"><?php print $page->title; ?></a></h2>
<p class="news-content"><?php echo $page->content; ?></p>
<div class="social-media">
	<ul>
		<li class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="ddex" data-lang="fr">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>
		<li class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(site_url('/news/'.$page->path));?>&amp;layout=button_count&amp;show_faces=true&amp;width=150&amp;action=like&amp;colorscheme=light&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:20px;" allowTransparency="true"></iframe></li>
	</ul>
</div>	
</div>
</div>