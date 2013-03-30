<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","star_header"); ?>
<div class="p1">
	<div class="p1_l">
		<div class="pic_slide_wrapper">
			<!-- slide start -->
			<div class="pic_slide">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=623f5436caaf6c17ecc5f0891c5f79e0&action=position&posid=119&catid=%24catid&thumb=1&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'119','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'5',));}?>
				<ul>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li>
						<a href="<?php echo $r['url'];?>"><img src="<?php echo thumb($r[thumb],292,412);?>" alt="<?php echo $r['title'];?>" width='292' height='412' /></a>
						<h3><?php echo str_cut($r[title],50,'');?></h3>
					</li>
					<?php $n++;}unset($n); ?>
				</ul>
				<ol>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li class='num'><span><?php echo $n;?></span></li>
					<?php $n++;}unset($n); ?>
					<li class='next'><span>Next</span></li>
					<li class='prev'><span>Prev</span></li>
				</ol>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
		<!-- slide end -->

		<div class="star_rank">
			<h2 class='ui_star_title'>明星焦点</h2>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c06774a152396fd8aa6865775f3980bd&action=position&posid=124&catid=%24catid&thumb=1&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'124','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'2',));}?>
			<ul class='ui_img_list'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li>
					<a href="<?php echo $r['url'];?>"><img src="<?php echo thumb($r[thumb],126,84);?>" alt="<?php echo $r['title'];?>" width='126' height='84' /></a>
					<h5><a href="<?php echo $r['url'];?>"><?php echo str_cut($r[title],50,'');?></a></h5>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c5ab08d8af2c14b280b670dd6fbd46c2&action=position&posid=125&catid=%24catid&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'125','catid'=>$catid,'order'=>'listorder DESC','limit'=>'6',));}?>
			<ul class='ui_text_list'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li><a href='<?php echo $r['url'];?>'><?php echo str_cut($r[title],55,'');?></a></li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>

		<div class="vote">
			<h2>狗仔街拍</h2>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=354b835fc5a89c5f2fba81c273cf568f&action=position&posid=126&catid=%24catid&thumb=1&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'126','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'2',));}?>
			<ul class='ui_articel_list'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li>
					<a class='ui_articel_img' href='<?php echo $r['url'];?>'><img src="<?php echo thumb($r[thumb],126,84);?>" alt="<?php echo $r['title'];?>" width='126' height='84' /></a>
					<h5><a href='<?php echo $r['url'];?>'><?php echo str_cut($r[title],30,'');?></a></h5>
					<p><?php echo str_cut($r[description],80);?> <a href='<?php echo $r['url'];?>'>[详细]</a></p>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>

	<div class="p1_m">
		<div class="hl_p1">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0f3cdb6fef1e7a87d8930901f9028b80&action=position&posid=120&catid=%24catid&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'120','catid'=>$catid,'order'=>'listorder DESC','limit'=>'1',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<h3><a href="<?php echo $r['url'];?>"><?php echo str_cut($r[title],56,'');?></a></h3>
				<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<div class="h1_p1_text">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4ae0220602bc79d61ef7d3f004f12be8&action=position&posid=121&catid=%24catid&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'121','catid'=>$catid,'order'=>'listorder DESC','limit'=>'4',));}?>
				<p>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<span><a target="_blank" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title],44,'');?></a> </span>
				<?php $n++;}unset($n); ?>
				</p>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9c44b8e5fd2f4befa56f7f97a6ab83a1&action=position&posid=122&catid=%24catid&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'122','catid'=>$catid,'order'=>'listorder DESC','limit'=>'1',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<h3><a href="<?php echo $r['url'];?>"><?php echo str_cut($r[title],56,'');?></a></h3>
				<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<div class="h1_p1_text2">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5143203210a50fd98c62b3e88daf1751&action=position&posid=123&catid=%24catid&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'123','catid'=>$catid,'order'=>'listorder DESC','limit'=>'6',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<p><span></span><a target="_blank" href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></p>
				<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
		<h4>港台星闻</h4>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d54cd8020376c0f4f366aafec6aae74a&action=lists&catid=35&order=updatetime+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'35','order'=>'updatetime DESC','limit'=>'5',));}?>
		<ul>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li><a target="_blank" href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></li>
			<?php $n++;}unset($n); ?>
		</ul>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		<h4>日韩星闻</h4>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=09c176bfe52e1244b44959ee6aed8189&action=lists&catid=36&order=updatetime+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'36','order'=>'updatetime DESC','limit'=>'5',));}?>
		<ul>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li><a target="_blank" href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></li>
			<?php $n++;}unset($n); ?>
		</ul>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		<h4>内地星闻</h4>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3cc408ce11d75190ddf974ea43b475eb&action=lists&catid=34&order=updatetime+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'34','order'=>'updatetime DESC','limit'=>'5',));}?>
		<ul>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li><a target="_blank" href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></li>
			<?php $n++;}unset($n); ?>
		</ul>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		<h4>欧美星闻</h4>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=14059ba5ec6877d22da5d34d41fdd742&action=lists&catid=37&order=updatetime+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'37','order'=>'updatetime DESC','limit'=>'7',));}?>
		<ul>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li><a target="_blank" href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></li>
			<?php $n++;}unset($n); ?>
		</ul>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	</div>
	<div class="p1_r">
		<div class="p1_r_1">
			<h2>火热进行中</h2>
			<div class="pic_word">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=36590850ce1558a90552b47fa9301f46&action=position&posid=127&catid=%24catid&thumb=1&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'127','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'4',));}?>
				<ul>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li>
					<a target="_blank" href="<?php echo $r['url'];?>">
					<img alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],100,90);?>" width="100" height="90" /></a>
					<span><a target="_blank" href="<?php echo $r['url'];?>">专题</a></span>
					<h5><a target="_blank" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title],20,'');?></a></h5>
					</li>
					<?php $n++;}unset($n); ?>
					<div class="clear"></div>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
		<div class="ad_r"> <script type="text/javascript">
				// <![CDATA[
				OA_show(59);
				// ]]>
			</script>
			<noscript>
				<a target='_blank' href='http://misc.huoshow.com/www/delivery/ck.php?n=a8cbbe52'><img border='0' alt='' src='http://misc.huoshow.com/www/delivery/avw.php?zoneid=59&n=a8cbbe52' /></a>
			</noscript></div>
		<div class="p1_r_3">
			<div class="bar_text">
				<h2>星踪</h2>
				<a target="_blank" href="http://www.huoshow.com/rss.php"><span class="font_12">订阅星踪</span></a>
				<div class="clear"></div>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=39328d7b16ef433b920fdd1abbfb3180&action=position&posid=140&catid=%24catid&thumb=1&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'140','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'1',));}?>
			<dl>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<dt><a target="_blank" href="<?php echo $r['url'];?>"><img alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],111,71);?>" width="111" height="71" /></a></dt>
				<dd><span><?php echo str_cut($r[title],20,'');?></span>
					<p class="font_12"><?php echo str_cut($r[description],80);?><a target="_blank" href="<?php echo $r['url'];?>">[详细]</a></p>
				</dd>
				<div class="clear"></div>
				<?php $n++;}unset($n); ?>
			</dl>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=79b8cb5faaeca753d233ecd8c1505f61&action=position&posid=128&catid=%24catid&order=listorder+DESC&num=11\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'128','catid'=>$catid,'order'=>'listorder DESC','limit'=>'11',));}?>
			<ul>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li><span>·</span><a target="_blank" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title],55,'');?></a></li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="ad"><script type="text/javascript">
				// <![CDATA[
				OA_show(61);
				// ]]>
			</script>
			<noscript>
				<a target='_blank' href='http://misc.huoshow.com/www/delivery/ck.php?n=a268fa80'><img border='0' alt='' src='http://misc.huoshow.com/www/delivery/avw.php?zoneid=61&n=a268fa80' /></a>
			</noscript></div>
<div class="p2">
	<div class="p2_l">
		<div class="p2_l_l">
			<div class="bar_text">
				<h2>一周要闻</h2>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b800e4be7634c31c70548b87500483f9&action=position&posid=129&order=listorder+DESC&num=9\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'129','order'=>'listorder DESC','limit'=>'9',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php if($n==1) { ?>
			<div class='ui_star_articel'>
				
				<a class='ui_articel_img' href='<?php echo $r['url'];?>' target="_blank"><img src="<?php echo thumb($r[thumb],120,76);?>" alt="<?php echo $r['title'];?>" width='120' height='76' /></a>
				<h5 class="ui_articel_title"><a href='<?php echo $r['url'];?>' target="_blank"><?php echo str_cut($r[title],30,'');?></a></h5>
					<p class="ui_articel_content"><?php echo str_cut($r[description],52,'...');?> <a href='<?php echo $r['url'];?>' target="_blank">[详细]</a></p>
			</div>
			<?php } else { ?>
			<!--<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b2df94e939a6e9e89af8a93c1d114ac3&action=hits&catid=%24catid&num=8&order=weekviews+DESC&cache=300\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$catid,'order'=>'weekviews DESC',)).'b2df94e939a6e9e89af8a93c1d114ac3');if(!$data = tpl_cache($tag_cache_name,300)){$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>$catid,'order'=>'weekviews DESC','limit'=>'8',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>-->
			<ul class='ui_text_list'>
				<li><a href='<?php echo $r['url'];?>'><?php echo str_cut($r[title],55,'');?></a></li>
			</ul>
			<?php } ?>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
		<div class="p2_l_r">
			<div class="pic_word2">
				<div class="bar_text">
					<h2>明星<!-- 视频 --></h2>
					<a target="_blank" href="/star/mingxingshipin/">更多</a>
					<div class="clear"></div>
				</div>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=edfc8096ae5d4d7f1baa211f402526e7&action=position&posid=130&catid=%24catid&thumb=1&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'130','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'6',));}?>
				<ul class="font_12">
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li><a target="_blank" href="<?php echo $r['url'];?>"><img style="background:none;" alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],103,68);?>" width="103" height="68" /></a><a target="_blank" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title],24,'');?></a></li>
					<?php $n++;}unset($n); ?>
					<div class="clear"></div>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
	</div>
	<div class="p2_r">
		<div class="ad2"><script type="text/javascript">
				// <![CDATA[
				OA_show(60);
				// ]]>
			</script>
			<noscript>
				<a target='_blank' href='http://misc.huoshow.com/www/delivery/ck.php?n=afcc291c'><img border='0' alt='' src='http://misc.huoshow.com/www/delivery/avw.php?zoneid=60&n=afcc291c' /></a>
			</noscript></div>
		<div class="p2_r_1">
			<div class="bar_text">
				<h2>找明星</h2>
				<a target="_blank" href="http://space.huoshow.com/show.php"><span class="font_12">我要成名</span></a>
				<div class="clear"></div>
			</div>
			<div>
				<form action="<?php echo APP_PATH;?>index.php" id="search" method="get" target="_blank" onsubmit="return checkSForm2()">
					<input type="hidden" name="m" value="search" />
					<input type="hidden" name="c" value="index" />
					<input type="hidden" name="a" value="init" />
					<input type="hidden" name="siteid" value="<?php echo $siteid;?>" id="siteid" />
					<input type="hidden" name="typeid" value="1" id="typeid" />
					<input type="text" class="text" name="q" id="q2" value="请输入关键字" onfocus="clearKeyword2()" onblur="clearKeyword2()"/>
					<input type="submit" id="button" class="button_bg" value="找一下"/>
				</form>
				<script>
				$(function(){
					window.clearKeyword2 = function(){
						var search_wd = $.trim($("#q2").val());
						if(search_wd=='请输入关键字'){
							$("#q2").val('');
						}
						if(search_wd==''){
							$("#q2").val('请输入关键字');
						}
					}

					window.checkSForm2 = function()
					{
						var search_wd = $.trim($("#q2").val());
						if(search_wd=='请输入关键字' || search_wd==''){
							alert('请输入关键字');
							return false;
						}
					}
				});
				</script>
			</div>
			<!--找明星-->
			<!--#include virtual="/api.php?op=movie&p=get_tags"-->
			<!--找明星结束-->
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="ad"><script type="text/javascript">
				// <![CDATA[
				OA_show(62);
				// ]]>
			</script>
			<noscript>
				<a target='_blank' href='http://misc.huoshow.com/www/delivery/ck.php?n=a394b21c'><img border='0' alt='' src='http://misc.huoshow.com/www/delivery/avw.php?zoneid=62&n=a394b21c' /></a>
			</noscript></div>

<div class="con_box_pic">
	<h2 class='con_box_pic_title'>明星美图</h2>
	<div class="con_box_pic_subtitle">
		<a href="<?php echo $CATEGORYS['62']['url'];?>" target="_blank">内地明星</a>
		<a href="<?php echo $CATEGORYS['63']['url'];?>" target="_blank">港台明星</a>
		<a href="<?php echo $CATEGORYS['185']['url'];?>" target="_blank">日韩明星</a>
		<a href="<?php echo $CATEGORYS['186']['url'];?>" target="_blank">欧美明星</a>
	</div>
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=69c1b057b5742204bed1d3db0c34ce7e&action=position&posid=131&catid=%24catid&thumb=1&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'131','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'10',));}?>
	<ul class="pic_set">
		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		<li><a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>" target="_blank">
			<img width="167" height="130" src="<?php echo thumb($r[thumb],167,130);?>"></a>
			<span><a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>" target="_blank"><?php echo str_cut($r[title],32,'');?></a></span>
		</li>
		<?php $n++;}unset($n); ?>
		<div class="clear"></div>
	</ul>
	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</div>


<!--Partners-->
<div class="main_body">
	<div class="partners">
		<div class="layer_one"><a>友情链接</a></div>
		<div class="layer_content">
			<p class="layer_content_txt"><a href="#">中影集团</a> | <a href="#">保利博纳</a> | <a href="#">华谊兄弟</a> | <a href="#">光线传媒</a> | <a href="#">激动娱乐</a> | <a href="#">橙天娱乐</a> | <a href="#">海润影视</a> | <a href="#">安乐传媒</a> | <a href="#">夏影业</a> | <a href="#">中北影视</a> | <a href="#">天娱传媒</a> | <a href="#">中圣春秋</a> | <a href="#">小马奔腾</a> <a href="#">金牌大风</a> | <a href="#">环球音乐</a> | <a href="#">Sony音乐</a> | <a href="#">华纳唱片</a> | <a href="#">华研音乐</a> | <a href="#">星光国际</a> | <a href="#">英皇星艺</a> | <a href="#">种子音乐</a> | <a href="#">海蝶音乐</a> | <a href="#">大国文化</a> | <a href="#">太合麦田</a> | <a href="#">福茂唱片</a> <a href="#">滚石唱片</a> <a href="#">麦特文化</a> | <a href="#">欢乐传媒</a> | <a href="#">星光UP传媒</a></p>
		</div>
	</div>
</div>
<?php include template("content","footer"); ?>