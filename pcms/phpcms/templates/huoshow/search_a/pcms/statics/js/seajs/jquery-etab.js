define('jquery-etab', ['jquery'], function(require) {
/* =================================================
// 说明: 一个简洁高效的 Tab 切换插件
// jQuery Etab Plugins 1.3
// author : chenmnkken@gmail.com
// Url: http://stylechen.com/jquery-tabs.html
// Data : 2012-09-06
// Update : Steven wangwen1220@139.com 2012-11-18
// =================================================*/
return function(a){a.fn.etab=function(b){return this.each(function(){b=a.extend({event:"mouseover",timeout:0,auto:0,fadeIn:false,speed:"normal",callback:null,switch_btn:false},b);var i=a(this),k=i.find(".ui-tab-cnt-item"),m=i.find(".ui-tab-nav"),h=m.find(".ui-tab-nav-item"),d;var g=function(o){var n=o.index();o.siblings().removeClass("ui-tab-nav-item-cur").end().addClass("ui-tab-nav-item-cur");if(b.fadeIn){k.siblings().hide().removeClass("ui-tab-cnt-item-cur");k.eq(n).fadeIn(b.speed,function(){a(this).addClass("ui-tab-cnt-item-cur")})}else{k.siblings().removeClass("ui-tab-cnt-item-cur").end().eq(n).addClass("ui-tab-cnt-item-cur")}},f=function(n,o){o?setTimeout(function(){g(n)},o):g(n)},e=function(){if(!b.auto){return}d=setInterval(j,b.auto)},j=function(o){var u=m.find(".ui-tab-nav-item-cur"),t=h.first(),q=h.last(),n=h.length,r=u.index(),p,s;if(o){r--;p=r===-1?q:u.prev()}else{r++;p=r===n?t:u.next()}s=r===n?0:r;u.removeClass("ui-tab-nav-item-cur");p.addClass("ui-tab-nav-item-cur");k.siblings().removeClass("ui-tab-cnt-item-cur").end().eq(s).addClass("ui-tab-cnt-item-cur");if(b.callback){b.callback.call(i)}};h.bind(b.event,function(){f(a(this),b.timeout);if(b.callback){b.callback.call(i)}});if(b.auto){e();i.hover(function(){clearInterval(d);d=undefined},function(){e()})}if(b.switch_btn){i.append('<a href="#prev" class="ui-tab-prev">Prev</a><a href="#next" class="ui-tab-next">Next</a>');var l=a(".ui-tab-prev",i),c=a(".ui-tab-next",i);l.click(function(n){j(true);n.preventDefault()});c.click(function(n){j();n.preventDefault()})}})}};
});