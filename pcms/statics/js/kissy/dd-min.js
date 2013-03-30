/*
Copyright 2012, KISSY UI Library v1.30rc
MIT Licensed
build time: Jul 5 23:04
*/
KISSY.add("dd/constrain",function(e,l,k){function j(){j.superclass.constructor.apply(this,arguments)}function f(c){var m,g,c=c.drag.get("dragNode"),i=this.get("constrain");if(i){if(!0===i){var b=h(a);this.__constrainRegion={left:m=b.scrollLeft(),top:g=b.scrollTop(),right:m+b.width(),bottom:g+b.height()}}if(i.nodeType||e.isString(i))i=h(i);i.getDOMNode?(m=i.offset(),this.__constrainRegion={left:m.left,top:m.top,right:m.left+i.outerWidth(),bottom:m.top+i.outerHeight()}):e.isPlainObject(i)&&(this.__constrainRegion=
i);this.__constrainRegion&&(this.__constrainRegion.right-=c.outerWidth(),this.__constrainRegion.bottom-=c.outerHeight())}}function d(a){var a=a.info,c=a.left,g=a.top,i=this.__constrainRegion;i&&(a.left=Math.min(Math.max(i.left,c),i.right),a.top=Math.min(Math.max(i.top,g),i.bottom))}function c(){this.__constrainRegion=null}var h=k.all,a=e.Env.host;e.extend(j,l,{__constrainRegion:null,attachDrag:function(a){a.on("dragstart",f,this).on("dragend",c,this).on("dragalign",d,this)},detachDrag:function(a){a.detach("dragstart",
f,this).detach("dragend",c,this).detach("dragalign",d,this)}},{ATTRS:{constrain:{value:!0}}});return j},{requires:["base","node"]});KISSY.add("dd",function(e,l,k,j,f,d,c,h,a){return{Draggable:k,Droppable:j,DDM:l,Constrain:d,Proxy:f,DraggableDelegate:c,DroppableDelegate:h,Scroll:a}},{requires:"dd/ddm,dd/draggable,dd/droppable,dd/proxy,dd/constrain,dd/draggable-delegate,dd/droppable-delegate,dd/scroll".split(",")});
KISSY.add("dd/ddm",function(e,l,k,j,f,d){function c(){c.superclass.constructor.apply(this,arguments)}function h(a,c,g){var o=g.get("mode"),h=a.get("validDrops"),d=0,m=0,f=i(g.get("node")),k=w(f);e.each(h,function(a){var n;if(n=a.getNodeFromTarget(c,g.get("dragNode")[0],g.get("node")[0]))if("point"==o)b(i(n),g.mousePos)&&(n=w(i(n)),d?n<m&&(d=a,m=n):(d=a,m=n));else if("intersect"==o)n=w(x(f,i(n))),n>m&&(m=n,d=a);else if("strict"==o&&(n=w(x(f,i(n))),n==k))return d=a,!1});if((h=a.get("activeDrop"))&&
h!=d)h._handleOut(c),g._handleOut(c);a.__set("activeDrop",d);d&&(h!=d?d._handleEnter(c):d._handleOver(c))}function a(b){b._shim=(new f("<div style='background-color:red;position:"+(u?"absolute":"fixed")+";left:0;width:100%;height:100%;top:0;cursor:"+p.get("dragCursor")+";z-index:"+v+";'></div>")).prependTo(r.body||r.documentElement).css("opacity",0);a=o;if(u)j.on(q,"resize scroll",s,b);o(b)}function o(b){var a=b.get("activeDrag").get("activeHandler"),c="auto";a&&(c=a.css("cursor"));"auto"==c&&(c=
b.get("dragCursor"));b._shim.css({cursor:c,display:"block"});u&&s.call(b)}function m(b){var a=b.get("drops");b.__set("validDrops",[]);e.each(a,function(b){b._active()})}function g(b){var a=b.get("drops");b.__set("validDrops",[]);e.each(a,function(b){b._deActive()})}function i(b){var a=b.offset();return{left:a.left,right:a.left+(b.__dd_cached_width||b.outerWidth()),top:a.top,bottom:a.top+(b.__dd_cached_height||b.outerHeight())}}function b(b,a){return b.left<=a.left&&b.right>=a.left&&b.top<=a.top&&
b.bottom>=a.top}function w(b){return b.top>=b.bottom||b.left>=b.right?0:(b.right-b.left)*(b.bottom-b.top)}function x(b,a){var c=Math.max(b.top,a.top),g=Math.min(b.right,a.right),i=Math.min(b.bottom,a.bottom);return{left:Math.max(b.left,a.left),right:g,top:c,bottom:i}}function y(b){b&&(b.__dd_cached_width=b.outerWidth(),b.__dd_cached_height=b.outerHeight())}var q=e.Env.host,r=q.document,u=6===l.ie,t=e.throttle(function(b){var a;if(a=this.__activeToDrag)b.preventDefault(),a._move(b);else if(a=this.get("activeDrag"))b.preventDefault(),
a._move(b),h(this,b,a)},30),v=999999;c.ATTRS={dragCursor:{value:"move"},clickPixelThresh:{value:3},bufferTime:{value:1E3},activeDrag:{},activeDrop:{},drops:{value:[]},validDrops:{value:[]}};var s=e.throttle(function(){var b;(b=this.get("activeDrag"))&&b.get("shim")&&this._shim.css({width:k.docWidth(),height:k.docHeight()})},30);e.extend(c,d,{__activeToDrag:0,_regDrop:function(b){this.get("drops").push(b)},_unRegDrop:function(b){b=e.indexOf(b,this.get("drops"));-1!=b&&this.get("drops").splice(b,1)},
_regToDrag:function(b){this.__activeToDrag=b;j.on(r,"mouseup",this._end,this);j.on(r,"mousemove",t,this);6===l.ie&&r.body.setCapture()},_start:function(){this.get("drops");var b=this.__activeToDrag;this.__set("activeDrag",b);this.__activeToDrag=0;b.get("shim")&&a(this);y(b.get("node"));m(this)},_addValidDrop:function(b){this.get("validDrops").push(b)},_end:function(){var b=this.get("activeDrag"),a=this.get("activeDrop");j.remove(r,"mousemove",t,this);j.remove(r,"mouseup",this._end,this);6===l.ie&&
r.body.releaseCapture();this.__activeToDrag&&(this.__activeToDrag._end(),this.__activeToDrag=0);this._shim&&this._shim.hide();b&&(b._end(),g(this),a&&a._end(),this.__set("activeDrag",null),this.__set("activeDrop",null))}});var p=new c;p.inRegion=b;p.region=i;p.area=w;p.cacheWH=y;p.PREFIX_CLS="ks-dd-";return p},{requires:["ua","dom","event","node","base"]});
KISSY.add("dd/draggable-delegate",function(e,l,k,j,f){function d(){d.superclass.constructor.apply(this,arguments)}function c(a){var c,d;if(this._checkMouseDown(a)){c=this.get("handlers");var g=new f(a.target);(c=c.length?this._getHandler(g):g)&&(d=this._getNode(c));d&&(this.__set("activeHandler",c),this.__set("node",d),this.__set("dragNode",d),this._prepare(a))}}var h=l.PREFIX_CLS;e.extend(d,k,{_uiSetDisabledChange:function(a){this.get("container")[a?"addClass":"removeClass"](h+"-disabled")},_init:function(){this.get("container").on("mousedown",
c,this).on("dragstart",this._fixDragStart)},_getHandler:function(a){for(var c=void 0,d=this.get("container"),g=this.get("handlers");a&&a[0]!==d[0];){e.each(g,function(g){if(j.test(a[0],g))return c=a,!1});if(c)break;a=a.parent()}return c},_getNode:function(a){return a.closest(this.get("selector"),this.get("container"))},destroy:function(){this.get("container").detach("mousedown",c,this).detach("dragstart",this._fixDragStart);this.detach()}},{ATTRS:{container:{setter:function(a){return f.one(a)}},selector:{},
handlers:{value:[],getter:0}}});return d},{requires:["./ddm","./draggable","dom","node"]});
KISSY.add("dd/draggable",function(e,l,k,j,f){function d(){var b=this;d.superclass.constructor.apply(b,arguments);b.addTarget(f);e.each("dragalign,drag,dragdrophit,dragend,dragdropmiss,dragexit,dragenter,dragover,dragstart".split(","),function(a){b.publish(a,{bubbles:1})});b.__set("dragNode",b.get("node"));b.on("afterDisabledChange",b._uiSetDisabledChange,b);var a;(a=b.get("disabled"))&&b._uiSetDisabledChange(a);b._init()}function c(){return!1}function h(b){var a=b.target;this._checkMouseDown(b)&&
this._check(a)&&this._prepare(b)}var a=e.each,o=l.ie,m=f.PREFIX_CLS,g=e.Env.host.document;d.POINT="point";d.INTERSECT="intersect";d.STRICT="strict";d.ATTRS={node:{setter:function(b){if(!(b instanceof k))return k.one(b)}},clickPixelThresh:{valueFn:function(){return f.get("clickPixelThresh")}},bufferTime:{valueFn:function(){return f.get("bufferTime")}},dragNode:{},shim:{value:!0},handlers:{value:[],getter:function(b){var c=this;b.length||(b[0]=c.get("node"));a(b,function(a,g){e.isFunction(a)&&(a=a.call(c));
if(e.isString(a)||a.nodeType)a=k.one(a);b[g]=a});c.__set("handlers",b);return b}},activeHandler:{},dragging:{value:!1,setter:function(b){this.get("dragNode")[b?"addClass":"removeClass"](m+"dragging")}},mode:{value:"point"},disabled:{value:!1},move:{value:!1},primaryButtonOnly:{value:!0},halt:{value:!0},groups:{value:{}}};var i;e.extend(d,j,{startMousePos:null,startNodePos:null,_diff:null,_bufferTimer:null,_uiSetDisabledChange:function(b){this.get("dragNode")[b?"addClass":"removeClass"](m+"-disabled")},
_init:function(){this.get("node").on("mousedown",h,this).on("dragstart",this._fixDragStart)},_fixDragStart:function(b){b.preventDefault()},_check:function(b){var c=this,g=c.get("handlers"),d=0;a(g,function(a){if(a.contains(b)||a[0]==b)return d=1,c.__set("activeHandler",a),!1});return d},_checkMouseDown:function(b){return this.get("primaryButtonOnly")&&1<b.button||this.get("disabled")?0:1},_prepare:function(b){var a=this;o&&(i=g.body.onselectstart,g.body.onselectstart=c);a.get("halt")?b.halt():b.preventDefault();
var d=a.get("node"),h=b.pageX,b=b.pageY,d=d.offset();a.startMousePos=a.mousePos={left:h,top:b};a.startNodePos=d;a._diff={left:h-d.left,top:b-d.top};f._regToDrag(a);if(h=a.get("bufferTime"))a._bufferTimer=setTimeout(function(){a._start()},h)},_clearBufferTimer:function(){this._bufferTimer&&(clearTimeout(this._bufferTimer),this._bufferTimer=0)},_move:function(b){var a,c=this._diff;a=this.startMousePos;var g=b.pageX,b=b.pageY,d=g-c.left,c=b-c.top;this.get("dragging")?(this.mousePos={left:g,top:b},a=
{left:d,top:c,pageX:g,pageY:b,drag:this},this.fire("dragalign",{info:a}),g=1,!1===this.fire("drag",a)&&(g=0),g&&this.get("move")&&this.get("node").offset(a)):(c=this.get("clickPixelThresh"),(Math.abs(g-a.left)>=c||Math.abs(b-a.top)>=c)&&this._start())},stopDrag:function(){this.get("dragging")&&f._end()},_end:function(){var b;this._clearBufferTimer();o&&(g.body.onselectstart=i);this.get("dragging")&&(this.get("node").removeClass(m+"drag-over"),(b=f.get("activeDrop"))?this.fire("dragdrophit",{drag:this,
drop:b}):this.fire("dragdropmiss",{drag:this}),this.__set("dragging",0),this.fire("dragend",{drag:this}))},_handleOut:function(){this.get("node").removeClass(m+"drag-over");this.fire("dragexit",{drag:this,drop:f.get("activeDrop")})},_handleEnter:function(b){this.get("node").addClass(m+"drag-over");this.fire("dragenter",b)},_handleOver:function(b){this.fire("dragover",b)},_start:function(){this._clearBufferTimer();this.__set("dragging",1);f._start();this.fire("dragstart",{drag:this})},destroy:function(){this.get("dragNode").detach("mousedown",
h,this).detach("dragstart",this._fixDragStart);this.detach()}});return d},{requires:["ua","node","base","./ddm"]});
KISSY.add("dd/droppable-delegate",function(e,l,k,j,f){function d(){var c=this.get("container"),a=[],d=this.get("selector");c.all(d).each(function(c){l.cacheWH(c);a.push(c)});this.__allNodes=a}function c(){c.superclass.constructor.apply(this,arguments);l.on("dragstart",d,this)}e.extend(c,k,{destroy:function(){c.superclass.destroy.apply(this,arguments)},getNodeFromTarget:function(c,a,d){var f={left:c.pageX,top:c.pageY},c=this.__allNodes,g=0,i=Number.MAX_VALUE;c&&e.each(c,function(b){var c=b[0];c===
d||c===a||(c=l.region(b),l.inRegion(c,f)&&(c=l.area(c),c<i&&(i=c,g=b)))});g&&(this.__set("lastNode",this.get("node")),this.__set("node",g));return g},_handleOut:function(){c.superclass._handleOut.apply(this,arguments);this.__set("node",0);this.__set("lastNode",0)},_handleOver:function(d){var a=this.get("node"),e=c.superclass._handleOut,f=c.superclass._handleOver,g=c.superclass._handleEnter,i=this.get("lastNode");i[0]!==a[0]?(this.__set("node",i),e.apply(this,arguments),this.__set("node",a),g.call(this,
d)):f.call(this,d)},_end:function(){c.superclass._end.apply(this,arguments);this.__set("node",0)}},{ATTRS:{lastNode:{},selector:{},container:{setter:function(c){return f.one(c)}}}});return c},{requires:["./ddm","./droppable","dom","node"]});
KISSY.add("dd/droppable",function(e,l,k,j){function f(){var c=this;f.superclass.constructor.apply(c,arguments);c.addTarget(j);e.each(["dropexit","dropenter","dropover","drophit"],function(d){c.publish(d,{bubbles:1})});c._init()}var d=j.PREFIX_CLS;f.ATTRS={node:{setter:function(c){if(c)return l.one(c)}},groups:{value:!0}};e.extend(f,k,{getNodeFromTarget:function(c,d,a){var c=this.get("node"),e=c[0];return e==d||e==a?null:c},_init:function(){j._regDrop(this)},_active:function(){var c=j.get("activeDrag"),
e=this.get("node"),a=this.get("groups"),c=c.get("groups");a:if(!0===a)a=1;else{for(var f in a)if(c[f]){a=1;break a}a=0}a?(j._addValidDrop(this),e&&(e.addClass(d+"drop-active-valid"),j.cacheWH(e))):e&&e.addClass(d+"drop-active-invalid")},_deActive:function(){var c=this.get("node");c&&c.removeClass(d+"drop-active-valid").removeClass(d+"drop-active-invalid")},__getCustomEvt:function(c){return e.mix({drag:j.get("activeDrag"),drop:this},c)},_handleOut:function(){var c=this.__getCustomEvt();this.get("node").removeClass(d+
"drop-over");this.fire("dropexit",c)},_handleEnter:function(c){c=this.__getCustomEvt(c);c.drag._handleEnter(c);this.get("node").addClass(d+"drop-over");this.fire("dropenter",c)},_handleOver:function(c){c=this.__getCustomEvt(c);c.drag._handleOver(c);this.fire("dropover",c)},_end:function(){var c=this.__getCustomEvt();this.get("node").removeClass(d+"drop-over");this.fire("drophit",c)},destroy:function(){j._unRegDrop(this)}});return f},{requires:["node","base","./ddm"]});
KISSY.add("dd/proxy",function(e,l,k,j){function f(){f.superclass.constructor.apply(this,arguments);this[d]={}}var d="__proxy_destructors",c=e.stamp,h=e.guid("__dd_proxy");f.ATTRS={node:{value:function(a){return new l(a.get("node").clone(!0))}},destroyOnEnd:{value:!1},moveOnEnd:{value:!0},proxyNode:{}};e.extend(f,k,{attachDrag:function(a){function f(){var b=g.get("node"),c=a.get("node");g.get("proxyNode")?b=g.get("proxyNode"):e.isFunction(b)&&(b=b(a),b.addClass("ks-dd-proxy"),b.css("position","absolute"),
g.set("proxyNode",b));b.show();c.parent().append(b);j.cacheWH(b);b.offset(c.offset());a.__set("dragNode",c);a.__set("node",b)}function k(){var b=g.get("proxyNode");g.get("moveOnEnd")&&a.get("dragNode").offset(b.offset());g.get("destroyOnEnd")?(b.remove(),g.set("proxyNode",0)):b.hide();a.__set("node",a.get("dragNode"))}var g=this,i=c(a,1,h);if(!i||!g[d][i])a.on("dragstart",f),a.on("dragend",k),i=c(a,0,h),g[d][i]={drag:a,fn:function(){a.detach("dragstart",f);a.detach("dragend",k)}}},detachDrag:function(a){var a=
c(a,1,h),e=this[d];a&&e[a]&&(e[a].fn(),delete e[a])},destroy:function(){var a=this.get("node"),c=this[d];a&&!e.isFunction(a)&&a.remove();for(var f in c)this.detachDrag(c[f].drag)}});k=f.prototype;k.attach=k.attachDrag;k.unAttach=k.detachDrag;return f},{requires:["node","base","./ddm"]});
KISSY.add("dd/scroll",function(e,l,k,j,f){function d(){d.superclass.constructor.apply(this,arguments);this[o]={}}var c=e.Env.host,h=e.stamp,a=100,o="__dd_scrolls";d.ATTRS={node:{valueFn:function(){return j.one(c)},setter:function(a){return j.one(a)}},rate:{value:[10,10]},diff:{value:[20,20]}};var m=e.isWindow;e.extend(d,k,{getRegion:function(a){return m(a[0])?{width:f.viewportWidth(),height:f.viewportHeight()}:{width:a.outerWidth(),height:a.outerHeight()}},getOffset:function(a){return m(a[0])?{left:f.scrollLeft(),
top:f.scrollTop()}:a.offset()},getScroll:function(a){return{left:a.scrollLeft(),top:a.scrollTop()}},setScroll:function(a,c){a.scrollLeft(c.left);a.scrollTop(c.top)},detachDrag:function(a){var c,b=this[o];if((c=h(a,1,"__dd-scroll-id-"))&&b[c])b[c].fn(),delete b[c]},destroy:function(){var a=this[o],c;for(c in a)this.detachDrag(a[c].drag)},attachDrag:function(c){function d(){if(m(q[0]))return 0;var a=c.mousePos,b=l.region(q);return!l.inRegion(b,a)?(clearTimeout(n),n=0,1):0}function b(a){!a.fake&&!d()&&
(s=a,p=e.clone(c.mousePos),a=j.getOffset(q),p.left-=a.left,p.top-=a.top,n||k())}function f(){clearTimeout(n);n=null}function k(){if(!d()){var b=j.getRegion(q),f=b.width,b=b.height,h=j.getScroll(q),l=e.clone(h),o=!1;p.top-b>=-v[1]&&(h.top+=t[1],o=!0);p.top<=v[1]&&(h.top-=t[1],o=!0);p.left-f>=-v[0]&&(h.left+=t[0],o=!0);p.left<=v[0]&&(h.left-=t[0],o=!0);o?(j.setScroll(q,h),n=setTimeout(k,a),s.fake=!0,m(q[0])&&(h=j.getScroll(q),s.left+=h.left-l.left,s.top+=h.top-l.top),c.get("move")&&c.get("node").offset(s),
c.fire("drag",s)):n=null}}var j=this,q=j.get("node"),r=h(c,0,"__dd-scroll-id-"),u=j[o];if(!u[r]){var t=j.get("rate"),v=j.get("diff"),s,p,n=null;c.on("drag",b);c.on("dragstart",function(){l.cacheWH(q)});c.on("dragend",f);u[r]={drag:c,fn:function(){c.detach("drag",b);c.detach("dragend",f)}}}}});k=d.prototype;k.attach=k.attachDrag;k.unAttach=k.detachDrag;return d},{requires:["./ddm","base","node","dom"]});