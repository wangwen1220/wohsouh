<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title><?php if($_GET[a]==square) { ?>分享广场 – 我秀 - 火秀网
	<?php } elseif ($_GET[a]==myshow_shopping_index) { ?>购物 – 我秀 - 火秀网<?php } elseif ($_GET[a]==myshow_album_index) { ?>专辑 – 我秀 - 火秀网
	<?php } elseif ($_GET[a]==talent) { ?>达人 – 我秀 - 火秀网<?php } elseif ($_GET[a]==mylike) { ?><?php echo $user_info['0']['nickname'];?>的主页 – 我秀 - 火秀网
	<?php } elseif ($_GET[a]==myalbum) { ?><?php echo $user_info['0']['nickname'];?>的专辑 – 我秀 - 火秀网
	<?php } elseif ($_GET[a]==lists) { ?><?php echo $class_name;?> – 我秀 - 火秀网<?php } elseif ($_GET[a]==tag_lists) { ?><?php echo $tag_name['0']['tag_name'];?> – 我秀 - 火秀网
	<?php } elseif ($_GET[a]==show) { ?><?php if($data[0][description]) { ?><?php echo str_cut($data[0][description], 40,'...');?><?php } else { ?><?php echo $data['0']['nickname'];?>的分享<?php } ?> – 我秀 - 火秀网
	<?php } elseif ($_GET[a]==myshow_show_album) { ?><?php echo $album_info['album_name'];?> - 我秀 - 火秀网
	<?php } elseif ($_GET[a]==myshare) { ?><?php echo $user_info['0']['nickname'];?>的分享 - 我秀 - 火秀网
	<?php } elseif ($_GET[a]==myfollow) { ?><?php echo $user_info['0']['nickname'];?>的关注 - 我秀 - 火秀网
	<?php } elseif ($_GET[a]==myfans) { ?><?php echo $user_info['0']['nickname'];?>的粉丝 - 我秀 - 火秀网
	<?php } elseif ($_GET[a]==accountsettings) { ?>帐号设置 - 我秀- 火秀网
	<?php } elseif ($_GET[a]==search) { ?><?php echo $keyword;?>的搜索-我秀-火秀网<?php } else { ?>我秀：记录生活，分享快乐！<?php } ?></title>
	<?php if($_GET[a]==square) { ?>
	<meta name="keywords" content="美女,摄影,游戏,电影,购物" />
	<meta name="description" content="火秀我秀的分享广场汇集了众多精品专辑，及分门别类的领域达人，可以让你在这里看到自己的成就，也能轻松找到你所关注的对象，无论你是喜欢电影，还是购物，或者你是一个摄影爱好者……" />
	<?php } elseif ($_GET[a]==myshow_shopping_index) { ?>
	<meta name="keywords" content="女装,美白,化妆品,数码,保健,母婴,热卖,购物" />
	<meta name="description" content="火秀我秀购物，中国最大的购物社区，千万秀友一起发现并分享，交流热卖商品，分享在各大购物网站的网购经验。" />
	<?php } elseif ($_GET[a]==myshow_album_index) { ?>
	<meta name="keywords" content="专辑,火秀我秀" />
	<meta name="description" content="火秀我秀专辑，汇集精品。你的专辑在这里可以受到最多的关注，有更多的粉丝享受到你的分享。" />
	<?php } elseif ($_GET[a]==talent) { ?>
	<meta name="keywords" content="达人,火秀我秀" />
	<meta name="description" content="展示火秀我秀分享达人的精彩，在这里，你可以享受粉丝们的热情追随。你可以看到你的受欢迎度。" />
	<?php } elseif ($_GET[a]==mylike) { ?>
	<meta name="keywords" content="<?php echo $user_info['0']['nickname'];?>" />
	<meta name="description" content="这是<?php echo $user_info['0']['nickname'];?>的个人主页，在这里你能看到<?php echo $user_info['0']['nickname'];?>的所有的展示分享。" />
	<?php } elseif ($_GET[a]==myalbum) { ?>
	<meta name="keywords" content="<?php echo $user_info['0']['nickname'];?>,关注,专辑" />
	<meta name="description" content="这里集合了<?php echo $user_info['0']['nickname'];?>所有的分享专辑，<?php echo $user_info['0']['nickname'];?>一共有<?php echo $users_total['album'];?>个专辑，同时，还有<?php echo $user_info['0']['nickname'];?>关注的所有专辑。" />
	<?php } elseif ($_GET[a]==lists) { ?>
	<meta name="keywords" content="<?php echo $class_name;?>" />
	<meta name="description" content="最全最好的<?php echo $class_name;?>图片、视频库，你也可以在这里分享你的<?php echo $class_name;?>图片、视频，分享你的快乐，记录你的点滴。" />
	<?php } elseif ($_GET[a]==tag_lists) { ?>
	<meta name="keywords" content="<?php echo $tag_name['0']['tag_name'];?>" />
	<meta name="description" content="为秀友们提供最全最好的<?php echo $tag_name['0']['tag_name'];?>图片、视频库，你也可以在这里分享你的<?php echo $tag_name['0']['tag_name'];?>图片、视频，分享你的快乐，记录你的点滴。" />
	<?php } elseif ($_GET[a]==show) { ?>
	<meta name="keywords" content="<?php if($tag_name) { ?><?php echo $tag_name['0']['name'];?>-<?php echo $tag_name['1']['name'];?>-<?php echo $tag_name['2']['name'];?><?php } else { ?><?php echo $album_datas['0']['album_name'];?><?php } ?>" />
	<meta name="description" content="<?php echo $data['0']['description'];?>" />
	<?php } elseif ($_GET[a]==myshow_show_album) { ?>
	<meta name="keywords" content="<?php echo $album_info['album_name'];?>,<?php echo $class_name;?>" />
	<meta name="description" content="这里集合了<?php echo $album_info['nickname'];?>所有的分享，<?php echo $album_info['album_name'];?>一共有<?php echo $album_info['file_count'];?>个分享" />
	<?php } elseif ($_GET[a]==myshare) { ?>
	<meta name="keywords" content="分享,<?php echo $user_info['0']['nickname'];?>" />
	<meta name="description" content="在这里，你可以看到<?php echo $user_info['0']['nickname'];?>所有的分享内容，<?php echo $user_info['0']['nickname'];?>一共有<?php if($user['uid'] ==$myshowuid) { ?><?php echo $user_share_num;?><?php } else { ?><?php if($users_total[share]) { ?><?php echo $users_total['share'];?><?php } else { ?>0<?php } ?><?php } ?>个分享。" />
	<?php } elseif ($_GET[a]==myfollow) { ?>
	<meta name="keywords" content="关注,<?php echo $user_info['0']['nickname'];?>" />
	<meta name="description" content="在这里，你可以看到<?php echo $user_info['0']['nickname'];?>关注的所有内容，<?php echo $user_info['0']['nickname'];?>一共有<?php echo $count;?>个关注" />
	<?php } elseif ($_GET[a]==myfans) { ?>
	<meta name="keywords" content="粉丝,<?php echo $user_info['0']['nickname'];?>" />
	<meta name="description" content="在这里，你可以看到所有关注<?php echo $user_info['0']['nickname'];?>的用户，<?php echo $user_info['0']['nickname'];?>一共有<?php echo $count;?>个粉丝" />
	<?php } elseif ($_GET[a]==search) { ?>
    <meta name="keywords" content="<?php echo $keyword;?>" />
	<meta name="description" content="搜索<?php echo $keyword;?>的结果: <?php echo $total['user_num'];?>的用户，<?php echo $total['file_num'];?>的分享，<?php echo $total['album_num'];?>的专辑" />
	<?php } else { ?>
	<meta name="keywords" content="购物,美女,摄影,购物,游戏,电影" />
	<meta name="description" content="火秀我秀，记录生活，分享快乐。在这里，无论你发现了什么：让你神往的美女帅哥，好看的电影，动人的音乐，让人热血沸腾游戏，家宠的萌态，或者购物的乐趣……都可以在这里与您的朋友们分享。" />
	<?php } ?>
	<meta name='author' content='火秀网' />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link href="<?php echo CSS_PATH;?>myshow.css" rel="stylesheet" />
	<script src="<?php echo JS_PATH;?>jquery-1.7.2.min.js"></script>
	<!-- <script src="<?php echo JS_PATH;?>jquery.plugin.js"></script> -->
	<script src="<?php echo JS_PATH;?>jquery.cookie.js"></script>
	<script src="<?php echo JS_PATH;?>jquery.form.min.js"></script>
	<script src="<?php echo JS_PATH;?>jquery.animate-colors.min.js"></script>
	<script src="<?php echo JS_PATH;?>artDialog/jquery.artDialog.js?skin=default"></script>
	<!-- <script src="<?php echo JS_PATH;?>artDialog/plugins/iframeTools.js"></script> -->
	<link href="<?php echo JS_PATH;?>jcarousel/jquery.jcarousel.css" rel="stylesheet" />
	<link href="<?php echo JS_PATH;?>jcarousel/skins/myshow/skin.css" rel="stylesheet" />
	<script src="<?php echo JS_PATH;?>jcarousel/jquery.jcarousel.pack.js"></script>
	<script src="<?php echo JS_PATH;?>jtools.js"></script>
	<script id='mainjs' src="<?php echo JS_PATH;?>myshow_jquery.js"></script>
	<link href="/mybatchup/css/default.css" rel="stylesheet" />
	<!-- <script src="<?php echo JS_PATH;?>cssrefresh.js"></script> -->
	<script type="text/javascript">
		var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
		document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F82b22a65dfbeae6f241edda7d3f322af' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<link href='/favicon.ico' rel='icon' />
</head>
<body class='<?php if($user[uid]) { ?>logged <?php } ?>welcome' data-id='http://<?php global $SYSCONFIG;echo $SYSCONFIG["SpaceSiteRoot"]?>/api/myshowlogin.php?jsoncallback=?'><!-- 登录后添加加类“logged” -->
<!-- Topbar -->
<div id='topbar' class="fn-clear">
	<div class="nav">
	<a target="_blank" href="http://www.huoshow.com/">首页</a>-<a target="_blank" href="http://www.huoshow.com/star/">明星</a>-<a target="_blank" href="http://www.huoshow.com/movie/">电影</a>-<a target="_blank" href="http://www.huoshow.com/tv/">电视</a>-<a target="_blank" href="http://www.huoshow.com/music/">音乐</a>-<a target="_blank" href="http://www.huoshow.com/supermodel/">超模</a>-<a target="_blank" href="http://www.huoshow.com/events/">赛事</a>-<a target="_blank" href="http://game.huoshow.com">游戏</a>-<a target="_blank" href="http://www.huoshow.com/pic/">美图</a>-<a target="_blank" href="/">我秀</a>
	</div>
	<div class='help'><a class='home' href="javascript:;">设为首页</a> <a class='fav' href='javascript:;'>加入收藏</a></div>
</div>
<!-- Topbar End -->
<!-- Header -->
<div id="header">
	<div class='wrapper fn-clear'>
		<h1><a hidefocus='true' href='/' title=''>火秀</a></h1>
		<ul id='nav' class='nav'>
			<?php if($user['uid']) { ?>
			<li class='nav-item nav-item-my-huoshow<?php if($_GET[a] == mylike) { ?> nav-item-current<?php } ?>'>
				<a target="_blank" class='nav-item-link' hidefocus='true' href='/m<?php echo $user['uid'];?>.html' title=''>我的火秀</a>
			</li>
			<?php } ?><!-- 登录后添加“我的火秀”-->
			<li class='nav-item nav-item-all<?php if($_GET[a] == index or $_GET[a] == lists) { ?> nav-item-current<?php } ?>'>
				<a class='nav-item-link' hidefocus="true" href="/" title=''><?php if($_GET[classid]) { ?><?php echo $class_name;?><?php } else { ?>全部<?php } ?></a>
				<div id='sub-nav' class='sub-nav fn-clear'>
					<ul class='sub-nav-list'>
						<?php $n=1;if(is_array($class_data)) foreach($class_data AS $r) { ?>
						<li class='sub-nav-item'>
						<?php if($n==1) { ?><a target="_blank" class='sub-nav-item-link' href='/'>全部</a><?php } ?>
						<a target="_blank" class='sub-nav-item-link' href='/fl-<?php echo $r['id'];?>.html'
						 <?php if($r[id] == $_GET[classid]) { ?>style="background-color: #D6383B; color: #FFFFFF;"<?php } ?>>
						 <?php echo $r['name'];?><?php if($n==3 or $n==8 or $n==15 or $n==20) { ?><span class='icon icon-hot'>HOT</span><?php } ?>
						</a>
						</li>
						<?php if($n%6==0) { ?></ul><ul class='sub-nav-list'><?php } ?>
						<?php $n++;}unset($n); ?>
					</ul>
					<!--<span class='icon icon-new'>NEW</span>-->
				</div>
			</li>
			<li class='nav-item<?php if($_GET[a] == square) { ?> nav-item-current<?php } ?>'><a class='nav-item-link' hidefocus='true' href='/fxgc.html' title='' target="_blank">分享广场</a></li>
			<li class='nav-item<?php if($_GET[a] == myshow_shopping_index) { ?> nav-item-current<?php } ?>'><a class='nav-item-link' hidefocus='true' href='/gw.html' title='' target="_blank">购物<span class='icon icon-hot'>HOT</span></a></li>
			<!--<li class='nav-item'><a href='/' title=''>圈子</a></li>-->
			<li class='nav-item<?php if($_GET[a] == myshow_album_index) { ?> nav-item-current<?php } ?>'><a class='nav-item-link' hidefocus='true' href='/zj.html' title='' target="_blank">专辑</a></li>
			<li class='nav-item<?php if($_GET[a] == talent) { ?> nav-item-current<?php } ?>'><a class='nav-item-link' hidefocus='true' href='/dr.html' title='' target="_blank">达人</a></li>
		</ul>
		<?php if($user['uid']) { ?>
		<ul id='menu' data-id="<?php echo $user['uid'];?>"><!-- 登录后添加此区块 -->
			<!-- <li class='msg sys-msg'><a href='#' title='系统消息'>系统消息<span></span></a></li> -->
			<li class='msg user-msg'><a target="_blank" href="/msg.html" title='用户消息'>用户消息<span></span></a></li>
			<li id="menu_user">
				<a class="nav" href="/m<?php echo $user['uid'];?>.html"><img src="<?php echo $user_info['0']['head_img_url'];?>" height='20' width='20' /><strong><?php echo $user_info['0']['nickname'];?></strong><em></em></a>
				<ul>
					<li class="mine"><div class="links"><a target="_blank" href="/m<?php echo $user['uid'];?>.html">我的火秀<!--<div class="info"><span>采集</span><span>画板</span></div>--></a></div><em></em></li>
					<!--<li class="mobile"><div class="links"><a href="/apps/">火秀手机客户端<div class="info"><span>iPhone</span><span>Android</span></div></a></div><em></em></li>-->
					<!--li class="friends"><div class="links"><a href="/friends/weibo/">查找邀请好友<div class="info"></div></a></div><em></em></li-->
					<!--li class="goodies"><div class="links"><a href="/about/goodies/">采集工具</a></div><em></em></li-->
					<!--<li class="papers"><div class="links"><a href="http://blog.huaban.com/">火秀访谈</a><a href="/weekly/">火秀周刊</a></div><em></em></li>-->
					<!--<li class="about"><div class="links"><a href="/about/">关于&amp;帮助</a><a href="/pins/53553/">用户反馈</a><a href="/about/links/">友情链接</a><a href="/fm/joinus/">加入我们</a></div><em></em></li>-->
					<li class="settings"><div class="links"><a target="_blank" href="/zhsc.html">帐号设置</a><a class='logout' href='http://<?php global $SYSCONFIG;echo $SYSCONFIG["SpaceSiteRoot"]?>/member.php?mod=logging&action=logout&formhash=58cf358d'>退出登录</a></div><em></em></li>
				</ul>
			</li>
		</ul>
		<?php } ?>
		<div id='loginbar'>
			<a class='login' href='javascript:;'>登录</a>
			<a class='reg' href='/index.php?m=community&c=firstlogshow&a=myregist'>注册</a>
		</div>

		<div id='add' class='add<?php if($user[uid]) { ?> logged<?php } ?>'><!-- 登录后添加加类“logged” -->
			<ul class='add-list'>
				<li><a class='collect' href='javascript:;' data-id='collect-all-pin'>网址分享</a></li>
				<li><a class='create' href='javascript:;' data-id='create-album-dialog'>创建专辑</a></li>
				<li><a class='upload' href='/index.php?m=community&c=myhuoshow&a=batch_upload&album_id=<?php echo $getalbum_id;?>' data-id='upload-pin-dialog'>我要上传</a></li>
			</ul>
		</div>

		<form id="search" class='search' name="search" method="post" action="/index.php?m=community&c=index&a=search" target="_blank">
			<div class='fancy'><input type="text" class="text search-wd" name="q" id="search-wd" /><label class='label'>搜索你喜欢的</label></div><input type="submit" id="search-submit" value="搜索" />
		</form>
	</div>
</div>
<!-- Header End -->

<!-- 登录区块: 登录后会去掉此区块 -->
<?php $spaceurl=DX_URL?>
<?php if(!$user['uid']) { ?>
<div id="login-dialog" class='login-dialog'>
	<div class="header"><h2>登录火秀</h2></div>
	<div class="body fn-clear">
		<div class="login-connect">
			<h4>使用合作网站帐号登录</h4>
			<div class="connections"><a class="douban login-button" href="<?php echo $spaceurl;?>api/apidenglu.php?t=douban&p=get_user_base_info">豆瓣</a><a class="renren login-button" href="<?php echo $spaceurl;?>api/apidenglu.php?t=renren&p=get_user_base_info">人人</a><a class="qq login-button" href="<?php echo $spaceurl;?>api/apidenglu.php?t=qzone&p=get_user_base_info">QQ</a></div>
			<p class="notice">未注册过火秀也可以直接登录哦</p>
		</div>
		<div class="login-form">
			<h4>使用注册帐号登录</h4>
			<form class="form" method="post" action="http://<?php global $SYSCONFIG;echo $SYSCONFIG['SpaceSiteRoot']?>/member.php?mod=logging&action=login&loginsubmit=yes&handlekey=login&floatlogin=yes&loginfield=username&questionid=0&answer=&loginsubmit=yes&myshow=yes">
				<ul>
					<li class="fancy email"><input type="text" autofocus='true' name="username" class='input' id="login_email" /><label class='label'>用户名登录</label></li>
					<li class="fancy password"><input type="password" name="password" class='input' id="login_password" /><label class='label'>密码</label></li>
				</ul>
				<div class="login-help">
					<button type='submit' class='sbtn lbtn' href='#'>登录</button>
					<!--a class="help" href="#" id="reset_password">忘记了密码？</a>
					<a class="help fn-hide" href="#" id="back_to_login">哦，又想起来了!</a-->
				</div>
			</form>
		</div>
	</div>
	<a class="close" href="#" title="关闭"></a>
</div>

<!-- <div id="loginbar">
	<div class="connect">
		<h4>使用合作网站帐号登录:</h4>
		<a class="renren login-button" href="<?php echo $spaceurl;?>api/apidenglu.php?t=renren&p=get_user_base_info">人人</a>
		<a class="douban login-button" href="<?php echo $spaceurl;?>api/apidenglu.php?t=douban&p=get_user_base_info">豆瓣</a>
		<a class="qq login-button" href="<?php echo $spaceurl;?>api/apidenglu.php?t=qzone&p=get_user_base_info">QQ</a>
	</div>
	<a class='login' href='javascript:;'>登录</a>
	<a class='reg' href="/index.php?m=community&c=firstlogshow&a=myregist">马上注册</a>
</div> -->
<?php } ?>
<!-- 登录区块结束 -->

<!-- 遮罩层 -->
<div id="page-overlay" class="overlay"></div>
<!-- 回到顶部按钮 -->
<a id="scroll-to-top" href='javascript:;' hidefocus='true'>回到顶部</a>

<!-- 发送私信表单 -->
<form id='send-msg-form' class='fn-hide' method='post' action=''><div class='fancy'><textarea name='msg' class='input'></textarea><label class='label'>请输入私信内容！</label></div></form>