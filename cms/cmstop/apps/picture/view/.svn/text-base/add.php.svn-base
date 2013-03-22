<?php $this->display('header');?>
<style type="text/css">
#fileQueue{background:#fffddd;opacity:20%;width:500px}
.uploadifyQueueItem{clear:both;margin-top:5px;overflow:hidden;}
.fileName,.percentage{float:left}
.cancel{float:right}
</style>
<form name="picture_add" id="picture_add" method="POST" action="?app=picture&controller=picture&action=add">
   <input type="hidden" name="modelid" id="modelid" value="<?=$modelid?>">
      <table width="98%" border="0" id="tabledata" cellspacing="0" cellpadding="0"   class="table_form mar_l_8">
          <tr>
            <th width="60"><span class="c_red">*</span> 栏目：</th>
            <td><?=element::category('catid', 'catid', $catid)?></td>
          </tr>
          <tr>
            <th><span class="c_red">*</span> 标题：</th>
            <td><?=element::title('title', $title, $color)?></td>
          </tr>
          <tr>
            <th> Tags：</th>
            <td><?=element::tag('tags', $tags)?></td>
          </tr>
          <tr>
            <th width="60">来源：</th>
            <td class="c_077ac7">
              <input type="text" name="source" autocomplete="1" value="<?=$source?>" url="?app=system&controller=source&action=suggest&q=%s" size="15"/>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label for="editor">编辑： </label>
              <input type="text" name="editor" value="<?=$editor?>" size="15"/>
            </td>
          </tr>
          <tr>
            <th>摘要：</th>
            <td><textarea name="description" id="description" maxLength="255" style="width:710px;height:40px" class="bdr"><?=$description?></textarea> </td>
          </tr>
		  <tr>
            <th>缩略图：</th>
            <td><?php echo element::thumb('thumb', '', 45);?></td>
          </tr>
          <tr>
            <th><span class="c_red">*</span> 组图： </th>
            <td>
            <div id="pictures"></div>
            <table cellspacing="0" cellpadding="0">
                <tr>
                  <td width="85" height="25"><div id="uploadify"></div></td>
                  <td width="85"><div id="uploadzip"></div></td>
                  <td><input type="button" name="remote" id="remote" value="远程采集" onclick="picture.remote();" class="button_style_1"/></td>
                  <td><input type="button" name="select" id="select" value="图片库"  onclick="picture.select(); return false;"  class="button_style_1"/></td>
                </tr>
              </table>
              <div id="fileQueue"></div></td>
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

<link href="<?=IMG_URL?>js/lib/autocomplete/style.css" rel="stylesheet" type="text/css" />
<link href="<?=IMG_URL?>js/lib/colorInput/style.css" rel="stylesheet" type="text/css" />
<script src="<?=IMG_URL?>js/lib/cmstop.autocomplete.js" type="text/javascript"></script>
<script src="<?=IMG_URL?>js/lib/cmstop.colorInput.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.uploadify.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.filemanager.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.lightbox.js"></script>
<script type="text/javascript" src="js/related.js"></script>
<script type="text/javascript" src="apps/page/js/section.js"></script>
<script type="text/javascript" src="apps/picture/js/group.js"></script>
<link rel="stylesheet" type="text/css" href="css/imagesbox.css" media="screen" />
<script type="text/javascript">
picture.upload();
picture.zip();
</script>
<?php $this->display('footer');