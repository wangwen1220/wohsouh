<?php
defined('IN_ADMIN') or exit('No permission resources.'); 
$show_validator = $show_scroll = $show_dialog = 1; 
include $this->admin_tpl('header', 'admin');
 ?>
<form method="post" action="?m=special&c=special&a=add" id="myform">
<div class="pad-10">
<div class="col-tab">
	<ul class="tabBut cu-li">
		<li id="tab_setting_1" class="on" onclick="SwapTab('setting','on','',6,1);"><?php echo L('catgory_basic', '', 'admin');?></li>
		<li id="tab_setting_2" onclick="SwapTab('setting','on','',6,2);"><?php echo L('extend_setting')?></li>
	</ul>
<div id="div_setting_1" class="contentList pad-10">
	<table width="100%" class="table_form ">
		<tbody>
		<tr>
			<th width="200">专题类别：</th>
			<td>
			<div>
			<label><input type="radio" name="spicialclass" value="0" onclick="$('#cat_class').css({'display':'none'});" checked="checked"/>不属于任何类别</label>
			<label><input type="radio" name="spicialclass" value="1"  onclick="$('#cat_class').css({'display':'inline'});"/>选择类别</label>
			</div>
			<div id="cat_class" style="display:none;">
			<select name='catids[]' id='catids'  multiple="multiple"  style="height:200px;" title="<?php echo L('push_ctrl_to_select');?>">
<?php echo $string;?>
</select> 可以用crtl或者shift多选</div>


</td>
		</tr>
		<tr>
			<th width="200">专题字母：</th>
			<td><input name="letters" id="letters" class="input-text" type="text" size="40"/></td>
		</tr>
		<tr>
			<th width="200"><?php echo L('special_title')?>：</th>
			<td><input name="special[title]" id="title" class="input-text" type="text" size="40"></td>
		</tr>
		<tr>
			<th width="200">标题title：</th>
			<td><input name="top_title" id="top_title" class="input-text" type="text" size="40"></td>
		</tr>
		<tr>
			<th width="200">关键词：</th>
			<td><input name="keyword" id="keyword" class="input-text" type="text" size="40"></td>
		</tr>
		<tr>
			<th><?php echo L('special_banner')?>：</th>
			<td><?php echo form::images('special[banner]', 'banner', '', 'special', '', 40)?></td>
		</tr>
		<tr>
			<th><?php echo L('sepcial_thumb')?>：</th>
			<td><?php echo form::images('special[thumb]', 'thumb', '', 'special', '', 40, '', '', '', array(350, 350))?></td>
		</tr>
		<tr>
			<th><?php echo L('special_intro')?>：</th>
			<td><textarea name="special[description]" id="description" cols="50" rows="6"></textarea></td>
		</tr>
		<tr>
	    	<th align="right"  valign="top"><?php echo L('ishtml')?>：</th>
	        <td valign="top"><?php echo form::radio(array('1'=>L('yes'), '0'=>L('no')),'1', 'name="special[ishtml]"');?>
	        </td>
	    </tr>
	    <tr id="file_div" style="display:'block';">
	    	<th align="right" valign="top"><?php echo L('special_filename')?>：<br /><span style="font-size:9px;color:#ff4400"><?php echo L('submit_no_edit')?></span></th>
	        <td valign="top"><input type="text" name="special[filename]" id="filename" class="input-text" value="<?php echo $max_data?>" size="20">
	        </td>
	    </tr>
			<tr >
		    	<th align="right" valign="top">导航：<a href="javascript:addItemNa()" title="<?php echo L('add')?>"><span style="color:red;" >+</span></a></th>
		        <td valign="top">
				<div id="option_list_na">
	        	<div class="mb6"><span>链&nbsp;接&nbsp;名：&nbsp;<input type="text" id="link_name" name="link[1][navigation_name]" class="input-text" size="15">&nbsp;&nbsp;链接地址：<input type="text" name="link[1][link]" id="link_url" class="input-text" size="15">&nbsp;&nbsp;<?php echo L('listorder')?>：<input type="text" name="link[<?php echo $k?>][order]" value="1" size="6" class="input-text" ></span>&nbsp;<span id="linkTip"></span></div>
	        </div>
		        </td>
		    </tr>
	    <tr>
	    	<th><?php echo L('special_type')?>：<a href="javascript:addItem()" title="<?php echo L('add')?>"><span style="color:red;" >+</span></a></th>
	        <td valign="top"><div id="option_list">
	            <div class="mb6"><span><?php echo L('type_name')?>：<input type="text" id="type_name" name="type[1][name]" class="input-text" size="15">&nbsp;&nbsp;<?php echo L('type_path')?>：<input type="text" name="type[1][typedir]" id="type_path" class="input-text" size="15">&nbsp;&nbsp;<?php echo L('listorder')?>：<input type="text" name="type[<?php echo $k?>][listorder]" value="1" size="6" class="input-text" >&nbsp;&nbsp;是否为导航：<?php echo form::radio(array('0'=>L('否'), '1'=>L('是')), '0', 'name="type['.$k.'][navigation]"');?><?php echo form::select_template('huoshow', 'special', 'list', 'name="type[1][template]"', 'list');?></span>&nbsp;<span id="typeTip"></div>
	        </div>
	        </td>
	    </tr>
	    
	    <tr>
	    	<th>推荐位:</th>
	        <td valign="top">
	        <?php 
			foreach($pos_arr as $key=>$value)
			{
			?>
			<input name="specialposidarr[]" type="checkbox" value="<?php echo $value[posid] ?>" /><?php echo $value[name] ?>&nbsp;&nbsp;
	

<?php } ?>
	        </td>
	    </tr>
		</tbody>
	</table>
</div>
<div id="div_setting_2" class="contentList pad-10 hidden">
<table width="100%" class="table_form ">
	<tr>
		<th width="200"><?php echo L('pics_news')?>：</th>
		<td><span id="relation"></span><input type="button" class="button" value="<?php echo L('choose_pic_news')?>" onclick="import_info('?m=special&c=special&a=public_get_pics','<?php echo L('choose_pic_news')?>', 'msg_id', 'relation', 'pics');"><input type="hidden" name="special[pics]" value="" id="pics"><span class="onShow">(<?php echo L('choose_pic_model')?>)</span></td>
	</tr>
	<tr>
		<th><?php echo L('add_vote')?>：</th>
		<td><span id="vote_msg"></span><input type="button" class="button" value="<?php echo L('choose_exist_vote')?>" onclick="import_info('?m=vote&c=vote&a=public_get_votelist&from_api=1&target=dialog','<?php echo L('choose_vote')?>', 'msg_id', 'vote_msg', 'voteid');"><input type="hidden" name="special[voteid]" value="" id="voteid">&nbsp;<input type="button" class="button" value="<?php echo L('add_new_vote')?>" onclick="import_info('?m=vote&c=vote&a=add&from_api=1&target=dialog','<?php echo L('add_new_vote')?>', 'subject_title', 'vote_msg', 'voteid');"></td>
	</tr>
	<tr>
    	<th align="right"  valign="top"><?php echo L('index_page')?>：</th>
        <td valign="top"><?php echo form::radio(array('0'=>L('no'), '1'=>L('yes')), '0', 'name="special[ispage]"');?>
        </td>
    </tr>
    <tr>
    	<th align="right"  valign="top"><?php echo L('special_status')?>：</th>
        <td valign="top"><?php echo form::radio(array('0'=>L('open'), '1'=>L('pause')), '0', 'name="special[disabled]"');?>
        </td>
    </tr>
    <tr>
    	<th align="right"  valign="top"><?php echo L('template_style')?>：</th>
    	<td valign="top"><?php echo form::select($template_list, $info['default_style'], 'name="special[style]" id="style" onchange="load_file_list(this.value)"', L('please_select'))?>
    	<script type="text/javascript">$.getJSON('?m=admin&c=category&a=public_tpl_file_list&style=<?php echo $info['default_style']?>&module=special&templates=index|list|show&name=special', function(data){$('#index_template').html(data.index_template);$('#list_template').html(data.list_template);$('#show_template').html(data.show_template);});</script>
        </td>
    </tr>
	<tr>
    	<th align="right"  valign="top"><?php echo L('special_template')?>：</th>
        <td valign="top" >
		
		<?php echo form::select_template('huoshow', 'special', '', 'name="special[index_template]" onchange="change_template(this.value)"', 'index');?>
        </td>
    </tr>
	<tr>
		<th align="right"  valign="top"><?php echo "模版样式"?>：</th>
		<td valign="top" id='a'>
		<div  style="height:140px; padding:2px; width:600px; overflow:auto; white-space: nowrap;">
		<div style="width:600px; white-space:nowrap;" id="css_select_content">
		<?php 
			foreach($css_arr as $r=>$v) 
			{
		?>
			<div style="width:100px; min-height:100px; float:left; margin:5px; margin-right:10px; padding:3px; border:#999999 solid 1px;">
			<div style="background-image:url(<?php echo CSS_PATH;?>special/thumb/<?php echo $v[thumb];?>);width:100px; height:100px;">
				<input type="radio" name="cssfile" value="<?php echo $v[css];?>" <?php if($css_file==$v[css]) {?>checked="checked" <?php }?>/>
			</div>
			<div style="min-height:20px; text-align:center;"><?php echo $v[descript];?></div>
			</div>
			
		<?php }?>
		</div>
	</div>
		
		</td>
	</tr>
    <tr>
    	<th align="right" valign="top"><?php echo L('special_type_template')?>：</th>
        <td valign="top" id="list_template"><?php echo form::select_template('default', 'special', '', 'name="special[list_template]"', 'list');?>
        </td>
    </tr>
    <tr>
    	<th align="right"  valign="top"><?php echo L('special_content_template')?>：</th>
        <td valign="top" id="show_template"><?php echo form::select_template('default', 'special', '', 'name="special[show_template]"', 'show');?>
        </td>
    </tr>

	<!-- 新加设置项 -->
	<tr>
		<th valign="top" align="right">扩展类型：</th>
		<td valign="top">
			<select onchange="change_setting(this.value)" name="propertytype">
				<option selected="" value="1">请选择</option>
				<?php foreach ($propert_arr as $r=>$v) {?>
				<option value="<?php echo $v[id]?>"><?php echo $v[name]?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<th valign="top" align="right">属性：</th>
		<td valign="top" class='change_setting'>
			
		</td>
	</tr>
	<tr>
		<th width="200">测试状态：</th>
		<td><input name="game_state" id="game_state" class="input-text" type="text" size="40"/></td>
	</tr>
	<tr>
		<th width="200">开发商：</th>
		<td><input name="developers" id="developers" class="input-text" type="text" size="40"/></td>
	</tr>
	<tr>
		<th width="200">运营商：</th>
		<td><input name="operators" id="operators" class="input-text" type="text" size="40"/></td>
	</tr>
	<tr>
		<th width="200">官方网站：</th>
		<td><input name="official" id="official" class="input-text" type="text" size="40"/></td>
	</tr>
	</table>
   </div>
	 <div class="bk15"></div>
    <input name="dosubmit" type="submit" value="<?php echo L('submit')?>" class="button">
</div></div>
</form>
</body>
</html>
<script type="text/javascript"><!--

function change_template(value)
{
	$("#css_select_content")[0].innerHTML = "正在加载,请稍后...";
	$("#css_select_content").load("/index.php?m=content&c=index&a=getSpecialCssHtml&templatename="+value);
}

// 切换设置项内容
function change_setting(value) {
	$(".change_setting").html("正在加载,请稍后...").load("/index.php?m=content&c=index&a=getSpecialProperty&id="+value);
}

function load_file_list(id) {
	$.getJSON('?m=admin&c=category&a=public_tpl_file_list&style='+id+'&module=special&templates=index|list|show&name=special', function(data){$('#index_template').html(data.index_template);$('#list_template').html(data.list_template);$('#show_template').html(data.show_template);});
}

function import_info(url, title, msgID, htmlID, valID) {
	window.top.art.dialog({id:'selectid',iframe:url, title:title, width:'600', height:'400', lock:true},
		function(){
			var d = window.top.art.dialog({id:'selectid'}).data.iframe;
			var form = d.document.getElementById(msgID);
			var text = form.value;
			var data = text.split('|');
			if (data[2]) {
				$('#'+htmlID).html('<ul id="relation_'+htmlID+'" class="list-dot"><li><span>'+data[2]+'</span><a onclick="remove_relation(\''+htmlID+'\', \''+valID+'\')" class="close" href="javascript:;"></a></li></ul>');
			} else {
				var dosubmit = d.document.getElementById('dosubmit');
				dosubmit.click();
				$('#'+htmlID).html('<ul id="relation_'+htmlID+'" class="list-dot"><li><span>'+text+'</span><a onclick="remove_relation(\''+htmlID+'\', \''+valID+'\')" class="close" href="javascript:;"></a></li></ul>');
			}
			$('#'+valID).val(text);
			window.top.art.dialog({id:'selectid'}).close();
			return false;
		},
		function(){
			window.top.art.dialog({id:'selectid'}).close();
		});void(0);
}

function remove_relation(htmlID, valID) {
	$('#relation_'+htmlID).html('');
	$('#'+valID).val('');
}

function addItem() {
	var n = $('#option_list').find('input[name]').length/3+1;
    var template = '<?php echo str_replace("'", "\'", form::select_template('huoshow', 'special', 'list', 'name="type[|id|][template]"', 'list'));?>';
    
	var newOption =  '<div class="mb6"><span><?php echo L('type_name')?>：<input type="text" name="type['+n+'][name]" class="input-text" size="15">&nbsp;&nbsp;<?php echo L('type_path')?>：<input type="text" name="type['+n+'][typedir]" class="input-text" size="15">&nbsp;&nbsp;<?php echo L('listorder')?>：<input type="text" name="type['+n+'][listorder]" value="'+n+'" size="6" class="input-text" >&nbsp;&nbsp;是否设为导航：<?php echo form::radio(array('0'=>L('否'), '1'=>L('是')), '0', 'name='."type['+n+'][navigation]".'');?>'+template.replace('|id|', n)+'</span>&nbsp;<a href="javascript:;" onclick="descItem(this, '+n+');"><?php echo L('remove')?></a></div>';
	$('#option_list').append(newOption);
}

function descItem(a, id) {
	$(a).parent().append('<input type="hidden" name="type['+id+'][del]" value="1">');
	$(a).parent().fadeOut();
}

function descItemNa(a, id) {
	$(a).parent().append('<input type="hidden" name="link['+id+'][del]" value="1">');
	$(a).parent().fadeOut();
}

function addItemNa() {
	var n = $('#option_list_na').find('input[name]').length/3+1;
	var newOption =  '<div class="mb6"><span>链&nbsp;接&nbsp;名：&nbsp;<input type="text" id="link_name" name="link['+n+'][navigation_name]" class="input-text" size="15">&nbsp;&nbsp;链接地址：<input type="text" name="link['+n+'][link]" id="link_url" class="input-text" size="15">&nbsp;&nbsp;<?php echo L('listorder')?>：<input type="text" name="link['+n+'][order]" value="1" size="6" class="input-text" ></span>&nbsp;<span id="linkTip"></span>&nbsp;<a href="javascript:;" onclick="descItemNa(this, '+n+');"><?php echo L('remove')?></a></div>';
	$('#option_list_na').append(newOption);
}


function SwapTab(name,cls_show,cls_hide,cnt,cur){
	for(i=1;i<=cnt;i++){
		if(i==cur){
			 $('#div_'+name+'_'+i).show();
			 $('#tab_'+name+'_'+i).attr('class',cls_show);
		}else{
			 $('#div_'+name+'_'+i).hide();
			 $('#tab_'+name+'_'+i).attr('class',cls_hide);
		}
	}
}

$(document).ready(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'220',height:'70'}, function(){this.close();$(obj).focus();})}});
	$('#title').formValidator({autotip:true,onshow:"<?php echo L('please_input_special_title')?>",onfocus:"<?php echo L('min_3_title')?>",oncorrect:"<?php echo L('true')?>"}).inputValidator({min:1,onerror:"<?php echo L('please_input_special_title')?>"}).ajaxValidator({type:"get",url:"",data:"m=special&c=special&a=public_check_special",datatype:"html",cached:false,async:'true',success : function(data) {
        if( data == "1" )
		{
            return true;
		}
        else
		{
            return false;
		}
	},
	error: function(){alert("<?php echo L('server_no_data')?>");},
	onerror : "<?php echo L('special_exist')?>",
	onwait : "<?php echo L('checking')?>"
});
	$('#banner').formValidator({autotip:true,onshow:"<?php echo L('please_upload_banner')?>",oncorrect:"<?php echo L('true')?>"}).inputValidator({min:1,onerror:"<?php echo L('please_upload_banner')?>"});
	$('#thumb').formValidator({autotip:true,onshow:"<?php echo L('please_upload_thumb')?>",oncorrect:"<?php echo L('true')?>"}).inputValidator({min:1,onerror:"<?php echo L('please_upload_thumb')?>"});
	$('#filename').formValidator({autotip:true,onshow:"<?php echo L('special_file')?>",onfocus:'<?php echo L('use_letters')?>',oncorrect:"<?php echo L('true')?>"}).functionValidator({
	    fun:function(val,elem){
        if($("input:radio[type='radio'][checked]").val()==0){
		    return true;
	    } else if($("input:radio[type='radio'][checked]").val()==1 && val==''){
		    return "<?php echo L('please_input_name')?>"
	    } else {
			return true;
		}
	}
}).regexValidator({regexp:"^\\w*$", onerror:"<?php echo L('error')?>"});
	$("#type_name").formValidator({tipid:"typeTip",onshow:"<?php echo L('input_type_name')?>",onfocus:"<?php echo L('input_type_name')?>",oncorrect:"<?php echo L('true')?>"}).inputValidator({min:1,onerror:"<?php echo L('input_type_name')?>"});
	$('#type_path').formValidator({tipid:"typeTip",onshow:"<?php echo L('input_type_path')?>",onfocus:"<?php echo L('input_type_path')?>",oncorrect:"<?php echo L('true')?>"}).inputValidator({min:2,onerror:"<?php echo L('input_type_path')?>"}).regexValidator({regexp:"^\\w*$", onerror:"<?php echo L('error')?>"});
});
$("input:radio[name='special[ishtml]']").click(function (){
	if($("input:radio[name='special[ishtml]'][checked]").val()==0) {
		$("#file_div").hide();
	} else if($("input:radio[type='radio'][checked]").val()==1) {
		$("#file_div").show();
	}
});
--></script>