(function(){function h(a,b){b||(b=location.search);return(RegExp("[&?]"+a+"=(\\w+)").exec(b)||{1:null})[1]}function m(a){a.ajaxForm(function(b){b.state?e.success(b):e.error(b)},null,function(){$().focus();if(j=="picture"&&$("#pictures>div").length==0){ct.warn("\u81f3\u5c11\u9700\u8981\u4e0a\u4f20\u4e00\u5f20\u56fe\u7247");return false}if(j=="vote"&&$("#options>tr").length<2){ct.error("\u81f3\u5c11\u5f97\u4fdd\u7559\u4e24\u4e2a\u6295\u7968\u9009\u9879");return false}window.tinyMCE&&$("#content").val(tinyMCE.activeEditor.getContent());
ct.startLoading("center","\u6b63\u5728\u4fdd\u5b58...")})}var j=h("app"),i=h("action"),l=h("contentid")?h("contentid"):0,o="#"+j+"_"+i,e={add:function(){},edit:function(a){var b=$("#row_"+a).attr("model");b||(b=h("app"));if(e.islock(a)){ct.error("\u5f53\u524d\u6587\u6863\u5df2\u88ab\u9501\u5b9a\uff0c\u65e0\u6cd5\u4fee\u6539\uff01");return false}ct.assoc.open("?app="+b+"&controller="+b+"&action=edit&contentid="+a,"newtab")},view:function(a){var b=$("#row_"+a).attr("model");b||(b=h("app"));ct.assoc.open("?app="+
b+"&controller="+b+"&action=view&contentid="+a,"newtab")},category:function(a){ct.assoc.open("?app=system&controller=content&action=index&catid="+a,"newtab")},search:function(a,b,c){ct.ajax("\u5185\u5bb9\u641c\u7d22","?app=system&controller=content&action=search&catid="+a+"&modelid="+b+"&status="+c,360,350,function(){$("input.input_calendar").focus(function(){WdatePicker({dateFmt:"yyyy-MM-dd HH:mm"})})},function(){tableApp.load($("#content_search"));return true})},createhtml:function(a){e._common(a,
"show",false)},del:function(a){if(a===undefined){a=tableApp.checkedIds();var b='\u786e\u5b9a\u5220\u9664\u9009\u4e2d\u7684<b style="color:red">'+a.length+"</b>\u6761\u8bb0\u5f55\u5417\uff1f"}else b='\u786e\u5b9a\u5220\u9664\u7f16\u53f7\u4e3a<b style="color:red">'+a+"</b>\u7684\u8bb0\u5f55\u5417\uff1f";if(a.length===0){ct.warn("\u8bf7\u9009\u62e9\u8981\u64cd\u4f5c\u7684\u8bb0\u5f55");return false}ct.confirm(b,function(){e._common(a,"delete")})},clear:function(a,b){ct.confirm('<font colr="red">\u786e\u5b9a\u8981\u6e05\u7a7a'+
b+"\u680f\u76ee\u56de\u6536\u7ad9\u4e2d\u7684\u6240\u6709\u5185\u5bb9\u5417\uff1f<br />\u6b64\u64cd\u4f5c\u4e0d\u53ef\u6062\u590d\uff01</font>",function(){$.getJSON("?app=system&controller=content&action=clear&catid="+a,function(c){c.state?tableApp.load():ct.error(c.error)});return true},function(){return true})},remove:function(a){e._common(a,"remove")},restore:function(a){e._common(a,"restore")},restores:function(a){$.getJSON("?app=system&controller=content&action=restores&catid="+a,function(b){if(b.state){$("#list_body").empty();
ct.ok("\u64cd\u4f5c\u6210\u529f")}else ct.error(b.error)})},approve:function(a){e._common(a,"approve")},pass:function(a){e._common(a,"pass")},reject:function(a){e._common(a,"reject")},publish:function(a){e._common(a,"publish")},unpublish:function(a){e._common(a,"unpublish")},islock:function(a){var b=$.ajax({url:"?app=system&controller=content&action=islock&contentid="+a,async:false,dataType:"json"}).responseText;b=(new Function("return "+b))();b.state||$("#row_"+a+" img[src='images/lock.gif']").remove();
return b.state},log:function(a){ct.iframe("?app=system&controller=content_log&action=index&contentid="+a,570,400)},keyword:function(a){ct.form("\u6dfb\u52a0\u5173\u952e\u5b57","?app=system&controller=keylink&action=content_index&contentid="+a,400,150,function(b){b.state?ct.tips("\u64cd\u4f5c\u6210\u529f\uff01","ok"):ct.tips(b.error,"ok");return true},function(){return true})},note:function(a){ct.iframe("?app=system&controller=content_note&action=index&contentid="+a,570,400).bind("dialogclose",function(){i==
"index"&&tableApp.load()})},version:function(a){ct.iframe("?app=system&controller=content_version&action=index&contentid="+a,500,350)},tags:function(){},move:function(a){if(a==undefined){a=tableApp.checkedIds();if(!a.length){ct.warn("\u8bf7\u9009\u62e9\u8981\u64cd\u4f5c\u7684\u8bb0\u5f55");return false}}ct.form("\u79fb\u52a8\u5185\u5bb9","?app=system&controller=content&action=move&contentid="+a,350,300,function(b){if(b.state){ct.tips("\u64cd\u4f5c\u6210\u529f","success");if(i=="index"){tableApp.load();
return true}else window.location.reload()}else{ct.error(b.error);return false}},function(b){b.find("#category_tree").treeview();b.find("#category_tree span").unbind("click mouseover")})},forward:function(a){if(a==undefined){a=tableApp.checkedIds();if(!a.length){ct.warn("\u8bf7\u9009\u62e9\u8981\u64cd\u4f5c\u7684\u8bb0\u5f55");return false}}$.get("?app=system&controller=tweets&action=forward_check&contentid="+a,"",function(b){if(b.state)ct.form("\u8f6c\u53d1\u5185\u5bb9","?app=system&controller=tweets&action=forward&contentid="+
a,520,480,function(c){var d="\u8b66\u544a<br/>";if(c.state)if(c.data==null)ct.tips("\u8f6c\u53d1\u6210\u529f","success");else{for(var f=0;f<c.data.length;f++){d+=f+1+"\u3001";d+=c.data[f].text+" \u8f6c\u53d1\u81f3 "+c.data[f].user+" \u5931\u8d25<br/>"}ct.warn(d)}else ct.tips("\u8f6c\u53d1\u5931\u8d25","error");return false});else{ct.error(b.error);return false}},"json")},copy:function(a){if(a==undefined){ct.warn("\u8bf7\u9009\u62e9\u8981\u64cd\u4f5c\u7684\u8bb0\u5f55");return false}var b=$("#row_"+
a).attr("model");b||(b=h("app"));ct.form("\u590d\u5236\u5185\u5bb9","?app="+b+"&controller="+b+"&action=copy&contentid="+a,350,300,function(c){if(c.state){ct.ok("\u64cd\u4f5c\u6210\u529f");return true}else{ct.error(c.error);return false}},function(c){c.find("#category_tree").treeview();c.find("#category_tree span").unbind("click mouseover")})},reference:function(a){if(a==undefined){a=tableApp.checkedIds();if(!a.length){ct.warn("\u8bf7\u9009\u62e9\u8981\u64cd\u4f5c\u7684\u8bb0\u5f55");return false}}var b=
$("#row_"+a).attr("model");b||(b=h("app"));ct.form("\u5f15\u7528\u5185\u5bb9","?app="+b+"&controller="+b+"&action=reference&contentid="+a,350,300,function(c){if(c.state){ct.ok("\u64cd\u4f5c\u6210\u529f");return true}else{ct.error(c.error);return false}},function(c){c.find("#category_tree").treeview();c.find("#category_tree span").unbind("click mouseover")})},section:function(a){if(a==undefined){ct.warn("\u8bf7\u9009\u62e9\u8981\u64cd\u4f5c\u7684\u8bb0\u5f55");return false}ct.ajax("\u63a8\u8350\u4f4d",
"?app=system&controller=content&action=section&contentid="+a,500,300,function(){},function(b){b=b.find("input:checkbox:checked");for(var c=b.length,d="",f=0;f<c;f++)d+=b[f].value+",";e._common(a,"saveSection",false,"&selected="+d.substr(0,d.length-1)+"&model=article");return true},function(){return true})},_common:function(a,b,c,d){if(c==undefined)c=true;if(d==undefined)d="";if(a==undefined){a=tableApp.checkedIds();if(a.length===0){ct.warn("\u8bf7\u9009\u62e9\u8981\u64cd\u4f5c\u7684\u8bb0\u5f55");
return false}e._common_execute(a,b,c,0,d);return true}(c=controller=$("#row_"+a).attr("model"))||(c=controller=h("app"));if(b=="show")controller="html";if(b=="saveSection"){d+="&model="+c;c="system";controller="content"}$.getJSON("?app="+c+"&controller="+controller+"&action="+b+"&contentid="+a+d,function(f){if(f.state){if(b=="delete"||b=="remove")h("action")=="index"?tableApp.deleteRow(a):ct.assoc.close();else if(b=="restore")h("action")=="index"&&tableApp.load();else ct.ok("\u64cd\u4f5c\u6210\u529f");
tableApp.load()}else ct.error(f.error)})},_common_execute:function(a,b,c,d,f){if(f==undefined)f="";var g=controller=$("#row_"+a[d]).attr("model");if((g=="link"||g=="special")&&b=="show")return ct.warn("\u94fe\u63a5\u548c\u4e13\u9898\u4e0d\u80fd\u5728\u6b64\u751f\u6210\uff01");if(b=="show")controller="html";g||(g=controller=h("app"));if(b=="saveSection"){f=f.replace(/&model=([\d\w]+)/i,"&model="+g);g="system";controller="content"}$.getJSON("?app="+g+"&controller="+controller+"&action="+b+"&contentid="+
a[d]+f,function(n){if(n.state){if(b=="remove"||b=="restore")tableApp.deleteRow(a[d]);else{$("#row_"+a[d]).removeClass("row_chked");$("#chk_row_"+a[d]).attr("checked",false)}d++;if(a.length>d)e._common_execute(a,b,c,d,f);else{$("#check_all").attr("checked",false);if(b=="remove"||b=="restore")tableApp.load();if(h("action")=="index"){if(b=="delete"||b=="remove")return tableApp.deleteRow();c&&tableApp.load();ct.tips("\u64cd\u4f5c\u6210\u529f","success")}else ct.ok("\u64cd\u4f5c\u6210\u529f")}}else ct.error(n.error)})}};
e.lock=function(a,b){$.get("?app="+b+"&controller="+b+"&action=lock&contentid="+a)};e.unlock=function(a,b){$.get("?app="+b+"&controller="+b+"&action=unlock&contentid="+a)};e.success=function(a){e.unload_alert=0;$("#submit").attr("disabled",false);var b=i=="add"?"\u6dfb\u52a0":"\u4fee\u6539",c="\u606d\u559c\uff0c\u5185\u5bb9"+b+"\u6210\u529f\u3002",d=a.url?a.url:$("#url").val();if(d)c+='\u67e5\u770b\u5730\u5740\uff1a<br/><a target="_BLANK" href="'+d+'">'+d+"</a>";var f=ct.confirm(c,function(){b=="\u6dfb\u52a0"&&
location.reload()},function(){top!=self?ct.assoc.close():self.close()});f.find("button:first").remove();d=f.find("button:last").text("\u5173\u95ed");c=$('<button type="button">\u7ee7\u7eed\u4fee\u6539</button>').click(function(){b=="\u4fee\u6539"&&f.hide();if(!g)var g=a.contentid;if(g){g=h("app");location.href="?app="+g+"&controller="+g+"&action=edit&contentid="+a.contentid}});d.before(c);c.addClass("button_style_1");if(i=="add"){f.find("button:first").text("\u4fee\u6539");d=$('<button type="button">\u7ee7\u7eed\u6dfb\u52a0</button>').click(function(){if(!g)var g=
a.contentid;if(g){g=$("#catid").val();$("form")[0].reset();$("#related_data").empty();$("#catid").val(g);$.slider.reset()}f.hide()});c.before(d);d.addClass("button_style_1");$("#frame_container iframe",parent.document).filter(function(){if(!/\?app=system&controller=content&action=index/i.test(this.src))return false;var g=h("catid",this.src);if(!g)return true;return g==$("#catid").val()}).each(function(){this.contentWindow.tableApp.load()})}};e.error=function(a){$("#submit").attr("disabled",false);
if(a.filterword){var b="\u5185\u5bb9\u4e2d\u51fa\u73b0\u4ee5\u4e0b\u8fc7\u6ee4\u8bcd\u8bed\uff0c\u662f\u5426\u8981\u7ee7\u7eed\u53d1\u5e03\u3002";for(k in a.filterword)b+='<span class="filterword">'+a.filterword[k]+"</span> ";ct.confirm(b,function(){if($("#article_add").length)var c=$("#article_add");if($("#article_edit").length)c=$("#article_edit");c.attr("action",c.attr("action")+"&ignoreword=1");m(c);c.submit()});$("div.btn_area button:first").text("\u7ee7\u7eed");$("p.ct_confirm>span.filterword").css({color:"#d00"})}else ct.error(a.error)};
window.content=e;window.show_subtitle=function(){if($("#has_subtitle").attr("checked")==true)$("#tr_subtitle").show();else{$("#tr_subtitle").hide();$("#subtitle").val("")}};window.expand=function(a){if($(a).children("span").hasClass("span_open")){$(a).children("span").removeClass("span_open");$(a).children("span").addClass("span_close");$("#expand").hide()}else{$(a).children("span").removeClass("span_close");$(a).children("span").addClass("span_open");$("#expand").show()}};if(i=="add"||i=="edit")$(function(){$("#catid option[childids='1']").attr("disabled",
"disabled");$(".tips").attrTips("tips","tips_green");e.tags(j+"_"+i);var a=$(o),b=a.find("input,textarea,select").not(":button,:submit,:image,:reset,[disabled]");b.filter(function(){var c=parseInt(this.getAttribute("maxLength"));return c>0&&c<1E3&&!this.getAttribute("uncount")}).maxLength();$.fn.autocomplete&&b.filter("[autocomplete=1]").autocomplete({autoFill:false,showEvent:"focus"});b.filter("input.input_calendar").focus(function(){WdatePicker({dateFmt:"yyyy-MM-dd HH:mm:ss"})});$.fn.colorInput&&
b.filter("input.color-input").colorInput();m(a);b.filter("[name=title]").focus()});if(i=="add"){e.unload_alert=true;window.onbeforeunload=function(){if(e.unload_alert&&$("#title").val()!="")return"\u5185\u5bb9\u5c1a\u672a\u4fdd\u5b58\uff0c\u60a8\u786e\u8ba4\u653e\u5f03\u53d1\u5e03\u5417\uff1f"}}if(i=="edit"){$(function(){var a=$(".content").find("img");typeof a[0]!=="undefined"&&a.each(function(){if(this.width>=590)this.width=560})});var p=setInterval(function(){e.lock(l,j)},1E4,l);$(window).unload(function(){clearInterval(p);
e.unlock(l,j)})}$(function(){i=="view"&&$(window).load(function(){$(".content").find("img").each(function(){$(this).removeAttr("height");this.style.width="580px";$(this).closest("p").css("text-indent","0")})})})})();
