/**
 * $Id: editor_plugin_src.js  2010-09-17 10:29
 *
 * @author shanhuhai
 * @copyright Copyright ?2010, CmsTop, All rights reserved.
 */

(function() {

	tinymce.create('tinymce.plugins.ct_source', {
		hasInit : false,
		isSource : false,
		ifr : null,
		ta : null,
		ifrBody : null,
		pos : null,
		btnsLine : null,
		init : function(ed, url) {
			var t = this;
			ed.addCommand('mceSource', function() {
				if(!t.hasInit){
					t._taInit(ed);
					t._doBtn(ed,true);
				}else{
					if(!t.isSource){
						$(t.ta).val(ed.getContent({source_view : true})).show();
						$(t.ifr).hide();
						t.pos.hide();
						t._doBtn(ed,true);
						t.isSource = true;
					}else{
						$(t.ifr).show().focus();
						ed.setContent($(t.ta).val(), {source_view : true})
						$(t.ta).hide();
						t.pos.show();
						t._doBtn(ed,false);
						t.isSource = false;
					}
				}
			});
			ed.onNodeChange.add(function(ed, cm, n, co) {
				cm.setDisabled('ctTag',ed.selection.getContent()==''||co);
			});
			ed.addButton('ctSource', {
				title : '\u7f16\u8f91\u6e90\u7801',
				cmd : 'mceSource'
			});
		},
		
		_taInit : function(ed){
			var t = this,
			container = ed.getContentAreaContainer(),
			content = ed.getContent({source_view : true}),
			timeHandler=null;
			t.ifr = container.childNodes[0];
			t.pos = $('#'+ed.id + '_path_row');
			t.ta = $('<textarea wrap="soft" dir="ltr" style="display:none;white-space:pre-wrap;background:#fff;width:'+t.ifr.style.width+';height:'+t.ifr.style.height+'">'+content+'</textarea>').bind('keyup',function(){
				var tt = this ;
				if(content == tt.value) return;
				if(timeHandler) {
					clearTimeout(timeHandler);
					timeHandler = setTimeout(d,100);
				}else{
					timeHandler = setTimeout(d,100);
				}
				function d(){
					ed.setContent(tt.value, {source_view : true})
					content=tt.value;
					timeHandler = null;
				}
			});
			$(container).append(t.ta);
			$(t.ifr).hide();
			t.ta.show();
			t.pos.hide();
			t.hasInit = true;
			t.isSource = true;
		},
		_doBtn : function(ed, disable){
			var t = this;
			if(t.btnsLine==null){
				t.btnsLine = $(ed.getContainer()).find('table[id^="'+ed.id+'_toolbar"] td').filter(function(){
					var s = $(this).find('a')[0];
					if(s && s.id==ed.id+'_ctSource') return false;
					else return true;
				});
			}
			ed.controlManager.setActive('ctSource', disable);
			t.btnsLine.css('visibility',disable?'hidden':'visible');
		}
	});

	tinymce.PluginManager.add('ct_source', tinymce.plugins.ct_source);
})();