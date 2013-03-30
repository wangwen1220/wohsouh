<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title><?php if($info[name] !="") { ?><?php echo $title;?>_<?php echo $info['name'];?><?php } else { ?><?php echo $top_title;?><?php } ?>_火秀游戏库</title>
	<meta name="keywords" content="<?php echo $keyword;?>" />
	<meta name="description" content="<?php echo $description;?>" />
	<meta name='author' content='Steven' />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> -->
	 <link href="<?php echo CSS_PATH;?>special/<?php echo $css_file;?>" rel="stylesheet" /> 
	<script src="<?php echo JS_PATH;?>jquery-1.7.2.min.js"></script>
	<script src="<?php echo JS_PATH;?>myfocus-2.0.4.min.js"></script>
	<script src="<?php echo JS_PATH;?>jtools.js"></script>
	<script id='mainjs' src="<?php echo JS_PATH;?>special/index-game.js"></script>
	<!-- <script src="<?php echo JS_PATH;?>cssrefresh.js"></script> -->
	<!-- <script src="http://fbug.googlecode.com/svn/lite/branches/firebug1.4/content/firebug-lite-dev.js"></script> -->
	<link href='/favicon.ico' rel='icon' />
</head>

<!-- <body id='special-channel-black' class="special-channel"> -->
<body class="index-game"> <!-- 列表页添加类 page-list | 列表页添加类 index-game -->
	<?php include template('content', 'hs_topbar'); ?>

	<!-- Header -->
	<div id="header">
		<div class='wrapper fn-clear'>
			<h1 class='logo'><a target='_blank' href='http://game.huoshow.com/' title='火秀' hidefocus='true'>火秀</a></h1>

			<form id="search" class='search' name="search" method="get" action="<?php echo APP_PATH;?>index.php" target="_blank">
			        <input type="hidden" value="search" name="app" />
					<input type="hidden" value="index" name="controller" />
					<input type="hidden" value="search" name="action" />
					<input type="hidden" name="m" value="search" />
					<input type="hidden" name="c" value="index" />
					<input type="hidden" name="a" value="init" />
					<input type="hidden" name="typeid" value="1" id="typeid" />
				    <input type="text" class="search-wd" name="q" value='请输入游戏名称...' />
					<!--<label for='search-wd'>站内搜索</label>
					<div id='jselect' class='jselect'>
						<cite class='selected'>全部</cite>
						<?php $search_model = getcache('search_model_'.$siteid,'search');?>
						<ul class='options'>
							<li><a class='option' hidefocus='true' href="javascript:;" selectid="1">全部</a></li>
							<?php $n=1;if(is_array($search_model)) foreach($search_model AS $k=>$v) { ?>
							<li><a class='option' hidefocus='true' href="javascript:;" selectid="<?php echo $v['typeid'];?>"><?php echo $v['name'];?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
					</div><input type="text" id="search-wd" name="q" />-->
				<button type="submit" id="search-submit">搜 索</button>
				<!-- <button type='button' class="search-advance">高级搜索</button> -->
			</form>
		</div>
	</div>
	<!-- Header End -->

	<!-- Nav -->
	<?php if(count($nav_arr)>0) { ?>
	<!-- 导航 -->
	<div id="nav">
	<ul class='nav-list fn-clear'>
	<?php $n=1; if(is_array($nav_arr)) foreach($nav_arr AS $r => $v) { ?>
	<li class='nav-list-item<?php if($NAV[id] == id) { ?> nav-list-item-current<?php } ?>'><a href='<?php echo $v['url'];?>' target='_blank' hidefocus='true'><?php echo $v['name'];?></a></li>
	<?php $n++;}unset($n); ?>
	</ul>
	</div>
	<?php } ?>
	<!-- Nav End -->