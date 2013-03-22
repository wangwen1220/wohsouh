var _$ = jQuery;

var ie = navigator.userAgent.indexOf("MSIE") > -1;
var ie6 = navigator.userAgent.indexOf("MSIE 6") > -1;
var ie7 = navigator.userAgent.indexOf("MSIE 7") > -1;
var ie8 = navigator.userAgent.indexOf("MSIE 8") > -1;

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


;(function($){
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
		// 暂时隐藏头部导航中某些菜单
		//$('.top_nav_bar .common').html('<a href="http://www.huoshow.com/" target="_blank">首页</a>-<a href="http://www.huoshow.com/star/" target="_blank">明星</a>-<a href="http://www.huoshow.com/movie/" target="_blank">电影</a>-<a target="_blank" href="http://www.huoshow.com/tv/">电视</a>-<a href="http://www.huoshow.com/music/" target="_blank">音乐</a>-<a target="_blank" href="http://www.huoshow.com/supermodel/">超模</a>-<a href="http://www.huoshow.com/events/" target="_blank">赛事</a>-<a href="http://www.huoshow.com/game/" target="_blank">游戏</a>-<a href="http://www.huoshow.com/pic/" target="_blank">美图</a>-<a target="_blank" href="http://myshow.huoshow.com/">我秀</a>').show();
		//$('.top_nav_bar .common').html('<a href="http://www.huoshow.com/" target="_blank">首页</a>-<a href="http://www.huoshow.com/events/" target="_blank">赛事</a>-<a href="http://www.huoshow.com/star/" target="_blank">明星</a>-<a href="http://www.huoshow.com/movie/" target="_blank">影视</a>-<a href="http://www.huoshow.com/music/" target="_blank">音乐</a>-<a href="http://www.huoshow.com/game/" target="_blank">游戏</a>-<a href="http://www.huoshow.com/pic/" target="_blank">美图</a>').show();

		/*$('#sub_channel ul li').find('a:contains("直播")').hide();
		$('#sub_channel ul li').find('a:contains("MY秀")').hide();
		$('#sub_channel ul li').find('a:contains("群组")').hide();
		$('#sub_channel ul li').find('a:contains("空间")').hide();
		$('#sub_channel ul li').find('a:contains("论坛")').hide();*/

    //修正 IE6 中 a 标签外的其它元素不支持 hover 伪类问题
    $('.attR_closed').hover(function(){
      $(this).addClass('hover');
    }, function(){
      $(this).removeClass('hover');
    });

		//用于解决 IE6 下浮层被 select 穿透 BUG
		if(ie6){
		var $maskelement = $('.p1_m, .pic_word li, .slide, .elementmask');
    $('.menu-title a').hover(function(){
      $maskelement.css('z-index', '-1');
    }, function(){
      $maskelement.css('z-index', '0');
    });
    }
  });
})(jQuery);