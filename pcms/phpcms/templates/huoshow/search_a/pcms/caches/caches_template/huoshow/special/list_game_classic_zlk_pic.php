<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title><?php if($info[name] !="") { ?><?php echo $title;?>_<?php echo $info['name'];?><?php } else { ?><?php echo $top_title;?><?php } ?>_火秀游戏库</title>
	<meta name="keywords" content="<?php echo $keyword;?>" />
	<meta name="description" content="<?php echo $description;?>" />
	<meta name='author' content='火秀网' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href='<?php echo CSS_PATH;?>special/game-classic.css' rel='stylesheet' />
	<link href='/favicon.ico' rel='icon' />
</head>

<body class='game-zlk'>
	<?php include template('content', 'hs_topbar'); ?>
	<?php include template('special', 'game_header_classic'); ?>

	<div class='ui-layout fn-clear'>
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=c66cd7b2d7e6bbc84af676a40740ba7e&action=get_special_info&specialid=%24id\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_info')) {$data = $special_tag->get_special_info(array('specialid'=>$id,'limit'=>'20',));}?>
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<a class='img-game' href='#'><img src='<?php echo thumb($r['thumb'],360,270);?>' alt='' width='360' height='270' /></a>
	<?php $n++;}unset($n); ?>
	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		<div class='cnt'>
			<h2 class='title'>
				<a href='#'><?php echo $title;?></a>
				<!--<span>别名：天堂永恒</span>-->
			</h2>
			<a class='vote' href='#'>投一票</a>
			<p class='rank'><span class='dt'>排名：</span><strong>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=a3e927cb5cd88b1b410713f52fb55ea9&action=get_rated_number_special&specialid=%24id\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_rated_number_special')) {$data = $special_tag->get_rated_number_special(array('specialid'=>$id,'limit'=>'20',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php echo $r['rated_number'];?>
			<?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</strong> <!--【查看全榜】<em><?php echo $r['rated_number'];?></em>人喜欢这款游戏--></p>
			
			<p class='grade'><span class='dt'>点评：</span><span class='star star-2'></span></p>
			<ul class='info'>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=c66cd7b2d7e6bbc84af676a40740ba7e&action=get_special_info&specialid=%24id\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_info')) {$data = $special_tag->get_special_info(array('specialid'=>$id,'limit'=>'20',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li><span class='dt'>游戏画面：</span><em class='dd'><?php echo $r['game_menu'];?></em></li>
				<li><span class='dt'>游戏类型：</span><em class='dd'><?php echo $r['game_type'];?></em></li>
				<li><span class='dt'>测试时间：</span><em class='dd'><?php echo $r['game_state'];?></em></li>
				<li><span class='dt'>开发商：</span><em class='dd'><?php echo $r['developers'];?></em></li>
				<li><span class='dt'>官方网站：</span><em class='dd'><a target='_blank' href="<?php echo $r['official'];?>">点击进入</a></em></li>
				<li><span class='dt'>运营商：</span><em class='dd'><?php echo $r['operators'];?></em></li>
				<!--<li><span class='dt'>游戏特征：</span><em class='dd'>PK</em></li>
				<li><span class='dt'>收费：</span><em class='dd'>文字</em></li>-->
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
			<div class='desc'>
				<h3><?php echo $title;?>简介：</h3>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=c66cd7b2d7e6bbc84af676a40740ba7e&action=get_special_info&specialid=%24id\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_info')) {$data = $special_tag->get_special_info(array('specialid'=>$id,'limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<p><span><?php echo $r['description'];?></span><a id='js_open_desc' class='open' href='javascript:;'>展开</a></p>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
		<div class='share fn-clear'>
			<!-- JiaThis Button BEGIN -->
				<span id='jiathis' class="jiathis_style jiathis">
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
				<!--<div class='comment'><a href='#'>我要评论</a>，共有<em>4566</em>人评论</div>-->
		</div>
	</div>

	<div id='content'>
		<div id='main'>

			<div class='article article-news'>
				<div class='ui-header ui-header-classic'>
					<h2 class='title'><?php echo $info['name'];?>列表</h2>
				</div>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=a36ebefef84596363eff8aff8b4d833b&action=content_list&specialid=%24specialid&typeid=%24typeid&listorder=5&page=%24page&num=16\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'content_list')) {$pagesize = 16;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$special_total = $special_tag->count(array('specialid'=>$specialid,'typeid'=>$typeid,'listorder'=>'5','limit'=>$offset.",".$pagesize,'action'=>'content_list',));$pages = pages($special_total, $page, $pagesize, $urlrule);$data = $special_tag->content_list(array('specialid'=>$specialid,'typeid'=>$typeid,'listorder'=>'5','limit'=>$offset.",".$pagesize,'action'=>'content_list',));}?>
				<ul class="ui-img-list fn-clear" style="text-align:left;">
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class="ui-img-list-item">
						<a class='img' href='<?php echo url_change($r[url]);?>'><img src='<?php echo thumb($r[thumb],152,114);?>' width='152' height='114' /></a>
						<h3 class='title'><a href='<?php echo url_change($r[url]);?>'><?php echo str_cut($r['title'],40,'');?></a></h3>
					</li>
				<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
			<div id='pager' class="pager ui-pager"><?php echo $pages;?></div>
		</div>

		<div id='side'>
			<div class='ui-box-side ui-box-side-top'>
				<h2 class='ui-box-side-title'>同风格游戏推荐</h2>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=3bf799d56eb541726d38f60b581749a2&action=get_thesame_gamestyle&specialid=%24id\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_thesame_gamestyle')) {$data = $special_tag->get_thesame_gamestyle(array('specialid'=>$id,'limit'=>'20',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<div class='ui-art fn-clear'>
					<a class='img' href='<?php echo url_change($r[url]);?>' target='_blank'><img src='<?php echo thumb($r[thumb],132,99);?>' alt='' width='132' height='99' /></a>
					<h3 class='title'><a href='<?php echo url_change($r[url]);?>' target='_blank'><?php echo str_cut($r['title'],20,'');?></a></h3>
					<ul class="info">
						<li><em>风格：</em><?php echo $r['game_style'];?></li>
						<li><em>画面：</em><?php echo $r['game_menu'];?></li>
						<li><em>类型：</em><?php echo $r['game_type'];?></li>
					</ul>
				</div>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class='ui-box-side ui-box-side-form'>
				<h2 class='ui-box-side-title'>游戏搜索</h2>
				<form class='search' name='search' method='get' action='<?php echo APP_PATH;?>index.php' target="_blank">
					<fieldset>
					<input type="hidden" value="search" name="app" />
					<input type="hidden" value="index" name="controller" />
					<input type="hidden" value="search" name="action" />
					<input type="hidden" name="m" value="search" />
					<input type="hidden" name="c" value="index" />
					<input type="hidden" name="a" value="init" />
					<input type="hidden" name="typeid" value="1" id="typeid" />
				    <input type="text" class="search-wd" name="q" value='请输入游戏名称...' /><button type='submit' class='search-submit'>搜索</button></fieldset>
				</form>
			</div>

			<div class='ui-box-side ui-box-side-rank'>
				<h2 class='ui-box-side-title'>游戏搜索 Top10</h2>
				<table class='ui-rank-table'>
					<thead>
						<tr>
							<th>排名</th>
							<th>游戏名称</th>
							<th>时间</th>
						</tr>
					</thead>
					<tbody>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=1d640392cd66e4231ceac1cc6ce7a755&action=get_special_pos&posid=41&order=inputtime+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'get_special_pos')) {$data = $special_tag->get_special_pos(array('posid'=>'41','order'=>'inputtime DESC','limit'=>'10',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<tr>
							<td><span class='num <?php if($n<4) { ?>num-hot<?php } ?>'><?php echo $n;?></span></td>
							<td><a href='<?php echo $r['url'];?>'><?php echo $r['special_name'];?></a></td>
							<td><?php echo date('Y-m-d',$r[inputtime]);?></td>
						</tr>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script src='<?php echo JS_PATH;?>seajs/sea.js' id='seajsnode' data-main='special-game-classic'></script>
	<?php include template('content', 'hs_footer'); ?>
</body>
</html>