<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>游戏图片列表页 - 火秀网</title>
	<meta name='keywords' content='火秀网络游戏' />
	<meta name='description' content='火秀网络游戏' />
	<meta name='author' content='火秀网' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href='<?php echo CSS_PATH;?>hs-game-picshow.css' rel='stylesheet' />
	<!-- <script src='<?php echo JS_PATH;?>cssrefresh.js'></script> -->
	<link href='/favicon.ico' rel='icon' />
</head>

<body class='game-picshow'>
	<?php include template('content', 'hs_topbar'); ?>
	<?php include template('content', 'game_header_dev'); ?>

	<div id='content'>
		<!-- 相册 -->
		<div id="mygallery-black" class="mygallery mygallery-black" data-skin='black'>
			<div class='mygallery-header fn-clear'>
				<div class='mygallery-info'>
					<h2 class='title'>谭卓纯净系杂志大片</h2>
					<span class='count'>（<em class='index'>1</em>/<span class='total'>10</span>）</span>
					<span class='time'>2013-1-5 19:25</span>
				</div>
				<form class="search" name='' method='post' action=''><input type='text' name='q' class='search-wd' value='搜索图片' /><button type='submit' class='search-submit'>搜索</button></form>
				<p class='cnt'>网易娱乐1月8日报道（图文/小易）近日，谭卓接受《时尚先生》邀请拍摄的纯净唯美写真曝光。网易娱乐1月8日报道（图文/小易）近日，谭卓接受《时尚先生》邀请拍摄的纯净唯美写真曝光。网易娱乐1月8日报道（图文/小易）近日，谭卓接受《时尚先生》邀请拍摄的纯净唯美写真曝光。</p>
			</div>
			<!-- <div class='mygallery-allpic2'>
				<ul class='mygallery-piclist fn-clear'>
					<li class='mygallery-piclist-item'>
						<a href='#p=1' data-src='/statics/images/gb_tip_layer_ie6.png' data-title='手捧99朵玫瑰花的男'><img src='/statics/images/taobao_sq.jpg' /></a>
					</li>
					<li class='mygallery-piclist-item'>
						<a href='#p=2' data-src='http://www.huoshow.com/upload/2011/0917/1316231694143.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0917/1316231694143.jpg' alt='' width='75' height='75' /></a>
					</li>
					<li class='mygallery-piclist-item'>
						<a href='#p=3' data-src='http://www.huoshow.com/upload/2011/0917/1316231703685.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0917/1316231703685.jpg' alt='' width='75' height='75' /></a>
					</li>
					<li class='mygallery-piclist-item'>
						<a href='#p=4' data-src='http://www.huoshow.com/upload/2011/0917/thumb_hs_0_600_1316231692203.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0917/thumb_hs_0_600_1316231692203.jpg' alt='' width='75' height='75' /></a>
					</li>
					<li class='mygallery-piclist-item'>
						<a href='#p=5' data-src='http://www.huoshow.com/upload/2011/0917/thumb_hs_0_600_1316231687572.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0917/thumb_hs_0_600_1316231687572.jpg' alt='' width='75' height='75' /></a>
					</li>
					<li class='mygallery-piclist-item'>
						<a href='#p=6' data-src='http://www.huoshow.com/upload/2011/1207/1323246996172.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/1207/1323246996172.jpg' alt='' width='75' height='75' /></a>
					</li>
					<li class='mygallery-piclist-item'>
						<a href='#p=7' data-src='http://www.huoshow.com/upload/2011/1207/1323247033743.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/1207/1323247033743.jpg' alt='' width='75' height='75' /></a>
					</li>
					<li class='mygallery-piclist-item'>
						<a href='#p=8' data-src='http://www.huoshow.com/upload/2011/1207/1323250149679.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/1207/1323250149679.jpg' alt='' width='75' height='75' /></a>
					</li>
					<li class='mygallery-piclist-item'>
						<a href='#p=9' data-src='http://www.huoshow.com/upload/2011/0917/1316230369491.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0917/1316230369491.jpg' alt='' width='75' height='75' /></a>
					</li>
					<li class='mygallery-piclist-item'>
						<a href='#p=10' data-src='http://www.huoshow.com/upload/2011/0919/1316405597779.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0919/1316405597779.jpg' alt='' width='75' height='75' /></a>
					</li>
				</ul>
				<div class="mygallery-pager"><span class="disabled">上一页</span><span class="num current">1</span><a class='num' href="#">2</a><a class='num' href="#">3</a><a class='num' href="#">4</a><span class='ellipsis'>...</span><a class='num' href="#">199</a><a href="#">下一页</a></div>
			</div> -->
			<!-- <div class='mygallery-allpic fn-hide'>
				<div class="mygallery-pager"><span class="disabled">上一页</span><span class="num current">1</span><a class='num' href="#">2</a><a class='num' href="#">3</a><a class='num' href="#">4</a><span class='ellipsis'>...</span><a class='num' href="#">199</a><a href="#">下一页</a></div>
			</div> -->
			<div class='mygallery-view'>
				<div class='mygallery-view-loading'></div>
				<div class='mygallery-view-img'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' /><span></span></div>
				<div class='mygallery-view-prev'><a class='disabled' href='#p=1' hidefocus='true'></a></div>
				<div class='mygallery-view-next'><a href='#p=2' hidefocus='true'></a></div>
			</div>
			<h2 class='mygallery-view-title'>在京举办新专辑发布会，而手捧</h2>

			<div class='mygallery-action fn-clear'>
				<!-- JiaThis Button BEGIN -->
				<span id='jiathis' class="share jiathis_style jiathis">
					<span class="jiathis_txt">分享到：</span>
					<a class="jiathis_button_qzone"></a>
					<a class="jiathis_button_tsina"></a>
					<a class="jiathis_button_tqq"></a>
					<a class="jiathis_button_renren"></a>
					<a class="jiathis_button_tsohu"></a>
					<a class="jiathis_button_kaixin001"></a>
					<a class="jiathis_button_douban"></a>
					<a class="jiathis_button_t163"></a>
					<a class="jiathis_button_tieba"></a>
					<a class="jiathis_button_taobao"></a>
					<a class="jiathis_button_tianya"></a>
					<a class="jiathis_button_ishare">一键分享奖Q币</a>
					<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js?uid=1349664104558770" charset="utf-8"></script>
				</span>
				<!-- JiaThis Button END -->

				<span class='view-comment'><a href='#comment'>评论</a><em>(0)</em></span>
				<a class='view-original' href='#' target='_blank'>查看原图</a>
				<a class='view-all' href='javascript:;'>全部图片</a>
			</div>

			<div class='mygallery-nav'>
				<div class='mygallery-nav-item mygallery-nav-prev'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>&lt; 上一图集</a>
				</div>
				<div class='mygallery-nav-item mygallery-nav-next'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>下一图集 &gt;</a>
				</div>
			</div>

			<div class='mygallery-ctrl'>
				<div class='mygallery-ctrl-thumb'>
					<ul class='mygallery-ctrl-thumb-list fn-clear'>
						<li class='mygallery-ctrl-thumb-item cur'>
							<a class='thumb' href='#p=1' data-src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' alt='' width='75' height='75' /></a>
						</li>
						<li class='mygallery-ctrl-thumb-item'>
							<a class='thumb' href='#p=2' data-src='http://www.huoshow.com/upload/2011/0917/1316231694143.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0917/1316231694143.jpg' alt='' width='75' height='75' /></a>
						</li>
						<li class='mygallery-ctrl-thumb-item'>
							<a class='thumb' href='#p=3' data-src='http://www.huoshow.com/upload/2011/0917/1316231703685.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0917/1316231703685.jpg' alt='' width='75' height='75' /></a>
						</li>
						<li class='mygallery-ctrl-thumb-item'>
							<a class='thumb' href='#p=4' data-src='http://www.huoshow.com/upload/2011/0917/thumb_hs_0_600_1316231692203.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0917/thumb_hs_0_600_1316231692203.jpg' alt='' width='75' height='75' /></a>
						</li>
						<li class='mygallery-ctrl-thumb-item'>
							<a class='thumb' href='#p=5' data-src='http://www.huoshow.com/upload/2011/0917/thumb_hs_0_600_1316231687572.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0917/thumb_hs_0_600_1316231687572.jpg' alt='' width='75' height='75' /></a>
						</li>
						<li class='mygallery-ctrl-thumb-item'>
							<a class='thumb' href='#p=6' data-src='http://www.huoshow.com/upload/2011/1207/1323246996172.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/1207/1323246996172.jpg' alt='' width='75' height='75' /></a>
						</li>
						<li class='mygallery-ctrl-thumb-item'>
							<a class='thumb' href='#p=7' data-src='http://www.huoshow.com/upload/2011/1207/1323247033743.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/1207/1323247033743.jpg' alt='' width='75' height='75' /></a>
						</li>
						<li class='mygallery-ctrl-thumb-item'>
							<a class='thumb' href='#p=8' data-src='http://www.huoshow.com/upload/2011/1207/1323250149679.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/1207/1323250149679.jpg' alt='' width='75' height='75' /></a>
						</li>
						<li class='mygallery-ctrl-thumb-item'>
							<a class='thumb' href='#p=9' data-src='http://www.huoshow.com/upload/2011/0917/1316230369491.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0917/1316230369491.jpg' alt='' width='75' height='75' /></a>
						</li>
						<li class='mygallery-ctrl-thumb-item'>
							<a class='thumb' href='#p=10' data-src='http://www.huoshow.com/upload/2011/0919/1316405597779.jpg' data-title='手捧99朵玫瑰花的男'><img src='http://www.huoshow.com/upload/2011/0919/1316405597779.jpg' alt='' width='75' height='75' /></a>
						</li>
					</ul>
				</div>
				<div class='mygallery-ctrl-bar'>
					<div class='mygallery-ctrl-bar-main'>
						<a class='mygallery-ctrl-bar-btn fn-clear' href='javascript:;'>
							<span class='mygallery-ctrl-bar-btn-lt'></span>
							<span class='mygallery-ctrl-bar-btn-rt'></span>
							<span class='mygallery-ctrl-bar-btn-ct'><em></em></span>
						</a>
					</div>
				</div>
				<a class='mygallery-ctrl-prev' href='javascript:;' hidefocus='true'></a>
				<a class='mygallery-ctrl-next' href='javascript:;' hidefocus='true'></a>
			</div>
		</div>
		<!-- 相册结束 -->

		<div id='jGalleryGroup' class='gallery-group'>
			<div class='ui-header'>
				<h2 class='title'>相关图集推荐</h2>
				<div class='link'><a class='change' href='javascript:;'>换一组</a></div>
			</div>
			<ul class='ui-img-list ui-img-list-plus'>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌多行测试测试</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>

				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>2大话西战歌多行测试测试2</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>2大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>

				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>3大话西战歌多行测试测试</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>

				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>4大话西战歌多行测试测试</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>

				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>5大话西战歌多行测试测试</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
				<li class='ui-img-list-item'>
					<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='100' height='75' /></a>
					<a class='title' href='#'>大话西战歌</a>
				</li>
			</ul>
		</div>

		<div id='main' class='article-box'>
			<div class='article-related article-gallery'>
				<div class='header-news'>
					<h2 class='title'>猜你喜欢</h2>
					<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>
				</div>
				<ul class='ui-img-list ui-img-list-plus'>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
					<li class='ui-img-list-item'>
						<a class='img' href='#'><img src='http://pnews.huoshow.com/uploadfile/2012/1214/thumb_hs_0_600_20121214112819773.jpg' width='142' height='106' /></a>
						<a class='title' href='#'>大话西战歌</a>
					</li>
				</ul>
			</div>
		</div>

		<div id='side'>
			<div class='ui-box-side ui-box-side-top'>
				<h2 class='ui-box-side-title'>热点推荐</h2>
				<div class='ui-art fn-clear'>
					<a class='img' href='#'><img src='http://pnews.wwen.huoshow.com/statics/images/common/ad7.jpg' alt='' width='122' height='90' /></a>
					<h3 class='title'><a href='#'>测试文字文字文字文测试2</a></h3>
					<p class="content">专访范冰冰专久妈说我文字长得不漂亮打久妈妈总说我... <a class='more' href='#'>[详情]</a></p>
				</div>
				<ul class='ui-list'>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
					<li class='ui-list-item'><a href='#'>测试文字sdfsadf 测试文字sdfsadf 测测试文字sdfsadf试文字sdfsadf s</a></li>
				</ul>
			</div>
		</div>

		<form id='comment' class='ui-comment-form fn-cb' method='post' action=''>
			<div class='header-news'>
				<h2 class='title'>网友评论</h2>
				<div class='link'>已有 <em>1</em> 条评论，<a class='alink' href='#'>点击</a>查看全部</div>
			</div>
			<textarea name=''></textarea>
			<div class='submit'>
				<span class='login'><a href='#'>登录</a> | <a href='#'>注册</a></span> <button type='submit'>发表评论</button>
			</div>
		</form>
	</div>

	<script src='<?php echo JS_PATH;?>seajs/sea.js' id='seajsnode' data-main='hs-game-main'></script>
	<?php include template('content', 'hs_footer'); ?>
</body>
</html>