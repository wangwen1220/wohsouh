function block_get_setting(classname, script) {
	var x = new Ajax();
	x.get('portal.php?mod=portalcp&ac=block&op=setting&classname='+classname+'&script='+script+'&inajax=1', function(s){
		ajaxinnerhtml($('tbody_setting'), s);
	});
}

function switch_blocktab(type) {
	if(type == 'setting') {
		$('blockformsetting').style.display = '';
		$('blockformdata').style.display = 'none';
		$('li_setting').className = 'a';
		$('li_data').className = '';
	} else {
		$('blockformsetting').style.display = 'none';
		$('blockformdata').style.display = '';
		$('li_setting').className = '';
		$('li_data').className = 'a';
	}
}

function showpicedit() {
	if($('picway_remote').checked) {
		$('pic_remote').style.display = "block";
		$('pic_upload').style.display = "none";
	} else {
		$('pic_remote').style.display = "none";
		$('pic_upload').style.display = "block";
	}
}

function block_show_thumbsetting(classname, styleid, bid) {
	var x = new Ajax();
	x.get('portal.php?mod=portalcp&ac=block&op=thumbsetting&classname='+classname+'&styleid='+styleid+'&bid='+bid+'&inajax=1', function(s){
		ajaxinnerhtml($('tbody_thumbsetting'), s);
	});
}

function block_showstyle(stylename) {
	var el_span = $('span_'+stylename);
	var el_value = $('value_' + stylename);
	if (el_value.value == '1'){
		el_value.value = '0';
		el_span.className = "";
	} else {
		el_value.value = '1';
		el_span.className = "a";
	}
}

function block_pushitem(bid) {
	var id = $('push_id').value;
	var idtype = $('push_idtype').value;
	if(id && idtype) {
		var x = new Ajax();
		x.get('portal.php?mod=portalcp&ac=block&op=push&&bid='+bid+'&idtype='+idtype+'&id='+id+'&inajax=1', function(s){
			ajaxinnerhtml($('tbody_pushcontent'), s);
		});
	}
}

function block_delete_item(bid, itemid, itemtype) {
	var msg = itemtype==1 ? '您确定要删除该数据吗？' : '您确定要屏蔽该数据吗？';
	if(confirm(msg)) {
		var x = new Ajax();
		x.get('portal.php?mod=portalcp&ac=block&op=remove&bid='+bid+'&itemid='+itemid+'&inajax=1', function(s){
			showWindow('showblock', 'portal.php?mod=portalcp&ac=block&op=block&bid='+bid+'&tab=data&t='+(+ new Date()), 'get', 0);
		});
	}
}

function portal_comment_requote(cid) {
	var x = new Ajax();
	x.get('portal.php?mod=portalcp&ac=comment&op=requote&cid='+cid+'&inajax=1', function(s){
		$('message').focus();
		ajaxinnerhtml($('message'), s);
	});
}

function insertImage(text) {
	text = "\n[img]" + text + "[/img]\n";
	insertContent('message', text)
}

function insertContent(target, text) {
	var obj = $(target);
	selection = document.selection;
	checkFocus(target);
	if(!isUndefined(obj.selectionStart)) {
		var opn = obj.selectionStart + 0;
		obj.value = obj.value.substr(0, obj.selectionStart) + text + obj.value.substr(obj.selectionEnd);
	} else if(selection && selection.createRange) {
		var sel = selection.createRange();
		sel.text = text;
		sel.moveStart('character', -strlen(text));
	} else {
		obj.value += text;
	}
}

function searchblock(from) {
	reloadselection('portal.php?mod=portalcp&ac=portalblock&searchkey='+encodeURIComponent($('searchkey').value)+'&from='+from);
}

function reloadselection(url) {
	ajaxget(url+'&t='+(+ new Date()), 'block_selection');
}

function getColorPalette(colorid, id, background) {
	return "<input id=\"c"+colorid+"\" onclick=\"createPalette('"+colorid+"', '"+id+"');\" type=\"button\" class=\"colorwd\" value=\"\" style=\"background: "+background+"\">";
}