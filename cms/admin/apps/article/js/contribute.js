var baseUrl="?app=article&controller=contribute",contribute={__common:function(a,e){if(a===undefined){a=tableApp.checkedIds();var b='\u786e\u5b9a\u64cd\u4f5c\u9009\u4e2d\u7684<b style="color:red">'+a.length+"</b>\u6761\u8bb0\u5f55\u5417\uff1f",c=a.join(",")}else{b='\u786e\u5b9a\u64cd\u4f5c\u7f16\u53f7\u4e3a<b style="color:red">'+a+"</b>\u7684\u8bb0\u5f55\u5417\uff1f";c=a}if(a.length===0){ct.warn("\u8bf7\u9009\u62e9\u8981\u64cd\u4f5c\u7684\u8bb0\u5f55");return false}ct.confirm(b,function(){$.post(baseUrl+
"&action="+e,{contentid:c},function(d){if(d.state){window.tableApp&&tableApp.deleteRow(a);ct.ok("\u64cd\u4f5c\u6210\u529f")}else ct.error(d.error)},"json")})},audit:function(a){contribute.__common(a,"pass")},reject:function(a){contribute.__common(a,"reject")},view:function(a){ct.assoc.open(baseUrl+"&action=view&contentid="+a,"newtab")},edit:function(a){ct.assoc.open("?app=article&controller=article&action=edit&contentid="+a,"newtab")}};
