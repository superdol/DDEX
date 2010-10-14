<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
	<link rel="stylesheet" href="<?php print base_url(); ?>css/reset.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="<?php print base_url(); ?>css/main.css" type="text/css" media="screen" charset="utf-8" />
	
	<!--[if lt IE 7]>
		<link rel="stylesheet" href="<?php print base_url(); ?>css/ie6.css" type="text/css" media="screen" charset="utf-8" />
	<![endif]-->	

	<title><?php if (isset($title)) { echo $title; } ?></title>
	<?php if (isset($metas)) { foreach ($metas as $meta) { ?>
	<meta property="<?php echo $meta['property']; ?>" content="<?php echo $meta['content']; ?>" />
	<?php } }  ?>
</head>

<body>
<div id="wrapper">
	<div id="header">
		<p>DDEX public website administration</p>
	</div>
	<div id="content">
