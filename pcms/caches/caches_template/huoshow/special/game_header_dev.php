<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>" />
	<meta name="description" content="<?php echo $SEO['description'];?>" />
	<meta name='author' content='Steven' />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> -->
	<!-- <link href="<?php echo CSS_PATH;?>special/<?php echo $css_file;?>" rel="stylesheet" /> -->
	<link href="<?php echo CSS_PATH;?>special/index-game-blue.css" rel="stylesheet" />
	<!-- <link href="<?php echo CSS_PATH;?>special/index-game-black.css" rel="stylesheet" /> -->
	<script src="<?php echo JS_PATH;?>jquery-1.7.2.min.js"></script>
	<!-- <script src="<?php echo JS_PATH;?>jquery.cookie.js"></script> -->
	<!-- <script src="<?php echo JS_PATH;?>jquery.form.min.js"></script> -->
	<!-- <script src="<?php echo JS_PATH;?>artDialog/jquery.artDialog.js?skin=default"></script> -->
	<!-- <script src="<?php echo JS_PATH;?>jquery.sgallery.js"></script> -->
	<script src="<?php echo JS_PATH;?>myfocus-2.0.4.min.js"></script>
	<script src="<?php echo JS_PATH;?>jtools.js"></script>
	<script id='mainjs' src="<?php echo JS_PATH;?>special/index-game.js"></script>
	<script src="<?php echo JS_PATH;?>cssrefresh.js"></script>
	<!-- <script src="http://fbug.googlecode.com/svn/lite/branches/firebug1.4/content/firebug-lite-dev.js"></script> -->
	<link href='/favicon.ico' rel='icon' />
</head>

<!-- <body id='special-channel-black' class="special-channel"> -->
<body id='index-game-blue' class="page-list"> <!-- 列表页添加类 page-list | 列表页添加类 index-game -->
	<?php include template('content', 'hs_topbar'); ?>

	<!-- Header -->
	<div id="header">
		<div class='wrapper fn-clear'>
			<h1 class='logo'><a href='###' title='火秀' hidefocus='true'>火秀</a></h1>

			<form id="search" class='search' name="search" method="post" action="/index.php?m=community&c=index&a=search" target="_blank">
				<input type="text" class="search-wd" name="q" value='请输入游戏名称...' />
				<button type="submit" class="search-submit">搜索</button>
				<!-- <button type='button' class="search-advance">高级搜索</button> -->
			</form>
		</div>
	</div>
	<!-- Header End -->

	<!-- Nav -->
	<div id="nav">
		<ul class='nav-list fn-clear'>
			<li class='nav-list-item<?php if($NAV[id] != id) { ?> nav-list-item-current<?php } ?>'><a href='#' title='' hidefocus='true'>游戏视频</a></li>
			<li class='nav-list-item<?php if($NAV[id] == id) { ?> nav-list-item-current<?php } ?>'><a href='#' title='' hidefocus='true'>游戏图片</a></li>
			<li class='nav-list-item<?php if($NAV[id] == id) { ?> nav-list-item-current<?php } ?>'><a href='#' title='' hidefocus='true'>产品库</a></li>
			<li class='nav-list-item<?php if($NAV[id] == id) { ?> nav-list-item-current<?php } ?>'><a href='#' title='' hidefocus='true'>新闻列表</a></li>
		</ul>
	</div>
	<!-- Nav End -->