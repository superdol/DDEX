<?php echo doctype(); ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<?php 
		echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
	
		echo link_tag('css/reset.css');
		echo link_tag('css/main.css');
		
		if ($this->agent->browser()=="Internet Explorer" && $this->agent->version() < 7) {
			echo link_tag('css/ie6.css');
		}		
	?>

	<title><?php if (isset($title)) { echo $title; } ?></title>
	
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery.cycle.all.min.js"></script>
	
	<?php if (isset($metas)) { echo meta($metas); } ?>
	
</head>

<body>
<div id="header">
	<div class="wrapper">
		<a href="/" title="Home" id="logo"><img src="/images/header_logo_24.png" width="146" height="94" alt="Header Logo"></a>
		<div id="navigation" class="<?php if (isset($section)) { echo $section; } ?>">			
			<div id="helpnav">
				<h3>How DDEX Can Help You?</h3>
				<ul>
					<li><a href="/">Record Labels</a></li>
					<li><a href="/">Digital Service Providers</a></li>
					<li><a href="/">Publishers</a></li>
					<li><a href="/">Collecting Societies</a></li>
				</ul>
			</div>
			<div id="learnnav">
				<h3>Learn More About Us</h3>

						<ul>
							<li><a href="/">News</a></li>
							<li><a href="/">Events</a></li>
							<li><a href="/">Press Releases</a></li>
							<li><a href="/">FAQs</a></li>
						</ul>
						<ul class="col2">
							<li><a href="/">Organisation</a></li>
							<li><a href="/">Membership</a></li>
							<li><a href="/">Current Members</a></li>
							<li><a href="/">DDEX Implementors</a></li>
						</ul>
						<ul class="col3">
							<li><a href="/">Develop With DDEX</a></li>
							<li><a href="/">Contact Us</a></li>
							<li><a href="/">Join DDEX</a></li>
						</ul>			
			</div>
		</div>
	</div>
</div>
<div id="subheader">
	<div class="wrapper">
		<p>DDEX HOME</p>	
	</div>
</div>