(function(){var i=function(a,b){b.find(">td>img.edit").click(function(){c.edit(a,b)});b.find(">td>img.delete").click(function(){c.del(a,b)});b.find(">td>.sina").click(function(){c.sina(a,b)})},d,e,f,g,c={table:null,init:function(a,b){d=a+"&action=edit";f=a+"&action=add";e=a+"&action=delete";g=a+"&action=sina";c.table=new ct.table("#item_list",{dblclickHander:c.edit,rowCallback:i,template:'<tr id="row_{tweetid}">\t<td class="t_c">{tweetid}</td>\t<td class="t_l">{name}</td>\t<td class="t_c">{drivername}</td>\t<td class="t_l">{username}</td>\t<td class="t_c">{created}</td>\t<td class="t_c">{connect}</td>\t<td class="t_c">\t   <img class="manage edit" height="16" width="16" alt="\u7f16\u8f91" src="images/edit.gif"/>       <img class="manage delete" height="16" width="16" alt="\u5220\u9664" src="images/delete.gif"/>\t</td></tr>',
baseUrl:a+"&action="+(b||"page")});c.table.load()},add:function(){ct.form("\u6dfb\u52a0\u8f6c\u53d1\u8d26\u6237",f,400,280,function(a){if(a.state){c.table.addRow(a.data);return true}})},edit:function(a){ct.form("\u4fee\u6539\u8f6c\u53d1\u8d26\u6237",d+"&id="+a,400,280,function(b){if(b.state){c.table.updateRow(a,b.data);return true}})},del:function(a){var b;if(a==undefined)ct.warn("\u8bf7\u9009\u4e2d\u8981\u5220\u9664\u9879");else{b='\u786e\u5b9a\u5220\u9664\u7f16\u53f7\u4e3a<b style="color:red">'+
a+"</b>\u7684\u8bb0\u5f55\u5417\uff1f";ct.confirm(b,function(){$.post(e,"id="+a,function(h){h.state?(ct.ok("\u5220\u9664\u5b8c\u6bd5"),c.table.deleteRow(a)):ct.error(h.error)},"json")})}},sina:function(a){$.post(g+"&id="+a,"",function(b){if(b.state)document.location.href=b.url;else{ct.error(b.error);return false}},"json")}};window.App=c})();