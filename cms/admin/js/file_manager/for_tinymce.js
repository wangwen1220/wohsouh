var tinymce=null,tinyMCEPopup,tinyMCE;
tinyMCEPopup={init:function(){var a=this,b=a.getWin();tinymce=b.tinymce;tinyMCE=b.tinyMCE;a.editor=tinymce.EditorManager.activeEditor;a.params=a.editor.windowManager.params;a.dom=a.editor.windowManager.createInstance("tinymce.dom.DOMUtils",document);a.listeners=[];a.onInit={add:function(c,d){a.listeners.push({func:c,scope:d})}};a.isWindow=!a.getWindowArg("mce_inline");a.id=a.getWindowArg("mce_window_id");a.editor.windowManager.onOpen.dispatch(a.editor.windowManager,window)},getWin:function(){return window.dialogArguments||
opener||parent||top},getWindowArg:function(a,b){var c=this.params[a];return tinymce.is(c)?c:b},getParam:function(a,b){return this.editor.getParam(a,b)},getLang:function(a,b){return this.editor.getLang(a,b)},execCommand:function(a,b,c){this.restoreSelection();return this.editor.execCommand(a,b,c)},resizeToInnerSize:function(){var a=this.dom.getViewPort(window),b;b=this.getWindowArg("mce_width")-a.w;a=this.getWindowArg("mce_height")-a.h;this.isWindow?window.resizeBy(b,a):this.editor.windowManager.resizeBy(b,
a,this.id)},executeOnLoad:function(a){this.onInit.add(function(){eval(a)})},storeSelection:function(){this.editor.windowManager.bookmark=tinyMCEPopup.editor.selection.getBookmark("simple")},restoreSelection:function(){var a=tinyMCEPopup;!a.isWindow&&tinymce.isIE&&a.editor.selection.moveToBookmark(a.editor.windowManager.bookmark)},requireLangPack:function(){var a=this.getWindowArg("plugin_url")||this.getWindowArg("theme_url");a&&document.write('<script type="text/javascript" src="'+a+"/langs/"+this.editor.settings.language+
'_dlg.js"><\/script>')},pickColor:function(a,b){this.execCommand("mceColorPicker",true,{color:document.getElementById(b).value,func:function(c){document.getElementById(b).value=c;tinymce.is(document.getElementById(b).onchange,"function")&&document.getElementById(b).onchange()}})},openBrowser:function(a,b){tinyMCEPopup.restoreSelection();this.editor.execCallback("file_browser_callback",a,document.getElementById(a).value,b,window)},close:function(){this.dom=this.dom.doc=null;this.editor.windowManager.close(window,
this.id)},_restoreSelection:function(){var a=window.event.srcElement;if(a.nodeName=="INPUT"&&(a.type=="submit"||a.type=="button"))tinyMCEPopup.restoreSelection()},_onDOMLoaded:function(){var a=this,b=document.title,c;c=document.body.innerHTML;if(tinymce.isIE)c=c.replace(/ (value|title|alt)=([^\s>]+)/gi,' $1="$2"');document.body.innerHTML=a.editor.translate(c);document.title=b=a.editor.translate(b);document.body.style.display="";tinymce.isIE&&document.attachEvent("onmouseup",tinyMCEPopup._restoreSelection);
a.restoreSelection();tinymce.each(a.listeners,function(d){d.func.call(d.scope,a.editor)});a.resizeToInnerSize();a.isWindow?window.focus():a.editor.windowManager.setTitle(b,a.id);!tinymce.isIE&&!a.isWindow&&tinymce.dom.Event._add(document,"focus",function(){a.editor.windowManager.focus(a.id)});tinymce.each(a.dom.select("select"),function(d){d.onkeydown=tinyMCEPopup._accessHandler});window.focus()},_accessHandler:function(a){a=a||window.event;if(a.keyCode==13||a.keyCode==32){a=a.target||a.srcElement;
a.onchange&&a.onchange();return tinymce.dom.Event.cancel(a)}},_wait:function(){var a=this,b;if(tinymce.isIE&&document.location.protocol!="https:"){document.write("<script id=__ie_onload defer src='javascript:\"\"';><\/script>");document.getElementById("__ie_onload").onreadystatechange=function(){if(this.readyState=="complete"){a._onDOMLoaded();document.getElementById("__ie_onload").onreadystatechange=null}}}else if(tinymce.isIE||tinymce.isWebKit)b=setInterval(function(){if(/loaded|complete/.test(document.readyState)){clearInterval(b);
a._onDOMLoaded()}},10);else window.addEventListener("DOMContentLoaded",function(){a._onDOMLoaded()},false)}};tinyMCEPopup.init();function selectFile(a){if(a){var b=tinyMCEPopup.getWindowArg("window");b.document.getElementById(tinyMCEPopup.getWindowArg("input")).value=a;try{b.ImageDialog.showPreviewImage(a)}catch(c){}}}
function selectFiles(a){if(a){a='<p class="p_img"><img src="'+a.join('" /></p><p class="p_img"><img src="')+'" /></p>';tinyMCEPopup.execCommand("mceInsertContent",false,a);tinyMCEPopup.close()}}function cancelSelectFile(){tinyMCEPopup.close()};
