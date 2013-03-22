<?php $this->display('header');?>
<style type="text/css">
.over th{background-color:#fffddd;}
</style>
<form name="activity_edit" id="activity_edit" method="POST" action="?app=activity&controller=activity&action=edit">
<input type="hidden" name="modelid" id="modelid" value="<?=$modelid?>" />
<input type="hidden" name="contentid" id="contentid" value="<?=$contentid?>" />
<? if($status == 6): ?>
<input type="hidden" name="url" id="url" value="<?=$url?>" />
<? endif; ?>
<table width="98%" border="0" cellspacing="0" cellpediting="0" class="table_form mar_l_8">
	<tr>
		<th width="80"><span class="c_red">*</span> 栏目：</th>
		<td><?=element::category('catid', 'catid', $catid)?></td>
	</tr>
	<tr>
		<th><span class="c_red">*</span> 标题：</th>
		<td><?=element::title('title', $title, $color)?></td>
	</tr>
	<tr>
		<th>Tags：</th>
		<td><?=element::tag('tags', $tags)?></td>
	</tr>
	<tr>
		<th>活动时间：</th>
		<td> <input type="text" name="starttime" id="srarttime" size="20" class="input_calendar" value="<?=$starttime?>">&nbsp;~&nbsp;<input type="text" name="endtime" id="endtime" class="input_calendar" size="20" value="<?=$endtime?>"></td>
	</tr>
	<tr>
		<th>报名时间：</th>
		<td><input type="text" name="signstart" id="signstart" class="input_calendar" size="20" value="<?=$signstart?>">&nbsp;~&nbsp;<input type="text" name="signend" id="signend" class="input_calendar" size="20" value="<?=$signend?>"></td>
	</tr>
	<tr>
		<th>人数限制：</th>
		<td> <input type="text" name="maxpersons" id="maxpersons" size="10" value="<?=$maxpersons?>">		
		<label><input type="radio" class="radio_style" name="gender" id="gender" value="1" />男</label>
		<label><input type="radio" class="radio_style" name="gender" id="gender" value="2" />女</label>
		<label><input type="radio" class="radio_style" name="gender" id="gender" value="0"  checked="checked">不限</label>
		</td>	
	</tr>
	<tr>
	    <th>活动类型：</th>
	    <td><input type="text" name="type" id="type"  value="<?=$type?>" size="10"/></td>
    </tr>
	
	<tr>
	    <th>活动地址：</th>
	    <td><input id="point" name="point" type="hidden" value="<?=$point?>" /><input type="text" name="address" id="address"  value="<?=$address?>" size="80"/><a href="javascript:;" id="mapswitch" style="margin-left:10px;text-decoration:underline">使用地图</a></td>
    </tr>
    <tr>
	    <th></th>
	    <td><div style="width:628px;height:340px;border:1px solid #CCC;display:none" id="map"></div></td>
    </tr>
    
    <tr>
		<th>活动介绍：</th>
		<td><textarea name="content" id="content" style="visibility:hidden;height:300px;width:632px"><?=$content?></textarea></td>
	</tr>
      <tr>
        <th>摘要：</th>
        <td><textarea name="description" id="description" maxLength="255" style="width:627px;height:40px;" class="bdr"><?=$description?></textarea></td>
      </tr>
	<tr>
		<th>缩略图：</th>
		<td><?=element::thumb('thumb',$thumb,45);?></td>
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

<div class="mar_l_8 hand title" onclick="selectForm(this)" title="点击展开"><span class="span_open">表单选择</span></div>
<div id="inputs">
<table  border="0" cellspacing="0" cellpediting="0" class="table_form mar_l_8" id="inputss">
	<tr>
		<th width="80" class="t_r"><b>项目</b></th>
		<td width="10"></td>
		<th width="30"><b>启用</b></th>
		<th width="30"><b>必填</b></th>
		<th width="55"><b>前端显示</b></th>
	</tr>
  <tr>
    <th>姓名</th>
    <td></td>
    <td><input type="checkbox" name="fields[name][have]" <?php if($fields['name']['have']) echo 'checked ="checked"' ; ?> /></td>
    <td><input type="checkbox" name="fields[name][need]" <?php if($fields['name']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[name][display]" <?php if($fields['name']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
  <tr>
    <th>性别</th>
    <td></td>
    <td><input type="checkbox" name="fields[sex][have]" <?php if($fields['sex']['have']) echo 'checked ="checked"' ; ?>/>  </td>
    <td> <input type="checkbox" name="fields[sex][need]" <?php if($fields['sex']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[sex][display]" <?php if($fields['sex']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
  <tr>
    <th>照片</th>
    <td></td>
    <td> <input type="checkbox" name="fields[photo][have]"<?php if($fields['photo']['have']) echo 'checked ="checked"' ; ?>/></td>
    <td> <input type="checkbox" name="fields[photo][need]" <?php if($fields['photo']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[photo][display]" <?php if($fields['photo']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
  <tr>
    <th>身份证号码</th>
    <td></td>
    <td><input type="checkbox" name="fields[identity][have]" <?php if($fields['identity']['have']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[identity][need]" <?php if($fields['identity']['have']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[identity][display]" <?php if($fields['identity']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
  <tr>
    <th>工作单位</th>
    <td></td>
    <td><input type="checkbox" name="fields[company][have]" <?php if($fields['company']['have']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[company][need]" <?php if($fields['company']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[company][display]" <?php if($fields['company']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
  <tr>
    <th>职业</th>
    <td></td>
    <td><input type="checkbox" name="fields[job][have]"  <?php if($fields['job']['have']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[job][need]"  <?php if($fields['job']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[job][display]" <?php if($fields['job']['need']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
  <tr>
    <th>电话号码</th>
    <td></td>
    <td><input type="checkbox" name="fields[telephone][have]"  <?php if($fields['telephone']['have']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[telephone][need]"  <?php if($fields['telephone']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[telephone][display]" <?php if($fields['telephone']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
  <tr>
    <th>手机号码</th>
    <td></td>
    <td><input type="checkbox" name="fields[mobile][have]"  <?php if($fields['mobile']['have']) echo 'checked ="checked"' ; ?> /></td>
    <td><input type="checkbox" name="fields[mobile][need]"  <?php if($fields['nobile']['need']) echo 'checked ="checked"' ; ?> /></td>
    <td><input type="checkbox" name="fields[mobile][display]" <?php if($fields['mobile']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
  <tr>
    <th>E-mail</th>
    <td></td>
    <td><input type="checkbox" name="fields[email][have]"  <?php if($fields['email']['have']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[email][need]"  <?php if($fields['email']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[email][display]" <?php if($fields['email']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
  <tr>
    <th>QQ</th>
    <td></td>
    <td><input type="checkbox" name="fields[qq][have]"  <?php if($fields['qq']['have']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[qq][need]"  <?php if($fields['qq']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[qq][display]" <?php if($fields['qq']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
    <tr>
    <th>MSN</th>
    <td></td>
    <td><input type="checkbox" name="fields[msn][have]"  <?php if($fields['msn']['have']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[msn][need]"  <?php if($fields['msn']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[msn][display]" <?php if($fields['msn']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
    <tr>
    <th>个人主页</th>
    <td></td>
    <td><input type="checkbox" name="fields[site][have]"  <?php if($fields['site']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[site][need]"  <?php if($fields['site']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[site][display]" <?php if($fields['site']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
    <tr>
    <th>地址</th>
    <td></td>
    <td><input type="checkbox" name="fields[address][have]"  <?php if($fields['address']['have']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[address][need]" <?php if($fields['address']['need']) echo 'checked ="checked"' ; ?> /></td>
    <td><input type="checkbox" name="fields[address][display]" <?php if($fields['address']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
    <tr>
    <th>附件</th>
    <td></td>
    <td><input type="checkbox" name="fields[aid][have]" <?php if($fields['aid']['have']) echo 'checked ="checked"' ; ?> /></td>
    <td><input type="checkbox" name="fields[aid][need]" <?php if($fields['aid']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[aid][display]" <?php if($fields['aid']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
 <tr>
    <th>邮政编码</th>
    <td></td>
    <td><input type="checkbox" name="fields[zipcode][have]" <?php if($fields['zipcode']['have']) echo 'checked ="checked"' ; ?> /></td>
    <td><input type="checkbox" name="fields[zipcode][need]" <?php if($fields['zipcode']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[zipcode][display]" <?php if($fields['zipcode']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
  <tr>
    <th>附言</th>
    <td></td>
    <td><input type="checkbox" name="fields[note][have]" <?php if($fields['note']['have']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[note][need]" <?php if($fields['note']['need']) echo 'checked ="checked"' ; ?>/></td>
    <td><input type="checkbox" name="fields[note][display]" <?php if($fields['note']['display']) echo 'checked ="checked"' ; ?>/></td>
  </tr>
</table>
</div>

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
		 <table width="98%" border="0" cellspacing="0" cellpediting="0" class="table_form mar_l_8">
        <tr>
			<th width="80"></th>
			<td width="60">
				<input type="submit" value="保存" class="button_style_2" style="float:left"/>
			</td><td style="color:#444;text-align:left">按Ctrl+S键保存</td>
		</tr>
         </table>
</form>
<link href="<?=IMG_URL?>js/lib/colorInput/style.css" rel="stylesheet" type="text/css" />
<script src="<?=IMG_URL?>js/lib/cmstop.colorInput.js" type="text/javascript"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="tiny_mce/editor.js"></script>
<script type="text/javascript" src="apps/system/js/psn.js"></script>
<script type="text/javascript" src="js/related.js"></script>
<script type="text/javascript" src="apps/page/js/section.js"></script>
<?php if($baidumap): ?>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=<?=$baidumap?>&v=1.0&services=false" ></script>
<script type="text/javascript">
var isInit = false;
$('#mapswitch').click(function(){
	var mapobj = $('#map'), t=this;
	mapobj.slideToggle('slow',function(){
		if(!isInit){
			function addMarker(point)
			{
				var marker = new BMap.Marker(point);
				map.addOverlay(marker);
			}
			var map = new BMap.Map("map"),
			pointval = $('#point').val(),
			point = new BMap.Point(116.404, 39.915);
			if(pointval)
			{
				var a = pointval.split(',');
				point = new BMap.Point(parseFloat(a[0]),parseFloat(a[1]));
			}
			map.enableScrollWheelZoom();
			map.addControl(new BMap.NavigationControl());
			map.centerAndZoom(point, 12);
			addMarker(point);
			map.addEventListener("click", function(e){
				$('#point').val(e.point.lng+','+e.point.lat);
				map.clearOverlays();
				addMarker(e.point);
			});
			isInit = true;
		}
		t.innerHTML = mapobj.is(':visible')?'关闭地图':'使用地图';
	});
});
</script>
<?php else: ?>
<script type="text/javascript">
var tip = ct.tips('您还未设置百度地图', 'warning', 'center', 5);
tip.append('&nbsp;<a style="color:#336633;margin-left:10px;text-decoration:underline;" class="close" href="javascript:ct.assoc.open(\'?app=activity&controller=setting&action=index\');">点击设置</a>');
</script>
<?php endif ?>
<script type="text/javascript">
function selectForm(obj){
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

$('#content').editor('mini');
$(function(){
	$('#inputs input[name*="need"]').click(function(){
		var input = $(this);
		var have = input.parent().prev().find('input');
		this.checked && have.attr('checked',true);
	});
	$('#inputs input[name*="display"]').click(function(){
		var input = $(this);
		var have = input.parent().prev().prev().find('input');
		return !have.is(":checked") && ct.warn('请先启用此项！')?false:true;
	});
	$('#inputs input[name*="have"]').click(function(){
		var input = $(this);
		var need = input.parent().next().find('input');
		var display = input.parent().next().next().find('input');
		need.is(':checked') && need.attr('checked',false);
		display.is(':checked') && display.attr('checked',false);
	})
})

$('#inputss tr:gt(0)').hover(function(){$(this).addClass('over')},function(){$(this).removeClass('over')});

</script>
<?php $this->display('footer');
