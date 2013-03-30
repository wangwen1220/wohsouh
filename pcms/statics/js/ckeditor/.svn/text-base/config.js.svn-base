/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'zh-cn';
	config.uiColor = '#f7f5f4';
	config.width = '';
	config.removePlugins = 'elementspath,scayt';
	config.disableNativeSpellChecker = false;
	config.resize_dir = 'vertical';
	config.keystrokes =[
		[ CKEDITOR.CTRL + 13 /*Enter*/, 'maximize' ],
		[ CKEDITOR.SHIFT + 121 /*F10*/, 'contextMenu' ],
		[ CKEDITOR.CTRL + 90 /*Z*/, 'undo' ],
		[ CKEDITOR.CTRL + 89 /*Y*/, 'redo' ],
		[ CKEDITOR.CTRL + CKEDITOR.SHIFT + 90 /*Z*/, 'redo' ],
		[ CKEDITOR.CTRL + 76 /*L*/, 'link' ],
		[ CKEDITOR.CTRL + 66 /*B*/, 'bold' ],
		[ CKEDITOR.CTRL + 73 /*I*/, 'italic' ],
		[ CKEDITOR.CTRL + 85 /*U*/, 'underline' ],
		[ CKEDITOR.CTRL + 81 /*Q*/, 'pagebreak' ],
		[ CKEDITOR.ALT + 13 /*Enter*/, 'ToolbarCollapser' ],
		[ CKEDITOR.CTRL + CKEDITOR.ALT + 13 /*Enter*/, 'toolbarCollapse' ]
	];
	config.extraPlugins = 'flvPlayer,toolbarcollapser,capture,autoformat';
	//config.enterMode = CKEDITOR.ENTER_span;
	config.tabSpaces = 4;
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_P;
	config.font_names='宋体/宋体;黑体/黑体;仿宋/仿宋_GB2312;楷体/楷体_GB2312;隶书/隶书;幼圆/幼圆;微软雅黑/微软雅黑;'+ config.font_names;
	//CKEDITOR.instances.content.insertHtml("<img src=...>");
	//config.format_img = { element : 'img', attributes : { class : 'content_img' } };
	//config.contentsCss = 'statics/js/ckeditor/contents.css';
	// config.toolbarCanCollapse = true;//工具栏是否可以被收缩
	// config.toolbarLocation = 'top';//可选：bottom
	// config.toolbarStartupExpanded = false;//工具栏默认是否展开
	// config.resize_enabled = false; // 取消“拖拽以改变尺寸”功能
	//config.extraPlugins += (config.extraPlugins ? ',toolbarcollapser' : 'toolbarcollapser');
	config.flashBrowserWindowWidth = 400; //Flash浏览器窗口宽度
	config.flashBrowserWindowHeight = 800; //Flash浏览器窗口宽度
};
CKEDITOR.on( 'instanceReady', function( ev ){ with (ev.editor.dataProcessor.writer) { setRules("p", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("h1", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("h2", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("h3", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("h4", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("h5", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("div", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("table", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("tr", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("td", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("iframe", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("li", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("ul", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); setRules("ol", {indent : false, breakAfterOpen : false, breakBeforeClose : false} ); } });
//CKEDITOR.plugins.load('pgrfilemanager');
function insert_page(editorid)
{
	var editor = CKEDITOR.instances[editorid];
	editor.insertHtml('[page]');
	if($('#paginationtype').val()) {
		$('#paginationtype').val(2);
		$('#paginationtype').css("color","red");
	}
}

function insert_page_title(editorid,insertdata)
{
	if(insertdata)
	{
		var editor = CKEDITOR.instances[editorid];
		var data = editor.getData();
		var page_title_value = $("#page_title_value").val();
		if(page_title_value=='')
		{
			$("#msg_page_title_value").html("<font color='red'>请输入子标题</font>");
			return false;
		}
		page_title_value = '[page]'+page_title_value+'[/page]';
		editor.insertHtml(page_title_value);
		$("#page_title_value").val('');
		$("#msg_page_title_value").html('');
		if($('#paginationtype').val()) {
			$('#paginationtype').val(2);
			$('#paginationtype').css("color","red");
		}
	}
	else
	{
		$("#page_title_div").slideDown("fast");
	}
}
var objid = MM_objid = key = 0;
function file_list(fn,url,obj) {
	$('#MM_file_list_editor1').append('<div id="MM_file_list_'+fn+'">'+url+' <a href=\'#\' onMouseOver=\'javascript:FilePreview("'+url+'", 1);\' onMouseout=\'javascript:FilePreview("", 0);\'>查看</a> | <a href="javascript:insertHTMLToEditor(\'<img src='+url+'>\',\''+fn+'\')">插入</A> | <a href="javascript:del_file(\''+fn+'\',\''+url+'\','+fn+')">删除</a><br>');
}
