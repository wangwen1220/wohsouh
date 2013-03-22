<?php $this->display('header', 'system');?>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/dropdown/style.css"/>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.dropdown.js"></script>
<div class="bk_8"></div>
<div class="tag_1">
   <div id="add_data">
	  <select id="changerank" style="width:100px;z-index:99;" marginTop="1" marginLeft="0">
  		  <option value="pv">点击排行</option>
  		  <option value="comment" selected>评论排行</option>
	  </select>
	</div>
	<ul class="tag_list" style="margin-left:160px">
	    <li><a href="?app=system&controller=rank_comment&action=index" class="s_3">全站排行</a></li>
	    <li><a href="?app=system&controller=rank_comment&action=category">按栏目排行</a></li>
	    <li><a href="?app=system&controller=rank_comment&action=model">按模型排行</a></li>
	    <li><a href="?app=system&controller=rank_comment&action=admin">按编辑排行</a></li>
	</ul>
</div>
<div class="f_l" style="width:48%;margin:0 10px 10px 10px;padding-bottom:20px">

<div class="box_10 p_r mar_t_10 clear" id="rank_comment">
<h3><span class="f_l b">评论排行</span></h3>
<div class="p_a tag_span tag_list_3">
<span class="s_4">今日</span>
<span>昨日</span>
<span>本周</span>
<span>本月</span></div>
<ul class="txt_list" id="rank_comment_today">
<?php 
$created_min = strtotime(date('Y-m-d 00:00:00'));
$data = loader::model('admin/content')->select("status=6 AND created>=$created_min", '*', 'comments DESC', 50);
if($data)
{ 
	foreach ($data as $r)
	{
   	   $cat = table('category', $r['catid']);
   	   $r['caturl'] = $cat['url'];
   	   $r['catname'] = $cat['name'];
?>
<li><span class="f_r c_red"><?=$r['comments']?></span><span class="f_l"><a href="<?=$r['caturl']?>">[<?=$r['catname']?>]</a> <a href="javascript: ct.assoc.open('<?=content_url($r['contentid'], $r['modelid'])?>', 'newtab');"><?=$r['title']?></a></span></li>
<?php 
	 }
}
?>
</ul>
	
<ul class="txt_list" id="rank_comment_yesterday" style="display:none;">
<?php 
$yesterday = strtotime('yesterday');
$created_min = strtotime(date('Y-m-d 00:00:00', $yesterday));
$created_max = strtotime(date('Y-m-d 23:59:59', $yesterday));
$data = loader::model('admin/content')->select("status=6 AND created>=$created_min AND created<=$created_max", '*', 'comments DESC', 50);
if($data)
{ 
	 foreach ($data as $r)
	 {
   	   $cat = table('category', $r['catid']);
   	   $r['caturl'] = $cat['url'];
   	   $r['catname'] = $cat['name'];
?>
<li><span class="f_r c_red"><?=$r['comments']?></span><span class="f_l"><a href="<?=$r['caturl']?>">[<?=$r['catname']?>]</a> <a href="javascript: ct.assoc.open('<?=content_url($r['contentid'], $r['modelid'])?>', 'newtab');"><?=$r['title']?></a></span></li>
<?php 
	 }
}
?>
</ul>
      		
<ul class="txt_list" id="rank_comment_week" style="display:none;">
<?php 
$created_min = strtotime('last monday');
$data = loader::model('admin/content')->select("status=6 AND created>=$created_min", '*', 'comments DESC', 50);
if($data)
{ 
	 foreach ($data as $r)
	 {
   	   $cat = table('category', $r['catid']);
   	   $r['caturl'] = $cat['url'];
   	   $r['catname'] = $cat['name'];
?>
<li><span class="f_r c_red"><?=$r['comments']?></span><span class="f_l"><a href="<?=$r['caturl']?>">[<?=$r['catname']?>]</a> <a href="javascript: ct.assoc.open('<?=content_url($r['contentid'], $r['modelid'])?>', 'newtab');"><?=$r['title']?></a></span></li>
<?php 
	 }
}
?>
</ul>

<ul class="txt_list" id="rank_comment_month" style="display:none;">
<?php 
$created_min = strtotime(date('Y-m-01 00:00:00'));
$data = loader::model('admin/content')->select("status=6 AND created>=$created_min", '*', 'comments DESC', 50);
if($data)
{ 
	 foreach ($data as $r)
	 {
   	   $cat = table('category', $r['catid']);
   	   $r['caturl'] = $cat['url'];
   	   $r['catname'] = $cat['name'];
?>
<li><span class="f_r c_red"><?=$r['comments']?></span><span class="f_l"><a href="<?=$r['caturl']?>">[<?=$r['catname']?>]</a> <a href="javascript: ct.assoc.open('<?=content_url($r['contentid'], $r['modelid'])?>', 'newtab');"><?=$r['title']?></a></span></li>
<?php 
	 }
}
?>
</ul>
   <div class="clear"></div>
</div>

</div>

<div class="f_r" style="width:48%;margin:0 10px 10px 10px;;padding-bottom:20px">

	
</div>
<script type="text/javascript">
$('#changerank').dropdown({
	changerank:{
		onchange:function(action, name){
			window.location.href = '?app=system&controller=rank_'+action+'&action=index';
		}
	}
});
</script>
<?php $this->display('footer', 'system');?>