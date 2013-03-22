
(function() {
	
	tinymce.create('tinymce.plugins.ct_taglinkPlugin', {
		
		init : function(ed, url) {
		
			ed.addCommand('mceTaglink', function() {
			
				ed.windowManager.open({
					file : '?app=editor&controller=taglink&action=index',
					width : 530,
					height : 250,
					inline : 1
				}, {
					plugin_url : url, // Plugin absolute URL
					some_custom_arg : 'custom arg' // Custom argument
				});
			});

			ed.addButton('ctTaglink', {
				title : '\u5173\u952e\u8bcd\u94fe\u63a5',
				cmd : 'mceTaglink'
			});

		}
	});

	tinymce.PluginManager.add('ct_taglink', tinymce.plugins.ct_taglinkPlugin);
})();