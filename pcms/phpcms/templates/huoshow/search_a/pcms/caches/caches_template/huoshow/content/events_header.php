<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
	<meta name="description" content="<?php echo $SEO['description'];?>">
	<meta name='author' content='火秀' />
	<link href="<?php echo CSS_PATH;?>huoshow_events.css" rel="stylesheet" />
	<script src="<?php echo JS_PATH;?>jquery.min.js"></script>
	<script src="<?php echo JS_PATH;?>jquery.cookie.js"></script>
	<script src="<?php echo JS_PATH;?>huoshow_basic.js"></script>
	<script src="<?php echo JS_PATH;?>huoshow_config.js"></script>
	<script src="<?php echo JS_PATH;?>huoshow_common.js"></script>
	<script src='http://misc.huoshow.com/www/delivery/spcjs1.php?id=2'></script>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link rel='icon' href='/favicon.ico' />
</head>

<body class="body_bg">
	<!--Site Header-->
	<div class="top_nav">
		<div class="top_nav_bar">
			<div class="top_nav_bg">
				<div class="top_nav_left">
					<div class="common">
						<a target="_blank" href="http://www.huoshow.com/">首页</a>-<a target="_blank" href="http://live.huoshow.com/">直播</a>-<a target="_blank" href="http://www.huoshow.com/events/">赛事</a>-<a target="_blank" href="http://www.huoshow.com/star/">明星</a>-<a target="_blank" href="http://www.huoshow.com/movie/">影视</a>-<a target="_blank" href="http://www.huoshow.com/music/">音乐</a>-<a target="_blank" href="http://www.huoshow.com/supermodel/">超模</a>-<a target="_blank" href="http://www.huoshow.com/game/">游戏</a>-<a target="_blank" href="http://www.huoshow.com/pic/">美图</a>-<a target="_blank" href="http://www.huoshow.com/tv/">电视</a>-<a target="_blank" href="http://www.huoshow.com/myshow/">My秀</a>-<a target="_blank" href="http://space.huoshow.com/group.php">群组</a>-<a target="_blank" href="http://space.huoshow.com/home.php">空间</a>-<a target="_blank" href="http://bbs.huoshow.com/">论坛</a>
					</div>
				</div>

				<div class="top_nav_right" id="login_bar">&nbsp;</div>
				<script>
					(function($){
						$(function(){
							$.getJSON('http://space.huoshow.com/api/login.php?jsoncallback=?', function(d){
								$("#login_bar").html(d.html);
							});
						});
					})(jQuery);
				</script>
			</div>
		</div>
	</div>
	<!--Site Header End-->

	<!--Navigator-->
<div class="nav_body">
	<div class="nav_bg">
		<h1 class="channel_logo">
			<a href="<?php echo $CATEGORYS['9']['url'];?>" title="火秀赛事首页">火秀赛事频道</a>
		</h1>
		<div id="sub_channel">
			<ul>
				<li><a href="<?php echo $CATEGORYS['9']['url'];?>">赛事首页</a></li>
				<?php $n=1;if(is_array(subcat(9,0,0,$siteid))) foreach(subcat(9,0,0,$siteid) AS $r) { ?>
				<?php $num++?>
				<?php if(($r[catid] != 16 && $r[catid] != 19)) { ?>
				<li><a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a></li>
				<?php } ?>
				<?php if($num==6) break;?>
				<?php $n++;}unset($n); ?>
			</ul>
		</div>
	</div>
</div>
<div class="search">
	<!--#include virtual="/api.php?op=movie&p=get_search_huoshow&siteid=<?php echo $siteid;?>"-->
	<span class="search_text">
		您现在的位置: <a href="<?php echo siteurl($siteid);?>">首页</a><span> &gt; </span>
		<?php if($catid == 9) { ?>
			<?php echo catpos($catid);?>
		<?php } else { ?>
			<?php echo catpos($catid);?> <?php if(!empty($id)) { ?> &gt; 正文<?php } else { ?><?php if($commentid) { ?> &gt; 评论列表<?php } else { ?> &gt; 列表<?php } ?><?php } ?>
		<?php } ?>
	</span>
</div>

<!--Navigator End-->