/*
	[Discuz!] (C)2001-2009 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: forum.js 7177 2010-03-30 07:26:31Z zhengqingpeng $
*/

var clipboardswfdata = '';

function thumbImg(obj, method) {
	if(!obj) {
		return;
	}
	obj.onload = null;
	file = obj.src;
	zw = obj.offsetWidth;
	zh = obj.offsetHeight;
	if(zw < 2) {
		if(!obj.id) {
			obj.id = 'img_' + Math.random();
		}
		setTimeout("thumbImg($('" + obj.id + "'), " + method + ")", 100);
		return;
	}
	zr = zw / zh;
	method = !method ? 0 : 1;
	if(method) {
		fixw = obj.getAttribute('_width');
		fixh = obj.getAttribute('_height');
		if(zw > fixw) {
			zw = fixw;
			zh = zw / zr;
		}
		if(zh > fixh) {
			zh = fixh;
			zw = zh * zr;
		}
	} else {
		var widthary = imagemaxwidth.split('%');
		if(widthary.length > 1) {
			fixw = $('wrap').clientWidth - 200;
			if(widthary[0]) {
				fixw = fixw * widthary[0] / 100;
			} else if(widthary[1]) {
				fixw = fixw < widthary[1] ? fixw : widthary[1];
			}
		} else {
			fixw = widthary[0];
		}
		if(zw > fixw) {
			zw = fixw;
			zh = zw / zr;
			obj.style.cursor = 'pointer';
			if(!obj.onclick) {
				obj.onclick = function() {
					zoom(obj, obj.src);
				};
			}
		}
	}
	obj.width = zw;
	obj.height = zh;
}

function saveData(ignoreempty) {
	var ignoreempty = isUndefined(ignoreempty) ? 0 : ignoreempty;
	var obj = $('postform') && (($('fwin_newthread') && $('fwin_newthread').style.display == '') || ($('fwin_reply') && $('fwin_reply').style.display == '')) ? $('postform') : ($('fastpostform') ? $('fastpostform') : $('postform'));
	if(!obj) return;
	var data = subject = message = '';
	for(var i = 0; i < obj.elements.length; i++) {
		var el = obj.elements[i];
		if(el.name != '' && (el.tagName == 'TEXTAREA' || el.tagName == 'INPUT' && (el.type == 'text' || el.type == 'checkbox' || el.type == 'radio')) && el.name.substr(0, 6) != 'attach') {
			var elvalue = el.value;
			if(el.name == 'subject') {
				subject = trim(elvalue);
			} else if(el.name == 'message') {
				if(typeof wysiwyg != 'undefined' && wysiwyg == 1) {
					elvalue = html2bbcode(editdoc.body.innerHTML);
				}
				message = trim(elvalue);
			}
			if((el.type == 'checkbox' || el.type == 'radio') && !el.checked) {
				continue;
			}
			if(trim(elvalue)) {
				data += el.name + String.fromCharCode(9) + el.tagName + String.fromCharCode(9) + el.type + String.fromCharCode(9) + elvalue + String.fromCharCode(9, 9);
			}
		}
	}

	if(!subject && !message && !ignoreempty) {
		return;
	}

	saveUserdata('forum', data);
}

function switchAdvanceMode(url) {
	var obj = $('postform') && (($('fwin_newthread') && $('fwin_newthread').style.display == '') || ($('fwin_reply') && $('fwin_reply').style.display == '')) ? $('postform') : $('fastpostform');
	if(obj && obj.message.value != '') {
		saveData();
		url += '&cedit=yes';
	}
	location.href = url;
	return false;
}

function sidebar_collapse(lang) {
	if(lang[0]) {
		toggle_collapse('sidebar', null, null, lang);
		$('wrap').className = $('wrap').className == 'wrap with_side s_clear' ? 'wrap s_clear' : 'wrap with_side s_clear';
	} else {
		var collapsed = getcookie('collapse');
		collapsed = updatestring(collapsed, 'sidebar', 1);
		setcookie('collapse', collapsed, (collapsed ? 2592000 : -2592000));
		location.reload();
	}
}

function keyPageScroll(e, prev, next, url, page) {
	e = e ? e : window.event;
	var tagname = BROWSER.ie ? e.srcElement.tagName : e.target.tagName;
	if(tagname == 'INPUT' || tagname == 'TEXTAREA') return;
	actualCode = e.keyCode ? e.keyCode : e.charCode;
	if(next && actualCode == 39) {
		window.location = url + '&page=' + (page + 1);
	}
	if(prev && actualCode == 37) {
		window.location = url + '&page=' + (page - 1);
	}
}

function announcement() {
	var ann = new Object();
	ann.anndelay = 3000;ann.annst = 0;ann.annstop = 0;ann.annrowcount = 0;ann.anncount = 0;ann.annlis = $('anc').getElementsByTagName("li");ann.annrows = new Array();
	ann.announcementScroll = function () {
		if(this.annstop) { this.annst = setTimeout(function () { ann.announcementScroll(); }, this.anndelay);return; }
		if(!this.annst) {
			var lasttop = -1;
			for(i = 0;i < this.annlis.length;i++) {
				if(lasttop != this.annlis[i].offsetTop) {
					if(lasttop == -1) lasttop = 0;
					this.annrows[this.annrowcount] = this.annlis[i].offsetTop - lasttop;this.annrowcount++;
				}
				lasttop = this.annlis[i].offsetTop;
			}
			if(this.annrows.length == 1) {
				$('an').onmouseover = $('an').onmouseout = null;
			} else {
				this.annrows[this.annrowcount] = this.annrows[1];
				$('ancl').innerHTML += $('ancl').innerHTML;
				this.annst = setTimeout(function () { ann.announcementScroll(); }, this.anndelay);
				$('an').onmouseover = function () { ann.annstop = 1; };
				$('an').onmouseout = function () { ann.annstop = 0; };
			}
			this.annrowcount = 1;
			return;
		}
		if(this.annrowcount >= this.annrows.length) {
			$('anc').scrollTop = 0;
			this.annrowcount = 1;
			this.annst = setTimeout(function () { ann.announcementScroll(); }, this.anndelay);
		} else {
			this.anncount = 0;
			this.announcementScrollnext(this.annrows[this.annrowcount]);
		}
	};
	ann.announcementScrollnext = function (time) {
		$('anc').scrollTop++;
		this.anncount++;
		if(this.anncount != time) {
			this.annst = setTimeout(function () { ann.announcementScrollnext(time); }, 10);
		} else {
			this.annrowcount++;
			this.annst = setTimeout(function () { ann.announcementScroll(); }, this.anndelay);
		}
	};
	ann.announcementScroll();
}

function removeindexheats() {
	return confirm('您确认要把此主题从热点主题中移除么？');
}