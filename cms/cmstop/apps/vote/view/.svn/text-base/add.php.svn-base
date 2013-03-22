<?php $this->display('header');?>
<form name="vote_add" id="vote_add" method="post" action="?app=vote&controller=vote&action=add">
	<input type="hidden" name="modelid" id="modelid" value="<?=$modelid?>">
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
          <tr>
            <th width="60"><span class="c_red">*</span> 栏目：</th>
            <td><?=element::category('catid', 'catid', $catid)?></td>
          </tr>
		<tr>
			<th width="60"><span class="c_red">*</span> 标题：</th>
			<td><?=element::title('title', $title, $color)?></td>
		</tr>
		<tr>
			<th>类型：</th>
			<td class="lh_24"><input name="type" type="radio" value="radio" checked="checked" class="checkbox_style" onclick="$('#maxoptions_span').hide();" /> 单选
			    <input name="type" type="radio" class="checkbox_style" value="checkbox" onclick="$('#maxoptions_span').show();" /> 多选
			    <span id="maxoptions_span" style="display: none">最多可选  <input id="maxoptions" name="maxoptions" type="text" size="2" value="<?=$maxoptions?>" /> 项 <?=element::tips('留空为不限制')?></span>
			</td>
		</tr>
	</table>
	
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="mar_l_8">
		<tr>
			<th width="60" style="color:#077AC7;font-weight:normal;" class="t_r"><span class="c_red">*</span> 选项：</th>
			<td>
				<table id="vote_options" width="600" border="0" cellspacing="0" cellpadding="0" class="table_info">
					<thead>
						<tr>
							<th width="5%">排序</th>
							<th width="60%">选项</th>
							<th width="10%">初始票数</th>
							<th width="16%">操作</th>
						</tr>
					</thead>
					<tbody id="options"></tbody>
				</table>
			</td>
	    </tr>
		<tr>
			<th></th>
			<td><div class="mar_l_8 mar_5"><input name="add_option_btn" type="button" value="增加选项" class="hand button_style" onclick="option.add()" /></div></td>
		</tr>
	</table>
	
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
        <tr>
            <th width="60">介绍：</th>
            <td><textarea name="description" id="description" maxLength="255" style="width:710px;height:40px" class="bdr"><?=$description?></textarea></td>
        </tr>
        <tr>
            <th>缩略图：</th>
            <td><?=element::thumb('thumb', '', 60)?></td>
        </tr>
		<tr>
			<th> Tags：</th>
			<td><?=element::tag('tags', $tags)?></td>
		</tr>
		<tr>
			<th>防刷限制：</th>
			<td>同IP <input id="mininterval" name="mininterval" type="text" value="<?=$mininterval?>" size="4" />小时内不得重复投票 <?=element::tips('0或者留空为不限制')?></td>
		</tr>
		<tr>
			<th>开始时间：</th>
			<td><input id="starttime" name="starttime" type="text" class="input_calendar" value="<?=$starttime?>" size="20"/></td>
		</tr>
		<tr>
			<th>截止时间：</th>
			<td><input id="endtime" name="endtime" type="text" class="input_calendar" value="<?=$endtime?>" size="20"/></td>
		</tr>
        <tr>
            <th><?=element::tips('权重将决定文章在哪里显示和排序')?> 权重：</th>
            <td>
            <?=element::weight();?>
            </td>
          </tr>
          <tr>
          <th><?=element::tips('可将文章推送至指定页面的区块，给页面编辑提供参考')?> <span style="color:#077ac7">推荐：</span></th>
          <td><?=element::section()?></td>
          </tr>
		
	</table>
	<div id="expand">
         <table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
         <tr>
              <th class="vtop">相关：</th>
              <td colspan="3"><?=element::related()?></td>
            </tr>
            <tr>
				<th class="vtop">发布时间：</th>
				<td colspan="3"><input id="published" name="published" type="text" class="input_calendar" value="<?=$published?>" size="20"/></td>
			</tr>
            <tr>
              <th width="60">评论：</th>
              <td width="170"><label><input type="checkbox" name="allowcomment" id="allowcomment" value="1" <?php if ($allowcomment) echo 'checked';?> class="checkbox_style"/> 允许</label></td>
              <th width="60"></th>
              <td></td>
            </tr>
            	<tr>
			<th>状态：</th>
			<td>
<?php 
$workflowid = table('category', $catid, 'workflowid');
if ($_roleid < 3 || !$workflowid){
?>
                <label><input type="radio" name="status" id="status" value="6" <?php if ($status == 6) echo 'checked';?> /> 发布</label> &nbsp;
<?php 
}
if ($workflowid && priv::aca('<?=$app?>', '<?=$app?>', 'approve')){
?>
                <label><input type="radio" name="status" id="status" value="3" <?php if ($_roleid > 2) echo 'checked';?> /> 送审</label> &nbsp;
<?php }?>
                <label><input type="radio" name="status" id="status" value="1" <?php if ($status == 1) echo 'checked';?> /> 草稿</label>
			</td>
		</tr>
         </table>
	</div>
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
		<tr>
			<th width="60"></th>
			<td width="60">
				<input type="submit" value="保存" class="button_style_2" style="float:left"/>
			</td><td style="color:#444;text-align:left">按Ctrl+S键保存</td>
		</tr>
	 </table>
</form>
<link href="<?=IMG_URL?>js/lib/colorInput/style.css" rel="stylesheet" type="text/css" />
<script src="<?=IMG_URL?>js/lib/cmstop.colorInput.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.uploadify.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.filemanager.js"></script>
<script type="text/javascript" src="apps/vote/js/option.js"></script>
<script type="text/javascript" src="js/related.js"></script>
<script type="text/javascript" src="apps/page/js/section.js"></script>
<script type="text/javascript">
option.add();
option.add();
</script>

<?php $this->display('footer');