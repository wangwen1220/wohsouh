/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: home_uploadpic.js 5205 2010-03-08 08:13:28Z zhengqingpeng $
*/

var attachexts = new Array();
var attachwh = new Array();

var insertType = 1;
var thumbwidth = parseInt(60);
var thumbheight = parseInt(60);
var extensions = 'jpg,jpeg,gif,png';
var forms;
var nowUid = 0;
var albumid = 0;
var uploadStat = 0;
var picid = 0;
var nowid = 0;
var mainForm;
var successState = false;
var ieVersion = userAgent.substr(userAgent.indexOf('msie') + 5, 3);

function delAttach(id) {
	$('attachbody').removeChild($('attach_' + id).parentNode.parentNode.parentNode);
	if($('attachbody').innerHTML == '') {
		addAttach();
	}
	$('localimgpreview_' + id + '_menu') ? document.body.removeChild($('localimgpreview_' + id + '_menu')) : null;
}

function addAttach() {
	newnode = $('attachbodyhidden').rows[0].cloneNode(true);
	var id = nowid;
	var tags;
	tags = newnode.getElementsByTagName('form');
	for(i in tags) {
		if(tags[i].id == 'upload') {
			tags[i].id = 'upload_' + id;
		}
	}
	tags = newnode.getElementsByTagName('input');
	for(i in tags) {
		if(tags[i].name == 'attach') {
			tags[i].id = 'attach_' + id;
			tags[i].name = 'attach';
			tags[i].onchange = function() {insertAttach(id)};
			tags[i].unselectable = 'on';
		}
		if(tags[i].id == 'albumid') {
			tags[i].id = 'albumid_' + id;
		}
	}
	tags = newnode.getElementsByTagName('span');
	for(i in tags) {
		if(tags[i].id == 'localfile') {
			tags[i].id = 'localfile_' + id;
		}
	}
	nowid++;

	$('attachbody').appendChild(newnode);
}

addAttach();

function insertAttach(id) {
	var localimgpreview = '';
	var path = $('attach_' + id).value;
	var ext = getExt(path);
	var re = new RegExp("(^|\\s|,)" + ext + "($|\\s|,)", "ig");
	var localfile = $('attach_' + id).value.substr($('attach_' + id).value.replace(/\\/g, '/').lastIndexOf('/') + 1);

	if(path == '') {
		return;
	}
	if(extensions != '' && (re.exec(extensions) == null || ext == '')) {
		alert('对不起，不支持上传此类扩展名的图片');
		return;
	}
	attachexts[id] = inArray(ext, ['gif', 'jpg', 'jpeg', 'png']) ? 2 : 1;

	var inhtml = '<table cellspacing="0" cellpadding="0" class="tfm"><tr>';
	if(BROWSER.ie || userAgent.indexOf('firefox') >= 1) {
		var picPath = getPath($('attach_' + id));
		var imgCache = new Image();
		imgCache.src = picPath;
		inhtml += '<th>' + (picPath ? '<img src="' + picPath +'" width="60">' : '') + '&nbsp;</th>';
	}
	if(typeof no_insert=='undefined') {
		localfile += '&nbsp;<a href="javascript:;" title="点击这里插入内容中当前光标的位置" onclick="insertAttachimgTag(' + id + ');return false;">[插入]</a>';
	}
	localfile += '&nbsp;<span id="showmsg' + id + '"><a href="javascript:;" onclick="delAttach(' + id + ')">[删除]</a></span>';
	inhtml += '<td>' + localfile;
	inhtml += '<p class="d">图片描述:</p><textarea name="pic_title" cols="40" rows="2" class="pt"></textarea>';
	inhtml += '</td></tr></table>';

	$('localfile_' + id).innerHTML = inhtml;
	$('attach_' + id).style.display = 'none';

	addAttach();
}

function getPath(obj){
	if (obj) {
		if (BROWSER.ie && BROWSER.ie < 7) {
			obj.select();
			return document.selection.createRange().text;

		} else if(is_moz) {
			if (obj.files) {
				return obj.files.item(0).getAsDataURL();
			}
			return obj.value;
		} else {
			return '';
		}
		return obj.value;
	}
}
function inArray(needle, haystack) {
	if(typeof needle == 'string') {
		for(var i in haystack) {
			if(haystack[i] == needle) {
					return true;
			}
		}
	}
	return false;
}

function insertAttachimgTag(id) {
	edit_insert('[imgid=' + id + ']');
}

function uploadSubmit(obj) {
	obj.disabled = true;
	mainForm = obj.form;
	forms = $('attachbody').getElementsByTagName("FORM");
	albumid = $('uploadalbum').value;
	upload();
}

function start_upload() {
	$('btnupload').disabled = true;
	mainForm = $('albumresultform');
	forms = $('attachbody').getElementsByTagName("FORM");
	upload();
}

function upload() {
	if(typeof(forms[nowUid]) == 'undefined') return false;
	var nid = forms[nowUid].id.split('_');
	nid = nid[1];
	if(nowUid>0) {
		var upobj = $('showmsg'+nowid);
		if(uploadStat==1) {
			upobj.innerHTML = '上传成功';
			successState = true;
			var InputNode;
			try {
				var InputNode = document.createElement("<input type=\"hidden\" id=\"picid_" + picid + "\" value=\""+ nowid +"\" name=\"picids["+picid+"]\">");
			} catch(e) {
				var InputNode = document.createElement("input");
				InputNode.setAttribute("name", "picids["+picid+"]");
				InputNode.setAttribute("type", "hidden");
				InputNode.setAttribute("id", "picid_" + picid);
				InputNode.setAttribute("value", nowid);
			}
			mainForm.appendChild(InputNode);

		} else {
			upobj.style.color = "#f00";
			upobj.innerHTML = '上传失败 '+uploadStat;
		}
	}

	if($('showmsg'+nid) != null) {
		$('showmsg'+nid).innerHTML = '上传中，请等待(<a href="javascript:;" onclick="forms[nowUid].submit();">重试</a>)';
		$('albumid_'+nid).value = albumid;
		forms[nowUid].submit();
	} else if(nowUid+1 == forms.length) {
		if(typeof (no_insert) != 'undefined') {
			var albumidcheck = parseInt(parent.albumid);
			$('opalbumid').value = isNaN(albumidcheck)? 0 : albumid;
			if(!successState) return false;
		}
		mainForm.submit();
	}
	nowid = nid;
	nowUid++;
	uploadStat = 0;
}