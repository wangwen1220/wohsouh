Array.prototype.indexOf||(Array.prototype.indexOf=function(h,l){l||(l=0);var p=this.length;if(l<0)l=p+l;for(;l<p;l++)if(this[l]===h)return l;return-1});
(function(h){function l(a,b){var c;if(o){c=o[0];var d=o.data("timer");o.stop();d&&(clearTimeout(d),clearInterval(d))}else{c=document.createElement("div");o=h(c).appendTo(document.body)}c.className=a;c.style.cssText="position:fixed;visibility:hidden;z-index:10000;";o.html(b);return o}function p(a){var b=[].slice.call(arguments,1),c=0;a=h.event.fix(a||window.event);a.type="mousewheel";if(a.wheelDelta)c=a.wheelDelta/120;if(a.detail)c=-a.detail/3;b.unshift(a,c);return h.event.handle.apply(this,b)}var t=
navigator.userAgent.toLowerCase(),q=parseInt((/.+msie[\/: ]([\d.]+)/.exec(t)||{1:0})[1]),v=q&&!/opera/.test(t),r=v&&q>7?document.documentMode:0;t=v&&(q<7||r==5);q=v&&(q==7||r==7);r=r==8;var w=h(),x=1,m=null,o=null,z=/^http[s]?\:\/\//i,A={uploader:"uploadify/uploadify.swf",method:"POST",queueID:"fileQueue%%%",width:100,height:22,auto:true,multi:1,wmode:"transparent",hideButton:true},s=function(){this.bubble=h('\t\t<div class="bubble">\t\t\t<div class="corner tl"></div>\t\t\t<div class="corner tr"></div>\t\t\t<div class="corner bl"></div>\t\t\t<div class="corner br"></div>\t\t\t<div class="top"></div>\t\t\t<div class="cnt"></div>\t\t\t<div class="bot"></div>\t\t\t<div class="point"></div>\t\t</div>\t').appendTo(document.body);
this.pointer=this.bubble.find(".point");this.cnt=this.bubble.find(".cnt")};s.prototype={pointTo:function(a){var b,c;if(a.nodeType==1?a=h(a):a.jquery){var d=a.offset();b=d.left+parseInt(a[0].offsetWidth/2);c=d.top+parseInt(a[0].offsetHeight/2)}else if(a.originalEvent){b=a.pageX;c=a.pageY}else return;d=k.innerWidth();var e=k.innerHeight(),g=w.scrollLeft(),i=w.scrollTop();a=this.bubble;var f=a[0],j,n;f.style.cssText="";j=f.offsetWidth;n=f.offsetHeight;if(!j||!n){f.style.display="block";j=f.offsetWidth;
n=f.offsetHeight}f.style.width=j+"px";if(e/2>c-i){e=c+parseInt(this.pointer.height())+13;c="S"}else{e=c-n-parseInt(this.pointer.height())-2;c="N"}if(d/2>b-g){b=b-13;c+="W"}else{b=b-j+10;c+="E"}this.pointer[0].className="point "+c;a.css({left:b,top:e});return this},setYellow:function(a){this.bubble[a?"addClass":"removeClass"]("yellow");return this},html:function(a){this.cnt.html(a);return this},get:function(){return this.bubble}};var k={IE6:t,IE7:q,IE8:r,substr:function(a,b){for(var c=0,d=0;d<a.length;d++){c+=
a.charCodeAt(d)>255?2:1;if(c>b)break}if(c<=b)return a;for(b-=3;d--;){c-=a.charCodeAt(d)>255?2:1;if(c<=b)break}return a.substr(0,d+1)+"..."},pos:function(a,b,c){a||(a="right");var d=h(document),e=d.scrollLeft(),g=d.scrollTop();d=k.innerHeight();var i=k.innerWidth(),f={},j;if(a=="top"){f.top=2;f.left=(i-b)/2}else if(a=="right"){f.top=2;f.right=2}else if(a=="center"){f.top=(d-c)*0.382;f.left=(i-b)/2}else if(a.nodeType==1?a=h(a):a.jquery){j=a.offset();j.left-=e;j.top-=g;f.left=j.left+b>i?j.left-b+a.outerWidth():
j.left;b=a.outerHeight();f.top=j.top+c+b>d?j.top-c:j.top+a.outerHeight()}else if(a.originalEvent){j={left:a.pageX-e,top:a.pageY-g};f.left=j.left+b>i?j.left-b:j.left;f.top=j.top+c>d?j.top-c:j.top}return f},pageWidth:function(){return h.boxModel?Math.max(document.documentElement.scrollWidth,document.documentElement.clientWidth,document.documentElement.offsetWidth):Math.max(document.body.scrollWidth,document.body.offsetWidth)},pageHeight:function(){return h.boxModel?Math.max(document.documentElement.scrollHeight,
document.documentElement.clientHeight,document.documentElement.offsetHeight):Math.max(document.body.scrollHeight,document.body.offsetHeight)},innerWidth:function(){return document.compatMode=="CSS1Compat"?document.documentElement.clientWidth:document.body.clientWidth},innerHeight:function(){return document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight},func:function(a,b){if(typeof a=="function")return a;if(typeof a=="string"){a=a.split(".");var c=(b||window)[a[0]],
d=null;if(!c)return null;for(var e=1,g;g=a[e++];){if(!c[g])return null;d=c;c=c[g]}return c&&function(){return c.apply(d,arguments)}}return null},listenAjax:function(){h().ajaxStart(function(){x&&k.startLoading();x=1}).ajaxStop(function(){k.endLoading()}).ajaxError(function(){k.endLoading()})},stopListenOnce:function(){x=0},startLoading:function(a,b,c){if(m)return m;b||(b="\u8f7d\u5165\u4e2d\u2026\u2026");m=h('<div class="loading" style="position:fixed;visibility:hidden"><sub></sub> '+b+"</div>").appendTo(document.body);
if(!isNaN(c=parseFloat(c))&&c)m.css("width",c);a=k.pos(a,m.outerWidth(true),m.outerHeight(true));a.visibility="visible";m.css(a);return m},endLoading:function(){m&&m.remove();m=null},uploadBox:function(a){var b=h('\t<div class="uploadBox">\t\t<div class="percent"></div>\t\t<div class="bar">\t\t\t<div class="proccess"></div>\t\t</div>\t\t<div class="status"></div>\t</div>'),c=b.find("div"),d=c.filter(".percent"),e=c.filter(".proccess"),g=c.filter(".status"),i=0,f=0;b.dialog({autoOpen:false,width:a.width||
350,height:a.height||150,modal:true,resizable:false,title:a.title||"\u6587\u4ef6\u4e0a\u4f20",buttons:{"\u7ec8\u6b62":function(){b.dialog("close")}},beforeclose:function(){if(i)return true;window.confirm("\u672a\u5904\u7406\u6240\u6709\u4e0a\u4f20\uff0c\u786e\u5b9a\u8981\u7ec8\u6b62\u5417\uff1f")&&typeof a.destroy=="function"&&a.destroy()},close:function(){i=f=0;a.onclose&&a.onclose()}});this.update=function(j,n){this.setPercentage(j);this.setStatus(n)};this.setStatus=function(j){g.html(j)};this.setPercentage=
function(j){j+="%";d.html(j);e.width(j)};this.complete=function(j,n){i=1;f=0;this.setPercentage(100);j&&this.setStatus(j);var y=setTimeout(function(){b.dialog("isOpen")&&b.dialog("close")},n||3E3);b.dialog("option","buttons",{"\u5173\u95ed":function(){y&&clearTimeout(y);b.dialog("close")}})};this.start=function(){if(!f){f=1;i=0;b.dialog("option","buttons",{"\u7ec8\u6b62":function(){b.dialog("close")}}).dialog("open");this.setPercentage(0);this.setStatus("")}}},floatBox:function(a,b,c){h("div.floatbox").remove();
var d=h('<div class="floatbox" style="position:fixed;visibility:hidden"></div>').appendTo(document.body),e=h('<img src="images/close.gif" />').css({position:"absolute",top:1,right:2,cursor:"pointer"}).click(function(){d.remove()});d.html(e).append(a);typeof c=="function"&&c(d);h(document);a=k.pos(b,d.outerWidth(true),d.outerHeight(true));a.visibility="visible";d.css(a);return d},alert:function(a,b){return this.tips(a,b,"center",0)},tips:function(a,b,c,d){(!b||b=="ok")&&(b="success");var e=l("ct_tips "+
b,"<sub></sub> "+a),g;h('<a style="margin-left:10px;color:#000080;text-decoration:underline;" href="close">\u77e5\u9053\u4e86</a>').click(function(i){i.stopPropagation();i.preventDefault();e.fadeOut("fast");g&&clearTimeout(g);g=null}).appendTo(e);c||(c="center");a=k.pos(c,e.outerWidth(true),e.outerHeight(true));a.visibility="visible";e.css(a);d===undefined&&(d=1);d&&(g=setTimeout(function(){e.fadeOut("fast")},d*1E3),e.data("timer",g));return e},timer:function(a,b,c,d,e){c||(c="success");a=a.replace("%s",
'<b class="timer">'+b+"</b>");var g=l("ct_tips "+c,"<sub></sub> "+a),i=g.find("b.timer");a=g.find(".clause");e||(e="center");e=k.pos(e,g.outerWidth(true),g.outerHeight(true));e.visibility="visible";g.css(e);var f=setInterval(function(){i.text(--b);b<1&&j()},1E3);g.data("timer",f);var j=function(){f&&clearInterval(f);f=null;g.hide();d();return false};a.click(j);return g},ok:function(a,b,c){return this.tips(a,"success",b,c)},error:function(a,b,c){return this.tips(a,"error",b,c)},warn:function(a,b,c){return this.tips(a,
"warning",b,c)},msg:function(a){return this.alert(a,"warning")},confirm:function(a,b,c,d){var e=l("ct_tips confirm","<sub></sub> "+a+"<br/>");h('<button type="button" class="button_style_1">\u786e\u5b9a</button>').click(function(){b&&b(e);e.hide()}).appendTo(e);cancelBtn=h('<button type="button" class="button_style_1">\u53d6\u6d88</button>').click(function(){c&&c();e.hide()}).appendTo(e);d||(d="center");a=k.pos(d,e.outerWidth(true),e.outerHeight(true));a.visibility="visible";e.css(a);return e},getCookie:function(a){var b=
null;if(document.cookie&&document.cookie!="")for(var c=document.cookie.split(";"),d=0;d<c.length;d++){var e=jQuery.trim(c[d]);if(e.substring(0,a.length+1)==a+"="){b=decodeURIComponent(e.substring(a.length+1));break}}return b},setCookie:function(a,b,c){c=c||{};if(b===null){b="";c=h.extend({},c);c.expires=-1}if(!c.expires)c.expires=1;var d="";if(c.expires&&(typeof c.expires=="number"||c.expires.toUTCString)){if(typeof c.expires=="number"){d=new Date;d.setTime(d.getTime()+c.expires*24*60*60*1E3)}else d=
c.expires;d="; expires="+d.toUTCString()}var e=c.path?"; path="+c.path:"",g=c.domain?"; domain="+c.domain:"";c=c.secure?"; secure":"";document.cookie=[a,"=",encodeURIComponent(b),d,e,g,c].join("")},pieHtml:function(a,b,c,d){a="images/pie.swf?piedata="+encodeURIComponent(a);d='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="'+b+'" height="'+c+'" title="'+d+'">';d+='<param name="movie" value="'+
a+'" />';d+='<param name="quality" value="high" />';d+='<param name="wmode" value="transparent" />';d+='<embed src="'+a+'" quality="high" wmode="transparent" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="'+b+'" height="'+c+'"></embed>';d+="</object>";return d}};k.assoc={refresh:function(){top!=self&&top.superAssoc.refresh()},open:function(a,b,c){top!=self&&top.superAssoc.open(a,b,c)},get:function(a){return top!=
self?top.superAssoc.get(a):null},close:function(a){top!=self&&top.superAssoc.close(a)},opener:function(){return top!=self?__ASSOC_TABID__&&top.superAssoc.get(__ASSOC_TABID__):null},call:function(a){if(top!=self){var b=Array.prototype.slice.call(arguments,1);return top.superAssoc[a].apply(null,b)}}};window.ct=window.cmstop=k;h.fn.extend({ajaxSubmit:function(a){if(!this.length)return this;if(typeof a=="function")a={success:a};var b=h.trim(this.attr("action"));if(b)b=(/^([^#]+)/.exec(b)||{})[1];b=b||
window.location.href||"";a=h.extend({url:b,type:this.attr("method")||"GET"},a||{});if(a.beforeSerialize&&a.beforeSerialize(this,a)===false)return this;b=this.serializeArray();if(a.data){a.extraData=a.data;for(var c in a.data)if(a.data[c]instanceof Array)for(var d in a.data[c])b.push({name:c,value:a.data[c][d]});else b.push({name:c,value:a.data[c]})}if(a.beforeSubmit&&a.beforeSubmit(b,this,a)===false)return this;a.data=b;h.ajax(a);this.trigger("form-submit-notify",[this,a]);return this},ajaxForm:function(a,
b,c){var d=this,e=this.attr("action"),g=this.attr("method")||"POST";a=k.func(a)||function(f){f.state?k.ok("\u4fdd\u5b58\u6210\u529f"):k.error(f.error)};c=k.func(c)||function(){};var i=function(){if(!d.data("lock"))if(c(d)!==false){var f=d.find("*").filter(":button,:submit,:reset").attr("disabled","disabled");d.data("lock",true);h.ajax({dataType:"json",url:e,type:g,data:d.serialize(),success:a,complete:function(){d.data("lock",false);f.attr("disabled","").removeAttr("disabled")},error:function(){k.error("\u8bf7\u6c42\u5f02\u5e38")}})}};
h().bind("keydown.ajaxForm",function(f){if(f.ctrlKey&&(f.keyCode==13||f.keyCode==83)){f.stopPropagation();f.preventDefault();d.submit()}});this.attr("name")?this.validate({submitHandler:i,infoHandler:b}):this.submit(function(f){f.stopPropagation();f.preventDefault();i()});return this},doc:function(){return this.map(function(a,b){return jQuery.nodeName(b,"iframe")?b.contentDocument||b.contentWindow.document:b.ownerDocument?b.ownerDocument:h.nodeName(b,"#document")?b:"scrollTo"in b&&b.document?b.document:
null})},win:function(){return this.map(function(a,b){return jQuery.nodeName(b,"iframe")?b.contentWindow:b.ownerDocument?b.ownerDocument.defaultView||b.ownerDocument.parentWindow:h.nodeName(b,"#document")?b.defaultView||b.parentWindow:"scrollTo"in b&&b.document?b:null})},floatImg:function(a){var b=h.extend({url:"",width:null,height:null},a||{}),c=h(document.createElement("div"));h.extend(c[0].style,{position:"absolute",overflow:"hidden",display:"none",padding:"4px",background:"#ccc",border:"1px solid #fff",
width:b.width,height:b.height,zIndex:8888});h(document.body).append(c);this.bind("mouseover",function(d){var e=this.value||this.getAttribute("thumb");if(e){var g=d.pageX+10;d=d.pageY+10;e=z.test(e)?e:b.url+e;e=e.replace(/\?[0-9\.]*$/,"")+"?"+Math.random(9);e=['<img src="'+e+'"'];b.width&&e.push(' width="'+b.width+'"');b.height&&e.push(' height="'+b.height+'"');e.push(" />");c.html(e.join("")).css({top:d,left:g,display:"block"})}}).bind("mousemove",function(d){c.css({top:d.pageY+10,left:d.pageX+10})}).bind("mouseout",
function(){c.hide()});return this},attrTips:function(a,b){var c,d,e=function(){var i=d.data("delay");i&&clearTimeout(i);d.data("delay",null);d.stop(1).css({opacity:"",display:"none"})};if(s.inst)c=s.inst;else{c=new s;s.inst=c}d=c.get();var g=null;this.bind("mouseover",function(i){g=i;var f=this,j=this.getAttribute(a);(i=d.data("delay"))&&clearTimeout(i);if(j){i=setTimeout(function(){d.data("point",f);c.setYellow(b!="tips_green");c.html(j);c.pointTo(g);d.fadeIn("normal")},200);d.data("delay",i)}}).bind("mouseout",
e).bind("mousemove",function(i){g=i;d.data("point")==this&&c.pointTo(i)});w.bind("mousedown.bubble",e)},getTags:function(a,b){var c=this;h(a).click(function(){h.post("?app=system&controller=tag&action=get_tags",c.serialize(),function(d){d.state&&h(b).val(d.data)},"json")})},uploader:function(a){return this.each(function(){var b=h(this),c=h.extend({},A,{width:this.offsetWidth,height:this.offsetHeight,script:b.attr("script"),multi:b.attr("multi"),fileDesc:b.attr("fileDesc"),fileExt:b.attr("fileExt"),
sizeLimit:b.attr("sizeLimit"),fileDataName:b.attr("fileDataName"),onSelect:function(e,g,i){b.triggerHandler("select.uploadify",[g,i]);return false},onProgress:function(e,g,i,f){b.triggerHandler("progress.uploadify",[g,i,f]);return false},onComplete:function(e,g,i,f,j){b.triggerHandler("complete.uploadify",[g,i,f,j]);return false},onAllComplete:function(e,g){b.triggerHandler("allcomplete.uploadify",[g]);return false},onError:function(e,g,i,f){b.triggerHandler("error.uploadify",[g,i,f]);return false}},
a||{}),d=h(document.createElement("div")).appendTo(this);c.script=encodeURIComponent(c.script);d[0].id="uploadify-"+parseInt(Math.random()*100);d.uploadify(c);h("#"+d[0].id+"Uploader").appendTo(d);b.css("position","relative");d[0].style.cssText="position:absolute;display:block;z-index:1;top:0;left:0;width:"+c.width+"px;height:"+c.height+"px;overflow:hidden"})},imgUploader:function(a,b,c){var d=k.getCookie(COOKIE_PRE+"auth");this.uploadify({uploader:"uploadify/uploadify.swf",script:encodeURIComponent((b||
"?app=system&controller=upload&action=thumb")+"&auth="+d),method:"POST",fileDesc:"\u6ce8\u610f:\u60a8\u53ea\u80fd\u4e0a\u4f20gif\u3001jpeg\u3001jpg\u3001png\u683c\u5f0f\u7684\u6587\u4ef6!",fileExt:"*.jpg;*.jpeg;*.gif;*.png;",cancelImg:"images/cancel.png",queueID:"fileQueue",buttonImg:c||"images/upst.gif",width:"80",height:"22",auto:true,multi:false,onComplete:function(e,g,i,f){if(f!=0)a&&a(f);else k.tips("\u5bf9\u4e0d\u8d77\uff01\u60a8\u4e0a\u4f20\u6587\u4ef6\u8fc7\u5927\u800c\u5931\u8d25!","error")},
onError:function(e,g,i,f){k.tips(f.type,"error")}});return this},insertSection:function(a,b,c,d){var e=this[0];e.focus();var g=document.selection;if(c==undefined)c=0;if(g&&g.createRange){b||(b=g.createRange());b.text=a;a=a.replace(/\r\n/g,"\n").length;b.moveStart("character",c-a);d!=undefined&&b.moveEnd("character",d-(a-c));b.select()}else{b=e.scrollTop;g=e.scrollLeft;if(d==undefined)d=a.replace(/\r\n/g,"\n").length-c;if(typeof e.selectionStart!="undefined"){var i=e.selectionStart+0;e.value=e.value.substring(0,
e.selectionStart)+a+e.value.substr(e.selectionEnd);e.selectionStart=i+c}else{e.value+=a;e.focus();e.selectionStart=c}e.selectionEnd=e.selectionStart+d;e.scrollTop=b;e.scrollLeft=g}return this},selection:function(){var a=this[0];a.focus();return a.selectionStart!==undefined?a.value.substring(a.selectionStart,a.selectionEnd):document.selection&&document.selection.createRange?document.selection.createRange().text:window.getSelection?window.getSelection()+"":""},maxLength:function(){this.each(function(){var a=
this.maxLength,b=h('<strong class="c_green" style="margin-left:5px">0</strong>').insertAfter(this);h.event.add(this,"keyup",function(){h.textLength(this,b,a)})}).keyup();return this},mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}});h.textLength=function(a,b,c){if(c){var d=a.value.length;b.html(d);d>c&&b.addClass("c_red")}else b.html(a.value.length);if(a.tagName=="TEXTAREA"&&a.scrollHeight>70)a.style.height=
a.scrollHeight+"px"};var u=["DOMMouseScroll","mousewheel"];h.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=u.length;a;)this.addEventListener(u[--a],p,false);else this.onmousewheel=p},teardown:function(){if(this.removeEventListener)for(var a=u.length;a;)this.removeEventListener(u[--a],p,false);else this.onmousewheel=null}};window.template_select=function(a){var b=h("#"+a).val(),c=ct.iframe("?app=system&controller=template&action=selector&path="+b,600,420,function(d){var e=
d.doc()[0];d=d.css("overflow","hidden").innerHeight()-(e.getElementById("nav_area").offsetHeight+e.getElementById("btn_area").offsetHeight);h(e.getElementById("selector_area")).height(d)},{ok:function(d){h("#"+a).val(d);c.dialog("close")}})};window.url={member:function(a){parent.superAssoc.open("?app=member&controller=index&action=profile&userid="+a,"newtab")},ip:function(a){parent.superAssoc.open("?app=system&controller=ip&action=show&ip="+a,"newtab")}};h.ajaxSetup({beforeSend:function(a){a.setRequestHeader("If-Modified-Since",
"0");a.setRequestHeader("Cache-Control","no-cache")}})})(jQuery);
