<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><h3 class='related_article_title'><span>相关阅读</span></h3>
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=968b87a4702934a31cc7ae2561a084e3&action=relation&relation=%24relation&id=%24id&catid=%24catid&num=10&keywords=%24keywords\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'relation')) {$data = $content_tag->relation(array('relation'=>$relation,'id'=>$id,'catid'=>$catid,'keywords'=>$keywords,'limit'=>'10',));}?>
<ul class='related_article_list'>
<?php if($data) { ?>
	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	<li><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>" target="_blank"><?php echo $r['title'];?></a></li>
	<?php $n++;}unset($n); ?>
<?php } ?>
</ul>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>