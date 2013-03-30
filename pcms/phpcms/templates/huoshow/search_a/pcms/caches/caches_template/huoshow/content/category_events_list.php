<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","events_header"); ?>
<!--Main Body-->
<div class="main_body">
	<div class="Subpage_left">
		<div class="Subpage_left_xx_01">
			<div class="Subpage_left_xx">
				<div class="subpage_news">
					<div class="subpage_news_bt">
						<h2 class="bt1"><?php echo getCatNameFromCatid($catid);?></h2>
					</div>
					<ul>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=042bd91d40b3442bac805fe298bb8472&action=lists&catid=%24catid&num=24&order=id+DESC&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 24;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'id DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'id DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li>
							<span class="date_011"><a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>" target="_blank"><?php echo str_cut($r[title],75,'');?></a></span>
							<span class="date_01"><?php echo date($r['inputtime']);?></span>
						</li>
						<?php if($n%5==0 && $n<count($data)) { ?>
					</ul>
					<ul>
						<?php } ?>
						<?php $n++;}unset($n); ?>
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<div class="clear"></div>
					<div class="fanye">
						<div id="pages" class="text-c"><?php echo $pages;?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="Subpage_right">
		<!--Banner 300*250-->
		<div class="banner_300_250">
			<script type="text/javascript">
			// <![CDATA[
			OA_show(50);
			// ]]>
			</script>
			<noscript>
				<a target='_blank' href='http://misc.huoshow.com/www/delivery/ck.php?n=a6657f4d'><img border='0' alt='' src='http://misc.huoshow.com/www/delivery/avw.php?zoneid=50&n=a6657f4d' /></a>
			</noscript>
		</div>

		<!--今日推荐-->
		<!--#include virtual="/api.php?op=movie&p=get_recommend_day_news&siteid=<?php echo $siteid;?>&catid=9&other_catids=12|电影,14|游戏,109|超模"-->
		<!--今日推荐结束-->
		
		<!--热点视频-->
		<!--//#include virtual="/api.php?op=movie&p=get_site_hot_vedio&siteid=<?php echo $siteid;?>"-->
		<!--热点结束-->
		<!--热点排行-->
		<!--#include virtual="/api.php?op=movie&p=get_all_hot_news_rand&siteid=<?php echo $siteid;?>"-->
		<!--热点排行结束-->
		<!--网友热议-->
		<!--#include virtual="/api.php?op=movie&p=get_muchweibo_dynamic"-->
		<!--网友热议结束-->
		<!--热门图片 -->
		<!--#include virtual="/api.php?op=movie&p=get_channel_hot_img&catids=139&num=6"-->
		<!--热门图片结束 -->
	</div>
	<div class="clear"></div>
</div>
<?php include template("content","footer"); ?>