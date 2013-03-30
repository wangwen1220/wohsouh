<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>火秀游戏_火秀网</title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
	<meta name="description" content="<?php echo $SEO['description'];?>">
	<meta name='author' content='火秀' />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link href="<?php echo CSS_PATH;?>huoshow_game.css" rel="stylesheet" />
	<script src="<?php echo JS_PATH;?>jquery.min.js"></script>
	<script src="<?php echo JS_PATH;?>jquery.cookie.js"></script>
	<script src="<?php echo JS_PATH;?>huoshow_basic.js"></script>
	<script src="<?php echo JS_PATH;?>huoshow_config.js"></script>
	<script src="<?php echo JS_PATH;?>huoshow_common.js"></script>
	<script src='http://misc.huoshow.com/www/delivery/spcjs1.php?id=2'></script>
	<link rel='icon' href='/favicon.ico' />
	<?php if(!$id) { ?>
		<?php if($catid != 177 && $catid != 178 && $catid != 179 && $catid != 180 && $catid != 181) { ?>
			<base target=\"_blank\">
		<?php } ?>
	<?php } ?>
</head>

<body class="game lazyload">
<!--Site Header-->
<div class="top_nav">
	<div class="top_nav_bar">
		<div class="top_nav_bg">
			<div class="top_nav_left">
				<div class="common"> <a target="_blank" href="http://www.huoshow.com/">首页</a>-<a target="_blank" href="http://live.huoshow.com/">直播</a>-<a target="_blank" href="http://www.huoshow.com/events/">赛事</a>-<a target="_blank" href="http://www.huoshow.com/star/">明星</a>-<a target="_blank" href="http://www.huoshow.com/movie/">影视</a>-<a target="_blank" href="http://www.huoshow.com/music/">音乐</a>-<a target="_blank" href="http://www.huoshow.com/supermodel/">超模</a>-<a target="_blank" href="http://www.huoshow.com/game/">游戏</a>-<a target="_blank" href="http://www.huoshow.com/pic/">美图</a>-<a target="_blank" href="http://www.huoshow.com/tv/">电视</a>-<a target="_blank" href="http://www.huoshow.com/myshow/">My秀</a>-<a target="_blank" href="http://space.huoshow.com/group.php">群组</a>-<a target="_blank" href="http://space.huoshow.com/home.php">空间</a>-<a target="_blank" href="http://bbs.huoshow.com/">论坛</a> </div>
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
<div class="nav_body">
	<div class="nav_bg">
		<h1 class="channel_logo"><a href="<?php echo $CATEGORYS['14']['url'];?>" title="火秀游戏"><img src='/statics/images/game/logo.png' alt='火秀游戏' width='147' height='66' /></a></h1>
		<div id="sub_channel">
			<ul id="starmenu">
				<?php $n=1;if(is_array(subcat(14,0,0,$siteid))) foreach(subcat(14,0,0,$siteid) AS $r) { ?>
				<?php $num++?>
				<li <?php if(($r[catid] == $catid)) { ?>class="current"<?php } ?>><a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a></li>
				<?php if($num==6) break;?>
				<?php $n++;}unset($n); ?>
			</ul>
		</div>
	</div>
</div>
<div class="search">
	<!--#include virtual="/api.php?op=movie&p=get_search_huoshow&siteid=<?php echo $siteid;?>"-->
	<span class="hot_game_nav">
		您现在的位置: <a href="<?php echo siteurl($siteid);?>">首页</a><span> &gt; </span>
		<?php if($catid == 14) { ?>
			<?php echo catpos($catid);?>
		<?php } else { ?>
			<?php echo catpos($catid);?>
			<?php if(!empty($id)) { ?>
				&gt; 正文
			<?php } else { ?>
				<?php if($commentid) { ?>
					评论列表
				<?php } else { ?>
					<?php if($catid !=83 && $catid !=84 && $catid !=85 && $catid !=86) { ?> &gt; 列表<?php } ?>
				<?php } ?>
			<?php } ?>
		<?php } ?>
	</span>
</div>
