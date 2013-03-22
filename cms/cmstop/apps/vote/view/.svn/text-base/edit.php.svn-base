<?php $this->display('header');?>
<form name="vote_edit" id="vote_edit" method="post" action="?app=vote&controller=vote&action=edit">
	<input type="hidden" name="modelid" id="modelid" value="<?=$modelid?>" />
	<input type="hidden" name="contentid" id="contentid" value="<?=$contentid?>" />
	<? if($status == 6): ?>
	<input type="hidden" name="url" id="url" value="<?=$url?>" />
	<? endif; ?>
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
			<td><input name="type" type="radio" class="checkbox_style" value="radio"<? if($type == "radio"){?> checked="checked"<? } ?> onclick="$('#maxoptions_span').hide();" /> 单选
			    <input name="type" type="radio" class="checkbox_style" value="checkbox"<? if($type == "checkbox"){?> checked="checked"<? } ?> onclick="$('#maxoptions_span').show();" /> 多选
			    <span id="maxoptions_span" <?php if($type == "radio"){?>style="display:none;"<?php } ?>>最多可选  <input id="maxoptions" name="maxoptions" type="text" size="2" value="<?=$maxoptions?>" /> 项 <?=element::tips('留空为不限制')?></span>
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
							<th width="11%">排序</th>
							<th width="60%">选项</th>
							<th width="11%">票数</th>
							<th width="18%">操作</th>
						</tr>
					</thead>
					<tbody id="options">
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<th></th>
			<td><div class="mar_l_8 mar_5"><input type="button" name="add_option_btn" value="增加选项" class="hand button_style" onclick="option.add()" /></div></td>
		</tr>
	</table>
	
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="mar_l_8 mar_t_10 table_form">
        <tr>
            <th width="60">介绍：</th>
            <td><textarea name="description" id="description" maxLength="255" style="width:710px;height:40px" class="bdr"><?=$description?></textarea> </td>
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
			<td>同IP <input id="mininterval" name="mininterval" type="text" value="<? if($mininterval){ echo $mininterval; }?>" size="4" />小时内不得重复投票 <?=element::tips('0或者留空为不限制')?></td>
		</tr>
		<tr>
			<th>开始时间：</th>
			<td><input id="starttime" name="starttime" type="text" class="input_calendar" value="<?=$starttime ? date('Y-m-d H:i:s', $starttime) : ''?>" size="20"/></td>
		</tr>
		<tr>
			<th>截止时间：</th>
			<td><input id="endtime" name="endtime" type="text" class="input_calendar" value="<?=$endtime ? date('Y-m-d H:i:s', $endtime) : ''?>" size="20"/></td>
		</tr>
          <tr>
            <th><?=element::tips('权重将决定文章在哪里显示和排序')?> 权重：</th>
            <td>
            <?=element::weight($weight);?>
            </td>
          </tr>
          <tr>
          <th><?=element::tips('可将文章推送至指定页面的区块，给页面编辑提供参考')?> <span style="color:#077ac7">推荐：</span></th>
          <td><?=element::section($contentid)?></td>
          </tr>		
	</table>
	<div id="expand">
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
		  <tr>
                  <th class="vtop">相关：</th>
                  <td colspan="3"><?=element::related($contentid)?></td>
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
          		  <td><?=table('status', $status, 'name')?></td>
      		    </tr>
	</table>
	</div>
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
		<tr><th width="60"></th>
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
<?php foreach ($option as $k=>$r):?>
option.add('<?=$r['name'];?>', '<?=$r['votes'];?>', '<?=$r['sort'];?>', '<?=$r['optionid'];?>');
<?php endforeach;?>
</script>

<?php $this->display('footer');