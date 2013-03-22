<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$CONFIG['charset']?>" />
<title>延伸阅读</title>

<!--gloabl-->
<link rel="stylesheet" type="text/css" href="css/admin.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/validator/style.css"/>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/config.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/cmstop.js"></script>
<!--global -->
<!--tinymce-->
<script type="text/javascript" src="<?=ADMIN_URL?>tiny_mce/tiny_mce_popup.js"></script>
<script type="text/javascript">
var ed = tinyMCEPopup.editor;
$(function(){
	var ncat = tinyMCEPopup.getWindowArg('catid');
	$('#catid').each(function(){
		if(typeof ncat == 'object')
		$(this).val(ncat[0]).next().html(ncat[1]);
		else this.value = ncat;
	});
})
</script>
<!--tinymce-->

<style  type="text/css">
body{background-color:#FFFFFF}
fieldset{ margin:0px; padding:4px;}
input,select{ font-size:12px;}
.btn_float{ float:right; margin-right:0;}
</style>
</head>
<body>
<div class="pop_box_area">
		<div class="search_icon" style="width:330px;height:26px;">
		<form class="where">
			<div style="float:left;height:30px;">
				<input type="text" name="keywords" id="keywords" size="20" title="请输入关键词" value="<?=$keywords?>">
				<?=element::category('catid', 'catid')?>
			</div>
				<input type="submit" class="button_style_1" style="float:right;" value="搜索" />
			</form>
		</div>
	<div class="attachment_lib">
		<div class="box_10 f_r" style="width:250px;">
			<h3 style="font-size:12px;">已选(<span id="checked_count">0</span>)</h3>
			<div class="h_350" style="height:250px;">
				<ul id="read_selected" class="txt_list">
				</ul>
			</div>
		</div>
		<div class="box_10 f_l" style="width:250px;">
			<h3 style="font-size:12px;" class="layout"><span class="f_l">待选(<span id="count">0 / 0</span>)</span></h3>
			<div id="scroll_div" class="h_350" style="height:250px;">
			</div>
		</div>
		<div class="f_l" style="padding:135px 0 0 2px;">
			<img src="images/move_left.gif" alt="" title="" height="16" width="30" />
		</div>
		<div class="clear"></div>
	</div>
	
		<div class="mceActionPanel" align="center" style="margin-top:10px">
			<input type="submit" onclick="insertcode()" name="insert" class="button_style_1" value="插入" />
			<input type="button"  name="cancel" class="button_style_1 btn_float" value="取消" onClick="tinyMCEPopup.close();" />
		</div>
	
	
	
</div>
<script type="text/javascript">
var scrollListm = function(elem, targetUl, countSource, countTarget)
{
	var ul = $('<ul class="txt_list"></ul>');
	elem.append(ul);
	var selectedIds = [];
	var bind_target_li_event = function(li, id)
	{
		li.find('img.del').click(function(){
			var i = selectedIds.indexOf(id);
			if (i!=-1)
			{
				selectedIds.splice(i, 1);
			}
			li.remove();
			ul.find('>li[id$='+id+']').trigger('unCheck');
			countTarget(targetUl.find('>li').length);
		});
	};
	var build_target_li = function(txt, url, id)
	{
		var li = $('<li id="checked_'+id+'"><span class="f_r"><img class="hand del" height="16" width="16" title="取消" alt="取消" src="images/del.gif" /></span><span class="f_l"><a target="_blank" href="'+url+'" title="'+txt+'">'+txt.substring(0,15)+'</a></span></li>');
		bind_target_li_event(li, id);
		targetUl.append(li);
		return li;
	};
	
	var buildLi = function(item) // handle data
	{
	    var id = item.contentid;
        var title = item.title.substring(0,15);
		var li =$('<li style="clear:both;" id="item_'+id+'"><input style="float:left;" class="checkbox_style" type="checkbox" /><span style="float:left;cursor:pointer" title="'+item.title+'">'+title+'</span><a style="float:right" target="_blank" href="'+item.url+'"><img src="images/view.gif" /></a></li>');
		var checkbox = li.find('input');
		li.bind('check',function(){
	        // toggle seleted
	        (li.addClass('checked'), (checkbox[0].checked = true));
	    }).bind('unCheck',function(){
	        (li.removeClass('checked'), (checkbox[0].checked = false));
	    });
		var togglechk = function(e){
	        // toggle seleted
	        e.stopPropagation();
	        var flag = checkbox[0].checked;

	        e.target == checkbox[0] && (flag = !flag);
	        if (flag)
	        {
	        	var i = selectedIds.indexOf(id);
				if (i!=-1)
				{
					selectedIds.splice(i, 1);
				}
	        	targetUl.find('>li[id$='+id+']').remove();
	        	li.trigger('unCheck');
	        }
	        else
	        {
	        	selectedIds.push(id);
	        	build_target_li(item.title,item.url,id);
	        	li.trigger('check');
	        }
	        countTarget(targetUl.find('>li').length);
	    };
	    li.click(togglechk);
        checkbox.click(togglechk);
		if (selectedIds.indexOf(id)!=-1)
		{
			li.trigger('check');
		}
		ul.append(li);
	};
	var baseUrl = '?app=editor&controller=moreread&action=search&pagesize=20';
	var _oldwhere = '';
	var count = 0;
	var page = 1;
	var total = 0;
	var show_more_lock = false;
	this.load = function(where)
	{
		where.nodeType && (where = $(where));
		where && (_oldwhere = where.jquery ? where.serialize() : where);
		$.post(baseUrl, _oldwhere, function(json){
			total = json.total;
			page = 1;
			count = json.data.length;
			countSource(count + ' / '+ total);
			ul.empty();
			for (var i=0;i<count;i++)
			{
				buildLi(json.data[i]);
			}
		}, 'json');
	};
	elem.scroll(function(){
		if (!show_more_lock && count < total 
			&& elem.scrollTop() + elem.height() > elem[0].scrollHeight - 90)
		{
			show_more_lock = true;
			$.post(baseUrl+'&page='+(++page), _oldwhere, function(json){
				var l = json.data.length;
				count += l;
				countSource(count + ' / '+ total);
				for (var i=0;i<l;i++)
				{
					buildLi(json.data[i]);
				}
				show_more_lock = false;
			}, 'json');
		}
	});
}

var o = new scrollListm($('#scroll_div'),$('#read_selected'),function(c){
			$('#count').text(c);
		},function(c){
			$('#checked_count').text(c);
		});
		
o.load($('form.where:last'));
$('form.where:last input:submit').click(function(){
	o.load(this.form);
	return false;
})

function insertcode(){
	var code = [];
	var str = '';
	$('#read_selected .f_l').each(function(){
		var a = $(this).children('a');
		a[0].innerHTML= a.attr('title');
		a.removeAttr('title');
		code[code.length] = this.innerHTML ;
	});
	str = '<div id="moreread"><h3>延伸阅读：</h3><ul><li>'+code.join('</li><li>')+'</li></ul></div>';
	ed.execCommand('mceInsertContent', false, str);
	tinyMCEPopup.close();
}

</script>
</body></html>