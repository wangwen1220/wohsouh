(function(g){function o(c){if(m==c){e.hide();k.unbind(".colorinput");m=null}}function p(c,a,d,f){e||q();setTimeout(function(){k.bind("mousedown.colorinput",function(h){h=h.target;e[0]==h||e.find(h.nodeName).index(h)!=-1||f(h)||o(a)})},0);m=a;e.unbind(".colorinput").bind("click.colorinput",function(h){h.target.nodeName=="LI"&&d(h.target.getAttribute("val"));return false});e.css({visibility:"hidden",display:"block"});c=e[0].offsetHeight;var i=e[0].offsetWidth,l=a[0].offsetHeight,n=a[0].offsetWidth,
b=a.offset(),r=k.scrollLeft(),s=k.scrollTop();e.css({top:b.top+l+c-s>(document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight)?b.top-c:b.top+l,left:b.left+i-r>(document.compatMode=="CSS1Compat"?document.documentElement.clientWidth:document.body.clientWidth)?b.left+n-i:b.left,visibility:"visible"})}function t(c){var a=g(document.createElement("li")),d=[parseInt(c.substr(1,2),16),parseInt(c.substr(3,2),16),parseInt(c.substr(5,2),16)];d[0]-=33;d[1]-=33;d[2]-=
33;var f="rgb("+d.join(", ")+")";a.css({backgroundColor:c,borderColor:f}).attr("val",c).hover(function(){a.css("borderColor","#000")},function(){a.css("borderColor",f)});return a}function q(){var c=["#C7561E","#B5515D","#C244AB","#603F99","#536CA6","#3640AD","#3C995B","#5CA632","#7EC225","#A7B828","#CF9911","#D47F1E","#B56414","#914D14","#BE9494","#9643A5","#4585A3","#737373","#41A587","#D1BC36","#AD2D2D","#D96666","#E67399","#E67399","#8C66D9","#668CB3","#668CD9","#59BFB3","#65AD89","#4CB052","#8CBF40",
"#BFBF4D","#E0C240","#F2A640","#E6804D","#BE9494","#A992A9","#8997A5","#94A2BE","#85AAA5","#A7A77D","#C4A883"];e=g('<ul class="'+j.pane+'"></ul>');for(var a=0,d;d=c[a++];)e.append(t(d));e.append('<li style="clear:both;display:block;border:none;height:0;font-size:0;clear:both;visibility:hidden;"></li>');e.appendTo(document.body)}var e=null,k=g(),j={active:"active",pane:"color-pannel",box:"input-box",input:"color-input",picker:"color-picker"},u={selectColor:"\u9009\u62e9\u989c\u8272...."},m=null,v=
function(c){var a=g(c).addClass(j.input),d=g('<label class="'+j.box+'"></label>'),f=g('<span class="'+j.picker+'" title="'+u.selectColor+'"></span>'),i=a.val()||"";eval("var _oninited = (function(color){"+(a.attr("oninited")||"")+"})");eval("var _onpicked = (function(color){"+(a.attr("onpicked")||"")+"})");f.css("backgroundColor",i);a.css("color",i);_oninited.apply(a,[i]);var l=function(b){f.css("backgroundColor",b||"");a.css("color",b||"");a.val(b||"");_onpicked.apply(a,[b])},n=function(b){return b==
c||b==f[0]};i=function(){p(c.value,f,l,n)};a.focus(function(){d.addClass(j.active)}).blur(function(){d.removeClass(j.active)}).keyup(function(){var b=this.value;f.css("backgroundColor",b||"");a.css("color",b||"");_onpicked.apply(a,[b]);a.triggerHandler("picked",[b])});g.event.add(c,a.attr("events")||"focus",i);g.event.add(f[0],"click",i);g.event.add(c,"keydown",function(b){if(b.keyCode==9||b.keyCode==27)o(f)});a.after(d);d.append(a).append(f)};g.fn.colorInput=function(){this.each(function(){v(this)});
return this}})(jQuery);