<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!--网友热议-->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=376cdf8aa89d2ce40c835635c7366e19&action=weibo_hit_dynamic&num=10&cache=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array()).'376cdf8aa89d2ce40c835635c7366e19');if(!$data = tpl_cache($tag_cache_name,60)){$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'weibo_hit_dynamic')) {$data = $content_tag->weibo_hit_dynamic(array('limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
		<div class="ui_fold_box ui_fold_box_reyi">
			<h3 class='ui_fold_box_title'><span>网友热议</span></h3>
			<ul class='ui_fold_box_content'>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='<?php if($n==1) { ?>ui_fold_box_content_selected<?php } else { ?>top_no<?php } ?>'> <span class='top_no'><?php echo $n;?></span>
					<div> <a href="http://space.huoshow.com/<?php echo $r['uid'];?>" title="去他的微博首页"><img src='<?php echo $r['head_img_url'];?>'  width='50' height='50' /></a>
						<h4><a href="http://space.huoshow.com/<?php echo $r['uid'];?>" title="去他的微博首页"><?php echo $r['nicename'];?>:</a><?php echo str_cut($r[msg],38,'..');?></h4>
						<p><?php echo $r['msg'];?></p>
					</div>
				</li>
             <?php $n++;}unset($n); ?>   
				
			</ul>
		</div>
		<!--网友热议结束-->