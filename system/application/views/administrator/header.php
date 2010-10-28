<?php echo doctype(); ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<?php 
		echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
	
		echo link_tag('/css/reset.css');
		echo link_tag('/css/ui-lightness/jquery-ui-1.8.5.custom.css');
		echo link_tag('/css/backoffice.css');
		
		if ($this->agent->browser()=="Internet Explorer" && $this->agent->version() < 7) {
			echo link_tag('css/ie6.css');
		}		
	?>

	<title><?php if (isset($title)) { echo $title; } ?></title>
	
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-1.8.5.custom.min.js"></script>	

	<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.min.js"></script>

	<script type="text/javascript" src="/markitup/jquery.markitup.js"></script>
	<script type="text/javascript" src="/markitup/sets/html/set.js"></script>
	<link rel="stylesheet" type="text/css" href="/markitup/skins/markitup/style.css" />
	<link rel="stylesheet" type="text/css" href="/markitup/sets/html/style.css" />

	<script type="text/javascript" src="/js/backoffice.js"></script>
		
	<?php if (isset($metas)) { echo meta($metas); } ?>
	
</head>

<body>
<div id="wrapper">
	<div id="header">
		<a href="/" title="Home" id="logo"><?php echo heading(img('images/header_logo.png'), 1); ?></a>
		<div id="navigation" class="<?php if (isset($section)) { echo $section; } ?>">			
			<ul id="menu">
				<li class="sub_menu">
					<a href="/administrator/dashboard" class="sub_menu_title">dashboard</a>
				</li>
				<li class="sub_menu">
					<a href="/administrator/pages" class="sub_menu_title">pages</a>
				</li>
				<li class="sub_menu">
					<a href="/administrator/news" class="sub_menu_title">news</a>
				</li>
				<!--
				<li class="sub_menu">
					<span class="sub_menu_title">catalog</span>
					<ul>
						<li><a href="/administrator/labels">labels</a></li>
						<li><a href="/administrator/artists">artists</a></li>
						<li><a href="/administrator/releases">releases</a></li>
					</ul>
				</li>
				-->
				<li class="sub_menu">
					<a href="/administrator/logout" class="sub_menu_title">logout</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="content">
		<div id="main_content">