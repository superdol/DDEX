<?php echo doctype(); ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<?php 
		echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
	
		echo link_tag('/css/reset.css');
		echo link_tag('/css/backoffice.css');
		
		if ($this->agent->browser()=="Internet Explorer" && $this->agent->version() < 7) {
			echo link_tag('css/ie6.css');
		}		
	?>

	<title><?php if (isset($title)) { echo $title; } ?></title>
	
	<script type="text/javascript" src="/js/jquery.js"></script>
		
	<?php if (isset($metas)) { echo meta($metas); } ?>
	
</head>

<body>
<div id="wrapper">
	<div id="header">
		<a href="/" title="Home" id="logo"><?php echo heading(img('images/header_logo.png'), 1); ?></a>
		<!--
		<div id="navigation" class="<?php if (isset($section)) { echo $section; } ?>">			
			<ul id="globalnav">
				<li id="gn-home"><a href="/administrator">Home</a></li>
				<li id="gn-news"><a href="/news/">News</a></li> 
			</ul>
		</div>
		-->
	</div>
	<div id="content">
		<div id="main_content">