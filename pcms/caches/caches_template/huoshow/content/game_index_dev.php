<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>游戏首页 - 火秀网</title>
	<meta name='keywords' content='火秀网络游戏' />
	<meta name='description' content='火秀网络游戏' />
	<meta name='author' content='火秀网' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href='<?php echo CSS_PATH;?>hs-game-index.css' rel='stylesheet' />
	<script src='<?php echo JS_PATH;?>cssrefresh.js'></script>
	<!-- <script src='<?php echo JS_PATH;?>live.js'></script> -->
	<link href='/favicon.ico' rel='icon' />
</head>

<body class='game-index'>
	<?php include template('content', 'hs_topbar'); ?>

	<!-- Header -->
	<div id="header" class='fn-clear'>
		<h1 class='logo'><a href="http://www.huoshow.com/" title="火秀游戏">火秀游戏</a></h1>

		<ul class='menu fn-clear'>
			<li class='menu-item menu-item-first'>
				<strong><a href='#'>新游戏</a></strong>
				<a href='#'>新闻</a>
				<a href='#'>截图</a>
				<a href='#'>视频</a>
			</li>
			<li class='menu-item'>
				<strong><a href='#'>网络游戏</a></strong>
				<a href='#'>新闻</a>
				<a href='#'>截图</a>
				<a href='#'>视频</a>
				<a href='#'>视频</a>
				<a href='#'>视频视频</a>
			</li>
			<li class='menu-item'>
				<strong><a href='#'>网页游戏</a></strong>
				<a href='#'>新闻</a>
				<a href='#'>截图图</a>
				<a href='#'>视频</a>
				<a href='#'>视频</a>
				<a href='#'>视频</a>
			</li>
			<li class='menu-item'>
				<strong><a href='#'>单机游戏</a></strong>
				<a href='#'>新闻闻</a>
				<a href='#'>截图</a>
				<a href='#'>视频</a>
				<a href='#'>视频视频</a>
			</li>
			<li class='menu-item'>
				<strong><a href='#'>手机游戏</a></strong>
				<a href='#'>iPhone</a>
				<a href='#'>安卓游戏</a>
				<a href='#'>Windows Phone</a>
			</li>
			<li class='menu-item menu-item-last'>
				<strong><a href='#'>游戏图库</a></strong>
				<a href='#'>新闻</a>
				<a href='#'>截图</a>
				<a href='#'>视频</a>
				<a href='#'>视频</a>
			</li>
		</ul>
	</div>

	<div class='ui-layout ad'><a href='#'><img src='http://pnews.huoshow.com/statics/images/common/middle_anner.png' width='960' height='60' /></a></div>

	<!-- 游戏列表 -->
	<div id='js-tab-game' class='ui-box ui-tab-game fn-clear'>
		<ul class='ui-tab-game-nav fn-clear'>
			<li class='ui-tab-game-nav-item ui-tab-game-nav-item-cur'><a class='online-game' href='javascript:;' hidefocus='true'>网络游戏</a></li>
			<li class='ui-tab-game-nav-item'><a class='web-game' href='javascript:;' hidefocus='true'>网页游戏</a></li>
			<li class='ui-tab-game-nav-item'><a class='pc-game' href='javascript:;' hidefocus='true'>单机游戏</a></li>
			<li class='ui-tab-game-nav-item'><a class='mobile-game' href='javascript:;' hidefocus='true'>手机游戏</a></li>
		</ul>
		<div class='ui-tab-game-cnt'>
			<div class='ui-tab-game-cnt-item ui-tab-game-cnt-item-cur'>
				<div class='ui-tab'>
					<div class='ui-tab-header fn-clear'>
						<ul class='ui-tab-nav fn-clear'>
							<li class='ui-tab-nav-item ui-tab-nav-item-hot ui-tab-nav-item-cur'>热门</li>
							<li class='ui-tab-nav-item'>ABCD</li>
							<li class='ui-tab-nav-item'>EFGH</li>
							<li class='ui-tab-nav-item'>IJKL</li>
							<li class='ui-tab-nav-item'>MNOP</li>
							<li class='ui-tab-nav-item'>QRST</li>
							<li class='ui-tab-nav-item'>WXYZ</li>
							<li class='ui-tab-nav-item'>新网游</li>
						</ul>
						<form class="search" action=''><input type='text' name='q' class='search-wd' value='请输入游戏名' /><a class='mic' href='javascript:;'></a><button type='submit' class='search-submit'>搜索</button></form>
					</div>
					<div class='ui-tab-cnt'>
						<ul class='ui-tab-cnt-item ui-game-list ui-tab-cnt-item-cur'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
					</div>
				</div>
				<div class='new-game'><strong>新游戏：</strong> <a href='#' target='_blank'>诛仙1</a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'><em>地下城与勇</em></a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'><em>诛仙地下城与</em></a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>地下城与勇</a></div>
			</div>
			<div class='ui-tab-game-cnt-item'>
				<div class='ui-tab'>
					<div class='ui-tab-header fn-clear'>
						<ul class='ui-tab-nav fn-clear'>
							<li class='ui-tab-nav-item ui-tab-nav-item-hot ui-tab-nav-item-cur'>网页</li>
							<li class='ui-tab-nav-item'>ABCD</li>
							<li class='ui-tab-nav-item'>EFGH</li>
							<li class='ui-tab-nav-item'>IJKL</li>
							<li class='ui-tab-nav-item'>MNOP</li>
							<li class='ui-tab-nav-item'>QRST</li>
							<li class='ui-tab-nav-item'>WXYZ</li>
							<li class='ui-tab-nav-item'>新网游</li>
						</ul>
						<form class="search" action=''><input type='text' name='q' class='search-wd' value='请输入游戏名' /><a class='mic' href='javascript:;'></a><button type='submit' class='search-submit'>搜索</button></form>
					</div>
					<div class='ui-tab-cnt'>
						<ul class='ui-tab-cnt-item ui-game-list ui-tab-cnt-item-cur'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
					</div>
				</div>
				<div class='new-game'><strong>新游戏：</strong> <a href='#' target='_blank'>诛仙1</a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'><em>地下城与勇</em></a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'><em>诛仙地下城与</em></a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>地下城与勇</a></div>
			</div>
			<div class='ui-tab-game-cnt-item'>
				<div class='ui-tab'>
					<div class='ui-tab-header fn-clear'>
						<ul class='ui-tab-nav fn-clear'>
							<li class='ui-tab-nav-item ui-tab-nav-item-hot ui-tab-nav-item-cur'>单机</li>
							<li class='ui-tab-nav-item'>ABCD</li>
							<li class='ui-tab-nav-item'>EFGH</li>
							<li class='ui-tab-nav-item'>IJKL</li>
							<li class='ui-tab-nav-item'>MNOP</li>
							<li class='ui-tab-nav-item'>QRST</li>
							<li class='ui-tab-nav-item'>WXYZ</li>
							<li class='ui-tab-nav-item'>新网游</li>
						</ul>
						<form class="search" action=''><input type='text' name='q' class='search-wd' value='请输入游戏名' /><a class='mic' href='javascript:;'></a><button type='submit' class='search-submit'>搜索</button></form>
					</div>
					<div class='ui-tab-cnt'>
						<ul class='ui-tab-cnt-item ui-game-list ui-tab-cnt-item-cur'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
					</div>
				</div>
				<div class='new-game'><strong>新游戏：</strong> <a href='#' target='_blank'>诛仙1</a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'><em>地下城与勇</em></a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'><em>诛仙地下城与</em></a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>地下城与勇</a></div>
			</div>
			<div class='ui-tab-game-cnt-item'>
				<div class='ui-tab'>
					<div class='ui-tab-header fn-clear'>
						<ul class='ui-tab-nav fn-clear'>
							<li class='ui-tab-nav-item ui-tab-nav-item-hot ui-tab-nav-item-cur'>手机</li>
							<li class='ui-tab-nav-item'>ABCD</li>
							<li class='ui-tab-nav-item'>EFGH</li>
							<li class='ui-tab-nav-item'>IJKL</li>
							<li class='ui-tab-nav-item'>MNOP</li>
							<li class='ui-tab-nav-item'>QRST</li>
							<li class='ui-tab-nav-item'>WXYZ</li>
							<li class='ui-tab-nav-item'>新网游</li>
						</ul>
						<form class="search" action=''><input type='text' name='q' class='search-wd' value='请输入游戏名' /><a class='mic' href='javascript:;'></a><button type='submit' class='search-submit'>搜索</button></form>
					</div>
					<div class='ui-tab-cnt'>
						<ul class='ui-tab-cnt-item ui-game-list ui-tab-cnt-item-cur'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
						<ul class='ui-tab-cnt-item ui-game-list'>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙1</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>鹿鼎记</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>QQ炫舞</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>西游 3</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>NBA2K</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>梦幻西游</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>英雄三国</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>极光世界</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>地下城与勇士</a></li>

							<li class='ui-game-list-item'><a href='#' target='_blank'>诛仙</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>赤壁</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>征途</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'>功夫英雄</a></li>
							<li class='ui-game-list-item'><a href='#' target='_blank'><em>梦幻西游</em></a></li>
						</ul>
					</div>
				</div>
				<div class='new-game'><strong>新游戏：</strong> <a href='#' target='_blank'>诛仙1</a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'><em>地下城与勇</em></a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'><em>诛仙地下城与</em></a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>诛仙2</a> | <a href='#' target='_blank'>地下城与勇</a> | <a href='#' target='_blank'>地下城与勇</a></div>
			</div>
		</div>
	</div>

	<!-- 主内容 -->
	<div id='content-main' class='ui-layout fn-clear'>
		<div class='ui-layout-item ui-layout-item-side'>
			<div class='ui-box ui-box-game'>
				<div class='ui-header'>
					<h3 class='title'>热门网游</h3>
					<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
				</div>
				<table class='ui-game-table'>
					<thead>
						<tr>
							<th class='time'>时间</th>
							<th class='name'>游戏名</th>
							<th class='status'>状态</th>
							<th class='btn'>拿号</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class='time'>10-27</td>
							<td class='name'><a href='#'>仙剑奇侠</a></td>
							<td class='status'>公测</td>
							<td class='btn btn-order'><a href='#'>订</a></td>
						</tr>
						<tr>
							<td class='time'>10-26</td>
							<td class='name'><a href='#'>人见人爱</a></td>
							<td class='status'>内测</td>
							<td class='btn btn-get'><a href='#'>领</a></td>
						</tr>
						<tr>
							<td class='time'>10-27</td>
							<td class='name'><a href='#'>仙剑奇侠</a></td>
							<td class='status'>公测</td>
							<td class='btn btn-order'><a href='#'>订</a></td>
						</tr>
						<tr>
							<td class='time'>10-26</td>
							<td class='name'><a href='#'>人见人爱</a></td>
							<td class='status'>内测</td>
							<td class='btn btn-get'><a href='#'>领</a></td>
						</tr>
						<tr>
							<td class='time'>10-27</td>
							<td class='name'><a href='#'>仙剑奇侠</a></td>
							<td class='status'>公测</td>
							<td class='btn btn-order'><a href='#'>订</a></td>
						</tr>
						<tr>
							<td class='time'>10-26</td>
							<td class='name'><a href='#'>人见人爱</a></td>
							<td class='status'>内测</td>
							<td class='btn btn-get'><a href='#'>领</a></td>
						</tr>
						<tr>
							<td class='time'>10-27</td>
							<td class='name'><a href='#'>仙剑奇侠</a></td>
							<td class='status'>公测</td>
							<td class='btn btn-order'><a href='#'>订</a></td>
						</tr>
						<tr>
							<td class='time'>10-26</td>
							<td class='name'><a href='#'>人见人爱</a></td>
							<td class='status'>内测</td>
							<td class='btn btn-get'><a href='#'>领</a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class='ui-box ui-box-game'>
				<div class='ui-header'>
					<h3 class='title'>热门网游</h3>
					<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
				</div>
				<table class='ui-game-table'>
					<thead>
						<tr>
							<th class='time'>时间</th>
							<th class='name'>游戏名</th>
							<th class='status'>状态</th>
							<th class='btn'>拿号</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class='time'>10-27</td>
							<td class='name'><a href='#'>仙剑奇侠</a></td>
							<td class='status'>公测</td>
							<td class='btn btn-order'><a href='#'>订</a></td>
						</tr>
						<tr>
							<td class='time'>10-26</td>
							<td class='name'><a href='#'>人见人爱</a></td>
							<td class='status'>内测</td>
							<td class='btn btn-get'><a href='#'>领</a></td>
						</tr>
						<tr>
							<td class='time'>10-27</td>
							<td class='name'><a href='#'>仙剑奇侠</a></td>
							<td class='status'>公测</td>
							<td class='btn btn-order'><a href='#'>订</a></td>
						</tr>
						<tr>
							<td class='time'>10-26</td>
							<td class='name'><a href='#'>人见人爱</a></td>
							<td class='status'>内测</td>
							<td class='btn btn-get'><a href='#'>领</a></td>
						</tr>
						<tr>
							<td class='time'>10-27</td>
							<td class='name'><a href='#'>仙剑奇侠</a></td>
							<td class='status'>公测</td>
							<td class='btn btn-order'><a href='#'>订</a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class='ui-box ui-box-game'>
				<div class='ui-header'>
					<h3 class='title'>热门网游</h3>
					<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
				</div>
				<ol class='ui-list-plus'>
					<li class='ui-list-plus-item'><span class='num num-hot'>1</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a></li>
					<li class='ui-list-plus-item'><span class='num num-hot'>2</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a></li>
					<li class='ui-list-plus-item'><span class='num num-hot'>3</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a></li>
					<li class='ui-list-plus-item'><span class='num'>4</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a></li>
					<li class='ui-list-plus-item'><span class='num'>5</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a></li>
					<li class='ui-list-plus-item'><span class='num'>6</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a></li>
					<li class='ui-list-plus-item'><span class='num'>7</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a></li>
					<li class='ui-list-plus-item'><span class='num'>8</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a></li>
				</ol>
			</div>
		</div>

		<div class='ui-layout-item ui-layout-item-main'>
			<div id='myfocus-kiki-top' class='ui-myfocus'>
				<div class="loading"></div>
				<div class="pic">
					<ul>
						<li><a href="#1"><img src="http://p5.qhimg.com/t014c3cbc463b792a8a.jpg" thumb="" alt="版权属于作者，图片2来源于网络" width='440' height='200' /></a></li>
						<li><a href="#2"><img src="http://p9.qhimg.com/t0149f2ab2491a29c6e.jpg" thumb="" alt="版权属于作者，图片2来源于网络" width='440' height='200' /></a></li>
						<li><a href="#3"><img src="http://p0.qhimg.com/t01103ba1d12acddb4e.jpg" thumb="" alt="图片3来源于网络，版权属于作者" width='440' height='200' /></a></li>
						<li><a href="#4"><img src="http://p7.qhimg.com/t019ac17a1905d2f952.jpg" thumb="" alt="版权属于作者，图片4来源于网络" width='440' height='200' /></a></li>
						<li><a href="#5"><img src="http://p8.qhimg.com/t01b94dd5384268cda1.jpg" thumb="" alt="图片5来源于网络，版权属于作者" width='440' height='200' /></a></li>
					</ul>
				</div>
			</div>

			<div class='ui-tab ui-tab-easy'>
				<div class='ui-tab-header fn-clear'>
					<ul class='ui-tab-nav fn-clear'>
						<li class='ui-tab-nav-item ui-tab-nav-item-cur'>今日要闻</li>
						<li class='ui-tab-nav-item'>图片推荐</li>
					</ul>
					<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
				</div>
				<div class='ui-tab-cnt'>
					<div class='ui-tab-cnt-item ui-tab-cnt-item-cur'>
						<h2 class='ui-newgame-title'><a href='#'>1测试文字sdfsadf测试文字sdfsadf测试文字sdfsadf</a></h2>
						<div class='ui-newgame-link'><a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车丁车]</a> <a href='#'>[车跑跑卡丁车]</a></div>
						<h2 class='ui-newgame-title'><a href='#'>测试文字sdfsadf测试文字sdfsadf测试文字sdfsadf</a></h2>
						<div class='ui-newgame-link'><a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车丁车]</a> <a href='#'>[车跑跑卡丁车]</a></div>
					</div>
					<div class='ui-tab-cnt-item'>
						<h2 class='ui-newgame-title'><a href='#'>测试文字sdfsadf测试文字sdfsadf测试文字sdfsadf</a></h2>
						<div class='ui-newgame-link'><a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车丁车]</a> <a href='#'>[车跑跑卡丁车]</a></div>
						<h2 class='ui-newgame-title'><a href='#'>测试文字sdfsadf测试文字sdfsadf测试文字sdfsadf</a></h2>
						<div class='ui-newgame-link'><a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车丁车]</a> <a href='#'>[车跑跑卡丁车]</a></div>
					</div>
				</div>
			</div>

			<div class='ui-art ui-art-hr fn-clear'>
				<div class='img'>
					<a href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' alt='' width='106' height='90' /></a>
					<h4><a href='#'>测试文字</a></h4>
				</div>
				<ul class='ui-list ui-list-main'>
					<li class='ui-list-item'><a href='#'>[新游] 你绝对想不到!国产游戏进军韩雷国游戏进军韩雷的雷囧游戏进军韩雷译名(图)</a></li>
					<li class='ui-list-item'><a href='#'>[新游] 你绝对想不到!国产游戏进军韩雷国游戏进军韩雷的雷囧游戏进军韩雷译名(图)</a></li>
					<li class='ui-list-item'><a href='#'>[新游] 你绝对想不到!国产游戏进军韩雷国游戏进军韩雷的雷囧游戏进军韩雷译名(图)</a></li>
					<li class='ui-list-item'><a href='#'>[新游] 你绝对想不到!国产游戏进军韩雷国游戏进军韩雷的雷囧游戏进军韩雷译名(图)</a></li>
				</ul>
			</div>

			<h2 class='ui-newgame-title ui-newgame-title-recommend'><a href='#'>测试文字:f测试文试文字字试文字试试文字文字测试文字</a></h2>

			<div class='ui-art fn-clear'>
				<div class='img'>
					<a href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' alt='' width='106' height='90' /></a>
					<h4><a href='#'>测试文字</a></h4>
				</div>
				<ul class='ui-list ui-list-main'>
					<li class='ui-list-item'><a href='#'>[新游] 你绝对想不到!国产游戏进军韩雷国游戏进军韩雷的雷囧游戏进军韩雷译名(图)</a></li>
					<li class='ui-list-item'><a href='#'>[新游] 你绝对想不到!国产游戏进军韩雷国游戏进军韩雷的雷囧游戏进军韩雷译名(图)</a></li>
					<li class='ui-list-item'><a href='#'>[新游] 你绝对想不到!国产游戏进军韩雷国游戏进军韩雷的雷囧游戏进军韩雷译名(图)</a></li>
					<li class='ui-list-item'><a href='#'>[新游] 你绝对想不到!国产游戏进军韩雷国游戏进军韩雷的雷囧游戏进军韩雷译名(图)</a></li>
				</ul>
			</div>

			<div class='ui-tab ui-tab-easy'>
				<div class='ui-tab-header fn-clear'>
					<ul class='ui-tab-nav fn-clear'>
						<li class='ui-tab-nav-item ui-tab-nav-item-cur'>热门视频</li>
					</ul>
					<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
				</div>
				<div class='ui-tab-cnt'>
					<ul class='ui-tab-cnt-item ui-tab-cnt-item-cur ui-img-list ui-img-list-plus'>
						<li class='ui-img-list-item'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='102' height='76' /><span class='icon-play'></span></a>
							<a class='title' href='#'>大话西游战歌</a>
						</li>
						<li class='ui-img-list-item'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='102' height='76' /><span class='icon-play'></span></a>
							<a class='title' href='#'>大话西游战歌</a>
						</li>
						<li class='ui-img-list-item'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='102' height='76' /><span class='icon-play'></span></a>
							<a class='title' href='#'>大话西游战歌</a>
						</li>
						<li class='ui-img-list-item'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='102' height='76' /><span class='icon-play'></span></a>
							<a class='title' href='#'>大话西游战歌</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class='ui-layout-item ui-layout-item-sub'>
			<div class='ui-tab ui-tab-sd'>
				<ul class='ui-tab-nav fn-clear'>
					<li class='ui-tab-nav-item ui-tab-nav-item-cur'>焦点</li>
					<li class='ui-tab-nav-item'>热图</li>
					<li class='ui-tab-nav-item'>发号</li>
				</ul>
				<div class='ui-tab-cnt'>
					<ul class='ui-tab-cnt-item ui-tab-cnt-item-cur ui-gamenum-list'>
						<li class='ui-gamenum'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='80' height='60'/></a>
							<h4 class='title'><a href='#'>游戏排行</a></h4>
							<p class='status'>已有23324234人</p>
							<p class='content'>游戏库 | 图片<em>633</em> | 视频<em>68733</em></p>
							<a class='button' href='#'>领号</a>
						</li>
						<li class='ui-gamenum'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='80' height='60'/></a>
							<h4 class='title'><a href='#'>游戏排行</a></h4>
							<p class='status'>已有23324234人</p>
							<p class='content'>图片<em>633</em> | 视频<em>633</em></p>
							<a class='button' href='#'>领号</a>
						</li>
						<li class='ui-gamenum'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='80' height='60'/></a>
							<h4 class='title'><a href='#'>游戏排行</a></h4>
							<p class='status'>已有23324234人</p>
							<p class='content'>图片<em>633</em> | 视频<em>633</em></p>
							<a class='button' href='#'>领号</a>
						</li>
					</ul>
					<ul class='ui-tab-cnt-item ui-gamenum-list'>
						<li class='ui-gamenum'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='80' height='60'/></a>
							<h4 class='title'><a href='#'>游戏排行</a></h4>
							<p class='status'>已有23324234人</p>
							<p class='content'>游戏库 | 图片<em>633</em> | 视频<em>68733</em></p>
							<a class='button' href='#'>领号</a>
						</li>
						<li class='ui-gamenum'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='80' height='60'/></a>
							<h4 class='title'><a href='#'>游戏排行</a></h4>
							<p class='status'>已有23324234人</p>
							<p class='content'>图片<em>633</em> | 视频<em>633</em></p>
							<a class='button' href='#'>领号</a>
						</li>
						<li class='ui-gamenum'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='80' height='60'/></a>
							<h4 class='title'><a href='#'>游戏排行</a></h4>
							<p class='status'>已有23324234人</p>
							<p class='content'>图片<em>633</em> | 视频<em>633</em></p>
							<a class='button' href='#'>领号</a>
						</li>
					</ul>
					<ul class='ui-tab-cnt-item ui-gamenum-list'>
						<li class='ui-gamenum'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='80' height='60'/></a>
							<h4 class='title'><a href='#'>游戏排行</a></h4>
							<p class='status'>已有23324234人</p>
							<p class='content'>游戏库 | 图片<em>633</em> | 视频<em>68733</em></p>
							<a class='button' href='#'>领号</a>
						</li>
						<li class='ui-gamenum'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='80' height='60'/></a>
							<h4 class='title'><a href='#'>游戏排行</a></h4>
							<p class='status'>已有23324234人</p>
							<p class='content'>图片<em>633</em> | 视频<em>633</em></p>
							<a class='button' href='#'>领号</a>
						</li>
						<li class='ui-gamenum'>
							<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='80' height='60'/></a>
							<h4 class='title'><a href='#'>游戏排行</a></h4>
							<p class='status'>已有23324234人</p>
							<p class='content'>图片<em>633</em> | 视频<em>633</em></p>
							<a class='button' href='#'>领号</a>
						</li>
					</ul>
				</div>
			</div>

			<div class='ui-tab ui-tab-sd'>
				<ul class='ui-tab-nav fn-clear'>
					<li class='ui-tab-nav-item ui-tab-nav-item-cur'>预定排行榜</li>
					<li class='ui-tab-nav-item'>一周特权榜</li>
					<li class='ui-tab-nav-item'>一周发号榜</li>
				</ul>
				<div class='ui-tab-cnt'>
					<ol class='ui-tab-cnt-item ui-tab-cnt-item-cur ui-list-plus'>
						<li class='ui-list-plus-item'><span class='num num-hot'>1</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-get' href='#'>领</a></li>
						<li class='ui-list-plus-item'><span class='num num-hot'>2</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
						<li class='ui-list-plus-item'><span class='num num-hot'>3</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-get' href='#'>领</a></li>
						<li class='ui-list-plus-item'><span class='num'>4</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
						<li class='ui-list-plus-item'><span class='num'>5</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
						<li class='ui-list-plus-item'><span class='num'>6</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-get' href='#'>领</a></li>
						<li class='ui-list-plus-item'><span class='num'>7</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-get' href='#'>领</a></li>
						<li class='ui-list-plus-item'><span class='num'>8</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
					</ol>
					<ol class='ui-tab-cnt-item ui-list-plus'>
						<li class='ui-list-plus-item'><span class='num num-hot'>1</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
						<li class='ui-list-plus-item'><span class='num num-hot'>2</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
						<li class='ui-list-plus-item'><span class='num num-hot'>3</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-get' href='#'>领</a></li>
						<li class='ui-list-plus-item'><span class='num'>4</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
						<li class='ui-list-plus-item'><span class='num'>5</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
						<li class='ui-list-plus-item'><span class='num'>6</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-get' href='#'>领</a></li>
						<li class='ui-list-plus-item'><span class='num'>7</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-get' href='#'>领</a></li>
						<li class='ui-list-plus-item'><span class='num'>8</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
					</ol>
					<ol class='ui-tab-cnt-item ui-list-plus'>
						<li class='ui-list-plus-item'><span class='num num-hot'>1</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-get' href='#'>领</a></li>
						<li class='ui-list-plus-item'><span class='num num-hot'>2</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
						<li class='ui-list-plus-item'><span class='num num-hot'>3</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-get' href='#'>领</a></li>
						<li class='ui-list-plus-item'><span class='num'>4</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
						<li class='ui-list-plus-item'><span class='num'>5</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
						<li class='ui-list-plus-item'><span class='num'>6</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-get' href='#'>领</a></li>
						<li class='ui-list-plus-item'><span class='num'>7</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-get' href='#'>领</a></li>
						<li class='ui-list-plus-item'><span class='num'>8</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='video' href='#'>视频(104)</a><span class='status'>4567895</span><a class='btn btn-tao' href='#'>淘</a></li>
					</ol>
				</div>
			</div>

			<div class='ad'><a href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='280' height='250' /></a></div>
		</div>
	</div>

	<!-- 网络游戏 -->
	<div id='content-online-game' class='ui-game fn-clear'>
		<div class='ui-game-header'>
			<h2 class='title'>网络游戏</h2>
			<div class='link'><a href='#'>游戏</a> | <a href='#'>软件</a> | <a href='#'>专题</a> | <a href='#'>视频</a> <a class='more' href='#'>进入网游频道&gt;&gt;</a></div>
		</div>

		<div class='ui-game-item ui-game-item-side'>
			<div class='ui-header'>
				<h2 class='title'>iPhone 新手入门</h2>
			</div>
			<ol class='ui-list-plus'>
				<li class='ui-list-plus-item'><span class='num num-hot'>1</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num num-hot'>2</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num num-hot'>3</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>4</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>5</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>6</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>7</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>8</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>9</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>10</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
			</ol>

			<div class='ad'><a href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='198' height='148' /></a></div>
		</div>

		<div class='ui-game-item ui-game-item-main fn-clear'>
			<div class='ui-header'>
				<h2 class='title'>最新游戏</h2>
				<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
			</div>
			<ul class='ui-img-list'>
				<li class='ui-img-list-item'>
					<a class='img img-game' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='106' height='90' /></a>
					<h4 class='title'><a href='#'>大话西游战歌</a></h4>
				</li>
				<li class='ui-img-list-item'>
					<a class='img img-game' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='106' height='90' /></a>
					<h4 class='title'><a href='#'>大话西游战歌</a></h4>
				</li>
				<li class='ui-img-list-item'>
					<a class='img img-game' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='106' height='90' /></a>
					<h4 class='title'><a href='#'>大话西游战歌</a></h4>
				</li>
			</ul>

			<h2 class='ui-newgame-title'><a href='#'>测试文字sdfsadf测试文字sdfsadf测试文字sdfsadf</a></h2>
			<div class='ui-newgame-link'><a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车丁车]</a> <a href='#'>[车跑跑卡丁车]</a></div>
			<ul class='ui-list ui-list-main hr'>
				<li class='ui-list-item'><strong><a href='#'>你绝对想不到!国产游戏进不到!国产游军韩雷国的雷囧译名(图)</a></strong></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>

				<li class='ui-list-item bk'><strong><a href='#'>你绝对想不到!国产游戏进不到!国产游军韩雷国的雷囧译名(图)</a></strong></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
			</ul>
		</div>

		<div class='ui-game-item ui-game-item-sub'>
			<div class='ui-header'>
				<h2 class='title'>iPhone 游戏排行</h2>
			</div>
			<ul class='ui-gamenum-list'>
				<li class='ui-gamenum'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='80' height='60'/></a>
					<h4 class='title'><a href='#'>游戏排行</a></h4>
					<p class='status'>已有23324234人</p>
					<p class='content'>游戏库 | 图片<em>633</em> | 视频<em>68733</em></p>
					<a class='button button-lh' href='#'>领号</a>
				</li>
				<li class='ui-gamenum'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='80' height='60'/></a>
					<h4 class='title'><a href='#'>游戏排行</a></h4>
					<p class='status'>已有23324234人</p>
					<p class='content'>游戏库 | 图片<em>633</em> | 视频<em>633</em></p>
					<a class='button button-th' href='#'>淘号</a>
				</li>
			</ul>

			<div class='ui-header'>
				<h2 class='title'>iPhone 游戏排行</h2>
			</div>
			<ul class='ui-img-list ui-img-list-plus'>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
			</ul>
		</div>
	</div>

	<!-- 网页游戏 -->
	<div id='content-web-game' class='ui-game fn-clear'>
		<div class='ui-game-header'>
			<h2 class='title'>网页游戏</h2>
			<div class='link'><a href='#'>游戏</a> | <a href='#'>软件</a> | <a href='#'>专题</a> | <a href='#'>视频</a> <a class='more' href='#'>进入网游频道&gt;&gt;</a></div>
		</div>

		<div class='ui-game-item ui-game-item-side'>
			<div class='ui-header'>
				<h2 class='title'>iPhone 新手入门</h2>
			</div>
			<!-- <ul class='alist'>
				<li><a href='#'>测试文字</a></li>
				<li><a href='#'>测试文字</a></li>
				<li><a href='#'>测试文字</a></li>
				<li><a href='#'>测试文字</a></li>
			</ul> -->
			<div id='js_accordion' class='abox-list'>
				<div class='abox abox-cur'>
					<h3 class='abox-title'><a href='javascript:;'>测试文字</a></h3>
					<ul class='ui-list hr'>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
					</ul>
				</div>
				<div class='abox'>
					<h3 class='abox-title'><a href='javascript:;'>测试文字</a></h3>
					<ul class='ui-list hr'>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
					</ul>
				</div>
				<div class='abox'>
					<h3 class='abox-title'><a href='javascript:;'>测试文字</a></h3>
					<ul class='ui-list hr'>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
					</ul>
				</div>
				<div class='abox'>
					<h3 class='abox-title'><a href='javascript:;'>测试文字</a></h3>
					<ul class='ui-list hr'>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
					</ul>
				</div>
				<div class='abox'>
					<h3 class='abox-title'><a href='javascript:;'>测试文字</a></h3>
					<ul class='ui-list hr'>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
						<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class='ui-game-item ui-game-item-main fn-clear'>
			<div class='ui-header'>
				<h2 class='title'>最新游戏</h2>
				<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
			</div>
			<ul class='ui-img-list'>
				<li class='ui-img-list-item'>
					<a class='img img-game' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='106' height='90' /></a>
					<h4 class='title'><a href='#'>大话西游战歌</a></h4>
				</li>
				<li class='ui-img-list-item'>
					<a class='img img-game' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='106' height='90' /></a>
					<h4 class='title'><a href='#'>大话西游战歌</a></h4>
				</li>
			</ul>

			<h2 class='ui-newgame-title'><a href='#'>测试文字sdfsadf测试文字sdfsadf测试文字sdfsadf</a></h2>
			<div class='ui-newgame-link'><a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车丁车]</a> <a href='#'>[车跑跑卡丁车]</a></div>
			<ul class='ui-list ui-list-main hr'>
				<li class='ui-list-item'><strong><a href='#'>你绝对想不到!国产游戏进不到!国产游军韩雷国的雷囧译名(图)</a></strong></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
			</ul>
		</div>

		<div class='ui-game-item ui-game-item-sub'>
			<div class='ui-header'>
				<h2 class='title'>iPhone 游戏排行</h2>
			</div>
			<ul class='ui-img-list ui-img-list-plus'>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
			</ul>
		</div>
	</div>

	<div class='ui-layout ad'><a href='#'><img src='http://pnews.huoshow.com/statics/images/common/middle_anner.png' width='960' height='60' /></a></div>

	<!-- 单机游戏 -->
	<div id='content-pc-game' class='ui-game fn-clear'>
		<div class='ui-game-header'>
			<h2 class='title'>单机游戏</h2>
			<div class='link'><a href='#'>游戏</a> | <a href='#'>软件</a> | <a href='#'>专题</a> | <a href='#'>视频</a> <a class='more' href='#'>进入网游频道&gt;&gt;</a></div>
		</div>

		<div class='ui-game-item ui-game-item-side'>
			<div class='ui-header'>
				<h2 class='title'>iPhone 新手入门</h2>
			</div>
			<ol class='ui-list-plus'>
				<li class='ui-list-plus-item'><span class='num num-hot'>1</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num num-hot'>2</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num num-hot'>3</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>4</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>5</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>6</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>7</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>8</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>9</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
				<li class='ui-list-plus-item'><span class='num'>10</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>专题</a></li>
			</ol>
		</div>

		<div class='ui-game-item ui-game-item-main fn-clear'>
			<div class='ui-header'>
				<h2 class='title'>最新游戏</h2>
				<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
			</div>
			<ul class='ui-img-list'>
				<li class='ui-img-list-item'>
					<a class='img img-game' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='106' height='90' /></a>
					<h4 class='title'><a href='#'>大话西游战歌</a></h4>
				</li>
				<li class='ui-img-list-item'>
					<a class='img img-game' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='106' height='90' /></a>
					<h4 class='title'><a href='#'>大话西游战歌</a></h4>
				</li>
			</ul>

			<h2 class='ui-newgame-title'><a href='#'>测试文字sdfsadf测试文字sdfsadf测试文字sdfsadf</a></h2>
			<div class='ui-newgame-link'><a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车丁车]</a> <a href='#'>[车跑跑卡丁车]</a></div>
			<ul class='ui-list ui-list-main hr'>
				<li class='ui-list-item'><strong><a href='#'>你绝对想不到!国产游戏进不到!国产游军韩雷国的雷囧译名(图)</a></strong></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
			</ul>
		</div>

		<div class='ui-game-item ui-game-item-sub'>
			<div class='ui-header'>
				<h2 class='title'>iPhone 游戏排行</h2>
			</div>
			<ul class='ui-img-list ui-img-list-plus'>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
			</ul>
			<ul class='ui-list'>
				<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
				<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
				<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
				<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
				<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
			</ul>
		</div>
	</div>

	<!-- 手机游戏 -->
	<div id='content-phone-game' class='ui-game fn-clear'>
		<div class='ui-game-header'>
			<h2 class='title'>手机游戏</h2>
			<div class='link'><a href='#'>游戏</a> | <a href='#'>软件</a> | <a href='#'>专题</a> | <a href='#'>视频</a> <a class='more' href='#'>进入网游频道&gt;&gt;</a></div>
		</div>

		<div class='ui-game-item ui-game-item-side'>
			<h2 class='game-title game-title-iphone'><a href='#'>iPhone 新手入门 &gt;&gt;</a></h2>
			<ol class='ui-list-plus ui-ranking ui-ranking-game'>
				<li class='ui-ranking-item ui-ranking-item-cur'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/0613/20120613012154648.jpg' alt='' width='50' height='50' /></a>
					<span class='num num-hot'>1</span>
					<h3 class='title'><a href='#'>敢死敢死队敢死队</a></h3>
					<p class="content">3521</p>
					<div class='star star3'></div>
					<a class='button' href='#'>下载</a>
				</li>
				<li class='ui-list-plus-item'><span class='num'>2</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>1688</a></li>
				<li class='ui-list-plus-item'><span class='num'>3</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>1688</a></li>
			</ol>
			<h2 class='game-title game-title-android'><a href='#'>安卓 新手入门 &gt;&gt;</a></h2>
			<ol class='ui-list-plus ui-ranking ui-ranking-game'>
				<li class='ui-list-plus-item'><span class='num num-hot'>1</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>1688</a></li>
				<li class='ui-list-plus-item'><span class='num'>2</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>1688</a></li>
				<li class='ui-list-plus-item'><span class='num'>3</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>1688</a></li>
			</ol>
			<h2 class='game-title game-title-wp'><a href='#'>WP 应用下载 &gt;&gt;</a></h2>
			<ol class='ui-list-plus ui-ranking ui-ranking-game'>
				<li class='ui-list-plus-item'><span class='num num-hot'>1</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>1688</a></li>
				<li class='ui-list-plus-item'><span class='num'>2</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>1688</a></li>
				<li class='ui-list-plus-item'><span class='num'>3</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢</a><a class='name' href='#'>1688</a></li>
			</ol>
		</div>

		<div class='ui-game-item ui-game-item-main fn-clear'>
			<div class='ui-header'>
				<h2 class='title'>最新游戏</h2>
				<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
			</div>
			<ul class='ui-img-list'>
				<li class='ui-img-list-item'>
					<a class='img img-game' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='106' height='90' /></a>
					<h4 class='title'><a href='#'>大话西游战歌</a></h4>
				</li>
				<li class='ui-img-list-item'>
					<a class='img img-game' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='106' height='90' /></a>
					<h4 class='title'><a href='#'>大话西游战歌</a></h4>
				</li>
				<li class='ui-img-list-item'>
					<a class='img img-game' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='106' height='90' /></a>
					<h4 class='title'><a href='#'>大话西游战歌</a></h4>
				</li>
			</ul>

			<h2 class='ui-newgame-title'><a href='#'>测试文字sdfsadf测试文字sdfsadf测试文字sdfsadf</a></h2>
			<div class='ui-newgame-link'><a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车跑跑卡丁车]</a> <a href='#'>[车丁车]</a> <a href='#'>[车跑跑卡丁车]</a></div>
			<ul class='ui-list ui-list-main hr'>
				<li class='ui-list-item'><strong><a href='#'>你绝对想不到!国产游戏进不到!国产游军韩雷国的雷囧译名(图)</a></strong></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>

				<li class='ui-list-item bk'><strong><a href='#'>你绝对想不到!国产游戏进不到!国产游军韩雷国的雷囧译名(图)</a></strong></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
				<li class='ui-list-item'><a href='#'>你绝对想不到!国产游戏进韩雷国韩雷国韩雷国军韩雷国的雷囧译名(图)</a></li>
			</ul>
		</div>

		<div class='ui-game-item ui-game-item-sub'>
			<div class='ui-header'>
				<h2 class='title'>iPhone 游戏排行</h2>
				<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
			</div>
			<ul class='ui-img-list ui-img-list-plus ahr'>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/0613/20120613012154648.jpg' width='75' height='75' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/0613/20120613012154648.jpg' width='75' height='75' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/0613/20120613012154648.jpg' width='75' height='75' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/0613/20120613012154648.jpg' width='75' height='75' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/0613/20120613012154648.jpg' width='75' height='75' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/0613/20120613012154648.jpg' width='75' height='75' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
			</ul>

			<div class='ui-header'>
				<h2 class='title'>最新游戏</h2>
				<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
			</div>
			<ul class='ui-img-list ui-img-list-plus ui-img-list-x'>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
			</ul>
		</div>
	</div>

	<!-- 游戏图库 -->
	<div id='content-pic-game' class='ui-game fn-clear'>
		<div class='ui-game-header'>
			<h2 class='title'>游戏图库</h2>
			<div class='link'><a href='#'>游戏</a> | <a href='#'>软件</a> | <a href='#'>专题</a> | <a href='#'>视频</a> <a class='more' href='#'>进入网游频道&gt;&gt;</a></div>
		</div>

		<div class='ui-game-item ui-game-item-main fn-clear'>
			<div id='myfocus-kiki-index' class='ui-myfocus'>
				<div class="loading"></div>
				<div class="pic">
					<ul>
						<li><a href="#1"><img src="http://myshow.huoshow.com/myshowpic/image/1352111172_big.jpg" thumb="" alt="版权属于作者，图片2来源于网络" width='255' height='334' /></a></li>
						<li><a href="#2"><img src="http://myshow.huoshow.com/myshowpic/image/1352111171_big.jpg" thumb="" alt="版权属于作者，图片2来源于网络" width='255' height='334' /></a></li>
						<li><a href="#3"><img src="http://myshow.huoshow.com/myshowpic/image/1352111172_big.jpg" thumb="" alt="图片3来源于网络，版权属于作者" width='255' height='334' /></a></li>
						<li><a href="#4"><img src="http://myshow.huoshow.com/myshowpic/image/1352111171_big.jpg" thumb="" alt="版权属于作者，图片4来源于网络" width='255' height='334' /></a></li>
						<li><a href="#5"><img src="http://myshow.huoshow.com/myshowpic/image/1352111172_big.jpg" thumb="" alt="图片5来源于网络，版权属于作者" width='255' height='334' /></a></li>
					</ul>
				</div>
			</div>
			<ul class='ui-img-list ui-img-list-plus'>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' width='122' height='90' /></a>
					<a class='title' href='#'>大话西游战歌</a>
				</li>
			</ul>
		</div>

		<div class='ui-game-item ui-game-item-sub'>
			<div class='ui-header'>
				<h2 class='title'>iPhone 游戏排行</h2>
				<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
			</div>
			<ol class='ui-list-plus'>
				<li class='ui-list-plus-item'><span class='num num-hot'>1</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢敢死队2预告敢死队2预告敢死队2预告敢</a></li>
				<li class='ui-list-plus-item'><span class='num num-hot'>2</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢敢死队2预告敢死队2预告敢死队2预告敢</a></li>
				<li class='ui-list-plus-item'><span class='num num-hot'>3</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢敢死队2预告敢死队2预告敢死队2预告敢</a></li>
				<li class='ui-list-plus-item'><span class='num'>4</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢敢死队2预告敢死队2预告敢死队2预告敢</a></li>
				<li class='ui-list-plus-item'><span class='num'>5</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢敢死队2预告敢死队2预告敢死队2预告敢</a></li>
				<li class='ui-list-plus-item'><span class='num'>6</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢敢死队2预告敢死队2预告敢死队2预告敢</a></li>
				<li class='ui-list-plus-item'><span class='num'>7</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢敢死队2预告敢死队2预告敢死队2预告敢</a></li>
				<li class='ui-list-plus-item'><span class='num'>8</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢敢死队2预告敢死队2预告敢死队2预告敢</a></li>
				<li class='ui-list-plus-item'><span class='num'>9</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢敢死队2预告敢死队2预告敢死队2预告敢</a></li>
				<li class='ui-list-plus-item'><span class='num'>10</span><a class='title' href='#'>敢死队2预告敢死队2预告敢死队2预告敢敢死队2预告敢死队2预告敢死队2预告敢</a></li>
			</ol>
		</div>
	</div>

	<script src='<?php echo JS_PATH;?>seajs/sea.js' id='seajsnode' data-main='hs-game-main'></script>
	<?php include template('content', 'hs_footer'); ?>
</body>
</html>