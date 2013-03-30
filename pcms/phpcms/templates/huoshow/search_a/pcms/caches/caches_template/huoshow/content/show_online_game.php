<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?> 火秀网</title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
	<meta name="description" content="<?php echo $SEO['description'];?>">
	<meta name='author' content='火秀网' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href='<?php echo CSS_PATH;?>hs-game-global.css' rel='stylesheet' />
	<?php if((empty($pictureurls) || $img_attachment_mode==2)) { ?><?php } else { ?><link href='<?php echo CSS_PATH;?>hs-game-picshow.css' rel='stylesheet' /><?php } ?>
	<link href='http://www.huoshow.com/favicon.ico' rel='icon' />
</head>

<body <?php if((empty($pictureurls) || $img_attachment_mode==2)) { ?> class='game-show js-scroll-top'<?php } else { ?>class='game-picshow'<?php } ?>>
	<?php include template('content', 'hs_topbar'); ?>
	<?php include template('content', 'game_header_product'); ?>
	<?php if(empty($pictureurls)) { ?>
	<div id='content'>
		<!-- 主内容 -->
		<div id='main' class='article-box'>
			<div class='article-header'>
				<h2 class='title'><?php echo $title;?></h2>
				<div class='link'>
				<span><a href="http://game.huoshow.com" target="_blank">http://game.huoshow.com</a></span>
				<span><?php echo $inputtime;?></span>
				<span>来源：<?php echo $copyfrom;?></span>
					<!--<a href='#'>[欢迎纠错/提意见]</a> -->
					<!--<a href='#'>[热门新闻TOP10]</a>-->
					我来说两句(<a href="#comment_iframe" id="comment" class='comment' style="margin-left:0px;">0</a>)
					</div>
			</div>
			<p class='intro'>摘要：<?php echo $description;?></p>
			<div class='content'>
				<?php echo $content;?>
			</div>
			<div id='pager' class="article-related article-pager ui-pager"><?php echo url_change($pages);?></div>
			<div class='article-related article-actions'>
				<!-- JiaThis Button BEGIN -->
				<span id='jiathis' class="jiathis_style jiathis">
					<span class="jiathis_txt">分享到：</span>
					<a href="javascript:(function(){window.open('http://v.t.sina.com.cn/share/share.php?title='+encodeURIComponent('<?php echo $title;?>'+'<?php echo $description;?>')+'&url='+encodeURIComponent(location.href)+'&appkey='+SINA_APPKEY,'_blank','width=450,height=400');})()"><img src="http://www.huoshow.com/img/templates/default/images/sina.gif" title="新浪微博"/></a>
					 <a href="javascript:(function(){window.open('http://v.t.qq.com/share/share.php?title='+encodeURIComponent('<?php echo $title;?>'+'<?php echo $description;?>')+'&url='+encodeURIComponent(location.href)+'&source='+QQ_SOURCEID+'&pic=','转播到腾讯微博', 'width=700, height=580, top=320, left=180, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no'); })()"><img src="http://www.huoshow.com/img/templates/default/images/qq.png" title="腾讯微博"/></a>
					 <a href="javascript:u=location.href;t='<?php echo $title;?>';c = %22%22 + (window.getSelection ? window.getSelection() : document.getSelection ? document.getSelection() : document.selection.createRange().text);var url=%22http://cang.baidu.com/do/add?it=%22+encodeURIComponent(t)+%22&iu=%22+encodeURIComponent(u)+%22&dc=%22+encodeURIComponent('<?php echo $description;?>')+%22&fr=ien#nw=1%22;window.open(url,%22_blank%22,%22scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes%22); void 0"><img src="http://www.huoshow.com/img/templates/default/images/baidu.gif" title="百度搜藏"/></a> <a href="javascript:u='http://share.xiaonei.com/share/buttonshare.do?link='+encodeURIComponent(location.href)+'&title='+encodeURIComponent('<?php echo $title;?>'.substring(0,76));window.open(u,'xiaonei','toolbar=0,resizable=1,scrollbars=yes,status=1,width=626,height=436');void(0)" title="人人网"/></a> <a href="javascript:window.open('http://shuqian.qq.com/post?from=3&title='+encodeURIComponent('<?php echo $title;?>'.substring(0,76))+'&uri='+encodeURIComponent(location.href)+'&jumpback=2&noui=1','favit','width=930,height=470,left=50,top=50,toolbar=no,menubar=no,location=no,scrollbars=yes,status=yes,resizable=yes');void(0)"><img src="http://www.huoshow.com/img/templates/default/images/qzone.gif" title="Qzone" /></a> <a href="javascript:d=document;t=d.selection?(d.selection.type!='None'?d.selection.createRange().text:''):(d.getSelection?d.getSelection():'');void(kaixin=window.open('http://www.kaixin001.com/~repaste/repaste.php?&rurl='+escape(d.location.href)+'&rtitle='+escape('<?php echo $title;?>')+'&rcontent='+escape('<?php echo $description;?>'),'kaixin'));kaixin.focus();"><img src="http://www.huoshow.com/img/templates/default/images/kaixin.gif" title="开心网"/></a> <a href="javascript:var%20u='http://www.douban.com/recommend/?url='+encodeURIComponent(location.href)+'&title='+encodeURIComponent('<?php echo $title;?>'.substring(0,76));window.open(u,'douban','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330');void(0)"><img src="http://www.huoshow.com/img/templates/default/images/douban.gif" title="豆瓣网"/></a> <a title="分享到搜狐微博" href="javascript:void((function(s,d,e,r,l,p,t,z,c){var f='http://t.sohu.com/third/post.jsp?',u=z||d.location,p=['&url=',e(u),'&title=',e(t||d.title),'&content=',c||'gb2312','&pic=',e(p||'')].join('');function%20a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=660,height=470,left=',(s.width-660)/2,',top=',(s.height-470)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent,'','','','','','utf-8'));" ><img src="http://www.huoshow.com/img/templates/default/images/sohu.png" title="搜狐微博"/></span></a> <a href="javascript:var u=location.href;var t=document.title;t=t.substr(0,80)+'by:Addthis.org.cn';var c=''+(window.getSelection?window.getSelection():document.getSelection?document.getSelection():document.selection.createRange().text);c=c.substr(0,280);var e=encodeURIComponent;var url='http://share.renren.com/share/buttonshare.do?link='+e(u)+'&title='+e(t)+'';window.open(url,'addthis.org.cn','toolbar=0,resizable=1,scrollbars=yes,status=1,width=600,height=450');void(0)"><img src="http://www.huoshow.com/img/templates/default/images/rr.gif" title="人人网"/></span></a>
					<!-- <a class="jiathis_button_ishare">一键分享奖Q币</a> -->
					<!-- <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a> -->
					<!-- <a class="jiathis_counter_style"></a> -->
					<!--<span class='desc'><a href='#'>[奖励规则]</a> <a href='#'>[Q币商城]</a></span>-->
					<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js?uid=1349664104558770" charset="utf-8"></script>
				</span>
			</div>

			<div class="article-related news-related">
				<h4>关于<strong><?php echo $title;?></strong>的相关新闻</h4>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=59d3146c936b0bbb61d83c4d89437c20&action=relation&relation=%24relation&id=%24id&catid=%24catid&num=5&keywords=%24rs%5Bkeywords%5D\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'relation')) {$data = $content_tag->relation(array('relation'=>$relation,'id'=>$id,'catid'=>$catid,'keywords'=>$rs[keywords],'limit'=>'5',));}?>
				<ul class="ui-list">
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class="ui-list-item"><a target="_blank" href="<?php echo url_change($r[url]);?>"><?php echo $r['title'];?></a> <span class="date">(<?php echo date('Y-m-d H:i:s',$r[inputtime]);?>)</span></li>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class='article-related news-hot'>
				<div class='header-news'>
					<h2 class='title'>今日热点新闻</h2>
					<!--<div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div>-->
				</div>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=947db4ba0d78cf748b822cb5cf3cd746&action=position&posid=509&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'509','order'=>'listorder DESC','limit'=>'5',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n<3) { ?>
				<?php if($n==1) { ?><ul class='ui-img-list'><?php } ?>
					<li class='ui-img-list-item'>
						<a class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],160,120);?>' width='122' height='90' /></a>
						<h4 class='title'><a href="<?php echo url_change($r[url]);?>"> <?php echo str_cut($r['title'],20,'');?></a></h4>
					</li>
				<?php if($n==2) { ?></ul><?php } ?>
				<?php } else { ?>
				<h2 class='ui-newgame-title'><a href="<?php echo url_change($r[url]);?>"> <?php echo str_cut($r['title'],80,'');?></a></h2>
				<?php } ?>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				<ul class='ui-list'>
			        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=861cb2da2f531e0eec4785a3be0df26a&action=morecatids&catids=260%2C261%2C262%2C263%2C264&newsnum=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'morecatids')) {$data = $content_tag->morecatids(array('catids'=>'260,261,262,263,264','newsnum'=>'5','limit'=>'20',));}?>
                        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                            <li class='ui-list-item'><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],60,'');?></a></li>
                        <?php $n++;}unset($n); ?>
			        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>

				<!-- 评论 -->
		<div id='to_comment' class="comment">
			<?php if($allow_comment && module_exists('comment')) { ?>
      		<iframe src="<?php echo APP_PATH;?>index.php?m=comment&c=index&a=init&commentid=<?php echo id_encode("content_$catid",$id,$siteid);?>&iframe=1" width="100%" height="200" id="comment_iframe" frameborder="0" scrolling="no">
      		</iframe>
      		<?php } ?>
		</div>
		<!-- 评论结束语 -->

			<div class='article-related comment-ranking'>
				<div class='header-news'>
					<h2 class='title'>火秀评论排行榜</h2>
				</div>
				<ul class='ui-list'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"comment\" data=\"op=comment&tag_md5=3672797e82ff6fc2ad9a710c7ecd1c8e&action=bang&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$comment_tag = pc_base::load_app_class("comment_tag", "comment");if (method_exists($comment_tag, 'bang')) {$data = $comment_tag->bang(array('limit'=>'5',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-list-item'><a target="_blank"  href="<?php echo url_change($r[url]);?>"> <?php echo str_cut($r['title'],60,'');?></a> <span class='comment-num'>评论 <em><?php echo $r['total'];?></em> 条</span></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>

			<div class='article-related article-gallery'>
				<div class='header-news'>
					<h2 class='title'>游戏精彩图集</h2>
				</div>
				<ul class='ui-img-list'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c9567d68016935821a45c6037c2d52ed&action=position&posid=510&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'510','order'=>'listorder DESC','limit'=>'3',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-img-list-item'>
						<a class='img' target="_blank" href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],160,120);?>' width='160' height='120' /></a>
						<h4 class='title'><a target="_blank" href="<?php echo url_change($r[url]);?>"> <?php echo str_cut($r['title'],48,'');?></a></h4>
					</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>
		</div>

		<div id='side'>
			<div class='ui-box-side ui-box-rdtj'>
				<h2 class='ui-box-side-title'>热点推荐</h2>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a015b2f48f3394d2225dcb066cd8b350&action=rand_news_hothits&catids=260%2C263%2C272%2C286%2C304%2C310%2C316&newsnum=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'rand_news_hothits')) {$data = $content_tag->rand_news_hothits(array('catids'=>'260,263,272,286,304,310,316','newsnum'=>'12','limit'=>'20',));}?>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <?php if($n==1 || $n==7) { ?>
                <h3 class='subtitle'><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],70,'');?></a></h3>
                <?php } else { ?>
                <?php if($n==2) { ?><ul class='ui-list'><?php } ?>
                <li class='ui-list-item'><a href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],70,'');?></a></li>
                <?php if($n==12) { ?></ul><?php } ?>
                <?php } ?>
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class='ad'><a href='#'><img src='http://i3.17173.itc.cn/2012/newgame/bigeyes/c1110hg04.jpg' alt='' width='280' height='248' /></a></div>

			<div class='ui-box-side ui-box-xyx'>
				<h2 class='ui-box-side-title'>新游戏</h2>
				<ul class='ui-img-list ui-img-list-plus'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=d3818e0167710451dacdded5234beb93&action=get_special_pos&posid=15&order=inputtime+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'15','order'=>'inputtime DESC','limit'=>'3',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-img-list-item'>
						<a class='img' href="<?php echo $r['url'];?>"  target="_blank"><img src='<?php echo thumb($r[thumb],73,73);?>' width='73' height='73' /></a>
						<a class='title' href="<?php echo $r['url'];?>"  target="_blank"><?php echo $r['special_name'];?></a>
					</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
				<ul class='ui-list ui-list-float hr'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=4f652fb289e3c86bcbd5277648d2785b&action=get_special_pos&posid=43&order=inputtime+DESC&num=24\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'43','order'=>'inputtime DESC','limit'=>'24',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-list-item'><a href="<?php echo $r['url'];?>"  target="_blank"><?php echo $r['special_name'];?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>

			<div class='ui-box-side ui-box-sptj'>
				<h2 class='ui-box-side-title'><!--视频推荐-->推荐新闻</h2>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a5e262be4bf969582c523a08a9224a73&action=position&posid=484&order=listorder+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'484','order'=>'listorder DESC','limit'=>'7',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n<3) { ?>
				<?php if($n==1) { ?><ul class='ui-img-list ui-img-list-plus'><?php } ?>
					<li class='ui-img-list-item'>
						<a target="_blank" class='img' href="<?php echo url_change($r[url]);?>" ><img src='<?php echo thumb($r[thumb],122,91);?>' width='122' height='91' /></a>
						<a target="_blank" class='title' href="<?php echo url_change($r[url]);?>" ><?php echo str_cut($r['title'],40,'');?></a>
					</li>
				<?php if($n==2) { ?></ul><?php } ?>
				<?php } else { ?>
				<?php if($n==3) { ?><ul class='ui-list ui-list-float'><?php } ?>
				<li class='ui-list-item'><a target="_blank" href="<?php echo url_change($r[url]);?>" ><?php echo str_cut($r['title'],60,'');?></a></li>
				<?php if($n==7) { ?></ul><?php } ?>
				<?php } ?>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class='ui-box-side ui-box-wydg'>
				<h2 class='ui-box-side-title'>网游大观</h2>
				<ul class='ui-img-list ui-img-list-plus'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4fa9544aa96261dcdce02e7f9f6fa160&action=position&posid=485&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'485','order'=>'listorder DESC','limit'=>'6',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-img-list-item'>
						<a class='img' href="<?php echo url_change($r[url]);?>"><img src='<?php echo thumb($r[thumb],122,91);?>' width='122' height='91' /></a>
						<a style="text-align:left;" class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],80,'');?></a>
					</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>

			<div class='ui-box-side ui-box-zxphb'>
				<h2 class='ui-box-side-title'>资讯排行榜</h2>
				<ol class='ui-list-plus'>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=43db320c2636e18d094d7009fcb6f0b0&action=rand_news_hothits&catids=253%2C263%2C272%2C286%2C304%2C310%2C311%2C313&newsnum=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'rand_news_hothits')) {$data = $content_tag->rand_news_hothits(array('catids'=>'253,263,272,286,304,310,311,313','newsnum'=>'10','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-list-plus-item'><span class='num num-hot'><?php echo $n;?></span><a class='title' href="<?php echo url_change($r[url]);?>"><?php echo str_cut($r['title'],60,'');?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ol>
			</div>
		</div>

		<div class='nav-footer'>
			<a href='/'>返回游戏首页</a>
			<a href='//www.huoshow.com/'>返回火秀首页</a>
		</div>
	</div>
	<?php } else { ?>
	<?php include template('content','common_new_pic'); ?>
	<?php } ?>

	<script src='<?php echo JS_PATH;?>seajs/sea.js' id='seajsnode' data-main='hs-game-main'></script>
	<script src="<?php echo APP_PATH;?>api.php?op=count&id=<?php echo $id;?>&modelid=<?php echo $modelid;?>"></script>
	<?php include template('content', 'hs_footer'); ?>
</body>
</html>