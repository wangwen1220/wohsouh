(function(g){function z(b,c){function h(a){if(q())if(e){a=e[a?"next":"prev"]("a");if(a.length)k(a);else{o();e=0;c.autoFill||b.val(b.attr("selftext"))}}else if(e==null)e=0;else if(e==0)k(d.find(">a:"+(a?"first":"last")))}function k(a){a.mouseover();var f=0;a.prevAll("a").each(function(){f+=this.offsetHeight});if(f+a[0].offsetHeight-d.scrollTop()>d[0].clientHeight)d.scrollTop(f+a[0].offsetHeight-d.innerHeight());else f<d.scrollTop()&&d.scrollTop(f)}function l(){var a=b.val();c.autoFill&&b.attr("selftext",
a);if(g.trim(a)=="")a="";if(c.cache&&a in r)t(r[a],a);else{var f=typeof c.extraParams=="function"?c.extraParams():c.extraParams;g.ajax({url:c.url.replace("%s",encodeURIComponent(a)),type:"POST",dataType:"json",data:f,success:function(i){c.jsonLoaded(i);t(i,a);if(c.cache)r[a]=i},error:function(){m();d.empty()}})}}function t(a,f){if(!a||!a.length){m();d.empty()}else{o();d.empty().css("height",a.length>10?200:"auto");for(var i=0,j;j=a[i++];)A(j,f);q()}}function q(){if(n||!d.find(">a").length)return n;
n=true;var a=b.offset();d.css({left:a.left,top:a.top+b.outerHeight(true),display:"block"});p(d.css("border-left-width"));parseInt(d.css("padding-left"));d.width(b.outerWidth()-p(d.css("border-left-width"))*2-p(d.css("padding-left"))-p(d.css("padding-right")));u.mousedown(v);return true}function A(a,f){var i=typeof c.itemFormat=="function"?c.itemFormat(a,f):a.text,j=g('<a href="javascript:void(0);">'+i+"</a>").mousedown(function(){w(j)}).mouseover(function(){var x=j;o();e=x;x.addClass(s.active);c.autoFill&&
b.val(a.text)}).data("itemdata",a);c.itemPrepared(j,a);d.append(j)}function w(a){m();if(a){b.val(a.data("itemdata").text);c.itemSelected(a,a.data("itemdata"),b)}}c=g.extend({},y,c||{});b.jquery||(b=g(b));b.attr("autocomplete","off");var r={},u=g(document),d=g('<div class="'+s.autocomplete+'"></div>').css({position:"absolute"}).appendTo(document.body),e=null,n=false,m=function(){o();if(n){n=false;u.unbind("mousedown",v);d.hide()}},v=function(a){b[0]==a.target||d[0]==a.target||d.find(a.target.nodeName).index(a.target)!=
-1||m()},o=function(){e&&e.removeClass(s.active);e=null};b.keyup(function(a){switch(a.keyCode){case 13:w(e);return;case 9:return;case 27:case 37:case 38:case 39:case 40:return false;default:l()}}).keydown(function(a){switch(a.keyCode){case 13:return false;case 9:m();return;case 38:h();return;case 40:h(1);return}});c.showEvent&&b.bind(c.showEvent,function(){this.value==""?l():q()})}var y={url:"?app=sysytem&controller=page&action=page&q=%s",cache:true,showEvent:"dblclick",autoFill:true,extraParams:function(){return""},
itemFormat:function(b,c){return c?b.text.replace(RegExp(c,"ig"),function(h){return"<strong>"+h+"</strong>"}):b.text},itemSelected:function(){},jsonLoaded:function(){},itemPrepared:function(){}},s={active:"active",autocomplete:"autocomplete-box"},p=function(b){b=parseInt(b);return isNaN(b)?0:b};g.fn.autocomplete=function(b){this.each(function(){var c={},h=g(this);for(var k in y){var l=h.attr(k);l&&(c[k]=l)}z(h,g.extend({},b||{},c))});return this}})(jQuery);