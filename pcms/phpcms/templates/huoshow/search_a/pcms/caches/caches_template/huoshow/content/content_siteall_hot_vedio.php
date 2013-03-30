<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5183f361d7c56d74a51e2680cfab61a9&action=site_all_hot_vedio\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'site_all_hot_vedio')) {$data = $content_tag->site_all_hot_vedio(array('limit'=>'20',));}?>
<div class="right_news_jiaodian">
			<div class="right_news_jiaodian_01">
				<div class="right_news_jiaodian_bt  ui_list_box_title"><span class="wenzi">热点视频</span><!--<span class="yingshi_dujia_more"></span>--></div>
				<div class="zixun_pic">
					<ul>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li><a href="<?php echo $r['url'];?>" target="_blank" title="<?php echo $r['title'];?>"><img alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],120,90);?>" width="120" height="90" "/></a><a href="<?php echo $r['url'];?>" target="_blank" title="<?php echo $r['title'];?>"><?php echo str_cut($r[title],30,'');?></a></li>
					<?php $n++;}unset($n); ?>
					</ul>
				</div>
			</div>
		</div>
		
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>