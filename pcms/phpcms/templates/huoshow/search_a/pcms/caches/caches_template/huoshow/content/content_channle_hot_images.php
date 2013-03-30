<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><div class="right_news_jiaodian">
			<div class="right_news_zixun">
				<div class="right_news_zixun_01">
					<div class="right_news_jiaodian_bt ui_list_box_title"><span class="wenzi">频道热门图片 </span></div>
					<div class="zixun_pic">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ede0196e9890662706cf10f190b68602&action=channel_hot_img&catids=%24catids&imgcount=%24img_count&cache=PCNT_CACHELEFTTIME\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'channel_hot_img')) {$data = $content_tag->channel_hot_img(array('catids'=>$catids,'imgcount'=>$img_count,'limit'=>'20',));}?>
						<ul>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<li><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><img src="<?php echo thumb($r[thumb],120,90);?>" width="120" height="90" /><?php echo str_cut($r[title],28,'');?></a></li>
						<?php $n++;}unset($n); ?>
						</ul>
					 <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
				</div>
			</div>
		</div>
