/*
author: huoshow - Steven Wang
date: 2012-5-9
*/
(function(){
	var ie6 = navigator.userAgent.indexOf("MSIE 6") > -1;
	var toolbarcollapser = {};
	toolbarcollapser.commands = {
		ToolbarCollapser: {
			async: true,
			exec: function(editor) {
				//$('#cke_top_content').toggleClass('collapser_toolbox');
				if(!ie6){
					var $body = $('body');
					if($body.is('#collapser_toolbox')){
						$body.attr('id', '');
					} else{
						$body.attr('id', 'collapser_toolbox');
					}
				}
				//通过 editor.css 控制按钮显示
				//$('#cke_top_content').toggleClass('collapser_table');
				//隐藏/显示下方工具栏
				//$('.cke_button_ToolbarCollapser').parents('.cke_toolbar').nextAll('.cke_toolbar').toggle();
				//$('#cke_28').nextAll().add('#cke_70').toggle().parents('td.cke_top').css('background', 'none');
			}
		}
	};

	toolbarcollapser.lang = ['zh-cn'];
	toolbarcollapser.init = function(editor) {
		editor.addCommand('ToolbarCollapser', this.commands.ToolbarCollapser);
		editor.ui.addButton('ToolbarCollapser', {
			command : 'ToolbarCollapser',
			label : editor.lang.toolbarcollapser.title,
			icon: this.path+'toolbarcollapser.png'
		});
	};

	CKEDITOR.plugins.add('toolbarcollapser', toolbarcollapser);
	if(!ie6) $('body').attr('id', 'collapser_toolbox');
})();