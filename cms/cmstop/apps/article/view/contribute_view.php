<?php $this->display('header');?>
<div class="bk_10"></div>
<div class="tag_1">
	<ul class="tag_list">
		<li class="s_3"><a href="?app=article&controller=contribute&action=view&contentid=<?=$contentid?>" class="s_3">查看</a></li>
	</ul>
	<input type="button" name="edit" value="修改" class="button_style_1" onclick="javascript:contribute.edit(<?=$contentid?>)" />
	<input type="button" name="preview" value="退稿" class="button_style_1" onclick="contribute.reject(<?=$contentid?>)"/>
	<input type="button" name="publish" value="发布" class="button_style_1" onclick="contribute.audit(<?=$contentid?>)"/>
	<input type="button" name="back" value="返回" class="button_style_1" onclick="javascript:history.go(-1);"/>
</div>
<div class="bg_2">
	<div class="f_l w_600 mar_r_8">
	<table width="500" border="0" cellspacing="0" cellpadding="0" class="table_form mar_t_10 mar_l_8">
		<tr><th width="70">标题：</th><td><?=$title?></td></tr>
		<tr><th>Tags：</th><td><?=$tags?></td></tr>
	</table>
	<div class="title mar_l_8">正文</div>
	<div class="content"><?=$content?></div>
	</div>
	<div class="f_l w_200 box_6">
		<h3><span class="b">稿件属性</span></h3>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_form">
			<tr><th width="70">ID：</th><td><?=$contentid?></td></tr>
			<tr><th>栏目：</th><td><a href="<?=$caturl?>" target="_blank"><?=$catname?></a></td></tr>
			<tr><th>投稿人：</th><td><a href="?app=member&controller=index&action=profile&userid=<?=$createdby?>" target="_blank"><?=$createdbyname?></a> &nbsp;</td></tr>
		</table>
	</div>
	<div class="clear"></div>
</div>
</div>
<script type="text/javascript" src="apps/article/js/contribute.js"></script>
<?php $this->display('footer');
