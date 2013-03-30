/*
Copyright 2012, KISSY UI Library v1.40dev
MIT Licensed
build time: Jul 30 19:04
*/
KISSY.add("waterfall/base",function(f,p,q){function d(){d.superclass.constructor.apply(this,arguments);this._init()}function r(a,c,b,e){var l={},g,i;l.stop=function(){g&&(clearTimeout(g),i=[],a.each(function(a){a.stop()}))};l.start=function(){i=[].concat(f.makeArray(a));0<i.length?function(){var l=+new Date;do{var k=i.shift();c.call(b,k)}while(0<i.length&&50>+new Date-l);0<i.length?g=setTimeout(arguments.callee,25):e&&e.call(b,a)}():e&&e.call(b,a)};return l}function s(){var a=this._containerRegion||
{};a&&this.get("container").width()===a.width||this.adjust()}function o(){var a=this.get("container").width(),c=this.get("curColHeights");c.length=Math.max(parseInt(a/this.get("colWidth")),this.get("minColCount"));this._containerRegion={width:a};f.each(c,function(a,e){c[e]=0});this.set("colItems",[])}function n(a,c,b,e){var l=a.get("effect"),b=t(b),g=a.get("align"),i=a.get("curColHeights"),h=a.get("container"),k=i.length,j=0,f=a._containerRegion,d=Number.MAX_VALUE;if(k){if(b.hasClass("ks-waterfall-fixed-left"))j=
0;else if(b.hasClass("ks-waterfall-fixed-right"))j=0<k?k-1:0;else for(var m=0;m<k;m++)i[m]<d&&(d=i[m],j=m);k="left"===g?0:Math.max(f.width-k*a.get("colWidth"),0);"center"===g&&(k/=2);g={left:j*a.get("colWidth")+k,top:i[j]};c?(b.css(g),l&&l.effect&&b.css("visibility","hidden"),h.append(b),e&&e()):(c=a.get("adjustEffect"))?b.animate(g,c.duration,c.easing,e):(b.css(g),e&&e());i[j]+=b.outerHeight(!0);a=a.get("colItems");a[j]=a[j]||[];a[j].push(b);b.attr("data-waterfall-col",j);return b}}function u(a){var a=
n(this,!0,a),c=this.get("effect");c&&c.effect&&(a.hide(),a.css("visibility",""),a[c.effect](c.duration,0,c.easing))}var t=p.all,h=f.Env.host;d.ATTRS={container:{setter:function(a){return t(a)}},curColHeights:{value:[]},align:{value:"center"},minColCount:{value:1},effect:{value:{effect:"fadeIn",duration:1}},colWidth:{},colItems:{value:[]},adjustEffect:{}};f.extend(d,q,{isAdjusting:function(){return!!this._adjuster},isAdding:function(){return!!this._adder},_init:function(){s.call(this);this.__onResize=
f.buffer(s,50,this);t(h).on("resize",this.__onResize)},adjustItem:function(a,c){function b(){m--;0>=m&&(e._adjuster=0,c.callback&&c.callback.call(e))}var e=this,c=c||{};if(!e.isAdjusting()){var l=a.outerHeight(!0),g;c.process&&(g=c.process.call(e));void 0===g&&(g=a.outerHeight(!0));var i=g-l,d=e.get("curColHeights"),k=parseInt(a.attr("data-waterfall-col")),j=e.get("colItems")[k],l=[];g=Math.max.apply(Math,d);for(var h=0;h<j.length&&j[h][0]!==a[0];h++);for(h++;h<j.length;)l.push(j[h]),h++;d[k]+=i;
d=Math.max.apply(Math,d);d!=g&&e.get("container").height(d);var f=c.effect,m=l.length;if(!m)return c.callback&&c.callback.call(e);void 0===f&&(f=e.get("adjustEffect"));e._adjuster=r(l,function(a){f?a.animate({top:parseInt(a.css("top"))+i},f.duration,f.easing,b):(a.css("top",parseInt(a.css("top"))+i),b())});e._adjuster.start();return e._adjuster}},removeItem:function(a,c){var c=c||{},b=this,e=c.callback;b.adjustItem(a,f.mix(c,{process:function(){a.remove();return 0},callback:function(){for(var c=parseInt(a.attr("data-waterfall-col")),
c=b.get("colItems")[c],g=0;g<c.length;g++)if(c[g][0]==a[0]){c.splice(g,1);break}e&&e()}}))},adjust:function(a){function c(){d--;0>=d&&(b.get("container").height(Math.max.apply(Math,b.get("curColHeights"))),b._adjuster=0,a&&a.call(b),b.fire("adjustComplete",{items:e}))}var b=this,e=b.get("container").all(".ks-waterfall");b.isAdjusting()&&(b._adjuster.stop(),b._adjuster=0);o.call(b);var d=e.length;if(!d)return a&&a.call(b);b._adjuster=r(e,function(a){n(b,false,a,c)});b._adjuster.start();return b._adjuster},
addItems:function(a,c){var b=this;b._adder=r(a,u,b,function(){b.get("container").height(Math.max.apply(Math,b.get("curColHeights")));b._adder=0;c&&c.call(b);b.fire("addComplete",{items:a})});b._adder.start();return b._adder},destroy:function(){t(h).detach("resize",this.__onResize)}});return d},{requires:["node","base"]});
KISSY.add("waterfall/loader",function(f,p,q){function d(){d.superclass.constructor.apply(this,arguments)}function r(){if(!this.__loading)if(this.isAdjusting())this.__onScroll();else{var d=this.get("container").offset().top,f=this.get("diff"),h=this.get("curColHeights");h.length&&(d+=Math.min.apply(Math,h));f+o(n).scrollTop()+o(n).height()>d&&s.call(this)}}function s(){function d(a,b){h.__loading=0;h.addItems(a,b)}function f(){h.end()}var h=this;h.get("container");h.__loading=1;var a=h.get("load");
a&&a(d,f)}var o=p.all,n=f.Env.host;d.ATTRS={diff:{value:0}};f.extend(d,q,{_init:function(){d.superclass._init.apply(this,arguments);this.__onScroll=f.buffer(r,50,this);this.__onScroll();this.start()},start:function(){this.__started||(o(n).on("scroll",this.__onScroll),this.__started=1)},end:function(){o(n).detach("scroll",this.__onScroll)},pause:function(){this.end()},resume:function(){this.start()},destroy:function(){d.superclass.destroy.apply(this,arguments);o(n).detach("scroll",this.__onScroll);
this.__started=0}});return d},{requires:["node","./base"]});KISSY.add("waterfall",function(f,p,q){p.Loader=q;return p},{requires:["waterfall/base","waterfall/loader"]});