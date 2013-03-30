<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('special', 'game_header'); ?>

	<!-- Content -->
	<div id="content" class='fn-clear'>
		<!-- Main -->
		<div id="main">
			<div class="ui-box ui-box-download fn-clear">
				<div class="header fn-clear">
				<h2 class="site-nav"><a href='/game'>火秀游戏</a> <span class='bk'>＞</span> <a href='<?php echo $url;?>'><?php echo $title;?></a> <span class='bk'>＞</span> <?php echo $info['name'];?></h2>
				<!--<a class='game-news' href='#'>2011-08-11 小游戏公测</a>-->
				</div>
				<div class="intro">
					<div class="game-box">
						<a class='img' href='#'><img src='/statics/images/special/index-game-blue/test2.png' width='92' height='69' /></a>
						<h3 class='game-title'><a href='#'>仙尘传传</a></h3>
						<ul class='game-info'>
							<li><em>本月新增 </em>45658</li>
							<li><em>类型：</em>3D/角色扮演</li>
						</ul>
					</div>
					<div class="game-vote">
						<div class="game-vote-stat game-vote-good"><span class='game-vote-progress progress88'>88%</span> <a class='game-vote-btn' href='javascript:;'>还不错</a></div>
						<div class="game-vote-stat game-vote-bad"><span class='game-vote-progress progress88'>58%</span> <a class='game-vote-btn' href='javascript:;'>很一般</a></div>
					</div>
				</div>
				<div class="download">
					<div class="download-btn">
						<div class="download-link"><a href='#'>注册游戏账号</a> <span class='bk'>|</span> <a href='#'>进入官网</a></div>
					</div>
				</div>
				<div class="ad fn-cb"><a href='#'><img src='/statics/images/special/index-game-black/game-num.png' width='630' height='50' /></a></div>
			</div>

			<!-- 新闻列表 -->
			<!--<div class="ui-box ui-box-news-list">
				<div class="ui-box-header fn-clear">
					<h2 class='title'>资讯列表</h2>
				</div>
				
				<ul class="ui-news-list fn-clear">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=7bb059eaedfec2e4abd7b5c64690828c&action=content_list&specialid=%24specialid&typeid=%24typeid&listorder=5&page=%24page&num=30\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'content_list')) {$pagesize = 30;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$special_total = $special_tag->count(array('specialid'=>$specialid,'typeid'=>$typeid,'listorder'=>'5','limit'=>$offset.",".$pagesize,'action'=>'content_list',));$pages = pages($special_total, $page, $pagesize, $urlrule);$data = $special_tag->content_list(array('specialid'=>$specialid,'typeid'=>$typeid,'listorder'=>'5','limit'=>$offset.",".$pagesize,'action'=>'content_list',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				
					<li class="ui-news-list-item"><a href='<?php echo $r['url'];?>'><?php echo $r['title'];?></a> <span><?php echo date('Y-m-d',$r['inputtime']);?></span></li>
				<?php if($n%5==0 && $n<count($data)) { ?>
				
				</ul>
				<ul class="ui-news-list fn-clear">
					<?php } ?>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				<div id='pager' class="pager ui-pager"><?php echo $pages;?></div>
			</div>-->

			<!-- 图片列表 -->
			<div class="ui-box ui-box-img ui-box-img-list">
				<div class="ui-box-header fn-clear">
					<h2 class='title'>图片/视频列表</h2>
				</div>
				<ul class="ui-img-list fn-clear">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=a36ebefef84596363eff8aff8b4d833b&action=content_list&specialid=%24specialid&typeid=%24typeid&listorder=5&page=%24page&num=16\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'content_list')) {$pagesize = 16;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$special_total = $special_tag->count(array('specialid'=>$specialid,'typeid'=>$typeid,'listorder'=>'5','limit'=>$offset.",".$pagesize,'action'=>'content_list',));$pages = pages($special_total, $page, $pagesize, $urlrule);$data = $special_tag->content_list(array('specialid'=>$specialid,'typeid'=>$typeid,'listorder'=>'5','limit'=>$offset.",".$pagesize,'action'=>'content_list',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class="ui-img-list-item">
						<a class='img' href='<?php echo url_change($r[url]);?>'><img src='<?php echo thumb($r[thumb],152,114);?>' width='152' height='114' /></a>
						<h3 class='title'><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],70,'');?></a></h3>
					</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	
				</ul>
				<div id='pager' class="pager ui-pager"><?php echo $pages;?></div>
			</div>
		</div>
		<!-- Main End -->

		<!-- Side -->
		<div id="side">
			<!-- AD 300*250 -->
			<div class="ad ad-300-250">
				<script src='http://misc.huoshow.com/www/delivery/spcjs1.php?id=2'></script>
				<script>
					// <![CDATA[
					OA_show(63);
					// ]]>
				</script>
				<noscript>
					<a target='_blank' href='http://misc.huoshow.com/www/delivery/ck.php?n=a1606dcd'><img alt='' src='http://misc.huoshow.com/www/delivery/avw.php?zoneid=63&n=a1606dcd' /></a>
				</noscript>
			</div>
		<!--今日推荐-->
		<!--#include virtual="/api.php?op=movie&p=get_recommend_day_news&siteid=<?php echo $siteid;?>&catid=12&other_catids=131,14|游戏,109|超模"-->
		<!--今日推荐结束-->

		<!--热点排行-->
		<!--#include virtual="/api.php?op=movie&p=get_all_hot_news_rand&siteid=<?php echo $siteid;?>"-->
		<!--热点排行结束-->
		
		<!--热点视频-->
		<!--#include virtual="/api.php?op=movie&p=get_site_hot_vedio&siteid=<?php echo $siteid;?>"-->
		<!--热点视频结束-->
			
		</div>
		<!-- Side End -->
	</div>
	<!-- Content End -->

	<!-- Content End -->
	<!-- Footer -->
	<div id="footer">
		<p>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e3d146232857be4579899ac97dbd2f7c&action=category&catid=1&num=15&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'1','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'15',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<a href="<?php echo url_change($r[url]);?>" target="_blank"><?php echo $r['catname'];?></a><?php if($n<count($data)) { ?> |<?php } ?>
			<?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</p>
		<p>HuoShow Copyright &copy; 1998 - 2012 All Rights Reserved.</p>
		<p>粤 ICP 备 06087881 号</p>
	</div>
	<!-- Footer End -->

	<script>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-19568132-1']);
		_gaq.push(['_setDomainName', '.huoshow.com']);
		_gaq.push(['_setAccount', 'UA-19568132-1']);
		_gaq.push(['_addOrganic', 'baidu', 'word']);
		_gaq.push(['_addOrganic', 'soso', 'w']);
		_gaq.push(['_addOrganic', '3721', 'name']);
		_gaq.push(['_addOrganic', 'yodao', 'q']);
		_gaq.push(['_addOrganic', 'vnet', 'kw']);
		_gaq.push(['_addOrganic', 'sogou', 'query']);
		_gaq.push(['_addIgnoredOrganic', '火秀']);
		_gaq.push(['_addIgnoredOrganic', '火秀网']);
		_gaq.push(['_addIgnoredOrganic', 'huoshow']);
		_gaq.push(['_addIgnoredOrganic', 'www.huoshow.com']);
		_gaq.push(['_setDomainName', '.huoshow.com']);
		_gaq.push(['_trackPageview']);

		(function(window) {
			var document = window.document;
			window.onload = function() {
				// 加载谷歌统计代码
				var ga = document.createElement('script'),
					head = document.getElementsByTagName('head')[0];
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				head.appendChild(ga);

				// 加载 CNZZ 统计代码
				var cnzz = document.createElement('script');
				cnzz.src = 'http://s16.cnzz.com/stat.php?id=2692090&web_id=2692090';
				//cnzz.style.display = 'none';
				head.appendChild(cnzz);
			};
		})(window);
	</script>
	<!-- <div style='display:none;'><script src="http://s16.cnzz.com/stat.php?id=2692090&web_id=2692090"></script></div> -->
</body>
</html>