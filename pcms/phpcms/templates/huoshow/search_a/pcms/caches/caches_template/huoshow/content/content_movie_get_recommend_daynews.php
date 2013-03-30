<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!--今日推荐-->
		<div class="ui_tab_box">
			<h3 class='ui_tab_box_title'>今日推荐</h3>
			<dl id='kandyTabs' class='kandyTabs'>
            <?php $n=1;if(is_array($cat_arr)) foreach($cat_arr AS $cat) { ?>
				<dt><?php echo $cat['cat_name'];?></dt>
				<dd>
					<ul class='ui_tab_box_content'>
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b6ba93d3c84bc2549e728cefb682c815&action=lists&catid=%24cat%5Bcat_id%5D&num=10&order=inputtime+DESC&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('catid'=>$cat[cat_id],'order'=>'inputtime DESC',)).'b6ba93d3c84bc2549e728cefb682c815');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$cat[cat_id],'order'=>'inputtime DESC','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
                    	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li><span<?php if($n<=3) { ?> class='top_no'<?php } ?>><?php echo $n;?></span><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo str_cut($r[title],56,'');?></a></li>
                        <?php $n++;}unset($n); ?>
                     <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</dd>
             <?php $n++;}unset($n); ?>  
				
			</dl>
		</div>
		<!--今日推荐结束-->