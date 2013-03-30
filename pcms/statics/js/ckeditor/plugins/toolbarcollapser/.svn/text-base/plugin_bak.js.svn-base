/*
author: huoshow - Steven Wang
date: 2012-5-9
*/
(function(){
	var toolbarcollapser = {
		async: true,
		exec: function(editor) {
			//隐藏/显示下方工具栏
			$('#cke_27').nextAll().add('#cke_69').toggle().parents('td.cke_top').css('background', 'none');
		}
	};

	CKEDITOR.plugins.add('ToolbarCollapser', {
		lang: ['zh-cn'],
		init: function (editor) {
			var pluginName = 'ToolbarCollapser';
			editor.addCommand(pluginName, toolbarcollapser);
			editor.ui.addButton(pluginName, {
				label: editor.lang.toolbarcollapser.title,
				command: pluginName,
				//icon: CKEDITOR.plugins.getPath('toolbarcollapser') + 'toolbarcollapser.png'
				icon: this.path+'toolbarcollapser.png'
			});
		};
	});
})();
