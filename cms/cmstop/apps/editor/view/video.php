<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{#media_dlg.title}</title>
	
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?=IMG_URL?>js/lib/jquery-ui/dialog.css" />
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.ui.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/config.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/cmstop.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.dialog.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.cookie.js"></script>

<!--tinymce-->
<script type="text/javascript" src="<?=ADMIN_URL?>tiny_mce/tiny_mce_popupfx.js"></script>
<script type="text/javascript" src="<?=ADMIN_URL?>tiny_mce/plugins/media/js/media.js"></script>
<script type="text/javascript" src="<?=ADMIN_URL?>tiny_mce/utils/mctabs.js"></script>
<script type="text/javascript" src="<?=ADMIN_URL?>tiny_mce/utils/validate.js"></script>
<script type="text/javascript" src="<?=ADMIN_URL?>tiny_mce/utils/form_utils.js"></script>
<script type="text/javascript" src="<?=ADMIN_URL?>tiny_mce/utils/editable_selects.js"></script>
<!--tinymce-->
<!--upload-->
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.uploadify.js"></script>
<script type="text/javascript">
$(function(){
	$("#uploadvideo").uploadify({
			'uploader'       : 'uploadify/uploadify.swf',
			'script'         : escape('?app=editor&controller=video&action=upload&auth='+ct.getCookie(COOKIE_PRE+'auth')),
			'method'		 : 'POST',
			'fileDataName'   : 'ctvideo',
			'fileDesc'		 : '注意:您只能上传flv,rm,rmvb,wmv,swf格式的文件!',
			'fileExt'		 : '*.swf;*.rm;*.rmvb;*.flv;*.wmv;',
			'buttonImg'	 	 : 'images/videoupload.gif',
			'queueID'		 : 'myvideo',
			'width'			 : '80',
			'height'		 : '22',	
			'auto'           :  true,
			'multi'          :  false,
			onOpen:function(event,queueID,fileobj)
			{
			},
			onProgress:function(event,queeuID,fileObj,data)
			{
				$('#src').val(data.percentage+'%');
			},
			onComplete:function(event,queueID,fileObj,response,data)
			{
				$('#src').val(response);
				switchType(response);
				generatePreview();
			}
	});
})
</script>

<!--upload-->


<link rel="stylesheet" type="text/css" href="<?=ADMIN_URL?>css/admin.css"/>
<link rel="stylesheet" type="text/css" href="<?=ADMIN_URL?>tiny_mce/plugins/media/css/media.css"/>
<style  type="text/css">
body{background-color:#FFFFFF}
fieldset{ margin:0px; padding:2px;width:98%}
select{ font-size:12px; border:}
.button_style_1{width:94px;}
.btn_float{float:right; margin-right:0;}
div.current{height:365px}
#vsearch{ float:right;}
.operation_area{background:none}
.mceActionPanel{ margin: 0 8px;}
</style>
<script type="text/javascript">
    mcTabs.init({
    	selection_class:'s_3'
    });
</script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body style="display:none">
    <form onSubmit="insertMedia();return false;" action="#">
		<div class="tag_1" style="margin-top:5px;margin-bottom:10px;">
			<ul class="tag_list">
				<li id="general_tab" class="s_3"><span><a href="javascript:mcTabs.displayTab('general_tab','general_panel');generatePreview();" onMouseDown="return false;">常规</a></span></li>
				<li id="advanced_tab"><span><a href="javascript:mcTabs.displayTab('advanced_tab','advanced_panel');" onMouseDown="return false;">高级</a></span></li>
				<li id="insertcode_tab"><span><a href="javascript:mcTabs.displayTab('insertcode_tab','insertcode_panel');" onMouseDown="return false;">插入代码</a></span></li>
				<li id="mediadepot_tab"><span><a href="javascript:mcTabs.displayTab('mediadepot_tab','mediadepot_panel');" onMouseDown="return false;">媒体库</a></span></li>
			</ul>
		</div>

		<div class="panel_wrapper" style="padding:0px">
			<div id="general_panel" class="panel current">
				<fieldset>
					<legend>常规</legend>

					<table border="0" cellpadding="4" cellspacing="0">
							<tr>
								<td width="20%" align="center"><label for="media_type">类型</label></td>
								<td width="80%">
									<select id="media_type" name="media_type" onChange="changedType(this.value);generatePreview();">
										<option value="flash">Flash</option>
										<!-- <option value="flv">Flash video (FLV)</option> -->
										<option value="qt">Quicktime</option>
										<option value="shockwave">Shockwave</option>
										<option value="wmp">Windows Media</option>
										<option value="rmp">Real Media</option>
									</select>
								</td>
							</tr>
							<tr>
							<td align="center"><label for="src">文件/网址</label></td>
							  <td>
									<table border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<td><input id="src" name="src" type="text" value="" onChange="switchType(this.value);generatePreview();" /></td>
										<td id="filebrowsercontainer">&nbsp;</td>
										<td><div id="uploadvideo"></div></td>
									  </tr>
									</table>
								</td>
							</tr>
							<tr id="linklistrow">
								<td align="center"><label for="linklist">{#media_dlg.list}</label></td>
								<td id="linklistcontainer"><select id="linklist"><option value=""></option></select></td>
							</tr>
							<tr>
								<td align="center"><label for="width">尺寸</label></td>
								<td>
									<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td><input type="text" id="width" name="width" value="" onChange="generatePreview('width');" /> x <input type="text" id="height" name="height" value="" class="size"  onchange="generatePreview('height');" /></td>
											<td>&nbsp;&nbsp;<input id="constrain" type="checkbox" name="constrain" class="checkbox" /></td>
											<td><label id="constrainlabel" for="constrain">锁定比例</label></td>
										</tr>
									</table>
								</td>
							</tr>
					</table>
				</fieldset>

				<fieldset>
					<legend>预览</legend>
					<div id="prev"></div>
				</fieldset>
			</div>

			<div id="advanced_panel" class="panel">
				<fieldset>
					<legend>高级</legend>

					<table border="0" cellpadding="4" cellspacing="0" width="100%">
						<tr>
							<td><label for="id">ID</label></td>
							<td><input type="text" id="id" name="id" onChange="generatePreview();" /></td>
							<td><label for="name">名称</label></td>
							<td><input type="text" id="name" name="name" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="align">对齐</label></td>
							<td>
								<select id="align" name="align" onChange="generatePreview();">
									<option value="">--未设置--</option> 
									<option value="top">上方</option>
									<option value="right">居右</option>
									<option value="bottom">下方</option>
									<option value="left">居左</option>
								</select>
							</td>

							<td><label for="bgcolor">背景色</label></td>
							<td>
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input id="bgcolor" name="bgcolor" type="text" value="" size="9" onChange="updateColor('bgcolor_pick','bgcolor');generatePreview();" /></td>
										<td id="bgcolor_pickcontainer">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td><label for="vspace">水平间距</label></td>
							<td><input type="text" id="vspace" name="vspace" class="number" onChange="generatePreview();" /></td>
							<td><label for="hspace">垂直间距</label></td>
							<td><input type="text" id="hspace" name="hspace" class="number" onChange="generatePreview();" /></td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="flash_options">
					<legend>FLASH选项</legend>

					<table border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td><label for="flash_quality">品质</label></td>
							<td>
								<select id="flash_quality" name="flash_quality" onChange="generatePreview();">
									<option value="">--未设置--</option> 
									<option value="high">high</option>
									<option value="low">low</option>
									<option value="autolow">autolow</option>
									<option value="autohigh">autohigh</option>
									<option value="best">best</option>
								</select>
							</td>

							<td><label for="flash_scale">比例</label></td>
							<td>
								<select id="flash_scale" name="flash_scale" onChange="generatePreview();">
									<option value="">--未设置--</option> 
									<option value="showall">showall</option>
									<option value="noborder">noborder</option>
									<option value="exactfit">exactfit</option>
									<option value="noscale">noscale</option>
								</select>
							</td>
						</tr>

						<tr>
							<td><label for="flash_wmode">窗口模式</label></td>
							<td>
								<select id="flash_wmode" name="flash_wmode" onChange="generatePreview();">
									<option value="">--未设置--</option> 
									<option value="window">window</option>
									<option value="opaque">opaque</option>
									<option value="transparent">transparent</option>
								</select>
							</td>

							<td><label for="flash_salign">SAlign</label></td>
							<td>
								<select id="flash_salign" name="flash_salign" onChange="generatePreview();">
									<option value="">--未设置--</option> 
									<option value="l">居左</option>
									<option value="t">上方</option>
									<option value="r">居右</option>
									<option value="b">下方</option>
									<option value="tl">左上</option>
									<option value="tr">右上</option>
									<option value="bl">左下</option>
									<option value="br">右下</option>
								</select>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flash_play" name="flash_play" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="flash_play">自动播放</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flash_loop" name="flash_loop" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="flash_loop">循环播放</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flash_menu" name="flash_menu" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="flash_menu">显示菜单</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flash_swliveconnect" name="flash_swliveconnect" onChange="generatePreview();" /></td>
										<td><label for="flash_swliveconnect">SWLiveConnect</label></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<table>
						<tr>
							<td><label for="flash_base">基地</label></td>
							<td><input type="text" id="flash_base" name="flash_base" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="flash_flashvars">参数</label></td>
							<td><input type="text" id="flash_flashvars" name="flash_flashvars" onChange="generatePreview();" /></td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="flv_options">
					<legend>{#media_dlg.flv_options}</legend>

					<table border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td><label for="flv_scalemode">{#media_dlg.flv_scalemode}</label></td>
							<td>
								<select id="flv_scalemode" name="flv_scalemode" onChange="generatePreview();">
									<option value="">{#not_set}</option> 
									<option value="none">none</option>
									<option value="double">double</option>
									<option value="full">full</option>
								</select>
							</td>

							<td><label for="flv_buffer">{#media_dlg.flv_buffer}</label></td>
							<td><input type="text" id="flv_buffer" name="flv_buffer" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="flv_startimage">{#media_dlg.flv_startimage}</label></td>
							<td><input type="text" id="flv_startimage" name="flv_startimage" onChange="generatePreview();" /></td>

							<td><label for="flv_starttime">{#media_dlg.flv_starttime}</label></td>
							<td><input type="text" id="flv_starttime" name="flv_starttime" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="flv_defaultvolume">{#media_dlg.flv_defaultvolume}</label></td>
							<td><input type="text" id="flv_defaultvolume" name="flv_defaultvolume" onChange="generatePreview();" /></td>


						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flv_hiddengui" name="flv_hiddengui" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="flv_hiddengui">{#media_dlg.flv_hiddengui}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flv_autostart" name="flv_autostart" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="flv_autostart">{#media_dlg.flv_autostart}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flv_loop" name="flv_loop" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="flv_loop">{#media_dlg.flv_loop}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flv_showscalemodes" name="flv_showscalemodes" onChange="generatePreview();" /></td>
										<td><label for="flv_showscalemodes">{#media_dlg.flv_showscalemodes}</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flv_smoothvideo" name="flash_flv_flv_smoothvideosmoothvideo" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="flv_smoothvideo">{#media_dlg.flv_smoothvideo}</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="flv_jscallback" name="flv_jscallback" onChange="generatePreview();" /></td>
										<td><label for="flv_jscallback">{#media_dlg.flv_jscallback}</label></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="qt_options">
					<legend>Quicktime选项</legend>

					<table border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="qt_loop" name="qt_loop" onChange="generatePreview();" /></td>
										<td><label for="qt_loop">循环播放</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="qt_autoplay" name="qt_autoplay" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="qt_autoplay">自动播放</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="qt_cache" name="qt_cache" onChange="generatePreview();" /></td>
										<td><label for="qt_cache">缓存</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="qt_controller" name="qt_controller" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="qt_controller">控制台</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="qt_correction" name="qt_correction" onChange="generatePreview();" /></td>
										<td><label for="qt_correction">没有修正</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="qt_enablejavascript" name="qt_enablejavascript" onChange="generatePreview();" /></td>
										<td><label for="qt_enablejavascript">启用JavaScript</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="qt_kioskmode" name="qt_kioskmode" onChange="generatePreview();" /></td>
										<td><label for="qt_kioskmode">Kiosk模式</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="qt_autohref" name="qt_autohref" onChange="generatePreview();" /></td>
										<td><label for="qt_autohref">自动HREF</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="qt_playeveryframe" name="qt_playeveryframe" onChange="generatePreview();" /></td>
										<td><label for="qt_playeveryframe">逐帧播放</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="qt_targetcache" name="qt_targetcache" onChange="generatePreview();" /></td>
										<td><label for="qt_targetcache">目标缓冲</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td><label for="qt_scale">比例</label></td>
							<td><select id="qt_scale" name="qt_scale" class="mceEditableSelect" onChange="generatePreview();">
									<option value="">--未设置--</option> 
									<option value="tofit">tofit</option>
									<option value="aspect">aspect</option>
								</select>
							</td>

							<td colspan="2">&nbsp;</td>
						</tr>

						<tr>
							<td><label for="qt_starttime">开始时间</label></td>
							<td><input type="text" id="qt_starttime" name="qt_starttime" onChange="generatePreview();" /></td>

							<td><label for="qt_endtime">结束时间</label></td>
							<td><input type="text" id="qt_endtime" name="qt_endtime" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="qt_target">目标</label></td>
							<td><input type="text" id="qt_target" name="qt_target" onChange="generatePreview();" /></td>

							<td><label for="qt_href">链接</label></td>
							<td><input type="text" id="qt_href" name="qt_href" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="qt_qtsrcchokespeed">Choke speed</label></td>
							<td><input type="text" id="qt_qtsrcchokespeed" name="qt_qtsrcchokespeed" onChange="generatePreview();" /></td>

							<td><label for="qt_volume">音量</label></td>
							<td><input type="text" id="qt_volume" name="qt_volume" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="qt_qtsrc">QT Src</label></td>
							<td colspan="4">
							<table border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td><input type="text" id="qt_qtsrc" name="qt_qtsrc" onChange="generatePreview();" /></td>
									<td id="qtsrcfilebrowsercontainer">&nbsp;</td>
								  </tr>
							</table>
							</td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="wmp_options">
					<legend>Windows media player选项</legend>

					<table border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="wmp_autostart" name="wmp_autostart" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="wmp_autostart">自动开始</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="wmp_enabled" name="wmp_enabled" onChange="generatePreview();" /></td>
										<td><label for="wmp_enabled">启用</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="wmp_enablecontextmenu" name="wmp_enablecontextmenu" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="wmp_enablecontextmenu">显示菜单</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="wmp_fullscreen" name="wmp_fullscreen" onChange="generatePreview();" /></td>
										<td><label for="wmp_fullscreen">全窗口</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="wmp_invokeurls" name="wmp_invokeurls" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="wmp_invokeurls">相关URLs</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="wmp_mute" name="wmp_mute" onChange="generatePreview();" /></td>
										<td><label for="wmp_mute">静音</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="wmp_stretchtofit" name="wmp_stretchtofit" onChange="generatePreview();" /></td>
										<td><label for="wmp_stretchtofit">拉伸</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="wmp_windowlessvideo" name="wmp_windowlessvideo" onChange="generatePreview();" /></td>
										<td><label for="wmp_windowlessvideo">无边框</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td><label for="wmp_balance">平衡</label></td>
							<td><input type="text" id="wmp_balance" name="wmp_balance" onChange="generatePreview();" /></td>

							<td><label for="wmp_baseurl">基准URL</label></td>
							<td><input type="text" id="wmp_baseurl" name="wmp_baseurl" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="wmp_captioningid">Captioning id</label></td>
							<td><input type="text" id="wmp_captioningid" name="wmp_captioningid" onChange="generatePreview();" /></td>

							<td><label for="wmp_currentmarker">当前标记</label></td>
							<td><input type="text" id="wmp_currentmarker" name="wmp_currentmarker" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="wmp_currentposition">当前位置</label></td>
							<td><input type="text" id="wmp_currentposition" name="wmp_currentposition" onChange="generatePreview();" /></td>

							<td><label for="wmp_defaultframe">默认影格</label></td>
							<td><input type="text" id="wmp_defaultframe" name="wmp_defaultframe" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="wmp_playcount">播放次数</label></td>
							<td><input type="text" id="wmp_playcount" name="wmp_playcount" onChange="generatePreview();" /></td>

							<td><label for="wmp_rate">影格率</label></td>
							<td><input type="text" id="wmp_rate" name="wmp_rate" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="wmp_uimode">面板模式</label></td>
							<td><input type="text" id="wmp_uimode" name="wmp_uimode" onChange="generatePreview();" /></td>

							<td><label for="wmp_volume">音量</label></td>
							<td><input type="text" id="wmp_volume" name="wmp_volume" onChange="generatePreview();" /></td>
						</tr>

					</table>
				</fieldset>

				<fieldset id="rmp_options">
					<legend>Real media player选项</legend>

					<table border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="rmp_autostart" name="rmp_autostart" onChange="generatePreview();" /></td>
										<td><label for="rmp_autostart">自动开始</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="rmp_loop" name="rmp_loop" onChange="generatePreview();" /></td>
										<td><label for="rmp_loop">循环播放</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="rmp_autogotourl" name="rmp_autogotourl" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="rmp_autogotourl">自动转到URL</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="rmp_center" name="rmp_center" onChange="generatePreview();" /></td>
										<td><label for="rmp_center">中心</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="rmp_imagestatus" name="rmp_imagestatus" checked="checked" onChange="generatePreview();" /></td>
										<td><label for="rmp_imagestatus">图像状态</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="rmp_maintainaspect" name="rmp_maintainaspect" onChange="generatePreview();" /></td>
										<td><label for="rmp_maintainaspect">Maintain aspect</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="rmp_nojava" name="rmp_nojava" onChange="generatePreview();" /></td>
										<td><label for="rmp_nojava">No java</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="rmp_prefetch" name="rmp_prefetch" onChange="generatePreview();" /></td>
										<td><label for="rmp_prefetch">预读取</label></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="rmp_shuffle" name="rmp_shuffle" onChange="generatePreview();" /></td>
										<td><label for="rmp_shuffle">Shuffle</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">&nbsp;
								
							</td>
						</tr>

						<tr>
							<td><label for="rmp_console">控制台</label></td>
							<td><input type="text" id="rmp_console" name="rmp_console" onChange="generatePreview();" /></td>

							<td><label for="rmp_controls">控制器</label></td>
							<td><input type="text" id="rmp_controls" name="rmp_controls" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="rmp_numloop">循环次数</label></td>
							<td><input type="text" id="rmp_numloop" name="rmp_numloop" onChange="generatePreview();" /></td>

							<td><label for="rmp_scriptcallbacks">脚本回档</label></td>
							<td><input type="text" id="rmp_scriptcallbacks" name="rmp_scriptcallbacks" onChange="generatePreview();" /></td>
						</tr>
					</table>
				</fieldset>

				<fieldset id="shockwave_options">
					<legend>Shockwave选项</legend>

					<table border="0" cellpadding="4" cellspacing="0">
						<tr>
							<td><label for="shockwave_swstretchstyle">拉升模式</label></td>
							<td>
								<select id="shockwave_swstretchstyle" name="shockwave_swstretchstyle" onChange="generatePreview();">
									<option value="none">--未设置--</option>
									<option value="meet">Meet</option>
									<option value="fill">Fill</option>
									<option value="stage">Stage</option>
								</select>
							</td>

							<td><label for="shockwave_swvolume">音量</label></td>
							<td><input type="text" id="shockwave_swvolume" name="shockwave_swvolume" onChange="generatePreview();" /></td>
						</tr>

						<tr>
							<td><label for="shockwave_swstretchhalign">水平拉升</label></td>
							<td>
								<select id="shockwave_swstretchhalign" name="shockwave_swstretchhalign" onChange="generatePreview();">
									<option value="none">--未设置--</option>
									<option value="left">居左</option>
									<option value="center">中间</option>
									<option value="right">居右</option>
								</select>
							</td>

							<td><label for="shockwave_swstretchvalign">垂直拉升</label></td>
							<td>
								<select id="shockwave_swstretchvalign" name="shockwave_swstretchvalign" onChange="generatePreview();">
									<option value="none">--未设置--</option>
									<option value="meet">Meet</option>
									<option value="fill">Fill</option>
									<option value="stage">Stage</option>
								</select>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="shockwave_autostart" name="shockwave_autostart" onChange="generatePreview();" checked="checked" /></td>
										<td><label for="shockwave_autostart">自动开始</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="shockwave_sound" name="shockwave_sound" onChange="generatePreview();" checked="checked" /></td>
										<td><label for="shockwave_sound">声音</label></td>
									</tr>
								</table>
							</td>
						</tr>


						<tr>
							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="shockwave_swliveconnect" name="shockwave_swliveconnect" onChange="generatePreview();" /></td>
										<td><label for="shockwave_swliveconnect">SWLiveConnect</label></td>
									</tr>
								</table>
							</td>

							<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td><input type="checkbox" class="checkbox" id="shockwave_progress" name="shockwave_progress" onChange="generatePreview();" checked="checked" /></td>
										<td><label for="shockwave_progress">进度</label></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</fieldset>
			</div>
			
			<div id="insertcode_panel" class="panel">
				<fieldset>
					<legend>html代码</legend>
                    <table>
						<tr>
							<td><textarea style="border:none;width:380px;height:300px;" id="videocode" name="videocode" /></textarea></td>
						</tr>
					</table>
					
				</fieldset>

			

		</div>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.dropdown.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.table.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.tablesorter.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.contextMenu.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.pagination.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/tablesorter/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/pagination/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/contextMenu/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/dropdown/style.css"/>
<div id="mediadepot_panel" style="height:375px;" class="panel"></div>
	 </div>

		<div class="mceActionPanel" align="center">
			<input type="submit"  name="insert" class="button_style_1" value="插入" />
			<input type="button"  name="cancel" class="button_style_1 btn_float" value="取消" onClick="tinyMCEPopup.close();" />
		</div>
</form>
</body>
</html>