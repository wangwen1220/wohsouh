(function(){var i=function(a,b){b.find(">td>img.edit").click(function(){c.edit(a,b)});b.find(">td>img.delete").click(function(){c.del(a,b)})},e,f,g,h,c={table:null,init:function(a,b){e=a+"&action=edit";g=a+"&action=add";f=a+"&action=delete";h=a+"&action=test";c.table=new ct.table("#item_list",{dblclickHandler:c.edit,rowCallback:i,template:'<tr id="row_{dsnid}">\t<td class="t_l">{name}</td>\t<td class="t_l">{driver}</td>\t<td class="t_l">{host}</td>\t<td class="t_l">{dbname}</td>\t<td class="t_l">{charset}</td>\t<td class="t_l">{created}</td>\t<td class="t_c">\t   <img class="manage edit" height="16" width="16" alt="\u7f16\u8f91" src="images/edit.gif"/>       <img class="manage delete" height="16" width="16" alt="\u5220\u9664" src="images/delete.gif"/>\t</td></tr>',
baseUrl:a+"&action="+(b||"page")});c.table.load()},edit:function(a){ct.form("\u7f16\u8f91\u6570\u636e\u6e90",e+"&dsnid="+a,370,390,function(b){if(b.state){c.table.updateRow(a,b.data).trigger("check");return true}})},add:function(){ct.form("\u6dfb\u52a0\u6570\u636e\u6e90",g,370,390,function(a){if(a.state){c.table.addRow(a.data).trigger("check");return true}})},del:function(a){var b;if(a===undefined){a=c.table.checkedIds();if(!a.length){ct.warn("\u8bf7\u9009\u4e2d\u8981\u5220\u9664\u9879");return}b=
'\u786e\u5b9a\u5220\u9664\u9009\u4e2d\u7684<b style="color:red">'+a.length+"</b>\u6761\u8bb0\u5f55\u5417\uff1f"}else b='\u786e\u5b9a\u5220\u9664\u7f16\u53f7\u4e3a<b style="color:red">'+a+"</b>\u7684\u8bb0\u5f55\u5417\uff1f";ct.confirm(b,function(){$.post(f,"id="+a,function(d){d.state?(ct.ok("\u5220\u9664\u5b8c\u6bd5"),c.table.deleteRow(a)):ct.error(d.error)},"json")})},testlink:function(a){a=$(a);$.post(h,a.serialize(),function(b){var d=b.state?$('<div class="success"><sub></sub>\u8d44\u6e90\u6b63\u5e38</div>'):
$('<div class="error"><sub></sub>'+b.error+"</div>");a.before(d);setTimeout(function(){d&&d.hide()},3E3)},"json")}};window.App=c})();