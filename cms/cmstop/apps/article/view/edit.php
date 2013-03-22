<?php $this->display('header');?>

<style type="text/css">
#multiUpQueue{position:absolute;left:300px;top:200px;background:#fffddd;opacity:60%;}
.uploadifyQueueItem{clear:both;margin-top:5px;}
.fileName,.percentage{float:left}
.cancel{ float:right}
</style>

<form name="article_edit" id="article_edit" method="POST" action="?app=<?=$app?>&controller=<?=$app?>&action=edit">
<input type="hidden" name="contentid" id="contentid" value="<?=$contentid?>" />
	<? if($status == 6): ?>
	<input type="hidden" name="url" id="url" value="<?=$url?>" />
	<? endif; ?>
<input type="hidden" name="modelid" id="modelid" value="<?=$modelid?>">
<input type="hidden" name="old_pagecount" id="old_pagecount" value="<?=$pagecount?>">
        <table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
          <tr>
            <th width="80"><span class="c_red">*</span> 栏目：</th>
            <td><?=element::category('catid', 'catid', $catid)?></td>
          </tr>
          <tr>
            <th width="80"><span class="c_red">*</span> 标题：</th>
            <td><?=element::title('title', $title, $color)?>
              <label><input type="checkbox" name="has_subtitle" id="has_subtitle" value="1" <?=($subtitle ? 'checked' : '')?> class="checkbox_style" onclick="show_subtitle()" /> 副题</label>
            </td>
          </tr>
          <tr id="tr_subtitle" style="display:<?=($subtitle ? 'table-row' : 'none')?>">
            <th width="80">副题：</th>
            <td><input type="text" name="subtitle" id="subtitle" value="<?=$subtitle?>" size="100" maxlength="120" /></td>
          </tr>
          <tr>
            <th>Tags：</th>
            <td><?=element::tag('tags', $tags)?></td>
          </tr>
          <tr>
            <th width="80">来源：</th>
            <td class="c_077ac7">
              <input type="text" name="source" autocomplete="1" value="<?=$source?>" url="?app=system&controller=source&action=suggest&q=%s" size="15"/>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label for="author">作者： </label>
              <input type="text" name="author" autocomplete="1" value="<?=$author?>" url="?app=space&controller=index&action=suggest&q=%s" size="15"/>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label for="editor">编辑： </label>
              <input type="text" name="editor" value="<?=$editor?>" size="15"/>
            </td>
          </tr>
        </table>
        
        <table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form">
          <tr>
            <th width="80">&nbsp;&nbsp;</th>
             <td width="540" style="padding-left:9px;position:relative"><textarea name="content" id="content" style="visibility:hidden;height:450px;width:630px;"><?=$content?></textarea></td>
            <td class="vtop"></td>
          </tr>
        </table>
        
        <table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form">
          <tr>
            <th width="80"></th>
            <td>
            <table>
             <tr>
             <td width="483">
              <label>
              <input type="checkbox" name="saveremoteimage" id="saveremoteimage" value="1" <?php if ($saveremoteimage) echo 'checked';?> class="checkbox_style"/>
              远程图片本地化</label>
              </td>
              <td width="70"><a href="javascript:;" onclick="get_thumb();">提取缩略图</a></td>
              <td><div id="multiUp" name="multiUp"></div></td>
              </tr>
             </table>  
             </td>
          </tr>
          <tr>
            <th>摘要：</th>
            <td><textarea name="description" id="description" maxLength="255" style="width:627px;height:40px" class="bdr"><?=$description?></textarea></td>
          </tr>
          <tr>
            <th>缩略图：</th>
            <td><?=element::thumb('thumb', $thumb, 60)?></td>
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
             <table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form">
                <tr>
                  <th class="vtop">相关：</th>
                  <td colspan="3"><?=element::related($contentid)?></td>
                </tr>
                <tr>
				<th class="vtop">发布时间：</th>
				<td colspan="3"><input id="published" name="published" type="text" class="input_calendar" value="<?=$published?>" size="20"/></td>
			</tr>
               <tr>
                  <th width="80">评论：</th>
                  <td width="170"><label><input type="checkbox" name="allowcomment" id="allowcomment" value="1" <?php if ($allowcomment) echo 'checked';?> class="checkbox_style"/> 允许</label></td>
                  <th width="80"></th>
                  <td></td>
                </tr>
              
                 <tr>
          		  <th>状态：</th>
          		  <td><?=table('status', $status, 'name')?></td>
      		    </tr>
           </table>
        </div>
        <table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
         <tr>
			<th width="80"></th>
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
<script src="<?php echo IMG_URL?>js/lib/jquery.uploadify.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.filemanager.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="tiny_mce/editor.js"></script>
<script type="text/javascript" src="js/related.js"></script>
<script type="text/javascript" src="apps/page/js/section.js"></script>

<script type="text/javascript">
$(function(){
	var ed = null,code,isfixed=false;
	$("#multiUp").uploadify({
			'uploader'       : 'uploadify/uploadify.swf',
			'script'         : escape('?app=editor&controller=filesup&action=upload&auth='+ct.getCookie(COOKIE_PRE+'auth')),
			'method'		 : 'POST',
			'fileDataName'   : 'multiUp',
			'buttonImg'	 	 :'images/multiup.gif',
			'width'			 :'80',
			'height'		 :'22',	
			'auto'           : true,
			'multi'          : true,
			onOpen           : function(event,queueID,fileObj,data){
				 if(!isfixed)
				 {
				 	var width = $('.uploadifyQueueItem').width();
				 	var height = $('#multiUpQueue').height();
				  	$('#multiUpQueue').css({left:(630-width)/2,top:(630-height)/2,height:height});
				  	isfixed = true;
				 }
			},
			onComplete:function(event,queueID,fileObj,response,data)
			{	 
				ed = ed?ed:tinyMCE.get('content');
				ed.execCommand('mceInsertContent',false,response);
			}
	});
});

function get_thumb(){
	var content = tinyMCE.activeEditor.getContent();
	var imgs = content.match(/<img\s+[^>]*src\s*=\s*(["\']?)([^>"\']+)\1[^>]*[\/]?>/im);
	if(imgs) $.post('?app=article&controller=article&action=thumb',{url:imgs[2]},function(url){
		$('.thumb_cell input:text').val(url);
		$('.thumb_cell input:last').show();
	});
}
$('#content').editor();
$('input[name*=related_keywords]').val($('#tags').val());
</script>
<?php $this->display('footer');