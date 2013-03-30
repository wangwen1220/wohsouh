var _$ = jQuery;

var ie = navigator.userAgent.indexOf("MSIE") > -1;
var ie6 = navigator.userAgent.indexOf("MSIE 6") > -1;
var ie7 = navigator.userAgent.indexOf("MSIE 7") > -1;
var ie8 = navigator.userAgent.indexOf("MSIE 8") > -1;

function setMaxWidth(elementId, width){
	var container = document.getElementById(elementId);
	container.style.width = (container.clientWidth > (width - 1)) ? width + "px" : "auto";
}
function setMaxHeight(elementId, height){
	var container = document.getElementById(elementId);
	container.style.height = (container.scrollHeight > (height - 1)) ? height + "px" : "auto";
}

var hs = {};
hs.debug = false;


/*json*/
var JSON;
hs.parseJSON = function (json){
	if(JSON){
		return JSON.parse(json);
	}
	try{
		return (eval('('+json+')'));
	}catch(e){
		return null;
	}
};


/*ajax*/
hs.createXHR = function (){
	if(window.XMLHttpRequest){
		return new XMLHttpRequest();
	}else{
		try{
			return new ActiveXObject('Microsoft.XMLHTTP');
		}catch(ex){
			return null;
		}
	}
};

hs.Ajax = function (opts){
	this.method = opts.method || 'GET';
	this.async = (typeof opts.async === 'undefined')? true: opts.async;
	this.url = opts.url || '';
	this.onsuccess = opts.onsuccess;
	this.oncomplete = opts.oncomplete;
};

hs.Ajax.prototype = {
	send: function(){
		this.xhr = hs.createXHR();
		this.xhr.open(this.method, this.url, this.async);
		this.xhr.onreadystatechange = this._func();
		this.xhr.send(null);
	},

	_func: function(){
		var obj = this;
		return function(){
			if (obj.xhr.readyState == 4) {
				if(typeof obj.oncomplete === 'function'){
					obj.oncomplete(obj.xhr.responseText);
				}
				if(obj.xhr.status == 200){
					if(typeof obj.onsuccess === 'function'){
						obj.onsuccess(obj.xhr.responseText);
					}
				}
				delete obj.xhr.onreadystatechange;
				obj.xhr = null;
				obj = null;
			}
		}
	}
};

hs.getJSON = function(url, func){
	var ajax = new hs.Ajax({url: url, onsuccess: function(data){
		func(hs.parseJSON(data));
	}});
	ajax.send();
};

hs.ajax = function(opts){
	var ajax = new hs.Ajax(opts);
	ajax.send();
};

hs.getAndFillSuccess = function(node, data, onsuccess, hook){
	if(data){
		if(typeof hook === 'function')
			data = hook(data);
		var div = document.createElement('div');
		div.innerHTML = data;
		var df = document.createDocumentFragment();
		for(var i=0, l=div.childNodes.length; i<l; i++){
			df.appendChild(div.firstChild);
		}
		div = null;
		node.innerHTML = '';
		node.appendChild(df);
		hs.removeClassName(node, 'loading');
		if(typeof onsuccess === 'function')
			onsuccess();
	}
};
hs.getAndFill = function(url, node, hook){
	hs.ajax({ url: url, onsuccess: function(data){
		hs.getAndFillSuccess(node, data, hook);}});
	hs.addClassName(node, 'loading');
};


/*util*/
hs.log = function (m, isUrl){
	if(isUrl) m = unescape(m);
	if(hs.debug){
		try{ console.info(m);}catch(e){};
	}
};

hs.htmlEscape = function (s){
	return s.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;");
};


/*dom*/
hs.$ = function (s) { return document.getElementById(s); };
var el = getObject = hs.$;

hs.wrap = function (t, tag){
	var o = typeof t == 'string' ? el(t): t;
	var w = document.createElement(tag);
	o.parentNode.insertBefore(w, o);
	w.appendChild(o);
	return w;
};

hs.hasClassName = function(node, className){
	if(typeof node === 'string')
		node = hs.$(node);
	return (new RegExp(['\\b', className, '\\b'].join(''), 'g')).test(node.className);
};

hs.addClassName = function(node, className){
	if(typeof node === 'string')
		node = hs.$(node);
	if(this.hasClassName(node, className)) return;
	node.className = [node.className, ' ', className].join('');
};

hs.removeClassName = function(node, className){
	if(typeof node === 'string')
		node = hs.$(node);
	node.className = node.className.replace(new RegExp(['\\b', className, '\\b'].join(''), 'g'), '');
};

function walkTheDOM(node, func) {
	func(node);
	node = node.firstChild;
	while (node) {
		walkTheDOM(node, func);
		node = node.nextSibling;
	}
}

function cleanChildrenMethods(node) {
	walkTheDOM(node, function (e) {
		if(node != e){
			for (var n in e) {
				if (typeof e[n] === 'function') {
					e[n] = null;
				}
			}
		}
	});
}

function cleanChildren(node) {
	cleanChildrenMethods(node);
	node.innerHTML = '';
}

function getElementsByClassName(className, rootNode) {
	rootNode = rootNode || document.body;
	var results = [];
	walkTheDOM(o, function (node) {
		var a, c = node.className, i;
		if (c) {
			a = c.split(' ');
			for (i = 0; i < a.length; i += 1) {
				if (a[i] === className) {
					results.push(node);
					break;
				}
			}
		}
	});
	return results;
}

hs.rmNode = function(node){
	if(ie){
		var domTrash = hs.$('domTrash');
		if(!domTrash){
			domTrash = document.createElement('div');
			domTrash.id = 'domTrash';
			domTrash.style.display = 'none';
			document.body.appendChild(domTrash);
		}
		domTrash.appendChild(node);
		domTrash.innerHTML = '';
	}else{
		if(node && node.parentNode){
			node.parentNode.removeChild(node);
		}
	}
};


/*timer*/
function slow_for(func, onstop, n, interval){
	var _n = n || 1;
	var _t = setInterval(function(){
		if(_n<1){
			clearInterval(_t);
			onstop();
			return -1;
		}
		func(_n);
		_n--;
	}, interval);
	return _t;
}

function setTimer(fun1, onstop, seconds){
	return slow_for(fun1, onstop, seconds, 1000);
}

function removeTimer(id){
	clearInterval(id);
}


/*event*/
function stopPropagation(evt) {
	try{
		evt.stopPropagation();
	}catch(err){
		window.event.cancelBubble = true;
	}
}

function preventDefault (evt) {
	try{
		evt.preventDefault();
	}catch(err){
		window.event.returnValue = false;
	}
}

hs.addListener = function (node, eventName, func){
	if(node.addEventListener){
		node.addEventListener(eventName, func, false);
	}else{
		node.attachEvent("on" + eventName , func);
	}
};


/*cookies*/
function getCookie(key) {
	if (document.cookie.length<0) return "";
	try{
		var re = new RegExp(key+"=[^;]*");
		var cookie = document.cookie.match(re);
		return unescape(cookie[0].split("=")[1]);
	}catch(e){
		return "";
	}
}

function setCookie(key, value, seconds) {
	var expires = "";
	if(seconds){
		var d = new Date();
		d.setTime(d.getTime() + seconds*1000);
		expires = ";expires=" + d.toGMTString();
	}
	document.cookie = [key, "=", escape(value), expires].join("");
}

function removeCookie(key) {
	setCookie(key, "", -10);
}


/*position*/
function pos_center (o){
	var p = document.documentElement;
	var l = (p.clientWidth - o.offsetWidth)/2 + p.scrollLeft;
	var t = (p.clientHeight - o.offsetHeight)/2 + p.scrollTop;
	o.style.cssText += [';left:', l, 'px;', 'top:', t, 'px;'].join('');
}


/*popup*/
function make_popup (opts){
	var pid = "popup_" + opts.id;
	var o = el(pid);
	if(o)return o;
	o = document.createElement('div');
	o.id = pid;
	o.className = ['popup', (opts.className || "")].join(' ');
	o.style.cssText = ";position:absolute;z-index:1000;display:none;";

	//methods
	o.show = function(){
		var df = document.createDocumentFragment();
		df.appendChild(this);
		document.body.appendChild(df);
		this.style.display = 'block';
		this.onshow(this);
		this.pos(this);
		this.style.visibiliby = 'visible';
		(get_popup_helper()).pos(this);
	};

	o.hide = function(){
		this.style.display = 'none';
		this.style.visibiliby = 'hidden';
		(get_popup_helper()).hide();
	};

	o.html = function(html){
		this.innerHTML = html;
		this.pos(this);
	};

	o.repos = function(){
		this.pos(this);
	}

	//events
	o.onshow = (opts.onshow || function(){});
	o.pos = (opts.pos || pos_center);

	var c = el(opts.id);
	if(c) o.appendChild(c);
	document.body.appendChild(o);
	return o;
}

function get_popup_helper(){
	return el('popup_helper') || (function(){
		var frame = document.createElement('iframe');
		frame.id = 'popup_helper';
		frame.src = 'javascript:""';
		frame.scrolling = 'no';
		frame.frameBorder = '0';
		frame.style.display = 'none';
		frame.pos = function(o){
			this.style.cssText = [';position:absolute;display:block;', 'left:', o.offsetLeft, 'px;',
			'top:', o.offsetTop, 'px;', 'width:', o.offsetWidth, 'px;',
			'height:', o.offsetHeight, 'px;'].join('');
		};
		frame.hide = function(){this.style.display = 'none';};
		document.body.insertBefore(frame, document.body.firstChild);
		return frame;
	})();
};


/*提示信息框*/
function popinfo (m, s) {
	s = s || 3;
	if(window._t_popinfo) clearTimeout(_t_popinfo);
	var p = make_popup({id: 'popinfo'});
	p.html(m);
	p.show();
	window._t_popinfo = setTimeout(function(){
		p.hide();
		clearTimeout(window._t_popinfo);
	}, s*1000);
};


/*misc*/
function flash_title(title){
	var _t1 = document.title;
	var _t2 = title || "";
	if(_t1 == _t2) return;
	var _flash = function(){
		slow_for(function(i){
			document.title = document.title == _t1? _t2: _t1;
		}, function(){
			document.title = _t1;
			setTimeout(_flash, 5000);
		}, 3, 200);
	};
	_flash();
	flash_title = function(){};
}

/*rewrite discuz's noticeTitle*/
function noticeTitle(){
	var t = "【　　　】" + document.title;
	document.title = "【新提醒】" + document.title;
	flash_title(t);
	noticeTitle = function(){};
}


/*flash*/
function checkFlashVersion(){
	var depVersion = arguments;
	var insVersion = null;
	var mt = navigator.mimeTypes['application/x-shockwave-flash'];
	if(mt){
		var ep = mt.enabledPlugin;
		if(ep){
			if(ep.version){
				//Firefox
				insVersion = ep.version.split('.');
			}else{
				//do nothing on Webkit and Opera
				return 1;
			}
		}else{
			return -2;
		}
	}else{
		//IE
		try{
			insVersion = (new ActiveXObject('ShockwaveFlash.ShockwaveFlash')).
				GetVariable('$version').
				match(/\s+\d+\,\d+\,\d+\,\d+/).
				toString().split(',');
		}catch(e){ return -2; }
	}
	for(var i=0, ii=depVersion.length; i<ii; i++){
		if(insVersion[i] < depVersion[i]){
			return -1;
		}else if(insVersion[i] > depVersion[i]){
			return 1;
		}
	}
	return 1;
}


/*hover box*/
function make_hoverbox(t, f1, f2){
	var o = typeof t == 'string' ? el(t): t;
	if(o.isHoverbox) return o;
	o.isHoverbox = true;
	var $ = jQuery;
	f1 = f1 || function(){};
	f2 = f2 || function(){};
	$(o).hover(function(e){
		$(o).removeClass('hoverbox-on').addClass('hoverbox-on');
		f1();
	}, function(e){
		$(o).removeClass('hoverbox-on');
		f2();
	});
}


/*select box*/
function make_selectbox(t, hover){
	var t = typeof t == 'string' ? el(t): t;
	if(t.isSelectBox) return t.parentNode;
	t.isSelectBox = true;
	t.style.display = "none";
	//init
	var o = hs.wrap(t, "span");
	o.id = "j_selectbox_"+t.id;
	o.className = "j-selectbox";
	o.style.display = "inline-block";

	o.head = document.createElement("div");
	o.head.className = "j-selectbox-head";
	o.appendChild(o.head);

	o.body = document.createElement("div");
	o.body.className = "j-selectbox-body";
	o.body.style.cssText += ";position:absolute;z-index:1000;";
	o.appendChild(o.body);

	o.el = t;

	o.isOpened = false;
	o.head.innerHTML = t.options.item(0).innerHTML;

	o.select = function(index){
		t.selectedIndex = index;
		o.head.innerHTML = t.options.item(index).innerHTML;
	};

	var ul = document.createElement("ul");
	for(var i=0,l=t.options.length; i<l; i++){
		var li = document.createElement("li");
		li.innerHTML = ['<a href="javascript:;"',
			'style="display:block;width:100%;">',
			'<span style="display:block;white-space:nowrap;">',
			t.options.item(i).innerHTML, '</span></a>'].join('');
		li.index = i;
		li.onclick = function(e){
			o.select(this.index);
			o.close();
			stopPropagation(e);
		};
		ul.appendChild(li);
	}
	o.body.appendChild(ul);

	o.open = function(){
		if(o.isOpened) return;
		o.body.style.display = "";
		hs.addClassName(o, 'j-selectbox-opened');
		o.isOpened = true;
	};

	o.close = function(){
		o.body.style.display = "none";
		hs.removeClassName(o, 'j-selectbox-opened');
		o.isOpened = false;
	};

	_$(o).mouseleave(o.close);
	if(hover){
		_$(o).mouseenter(o.open);
	}else{
		_$(o).click(o.open);
	}

	o.close();
	window[o.id] = o;
	return o;
}


/*pagebox*/
function make_pagebox(id, opts){
	var o = hs.$(id);
	if(!o) return;
	if(o.isPageBox) return o;

	var opts = _$.extend({
		links_selector: '.pagebox-links',
		pages_selector: '.pagebox-pages',
		next_selector: '.pagebox-next',
		prev_selector: '.pagebox-prev',
		current_class: 'pagebox-active',
		current: 0,
		event_type: 'click',
		interval: 0,
		onchanged: null,
		effect: 0,
		loop: true
	}, opts);

	o.isPageBox = true;
	o.isHover = false;
	o.isStart = false;
	o.isEnd = false;

	_$(o).hover(function(){o.isHover=true;}, function(){o.isHover=false;});

	o._links = _$(opts.links_selector, o);
	var _contents = _$(opts.pages_selector, o);
	_contents.wrapAll('<div class="pagebox_pages_wrap" style="position:relative;"></div>');
	_contents.wrapAll('<div class="pagebox_pages_wrap_body" style="position:relative;"></div>');
	_contents.wrap('<div class="pagebox_page"></div>');
	_contents.show();
	o._pages = _$('.pagebox_page', o);
	o.i = -1;

	var _effects = {
		0: function(){
				o._pages.hide();
				o._currentPage.show();
			},
		1: function(){
				var sv = o._currentPage.get(0).offsetLeft;
				o._pages.parent().animate({
					left: -sv+'px'
				}, 300);
			},
		2: function(){
				var sv = o._currentPage.get(0).offsetTop;
				o._pages.parent().parent().animate({
					scrollTop: sv+'px'
				}, 300);
			},
		3: function(){
				o._pages.fadeOut(500);
				o._currentPage.fadeIn(500);
			}
	};

	o.to = function(i){
		if(i<0 || i>=o._pages.length || i==o.i) return;
		o.i = i;
		if(o.i>0){
			o.isStart = false;
		}else{
			o.isStart = true;
		}
		if(o.i<o._pages.length-1){
			o.isEnd = false;
		}else{
			o.isEnd = true;
		}
		_$(opts.prev_selector, o).removeClass('prev-disabled').addClass(i<=0?'prev-disabled': '');
		_$(opts.next_selector, o).removeClass('next-disabled').addClass(i>=o._pages.length-1?'next-disabled': '');
		o._links.removeClass(opts.current_class);
		o._current = o._links.eq(i);
		o._current.addClass(opts.current_class);
		o._currentPage = o._pages.eq(i);
		_effects[opts.effect]();
		//callback
		if(typeof opts.onchanged == 'function') opts.onchanged(o);
	};

	o.to(opts.current);

	o.next = function(){
		if(opts.loop && o.isEnd){
			o.to(0);
		} else{
			o.to(o.i+1);
		}
	};

	o.prev = function(){
		if(opts.loop && o.isStart){
			o.to(o._pages.length-1);
		} else{
			o.to(o.i-1);
		}
	};

	o._links.bind(opts.event_type, function(e){
		e.preventDefault();
		o.to(o._links.index(this));
	});

	_$(opts.next_selector, o).bind('click', function(e){
		e.preventDefault();
		o.next();
	});

	_$(opts.prev_selector, o).bind('click', function(e){
		e.preventDefault();
		o.prev();
	});

	if(opts.interval){
		setInterval(function(){
			if(o.isHover) return;
			if(o.isEnd){
				o.to(0);
			}else{
				o.next();
			}
		}, opts.interval*1000);
	}

	return o;
}


function make_scrollbox(id, opts){
	var o = el(id);
	if(o.isScrollbox) return o;
	o.isScrollbox = true;
	var $ = jQuery;

	var opts = $.extend({
		type: 'x',
		item: '.scrollbox-item',
		prev: '.scrollbox-prev',
		next: '.scrollbox-next',
		curr: 'scrollbox-item-curr',
		wrap: 'scrollbox-items-wrap',
		wrap_body: 'scrollbox-items-wrap-body',
		interval: 0
	}, opts);

	o.getItems = function(){return $(opts.item, o);};
	o.getPrevButton = function(){return $(opts.prev, o);};
	o.getNextButton = function(){return $(opts.next, o);};
	o.getWrap = function(){return $('.'+opts.wrap, o);};
	o.getWrapBody = function(){return $('.'+opts.wrap_body, o);};
	o.getCurrentItem = function(){ return o.getItems()[o.i]; };
	o.length = o.getItems().length;

	var _type = {
		x: ['scrollLeft', 'offsetLeft'],
		y: ['scrollTop', 'offsetTop']
	};

	o.prev = function(){
		if(o.isStart){
			o.i = o.length;
			o.getWrap().get(0)[_type[opts.type][0]] = o.getCurrentItem()[_type[opts.type][1]];
		}
		o.go(o.i-1);
	};

	o.getPrevButton().click(o.prev);

	o.next = function(){
		if(o.isEnd){
			o.i = 0;
			o.getWrap().get(0)[_type[opts.type][0]] = 0;
		}
		o.go(o.i+1);
	};
	o.getNextButton().click(o.next);

	o.go = function(i){
		if(i<0 || i>o.length || i==o.i || o.isWorking) return;
		o.isWorking = true;
		o.i = i;
		o.isStart = (o.i<=0);
		o.isEnd = (o.i>=o.length);
		var sv = o.getCurrentItem()[_type[opts.type][1]];
		var ani = {};
		ani[_type[opts.type][0]] = sv+'px';
		o.getWrap().animate(ani, { complete:function(){
			o.getWrap().get(0)[_type[opts.type][0]]=sv;
			o.isWorking = false;
		} });
	};

	o.i = 0;

	//init
	var _tmp = o.getItems();
	if(_tmp.length){
		if(_tmp.parent().get(0).tagName == 'UL') _tmp = _tmp.parent();
		_tmp.wrapAll(['<div class="', opts.wrap, '" style="position:relative;"></div>'].join(''));
		_tmp.wrapAll(['<div class="', opts.wrap_body, '"></div>'].join(''));
		o.getItems().clone().appendTo(o.getItems().parent());
		o.getWrap().get(0)[_type[opts.type][0]] = 0;

		o.isHover = false;
		o.isStart = false;
		o.isEnd = false;

		$(o).hover(function(){o.isHover=true;}, function(){o.isHover=false;});

		if(opts.interval){
			setInterval(function(){
				if(!o.isHover) o.next();
			}, opts.interval*1000);
		}
		return o;
	}else{
		return null;
	}
}

(function($){
	/*pop*/
	$.pop_close = function() {
		$(document).unbind("mousedown", $.pop_close);
		$(".pop-iframe").hide();
		$(".pop-b").hide();
		$(".pop_active").removeClass('pop_active');
	};

	$.fn.pop = function(type, func){
		var type = type || "s";
		var func = func || function(){};
		$('body').prepend('<iframe class="pop-iframe" src="" frameborder="0" scrolling="no" style="position:absolute;display:none;"></iframe>');
		return this.each(function() {
			$(this).mousedown(function(event){
				event.stopPropagation();
				if($(this).hasClass("pop_active")) return false;
				$.pop_close();
				$(this).addClass("pop_active");
				var b = $(".pop-b", this);
				var l = $(this).offset().left;
				var t = $(this).offset().top + $(this).height() - 1;
				if(type == "n") t = $(this).offset().top - b.height() - $(this).height()+1;
				b.css({
					left: l + "px",
					top: t + "px",
					zIndex: 1001
				}).show();
				$(".pop-iframe").css({
					left: l + "px",
					top: t + "px",
					width: b.width() + "px",
					height: b.height() + "px",
					zIndex: 1000
				}).show();
				func();
				$(document).bind("mousedown", $.pop_close);
			});
		});
	};

	$.fn.layout = function(opts){
		var opts = $.extend({a: "", b: ""}, opts);

		var go = function(a, b, s, t){
			if(!t) t = a.height();
			s.css({top: t+'px'});
			a.css({height: t+"px"});
			b.css({top: t+s.height()+"px"});
			if(ie6){
				s.css({width: '100%'});
				a.css({width: '100%', height: t+"px"});
				b.css({width: '100%', height: b.parent().height()-s.height()-a.height()+"px"});
			}
		};

		return this.each(function(){
			var $self = $(this);
			var $a = $(opts.a);
			var $b = $(opts.b);
			$self.css({position: 'relative', overflow: 'hidden'});
			var $s = $("<div class='splitter'></div>");
			$s.draggable({axis: 'y', containment: 'parent', helper: 'clone',
				stop: function(e, o){
					var t = o.position.top;
					go($a, $b, $s, t);
				}
			});
			$s.css({position: 'absolute', cursor: 's-resize', left: '0', right: '0'});
			$b.after($s);
			$a.css({position: 'absolute', left: '0', right: '0', top: '0'});
			$b.css({position: 'absolute', left: '0', right: '0', bottom: '0'});
			go($a, $b, $s);
		});
	};

	$(function(){
		/*====== 新资讯中加载并执行jquery.kandytabs.js ======*/
		if($(".kandyTabs").length) {
			$.getScript("/statics/js/jquery.kandytabs.js", function(){
				$(".kandyTabs").KandyTabs();
			});
		}

		// 新资讯中热点排行展开与折叠效果
		$('.ui_fold_box_redian, .ui_fold_box_reyi').find('li').hover(function() {
			if(!$(this).hasClass('ui_fold_box_content_selected')) {
				$(this).addClass('ui_fold_box_content_selected').siblings().removeClass('ui_fold_box_content_selected');
				return false;
			}
		});

		// 赛事图片滑动
		var $scrollbox_items = $('.scrollbox-items-wrap');
		$('.Purple_Black_dong a').click(function() {
			$(this).addClass('Purple_Black_hover').siblings().removeClass('Purple_Black_hover');
			$scrollbox_items.eq($(this).index()).addClass('scrollbox-items-current').siblings().removeClass('scrollbox-items-current');
		});
		// 右边按钮点击
		$('.events_zt_list_right').click(function() {
			var $scrollbox_items_current = $('.scrollbox-items-current ul');
			if (!$scrollbox_items_current.is(':animated')) {
				$scrollbox_items_current.animate({left: '-=142px'}, 500, function() {
					var $this = $(this);
					$this.append($this.find('li')[0]).css('left', 'auto');
				});
			}
		});
		// 左边按钮点击
		$('.events_zt_list_left').click(function() {
			var $scrollbox_items_current = $('.scrollbox-items-current ul');
			if (!$scrollbox_items_current.is(':animated')) {
				$scrollbox_items_current.prepend($scrollbox_items_current.find('li:last')).css('left', '-142px').animate({left: '0'}, 500);
			}
		});

		// 小游戏列表滚动效果
		/*====== 加载并执行jquery.eslider.js ======*/
		var $small_game_slide = $("#js_small_game_slide");
		if($small_game_slide.length || $('#js_slide_box_video').length) {
			$.getScript("/statics/js/jquery.eslider.js", function(){/*todo*/
				//var list_item_i = 1;
				$("#js_small_game_slide").eslider();
			});
		}

		// 游戏首页操行榜切换
		$('.ranking_list_nav').click(function(){
			$(this).siblings().removeClass('ranking_list_selected');
			$(this).next().andSelf().addClass('ranking_list_selected');
			return false;
		});

		// 小游戏操作页，游戏简介切换
		/*$('#js_game_info').find('.game_info_tab').click(function(){
			$(this).addClass('game_info_tab_selected').siblings('.game_info_tab').removeClass('game_info_tab_selected').next('.game_info_content').addClass('fn_hide');
			$(this).next('.game_info_content').removeClass('fn_hide');
			return false;
		});*/

		// 电视荧屏热播滚动效果
		var $tv_slide_prev = $('#tv_slide_prev');
		var $tv_slide_next = $('#tv_slide_next');
		var $tv_slide_content = $('#tv_slide_content');
		var $tv_slide_list = $tv_slide_content.children('ul');
		var tv_slide_page = 1;
		var tv_slide_i = 6;//每版放6个图片
		var tv_slide_page_count = Math.ceil($tv_slide_list.children('li').length / tv_slide_i);//只要不是整数，就往大的方向取最小的整数
		var tv_slide_unit_width = $tv_slide_content.width();//获取滚动框架的宽度，不带单位

		//下一个按钮
		$tv_slide_next.click(function() {
			if(!$tv_slide_list.is(":animated")){
				if(tv_slide_page == tv_slide_page_count) {//已经到最后一个版面了,如果再向后，必须跳转到第一个版面。
					$tv_slide_list.animate({left: 0}, 800);//通过改变left值，跳转到第一个版面
					tv_slide_page = 1;
				} else {
					$tv_slide_list.animate({left: '-=' + tv_slide_unit_width}, 800);//通过改变left值，达到每次换一个版面
					tv_slide_page++;
				}
			}
			return false;
		});

		//上一个按钮
		$tv_slide_prev.click(function() {
			if(!$tv_slide_list.is(":animated")) {
				if(tv_slide_page == 1) {//已经到第一个版面了,如果再向前，必须跳转到最后一个版面
					$tv_slide_list.animate({left: '-=' + tv_slide_unit_width * (tv_slide_page_count-1)}, 800);//通过改变left值，跳转到最后一个版面
					tv_slide_page = tv_slide_page_count;
				} else {
					$tv_slide_list.animate({left: '+=' + tv_slide_unit_width}, 800);//通过改变left值，达到每次换一个版面
					tv_slide_page--;
				}
			}
			return false;
		});

		/*====== 列表－游戏列表－赛事、影视、音乐、游戏 ======*/
		$('#js_tab_artical_box').find('dt').hover(function() {
			$(this).siblings().removeClass('show');
			$(this).next('dd').andSelf().addClass('show');
		});

		// MV Show
		var $js_mv_show = $('#js_mv_show');
		var $mv_show_thumb_li = $js_mv_show.find('.mv_show_thumb li');
		var $mv_show_poster_li = $js_mv_show.find('.mv_show_poster li');
		$mv_show_thumb_li.hover(function(){
			var i = $mv_show_thumb_li.index(this);
			var $mv_show_poster_li_current = $mv_show_poster_li.eq(i);
			if(!$mv_show_poster_li_current.is(':animated')){
				$(this).addClass('current').siblings().removeClass('current');
				$mv_show_poster_li_current.fadeIn(200).siblings().fadeOut();
			}
		});

		/*====== 加载并执行jquery.autoslider.js ======*/
		if($("#js_slide_box_video").length || $('#autoslide').length) {
			$.getScript("/statics/js/jquery.autoslider.js", function(){/*todo*/
				// 游戏大首页滚动效果
				$("#js_slide_box_video").autoslider({ slide_list: '.ui_img_list_page', auto_slide: false });
				$("#js_slide_box_feidian").autoslider({ slide_list: '.ui_img_list', slide_width: 288 });
			});
		}

		/*======滚动banner效果======*/
		$('.pic_slide').each(function(){
			$this = $(this);
			var $slide_num = $this.find('.num');
			var $slide_prev = $this.find('.prev');
			var $slide_next = $this.find('.next');
			var $slide_list = $this.find('ul');
			var slide_width = $this.width();
			var num_len = $slide_num.length;
			var index = 1;
			var slide_timer;
			$slide_num.mouseover(function() {
				index = $slide_num.index(this);
				show_img(index, $slide_list, slide_width, $slide_num);
			}).eq(0).mouseover();

			//滑入停止动画，滑出开始动画
			$this.hover(function() {
				clearInterval(slide_timer);
			}, function() {
				slide_timer = setInterval(function() {
					if(++index == num_len) index = 0;
					show_img(index, $slide_list, slide_width, $slide_num);
				}, 5000);
			}).trigger("mouseleave");

			// 点击后退按钮
			$slide_prev.click(function() {
				if(index-- == 0) index = num_len - 1;
				show_img(index, $slide_list, slide_width, $slide_num);
			});

			// 点击前进按钮
			$slide_next.click(function() {
				if(++index == num_len) index = 0;
				show_img(index, $slide_list, slide_width, $slide_num);
			});
		});

		/* 通过控制left，来显示不同的幻灯片 */
		function show_img (index, slide_list, slide_width, num) {
			slide_list.stop(true, false).animate({ left: -slide_width * index }, 600);
			num.removeClass("current").eq(index).addClass("current");
		}

		/* 网页游戏顶部导航 */
		$('#js_top_nav').children('dt').hover(function() {
			$(this).addClass('show').siblings('dt').removeClass('show')
				.end().next('dd').addClass('show').siblings('dd').removeClass('show');
		});

		/* 网页游戏新游图集、新游视频切换 */
		$('#js_game_tab').children('h2').click(function() {
			var $this = $(this);
			if(!$this.is(':animated')) {
				$(this).siblings('h2').removeClass('show').siblings('ul').hide();
				$(this).addClass('show').next('ul').fadeIn(800);
			}
			return false;
		});

		// 大首页资讯TAB切换
		$('.ui_box_tab_nav > a').click(function(){
			var index_this = $('.ui_box_tab_nav > a').index(this);
			$(this).addClass('selected').siblings().removeClass('selected');
			$(this).parents('.ui_box_nav').siblings('.ui_box_tab_body').addClass('fn_hide').eq(index_this).removeClass('fn_hide');
			return false;
		});

		// 论坛圈子TAB切换
		$('.ui_tab_nav > h2').click(function(){
			var index_this = $('.ui_tab_nav > h2').index(this);
			$(this).addClass('selected').siblings().removeClass('selected');
			$(this).parent().nextAll('.ui_tab_body').addClass('fn_hide').eq(index_this).removeClass('fn_hide');
			return false;
		});

		// 专题TAB切换
		var $tab_nav_zt_nav = $('#tab_nav_zt').find('a');
		$tab_nav_zt_nav.hover(function(){
			var index_this = $tab_nav_zt_nav.index(this);
			$(this).addClass('selected').siblings().removeClass('selected');
			$tab_nav_zt_nav.parent().siblings('.ui_tab_body').eq(index_this).removeClass('fn_hide').siblings('.ui_tab_body').addClass('fn_hide');
			return false;
		});

		// 游戏大首页头条资讯切换
		$('#js_news_tab').find('dt').hover(function(){
			$(this).siblings().removeClass('selected');
			$(this).next('dd').andSelf().addClass('selected');
			return false;
		}).find('a').click(function() {
			return false;
		});

		// 今日热点历史排行榜切换
		$('#js_text_tab').find('.ui_text_tab_nav > a').hover(function(){
			var index_this = $('#js_text_tab').find('.ui_text_tab_nav > a').index(this);
			$(this).addClass('selected').siblings().removeClass('selected');
			$('#js_text_tab').find('.ui_text_list').removeClass('selected').eq(index_this).addClass('selected');
		}).click(function() {
			return false;
		});

		// 网游大观 明星八卦 非主流切换
		$('.ui_img_tab_nav').find('a').click(function(){
			var index_this = $('.ui_img_tab_nav').find('a').index(this);
			$(this).addClass('ui_img_tab_selected').siblings('a').removeClass('ui_img_tab_selected');
			$(this).parent().siblings('.ui_img_list').removeClass('ui_img_tab_selected').eq(index_this).addClass('ui_img_tab_selected');
			return false;
		});

		// 精美壁纸下载TAB切换
		$('body.game .ui_box_nav').each(function(){
			var $this = $(this);
			$this.find('a').click(function(){
				var index_a = $this.find('a').index(this);
				$(this).addClass('nav_selected').siblings('a').removeClass('nav_selected');
				$(this).parent().siblings('.list_wrapper').removeClass('list_selected').eq(index_a).addClass('list_selected');
				return false;
			});
		});

		/*====== 加载并执行 jquery.divselect.js ======*/
		var $divselect = $('#divselect');
		if($divselect.length) {
			$.getScript("/statics/js/jquery.divselect.js", function(){
				$.divselect("#divselect", "#inputselect");// 大首页 jquery divselect
			});
			$('body').click(function(){ $divselect.find('.options').hide(); });
			$divselect.find('li').hover(function() { $(this).toggleClass('hover'); });
		}

		/*====== 有火秀相册的页面加载并执行 jquery.hsgallery.js ======*/
		if($('#hsgallery').length) {
			$.getScript("/statics/js/jquery.hsgallery.js", function(){
				var page_num = $('#thumb li').length;
				$('#hsg_page_num').text(page_num); // 设置总的图片个数
				$('.hs_list_thumb').css('width', page_num * 106 + 'px'); // 设置缩略图列表的宽度
				if($.browser.opera) { // Opera 不支持动态鼠标指针，为其单独设置前进后退的样式
					$('#photoPrev, #photoNext').hover(function(){
						$(this).addClass('opera_hover');
					},function(){
						$(this).removeClass('opera_hover');
					});
				}

				$(window).load(function(){ // 当页面加载完，预加载相册大图片
					$('#thumb > li > span').each(function(){
						var img = new Image();
						img.src = this.innerHTML;
					});
				});

				var $hs_photo_loading = $('<div id="hs_photo_loading"></div>').insertBefore('#photoView');

				var slider = new Slider({
					icontainer : "hs_scrl_ct",
					idrag : "bar",
					plusBtn : "scrlPrev",
					reduceBtn : "scrlNext",
					panel : "thumb",
					content : "hs_scrl_main",
					direction : "left",
					acceleration : 5,
					sliderAcc : 1
				});

				var ul = hsg.get("hs_scrl_main"),
					list = ul.getElementsByTagName("li"),
					len = list.length,
					intervalD = Math.ceil( ul.scrollWidth / len ),
					intervalS = Math.ceil( slider.Max.left / len ),
					index = 1,
					photoPrev = hsg.get("photoPrev"),
					photoNext = hsg.get("photoNext"),
					photo = hsg.get("photo"),
					photoIndex = hsg.get("photoIndex"),
					photoDesc = hsg.get("photoDesc").getElementsByTagName("p")[0];

				if(ie6){// 设置图片在 IE6 中的宽度和高度
					if($(photo).width() > $(photo).height()){
						$(photo).width(560);
						$(photo).css('height', 'auto');
					}else{
						$(photo).height(444);
						$(photo).css('width', 'auto');
					}
				}

				function removeClass(){
					hsg.each(list, function(o, i){
						o.className = "";
					});
				}

				function Go(i, o){
					index = i;
					var _distance = 0;
					if(i > 2){
						slider.content.scrollLeft = intervalD * (i - 2);
					}else{
						slider.content.scrollLeft = 0;
					}
					_distance = intervalS * i;
					if(i === len - 1){
						_distance = intervalS * (i + 1);
					}
					slider.idrag.style.left = Math.min(Math.max(_distance , 0),slider.Max.left)  + "px"
					removeClass();
					o.className = "hs_list_active";

					var photo_src = o.getElementsByTagName("span")[0].innerHTML;
					$(photo).fadeOut(100, function(){
						photo.src = photo_src;
						if(!ie) $hs_photo_loading.show();//IE7中有问题
					});
					$(photo).load(function(){
						$hs_photo_loading.hide();
						$(photo).fadeIn(500);
					});

					photoDesc.innerHTML = o.getElementsByTagName("p")[0].innerHTML;
					photoIndex.innerHTML = i + 1;
				}

				Go(0, list[0]);

				hsg.each(list, function(o, i){
					hsg.addEvent(o, function(){
						Go(i, o);
					},"click");
				});

				hsg.addEvent(photoNext, function(){
					index++;
					if(index >= len){
						index = len - 1;
						$(photoNext).addClass('hs_photo_nav_disabled');
						return;
					}else{
						$(photoNext).removeClass('hs_photo_nav_disabled');
					}
					Go(index, list[index]);
				},"click");

				hsg.addEvent(photoPrev, function(){
					index--;
					if(index < 0 ){
						index = 0;
						$(photoPrev).addClass('hs_photo_nav_disabled');
						return;
					}else{
						$(photoPrev).removeClass('hs_photo_nav_disabled');
					}
					Go(index, list[index]);
				},"click");
			});
		}

		/********* 登录注册页 *********/
		// 简单验证

		// 合作网站账号登录
		// 打开绑定框
		/*$('#login_connect a').click(function(){
			$('#overlay, #bind_account').show();
			$('#bind_account dt:last').trigger('click');
			return false;
		});*/
		// 关闭绑定框
		$('#overlay, #close_bind_box').click(function(){
			$('#overlay, #bind_account').hide();
			return false;
		});
		// 切换绑定账号
		$('#bind_account dt').click(function(){
			$(this).addClass('selected').siblings('dt').removeClass('selected').end().next('dd').show().siblings('dd').hide();
		}).last().trigger('click');
		$('#username').focus();

		// 暂时隐藏头部导航中某些菜单
		$('.top_nav_bar .common').html('<a href="http://www.huoshow.com/" target="_blank">首页</a>-<a href="http://www.huoshow.com/star/" target="_blank">明星</a>-<a href="http://www.huoshow.com/movie/" target="_blank">电影</a>-<a target="_blank" href="http://www.huoshow.com/tv/">电视</a>-<a href="http://www.huoshow.com/music/" target="_blank">音乐</a>-<a target="_blank" href="http://www.huoshow.com/supermodel/">超模</a>-<a href="http://www.huoshow.com/events/" target="_blank">赛事</a>-<a href="http://game.huoshow.com/" target="_blank">游戏</a>-<a href="http://www.huoshow.com/pic/" target="_blank">美图</a>-<a target="_blank" href="http://myshow.huoshow.com/">我秀</a>').show();
		//$('.top_nav_bar .common').html('<a href="http://www.huoshow.com/" target="_blank">首页</a>-<a href="http://www.huoshow.com/star/" target="_blank">明星</a>-<a href="http://www.huoshow.com/movie/" target="_blank">电影</a>-<a target="_blank" href="http://www.huoshow.com/tv/">电视</a>-<a href="http://www.huoshow.com/music/" target="_blank">音乐</a>-<a target="_blank" href="http://www.huoshow.com/supermodel/">超模</a>-<a href="http://www.huoshow.com/events/" target="_blank">赛事</a>-<a href="http://www.huoshow.com/game/" target="_blank">游戏</a>-<a href="http://www.huoshow.com/pic/" target="_blank">美图</a>').show();

		//图片延迟加载 用此插件时，会出现一个 get null 404 错误，暂时停用此插件
		/*if($('body.lazyload').length){
			$.getScript("/statics/js/jquery.lazyload.min.js", function(){
				$("img").lazyload({ effect: "fadeIn" });
			});
		}*/
	});

	$(window).load(function() {
		// ie6 png 图片透明
		// 将单引号中的内容修改为你使用了png图片的样式，与 CSS 文件中一样即可
		// 如果要直接插入 png 图片，在单引号内加入 img 即可
		if(ie6) {
			$.getScript("/statics/js/DD_belatedPNG.js", function(){
				DD_belatedPNG.fix('img, .png_bg, .channel_logo a, .Photo_Detailspage_left a, .Photo_Detailspage_right a, .ui_list_box_title span, .ui_fold_box_title span, .hot_game_nav dt, .ui_content_box .ui_content_more, .ui_content_title, .ui_content_mobile .ui_game_list li, .ui_box_title, .ui_img_box dt h4 span, .ui_img_box h3, .list_style_arrow li, .ui_top_nav dt.show.ui_top_nav_remen a, .ui_top_nav dt.ui_top_nav_remen a:hover, .ui_game_play .ui_game_play_title, .ui_game_play, .ui_game_play .game_info_box dt, .ui_mark a, .ui_top_nav_home dt, .ui_content_box .ui_content_enter, .ui_top_nav_home dt a, .ui_news_tab dt.selected h2 a, .ui_news_tab dt h2 a, .ui_content_home .ui_num_list .num_top, .ui_content_home .ui_num_list .num, .ui_slide_box .ui_slide_box_nav li.next a, .hs_photo_desc, .hs_btn_pscrl, .hs_btn_nscrl, .tv_news_video li em, .tv_pianhua li em, .ui_video_list .icon_play');
			});
		}
	});
})(jQuery);