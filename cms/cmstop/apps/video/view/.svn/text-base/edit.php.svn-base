<?php $this->display('header');?>
<script type="text/javascript">
$(function(){
	$("#videoInput").uploadify({
			'uploader'       : 'uploadify/uploadify.swf',
			'script'         : escape('?app=video&controller=video&action=upload&auth='+ct.getCookie(COOKIE_PRE+'auth')),
			'method'		 : 'POST',
			'fileDataName'   : 'ctvideo',
			'fileDesc'		 : '注意:您只能上传flv,swf,avi,wmv,rm,rmvb格式的文件!',
			'fileExt'		 : '*.swf;*.flv;*.avi;*.wmv;*.rm;*.rmvb;',
			'cancelImg'      : 'images/cancel.png',
			'queueID'        : 'myvideo',
			'buttonImg'	 	 :'images/videoupload.gif',	
			'width'			 :'80',
			'height'		 :'22',	
			'auto'           : true,
			'multi'          : false,
			'sizeLimit'      : <?=$upload_max_filesize?>,
			onOpen:function(event,queueID,fileobj){
				$("#progress").show();
				$("#cancleupload").attr('href','javascript:$("#videoInput").uploadifyCancel("'+queueID+'")');
			},
			onProgress:function(event,queeuID,fileObj,data){
				$("#nowprogress").width(data.percentage+'%');
				$("#progpercent").html(data.percentage+'%');
			},
			onComplete:function(event,queueID,fileObj,response,data){
				$("#progress").fadeOut();
				var aidaddr=response.split('|');
				$("#aid").val(aidaddr[0]);
				aidaddr[1]=UPLOAD_URL+aidaddr[1];
				$("#video").val(aidaddr[1]);
				$("#ptline").show();
			},
			onCancel:function(){
				$("#progress").fadeOut();
			},
			onError:function(event,queueID,fileObj){
				var maxsize = <?=$upload_max_filesize?>;
				var m = maxsize/(1024*1024);
				if(fileObj.size>maxsize)
				ct.warn('文件大小不得超过'+m+'M');
			}
	})
})

</script>
<form name="video_edit" id="video_edit" method="POST" class="validator" action="?app=video&controller=video&action=edit" enctype="multipart/form-data">
<input type="hidden" name="contentid" id="contentid" value="<?=$contentid?>" />
<input type="hidden" name="modelid" id="modelid" value="<?=$modelid?>">
<input type="hidden" name="aid" id="aid"  value="<?=$aid?>"/>
	<? if($status == 6): ?>
	<input type="hidden" name="url" id="url" value="<?=$url?>" />
	<? endif; ?>
<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form mar_l_8">
	<tr>
		<th width="80"><span class="c_red">*</span> 栏目：</th>
		<td><?=element::category('catid', 'catid', $catid)?></td>
	</tr>
	<tr>
		<th><span class="c_red">*</span>标题：</th>
		<td><?=element::title('title', $title, $color)?></td>
	</tr>
	<tr>
		<th>Tags：</th>
		<td><?=element::tag('tags', $tags)?></td>
	</tr>
	<tr>
		<th valign="top" ><div style="height:10px;width:100%"> </div><span class="c_red">*</span>视频：</th>
		<td>
		
<table border="0" width="70%" >
  <tr>
    <td colspan="3"><input type="text" name="video" id="video" value="<?=$video?>" size="60" style="margin-right:30px;"/></td>
  </tr>
   <tr>
  <td>
  <table><tr>
    <td width="10%" valign="bottom" height="30"> <div id="videoInput"  name='videoInput' style="display:none"/></div></td><?php if($ccid):?>
    <td width="9%" valign="bottom" align="left"><div style="margin-top:2px;width:74px;height:22px;float:left">
   
  <object width='72' height='22'> 
    <param name='wmode' value='transparent' />  
    <param name='allowScriptAccess' value='always' /> 
    <param name='movie' value='http://union.bokecc.com/flash/plugin/plugin_12.swf?userID=<?=$ccid?>&type=normal' /> 
    <embed src='http://union.bokecc.com/flash/plugin/plugin_12.swf?userID=<?=$ccid?>&type=normal' type='application/x-shockwave-flash' width='72' height='22' allowScriptAccess='always' wmode='transparent'></embed> 
  </object> 
  <script language="javascript">   
    function InsertCC(html){
	    	$("#video").val(html);
    }   
  </script> 
  </div>
  </td>
  <td valign="bottom"><a href="javascript:video.setting()">设置CC</a></td>
  <?php endif; ?>
  </tr></table>
  </td>
  </tr> 
</table>
		</td>
		
	
	</tr>
<tr>
	<tr id="ptline"><th>时长：</th><td>  <input type="text" name="playtime" id="playtime" value="<?=$playtime?>" size="10"/>分钟</td></tr>
		<th></th>
		<td>

		<div id="progress" style="display:none">
		<table>
		<tr><td width="340"><div id="progressbar" style="border:#fff000 1px solid;width:340px;height:15px; position:relative;">
		<div id="nowprogress" style="border:0px;position:absolute;left:0px;top:0px;width:1px;height:15px;background-color:#077AC7"></div></div></td>
		<td><span id="progpercent"></span></td>
		<td style="padding:0px 5px;"><a href="#" id="cancleupload" ><img  src="images/cancel.png" /></a></td>
		</tr>
        </table>

		</td>
</tr>
	        <tr>
            <th width="80">来源：</th>
            <td class="c_077ac7">
              <input type="text" name="source" autocomplete="1" value="<?=$source?>" url="?app=system&controller=source&action=suggest&q=%s" size="15"/>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label for="editor">编辑： </label>
              <input type="text" name="editor" value="<?=$editor?>" size="15"/>
   
            </td>
          </tr>
	<tr>
		<th>简介：</th>
		<td><textarea name="description" id="description" style="width:480px" rows="20"><?=$description?></textarea></td>
	</tr>
	<tr>
		<th>缩略图：</th>
		<td><?php echo element::thumb('thumb',$thumb,45);?></td>
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
                  <th width="80">评论：</th>
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
         <tr>
			<th width="80"></th>
			<td width="60">
				<input type="submit" value="保存" class="button_style_2" style="float:left"/>
			</td><td style="color:#444;text-align:left">按Ctrl+S键保存</td>
		</tr>
         </table>
		</div>
</form>
<link href="<?=IMG_URL?>js/lib/autocomplete/style.css" rel="stylesheet" type="text/css" />
<link href="<?=IMG_URL?>js/lib/colorInput/style.css" rel="stylesheet" type="text/css" />
<script src="<?=IMG_URL?>js/lib/cmstop.autocomplete.js" type="text/javascript"></script>
<script src="<?=IMG_URL?>js/lib/cmstop.colorInput.js" type="text/javascript"></script>
<script type="text/javascript" src="apps/system/js/psn.js"></script>
<script type="text/javascript" src="js/related.js"></script>
<script type="text/javascript" src="apps/page/js/section.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="tiny_mce/editor.js"></script>
<script type="text/javascript">

function selectForm(obj)
{
	if($(obj).children('span').hasClass("span_open")){
		$(obj).children('span').removeClass("span_open");
		$(obj).children('span').addClass("span_close");
		$('#inputs').slideUp();
	}
	else{
		$(obj).children('span').removeClass("span_close");
		$(obj).children('span').addClass("span_open");
		$('#inputs').slideDown();
	}
	return false;
}

$('#description').editor('mini');
</script>
<?php $this->display('footer');