<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?> 火秀网</title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
	<meta name="description" content="<?php echo $SEO['description'];?>">
	<meta name='author' content='火秀网' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href='<?php echo CSS_PATH;?>hs-game-apple.css' rel='stylesheet' />
	<?php if((empty($pictureurls) || $img_attachment_mode==2)) { ?><?php } else { ?><link href='<?php echo CSS_PATH;?>hs-game-picshow.css' rel='stylesheet' /><?php } ?>
	<link href='http://www.huoshow.com/favicon.ico' rel='icon' />
</head>

<body <?php if((empty($pictureurls) || $img_attachment_mode==2)) { ?> class='game-apple game-apple-show js-scroll-top'<?php } else { ?>class='game-picshow'<?php } ?>>
	<?php include template('content', 'hs_topbar'); ?>
	<?php include template('content', 'game_header_apple'); ?>
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
			
			<!--<p class='intro'>相关推荐：<a href='#'><em>何洁在京举办新专辑发布会</em></a> - <a href='#'><em>而手捧99朵玫瑰花的男友赫子铭作为神</em></a> - <a href='#'><em>而手捧99朵玫瑰花的男友赫子铭作为神</em></a> - <a href='#'>把何洁感动得泪如雨下</a> - 而手捧99朵玫瑰花的男 - 友赫子铭作为神而手 - <a href='#'><em>把何洁感动得泪如雨下曾遭到坊间一阵热</em></a></p>-->

			<div id='pager' class="article-related article-pager ui-pager"><?php echo url_change($pages);?></div>

			<div class='article-related article-actions'>
				<!-- JiaThis Button BEGIN -->
				<span id='jiathis' class="jiathis_style jiathis">
					<span class="jiathis_txt">分享到：</span>
					<a href="javascript:(function(){window.open('http://v.t.sina.com.cn/share/share.php?title='+encodeURIComponent('<?php echo $title;?>'+'<?php echo $description;?>')+'&url='+encodeURIComponent(location.href)+'&appkey='+SINA_APPKEY,'_blank','width=450,height=400');})()"><img src="http://www.huoshow.com/img/templates/default/images/sina.gif" title="新浪微博"/></a>
					 <a href="javascript:(function(){window.open('http://v.t.qq.com/share/share.php?title='+encodeURIComponent('<?php echo $title;?>'+'<?php echo $description;?>')+'&url='+encodeURIComponent(location.href)+'&source='+QQ_SOURCEID+'&pic=','转播到腾讯微博', 'width=700, height=580, top=320, left=180, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no'); })()"><img src="http://www.huoshow.com/img/templates/default/images/qq.png" title="腾讯微博"/></a>
					 <a href="javascript:u=location.href;t='<?php echo $title;?>';c = %22%22 + (window.getSelection ? window.getSelection() : document.getSelection ? document.getSelection() : document.selection.createRange().text);var url=%22http://cang.baidu.com/do/add?it=%22+encodeURIComponent(t)+%22&iu=%22+encodeURIComponent(u)+%22&dc=%22+encodeURIComponent('<?php echo $description;?>')+%22&fr=ien#nw=1%22;window.open(url,%22_blank%22,%22scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes%22); void 0"><img src="http://www.huoshow.com/img/templates/default/images/baidu.gif" title="百度搜藏"/></a> <a href="javascript:u='http://share.xiaonei.com/share/buttonshare.do?link='+encodeURIComponent(location.href)+'&title='+encodeURIComponent('<?php echo $title;?>'.substring(0,76));window.open(u,'xiaonei','toolbar=0,resizable=1,scrollbars=yes,status=1,width=626,height=436');void(0)" title="人人网"/></a> <a href="javascript:window.open('http://shuqian.qq.com/post?from=3&title='+encodeURIComponent('<?php echo $title;?>'.substring(0,76))+'&uri='+encodeURIComponent(location.href)+'&jumpback=2&noui=1','favit','width=930,height=470,left=50,top=50,toolbar=no,menubar=no,location=no,scrollbars=yes,status=yes,resizable=yes');void(0)"><img src="http://www.huoshow.com/img/templates/default/images/qzone.gif" title="Qzone" /></a> <a href="javascript:d=document;t=d.selection?(d.selection.type!='None'?d.selection.createRange().text:''):(d.getSelection?d.getSelection():'');void(kaixin=window.open('http://www.kaixin001.com/~repaste/repaste.php?&rurl='+escape(d.location.href)+'&rtitle='+escape('<?php echo $title;?>')+'&rcontent='+escape('<?php echo $description;?>'),'kaixin'));kaixin.focus();"><img src="http://www.huoshow.com/img/templates/default/images/kaixin.gif" title="开心网"/></a> <a href="javascript:var%20u='http://www.douban.com/recommend/?url='+encodeURIComponent(location.href)+'&title='+encodeURIComponent('<?php echo $title;?>'.substring(0,76));window.open(u,'douban','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330');void(0)"><img src="http://www.huoshow.com/img/templates/default/images/douban.gif" title="豆瓣网"/></a> <a title="分享到搜狐微博" href="javascript:void((function(s,d,e,r,l,p,t,z,c){var f='http://t.sohu.com/third/post.jsp?',u=z||d.location,p=['&url=',e(u),'&title=',e(t||d.title),'&content=',c||'gb2312','&pic=',e(p||'')].join('');function%20a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=660,height=470,left=',(s.width-660)/2,',top=',(s.height-470)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent,'','','','','','utf-8'));" ><img src="http://www.huoshow.com/img/templates/default/images/sohu.png" title="搜狐微博"/></span></a> <a href="javascript:var u=location.href;var t=document.title;t=t.substr(0,80)+'by:Addthis.org.cn';var c=''+(window.getSelection?window.getSelection():document.getSelection?document.getSelection():document.selection.createRange().text);c=c.substr(0,280);var e=encodeURIComponent;var url='http://share.renren.com/share/buttonshare.do?link='+e(u)+'&title='+e(t)+'';window.open(url,'addthis.org.cn','toolbar=0,resizable=1,scrollbars=yes,status=1,width=600,height=450');void(0)"><img src="http://www.huoshow.com/img/templates/default/images/rr.gif" title="人人网"/></span></a>
					<!-- <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a> -->
					<!-- <a class="jiathis_counter_style"></a> -->
					<!--<span class='desc'><a href='#'>[奖励规则]</a> <a href='#'>[Q币商城]</a></span>-->
					<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js?uid=1349664104558770" charset="utf-8"></script>
				</span>
				<!-- JiaThis Button END -->
				<!--<a class='comment' href='#'>我要评论(1)</a>-->
			</div>

			<div class='article-related news-hot fn-clear'>
				<div class='header-news'>
					<h2 class='title'>近期关注</h2>
					<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div> -->
				</div>
				<div id='myfocus-classichc' class='ui-myfocus'>
					<div class="loading"></div>
					<div class="pic">
						<ul>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2f87b97c4badfabe7f077e80b1884e2d&action=lists&catid=%24catid&order=listorder+DESC+LIMIT+1%2C5--\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder DESC LIMIT 1,5--','limit'=>'20',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li><a href="<?php echo url_change($r[url]);?>" target='_blank'><img src="<?php echo thumb($r[thumb],326,216);?>" thumb="" alt="<?php echo $r['title'];?>" width='326' height='216' /></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
				</div>

				<ul class='ui-list'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7c4b1b47ba5017f9d4f40cae8470f87d&action=lists&catid=%24catid&order=listorder+DESC+LIMIT+5%2C4--\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder DESC LIMIT 5,4--','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-list-item'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],60,'');?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
				<ul class='ui-list hr'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2ce69a99877a735285ffddd28673ba0e&action=lists&catid=%24catid&order=listorder+DESC+LIMIT+10%2C4--\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder DESC LIMIT 10,4--','limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-list-item'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r['title'],60,'');?></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>

			<div class='article-related article-gallery'>
				<div class='header-news'>
					<h2 class='title'>iphone推荐游戏</h2>
					<!-- <div class='link'><a class='more' href='#'>更多&gt;&gt;</a></div> -->
				</div>
				<ul class='ui-img-list ui-img-list-plus'>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=78b8475b356a96b7d1b885acd47d7da8&action=position&posid=547&order=listorder+DESC&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'547','order'=>'listorder DESC','limit'=>'12',));}?>
   				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-img-list-item' style="text-align: left;">
						<a class='img img-mgame' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],75,75);?>' width='75' height='75' /><span class='mark-img'></span></a>
						<a class='title' href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r[title], 30,'');?></a>
					</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>

			<div id='to_comment' class="comment">
			<?php if($allow_comment && module_exists('comment')) { ?>
      		<iframe src="<?php echo APP_PATH;?>index.php?m=comment&c=index&a=init&commentid=<?php echo id_encode("content_$catid",$id,$siteid);?>&iframe=1" width="100%" height="200" id="comment_iframe" frameborder="0" scrolling="no">
      		</iframe>
      		<?php } ?>
		</div>
		</div>

		<div id='side'>
			<div class='ui-box-side ui-box-hotgame ui-box-side-top'>
				<h2 class='ui-box-side-title'>IPhone游戏推荐</h2>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=da2f93ce30447793b929639eea326e71&action=position&posid=547&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'547','order'=>'listorder DESC','limit'=>'5',));}?>
				<ul class='ui-hotgame-list'>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-hotgame-list-item'>
						<a class='img img-mgame img-mgame-50' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],50,50);?>' alt='' width='50' height='50' /><span class='mark-img'></span></a>
						<h3 class='title'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r[title], 30,'');?></a></h3>
						<!-- span class='num'><?php echo $r['stars'];?></span> -->
						<div class="content" style="width: 180px;">
							<p><?php echo str_cut($r[description],80,'');?></p>
						</div>
						<a class='button' href="<?php echo url_change($r[url]);?>" target='_blank'></a>
					</li>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class='ui-box-side ui-box-hotgame'>
				<h2 class='ui-box-side-title'>IPhone软件推荐</h2>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=55c440364166c117cc7fb02fab7c0103&action=position&posid=548&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'548','order'=>'listorder DESC','limit'=>'5',));}?>
				<ul class='ui-hotgame-list'>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-hotgame-list-item'>
						<a class='img img-mgame img-mgame-50' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],50,50);?>' alt='' width='50' height='50' /><span class='mark-img'></span></a>
						<h3 class='title'><a href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r[title], 30,'');?></a></h3>
						<!-- span class='num'><?php echo $r['stars'];?></span> -->
						<div class="content" style="width: 180px;">
							<p><?php echo str_cut($r[description],80,'');?></p>
						</div>
						<a class='button' href="<?php echo url_change($r[url]);?>" target='_blank'></a>
					</li>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class='ui-box-side ui-box-gallery'>
				<h2 class='ui-box-side-title'>iPhone 推荐壁纸</h2>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e4d9bd9ccba19429a279f782dc6a8cb4&action=lists&catid=212&num=4&order=inputtime+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'212','order'=>'inputtime DESC','limit'=>'4',));}?>
				<ul class='ui-img-list ui-img-list-plus'>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='ui-img-list-item'>
						<a class='img' href="<?php echo url_change($r[url]);?>" target='_blank'><img src='<?php echo thumb($r[thumb],110,162);?>' width='110' height='162' /></a>
						<a class='title' href="<?php echo url_change($r[url]);?>" target='_blank'><?php echo str_cut($r[title], 30,'');?></a>
					</li>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
	</div>
<?php } else { ?>
<?php include template("content","common_new_pic"); ?>
<?php } ?>
	<script src='<?php echo JS_PATH;?>seajs/sea.js' id='seajsnode' data-main='hs-game-main'></script>
	<script language="JavaScript" src="<?php echo APP_PATH;?>api.php?op=count&id=<?php echo $id;?>&modelid=<?php echo $modelid;?>"></script>
	<?php include template('content', 'hs_footer'); ?>
</body>
</html>