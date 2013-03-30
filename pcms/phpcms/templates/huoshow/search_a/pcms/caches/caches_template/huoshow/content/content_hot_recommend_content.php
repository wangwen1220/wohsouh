<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><h3 class='related_article_title'><span>热点推荐</span></h3>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d10a16a6e0c964b88af3cb86103a1915&action=position&posid=%24posidimg&catid=%24catid&thumb=1&order=listorder+DESC&num=4&cache=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('posid'=>$posidimg,'catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC',)).'d10a16a6e0c964b88af3cb86103a1915');if(!$data = tpl_cache($tag_cache_name,60)){$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>$posidimg,'catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'4',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<ul class='related_image_list'>
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	<li>
		<a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><img src="<?php echo thumb($r[thumb],120,90);?>" width='120' height='90' /></a>
		<span><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank" style="border:none;"><?php echo str_cut($r[title],24,'');?></a></span>
	</li>
	<?php $n++;}unset($n); ?>
</ul>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c37aae01252935d963212e07c2fd5bdf&action=position&posid=%24posid&catid=%24catid&order=listorder+DESC&num=5&cache=60\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array('posid'=>$posid,'catid'=>$catid,'order'=>'listorder DESC',)).'c37aae01252935d963212e07c2fd5bdf');if(!$data = tpl_cache($tag_cache_name,60)){$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>$posid,'catid'=>$catid,'order'=>'listorder DESC','limit'=>'5',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
<ul class='related_article_list related_article_sublist'>
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	<li><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo $r['title'];?></a></li>
	<?php $n++;}unset($n); ?>
</ul>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>