<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!--热点排行-->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=070a2f23d41e98ee3eacc92b2661d470&action=hits_all_channel&siteid=%24siteid&order=views+DESC&num=10&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('siteid'=>$siteid,'order'=>'views DESC',)).'070a2f23d41e98ee3eacc92b2661d470');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits_all_channel')) {$data = $content_tag->hits_all_channel(array('siteid'=>$siteid,'order'=>'views DESC','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
		<div class="ui_fold_box ui_fold_box_redian">
			<h3 class='ui_fold_box_title'><span>热点排行</span></h3>
			<ul class='ui_fold_box_content'>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='<?php if($n==1 && !empty($r[thumb])) { ?>ui_fold_box_content_selected<?php } else { ?>top_no<?php } ?>'> <span class='top_no'><?php echo $n;?></span>
					<div> <img src='<?php echo thumb($r[thumb],106,82);?>' width='106' height='82' />
						<h4><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo str_cut($r[title],60,'..');?></a></h4>
						<p><?php echo str_cut($r[description],80,'..');?></p>
					</div>
				</li>
             <?php $n++;}unset($n); ?>
			</ul>
		</div>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		<!--热点排行结束-->