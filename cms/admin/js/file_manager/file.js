function ls(a,b){b||(b="overwrite");var c=$("#file_list");b!="add"&&$("#file_list").empty();for(i=0;i<a.length;i++){var d=row_template,e=a[i].alias;if(a[i].resolution!="*"){e+="&lt;br&gt;\u89c4\u683c:"+a[i].resolution;a[i].preview=parseInt(a[i].resolution)>1?"preview":"no"}else a[i].preview="no";e+="&lt;br&gt;\u5927\u5c0f:"+a[i].filesize;e+="&lt;br&gt;\u4e0a\u4f20\u4eba:"+a[i].createdby;e+="&lt;br&gt;\u4e0a\u4f20\u65f6\u95f4:"+a[i].created;a[i].description=e;for(var f in a[i])d=d.replace(RegExp("\\{"+
f+"\\}","gm"),a[i][f]);$(d).appendTo(c)}$("#vt_"+file_config.list_type).addClass("vt_list_on")}function img_dblclick(a){preview($(a).parents("li"))}function file_click(a){a=$(a);if(select_single){if(window.prevSelected)window.prevSelected.removeClass("selected").find("input:radio")[0].checked=false;window.prevSelected=a;a.addClass("selected").find("input:radio")[0].checked=true}else{a.toggleClass("selected");a.find("input:checkbox")[0].checked=a.hasClass("selected")}}
function file_mouseover(a){$(a).addClass("mouseover")}function file_mouseout(a){$(a).removeClass("mouseover")}function filename_dblclick(a){if(window.rename_lock)return true;rename_file($(a).parents("li").attr("aid"))}function check_more(){var a=$("#scroll_div");a.scrollTop()+a.height()>a.get(0).scrollHeight-200&&show_more()}
function dir(a){a=format_data(a,dir_row_template);$("#current_dir").html(a);$("#current_dir > li").click(function(){var b=$(this).attr("fid");cd(b)}).contextMenu("#folder_right_menu",function(b,c){eval("("+b+")")($(c).attr("fid"))})}
function delete_folder(a){var b=$("[fid="+a+"]").find("a").html();ct.confirm("\u786e\u8ba4\u8981\u5220\u9664"+b+"\u5417\uff1f",function(){a&&b&&$.get("?app=system&controller=attachment&action=ls","fid="+a+"&size=1",function(c){if(c.state){var d=function(){$.post("?app=system&controller=attachment&action=delete_folder","fid="+a,function(e){if(e.state){file_data=[];refresh_data()}else ct.error(e.error)},"json")};c.total>0||c.dirs.length>0?ct.confirm([b," \u91cc\u9762\u8fd8\u6709",c.total,"\u4e2a\u6587\u4ef6\u548c",
c.dirs.length,"\u4e2a\u6587\u4ef6\u5939 \u786e\u8ba4\u8981\u5168\u90e8\u5220\u9664\u5417\uff1f"].join(""),d):d()}else ct.error(c.error)},"json")})}function rename_folder(a){ct.form("\u91cd\u547d\u540d","?app=system&controller=attachment&action=rename_folder&fid="+a,260,148,function(b){if(b.state){delete file_data[file_config.cur_fid];delete file_data[b.fid];$("[fid="+b.fid+"]").children("a").html(b.name);return true}})}
function rename_file(a){a||(a=get_selected().attr("aid"));window.rename_lock=true;var b=$("#file_"+a).find("span"),c=b.html(),d=$('<input class="inline_input" aid="'+a+'" type="text" name="newname" oldvalue="'+c+'" value="'+c+'" />');d.bind("keydown",function(e){e.keyCode==13&&rename_submit(d)}).bind("blur",function(){rename_submit(d)});b.html(d);$(d).focus().select()}
function rename_submit(a){var b=a.val(),c=a.attr("oldvalue");if(b==c){a.parent().html(c);window.rename_lock=false}else $.post("?app=system&controller=attachment&action=rename_file",{newname:b,aid:a.attr("aid").toString().replace("file_","")},function(d){if(d.state)a.parent().html(b);else{ct.tips(d.error,"error");a.parent().html(c)}window.rename_lock=false},"json")}
function new_folder(){var a=current_data.fid;ct.form("\u521b\u5efa\u76ee\u5f55","?app=system&controller=attachment&action=mkdir&parent="+a,260,148,function(b){if(b.state){delete file_data[a];dir(b.dirs);return true}})}function open_file(){var a=get_selected();if(a.attr("rel")=="preview")preview(a);else{a=a.attr("aid");a=find_file_object(a);window.open(a.orig_src,"_blank")}}
function load_data(a,b,c){if(!c&&file_data[a])b(file_data[a]);else{current_vars.fid=a;window.loading=true;$.get("?app=system&controller=attachment&action=ls",current_vars,function(d){if(d.state){file_data[d.fid]=d;file_data[d.fid].files_page_1=d.files;b&&b(file_data[d.fid])}else ct.error(d.error);window.loading=false;load_recent()},"json")}}
function cd(a){window.searching=false;$(".attachment_menu_now").removeClass("attachment_menu_now");$("#my_documents").attr("checked","");$("#search_keyword").val("");$("#only_children").attr("checked","");$("#calendar_from").val("");$("#calendar_to").val("");current_vars={size:file_config.page_size,from:0,ext_limit:ext_limit};if(a=="..")a=current_data?current_data.parent:0;a||(a="0");load_data(a,function(b){$("#current_folder_name").html(b.name);file_config.cur_fid=b.fid;try{$("#mul_upload").uploadifySettings("scriptData",
{auth:ct.getCookie(COOKIE_PRE+"auth"),fid:b.fid})}catch(c){}current_data=b;dir(b.dirs);ls(b.files);show_pagination();path_navigation()});$("[fid="+a+"]").addClass("attachment_menu_now")}
function path_navigation(){for(var a=0,b=[],c=file_config.cur_fid;c!=0&&file_data[c]&&c!=a;){b.push({name:file_data[c].name,fid:file_data[c].fid});a=c;c=file_data[c].parent}c="";a=[];for(i=b.length-1;i>=0;i--){c+=b[i].name+"/";a.push({name:c,fid:b[i].fid})}b=document.getElementById("folder_select");b.options.length=0;for(i=a.length-1;i>=0;i--)b.options.add(new Option(a[i].name,a[i].fid));b.options.add(new Option("/",0))}var clipboard=[],copy_action="copy",cut_from_fid=0;
function cut_file(){copy_file("cut");window.cut_from_fid=file_config.cur_fid}function copy_file(a){if($("li.selected").length<=0)ct.warn("\u8bf7\u9009\u62e9\u8981"+(a=="cut"?"\u526a\u5207":"\u590d\u5236")+"\u7684\u6587\u4ef6");else{var b=[];$(".selected").each(function(){b.push($(this).attr("id").toString().replace("file_",""))});window.clipboard=b;window.copy_action=a?a:"copy"}}
function paste_file(){window.searching?ct.warn("\u4e0d\u80fd\u5728\u641c\u7d22\u7ed3\u679c\u4e2d\u7c98\u8d34\uff0c\u8bf7\u70b9\u51fb\u5de6\u8fb9\u7684\u6587\u4ef6\u5939\u56fe\u6807\uff0c\u8fdb\u5165\u4e00\u4e2a\u6587\u4ef6\u5939\u540e\u518d\u6267\u884c\u7c98\u8d34\u64cd\u4f5c!"):$.post("?app=system&controller=attachment&action=paste_file",{aids:window.clipboard.join(","),fid:file_config.cur_fid,copy_action:window.copy_action},function(a){if(a=="ok"){refresh_data();window.copy_action=="cut"&&delete file_data[window.cut_from_fid]}else ct.error(a)})}
function select_folder(a){cd($(a).val())}function upload(){}function _dirname(a){a=a.split("_");return a=a.pop()}function list_type(a){$("#vt_thumb").removeClass("vt_list_on");$("#vt_list").removeClass("vt_list_on");row_template=a=="thumb"?row_thumb_template:row_list_template;file_config.list_type=a;ls(current_data.files)}
function search_file(){window.searching=true;current_vars.keyword=$("#search_keyword").val();current_vars.only_children=$("#only_children").attr("checked")?"1":"0";current_vars.calendar_from=$("#calendar_from").val();current_vars.calendar_to=$("#calendar_to").val();current_vars.page=1;current_vars.search="1";current_vars.my_documents=$("#my_documents").attr("checked")?"1":"0";window.loading=true;$.get("?app=system&controller=attachment&action=ls",current_vars,function(a){if(a.state){current_data=
a;ls(a.files);show_pagination()}else ct.error(a.error);window.loading=false},"json")}
function show_more(){if(!window.loading)if(!window.show_more_lock)if(current_data){if(!(current_data.files.length>=current_data.total)){current_vars.from=current_data.files.length;window.laoding=true;window.show_more_lock=true;$.get("?app=system&controller=attachment&action=ls",current_vars,function(a){if(a.state&&current_vars.from==a.from){for(var b=0;b<a.files.length;b++)current_data.files.push(a.files[b]);ls(a.files,"add");show_pagination();file_data[current_data.fid]=current_data}setTimeout(function(){window.show_more_lock=
false},10);window.loading=false},"json")}}else refresh_data()}function show_pagination(){$("#pagination").html("\u5df2\u663e\u793a"+current_data.total+"\u9879\u4e2d\u7684"+current_data.files.length+"\u9879")}function refresh_data(){var a=current_data?current_data.fid:file_config.cur_fid;file_data[a]=null;cd(a)}function edit_img(){}
function delete_file(){var a=$("li.selected");if(a.length<=0)ct.error("\u8bf7\u9009\u62e9\u8981\u5220\u9664\u7684\u6587\u4ef6","error");else{var b=[];a.each(function(){b.push($(this).attr("id").toString().replace("file_",""))});a=b.length==1?' "'+a.find("span").html()+'" ':"\u8fd9"+b.length+"\u4e2a\u6587\u4ef6";ct.confirm("\u786e\u8ba4\u8981\u5220\u9664"+a+"\u5417\uff1f",function(){for(var c=b.join(","),d=0;d<b.length;d++)$("#file_"+b[d]).fadeTo(100,0.7);$.post("?app=system&controller=attachment&action=delete_file",
{aids:c},function(e){if(e.aids)for(d=0;d<e.aids.length;d++)$("#file_"+e.aids[d]).animate({width:0},300,function(){$(this).remove()});delete file_data[file_config.cur_fid];if(e.error){var f="";for(d=0;d<e.error.length;d++)f+=e.error[d]+"<br>";f&&ct.error(f)}},"json")})}}function add_file(a){a=format_data(a);file_config.add_mode=="append"?$("#file_list").append(a):$("#file_list").preprend(a)}
window_insert=function(){var a=$("li.selected");if(select_single)if(a.length<1)ct.warn("\u8bf7\u9009\u62e9\u8981\u63d2\u5165\u7684\u6587\u4ef6");else if(a.length>1)ct.warn("\u53ea\u80fd\u63d2\u5165\u4e00\u4e2a\u6587\u4ef6");else{selectFile(a.attr("src"));for_tinymce&&tinyMCEPopup.close()}else{var b=[];a.each(function(){b.push($(this).attr("src"))});selectFiles(b)}};
function format_data(a,b){if(typeof a==="object"&&a.length==0)return"";if(!a)return"";var c=b||row_template,d=c;$.each(a,function(e,f){if(typeof f==="object"&&f!==null)if(d==c)d=format_data(f,c);else d+=format_data(f,c);else{if(f==""||f==null)f="&nbsp;";d=d.replace(RegExp("\\{"+e+"\\}","gm"),f)}});return d}function find_file_object(a){if(a){a=a.toString().replace("file_","");for(i=0;i<=current_data.files.length;i++)if(a==current_data.files[i].aid)return current_data.files[i]}}
function get_selected(a){if(a&&$("input[name=file_chk]:checked").length!=1){ct.warn("\u8bf7\u9009\u62e9\u4e00\u4e2a\u6587\u4ef6");return false}return $("input[name=file_chk]:checked").parents("li")}function show_my_documents(){$("#my_docs_button").addClass("attachment_menu_now");$("#my_documents").attr("checked","checked");$("#search_keyword").val("");$("#only_children").attr("checked","");$("#calendar_from").val("");$("#calendar_to").val("");search_file()}
function select_all(){if(!select_single){$("#file_list > li:not(.selected)").trigger("click");notice_selected()}}function select_inverse(){if(!select_single){$("#file_list > li").trigger("click");notice_selected()}}
function notice_selected(){try{clearTimeout(window.select_notice_timer)}catch(a){}$("#select_notice").css("display","none").html("\u5df2\u9009\u4e2d"+$("#file_list > li.selected").length+"\u9879").fadeIn(300);window.select_notice_timer=setTimeout("$('#select_notice').fadeOut(500);",5E3)}
function edit_file(){var a=get_selected().attr("aid");if(a)var b=ct.iframe("?app=system&controller=attachment&action=edit_image&aid="+a,450,450,null,{ok:function(){var c=$("li.selected:eq(0)"),d=c.attr("thumb")+"?"+Math.random(9);c.find("div.icon img").attr("src",d);b.dialog("close")}})}
function load_recent(){$.get("?app=system&controller=attachment&action=recent",{},function(a){if(a.state&&a.dirs){$("#recent_dir").empty();for(i=0;i<a.dirs.length;i++)if(a.dirs[i].name){var b=document.createElement("li"),c=document.createElement("a");c.href="javascript:cd("+a.dirs[i].fid+")";c.innerHTML=a.dirs[i].name;b.appendChild(c);$(b).attr("fid",a.dirs[i].fid);$(b).contextMenu("#folder_right_menu",function(d,e){eval("("+d+")")($(e).attr("fid"))});$("#recent_dir").append(b)}}},"json")}
function show_notice(a){window.allow_notice=true;$("#notice").html($(a).find("[description]").attr("description"));$(a).mouseout(function(){window.allow_notice=false;try{clearTimeout(window.notice_timer)}catch(b){}$("#notice").hide()})}
function download_file(){var a=$("li.selected");if(!(a.length<=0)){var b=[];a.each(function(){b.push($(this).attr("aid"))});b=b.join(",");a="?app=system&controller=attachment&action=download_file&aids="+b;try{$("#download_iframe").remove()}catch(c){}$('<iframe style="display:none;"></iframe>').attr("id","download_iframe").appendTo(document.body).attr("src",a)}}
function download_folder(a){a=parseInt(a);if(a>0)var b="?app=system&controller=attachment&action=download_folder&fid="+a;try{$("#download_iframe").remove()}catch(c){}$('<iframe style="display:none;"></iframe>').attr("id","download_iframe").appendTo(document.body).attr("src",b)}
function select_ok(){var a=$("#file_list>li.selected"),b;if(select_single)if(a.length<1){ct.warn("\u8bf7\u9009\u62e9\u8981\u63d2\u5165\u7684\u6587\u4ef6");return}else if(a.length>1){ct.warn("\u53ea\u80fd\u63d2\u5165\u4e00\u4e2a\u6587\u4ef6");return}else b={aid:a.find("input:radio").attr("aid"),src:a.attr("src")};else{b=[];a.each(function(){var c=$(this),d=c.find("input:checkbox").attr("aid");b.push({aid:d,src:c.attr("src")})})}if(window.dialogCallback&&dialogCallback.ok)dialogCallback.ok(b);else window.getDialog&&
getDialog().dialog("close")}function select_cancel(){if(window.dialogCallback&&dialogCallback.cancel)dialogCallback.cancel();else window.getDialog&&getDialog().dialog("close")};