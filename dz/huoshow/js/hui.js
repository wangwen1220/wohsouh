/*--------------------------------------------------------------------------
 *
 *	HUI: 为兼容不同浏览器提供一个非入侵式的统一接口，
 *	包含一些常用的实用函数的UI库，目的是为整个项目提供统一的粘合层，
 *	并非要实现一个类似YUI这么大而全的库。目前还处于初始阶段，
 *	所积累的内容还不够丰富，所有的这些函数或组件放在一个名为HUI的名空间中,
 *	详情请看各函数或成员的说明。
 *
 *	版权所有：huoshow.com
 *	更新日期：2012-03-31
 *
 *--------------------------------------------------------------------------*/

((function() {
	// jQuery 实例，使用它来避免$号被discuz冲突
	var $ = jQuery;

	var browser = [].concat(navigator.userAgent.match(/(MSIE|Chrome|Firefox|Opera)[\s\/]([^\.]*)/)).slice(1);

	// console.info 的简短版本，用于在有控制台的浏览器中打印日志方便调试
	function debug() {
		if(window.console){
			window.console.info(Array.prototype.slice.call(arguments).join(' '));
		}
	}

	// 在控制台中打印当前被调函数的一些信息，如函数名，参数等
	function printCallInfo(){
		var caller = arguments.callee.caller;
		if(!caller) return;
		if(typeof caller.name === 'undefined'){
			var tmp = caller+'';
			caller.name = tmp.substring(tmp.indexOf(' '), tmp.indexOf('('));
		}
		var args = ['CALLINFO:', caller.name].concat(Array.prototype.slice.call(caller.arguments));
		debug.apply(null, args);
	}

	function htmlEscape(html) {
		return html.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
	}

	function listen(node, type, listener, capture) {
		$(node).bind(type, listener);
	}

	function unlisten(node, type, listener, capture) {
		$(node).unbind(type, listener);
	}

	// lement.getBoundingClientRect的简短版本，传入一个dom节点对象，返回一个描述这个节点对象的位置与大小的对象
	// node 一个dom节点
	function getRect(node) {
		var rect = node.getBoundingClientRect();
		if(!rect.width){
			var r = {};
			r.left = rect.left;
			r.top = rect.top;
			r.right = rect.right;
			r.bottom = rect.bottom;
			r.width = rect.right - rect.left;
			r.height = rect.bottom - rect.top;
			return r;
		}
		return rect;
	}

	function hasAttr(node, attr) {
		if(!node || node.nodeType != 1){
			return false;
		}
		if(!node.hasAttribute){
			return !(node.getAttribute(attr) == null);
		}else{
			return node.hasAttribute(attr);
		}
	}

	function el(id){
		return document.getElementById(id);
	}

	function searchUp(node, attr, maxLavel) {
		if(!node){
			return null;
		}
		var i = 0;
		do{
			var r = hasAttr(node, attr);
			if(r){
				return node;
			}else{
				if(!node || node.nodeType != 1){
					return null;
				}
				node = node.parentNode;
				i++;
			}
		}while(!r && i<maxLavel);
		return null;
	}

	// JSON.parseJSON的IE6兼容版本，传入的是JSON字符串，解析后返回相应的对象
	function parseJSON(json) {
		if (window.JSON) {
			return JSON.parse(json);
		}else{
			try {
				return eval(['(', json, ')'].join(''));
			} catch (ex) {
				return null;
			}
		}
	}

	function loadScript(src, text) {
		var script = document.createElement('script');
		if(src){
			script.src = src;
		}else{
			script.text = text;
		}
		if(document.head){
			document.head.appendChild(script);
		}else{
			document.appendChild(script);
		}
	}

	function reloadScript(scriptNode) {
		if(scriptNode){
			loadScript(scriptNode.src, scriptNode.text);
			scriptNode.parentNode.removeChild(scriptNode);
		}
	}

	function park(node, target, site) {
		var docRect = getRect(document.body);
		var targetRect;
		if(target==window){
			var w = document.documentElement.clientWidth;
			var h = document.documentElement.clientHeight;
			targetRect = {
				left:0,
				top:0,
				width:w,
				height:h,
				right:w,
				bottom:h
			};
		}else{
			targetRect = getRect(target);
		}
		var nodeRect = getRect(node);
		site = site || 'lt'
		var x = 0;
		var y = 0;
		switch(site){
			case 'tl':
				x = targetRect.left;
				y = targetRect.top-nodeRect.height;
				break;
			case 'tc':
				x = targetRect.left-(nodeRect.width-targetRect.width)/2;
				y = targetRect.top-nodeRect.height;
				break;
			case 'tr':
				x = targetRect.left-nodeRect.width+targetRect.width;
				y = targetRect.top-nodeRect.height;
				break;
			case 'rt':
				x = targetRect.right;
				y = targetRect.top;
				break;
			case 'rc':
				x = targetRect.right;
				y = targetRect.top-(nodeRect.height-targetRect.height)/2;
				break;
			case 'rb':
				x = targetRect.right;
				y = targetRect.top+targetRect.height-nodeRect.height;
				break;
			case 'bl':
				x = targetRect.left;
				y = targetRect.top+targetRect.height;
				break;
			case 'bc':
				x = targetRect.left-(nodeRect.width-targetRect.width)/2;
				y = targetRect.top+targetRect.height;
				break;
			case 'br':
				x = targetRect.left-nodeRect.width+targetRect.width;
				y = targetRect.top+targetRect.height;
				break;
			case 'lt':
				x = targetRect.left-nodeRect.width;
				y = targetRect.top;
				break;
			case 'lc':
				x = targetRect.left-nodeRect.width;
				y = targetRect.top-(nodeRect.height-targetRect.height)/2;
				break;
			case 'lb':
				x = targetRect.left-nodeRect.width;
				y = targetRect.top+targetRect.height-nodeRect.height;
				break;
			case 'itl':
			case 'ilt':
				x = targetRect.left;
				y = targetRect.top;
				break;
			case 'itc':
				x = targetRect.left-(nodeRect.width-targetRect.width)/2;
				y = targetRect.top;
				break;
			case 'itr':
			case 'irt':
				x = targetRect.left+targetRect.width-nodeRect.width;
				y = targetRect.top;
				break;
			case 'irc':
				x = targetRect.left+targetRect.width-nodeRect.width;
				y = targetRect.top-(nodeRect.height-targetRect.height)/2;
				break;
			case 'ibl':
			case 'ilb':
				x = targetRect.left;
				y = targetRect.top+targetRect.height-nodeRect.height;
				break;
			case 'ibc':
				x = targetRect.left-(nodeRect.width-targetRect.width)/2;
				y = targetRect.top+targetRect.height-nodeRect.height;
				break;
			case 'ibr':
			case 'irb':
				x = targetRect.left+targetRect.width-nodeRect.width;
				y = targetRect.top+targetRect.height-nodeRect.height;
				break;
			case 'ilc':
				x = targetRect.left+targetRect.width-nodeRect.width;
				y = targetRect.top-(nodeRect.height-targetRect.height)/2;
				break;
			case 'ic':
				break;
			case 'c':
			default:
				x = targetRect.left+(targetRect.width-nodeRect.width)/2;
				y = targetRect.top+(targetRect.height-nodeRect.height)/2;
				break;
		}
		if(node.style.position == 'absolute'){
			x -= docRect.left;
			y -= docRect.top;
		}
		node.style.cssText += ['; left:', x, 'px; top:', y, 'px;'].join('');
	}

	function showDialog(id, content, position){
		var node = document.getElementById(id);
		if(!node){
			node = document.createElement('div');
			node.id = id;
			node.className = 'hui-dialog';
			node.style.cssText = 'visibility:hidden;';
		}
		if(browser[1] == 6 || position != 'fixed'){
			position = 'absolute';
		}
		node.style.position = position;
		document.body.appendChild(node);
		node.innerHTML = content;
		park(node, window, 'c');
		node.style.visibility = 'visible';
		return node;
	}
	window.showWindow = function(id, url){
		var e = window.event;
		if(e){
			e.returnValue = false;
		}else{
			var callee = arguments.callee;
			if(callee){
				var caller = callee.caller;
				if(caller && caller.arguments.length>0){
					e = caller.arguments[0];
					if(e && e.preventDefault){
						e.preventDefault();
					}
				}
			}
		}

		url = url.replace(/^(\w*:\/?\/?)?[^\/]*\//,'/');
			if(url){
				url = [url, '&handlekey=', id, '&infloat=yes&inajax=1&t=', (new Date()).getTime()].join('');
				if (ie6 || ie7 || ie8) url = encodeURI(url);
				$.get(url, function(data){
					id = 'fwin_'+id;
					var root = data.getElementsByTagName('root');
					var content = '数据格式错误,内容无法显示';
					if(root && root.length>0){
						content = root[0].textContent || root[0].text;
					}
					var dlg = showDialog(id, content, 'fixed');
					var scripts = dlg.getElementsByTagName('script');
					for(var i=0, l=scripts.length; i<l; i++){
						var script = scripts[i];
						loadScript(script.src, script.text);
					}
					$(dlg).draggable({handle: 'h3'});
				});
			}

	};
	window.hideWindow = function(id){
		id = 'fwin_'+id;
		var node = document.getElementById(id);
		if(node){
			node.style.visibility = 'hidden';
		}
	}

	function PopupBox(id, opts) {
		if(!id || $('#'+id).length){
			throw new Error('PopupBox init fail');
			return;
		}
		this._opts = $.extend({
			site: 'rt',
			className: 'popupbox'
		}, opts);
		this.isVisible = false;
		this._node = document.createElement('div');
		this._node.id = id;
		this._node.className = this._opts.className;
		$(this._node).css({ position: 'absolute' }).hide();
		$("body").append(this._node);
		$(this._node).bind('mousedown', this, this._handleMousedown);
		$(this._node).bind('mouseover', this, this._handleMouseover);
	}
	PopupBox.prototype.onshow = null;
	PopupBox.prototype._handleMousedown = function (e) {
		var box = e.data;
		var t = searchUp(e.target, 'popupboxaction', 10);
		if(t){
			if(t.getAttribute('popupboxaction') == 'hide'){
				box.hide();
			}
		}else{
			e.stopPropagation();
		}
	};
	PopupBox.prototype._handleMouseover = function (e) {
		e.stopPropagation();
	};
	PopupBox.prototype.show = function(trigger, content) {
		$(this._node).html(content);
		if(typeof this.onshow === 'function'){
			this.onshow.call(this, trigger);
		}
		$(this._node).show();
		this.isVisible = true;
		park(this._node, trigger, this._opts.site);
	};
	PopupBox.prototype.hide = function() {
		$(this._node).hide();
		this.isVisible = false;
	};
	PopupBox.prototype.getNode = function() {
		return this._node;
	};


	/**
	* tipbox
	*/
	$.fn.tipBox = function(id, options) {
		var opts = $.extend({
			className: 'jq-tipbox',
			onshow: null,
			site: 'b',
			hover: false
		}, options);

		var box = new PopupBox(id, opts);
		if(!box){
			return $(this);
		}
		if(typeof opts.onshow === 'function'){
			box.onshow = opts.onshow;
		}
		return $(this).each(function(){
			$(this).hover(function(){
				box.show(this);
			},function(){
				box.hide();
			});
		});
	};

	$.fn.pickBox = function(id, options) {
		var opts = $.extend({
			className: 'jq-pickbox',
			onshow: null,
			site: 'b',
			hover: false
		}, options);
		var eventType = opts.hover ? 'mouseover': 'mousedown';

		var box = new PopupBox(id, opts);
		if(!box){
			return $(this);
		}
		if(typeof opts.onshow === 'function'){
			box.onshow = opts.onshow;
		}
		var handleDocEvent = function(e) {
			box.hide();
			$(e.data).removeClass('jq-pickbox-open');
			$(document).unbind(eventType, handleDocEvent);
		};
		return $(this).each(function(){
			$(this).bind(eventType, function(e){
				if(!box.isVisible){
					e.stopPropagation();
					box.show(this);
					$(this).addClass('jq-pickbox-open');
					$(document).bind(eventType, this, handleDocEvent);
				}
			}).click(function(e){
				if(/^\s*javascript:/.test(this.href)){
					e.preventDefault();
				}
			});
		});
	};

	function insertText(node, text){
		if(node){
			node.focus();
			if(document.selection){
				document.selection.createRange().text = text;
			}else{
				var start = node.selectionStart;
				var end = node.selectionEnd;
				node.value = [node.value.substring(0, start), text,
					node.value.substring(end, node.value.length)].join('');
					var pos = start+text.length;
					node.setSelectionRange(pos, pos);
			}
		}
	}


	//exports
	if(!window.HUI){
		window.HUI = {};
	}
	HUI.$ = $;
	HUI.el = el;
	HUI.debug = debug;
	HUI.printCallInfo = printCallInfo;
	HUI.htmlEscape = htmlEscape;
	HUI.listen = listen;
	HUI.unlisten = unlisten;
	HUI.parseJSON = parseJSON;
	HUI.loadScript = loadScript;
	HUI.reloadScript = reloadScript;
	HUI.getRect = getRect;
	HUI.park = park;
	HUI.searchUp = searchUp;
	HUI.PopupBox = PopupBox;
	HUI.insertText = insertText;
})());
